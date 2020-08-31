CKEDITOR.editorConfig = function( config ) {
    var base_url = document.getElementById('base-url').value;
    config.allowedContent = true;
    config.filebrowserImageBrowseUrl = base_url+'assets/staff/js/vendor/ckfinder/ckfinder.html?type=Images';
    config.uiColor = '#f1f1f1';
};