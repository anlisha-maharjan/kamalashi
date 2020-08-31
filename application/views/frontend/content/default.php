<?php echo display_breadcrumb_front($breadcrumb); ?>

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


<?php if (isset($content_data) && !empty($content_data)): ?>
    <?php foreach ($content_data as $content) { ?>
        <h1 class="page-title"><?php echo $content->name ?></h1>
        <p><?php echo $content->long_description ?></p>
    <?php } ?>
<?php endif; ?>


