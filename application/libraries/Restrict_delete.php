<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restrict_delete {

    public function check_for_delete($params, $id) {
        //echo $params.'---'.$id;die;
        //example of $params = "table1.field1 | table2.field2 | table3.field3"
        //$params = "" for not checkingss
        if (!$params) {
            return true;
        }
        $CI = & get_instance();
        $arrays = explode('|', $params);
        foreach ($arrays as $array) {
            list($table, $field) = explode(".", $array, 2);
            $query = $CI->db->select($field)->from(trim($table))->where(trim($field), $id)->limit(1)->get();

            if ($query->row()) {
                return false; //can't be deleted
            } /* else {
              die('b');
              } */
        }
        return true; //can be deleted
    }

}

?>