<?php

class Banner_model extends MY_Model
{

    public $table = 'tbl_banner';
    public $id = '', $title = '',$subtitle = '', $image = '', $status = '', $category_id = '', $description = '', $link = '', $secondary_image = '', $orderNumber = '';
    public $rules =
        array(
            array(
                'field' => 'image',
                'label' => 'Banner Image',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'category_id',
                'label' => 'Category',
                'rules' => 'trim',
            )
        );

    public function __construct()
    {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    
    public function getAllData()
    {
        $sql = "SELECT * FROM `tbl_banner` ORDER BY orderNumber ASC";

        $result = $this->query($sql);

        return $result;
    }
    
    public function getByCategory($category)
    {
        $query = "select
                    c.* 
                    from `tbl_banner` c
                    join `tbl_category` cat
                    on cat.`id` = c.`category_id`
                    where c.`status` = 'Active'
                    and cat.`slug` = '{$category}'
                    order by c.`orderNumber` asc";

        return $this->query($query);
    }

}