.<?php
// ini_set('display_error', 'On');
// error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor_attachment extends CI_Controller {

	function __construct(){
		parent::__construct();
		//initialise the autoload things for this class
		$this->load->model('Vendor_attachment_Model');
	}

	public function index()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user'] 	  = $this->db->get('user_register')->result_array();
		$data['search']  			=  $this->Vendor_attachment_Model->search_data();

		$data['single_cust']  	= $this->Vendor_attachment_Model->search_data()[0];

		
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/vendor_attachments',$data);
		$this->load->view('fi/footer');
	}

	public function fncrevntattachment()
	{
		$this->Vendor_attachment_Model->fncrevntattachment_dtls();
	}

	public function fndeleteattachment()
	{
		$this->Vendor_attachment_Model->fndeleteattachment_dtls();
	}

	public function fnupdateattchment()
	{

		 // print_r($_FILES);die;

			if(isset( $_FILES['image']['name'])!="")
				{
					//echo "1st If ".$_FILES['image']['name']; die;
			
						$config['upload_path']   = 'uploads/vendor_attachments';

						$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';

						$this->load->library('upload', $config);

						$this->upload->initialize($config);

						$img_nm = "";

					if ($this->upload->do_upload('image'))
						{
								$data = array('upload_data' => $this->upload->data());
								$img_nm = $this->upload->data('file_name');
						}

					   
						if(isset($_FILES['image']['name'])!="")
						{

							//echo "2nd If --".$img_nm;

							$ext = pathinfo($img_nm, PATHINFO_EXTENSION);

							//echo "ext--".$ext;die;
							

							$postfsize=$_FILES['image']['size'];

							$calfsize="";

							 if($postfsize>0)
							 {

							 	//echo "postfsize--".$postfsize."<br>";

							 	 $calfsize=$postfsize;

							 	 if ($calfsize >= 1073741824)
							        {
							            $calfsize = number_format($calfsize / 1073741824, 2) . ' GB';
							        }
							        elseif ($calfsize >= 1048576)
							        {
							            $calfsize = number_format($calfsize / 1048576, 2) . ' MB';
							        }
							        elseif ($calfsize >= 1024)
							        {
							            $calfsize = number_format($calfsize / 1024, 2) . ' KB';
							        }
							        elseif ($calfsize > 1)
							        {
							            $calfsize = $calfsize . ' bytes';
							        }
							        elseif ($calfsize == 1)
							        {
							            $calfsize = $calfsize . ' byte';
							        }
							        else
							        {
							            $calfsize = '0 bytes';
							        }

							        //echo "calfsize--".$calfsize;die;
							 }

							$data1['attach_file_name']  = $img_nm;
							$data1['attach_file_type']  = $ext;
							$data1['attach_file_size']  = $calfsize;
							$data1['date']  = $_POST['date'];
							$data1['note']  = $_POST['notes'];
						

							
							if($this->Vendor_attachment_Model->fnupdateattchment_dtls($data1)){
							   $this->session->set_flashdata('success', 'Attachment Updated SuccessFully ..!');
							   redirect('vendor_attachment');

								//echo "success";
							}
							else{
							  $this->session->set_flashdata('error', 'Something Went Wrong..!');
							  redirect('vendor_attachment');
							
								//echo "error";
							}

						}
							/*	else
								{
									$data1['cat_name'] = $this->input->post('txtcatname');
									$data1['status']  = $this->input->post('txtsts');
									
									if($this->Vendor_attachment_Model->fnupdateattchment_dtls($data1))
									{
									$this->session->set_flashdata('success', 'Attachment Updated SuccessFully ..!');
									redirect('vendor_attachment');
									}
									else
									{
									$this->session->set_flashdata('error', 'Something Went Wrong..!');
									redirect('vendor_attachment');
									}
								}*/
			}					  
	}

  

   public function fnsearchattchmentsbyph()
	{
	  $this->Vendor_attachment_Model->fnsearchattchmentsbyph_dtls();
	}



	



}
