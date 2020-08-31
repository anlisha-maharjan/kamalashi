<?php

class Category extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->load->model('menu_model', 'menu');
        $this->data['module_name'] = 'Category Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'Category List';
        $this->data['categories'] = $this->category->getAllData();
        $this->data['body'] = BACKENDFOLDER.'/category/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);
        $this->data['menu'] = $this->menu->get();
        $this->data['categoryType'] = $this->category->getCategoryType();
        
        if($_POST) {
            $post = $_POST;
            if(isset($post['only_save'])){
                $only_save='save';
            }
            if(isset($post['save_new'])){
                $save_new='save and new';
            }
            unset($post['only_save'],$post['save_new']);
            $this->category->id = $id;

            $this->form_validation->set_rules($this->category->rules($id));
            if($this->form_validation->run()) {
                $post['slug'] = $this->category->createSlug($post['name'], $id);
                if($id == '') {
                    $res = $this->category->save($post);
                } else {
                    $condition = array('id' => $id);
                    $res = $this->category->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/category/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/category/create');
                else
                    redirect(BACKENDFOLDER.'/category');
            } else {
                $this->form($id, 'category');
            }
        } else {
            $this->form($id, 'category');
        }
    }


    public function unique_category($name)
    {
        $id = $this->category->id;
        $category = $this->category->get(1, array('id' => $id));
        if($category) {
            $old_category = $category->name;
            if ($name == $old_category)
                return true;
        }
        $unique_category = $this->category->get(1, array('name' => $name));
        if ($unique_category) {
            $this->form_validation->set_message('unique_category', 'The Category already exists.');

            return false;
        }
        return true;
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
                    $res = $this->category->delete(array('id' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if($this->restrict_delete->check_for_delete($params, $id)) {
                $res = $this->category->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/category');
    }


    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->category->changeStatus('category', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->category->changeStatus('category', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/category');
    }


}