<?php

class Search extends MY_Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model', 'common_model');
    }

    public function index() {
        if ($_POST['query']) {
            $q = isset($_POST['query'])?$_POST['query']:'';
            $result = $this->common_model->getSearchResult($q);
            
            $this->data['addCss'] = array(
                'assets/front/css/common/inner-all.css',
                'assets/front/css/pages/search.css',
                
            );
            $this->data['result'] = $result;
            $this->data['breadcrumb'] = array('Home' => 'Home', 'Search' => '');
            $this->data['addJs'] = array('assets/front/js/vendor/jquery.scrollto.js','assets/front/js/pages/search.js');
            $this->data['body'] = 'frontend/search/list';
            $this->render();
        }
    }

}

?>