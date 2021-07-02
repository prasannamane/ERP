<?php
error_reporting(0); //E_ALL
ini_set('display_error', '0');
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

defined('BASEPATH') OR exit('No direct script access allowed');
class Fi_invoice extends CI_Controller {

	function __construct(){
		parent::__construct();
		//initialise the autoload things for this class


		$this->load->model('AdminModel');
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

	public function dismiss_dash($id){
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			 $this->session->set_userdata('dismiss_dash',$id);
			redirect('fi_home/dismiss_dash_function');
		}

		public function dismiss_dash_function(){
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			$data['id']=$this->session->userdata('dismiss_dash');
			$result=$this->AdminModel->update_dash($data['id']);
			// print_r($data);die;
			if ($result > 0) {
				$this->session->set_flashdata('success',"Dismiss Successfully..!!");
				redirect('fi_home/');
			}
			else {
					$this->session->set_flashdata('error',"Dismiss Error..!!");
					redirect('fi_home/');
			}
		}


	public function dismissall_dash()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$result=$this->AdminModel->dismissall_dash();
		// print_r($data);die;
		if ($result > 0) {
			$this->session->set_flashdata('success',"DismissAll Successfully..!!");
			redirect('fi_home/');
		}
		else {
				$this->session->set_flashdata('error',"Dismiss Error..!!");
				redirect('fi_home/');
		}
	}

	public function snooze_dash($id)
{
	if(!isset($this->session->fi_session)){
		redirect('/','refresh');
	}

	$data['alert']    = $this->session->flashdata('alert');
	$data['error']    = $this->session->flashdata('error');
	$data['success']  = $this->session->flashdata('success');

	$result=$this->AdminModel->snooze_dash($id);
	// print_r($data);die; sdgsdsdgaasas
	if ($result > 0) {
		$this->session->set_flashdata('success',"DismissAll Successfully..!!");
		redirect('fi_home/');
	}
	else {
			$this->session->set_flashdata('error',"Dismiss Error..!!");
			redirect('fi_home/');
	}
}
public function cust_search()
{
	if(!isset($this->session->fi_session)){
		redirect('/','refresh');
	}

	error_reporting(0);

	$data['alert']    = $this->session->flashdata('alert');
	$data['error']    = $this->session->flashdata('error');
	$data['success']  = $this->session->flashdata('success');
	//$data['customer'] = array();
	// $data['customer'] = $this->AdminModel->cust_search($data);
	// echo "<pre>";print_r($data);die;

	$data['custs'] = $this->AdminModel->search_data();
	//$data['single_cust'] = $this->AdminModel->search_data()[0];

	//$data['single_invinfo'] = $this->AdminModel->search_last_invoice()[0];

	$this->load->view('fi/header');
	$this->load->view('fi/sidebar');
	$this->load->view('fi/cust_search',$data);
	$this->load->view('fi/footer');
}

	public function generalinfo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		error_reporting(0);

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['contact'] 	  = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
		$data['custs'] = $this->AdminModel->search_data();
		$data['single_cust'] = $this->AdminModel->search_data()[0];
		//$data['additional_cust'] = $this->db->order_by('cus_id','DESC')->get('customer_additional_contacts')->result_array();
		// print_r($data['single_cust']);die;
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/custgeneralinfo',$data);
		$this->load->view('fi/footer');
	}
	public function newGeneralInfo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['contact']  = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
		//$data['event_name'] = $this->db->where('cat_id',3)->get('sub_categories')->result_array();
		//$data['event_name'] = $this->db->order_by('cus_id',"desc")->get('events_register')->result_array();

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/new_custgeneralinfo',$data);
		$this->load->view('fi/footer');
	}
	public function getCustInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->allGeneralInfo($cName);
	}

  public function getSearchInfo()

	{

		$cName = $this->input->post('name');

		$this->AdminModel->allSearchInfo($cName);

	}
	public function getCustContactInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->allCustInfo($cName);
	}
	public function getSearchCustContactInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->allSearchCustInfo($cName);
	}

	public function find_city()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$zip=$this->input->post('zip');
		if($zip)
		{
			$this->AdminModel->find_city_json($zip);
		}

	}
	public function custevents()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    			= $this->session->flashdata('alert');
		$data['error']    			= $this->session->flashdata('error');
		$data['success']  			= $this->session->flashdata('success');
		$data['search']  			  = $this->AdminModel->search_data();

		$data['single_cust']  	= $this->AdminModel->search_data()[0];


		$data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();
		$data['last_row'] = $this->db->order_by('cus_id',"desc")->limit(1)->get('register_customer')->result_array()[0];
		$get_loc = $this->db->query("SELECT * from add_location_event");

		$data['all_locs'] = $get_loc->result_array();

		$data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();




		$data['event_data']=$this->AdminModel->get_event_data_id($data['last_row']['cus_id']);

		$data['location_data']=$this->AdminModel->get_locationt_data_id($data['last_row']['cus_id']);

		$data['crews_data']=$this->AdminModel->get_crews_data_id($data['last_row']['cus_id']);


		// print_r($data['all_locs']);die;
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/cust_events',$data);
		$this->load->view('fi/footer');
	}

	public function single_location_info()
	{
		$loc_name = $this->input->post('l_name');
		$cus_names=$this->input->post('cus_names');
		$locationjson;
	   if($loc_name=="Home")
		{

			 $get_cust_cntctfields = $this->db->query("SELECT contact_no from user_contact_info WHERE cus_id = '$cus_names' AND default_contact='1'");
			 $get_data_cust = $get_cust_cntctfields->result()[0];
			 //$get_row_cust=$get_cust_cntctfields->row();
			 //$get_data_cust="contact_no:".$get_row_cust->contact_no;
			//echo $get_data_cust;

		   $get_cust_allfields = $this->db->query("SELECT * from register_customer WHERE cus_id = '$cus_names'");
		   //$get_data_cust = $get_cust_allfields->result_array()[0];
		   //print_r(implode("##",$get_data_cust));

		   foreach($get_cust_allfields->result() as $get_cust_allfields_dtls)
			    {
			    	$locationjson['locationlist'][]=$get_cust_allfields_dtls;
			    	//$locationjson['locationlist'][]=$get_data_cust;

			    }


		      echo json_encode($locationjson);

		}else
		{
		   $get_loc_allfields = $this->db->query("SELECT * from add_location_event WHERE location_name = '$loc_name'");
		   //$get_data_loc = $get_loc_allfields->result_array()[0];
		   //print_r(implode("##",$get_data_loc));

		    foreach($get_loc_allfields->result() as $get_loc_allfields_dtls)
			    {
			    	$locationjson['locationlist'][]=$get_loc_allfields_dtls;
			    }

			     echo json_encode($locationjson);


		}

	}
	public function get_data_user()
	{
		$loc_name = $this->input->post('l_name');
		echo $loc_name;
	}
	public function single_price_info()
	{
		$item_info = $this->input->post('i_name');

		$get_item_allfields = $this->db->query("SELECT * from admin_item WHERE item_id = '$item_info'");
		$get_data_item = $get_item_allfields->result_array()[0];
		print_r(implode("##" , $get_data_item));
	}
	public function single_package_info()
	{
		$pac_n = $this->input->post('pid');
		$pac_fetch = $this->db->query("SELECT * from admin_package WHERE package_id = '$pac_n'");
		$get_pac = $pac_fetch->result_array()[0];
		echo(implode("##",$get_pac)),"<br>";

    $item_get = $this->db->query("SELECT * from admin_package_item WHERE package_id = '$pac_n'");
		$rows = $item_get->result_array();
		for($i=0; $i<count($rows); $i++){

			print_r(implode("**",$rows[$i]));

		}
	}

	public function search_cus()
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}

			$cus_id=$this->input->get('id');

			if ($cus_id !="")
			{
				$this->session->set_userdata('id',$cus_id);
 				redirect('fi_home/search_new_cus');
			}else {

			}

		}

public function search_new_cus()
{
	if(!isset($this->session->fi_session)){
		redirect('/','refresh');
	}

	error_reporting(0);

	// print_r($this->input->get('id'));die;
	$cus_id=$this->session->userdata('id');

	//$cus_id=$this->input->get('id');

	//print_r($cus_id);die;

	$event_data['single_cust']  	= $this->AdminModel->search_data()[0];

	//event_table
	$results=$this->AdminModel->get_event_data_id_count($cus_id);

	//print_r($results);die;

	if ($results > 0) {



	$event_data['event_data']=$this->AdminModel->get_event_data_id($cus_id);

	//location table
	//$event_data['location_data']=$this->AdminModel->get_locationt_data_id($event_data['event_data']['event_id']);

	$event_data['location_data']=$this->AdminModel->get_locationt_data_id($cus_id);


	// echo "<pre>"; print_r($event_data['location_data']);echo "<br>";
	//crews table
	//$event_data['crews_data']=$this->AdminModel->get_crews_data_id($event_data['event_data']['event_id']);

	$event_data['crews_data']=$this->AdminModel->get_crews_data_id($cus_id);

	// echo "<pre>"; print_r($event_data['crews_data']);echo "<br>";

 // job info table
 //$event_data['job_info_data']=$this->AdminModel->get_job_info_data_id($event_data['event_data']['event_id']);
 // echo "<pre>"; print_r($event_data['job_info_data']);echo "<br>";

	// crews avability table
	//$event_data['crews_avability_data']=$this->AdminModel->get_crews_avability_data_id($event_data['event_data']['event_id']);
	// echo "<pre>"; print_r($event_data['crews_avability_data']);echo "<br>";

 //ASSOCIATED ORDER table
 //$event_data['associated_data']=$this->AdminModel->get_associated_data_id($event_data['event_data']['event_id']);

 // echo "<pre>"; print_r($event_data['associated_data_data']);echo "<br>";

 // AFFILIATED VENDOR table
 //$event_data['affiliated_vendor_data']=$this->AdminModel->get_affiliated_vendor_data_id($event_data['event_data']['event_id']);

 // echo "<pre>"; print_r($event_data['affiliated_vendor_data']);echo "<br>";

 $event_data['search']  			=  $this->AdminModel->search_data();
 $event_data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();

 $get_loc = $this->db->query("SELECT * from add_location_event");

 $event_data['all_locs'] = $get_loc->result_array();
 $event_data['last_row'] = $this->db->where('cus_id',$cus_id)->get('register_customer')->result_array()[0];

 $event_data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();

 $event_data['alert']    = $this->session->flashdata('alert');
 $event_data['error']    = $this->session->flashdata('error');
 $event_data['success']  = $this->session->flashdata('success');

 $this->load->view('fi/header');
 $this->load->view('fi/sidebar');
 $this->load->view('fi/cus_event_update',$event_data);
 $this->load->view('fi/footer');
}
else {


 $event_data['search']  			=  $this->AdminModel->search_data();
 $event_data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();

 $get_loc = $this->db->query("SELECT * from add_location_event");

 $event_data['all_locs'] = $get_loc->result_array();
 $event_data['last_row'] = $this->db->where('cus_id',$cus_id)->get('register_customer')->result_array()[0];

  $event_data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();


	$event_data['event_data']=$this->AdminModel->get_event_data_id($cus_id);

	$event_data['location_data']=$this->AdminModel->get_locationt_data_id($cus_id);

	$event_data['crews_data']=$this->AdminModel->get_crews_data_id($cus_id);




	$event_data['alert']    = $this->session->flashdata('alert');
	$event_data['error']    = $this->session->flashdata('error');
	$event_data['success']  = $this->session->flashdata('success');


	//redirect('fi_home/custevents',$event_data);
	 $this->load->view('fi/header');
     $this->load->view('fi/sidebar');
     $this->load->view('fi/cus_event_update',$event_data);
     $this->load->view('fi/footer');

}



}

public function addevent()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());
		if($this->input->post('cuss_id')!="" && $this->input->post('edate')[0]!="")
		{

			$result_cus=$this->AdminModel->check_event_id($this->input->post('cuss_id'),$this->input->post('edate')[0]);
		//echo "<pre>";print_r($result_cus); die;
		if ($result_cus==0) {

			//echo "<pre>";print_r($this->input->post());

			for ($i=0; $i < count($this->input->post('event_type')) ; $i++) {


					$data['cus_id']         				= $this->input->post('cuss_id');
					$data['event_type']         		= $this->input->post('event_type')[$i];
					$data['event_name']         		= $this->input->post('ename')[$i];
					$data['event_date']         		= $this->input->post('edate')[$i];
					$data['event_time']         		= $this->input->post('etime')[$i];
					$data['event_end_date']         = $this->input->post('endate')[$i];
					$data['event_end_time']         = $this->input->post('entime')[$i];
					$data1['event_booked']         	= $this->input->post('bookedcheck')[$i];
					if ($data1['event_booked']=='on') {
						$data['event_booked']=1;
					}
					else {
						$data['event_booked']=0;
					}
					$data1['event_lost']         		= $this->input->post('lostcheck')[$i];
					if ($data1['event_lost']=='on') {
						$data['event_lost']=1;
					}
					else {
						$data['event_lost']=0;
					}
					$data['event_guest']         		= $this->input->post('eguest')[$i];
					$data['event_hebrew_date']      = $this->input->post('ehdate')[$i];
					$data['event_day']         			= $this->input->post('eday')[$i];
					$data['event_referred_by']      = $this->input->post('referdby')[$i]; // erby
					$data['event_note']         		= $this->input->post('enote')[$i];

				   $result=$this->AdminModel->insertevent($data);

	     }

		 //print_r($result);die;

		//if ($result > 0) {

		   /* for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {

     				$location['event_id']	= $this->input->post('cuss_id');	//$result;
					$location['location_type']	=	$this->input->post('add_location')[$i];
					$location['location_date']	=	$this->input->post('ddate')[$i];
					$location['location_time']	=	$this->input->post('time')[$i];
					$location['location_address']=	$this->input->post('address')[$i];
					$location['location_city']=	$this->input->post('city')[$i];
					$location['location_state']=	$this->input->post('state')[$i];
					$location['location_zip']=	$this->input->post('zip')[$i];
					$location['location_phone']=	$this->input->post('phone')[$i];
					$location['location_landmark']=	$this->input->post('landmark')[$i];
					$location['location_note']=	$this->input->post('note')[$i];

					$result1=$this->AdminModel->insertlocation($location);

		    }



			for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++) {



					$crew['event_id']	= $this->input->post('cuss_id');	//$result;
					$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
					$crew['crews_type']	=	$this->input->post('crewstype')[$i];
					$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
					$crew1['crews_commited']	=	$this->input->post('commited')[$i];
					if ($crew1['crews_commited']=='on') {
						$crew['crews_commited']=1;
					}
					else {
						$crew['crews_commited']=0;
					}
					$crew2['crews_hide']=	$this->input->post('hide')[$i];
					if ($crew2['crews_hide']=='on') {
						$crew['crews_hide']=1;
					}
					else {
						$crew['crews_hide']=0;
					}
					$crew['crews_start_date']=	$this->input->post('start_date')[$i];
					$crew['crews_start_time']=	$this->input->post('start_time')[$i];
					$crew['crews_ending']=	$this->input->post('ending')[$i];
					$crew['crews_over_time']=	$this->input->post('over_time')[$i];
					$crew['crews_location']=	$this->input->post('location')[$i];
					$crew['crews_end_date']=	$this->input->post('end_date')[$i];
					$crew['crews_end_time']=	$this->input->post('end_time')[$i];
					$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
					$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

					$result2=$this->AdminModel->insertcrew($crew);


			}
*/
			 /*	for ($i=0; $i < count($this->input->post('job_type')) ; $i++) {
			$job_data['event_id']	=	$result;
			$job_data['jobs_type']	=	$this->input->post('job_type')[$i];
			$job_data['jobs_fname']	=	$this->input->post('jfname')[$i];
			$job_data['jobs_spouse']	=	$this->input->post('spouse')[$i];
			$job_data['jobs_children']=	$this->input->post('children')[$i];
			$job_data['jobs_crew_number']=	$this->input->post('crew_number')[$i];
			$job_data['jobs_start_time']=	$this->input->post('start_time')[$i];
			$job_data['jobs_note']=	$this->input->post('note')[$i];
			$job_data['jobs_phone']=	$this->input->post('phone')[$i];

			$result3=$this->AdminModel->insertjobs($job_data);
			}
			for ($i=0; $i < count($this->input->post('atype')) ; $i++) {
			$data_a['event_id']	=	$result;
			$data_a['type']	=	$this->input->post('atype')[$i];
			$data_a['vendor']	=	$this->input->post('avendor')[$i];
			$data_a['start_date']	=	$this->input->post('astart_date')[$i];
			$data_a['start_time']=	$this->input->post('astart_time')[$i];
			$data_a['status']=	$this->input->post('astatus')[$i];
			$data_a['note']=	$this->input->post('anote')[$i];
			$data_a['email_availability']=	$this->input->post('email_availability')[$i];
			$data_a['add_to_crews']=	$this->input->post('add_to_crews')[$i];

			$result4=$this->AdminModel->insertcrew_availability($data_a);
			}
			for ($i=0; $i < count($this->input->post('invoice')) ; $i++) {
			$associated['event_id']	=	$result;
			$associated['invoice']	=	$this->input->post('invoice')[$i];
			$associated['name']	=	$this->input->post('name')[$i];
			$associated['date_entered']	=	$this->input->post('date_entered')[$i];
			$associated['due_date']=	$this->input->post('due_date')[$i];
			$associated['contract_type']=	$this->input->post('contract_type')[$i];
			$associated['discount']=	$this->input->post('discount')[$i];
			$associated['sub_total']=	$this->input->post('sub_total')[$i];
			$associated['tax']=	$this->input->post('tax')[$i];
			$associated['amount']=	$this->input->post('amount')[$i];
			$associated['paid']=	$this->input->post('paid')[$i];
			$associated['balance_due']=	$this->input->post('balance_due')[$i];
			$associated['tax_rate']=	$this->input->post('tax_rate')[$i];
			$associated['county']=	$this->input->post('county')[$i];
			$associated['user']=	$this->input->post('user')[$i];

			$result5=$this->AdminModel->insertassociated_order($associated);
			}

					for ($i=0; $i < count($this->input->post('type')) ; $i++) {
					$associated['event_id']	=	$result;
					$affiliated['affiliated_type']	=	$this->input->post('type')[$i];
					$affiliated['affiliated_vendor']	=	$this->input->post('vendor')[$i];

					$result6=$this->AdminModel->insertaffiliated_vendor($affiliated);
					}*/


		//}
			$this->session->set_flashdata('success',"Event Created Successfully..!!");
			redirect('fi_home/custinvoices');

		}else if($result_cus>0){

			//echo "else"; die;


			   // $this->db->where("cus_id",$this->input->post('cuss_id'));
			   // if($this->db->delete('events_register'))
			   // {

				//print_r($this->input->post('event_type'));
				//echo"count--".count($this->input->post('event_type')); die;

			   for ($i=0; $i < count($this->input->post('event_type')) ; $i++) {

				 if($this->input->post('event_type')[$i]!="Select" || $this->input->post('edate')[$i]!="")
				 {

					$data['cus_id']         				= $this->input->post('cuss_id');
					$data['event_type']         		= $this->input->post('event_type')[$i];
					$data['event_name']         		= $this->input->post('ename')[$i];
					$data['event_date']         		= $this->input->post('edate')[$i];
					$data['event_time']         		= $this->input->post('etime')[$i];
					$data['event_end_date']         = $this->input->post('endate')[$i];
					$data['event_end_time']         = $this->input->post('entime')[$i];
					$data1['event_booked']         	= $this->input->post('bookedcheck')[$i];
					if ($data1['event_booked']=='on') {
						$data['event_booked']=1;
					}
					else {
						$data['event_booked']=0;
					}
					$data1['event_lost']         		= $this->input->post('lostcheck')[$i];
					if ($data1['event_lost']=='on') {
						$data['event_lost']=1;
					}
					else {
						$data['event_lost']=0;
					}
					$data['event_guest']         		= $this->input->post('eguest')[$i];
					$data['event_hebrew_date']      = $this->input->post('ehdate')[$i];
					$data['event_day']         			= $this->input->post('eday')[$i];
					$data['event_referred_by']      = $this->input->post('referdby')[$i]; // erby
					$data['event_note']         		= $this->input->post('enote')[$i];

				   $result=$this->AdminModel->insertevent($data);

				}
	         }


			//}


		      // $delevntstables=array('event_location','event_crews');
		      /* $this->db->where("event_id",$this->input->post('cuss_id'));
			   if($this->db->delete('event_location'))
			   {

						for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {


				if($this->input->post('add_location')[$i]!="Select" || $this->input->post('ddate')[$i]!="")
                   {

						$location['event_id']	= $this->input->post('cuss_id');	//$result;
						$location['location_type']	=	$this->input->post('add_location')[$i];
						$location['location_date']	=	$this->input->post('ddate')[$i];
						$location['location_time']	=	$this->input->post('time')[$i];
						$location['location_address']=	$this->input->post('address')[$i];
						$location['location_city']=	$this->input->post('city')[$i];
						$location['location_state']=	$this->input->post('state')[$i];
						$location['location_zip']=	$this->input->post('zip')[$i];
						$location['location_phone']=	$this->input->post('phone')[$i];
						$location['location_landmark']=	$this->input->post('landmark')[$i];
						$location['location_note']=	$this->input->post('note')[$i];

						$result1=$this->AdminModel->insertlocation($location);
					}
				}

			}

			   $this->db->where("event_id",$this->input->post('cuss_id'));
			   if($this->db->delete('event_crews'))
			   {

						for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++) {


                 if($this->input->post('crewstype')[$i]!="Select")
                   {


						$crew['event_id']	= $this->input->post('cuss_id');	//$result;
						$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
						$crew['crews_type']	=	$this->input->post('crewstype')[$i];
						$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
						$crew1['crews_commited']	=	$this->input->post('commited')[$i];
						if ($crew1['crews_commited']=='on') {
							$crew['crews_commited']=1;
						}
						else {
							$crew['crews_commited']=0;
						}
						$crew2['crews_hide']=	$this->input->post('hide')[$i];
						if ($crew2['crews_hide']=='on') {
							$crew['crews_hide']=1;
						}
						else {
							$crew['crews_hide']=0;
						}
						$crew['crews_start_date']=	$this->input->post('start_date')[$i];
						$crew['crews_start_time']=	$this->input->post('start_time')[$i];
						$crew['crews_ending']=	$this->input->post('ending')[$i];
						$crew['crews_over_time']=	$this->input->post('over_time')[$i];
						$crew['crews_location']=	$this->input->post('location')[$i];
						$crew['crews_end_date']=	$this->input->post('end_date')[$i];
						$crew['crews_end_time']=	$this->input->post('end_time')[$i];
						$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
						$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

						$result2=$this->AdminModel->insertcrew($crew);
					}
			    }

		     }*/

	           $this->session->set_flashdata('success',"Event Updated Successfully..!!");
			   redirect('fi_home/custinvoices');


		}else {
			$this->session->set_flashdata('error',"Please select another date as event already exist for same date..!!");
			redirect('fi_home/custevents');
		}

		}else {
			$this->session->set_flashdata('error',"Please enter the date..!!");
			redirect('fi_home/custevents');
		}




}

public function custinvoices()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['count'] 	  = $this->db->select('count(*) as count')->get('invoices_create')->result_array();
		// print_r($data);die;
		$data12 = $this->db->query("SELECT * from customer_assigned_packages"); //admin_package

		$data['all_packs'] = $data12->result_array();

		$data['single_cust']  	= $this->AdminModel->search_data()[0];

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/custinvoices',$data);
		$this->load->view('fi/footer');
	}

	public function crnewinvoice()
	{
	   $result=$this->AdminModel->crnewinvoice_dtls();
    }

	public function delinvoice()
	{
		$result=$this->AdminModel->delinvoice_dtls();
	}

	public function updtinvoice()
	{
		$result=$this->AdminModel->updtinvoice_dtls();
	}

	public function fngetinvoiceinfo()
	{
		$result=$this->AdminModel->fngetinvoiceinfo_dtls();
	}

	public function fngetadmpckjson()
	{
		$result=$this->AdminModel->fngetadmpckjson_dtls();
	}

	public function fngetsignlepckinfo()
	{
		$result=$this->AdminModel->fngetsignlepckinfo_dtls();
	}

	public function fngetsearhinvoice()
	{
		$result=$this->AdminModel->fngetsearhinvoice_dtls();
	}

	public function crpitem()
	{
	   $result=$this->AdminModel->crpitem_dtls();
    }

    public function delpitem()
	{
		$result=$this->AdminModel->delpitem_dtls();
	}

	public function updtitems()
	{
		$result=$this->AdminModel->updtitems_dtls();
	}

	public function updinvamt()
	{
		$result=$this->AdminModel->updinvamt_dtls();
	}

	public function updpckinfo()
	{
		$result=$this->AdminModel->updpckinfo_dtls();
	}

	public function upditemdesc()
	{
		$result=$this->AdminModel->upditemdesc_dtls();
	}

	public function upditemamt()
	{
		$result=$this->AdminModel->upditemamt_dtls();
	}


	public function addinvoice()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;
		$data['invoice_name']=$this->input->post('new_invoice');
		$data['invoice_date']=$this->input->post('invoice_date');
		$data['invoice_due_date']=$this->input->post('invoice_due_date');
		$data['invoice_type']=$this->input->post('invoice_event_type');
		$data['invoice_contract_type']=$this->input->post('invoice_contract_type');
		$data['invoice_discount']=$this->input->post('invoice_discount');
		$data['invoice_sub_total']=$this->input->post('invoice_sub_total');
		$data['invoice_tax']=$this->input->post('invoice_tax');
		$data['invoice_amount']=$this->input->post('invoice_amount');
		$data['invoice_paid']=$this->input->post('invoice_paid');
		$data['invoice_balance_due']=$this->input->post('invoice_balance_due');
		$data['invoice_tax_rate']=$this->input->post('invoice_tax_rate');
		$data['invoice_county']=$this->input->post('invoice_country');
		$data['invoice_user']=$this->input->post('invoice_user');

		$result=$this->AdminModel->insertnewinvoice($data);
		if ($result > 0) {
			// print_r($result);die;

			for ($i=0; $i < count($this->input->post('item_quantity')) ; $i++) {
			$item['invoice_id']	=	$result;
			$item['item_quantity']	=	$this->input->post('item_quantity')[$i];
			$item['item_item']	=	$this->input->post('item_name')[$i];
			$item['item_desc']	=	$this->input->post('item_desc')[$i];
			$item['item_amount']=	$this->input->post('item_amount')[$i];
			$item['item_total']=	$this->input->post('item_total')[$i];
			$item['item_taxable']=	$this->input->post('iteam_taxable')[$i];
			$item['item_include_in_package']=	$this->input->post('item_include_in_pacakge')[$i];
			$item['item_package_name']=	$this->input->post('item_package_name')[$i];
			$item['item_package_price']=	$this->input->post('item_price')[$i];

			$item_insert=$this->AdminModel->insertinvoiceitem($item);
			}

			for ($i=0; $i < count($this->input->post('task_date')) ; $i++) {
			$task['invoice_id']	=	$result;
			$task['task_date_started']	=	$this->input->post('task_date')[$i];
			$task['task_type']	=	$this->input->post('task_type')[$i];
			$task['task_user']	=	$this->input->post('task_user')[$i];
			$task['task_due_date']=	$this->input->post('task_due_date')[$i];
			$task['task_completed']=	$this->input->post('task_completed')[$i];
			$task['task_completed_by']=	$this->input->post('task_completed_by')[$i];
			$task['task_completed_date']=	$this->input->post('task_completed_date')[$i];
			$task['task_note']=	$this->input->post('task_note')[$i];
			$task['task_entered_by']=	$this->input->post('task_enter_by')[$i];

			$task_inseart=$this->AdminModel->insertinvoicetask($task);
			}

			for ($i=0; $i < count($this->input->post('invoice_payment')) ; $i++) {
			$pay['invoice_id']	=	$result;
			$pay['payment_name']	=	$this->input->post('invoice_payment')[$i];
			$pay['payment_date']	=	$this->input->post('payment_date')[$i];
			$pay['payment_reciept']	=	$this->input->post('payment_reciept')[$i];
			$pay['payment_type']=	$this->input->post('payment_type')[$i];
			$pay['payment_checknum']=	$this->input->post('checknum')[$i];
			$pay['payment_desc']=	$this->input->post('payment_desc')[$i];
			$pay['payment_amount']=	$this->input->post('payment_amount')[$i];
			$pay['payment_credit']=	$this->input->post('payment_credit')[$i];
			$pay['payment_username']=	$this->input->post('payment_username')[$i];
			$pay['payment_modes']=	$this->input->post('payment_modes')[$i];
			$pay['payment_deposite']=	$this->input->post('payment_deposite')[$i];

			$payment_inseart=$this->AdminModel->insertinvoicepayment($pay);
			}

			for ($i=0; $i < count($this->input->post('pickup_item')) ; $i++) {
			$pickup['invoice_id']	=	$result;
			$pickup['pickup_info_item']	=	$this->input->post('pickup_item')[$i];
			$pickup['pickup_info_desc']	=	$this->input->post('pickup_desc')[$i];
			$pickup['pickup_info_quantity']	=	$this->input->post('pickup_quantity')[$i];
			$pickup['pickup_info_pickup_by']=	$this->input->post('pickup_pickup_by')[$i];
			$pickup['pickup_info_pickup_date']=	$this->input->post('pickup_date')[$i];
			$pickup['pickup_info_notes']=	$this->input->post('pickup_note')[$i];
			$pickup_inseart=$this->AdminModel->insertpickup_info($pickup);
			}

			for ($i=0; $i < count($this->input->post('pickupreq_item')) ; $i++) {
			$pickup_req['invoice_id']	=	$result;
			$pickup_req['pickup_required_item']	=	$this->input->post('pickupreq_item')[$i];
			$pickup_req['pickup_required_quantity']	=	$this->input->post('pickupreq_quantity')[$i];
			$pickup_req['pickup_required_pickup']	=	$this->input->post('pickupreq_pickup')[$i];

			$pickup_req_inseart=$this->AdminModel->insertpickup_req($pickup_req);
			}

			for ($i=0; $i < count($this->input->post('note_date')) ; $i++) {
			$note['invoice_id']	=	$result;
			$note['note_date']	=	$this->input->post('note_date')[$i];
			$note['note_time']	=	$this->input->post('note_time')[$i];
			$note['note_type']	=	$this->input->post('note_type')[$i];
			$note['note_desc']	=	$this->input->post('note_note')[$i];
			$note['note_user']	=	$this->input->post('note_user')[$i];

			$note_inseart=$this->AdminModel->insertinvoice_note($note);
			}

			for ($i=0; $i < count($this->input->post('associated_invoice')) ; $i++) {
			$associated['invoice_id']	=	$result;
			$associated['associated_invoice']	=	$this->input->post('associated_invoice')[$i];
			$associated['associated_name']	=	$this->input->post('associated_name')[$i];
			$associated['associated_date_enter']	=	$this->input->post('associated_date_enter')[$i];
			$associated['associated_due_date']	=	$this->input->post('associated_due_date')[$i];
			$associated['associated_contract_type']	=	$this->input->post('associated_contract_type')[$i];
			$associated['associated_discount']	=	$this->input->post('associated_discount')[$i];
			$associated['associated_sub_total']	=	$this->input->post('associated_sub_total')[$i];
			$associated['associated_tax']	=	$this->input->post('associated_tax')[$i];
			$associated['associated_amount']	=	$this->input->post('associated_amount')[$i];
			$associated['associated_paid']	=	$this->input->post('associated_paid')[$i];
			$associated['associated_balance_due']	=	$this->input->post('associated_balance_due')[$i];
			$associated['associated_tax_rate']	=	$this->input->post('associated_tax_rate')[$i];
			$associated['associated_country']	=	$this->input->post('associated_county')[$i];
			$associated['associated_user']	=	$this->input->post('associated_user')[$i];

			$note_inseart=$this->AdminModel->insertinvoice_associated($associated);
			}
			$this->session->set_flashdata('success',"Invoice Saved Successfully..!!");
			redirect('fi_home/custinvoices');
		}
		else {
			$this->session->set_flashdata('error',"Invoice Not Saved ..!!");
			redirect('fi_home/custinvoices');
		}
	// print_r($result);die;
	}
	public function invoice_add()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;
		$data['invoice_name']=$this->input->post('new_invoice');
		$data['invoice_date']=$this->input->post('invoice_date');
		$data['invoice_due_date']=$this->input->post('invoice_due_date');
		$data['invoice_type']=$this->input->post('invoice_event_type');
		$data['invoice_contract_type']=$this->input->post('invoice_contract_type');
		$data['invoice_discount']=$this->input->post('invoice_discount');
		$data['invoice_sub_total']=$this->input->post('invoice_sub_total');
		$data['invoice_tax']=$this->input->post('invoice_tax');
		$data['invoice_amount']=$this->input->post('invoice_amount');
		$data['invoice_paid']=$this->input->post('invoice_paid');
		$data['invoice_balance_due']=$this->input->post('invoice_balance_due');
		$data['invoice_tax_rate']=$this->input->post('invoice_tax_rate');
		$data['invoice_county']=$this->input->post('invoice_country');
		$data['invoice_user']=$this->input->post('invoice_user');

		$result=$this->AdminModel->insertnewinvoice($data);
		if ($result > 0) {
			// print_r($result);die;

			for ($i=0; $i < count($this->input->post('item_quantity')) ; $i++) {
			$item['invoice_id']	=	$result;
			$item['item_quantity']	=	$this->input->post('item_quantity')[$i];
			$item['item_item']	=	$this->input->post('item_name')[$i];
			$item['item_desc']	=	$this->input->post('item_desc')[$i];
			$item['item_amount']=	$this->input->post('item_amount')[$i];
			$item['item_total']=	$this->input->post('item_total')[$i];
			$item['item_taxable']=	$this->input->post('iteam_taxable')[$i];
			$item['item_include_in_package']=	$this->input->post('item_include_in_pacakge')[$i];
			$item['item_package_name']=	$this->input->post('item_package_name')[$i];
			$item['item_package_price']=	$this->input->post('item_price')[$i];
			if($item['item_taxable']==NULL || $item['item_taxable'] =="")
			{
				$item['item_taxable'] = 0;
			}
			$item_insert=$this->AdminModel->insertinvoiceitem($item);
			}

			for ($i=0; $i < count($this->input->post('task_date')) ; $i++) {
			$task['invoice_id']	=	$result;
			$task['task_date_started']	=	$this->input->post('task_date')[$i];
			$task['task_type']	=	$this->input->post('task_type')[$i];
			$task['task_user']	=	$this->input->post('task_user')[$i];
			$task['task_due_date']=	$this->input->post('task_due_date')[$i];
			$task['task_completed']=	$this->input->post('task_completed')[$i];
			$task['task_completed_by']=	$this->input->post('task_completed_by')[$i];
			$task['task_completed_date']=	$this->input->post('task_completed_date')[$i];
			$task['task_note']=	$this->input->post('task_note')[$i];
			$task['task_entered_by']=	$this->input->post('task_enter_by')[$i];
			if($task['task_completed']==NULL || $task['task_completed'] =="")
			{
				$task['task_completed'] = 0;
			}
			$task_inseart=$this->AdminModel->insertinvoicetask($task);
			}

			for ($i=0; $i < count($this->input->post('invoice_payment')) ; $i++) {
			$pay['invoice_id']	=	$result;
			$pay['payment_name']	=	$this->input->post('invoice_payment')[$i];
			$pay['payment_date']	=	$this->input->post('payment_date')[$i];
			$pay['payment_reciept']	=	$this->input->post('payment_reciept')[$i];
			$pay['payment_type']=	$this->input->post('payment_type')[$i];
			// $pay['payment_checknum']=	$this->input->post('checknum')[$i];
			// $pay['payment_desc']=	$this->input->post('payment_desc')[$i];
			$pay['payment_amount']=	$this->input->post('payment_amount')[$i];
			// $pay['payment_credit']=	$this->input->post('payment_credit')[$i];
			// $pay['payment_username']=	$this->input->post('payment_username')[$i];
			// $pay['payment_modes']=	$this->input->post('payment_modes')[$i];
			// $pay['payment_deposite']=	$this->input->post('payment_deposite')[$i];

			$payment_inseart=$this->AdminModel->insertinvoicepayment($pay);
			}

			for ($i=0; $i < count($this->input->post('pickup_item')) ; $i++) {
			$pickup['invoice_id']	=	$result;
			$pickup['pickup_info_item']	=	$this->input->post('pickup_item')[$i];
			$pickup['pickup_info_desc']	=	$this->input->post('pickup_desc')[$i];
			$pickup['pickup_info_quantity']	=	$this->input->post('pickup_quantity')[$i];
			$pickup['pickup_info_pickup_by']=	$this->input->post('pickup_pickup_by')[$i];
			$pickup['pickup_info_pickup_date']=	$this->input->post('pickup_date')[$i];
			$pickup['pickup_info_notes']=	$this->input->post('pickup_note')[$i];
			$pickup_inseart=$this->AdminModel->insertpickup_info($pickup);
			}

			for ($i=0; $i < count($this->input->post('pickupreq_item')) ; $i++) {
			$pickup_req['invoice_id']	=	$result;
			$pickup_req['pickup_required_item']	=	$this->input->post('pickupreq_item')[$i];
			$pickup_req['pickup_required_quantity']	=	$this->input->post('pickupreq_quantity')[$i];
			$pickup_req['pickup_required_pickup']	=	$this->input->post('pickupreq_pickup')[$i];

			$pickup_req_inseart=$this->AdminModel->insertpickup_req($pickup_req);
			}

			for ($i=0; $i < count($this->input->post('note_date')) ; $i++) {
			$note['invoice_id']	=	$result;
			$note['note_date']	=	$this->input->post('note_date')[$i];
			$note['note_time']	=	$this->input->post('note_time')[$i];
			$note['note_type']	=	$this->input->post('note_type')[$i];
			$note['note_desc']	=	$this->input->post('note_note')[$i];
			$note['note_user']	=	$this->input->post('note_user')[$i];

			$note_inseart=$this->AdminModel->insertinvoice_note($note);
			}

			for ($i=0; $i < count($this->input->post('associated_invoice')) ; $i++) {
			$associated['invoice_id']	=	$result;
			$associated['associated_invoice']	=	$this->input->post('associated_invoice')[$i];
			$associated['associated_name']	=	$this->input->post('associated_name')[$i];
			$associated['associated_date_enter']	=	$this->input->post('associated_date_enter')[$i];
			$associated['associated_due_date']	=	$this->input->post('associated_due_date')[$i];
			$associated['associated_contract_type']	=	$this->input->post('associated_contract_type')[$i];
			$associated['associated_discount']	=	$this->input->post('associated_discount')[$i];
			$associated['associated_sub_total']	=	$this->input->post('associated_sub_total')[$i];
			$associated['associated_tax']	=	$this->input->post('associated_tax')[$i];
			$associated['associated_amount']	=	$this->input->post('associated_amount')[$i];
			$associated['associated_paid']	=	$this->input->post('associated_paid')[$i];
			$associated['associated_balance_due']	=	$this->input->post('associated_balance_due')[$i];
			$associated['associated_tax_rate']	=	$this->input->post('associated_tax_rate')[$i];
			$associated['associated_country']	=	$this->input->post('associated_county')[$i];
			$associated['associated_user']	=	$this->input->post('associated_user')[$i];

			$note_inseart=$this->AdminModel->insertinvoice_associated($associated);
			}
			$this->session->set_flashdata('success',"Invoice Saved Successfully..!!");
			redirect('fi_home/custinvoices');
		}
		else {
			$this->session->set_flashdata('error',"Invoice Not Saved ..!!");
			redirect('fi_home/custinvoices');
		}
	// print_r($result);die;
	}
	public function custpayments()
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
		$this->load->view('fi/custpayments',$data);
		$this->load->view('fi/footer');
	}
	public function custattachments()
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
		$this->load->view('fi/custattachments',$data);
		$this->load->view('fi/footer');
	}

	public function vendor_search()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['contact'] 	  = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
		$data['venders'] = $this->AdminModel->vendor_search_data();
		$data['single_cust'] = $this->AdminModel->vendor_search_data()[0];
        $data['ap_cat']  = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
        $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();



		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/vendor_search',$data);
		$this->load->view('fi/footer');
	}

	public function vendor_genral_info()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['contact'] 	  = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
		$data['venders'] = $this->AdminModel->vendor_search_data();
		$data['single_cust'] = $this->AdminModel->vendor_search_data()[0];
		$data['ap_cat']  = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
        $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();


		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/vendor_general_info',$data);
		$this->load->view('fi/footer');
	}


	public function newVenderGeneralInfo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['contact']  = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
		$data['ap_cat']  = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
        $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/new_vendergeneralinfo',$data);
		$this->load->view('fi/footer');
	}



	public function vendor_pricelist()
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
		$this->load->view('fi/vendor_pricelist',$data);
		$this->load->view('fi/footer');
	}
	public function vendor_purchase()
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
		$this->load->view('fi/vendor_purchases',$data);
		$this->load->view('fi/footer');
	}
	public function vendor_payments()
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
		$this->load->view('fi/vendor_payments',$data);
		$this->load->view('fi/footer');
	}
	public function vendor_attachment()
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
		$this->load->view('fi/vendor_attachments',$data);
		$this->load->view('fi/footer');
	}
	public function to_do_list()
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
		$this->load->view('fi/to_do_appointment_list',$data);
		$this->load->view('fi/footer');
	}
	public function task_alert()
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
		$this->load->view('fi/cust_alerts',$data);
		$this->load->view('fi/footer');
	}
	public function administration()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['cat'] 	  = $this->db->get('categories')->result_array();
		$data['cate'] = $this->db->get('categories_list')->result_array();
		// echo "<pre>";print_r($data['cat']);die;
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration',$data);
		$this->load->view('fi/footer');
	}
	public function admin_search()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');
		$data['item'] 	  = $this->db->order_by('item_name')->get('admin_item')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/administration_search',$data);
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
		$data['item'] 	  = $this->db->order_by('item_name')->get('admin_item')->result_array();
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
  public function admin_packages()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$pckname=$this->input->post('package_name');
		$chkpackgeres=$this->AdminModel->isChkExistPackage($pckname);

	 if($chkpackgeres=="Not Exists")
	   {

		$item['package_name']	=	$this->input->post('package_name');
		$item['package_price']	=	$this->input->post('package_price');
		$item['package_taxable']	=	$this->input->post('package_taxable');

		if($item['package_taxable']=="")
		{
			$item['package_taxable'] = 0;
		}
		else{
			$item['package_taxable'] = 1;
		}

		$result=$this->AdminModel->insertPackage($item);

		for ($i=0; $i < count($this->input->post('title')) ; $i++)
		 {
			$item1['package_id']=$result;
	        $item1['item_name']	=	$this->input->post('title')[$i];
			$item1['item_quantity']	=	$this->input->post('quant')[$i];
			$item1['item_price']	=	$this->input->post('i_price')[$i];
			$item1['item_desc']	=	$this->input->post('itmdesc')[$i];
			$result1 = $this->AdminModel->insertPackagesub($item1);
	    }

		// print_r($item1); die;
		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');

		if ($result1){
		$this->session->set_flashdata('success',"Package & Item added successfully..!!");
		redirect('fi_home/administration_package');
		}
		else{
			$this->session->set_flashdata('error',"Package & Item not created..!!");
		redirect('fi_home/new_administration_package');
	  }

	 }else if($chkpackgeres=="IsExists"){

	 	$this->session->set_flashdata('error',"This Package Name Already Exists..!!");
	 	redirect('fi_home/new_administration_package');
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
		redirect('fi_home/view_sub_cat');
		}
		else{
		$this->session->set_flashdata('error',"Sub Categories Not Deleted ..!!");
		redirect('fi_home/view_sub_cat');
		}
	}
	public function add_sub_cat($id)
	{
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}
			 $this->session->set_userdata('cat_id',$id);
			redirect('fi_home/view_sub_cat');
		}
	}

	public function view_sub_cat()
	{
		if(!isset($this->session->fi_session)){
				redirect('/','refresh');
		}
		$data['alert'] = $this->session->flashdata('alert');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$id=$this->session->userdata('cat_id');
		$data['id']=$id;
		// print_r($coupondata);die;
		$data['sub_cats'] 	  = $this->db->where('cat_id',$id)->get('sub_categories')->result_array();
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/admin_sub_categories',$data);
		$this->load->view('fi/footer');
	}
	public function add_sub_cates()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;
		$item['cat_id']	=	$this->input->post('cat_id');
		$item['sub_name']	=	$this->input->post('sub_name');

		$result=$this->AdminModel->insertsubcatvalue($item);
		if ($result){
		$this->session->set_flashdata('success',"Sub Categorie Added Successfully..!!");
		redirect('fi_home/view_sub_cat');
		}
		else{
		$this->session->set_flashdata('error',"Sub Categorie Not Created ..!!");
		redirect('fi_home/view_sub_cat');
		}
	}
	public function add_drop_categories()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());die;
		$item1	=	$this->input->post('add_drop_cat');
		$item['cat_name'] = ucfirst($item1);


		$result=$this->AdminModel->insertDropCategories($item);
		if ($result){
		$this->session->set_flashdata('success',"Category Added Successfully..!!");
		redirect('fi_home/administration');
		}
		else{
		$this->session->set_flashdata('error',"Category Not Created ..!!");
		redirect('fi_home/administration');
		}
	}
	public function delete_location($id)
	{
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


	public function new_administration_package()
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
		$this->load->view('fi/new_administration_packages',$data);
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


	public function addcoustomer()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
			// echo "<pre>";print_r($this->input->post());die;

		if(isset($_POST['Save']))
		 {

			 	$data['cus_title']         		= $this->input->post('title');
				$data['cus_fname']         		= $this->input->post('cus_fname');
				$data['cus_lname']        		= $this->input->post('cus_lname');
				$data['cus_company_name']     = $this->input->post('cus_com');
				$data['cus_address1']      		= $this->input->post('cus_address1');
				$data['cus_address2']   			= $this->input->post('cus_address2');
				$data['cus_city']   					= $this->input->post('cus_city');
				$data['cus_state']   					= $this->input->post('cus_state');
				$data['cus_zip']   						= $this->input->post('cus_zip');
				$data['cus_area']                         = $this->input->post('cus_area');
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
				$address['billing_addr_status']   		= $this->input->post('billaddr');
				$address['ship_cusname']   		= $this->input->post('shipcusname');

				// $address['ship_area']   					= $this->input->post('cus_ship_area');

				$this->AdminModel->addshipaddress($address);


					//for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
				   for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) {

				   	  if($this->input->post('cus_contact_type')[$i]!="")
				   	  {
					   	  	$contact['cus_id']	=	$cus_id;
							$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
						    //$contact['conatct_type']	=	"Home";
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


					 }



	            	//for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
					 for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) {

					 	if($this->input->post('cuscnt_type_email')[$j]!="")
					 	{

							 $contact1['cus_id']	=	$cus_id;
							 //$contact1['conatct_type']	=	"Email";
							 $contact1['conatct_type']	=	$this->input->post('cuscnt_type_email')[$j];
							 $contact1['email']	=	$this->input->post('txtemail')[$j];
						 	if(isset($this->input->post('email_radio_click[]')[$j]) && $this->input->post('email_radio_click[]')[$j] != ""){
								$b = "on";
							}else{
								$b = "off";
							}
							if(isset($b) && $b == 'on'){
								$contact1['default_contact'] = 1;
							}else{
								$contact1['default_contact'] = 0;
							}
						     $result=$this->AdminModel->addcontactdata($contact1);
						}

					}


				    //for ($k=0; $k < count($this->input->post('adcntype')) ; $k++) {
					for ($k=0; $k < count($this->input->post('name')) ; $k++) {

					  if($this->input->post('name')[$k]!="")
						{

							 $contact2['cus_id']	=	$cus_id;
							 //$contact2['con_type']	=	$this->input->post('adcntype');
							 $contact2['name']	=	$this->input->post('name')[$k];
							 $contact2['address']	=	$this->input->post('address')[$k];
							 $contact2['city']	=	$this->input->post('city')[$k];
							 $contact2['state']	=	$this->input->post('state')[$k];
							 $contact2['zip']	=	$this->input->post('zip')[$k];
							 $contact2['home']	=	$this->input->post('home')[$k];
							 $contact2['cel']	=	$this->input->post('cel')[$k];
							 $contact2['work']	=	$this->input->post('work')[$k];
							 $contact2['email']	=	$this->input->post('emailaddr')[$k];

						     $result=$this->AdminModel->additionalcontactdata($contact2);
						  }
					}


				  $chkinvexitssql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$cus_id."'");
				  $isninrows=$chkinvexitssql->num_rows();

				   if($isninrows==0)
				   {
				   		$postinvarr=array(
		    		    //"invoice_id" => $chkinvsql_dtls->invoice_id+1,
		    		    "cust_id" => $cus_id,
		    		    "invoice_name" => "new_invoice",
		    		    "invoice_date" => date('Y-m-d'),
						"invoice_status" =>0
		    		   );
					  if($this->db->insert('invoices_create',$postinvarr))
					  {
					  	   $lstinvId=$this->db->insert_id();
						   $postinvnoarr=array(
			    		    "inv_id" => $lstinvId,
			    		   );
						    $this->db->insert('invoice_terms',$postinvnoarr);
					  }


				   }



				  $chkattchexitssql=$this->db->query("SELECT * FROM cus_attachment WHERE cust_id='".$cus_id."'");
				  $isnattchrows=$chkattchexitssql->num_rows();

				   if($isnattchrows==0)
				   {
				   		$postattchvarr=array(
		    		     "cust_id" => $cus_id,
		    		   );
					 $this->db->insert('cus_attachment',$postattchvarr);
				   }


				$this->session->set_userdata('nwcus_id', $cus_id);

				$this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
				redirect('fi_home/generalinfo');
			}

		 }else if(isset($_POST['Submit']))
		  {
				$data['cus_title']         		= $this->input->post('title');
				$data['cus_fname']         		= $this->input->post('cus_fname');
				$data['cus_lname']        		= $this->input->post('cus_lname');
				$data['cus_company_name']     = $this->input->post('cus_com');
				$data['cus_address1']      		= $this->input->post('cus_address1');
				$data['cus_address2']   			= $this->input->post('cus_address2');
				$data['cus_city']   					= $this->input->post('cus_city');
				$data['cus_state']   					= $this->input->post('cus_state');
				$data['cus_zip']   						= $this->input->post('cus_zip');
				$data['cus_area']                         = $this->input->post('cus_area');
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
				$address['billing_addr_status']   		= $this->input->post('billaddr');
				$address['ship_cusname']   		= $this->input->post('shipcusname');

				// $address['ship_area']   					= $this->input->post('cus_ship_area');

				$this->AdminModel->addshipaddress($address);


					//for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
				   for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) {

				   	  if($this->input->post('cus_contact_type')[$i]!="")
				   	  {
					   	  	$contact['cus_id']	=	$cus_id;
							$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
						    //$contact['conatct_type']	=	"Home";
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


					 }



	            	//for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
					 for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) {

					 	if($this->input->post('cuscnt_type_email')[$j]!="")
					 	{

							 $contact1['cus_id']	=	$cus_id;
							 //$contact1['conatct_type']	=	"Email";
							 $contact1['conatct_type']	=	$this->input->post('cuscnt_type_email')[$j];
							 $contact1['email']	=	$this->input->post('txtemail')[$j];
						 	if(isset($this->input->post('email_radio_click[]')[$j]) && $this->input->post('email_radio_click[]')[$j] != ""){
								$b = "on";
							}else{
								$b = "off";
							}
							if(isset($b) && $b == 'on'){
								$contact1['default_contact'] = 1;
							}else{
								$contact1['default_contact'] = 0;
							}
						     $result=$this->AdminModel->addcontactdata($contact1);
						}

					}


				    //for ($k=0; $k < count($this->input->post('adcntype')) ; $k++) {
					for ($k=0; $k < count($this->input->post('name')) ; $k++) {

					  if($this->input->post('name')[$k]!="")
						{

							 $contact2['cus_id']	=	$cus_id;
							 //$contact2['con_type']	=	$this->input->post('adcntype');
							 $contact2['name']	=	$this->input->post('name')[$k];
							 $contact2['address']	=	$this->input->post('address')[$k];
							 $contact2['city']	=	$this->input->post('city')[$k];
							 $contact2['state']	=	$this->input->post('state')[$k];
							 $contact2['zip']	=	$this->input->post('zip')[$k];
							 $contact2['home']	=	$this->input->post('home')[$k];
							 $contact2['cel']	=	$this->input->post('cel')[$k];
							 $contact2['work']	=	$this->input->post('work')[$k];
							 $contact2['email']	=	$this->input->post('emailaddr')[$k];

						     $result=$this->AdminModel->additionalcontactdata($contact2);
						  }
					}


				  $chkinvexitssql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$cus_id."'");
				  $isninrows=$chkinvexitssql->num_rows();

				   if($isninrows==0)
				   {
				   		$postinvarr=array(
		    		    //"invoice_id" => $chkinvsql_dtls->invoice_id+1,
		    		    "cust_id" => $cus_id,
		    		    "invoice_name" => "new_invoice",
		    		    "invoice_date" => date('Y-m-d'),
						"invoice_status" =>0
		    		   );
					  if($this->db->insert('invoices_create',$postinvarr))
					  {
					  	   $lstinvId=$this->db->insert_id();
						   $postinvnoarr=array(
			    		    "inv_id" => $lstinvId,
			    		   );
						    $this->db->insert('invoice_terms',$postinvnoarr);
					  }


				   }



				  $chkattchexitssql=$this->db->query("SELECT * FROM cus_attachment WHERE cust_id='".$cus_id."'");
				  $isnattchrows=$chkattchexitssql->num_rows();

				   if($isnattchrows==0)
				   {
				   		$postattchvarr=array(
		    		     "cust_id" => $cus_id,
		    		   );
					 $this->db->insert('cus_attachment',$postattchvarr);
				   }


				$this->session->set_userdata('nwcus_id', $cus_id);

				$this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
				redirect('fi_home/custevents');
			}

		  }else
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
			//echo "<pre>";print_r($this->input->post());die;
		       error_reporting(0);

		    if(isset($_POST['Save']))
		    {

	    			$data['cus_title']         		= $this->input->post('title');
					$data['cus_fname']         		= $this->input->post('cus_fname');
					$data['cus_lname']        		= $this->input->post('cus_lname');
					$data['cus_company_name']     = $this->input->post('cus_com');
					$data['cus_address1']      		= $this->input->post('cus_address1');
					$data['cus_address2']   			= $this->input->post('cus_address2');
					$data['cus_city']   					= $this->input->post('cus_city');
					$data['cus_state']   					= $this->input->post('cus_state');
					$data['cus_zip']   						= $this->input->post('cus_zip');
					$data['cus_area']                         = $this->input->post('cus_area');
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
					$address['billing_addr_status']   		= $this->input->post('billaddr');
					$address['ship_cusname']   		= $this->input->post('shipcusname');

					// $address['ship_area']   					= $this->input->post('cus_ship_area');

					$this->AdminModel->up_addshipaddress($address,$up_id);
					$this->AdminModel->del_addcontactdata($up_id);


					//for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
					   for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) {

					   	 if($this->input->post('cus_contact_type')[$i]!="")
					   	 {

							$contact['cus_id']	=	$up_id;
							$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
						    //$contact['conatct_type']	=	"Home";
							$contact['contact_no']	=	$this->input->post('cus_contact_no')[$i];
							$contact['user_contact_note']	=	$this->input->post('cus_note')[$i];
							if($this->input->post('radio_click[]')[$i] == "on"){
								$b = "on";
							}else if($this->input->post('radio_click[]')[$i] == "off"){
								$b = "off";
							}
							if($b=='on'){
									$contact['default_contact'] = 1;
							}else{
								$contact['default_contact'] = 0;
							}

						   $result=$this->AdminModel->addcontactdata($contact);
						}
					}



		            	//for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
						 for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) {

						 	if($this->input->post('cuscnt_type_email')[$j]!="")
						 	{

						 	    $contact1['cus_id']	=	$up_id;
								 //$contact1['conatct_type']	=	"Email";
								 $contact1['conatct_type']	=	$this->input->post('cuscnt_type_email')[$j];
								 $contact1['email']	=	$this->input->post('txtemail')[$j];
								 if($this->input->post('email_radio_click[]')[$j] == "on"){
									$b = "on";
								}else if($this->input->post('email_radio_click[]')[$j] == "off"){
									$b = "off";
								}
								if($b == 'on'){
									$contact1['default_contact'] = 1;
								}else{
									$contact1['default_contact'] = 0;
								}

							     $result=$this->AdminModel->addcontactdata($contact1);
						 	}

						}



						$this->db->where('cus_id',$up_id);
						$this->db->where('con_type',$this->input->post('adcntype'));
						//$this->db->where('name',$this->input->post('name'));
						$this->AdminModel->del_additionalcontactdata($up_id);

						//for ($k=0; $k < count($this->input->post('adcntype')) ; $k++) {
						for ($k=0; $k < count($this->input->post('name')) ; $k++) {

						   if($this->input->post('name')[$k]!="")
							{

								 $contact2['cus_id']	=	$up_id;
								 $contact2['con_type']	=	$this->input->post('adcntype');
								 $contact2['name']	=	$this->input->post('name')[$k];
								 $contact2['address']	=	$this->input->post('address')[$k];
								 $contact2['city']	=	$this->input->post('city')[$k];
								 $contact2['state']	=	$this->input->post('state')[$k];
								 $contact2['zip']	=	$this->input->post('zip')[$k];
								 $contact2['home']	=	$this->input->post('home')[$k];
								 $contact2['cel']	=	$this->input->post('cel')[$k];
								 $contact2['work']	=	$this->input->post('work')[$k];
								 $contact2['email']	=	$this->input->post('emailaddr')[$k];

							     $result=$this->AdminModel->additionalcontactdata($contact2);
					      }

						}

					$this->session->set_userdata('id',$up_id);

					$this->session->set_flashdata('success', 'Customer updated successfully ..!');
					//redirect('fi_home/custevents');
					redirect('fi_home/generalinfo');
		}

		    }else if(isset($_POST['Submit'])){

		    		$data['cus_title']         		= $this->input->post('title');
					$data['cus_fname']         		= $this->input->post('cus_fname');
					$data['cus_lname']        		= $this->input->post('cus_lname');
					$data['cus_company_name']     = $this->input->post('cus_com');
					$data['cus_address1']      		= $this->input->post('cus_address1');
					$data['cus_address2']   			= $this->input->post('cus_address2');
					$data['cus_city']   					= $this->input->post('cus_city');
					$data['cus_state']   					= $this->input->post('cus_state');
					$data['cus_zip']   						= $this->input->post('cus_zip');
					$data['cus_area']                         = $this->input->post('cus_area');
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
					$address['billing_addr_status']   		= $this->input->post('billaddr');
					$address['ship_cusname']   		= $this->input->post('shipcusname');

					// $address['ship_area']   					= $this->input->post('cus_ship_area');

					$this->AdminModel->up_addshipaddress($address,$up_id);
					$this->AdminModel->del_addcontactdata($up_id);


					//for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
					   for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) {

					   	 if($this->input->post('cus_contact_type')[$i]!="")
					   	 {

							$contact['cus_id']	=	$up_id;
							$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
						    //$contact['conatct_type']	=	"Home";
							$contact['contact_no']	=	$this->input->post('cus_contact_no')[$i];
							$contact['user_contact_note']	=	$this->input->post('cus_note')[$i];
							if($this->input->post('radio_click[]')[$i] == "on"){
								$b = "on";
							}else if($this->input->post('radio_click[]')[$i] == "off"){
								$b = "off";
							}
							if($b=='on'){
									$contact['default_contact'] = 1;
							}else{
								$contact['default_contact'] = 0;
							}

						   $result=$this->AdminModel->addcontactdata($contact);
						}
					}



		            	//for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
						 for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) {

						 	if($this->input->post('cuscnt_type_email')[$j]!="")
						 	{

						 	    $contact1['cus_id']	=	$up_id;
								 //$contact1['conatct_type']	=	"Email";
								 $contact1['conatct_type']	=	$this->input->post('cuscnt_type_email')[$j];
								 $contact1['email']	=	$this->input->post('txtemail')[$j];
								 if($this->input->post('email_radio_click[]')[$j] == "on"){
									$b = "on";
								}else if($this->input->post('email_radio_click[]')[$j] == "off"){
									$b = "off";
								}
								if($b == 'on'){
									$contact1['default_contact'] = 1;
								}else{
									$contact1['default_contact'] = 0;
								}

							     $result=$this->AdminModel->addcontactdata($contact1);
						 	}

						}



						$this->db->where('cus_id',$up_id);
						$this->db->where('con_type',$this->input->post('adcntype'));
						//$this->db->where('name',$this->input->post('name'));
						$this->AdminModel->del_additionalcontactdata($up_id);

						//for ($k=0; $k < count($this->input->post('adcntype')) ; $k++) {
						for ($k=0; $k < count($this->input->post('name')) ; $k++) {

						   if($this->input->post('name')[$k]!="")
							{

								 $contact2['cus_id']	=	$up_id;
								 $contact2['con_type']	=	$this->input->post('adcntype');
								 $contact2['name']	=	$this->input->post('name')[$k];
								 $contact2['address']	=	$this->input->post('address')[$k];
								 $contact2['city']	=	$this->input->post('city')[$k];
								 $contact2['state']	=	$this->input->post('state')[$k];
								 $contact2['zip']	=	$this->input->post('zip')[$k];
								 $contact2['home']	=	$this->input->post('home')[$k];
								 $contact2['cel']	=	$this->input->post('cel')[$k];
								 $contact2['work']	=	$this->input->post('work')[$k];
								 $contact2['email']	=	$this->input->post('emailaddr')[$k];

							     $result=$this->AdminModel->additionalcontactdata($contact2);
					      }

						}

					$this->session->set_userdata('id',$up_id);

					$this->session->set_flashdata('success', 'Customer updated successfully ..!');
					//redirect('fi_home/custevents');
					redirect('fi_home/search_new_cus');
				}

		    }else
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

	public function search_cust_mainsearch()
	{

		$cus_fname   = $this->input->post('q');
		if ($cus_fname !="") {
			$fname =$cus_fname;
		}
		else {
			$fname="";
		}

		$cus_lname 	= $this->input->post('q');
		if ($cus_lname !="") {
			$lname =$cus_lname;
		}
		else {
			$lname="";
		}
		$cus_cname 	= $this->input->post('q');
		if ($cus_cname !="") {
			$cname =$cus_cname;
		}
		else {
			$cname="";
		}
		$cus_zname  = $this->input->post('q');
		if ($cus_zname !="") {
			$zname =$cus_zname;
		}
		else {
			$zname="";
		}
		$cus_mname 	= $this->input->post('q');
		if ($cus_mname !="") {
			$mname =$cus_mname;
		}
		else {
			$mname="";
		}
		$adr11 = $this->input->post('q');
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

		$adr2 = "";

		$city = $this->input->post('q');
		if ($city !="") {
			$cities = $city;
		}
		else {
			$cities = "";
		}
		$state = $this->input->post('q');
		if ($state !="") {
			$states = $state;
		}
		else {
			$states = "";
		}
		$areas = $this->input->post('q');
		if ($areas !="") {
			$area = $areas;
		}
		else {
			$area = "";
		}

		$txtphoneno = $this->input->post('q');
		if ($txtphoneno !="") {
			$phone =$txtphoneno;
		}
		else {
			$phone="";
		}


	  $this->AdminModel->search_cust_mainsearch_dtls($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area,$phone);

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

   public function fndeleventinfo()
	{
		$result=$this->AdminModel->fndeleventinfo_dtls();
	}

   public function fndellocationinfo()
	{
		$result=$this->AdminModel->fndellocationinfo_dtls();
	}

   public function fndelcrewsinfo()
	{
		$result=$this->AdminModel->fndelcrewsinfo_dtls();
	}

  public function fngetphonewisrhinv()
	{
		$result=$this->AdminModel->fngetphonewisrhinv_dtls();
	}


  public function search_evcustomer()
	{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}

			$cus_mobile=$this->input->get('mobile');
			$cus_id=$this->input->get('id');

			if ($cus_mobile !="" && $cus_id!="" )
			{
				$this->session->set_userdata('mobile',$cus_mobile);
				$this->session->set_userdata('id',$cus_id);
 				redirect('fi_home/search_new_customer');
			}else {

			}

	}

public function search_new_customer()
{
	if(!isset($this->session->fi_session)){
		redirect('/','refresh');
	}
	// print_r($this->input->get('id'));die;
	$cus_id=$this->session->userdata('id');
	$cus_mobile=$this->session->userdata('mobile');

	//echo "cus_id--".$cus_id." cus_mobile--".$cus_mobile;die;




	//event_table
	$results=$this->AdminModel->chk_contactinfo_id_count($cus_id,$cus_mobile);

	//print_r($results);die;

	if ($results > 0) {

	$event_data['single_cust']  	= $this->AdminModel->search_data()[0];



	$event_data['event_data']=$this->AdminModel->get_event_data_id($cus_id);

	//location table
	//$event_data['location_data']=$this->AdminModel->get_locationt_data_id($event_data['event_data']['event_id']);

	$event_data['location_data']=$this->AdminModel->get_locationt_data_id($cus_id);


	// echo "<pre>"; print_r($event_data['location_data']);echo "<br>";
	//crews table
	//$event_data['crews_data']=$this->AdminModel->get_crews_data_id($event_data['event_data']['event_id']);

	$event_data['crews_data']=$this->AdminModel->get_crews_data_id($cus_id);

	// echo "<pre>"; print_r($event_data['crews_data']);echo "<br>";

 // job info table
 //$event_data['job_info_data']=$this->AdminModel->get_job_info_data_id($event_data['event_data']['event_id']);
 // echo "<pre>"; print_r($event_data['job_info_data']);echo "<br>";

	// crews avability table
	//$event_data['crews_avability_data']=$this->AdminModel->get_crews_avability_data_id($event_data['event_data']['event_id']);
	// echo "<pre>"; print_r($event_data['crews_avability_data']);echo "<br>";

 //ASSOCIATED ORDER table
 //$event_data['associated_data']=$this->AdminModel->get_associated_data_id($event_data['event_data']['event_id']);

 // echo "<pre>"; print_r($event_data['associated_data_data']);echo "<br>";

 // AFFILIATED VENDOR table
 //$event_data['affiliated_vendor_data']=$this->AdminModel->get_affiliated_vendor_data_id($event_data['event_data']['event_id']);

 // echo "<pre>"; print_r($event_data['affiliated_vendor_data']);echo "<br>";

 $event_data['search']  			=  $this->AdminModel->search_data();
 $event_data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();

 $get_loc = $this->db->query("SELECT * from add_location_event");

 $event_data['all_locs'] = $get_loc->result_array();
 $event_data['last_row'] = $this->db->where('cus_id',$cus_id)->get('register_customer')->result_array()[0];

 $event_data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();

 $event_data['alert']    = $this->session->flashdata('alert');
 $event_data['error']    = $this->session->flashdata('error');
 $event_data['success']  = $this->session->flashdata('success');

 $this->load->view('fi/header');
 $this->load->view('fi/sidebar');
 $this->load->view('fi/cus_event_update',$event_data);
 $this->load->view('fi/footer');
}
else {

			$event_data['single_cust']  	= array("contact_no"=>$cus_mobile); //$this->AdminModel->search_data()[0];

			 $event_data['search']  	  =  $this->AdminModel->search_data();
			 $event_data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();

			 $get_loc = $this->db->query("SELECT * from add_location_event");

			 $event_data['all_locs'] = $get_loc->result_array();
			 $event_data['last_row'] = $this->db->where('cus_id',$cus_id)->get('register_customer')->result_array()[0];

			  $event_data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();


				$event_data['event_data']= $this->AdminModel->serch_get_event_data_id();

				$event_data['location_data']= $this->AdminModel->serch_get_locationt_data_id();

				$event_data['crews_data']= $this->AdminModel->serch_get_crews_data_id();




				$event_data['alert']    = $this->session->flashdata('alert');
				$event_data['error']    = $this->session->flashdata('error');
				$event_data['success']  = $this->session->flashdata('success');


				//redirect('fi_home/custevents',$event_data);
				 $this->load->view('fi/header');
			     $this->load->view('fi/sidebar');
			     $this->load->view('fi/cus_event_update',$event_data);
			     $this->load->view('fi/footer');

		  }



   }


   	public function addvendor()
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
			$data['cus_area']                         = $this->input->post('cus_area');
			$data['cus_tax_status']   		= $this->input->post('tax_status');
			$data['cus_tax_id']   				= $this->input->post('cus_tax_id');
			$data['cus_tax_id']   				= $this->input->post('cus_tax_id');
			$data['ap_cat']   				= $this->input->post('apcate');
			$data['ap_sbcat']   				= $this->input->post('apsubcate');
		// print_r($data);die;
		$cus_id=$this->AdminModel->addvendor_dtls($data);
		if ($cus_id > 0) {
			$address['ship_user_id']      	= $cus_id;
			$address['ship_address1']      	= $this->input->post('cus_ship_address1');
			$address['ship_address2']   			= $this->input->post('cus_ship_address2');
			$address['ship_city']   					= $this->input->post('cus_ship_city');
			$address['ship_state']   					= $this->input->post('cus_ship_state');
			$address['ship_zip']   					= $this->input->post('cus_ship_zip');
			$address['billing_addr_status']   		= $this->input->post('billaddr');

			// $address['ship_area']   					= $this->input->post('cus_ship_area');

			$this->AdminModel->vendaddshipaddress_dtls($address);


				//for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
			   for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) {
					$contact['cus_id']	=	$cus_id;
					$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
				    //$contact['conatct_type']	=	"Home";
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

				   $result=$this->AdminModel->addvendcontactdata_dtls($contact);
				 }



            	//for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
				 for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) {
				 $contact1['cus_id']	=	$cus_id;
				 //$contact1['conatct_type']	=	"Email";
				 $contact1['conatct_type']	=	$this->input->post('cuscnt_type_email')[$j];
				 $contact1['email']	=	$this->input->post('txtemail')[$j];
			     $result=$this->AdminModel->addvendcontactdata_dtls($contact1);
				}


			 /* $chkinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$cus_id."'");
			  $ninrows=$chkinvsql->num_rows();

			   if($ninrows<0)
			   {
			   		$postinvarr=array(
	    		    //"invoice_id" => $chkinvsql_dtls->invoice_id+1,
	    		    "cust_id" => $cus_id,
	    		    "invoice_name" => "new_invoice",
	    		    "invoice_date" => date('Y-m-d'),
					"invoice_status" =>0
	    		   );
				 $this->db->insert('invoices_create',$postinvarr);
			   }*/



			  $chkvendattchexitssql=$this->db->query("SELECT * FROM vend_attachment WHERE cust_id='".$cus_id."'");
			  $isnvendattchrows=$chkvendattchexitssql->num_rows();

			   if($isnvendattchrows==0)
			   {
			   		$postvendattchvarr=array(
	    		     "cust_id" => $cus_id,
	    		   );
				 $this->db->insert('vend_attachment',$postvendattchvarr);
			   }




			$this->session->set_flashdata('success', 'Vendor Created SuccessFully ..!');
			redirect('fi_home/vendor_events');
		}
		else
		{
		$this->session->set_flashdata('error', 'Something Went Wrong..!');
		redirect('fi_home/vendor_genral_info');
		}
	}


	public function update_vendor()
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
			$data['cus_area']                         = $this->input->post('cus_area');
			$data['cus_tax_status']   		= $this->input->post('tax_status');
			$data['cus_tax_id']   				= $this->input->post('cus_tax_id');
			$data['ap_cat']   				= $this->input->post('apcate');
			$data['ap_sbcat']   				= $this->input->post('apsubcate');
			$up_id = $this->input->post('cus_id');
		// print_r($data);die;
		$cus_id = $this->AdminModel->up_addvendor($data,$up_id);
		if ($cus_id) {
			$address['ship_user_id']      	= $up_id;
			$address['ship_address1']      	= $this->input->post('cus_ship_address1');
			$address['ship_address2']   			= $this->input->post('cus_ship_address2');
			$address['ship_city']   					= $this->input->post('cus_ship_city');
			$address['ship_state']   					= $this->input->post('cus_ship_state');
			$address['ship_zip']   					= $this->input->post('cus_ship_zip');
			$address['billing_addr_status']   		= $this->input->post('billaddr');
			// $address['ship_area']   					= $this->input->post('cus_ship_area');

			$this->AdminModel->up_addvendshipaddress($address,$up_id);
			$this->AdminModel->del_addvendcontactdata($up_id);
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




			//for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
			   for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) {
					$contact['cus_id']	=	$up_id;
					$contact['conatct_type']	=	$this->input->post('cus_contact_type')[$i];
				    //$contact['conatct_type']	=	"Home";
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

				   $result=$this->AdminModel->addvendcontactdata_dtls($contact);
				 }



            	//for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
				 for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) {
				 $contact1['cus_id']	=	$up_id;
				 //$contact1['conatct_type']	=	"Email";
				 $contact1['conatct_type']	=	$this->input->post('cuscnt_type_email')[$j];
				 $contact1['email']	=	$this->input->post('txtemail')[$j];
			     $result=$this->AdminModel->addvendcontactdata_dtls($contact1);
				}
			$this->session->set_flashdata('success', 'Vendor updated successfully ..!');
			redirect('fi_home/vendor_events');
		}
		else
		{
		$this->session->set_flashdata('error', 'Something went wrong..!');
		redirect('fi_home/vendor_genral_info');
		}
	}


   	public function getVenderInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->allVendorGeneralInfo($cName);
	}

	public function getVendContactInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->getVendContactInfo_dtls($cName);
	}

	public function fnloadvendlistbyphone()
	{
		$txtphonenum = $this->input->post('txtphonenum');
		$this->AdminModel->fnloadvendlistbyphone_dtls($txtphonenum);
	}

   public function fnvendersrchbyph()
	{

		$txtphoneno = $this->input->post('txtphoneno');
		if ($txtphoneno !="") {
			$phone =$txtphoneno;
		}
		else {
			$phone="";
		}

	  $this->AdminModel->fnvendersrchbyph_dtls($phone);

   }

   public function getSearchVendContactInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->allSearchVendInfo($cName);
	}

   public function search_vend()
	{

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

		$apcate = $this->input->post('apcate');
		if ($apcate !="") {
			$apcat = $apcate;
		}
		else {
			$apcat = "";
		}

		$apsubcate = $this->input->post('apsubcate');
		if ($apsubcate !="") {
			$apsubcat = $apsubcate;
		}
		else {
			$apsubcat = "";
		}

	  $this->AdminModel->search_vender($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area,$apcate,$apsubcate);

   }

   public function getVenderSearchInfo()
	{
		$cName = $this->input->post('name');
		$this->AdminModel->getVenderSearchInfo_dtls($cName);
	}

 public function vendor_events()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    			= $this->session->flashdata('alert');
		$data['error']    			= $this->session->flashdata('error');
		$data['success']  			= $this->session->flashdata('success');
		$data['search']  			  = $this->AdminModel->vendor_search_data();
		$data['single_cust']  	= $this->AdminModel->vendor_search_data()[0];

		$data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();
		$data['last_row'] = $this->db->order_by('cus_id',"desc")->limit(1)->get('register_vendor')->result_array()[0];
		$get_loc = $this->db->query("SELECT * from add_location_event");

		$data['all_locs'] = $get_loc->result_array();
		$data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();

		$data['event_data']=$this->AdminModel->get_vend_event_data_id($data['last_row']['cus_id']);

		$data['location_data']=$this->AdminModel->get_vend_locationt_data_id($data['last_row']['cus_id']);

		$data['crews_data']=$this->AdminModel->get_vend_crews_data_id($data['last_row']['cus_id']);


		// print_r($data['all_locs']);die;
		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/vendor_events',$data);
		$this->load->view('fi/footer');
	}

 public function addvendorevent()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}
		// echo "<pre>";print_r($this->input->post());
		if($this->input->post('cuss_id')!="" && $this->input->post('edate')[0]!="")
		{

			$result_cus=$this->AdminModel->check_vend_event_id($this->input->post('cuss_id'),$this->input->post('edate')[0]);
		//echo "<pre>";print_r($result_cus);
		if ($result_cus==0) {

			//echo "<pre>";print_r($this->input->post());

			for ($i=0; $i < count($this->input->post('event_type')) ; $i++) {

			  if($this->input->post('event_type')[$i]!="Select" || $this->input->post('edate')[$i]!="")
				 {


					$data['cus_id']         				= $this->input->post('cuss_id');
					$data['event_type']         		= $this->input->post('event_type')[$i];
					$data['event_name']         		= $this->input->post('ename')[$i];
					$data['event_date']         		= $this->input->post('edate')[$i];
					$data['event_time']         		= $this->input->post('etime')[$i];
					// $data['event_end_date']         = $this->input->post('endate')[$i];
					// $data['event_end_time']         = $this->input->post('entime')[$i];
					// $data1['event_booked']         	= $this->input->post('bookedcheck')[$i];
					// if ($data1['event_booked']=='on') {
					// 	$data['event_booked']=1;
					// }
					// else {
					// 	$data['event_booked']=0;
					// }
					// $data1['event_lost']         		= $this->input->post('lostcheck')[$i];
					// if ($data1['event_lost']=='on') {
					// 	$data['event_lost']=1;
					// }
					// else {
					// 	$data['event_lost']=0;
					// }
					// $data['event_guest']         		= $this->input->post('eguest')[$i];
					// $data['event_hebrew_date']      = $this->input->post('ehdate')[$i];
					// $data['event_day']         			= $this->input->post('eday')[$i];
					// $data['event_referred_by']      = $this->input->post('referdby')[$i]; // erby
					// $data['event_note']         		= $this->input->post('enote')[$i];

				   $result=$this->AdminModel->insertvendorevent($data);

				}

	     }

		 //print_r($result);die;

		if ($result > 0) {

		    for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {

		    	if($this->input->post('add_location')[$i]!="Select" || $this->input->post('ddate')[$i]!="")
                   {

     				$location['event_id']	= $this->input->post('cuss_id');	//$result;
					$location['location_type']	=	$this->input->post('add_location')[$i];
					$location['location_date']	=	$this->input->post('ddate')[$i];
					$location['location_time']	=	$this->input->post('time')[$i];
					$location['location_address']=	$this->input->post('address')[$i];
					$location['location_city']=	$this->input->post('city')[$i];
					$location['location_state']=	$this->input->post('state')[$i];
					$location['location_zip']=	$this->input->post('zip')[$i];
					$location['location_phone']=	$this->input->post('phone')[$i];
					//$location['location_landmark']=	$this->input->post('landmark')[$i];
					$location['location_note']=	$this->input->post('note')[$i];

					$result1=$this->AdminModel->insertvendorlocation($location);
				 }

		    }



			// for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++) {

			// 	 if($this->input->post('crewstype')[$i]!="Select")
   //                 {

			// 		$crew['event_id']	= $this->input->post('cuss_id');	//$result;
			// 		$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
			// 		$crew['crews_type']	=	$this->input->post('crewstype')[$i];
			// 		$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
			// 		$crew1['crews_commited']	=	$this->input->post('commited')[$i];
			// 		if ($crew1['crews_commited']=='on') {
			// 			$crew['crews_commited']=1;
			// 		}
			// 		else {
			// 			$crew['crews_commited']=0;
			// 		}
			// 		$crew2['crews_hide']=	$this->input->post('hide')[$i];
			// 		if ($crew2['crews_hide']=='on') {
			// 			$crew['crews_hide']=1;
			// 		}
			// 		else {
			// 			$crew['crews_hide']=0;
			// 		}
			// 		$crew['crews_start_date']=	$this->input->post('start_date')[$i];
			// 		$crew['crews_start_time']=	$this->input->post('start_time')[$i];
			// 		$crew['crews_ending']=	$this->input->post('ending')[$i];
			// 		$crew['crews_over_time']=	$this->input->post('over_time')[$i];
			// 		$crew['crews_location']=	$this->input->post('location')[$i];
			// 		$crew['crews_end_date']=	$this->input->post('end_date')[$i];
			// 		$crew['crews_end_time']=	$this->input->post('end_time')[$i];
			// 		$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
			// 		$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

			// 		$result2=$this->AdminModel->insertvendorcrew($crew);

			// 	}
			// }

			 /*	for ($i=0; $i < count($this->input->post('job_type')) ; $i++) {
			$job_data['event_id']	=	$result;
			$job_data['jobs_type']	=	$this->input->post('job_type')[$i];
			$job_data['jobs_fname']	=	$this->input->post('jfname')[$i];
			$job_data['jobs_spouse']	=	$this->input->post('spouse')[$i];
			$job_data['jobs_children']=	$this->input->post('children')[$i];
			$job_data['jobs_crew_number']=	$this->input->post('crew_number')[$i];
			$job_data['jobs_start_time']=	$this->input->post('start_time')[$i];
			$job_data['jobs_note']=	$this->input->post('note')[$i];
			$job_data['jobs_phone']=	$this->input->post('phone')[$i];

			$result3=$this->AdminModel->insertjobs($job_data);
			}
			for ($i=0; $i < count($this->input->post('atype')) ; $i++) {
			$data_a['event_id']	=	$result;
			$data_a['type']	=	$this->input->post('atype')[$i];
			$data_a['vendor']	=	$this->input->post('avendor')[$i];
			$data_a['start_date']	=	$this->input->post('astart_date')[$i];
			$data_a['start_time']=	$this->input->post('astart_time')[$i];
			$data_a['status']=	$this->input->post('astatus')[$i];
			$data_a['note']=	$this->input->post('anote')[$i];
			$data_a['email_availability']=	$this->input->post('email_availability')[$i];
			$data_a['add_to_crews']=	$this->input->post('add_to_crews')[$i];

			$result4=$this->AdminModel->insertcrew_availability($data_a);
			}
			for ($i=0; $i < count($this->input->post('invoice')) ; $i++) {
			$associated['event_id']	=	$result;
			$associated['invoice']	=	$this->input->post('invoice')[$i];
			$associated['name']	=	$this->input->post('name')[$i];
			$associated['date_entered']	=	$this->input->post('date_entered')[$i];
			$associated['due_date']=	$this->input->post('due_date')[$i];
			$associated['contract_type']=	$this->input->post('contract_type')[$i];
			$associated['discount']=	$this->input->post('discount')[$i];
			$associated['sub_total']=	$this->input->post('sub_total')[$i];
			$associated['tax']=	$this->input->post('tax')[$i];
			$associated['amount']=	$this->input->post('amount')[$i];
			$associated['paid']=	$this->input->post('paid')[$i];
			$associated['balance_due']=	$this->input->post('balance_due')[$i];
			$associated['tax_rate']=	$this->input->post('tax_rate')[$i];
			$associated['county']=	$this->input->post('county')[$i];
			$associated['user']=	$this->input->post('user')[$i];

			$result5=$this->AdminModel->insertassociated_order($associated);
			}

					for ($i=0; $i < count($this->input->post('type')) ; $i++) {
					$associated['event_id']	=	$result;
					$affiliated['affiliated_type']	=	$this->input->post('type')[$i];
					$affiliated['affiliated_vendor']	=	$this->input->post('vendor')[$i];

					$result6=$this->AdminModel->insertaffiliated_vendor($affiliated);
					}*/


		}
			$this->session->set_flashdata('success',"Event Created Successfully..!!");
			redirect('fi_home/vendor_events');

		}else if($result_cus>0){


			   $this->db->where("cus_id",$this->input->post('cuss_id'));
			   if($this->db->delete('vendor_events_register'))
			   {
			   		for ($i=0; $i < count($this->input->post('event_type')) ; $i++) {


			   	/*if($this->input->post('event_type')[$i]!="Select" || $this->input->post('edate')[$i]!="" || $this->input->post('etime')[$i]!="" || $this->input->post('endate')[$i]!="" || $this->input->post('entime')[$i]!="" || $this->input->post('bookedcheck')[$i]!="" || $this->input->post('lostcheck')[$i]!="" || $this->input->post('eguest')[$i]!="" || $this->input->post('ehdate')[$i]!="" || $this->input->post('eday')[$i]!="" || $this->input->post('referdby')[$i]!="" || $this->input->post('enote')[$i]!="")
				 {*/

				 if($this->input->post('event_type')[$i]!="Select" || $this->input->post('edate')[$i]!="")
				 {

					$data['cus_id']         				= $this->input->post('cuss_id');
					$data['event_type']         		= $this->input->post('event_type')[$i];
					$data['event_name']         		= $this->input->post('ename')[$i];
					$data['event_date']         		= $this->input->post('edate')[$i];
					$data['event_time']         		= $this->input->post('etime')[$i];
					/*$data['event_end_date']         = $this->input->post('endate')[$i];
					$data['event_end_time']         = $this->input->post('entime')[$i];
					$data1['event_booked']         	= $this->input->post('bookedcheck')[$i];
					if ($data1['event_booked']=='on') {
						$data['event_booked']=1;
					}
					else {
						$data['event_booked']=0;
					}
					$data1['event_lost']         		= $this->input->post('lostcheck')[$i];
					if ($data1['event_lost']=='on') {
						$data['event_lost']=1;
					}
					else {
						$data['event_lost']=0;
					}
					$data['event_guest']         		= $this->input->post('eguest')[$i];
					$data['event_hebrew_date']      = $this->input->post('ehdate')[$i];
					$data['event_day']         			= $this->input->post('eday')[$i];
					$data['event_referred_by']      = $this->input->post('referdby')[$i]; // erby
					$data['event_note']         		= $this->input->post('enote')[$i];*/

				   $result=$this->AdminModel->insertvendorevent($data);

				}
	         }


			}


		      // $delevntstables=array('event_location','event_crews');
		       $this->db->where("event_id",$this->input->post('cuss_id'));
			   if($this->db->delete('vendor_event_location'))
			   {

						for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {

				/*  if($this->input->post('add_location')[$i]!="" || $this->input->post('ddate')[$i]!="" || $this->input->post('time')[$i]!="" || $this->input->post('address')[$i]!="" || $this->input->post('city')[$i]!="" || $this->input->post('state')[$i]!="" || $this->input->post('zip')[$i]!="" || $this->input->post('phone')[$i]!="" || $this->input->post('landmark')[$i]!="" || $this->input->post('note')[$i]!="")
                   {*/

				if($this->input->post('add_location')[$i]!="Select" || $this->input->post('ddate')[$i]!="")
                   {

						$location['event_id']	= $this->input->post('cuss_id');	//$result;
						$location['location_type']	=	$this->input->post('add_location')[$i];
						$location['location_date']	=	$this->input->post('ddate')[$i];
						$location['location_time']	=	$this->input->post('time')[$i];
						$location['location_address']=	$this->input->post('address')[$i];
						$location['location_city']=	$this->input->post('city')[$i];
						$location['location_state']=	$this->input->post('state')[$i];
						$location['location_zip']=	$this->input->post('zip')[$i];
						$location['location_phone']=	$this->input->post('phone')[$i];
						//$location['location_landmark']=	$this->input->post('landmark')[$i];
						$location['location_note']=	$this->input->post('note')[$i];

						$result1=$this->AdminModel->insertvendorlocation($location);
					}
				}

			}

			/*   $this->db->where("event_id",$this->input->post('cuss_id'));
			   if($this->db->delete('vendor_event_crews'))
			   {

						for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++) {



                 if($this->input->post('crewstype')[$i]!="Select")
                   {


						$crew['event_id']	= $this->input->post('cuss_id');	//$result;
						$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
						$crew['crews_type']	=	$this->input->post('crewstype')[$i];
						$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
						$crew1['crews_commited']	=	$this->input->post('commited')[$i];
						if ($crew1['crews_commited']=='on') {
							$crew['crews_commited']=1;
						}
						else {
							$crew['crews_commited']=0;
						}
						$crew2['crews_hide']=	$this->input->post('hide')[$i];
						if ($crew2['crews_hide']=='on') {
							$crew['crews_hide']=1;
						}
						else {
							$crew['crews_hide']=0;
						}
						$crew['crews_start_date']=	$this->input->post('start_date')[$i];
						$crew['crews_start_time']=	$this->input->post('start_time')[$i];
						$crew['crews_ending']=	$this->input->post('ending')[$i];
						$crew['crews_over_time']=	$this->input->post('over_time')[$i];
						$crew['crews_location']=	$this->input->post('location')[$i];
						$crew['crews_end_date']=	$this->input->post('end_date')[$i];
						$crew['crews_end_time']=	$this->input->post('end_time')[$i];
						$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
						$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

						$result2=$this->AdminModel->insertvendorcrew($crew);
					}
			    }

		     }*/

	           $this->session->set_flashdata('success',"Event Updated Successfully..!!");
			   redirect('fi_home/search_new_vendor');


		}else {
			$this->session->set_flashdata('error',"Please select another date as event already exist for same date..!!");
			redirect('fi_home/search_new_vendor');
		}

		}else {
			$this->session->set_flashdata('error',"Please enter the date..!!");
			redirect('fi_home/search_new_vendor');
		}




   }


   public function find_vendor()
		{
			if(!isset($this->session->fi_session)){
					redirect('/','refresh');
			}

			$cus_id=$this->input->get('id');

			if ($cus_id !="")
			{
				$this->session->set_userdata('id',$cus_id);
 				redirect('fi_home/search_new_vendor');
			}else {

			}

		}

public function search_new_vendor()
{
	if(!isset($this->session->fi_session)){
		redirect('/','refresh');
	}
			// print_r($this->input->get('id'));die;
			$cus_id=$this->session->userdata('id');

			//print_r($cus_id);die;

			$event_data['single_cust']  	= $this->AdminModel->vendor_search_data()[0];

			//event_table
			$results=$this->AdminModel->get_vend_event_data_id($cus_id);

			//print_r($results);die;

			if ($results > 0) {



			$event_data['event_data']=$this->AdminModel->get_vend_event_data_id($cus_id);

			//location table
			//$event_data['location_data']=$this->AdminModel->get_locationt_data_id($event_data['event_data']['event_id']);

			$event_data['location_data']=$this->AdminModel->get_vend_locationt_data_id($cus_id);


			// echo "<pre>"; print_r($event_data['location_data']);echo "<br>";
			//crews table
			//$event_data['crews_data']=$this->AdminModel->get_crews_data_id($event_data['event_data']['event_id']);

			$event_data['crews_data']=$this->AdminModel->get_vend_crews_data_id($cus_id);

			// echo "<pre>"; print_r($event_data['crews_data']);echo "<br>";

		 // job info table
		 //$event_data['job_info_data']=$this->AdminModel->get_job_info_data_id($event_data['event_data']['event_id']);
		 // echo "<pre>"; print_r($event_data['job_info_data']);echo "<br>";

			// crews avability table
			//$event_data['crews_avability_data']=$this->AdminModel->get_crews_avability_data_id($event_data['event_data']['event_id']);
			// echo "<pre>"; print_r($event_data['crews_avability_data']);echo "<br>";

		 //ASSOCIATED ORDER table
		 //$event_data['associated_data']=$this->AdminModel->get_associated_data_id($event_data['event_data']['event_id']);

		 // echo "<pre>"; print_r($event_data['associated_data_data']);echo "<br>";

		 // AFFILIATED VENDOR table
		 //$event_data['affiliated_vendor_data']=$this->AdminModel->get_affiliated_vendor_data_id($event_data['event_data']['event_id']);

		 // echo "<pre>"; print_r($event_data['affiliated_vendor_data']);echo "<br>";

		 $event_data['search']  			=  $this->AdminModel->vendor_search_data();
		 $event_data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();

		 $get_loc = $this->db->query("SELECT * from add_location_event");

		 $event_data['all_locs'] = $get_loc->result_array();
		 $event_data['last_row'] = $this->db->where('cus_id',$cus_id)->get('register_vendor')->result_array()[0];

		 $event_data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();

		 $event_data['alert']    = $this->session->flashdata('alert');
		 $event_data['error']    = $this->session->flashdata('error');
		 $event_data['success']  = $this->session->flashdata('success');

		 $this->load->view('fi/header');
		 $this->load->view('fi/sidebar');
		 $this->load->view('fi/vendor_event_update',$event_data);
		 $this->load->view('fi/footer');
		}
	   else {


		 $event_data['search']  			=  $this->AdminModel->vendor_search_data();
		 $event_data['event_name'] 	  = $this->db->where('cat_id',3)->get('sub_categories')->result_array();

		 $get_loc = $this->db->query("SELECT * from add_location_event");

		 $event_data['all_locs'] = $get_loc->result_array();
		 $event_data['last_row'] = $this->db->where('cus_id',$cus_id)->get('register_vendor')->result_array()[0];

		  $event_data['all_crews'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();


			$event_data['event_data']=$this->AdminModel->get_vend_event_data_id($cus_id);

			$event_data['location_data']=$this->AdminModel->get_vend_locationt_data_id($cus_id);

			$event_data['crews_data']=$this->AdminModel->get_vend_crews_data_id($cus_id);




			$event_data['alert']    = $this->session->flashdata('alert');
			$event_data['error']    = $this->session->flashdata('error');
			$event_data['success']  = $this->session->flashdata('success');


			//redirect('fi_home/custevents',$event_data);
			 $this->load->view('fi/header');
		     $this->load->view('fi/sidebar');
		     $this->load->view('fi/vendor_event_update',$event_data);
		     $this->load->view('fi/footer');

		}



	}


   public function fndelvendoreventinfo()
	{
		$result=$this->AdminModel->fndelvendoreventinfo_dtls();
	}

   public function fndelvendorlocationinfo()
	{
		$result=$this->AdminModel->fndelvendorlocationinfo_dtls();
	}

   public function fndelvendorcrewsinfo()
	{
		$result=$this->AdminModel->fndelvendorcrewsinfo_dtls();
	}

	public function fniteminfojson()
	{
		$result=$this->AdminModel->fniteminfojson_dtls();
	}

	public function getvendorlist()
	{
		$result=$this->AdminModel->getvendorlist_dtls();
	}

	public function fnpckitems()
	{
		$result=$this->AdminModel->fnpckitems_dtls();
	}

   public function crnewpitem()
	{
	   $result=$this->AdminModel->crnewpitem_dtls();
    }

   public function delnewpitem()
	{
		$result=$this->AdminModel->delnewpitem_dtls();
	}

   public function upditemsinfo()
	{
		$result=$this->AdminModel->upditemsinfo_dtls();
	}

	public function upditemsamnt()
	{
		$result=$this->AdminModel->upditemsamnt_dtls();
	}

    public function upditemsdescrp()
	{
		$result=$this->AdminModel->upditemsdescrp_dtls();
	}

   public function updtpackagetot()
	{
		$result=$this->AdminModel->updtpackagetot_dtls();
	}

   public function delselpackage()
	{
		$result=$this->AdminModel->delselpackage_dtls();
	}

  public function search_allcust()
   {
   	  $this->AdminModel->search_allcust_dtls();
   }

  public function search_allvendor()
   {
   	  $this->AdminModel->search_allvendor_dtls();
   }

   public function search_items()
	{

		$adm_itemname   = $this->input->post('itemname');
		if ($adm_itemname !="") {
			$itemname =$adm_itemname;
		}
		else {
			$itemname="";
		}
		$adm_itemdesc 	= $this->input->post('itemdesc');
		if ($adm_itemdesc !="") {
			$itemdesc =$adm_itemdesc;
		}
		else {
			$itemdesc="";
		}
		$adm_itemprice 	= $this->input->post('itemprice');
		if ($adm_itemprice !="") {
			$itemprice =$adm_itemprice;
		}
		else {
			$itemprice="";
		}

	  $this->AdminModel->search_items_dtls($itemname,$itemdesc,$itemprice);

   }

   public function search_allitems()
   {
   	  $this->AdminModel->search_allitems_dtls();
   }

   public function search_pckageitems()
	{
		$adm_itemname   = $this->input->post('itemname');
		if ($adm_itemname !="") {
			$itemname =$adm_itemname;
		}
		else {
			$itemname="";
		}
		$adm_itemprice 	= $this->input->post('itemprice');
		if ($adm_itemprice !="") {
			$itemprice =$adm_itemprice;
		}
		else {
			$itemprice="";
		}

		$result=$this->AdminModel->search_pckageitems_dtls($itemname,$itemprice);
	}

   public function search_allpckageitems()
	{
	    $this->AdminModel->search_allpckageitems_dtls();
	}

   public function delgencustomer()
	{
		$this->AdminModel->delgencustomer_dtls();
	}

  public function fnupdatesearchinfo()
	{
		$this->AdminModel->fnupdatesearchinfo_dtls();
	}

  public function fndeleteaddicntinfo()
	{
		$this->AdminModel->fndeleteaddicntinfo_dtls();
	}
  public function fnloadeventinfo()
   {
   	  $this->AdminModel->fnloadeventinfo_dtls();
   }

  public function addeventinfo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		   //echo "<pre>";print_r($_POST);die;

			if(isset($_POST['Save']))
			{

				 //$this->db->where("event_id",$this->input->post('cuss_id'));
		       $this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_location'))
			   {

				 for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {


				if($this->input->post('add_location')[$i]!="" || $this->input->post('ddate')[$i]!="")
                   {

						$location['event_id']	= $this->input->post('hdneventId');	//$result;
						$location['location_type']	=	$this->input->post('add_location')[$i];
						$location['location_date']	=	$this->input->post('ddate')[$i];
						$location['location_time']	=	$this->input->post('time')[$i];
						$location['location_address']=	$this->input->post('address')[$i];
						$location['location_city']=	$this->input->post('city')[$i];
						$location['location_state']=	$this->input->post('state')[$i];
						$location['location_zip']=	$this->input->post('zip')[$i];
						$location['location_phone']=	$this->input->post('phone')[$i];
						$location['location_phone2']=	$this->input->post('phone2')[$i];
						//$location['location_landmark']=	$this->input->post('landmark')[$i];
						$location['location_note']=	$this->input->post('note')[$i];

						$result1=$this->AdminModel->insertlocation($location);
					}
				}

			}

			   //$this->db->where("event_id",$this->input->post('cuss_id'));
			   $this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_crews'))
			   {

				 for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++)
				  {
                     if($this->input->post('crewstype')[$i]!="")
                      {


						$crew['event_id']	= $this->input->post('hdneventId');	//$result;
						$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
						$crew['crews_type']	=	$this->input->post('crewstype')[$i];
						$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
						$crew1['crews_commited']	=	$this->input->post('commited')[$i];
						if ($crew1['crews_commited']=='on') {
							$crew['crews_commited']=1;
						}
						else {
							$crew['crews_commited']=0;
						}
						$crew2['crews_hide']=	$this->input->post('hide')[$i];
						if ($crew2['crews_hide']=='on') {
							$crew['crews_hide']=1;
						}
						else {
							$crew['crews_hide']=0;
						}
						$crew['crews_start_date']=	$this->input->post('start_date')[$i];
						$crew['crews_start_time']=	$this->input->post('start_time')[$i];
						$crew['crews_ending']=	$this->input->post('ending')[$i];
						$crew['crews_over_time']=	$this->input->post('over_time')[$i];
						$crew['crews_location']=	$this->input->post('location')[$i];
						$crew['crews_end_date']=	$this->input->post('end_date')[$i];
						$crew['crews_end_time']=	$this->input->post('end_time')[$i];
						$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
						$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

						$result2=$this->AdminModel->insertcrew($crew);
					 }
			      }
		      }


		       /*$this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_jobs'))
			   {
				  for ($i=0; $i < count($this->input->post('jptype')) ; $i++)
				   {
				     if($this->input->post('jptype')[$i]!="" )
                      {
						$job_data['event_id']	=	$this->input->post('hdneventId'); //$result;
						$job_data['jb_type']	=	$this->input->post('jptype')[$i];
						$job_data['jb_name']	=	$this->input->post('jbname')[$i];
						$job_data['jb_notes']	=	$this->input->post('jnote')[$i];
						$job_data['jb_import']	=	$this->input->post('jimpevntype')[$i];

					   $result3=$this->AdminModel->insertjobs($job_data);
				      }
				   }
				}*/

			$sqlupevntname=$this->db->query("SELECT * FROM event_jobs WHERE event_id='".$this->input->post('hdneventId')."' ORDER BY jb_id DESC LIMIT 2");
			$upevnamenrow=$sqlupevntname->num_rows();
			if($upevnamenrow>0)
			{
				$cntname="";
				foreach ($sqlupevntname->result() as $sqlupevntname_dtls)
				 {
						$cntname.=$sqlupevntname_dtls->jb_name."-";
				 }

				$upcntname=rtrim($cntname);
				$upevntnamearr=array(
					"event_name" => $upcntname
				);
				$this->db->where('event_id',$this->input->post('hdneventId'));
				$this->db->update('events_register',$upevntnamearr);

			}




		  $this->db->where("event_id",$this->input->post('hdneventId'));
		  if($this->db->delete('crew_availability'))
		    {
		    	$crw= array();
			  for ($i=0; $i < count($this->input->post('atype')) ; $i++)
			   {

			   		if($this->input->post('atype')[$i]!="" )
                      {

						$data_a['event_id']	= $this->input->post('hdneventId');	//$result;
						$data_a['type']	=	$this->input->post('atype')[$i];
						$data_a['vendor']	=	$this->input->post('cavailvend')[$i];
						$data_a['start_date']	=	$this->input->post('castart_date')[$i];
						$data_a['start_time']=	$this->input->post('caastart_time')[$i];
						$data_a['status']=	$this->input->post('caastatus')[$i];
						$data_a['note']=	$this->input->post('canote')[$i];
						//$data_a['email_availability']=	$this->input->post('email_availability')[$i];
					   //$data_a['add_to_crews']=	$this->input->post('add_to_crews')[$i];
						$data_a1['add_to_crews']=	$this->input->post('add_to_crews')[$i];
						if ($data_a1['add_to_crews']=='on'){
							$data_a['add_to_crews']=1;
						}else{
							$data_a['add_to_crews']=0;
						}

					 $result4=$this->AdminModel->insertcrew_availability($data_a);






					}
		       } //for end

		       //crew_availability
				$crwavailsql=$this->db->query("SELECT * FROM crew_availability WHERE add_to_crews=1 AND event_id='".$this->input->post('hdneventId')."'");

				 foreach ($crwavailsql->result() as $crwavailsql_dtls)
				 {
				 	if($crwavailsql_dtls->type!="" )
                     {
                     	$crwinsertarr=array();

					 	$crwinsertarr=array(
						"event_id" =>$crwavailsql_dtls->event_id,
						"crews_type" =>$crwavailsql_dtls->type,
						"crews_vendor" =>$crwavailsql_dtls->vendor,
						"crews_start_date" =>$crwavailsql_dtls->start_date,
						"crews_start_time" =>$crwavailsql_dtls->start_time
					    );
					 	//print_r($crwinsertarr);
					 	//$crw[] = $crwinsertarr;
					 	$this->db->insert('event_crews',$crwinsertarr);
				    }
				 }//die;
				 //print_r($crw);die;
	           	  $deleted = $this->db->where('add_to_crews',1)
		       	                      ->where('event_id',$this->input->post('hdneventId'))
		       	                      ->delete('crew_availability');



		    }

	           $this->session->set_flashdata('success',"Event Updated Successfully..!!");
			   redirect('fi_home/search_new_cus');

		}else if(isset($_POST['Submit']))
			{

			     //$this->db->where("event_id",$this->input->post('cuss_id'));
		       $this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_location'))
			   {

				 for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {


				if($this->input->post('add_location')[$i]!="" || $this->input->post('ddate')[$i]!="")
                   {

						$location['event_id']	= $this->input->post('hdneventId');	//$result;
						$location['location_type']	=	$this->input->post('add_location')[$i];
						$location['location_date']	=	$this->input->post('ddate')[$i];
						$location['location_time']	=	$this->input->post('time')[$i];
						$location['location_address']=	$this->input->post('address')[$i];
						$location['location_city']=	$this->input->post('city')[$i];
						$location['location_state']=	$this->input->post('state')[$i];
						$location['location_zip']=	$this->input->post('zip')[$i];
						$location['location_phone']=	$this->input->post('phone')[$i];
						$location['location_phone2']=	$this->input->post('phone2')[$i];
						//$location['location_landmark']=	$this->input->post('landmark')[$i];
						$location['location_note']=	$this->input->post('note')[$i];

						$result1=$this->AdminModel->insertlocation($location);
					}
				}

			}

			   //$this->db->where("event_id",$this->input->post('cuss_id'));
			   $this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_crews'))
			   {

				 for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++)
				  {
                     if($this->input->post('crewstype')[$i]!="")
                      {


						$crew['event_id']	= $this->input->post('hdneventId');	//$result;
						$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
						$crew['crews_type']	=	$this->input->post('crewstype')[$i];
						$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
						$crew1['crews_commited']	=	$this->input->post('commited')[$i];
						if ($crew1['crews_commited']=='on') {
							$crew['crews_commited']=1;
						}
						else {
							$crew['crews_commited']=0;
						}
						$crew2['crews_hide']=	$this->input->post('hide')[$i];
						if ($crew2['crews_hide']=='on') {
							$crew['crews_hide']=1;
						}
						else {
							$crew['crews_hide']=0;
						}
						$crew['crews_start_date']=	$this->input->post('start_date')[$i];
						$crew['crews_start_time']=	$this->input->post('start_time')[$i];
						$crew['crews_ending']=	$this->input->post('ending')[$i];
						$crew['crews_over_time']=	$this->input->post('over_time')[$i];
						$crew['crews_location']=	$this->input->post('location')[$i];
						$crew['crews_end_date']=	$this->input->post('end_date')[$i];
						$crew['crews_end_time']=	$this->input->post('end_time')[$i];
						$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
						$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

						$result2=$this->AdminModel->insertcrew($crew);
					 }
			      }
		      }


		       /*$this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_jobs'))
			   {
				  for ($i=0; $i < count($this->input->post('jptype')) ; $i++)
				   {
				     if($this->input->post('jptype')[$i]!="" )
                      {
						$job_data['event_id']	=	$this->input->post('hdneventId'); //$result;
						$job_data['jb_type']	=	$this->input->post('jptype')[$i];
						$job_data['jb_name']	=	$this->input->post('jbname')[$i];
						$job_data['jb_notes']	=	$this->input->post('jnote')[$i];
						$job_data['jb_import']	=	$this->input->post('jimpevntype')[$i];

					   $result3=$this->AdminModel->insertjobs($job_data);
				      }
				   }
				}*/

			$sqlupevntname=$this->db->query("SELECT * FROM event_jobs WHERE event_id='".$this->input->post('hdneventId')."' ORDER BY jb_id DESC LIMIT 2");
			$upevnamenrow=$sqlupevntname->num_rows();
			if($upevnamenrow>0)
			{
				$cntname="";
				foreach ($sqlupevntname->result() as $sqlupevntname_dtls)
				 {
						$cntname.=$sqlupevntname_dtls->jb_name."-";
				 }

				$upcntname=rtrim($cntname);
				$upevntnamearr=array(
					"event_name" => $upcntname
				);
				$this->db->where('event_id',$this->input->post('hdneventId'));
				$this->db->update('events_register',$upevntnamearr);

			}




		  $this->db->where("event_id",$this->input->post('hdneventId'));
		  if($this->db->delete('crew_availability'))
		    {
		    	$crw= array();
			  for ($i=0; $i < count($this->input->post('atype')) ; $i++)
			   {

			   		if($this->input->post('atype')[$i]!="" )
                      {

						$data_a['event_id']	= $this->input->post('hdneventId');	//$result;
						$data_a['type']	=	$this->input->post('atype')[$i];
						$data_a['vendor']	=	$this->input->post('cavailvend')[$i];
						$data_a['start_date']	=	$this->input->post('castart_date')[$i];
						$data_a['start_time']=	$this->input->post('caastart_time')[$i];
						$data_a['status']=	$this->input->post('caastatus')[$i];
						$data_a['note']=	$this->input->post('canote')[$i];
						//$data_a['email_availability']=	$this->input->post('email_availability')[$i];
					   //$data_a['add_to_crews']=	$this->input->post('add_to_crews')[$i];
						$data_a1['add_to_crews']=	$this->input->post('add_to_crews')[$i];
						if ($data_a1['add_to_crews']=='on'){
							$data_a['add_to_crews']=1;
						}else{
							$data_a['add_to_crews']=0;
						}

					 $result4=$this->AdminModel->insertcrew_availability($data_a);






					}
		       } //for end

		       //crew_availability
				$crwavailsql=$this->db->query("SELECT * FROM crew_availability WHERE add_to_crews=1 AND event_id='".$this->input->post('hdneventId')."'");

				 foreach ($crwavailsql->result() as $crwavailsql_dtls)
				 {
				 	if($crwavailsql_dtls->type!="" )
                     {
                     	$crwinsertarr=array();

					 	$crwinsertarr=array(
						"event_id" =>$crwavailsql_dtls->event_id,
						"crews_type" =>$crwavailsql_dtls->type,
						"crews_vendor" =>$crwavailsql_dtls->vendor,
						"crews_start_date" =>$crwavailsql_dtls->start_date,
						"crews_start_time" =>$crwavailsql_dtls->start_time
					    );
					 	//print_r($crwinsertarr);
					 	//$crw[] = $crwinsertarr;
					 	$this->db->insert('event_crews',$crwinsertarr);
				    }
				 }//die;
				 //print_r($crw);die;
	           	  $deleted = $this->db->where('add_to_crews',1)
		       	                      ->where('event_id',$this->input->post('hdneventId'))
		       	                      ->delete('crew_availability');



		    }

	           $this->session->set_flashdata('success',"Event Updated Successfully..!!");
			   redirect('fi_home/custinvoices');

			}



  }

   public function fndelevntjobinfo()
	{
		$result=$this->AdminModel->fndelevntjobinfo_dtls();
	}

   public function fnloadevntjobinfo()
   {
   	  $this->AdminModel->fnloadevntjobinfo_dtls();
   }



    public function addjobeventinfo()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

			   //$this->db->where("event_id",$this->input->post('cuss_id'));
		       $this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_location'))
			   {

				 for ($i=0; $i < count($this->input->post('add_location')) ; $i++) {


				if($this->input->post('add_location')[$i]!="" || $this->input->post('ddate')[$i]!="")
                   {

						$location['event_id']	= $this->input->post('hdneventId');	//$result;
						$location['location_type']	=	$this->input->post('add_location')[$i];
						$location['location_date']	=	$this->input->post('ddate')[$i];
						$location['location_time']	=	$this->input->post('time')[$i];
						$location['location_address']=	$this->input->post('address')[$i];
						$location['location_city']=	$this->input->post('city')[$i];
						$location['location_state']=	$this->input->post('state')[$i];
						$location['location_zip']=	$this->input->post('zip')[$i];
						$location['location_phone']=	$this->input->post('phone')[$i];
						$location['location_phone2']=	$this->input->post('phone2')[$i];
						//$location['location_landmark']=	$this->input->post('landmark')[$i];
						$location['location_note']=	$this->input->post('note')[$i];

						$result1=$this->AdminModel->insertlocation($location);
					}
				}

			}

			   //$this->db->where("event_id",$this->input->post('cuss_id'));
			   $this->db->where("event_id",$this->input->post('hdneventId'));
			   if($this->db->delete('event_crews'))
			   {

				 for ($i=0; $i < count($this->input->post('confirmed_on')) ; $i++)
				  {
                     if($this->input->post('crewstype')[$i]!="")
                      {


						$crew['event_id']	= $this->input->post('hdneventId');	//$result;
						$crew['crews_confirmed_on']	=	$this->input->post('confirmed_on')[$i];
						$crew['crews_type']	=	$this->input->post('crewstype')[$i];
						$crew['crews_vendor']	=	$this->input->post('vendortype')[$i];
						$crew1['crews_commited']	=	$this->input->post('commited')[$i];
						if ($crew1['crews_commited']=='on') {
							$crew['crews_commited']=1;
						}
						else {
							$crew['crews_commited']=0;
						}
						$crew2['crews_hide']=	$this->input->post('hide')[$i];
						if ($crew2['crews_hide']=='on') {
							$crew['crews_hide']=1;
						}
						else {
							$crew['crews_hide']=0;
						}
						$crew['crews_start_date']=	$this->input->post('start_date')[$i];
						$crew['crews_start_time']=	$this->input->post('start_time')[$i];
						$crew['crews_ending']=	$this->input->post('ending')[$i];
						$crew['crews_over_time']=	$this->input->post('over_time')[$i];
						$crew['crews_location']=	$this->input->post('location')[$i];
						$crew['crews_end_date']=	$this->input->post('end_date')[$i];
						$crew['crews_end_time']=	$this->input->post('end_time')[$i];
						$crew['crews_total_hours']=	$this->input->post('total_hours')[$i];
						$crew['crews_total_charge']=	$this->input->post('total_charge')[$i];

						$result2=$this->AdminModel->insertcrew($crew);
					 }
			      }
		      }


			 //   $this->db->where("job_id",$this->input->post('hdnjobId'));
			 //   $this->db->where("event_id",$this->input->post('hdneventId'));
			 //   if($this->db->delete('event_jobs_dtls'))
			 //   {
				//   for ($i=0; $i < count($this->input->post('job_type')) ; $i++)
				//    {
				//      if($this->input->post('job_type')[$i]!="" )
    //                   {
    //                   	$job_dtls['job_id']	=	$this->input->post('hdnjobId');
				// 		$job_dtls['event_id']	=	$this->input->post('hdneventId'); //$result;
				// 		$job_dtls['jobs_type']	=	$this->input->post('job_type')[$i];
				// 		$job_dtls['jobs_fname']	=	$this->input->post('jfname')[$i];
				// 		$job_dtls['jobs_spouse']	=	$this->input->post('spouse')[$i];
				// 		$job_dtls['jobs_children']=	$this->input->post('children')[$i];
				// 		$job_dtls['jobs_crew_number']=	$this->input->post('jbcrmemventype')[$i];
				// 		$job_dtls['jobs_start_time']=	$this->input->post('jbstart_time')[$i];
				// 		$job_dtls['jobs_note']=	$this->input->post('jbnote')[$i];
				// 		$job_dtls['jobs_phone']=	$this->input->post('jbphone')[$i];

				// 	   $result3=$this->AdminModel->insertjobsdtls($job_dtls);
				//       }
				//    }
				// }



		  $this->db->where("event_id",$this->input->post('hdneventId'));
		  if($this->db->delete('crew_availability'))
		    {
			  for ($i=0; $i < count($this->input->post('atype')) ; $i++)
			   {
			   	   if($this->input->post('atype')[$i]!="" )
                      {
						$data_a['event_id']	= $this->input->post('hdneventId');	//$result;
						$data_a['type']	=	$this->input->post('atype')[$i];
						$data_a['vendor']	=	$this->input->post('cavailvend')[$i];
						$data_a['start_date']	=	$this->input->post('castart_date')[$i];
						$data_a['start_time']=	$this->input->post('caastart_time')[$i];
						$data_a['status']=	$this->input->post('caastatus')[$i];
						$data_a['note']=	$this->input->post('canote')[$i];
						//$data_a['email_availability']=	$this->input->post('email_availability')[$i];
						//$data_a['add_to_crews']=	$this->input->post('add_to_crews')[$i];

						$result4=$this->AdminModel->insertcrew_availability($data_a);
					}
		       }
		    }



		  // $this->db->where("event_id",$this->input->post('hdneventId'));
		  // if($this->db->delete('crew_availability'))
		  //   {
			 //  for ($i=0; $i < count($this->input->post('atype')) ; $i++)
			 //   {
				// 	$data_a['event_id']	= $this->input->post('hdneventId');	//$result;
				// 	$data_a['type']	=	$this->input->post('atype')[$i];
				// 	$data_a['vendor']	=	$this->input->post('cavailvend')[$i];
				// 	$data_a['start_date']	=	$this->input->post('castart_date')[$i];
				// 	$data_a['start_time']=	$this->input->post('caastart_time')[$i];
				// 	$data_a['status']=	$this->input->post('caastatus')[$i];
				// 	$data_a['note']=	$this->input->post('canote')[$i];
				// 	//$data_a['email_availability']=	$this->input->post('email_availability')[$i];
				// 	//$data_a['add_to_crews']=	$this->input->post('add_to_crews')[$i];

				// 	$result4=$this->AdminModel->insertcrew_availability($data_a);
		  //      }
		  //   }


	           $this->session->set_flashdata('success',"Event Updated Successfully..!!");
			   redirect('fi_home/custinvoices');

  }

   public function fndelevntjobs_info()
	{
		$result=$this->AdminModel->fndelevntjobs_info_dtls();
	}


  public function getimpjobinfo()
	{
		$this->AdminModel->getimpjobinfo_dtls();
	}

  public function fncreatejob_info()
  {
  	 $this->AdminModel->fncreatejobinfo_dtls();
  }

 public function fncreatenwcrews_info()
  {
  	 $this->AdminModel->fncreatenwcrewsinfo_dtls();
  }

 public function fncreatenewcrewss_info()
  {
  	 $this->AdminModel->fncreatenewcrewssinfo_dtls();
  }

  public function fncrnewevent()
	{
	   $result=$this->AdminModel->fncrnewevent_dtls();
    }

  public function updtevent()
	{
		$result=$this->AdminModel->updtevent_dtls();
	}
  public function fnloadadditionalcnt_info()
  {
  	 $this->AdminModel->fnloadadditionalcntinfo_dtls();
  }

 public function addlettersinfo()
 {
 	//$this->AdminModel->addlettersinfo_dtls();

 	  //echo "<pre>"; print_r($_POST);die;
 	  $img_nm;
 	  if(isset($_FILES['lettrimg']['name'])!="")
		{
			$config['upload_path']   = 'uploads/letters_attachments';
			$config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$img_nm = "";
			if ($this->upload->do_upload('lettrimg'))
				{
					$data = array('upload_data' => $this->upload->data());
  					$img_nm = $this->upload->data('file_name');
				}
		}else{
		   $img_nm = "";
		}

 	 	$letterarr=array(
   			"name" => $this->input->post('txtlettertyp'),
   			"desc" => $this->input->post('textletterdetails'),
   			"attachment" => $img_nm
   		);

   	  $getexist_sql=$this->db->where('name',$this->input->post('txtlettertyp'))->get('adm_letters_type');
      $rowCount = $getexist_sql->num_rows();
      if($rowCount==1)
      {
         	  $this->db->where('name',$this->input->post('txtlettertyp'));
      		if($this->db->update('adm_letters_type',$letterarr))
		   	  {
		   	  	$this->session->set_flashdata('success',"Letter Updated Successfully..!!");
		 	    redirect('fi_home/administration_letters');
		   	  }
      }else{

      	  if($this->db->insert('adm_letters_type',$letterarr))
		   	 {
		   	  	$this->session->set_flashdata('success',"Letter Inserted Successfully..!!");
		 	    redirect('fi_home/administration_letters');
		   	 }
      }

 }

 public function getletterinfo()
 {
 	$this->AdminModel->getletterinfo_dtls();
 }

public function fndelletterinfo()
 {
	$result=$this->AdminModel->fndelletterinfo_dtls();
 }

public function newinrtevent()
 {
	$result=$this->AdminModel->newinrtevent_dtls();
 }

 public function sendeventletteremail()
 {
 	 $this->AdminModel->sendeventletteremail_dtls();
 }

  public function administration_crewavailability()
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
		$this->load->view('fi/administration_crewavailability',$data);
		$this->load->view('fi/footer');
	}

 public function addcrewavailabilitiesinfo()
 {
 	    $crewsavlarr=array(
   			"name" => $this->input->post('txtlettertyp'),
   			"desc" => $this->input->post('textletterdetails')
   		);

     	 $this->db->where('id',$this->input->post('txthdncrewId'));
  		 if($this->db->update('adm_crewavailability_info',$crewsavlarr))
	   	  {
	   	  	$this->session->set_flashdata('success',"Crew Updated Successfully..!!");
	 	    redirect('fi_home/administration_crewavailability');
	   	  }

 }

 public function sendcrewavlemail()
 {
 	// $this->AdminModel->sendcrewavlemail_dtls();

 	//echo "<pre>"; print_r($_FILES);

 	    $to=$_POST['nwcustemail'];
    	$sub=$_POST['letteremailsub'];
    	$msg=$_POST['letteremaildesc'];

    	$fileData = array();
    	$files = $_FILES;

 	if(!empty($_FILES['crewavl']['name']))
 	 {
	      $filesCount = count($_FILES['crewavl']['name']);

	      	//echo "filesCount--".$filesCount;die;

	        for($i = 0; $i < $filesCount; $i++){
	            $_FILES['crewavl']['name'] = $files['crewavl']['name'][$i];
	            $_FILES['crewavl']['type'] = $files['crewavl']['type'][$i];
	            $_FILES['crewavl']['tmp_name'] = $files['crewavl']['tmp_name'][$i];
	            $_FILES['crewavl']['error'] = $files['crewavl']['error'][$i];
	            $_FILES['crewavl']['size'] = $files['crewavl']['size'][$i];
	            $config['upload_path']   = 'uploads/crew_mails';
			    $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
			    $config['overwrite']     = FALSE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            if($this->upload->do_upload('crewavl')){
	             $fileData[] = $this->upload->data();
                 //$uploadImgData[$i]['crewavl'] = $fileData['file_name'];

	             $this->load->library('email');
	             $this->email->from('mike111taylor@gmail.com', 'ERP SYSTEM- Crew Availability');
	             $this->email->to($to);
		         $this->email->subject($sub);
		         $this->email->message($msg);
	                $pathToUploadedFile = $fileData[$i]['full_path'];
	                $this->email->attach($pathToUploadedFile);
	            }
	        }

	       $this->email->send();

	      $this->session->set_flashdata('success',"Mail Send Successfully..!!");
	 	  redirect('fi_home/search_new_cus');
	 }

 }


 public function sendletteremail()
 {

 	//echo "<pre>"; print_r($_FILES);

 	    $to=$_POST['lnwcustemail'];
    	$sub=$_POST['leteremailsub'];
    	$msg=$_POST['leteremaildesc'];
    	$attachmnt=site_url('/uploads/letters_attachments/').$_POST['flname'];

    	$fileData = array();
    	$files = $_FILES;

 	if(!empty($_FILES['limg']['name']))
 	 {
	      $filesCount = count($_FILES['limg']['name']);

	      	//echo "filesCount--".$filesCount;die;

	        for($i = 0; $i < $filesCount; $i++){
	            $_FILES['limg']['name'] = $files['limg']['name'][$i];
	            $_FILES['limg']['type'] = $files['limg']['type'][$i];
	            $_FILES['limg']['tmp_name'] = $files['limg']['tmp_name'][$i];
	            $_FILES['limg']['error'] = $files['limg']['error'][$i];
	            $_FILES['limg']['size'] = $files['limg']['size'][$i];
	            $config['upload_path']   = 'uploads/crew_mails';
			    $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
			    $config['overwrite']     = FALSE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            if($this->upload->do_upload('limg')){
	             $fileData[] = $this->upload->data();
                 //$uploadImgData[$i]['limg'] = $fileData['file_name'];

	             $this->load->library('email');
	             $this->email->from('mike111taylor@gmail.com', 'ERP SYSTEM- Event Letter');
	             $this->email->to($to);
		         $this->email->subject($sub);
		         $this->email->message($msg);
	                $pathToUploadedFile = $fileData[$i]['full_path'];
	                $this->email->attach($pathToUploadedFile);
	            }
	        }

	        $this->email->attach($attachmnt);
	        $this->email->send();

	      $this->session->set_flashdata('success',"Mail Send Successfully..!!");
	 	  redirect('fi_home/search_new_cus');
	 }

 }

 public function getcrewavailabilityinfo()
 {
 	$this->AdminModel->getcrewavailabilityinfo_dtls();
 }


 public function sendgeninfoemail()
 {

 	    $to=$_POST['nwcustemail'];
    	$sub=$_POST['letteremailsub'];
    	$msg=$_POST['letteremaildesc'];

    	$fileData = array();
    	$files = $_FILES;

 	if(!empty($_FILES['crewavl']['name']))
 	 {
	      $filesCount = count($_FILES['crewavl']['name']);

	      	//echo "filesCount--".$filesCount;die;

	        for($i = 0; $i < $filesCount; $i++){
	            $_FILES['crewavl']['name'] = $files['crewavl']['name'][$i];
	            $_FILES['crewavl']['type'] = $files['crewavl']['type'][$i];
	            $_FILES['crewavl']['tmp_name'] = $files['crewavl']['tmp_name'][$i];
	            $_FILES['crewavl']['error'] = $files['crewavl']['error'][$i];
	            $_FILES['crewavl']['size'] = $files['crewavl']['size'][$i];
	            $config['upload_path']   = 'uploads/crew_mails';
			    $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
			    $config['overwrite']     = FALSE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            if($this->upload->do_upload('crewavl')){
	             $fileData[] = $this->upload->data();
                 //$uploadImgData[$i]['crewavl'] = $fileData['file_name'];

	             $this->load->library('email');
	             $this->email->from('mike111taylor@gmail.com', 'ERP SYSTEM- General information');
	             $this->email->to($to);
		         $this->email->subject($sub);
		         $this->email->message($msg);
	                $pathToUploadedFile = $fileData[$i]['full_path'];
	                $this->email->attach($pathToUploadedFile);
	            }
	        }

	       $this->email->send();

	      $this->session->set_flashdata('success',"Mail Send Successfully..!!");
	 	  redirect('fi_home/generalinfo');
	 }

 }


 public function sendnewgeninfoemail()
 {

 	    $to=$_POST['nwcustemail'];
    	$sub=$_POST['letteremailsub'];
    	$msg=$_POST['letteremaildesc'];

    	$fileData = array();
    	$files = $_FILES;

 	if(!empty($_FILES['crewavl']['name']))
 	 {
	      $filesCount = count($_FILES['crewavl']['name']);

	      	//echo "filesCount--".$filesCount;die;

	        for($i = 0; $i < $filesCount; $i++){
	            $_FILES['crewavl']['name'] = $files['crewavl']['name'][$i];
	            $_FILES['crewavl']['type'] = $files['crewavl']['type'][$i];
	            $_FILES['crewavl']['tmp_name'] = $files['crewavl']['tmp_name'][$i];
	            $_FILES['crewavl']['error'] = $files['crewavl']['error'][$i];
	            $_FILES['crewavl']['size'] = $files['crewavl']['size'][$i];
	            $config['upload_path']   = 'uploads/crew_mails';
			    $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
			    $config['overwrite']     = FALSE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            if($this->upload->do_upload('crewavl')){
	             $fileData[] = $this->upload->data();
                 //$uploadImgData[$i]['crewavl'] = $fileData['file_name'];

	             $this->load->library('email');
	             $this->email->from('mike111taylor@gmail.com', 'ERP SYSTEM- General information');
	             $this->email->to($to);
		         $this->email->subject($sub);
		         $this->email->message($msg);
	                $pathToUploadedFile = $fileData[$i]['full_path'];
	                $this->email->attach($pathToUploadedFile);
	            }
	        }

	       $this->email->send();

	      $this->session->set_flashdata('success',"Mail Send Successfully..!!");
	 	  redirect('fi_home/newGeneralInfo');
	 }

 }


 public function delassignpackge()
	{
		$result=$this->AdminModel->delassignpackge_dtls();
	}

 public function insertinvnotes()
	{
		$result=$this->AdminModel->insertinvnotes_dtls();
	}

 public function updateinvnotes()
	{
		$result=$this->AdminModel->updateinvnotes_dtls();
	}

 public function delinvnote()
	{
		$result=$this->AdminModel->delinvnote_dtls();
	}

 public function fnpickupreq_info()
  {
  	 $this->AdminModel->fnpickupreqinfo_dtls();
  }

 public function fndelpickupreq_info()
 {
 	$this->AdminModel->fndelpickupreqinfo_dtls();
 }

 public function updtpickupinfo()
  {
	$result=$this->AdminModel->updtpickupinfo_dtls();
  }

 public function updinvpckgamt()
 {
	$result=$this->AdminModel->updinvpckgamt_dtls();
 }

 public function getSearchInvoiceInfo()
  {
	//$seleventype = $this->input->post('seleventype');
	$this->AdminModel->getSearchInvoiceInfo_dtls();
  }

 public function updtinvevnttype()
	{
		$result=$this->AdminModel->updtinvevnttype_dtls();
	}

 public function getSearchInvInfo()
  {
	$this->AdminModel->getSearchInvInfo_dtls();
  }

public function administration_terms()
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
		$this->load->view('fi/administration_contractterms',$data);
		//$this->load->view('fi/administration_terms',$data);
		$this->load->view('fi/footer');
 }

 public function addtermsinfo()
 {
 	  $letterarr=array(
   			"name" => $this->input->post('txttermstyp'),
   			"amount" => $this->input->post('textamount'),
   		);

   	  $getexist_sql=$this->db->where('name',$this->input->post('txttermstyp'))->get('adm_terms_type');
      $rowCount = $getexist_sql->num_rows();
      if($rowCount==1)
      {
         	  $this->db->where('name',$this->input->post('txttermstyp'));
      		if($this->db->update('adm_terms_type',$letterarr))
		   	  {
		   	  	$this->session->set_flashdata('success',"Terms Updated Successfully..!!");
		 	    redirect('fi_home/administration_terms');
		   	  }
      }else{

      	  if($this->db->insert('adm_terms_type',$letterarr))
		   	 {
		   	  	$this->session->set_flashdata('success',"Terms Inserted Successfully..!!");
		 	    redirect('fi_home/administration_terms');
		   	 }
      }

 }

 public function fndeltremsinfo()
 {
	$result=$this->AdminModel->fndeltremsinfo_dtls();
 }

 public function gettermsinfo()
  {
     $result=$this->AdminModel->gettermsinfo_dtls();
  }

  public function updtinvtermsinfo()
  {
  	$this->AdminModel->updtinvtermsinfo_dtls();
  }

  public function crnewinvterms()
  {
  	$this->AdminModel->crnewinvterms_dtls();
  }

  public function delterms()
   {
	 $result=$this->AdminModel->delterms_dtls();
   }

  public function updtermamt()
   {
	 $result=$this->AdminModel->updtermamt_dtls();
   }

 public function administration_task()
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
		$this->load->view('fi/administration_tasks',$data);
		$this->load->view('fi/footer');
 }

 public function crnwtask()
  {
    $this->AdminModel->crnwtask_dtls();
  }

 public function fndeltaskinfo()
  {
	$result=$this->AdminModel->fndeltaskinfo_dtls();
  }

  public function updtask()
	{
		$result=$this->AdminModel->updtask_dtls();
	}


 public function crinvnwtask()
  {
    $this->AdminModel->crinvnwtask_dtls();
  }

 public function fndelinvtaskinfo()
  {
	$this->AdminModel->fndelinvtaskinfo_dtls();
  }

 public function updinvtask()
  {
	$this->AdminModel->updinvtask_dtls();
  }

  public function updinvtaskinfo()
  {
	$this->AdminModel->updinvtaskinfo_dtls();
  }

 public function fnupdatejobinfo()
 {
 	$this->AdminModel->fnupdatejobinfo_dtls();
 }

public function fncrtevntjobinfo()
 {
 	$this->AdminModel->fncrtevntjobinfo_dtls();
 }

 public function fncrtnewjobdtinfo()
 {
 	$this->AdminModel->fncrtnewjobdtinfo_dtls();
 }

 public function fnupdtejobdtlsinfo()
 {
 	$this->AdminModel->fnupdtejobdtlsinfo_dtls();
 }

public function fncheckispackage()
 {
 	$this->AdminModel->fncheckispackage_dtls();
 }

public function fnupdatepckginfo()
{
	$result=$this->AdminModel->fnupdatepckginfo_dtls();
}


public function fninsertjobinfo()
 {
 	$this->AdminModel->fninsertjobinfo_dtls();
 }

 public function fninsertjobinfonote()
 {
 	$this->AdminModel->fninsertjobinfonote_dtls();
 }

 public function fninsertjobtypdtls()
 {
 	$this->AdminModel->fninsertjobtypdtls_dtls();
 }

 public function new_administration_terms()
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
		$this->load->view('fi/new_administration_terms',$data);
		$this->load->view('fi/footer');
	}


public function delselconracttype()
{
	$result=$this->AdminModel->delselconracttype_dtls();
}


  public function admin_addnewterms()
	{
		if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$pckname=$this->input->post('item_package_name');
		$chkpackgeres=$this->AdminModel->isChkExistContract($pckname);

	 if($chkpackgeres=="Not Exists")
	   {

		for ($i=0; $i < count($this->input->post('i_name')) ; $i++)
		 {
			$item1['subcat_id']= $this->input->post('item_package_name');
	        $item1['name']	=	$this->input->post('i_name')[$i];
			$item1['amount']	=	$this->input->post('itmdesc')[$i];
			$result1 = $this->AdminModel->insertterms($item1);
	    }

		// print_r($item1); die;
		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');

		if ($result1){
		$this->session->set_flashdata('success',"Contract Type & Terms added successfully..!!");
		redirect('fi_home/administration_terms');
		}
		else{
			$this->session->set_flashdata('error',"Contract Type & Terms not created..!!");
		redirect('fi_home/new_administration_terms');
	  }

	 }else if($chkpackgeres=="IsExists"){

	 	$this->session->set_flashdata('error',"This Contract Type Already Exists..!!");
	 	redirect('fi_home/new_administration_terms');
	 }
  }

  public function fncntrcttrms()
	{
		$result=$this->AdminModel->fncntrcttrms_dtls();
	}

  public function crnewpterms()
	{
	   $result=$this->AdminModel->crnewpterms_dtls();
    }

  public function delnewpterms()
	{
		$result=$this->AdminModel->delnewpterms_dtls();
	}

 public function fnupdtrmsinfo()
  {
  	 $this->AdminModel->fnupdtrmsinfo_dtls();
  }

 public function fnupdateinvtermsinfo()
 {
 	$this->AdminModel->fnupdateinvtermsinfo_dtls();
 }


public function geteventinfojson()
 {
 	$this->AdminModel->geteventinfojson_dtls();
 }

public function viewpostdate()
 {

 	if(!isset($this->session->fi_session)){
			redirect('/','refresh');
		}

		$data['alert']    = $this->session->flashdata('alert');
		$data['error']    = $this->session->flashdata('error');
		$data['success']  = $this->session->flashdata('success');

		$this->load->view('fi/header');
		$this->load->view('fi/sidebar');
		$this->load->view('fi/datetest',$data);
		$this->load->view('fi/footer');

 }

 public function chkpostdata()
 {
 	$this->AdminModel->chkpostdata_dtls();
 }

}
