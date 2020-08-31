<!-- *************** Start Inner Page Banner *************** -->
<section class="inner-banner">
    <h3>Contact Us</h3>
    <?php if (isset($menu->menu_banner) && !empty($menu->menu_banner)): ?>
        <?php
        $arr = explode('/', $menu->menu_banner);

        if (end($arr)) {
            $alt_tag = str_replace('-', '', end($arr));
        }
        ?>
        <img class="img-responsive" src="<?php echo $menu->menu_banner; ?>" alt="<?php echo $alt_tag; ?>">
    <?php else: ?>
        <img class="img-responsive" src="<?php echo base_url() . 'uploads/banner/menu/default-banner.png'; ?>" alt="default-banner.jpg">
    <?php endif; ?>
</section>
<!-- *************** End Inner Page Banner *************** -->
<?php echo display_breadcrumb_front($breadcrumb) ?>
<section id="page-contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h4 class="text-gold">Our Location</h4>
                <div id="map"></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h4 class="text-gold">Write to us</h4>
                <form class="" method="post" action="<?php echo base_url() . 'page/contact' ?>" enctype="multipart/form-data" name="contact" id="contact">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" id="name" class="form-control"/>
                        <span class="error name" style="display:none"></span>
                    </div>
                    <!-- <div class="form-group">
                            <label>Address *</label>
                            <input name="address" type="text" id="address" class="form-control"/>
                            <span class="error address" style="display:none"></span>
                    </div>
                    <div class="form-group">
                            <label>Phone *</label>
                            <input name="phone" type="text" id="phone" class="form-control"/>
                            <span class="error phone" style="display:none"></span>
                    </div> -->
                    <div class="form-group">
                        <label>Your Email Address</label>
                        <input name="email" type="text" id="email" class="form-control"/>
                        <span class="error email" style="display:none"></span>
                    </div>
                    <div class="form-group">
                        <label>Your Message</label>
                        <textarea name="message" type="text" id="message" class="form-control"></textarea>
                        <span class="error message" style="display:none"></span>
                    </div>
                    <!-- <div class="form-group">
                        <div class="captcha-wrap">
                            <img height="50px" id="captcha" src="<?php echo base_url('page/securimage'); ?>" alt='captcha' /> 
                            <a id="reloadeded"><img src="<?php echo base_url() . 'assets/front/images/refresh.gif' ?>" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" style="cursor: pointer;" /></a>
                            <input name="code" id="code" type="text" class="form-control" placeholder="Code"/>
                            <span class="error code" style="display:none"></span>
                        </div>
                    </div>-->
                    <button type="button" name="submit" id="submit" class="btn-light-golden" >Send</button>
                    <!-- <button type="button" name="reset" class="btn-light-golden" id="reset" >Reset</button> -->
                </form>
            </div>
        </div>		
    </div>
</section>
