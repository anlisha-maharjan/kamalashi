/**
 * Created by satish on 12/3/2015.
 */

(function () {
    'use strict';

    var mediaTypeSelect = $('.mediaTypeSelect'),
        selectVideos = $('#selectVideos'),
        selectImages = $('#selectImages');

    mediaTypeSelect.on('click', function () {
        var that = $(this),
            selectedMedia = that.val();

        if (selectedMedia == 'video') {
            selectImages.hide();
            selectVideos.show();
        } else {
            selectVideos.hide();
            selectImages.show();
        }
    });

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

    $('.add-videos').on('click', function (e) {
        e.preventDefault();
        var that =$(this);
        var fields ='<div class="form-group">'+
            '<input type="text" name="media[]" class="form-control" placeholder="Videos"></div>'+
            '<div class="form-group">'+
            '<input class="form-control" placeholder="Title" name="title[]"/></div>'+
            '<div class="form-group">'+
            '<textarea class="form-control" placeholder="Description" name="description[]">'+
            '</textarea> </div>';
        $('#selectVideos').append(fields);

    });
})();
