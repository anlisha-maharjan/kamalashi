$(document).ready(function(){
    $('.parent-check').on('click', function(){
        var parent_id = $(this).val();
        var role = $(this).data('role-type');
        var child_checkbox = $('.'+role+'-'+parent_id);
        checkBoxes($(this), child_checkbox);
    });
    function checkBoxes(element, child_checkbox) {
        if(element.is(':checked'))
            child_checkbox.prop("checked", true);
        else
            child_checkbox.prop("checked", false);
    }
    $('.child-check').on('click', function(){
        var child_id = $(this).val();
        var role = $(this).data('role-type');
        var child_checkbox = $('#permission-'+role+'-'+child_id+' input[type=checkbox]');
        checkBoxes($(this), child_checkbox);
    });

    $('.submit-form').on('click', function(event){
        event.preventDefault();
        $("input[type='submit']").attr('disabled', 'disabled');
        var form = $(this).parents('form:first');
        var url = form.attr('action');
        var data = form.serialize();
        var role_id = $('#role-id').val();
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(res) {
                res = $.parseJSON(res);
                $('.message-'+res.role_id).html(res.message);
                $("input[type=submit]").removeAttr("disabled");
                $('html, body').animate({
                    scrollTop: $('.message-'+res.role_id).offset().top
                }, 1000);
              /*  $(window).scrollTop($('.message-'+res.role_id).offset().top);*/
            }
        })
    })
});