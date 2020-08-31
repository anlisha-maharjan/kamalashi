<?php if (validation_errors()) : ?>
    <div class="alert alert-danger alert-dismissable fade in">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>
<form action="" method="post">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#site_info" aria-controls="site_info" role="tab" data-toggle="tab">Site Detail</a>
        </li>
        <li role="presentation">
            <a href="#site_contact" aria-controls="site_contact" role="tab" data-toggle="tab">Site Contact</a>
        </li>
        <li role="presentation">
            <a href="#site_social" aria-controls="site_social" role="tab" data-toggle="tab">Site Social</a>
        </li>
        <li role="presentation">
            <a href="#site_map" aria-controls="site_map" role="tab" data-toggle="tab">Site Map</a>
        </li>
        <li role="presentation">
            <a href="#site_meta" aria-controls="site_meta" role="tab" data-toggle="tab">Site Meta</a>
        </li>
        <li role="presentation">
            <a href="#hotel_info" aria-controls="hotel_info" role="tab" data-toggle="tab">Hotel Info</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="site_info">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input type="text" name="site_title" value="<?php echo $configuration->site_title ?>" class="form-control" id="site_title" placeholder="Site Title">
                    </div>
                    <div class="form-group">
                        <label for="site_email">Site Email</label>
                        <input type="text" name="site_email" value="<?php echo $configuration->site_email ?>" class="form-control" id="site_email" placeholder="Site Email">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="site_logo">Site Logo</label>
                        <input type="text" name="site_logo" onclick="BrowseServer(this)" data-resource-type="image" data-multiple="false" value="<?php echo $configuration->site_logo ?>" class="form-control" id="site_logo" placeholder="Upload Site Logo">
                        <?php if ($configuration->site_logo != '') { ?>
                            <img src="<?php echo base_url($configuration->site_logo) ?>" class="img-responsive" width="20%"/>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="site_social">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facebook">Facebook Link</label>
                        <input type="text" name="facebook" value="<?php echo $configuration->facebook ?>" class="form-control" id="facebook" placeholder="Facebook">
                    </div>
                    <div class="form-group">
                        <label for="skype">Skype Link</label>
                        <input type="text" name="skype" value="<?php echo $configuration->skype ?>" class="form-control" id="skype" placeholder="Skype">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter Link</label>
                        <input type="text" name="twitter" value="<?php echo $configuration->twitter ?>" class="form-control" id="twitter" placeholder="Twitter">
                    </div>
                    <div class="form-group">
                        <label for="linkedin">Linkedin Link</label>
                        <input type="text" name="linkedin" value="<?php echo $configuration->linkedin ?>" class="form-control" id="linkedin" placeholder="Linkedin">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gplus">Google Plus Link</label>
                        <input type="text" name="gplus" value="<?php echo $configuration->gplus ?>" class="form-control" id="gplus" placeholder="Google Plus">
                    </div>
                    <div class="form-group">
                        <label for="youtube">Youtube Link</label>
                        <input type="text" name="youtube" value="<?php echo $configuration->youtube ?>" class="form-control" id="youtube" placeholder="Youtube">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram Link</label>
                        <input type="text" name="instagram" value="<?php echo $configuration->instagram ?>" class="form-control" id="instagram" placeholder="Instagram">
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="site_contact">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="<?php echo $configuration->phone ?>" class="form-control" id="phone" placeholder="Phone">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="fax">Fax</label>
                        <input type="text" name="fax" value="<?php echo $configuration->fax ?>" class="form-control" id="fax" placeholder="Fax">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea rows="7" name="address" class="form-control" id="address" placeholder="Address"><?php echo $configuration->address ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="site_meta">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="meta-keyword">Meta Keyword</label>
                        <input type="text" name="meta_keyword" value="<?php echo $configuration->meta_keyword ?>" class="form-control" id="meta-keyword" placeholder="Meta Keyword">
                    </div>
                    <div class="form-group">
                        <label for="meta-description">Meta Description</label>
                        <textarea name="meta_description" rows="7" class="form-control" id="meta-description" placeholder="Meta Description"><?php echo $configuration->meta_description ?></textarea>
                    </div>
                </div>

            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="site_map">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="meta-keyword">Latitude</label>
                        <input type="text" name="latitude" value="<?php echo $configuration->latitude ?>" class="form-control" id="latitude" placeholder="Latitude">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" name="longitude" value="<?php echo $configuration->longitude ?>" class="form-control" id="longitude" placeholder="Longitude">
                    </div>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="hotel_info">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="no_rooms">Rooms</label>
                        <input type="text" name="no_rooms" value="<?php echo $configuration->no_rooms ?>" class="form-control" id="no_rooms" placeholder="Rooms">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="no_staffs">Restaurant</label>
                        <input type="text" name="no_staffs" value="<?php echo $configuration->no_staffs ?>" class="form-control" id="no_staffs" placeholder="Staffs">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="no_menu">VIP Lounge</label>
                        <input type="text" name="no_menu" value="<?php echo $configuration->no_menu ?>" class="form-control" id="no_menu" placeholder="Menus">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <button type="submit" class="btn green">Submit</button>
                <a class="btn default" href="<?php echo base_url(BACKENDFOLDER . '/' . $this->header['page_name']) ?>"><span>Close</span></a>

            </div>
        </div>
    </div>

</form>