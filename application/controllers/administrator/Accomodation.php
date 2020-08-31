<?php

class Accomodation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accomodation_model', 'accomodation');
        $this->load->model('accomodationmedia_model', 'media');
        $this->data['module_name'] = 'Accomodation Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name'] = $this->router->fetch_class();
    }

    public function index() {
        $query = "SELECT a.*
                  FROM `tbl_accomodation` a
                  JOIN `tbl_accomodation_media` am ON am.`accomodation_id` = a.`id`
                  GROUP BY a.`id`
                  ORDER BY a.`id` DESC";
        $this->data['sub_module_name'] = 'Accomodation List';
        $this->data['accomodation'] = $this->accomodation->query($query);
        $this->data['body'] = BACKENDFOLDER . '/accomodation/_list';
        $this->render();
    }

    public function create() {
        $id = segment(4);
        $this->data['categories'] = $this->accomodation->activeCategories(10);
        if ($_POST) {
            $post = $_POST;
            $this->accomodation->id = $id;

            $this->form_validation->set_rules($this->accomodation->rules($id));
            if ($this->form_validation->run()) {
                $post['slug'] = $this->accomodation->createSlug($post['name'], $id);
                if (isset($post['media'])) {
                    $medias = $post['media'];
                }
                if (isset($post['title'])) {
                    $mediaTitles = $post['title'];
                }
                if (isset($post['description'])) {
                    $mediaDescriptions = $post['description'];
                }
                unset($post['media'], $post['title'], $post['description'], $post['image']);
                if ($id == '') {

                    $res = $this->accomodation->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->accomodation->save($post, $condition);
                }

                // saving media
                if (isset($medias) && !empty($medias)) {

                    $this->media->delete(array('accomodation_id' => $id));
                    foreach ($medias as $key => $singleMedia) {
                        $mediaInsertData = array(
                            'accomodation_id' => $id,
                            'media' => $singleMedia,
                            'title' => isset($mediaTitles) ? $mediaTitles[$key] : '',
                            'caption' => isset($mediaDescriptions) ? $mediaDescriptions[$key] : ''
                        );
                        $this->media->save($mediaInsertData);
                    }
                }


                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');

                redirect(BACKENDFOLDER . '/accomodation');
            } else {
                $this->form($id, 'accomodation');
            }
        } else {
            $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/pages/accomodation.js');

            if ($id != '')
                $this->data['savedMedia'] = $this->accomodation->getSavedMedia($id);
            $this->form($id, 'accomodation');
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
                    $res = $this->accomodation->delete(array('id' => $selected_id));
                    $this->media->delete(array('accomodation_id' => $selected_id));
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
                $res = $this->accomodation->delete(array('id' => $id));
                $this->media->delete(array('accomodation_id' => $id));
                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER . '/accomodation');
    }

    public function status() {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if (isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach ($selected_ids as $selected_id) {
                $res = $this->accomodation->changeStatus('accomodation', $status, $selected_id);
                if ($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->accomodation->changeStatus('accomodation', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER . '/accomodation');
    }

    public function deleteMedia() {
        $id = segment(4);
        echo $this->media->delete(array('id' => $id));
    }

}
