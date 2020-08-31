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
                <label for="name">Category Name</label>
                <input type="text" name="name" value="<?php echo $category->name ?>" class="form-control" id="name" placeholder="Category Name">
            </div>
            <div class="form-group">
                <label for="subtitle">Category Subtitle</label>
                <input type="text" name="subtitle" value="<?php echo $category->subtitle ?>" class="form-control" id="subtitle" placeholder="Category Subtitle">
            </div>
            <div class="form-group">
                <label for="type">Category Type</label>
                <select name="type" id="type" class="form-control">
                    <?php foreach($categoryType as $cType) { ?>
                        <option value="<?php echo $cType->id ?>" <?php echo $category->type == $cType->id ? 'selected' : '' ?>>
                            <?php echo $cType->name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            
            <div class="form-group">
                <label for="icons">Category Icon</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="icon" value="<?php echo $category->icon ?>" class="form-control" id="icon" placeholder="Upload Category Icon">
                <?php if($category->icon != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($category->icon) ?>" />
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" <?php echo $category->status == 'Active' || $category->status == '' ? 'selected' : '' ?>>Publish</option>
                    <option value="0" <?php echo $category->status == 'InActive' ? 'selected' : '' ?>>UnPublish</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <input type="submit" class="btn green" value="Save" name="only_save">
                <input type="submit" class="btn green" value="Save and New" name="save_new">
                <button type="submit" class="btn green">Save and Exit</button>
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/'. $this->header['page_name']) ?>"><span>Close</span></a>
            </div>
        </div>
    </div>
    
</form>