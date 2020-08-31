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
                <label for="title">Advertisement Name</label>
                <input type="text" name="name" value="<?php echo $advertisement->name ?>" class="form-control" id="name" placeholder="Advertisement Name">
            </div>
            <div class="form-group">
                <label for="image">Advertisement Image</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="image" value="<?php echo $advertisement->image ?>" class="form-control" id="image" placeholder="Advertisement Image">
                <?php if ($advertisement->image != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($advertisement->image) ?>" width="20%"/>
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="title">Advertisement Link</label>
                <input type="text" name="link" value="<?php echo $advertisement->link ?>" class="form-control" placeholder="Advertisement Link">
            </div>
            <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $advertisement]); ?>
            <div class="form-group">
                <label for="is_default">
                    Is Default <input <?php echo (isset($advertisement->is_default) && $advertisement->is_default == 'Yes') ? 'checked' : '' ?> type="checkbox" name="is_default"/>
                </label>
            </div>
        </div>

    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <?php $this->load->view(BACKENDFOLDER . '/include/save', ['module_data' => $advertisement]); ?>
            </div>
        </div>
    </div>
    
</form>