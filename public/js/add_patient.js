jQuery(document).ready(function($) {
	$('#addTel').click(function(event) {
		$.ajax({
			url: 'redirect.php',
			type: 'POST',
			dataType: 'json',
			data: {controller: 'patientAdministration', action : 'prueba'},
			success: function (data) {
				$('#telecomFieldset').add(data);
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