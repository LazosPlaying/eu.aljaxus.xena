$('#modal-sites_createnew').find('a[data-option="showowner"]').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	let $this = $(this);
	let state = ( $this.attr('data-state')=='enabled' ) ? true : false ;
	if (state == true){
		$this.attr('data-state', 'disabled').html('<i class="material-icons left" style="margin:0;">visibility_off</i>').removeClass('green').addClass('red').attr('data-tooltip', 'Enable owner details visibility');
	} else {
		$this.attr('data-state', 'enabled').html('<i class="material-icons left" style="margin:0;">visibility</i>').removeClass('red').addClass('green').attr('data-tooltip', 'Disable owner details visibility');
	}
});
$('#modal-sites_createnew').find('a[data-option="enabled"]').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	let $this = $(this);
	let state = ( $this.attr('data-state')=='enabled' ) ? true : false ;
	if (state == true){
		$this.attr('data-state', 'disabled').html('<i class="material-icons left" style="margin:0;">lock</i>').removeClass('green').addClass('red').attr('data-tooltip', 'Enable this site');
	} else {
		$this.attr('data-state', 'enabled').html('<i class="material-icons left" style="margin:0;">lock_open</i>').removeClass('red').addClass('green').attr('data-tooltip', 'Disable this site');
	}
});
$('#modal-sites_createnew').find('input[type="file"]').change(function(e){
	let $this = $(this);
    let filename = e.target.files[0].name;
	$this.siblings('span').html('File: '+filename);
});
$('#modal-sites_createnew').find('button[data-action="clear-import"]').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$(this).siblings('div.inputbtn-import').children('span').html('SELECT FILE');
	$(this).siblings('div.inputbtn-import').children('input[type="file"]').val(null);
});
$('#modal-sites_createnew').find('a[data-action="confirm-create-site"]').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	let $btn 		= $(this);
	let modal 		= $('#modal-sites_createnew');
	let formData 	= new FormData();
	let name 		= modal.find('#newsite-name').val();
	let displayname	= modal.find('#newsite-displayname').val();
	let showowner 	= ( modal.find('a[data-option="showowner"]').attr('data-state')=='enabled' ) ? true : false;
	let enabled  	= ( modal.find('a[data-option="enabled"]').attr('data-state')=='enabled' ) ? true : false;

	formData.append('name', name);
	formData.append('displayname', displayname);
	formData.append('showowner', showowner);
	formData.append('enabled', enabled);
	formData.append("importfile", document.getElementById('modal-sites_createnew-fileinput').files[0]);

	$btn.attr('disabled', true);
	modal.find('#newsite-name').attr('disabled', true);
	modal.find('#newsite-displayname').attr('disabled', true);
	modal.find('a[data-option="showowner"]').attr('disabled', true);
	modal.find('a[data-option="enabled"]').attr('disabled', true);
	modal.find('#modal-sites_createnew-fileinput').attr('disabled', true);
	$('#modal-sites_createnew').find('button[data-action="clear-import"]').attr('disabled', true);

	console.log("***************************************************");
	console.log('Import site content process started...');
	$.ajax({
		url: '/api/sites/create.new.site.php',
		// url: '/devbox/debug.php',
		type: 'POST',
		data: formData,
        processData: false,
        contentType: false,
        cache: false
	})
	.done(function( xhrData ) {
		console.log('|_ Finished API request -> /api/sites/create.new.site.php');
		console.log('|_ Server responded with');
		console.log(xhrData);
		xhrData.toasts.forEach(function(el){
			M.toast({
				html: el.html,
				classes: (el.classes!=undefined||el.classes!='') ? el.classes : ''
			});
		});
		if (xhrData.is_success==true){
			M.toast({
				html: '<i class="material-icons">check</i> Successfully created new site!',
				classes: 'green'
			});
			modal.find('#newsite-name').val(null);
			modal.find('#newsite-displayname').val(null);
			modal.find('form[data-content="fileupload"]').find('span').html('SELECT FILE');
			modal.find('form[data-content="fileupload"]').find('input[type="file"]').val(null);
			modal.modal('close');
			loadSites();
		}
	})
	.fail(function( xhrData ) {
		console.log('|_ Failed to access server side site data API -> /api/sites/create.new.site.php');
	})
	.always(function( xhrData ) {
		setTimeout(function(){
			$btn.attr('disabled', false);
			modal.find('#newsite-name').attr('disabled', false);
			modal.find('#newsite-displayname').attr('disabled', false);
			modal.find('a[data-option="showowner"]').attr('disabled', false);
			modal.find('a[data-option="enabled"]').attr('disabled', false);
			modal.find('#modal-sites_createnew-fileinput').attr('disabled', false);
			$('#modal-sites_createnew').find('button[data-action="clear-import"]').attr('disabled', false);

		}, 1300);
		console.log('Import site content process completed...');
	});
});
