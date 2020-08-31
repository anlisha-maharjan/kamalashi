<?php

class Advertisement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('advertisement_model', 'advertisement');
        $this->load->model('common_model', 'common');
        $this->data['module_name'] = 'Advertisement Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $query = "SELECT *
                  FROM `tbl_advertisement`
                  ORDER BY created_on DESC";
        $this->data['sub_module_name'] = 'Advertisement List';
        $this->data['advertisements'] = $this->advertisement->query($query);
        $this->data['body'] = BACKENDFOLDER.'/advertisement/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            if(isset($post['only_save'])){
                $only_save='save';
            }
            if(isset($post['save_new'])){
                $save_new='save and new';
            }
            unset($post['only_save'],$post['save_new']);
            $this->advertisement->id = $id;

            $this->form_validation->set_rules($this->advertisement->rules());
            if($this->form_validation->run()) {
                $post['is_default'] = isset($post['is_default']) ? 'Yes' : 'No';
                if($id == '') {
                    $res = $this->advertisement->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->advertisement->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                
                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/advertisement/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/advertisement/create');
                else
                redirect(BACKENDFOLDER.'/advertisement');
            } else {
                $this->form($id, 'advertisement');
            }
        } else {
            $this->form($id, 'advertisement');
        }
    }

    public function delete()
    {
        $post = $_POST;

        $this->load->library('restrict_delete');
        $params = "";
        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $deleted = 0;
            foreach($selected_ids as $selected_id){
                if($this->restrict_delete->check_for_delete($params, $selected_id)) {
                    $res = $this->advertisement->delete(array('id' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if($this->restrict_delete->check_for_delete($params, $id)) {
                $id = segment(4);
                $res = $this->advertisement->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/advertisement');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->advertisement->changeStatus('advertisement', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->advertisement->changeStatus('advertisement', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/advertisement');
    }

}