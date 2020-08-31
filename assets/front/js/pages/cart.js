var subtotal = '0';
var base_url = $('#base-url').val();
$("tbody").find("tr").each(function () {
    var price = $(this).find('td.price').text().replace('$', '');
    if (price) {
        subtotal = parseInt(subtotal) + parseInt(price);
    }
});
$('#sub_total').text('$' + subtotal);

//Find Total with Tax
var tax = (subtotal * 1)/100;
var grand_total = parseInt(tax) + parseInt(subtotal);
$('#grand_total').text('$' + grand_total);

$(document).on('click', '.delete', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $(this).closest('.cart').remove();
    var sub_total = '0';
    $("tbody").find("tr").each(function () {
        var price = $(this).find('td.price').text().replace('$', '');
        if (price) {
            sub_total = parseInt(sub_total) + parseInt(price);
        }
    });
    $('#sub_total').text('$' + sub_total);
    //Remove from session
    var slug = $(this).closest('.cart').find('.roomSlug').val();
    $.ajax({
        url: base_url + 'page/removeAccomodation/' + slug,
        cache: false,
        type: 'POST',
        dataType: 'JSON',
        success: function (res) {
            console.log(res);
        }
    });

    //Remove Proceed button if there is no data
    var numItems = $('.cart').length;
    if (numItems === 0) {
        $('#button_proceed').css("display", "none");
        $('.empty_cart').css("display", "block");
        $('#cart_table').css("display", "none");
    }
});

$(document).on('click', '#button_proceed', function (e) {
    window.location.href = base_url + 'checkout';
});