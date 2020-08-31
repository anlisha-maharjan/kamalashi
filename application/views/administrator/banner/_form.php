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
                <label for="title">Banner Title</label>
                <input type="text" name="title" value="<?php echo $banner->title ?>" class="form-control" id="title" placeholder="Banner Title">
            </div>
            <div class="form-group">
                <label for="subtitle">Sub Title</label>
                <input type="text" name="subtitle" value="<?php echo $banner->subtitle ?>" class="form-control" id="subtitle" placeholder="Sub Title">
            </div>
            <div class="form-group">
                <label for="link">Banner Link</label>
                <input type="text" name="link" value="<?php echo $banner->link ?>" class="form-control" id="link" placeholder="Banner Link">
            </div>
            <div class="form-group">
                <label for="image">Banner Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="image" value="<?php echo $banner->image ?>" class="form-control" id="image" placeholder="Upload Banner Image">
                <?php if($banner->image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($banner->image) ?>" />
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" >
                    <option value="">Select Category</option>
                    <?php if($categories) : ?>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?php echo $category->id ?>" <?php echo ($banner->category_id == $category->id) ? 'selected' : '' ?>>
                                <?php echo $category->name ?>
                            </option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $banner]); ?>
            <div class="form-group">
                <label for="orderNumber">Order Number</label>
                <input type="number" min="0" name="orderNumber" value="<?php echo $banner->orderNumber ?>" class="form-control" id="orderNumber" placeholder="Order Number">
            </div>
            <div class="form-group">
                <label for="description">Banner Description</label>
                <textarea rows="7" name="description" class="form-control" id="description" placeholder="Banner Description"><?php echo $banner->description ?></textarea>
                <script>
                    window.onload = function() {
                        load_ckeditor('description', true)
                    };
                </script>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php $this->load->view(BACKENDFOLDER . '/include/save', ['module_data' => $banner]); ?>
                

            </div>
        </div>
    </div>
</form>