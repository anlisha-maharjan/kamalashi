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

<section id="hero-gallery" class="inner-default-bg">
    <div class="container">
        <div class="row galler-wrap">
            <?php
            if (isset($gallery) && !empty($gallery)):
                foreach ($gallery as $data) :
                    ?>
                    <div class="col-xs-12 col-sm-4 col-md-3 album">
                        <span class="gallery_id" style="display:none"><?php echo $data['id']; ?></span>
                        <a class="album-toggler" href="javascript:void(0)">
                            <figure style="background-image: url(<?php echo base_url() . $data['cover']; ?>)"></figure>
                            <span class="album_name"><?php echo $data['name']; ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>
</section>


<div class="album-pop">
    <button class="btn-close-pop-album"><img class="img-responsive" src="<?php echo base_url() . 'assets/front/images/icons/icon-close.png'; ?>" alt=""></button>
    <h5 class="text-center text-gold name"></h5>
    <!-- start maximized slide -->
    <div id="album-pop-slide">
       
        
    </div>
    <!-- End maximized slide -->

    <!-- Start Pop Slide Thumb -->
    <div id="pop-slide-thumb">
       
    </div>
    <!-- End Pop Slide Thumb -->
</div>
