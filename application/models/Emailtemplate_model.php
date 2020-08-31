<?php

class Emailtemplate_model extends MY_Model
{

    public $table = 'tbl_email_template';
    public $id = '',  $name = '', $adminEmail = '', $adminSubject = '', $status = '', $adminMessage = '',
         $userSubject = '', $userMessage = '';

    public function __construct()
    {
        parent::__construct();
        $this->updated_timestamp = false;
        $this->updated_by = false;
    }

    public function rules($id)
    {
        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Email Template Name',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'userSubject',
                'label' => 'userSubject',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'userMessage',
                'label' => 'userMessage',
                'rules' => 'required',
            )
        );

        return $rules;
    }

    public function getAllData()
    {
        $query = "select t.id ,t.name ,t.status
                    from tbl_email_template as t
                    order by t.name asc";
        return $this->query($query);
    }

}