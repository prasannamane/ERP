<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(0);

defined('BASEPATH') or exit('No direct script access allowed');

class Fi_home_ajax extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('DashboardModel');
        $this->load->model('Attachment_Model');
        $this->load->model('TaskModel');
        $this->load->model('HomeModel');
    }

    //Nov 11, 2020
    public function addnewuser()
    {
        $cnt = $this->AdminModel->check_email_exist($this->input->post('user_email'));
        if ($cnt == 0) {
            $arr = array(
                "company"   => $this->input->post('company'),
                "title"     => $this->input->post('title'),
                "name"      => ucwords($this->input->post('user_fname')),
                "email"     => $this->input->post('user_email'),
                "username"  => $this->input->post('user_name'),
                "password"  => base64_encode($this->input->post('user_password')),
                "status"    => 0,
                "type"      => 1,
                "verified"  => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "last_name" => '',
                "admin_role_id" => '1',
                "user"    => $this->session->fi_session['id']
            );

            $rid = $this->AdminModel->user_register($arr);

            if ($rid > 0) {
                $userid     = base64_encode($rid);
                $url        = base_url() . "change_password?rid=" . $userid;
                $message    = "";

                $this->email->set_mailtype("html");
                $this->email->from('admin@tourmainevent.com', 'Our Main Event App');
                $this->email->to($this->input->post('user_email'));
                $this->email->subject('Thank You for Registration - Our Main Event App');
                $this->email->message($message);
                $this->email->send();

                $this->session->set_flashdata('success', "New User Register Succfully..!!");
                redirect('Fi_home_ajax/new_company');
            } else {
                $this->session->set_flashdata('error', "Something Went wrong..!!");
                redirect('Fi_home_ajax/new_company');
            }
        } else {
            $this->session->set_flashdata('error', "Email Already Registered..!!");
            redirect('Fi_home_ajax/new_company');
        }
    }

    public function location()
    {
        $id = $this->input->post('id');
        $start_date = $this->input->post('start_date');
        $start_time = $this->input->post('start_time');

        $cond = array('location_id' => $id);
        $array_data = array(
            'location_date' => $start_date,
            'location_time' => $start_time
        );
        $tbl = "event_location";
        $this->HomeModel->update_data($tbl, $cond, $array_data);
    }

    public function vendoradd()
    {
        $id = $this->input->post('id');
        $ot = $this->input->post('ot');
        $end_date = $this->input->post('end_date');
        $end_time = $this->input->post('end_time');
        $location = $this->input->post('location');
        $vendorID = $this->input->post('vendortype');
        $start_date = $this->input->post('start_date');
        $crews_hide = $this->input->post('crews_hide');
        $start_time = $this->input->post('start_time');
        $crews_end_date = $this->input->post('crews_end_date');
        $crews_commited = $this->input->post('crews_commited');

        $cond = array('crews_start_date' => $start_date, 'crews_vendor' => $vendorID, 'user' => $this->session->fi_session['id']);
        $tbl = "event_crews";
        $res = $this->HomeModel->get_all_by_cond($tbl, $cond);

        if (count($res) > 0) {
            echo "Event already exist for this date! Continue?";
        } else {
            $cond = array('crews_id' => $id);
            $array_data = array(
                'crews_start_date' => $start_date,
                'crews_start_time' => $start_time,
                'crews_end_date' => $end_date,
                'crews_end_time' => $end_time,
                'crews_location' => $location,
                'crews_over_time' => $ot,
                'crews_vendor' => $vendorID,
                'crews_commited' => $crews_commited,
                'crews_hide' => $crews_hide
            );
            $tbl = "event_crews";
            $this->HomeModel->update_data($tbl, $cond, $array_data);


            $cond = array('InvoiceId' => $id, 'vendor_id' => $vendorID, 'user' => $this->session->fi_session['id']);
            $tbl = "purchase";
            if (count($this->HomeModel->get_all_by_cond($tbl, $cond)) == 0) {
                $cond['pdate'] = date('Y-m-d');
                $cond['duedate'] = date('Y-m-d');
                $this->HomeModel->insertdata($tbl, $cond);
            } else {
                //$array_data = array('InvoiceId' =>$id);
                //$this->HomeModel->update_data($tbl, $cond, $array_data);
            }
        }
    }

    public function vendorUpdate()
    {
        $id = $this->input->post('id');
        $ot = $this->input->post('ot');
        $end_date = $this->input->post('end_date');
        $end_time = $this->input->post('end_time');
        $location = $this->input->post('location');
        $vendorID = $this->input->post('vendortype');
        $start_date = $this->input->post('start_date');
        $crews_hide = $this->input->post('crews_hide');
        $start_time = $this->input->post('start_time');
        $crews_end_date = $this->input->post('crews_end_date');
        $crews_commited = $this->input->post('crews_commited');



        $cond = array('crews_start_date' => $start_date, 'crews_vendor' => $vendorID);
        $tbl = "event_crews";
        $res = $this->HomeModel->get_all_by_cond($tbl, $cond);

        //print_r($this->db->last_query());


        $cond = array('crews_id' => $id);
        $array_data = array(
            'crews_start_date' => $start_date,
            'crews_start_time' => $start_time,
            'crews_end_date' => $end_date,
            'crews_end_time' => $end_time,
            'crews_location' => $location,
            'crews_over_time' => $ot,
            'crews_vendor' => $vendorID,
            'crews_commited' => $crews_commited,
            'crews_hide' => $crews_hide
        );
        $tbl = "event_crews";
        $this->HomeModel->update_data($tbl, $cond, $array_data);


        $cond = array('InvoiceId' => $id, 'vendor_id' => $vendorID, 'user' => $this->session->fi_session['id']);
        $tbl = "purchase";
        if (count($this->HomeModel->get_all_by_cond($tbl, $cond)) == 0) {
            $cond['pdate'] = date('Y-m-d');
            $cond['duedate'] = date('Y-m-d');
            $this->HomeModel->insertdata($tbl, $cond);
        } else {
            //$array_data = array('InvoiceId' =>$id);
            //$this->HomeModel->update_data($tbl, $cond, $array_data);
        }
    }

    public function crews_hide()
    {
        $id = $this->input->post('id');
        $crews_hide = $this->input->post('crews_hide');
        if ($crews_hide == "1") {
            $crews_hide = 1;
        } else {
            $crews_hide = 0;
        }
        $cond = array('crews_id' => $id);
        $array_data = array('crews_hide' => $crews_hide);
        $tbl = "event_crews";
        $this->HomeModel->update_data($tbl, $cond, $array_data);
    }

    public function crews_commited()
    {
        $id = $this->input->post('id');
        $crews_commited = $this->input->post('crews_commited');
        if ($crews_commited == "on") {
            $crews_commited = 1;
        } else {
            $crews_commited = 0;
        }
        $cond = array('crews_id' => $id);
        $array_data = array('crews_commited' => $crews_commited);
        $tbl = "event_crews";
        $this->HomeModel->update_data($tbl, $cond, $array_data);
    }

    public function create_new_company()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/createCompany', $data);
        $this->load->view('fi/footer');
    }



    //Delete after August 07,2021
    //Prasanna MAne
    //Updated March 07, 2021

    public function new_company($id = 0)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        if ($id > 0) {
            $cond = array('id ' => $id);
            $tbl = 'users';
            $array_data = array('status' => '1');
            $this->HomeModel->update_data($tbl, $cond, $array_data);
            //$this->HomeModel->delete_data($tbl, $cond);
            $data['success']  = 'User deleted successfully ..!';
        }

        $cond = array('status' => '0', 'admin_role_id ' => 1, 'user' => $this->session->fi_session['id']);
        $tbl = 'users';
        $data['user'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $data['page_title'] = "New Company";
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/new_company', $data);
        $this->load->view('fi/footer');
    }
}
