<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <!-- END SIDEBAR TOGGLER BUTTON -->
            <li class="nav-item start <?php echo segment(2) == 'dashboard' ? 'active open' : '' ?>" >
                <a href="<?php echo base_url(BACKENDFOLDER . '/dashboard') ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i> <span class="title">Dashboard</span>
                    <?php echo segment(2) == 'dashboard' ? '' : '' ?>
                </a>
            </li>
            <?php foreach ($this->all_parent_modules as $parent_module) { ?>
                <?php
                if (isset($this->all_child_modules[$parent_module->id])) {
                    if ($parent_module->show_in_navigation == '1') {
                        ?>
                        <li class="nav-item start <?php echo (check_parent_active($this->all_child_modules[$parent_module->id], segment(2))) ? ' active open' : '' ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="<?php echo $parent_module->icon_class ?>"></i>
                                <span class="title"><?php echo $parent_module->name ?></span>
                                <?php echo segment(2) == 'dashboard' ? '<span class="selected"></span>' : '' ?>
                                <span class="arrow"></span>

                            </a>
                            <ul class="sub-menu">
                                <?php
                                foreach ($this->all_child_modules[$parent_module->id] as $child_module) {
                                    if ($child_module->show_in_navigation == '1') {
                                        ?>
                                        <li class="nav-item start <?php echo segment(2) == $child_module->slug ? 'active open' : '' ?>">
                                            <a href="<?php echo base_url(BACKENDFOLDER . '/' . $child_module->slug) ?>" class="nav-link ">
                                                <span class="title"><?php echo $child_module->name ?></span>
                                                <?php echo segment(2) == $child_module->slug ? '<span class="selected"></span>' : '' ?>
                                            </a>
                                        </li>

                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                } else {
                    if ($parent_module->show_in_navigation == '1') {
                        ?>
                        <li class="nav-item start "<?php echo segment(2) == $parent_module->slug ? 'active open' : '' ?>>
                            <a href="<?php echo base_url(BACKENDFOLDER . '/' . $parent_module->slug) ?>" class="nav-link nav-toggle">
                                <i class="<?php echo $parent_module->icon_class ?>"></i>
                                <span class="title"><?php echo $parent_module->name ?></span>
                                <?php echo segment(2) == $parent_module->slug ? '<span class="selected"></span>' : '' ?>
                                
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            <?php } ?>
            <li class="nav-item start" >
                <a href="<?php echo base_url(BACKENDFOLDER . '/logout') ?>" class="nav-link nav-toggle">
                    <i class="fa fa-sign-out"></i> <span class="title">Sign Out</span>

                </a>
            </li>            

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
