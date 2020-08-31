<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $meta_title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- Fav Icons -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-57x57.png'?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-60x60.png'?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-72x72.png'?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-76x76.png'?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-114x114.png'?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-120x120.png'?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-144x144.png'?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-152x152.png'?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url().'assets/front/images/favicon/apple-icon-180x180.png'?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url().'assets/front/images/favicon/android-icon-192x192.png'?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/front/images/favicon/favicon-32x32.png'?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url().'assets/front/images/favicon/favicon-96x96.png'?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url().'assets/front/images/favicon/favicon-16x16.png'?>">
        <link rel="manifest" href="<?php echo base_url().'assets/front/images/favicon/manifest.json'?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="assets/front/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/select2/css/select2-bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/components.min.css') ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/plugins.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/login-5.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/administrator/img/favicon/favicon.png') ?>" /> </head>
		<link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/style.css') ?>" rel="stylesheet" type="text/css" />
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset mt-login-5-bsfix">
					<div class="login-bg" style="background-image: url(<?php echo base_url('assets/administrator/img/login/bg1.jpg'); ?>)" >
					
                        <img class="login-logo" src="<?php echo base_url('assets/administrator/img/login/logo.svg'); ?>" /> 
                    </div>
                </div>
                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <div class="login-content">
                        <?php $this->load->view($body); ?>
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                                <!-- <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul> -->
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>© 2017 Kamalashi Palace. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->

        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/jquery-2.1.3.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/js.cookie.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/jquery.blockui.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/jquery-validation/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/jquery-validation/js/additional-methods.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/select2/js/select2.full.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/backstretch/jquery.backstretch.min.js') ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/app.min.js') ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/login-5.min.js') ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function ()
            {
                $('#clickmewow').click(function ()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>
