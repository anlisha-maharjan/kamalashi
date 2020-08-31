<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissable fade in">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>
<form action="" method="post">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group" >
                <label for="name">Title</label>
                <input type="text" name="name" value="<?php echo $notice->name ?>" class="form-control" id="name" placeholder="Title">
            </div>
            <div class="form-group" >
                <label for="sub_title">Sub Title</label>
                <input type="text" name="sub_title" value="<?php echo $notice->sub_title ?>" class="form-control" id="sub_title" placeholder="Sub Title">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                    <?php if ($categories) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category->id ?>" <?php echo ($notice->category_id == $category->id) ? 'selected' : '' ?>>
                                <?php echo $category->name ?>
                            </option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <?php /* <div class="form-group">
              <label for="cover_image">Cover Image</label>
              <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="cover_image" value="<?php echo $notice->cover_image ?>" class="form-control" id="ocver_image" placeholder="Cover Image">
              <?php if($notice->cover_image != '') { ?>
              <div class="image-wrapper">
              <img class="img-responsive" src="<?php echo base_url($notice->cover_image) ?>" />
              </div>
              <?php } ?>
              </div>
              <div class="form-group">
              <label for="image">Image</label>
              <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="image" value="<?php echo $notice->image ?>" class="form-control" id="image" placeholder="Image">
              <?php if($notice->image != '') { ?>
              <div class="image-wrapper">
              <img class="img-responsive" src="<?php echo base_url($notice->image) ?>" />
              </div>
              <?php } ?>
              </div> */ ?>
            <div class="form-group">
                <label for="file">Attach File</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="all" data-multiple="false" name="file" class="form-control" id="File" placeholder="Upload File">
                <?php
                if (isset($notice_files) && $notice_files) {
                    foreach ($notice_files as $key => $notice_file) {
                        echo "<a href='" . base_url($notice_file->media) . "'>File " . ($key + 1) . "</a><a href='" . base_url(BACKENDFOLDER . '/notice/delete_file/' . $notice_file->id . '/' . $notice->id) . "'><i class='fa fa-trash'></i></a>";
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea rows="7" name="long_description" class="form-control" id="long_description" placeholder="Long Description"><?php echo $notice->long_description ?></textarea>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="notice_publish_date">Publish Date</label>
                <input class="form-control" type="text" id="notice_publish_date" name="publish_date" value="<?php echo $notice->publish_date ?>" placeholder="Publish Date"/>
            </div>
            <div class="form-group">
                <label for="notice_expiry_date">Expiry Date</label>
                <input class="form-control" type="text" id="notice_expiry_date" name="expiry_date" value="<?php
                if ($notice->expiry_date != '0000-00-00') {
                    echo $notice->expiry_date;
                } else {
                    echo '';
                }
                ?>" placeholder="Expiry Date"/>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea rows="7" name="short_description" class="form-control" id="short_description" placeholder="Short Description"><?php echo $notice->short_description ?></textarea>
            </div>
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $notice]); ?>
            <div class = "form-group" >
                <label for = "orderNumber" > Order Number </label>
                <input type = "number" min = "0" name = "orderNumber" value = "<?php echo $notice->orderNumber ?>" class = "form-control" id = "orderNumber" placeholder = "Order Number" >
            </div>

            <div class = "form-group" >
                <label for = "featured" >
                    Featured <input <?php echo (isset($notice->featured) && $notice->featured == 'Yes') ? 'checked' : '' ?> type = "checkbox" id = "featured" name = "featured" />
                </label>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <input type="submit" class="btn green" value="Save" name="only_save">
                <input type="submit" class="btn green" value="Save and New" name="save_new">
                <button type="submit" class="btn green">Save and Exit</button>
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/' . $this->header['page_name']) ?>"><span>Cancel</span></a>
            </div>
        </div>
    </div>

</form>
<script>
    window.onload = function () {
        load_ckeditor('short_description', true);
        load_ckeditor('long_description');
    };
</script>