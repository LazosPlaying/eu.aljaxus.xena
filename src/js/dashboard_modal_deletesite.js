$('#modal-sites_delete-input_sitename').on('keyup', function(event) {
	event.preventDefault();
	/* Act on the event */
	let sitename = $('.modal#modal-sites_delete').attr('data-site_name');
	if ($(this).val() == sitename){
		$('.modal#modal-sites_delete').find('a[data-action="delete"]').attr('disabled', false);
		$('#modal-sites_delete-input_sitename').addClass('valid').removeClass('invalid');
	} else {
		$('.modal#modal-sites_delete').find('a[data-action="delete"]').attr('disabled', true);
		$('#modal-sites_delete-input_sitename').addClass('invalid').removeClass('valid');
	}
});
$('.modal#modal-sites_delete').find('a[data-action="cancel"]').on('click', function() {
	$('#modal-sites_delete-input_sitename').val(null);
	$('#modal-sites_delete-input_sitename').removeClass('invalid').removeClass('valid');
});

$('.modal#modal-sites_delete').find('a[data-action="delete"]').on('click', function() {
	$('#modal-sites_delete-input_sitename').val(null).attr('disabled', true);
	$('.modal#modal-sites_delete').find('a[data-action="cancel"]').attr('disabled', true);
	$('.modal#modal-sites_delete').find('a[data-action="delete"]').attr('disabled', true);
	$('#modal-sites_delete-input_sitename').removeClass('invalid').removeClass('valid');


});
