<?php 

	/**
	* Configutation
	*/
	class Config
	{
		public static $config;	//public to allow testing

		public static function get($parameter)
		{
			if (!self::$config) {
				# code...
				$config_file = '../Application/config/config.app.php';

				if (!file_exists($config_file)) {
					# code...
					return false;
				}

				self::$config = require $config_file;
			}

			return self::$config[$parameter];
		}
	}

 ?>