<?php

class Enquiry_model extends MY_Model {

    public $table = 'tbl_enquiry';
    public $id = '',
            $full_name = '',
            $address = '',
            $phone = '',
            $email = '',
            $message = '',
            $status = '',
            $enquired_date = '';

    public function __construct() {
        parent::__construct();
    }

    

}
