<?php 

	/**
	* Class Error
	*contains methos to handle errors in certain errors scenarios
	*example a proper 404 response
	*/
	class ErrorController extends BaseController
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function error404()
		{
			header('HTTP/1.0 404 Not Found', true, 404);
			$this->View->render('error/404');
		}
	}

 ?>