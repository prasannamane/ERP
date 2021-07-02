<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

defined('BASEPATH') OR exit('No direct script access allowed');

class Suchi_email_reader extends CI_Controller {


    function __construct() {
      
        $this->load->model('AdminModel');
        
    }
public function index(){
    echo 1; exit;
}

}