<?php

class Home extends MY_Front_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('banner_model', 'banner');
        $this->load->model('service_model', 'service');
        $this->load->model('event_model', 'event');
        $this->load->model('common_model', 'common');
        $this->load->model('event_model', 'event');
        $this->load->model('notice_model', 'notice');
        $this->load->model('contact_model', 'contact');
        $this->load->model('configuration_model', 'configuration');
        $this->load->model('content_model', 'content');
        $this->load->model('gallery_model', 'gallery');
        $this->load->model('accomodation_model', 'accomodation');
        $this->load->model('accomodationmedia_model', 'media');
        $this->load->model('booking_model', 'booking');
    }

    public function index() {
        $config = $this->configuration->get();
        $this->data['config'] = $config[0];
        $this->data['banner'] = $this->banner->getByCategory('home-banner');
        $this->data['serenity'] = $this->content->getContentByCategory('serenity');
        $this->data['services'] = $this->service->get('', ['status' => 'Active', 'featured' => 'Yes', 'category_id' => '0'], 'orderNumber asc');
        $this->data['gallery'] = $this->gallery->get('', ['status' => 'Active'], 'orderNumber asc');
        $this->data['accomodation'] = $this->accomodation->getAccomodation();
        $this->data['is_home'] = 'yes';
        $this->data['addCss'] = array(
            'assets/front/css/pages/home.css'
        );
        $this->data['addJs'] = array(
            'assets/front/js/pages/home.js'
        );
        $this->render();
    }

    public function parse_email_template($raw_template, $replace) {
        $pattern = '{{%s}}';
        $map = array();
        if ($replace) {
            foreach ($replace as $var => $value) {
                $map[sprintf($pattern, $var)] = $value;
            }
            $template = strtr($raw_template, $map);
        }
        return $template;
    }

    public function setCheckAccomodation() {
        if (isset($_POST) && !empty($_POST)) {
            $array = array(
                'checkin' => $_POST['checkin-date'],
                'checkout' => $_POST['checkout-date'],
                'adult' => $_POST['adult'],
                'children' => $_POST['children'],
            );
            $user_accomodation_session_array = array(
                'checkin' => $_POST['checkin-date'],
                'checkout' => $_POST['checkout-date'],
                'adult' => $_POST['adult'],
                'children' => $_POST['children']
            );

            set_userdata($user_accomodation_session_array);
            //Use POST parameter to check room availability (Refine here)
            $this->data['accomodation'] = $this->accomodation->getAvailableAccomodation();
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/accomodation.css');
            $this->data['breadcrumb'] = array('Home' => 'Home', 'Accomodation' => '');
            $this->data['addJs'] = array('assets/front/js/pages/accomodation.js');
            $this->data['body'] = 'frontend/accomodations/list';
            $this->render();
        } else {
            $this->data['accomodation'] = $this->accomodation->getAccomodation();
            $this->data['addCss'] = array('assets/front/css/common/inner-default.css', 'assets/front/css/pages/accomodation.css');
            $this->data['breadcrumb'] = array('Home' => 'Home', 'Accomodation' => '');
            $this->data['addJs'] = array('assets/front/js/pages/accomodation.js');
            $this->data['body'] = 'frontend/accomodations/list';
            $this->render();
        }
    }

    public function customerbooking() {
        if (isset($_POST)) {
            if (isset($_POST['g-recaptcha-response'])) {
                if (verify_captcha($_POST['g-recaptcha-response'])) {
                    $post = $_POST;
                    $firstname = $post['firstname'];
                    $lastname = $post['lastname'];
                    $address = $post['address'];
                    $phone = $post['phone'];
                    $email = $post['email'];
                    $country = $post['country'];
                    $check_in = $post['check_in'];
                    $check_out = $post['check_out'];
                    $adult = $post['adult'];
                    $children = $post['children'];
                    $additional_info = $post['additional_info'];

                    unset($post['agree'], $post['firstname'], $post['lastname'], $post['address'], $post['phone'], $post['email'], $post['country'], $post['check_in'], $post['check_out'], $post['adult'], $post['children'], $post['additional_info'], $post['g-recaptcha-response']);
                    $rooms = array();
                    foreach ($post as $key => $value) {
                        $rooms[$key] = $value;
                        $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                        $updatedata = array(
                            'total_booked' => $accomodata->total_booked + $value
                        );
                        $condition = array('id' => $accomodata->id);
                        $this->accomodation->save($updatedata, $condition);
                    }

                    $data = array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'country' => $country,
                        'json_data' => json_encode($rooms),
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'adults' => $adult,
                        'children' => $children,
                        'additional_info' => $additional_info,
                        'status' => 'Pending',
                        'booked_date' => date('Y-m-d H:i:s')
                    );
                    $res = $this->booking->save($data, '', true);

                    if (isset($res)) {
                        //Remove session
                        session_destroy();
                        //Update Availability flag
                        $accomodation_data = $this->accomodation->get();
                        foreach ($accomodation_data as $key => $value) {
                            if ($value->total_count == $value->total_booked) {
                                $update = array(
                                    'availability_flag' => '1'
                                );
                                $condition = array('id' => $value->id);
                                $this->accomodation->save($update, $condition);
                            }
                        }
                        $this->load->library('email');
                        $this->load->model('emailtemplate_model', 'emailtemplate');
                        $email_raw = $this->emailtemplate->get('1', ['name' => 'accomodation_booking']);
                        $user_replace = [
                            'site_logo' => base_url() . $this->global_config->site_logo,
                            'name' => $firstname . " " . $lastname,
                            'site_link' => base_url()
                        ];
                        $user_email = $this->parse_email_template($email_raw->userMessage, $user_replace);
                        $this->email->from('info@kamalashipalace.com', 'Kamalashi Palace.');
                        $this->email->to($email);
                        $this->email->subject($email_raw->userSubject);
                        $this->email->message($user_email);
                        $this->email->set_mailtype("html");
                        $this->email->send();

                        $admin_replace = [
                            'site_logo' => base_url() . $this->global_config->site_logo,
                            'name' => $firstname . " " . $lastname,
                            'email' => $email,
                            'phone' => $phone,
                            'address' => $address,
                            'site_link' => base_url()
                        ];
                        $admin_email = $this->parse_email_template($email_raw->adminMessage, $admin_replace);
                        $this->email->from('info@kamalashipalace.com', 'Kamalashi Palace.');
                        $this->email->to($email_raw->adminEmail);
                        $this->email->subject($email_raw->adminSubject);
                        $this->email->message($admin_email);
                        $this->email->set_mailtype("html");
                        $this->email->send();
                        $result['action'] = 'success';
                        $result['msg'] = 'Thank you! Your booking has been placed. We will contact you to confirm about the booking soon.';
                    } else {
                        $result['action'] = 'error';
                        $result['msg'] = 'Unable to confirm Booking.Please try again!';
                    }
                } else {
                    $result['action'] = 'error';
                    $result['msg'] = 'Captcha Not verified!';
                }
            } else {
                $result['action'] = 'error';
                $result['msg'] = 'Captcha Not verified!';
            }
            echo json_encode($result);
            exit;
        }
    }

}
