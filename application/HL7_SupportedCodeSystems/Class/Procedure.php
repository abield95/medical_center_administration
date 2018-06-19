<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * Procedure
 * @Definition An Act whose immediate and primary outcome (post-condition) is the alteration of the physical condition of the subject.
 * @UsageNotes Applied to clinical medicine, procedure is but one among several types of clinical activities such as observation, substance-administrations, and communicative interactions (e.g. teaching, advice, psychotherapy, represented simply as Acts without special attributes). Procedure does not subsume those other activities nor is Procedure subsumed by them. Notably Procedure does not comprise all Acts of whose intent is intervention or treatment. Whether the bodily alteration is appreciated or intended as beneficial to the subject is likewise irrelevant: what counts is that the Act is essentially an alteration of the physical condition of the subject. 
 The choice between Procedure and other representations of real activities is based on whether the activity or activity step's necessary post-condition is the physical alteration. For example, taking an x-ray image may sometimes be called "procedure," but it is not a Procedure in the RIM sense, for an x-ray image is not done to alter the physical condition of the body. 
 Many clinical activities combine Acts of Observation and Procedure nature into one composite. For instance, interventional radiology (e.g., catheter directed thrombolysis) does both observing and treating, and most surgical procedures include conscious and documented Observation steps. These clinical activities therefore are best represented by multiple component Acts, each of the appropriate type.
 * @Examples Procedures may involve the disruption of some body surface (e.g. an incision in a surgical procedure), but they also include conservative procedures such as reduction of a luxated join, chiropractic treatment, massage, balneotherapy, acupuncture, shiatsu, etc. Outside of clinical medicine, procedures may be such things as alteration of environments (e.g. straightening rivers, draining swamps, building dams) or the repair or change of machinery etc. 
 */
class Procedure extends Act
{
	private $methodCode;
	private $approachSiteCode;
	private $targetSiteCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("PROC");
		$this->methodCode = NULL:
		$this->approachSiteCode = NULL;
		$this->targetSiteCode = NULL;
	}


	/**
	 * @param $methodCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#ProcedureMethod
	 * @Definition The means or technique used to perform the procedure.
	 * @Rationale For any Procedure there may be several different methods to achieve by and large the same result, but may be important to know when interpreting a report more thoroughly (e.g., cholecystectomy: open vs. laparoscopic). Method concepts can be "pre-coordinated" in the Act definition. There are many possible methods, which all depend on the particular kind of Procedure, so that defining a vocabulary domain of all methods would be difficult. However, a code system might be designed that specifies a set of available methods for each defined Procedure concept. Thus, a user ordering a Procedure could select one of several variations of the act by means of the method code. Available method variations may also be defined in a master service catalog for each defined Procedure. In act definition records (Act.moodCode = DEF), the methodCode attribute is a set of all available method codes that a user may select while ordering, or expect while receiving results. 
	 For Substance Administrations, the routeCode frequently conveys the method. This attribute is only needed if the routeCode requires further specification. For example, if the routeCode is "by mouth", no further information about the method may be required. If, however, routeCode is intravenous or intra-muscular, the precise method of administration may be specified in this attribute (e.g., "slow bolus injection" or "Z-track injection" respectively). 
	 Route of administration (routeCode), site of administration (approachSiteCode) and the method of administration are closely related in Substance Administrations. All three (if present) must be closely coordinated and in agreement. In some cases, the coding system used to specify one may pre-coordinate one or more of the others. 
	**/
	public function addMethodCode($methodCode)
	{
		if (!is_array($this->methodCode)) {
			$this->methodCode = array(
				'code' => array(),
				'codeSystem' => "2.16.840.1.113883.5.40",
				'codeSystemName' => "EncounterSpecialCourtesy",
				'codeSystemVersion' => "1"
			);
		}

		$this->methodCode['code'][] = $methodCode;
	}


	/**
	 * @param $approachSiteCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActSite.html
	 * @Definition The anatomical site or system through which the procedure reaches its target.
	 * @UsageNotes If the subject of the Act is something other than a human patient or animal, the attribute is used analogously to specify a structural landmark of the thing where the act focuses. 
	 Some approach sites can also be pre-coordinated in the Act definition, so that there is never an option to select different body sites. The same information structure can handle both the pre-coordinated and the post-coordinated approach. 
	 In Substance Administration, the route (routeCode), site of administration (approachSiteCode), the method of administration (methodCode) and the device used in administration are closely related. All four (if present) must be closely coordinated and in agreement. In some cases, the coding system used to specify one may pre-coordinate one or more of the others. 
	 * @Examples Nephrectomy can have a trans-abdominal or a primarily retroperitoneal approach
	 An arteria pulmonalis catheter targets a pulmonary artery, but the approach site is typically the vena carotis interna at the neck or the vena subclavia at the fossa subclavia. 
	 For Substance Administration, it is the detailed anatomical site where the medication enters or is applied to the subject.
	 For non-invasive procedures, e.g., acupuncture, the approach site is the punctured area of the skin. 
	**/
	public function addApproachSiteCode($approachSiteCode)
	{
		if (!is_array($this->approachSiteCode)) {
			$this->approachSiteCode = array(
				'code' => array(),
				'codeSystem' => "2.16.840.1.113883.5.1052",
				'codeSystemName' => "ActSite",
				'codeSystemVersion' => "1"
			);
		}

		$this->approachSiteCode['code'][] = $approachSiteCode;
	}


	/**
	 * @param $targetSiteCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ActSite.html
	 * @Definition The anatomical site or system that is the focus of the procedure.
	 * @UsageNotes If the subject of the Act is something other than a human patient or animal, the attribute is used analogously to specify a structural landmark of the thing where the act focuses. 
	 Some target sites can also be "pre-coordinated" in the Act definition, so that there is never an option to select different body sites. The same information structure can handle both the pre-coordinated and the post-coordinated approach. 
	 * @Examples A Nephrectomy's target site is the right or left kidney
	 An arteria pulmonalis catheter targets a pulmonary artery.
	 For non-invasive procedures, e.g., acupuncture, the target site is the organ/system that is sought to be influenced (e.g., the liver). 
	**/
	public function addTargetSiteCode($targetSiteCode)
	{
		if (!is_array($this->targetSiteCode)) {
			$this->targetSiteCode = array(
				'code' => array(),
				'codeSystem' => "2.16.840.1.113883.5.1052",
				'codeSystemName' => "ActSite",
				'codeSystemVersion' => "1"
			);
		}

		$this->targetSiteCode['code'][] = $targetSiteCode;
	}
}

 ?>