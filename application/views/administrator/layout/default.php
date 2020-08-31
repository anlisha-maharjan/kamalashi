<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $meta_title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
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
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700" rel="stylesheet"> 

        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap-switch/css/bootstrap-switch.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!--Select 2-->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!--DataTAble-->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />



        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap-daterangepicker/daterangepicker.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/components.min.css') ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/plugins.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/layout.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/themes/darkblue.min.css') ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/custom.min.css') ?>" rel="stylesheet" type="text/css" />
        <!--Elfinder-->
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/elFinder/css/elfinder.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/elFinder/css/theme.css') ?>" rel="stylesheet" type="text/css" />

        <!-- END THEME LAYOUT STYLES -->
        <!--Pages-->
        <?php
        if (isset($addCss) && !empty($addCss)) {
            foreach ($addCss as $css) {
                ?>
                <link href="<?php echo base_url($css) ?>" rel="stylesheet" type="text/css" />
                <?php
            }
        }
        ?>
        <link rel="shortcut icon" href="favicon.ico" /> 
        <link href="<?php echo base_url('assets/' . BACKENDFOLDER . '/css/common/style.css') ?>" rel="stylesheet" type="text/css" />
    </head>

    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <input type="hidden" value="<?php echo base_url() ?>" id="base-url"/>
        <input type="hidden" value="<?php echo base_url(BACKENDFOLDER) ?>" id="admin-base-url"/>
        <input type="hidden" value="<?php echo BACKENDFOLDER ?>" id="backend_folder"/>
        <input type="hidden" value="<?php echo segment(2) ?>" id="admin-module"/>
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <h1 class="logo-default title-site">Kamalashi <span>Palace</span></h1>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?php echo base_url('assets/administrator//img/icon-user.svg'); ?>">
                                    <span class="username username-hide-on-mobile"> <?php echo get_userdata('name') ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo base_url(BACKENDFOLDER . '/user/create/' . get_userdata('user_id')) ?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo base_url(BACKENDFOLDER . '/logout') ?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->

                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <?php $this->load->view(BACKENDFOLDER . '/layout/navbar') ?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->

                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">

                                <li>
                                    <a href="<?php echo base_url(BACKENDFOLDER) ?>">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span><?php echo $module_name ?></span>
                                </li>
                            </ul>

                        </div>
                        <!-- END PAGE BAR -->

                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-equalizer font-red-sunglo"></i>
                                            <span class="caption-subject font-red-sunglo bold uppercase"><?php echo ucwords(str_replace('_', ' ', $sub_module_name)) ?></span>

                                        </div>
                                        <div class="actions">
                                            <?php $this->load->view(BACKENDFOLDER . '/layout/action_butons'); ?>

                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php flash() ?>
                                        <?php $this->load->view($body); ?>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

    </div>

    <!-- BEGIN CORE PLUGINS -->
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/jquery-2.1.3.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/jquery-migrate-1.2.1.js') ?>"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/jquery-validation/js/jquery.validate.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/jquery-ui/jquery-ui.min.js') ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/js.cookie.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/jquery.blockui.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/morris/morris.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/morris/raphael-min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/ckfinder/ckfinder.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/datatables/jquery.dataTables.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/datatables/dataTables.bootstrap.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/elFinder/js/elfinder.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/select2/js/select2.min.js') ?>" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/moment.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/vendor/bootstrap-daterangepicker/daterangepicker.min.js') ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/jquery.sparkline.min.js') ?>" type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/app.min.js') ?>" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/dashboard.min.js') ?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/layout.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/demo.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/quick-sidebar.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/quick-nav.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/filepicker.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/' . BACKENDFOLDER . '/js/common/scripts.js') ?>"></script>

    <!-- END THEME LAYOUT SCRIPTS -->
    <!--Pages-->
    <?php
    if (isset($addJs) && !empty($addJs)) {
        foreach ($addJs as $js) {
            ?>
            <script src="<?php echo base_url($js) ?>" type="text/javascript"></script>
            <?php
        }
    }
    ?>

</body>

</html>
