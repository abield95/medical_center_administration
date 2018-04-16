<?php 

	/**
	* 
	*/
	class IndexController extends BaseController
	{
		
		function __construct()
		{
			parent::__construct();
			echo Config::get('URL') . 'login?redirect=' . urlencode($_SERVER['REQUEST_URI']);
			#Auth::checkAuthentication();
		}

		public function index()
		{
			$this->View->render('index/index');
		}
	}

 ?>