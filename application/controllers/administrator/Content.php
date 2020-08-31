<?php

class Content extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('content_model', 'content');
        $this->load->model('menu_model', 'menu');
        $this->load->model('common_model', 'common');
        $this->data['module_name'] = 'Content Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $query = "SELECT g.*
                  FROM `tbl_content` g
                  ORDER BY g.`orderNumber`";
        $this->data['sub_module_name'] = 'Content List';
        $this->data['contents'] = $this->content->query($query);
        $this->data['body'] = BACKENDFOLDER.'/content/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);
        $this->data['categories'] = $this->content->activeCategories(9);
         
        if($_POST) {
            $post = $_POST;
            
            
            if(isset($post['only_save'])){
                $only_save='save';
            }
            if(isset($post['save_new'])){
                $save_new='save and new';
            }
            
            unset($post['only_save'],$post['save_new']);
            
            $this->content->id = $id;

            $this->form_validation->set_rules($this->content->rules($id));
            if($this->form_validation->run()) {
                $post['publish_date'] = ($post['publish_date'] != '') && ($post['publish_date'] == '0000-00-00') ? $post['publish_date'] : date('Y-m-d', time());
                $post['featured'] = isset($post['featured']) ? 'Yes' : 'No';
                $post['slug'] = $this->content->createSlug($post['name'], $id);
                
                if($id == '') {
                    $res = $this->content->save($post, '', true);
                    $id = $res;
                } else {
                    
                    $condition = array('id' => $id);
                    $res = $this->content->save($post, $condition);
                }
               

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');

                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/content/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/content/create');
                else
                    redirect(BACKENDFOLDER.'/content');
            } else {
                $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js', 'assets/'.BACKENDFOLDER.'/js/pages/content.js','assets/common-vendor/select2/select2.min.js');
                $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css','assets/common-vendor/select2/select2.min.css');
                $this->form($id, 'content');
            }
        } else {
            $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js', 'assets/'.BACKENDFOLDER.'/js/pages/content.js','assets/common-vendor/select2/select2.min.js');
            $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css','assets/common-vendor/select2/select2.min.css');
            $this->form($id, 'content');
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
                    $res = $this->content->delete(array('id' => $selected_id));
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
                $res = $this->content->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/content');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->content->changeStatus('content', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->content->changeStatus('content', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/content');
    }


}