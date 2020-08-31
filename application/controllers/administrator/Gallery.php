<?php

class Gallery extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('gallery_model', 'gallery');
        $this->load->model('gallerymedia_model', 'media');
        $this->data['module_name'] = 'Gallery Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name'] = $this->router->fetch_class();
    }

    public function index() {
        $query = "SELECT g.*
                  FROM `tbl_gallery` g
                  
                  JOIN `tbl_gallery_media` gm ON gm.`gallery_id` = g.`id`
                  GROUP BY g.`id`
                  ORDER BY g.`id` DESC";
        $this->data['sub_module_name'] = 'Gallery List';
        $this->data['galleries'] = $this->gallery->query($query);
        $this->data['body'] = BACKENDFOLDER . '/gallery/_list';
        $this->render();
    }

    public function create() {
        $id = segment(4);
        if ($_POST) {
            $post = $_POST;
            $this->gallery->id = $id;

            $this->form_validation->set_rules($this->gallery->rules($id));
            if ($this->form_validation->run()) {
                $post['slug'] = $this->gallery->createSlug($post['name'], $id);
                if (isset($post['media'])) {
                    $medias = $post['media'];
                }
                if (isset($post['title'])) {
                    $mediaTitles = $post['title'];
                }
                if (isset($post['description'])) {
                    $mediaDescriptions = $post['description'];
                }
                unset($post['media'], $post['title'], $post['description'],$post['image']);
                if ($id == '') {
                    
                    $res = $this->gallery->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->gallery->save($post, $condition);
                }

                // saving gallery media
                if (isset($medias) && !empty($medias)) {
                    $this->load->model('gallerymedia_model', 'gallerymedia');
                    $this->gallerymedia->delete(array('gallery_id' => $id));
                    foreach ($medias as $key => $singleMedia) {
                        $mediaInsertData = array(
                            'gallery_id' => $id,
                            'media' => $singleMedia,
                            'title' => isset($mediaTitles) ? $mediaTitles[$key] : '',
                            'caption' => isset($mediaDescriptions) ? $mediaDescriptions[$key] : ''
                        );
                        $this->gallerymedia->save($mediaInsertData);
                    }
                }


                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');

                redirect(BACKENDFOLDER . '/gallery');
            } else {
                $this->form($id, 'gallery');
            }
        } else {
            $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/pages/gallery.js');

            if ($id != '')
                $this->data['savedMedia'] = $this->gallery->getSavedMedia($id);
            $this->form($id, 'gallery');
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
                    $res = $this->gallery->delete(array('id' => $selected_id));
                    $this->media->delete(array('gallery_id' => $selected_id));
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
                $res = $this->gallery->delete(array('id' => $id));
                $this->media->delete(array('gallery_id' => $id));
                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER . '/gallery');
    }

    public function status() {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if (isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach ($selected_ids as $selected_id) {
                $res = $this->gallery->changeStatus('gallery', $status, $selected_id);
                if ($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->gallery->changeStatus('gallery', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER . '/gallery');
    }

    public function deleteMedia() {
        $id = segment(4);
        $this->load->model('gallerymedia_model', 'gallerymedia');
        echo $this->gallerymedia->delete(array('id' => $id));
    }

}
