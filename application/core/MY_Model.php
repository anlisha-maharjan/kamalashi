<?php

class MY_Model extends CI_Model
{

    protected $table;
    protected $created_timestamp = false;
    protected $created_by = false;
    protected $updated_timestamp = false;
    protected $updated_by = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function setTable($table)
    {
        if($table != '')
            $this->table = $table;
    }

    public function get($limit = NULL, $condition = NULL, $order = '', $table = '', $group_by = '')
    {
        $this->setTable($table);
        $return_type = 'result';

        $this->db->from($this->table);

        if($order) {
            if($order == '')
                $order = 'id desc';
            $this->db->order_by($order);
        }

        if($group_by != '') {
            $this->db->group_by($group_by);
        }

        if($limit) {
            $this->db->limit($limit);
            if($limit == 1) {
                $return_type = 'row';
            }
        }

        if($condition) {
            $result = $this->get_by($condition);
        } else {
            $result = $this->db->get();
        }

        return $result->num_rows() > 0 ? $result->$return_type() : FALSE;
    }

    public function get_by($condition)
    {
        $result = $this->db->get_where('', $condition);

        return $result ? $result : FALSE;
    }

    public function save($data, $condition = NULL, $return_id = FALSE, $table = '')
    {
        $this->setTable($table);
        if ($this->db->field_exists('status', $this->table) && get_userdata('role_id') == 3) {
            $data['status'] = 'InActive';
        }
        if($condition) {
            if($this->updated_timestamp)
                $data['updated_on'] = time();
            if($this->updated_by)
                $data['updated_by'] = get_userdata('user_id') ? get_userdata('user_id') : NULL;
            $return = $this->db->update($this->table, $data, $condition);
        } else {
            if($this->created_timestamp)
                $data['created_on'] = time();
            if($this->created_by)
                $data['created_by'] = get_userdata('user_id') ? get_userdata('user_id') : NULL;
            if($this->updated_timestamp)
                $data['updated_on'] = time();
            if($this->updated_by)
                $data['updated_by'] = get_userdata('user_id') ? get_userdata('user_id') : NULL;
            $return = $this->db->insert($this->table, $data);
        }

        if($return) {
            $return = TRUE;
            if($return_id) {
                $return = $this->db->insert_id();
            }
        } else {
            $return = FALSE;
        }

        return $return;
    }

    public function delete($condition, $table = '')
    {
        $this->setTable($table);
        $return = $this->db->delete($this->table, $condition);

        return $return;
    }

    public function query($query)
    {
        $result = $this->db->query($query);

        return $result->num_rows() > 0 ? $result->result() : FALSE;
    }

    public function write_query($query)
    {
        $this->db->query($query);

        return true;
    }

    public function activeCategories($type = '1')
    {
        $result = $this->db->get_where('tbl_category', array('status' => 'Active', 'type' => $type));

        return $result->num_rows() > 0 ? $result->result() : FALSE;
    }

    public function createSlug($title, $id = '', $table = '')
    {
        $this->setTable($table);
        $ci = &get_instance();
        $config = array(
            'table' => $this->table,
            'id' => 'id',
            'field' => 'slug',
            'title' => $title,
            'replacement' => 'dash' // Either dash or underscore
        );

        $ci->slug->set_config($config);

        if($id == '')
            $slug = $ci->slug->create_uri($title);
        else
            $slug = $ci->slug->create_uri($title, $id);

        return $slug;
    }

    public function get_show_places()
    {
        $sql = "SELECT * FROM `tbl_show_places`";

        $result = $this->query($sql);

        return $result;
    }
    
    public function changeStatus($module, $status, $id, $other_id = NULL)
    {
        $data = array('status' => $status);

        if(!empty($other_id)) {
            $column_name = explode('_', $module)[0].'_id';
            $condition = array('id' => $id, $column_name => $other_id);
        } else {
            $condition = array('id' => $id);
        }

        return $this->$module->save($data, $condition);
    }
    public function get_single_data($table_name, $select_field, $value, $field = 'id')
    {
        $this->db->where($field, $value);
        $row = $this->db->get($table_name)->row();

        if (count($row) > 0) {
            return $row->$select_field;
        } else {
            return '';
        }
    }


}