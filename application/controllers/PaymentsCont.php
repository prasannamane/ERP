<?php

    // ini_set('display_error', 'On');
    // error_reporting(E_ALL);

    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class PaymentsCont extends CI_Controller 
    {
        function __construct() 
        {
            parent::__construct();
            //initialise the autoload things for this class
            $this->load->model('AdminModel');
            $this->load->model('Payment_Model');
		}

		public function fnappyinvoiceSec()
        {
            $this->Payment_Model->fnappyinvoiceSec_dtls();
        }
		
		public function fnGetcreditamtInfo()
		{
			$custId = $this->input->post('custId');
			$this->session->set_userdata('id', $custId);
		 	$this->Payment_Model->fnGetcreditamtInfo_dtls();
		}

        public function fnloadpaymentdata()  
        {
            $this->Payment_Model->fnloadpaymentdata_dtls();
        }

        public function getCustomerInfoSec()
        {   
            $this->Payment_Model->getCustomerSec_dtls();
        }

        public function checkduebal()
        {

            $client_id = $this->input->post('client_id');
            $coloumn = "invoice_balance_due";
            $cond = array('cust_id' => $client_id);
            $tbl = "invoices_create";
            $result = $this->Payment_Model->get_sum_dtls($coloumn, $cond, $tbl);   
        }

        public function fnremoveinvoiceSec()
        {
            $this->Payment_Model->fnremoveinvoiceSec_dtls();
        }

        public function fnnewpaymnt() 
        {
            $this->Payment_Model->fnnewpaymnt_dtls(); 
        }

        public function fnappliedinvoiceSec()
        {
            //$this->Payment_Model->fnappliedinvoiceSec_dtls();         
            $id = $_POST['invpayment_id'];       
            
            $this->Payment_Model->getpaidinvoicesSec_dtls($id);
        }

        public function getpaidinvoicesInfoSec() 
        {
            $id = $_POST['hpaymentId'];
            $this->Payment_Model->getpaidinvoicesSec_dtls($id);
        }

        



        public function getpaidinvoicesInfo() {

          $this->Payment_Model->getpaidinvoicesInfo_dtls();
          }



        public function getSearchCustContactInfo() { 

            $cName = $this->input->post('name');
            $this->session->set_userdata('id',$cName);
            $this->Payment_Model->allSearchCustInfo($cName);
            }





        public function c_payment() {

            if(!isset($this->session->fi_session)) {
                redirect('/','refresh');
            }

                 if($cus_id == ''){
                 $cus_id = $this->session->userdata('id');
            }
            //print_r($cus_id);

            if (empty($cus_id) || $cus_id =="" || $cus_id == 'null' ) {
                $cus_id = 0;
            }
            $data['cus_id']      = $cus_id;

            $data['alert']      = $this->session->flashdata('alert');
            $data['error']      = $this->session->flashdata('error');
            $data['success']    = $this->session->flashdata('success');
            $data['usr']        = $this->AdminModel->search_data();
            $data['single_cust']= $this->AdminModel->search_data()[0];

            $maxid = 0;
            $row = $this->db->query('SELECT MAX(cus_id) AS `max_id` FROM `register_customer`')->row();
            if ($row) {
                $maxid = $row->max_id;
            }
            $cust_inv1 = $this->db->query("SELECT `invoice_name`, `invoice_date`, `invoice_due_date`, `invoice_type`, `invoice_contract_type`, `invoice_discount`, `invoice_sub_total`, `invoice_tax`, `invoice_amount`, `invoice_paid`, `invoice_balance_due`, `invoice_tax_rate` FROM invoices_create WHERE `cust_id` = '$maxid'");

            $data['usrInvoices'] = $cust_inv1->result_array();

            $this->session->unset_userdata('event_page', '');
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/customer/c_payment',$data);
            $this->load->view('fi/footer');
        }

        public function index() {

            if(!isset($this->session->fi_session)){
      			redirect('/','refresh');
      		}

      		$data['alert']     = $this->session->flashdata('alert');
      		$data['error']     = $this->session->flashdata('error');
      		$data['success']   = $this->session->flashdata('success');
      		$data['dash']  = $this->db->where('dash_status',1)->get('dashboard')->result_array();

      		$this->load->view('fi/header');
      		$this->load->view('fi/sidebar');
      		$this->load->view('fi/dash',$data);
      		$this->load->view('fi/footer');
            }

  public function cust_search()
   {
    	if(!isset($this->session->fi_session)){
    		redirect('/','refresh');
    	}

    	$data['alert']    = $this->session->flashdata('alert');
    	$data['error']    = $this->session->flashdata('error');
    	$data['success']  = $this->session->flashdata('success');
    	$data['customer'] = array();

    	$this->load->view('fi/header');
    	$this->load->view('fi/sidebar');
    	$this->load->view('fi/cust_search',$data);
    	$this->load->view('fi/footer');

   }

  public function pay_invoices()
   	{

  		if(!isset($this->session->fi_session)){

  			redirect('/','refresh');

  		}
  		$data['alert']    = $this->session->flashdata('alert');
  		$data['error']    = $this->session->flashdata('error');
  		$data['success']  = $this->session->flashdata('success');
  		$data['count'] 	  = $this->db->select('count(*) as count')->get('invoices_create')->result_array();
  		// print_r($data);die;
  		$data12 = $this->db->query("SELECT * from admin_package");
  		$data['all_packs'] = $data12->result_array();
      $data['custom'] = $this->AdminModel->search_data();
  		$this->load->view('fi/header');
  		$this->load->view('fi/sidebar');
  		$this->load->view('fi/payment_invoices',$data);
  		$this->load->view('fi/footer');
  	}



  public function getCustomerInfo()
		{
      $this->Payment_Model->getCustomerInfo_dtls();
		}

  public function getCustomeraddress()
		{
      // $this->Payment_Model->getCustomeraddress_dtls();

			$cName = $this->input->post('name');
      $cust_inv = $this->db->query("SELECT `cus_address1` FROM register_customer WHERE `cus_id` = '$cName'")->result_array()[0];
			if ($cust_inv !="") {
				// print_r ($cust_inv);
				echo $cust_inv['cus_address1'];
			}
			else {
				echo "0";
			}
		}
  public function getCustomerlname()
		{
      // $this->Payment_Model->getCustomeraddress_dtls();

			$cName = $this->input->post('name');
      $cust_inv = $this->db->query("SELECT `cus_lname` FROM register_customer WHERE `cus_id` = '$cName'")->result_array()[0];
			if ($cust_inv !="") {
				// print_r ($cust_inv);
				echo $cust_inv['cus_lname'];
			}
			else {
				echo "0";
			}
		}
  public function getcreaditamt()
		{
      // $this->Payment_Model->getCustomeraddress_dtls();

			$cus_id = $this->input->post('pckId');
      $cust_inv = $this->db->query("SELECT SUM(credit) as cr_amt FROM `customer_payment_history` WHERE cust_id = '$cus_id'")->result_array()[0];
			if ($cust_inv !="") {
				// print_r ($cust_inv);
				echo $cust_inv['cr_amt'];
			}
			else {
				echo "0";
			}
		}

  public function fnappyinvoice()
    {
      $this->Payment_Model->fnappyinvoice_dtls();
    }


  public function fnremoveinvoice()
    {
      $this->Payment_Model->fnremoveinvoice_dtls();
    }


  public function fnappliedinvoice()
    {
      $this->Payment_Model->fnappliedinvoice_dtls();
    }


  public function fnremoveallinvoces()
    {
      $this->Payment_Model->fnremoveallinvoces_dtls();
    }

  public function fncloseallinvoces()
    {
      $this->Payment_Model->fncloseallinvoces_dtls();
    }




public function updatepaymentdata()
  {
    
		$id=$this->input->post('hdnpayId');
		$payno=$this->input->post('payno');
		$updtinvpaystsarr=array(

     "id" => $id,
     "chk_num" =>$payno,

    );
    $this->db->where('id',$id);
    if($this->db->update('customer_payment_history',$updtinvpaystsarr))
    {
			echo "1";

		}
		else {
			echo "0";
		}
  }
public function updatepaymentdataentry()
  {
    // $this->Payment_Model->fnloadpaymentdata_dtls();
		$id=$this->input->post('hdnpayId');
		$payno=$this->input->post('payno');
		$updtinvpaystsarr=array(

     "id" => $id,
     "pdesc" =>$payno,

    );
    $this->db->where('id',$id);
    if($this->db->update('customer_payment_history',$updtinvpaystsarr))
    {
			echo "1";

		}
		else {
			echo "0";
		}
  }

  public function updatepaymentdatanote()
    {
     
  		$id=$this->input->post('hdnpayId');
  		$note=$this->input->post('note');
  		$updtinvpaystsarr=array(

       "id" => $id,
       "notes" =>$note,

      );
      $this->db->where('id',$id);
      if($this->db->update('customer_payment_history',$updtinvpaystsarr))
      {
  			echo "1";

  		}
  		else {
  			echo "0";
  		}
    }

public function fndeletepaymnt()
{
   $this->Payment_Model->fndeletepaymnt_dtls();
}



public function fineshpayment()
{
    $this->Payment_Model->fineshpayment();
}
public function removepayment()
{
    $this->Payment_Model->removepayment();
}
public function removepaymentSec()
{
    $this->Payment_Model->removepaymentSec();
}
public function autopayment()
{
	$cus_id = $this->input->post('cus_id');
	$custpayamt = $this->input->post('custpayamt');
	$finesh_id = $this->input->post('hpaymentId');
	$payment_type = $this->input->post('payment_type');
	$paymentno = $this->input->post('paymentno');

	 $cust_inv = $this->db->query("SELECT  `cust_id`,`invoice_id`,`invoice_name`, `invoice_date`, `invoice_due_date`, `invoice_type`, `invoice_contract_type`, `invoice_discount`, `invoice_sub_total`, `invoice_tax`, `invoice_amount`, `invoice_paid`, `invoice_balance_due`, `invoice_tax_rate`
		 FROM invoices_create WHERE `cust_id` = '$cus_id' AND invoice_status=0 AND invoice_balance_due > 0")->result_array();
    $actual_amt_pay = 0;
		$credit_remaning=$custpayamt;
	 // echo "<pre>";print_r($cust_inv);die; customer_payment_history
	 foreach ($cust_inv as $cust_invey) {
	 $invoice_id=	$cust_invey['invoice_id'];
	 $invoice_balance_due=	$cust_invey['invoice_balance_due'];
	 $invoice_paid=	$cust_invey['invoice_paid'];
	 if ($custpayamt !=0 || $custpayamt !="") {
	 	// code...

	 if ($invoice_balance_due > $custpayamt) {
		 // echo "<pre>";print_r("if");die;

     $actual_amt_pay = $actual_amt_pay + $custpayamt;
		 // $credit_remaning= $credit_remaning-$actual_amt_pay;
		 $updtinvpaystsarr=array(

 		 "invoice_status" => "0",
 		 "invoice_paid" =>$invoice_paid+$custpayamt,
 		 "invoice_balance_due" =>$invoice_balance_due-$custpayamt
 		);
		// echo "<pre>";print_r($updtinvpaystsarr);die;
 		$this->db->where('invoice_id',$invoice_id);
 		if($this->db->update('invoices_create',$updtinvpaystsarr))
 		{
			// echo "<pre>";print_r("updated");die;
			$getinvsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$invoice_id."'");
			$getinvsqlrow= $getinvsql->row();

			$insrtpaymntarr=array(

				"payment_id" => $_POST['hpaymentId'],
				"invoice_id" => $invoice_id,
				"cust_id" => $cust_invey['cust_id'],
				"invoice_name" => $getinvsqlrow->invoice_name,
				"invoice_date" => $getinvsqlrow->invoice_date,
				"invoice_due_date" => $getinvsqlrow->invoice_due_date,
				"invoice_type" => $getinvsqlrow->invoice_type,
				"invoice_contract_type" => $getinvsqlrow->invoice_contract_type,
				"invoice_discount" => $getinvsqlrow->invoice_discount,
				"invoice_sub_total" => $getinvsqlrow->invoice_sub_total,
				"invoice_tax" => $getinvsqlrow->invoice_tax,
				"invoice_amount" => $getinvsqlrow->invoice_amount,
				"invoice_paid" => $getinvsqlrow->invoice_paid,
				"invoice_balance_due" => $getinvsqlrow->invoice_balance_due,
				"invoice_tax_rate" => $getinvsqlrow->invoice_tax_rate,
				"invoice_county" => $getinvsqlrow->invoice_county,
				"invoice_user" => $getinvsqlrow->invoice_user,
				"invoice_status" => $getinvsqlrow->invoice_status,
				"assigned_pckage" => $getinvsqlrow->assigned_pckage,
				"created_date" => $getinvsqlrow->created_date,
				"due_bal_status" => $getinvsqlrow->due_bal_status,
				"discounted_amt" => $getinvsqlrow->discounted_amt,
				"applied_amt" => $custpayamt,
				"payment_type" => $payment_type,
				"payment_no" => $paymentno,
				"status" => 1
			);
		 if($this->db->insert('invoices_payment_create',$insrtpaymntarr))
		 {
			 $custpayamt=$custpayamt-$invoice_balance_due;
			// echo "success";
			break;
		 }

		}
	}else {
		// echo "<pre>";print_r("else");die;
		$actual_amt_pay = $actual_amt_pay + $invoice_balance_due;
		 // $credit_remaning= $credit_remaning-$actual_amt_pay;

		$updtinvpaystsarr=array(

		 "invoice_status" => "0",
		 "invoice_paid" =>$invoice_paid+$invoice_balance_due,
		 "invoice_balance_due" =>$invoice_balance_due-$invoice_balance_due
		);
		$this->db->where('invoice_id',$invoice_id);
		if($this->db->update('invoices_create',$updtinvpaystsarr))
		{
		$getinvsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$invoice_id."'");
		$getinvsqlrow= $getinvsql->row();

		$insrtpaymntarr=array(

			"payment_id" => $_POST['hpaymentId'],
			"invoice_id" => $invoice_id,
			"cust_id" => $cust_invey['cust_id'],
			"invoice_name" => $getinvsqlrow->invoice_name,
			"invoice_date" => $getinvsqlrow->invoice_date,
			"invoice_due_date" => $getinvsqlrow->invoice_due_date,
			"invoice_type" => $getinvsqlrow->invoice_type,
			"invoice_contract_type" => $getinvsqlrow->invoice_contract_type,
			"invoice_discount" => $getinvsqlrow->invoice_discount,
			"invoice_sub_total" => $getinvsqlrow->invoice_sub_total,
			"invoice_tax" => $getinvsqlrow->invoice_tax,
			"invoice_amount" => $getinvsqlrow->invoice_amount,
			"invoice_paid" => $getinvsqlrow->invoice_paid,
			"invoice_balance_due" => $getinvsqlrow->invoice_balance_due,
			"invoice_tax_rate" => $getinvsqlrow->invoice_tax_rate,
			"invoice_county" => $getinvsqlrow->invoice_county,
			"invoice_user" => $getinvsqlrow->invoice_user,
			"invoice_status" => $getinvsqlrow->invoice_status,
			"assigned_pckage" => $getinvsqlrow->assigned_pckage,
			"created_date" => $getinvsqlrow->created_date,
			"due_bal_status" => $getinvsqlrow->due_bal_status,
			"discounted_amt" => $getinvsqlrow->discounted_amt,
			"applied_amt" => $invoice_balance_due,
			"status" => 1
		);
	 $this->db->insert('invoices_payment_create',$insrtpaymntarr);

	$custpayamt=$custpayamt-$invoice_balance_due;

	// $query1="UPDATE customer_payment_history SET amount= $custpayamt,credit=$credit_remaning WHERE id IN ($finesh_id)";
	// $this->db->query($query1);
	}
	}
}
// $custpayamt=$invoice_balance_due-$custpayamt;
	 }
	 if($credit_remaning > $actual_amt_pay){
		 $credit_remaning= $credit_remaning-$actual_amt_pay;
	 }
	 else {
	 	$credit_remaning = 0;
	 }

	 $query1="UPDATE customer_payment_history SET amount= $actual_amt_pay,credit=$credit_remaning,status=1 WHERE id IN ($finesh_id)";
	 if($this->db->query($query1))
	 {
			echo "success";exit;
		}
		else {
		 echo "error";
		}
}


}
