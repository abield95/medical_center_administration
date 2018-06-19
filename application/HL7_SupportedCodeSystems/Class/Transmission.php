<?php 

namespace CommunicationInfrastructure\MessageCommunicationsControl\MessageControl;

require_once 'InfrastructureRoot.php';

/**
 * Transmission
 * @Definition Information about a specific transmission of information from one application to another.
 * @OpenIssue This class is being actively considered for being split between two distinct classes dealing with transmission and contractual concepts. Thus it may be deprecated in a future RIM release. 
 */
class Transmission extends CommunicationInfrastructure\CoreInfrastructure\InfrastructureRoot
{
	private $id;
	private $creationTime;
	private $securityText;
	private $responseModeCode;
	private $versionCode;
	private $interactionId;
	private $profileId;

	//Associations
	private $acknoledgedBy;//(0..*)Acknoledgement::acknoledges(1..1)
	private $attachment;//(0..*)Attachment::transmission(1..1)
	private $attentionLine;//(0..*)AttentionLine::transmission(1..1)
	private $batch;//(0..1)Batch::transmission(0..*)
	private $communicationFunction;//(0..*)CommunicationFunction::transmission(1..*)
	private $conveyedAcknoledgement;//(0..*)Acknoledgement::conveyigTransmission(1..1)
	private $inboundRelationship;//(0..*)TransmissionRelationship::target(1..1)
	private $outboundRelationship;//(0..*)TransmissionRelationship::source(1..1)

	function __construct()
	{
		parent::__construct();
		$this->id = NULL;
		$this->creationTime = NULL;
		$this->securityText = NULL;
		$this->responseModeCode = NULL;
		$this->versionCode = NULL;
		$this->interactionId = NULL;
		$this->profileId = NULL;
		$this->acknoledgedBy = NULL;
		$this->attachment = NULL;
		$this->attentionLine = NULL;
		$this->batch = NULL;
		$this->communicationFunction = NULL;
		$this->conveyedAcknoledgement = NULL;
		$this->inboundRelationship = NULL;
		$this->outboundRelationship = NULL;
	}


	/**
	 * A unique identifier for the transmission
	 * @param UUID $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * The date/time that the sending system created the transmission
	 * @param date $creationTime Example yyyymmddhhmmss
	 * @UsageNotes If the time zone is specified, it will be used throughout the transmission as the default time zone
	 */
	public function setCreationTime($creationTime)
	{
		$this->creationTime = $creationTime;
	}


	/**
	 * Not Defined
	 * @param String $securityText
	 * @UsageNotes This attribute is specified for applications to implement security features for a transmission. Its use is not further specified at this time. 
	 */
	public function setSecurityText($securityText)
	{
		$this->securityText = $securityText;
	}


	/**
	 * The transmission mode with witch a receiver should communicate its receiver responsabilities
	 * @param code $responseModeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ResponseMode.html
	 * @Examples The receiver may respond in a non-immediate manner; the receiver is required send an immediate response; the receiver shall keep any application responses in a queue until such time as the queue is polled. 
	 */
	public function setResponseModeCode($responseModeCode)
	{
		$this->responseModeCode = array(
			'code' => $responseModeCode,
			'codeSystem' => "2.16.840.1.113883.5.1126",
			'codeSystemName' => "ResponseMode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * A unique identifier for a version of a transmission that may be modified and resent
	 * @param code $versionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/HL7StandardVersionCode.html
	 * @DesignComments Definition rewritten. Original note deleted, as Message no longer contains this attribute: "This attribute is also present in the sibling class, Message. This change was made rather than moving this attribute to their common ancestor class, Transmission. This decision was taken because we do not have all the methodology and backwards compatibility issues worked out. Once we have established our backwards compatibility, we should promote this attribute to the parent. The problem is the sequencing of attributes within the HDF and their impact on the ITSs." 
	 * @DeprecationInformation This attribute was deprecated for future use in HL7 Design Models at the November 2011 Harmonization Meetings, effective with RIM version 0237. The version of the specification(s) with which a given instance is compliant should be conveyed using the Transmission.profileId attribute, not with this attribute. When declaring conformance against an HL7 International specification, the profileId root should be 2.16.840.1.113883.1.9. The extension should be in the form [YYYY]NE for Normative Editions and [YYYYMM]DE for development (ballot) editions. Conformance against versions of affiliate and other specifications should be documented using patterns declared as part of those specifications. 
	 */
	public function setVersionCode($versionCode)
	{
		$this->versionCode = array(
			'code' => $versionCode,
			'codeSystem' => "2.16.840.1.113883.5.1097",
			'codeSystemName' => "HL7StandardVersionCode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * The identifier of the V3 interaction that constrains the transmission.
	 * @param UUID $interactionId
	 * @DesignComments Original comment deleted, as Batch no longer has this attribute: "This attribute is also present in the sibling class, Batch. This change was made rather than moving this attribute to their common ancestor class, Transmission. This decision was taken because we do not have all the methodology and backwards compatibility issues worked out. Once we have established our backwards compatibility, we should promote this attribute to the parent. The problem is the sequencing of attributes within the HDF and their impact on the ITSs." 
	 */
	public function setInteractionId($interactionId)
	{
		$this->interactionId = $interactionId;
	}


	/**
	 * The identifier of the profile(s) that constrain the transmission. Includes the version of the specification(s) with which a given instance is compliant. 
	 * @param UUID $profileId
	 * @UsageConstraint When multiple profiles are specified, the transmission instance MUST be valid against all of them. However, a receiver MAY choose to validate against only the first one recognized. For this reason, &apospreferred&apos or more-rigorous profiles SHOULD be listed first. 
	 * When declaring conformance against an HL7 International specification, the profileId root should be 2.16.840.1.113883.1.9. The extension should be in the form [YYYY]NE for Normative Editions and [YYYYMM]DE for development (ballot) editions. Conformance against versions of affiliate and other specifications should be documented using patterns declared as part of those specifications.t 
	 * @UsageNotes The transmission profile allows a given implementation to explicitly state how it differs from the standard interaction definition.
	 */
	public function addProfileId($profileId)
	{
		if (!is_array($this->profileId)) {
			$this->profileId = array();
		}

		$this->profileId[] = $profileId;
	}

	//associations
	

	/**
	 * Adding an acknoledged element
	 * @param Acknoledgement &$acknoledgedBy non null
	 */
	public function addAcknowledgedBy(&$acknoledgedBy)
	{
		if (!is_array($this->acknoledgedBy)) {
			$this->acknoledgedBy = array();
		}

		if (is_a($acknoledgedBy, 'Acknowledgement') && !is_null($acknoledgedBy)) {
			$this->acknoledgedBy[] = $acknoledgedBy;
		}
	}


	public function addAttachment(&$attachment)
	{
		if (!is_array($this->attachment)) {
			$this->attachment = array();
		}

		if (is_a($attachment, 'Attachment') && !is_null($attachment)) {
			$this->attachment[] = $attachment;
		}
	}

	public function addAttetionLine(&$attentionLine)
	{
		if (!is_array($this->attentionLine)) {
			$this->attentionLine = array();
		}

		if (is_a($attentionLine, 'AttentionLine') && !is_null($attentionLine)) {
			$this->attentionLine[] = $attentionLine;
		}
	}


	public function setBatch(&$batch)
	{
		if (is_a($batch, 'Batch') && !is_null($batch)) {
			$this->batch = $batch;
		}
	}


	public function addCommunicationFunction(&$communicationFunction)
	{
		if (!is_array($this->communicationFunction)) {
			$this->communicationFunction = array();
		}

		if (is_a($communicationFunction, 'CommunicationFunction') && !is_null($communicationFunction)) {
			$this->communicationFunction[] = $communicationFunction;
		}
	}


	public function addConveyedAcknowledgement($conveyedAcknoledgement)
	{
		if (!is_array($this->conveyedAcknoledgement)) {
			$this->conveyedAcknoledgement = array();
		}

		if (is_a($conveyedAcknoledgement, 'Acknowledgement') && !is_null($conveyedAcknoledgement)) {
			$this->conveyedAcknoledgement[] = $conveyedAcknoledgement;
		}
	}


	public function addInboundRelationship(&$inboundRelationship)
	{
		if (!is_array($this->inboundRelationship)) {
			$this->inboundRelationship = array();
		}

		if (is_a($inboundRelationship, 'TransmissionRelationship') && !is_null($inboundRelationship)) {
			$this->inboundRelationship[] = $inboundRelationship;
		}
	}


	public function addOutboundRelationship(&$outboundRelationship)
	{
		if (!is_array($this->outboundRelationship)) {
			$this->outboundRelationship = array();
		}

		if (is_a($outboundRelationship, 'TransmissionRelationship') && !is_null($outboundRelationship)) {
			$this->outboundRelationship[] = $outboundRelationship;
		}
	}
}

 ?>