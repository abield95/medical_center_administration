<?php 

require 'InfrastructureRoot.php';

/**
 * Act
 */
class Act extends InfrastructureRoot
{
	private $classCode;
	private $moodCode;
	private $id;
	private $code;
	private $actionNegationInd;
	private $negationInd;
	private $derivationExpr;
	private $title;
	private $text;
	private $statusCode;
	private $effectiveTime;
	private $activityTime;
	private $availabilityTime;
	private $priorityCode;
	private $confidentialityCode;
	private $repeatNumber;
	private $interruptibleInd;
	private $levelCode;
	private $indepedentInd;
	private $uncertaintyCode;
	private $reasonCode;
	private $languajeCode;
	private $isCriterionInd;

	//associations of ACT
	private $inboundRelationship;//ActRelationship::target;
	private $outboundRelationship;//ActRelationship::source
	private $participation;

	function __construct()
	{
		parent::__construct();
		$this->classCode = "ACT";
	}

	public function setInboundRelationship()
	{
		$actRelationship = new ActRelationship();
		$actRelationship->setTarget($this);
		$this->inboundRelationship = $actRelationship;
	}

	public function setOutboundRelationship()
	{
		$actRelationship = new ActRelationship();
		$actRelationship->setSource($this);
		$this->outboundRelationship = $actRelationship;
	}

	public function setParticipation($participation = NULL)
	{
		if (is_null($participation)) {
			$participation = new Participation();
		}
		$participation->setAct($this);
		$this->participation = $participation;
	}
}

 ?>