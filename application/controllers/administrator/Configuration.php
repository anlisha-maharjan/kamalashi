<?php

class Configuration extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['module_name'] = 'Configuration Manager';
        $this->data['show_add_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
        $this->load->model('user_model', 'user');
        $this->load->model('common_model', 'common');
    }

    public function index()
    {
        $id = 1;
        if($_POST) {
            $post = $_POST;
            $this->configuration->id = $id;

            $this->form_validation->set_rules($this->configuration->rules);
            if($this->form_validation->run()) {
                if($id == '') {
                    $res = $this->configuration->save($post, '', true);
                } else {
                    $condition = array('id' => $id);
                    $res = $this->configuration->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                redirect(BACKENDFOLDER.'/configuration');
            } else {
                $this->form($id, 'configuration');
            }
        } else {
            $this->form($id, 'configuration');
        }
    }
}