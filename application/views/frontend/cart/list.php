<!-- *************** Start Inner Page Banner *************** -->
<section class="inner-banner">
    <h3>Hotel Cart</h3>
    <img class="img-responsive" src="<?php echo base_url() . 'uploads/banner/menu/default-banner.png'; ?>" alt="default-banner.jpg">
</section>
<!-- *************** End Inner Page Banner *************** -->
<?php echo display_breadcrumb_front($breadcrumb); ?>
<?php
$session_array = $_SESSION;
unset($session_array['__ci_last_regenerate'], $session_array['checkin'], $session_array['checkout'], $session_array['adult'], $session_array['children']);
?>
<section id="booking-cart">
    <div class="container">
        <h3 class="text-gold">Your Bookings</h3>
        <div class="table-responsive">
            <?php if (isset($session_array) && !empty($session_array)) : ?>
                <table id="cart_table" class="table table-cart">
                    <thead>
                    <th>Room</th>
                    <th>Quantity</th> 
                    <!--<th>Night</th>-->
                    <th>Price</th>
                    <th style="width: 70px;"></th>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($session_array as $key => $res) :
                            $this->load->model('accomodation_model', 'accomodation');
                            $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                            if (isset($accomodata) && !empty($accomodata)):
                                ?>
                                <tr class="cart">
                            <input type="hidden" class="roomSlug" name="<?php echo $accomodata->slug; ?>" value="<?php echo $accomodata->slug; ?>" />
                            <td><?php echo $accomodata->name; ?></td>
                            <td class="text-center"><?php echo $res; ?></td>
                            <?php /* <td>
                              <?php
                              $checkindate = date_create($checkin);
                              $checkoutdate = date_create($checkout);
                              $diff = date_diff($checkindate, $checkoutdate);
                              echo $diff->format('%a');
                              ?>
                              </td> */ ?>
                            <td class="price text-right"><?php echo '$' . $res * $accomodata->price; ?></td>
                            <td class="text-center"><button class="delete"><img class="img-responsive" src="<?php echo base_url() . 'assets/front/images/icons/icon-close.png' ?>" alt=""></button></td>    
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Sub Total</td>
                            <td></td>						
                            <td id="sub_total" class="text-right text-gold"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tax(1%)</td>
                            <td></td>
                            <td id="grand_total" class="text-right text-gold"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <button type="button" id="button_proceed" class="btn-light-golden">Proceed</button>
                <p class="empty_cart text-gold" style="display: none;">Your Cart is empty</p>
            <?php else: ?>
                <p class="text-gold">Your Cart is empty</p>
            <?php endif; ?>
        </div>
    </div>
</section>

