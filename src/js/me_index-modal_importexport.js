$('#modal-sites_importexportcontent').find('input[type="file"]').change(function(e){
	let $this = $(this);
    let filename = e.target.files[0].name;
	$this.siblings('span').html('File: '+filename);
});
$('#modal-sites_importexportcontent').find('form').submit(function(event) {

	event.preventDefault();

	let $this 			= $(this);
	let $btn 			= $this.find('button.confirm-import');
	let $btnInput 		= $this.find('div.inputbtn-import');

	let rel_formData 	= new FormData(this);
	let site_id 		= $('#modal-sites_importexportcontent').attr('data-site_id');
	rel_formData.append('site_id', site_id);
	console.log('***************************************************');
	console.log('Import site content process started...');
	$btn.attr('disabled', true);
	$btnInput.attr('disabled', true);
	$.ajax({
		url: '/api/sites/import.my.site.php',
		// url: '/devbox/debug.php',
		type: 'POST',
		data: rel_formData,
        processData: false,
        contentType: false,
        cache: false
	})
	.done(function( xhrData ) {
		console.log('|_ Finished API request -> /api/sites/import.my.site.php');
		console.log('|_ Server responded with');
		console.log(xhrData);

	})
	.fail(function( xhrData ) {
		console.log("***************************************************");
		console.log('|_ Failed to access server side site data API -> /api/sites/import.my.site.php');
	})
	.always(function( xhrData ) {
		setTimeout(function(){
			$btn.attr('disabled', false);
			$btnInput.attr('disabled', false);
			$btnInput.children('span').html('SELECT FILE');
			$btnInput.children('input[type="file"]').val(null);
		}, 1300);
		console.log('Import site content process completed...');
	});

});
