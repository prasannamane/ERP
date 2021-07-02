<?php
     class Vendor_attachment_Model extends CI_Model 
     {

          public function __construct()
          {
               parent::__construct();
          //initialise the autoload things for this class
          }
     
          public function fnsearchcustattchment_dtls()
	     {
               $cus_id = $this->input->post('cus_id');
	          $singleattchsql = $this->db->query("SELECT * FROM vend_attachment WHERE cust_id='".$cus_id."' ORDER BY id DESC LIMIT 1");
	          $attchsqlrow = $singleattchsql->row();

	          $attchsql = $this->db->query("SELECT * FROM vend_attachment WHERE cust_id='".$cus_id."' ORDER BY id ASC");
	          $attchsql_nrows = $attchsql->num_rows();

	          if($attchsql_nrows>0)
	          {
                    foreach ($attchsql->result() as $attchsql_dtls) 
                    {
                         $attamentId=$attchsql_dtls->id;



	            if($attchsqlrow->id==$attamentId)
	            {
	                $lstinvoiceid="fa-plus";
	                $lstinvoicecls="btn-success";
	                $fninvoce="fncrattachment('".$attamentId."')";
	            }else{

	                $lstinvoiceid="fa-minus";
	                $lstinvoicecls="btn-danger";
	                $fninvoce="fndelattachment('".$attamentId."')";
	             }


	            if($attchsql_dtls->attach_file_size!="")
	             {
	                  $filesize=$attchsql_dtls->attach_file_size;
	             }else{
	                  $filesize="";
	             }

	            
	            if($attchsql_dtls->attach_file_type!="")
	             {
	                  $filetype=$attchsql_dtls->attach_file_type;
	             }else{
	                  $filetype="";
	             }


	             if($attchsql_dtls->attach_file_name!="")
	             {
	                  $filename="http://tech599.com/tech599.com/johnsum/admin/uploads/vendor_attachments/".$attchsql_dtls->attach_file_name;

	                  $target="target='_blank'";

	                  $fname=$attchsql_dtls->attach_file_name;

	             }else{
	                  $filename="#";
	                  $target="";
	                   $fname="";

	             }


	            if($attchsql_dtls->date!="")
	             {
	                  $date=$attchsql_dtls->date;

	             }else{
	                  $date=date('Y-m-d');
	                 
	             }



	           if($attchsql_dtls->note!="")
	             {
	                  $note=$attchsql_dtls->note;

	             }else{
	                  $note="";
	                 
	             }


            if($attchsql_dtls->attach_file_name!="")
               {
                    $atfilename=$attchsql_dtls->attach_file_name;
               }else{
                    $atfilename="";
               }

               ?>

              <tr>
                 <td colspan="11">

              <form name="frmattachment<?=$attamentId?>" id="frmattachment<?=$attamentId?>" action="<?=site_url('vendor_attachment/fnupdateattchment')?>" method="POST" enctype="multipart/form-data">

                  <table style="width: 100%; " class="table   table-hover no-margin" >

              <tr class="tr_clone">

               <!--  <td>1</td> -->

                <td class="w95">
                  <input type="date" name="date" id="date" value="<?=$date?>" class="form-control endate" style="width: 89px;"></td>

                <td>
                  <input type="text" name="notes" id="notes"  value="<?=$note?>" class="form-control" placeholder=""  style="width: 89px;">
                </td>

                <td class="w80"><a  class="btn btn-xs btn-primary" style="width: 50px;">Scan</a></td>

                <td class="w90">
                  <span class="filebtn" style=" display: inline-block; ">
                    <input class="btn btn-xs btn-primary image" type="file" name="image" id="image"  style="width:90%;" >
                   </span> 
                  <label for="image" style="font-weight: 400;"><?=$fname?></label>
                   <input type="hidden" name="hdnattId" id="hdnattId"  value="<?=$attamentId?>" class="form-control hdnattId" >
                </td>

                <td class="w80"><a href="<?=$filename?>" <?=$target?> class="btn btn-xs btn-primary" style="width: 50px;">Show</a></td>

                <td><span style=" max-width: 89px; "><?=$atfilename?></span></td>

                <td class="w95"><span style=" max-width: 89px; "><?=$filesize?></span></td>

                <td class="w95"><span  style=" max-width: 89px; "><?=$filetype?></span></td>

                <td class="w80"><a class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#myModal" style="width: 50px;">Email</a></td>

                 <td class="w95"><span style=" max-width: 30px; "><?=$attamentId?></span></td>

                <td class="w95">
                  <input type="hidden" name="hdnattchId" id="hdnattchId" value="<?=$attamentId?>">
                 <button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?>"><i class="fa <?=$lstinvoiceid?>"></i></button><!-- tr_clone_add -->
                </td>

              </tr>
            </table>

            </form>
          </td>
        </tr>

            <?php } }else{

                  echo "<tr><td colspan='17'>No Attachments Found..!</td></tr>";

            }
	}


	public function search_data()
	{
		$query = $this->db->select('register_vendor.cus_id,register_vendor.cus_fname,register_vendor.cus_lname,register_vendor.cus_company_name,register_vendor.cus_address1,register_vendor.cus_address2,register_vendor.cus_city,register_vendor.cus_state,register_vendor.cus_zip,vender_contact_info.contact_no,vender_contact_info.user_contact_note')
						 ->from('register_vendor')
						 ->join("vender_contact_info", "register_vendor.cus_id=vender_contact_info.cus_id")
						 ->where(array("vender_contact_info.default_contact"=> 1))
						 ->order_by("register_vendor.cus_id DESC")
						 ->get();

		return $query->result_array();
	}



	function fncrevntattachment_dtls()
	{
		$postattchvarr=array(
		     "cust_id" => $_POST['customrId'],
		   );
		 if($this->db->insert('vend_attachment',$postattchvarr))
		 {
		 	echo "success";
		 }
	}


	function fndeleteattachment_dtls()
	 {

		$this->db->where('id',$_POST['attachmentId']);
		if($this->db->delete('vend_attachment'))
		{
			echo "success";
		}

	}

	function fnupdateattchment_dtls($usersdata)
	{
				$this->db->where('id',$_POST['hdnattchId']);	
		return $this->db->update('vend_attachment',$usersdata);
	}



   function fnsearchattchmentsbyph_dtls()
    {

    	  error_reporting(0);

      $user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE contact_no = '".$_POST['phone']."' AND cus_id='".$_POST['custid']."'");
       
       if($user_contact->num_rows()>0)
       {

       	 $getrcrow=$user_contact->row();


		 $id = $getrcrow->cus_id;

           $singleattchsql=$this->db->query("SELECT * FROM vend_attachment WHERE cust_id='".$id."' ORDER BY id DESC LIMIT 1");
           $attchsqlrow=$singleattchsql->row();

           $attchsql=$this->db->query("SELECT * FROM vend_attachment WHERE cust_id='".$id."' ORDER BY id ASC");

           $attchsql_nrows=$attchsql->num_rows();

         if($attchsql_nrows>0)
          {


           foreach ($attchsql->result() as $attchsql_dtls) {

              $attamentId=$attchsql_dtls->id;



            if($attchsqlrow->id==$attamentId)
            {
                $lstinvoiceid="fa-plus";
                $lstinvoicecls="btn-success";
                $fninvoce="fncrattachment('".$attamentId."')";
            }else{

                $lstinvoiceid="fa-minus";
                $lstinvoicecls="btn-danger";
                $fninvoce="fndelattachment('".$attamentId."')";
             }


            if($attchsql_dtls->attach_file_size!="")
             {
                  $filesize=$attchsql_dtls->attach_file_size;
             }else{
                  $filesize="";
             }

            
            if($attchsql_dtls->attach_file_type!="")
             {
                  $filetype=$attchsql_dtls->attach_file_type;
             }else{
                  $filetype="";
             }


             if($attchsql_dtls->attach_file_name!="")
             {
                  $filename="http://tech599.com/tech599.com/johnsum/admin/uploads/vendor_attachments/".$attchsql_dtls->attach_file_name;

                  $target="target='_blank'";

                  $fname=$attchsql_dtls->attach_file_name;

             }else{
                  $filename="#";
                  $target="";
                   $fname="";

             }


            if($attchsql_dtls->date!="")
             {
                  $date=$attchsql_dtls->date;

             }else{
                  $date=date('Y-m-d');
                 
             }



           if($attchsql_dtls->note!="")
             {
                  $note=$attchsql_dtls->note;

             }else{
                  $note="";
                 
             }

           ?>

              <form name="frmattachment<?=$attamentId?>" id="frmattachment<?=$attamentId?>" action="<?=site_url('vendor_attachment/fnupdateattchment')?>" method="POST" enctype="multipart/form-data">

              <tr class="tr_clone">

               <!--  <td>1</td> -->

                <td>
                  <input type="date" name="date" id="date" value="<?=$date?>" class="form-control endate"></td>

                <td>
                  <input type="text" name="notes" id="notes"  value="<?=$note?>" class="form-control" placeholder="" >
                </td>

                <td><a  class="btn btn-xs btn-primary">Scan</a></td>

                <td><input class="btn btn-xs btn-primary" type="file" name="image" id="image" onchange="fnuploadattchment('<?=$attamentId?>')"  >
                  <label for="image" style="font-weight: 400;"><?=$fname?></label>
                </td>

                <td><a href="<?=$filename?>" <?=$target?> class="btn btn-xs btn-primary">Show</a></td>

                <td><?=$filesize?></td>

                <td><?=$filetype?></td>

                <td><a class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#myModal">Email</a></td>

                <td><?=$attamentId?></td>

                <td>
                  <input type="hidden" name="hdnattchId" id="hdnattchId" value="<?=$attamentId?>">
                 <button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?>"><i class="fa <?=$lstinvoiceid?>"></i></button><!-- tr_clone_add -->
                </td>

              </tr>
            </form>

            <?php } }else{

                  echo "<tr><td colspan='17'>No Attachments Found..!</td></tr>";

            }

          }else{

                  echo "<tr><td colspan='17'>No Attachments Found..!</td></tr>";

            }  
    }	


}