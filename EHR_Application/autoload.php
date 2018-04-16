<?php 

	require_once('../EHR_Application/core/Config.php');

	spl_autoload_register(function ($class_name) {
    	$baseDirectory = Config::get('PATH_BASE');
		$directories = array(
			'core/',
			'model/',
			'view/',
			'controller/',
			'HL7_SupportedCodeSystems/telecom/'
		);

		foreach ($directories as $directory) {
			# code...
			if (file_exists($baseDirectory.$directory.$class_name.'.php')) {
				# code...
				require_once($baseDirectory . $directory . $class_name . '.php');
				return;
			}
		}
	});

 ?>