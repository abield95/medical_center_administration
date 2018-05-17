<?php 

require_once 'Participation.php';
/**
 *********State Machine**********
 ->	********States of ManagedParticipation***********
 	 -> active (sub-state of normal): 
		The state representing the fact that the Participation is in progress.
	 -> cancelled (sub-state of normal): 
		The termination state resulting from cancellation of the Participation prior to activation.
	 -> completed (sub-state of normal): 
		The terminal state representing the successful completion of the Participation.
	 -> normal: 
		The "typical" state. Excludes "nullified", which represents the termination state of a participation instance that was created in error. 
	 -> nullified: 
		The state representing the termination of a Participation instance that was created in error.
	 -> pending (sub-state of normal): 
		The state representing the fact that the Participation has not yet become active.
 -> ********State Transition************
 	 activate (from pending to active) 
	 cancel (from pending to cancelled) 
	 complete (from active to completed) 
	 create (from null to active) 
	 create (from null to completed) 
	 create (from null to pending) 
	 nullify (from normal to nullified) 
	 reactivate (from completed to active) 
	 revise (from active to active) 
	 revise (from completed to completed) 
	 revise (from pending to pending) 
**/

/**
 * ManagedParticipation
 * @Definition A participation that will be operated on over time and thus whose state and identity must be managed.
 * @Rationale
	 ManagedParticipations are defined as a subclass of Participations because not all Participations are stateful. In general, when the sub-activity realized by a Participation is of closer interest and needs to be managed, one SHOULD instead model that sub-activity as an Act component of the main Act. 
	 However, in certain environments, the activities that the participants perform is not very well understood, and hence modeling those as sub-acts is deemed burdensome, and it may imply an unmerited depth of knowledge or certainty. 
	 Therefore, the ManagedParticipation extends Participation with an identity-attribute and a state-attribute to support these exceptional use cases. ManagedParticipations should be used with utmost caution so as to avoid confusion with Acts and to avoid having to duplicate the act-management infrastructure around participations.
 * @Examples An attending practitioner for an inpatient encounter may change due to leave of absence, and it is important to note when this participation will be available.
 */
class ManagedParticipation extends Participation
{
	private $id;
	private $statusCode;

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * @param $id datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-II
	 * @Definition A unique identifier used to refer to a specific instance of a ManagedParticipation that may have the same Act and the same Role as another ManagedParticipation.
	 * @UsageConstraint For this attribute, the II.scope (data type component) SHALL NOT be set to the codes BUSN (Business) or VW (View). 
	**/
	public function addId($id)
	{
		if (!is_array($this->id)) {
			$this->id = array();
		}

		$this->id[] = $id;
	}


	/**
	 * @param $statusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/ManagedParticipationStatus.html
	 * @Definition The status of the ManagedParticipation.
	 * @usageNotes This attribute was defined in the original RIM as repeating, owing to the presence of nested states in the state machines. In actual practice, however, there is never a need to communicate more than a single status value. Therefore, committees are advised to constrain this attribute to a maximum cardinality of 1 in all message designs. 
	 * @Examples Pending, active, complete, cancelled 
	**/
	public function setStatusCode($statusCode)
	{
		$this->statusCode = array(
			'code' => $statusCode,
			'codeSystem' => "2.16.840.1.113883.5.1062",
			'codeSystemName' => "ManagedParticipationStatus",
			'codeSystemVersion' => "1"
		);
	}
}

 ?>