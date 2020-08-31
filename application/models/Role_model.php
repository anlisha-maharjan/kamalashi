<?php

class Role_model extends MY_Model
{

    public $table = 'tbl_role';

    public $id = '',
        $name = '',
        $description = '';

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    public function rules($id)
    {
        $array = array(
            array(
                'field' => 'name',
                'label' => 'Role',
                'rules' => 'trim|required|unique['.$this->table.'.name.'.$id.']',
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'trim|required',
            )
        );

        return $array;
    }

    public function getRoles() {
        $this->db->select('id, name');
        $result = $this->db->get($this->table)->result();

        return (isset($result) && !empty($result)) ? $result : array();
    }

}