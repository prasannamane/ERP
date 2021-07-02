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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
	   .dropdown-submenu 
       {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu 
        {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }

        .loader 
        {
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
            padding: 0.6px 0px;
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

        .select2-container .select2-selection--single {
            height: 22px !important;
            margin: -1px 0 0 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {  line-height: 1 !important; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 21px !important; }

        .modal.fade.in {
            opacity: 1;
            display: block !important;
        }

        .mybtns .btn {
            margin: 0 5px;
            width: 90px;
        }

        .new_shadow {
            box-shadow: 0 0 10px #1ca5a5;
        }

        .new_shadow textarea {
            border: 2px solid #ccc;
            border-radius: 4px;
            height: 120px;
            margin: 10px 0;
        }

        .new_shadow  input{
            border: 2px solid #ccc;
            border-radius: 4px;
            height: 20px;
            margin: 10px 0;
        }

        .new_shadow strong {
            margin: 0 0 6px 0;
            display: block;
        }

        .correspond_modal > div {
            width: 100%;
            max-width: 800px;
            margin: 130px auto 0 auto;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
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
            <div class="row">
                <div class="col-md-12">

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

            <?php $this->load->view('template/note_select_customer'); ?>
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
                                <?php $i = 1;

                                foreach ($invoice_note as $row) 
                                {
                                    $inv_id = $row['inv_id'];  ?>
                                    <tr>
                                        <td><span><?=$inv_id?></span></td>
                                        <td class="w90">
                                            <?php $dt = date("m/d/Y",strtotime($row['date']));  ?>
                                            <input type="text" name="note_date" class="form-control " placeholder="mm/dd/yyyy"  value="<?=($dt!="01/01/1970") ? $dt : "";  ?>" readonly>
                                        </td>
                            
                                        <td>
                                            <input placeholder="HH:MM" type="text" name="note_time" class="form-control cus_not_not_tim<?=$row['id']?>" value="<?=$row['time'] ?>" readonly onblur="cus_not_not_tim(<?=$row['id']?>)">
                                        </td>
                        
                                        <td>
                                            <select class="form-control event_name" name="" id="">
                                                <option>Choose</option>
                                                <?php
                                                foreach ($event_data as $row1) {
                                                    $selected = '';
                                                    if($row1['event_id'] == $row['event_name'])
                                                    {
                                                        $selected = "selected";
                                                    }
                                                    ?><option <?=$selected?> value="<?=$row1['event_id']?>"><?=$row1['event_name']?></option><?php
                                                }

                                                ?>
                                            </select>
                                        </td>
                            
                                        <td>
                                            <select class="form-control" name="notestype" id="notestype">
                                                <option> option 1 </option>
                                                <option> option 2</option>
                                                <option> option 3</option>
                                            </select>
                                        </td>
                        
                                        <td>
                                            <input type="text" name="note_desc" class="form-control" value="<?=$row['note']  ?>" readonly>
                                        </td>
                                        
                                        <td>
                                            <button onclick="fndelinvoice('<?=$invoice_note['id']?>')" class="btn btn-xs btn-danger tr_clone_add"><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <?php 
                                } ?>

                                <tr class="tr_clone">
                                    <td>
                                        <span>#</span>
                                    </td>
                                    
                                    <td class="w90">
                                        <input type="text" name="note_date" class="form-control " placeholder="mm/dd/yyyy"  value="" readonly>
                                    </td>
                                
                                    <td>
                                        <input placeholder="HH:MM" type="text" name="note_time" class="form-control cus_not_not_tim9898989" value="" readonly onblur="cus_not_not_tim(9898989)">
                                    </td>
                                    
                                    <td>
                                        <select class="form-control event_name" name="" id="">
                                            <option>Choose</option>
                                            <?php
                                            foreach ($event_data as $row) {
                                                ?><option value="<?=$row['event_id']?>"><?=$row['event_name']?></option><?php
                                            }

                                            ?>
                                        </select>

                                    </td>
                        
                                    <td>
                                        <select class="form-control" name="notestype" id="notestype">
                                            <option>  </option>
                                            <option> option 1 </option>
                                            <option> option 2</option>
                                            <option> option 3</option>
                                        </select>
                                    </td>
                                
                                    <td>
                                        <input type="text" name="note_desc1" class="note_desc1" class="form-control" value="" onblur="Save_Notis()" style=" width: 100%;"></td>
                                    <td>
                                        <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <script type="text/javascript"> 
                            function Save_Notis() 
                            {
                                var note_desc1 = $('.note_desc1').val();
                                var event_name = $('.event_name').val();
                                var id = "<?=$inv_id?>";                  

                                $.ajax({
                                    type: 'POST',
                                    url: "<?=base_url('CustomersNotes/Save_Notis')?>", 
                                    data: { note_desc1 : note_desc1, id : id, event_name : event_name},
                                    success: function(result)
                                    {
                                        window.location.href = "c_notes";
                                    }
                                });
                            }
                                /*dynamic Start Time*/
                                function cus_not_not_tim(my) {
                                  var my_Time = $('.cus_not_not_tim'+my).val();
                                  var my_Time_count = my_Time.toString().length;
                                  var arr = ["00", "00"];
                                  if(my_Time_count == 4) {
                                    if(my_Time > 0 && my_Time < 1300) {
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                     $('.cus_not_not_tim'+my).val(res);
                                  }
                                  else {
                                    var num = my_Time - 1200;
                                    my_Time = num.toString();
                                    var my_Time_count = my_Time.toString().length;
                                    if(my_Time_count == 3){
                                      my_Time = '0'.concat(my_Time); 
                                    }
                                    if(my_Time > 0 && my_Time < 1300){
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                      $('.cus_not_not_tim'+my).val(res);
                                    }
                                    else {
                                      alert("Time is not correct")
                                    }
                                  }
                                }
                               else if(my_Time_count > 4){

                                   // alert("Value should be 4 digit");
                                  }
                                  else if(my_Time_count > 0){
                                    alert("Value should be 4 digit");
                                  }
                                }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    <div class="mytabber">
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
                          <th class="w100">Type</th>
                          <th>description</th>
                          <th class="w80">Date</th>
                          <th class="w80">Time</th>
                          <th class="w80">Completed</th>
                          <th  class="w100">For User</th>
                          <th>Note</th>
                          <th  class="w80">Priority</th>
                          <th class="w80">Date Entered</th>
                          <th>Reminder</th>
                          <th  class="w80">User</th>
                      </tr>
                   </thead>
                  <tbody id="dispinvnotes">
                    <?php $i = 1;
                    foreach ($appointmtnt as $customer_appointment) { ?>
                      <tr class="tr_clone">
                        <td style="vertical-align: middle;">
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
                          <input type="text" list="<?= $customer_appointment['appointment_type']?>" name="app_desc" id="notedate" value="<?= $customer_appointment['app_desc'] ?>" class="form-control descp" autocomplete="off" onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','app_desc')" >
                            <?php 
                            if(!empty($todo_descp_list)) {

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
                            <input type="text" name="note_datetime" value="<?php echo ($dt!="01/01/1970")? $dt : ""; ?>" placeholder="mm/dd/yyyy" class="form-control updwn invdudate_details w80"  onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_datetime')">
                        </td>

                        <td>
                          <input 
                          type="text"
                          placeholder="HH:MM"
                          name="note_time" 
                          value="<?= $customer_appointment['note_time'] ?>" 
                          class="form-control updwn cus_not_not_app_<?=$customer_appointment['id']?>"
                          onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_time')"></td>


                          
                        <td>
                          <input class="" type="checkbox" value="1" id="iteam" name="iteam_check" onblur="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','iteam_check')" <?php if ($customer_appointment['iteam_check'] == 1) { ?>
                          checked
                        <?php }else { ?>

                        <?php  } ?> >
                        </td>

                            <td>
                        <select class="form-control" name="notestype_user" id="notestype_user">
                          <option  value="<?=$customer_appointment['for_user']?>"> <?=$customer_appointment['username']?>
                          <?php foreach ($for_user as $row) { ?>
                            <option  value="<?=$row['id']?>"> <?=$row['username']?></option>
                          <?php  
                            } 
                          ?> 
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
                          <input type="text" name="note_date" value="<?= ($dt!="01/01/1970")? $dt : "";  ?>" placeholder="mm/dd/yyyy" class="form-control " readonly tabindex="-1">
                        </td>
                        <td>
                          <input type="text" name="note_remider" value="<?= $customer_appointment['note_remider'] ?>" class="form-control" onchange="fnupdate_details(this.value,'<?=$customer_appointment['id']?>','note_remider')">
                        </td>
                        <td>
                          <input type="text" name="note_user" value="<?=$customer_appointment['username']?>" class="form-control" readonly>
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
                        <th class="w80">Date</th>
                        <th>Time</th>
                        <th class="w80">Completed</th>
                        <th>For User</th>
                        <th>Note</th>
                        <th>Priority</th>
                        <th class="w80">Date Entered</th>
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

                      <td class="w100">
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

                      <td class="w80">
                        <input type="text" name="note_datetime" value="" placeholder="mm/dd/yyyy" class="form-control updwn invdudate ">
                      </td>
                      <td  class="w80">
                        <input 
                        type="text" 
                        placeholder="HH:MM" 
                        name="note_time" 
                        value="" 
                        class="form-control updwn cus_not_not_app_stat" 
                        onblur="cus_not_not_app_stat()">

                        <script type="text/javascript"> 
                                /*dynamic Start Time*/
                                function cus_not_not_app_stat() {
                                  var my_Time = $('.cus_not_not_app_stat').val();
                                  var my_Time_count = my_Time.toString().length;
                                  var arr = ["00", "00"];
                                  if(my_Time_count == 4) {
                                    if(my_Time > 0 && my_Time < 1300) {
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                     $('.cus_not_not_app_stat').val(res);
                                  }
                                  else {
                                    var num = my_Time - 1200;
                                    my_Time = num.toString();
                                    var my_Time_count = my_Time.toString().length;
                                    if(my_Time_count == 3){
                                      my_Time = '0'.concat(my_Time); 
                                    }
                                    if(my_Time > 0 && my_Time < 1300){
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                      $('.cus_not_not_app_stat').val(res);
                                    }
                                    else {
                                      alert("Time is not correct")
                                    }
                                  }
                                }
                               else if(my_Time_count > 4){

                                   // alert("Value should be 4 digit");
                                  }
                                  else if(my_Time_count > 0){
                                    alert("Value should be 4 digit");
                                  }
                                }
                              </script>
                      </td>
                      <td class="w80">
                        <input class="" type="checkbox" value="1" id="iteam" name="iteam_check" >
                      </td>

                      <td class="w100">
                        <select class="form-control" name="for_user" id="">
                        <option  value=""> Choose Admin</option>
                          
                          <?php foreach ($for_user as $row) { ?>
                            <option  value="<?=$row['id']?>"> <?=$row['username']?></option>
                          <?php  
                            } 
                          ?> 
                       </select>
                      </td>

                      <td>
                        <input type="text" name="appointmtnt_note" value="" class="form-control">
                      </td>
                      <td  class="w80">
                        <select class="form-control" name="appointment_priority" id="priority">
                           <option value="">  </option>
                           <option value="High Priority">High Priority</option>
                           <option value="Low Priority">Low Priority</option>
                           <!-- <option value="option 3">option 3</option> -->

                       </select>
                      </td>
                      <td class="w80">
                        <input type="text" name="note_date" value="<?= date('m/d/Y')?>" readonly class="form-control " tabindex="-1"></td>
                      <td><input type="text" name="note_remider" value="" class="form-control"></td>
                      <td  class="w80">
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
          <p class="uhead2 pull-left">Correspondence </p> 
          <p class="uhead2 pull-right btn btn-primary btn-xs" data-toggle="modal" data-target="#correspond_modal_new_mail">New Mail </p>
        </div>

        <div class="box-body">
          <form action="<?=site_url('fi_notes/addcorrespondence')?>" method="POST" id="dform">
            <div class="table-responsive">
              
              <table class="table table-hover no-margin fixed_table correspond_table1">
                <thead>
                      <tr>
                          <th class="w80">Date</th>
                          <th class="w80">Time</th>
                          <th class="w300">Subject</th>
                          <th class=" ">Email Body</th>
                          <th class="w300">Email</th>
                         <!--  <th class="w60">Action</th>  -->
                      </tr>
                </thead>
                
                <tbody class="correspond_tbody"> 
                    <?php  foreach($corr_email as $row) {   ?>
                      <tr class="tr_clone" >
                      <!-- onclick="email_popup('<?=$row['subject']?>','<?=$row['body']?>')" -->
 
                        <td class="btnSelect"><?=date("m/d/Y", strtotime($row['date']))?> </td>
                        <td class="btnSelect"><?=$row['time']?></td>
                        <td class="btnSelect sub<?=$row['id']?>" value="1"><?=substr($row['subject'], 0, 50)?></td>
                        <td class="btnSelect bod<?=$row['id']?>"  value="1"><?=substr($row['body'], 0, 180)?></td>
                        <td class="btnSelect eml<?=$row['id']?>"  value="1"><?=substr($row['email'], 0, 50)?></td>

                        <!--  <td class="btnSelect2">Reply</td> -->
                      </tr>

                      <?php
                    } ?>
                      

                     </tbody>
                </table>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>

      </div>
 
</div>
</div>
</div>



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
              <!--       <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                          </div> -->
                   </div>

                     <div class="col-xs-3">
               <!--      <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                          </div> -->
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
<!-- 
                         <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                          </div> -->

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

                      <div class="box box-primary mt20 ">
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
                                          <textarea name="invoice_payment[]" rows="6" class="form-control">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
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
                       
                        </div>
                      </div>
              </div>
      </div>
    </div>
  </div>
</div>




<!-- myModal2 -->
<div class="modal fade email_modal correspond_modal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply Email Form</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <form id="frmsendcrewmail" name="frmsendcrewmail" method="post" action="<?=site_url('fi_home/noti_mail')?>" enctype="multipart/form-data">
            <div class="box box-info secondblock_bg ">
              <div class="row">
                <div class="col-xs-12">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin"> 
                      <thead> 
                        <tr>
                          <th >Email Address:</th>  
                        </tr>
                        <tr>
                          <td ><input type="text" name="nwcustemail"  id="nwcustemail"  class="form-control email_correspondant1"  value="<?=$sender_mail?>"  readonly>  </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <hr>

            <div class="box box-info firstblock_bg ">
              <div class="row">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                  <div class="row">
                    <div class="col-xs-3">
          <!--             <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                        </div> -->
                      </div>
                      <div class="col-xs-3">
               <!--          <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                          </div> -->
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
               </div>
               <hr>
               <div class="box box-primary mt20 thirdblock_bg " >
                <!--<p class="uhead2 pt10">Payment Applied To</p>-->
                <div class="box-body">
                 <div class="row">
                   <div class="col-xs-2">
                     <label>Attachments</label>
                     <!--  <button type="button" class="btn btn-default btn-xs">Add Attachment</button> -->
                     <input type="file" name="crewavl[]" id="crewavl" multiple="multiple">
                   </div>
                 </div>
                 <!-- /.box -->
                 <hr>
                 <div class="row">
                   <div class="col-xs-2">
                     <label>Subject</label>
                   </div>
                   <div class="col-xs-10">
                    <input type="text" name="letteremailsub" id="letteremailsub" class="form-control emailsub_correspondant1" value="">
                  </div>
                </div>
                <hr>
                <div class="row">
                 <div class="col-xs-2">
                   <label>Body</label>
                   <!--   <button type="button" class="btn btn-default btn-xs">Check Spelling</button> -->
                 </div>
                 <div class="col-xs-10">
                   <!--   <div id="leteremaildesc" contenteditable="true" class="form-control" spellcheck="true"></div> -->
                   <textarea name="leteremaildesc" id="leteremaildesc" rows="6" class="form-control reply_body" spellcheck="true"></textarea>
                 </div>
               </div>
               <div class="row">
                 <div class="col-xs-2">
                 </div>
                 <div class="col-xs-10 mt20" >
                   <div class="row ">
                     <div class="col-xs-6">
                     </div>
                     <div class="col-xs-6"> 
                       <button type="submit" class="btn btn-primary sendemail pull-right">Send Email</button>
                       <button type="button" class="btn btn-primary pull-right mr10" data-dismiss="modal" aria-label="Close">Cancel </button>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
</div>
<!-- Model 2 END -->


<!-- myModal2 -->
<div class="modal fade email_modal" id="correspond_modal_new_mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Email Form</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <form id="frmsendcrewmail" name="frmsendcrewmail" method="post" action="<?=site_url('fi_home/noti_mail')?>" enctype="multipart/form-data">
            <div class="box box-info secondblock_bg ">
              <div class="row">
                <div class="col-xs-12">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin">
                      <thead>
                        <tr>
                          <th >Email Address:</th>
                        
                        </tr>
                     
                        <tr>
                          <td ><input type="text" name="nwcustemail"  id="nwcustemail"  class="form-control"  value="<?=$sender_mail?>"  readonly>  </td>
                       
                        </tr>
                      
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <hr>

            <div class="box box-info firstblock_bg ">
              <div class="row">
                <div class="col-xs-2">
                </div>
                <div class="col-xs-10">
                  <div class="row">
                    <div class="col-xs-3">
    <!--                   <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                        </div> -->
                      </div>
                      <div class="col-xs-3">
           <!--              <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                          </div> -->
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
               </div>
               <hr>
               <div class="box box-primary mt20 thirdblock_bg " >
                <!--<p class="uhead2 pt10">Payment Applied To</p>-->
                <div class="box-body">
                 <div class="row">
                   <div class="col-xs-2">
                     <label>Attachments</label>
                     <!--  <button type="button" class="btn btn-default btn-xs">Add Attachment</button> -->
                     <input type="file" name="crewavl[]" id="crewavl" multiple="multiple">
                   </div>
                 </div>
                 <!-- /.box -->
                 <hr>
                 <div class="row">
                   <div class="col-xs-2">
                     <label>Subject</label>
                   </div>
                   <div class="col-xs-10">
                    <input type="text" name="letteremailsub" id="letteremailsub" class="form-control" value="">
                  </div>
                </div>
                <hr>
                <div class="row">
                 <div class="col-xs-2">
                   <label>Body</label>
                   <!--   <button type="button" class="btn btn-default btn-xs">Check Spelling</button> -->
                 </div>
                 <div class="col-xs-10">
                   <!--   <div id="letteremaildesc" contenteditable="true" class="form-control" spellcheck="true"></div> -->
                   <textarea name="letteremaildesc" id="letteremaildesc" rows="6" class="form-control" spellcheck="true"></textarea>
                 </div>
               </div>
               <div class="row">
                 <div class="col-xs-2">
                 </div>
                 <div class="col-xs-10 mt20" >
                   <div class="row ">
                     <div class="col-xs-6">
                     </div>
                     <div class="col-xs-6">
                       <button class="btn btn-primary sendemail pull-right">Send Email</button>
                       <button type="button" class="btn btn-primary pull-right mr10" data-dismiss="modal" aria-label="Close">Cancel </button>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
</div>
<!-- Model 2 END -->

  <!-- <div class="modal fade correspond_modal_new_mail" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="close_model" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title">New Email <span class="email_succ1"></span> </h4>
        </div>
     
        <div class="modal-body">
          <div class="box-body">
            <div class="box box-primary mt20 new_shadow">
              <div class="box-body">    
                <p> 
                  <strong>Email To : <br></strong>  
                  <input type="text" name="reply_email1" class="form-control" placeholder="subject" value="<?=$sender_mail?>"> 
                </p><br>
  
                <p> 
                  <strong>Email Subject : <br></strong>  
                  <input type="text" name="reply_subject1" class="form-control" placeholder="subject"> 
                </p><br>
  
                <p> 
                  <strong>Email Body : <br></strong>    
                  <textarea name="comment_" class="form-control reply_body1" placeholder="Comments" rows="6"> </textarea>
                </p>
                
                <div class="mybtns mt20 ">
                  <a class="btn btn-xs btn-primary pull-right" onclick="send_mail()">Send</a> 
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
  
            <script type="text/javascript">
  
              function send_mail() {
  
                var email_    = $("input[name=reply_email1]").val();
                var subject_  = $("input[name=reply_subject1]").val();
                var comment_  = $(".reply_body1").val();
  
                $.ajax({
                              type: 'POST',
                              url: "<?=site_url('Fi_notes/send_mail')?>", 
                              data: {comment_:comment_, subject_:subject_, email_:email_},
                              success: function(result){
                                if(result){$(".email_succ1").html("<p style='color:green'>:Email has been Sent</p>");}
                                  else{
                                    $(".email_succ1").html("<p style='color:red'>:Email sending fail</p>");
                                  }
  
                               
                               
                              }
                            });
  
                            
                          }
                     
                         </script>
             </div>
     </div>
   </div>
   </div>
  </div> -->

<!-- <script type="text/javascript">

  //$(document).ready(function() {

    function send_mail(){
      
      var email_    = $("input[name=reply_email]").val();
      var subject_  = $("input[name=reply_subject]").val();
      var comment_  = $(".reply_body").val();

      $.ajax({
        type  : 'POST',
        url   : "<?=site_url('Fi_notes/send_mail')?>", 
        data  : { comment_ : comment_, subject_ : subject_, email_ : email_ },
        success: function(result) {

          $(".email_succ").html("<p style='color:green'>:Email has been Sent</p>");
        }
      });

    }
//  });
</script> -->



    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>


   <script src="<?=base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   <script src="<?php echo base_url("assets"); ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
   <script src="<?php echo base_url("assets"); ?>/js/daterangepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
     $("#correspond_modal_new_mail .close, #correspond_modal_reply_mail .close").click(function(){
      //alert(1);
         $(".modal-backdrop").remove();
         $("body").removeClass(".modal-open");

     });

    });


  </script>

  <script type="text/javascript">
    
    $( document ).ready(function() {

      $.ajax({
        url: "<?=site_url('Email_reader')?>", 
          success: function(result){
          console.log("Email Updated from server");
      }});
    });

    $(document).ready(function(){ 
      $("#reminder_modal .close").click(function(){ 
          $(".modal-backdrop").remove();
          $("body").removeClass(".modal-open");

      });

     });

   </script>

   <script type="text/javascript">
     $(document).ready(function(){ 
      $("#correspond_modal .close").click(function(){ 
          $(".modal-backdrop").remove();
          $("body").removeClass(".modal-open");

      });

      // click on outside 

      $("#correspond_modal").click(function(e){

          // Check if click was triggered on or within #menu_content
          if( $(e.target).closest(".modal-dialog").length > 0 ) {
              return false;
          }

          $(".modal-backdrop").remove();
          $("body").removeClass(".modal-open");
          $(this).removeClass("in");
          
          // Otherwise
          // trigger your click function
      });     


     });

   </script>

<script type="text/javascript">

  $(document).ready(function() {

    // code to read selected table row cell data (values).
    $(".tr_clone").on('click','.btnSelect',function() {
      // get the current row

      var currentRow = $(this).closest("tr"); 
      var col1 = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
      var col2 = currentRow.find("td:eq(1)").text(); // get current row 2nd TD
      var col3 = currentRow.find("td:eq(2)").text(); // get current row 3rd TD
      var col4 = currentRow.find("td:eq(3)").text(); // get current row 3rd TD
      var col5 = currentRow.find("td:eq(4)").text(); // get current row 3rd TD
      


      $(".correspond_modal .emailsub_correspondant").html(col3);
      $(".correspond_modal .emailsub_correspondant1").val(col3);

      $(".correspond_modal .email_correspondant1").val(col5);
      $(".correspond_modal .email_correspondant").html(col5);

      $(".correspond_modal .emailbody_correspondant").html(col4);
      $(".correspond_modal").addClass('in'); 
      $('body').append('<div class="modal-backdrop fade in"></div>');

      $.ajax({
          url: "<?=site_url('Email_reader')?>", 
          success: function(result){
          //console.log(4);
        }});
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
    if(pckId ===null || pckId=='N')
    {
        var custnm = $('#cus_names').val();
        if (custnm=='undefined') {
          custnm=0;
        }
        fnsearchattchments(custnm);
    }else{
        fnsearchattchments(pckId);
    }
});
</script>


<!-- <script type="text/javascript">
  let a =>(){return 3};

  console.log(a);

</script> -->

<script>
/*$(document).ready(function(){
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
});*/
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

<script language="JavaScript" type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore)
{ 
    localStorage.setItem("customer_name", selObj.options[selObj.selectedIndex].text);
    fnsearhinvoice(selObj.options[selObj.selectedIndex].value);
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
$(document).ready(function() {

  
  

   

  


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


<script type="text/javascript"> 
                                /*dynamic Start Time*/
                               /* function cus_not_not_app_() {
                                  var my_Time = $('.cus_not_not_app_stat').val();
                                  var my_Time_count = my_Time.toString().length;
                                  var arr = ["00", "00"];
                                  if(my_Time_count == 4) {
                                    if(my_Time > 0 && my_Time < 1300) {
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                     $('.cus_not_not_app_stat').val(res);
                                  }
                                  else {
                                    var num = my_Time - 1200;
                                    my_Time = num.toString();
                                    var my_Time_count = my_Time.toString().length;
                                    if(my_Time_count == 3){
                                      my_Time = '0'.concat(my_Time); 
                                    }
                                    if(my_Time > 0 && my_Time < 1300){
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                      $('.cus_not_not_app_stat').val(res);
                                    }
                                    else {
                                      alert("Time is not correct")
                                    }
                                  }
                                }
                               else if(my_Time_count > 4){

                                   // alert("Value should be 4 digit");
                                  }
                                  else if(my_Time_count > 0){
                                    alert("Value should be 4 digit");
                                  }
                                }*/
                              </script>

<!--  Update Invoice -->
<script type="text/javascript">
  
  function fnupdate_details(inptxtval,invoiceid,fieldnm) {

    if(fieldnm == 'note_time'){


      var my_Time = $('.cus_not_not_app_'+invoiceid).val();
                                  var my_Time_count = my_Time.toString().length;
                                  var arr = ["00", "00"];
                                  if(my_Time_count == 4) {
                                    if(my_Time > 0 && my_Time < 1300) {
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                     $('.cus_not_not_app_'+invoiceid).val(res);
                                     inptxtval = res;
                                  }
                                  else {
                                    var num = my_Time - 1200;
                                    my_Time = num.toString();
                                    var my_Time_count = my_Time.toString().length;
                                    if(my_Time_count == 3){
                                      my_Time = '0'.concat(my_Time); 
                                    }
                                    if(my_Time > 0 && my_Time < 1300){
                                      arr = my_Time.match(/.{1,2}/g);
                                      var res = arr[0]+":"+arr[1]+" PM";
                                      $('.cus_not_not_app_'+invoiceid).val(res);
                                       inptxtval = res;
                                    }
                                    else {
                                      alert("Time is not correct")
                                    }
                                  }
                                }
                               else if(my_Time_count > 4){

                                   // alert("Value should be 4 digit");
                                  }
                                  else if(my_Time_count > 0){
                                    alert("Value should be 4 digit");
                                  }
      //inptxtval = $('.cus_not_not_app_'+invoiceid).val();
    }

    var notestype_user = $('#notestype_user').val();

    if(fieldnm == "note_datetime" || fieldnm == "note_date") {

      var arr =  inptxtval.split("/");
      inptxtval = arr[2] +"-"+ arr[0] +"-"+ arr[1];

    }

    $.ajax({
      type: 'POST',
      url: '<?=site_url('Fi_notes/updateappointment')?>',
      data: {invoiceid : invoiceid, inptxtval : inptxtval, fieldnm : fieldnm, notestype_user:notestype_user},
      dataType: 'text',
      beforeSend: function() {
        $('.fadeMe').show();
      },
      success: function(data) {
        
        if(data=="success") {

          $('.fadeMe').hide();
        }
        else if(data=="error") {

          $('.fadeMe').hide();
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


function fnsearchattchments(id) 
{

}
</script>

<a style="display: none" href="<?php echo site_url('fi_home/');?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
<script src="<?php echo base_url('assets/');?>js/prasanna.js"></script>
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('letteremaildesc');
    CKEDITOR.replace('leteremaildesc');
</script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $.ajax({
            type: "POST",
            url: "<?=base_url('Fi_home/getSearchCustContactInfo'); ?>",//getSearchInvoiceInfo
            data: {name:<?=$cus_id?>},
            dataType: 'html',
            success: function(data)
            {
                $('.loaduppertabcntdtls').html(data);
            }
        });
    });
</script>