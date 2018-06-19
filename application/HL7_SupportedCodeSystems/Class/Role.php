<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'InfrastructureRoot.php';

//remember include RoleHeir

/**
 * State Machine for Role (state Attribute is statusCode)
 ******** States of Role ************
	 * active (sub-state of normal): 
		 ->The state representing the fact that the Entity is currently active in the Role.
	 * cancelled (sub-state of normal): 
		 ->The terminal state resulting from cancellation of the role prior to activation.
	 * normal: 
		 ->The "typical" state. Excludes "nullified", which represents the termination of a Role instance that was created in error.
	 * nullified: 
		 ->The state representing the termination of a Role instance that was created in error
	 * pending (sub-state of normal): 
		 ->The state representing that fact that the role has not yet become active.
	 * suspended (sub-state of normal): 
		 ->The state that represents the suspension of the Entity playing the Role. This state is arrived at from the "active" state.
	 * terminated (sub-state of normal): 
		 ->The state representing the successful termination of the Role.

 ********** State Transition of Role *********
	 * activate		(pending 	-> active)
	 * cancel		(pending 	-> cancelled)
	 * create		(null 		-> active)
	 * create		(null 		-> pending)
	 * nullify		(normal 	-> nullified)
	 * reactivate	(terminated -> active) 
	 * resume 		(suspended 	-> active) 
	 * revise 		(active 	-> active) 
	 * revise 		(pending 	-> pending) 
	 * revise 		(suspended 	-> suspended) 
	 * revise 		(terminated -> terminated) 
	 * suspend 		(active 	-> suspended) 
	 * terminate 	(active 	-> terminated) 
	 * terminate 	(suspended 	-> terminated) 
**/


/**
 * Role
 * Definition: A competency of the Entity that plays the Role as identified, defined, guaranteed, or acknowledged by the Entity that scopes the Role.
 * UsageNotes: An Entity participates in an Act in the guise of a particular Role. Note that a particular entity in a particular role can participate in an act in different ways. Thus, a Person in the role of a practitioner can participate in a patient encounter as a rounding physician or as an attending physician. The Role defines the competency of the Entity irrespective of any Act, unlike Participations, which are limited to the scope of an Act. 
 Each role is "played" by one Entity, called the "player" and is "scoped" by another Entity, called the "scoper". Thus the Role of "patient" may be played by a person and scoped by the provider organization from which the patient will receive services. Similarly, the employer scopes the "employee" role. 
 The identifier of the Role identifies the Entity playing the role in that role. This identifier is assigned by the scoper to the player. The scoper NEED NOT have issued the identifier, but MAY have re-used an existing identifier. 
 Most attributes of Role are attributes of the playing entity while in the particular role.
 **/
class Role extends InfrastructureRoot
{
	private $classCode;
	private $id;
	private $code;
	private $negationInd;
	private $name;
	private $addr;
	private $telecom;
	private $statusCode;
	private $effectiveTime;
	private $certificateText;
	private $confidentialityCode;
	private $quantity;
	private $priorityNumber;
	private $positionNumber;

	//associations
	private $player;// 0..1 Entity::playedROle(0..*)
	private $scoper;//0..1 Entity::scopedROle(0..*)
	private $inboundLink;//0..*RoleLink::target(1...1)
	private $outboundLink;//0..* ROleLink::source(1...1)
	private $participation;//0..*Participation::role(1..1)

	function __construct($classCode = NULL)
	{
		parent::__construct();
		$this->classCode = $classCode;
		$this->id = NULL;
		$this->code = NULL;
		$this->negationInd = NULL;
		$this->name = NULL;
		$this->addr = NULL;
		$this->telecom = NULL;
		$this->statusCode = NULL;
		$this->effectiveTime = NULL;
		$this->certificateText = NULL;
		$this->confidentialityCode = NULL;
		$this->quantity = NULL;
		$this->priorityNumber = NULL;
		$this->positionNumber = NULL;

	//associations
		$this->player = NULL;// 0..1 Entity::playedROle(0..*)
		$this->scoper = NULL;//0..1 Entity::scopedROle(0..*)
		$this->inboundLink = NULL;//0..*RoleLink::target(1...1)
		$this->outboundLink = NULL;//0..* ROleLink::source(1...1)
		$this->participation = NULL;//0..*Participation::role(1..1)
	}


	/**
	 * @param $classCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RoleClass.html
	 * Definition: The major class of Role to which a Role-instance belongs.
	 This attribute provides a tightly controlled vocabulary of Role class "types" that is balloted with the RIM, and can be used to represent a type enumeration that might have been represented as a physical class in the RIM, but was not because while it had unique meaning, it did not require unique attributes or unique patterns of associations. The "code" attribute defines a specific sub-type of this Role type, and is intended to allow use of rich terminologies to represent these sub-types. 
	**/
	public function setClassCode($classCode)
	{
		$this->classCode = array(
			'code' => $classCode,
			'codeSystem' => "2.16.840.1.113883.5.110",
			'codeSystemName' => "RoleClass",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $id A unique identifier for the player Entity in this Role.
	**/
	public function addId($id)
	{
		if (!is_array($this->id)) {
			$this->id = array();
		}

		$this->id[] = $id;
	}


	/**
	 * @param $code from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#RoleCode
	 * Definition: The specific kind of Role to which an Role-instance belongs.
	 * UsageConstraint: Role.code must conceptually be a proper specialization of Role.classCode.
	 * UsageNotes: Role.code does not modify Role.classCode. Rather, each is a complete concept or a Role-like relationship between two Entities, but Role.code may be more specific than Role.classCode. 
	 This attribute defines a specific sub-type of a given Role type (determined by the "classCode" attribute). It allows the use of rich terminologies to represent sub-types of the limited set of Role types defined by "classCode." 
	**/
	public function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * @param $negationInd An indicator specifying that the Role is a competency that is specifically not attributed to the Entity playing the Role.
	 * Examples: 	1) This Person is not our Employee 
					2) This Mouthwash does not have Alcohol as an ingredient. 
	**/
	public function setNegationInd($negationInd)
	{
		$this->negationInd = $negationInd;
	}


	/**
	 * @param $name A non-unique textual identifier or moniker for the playing Entity intended for use principally when playing the Role.
	 * UsageNotes: In general, names are specified using Entity.name. Role.name is only used when the standard wishes to distinguish names that are appropriate for use when referring to the Entity in one Role as opposed to other Roles..
	 * Examples: Names used as an employee, as a licensed professional, etc.
	**/
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * @param $addr A postal address for the Entity while in the Role
	**/
	public function addAddr($addr)
	{
		if (!is_array($this->addr)) {
			$this->addr = array();
		}

		$this->addr[] = $addr;
	}


	/**
	 * @param $telecom A telecommunication address for the Entity while in the Role
	**/
	public function addTelecom($telecom)
	{
		if (!is_array($this->telecom)) {
			$this->telecom = array();
		}

		$this->telecom[] = $telecom;
	}


	/**
	 * @param $statusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RoleStatus.html
	 * @Definition: The state of this Role as defined in the state-transition model.
	 * @UsageNotes: This attribute was defined in the original RIM as repeating, owing to the presence of nested states in the state machines. In practice, however, there is never a need to communicate more than a single status value. Therefore, committees are advised to constrain this attribute to a maximum cardinality of 1 in all message designs. 
	**/
	public function setStatusCode($statusCode)
	{
		$this->statusCode = array(
			'code' => $statusCode,
			'codeSystem' => "2.16.840.1.113883.5.1068",
			'codeSystemName' => "RoleStatus",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $effectiveTime An interval of time specifying the period during which the Role is in effect, if such time limit is applicable and known.
	**/
	public function setEffectiveTime($effectiveTime)
	{
		$this->effectiveTime = $effectiveTime;
	}


	/**
	 * @param $certificateText file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-ED
	 * Definition: A textual or multimedia depiction of a certificate issued by the scoping Entity of a Role certifying that this Role is indeed played by the player Entity.
	 * @UsageNotes: The certificate subject is the Entity that plays the Role. The certificate issuer is the Entity that scopes the Role. The certificate can be represented in many different ways, either inline or by reference, according to the ED data type.
	 * Examples:
	 		1) Paper-based certificate: a document or file that can be retrieved through an electronic interface to a hardcopy archive. 
			2) Electronic certificate: this attribute can represent virtually any electronic certification scheme, such as an electronically (including digitally) signed electronic text document. 
			3) Digital certificate (public key certificate): in particular, this attribute can represent digital certificates, as an inline data block or by reference to such data. The certificate data block would be constructed in accordance to a digital certificate standard, such as X509, SPKI, PGP, etc. 
	**/
	public function setCertificateText($certificateText)
	{
		$this->certificateText = $certificateText;
	}


	/**
	 * @param $confidentialityCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/Confidentiality.html
	 * @Definition: Privacy metadata classifying a Role according to its level of sensitivity, which is typically based on a jurisdictional or organizational analysis of applicable privacy policies and the risk of financial, reputational, or other harm to an individual or entity that could result if made available or disclosed to unauthorized individuals, entities, or processes. 
	 * @UsageNotes: 
	 	Confidentiality codes may be used in security labels and privacy markings to classify a Role based on its level of sensitivity in order to indicate the obligation to ensure that the information conveyed by the Role is not made available or redisclosed to individuals, entities, or processes (security principals) per applicable policies. Confidentiality codes may also be used in the clearance of initiators requesting access to protected resources. 
	 	Confidentiality codes may be used by access control systems to match the classification of an initiator's clearance to the classification of the information conveyed by a Role class; e.g., the confidentialityCode is used to convey the classification clearance level required to access information about a provider of sensitive reproductive services. 
	 	In order for the matching logic to determine dominance of a clearance, which is required to access classified information, the confidentiality codes must cover the breadth and depth needed to support implementation of privacy and access control policies. More specifically, the confidentiality codes must be in a comprehensive set going from least to most confidential, and the set of codes must be "complete", that is, there can be no missing or overlapping levels of confidentiality from a policy perspective. 
	 	This use should be considered in selecting the value set bound to this attribute, and the binding should be done as Coded No Extensibility (CNE) to allow for such processing. 
	 	Map: Definition aligns with ISO 7498-2:1989 – "Confidentiality is the property that information is not made available or disclosed to unauthorized individuals, entities, or processes." 
	**/
	public function setConfidentialityCode($confidentialityCode)
	{
		$this->confidentialityCode = array(
			'code' => $confidentialityCode,
			'codeSystem' => "2.16.840.1.113883.5.25",
			'codeSystemName' => "Confidentiality",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $quantity A ratio (numerator : denominator) where the numerator specifies the amount of the Entity playing the Role and the denominator specifies the amount of the Entity scoping the Role. Thus, the ratio specifies the relative amount of the "contained" entity in the "containing" entity.
	 * @UsageConstraint: Used for Roles that represent composition relationships between the scoping and playing Entities. Restrict class codes that are members of value set RoleClassPartitive (2.16.840.1.113883.1.11.10429)
	 * @UsageConstraint: The units of numerator and denominator should make sense for the Entity.code and Material.formCode attributes of the playing and scoping entities. Usually these will be either unitless (e.g. 10 people in 1 committee) or will represent mass, amount-of-substance or volume. The units of the numerator and denominator need not be the same. E.g. 10mg per 5mL. 
	 * @UsageNotes: The ratio always represents a relative quantity. I.e. a Role.quantity of 5mg per 10mL never implies that there is exactly 5mg of the player or 10mL of the scoper. The exact quantities of the Entities must be determined by examining Entity.quantity, or the participation or Act quantity attributes referencing the scoping Entity. For example, if the SubstanceAdministration.doseQuantity is "5mL" with a consumable of a syrup entity having an active ingredient role with a quantity of 5mg per 10mL, then the Act is dealing with 5mL of syrup containing 2.5mg of the active ingredient.
	 * @UsageNotes: In composition-relationships (e.g., has-parts, has-ingredient, has-content) the Role.quantity attribute specifies that a numerator amount of the target entity is comprised by a denominator amount of the source entity of such composition-relationship. For example, if a box (source) has-content 10 eggs (target), the relationship quantity is 10:1; if 0.6 mL contain 75 mg of FeSO4 the ingredient relationship quantity is 75 mg : 0.6 mL. Both numerator and denominator must be amount quantities (extensive quantities, i.e., a count number, mass, volume, amount of substance, amount of energy, etc.).
	 * @Examples: 
	 		1) This syrup's (scoper) ingredients include 160 mg (numerator) Acetaminophen (player) per tablespoon (denominator).
			2) This herd (scoper) consists of 500 (numerator) cattle (player).
			3) This package (scoper) contains 100 (numerator) pills (player).
			4) This tablet (scoper) contains 500 mg (numerator) acetylsalicylic acid (player).
	**/
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}



	/**
	 * @param $priorityNumber An integer specifying the relative preference for considering this role instance before other like-typed Roles (same classCode and code) having the same scoper. Roles with lower priorityNumber values are considered before and above those with higher values. 
	 * @UsageNotes: Applicable only when considering playing entities with respect to a particular scoping entity. It has no meaning in other circumstances. Among alternatives or options that are being chosen by humans, the priorityNumber specifies preference. The ordering may be a total ordering, in which all priority numbers are unique, or a partial ordering, in which the same priority may be assigned to more than one role. 
	**/
	public function setPriorityNumber($priorityNumber)
	{
		$this->priorityNumber = $priorityNumber;
	}


	/**
	 * @param $positionNumber An integer specifying the position of the Entity playing the Role with respect to the Entity that scopes the Role.
	 * @UsageNotes 
		 This attribute is primarily used with containment roles. For example, some containers have discrete positions in which content may be located. Depending on the geometry of the container, the position may be referenced as a scalar ordinal number, or as a vector of ordinal numbers (coordinates). Coordinates always begin counting at 1. 
		 Some containers may have customary ways of referring to the positions; some have no way at all. In the absence of any specific regulation for a specific container type, the rule of thumb is that the coordinate that is changed first is positioned first. For an automated blood chemistry analyzer with a square shaped tray, this means that the first coordinate represents the direction the tray moves at each step, while the second coordinate represents the direction in which the tray moves only periodically. 
	**/
	public function setPositionNumber($positionNumber)
	{
		if (is_array($this->positionNumber)) {
			$this->positionNumber[] = $positionNumber;
		}
		else{
			$this->positionNumber = $positionNumber;
		}
	}




	/**
	 * Associations of Role
	**/


	/**
	 * @param $entity type Entity
	**/
	public function setPlayer(&$player)
	{
		if (!is_a($player, 'Entity')) {
			return false;
		}
		$this->player = $player;
	}


	/**
	 * @param $entity type Entity
	**/
	public function setScoper(&$scope)
	{
		if (!is_a($scoper, 'Entity')) {
			return false;
		}
		$this->scoper = $scoper;
	}


	/**
	 * @param $inboundLinl type RoleLink
	**/
	public function setInboundLink(&$inboundLink)
	{
		if (!is_a($inboundLink, 'RoleLink')) {
			return false;
		}
		$this->inboundLink = $inboundLink;	
	}


	public function setOutboundLink(&$outboundLink)
	{
		if (!is_a($outboundLink, 'RoleLink')) {
			return false;
		}
		$this->outboundLink = $outboundLink;
	}

	public function setParticipation(&$participation)
	{
		if (!is_a($participation, 'Participation')) {
			return false;
		}

		$participation->setRole($this);
	}
}


 ?>