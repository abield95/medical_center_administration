<?php 


/**
* CareProvision
*/
class CareProvision
{
	private $classCode;
	private $moodCode;
	private $id;
	private $code;
	private $statusCode;
	private $effectiveTime;
	private $performer;
	
	function __construct()
	{
		$this->classCode = array('root' => "PCPR", 'CNE' => "V:ActClassCareProvision");
		$this->moodCode = array('root' => "EVN", 'CNE' => "V:ActMoodEventOccurrejce");
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setCode($code)
	{
		$this->code = $code;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
	}

	public function setEffectiveTime($effectiveTime)
	{
		$this->effectiveTime = $effectiveTime;
	}

	public function setPerformer($performer)
	{
		$this->performer = $performer;
	}
}

/**
* Performer
*/
class Performer
{
	private $typeCode;
	private $functionCode;
	private $assignedProvider;
	function __construct()
	{
		$this->typeCode = array('root' => "PRF", 'CNE' => "V:ParticipationPhysicalPerformer", 'name' => "performer");
	}


	/**
	 *@param $functionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#ParticipationFunction
	**/
	public function setFuntionCode($functionCode)
	{
		$this->functionCode = $functionCode;
	}

	public function setAssignedProvider($assignedProvider)
	{
		$this->assignedProvider = $assignedProvider;
	}
}

/**
* AssignedProvider
*/
class AssignedProvider
{
	private $classCode;
	private $id;
	private $code;
	private $addr;
	private $telecom;
	private $effectiveTime;
	private $certificateText;
	private $assignedPerson;
	private $representedOrganization;
	function __construct()
	{
		$this->classCode = array('root' => "ASSIGNED", 'CNE' => "V:RoleClassAssignedEntity", 'name' => "Assigned Entity");
	}

	public function addId($id)
	{
		if (!is_array($this->id)) {
			$this->id = array();
		}

		$this->id[] = $id;
	}
}


 ?>