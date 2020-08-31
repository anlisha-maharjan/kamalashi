<?php

class Accomodation_model extends MY_Model {

    public $table = 'tbl_accomodation';
    public $id = '', $name = '', $subtitle = '', $slug = '', $capacity = '', $price = '', $short_description = '', $long_description = '', $cover_image = '', $total_count = '', $availability_flag = '', $total_booked = '', $category_id = '', $status = '', $orderNumber = '', $max_child = '';

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
                'label' => 'Name',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'cover_image',
                'label' => 'Cover Image',
                'rules' => 'trim',
            )
        );

        return $array;
    }

    public function getSavedMedia($id) {
        $query = "select * from `tbl_accomodation_media` am where am.`accomodation_id` = $id";
        return $this->query($query);
    }

    public function getAvailableAccomodation() {
        $query = "select
                    a.*
                    from tbl_accomodation a
                    where a.status = 'Active' and a.`availability_flag` = '0'
                    ORDER BY a.orderNumber asc";
        $res = $this->query($query);
        $finList = array();
        if (isset($res) && !empty($res)) {

            foreach ($res as $ind => $resultval) {
                $menuListGen = array();

                if (!empty($resultval)) {
                    foreach ($resultval as $resultind => $val) {
                        $menuListGen[$resultind] = $val;
                    }


                    $menuListGen["childList"] = Accomodation_model::getSavedMedia($resultval->id);

                    array_push($finList, $menuListGen);
                }
            }
        }

        return $finList;
    }

    
    public function getAccomodationDetail($slug) {
        $query = "select
                    a.*
                    from tbl_accomodation a
                    where a.status = 'Active'
                    and a.slug='$slug'";
        $res = $this->query($query);
        $finList = array();
        if (isset($res) && !empty($res)) {

            foreach ($res as $ind => $resultval) {
                $menuListGen = array();

                if (!empty($resultval)) {
                    foreach ($resultval as $resultind => $val) {
                        $menuListGen[$resultind] = $val;
                    }


                    $menuListGen["childList"] = Accomodation_model::getSavedMedia($resultval->id);

                    array_push($finList, $menuListGen);
                }
            }
        }

        return $finList;
    }

    public function getAccomodation() {
        $query = "select
                    a.*
                    from tbl_accomodation a
                    where a.status = 'Active'
                    ORDER BY a.orderNumber asc";
        $res = $this->query($query);
        $finList = array();
        if (isset($res) && !empty($res)) {

            foreach ($res as $ind => $resultval) {
                $menuListGen = array();

                if (!empty($resultval)) {
                    foreach ($resultval as $resultind => $val) {
                        $menuListGen[$resultind] = $val;
                    }


                    $menuListGen["childList"] = Accomodation_model::getSavedMedia($resultval->id);

                    array_push($finList, $menuListGen);
                }
            }
        }

        return $finList;
    }

}
