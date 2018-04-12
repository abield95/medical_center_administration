<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administration Toolkit</title>
	<script type="text/javascript" src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
	<?php require "engine/index.php" ?>
</body>
</html> -->

<?php 
	if (isset($_REQUEST['controller']) && isset($_REQUEST['action'])) {
		# code...
		$controller = $_REQUEST['controller'];
		$action = $_REQUEST['action'];
	}
	else{
		$controller = "pages";
		$action = 'home';
	}

	require_once('engine/index.php');
 ?>