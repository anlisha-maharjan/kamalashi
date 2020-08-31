<?php

class Event_model extends MY_Model {

    public $table = 'tbl_event';
    public $id = '', $name = '', $sub_title = '',$category_id = '',$start_date = '', $orderNumber = '', $end_date = '',$publish_date = '',$slug = '', $status = '', $short_description = '', $long_description = '',$created_by = '', $created_on = '', $updated_by = '', $updated_on = '',  $cover_image = '', $thumb_image = '', $featured = 'No';

    public function __construct() {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    public function rules($id) {
        $array = array(
            array(
                'field' => 'name',
                'label' => 'Title',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'long_description',
                'label' => 'Long Description',
                'rules' => 'trim',
            )
        );

        return $array;
    }

    public function getAllActive() {
        $query = "select * from $this->table
                    where `status` = 'Active'
                    ORDER BY id desc";

        return $this->query($query);
    }

    public function getBySlug($slug) {
        $query = "select
                   *
                    from $this->table
                    where `slug` = '{$slug}' and `status` = 'Active'";

        return $this->db->query($query)->row();
    }

    public function get_event($slug) {
        $query = "SELECT
                      *,
                      nd.`media`
                    FROM
                      tbl_event n
                      LEFT JOIN tbl_download_media nd
                      ON nd.`download_id` = n.`id` and nd.module_type = 'event'
                    WHERE n.`status` = 'Active' AND n.`slug` = '{$slug}'";

        return $this->query($query);
    }

    public function get_pagination($offset, $per_page = 6, $search = false, $tag_name = false, $all_count = false, $category_slug = false) {
        $query = "SELECT
                      *
                    FROM
                      tbl_event e
                    WHERE e.status = 'Active'";
        if (!$tag_name) {
            if ($search) {
                $query .= " AND ( e.`name` LIKE '%$search%'
                              OR e.`short_description` LIKE '%$search%'
                              OR e.`long_description` LIKE '%$search%' )";
            }
            if ($category_slug) {
                $category_id = $this->category->get('1', ['slug' => $category_slug]);
                $query .= " AND e.`category_id` = '{$category_id->id}'";
            }
        }
        $query .= " GROUP BY e.`id`";
        if (!$all_count) {
            $query .= " ORDER BY e.id DESC LIMIT $offset, $per_page";
            return $this->query($query);
        } else {
            return count($this->query($query));
        }
    }

    

}
