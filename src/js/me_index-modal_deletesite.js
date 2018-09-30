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
	$('#modal-sites_delete-input_sitename').removeClass('invalid').removeClass('valid').attr('disabled', true);;
});

$('.modal#modal-sites_delete').find('a[data-action="delete"]').on('click', function() {

	let modal = $('.modal#modal-sites_delete');
	let site_name = $('#modal-sites_delete-input_sitename').val();

	$('#modal-sites_delete-input_sitename').attr('disabled', true);
	modal.find('a[data-action="cancel"]').attr('disabled', true);
	modal.find('a[data-action="delete"]').attr('disabled', true);
	$('#modal-sites_delete-input_sitename').removeClass('invalid').removeClass('valid');

	console.log("***************************************************");
	console.log('Delete site process started...');
	$.post(
		'/api/sites/delete.my.site.php',
		{
			site_name: site_name
		}
	)
	.done(function( xhrData ) {
		console.log('|_ Finished API request -> /api/sites/delete.my.site.php');
		console.log('|_ Server responded with');
		console.log(xhrData);

		if (xhrData.is_deleted==true){
			M.toast({
				html: '<i class="material-icons">check</i> Successfully deleted site!',
				classes: 'green'
			});
		} else if (xhrData.is_deleted==false) {
			M.toast({
				html: '<i class="material-icons">warning</i> Faled to delete site!',
				classes: 'red'
			});
		}

		modal.find('#modal-sites_delete-input_sitename').val(null);
		modal.modal('close');
		loadSites();
	})
	.fail(function( xhrData ) {
		console.log('|_ Failed to access server side site data API -> /api/sites/delete.my.site.php');
	})
	.always(function( xhrData ) {
		setTimeout(function(){
			$('#modal-sites_delete-input_sitename').attr('disabled', false);
			modal.find('a[data-action="cancel"]').attr('disabled', false);
			modal.find('a[data-action="delete"]').attr('disabled', false);
		}, 1300);
		console.log('Delete site process completed...');
	});

});
