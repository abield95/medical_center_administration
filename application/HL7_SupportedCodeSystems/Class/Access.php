<?php 

require_once 'Role.php';

/**
 * Access
 * @Definition: A role played by a device when the device is used to administer therapeutic agents (medication and vital elements) into the body, or to drain material (e.g., exudates, pus, urine, air, blood) out of the body.
 * @UsageNotes: In general, Access is a Role of a ManufacturedMaterial or Device, something specifically manufactured or created to serve that purpose, such as a catheter or cannula inserted into a compartment of the body. Devices in the role of an Access are typically used in intake/outflow observations and in medication routing instructions. Microbiologic observations on the material itself or on fluids coming out of a drain are also common. 
 The Access role primarily exists in order to describe material actually deployed as an access, and not so much the fresh material as it comes from the manufacturer. For example, in supply ordering a box of catheters from a distributor, it is not necessary to use the Access role class, since the material attributes will usually suffice to describe and identify the product for the order. The Access role is used to communicate about the maintenance, intake/outflow, and due replacement of tubes and drains. 
 */
class Access extends Role
{
	private $approachSiteCode;
	private $targetSiteCode;
	private $gaugeQuantity;

	function __construct()
	{
		parent::__construct();

		$this->approachSiteCode = NULL;
		$this->targetSiteCode = NULL;
		$this->gaugeQuantity = NULL;
	}

	/**
	 * @param $approachSiteCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#ActSite
	 * @Description: The anatomic site where the Access (cannula, line or drain) first enters the body and, if applicable, a routing from the first entrance to the target site. 
	 * @Rationale: Since accesses are typically placed for a considerable period of time, and since the access is used as a resource of many acts, the access approach site becomes an important identifying attribute of the access itself (as opposed to merely being an attribute of the placement procedure).
	 * @Examples: An arteria pulmonalis catheter targeting a pulmonary artery, with the access approach site being the vena carotis interna at the neck, or the vena subclavia at the fossa subclavia. 
	 * @FormalConstraint: The coding system is the same as for Procedure.approachSiteCode; indeed, the Access.approachSiteCode has been copied from the Procedure class into the Access role class. The value of the Access.approachSiteCode should be identical to the value of the Procedure.approachSiteCode of an associated access placement procedure. 
	**/
	public function setApproachSiteCode($approachSiteCode)
	{
		$this->approachSiteCode = array(
			'code' => $approachSiteCode,
			'codeSystem' => "2.16.840.1.113883.5.110",
			'codeSystemName' => "RoleClass",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $targetSizeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#ActSite
	 * Definition: The site or body compartment into which access is being provided, (i.e., the compartment into which material is administered or from which it is collected).
	 * Rationale: Since accesses are typically placed for a considerable period of time, and since the access is used as a resource of many acts, the target site becomes an important identifying attribute of the access itself (as opposed to merely being an attribute of the placement procedure). The target site is important information that determines what kinds of substances may or may not be administered (e.g., special care to avoid medication injections into an arterial access). 
	 * @Examples: For a pulmonary artery catheter, the target site "arteria pulmonalis."
	 * @FormalConstraint: The coding system is the same as for Procedure.targetSiteCode; indeed, the Access.targetSiteCode has been copied from the Procedure class into the Access role class. The value of the Access.targetSiteCode SHOULD be identical to the value of the Procedure.targetSiteCode of an associated access placement procedure.
	**/
	public function setTargetSiteCode($targetSiteCode)
	{
		$this->targetSiteCode = $targetSiteCode;
	}


	/**
	 * @param $gaugeQuantity The inner diameter of the access.
	 * @Example The lumen of the tube.
	**/
	public function setGaugeQuantity($gaugeQuantity)
	{
		$this->gaugeQuantity = $gaugeQuantity;
	}
}

 ?>