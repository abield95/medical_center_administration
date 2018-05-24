<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

include_once 'Act.php';

/**
 * Exposure
 * @Definition An interaction between entities that provides opportunity for transmission of a physical, chemical, or biological agent from an exposure source entity to an exposure target entity.
 * @UsageNotes
 	 This class deals only with opportunity and not the outcome of the exposure; i.e. not all exposed parties will necessarily experience actual harm or benefit. 
	 Exposure differs from Substance Administration by the absence of the participation of a performer in the act. 
	 The following participations SHOULD be used with the following participations to distinguish the specific entities:
		 a) The exposed entity participates via the "exposure target" (EXPTRGT) participation.
		 b) An entity that has carried the agent transmitted in the exposure participates via the "exposure source" (EXSRC) participation. For example: 
			 1) a person or animal who carried an infectious disease and interacts (EXSRC) with another person or animal (EXPTRGT) transmitting the disease agent; 
			 2) a place or other environment (EXSRC) and a person or animal (EXPTRGT) who is exposed in the presence of this environment.
		 c) When it is unknown whether a participating entity is the source of the agent (EXSRC) or the target of the transmission (EXPTRGT), the "exposure participant" (EXPART) is used. 
		 d) The physical (including energy), chemical or biological substance which is participating in the exposure uses the "exposure agent" (EXPAGNT) participation. There are at least three scenarios: 
			 1) the player of the Role that participates as EXPAGNT is the chemical or biological substance mixed or carried by the scoper-entity of the Role (e.g., ingredient role); or 
			 2) the player of the Role that participates as EXPAGNT is a mixture known to contain the chemical, radiological or biological substance of interest; or 
			 3) the player of the Role that participates as a EXPAGNT is known to carry the agent (i.e., the player is a fomite, vector, etc.).
	 The Exposure.statusCode attribute should be interpreted as the state of the Exposure business object (e.g., active, aborted, completed) and not the clinical status of the exposure (e.g., probable, confirmed). The clinical status of the exposure should be associated with the exposure via a subject observation.
 * @DesignComments The usage notes require a clear criterion for determining whether an act is an exposure or substance administration-deleterious potential, uncertainty of actual transmission, or otherwise. SBADM states that the criterion is the presence of a performer-but there are examples above that call this criterion into question (e.g., the first one, concerning a dosing error).
 * @Examples
 	 The following examples are provided to indicate what interactions are considered exposures rather than other types of Acts:
 		 a) A patient accidentally receives three times the recommended dose of their medication due to a dosing error. 
			 -> This is a substance administration. Public health and/or safety authorities may also be interested in documenting this with an associated exposure. 
		 b) A patient accidentally is dispensed an incorrect medicine (e.g., clomiphene instead of clomipramine). They have taken several doses before the mistake is detected. They are therefore "exposed" to a medicine that there was no therapeutic indication for them to receive. 
			 -> There are several substance administrations in this example. Public health and/or safety authorities may also be interested in documenting this with associated exposures. 
		 c) In a busy medical ward, a patient is receiving chemotherapy for a lymphoma. Unfortunately, the IV infusion bag containing the medicine splits, spraying cytotoxic medication over the patient being treated and the patient in the adjacent bed. 
			 ->There are three substance administrations in this example. The first is the intended one (IV infusion) with its associated (implicit) exposure. There is an incident with an associated substance administration to the same patient involving the medication sprayed over the patient as well as an associated exposure. Additionally, the incident includes a substance administration involving the spraying of medication on the adjacent patient, also with an associated exposure.
		 d) A patient who is a refugee from a war-torn African nation arrives in a busy inner city A&E department suffering from a cough with bloody sputum. Not understanding the registration and triage process, they sit in the waiting room for several hours before it is noticed that they have not booked in. As soon as they are being processed, it is suspected that they are suffering from TB. Vulnerable (immunosuppressed) patients who were sharing the waiting room with this patient may have been exposed to the tubercule bacillus, and must be traced for investigation. 
			 -> This is an exposure (or possibly multiple exposures) in the waiting room involving the refugee and everyone else in the waiting room during the period. There might also be a number of known or presumed substance administrations (coughing) via several possible routes. The substance administrations are only hypotheses until confirmed by further testing. 
		 e) A patient who has received an elective total hip replacement procedure suffers a prolonged stay in hospital, due to contracting an MRSA infection in the surgical wound site after the surgery. 
			 -> This is an exposure to MRSA. Although there was some sort of substance administration, it's possible the exact mechanism for introduction of the MRSA into the wound will not be identified. 
		 f) Routine maintenance of the X-ray machines at a local hospital reveals a serious breach of the shielding on one of the machines. Patients who have undergone investigations using that machine in the last month are likely to have been exposed to significantly higher doses of X-rays than was intended, and must be tracked for possible adverse effects. 
			 -> There has been an exposure of each patient who used the machine in the past 30 days. Some patients may have had substance administrations.
		 g) A new member of staff is employed in the laundry processing room of a small cottage hospital, and a misreading of the instructions for adding detergents results in fifty times the usual concentration of cleaning materials being added to a batch of hospital bedding. As a result, several patients have been exposed to very high levels of detergents still present in the "clean" bedding, and have experienced dermatological reactions to this. 
			 -> There has been an incident with multiple exposures to several patients. Although there are substance administrations involving the application of the detergent to the skin of the patients, it is expected that the substance administrations would not be directly documented. 
		 h) Seven patients who are residents in a health care facility for the elderly mentally ill have developed respiratory problems. After several months of various tests having been performed and various medications prescribed to these patients, the problem is traced to their being "sensitive" to a new fungicide used in the wall plaster of the ward where these patients reside. 
			 -> The patients have been continuously exposed to the fungicide. Although there have been continuous substance administrations (via breathing) this would not normally be documented as a substance administration.
		 i) A patient with osteoarthritis of the knees is treated symptomatically using analgesia, paracetamol (acetaminophen) 1g up to four times a day for pain relief. His GP does not realize that the patient has, 20 years previously (while at college) had severe alcohol addiction problems, and now, although this is completely under control, his liver has suffered significantly, leaving him more sensitive to hepatic toxicity from paracetamol use. Later that year, the patient returns with a noticeable level of jaundice. Paracetamol is immediately withdrawn and alternative solutions for the knee pain are sought. The jaundice gradually subsides with conservative management, but referral to the gastroenterologist is required for advice and monitoring. 
			 -> There is a substance administration with an associated exposure. The exposure component is based on the relative toxic level of the substance to a patient with a compromised liver function. 
		 j) A patient goes to their GP complaining of abdominal pain, having been discharged from the local hospital ten days' previously after an emergency appendectomy. The GP can find nothing particularly amiss, and presumes it is post operative surgical pain that will resolve. The patient returns a fortnight later, when the GP prescribes further analgesia, but does decide to request an outpatient surgical follow-up appointment. At this post-surgical outpatient review, the registrar decides to order an ultrasound, which, when performed three weeks later, shows a small faint inexplicable mass. A laparoscopy is then performed, as a day case procedure, and a piece of a surgical swab is removed from the patient's abdominal cavity. Thankfully, a full recovery then takes place. 
			 -> This is a procedural sequelae. There may be an Incident recorded for this also.
		 k) A patient is slightly late for a regular pacemaker battery check in the Cardiology department of the local hospital. They are hurrying down the second floor corridor. A sudden summer squall has recently passed over the area, and rain has come in through an open corridor window leaving a small puddle on the corridor floor. In their haste, the patient slips in the puddle and falls so badly that they have to be taken to the A&E department, where it is discovered on investigation they have slightly torn the cruciate ligament in their left knee. 
			 -> This is not an exposure. There has been an incident. 
 */
class Exposure extends Act
{
	private $routeCode;
	private $exposureLevel;
	private $exposureModeCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("EXPOS");
		$this->routeCode = NULL;
		$this->exposureLevel = NULL;
		$this->exposureModeCode = NULL;
	}



	/**
	 * @param $routeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RouteOfAdministration.html
	 * @Definition The physiological path or route for introducing the material into or onto the subject.
	 * @UsageNotes If the route requires further specification, both the site of administration (administrationSiteCode) and the method of administration (methodCode) from the associated SubstanceAdministration may be used. For example, if the routeCode is intravenous or intra-muscular, it may be necessary to specify the precise site with approachSiteCode (e.g., right forearm or left deltoid muscle, respectively) and the precise method of administration with methodCode, (e.g., slow bolus injection or Z-track injection, respectively). Route, site of administration (administrationSiteCode), method of administration (methodCode) and the device used in administration are closely related. All four (if present) must be closely coordinated and in agreement. In some cases, the coding system used to specify one may pre-coordinate one or more of the others. 
	 When the substance is delivered to an environmental site, or a location, the route code indicates a site on its form.
	 * @Examples Oral, Rectal, Intra-venous
	**/
	public function setRouteCode($routeCode)
	{
		$this->routeCode = array(
			'code' => $routeCode,
			'codeSystem' => "2.16.840.1.113883.5.112",
			'codeSystemName' => "RouteOfAdministration",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $exposureLevel from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActExposureLevelCode.html
	 * @Definition A qualitative measure of the degree of exposure to the causative agent. 
	 * @UsageNotes This attribute describes how the quantity that was available to be administered to the target differs from typical or background levels of the substance.
	 * @Examples Low, Medium, high
	**/
	public function setExposureLevelCode($exposureLevel)
	{
		$this->exposureLevel = array(
			'code' => $exposureLevel,
			'codeSystem' => "2.16.840.1.113883.5.1114",
			'codeSystemName' => "ActExposureLevelCode",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $exposureModeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ExposureMode.html
	 * @Definition The mechanism by which exposure agent was exchanged or potentially exchanged by the participants involved in the exposure.
	 * @Examples Direct contact, airborne, foodborne
	**/
	public function setExposureModeCode($exposureModeCode)
	{
		$this->exposureModeCode = array(
			'code' => $exposureModeCode,
			'codeSystem' => "2.16.840.1.113883.5.1113",
			'codeSystemName' => "ExposureMode",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>