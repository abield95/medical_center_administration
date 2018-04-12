<?php 
	
	/**
	* Base class for Administrative Users and Patients
	*/
	class Person
	{
		$firstName;	//required
		$secondName; //optional
		$firtsLastName; //required
		$secondLastName; //optional
		$socialSecurityNumber;	//required
		$sex;//M male, F female, O extra->required
		$identificationNumber;//required for adults
	
		$address;
		$city;
		$state;
		$postalCode;
		$country;
		$homePhone;
		$workPhone;
		$mobilePhone;
		$contactEmail;

		function __construct(parameters)//parameter is an array with all the info
		{
			# code...
			$this->firstName = $parameters['firstName'];
			$this->secondName = $parameters['secondName'];
			$this->firtsLastName = $parameters['firtsLastName'];
			$this->secondLastName = $parameters['secondLastName'];
			$this->socialSecurityNumber = $parameters['socialSecurityNumber'];
			$this->sex = $parameters['sex'];
			$this->identificationNumber = $parameters['identificationNumber'];
	
			$this->address = $parameters['address'];
			$this->city = $parameters['city'];
			$this->state = $parameters['state'];
			$this->postalCode = $parameters['postalCode'];
			$this->country = $parameters['country'];
			$this->homePhone = $parameters['homePhone'];
			$this->workPhone = $parameters['workPhone'];
			$this->mobilePhone = $parameters['mobilePhone'];
			$this->contactEmail = $parameters['contactEmail'];
		}

	}

	/**
	* Class for managing patient information
	*/
	class Patients extends Person
	{
		$patientID;
		$idRecords = array();

		//demographics
		$birthDate;//required
		$maritalStatus; //divorced, married......
		$race; //white/caucasian Black/African American/ etc
		$languageForSpeaking;
		$languajeForWrittenMedicalInfo;
		$interpreter;//true or false

		function __construct($argument)
		{
			# code...
			parent::__construct();
		}
	}

 ?>