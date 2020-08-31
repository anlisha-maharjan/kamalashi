<section class="master-slider" id="home-banner">
    <?php if (isset($banner) && !empty($banner)) { ?>
        <?php foreach ($banner as $key => $data) { ?>
            <div class="ms-slide home-slide-content">
                <?php
                $arr = explode('/', $data->image);

                if (end($arr)) {
                    $alt_tag = str_replace('-', '', end($arr));
                }
                ?>
                <img src="<?php echo base_url('assets/front/js/vendor/masterslider/style/blank.gif'); ?>" data-src="<?php echo $data->image; ?>" alt="<?php echo $alt_tag; ?>"> 
                <h3 class="ms-layer banner-title" 
                    style="top: 400px;"
                    data-type="text" 
                    data-effect="rotate3dtop(70,0,0,180)"
                    data-duration="2000" 
                    data-ease="easeInOutQuint">
                        <?php echo $data->title; ?>
                </h3>
                <span class="ms-layer seprator-title"
                      style="top: 460px;"
                      data-effect="skewleft(18,35|100)"
                      data-delay="2000"
                      data-duration="400" 
                      data-ease="linear">
                </span>
                <h3 class="ms-layer"
                    style="top: 490px;"
                    data-type="text" 
                    data-effect="rotate3dbottom(-70,0,0,180)"
                    data-duration="2000" 
                    data-ease="easeInOutQuint">
                        <?php echo $data->subtitle; ?>
                </h3>
            </div>
        <?php } ?>
    <?php } ?>
</section>

