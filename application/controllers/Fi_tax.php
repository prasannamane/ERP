<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fi_tax extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		//initialise the autoload things for this class
    	$this->load->model('TaxModel');
	}


    public function administration_tax()
    {
        if(!isset($this->session->fi_session))
        {
            redirect('/','refresh');
        }
        
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_tax',$data);
        $this->load->view('fi/footer');
    }
    

    
    public function delete_tax()
    {
        $tid = $this->input->post('tid');
        
        $tbl_nm = "tbl_tax_rate";
        $arr = array(
            "tid" => $tid
        );
        
        $res = $this->TaxModel->delete($tbl_nm, $arr);
        if($res)
        {
            echo "success";
        }
        else
        {
            echo "fail";
        }
    }
    
    
    
    
}