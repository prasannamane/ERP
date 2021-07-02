<?php
class Si_Model extends CI_Model {

	function __construct(){
		parent::__construct();
        //initialise the autoload things for this class
	}

	// Insert Change Request by Flour Manager
	public function insertRequest($data){
		return $this->db->insert('tbl_request',$data);
	}
	public function insertfile($data)
	{
	return $this->db->insert('file',$data);
	}
	public function insertdriver($data1)
	{
	return $this->db->insert('driver_registration',$data1);
	}
	public function update_dash($id)
	{
	return $this->db->set('dash_status',2)->where('dash_id',$id)->update('dashboard');
	// return $query  sdgsd;dsgsdgsfa
	}
	public function dismissall_dash()
	{
	return $this->db->set('dash_status',2)->update('dashboard');
	// return $query;
	}
	public function snooze_dash($id)
	{
	$currentdate = date('Y-m-d H:i:s');
	// print_r($currentdate);echo "<br>";
	$addtime = strtotime("+15 minutes", strtotime($currentdate));
//gsdnj
	$add= date('Y-m-d H:i:s', $addtime);
	return $this->db->set('dash_snooze',1)->set('dash_snooze_time',$add)->where('dash_id',$id)->update('dashboard');
	}
	public function dismissall_snooze()
	{
	$currentdate = date('Y-m-d H:i:s');
	$addtime = strtotime("+15 minutes", strtotime($currentdate));
	$add= date('Y-m-d H:i:s', $addtime);
	return $this->db->set('dash_snooze',1)->set('dash_snooze_time',$add)->update('dashboard');
	}
	public function addcoustomer($item)
	{
		$query = $this->db->insert('register_customer',$item);
		return $this->db->insert_id();
	}
	public function up_addcoustomer($item,$up_id)
	{
		$id = $up_id;
		$this->db->where('cus_id', $id);
		$this->db->update('register_customer', $item);
		return true;
	}
	public function search_data()
	{
		$query = $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,user_contact_info.contact_no,user_contact_info.user_contact_note')
						 ->from('register_customer')
						 ->join("user_contact_info", "register_customer.cus_id=user_contact_info.cus_id")
						 ->where(array("user_contact_info.default_contact"=> 1))
						 ->order_by("register_customer.cus_id DESC")
						 ->get();

		return $query->result_array();
	}
	public function insertsubcatvalue($data)
	{
		$query = $this->db->insert('sub_categories',$data);
		return $this->db->insert_id();
	}
	public function insertDropCategories($data)
	{
		$query = $this->db->insert('categories',$data);
		return $this->db->insert_id();
	}

	public function insertPackage($item)
	{
		$query = $this->db->insert('admin_contract_type',$item);
		return $this->db->insert_id();
	}
	public function insertPackagesub($item)
	{
		$query = $this->db->insert('admin_contract_terms',$item);
		return $this->db->insert_id();
	}

	public function addvendor($data)
	{
		$query = $this->db->insert('register_vendor',$data);
		return $this->db->insert_id();
	}
	public function insertaddlocation($item)
	{
		$query = $this->db->insert('add_location_event',$item);
		return $this->db->insert_id();
	}
	public function insertnewinvoice($data)
	{
		$query = $this->db->insert('invoices_create',$data);
		return $this->db->insert_id();
	}
	public function insertinvoiceitem($item)
	{
		return $this->db->insert('invoice_item',$item);
	}
	public function insertadditemadmin($item)
	{
		return $this->db->insert('admin_item',$item);
	}
	public function insertinvoicetask($task)
	{
		return $this->db->insert('invoice_task',$task);
	}
	public function insertinvoicepayment($pay)
	{
		return $this->db->insert('invoice_payment',$pay);
	}
	public function insertpickup_info($pickup)
	{
		return $this->db->insert('invoices_pickup_info',$pickup);
	}
	public function insertpickup_req($pickup_req)
	{
		return $this->db->insert('invoice_pickup_required',$pickup_req);
	}
	public function insertinvoice_note($note)
	{
		return $this->db->insert('invoice_note',$note);
	}
	public function insertinvoice_associated($associated)
	{
		return $this->db->insert('invoice_associated_order',$associated);
	}


	public function insertevent($data)
	{
		$query = $this->db->insert('events_register',$data);
		return $this->db->insert_id();
	}
	public function insertlocation($location)
	{
		return $this->db->insert('event_location',$location);
	}
	public function insertcrew($crew)
	{
		return $this->db->insert('event_crews',$crew);
	}
	public function insertjobs($job_data)
	{
		return $this->db->insert('event_jobs',$job_data);
	}
	public function insertcrew_availability($data_a)
	{
		return $this->db->insert('crew_availability',$data_a);
	}
	public function insertassociated_order($associated)
	{
		return $this->db->insert('event_associated_order',$associated);
	}
	public function insertaffiliated_vendor($affiliated)
	{
		return $this->db->insert('event_affiliated_vendor',$affiliated);
	}
	public function addcontactdata($contact)
	{
	return $this->db->insert('user_contact_info',$contact);
	}
	public function del_addcontactdata($up_id)
	{
		$cusid = $up_id;
		$this->db->where('cus_id', $cusid);
	  $this->db->delete('user_contact_info');
	}
	public function up_addcontactdata($contact)
	{

		 return $this->db->insert('user_contact_info',$contact);

	}
	public function addshipaddress($address)
	{
	return $this->db->insert('ship_address',$address);
	}
	public function up_addshipaddress($address,$up_id)
	{
		$cusid = $up_id;
		$this->db->where('ship_user_id', $cusid);
		$this->db->update('ship_address', $address);
		return true;
	}
	public function check_event_id($id,$cdt)
	{
		$query = $this->db->select('*')
		         ->from('events_register')
		         ->where(array("cus_id"=>$id,"event_date"=>$cdt))
		         ->get();

		return $query->num_rows();
	}
	public function get_event_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('events_register')
		         ->where(array("cus_id"=>$id))
		         ->get();

		//return $query->result_array()[0];
	   return $query->result_array();
	}
	public function get_event_data_id_count($id)
	{
		$query = $this->db->select('*')
		         ->from('events_register')
		         ->where(array("cus_id"=>$id))
		         ->get();

		return $query->num_rows();
	}
	public function get_locationt_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('event_location')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}
	public function get_crews_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('event_crews')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}

	public function get_job_info_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('event_jobs')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}
	public function get_crews_avability_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('crew_availability')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}
	public function get_associated_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('event_associated_order')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}
	public function get_affiliated_vendor_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('event_affiliated_vendor')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}
	public function cust_search()
	{
		$query="SELECT c.*,o.* FROM register_customer o
		JOIN user_contact_info c ON o.cus_id=c.user_conatact_id where c.default_contact=1
		ORDER BY o.cus_register_date DESC";

		 return $this->db->query($query)->result_array();
	}

  public function search_customer($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area)
	{
		error_reporting(0);

		//$srchcustjson=array();

		 $con1="";
			if ($fname !="")
			{
			  //$con1='o.cus_fname ="'.$fname.'"';
				$con1='o.cus_fname LIKE "%'.$fname.'%"';
			}

			if ($lname !="")
			{
			if($con1!="")
			{
			  //$con1= $con1 ." OR ".'o.cus_lname = "'.$lname.'"';
				$con1= $con1 ." OR ".'o.cus_lname LIKE "%'.$lname.'%"';
			}
			else{
			  //$con1='o.cus_lname = "'.$lname.'"';
			   $con1='o.cus_lname LIKE "%'.$lname.'%"';	
			}

			}

			if ($cname !="")
			{
			if($con1!="")
			{
			  //$con1= $con1 ." OR ".'o.cus_company_name = "'.$cname.'"';
				$con1= $con1 ." OR ".'o.cus_company_name LIKE "%'.$cname.'%"';
			}
			else{
			  //$con1='o.cus_company_name = "'.$cname.'"';
				$con1='o.cus_company_name LIKE "%'.$cname.'%"';
			}

			}

			if ($zname !="")
			{
			if($con1!="")
			{
			 //$con1= $con1 ." OR ".'o.cus_zip = "'.$zname.'"';
				$con1= $con1 ." OR ".'o.cus_zip LIKE "%'.$zname.'%"';
			}
			else{
			   //$con1='o.cus_zip = "'.$zname.'"';
			    $con1='o.cus_zip LIKE "%'.$zname.'%"';
			}

			}

			if ($mname !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'c.contact_no ="'.$mname.'"';
					$con1= $con1 ." OR ".'c.contact_no LIKE "%'.$mname.'%"';
				}
				else{
					//$con1='c.contact_no ="'.$mname.'"';
					$con1='c.contact_no LIKE "%'.$mname.'%"';
				}
			}

			if ($adr1 !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_address1 ="'.$adr1.'"';
					$con1= $con1 ." OR ".'o.cus_address1 LIKE "%'.$adr1.'%"';
				}
				else{
					//$con1='o.cus_address1 ="'.$adr1.'"';
					$con1='o.cus_address1 LIKE "%'.$adr1.'%"';
				}
			}

			if ($adr2 !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_address2 ="'.$adr2.'"';
					$con1= $con1 ." OR ".'o.cus_address2 LIKE "%'.$adr2.'%"';
				}
				else{
					//$con1='o.cus_address2 ="'.$adr2.'"';
					$con1='o.cus_address2 LIKE "%'.$adr2.'%"';
				}
			}

			if ($cities !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_city ="'.$cities.'"';
					$con1= $con1 ." OR ".'o.cus_city LIKE "%'.$cities.'%"';
				}
				else{
				  	//$con1='o.cus_city ="'.$cities.'"';
				  	$con1='o.cus_city LIKE "%'.$cities.'%"';
				}
			}

			if ($states !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_state ="'.$states.'"';
					$con1= $con1 ." OR ".'o.cus_state LIKE "%'.$states.'%"';
				}
				else{
					//$con1='o.cus_state ="'.$states.'"';
					$con1='o.cus_state LIKE "%'.$states.'%"';
				}
			}

			if ($area !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';
					$con1= $con1 ." OR ".'o.cus_area LIKE "%'.$area.'%"';
				}
				else{
					//$con1='o.cus_area ="'.$area.'"';
					$con1='o.cus_area LIKE "%'.$area.'%"';
				}
			}


				

	/*	$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$id'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 }*/
		// echo "SELECT * from user_contact_info AS c,register_customer AS o WHERE ".$con1." AND c.cus_id = o.cus_id  GROUP BY o.cus_id";

		 $cust1 = $this->db->query("SELECT * from user_contact_info AS c,register_customer AS o WHERE ".$con1." AND c.cus_id = o.cus_id  GROUP BY o.cus_id");

		 if($cust1->num_rows()>0)
		 {

		  foreach ($cust1->result() as $cust1_dtls) 
		  {
		           


		$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '".$cust1_dtls->cus_id."'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 } 
		 
		?>

			<tr>

				<td><?="1"; ?></td>

				<td><?= $cust1_dtls->cus_title?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_fname?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_lname?></td>

				<td><?= $cust1_dtls->cus_company_name?></td>

				<td><?= $cust1_dtls->cus_address1?></td>
				<td><?= $cust1_dtls->cus_address2?></td>
				<td><?= $cust1_dtls->cus_city?></td>
				<td><?= $cust1_dtls->cus_state?></td>
				<td><?= $cust1_dtls->cus_zip?></td>
				<td><?= $cust1_dtls->cus_area?></td>
			    <td><?=$htmlphone?></td>
				<td><?=trim($htmlnotes,",")?></td> 
				
			</tr>


	<?php }

        }else{

        	echo "No Customers Found..!";

        }     

			
			/*echo "SELECT o.*, CONCAT(GROUP_CONCAT(c.contact_no)) contact_no,CONCAT(GROUP_CONCAT(c.user_contact_note)) user_contact_note
from register_customer o, user_contact_info c where ".$con1." AND o.cus_id = c.cus_id
group by o.cus_id";*/

			 /*$serchcustsql = $this->db->query("SELECT o.*, CONCAT(GROUP_CONCAT(c.contact_no)) contact_no,CONCAT(GROUP_CONCAT(c.user_contact_note)) user_contact_note from register_customer o, user_contact_info c where ".$con1." AND o.cus_id = c.cus_id group by o.cus_id");

			
          if($serchcustsql->num_rows()>0)
          { 
	         foreach ($serchcustsql->result() as $serchcustsql_dtls)
	          {

	              $srchcustjson['customerinfo'][]=$serchcustsql_dtls;
	          }
           
          }else{

         		  $srchcustjson['customerinfo'][]="";

          }
            echo json_encode($srchcustjson);*/

		
	}

   public function fncustsrchbyph_dtls($phone)
	{
		error_reporting(0);
          
		//$srchcustjson=array();

		//$con1='c.contact_no ="'.$phone.'"';

		$contactinfosql = $this->db->query("SELECT * from user_contact_info WHERE contact_no = '$phone'");
         
        if($contactinfosql->num_rows()>0)
        {
         
         $getcntrow=$contactinfosql->row();

         $id = $getcntrow->cus_id;
		/* $cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$this->db->select('*');
		$this->db->from('user_contact_info');
		$this->db->where('cus_id', $id);
		//$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];*/


		$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$id'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 }



  /*      $cntersql = $this->db->query("SELECT * from user_contact_info WHERE contact_no = '$phone' GROUP BY cus_id ");
		foreach ($cntersql->result() as $cntersql_dtls) 
		{

		  $cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$cntersql_dtls->cus_id'");*/

		  $cust1 = $this->db->query("SELECT * from user_contact_info AS c,register_customer AS r WHERE c.cus_id = r.cus_id AND c.contact_no = '$phone' GROUP BY c.cus_id");

		  foreach ($cust1->result() as $cust1_dtls) 
		  {
		 
		 
		?>

			<tr>

				<td><?="1"; ?></td>

				<td><?= $cust1_dtls->cus_title?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_fname?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_lname?></td>

				<td><?= $cust1_dtls->cus_company_name?></td>

				<td><?= $cust1_dtls->cus_address1?></td>
				<td><?= $cust1_dtls->cus_address2?></td>
				<td><?= $cust1_dtls->cus_city?></td>
				<td><?= $cust1_dtls->cus_state?></td>
				<td><?= $cust1_dtls->cus_zip?></td>
				<td><?= $cust1_dtls->cus_area?></td>
				<td><?=$htmlphone?></td>
				<td><?=trim($htmlnotes,",")?></td>
				
			</tr>


	<?php }

        }else{

        	echo "No Customers Found..!";

        }     
        		         
       


        //$serchcustsql = $this->db->query("SELECT o.*, CONCAT(GROUP_CONCAT(c.contact_no)) contact_no,CONCAT(GROUP_CONCAT(c.user_contact_note)) user_contact_note from register_customer o, user_contact_info c where ".$con1." AND o.cus_id = c.cus_id group by o.cus_id");

		
        /*  if($serchcustsql->num_rows()>0)
          { 
	         foreach ($serchcustsql->result() as $serchcustsql_dtls)
	          {

	              $srchcustjson['customerinfo'][]=$serchcustsql_dtls;
	          }
           
          }else{

         		  $srchcustjson['customerinfo'][]="";

          }
            echo json_encode($srchcustjson);*/
	}


	public function search_vendor($fname,$lname,$cname,$zname)
	{
		$query="SELECT * FROM register_vendor where vendor_fname ='".$fname."' OR vendor_type = '".$lname."' OR vendor_cat = '".$cname."' OR vendor_sub_cat = '".$zname."' ORDER BY vendor_created_at DESC";

		 return $this->db->query($query)->result_array();

	}

	public function insertpromocode($data)
	{
	return $this->db->insert('promocodes',$data);
	}
	function updateprofile($data)
	{
			$updatequery="UPDATE `users` SET `email`='".$data['email']."',`name`='".$data['name']."',`password`='".$data['password']."',`mobile_no`='".$data['mobile_no']."',`profile_img`='".$data['profile_img']."' WHERE id=".$data['id']."";
			// echo $updatequery;die;
      $session_data = array(                  //verified contains all the rows in user table
          'email'       => $data['email'],
          'name'        => $data['name'],
          'id'          => $data['id'],
          'mobile_no'   => $data['mobile_no'],
          'profile_img' => $data['profile_img'],
          'type'        => 1

          //you can add more fields to session from table as well as custom
          //ex- 'logged_in' = 1,
      );
      // print_r($session_data);die;
      $this->session->set_userdata('fi_session',$session_data);
			return	$this->db->query($updatequery);
	}
	function updateprofiledata($data)
	{
			$updatequery="UPDATE `users` SET `email`='".$data['email']."',`name`='".$data['name']."',`password`='".$data['password']."',`mobile_no`='".$data['mobile_no']."' WHERE id=".$data['id']."";
			// echo $updatequery;die;
      $session_data = array(                  //verified contains all the rows in user table
          'email'       => $data['email'],
          'name'        => $data['name'],
          'id'          => $data['id'],
          'mobile_no'   => $data['mobile_no'],
          'type'        => 1

          //you can add more fields to session from table as well as custom
          //ex- 'logged_in' = 1,
      );
      // print_r($session_data);die;
      $this->session->set_userdata('fi_session',$session_data);
			return	$this->db->query($updatequery);
	}

	function insertcustomer($data)
	{
	return $this->db->insert('customer',$data);
	}




	function insertCashRequest($data)
	{
		// return print_r($data);
		$query="SELECT pending_amount from balance_order WHERE cus_id=".$data['cus_id']."";
		$amount=$this->db->query($query)->result_array()[0];
		$total=$amount['pending_amount']-$data['adv_order_cost'];
		// print_r($total);die;
		$updatequery="UPDATE `balance_order` SET `pending_amount`=".$total." WHERE cus_id=".$data['cus_id']."";
		// echo $updatequery;die;
		$this->db->query($updatequery);
		return $this->db->insert('complete_order',$data);
	// return $this->db->insert('customer',$data);
	}
	function insertCraditRequest($data)
	{
		// print_r($data['cus_id']);
		// print_r($data['creadit_amount']);
		// print_r($data['jar_return']);
		if ($data['creadit_amount'] > 0 && $data['jar_return']> 0) {
			// echo "string";die;
			$query="SELECT pending_amount from balance_order WHERE cus_id=".$data['cus_id']."";
			$amount=$this->db->query($query)->result_array()[0];
			$total=$amount['pending_amount']+$data['creadit_amount'];
			// print_r($total);die;
			$updatequery="UPDATE `balance_order` SET `pending_amount`=".$total." WHERE cus_id=".$data['cus_id']."";
			// echo $updatequery;die;
			$this->db->query($updatequery);
			return $this->db->insert('complete_order',$data);
		}
		elseif ($data['creadit_amount'] > 0) {

			// echo "string2";die;
			$query="SELECT pending_amount from balance_order WHERE cus_id=".$data['cus_id']."";
			$amount=$this->db->query($query)->result_array()[0];
			$total=$amount['pending_amount']+$data['creadit_amount'];
			// print_r($total);die;
			$updatequery="UPDATE `balance_order` SET `pending_amount`=".$total." WHERE cus_id=".$data['cus_id']."";
			// echo $updatequery;die;
			$this->db->query($updatequery);
			return $this->db->insert('complete_order',$data);
		}
		else {
			$query="SELECT jar_quantity from balance_order WHERE cus_id=".$data['cus_id']."";
			$jar_quantity=$this->db->query($query)->result_array()[0];
			$total=$jar_quantity['jar_quantity']-$data['jar_return'];
			// print_r($total);die;
			$updatequery="UPDATE `balance_order` SET `jar_quantity`=".$total." WHERE cus_id=".$data['cus_id']."";
			// echo $updatequery;die;
			$this->db->query($updatequery);
			return $this->db->insert('complete_order',$data);
		}
	// return $this->db->insert('complete_order',$data);
	}
	function gethistory($id)
	{
		$query="SELECT c.cus_name,c.cus_mobile_no,o.order_quantity,o.pending_amount,o.creadit_amount,o.jar_return,b.jar_quantity as pending_jar,b.pending_amount AS cradit,o.order_cost,o.adv_order_cost,o.order_date FROM complete_order o
		JOIN customer c ON o.cus_id=c.cus_id
		JOIN balance_order b ON o.cus_id=b.cus_id
		WHERE o.cus_id=".$id."
		ORDER BY o.id DESC";

		 return $this->db->query($query)->result_array();
	}
	function getremaning_car_count($id)
	{
	    return $this->db->select('jar_quantity')->where('cus_id',$id)->get('balance_order')->result_array()[0];
	}
	function insertjar($data)
	{
		// print_r($data);die;
	return $this->db->insert('jar_quantity',$data);
	}
	function getData($id)
	{
		return $this->db->select('cus_name')->where('cus_id',$id)->get('customer')->result_array()[0];
	}

	function insertorders($data)
	{
		// print_r($data);die;
		return $this->db->insert('adv_booking',$data);
	}

	function getedit($id)
	{
		return $this->db->where('cus_id',$id)->get('customer')->result_array();
	}

	function geteditdriver($id)
	{
		return $this->db->where('driver_id',$id)->get('driver_registration')->result_array();
	}
	function getpromo($id)
	{
		return $this->db->where('promo_id',$id)->get('promocodes')->result_array();
	}







	/*----------------Wallet Report Section Start---------------------*/

	 function daywisewalletreport()
	{
		$date=date('Y-m-d');
		$newDate = date("Y-m-d", strtotime($date));
		// $resultforday=$this->db->query('SELECT *  FROM `wallet_history` WHERE `wallet_date` BETWEEN "'.$newDate.'" AND  "'.$date.' 23:59:59.000000" ORDER By wallet_id DESC')->result_array();
		$query="SELECT c.cus_name,c.cus_mobile_no,o.order_quantity,o.pending_amount,o.jar_return,b.jar_quantity as pending_jar,b.pending_amount AS cradit,o.order_cost,o.adv_order_cost,o.creadit_amount,o.order_date FROM complete_order o
		JOIN customer c ON o.cus_id=c.cus_id
		JOIN balance_order b ON o.cus_id=b.cus_id
		WHERE c.cus_is_active=1 AND o.order_date BETWEEN '".$newDate."' AND  '".$newDate."'
		ORDER BY o.id DESC";
		// echo $query;die;
		$resultforday=$this->db->query($query)->result_array();
	// print_r($resultforday);die;
		// for ($i=0; $i <count($resultforday); $i++) {
		// $resultforday[$i]['cust_name'] = $this->getname($resultforday[$i]['email']);
		// $resultforday[$i]['resone'] = $this->getreasone($resultforday[$i]['wallet_status']);
		// $resultforday[$i]['mobile_no'] = $this->getmobileno($resultforday[$i]['email']);
		// }
		return $resultforday;
	}

	function datewisewalletreport($data){
		// print_r($data);die;
		$query="SELECT c.cus_name,c.cus_mobile_no,o.order_quantity,o.pending_amount,o.jar_return,b.jar_quantity as pending_jar,b.pending_amount AS cradit,o.order_cost,o.adv_order_cost,o.creadit_amount,o.order_date FROM complete_order o
		JOIN customer c ON o.cus_id=c.cus_id
		JOIN balance_order b ON o.cus_id=b.cus_id
		WHERE c.cus_is_active=1 AND o.order_date ='".$data['from']."' ORDER BY o.id DESC";
		// echo $query;die;
		$resultforday=$this->db->query($query)->result_array();

		return $resultforday;
	}
	function getAllOrder()
	{
		$current_date=date('Y-m-d');
		$last_date=date('Y-m-d', strtotime('-4 day', strtotime($current_date)));

		$order_query="SELECT * FROM `complete_order` WHERE order_date BETWEEN '".$last_date."' AND '".$current_date."' ORDER BY order_date DESC";
		$res= $this->db->query($order_query)->result_array();

		// $res= $this->db->order_by('order_date', 'DESC')->get('complete_order')->result_array();
		for ($i=0; $i <count($res); $i++) {
		$res[$i]['cusName'] = $this->getCustNamebyID($res[$i]['cus_id']);
		}
		// print_r($res);die;
		return $res;
	}
	function getCustNamebyID($id)
	{
		return $this->db->where('cus_id',$id)->get('customer')->result_array()[0]['cus_name'];
	}
	function getdataFromID($id)
	{
		$res= $this->db->where('id',$id)->get('complete_order')->result_array();
		for ($i=0; $i <count($res); $i++) {
		$res[$i]['cusName'] = $this->getCustNamebyID($res[$i]['cus_id']);
		}
		return $res;
	}

	function getAllExpenses()
	{
		$res= $this->db->order_by('expenses_add_date_time', 'DESC')->get('expenses')->result_array();
		// for ($i=0; $i <count($res); $i++) {
		// $res[$i]['cusName'] = $this->getCustNamebyID($res[$i]['cus_id']);
		// }
		return $res;
	}
	function getAllPendingamt()
	{
		$q="SELECT b.jar_quantity,b.pending_amount,c.cus_name,c.cus_mobile_no FROM `balance_order` b JOIN customer c ON b.cus_id=c.cus_id WHERE b.pending_amount >0";
		$res= $this->db->query($q)->result_array();
		// for ($i=0; $i <count($res); $i++) {
		// $res[$i]['cusName'] = $this->getCustNamebyID($res[$i]['cus_id']);
		// }
		return $res;
	}
	function getAllDeposite()
	{
		$q="SELECT cus_name,cus_mobile_no,cus_deposite  FROM `customer` WHERE `cus_deposite` != 0";
		$res= $this->db->query($q)->result_array();
		return $res;
	}
	function getAllPendingcust()
	{
		$current_date=date('Y-m-d');
		$last_date=date('Y-m-d', strtotime('-3 day', strtotime($current_date)));

		$last_forthdate=date('Y-m-d', strtotime('-4 day', strtotime($current_date)));
		$last_month=date('Y-m-d', strtotime('-30 day', strtotime($last_forthdate)));

		$q=	"SELECT c.cus_id,c.cus_name,c.cus_mobile_no,co.order_date FROM `customer` c
	JOIN (SELECT * FROM complete_order WHERE order_date NOT BETWEEN '".$last_date."' AND '".$current_date."' ORDER BY order_date DESC, id DESC)
	AS co ON co.cus_id=c.cus_id
	WHERE c.cus_id NOT IN
	(SELECT cus_id FROM complete_order WHERE order_date BETWEEN '".$last_date."' AND '".$current_date."') AND co.order_quantity=1  GROUP BY co.cus_id";
	// echo $q;die;
		$res= $this->db->query($q)->result_array();
		// echo $q;die;

		return $res;
	}
	function getAllcusData($id)
	{
		$q="SELECT jar_quantity FROM balance_order WHERE cus_id=".$id."";

		$res= $this->db->query($q)->result_array();

		 $q2="select jar_id from jar_quantity where jar_status=2 order by rand() limit ".$res[0]['jar_quantity']."";

		$qu=$this->db->query($q2)->result_array();


		for ($i=0; $i <count($qu);$i++) {
				$updateOrderQuantity=array('jar_status'=>1);

				if($this->db->where('jar_id',$qu[$i]['jar_id'])->update('jar_quantity',$updateOrderQuantity)){
					continue;
				}

			}
		// print_r($qu);die;

		return true;
      }

    function crnewinvoice_dtls()
    {

    	$chkinvsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invoiceid']."'");
        //$isinvoicerow=$chkinvsql->row();
    	foreach($chkinvsql->result() as $chkinvsql_dtls)
    	{
    		$postinvarr=array(
    		    //"invoice_id" => $chkinvsql_dtls->invoice_id+1,
    		    "cust_id" => $_POST['customrId'],
    		    "invoice_name" => $chkinvsql_dtls->invoice_name,
    		    "invoice_date" => date('Y-m-d'),
						"invoice_status" =>0
    		    //"invoice_due_date" => date('Y-m-d'),
    		    //"invoice_type" => $chkinvsql_dtls->invoice_type,
    		    //"invoice_contract_type" => $chkinvsql_dtls->invoice_contract_type,
    		    //"invoice_discount" => $chkinvsql_dtls->invoice_discount,
    		    //"invoice_sub_total" => $chkinvsql_dtls->invoice_sub_total,
    		    //"invoice_tax" => $chkinvsql_dtls->invoice_tax,
    		    //"invoice_amount" => $chkinvsql_dtls->invoice_amount,
    		    //"invoice_paid" => $chkinvsql_dtls->invoice_paid,
    		   // "invoice_balance_due" => $chkinvsql_dtls->invoice_balance_due,
    		   // "invoice_tax_rate" => $chkinvsql_dtls->invoice_tax_rate,
    		    //"invoice_county" => $chkinvsql_dtls->invoice_county,
    		    //"invoice_user" => $chkinvsql_dtls->invoice_user

     	    );

     	    if($this->db->insert('invoices_create',$postinvarr))
     	    {
     	    	//echo "success";
                $linvid=$this->db->insert_id();

     	       echo "<input type='hidden' name='hdninvoiceId' id='hdninvoiceId' value='".$linvid."'>";
     	       echo "<input type='hidden' name='responce' id='responce' value='success'>";

     	    }else{
     	    	//echo "error";
     	    	echo "<input type='hidden' name='responce' id='responce' value='error'>";
     	    }

    	}

    }

    function delinvoice_dtls()
    {
    	$this->db->where('invoice_id',$this->input->post('invoiceid'));
    	if($this->db->delete('invoices_create'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

    function updtinvoice_dtls()
    {

    	$feildname=$this->input->post('fieldnm');

    	$updateinvarr=array(

    		 $feildname  => $this->input->post('inptxtval')
    	  );

    	$this->db->where('invoice_id',$this->input->post('invoiceid'));
    	if($this->db->update('invoices_create',$updateinvarr))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

    function fngetinvoiceinfo_dtls()
    {
    
    	error_reporting(0);

    	//echo "SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invoiceid']."'";

    	$getinvice_sql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invoiceid']."'");
    	$getrowinfo=$getinvice_sql->row();
    	$getpckId=$getrowinfo->assigned_pckage;

    	//echo "getpckId--".$getpckId;

    	if($getpckId!="")
    	{
    	   $selpackage=$getpckId;		
    	}else{
    		$selpackage="";		
    	}	

     

      /*$lastitemsql=$this->db->query("SELECT * FROM admin_package_item WHERE package_id='".$selpackage."' ORDER BY id DESC");

      $itemsql=$this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM admin_package_item AS i,admin_package AS p WHERE i.package_id=p.package_id AND i.package_id='".$selpackage."' AND p.package_id='".$selpackage."' ORDER BY id ASC");*/

      //echo "selpackage--".$selpackage;

      $itemsql=$this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM customers_package_items AS i,customer_assigned_packages AS p WHERE i.package_id=p.package_id AND i.package_id='".$selpackage."' AND p.package_id='".$selpackage."' AND p.inv_id='".$_POST['invoiceid']."' AND i.inv_id='".$_POST['invoiceid']."' ORDER BY id ASC");

     $lastitemsql=$this->db->query("SELECT * FROM customers_package_items WHERE package_id='".$selpackage."' AND inv_id='".$_POST['invoiceid']."' ORDER BY id DESC "); //LIMIT 1




      $itemsqlnrows=$itemsql->num_rows();

     // echo "itemsqlnrows--".$itemsqlnrows;

      $getitemrow=$lastitemsql->row();

      if($itemsqlnrows>0)
    	{

    	     $getitmrow=$itemsql->row();

    		 $itempckprice=$getitmrow->package_price;


    		?>

    							  	<!--  Tab: items  -->
    <div role="tabpanel" class="tab-pane active" id="items">

            <div class="box box-default">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
                <p class="uhead2">Items</p>

              </div>

              <div class="box-body">

                <div class="row">
                	<div class="col-sm-3 ">

                <div class="table-responsive">

                  <table class="table table-hover no-margin nobg">

                    <thead>

                      <tr>
                        <th>Package Name</th>
                        <th>Price</th>
                      </tr>

                      <tr class="auto-index">

                        <td>
                        	<select class="form-control" name="item_package_name" id="itemPackageName" onchange="fngetsinglepckinfo(this.value)">
                              <option value="">Select</option>
                              <?php
                              $all_packs = $this->db->query("SELECT * from admin_package");

                              foreach($all_packs->result() as $items){

                              	
                              	  if($selpackage==$items->package_id)
                              		{
                              			$selpckg="selected";
                              		}else{
                              			$selpckg="";
                              		}

                               ?>
                                 <option <?=$selpckg?> value="<?=$items->package_id?>"><?=$items->package_name?></option>
                             <?php } ?>

                              </select>

                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_price" id="pri" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$itempckprice)?>" onchange="fnupdateamount(this.value,'<?=$_POST['invoiceid']?>','<?=$selpackage?>')">

                                 <input type="hidden" name="invId" id="invId" class="form-control"style="width: 80px;" value="<?=$_POST['invoiceid']?>">
                              </div>
                          </div>
                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                	 </div>
                 </div>




                <div class="table-responsive" id="loaditms">

                  <table class="table table-hover no-margin w500">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Qty</th>

                        <th>Item</th>

                        <th>Description</th>

                        <th>Amount</th>

                        <th>Total</th>

                        <th>Taxable</th>


                        <th>Action</th>

                      </tr>
                     </thead>


    		<?php

    		$srno=1;
    	  foreach ($itemsql->result() as $pckitmsql_dtls) 
    		{
    			
    		

				    

				     $itmId=$pckitmsql_dtls->id;

		    	     if($getitemrow->id==$itmId)
	                      {
	                        $lstinvoiceid="fa-plus";
	                        $lstinvoicecls="btn-success";
	                        $fninvoce="fncrpitem('".$pckitmsql_dtls->id."')";
	                      }else{

	                        $lstinvoiceid="fa-minus";
	                        $lstinvoicecls="btn-danger";
	                        $fninvoce="fndelpitem('".$pckitmsql_dtls->id."')";
	                      }


                ?>


                     <thead id="pckitems">

                   <tr class="tr_clone auto-index"><td class="increment"><?=$srno?></td><td><input type="number" name="item_quantity<?=$itmId?>" id="i1<?=$itmId?>" min="1" class="form-control" value="<?=$pckitmsql_dtls->item_quantity?>" style="width: 40px;" disabled ></td><td>
	    		<select class="form-control" name="item_name<?=$itmId?>" id="i2<?=$itmId?>" style="width: 80px;" onchange="fnadmpckinfo(this.value,'<?=$itmId?>')">
                                <option value="">Select</option>

                             <?php

                                  $admitmsql=$this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

                                  foreach ($admitmsql->result() as $admitmsql_dtls)
                                  {
                                       if($admitmsql_dtls->item_id==$pckitmsql_dtls->item_name)
                                       {

                                          $selectitmtyp="selected";
                                       }else{

                                           $selectitmtyp="";
                                       }

                                ?>
                                <option <?=$selectitmtyp?> value="<?=$admitmsql_dtls->item_id?>"><?=$admitmsql_dtls->item_name?></option>

                              <?php }?>

	    	</td><td><input type="text" onchange="fnupdateitemdescp(this.value,'<?=$itmId?>')" name="item_desc<?=$itmId?>" id="i3<?=$itmId?>" class="form-control" value="<?=$pckitmsql_dtls->item_desc?>" style="width: 400px;" ></td><td><div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span><input type="text" onchange="fnupdateitemamountp(this.value,'<?=$itmId?>')" name="item_amount<?=$itmId?>" id="i4<?=$itmId?>" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$pckitmsql_dtls->item_price)?>" ></div></div></td><td><div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span><input type="text" disabled name="item_total<?=$itmId?>" id="i5<?=$itmId?>" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$pckitmsql_dtls->item_quantity*$pckitmsql_dtls->item_price)?>"></div></div></td><td> <input type="checkbox" disabled value="1" id="iteam_taxable<?=$itmId?>" name="iteam_taxable<?=$itmId?>"></td><td><button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> tr_clone_add"><i class="fa <?=$lstinvoiceid?>"></i></button></td><td><input type="hidden" name="pcktot" id="pcktot" value="<?=sprintf('%0.2f',$pckitmsql_dtls->package_price)?>"></td></tr> </thead>

	    	<?php $srno++; } ?>

   					  </table>

                </div>

              </div>
            </div>

             </div>

   <?php

    	}else{

    	//echo "SELECT * FROM customers_package_items WHERE package_id='' AND inv_id='".$_POST['invoiceid']."' AND cus_id='".$_POST['custnm']."' ORDER BY id DESC "."<br>";	

    	$isexistsitemsql=$this->db->query("SELECT * FROM customers_package_items WHERE package_id='' AND inv_id='".$_POST['invoiceid']."' AND cus_id='".$_POST['custnm']."' ORDER BY id ASC "); 

        
        $lstitemrow=$this->db->query("SELECT * FROM customers_package_items WHERE package_id='' AND inv_id='".$_POST['invoiceid']."' AND cus_id='".$_POST['custnm']."' ORDER BY id DESC LIMIT 1");    	

        $getitemrow=$lstitemrow->row();

    	//echo "isexistsitemsql--".$isexistsitemsql->num_rows()."<br>";

    	if($isexistsitemsql->num_rows()>0)
	    	{

	    	  $sumofitemsql=$this->db->query("SELECT SUM(item_price) AS item_price  FROM customers_package_items WHERE package_id='' AND inv_id='".$_POST['invoiceid']."' AND cus_id='".$_POST['custnm']."' ORDER BY id ASC "); 
    	      $getsumrow=$sumofitemsql->row();
    	      $invoicetot=$getsumrow->item_price;

    	       //echo "invoicetot--"+$invoicetot;

	    		$upitemtotal=array(

	    			"invoice_amount" =>$invoicetot,
	    			"invoice_balance_due" =>$invoicetot
	    		);

	    		$this->db->where('invoice_id',$_POST['invoiceid']);
	    		$this->db->where('cust_id',$_POST['custnm']);
	    		$this->db->update('invoices_create',$upitemtotal);	

	    		?>

	    								  	<!--  Tab: items  -->
    <div role="tabpanel" class="tab-pane active" id="items">

            <div class="box box-default">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
                <p class="uhead2">Items</p>

              </div>

              <div class="box-body">

                <div class="row">
                	<div class="col-sm-3 ">

                <div class="table-responsive">

                  <table class="table table-hover no-margin nobg">

                    <thead>

                      <tr>
                        <th>Package Name</th>
                        <th>Price</th>
                      </tr>

                      <tr class="auto-index">

                        <td>
                        	<select class="form-control" name="item_package_name" id="itemPackageName" onchange="fngetsinglepckinfo(this.value)">
                              <option value="">Select</option>
                              <?php
                              $all_packs = $this->db->query("SELECT * from admin_package");

                              foreach($all_packs->result() as $items){

                              	
                              	  if($selpackage==$items->package_id)
                              		{
                              			$selpckg="selected";
                              		}else{
                              			$selpckg="";
                              		}

                               ?>
                                 <option <?=$selpckg?> value="<?=$items->package_id?>"><?=$items->package_name?></option>
                             <?php } ?>

                              </select>

                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_price" id="pri" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$itempckprice)?>" onchange="fnupdateamount(this.value,'<?=$_POST['invoiceid']?>','<?=$selpackage?>')">

                                 <input type="hidden" name="invId" id="invId" class="form-control"style="width: 80px;" value="<?=$_POST['invoiceid']?>">
                              </div>
                          </div>
                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                	 </div>
                 </div>




                <div class="table-responsive" id="loaditms">

                  <table class="table table-hover no-margin w500">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Qty</th>

                        <th>Item</th>

                        <th>Description</th>

                        <th>Amount</th>

                        <th>Total</th>

                        <th>Taxable</th>


                        <th>Action</th>

                      </tr>
                     </thead>

	    		<?php
	    		//echo "display items without package";

	    	  $srno=1;
		      foreach ($isexistsitemsql->result() as $pckitmsql_dtls) 
		    		{
		    			

						     $itmId=$pckitmsql_dtls->id;

				    	     if($getitemrow->id==$itmId)
			                      {
			                        $lstinvoiceid="fa-plus";
			                        $lstinvoicecls="btn-success";
			                        $fninvoce="fncrpitem('".$pckitmsql_dtls->id."')";
			                      }else{

			                        $lstinvoiceid="fa-minus";
			                        $lstinvoicecls="btn-danger";
			                        $fninvoce="fndelpitem('".$pckitmsql_dtls->id."')";
			                      }


		                ?>


                     <thead id="pckitems">

                   <tr class="tr_clone auto-index"><td class="increment"><?=$srno?></td><td><input type="number" name="item_quantity<?=$itmId?>" id="i1<?=$itmId?>" min="1" class="form-control" value="<?=$pckitmsql_dtls->item_quantity?>" style="width: 40px;" disabled ></td><td>
	    		<select class="form-control" name="item_name<?=$itmId?>" id="i2<?=$itmId?>" style="width: 80px;" onchange="fnadmpckinfo(this.value,'<?=$itmId?>')">
                                <option value="">Select</option>

                             <?php

                                  $admitmsql=$this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

                                  foreach ($admitmsql->result() as $admitmsql_dtls)
                                  {
                                       if($admitmsql_dtls->item_id==$pckitmsql_dtls->item_name)
                                       {

                                          $selectitmtyp="selected";
                                       }else{

                                           $selectitmtyp="";
                                       }

                                ?>
                                <option <?=$selectitmtyp?> value="<?=$admitmsql_dtls->item_id?>"><?=$admitmsql_dtls->item_name?></option>

                              <?php }?>

	    	</td><td><input type="text" onchange="fnupdateitemdescp(this.value,'<?=$itmId?>')" name="item_desc<?=$itmId?>" id="i3<?=$itmId?>" class="form-control" value="<?=$pckitmsql_dtls->item_desc?>" style="width: 400px;" ></td><td><div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span><input type="text" onchange="fnupdateitemamountp(this.value,'<?=$itmId?>')" name="item_amount<?=$itmId?>" id="i4<?=$itmId?>" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$pckitmsql_dtls->item_price)?>" ></div></div></td><td><div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span><input type="text" disabled name="item_total<?=$itmId?>" id="i5<?=$itmId?>" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$pckitmsql_dtls->item_quantity*$pckitmsql_dtls->item_price)?>"></div></div></td><td> <input type="checkbox" disabled value="1" id="iteam_taxable<?=$itmId?>" name="iteam_taxable<?=$itmId?>"></td><td><button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> tr_clone_add"><i class="fa <?=$lstinvoiceid?>"></i></button></td><td><input type="hidden" name="pcktot" id="pcktot" value="<?=sprintf('%0.2f',$pckitmsql_dtls->package_price)?>"></td></tr> </thead>

	    	<?php $srno++; } ?>

	    		  </table>

                </div>

              </div>
            </div>

             </div>

	    	<?php



	    	}else{

	    		$setitemqty="";
	    		$setitemitm="";
	    		$setitemamt="";
	    		$setitemtot="";
	    		$setitempckprice="";
	    		$setitemdesc="";

    		?>
    				<!--  Tab: items  -->
         <div role="tabpanel" class="tab-pane active" id="items">

            <div class="box box-default">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
                <p class="uhead2">Items</p>

              </div>

              <div class="box-body">

                <div class="row">
                	<div class="col-sm-3 ">

                <div class="table-responsive">

                  <table class="table table-hover no-margin nobg">

                    <thead>

                      <tr>
                        <th>Package Name</th>
                        <th>Price</th>
                      </tr>

                      <tr class="auto-index">

                        <td>
                        	<select class="form-control" name="item_package_name" id="itemPackageName" onchange="fngetsinglepckinfo(this.value)">
                              <option value="">Select</option>
                              <?php
                              $all_packs = $this->db->query("SELECT * from admin_package");

                              foreach($all_packs->result() as $items){ ?>
                                 <option value="<?=$items->package_id?>"><?=$items->package_name?></option>
                             <?php } ?>

                              </select>

                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_price" id="pri" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setitempckprice)?>" onchange="fnupdateamount(this.value,'<?=$_POST['invoiceid']?>','<?=$selpackage?>')">

                                 <input type="hidden" name="invId" id="invId" class="form-control"style="width: 80px;" value="<?=$_POST['invoiceid']?>">
                              </div>
                          </div>
                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                	 </div>
                 </div>




                <div class="table-responsive" id="loaditms">

                  <table class="table table-hover no-margin w500">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Qty</th>

                        <th>Item</th>

                        <th>Description</th>

                        <th>Amount</th>

                        <th>Total</th>

                        <th>Taxable</th>


                        <th>Action</th>

                      </tr>
                     </thead>


                     <thead id="pckitems">

                      <tr class="tr_clone auto-index">

                        <td class="increment">1</td>

                        <td><input type="text" name="item_quantity" id="i1" class="form-control" value="<?=$setitemqty?>" style="width: 40px;"></td>

                        <td>
                        	<!-- <input type="text" name="item_name" id="i2" class="form-control" value="<?=$setitemitm?>" style="width: 80px;"> -->

						<select class="form-control" name="item_name" id="i2" onchange="fniteminfo(this.value)" style="width: 80px;">
                          <option value="">Select</option>
                         
                             <?php

                                  $admitmsql=$this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

                                  foreach ($admitmsql->result() as $admitmsql_dtls)
                                  {
                                       if($admitmsql_dtls->item_id==$pckitmsql_dtls->item_name)
                                       {

                                          $selectitmtyp="selected";
                                       }else{

                                           $selectitmtyp="";
                                       }

                                ?>
                                <option <?=$selectitmtyp?> value="<?=$admitmsql_dtls->item_id?>"><?=$admitmsql_dtls->item_name?></option>

                              <?php }?>

						 </select>

                        </td>

                        <td><input type="text" name="item_desc" id="i3" class="form-control" value="<?=$setitemdesc?>" style="width: 400px;"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_amount" id="i4" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setitemamt)?>">
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_total" id="i5" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setitemtot)?>">
                              </div>
                          </div>
                        </td>

                        <td> <input type="checkbox" value="1" name="iteam_taxable" ></td>

                        <td>

                          <!-- <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button> -->


                         <button onclick="fncrpitem('0')" class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button> 


                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

              </div>
            </div>

             </div><?php

	    	}

    	}

    	
        $tasksql=$this->db->query("SELECT * FROM invoice_task WHERE invoice_id='".$_POST['invoiceid']."'");
    	$tasksqlnrows=$tasksql->num_rows();

    	if($tasksqlnrows>0)
    	{

    	  $gettaskrow=$tasksql->row();

    	  $taskstartdt=$gettaskrow->task_date_started;
    	  $tasksduedt=$gettaskrow->task_due_date;
    	  $taskscompletchk=$gettaskrow->task_completed;
    	  $taskscompletby=$gettaskrow->task_completed_by;
    	  $taskscompletdt=$gettaskrow->task_completed_date;
    	  $tasksnote=$gettaskrow->task_note;
    	  $tasksenterdby=$gettaskrow->task_entered_by;


       }else{

       	 $taskstartdt="";
       	 $tasksduedt="";
       	 $taskscompletchk="";
       	 $taskscompletdt="";
       	 $taskscompletby="";
       	 $tasksnote="";
       	 $tasksenterdby="";
       }

?>
  <!--  Tab: terms  -->
    <div role="tabpanel" class="tab-pane" id="terms">
    		<div class="box box-default ">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_terms" value="invoice_terms" class="form-control">
                <p class="uhead2">Terms/Tasks <span class="text-danger">(Optional)</span></p>


              </div>


              <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>Time</th>

                        <th>Amount</th>

                        <th>Amount</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <td>

                          <select class="form-control">

                            <option>Select</option>

                          </select>

                        </td>

                        <td>

                          <select class="form-control">

                            <option>Select</option>

                          </select>

                        </td>

                        <td>$1000</td>

                      </tr>

                    </tbody>

                    <tfoot>

                      <tr>

                        <td colspan="3">

                          <button class="btn btn-xs btn-default pull-right">Remove Terms</button></td>

                        </tr>

                      </tfoot>

                    </table>

                  </div>



                  <hr>

                  <div class="table-responsive">

                    <table class="table table-hover no-margin">

                      <thead>

                        <tr>

                          <th>Date Started</th>

                          <th>Task</th>

                          <th>User</th>

                          <th>Due Date</th>

                          <th>Completed</th>

                          <th>Completed By</th>

                          <th>Completed Date</th>

                          <th>Note</th>

                          <th>Entered By</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td><input type="date" name="task_date" class="form-control" value="<?=$taskstartdt?>"></td>

                          <td>

                            <div class="dropdown dropdown_task ">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> Task
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href="#">Task 1 </a></li>
                                  <li><a tabindex="-1" href="#">Task 2</a></li>
                                  <li class="dropdown-submenu">
                                    <a class="test" tabindex="-1" href="#">Task 3 <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <li><a tabindex="-1" href="#">Task 3-1 </a></li>
                                      <li><a tabindex="-1" href="#">Task 3-2 </a></li>
                                      <li class="dropdown-submenu">
                                        <a class="test" href="#">Task 3-3 <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                          <li><a href="#">Task 3-3-1</a></li>
                                          <li><a href="#">Task 3-3-2</a></li>
                                        </ul>
                                      </li>
                                    </ul>
                                  </li>
                                </ul>
                              </div>



                          </td>

                          <td>

                            <select class="form-control" name="task_user">

                              <option value="">Select</option>
                              <option selected value="Test">Test</option>

                            </select>

                          </td>

                          <td><input type="date" name="task_due_date" class="form-control" value="<?=$tasksduedt?>"></td>

                          <td><div class="checkbox">
                            <label>
                            <input type="checkbox" <?php if($taskscompletchk==1){echo "checked='checked'";}?> value="1" name="task_completed[]"></label>
                          </div></td>

                          <td><input type="text" name="task_completed_by" class="form-control" value="<?=$taskscompletby?>"></td>

                          <td><input type="date" name="task_completed_date" class="form-control" value="<?=$taskscompletdt?>"></td>

                          <td><input type="text" name="task_note" class="form-control" value="<?=$tasksnote?>"></td>

                          <td><input type="text" name="task_enter_by" class="form-control" value="<?=$tasksenterdby?>"></td>

                          <td></td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>
   </div>

<?php
        $pickupinfosql=$this->db->query("SELECT * FROM invoices_pickup_info WHERE invoice_id='".$_POST['invoiceid']."'");
    	$pickupinfosqlnrows=$pickupinfosql->num_rows();

    	if($pickupinfosqlnrows>0)
    	{

    	  $getpckinforow=$pickupinfosql->row();

    	  $setpickupinfoitem=$getpckinforow->pickup_info_item;
    	  $setpickupinfodesc=$getpckinforow->pickup_info_desc;
    	  $setpickupinfoqty=$getpckinforow->pickup_info_quantity;
    	  $setpickupinfopby=$getpckinforow->pickup_info_pickup_by;
    	  $setpickupinfopdt=$getpckinforow->pickup_info_pickup_date;
    	  $setpickupinfonotes=$getpckinforow->pickup_info_notes;
       }else{

       	 $setpickupinfoitem="";
       	 $setpickupinfodesc="";
       	 $setpickupinfoqty="";
       	 $setpickupinfopby="";
       	 $setpickupinfopdt="";
       	 $setpickupinfonotes="";

       }

       $pickupreqsql=$this->db->query("SELECT * FROM invoice_pickup_required WHERE invoice_id='".$_POST['invoiceid']."'");
    	$pickupreqsqlnrows=$pickupreqsql->num_rows();

    	if($pickupreqsqlnrows>0)
    	{
    		 $getpckreqrow=$pickupreqsql->row();

    	    $setpickupreqqty=$getpckreqrow->pickup_required_quantity;
    	    $setpickupinforeqpck=$getpckreqrow->pickup_required_pickup;

    	}else{

    		$setpickupreqqty="";
    		$setpickupinforeqpck="";
    	}


?>

 <!--  Tab: pickup  -->
    <div role="tabpanel" class="tab-pane" id="pickup">
    		<div class="box box-default ">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_pickup_info" value="invoice_pickup_info" class="form-control">
                <p class="uhead2">Pickup Info</p>

              </div>


              <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Item</th>

                          <th>Description</th>

                          <th>Quantity</th>

                          <th>Picked up by</th>

                          <th>Pickup Date</th>

                          <th>Notes</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td>1</td>

                        <td><input type="text" name="pickup_item[]" class="form-control" value="<?=$setpickupinfoitem?>"></td>

                        <td><input type="text" name="pickup_desc[]" class="form-control" value="<?=$setpickupinfodesc?>"></td>

                        <td><input type="text" name="pickup_quantity[]" class="form-control" value="<?=$setpickupinfoqty?>"></td>

                        <td><input type="text" name="pickup_pickup_by[]" class="form-control" value="<?=$setpickupinfopby?>"></td>

                        <td><input type="date" name="pickup_date[]" class="form-control" value="<?=$setpickupinfopdt?>"></td>

                        <td><input type="text" name="pickup_note[]" class="form-control" value="<?=$setpickupinfonotes?>"></td>

                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>


                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                <input type="hidden" name="invoice_pickup_required" value="invoice_pickup_required" class="form-control">
                <p><strong>Pickup Required</strong></p>



                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Item</th>

                          <th>Quantity</th>

                          <th>Pickup</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td>1</td>

                        <td>

                          <select class="form-control" name="pickupreq_item[]">

                            <option value="">Select</option>
                            <option selected value="test">Test</option>

                          </select>

                        </td>

                        <td><input type="text" name="pickupreq_quantity[]" class="form-control" value="<?=$setpickupreqqty?>"></td>

                        <td><input type="text" name="pickupreq_pickup[]" class="form-control" value="<?=$setpickupinforeqpck?>"></td>

                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>


              </div>

            </div>

  </div>

 <!--  Tab: notes  -->
    <div role="tabpanel" class="tab-pane" id="notes">
    		<div class="box box-default">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_note" value="invoice_note" class="form-control">
                <p class="uhead2">NOTES</p>



              </div>



              <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Date</th>

                          <th>Time</th>

                          <th>Type</th>

                          <th>Note</th>

                          <th>User</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td>1</td>

                        <td><input type="date" name="note_date[]" class="form-control"></td>

                        <td><input type="time" name="note_time[]" class="form-control"></td>

                        <td><input type="text" name="note_type[]" class="form-control"></td>

                        <td><input type="text" name="note_note[]" class="form-control"></td>

                        <td><input type="text" name="note_user[]" class="form-control"></td>

                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>



                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>



              </div>



            </div>

    </div>

 <!--  Tab: associated  -->
    <div role="tabpanel" class="tab-pane" id="associated">
    		<div class="box box-default">

                <div class="box-header with-border">
                  <input type="hidden" name="invoice_associated_order" value="invoice_associated_order" class="form-control">
                  <p class="uhead2">ASSOCIATED ORDER </p>


                </div>



                <div class="box-body">


                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Invoice</th>

                        <th>Name</th>

                        <th>Date Entered</th>

                        <th>Due Date</th>

                        <th>Contract type</th>

                        <th>Discount</th>

                        <th>Sub Total</th>

                        <th>Tax </th>

                        <th>Amount </th>

                        <th>Paid </th>

                        <th>Balance Due </th>

                        <th>Tax Rate </th>

                        <th>County </th>

                        <th>User </th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td class="increment">1</td>

                        <td><input type="text" name="associated_invoice[]" class="form-control"></td>

                        <td><input type="text" name="associated_name[]" class="form-control"></td>

                        <td><input type="date" name="associated_date_enter[]" class="form-control"></td>

                        <td><input type="date" name="associated_due_date[]" class="form-control"></td>

                        <td><input type="text" name="associated_contract_type[]" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_discount[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_sub_total[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td><input type="text" name="associated_tax[]" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_amount[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td><input type="text" name="associated_paid[]" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_balance_due[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td><input type="text" name="associated_tax_rate[]" class="form-control"></td>

                        <td><input type="text" name="associated_county[]" class="form-control"></td>

                        <td><input type="text" name="associated_user[]" class="form-control"></td>

                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>


                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>



               </div>



             </div>


    </div>

   <!--    <div class="row">
        	<div class="col-sm-12">
            			<div class="btns text-center">
                        	<button class="btn btn-lg btn-info btn-flat">Save</button>
                            <a href="<?//=site_url('fi_home/custinvoices/')?>" onclick="return confirm('Are you sure want to Clear all Data..??')" class ="btn btn-lg btn-default btn-flat">Cancel</a>
                        </div>
            </div>
    </div>
 -->
    	<?php
    }


  function fngetadmpckjson_dtls()
  {
  	$pckjson;
    $admpcksql=$this->db->query("SELECT * FROM admin_item WHERE item_id='".$_POST['admpckId']."'");

    foreach($admpcksql->result() as $admpcksql_dtls)
    {
    	$pckjson['admpackageitem']=$admpcksql_dtls;
    }

     echo json_encode($pckjson);
  }

  function fngetsignlepckinfo_dtls()
  {
  	//$pckitemjson=array();

  	error_reporting(0);


  	//$this->db->where('package_id',$_POST['pckId']);
  	$this->db->where('inv_id',$_POST['invId']);
  	$this->db->where('cus_id',$_POST['custid']);
  	if($this->db->delete('customer_assigned_packages'))
  	{
  		$getpostpckg=$this->db->query("SELECT * FROM admin_package WHERE package_id = '".$_POST['pckId']."'");
         $getadmpckrow=$getpostpckg->row();

  		$pckarr=array(
  			"cus_id" => $_POST['custid'],
  			"inv_id" => $_POST['invId'],
  			"package_id" => $_POST['pckId'],
  			"package_name" => $getadmpckrow->package_name,
  			"package_price" => $getadmpckrow->package_price,
  			"package_taxable" => $getadmpckrow->package_taxable
  		);

  		$this->db->insert('customer_assigned_packages',$pckarr);
  		
	 }


    $getpostpckgitms=$this->db->query("SELECT * FROM admin_package_item WHERE package_id = '".$_POST['pckId']."'");
    
	//$this->db->where('package_id',$_POST['pckId']); 
	$this->db->where('inv_id',$_POST['invId']);
  	$this->db->where('cus_id',$_POST['custid']);
  	if($this->db->delete('customers_package_items'))
  	{

  		foreach($getpostpckgitms->result() as $getpostpckgitms_dtls)
  		 {
	  		$itemsarr=array(
	  			"cus_id" => $_POST['custid'],
	  			"inv_id" => $_POST['invId'],
	  			"package_id" => $_POST['pckId'],
	  			"item_name" => $getpostpckgitms_dtls->item_name,
	  			"item_quantity" => $getpostpckgitms_dtls->item_quantity,
	  			"item_price" => $getpostpckgitms_dtls->item_price,
	  			"item_desc" => $getpostpckgitms_dtls->item_desc
	  		);

	  		$this->db->insert('customers_package_items',$itemsarr);
	  	}
  		
	}



    $pckitmsql=$this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM customers_package_items AS i,customer_assigned_packages AS p WHERE i.package_id=p.package_id AND i.package_id='".$_POST['pckId']."' AND p.package_id='".$_POST['pckId']."' ORDER BY id ASC");


     $chkitmsql=$this->db->query("SELECT * FROM customers_package_items WHERE package_id='".$_POST['pckId']."' ORDER BY id DESC LIMIT 1");


     /* $pckitmsql=$this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM admin_package_item AS i,admin_package AS p WHERE i.package_id=p.package_id AND i.package_id='".$_POST['pckId']."' AND p.package_id='".$_POST['pckId']."' ORDER BY id ASC");


     $chkitmsql=$this->db->query("SELECT * FROM admin_package_item WHERE package_id='".$_POST['pckId']."' ORDER BY id DESC LIMIT 1"); */
     $isitmsrow=$chkitmsql->row(); 


     $isitmsrow=$chkitmsql->row();

    if($pckitmsql->num_rows()>0)
    {

    	$srno=1;
	    foreach($pckitmsql->result() as $pckitmsql_dtls)
	    {
	    	//$pckitemjson['pckitemlist'][]=$pckitmsql_dtls;

	    		$itmId=$pckitmsql_dtls->id;

	    	     if($isitmsrow->id==$itmId)
                      {
                        $lstinvoiceid="fa-plus";
                        $lstinvoicecls="btn-success";
                        $fninvoce="fncrpitem('".$pckitmsql_dtls->id."')";
                      }else{

                        $lstinvoiceid="fa-minus";
                        $lstinvoicecls="btn-danger";
                        $fninvoce="fndelpitem('".$pckitmsql_dtls->id."')";
                      }
                      //fnupdateitmsinfo
	    	?>

	    	<tr class="tr_clone auto-index"><td class="increment"><?=$srno?></td><td><input type="number" name="item_quantity<?=$itmId?>" id="i1<?=$itmId?>" min="1" class="form-control" value="<?=$pckitmsql_dtls->item_quantity?>" style="width: 40px;" disabled ></td><td>
	    		<select class="form-control" name="item_name<?=$itmId?>" id="i2<?=$itmId?>" style="width: 80px;" onchange="fnadmpckinfo(this.value,'<?=$itmId?>')">
                                <option value="">Select</option>

                             <?php

                                  $admitmsql=$this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

                                  foreach ($admitmsql->result() as $admitmsql_dtls)
                                  {
                                       if($admitmsql_dtls->item_id==$pckitmsql_dtls->item_name)
                                       {

                                          $selectitmtyp="selected";
                                       }else{

                                           $selectitmtyp="";
                                       }

                                ?>
                                <option <?=$selectitmtyp?> value="<?=$admitmsql_dtls->item_id?>"><?=$admitmsql_dtls->item_name?></option>

                              <?php }?>

	    	</td><td><input type="text" onchange="fnupdateitemdescp(this.value,'<?=$itmId?>')" name="item_desc<?=$itmId?>" id="i3<?=$itmId?>" class="form-control" value="<?=$pckitmsql_dtls->item_desc?>" style="width: 400px;" ></td><td><div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span><input type="text" onchange="fnupdateitemamountp(this.value,'<?=$itmId?>')" name="item_amount<?=$itmId?>" id="i4<?=$itmId?>" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$pckitmsql_dtls->item_price)?>" ></div></div></td><td><div class="form-group"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span><input type="text" disabled name="item_total<?=$itmId?>" id="i5<?=$itmId?>" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$pckitmsql_dtls->item_quantity*$pckitmsql_dtls->item_price)?>"></div></div></td><td> <input type="checkbox" disabled value="1" id="iteam_taxable<?=$itmId?>" name="iteam_taxable<?=$itmId?>"></td><td><button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> tr_clone_add"><i class="fa <?=$lstinvoiceid?>"></i></button></td><td><input type="hidden" name="pcktot" id="pcktot" value="<?=sprintf('%0.2f',$pckitmsql_dtls->package_price)?>"></td></tr>

	    	<?php $srno++;

	    }

      // echo json_encode($pckitemjson);
    }/*else{
    	$pckitemjson['pckitemlist']="";
        echo json_encode($pckitemjson);
    } */
  }

  function fngetsearhinvoice_dtls()
  {

  	    error_reporting(0);

        $invoicesql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$_POST['custid']."' ORDER BY invoice_id ASC");
    	//$chkinvsql=$this->db->query("SELECT * FROM invoices_create ORDER BY invoice_id DESC LIMIT 1");
    	$chkinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$_POST['custid']."' ORDER BY invoice_id DESC LIMIT 1");
        $isinvoicerow=$chkinvsql->row();

              foreach ($invoicesql->result() as $invoicesql_dtls)
                  {

                     $invoiceId=$invoicesql_dtls->invoice_id;
                     $invoicedt=$invoicesql_dtls->invoice_date;
                     $invoiceduedt=$invoicesql_dtls->invoice_due_date;
                     $invoicetype=$invoicesql_dtls->invoice_type;
                     $contracttype=$invoicesql_dtls->invoice_contract_type;
                     $invdescnt=$invoicesql_dtls->invoice_discount;
                     $invsubtot=$invoicesql_dtls->invoice_sub_total;
                     $invtax=$invoicesql_dtls->invoice_tax;
                     $invamount=$invoicesql_dtls->invoice_amount;
                     $invpaid=$invoicesql_dtls->invoice_paid;
                     $invbaldue=$invoicesql_dtls->invoice_balance_due;
                     $invtaxrate=$invoicesql_dtls->invoice_tax_rate;
                     $invcntry=$invoicesql_dtls->invoice_county;
                     $invuser=$invoicesql_dtls->invoice_user;

                     $invcustId=$invoicesql_dtls->cust_id;


                     if($invoicedt!="")
                     {

                        $invdate=$invoicedt;

                     }else{

                        $invdate=date('Y-m-d');
                     }


                     if($invoiceduedt!="")
                     {

                        $invduedate=$invoiceduedt;

                     }else{

                        $invduedate="";
                     }

                     if($invdescnt!="")
                     {
                        $setinvdescnt=$invdescnt;

                     }else{

                        $setinvdescnt="";
                     }

                    if($invsubtot!="")
                     {
                        $setinvsubtot=$invsubtot;

                     }else{

                        $setinvsubtot="";
                     }

                     if($invsubtot!="")
                     {
                        $setinvsubtot=$invsubtot;

                     }else{

                        $setinvsubtot="";
                     }


                     if($invtax!="")
                     {
                        $setinvtax=$invtax;

                     }else{

                        $setinvtax=""; //8.8%
                     }

                    if($invamount!="")
                     {
                        $setinvamount=$invamount;

                     }else{

                        $setinvamount="";
                     }


                     if($invpaid!="")
                     {
                        $setinvpaid=$invpaid;

                     }else{

                        $setinvpaid="";
                     }


                   if($invbaldue!="")
                     {
                        $setinvbaldue=$invbaldue;

                     }else{

                        $setinvbaldue="";
                     }

                    if($invtaxrate!="")
                     {
                        $setinvtaxrate=$invtaxrate;

                     }else{

                        $setinvtaxrate="";
                     }


                    if($invcntry!="")
                     {
                        $setinvcntry=$invcntry;

                     }else{

                        $setinvcntry="";
                     }


                    if($invuser!="")
                     {
                        $setinvuser=$invuser;

                     }else{

                        $setinvuser="";
                     }



                    if($isinvoicerow->invoice_id==$invoiceId)
                      {
                        $lstinvoiceid="fa-plus";
                        $lstinvoicecls="btn-success";
                        $fninvoce="fncrinvoice('".$invoiceId."')";

                      }else{

                        $lstinvoiceid="fa-minus";
                        $lstinvoicecls="btn-danger";
                        $fninvoce="fndelinvoice('".$invoiceId."')";

                      }



                  ?>

                        <tr class="tr_clone">

                          <!--   <td><?=$i?></td> -->
							   <td><a onclick="fngetinvoicedetails('<?=$invoiceId?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a></td>
                            <td><?=$invoicesql_dtls->invoice_id?></td>

                            <td><input type="date" name="invoice_date<?=$invoiceId?>" id="invoice_date<?=$invoiceId?>" class="form-control" value="<?=$invdate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_date')" >

                            </td>

                          <td><input type="date" name="invoice_due_date<?=$invoiceId?>" id="invoice_due_date<?=$invoiceId?>" class="form-control" value="<?=$invduedate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_due_date')" onkeydown="dueuniKeyCode(event,'<?=$invoiceId?>')"></td>

                            <td>

                             <select class="form-control" name="invoice_event_type<?=$invoiceId?>" id="invoice_event_type<?=$invoiceId?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_type')">
                                 <option value="0">Select</option>
                                <?php

                                  //$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");

                                 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE cus_id='".$isinvoicerow->cust_id."' GROUP BY event_type ORDER BY event_id ASC ");


                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                     /*  if($evntypsql_dtls->name==$invoicetype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }*/

                                ?>
                                <option value="<?=$evntypsql_dtls->c?>"><?=$evntypsql_dtls->event_type?></option>

                              <?php }?>


                              </select>

                            </td>

                            <td>

                              <select class="form-control" name="invoice_contract_type<?=$invoiceId?>" id="invoice_contract_type<?=$invoiceId?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_contract_type')">
                                <option value="">Select</option>

                             <?php

                                  $evntypsql=$this->db->query("SELECT * FROM invoice_contract_type ORDER BY id ASC");

                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                       if($evntypsql_dtls->name==$contracttype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }

                                ?>
                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->name?>"><?=$evntypsql_dtls->name?></option>

                              <?php }?>


                              </select>

                            </td>

                            <td>
                              <div class="form-group">
                                  <div class="input-group">
                                      <span class="input-group-addon"><!-- <span class="glyphicon glyphicon-usd"></span> --></span>
                                  <input type="text" name="invoice_discount<?=$invoiceId?>" id="invoice_discount<?=$invoiceId?>" class="form-control" style="width: 40px;" value="<?=$setinvdescnt?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_discount')" >
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_sub_total<?=$invoiceId?>" id="invoice_sub_total<?=$invoiceId?>" class="form-control" style="width: 80px;" value="<?=sprintf('%0.2f',$setinvsubtot)?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_sub_total')" >
                                  </div>
                              </div>
                          </td>

                            <td>
                              <input type="text" name="invoice_tax<?=$invoiceId?>" id="invoice_tax<?=$invoiceId?>" class="form-control" style="width: 60px;" value="<?=$setinvtax?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_tax')" >
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_amount" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setinvamount)?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_paid" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setinvpaid)?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_balance_due" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setinvbaldue)?>" disabled>
                                  </div>
                              </div>
                            </td>

                           <!--  <td><span class="label label-success">Pay</span></td> -->

                            <td><input type="text" name="invoice_tax_rate<?=$invoiceId?>" id="invoice_tax_rate<?=$invoiceId?>" class="form-control" value="<?=$setinvtaxrate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_tax_rate')" ></td>

                            <td><input type="text" name="invoice_country<?=$invoiceId?>" id="invoice_country<?=$invoiceId?>" class="form-control" value="<?=$setinvcntry?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_county')" ></td>

                            <td><input type="text" name="invoice_user<?=$invoiceId?>" id="invoice_user<?=$invoiceId?>" class="form-control" value="<?=$setinvuser?>" style="width: 60px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_user')"></td>


                            <td>
                            	<!-- <a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true" ></i></a> -->

                            	<a href="<?=site_url('PaymentsCont/c_payment/').$invcustId?>"><i class="fa fa-money" aria-hidden="true" ></i></a>
                            </td>

                            <td>

                          <button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> tr_clone_add"><i class="fa <?=$lstinvoiceid?>"></i></button>

                        </td>
                    </tr>

                    <?php  }
   }


  function crpitem_dtls()
    {


    		$postitemsarr=array(
    		    "package_id" => $_POST['pckId'],
    		    "cus_id" => $_POST['custnm'],
    		    "inv_id" => $_POST['invId']
    		  );

		  if($this->db->insert('customers_package_items',$postitemsarr)) //admin_package_item
     	    {
     	    	echo "success";
     	    }else{
     	    	echo "error";
     	    }

    }

  function delpitem_dtls()
    {
    	$this->db->where('id',$this->input->post('itmId'));
    	if($this->db->delete('customers_package_items'))  //admin_package_item
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

  function updtitems_dtls()
    {

    	$fieldname=$this->input->post('fieldnm');

    	$updateitmarr=array(

    		 $fieldname  => $this->input->post('inptxtval')
    	  );

    	$this->db->where('id',$this->input->post('itemsid'));
    	if($this->db->update('admin_package_item',$updateitmarr))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

  function updinvamt_dtls()
    {

    	//echo "pckId--".$this->input->post('pckId');

    	if($this->input->post('pckId')=="")
    	{

    		$updateinvamtarr=array(

    		 "invoice_amount"  => "",
    		 "invoice_balance_due"  => "",
    		 "assigned_pckage"  => ""
    	  );


    	}else{

    		$updateinvamtarr=array(

    		 "invoice_amount"  => $this->input->post('pcktot'),
    		 "invoice_balance_due"  => $this->input->post('pcktot'),
    		 "assigned_pckage"  => $this->input->post('pckId')
    	  );

    	}

    	

    	$this->db->where('invoice_id',$this->input->post('invId'));
    	if($this->db->update('invoices_create',$updateinvamtarr))
    	{

			/*$upckpricearr=array(

				 "package_price"  => $this->input->post('pcktot'),
				);
            $this->db->where('package_id',$this->input->post('pckId'));
    	    $this->db->update('admin_package',$upckpricearr);*/
    	
    		echo "success";
    	}else{
			echo "error";
    	}
    }


   function updpckinfo_dtls()
    {

    	$updatepckinfoarr=array(

    		 "package_id"  => $this->input->post('pckId'),
    		 "item_name"  => $this->input->post('admpckId'),
    		 "item_quantity"  => 1,
    		 "item_price"  => $this->input->post('item_price'),
    		 "item_desc"  => $this->input->post('item_desc'),
    	  );

    	$this->db->where('id',$this->input->post('txtinpid'));
    	if($this->db->update('customers_package_items',$updatepckinfoarr))/*admin_package_item*/
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

 function isChkExistPackage($pckname)
  {

   	 $chkpcksql=$this->db->query("SELECT * FROM admin_contract_type WHERE contract_name='".$pckname."'");
   	 $chkpcksql_nrow=$chkpcksql->num_rows();
   	 if($chkpcksql_nrow>0)
   	 {
   	 	return "IsExists";
   	 }else{
   	 	return "Not Exists";
   	 }

  }

	public function allSearchInfo($cName)
	{
		$id = $cName;
		$cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$this->db->select('*');
		$this->db->from('user_contact_info');
		$this->db->where('cus_id', $id);
		//$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];


		$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$id'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 }

		?>

			<tr>

				<td><?="1"; ?></td>

				<td><?= $get_data['cus_title']?></td>

				<td style="text-transform:capitalize;"><?= $get_data['cus_fname']?></td>

				<td style="text-transform:capitalize;"><?= $get_data['cus_lname']?></td>

				<td><?= $get_data['cus_company_name']?></td>

				<td><?= $get_data['cus_address1']?></td>
				<td><?= $get_data['cus_address2']?></td>
				<td><?= $get_data['cus_city']?></td>
				<td><?= $get_data['cus_state']?></td>
				<td><?= $get_data['cus_zip']?></td>
				<td><?= $get_data['cus_area']?></td>
				<td><?=$htmlphone?></td>
				<td><?=trim($htmlnotes,",")?></td>
				
			</tr>

	<?php

	}

	public function allGeneralInfo($cName)
	{
		$id = $cName;
		$cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$contact = $this->db->where('cat_id',1)->get('sub_categories')->result_array();

		$user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
		$get_all_contacts = $user_contact->result_array();

		$user_ship = $this->db->query("SELECT * from `ship_address` WHERE `ship_user_id` = '$id'");
		$shipping = $user_ship->result_array()[0];


// 		print_r($shipping);die;

			?><div class="col-md-6">

				 <div class="box box-primary">

					 <div class="box-body">

						 <div class="row">

							 <div class="col-md-12">

								 <p class="uhead2">Name</p>
								 <input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
								 <div class="form-horizontal">

									 <div class="form-group">

										 <div class="col-sm-12">

											 <select class="form-control fcap" name="title" id="title">

												 <option value="">Select Title</option>

														 <option <?php if($get_data['cus_title']=="Dr"){ echo "selected";}?> value="Dr">Dr.</option>

														 <option <?php if($get_data['cus_title']=="Mr"){ echo "selected";}?> value="Mr">Mr.</option>

														 <option <?php if($get_data['cus_title']=="Mrs"){ echo "selected";}?> value="Mrs">Mrs.</option>

														 <option <?php if($get_data['cus_title']=="Ms"){ echo "selected";}?> value="Ms">Ms.</option>
											 </select>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)"  type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_area" id="cus_area" value="<?php echo $get_data['cus_area'] ?>" type="text" placeholder="Area">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <select class="form-control fcap" name="tax_status">

												 <option value="">Select Tax Status</option>

												 <option <?if($get_data['cus_tax_status']=="1"){echo "selected";}?> value="1">Exempt</option>

												 <option <?if($get_data['cus_tax_status']=="2"){echo "selected";}?> value="2">Out of state</option>

												 <option <?if($get_data['cus_tax_status']=="3"){echo "selected";}?> value="3">Resale</option>
											 </select>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID">

										 </div>

									 </div>

								 </div>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-6">

			 <div class="box box-primary">

				 <div class="box-body">

					 <div class="row">
						 <div class="col-md-12">

							 <p class="uhead2">Contact Info</p>
							 <div class="form-horizontal">

								 <?php foreach($get_all_contacts as $allContacts) {

                                           
                                           if($allContacts['conatct_type']=="Email")
                                           	 {
                                           	 	?>

                                           	 		 <div class="cnt_clone">

									 <div class="form-group">

										 <div class="col-sm-3">

											 <select name="cuscnt_type_email[]" class="form-control fcap mailevent" required>
											
												 <?php

												 foreach ($contact as $cont) {
													 if($allContacts['conatct_type']==$cont['sub_name'])
													 {
														 $selectedcls="selected";
													 }else{
														 $selectedcls="";
													 }
													 ?>
												 <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
											 <?php  }
													?>
											
											 </select>

										 </div>

										 
										 	 <div class="col-sm-3">

												 <input class="form-control" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" value="<?php echo $allContacts['email']; ?>">

											 </div>

											 <div class="col-sm-3">

												 <a href="" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal1">Email</a>

											 </div>	


										
										
											<div class="col-sm-3">
 												
 												
 												 <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
 											 </div>
										

										 </div>

									 </div>
                                           	 	<?php
                                           	 }elseif($allContacts['conatct_type']=="Home" || $allContacts['conatct_type']=="Office" || $allContacts['conatct_type']=="Mobile"){

                                           	 	//echo "else home".$allContacts['contact_no'];
                                           	 	?>
                                           	 		
                                           	 	   <div class="cnt_clone">

									 <div class="form-group">

										 <div class="col-sm-3">

											 <select name="cus_contact_type[]" class="form-control fcap mailevent" required>
											
												 <?php

												 foreach ($contact as $cont) {
													 if($allContacts['conatct_type']==$cont['sub_name'])
													 {
														 $selectedcls="selected";
													 }else{
														 $selectedcls="";
													 }
													 ?>
												 <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
											 <?php  }
													?>
											
											 </select>

										 </div>
										 
										 	 <div class="col-sm-3">

											 <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details">

										 </div>

										 <div class="col-sm-3">

											 <input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

										 </div>
										 <?php if($allContacts['default_contact'] == 1){ ?>
											 <div class="col-sm-3">
 											
 												 <label class="switch">

 													<input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"  checked > 

 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
 											 </div>
										 <?php }else{ ?>
											 <div class="col-sm-3">
 												
 												 <label class="switch">

 													  <input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"  checked > 
 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
 											 </div>
										 <?php } ?>	

										 </div>

									 </div>

                                           	
									<?php } } ?>
								
								 

							 </div>
						 </div>
						 <!-- /.box-body -->

					 </div>

					 <!-- /.box -->

				 </div>
			 </div>
		 </div>
		 <div class="clearfix"></div>

		 <div class="col-md-6">

			 <div class="box box-default">

				 <div class="box-header with-border">

					   <div class="col-md-5">
                    <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                 </div>

                 <div class="col-md-5">
                    <div class="checkbox uhead2">

                    	<?php 
                    	  if($shipping['billing_addr_status']=="1")
                    	  	{
                    	  		$chkstatus="checked";
                    	  	}else{
                    	  		$chkstatus="";
                    	  	}  
                    	?>

					  <label><input <?=$chkstatus?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()" >Same as billing address</label>
					</div>
                  </div> 



					 <div class="box-tools pull-right">

						 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

						 </button>

					 </div>

					 <!-- /.box-tools -->

				 </div>

				 <!-- /.box-header -->

				 <div class="box-body"  id="billaddress" >

					 <div class="form-horizontal">

						 <div class="form-group">

							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly>

							 </div>

						 </div>

						 <div class="form-group">
							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly>

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

							 </div>

						 </div>

					 </div>

				 </div>

				 <!-- /.box-body -->

			 </div>

			 <!-- /.box -->

		 </div>
		 <?php

	}
	public function allSearchCustInfo($cName)
	{

		$id = $cName;


		// $user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE `cus_id` = '$id'" && "default_contact = '1'");
		// echo $user_contact;die;
		// $single_cust = $user_contact->result_array();

		$this->db->select('*');
		$this->db->from('user_contact_info');
		$this->db->where('cus_id', $id);
		$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];
		// print_r($query[0]['contact_no']);die;
		?>
		<input class="form-control fcap contact_no" onchange="fncustomersearchbyphone(this.value)" type="text" id="topphone" name="topphone" value="<?php echo $query['contact_no'] ?>">
	<?php }

	public function allCustInfo($cName){

		$id = $cName;

		$custs = $this->search_data();

		// $user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE `cus_id` = '$id'" && "default_contact = '1'");
		// echo $user_contact;die;
		// $single_cust = $user_contact->result_array();

		$this->db->select('*');
		$this->db->from('user_contact_info');
		$this->db->where('cus_id', $id);
		$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];
		// print_r($query[0]['contact_no']);die;
		?>
		<div class="col-md-12">

			<div class="box box-info">

				<div class="box-header with-border">

					<div class="row">

						<div class="col-sm-5 col-md-4">

							<h3 class="uhead1">

								GENERAL INFO

							</h3>

						</div>

						<div class="col-sm-7 col-md-8">

							<div class="pull-right">

								<ul class="list-inline topul">

									<li><a href="#" class="uhead2"> Main Menu</a></li>

									<li><a href="#" class="uhead2"> Options </a></li>

									<!--  <li><a class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal-note"><i class="fa fa-pencil-square-o"></i> Note</a></li> -->

									<li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

								</ul>

								<a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>

							</div>

						</div>

					</div>

				</div>

				<!-- /.box-header -->

				<div class="box-body">

					<div class="row">

						<div class="col-md-4">

							<div class="form-group">

								<select class="form-control fcap" id="cust_nm" onchange="loadcustlist()">
									<?php foreach ($custs as $cust) {

											if($_POST['name']==$cust['cus_id'])
											{
												$selectedcls="selected";
											}else{
												$selectedcls="";
											}

										 ?>
										<option <?=$selectedcls?> value="<?php echo $cust['cus_id'] ?>"><?php print_r($cust['cus_lname']." - ". $cust['cus_company_name']); ?></option>
									<?php } ?>


								</select>

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

							<input onchange="loadcustlistbyphone(this.value)" class="form-control fcap contact_no" id="phonenum" name="phonenum" type="text" value="<?php echo $query['contact_no'] ?>">

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

								<input class="form-control fcap" type="text" placeholder="433">

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

								<input class="form-control fcap" type="text" placeholder="$16.33">

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

								<input class="form-control fcap" type="text" placeholder="1">

							</div>

						</div>

							<!--  <div class="col-sm-1">
											 <button class="btn btn-xs btn-primary btn-flat">Save</button>
										 </div> -->

					</div>

				</div>

				<!-- /.box-body -->

			</div>

			<!-- /.box -->

		</div>
		<?php
	}

  function find_city_json($zip)
	{
		$cityjson=array();

		$getcity=$this->db->query("SELECT * FROM tbl_zipcode_list WHERE ZIP_code='".$zip."' LIMIT 1");
		if($getcity->num_rows()>0)
		{
		   foreach ($getcity->result() as $getcity_dtls) 
			{
			  $cityjson['custaddrinfo'][]=$getcity_dtls;
		     }
		  echo json_encode($cityjson);

		}else{

			$cityjson['custaddrinfo'][]="";
			echo json_encode($cityjson);
		}
		
	
	}

  public function fnloadcustlistbyphone_dtls($txtphonenum)
	{
	   
	   $user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE contact_no = '$txtphonenum'");
       
       if($user_contact->num_rows()>0)
       {

       	 $getrcrow=$user_contact->row();


		 $id = $getrcrow->cus_id;



		$cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$contact = $this->db->where('cat_id',1)->get('sub_categories')->result_array();

		$user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
		$get_all_contacts = $user_contact->result_array();

		$user_ship = $this->db->query("SELECT * from `ship_address` WHERE `ship_user_id` = '$id'");
		$shipping = $user_ship->result_array()[0];


// 		print_r($shipping);die;

			?><div class="col-md-6">

				 <div class="box box-primary">

					 <div class="box-body">

						 <div class="row">

							 <div class="col-md-12">

								 <p class="uhead2">Name</p>
								 <input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
								 <div class="form-horizontal">

									 <div class="form-group">

										 <div class="col-sm-12">

											 <select class="form-control fcap" name="title" id="title">

												 <option value="">Select Title</option>

														 <option <?php if($get_data['cus_title']=="Dr"){ echo "selected";}?> value="Dr">Dr.</option>

														 <option <?php if($get_data['cus_title']=="Mr"){ echo "selected";}?> value="Mr">Mr.</option>

														 <option <?php if($get_data['cus_title']=="Mrs"){ echo "selected";}?> value="Mrs">Mrs.</option>

														 <option <?php if($get_data['cus_title']=="Ms"){ echo "selected";}?> value="Ms">Ms.</option>
											 </select>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_zip" id="cus_zip"  value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()"

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_area" id="cus_area" value="<?php echo $get_data['cus_area'] ?>" type="text" placeholder="Area">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <select class="form-control fcap" name="tax_status">

												 <option value="">Select Tax Status</option>

												<option <?if($get_data['cus_tax_status']=="1"){echo "selected";}?> value="1">Exempt</option>

												 <option <?if($get_data['cus_tax_status']=="2"){echo "selected";}?> value="2">Out of state</option>

												 <option <?if($get_data['cus_tax_status']=="3"){echo "selected";}?> value="3">Resale</option>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID">

										 </div>

									 </div>

								 </div>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-6">

			 <div class="box box-primary">

				 <div class="box-body">

					 <div class="row">
						 <div class="col-md-12">

							 <p class="uhead2">Contact Info</p>
							 <div class="form-horizontal">

								 <?php foreach($get_all_contacts as $allContacts) {

									 ?>
								 <div class="cnt_clone">

									 <div class="form-group">

										 <div class="col-sm-3">

											 <select name="cus_contact_type[]" class="form-control fcap mailevent" required>
												 <!-- <option selected="<?php //echo $allContacts['conatct_type']; ?>">
													 <?php //echo $allContacts['conatct_type']; ?>
												 </option> -->
												 <?php

												 foreach ($contact as $cont) {
													 if($allContacts['conatct_type']==$cont['sub_name'])
													 {
														 $selectedcls="selected";
													 }else{
														 $selectedcls="";
													 }
													 ?>
												 <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
											 <?php  }
													?>


												 <!-- <option value="Office">Office</option>

												 <option value="Mobile">Mobile</option>

												 <option value="Summer">Summer</option>

												 <option value="Fax">Fax</option> -->


											 </select>

										 </div>


										

										 <div class="col-sm-3">

											 <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details">

										 </div>

										 <div class="col-sm-3">

											 <input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

										 </div>
										 <?php if($allContacts['default_contact'] == 1){ ?>
											 <div class="col-sm-3">
 												 <!-- <div class="radio">
 													 <label>Default</label>


 												 </div> -->
 												 <!-- <label>Default</label> -->
 												 <label class="switch">

 													 <input type="radio"  name="radio_click[]" checked>
 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
 											 </div>
										 <?php }else{ ?>
											 <div class="col-sm-3">
 												 <!-- <div class="radio">
 													 <label>Default</label>


 												 </div> -->
 												 <!-- <label>Default</label> -->
 												 <label class="switch">

 													 <input type="radio"  name="radio_click[]">
 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>
 											 </div>
										 <?php } ?>
										 	<!-- <div class="col-sm-3"> -->
												 <!-- <div class="radio">
													 <label>Default</label>


												 </div> -->
												 <!-- <label>Default</label> -->
												 <!-- <label class="switch">

													 <input type="checkbox"  name="radio_click[]" checked>
													 <span class="slider round"></span>
												 </label>

												 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
											 </div> -->
										 </div>

									 </div>
								 <?php } ?>
							 </div>
						 </div>
						 <!-- /.box-body -->

					 </div>

					 <!-- /.box -->

				 </div>
			 </div>
		 </div>
		 <div class="clearfix"></div>

		 <div class="col-md-6">

			 <div class="box box-default">

				 <div class="box-header with-border">

					    <div class="col-md-5">
                    <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                 </div>

                 <div class="col-md-5">
                    <div class="checkbox uhead2">
                    	<?php 
                    	  if($shipping['billing_addr_status']=="1")
                    	  	{
                    	  		$chkstatus="checked";
                    	  	}else{
                    	  		$chkstatus="";
                    	  	}  
                    	?>

					  <label><input <?=$chkstatus?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()" >Same as billing address</label>
					</div>
                  </div> 



					 <div class="box-tools pull-right">

						 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

						 </button>

					 </div>

					 <!-- /.box-tools -->

				 </div>

				 <!-- /.box-header -->

				 <div class="box-body" id="billaddress">

					 <div class="form-horizontal">

						 <div class="form-group">

							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly>

							 </div>

						 </div>

						 <div class="form-group">
							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly>

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

							 </div>

						 </div>

					 </div>

				 </div>

				 <!-- /.box-body -->

			 </div>

			 <!-- /.box -->

		 </div>
		 <?php


       }

       
	}

   function fndeleventinfo_dtls()
    {
    	$this->db->where('event_id',$this->input->post('eventId'));
    	$this->db->where('cus_id',$this->input->post('cusId'));
    	if($this->db->delete('events_register'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }		
   
   function fndellocationinfo_dtls()
    {
    	$this->db->where('location_id',$this->input->post('locId'));
    	$this->db->where('event_id',$this->input->post('eventId'));
    	if($this->db->delete('event_location'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

   function fndelcrewsinfo_dtls()
    {
    	$this->db->where('crews_id',$this->input->post('crewId'));
    	$this->db->where('event_id',$this->input->post('eventId'));
    	if($this->db->delete('event_crews'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

  function fngetphonewisrhinv_dtls()
  {

  	    error_reporting(0);

        $invoicesql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$_POST['custid']."' ORDER BY invoice_id ASC");
    	//$chkinvsql=$this->db->query("SELECT * FROM invoices_create ORDER BY invoice_id DESC LIMIT 1");
    	$chkinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$_POST['custid']."' ORDER BY invoice_id DESC LIMIT 1");
        $isinvoicerow=$chkinvsql->row();

              foreach ($invoicesql->result() as $invoicesql_dtls)
                  {

                     $invoiceId=$invoicesql_dtls->invoice_id;
                     $invoicedt=$invoicesql_dtls->invoice_date;
                     $invoiceduedt=$invoicesql_dtls->invoice_due_date;
                     $invoicetype=$invoicesql_dtls->invoice_type;
                     $contracttype=$invoicesql_dtls->invoice_contract_type;
                     $invdescnt=$invoicesql_dtls->invoice_discount;
                     $invsubtot=$invoicesql_dtls->invoice_sub_total;
                     $invtax=$invoicesql_dtls->invoice_tax;
                     $invamount=$invoicesql_dtls->invoice_amount;
                     $invpaid=$invoicesql_dtls->invoice_paid;
                     $invbaldue=$invoicesql_dtls->invoice_balance_due;
                     $invtaxrate=$invoicesql_dtls->invoice_tax_rate;
                     $invcntry=$invoicesql_dtls->invoice_county;
                     $invuser=$invoicesql_dtls->invoice_user;


                     if($invoicedt!="")
                     {

                        $invdate=$invoicedt;

                     }else{

                        $invdate=date('Y-m-d');
                     }


                     if($invoiceduedt!="")
                     {

                        $invduedate=$invoiceduedt;

                     }else{

                        $invduedate="";
                     }

                     if($invdescnt!="")
                     {
                        $setinvdescnt=$invdescnt;

                     }else{

                        $setinvdescnt="";
                     }

                    if($invsubtot!="")
                     {
                        $setinvsubtot=$invsubtot;

                     }else{

                        $setinvsubtot="";
                     }

                     if($invsubtot!="")
                     {
                        $setinvsubtot=$invsubtot;

                     }else{

                        $setinvsubtot="";
                     }


                     if($invtax!="")
                     {
                        $setinvtax=$invtax;

                     }else{

                        $setinvtax=""; //8.8%
                     }

                    if($invamount!="")
                     {
                        $setinvamount=$invamount;

                     }else{

                        $setinvamount="";
                     }


                     if($invpaid!="")
                     {
                        $setinvpaid=$invpaid;

                     }else{

                        $setinvpaid="";
                     }


                   if($invbaldue!="")
                     {
                        $setinvbaldue=$invbaldue;

                     }else{

                        $setinvbaldue="";
                     }

                    if($invtaxrate!="")
                     {
                        $setinvtaxrate=$invtaxrate;

                     }else{

                        $setinvtaxrate="";
                     }


                    if($invcntry!="")
                     {
                        $setinvcntry=$invcntry;

                     }else{

                        $setinvcntry="";
                     }


                    if($invuser!="")
                     {
                        $setinvuser=$invuser;

                     }else{

                        $setinvuser="";
                     }



                    if($isinvoicerow->invoice_id==$invoiceId)
                      {
                        $lstinvoiceid="fa-plus";
                        $lstinvoicecls="btn-success";
                        $fninvoce="fncrinvoice('".$invoiceId."')";

                      }else{

                        $lstinvoiceid="fa-minus";
                        $lstinvoicecls="btn-danger";
                        $fninvoce="fndelinvoice('".$invoiceId."')";

                      }



                  ?>

                        <tr class="tr_clone">

                          <!--   <td><?=$i?></td> -->
							   <td><a onclick="fngetinvoicedetails('<?=$invoiceId?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a></td>
                            <td><?=$invoicesql_dtls->invoice_id?></td>

                            <td><input type="date" name="invoice_date<?=$invoiceId?>" id="invoice_date<?=$invoiceId?>" class="form-control" value="<?=$invdate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_date')" >

                            </td>

                          <td><input type="date" name="invoice_due_date<?=$invoiceId?>" id="invoice_due_date<?=$invoiceId?>" class="form-control" value="<?=$invduedate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_due_date')" onkeydown="dueuniKeyCode(event,'<?=$invoiceId?>')"></td>

                            <td>

                             <select class="form-control" name="invoice_event_type<?=$invoiceId?>" id="invoice_event_type<?=$invoiceId?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_type')">
                               <option value="0">Select</option>
                                <?php

                                  //$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");

                                 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE cus_id='".$isinvoicerow->cust_id."'  GROUP BY event_type ORDER BY event_id ASC ");


                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                     /*  if($evntypsql_dtls->name==$invoicetype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }*/

                                ?>
                                <option value="<?=$evntypsql_dtls->c?>"><?=$evntypsql_dtls->event_type?></option>

                              <?php }?>


                              </select>

                            </td>

                            <td>

                              <select class="form-control" name="invoice_contract_type<?=$invoiceId?>" id="invoice_contract_type<?=$invoiceId?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_contract_type')">
                                <option value="">Select</option>

                             <?php

                                  $evntypsql=$this->db->query("SELECT * FROM invoice_contract_type ORDER BY id ASC");

                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                       if($evntypsql_dtls->name==$contracttype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }

                                ?>
                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->name?>"><?=$evntypsql_dtls->name?></option>

                              <?php }?>


                              </select>

                            </td>

                            <td>
                              <div class="form-group">
                                  <div class="input-group">
                                      <span class="input-group-addon"><!-- <span class="glyphicon glyphicon-usd"></span> --></span>
                                  <input type="text" name="invoice_discount<?=$invoiceId?>" id="invoice_discount<?=$invoiceId?>" class="form-control" style="width: 40px;" value="<?=$setinvdescnt?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_discount')" >
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_sub_total<?=$invoiceId?>" id="invoice_sub_total<?=$invoiceId?>" class="form-control" style="width: 80px;" value="<?=sprintf('%0.2f',$setinvsubtot)?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_sub_total')" >
                                  </div>
                              </div>
                          </td>

                            <td>
                              <input type="text" name="invoice_tax<?=$invoiceId?>" id="invoice_tax<?=$invoiceId?>" class="form-control" style="width: 60px;" value="<?=$setinvtax?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_tax')" >
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_amount" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setinvamount)?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_paid" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setinvpaid)?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_balance_due" class="form-control"style="width: 80px;" value="<?=sprintf('%0.2f',$setinvbaldue)?>" disabled>
                                  </div>
                              </div>
                            </td>

                           <!--  <td><span class="label label-success">Pay</span></td> -->

                            <td><input type="text" name="invoice_tax_rate<?=$invoiceId?>" id="invoice_tax_rate<?=$invoiceId?>" class="form-control" value="<?=$setinvtaxrate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_tax_rate')" ></td>

                            <td><input type="text" name="invoice_country<?=$invoiceId?>" id="invoice_country<?=$invoiceId?>" class="form-control" value="<?=$setinvcntry?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_county')" ></td>

                            <td><input type="text" name="invoice_user<?=$invoiceId?>" id="invoice_user<?=$invoiceId?>" class="form-control" value="<?=$setinvuser?>" style="width: 60px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_user')"></td>


                            <td><a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true" ></i></a></td>

                            <td>

                          <button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> tr_clone_add"><i class="fa <?=$lstinvoiceid?>"></i></button>

                        </td>
                    </tr>

                    <?php  }
   }


  public function chk_contactinfo_id_count($id,$mobile)
	{

		$contactinfosql = $this->db->select('*')
		         ->from('user_contact_info')
		         ->where("contact_no",$mobile)
		         ->where("cus_id",$id)
		         ->get();

		if($contactinfosql->num_rows()>0)
		 {
		 	 $query = $this->db->select('*')
		         ->from('events_register')
		         ->where("cus_id",$id)
		         ->get();

		      return $query->num_rows();
		      
		 }else{

		 	 return $contactinfosql->num_rows();
		 }        
	
	}

  public function serch_get_event_data_id()
	{
		$query = $this->db->select('*')
		         ->from('events_register')
		         ->where("cus_id","0")
		         ->get();

		//return $query->result_array()[0];
	   return $query->result_array();
	}

  public function serch_get_locationt_data_id()
	{
		$query = $this->db->select('*')
		         ->from('event_location')
		         ->where("event_id","0")
		         ->get();

		return $query->result_array();
	}
  public function serch_get_crews_data_id()
	{
		$query = $this->db->select('*')
		         ->from('event_crews')
		         ->where("event_id","0")
		         ->get();

		return $query->result_array();
	}

  public function addvendor_dtls($item)
	{
		$query = $this->db->insert('register_vendor',$item);
		return $this->db->insert_id();
	}

  public function vendaddshipaddress_dtls($address)
	{
	return $this->db->insert('vender_ship_address',$address);
	}	

  public function addvendcontactdata_dtls($contact)
	{
	return $this->db->insert('vender_contact_info',$contact);
	}

  public function vendor_search_data()
	{
		/*$query = $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,user_contact_info.contact_no,user_contact_info.user_contact_note')
						 ->from('register_customer')
						 ->join("user_contact_info", "register_customer.cus_id=user_contact_info.cus_id")
						 ->where(array("user_contact_info.default_contact"=> 1))
						 ->order_by("register_customer.cus_id DESC")
						 ->get();*/

		$query = $this->db->select('register_vendor.cus_id,register_vendor.cus_fname,register_vendor.cus_lname,register_vendor.cus_company_name,register_vendor.cus_address1,register_vendor.cus_address2,register_vendor.cus_city,register_vendor.cus_state,register_vendor.cus_zip,vender_contact_info.contact_no,vender_contact_info.user_contact_note')
						 ->from('register_vendor')
						 ->join("vender_contact_info", "register_vendor.cus_id=vender_contact_info.cus_id")
						 ->where(array("vender_contact_info.default_contact"=> 1))
						 ->order_by("register_vendor.cus_id DESC")
						 ->get();

		
		return $query->result_array();
	}


  public function allVendorGeneralInfo($cName)
	{
		$id = $cName;
		$cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$contact = $this->db->where('cat_id',1)->get('sub_categories')->result_array();

		$user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
		$get_all_contacts = $user_contact->result_array();

		$user_ship = $this->db->query("SELECT * from `vender_ship_address` WHERE `ship_user_id` = '$id'");
		$shipping = $user_ship->result_array()[0];


// 		print_r($shipping);die;

			?><div class="col-md-6">

				 <div class="box box-primary">

					 <div class="box-body">

						 <div class="row">

							 <div class="col-md-12">

								 <p class="uhead2">Name</p>
								 <input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
								 <div class="form-horizontal">

									 <div class="form-group">

										 <div class="col-sm-12">

											 <select class="form-control fcap" name="title" id="title">

												 <option value="">Select Title</option>

														 <option <?php if($get_data['cus_title']=="Dr"){ echo "selected";}?> value="Dr">Dr.</option>

														 <option <?php if($get_data['cus_title']=="Mr"){ echo "selected";}?> value="Mr">Mr.</option>

														 <option <?php if($get_data['cus_title']=="Mrs"){ echo "selected";}?> value="Mrs">Mrs.</option>

														 <option <?php if($get_data['cus_title']=="Ms"){ echo "selected";}?> value="Ms">Ms.</option>
											 </select>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)"  type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_area" id="cus_area" value="<?php echo $get_data['cus_area'] ?>" type="text" placeholder="Area">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <select class="form-control fcap" name="tax_status">

												 <option value="">Select Tax Status</option>

												 <option <?if($get_data['cus_tax_status']=="1"){echo "selected";}?> value="1">Exempt</option>

												 <option <?if($get_data['cus_tax_status']=="2"){echo "selected";}?> value="2">Out of state</option>

												 <option <?if($get_data['cus_tax_status']=="3"){echo "selected";}?> value="3">Resale</option>
											 </select>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID">

										 </div>

									 </div>

								 </div>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-6">

			 <div class="box box-primary">

				 <div class="box-body">

					 <div class="row">
						 <div class="col-md-12">

							 <p class="uhead2">Contact Info</p>
							 <div class="form-horizontal">

								 <?php foreach($get_all_contacts as $allContacts) {

                                           
                                           if($allContacts['conatct_type']=="Email")
                                           	 {
                                           	 	?>

                                           	 		 <div class="cnt_clone">

									 <div class="form-group">

										 <div class="col-sm-3">

											 <select name="cuscnt_type_email[]" class="form-control fcap mailevent" required>
											
												 <?php

												 foreach ($contact as $cont) {
													 if($allContacts['conatct_type']==$cont['sub_name'])
													 {
														 $selectedcls="selected";
													 }else{
														 $selectedcls="";
													 }
													 ?>
												 <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
											 <?php  }
													?>
											
											 </select>

										 </div>

										 
										 	 <div class="col-sm-3">

												 <input class="form-control" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" value="<?php echo $allContacts['email']; ?>">

											 </div>

											 <div class="col-sm-3">

												 <a href="" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal1">Email</a>

											 </div>	


										
										
											<div class="col-sm-3">
 												
 												
 												 <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
 											 </div>
										

										 </div>

									 </div>
                                           	 	<?php
                                           	 }elseif($allContacts['conatct_type']=="Home" || $allContacts['conatct_type']=="Office" || $allContacts['conatct_type']=="Mobile"){

                                           	 	//echo "else home".$allContacts['contact_no'];
                                           	 	?>
                                           	 		
                                           	 	   <div class="cnt_clone">

									 <div class="form-group">

										 <div class="col-sm-3">

											 <select name="cus_contact_type[]" class="form-control fcap mailevent" required>
											
												 <?php

												 foreach ($contact as $cont) {
													 if($allContacts['conatct_type']==$cont['sub_name'])
													 {
														 $selectedcls="selected";
													 }else{
														 $selectedcls="";
													 }
													 ?>
												 <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
											 <?php  }
													?>
											
											 </select>

										 </div>
										 
										 	 <div class="col-sm-3">

											 <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details">

										 </div>

										 <div class="col-sm-3">

											 <input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

										 </div>
										 <?php if($allContacts['default_contact'] == 1){ ?>
											 <div class="col-sm-3">
 											
 												 <label class="switch">

 													<input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"  checked > 

 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
 											 </div>
										 <?php }else{ ?>
											 <div class="col-sm-3">
 												
 												 <label class="switch">

 													  <input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"  checked > 
 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
 											 </div>
										 <?php } ?>	

										 </div>

									 </div>

                                           	
									<?php } } ?>
								
								 

							 </div>
						 </div>
						 <!-- /.box-body -->

					 </div>

					 <!-- /.box -->

				 </div>
			 </div>

			<div class="box box-primary">
                <div class="box-body">
                 <div class="row">

                        <div class="col-md-12">
                         <!--  <div class="box box-default"> -->
                            <div class="box-body">
                              <div class="form-horizontal">
                                <div class="form-group">
                                  <div class="col-sm-6">
                                    <select class="form-control" name="apcate">
                                      <option value="">--- AP Category ---</option>
                                      <?php
                                       	$ap_cat =$this->db->where('cat_id',5)->get('sub_categories');
                                        foreach ($ap_cat->result() as $apcat_info) { 

                                        	 if($apcat_info->sub_name==$get_data['ap_cat'])
                                        	  {
                                        	  	$selapcat="selected";	
                                        	  }else{
                                        	  	  $selapcat="";
                                        	  }		

                                        	?>
                                            <option <?=$selapcat?> value="<?=$apcat_info->sub_name?>"><?=$apcat_info->sub_name?></option>

                                          <?php  } ?>

                                    </select>
                                  </div>
                                  <div class="col-sm-6">
                                    <select class="form-control" name="apsubcate">
                                      <option value="">--- AP Subcategory ---</option>
                                     <?php
                                      $ap_subcat= $this->db->where('cat_id',4)->get('sub_categories');
                                        foreach ($ap_subcat->result() as $apsubcat_info) { 

                                        	 if($apsubcat_info->sub_name==$get_data['ap_sbcat'])
                                        	  {
                                        	  	$selapsubcat="selected";	
                                        	  }else{
                                        	  	  $selapsubcat="";
                                        	  }	


                                        	?>
                                            <option <?=$selapsubcat?> value="<?=$apsubcat_info->sub_name?>"><?=$apsubcat_info->sub_name?></option>

                                          <?php  } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <!-- 
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table   table-hover no-margin">
                                    <thead>
                                      <tr>
                                        <th>Type</th>
                                        <th>Value</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <select class="form-control">
                                            <option>Select</option>
                                          </select>
                                        </td>
                                        <td>$3000</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div> -->

                            </div>
                            <!-- /.box-body -->

                         <!--  </div> -->

                          <!-- /.box -->
                        </div>

                      </div>
                    </div>
                   </div>



		 </div>
		 <div class="clearfix"></div>

		 <div class="col-md-6">

			 <div class="box box-default">

				 <div class="box-header with-border">

					   <div class="col-md-5">
                    <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                 </div>

                 <div class="col-md-5">
                    <div class="checkbox uhead2">

                    	<?php 
                    	  if($shipping['billing_addr_status']=="1")
                    	  	{
                    	  		$chkstatus="checked";
                    	  	}else{
                    	  		$chkstatus="";
                    	  	}  
                    	?>

					  <label><input <?=$chkstatus?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()" >Same as billing address</label>
					</div>
                  </div> 



					 <div class="box-tools pull-right">

						 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

						 </button>

					 </div>

					 <!-- /.box-tools -->

				 </div>

				 <!-- /.box-header -->

				 <div class="box-body"  id="billaddress" >

					 <div class="form-horizontal">

						 <div class="form-group">

							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly>

							 </div>

						 </div>

						 <div class="form-group">
							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly>

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

							 </div>

						 </div>

					 </div>

				 </div>

				 <!-- /.box-body -->

			 </div>

			 <!-- /.box -->

		 </div>
		 <?php

	}	

 
 public function getVendContactInfo_dtls($cName){

		$id = $cName;

		$venders = $this->vendor_search_data();

		// $user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE `cus_id` = '$id'" && "default_contact = '1'");
		// echo $user_contact;die;
		// $single_cust = $user_contact->result_array();

		$this->db->select('*');
		$this->db->from('vender_contact_info');
		$this->db->where('cus_id', $id);
		$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];
		// print_r($query[0]['contact_no']);die;
		?>
		<div class="col-md-12">

			<div class="box box-info">

				<div class="box-header with-border">

					<div class="row">

						<div class="col-sm-5 col-md-4">

							<h3 class="uhead1">

								VENDOR GENERAL INFO

							</h3>

						</div>

						<div class="col-sm-7 col-md-8">

							<div class="pull-right">

								<ul class="list-inline topul">

									<li><a href="#" class="uhead2"> Main Menu</a></li>

									<li><a href="#" class="uhead2"> Options </a></li>

									<!--  <li><a class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal-note"><i class="fa fa-pencil-square-o"></i> Note</a></li> -->

									<li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

								</ul>

								<a href="<?=site_url('fi_home/newVenderGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Vendor</a>

							</div>

						</div>

					</div>

				</div>

				<!-- /.box-header -->

				<div class="box-body">

					<div class="row">

						<div class="col-md-4">

							<div class="form-group">

								<select class="form-control fcap" id="cust_nm" onchange="loadcustlist()">
									<?php foreach ($venders as $cust) {

											if($_POST['name']==$cust['cus_id'])
											{
												$selectedcls="selected";
											}else{
												$selectedcls="";
											}

										 ?>
										<option <?=$selectedcls?> value="<?php echo $cust['cus_id'] ?>"><?php print_r($cust['cus_lname']." - ". $cust['cus_company_name']); ?></option>
									<?php } ?>


								</select>

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

							<input onchange="loadcustlistbyphone(this.value)" class="form-control fcap contact_no" id="phonenum" name="phonenum" type="text" value="<?php echo $query['contact_no'] ?>" placeholder="(111) 111-1111">

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

								<input class="form-control fcap" type="text" placeholder="433">

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

								<input class="form-control fcap" type="text" placeholder="$16.33">

							</div>

						</div>

						<div class="col-md-2">

							<div class="form-group">

								<input class="form-control fcap" type="text" placeholder="1">

							</div>

						</div>

							<!--  <div class="col-sm-1">
											 <button class="btn btn-xs btn-primary btn-flat">Save</button>
										 </div> -->

					</div>

				</div>

				<!-- /.box-body -->

			</div>

			<!-- /.box -->

		</div>
		<?php
	}



  public function fnloadvendlistbyphone_dtls($txtphonenum)
	{
	   
	   $user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE contact_no = '$txtphonenum'");
       
       if($user_contact->num_rows()>0)
       {

       	 $getrcrow=$user_contact->row();


		 $id = $getrcrow->cus_id;



		$cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$contact = $this->db->where('cat_id',1)->get('sub_categories')->result_array();

		$user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
		$get_all_contacts = $user_contact->result_array();

		$user_ship = $this->db->query("SELECT * from `vender_ship_address` WHERE `ship_user_id` = '$id'");
		$shipping = $user_ship->result_array()[0];


// 		print_r($shipping);die;

			?><div class="col-md-6">

				 <div class="box box-primary">

					 <div class="box-body">

						 <div class="row">

							 <div class="col-md-12">

								 <p class="uhead2">Name</p>
								 <input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
								 <div class="form-horizontal">

									 <div class="form-group">

										 <div class="col-sm-12">

											 <select class="form-control fcap" name="title" id="title">

												 <option value="">Select Title</option>

														 <option <?php if($get_data['cus_title']=="Dr"){ echo "selected";}?> value="Dr">Dr.</option>

														 <option <?php if($get_data['cus_title']=="Mr"){ echo "selected";}?> value="Mr">Mr.</option>

														 <option <?php if($get_data['cus_title']=="Mrs"){ echo "selected";}?> value="Mrs">Mrs.</option>

														 <option <?php if($get_data['cus_title']=="Ms"){ echo "selected";}?> value="Ms">Ms.</option>
											 </select>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-12">

											 <input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_zip" id="cus_zip"  value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()"

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_area" id="cus_area" value="<?php echo $get_data['cus_area'] ?>" type="text" placeholder="Area">

										 </div>

									 </div>

									 <div class="form-group">

										 <div class="col-sm-6">

											 <select class="form-control fcap" name="tax_status">

												 <option value="">Select Tax Status</option>

												<option <?if($get_data['cus_tax_status']=="1"){echo "selected";}?> value="1">Exempt</option>

												 <option <?if($get_data['cus_tax_status']=="2"){echo "selected";}?> value="2">Out of state</option>

												 <option <?if($get_data['cus_tax_status']=="3"){echo "selected";}?> value="3">Resale</option>

										 </div>

										 <div class="col-sm-6">

											 <input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID">

										 </div>

									 </div>

								 </div>
							 </div>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-6">

			 <div class="box box-primary">

				 <div class="box-body">

					 <div class="row">
						 <div class="col-md-12">

							 <p class="uhead2">Contact Info</p>
							 <div class="form-horizontal">

								 <?php foreach($get_all_contacts as $allContacts) {

									 ?>
								 <div class="cnt_clone">

									 <div class="form-group">

										 <div class="col-sm-3">

											 <select name="cus_contact_type[]" class="form-control fcap mailevent" required>
												 <!-- <option selected="<?php //echo $allContacts['conatct_type']; ?>">
													 <?php //echo $allContacts['conatct_type']; ?>
												 </option> -->
												 <?php

												 foreach ($contact as $cont) {
													 if($allContacts['conatct_type']==$cont['sub_name'])
													 {
														 $selectedcls="selected";
													 }else{
														 $selectedcls="";
													 }
													 ?>
												 <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
											 <?php  }
													?>


												 <!-- <option value="Office">Office</option>

												 <option value="Mobile">Mobile</option>

												 <option value="Summer">Summer</option>

												 <option value="Fax">Fax</option> -->


											 </select>

										 </div>


										

										 <div class="col-sm-3">

											 <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details">

										 </div>

										 <div class="col-sm-3">

											 <input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

										 </div>
										 <?php if($allContacts['default_contact'] == 1){ ?>
											 <div class="col-sm-3">
 												 <!-- <div class="radio">
 													 <label>Default</label>


 												 </div> -->
 												 <!-- <label>Default</label> -->
 												 <label class="switch">

 													 <input type="radio"  name="radio_click[]" checked>
 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
 											 </div>
										 <?php }else{ ?>
											 <div class="col-sm-3">
 												 <!-- <div class="radio">
 													 <label>Default</label>


 												 </div> -->
 												 <!-- <label>Default</label> -->
 												 <label class="switch">

 													 <input type="radio"  name="radio_click[]">
 													 <span class="slider round"></span>
 												 </label>

 												 <a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>
 											 </div>
										 <?php } ?>
										 	<!-- <div class="col-sm-3"> -->
												 <!-- <div class="radio">
													 <label>Default</label>


												 </div> -->
												 <!-- <label>Default</label> -->
												 <!-- <label class="switch">

													 <input type="checkbox"  name="radio_click[]" checked>
													 <span class="slider round"></span>
												 </label>

												 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
											 </div> -->
										 </div>

									 </div>
								 <?php } ?>
							 </div>
						 </div>
						 <!-- /.box-body -->

					 </div>

					 <!-- /.box -->

				 </div>
			 </div>

           <div class="box box-primary">
                <div class="box-body">
                 <div class="row">

                        <div class="col-md-12">
                         <!--  <div class="box box-default"> -->
                            <div class="box-body">
                              <div class="form-horizontal">
                                <div class="form-group">
                                  <div class="col-sm-6">
                                    <select class="form-control" name="apcate">
                                      <option value="">--- AP Category ---</option>
                                      <?php
                                       	$ap_cat =$this->db->where('cat_id',5)->get('sub_categories');
                                        foreach ($ap_cat->result() as $apcat_info) { 

                                        	 if($apcat_info->sub_name==$get_data['ap_cat'])
                                        	  {
                                        	  	$selapcat="selected";	
                                        	  }else{
                                        	  	  $selapcat="";
                                        	  }		

                                        	?>
                                            <option <?=$selapcat?> value="<?=$apcat_info->sub_name?>"><?=$apcat_info->sub_name?></option>

                                          <?php  } ?>

                                    </select>
                                  </div>
                                  <div class="col-sm-6">
                                    <select class="form-control" name="apsubcate">
                                      <option value="">--- AP Subcategory ---</option>
                                     <?php
                                      $ap_subcat= $this->db->where('cat_id',4)->get('sub_categories');
                                        foreach ($ap_subcat->result() as $apsubcat_info) { 

                                        	 if($apsubcat_info->sub_name==$get_data['ap_sbcat'])
                                        	  {
                                        	  	$selapsubcat="selected";	
                                        	  }else{
                                        	  	  $selapsubcat="";
                                        	  }	


                                        	?>
                                            <option <?=$selapsubcat?> value="<?=$apsubcat_info->sub_name?>"><?=$apsubcat_info->sub_name?></option>

                                          <?php  } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <!-- 
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table   table-hover no-margin">
                                    <thead>
                                      <tr>
                                        <th>Type</th>
                                        <th>Value</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <select class="form-control">
                                            <option>Select</option>
                                          </select>
                                        </td>
                                        <td>$3000</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div> -->

                            </div>
                            <!-- /.box-body -->

                         <!--  </div> -->

                          <!-- /.box -->
                        </div>

                      </div>
                    </div>
                   </div>


			 

		 </div>
		 <div class="clearfix"></div>

		 <div class="col-md-6">

			 <div class="box box-default">

				 <div class="box-header with-border">

					    <div class="col-md-5">
                    <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                 </div>

                 <div class="col-md-5">
                    <div class="checkbox uhead2">
                    	<?php 
                    	  if($shipping['billing_addr_status']=="1")
                    	  	{
                    	  		$chkstatus="checked";
                    	  	}else{
                    	  		$chkstatus="";
                    	  	}  
                    	?>

					  <label><input <?=$chkstatus?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()" >Same as billing address</label>
					</div>
                  </div> 



					 <div class="box-tools pull-right">

						 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

						 </button>

					 </div>

					 <!-- /.box-tools -->

				 </div>

				 <!-- /.box-header -->

				 <div class="box-body" id="billaddress">

					 <div class="form-horizontal">

						 <div class="form-group">

							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly>

							 </div>

						 </div>

						 <div class="form-group">
							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly>

							 </div>


							 <div class="col-sm-4">

								 <input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

							 </div>

						 </div>

					 </div>

				 </div>

				 <!-- /.box-body -->

			 </div>

			 <!-- /.box -->

		 </div>
		 <?php


       }

       
	}


   public function up_addvendor($item,$up_id)
	{
		$id = $up_id;
		$this->db->where('cus_id', $id);
		$this->db->update('register_vendor', $item);
		return true;
	}

	public function up_addvendshipaddress($address,$up_id)
	{
		$cusid = $up_id;
		$this->db->where('ship_user_id', $cusid);
		$this->db->update('vender_ship_address', $address);
		return true;
	}

   public function del_addvendcontactdata($up_id)
	{
		$cusid = $up_id;
		$this->db->where('cus_id', $cusid);
	    $this->db->delete('vender_contact_info');
	}

	public function fnvendersrchbyph_dtls($phone)
	{
		error_reporting(0);
          
	   $contactinfosql = $this->db->query("SELECT * from vender_contact_info WHERE contact_no = '$phone'");
       if($contactinfosql->num_rows()>0)
        {
         
         $getcntrow=$contactinfosql->row();
         $id = $getcntrow->cus_id;
	

		$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '$id'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 }


  	  $cust1 = $this->db->query("SELECT * from vender_contact_info AS c,register_vendor AS r WHERE c.cus_id = r.cus_id AND c.contact_no = '$phone' GROUP BY c.cus_id");

		  foreach ($cust1->result() as $cust1_dtls) 
		  {
		 
		 
		?>

			<tr>

				<td><?="1"; ?></td>

				<td><?= $cust1_dtls->cus_title?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_fname?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_lname?></td>

				<td><?= $cust1_dtls->cus_company_name?></td>

				<td><?= $cust1_dtls->cus_address1?></td>
				<td><?= $cust1_dtls->cus_address2?></td>
				<td><?= $cust1_dtls->cus_city?></td>
				<td><?= $cust1_dtls->cus_state?></td>
				<td><?= $cust1_dtls->cus_zip?></td>
				<td><?= $cust1_dtls->cus_area?></td>
				<td><?=trim($htmlphone,",")?></td>
				<td><?=trim($htmlnotes,",")?></td>
				
			</tr>


	<?php }

        }else{

        	echo "No Vendors Found..!";

        }     
        	     
	}

  public function allSearchVendInfo($cName)
	{

		$id = $cName;
    	$this->db->select('*');
		$this->db->from('vender_contact_info');
		$this->db->where('cus_id', $id);
		$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];
		// print_r($query[0]['contact_no']);die;
		?>
		<input class="form-control fcap contact_no" onchange="fncustomersearchbyphone(this.value)" type="text" id="topphone" name="topphone" value="<?php echo $query['contact_no'] ?>" placeholder="(111) 111-1111" >
	 <?php 
   }

    public function search_vender($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area,$apcate,$apsubcate)
	{
		error_reporting(0);

	
		 $con1="";
			if ($fname !="")
			{
			  //$con1='o.cus_fname ="'.$fname.'"';
				$con1='o.cus_fname LIKE "%'.$fname.'%"';
			}

			if ($lname !="")
			{
			if($con1!="")
			{
			  //$con1= $con1 ." OR ".'o.cus_lname = "'.$lname.'"';
				$con1= $con1 ." OR ".'o.cus_lname LIKE "%'.$lname.'%"';
			}
			else{
			  //$con1='o.cus_lname = "'.$lname.'"';
			   $con1='o.cus_lname LIKE "%'.$lname.'%"';	
			}

			}

			if ($cname !="")
			{
			if($con1!="")
			{
			  //$con1= $con1 ." OR ".'o.cus_company_name = "'.$cname.'"';
				$con1= $con1 ." OR ".'o.cus_company_name LIKE "%'.$cname.'%"';
			}
			else{
			  //$con1='o.cus_company_name = "'.$cname.'"';
				$con1='o.cus_company_name LIKE "%'.$cname.'%"';
			}

			}

			if ($zname !="")
			{
			if($con1!="")
			{
			 //$con1= $con1 ." OR ".'o.cus_zip = "'.$zname.'"';
				$con1= $con1 ." OR ".'o.cus_zip LIKE "%'.$zname.'%"';
			}
			else{
			   //$con1='o.cus_zip = "'.$zname.'"';
			    $con1='o.cus_zip LIKE "%'.$zname.'%"';
			}

			}

			if ($mname !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'c.contact_no ="'.$mname.'"';
					$con1= $con1 ." OR ".'c.contact_no LIKE "%'.$mname.'%"';
				}
				else{
					//$con1='c.contact_no ="'.$mname.'"';
					$con1='c.contact_no LIKE "%'.$mname.'%"';
				}
			}

			if ($adr1 !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_address1 ="'.$adr1.'"';
					$con1= $con1 ." OR ".'o.cus_address1 LIKE "%'.$adr1.'%"';
				}
				else{
					//$con1='o.cus_address1 ="'.$adr1.'"';
					$con1='o.cus_address1 LIKE "%'.$adr1.'%"';
				}
			}

			if ($adr2 !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_address2 ="'.$adr2.'"';
					$con1= $con1 ." OR ".'o.cus_address2 LIKE "%'.$adr2.'%"';
				}
				else{
					//$con1='o.cus_address2 ="'.$adr2.'"';
					$con1='o.cus_address2 LIKE "%'.$adr2.'%"';
				}
			}

			if ($cities !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_city ="'.$cities.'"';
					$con1= $con1 ." OR ".'o.cus_city LIKE "%'.$cities.'%"';
				}
				else{
				  	//$con1='o.cus_city ="'.$cities.'"';
				  	$con1='o.cus_city LIKE "%'.$cities.'%"';
				}
			}

			if ($states !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_state ="'.$states.'"';
					$con1= $con1 ." OR ".'o.cus_state LIKE "%'.$states.'%"';
				}
				else{
					//$con1='o.cus_state ="'.$states.'"';
					$con1='o.cus_state LIKE "%'.$states.'%"';
				}
			}

			if ($area !="")
			{
				if($con1!="")
				{
					//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';
					$con1= $con1 ." OR ".'o.cus_area LIKE "%'.$area.'%"';
				}
				else{
					//$con1='o.cus_area ="'.$area.'"';
					$con1='o.cus_area LIKE "%'.$area.'%"';
				}
			}

			if ($apcate !="")
			{
				if($con1!="")
				{
				  //$con1= $con1 ." OR ".'o.cus_lname = "'.$lname.'"';
					$con1= $con1 ." OR ".'o.ap_cat LIKE "%'.$apcate.'%"';
				}
				else{
				  //$con1='o.cus_lname = "'.$lname.'"';
				   $con1='o.ap_cat LIKE "%'.$apcate.'%"';	
				}

			}


			if ($apsubcate !="")
			{
				if($con1!="")
				{
				  //$con1= $con1 ." OR ".'o.cus_lname = "'.$lname.'"';
					$con1= $con1 ." OR ".'o.ap_sbcat LIKE "%'.$apsubcate.'%"';
				}
				else{
				  //$con1='o.cus_lname = "'.$lname.'"';
				   $con1='o.ap_sbcat LIKE "%'.$apsubcate.'%"';	
				}

			}


		 $cust1 = $this->db->query("SELECT * from vender_contact_info AS c,register_vendor AS o WHERE ".$con1." AND c.cus_id = o.cus_id  GROUP BY o.cus_id");

		 if($cust1->num_rows()>0)
		 {

		  foreach ($cust1->result() as $cust1_dtls) 
		  {
		           


		$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '".$cust1_dtls->cus_id."'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 } 
		 
		?>

			<tr>

				<td><?="1"; ?></td>

				<td><?= $cust1_dtls->cus_title?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_fname?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_lname?></td>

				<td><?= $cust1_dtls->cus_company_name?></td>

				<td><?= $cust1_dtls->cus_address1?></td>
				<td><?= $cust1_dtls->cus_address2?></td>
				<td><?= $cust1_dtls->cus_city?></td>
				<td><?= $cust1_dtls->cus_state?></td>
				<td><?= $cust1_dtls->cus_zip?></td>
				<td><?= $cust1_dtls->cus_area?></td>
			    <td><?=trim($htmlphone,",")?></td>
				<td><?=trim($htmlnotes,",")?></td> 

				
			</tr>


	<?php }

        }else{

        	echo "No Vendors Found..!";

        }     

	}

  public function getVenderSearchInfo_dtls($cName)
	{
		$id = $cName;
		$cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$this->db->select('*');
		$this->db->from('vender_contact_info');
		$this->db->where('cus_id', $id);
		//$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];


		$phonarr=array();
		$notesarr=array();
		$cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '$id'");
		foreach ($cntinfosql->result() as $cntinfosql) 
		{
			 $phonarr[].=$cntinfosql->contact_no;
			 $notesarr[].=$cntinfosql->user_contact_note;
		}

         $setnotes=implode(",",$notesarr);

        if(count($setnotes)==1){
		 	$htmlnotes=$setnotes;
		 }else{
		 	$htmlnotes=explode(",",$setnotes);
		 }

		 $setphones=implode(",",$phonarr);

		 if(count($setphones)==1){
		 	$htmlphone=$setphones;
		 }else{
		 	$htmlphone=explode(",",$setphones);
		 }

		?>

			<tr>

				<td><?="1"; ?></td>

				<td><?= $get_data['cus_title']?></td>

				<td style="text-transform:capitalize;"><?= $get_data['cus_fname']?></td>

				<td style="text-transform:capitalize;"><?= $get_data['cus_lname']?></td>

				<td><?= $get_data['cus_company_name']?></td>

				<td><?= $get_data['cus_address1']?></td>
				<td><?= $get_data['cus_address2']?></td>
				<td><?= $get_data['cus_city']?></td>
				<td><?= $get_data['cus_state']?></td>
				<td><?= $get_data['cus_zip']?></td>
				<td><?= $get_data['cus_area']?></td>
				<td><?=trim($htmlphone,",")?></td>
				<td><?=trim($htmlnotes,",")?></td>
				
			</tr>

	<?php

	}

   public function get_vend_event_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('vendor_events_register')
		         ->where(array("cus_id"=>$id))
		         ->get();

		//return $query->result_array()[0];
	   return $query->result_array();
	}

	public function get_vend_locationt_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('vendor_event_location')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}
	public function get_vend_crews_data_id($id)
	{
		$query = $this->db->select('*')
		         ->from('vendor_event_crews')
		         ->where(array("event_id"=>$id))
		         ->get();

		return $query->result_array();
	}

	public function check_vend_event_id($id,$cdt)
	{
		$query = $this->db->select('*')
		         ->from('vendor_events_register')
		         ->where(array("cus_id"=>$id,"event_date"=>$cdt))
		         ->get();

		return $query->num_rows();
	}

   public function insertvendorevent($data)
	{
		$query = $this->db->insert('vendor_events_register',$data);
		return $this->db->insert_id();
	}
   public function insertvendorlocation($location)
	{
		return $this->db->insert('vendor_event_location',$location);
	}
   public function insertvendorcrew($crew)
	{
		return $this->db->insert('vendor_event_crews',$crew);
	}	

   function fndelvendoreventinfo_dtls()
    {
    	$this->db->where('event_id',$this->input->post('eventId'));
    	$this->db->where('cus_id',$this->input->post('cusId'));
    	if($this->db->delete('vendor_events_register'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }		
   
   function fndelvendorlocationinfo_dtls()
    {
    	$this->db->where('location_id',$this->input->post('locId'));
    	$this->db->where('event_id',$this->input->post('eventId'));
    	if($this->db->delete('vendor_event_location'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

   function fndelvendorcrewsinfo_dtls()
    {
    	$this->db->where('crews_id',$this->input->post('crewId'));
    	$this->db->where('event_id',$this->input->post('eventId'));
    	if($this->db->delete('vendor_event_crews'))
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

   function fniteminfojson_dtls()
    {
	  	$itmjson;
	    $itemssql=$this->db->query("SELECT * FROM admin_item WHERE item_id='".$_POST['itemId']."'");

	    foreach($itemssql->result() as $itemssql_dtls)
	    {
	    	$itmjson['itemlist']=$itemssql_dtls;
	    }

	     echo json_encode($itmjson);
    }

    function upditemdesc_dtls()
    {

    	$updateitemdescarr=array(

    		 "item_desc"  => $this->input->post('itemdesc')
    	  );

    	$this->db->where('id',$this->input->post('txtinpid'));
    	if($this->db->update('customers_package_items',$updateitemdescarr))/*admin_package_item*/
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }



    function upditemamt_dtls()
    {

    	$updateitemamountarr=array(

    		 "item_price"  => $this->input->post('itemamt')
    	  );

    	$this->db->where('id',$this->input->post('txtinpid'));
    	if($this->db->update('customers_package_items',$updateitemamountarr))/*admin_package_item*/
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }

    function getvendorlist_dtls()
    {

    	$vendjson;
	    $vendorsql=$this->db->query("SELECT * FROM register_vendor WHERE ap_sbcat='".$_POST['crwtype']."' ORDER BY cus_id ASC");
	    if($vendorsql->num_rows()>0)
	    {
	    	  foreach($vendorsql->result() as $vendorsql_dtls)
			    {
			    	$vendjson['vendorlist'][]=$vendorsql_dtls;
			    }

			     echo json_encode($vendjson);
	    }else{

	    	$vendjson['vendorlist'][]="";
	    	echo json_encode($vendjson);

	    }
	  

    }


 function fnpckitems_dtls()
  {

  	error_reporting(0);
    $pckitmsql=$this->db->query("SELECT i.id,i.term_name FROM admin_contract_terms AS i,admin_contract_type AS p WHERE i.contract_id=p.contract_id AND i.contract_id='".$_POST['pckId']."' AND p.contract_id='".$_POST['pckId']."' ORDER BY id ASC");


     $chkitmsql=$this->db->query("SELECT * FROM admin_contract_terms WHERE contract_id='".$_POST['pckId']."' ORDER BY id DESC LIMIT 1"); 
     $isitmsrow=$chkitmsql->row(); 

   if($pckitmsql->num_rows()>0)
    {

    	$srno=1;
	    foreach($pckitmsql->result() as $pckitmsql_dtls)
	    {
	    
	    		$itmId=$pckitmsql_dtls->id;
	    	     if($isitmsrow->id==$itmId)
                      {
                        $lstinvoiceid="fa-plus";
                        $lstinvoicecls="btn-success";
                        $fninvoce="fncrpitem('".$pckitmsql_dtls->id."')";
                      }else{

                        $lstinvoiceid="fa-minus";
                        $lstinvoicecls="btn-danger";
                        $fninvoce="fndelpitem('".$pckitmsql_dtls->id."')";
                      }
                      //fnupdateitmsinfo
	    	?>

	    	<tr class="tr_clone auto-index"><td class="increment"><?=$srno?></td>
	    		
	    	<td>
	    		<input type="text" class="form-control" onchange="fnupdateitemdescp(this.value,'<?=$itmId?>')" name="item_name<?=$itmId?>" id="i2<?=$itmId?>" value="<?=$pckitmsql_dtls->term_name?>">
	    	</td>

	      

	    	<td><button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> "><i class="fa <?=$lstinvoiceid?>"></i></button></td><td><input type="hidden" name="pcktot" id="pcktot" value="<?=sprintf('%0.2f',$pckitmsql_dtls->package_price)?>"></td></tr>

	    	<?php $srno++;

	    }
     
     }
  } 


   function crnewpitem_dtls()
    {
    	
    		$postitemsarr=array(
    		    "contract_id" => $_POST['pckId'],
    		  );

		  if($this->db->insert('admin_contract_terms',$postitemsarr)) //admin_package_item
     	    {
     	    	echo "success";
     	    }else{
     	    	echo "error";
     	    }

    }

  function delnewpitem_dtls()
    {
    	$this->db->where('id',$this->input->post('itmId'));
    	if($this->db->delete('admin_contract_terms'))  //admin_package_item
    	{

    	  echo "success";
    	}else{
			echo "error";
    	}
    }


   function upditemsinfo_dtls()
    {

    	$updatepckinfoarr=array(

    		 "package_id"  => $this->input->post('pckId'),
    		 "item_name"  => $this->input->post('admpckId'),
    		 "item_quantity"  => 1,
    		 "item_price"  => $this->input->post('item_price'),
    		 "item_desc"  => $this->input->post('item_desc'),
    	  );

    	$this->db->where('id',$this->input->post('txtinpid'));
    	if($this->db->update('admin_package_item',$updatepckinfoarr))/*admin_package_item*/
    	{

    		$getadmpcksql=$this->db->query("SELECT SUM(item_price) AS item_price FROM admin_package_item WHERE package_id='".$this->input->post('pckId')."'");
    	     $getpckrow=$getadmpcksql->row();
    	     $packtot=$getpckrow->item_price;

    		$updtpacktot=array(

    			"package_price" => $packtot
    		);

    		$this->db->where('package_id',$this->input->post('pckId'));
    		$this->db->update('admin_package',$updtpacktot);


    		echo "success";
    	}else{
			echo "error";
    	}
    }

   function upditemsamnt_dtls()
    {

    	$updateitemamountarr=array(

    		 "item_price"  => $this->input->post('itemamt')
    	  );

    	$this->db->where('id',$this->input->post('txtinpid'));
    	if($this->db->update('admin_package_item',$updateitemamountarr))/*admin_package_item*/
    	{

    		$getadmpcksql=$this->db->query("SELECT SUM(item_price) AS item_price FROM admin_package_item WHERE package_id='".$this->input->post('pckId')."'");
    	     $getpckrow=$getadmpcksql->row();
    	     $packtot=$getpckrow->item_price;

    		$updtpacktot=array(

    			"package_price" => $packtot
    		);

    		$this->db->where('package_id',$this->input->post('pckId'));
    		$this->db->update('admin_package',$updtpacktot);

    		echo "success";
    	}else{
			echo "error";
    	}
    }

   function upditemsdescrp_dtls()
    {

    	$updateitemdescarr=array(

    		 "term_name"  => $this->input->post('itemdesc')
    	  );

    	$this->db->where('id',$this->input->post('txtinpid'));
    	if($this->db->update('admin_contract_terms',$updateitemdescarr))/*admin_package_item*/
    	{
    		echo "success";
    	}else{
			echo "error";
    	}
    }


   function updtpackagetot_dtls()
    {
 
			
			$updtpacktot=array(

				"package_price" => $this->input->post('ptot')
			);

		 $this->db->where('package_id',$this->input->post('pckId'));
		 if($this->db->update('admin_package',$updtpacktot))
		   {

	    		echo "success";
	       }else{
				echo "error";
	    	}
    }

   function delselpackage_dtls()
    {
    	$this->db->where('contract_id',$this->input->post('pckId'));
    	if($this->db->delete('admin_contract_type'))  //admin_package_item
    	{

    		$this->db->where('contract_id',$this->input->post('pckId'));
    		$this->db->delete('admin_contract_terms');  //admin_package

    		echo "success";
    	}else{
			echo "error";
    	}
    }
 


}
