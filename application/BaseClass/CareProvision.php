<?php 

/**
 * CareProvision
 */
class CareProvision extends CommunicationInfrastructure\CoreInfrastructure\Act
{
	private $performer;

	function __construct()
	{
		$this->setClassCode("PCPR");
		$this->setMoodCode("EVN");
		$this->performer = array(
			'performer' => new Participation("PRF"),
		);
	}
}

 ?>