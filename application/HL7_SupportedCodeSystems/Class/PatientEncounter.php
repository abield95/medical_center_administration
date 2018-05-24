<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * PatientEncounter
 */
class PatientEncounter extends Act
{
	private $admissionReferralSourceCode;
	private $lengthOfStayQuantity;
	private $dischargeDispositionCode;
	private $preAdmitTestInd;
	private $specialCourtesiesCode;
	private $specialArrangementCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("ENC");
	}
}

 ?>