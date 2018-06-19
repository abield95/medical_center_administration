<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * Supply
 * @Definition Provision of a material by one entity to another
 * @UsageNotes The product is associated with the Supply Act via Participation.typeCode="product". Generally, with Supply Acts, the precise identification of the Material (manufacturer, serial numbers, etc.) is important. Most of the detailed information about the Supply should be represented using the Material class. If delivery needs to be scheduled, tracked, and billed separately, one can associate a Transportation Act with the Supply Act. Pharmacy dispense services are represented as Supply Acts, associated with a SubstanceAdministration Act. The SubstanceAdministration class represents the administration of medication, while dispensing is Supply. 
 * @Examples Ordering bed sheets; Dispensing of a drug; Issuing medical supplies from storage
 */
class Supply extends Act
{
	private $quantity;
	private $expectedUseTime;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("SPLY");
		$this->quantity = NULL;
		$this->expectedUseTime = NULL;
	}


	/**
	 * Specifies the amount of the player Entity of the "product" Participation's role that that was or is to be supplied.
	 * @param REAL $quantity The Magnitude of the quantity measured in terms of unit
	 * @param CS $unit     The unit of measure specified in the Unified Code for Units of Measure (UCUM) [http://aurora.regenstrief.org/ucum]. The default unit is 1. 
	 * @UsageNotes This attribute may be used as an alternative to expectedUseTime or both may be used. If both are specified, then the specified quantity is the amount expected to be consumed within the expectedUseTime. Non-measured, but countable units such as tablet and capsule must not be specified using the unit component of the PQ data type, except as an annotation, marked by {xxx}. The type of 'countable' information is determined by information in the 'product' entity. 
	 * @DesignComments Deleted restriction on countable units.
	 */
	public function setQuantity($quantity, $unit)
	{
		$this->quantity = ($quantity >= 0) ? $quantity : NULL;
	}


	/**
	 * The period time over which the supplied product is expected to be used.
	 * @param Array $expectedUseTime In some situations, this attribute MAY be used instead of Supply.quantity to identify the amount supplied by how long it is expected to last, rather than the physical quantity issued, e.g., 90 days supply of medication (based on an ordered dosage), 10 hours of jet fuel, etc. When possible, it is always better to specify Supply.quantity, as this tends to be more precise. Supply.expectedUseTime will always be an estimate that can be influenced by external factors.
	 * @Examples ["yyyymmddhhmmss","yyyymmddhhmmss"]
	 */
	public function setExpectedUseTime($expectedUseTime)
	{
		$this->expectedUseTime = $expectedUseTime;
	}
}

 ?>