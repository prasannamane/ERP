<!DOCTYPE html>
  <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ERP System | To Do / Appointment List </title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">

    <!-- bootstrap datepicker -->

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- Bootstrap time Picker -->

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/timepicker/bootstrap-timepicker.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- Google Font -->

    <link rel="stylesheet"

      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
        margin-bottom: 0;
    }

    #divloadinvtabs .box-body{ padding-top: 0; padding-bottom:0; }

    .btn-info {
    background: #4cc0c0;
    min-width: 100px;
    border-radius: 5px !important;
}

.box .form-control {
    background: #fff;
}

.form-group.nospacerow {
    margin: 0 -5px 10px -5px !important;
}

.nospacerow div[class *= "col-"] {
    padding: 0 5px;
}

.nospacerow .checkbox {
    text-align: left;
    display: block;
    margin: 0 0 0 -10px;
    width: initial;
    padding: 0 !important;
}

.nospacerow .checkbox label { 
    width: initial;
    margin-left: -10px;
}


.graybox .btn {
    margin: 0 auto !important; 
}

.nospacerow div[class *= "col-"] > .form-control {
    max-width: 100%;
    width: 100% !important;
}


      </style>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <!-- <div class="wrapper">

    <?php  ?> -->

    <!-- Left side column. contains the logo and sidebar -->

    <!-- <?php  ?> -->

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Tasks</a></li>

        <li class="active">To Do List</li>

      </ol>

    </section>
    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>
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

      <section class="content">

        <!-- TABLE: LATEST ORDERS -->

        <div class="row">

          <div class="col-md-12">

            <div class="box box-info customer_sec titlen_search ">

              <div class="box-header with-border">

                <div class="row">

                  <div class="col-sm-5 col-md-3">

                    <h3 class="uhead1">

                      To Do / Appointment List

                    </h3>

                  </div>

                  <div class="col-sm-7 col-md-8">

                    <!-- Nav tabs -->

                    <ul class="list-inline">

                      <li>
                        <a href="<?=site_url('fi_notes/view_todo')?>" class="btn btn-md btn-default btn-flat">List</a>
                      </li>

                      <li>
                        <a href="#" class="btn btn-md btn-info btn-flat">Info</a>
                      </li>

                      <li><a class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal-note"><i class="fa fa-pencil-square-o"></i> Note</a></li>

                      <a href="#" class="btn btn-md btn-info btn-flat pull-right">New Customer</a>

                    </ul>

                  </div>

                </div>

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="row space3">

                  <div class="col-md-4">

                    <div class="form-group">

                      <!-- <select class="form-control">

                        <option value="val">Martinez, Timothy - 35 Temple Place</option>

                      </select> -->

                    <select class="form-control fcap" id="cust_nm" onchange="loadcustlist()">
                      <option> </option>

                      <?php
                      $cus_id=$this->session->userdata('id');
                      foreach ($custs as $cust) {
                        if($cus_id==$cust['cus_id'])
                        {
                          $select="selected";

                        }else{
                           $select="";
                        }
                        ?>

                       <option <?=$select?> value="<?=$cust['cus_id'] ?>"><?=($cust['cus_lname'].", ".$cust['cus_fname']." - ". $cust['cus_company_name']." - ".$cust['cus_acc_no']); ?></option>

                      <?php } ?>
                    </select>

                    </div>

                  </div>

                  <div class="col-md-2">
                    <?php
                         $cus_id=$this->session->userdata('id');

                         $cntinfosql=$this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$cus_id."' AND default_contact=1 AND conatct_type!='Email'");
                         $cntinfosql_row=$cntinfosql->row();

                      ?>
                      <div class="form-group" id="contact_info">
                        <input class="form-control fcap contact_no" type="text" id="topphone" name="topphone" value="<?=$cntinfosql_row->contact_no?>">
                      </div>

                  </div>
                  <?php
                  $cntinfosql=$this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$cus_id."' AND default_contact=1 AND conatct_type!='Email'");
            		$cntinfosql_row=$cntinfosql->row();

            		$this->db->select('*');
            		$this->db->from('invoices_create');
            		$this->db->where('invoice_id', $_POST['invoiceid']);
            		$singleinvinfo = $this->db->get()->result_array()[0];

            		 $custregsqlq=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$_POST['custid']."'");
            		 $custregsqlrows=$custregsqlq->row();
                   ?>
                   <div class="col-md-2">

                          <div class="form-group" id="lastinvId">

                           <input class="form-control"  type="text" placeholder="433" value="<?=$custregsqlrows->cus_acc_no?>">

                           <!--  <input class="form-control"  type="text" placeholder="433" value="<?php //echo $singleinvinfo['invoice_id'] ?>"> -->

                          </div>

                        </div>

                        <div class="col-md-2">

                          <div class="form-group" id="lastinvduebal">

                            <input class="form-control"  type="text" placeholder="$16.33" value="$ <?=sprintf('%0.2f',$singleinvinfo['invoice_balance_due'])?>">

                          </div>

                        </div>

                  <!-- <div class="col-md-2">

                    <div class="form-group">

                      <input class="form-control" type="text" placeholder="1">

                    </div>

                  </div> -->

                </div>

              </div>

              <!-- /.box-body -->

            </div>

            <!-- /.box -->

          </div>

          <!-- Locations -->

          <div class="col-md-6">

            <div class="box box-default firstblock_bg ">

              <div class="box-body">
                  <form action="<?=site_url('fi_notes/addfinal_app_todo')?>" method="POST" id="cform">
                <div class="form-horizontal">

                  <div class="form-group nospacerow">

                    <div class="col-sm-6">

                            <select class="form-control cls_notes_type" name="appointment_type">
                                <option value="">Select</option>
                                <option <?php if ($appointment_data[0]['appointment_type']=="Appointment") {echo "selected";} ?> value="Appointment">Appointment</option>
                                <option <?php if ($appointment_data[0]['appointment_type']=="Todo") {echo "selected";} ?> value="Todo">Todo</option>
                            </select>

                        </div>

                    <div class="col-sm-6">

                            <select class="form-control" name="appointment_priority">

                            <option value="High Priority">High Priority</option>

                            <option value="Low Priority">Low Priority</option>

                          </select>

                        </div>

                  </div>
                  <?php
                  $appointmtnt_id=$this->session->userdata('appointment_id');
                   ?>

                  <div class="form-group nospacerow">

                    <div class="col-sm-10">

                      <select class="form-control" name="customer_id">
                        <?php
                        $admloguser=$this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC");

                        foreach ($admloguser->result() as $admloguser_dtls)
                        {
                         if($admloguser_dtls->cus_id==$appointment_data[0]['customer_assign_id'])
                         {
                           $selusr="selected";
                         }else{
                           $selusr="";
                         }
                         $cus_name=$admloguser_dtls->cus_lname.", ".$admloguser_dtls->cus_fname." - ". $admloguser_dtls->cus_company_name." - ".$admloguser_dtls->cus_acc_no;
                          ?>
                             <option <?=$selusr?> value="<?=$admloguser_dtls->cus_id?>"><?=$cus_name?></option>
                           <?php
                        }

                         ?>
                       

                      </select>

                    </div>

                    <div class="col-sm-2">

                      <a class="btn btn-xs btn-info btn-flat">GO TO</a>

                    </div>

                  </div>

                  <div class="form-group nospacerow">

                    <div class="col-sm-6">
                        <?php 
                            $todo_descp_list = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='24'")->result_array();
                            $appnt_descp_list = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='38'")->result_array();
                        ?>
                        
                        <input class="form-control descp" list="<?= $appointment_data[0]['appointment_type']; ?>" autocomplete="off"  type="text" placeholder="Description" name="appointmtnt_desc" value="<?=$appointment_data[0]['app_desc']  ?>">
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
                    </div>
                    
                    <input type="hidden" name="appointmtnt_id" id="appointmtnt_id" value="<?=$appointmtnt_id?>">

                    <div class="col-sm-6">

                      <!-- <select class="form-control" id="inputEmail3">

                        <option value="val">For User</option>

                        <option value="val">For User</option>

                        <option value="val">For User</option>

                      </select> -->
                      <input class="form-control" type="text" placeholder="For User" name="appointmtnt_user" value="<?=$appointment_data[0]['note_user']  ?>">

                    </div>

                  </div>

                  <!-- <div class="phone_wrapper">

                  <div class="form-group nospacerow">

                      <div class="col-sm-10">

                       

                      </div> 

                  </div>

                </div> -->

                  <div class="form-group nospacerow">

                    <div class="col-sm-2">
                      <input class="form-control" type="text" placeholder="Phone"  name="appointmtnt_phone" value="<?=$cntinfosql_row->contact_no ?>">
                    </div>

                    <div class="col-sm-2">

                      <input type="date" name="appointmtnt_datetime" id="note_datetime" value="<?=$appointment_data[0]['note_datetime']  ?>" class="form-control updwn invdudate_d"> 
                    </div>

                    <div class="col-md-2">

                      <input type="time" class="form-control timepicker" value="<?=$appointment_data[0]['note_time']  ?>" name="appointmtnt_time" placeholder="Start Time">
 
                    </div>

                    <div class="col-md-2">
                      <input type="date" name="appointmtnt_date_enter" id="note_dateenter" value="<?=$appointment_data[0]['note_date']  ?>" class="form-control updwn invdudate1">
                    </div>

                    <div class="col-md-4">
                     <input type="text" name="user_name" value="<?=$appointment_data[0]['note_user']  ?>" class="form-control" id="inputPassword3" placeholder="Entered By">
                    </div>


                  </div>

               



                <div class="graybox">

                  <p>
                    <br><hr>
                    <strong>Reminder Options</strong> </p>

                  <!-- <form class="form-horizontal"> -->

                    <div class="form-group nospacerow">

                      <div class="col-md-2">

                        <div class="input-group date">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                          </div>

                        <input type="date" name="appointmtnt_remider_date" name="note_reminderdate" id="note_reminderdate" value="<?=$appointment_data[0]['note_datetime']  ?>" class="form-control updwn invdudate">

                        </div>

                        <!-- /.input group -->

                      </div>

                      <div class="col-sm-2">

                        <div class="input-group">

                            <input type="time" id="appointmtnt_remider_time" name="appointmtnt_remider_time" class="form-control timepicker" value="<?=$appointment_data[0]['note_time']  ?>" placeholder="Start Time">

                          <div class="input-group-addon">

                            <i class="fa fa-clock-o"></i>

                          </div>

                        </div>

                      </div>


                      <div class="col-sm-3">

                        <div class="checkbox">

                          <label> <input type="checkbox" id="isRemind"> appointment email reminder </label>

                        </div>

                      </div>

                      <div class="col-sm-3">

                        <div class="form-group nospacerow">

                        <input type="email" name="" class="form-control" placeholder="Enter email" id="textRemind" disabled="">

                      </div>

                      </div>

                      <div class="col-sm-2">

                        <button type="button" id="reminderid" onclick="myFunction()" class="btn btn-xs btn-default" >Sent Reminder</button>

                      </div>



                    </div>

                    <div class="form-group nospacerow">

                      

                    </div>

                </div>

                  <div class="form-group nospacerow">

                    <div class="col-sm-6">

                      <select class="form-control" id="inputEmail3">

                        <option value="val">Report</option>

                        <option value="val">Report</option>

                        <option value="val">Report</option>

                      </select>

                    </div>

                    <div class="col-sm-6">

                      <div class="checkbox">

                        <label>
                          <?php
                          if ($appointment_data[0]['iteam_check']==1) { ?>
                            <input type="checkbox" name="appointmtnt_check" value="1" checked> Completed Task
                          <?php }else { ?>
                              <input type="checkbox" name="appointmtnt_check" value="0"> Completed Task
                         <?php  }
                           ?>


                        </label>

                      </div>

                    </div>

                  </div>

                  <div class="form-group nospacerow">

                    <div class="col-sm-12 text-center">

                      <button class="btn btn-lg btn-info btn-flat">Save</button>

                      <button class="btn btn-lg btn-default btn-flat">Cancel</button>

                    </div>



                    <!-- <div class="col-sm-offset-2 col-sm-10">

                      <button type="submit" class="btn btn-sm btn-default">ADD NEW</button>

                      <button type="submit" class="btn btn-sm btn-default">DELETE</button>

                      <button type="submit" class="btn btn-sm btn-default">UPDATE</button>

                    </div> -->

                  </div>

                </div>
              </form>
              </div>

              <!-- /.box-body -->

            </div>

            <!-- /.box -->

          </div>

          <!-- /.col -->

          <div class="col-md-6">

                <div class="box box-default firstblock_bg  collapsed-box">

                  <div class="box-header with-border">

                    <p class="uhead2">contact info</p>



                    <div class="box-tools pull-right">

                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>

                      </button>

                    </div>

                    <!-- /.box-tools -->

                  </div>

                  <!-- /.box-header -->

                  <div class="box-body">

                    <div class="form-horizontal">

                      <div class="cnt_clone">

                        <div class="form-group">

                        <div class="col-sm-3">

                          <select name="name" class="form-control fcap valid">

                            <option value="Home">Home</option>

                            <option value="Office">Office</option>

                            <option value="Mobile">Mobile</option>

                            <option value="Summer">Summer</option>

                            <option value="Fax">Fax</option>


                          </select>

                        </div>

                        <div class="col-sm-3">

                          <input class="form-control fcap" id="contact_no" name="cus_contact_no[]" type="text" placeholder="Contact details" maxlength="14">

                        </div>

                        <div class="col-sm-3">

                          <input type="text" class="form-control fcap" name="cus_note[]" placeholder="Note">

                        </div>

                        <div class="col-sm-3">

                          <label class="switch">

                            <input type="checkbox" name="radio_click[]">
                            <span class="slider round"></span>
                          </label>

                          <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                          </div>
                        </div>


                      </div>

                    </div>

                  </div>

                  <!-- /.box-body -->

                </div>

                <!-- /.box -->

          </div>

      </section>

      <!-- /.content -->

      </div>

      <!-- /.content-wrapper -->

      <!-- Main Footer -->





    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->

      <script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->

 <script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- bootstrap datepicker -->

 <script src="<?php echo base_url('assets/');?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- bootstrap time picker -->

    <script src="<?php echo base_url('assets/');?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <!-- AdminLTE App -->

    <!--<script src="<?php //echo base_url('assets/');?>dist/js/adminlte.min.js"></script>-->

    <!-- Page script -->

     <script type="text/javascript">

    $(".cnt_clone_add").on('click', function() {

    var $tr    = $(this).closest('.cnt_clone');

    var $clone = $tr.clone();

    $clone.find(':text').val('');
    $clone.find(':radio').prop( "checked", false );

    $clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()

    $clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');

    $tr.after($clone);

});





$(document).on('click', '.cnt_clone_remove', function(){

     // Your Code

    var $tr    = $(this).closest('.cnt_clone');

    var $clone = $tr.remove();

});
  </script>
  
    <script>
        $("body").on("change", ".cls_notes_type", function(event){
            var ntype =  $(".cls_notes_type").val();
            if(ntype=="Appointment")
            {
                $(".descp").attr("list", "Appointment");
            }
            else if(ntype=="Todo")
            {
                $(".descp").attr("list", "Todo");
            }
            else
            {
                $(".descp").attr("list", "");
            }
        });
    </script>



    <script type="text/javascript">

      $(document).ready(function(){

      //Date picker

      $('.datepicker1').datepicker({

      autoclose: true

      })



      //Timepicker

      $('.timepicker').timepicker({

      showInputs: false

      })



      $('#isRemind').change(function(){

      $("#textRemind").prop("disabled", !$(this).is(':checked'));

      });



      //add phone

    var maxFieldPhone = 3; //Input fields increment limitation

    var addPhone = $('.add_phone'); //Add button selector

    var phoneWrapper = $('.phone_wrapper'); //Input field wrapper

    var phoneHTML = '<div class="form-group"> <div class="col-sm-10"> <input class="form-control" type="text" placeholder="Phone"  name="field_phone[]"> </div> <div class="col-md-2"><button class="btn btn-xs btn-danger btn-flat remove_phone"><i class="fa fa-minus"></i></button></div> </div>'; //New input field html

    var xPhone = 1; //Initial field counter is 1



    //Once add button is clicked

    $(addPhone).click(function(){

        //Check maximum number of input fields

        if(xPhone < maxFieldPhone){

            xPhone++; //Increment field counter

            $(phoneWrapper).append(phoneHTML); //Add field html

          }

        });



    //Once remove button is clicked

    $(phoneWrapper).on('click', '.remove_phone', function(e){

      e.preventDefault();

        $(this).parent().parent('div').remove(); //Remove field html

        xPhone--; //Decrement field counter

      });



      });

    </script>
    <script>
    $(document).ready(function(){
    $("body").on("keydown", ".invdudate_d", function(event){

       var key = event.keyCode;
       // alert("key--"+key);

       if(key=="107" || key=="187")
          {
            //alert("date+");
              var dtpls;
              if($("#note_datetime").val()=="")
              {
                dtpls= new Date();
              }else{
                dtpls= new Date($("#note_datetime").val());
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
             var today = yyyy + '-' + mm + '-' +  dd;
             $("#note_datetime").val(today);
             event.preventDefault();

          }else if(key=="109" || key=="189"){
            //alert("date-");
              var dtmns;
              if($("#note_datetime").val()=="")
              {
                dtmns= new Date();
              }else{
                dtmns= new Date($("#note_datetime").val());
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
             var today = yyyy + '-' + mm + '-' +  dd;
             $("#note_datetime").val(today);
             event.preventDefault();

          }else if(key=="68")
           {
             //alert("date D");
               today = '<?php echo date("Y-m-d"); ?>';
               $("#note_datetime").val(today);
               event.preventDefault();
           }
    });
    });
    </script>
    <script>
    $(document).ready(function(){
    $("body").on("keydown", ".invdudate1", function(event){

       var key = event.keyCode;
       // alert("key--"+key);

       if(key=="107" || key=="187")
          {
            //alert("date+");
              var dtpls;
              if($("#note_dateenter").val()=="")
              {
                dtpls= new Date();
              }else{
                dtpls= new Date($("#note_dateenter").val());
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
             var today = yyyy + '-' + mm + '-' +  dd;
             $("#note_dateenter").val(today);
             event.preventDefault();

          }else if(key=="109" || key=="189"){
            //alert("date-");
              var dtmns;
              if($("#note_dateenter").val()=="")
              {
                dtmns= new Date();
              }else{
                dtmns= new Date($("#note_dateenter").val());
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
             var today = yyyy + '-' + mm + '-' +  dd;
             $("#note_dateenter").val(today);
             event.preventDefault();

          }else if(key=="68")
           {
             //alert("date D");
               today = '<?php echo date("Y-m-d"); ?>';
               $("#note_dateenter").val(today);
               event.preventDefault();
           }
    });
    });
    </script>
    <script>
    $(document).ready(function(){
    $("body").on("keydown", ".invdudate", function(event){

       var key = event.keyCode;
       // alert("key--"+key);

       if(key=="107" || key=="187")
          {
            //alert("date+");
              var dtpls;
              if($("#note_reminderdate").val()=="")
              {
                dtpls= new Date();
              }else{
                dtpls= new Date($("#note_reminderdate").val());
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
             var today = yyyy + '-' + mm + '-' +  dd;
             $("#note_reminderdate").val(today);
             event.preventDefault();

          }else if(key=="109" || key=="189"){
            //alert("date-");
              var dtmns;
              if($("#note_reminderdate").val()=="")
              {
                dtmns= new Date();
              }else{
                dtmns= new Date($("#note_reminderdate").val());
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
             var today = yyyy + '-' + mm + '-' +  dd;
             $("#note_reminderdate").val(today);
             event.preventDefault();

          }else if(key=="68")
           {
             //alert("date D");
               today = '<?php echo date("Y-m-d"); ?>';
               $("#note_reminderdate").val(today);
               event.preventDefault();
           }
    });
    });
    </script>

    <!--  Remider -->
    <script type="text/javascript">
    $(document).ready(function(){
    $("#reminderid").on("click", "#reminderid", function(){
      alert("hiii");
      var appointmtnt_id= document.getElementById('appointmtnt_id').value;
      alert("Reminderid--"+appointmtnt_id+);
    });
  });
    // function reminder_details(reminderid)
    //   {
    //       alert("Reminderid--"+reminderid+);
                // event.preventDefault();



                //alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

              //   if(fieldnm=='app_desc')
              //   {
                         //  $.ajax({
                         //  type: 'POST',
                         //  url: '<?//=site_url('fi_home/updateappointment')?>',
                         //  data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
                         //  dataType: 'text',
                         //  beforeSend: function() {
                         //      // setting a timeout
                         //      $('.fadeMe').show();
                         //
                         //
                         //  },
                         //  success: function(data) {
                         //     // alert(data);
                         //      if(data=="success")
                         //      {
                         //          $('.fadeMe').hide();
                         //
                         //          //fngetinvoicedetails(invoiceid);
                         //          $('.fadeMe').hide();
                         //            // window.location.href='<?=site_url('fi_notes/c_notes')?>';
                         //
                         //
                         //      }else if(data=="error"){
                         //
                         //          $('.fadeMe').hide();
                         //          //alert("Something went wrong..!");
                         //      }
                         //
                         //
                         //
                         //  },
                         //  error: function(xhr) { // if error occured
                         //    // $('.fadeMe').hide();
                         //  },
                         //  complete: function() {
                         //   // $('.fadeMe').hide();
                         //
                         //
                         //  }
                         //
                         // });


      // }
    </script>
    <script>
function myFunction() {
  // alert("hi");
  var reminder_id = $('#appointmtnt_id').val();
  var reminder_date = $('#note_reminderdate').val();
  var reminder_time = $('#appointmtnt_remider_time').val();
  // alert(cust_id);

    // alert("reminder_id--"+reminder_id+" date--"+reminder_date+" time--"+reminder_time);
  // document.getElementById("demo").innerHTML = "Hello World";

   $.ajax({
   type: 'POST',
   url: '<?=site_url('fi_home/add_reminder')?>',
   data: {reminderid:reminder_id,reminder_date:reminder_date,reminder_time:reminder_time},
   dataType: 'text',
   beforeSend: function() {
       // setting a timeout
       // alert("send");
       $('.fadeMe').show();


   },
   success: function(data) {
      // alert(data);
       if(data=="success")
       {
           $('.fadeMe').hide();
           alert("Reminder Set");
           //fngetinvoicedetails(invoiceid);
          // $('.fadeMe').hide();
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
}
</script>

  <!-- </body>

</html> -->
