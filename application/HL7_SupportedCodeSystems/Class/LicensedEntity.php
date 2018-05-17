<?php 

require_once 'Role.php';

/**
 * LicensedEntity
 * @Definition An Entity that is accredited with a license or qualification certifying the capability to perform specific functions.
 * @UsageNotes: The player is the qualified entity; the scoper is the Organization that issues the credential. LicensedEntity is a subset of QualifiedEntity. 
 * @Examples 
 		 1) A paramedic with a diploma
		 2) Certified equipment
		 3) A licensed health services provider
 */
class LicensedEntity extends Role
{
	private $recertificationTime;

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * @param $recertificatinTime The date recertification is required. yyyymmddhhmmss
	**/
	public function setRecertificationTime($recertificationTime)
	{
		$this->recertificationTime = $recertificationTime;
	}
}

 ?>