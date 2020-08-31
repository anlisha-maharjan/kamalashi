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
                <label for="name">Title</label>
                <input type="text" name="name" value="<?php echo $event->name ?>" class="form-control" id="name" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="sub_title">Sub Title</label>
                <input type="text" name="sub_title" value="<?php echo $event->sub_title ?>" class="form-control" id="sub_title" placeholder="Sub Title">
            </div>
            <div class="form-group">
                <label for="thumb_image">Thumb Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="thumb_image" value="<?php echo $event->thumb_image ?>" class="form-control" id="thumb_image" placeholder="Upload Thumb Image">
                <?php if ($event->thumb_image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($event->thumb_image) ?>"/>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="cover_image" value="<?php echo $event->cover_image ?>" class="form-control" id="cocver_image" placeholder="Upload Cover Image">
                <?php if ($event->cover_image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($event->cover_image) ?>"/>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="file">Attach File</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="all" data-multiple="false" name="file" class="form-control" id="File" placeholder="Upload File">
                <?php
                if (isset($event_files) && $event_files) {
                    foreach ($event_files as $key => $event_file) {
                        echo "<a href='" . base_url($event_file->media) . "'>File " . ($key + 1) . "</a><a href='" . base_url(BACKENDFOLDER . '/event/delete_file/' . $event_file->id . '/' . $event->id) . "'><i class='fa fa-trash'></i></a>";
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea rows="7" name="long_description" class="form-control" id="long_description" placeholder="Long Description"><?php echo $event->long_description ?></textarea>
            </div>
        </div>
        <div class = "col-lg-6 col-md-6" >
            <div class = "form-group" style = "display:none">
                <label for = "start_date" > Start Date </label>
                <input class = "form-control" type = "text" id = "start_date" name = "start_date" value = "<?php echo $event->start_date ?>" placeholder = "Start Date" <?php echo isset($path) ? 'readonly' : '' ?> />
            </div>
            <div class = "form-group"  style = "display:none" >
                <label for = "end_date" > End Date </label>
                <input class = "form-control" type = "text" id = "end_date" name = "end_date"
                       value = "<?php echo $event->end_date ?>" placeholder = "End Date" />
            </div>
            <div class = "form-group" >
                <label for = "publish_date" > Publish Date </label>
                <input class = "form-control" type = "text" id = "publish_date" name = "publish_date" value = "<?php echo $event->publish_date ?>" placeholder = "Publish Date" />
            </div>
            <div class = "form-group" >
                <label for = "short_description" > Short Description </label>
                <textarea rows = "7" name = "short_description" class = "form-control" id = "short_description" placeholder = "Short Description" ><?php echo $event->short_description ?> </textarea>

            </div>

            <div class = "form-group" >
                <label for = "category_id" > Category </label>
                <select name = "category_id" id = "category_id" class = "form-control" >
                    <option value = "" > Select Category </option>
                    <?php if ($eventCategory) : ?>
                        <?php foreach ($eventCategory as $category) : ?>
                            <option value = "<?php echo $category->id ?>"<?php echo ($event->category_id == $category->id) ? 'selected' : '' ?> ><?php echo $category->name ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $event]); ?>
            <div class = "form-group" >
                <label for = "orderNumber" > Order Number </label>
                <input type = "number" min = "0" name = "orderNumber" value = "<?php echo $event->orderNumber ?>" class = "form-control" id = "orderNumber" placeholder = "Order Number" >
            </div>

            <div class = "form-group" >
                <label for = "featured" >
                    Featured <input <?php echo (isset($event->featured) && $event->featured == 'Yes') ? 'checked' : '' ?> type = "checkbox" id = "featured" name = "featured" />
                </label>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <button type = "submit" class = "btn green" > Save </button>
                <a class = "btn default" href = "<?php echo base_url(BACKENDFOLDER . '/' . $this->header['page_name']) ?>" > <span> Cancel </span></a>

            </div>
        </div>
    </div>

</form>

<script >
    window.onload = function () {
        load_ckeditor('short_description', true);
        load_ckeditor('long_description');
    };
</script>