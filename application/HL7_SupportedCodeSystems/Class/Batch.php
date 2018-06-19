<?php 

namespace CommunicationInfrastructure\MessageCommunicationsControl\MessageControl;

require_once 'Transmission.php';

/**
 * Batch
 * @Definition A message which is a collection of HL7 V3 messages. 
 * @DesignComments Does the batch have any effect on the member message, or is it a composition class that contains the member messages?
 */
class Batch extends Transmission
{
	private $referenceControlId;
	private $name;
	private $batchComment;
	private $transmissionQuantity;
	private $batchTotalNumber;
	private $contentProcessingModeCode;

	//associations
	private $transmission;//(0..*)Transmission::batch(0..1)

	function __construct()
	{
		parent::__construct();
		$this->referenceControlId = NULL;
		$this->name = NULL;
		$this->batchComment = NULL;
		$this->transmissionQuantity = NULL;
		$this->batchTotalNumber = NULL;
		$this->setContentProcessingModeCode("SEQL");
	}


	/**
	 * The control identifier of the batch when it was originally transmitted.
	 * @param file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-II $referenceControlId
	 */
	public function setReferenceControlId($referenceControlId)
	{
		$this->referenceControlId = $referenceControlId;
	}


	/**
	 * An identifier for the batch.
	 * @param String $name
	 * @UsageNotes This attribute is used by the application processing the batch.
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Comments related to the batch.
	 * @param String $batchComment
	 */
	public function addBatchComment($batchComment)
	{
		if (!is_array($this->batchComment)) {
			$this->batchComment = array();
		}

		$this->batchComment[] = $batchComment;
	}


	/**
	 * The count of individual transmissions contained within the batch, including nested batches.
	 * @param int $transmissionQuantity Positivo
	 */
	public function setTransmissionQuantity($transmissionQuantity)
	{
		$this->transmissionQuantity = ($transmissionQuantity >= 0 ) ? $transmissionQuantity : 0;
	}


	/**
	 * The total number of messages in the batch.
	 * @param Int $batchTotalNumber Positivo
	 * @UsageNotes In cases of nested batches, batchTotalNumber is specific to the immediate batch, whereas transmissionQuantity sums all nested totals. 
	 * @DesignComments Confirm differentiation from transmissionQuantity
	 */
	public function addBatchTotalNumber($batchTotalNumber)
	{
		if (!is_array($this->batchTotalNumber)) {
			$this->batchTotalNumber = array();
		}

		$this->batchTotalNumber[] = ($batchTotalNumber > 0) ? $batchTotalNumber : 0;
	}


	/**
	 * The type of content processing that the receiver of the batch is expected to undertake.
	 * @param Code $contentProcessingModeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ContentProcessingMode.html
	 * @UsageNotes Default value is sequential.
	 * @Examples Sequential, unordered.
	 */
	public function setContentProcessingModeCode($contentProcessingModeCode)
	{
		$this->contentProcessingModeCode = array(
			'code' => $contentProcessingModeCode,
			'codeSystem' => "2.16.840.1.113883.5.1110",
			'codeSystemName' => "ContentProcessingMode",
			'codeSystemVersion' => "1"
		);
	}

	//associations
	/**
	 * The transmission wrapper
	 * @param Transmission &$transmission
	 */
	public function addTransmission(&$transmission)
	{
		if (!is_array($this->transmission)) {
			$this->transmission = array();
		}

		if (is_a($transmission, 'Transmission') && !is_null($transmission)) {
			$this->transmission[] = $transmission;
		}
	}
}

 ?>