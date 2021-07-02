<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 
    error_reporting(0);

    defined('BASEPATH') OR exit('No direct script access allowed');

    class CustomersNotes extends CI_Controller 
    {
    	public function __construct()
        {
            parent::__construct();
            //$this->load->model('AdminModel');
            //$this->load->model('DashboardModel');
            //$this->load->model('Attachment_Model');
            //$this->load->model('TaskModel');
            $this->load->model('HomeModel');
            $this->load->model('CustomersNotesModel');
        }

        public function Save_Notis()
        {
        	$event_name = $this->input->post('event_name');
        	$inv_id = $this->input->post('id');
        	$note = $this->input->post('note_desc1');
        	$user = $this->session->fi_session['id'];
            $cus_id = $this->session->userdata('id');

        	$currentTimeinSeconds = time();  
        	$currentDate = date('Y-m-d', $currentTimeinSeconds);
        	$currentTime = date('h:i A', $currentTimeinSeconds);

      		$data = array(
        		'date'    => $currentDate,
        		'time'    => $currentTime,
        		'inv_id'  => $inv_id,
        		'note'    => $note,
        		'event_name' => $event_name,
        		'user' => $user,
                'cus_id' => $cus_id
        	);

        	$tbl = 'customer_invoice_notes';
        	$result = $this->HomeModel->insertdata($tbl, $data);
        }



    }