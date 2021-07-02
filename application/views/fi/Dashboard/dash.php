<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
    </head>
  
    <style>
        input[type="checkbox"][readonly] { pointer-events: none;}
        #myevents th:nth-last-child(2) 
        {
            width: inherit;
        }

        .closebtn, .snoozbtn, .snoozbtn:active{ display: inline-block; margin: 0 3px; font-size: 18px; color: #716f6f;  }
        .snoozactive 
        {
            color: #e67a2e !important;
        }
    </style>
  
    <div class="content-wrapper">
        <section class="content">
        
        <?php if(isset($success)){?>
        <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong></strong> <?=$success?>
        </div>
        <?php } ?>

        <?php if(isset($error)){?>
        <div class="alert alert-danger alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> <?=$error?>
        </div>
        <?php }?>
      
        <div class="row">
            <div class=" col-sm-12">
                <div class="box box-info firstblock_bg ">
                    <div class="box-header with-border mb5">
                            <p class="uhead2">Upcoming Events</p>

                            <div class="box-tools pull-right">
                                <a href="<?=site_url('fi_home/all_upcoming_event/0')?>" class ="btn btn-xs pull-right"><i class="fa fa-eye"></i> View All</a>
                            </div>
                        </div>


                        <div class="table-responsive" id="myevents">

                            <table class="table table-hover no-margins fixed_table">
                                <thead>
                                    <tr>
                                        
                                        <th class="w70"><span class="inblock w70">Date</span></th>
                                        <th class="w340">Name</th>
                                        <th class="w260">Event Type</th>
                                        <th><span class="inblock w130">Note</span></th>
                                        <th  class="w100">Missing Details</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(count($event) > 0) {

                                        foreach ($event as $event) {

                                          $evntdata=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$event['cus_id']."'");
                                          $evntdatarow=$evntdata->row();

                                          $seteventname="";
                                          $chkisjobs=$this->db->query("SELECT * FROM event_jobs WHERE event_id='".$event['event_id']."' ORDER BY event_id ASC  LIMIT 2");
                                          $chknjobsrows=$chkisjobs->num_rows();
 
                                            if($chknjobsrows > 1) {
                                              
                                              foreach ($chkisjobs->result() as $chkisjobs_dtls ) {

                                                $seteventname.= $chkisjobs_dtls->jb_name."-";
                                               
                                                }
                                              }
                                              else {
                                            
                                                $seteventname = $evntdatarow->cus_lname."-".$evntdatarow->cus_company_name;
                                              }

                                            $newDate = date("m/d/Y", strtotime($event['event_date']));
                                            ?>
                                            <!-- <tr class="tr_clone clickable-row" data-href="<?=site_url('fi_home/all_upcoming_event/'.$event['cus_id'])?>" > -->
                                              <tr class="tr_clone clickable-row" data-href="<?=site_url('fi_home/search_new_cus/'.$event['cus_id'])?>" >
                                              <td><?=$newDate?></td>
                                              <td><?=rtrim($seteventname,"-")?></td>
                                              <td><?=$event['event_type']?></td>
                                              <td><?=$event['event_note']?></td>
                                              <td><?php if($event['e_event_id'] == ''){ ?><input type="checkbox" name="" checked="" readonly=""><?php

                                              }else{ ?><input type="checkbox" name="" readonly=""><?php

                                              } ?></td>
                                              


                                              
                                              
                                            </tr>
                                            <?php 

                                        }

                                    }
                                    else
                                    {
                                        
                                        echo"<tr><td colspan='5'>No Events Found..!</td></tr>";
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class=" col-sm-12">

                    <div class="box box-info secondblock_bg ">

                        <div class="box-header with-border mb5">
                            <p class="uhead2">Tasks</p>

                            <div class="box-tools pull-right dflex">
                                 <div class="snooze_btns ">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Snooze All</a>
                                    <a href="<?=site_url('fi_home/dismissall_dash/')?>" class="btn btn-sm btn-info btn-flat pull-right">Dismiss All</a>
                                  </div>  
                                <a href="<?=site_url('fi_home/all_upcoming_task/0')?>" class ="btn btn-xs pull-right"><i class="fa fa-eye"></i> View All</a>
                            </div>
                         </div>


                        <div class="table-responsive">
                            <table class="table table-hover no-margins fixed_table">
                                <thead>
                                    <tr>
                                      
                                        <th class="w70"><span class="inblock w70">Date</span></th>
                                        <th class="w340">Event Name</th>
                                        <th class="w260">Task</th>
                                        <th class="w160">Subtask</th>
                                        <th><span class="inblock w180">Note</span></th>
                                        
                                      

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($task)>0) {

                                      foreach ($task as $task) {
                                        $newtaskDate = date("m/d/Y", strtotime($task['task_date_started']));
                                         $evntypsql = $this->db
                                         ->query("SELECT * FROM events_register WHERE inv_id='".$task['invoice_id']."' ORDER BY event_id ASC ")
                                         ->row_array();
                                       //  print_r($this->db->last_query());    
                                         
                                            if ($evntypsql['event_date'] !="") {
                                              $con_date=date("m/d/Y",strtotime($evntypsql['event_date']));
                                            }
                                            else {
                                              $con_date="";
                                            }
                                            $eventname=$evntypsql['event_name'];
                                            $eventname=str_replace('-',' - ',$eventname);
                                            $str="";
                                            if ($eventname !="") {
                                              $str.=$eventname." - ";
                                            }
                                            if ($con_date !="") {
                                              $str.=$con_date." - ";
                                            }
                                            if ($evntypsql['event_type'] !="") {
                                              $str.=$evntypsql['event_type'];
                                            }


                                        ?>
                                         <tr class="tr_clone clickable-row" data-href="<?=site_url('fi_home/all_upcoming_task/'.$task['invoice_id'])?>" >
                                          <td><?=$newtaskDate?></td>
                                          <td><?=$str?></td>
                                          <td><?=$task['type_name']?></td>
                                          <td><?=$task['sub_name']?></td>
                                          <td><?=$task['task_note']?></td>

                                        </tr>
                                            <?php
                                        }

                                    }
                                    else
                                    {

                                               echo"<tr><td colspan='5'>No Tasks Found..!</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>


            <div class="clearfix"></div>


            <div class="row">
                <div class=" col-sm-12">

                    <div class="box box-info thirdblock_bg ">

                        <div class="box-header with-border mb5">
                            <p class="uhead2">TO DO / APPOINTMENT Reminder</p>
                            <div class="box-tools pull-right dflex">
                                <div class="snooze_btns ">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Snooze All</a>
                                    <a href="<?=site_url('fi_home/dismissall_dash/')?>" class="btn btn-sm btn-info btn-flat pull-right">Dismiss All</a>
                                  </div> 
                                  
                                <a href="http://tech599.com/tech599.com/johnsum/erp_new/fi_notes/view_todo/0" class="btn btn-xs pull-right"><i class="fa fa-eye"></i> View All</a>
                            </div>
                        </div>


                        <div class="table-responsive" id="myevents">
                            <table class="table table-hover no-margins fixed_table">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th class="w70"><span class="inblock w70">Date</span> </th>
                                        <th class="w340">Event Name</th>
                                        <th class="w260">Type</th>
                                        <th class="w160">Priority</th>

                                        <th><span class="inblock w180">Note</span></th>
                                        <!-- <th class="w40">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                        if(count($rem) > 0)
                                        {


                                            foreach($rem as $rem)
                                            {
                                              // echo "<pre>";print_r($rem);
                                                ?>
                                                <tr class="tr_clone clickable-row" data-href="<?=site_url('fi_notes/view_todo/'.$rem['cus_id'])?>" >
                                                    <!-- <td>1</td> -->
                                                     <td>
                                                        <?php
                                                        if($rem['note_datetime'] != '0000-00-00 00:00:00'){
                                                          $dt = date("m/d/Y", strtotime($rem['note_datetime']));

                                                        }else{
                                                          $dt = "";
                                                        }
                                                            
                                                        ?>
                                                        <input type="text" 
                                                        placeholder="mm/dd/yyyy" 
                                                        class="form-control event_date " 
                                                        value="<?=$dt?>"  
                                                        style="display: inline-block; " 
                                                        onblur="update_field('customer_appointment', 'note_datetime', this.value, 'id', <?= $rem['id']; ?>, 'date')"  ></td>
                                                      
                                                      <td>
                                                      <?php
                                                      $custregsql=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$rem['cus_id']."'");
                                                     $custregsqlrow=$custregsql->row();
                                                     echo $custregsqlrow->cus_lname." - ".$custregsqlrow->cus_company_name;
                                                       ?>
                                                    </td>

                                                    <td><?php echo $rem['appointment_type']; ?></td>
                                                    
                                                    <td>
                                                        <?php echo $rem['appointment_priority']; ?></td>
                                                   

                                                    <td><input type="text" class="tsk_note form-control text-center" onblur="update_field('customer_appointment', 'note_remider', this.value, 'id', <?= $rem['id']; ?>, '')" value="<?=$rem['note_remider']; ?>"></td>
                                                    <!-- <td>
                                                        <a href="<?php //echo base_url("fi_home/get_apppintment_id/").$rem['id']; ?>"><i class="fa fa-eye"></i></a>
                                                        
                                                    </td> -->

                                                </tr>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr><td colspan="5">No upcoming TO DO/Appointments.</td></tr>
                                            <?php
                                        }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

                <div class="clearfix"></div>

<!--                 <div class=" col-sm-12">

    <div class="box box-info fourthblock_bg ">

        <div class="box-header with-border mb5">
            <p class="uhead2">Event-Missing Details</p>
            <div class="box-tools pull-right">
                <a href="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/all_upcoming_event/0" class="btn btn-xs pull-right"><i class="fa fa-eye"></i> View All</a>
            </div>
        </div>


        <div class="table-responsive" id="myevents">
            <table class="table table-hover no-margins fixed_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w70"><span class="inblock w70">Date</span></th>
                        <th class="w340">Name</th>
                        <th class="w260">Event Type</th>
                        <th><span class="inblock w180">Note</span></th>
                        <th class="w40"><span class="inblock">Action</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;
                    if(count($missing)>0)
                    {
                        //print_r($missing);

                        foreach ($missing as $missing)
                        {

                            $evntdata1=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$missing['cus_id']."'");
                            $evntdatarow1=$evntdata1->row();

                            $seteventname1="";
                            $chkisjobs1=$this->db->query("SELECT * FROM event_jobs WHERE event_id='".$missing['event_id']."' ORDER BY event_id ASC  LIMIT 2");
                            $chknjobsrows=$chkisjobs1->num_rows();
                            //echo "chknjobsrows--".$chknjobsrows;
                            if($chknjobsrows>1)
                            {
                                //echo "if";

                                foreach ($chkisjobs1->result() as $chkisjobs1_dtls )
                                {
                                    $seteventname1.= $chkisjobs1_dtls->jb_name."-";
                                }

                            }
                            else
                            {
                                //echo "else";
                                $seteventname1= $evntdatarow1->cus_lname."-".$evntdatarow1->cus_company_name;
                            }


                            ?>
                            <tr class="tr_clone clickable-row" data-href="<?=site_url('fi_home/all_upcoming_event/'.$missing['cus_id'])?>" >
                                <?php
                                    $eventmissingDate = date("m/d/Y", strtotime($missing['event_date'])); ?>

                                     <td><input type="text" placeholder="From Date" class="form-control event_date " value="<?=$eventmissingDate; ?>" onblur="update_field('events_register', 'event_date', this.value, 'event_id', <?= $missing['event_id']; ?>, 'date')"   style="display: inline-block; width: 85px;"  >
                                </td>
                                <td><?=rtrim($seteventname1,"-")?></td>
                                <td><?=$missing['event_type']; ?></td>
                               
                                <td> <input type="text" id="up_event_note" class="up_event_note form-control text-center" name="up_event_note" onblur="update_field('events_register', 'event_note', this.value, 'event_id', <?= $missing['event_id']; ?>, '')" value="<?= $missing['event_note']; ?>"> </td>
                                <td>
                                  <a href="#"><i class="fa fa-eye"></i></a> 
                                </td>
                            </tr>
                          <?php } }else{
                            echo"<tr><td colspan='5'>No Missing Events Found..!</td></tr>";
                          }?>
                            </tbody>
                        </table>

    </div>
    </div>
</div> -->



            </div>







        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Main Footer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url('assets/');?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">

  $(document).ready(function(){
      $(".collapse-link").click(function(){
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


<script>
$(document).ready(function(){
    $("body").on("keydown", ".event_date", function(event)
    {

        var key = event.keyCode;
        var temp_edate =  $(this).parents(".tr_clone").find(".event_date");

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
function update_event_date(event_id,event_date) {
  //alert(event_id+"--"+event_date);
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

function update_field(tbl_nm,set_col_nm,set_col_val,whr_col_nm,whr_col_val,field_type) //  for date field_type="date"
{
    // alert(tbl_nm+":"+set_col_nm+":"+set_col_val+":"+whr_col_nm+":"+whr_col_val+":"+field_type);
    $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/update_field')?>',
        data: {tbl_nm:tbl_nm,set_col_nm:set_col_nm,set_col_val:set_col_val,whr_col_nm:whr_col_nm,whr_col_val:whr_col_val,field_type:field_type},
        dataType: 'text',
        //async: false,
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("before event_id--"+event_id+" event_date--"+event_date);
        },
        success: function(data) {
            //alert("data--"+data);

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
function event_open(cus_id)
	{
// alert(cus_id);
      // $('#myModal').hide();
      // $('.modal-backdrop.in ').hide();
localStorage.setItem("pckId", cus_id);

      $.ajax({
          type: 'POST',
          url: '<?=site_url('fi_home/get_account_details')?>',
          data: {cus_id:cus_id},
          dataType: 'text',
          //async: false,
          beforeSend: function() {
              // setting a timeout
              $('.fadeMe').show();
              //alert("before event_id--"+event_id+" event_date--"+event_date);
          },
          success: function(data) {
              // alert("data--"+data);

              if(data!="")
              {
                localStorage.setItem("customer_name", data);

                  window.location.href = "<?php echo site_url('fi_home/search_cus')?>?id="+cus_id;
              }else{

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

  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
