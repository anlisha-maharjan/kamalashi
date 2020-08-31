<?php

class Menu_model extends MY_Model {

    public $table = 'tbl_menu';
    public $id = '', $menu_title = '', $menu_alias = '', $menu_type = '', $menu_link_type = '',$menu_parent = '', $link = '',$front_display = '',$description = '',$orderNumber = '',$menu_banner = '',$icon = '', $meta_title = '', $meta_description = '',$status = '';

    public function rules($id) {
        $array = array(
            array(
                'field' => 'menu_title',
                'label' => 'Menu Title',
                'rules' => 'trim|required',
            ), array(
                'field' => 'menu_alias',
                'label' => 'Menu Alias',
                'rules' => 'trim|required|unique[tbl_menu.menu_alias.' . $id . ']',
            ), array(
                'field' => 'meta_title',
                'label' => 'Meta Title',
                'rules' => 'trim|required',
            ), array(
                'field' => 'meta_description',
                'label' => 'Meta Description',
                'rules' => 'trim|required',
            )
        );

        return $array;
    }

   

    public function __construct() {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;
    }

    function alpha_dash_space($str) {
        return (!preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    }

    public function get_menutypes() {
        $sql = "SELECT * FROM `tbl_menu_types`";

        $result = $this->query($sql);

        return $result;
    }

    public function get_menulinktype() {
        $sql = "SELECT linktype, title  FROM `tbl_menu_link_types`";

        $results = $this->query($sql);

        if ($results) {
            foreach ($results as $key => $data) {
                $result[$data->linktype] = $data->title;
            }
        }
        return $result;
    }

    public function get_menulinks($key) {
        if ($key == 'content') {
            $sql = "SELECT id,name FROM tbl_content";
            $results = $this->query($sql);
            if (empty($results)) {
                return [];
            }
            foreach ($results as $data) {
                $result[$data->id] = $data->name;
            }
        } elseif ($key == 'url') {
            $result = 'text';
        } else {
            $result = 'none';
        }
        return $result;
    }

    public function getAllData($parent = 0, $padding = 0) {

        $query = "SELECT *
                  FROM tbl_menu
                  WHERE menu_parent='" . $parent . "'
                  ORDER BY `menu_type`, `orderNumber` DESC";

        $result = $this->query($query);

        $finList = array();

        if (isset($result) && !empty($result)) {

            foreach ($result as $ind => $resultval) {
                $menuListGen = array();

                if (!empty($resultval)) {
                    foreach ($resultval as $resultind => $val) {
                        $menuListGen[$resultind] = $val;
                    }

                    $menuListGen["cellpadding"] = $padding;
                    $menuListGen["childList"] = Menu_Model::getAllData($resultval->id, ($padding + 10));

                    array_push($finList, $menuListGen);
                }
            }
        }

        return $finList;
    }

    public function getNavigationByPosition($position) {
        $query = "select
                    m.`id`,
                    m.`menu_title`,
                    m.`menu_alias`,
                    m.`menu_parent`,
                    m.`menu_link_type`,
                    m.`link`,
                    m.description,
                    m.icon,
                    m.`orderNumber`
                    from `tbl_menu` m
                    where m.`menu_type` = '{$position}'
                    and m.`status` = 'Active'
                    and m.front_display='yes'
                    order by m.`orderNumber` asc";
        $menu = $this->query($query);
        $resp = array();
        if ($menu) {
            foreach ($menu as $menuRow) {
                if ($menuRow->menu_parent == 0) {
                    $resp['parents'][] = $menuRow;
                } else {
                    $resp['children'][$menuRow->menu_parent][] = $menuRow;
                }
            }
        }
        return $resp;
    }

    public function getMainNavigationByPosition($position, $parent = 0) {
        $query = "select
                    m.`id`,
                    m.`menu_title`,
                    m.`menu_alias`,
                    m.`menu_parent`,
                    m.`menu_link_type`,
                    m.`link`,
                    m.description,
                    m.icon,
                    m.`orderNumber`
                    from `tbl_menu` m
                    where m.`menu_type` = '{$position}'
                    and m.`status` = 'Active'
                    and m.front_display='yes'
                    and  menu_parent='{$parent}'
                    order by m.`orderNumber` asc";

        $menu = $this->query($query);

        $finList = array();

        if (isset($menu) && !empty($menu)) {

            foreach ($menu as $ind => $resultval) {
                $menuListGen = array();

                if (!empty($resultval)) {
                    foreach ($resultval as $resultind => $val) {
                        $menuListGen[$resultind] = $val;
                    }


                    $menuListGen["childList"] = Menu_Model::getMainNavigationByPosition('mainmenu', $resultval->id);

                    array_push($finList, $menuListGen);
                }
            }
        }

        return $finList;
    }

    public function getAllMenuParent() {
        $query = "select
                    m.`id`,
                    m.`menu_title`
                    from `tbl_menu` m";
        return $this->query($query);
    }

    public function getAllMenuParentByType($menutype) {
        $query = "select m.`id`, m.`menu_title` from `tbl_menu` m where m.`menu_type` = '{$menutype}' ";
        return $this->query($query);
    }

    public function get_category_type() {
        $this->load->model('common_model', 'common');
        $this->common->table = 'tbl_category_type';
        return $this->common->get();
    } 
}
