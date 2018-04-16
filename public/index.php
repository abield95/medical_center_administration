<?php 
	// if (isset($_REQUEST['controller']) && isset($_REQUEST['action'])) {
	// 	# code...
	// 	$controller = $_REQUEST['controller'];
	// 	$action = $_REQUEST['action'];
	// }
	// else{
	// 	$controller = "PatientAdministration";
	// 	$action = 'home';
	// }

	// require_once('engine/index.php');
	require_once('../EHR_Application/autoload.php');

	new EHR_Application();
 ?>