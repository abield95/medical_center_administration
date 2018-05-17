<?php 

require_once('LivingSubject.php');

/**
 * NonPersonLivingSubject
 * Definition: A subtype of LivingSubject that includes all living things except the species homo sapiens.
 * Rationale: Living organisms may require additional characterizing information, such as genetic strain identification, that cannot be conveyed in the Entity.code. 
 * Examples: Cattle, birds, bacteria , plants, molds and fungi 
 */
class NonPersonLivingSubject extends LivingSubject
{
	private $strainText;
	private $genderStatusCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("NLIV");
		$this->strainText = NULL;
		$this->genderStatusCode = NULL;
	}


	/**
	 * @param $strainText
	 * Definition: The specific genotypic or phenotypic variant of a Non-Person Living Subject
	 * Rationale: There is no universal guideline for the naming or cataloging of strains. Many strain designations are created and eliminated over time, while some become established in various industries for a variety of reasons (vaccine production, breeding stock popularity, etc). However, the ability for anyone who cares to designate an organism as a "new" strain precludes this field from being a coded value. Descriptive text is required to capture these designations.. 
	 * Examples: Minnesota5 (swine strain), DXL (poultry strain), RB51 (vaccine strain of Brucella abortus)
	**/
	public function setStrainText($strainText)
	{
		$this->strainText;
	}


	/**
	 * @param $genderStatusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/GenderStatus.html
	 * Definition: The state of the primary reproductive organs of a non-person living subject.
	**/
	public function setGenderStatusCode($genderStatusCode)
	{
		$this->genderStatusCode = array(
			'code' => $genderStatusCode,
			'codeSystem' => "2.16.840.1.113883.5.51",
			'codeSystemName' => "GenderStatus",
			'codeSystemVersion' => "1"
		);
	}
}


 ?>