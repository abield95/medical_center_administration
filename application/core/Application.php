<?php 

	/**
	* 
	*/
	class Application
	{

		private $controller;
		private $parameters = array();

		private $controller_name;	//just the name of the controller
		private $action_name;		//the action name
		
		function __construct()
		{
			//echo Config::get('URL');
			$this->splitUrl();

			$this->createControllerAndActionNames();

			if (file_exists(Config::get('PATH_CONTROLLER') . $this->controller_name . '.php')) {

				require Config::get('PATH_CONTROLLER') . $this->controller_name . '.php';

				$this->controller = new $this->controller_name();

				//check for method: does such a methos exist in the controller ?
				if (method_exists($this->controller, $this->action_name)) {
					if (!empty($this->parameters)) {
						//call the method and pass arguments to it
						call_user_func_array(array($this->controller, $this->action_name), $this->parameters);
					}
					else {
						//if no parameters are given, just call the method without parameters, like $this->index->index()
						$this->controller->{$this->action_name}();
					}
				}
				else {
					//load 404 error page
					require Config::get('PATH_CONTROLLER') . 'ErrorController.php';
					$this->controller = new ErrorController;
					$this->controller->error404();
				}
			}
			else {
				//load 404 error page
					require Config::get('PATH_CONTROLLER') . 'ErrorController.php';
					$this->controller = new ErrorController;
					$this->controller->error404();
			}
		}

		/**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (Request::get('url')) {
            // split URL
            $url = trim(Request::get('url'), '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // put URL parts into according properties
            $this->controller_name = isset($url[0]) ? $url[0] : null;
            $this->action_name = isset($url[1]) ? $url[1] : null;

            // remove controller name and action name from the split URL
            unset($url[0], $url[1]);

            // rebase array keys and store the URL parameters
            $this->parameters = array_values($url);
        }
        else if (Request::post('url')) {
        	echo "string2 get uisas";
        	# code...
        	$url = trim(Request::post('url'), '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // put URL parts into according properties
            $this->controller_name = isset($url[0]) ? $url[0] : null;
            $this->action_name = isset($url[1]) ? $url[1] : null;

            // remove controller name and action name from the split URL
            unset($url[0], $url[1]);

            echo $url;



            // rebase array keys and store the URL parameters
            $this->parameters = array_values($url);
        }
    }

		private function createControllerAndActionNames()
		{
			//check for the controller
			if (!$this->controller_name) {
				//no controller name, use default
				$this->controller_name = Config::get('DEFAULT_CONTROLLER');
			}

			//check for the action
			if (!$this->action_name OR (strlen($this->action_name) == 0)) {
				//no given action, use default
				$this->action_name = Config::get('DEFAULT_ACTION');
			}

			$this->controller_name = ucwords($this->controller_name) . 'Controller';
		}
	}

 ?>