<?php

     class Attachment_Model extends CI_Model 
     {

          public function __construct()
          {
		     parent::__construct();
          }

          public function fnsearchcustattchment_dtls()
	     {
               $singleattchsql     = $this->db->query("SELECT * FROM cus_attachment WHERE cust_id='".$_POST['custid']."' ORDER BY id DESC LIMIT 1");
	          $attchsqlrow        = $singleattchsql->row();
               $attchsql           = $this->db->query("SELECT * FROM cus_attachment WHERE cust_id='".$_POST['custid']."' ORDER BY id ASC");
               $attchsql_nrows     = $attchsql->num_rows();
               $attchRes           = $attchsql->result();
               /* ?>
               <tr><td colspan="8"><?php print_r($attchRes); ?></td></tr>
               <?php */
               

               if($attchsql_nrows > 0)
	          {
                    foreach ($attchRes as $attchsql_dtls) 
                    {
                         $attamentId    = $attchsql_dtls->id;
	                    $cusId         = $attchsql_dtls->cust_id;

                         if($attchsqlrow->id == $attamentId)
	                    {
	                         $lstinvoiceid  = "fa-plus";
	                         $lstinvoicecls = "btn-success";
	                         $fninvoce      = "fncrattachment('".$cusId."')";
                         }
                         else
                         {
                              $lstinvoiceid="fa-minus";
	                         $lstinvoicecls="btn-danger";
	                         $fninvoce="fndelattachment('".$attamentId."')";
	                    }

                         if($attchsql_dtls->attach_file_client_name!="")
                         {
                              $fileName = explode(".",$attchsql_dtls->attach_file_client_name);
                              $atfilename = $fileName[0];
						// $this->session->set_userdata("uploaded_filne_name",$atfilename);
                         }
                         else
                         {
                              $atfilename = "";
                         }

                         if($attchsql_dtls->attach_file_size!="")
	                    {
	                         $filesize=$attchsql_dtls->attach_file_size;
                         }
                         else
                         {
	                         $filesize="";
	                    }

                         if($attchsql_dtls->attach_file_type!="")
                         {
                              $filetype=$attchsql_dtls->attach_file_type;
                         }
                         else
                         {
                              $filetype="";
                         }

                         if($attchsql_dtls->attach_file_name!="")
                         {
					     $filename=base_url()."uploads/customer_attachments/".$attchsql_dtls->attach_file_name;
	                         $target="target='_blank'";
                              $fname=$attchsql_dtls->attach_file_name;
                         }
                         else
                         {
	                         $filename="#";
	                         $target="";
	                         $fname="";
	                    }

                         if($attchsql_dtls->date!="")
                         {
                              $date = date("m/d/Y", strtotime($attchsql_dtls->date));
                         }
                         else
                         {
                              $date = date('m/d/Y');
                         }

                         if($attchsql_dtls->note!="")
                         {
                              $note=$attchsql_dtls->note;
                         }else{
                              $note="";
                         }

                         $frmarray=array(
                              "id" => 'frmattachment'.$attamentId,
                              "name" => 'frmattachment'.$attamentId
                         );
                         ?>
                         <tr>
                              <td colspan="11" style="padding: 0">
                              <form name="frmattachment<?=$attamentId?>" id="frmattachment<?=$attamentId?>" action="<?=site_url('attachment/fnupdateattchment')?>" method="POST" enctype="multipart/form-data">
                                   <table style="width: 100%; " class="table   table-hover no-margin" >
                                        <tr class="tr_clone">
                                             <td  class="table_col1">
                                                  <input type="text" name="date" id="date" value="<?=$date?>" placeholder="mm/dd/yyyy" class="form-control endate"  style=" ">
                                             </td>

                                             <td  class="table_col2" style=" text-align: left;">
									     <input type="text" class="attachfile_name form-control" style="  display:inline-block;" name="attachfile_name" value="<?=$atfilename?>">
									</td>

                                             <td  class="table_col3">
                                                  <span class="inblock" style=" ">
                                                       <a href="<?=base_url('assets/')?>plugins/scanner/index.html" target="_blank" class="btn btn-xs btn-primary"  style="   ">Scan</a>
                                                  </span>
                                             </td>

                                             <td  class="table_col4">
                                                  <span class="filebtn" style=" display: inline-block; ">
					                              <input class="btn btn-xs btn-primary image" type="file" name="image" id="image" style="width:90%;">
                                                  </span>
                                                  <input type="hidden" name="hdnattId" id="hdnattId"  value="<?=$attamentId?>" class="form-control hdnattId" >
                                             </td>
        
                                             <td  class="table_col5">
                                                  <span class="inblock"> 
                                                       <a href="<?=$filename?>" <?=$target?> class="btn btn-xs btn-primary 1" style="">Show</a> 
                                                  </span>
                                             </td>

			                              <?php $cus_id=$this->session->userdata('id'); ?>
                                             <td  class="table_col6" style=" text-align: left; "><span style=" display: inline-block;" ><a class="btn btn-xs btn-primary" data-toggle="modal" data-id="<?=$target ?>" data-name="<?=$atfilename  ?>" onclick="test('<?=$filename ?>','<?=$atfilename  ?>','<?= $cus_id?>');" data-target="#myModal">Email</a></span></td>
                                             <td  class="table_col7" style="  text-align: left;"><span style=" display: inline-block;"><?=$filetype?></span></td>
                                             <td  class="table_col8" style=" text-align: left;"><span style=" display: inline-block;"><?=$filesize?></span></td>
                                             <td  class="table_col9 attach_id"><span style=" display: inline-block;"><?=$attamentId?></span></td>
                                             <td  class="table_col10">
                                                  <input type="text" name="notes" id="notes"  value="<?=$note?>" class="form-control notes updwn" placeholder=""  style=" ">
                                                  <input type="hidden" class="hdnattchid" name="hdnattchid" id="hdnattchid" value="<?=$attamentId?>">
                                             </td>
                                             <td  class="table_col11">
                                                  <input type="hidden" name="hdnattchId" id="hdnattchId" value="<?=$attamentId?>">
                                                  <span style=" display: inline-block;"> <button  onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?>"><i class="fa <?=$lstinvoiceid?>"></i></button></span> <!-- tr_clone_add -->
                                             </td>
                                        </tr>
                                   </table>
                              </form>
                              </td>
                         </tr>
                         <?php 
                    } 
               }
               else
               {
                  echo "<tr><td colspan='11'>No Attachments Found..!</td></tr>";
               }
	     }

          public function fnsearchattchmentsbyph_dtls()
          {
               $user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE contact_no = '".$_POST['phone']."' AND cus_id='".$_POST['custid']."'");
               if($user_contact->num_rows()>0)
               {
                    $getrcrow = $user_contact->row();
                    $id = $getrcrow->cus_id;
                    $singleattchsql = $this->db->query("SELECT * FROM cus_attachment WHERE cust_id='".$id."' ORDER BY id DESC LIMIT 1");
                    $attchsqlrow = $singleattchsql->row();
                    $attchsql = $this->db->query("SELECT * FROM cus_attachment WHERE cust_id='".$id."' ORDER BY id ASC");
                    $attchsql_nrows = $attchsql->num_rows();
                    
                    if($attchsql_nrows>0)
                    {
                         foreach ($attchsql->result() as $attchsql_dtls) 
                         {
                              $attamentId = $attchsql_dtls->id;
                              
                              if($attchsqlrow->id == $attamentId)
                              {
                                   $lstinvoiceid = "fa-plus";
                                   $lstinvoicecls = "btn-success";
                                   $fninvoce = "fncrattachment('".$attamentId."')";
                              }
                              else
                              {
                                   $lstinvoiceid = "fa-minus";
                                   $lstinvoicecls = "btn-danger";
                                   $fninvoce = "fndelattachment('".$attamentId."')";
                              }
      
      
                    if($attchsql_dtls->attach_file_name!="")
                     {
                          $atfilename=$attchsql_dtls->attach_file_name;
                     }else{
                          $atfilename="";
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
                        $filename="<?=$base_url('admin/uploads/customer_attachments/')?>".$attchsql_dtls->attach_file_name;
      
                        $target="target='_blank'";
      
                        $fname=$attchsql_dtls->attach_file_name;
      
                   }else{
                        $filename="#";
                        $target="";
                         $fname="";
      
                   }
      
      
                  if($attchsql_dtls->date!="")
                   {
                        $date=date("m/d/Y",strtotime($attchsql_dtls->date));
      
                   }else{
                        $date=date('m/d/Y');
      
                   }
      
      
      
                 if($attchsql_dtls->note!="")
                   {
                        $note=$attchsql_dtls->note;
      
                   }else{
                        $note="";
      
                   }
      
                 ?>
      
                    <form name="frmattachment<?=$attamentId?>" id="frmattachment<?=$attamentId?>" action="<?=site_url('attachment/fnupdateattchment')?>" method="POST" enctype="multipart/form-data">
      
                    <tr class="tr_clone">
      
                     <!--  <td>1</td> -->
      
                      <td>
                        <input type="text" name="date" id="date" placeholder="mm/dd/yyyy" value="<?=$date?>" class="form-control endate"></td>
      
                      <td>
                        <input type="text" name="notes" id="notes"  value="<?=$note?>" class="form-control notes updwn" placeholder="" >
                         <input type="hidden" class="hdnattchid" name="hdnattchid" id="hdnattchid" value="<?=$attamentId?>">
                      </td>
      
                      <td><a  class="btn btn-xs btn-primary">Scan</a></td>
      
                      <td><input class="btn btn-xs btn-primary" type="file" name="image" id="image" onchange="fnuploadattchment('<?=$attamentId?>')"  >
                        <!-- <label for="image" style="font-weight: 400;"><?=$fname?></label> -->
                      </td>
      
                      <td><a href="<?=$filename?>" <?=$target?> class="btn btn-xs btn-primary">Show</a></td>
      
                      <td><?=$atfilename?></td>
      
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

	public function search_data()
	{
		/*$query = $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,user_contact_info.contact_no,user_contact_info.user_contact_note')
						 ->from('register_customer')
						 ->join("user_contact_info", "register_customer.cus_id=user_contact_info.cus_id")
						 ->where(array("user_contact_info.default_contact"=> 1))
             ->group_by("register_customer.cus_id")
						 ->order_by("register_customer.cus_id DESC")
						 ->get();*/
       $query = $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,register_customer.cus_acc_no')
             ->from('register_customer')
             ->order_by("register_customer.cus_id DESC")
             ->get();

		return $query->result_array();
	}



	function fncrevntattachment_dtls()
	{
		$postattchvarr=array(
		     "cust_id" => $_POST['customrId'],
		   );
			 echo "id".$_POST['customrId'];echo "<br>";
		 if($this->db->insert('cus_attachment',$postattchvarr))
		 {
		 	echo "success";
		 }
	}


	function fndeleteattachment_dtls()
	 {

		$this->db->where('id',$_POST['attachmentId']);
		if($this->db->delete('cus_attachment'))
		{
			echo "success";
		}

	}

	function fnupdateattchment_dtls($usersdata)
	{
				$this->db->where('id',$_POST['hdnattchId']);
		return $this->db->update('cus_attachment',$usersdata);
	}

	



  function updatenotes_dtls()
   {
      $notearr=array(
        "note" => $this->input->post('temp_notes')
      );
     $this->db->where("id", $this->input->post('temp_hdnattchid'));
     if($this->db->update('cus_attachment',$notearr))
        {
          echo "success";
        }
   }


}
