<?php 

require_once 'Role.php';

/**
 * Employee
 * @Definition A role played by a person who is associated with an organization to receive wages or salary.
 * @UsageNotes The employing organization is the scoper. The purpose of the role is to identify the type of relationship the employee has to the employer rather than the nature of the work actually performed (contrast with AssignedEntity). 
 */
class Employee extends Role
{
	private $jobCode;
	private $jobTitleName;
	private $jobClassCode;
	private $occupationCode;
	private $salaryTypeCode;
	private $salaryQuantity;
	private $hazardExposureText;
	private $protectiveEquipmentText;

	function __construct()
	{
		parent::__construct();

		$this->jobCode = NULL;
		$this->jobTitleName = NULL;
		$this->jobClassCode = NULL;
		$this->occupationCode = NULL;
		$this->salaryTypeCode = NULL;
		$this->salaryQuantity = NULL;
		$this->hazardExposureText = NULL;
		$this->protectiveEquipmentText = NULL;
	}


	/**
	 * @param $jobCode A code specifying the job performed by the employee for the employer. For example, accountant, programmer analyst, patient care associate, staff nurse, etc.
	 * @Definition An employer-defined categorization of work.
	 * @UsageNotes This value is used primarily for payroll/remuneration purposes and is not necessarily indicative of an employee's specific work assignments, responsibilities and privileges.
	 * @Examples Accountant, programmer analyst, patient care associate, staff nurse
	**/
	public function setJobCode($jobCode)
	{
		$this->jobCode = $jobCode;
	}


	/**
	 * @param $jobTitleName The title associated with the job held.
	 * @UsageNotes This is a local name for the employee's occupation that does not necessarily correspond to any scheme for categorizing occupation. Trading partners that need a coded standard should be using the Employee "occupation" attribute. 
	 * @Examples Vice President; Senior Technical Analyst
	**/
	public function setJobTitleName($jobTitleName)
	{
		$this->jobTitleName = $jobTitleName;
	}


	/**
	 * @param $jobClassCode from file:///D:/santo/Documents/Tesis/HL7_V3NormativeEdition2015_2CDset/Edition2015_CD_1/Edition2015/infrastructure/vocabulary/EmployeeJobClass.html
	 * @Definition The frequency or periodicity of employment.
	 * @Examples Full-time, part-time
	**/
	public function setJobClassCode($jobClassCode)
	{
		$this->jobClassCode = array(
			'code' => $jobClassCode,
			'codeSystem' => "2.16.840.1.113883.5.1059",
			'codeSystemName' => "EmployeeJobClass",
			'codeSystemVersion' => "1"
		);
	}


	/**
	 * @param $occupationCode A value that qualifies the classification of 'kind-of-work' based upon a recognized industry or jurisdictional standard.
	 * @Definition Industry and/or jurisdictional classification system for kind-of-work performed by an employee. 
	 Occupation codes are intended primarily as work descriptions that are suitable for a multitude of public uses e.g., job matching, employment counseling, occupational and career guidance, and labor market information services. 
	**/
	public function setOccupationCode($occupationCode)
	{
		$this->occupationCode = $occupationCode;
	}


	/**
	 * @param $salaryTypeCode A value representing the method used by an employer to compute an employee's salary or wages.
	 * @Examples Hourly, annual, commision
	**/
	public function setSalaryTypeCode($salaryTypeCode)
	{
		$this->salaryTypeCode = $salaryTypeCode;
	}


	/**
	 * @param $salaryQuantity The amount paid in salary or wages to an employee.
	 * @param $currency defined in ISO 4217
	 * @usageNotes This amount should be determined according to the computation method specified in salaryTypeCode, (e.g., if the salaryTypeCode is "hourly" the salaryQuantity specifies the hourly wage).
	**/
	public function setSalaryQuantity($salaryQuantity, $currency)
	{
		$this->salaryQuantity = array(
			'value' => $salaryQuantity,
			'currency' => $currency
		);
	}


	/**
	 * @param $hazarExposureText The hazards associated with the work performed by an employee for an employer.
	 * @Examples Asbestos; infectious agents
	**/
	public function setHazardExposureText($hazardExposureText)
	{
		$this->hazardExposureText = $hazardExposureText;
	}


	/**
	 * @param $protectiveEquipmentText Protective equipment needed for the job performed by an employee for an employer
	 * @Examples Safety glasses, hardhat
	**/
	public function setProtectiveEquipmentText($protectiveEquipmentText)
	{
		$this->protectiveEquipmentText = $protectiveEquipmentText;
	}
}

 ?>