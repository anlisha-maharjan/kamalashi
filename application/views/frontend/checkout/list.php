<!-- *************** Start Inner Page Banner *************** -->
<section class="inner-banner">
    <h3>Hotel Checkout</h3>
    <img class="img-responsive" src="<?php echo base_url() . 'uploads/banner/menu/default-banner.png'; ?>" alt="default-banner.jpg">
</section>
<!-- *************** End Inner Page Banner *************** -->
<?php echo display_breadcrumb_front($breadcrumb); ?>
<?php
$session_array = $_SESSION;
unset($session_array['__ci_last_regenerate'], $session_array['checkin'], $session_array['checkout'], $session_array['adult'], $session_array['children']);
?>
<section id="checkout-section">
    <div class="container">
        <h4 class="text-gold">Your Bookings</h4>
        <form class="form-default" action="<?php echo base_url() . 'customerbooking' ?>" name="customerbooking" id="customerbooking" method="post">
            <?php if (isset($session_array) && !empty($session_array)) : ?>
                <div class="table-responsive">
                    <table class="table table-cart">
                        <thead>
                        <th>Room</th>
                        <th>Quantity</th> 
                        <th>Price</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($session_array as $key => $res) :
                                $this->load->model('accomodation_model', 'accomodation');
                                $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                                if (isset($accomodata) && !empty($accomodata)):
                                    ?>
                                    <tr>
                                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $res; ?>"/>
                                <td><?php echo $accomodata->name; ?></td>
                                <td class="text-center"><?php echo $res; ?></td>
                                <td class="price text-right"><?php echo '$' . $res * $accomodata->price; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?> 

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Sub Total</td>
                                <td></td>
                                <td id="sub_total" class="text-right text-gold"></td>
                            </tr>
                            <tr>
                                <td>Tax(1%)</td>
                                <td></td>
                                <td id="grand_total" class="text-right text-gold"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                <h4 class="text-gold">Customer Details</h4>
                <div class="row flex-row" style="margin-bottom: 40px;">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="firstname">First Name * </label>
                            <input type="text" name="firstname" class="form-control" id="firstname">
                            <span class="error firstname" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="lastname">Last Name *</label>
                            <input type="text" name="lastname" class="form-control" id="lastname">
                            <span class="error lastname" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="address">Address *</label>
                            <input type="text" name="address" class="form-control" id="address">
                            <span class="error address" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="phone">Phone *</label>
                            <input type="text" name="phone" class="form-control" id="phone">
                            <span class="error phone" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="text" name="email" class="form-control" id="email">
                            <span class="error email" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="country">Country *</label>
                            <select name="country" id="country" class="form-control">
                                <option selected disabled value>Select</option>
                                <?php foreach ($countries as $key => $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="error country" style="display:none"></span>
                        </div>
                    </div>
                </div>

                <h4 class="text-gold">Reservation Information</h4>

                <div class="row flex-row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label>Check In *</label>
                            <div class="icon-holder">
                                <input class="form-control" type="text" name="check_in" id="check_in" value="<?php echo get_userdata('checkin') ? get_userdata('checkin') : date('Y-m-d'); ?>">
                                <img class="icon-small" src="<?php echo base_url('assets/front/images/icons/icon-calendar.svg'); ?>" alt="Calendar" />
                            </div>
                            <span class="error check_in" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label>Check Out *</label>
                            <div class="icon-holder">
                                <input class="form-control" type="text" name="check_out" id="check_out" value="<?php echo get_userdata('checkout') ? get_userdata('checkout') : date('Y-m-d', strtotime("tomorrow")); ?>">
                                <img class="icon-small" src="<?php echo base_url('assets/front/images/icons/icon-calendar.svg'); ?>" alt="Calendar" />
                            </div>
                            <span class="error check_out" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label>Adults</label>
                            <input type="text" value="<?php echo get_userdata('adult') ? get_userdata('adult') : '1'; ?>" name="adult" id="adult"/>
                            <span class="error adult" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label>Childrens</label>
                            <input type="text" value="<?php echo get_userdata('children') ? get_userdata('children') : '0'; ?>" name="children" id="children"/>
                            <span class="error adult" style="display:none"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 "></div>
                    <div class="col-xs-12 col-sm-8 col-md-8 ">
                        <div class="form-group">
                            <label for="additional_info">Special Requirements</label>
                            <textarea class="form-control" name="additional_info" id="additional_info" rows="8"></textarea>
                            <span class="error additional_info" style="display:none"></span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="g-recaptcha" data-sitekey="6LeqVlAUAAAAAJBK5GBowL7cVAGx9tDSrZxxektu"></div>
                    <span class="error captcha" style="display:none"></span>
                </div>
                <!--                <div class="col-xs-12 col-sm-8 col-md-8 ">
                                    <div class="form-group">
                                        <img height="50px" id="captcha" src="<?php echo base_url('page/securimage'); ?>" alt='captcha' /> 
                                        <a id="reloadeded"><img src="<?php echo base_url() . 'assets/front/images/refresh.gif' ?>" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" style="cursor: pointer;" /></a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 ">
                                    <div class="form-group">
                                        <input name="code" id="code" type="text" class="form-control" placeholder="Enter security code here"/>
                                        <span class="error code" style="display:none"></span>
                                    </div>
                                </div>-->
                <div class="row flex-row" style="align-items: center">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <label class="custom-check">I agree to the
                            <input type="checkbox" id="agree" name="agree">
                            <span class="checkmark"></span>
                        </label>
                        <a style="text-decoration: underline; font-weight: 300;	" class="text-gold" href="#">terms & conditions.</a>
                        <span class="error agree" style="display:none"></span>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <button type="button" id="checkout" class="btn-light-golden">Checkout</button>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
</section>

