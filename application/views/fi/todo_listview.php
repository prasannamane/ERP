<!DOCTYPE html>
<html>
    <head> 
        
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
        
       
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
        <style type="text/css">
        .btn.btn-flat {
              border-radius: 4px;
          }
        
          .dt1, .dt2{ max-width: 100%; text-align: center; }
        
        </style>

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Event Management </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Tasks</a></li>
                    <li class="active">To Do List</li>
                </ol>
            </section>
            
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info titlen_search task_sec">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-sm-5 col-md-4">
                                        <h3 class="uhead1">To Do / Appointment List</h3>
                                    </div>

                                    <div class="col-sm-7 col-md-8">
                                        <ul class="list-inline">
                                            <li><a href="<?=site_url('fi_notes/view_todo')?>" class="btn btn-md btn-default btn-flat">List</a></li>
                                            <li><a href="<?=site_url('fi_home/to_do_list')?>" class="btn btn-md btn-info btn-flat">Info</a></li>
                                            <li><a class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal-note"><i class="fa fa-pencil-square-o"></i> Note</a></li>
                                            <!-- <a href="#" class="btn btn-md btn-info btn-flat pull-right">New Customer</a> -->
                                        </ul>
                                    </div>

                                 </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-default firstblock_bg">

                            <div class="box-header with-border mb5">
                                <p class="uhead2">To Do / Appointment List</p>
                                <div class="box-tools pull-right"> 
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                                </div>
                            </div>

                            <div class="box-body">
                                 <div class="table-responsive">
                                    <table class="table table-hover no-margin fixed_table mw1500">
                                        <thead>
                                            <tr>
                                                <th class="w50">Number</th>
                                                <th class="w120">Type</th>
                                                <th class="w120">Priority</th>
                                                <th class="w270">Customer Name</th>
                                                <th class="">Description</th>
                                                <th class="w90">User</th>
                                                <th class="w100">Phone</th>
                                                <th class="w90">Date</th>
                                                <th class="w70">Time</th>
                                                <th class="w90">Date Entered</th>
                                                <th class="w90">Updated by</th>
                                                <th class="w120">Remider Date/Time</th>
                                                <th class="w60">Check</th>
                                                <th class="w110">Operation</th>
                                            </tr>
                                        </thead>
                                        
                                        <?php 
                                        $i=1;
                                        
                                        $todo_descp_list = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='24'")->result_array();
                                        $appnt_descp_list = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='38'")->result_array();
                                        
                                        // Fetch all users from table
                                        $admloguser = $this->db->query("SELECT * FROM register_customer")->result_array();
                                       
                                        
                                        foreach ($todo_data as $todo_data)
                                        {
                                            $chktskstatusclr=$this->db->query("SELECT * FROM adm_todo_status WHERE name='".$todo_data['appointment_type']."'");
                                            $chktskstatusclrrow=$chktskstatusclr->row();
                                            $assigntskcolor=$chktskstatusclrrow->color;
                                        
                                            ?>
                                            <tbody id="dispinvnotes">
                                                
                                                <tr style="background-color: <?=$assigntskcolor?>" class="tr_clone">
                                        
                                                    <td><?=$i++; ?></td>
                                                    <td>
                                                        <select class="form-control cls_notes_type" name="appointment_type" onchange="update_field('customer_appointment','appointment_type',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                            <option value="" <?php echo ($todo_data['appointment_type']=="") ? "selected" : ""; ?> ></option>
                                                            <option value="Appointment" <?php echo ($todo_data['appointment_type']=="Appointment") ? "selected" : ""; ?> >Appointment</option>
                                                            <option value="Todo" <?php echo ($todo_data['appointment_type']=="Todo") ? "selected" : ""; ?> >Todo</option>
                                                        </select>
                                                       
                                                    </td>
                                        
                                                    <td>
                                                        <select class="form-control" name="appointment_priority" onchange="update_field('customer_appointment','appointment_priority',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                            <option value="" <?php echo ($todo_data['appointment_priority']=="") ? "selected" : ""; ?> ></option>
                                                            <option value="High Priority" <?php echo ($todo_data['appointment_priority']=="High Priority") ? "selected" : ""; ?>>High Priority</option>
                                                            <option value="Low Priority" <?php echo ($todo_data['appointment_priority']=="Low Priority") ? "selected" : ""; ?>>Low Priority</option>
                                                        </select>
                                                    </td>
                                                    
                                                    <td>
                                                        <select class="form-control" name="cust" onchange="update_field('customer_appointment','customer_assign_id',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                            <option value="" <?php echo ($todo_data['customer_assign_id']=="") ? "selected" : ""; ?> ></option>
                                                            <?php //." - ".$user['cus_acc_no']
                                                            foreach($admloguser as $user)
                                                            {
                                                                if ($user['cus_lname'] !="" || $user['cus_fname'] !="" || $user['cus_company_name'] !="") {
                                                                    $cus_name = $user['cus_lname'].", ".$user['cus_fname']." - ". $user['cus_company_name'];
                                                                }
                                                                else {
                                                                    $cus_name = "";
                                                                }
                                                                
                                                                ?>
                                                                <option value="<?php echo $user['cus_id']; ?>" <?php echo ($todo_data['customer_assign_id']==$user['cus_id']) ? "selected" : ""; ?>><?php echo $cus_name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select>
                                                    </td>
                                                    
                                                    <td>
                                                        <!--<input type="text" style="background-color: <?=$assigntskcolor?>"  value="<?php echo $todo_data['app_desc'];?>" onblur="update_field('customer_appointment','app_desc',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >-->
                                                        
                                                        <input type="text" list="<?= $todo_data['appointment_type']?>" class="descp form-control" autocomplete="off"  style="background-color: <?=$assigntskcolor?>"  value="<?php echo $todo_data['app_desc'];?>" onblur="update_field('customer_appointment','app_desc',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
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
                                                        <input type="text" class="form-control" style="background-color: <?=$assigntskcolor?>" value="<?php echo $todo_data['notestype_user'];?>" onblur="update_field('customer_appointment','notestype_user',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="phone form-control" style="background-color: <?=$assigntskcolor?>" value="<?php echo $todo_data['appointmtnt_phone'];?>" onblur="update_field('customer_appointment','appointmtnt_phone',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                    </td>
                                                    
                                                    <td><?php
                                                        $dt = date("m/d/Y", strtotime($todo_data['note_datetime']));
                                                        ?>
                                                        <input type="text" style="background-color: <?=$assigntskcolor?>" value="<?php echo ($dt=="01/01/1970")? "" : $dt;?>" class="dt1"  placeholder="mm/dd/yyyy" onblur="update_field('customer_appointment','note_datetime',this.value,'id',<?php echo $todo_data['id']; ?>,'date') " >
                                                    </td>
                                        
                                                    <td>
                                                        <input type="time" style="background-color: <?=$assigntskcolor?>" value="<?php echo $todo_data['note_time'];?>" onblur="update_field('customer_appointment','note_time',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                    </td>
                                        
                                                    <td><?php
                                                        $dt = date("m/d/Y", strtotime($todo_data['note_date']));
                                                        ?>
                                                        <input type="text" style="background-color: <?=$assigntskcolor?>" value="<?php echo ($dt=="01/01/1970")? "" : $dt;?>" class="dt2" placeholder="mm/dd/yyyy" onblur="update_field('customer_appointment','note_date',this.value,'id',<?php echo $todo_data['id']; ?>,'date') "  >
                                                    </td>
                                        
                                                    <td><?=$todo_data['note_user']; ?></td>
                                        
                                                    <td>
                                                        <?php
                                                        $dt = date("m/d/Y", strtotime($todo_data['note_datetime']));
                                                        echo  ($dt=="01/01/1970")? "" : $dt." ".$todo_data['note_time'];
                                                        ?>
                                                    </td>
                                        
                                                    <td>
                                                         <select class="form-control" name="iteam_check" onchange="update_field('customer_appointment','iteam_check',this.value,'id',<?php echo $todo_data['id']; ?>,'') " >
                                                            <option value="" <?php echo ($todo_data['iteam_check']=="") ? "selected" : ""; ?> ></option>
                                                            <option value="1" <?php echo ($todo_data['iteam_check']==1) ? "selected" : ""; ?> >Yes</option>
                                                            <option value="0" <?php echo ($todo_data['iteam_check']==0) ? "selected" : ""; ?> >No</option>
                                                        </select>
                                                        
                                                       
                                                    </td>
                                                           
                                                    <td>
                                                        <a href="<?=site_url('fi_home/get_apppintment_id/'.$todo_data['id'])?>" class ="btn btn btn-warning btn-xs"><i class="fa fa-eye"></i> Edit</a>
                                         	            <a href="<?=site_url('fi_home/delete_appointment/'.$todo_data['id'])?>" onclick="return confirm('Are you sure want to Delete Driver..??')" class ="btn btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                                        
                                                    </td>
                                        
                                                </tr>
                                            </tbody>
                                            <?php 
                                        }
                                        ?>
                                    </table>
                                </div>

                                <div class="clearfix"></div>

                                <div class="mybtn mt15">
                                  <a href="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

         
            </section>
        </div>

        


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script type="text/javascript">
             $(document).ready(function($){
                 
                  //$('.phone').mask('(000) 000-0000');
                 $('body').on("keypress", ".phone", function(){ $(this).mask('(000) 000-0000'); } );
             });
        </script>
        <!--<script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
        <!--<script src="<?php echo base_url('assets/');?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>-->
        <!--<script src="<?php echo base_url('assets/');?>plugins/timepicker/bootstrap-timepicker.min.js"></script>-->
        
        

    <!-- AdminLTE App -->

    <!--<script src="<?php //echo base_url('assets/');?>dist/js/adminlte.min.js"></script>-->

    <!-- Page script -->

    <script>
    $(document).ready(function(){
        
        
        
        $("body").on("keydown", ".dt1, .dt2", function(event)
        {
            var cls = $(this).attr("class");
            var key = event.keyCode;
            var temp_edate =  $(this).parents(".tr_clone").find("."+cls);

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


    function update_field(tbl_nm,set_col_nm,set_col_val,whr_col_nm,whr_col_val,field_type) //  for date field_type="date"
    {
        //alert(tbl_nm+":"+set_col_nm+":"+set_col_val+":"+whr_col_nm+":"+whr_col_val+":"+field_type);
        
        
        
        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/update_field')?>',
            data: {tbl_nm:tbl_nm,set_col_nm:set_col_nm,set_col_val:set_col_val,whr_col_nm:whr_col_nm,whr_col_val:whr_col_val,field_type:field_type},
            dataType: 'text',
            //async: false,
            beforeSend: function() {
                // setting a timeout
                //$('.fadeMe').show();
                //alert("before event_id--"+event_id+" event_date--"+event_date);
            },
            success: function(data) {
                //alert("data--"+data);

                if(data=="success")
                {
                  window.location.href="<?=base_url('fi_notes/view_todo')?>";
                    //$('.fadeMe').hide();
                }else{
                    //$('.fadeMe').hide();
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



    <script type="text/javascript">

      $(document).ready(function(){

      //Date picker

    //   $('.datepicker1').datepicker({

    //   autoclose: true

    //   })



      //Timepicker

    //   $('.timepicker').timepicker({

    //   showInputs: false

    //   })



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
<script src="<?php echo base_url('assets/');?>js/prasanna.js"></script>