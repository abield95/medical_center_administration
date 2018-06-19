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

	$('#addTelecom').click(function(event) {
		//var element = $('#telecomContainer_0').clone(true, true);
		var element = $('[id^="telecomContainer_"').first().clone(true, true);


		// console.log("pruebaasas: " + $(element).children('.prueba').attr('id'));
		var num = (parseInt($('#hiddenValTel').text())) + 1;
		$('#hiddenValTel').text(num);

		var id = "telecomContainer_" + num;
		$(element).attr({
			'id': id
		});
		$('#telecomunicationContainer').append(element);

		$('#'+id).children('.use').children('.droptxt').attr({
			'id': 'use_' + num
		})
		$('#'+id).children('.capabilities').children('.droptxt').attr({
			'id': 'capabilities_' + num
		})
	});
});