<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fi_calendar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //initialise the autoload things for this class
        $this->load->model('AdminModel');
    }

    public function index()
    {
        $data['alert']     = $this->session->flashdata('alert');
        $data['error']     = $this->session->flashdata('error');
        $data['success']   = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/calendar/MyCalendar');
        $this->load->view('fi/footer');
    }

    public function get_event()
    {
        $calendar_session = $this->session->userdata("calendar_search_form");

        $data  =   $this->db->select('e.*,l.location_type')
            ->from('events_register e')
            ->join("event_location l", "e.event_id=l.event_id", 'left')
            ->get()->result_array();
        $list = array();
        foreach ($data as $key) {

            $color = "#3788d8";
            if ($key['event_booked'] == 1) {
                $color = "#3F8B43";
            }

            // Fetch location color from type
            if ($key['location_type'] != "" && !is_null($key['location_type'])) {
                $loc_color_detail = $this->db->query("SELECT location_color FROM add_location_event WHERE location_name='" . $key['location_type'] . "'")->row();

                if (!is_null($loc_color_detail->location_color)) {
                    $loc_color = $loc_color_detail->location_color;
                } else {
                    $loc_color = $color;
                }
            } else {
                $loc_color = $color;
            }

            $list[] = array(
                'id' => $key['event_id'],
                'title' => $key['event_id'] . " " . $key['event_time'] . " " . $key['event_name'] . " - " . $key['location_type'],
                //added and then commented by suchita on 13-1-20 'title'=>$key['event_hebrew_date']."-".$key['event_date']." ".$key['event_time']." ".$key['event_name']." - ".$key['location_type'],
                'start' => date("Y-m-d", strtotime($key['event_date'])),
                'color' => $color,
                'url' => base_url("fi_home/calender_search_cus/" . $key['event_id']),
                //'url' => "http://tech599.com/tech599.com/johnsum/erp_new/fi_home/calender_search_cus/" . $key['event_id'],
                'description' => "Event",
                'borderColor' => $loc_color
            );
        }



        // Fetch Todo's and Appointmnet that are not completed.
        // 1.Fetch Appointments --------------------------------
        $app_color_details = $this->db->query("SELECT * FROM adm_todo_status WHERE name='Appointment'")->row();
        $app_color = $app_color_details->color;

        if (isset($calendar_session['app_check']) && $calendar_session['app_check'] == "on") {
            $q = "SELECT id, appointment_type, app_desc, note_datetime FROM customer_appointment WHERE iteam_check=0 AND appointment_type='Appointment'";
            $data = $this->db->query($q)->result_array();
            foreach ($data as $key) {

                if ($key['appointment_type'] == "Appointment") {
                    $color = $app_color;
                } else if ($key['appointment_type'] == "Todo") {
                    $color = $todo_color;
                }


                $list[] = array(
                    'id' => $key['id'],
                    'title' => $key['id'] . " " . $key['appointment_type'] . " " . $key['app_desc'],
                    'start' => date("Y-m-d", strtotime($key['note_datetime'])),
                    'color' => $color,
                    'url' => base_url("fi_notes/view_todo/"),
                    //'url' => "http://tech599.com/tech599.com/johnsum/erp_new/fi_notes/view_todo/",
                    'description' => "AppTodo"
                );
            }
        }

        // 1.Fetch Todo  --------------------------------------------------
        $todo_color_details = $this->db->query("SELECT * FROM adm_todo_status WHERE name='Todo'")->row();
        $todo_color = $todo_color_details->color;

        if (isset($calendar_session['todo_check']) && $calendar_session['todo_check'] == "on") {
            $q = "SELECT id, appointment_type, app_desc, note_datetime FROM customer_appointment WHERE iteam_check=0 AND appointment_type='Todo'";
            $data = $this->db->query($q)->result_array();
            foreach ($data as $key) {

                if ($key['appointment_type'] == "Appointment") {
                    $color = $app_color;
                } else if ($key['appointment_type'] == "Todo") {
                    $color = $todo_color;
                }


                $list[] = array(
                    'id' => $key['id'],
                    'title' => $key['id'] . " " . $key['appointment_type'] . " " . $key['app_desc'],
                    'start' => date("Y-m-d", strtotime($key['note_datetime'])),
                    'color' => $color,
                    'url' => base_url("fi_notes/view_todo/"),
                    //'url' => "http://tech599.com/tech599.com/johnsum/erp_new/fi_notes/view_todo/",
                    'description' => "AppTodo"
                );
            }
        }

        // Fetch vendors for event.
        if (isset($calendar_session['ven_check']) && $calendar_session['ven_check'] == "on") {
            if (isset($calendar_session['vendor']) && $calendar_session['vendor'] != "") {
                $q = "SELECT e.event_id, e.event_date, c.crews_vendor FROM events_register e JOIN event_crews c ON e.event_id = c.event_id WHERE c.crews_vendor!='' AND c.crews_vendor LIKE '%" . $calendar_session['vendor'] . "%'";
            } else {
                $q = "SELECT e.event_id, e.event_date, c.crews_vendor FROM events_register e JOIN event_crews c ON e.event_id = c.event_id WHERE c.crews_vendor!=''";
            }

            $data = $this->db->query($q)->result_array();
            foreach ($data as $key) {

                $color = "#E251EC";

                $list[] = array(
                    'id' => $key['event_id'],
                    'title' => $key['event_id'] . " " . $key['crews_vendor'],
                    'start' => date("Y-m-d", strtotime($key['event_date'])),
                    'color' => $color,
                    'url' => base_url("fi_home/calender_search_cus/" . $key['event_id']),
                   //'url' => "http://tech599.com/tech599.com/johnsum/erp_new/fi_home/calender_search_cus/" . $key['event_id'],
                    'description' => "Vendor"
                );
            }
        }

        echo json_encode($list);
    }

    public function calendar_search()
    {
        $this->session->set_userdata("calendar_search_form", $this->input->post());
        redirect("Fi_calendar/index");
    }

    public function update_event()
    {
        $editcus['event_date'] = date("Y-m-d", strtotime($this->input->post('event_start_date')));
        $id          = $this->input->post('id');
        if ($this->db->where('event_id', $id)->update('events_register', $editcus)) {
            if ($this->input->post("loc_confirm") == "Yes") {
                $result = $this->db->where('event_id', $id)->update('event_location', array("location_date" => date("Y-m-d", strtotime($this->input->post('event_start_date')))));
            }

            if ($this->input->post("loc_confirm1") == "Yes") {
                $result = $this->db->where('event_id', $id)->update('event_crews', array("crews_start_date" => date("Y-m-d", strtotime($this->input->post('event_start_date')))));
            }

            echo "1";
        } else {
            echo "2";
        }
    }
}
