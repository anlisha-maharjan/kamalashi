<section id="hero-discovery">
    <div class="container">
        <div class="row reverse">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <article class="section-desc-holder">
                    <?php
                    if (isset($serenity) && !empty($serenity)) {
                        foreach ($serenity as $key => $data) {
                            ?>
                            <h2 class="hidden-xs hidden-sm text-gold"><?php echo $data->name; ?></h2>
                            <?php if (isset($data->short_description) && !empty($data->short_description)) { ?>
                                <p class="text-light-gold"><?php
                                    echo strip_tags(substr($data->short_description, 0, 400));
                                    echo (strlen($data->short_description) > 400) ? '...' : '';
                                    ?>
                                </p> 
                                <a class="text-light-gold" href="<?php echo $data->link; ?>">More info</a>
                            <?php } ?>
                            <?php
                        }
                    }
                    ?>


                </article>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 text-right">
			<h2 class="hidden-md hidden-lg text-gold text-left"><?php echo $data->name; ?></h2>
                <form class="reservation-check-form text-gold" id="checkAccomodationsForm" name="checkAccomodationsForm" action="<?php echo base_url('accomodations-available');?>" method="POST">
                    <div class="row text-center">
                        <div class="col-xs-4 col-sm-4 col-md-offset-1 col-md-3">
                            <label>Check in</label>
                            <div class="date-holder checkin">
                                <input type="hidden" class="hidden-day" name="checkin-date" id="checkin-date" value="<?php echo date('Y-m-d')?>"/>
                                <span class="month checkinmonth"><?php echo date("F");?></span>
                                <span class="selected-day checkinday"><?php echo date("d");?></span>
                                <img class="cal-img" src="<?php echo base_url('assets/front/images/icons/icon-calendar.svg'); ?>" alt="Calendar" />
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-offset-1 col-md-3">
                            <label>Check out</label>
                            <div class="date-holder checkout">
                                <input type="hidden"  class="hidden-day" name="checkout-date" id="checkout-date" value="<?php echo date('Y-m-d',strtotime("tomorrow"));?>"/>
                                <span class="month checkoutmonth"><?php echo date("F");?></span>
                                <span class="selected-day checkoutday"><?php echo date("d")+1;?></span>
                                <img class="cal-img" src="<?php echo base_url('assets/front/images/icons/icon-calendar.svg'); ?>" alt="Calendar" />
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-offset-1 col-md-3">
                            <div class="form-group">
                                <label>Adults</label>
                                <input type="text" value="1" name="adult" id="adult"/>
                            </div>
                            <div class="form-group">
                                <label>Childrens</label>
                                <input type="text" value="0" name="children" id="children"/>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top-20">
                        <div class="col-md-6 text-light-gold">
                            <span class="display-block">Can we help you? Call us!</span>
                            <span class="display-block">01-4910000</span>
                        </div>
                        <div class="col-md-6">
                            <button class="btn-light-golden" type="submit" id="check">Check Availability</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <?php
            $count = 1;
            if (isset($services) && !empty($services)) {
                foreach ($services as $data) {
                    if ($count <= 3) {
                        ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <article class="product-wrap products-special-list text-center">
                                <figure>
                                    <?php
                                    $arr = explode('/', $data->image);

                                    if (end($arr)) {
                                        $alt_tag = str_replace('-', '', end($arr));
                                    }
                                    ?> 
                                    <img src="<?php echo $data->image; ?>" class="img-responsive" alt="<?php echo $alt_tag; ?>"/>
                                </figure>
                                <h4 class="text-gold"><?php echo $data->name; ?></h4>
                                <?php if (isset($data->short_description) && $data->short_description) { ?>
                                    <p class="text-light-gold"><?php
                                        echo strip_tags(substr($data->short_description, 0, 400));
                                        echo (strlen($data->short_description) > 400) ? '...' : '';
                                        ?>
                                    </p> 
                                <?php } ?>
                            </article>
                        </div>
                        <?php
                        $count ++;
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
