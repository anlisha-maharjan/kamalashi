
var base_url = $('#base-url').val();
var admin_base_url = $('#admin-base-url').val();
var admin_module = $('#admin-module').val();
var backend_folder = $('#backend_folder').val();
$(function () {
    var table = $('.list-datatable').DataTable({
        "bPaginate": true,
        "pageLength": 20,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "columnDefs": [ { "targets": 1, "orderable": false } ]
    });
    // Setup - add a text input to each footer cell
    $('#table-search-row th').each(function () {
        var title = $(this).text();
        if (title != '')
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        else
            $(this).html(' ');
    });
    // Apply the search
    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });

    if($('.activity-log-datatable').length) {
        var activityLogTable = $('.activity-log-datatable').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            "bFilter" : false,
            "sAjaxSource": admin_base_url + "/activitylog/get_activity_logs",
            "aoColumnDefs": [{
                "mData": '0',
                "aTargets": [0],
                "bSortable": false,
                "bSearchable": false
            }, {
                "mData": '1',
                "aTargets": [1],
                "bSortable": true,
                "bSearchable": true
            }, {
                "mData": '2',
                "aTargets": [2],
                "bSortable": true,
                "bSearchable": true
            }, {
                "mData": '3',
                "aTargets": [3],
                "bSortable": true,
                "bSearchable": true
            }, {
                "mData": '4',
                "aTargets": [4],
                "bSortable": true,
                "bSearchable": true
            }]
        })
        // Apply the search
        activityLogTable.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    }

    if($('.admin-log-datatable').length) {
        var adminLogTable = $('.admin-log-datatable').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            "bFilter" : false,
            "sAjaxSource": admin_base_url + "/adminlog/get_admin_logs",
            "aoColumnDefs": [{
                "mData": '0',
                "aTargets": [0],
                "bSortable": false,
                "bSearchable": false
            }, {
                "mData": '1',
                "aTargets": [1],
                "bSortable": true,
                "bSearchable": true
            }, {
                "mData": '2',
                "aTargets": [2],
                "bSortable": true,
                "bSearchable": true
            }, {
                "mData": '3',
                "aTargets": [3],
                "bSortable": true,
                "bSearchable": true
            }]
        })
        // Apply the search
        adminLogTable.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    }

    
    var elf = $('#media-manager').elfinder({
        url: base_url + 'assets/administrator/js/vendor/elFinder/php/connector.php', // connector URL (REQUIRED)
        lang: 'en' // language (OPTIONAL)
    }).elfinder('instance');

});
function load_ckeditor(textarea, customConfig) {
    if (customConfig) {
        configFile = base_url + 'assets/administrator/js/vendor/ckeditor/custom/minimal.js';
    } else {
        configFile = base_url + 'assets/administrator/js/vendor/ckeditor/custom/full.js';
    }

    CKEDITOR.replace(textarea, {
        customConfig: configFile,
        on: {
            instanceReady: function() {
                this.dataProcessor.htmlFilter.addRules( {
                    elements: {
                        img: function( el ) {
                            // Add an attribute.
                            /*if ( !el.attributes.alt )
                                el.attributes.alt = 'An image';*/

                            // Add some class.
                            el.addClass( 'img-responsive' );
                        }
                    }
                } );
            }
        }
    });
}


$(document).on("keyup", ".title", function () {
    var txtValue = $(this).val();
    var newValue = txtValue.toLowerCase().replace(/[~!@#$%\^\&\*\(\)\+=|'"|\?\/;:.,<>\-\\\s]+/gi, '-');
    $('.alias').val(newValue);
});

$('body').on('click', '.cancel', function (e) {
    e.preventDefault();
    var that = $(this);
    that.parents('.mediaWrapper')
        .fadeOut('slow', function () {
            $(this).remove();
        });
});

(function () {
    
    /* select all checkbox for listing page starts */
    $('.selectAll').change(function () {
        var set = ".rowCheckBox";
        var checked = $(this).is(":checked");
        $(set).each(function () {
            if (checked) {
                $(this).attr("checked", true);
            } else {
                $(this).attr("checked", false);
            }
        });
    });
    /* select all checkbox for listing page starts */

    /* multi-delete starts */
    $("#deleteIcon").click(function () {
        var checked = parseInt($(".rowCheckBox:checked").length);

        if (checked == 1) {
            if (confirm("Are you sure to delete data?")) {
                var url = $(this).attr('rel') + '/' + $(".rowCheckBox:checked:first").val();
                window.location = url;
            }
        }
        else if (checked > 1) {
            if (confirm("Are you sure to delete data?")) {
                $('#gridForm').attr('method', 'post');
                $("#gridForm").attr("action", $(this).attr('rel'));
                $("#gridForm").submit();
            }
        } else {
            alert("Please Select Some Items To Delete");
        }
        return false;
    })
    /* multi-delete ends */

    /* multi-change-status starts */
    $("#activeIcon, #inactiveIcon").click(function () {
        var checked = parseInt($(".rowCheckBox:checked").length);
        if (checked == 1) {
            if (confirm("Are you sure to change status of data?")) {
                var url = $(this).attr('rel') + '/' + $(".rowCheckBox:checked:first").val();
                window.location = url;
            }
        }else if (checked > 1) {
            if (confirm("Are you sure to change status of data?")) {
                $('#gridForm').attr('method', 'post');
                $("#gridForm").attr("action", $(this).attr('rel'));
                $("#gridForm").submit();
            }
        } else {
            alert("Please Select Some Items To Change Status of");
        }
        return false;
    })
    /* multi-change-status ends */
   
    
    /* send mail starts */
    $(".mailIcon").click(function() {
        var checked = parseInt($(".rowCheckBox:checked").length);

        if(checked > 0) {
            $('#gridForm').attr('method', 'post');
            $("#gridForm").attr("action", $(this).attr('rel'));
            $("#gridForm").submit();
        } else {
            alert("Please Select Some Items First");
        }
        return false;
    })
    /* send mail end */
    $('.send-email').on('click',
        function (e) {
            var $this = $(this);

            $('#message-modal').remove();
            e.preventDefault();
            var $remote = $this.attr('href')
                , $modal = $('<div class="modal" id="message-modal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({backdrop: 'static', keyboard: false});
            $modal.load($remote);
        }
    );
    $('.view-detail').on('click',
        function (e) {
            var $this = $(this);

            $('#message-modal').remove();
            e.preventDefault();
            var $remote = $this.attr('href')
                , $modal = $('<div class="modal" id="message-modal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal({backdrop: 'static', keyboard: false});
            $modal.load($remote);
        }
    );
    $('.status').on('change', function () {
        var that = $(this);
        var baseUrl = $('#base-url').val();
        var data = $('#data').val();
        var page = $('#page').val();
        var backendfolder = $('#backendfolder').val();
        var status = $(this).val();
        var id = that.parents('td').find('.id').val();
        window.location = baseUrl + backendfolder + '/' + data + '/status/' + page + '/' + status + '/' + id;

    })
})();

$(document).ready(function () {
    
    /* permission button for role starts */
    $(".permissionIcon").click(function() {
        var checked = parseInt($(".rowCheckBox:checked").length);

        if(checked > 0) {
            if(checked > 1) {
                alert("You have selected more than 1 item");
                var excessCount = false;
            } else {
                var excessCount = true;
            }

            if($(".rowCheckBox:checked:first").val() == '1') {
                alert("You can\'t set permission for Super Administrator");
                var excessCount = false;
            }

            if(excessCount) {
                var url = base_url + backend_folder + "/rolemodule/index/" + $(".rowCheckBox:checked:first").val();
                window.location = url;
            }

        } else {
            alert('Please Select Some Items First');
        }
        return false;
    })
    /* permission button for role ends */

    /* select2 initialization */
    if($('#module_link').length) {
        $('#module_link').select2({
            placeholder: 'Select modules',
            width: 'resolve'
        });
    }
    
    
});
$('a').on('click', function() {
    var href = $(this).attr('href');
    if(href.indexOf('http') > -1) {
        showLoader();
        $( document ).ajaxComplete(function() {
            hideLoader();
        });
    }
});
$(document).ready(function() {
    $("#module-sortable-data").sortable({
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            var segment = window.location.pathname.split( '/' );
            segment = segment[3];
            var page_id = $('#page-id').val();
            // POST to server using $.post or $.ajax
            $.ajax({
                data: data,
                type: 'POST',
                url: admin_base_url + '/'+segment+'/sort/' + page_id,
                success: function () {
                    $('#msg').remove();
                    $("#module-sortable-data").prepend('<span id="msg"></span>');
                    $('#msg').html('Order Updated')
                }
            });
        }
    });

    
    $('body').on('click', '.delete', function(e) {
        e.preventDefault();
        var that = $(this);
        that.parents('.image-wrapper')
            .fadeOut('slow', function () {
                $(this).remove();
            });
        var value = that.parents('.image-wrapper').prev( );
        $(value).attr('value','');

    });
   
    // offer datepicker
    if($('#expiry_date').length) {
        $('#expiry_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: 'today'
        });
    }

    
    
    $('#servicetype').change(function() {
        if (this.value == 'external') {
            $('#service-link').toggle();
            if($('#description-link').is(':visible')){
                $('#description-link').toggle();
            }
        } else if (this.value == 'description') {
            $('#description-link').toggle();
            if($('#service-link').is(':visible')){
                $('#service-link').toggle();
            }
        }
    });

    

    if($('#publish_date').length) {
        $('#publish_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    }

    if($('#notice_publish_date').length) {
        $('#notice_publish_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true        });
    }


    if($('#notice_expiry_date').length) {
        $('#notice_expiry_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: 'today'
        });
    }

});
function showLoader() {
    //$('#loader-container').show();
}

function hideLoader() {
    $('#loader-container').hide();
}
if($('#user-register').length) {
    $('#user-register').validate({
        rules: {
            password:{
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            confirm_password: {
                equalTo: 'Confirmation password doesn\'t match.'
            }
        }
    });
}
