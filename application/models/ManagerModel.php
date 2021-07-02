<?php
class ManagerModel extends CI_Model {
	
	function __construct(){
		parent::__construct();
        //initialise the autoload things for this class
	}
	function getrequestmgr()
	{
		//$query = $this->db->order_by("is_approved_mr", "asc")->get('tbl_request'); 
		$query=$this->db->where('is_approved_hod',1)->get('tbl_request');
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
	function getrejectbymanager($id)
	{	
		$update['is_approved_mr'] = 2;
		//$update['is_approved_hod'] = 2;
		return $this->db->where('id',$id)->update('tbl_request',$update);  
	}
	function getapprovebymanager($id)
	{	
		$update['is_approved_mr'] = 1;
		$update['mr_approved_at']=date('Y-m-d h:i:s');

		return $this->db->where('id',$id)->update('tbl_request',$update);  
	}
	function addcriticalstatus($id){
		$update['is_critical']=1;
		return $this->db->where('id',$id)->update('tbl_request',$update);	
	}
	function addnormalstatus($id){
		$update['is_critical']=2;
		return $this->db->where('id',$id)->update('tbl_request',$update);	
	}
	function getapprovedfile(){
		return $this->db->where('fileapprovebyhod',1)->get('file')->result_array();

	}
	function mgrapprove($id){
		$update['fileapprovebymr']=1;
		return $this->db->where('file_id',$id)->update('file',$update);
	}
	function mgrreject($id){
		$update['fileapprovebymr']=2;
		return $this->db->where('file_id',$id)->update('file',$update);
	}
}
?>