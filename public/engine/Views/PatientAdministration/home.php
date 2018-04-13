<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<div>
		<input type="text" name="searchBox" id="searchBox" placeholder="search patient">
	</div>
	<div id="result">
		
	</div>
</body>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#searchBox').keyup(function(event) {
			/* Act on the event */
			$.ajax({
				url: 'engine/Controllers/driver.controller.php',
				type: 'POST',
				dataType: 'json',
				data: {controller: 'PatientAdministration', action: 'searchPatient', data: $('#searchBox').val()},
				success: function(data)
				{
					$('#result').html(data);
				}
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	});
</script>
</html>