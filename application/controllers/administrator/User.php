<?php

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
        $this->load->model('role_model', 'role');
        $this->load->model('common_model', 'common');
        $this->data['module_name'] = 'User Manager';
        $this->data['show_add_link'] = true;
        $this->header['page_name']	= $this->router->fetch_class();
        // password hashing library for older PHP version
        require APPPATH . '/third_party/password.php';
    }

    public function index()
    {
        $this->data['sub_module_name'] = 'User List';
        $query = "SELECT u.* FROM tbl_user u JOIN tbl_role r ON r.id = u.role_id ";
        $this->data['users'] = $this->user->query($query);
        $this->data['body'] = BACKENDFOLDER.'/user/_list';
        $this->render();
    }

    public function create()
    {
        $this->data['user_roles'] = $this->role->get();
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            $this->user->id = $id;

            $this->form_validation->set_rules($this->user->rules($id));
            if($this->form_validation->run()) {
                if(isset($post['password'])) {
                    unset($post['confirm_password']);
                    $post['password'] =  password_hash($post['password'], PASSWORD_BCRYPT, array('cost' => 10));
                }
                if($id == '') {
                    $res = $this->user->save($post);
                } else {
                    $condition = array('id' => $id);
                    $res = $this->user->save($post, $condition);
                }

                $res ? set_flash('msg', 'Data saved') : set_flash('msg', 'Data could not be saved');
                redirect(BACKENDFOLDER.'/user');
            } else {
                $this->form($id, 'user');
            }
        } else {
            $this->form($id, 'user');
        }
    }

    public function delete()
    {
        $id = segment(4);
        $res = $this->user->delete(array('id' => $id));

        $res ? set_flash('msg', 'Data deleted') : set_flash('msg', 'Data could not be deleted');

        redirect(BACKENDFOLDER.'/user');
    }

    public function unique_username($username)
    {
        $id = $this->user->id;
        $user = $this->user->get(1, array('id' => $id));
        if($user) {
            $old_username = $user->username;
            if ($username == $old_username)
                return true;
        }
        $unique_username = $this->user->get(1, array('username' => $username));
        if ($unique_username) {

            $this->form_validation->set_message('unique_username', 'The Username is already in use.');

            return false;
        }
        return true;
    }

    public function unique_email($email)
    {
        $id = $this->user->id;
        $user = $this->user->get(1, array('id' => $id));
        if($user) {
            $old_email = $user->email;
            if ($email == $old_email)
                return true;
        }
        $unique_email = $this->user->get(1, array('email' => $email));
        if ($unique_email) {

            $this->form_validation->set_message('unique_email', 'The Email is already in use.');

            return false;
        }
        return true;
    }

    public function login()
    {
        $this->template = BACKENDFOLDER.'/layout/login';
        if($_POST) {
            $post = $_POST;

            $user = $this->user->login($post);
            $redirectUrl = $this->input->get('r');
            $loginSuccessfulRedirect = ($redirectUrl) ? $redirectUrl : BACKENDFOLDER.'/dashboard';

            $redirect = ($user) ? $loginSuccessfulRedirect : BACKENDFOLDER.'/login';

            if(!$user) {
                set_flash('msg', 'Incorrect username or password.');
            }
            $this->common->table = 'tbl_admin_log';
            $admin_log_id = $this->common->save(['user_id' => get_userdata('user_id'), 'logged_in_time' => time()], '', true);
            set_userdata(['admin_log_id' => $admin_log_id]);
            redirect($redirect);
        } else {
            $this->data['body'] = BACKENDFOLDER.'/user/_login_form';
            $this->render();
        }
    }

    public function logout()
    {
        $admin_log_id = get_userdata('admin_log_id');
        $this->common->table = 'tbl_admin_log';
        $this->common->save(['logged_out_time' => time()], ['id' => $admin_log_id]);
        $this->session->sess_destroy();
        redirect(BACKENDFOLDER.'/login');
    }

    public function getPassword()
    {
        $this->template = BACKENDFOLDER.'/layout/login';
        if($_POST) {
            $post = $_POST;

            $reset = $this->user->resetPassword($post['email']);

            $redirect = ($reset) ? BACKENDFOLDER.'/login' : BACKENDFOLDER.'/retrieve-password';

            (!$reset) ? set_flash('msg', 'The email address does not exist in our database.') : set_flash('msg', 'Password has been reset successfully. New password sent to the email address provided.');

            redirect($redirect);
        } else {
            $this->data['body'] = BACKENDFOLDER.'/user/_password_form';
            $this->render();
        }
    }

    public function changepassword()
    {
        $post = $this->input->post();
        $res = $this->user->changepassword($post);

        $res ? set_flash('msg', 'Password changed successfully.') : set_flash('msg', 'Password could not be changed. Please try again.');
        redirect(BACKENDFOLDER . '/user/create/' . $post['userId']);
    }

    public function status()
    {
        $post = $_POST;
        $status = segment(4) == 'Active' ? 'InActive' : 'Active';

        if(isset($post) && !empty($post)) {
            $selected_ids = $post['selected'];
            $changed = 0;
            foreach($selected_ids as $selected_id) {
                $res = $this->user->changeStatus('user', $status, $selected_id);
                if($res) {
                    $changed++;
                }
            }
            $changed ? set_flash('msg', $changed . ' out of ' . count($selected_ids) . ' data status changed successfully') : set_flash('msg', 'Status could not be changed');
        } else {
            $id = segment(5);
            $res = $this->user->changeStatus('user', $status, $id);

            $res ? set_flash('msg', 'Status changed') : set_flash('msg', 'Status could not be changed');
        }

        redirect(BACKENDFOLDER . '/user');
    }

}