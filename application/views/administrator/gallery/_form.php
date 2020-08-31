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
                <label for="name">Gallery Name</label>
                <input type="text" name="name" value="<?php echo $gallery->name ?>" class="form-control" id="name"
                       placeholder="Gallery Name">
            </div>
            <div class="form-group">
                <label for="short_description">Gallery Short Description</label>
                <textarea name="short_description" class="form-control" id="short_description"
                          placeholder="Short Description"><?php echo $gallery->short_description ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Images</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="true" name="image" data-show-detail="true" class="form-control" id="image" placeholder="Upload Images">
            </div>

            <?php if (isset($savedMedia)) { ?>
                <?php foreach ($savedMedia as $media) { ?>
                    <div class="mediaWrapper">

                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-responsive" src="<?php echo base_url($media->media) ?>"/>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" readonly="readonly"
                                           value="<?php echo $media->media ?>" name="media[]"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Title"
                                           value="<?php echo $media->title ?>" name="title[]"/>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Description"
                                              name="description[]"><?php echo $media->caption ?></textarea>
                                </div>
                            </div>
                        </div>

                        <a href="javascript:void(0);" class="deleteMedia"
                           data-url="<?php echo base_url(BACKENDFOLDER . '/gallery/deleteMedia/' . $media->id) ?>">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group" id="selectImages">
                <label for="cover">Cover Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false"
                       name="cover" value="<?php echo $gallery->cover ?>" class="form-control" id="cover"
                       placeholder="Upload Cover Image">
            </div>
            <?php if ($gallery->cover != '') { ?>
                <img src="<?php echo base_url($gallery->cover) ?>" width="20%"/>
            <?php } ?>

            <div class="form-group">
                <label for="orderNumber">Order Number</label>
                <input type="number" min="0" name="orderNumber" value="<?php echo $gallery->orderNumber ?>" class="form-control" id="orderNumber" placeholder="Order Number">
            </div>    
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $gallery]); ?>

        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <button type="submit" class="btn green">Save</button>
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/' . $this->header['page_name']) ?>"><span>Cancel</span></a>

            </div>
        </div>
    </div>

</form>
<script>
    window.onload = function () {
        load_ckeditor('short_description', true)
    };
</script>
