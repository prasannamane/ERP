<?php
class HodModel extends CI_Model {
	
	function __construct(){
		parent::__construct();
        //initialise the autoload things for this class
	}
	function getrequest()
	{
		$query = $this->db->order_by("is_approved_hod", "asc")->get('tbl_request'); 

		//$query = $this->db->get('tbl_request');
		$allData = $query->result_array();


		for ($i=0; $i <$query->num_rows(); $i++) { 
			$allData[$i]['name'] = $this->getfiname($allData[$i]['fi_id']);
		}

		return $allData;

	}
	function getfiname($id)
	{
		return $this->db->where('id',$id)->get('users')->result_array()[0]['name'];
	}
	function getrejectbyhod($id)
	{	
		$update['is_approved_hod'] = 2;
		$update['hod_approve_at']=date();
		return $this->db->where('id',$id)->update('tbl_request',$update);  
	}
	function getapprovebyhod($id)
	{	
		$update['is_approved_hod'] = 1;
		$update['hod_approve_at']=date('Y-m-d h:i:s');
		return $this->db->where('id',$id)->update('tbl_request',$update);  
	}
	function getfile()
	{
		return $this->db->get('file')->result_array();
	}
	function fileapprove($id){
		$update['fileapprovebyhod']=1;
		return $this->db->where('file_id',$id)->update('file',$update);	
	}
	function filereject($id){
		$update['fileapprovebyhod']=2;
		return $this->db->where('file_id',$id)->update('file',$update);	
	}
}
?>