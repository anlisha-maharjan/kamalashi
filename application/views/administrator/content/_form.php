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
                <input type="text" name="name" value="<?php echo $content->name ?>" class="form-control" id="name" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="sub_title">Secondary Title</label>
                <input type="text" name="sub_title" value="<?php echo $content->sub_title ?>" class="form-control" id="sub_title" placeholder="Sub Title">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id">
                    <option>Select Category</option>
                    <?php
                    if ($categories) {
                        foreach ($categories as $data) {
                            ?>
                            <option value="<?php echo $data->id ?>" <?php
                            if ($data->id == $content->category_id) {
                                echo 'selected';
                            }
                            ?>><?php echo $data->name ?></option>
                                    <?php
                                }
                            }
                            ?>
                </select>
            </div>


            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" name="link" value="<?php echo $content->link ?>" class="form-control" id="link" placeholder="Link">
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="cover_image" value="<?php echo $content->cover_image ?>" class="form-control" id="cover_image" placeholder="Upload Cover Image">
                <?php if ($content->cover_image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($content->cover_image) ?>" />
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="image" value="<?php echo $content->image ?>" class="form-control" id="image" placeholder="Upload Image">
                <?php if ($content->image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($content->image) ?>" />
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="file">Attach File</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="all" data-multiple="false" name="file" class="form-control" id="file" placeholder="Upload File" value="<?php echo $content->file ?>">

            </div>

            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input class="form-control" type="text" id="publish_date" name="publish_date" value="<?php echo $content->publish_date ?>" placeholder="Publish Date"/>
            </div>
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $content]); ?>
            <div class="form-group">
                <label for="orderNumber">Order Number</label>
                <input type="number" min="0" name="orderNumber" value="<?php echo $content->orderNumber ?>" class="form-control" id="orderNumber" placeholder="Order Number">
            </div>
            <div class="form-group">
                <label for="featured">
                    Featured <input <?php echo (isset($content->featured) && $content->featured == 'Yes') ? 'checked' : ''; ?> type="checkbox" name="featured"/>
                </label>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea rows="7" name="short_description" class="form-control" id="short_description" placeholder="Short Description"><?php echo $content->short_description ?></textarea>
            </div>
            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea rows="7" name="long_description" class="form-control" id="long_description" placeholder="Long Description"><?php echo $content->long_description ?></textarea>
            </div>


        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <?php $this->load->view(BACKENDFOLDER . '/include/save', ['module_data' => $content]); ?>
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