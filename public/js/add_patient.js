jQuery(document).ready(function($) {
	$('#addTel').click(function(event) {
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'html',
			data: {url: "patientAdministration/addTelecomunicationFields"},//controller: 'patientAdministration', action : 'prueba'},
			success: function (data) {
				$('#telecomunicationContainer').append(data);
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


	//manage the dropdown
	// $('.dropbtn').click(function(event) {
	// 	console.log($(this).attr('id'));
	// 	$('#'+$(this).attr('id')).next('.dropdown-content').toggleClass('show');
	// });

	$('.droptxt').click(function(event) {
		$('#'+$(this).attr('id')).next('.dropdown-content').toggleClass('show');
	});

	$('.dropdown-content a').click(function(event) {
		var text = $($(this).contents().get(1)).text();
		console.log("text: " + text);
		$($(this).parent().prev()).val(text);
		$(this).parent().toggleClass('show');
		var res = text.replace(new RegExp(' ', 'g'), "_");
		$("#addr" + res).removeClass('hidden').addClass('dropdown');
	});

	//end for managing the dropdown
});