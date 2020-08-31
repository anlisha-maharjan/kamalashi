<?php

class Advertisement_model extends MY_Model
{

    public $table = 'tbl_advertisement';
    public $id = '', $name = '',$link='',$image = '', $created_on = '', $created_by = '', $updated_by = '', $updated_on = '', $status = '', $is_default='';

    public function rules()
    {
        $rules = [
            [
                'field' => 'name',
                'label' => 'Advertisement Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'image',
                'label' => 'Advertisement Image',
                'rules' => 'trim'
            ]
        ];
        return $rules;
    }

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = $this->created_by = $this->updated_by = $this->updated_timestamp = true;
    }

}