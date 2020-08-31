<?php

class Module_model extends MY_Model
{

    public $table = 'tbl_module';

    public $id = '',
            $name = '',
            $slug = '',
            $priority = '',
            $parent_id = '',
            $icon_class = '',
            $show_in_navigation = '';

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    public $rules =
        array(
            array(
                'field' => 'name',
                'label' => 'Module Name',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'slug',
                'label' => 'Module Alias',
                'rules' => 'trim|required',
            ),
        );
}