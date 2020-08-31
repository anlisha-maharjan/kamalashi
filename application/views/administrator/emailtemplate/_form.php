<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissable fade in">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>
<form action="" method="post">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="name">Template Name</label>
                <input <?php echo (segment(4) != '') ? 'readonly' : '' ?> type="text" name="name" value="<?php echo $emailtemplate->name ?>" class="form-control" id="name"
                                                                          placeholder="Title">
            </div>
            <div class="form-group">
                <label for="adminEmail">Admin Email</label>
                <input type="text" name="adminEmail" value="<?php echo $emailtemplate->adminEmail ?>"
                       class="form-control" id="adminEmail" placeholder="Admin Email">
            </div>
            <div class="form-group">
                <label for="adminSubject">Admim Subject</label>
                <input type="text" name="adminSubject" value="<?php echo $emailtemplate->adminSubject ?>"
                       class="form-control" id="adminSubject" placeholder="Admim Subject">
            </div>
            <div class="form-group">
                <label for="adminMessage">Admin Message</label>
                <textarea rows="7" name="adminMessage" class="form-control" id="adminMessage"
                          placeholder="Admin Message"><?php echo $emailtemplate->adminMessage ?></textarea>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="userSubject">User Subject</label>
                <input type="text" name="userSubject" value="<?php echo $emailtemplate->userSubject ?>"
                       class="form-control" id="userSubject" placeholder="User Subject">
            </div>
            <div class="form-group">
                <label for="userMessage">User Message</label>
                <textarea rows="7" name="userMessage" class="form-control" id="userMessage"
                          placeholder="User Message"><?php echo $emailtemplate->userMessage ?></textarea>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <button type="submit" class="btn green">Submit</button>
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/' . $this->header['page_name']) ?>"><span>Close</span></a>

            </div>
        </div>
    </div>
    
</form>
<script>
    window.onload = function () {
        load_ckeditor('adminMessage', true);
        load_ckeditor('userMessage', true);
    };
</script>