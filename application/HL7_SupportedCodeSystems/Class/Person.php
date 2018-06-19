<?php 


require_once('LivingSubject.php');

/**
 * Person
 * Definition: A human being.
 * UsageNotes: This class can be used to represent either a single individual, a group of individuals or a kind of individual based on the values of Entity.determinerCode and Entity.quantity. 
 */
class Person extends LivingSubject
{
	private $addr;
	private $maritalStatusCode;
	private $educationLevelCode;
	private $disabilityCode;
	private $livingArrangementCode;
	private $religiousAffiliationCode;
	private $raceCode;
	private $ethnicGroupCode;

	function __construct($determinerCode = NULL)
	{
		parent::__construct();
		$this->seClassCode("PSN");
		$this->setDeterminerCode($determinerCode);

		$this->addr = NULL;
		$this->maritalStatusCode = NULL;
		$this->educationLevelCode = NULL;
		$this->disabilityCode = NULL;
		$this->livingArrangementCode = NULL;
		$this->religiousAffiliationCode = NULL;
		$this->raceCode = NULL;
		$this->ethnicGroupCode = NULL;
	}



	/**
	 * @param $addr The postal or residential address of a person.
	**/
	public function addAddr($addr)
	{
		if (!is_array($this->addr)) {
			$this->addr = array();
		}

		$this->addr[] = $addr;
	}



	/**
	 * @param $maritalStatusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/MaritalStatus.html
	 * Definition: The domestic partnership status of a person.
	**/
	public function setMaritalStatusCode($maritalStatusCode)
	{
		$this->maritalStatusCode = array('code' => $maritalStatusCode, 'codeSystem' => "2.16.840.1.113883.5.2", 'codeSystemName' => "MaritalStatus", 'codeSystemVersion' => "1");
	}


	/**
	 * @param $educationLevelCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EducationLevel.html
	 * Definition: The highest level of education a person achieved.
	**/
	public function setEducationLevelCode($educationLevelCode)
	{
		$this->educationLevelCode = $educationLevelCode;
	}


	/**
	 * @param $disabilityCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/PersonDisabilityType.html
	 * Definition: A person's disability.
	**/
	public function addDisabilityCode($disabilityCode)
	{
		if (!is_array($this->disabilityCode)) {
			$this->disabilityCode = array(
				'codeSystem' => "2.16.840.1.113883.5.93",
				'codeSystemName' => "PersonDisabilityCode",
				'codeSystemVersion' => "1",
				'codes' => array()
			);
		}

		$this->disabilityCode['codes'][] = $disabilityCode;
	}


	/**
	 * @param $religiousAffiliationCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ReligiousAffiliation.html
	 * Definition: The primary religious preference of a person.
	 * Examples: Hinduism, Islam, Roman Catholic Church
	**/
	public function setReligiousAffiliationCode($religiousAffiliationCode)
	{
		$this->religiousAffiliationCode = array('code' => $religiousAffiliationCode, 'codeSystem' => "2.16.840.1.113883.5.1076", 'codeSystemName' => "ReligiousAffiliation", 'codeSystemVersion' => "1");
	}


	/**
	 * @param $raceCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/Race.html
	 * Definition: A code classifying the person into a named category of humans sharing common history, traits, geographical origin or nationality.
	 * UsageNotes: This attribute is based on the belief of the person or the person reporting the attribute, not on any formal analysis of genetic or geneological relationships as these would need to be captured as observations. 
	**/
	public function setRaceCode($raceCode)
	{
		$this->raceCode = array('code' => $raceCode, 'codeSystem' => "2.16.840.1.113883.5.104", 'codeSystemName' => "Race", 'codeSystemVersion' => "1");
	}

	/**
	 * @param $ethnicGroupCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/Ethnicity.html
	 * Definition: A code classifying the person into a named category of humans sharing a common real or presumed heritage.
	 * UsageNotes: This attribute is based on the belief of the person or the person reporting the attribute, not on any formal analysis of genetic, geneological or historical relationships as these would need to be captured as observations. 
	**/
	public function addEthnicGroupCOde($ethnicGroupCode)
	{
		if (!is_array($this->ethnicGroupCode)) {
			$this->ethnicGroupCode = array(
				'codeSystem' => "2.16.840.1.113883.5.50",
				'codeSystemName' => "Ethnicity",
				'codeSystemVersion' => "1",
				'codes' => array()
			);
		}

		$this->ethnicGroupCode['codes'][] = $ethnicGroupCode;
	}
}

 ?>