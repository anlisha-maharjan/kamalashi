function BrowseServer(element) {
    var selectMultiple = $(element).data('multiple'),
    mime = $(element).data('resource-type'),
    showDetail = ($(element).data('show-detail')) ? $(element).data('show-detail') : false,
    elementId = $(element).attr('id'),
    baseUrl = $('#base-url').val(),
    fileMime = '';
    
    if (mime == 'all') {
        fileMime = [];
    } else {
        fileMime = [mime];
    }

    $('<div id="editor"/>').dialogelfinder({
        url: baseUrl + 'assets/administrator/js/vendor/elFinder/php/connector.php',
        width: '80%',
        onlyMimes: fileMime,
        height: '600px',
        commandsOptions: {
            getfile: {
                onlyURL: false,
                multiple: selectMultiple,
                folders: false,
                oncomplete: 'destroy'
            }
        },
        getFileCallback: function (file) {
            var mediaWrapperClass = 'mediaWrapper';
            if (selectMultiple) {
                var filePath = selectMultipleFiles(file); //file contains the relative url.
            } else {
                mediaWrapperClass = 'mediaWrapper image-wrapper';
                var filePath = [file.path.replace(/\\/g, '/')];
            }
            $('#' + elementId).val(filePath.join(','));
            $.each(filePath, function (key, value) {
                if (showDetail) {
                    var message = "<div class='" + mediaWrapperClass + "'>" +
                        "<div class='row'>" +
                        "<div class='col-md-4'>" +
                        "<img class='img-responsive' src='" + baseUrl + value + "'/>" +
                        "</div>" +
                        "<div class='col-md-8'>" +
                        "<div class='form-group'>" +
                        "<input type='text' class='form-control' name='media[]' value='" + value + "'readonly='readonly'/>" +
                        "</div>" +
                        "<div class='form-group'>" +
                        "<input type='text' class='form-control' name='title[]' placeholder='Title'/>" +
                        "</div>" +
                        "<div class='form-group'>" +
                        "<textarea name='description[]' class='form-control' placeholder='Description'></textarea>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "<a href='javascript:void(0)' class='cancel' title='Click To Cancel'>" +
                        "Cancel</a>" +
                        "</div>";
                } else if (elementId == 'file') {
                    var message ="<div class='mediaWrapper'>"+
                        "<div class='form-group'>" +
                        "<input type='text' class='form-control' name='file[]' value='" + value + "'readonly='readonly'/>" +
                        "</div>" +
                        "<a href='javascript:void(0)' class='cancel' title='Click To Cancel'>" +
                        "Cancel</a></div>";
                } else {
                    if (mime == 'image') {
                        var message = "<div class='image-wrapper'>" +
                            "<img class='img-responsive' src='" + baseUrl + value + "'/>" +
                            "<a href='javascript:void(0)' class='delete' title='Click To Delete'>" +
                            "Delete</a></div>";
                    }
                }
                if (elementId == 'file') {
                    $('#add-downloads').append(message);//add the file to a div so you can see the selected
                } else {
                    $('#' + elementId).parents('.form-group').append(message); //add the image to a div so you can see the selected images
                }
            });
        }
    });
}

function selectMultipleFiles(url) {
    var joinedFilePath = [];
    $.each(url, function (key, value) {
        joinedFilePath.push(value.path.replace(/\\/g, '/'));
    });
    return joinedFilePath;
}

function BrowseServer1(element) {
    var resourceType = $(element).data('resource-type');
    var selectMultiple = $(element).data('multiple');
    var elementId = $(element).attr('id');

    // You can use the "CKFinder" class to render CKFinder in a page:
    var finder = new CKFinder();

    // Type of the resource
    finder.resourceType = resourceType;

    // Select Multiple
    finder.selectMultiple = selectMultiple;

    // Name of a function which is called when a file is selected in CKFinder.
    finder.selectActionFunction = SetFileFieldSingle;
    if (selectMultiple) {
        finder.selectActionFunction = SetFileFieldMultiple;
    }

    // Additional data to be passed to the selectActionFunction in a second argument.
    // We'll use this feature to pass the Id of a field that will be updated.
    finder.selectActionData = elementId;

    // Launch CKFinder
    finder.popup();
}

