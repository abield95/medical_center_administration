<?php 

	/**
	* Base controller
	*/
	class BaseController
	{
		public $View;

		function __construct()
		{
			//always initialize a session
			//Session::init();

			//Auth::checkSessionConcurrency();

			/*if (!Session::userIsLoggedIn() AND Request::cookie('remember_me')) {
				# code...
				header('location: ' . Config::get('URL') . 'login/loginWithCookie');
			}*/

			$this->View = new View();
		}
	}

 ?>