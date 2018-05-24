<?php 

namespace CommunicationInfrastructure\CoreInfrastructure\StructuredDocuments;

require_once 'ContextStructure.php';

/**
 * Document
 * @Definition A specialization of Act that supports the characteristics unique to document management services.
 */
class Document extends ContextStructure
{
	private $completionCode;
	private $storageCode;
	private $copyTime;
	private $bibliographicDesignationText;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("DOC");
		$this->completionCode = NULL;
		$this->storageCode = NULL;
		$this->copyTime = NULL;
		$this->bibliographicDesignationText = NULL;
	}


	/**
	 * @param $completionCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/DocumentCompletion.html
	 * @Definition A code depicting the completion status of a report.
	 * @Examples Incomplete, authenticated, legally authenticated
	**/
	public function setCompletionCode($completionCode)
	{
		$this->completionCode = array(
			'code' => $completionCode,
			'codeSystem' => "2.16.840.1.113883.5.33",
			'codeSystemName' => "DocumentCompletion",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $storageCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/DocumentStorage.html
	 * @Definition The storage status of a report
	 * @Examples Active, archived, purged
	**/
	public function setStorageCode($storageCode)
	{
		$this->storageCode = array(
			'code' => $storageCode,
			'codeSystem' => "2.16.840.1.113883.5.34",
			'codeSystemName' => "DocumentStorage",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $copyTime The time a document is released (i.e., copied or sent to a display device) from a document management system that maintains revision control over the document.
	 * @UsageNotes The intent of this attribute is to give the viewer of the document some notion as to how long the document has been out of the safe context of its document management system. 
	 * @FormalConstraint Once valued, this attribute cannot be changed.
	 * @Example yyyymmddhhmmss
	**/
	public function setCopyTime($copyTime)
	{
		$this->copyTime = $copyTime;
	}


	/**
	 * @param bibliographicDesignationText datatype from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/datatypes_r2/datatypes_r2.html#dt-ED
	 * @Definition A citation for a cataloged document that permits its identification, location and/or retrieval from common collections.
	**/
	public function addBibliographicDesignationText($bibliographicDesignationText)
	{
		if (!is_array($this->bibliographicDesignationText)) {
			$this->bibliographicDesignationText = array();
		}

		$this->bibliographicDesignationText[] = $bibliographicDesignationText;
	}
}

 ?>