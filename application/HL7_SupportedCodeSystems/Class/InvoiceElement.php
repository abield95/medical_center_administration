<?php 

/**
 * later development from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/rim/rim.html#InvoiceElement-cls
 **/
namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';


/**
 * InvoiceElement
 * @Definition A statement and explanation of an amount owed
 * @UsageNotes This represents the 'justification' portion of an invoice. It is frequently combined with a financial transaction representing the amount requested to be paid, agreed to be paid, or actually paid. A recursive relationship can be used to break a single InvoiceElement into its constituent elements. In definition mood, it represents possible justification for future billing. In request mood, it is a request to determine the amount owed. In event mood, this class represents the determination of a specific amount owed by a particular Entity.  
 */
class InvoiceElement extends Act
{
	private $modifierCode;
	private $unitQuantity;
	private $unitPriceAmt;
	private $netAmt;
	private $factorNumber;
	private $pointsNumber;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("INVE");
	}


	/**
	 * @param $modifierCode values unknown file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#InvoiceElementModifier
	 * @Definition A classifier for the invoice element
	 * @Rationale This is not pre-coordinated into the code attribute because the modifier code set may not be specifically designed for use with the Act.code code set. This violates the constraint for using the 'modifier' property that the modifier code set must be defined as part of, or specifically for the base code set. 
	 * @DesignComments Regarding rationale: the reason Act.code is unconstrained is so that it can accommodate domains without restriction. Where is the modifier property constrained in this way? If this refers to the CD datatype modifier, it should be implicit in the coded attribute. 
	 * @Examples Isolation allowance, after-hours service
	**/
	public function setModifierCode($modifierCode)
	{
		$this->modifierCode = $modifierCode;
	}
}

 ?>