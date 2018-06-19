<?php 

/**
 * Organization
 */
class Organization extends CommunicationInfrastructure\CoreInfrastructure\Entity
{
	
	function __construct()
	{
		$this->setClassCode("ORG");
		$this->setDeterminerCode("INSTANCE");
	}
}

 ?>