<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'InfrastructureRoot.php';

/**
 * AttentionLine
 * @Definition A collection of parameters related to a transmission that may need to be accessible from the transmission wrapper. 
 * @UsageConstraint The contents of the class shall be related to the transmission as a whole and shall be solely used for transmission related purposes and not have any impact on the semantic interpretation of the contents of the transmission. 
 * @UsageNotes AttentionLine is a name-value pair, with keyWordText providing the topic from an enumerated set and value providing the parameter.
 * @DesignComments Confirm edits. Clarify in definition, add to examples.
 * @Examples If encrypted or compressed payloads are used, and the receiver needs to have access to the Patient.id for internal routing purposes within the receiving application, then the sender can make this information available in AttentionLine. 
 */
class AttentionLine extends InfrastructureRoot
{
	private $keyWordText;
	private $value;

	//associations
	private $transmission;//(1..1) Transmission::attentionLine(0..*)

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * A category of  attentionLine parameter
	 * @param  String $keyWordText Non trducible string
	 * @Examples Patient identifier, public health case type
	 */
	public function setkeyWordText($keyWordText)
	{
		$this->keyWordText = $keyWordText;
	}


	/**
	 * A value associated with the keys as provided inthe AttentionLine.keyWordText attribute
	 * @param ANY $value Any datatype or value
	 * @FormalConstraint The data type of the attribute SHALL be constrained to one of the following data types: BL, CV, II, URL, INT, REAL, TS, PQ, MO, IVL<TS>. 
	 */
	public function addValue($value)
	{
		if (!is_array($this->value)) {
			$this->value = array();
		}

		$this->value[] = $value;
	}


	/**
	 * Transmission value
	 * @param Transmission &$transmission The transmission object
	 */
	public function setTransmission(&$transmission)
	{
		if (is_a($transmission, 'Transmission') && !is_null($transmission)) {
			$this->transmission = $transmission;
		}
	}
}

 ?>