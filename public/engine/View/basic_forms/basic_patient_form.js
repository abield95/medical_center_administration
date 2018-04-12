jQuery(document).ready(function($) {
	$("#patient_data").submit(function(event) {
		/* Act on the event */
		event.preventDefault();

		var dataForm = {
			'name' : $('input[name=name]').val(),
			'lastName' : $('input[name=lastName]').val(),
			'sex' : $('select[name=sex] :selected').text(),
			'birthDate' : $('input[name=birthDate]').val(),
			'race' :$('input[name=race]').val(),
			'maritalStatus' :$('select[name=maritalStatus] :selected').text(),
			'socialSecurityNumber' :$('input[name=socialSecurityNumber]').val(),
			'identificationNumber' : $('input[name=identificationNumber]').val(),
			'languajeForSpeaking' : $('select[name=languajeForSpeaking] :selected').val(),
			'languajeForWritingMedInfo' : $('select[name=languajeForWrittenMedicalInfo] :selected').val(),
			'interpreter' : ($('input[name=checkForInterpreter]').is(':checked') ? 1 : 0),
			'address' : $('input[name=address]').val(),
			'city' : $('input[name=city]').val(),
			'state' : $('input[name=state]').val(),
			'country' : $('input[name=country]').val(),
			'postalCode' : $('input[name=postalCode]').val(),
			'emergencyContact' : $('input[name=emergencyContact]').val(),
			'emergencyPhone' : $('input[name=emergencyPhone]').val(),
			'workPhone' : $('input[name=workPhone]').val(),
			'homePhone' : $('input[name=homePhone]').val(),
			'mobilePhone' : $('input[name=mobilePhone]').val(),
			'contactEmail' : $('input[name=contactEmail]').val()
		}
		$.ajax({
			url: 'engine/Controller/patient.php',
			type: 'POST',
			dataType: 'json',
			data: {order: "new" ,data:dataForm},
			success: function(data)
			{
				console.log(data);
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