<?php

class Common_model extends MY_Model {

    public $table = '';
    var $form = 'tbl_form';
    var $form_field = 'tbl_form_field';
    var $form_submission = 'tbl_form_submission';
    var $form_submission_fields = 'tbl_form_submission_fields';
    
    var $content = 'tbl_content';
    var $event = 'tbl_event';
    var $notice = 'tbl_notice';
    var $product = 'tbl_product';
    var $service = 'tbl_service';
    

    public function __construct() {
        parent::__construct();
    }

    function getFormFields($form_id) {
        $this->db->order_by('position', 'ASC');
        $this->db->where('form_id', $form_id);
        $result = $this->db->get($this->form_field)->result();

        return (isset($result) && !empty($result)) ? $result : array();
    }

    function getSearchResult($search_value) {
        
        $this->db->select('*');
        $this->db->where('status', 'Active');
        $this->db->like('name', $search_value, 'both');
        $content_result = $this->db->get($this->content)->result();
        if (isset($content_result) && !empty($content_result)) {
            $result['content'] = $content_result;
        }
        
        $this->db->select('*');
        $this->db->where('status', 'Active');
        $this->db->like('name', $search_value, 'both');
        $event_result = $this->db->get($this->event)->result();
        if (isset($event_result) && !empty($event_result)) {
            $result['event'] = $event_result;
        }
        
        $this->db->select('*');
        $this->db->where('status', 'Active');
        $this->db->like('name', $search_value, 'both');
        $notice_result = $this->db->get($this->notice)->result();
        if (isset($notice_result) && !empty($notice_result)) {
            $result['notice'] = $notice_result;
        }
        
        $this->db->select('*');
        $this->db->where('status', 'Active');
        $this->db->like('name', $search_value, 'both');
        $product_result = $this->db->get($this->product)->result();
        if (isset($product_result) && !empty($product_result)) {
            $result['product'] = $product_result;
        }
        
        $this->db->select('*');
        $this->db->where('status', 'Active');
        $this->db->like('name', $search_value, 'both');
        $service_result = $this->db->get($this->service)->result();
        if (isset($service_result) && !empty($service_result)) {
            $result['service'] = $service_result;
        }

       return (isset($result) && !empty($result)) ? $result : array();
    }

}
