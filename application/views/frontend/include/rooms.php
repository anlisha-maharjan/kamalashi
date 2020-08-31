<section id="rooms-selection-view">
    <div class="container">
        <!-- <div class="row"> -->
            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6"> -->
                <div class="rooms-selection-list-wrap">
                    <h6 class="text-gold">Discover our rooms</h6>
                    <h3 class="text-gold">Luxury interior</h3>
                    <!--Start Rooms Selection Vertical Slider-->
                    <div class="scroll-vertical">
                        <div id="rooms-selection-list">
                            <?php
                            if (isset($accomodation) && !empty($accomodation)) {
                                foreach ($accomodation as $data) {
                                    ?>
                                    <div class="rooms-thumb">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <figure>
                                                    <?php
                                                    $arr = explode('/', $data['cover_image']);

                                                    if (end($arr)) {
                                                        $alt_tag = str_replace('-', '', end($arr));
                                                    }
                                                    ?> 
                                                    <img class="img-responsive" src="<?php echo $data['cover_image']; ?>" alt="<?php echo $alt_tag; ?>"/>
                                                </figure>  
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 padding-left-5">
                                                <h5 class="text-gold"><?php echo $data['name']; ?></h5>
                                                <p class="text-light-gold"><?php echo $data['subtitle']; ?></p>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!--End Rooms Selection Vertical Slider-->
                </div>
            <!-- </div> -->
        <!-- </div> -->
    </div>
    <!--Start Selected Room Slide-->
    <div class="rooms-slides-wrap">
        <div id="rooms-slide">
            <!--Start Selected Room Slide-->
            <?php
            if (isset($accomodation) && !empty($accomodation)) {
                foreach ($accomodation as $data) {
                    ?>
                    <div class="selected-room-slide">
                        <?php
                        if (isset($data['childList']) && !empty($data['childList'])) {
                            foreach ($data['childList'] as $key => $childrens) {
                                ?>
                                <?php
                                $arr = explode('/', $childrens->media);

                                if (end($arr)) {
                                    $alt_tag = str_replace('-', '', end($arr));
                                }
                                ?> 
                                <img src="<?php echo $childrens->media; ?>" alt="<?php echo $alt_tag; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </div> 
                    <?php
                }
            }
            ?>
            <!--Start Selected Room Slide-->
        </div>
    </div>
    <!--End Selected Room Slide-->
</section>
