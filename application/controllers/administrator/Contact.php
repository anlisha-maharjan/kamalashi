<?php

class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contact_model', 'contact');
        $this->data['module_name'] = 'Feedbacks Manager';
        $this->data['show_add_link'] = false;
        $this->data['show_sort_link'] = false;
        $this->header['page_name'] = $this->router->fetch_class();
    }

    public function index() {
        $query = "SELECT * FROM `tbl_contact`";
        $this->data['sub_module_name'] = 'FeedBacks List';
        $this->data['contacts'] = $this->contact->query($query);
        $this->data['body'] = BACKENDFOLDER . '/contact/_list';
        $this->render();
    }

    public function delete() {
        $post = $_POST;

        $this->load->library('restrict_delete');
        $params = "";
        if (isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $deleted = 0;
            foreach ($selected_ids as $selected_id) {
                if ($this->restrict_delete->check_for_delete($params, $selected_id)) {
                    $res = $this->contact->delete(array('id' => $selected_id));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');
        } else {
            $id = segment(4);
            if ($this->restrict_delete->check_for_delete($params, $id)) {
                $id = segment(4);
                $res = $this->contact->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER . '/contact');
    }

}
