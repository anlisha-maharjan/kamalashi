<?php

class Service_model extends MY_Model
{

    public $table = 'tbl_service';
    public $id = '', $category_id = '',$name = '', $slug = '', $status = '', $image = '', $description = '',
        $created_by = '', $created_on = '', $updated_by = '', $updated_on = '', $short_description = '',
        $icon = '', $featured = 'No', $link = '',$orderNumber='';

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
        $rules =
            array(
                array(
                    'field' => 'name',
                    'label' => 'Service Name',
                    'rules' => 'trim|required|unique[tbl_service.name.'.$id.']',
                ),
                array(
                    'field' => 'image',
                    'label' => 'Service Image',
                    'rules' => 'trim',
                ),
                array(
                    'field' => 'link',
                    'label' => 'Service Link',
                    'rules' => 'trim',
                ),
                array(
                    'field' => 'short_description',
                    'label' => 'Service Short Description',
                    'rules' => 'trim|required',
                )
            );

        return $rules;
    }
   
    
    public function getServiceByCategory($categorySlug){
        $query = "select c.*
                    from `tbl_service` c
                    join `tbl_category` cat
                    on cat.`id` = c.`category_id`
                    where c.`featured` = 'Yes'
                    and c.`status` = 'Active'
                    and cat.`slug` = '{$categorySlug}'
                    order by c.`orderNumber` asc";

        return $this->query($query);
    }

    
}