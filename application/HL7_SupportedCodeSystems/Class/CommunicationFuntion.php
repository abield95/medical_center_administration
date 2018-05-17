<?php 

require_once 'InfrastructureRoot.php';
require_once 'Entity.php';

/**
 * CommunicationFunction
 * Definition: A relationship class that binds the various entities participating in the transmission (sender, receiver, respond-to) to be linked to the transmission. 
 */
class CommunicationFunction extends InfrastructureRoot
{
	private $typeCode;
	private $telecom;

	//associations of CommunicationsFuntion
	private $entity; //1...*
	private $transmission;//1...*

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/CommunicationFunctionType.html
	 * Definition: The role of an entity with respect to the transmission.
	 * Examples: Sender, Receiber, respond-to-party
	**/
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $typeCode,
			'codeSystem' => "2.16.840.1.113883.5.1056",
			'codeSystemName' => "CommunicationFunctionType",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $telecom The telecomm address that can be used to reach the entity in the identified role.
	**/
	public function setTelecom($telecom)
	{
		$this->telecom = $telecom;
	}


	public function setEntity(&$entity)
	{
		$this->entity = $entity;
	}

	public function setTransmision(&$transmission)
	{
		$this->transmission = $transmission;
	}
}

 ?>