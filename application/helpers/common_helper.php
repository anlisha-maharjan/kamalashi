<?php

function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

function logged_in($key) {
    return (get_userdata($key)) ? true : false;
}

function get_userdata($key) {
    $ci = &get_instance();

    $value = $ci->session->userdata($key);
    return $value ? $value : false;
}

function display_breadcrumb_front($breadcrumb) {
    $bread = '<section class="breadcrumb-wrap"><div class="container"><ul class="breadcrumb">';
    foreach ($breadcrumb as $key => $value):
        if ($value == ''):
            $bread .= '<li><span>' . str_replace('-', ' ', ucfirst($key)) . '</span></li>';
        elseif ($key == 'Home'):
            $bread .= '<li><a href="' . base_url() . '">' . ucfirst($key) . '</a></li>';
        else:
            $bread .= '<li><a href="' . base_url() . $value . '">' . str_replace('-', ' ', ucfirst($key)) . '</a></li>';
        endif;
    endforeach;
    $bread .= '</ul></div></section>';
    return $bread;
}

function segment($segment) {
    $ci = &get_instance();

    $value = $ci->uri->segment($segment);
    return $value;
}

function set_userdata($session_array) {
    $ci = &get_instance();

    $ci->session->set_userdata($session_array);
}

function set_flash($key, $message) {
    $ci = &get_instance();

    $ci->session->set_flashdata($key, $message);
}

function flash() {
    $ci = &get_instance();

    $flash_message = $ci->session->flashdata('msg');

    if ($flash_message) :
        ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <?php echo $flash_message ?>
        </div>
    <?php
    endif;
}

function flash_message() {
    $ci = &get_instance();

    $flash_message = $ci->session->flashdata('msg');


    return $flash_message;
}



function frontFlash() {
    $ci = &get_instance();

    $msg_flash_message = $ci->session->flashdata('msg');
    $error_flash_message = $ci->session->flashdata('error');

    $errorClass = ($msg_flash_message) ? 'alert-success' : 'alert-danger';

    if ($msg_flash_message || $error_flash_message) :
        ?>
        <div class="alert <?php echo $errorClass ?> alert-dismissable fade in">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo $msg_flash_message ? $msg_flash_message : $error_flash_message ?>
        </div>
    <?php
    endif;
}
function random_string($type = 'alnum', $len = 8) {
    switch ($type) {
        case 'alnum' :
        case 'numeric' :
        case 'nozero' :

            switch ($type) {
                case 'alnum' : $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'numeric' : $pool = '0123456789';
                    break;
                case 'nozero' : $pool = '123456789';
                    break;
            }

            $str = '';
            for ($i = 0; $i < $len; $i++) {
                $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
            }
            return $str;
            break;
        case 'unique' : return md5(uniqid(mt_rand()));
            break;
    }
}

function popup_msg() {
    $ci = &get_instance();

    $msg_flash_message = trim(strip_tags($ci->session->flashdata('msg')));
    $error_flash_message = trim(strip_tags($ci->session->flashdata('error')));
    if ($msg_flash_message || $error_flash_message) {
        echo $msg_flash_message ? "<script>var success_msg = '{$msg_flash_message}'</script>" : "<script>var error_msg = '{$error_flash_message}'</script>";
    }
}


function check_parent_active($children, $current_segment) {
    foreach ($children as $child) {
        if ($child->slug == $current_segment) {
            return true;
            die;
        }
    }
}

function get_select($data, $default_value = '', $name_column = '', $id_column = '') {
    $result = array();
    if (!empty($data)) {
        if ($default_value != '')
            $result[''] = $default_value;
        if ($name_column == '')
            $name_column = 'name';
        if ($id_column == '')
            $id_column = 'id';
        foreach ($data as $row) {
            $result[$row->$id_column] = $row->$name_column;
        }
    }
    return $result;
}
function image_thumb($file_path, $width, $height, $class = "", $returnPath = false) {
    $file_path = urlencode(base_url($file_path));
    $image_tag = '';
    $imagePath = base_url() . 'assets/' . BACKENDFOLDER . '/js/vendor/timthumb/timthumb.php?q=100&amp;src=' . $file_path . "&amp;w=" . $width . "&amp;h=" . $height . "&amp;zc=1'";
    $image_tag .= "<img src='";
    $image_tag .= $imagePath;

    if ($returnPath)
        return $imagePath;

    if ($class != "" && !is_array($class))
        $image_tag .= $class;
    elseif ($class != "" && is_array($class)) {
        foreach ($class as $attribute => $property) {
            $image_tag .= $attribute . '="' . $property . '"';
        }
    }
    $image_tag .= " />";

    echo $image_tag;
}

function getYoutubeVideoId($url) {
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);

    return !empty($matches) ? $matches[0] : '';
}



function mySubStr($string, $count) {
    if (preg_match('/^.{1,' . $count . '}\b/s', $string, $match)) {
        return trim($match[0]);
    }
    return $string;
}

function passwordHash($password) {
    // password hashing library for older PHP version
    require APPPATH . '/third_party/password.php';

    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    return $passwordHash;
}

function passwordVerify($passwordPlainText, $passwordHash) {
    // password hashing library for older PHP version
    require APPPATH . '/third_party/password.php';

    return password_verify($passwordPlainText, $passwordHash) ? true : false;
}


function get_pagination_config($type, $per_page = 4, $segment = 2) {
    switch ($type) {
        
        case 'events':
            $config['full_tag_open'] = '<div class="defaultPager clearfix"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '<span class="invisible992">Previous</span>';
            $config['prev_tag_open'] = '<a class="arrowLink arrowLeft" href="#">';
            $config['prev_tag_close'] = '</a>';
            $config['next_link'] = '<span class="invisible992">Next</span>';
            $config['next_tag_open'] = '<a class="arrowLink arrowRightRight" href="#">';
            $config['next_tag_close'] = '</a>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a href="#" class="active">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['per_page'] = $per_page;
            $config['uri_segment'] = $segment;
            break;
        default:
            $config['full_tag_open'] = '<div class="defaultPager clearfix"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '<span class="invisible992">Previous posts</span>';
            $config['prev_tag_open'] = '<a class="arrowLink arrowLeft" href="#">';
            $config['prev_tag_close'] = '</a>';
            $config['next_link'] = '<span class="invisible992">Next posts</span>';
            $config['next_tag_open'] = '<a class="arrowLink arrowRightRight" href="#">';
            $config['next_tag_close'] = '</a>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a href="#" class="active">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['per_page'] = $per_page;
            $config['uri_segment'] = $segment;
            break;
    }
    return $config;
}



function show_name_module($module_data) {
    if (isset($module_data->title))
        echo $module_data->title;
    elseif (isset($module_data->name))
        echo $module_data->name;
    elseif (isset($module_data->question))
        echo $module_data->question;
    elseif (isset($module_data->form_name))
        echo $module_data->form_name;
    else
        echo $module_data->name;
}

function check_module_data($page_id, $module_id) {
    $ci = &get_instance();
    $ci->load->model('common_model', 'common');
    $ci->common->table = 'tbl_page_module';
    return $ci->common->get('', ['page_id' => $page_id, 'module_id' => $module_id]) ? true : false;
}

function get_theme_name($site_theme) {
    $file_no_ext = explode('.', $site_theme);
    echo ucwords(str_replace('-', ' ', $file_no_ext[0]));
}

function get_category_name($category_id) {
    $ci = &get_instance();
    $ci->load->model('category_model', 'category');
    $category = $ci->category->get('1', ['id' => $category_id]);
    return $category ? $category->name : '';
}

function group_by_category($data, $site_id) {
    foreach ($data[$site_id] as $row) {
        $new_data[$row->category_id][] = $row;
    }
    return $new_data;
}

function last_query() {
    $ci = &get_instance();
    die($ci->db->last_query());
}

function verify_captcha($response_code) {
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LeqVlAUAAAAAHuoNSJqXd0Y0yipZVIa2eYIg1qg&response=' . $response_code;
    $response = json_decode(file_get_contents($verify_url), true);
    return $response['success'] ? true : false;
}


?>