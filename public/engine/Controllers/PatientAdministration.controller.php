<?php 

	/**
	* PatientAdministration class
	*/
	class PatientAdministrationController
	{
		
		// function __construct(argument)
		// {
		// 	# code...
		// }

		public function home()
		{
			require_once('engine\Views\PatientAdministration\home.php');
		}

		public function searchPatient($data)
		{
			echo "From controller ".$data;
		}

		public function addPatient()
		{

		}

		public function loadPatient()
		{

		}

		public function error()
		{
			echo "error";
		}
	}

 ?>