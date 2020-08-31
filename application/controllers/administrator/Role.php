<?php

class Role extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_model', 'role');
        $this->data['module_name'] = 'Role Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'Role List';
        $this->data['rows'] = $this->role->get();
        $this->data['body'] = BACKENDFOLDER.'/role/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);

        if($_POST) {
            $post = $_POST;
            $this->role->id = $id;

            $this->form_validation->set_rules($this->role->rules($id));
            if($this->form_validation->run()) {
                if($id == '') {
                    $res = $this->role->save($post);
                } else {
                    $condition = array('id' => $id);
                    $res = $this->role->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                redirect(BACKENDFOLDER.'/role');
            } else {
                $this->form($id, 'role');
            }
        } else {
            $this->form($id, 'role');
        }
    }

    public function delete()
    {
        $id = segment(4);
        $res = $this->rolemodule->delete(array('id' => $id));

        $res ? set_flash('msg', 'Data deleted') : set_flash('msg', 'Data could not be deleted');

        redirect(BACKENDFOLDER.'/role');
    }

}