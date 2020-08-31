<!-- *************** Start Inner Page Banner *************** -->
<section class="inner-banner">
    <h3>Accomodation</h3>
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
<?php echo display_breadcrumb_front($breadcrumb); ?>

<section id="room-list-section">
    <div class="container">
        <h3><?php echo $detail['name']; ?></h3>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-push-8 col-md-4">
                <img class="img-responsive" src="<?php echo base_url() . $detail['cover_image']; ?>" alt="">
                <p><?php echo $detail['long_description']; ?></p>
            </div>            
        </div>
    </div>
</section>
