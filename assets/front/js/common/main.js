//Mobile Menu Toggler
$("#mobile-menu-toggler").on("click", function() {
    $(this).toggleClass('active');
    $(this).parent().toggleClass('mobile-nav-open');
    $('body').toggleClass('overflow-hidden');
});

function mainResize() {
    $('body').removeClass('overflow-hidden');
    var windowWidth = $(window).width();
    if (windowWidth > 1023) {
        //On Scroll Sticky Header
        $(window).unbind('scroll');
        $('#main-header').removeAttr('style');
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 40) {
                $('#main-header').addClass('fixed-header');
            } else {
                $('#main-header').removeClass('fixed-header');
            }
        });
    } else {
        $(window).unbind('scroll');
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 20) {
                $('#main-header').css('background-color', '#000000');
                $('#main-header').addClass('mobile-fixed-header');
            } else {
                $('#main-header').removeAttr('style');
                $('#main-header').removeClass('mobile-fixed-header');
            }
        });
        $('#main-header').removeClass('fixed-header');
    }
}

mainResize();

$(window).resize(function() {
    mainResize();
});

//Default Select Init
$('select').select2({
    minimumResultsForSearch: Infinity
});