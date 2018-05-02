<?php 

	/**
	* Class Filter
	*avoid XSS attack
	*/
	class Filter
	{
		
		public static function XSSFilter(&$value)
		{
			//if argument is a string, filter that string
			if (is_string($value)) {
				$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
			}
			//if argument is an array or an object
			//recursively filter its content
			elseif (is_array($value) || is_object($value)) {
				foreach ($value as &$valueInValue) {
					self::XSSFilter($valueInValue);
				}
			}

			return $value;
		}
	}

 ?>