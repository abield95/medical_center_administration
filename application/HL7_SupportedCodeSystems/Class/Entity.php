<?php 

require_once('InfrastructureRoot');
/**
 *States of Entity
 ** active (sub-state of normal): The state representing the fact that the Entity is currently active.
 ** inactive (sub-state of normal): The state representing the fact that an entity can no longer be an active participant in events.
 ** normal: The "typical" state. Excludes "nullified", which represents the termination state of an Entity instance that was created in error 
 ** nullified: The state representing the termination of an Entity instance that was created in error.
 ********************************************
 * State Transition for Entity
 * create 		(null 		->	active)
 * inactivate 	(active 	->	inactive)
 * nullify 		(normal 	->	nullified)
 * reactivate 	(inactive 	->	active)
 * revise 		(active 	->	active)
 * revise 		(inactive 	->	inactive)
**/

/**
 * Entity
 * Def: A physical thing, group of physical things or an organization capable of participating in Acts while in a role.
 * Usage Notes: An entity is a physical object that has, had or will have existence. The only exception to this is Organization, which while not having a physical presence, fulfills the other characteristics of an Entity. Entity stipulates the thing itself, not the Roles it may play: the Role of Patient, e.g., is played by the Person Entity. 
 * Example: Living subjects (including human beings), organizations, materials, places and their specializations.
 **/
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
	private $existenceTime;
	private $telecom;
	private $riskCode;
	private $handlingCode;

	//associations of entity
	private $communicationFunction;//0...*
	private $playedRole;//0...*
	private $scopedRole;//0...*
	private $languajeCommunication;//0...*

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("ENT");
		$this->determinerCode = NULL;
		$this->id = NULL; //unordered array
		$this->code = NULL;
		$this->quantity = NULL;
		$this->name = NULL;
		$this->desc = NULL;
		$this->statusCode = NULL;
		$this->existenceTime = NULL;
		$this->telecom = NULL;
		$this->riskCode = NULL;
		$this->handlingCode = NULL;

	//associations of entity
		$this->communicationFunction = NULL;//0...*
		$this->playedRole = NULL;//0...*
		$this->scopedRole = NULL;//0...*
		$this->languajeCommunication = NULL;//0...*
	}
	

	/**
	 * @param $classCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityClass.html
	**/
	public function setClassCode($classCode)
	{
		$this->classCode = array(
			'code' => $classCode,
			'codeSystem' => "2.16.840.1.113883.5.41",
			'codeSystemName' => "EntityClass",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $determinerCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityDeterminer.html
	 * Definition: A code specifying whether the Entity object represents a universal (KIND) vs. a particular (INSTANCE).
	 * Rationale: An Entity may at times represent information concerning a specific instance (the most common) or a general type of Entity.
	 * Example: One human being (instance); or citizens of Indianapolis (kind)
	**/
	public function setDeterminerCode($determinerCode)
	{
		$this->determinerCode = array(
			'code' => $determinerCode,
			'codeSystem' => "2.16.840.1.113883.5.30",
			'codeSystemName' => "EntityDeterminer",
			'codeSystemVersion' => "1"
		);
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
		$this->code = array(
			'code' => $code,
			'codeSystem' => "2.16.840.1.113883.5.1060",
			'codeSystemName' => "EntityCode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $quantity number
	 * @param $unit Unidied Code for Unirs of Measure (UCUM)
	 * Definition: A physical quantity specifying the amount of the physical thing represented by the Entity object, either as a count of the members of a group, or as some other physical quantity. Describes the amount of the Entity, irrespective of potential Participations of the Entity as a whole or in parts. In order to explicitly identify a group of like entities, a static model design should constrain the PQ data type of this attribute to INT, thus providing a count of the entities in the group. 
	 * UsageConstraints: The unit of quantity should make sense for the Entity.code and Material.formCode attributes where specified. For example, "10cm of tubing" is fine, while "10cm of cow" is not.
	 * UsageConstraint: Entity quantity should only be used for specifically identified Entities (such as the contents of beer keg #XP27-35) or in cases where the quantity is an intrinsic part of the specification of the entity (such as a specific portion of phosgene). 
	 * UsageNotes: Just as the name of a Person may change, or even its gender, the quantity of any entity can be subject to change too. With material and bulk living subjects it is possible for the quantity to gradually diminish, or, for such an Entity to be portioned out into smaller amounts of the same kind of Entity (e.g. aliquoting in a laboratory or distributing a production lot in smaller amounts.) In the case of this portioning out of an amount into smaller amounts, the initial Entity instance of the large amount may cease to exist, yet the portions may still be traceable to the initial Entity of the large amount (as in patient for a specimen aliquot or lot for a vaccine). 
	  -->Specifying Entity.quantity is often not necessary as one can specify quantity in relation to other Entities (Role.quantity), participations (Participation.quantity), and and in Acts which consume or produce such Entity (e.g. SubstanceAdministration.doseQuantity, Supply.quantity). 
	  * Examples: 1 human being, 2 cats, 500 cows, 20 mL of blood, 1 kg of yeast, 154 mmol of sodium chloride.
	**/
	public function setQuantity($quantity = 1, $unit = "NONE")
	{
		$this->quantity = array(
			'quantity' => $quantity,
			'unit' => $unit
		);
	}


	/**
	 * @param $name
	 * A non-unique textual identifier or moniker for the Entity.
	 * Rationale: Most entities have a commonly used name that can be used to differentiate them from other Entities, but that does not provide a necessarily unique identifier.
	 * Examples: Proper names, nicknames, legal names of persons, places or things.
	**/
	public function setName($name)
	{
		$this->name = $name;
	}



	/**
	 * @param $desc A textual or multimedia depiction of the Entity.
	 * UsageNotes: The content of the description is not considered part of the functional information communicated between systems. Descriptions are meant to be shown to interested human individuals. All information relevant for automated functions must be communicated using the proper attributes and associated objects.
	 * Rationale: Names and descriptions of entities are typically more meaningful to human viewers than numeric, mnemonic or abbreviated code values. The description allows for additional context about the entity to be conveyed to human viewers without affecting the functional components of the message.
	**/
	public function setDesc($desc)
	{
		$this->desc = $desc;
	}


	/**
	 * @param $statusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityStatus.html
	 * Definition: A value representing whether the information associated with an Entity is currently active or inactive for the purpose of participation in acts. 
	 * UsageNotes: This attribute was defined in the original RIM as repeating, owing to the presence of nested states in the state machines. In actual practice, however, there is never a need to communicate more than a single status value. Therefore, committees are advised to constrain this attribute to a maximum cardinality of 1 in all message designs. 
	**/
	public function setStatusCode($statusCode)
	{
		$this->statusCode = array(
			'code' => $code,
			'codeSystem' => "2.16.840.1.113883.5.1061",
			'codeSystemName' => "EntityStatus",
			'codeSystemVersion' => "1"
		);
	}

	/**
	 * @param $existenceTime interval of point time, array
	 * Example: yyyymmddhhmmss
	 * Definition: An interval of time specifying the period in which the Entity physically existed.
	 * UsageNotes: Physical entities have specified periods in which they exist. Equipment is manufactured, placed in service, retired and salvaged. The relevance of this attribute is in planning, availability and retrospective analysis. This period may represent past, present or future time periods. 
	 * Examples: ManufactureDate / DisposalDate
	**/
	public function setExistenceTime($existenceTime)
	{
		$this->existenceTime[] = $existenceTime;
	}


	/**
	 * @param $telecom A telecommunication address for the Entity.
	**/
	public function addTelecom($telecom)
	{
		if (!is_array($this->telecom)) {
			$this->telecom = array();
		}

		$this->telecom[] = $telecom;
	}



	/**
	 * @param $riskCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityRisk.html
	 * Definition: The type of hazard or threat associated with the Entity.
	 * Examples: Petrochemical or organic chemicals are highly flammable agents that pose an increased risk of fire under certain conditions. Entities with either natural or introduced radioactive character pose a risk to those handling them. Entities comprising specimens from diseased individuals pose an increased risk of infection to those handling them. Persons or animals of irascible temperament may prove to be a risk to healthcare personnel. 
	**/
	public function addRiskCode($riskCode = NULL)
	{
		if (is_null($riskCode)) {
			$this->riskCode = $riskCode;
			return;
		}
		if (!is_array($this->riskCode)) {
			$this->riskCode = array();
		}

		$this->riskCode[] = array(
			'code' => $riskCode,
			'codeSystem' => "2.16.840.1.113883.5.46",
			'codeSystemName' => "EntityRisk",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $handlingCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EntityHandling.html
	 * Definition: A value representing special handling requirements for the Entity.
	 * UsageNotes: This attribute is used to describe required special handling.
	 * Examples: Keep at room temperature; Keep frozen below 0 C; Keep in a dry environment; Keep upright.
	**/
	public function addHandlingCode($handlingCode = NULL)
	{
		if (is_null($handlingCode)) {
			$this->handlingCode = $handlingCode;
			return;
		}
		if (!is_array($this->handlingCode)) {
			$this->handlingCode = array();
		}

		$this->handlingCode[] = array(
			'code' => $handlingCode,
			'codeSystem' => "2.16.840.1.113883.5.42",
			'codeSystemName' => "EntityHandling",
			'codeSystemVersion' => "1"
		);
	}



	//associations funtions
	public function addCommunicationFunciton()
	{
		if (!is_array($this->communicationFunction)) {
			$$this->communicationFunction = array();
		}
		$communicationFunction = new CommunicationFunction();
		$communicationFunction->setEntity($this);
		$this->languajeCommunication[] = $communicationFunction;
	}

	public function addLanguajeCommunication()
	{
		if (!is_array($this->languajeCommunication)) {
			$this->languajeCommunication = array();
		}
		$this->languajeCommunication[] = new LanguajeCommunication($this);
	}
}

 ?>