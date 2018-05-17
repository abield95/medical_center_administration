<?php 

require_once('ManufacturedMaterial.php');

/**
 * Container
 * Definition: An Entity that holds other Entities
 * UsageNotes: Content material is related to a Container through Role.classCode = CONT (content).
 * Rationale: The specifications for this class arose from the collaboration between HL7 and the NCCLS. Many of the attribute definitions are drawn from or make reference to the NCCLS standard. With amorphic substances (e.g., liquids and gases), a container is required. However, the content of a container is always distinguishable and relatively easily separable from the container, unlike the content (ingredient) of a mixture. 
 */
class Container extends ManufacturedMaterial
{
	private $capacityQuantity;
	private $heightQuantity;
	private $diameterQuantity;
	private $capTypeCode;
	private $separatorTypeCode;
	private $barrierDeltaQuantity;
	private $bottomDeltaQuantity;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("CONT");
		$this->capacityQuantity = NULL;
		$this->heightQuantity = NULL;
		$this->diameterQuantity = NULL;
		$this->capTypeCode = NULL;
		$this->separatorTypeCode = NULL;
		$this->barrierDeltaQuantity = NULL;
		$this->bottomDeltaQuantity = NULL;
	}


	/**
	 * @param $capacityQuantity The functional capacity of the container.
	 * @param $unit the measured unit
	**/
	public function setCapacityQuantity($capacityQuantity, $unit)
	{
		$this->capacityQuantity = array('quantity' => $capacityQuantity, 'unit' => $unit);
	}

	/**
	 * @param $heightQuantity The height of the container.
	 * @param $unit the measured unit
	**/
	public function setHeightQuantity($heightQuantity, $unit)
	{
		$this->heightQuantity = array('quantity' => $heightQuantity, 'unit' => $unit);
	}

	/**
	 * @param $diameterQuantity TThe outside diameter of the container.
	 * @param $unit the measured unit
	**/
	public function setDiameterQuantity($diameterQuantity, $unit)
	{
		$this->diameterQuantity = array('quantity' => $diameterQuantity, 'unit' => $unit);
	}


	/**
	 * @param $capTypeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ContainerCap.html
	 * Definition: The type of cap (closure) associated with the container that is the entity being described.
	**/
	public function setCapTypeCode($capTypeCode)
	{
		$this->capTypeCode = array(
			'code' => $capTypeCode,
			'codeSystem' => "2.16.840.1.113883.5.26",
			'codeSystemName' => "ContainerCap",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $separatorTypeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ContainerSeparator.html
	 * Definition: A material added to a container to facilitate and create a physical separation of specimen components of differing density.
	 * Rationale: The composition or nature of the separator material may have an effect on the analysis. Knowledge of the material aids interpretation of results. 
	 * Examples: A gel material added to blood collection tubes that, following centrifugation, creates a physical barrier between the blood cells and the serum or plasma. 
	**/
	public function setSeparatorTypeCode($separatorTypeCode)
	{
		$this->separatorTypeCode = array(
			'code' => $separatorTypeCode,
			'codeSystem' => "2.16.840.1.113883.5.27",
			'codeSystemName' => "ContainerSeparator",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $barrierDeltaQuantity The distance from the point of reference to the separator material (barrier) within a container. 
	 * UsageNotes: This distance may be provided by a laboratory automation system to an instrument and/or specimen processing/handling device to facilitate the insertion of a sampling probe into the specimen without touching the separator. See the Point of Reference definition or in NCCLS standard AUTO5, .
	**/
	public function setBarrierDeltaQuantity($barrierDeltaQuantity, $unit)
	{
		$this->barrierDeltaQuantity = array('quantity' => $barrierDeltaQuantity, 'unit' => $unit);
	}


	/**
	 * @param $bottomDeltaQuantity The distance from the Point of Reference to the outside bottom of the container. 
	 * UsageNotes: Refer to Point of Reference in NCCLS standard AUTO5 .
	**/
	public function setBottonDeltaQuantity($bottomDeltaQuantity, $unit)
	{
		$this->bottomDeltaQuantity = array('quantity' => $bottomDeltaQuantity, 'unit' => $unit);
	}
}

?>