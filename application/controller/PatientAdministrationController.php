<?php 

	/**
	* Patient Administration
	*/
	class PatientAdministrationController extends BaseController
	{
		public $telecommunication;
		function __construct()
		{
			parent::__construct();
			$telecommunication = new Telecomunication();
		}

		public function index()
		{
			$this->View->render('patient_administration/index');
		}

		public function addTelecomunicationFields()
		{
			$this->View->renderWithoutHeaderAndFooter('patient_administration/telecomunication');
			//echo require ;
		}

		public function addPatient()
		{
			$this->View->render('patient_administration/add_patient');
		}

		private function manageReturnedArrayFromFile()
		{
			
		}

		public function addAddressField()
		{
			if (Request::post('type')) {
	        	# code...
	        	$type = Request::post('type');

	        	Address::getFieldsUse($type);
	        }
		}

		public function registerPatient()
		{
			$this->View->render('patient_administration/patient_registration');
		}

		
	}

	class Telecomunication
	{
		//xml example <tel value="tel:+1(555)6755745;postd=545" use="WP"/>
		private $use;
		private $capabilities;
		private $useablePeriod;// Specifies the periods of time during which the telecommunication address can be used. For a telephone number, this can indicate the time of day in which the party can be reached on that telephone. For a web address, it may specify a time range in which the web content is promised to be available under the given address.
		public function setUse($key)
		{
			$this->use = $key;
		}

		public function getTelField()
		{
			# code...
		}

		public static function getKeys($filename)
		{
			$file = Config::get('PATH_HL7_SUPPORTED_CODE_SYSTEM') . 'telecom/' . $filename . '.php';

			if (!file_exists($file)) {
				return false;
			}

			$requiredFile = require $file;

			$var = "<div class='dropdown'>";
			$var .= "<input type='text' class='droptxt' placeholder='" . $filename . "'' id='" . $filename . "'' required='true'>";
			$var .= "<div class='dropdown-content'>";

			foreach ($requiredFile as $key => $value) {

				$var .= "<a class='tooltip'><span class='tooltiptext'>" . $requiredFile[$key]['description'] . "</span>" . $requiredFile[$key]['name'] . "</a>";
			}
			
			$var .= "</div>";
			$var .= "</div>";

			echo $var;

		}

		public function setCapabilities($key)
		{
			$this->capabilities = $key;
		}

		public function setUseablePeriod($value)
		{
			# code...
		}

		public static function telecomunicationField()
		{
			$this->View->render('telecommunication/telecommunication');
		}
	}

	/**
	* Guardiang
	*/
	class Guardian
	{
		
		function __construct()
		{
			# code...
		}
	}

	/**
	* Loading role code info
	*/
	// class RoleCode
	// {
	// 	public static $roleCode;
	// 	public static function get($section, $key)
	// 	{
	// 		if (!self::$roleCode) {
	// 			$role_code_file = '../Application/config/HL7_SupportedCodeSystem/RoleCode.php';

	// 			if (!file_exists($role_code_file)) {
	// 				return false;
	// 			}

	// 			self::$roleCode = require $role_code_file;
	// 		}
	// 		return self::$roleCode[$key];
	// 	}
	// }


 ?>