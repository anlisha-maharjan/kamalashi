$('.album-toggler').click(function() {
    $('.album-pop').addClass('open');
    $('body').addClass('overflow-hidden');
    $('header').addClass('blur');
    $('.inner-banner').addClass('blur');
    $('.breadcrumb-wrap').addClass('blur');
    $('#hero-gallery').addClass('blur');
    $('footer').addClass('blur');
});
$('.btn-close-pop-album').click(function() {
    $('.album-pop').removeClass('open');
    $('body').removeClass('overflow-hidden');
    $('header').removeClass('blur');
    $('.inner-banner').removeClass('blur');
    $('.breadcrumb-wrap').removeClass('blur');
    $('#hero-gallery').removeClass('blur');
    $('footer').removeClass('blur');

    setTimeout(function() {
        $('#album-pop-slide, #pop-slide-thumb').slick('unslick');
    }, 400)
});
var base_url = $('#base-url').val();


$(document).on('click', '.album', function(e) {
    $('#album-pop-slide').html('');
    $('#pop-slide-thumb').html('');
    $('.name').text('');
    var id = $(this).find(".gallery_id").text();
    var album_name = $(this).find(".album_name").text();
    if (id === '') {
        return false;
    } else {
        var html = '';
        $('.name').text(album_name);
        url = base_url + 'page/getGalleryMedia/' + id;
        $.ajax({
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'JSON',
            success: function(res) {
                
                $.each(res, function(key, value) {
                    html += '<figure style="background-image: url(' + base_url + value.media + ')"></figure>';
                });
                $('#album-pop-slide').append(html);
                $('#pop-slide-thumb').append(html);
                $('#album-pop-slide').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    infinite: true,
                    asNavFor: '#pop-slide-thumb',
                    prevArrow: '<button type="button" class="slick-prev"><img class="svg" src="' + base_url + 'assets/front/images/icons/icon-angle.png" /></button>',
                    nextArrow: '<button type="button" class="slick-next"><img class="svg" src="' + base_url + 'assets/front/images/icons/icon-angle.png" /></button>'
                });
                $('#pop-slide-thumb').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    asNavFor: '#album-pop-slide',
                    dots: false,
                    arrows: true,
                    infinite: true,
                    swipe: false,
                    focusOnSelect: true,
                    prevArrow: '<button type="button" class="slick-prev"><img class="svg" src="' + base_url + 'assets/front/images/icons/icon-angle-dark.png" /></button>',
                    nextArrow: '<button type="button" class="slick-next"><img class="svg" src="' + base_url + 'assets/front/images/icons/icon-angle-dark.png" /></button>',
                    mobileFirst: true,
                    responsive: [{
                            breakpoint: 1600,
                            settings: {
                                slidesToShow: 10,
                            }
                        },{
                            breakpoint: 1023,
                            settings: {
                                slidesToShow: 8,
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 5,
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });

                var windowWdith = $(window).width();
                if (windowWdith >= 1024) {
                    var totalthumbSlides = $('#pop-slide-thumb').children().find('.slick-slide').length;
                    if (totalthumbSlides < 9) {
                        $('#pop-slide-thumb .slick-track').addClass('customized-slick-track');
                    }
                }
            }
        });
    }

});