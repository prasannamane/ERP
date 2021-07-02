<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->



      <!-- Left side column. contains the logo and sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

      <style>

        input[type="checkbox"][readonly] {
  pointer-events: none;
}

        .closebtn, .snoozbtn, .snoozbtn:active{ display: inline-block; margin: 0 3px; font-size: 18px; color: #716f6f;  }
        .snoozactive {
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

          <?php }?>

          <?php if(isset($error)){?>

          <div class="alert alert-danger alert-dismissable fade in">

             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <strong>Error!</strong> <?=$error?>

          </div>

          <?php }?>
          <!-- TABLE: LATEST ORDERS -->

            <!--*********************** new design **************************************-->
            <div class="se-pre-con"></div>
            <div class="ibox-content">
              <div class="row">
              </div>
              <div class="ibox-title" style="background: #ad9fc1;">
                  <h5 style="color:#333;"><b>Events </b></h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                          <i class="fa fa-chevron-up"></i>
                      </a>
                      <!-- <a class="close-link">
                          <i class="fa fa-times"></i>
                      </a> -->
                  </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example fixed_table">
                  <thead>
                    <tr>
                      <th class="w50">Number</th>
                      <th class="">Event Type</th>
                      <th class="">Name</th>
                      <th class="w90">Date</th>
                       <th  class="w100">Missing Details</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
                    foreach ($event as $event) {

                    $evntdata=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$event['cus_id']."'");
                    $evntdatarow=$evntdata->row();

                    $seteventname="";
                    $chkisjobs=$this->db->query("SELECT * FROM event_jobs WHERE event_id='".$event['event_id']."' ORDER BY event_id ASC  LIMIT 2");
                    $chknjobsrows=$chkisjobs->num_rows();
                    //echo "chknjobsrows--".$chknjobsrows;
                      if($chknjobsrows>1)
                      {
                        //echo "if";

                         foreach ($chkisjobs->result() as $chkisjobs_dtls )
                         {
                            $seteventname.= $chkisjobs_dtls->jb_name."-";
                         }

                      }else{
                        //echo "else";
                            $seteventname= $evntdatarow->cus_lname."-".$evntdatarow->cus_company_name;
                      }

                  ?>
                      <tr>
                        <td><?=$i ?></td>
                        <td><small><?=$event['event_type']; ?></small></td>
                        <td><?=rtrim($seteventname,"-")?></td>
                        <?php
                        $newDate = date("m/d/Y", strtotime($event['event_date']));
                        ?>
                        <td><i class="fa fa-calendar"></i> <?=$newDate; ?></td>
                        <td><?php if($event['e_event_id'] == ''){ ?><input type="checkbox" name="" checked="" readonly=""><?php 

                                              }else{ ?><input type="checkbox" name="" readonly=""><?php

                                              } ?></td>
                      </tr>

                      <?php $i++; }?>
                    </tbody>
                  </table>
                </div>

                <div class="mybtn">
                  <a href="<?php echo site_url('fi_home/');?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
                </div>

              </div>
              <!-- end -->

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Main Footer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
<script src="<?php echo base_url('assets/');?>js/prasanna.js"></script>