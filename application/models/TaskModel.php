<?php
    
class TaskModel extends CI_Model {

    function __construct(){
        
        parent::__construct();
        //initialise the autoload things for this class
        }
    

    public function view_todo($id) {


        if($id){
            $this->db->where('cus_id',$id);
        }
        
        $sessionData = $this->session->userdata('fi_session');
        $condition = "";

        if($this->session->userdata('admin_role_id') > 1) {


            $condition = "users_id = ".$sessionData['id'];
            $this->db->where($condition);
        }

        $this->db->order_by('id','desc');
        $query = $this->db->get('customer_appointment')->result_array();
        //print_r($this->db->last_query());
        return $query;    
        }
}