<?php

	//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
	error_reporting(0); 
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Attachment extends CI_Controller 
	{

		public function __construct() 
		{
			parent::__construct();
			require_once APPPATH."/third_party/PhpWord/PhpWord.php";
			$this->load->library('Phpword');
			$this->load->model('Attachment_Model');
		}

		public function fnsearchcustattchment()
		{
			$cus_id = $this->input->post('custid');
			$this->session->set_userdata('id',$cus_id);
		  	$this->Attachment_Model->fnsearchcustattchment_dtls();
		}

		public function fnsearchattchmentsbyph()
		{
		  	$this->Attachment_Model->fnsearchattchmentsbyph_dtls();
		}

		public function index() 
		{
			if(!isset($this->session->fi_session))
			{
				redirect('/','refresh');
			}
				   
			if($cus_id == '')
			{
                $cus_id = $this->session->userdata('id');
			}
			
			if (empty($cus_id) || $cus_id =="" || $cus_id == 'null' ) 
			{
                $cus_id = 0;
            }
			
			$data['cus_id']      = $cus_id;
			$data['alert']    = $this->session->flashdata('alert');
			$data['error']    = $this->session->flashdata('error');
			$data['success']  = $this->session->flashdata('success');
			// $data['user'] 	  = $this->db->get('user_register')->result_array();
			$data['search']  			=  $this->Attachment_Model->search_data();
			$data['single_cust']  	= $this->Attachment_Model->search_data()[0];
			// print_r($data['single_cust']);die;
			$this->session->unset_userdata('event_page', '');
			$this->load->view('fi/header');
			$this->load->view('fi/sidebar');
			$this->load->view('fi/customer/custattachments',$data);
			$this->load->view('fi/footer');
		}

		public function fncrevntattachment()
		{
			$this->Attachment_Model->fncrevntattachment_dtls();
		}

		public function fndeleteattachment()
		{
			$this->Attachment_Model->fndeleteattachment_dtls();
		}

		public function fnupdateattchment()
		{
			if(isset( $_FILES['image']['name'])!="")
			{
				$config['upload_path']   = 'uploads/customer_attachments';
				$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF|docx|docm|dotx|doc|pptx|pptm|ppt|zip';
				$this->load->library('upload', $config);

				$this->upload->initialize($config);
				$img_nm = "";
				
				if ($this->upload->do_upload('image'))
				{
					$data = array('upload_data' => $this->upload->data());
					$img_nm = $this->upload->data('file_name');
					$img_client_name = $this->upload->data('client_name');
				}

				if(isset($_FILES['image']['name'])!="")
				{
					$ext = pathinfo($img_nm, PATHINFO_EXTENSION);
					$postfsize=$_FILES['image']['size'];
					$calfsize="";

					if($postfsize>0)
					{
						$calfsize=$postfsize;
						if ($calfsize >= 1073741824) {
							$calfsize = number_format($calfsize / 1073741824, 2) . ' GB';
						}
						elseif ($calfsize >= 1048576) {
							$calfsize = number_format($calfsize / 1048576, 2) . ' MB';
						}
						elseif ($calfsize >= 1024) {
							$calfsize = number_format($calfsize / 1024, 2) . ' KB';
						}
						elseif ($calfsize > 1) {
							$calfsize = $calfsize . ' bytes';
						}
						elseif ($calfsize == 1) {
							$calfsize = $calfsize . ' byte';
						}
						else { $calfsize = '0 bytes'; }
					}

							$data1['attach_file_name']  = $img_nm;
							$data1['attach_file_client_name']  = $img_client_name;
							$data1['attach_file_type']  = $ext;
							$data1['attach_file_size']  = $calfsize;
							$data1['date']  = date("Y-m-d", strtotime($_POST['date']));
							$data1['note']  = $_POST['notes'];



					if($this->Attachment_Model->fnupdateattchment_dtls($data1))
					{
					   	$this->session->set_flashdata('success', 'Attachment Updated SuccessFully ..!');
					   	redirect('attachment');
					}
					else
					{
					  	$this->session->set_flashdata('error', 'Something Went Wrong..!');
						redirect('attachment');
					}
				}
			}
			else
			{
				redirect('attachment');
			}
		}




   public function getcustomer_data()
	{
		$cus_id=$this->input->post('id');
		$result_array = $this->db->select('register_customer.cus_lname,user_contact_info.email')
						 ->from('register_customer')
						 ->join("user_contact_info", "register_customer.cus_id=user_contact_info.cus_id")
						 ->where('register_customer.cus_id',$cus_id)
						 ->where('user_contact_info.email !=',"")
						 ->get()
						 ->result_array();
						 $str = "";
						 if (count($result_array)!="")
						 {
							 $i=1;
							foreach ($result_array as $customer)
							{
					 $str = $str.'<tr>
						 <td>
						 <input type="checkbox" class="toclass" value="1" name="task_to'.$i.'[]"></td>
						 <td><input type="checkbox" value="2" name="task_cc'.$i.'[]"></td>
						 <td><input type="checkbox" value="3" name="task_bcc'.$i.'[]"></td>

						 <td>
							 <input type="text" name="attach_mailid[]" class="form-control"  value="'.$customer['email'].'"> </td>
						 <td>
							 <input type="text" name="attach_mailidname[]" class="form-control" value="'. $customer['cus_lname'].'"> </td>
						 <td>
							 <input type="text" name="attach_mailidtype[]" class="form-control" value=""></td>

					 </tr>';
					 $i++;
						 }
							 echo $str;

	}
	else {
		echo "No Mail id.";
	}
}

  public function updatenotes()
   {
   	 $this->Attachment_Model->updatenotes_dtls();
   }
  public function sendattachmentemail()
   {
		 // echo "string";die;
		 // echo "<pre>";print_r($this->input->post());die;
		 $toadd="";
		 $tocc="";
		 $tobcc="";

		$to_address=$this->input->post('attach_mailid');
		$sub='ERP SYSTEM- Attachment';
		$msg=$this->input->post('invoice_payment');
		$pathToUploadedFile=$this->input->post('data_url');

		$fileData = array();
		// $files = $_FILES;
		$i=1;
		foreach ($to_address as $to_address) {

			if (isset($_POST['task_to'.$i])) {
				if ($toadd =="") {
					// code...
					$toadd=$to_address;
				}
				else {
					$toadd=$toadd.",".$to_address;
				}
 		 }
			if (isset($_POST['task_cc'.$i])) {
				if ($tocc =="") {
					// code...
					$tocc=$to_address;
				}
				else {
					$tocc=$tocc.",".$to_address;
				}
 		 }
			if (isset($_POST['task_bcc'.$i])) {
				if ($tobcc =="") {
					// code...
					$tobcc=$to_address;
				}
				else {
					$tobcc=$tobcc.",".$to_address;
				}
 		 }
 		 // echo $toadd;

			// echo "<pre>";print_r($to_address);
			$this->load->library('email');
			$this->email->set_mailtype("html");//mike222taylor@gmail.com
			$this->email->from('info@tech599.com', 'ERP SYSTEM- Attachment');
			$this->email->to($toadd);
			$this->email->cc($tocc);
			$this->email->bcc($tobcc);
			$this->email->subject($sub);
			$this->email->message($msg[2]);

			$this->email->attach($pathToUploadedFile);
			$i++;
		}
		// echo "string";die;
		// $this->load->library('email');
		// $this->email->set_mailtype("html");//mike222taylor@gmail.com
		// $this->email->from('info@tech599.com', 'ERP SYSTEM- Attachment');
		// $this->email->to($to);
		// $this->email->subject($sub);
		// $this->email->message($msg[2]);
		// // $pathToUploadedFile = $fileData[$i]['full_path'];
		// $this->email->attach($pathToUploadedFile);
 	 	if ($this->email->send()) {
			$this->session->set_flashdata('success',"Mail Send Successfully..!!");
		redirect('attachment');
 	 	}
		else {
			$this->session->set_flashdata('error',"Something Went wrong..!!");
		redirect('attachment');
		}
   }

	 public function updateattachname()
		{

			$notearr=array(
				"attach_file_client_name" => $this->input->post('file_name')
			);
		 $this->db->where("id", $this->input->post('attach_id'));
		 if($this->db->update('cus_attachment',$notearr))
				{
					echo "success";
				}
		}


}
