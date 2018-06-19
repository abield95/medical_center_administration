<?php 
/**
 * OrganizationController
 */
class OrganizationController extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function addOrganization()
	{
		$this->View->render('organization/add_organization');
	}
}

 ?>