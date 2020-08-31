<?php

class Booking extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('booking_model', 'booking');
        $this->load->model('accomodation_model', 'accomodation');
        $this->load->model('countries_model', 'countries');
        $this->data['module_name'] = 'Booking Manager';
        $this->data['show_add_link'] = false;
        $this->data['show_sort_link'] = false;
        $this->header['page_name'] = $this->router->fetch_class();
        $this->data['controller'] = $this;
    }

    public function index() {
        $query = "SELECT * FROM `tbl_booking`";
        $this->data['sub_module_name'] = 'Booking List';
        $this->data['booking'] = $this->booking->query($query);
        $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/pages/booking.js');
        $this->data['body'] = BACKENDFOLDER . '/booking/_list';
        $this->render();
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
                    //Update Total booked of each room 
                    $booked_data = $this->booking->get('1', ['id' => $selected_id]);
                    $json = json_decode($booked_data->json_data);
                    foreach ($json as $key => $value) {
                        $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                        $updatedata = array(
                            'total_booked' => $accomodata->total_booked - $value
                        );
                        $condition = array('id' => $accomodata->id);
                        $this->accomodation->save($updatedata, $condition);
                    }

                    //Update Availability flag
                    $accomodation_data = $this->accomodation->get();
                    foreach ($accomodation_data as $key => $value) {
                        if ($value->total_count > $value->total_booked) {
                            $update = array(
                                'availability_flag' => '0'
                            );
                            $condition = array('id' => $value->id);
                            $this->accomodation->save($update, $condition);
                        }
                    }
                    $res = $this->booking->delete(array('id' => $selected_id));
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
                //Update Total booked of each room 
                $booked_data = $this->booking->get('1', ['id' => $id]);
                $json = json_decode($booked_data->json_data);
                foreach ($json as $key => $value) {
                    $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                    $updatedata = array(
                        'total_booked' => $accomodata->total_booked - $value
                    );
                    $condition = array('id' => $accomodata->id);
                    $this->accomodation->save($updatedata, $condition);
                }

                //Update Availability flag
                $accomodation_data = $this->accomodation->get();
                foreach ($accomodation_data as $key => $value) {
                    if ($value->total_count > $value->total_booked) {
                        $update = array(
                            'availability_flag' => '0'
                        );
                        $condition = array('id' => $value->id);
                        $this->accomodation->save($update, $condition);
                    }
                }
                $res = $this->booking->delete(array('id' => $id));

                $success_msg = $res ? 'Data deleted' : 'Error in deleting data';
            } else {
                $msg = 'This data cannot be deleted. It is being used in system.';
            }

            $success_msg ? set_flash('msg', $success_msg) : set_flash('msg', $msg);
        }

        redirect(BACKENDFOLDER . '/booking');
    }

    public function status() {
        $status = segment(4);
        $id = segment(5);
        $post['status'] = $status;
        if ($post['status'] == 'Completed') {
            //Update Total booked of each room 
            $booked_data = $this->booking->get('1', ['id' => $id]);
            $json = json_decode($booked_data->json_data);
            foreach ($json as $key => $value) {
                $accomodata = $this->accomodation->get('1', ['slug' => $key]);
                $updatedata = array(
                    'total_booked' => $accomodata->total_booked - $value
                );
                $condition = array('id' => $accomodata->id);
                $this->accomodation->save($updatedata, $condition);
            }

            //Update Availability flag
            $accomodation_data = $this->accomodation->get();
            foreach ($accomodation_data as $key => $value) {
                if ($value->total_count > $value->total_booked) {
                    $update = array(
                        'availability_flag' => '0'
                    );
                    $condition = array('id' => $value->id);
                    $this->accomodation->save($update, $condition);
                }
            }
        }

        $res = $this->booking->save($post, ['id' => $id]);
        if ($res)
            set_flash('msg', 'Status changed');
        else
            set_flash('msg', 'Status could not be changed');
        redirect(BACKENDFOLDER . '/booking');
    }

    public function view($id) {

        $q = "SELECT * FROM `tbl_booking` WHERE `id` = $id";
        $this->data['sub_module_name'] = 'Booking Detail';
        $detail = $this->booking->query($q);
        $this->data['detail'] = $detail[0];
        $this->data['body'] = BACKENDFOLDER . '/booking/_view';
        $this->data['addJs'] = array('assets/' . BACKENDFOLDER . '/js/pages/booking.js');
        $this->render();
    }

    public function getCountryName($id) {
        $res = $this->countries->get('1', ['id' => $id]);
        return $res->name;
    }

}
