<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

include_once 'Observation.php';

/**
 * DiagnosticImage
 * @Definition An observation in the form of a spatial representational of a physical subject suitable for visual presentation.
 * @DesignComments Definition rewritten to exclude apparently extraneous concepts.
 */
class DiagnosticImage extends Observation
{
	private $subjectOrientationCode;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("DGIMG");
	}


	/**
	 * @param $subjectOrientationCode desc file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/voc_ConceptDomains.html#ImagingSubjectOrientation
	 * @Definition The spatial relation between an imaged object and the imaging film or detector.
	**/
	public function setSubjectOrientationCode($subjectOrientationCode)
	{
		$this->subjectOrientationCode = $subjectOrientationCode;
	}
}

 ?>