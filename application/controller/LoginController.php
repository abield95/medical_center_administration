<?php 

/**
* Login Controller
*/
class LoginController extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (LoginModel::isUserLoggedIn()) {
			Redirect::home();
		}
		else
		{
			$data = array('redirect' => Request::get('redirect') ? Request::get('redirect') : NULL);
			$this->View->render('login/index', $data);
		}
	}

	public function login()
	{
        //pruebas
        
    //require_once(Config::get("JAVA_BRIDGE") ."java/Java.inc");
        //phpinfo();
        
        /**
         * Managind datattypes example
         */
        
        //phpinfo();
        //$this->View->renderWithNavAndFooter('identified_person');
        $xml = Config::get("PATH_BASE") . "processable\coreschemas/voc-r2.xsd";
        $xsl = Config::get("PATH_BASE") . "stylesheetXSL.xsl";

        $proc = new Saxon\SaxonProcessor();
        $version = $proc->version();
        echo "Saxon processor version: " . $version;
        $xsltProcessor = $proc->newXsltProcessor();
        $xsltProcessor->setSourceFromFile($xml);
        $xsltProcessor->compileFromFile($xsl);
        $result = $xsltProcessor->transformToString();
        if ($result != NULL) {
            echo "Example Simple:";
            echo "Output: " . $result;
        }
        else
        {
            echo "Result is NULL";
        }

        $xsltProcessor->clearParameters();
        $xsltProcessor->clearProperties();
        
        //$saxonProc = new Saxon\SaxonProcessor();
        
        // $xml = new DOMDocument;
        // if ($xml->load(Config::get("PATH_BASE") . "processable\coreschemas/voc-r2.xsd") === FALSE)
        // {
        //     echo "Failed opeing xsd file";
        //     return;
        // }

        // //xsl file
        // $xsl = new DOMDocument;
        // if ($xsl->load(Config::get("PATH_BASE") . "stylesheetXSL.xsl") === FALSE)
        // {
        //     echo "Failed opening xsl file";
        //     return;
        // }

        // //configure the preprocessor
        // $proc = new XSLTProcessor;


        // $proc->importStyleSheet($xsl);


        // $page = Config::get('PATH_BASE')."prueba.html";
        // if ($proc->transformToUri($xml, $page) === FALSE)
        // {
        //     echo "Error transform";
        // }
        
        // $xml = new DOMDocument;
        // if ($xml->load(Config::get("PATH_BASE") . "processable\multicacheschemas\PRPM_MT401010UV01.xsd") === FALSE)
        // {
        //     echo "Failed opeing xsd file";
        //     return;
        // }

        // //xsl file
        // $xsl = new DOMDocument;
        // if ($xsl->load(Config::get("PATH_BASE") . "stylesheet.xsl") === FALSE)
        // {
        //     echo "Failed opening xsl file";
        //     return;
        // }

        // //configure the preprocessor
        // $proc = new XSLTProcessor;

        // $proc->importStyleSheet($xsl);


        // $page = Config::get('PATH_BASE')."prueba.html";
        // if ($proc->transformToUri($xml, $page) === FALSE)
        // {
        //     echo "Error transform";
        // }

        //echo $page;


        //Redirect::to("patientAdministration/addPatient");
        //redirect to patient registration
        ////////Redirect::to("patientAdministration/registerPatient");
        //later enter working
		/*if (!Csrf::isTokenValid()) {
			LoginModel::logout();
			Redirect::home();
			exit();
		}

		//perform the login method, return true or false
		$login_successful = LoginModel::login(
			Request::post('user_name'),
			Request::post('user_password'),
			Request::post('set_remember_me_cookie')
		);

		if ($login_successful) {
			if (Request::post('redirect')) {
				Redirect::toPreviousViewedPageAfterLogin(ltrim(urldecode(Request::post('redirect')), '/'));
			}
			else
			{
				Redirect::to('user/index');
			}
		}
		else
		{
			if (Request::post('redirect')) {
				Redirect::to('login?redirect=' . ltrim(urlencode(Request::post('redirect')), '/'));
			}
			else
			{
				Redirect::to('login/index');
			}
		}*/
	}

	public function logout()
	{
		LoginModel::logout();
		Redirect::home();
		exit();
	}

	/**
     * Login with cookie
     */
    public function loginWithCookie()
    {
        // run the loginWithCookie() method in the login-model, put the result in $login_successful (true or false)
         $login_successful = LoginModel::loginWithCookie(Request::cookie('remember_me'));

        // if login successful, redirect to dashboard/index ...
        if ($login_successful) {
            Redirect::to('dashboard/index');
        } else {
            // if not, delete cookie (outdated? attack?) and route user to login form to prevent infinite login loops
            LoginModel::deleteCookie();
            Redirect::to('login/index');
        }
    }

    /**
     * Show the request-password-reset page
     */
    public function requestPasswordReset()
    {
        $this->View->render('login/requestPasswordReset');
    }

    /**
     * The request-password-reset action
     * POST-request after form submit
     */
    public function requestPasswordReset_action()
    {
        PasswordResetModel::requestPasswordReset(Request::post('user_name_or_email'), Request::post('captcha'));
        Redirect::to('login/index');
    }

    /**
     * Verify the verification token of that user (to show the user the password editing view or not)
     * @param string $user_name username
     * @param string $verification_code password reset verification token
     */
    public function verifyPasswordReset($user_name, $verification_code)
    {
        // check if this the provided verification code fits the user's verification code
        if (PasswordResetModel::verifyPasswordReset($user_name, $verification_code)) {
            // pass URL-provided variable to view to display them
            $this->View->render('login/resetPassword', array(
                'user_name' => $user_name,
                'user_password_reset_hash' => $verification_code
            ));
        } else {
            Redirect::to('login/index');
        }
    }

    /**
     * Set the new password
     * Please note that this happens while the user is not logged in. The user identifies via the data provided by the
     * password reset link from the email, automatically filled into the <form> fields. See verifyPasswordReset()
     * for more. Then (regardless of result) route user to index page (user will get success/error via feedback message)
     * POST request !
     * TODO this is an _action
     */
    public function setNewPassword()
    {
        PasswordResetModel::setNewPassword(
            Request::post('user_name'), Request::post('user_password_reset_hash'),
            Request::post('user_password_new'), Request::post('user_password_repeat')
        );
        Redirect::to('login/index');
    }
}

 ?>