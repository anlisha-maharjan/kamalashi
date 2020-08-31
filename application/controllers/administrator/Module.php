<?php

class Module extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('module_model', 'module');
        $this->data['module_name'] = 'Module Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = $this->data['module_name'];
        $this->data['body'] = BACKENDFOLDER.'/module/_list';
        $this->data['modules'] = $this->module->get();
        $this->render();
    }
    
    public function create()
    {
        $modules = $this->module->get('', array('parent_id' => 0));
        $select_module = get_select($modules, 'Select Parent Module');
        $this->data['modules'] = $select_module;
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            $this->module->id = $id;

            $this->form_validation->set_rules($this->module->rules);
            if($this->form_validation->run()) {
                if($id == '') {
                    $res = $this->module->save($post);
                } else {
                    $condition = array('id' => $id);
                    $res = $this->module->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                redirect(BACKENDFOLDER.'/module');
            } else {
                $this->form($id, 'module');
            }
        } else {
            $this->form($id, 'module');
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
                    $res = $this->module->delete(array('id' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if($this->restrict_delete->check_for_delete($params, $id)) {
                $res = $this->module->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/module');
    }

}