<?php 

	/**
	* Login Controller
	*to control everithing related to authentication-related
	*/
	class LoginController extends BaseController
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			//if users is logged in redirect to main page, if not show the view
			if (LoginModel::isUserLoggedIn()) {
				Redirect::home();
			}
			else {
				$data = array('redirect' => Request::get('redirect') ? Request::get('redirect') : NULL);
				$this->View->render('login/index', $data);
			}
		}

		public function login()
		{
			//check if csrf token is valid
			if (!Csrf::isTokenValid()) {
				LoginModel::logout();
				Redirect::home();
				exit();
			}
		}
	}

 ?>