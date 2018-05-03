<?php 
	//file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/domains/uvpa/editable/PRPA_HD101301UV-NoEdit.html#PatientOfOtherProvider
	namespace Person_Activate

	/**
	* IdentifiedPerson
	The prrimary record of the focal person in a person registry 
	*/
	class IdentifiedPerson
	{
		private $classCode;
		private $id;
		private $addr;
		private $telecom;
		private $statusCode;
		private $effectiveTime;
		private $confidentialityCode;
		private $identifiedPerson;
		private $assigningOrganization;
		private $subjectOf;
		function __construct()
		{
			$this->classCode = array('root' => "IDENT", 'CNE' => "V:RoleClassIdentifiedEntity");
			$this->id = array();
			$this->addr = array();
			$this->telecom = array();
			$this->statusCode = "active";
			$this->identifiedPerson = new Person();
			$this->assigningOrganization = new Organization();
			$this->subjectOf = array(); //of Subject4
		}


		/**
		 *@param $id  One or more identifiers designated for the focal person in this person registry. Note, this is a mandatory attribute; it makes no sense to have a record in an identified person registry that does not have an identifier. 
		**/
		protected function addId($id)
		{
			$this->id[] = $id;
		}


		/**
		 *@param $addr Address(es) for corresponding with the focal person in the context of this registry 
		**/
		public function addAddr($addr)
		{
			$this->addr[] = $addr;
		}


		/**
		 *@param $telecom Telecommunication address(es) for communicating with the focal person in the context of this registry 
		**/
		public function addTelecom($telecom)
		{
			$this->telecom[] = $telecom;
		}


		/**
		 *@param @statusCode A value specifying the state of this record in a person registry (based on the RIM role class state-machine).
		**/
		public function setStatusCode($statusCode)
		{
			$this->statisCode = $statusCode;
		}

		/**
		 *@param $effectiveTime An interval of time specifying the period during which this record in a person registry is in effect, if such time limit is applicable and known 
		*/
		public function setEffectiveTime($effectiveTime)
		{
			$this->effectiveTime = $effectiveTime;
		}

		/**
		 *@param $confidentialityCode Value(s) that control the disclosure of information from a registry about this person 
		*/
		public function setConfidentialityCode($confidentialityCode)
		{
			$this->confidentialityCode = $confidentialityCode;
		}


		/**
		 *@param $identifiedPerson A subtype of LivingSubject representing a human being e,g setIdentifiedPerson(new Person());
		**/
		public function setIdentifiedPerson($identifiedPerson)
		{
			$this->identifiedPerson = $identifiedPerson;
		}


		/**
		 *@param $assigningOrganization from E_OrganizationUniversal
		 file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/domains/uvct/editable/COCT_MT150000UV-NoEdit.html
		**/
		public function setAssigningOrganization($assigningOrganization)
		{
			$this->assigningOrganization = $assigningOrganization;
		}


		/**
		 *@param $subjectOf The association of an observation to a record from a registry, either a patient registry or an identified living subject registry. For example, a "find candidates" query response might return the degree of match for each record returned. e,g addSubjectOf(new Subject4())
		**/
		protected function addSubjectOf($subjectOf)
		{
			$this->subjectOf[] = $subjectOf;
		}
	}

	/**
	* Person
	* 
	*/
	class Person
	{
		private $classCode;
		private $determinerCode;
		private $id;
		private $name;
		private $desc;
		private $telecom;
		private $administrativeGenderCode;
		private $birthTime;
		private $deceasedInd;
		private $deceasedTime;
		private $multipleBirthInd;
		private $multipleBirthOrderNumber;
		private $organDonorInd;
		private $addr;
		private $maritalStatusCode;
		private $asPatientOfOtherProvider;
		private $asEmployee;
		private $asCitizen;
		private $asStudent;
		private $asMember;
		private $asOtherIDs;
		private $contactParty;
		private $guardian;
		private $personalRelationship;
		private $birthPlace;
		private $languajeCommunication;
		function __construct()
		{
			$this->classCode = array('root' => "PSN", 'CNE' => "C:EntityClass");//person Entity
			$this->determinerCode = array('root' => "INSTANCE", 'CNE' => "C:EntityDeterminer");
		}

		/**
		 *@param $id  Identifier(s) for this person. Note that these identifiers can only be used for matching purposes since no scoping organization or status information is included. 
		**/
		public function addId($id)
		{
			if (!is_array($this->id)) {
				$this->id = array();
			}
			$this->id[] = $id;
		}


		/**
		 *@param $name Name(s) for this person
		**/
		public function setName($name)
		{
			$this->name = $name;
		}

		public function getName()
		{
			return $this->name;
		}


		/**
		 *@param $desc A textual or multimedia representation of this person. Descriptions are meant to be shown to interested human individuals. 
		**/
		public function setDesc($desc)
		{
			$this->desc = $desc;
		}


		/**
		 *@param $telecom Telecommunication address(es) for communicating with this person
		**/
		public function addTelecom($telecom)
		{
			if (!is_array($this->telecom)) {
				$this->telecom = array();
			}
			$this->telecom[] = $telecom;
		}


		/**
		 *@param $administrativeGenderCode A value representing the gender (sex) of this person. Note: this attribute does not include terms related to clinical gender which is a complex physiological, genetic and sociological concept that requires multiple observations in order to be comprehensively described.
		**/
		public function setAdministrativeGenderCode($administrativeGenderCode)
		{
			$this->administrativeGenderCode = $administrativeGenderCode;
		}


		/**
		 *@param $birthTime  The date and time this person was born. This could be an exact moment such as January 1, 1960 @ 03:00:00 EST or an approximate date such as January 1960.
		**/
		public function setBirthTime($birthTime)
		{
			$this->birthTime = $birthTime;
		}


		/**
		 *@param $deceasedInd An indication that this person is dead
		**/
		public function setDeceasedInd($deceasedInd = false)
		{
			$this->deceasedInd = $deceasedInd;
		}

		public function setDeceasedTime($deceasedTime)
		{
			if ($deceasedInd == true) {
				$this->deceasedTime = $deceasedTime;
			}
		}


		/**
		 *@param $multipleBirthInd An indication that this person was part of a multiple birth
		**/
		public function setMultipleBirthInd($multipleBirthInd = false)
		{
			$this->multipleBirthInd = $multipleBirthInd;
		}

		public function setMultipleBirthOrderNumber($multipleBirthOrderNumber)
		{
			if ($this->multipleBirthInd == true) {
				$this->multipleBirthOrderNumber = $multipleBirthOrderNumber;
			}
		}


		/**
		 *@param $organDonorInd An indication that this person is a candidate to serve as an organ donor. Note: specifics of an organ donor agreement would be conveyed in a medico-legal document.
		**/
		public function setOrganDonorInd($organDonorInd = false)
		{
			$this->organDonorInd = $organDonorInd;
		}


		/**
		 * @param $addr Address(es) for corresponding with this person 
		**/
		public function addAddr($addr)
		{
			if (!is_array($this->addr)) {
				$this->addr = array();
			}
			$this->addr[] = $addr;
		}

		public function setMaritalStatusCode($maritalStatusCode)
		{
			$this->maritalStatusCode = $maritalStatusCode;
		}

		//other dependend classes

		/**
		 *@param $asPatientOfOtherProvider An association of the focal living subject to a role of a patient who is the subject of a care provision act. The care provision performer may be the primary provider responsible for general care or within a specific healthcare facility. This relationship is usually solid over time and is recorded only for administrative purposes; actual care provided by the healthcare provider is recorded elsewhere.
		 e,g setAsPatientOfOtherProvider(new PatientOfOtherProvider()) 
		**/
		public function addAsPatientOfOtherProvider($asPatientOfOtherProvider)
		{
			if (!is_array($this->asPatientOfOtherProvider)) {
				$this->asPatientOfOtherProvider = array();
			}

			$this->asPatientOfOtherProvider[] = $asPatientOfOtherProvider;
		}


		/**
		 *@param $asEmployee A relationship of the focal person with an organization to receive wages or salary. The purpose of this class is to identify the type of relationship the employee has to the employer rather than the nature of the work actually performed.
		 e,g setAsEmployee(new Employee());
		**/
		public function addAsEmployee($asEmployee)
		{
			if (!is_array($this->asEmployee)) {
				$this->asEmployee = array();
			}

			$this->asEmployee[] = $asEmployee;
		}


		/**
		 *@param $asCitizen A formal relationship between the focal person (player) who owes loyalty to and is entitled by birth or naturalization to the protection of a nation (scoper) 
		 e,g setAsCitizen(new Citizen());
		**/
		public function addAsCitizen($asCitizen)
		{
			if (!is_array($this->asCitizen)) {
				$this->asCitizen = array();
			}

			$this->asCitizen[] = $asCitizen;
		}


		/**
		 *@param $asStudent An enrollment of the focal person as a student of a school 
		 e,g setAsStudent(new Student());
		**/
		public function addAsStudent($asStudent)
		{
			if (!is_array($this->asStudent)) {
				$this->asStudent = array();
			}

			$this->asStudent[] = $asStudent;
		}


		/**
		 *@param $asMember A membership of the playing living subject in a group such as family, tribe, or religious organization 
		 UsageNotes: MEMBER Changed effectiveTime from IVL<TS> to GTS to allow conveying that a person is an active member of a household on a particular schedule (e.g., alternate weeks).
		 e,g setAsMember(new Member());
		**/
		public function addAsMember($asMember)
		{
			if (!is_array($this->asMember)) {
				$this->asMember = array();
			}

			$this->asMember[] = $asMember;
		}


		/**
		 *@param $asOtherIDs  An identifying relationship between the focal living subject and a scoping organization. Note that this could be an identifier used by the primary scoping organization in a different context. 
		 e,g setAsOtherIDs(new OtherIDs());
		**/
		public function addAsOtherIDs($asOtherIDs)
		{
			if (!is_array($this->asOtherIDs)) {
				$this->asOtherIDs = array();
			}

			$this->asOtherIDs[] = $asOtherIDs;
		}


		/**
		 *@param $contactParty A person or an organization (playing entity) that is authorized to provide or receive information about the focal person (scoping entity) 
		 e,g setContactParty(new ContactParty());
		**/
		public function addContactParty($contactParty)
		{
			if (!is_array($this->contactParty)) {
				$this->contactParty = array();
			}

			$this->contactParty[] = $contactParty;
		}


		/**
		 * @param $guardian A person or organization (playing entity) that is legally responsible for the care and management of the focal person (scoping entity)
		 e,g setGuardian(new Guardian()); 
		**/
		public function addGuardian($guardian)
		{
			if (!is_array($this->guardian)) {
				$this->guardian = array();
			}

			$this->guardian[] = $guardian;
		}


		/**
		 * @param $personalRelationship A personal relationship between the focal living subject and another living subject
		 e,g setPersonalRelationship(new PersonalRelationship());
		**/
		public function addPersonalRelationship($personalRelationship)
		{
			if (!is_array($this->personalRelationship)) {
				$this->personalRelationship = array();
			}

			$this->personalRelationship[] = $personalRelationship;
		}


		/**
		 * @param $birthPlace The birthplace of the focal living subject 
		**/
		public function setBirthPlace($birthPlace)
		{
			$this->birthPlace = $birthPlace;
		}


		/**
		 * @param $languajeCommunication A language communication capability of the focal person 
		**/
		public function addLanguajeCommunication($languajeCommunication)
		{
			if (!is_array($this->languajeCommunication)) {
				$this->languajeCommunication = array();
			}

			$this->languajeCommunication[] = $languajeCommunication;
		}
	}


	/**
	 * PatientOfOtherProvider
	 An association of the focal living subject to a role of a patient who is the subject of a care provision act. The care provision performer may be the primary provider responsible for general care or within a specific healthcare facility. This relationship is usually solid over time and is recorded only for administrative purposes; actual care provided by the healthcare provider is recorded elsewhere. 
	*/
	class PatientOfOtherProvider
	{
		private $classCode;//this is a patient Role
		private $subject;
		function __construct()
		{
			$this->classCode = array('root' => "PAT", 'CNE' => "V:RoleClassPatient");
		}


		/**
		 *@param $subject The patient (person) in the role of patient is the subject of a care provision act. The care provision performer may be the primary provider responsible for general care or within a specific healthcare facility. This relationship is usually solid over time and is recorded only for administrative purposes; actual care provided by a healthcare provider is recorded elsewhere.
		 e,g setSubject(new Subject());
		**/
		public function setSubject($subject)
		{
			$this->subject = $subject;
		}
	}


	/**
	 * Subject
	 The patient (person) in the role of patient is the subject of a care provision act. The care provision performer may be the primary provider responsible for general care or within a specific healthcare facility. This relationship is usually solid over time and is recorded only for administrative purposes; actual care provided by a healthcare provider is recorded elsewhere. 
	*/
	class Subject
	{
		private $typeCode;// Structural attribute; this is a "ParticipationTargetSubject" participation 
		private $careProvision;
		function __construct()
		{
			$this->typeCode = array('root' => "SBJ",'CNE' => "V:ParticipationTargetSubject");
		}


		/**
		 * @param $careProvision
		 file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/domains/uvct/editable/COCT_MT820000UV-NoEdit.html
		**/
		public function setCareProvision($careProvision)
		{
			$this->careProvision = $careProvision;
		}
	}

	/**
	* Employee
	 Design Comments: A relationship of the focal person with an organization to receive wages or salary. The purpose of this class is to identify the type of relationship the employee has to the employer rather than the nature of the work actually performed. 
	*/
	class Employee
	{
		//file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/domains/uvpa/editable/PRPA_HD101301UV-NoEdit.html#PatientOfOtherProvider
		private $classCode;
		private $id;
		private $code;
		private $negationInd;
		private $addr;
		private $telecom;
		private $statusCode;
		private $effectiveTime;
		private $jobTitleName;
		private $jobClassCode;
		private $occupationCode;
		private $employerOrganization;
		function __construct()
		{
			$this->classCode = array('root' => "EMP", 'CNE' => "V:RoleClassEmployee");
		}

		public function addId($id)
		{
			if (!is_array($id)) {
				$this->id = array();
			}

			$this->id[] = $id;
		}

		public function setCode($code)
		{
			$this->code = $code;
		}

		public function setNegationInd($negationInd = true)
		{
			$this->negationInd = $negationInd;
		}

		public function addAddr($addr)
		{
			if (!is_array($this->addr)) {
				$this->addr = array();
			}

			$this->addr[] = $addr;
		}

		public function addTelecom($telecom)
		{
			if (!is_array($this->telecom)) {
				$this->telecom = array();
			}

			$this->telecom[] = $telecom;
		}

		public function setStatusCode($statusCode)
		{
			$this->statusCode = $statusCode;
		}

		public function setEffectiveTime($effectiveTime = null)
		{
			$this->effectiveTime = $effectiveTime;
		}

		public function setJobTitleName($jobTitleName)
		{
			$this->jobTitleName = $jobTitleName;
		}

		public function setJobClassCode($jobClassCode)
		{
			$this->jobClassCode = $jobClassCode;
		}

		public function setOccupationCode($occupationCode)
		{
			$this->occupationCode = $occupationCode;
		}


		/**
		 * @param $employerOrganization
		 file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/domains/uvct/editable/COCT_MT150007UV-NoEdit.html
		 e,g 
		**/
		public function setEmployerOrganization($employerOrganization)
		{
			$this->employerOrganization = $employerOrganization;
		}
	}

	/**
	* Citizen
	 Design Comments: A formal relationship between the focal person (player) who owes loyalty to and is entitled by birth or naturalization to the protection of a nation (scoper) 
	*/
	class Citizen
	{
		private $classCode;
		private $id;
		private $code;
		private $effectiveTime;
		private $politicalNation;
		function __construct()
		{
			$this->politicalNation = new Nation();
		}

		public function addId($id)
		{
			if (!is_array($this->id)) {
				$this->id = array();
			}

			$this->id[] = $id;
		}

		public function setCode($code)
		{
			$this->code = $code;
		}


		
		public function setEffectiveTime($effectiveTime)
		{
			$this->effectiveTime = $effectiveTime;
		}


		/**
		 * @param $politicalNation type Nationn  A politically organized body of people bonded by territory and known as a nation 
		 e,g setPoliticalNation(new Nation());
		**/
		public function setPoliticalNation($politicalNation)
		{
			$this->politicalNation = $politicalNation;
		}
	}

	/**
	* Nation
	*/
	class Nation
	{
		private $classCode;
		private $determinerCode;
		private $code;//ISO 3166 country codes
		private $name;//A non-unique textual identifier or moniker for this nation 
		function __construct()
		{
			$this->classCode = "EntityClass:NAT";
			$this->determinerCode = "EntityDeterminer:INSTANCE";
		}
	}


	/**
	* Student
	*/
	class Student
	{
		private $classCode;//student Role
		private $id; //Student identifier(s) for the focal person in this school enrollment relationship 
		private $code;//Value further specifies the type of student, e.g. full time student or part time student 
		private $addr;//Address(es) for corresponding with the focal person in the context of this school enrollment 
		private $telecom; //Telecommunication address(es) for communicating with the focal person in the context of this school enrollment 
		private $statusCode; // A value specifying the state of this school enrollment (based on the RIM Role class state-machine), for example, active, suspended, terminated 
		private $effectiveTime;//An interval of time specifying the period during which this school enrollment is in effect, if such time limit is applicable and known 
		private $schoolOrganization; //E_OrganizationInformational
		function __construct()
		{
			$this->classCode = "RoleClass:STD";
		}
	}

	/**
	* Member
	*/
	class Member
	{
		private $classCode;
		private $id;
		private $code;
		private $statusCode;
		private $effectiveTime;
		private $group;
		private $subjectOf;
		function __construct()
		{
			$this->group = new Group();
			$this->subjectOf = new Subject3();
		}
	}


 ?>