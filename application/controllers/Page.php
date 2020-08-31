<?php

class Page extends MY_Front_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('menu_model', 'menu');
        $this->load->model('content_model', 'content');
        $this->load->model('countries_model', 'countries');
        $this->load->model('configuration_model', 'configuration');
        $this->load->model('service_model', 'service');
        $this->load->model('event_model', 'event');
        $this->load->model('notice_model', 'notice');
        $this->load->model('banner_model', 'banner');
        $this->load->model('category_model', 'category');
        $this->load->model('contact_model', 'contact');
        $this->load->model('accomodation_model', 'accomodation');
        $this->load->model('accomodationmedia_model', 'media');
        $this->load->model('gallery_model', 'gallery');
    }

    public function index() {
        $url = $this->uri->segment_array();
        $slug = segment(1);
        $product_slug = segment(2);
        $config = $this->configuration->get();
        $this->data['config'] = $config[0];
        if ($slug == 'accomodation' || $slug == 'accomodations') {
            $this->data['menu'] = $this->menu->get('1', ['menu_alias' => 'accomodation', 'menu_type' => 'mainmenu']);
            if ($product_slug == '') {
                $this->data['accomodation'] = $this->accomodation->getAccomodation();
                $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
                $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/accomodation.css');
                $this->data['addJs'] = array('assets/front/js/pages/accomodation.js');
                $this->data['body'] = 'frontend/accomodations/list';
            } else {
                $this->data['details'] = $this->accomodation->getAccomodationDetail($product_slug);
                if ($this->data['details']) {
                    $this->data['breadcrumb'] = array('Home' => 'Home', 'Accomodations' => $slug, $product_slug => '');
                    $this->data['detail'] = $this->data['details'][0];
                    $this->data['addCss'] = array('assets/front/css/common/inner-default.css');
                    $this->data['addJs'] = array();
                    $this->data['body'] = 'frontend/accomodations/detail';
                } else {
                    show_error($this->data, 404);
                }
            }
        } elseif ($slug == 'gallery') {
            $this->data['menu'] = $this->menu->get('1', ['menu_alias' => 'gallery', 'menu_type' => 'mainmenu']);
            $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/gallery.css');
            $this->data['gallery'] = $this->gallery->getAllGallery();
            $this->data['addJs'] = array('assets/front/js/pages/gallery.js');
            $this->data['body'] = 'frontend/gallery/list';
        } elseif ($slug == 'about-us') {
            $this->data['menu'] = $this->menu->get('1', ['menu_alias' => 'about-us', 'menu_type' => 'mainmenu']);
            $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
            $this->data['content'] = $this->content->get('1', ['id' => $this->data['menu']->link, 'status' => 'Active']);
            $this->data['gallery'] = $this->gallery->get('', ['status' => 'Active'], 'orderNumber asc');
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/about.css');
            $this->data['addJs'] = array('assets/front/js/pages/about.js');
            $this->data['body'] = 'frontend/about/list';
        } elseif ($slug == 'meetings-events') {
            $this->data['menu'] = $this->menu->get('1', ['menu_alias' => 'meetings-events', 'menu_type' => 'mainmenu']);
            $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css');
            $this->data['addJs'] = array();
            $this->data['body'] = 'frontend/events/list';
        } elseif ($slug == 'contact') {
            $this->data['menu'] = $this->menu->get('1', ['menu_alias' => 'contact', 'menu_type' => 'mainmenu']);
            $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/common-vendor/sweetalert/sweetalert.css', 'assets/front/css/pages/contact.css');
            $this->data['addJs'] = array('assets/common-vendor/sweetalert/sweetalert.min.js', 'assets/front/js/pages/contact.js');
            $this->data['body'] = 'frontend/contact/list';
        } elseif ($slug == 'cart') {
            $this->data['breadcrumb'] = array('Home' => 'Home', 'Accomodation'=>'Accomodation','Cart' => '');
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/cart.css');
            $this->data['addJs'] = array('assets/front/js/pages/cart.js');
            $this->data['body'] = 'frontend/cart/list';
        } elseif ($slug == 'checkout') {
            $session_array = $_SESSION;
            unset($session_array['__ci_last_regenerate'], $session_array['checkin'], $session_array['checkout'], $session_array['adult'], $session_array['children']);
            if (isset($session_array) && !empty($session_array)) {
                
                $this->data['countries'] = $this->countries->get();
                $this->data['breadcrumb'] = array('Home' => 'Home', 'Accomodation'=>'Accomodation', 'Checkout' => '');
                $this->data['addCss'] = array('assets/common-vendor/sweetalert/sweetalert.css', 'assets/front/css/common/inner-default.css', 'assets/front/css/pages/checkout.css');
                $this->data['addJs'] = array('assets/front/js/pages/checkout.js', 'assets/common-vendor/sweetalert/sweetalert.min.js');
                $this->data['body'] = 'frontend/checkout/list';
            } else {
                redirect('cart');
            }
        } elseif ($slug == 'booking-confirmed') {
            $this->data['breadcrumb'] = array('Home' => 'Home', 'Booking Confirmed' => '');
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/checkout.css');
            $this->data['addJs'] = array();
            $this->data['body'] = 'frontend/checkout/confirm';
        } else {
            
            $mainmenu = $this->menu->get('1', ['menu_alias' => $slug, 'menu_type' => 'mainmenu']);
            $bottommenu = $this->menu->get('1', ['menu_alias' => $slug, 'menu_type' => 'bottommenu']);
            $footermenu = $this->menu->get('1', ['menu_alias' => $slug, 'menu_type' => 'footermenu']);

            if (!empty($mainmenu)) {
                $this->data['main_menu_content'] = $this->menu->get('1', ['menu_alias' => $slug, 'menu_type' => 'mainmenu']);
                if ((isset($this->data['main_menu_content']->menu_link_type) && $this->data['main_menu_content']->menu_link_type == 'content')) {

                    $this->data['menu'] = $mainmenu;
                    $menuparent = $this->menu->get('1', ['id' => $mainmenu->menu_parent, 'menu_type' => 'mainmenu']);
                    if (isset($menuparent) && !empty($menuparent)) {
                        $menuparent_name = $menuparent->menu_title;
                        $this->data['breadcrumb'] = array('Home' => 'Home', $menuparent_name => '', $slug => '');
                    } else {
                        $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
                    }
                    $this->data['content_data'] = $this->content->get('', ['id' => $this->data['main_menu_content']->link, 'status' => 'Active']);
                    $this->data['body'] = 'frontend/content/default';
                    $this->data['addCss'] = array('assets/front/css/common/inner-default.css');
                    $this->data['addJs'] = array();
                }
            } else if (!empty($bottommenu)) {
                $this->data['bottommenu_content'] = $this->menu->get('1', ['menu_alias' => $slug, 'menu_type' => 'bottommenu']);
                if ((isset($this->data['bottommenu_content']->menu_link_type) && $this->data['bottommenu_content']->menu_link_type == 'content')) {
                    $this->data['menu'] = $bottommenu;
                    $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
                    $this->data['content_data'] = $this->content->get('', ['id' => $this->data['bottommenu_content']->link, 'status' => 'Active']);
                    $this->data['body'] = 'frontend/content/default';
                    $this->data['addCss'] = array('assets/front/css/common/inner-default.css');
                    $this->data['addJs'] = array();
                }
            } else if (!empty($footermenu)) {
                $this->data['footermenu_content'] = $this->menu->get('1', ['menu_alias' => $slug, 'menu_type' => 'footermenu']);
                if ((isset($this->data['footermenu_content']->menu_link_type) && $this->data['footermenu_content']->menu_link_type == 'content')) {
                    $this->data['menu'] = $footermenu;
                    $this->data['breadcrumb'] = array('Home' => 'Home', $slug => '');
                    $this->data['content_data'] = $this->content->get('', ['id' => $this->data['footermenu_content']->link, 'status' => 'Active']);
                    $this->data['body'] = 'frontend/content/default';
                    $this->data['addCss'] = array('assets/front/css/common/inner-default.css');
                    $this->data['addJs'] = array();
                }
            } else {
                show_error($this->data, 404);
            }
        }
        $this->render();
    }

    public function check_captcha($code) {
        $this->load->library('securimage/securimage');
        $img = new Securimage();
        $res = $img->check($code);
        return $res;
    }

    public function securimage() {
        $this->load->config('csecurimage');
        $active = $this->config->item('si_active');
        $allsettings = array_merge($this->config->item($active), $this->config->item('si_general'));
        $this->load->library('securimage/securimage');
        $img = new Securimage($allsettings);
        $img->show();
    }

    public function getAccomodation($id) {
        $data = $this->accomodation->get('1', ['id' => $id]);
        //Set selected accomodation and quantity in session
        $rooms = array(
            $data->slug => $_POST['quantity']
        );
        set_userdata($rooms);
        echo json_encode($data);
        die;
    }

    public function removeAccomodation($slug) {
        unset($_SESSION[$slug]);
        echo json_encode('session removed');
        die;
    }

    public function getGalleryMedia($id) {
        $data = $this->gallery->getSavedMedia($id);
        echo json_encode($data);
        die;
    }

    public function contact() {
        if (isset($_POST) && !empty($_POST)) {
            $post = $_POST;
            //$code = $post['code'];
            //unset($post['code']);
//            if ($code == '') {
//                $data['action'] = 'error';
//                $data['msg'] = 'Captcha Required';
//            } else if ($this->check_captcha($code) != '1') {
//                $data['action'] = 'error';
//                $data['msg'] = 'Captcha Failed.';
//            } else {
            $post['date'] = date('Y-m-d H:i:s');
            $res = $this->contact->save($post, '', true);
            if (isset($res)) {
                $this->load->library('email');
                $this->load->model('emailtemplate_model', 'emailtemplate');
                $email_raw = $this->emailtemplate->get('1', ['name' => 'contact_us']);
                $user_replace = [
                    'site_logo' => base_url() . $this->global_config->site_logo,
                    'name' => $_POST['name'],
                    'site_link' => base_url()
                ];
                $user_email = $this->parse_email_template($email_raw->userMessage, $user_replace);
                $this->email->from('info@kamalashipalace.com', 'Kamalashi Palace.');
                $this->email->to($_POST['email']);
                $this->email->subject($email_raw->userSubject);
                $this->email->message($user_email);
                $this->email->set_mailtype("html");
                $this->email->send();

                $admin_replace = [
                    'site_logo' => base_url() . $this->global_config->site_logo,
                    'name' => $_POST['name'],
                    'message' => $_POST['message'],
                    'email' => $_POST['email'],
                    'site_link' => base_url()
                ];
                $admin_email = $this->parse_email_template($email_raw->adminMessage, $admin_replace);
                $this->email->from('info@kamalashipalace.com', 'Kamalashi Palace.');
                $this->email->to($email_raw->adminEmail);
                $this->email->subject($email_raw->adminSubject);
                $this->email->message($admin_email);
                $this->email->set_mailtype("html");
                $this->email->send();


                $data['action'] = 'success';
                $data['msg'] = 'Feedback sent successfully!';
            } else {
                $data['action'] = 'error';
                $data['msg'] = 'Unable to send Feedback!';
            }
            //}
            echo json_encode($data);
            exit;
        }
    }

}

?>
