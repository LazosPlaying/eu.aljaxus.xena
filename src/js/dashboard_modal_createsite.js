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
