<?php
    //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
    error_reporting(0); 

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Banking extends CI_Controller 
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('AdminModel');
            $this->load->model('DashboardModel');
            $this->load->model('Attachment_Model');
            $this->load->model('TaskModel');
            $this->load->model('HomeModel');            
        }  
    }