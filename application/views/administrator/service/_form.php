<?php if(validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissable fade in">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>
<form action="" method="post">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            
            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" name="name" value="<?php echo $service->name ?>" class="form-control" id="name" placeholder="Service Name">
            </div>
            
            
            <div class="form-group">
                <label for="link">Service Link</label>
                <input type="text" name="link" value="<?php echo $service->link ?>" class="form-control" id="link" placeholder="Service Link">
            </div>
            
            <div class="form-group">
                <label for="short_description">Service Short Description</label>
                <textarea rows="7" name="short_description" class="form-control" id="short_description" placeholder="Service Short Description"><?php echo $service->short_description ?></textarea>
            </div>
            <div class="form-group">
                <label for="description">Service Detail</label>
                <textarea rows="7" name="description" class="form-control" id="description" placeholder="Service Description"><?php echo $service->description ?></textarea>
            </div>
            
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="image">Service Image </label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="image" value="<?php echo $service->image ?>" class="form-control" id="image" placeholder="Upload Images">
                <?php if($service->image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($service->image) ?>" />
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="icon">Service Icon </label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="icon" value="<?php echo $service->icon ?>" class="form-control" id="icon" placeholder="Upload Icon">
                <?php if($service->icon != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($service->icon) ?>" />
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
            
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $service]); ?>
            
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                    <?php if($categories) : ?>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?php echo $category->id ?>" <?php echo ($service->category_id == $category->id) ? 'selected' : '' ?>>
                                <?php echo $category->name ?>
                            </option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>

           
            <div class="form-group">
                <label for="orderNumber">Order Number</label>
                <input type="number" min="0" name="orderNumber" value="<?php echo $service->orderNumber ?>" class="form-control" id="orderNumber" placeholder="Order Number">
            </div>
            <div class="form-group">
                <label for="featured">
                    Featured <input <?php echo (isset($service->featured) && $service->featured == 'Yes') ? 'checked' : '' ?> type="checkbox" id="featured" name="featured"/>
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
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/'. $this->header['page_name']) ?>"><span>Close</span></a>
            </div>
        </div>
    </div>
</form>
<script>
    window.onload = function() {
        load_ckeditor('description');
        load_ckeditor('short_description');
    };
</script>