<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Medical Staff</title>

	<style type="text/css">
		#leftSide
		{
			float: left;
			height: 90%;
			width: 20%;
			border: 1px solid blue;
		}

		#rigthSide
		{
			float: left;
			height: 90%;
			width: 79%;
			border: 1px solid red;
		}

		#footer
		{
			border: 1px solid magenta;
			float: left;
			clear: both;
			width: 99%;
		}

		#prueba
		{
			border: 1px solid green;
		}
	</style>
</head>
<body>
	<section id="leftSide">
		
	</section>
	<section id="rigthSide">
		<?php require "staff.php" ?>
	</section>

	<footer id="footer">
		<div id="prueba">
			
		</div>
	</footer>
</body>
</html>