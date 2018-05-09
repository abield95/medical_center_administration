<?php 

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

/**
 * Entity
 * Def: A physical thing, group of physical things or an organization capable of participating in Acts while in a role.
 * Usage Notes: An entity is a physical object that has, had or will have existence. The only exception to this is Organization, which while not having a physical presence, fulfills the other characteristics of an Entity. Entity stipulates the thing itself, not the Roles it may play: the Role of Patient, e.g., is played by the Person Entity. 
 * Example: Living subjects (including human beings), organizations, materials, places and their specializations.
 */
class Entity extends InfrastructureRoot
{
	private $classCode;
	private $determinerCode;
	private $id; //unordered array
	private $code;
	private $quantity;
	private $name;
	private $desc;
	private $statusCode;
	

	/**
	 * @param $classCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityClass.html
	**/
	public function setClassCode($classCode)
	{
		$this->classCode = array('code' => $classCode, 'codeSystem' => "2.16.840.1.113883.5.41", 'codeSystemName' => "EntityClass", 'codeSystemVersion' => "1");
	}


	/**
	 * @param $determinerCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityDeterminer.html
	 * Definition: A code specifying whether the Entity object represents a universal (KIND) vs. a particular (INSTANCE).
	 * Rationale: An Entity may at times represent information concerning a specific instance (the most common) or a general type of Entity.
	 * Example: One human being (instance); or citizens of Indianapolis (kind)
	**/
	public function setDeterminerCode($determinerCode)
	{
		$this->determinerCode = array('code' => $determinerCode, 'codeSystem' => "2.16.840.1.113883.5.30", 'codeSystemName' => "EntityDeterminer", 'codeSystemVersion' => "1");
	}


	/**
	 * Definition: A unique identifier for the entity
	 * Usage Notes: An instance identifier is a unique identifier, not a classifier. For Materials, serial numbers assigned by specific manufacturers, catalog numbers of specific distributors, or inventory numbers issued by owners, may better be represented by the Role.id, which allows a more clear expression of the fact that such a code is assigned by a specific party associated with that material. 
	 * Rationale: Successful communication only requires that an entity have a single identifier assigned to it. However, as different systems maintain different databases, there may be different instance identifiers assigned by different systems.
	 * @param $id id for the instance
	**/
	public function addId($id)
	{
		if (!is_array($this->id)) {
			$this->id = array();
		}

		$this->id[] = $id;
	}


	/**
	 * @param $code from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityCode.html
	 * Definition: The specific kind of Entity to which an Entity-instance belongs
	 * UsageNotes: For each Entity, the value for this attribute is drawn from one of several coding systems as suggested by the Entity.classCode, such as living subject (animal and plant taxonomies), chemical substance (e.g., IUPAC code), organization (e.g., CMS provider number), etc. It is possible that Entity.code may be so fine grained that it represents a single instance. An example is the CDC vaccine manufacturer code, modeled as a concept vocabulary, when in fact each concept refers to a single instance. The boundary cases distinguishing codes and identifiers are controversial: this specification allows a certain amount of flexibility. 
	 * Examples: A medical building, a Doberman Pinscher, a blood collection tube, a tissue biopsy.
	**/
	public function setCode($code)
	{
		$this->code = array('code' => $code, 'codeSystem' => "2.16.840.1.113883.5.1060", 'codeSystemName' => "EntityCode", 'codeSystemVersion' => "1");
	}


	/**
	 * @param $quantity
	**/
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}

 ?>