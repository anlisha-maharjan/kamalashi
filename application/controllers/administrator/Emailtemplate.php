<?php

class Emailtemplate extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('emailtemplate_model', 'emailtemplate');
        $this->data['module_name'] = 'Email Template Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    function _remap($method)
    {
        $param_offset = 2;

        // Default to index
        if (!method_exists($this, $method)) {
            // We need one more param
            $param_offset = 1;
            $method = 'index';
        }

        // Since all we get is $method, load up everything else in the URI
        $params = array_slice($this->uri->rsegment_array(), $param_offset);

        // Call the determined method with all params
        call_user_func_array(array($this, $method), $params);
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'Email Template List';
        $this->data['emailtemplates'] = $this->emailtemplate->getAllData();
        $this->data['body'] = BACKENDFOLDER . '/emailtemplate/_list';
        $this->render();

    }

    public function create()
    {
        $id = segment(4);
        if ($_POST) {
            $post = $_POST;
            $this->emailtemplate->id = $id;

            $this->form_validation->set_rules($this->emailtemplate->rules($id));
            if ($this->form_validation->run()) {
                if ($id == '') {
                    $res = $this->emailtemplate->save($post);
                } else {
                    $condition = array('id' => $id);
                    $res = $this->emailtemplate->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                redirect(BACKENDFOLDER . '/emailtemplate');
            } else {
                $this->form($id, 'emailtemplate');
            }
        } else {
            $this->form($id, 'emailtemplate');
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
                    $res = $this->emailtemplate->delete(array('id' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if($this->restrict_delete->check_for_delete($params, $id)) {
                $res = $this->emailtemplate->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/emailtemplate');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->emailtemplate->changeStatus('emailtemplate', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->emailtemplate->changeStatus('emailtemplate', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/emailtemplate');
    }

}