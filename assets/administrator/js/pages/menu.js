(function () {
    "use strict";

    var menuLinkType = $("#menu-link-type");
    var base_url = $('#base-url').val();
    menuLinkType.off("change");
    menuLinkType.on("change", function () {
        $("#menu-content, #menu-url").hide();
        var menuType = $(this).val();
        $("#menu-" + menuType).show();
    });

    menuLinkType.trigger("change");

    $("#edit_menu_alias").click(function () {
        $("#alias").attr("readonly", false);
    });


//    $('#menu_type').change(function () {
//        
//        var menutype = $('#menu_type option:selected').val();
//
//        $.ajax({
//            url: base_url + 'staff/menu/getParentMenu',
//            type: 'POST',
//            data: {menutype: menutype},
//            dataType: 'json',
//            success: function (response) {
//                $('#menu_parent').empty();
//                $.each(response, function (index, element) {
//                    $('#menu_parent').append($("<option>").val(element.id).html(element.menu_title));// appened for select 2 
//
//                });
//            },
//            error: function () {
//            }
//        });
//    });
})();








