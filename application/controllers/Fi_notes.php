<?php

	error_reporting(0); 
	/*
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fi_notes extends CI_Controller 
	{

		function __construct()
		{
			parent::__construct();
			//initialise the autoload things for this class
    		$this->load->model('AdminModel');
    		$this->load->model('TaskModel');		
		}

		public function addappointment() 
		{
			$data['cus_id']					= $this->input->post('cus_id');
			$data['appointment_type']		= $this->input->post('notestype');
			$data['app_desc']				= $this->input->post('app_desc');
			$data['note_datetime']			= date('Y-m-d H:i:s', strtotime($this->input->post('note_datetime'))); 
			$data['note_time']				= $this->input->post('note_time');
			$data['notestype_user']			= $this->input->post('notestype_user');
			$data['appointmtnt_note']		= $this->input->post('appointmtnt_note');
			$data['appointment_priority']	= $this->input->post('appointment_priority');
			$data['note_date']				= $this->input->post('note_date');
			$data['note_remider']			= $this->input->post('note_remider');
			$data['users_id']				= $this->input->post('note_user');
			$data['created_at']				= date("Y-m-d H:i:s");
			$data['users_id']				= $this->session->fi_session['id'];
			$data['for_user']				= $this->input->post('for_user');

			if (!empty($this->input->post('iteam_check'))) 
			{
				$data['iteam_check']	=	$this->input->post('iteam_check');
			}
			else 
			{
				$data['iteam_check']	=	'0';
			}

			if($this->AdminModel->addappointmentdata($data))
			{
				$this->session->set_flashdata('success', 'Appointment Created SuccessFully ..!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Something Went Wrong..!');
			} 
			redirect('fi_home/c_notes');
		}

		public  function send_mail() {

			$comment_ 	= $this->input->post('comment_');
			$subject_ 	= $this->input->post('subject_');
			$email_ 	= $this->input->post('email_');

			print_r($comment_ );
			print_r($subject_);
			print_r($email_ );

			if(mail($email_,$subject_,$comment_)){
			    return true;    
			}
			else{
			    return false;
			}
			
		}

		public function c_notes() 
		{

	  		if(!isset($this->session->fi_session)){
	  			redirect('/','refresh');
	  		}

	  		if($cus_id == ''){
                $cus_id = $this->session->userdata('id');
            }
            //print_r($cus_id);
            
            if (empty($cus_id) || $cus_id =="" || $cus_id == 'null' ) {
                $cus_id = 0;
            }
            
            $event_data['cus_id']      = $cus_id;
			
			$this->session->unset_userdata('event_page', '');
			$cus_id 					= $this->session->userdata('id');
			$event_data['single_cust'] 	= $this->AdminModel->search_data()[0];
			$event_data['search']  		= $this->AdminModel->search_data();
		    $event_data['last_row'] 	= $this->db->where('cus_id',$cus_id)->get('register_customer')->result_array()[0];
			$invoice_id 				= $this->db->SELECT('invoice_id')->where('cust_id',$cus_id)->get('invoices_create')->result_array();
			$inv_id 					= "";

			foreach ($invoice_id as $key ) {
				if ($inv_id =="") {
					$inv_id = $key['invoice_id'];
				}
				else {
					$inv_id = $inv_id.",".$key['invoice_id'];
				}
			}

			$squery 	= "SELECT * FROM customer_invoice_notes WHERE FIND_IN_SET (inv_id,'$inv_id')";
			$event_data['invoice_note'] 	= $this->db->query($squery)->result_array();

			$event_data['appointmtnt'] 		= $this->db->select('c.*, u.username' )
			->where('cus_id',$cus_id)
			->join('users u', 'u.id=c.for_user', 'left')
			->order_by('c.note_datetime', 'ASC')
			->get('customer_appointment c')
			->result_array();

			$event_data['corr_email'] 	= $this->db->select('c.*, uc.email')
			->join('user_contact_info uc', 'uc.email=c.sender_mail', 'left')
			->where('uc.cus_id', $cus_id)
			->get('correspondence c')
			->result_array();

			$corr_email = $event_data['corr_email'];
			$sender_mail = $corr_email[0];
			$event_data['sender_mail'] = $sender_mail['sender_mail'];

			$event_data['alert']     = $this->session->flashdata('alert');
			$event_data['error']     = $this->session->flashdata('error');
			$event_data['success']   = $this->session->flashdata('success');

			// Fetch dropdown values for TODo Description & Appointment Description
			$event_data['todo_descp_list'] 	= $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='24'")->result_array();
			$event_data['appnt_descp_list'] = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='38'")->result_array();
			$event_data['for_user'] 		= $this->db->query("SELECT `id`, `username` FROM `users` WHERE admin_role_id=2")->result_array();
			
	
	  		$this->load->view('fi/header');
	  		$this->load->view('fi/sidebar');
	  		$this->load->view('fi/customer/notes',$event_data);
	  		$this->load->view('fi/footer');
	  	}

		public function updateappointment() {

        	$result=$this->AdminModel->updateappointment();
    	}



		public function view_todo($id) {

			if(!isset($this->session->fi_session)){
				redirect('/','refresh');
			}

			$this->session->unset_userdata('appointment_id');
			$data['todo_data']  = $this->TaskModel->view_todo($id); 

    		$this->load->view('fi/header');
    		$this->load->view('fi/sidebar');
    		$this->load->view('fi/todo_listview',$data);
    		$this->load->view('fi/footer');

			}

		public function addcorrespondence() {

			if(!isset($this->session->fi_session)){
				redirect('/','refresh');
			}

			$data['cus_id']					= $this->input->post('cus_id');
			$data['correspondence_date']	= $this->input->post('correspondence_date');
			$data['correspondence_time']	= $this->input->post('correspondence_time');
			$data['correspondence_note']	= $this->input->post('correspondence_note');
			$data['correspondence_desc']	= $this->input->post('correspondence_desc');
			$data['created_at']				= date("Y-m-d H:i:s");

			if($this->AdminModel->addcorrespondence($data)) {

				$this->session->set_flashdata('success', 'Correspondencet Created SuccessFully ..!');
				redirect('fi_home/c_notes');
			}
			else{
				$this->session->set_flashdata('error', 'Something Went Wrong..!');
				redirect('fi_home/c_notes');
			}
			}



		



		public function index() {

			if(!isset($this->session->fi_session)){
				redirect('/','refresh');
			}
	    		$data['alert']     = $this->session->flashdata('alert');
	    		$data['error']     = $this->session->flashdata('error');
	    		$data['success']   = $this->session->flashdata('success');

	    		//$data['dash']  = $this->db->where('dash_status',1)->get('dashboard')->result_array();

	    		//echo "crntdat--".CURDATE();die;

	    		$where_con_event='event_date >= CURDATE() AND event_date <= DATE_ADD(CURDATE(), INTERVAL 2 WEEK) ORDER by event_id DESC LIMIT 3';
	    		$data['event']  = $this->db->select('cus_id,event_id,event_type,event_name,event_date')->where($where_con_event)->get('events_register')->result_array();

	    		$where_con_task='`task_date_started` <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) ORDER by i.task_id DESC LIMIT 3';
	    		$data['task']  = $this->db->select('i.task_id,i.task_date_started,a.name as type_name,ad.name as sub_name')->join("adm_task_type a", "i.task_type=a.id",'left')->join("adm_subtask_type ad", "i.sub_task_type=ad.id",'left')->where($where_con_task)->get('invoice_task i')->result_array();

	    		$where_con_missing='event_id NOT IN (SELECT event_id FROM `event_location`) AND  event_date >= CURDATE() AND event_date <= DATE_ADD(CURDATE(), INTERVAL 2 WEEK) ORDER by event_id DESC LIMIT 3';
	    		$data['missing']  = $this->db->select('cus_id,event_id,event_type,event_name,event_date')->where($where_con_missing)->get('events_register')->result_array();

	    		 //echo "<pre>";print_r($data['event']);die;

	    		$this->load->view('fi/header');
	    		$this->load->view('fi/sidebar');
	    		$this->load->view('fi/dash',$data);
	    		$this->load->view('fi/footer');
	    	}




	


		public function sendcusid($custid)
			{
				if(!isset($this->session->fi_session)){
					redirect('/','refresh');
				}
				// $cus_id=$_POST['custid'];
				// print_r($custid);die;
				$this->session->set_userdata('id',$custid);
				// print_r($this->session->userdata('id'));die;
 				redirect('fi_home/c_notes');
			}





		public function addfinal_app_todo()
			{
				if(!isset($this->session->fi_session)){
					redirect('/','refresh');
				}

				// echo "<pre>";print_r($this->input->post());die;

			$id	=	$this->input->post('appointmtnt_id');

			$data['appointment_type']	=	$this->input->post('appointment_type');
			$data['customer_assign_id']	=	$this->input->post('customer_id');
			$data['appointment_priority']	=$this->input->post('appointment_priority');
			$data['app_desc']	=	$this->input->post('appointmtnt_desc');
			$data['notestype_user']	=	$this->input->post('appointmtnt_user');
			$data['appointmtnt_phone']	=	$this->input->post('appointmtnt_phone');
			$data['note_datetime']	=	$this->input->post('appointmtnt_datetime');
			$data['note_time']	=	$this->input->post('appointmtnt_time');
			$data['note_date']	=	$this->input->post('note_dateenter');
			$data['note_user']	=	$this->input->post('user_name');
			// $data['appointmtnt_remider_date']	=	$this->input->post('appointmtnt_remider_date');
			// $data['appointmtnt_remider_time']	=	$this->input->post('appointmtnt_remider_time');
			if (!empty($this->input->post('appointmtnt_check'))) {

				$data['iteam_check']	=	$this->input->post('appointmtnt_check');
			}
			else {
				$data['iteam_check']=0;
			}
			$data['created_at']	=	date("Y-m-d H:i:s");

			// echo "<pre>";print_r($data);die;

			if($this->db->where('id',$id)->update('customer_appointment',$data)){
			$this->session->set_flashdata('success', 'Update SuccessFully ..!');
			redirect('fi_home/to_do_list');
			}
			else{
			$this->session->set_flashdata('error', 'Something Went Wrong..!');
			redirect('fi_home/to_do_list');
			}
			}

		


		public function dissmiss_reminder()
			{
				if(!isset($this->session->fi_session)){
					redirect('/','refresh');
				}

				$data['reminder_status']      	= 1;

				if ($this->db->where('id',$this->input->post('reminderid'))->update('reminder_entry',$data)) {
	    		echo "success";
	    	}else{
				echo "error";
	    	}
			}
		public function snooze_reminder()
			{
				if(!isset($this->session->fi_session)){
					redirect('/','refresh');
				}


				$current_time=date("Y-m-d H:i:s");
				$snooze_time=$this->input->post('snooze_time');
				$newTime = date("Y-m-d H:i:s",strtotime($current_time." +".$snooze_time." minutes"));
				$data['reminder_datetime']      	= $newTime;
				if ($this->db->where('id',$this->input->post('reminderid'))->update('reminder_entry',$data)) {
	    		echo "success";
	    	}else{
				echo "error";
	    	}
			}





}
