<?php

class MY_Form_validation extends CI_Form_validation {

    function unique($value, $params) {

        $CI = & get_instance();

        $CI->form_validation->set_message('unique', 'The %s is already being used.');

        list($table, $field, $cur_id) = explode(".", $params, 3);

        $cur_id = (int) $cur_id;

        if ($cur_id)
            $CI->db->where('id != ', $cur_id);

        $query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row()) {
            return false;
        } else {
            return true;
        }
    }

    function exists($value, $params) {

        $CI = & get_instance();

        $CI->form_validation->set_message('exists', 'The %s does not exist.');

        list($table, $field) = explode(".", $params, 2);

        $query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();

        if (!$query->row()) {
            return false;
        } else {
            return true;
        }
    }

    //calling:: fixed_values[Active,Inactive]
    function fixed_values($value, $valid_values = '') {
        $this->CI->form_validation->set_message('fixed_values', 'The %s is invalid.');

        if ($valid_values == '') {
            $array = array('Yes', 'No');
        } else {
            $array = explode(',', $valid_values);
        }

        return (in_array(trim($value), $array)) ? TRUE : FALSE;
    }

    function url($value) {
        
    }

}

?>