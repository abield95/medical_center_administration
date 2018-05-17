<?php 

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
	private $acknoledgementDetail;
	private $acknoledges;
	private $conveyingTransmission;

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/AcknowledgementType.html
	 * Definition: The acknowledgement as defined in an enumerated set of acknowledgement types.
	 * Examples: The receiving application successfully processed message; the receiving application found error(s) in message
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
}

 ?>