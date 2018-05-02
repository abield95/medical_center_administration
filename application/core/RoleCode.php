<?php 

/**
* Loading role code info
*/
class RoleCode
{
	public static $roleCode;
	public static function get($section)
	{
		if (!self::$roleCode) {
			$role_code_file = '../application/HL7_SupportedCodeSystems/' . $section . '.php';

			if (!file_exists($role_code_file)) {
				return false;
			}

			self::$roleCode = require $role_code_file;
		}
		return self::$roleCode[$key];
	}

	public static function getFilePart($file ,$key)
	{
		$file = '../application/HL7_SupportedCodeSystems/' . $file . '.php';
		if (!file_exists($file)) {
			# code...
			echo "file no exis";
			return false;
		}
		require $file;

		return getData($key);
	}

	public static function getGender()
	{
		$file = Config::get('PATH_HL7_SUPPORTED_CODE_SYSTEM') . 'AdministrativeGender.php';

		if (!file_exists($file)) {
			return false;
		}

		$requiredFile = require $file;

		$var = "<select> name='genderCode'";

		foreach ($requiredFile as $key => $value) {
			$var .= "<option value='" . $key . "'>" . $requiredFile[$key]['name'] . "</option>";
		}

		$var .= "</select>";

		echo $var;
		//echo RoleCode::setSelectFromReturnedArray($gender, "genderCode");
	}

	public static function getAddressFields()
	{
		$data = RoleCode::getFilePart("DataTypes", "AddressPartType");
		if ($data == false) {
			# code...
			echo "error";
		}

		foreach ($data as $key => $value) {
			# code...
			echo "key " .$key . "<br>";
		}
	}
}

 ?>