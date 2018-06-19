<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * PatientEncounter
 * @Definition An interaction between a patient and care provider(s) for the purpose of providing healthcare-related service(s). 
 * @UsageNotes Healthcare services include health assessment.
 * @Examples Outpatient visit to multiple departments, home health support (including physical therapy), inpatient hospital stay, emergency room visit, field visit (e.g., traffic accident), office visit, occupational therapy, telephone call. 
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
		$this->admissionReferralSourceCode = NULL;
		$this->lengthOfStayQuantity = NULL;
		$this->dischargeDispositionCode = NULL;
		$this->preAdmitTestInd = NULL;
		$this->specialCourtesiesCode = NULL;
		$this->specialArrangementCode = NULL;
	}


	/**
	 * @param $admissionReferralSourceCode The type of place or organization responsible for the patient immediately prior to a patient encounter.
	 * Info file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#EncounterReferralSource
	**/
	public function setAdmissionReferralSourceCode($admissionReferralSourceCode)
	{
		$this->admissionReferralSourceCode = 
	}


	/**
	 * @param $lenghtOfStayQuantity The total quantity of time when the subject is expected to be or was resident at a facility as part of an encounter.
	 * @UsageNotes The actual days quantity cannot be simply calculated from the admission and discharge dates because of possible leaves of absence. 
	**/
	public function setLenghtOfStayQuantity($lengthOfStayQuantity)
	{
		$this->lengthOfStayQuantity = $lengthOfStayQuantity;
	}


	/**
	 * @param $dischargeDispositionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#EncounterDischargeDisposition
	 * @Definition The disposition of the patient at the time of discharge.
	 * @UsageNotes While the encounter is still active (the encounter doesn't yet have an end date), this attribute should be interpreted as the expected discharge disposition. When the encounter is completed, this field contains the actual discharge disposition. 
	 * @Examples Discharged to home, expired, against medical advice.
	**/
	public function setDischargeDispositoinCode($dischargeDispositionCode)
	{
		$this->dischargeDispositionCode = $dischargeDispositionCode;
	}


	/**
	 * @param $preAdmitTestInd An indication that pre-admission tests are required for this patient encounter.
	**/
	public function setPreAdmitTestInd($preAdmitTestInd)
	{
		$this->preAdmitTestInd = $preAdmitTestInd;
	}


	/**
	 * @param $specialCourtesiesCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EncounterSpecialCourtesy.html
	 * @Definition Extraordinary considerations or services provided within the context of the Patient Encounter.
	 * @Examples Professional courtesy, VIP courtesies, no courtesies
	**/
	public function addSpecialCourtesiesCode($specialCourtesiesCode)
	{
		if (!is_array($this->specialCourtesiesCode)) {
			$this->specialCourtesiesCode = array(
				'code' => array(),
				'codeSystem' => "2.16.840.1.113883.5.40",
				'codeSystemName' => "EncounterSpecialCourtesy",
				'codeSystemVersion' => "1"
			);
		}

		$this->specialCourtesiesCode['code'][] = $specialCourtesiesCode;
	}


	/**
	 * @param $specialArrangementCode A code indicating the type of special arrangements provided for a patient encounter (e.g., wheelchair, stretcher, interpreter, attendant, seeing eye dog). For encounters in intention moods, this information can be used to identify special arrangements that will need to be made for the incoming patient. 
	 * @Definition Extraordinary provisions required in the context of the patient encounter.
	 * @UsageNotes For encounters in intention moods, this information can be used to identify special arrangements that will need to be made for the incoming patient. This is not related to the AccommodationEvent.
	 * @Examples Wheelchair, stretcher, interpreter, attendant, seeing eye dog
	 * @Info from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#SpecialArrangement
	**/
	public function addSpecialArrangementCode($specialArrangementCode)
	{
		if (!is_array($this->specialArrangementCode)) {
			$this->specialArrangementCode = array();
		}

		$this->specialArrangementCode[] = $specialArrangementCode;
	}
}

 ?>