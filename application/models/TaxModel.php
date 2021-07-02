<?php
class TaxModel extends CI_Model {

	function __construct(){
		parent::__construct();
        //initialise the autoload things for this class
	}

    public function insert_with_id($tbl_nm, $arr)
    {
        $res = $this->db->insert($tbl_nm, $arr);
        return $res;
    }
    
    public function select_data($tbl_nm, $select, $arr, $order)
    {
        if(!empty($arr) && !empty($order))
        {
            $res = $this->db->select($select)
                            ->from($tbl_nm)
                            ->where($arr)
                            ->order_by($order)
                            ->get();
        }
        else if(!empty($arr) && empty($order))
        {
             $res = $this->db->select($select)
                            ->from($tbl_nm)
                            ->where($arr)
                            ->get();
        }
        else if(empty($arr) && !empty($order))
        {
             $res = $this->db->select($select)
                            ->from($tbl_nm)
                            ->order_by($order)
                            ->get();
        }
        
        return $res->result_array();
    }
    
    public function delete($tbl_nm, $arr)
    {
        $res = $this->db->delete($tbl_nm, $arr);
        return $res;
    }





}
