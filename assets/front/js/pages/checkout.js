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

$(document).ready(function () {
    $('.process-wrap').css('display', 'none');
});

$('#check_in').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: new Date()
});
$('#check_out').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: new Date()
});

function isValidEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function isInt(a) {
    if (Math.floor(a) == a && $.isNumeric(a)) {
        return true;
    } else {
        return false;
    }
}

$(document).on('click', '#checkout', function (e) {
    e.stopPropagation();
    e.preventDefault();
    form = $('form#customerbooking');
    url = $('form#customerbooking').attr('action');
    var forms = $("form#customerbooking")[0];
    var data = new FormData(forms);

    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var address = $("#address").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var country = $("#country").val();
    var check_in = $("#check_in").val();
    var check_out = $("#check_out").val();
    var agree = $('#agree').is(':checked');
    //var code = $("#code").val();
    var response = grecaptcha.getResponse();
    var err = 0;
    function showErrSpan(outputClass, msg) {
        form.find('span.' + outputClass).text(msg).show();
        err = 1;
    }
    if (firstname === '') {
        showErrSpan('firstname', '*Please enter your firstname');
    }
    if (lastname === '') {
        showErrSpan('lastname', '*Please enter lastname');
    }
    if (address === '') {
        showErrSpan('address', '*Please enter address');
    }
    if (email === '') {
        showErrSpan('email', '*Please enter your email');
    } else if (!isValidEmail(email)) {
        showErrSpan('email', '*Invalid email');
    }
    if (phone === '') {
        showErrSpan('phone', '*Please enter your number');
    } else if (!isInt(phone)) {
        showErrSpan('phone', '*Invalid number');
    }
    if (country === '' || country === null) {
        showErrSpan('country', '*Please select country');
    }
    if (check_in === '') {
        showErrSpan('check_in', '*Please select check-in date');
    }
    if (check_out === '') {
        showErrSpan('check_out', '*Please select check-out date');
    }
    if (agree === false) {
        showErrSpan('agree', '*Please accept our Terms and Conditions');
    }
    if (response.length == 0) {
        showErrSpan('captcha', 'Captcha Not verified');
    }
    
//    if (code === '') {
//        showErrSpan('code', '*Please enter security code');
//    }


    if (err === 1) {
        $('html, body').animate({
            scrollTop: $('.error').offset().top - 100
        }, 700);
        return false;

    } else {
        $('.process-wrap').css('display', 'block');
        $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'JSON',
            success: function (res) {
                $(".process-wrap").css('display', 'none');
                if (res.action == 'success') {
                    window.location.href = base_url + 'booking-confirmed';
                    /*swal({
                     title: 'Success',
                     text: res.msg,
                     type: 'success'
                     });*/
                } else {
                    //$('#captcha').attr('src', base_url + 'page/securimage' + '?' + Math.random());
                    swal({
                        title: 'Alert',
                        text: res.msg,
                        type: 'error'
                    });

                }

                if (res.action != 'error') {
                    forms.reset();
                }
            }
        });
    }
});
$('body').on('click', 'span.error', function () {
    $(this).hide().prev('input').focus();
});
$('body').on('focus', 'input', function () {
    $(this).next('span.error').hide();
});
$('body').on('focus', 'textarea', function () {
    $(this).next('span.error').hide();
});
$('.form-control').change(function () {
    $(this).siblings('span.error').hide();
});
$("#agree").change(function () {
    if (this.checked) {

    } else {

    }
});