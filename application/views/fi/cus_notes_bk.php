<!DOCTYPE html>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Invoices</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">

  <link href="<?php echo base_url("assets"); ?>/css/datepicker3.css" rel="stylesheet">
  <link href="<?php echo base_url("assets"); ?>/css/daterangepicker-bs3.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

  <!-- Google Font -->

  <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>
	.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}


.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border: 16px solid #fff;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    margin: 15% auto;
    opacity: 1;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.fadeMe {
    opacity: 1;
    width: 100%;
    height: 100%;
    z-index: 10;
    top: 0;
    background: rgba(0,0,0,0.5);
    left: 0;
    position: fixed;
    text-align: center;
    display: none;
}

table .form-group {
    margin-bottom: 0;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 1px;
}

input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-clear-button,
input[type="date"]::-webkit-calendar-picker-indicator {
    display: none;
    -webkit-appearance: none;
}

@media(max-width:1300px){

  input[type="date"]{ max-width:90px;}
}



div#terms {
    max-height: 300px;
    overflow-y: auto;
}
.tab-pane .box form {
    margin-bottom: -1px;
}

#divloadinvtabs .box-body{ padding-top: 0; padding-bottom:0; }

.reminder_modal .mybtns {
    margin: 10px 0;
}
 

.reminder_modal .mybtns a.btn {
    margin: 0 5px;
}



</style>


</head>

<body class="hold-transition skin-blue sidebar-mini">


    <!-- Content Wrapper. Contains page content -->


<div class="content-wrapper" style="min-height: 626px;">

      <section class="content-header">
      <h1>Event Management </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Customer</a></li>
        <li class="active">Attachments</li>
      </ol>
    </section>

      <section class="content">
        <!-- TABLE: LATEST ORDERS -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info customer_sec titlen_search ">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-sm-5 col-md-4">
                    <h3 class="uhead1">
                      Notes
                    </h3>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <div class="pull-right">
                      <ul class="list-inline topul">
                        <li><a href="#" class="uhead2"> Main Menu </a></li>
                        <li><a href="#" class="uhead2"> Options </a></li>
                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                      </ul>
                      <a href="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/newGeneralInfo" class="btn btn-md btn-info btn-flat">New Customer</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($success)){?>

              <div class="alert alert-success alert-dismissable fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong></strong> <?=$success?>
              </div>

              <?php }?>
              <?php if(isset($error)){?>
              <div class="alert alert-danger alert-dismissable fade in">

                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                 <strong>Error!</strong> <?=$error?>

              </div>

              <?php }?>
              <!-- /.box-header -->

              <div class="box-body">


                                 <form action="<?=site_url('fi_home/search_cus')?>" method="POST" id="csearch">

                                <div class="row space3">



                                  <div class="col-md-3 lstpaytype_cus_col">



                                    <div class="form-group">

                                      <!-- <select class="form-control" id="cus_names" onchange="fnsearhinvoice(this.value)">
                                        <option> </option>
                                          <?php

                                           $cus_id=$this->session->userdata('id');
                                           //echo "cus_id--".$cus_id;
                                          foreach ($search as $search_data) {

                                          // echo "<pre>";  print_r($search_data);

                                            if($cus_id==$search_data['cus_id'])
                                            {

                                              $select="selected";

                                            }else{

                                               $select="";

                                            }

                                            ?>

                                            <option <?=$select?> value="<?php echo $search_data['cus_id'] ?>"><?php print_r($search_data['cus_lname']." - ". $search_data['cus_company_name']); ?></option>

                                        <?php  }
                                           ?>
                                      </select> -->

                                      <input type="text" list="cusnotes" class="form-control cus_notes" name="cus_notes" autocomplete="off" id="cus_notes">

                                      <datalist id="cusnotes">
                                        <?php
                                        $i=1;
                                        foreach ($search as $search_data) {  ?>

                                       <option style="font-size:13px;" data-value="<?php echo $search_data['cus_id'] ?>" value="<?php print_r($search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?>">
                                       </option>
                                           <?php
                                           $i++;
                                         } ?>
                                       </datalist>

                                    </div>

                                  </div>

                                    <?php
                                       $cus_id=$this->session->userdata('id');
                                       if ($cus_id !="") {
                                         // code...
                                         $cntinfosql=$this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$cus_id."' AND default_contact=1 AND conatct_type!='Email'");
                                         $cntinfosql_row=$cntinfosql->row();
                                       }

                                    ?>

                                  <div class="col-md-2">
                                   <div class="form-group" id="contact_info">
                                     <input class="form-control fcap contact_no" type="text" id="topphone" name="topphone" value="<?=$cntinfosql_row->contact_no?>">
                                   </div>

                                 </div>
                                <!-- <div class="loaduppertabcntdtls">

                               </div> -->
                               <?php
                               if ($cus_id !="") {
                                 // code...

                               $cntinfosql=$this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$cus_id."' AND default_contact=1 AND conatct_type!='Email'");
                         		$cntinfosql_row=$cntinfosql->row();

                         		$this->db->select('*');
                         		$this->db->from('invoices_create');
                         		$this->db->where('invoice_id', $_POST['invoiceid']);
                         		$singleinvinfo = $this->db->get()->result_array()[0];

                         		 $custregsqlq=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$cus_id."'");
                         		 $custregsqlrows=$custregsqlq->row();
                             // print_r($custregsqlrows);
                             $balance_count= $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id',$cus_id)->get('invoices_create')->result_array()[0];
                           }
                                ?>
                               <div class="loaduppertabcntdtls">
                                 <div class="col-md-2 cus_acc_no">

                                        <div class="form-group" id="lastinvId">

                                         <input class="form-control"  type="text" placeholder="" value="<?=$custregsqlrows->cus_acc_no?>">

                                         <!--  <input class="form-control"  type="text" placeholder="433" value="<?php //echo $singleinvinfo['invoice_id'] ?>"> -->

                                        </div>

                                      </div>

                                      <div class="col-md-2 balance_count">

                                        <div class="form-group" id="lastinvduebal">

                                          <input class="form-control"  type="text" placeholder="$16.33" value="$ <?=sprintf('%0.2f',$balance_count['total'])?>">
                                          <!-- <input class="form-control"  type="text" placeholder="$16.33" value="$ <?=sprintf('%0.2f',$singleinvinfo['invoice_balance_due'])?>"> -->

                                        </div>

                                      </div>

                      	</div>


                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <select class="form-control" id="menu2">
                                        <option value="">Choose</option>
                                          <?php

                                            foreach ($search as $search_data) 
                                            {
                                                if($cus_id==$search_data['cus_id'])
                                                {
    
                                                  $select="selected";
    
                                                }else{
    
                                                   $select="";
    
                                                }
                                                ?>
                                                
                                                 <option <?=$select?> value="<?php echo $search_data['cus_id'] ?>" ><?php print_r($search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?> </option>
                                                <!--<option <?=$select?> value="<?php echo $search_data['cus_id'] ?>"><?php print_r($search_data['cus_lname']." - ". $search_data['cus_company_name']); ?></option>-->

                                                <?php  
                                            }
                                           ?>
                                      </select>
                                    </div>
                                  </div> 



                                </div>
                              <!-- </div>
                            </div>
                           </div>
                          </div>  -->

                        </form>
                <!-- end -->




              </div>
            </div>
            <!-- /.box info -->

            <div class="box box-default firstblock_bg">

              <div class="box-header with-border">
                <p class="uhead2">Notes</p>
              </div>

               <div class="row mt10">
                <div class="col-md-12">
                <div class="table-responsive" id="mynotes">
                  <table class="table  table-hover no-margin fixed_table">
                    <thead>
                      <tr>
                        <th class="w50">Inv. No.</th>
                        <th class="w90">Date</th>
                        <th class="w90">Time</th>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th style="width: 50%">Notes</th>
                        <th class="w50">Action</th>
                      </tr>
                    </thead>
                    <tbody id="id">
                      <?php $i=1;
                      foreach ($invoice_note as $invoice_note)
                      // echo "<pre>";  print_r($invoice_note); inv_id die;
                      {?>
                      <tr>
                        <td><span><?=$invoice_note['inv_id']  ?></span></td>
                        <td class="w90">
                            <?php $dt = date("m/d/Y",strtotime($invoice_note['date']));  ?>
                          <input type="text" name="note_date" class="form-control w90" placeholder="mm/dd/yyyy"  value="<?=($dt!="01/01/1970") ? $dt : "";  ?>" readonly>
                        </td>
                        <td>
                          <input type="time" name="note_time" class="form-control" value="<?=$invoice_note['time']  ?>" readonly>
                        </td>
                        <td>
                          <?php
                           $evntypsql=$this->db->query("SELECT * FROM events_register WHERE inv_id='".$invoice_note['inv_id']."' ORDER BY event_id ASC ")->row_array();
                           // print_r($evntypsql);

                           if ($evntypsql['event_date'] !="") {
                                         $con_date=date("m/d/Y",strtotime($evntypsql['event_date']));
                                       }
                                      else {
                                        $con_date="";
                                      }

                                      $eventname=$evntypsql['event_name'];
                                      $eventname=str_replace('-',' - ',$eventname);



                                      echo $eventname." - ".$con_date." - ".$evntypsql['event_type'];

                           ?>
                        </td>
                        <td>
                          <select class="form-control" name="notestype" id="notestype">
                             <option>  </option>
                             <option> option 1 </option>
                             <option> option 2</option>
                             <option> option 3</option>

                         </select>
                        </td>
                        <td><input type="text" name="note_desc" class="form-control" value="<?=$invoice_note['note']  ?>" readonly></td>
                        <td>
                          <button onclick="fndelinvoice('<?=$invoice_note['id']?>')" class="btn btn-xs btn-danger tr_clone_add"><i class="fa fa-minus"></i></button>
                          </td>
                      </tr>
                      <?php }?>


                      <!--<tr>-->
                      <!--  <td><span> </span></td>-->
                      <!--  <td class="w90">-->
                      <!--    <input type="text" name="note_date" class="form-control w90"  value="" readonly>-->
                      <!--  </td>-->
                      <!--  <td>-->
                      <!--    <input type="time" name="note_time" class="form-control" value=" " readonly>-->
                      <!--  </td>-->
                      <!--  <td>-->
                      <!--    <select class="form-control" name="notestype" id="notestype">-->
                      <!--       <option>  </option>-->
                      <!--       <option> option 1 </option>-->
                      <!--       <option> option 2</option>-->
                      <!--       <option> option 3</option>-->

                      <!--   </select>-->
                      <!--  </td>-->
                      <!--  <td><input type="text" name="note_desc" class="form-control" value=" " readonly></td>-->
                      <!--  <td>-->
                      <!--    <button onclick="fndelinvoice('<?=$invoice_note['id']?>')" class="btn btn-xs btn-danger tr_clone_add"><i class="fa fa-minus"></i></button>-->
                      <!--    </td>-->
                      <!--</tr>-->


                  </tbody>
                  </table>
                </div>

                  </div>
                </div>
            </div>


  <div class="mytabber">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class="active"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab" aria-expanded="true">Appointments  </a></li>
    <li role="presentation" class=""><a href="#associated" aria-controls="associated" role="tab" data-toggle="tab" aria-expanded="false">Correspondence </a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" id="divloadinvtabs">



 <!--  Tab: notes  -->
    <div role="tabpanel" class="tab-pane active" id="notes">
        <div class="box box-default secondblock_bg ">

              <div class="box-header with-border">
                <p class="uhead2">Appointments</p>
              </div>
              <?php //print_r($appointmtnt);
              if (!empty($appointmtnt)) { ?>


              <div class="box-body">
                <form action="<?=site_url('fi_notes/addappointment')?>" method="POST" id="cform">
                <div class="table-responsive">
                  <table class="table table-hover no-margin fixed_table">
                    <thead>
                      <tr>
                          <th class="w40">View</th>
                          <th>Type</th>
                          <th>description</th>
                          <th class="w90">Date</th>
                          <th>Time</th>
                          <th class="w80">Completed</th>
                          <th>For User</th>
                          <th>Note</th>
                          <th>Priority</th>
                          <th class="w90">Date Entered</th>
                          <th>Reminder</th>
                          <th>User</th>
                      </tr>
                   </thead>
                   <tbody id="dispinvnotes">
                     <?php $i=1;
                     foreach ($appointmtnt as $customer_appointment)
                     // echo "<pre>";  print_r($driver);die;
                     {?>
                      <tr class="tr_clone">

                       <td style="vertical-align: middle;">
                         <!-- <input type="text" name="app_view" id="notedate" name="view_text" class="form-control" value="<?= $customer_appointment['app_view'] ?>"> -->
                         <a href="<?=site_url('fi_home/get_apppintment_id/'.$customer_appointment['id'])?>" style="cursor: pointer;">
                           <i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i>
                         </a>
                         <input type="hidden" name="cus_id" value="<?= $cus_id ?>">
                         <input type="hidden" id="appoin_id" name="appoin_id" value="<?= $customer_appointment['id'] ?>">
                        </td>

                        <td>
                          <select class="form-control cls_notes_type" name="notestype" id="notestype" onchange="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','appointment_type')">
                             <option>  </option>
                             <option <?php if ($customer_appointment['appointment_type']=="Appointment") {
                               echo "selected";
                             } ?> value="Appointment"> Appointment</option>
                             <option <?php if ($customer_appointment['appointment_type']=="Todo") {
                               echo "selected";
                             } ?> value="Todo"> Todo</option>

                         </select>
                        </td>

                        <td>
                          <!--<input type="text" name="app_desc" id="notedate" value="<?= $customer_appointment['app_desc'] ?>" class="form-control"  onchange="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','app_desc')">-->
                          
                          <input type="text" list="<?= $customer_appointment['appointment_type']?>" name="app_desc" id="notedate" value="<?= $customer_appointment['app_desc'] ?>" class="form-control descp" autocomplete="off" onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','app_desc')" >
                            <?php 
                            if(!empty($todo_descp_list))
                            {
                                echo "<datalist  id='Todo'>";
                                foreach($todo_descp_list as $ele)
                                {
                                    echo '<option value="'.$ele['sub_name'].'">';
                                }
                                echo "</datalist>";
                            }
                            
                            if(!empty($appnt_descp_list))
                            {
                                echo "<datalist  id='Appointment'>";
                                foreach($appnt_descp_list as $ele)
                                {
                                    echo '<option value="'.$ele['sub_name'].'">';
                                }
                                echo "</datalist>";
                            }
                            ?>
                          
                            
                        </td>

                        <td>
                            <?php
                                $dt = date("m/d/Y",strtotime($customer_appointment['note_datetime']));
                            ?>
                            <!--<input type="date" name="note_datetime" value="<?= $customer_appointment['note_datetime'] ?>" class="form-control updwn invdudate_details w90"  onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_datetime')">-->
                            <input type="text" name="note_datetime" value="<?php echo ($dt!="01/01/1970")? $dt : ""; ?>" placeholder="mm/dd/yyyy" class="form-control updwn invdudate_details w90"  onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_datetime')">
                        </td>

                        <td>
                          <input type="time" name="note_time" value="<?= $customer_appointment['note_time'] ?>" class="form-control updwn"
                          onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_time')"></td>
                        <td>
                          <input class="" type="checkbox" value="1" id="iteam" name="iteam_check" onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','iteam_check')" <?php if ($customer_appointment['iteam_check']==1) { ?>
                          checked
                        <?php }else { ?>

                        <?php  } ?> >
                        </td>

                        <td>
                          <select class="form-control" name="notestype_user" id="notestype" onchange="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','notestype_user')">
                             <option value="">  </option>
                             <option value="option 1">option 1</option>
                             <option value="option 2">option 2</option>
                             <option value="option 3">option 3</option>

                         </select>
                        </td>

                        <td>
                          <input type="text" name="appointmtnt_note" value="<?= $customer_appointment['appointmtnt_note'] ?>" class="form-control" onchange="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','appointmtnt_note')">
                        </td>
                        <td>
                          <select class="form-control" name="appointment_priority" id="priority">
                             <option value="">  </option>
                             <option <?php if ($customer_appointment['appointment_priority']=="High Priority") {
                               echo "selected";
                             }?> value="High Priority">High Priority</option>
                             <option <?php if ($customer_appointment['appointment_priority']=="Low Priority") {
                               echo "selected";
                             }?> value="Low Priority">Low Priority</option>
                             <!-- <option value="option 3">option 3</option> -->

                         </select>
                        </td>
                        <td>
                            <?php
                                $dt = date("m/d/Y", strtotime($customer_appointment['note_date']));
                            ?>
                          <input type="text" name="note_date" value="<?= ($dt!="01/01/1970")? $dt : "";  ?>" placeholder="mm/dd/yyyy" class="form-control w90" readonly tabindex="-1">
                        </td>
                        <td>
                          <input type="text" name="note_remider" value="<?= $customer_appointment['note_remider'] ?>" class="form-control" onchange="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_remider')">
                        </td>
                        <td>
                          <input type="text" name="note_user" value="<?= $customer_appointment['note_user'] ?>" class="form-control" readonly>
                        </td>

                      </tr>
                      <?php }?>
                     </tbody>
                  </table>
                </div>

                <!-- <input type="submit" value="Submit" class="btn btn-info pull-right mt10"> -->
                <div class="clearfix">
                </div>
              </form>

              </div>
              <!-- endssss -->
            <?php  } ?>
            <div class="box-body">
              <form action="<?=site_url('fi_notes/addappointment')?>" method="POST" id="cform">
              <div class="table-responsive">
                <table class="table table-hover no-margin fixed_table">
                  <thead>
                  <?php if (!empty($appointmtnt)) { ?>
                    <!-- <tr>
                        <th>View</th>
                        <th>Type</th>
                        <th>description</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Completed</th>
                        <th>For User</th>
                        <th>Note</th>
                        <th>Date Entered</th>
                        <th>Reminder</th>
                        <th>User</th>
                    </tr> -->
                  <? }else { ?>
                    <tr>
                        <th class="w40">View</th>
                        <th>Type</th>
                        <th>description</th>
                        <th class="w90">Date</th>
                        <th>Time</th>
                        <th class="w80">Completed</th>
                        <th>For User</th>
                        <th>Note</th>
                        <th>Priority</th>
                        <th class="w90">Date Entered</th>
                        <th>Reminder</th>
                        <th>User</th>
                    </tr>
                  <?php } ?>

                 </thead>
                 <tbody id="dispinvnotes">


                    <tr class="tr_clone">

                     <td class="w40" style="vertical-align: middle">
                       <!-- <input type="text" name="app_view" id="notedate" name="view_text" class="form-control" value=""> -->
                       <a href="#" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i>
                       </a>
                       <input type="hidden" name="cus_id" value="<?= $cus_id ?>">
                      </td>

                      <td>
                        <select class="form-control cls_notes_type" name="notestype" id="notestype">
                           <option value="">Select Type  </option>
                           <option value="Appointment"> Appointment</option>
                           <option value="Todo"> Todo</option>


                       </select>
                      </td>

                      <td>
                        <!--<input type="text" name="app_desc" id="notedate" value="" class="form-control">-->
                        <input type="text" list="" name="app_desc" id="notedate" autocomplete="off" value="" class="form-control descp">
                        <?php 
                        if(!empty($todo_descp_list))
                        {
                            echo "<datalist  id='Todo'>";
                            foreach($todo_descp_list as $ele)
                            {
                                echo '<option value="'.$ele['sub_name'].'">';
                            }
                            echo "</datalist>";
                        }
                        
                        if(!empty($appnt_descp_list))
                        {
                            echo "<datalist  id='Appointment'>";
                            foreach($appnt_descp_list as $ele)
                            {
                                echo '<option value="'.$ele['sub_name'].'">';
                            }
                            echo "</datalist>";
                        }
                        ?>
                      </td>

                      <td class="w90">
                        <input type="text" name="note_datetime" value="" placeholder="mm/dd/yyyy" class="form-control updwn invdudate w90">
                      </td>
                      <td>
                        <input type="time" name="note_time" value="" class="form-control updwn">
                      </td>
                      <td class="w80">
                        <input class="" type="checkbox" value="1" id="iteam" name="iteam_check" >
                      </td>

                      <td>
                        <select class="form-control" name="notestype_user" id="notestype">
                           <option value="">  </option>
                           <option value="option 1">option 1</option>
                           <option value="option 2">option 2</option>
                           <option value="option 3">option 3</option>

                       </select>
                      </td>

                      <td>
                        <input type="text" name="appointmtnt_note" value="" class="form-control">
                      </td>
                      <td>
                        <select class="form-control" name="appointment_priority" id="priority">
                           <option value="">  </option>
                           <option value="High Priority">High Priority</option>
                           <option value="Low Priority">Low Priority</option>
                           <!-- <option value="option 3">option 3</option> -->

                       </select>
                      </td>
                      <td class="w90">
                        <input type="text" name="note_date" value="<?= date('m/d/Y')?>" readonly class="form-control w90" tabindex="-1"></td>
                      <td><input type="text" name="note_remider" value="" class="form-control"></td>
                      <td>
                        <input type="text" name="note_user" value="<?= $this->session->fi_session['name']?>" class="form-control" readonly tabindex="-1"></td>

                    </tr>

                   </tbody>
                </table>
              </div>

              <input type="submit" value="Submit" class="btn btn-info pull-right mt10">
              <div class="clearfix"></div>
            </form>

            </div>
            </div>
    </div>
 <!--  Tab: associated  -->
    <div role="tabpanel" class="tab-pane" id="associated">
        <div class="box box-default thirdblock_bg ">

                <div class="box-header with-border">

                  <p class="uhead2">Correspondence </p>
                </div>

                <div class="box-body">
                  <form action="<?=site_url('fi_notes/addcorrespondence')?>" method="POST" id="dform">


                   <div class="table-responsive">
                    <table class="table table-hover no-margin fixed_table fixed_table">
                    <thead>
                      <tr>
                          <th class="w90">Date</th>
                          <th>Time</th>
                          <th width="50%">Note</th>
                          <th>Description</th>
                      </tr>
                   </thead>
                   <tbody id="dispinvnotes">

                      <tr class="tr_clone">

                        <td >
                          <input type="text" name="correspondence_date" placeholder="mm/dd/yyyy" class="form-control cordt " value="">
                          <input type="hidden" name="cus_id" value="<?= $cus_id ?>">
                        </td>
                        <td>
                          <input type="time" name="correspondence_time" class="form-control updwn" value=""  >
                        </td>
                         <td>
                          <input type="text" name="correspondence_note" class="form-control updwn" value="">
                        </td>

                         <td>
                           <input type="text" class="form-control" name="correspondence_desc" value="">
                         </td>
                      </tr>

                     </tbody>
                  </table>
                </div>

                <input type="submit" value="Submit" class="btn btn-info pull-right mt10">
                <div class="clearfix"></div>
              </form>

               </div>
             </div>
    </div>

      </div>
  <!--  End all tab section -->



</div>




          </div>

        </div>


<!-- Modal -->

        <div class="modal fade email_modal w80" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Email Form</h4>
      </div>
      <div class="modal-body">
       <div class="box-body">

            <div class="row">
                  <div class="col-xs-2">

                    </div>

                    <div class="col-xs-10">
                    <div class="row">
                  <div class="col-xs-3">
                    <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                          </div>
                   </div>

                     <div class="col-xs-3">
                    <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                          </div>
                   </div>

                     <div class="col-xs-3">
                    <label>Max Recipients </label>
                   </div>

                     <div class="col-xs-3">
                     <input type="number" value="50" name="max_rec[]" class="form-control">
                   </div>

                </div>
                    </div>
                </div>


                <hr>


                <div class="row">


                     <div class="col-xs-2">
                     <label>Click to Select or Enter New</label>

                         <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                          </div>

                   </div>
                     <div class="col-xs-10">
                     <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>To:</th>
                        <th>CC:</th>
                        <th>BCC:</th>

                        <th>Email Address:</th>
                        <th>Name:</th>
                        <th>Type:</th>

                      </tr>


                      <tr>

                        <td><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td><input type="checkbox" value="1" name="task_completed[]"></td>

                        <td><input type="text" name="invoice_payment[]" class="form-control" value="levi@phototype.com"> </td>
                        <td><input type="text" name="invoice_payment[]" class="form-control" value="Liberow, levi"> </td>
                        <td> <input type="text" name="invoice_payment[]" class="form-control" value="Vendor"></td>

                      </tr>


                        <tr>

                        <td><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td><input type="checkbox" value="1" name="task_completed[]"></td>

                        <td><input type="text" name="invoice_payment[]" class="form-control" value=" "> </td>
                        <td><input type="text" name="invoice_payment[]" class="form-control" value=" "> </td>
                        <td> <input type="text" name="invoice_payment[]" class="form-control" value=" "></td>

                      </tr>




                    </thead>

                  </table>

                </div>
                   </div>

                </div>

                      <div class="box box-primary mt20">
              <!--<p class="uhead2 pt10">Payment Applied To</p>-->
                        <div class="box-body">

                             <div class="row">
                                         <div class="col-xs-2">
                                             <label>Attachments</label>

                                               <button type="button" class="btn btn-default btn-xs">Add Attachment</button>

                                         </div>
                                         <div class="col-xs-10">
                                             <div class="table-responsive">

                                      <table class="table table-hover no-margin">

                                        <thead>

                                          <tr>

                                            <th width="60%">File Name</th>
                                            <th>View</th>
                                            <th>Remove</th>

                                          </tr>

                                          <tr>

                                            <td><input type="text" name="invoice_payment[]" class="form-control" value="file name  "></td>
                                            <td><a class="btn btn-xs btn-default cnt_clone_add"><i class="fa fa-eye"></i></a></td>
                                            <td><a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a></td>

                                          </tr>

                                        </thead>

                                      </table>

                                    </div>
                                         </div>

                                    </div>
                                              <!-- /.box -->

                                      <hr>
                                      <div class="row">
                                         <div class="col-xs-2">
                                             <label>Subject</label>

                                         </div>
                                         <div class="col-xs-10">
                                              <input type="text" name="invoice_payment[]" class="form-control" value=" ">
                                         </div>

                                    </div>
                                      <hr>
                                    <div class="row">
                                         <div class="col-xs-2">
                                             <label>Body</label>

                                               <button type="button" class="btn btn-default btn-xs">Check Spelling</button>

                                         </div>
                                         <div class="col-xs-10">
<textarea name="invoice_payment[]" rows="6" class="form-control">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley

Date:1/24/2018  6:30:00 PM
Type:Wedding
Expected Ending: 1/24/2018
Location:location
City:Brooklyn
</textarea>
                                         </div>

                                    </div>


                                    <div class="row">
                                         <div class="col-xs-2">

                                         </div>
                                         <div class="col-xs-10 mt20">
                                                 <div class="row ">
                                                     <div class="col-xs-5">
                                                         <button type="button" class="btn btn-primary">Cancel </button>
                                                     </div>
                                                     <div class="col-xs-4">
                                                           <div class="checkbox">
                                                            <label> <input type="radio" value="1" name="email_radio"> Email with SMTP</label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label> <input type="radio" value="1" name="email_radio"> Email with Outlook</label>
                                                          </div>
                                                     </div>

                                                      <div class="col-xs-3">
                                                           <button type="button" class="btn btn-primary">Send Email</button>
                                                     </div>

                                                </div>
                                         </div>

                                    </div>
                        </div>
                      </div>
                <!-- /.table-responsive -->

              </div>
      </div>

    </div>
  </div>
</div>

      </section>

    </div>




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#reminder_modal" style="position: relative; z-index: 9999">
  Reminder
</button>


<div class="modal fade reminder_modal" id="reminder_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false"  >

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" id="close_model" aria-label="Close"><span aria-hidden="true">×</span></button>

        <h4 class="modal-title" id="myModalLabel">1 Reminder </h4>

      </div>

      <div class="modal-body">

       <div class="box-body"> 

                      <div class="box box-primary mt20">
              <p class="uhead2 pt10">0 Reminders are selected </p>
                        <div class="box-body">
                            <div class="table-responsive">
                            <table class="table table-hover no-margin apply fixed_table">
                                <thead>
                                  <tr class="tr_clone">
                                    <th>Subject</th>
                                    <th class="w90">Due On</th>
                                    <th class="w90">Rep</th> 
                                  </tr>

                                </thead>
                                <tbody id="">
                                  <tr class="tr_clone">
                                    <td class="">test </td>
                                    <td> 06:06 AM</td> 
                                    <td> 3</td>
                                  </tr>
                      
                                 </tbody>

                              </table>

                    </div>

                      <div class="mybtns">
                          <a class="btn btn-xs btn-primary pull-left">Open Item </a>
                          <a class="btn btn-xs btn-danger pull-right">Dismiss All</a> 
                          <a class="btn btn-xs btn-danger pull-right">Dismiss</a>
                          <div class="clearfix"></div>
                        </div>

                        <hr>

                        <p>Click Snooze to be reminded again in</p>
                        <div class="row">
                          <div class="col-xs-3">
                            <select id="loc_name" class="form-control " name="select_min"> 
                               <option value="5">5</option>
                               <option value="10">10</option>
                               <option value="15">15</option>                         
                            </select>
                          </div>

                          <div class="col-xs-3">
                            <select id="loc_name" class="form-control " name="select_min"> 
                               <option value="5">Seconds</option>
                               <option value="10">Minutes</option>
                               <option value="15">Hours</option>                         
                            </select>
                          </div>

                          <div class="col-xs-3"><a class="btn btn-xs btn-primary pull-left">Snooze  </a> </div>
                          <div class="col-xs-3"><a class="btn btn-xs btn-primary pull-left">Snooze All </a> </div> 
                        </div>

                          <!-- /.box -->



                        </div>

                      </div>


                <!-- /.table-responsive -->



              </div>

      </div>


    </div>

  </div>

</div>
















    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>


   <script src="http://tech599.com/tech599.com/johnsum/admin/assets/bower_components/jquery/dist/jquery.min.js"></script>

   <script src="<?php echo base_url("assets"); ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
   <script src="<?php echo base_url("assets"); ?>/js/daterangepicker.js"></script>

   <script type="text/javascript">
     $(document).ready(function(){ 
      $("#reminder_modal .close").click(function(){ 
          $(".modal-backdrop").remove();
          $("body").removeClass(".modal-open");

      });

     });

   </script>

   <script type="text/javascript">
  //ERP tr added
    var cnt = 2

    $("body").on('click', '.tr_clone_add', function(rrr) { rrr.preventDefault();

    var $tr    = $(this).closest('.tr_clone');

    var $clone = $tr.clone();

    $clone.find(':text').val('');
   $clone.find('td:first-child').text(cnt);

   // $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()

  //  $clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');


   //$tr.after($clone);

  $tr.parent("tbody").append($clone);

  $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

  cnt++;

});





$(document).on('click', '.tr_clone_remove', function(){

     // Your Code

    var $tr    = $(this).closest('.tr_clone');

  //$(this).closest('table').addClass("currenttable");
  //var alltr = $(this).parents("table.currenttable").find('tr');
  //var len = alltr.length - 1;

  //$(alltr).each(function(){ $(this).find("td:first-child").text(i)});


  //alert(len);

    var $clone = $tr.remove();
  if(cnt>0)
  {
  cnt--;


  }

});

  </script>


  <!--  Create Attachment -->


<!-- End Create Attachment -->


<!--  Delete Attachment -->


<!-- End Delete Attachment -->

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript">
      $(document).ready(function($)
      {
        // alert("Hiii");
          // $('#contact_no').mask('(000) 000-0000');
        //   $('body .contact_no').mask('(000) 000-0000');
  $('body ').on("keypress", ".contact_no", function(){ $(this).mask('(000) 000-0000'); } );


        $(".str").keypress(function(event)
        {
          var inputValue = event.which;
          // allow letters and whitespaces only.
          if(!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0))
          {
              event.preventDefault();
          }
        });

        $(".num").keypress(function (e)
        {
          if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
          {
              return false;
          }
        });
    });

  </script>
<script type="text/javascript">
$(document).ready(function()
  {
     var pckId= localStorage.getItem("pckId");
      // alert("localStorage pckId--"+pckId);
      if(pckId ===null || pckId=='N')
      {
        var custnm = $('#cus_names').val();
        // alert("custnm--"+custnm);
        if (custnm=='undefined') {
          custnm=0;
        }
        fnsearchattchments(custnm);

        // alert('if');

      }else{
        // alert('else');
           fnsearchattchments(pckId);
      }
 });
</script>


<script type="text/javascript">
  let a =>(){return 3};

  console.log(a);

</script>

<script>
$(document).ready(function(){
  $('#cus_notes').on('input', function() {
      var value = $(this).val();
      // alert(value);

      var cust_id=$('#cusnotes [value="' + value + '"]').data('value');
      // alert(cust_id);
      fnsearhinvoice(cust_id);
      localStorage.setItem("customer_name", value);


  });

  var cu_name= localStorage.getItem("customer_name");
  // alert("name "+ cu_name)
  $('#cus_notes').val(cu_name);
});
</script>

<script type="text/javascript">
  function fnsearhinvoice(custid)
  {

    //event.preventDefault();
    // var urel_link='fi_notest/sendcusid/'+custid;
    //     alert("link--"+urel_link);
        // alert("custid--"+custid);
        var pckId=custid;
       //alert("pckId--"+pckId);
        localStorage.setItem("pckId", pckId);
    location.href = '<?=site_url('fi_notes/sendcusid/')?>'+custid;
    // alert("custid--"+custid);


  }

</script>


<script>
$(document).ready(function(){
$("body").on("blur", ".copyrowfield", function(){ alert(111);
  var curval = $(this).val();
  alert(curval);
  if(curval != "" || curval != null || curval != undefined){
  var $tr  = $(this).closest('.tr_clone');
  var $clone = $tr.clone();
  $clone.find(':text').val('');
 //$clone.find('td:first-child').text(cnt);

 // $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()

//  $clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');


 //$tr.after($clone);

$tr.parent("tbody").append($clone);

}

});
});
</script>

<script>
$(document).ready(function(){
$("body").on("keydown", ".invdudate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".invdudate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {
         //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
       {

       }
       else
       {
           var str = temp_edate.val();


           if(str.length >= 6 &&  !(str.includes("/")))
           {
               var mm = str.substring(0,2);
               var dd = str.substring(2).substring(0,2);
               var yy = str.substring(2).substring(2).substring(0,2);
               yy = "20"+yy;

               var month = 12;
               var day   = 31;

               if(mm=="02")
               {
                   if(yy % 4 === 0 )
                   {
                       day = 29;
                   }
                   else
                   {
                       day = 28;
                   }
               }

               if(mm <= month && dd <= day)
               {

                   var today = mm + '/' + dd + '/' + yy ;
                   var today1 = mm + '/' + dd + '/' + yy ;

                   temp_edate.val(today);

               }
               else
               {
                   alert("Wrong date.");
                   temp_edate.val("");
                   event.preventDefault();
               }
           }
       }
});
});
</script>



<script>
$(document).ready(function(){
$("body").on("keydown", ".cordt", function(event){

    var key = event.keyCode;
    //alert("key--"+key);
    var temp_edate =  $(this).parents(".tr_clone").find(".cordt");

    if(key=="107" || key=="187")
    {
        //alert("date+");
        var dtpls;
        if(temp_edate.val()=="")
        {
            dtpls= new Date();
        }else{
            dtpls= new Date(temp_edate.val());
        }

        dtpls.setDate( dtpls.getDate() + 1 );
        var mm = dtpls.getMonth() + 1;
        if(mm <10)
        {
            mm = "0"+mm;
        }

        var dd =  dtpls.getDate();
        if(dd <10)
        {
            dd = "0"+dd;
        }


        var yyyy =  dtpls.getFullYear();
        //var today = yyyy + '-' + mm + '-' +  dd;
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="109" || key=="189")
    {
        //alert("date-");
        var dtmns;
        if(temp_edate.val()=="")
        {
            dtmns= new Date();
        }else{
            dtmns= new Date(temp_edate.val());
        }

        dtmns.setDate( dtmns.getDate() - 1 );
        var mm = dtmns.getMonth() + 1;
        if(mm <10)
        {
            mm = "0"+mm;
        }

        var dd =  dtmns.getDate();
        if(dd <10)
        {
            dd = "0"+dd;
        }

        var yyyy =  dtmns.getFullYear();
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="68")
    {
        //alert("date D");
        today = '<?php echo date("m/d/Y"); ?>';
        temp_edate.val(today);
        event.preventDefault();
    }
    else if(key=="8" || key=="46")
    {

    }
    else
    {
        var str = temp_edate.val();


        if(str.length >= 6 &&  !(str.includes("/")))
        {
            var mm = str.substring(0,2);
            var dd = str.substring(2).substring(0,2);
            var yy = str.substring(2).substring(2).substring(0,2);
            yy = "20"+yy;

            var month = 12;
            var day   = 31;

            if(mm=="02")
            {
                if(yy % 4 === 0 )
                {
                    day = 29;
                }
                else
                {
                    day = 28;
                }
            }

            if(mm <= month && dd <= day)
            {

                var today = mm + '/' + dd + '/' + yy ;
                var today1 = mm + '/' + dd + '/' + yy ;

                temp_edate.val(today);

            }
            else
            {
                alert("Wrong date.");
                temp_edate.val("");
                event.preventDefault();
            }
        }
    }
});
});
</script>

<script>
$(document).ready(function(){
$("body").on("keydown", ".invdudate_details", function(event){

    var key = event.keyCode;
    //alert("key--"+key);
    var temp_edate =  $(this).parents(".tr_clone").find(".invdudate_details");

    if(key=="107" || key=="187")
    {
        //alert("date+");
        var dtpls;
        if(temp_edate.val()=="")
        {
            dtpls= new Date();
        }else{
            dtpls= new Date(temp_edate.val());
        }

        dtpls.setDate( dtpls.getDate() + 1 );
        var mm = dtpls.getMonth() + 1;
        if(mm <10)
        {
            mm = "0"+mm;
        }

        var dd =  dtpls.getDate();
        if(dd <10)
        {
            dd = "0"+dd;
        }


        var yyyy =  dtpls.getFullYear();
        //var today = yyyy + '-' + mm + '-' +  dd;
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="109" || key=="189")
    {
        //alert("date-");
        var dtmns;
        if(temp_edate.val()=="")
        {
            dtmns= new Date();
        }else{
            dtmns= new Date(temp_edate.val());
        }

        dtmns.setDate( dtmns.getDate() - 1 );
        var mm = dtmns.getMonth() + 1;
        if(mm <10)
        {
            mm = "0"+mm;
        }

        var dd =  dtmns.getDate();
        if(dd <10)
        {
            dd = "0"+dd;
        }

        var yyyy =  dtmns.getFullYear();
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="68")
    {
        //alert("date D");
        today = '<?php echo date("m/d/Y"); ?>';
        temp_edate.val(today);
        event.preventDefault();
    }
    else if(key=="8" || key=="46")
    {

    }
    else
    {
        var str = temp_edate.val();


        if(str.length >= 6 &&  !(str.includes("/")))
        {
            var mm = str.substring(0,2);
            var dd = str.substring(2).substring(0,2);
            var yy = str.substring(2).substring(2).substring(0,2);
            yy = "20"+yy;

            var month = 12;
            var day   = 31;

            if(mm=="02")
            {
                if(yy % 4 === 0 )
                {
                    day = 29;
                }
                else
                {
                    day = 28;
                }
            }

            if(mm <= month && dd <= day)
            {

                var today = mm + '/' + dd + '/' + yy ;
                var today1 = mm + '/' + dd + '/' + yy ;

                temp_edate.val(today);

            }
            else
            {
                alert("Wrong date.");
                temp_edate.val("");
                event.preventDefault();
            }
        }
    }
});
});
</script>

<!--  Delete Invoice -->
   <script type="text/javascript">
     function fndelinvoice(invoiceid)
     {
        // alert("invoiceid--"+invoiceid);
       event.preventDefault();

       var r = confirm("Do you want delete this invoice..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delinvoiceseleted')?>',
                  data: {invoiceid:invoiceid},
                  dataType: 'text',
                // cache: false,
                //  async: false,
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                      //alert("data---"+data);


                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          //alert("Invoice Created Successfully..!");
                          //window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                          $("#myinvoice").load(location.href + " #myinvoice");

                            //fnsearhinvoice(customrId);
                            window.location.href='<?=site_url('fi_notes/c_notes')?>';

                      }else if(data=="error"){

                          $('.fadeMe').hide();
                          //alert("Something went wrong..!");
                      }



                  },
                  error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();

                  }

              });
          }


     }

   </script>
   
   <script>
       $("body").on("change", ".cls_notes_type", function(event){
            var ntype =  $(this).parents(".tr_clone").find(".cls_notes_type").val();
            if(ntype=="Appointment")
            {
                $(this).parents(".tr_clone").find(".descp").attr("list", "Appointment");
            }
            else if(ntype=="Todo")
            {
                $(this).parents(".tr_clone").find(".descp").attr("list", "Todo");
            }
            else
            {
                $(this).parents(".tr_clone").find(".descp").attr("list", "");
            }
       });
   </script>

   <!--  Update Invoice -->
   <script type="text/javascript">
   function fnupdate_details(inptxtval,invoiceid,fieldnm)
     {
        // alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

        if(fieldnm=="note_datetime" || fieldnm=="note_date")
        {
            var arr =  inptxtval.split("/");
            inptxtval = arr[2] +"-"+ arr[0] +"-"+ arr[1];

            //alert(inptxtval);
        }
               // event.preventDefault();



               //alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

             //   if(fieldnm=='app_desc')
             //   {
                         $.ajax({
                         type: 'POST',
                         url: '<?=site_url('fi_home/updateappointment')?>',
                         data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
                         dataType: 'text',
                         beforeSend: function() {
                             // setting a timeout
                             $('.fadeMe').show();


                         },
                         success: function(data) {
                            // alert(data);
                             if(data=="success")
                             {
                                 $('.fadeMe').hide();

                                 //fngetinvoicedetails(invoiceid);
                                 $('.fadeMe').hide();
                                   // window.location.href='<?=site_url('fi_notes/c_notes')?>';


                             }else if(data=="error"){

                                 $('.fadeMe').hide();
                                 //alert("Something went wrong..!");
                             }



                         },
                         error: function(xhr) { // if error occured
                           // $('.fadeMe').hide();
                         },
                         complete: function() {
                          // $('.fadeMe').hide();


                         }

                        });

             // }
             // else{
               //
               //           $.ajax({
               //           type: 'POST',
               //           url: '<?=site_url('fi_home/updtinvoice')?>',
               //           data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
               //           dataType: 'text',
               //           beforeSend: function() {
               //               // setting a timeout
               //               $('.fadeMe').show();
               //
               //           },
               //           success: function(data) {
               //
               //             var custid= $('#custnm option:selected').val();
               //
               //               if(data=="success")
               //               {
               //                   $('.fadeMe').hide();
               //
               //                   fngetinvoicedetails(invoiceid,'items',custid);
               //
               //               }else if(data=="error"){
               //
               //                   $('.fadeMe').hide();
               //                   //alert("Something went wrong..!");
               //               }
               //
               //
               //
               //           },
               //           error: function(xhr) { // if error occured
               //             // $('.fadeMe').hide();
               //           },
               //           complete: function() {
               //            // $('.fadeMe').hide();
               //
               //
               //           }

                     // });
               // }

     }
   </script>
   <!-- <script type="text/javascript">
   var today = new Date();
         $('.dt')
     .datepicker({
       minDate: 0,
        format: "dd/mm/yyyy",
         todayHighlight: true,

         // minDate: today,
         // minDate: 0
     });

   </script> -->

   <!-- End Update Invoice -->
   

