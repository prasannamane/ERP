<?php

    error_reporting(0); //E_ALL
    ini_set('display_error', '0');
    //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
/*
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Fi_email extends CI_Controller {
        function __construct(){
            parent::__construct();
            //initialise the autoload things for this class
            $this->load->model('AdminModel');
            $this->load->model('TaskModel');
            
            }

        public function index(){
            echo "1"; exit;
        }

    }
?>