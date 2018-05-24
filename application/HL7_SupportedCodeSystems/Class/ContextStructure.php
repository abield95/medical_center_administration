<?php 

namespace CommunicationInfrastructure\CoreInfrastructure\StructuredDocuments;

require_once 'Act.php';

/**
 * ContextStructure
 * @Definition A a container within a document
 * @UsageNotes Structures have captions which can be coded. Structures can nest, and structures can contain entries.
 An original document is the first version of a document. It gets a new unique value for setId, and has the value of versionNumber set to equal "1." 
 An addendum is an appendage to an existing document that contains supplemental information. The appendage is itself an original document. The parent document being appended is referenced via an ActRelationship, with ActRelationship.typeCode set to equal "APND" (for "appends"). The parent report being appended remains in place and its content and status are unaltered. 
 A replacement document replaces an existing document. The replacement document uses the same value for setId as the parent document being replaced, and increments the value of versionNumber by 1. The parent document being replaced is referenced via an ActRelationship, with ActRelationship.typeCode set to equal "RPLC" (for "replace"). The state of the parent document being replaced should become "obsolete" but is still retained in the system for historical reference. 
 It is also permissible for an implementation to maintain a set of documents, with a common setId value and version numbers, without the requirement that only the latest be in an "active" state if the Implementation Guide so specifies. 
 * @OpenIssue The name of this class, and the allowable ActClass values, will be revised so as to be consistent with the ActContainer hierarchy, which is currently undergoing review. (November 2004) 
 What is the status of the revision? Is a ContextStructure always a "report"?
 */
class ContextStructure extends Act
{
	private $setId;
	private $versionNumber;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("COMPOSITION");
		$this->setId = NULL;
		$this->versionNumber = 0;
	}


	/**
	 * @param $setId datatyope from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-II
	 * @Definition A unique identifier for a report
	 * @UsageNotes The setID remains constant across all revisions that derive from a common original.
	**/
	public function setSetId($setId)
	{
		$this->setId = $setId;
	}


	/**
	 * @param $versionNumber A unique identifier for a version of a report.
	 * @UsageNotes The Modeling and Methodology Work Group will seek HL7 endorsement for a data type flavor of string that constrains the string to numerals only. This flavor, when available, can be used to constrain this attribute in such a way that users who prefer the previous "integer" version number can remain consistent with previous RIM releases of this attribute. 
	**/
	public function setVersionNumber($versionNumber)
	{
		$this->versionNumber = ($versionNumber > $this->versionNumber) ? $versionNumber;
	}
}

 ?>