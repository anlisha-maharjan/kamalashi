<?php

class Rolemodule_model extends MY_Model
{

    public $table = 'tbl_role_module';
    public $id = '', $module_id = '', $role_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = false;
    }

}