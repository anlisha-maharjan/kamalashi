<?php

class MY_Front_Controller extends CI_Controller {

    public $template = '';
    public $data = array();
    public $global_config;

    public function __construct() {

        parent::__construct();
        $this->template = 'frontend/layout/default';
        // sanitizing all get and post values
        if ($_GET) {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        }
        if ($_POST) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }
        // sanitizing all get and post values

        $this->load->model('configuration_model', 'configuration');
        $this->load->model('common_model', 'common');
        $this->load->model('menu_model', 'menu');
        $this->load->model('content_model', 'content');
        $this->load->model('event_model', 'event');

        $this->global_config = $this->configuration->get('1', ['is_default' => 'Yes']);
        define('SITENAME', $this->global_config->site_title);
        define('SITEMAIL', $this->global_config->site_email);

        // website generic meta data
        $this->data['globalConfig'] = $this->global_config;
        if (segment(2) != '') {
            $this->data['meta_keywords'] = ucfirst(segment(2)) . ' | ' . SITENAME;
            $this->data['meta_description'] = segment(2);
        } elseif (segment(1) != '' && segment(2) == '') {
            $this->data['meta_keywords'] = ucfirst(segment(1)) . ' | ' . SITENAME;
            $this->data['meta_description'] = segment(1);
        } else {
            $this->data['meta_keywords'] = ($this->global_config->meta_keyword) ? $this->global_config->meta_keyword : SITENAME;
            $this->data['meta_description'] = ($this->global_config->meta_description) ? $this->global_config->meta_description : SITENAME;
        }

        $this->data['meta_title'] = SITENAME;
        $this->data['facebook_link'] = $this->global_config->facebook;
        $this->data['twitter_link'] = $this->global_config->twitter;
        $this->data['gplus_link'] = $this->global_config->gplus;
        $this->data['youtube_link'] = $this->global_config->youtube;
        $this->data['skype_link'] = $this->global_config->skype;
        $this->data['instagram_link'] = $this->global_config->instagram;
        $this->data['linkedin_link'] = $this->global_config->linkedin;
        $this->data['address'] = $this->global_config->address;
        $this->data['phone'] = $this->global_config->phone;
        $this->data['email'] = $this->global_config->site_email;
        
        // website navigation
        $this->data['mainMenu'] = $this->menu->getMainNavigationByPosition('mainmenu', '0');
        $this->data['bottomMenu'] = $this->menu->getNavigationByPosition('bottommenu');
        $this->data['footermenu'] = $this->menu->getNavigationByPosition('footermenu');
        
    }

    public function render() {
        $this->load->view($this->template, $this->data);
    }

    public function renderPartial($view) {
        $this->load->view($view, $this->data);
    }

    public function parse_email_template($raw_template, $replace) {
        $pattern = '{{%s}}';
        $map = array();
        if ($replace) {
            foreach ($replace as $var => $value) {
                $map[sprintf($pattern, $var)] = $value;
            }
            $template = strtr($raw_template, $map);
        }
        return $template;
    }

}

?>