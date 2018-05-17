<?php 

require_once('ManufacturedMaterial.php');

/**
 * Device
 * Definition: A ManufacturedMaterial used in an activity without being substantially changed through that activity.
 * UsageNotes: This includes durable (reusable) medical equipment as well as disposable equipment. The kind of device is identified by the code attribute inherited from Entity. 
 */
class Device extends ManufacturedMaterial
{
	private $manufacturedModelName;
	private $softwareName;
	private $localRemoteControlStateCode;
	private $alertLevelCode;
	private $lastCalibrationTime;

	function __construct()
	{
		parent::__construct();
		$this->setClassCode("DEV");

		$this->manufacturedModelName = NULL;
		$this->softwareName = NULL;
		$this->localRemoteControlStateCode = NULL;
		$this->alertLevelCode = NULL;
		$this->lastCalibrationTime = NULL;
	}


	/**
	 * @param $manufacturerModelName The human designated moniker for a device, assigned by the manufacturer.
	 * Examples: Perkin Elmer 400 Inductively Coupled Plasma Unit
	**/
	public function setManufacturerModelName($manufacturedModelName)
	{
		$this->manufacturedModelName = $manufacturedModelName;
	}


	/**
	 * @param $softwareName The moniker, version and release of the software that operates the device as assigned by the software manufacturer or developer.
	 * Example: Agilent Technologies Chemstation A.08.xx
	**/
	public function setSoftwareName($softwareName)
	{
		$this->softwareName = $softwareName;
	}


	/**
	 * @param $localRemoteControlStateCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/LocalRemoteControlState.html
	 * Definition: The state of control of the device.
	 *Rationale: A device can either work autonomously or it can be controlled by another system. The control status of a device must be communicated between devices prior to remote commands being transmitted. If the device is not in "Remote" status, external commands will be ignored. 
	 * Example: Local, remote
	**/
	public function setLocalRemoteControlStateCode($localRemoteControlStateCode)
	{
		$this->localRemoteControlStateCode = array(
			'code' => $localRemoteControlStateCode,
			'codeSystem' => "2.16.840.1.113883.5.66",
			'codeSystemName' => "LocalRemoteControlState",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $alertLevelCode From file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/DeviceAlertLevel.html
	 * Definition: The current functional status of an automated device
	 * Usage Notes: The value of the attribute is determined by the device.
	 * Example: Normal, Warning, critical
	**/
	public function setAlertLevelCode($alertLevelCode)
	{
		$this->alertLevelCode = array(
			'code' => $alertLevelCode,
			'codeSystem' => "2.16.840.1.113883.5.31",
			'codeSystemName' => "DeviceAlertLevel",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $lastCalibrationTime The date and time the device was last calibrated.
	 * Rationale: Devices are required to be recalibrated at specific intervals to ensure they are performing within specifications. The accepted interval between calibrations varies with protocols. Thus for results to be valid, the precise date and time of last calibration is a critical component. 
	**/
	public function setLastCalibrationTime($lastCalibrationTime)
	{
		$this->lastCalibrationTime = $lastCalibrationTime;
	}
}

 ?>