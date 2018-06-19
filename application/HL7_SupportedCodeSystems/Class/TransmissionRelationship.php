<?php 

namespace CommunicationInfrastructure\MessageCommunicationsControl\MessageControl;

require_once 'InfrastructureRoot.php';

/**
 * TransmissionRelationship
 * @Definition A directed association between a source Transmission and a target Transmission.
 * @UsageNotes TransmissionRelationships on the same source Transmission are called the "outbound" transmission relationships of that Transmission. TransmissionRelationships on the same target Transmission are called the "inbound" relationships of that Transmission. The meaning and purpose of a TransmissionRelationship is specified in the TransmissionRelationship.typeCode attribute. The initial implementation envisages a single type.
 */
class TransmissionRelationship extends CommunicationInfrastructure\CoreInfrastructureInfrastructureRoot
{
	private $typeCode;

	//associations
	private $target;//(1..1)Transmission::inboundRelationship(0..*)
	private $source;//(1..1)Transmission::outboundRelationship

	function __construct()
	{
		parent::__construct();
		$this->setTypeCode("SEQL");
		$this->target = NULL;
		$this->source = NULL;
	}


	/**
	 * The purpose of a TransmissionRelationship instance.
	 * @param Code $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/TransmissionRelationshipTypeCode.html
	 * @UsageConstraint Each value implies specific constraints on how Transmission objects can be related.
	 * @example SEQL "A transmission relationship indicating that the source transmission follows the target transmission."
	 */
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.1111",
			'codeSystemName' => "TransmissionRelationshipTypeCode",
			'codeSystemVersion' => "1"
		);
	}


	//associations
	public function setTarget(&$target)
	{
		if ($this->source != NULL && $this->source != $target) {
			if (is_a($target, 'Transmission') && !is_null($target)) {
				$target->addInboundRelationship($this);
				$this->target = $target;
			}
		}
	}


	public function setSource(&$source)
	{
		if ($this->target != NULL && $this->target != $source) {
			if (is_a($source, 'Transmission') && !is_null($source)) {
				$source->addOutboundRelationship($this);
				$this->source = $source;
			}
		}
	}
}

 ?>