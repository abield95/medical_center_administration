<?php 

namespace CommunicationInfrastructure\MessageCommunicationsControl\MessageControl;

require_once 'Transmission.php';

/**
 * Message
 * @Definition The parent class of all HL7 Version 3 messages.
 * @DesignComments This may be the parent class, but that's not what makes it a message. What are the criteria for deciding whether something should be modeled as a message? 
 */
class Message extends Transmission
{
	private $processingCode;
	private $processingModeCode;
	private $acceptAckCode;
	private $responseCode;
	private $sequenceNumber;
	private $attachmentText;

	//associations
	private $controlAct;//(0..*)ControlAct::payload(0..1)

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * The intended purpose for the message relative to the state of the sending system.
	 * @param Code $processingCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ProcessingID.html
	 * @example Production, training, debugging
	 */
	public function setProcessingCode($processingCode)
	{
		$this->processingCode = array(
			'code' => $processingCode,
			'codeSystem' => "2.16.840.1.113883.5.100",
			'codeSystemName' => "ProcessingID",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * The mode in which the message is to be processed.
	 * @param Code $processingModeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ProcessingMode.html
	 * @example Current processing, archive mode, initial load mode, restore from archive mode.
	 */
	public function setProcessingModeCode($processingModeCode)
	{
		$this->processingModeCode = array(
			'code' => $processingModeCode,
			'codeSystem' => "2.16.840.1.113883.5.101",
			'codeSystemName' => "ProcessingMode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * The conditions under which "accept" acknowledgements are required to be returned in response to this message.
	 * @param Code $acceptAckCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/AcknowledgementCondition.html
	 */
	public function setAcceptAckCode($acceptAckCode)
	{
		$this->acceptAckCode = array(
			'code' => $acceptAckCode,
			'codeSystem' => "2.16.840.1.113883.5.1050",
			'codeSystemName' => "AcknowledgementCondition",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * Whether an application response is expected from the addressee of this interaction and what level of detail that response should include. 
	 * @param Code $responseCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ResponseLevel.html
	 * @UsageNotes This attribute restricts the response options for the receiver.
	 * @example If an interaction has receiver responsibilities to send either an accept interaction or a refuse interaction, and the responseCode is set to 'E' - Exception, the receiver should only respond if they refuse.
	 */
	public function setResponseCode($responseCode)
	{
		$this->responseCode = array(
			'code' => $responseCode,
			'codeSystem' => "2.16.840.1.113883.5.108",
			'codeSystemName' => "ResponseLevel",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * The index of the message in a sequence.
	 * @param Int $sequenceNumber Positive
	 * @UsageNotes This attribute is provided for implementing the sequence number protocol. This field is incremented by one for each subsequent value assignment. 
	 */
	public function setSequenceNumber($sequenceNumber)
	{
		$this->sequenceNumber = ($sequenceNumber >= 0) ? $sequenceNumber : 0;
	}


	/**
	 * Arbitrary attachments of data blocks which can be referred to from the interior of the message.
	 * @param EncapsulatedData $attachmentText datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-ED
	 * @UsageNotes Any ITS is advised to represent the attachments after the main message body. Attachments are referred to from the message body using the reference functionality of the ED data type. 
	 * @deprecatedUse of this attribute has been superseded by the addition of the Attachment class to the RIM, and further use if this attribute is deprecated in favor of the new approach. This attribute was removed from the RIM in version 2.38, per Harmonization decision in March 2012. However, subsequent analysis of the result of that step upon CMETs, Wrappers and other shared models that use this attribute led to the conclusion in July 2012 Harmonization that the action was too precipitate. The attribute was returned to the RIM in version 2.40 per Harmonization Action on July 11, 2012. It will be removed in a later version (with Harmonization approval) once a strategy to deal with this removal in existing models has been put in place. 
	 */
	public function addAttachmentText($attachmentText)
	{
		if (!is_array($this->attachmentText)) {
			$this->attachmentText = array();
		}

		$this->attachmentText[] = $attachmentText;
	}

	//associatins
	
	/**
	 * ControlAct Object
	 * @param ControlAct &$controlAct
	 */
	public function addControlAct(&$controlAct)
	{
		if (!is_array($this->controlAct)) {
			$this->controlAct = array();
		}

		if (is_a($controlAct, 'ControlAct') && !is_null($controlAct)) {
			$this->controlAct[] = $controlAct;
		}
	}
}

 ?>