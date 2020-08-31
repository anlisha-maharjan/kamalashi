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
                <label for="name"> Name</label>
                <input type="text" name="name" value="<?php echo $accomodation->name ?>" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="name"> SubTitle</label>
                <input type="text" name="subtitle" value="<?php echo $accomodation->subtitle ?>" class="form-control" id="subtitle" placeholder="SubTitle">
            </div>
            <div class="form-group">
                <label for="capacity"> Capacity</label>
                <input type="text" name="capacity" value="<?php echo $accomodation->capacity ?>" class="form-control" id="capacity" placeholder="Capacity">
            </div>
            <div class="form-group">
                <label for="price"> Price</label>
                <input type="text" name="price" value="<?php echo $accomodation->price ?>" class="form-control" id="price" placeholder="Price">
            </div>
            <div class="form-group">
                <label for="total_count"> Total Room Count</label>
                <input type="text" name="total_count" value="<?php echo $accomodation->total_count ?>" class="form-control" id="total_count" placeholder="Total Count">
            </div>
            <div class="form-group">
                <label for="max_child"> Max Child</label>
                <input type="text" name="max_child" value="<?php echo $accomodation->max_child ?>" class="form-control" id="max_child" placeholder="Max Child">
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" class="form-control" id="short_description" placeholder="Short Description"><?php echo $accomodation->short_description ?></textarea>
            </div>
            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea name="long_description" class="form-control" id="long_description" placeholder="Long Description"><?php echo $accomodation->long_description ?></textarea>
            </div>


        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" >
                    <option value="">Select Category</option>
                    <?php if ($categories) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category->id ?>" <?php echo ($accomodation->category_id == $category->id) ? 'selected' : '' ?>>
                                <?php echo $category->name ?>
                            </option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="form-group" id="selectImages">
                <label for="cover_image">Cover Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="cover_image" value="<?php echo $accomodation->cover_image ?>" class="form-control" id="cover_image" placeholder="Cover Image">
            </div>
            <?php if ($accomodation->cover_image != '') { ?>
                <img src="<?php echo base_url($accomodation->cover_image) ?>" width="20%"/>
            <?php } ?>
            <div class="form-group">
                <label for="image">Images</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="true" name="image" data-show-detail="true" class="form-control" id="image" placeholder="Images">
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
                           data-url="<?php echo base_url(BACKENDFOLDER . '/accomodation/deleteMedia/' . $media->id) ?>">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>


            <div class="form-group">
                <label for="orderNumber">Order Number</label>
                <input type="number" min="0" name="orderNumber" value="<?php echo $accomodation->orderNumber ?>" class="form-control" id="orderNumber" placeholder="Order Number">
            </div>  
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $accomodation]); ?>

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
        load_ckeditor('short_description', true),
                load_ckeditor('long_description', true)
    };
</script>
