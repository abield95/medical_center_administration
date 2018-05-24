<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require 'InfrastructureRoot.php';

/**
 ******************State Machine************
	********States*********
	 -> aborted (sub-state of normal): 
		 The Act has been terminated prior to the originally intended completion.
	 -> active (sub-state of normal): 
		 The Act can be performed or is being performed.
	 -> cancelled (sub-state of normal): 
		 The Act has been abandoned before activation.
	 -> completed (sub-state of normal): 
		 An Act that has terminated normally after all of its constituents have been performed.
	 -> held (sub-state of normal): 
		 An Act that is still in the preparatory stages has been put aside. No action can occur until the Act is released.
	 -> new (sub-state of normal): 
		 An Act that is in the preparatory stages and may not yet have been acted upon.
	 -> normal: 
		 Encompasses the expected states of a service object, but excludes "nullified" and "obsolete" which represent unusual terminal states for the life-cycle. 
	 -> nullified: 
		 This Act instance was created in error and has been 'removed' and is treated as though it never existed. A record is retained for audit purposes only. 
	 -> obsolete: 
		 This Act instance has been replaced by a new instance.
	 -> suspended (sub-state of normal): 
		 Active service object is temporarily suspended.
	**********Transitions***********
	 -> abort (from active to aborted) 
	 -> abort (from suspended to aborted) 
	 -> activate (from new to active) 
	 -> activate (from null to active) 
	 -> cancel (from held to cancelled) 
	 -> cancel (from new to cancelled) 
	 -> complete (from active to completed) 
	 -> complete (from new to completed) 
	 -> complete (from null to completed) 
	 -> complete (from suspended to completed) 
	 -> create (from null to new) 
	 -> hold (from new to held) 
	 -> jump (from null to normal) 
	 -> nullify (from normal to nullified) 
	 -> obsolete (from normal to obsolete) 
	 -> reactivate (from completed to active) 
	 -> release (from held to new) 
	 -> resume (from suspended to active) 
	 -> revise (from active to active) 
	 -> revise (from completed to completed) 
	 ->revise (from held to held) 
	 ->revise (from new to new) 
	 ->revise (from suspended to suspended) 
	 ->suspend (from active to suspended
**/

/**
 * Act
 * @Definition A record of something that is being done, has been done, can be done, or is intended or requested to be done.
 * @UsageNotes Acts connect to Entities in their Roles through Participations, and they connect to other Acts through ActRelationships. Participations indicate the performers, authors, and other responsible parties as well as subjects and beneficiaries (including tools and material used in the performance of the act, which are also subjects). The moodCode distinguishes among Acts that are meant as factual records, records of intended or ordered services, and other modalities in which acts can be recorded. 
 * @Rationale 
 		 Acts are the pivot of the RIM: domain information and process records are represented primarily in Acts. Any profession or business, including healthcare, is primarily constituted of intentional and occasionally non-intentional actions, performed and recorded by responsible actors. An Act-instance is a record of such an action. 
		 An Act-instance represents a "statement," according to Rector and Nowlan (1991) [Foundations for an electronic medical record. Methods Inf Med. 30.] 
		 An activity in the real world may progress from definition, through planning and ordering to execution: these stages are represented as the moods of the Act. Even though one might think of a single activity as progressing through these stages, the "attributable statement" model of Act entails that this progression be reflected by multiple Act-instances, each having one and only one mood, and that this mood not change during the Act-instance's life cycle. This is because the attribution and content of speech acts along this progression of an activity may be different, and it is critical that a permanent and faithful record be maintained of this progression. The specification of orders or promises or plans must not be overwritten by the specification of what was actually done, so as to allow recipients of the information to compare actions with their earlier specifications. Act-instances that describe this progression of the same real world activity are linked through the ActRelationships (of the relationship category "sequel"). 
		 Acts as statements are the only representations of real world facts or processes in the HL7 RIM. The truth about the real world is constructed through the combination (and arbitration) of such attributed statements only, and there is no class in the RIM whose objects represent "objective state of affairs" or "real processes" independent from attributed statements. A factual statement may be made about recent (but past) activities, authored (and signed) by the performer of such activities, e.g. a surgical procedure report, clinic note, etc. Similarly, a status update may be made about an activity that is presently in progress, authored by the performer (or a close observer), and later superseded by a full procedure report. Both status update and procedure report are acts, distinguished by mood and state (see Act.statusCode) and completeness of information: neither has any epistemological priority over the other except as judged by the recipient of the information. 
 * @Examples The kinds of acts that are common in health care include (1) clinical observations, (2) assessments of health condition (such as problems and diagnoses), (3) healthcare goals, (4) treatment services (such as medication, surgery, physical and psychological therapy), (5) acts of assisting, monitoring or attending, (6) training and education services to patients and their next of kin, (7) notary services (such as advanced directives or living will), (8) editing and maintaining documents, and many others. 
 */
class Act extends InfrastructureRoot
{
	private $classCode;
	private $moodCode;
	private $id;
	private $code;
	private $actionNegationInd;
	private $negationInd;
	private $derivationExpr;
	private $title;
	private $text;
	private $statusCode;
	private $effectiveTime;
	private $activityTime;
	private $availabilityTime;
	private $priorityCode;
	private $confidentialityCode;
	private $repeatNumber;
	private $interruptibleInd;
	private $levelCode;
	private $independentInd;
	private $uncertaintyCode;
	private $reasonCode;
	private $languajeCode;
	private $isCriterionInd;

	//associations of ACT
	private $inboundRelationship;//ActRelationship::target;
	private $outboundRelationship;//ActRelationship::source
	private $participation;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode('ACT');
		$this->moodCode = NULL;
		$this->id = NULL;
		$this->code = NULL;
		$this->actionNegationInd = false;
		$this->negationInd = NULL;
		$this->derivationExpr = NULL;
		$this->title = NULL;
		$this->text = NULL;
		$this->statusCode = NULL;
		$this->effectiveTime = NULL;
		$this->activityTime = NULL;
		$this->availabilityTime = NULL;
		$this->priorityCode = NULL;
		$this->confidentialityCode = NULL;
		$this->repeatNumber = NULL;
		$this->interruptibleInd = NULL;
		$this->levelCode = NULL;
		$this->independentInd = NULL;
		$this->uncertaintyCode = NULL;
		$this->reasonCode = NULL;
		$this->languajeCode = NULL;
		$this->isCriterionInd = NULL;

		//associations of ACT
		$this->inboundRelationship = NULL;//ActRelationship::target;
		$this->outboundRelationship = NULL;//ActRelationship::source
		$this->participation = NULL;
	}


	/**
	 * @param $classCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActClass.html
	 * @Definition The major class of Acts to which an Act-instance belongs.
	 * @UsageNotes For Act-instances that have an Act.code, the Act.code SHALL be a specialization of the Act.classCode. The Act.code, however, cannot alter the meaning of the Act.classCode. 
	 This attribute provides a tightly controlled vocabulary of Act class "types" that is balloted with the RIM, and can be used to represent a type enumeration that might have been represented as a physical class in the RIM, but was not because while it had unique meaning, it did not require unique attributes or unique patterns of associations. The "code" attribute defines a specific sub-type of this Act type, and is intended to allow use of rich terminologies such as LOINC and SNOMED to represent these sub-types.
	 * @FormalConstraint Every Act-instance SHALL have a classCode. If the act class is not further specified, the most general Act.classCode (ACT) is used.
	**/
	public function setClassCode($classCode)
	{
		$this->classCode = array(
			'code' => $classCode,
			'codeSystem' => "2.16.840.1.113883.5.6",
			'codeSystemName' => "ActClass",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $moodCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActMood.html
	 * @Definition The intended use of the Act statement: as a report of fact, a command, a possibility, a goal, etc.
	 * @UsageNotes To describe the progression of a business activity from definition to planning to execution, etc., one must instantiate Act-instances in each of the required moods and link them using ActRelationship of general type "sequel." (See ActRelationship.typeCode.) 
	 Since the mood code is a determining factor for the meaning of an entire Act object, the mood must always be known. This means that whenever an act object is instantiated, the mood attribute SHALL be assigned to a valid code, and the mood assignment SHALL NOT change throughout the lifetime of the act object. 
	 The Act.moodCode modifies the meaning of the Act class in a controlled way, just as in natural language, grammatical form of a verb modifies the meaning of a sentence in defined ways. For example, if the mood is factual (event), then the entire act object represents a known fact. If the mood expresses a plan (intent), the entire act object represents the expectation of what should be done. 
	 As the meaning of an Act-instance is factored in the mood code, the mood code affects the interpretation of the entire Act object and with it every property (attributes and associations). Note that the mood code affects the interpretation of the act object, and the meaning of the act object in turn determines the meaning of the attributes. However, the mood code does not arbitrarily change the meaning of individual attributes. 
	 Acts have two kinds of act properties, inert and descriptive. Inert properties are not affected by the mood, but descriptive properties follow the mood of the object. For example, there is an identifier attribute Act.id, which gives a unique identification to an act object. Being a unique identifier for the object is in no way dependent on the mood of the act object. Therefore, the "interpretation" of the Act.id attribute is inert with respect to the act object's mood. 
	 By contrast, most of the Act class attributes describe what the Act statement expresses. Descriptive properties of the Act class answer the questions who, whom, where, with what, how and when the action is done. The questions who, whom, with what, and where are answered by Participations, while how and when are answered by descriptive attributes and ActRelationships. The interpretation of a descriptive attribute is aligned with the interpretation of the entire act object, and controlled by the mood. 
	 * @Examples
	 	To illustrate the effect of mood code, consider a "blood glucose" observation.
		The Definition mood specifies the Act of "obtaining blood glucose." Participations describe in general the characteristics of the people who must be involved in the act, and the required objects, e.g., specimen, facility, equipment, etc. involved. The Observation.value specifies the absolute domain (range) of the observation (e.g., 15-500 mg/dl). 
		In Intent mood the author of the intent expresses the intent that he or someone else "should obtain blood glucose." The participations are the people actually or supposedly involved in the intended act, especially the author of the intent or any individual assignments for group intents, and the objects actually or supposedly involved in the act (e.g., specimen sent, equipment requirements, etc.). The Observation.value is usually not specified, since the intent is to measure blood glucose, not to measure blood glucose in a specific range. (But compare with GOAL below). 
		In Request mood, a kind of intent, the author requests "please measure blood glucose." The Participations identify the people actually and supposedly involved in the act, especially the order placer and the designated filler, and the objects actually or supposedly involved in the act (e.g., specimen sent, equipment requirements, etc.). The Observation.value is usually not specified, since the order is not to measure blood glucose in a specific range. 
		In Event mood, the author states that "blood glucose was measured." Participations indicate the people actually involved in the act, and the objects actually involved (e.g., specimen, facilities, equipment). The Observation.value is the value actually obtained (e.g., 80 mg/dL, or <15 mg/dL). 
		In Event Criterion (not to be confused with Criterion) mood, an author considers a certain class of "obtaining blood glucose" possibly with a certain value (range) as outcome. The Participations constrain the criterion, for instance, to a particular patient. The Observation.value is the range in which the criterion would hold (e.g. > 180 mg/dL or 200-300 mg/dL). 
		In Goal mood (a kind of criterion), the author states that "our goal is to be able to obtain blood glucose with the given value (range)." The Participations are similar to those in Intent mood, especially the author of the goal and the patient for whom the goal is made. The Observation.value is the range which defines when the goal is met (e.g. 80-120 mg/dl). 
	* @OpenIssue In the May 2009 ballot, a strong Negative vote was lodged against several of the concept definitions in the vocabulary used for Act.moodCode. The vote was found "Persuasive With Mod", with the understanding that M&M would undertake a detailed review of these concept definitions for a future release of the RIM 
	**/
	public function setMoodCode($moodCode)
	{
		$this->moodCode = array(
			'code' => $moodCode,
			'codeSystem' => "2.16.840.1.113883.5.1001",
			'codeSystemName' => "ActMood",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $id A unique identifier for the Act.
	 * @UsageNotes Successful communication only requires that an act have a single identifier assigned to it. Moreover, it is recognized that as different systems maintain different databases, there may be different instance identifiers assigned by these different systems. Best practices suggest that if a source of information provides an identifier for an act, in subsequent transmissions of the same act the source of information SHOULD use the same unique identifier(s) previously used to communicate this instance. 
	**/
	public function addId($id)
	{
		if (!is_array($this->id)) {
			$this->id = array();
		}

		$this->id[] = $id;
	}


	/**
	 * @param $code from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActCode.html
	 * @Definition The particular kind of Act that the Act-instance represents within its class. 
	 * @UsageConstraint Act.code, if used, SHALL be a specialization of the Act.classCode.
	 * @UsageNotes Act.code is not a required attribute of Act. Rather than naming the kind of Act using an Act.code, one can specify the Act using only the class code and other attributes and properties of the Act. In general and more commonly, the kind of Act is readily specified by an ActRelationship specifying that this Act instantiates another Act in definition mood. Even without reference to an act definition, the act may be readily described by other attributes, ActRelationships and Participations. For example, the kind of SubstanceAdministration may be readily described by referring to the specific drug, as the Participation of an Entity representing that drug. 
	 This attribute defines a specific sub-type of a given Act type (determined by the "classCode" attribute). It allows the use of rich terminologies such as LOINC and SNOMED to represent sub-types of the limited set of Act types defined by "classCode." 
	 Act.classCode and Act.code are not modifiers of each other. The Act.code concept should imply the Act.classCode concept. For a negative example, it is not appropriate to use an Act.code "potassium" together with and Act.classCode for "laboratory observation" to somehow mean "potassium laboratory observation" and then use the same Act.code for "potassium" together with Act.classCode for "medication" to mean "substitution of potassium". This mutually modifying use of Act.code and Act.classCode is not permitted. 
	 * @DesignComments The superstructure of the ActCode domain should reflect the structure of ActClass domain, in order that individual codes or externally referenced vocabularies within ActCode be subordinated to the ActClass structure. 
	 Explain criteria for when it would be appropriate to use code rather than ActRelationship.
	 * @Examples Physical examination, serum potassium, inpatient encounter, charge financial transaction, etc.
	**/
	public function setCode($code)
	{
		$this->code = array(
			'code' => $code,
			'codeSystem' => "2.16.840.1.113883.5.4",
			'codeSystemName' => "ActCode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $actionNegationInd An indicator specifying that the Act statement is a negation of the Act in Event mood as described by the descriptive attributes.
	 * @UsageNotes
	 	 The actionNegationInd works as a negative existence quantifier on the actual, intended or described Act event. In Event mood, it indicates the defined act did not occur. In Intent mood, it indicates the defined act is not intended/desired to occur. In Criterion mood, it indicates that the condition is based on the non-occurrence of the event. It is nonsensical to have a negationInd of true for acts with a mood of definition. 
		 The actionNegationInd negates the Act as described by the descriptive properties (including Act.code, Act.effectiveTime, Observation.value, Act.doseQty, etc.) and any of its components. The document characteristic properties such as Act.id, Act.moodCode, Act.confidentialityCode, and particularly the Author-Participation are not negated. These document characteristic properties always have the same meaning: i.e., the author remains to be the author of the negative observation. Also, most ActRelationships (except for components) are not included in the negation. Refer to the attribute isDocumentCharacteristic property and the ActRelationshipType and ParticipationType code system isDocumentCharacteristic properties for specific guidance. 
		 For example, a highly confidential order written by Dr. Jones, to explicitly not give "succinyl choline" for the "reason" (ActRelationship) of a history of malignant hyperthermia (Observation) negates the descriptive properties "give succinyl choline" (Act.code), but it is still positively an order and written by Dr. Jones and for patient John Smith, and the reason for this order is the patient's history of malignant hyperthermia. 
		 However, additional detail in descriptive attributes will be part of the negation which then limits the effectiveness of the negated statement. For example, had the order "not to give a substance" included a doseQuantity, it would mean that the substance should not be given at that particular dose (but any other dose might still be O.K.). 
		 An act statement with actionNegationInd is still a statement about the specific fact described by the Act. For instance, a negated "patient had an appendectomy on July 1" means that the author positively denies that appendectomy occurred on July 1, and that he takes the same responsibility for such statement and the same requirement to have evidence for such statement than if he had not used negation. Conversely, the action negation indicator does not just negate that the fact was affirmed or that the statement had been made. This holds for all moods in the same way, e.g., a negated order is an order not to do the described act, not just the lapidary statement that there is no such order. Such lapidary statements are handled by negating the control act that created the subject act. I.e. "An order of this type (DEFN mood) with an author of Dr. Smith was not created." 
		 Note that for Observations, actionNegationInd indicates that the act itself did not occur. I.e. no observation took place. To indicate that an observation did occur but the finding was negative, use Observation.valueNegationInd
	 * @Examples When used with event mood, allows communicating "Surgery was not performed" or "Consent was not given". When used in order mood, allows communicating "Do not administer this substance". When used in EVN.CRIT mood allows you to say "If the patient is not admitted . . ." 
	**/
	public function setActionNegationInd($actionNegationInd = false)
	{
		$this->actionNegationInd = $actionNegationInd;
	}


	/**
	 * @param $negationInd An indication that the Act statement is a negation of the Act as described by the descriptive attributes.
	 * @UsageNotes
			 The negationInd works as a negative existence quantifier. This is best explained on Acts in criterion mood, and then translates into all other moods. In criterion mood without negation, one usually only specifies a few critical attributes and relationships (features) of an Act, i.e., only those that are needed to test the criterion. The more features one specifies, the more constrained (specific) is the criterion. For example, to test for "systolic blood pressure of 90-100 mm Hg," one would use only the descriptive attributes Act.code (for systolic blood pressure) and Observation.value (for 90-100 mm Hg). If one would also specify an effectiveTime, i.e., for "yesterday," the criterion would be more constrained. If the negationInd is true for the above criterion, then the meaning of the test is whether a systolic blood pressure of 90-100 mm Hg yesterday does not exist (independent of whether any blood pressure was measured). 
			 The negationInd negates the Act as described by the descriptive properties (including Act.code, Act.effectiveTime, Observation.value, Act.doseQty, etc.) and any of its components. The inert properties such as Act.id, Act.moodCode, Act.confidentialityCode, and particularly the Author-Participation are not negated. These inert properties always have the same meaning: i.e., the author remains to be the author of the negative observation. Of ActRelationships , only components are included in the negation. 
			 For example, a highly confidential order written by Dr. Jones, to explicitly not give "succinyl choline" for the "reason" (ActRelationship) of a history of malignant hyperthermia (Observation) negates the descriptive properties "give succinyl choline" (Act.code), but it is still positively an order and written by Dr. Jones and for patient John Smith, and the reason for this order is the patient&aposs history of malignant hyperthermia. 
			 However, additional detail in descriptive attributes will limit the effective scope of the negation. For example, had the order not to give a substance included a doseQuantity, it would mean that the substance should not be given at that particular dose, but does not prohibit medication at any other dose. 
			 An act statement with negationInd is still a statement about the specific fact described by the Act. For instance, a negated "finding of wheezing on July 1" means that the author positively denies that there was wheezing on July 1, and that he takes the same responsibility for such statement and the same requirement to have evidence for such statement than if he had not used negation. Conversely, negationInd does not just negate that the fact was affirmed or that the statement had been made. This holds for all moods in the same way, e.g., a negated order is an order not to do the described act, not just a statement that there is no such order.
	 * @Examples Used with an Observation event, it allows one to say "patient has NO chest pain." With an Observation criterion it negates the criterion analogously, e.g., "if patient has NO chest pain for 3 days ...," or "if systolic blood pressure is not within 90-100 mm Hg ..."
	 * @Depracation
			 This attribute was deprecated for future use in HL7 Design Models at the September, 2008 Working Group Meeting, effective with RIM release 0221. The semantics of this attribute have been divided between the new actionNegationInd attribute and the Observation.valueNegationInd attribute. For existing models, designers should examine the model documentation and usage to determine which set of semantics apply. New models and new versions of existing models SHALL NOT use this attribute. 
			 This attribute was removed from the RIM in version 2.38, per Harmonization decision in March 2012. However, subsequent analysis of the result of that step upon CMETs, Wrappers and other shared models that use this attribute led to the conclusion in July 2012 Harmonization that the action was too precipitate. The attribute was returned to the RIM in version 2.40 per Harmonization Action on July 11, 2012. It will be removed in a later version (with Harmonization approval) once a strategy to deal with this removal in existing models has been put in place. 
	**/
	public function setNegationInd($negationInd)
	{
		$this->negationInd = $negationInd;
	}


	/**
	 * @param $derivationExpr A character string containing a formal language expression that specifies how the Act's attributes are, should be, or have been derived from input parameters associated with derivation relationships.
	 * @UsageNotes Derived observations can be defined through association with other observations using ActRelationships of type "derivation." For example, to define a derived observation for Mean Corpuscular Hemoglobin (MCH) one will associate the MCH observation with a Hemoglobin (HGB) observation and a Red Blood cell Count (RBC) observation: the derivation expression value encodes the formula: MCH = HGB / RBC. 
	 * @FormalConstraint The derivation expression is represented as a character string.
	 * @OpenIssue The syntax of that expression is yet to be fully specified. Update status of this effort.
	 * @DeprecationInformation This attribute was deprecated for future use in HL7 Design Models at the March 2011 Harmonization Meeting. Data types R2, to which this model is bound, contains the EXPR data type that subsumes the use of the previous Act.derivationExpr attribute. As described in the data types R2 standard, EXPR is: "A generic data type extension used to specify an expression that can be used to derive the actual value of T [another data type] given information taken from the context of use." It may be used as part of the data type constraint of any attribute. 
	**/
	public function setDerivationExpr($derivationExpr)
	{
		$this->derivationExpr = $derivationExpr;
	}


	/**
	 * @param $title A word or phrase by which a specific Act may be known among people
	 * @UsageNotes This is not a formal identifier but rather a human-recognizable common name. However it is similar to the id attribute in that it refers to a specific Act rather than a 'kind' of act. (For definition mood, the title refers to that specific definition, rather than to a broad category that might be conveyed with Act.code.)
	 * @Examples Name of a research study (e.g., "Scandinavian Simvastatin Study"), name of a court case (e.g., "Brown v. Board of Education"), name of another kind of work project or operation. For acts representing documents, this is the title of the document.
	 * @FormalConstraint Previous to release 2.05 of the RIM, this attribute bore the datatype ST. From release 2.05 onwards, the datatype was extended to a constrained restriction of the ED datatype. The constraints to be imposed are identical to those for the ST datatype, except that the mediaType shall be "text/x-hl7-title+xml" or "text/plain". The intent is to allow sufficient mark-up to convey the semantics of scientific phrases, such as chemical compounds. This markup must not be used to convey simple display preferences. The default mediaType should be "text/plain". 
	**/
	public function setTitle($title)
	{
		$this->title = $title;
	}


	/**
	 * @param $text A renderable textual or multimedia description (or reference to a description) of the complete information which would reasonably be expected to be displayed to a human reader conveyed by the Act.
	 * @UsageNotes The content of the description is not considered part of the functional information communicated between computer systems. For Acts that involve human readers and performers, however, computer systems must show the Act.text field to a human user, who has responsibility for the activity; or at least must indicate the existence of the Act.text information and allow the user to see that information. 
	 Free text descriptions are used to help individuals interpret the content and context of acts, but all information relevant for automated functions SHALL be communicated using the proper attributes and associated objects. 
	 A user SHOULD be able to read Act.text alone, without seeing any of the encoded information, and have no risk of misinterpreting or lacking full understanding of the full content of the Act. For example, II.root, or CD.codeSystem would not normally be displayed to a human and thus would not need to be exposed as part of Act.text. 
	 The rendering is expected to include all 'descendent' ActRelationships and Participations, recursively navigating child Acts as exposed in that particular 'snapshot.' However, there are several data elements which are NOT expected to be included in the rendering. These are 
		 -> Component Sections (ActRelationship=COMP, classCode <= DOCSECT) 
		 -> The title attribute 
		 -> Anything attached to ActRelationship=XFRM) 
		 -> Previous versions (ActRelationship=RPLC) 
	 Act.text MAY include information that is not in the other attributes/associations, but SHALL include all information that is in such attributes or associations, with the exception of those identified above. 
	 Act.text SHALL NOT be used for the sharing of computable information. Computable information SHALL be conveyed using discrete attributes. Any information which Act.text contains not elsewhere exposed in encoded information will be opaque to computer systems. For this reason, Act.text SHALL not be used to contain information which negates or significantly modifies the understanding of information encoded in discrete attributes. 
	 To communicate "supplemental text," an act relationship (e.g. "component" or "subject of") should be created to a separate Act with a bare Act.text attribute to convey the supplemental information, possibly with a code indicating "annotation" or some similar concept.
	 Clarify strength of "Act.text SHALL NOT be used for the sharing of computable information": should this be a constraint?
	 * @Examples For act definitions, the Act.text can contain textbook-like information about that act. For act orders, the description will contain particular instructions pertaining only to that order.
	**/
	public function setText($text)
	{
		$this->text = $text;
	}


	/**
	 * @param $statusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActStatus.html
	 * @Definition The state of the Act
	 * @UsageNotes The status reflects the state of the activity. In the case of an Observation, this is the status of the activity of observing (e.g., "new," "complete," "cancelled"), not the status of what is being observed (e.g., disease status, "Active" allergy to penicillin). To convey the status of the subject being observed, consider coordinating it into the code or value attribute of the Observation or using a related Observation. 
	**/
	public function setStatusCode($statusCode)
	{
		$this->statusCode = array(
			'code' => $statusCode,
			'codeSystem' => "2.16.840.1.113883.5.14",
			'codeSystemName' => "ActStatus",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $effectiveTime The clinically or operationally relevant time of an act, exclusive of administrative activity. 
	 * @UsageNotes The effectiveTime is also known as the "primary" time (Arden Syntax) or the "biologically relevant time" (HL7 v2.x). This attribute is distinguished from activityTime. 
	 For observations, the time of the observation activity may be much later than the time of the observed feature. For instance, in a Blood Gas Analysis (BGA), a result will not be available for several minutes after the specimen was taken, meanwhile the patient's physiological state may have changed significantly. 
	 For essentially physical activities (surgical procedures, transportations, etc.), the effective time is the time of interest for the Act's intention, i.e., since the intention of a transportation is to deliver a payload from location A to B, the effectiveTime is the time this payload is underway from A to B. However, the Act usually also includes accidental work which is necessary to perform the intention of the Act, but is not relevant for the Act's purpose. 
	 For example, the time a driver needs to go to the pick-up location A and then return from drop-off location B to some home base, is included in the physical activity (as activityTime), but it does not matter from the perspective of the payload's transportation and is excluded from effectiveTime. Another example: a person's work hours (effectiveTime) may be from 8 AM to 5 PM, no matter whether that person needs 10 minutes for the commute or 2 hours. The commute is necessary to be at work, but it is not part of the working time.
	 * @Examples
		 -> For clinical Observations, the effectiveTime is the time at which the observation holds (is effective) for the patient.
		 -> For contracts, the effectiveTime is the time for which the contract is in effect.
		For consents, the effectiveTime is the time for which the consent is valid.
		 -> For substance administrations, the effective time is the time over which the substance is to be administered, including the frequency of administration (e.g., TID for 10 days) 
		 -> For a surgical procedure (operation), the effectiveTime is the time relevant for the patient, i.e., between incision and last suture. 
		 -> For transportation acts, the effective time is the time the transported payload is en route.
		 -> For patient encounters, this is the "administrative" time, i.e., the encounter start and end date required to be chosen by business rules, as opposed to the actual time the healthcare encounter related work is performed. 
	**/
	public function addEffectiveTime($effectiveTime)
	{
		if (!is_array($this->effectiveTime)) {
			$this->effectiveTime = array();
		}

		$this->effectiveTime[] = $effectiveTime;
	}


	/**
	 * @param $activityTime A time expression specifying when an Observation, Procedure, or other Act occurs, or, depending on the mood, is supposed to occur, scheduled to occur, etc. The activityTime includes the times of component actions (such as preparation and clean-up). For Procedures and SubstanceAdministrations, the activityTime can provide a needed administrative function by providing a more inclusive time to be anticipated in scheduling.
	 * @UsageNotes The activityTime is primarily of administrative rather than clinical use. The clinically relevant time is the effectiveTime. When an observation of a prior symptom is made, the activityTime describes the time the observation is made, as opposed to effectiveTime which is the time the symptom is reported to have occurred. Thus the activityTime may be entirely different from the effectiveTime of the same Act. However, even apart from clinical use cases, designers should first consider effectiveTime as the primary relevant time for an Act. 
	 ActivityTime indicates when an Act occurs, not when it is recorded. Many applications track the time an observation is recorded rather than the precise time during which an observation is made, in which case Participation.time (e.g. of the Author) should be used. These recorded observations can take place during an encounter, and the time of the encounter often provides enough information so that activityTime isn't clinically relevant. 
	 ActivityTime is a descriptive attribute: like effectiveTime, it always describes the Act event as it does or would occur. For example, when a procedure is requested, the activityTime describes the requested total time of the procedure, which may differ from the time recorded for the resulting event. By contrast, the author Participation.time is inert, i.e., author participation time on an order specifies when the order was written and has nothing to do with when the event might actually occur. 
	**/
	public function addActivityTime($activityTime)
	{
		if (!is_array($this->activityTime)) {
			$this->activityTime = array();
		}

		$this->activityTime[] = $activityTime;
	}


	/**
	 * @param $availabilityTime The point in time at which information about Act-instance (regardless of mood) first became available to a system reproducing this Act. The availabilityTime is metadata describing the record, not the Act. 
	 * @UsageNotes The availabilityTime is added (or changed) by any system that receives this Act, and is not attributed to the author of the act statement (it would not be included in the material the author would attest to with a signature). The system reproducing the Act is often not the same as the system originating the Act, but a system that received this Act from somewhere else, and, upon receipt of the Act, values the availabilityTime to convey the time since the users of that particular system could have known about this Act-instance. 
	 A system evaluates availabilityTime on receipt (or creation) of information, and must be able to produce the availabilityTime of the information if and when it communicates that information further.
	 * @Rationale An Act might record that a patient had a right-ventricular myocardial infarction effective three hours ago (see Act.effectiveTime), but we may only know about this unusual condition a few minutes ago (Act.availabilityTime). Thus, any interventions from three hours ago until a few minutes ago may have assumed the more common left-ventricular infarction, which can explain why these interventions (e.g., nitrate administration) were taken, even though they may not have been appropriate in light of the more recent knowledge. 
	 * @DesignComments Clarify: Does the act acquire a new availability time with each transmission? Does this value indicate to which system it refers? Or is it always defined as the availability time for the transmitting system in the context of a message, any further transmission either dropping or overwriting it, and recording, if necessary, previous transmission times as separate observations? 
	 Deleted text indicates availabilityTime is "attributed to the author of an act that includes or refers to the act." It is not clear why this attribute should require special conduction rules: are they different from the rules for other attributes? 
	**/
	public function setAvailabilityTime($availabilityTime)
	{
		$this->availabilityTime = $availabilityTime;
	}


	/**
	 * @param $priorityCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActPriority.html
	 * @Definition The urgency under which the Act happened, can happen, is happening, is intended to happen, or is requested/demanded to happen.
	 * @UsageNotes This attribute is used in orders to indicate the ordered priority, and in event documentation it indicates the actual priority used to perform the act. In definition mood it indicates the available priorities, hence the open cardinality. 
	 * @Examples Routine, elective, emergency
	**/
	public function setPriorityCode($priorityCode)
	{
		$this->priorityCode = array(
			'code' => $priorityCode,
			'codeSystem' => "2.16.840.1.113883.5.7",
			'codeSystemName' => "ActPriority",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $confidentialityCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/Confidentiality.html
	 * @Definition Privacy metadata classifying an Act according to its level of sensitivity, which is typically based on a jurisdictional or organizational analysis of applicable privacy policies and the risk of financial, reputational, or other harm to an individual or entity that could result if made available or disclosed to unauthorized individuals, entities, or processes. 
	 * @UsageNotes Confidentiality codes may be used in security labels and privacy markings to classify an Act based on its level of sensitivity in order to indicate the obligation to ensure that the information conveyed by the Act is not made available or redisclosed to individuals, entities, or processes (security principals) per applicable policies. Confidentiality codes may also be used in the clearance of initiators requesting access to protected resources. 
	 Confidentiality codes may be used by access control systems to match the classification of an initiator's clearance to the classification of the information conveyed by an Act class; e.g., the confidentialityCode is used to convey the classification clearance level required to access information about a sensitive reproductive service. 
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
	 * @param $repeatNumber An interval of integer numbers stating the minimal and maximal number of repetitions of the Act.
	 * @UsageNotes This attribute is a member of the workflow control suite of attributes. 
	 The number of repeats is additionally constrained by time. The act will repeat at least the minimal number of times and at most, the maximal number of times, unless the time exceeds the maximal Act.effectiveTime, at which point the repetitions will terminate 
	 On an Act in Event mood, the repeatNumber is usually 1. If greater than 1, the Act represents a summary of several event occurrences occurring over the time interval described by effectiveTime. These occurrences are not otherwise distinguished. 
	 To distinguish occurrences of acts within a sequence of repetitions, use distinct instances of Act related by ActRelationships using ActRelationship.sequenceNumber.
	 * @Examples An oral surgeon's advice to a patient after tooth extraction might be: "replace the gauze every hour for 1 to 3 times until bleeding has stopped completely." This translates to repeatNumber with low boundary 1 and high boundary 3.
	**/
	public function addRepeatNumber($repeatNumber)
	{
		if (!is_array($this->repeatNumber)) {
			$this->repeatNumber = array();
		}

		$this->repeatNumber[] = $repeatNumber;
	}


	/**
	 * @param $interruptibleInd An indication that the Act is interruptible by asynchronous events.
	 * @UsageNotes This attribute is part of the suite of workflow control attributes. Act events that are currently active can be interrupted in various ways. Interrupting events include (1) an explicit abort request against the Act, (2) expiration of the time allotted to this Act (timeout), (3) a "through condition" ceases to hold true for this Act (see ActRelationship.checkpointCode), (4) the Act is a component with the joinCode "kill" and all other components in that same group have terminated (see Act.joinCode), and (5) a containing Act is interrupted. 
	 If an Act receives an interrupt and the Act itself is interruptible, but it has currently active component-Acts that are non-interruptible, the Act will be interrupted when all of its currently active non-interruptible component-acts have terminated. 
	**/
	public function setInterruptibleInd($interruptibleInd)
	{
		$this->interruptibleInd = $interruptibleInd;
	}


	/**
	 * @param $levelCode Obsolete Code specifying the level within a hierarchical Act composition structure and the kind of contextual information attached to composite Acts ("containers") and propagated to component Acts within those containers. The levelCode signifies the position within such a containment hierarchy and the applicable constraints.
	 * @UsageConstraint The constraints applicable to a particular level may include differing requirements for participations (e.g. patient, source organization, author or other signatory), relationships to or inclusion of other Acts, documents or use of templates. The constraints pertaining to a level may also specify the permissible levels that may be contained as components of that level. Several nested levels with the same levelCode may be permitted, prohibited (or limited). Instances of the next subordinate level are usually permitted within any level but some levels may be omitted from a model and it may be permissible to skip several layers. 
	 * @UsageNotes The levelCode concepts have been defined to meet specific health record transfer requirements. While these concepts are known to be applicable to some other types of transactions, they are not intended to be a complete closed list. Options exist for other sets of orthogonal levels where required to meet a business purpose (e.g. a multiple patient communication may be subdivided by a super-ordinate level of subject areas). 
	 * @DesignComments Pending deprecation decision: this attribute does not seem to have been maintained.
	 @Examples The "extract level" and the "folder level" must contain data about a single individual, whereas the "multiple subject level" may contain data about multiple individuals. While "extract" can originate from multiple sources, a "folder" should originate from a single source. The "composition" level usually has a single author.
	 * @DeprecationInformation Readers should be aware that this attribute may be declared "obsolescent" in the next normative release of the HL7 RIM. An alternate representation of this concept using a specified hierarchy of Act classCode values is being considered. If the change is adopted, HL7's RIM maintenance procedures state that the levelCode would be declared "obsolescent" in the next RIM release, and then become "obsolete" in the release following that. Users are advised to check with the latest HL7 internal definitions of the RIM, before using this attribute. 
	**/
	public function setLevelCode($levelCode)
	{
		$this->levelCode = $levelCode;
	}


	/**
	 * @param $independentInd An indicator specifying whether the Act can be manipulated independently of other Acts or only through a super-ordinate composite Act that has this Act as a component.
	 * @UsageNotes By default the independentInd should be true. An Act definition is sometimes marked with independentInd=false if the business rules would not allow this act to be ordered without ordering the containing act group. 
	 * @Examples An order may have a component that cannot be aborted independently of the other components.
	**/
	public function setIndependentInd($independentInd)
	{
		$this->independentInd = $independentInd;
	}


	/**
	 * @param $uncertaintyCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActUncertainty.html
	 * @Definition An indication that the Act statement as a whole, with its subordinate components has been asserted to be uncertain in some way. 
	 * @UsageNotes Uncertainty asserted using this attribute applies to the combined meaning of the Act statement established by all descriptive attributes (e.g., Act.code, Act.effectiveTime, Observation.value, SubstanceAdministration.doseQuantity, etc.), and the meanings of any components, not uncertainty regarding the value of Observation.value or any other particular attribute. These should be specified by applying the PPD or UVP data type extensions to the specific attribute. Uncertainty regarding a quantitative measurement value must still be represented by a PPD<PQ> in the value; differential diagnoses enumerated or weighed for probability must use the UVP<CD>. The use of the uncertaintyCode is appropriate only if the entirety of the Act and its dependent Acts is questioned. 
	 There is no relationship between uncertaintyCode and negationInd. One may be very uncertain about an event, but that does not mean that one is certain about the negation of the event. 
	 If this attribute is left unspecified or is omitted from a particular model, it SHALL be inferred that the attribute has the semantic of “stated with no assertion of uncertainty”. 
	 No default value shall be declared for this attribute with a semantic that differs from “stated with no assertion of uncertainty”, though defaults may be asserted that convey this semantic in any desired code system. 
	 * @Examples Patient might have had a cholecystectomy procedure in the past, but isn&apost sure: stated with uncertainty. Patient stipulates a cholecystectomy procedure in the past: stated with no assertion of uncertainty. 
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
	 * @param $reasonCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActReason.html
	 * @Definition The motivation, cause, or rationale of an Act, when such rationale is not reasonably represented as an ActRelationship of type "has reason" linking to another Act. 
	 * @UsageNotes Most reasons for acts can be clearly expressed by linking the new Act to another prior Act record using an ActRelationship of type "has reason." This simply states that the prior Act is a reason for the new Act (see ActRelationship). The prior act can then be a specific existing act or a textual explanation. This works for most cases, and the more specific the reason data is, the more should this reason ActRelationship be used instead of the reasonCode. 
	 The reasonCode remains as a place for common reasons that are not related to a prior Act or any other condition expressed in Acts. Indicators that something was required by law or was on the request of a patient may qualify. However, if that piece of legislation, regulation, or the contract or the patient request can be represented as an Act (and they usually can), such a representation is preferable to the reasonCode. 
	 * @Examples Example reasons that might qualify for being coded in this field might be: "routine requirement," "infectious disease reporting requirement," "on patient request," "required by law." 
	**/
	public function addReasonCode($reasonCode)
	{
		if (!is_array($this->reasonCode)) {
			$this->reasonCode = array(
				'code' => array(),
				'codeSystem' => "2.16.840.1.113883.5.8",
				'codeSystemName' => "ActReason",
				'codeSystemVersion' => "1"
			);
		}

		$this->reasonCode['code'][] = $reasonCode;
	}


	/**
	 * @param $languajeCode from ietf3066
	 * @Definition The primary language in which this Act statement is specified, particularly the language of the Act.text.
	**/
	public function setLanguajeCode($languajeCode)
	{
		$this->languajeCode = array(
				'code' => $languajeCode,
				'codeSystem' => "2.16.840.1.113883.6.121",
				'codeSystemName' => "HumanLanguaje",
				'codeSystemVersion' => "1"
			);
	}


	/**
	 * @param $isCriterionInd If true, indicates that the data conveyed by the act, including outbound associations, represent "criteria" for some other act, not a "real" act. I.e. If an Act exists with a classCode of ACT and a moodCode of RQO and isCriterionInd is true, it does not represent an order for an act. Rather, it represents a criteria that will match on all orders. 
	 * @Constraint Act-relationships directed to any Act with "isCriterionInd=true" SHALL have "conductible=false" unless the source Act also has isCriterionInd=true. 
	**/
	public function setIsCriterionInd($isCriterionInd)
	{
		$this->isCriterionInd = $isCriterionInd;
	}


	/**
	 * @param $inboundRelationship type ActRelationship
	**/
	public function setInboundRelationship(&$inboundRelationship = NULL)
	{
		if (is_null($inboundRelationship)) {
			$inboundRelationship = new ActRelationship();
		}
		if (is_a($inboundRelationship, 'ActRelationship')) {
			$inboundRelationship->setTarget($this);
			$this->inboundRelationship = $inboundRelationship;
		}
	}


	/**
	 * @param $outboundRelationship type ActRelationship
	**/
	public function setOutboundRelationship(&$outboundRelationship)
	{
		if (is_null($outboundRelationship)) {
			$outboundRelationship = new ActRelationship();
		}
		if (is_a($outboundRelationship, 'ActRelationship')) {
			$outboundRelationship->setSource($this);
			$this->outboundRelationship = $outboundRelationship;
		}
	}

	public function setParticipation($participation = NULL)
	{
		if (is_null($participation)) {
			$participation = new Participation();
		}
		if (is_a($participation, 'Participation')) {
			$participation->setAct($this);
			$this->participation = $participation;
		}
	}
}

 ?>