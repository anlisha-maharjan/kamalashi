<?php

class Booking_model extends MY_Model {

    public $table = 'tbl_booking';
    public $id = '',
            $firstname = '',
            $lastname = '',
            $address = '',
            $phone = '',
            $email = '',
            $country = '',
            $json_data ='',
            $check_in = '',
            $check_out = '',
            $adults = '',
            $children = '',
            $payment_method = '',
            $additional_info = '',
            $status = '',
            $booked_date = '';
            

    public function __construct() {
        parent::__construct();
    }

    

}
