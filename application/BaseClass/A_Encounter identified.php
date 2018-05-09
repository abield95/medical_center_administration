<?php 


/**
 * Encounter
 */
class Encounter
{
	private $classCode;
	private $moodCode;
	private $id;
	private $code;
	private $effectiveTime;
	function __construct()
	{
		$this->classCode = array('root' => "ENC", 'CNE' => "V:ActClassEncounter");
		$this->moodCode = array('root' => "ENV", 'CNE' => "V:ActMoodEventOccurence");
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