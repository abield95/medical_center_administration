<?php 

require_once 'InfrastructureRoor.php';

/**
 * ActRelationship
 * @Definition A directed association between a source Act and a target Act. 
 * @UsageNotes 
 		 The ActRelationship class is used to construct systems of acts to represent complex observations, action plans, and to represent clinical reasoning or judgments about action relationships. Prior actions can be linked as the reasons for more recent actions. Supporting evidence can be linked with current clinical hypotheses. Problem lists and other networks of related judgments about clinical events are represented by the ActRelationship link. 
		 Every ActRelationship instance is like an arrow with a point (headed to the target) and a butt (coming from the source). The functions that source and target Acts play in that association are defined for each ActRelationship type differently. For instance, in a composition relationship, the source is the composite and the targets are the components. In a reason-relationship the source is any Act and the target is the reason or indication for the source-Act. 
		 The relationships associated with an Act are considered properties of the source act object. This means that the author of an Act-instance is also considered the author of all of the act relationships that have this Act as their source, (though not necessarily of the target Acts of those relationships). There are no exceptions to this rule. 
		 The meaning and purpose of an ActRelationship is specified in the ActRelationship.typeCode attribute.
 * @Examples
 	 has component, fulfills, has reason. More specifically:
		 1) An electrolyte observation panel may have sodium, potassium, pH, and bicarbonate observations as components. The composite electrolyte panel would then have 4 outbound ActRelationships of type "has component," which would be inbound to their target sodium, potassium, pH, and bicarbonate observations. 
		 2) The electrolyte panel event has been performed in fulfillment of an observation order. The electrolyte panel event has an outbound ActRelationship of type "fulfills" with the order as target. 
		 3) A Procedure "cholecystectomy" may be performed for the reason of an Observation of "cholelithiasis." The procedure has an outbound ActRelationship of type "has reason," which would be inbound to the cholelithiasis observation. 
 */
class ActRelationship extends InfrastructureRoot
{
	private $typeCode;
	private $inversionInd;
	private $blockedContextActRelationshipType;
	private $blockedContextParticipationType;
	private $actAttributeContextBlockedInd;
	private $contextControlCode;
	private $contextConductionInd;
	private $sequenceNumber;
	private $priorityNumber;
	private $pauseQuantity;
	private $checkpointCode;
	private $splitCode;
	private $joinCode;
	private $negationInd;
	private $conjunctionCode;
	private $localVariableName;
	private $seperatableInd;
	private $subsetCode;
	private $uncertaintyCode;

	//associations of ActRelationship
	private $target;//Act::inboundRelationship
	private $source;//Act::outboundRelationship

	function __construct()
	{
		parent::__construct();
		$this->typeCode = NULL;
		$this->inversionInd = FALSE;
		$this->blockedContextActRelationshipType = NULL;
		$this->blockedContextParticipationType = NULL;
		$this->actAttributeContextBlockedInd = FALSE;
		$this->contextControlCode = "DEPRECATED";//Deprecated
		$this->contextConductionInd = "DEPRECATED";
		$this->sequenceNumber = NULL;
		$this->priorityNumber = NULL;
		$this->pauseQuantity = NULL;
		$this->checkpointCode = NULL;
		$this->splitCode = NULL;
		$this->joinCode = NULL;
		$this->negationInd;
		$this->conjunctionCode;
		$this->localVariableName;
		$this->seperatableInd;
		$this->subsetCode;
		$this->uncertaintyCode;

		//associations of ActRelationship
		$this->target;//Act::inboundRelationship
		$this->source;//Act::outboundRelationship
	}


	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipType.html
	 * @Definition The meaning and purpose of the ActRelationship instance. 
	 * @UsageNotes from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/rim/rim.html#ActRelationship-typeCode-att
	**/
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.1002",
			'codeSystemName' => "ActRelationshipType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $inversionInd An indicator specifying that the ActRelationship.typeCode should be interpreted as if the roles of the source and target Acts were reversed. 
	 * @DesignComments Define Default annotation. Clarify why an indicator would be preferable to swapping source and target.
	**/
	public function setInversionInd($inversionInd = FALSE)
	{
		$this->inversionInd = $inversionInd;
	}


	/**
	 * @param $blockedContextActRelationshipType from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipType.html
	 * @Definition Identifies the type(s) of ActRelationships that are not permitted to conduct across this ActRelationship.
	 * @UsageConstraint This attribute can only be used if the serializable model in which it appears has a contextConductionStyle property of "V (vocabulary-based)". 
	 * @UsageNotes If one or more codes are specified, all other ActRelationships with typeCodes that match one of the specified codes or that are specializations of one of the specified codes will not conduct. All other ActRelationships with typeCodes having a "conductible" property of "true" or whose ancestor has a "conductible" property of "true" will conduct. Conducted ActRelationships behave such that the Act being navigated to is treated as though it had the same association(s) as the Act being navigated from. Refer to the Core Principles specification for more information.
	**/
	public function addBlockedContextActRelationshipType($blockedContextActRelationshipType)
	{
		if (!is_array($this->blockedContextActRelationshipType)) {
			$this->blockedContextActRelationshipType = array();
		}

		$this->blockedContextActRelationshipType[] = array(
			'code' => $blockedContextActRelationshipType,
			'codeSystem' => "2.16.840.1.113883.5.1002",
			'codeSystemName' => "ActRelationshipType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $blockedContextParticipationType from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ParticipationType.html
	 * @Definition Identifies the type(s) of Participations that are not permitted to conduct across this ActRelationship.
	 * @UsageConstraint This attribute can only be used if the serializable model in which it appears has a contextConductionStyle property of "V (vocabulary-based)".
	 * @UsageNotes If one or more codes are specified, all other Participations with typeCodes that match one of the specified codes or that are specializations of one of the specified codes will not conduct. All other Participations with typeCodes having a "conductible" property of "true" or whose ancestor has a "conductible" property of "true" will conduct. Conducted Participations behave such that the Act being navigated to is treated as though it had the same association(s) as the Act being navigated from. Refer to the Core Principles specification for more information. 
	**/
	public function addBlockedContextParticipationType($blockedContextParticipationType)
	{
		if (!is_array($this->blockedContextParticipationType)) {
			$this->blockedContextParticipationType = array();
		}

		$this->blockedContextParticipationType[] = array(
			'code' => $blockedContextParticipationType,
			'codeSystem' => "2.16.840.1.113883.5.90",
			'codeSystemName' => "ParticipationType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $actAttributeContextBlockedInd Blocks conduction of act attribute values across this act relationship when true.
	 * @UsageNotes If true act attribute values are not conducted across this act relationship. If false the values of Act attributes having a "conductible" property of "true" will conduct. Conducted Act attribute values are treated as propagating and overriding.
	**/
	public function setActAttributeContextBLockedInd($actAttributeContextBlockedInd)
	{
		$this->actAttributeContextBlockedInd = $actAttributeContextBlockedInd;
	}


	/**
	 * @param $sequenceNumber An integer specifying the relative sequential ordering of this relationship among other like-types relationships having the same source Act. 
	 * @UsageNotes This attribute is part of the workflow control suite of attributes. An action plan is a composite Act with component Acts. In a sequential plan, each component has a sequenceNumber that specifies the ordering of the plan steps. Multiple components with the same sequenceNumber make a branch. Branches can be exclusive (case-switch) or can indicate parallel processes indicated by the splitCode. 
	 If value is null, the relative position of the target Act is unspecified. (i.e., it may occur anywhere.)
	 Use the 'priorityNumber' attribute to indicate relative preference instead of order of occurrence.
	**/
	public function setSequenceNumber($sequenceNumber)
	{
		$this->sequenceNumber = ($sequenceNumber > 0) ? $sequenceNumber : NULL;
	}


	/**
	 * @param $priorityNumber An integer specifying the relative preference for considering this relationship before other like-typed relationships having the same source Act. Relationships with lower priorityNumber values are considered before and above those with higher values. 
	 * @UsageNotes For multiple criteria, this attribute specifies which criteria are considered before others. For components with the same sequence number, it specifies which ones are considered before others. Among alternatives or options that are being chosen by humans, the priorityNumber specifies preference. 
	 The ordering may be a total ordering, in which all priority numbers are unique, or a partial ordering, in which the same priority may be assigned to more than one relationship. 
	**/
	public function setPriorityNumber($priorityNumber)
	{
		$this->priorityNumber = $priorityNumber;
	}


	/**
	 * @param $pauseQuantity A quantity of time that elapses or should elapse between the source act and the target act.
	 * @UsageNotes This attribute is part of the workflow control suite of attributes. An action plan is a composite Act with component Acts. In a sequential plan, each component has a sequenceNumber that specifies the ordering of the plan steps. Before any step with preconditions is executed, these conditions are tested: if the test is positive, the Act has clearance for execution. At that time, if the act has a pauseQuantity, the pauseQuantity timer is started: the Act is executed after the pauseQuantity has elapsed. 
	 As a precondition (e.g., administer 3 hours prior to surgery), pause quantity is allowed to be negative, provided that it is possible to predict the occurrence of the target condition. 
	 In general, pauseQuantity should only be specified when the source mood and target mood are identical, reflecting the time between the actual, intended or potential acts. However, in limited circumstances, it may also be used when the source act and target act have different moods. In this case, the source act must represent the realization of the target class. For example, event pointing to order, order pointing to proposal, etc. 
	 The relationship type will generally be "fulfills" or "instantiates". In this case, the semantic indicates the difference in timing between the more realized source act and the more abstract target act. An alternative way of looking at it is that pauseQuantity represents the difference in time between two acts should the eventual event occur as specified in the act. For example: "The encounter started 30 minutes later than intended"; or "The treatment began a week earlier than recommended". 
	 * @FormalConstraint Units SHALL be a type of Time
	**/
	public function setPauseQuantity($pauseQuantity)
	{
		$this->pauseQuantity = $pauseQuantity;
	}


	/**
	 * @param $checkpointCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipCheckpoint.html
	 * @Definition The point in the course of an Act when a precondition for the Act is evaluated: e.g., before the Act starts for the first time, before every repetition, after each repetition but not before the first, or throughout the entire time of the Act. 
	 * @UsageNotes This attribute is part of the workflow control suite of attributes. An action plan is a composite Act with component Acts. In a sequential plan, each component has a sequenceNumber that specifies the ordering of the plan steps. Before each step is executed, those with preconditions have their conditions tested; where the test is positive, the Act has clearance for execution. The checkpointCode specifies when the precondition is to be checked; it is analogous to the various conditional statements and loop constructs in programming languages "while-do" vs. "do-while" or "repeat-until" vs. "loop-exit." 
	 For all checkpointCodes except "end," preconditions are being checked at the time when the preceding step of the plan has terminated and this step would be next in the sequence established by the sequenceNumber attribute. 
	 When the checkpointCode for a criterion of a repeatable Act is "end," the criterion is tested only at the end of each repetition of that Act. When the condition holds true, the next repetition is ready for execution. 
	 When the checkpointCode is "entry," the criterion is checked at the beginning of each repetition, if any, whereas "beginning" means the criterion is checked only once before the repetition "loop" starts. 
	 The checkpointCode "through" is special in that it requires the condition to hold throughout the execution of the Act, even throughout a single execution. As soon as the condition turns false, the Act should receive an interrupt event (see Act.interruptibleInd) and will eventually terminate. 
	 The checkpointCode "exit" is only used on a special plan step that represents a loop exit step. This allows an action plan to exit due to a condition tested inside the execution of this plan. Such exit criteria are sequenced with the other plan components using the ActRelationship.sequenceNumber. 
	**/
	public function setCheckpointCode($checkpointCode)
	{
		$this->checkpointCode = array(
			'code' => $checkpointCode,
			'codeSystem' => "2.16.840.1.113883.5.10",
			'codeSystemName' => "ActRelationshipCheckpoint",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $splitCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipSplit.html
	 * @Definition The manner in which branches in an action plan are selected from among other branches.
	 * @UsageNotes This attribute is part of the workflow control suite of attributes. An action plan is a composite Act with component Acts. In a sequential plan, each component has a sequenceNumber that specifies the ordering of the plan steps. Branches exist when multiple components have the same sequenceNumber. The splitCode specifies whether a branch is executed exclusively (case-switch) or inclusively, i.e., in parallel with other branches. 
	 In addition to exclusive and inclusive split the splitCode specifies how the pre-condition (also known as "guard conditions" on the branch) are evaluated. A "try once" guard condition may be evaluated once when the branching step is entered and if the conditions do not hold at that time, the branch is abandoned. Conversely, execution of a "wait" branch may wait until the guard condition turns true. 
	 In exclusive wait branches, the first branch whose guard conditions turn true will be executed and all other branches abandoned. In inclusive wait branches some branches may already be executed while other branches still wait for their guard conditions to turn true. 
	 * @Examples Exclusive wait, inclusive wait, exclusive try once.
	**/
	public function setSplitCode($splitCode)
	{
		$this->splitCode = array(
			'code' => $splitCode,
			'codeSystem' => "2.16.840.1.113883.5.13",
			'codeSystemName' => "ActRelationshipSplit",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $joinCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipJoin.html
	 * @Definition The manner in which concurrent Acts are resynchronized in a parallel branch construct.
	 * @UsageNotes This attribute is part of the workflow control suite of attributes. An action plan is a composite Act with component Acts. In a sequential plan, each component has a sequenceNumber that specifies the ordering of the plan steps. Branches exist when multiple components have the same sequenceNumber. Branches are parallel if the splitCode specifies that more than one branch can be executed at the same time. The joinCode then specifies if and how the branches are resynchronized. 
	 The principal re-synchronization actions are (1) the control flow waits for a branch to terminate (wait-branch), (2) the branch that is not yet terminated is aborted (kill-branch), (3) the branch is not re-synchronized at all and continues in parallel (detached branch). 
	 A kill-branch is only executed if there is at least one active wait branch. If there is no other wait branch active, a kill-branch is not started at all (rather than being aborted shortly after it is started). Since a detached branch is unrelated to all other branches, active detached branches do not prevent a kill-branch from being aborted. 
	 * @Examples Detached, kill, exclusive wait.
	**/
	public function setJoinCode($joinCode)
	{
		$this->joinCode = array(
			'code' => $joinCode,
			'codeSystem' => "2.16.840.1.113883.5.12",
			'codeSystemName' => "ActRelationshipJoin",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $negationInd And indicator that asserts that the meaning of the link is negated
	 * @UsageNotes This attribute is used primarily for clarifying statements. As the examples show, the use of this attribute is quite limited, notably contrast this with the Act.negationInd that actually requires that the described Act not exist, not be done, etc. whereas the ActRelationship.negationInd merely negates this relationship between source and target act, but does not change the meaning of each Act. 
	 Note also the difference between negation and the contrary. A contraindication is the contrary of an indication (reason) but not the negation of the reason. The fact that lower back pain is not a reason to prescribe antibiotics doesn't mean that antibiotics are contraindicated with lower back pain. 
	 * @Examples If the relationship without negation specifies that Act A has Act B as a component, then the negation indicator specifies that Act A does not have Act B as a component. If B is a reason for A, then negation means that B is not a reason for A. If B is a pre-condition for A, then negation means that B is not a precondition for A. 
	**/
	public function setNegationInd($negationInd = FALSE)
	{
		$this->negationInd = $negationInd;
	}


	/**
	 * @param $conjuctionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RelationshipConjunction.html
	 * @Definition The logical conjunction of the criteria among all the condition-links of Acts (e.g., and, or, exlusive-or).
	 * @UsageNotes This attribute is used for criteria, typically in definition or goal mood.
	 Upon evaluation, the criterion is passed if all "and" criteria are true. If "or" and "and" criteria occur together, one criterion out of the "or"-group must be true and all "and" criteria must be true also. If "xor" criteria occur together with "or" and "and" criteria, exactly one of the "xor" criteria must be true, and at least one of the "or" criteria and all "and" criteria must be true. In other words, the sets of "and", "or", and "xor" criteria are in turn combined by a logical "and" operator (all "and" criteria and at least one "or" criterion and exactly one "xor" criterion). To overcome this ordering, Act criteria can be nested as necessary. 
	**/
	public function setConjuntionCode($conjunctionCode)
	{
		$this->conjunctionCode = array(
			'code' => $conjunctionCode,
			'codeSystem' => "2.16.840.1.113883.5.106",
			'codeSystemName' => "RelationshipConjunction",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $localVariableName A character string name for the input parameter from which the source Act of this ActRelationship derives some of its attributes. The local variable name is bound in the scope of the Act.derivationExpr with its value being an Act selected based on the input parameter specified by this attribute. 
	**/
	public function setLocalVariableName($localVariableName)
	{
		$this->localVariableName = $localVariableName;
	}


	/**
	 * @param $seperatableInd An indication that the source Act is intended to be interpreted independently of the target Act.
	 * @UsageNotes The indicator cannot prevent an individual or application from separating the Acts, but indicates the author's desire and willingness to attest to the content of the source Act if separated from the target Act. Note that this attribute is orthogonal and unrelated to the RIM's context/inheritance mechanism. If the context of an Act is propagated to nested Acts, it is assumed that those nested Acts are not intended to be interpreted without the propagated context. 
	**/
	public function setSeperatableInd($seperatableInd)
	{
		$this->seperatableInd = $seperatableInd;
	}


	/**
	 * @param $subsetCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActRelationshipSubset.html
	 * @Definition An indicator that the target of the relationship will be a filtered subset of the total related set of targets
	 * @UsageNotes This attribute is used when there is a need to limit the number of components to the first, the last, the next, the total, the average or some other filtered or calculated subset
	 * @Examples First, maximum, summary
	**/
	public function setSubsetCode($subsetCode)
	{
		$this->subsetCode = array(
			'code' => $conjunctionCode,
			'codeSystem' => "2.16.840.1.113883.5.1099",
			'codeSystemName' => "ActRelationshipSubset",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $uncertaintyCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActUncertainty.html
	 * @Definition An assertion that specific relationship between the source and target Acts is uncertain
	 * @UsageNotes Uncertainty asserted using this attribute applies only to the relationship between two acts. The certainty of the acts themselves should be conveyed via Act.uncertaintyCode. 
	 * @Examples A particular exposure event is suspected but not known to have caused a particular symptom: stated with uncertainty.
	**/
	public function setUncertaintyCode($uncertaintyCode)
	{
		$this->uncertaintyCode = array(
			'code' => $uncertaintyCode,
			'codeSystem' => "2.16.840.1.113883.5.1053",
			'codeSystemName' => "ActUncertainty",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $target type Act
	**/
	public function setTarget(&$target)
	{
		if (is_a($target, 'Act') && !is_null($target)) {
			$this->target = $target;
		}
	}


	/**
	 * @param $source type Act
	**/
	public function setSource(&$source)
	{
		if (is_a($source, 'Act') && !is_null($source)){
			$this->source = $source;
		}
	}
}

 ?>