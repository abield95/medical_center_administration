<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'InfrastructureRoot.php';

/**
 * AcknoledgementDetail
 * @Definition A message that provides information about the communication, parsing or formal (non-business-rule) validation of the message being acknowledged. 
 */
class AcknoledgementDetail extends InfrastructureRoot
{
	private $typeCode;
	private $code;
	private $text;
	private $location;

	//associations
	private $acknoledgement;//Acknoledgement::acknoledgementDetail

	function __construct()
	{
		parent::__construct();

	}


	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/AcknowledgementDetailType.html
	 * @Definition The kind of information specified in the acknowledgement message.
	 * @Examples Error, warning, information
	**/
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.1082",
			'codeSystemName' => "AcknowledgementDetailType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $code from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/AcknowledgementDetailCode.html
	 * @Definition The type of acknowledgement, from an enumerated set of acknowledgement types.
	 * @DesignComments Original examples seem to indicate text, not code, by including specific attributes, dates. New examples supplied from concept domain. 
	 * @Examples Required attribute missing; unsupported interaction; invalid code system in CNE.
	**/
	public function setCode($code)
	{
		$this->code = array(
			'code' => $code,
			'codeSystem' => "2.16.840.1.113883.5.1100",
			'codeSystemName' => "AcknowledgementDetailCode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $text datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-ED
	 * @Definition dditional diagnostic information relevant to the message.
	 * @UsageNotes This may be free text or structured data (eg, XML)
	 * @Examples Java Exception, memory dump, internal error code, call-stack information
	**/
	public function setText($text)
	{
		$this->text = $text;
	}


	/**
	 * @param $locaition The position within the message being acknowledged that is related to the acknowledgement message.
	 * @UsageNotes Only messages with localized errors will have this attribute populated. Open Issue: The specific format for the string that defines the message location needs to be identified. This might be "XPath" or possibly "OCL". 
	 * @Examples Location of missing required attribute; location of invalid code in CNE; location not valued for unsupported interaction.
	**/
	public function setLocation($location)
	{
		$this->location = $location;
	}


	public function setAcknoledgement(&$acknowledgement)
	{
		if (is_a($acknowledgement, 'Acknoledgement') && !is_null($acknowledgement)) {
			$this->acknowledgement = $acknowledgement;
		}
	}
}

 ?>