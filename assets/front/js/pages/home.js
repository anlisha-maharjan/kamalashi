//Home Banner
var homeBanner = new MasterSlider();
homeBanner.setup('home-banner', {
    width: 1024,
    height: 768,
    space: 5,
    view: 'parallaxMask',
    layout: 'fullscreen',
    speed: 20
});
homeBanner.control('bullets', { autohide: false });
// add scroll parallax effect
MSScrollParallax.setup(homeBanner, 50, 80, true);

//Rooms Selection
var slides = $('.rooms-thumb').length; //calculate no. slides to show

$('#rooms-selection-list').slick({ //Vertical Room Selection Slider
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    swipe: false,
    dots: false,
    vertical: false,
    focusOnSelect: true,
    asNavFor: '#rooms-slide',
    infinite: false,
    mobileFirst: true,
    responsive: [{
            breakpoint: 767,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 1023,
            settings: {
                arrows: false,
                slidesToShow: slides,
                vertical: true
            }
        }
    ]
});

$('#rooms-slide').slick({ //Selected room slider
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    swipe: false,
    fade: true,
    asNavFor: '#rooms-selection-list'
});

$('.selected-room-slide').slick({ //Selected room images slides
    adaptiveHeight: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    focusOnSelect: true,
    infinite: false
});

//Scrollable init
var windowWidth = $(window).width();
if (windowWidth >= 1024) {
    $('.scroll-vertical').scrollable({
        autoHide: false
    });
}

//Check in and Check out
$('.checkin').click(function() {
    $('.checkout').removeClass('hasDatepicker');
    $('.ui-datepicker').remove();
    $('.checkin').datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(),
        onSelect: function(date) {
            $('#checkin-date').val(date);
            if (date) {
                var items = date.split('-');
                var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var monthname = items[1] - 1;
                $('.checkinmonth').html(monthNames[monthname]);
                $('.checkinday').html(items[2]);
            }
            $('.checkin').children('.ui-datepicker').remove();
            $('.checkin').removeClass('hasDatepicker');
        }
    });
});

$('.checkout').click(function() {
    $('.checkin').removeClass('hasDatepicker');
    $('.ui-datepicker').remove();
    var checkindate = $('#checkin-date').val();
    var formatDate = checkindate.replace(/-/g, ',');
    $('.checkout').datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(formatDate),
        onSelect: function(date) {
            $('#checkout-date').val(date);
            if (date) {
                var items = date.split('-');
                var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var monthname = items[1] - 1;
                $('.checkoutmonth').html(monthNames[monthname]);
                $('.checkoutday').html(items[2]);
            }
            $('.checkout').children('.ui-datepicker').remove();
            $('.checkout').removeClass('hasDatepicker');
        }

    });
});

$(document).on('click', function(e) {
    if ($(e.target).hasClass("checkin")) return false;
    if ($(e.target).hasClass("checkout")) return false;
    if ($(e.target).hasClass("hidden-day")) return false;
    if ($(e.target).hasClass("selected-day")) return false;
    if ($(e.target).hasClass("month")) return false;
    if ($(e.target).hasClass("cal-img")) return false;
    if ($(e.target).hasClass("ui-datepicker-inline")) return false;
    if ($(e.target).hasClass("ui-datepicker-header")) return false;
    if ($(e.target).hasClass("ui-corner-all")) return false;
    if ($(e.target).hasClass("ui-icon")) return false;
    if ($(e.target).hasClass("ui-datepicker-title")) return false;
    if ($(e.target).hasClass("ui-datepicker-year")) return false;
    if ($(e.target).hasClass("ui-datepicker-month")) return false;

    $('.checkin').removeClass('hasDatepicker');
    $('.checkout').removeClass('hasDatepicker');
    $('.ui-datepicker').remove();
});