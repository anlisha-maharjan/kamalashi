<?php

class Configuration_model extends MY_Model {

    public $table = 'tbl_configuration';
    public $id = '', $site_title = '', $address = '', $phone = '', $fax = '', $facebook = '', $twitter = '', $gplus = '', $skype = '', $instagram = '', $meta_keyword = '', $meta_description = '', $site_email = '', $site_logo = '', $latitude = '', $longitude = '',  $status = '', $youtube = '', $linkedin = '',$no_rooms='',$no_staffs='',$no_menu='';
    public $rules = array(
        array(
            'field' => 'site_title',
            'label' => 'Site Title',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'site_email',
            'label' => 'Site Email',
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim'
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => 'trim'
        ), array(
            'field' => 'fax',
            'label' => 'Fax',
            'rules' => 'trim'
        ),
        array(
            'field' => 'facebook',
            'label' => 'Facebook Link',
            'rules' => 'trim'
        ),
        array(
            'field' => 'twitter',
            'label' => 'Twitter Link',
            'rules' => 'trim'
        ),
        array(
            'field' => 'gplus',
            'label' => 'Google Plus Link',
            'rules' => 'trim'
        ),
        array(
            'field' => 'skype',
            'label' => 'Skype Link',
            'rules' => 'trim'
        ),
        array(
            'field' => 'latitude',
            'label' => 'latitude',
            'rules' => 'trim'
        ),
        array(
            'field' => 'longitude',
            'label' => 'longitude',
            'rules' => 'trim'
        ),
        array(
            'field' => 'image',
            'label' => 'Image',
            'rules' => 'trim'
        ),
        array(
            'field' => 'meta_keyword',
            'label' => 'Meta Keyword',
            'rules' => 'trim'
        ),
        array(
            'field' => 'meta_description',
            'label' => 'Meta Description',
            'rules' => 'trim'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

}
