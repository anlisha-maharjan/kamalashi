<!-- *************** Start Inner Page Banner *************** -->
<section class="inner-banner">
    <h3><?php echo $menu->menu_title; ?></h3>
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

<!-- *************** Start BreadCrumb *************** -->
<?php echo display_breadcrumb_front($breadcrumb); ?>
<!-- *************** End BreadCrumb *************** -->

<!-- *************** Start Welcome Section *************** -->
<section class="welcome-section">
    <div class="container text-center">
        <h3><?php echo $content->name; ?></h3>
        <p class="center-content"><?php echo $content->short_description; ?></p>
    </div>
</section>
<!-- *************** End Welcome Section *************** -->

<!-- *************** Start Rooms Counter Section *************** -->
<section class="section-room-counter">
    <img src="<?php echo base_url('assets/front/images/about-section-banner.jpg'); ?>" alt=""/>
    <div class="container">
        <div class="circle-holder">
            <span><?php echo $config->no_rooms;?></span>
            <span>Rooms</span>
        </div>
        <div class="circle-holder">
            <span><?php echo $config->no_staffs;?></span>
            <span>Restaurant</span>
        </div>
        <div class="circle-holder">
            <span><?php echo $config->no_menu;?></span>
            <span>VIP Lounge</span>
        </div>
    </div>
</section>
<!-- *************** End Rooms Counter Section *************** -->

<!-- *************** Start Why Choose Hotel Section *************** -->
<section class="why-choose-hotel">
    <div class="container">
        <h3><?php echo $content->sub_title; ?></h3>
        <?php echo $content->long_description; ?>
    </div>
</section>
<!-- *************** End Why Choose Hotel Section *************** -->

<!-- *************** Start Reimagined Luxury *************** -->
<section id="section-gallery-view">
    <div class="container text-center ">
        <div class="row">
            <?php
            $count = 1;
            if (isset($gallery) && !empty($gallery)) {
                foreach ($gallery as $data) {
                    if ($count <= 3) {
                        ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <a href="<?php echo base_url() . 'gallery/' . $data->slug; ?>" class="product-wrap text-center text-gold">
                                <figure>
                                    <?php
                                    $arr = explode('/', $data->cover);

                                    if (end($arr)) {
                                        $alt_tag = str_replace('-', '', end($arr));
                                    }
                                    ?> 
                                    <img src="<?php echo $data->cover; ?>" alt="<?php echo $alt_tag; ?>"/>

                                </figure>
                                <h4 class="text-gold"><?php echo $data->name; ?></h4>
                                <?php if (isset($data->short_description) && $data->short_description) { ?>
                                    <p class="text-light-gold"><?php
                                        echo strip_tags(substr($data->short_description, 0, 200));
                                        echo (strlen($data->short_description) > 200) ? '...' : '';
                                        ?>
                                    </p> 
                                <?php } ?>

                            </a>
                        </div>

                        <?php
                        $count ++;
                    }
                }
            }
            ?>
        </div>    
    </div>
</section>
<!-- *************** End Reimagined Luxury *************** -->
