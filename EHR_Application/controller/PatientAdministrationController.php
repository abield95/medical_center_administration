<?php 

	/**
	* Patient Administration
	*/
	class PatientAdministrationController extends BaseController
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$this->View->render('patient_administration/index');
		}

		public function addPatient()
		{
			$this->View->render('patient_administration/add_patient');
		}
	}

 ?>