<?php
// ini_set('display_error', 'On');
// error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');
class Change_password extends CI_Controller {

	function __construct(){
		parent::__construct();
		//initialise the autoload things for this class
		$this->load->model('AdminModel');
		$this->load->model('Si_Model');
	}

	public function index()
	{
		// if(!isset($this->session->fi_session)){
		// 	redirect('/','refresh');
		// }
    $id=base64_decode($this->input->get('rid'));
 	 // echo $id;die;
 	 $this->session->set_userdata('change_id',$id);
 	 redirect('change_password/create_new_password');

	}
  public function create_new_password()
  {


   error_reporting(0);

   // print_r($this->input->get('id'));die;
   $user_id=$this->session->userdata('change_id');
   $data['user_id']=$user_id;

   $data['alert']    = $this->session->flashdata('alert');
   $data['error']    = $this->session->flashdata('error');
   $data['success']  = $this->session->flashdata('success');

   // $this->load->view('fi/header');
   // $this->load->view('fi/sidebar');
   $this->load->view('fi/change_password_page',$data);
   // $this->load->view('fi/footer');
  }

  public function update_change_password()
  {


   $user_id=$this->input->post('user_id');
   $password= base64_encode($this->input->post('password'));
   $item['password']=$password;

   if ($this->db->where('id',$user_id)->update('users',$item)){
     // echo "string";die;
   $this->session->set_flashdata('success',"Password Change Successfully..!!");
   redirect('/');
   }
   else{
     // echo "2";die;
   $this->session->set_flashdata('error',"Something went wrong ..!!");
   redirect('/');
   }


  }





}
