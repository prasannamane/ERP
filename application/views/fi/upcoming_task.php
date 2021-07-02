<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->



      <!-- Left side column. contains the logo and sidebar -->

      <!-- Content Wrapper. Contains page content -->
       <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

      <style>

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
              <div class="ibox-title" style="background: #c19faf;">
                  <h5 style="color:#333;"><b>Tasks </b></h5>
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
                      <th class=" ">Task</th>
                      <th class=" ">Subtask</th>
                      <th class="w90">Date</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
                    foreach ($task as $task)
                    {?>
                  <tr>
                    <td><?=$i++; ?></td>
                    <td><small><?=$task['type_name']; ?></small></td>
                    <td><?=$task['sub_name']; ?></td>
                    <?php
                    $upcomingDate = date("m/d/Y", strtotime($task['task_date_started']));
                     ?>
                    <td><i class="fa fa-calendar"></i> <?=$upcomingDate; ?></td>

                  </tr>
                  <?php }?>
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