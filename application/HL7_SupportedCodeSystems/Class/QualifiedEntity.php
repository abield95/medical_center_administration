<?php 

require_once 'Role.php';

/**
 * QualifiedEntity
 * @Definition An entity that has been recognized as having certain training, experience or other characteristics that would make the entity an appropriate performer for a certain activity. 
 * @UsageNotes The qualified entity is the player; the scoper is an organization that educates or qualifies entities. QualifiedEntity is a superset of LicensedEntity. 
 */
class QualifiedEntity extends Role
{
	private $equivalenceInd;

	function __construct()
	{
		parent::__construct();
		parent::setClassCode("QUAL");
		$this->equivalenceInd = NULL;
	}


	/**
	 * @param $equivalenceInd Indication that the scoper recognizes a combination of qualifications equivalent to the normal definition of the term encoded in the Role attribute. 
	 * @UsageNotes If "True," the scoper of the qualified entity role is asserting that it recognizes a combination of qualifications equivalent to the normal definition of the term encoded in the Role.code attribute.
	 * @DesignComments What does it mean if not true?
	 * @Examples Bachelor's Degree (equivalent), Bachelor of Nursing (equivalent), Bachelor of Dental Surgery (equivalent)
	**/
	public function setEquivalenceInd($equivalenceInd)
	{
		$this->equivalenceInd = $equivalenceInd;
	}
}

 ?>