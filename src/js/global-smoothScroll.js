///////////////////////////////////////////////////////////
//////////////// FUNCTION FOR SMOOTH SCROLL ///////////////
///////////////////////////////////////////////////////////
$(function() {
    // This will select everything with the class smoothScroll
    // This should prevent problems with carousel, scrollspy, etc...
    $('.smoothScroll').click(function(event) {
		event.preventDefault();
        //CLOSE THE DROPDOWN IN NAVIGATION
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            let a = $(this.hash);
            a = a.length ? a : $('[name=' + this.hash.slice(1) + ']');
            if (a.length) {
                $('html,body').animate({
                    scrollTop: a.offset().top-80
                }, 1700); // The number here represents the speed of the scroll in milliseconds
                return false;
            }
        }
    });
});
