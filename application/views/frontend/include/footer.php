<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <h5 class="text-italic">Connect with us socially.</h5>
            <?php if (isset($facebook_link) && !empty($facebook_link)) { ?>
                <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->facebook ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-facebook.svg') ?>" alt="facebook" /></a>
            <?php } ?>
            <?php if (isset($instagram_link) && !empty($instagram_link)) { ?>
                <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->instagram ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-instagram.svg') ?>" alt="instagram" /></a>
            <?php } ?>
            <?php if (isset($twitter_link) && !empty($twitter_link)) { ?>
                <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->twitter ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-twitter.svg') ?>" alt="twitter" /></a>
            <?php } ?>
            <a class="icon-wrap" target="_blank" href="https://www.tripadvisor.com/Hotel_Review-g293890-d13799913-Reviews-Hotel_Kamalashi_Palace-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Region.html"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-tripadvisor.svg') ?>" alt="tripadvisor" /></a>
            <a class="icon-wrap" target="_blank" href="https://www.booking.com/hotel/np/kamalashi-palace.en-gb.html?label=opensearch-plugin;sid=0df81c8b47da5eae6863edd4f54f3d62;all_sr_blocks=312985201_113407186_2_1_0;bshb=2;checkin=2018-04-15;checkout=2018-04-16;dest_id=-1021719;dest_type=city;dist=0;group_adults=2;hapos=1;highlighted_blocks=312985201_113407186_2_1_0;hpos=1;room1=A%2CA;sb_price_type=total;srepoch=1523783972;srfid=f9cb66858bf63300620486f8da3b5fdb7258243fX1;srpvid=82f7419199c9058e;type=total;ucfs=1&#hotelTmpl" style="width:120px;"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-booking.png') ?>" alt="booking" /></a>
            <a class="icon-wrap" target="_blank" href="https://www.expedia.com/Kathmandu-Valley-Hotels-Hotel-Kamalashi-Palace.h22874367.Hotel-Information?chkin=4%2F15%2F2018&chkout=4%2F16%2F2018&rm1=a2&hwrqCacheKey=0861f06a-3b5b-415f-a465-f90cec3716c8HWRQ1523796877965&regionId=1938&vip=false&c=909d9184-e906-4f75-903e-d33719c0d955&&exp_dp=48.27&exp_ts=1523796883506&exp_curr=USD&swpToggleOn=false&exp_pg=HSR" style="width:100px;"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-expedia.png') ?>" alt="expedia" /></a>
            <?php /* <?php if (isset($linkedin_link) && !empty($linkedin_link)) { ?>
              <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->linkedin ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-linkedin.svg') ?>" alt="linkedin" /></a>
              <?php } ?>
              <?php if (isset($youtube_link) && !empty($youtube_link)) { ?>
              <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->youtube ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-youtube.svg') ?>" alt="youtube" /></a>
              <?php } ?>
              <?php if (isset($skype_link) && !empty($skype_link)) { ?>
              <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->skype ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-skype.svg') ?>" alt="skype" /></a>
              <?php } ?>
              <?php if (isset($gplus_link) && !empty($gplus_link)) { ?>
              <a class="icon-wrap" target="_blank" href="<?php echo $globalConfig->gplus ?>"><img class="img-responsive" src="<?php echo base_url('assets/front/images/icons/icon-gplus.svg') ?>" alt="gplus" /></a>
              <?php } ?> */ ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">                        
            <nav class="footer-nav">
                <h5><?php echo $footermenu['parents'][0]->menu_title; ?></h5>
                <?php
                foreach ($footermenu['children'] as $key => $menu) {
                    if ($key == $footermenu['parents'][0]->id) {
                        foreach ($menu as $item) {
                            ?>
                            <?php
                            if ($item->menu_link_type == 'url') {

                                $link = $item->link;
                            } else {
                                $link = base_url() . $item->menu_alias;
                            }
                            ?>

                            <?php if ($item->menu_link_type == 'url'): ?>
                                <a target="_blank"  href="<?php echo $link ?>"><?php echo $item->menu_title ?></a>


                            <?php else: ?>
                                <a href="<?php echo $link ?>" ><?php echo $item->menu_title ?></a>
                            <?php endif; ?>
                            <?php
                        }
                    }
                }
                ?>

            </nav><!--
            --><nav class="footer-nav">
                <h5><?php echo $footermenu['parents'][1]->menu_title; ?></h5>
                <?php
                foreach ($footermenu['children'] as $key => $menu) {
                    if ($key == $footermenu['parents'][1]->id) {
                        foreach ($menu as $item) {
                            ?>
                            <?php
                            if ($item->menu_link_type == 'url') {

                                $link = $item->link;
                            } else {
                                $link = base_url() . $item->menu_alias;
                            }
                            ?>

                            <?php if ($item->menu_link_type == 'url'): ?>
                                <a target="_blank"  href="<?php echo $link ?>"><?php echo $item->menu_title ?></a>


                            <?php else: ?>
                                <a href="<?php echo $link ?>" ><?php echo $item->menu_title ?></a>
                            <?php endif; ?>
                            <?php
                        }
                    }
                }
                ?>

            </nav>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <a class="footer-main-logo" href=""><img src="<?php echo base_url('assets/front/images/logo.svg'); ?>" alt="" /></a>
            <h6>A joint friendly venture of</h6>
            <img class="icon-wrap" style="width: 30px;" src="<?php echo base_url('assets/front/images/flag/icon-flag-nepal.svg'); ?>" alt="" />
            <img class="icon-wrap" style="width: 42px;" src="<?php echo base_url('assets/front/images/flag/icon-flag-japan.svg'); ?>" alt="" />
            <address class="text-light-gold">
                <p><?php echo $address; ?></p>
                <p>Tel : <a class="text-light-gold" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
                <p>Email: <a class="text-light-gold" href="mailto:info@kamalashipalace.com"> <?php echo $email; ?></a> </p>
            </address>
        </div>
    </div>
</div>
<div class="container">
    <div class="footer-bottom clearfix">
        <p class="display-inline-block text-light-gold">© 2017 Kamalashi Palace. All rights reserved. </p>
        <?php if (isset($bottomMenu) && !empty($bottomMenu)): ?>
            <?php
            foreach ($bottomMenu['parents'] as $key => $menu) {
                $link = base_url() . $menu->menu_alias;
                ?>
                <a href="<?php echo $link; ?>" class="text-light-gold pull-right"><?php echo $menu->menu_title; ?></a>
            <?php } ?>
        <?php endif; ?>

    </div>
</div> 
