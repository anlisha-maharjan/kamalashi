<?php

class Countries_model extends MY_Model
{

    public $table = 'tbl_countries';
    public $id = '', $name = '',$iso_code='', $isd_code = '';

    public function rules($id)
    {
        $array = array();

        return $array;
    }

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }


}