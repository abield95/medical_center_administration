$(document).load(function() {
	/* Act on the event */
	$('#add_user').click(function(event) {
		/* Act on the event */
		$.ajax({
			url: 'users/add_user.php',
			type: 'GET',
			data: {param1: 'value1'},
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