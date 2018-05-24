<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * ControlAct
 * @Definition An act representing a change to the state of another class, a user event (e.g. query), or a system event (e.g. time-based occurrences). 
 * @UsageNotes This class corresponds to the concept of 'Trigger Event', and as such, must be present as the focus of every messaging interaction (because of the 1..1 association between a trigger event and an interaction.) However, control acts can also appear within a message payload. For example, a set of control acts associated with a Lab Order identifying the events that have occurred against that order (first created, then revised, then suspended, then resumed, then completed.) 
 * @Examples
 	 -> Discharging a patient (Encounter from Active to Completed);
	 -> Stopping a medication (SubstanceAdministration from Active to Aborted); 
	 -> Sending an end-of-day summary (time-based event).
 */
class ControlAct extends Act
{
	private $payload//Message::controlAct(0..*);
	private $queryEvent//QueryEvent::controlAct;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("CACT");
		$this->payload = NULL;
		$this->queryEvent = NULL;
	}


	public function setPayload($payload)
	{
		if (is_a($payload, 'Message') && !is_null($payload)) {
			$this->payload = $payload
		}
	}


	public function setQueryEvent($queryEvent)
	{
		if (is_a($queryEvent, 'QueryEvent') && !is_null($queryEvent)) {
			$this->queryEvent = $queryEvent;
		}
	}
}

 ?>