<?php 

require_once 'Role.php';

/**
 * Patient
 * @Definition A LivingSubject as a recipient of health care services from a healthcare provider.
 * @UsageNotes The patient is the player; the provider is the scoper.
 */
class Patient extends Role
{
	private $veryImportantPersonCode;

	function __construct()
	{
		parent::__construct();
		parent::setClassCode("PAT");
	}


	/**
	 * @param $VIPCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/PatientImportance.html
	 * @Definition A patient's special status granted by the scoping organization
	 * @Rationale This special status often results in preferred treatment and special considerations.
	 * @Examples Board member; diplomat
	**/
	public function setVIPCode($VIPCode)
	{
		$this->veryImportantPersonCode = array(
			'code' => $VIPCode,
			'codeSystem' => "2.16.840.1.113883.5.1075",
			'codeSystemName' => "PatientImportance",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>