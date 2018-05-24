<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'InfrastructureRoot.php';

//awaiting development

/**
 * Acknowledgement
 * Definition: Metadata necessary when acknowledging a message.
 */
class Acknowledgement extends InfrastructureRoot
{
	private $typeCode;
	private $expectedSequenceNumber;
	private $messageWaitingNumber;
	private $messageWaitingPriorityCode;

	//Associations of Acknoledgement
	private $acknoledgementDetail; //AcknoledgementDetail::acknoledgement
	private $acknoledges;//Transmision::acknoledgedBy
	private $conveyingTransmission;//Transmision::conveyedAcknoledment

	function __construct()
	{
		parent::__construct();
		$this->typeCode = NULL;
		$this->expectedSequenceNumber = NULL;
	}


	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/AcknowledgementType.html
	 * @Definition The acknowledgement as defined in an enumerated set of acknowledgement types.
	 * @Examples The receiving application successfully processed message; the receiving application found error(s) in message
	**/
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.18",
			'codeSystemName' => "AcknowledgementType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $expectedSequenceNumber The sequence number of the message within a set of messages. Int Positive
	**/
	public function setExpectedSequenceNumber($expectedSequenceNumber)
	{
		$this->expectedSequenceNumber = ($expectedSequenceNumber > 0 ) ? $expectedSequenceNumber : NULL;
	}


	/**
	 * @param $messageWaitingNumber  The number of messages the acknoledging application has waiting in queue for the receiving application
	 * @UsageNotes These messages would need to be retrieved via queries. The message count facilitates receiving applications that cannot receive unsolicited message (i.e., polling). 
	 * @Examples If there are 3 low priority messages, 1 medium priority message and 1 high priority message, the message waiting number would be 5, because that is the total number of messages. 
	**/
	public function setMessageWaitingNumber($messageWaitingNumber)
	{
		$this->messageWaitingNumber = ($messageWaitingNumber >= 0) ? $messageWaitingNumber : NULL;
	}


	/**
	 * @param $messageWaitingPriorityCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/MessageWaitingPriority.html
	 * @Definition The highest level of importance in the set of messages the acknowledging application has waiting in queue for the receiving application. 
	 * @UsageNotes These messages would need to be retrieved via queries. This facilitates receiving applications that cannot receive unsolicited messages (i.e., polling). The specific code specified identifies how important the most important waiting message is and may affect how soon the receiving application is required to poll for the message. Priority may be used by local agreement to determine the timeframe in which the receiving application is expected to retrieve the messages from the queue 
	**/
	public function setMessageWaitingPriorityCode($messageWaitingPriorityCode)
	{
		$this->messageWaitingPriorityCode = array(
			'code' => $messageWaitingPriorityCode,
			'codeSystem' => "2.16.840.1.113883.5.1083",
			'codeSystemName' => "MessageWaitingPriority",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>