<?php 

require_once 'InfrastructureRoot.php';

/**
 * RoleLink
 * @Definition A connection between two roles expressing a dependency between those roles and permitting the authorization or nullification of a dependent role based on status changes in its causal or directing role. The RoleLink may be operated over time and thus whose state and identity must be managed. 
 * @UsageNotes RoleLink specifies the relationships between roles, not between people (or other entities). People (or other Entities) are primarily related by the player/scoper relationships for player's Role and more generally through their interactions (i.e. their participations in acts). 
 The use of the ID and statusCode attributes should be used only in those circumstances where it is of importance to manage the RoleLink over time, i.e. in Role based registries. These attributes should not be used in general.
 * @Examples
 	 1) A role of assignment or agency depends on another role of employment, such that when the employment role is terminated, the assignments are terminated as well. This is the dependency of the assignment role on the employment role, or in other words, the assignment is "part of" the employment. 
	 2) One role has authority over another (in organizational relationships). For example, an employee of type "manager" may have authority over employees of type "analyst" which would be indicated by a role link for "direct authority." 
	 3) A role had been part of another role, but this is no longer true. For example, due to a re-organization, an ICU which used to be part of department A is now part of department B. This would be indicated by a role link for "part of" and a status code to indicate that the role link is inactive. 
 */
class RoleLink extends InfrastructureRoot
{
	private $typeCode;
	private $id;
	private $statusCode;
	private $priorityNumber;
	private $effectiveTime;

	//Associations of RoleLink
	private $target;//Role::inboundLink
	private $source;//Role::outboundLink(0..*)

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * @param $typeCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RoleLinkType.html
	 * @Definition The Disposition of the patient at the time of discharge
	 * @UsageNotes While the encounter is still active (the encounter doesn't yet have an end date), this attribute should be interpreted as the expected discharge disposition. When the encounter is completed, this field contains the actual discharge disposition.
	 * @Examples Discharge to home, expired, against medical advice
	**/
	public function setTypeCode($typeCode)
	{
		$this->typeCode = array(
			'code' => $classCode,
			'codeSystem' => "2.16.840.1.113883.5.107",
			'codeSystemName' => "RoleLinkType",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>