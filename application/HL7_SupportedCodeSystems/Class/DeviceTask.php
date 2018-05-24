<?php 

namespace CommunicationInfrastructure\CoreInfrastructure;

require_once 'Act.php';

/**
 * DeviceTask
 * @Definition An activity of an automated system
 * @usageNotes Device tasks are either invoked by an outside command or scheduled and executed spontaneously by the device (e.g., regular calibration or flushing). The command to execute the task has moodCode <= RQO; an executed task (including a task in progress) has moodCode <= EVN; and an automatic task on the schedule has moodCode <= APT. 
 */
class DeviceTask extends Act
{
	private $parameterValue;
	function __construct()
	{
		parent::__construct();
		$this->setClassCode("CONTREG");
		$this->parameterValue = NULL;
	}


	/**
	 * @param $parameterValue The parameters of the task submitted to the device upon the issuance of a command (or configuring the schedule of spontaneously executed tasks). 
	 * @UsageConstraint Parameters are only specified here if they are not included in a separate HL7-defined structure. 
	 * @UsageNotes The parameters are data values interpreted by the device. The parameters should be typed with an appropriate HL7 data type (e.g., codes for enumerated values, REAL and INT for numbers, TS for points in time, PQ for dimensioned quantities, etc.). However, apart from data typing, the parameter semantics is opaque to the HL7 standard. 
	 * @Rationale Some parameters for tasks are uniquely defined by a specific model of equipment. Most critical arguments of a task (e.g., container to operate on, positioning, timing, etc.) are specified in an HL7 standardized static information structure, and the parameter list would not be used for those. The parameter list is used only for those parameters that cannot be standardized because they are uniquely defined for a specific model of equipment. NOTE: This means that the semantics and interpretation of a parameterValue can only be made with an understanding of the specifications or documentation for the specific device being addressed. This contextual information is not conveyed as part of the message. 
	 * @DesignComments The concept of an HL7 defined or standardized structure should be defined here or in the glossary and referenced.
	**/
	public function addParameterValue($parameterValue)
	{
		if (!is_array($this->parameterValue)) {
			$this->parameterValue = array();
		}

		$this->parameterValue[] = $parameterValue;
	}
}
 ?>