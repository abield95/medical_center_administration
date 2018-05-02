<?php 

/**
* Address class
*/
class Address
{
	private $use;
	private $useablePeriod; //GTS general time specification
	private $isNotOrdered;//boolean
	private $formatted;
	function __construct()
	{
		$use = array();
	}


	/**
	 *@param $arrayParameters parameters for loading the info example
	 *	level4 parameter => [CHOICE, LEVEL, L1Parent, L2Parent, L3Parent, L4Parent..so on]
	*/


	public static function loadAddrFields()
	{
		$data_type_file = '../application/HL7_SupportedCodeSystems/DataTypes.php';
		if (!file_exists($data_type_file)) {
			return;
		}
		require_once $data_type_file;
		$data = getData("PostalAddressUse");

		$result = Address::getDivForm(1, $data, "Address Used");
		echo $result;
	}

	public static function getDivForm($level = 1, $data = ["default"], $baseName = "default")
	{
		if (!is_array($data)) {
			//echo "No arra<br>";
			return;
		}

		$className = "";

		if ($level == 1) {
			# code...
			$className = "dropdown";
		}
		else
		{
			$className = "hidden";
		}

		$lev = $level + '1';
		$nextLevel = "level" . $lev;

		$div = "<div class='".$className."' ".str_replace(" ", "_", $baseName)."' id='addr".str_replace(" ", "_", $baseName)."'>";
		$div .= "<input type='text' class='droptxt' placeholder='".$baseName."' id='".str_replace(" ", "_", $baseName)."'/>";
		$div .= "<div class='dropdown-content'>";
		$retVal = "";

		foreach ($data as $key => $value) {
			//enter the cycle
			//echo "Key: " . $key . "<br>";
			if (is_array($value)) {
				//run the array data
				$div.= "<a class='tooltip'><spam class='tooltiptext'>".$value['description']."</spam>".$value['name']."</a><br>";
				
				foreach ($value as $key1 => $value1) {
					if ($key1 == $nextLevel) {
						$retVal .= Address::getDivForm(($level + 1), $value[$nextLevel], $value['name']);
					}
					//echo "..Key " . $key1 . "<br>";
				}

			}
		}
		$div .= "</div>";

		$div .= "</div>";

		$div .= $retVal;

		return $div;
	}

	public static function forEachCheck($array, $isMainContainer = 0)//0 yes is, 2 no is
	{
		$data = "";
		foreach ($array as $key => $value) {
			//echo "Key: " . $key . "<br>";

			if ($isMainContainer == 0) {
				# code...
				//echo "<hr>Key0 " . $key . "<br>";
				//$select .= "<select>"
				$data .= "select <br>";
			}
			elseif ($isMainContainer == 1) {
				# code...
				//echo "Key1";
				$data .= "option <br>";
			}

			if ($key == 'level') {
				# code...
				//echo $key . " => " . $value . "<br>";
			}
			elseif ($key == 'name') {
				# code...
				//echo $key . " => " . $value . "<br>";

				if ($isMainContainer == 1) {
					$data .= $value;
				}
			}
			elseif ($key == 'description') {
				# code...
				//echo $key . " => " . $value . "<br>";
			}
			elseif (isset($array['level'])) {
				# code...
				
				
				$levelNumber = $array['level'] + 1;
				$level = "level" . $levelNumber;
				if ($key == $level && is_array($value)) {
					# code...
					Address::forEachCheck($value);
				}
			}
			elseif (is_array($value)) {
				# code...
				echo Address::forEachCheck($value, 1);
			}
		}
		return $data;
	}
}

 ?>