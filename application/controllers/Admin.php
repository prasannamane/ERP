<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();
        //initialise the autoload things for this class
    }

	function index()
	{
        //check for the session if not set properly then redirect to login page
        if(!isset($this->session->admin_session)){
            redirect('/','refresh');
        }

        //all below three are for alerting success,error and system alert on page,
        //dont change here, try setting same using
        //$this->session->set_flashdata('alert',"Error Occured");
	    $data['alert'] = $this->session->flashdata('alert');
        $data['error'] = $this->session->flashdata('error');
        $data['success'] = $this->session->flashdata('success');


        $header['title'] = "Admin Dash";

        //loads admin home page located in views/admin and passes header,data variable
        $this->load->view('admin/header',$header);
        $this->load->view('admin/dash',$data);
        $this->load->view('admin/footer');
	}


    // Logout from admin page
    public function logout()
    {
        //check for the session if not set properly then redirect to login page
        if(!isset($this->session->admin_session)){
            redirect('/','refresh');
        }

        $session_array = array(
            'email' => '',
            'name' => ''
        );

        $this->session->set_flashdata('success',"Logout Successfully..!!");

        $this->session->unset_userdata('admin_session', $session_array);
        redirect('/');

    }
    
}
?>
 