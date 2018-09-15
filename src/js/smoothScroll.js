///////////////////////////////////////////////////////////
//////////////// FUNCTION FOR SMOOTH SCROLL ///////////////
///////////////////////////////////////////////////////////
$(function() {
    // This will select everything with the class smoothScroll
    // This should prevent problems with carousel, scrollspy, etc...
    $('.smoothScroll').click(function() {
        //CLOSE THE DROPDOWN IN NAVIGATION
        $('#navdrop11').removeClass("show");
        $('#navdrop12').attr("aria-expanded", "false");
        $('#navdrop13').removeClass("show");
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
