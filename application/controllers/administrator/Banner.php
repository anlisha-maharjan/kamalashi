<?php

class Banner extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('banner_model', 'banner');
        $this->data['module_name'] = 'Banner Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $query = "SELECT * FROM `tbl_banner` ORDER BY orderNumber ASC";
        $this->data['sub_module_name'] = 'Banner List';
        $this->data['banners'] = $this->banner->query($query);
        $this->data['body'] = BACKENDFOLDER.'/banner/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);
        $this->data['categories'] = $this->banner->activeCategories(7);
        if($_POST) {
            $post = $_POST;
            if(isset($post['only_save'])){
                $only_save='save';
            }
            if(isset($post['save_new'])){
                $save_new='save and new';
            }
            unset($post['only_save'],$post['save_new']);
            $this->banner->id = $id;

            $this->form_validation->set_rules($this->banner->rules);
            if($this->form_validation->run()) {
                $post['slug'] = $this->banner->createSlug($post['title'], $id);
                if($id == '') {
                    $res = $this->banner->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->banner->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/banner/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/banner/create');
                else
                redirect(BACKENDFOLDER.'/banner');
            } else {
                $this->form($id, 'banner');
            }
        } else {
            $this->form($id, 'banner');
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
                    $res = $this->banner->delete(array('id' => $selected_id));
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
                $res = $this->banner->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/banner');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->banner->changeStatus('banner', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->banner->changeStatus('banner', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/banner');
    }

}