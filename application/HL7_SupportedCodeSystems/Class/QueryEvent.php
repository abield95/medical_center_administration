<?php 

namespace CommunicationInfrastructure\MessageCommunicationsControl\QueryControl;

require_once 'InfrastructureRoot.php';

//////////////////
//state machine //
//////////////////
/**
 * ********States********
 * aborted
 * deliveredResponse
 * executing
 * new
 * waitContinuedQueryResponse
 * ********State Transition*******
 * abort (from deliveredResponse to aborted) 
 * abort (from executing to aborted) 
 * Abnormal cessation of a query being executed.
 * activateQueryContinue (from deliveredResponse to executing) 
 * completeInitialQueryResponse (from executing to deliveredResponse) 
 * completeQueryContinuation (from executing to deliveredResponse) 
 * create (from null to new) 
 * executeQuerySpec (from new to executing) 
 */

/**
 * QueryEvent
 * @Definition An abstract class that generalizes all query message interactions.
 * @UsageNotes See Query Infrastructure under the Specification Infrastructure, Messaging chapter for a description of how RIM query capabilities are designed to operate. 
 * @DesignComments Purpose of rationale not clear; removed. Definitions are shared with Query Infrastructure document; synchronize changes. 
 */
class QueryEvent extends CommunicationInfrastructure\CoreInfrastructure\InfrastructureRoot
{
	private $queryId;
	private $statusCode;

	//associations
	private $controlAct;//(1..1)ControlAct::queryEvent(0..1)

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * A unique indentifier for a query
	 * @param II $queryId UUID
	 * @UsageNotes This identifier matches response messages to the originating query. QueryEvent.queryId may remain the same across multiple interactions when performing query continuations.
	 */
	public function setQueryId($queryId)
	{
		$this->queryId = $queryId;
	}


	/**
	 * Reflects the status of the QueryEvent its current locus in its own state-machine
	 * @param Code $statusCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/QueryStatusCode.html
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = array(
			'code' => $statusCode,
			'codeSystem' => "2.16.840.1.113883.5.103",
			'codeSystemName' => "QueryStatusCode",
			'codeSystemVersion' => "1"
		);
	}


	//////////////////
	// Associations //
	//////////////////
	
	public function setControlAct(&$controlAct)
	{
		if (!is_a($controlAct, 'ControlAct') || is_null($controlAct)) {
			return false;
		}

		$controlAct->setQueryEvent($this);
		$this->controlAct = $controlAct;
	}
}

 ?>