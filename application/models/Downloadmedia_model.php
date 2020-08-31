<?php

class Downloadmedia_model extends MY_Model
{

    public $table = 'tbl_download_media';
    public $id = '', $download_id = '',$module_type='', $file = '', $description = '';

    public function __construct()
    {
        parent::__construct();
    }

}