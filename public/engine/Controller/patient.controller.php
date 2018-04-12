<?php 

	/**
	* Controller for the patient actions
	*/
	class PatientController
	{
		
		function __construct(argument)
		{
			# code...
		}
	}

	if (isset($_POST['order']) && isset($_POST['data'])) {
		# code...
		if ($_POST['order'] == "new") {
			# code...
			//saveNewPatientInfo($_POST['data']);
			$data = $_POST['data'];
			saveNewPatientInfo($data);


		}
	}

	// if (isset($_POST['data'])) {
	// 	# code...
	// 	echo "Hello";
	// 	echo $_POST['data'];
	// }

	/*echo " Data <br>Name".
			$data['name'],
			$data['lastName'],
			$data['sex'],
			$data['birthDate'],
			$data['race'],
			$data['maritalStatus'],
			$data['socialSecurityNumber'],
			$data['identificationNumber'],
			$data['languajeForSpeaking'],
			$data['languajeForWritingMedInfo'],
			$data['interpreter'],
			$data['address'],
			$data['city'],
			$data['state'],
			$data['country'],
			$data['postalCode'],
			$data['emergencyContact'],
			$data['emergencyPhone'],
			$data['workPhone'],
			$data['homePhone'],
			$data['mobilePhone'],
			$data['contactEmail']
			"Data ";*/

	function saveNewPatientInfo($data)
	{
		include '../Model/Class/Patient.class.php';

		Patient::addPatient($data);
	}

	function loadPatients()
	{
		//cargar todos los pacientes
		include 'connection.php';

		$connection = new Connection();
		$connection->startConnection();

		$result = $connection->executeQuery("select * from patients");

	}

	function loadPatientInfo()
	{
		//load the required patient info
		include 'connection.php';

		$connection = new Connection();
		$connection->startConnection();

		$result = $connection->executeQuery("select * from patient");
	}

	function updatePatientInfo()
	{

	}

	function reportDemographicData()
	{

	}

	function captureChangesOverTime()
	{

	}
 ?>