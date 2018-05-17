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
	
	
	/**
	 * @param $code from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/NullFlavor.html
	 * Desc: Coded data in its simplest form, where only the code is not predetermined. The code system and code system version are fixed by the context in which CS value occurs. CS is used for coded attributes that have a single HL7-defined value set.
	**/
	public function setNullFlavor($code)
	{
		$this->nullFlavor = array('code' => $code, 'codeSystem' => "2.16.840.1.113883.5.1008", 'codeSystemName' => "NullFlavor", 'codeSystemVersion' => "1");
	}


	/**
	 * @param $realCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/hl7Realm.html
	**/
	public function addRealmCode($realmCode)
	{
		if (!is_array($this->realmCode)) {
			$this->realmCode = array();
		}

		$this->realmCode[] = array('code' => $realmCode, 'codeSystem' => "2.16.840.1.113883.5.1124", 'codeSystemName' => "hl7Realm", 'codeSystemVersion' => "1");
	}

	public function setTypeId($typeId)
	{
		$this->typeId = $typeId;
	}

	public function addTemplateId($templateId)
	{
		if (!is_array($this->templateId)) {
			$this->templateId = array();
		}

		$this->templateId[] = $templateId;
	}
}

 ?>