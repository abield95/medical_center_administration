<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'InfrastructureRoot.php';

/**
 * Attachment
 * @Definition An addressable data block which can be referred to from the interior of the message. 
 * @UsageNotes Attachments are referred to from the message body using the reference functionality of the ED data type.
 * @DesignComments Open issue requires more detail
 * @OpenIssue Proper use of this class (Attachment) requires an extension of the referencing mechanism of the ED data type. 
 */
class Attachment extends InfrastructureRoot
{
	private $id;
	private $text;

	//associaitions
	private $transmission;//(0..1)Transmission::attachment(0..*)

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * An identifier for the attachment referenced by an ED attribute contained elsewhere in the interaction.
	 * @param file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-II $id An identifier that uniquely identifies a thing or object. Examples are object identifier for HL7 RIM objects, medical record number, order id, service catalog item id, Vehicle Identification Number (VIN), etc. 
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * The data block that constitutes the attachment
	 * @param file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-ED $text Data that is primarily intended for human interpretation or for further machine processing outside the scope of HL7. 
	 */
	public function setText($text)
	{
		$this->text = $text;
	}


	/**
	 * Transmission assiciation
	 * @param Transmission &$attachment The transmission object where is deployed
	 */
	public function setTransmission(&$attachment)
	{
		if (is_a($attachment, 'Transmission') && !is_null($attachment)) {
			$this->attachment = $attachment;
		}
	}
}

 ?>