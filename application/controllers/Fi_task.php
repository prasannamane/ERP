<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Fi_task extends CI_Controller 
	{
		function __construct(){
			parent::__construct();
			//initialise the autoload things for this class
    		$this->load->model('AdminModel');
		}

		public function task_history()
		{
  			$data['alert']     = $this->session->flashdata('alert');
  			$data['error']     = $this->session->flashdata('error');
  			$data['success']   = $this->session->flashdata('success');

  			//$data['tasks']  = $this->db->query("SELECT * FROM invoice_task ORDER BY task_id ASC")->result_array();

     	    //echo "<pre>";print_r($data['missing']);die;
      		$data['status_id'] = $this->session->userdata('status_id');
			if ($data['status_id']=="") 
			{
	        	$data['status_id']=0;
      		}

			$this->load->view('fi/header');
			$this->load->view('fi/sidebar');
			$this->load->view('fi/task-history',$data);
			$this->load->view('fi/footer');
		}

    public function task_stauts($status_id){

      // print_r($status_id);die;
      $this->session->set_userdata("status_id", $status_id);
      redirect('fi_task/task_history');
    }
    public function invoice_open(){

      // print_r($status_id);die;
				$cus_id	= $this->input->post('cusId');

				// $customersql=$this->db->query("SELECT * FROM register_customer WHERE cus_id=".$cus_id."");
				// $customersql->result()[0];

				$query_data = $this->db->select('*')
				         ->from('register_customer')
				         ->where(array("cus_id"=>$cus_id))
								 // ->order_by("event_type", "asc")
				         ->get()->result_array()[0];

								 $result_data=$query_data['cus_lname'].", ".$query_data['cus_fname']." - ". $query_data['cus_company_name']." - ".$query_data['cus_acc_no'];

								 echo $result_data;
      // redirect('fi_home/custinvoices');
    }





}
