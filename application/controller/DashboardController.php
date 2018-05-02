<?php 

/**
* Dashboard controller, only visible to logged users
*/
class DashboardController extends BaseController
{
	
	function __construct()
	{
		parent::__construct();

		Auth::checkAuthentication();
	}

	public function index()
	{
		$this->View->render('dashboard/index');
	}
}

 ?>