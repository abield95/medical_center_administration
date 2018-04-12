<?php 

	function call($controller, $action)
	{
		//require the controller name
		require_once('Controllers/'.$controller.'.controller.php');

		//create a new instance of the requested controller
		switch ($controller) {
			case 'PatientAdministration':
				# code...
				$controller = new PatientAdministrationController();
				break;
			
			default:
				# code...
				break;
		}

		$controller->{ $action }();
	}

	$controllers = array('PatientAdministration' => ['home', 'error']);

	//check that the requested controller and action are both allowed
	//if someone tries to acces something will be redirected to the error page

	if (array_key_exists($controller, $controllers)) {
		# code...
		if (in_array($action, $controllers[$controller])) {
			# code...
			call($controller, $action);
		}
		else{
			call('PatientAdministration', 'error');
		}
	}
	else{
		call('PatientAdministration', 'error');
	}

 ?>