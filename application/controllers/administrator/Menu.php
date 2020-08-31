<?php
class Menu extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model', 'menu');
        $this->load->model('common_model', 'common');
        $this->data['module_name'] = 'Menu Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['menus'] = $this->menu->getAllData();
        $this->data['sub_module_name'] = 'Menu List';
        $this->data['body'] = BACKENDFOLDER.'/menu/_list';
        $this->render();
    }

    public function create()
    {

        $this->data['menu_type'] = $this->menu->get_menutypes();
        $this->data['menu_parents'] = $this->menu->getAllData();
        $this->data['parentMenus'] = $this->menu->getAllMenuParent();
        $this->data['menu_link_type'] = $this->menu->get_menulinktype();
        
        $this->data['addCss'] = [
            'assets/common-vendor/select2/select2.min.css'
        ];
        foreach ($this->data['menu_link_type'] as $key =>$data){
            $this->data['link_type'][$key] = $this->menu->get_menulinks($key);
        }
        

        $this->data['addJs'] = array(
            'assets/common-vendor/select2/select2.full.min.js',
            'assets/'.BACKENDFOLDER.'/js/pages/menu.js',
        );
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
            $this->menu->id = $id;
            $this->form_validation->set_rules($this->menu->rules($id));
            if($this->form_validation->run()) {
                switch($post['menu_link_type']) {
                    case 'url':
                        $post['link'] = $post['link'];
                        unset($post['content_link']);
                        break;
                    case 'content':
                        $post['link'] = $post['content_link'];
                        unset($post['content_link']);
                        break;
                    default:
                        $post['link'] = '';
                        unset($post['link']);
                        unset($post['content_link']);
                        break;
                }
                
                if($id == '') {
                    $res = $this->menu->save($post, '', true);
                    $id = $res;
                    $res = true;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->menu->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/menu/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/menu/create');
                else
                    redirect(BACKENDFOLDER.'/menu');
            } else {
                $this->form($id, 'menu');
            }
        } else {
            $this->form($id, 'menu');
        }
    }
    public function getParentMenu(){
        $menutype = $_POST['menutype'];
        $data = $this->menu->getAllMenuParentByType($menutype);
        echo json_encode($data);exit;
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
                    $res = $this->menu->delete(array('id' => $selected_id));
                    $this->menu->delete(array('menu_parent' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if($this->restrict_delete->check_for_delete($params, $id)) {
                $res = $this->menu->delete(array('id' => $id));
                $this->menu->delete(array('menu_parent' => $id));
                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/menu');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->menu->changeStatus('menu', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->menu->changeStatus('menu', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/menu');
    }
}