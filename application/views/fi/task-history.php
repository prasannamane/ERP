<!DOCTYPE html>
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
    <style>

        .closebtn, .snoozbtn, .snoozbtn:active{ display: inline-block; margin: 0 3px; font-size: 18px; color: #716f6f;  }
        .snoozactive {
        color: #e67a2e !important;
        }

        .ibox-content{ padding: 10px; margin: 0;  }
        .ibox-content h3{ padding: 0; margin: 0;  }

        .table>tbody>tr>td[colspan] {
            height: 0;
        }

    </style>
    <div class="content-wrapper">
    <?php $this->load->view('template/alert'); ?>
        <div class="box box-info titlen_search task_sec">
            <div class="box-header with-border">
                <h3 class="uhead1">Task History</h3>
                <div class="col-md-4 col-sm-offset-8">
                    <div class="form-group dflex">
                        <label style="min-width: fit-content; margin: 2px 6px;">Select Status</label>
                        <?php
                        $stats_id = $this->session->userdata('status_id');
                        ?>
                        <select class="form-control" id="searc" onchange="loadstatus(this.value)" autofocus>
                            <option <?php if ($stats_id == 0)   { echo "selected"; } ?> value="0"> ALL</option>
                            <option <?php if ($stats_id == 1)   { echo "selected"; } ?> value="1"> In Process</option>
                            <option <?php if ($stats_id == 2)   { echo "selected"; } ?> value="2"> Completed </option>
                            <option <?php if ($stats_id == 'N') { echo "selected"; } ?> value="N"> Not Completed </option>
                            <option <?php if ($stats_id == 7)   { echo "selected"; } ?> value="7"> Received </option>
                            <option <?php if ($stats_id == 8)   { echo "selected"; } ?> value="8"> On Hold </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>



          <!-- /.box -->

            <!--*********************** new design **************************************-->

            <div class="row" id="load_data">
                <div class=" col-sm-12">

                    <div class="table-responsive">

                   <table class="table table-hover no-margin fixed_table w1600">

                      <thead>

                        <tr>

                          <th class="w50">Invoice</th>
                          <th class="w90">Date Started</th>

                          <th class="w150">Customer Name</th>
                          <th class="w300">Event Name</th>

                          <th class="w120">Task</th>

                          <th class="w180">Sub Task</th>

                          <th class="w90">User</th>

                          <th class="w90">Due Date</th>

                          <th class="w90">Status</th>

                          <th class="w90">User</th>

                          <th class="w90">Completed Date</th>

                          <th><span style="display: inline-block; min-width: 90px">Note</span></th>

                          <th class="w90">User</th>

                          <th class="w50">History</th>



                        </tr>

                      </thead>
                       <tbody id="mytasks">

              <?php
              $sessionData = $this->session->userdata('fi_session');
               //print_r($sessionData['id']); exit;
              $condition="";
             if($this->session->userdata('admin_role_id') != '1'){
             $condition = " WHERE t1.user = ".$sessionData['id'];
             }
              if ($status_id =='0') {


    $query = "SELECT t1.*,t2.cust_id,t3.cus_fname,t3.cus_lname,t3.cus_company_name FROM `invoice_task` t1 JOIN invoices_create t2 ON t1.invoice_id = t2.invoice_id JOIN register_customer t3 ON t2.cust_id = t3.cus_id ".$condition." ORDER BY t1.task_id ASC";
  
    $tasksql = $this->db->query($query);
    

    $chktsksql=$this->db->query("SELECT * FROM invoice_task ORDER BY task_id DESC LIMIT 1");
    $istaskrow=$chktsksql->row();
    }
    elseif ($status_id =='N') {
      $status_id=2;
      $status_query="SELECT t1.*,t2.cust_id,t3.cus_fname,t3.cus_lname,t3.cus_company_name FROM `invoice_task` t1 JOIN invoices_create t2 ON t1.invoice_id = t2.invoice_id JOIN register_customer t3 ON t2.cust_id = t3.cus_id ".$condition." AND t1.task_completed !='$status_id' ORDER BY t1.task_id ASC";
      // echo $status_query;
      $tasksql=$this->db->query($status_query);
      $chktsksql=$this->db->query("SELECT * FROM invoice_task ORDER BY task_id DESC LIMIT 1");
      $istaskrow=$chktsksql->row();
    }
    else {
      // echo "string2";
      $tasksql=$this->db->query("SELECT t1.*,t2.cust_id,t3.cus_fname,t3.cus_lname,t3.cus_company_name FROM `invoice_task` t1 JOIN invoices_create t2 ON t1.invoice_id = t2.invoice_id JOIN register_customer t3 ON t2.cust_id = t3.cus_id ".$condition." AND t1.task_completed='$status_id' ORDER BY t1.task_id ASC");
      $chktsksql=$this->db->query("SELECT * FROM invoice_task ORDER BY task_id DESC LIMIT 1");
      $istaskrow=$chktsksql->row();
    }
    

    if($tasksql->num_rows()>0)
    {

              foreach ($tasksql->result() as $tasksql_dtls)
                  {
                    
                    $chktskclr=$this->db->query("SELECT * FROM adm_task_type WHERE id='".$tasksql_dtls->task_type."'");
                    $chktskclrrow=$chktskclr->row();
                    if($tasksql_dtls->task_type==$chktskclrrow->id)
                    {
                      $assigntskcolor=$chktskclrrow->color;
                    }else{
                      $assigntskcolor="";
                    }


                    $chktskstatusclr=$this->db->query("SELECT * FROM adm_task_status WHERE id='".$tasksql_dtls->task_completed."'");
                    $chktskstatusclrrow=$chktskstatusclr->row();
                    if($tasksql_dtls->task_completed==$chktskstatusclrrow->id)
                    {
                      $assigntskstscolor=$chktskstatusclrrow->color;
                    }else{
                      $assigntskstscolor="";
                    }

                    $evntypsql=$this->db->query("SELECT * FROM events_register WHERE inv_id='".$tasksql_dtls->invoice_id."' AND cus_id='".$tasksql_dtls->cust_id."'  ORDER BY event_id ASC ")->row_array();


                    if ($evntypsql['event_date'] !="") {
                          $con_date=date("m/d/Y",strtotime($evntypsql['event_date']));
                        }
                        else {
                          $con_date="";
                        }

                        $eventname=$evntypsql['event_name'];
                        $eventname=str_replace('-',' - ',$eventname);
                          // print_r($eventname);echo "<br>";

                    $event_name= $eventname." - ".$con_date." - ".$evntypsql['event_type'];

                     $userid=$tasksql_dtls->cust_id;
                     $invoiceId=$tasksql_dtls->invoice_id;
                     $taskId=$tasksql_dtls->task_id;
                     $taskcustname=$tasksql_dtls->cus_lname.' '.$tasksql_dtls->cus_fname. ' - '.$tasksql_dtls->cus_company_name;
                     $taskinvId=$tasksql_dtls->invoice_id;
                     $taskstrtdt=$tasksql_dtls->task_date_started;
                     $tasksktyp=$tasksql_dtls->task_type;
                     $tasksubtyp=$tasksql_dtls->sub_task_type;
                     $taskusr=$tasksql_dtls->task_user;
                     $taskduedate=$tasksql_dtls->task_due_date;
                     $taskcompleted=$tasksql_dtls->task_completed;
                     $taskcompletedby=$tasksql_dtls->task_completed_by;
                     $taskcompleteddate=$tasksql_dtls->task_completed_date;
                     $tasknote=$tasksql_dtls->task_note;
                     $taskenteredby=$tasksql_dtls->task_entered_by;




                      //if($taskcompleted==1)
                      $todaysdate=date("m-d-Y");
                      $mydate=date('m-d-Y',strtotime($taskduedate));
                      if($todaysdate > $mydate && $mydate!="01-01-1970")
                         {
                            $rwcolor="background-color: #f17b7b;";
                         }else{
                             $rwcolor="background-color: #e6e677;";
                         }

                  ?>

                      <tr class="tr_clone">

                          <td><a id="call_invoice" onclick="call_invoice(<?=$userid?>);" ><?=$invoiceId;  ?></a></td>
                          <td style="background-color: <?=$assigntskcolor?>">
                            <!--<input type="date" name="task_strtdate" id="task_strtdate" class="form-control taskstrtdate" value="<?=$taskstrtdt?>" >-->
                            <?php 
                                $dt = date("m/d/Y", strtotime($taskstrtdt));
                            ?>
                            <input type="text" name="task_strtdate" id="task_strtdate" placeholder="mm/dd/yyyy" class="form-control taskstrtdate" value="<?=($dt!="01/01/1970")? $dt : "" ; ?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_date_started')" >

                            <input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?=$taskinvId?>">
                             <input type="hidden" name="hdntskid" class="hdntskid" value="<?=$taskId?>">
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <input type="text" name="task_custname" id="task_custname" class="form-control taskcustname" value="<?=$taskcustname?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskcustname?>','task_custname')">
                          </td>
                          <td style="background-color: <?=$assigntskcolor?>"><?=$event_name?></td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <!--  <input type="text" name="task_name" id="task_name" class="form-control taskname" value="<?=$tasksktyp?>" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_type')"> -->

                            <select class="form-control taskuser task_name" name="task_name" id="task_name" >
                              <option value=""> </option>
                                <?php
                                 $invtasktype=$this->db->query("SELECT * FROM adm_task_type");
                                 foreach ($invtasktype->result() as $invtasktype_dtls)
                                 {
                                    if($tasksktyp==$invtasktype_dtls->id)
                                     {
                                        $seltsktyp="selected";
                                     }else{
                                        $seltsktyp="";
                                     }

                                    ?>
                                      <option <?=$seltsktyp?> value="<?=$invtasktype_dtls->id?>"><?=$invtasktype_dtls->name?></option>
                                    <?php
                                 }
                              ?>
                            </select>
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <select class="form-control taskuser subtaskname" name="subtaskname" id="subtaskname">
                              <option value=""> </option>
                                <?php
                                 $invtasktype=$this->db->query("SELECT * FROM adm_subtask_type WHERE task_id='".$tasksktyp."'");
                                 foreach ($invtasktype->result() as $invtasktype_dtls)
                                 {
                                    if($tasksubtyp==$invtasktype_dtls->id)
                                     {
                                        $seltsktyp="selected";
                                     }else{
                                        $seltsktyp="";
                                     }

                                    ?>
                                      <option <?=$seltsktyp?> value="<?=$invtasktype_dtls->id?>"><?=$invtasktype_dtls->name?></option>
                                    <?php
                                 }
                              ?>
                            </select>
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">

                            <select class="form-control" name="task_user" id="task_user"  onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_user')">
                              <option value=""> </option>
                              <?php
                                 $admloguser=$this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC");
                                 foreach ($admloguser->result() as $admloguser_dtls)
                                 {
                                  if($admloguser_dtls->cus_id==$taskusr)
                                  {
                                    $selusr="selected";
                                  }else{
                                    $selusr="";
                                  }

                                   ?>
                                      <option <?=$selusr?> value="<?=$admloguser_dtls->cus_id?>"><?=$admloguser_dtls->cus_lname?></option>
                                    <?php
                                 }
                              ?>
                            </select>

                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <!--<input type="date" name="task_due_date" id="task_due_date" class="form-control taskduedate" value="<?=$taskduedate?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_due_date')">-->
                            <?php $dt = date("m/d/Y", strtotime($taskduedate)); ?>
                            <input type="text" name="task_due_date" id="task_due_date" class="form-control taskduedate" placeholder="mm/dd/yyyy" value="<?= ($dt!="01/01/1970")? $dt : "" ; ?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_due_date')">
                          </td>

                        <td style="background-color: <?=$assigntskstscolor?>">


                              <select class="form-control taskcompleted" name="task_completed" id="task_completed" style="width: 130px;" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_completed')">
                              <option value=""> </option>
                                <?php
                                 $invtasktype=$this->db->query("SELECT * FROM adm_task_status ORDER BY id ASC");
                                 foreach ($invtasktype->result() as $invtasktype_dtls)
                                 {
                                  if($taskcompleted==$invtasktype_dtls->id)
                                   {
                                      $setselct="selected";
                                   }else{
                                      $setselct="";
                                   }

                                    ?>
                                      <option <?=$setselct?> value="<?=$invtasktype_dtls->id?>"><?=$invtasktype_dtls->name?></option>
                                    <?php
                                 }
                              ?>
                            </select>

                        </td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                             <?php
                                 $admloguser=$this->db->query("SELECT * FROM users WHERE id='".$taskcompletedby."'");
                                 $admloguserrow=$admloguser->row();
                                 $loogedusername=$admloguserrow->name;

                               ?>

                            <input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="<?=$loogedusername?>" readonly>
                          </td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                              <?php $dt = date("m/d/Y", strtotime($taskcompleteddate)); ?>
                                <input type="text" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate" placeholder="mm/dd/yyyy" value="<?= ($dt!="01/01/1970")? $dt : "" ; ?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_completed_date')"></td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                            <input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value="<?=$tasknote?>" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_note')">
                          </td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                             <?php
                                 $admloguser1=$this->db->query("SELECT * FROM users WHERE id='".$taskenteredby."'");
                                 $admloguserrow1=$admloguser1->row();
                                 $logedusername=$admloguserrow1->name;

                               ?>
                            <input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn" value="<?=$logedusername?>" readonly>
                          </td>

                          <td>
                            <a class="collapse-link"><i class="fa fa-eye"></i></a>
                          </td>

                        </tr>
                        <!--  End Main Task  -->

                        <!-- Start Task History -->
                          <tr>
                            <td colspan="11">

                               <div class="ibox-content" style="display: none;">

                   <table class="table table-hover no-margin">

                     <!--  <thead>

                        <tr>

                          <th>Date Started</th>

                          <th>Task</th>

                          <th>Sub Task</th>

                          <th>User</th>

                          <th>Due Date</th>

                          <th>Status</th>

                          <th>Completed By</th>

                          <th>Completed Date</th>

                          <th>Note</th>

                          <th>Entered By</th>



                        </tr>

                      </thead> -->

                      <tbody id="amytasks">

 <?php

    $tasksql=$this->db->query("SELECT * FROM invoice_task_bckup WHERE task_id='".$tasksql_dtls->task_id."'  ORDER BY id ASC");
    $chktsksql=$this->db->query("SELECT * FROM invoice_task_bckup  WHERE task_id='".$tasksql_dtls->task_id."' ORDER BY id DESC LIMIT 1");
    $istaskrow=$chktsksql->row();

     if($tasksql->num_rows()>0)
       {

              foreach ($tasksql->result() as $tasksql_dtls)
                  {

                    $chktskclr=$this->db->query("SELECT * FROM adm_task_type WHERE id='".$tasksql_dtls->task_type."'");
                    $chktskclrrow=$chktskclr->row();
                    if($tasksql_dtls->task_type==$chktskclrrow->id)
                    {
                      $assigntskcolor=$chktskclrrow->color;
                    }else{
                      $assigntskcolor="";
                    }


                    $chktskstatusclr=$this->db->query("SELECT * FROM adm_task_status WHERE id='".$tasksql_dtls->task_completed."'");
                    $chktskstatusclrrow=$chktskstatusclr->row();
                    if($tasksql_dtls->task_completed==$chktskstatusclrrow->id)
                    {
                      $assigntskstscolor=$chktskstatusclrrow->color;
                    }else{
                      $assigntskstscolor="";
                    }



                     $taskId=$tasksql_dtls->task_id;
                     $taskcustname=$tasksql_dtls->cus_fname.' '.$tasksql_dtls->cus_lname;
                     $taskinvId=$tasksql_dtls->invoice_id;
                     $taskstrtdt=$tasksql_dtls->task_date_started;
                     $tasksktyp=$tasksql_dtls->task_type;
                     $tasksubtyp=$tasksql_dtls->sub_task_type;
                     $taskusr=$tasksql_dtls->task_user;
                     $taskduedate=$tasksql_dtls->task_due_date;
                     $taskcompleted=$tasksql_dtls->task_completed;
                     $taskcompletedby=$tasksql_dtls->task_completed_by;
                     $taskcompleteddate=$tasksql_dtls->task_completed_date;
                     $tasknote=$tasksql_dtls->task_note;
                     $taskenteredby=$tasksql_dtls->task_entered_by;


                      //if($taskcompleted==1)
                      $todaysdate=date("m-d-Y");
                      $mydate=date('m-d-Y',strtotime($taskduedate));
                      if($todaysdate > $mydate && $mydate!="01-01-1970")
                         {
                            $rwcolor="background-color: #f17b7b;";
                         }else{
                             $rwcolor="background-color: #e6e677;";
                         }

                  ?>

                      <tr class="tr_clone" style="<?//=$rwcolor?>">

                          <td style="background-color: <?=$assigntskcolor?>">
                             <?php 
                                $dt = date("m/d/Y", strtotime($taskstrtdt));
                            ?>
                            <input type="text" name="task_strtdate" id="task_strtdate" placeholder="mm/dd/yyyy" class="form-control taskstrtdate" value="<?=($dt!="01/01/1970")? $dt : "" ; ?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_date_started')" >

                          

                            <input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?=$taskinvId?>">
                             <input type="hidden" name="hdntskid" class="hdntskid" value="<?=$taskId?>">
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <input type="text" name="task_custname" id="task_custname" class="form-control taskcustname" value="<?=$taskcustname?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskcustname?>','task_custname')">
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <!--  <input type="text" name="task_name" id="task_name" class="form-control taskname" value="<?=$tasksktyp?>" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_type')"> -->

                            <select class="form-control taskuser task_name" name="task_name" id="task_name">
                              <option value=""> </option>
                                <?php
                                 $invtasktype=$this->db->query("SELECT * FROM adm_task_type");
                                 foreach ($invtasktype->result() as $invtasktype_dtls)
                                 {
                                    if($tasksktyp==$invtasktype_dtls->id)
                                     {
                                        $seltsktyp="selected";
                                     }else{
                                        $seltsktyp="";
                                     }

                                    ?>
                                      <option <?=$seltsktyp?> value="<?=$invtasktype_dtls->id?>"><?=$invtasktype_dtls->name?></option>
                                    <?php
                                 }
                              ?>
                            </select>
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <select class="form-control taskuser subtaskname" name="subtaskname" id="subtaskname">
                              <option value=""> </option>
                                <?php
                                 $invtasktype=$this->db->query("SELECT * FROM adm_subtask_type WHERE task_id='".$tasksktyp."'");
                                 foreach ($invtasktype->result() as $invtasktype_dtls)
                                 {
                                    if($tasksubtyp==$invtasktype_dtls->id)
                                     {
                                        $seltsktyp="selected";
                                     }else{
                                        $seltsktyp="";
                                     }

                                    ?>
                                      <option <?=$seltsktyp?> value="<?=$invtasktype_dtls->id?>"><?=$invtasktype_dtls->name?></option>
                                    <?php
                                 }
                              ?>
                            </select>
                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">

                            <select class="form-control" name="task_user" id="task_user" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_user')">
                              <option value=""> </option>
                              <?php
                                 $admloguser=$this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC");
                                 foreach ($admloguser->result() as $admloguser_dtls)
                                 {
                                  if($admloguser_dtls->cus_id==$taskusr)
                                  {
                                    $selusr="selected";
                                  }else{
                                    $selusr="";
                                  }

                                   ?>
                                      <option <?=$selusr?> value="<?=$admloguser_dtls->cus_id?>"><?=$admloguser_dtls->cus_lname?></option>
                                    <?php
                                 }
                              ?>
                            </select>

                          </td>

                          <td style="background-color: <?=$assigntskcolor?>">
                            <?php 
                                $dt = date("m/d/Y", strtotime($taskduedate));
                            ?>
                            <input type="text" name="task_due_date" id="task_due_date" class="form-control taskduedate" placeholder="mm/dd/yyyy" value="<?= ($dt!="01/01/1970")? $dt : ""; ?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_due_date')">
                          </td>

                        <td style="background-color: <?=$assigntskstscolor?>">


                              <select class="form-control taskcompleted" name="task_completed" id="task_completed" style="width: 130px;" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_completed')">
                              <option value=""> </option>
                                <?php
                                 $invtasktype=$this->db->query("SELECT * FROM adm_task_status ORDER BY id ASC");
                                 foreach ($invtasktype->result() as $invtasktype_dtls)
                                 {
                                  if($taskcompleted==$invtasktype_dtls->id)
                                   {
                                      $setselct="selected";
                                   }else{
                                      $setselct="";
                                   }

                                    ?>
                                      <option <?=$setselct?> value="<?=$invtasktype_dtls->id?>"><?=$invtasktype_dtls->name?></option>
                                    <?php
                                 }
                              ?>
                            </select>

                        </td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                             <?php
                                 $admloguser=$this->db->query("SELECT * FROM users WHERE id='".$taskcompletedby."'");
                                 $admloguserrow=$admloguser->row();
                                 $loogedusername=$admloguserrow->name;

                               ?>

                            <input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="<?=$loogedusername?>" readonly>
                          </td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                            <?php 
                                $dt = date("m/d/Y", strtotime($taskcompleteddate));
                            ?>
                            <input type="text" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate" value="<?= ($dt!="01/01/1970")? $dt : ""; ?>" onblur="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_completed_date')"></td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                            <input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value="<?=$tasknote?>" onchange="fnupdatetaksinfo(this.value,'<?=$taskId?>','task_note')">
                          </td>

                          <td style="background-color: <?=$assigntskstscolor?>">
                             <?php
                                 $admloguser1=$this->db->query("SELECT * FROM users WHERE id='".$taskenteredby."'");
                                 $admloguserrow1=$admloguser1->row();
                                 $logedusername=$admloguserrow1->name;

                               ?>
                            <input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn" value="<?=$logedusername?>" readonly>
                          </td>

                        </tr>
                    <?php } }else{
                      echo "<tr><td colspan='11'><h3>No Record Found.</h3></td></tr>";
                    } ?>

                      </tbody>

                    </table>

                    </div>

                            </td>
                          </tr>

                        <!-- End Task History -->


                    <?php } } ?>

                      </tbody>

                    </table>

              </div>



                </div>

            </div>


            </section>
        
        </div>
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/');?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
        
        <script type="text/javascript">
        
          $(document).ready(function(){
        
              $("body").on("click",".collapse-link",function(){
                 $(this).find("i").stop(true,false).toggleClass("fa-chevron-down , fa-chevron-up", 500);
                 $(this).parents(".ibox").find(".ibox-content").stop(true,false).slideToggle(500);
        
              });
        
              $(".close-link").click(function(e){
                // $(this).find("i").stop(true,false).toggleClass("fa-chevron-down , fa-chevron-up");
                  $(this).parents(".ibox").fadeOut(500);
        
              });
        
        
        
          });
        
        </script>

        <script type="text/javascript">
        
        $(document).ready(function(){
            $(".closebtn").click(function(){
                $(this).closest("tr").remove();
            });
            
            $(".snoozbtn").click(function(e){
                // $(this).find("i").stop(true,false).toggleClass("fa-chevron-down , fa-chevron-up");
                $(this).toggleClass("snoozactive");
            });
        });
        
        </script>
        
        <script type="text/javascript">
        $('.dt')
            .datepicker({
            format: 'yyyy-mm-dd'
            // todayHighlight: true
        });
        </script>

        <script>
        function update_event_date(event_id,event_date) 
        {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/update_eventdate')?>',
                data: {event_id:event_id,event_date:event_date},
                dataType: 'text',
                //async: false,
                beforeSend: function() {
                  // setting a timeout
                  $('.fadeMe').show();
                 //alert("before event_id--"+event_id+" event_date--"+event_date);
                },
                success: function(data) {//alert("data--"+data);
                
                  if(data=="success")
                  {
                    window.location.href="<?=base_url('fi_home')?>";
                    $('.fadeMe').hide();
                  }else{
                     $('.fadeMe').hide();
                  }
                },
                error: function(xhr) {
                // $('.fadeMe').hide();
                },
                complete: function() {
                // $('.fadeMe').hide();
                }
            
            });
        }
        </script>


        <script type="text/javascript">
        
          $(document).ready(function(){
            $("body").on("click", "#mytasks tr td .collapse-link",function(){
              // alert("done");
              $(this).parents("tr").next("tr").find(".ibox-content").slideToggle(500);
            });
          });
        </script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.task_name',function(){

  var taskId= $(this).val();
  var subtaskname= $(this).parents('.tr_clone').find('.subtaskname');
  var taskcompleted= $(this).parents('.tr_clone').find('.taskcompleted');
  var hdntskid= $(this).parents('.tr_clone').find('.hdntskid').val();
  // alert(hdntskid);

        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/loadsubtaskslist')?>',
        data: {taskId:taskId,hdntskid:hdntskid},
        dataType: 'json',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("taskId--"+taskId);
         },
        success: function(data) {
          //alert("data--"+data);
          var appendata=data.subtasklist;
          subtaskname.html('');
          subtaskname.html('<option> </option>');
          $.each(appendata,function(appendata,item)
          {
            subtaskname.append('<option value="'+item.id+'">'+item.name+'</option>');
          });
          taskcompleted.html('');
          taskcompleted.html('<option> </option>');
          // $('#mytasks').load(location.href + ' #mytasks >*');
          $('.fadeMe').hide();
        },
        error: function(xhr) {
          // $('.fadeMe').hide();
        },
        complete: function() {
         // $('.fadeMe').hide();
        }
        });
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.subtaskname',function(){

  var subtaskId= $(this).find('option:selected').val();
  var taskId= $(this).parents('.tr_clone').find('.task_name option:selected').val();
  var taskdate= $(this).parents('.tr_clone').find('.taskstrtdate').val();
  var invoiceid= $(this).parents('.tr_clone').find('.hdntskinvd').val();
  var hdntskid= $(this).parents('.tr_clone').find('.hdntskid').val();
  var user= $(this).parents('.tr_clone').find('#task_user option:selected').val();
  var tasksts = $(this).parents('.tr_clone').find('.taskcompleted option:selected').val();
  var taskcompletdby = $(this).parents('.tr_clone').find('.taskcompletedby').val();
  var taskcompletdt = $(this).parents('.tr_clone').find('.taskcompleteddate').val();

    // alert(taskdate);
    // alert("subtaskId--"+subtaskId+" taskId--"+taskId+" taskdate--"+taskdate+" invoiceid--"+invoiceid+" hdntskid--"+hdntskid+" user--"+user+" tasksts--"+tasksts+" taskcompletdby--"+taskcompletdby+" taskcompletdt--"+taskcompletdt);
        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/updtinvtaskinfo')?>',
        data: {subtaskId:subtaskId,taskId:taskId,taskdate:taskdate,invoiceid:invoiceid,hdntskid:hdntskid,user:user,tasksts:tasksts,taskcompletdby:taskcompletdby,taskcompletdt:taskcompletdt},
        dataType: 'text',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();

         },
        success: function(data) {
          // alert("data--"+data);
           //var custid= $('#custnm option:selected').val();
          if(data=="success")
          {
             //$('#mytasks').html(data);
            // fngetinvoicedetails(invoiceid,'terms',custid);
             $('.fadeMe').hide();
             $('#mytasks').load(location.href + ' #mytasks >*');
             // location.href=load(location.href);
             // window.location.href='<?=site_url('fi_home/task_history')?>';

          }

        },
        error: function(xhr) {
          // $('.fadeMe').hide();
        },
        complete: function() {
         // $('.fadeMe').hide();
        }
        });
});
});
</script>

<!--  Update Task -->
<script type="text/javascript">
 function fnupdatetaksinfo(inptxtval,taksId,fieldnm)
  {
       
        var invoiceid = $('#filterinvoicedata .active-cust').find('.hdninvrowId').val();

        if(fieldnm=="task_date_started" || fieldnm=="task_due_date" || fieldnm=="task_completed_date")
        {
          
            var arr = inptxtval.split("/");
            newdate = arr[2]+"-"+arr[0]+"-"+arr[1];
            


                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/updinvtask')?>',
                        data: {taksId:taksId,inptxtval:newdate,fieldnm:fieldnm},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("invoiceid--"+invoiceid);

                        },
                        success: function(data) {
                            
                           
                          
                            var custid= $('#custnm option:selected').val();
                           if(data=="success1")
                            {
                                // fngetinvoicedetails(invoiceid,'terms',custid);
                                // window.location.href='<?=site_url('fi_home/task_history')?>';
                                $('#mytasks').load(location.href + ' #mytasks > *');
                                $('.fadeMe').hide();
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

         

        }else{
           
                $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updinvtask')?>',
                data: {taksId:taksId,inptxtval:inptxtval,fieldnm:fieldnm},
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {

                     //$('#mytasks').html(data);
                    // $('.fadeMe').hide();
                     var custid= $('#custnm option:selected').val();
                    if(data=="success")
                    {
                        // fngetinvoicedetails(invoiceid,'terms',custid);
                        // window.location.href='<?=site_url('fi_home/task_history')?>';
                         $('#mytasks').load(location.href + ' #mytasks >*');
                        $('.fadeMe').hide();
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
<!-- End Update Task -->

<script>
function loadstatus(name)
{
  //var name = $('#searc22').val();
  //var name = $('#searc').val();
  //var name= $("#searc option:selected").val();
  // alert("status--"+name);
  window.location.href="<?=site_url('fi_task/task_stauts/')?>"+name;




}
</script>

<script type="text/javascript">
function call_invoice(cusId)
	{
// alert(cusId);
if (cusId !="") {


$.ajax({
type: 'POST',
url: '<?=site_url('fi_task/invoice_open')?>',
data: {cusId:cusId},
dataType: 'text',
beforeSend: function() {
    // setting a timeout
    $('.fadeMe').show();

},
success: function(data) {

  // alert(data);
     //$('#mytasks').html(data);
    // $('.fadeMe').hide();
     // var custid= $('#custnm option:selected').val();
    if(data!="")
    {
      var cu_name= localStorage.setItem("customer_name",data);
      localStorage.setItem("pckId",cusId);
        // fngetinvoicedetails(invoiceid,'terms',custid);
        window.location.href='<?=site_url('fi_home/custinvoices#terms')?>';

    }else{


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
else {

}

      // $('#myModal').hide();
      // $('.modal-backdrop.in ').hide();




	}
</script>


<script>
$(document).ready(function(){
  $("body").on("keydown", ".taskduedate", function(event)
  {

     var key = event.keyCode;
     var temp_edate =  $(this).parents(".tr_clone").find(".taskduedate");

     if(key=="107" || key=="187")
     {
         //alert("date+");
         var dtpls;
         if(temp_edate.val()=="")
         {
             dtpls= new Date();
         }
         else
         {
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
         var today1 = yyyy + '/' + mm + '/' +  dd;


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
         var today1 = yyyy + '/' + mm + '/' +  dd;

         //alert("minus today--"+today);
         //$('#edate').val(today);
         temp_edate.val(today);

         event.preventDefault();

     }
     else if(key=="68")
     {
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
  $("body").on("keydown", ".taskcompleteddate", function(event)
  {

     var key = event.keyCode;
     var temp_edate =  $(this).parents(".tr_clone").find(".taskcompleteddate");

     if(key=="107" || key=="187")
     {
         //alert("date+");
         var dtpls;
         if(temp_edate.val()=="")
         {
             dtpls= new Date();
         }
         else
         {
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
         var today1 = yyyy + '/' + mm + '/' +  dd;


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
         var today1 = yyyy + '/' + mm + '/' +  dd;

         //alert("minus today--"+today);
         //$('#edate').val(today);
         temp_edate.val(today);

         event.preventDefault();

     }
     else if(key=="68")
     {
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
  $("body").on("keydown", ".taskstrtdate", function(event)
  {

     var key = event.keyCode;
     var temp_edate =  $(this).parents(".tr_clone").find(".taskstrtdate");

     if(key=="107" || key=="187")
     {
         //alert("date+");
         var dtpls;
         if(temp_edate.val()=="")
         {
             dtpls= new Date();
         }
         else
         {
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




<?php


 ?>
