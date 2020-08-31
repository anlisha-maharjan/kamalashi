<?php

class Activitylog extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model', 'common');
        $this->data['module_name'] = 'Activity Log';
        $this->data['show_add_link'] = false;
        $this->data['show_sort_link'] = false;
        $this->header['page_name'] = $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'Activity Log List';
        $this->data['body'] = BACKENDFOLDER.'/activitylog/_list';
        $this->render();
        /*$this->data['activity_log_data'] = array();
        $this->common->table = 'tbl_activity_log';
        $datas = $this->common->get('10');
        if ($datas) {
            foreach ($datas as $key => $data) {
                $this->data['activity_log_data'][$key] = $data;
                if ($data->user_id != '') {
                    $query = "SELECT name,username,email FROM tbl_user where id = " . $data->user_id;
                    $users = $this->db->query($query)->row();
                    $this->data['activity_log_data'][$key]->user_name = $users->name . '<p>' . $users->username . '</p>' . $users->email;

                } else {
                    $this->data['activity_log_data'][$key]->user_name = 'Ananomous User';
                }
            }

            $this->data['sub_module_name'] = 'Activity Log List';
            $this->data['body'] = BACKENDFOLDER . '/activitylog/_list';
            $this->render();
        }*/
    }

    public function get_activity_logs()
    {
        $columns = ['id', 'user_name', 'ip', 'url', 'created_on'];
        $this->load->model('user_model', 'user');
        $pageSize = $_GET['iDisplayLength'];
        $offset = $_GET['iDisplayStart'];
        $order_col = $_GET['iSortCol_0'];
        $order = $_GET['sSortDir_0'];
        $where = '';

        $total = $this->common->query("SELECT COUNT(*) as totalRows FROM tbl_activity_log");

        if(isset($searchQuery)) {
            $where = 'where cid like "%'.$searchQuery.'%"';
        }

        $query = "select
                    al.*,
                    (select name from tbl_user u where u.id = al.user_id) as user_name
                    from `tbl_activity_log` al
                    order by " . $columns[$order_col] . " " . $order."
                    limit $offset, $pageSize";
        $res = $this->common->query($query);

        $output = array(
            "sEcho"                => intval($_GET['sEcho']),
            "iTotalRecords"        => $total[0]->totalRows,
            "iTotalDisplayRecords" => $total[0]->totalRows,
            "aaData"               => array(),
        );

        $count = $offset + 1;
        if($res) {
            foreach($res as $row) {
                $resData[] = array(
                    $count,
                    $row->user_name ? $row->user_name : 'Anonymous',
                    $row->ip,
                    $row->url,
                    date('Y/m/d    h:i:a',$row->created_on)
                );
                $count++;
            }
            $output['aaData'] = $resData;
        }
        echo json_encode($output);
    }

    public function delete()
    {
        $post = $_POST;

        $this->load->library('restrict_delete');
        $params = "";
        if (isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $deleted = 0;
            foreach ($selected_ids as $selected_id) {
                if ($this->restrict_delete->check_for_delete($params, $selected_id)) {
                    $res = $this->banner->delete(array('id' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if ($this->restrict_delete->check_for_delete($params, $id)) {
                $id = segment(4);
                $res = $this->banner->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER . '/banner');
    }

}