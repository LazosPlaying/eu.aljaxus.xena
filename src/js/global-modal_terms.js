$(document).ready(function() {
	$('#modal-terms').modal({
		preventScrolling: true,
		dismissible: false
   	});
	{
		$('#modal-terms').find('.modal-content').load('/terms.php');
		$('.terms-open').on('click touchstart', function(event) {
			event.preventDefault();
			$('#modal-terms').modal('open');
		});

	}
});
function modalTerms(status){
	let el = $('#modal-terms');
	if (status){
		Cookies.set('terms_accept', true, { expires: 365 });
	} else {
		Cookies.set('terms_accept', false, { expires: 365 });
	}
	el.modal('close');
}
$(window).on("load", function(){
	setTimeout(function(){
		if ( !("terms_accept" in Cookies.get()) ){
			$('#modal-terms').modal('open');
			return false;
		} else {
			if( Cookies.get().terms_accept=="false" ){
				$('#modal-terms').modal('open');
				return false;
			} else if ( Cookies.get().terms_accept=="true" ) {
				return true;
			} else {
				return false;
			}
		}
	},1200);
});
