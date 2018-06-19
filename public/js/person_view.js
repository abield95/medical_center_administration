jQuery(document).ready(function($) {
	$('#deceasedInd').click(function(event) {
		if ($(this).is(':checked')) {
			$('#deceasedInfo').toggle('show');
		}
		else
		{
			$('#deceasedInfo').toggle('show');
		}
	});

	$('#multipleBirthInd').click(function(event) {
		if ($(this).is(':checked')) {
			$('#multipleBirthNumber').toggle('show');
		}
		else
		{
			$('#multipleBirthNumber').toggle('show');
		}
	});

	$('#addDisability').click(function(event) {
		//var element = $('#telecomContainer_0').clone(true, true);
		var element = $('[id^="disabilityContainer_"').first().clone(true, true);


		// console.log("pruebaasas: " + $(element).children('.prueba').attr('id'));
		var num = (parseInt($('#hiddenValDis').text())) + 1;
		$('#hiddenValDis').text(num);

		var id = "disabilityContainer_" + num;
		$(element).attr({
			'id': id
		});
		$('#disElementContainer').append(element);

		$('#'+id).children('.dropdown').children('.droptxt').attr({
			'id': 'disabilityType_' + num
		})
		// $('#'+id).children('.capabilities').children('.droptxt').attr({
		// 	'id': 'capabilities_' + num
		// })
	});
});