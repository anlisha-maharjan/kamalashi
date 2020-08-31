$('.status').on('change', function () {
    var that = $(this);
    var base_url = $('#base-url').val();
    var status = $(this).val();
    var id = that.parents('td').find('.id').val();
    window.location = base_url + 'administrator/booking/status/' + status + '/' + id;
});

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
var tax = (subtotal * 1) / 100;
var grand_total = parseInt(tax) + parseInt(subtotal);
$('#grand_total').text('$' + grand_total);