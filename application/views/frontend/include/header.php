<button id="mobile-menu-toggler"><img src="<?php echo base_url('assets/front/images/icons/icon-mobile-toggler.svg'); ?>" alt="" /> </button>
<div class="container">
    <nav>
        <div class="logo-wrap">
            <a id="main-logo" href="<?php echo base_url();?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/logo.svg'); ?>" alt="Main Logo" /></a>
        </div>
        <ul class="main-navigation">
            <?php
            foreach ($mainMenu as $key => $data) {
                $url = segment(1);

                if (isset($data['childList']) && !empty($data['childList'])) {
                    foreach ($data['childList'] as $key => $childrens) {
                        if ($url == $childrens['menu_alias']) {
                            $class = 'active';
                            break;
                        } else {
                            $class = '';
                        }
                    }
                } else {
                    if ($url == $data['menu_alias']) {
                        $class = 'active';
                    } else {
                        $class = '';
                    }
                }
                ?>
                <li class="<?php echo $class ?> has-submenu">
                    <?php if (isset($data['childList']) && !empty($data['childList'])) { ?>
                        <a href="<?php
                        if (isset($data['childList'])) {
                            echo "javascript:void(0)";
                        } else {
                            echo "#";
                        }
                        ?>"
                           ><?php echo $data['menu_title'] ?>
                            <img src="<?php echo base_url('assets/front/images/icons/icon-mobile-toggler.svg'); ?>" alt="" />
                        </a>
                        <ul class="submenu">
                            <?php
                            foreach ($data['childList'] as $key => $childrens) {
                                if ($childrens['menu_parent'] == $data['id']) {
                                    ?>
                                    <li>
                                        <?php
                                        if ($childrens['menu_link_type'] == 'url') {
                                            $link = $childrens['link'];
                                        } else {

                                            $link = base_url() . $childrens['menu_alias'];
                                        }
                                        ?>
                                        <?php if ($childrens['menu_link_type'] == 'url'): ?>
                                            <a target="_blank" href="<?php echo $link ?>"><?php echo $childrens['menu_title'] ?> </a>
                                    <?php else: ?>
                                            <a href="<?php echo $link ?>"><?php echo $childrens['menu_title'] ?></a>
                                    <?php endif; ?>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <?php
                    }else {
                        if ($data['menu_link_type'] == 'url') {
                            $link = $data['link'];
                        } else {
                            $link = base_url() . $data['menu_alias'];
                        }
                        if ($data['menu_link_type'] == 'url') {
                            ?>
                            <a target="_blank" href="<?php echo $link ?>"><?php echo $data['menu_title'] ?></a>
                        <?php } else { ?>
                            <a href="<?php echo $link ?>"><?php echo $data['menu_title'] ?></a>   
                            <?php
                        }
                    }
                    ?>
                </li>

<?php } ?>
        </ul>
    </nav>
</div>
