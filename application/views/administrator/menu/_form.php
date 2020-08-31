<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissable fade in">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>
<?php ?>
<form action="" method="post">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="title">Menu Title</label>
                        <input type="text" name="menu_title" value="<?php echo $menu->menu_title; ?>" class="form-control title" id="title" placeholder="Menu Title">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="link">Menu Alias</label>
                        <input type="text" <?php echo (segment(4) != '') ? 'readonly' : '' ?> name="menu_alias" value="<?php echo $menu->menu_alias; ?>" class="form-control alias" id="alias" placeholder="Menu Alias">
                        <?php if(segment(4) != ''):?>
                            <a href="#" id="edit_menu_alias">Edit</a>
                        <?php endif;?>
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="menu_parent">Menu Parent</label>
                <select name="menu_parent" id="menu_parent" class="form-control">
                    <option value="">Select Menu Parent</option>
                    <?php if ($parentMenus) {
                        foreach ($parentMenus as $menuParent) { ?>
                            <option value="<?php echo $menuParent->id ?>" <?php echo ($menuParent->id == $menu->menu_parent) ? 'selected' : '' ?>>
                                <?php echo $menuParent->menu_title ?>
                            </option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="menu_banner">Menu Banner</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="menu_banner" value="<?php echo $menu->menu_banner ?>" class="form-control" id="menu_banner" placeholder="Upload Menu Banner">
                <?php if($menu->menu_banner != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($menu->menu_banner) ?>" />
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
            
            
            <div class="form-group">
                <label for="link">Menu Description</label>
                <textarea name="description" class="form-control"
                       id="description"
                       placeholder="Menu Description"><?php echo $menu->description; ?></textarea>
            </div>
            
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label for="icons">Menu Icon</label>
                <input type="text" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" name="icon" value="<?php echo $menu->icon ?>" class="form-control" id="icon" placeholder="Upload Menu Icon">
                <?php if($menu->icon != '') { ?>
                    <div class="image-wrapper">
                        <img class="img-responsive" src="<?php echo base_url($menu->icon) ?>" />
                        <a href="javascript:void(0);" class="delete">
                            Delete
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="menu_linktype">Menu Link Type</label>
                <select name="menu_link_type" id="menu-link-type" class="form-control">
                    <?php if ($menu_link_type) : ?>
                        <?php foreach ($menu_link_type as $key => $type) :
                            if($key != 'module') { ?>
                            <option value="<?php echo $key ?>" <?php echo ($menu->menu_link_type == $key) ? 'selected' : '' ?>>
                                <?php echo ucwords($type); ?>
                            </option>
                            <?php } ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>

            <div class="form-group" id="menu-url" style="display: none">
                <label for="link">Link</label>
                <input type="text" name="link" value="<?php echo $menu->link; ?>" class="form-control alias" placeholder="Menu Link" />
            </div>

             <div class="form-group" id="menu-content" style="display: none">
                <label for="link">Select Content</label>
                <select name="content_link" class="form-control">
                    <?php foreach ($link_type['content'] as $key => $type) { ?>
                        <option value="<?php echo $key ?>" <?php echo ($menu->link == $key) ? 'selected' : '' ?>>
                            <?php echo ucwords($type); ?>
                        </option>
                    <?php } ?>
                </select>
            </div> 

           
            
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="menu_type">Menu Type</label>
                        <select name="menu_type" class="form-control" id="menu_type">
                            <?php if ($menu_type) : ?>
                                <?php foreach ($menu_type as $type) : ?>
                                    <option
                                        value="<?php echo $type->menutype ?>" <?php echo ($menu->menu_type == $type->menutype) ? 'selected' : '' ?>><?php echo $type->title; ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="front_display">Show in Front</label>
                        <select name="front_display" class="form-control" id="front_display">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="link"> OrderNumber</label>
                        <input type="text" name="orderNumber" value="<?php echo $menu->orderNumber; ?>" class="form-control"
                               placeholder="Order Number">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <?php $this->load->view(BACKENDFOLDER . '/include/form_status', ['module_data' => $menu]); ?>
                </div>
            </div>
            
            
        </div>
    </div>
    
        <div class="box box-success" style="box-shadow: none; margin-top: 30px;">
           <div class="box-body" style="padding: 10px 0px;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="link">Meta Title</label>
                            <input type="text" name="meta_title" value="<?php echo ($menu->meta_title)?$menu->meta_title:$menu->menu_title; ?>" class="form-control"
                                   placeholder="Meta Title">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="link">Meta Description</label>
                            <input type="text" name="meta_description" value="<?php echo ($menu->meta_description)?$menu->meta_description:$menu->menu_title; ?>" class="form-control"
                                   placeholder="Meta Description">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <input type="submit" class="btn green" value="Save" name="only_save">
                <input type="submit" class="btn green" value="Save and New" name="save_new">
                <button type="submit" class="btn green">Save and Exit</button>
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/'. $this->header['page_name']) ?>"><span>Cancel</span></a>
            </div>
        </div>
    </div>

</form>
