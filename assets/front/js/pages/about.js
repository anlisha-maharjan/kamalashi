//Different transistion timeout for parallax section
var circleList = $(".circle-holder").length;
var totalcircleList = circleList * 300;
var attr = 'ms' + ' ' + 'ease';

$(".circle-holder").each(function () {
    var that = $(this);
    that.css('transition', totalcircleList + attr);
    totalcircleList = totalcircleList + 300;
});
//On Scroll show group section
$(document).scroll(function () {
    var appScrollPos = $(this).scrollTop();
    var appScollAnimate = $(".section-room-counter").position();

    if (appScrollPos > (appScollAnimate.top - 500)) { // -50 so things don't overlap
        $(".circle-holder").addClass('rotate-show');
    }
    else {
        $(".circle-holder").removeClass('rotate-show');
    }
});
