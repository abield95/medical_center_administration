<?php 

namespace CommunicationInfrastructure\MessageCommunicationsControl\QueryControl;

require_once 'InfrastructureRoot.php';

/**
 * SortControl
 * @Definition The sort order for instance matches to a query.
 * @OpenIssue Harmonization review of the Sequencing concept domain revealed that there seem to be elements missing from this class for it to be specify a complete sort control. One such element is whether the sort should be case sensitive or not. 
 */
class SortControl extends CommunicationInfrastructure\CoreInfrastructure\InfrastructureRoot
{
	private $sequenceNumber;
	private $elementName;
	private $directionCode;

	//associations
	private $querySpec;//(1..1)QuerySpec::sortControl(0..*)
	function __construct()
	{
		parent::__construct();
		$this->querySpec = NULL;
	}


	/**
	 * The precedence of the SortControls for a given query
	 * @param Int $sequenceNumber non-negative
	 */
	public function setSequenceNumber($sequenceNumber)
	{
		$this->sequenceNumber = ($sequenceNumber >= 0) ? $sequenceNumber : 0;
	}


	/**
	 * The RIM element in a query response upon which to sort
	 * @param Strinf $elementName no translation
	 */
	public function setElementName($elementName)
	{
		$this->elementName = $elementName;
	}


	/**
	 * The direction of the sort
	 * @param Code $directionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/Sequencing.html
	 * @example Ascending, descending, no expected order
	 */
	public function setDirecionCode($directionCode)
	{
		$this->directionCode = array(
			'code' => $directionCode,
			'codeSystem' => "2.16.840.1.113883.5.113",
			'codeSystemName' => "Sequencing",
			'codeSystemVersion' => "1"
		);
	}

	//////////////////
	// associations //
	//////////////////
	public function setQuerySpec(&$querySpec)
	{
		if (!is_a($querySpec, 'QuerySpec') || is_null($querySpec)) {
			return;
		}
		$querySpec->addSortControl($this);
		$this->querySpec = $querySpec;
	}
}

 ?>