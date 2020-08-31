<?php

class Contact_model extends MY_Model {

    public $table = 'tbl_contact';
    public $id = '',
            $name = '',
            $address = '',
            $phone = '',
            $email = '',
            $message = '',
            $date = '';

    public function __construct() {
        parent::__construct();
    }

    

}
