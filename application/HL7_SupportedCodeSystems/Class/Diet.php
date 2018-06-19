<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Supply.php';

/**
 * Diet
 * @DeprecationInformation This class was deprecated at the August 2009 Harmonization Meeting for future use in HL7 Design Models effective with RIM Release 2.28. In the future, use either the Supply class (if dealing with what should be given to the patient) or SubstanceAdministration class (if dealing with what the patient should consume).
 * @Defition A supply Act dealing specifically with the feeding or nourishment of a subject.
 * @UsageNotes The detail of the diet is given as a description of the Material associated via Participation.typeCode="product". Medically relevant diet types may be communicated in Diet.code, however, the detail of the food supplied and the various combinations of dishes should be communicated as Material instances. 
 * @DesignComments The introduction should stipulate how to document usage of or constraints on attributes from the generalization-e.g. Diet.code.
 * @Examples Gluten free, low sodium.
 */
class Diet extends Supply
{
	private $energyQuantity;
	private $carbohydrateQuantity;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("DIET");
		$this->energyQuantity = NULL;
		$this->carbohydrateQuantity = NULL;
	}


	/**
	 * The supplied biologic energy (calories) per day.
	 * @DeprecationInformation This attribute was deprecated along with its parent class at the August 2009 Harmonization Meeting. It is deprecated for future use in HL7 Design Models effective with RIM Release 2.28. In the future, this quantity can be conveyed by using a Content relationship with a quantity attribute expressing the "calories". 
	 * @param Real $energyQuantity The Magnitude of the quantity measured in terms of unit
	 * @param CS $unit           The unit of measure specified in the Unified Code for Units of Measure (UCUM) [http://aurora.regenstrief.org/ucum]. The default unit is 1. 
	 * @ForamlConstraint This physical quantity SHOULD be convertible to 1 kcal/d (or 1 kJ/d).
	 */
	public function setEnergyQuantity($energyQuantity, $unit)
	{
		$this->energyQuantity = array(
			'quantity' => $energyQuantity,
			'unit' => $unit
		);
	}


	/**
	 * The supplied amount of carbohydrates per day.
	 * @param REAL $carbohydrateQuantity The Magnitude of the quantity measured in terms of unit
	 * @param CS $unit  The unit of measure specified in the Unified Code for Units of Measure (UCUM) [http://aurora.regenstrief.org/ucum]. The default unit is 1. 
	 * @UsageNotes For a diabetes diet one typically restricts the amount of metabolized carbohydrates to a certain amount per day (e.g., 240 g/d). This restriction can be communicated in the carbohydrateQuantity. 
	 * @DesignComments Units (g) was in definition, but there does not seem to be a constraint on PQ.
	 */
	public function setCarbohydrateQuantity($carbohydrateQuantity, $unit)
	{
		$this->carbohydrateQuantity = array(
			'quantity' => $carbohydrateQuantity,
			'unit'		=> $unit
		)
	}
}

 ?>