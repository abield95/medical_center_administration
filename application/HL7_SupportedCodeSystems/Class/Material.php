<?php 

require_once('Entity.php');

/**
 * Material
 * Definition: A subtype of Entity that is inanimate and locationally independent. 
 * UsageNotes: Materials are entities that are neither Living Subjects nor places. Manufactured or processed products are considered material, even if they originate as living matter. Materials come in a wide variety of physical forms and can pass through different states (ie. Gas, liquid, solid) while still retaining their physical composition and material characteristics.
 * DesignComments: Clarify the meaning of "locationally independent"; suggest removing it and supplanting with first Usage Note sentence.
 * Examples: Pharmaceutical substances (including active vaccines containing retarded virus), disposable supplies, durable equipment, implantable devices, food items (including meat or plant products), waste, traded goods 
 */
class Material extends Entity
{
	private $formCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("MAT");
		$this->formCode = NULL;
	}


	/**
	 * @param $formCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#MaterialForm
	 * Defintion: The physical state and nature of the material.
	 * Examples: Solid; liquid; gas; tablet; ointment; gel 
	**/
	public function setFromCode($formCode)
	{
		$this->formCode = $formCode;
	}
}


 ?>