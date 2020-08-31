<?php

class Event extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model', 'event');
        $this->load->model('common_model', 'common');
        $this->load->model('downloadmedia_model', 'downloadmedia');
        $this->data['module_name'] = 'News Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'News List';
        $this->data['events'] = $this->event->get();
        $this->data['body'] = BACKENDFOLDER.'/event/_list';
        $this->render();
    }

    public function create()
    {
        $id = segment(4);
        $this->data['eventCategory'] = $this->event->activeCategories(3);
        if($id == ''){
        }
        else {
            $this->common->table = 'tbl_download_media';
            $this->data['event_files'] = $this->common->get('', ['download_id' => $id,'module_type'=>'event']);
        }

        if($_POST) {
            $post = $_POST;
            $attachments = $post['file'];
            unset($post['file']);
            $this->event->id = $id;

            $this->form_validation->set_rules($this->event->rules($id));
            if($this->form_validation->run()) {
                $post['slug'] = $this->event->createSlug($post['name'], $id);
                $post['featured'] = isset($post['featured']) ? 'Yes' : 'No';
                if($id == '') {
                    $res = $this->event->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->event->save($post, $condition);
                }
                // storing attachments
                if($attachments != '') {
                    $this->common->table = 'tbl_download_media';
                    $this->common->delete(['download_id' => $id,'module_type'=>'event']);
                    $all_files = explode(',', $attachments);
                    foreach($all_files as $file) {
                        $this->common->save(['download_id' => $id, 'media' => $file,'module_type'=>'event']);
                    }
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                
                redirect(BACKENDFOLDER.'/event');
            } else {
                $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js', 'assets/'.BACKENDFOLDER.'/js/pages/event.js','assets/common-vendor/select2/select2.full.min.js', 
                    
                );
                $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css','assets/common-vendor/select2/select2.min.css');
                $this->form($id, 'event');
            }
        } else {
            $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js', 'assets/'.BACKENDFOLDER.'/dist/js/event.js','assets/common-vendor/select2/select2.full.min.js', 
                //'assets/common-vendor/select2.init.js'
                );
            $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css','assets/common-vendor/select2/select2.min.css');
            $this->form($id, 'event');
        }
    }

    public function delete()
    {
        $post = $_POST;

        $this->load->library('restrict_delete');
        $params = "";
        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $deleted = 0;
            foreach($selected_ids as $selected_id){
                if($this->restrict_delete->check_for_delete($params, $selected_id)) {
                    $res = $this->event->delete(array('id' => $selected_id));
                    $res1= $this->downloadmedia->delete(array('download_id' => $selected_id,'module_type'=>'event'));
                    if ($res) {
                        $deleted++;
                    }
                }
            }

            $deleted ? set_flash('msg', $deleted . ' out of ' . count($selected_ids) . ' data deleted successfully') : set_flash('msg', 'Data could not be deleted');

        } else {
            $id = segment(4);
            if($this->restrict_delete->check_for_delete($params, $id)) {
                $id = segment(4);
                $res = $this->event->delete(array('id' => $id));
                $res1= $this->downloadmedia->delete(array('download_id' => $id,'module_type'=>'event'));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/event');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->event->changeStatus('event', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->event->changeStatus('event', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/event');
    }
    
    public function delete_file()
    {
        $event_id = segment(5);
        $event_file_id = segment(4);
        $this->common->table = 'tbl_download_media';
        $this->common->delete(['download_id' => $event_id,'module_type'=>'event']);
        redirect(BACKENDFOLDER . '/event/create/' . $event_id);
    }
}