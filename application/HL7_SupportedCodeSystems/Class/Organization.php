<?php 

require_once('Entity.php');

/**
 * Organization
 * Definition: An Entity representing a formalized group of persons or other organizations with a common purpose and the infrastructure to carry out that purpose. 
 * Examples: Companies and institutions, a government department, an incorporated body that is responsible for administering a facility, an insurance company 
 */
class Organization extends Entity
{
	private $addr;
	private $standardIndustryClassCode;
	function __construct()
	{
		parent::__construct();
		$this->setClassCode("ORG");
		$this->addr = NULL;
		$this->standardIndustryClassCode = NULL;
	}


	/**
	 * @param $addr The postal or residential address of an organization
	**/
	public function addAddr($addr)
	{
		if (!is_array($this->addr)) {
			$this->addr = array();
		}

		$this->addr[] = $addr;
	}


	/**
	 * @param $standardIndustryClassCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ExternalSystems.html#naics
	 * Definition: The industrial category of an organization.
	 * Example: NAICS codes (e.g., 11231-Chicken Egg Production, 6211- Offices of Physicians, 621511 - Medical Laboratories).
	**/
	public function setStandardIndustryClassCOde($standardIndustryClassCode)
	{
		$this->standardIndustryClassCode = array(
			'code' => $standardIndustryClassCode,
			'codeSystem' => "2.16.840.1.113883.6.85",
			'codeSystemName' => "North American Industry Classification System",
			'codeSystemVersion' => "1"
		);
	}
}


 ?>