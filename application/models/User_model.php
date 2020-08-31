<?php

class User_model extends MY_Model {

    public $table = 'tbl_user';
    public $id = '', $name = '', $username = '', $password = '', $email = '', $status = '', $role_id = '';

    public function rules($id) {
        $array = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|unique[tbl_user.username.' . $id . ']',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim' . $id != '' ? '' : '|required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|unique[tbl_user.email.' . $id . ']'
            ),
            array(
                'field' => 'role_id',
                'label' => 'User Role',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim'
            )
        );

        return $array;
    }

    public function __construct() {
        parent::__construct();
        $this->created_timestamp = true;
        $this->updated_timestamp = true;
        $this->created_by = true;
        $this->updated_by = true;

        // password hashing library for older PHP version
        require APPPATH . '/third_party/password.php';
    }

    public function login($data) {
        $user = $this->get(1, array('username' => $data['username']));
        if (isset($user) && !empty($user)) {
            $role_id = $user->role_id;
            $query = "select role_type from tbl_role where id = '{$role_id}'";
            $role_type = $this->db->query($query)->row_object();
        }

        if ($user && password_verify($data['password'], $user->password)) {
            $session_array = array(
                'username' => $user->username,
                'user_id' => $user->id,
                'role_id' => $role_id,
                'email' => $user->email,
                'name' => $user->name,
                'role_type' => $role_type->role_type
            );

            set_userdata($session_array);

            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    public function resetPassword($email) {
        $user = $this->get(1, array('email' => $email));
        if ($user) {
            $new_password = random_string('alnum', 8);
            $this->load->library('email');
            $this->load->model('emailtemplate_model', 'emailtemplate');
            $password_reset_email_raw = $this->emailtemplate->get('1', ['name' => 'admin_forgot_password']);
            $admin_replace = [
                'name' => $user->name,
                'site_logo' => base_url($this->global_config->site_logo),
                'site_link' => base_url(),
                'new_password' => $new_password,
                'admin_end_login' => base_url(BACKENDFOLDER . '/login')
            ];
            $ci = &get_instance();
            $password_reset_email = $ci->parse_email_template($password_reset_email_raw->userMessage, $admin_replace);
            
            $this->email->from('info@kamalashipalace.com', 'Kamalashi Palace.');
            $this->email->to($user->email);
            $this->email->subject($password_reset_email_raw->userSubject);
            $this->email->message($password_reset_email);
            $this->email->set_mailtype("html");
            $this->email->send();
            if ($this->save(array('password' => password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 10))), array('id' => $user->id))) {
                $return = true;
            } else {
                $return = false;
            }
        } else
            $return = false;

        return $return;
    }

    public function changepassword($data) {
        $res = false;
        $userId = $data['userId'];
        $user = $this->get(1, array('id' => $userId));
        if ($user && password_verify($data['oldPassword'], $user->password) && $data['newPassword'] == $data['reNewPassword']) {
            $save['password'] = password_hash($data['newPassword'], PASSWORD_BCRYPT, array('cost' => 10));
            $res = $this->user->save($save, array('id' => $userId));
        }
        return $res;
    }

    public function get_front_user_by_email($email) {
        $query = "SELECT
                      u.id AS user_id,
                      u.name AS user_name
                    FROM tbl_user u
                         JOIN tbl_role r
                           ON r.id = u.role_id
                    WHERE u.email = '$email'";
        return $this->db->query($query)->row();
    }

    public function get_front_user_by_token($token) {
        $query = "SELECT
                      u.*
                    FROM tbl_user u
                         JOIN tbl_role r
                           ON r.id = u.role_id
                    WHERE MD5(u.id) = '$token'";
        return $this->db->query($query)->row();
    }

    public function validate_front_user($user_data) {
        $user = $this->db->get_where('view_front_user', ['username' => $user_data['username']])->row();
        if ($user && passwordVerify($user_data['password'], $user->password)) {
            $session = [
                'active_user' => $user->user_id,
                'name' => $user->name,
                'email' => $user->email
            ];
            set_userdata($session);
            return true;
        } else {
            set_flash('error', 'Incorrect username or password');
            return false;
        }
    }

    public function get_userdata() {
        $query = 'select u.*, mu.mobile_number from tbl_user u join tbl_member_user mu on u.id = mu.user_id where u.id = ' . get_userdata('active_user_id');
        return $this->query($query);
    }

}
