<?php 

require_once('Material.php');

/**
 * ManufacturedMaterial
 * Definition: An Entity or combination of Entities transformed for a particular purpose by a manufacturing process.
 * UsageNotes: This class encompasses containers, devices, software modules and facilities. It is used to further define the characteristics of Entities that are created out of other Entities. These entities are identified and tracked through associations and mechanisms unique to the class, such as lotName, stabilityTime and expirationTime. 
 * Examples: Processed food products, disposable syringes, chemistry analyzer, saline for infusion
 */
class ManufacturedMaterial extends Material
{
	private $lotNumberText;
	private $expirationTime;
	private $stabilityTime;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("MMAT");
		$this->lotNumberText = NULL;
		$this->expirationTime = NULL;
		$this->stabilityTime = NULL;
	}


	/**
	 * @param $lotNumberText An identifier for a particular batch of manufactured material.
	 * UsageNotes: The lot name is usually printed on the label attached to the container holding the substance and/or on the packaging which houses the container. Note that a lot number is not meant to be a unique identifier; it is meaningful only when the product kind and manufacturer are also identified. 
	**/
	public function setLotNumberText($lotNumberText)
	{
		$this->lotNumberText = $lotNumberText;
	}


	/**
	 * @param $expirationTime The date and time after which the manufacturer no longer ensures the safety, quality, and/or proper functioning of the material.
	 * Rationale: There is a need in many situations that the materials used are of a specific quality or potency or functional status. The ending date for this guarantee is specified by the manufacturer. After that date, while the material may still provide the same characteristics, the manufacturer no longer takes responsibility that the product will perform as specified and denies responsibility for failure of the material.
	 example: yyyymmddhhmmss (year, month, day, hour, minutes, seconds);
	**/
	public function setExpirationTime($expirationTime)
	{
		$this->expirationTime = $expirationTime;
	}


	/**
	 * @param $stabilityTime The duration over which the material is considered useable after it is activated.
	 * UsageNotes: If a kind of material is described (determinerCode = KIND), only the width of that interval can be known, i.e., the duration after opening the reagent container at which the reagent substance is considered useable for its normal testing purpose. The timestamps cannot be taken to refer to calendar points in time, and the stabilityTime.low TS may be zero, stabilityTime.high being the scalar magnitude of the duration. 
	 For an actual instance of the reagent (determinerCode = Instance), the stabilityTime.low TS marks the calendar time at which the reagent bottle has been opened (or the reagent was otherwise activated). The characteristic (KIND) duration is added to stabilityTime.low to determine the stabilityTime.high TS, the point in time beyond which the reagent is no longer considered useable for its normal purpose. 
	**/
	public function setStabilityTime($stabilityTime)
	{
		$this->stabilityTime = $stabilityTime;
	}
}


 ?>