var rows, columns, i, j;
$(document).on("keyup", "input[name=rows]", function() {
    rows = $(this).val();
    $(".headers_input").remove();
    for (i = 0; i < rows; i++) {
        $("#label_headers").after("<input type='text' name='headers[]' class='form-control headers_input'/>");
    }

    $("#table_headers").css("display", "block");
})

$(document).on("keyup", "input[name=columns]", function() {
    columns = $(this).val();
    $(".labels_input").remove();
    for (j = 0; j < columns; j++) {
        $("#label_labels").after("<input type='text' name='labels[]' class='form-control labels_input'/>");
    }

    $("#table_labels").css("display", "block");
})