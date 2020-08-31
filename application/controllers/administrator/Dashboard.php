<?php

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['module_name'] = 'Dashboard';
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['body'] = BACKENDFOLDER.'/dashboard/_index';
        $this->data['sub_module_name'] = 'Dashboard';
        $this->render();
    }

}