<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $meta_keywords ?></title>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript">
        <meta name="description" content="Kamalashi">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0,  target-densitydpi=device-dpi">

		<!-- Fav Icons -->
		<link rel="apple-touch-icon" sizes="57x57" href="assets/front/images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="assets/front/images/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="assets/front/images/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/front/images/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="assets/front/images/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="assets/front/images/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="assets/front/images/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="assets/front/images/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/front/images/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="assets/front/images/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/front/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="assets/front/images/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/front/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="assets/front/images/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="assets/front/images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

        <!-- *************** Google Font *************** -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">     

        <!-- *************** Font Awesome *************** -->
        <link rel="stylesheet" href="<?php echo base_url('assets/front/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>" type="text/css" />

        <!-- *************** Bootstrap *************** -->
        <link href="<?php echo base_url('assets/front/js/vendor/bootstrap/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/front/js/vendor/bootstrap/bootstrap-theme.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- *************** Master Slider *************** -->
        <link href="<?php echo base_url('assets/front/js/vendor/masterslider/style/masterslider.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/front/js/vendor/masterslider/style/ms-layers-style.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- *************** Slick Slider *************** -->
        <link href="<?php echo base_url('assets/front/js/vendor/slick1--8-0/slick.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- *************** Scrollable *************** -->
        <link href="<?php echo base_url('assets/front/js/vendor/Scrollable-1.2/jquery.scrollable.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- *************** Select 2 *************** -->
        <link href="<?php echo base_url('assets/front/js/vendor/select2-4-0-3/select2.min.css') ?>" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url('assets/front/js/vendor/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- *************** Start Common CSS *************** -->
        <link href="<?php echo base_url('assets/front/css/common/main.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- *************** End Common CSS *************** -->

        <!-- loading custom css -->
        <?php
        if (isset($addCss) && !empty($addCss)) {
            foreach ($addCss as $css) {
                ?>
                <link href="<?php echo base_url($css) ?>" rel="stylesheet" type="text/css"/>
                <?php
            }
        }
        ?>
    </head>
    <body>
        <input type="hidden" value="<?php echo base_url() ?>" id="base-url"/>
        <!-- *************** Start Header *************** -->
        <header id="main-header">
            <?php $this->load->view('frontend/include/header') ?>
        </header>
        <!-- *************** End Header *************** -->
        <main>
            <?php
            if (isset($is_home) && ($is_home == 'yes')) {

                $this->load->view('frontend/layout/homepage');
            } else {

                $this->load->view('frontend/layout/innerpage');
            }
            ?> 
        </main>
        <!-- *************** Start Footer *************** -->
        <div class="process-wrap" style="display:none;">
            <div class="process"></div>
        </div>
        <footer>
            <?php $this->load->view('frontend/include/footer') ?>
        </footer>
        <!-- *************** End Footer *************** -->
		<script src="<?php echo base_url('assets/front/js/common/jquery-1.12.3.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/front/js/vendor/jquery-ui/jquery-ui.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/front/js/vendor/masterslider/jquery.easing.min.js') ?>" type="text/javascript"></script>

        <!-- *************** Bootstrap *************** -->
        <script src="<?php echo base_url('assets/front/js/vendor/bootstrap/bootstrap.min.js') ?>" type="text/javascript"></script>

        <!-- *************** Scrollable *************** -->
        <script src="<?php echo base_url('assets/front/js/vendor/Scrollable-1.2/jquery.scrollable.js') ?>" type="text/javascript"></script>

        <!-- *************** Master Slider *************** -->
        <script src="<?php echo base_url('assets/front/js/vendor/masterslider/masterslider.min.js') ?>" type="text/javascript"></script>

        <!-- *************** Slick Slider *************** -->
        <script src="<?php echo base_url('assets/front/js/vendor/slick1--8-0/slick.min.js') ?>" type="text/javascript"></script>

        <!-- *************** Select 2 *************** -->
        <script src="<?php echo base_url('assets/front/js/vendor/select2-4-0-3/select2.full.min.js') ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/front/js/common/main.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/front/js/vendor/moment.js') ?>" type="text/javascript"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- ***** Page JS ***** -->
        <?php
        if (isset($addJs) && !empty($addJs)) {
            foreach ($addJs as $js) {
                ?>
                <script src="<?php echo base_url($js) ?>" type="text/javascript"></script>
                <?php
            }
        }
        ?>
        <?php if (segment(1) == 'contact') { ?>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsqVAmab7b-F0o06lXeCJg7mErWvAQx2A&callback=ContactMap" async defer></script>
        <?php } ?>

    </body>
</html>
