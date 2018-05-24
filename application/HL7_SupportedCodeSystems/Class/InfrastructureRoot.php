<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

/**
 * InfrastructureRoot
 * An abstract super-type for all RIM classes, either directly or through inheritance.
 * UsageConstraint: In general, constraint declarations, such as those communicated in this class's attributes, may occur wherever a RIM class or one of its derived clones is instantiated in an HL7 communication. Thus, the attributes MUST be available in all RIM classes and clones. 
 * UsageNotes: Infrastructure Root provides a set of communication infrastructure attributes that may be used in instances of HL7-specified, RIM-based communications. When valued in a communication instance, these attributes indicate whether the information structure is being constrained by specifically defined templates, realms or common communication element types. 
 */
abstract class InfrastructureRoot
{
	private $nullFlavor;
	private $realmCode;//array unordered
	private $typeId;
	private $templateId;//array ordered

	function __construct()
	{
		$this->setNullFlavor('NI');
		$this->realmCode = NULL;
		$this->typeId = NULL;
		$this->templateId = NULL;
	}
	
	
	/**
	 * @param $code from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/NullFlavor.html
	 * @Definition An indicator that the class instance is null, including the flavor of null that is intended.
	 * @OpenIssue Original text stated "and that the remainder of the information for this class and its properties will not be communicated." If the null flavor indicates an inability to represent the value rather than the actual absence of a value (e.g., "PINF"), is this true? Do the values need to be constrained? 
	**/
	public function setNullFlavor($code)
	{
		$this->nullFlavor = array(
			'code' => $code,
			'codeSystem' => "2.16.840.1.113883.5.1008",
			'codeSystemName' => "NullFlavor",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $realCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/hl7Realm.html
	 * @Definition A vocabulary domain qualifier that allows the vocabulary domain of coded attributes to be specialized according to the geographical, organizational, or political environment where the HL7 standard is being used. 
	**/
	public function addRealmCode($realmCode)
	{
		if (!is_array($this->realmCode)) {
			$this->realmCode = array();
		}

		$this->realmCode[] = array(
			'code' => $realmCode,
			'codeSystem' => "2.16.840.1.113883.5.1124",
			'codeSystemName' => "hl7Realm",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $typeId The unique identifier for an HL7 static structure that imposes constraints on the artifact.
	 * @UsageNotes This might be a common type (also known as CMET in the messaging communication environment), or content included within a wrapper.
	**/
	public function setTypeId($typeId)
	{
		$this->typeId = $typeId;
	}


	/**
	 * @param $templateId The unique identifier for a template that imposes constraints on the artifact.
	**/
	public function addTemplateId($templateId)
	{
		if (!is_array($this->templateId)) {
			$this->templateId = array();
		}

		$this->templateId[] = $templateId;
	}
}

 ?>