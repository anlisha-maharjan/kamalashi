<?php

class Notice_model extends MY_Model
{

    public $table = 'tbl_notice';
    public $id = '', $name = '',$sub_title = '',$category_id = '', $short_description = '', $long_description = '',$cover_image='', $image = '', $slug = '',$status = '', $publish_date = '',   $expiry_date = '',$featured='',$orderNumber='';

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
            ),array(
                'field' => 'publish_date',
                'label' => 'Publish Date',
                'rules' => 'trim',
            ), array(
                'field' => 'expiry_date',
                'label' => 'Expiry Date',
                'rules' => 'trim',
            )
        );

        return $array;
    }

    

    public function getById()
    {
        $query = "select
                    c.`id`,
                    c.`name`,
                    c.`long_description`,
                    c.`short_description`,
                    c.`slug`,
                    c.`image`,
                    c.`cover_image`
                    from `tbl_notice` c
                    where c.`status` = 'Active'
                    order by c.`orderNumber` asc";

        return $this->query($query);
    }

    

    public function get_notice($slug = '')
    {
        $current_date = date('Y-m-d');
        if($slug == '') {
            $condition = " AND n.`publish_date` <= '{$current_date}'";
        } else {
            $condition = " AND n.`slug` = '{$slug}'";
        }
        $query = "SELECT
                      *,
                      nd.`media`
                    FROM
                      tbl_notice n
                      LEFT JOIN tbl_download_media nd
                      ON nd.`download_id` = n.`id` and nd.module_type = 'notice'
                    WHERE n.`status` = 'Active' $condition ORDER BY n.publish_date DESC ";

        return $this->query($query);
    }

    public function get_notices() {
        $query = "select * from tbl_notice e where e.status = 'Active'";
        return $this->query($query);
    }

    

}