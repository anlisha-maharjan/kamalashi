<!-- *************** Start Inner Page Banner *************** -->
<section class="inner-banner">
    <h3>Hotel Booking Search</h3>
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

</section>
<!-- *************** End Inner Page Banner *************** -->
<?php echo display_breadcrumb_front($breadcrumb); ?>
<?php
$session_array = $_SESSION;
unset($session_array['__ci_last_regenerate'], $session_array['checkin'], $session_array['checkout'], $session_array['adult'], $session_array['children']);
?>
<section id="room-list-section">
    <div class="container">
        <h3>Our Available Rooms</h3>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-push-8 col-md-4">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <form class="reservation-check-form" id="checkAccomodationsForm" name="checkAccomodationsForm" action="<?php echo base_url('accomodations-available'); ?>" method="POST">
                            <div class="form-group">
                                <label>Check In</label>
                                <div class="date-holder">
                                    <input type="text" name="checkin-date" id="checkin-date" value="<?php echo get_userdata('checkin') ? get_userdata('checkin') : date('Y-m-d'); ?>">
                                    <img  src="<?php echo base_url('assets/front/images/icons/icon-calendar.svg'); ?>" alt="Calendar" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Check Out</label>
                                <div class="date-holder">
                                    <input type="text" name="checkout-date" id="checkout-date" value="<?php echo get_userdata('checkout') ? get_userdata('checkout') : date('Y-m-d', strtotime("tomorrow")); ?>">
                                    <img  src="<?php echo base_url('assets/front/images/icons/icon-calendar.svg'); ?>" alt="Calendar" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Adults</label>
                                        <input type="text" value="<?php echo get_userdata('adult') ? get_userdata('adult') : '1'; ?>" name="adult" id="adult"/>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Childrens</label>
                                        <input type="text" value="<?php echo get_userdata('children') ? get_userdata('children') : '0'; ?>" name="children" id="children"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn-light-golden" type="submit" id="check">Check Availability</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <!--<form action="<?php //echo base_url() . 'cart_checkout';         ?>" method="post" class="room-selection-list">-->
                        <form class="room-selection-list">
                            <h5>Your Bookings</h5>
                            <?php
                            foreach ($session_array as $key => $value):
                                $this->load->model('accomodation_model', 'accomodation');
                                $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                                if (isset($accomodata) && !empty($accomodata)):
                                    ?>
                                    <div class="rooms-selected">
                                        <input type="hidden" class="roomSlug" name="<?php echo $accomodata->slug; ?>" value="<?php echo $accomodata->slug; ?>" />
                                        <h5><span><?php echo $accomodata->name; ?></span><button><img class="img-responsive delete" src="<?php echo base_url() . 'assets/front/images/icons/icon-close.png'; ?>" alt=""></button></h5>
                                        <div class="form-group"><label>Quantity</label><span><?php echo $value; ?></span></div>
                                        <div class="form-group"><label>Price</label><span>$<?php echo $accomodata->price; ?></span></div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <div class="form-group go" <?php
                            if (isset($session_array) && !empty($session_array)) {
                                echo 'style="display:block"';
                            } else {
                                echo 'style="display:none"';
                            }
                            ?>>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 co-md-6">
                                        <!--<input type="submit" name="checkout" value="checkout" class="btn-light-golden"/>-->
                                        <button type="button"  id="button_checkout" class="btn-light-golden">checkout</button>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 co-md-6">
                                        <!--<input type="submit" name="cart" value="View Cart" class="btn-light-golden"/>-->
                                        <button type="button" id="button_cart" class="btn-light-golden">View Cart</button>
                                    </div>
                                </div>
                            </div>   
                        </form>
                        <!--</form>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-pull-4">
                <?php if (isset($accomodation) && !empty($accomodation)): ?>
                    <?php foreach ($accomodation as $key => $data): ?>
                        <div class="rooms-lists">
                            <figure style="background-image: url(<?php echo base_url() . $data['cover_image']; ?>)"></figure>
                            <div class="rooms-desc">
        <!--                                <h5 class="text-gold name"><a href="<?php //echo base_url() . 'accomodation/' . $data['slug'];                              ?>"><?php //echo $data['name']                              ?></a></h5>-->
                                <h5 class="text-gold name"><?php echo $data['name'] ?></h5>
                                <?php echo $data['short_description'] ?>
                                <form>
                                    <div class="form-group">
                                        <label >capacity</label>
                                        <span class="text-light-gold"><?php echo $data['capacity'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label >max child</label>
                                        <span class="text-light-gold" ><?php echo $data['max_child'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label >Quantity</label>
                                        <?php
                                        $booked = $data['total_booked'];
                                        if ($booked == '0' || $booked == '' || $booked == NULL) {
                                            $cnt = $data['total_count'];
                                        } else {
                                            $cnt = $data['total_count'] - $data['total_booked'];
                                        }
                                        ?>

                                        <select class="quantity" <?php
                                        if ($cnt == 0) {
                                            echo 'disabled';
                                        }
                                        ?>>
                                            <option disabled selected value>Select</option>
                                            <?php if ($cnt > 0): ?>
                                                <?php for ($i = 1; $i <= $cnt; $i++): ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            <?php endif; ?>  
                                        </select>
                                        <p class="error quantity_error" style="display: none;"></p>
                                    </div>
                                    <div class="form-group">
                                        <label >price</label>
                                        <span class="text-light-gold"><?php echo '$' . $data['price'] ?></span>
                                    </div>
                                    <div class="form-group">
                                        <span class="accomodation_id" style="display:none;"><?php echo $data['id']; ?></span>
                                        
                                        <button class="btn-light-golden SelectRoom"  <?php if ($cnt == 0) {echo 'disabled';}?>>select This Room</button>
									</div>
									<?php if ($cnt == 0) {echo '<div class="ribbon"><span>BOOKED</span></div>';}?>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

