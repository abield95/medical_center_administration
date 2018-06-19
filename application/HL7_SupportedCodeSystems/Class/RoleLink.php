<?php 

require_once 'InfrastructureRoot.php';
/**
 ***********State Machine for RoleLink*********
 * active (sub-state of normal): 
	 -> The state that indicates the RoleLink is in progress.
 * cancelled (sub-state of normal): 
	 -> The terminal state resulting from abandoning the RoleLink prior to or after activation.
 * completed (sub-state of normal): 
	 -> The terminal state representing the successful completion of the RoleLink.
 * normal: 
	 -> The "typical" state. Excludes "nullified" which represents the termination state of a RoleLink instance that was created in error. 
 * nullified: 
	 -> The state representing the termination of a RoleLink instance that was created in error.
 * pending (sub-state of normal): 
	 -> The state that indicates the RoleLink has not yet become active.
 ************State Transitions**********
	 activate (from pending to active) 
	 cancel (from active to cancelled) 
	 cancel (from pending to cancelled) 
	 complete (from active to completed) 
	 create (from null to active) 
	 create (from null to completed) 
	 create (from null to pending) 
	 nullify (from normal to nullified) 
	 reactivate (from completed to active) 
	 revise (from active to active) 
	 revise (from pending to pending) 
**/

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
	 * @Definition The kind of connection represented by this RoleLink, e.gm has-part, has-authority
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


	/**
	 * @param $id datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-II
	 * @Definition A unique identifier used to refer to a specific instance of a RoleLink that may have the same Roles as another Roles.
	 * @UsageConstraint For this attribute, the II.scope (data type component) SHALL NOT be set to the codes BUSN (Business) or VW (View). 
	 * @UsageNotes This attribute should only be used in a specific set of Role-based registry related use cases which require the management of RoleLinks over time. 
	**/
	public function addId($id)
	{
		if (!is_array($this->id)) {
			$this->id = array();
		}

		$this->id[] = $id;
	}


	/**
	 * @param $statusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/RoleLinkStatus.html
	 * @Definition The Status of the RoleLink
	 * @UsageNotes This attribute should only be used in a specific set of Role-based registry related use cases which require the management of RoleLinks over time. 
	**/
	public function setStatusCode($statusCode)
	{
		$this->statusCode = array(
			'code' => $statusCode,
			'codeSystem' => "2.16.840.1.113883.5.1137",
			'codeSystemName' => "RoleLinkStatus",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $priorityNumber An integer specifying the relative preference for considering this relationship before other like-typed relationships having the same source.
	 * @UsageNotes RoleRelationships with lower priorityNumber values take priority over those with higher values. The ordering may be a total ordering, in which all priority numbers are unique, or a partial ordering, in which the same priority may be assigned to more than one relationship.
	 * @Examples For multiple backups, specifies which backup is considered before others; which is the preferred ServiceDeliveryLocation for a Physician working on behalf of a particular Health Authority.
	**/
	public function setPriorityNumber($priorityNumber)
	{
		$this->priorityNumber = $priorityNumber;
	}


	/**
	 * @param $effectiveTime An interval of time specifying the period during which the connection between Roles is in effect.
	**/
	public function setEffectiveTime($effectiveTime)
	{
		$this->effectiveTime = $effectiveTime;
	}


	//associaitons of RoleLink
	public function setTarget(&$target)
	{
		if (!is_a($target, 'Role') || is_null($target)) {
			return false;
		}
		$target->setInboundLink($this);
		$this->target = $target;
	}

	public function setSource(&$source)
	{
		if (!is_a($source, 'Role')) {
			return false;
		}
		$source->setOutboundLink($this);
		$this->source = $source;
	}
}

 ?>