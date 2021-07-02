<?php
class DirectorModel extends CI_Model {
	
	function __construct(){
		parent::__construct();
        //initialise the autoload things for this class
	}
	function getrequesttodir()
	{

		return $this->db->where('is_approved_mr',1)->get('tbl_request')->result_array();  

	}
	function getrejectbyDir($id)
	{	
		$update['hod_remark'] = 0;
		$update['manager_remark'] = 0;
		$update['director_remark'] = 0;
		return $this->db->where('change_req_id',$id)->update('change_request',$update);  
	}
	function getapprovebyDir($id)
	{	
		$update['hod_remark'] = 1;
		$update['manager_remark'] = 1;
		$update['director_remark'] = 1;
		return $this->db->where('change_req_id',$id)->update('change_request',$update);  
	}
}
?>