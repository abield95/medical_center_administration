<?php 

require_once 'InfrastructureRoot.php';

/**
 * LanguajeCommunication
 * Definition: The language communication capabilities of an Entity.
 * UsageNotes: While it may seem on the surface that this class would be restricted in usage to only the LivingSubject subtypes, Devices also have the ability to communicate, such as automated telephony devices that transmit patient information to live operators on a triage line or provide automated laboratory results to clinicians. 
 * Examples: A patient who originally came from Mexico may have fluent language capabilities to speak, read and write in Spanish, and rudimentary capabilities in English. A person from Russia may have the capability to communicate equally well in spoken language in Russian, Armenian or Ukrainian, and a preference to speak in Armenian. 
 */
class LanguajeCommunication extends InfrastructureRoot
{
	private $languajeCode;
	private $moodCode;
	private $proficiencyLevelCode;
	private $preferenceInd;
	private $entity;

	function __construct(&$entity)
	{
		parent::__construct();
		$this->entity = (object)$entity;
	}


	/**
	 * @param $languajeCode A language for which the Entity has some level of proficiency for communication.
	 * UsageNotes: Communication via spoken or written language is not restricted to LivingSubjects. Devices that communicate with persons using human language also must specify in which languages they are capable. Automated voice response systems respond to human language and communicate with other devices or persons using human language. 
	 * Rationale: Many individuals and devices have the capability to communicate at varying levels in multiple languages. This attribute specifies a language capability that the entity wishes to make known. 
	 * Examples: Spanish, Italian, German, English, American Sign
	**/
	public function setLanguajeCode($languajeCode)
	{
		$this->languajeCode = array(
			'code' => $languajeCode,
			'codeSystem' => "2.16.840.1.113883.1.11.11526",
			'codeSystemName' => "HumanLanguaje",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $moodCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/LanguageAbilityMode.html
	 * Definition: The method of expression of the language
	 * Examples: Expressed spoken, expressed written, expressed signed, received spoken, received written, received signed
	**/
	public function setMoodCode($moodCode)
	{
		$this->moodCode = array(
			'code' => $moodCode,
			'codeSystem' => "2.16.840.1.113883.5.60",
			'codeSystemName' => "LanguageAbilityMode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $proficiencyLevelCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/LanguageAbilityProficiency.html
	 * Definition: The level of proficiency an Entity has in a particular language.
	 * Examples: Excellent, good, fair, poor
	**/
	public function setProficiencyLevelCode($proficiencyLevelCode)
	{
		$this->proficiencyLevelCode = array(
			'code' => $proficiencyLevelCode,
			'codeSystem' => "2.16.840.1.113883.5.61",
			'codeSystemName' => "LanguageAbilityProficiency",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param An indicator specifying whether the language is preferred by the entity for the associated mode.
	**/
	public function setPreferenceInd($preferenceInd)
	{
		$this->preferenceInd = $preferenceInd;
	}
}

 ?>