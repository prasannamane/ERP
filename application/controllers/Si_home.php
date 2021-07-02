<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Si_home extends CI_Controller 
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('AdminModel');
			$this->load->model('Si_Model');
			$this->load->model('HomeModel');
		}







	public function index()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']     = $this->session->flashdata('alert');
		$data['error']     = $this->session->flashdata('error');
		$data['success']   = $this->session->flashdata('success');

		$data['dash']  = $this->db->where('dash_status',1)->get('dashboard')->result_array();
		//$data['driver']  = $this->db->where('driver_active',1)->get('driver_registration')->result_array();
		// $data['cus_count'] =2;
		// $data['driver_count'] =2;
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/dash',$data);
		$this->load->view('fi/footer');
	}



	public function admin_item()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['item'] 	  = $this->db->get('admin_item')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_items',$data);
		$this->load->view('fi/footer');
	}
	public function additemadmin()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;
		$item['item_name']	=	$this->input->post('item_nane');
		$item['item_desc']	=	$this->input->post('item_desc');
		$item['item_price']	=	$this->input->post('item_price');
		$item1['iteam_texable']	=	$this->input->post('taxcheck');
		if ($item1['iteam_texable']=='on') {
			$item['iteam_texable']=1;
		}
		$item1['item_pickup_req']	=	$this->input->post('pickcheck');
		if ($item1['item_pickup_req']=='on') {
			$item['item_pickup_req']=1;
		}

		$result=$this->AdminModel->insertadditemadmin($item);
		if ($result){
		$this->session->set_flashdata('success',"Item Added Successfully..!!");
		redirect('fi_home/admin_item');
		}
		else{
		$this->session->set_flashdata('error',"Item Not Created ..!!");
		redirect('fi_home/admin_item');
		}
	}
	public function edititemadmin()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;

		$item_id						=	$this->input->post('item_id');
		$item['item_name']	=	$this->input->post('edit_item_names');
		$item['item_desc']	=	$this->input->post('edit_item_desc');
		$item['item_price']	=	$this->input->post('edit_item_price');
		$item1['iteam_texable']	=	$this->input->post('edit_taxcheck');
		if (isset($item1['iteam_texable'])) {
			$item['iteam_texable']=1;
		}
		else {
			$item['iteam_texable']=0;
		}
		$item1['item_pickup_req']	=	$this->input->post('edit_item_pickupcheck');
		if (isset($item1['item_pickup_req'])) {
			$item['item_pickup_req']=1;
		}
		else {
			$item['item_pickup_req']=0;
		}
		// echo "pre"; print_r($item);die;
		// $result=$this->AdminModel->insertadditemadmin($item);
		if ($this->db->where('item_id',$item_id)->update('admin_item',$item)){
		$this->session->set_flashdata('success',"Item Edit Successfully..!!");
		redirect('fi_home/admin_item');
		}
		else{
		$this->session->set_flashdata('error',"Item Not Edit ..!!");
		redirect('fi_home/admin_item');
		}
	}

	public function administration_info()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['info'] 	  = $this->db->get('company_info')->result_array()[0];
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_info',$data);
		$this->load->view('fi/footer');
	}
	public function editinfo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;

		$item['company_name']					=	$this->input->post('c_name');
		$item['company_address']			=	$this->input->post('c_address');
		$item['company_city']					=	$this->input->post('c_city');
		$item['company_zip']					=	$this->input->post('c_zip');
		$item['company_state']				=	$this->input->post('c_state');
		$item['company_tax_rate']			=	$this->input->post('c_tax');
		$item['company_support_key']	=	$this->input->post('c_key');

		if ($this->db->update('company_info',$item)){
		$this->session->set_flashdata('success',"Company Address Updated Successfully..!!");
		redirect('fi_home/administration_info');
		}
		else{
		$this->session->set_flashdata('error',"Company Address Not Updated ..!!");
		redirect('fi_home/administration_info');
		}
	}
	public function delete_item($id)
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$delete= $this->db->where('item_id',$id)->delete('admin_item');
		if ($delete > 0){
		$this->session->set_flashdata('success',"Item Deleted Successfully..!!");
		redirect('fi_home/admin_item');
		}
		else{
		$this->session->set_flashdata('error',"Item Not Deleted ..!!");
		redirect('fi_home/admin_item');
		}
	}
	public function delete_sub_cate($id)
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$delete= $this->db->where('sub_id',$id)->delete('sub_categories');
		if ($delete > 0){
		$this->session->set_flashdata('success',"Sub Categories Deleted Successfully..!!");
		redirect('si_home/view_sub_cat');
		}
		else{
		$this->session->set_flashdata('error',"Sub Categories Not Deleted ..!!");
		redirect('si_home/view_sub_cat');
		}
	}
	


	

	public function delete_location($id){
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$delete= $this->db->where('location_id',$id)->delete('add_location_event');
		if ($delete > 0){
		$this->session->set_flashdata('success',"Location Deleted Successfully..!!");
		redirect('fi_home/administration_locations');
		}
		else{
		$this->session->set_flashdata('error',"Location Not Deleted ..!!");
		redirect('fi_home/administration_locations');
		}
	}
	public function inseartlocation()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;

		$item['location_name']					=	$this->input->post('l_name');
		$item['location_address']			=	$this->input->post('l_address');
		$item['location_city']					=	$this->input->post('l_city');
		$item['location_state']					=	$this->input->post('l_state');
		$item['location_zip']			=	$this->input->post('l_zip');
		$item['location_phone_one']	=	$this->input->post('l_ph_no1');
		$item['location_phone_two']	=	$this->input->post('l_ph_no2');
		$item['location_direction']	=	$this->input->post('l_direction');
		$item['location_web_addres']	=	$this->input->post('l_web_address');
		$item['location_note']	=	$this->input->post('l_notes');

		$result=$this->AdminModel->insertaddlocation($item);
		if ($result){
		$this->session->set_flashdata('success',"Location Added Successfully..!!");
		redirect('fi_home/administration_locations');
		}
		else{
		$this->session->set_flashdata('error',"Location Not Created ..!!");
		redirect('fi_home/administration_locations');
		}
	}
	public function editlocatonform()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;

		$location_id										=	$this->input->post('latest_loaction_id');
		$item['location_name']					=	$this->input->post('l_name');
		$item['location_address']				=	$this->input->post('l_address');
		$item['location_city']					=	$this->input->post('l_city');
		$item['location_state']					=	$this->input->post('l_state');
		$item['location_zip']						=	$this->input->post('l_zip');
		$item['location_phone_one']			=	$this->input->post('l_ph_no1');
		$item['location_phone_two']			=	$this->input->post('l_ph_no2');
		$item['location_direction']			=	$this->input->post('l_direction');
		$item['location_web_addres']		=	$this->input->post('l_web_address');
		$item['location_note']					=	$this->input->post('l_notes');


		if ($this->db->where('location_id',$location_id)->update('add_location_event',$item)){
		$this->session->set_flashdata('success',"Location Updated Successfully..!!");
		redirect('fi_home/administration_locations');
		}
		else{
		$this->session->set_flashdata('error',"Location Not Updated ..!!");
		redirect('fi_home/administration_locations');
		}
	}
	public function administration_package()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user'] 	  = $this->db->get('user_register')->result_array();

		$item_info = $this->db->query("SELECT * from admin_item");

		$data['all_items'] = $item_info->result_array();
		// echo "<pre>"; print_r($data['all_items']);die;
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_packages',$data);
		$this->load->view('fi/footer');
	}
	public function administration_user_rights()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user'] 	  = $this->db->get('user_register')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_user_rights',$data);
		$this->load->view('fi/footer');
	}
	public function administration_locations()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['location'] 	  = $this->db->get('add_location_event')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_locations',$data);
		$this->load->view('fi/footer');
	}
	public function administration_notes()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user'] 	  = $this->db->get('user_register')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_notes',$data);
		$this->load->view('fi/footer');
	}
	public function administration_letters()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user'] 	  = $this->db->get('user_register')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_letters',$data);
		$this->load->view('fi/footer');
	}
	public function addvendor()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		// echo "<pre>";print_r($this->input->post());die;
		$data['vendor_title']         			= $this->input->post('title');
		$data['vendor_fname']         			= $this->input->post('vfname');
		$data['vendor_lname']        				= $this->input->post('vlname');
		$data['vendor_company_name']     		= $this->input->post('vcom');
		$data['vendor_address1']      			= $this->input->post('v_address1');
		$data['vendor_address2']   					= $this->input->post('v_address2');
		$data['vendor_city']   							= $this->input->post('vcity');
		$data['vendor_state']   						= $this->input->post('vstate');
		$data['vendor_zip']   							= $this->input->post('cus_zip');
		$data['vendor_area']   							= $this->input->post('varea');
		$data['vendor_tax_status']   				= $this->input->post('vtaxstatus');
		$data['vendor_tax_id']   						= $this->input->post('vtax_id');
		$data['vendor_ship_address']   			= $this->input->post('v_ship_address1');
		$data['vendor_ship_address_two']   	= $this->input->post('v_ship_address2');
		$data['vendor_ship_city']   				= $this->input->post('v_ship_city');
		$data['vendor_ship_state']   				= $this->input->post('v_ship_state');
		$data['vendor_ship_zip']   					= $this->input->post('v_ship_zip');
		$data['vendor_ship_area']   				= $this->input->post('v_ship_area');
		$data['vendor_contact_type']   			= $this->input->post('v_contact_type');
		$data['vendor_number']   						= $this->input->post('v_contact_number');
		$data1['vendor_default_no']   			= $this->input->post('default');
		if ($data1['vendor_default_no']=='on') {
			$data['vendor_default_no']=1;
		}
		else {
			$data['vendor_default_no']=0;
		}
		$data['vendor_contact_details']   	= $this->input->post('v_contact_detail');
		$data['vendor_cat']   							= $this->input->post('cat');
		$data['vendor_sub_cat']   					= $this->input->post('sub_cat');
		$data['vendor_type']   							= $this->input->post('vendor_type');
		$data['vendor_value']   						= $this->input->post('v_value');
	// print_r($data);die;
	$vendor_id=$this->AdminModel->addvendor($data);
	if ($vendor_id > 0) {
		$this->session->set_flashdata('success', 'Vendor Created SuccessFully ..!');
		redirect('fi_home/vendor_genral_info');
	}
	else {
		$this->session->set_flashdata('error', 'Vendor Not Created..!');
		redirect('fi_home/vendor_genral_info');
	}

	}

	public function addcoustomer()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
			// echo "<pre>";print_r($this->input->post());die;
			$data['cus_title']         		= $this->input->post('title');
			$data['cus_fname']         		= $this->input->post('cus_fname');
			$data['cus_lname']        		= $this->input->post('cus_lname');
			$data['cus_company_name']     = $this->input->post('cus_com');
			$data['cus_address1']      		= $this->input->post('cus_address1');
			$data['cus_address2']   			= $this->input->post('cus_address2');
			$data['cus_city']   					= $this->input->post('cus_city');
			$data['cus_state']   					= $this->input->post('cus_state');
			$data['cus_zip']   						= $this->input->post('cus_zip');
			$data['cus_tax_status']   		= $this->input->post('tax_status');
			$data['cus_tax_id']   				= $this->input->post('cus_tax_id');
		// print_r($data);die;
		$cus_id=$this->AdminModel->addcoustomer($data);
		if ($cus_id > 0) {
			$address['ship_user_id']      	= $cus_id;
			$address['ship_address1']      	= $this->input->post('cus_ship_address1');
			$address['ship_address2']   			= $this->input->post('cus_ship_address2');
			$address['ship_city']   					= $this->input->post('cus_ship_city');
			$address['ship_state']   					= $this->input->post('cus_ship_state');
			$address['ship_zip']   					= $this->input->post('cus_ship_zip');
			// $address['ship_area']   					= $this->input->post('cus_ship_area');

			$this->AdminModel->addshipaddress($address);


				for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
					$contact['cus_id']	=	$cus_id;
					//$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
					$contact['conatct_type']	=	"Home";
					$contact['contact_no']	=	$this->input->post('cus_contact_no')[$i];
					$contact['user_contact_note']	=	$this->input->post('cus_note')[$i];
					if(isset($this->input->post('radio_click[]')[$i]) && $this->input->post('radio_click[]')[$i] != ""){
						$b = "on";
					}else{
						$b = "off";
					}
					if(isset($b) && $b == 'on'){
							$contact['default_contact'] = 1;
					}else{
						$contact['default_contact'] = 0;
					}

				   $result=$this->AdminModel->addcontactdata($contact);
				 }



            	for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
				 $contact1['cus_id']	=	$cus_id;
				 $contact1['conatct_type']	=	"Email";
				 $contact1['email']	=	$this->input->post('txtemail')[$j];
			     $result=$this->AdminModel->addcontactdata($contact1);
				}

			$this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
			redirect('fi_home/custevents');
		}
		else
		{
		$this->session->set_flashdata('error', 'Something Went Wrong..!');
		redirect('fi_home/generalinfo');
		}
	}

	public function update_coustomer()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
			// echo "<pre>";print_r($this->input->post());die;
			$data['cus_title']         		= $this->input->post('title');
			$data['cus_fname']         		= $this->input->post('cus_fname');
			$data['cus_lname']        		= $this->input->post('cus_lname');
			$data['cus_company_name']     = $this->input->post('cus_com');
			$data['cus_address1']      		= $this->input->post('cus_address1');
			$data['cus_address2']   			= $this->input->post('cus_address2');
			$data['cus_city']   					= $this->input->post('cus_city');
			$data['cus_state']   					= $this->input->post('cus_state');
			$data['cus_zip']   						= $this->input->post('cus_zip');
			$data['cus_tax_status']   		= $this->input->post('tax_status');
			$data['cus_tax_id']   				= $this->input->post('cus_tax_id');
			$up_id = $this->input->post('cus_id');
		// print_r($data);die;
		$cus_id = $this->AdminModel->up_addcoustomer($data,$up_id);
		if ($cus_id) {
			$address['ship_user_id']      	= $up_id;
			$address['ship_address1']      	= $this->input->post('cus_ship_address1');
			$address['ship_address2']   			= $this->input->post('cus_ship_address2');
			$address['ship_city']   					= $this->input->post('cus_ship_city');
			$address['ship_state']   					= $this->input->post('cus_ship_state');
			$address['ship_zip']   					= $this->input->post('cus_ship_zip');
			// $address['ship_area']   					= $this->input->post('cus_ship_area');

			$this->AdminModel->up_addshipaddress($address,$up_id);
			$this->AdminModel->del_addcontactdata($up_id);
			//$rowCount = count($this->input->post('cus_contact_type'));


			/*for( $i=0; $i<$rowCount; $i++){
			$contact['cus_id']	=	$up_id;
			$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
			$contact['contact_no']	=	$this->input->post('cus_contact_no')[$i];
			$contact['user_contact_note']	=	$this->input->post('cus_note')[$i];
			$contact['email']	=	$this->input->post('txtemail')[$i];
			if(isset($this->input->post('radio_click[]')[$i]) && $this->input->post('radio_click[]')[$i] != ""){
				$a = "on";
			}else{
				$a = "off";
			}
			if(isset($a) && $a == 'on'){
					$contact['default_contact'] = 1;
			}else{
				$contact['default_contact'] = 0;
			}
			 $result=$this->AdminModel->up_addcontactdata($contact,$up_id);

			}*/




			for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
					$contact['cus_id']	=	$up_id;
					//$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
					$contact['conatct_type']	=	"Home";
					$contact['contact_no']	=	$this->input->post('cus_contact_no')[$i];
					$contact['user_contact_note']	=	$this->input->post('cus_note')[$i];
					if(isset($this->input->post('radio_click[]')[$i]) && $this->input->post('radio_click[]')[$i] != ""){
						$b = "on";
					}else{
						$b = "off";
					}
					if(isset($b) && $b == 'on'){
							$contact['default_contact'] = 1;
					}else{
						$contact['default_contact'] = 0;
					}

				   $result=$this->AdminModel->up_addcontactdata($contact,$up_id);
				 }



            	for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
				 $contact1['cus_id']	=	$up_id;
				 $contact1['conatct_type']	=	"Email";
				 $contact1['email']	=	$this->input->post('txtemail')[$j];
			     $result=$this->AdminModel->up_addcontactdata($contact1,$up_id);
				}

			$this->session->set_flashdata('success', 'Customer updated successfully ..!');
			redirect('fi_home/custevents');
		}
		else
		{
		$this->session->set_flashdata('error', 'Something went wrong..!');
		redirect('fi_home/generalinfo');
		}
	}
	public function view_invoices()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user'] 	  = $this->db->get('user_register')->result_array();
		$data['invoices'] = $this->db->get('invoices_create')->result_array();
		// print_r($data['invoices']);die;


		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/custinvoices_view',$data);
		$this->load->view('fi/footer');
	}
	public function allcat()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['category'] = $this->db->get('category')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/listdriver',$data);
		$this->load->view('fi/footer',$data);
	}
	public function search_cust()
	{
		/*if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}*/
		$cus_fname   = $this->input->post('fname');
		if ($cus_fname !="") {
			$fname =$cus_fname;
		}
		else {
			$fname="";
		}
		$cus_lname 	= $this->input->post('lname');
		if ($cus_lname !="") {
			$lname =$cus_lname;
		}
		else {
			$lname="";
		}
		$cus_cname 	= $this->input->post('cname');
		if ($cus_cname !="") {
			$cname =$cus_cname;
		}
		else {
			$cname="";
		}
		$cus_zname  = $this->input->post('zname');
		if ($cus_zname !="") {
			$zname =$cus_zname;
		}
		else {
			$zname="";
		}
		$cus_mname 	= $this->input->post('mname');
		if ($cus_mname !="") {
			$mname =$cus_mname;
		}
		else {
			$mname="";
		}
		$adr11 = $this->input->post('adr1');
		if ($adr11 !="") {
			$adr1 = $adr11;
		}
		else {
			$adr1 = "";
		}
		// $adr22 = $this->input->post('adr1');
		// if ($adr22 !="") {
		// 	$adr2 = $adr22;
		// }
		// else {
		// 	$adr2 = "";
		// }
		$adr22 = $this->input->post('adr2');
		if ($adr22 !="") {
			$adr2 = $adr22;
		}
		else {
			$adr2 = "";
		}
		$city = $this->input->post('cities');
		if ($city !="") {
			$cities = $city;
		}
		else {
			$cities = "";
		}
		$state = $this->input->post('states');
		if ($state !="") {
			$states = $state;
		}
		else {
			$states = "";
		}
		$areas = $this->input->post('areas');
		if ($areas !="") {
			$area = $areas;
		}
		else {
			$area = "";
		}

	  $this->AdminModel->search_customer($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area);

   }

   	public function fncustsrchbyph()
	{
		/*if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}*/

		$txtphoneno = $this->input->post('txtphoneno');
		if ($txtphoneno !="") {
			$phone =$txtphoneno;
		}
		else {
			$phone="";
		}

	  $this->AdminModel->fncustsrchbyph_dtls($phone);

   }



	public function search_vendor()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$cus_fname         		= $this->input->post('fname');
		if ($cus_fname !="") {
			$fname =$cus_fname;
		}
		else {
			$fname="";
		}
		$cus_lname         		= $this->input->post('v_type');
		if ($cus_lname !="") {
			$lname =$cus_lname;
		}
		else {
			$lname="";
		}
		$cus_cname         		= $this->input->post('v_cat');
		if ($cus_cname !="") {
			$cname =$cus_cname;
		}
		else {
			$cname="";
		}
		$cus_zname         		= $this->input->post('v_sub_cat');
		if ($cus_zname !="") {
			$zname =$cus_zname;
		}
		else {
			$zname="";
		}

		$data['customer']			=$this->AdminModel->search_vendor($fname,$lname,$cname,$zname);

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/vendor_search',$data);
		$this->load->view('fi/footer');
	}

	public function addSubcat()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

	}

	public function registration()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$this->load->view('fi/header');
		$this->load->view('fi/driverregister');
		$this->load->view('fi/footer');
	}

	public function adddriver()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		if	(isset( $_FILES['image']['name'])!="")
		{
			// echo "image selected";die;

				$config['upload_path']   = './uploads/';

				$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

				$this->load->library('upload', $config);

				$img_nm = "";

			if ($this->upload->do_upload('image'))
				{
						$data = array('upload_data' => $this->upload->data());
						$img_nm = "uploads/".$this->upload->data('file_name');
				}

				$data['driver_profile_pic']  = $img_nm;

				if ($data['driver_profile_pic'] !="")
				{
					$data1['driver_name']         = $this->input->post('d_name');
					$data1['driver_phone']        = $this->input->post('d_mobile');
					$data1['driver_email']        = $this->input->post('d_email');
					$data1['driver_address']      = $this->input->post('d_address');
					$data1['driver_city']         = $this->input->post('d_city');
					$data1['driver_profile_pic'] 	= $data['driver_profile_pic'];
					$data1['driver_reg_date']     = date("Y-m-d H:i:s");
					// print_r($data);die;
					if($this->AdminModel->insertdriver($data1))
					{
					$this->session->set_flashdata('success', 'Driver Created SuccessFully ..!');
					redirect('fi_home/listdriver');
					}
					else
					{
					$this->session->set_flashdata('error', 'Something Went Wrong..!');
					redirect('fi_home/listdriver');
					}
				}
				else
				{
					$data['driver_name']         = $this->input->post('d_name');
					$data['driver_phone']        = $this->input->post('d_mobile');
					$data['driver_email']        = $this->input->post('d_email');
					$data['driver_address']      = $this->input->post('d_address');
					$data['driver_city']         = $this->input->post('d_city');
					$data['driver_reg_date']     = date("Y-m-d H:i:s");
					if($this->AdminModel->insertdriver($data))
					{
					$this->session->set_flashdata('success', 'Driver Created SuccessFully ..!');
					redirect('fi_home/listdriver');
					}

					else
					{
					$this->session->set_flashdata('error', 'Something Went Wrong..!');
					redirect('fi_home/listdriver');
					}
				}


		}
	}

	public function cus_registration()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$this->load->view('fi/header');
		$this->load->view('fi/cusregister');
		$this->load->view('fi/footer');
	}
	public function addcustomer()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
// print_r($this->input->post());die;
		if(isset( $_FILES['image']['name'])!="")
		{
	// echo "image selected";die;

		$config['upload_path']   = './uploads/';

		$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

		$this->load->library('upload', $config);

		$img_nm = "";

	if ($this->upload->do_upload('image'))
		{
				$data = array('upload_data' => $this->upload->data());
				$img_nm = "uploads/".$this->upload->data('file_name');
		}

		$data['cus_profile_pic']  = $img_nm;

		if ($data['cus_profile_pic'] !="")
		{
			$data1['cus_name']         = $this->input->post('c_name');
			$data1['cus_mobile_no']    = $this->input->post('c_mobile');
			$data1['cus_email']        = $this->input->post('c_email');
			$data1['cus_address']      = $this->input->post('c_address');
			$data1['cus_city']         = $this->input->post('c_city');
			$data1['cus_profile_pic']  = $data['cus_profile_pic'];
			$data1['cus_reg_date']     = date("Y-m-d H:i:s");
			if($this->AdminModel->insertcustomer($data1)){
			$this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
			redirect('fi_home/listuser');
			}
			else{
			$this->session->set_flashdata('error', 'Something Went Wrong..!');
			redirect('fi_home/userlist');
			}

		}
		else
		{
			$data1['cus_name']         = $this->input->post('c_name');
			$data1['cus_mobile_no']    = $this->input->post('c_mobile');
			$data1['cus_email']        = $this->input->post('c_email');
			$data1['cus_address']      = $this->input->post('c_address');
			$data1['cus_city']         = $this->input->post('c_city');
			$data1['cus_reg_date']     = date("Y-m-d H:i:s");
			if($this->AdminModel->insertcustomer($data1))
			{
			$this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
			redirect('fi_home/listuser');
			}
			else
			{
			$this->session->set_flashdata('error', 'Something Went Wrong..!');
			redirect('fi_home/userlist');
			}
		}

	}
	}

	public function viewrides()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$this->load->view('fi/header');
		$this->load->view('fi/viewrides');
		$this->load->view('fi/footer');
	}
	public function adminprofile()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		// $data['user_data']					 =  $this->session->userdata('fi_session');
		$data['user_data']					 =  $this->db->get('users')->result_array();

		$this->load->view('fi/header');
		$this->load->view('fi/adminprofile',$data);
		$this->load->view('fi/footer');
	}

	public function viewleads()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$this->load->view('fi/header');
		$this->load->view('fi/viewleads');
		$this->load->view('fi/footer');
	}
	public function viewrjobs()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$this->load->view('fi/header');
		$this->load->view('fi/viewjobs');
		$this->load->view('fi/footer');
	}


	public function profileupdate()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		if	(isset( $_FILES['image']['name'])!="")
		{
			// echo "image selected";die;

				$config['upload_path']   = './uploads/';

				$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

				$this->load->library('upload', $config);

				$img_nm = "";

			if ($this->upload->do_upload('image'))
				{
						$data = array('upload_data' => $this->upload->data());
						$img_nm = "uploads/".$this->upload->data('file_name');
				}

				$data['profile_img']  = $img_nm;

				if (	$data['profile_img'] !="")
				{
					$data['id']         	= $this->input->post('id');
					$data['name']         = $this->input->post('firstName');
					$data['mobile_no']    = $this->input->post('mobilePhone');
					$data['email']        = $this->input->post('email');
					$data['password']     = base64_encode($this->input->post('password'));
				// echo "string";die;
				if($this->AdminModel->updateprofile($data)){
				$this->session->set_flashdata('success', 'User Info Updated SuccessFully ..!');
				redirect('fi_home/adminprofile');
				}
				else{
				$this->session->set_flashdata('error', 'Something Went Wrong..!');
				redirect('fi_home/adminprofile');
				}
				}
				else {
					$data['id']         	= $this->input->post('id');
					$data['name']         = $this->input->post('firstName');
					$data['mobile_no']    = $this->input->post('mobilePhone');
					$data['email']        = $this->input->post('email');
					$data['password']     = base64_encode($this->input->post('password'));
					// echo "string1";die;
					if($this->AdminModel->updateprofiledata($data)){
					$this->session->set_flashdata('success', 'User Info Updated SuccessFully ..!');
					redirect('fi_home/adminprofile');
					}
					else{
					$this->session->set_flashdata('error', 'Something Went Wrong..!');
					redirect('fi_home/adminprofile');
					}
				}

		}
		else
		{
			$this->session->set_flashdata('error', 'Something Went Wrong..!');
			redirect('fi_home/adminprofile');


		}
	}

	function listpromocode()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['promocode'] = $this->db->where('promo_delete',1)->get('promocodes')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/viewpromocode',$data);
		$this->load->view('fi/footer',$data);
	}

	public function newpromocode()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		$this->load->view('fi/header');
		$this->load->view('fi/addpromocode');
		$this->load->view('fi/footer');
	}
	public function addpromo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// print_r($this->input->post());die;
		$data['promo_name']         	= $this->input->post('p_name');
		$data['promo_type']        		= $this->input->post('p_type');
		$data['promo_discount']       = $this->input->post('p_discount');
		$data['promo_exp']      			= $this->input->post('p_date');
		$data['promo_created_date']   = date("Y-m-d H:i:s");
		// print_r($data);die;
		if($this->AdminModel->insertpromocode($data))
		{
		$this->session->set_flashdata('success', 'Promocode Created SuccessFully ..!');
		redirect('fi_home/listpromocode');
		}
		else
		{
		$this->session->set_flashdata('error', 'Something Went Wrong..!');
		redirect('fi_home/listpromocode');
		}
	}

	public function edit_promo($id)
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			 $this->session->set_userdata('promo',$this->AdminModel->getpromo($id));
			redirect('fi_home/editpromoview');
		}

		public function editpromoview()
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			$coupondata['alert'] = $this->session->flashdata('alert');
			$coupondata['error'] = $this->session->flashdata('error');
			$coupondata['success'] = $this->session->flashdata('success');
			$coupondata['edit']=$this->session->userdata('promo');
			// print_r($coupondata);die;
			$this->load->view('fi/header');
			$this->load->view('fi/editpromoform',$coupondata);
			$this->load->view('fi/footer');
		}

		public function editpro($id)
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			// print_r($this->input->post());die;

						$editcus['promo_name']      	= $this->input->post('p_name');
						$editcus['promo_type']   			= $this->input->post('p_type');
						$editcus['promo_discount']    = $this->input->post('p_discount');
						$editcus['promo_exp']   			= $this->input->post('p_date');

						if($this->db->where('promo_id',$id)->update('promocodes',$editcus))
						{
							$this->session->set_flashdata('success','Promocode Update SuccessFully...!');
							redirect('fi_home/listpromocode');
						}
						else
						{
							$this->session->set_flashdata('error','Something Went Wrong...!');
							redirect('fi_home/listpromocode');
						}
	}

	public function deactive_promo($promo_id)
	{
		if(!isset($this->session->fi_session)){
				redirect('/','refresh');
			}

				$deactive['promo_status'] ='2';//2 means  Deactive from Database
				if($this->db->where('promo_id',$promo_id)->update('promocodes',$deactive))
			{
				$this->session->set_flashdata('success', 'Promocode Deactivate SuccessFully..!');
				redirect('fi_home/listpromocode');

			}
			else
			{
				$this->session->set_flashdata('error', 'Error..!');
				redirect('fi_home/listpromocode');
			}
	}
	public function active_promo($promo_id)
	{
		if(!isset($this->session->fi_session)){
				redirect('/','refresh');
			}

				$deactive['promo_status'] ='1';//1 means  Active from Database
				if($this->db->where('promo_id',$promo_id)->update('promocodes',$deactive))
			{
				$this->session->set_flashdata('success', 'Promocode Deactivate SuccessFully..!');
				redirect('fi_home/listpromocode');

			}
			else
			{
				$this->session->set_flashdata('error', 'Error..!');
				redirect('fi_home/listpromocode');
			}
	}
	public function delete_promo($promo_id)
	{
		if(!isset($this->session->fi_session)){
				redirect('/','refresh');
			}

				$delete['promo_delete'] ='2';//2 means  Delete for forever but remain in Database
				if($this->db->where('promo_id',$promo_id)->update('promocodes',$delete))
			{
				$this->session->set_flashdata('success', 'Promocode Deleted SuccessFully..!');
				redirect('fi_home/listpromocode');

			}
			else {
				$this->session->set_flashdata('error', 'Error..!');
				redirect('fi_home/listpromocode');
			}
	}


	public function getUserData()
	{
	   $id = $this->input->post('id');
		 $data = $this->AdminModel->getData($id);

		 if($data)
		 {
			 echo $data['cus_name'];
			 // echo $id;
		 }
		 else{
			 echo "0";
		 }

	}

	public function edit($id)
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			 $this->session->set_userdata('single',$this->AdminModel->getedit($id));
			redirect('fi_home/editview');
		}

		public function editview()
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			$coupondata['alert'] = $this->session->flashdata('alert');
			$coupondata['error'] = $this->session->flashdata('error');
			$coupondata['success'] = $this->session->flashdata('success');
			$coupondata['edit']=$this->session->userdata('single');
			// print_r($coupondata);die;
			$this->load->view('fi/header');
			$this->load->view('fi/editform',$coupondata);
			$this->load->view('fi/footer');
		}

		public function editcus($id)
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			// print_r($this->input->post());die;
			if	(isset( $_FILES['image']['name'])!="")
			{
				// echo "image selected";die;

					$config['upload_path']   = './uploads/';

					$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

					$this->load->library('upload', $config);

					$img_nm = "";

				if ($this->upload->do_upload('image'))
					{
							$data = array('upload_data' => $this->upload->data());
							$img_nm = "uploads/".$this->upload->data('file_name');
					}

					$data['cus_profile_pic']  = $img_nm;

					if ($data['cus_profile_pic'] !="")
					{
						$editcus['cus_name']      	= $this->input->post('e_name');
						$editcus['cus_mobile_no']   = $this->input->post('e_mobile');
						$editcus['cus_email']    		= $this->input->post('e_email');
						$editcus['cus_address']   	= $this->input->post('e_address');
						$editcus['cus_city']   		  = $this->input->post('e_city');
						$editcus['cus_profile_pic'] = $data['cus_profile_pic'];

						if($this->db->where('cus_id',$id)->update('customer',$editcus))
						{
							$this->session->set_flashdata('success','User Info Update SuccessFully...!');
							redirect('fi_home/listuser');
						}
						else
						{
							$this->session->set_flashdata('error','Something Went Wrong...!');
							redirect('fi_home/listuser');
						}
					}
			else
				{
					$editcus['cus_name']      	= $this->input->post('e_name');
					$editcus['cus_mobile_no']   = $this->input->post('e_mobile');
					$editcus['cus_email']    		= $this->input->post('e_email');
					$editcus['cus_address']   	= $this->input->post('e_address');
					$editcus['cus_city']   		  = $this->input->post('e_city');

				if($this->db->where('cus_id',$id)->update('customer',$editcus))
				{
					$this->session->set_flashdata('success','User Info Update SuccessFully...!');
					redirect('fi_home/listuser');
				}
				else
				{
					$this->session->set_flashdata('error','Something Went Wrong...!');
					redirect('fi_home/listuser');
				}
			}
		}
	}

		public function edit_driver($id)
			{
				if(!isset($this->session->fi_session)){
						redirect('/','refresh');
				}
				 $this->session->set_userdata('driver',$this->AdminModel->geteditdriver($id));
				redirect('fi_home/editdriverview');
			}

			public function editdriverview()
			{
				if(!isset($this->session->fi_session)){
						redirect('/','refresh');
				}
				$coupondata['alert'] = $this->session->flashdata('alert');
				$coupondata['error'] = $this->session->flashdata('error');
				$coupondata['success'] = $this->session->flashdata('success');
				$coupondata['edit']=$this->session->userdata('driver');
				// print_r($coupondata);die;
				$this->load->view('fi/header');
				$this->load->view('fi/editdriverform',$coupondata);
				$this->load->view('fi/footer');
			}

			public function editdriver($id)
			{
				if(!isset($this->session->fi_session)){
						redirect('/','refresh');
				}

				// print_r($this->input->post());die;
				if	(isset( $_FILES['image']['name'])!="")
				{
				  // echo "image selected";die;

				    $config['upload_path']   = './uploads/';

				    $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

				    $this->load->library('upload', $config);

				    $img_nm = "";

				  if ($this->upload->do_upload('image'))
				    {
				        $data = array('upload_data' => $this->upload->data());
				        $img_nm = "uploads/".$this->upload->data('file_name');
				    }

				    $editdriver['driver_profile_pic']  = $img_nm;


				    if ($editdriver['driver_profile_pic'] !="")
				    {

							// $this->load->model('AdminModel');
							$editdriver['driver_name']      		= $this->input->post('d_name');
							$editdriver['driver_phone']      		= $this->input->post('d_mobile');
							$editdriver['driver_email']      		= $this->input->post('d_email');
							$editdriver['driver_address']      		= $this->input->post('d_address');
							$editdriver['driver_city']      		= $this->input->post('d_city');
							// print_r($editdriver);die;
							if($this->db->where('driver_id',$id)->update('driver_registration',$editdriver))
							{
								$this->session->set_flashdata('success','Driver Info Update SuccessFully...!');
								redirect('fi_home/listdriver');
							}
							else
							{
								$this->session->set_flashdata('error','Something Went Wrong...!');
								redirect('fi_home/listdriver');
							}
						}
						else
						{
							$editdriver1['driver_name']      		= $this->input->post('d_name');
							$editdriver1['driver_phone']      		= $this->input->post('d_mobile');
							$editdriver1['driver_email']      		= $this->input->post('d_email');
							$editdriver1['driver_address']      		= $this->input->post('d_address');
							$editdriver1['driver_city']      		= $this->input->post('d_city');
							if($this->db->where('driver_id',$id)->update('driver_registration',$editdriver1))
							{
								$this->session->set_flashdata('success','Driver Info Update SuccessFully...!');
								redirect('fi_home/listdriver');
							}
							else
							{
								$this->session->set_flashdata('error','Something Went Wrong...!');
								redirect('fi_home/listdriver');
							}
						}
				}
			}

			public function deletedriver($driver_id)
			{
				if(!isset($this->session->fi_session)){
						redirect('/','refresh');
					}

						$driverdelete['driver_active'] ='0';//0 means  Delete for forever but remain in Database
						if($this->db->where('driver_id',$driver_id)->update('driver_registration',$driverdelete))
					{
						$this->session->set_flashdata('error', 'Driver Deleted SuccessFully..!');
						redirect('fi_home/listdriver');


					}
					else {
						$this->session->set_flashdata('error', 'Error..!');
						redirect('fi_home/listdriver');
					}
				}

		public function deletecustomer($id)
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
				}

					$customerdelete['cus_is_active'] ='0';//0 means  Delete for forever but remain in Database
					if($this->db->where('cus_id',$id)->update('customer',$customerdelete))
				{
					$this->session->set_flashdata('error', 'Customer Deleted SuccessFully..!');
					redirect('fi_home/listuser');


				}
				else
				{
					$this->session->set_flashdata('error', 'Error..!');
					redirect('fi_home/listuser');
				}


		}

		public function applyPayments()
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			$coupondata['alert'] = $this->session->flashdata('alert');
			$coupondata['error'] = $this->session->flashdata('error');
			$coupondata['success'] = $this->session->flashdata('success');
			// print_r($coupondata);die;
			$this->load->view('fi/header');
			$this->load->view('fi/apply_payments',$coupondata);
			$this->load->view('fi/footer');
		}

	public function logout()
	{
		//check for the session if not set properly then redirect to login page
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$session_array = array(
			'email' 			=> '',
			'name'			  => '',
			'id'   				=> '',
			'mobile_no'  	=> '',
			'profile_img' => '',
			'type'     		=> ''
		);

		$this->session->set_flashdata('success',"Logout Successfully..!!");
		// $data['success']   = $this->session->flashdata('success');

		$this->session->unset_userdata('fi_session', $session_array);
		// print_r($session_array);die;
		redirect('/');
		}

		public function hebrew()
		{
			$dt = $this->input->post('status');
			$d1 = date('d', strtotime($dt));
			$d2 = date('m', strtotime($dt));
			$d3 = date('Y', strtotime($dt));

			//$d4 = date('D', strtotime($dt));
			$d4 = date('l', strtotime($dt));

			// echo $d1,$d2,$d3;die;
			// $jd = gregoriantojd($d1,$d2,$d3);
			// echo jdtojewish($jd, true);
			 // echo jdtojewish(gregoriantojd($d1,$d2,$d3)); //.','.$d4
			//  $str = jdtojewish(gregoriantojd( $d2, $d1, $d3), true, CAL_JEWISH_ADD_GERESHAYIM); // for today
			// $str1 = iconv ('WINDOWS-1255', 'UTF-8', $str); // convert to utf-8
			//
			// echo $str1;
			$gregorianMonth = $d2;
			$gregorianDay = $d1;
			$gregorianYear = $d3;

			$jdDate = gregoriantojd($gregorianMonth,$gregorianDay,$gregorianYear);

			$hebrewMonthName = jdmonthname($jdDate,4);

			$hebrewDate = jdtojewish($jdDate);

			list($hebrewMonth, $hebrewDay, $hebrewYear) = explode('/',$hebrewDate);

			echo ("$hebrewDay $hebrewMonthName $hebrewYear").','. $d4;
		}


   public function fnloadcustlistbyphone()
	{
		$txtphonenum = $this->input->post('txtphonenum');
		$this->AdminModel->fnloadcustlistbyphone_dtls($txtphonenum);
	}




	public function new_administration_contracttypes()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/new_administration_contractypes',$data);
		$this->load->view('fi/footer');
	}


   public function admin_packages()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$pckname=$this->input->post('package_name');
		$chkpackgeres=$this->Si_Model->isChkExistPackage($pckname);

	 if($chkpackgeres=="Not Exists")
	   {

		$item['contract_name']	=	$this->input->post('package_name');

		$result=$this->Si_Model->insertPackage($item);

		for ($i=0; $i < count($this->input->post('title')) ; $i++)
		 {
			$item1['contract_id']=$result;
	        $item1['term_name']	=	$this->input->post('title')[$i];
			$result1 = $this->Si_Model->insertPackagesub($item1);
	    }

		// print_r($item1); die;
		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');

		if ($result1){
		$this->session->set_flashdata('success',"Contract & Terms added successfully..!!");
		redirect('si_home/administration_contracttypes');
		}
		else{
			$this->session->set_flashdata('error',"Contract & Terms not created..!!");
		redirect('si_home/new_administration_contracttypes');
	  }

	 }else if($chkpackgeres=="IsExists"){

	 	$this->session->set_flashdata('error',"This Contract Name Already Exists..!!");
	 	redirect('si_home/new_administration_contracttypes');
	 }
   }

   public function fnpckitems()
	{
		$result=$this->Si_Model->fnpckitems_dtls();
	}

	public function delselpackage()
	{
		$result=$this->Si_Model->delselpackage_dtls();
	}

	public function upditemsdescrp()
	{
		$result=$this->Si_Model->upditemsdescrp_dtls();
	}

   public function delnewpitem()
	{
		$result=$this->Si_Model->delnewpitem_dtls();
	}

   public function crnewpitem()
	{
	   $result=$this->Si_Model->crnewpitem_dtls();
    }



	/** 
	*@author Prasanna Mane
	*Date Nov 11, 2020
	*Update March 07, 2021
	*Delete After Agust 07, 2021
	*/
	public function administration()
	{
		$data['alert']    	= $this->session->flashdata('alert');
		$data['error']    	= $this->session->flashdata('error');
		$data['success']  	= $this->session->flashdata('success');
		$data['cat'] 	  	= $this->db->get('categories')->result_array();
		$data['cate'] 		= $this->db->get('categories_list')->result_array();
		
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration/admin',$data);
		$this->load->view('fi/footer');
	}

	public function add_drop_categories()
	{
		
		$item1	=	$this->input->post('add_drop_cat');
		$item['cat_name'] = ucfirst($item1);

		$result = $this->AdminModel->insertDropCategories($item);
		if ($result)
		{	
			$this->session->set_flashdata('success',"Category Added Successfully..!!");
		}
		else
		{
			$this->session->set_flashdata('error',"Category Not Created ..!!");
		}
		redirect('Administration');
	}



	public function add_sub_cat($id)
	{
		if($id=="7")
		{
			$this->session->set_userdata('cat_id',$id);
		    redirect('Administration/administration_contracttypes');
		}
		else if($id=="30")
		{
			$this->session->set_userdata('cat_id',$id);
		    redirect('Administration/administration_contracttypes');
		}
		else
		{
			$this->session->set_userdata('cat_id',$id);
		    redirect('Administration/view_sub_cat');
		}	
	}

	public function view_sub_cat()
	{
		$data['alert'] = $this->session->flashdata('alert');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');

		$id = $this->session->userdata('cat_id');
		$data['id'] = $id;	

		$cond = array('cat_id' => '5');
		$tbl = "sub_categories";
		$data['MainCategories'] = $this->HomeModel->get_all_by_cond($tbl, $cond);
		$data['cat'] = $this->db->where('id',$id)->get('categories')->result_array();
		$data['sub_cats'] 	  = $this->db->where('cat_id',$id)->get('sub_categories')->result_array();
		
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration/subCategories',$data);
		$this->load->view('fi/footer');
	}

	public function administration_contracttypes()
	{

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');

		$item_info = $this->db->query("SELECT * from admin_contract_type");
		$data['all_items'] = $item_info->result_array();

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_contractypes',$data);
		$this->load->view('fi/footer');
	}

	public function delete_cat($id)
	{
		$this->db->delete('categories', array('id' => $id));
		$this->session->set_flashdata('success', 'Delete Categories');

		$data['alert']    	= $this->session->flashdata('alert');
		$data['error']    	= $this->session->flashdata('error');
		$data['success']  	= $this->session->flashdata('success');
		$data['cat'] 	  	= $this->db->get('categories')->result_array();
		$data['cate'] 		= $this->db->get('categories_list')->result_array();
	
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration',$data);
		$this->load->view('fi/footer');
	}

	public function add_sub_cates()
	{
		$item['cat_id']			 = $this->input->post('cat_id');
		$item['sub_name']		 = $this->input->post('sub_name');
		$item['opening_bal']	 = $this->input->post('open_bal');
		$item['sub_description'] = $this->input->post('sub_desc');
		$item['subCategoriesId'] = $this->input->post('subCategoriesId');

		$result = $this->AdminModel->insertsubcatvalue($item);
		if ($result)
		{
			$this->session->set_flashdata('success',"Sub Categorie Added Successfully..!!");
		}
		else
		{
			$this->session->set_flashdata('error',"Sub Categorie Not Created ..!!");
		}
		redirect('Administration/view_sub_cat');
	}



}
