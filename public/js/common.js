jQuery(document).ready(function($) {
	//manage the dropdown
	// $('.dropbtn').click(function(event) {
	// 	console.log($(this).attr('id'));
	// 	$('#'+$(this).attr('id')).next('.dropdown-content').toggleClass('show');
	// });
	
	$('.showdrop').click(function(event) {
		showDropdown($(this).attr('id'), '.hidden');
	});

	$('.droptxt').click(function(event) {
		$('#'+$(this).attr('id')).next('.dropdown-content').toggleClass('show');
	});

	$('.dropdown-content a').click(function(event) {
		var text = $($(this).contents().get(1)).text();
		$($(this).parent().prev()).val(text);
		$(this).parent().toggleClass('show');
		var res = text.replace(new RegExp(' ', 'g'), "_");
		$("#addr" + res).removeClass('hidden').addClass('dropdown');
	});

	$('.deleteField').click(function(event) {
		//$(this).parent().remove();
		if (($($($(this).parent()).parent()).parent().children().length) > 1) {
			$($(this).parent()).parent().remove();
		}
	});

//end for managing the dropdown
});

function showDropdown(element, classname)
{
	$('#' + element).next(classname).toggle(400);
}