function ContactMap() {
	var myLatLong = { lat: 27.72641558, lng: 85.3681297 };
	map = new google.maps.Map(document.getElementById('map'), {
		center: myLatLong,
		scrollwheel: !0,
		scrollwheel: false,
		zoom: 27,
		styles: [{
			stylers: [{
				hue: "#ffcc01"
			}]
		}]
	});
	var marker = new google.maps.Marker({
		position: myLatLong,
		title: 'Kamalashi Palace',
	});
	marker.setMap(map);

}


var base_url = $('#base-url').val();
$(function () {
	$('#reloadeded').click(function () {
		$('#captcha').attr('src', base_url + 'page/securimage' + '?' + Math.random());
	});
});
$('#reset').click(function () {
	window.location.href = base_url + 'contact';
});

$(document).ready(function () {
	$('.process-wrap').css('display', 'none');
});

/***
 * Checks if a string is a valid email on the www
 * Returns TRUE for "test@example.co"
 * Returns FALSE for "test@localhost"
 ***/
function isValidEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}


function isValidMobile(p) {
	if (p.length === 10) {
		return true;
	} else {
		return false;
	}

}

function isInt(a) {
	if (Math.floor(a) == a && $.isNumeric(a)) {
		return true;
	} else {
		return false;
	}
}


$(document).on('click', '#submit', function (e) {
	e.stopPropagation();
	e.preventDefault();
	form = $('form#contact');
	url = $('form#contact').attr('action');
	var forms = $("form#contact")[0];
	var data = new FormData(forms);

	var name = $("#name").val();
	//var address = $("#address").val();
	//var phone = $("#phone").val();
	var email = $("#email").val();
	var message = $("#message").val();
	//var code = $("#code").val();


	var err = 0;
	function showErrSpan(outputClass, msg) {
		form.find('span.' + outputClass).text(msg).show();
		err = 1;
	}
	if (name === '') {
		showErrSpan('name', '*Please enter your full name');
	}
	//    if (address === '') {
	//        showErrSpan('address', '*Please enter your address');
	//    }
	if (email === '') {
		showErrSpan('email', '*Please enter your email');
	} else if (!isValidEmail(email)) {
		showErrSpan('email', '*Invalid email');
	}
	//    if (phone === '') {
	//        showErrSpan('phone', '*Please enter your number');
	//    } else if (!isInt(phone)) {
	//        showErrSpan('phone', '*Invalid number');
	//    }
	if (message === '') {
		showErrSpan('message', '*Please enter your message');
	}
	//    if (code === '') {
	//        showErrSpan('code', '*Please enter captcha');
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
					swal({
						title: 'Success',
						text: res.msg,
						type: 'success'
					});
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



