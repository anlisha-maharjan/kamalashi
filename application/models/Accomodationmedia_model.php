<?php

class Accomodationmedia_model extends MY_Model
{

    public $table = 'tbl_accomodation_media';
    public $id = '', $accomodation_id = '', $media = '', $title = '', $caption = '', $description = '';

    public function __construct()
    {
        parent::__construct();
    }

}