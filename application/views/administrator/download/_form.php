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
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id">
                    <option>Select Category</option>
                    <?php
                    if ($downloadCategories) {
                        foreach ($downloadCategories as $downloadCategory) {
                            ?>
                            <option value="<?php echo $downloadCategory->id ?>" <?php
                            if ($downloadCategory->id == $download->category_id) {
                                echo 'selected';
                            }
                            ?>><?php echo $downloadCategory->name ?></option>
                                    <?php
                                }
                            }
                            ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" name="name" value="<?php echo $download->name ?>" class="form-control" id="name" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input id="file" type="text" onclick="BrowseServer(this)" data-resource-type="all" data-multiple="true" class="form-control" placeholder="Upload File">
            </div>
            <div id="add-downloads">

            </div>

            <?php if (isset($savedMedia)) { ?>
                <?php foreach ($savedMedia as $media) { ?>

                    <div class="mediaWrapper">
                        <div class="form-group">
                            <input type="text" class="form-control" readonly="readonly"
                                   value="<?php echo $media->media ?>" name="file[]"/>
                        </div>
                        <a href="javascript:void(0);" class="deleteMedia"
                           data-url="<?php echo base_url(BACKENDFOLDER . '/download/deleteMedia/' . $media->id) ?>">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input class="form-control" type="text" id="publish_date" name="publish_date"
                       value="<?php echo $download->publish_date ?>" placeholder="Publish Date"/>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option
                        value="Active" <?php echo $download->status == 'Active' || $download->status == '' ? 'selected' : '' ?>>
                        Publish
                    </option>
                    <option value="InActive" <?php echo $download->status == 'InActive' ? 'selected' : '' ?>>UnPublish</option>
                </select>
            </div>
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