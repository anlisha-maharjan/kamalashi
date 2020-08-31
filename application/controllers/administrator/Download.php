<?php

class Download extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('download_model', 'download');
        $this->data['module_name'] = 'Download Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name'] = $this->router->fetch_class();
    }

    public function index() {
        $this->data['sub_module_name'] = 'Download List';
        $this->data['downloads'] = $this->download->get();
        $this->data['body'] = BACKENDFOLDER . '/download/_list';
        $this->render();
    }

    public function create() {
        $id = segment(4);
        $this->data['downloadCategories'] = $this->download->activeCategories(6);
        $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js');
        $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css');

        if ($_POST) {
            $post = $_POST;

            if (isset($post['file'])) {
                $files = $post['file'];
                unset($post['file']);

                $this->download->id = $id;

                $this->form_validation->set_rules($this->download->rules($id));
                if ($this->form_validation->run()) {
                    if ($id == '') {
                        $res = $this->download->save($post, '', true);
                        $id = $res;
                    } else {
                        $condition = array('id' => $id);
                        $res = $this->download->save($post, $condition);
                    }

                    // saving download media
                    $this->load->model('downloadmedia_model', 'downloadmedia');
                    $this->downloadmedia->delete(array('download_id' => $id, 'module_type' => 'download'));
                    foreach ($files as $key => $singleFile) {
                        $mediaInsertData = array(
                            'download_id' => $id,
                            'media' => $singleFile,
                            'module_type' => 'download'
                        );
                        $this->downloadmedia->save($mediaInsertData);
                    }

                    $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');

                    redirect(BACKENDFOLDER . '/download');
                } else {
                    $this->form($id, 'download');
                }
            } else {
                set_flash('msg', 'File should be entered');
                redirect(BACKENDFOLDER . '/download');
            }
        } else {

            if ($id != '')
                $this->data['savedMedia'] = $this->download->getSavedMedia($id);
            $this->form($id, 'download');
        }
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
                    $res = $this->download->delete(array('id' => $selected_id));
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
                $res = $this->download->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER . '/download');
    }

    public function status() {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if (isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach ($selected_ids as $selected_id) {
                $res = $this->download->changeStatus('download', $status, $selected_id);
                if ($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->download->changeStatus('download', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER . '/download');
    }

    public function deleteMedia() {
        $id = segment(4);
        $this->load->model('downloadmedia_model', 'downloadmedia');
        echo $this->downloadmedia->delete(array('id' => $id));
    }

}
