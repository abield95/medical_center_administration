<?php 

/**
* Loading role code info
*/
class RoleCode
{
	public static $roleCode;
	public static function get($section, $key)
	{
		if (!self::$roleCode) {
			$role_code_file = '../EHR_Application/config/HL7_SupportedCodeSystem/RoleCode.php';

			if (!file_exists($role_code_file)) {
				return false;
			}

			self::$roleCode = require $role_code_file;
		}
		return self::$roleCode[$key];
	}
}

 ?>