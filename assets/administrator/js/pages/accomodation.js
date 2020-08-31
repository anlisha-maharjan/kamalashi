$('.deleteMedia').on('click', function (e) {
    e.preventDefault();
    var that = $(this);
    $.ajax({
        url: that.data('url'),
        success: function (res) {
            if (res)
                that.parents('.mediaWrapper')
                        .fadeOut('slow', function () {
                            $(this).remove();
                        });
        }
    });
});

