$('#checkin-date').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: new Date()
});

var checkindate = $('#checkin-date').val();
var formatDate = checkindate.replace(/-/g, ',');
var base_url = $('#base-url').val();
$('#checkout-date').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: new Date()
});


$(document).on('click', '.SelectRoom', function (e) {
    e.stopPropagation();
    e.preventDefault();
    var id = $(this).closest("div").find(".accomodation_id").text();
    var quantity = $(this).parents("form").children().find(".select2-selection__rendered").text();
    if (quantity === '' || quantity === null || quantity === 'Select') {
        $(".quantity_error").show();
        $(this).parents("form").children().find(".quantity_error").text('Quantity Required');
        return false;
    } else {
        $(".quantity_error").hide();
        $(this).parents("form").children().find(".quantity_error").text('');
        if (id === '') {
            return false;
        } else {
            var html = '';
            url = base_url + 'page/getAccomodation/' + id;
            $.ajax({
                url: url,
                data: {quantity: quantity},
                cache: false,
                type: 'POST',
                dataType: 'JSON',
                success: function (res) {
                    $('.go').css("display", "block");
                    console.log(res);
                    html += '<div class="rooms-selected">';
                    html += '<input type="hidden" class="roomSlug" name="' + res.slug + '" value="' + res.slug + '" />';
                    html += '<h5><span>' + res.name + '</span><button><img class="img-responsive delete" src="' + base_url + 'assets/front/images/icons/icon-close.png" alt=""></button></h5>';
                    html += '<div class="form-group"><label>Quantity</label><span>' + quantity + '</span></div>';
                    html += '<div class="form-group"><label>Price</label><span>$' + parseInt(quantity * res.price) + '</span></div>';
                    html += '</div>';

                    $('.go').prepend(html);
                }
            });
        }
    }

});

$(document).on('click', '.delete', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $(this).closest('.rooms-selected').remove();
    var slug = $(this).closest('.rooms-selected').find('.roomSlug').val();
    $.ajax({
        url: base_url + 'page/removeAccomodation/' + slug,
        cache: false,
        type: 'POST',
        dataType: 'JSON',
        success: function (res) {
            console.log(res);
        }
    });
    //Remove Cart and Checkout button if there is no data
    var numItems = $('.rooms-selected').length;
    if(numItems === 0){
        $('.go').css("display", "none");
    }
});

$(document).on('click', '#button_checkout', function (e) {
    window.location.href = base_url + 'checkout';
});

$(document).on('click', '#button_cart', function (e) {
    window.location.href = base_url + 'cart';
});