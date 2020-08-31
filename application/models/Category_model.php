<?php

class Category_model extends MY_Model
{

    public $table = 'tbl_category';
    public $id = '', $name = '',$subtitle='', $slug = '', $status = '', $type = '',$is_deletable = '',$icon='';

    public function rules($id)
    {
        $array = array(
            array(
                'field' => 'name',
                'label' => 'Category Name',
                'rules' => 'trim|required|unique[tbl_category.id.'.$id.']',
            )
        );

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

    public function getCategoryType()
    {
        $query = "select
                    *
                    from `tbl_category_type`";
        return $this->query($query);
    }

    public function getAllData($parent = 0, $padding = 0)
    {
        $query = "select
                    cat.`id`,
                    cat.`status`,
                    cat.`name`,
                    cat.`is_deletable`,
                    catType.`name` as categoryType
                    from `tbl_category` cat
                    join `tbl_category_type` catType on cat.`type` = catType.`id`
                    ORDER BY cat.id DESC ";
        
        $result = $this->query($query);
        return $result;
        
    }


}