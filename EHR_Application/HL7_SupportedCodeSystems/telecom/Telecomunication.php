<?php 

//telecomunications address code

/**
* Telecomunication
*/
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

		$var = "<select>";

		foreach ($requiredFile as $key => $value) {
			$var .= "<option value='" . $key . "'>" . $requiredFile[$key]['name'] . "</option>";
		}

		$var .= "</select>";

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
}

 ?>