<?php

class Notice extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('notice_model', 'notice');
        $this->load->model('common_model', 'common');
        $this->load->model('category_model', 'category');
        $this->load->model('downloadmedia_model', 'downloadmedia');
        $this->data['module_name'] = 'Notice Manager';
        $this->data['show_add_link'] = true;
        $this->data['show_sort_link'] = false;
        $this->header['page_name']	= $this->router->fetch_class();
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'Notice List';
        $this->data['notices'] = $this->notice->get('', '', 'id desc');
        $this->data['body'] = BACKENDFOLDER.'/notice/_list';
        $this->render();
    }

    public function create()
    {
        $this->data['categories'] = $this->category->get('', ['type' => 5]);
        $id = segment(4);
        if($id == '')
            $this->data['notices'] = $this->notice->get();
        else {
            $this->data['notices'] = $this->notice->get('', array('id !=' => $id));
            $this->common->table = 'tbl_download_media';
            $this->data['notice_files'] = $this->common->get('', ['download_id' => $id,'module_type'=>'notice']);
        }
        if($_POST) {
            $post = $_POST;
            if(isset($post['only_save'])){
                $only_save='save';
            }
            if(isset($post['save_new'])){
                $save_new='save and new';
            }
            $attachments = $post['file'];
            if($post['category_id'] == '') $post['category_id'] = NULL;
            unset($post['file'],$post['only_save'],$post['save_new']);
            $this->notice->id = $id;

            $this->form_validation->set_rules($this->notice->rules($id));
            if($this->form_validation->run()) {
                $post['publish_date'] = ($post['publish_date'] == '') || ($post['publish_date'] == '0000-00-00') ? date('Y-m-d') : $post['publish_date'];
                //$post['expiry_date'] = ($post['expiry_date'] == '') || ($post['expiry_date'] == '0000-00-00') ? date('Y-m-d') : $post['expiry_date'];
                
                $post['slug'] = $this->notice->createSlug($post['name'], $id);
                $post['featured'] = isset($post['featured']) ? 'Yes' : 'No';
                if($id == '') {
                    $res = $this->notice->save($post, '', true);
                    $id = $res;
                } else {
                    $condition = array('id' => $id);
                    $res = $this->notice->save($post, $condition);
                }

                // storing attachments
                if($attachments != '') {
                    $this->common->table = 'tbl_download_media';
                    $this->common->delete(['download_id' => $id,'module_type'=>'notice']);
                    $all_files = explode(',', $attachments);
                    foreach($all_files as $file) {
                        $this->common->save(['download_id' => $id, 'media' => $file,'module_type'=>'notice']);
                    }
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                
                if(isset($only_save))
                    redirect(BACKENDFOLDER.'/notice/create/'.$id);
                else if(isset($save_new))
                    redirect(BACKENDFOLDER . '/notice/create');
                else
                redirect(BACKENDFOLDER.'/notice');
            } else {
                $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js', 'assets/'.BACKENDFOLDER.'/js/pages/notice.js');
                $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css');
                $this->form($id, 'notice');
            }
        } else {
            $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/bootstrap-datepicker.js', 'assets/'.BACKENDFOLDER.'/js/pages/notice.js');
            $this->data['addCss'] = array('assets/' . BACKENDFOLDER . '/js/vendor/datepicker/datepicker3.css');
            $this->form($id, 'notice');
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
                    $res = $this->notice->delete(array('id' => $selected_id));
                    $res1= $this->downloadmedia->delete(array('download_id' => $selected_id,'module_type'=>'notice'));
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
                $res = $this->notice->delete(array('id' => $id));
                $res1= $this->downloadmedia->delete(array('download_id' => $id,'module_type'=>'notice'));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER.'/notice');
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->notice->changeStatus('notice', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->notice->changeStatus('notice', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER.'/notice');
    }

    public function delete_file()
    {
        $notice_id = segment(5);
        $notice_file_id = segment(4);
        $this->common->table = 'tbl_download_media';
        $this->common->delete(['download_id' => $notice_id,'module_type'=>'notice']);
        redirect(BACKENDFOLDER . '/notice/create/' . $notice_id);
    }


}