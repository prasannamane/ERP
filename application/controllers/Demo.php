<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Demo extends CI_Controller {

    	function __construct(){
    		parent::__construct();
    		//initialise the autoload things for this class
        	$this->load->model('BankingModel');
    	   }

         public function scandemo() {

             if(!isset($this->session->fi_session)){
                 redirect('/','refresh');
             }
             // $this->load->view('fi/header');
             // $this->load->view('fi/sidebar');
             $this->load->view('fi/demo';
             // $this->load->view('fi/footer');
            }



         ?>
