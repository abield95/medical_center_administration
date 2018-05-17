<?php 

require_once('Entity.php');

/**
 * LivingSubject
 * Definition: An organism, alive or not.
 * Rationale: This class contains administrative attributes of interest to medicine that differentiate living organisms from other Entities.
 * A person, dog, microorganism or a plant of any taxonomic group
 */
class LivingSubject extends Entity
{
	private $administrativeGenderCode;
	private $birthTime;
	private $deceasedInd;
	private $deceasedTime;
	private $multipleBirthInd;
	private $multipleBirthOrderNumber;
	private $organDonorInd;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("LIV");
		$this->administrativeGenderCode = NULL;
		$this->birthTime = NULL;
		$this->deceasedInd = FALSE;
		$this->deceasedTime = NULL;
		$this->multipleBirthInd = FALSE;
		$this->multipleBirthOrderNumber = NULL;
		$this->organDonorInd = FALSE;
	}


	/**
	 * @param $administrativeGenderCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/AdministrativeGender.html
	 * Definition: The gender (i.e., the behavioral, cultural, or psychological traits typically associated with one sex) of a living subject as defined for administrative purposes. 
	 * UsageConstraint: This code is used for administrative purposes.
	 * UsageNotes: This attribute does not include terms related to clinical gender. Gender is a complex physiological, genetic, and sociological concept that requires multiple observations in order to be comprehensively described. The purpose of this attribute is to provide a high-level classification that can also be used for the appropriate allocation of inpatient bed assignment. 
	 This information is reported on UB FL 15.
	 * Examples Male, Female
	**/
	public function setAdministrativeGenderCode($administrativeGenderCode)
	{
		$this->administrativeGenderCode = array(
			'code' => $administrativeGenderCode,
			'codeSystem' => "2.16.840.1.113883.5.1",
			'codeSystemName' => "AdministrativeGender",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * The date and time of a living subject's birth or hatching.
	 * @param $birthTime minimum year, month and day
	 * Example yyyymmddhhmmss
	**/
	public function setBirthTime($birthTime)
	{
		$this->birthTime = $birthTime;
	}


	/**
	 * @param $deceasedInd An indication that the subject is dead, default FALSE
	**/
	public function setDeceasedInd($deceasedInd)
	{
		$this->deceasedInd = $deceasedInd;
	}


	/**
	 * @param $deceasedTime The date and time that a living subject's death occurred.
	**/
	public function setDeceasedTime($deceasedTime)
	{
		if ($this->deceasedInd === TRUE) {
			$this->deceasedTime = $deceasedTime;
		}
	}


	/**
	 * @param $multipleBirthInd An indication as to whether the living subject is part of a multiple birth.
	**/
	public function setMultipleBirthInd($multipleBirthInd)
	{
		$this->multipleBirthInd = $multipleBirthInd;
	}


	/**
	 * @param $multipleBirthOrderNumber The order within a multiple birth in which this living subject was born.
	**/
	public function setMultipleBirthOrderNumber($multipleBirthOrderNumber = 1)
	{
		if ($this->multipleBirthInd === TRUE) {
			$this->multipleBirthOrderNumber = $multipleBirthOrderNumber;
		}
	}

	public function setOrganDonorInd($organDonorInd = false)
	{
		$this->organDonorInd = $organDonorInd;
	}
}


 ?>