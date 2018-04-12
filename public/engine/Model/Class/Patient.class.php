<?php 

	/**
	* Patient Information
	*/
	class Patient
	{
		private $patientID;
		private $idRecords;

		private $name;	//required
		private $lastName; //required
		private $socialSecurityNumber;	//required
		private $sex;//M male, F female, O extra->required
		private $identificationNumber;//required for adults
	
		private $address;
		private $city;
		private $state;
		private $postalCode;
		private $country;
		private $emergencyContact;
		private $emergencyPhone;
		private $homePhone;
		private $workPhone;
		private $mobilePhone;
		private $contactEmail;

		//demographics
		private $birthDate;//required
		private $maritalStatus; //divorced, married......
		private $race; //white/caucasian Black/African American/ etc
		private $languageForSpeaking;
		private $languajeForWrittenMedInfo;
		private $interpreter;//true or false

		function __construct($parameters)//parameter is an array with all the info
		{
			# code...
			$this->name = $parameters['name'];
			$this->lastName = $parameters['lastName'];
			$this->socialSecurityNumber = $parameters['socialSecurityNumber'];
			$this->sex = $parameters['sex'];
			$this->identificationNumber = $parameters['identificationNumber'];
			$this->birthDate = $parameters['birthDate'];
			$this->maritalStatus = $parameters['maritalStatus'];
			$this->race = $parameters['race'];
			$this->languajeForSpeaking = $parameters['languajeForSpeaking'];
			$this->languajeForWrittenMedInfo = $parameters['languajeForWrittenMedInfo'];
			$this->interpreter = $parameters['interpreter'];
	
			$this->address = $parameters['address'];
			$this->city = $parameters['city'];
			$this->state = $parameters['state'];
			$this->postalCode = $parameters['postalCode'];
			$this->country = $parameters['country'];
			$this->emergencyContact;
			$this->emergencyPhone;
			$this->homePhone = $parameters['homePhone'];
			$this->workPhone = $parameters['workPhone'];
			$this->mobilePhone = $parameters['mobilePhone'];
			$this->contactEmail = $parameters['contactEmail'];
		}

		function loadPatients()
		{
			$connection = new Connection();

		}

		function searchPatient($name)
		{
			$query = "SELECT value FROM patients WHERE name LIKE '%".$name%."'";

			$Connection = new Connection();
			$connection->startConnection();

			if($stmt = mysqli_prepare($connection->getConnection(), $query)){
    		// Bind variables to the prepared statement as parameters
    			mysqli_stmt_bind_param($stmt, "s", $param_term);
    			$param_term = $_REQUEST['term'] . '%';
    			// Attempt to execute the prepared statement
    			if(mysqli_stmt_execute($stmt)){
       		 		$result = mysqli_stmt_get_result($stmt);
       		 		// Check number of rows in the result set
       		 		if(mysqli_num_rows($result) > 0){
       		 		// Fetch result rows as an associative array
       		 			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
       		 				echo "<p>" . $row["name"] . "</p>";
       		 			}
       		 		} else{
       		 			echo "<p>No matches found</p>";
       		 		}
       		 	} else{
       		 		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
       		 	}
       		}
       		// Close statement
       		mysqli_stmt_close($stmt);
       	}

		function loadPatientInfo($idPatient)
		{
			$connection = new Connection();

			$query = "SELECT
				name,
				lastName,
				sex,
				birthDate,
				race,
				maritalStatus,
				socialSecurityNumber,
				identificationNumber,
				languajeForSpeaking,
				languajeForWritingMedInfo,
				interpreter,
				address,
				city,
				state,
				country,
				postalCode,
				emergencyContact,
				emergencyPhone,
				workPhone,
				homePhone,
				mobilePhone,
				contactEmail
			FROM patients WHERE id_text=?";
			$connection->startConnection();

			if ($stmt = mysqli_prepare($connection->getConnection(), $query)) {
				# code...
				//ligar el parametro
				mysqli_stmt_bind_param($stmt, "s", $idPatient);

				//ejecutar la consulta
				mysqli_stmt_execute($stmt);

				//vincular los resultados
				mysqli_stmt_bind_result(
					$stmt,//statement
					$id_bin,
					$this->name,
					$id_text,
					$this->lastName,
					$this->sex,
					$this->birthDate,
					$this->race,
					$this->maritalStatus,
					$this->socialSecurityNumber,
					$this->identificationNumber,
					$this->languajeForSpeaking,
					$this->languajeForWrittenMedInfo,
					$this->interpreter,
					$this->address,
					$this->city,
					$this->state,
					$this->country,
					$this->postalCode,
					$this->emergencyContact,
					$this->emergencyPhone,
					$this->workPhone,
					$this->homePhone,
					$this->mobilePhone,
					$this->contactEmail
				);

				//obtener los valores
				while (mysqli_stmt_fetch($stmt)) {
					# code...
					echo "$stmt,
					$id_bin,
					$this->name,
					$id_text,
					$this->lastName,
					$this->sex,
					$this->birthDate,
					$this->race,
					$this->maritalStatus,
					$this->socialSecurityNumber,
					$this->identificationNumber,
					$this->languajeForSpeaking,
					$this->languajeForWrittenMedInfo,
					$this->interpreter,
					$this->address,
					$this->city,
					$this->state,
					$this->country,
					$this->postalCode,
					$this->emergencyContact,
					$this->emergencyPhone,
					$this->workPhone,
					$this->homePhone,
					$this->mobilePhone,
					$this->contactEmail";
				}

				mysqli_stmt_close($stmt);
			}

			$connection->closeConnection();
			
		}

		public static function addPatient($data)
		{
			spl_autoload_register(
				function ($class){
					include $class.'.class.php';
				}
			);

			$connection = new Connection();

			$multiQuery = "
			set @u = unhex(replace(uuid(),'-',''));
			set @ui = concat(substr(@u, 7, 2), substr(@u, 5, 2),
				substr(@u, 1, 4), substr(@u, 9, 8));

			set @r = unhex(replace(uuid(),'-',''));
			set @ri = concat(substr(@r, 7, 2), substr(@r, 5, 2),
				substr(@r, 1, 4), substr(@r, 9, 8));

			INSERT INTO patients(
				id_bin_patient,
				name,
				lastName,
				sex,
				birthDate,
				race,
				maritalStatus,
				socialSecurityNumber,
				identificationNumber,
				languajeForSpeaking,
				languajeForWritingMedInfo,
				interpreter,
				address,
				city,
				state,
				country,
				postalCode,
				emergencyContact,
				emergencyPhone,
				workPhone,
				homePhone,
				mobilePhone,
				contactEmail
			) VALUES
			(
				@ui,
				'". $data['name'] 						."',
				'". $data['lastName']					."',
				'". $data['sex'] 						."',
				'". $data['birthDate']					."',
				'". $data['race'] 						."',
				'". $data['maritalStatus']				."',
				'". $data['socialSecurityNumber']		."',
				'". $data['identificationNumber']		."',
				'". $data['languajeForSpeaking']		."',
				'". $data['languajeForWritingMedInfo']	."',
				'". $data['interpreter']				."',
				'". $data['address'] 					."',
				'". $data['city']						."',
				'". $data['state']						."',
				'". $data['country']					."',
				'". $data['postalCode']					."',
				'". $data['emergencyContact']			."',
				'". $data['emergencyPhone']				."',
				'". $data['workPhone']					."',
				'". $data['homePhone']					."',
				'". $data['mobilePhone']				."',
				'". $data['contactEmail'] 				."'
			);

			INSERT INTO mainrecords(id_bin_record) VALUES(
					@ri);

    		INSERT INTO patients_records(id_bin_patient, id_bin_record) VALUES(@ui, @ri)";

			$connection->startConnection();

			$connection->executeMultiQuery($multiQuery);

			$connection->closeConnection();
		}
	}

 ?>