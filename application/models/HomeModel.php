<?php  
 
    class HomeModel extends CI_Model  
 	{
        /* public function cust()
        {

            //SELECT `cus_id`, `user`, `cus_title`, `cus_fname`, `cus_lname`, `cus_company_name`, `cus_address1`, `cus_address2`, `cus_city`, `cus_state`, 
            //`cus_zip`, `cus_tax_status`, `cus_tax_id`, `cus_status`, `cus_acc_no`, `custom1`, `custom2`, `cus_register_date` FROM `register_customer` WHERE 1

            //SELECT `id`, `cus_id`, `con_type`, `name`, `address`, `city`, `state`, `zip`, `home`, `cel`, `work`, `email`, `event_name`, `type`, 
            //`created_at`, `updated_at` FROM `customer_additional_contacts` WHERE 1

            $this->db->select('*');
            $this->db->from('register_customer as r');
            $this->db->join('customer_additional_contacts as c', 'c.cus_id = r.cus_id');
            $query = $this->db->get();
        } */

        public function get_all_TwoTbl_by_cond($tblA, $tblB, $cond, $idA, $idB)
        {
            $query = $this->db->select('a.*, b.event_name, b.event_id')
            ->from($tblA.' as a')
            ->join($tblB.' as b', 'a.'.$idA.' = b.'.$idB.'', 'left')
            ->where_in($cond)
            ->get();
            return $query->result_array(); 
        }

        public function get_all_ThreeTbl_by_cond($tblA, $tblB, $tblC, $cond, $idA, $idB, $idBB, $idC)
        {
            $query = $this->db->select('a.*, b.*, c.*')
            ->from($tblA.' as a')
            ->join($tblB.' as b', 'a.'.$idA.' = b.'.$idB.'', 'left')
            ->join($tblC.' as c', 'c.'.$idC.' = b.'.$idBB.'', 'left')
            ->where_in($cond)
            ->get();
            return $query->result_array(); 
        }

       

        public function insertdata($tbl, $data)
        {
            return $this->db->insert($tbl, $data);
        }

        public function get_all_by_cond_desc($tbl, $cond, $orderid) 
        {
            $this->db->select('*');
 			$this->db->from($tbl);
            $this->db->where($cond);
            $this->db->order_by($orderid, "desc");
      		$query = $this->db->get();
            return $query->result_array(); 
      	}

        public function get_all_by_cond($tbl, $cond) 
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($cond);
            $query = $this->db->get();
            //print_r($this->db->last_query());
            return $query->result_array(); 
        } 


        public function get_all_withlimit($tbl, $ltd, $ofs) 
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->limit($ltd, $ofs);
            $query = $this->db->get();
            return $query->result_array(); 
        }

      	public function get_all($tbl) 
        {
            $this->db->select('*');
 			$this->db->from($tbl);
            $query = $this->db->get();
      		return $query->result_array(); 
      	} 

      	public function cus_invoice_balance_due($tbl, $cond) {

      		  $this->db->select('SUM(invoice_balance_due) as total');
      		  $this->db->where($cond);
      		  $query = $this->db->get($tbl);
      		  return $query->result_array();

      	}

        public function update_data($tbl, $cond, $array_data)
        {
            $this->db->where($cond);
            return $this->db->update($tbl, $array_data);
        }

        public function delete_data($tbl, $cond)
        {
            $this->db->where($cond);
            return $this->db->delete($tbl);
        }





        
 	} 

