<?php

class Content_model extends MY_Model
{

    public $table = 'tbl_content';
    public $id = '', $name = '', $sub_title = '',$short_description = '', $long_description = '',$cover_image='', $image = '', $file='',$link = '', $meta_description = '', $meta_keyword = '',$slug = '', $status = '', $category_id = '',  $publish_date = '',$featured ='No',$orderNumber = '';

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
                'label' => 'Title',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'short_description',
                'label' => 'Short Description',
                'rules' => 'trim',
            ),
            array(
                'field' => 'long_description',
                'label' => 'Long Description',
                'rules' => 'trim',
            )
        );

        return $array;
    }

    public function getContentByCategory($categorySlug){
        $query = "select c.*
                    from `tbl_content` c
                    join `tbl_category` cat
                    on cat.`id` = c.`category_id`
                    where c.`featured` = 'Yes'
                    and c.`status` = 'Active'
                    and cat.`slug` = '{$categorySlug}'
                    order by c.`orderNumber` asc";

        return $this->query($query);
    }

  
    public function getByCategory($category)
    {
        $query = "select
                    c.`name`,
                    c.`long_description`,
                    c.`short_description`,
                    c.`slug`,
                    c.`image`,
                    c.`cover_image`
                    from `tbl_content` c
                    join `tbl_category` cat
                    on cat.`id` = c.`category_id`
                    where c.`status` = 'Active'
                    and cat.`slug` = '{$category}'
                    order by c.`orderNumber` asc";

        return $this->query($query);
    }

    public function getById($id)
    {
        $query = "select
                    c.`id`,
                    c.`name`,
                    c.`long_description`,
                    c.`short_description`,
                    c.`slug`,
                    c.`image`,
                    c.`cover_image`
                    from `tbl_content` c
                    join `tbl_category` cat
                    on cat.`id` = c.`category_id`
                    where c.`status` = 'Active'
                    and cat.`id` = '{$id}'
                    order by c.`orderNumber` asc";

        return $this->query($query);
    }

    
}