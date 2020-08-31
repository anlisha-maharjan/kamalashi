<?php

class Service extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model', 'service');
        $this->load->model('common_model', 'common');
        $this->load->model('category_model', 'category');
        $this->data['module_name'] = 'Service Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'Service List';
        $this->data['services'] = $this->service->get();
        $this->data['body'] = BACKENDFOLDER.'/service/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);
        $this->data['categories'] = $this->category->get('', ['type' => 8]);
        
        if($_POST) {
            $post = $_POST;
            
            if(isset($post['only_save'])){
                $only_save='save';
            }
            if(isset($post['save_new'])){
                $save_new='save and new';
            }
            
            unset($post['only_save'],$post['save_new']);
            $this->service->id = $id;

            $this->form_validation->set_rules($this->service->rules($id));
            if($this->form_validation->run()) {
                $post['slug'] = $this->service->createSlug($post['name'], $id);
                $post['featured'] = isset($post['featured']) ? 'Yes' : 'No';

                if($id == '') {
                    $res = $this->service->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->service->save($post, $condition);
                }
                
                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                
                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/service/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/service/create');
                else
                redirect(BACKENDFOLDER.'/service');
            } else {
                $this->data['addJs'] = array('assets/common-vendor/select2/select2.min.js');
                $this->data['addCss'] = array('assets/common-vendor/select2/select2.min.css');
                $this->form($id, 'service');
            }
        } else {
            $this->data['addJs'] = array('assets/common-vendor/select2/select2.min.js');
            $this->data['addCss'] = array('assets/common-vendor/select2/select2.min.css');
            
            $this->form($id, 'service');
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
                    $res = $this->service->delete(array('id' => $selected_id));
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
                $res = $this->service->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }
        redirect(BACKENDFOLDER.'/service');
    }

    public function unique_service($name)
    {
        $id = $this->service->id;
        $service = $this->service->get(1, array('id' => $id));
        if($service) {
            $old_service = $service->name;
            if ($name == $old_service)
                return true;
        }
        $unique_service = $this->service->get(1, array('name' => $name));
        if ($unique_service) {
            $this->form_validation->set_message('unique_service', 'The Service     already exists.');

            return false;
        }
        return true;
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->service->changeStatus('service', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->service->changeStatus('service', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/service');
    }

}