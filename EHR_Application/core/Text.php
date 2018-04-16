<?php 

	/**
	* 
	*/
	class Text
	{
		
		private static $texts;

		public static function get($key, $data = null)
		{
			if (!$key) {
				return null;
			}

			if ($data) {
				foreach ($data as $var => $value) {
					${$var} = $value;
				}
			}

			//load config files (this is only done once per app lifecycle)
			if (!self::$texts) {
				self::$texts = require('../EHR_Application/config/texts.php');
			}

			return self::$texts[$key];
		}
	}

 ?>