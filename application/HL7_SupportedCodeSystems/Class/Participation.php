<?php 

require_once 'InfrastructureRoot.php';

/**
 * Participation
 * @Definition An association between an Act and a Role. The Entity playing the Role is the actor.
 * @UsageNotes
 		Each Entity involved in an Act is linked to the Act by one Participation-instance. The kind of involvement in the Act is specified by the Participation.typeCode. 
		The Entity's Role interposes between the Entity and the Participation. While Roles represent the competence of an Entity, Participations represent performance, so a Participation is scoped by its specific Act, and only incidentally by its Entity. Conversely, Roles describe an innate quality of an Entity (i.e., how it may principally participate in acts), irrespective of any individual Act. 
		The professional credentials of a person (Role) may be quite different from what a person actually does (Participation). A common example is interns and residents performing anesthesia or surgeries under (more or less) supervision of attending specialists: the role of intern does not specify the nature of the participation. 
		An Act can have multiple participations of the same type: this indicates collaborative activities or group involvement. The notion of multiple performing Participations MAY also be represented as sub-activities (Act components): the presence of multiple actors MAY be represented as an act composed of sub-acts where each act has only one performing actor, or as a single act with many participations. 
		For example, a record of a surgical service may include the actors of type (a) consenter, (b) primary surgeon, and (c) anesthetist, and these three Roles might have separate Participation relationships to the surgery. Alternatively, these three actors really perform different tasks, which can be represented as three related acts: (a) the consent, (b) the surgery proper, and (c) the anesthesia act in parallel to the surgery. If we used the sub-acts, the consenter, surgeon and anesthetist could simply be of actor type "performer." Thus the more sub-acts we use, the fewer different actor types we need to distinguish; conversely, the fewer sub-acts we use, the more distinct actor types (and Participation instances) we need. 
		As a rule of thumb, sub-tasks should be preferred to multiple actors when the sub-tasks require special scheduling, or billing, or if overall responsibilities for the sub-tasks are different. In many cases, however, this detail is not urgent enough to support its collection: human resources are scheduled in teams (rather than as individuals), billing tends to lump sub-tasks together, and overall responsibility often rests with an attending physician, chief nurse, or head of department. While the ActRelationship class supports detailed decomposition, the Participation class supports multi-actor "lumping" of sub-activities into a primary act.
 *Examples
 	 1) Performers of acts (surgeons, observers, practitioners)
	 2) Subjects of acts (patients, devices, materials)
	 3) Locations
	 4) Author, co-signer, witness, informant
	 5) Information recipient
 */
class Participation extends InfrastructureRoot
{
	private $typeCode;
	private $functionCode;
	private $contextControlCode;
	private $sequenceNumber;
	private $priorityNumber;
	private $negationInd;
	private $noteText;
	private $time;
	private $modeCode;
	private $awarenessCode;
	private $signatureCode;
	private $signatureText;
	private $performInd;
	private $substitutionConditionCode;
	private $subsetCode;
	private $quantity;

	//Associations of participation
	private $act;
	private $role;

	function __construct($typeCode = NULL)
	{
		parent::__construct();
		$this->typeCode = $typeCode;
		$this->functionCode = NULL;
		$this->contextControlCode = NULL;
		$this->sequenceNumber = NULL;
		$this->priorityNumber = NULL;
		$this->negationInd = false;
		$this->noteText = NULL;
		$this->time = NULL;
		$this->modeCode = NULL;
		$this->awarenessCode = NULL;
		$this->signatureCode = NULL;
		$this->signatureText = NULL;
		$this->performInd = NULL;
		$this->substitutionConditionCode = NULL;
		$this->subsetCode = NULL;
		$this->quantity = NULL;

		//Associations of participation
		$this->act = NULL;
		$this->role = NULL;
	}

	public function setAct(&$act)
	{
		$this->act = $act;
	}

	public function setRole(&$role)
	{
		$this->role = $role;
	}

	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ParticipationType.html
	 * @Definition The kind of Participation or involvement the Entity playing the Role associated with the Participation has with regard to the associated Act.
	**/
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.90",
			'codeSystemName' => "ParticipationType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $functionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ParticipationFunction.html
	 * Second choice file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#ParticipationFunction
	 * @Definition Additional detail about the function that the Participation has in the Act, if such detail is not implied by the Participation.typeCode.
	 * @UsageConstraint No HL7 standard specification may be written to depend on the functionCode. When such a constraint is deemed necessary, it is to be defined in the Participation.typeCode. 
	 * @UsageNotes
		 This code can accommodate a variety of functions greater than that which can be managed in the tightly controlled typeCode. The numbers and kinds of functions applicable depend on the specific kind of act, e.g., each operation may require a different number of assistant surgeons or nurses. 
		 Since Participation functions refer to what people do in an Act, they are effectively sub-activities that may all occur in parallel. If more detail needs to be captured about these activities than who does them, component acts should be used instead.
	 * Examples First surgeon, second surgeon (or first assistant surgeon, the one facing the primary surgeon), second assistant (often standing next to the primary surgeon), potentially a third assistant, scrub nurse, circulating nurse, nurse assistant, anesthetist, attending anesthetist, anesthesia nurse, technician who positions the patient, postoperative watch nurse, assistants, midwives, students, etc. 
	 * @FormalConstraint This code, if specified, MUST NOT conflict with the Participation.typeCode. 
	**/
	public function setFunctionCode($functionCode)
	{
		$this->functionCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.88",
			'codeSystemName' => "ParticipationFunction",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $contextControlCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ContextControl.html
	 * @DeprecationInformation This attribute is deprecated from further use for RIM versions later than version 2.30. This attribute and those that worked with it have been superseded by the attributes ActRelationship.blockedContextActRelationshipType and ActRelationship.blockedContextParticipationType, together with the "conductible" property on concepts in the ActRelationshipType and ParticipationType code systems. 
	 * @Definition The manner in which this Participation contributes to the context of the current Act, and whether it may be propagated to descendent Acts whose associations allow such propagation (see ActRelationship.contextConductionInd). 
	 * @UsageNotes Refer to ActRelationship.contextControlCode for rationale, discussion and examples.
	**/
	public function setContextControlCode($contextControlCode)
	{
		$this->contextControlCode = array(
			'code' => $contextControlCode,
			'codeSystem' => "2.16.840.1.113883.5.1057",
			'codeSystemName' => "ContextControl",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $sequenceNumber An integer specifying the relative order of occurrence of the Participation in relation to other Participations of the same Act of the same type (same typeCode). 
	 * @UsageNotes Where there is a desire to indicate relative preference rather than order of occurrence, use priorityNumber
	 * @Examples The sequencing of covered party participations to establish a coordination of benefits sequence in insurance claims.
	**/
	public function setSequenceNumber($sequenceNumber)
	{
		$this->sequenceNumber = ($sequenceNumber > 0) ? $sequenceNumber : NULL;
	}


	/**
	 * @Definition An integer specifying the relative preference for considering this relationship before other like-typed (same typeCode) relationships having the same source Act. Relationships with lower priorityNumber values are considered before and above those with higher values. 
	 * @UsageNotes Among alternatives or options that are being chosen by humans, the priorityNumber specifies preference. The ordering may be a total ordering, in which all priority numbers are unique, or a partial ordering, in which the same priority may be assigned to more than one relationship.
	 Use sequence number when there is a need to represent order of occurrence rather than relative preference
	**/
	public function setPriorityNumber($priorityNumber)
	{
		$this->priorityNumber = $priorityNumber;
	}


	/**
	 * @param $negationInd An indicator stipulating that the specified participation did not, does not, or should not occur, depending on mood
	 * @UsageNotes A participation with a negationInd set to true takes precedence over one with a negationInd of false, in the event of a conflict.
	 * @Rationale This attribute has two primary uses: (1) To indicate that a particular Role did not or should not participate in an Act, and (2) To remove a participant from the context being propagated between Acts. 
	 * @Examples Dr. Smith did not participate; Patient Jones did not sign the consent.
	**/
	public function setNegationInd($negationInd = false;)
	{
		$this->negationInd = $negationInd;
	}


	/**
	 * @param $noteText A textual or multimedia depiction of commentary related to the participation. 
	 * @UsageNotes This note is attributed to the immediate participant only.
	**/
	public function setNoteText($noteText)
	{
		$this->noteText = $noteText;
	}


	/**
	 * @param $time array The time during which the participant is involved in the act through this Participation.
	 * UsageNotes
			 the interval form using square brackets, e.g., "[3.5; 5.5["; (where the square brackets denote whether the interval is closed or not. Pointing in means closed, pointing out means not closed) 
			 the dash-form, e.g., "3.5-5.5"; 
			 the "comparator" form, using relational operator symbols, e.g., "<5.5"; 
			 the center-width form, e.g., "4.5[2.0[". 
			 the width-only form using square brackets, e.g., "[2.0[". 
			 the center-only form which is simply the value of the center literal, e.g., "4.5". 
			 the any form which using question marks, e.g., "?4?". 
	 * @Rationale Participation time is needed when the participant's involvement in the act spans only part of the Act's time. This means that Participation.time indicates the time at which certain common sub-activities occur that may not be worth recording in acts, but which are implicitly modeled by the participation type. 
	 * @Examples 
			 1) The time data was entered into the originating system is the Participation.time of the "data entry" participation.
			 2) The end of the Participation.time of an author is the time associated with the signature.
			 3) The period of time during which Dr. Jones was responsible for the patient.
	**/
	public function setTime($time)
	{
		$this->time = $time;
	}


	/**
	 * @param $modeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ParticipationMode.html
	 * @Definition The modality by which the Entity playing the Role is participating in the Act.
	 * @usageNotes For author (originator) participants, this is used to specify whether the information represented by the act was initially provided verbally, (hand-)written, or electronically.
	 * @Examples Physically present, over the telephone, written communication. 
	**/
	public function setModeCode($modeCode)
	{
		$this->modeCode = array(
			'code' => $modeCode,
			'codeSystem' => "2.16.840.1.113883.5.1064",
			'codeSystemName' => "ParticipationMode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $awarenessCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/TargetAwareness.html
	 * @Definition The extent to which the Entity playing the participating Role is aware of the associated Act.
	 * @UsageNotes For diagnostic observations, the patient, family member or other participant may not be aware of the patient's terminal illness. Because this attribute typically indicates that awareness is in question, it normally describes a target Participation (e.g., that of a patient). If the awareness, denial, unconsciousness, etc. is the subject of medical considerations (e.g., part of the problem list), explicit observations should be employed: this simple attribute in the Participation cannot represent information sufficient to support medical decision-making. 
	 * @Examples Fully aware, incapable of comprehension, not informed.
	**/
	public function setAwarenessCode($awarenessCode)
	{
		$this->awarenessCode = array(
			'code' => $awarenessCode,
			'codeSystem' => "2.16.840.1.113883.5.137",
			'codeSystemName' => "TargetAwareness",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $signatureCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ParticipationSignature.html
	 * @Definition Whether the participation has attested participation through a signature, or whether such signature is needed
	 * @UsageNotes See also Participation.signatureText
	 * @Examples A surgical Procedure act object (representing a procedure report) requires a signature of the performing and responsible surgeon, and possibly other participants; The participant intends to provide a signature.
	**/
	public function setSignatureCode($signatureCode)
	{
		$this->signatureCode = array(
			'code' => $signatureCode,
			'codeSystem' => "2.16.840.1.113883.5.89",
			'codeSystemName' => "ParticipationSignature",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $signatureText datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-ED
	 * @Definition A textual or multimedia depiction of the signature by which the participant endorses and accepts responsibility for his or her participation in the Act as specified in the Participation.typeCode. 
	 * @UsageNotes
	 	 The signature can be represented either inline or by reference according to the ED data type. Typical cases are
			1) Paper-based signatures: the ED data type may refer to a document or other resource that can be retrieved through an electronic interface to a hardcopy archive. 
			2) Electronic signature: this attribute can represent virtually any electronic signature scheme.
			3) Digital signature: this attribute can represent digital signatures by reference to a signature data block that is constructed in accordance to a digital signature standard, such as XML-DSIG, PKCS#7, PGP, etc. 
	 * @Examples
	 	 1) An "author" participant assumes accountability for the truth of the Act statement to the best of his knowledge.
		 2) An information recipient only attests to the fact that he or she has received the information.
	**/
	public function setSignatureText($signatureText)
	{
		$this->signatureText = $signatureText;
	}


	/**
	 * @param $performInd An indication that that the resource for this Participation must be reserved before use (i.e., it is controlled by a schedule).
	 * @UsageNotes This attribute serves a very specific need in the context of resource scheduling: it is not needed in the majority of participation expressions. In most circumstances, it applies to the participation of a particular location or piece of equipment whose use is controlled by a scheduler.
	**/
	public function setPerformInd($performInd)
	{
		$this->performInd;
	}


	/**
	 * @param $substitutionConditionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/SubstitutionCondition.html
	 * @Definition The conditions under which a participating item may be replaced with a different one.
	**/
	public function setSubstitutionConditionCode($substitutionConditionCode)
	{
		$this->substitutionConditionCode = array(
			'code' => $substitutionConditionCode,
			'codeSystem' => "2.16.840.1.113883.5.1071",
			'codeSystemName' => "SubstitutionCondition",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $subsetCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipSubset.html
	 * @Definition An indication that the participation is a filtered subset of the total participations of the same type associated with the Act.
	 * @UsageNotes Used when there is a need to limit the participations to the first, the last, the next or some other filtered subset.
	**/
	public function setSubsetCode($subsetCode)
	{
		$this->subsetCode = array(
			'code' => $subsetCode,
			'codeSystem' => "2.16.840.1.113883.5.1099",
			'codeSystemName' => "ActRelationshipSubset",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $quantity Specifies the amount of the player Entity of the Participation's role that is used (applied, administered, consumed, provided, or created) in the Participation's act.
	 * @UsageConstraint Used for situations where a defined quantity of a given entity participates in an Act.
	 * @UsageConstraint Where the Act itself identifies a quantity of a participating entity involved in the act (e.g. SubstanceAdministration.doseQuantity or Supply.quantity), Participation.quantity should not generally be specified. If present, the quantities on the participations must add up exactly to the quantity indicated on the Act.
	 * @UsageConstraint The unit of quantity should make sense for the Entity.code and Material.formCode attributes, where specified, of the target role's playing Entity. For example, "10cm of tubing" is fine, while "10cm of cow" is not.
	 * @UsageConstraint If an Entity quantity is also defined, the Participation.quantity overrides the Entity.quantity. This is useful if one wanted to specify several distinct Acts each of which takes a specified smaller amount from an identified batch of a material. If the Act itself has a quantity, the meaning of that quantity is unchanged. For example, Supply act quantity specifies the quantity ultimately supplied. This may be less than the quantities of the source products going into the supply (e.g., to deal with necessary waste or overages). For Example: mix 10 gram of sugar with 1 teaspoon of salt in 1 liter of water uses the Participation.quantity values 10 g, 1 L, and 1 [tsp_us] on each of the respective Participations while leaving the playing Entities with determiner = KIND and no quantity. 
	 Quantity must be an extensive amount, that is, a count number or an additive quantity, such as mass (1 kg), volume (1 L), amount of substance (1 mol), or another quantity of a kind suitable to describe an amount (catalytic activity). 
	 The Participation quantity can not be larger than the playing Entity quantity if the latter is finite. Especially, when the playing Entity is an individual (e.g., a single person, a single device, indicated by the Entity.quantity being 1, explicitly or implicitly) then the Participation.quantity can not be larger than 1. Also, if the Entity is of an indivisible kind (such as, again, an individual human being or a device) then the quantity can not be smaller than 1. 
	 * @Rationale The purpose of this is to specify precisely the amount of each substance (or other material) to be used in an interaction between multiple substances. 
	 An example use is for a recipe, where specific amounts of multiple things are processed together in an act. A special case - the important one here - is when we describe a chemical reaction with Act. For example, in the reaction: 
		C6(H2O)6 + 6 O2 --> 6 CO2 + 6 H2O 
	 we would specify all 4 molecules as Participations and could use the quantity attribute to place the values 1, 6, 6, and 6 respectively for the molecules. 
	 Prior to this change would need to use the Entity.quantity attribute in each of the participants. However, since the removal of the very confusing determiner "quantified kind", we would have to have 2 Entities for each substance in the reaction: one representing the O2 molecule and one representing the group of 6 O2 molecules. While one can ignore this issue and just put only the 6 O2 molecules out there, conceptually the Entity of any amount, or 1 O2 molecule and that of 6 of these molecules would still be different. It is only a kludge to use the Entity.quantity so conveniently. However, in Participation.quantity it would be very clear.
	 * @Examples  Entity as a component of a recipe, to be supplied or consumed by the act or as a necessary ingredient that remains unchanged by the act. 
	**/
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}

 ?>