<!DOCTYPE html>
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
              <div class="ibox-title" style="background: #9bc0e0;">
                  <h5 style="color:#333;"><b>Events Missing </b></h5>
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
                <table class="table table-striped table-bordered table-hover dataTables-example">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Event Type</th>
                      <th>Name</th>
                      <th>Date</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
                    foreach ($missing as $missing)
                    {?>
                  <tr>
                      <td><?=$i++; ?></td>
                      <td><small><?=$missing['event_type']; ?></small></td>
                      <td><?=$missing['event_name']; ?></td>
                      <?php
                      $missingDate = date("m-d-Y", strtotime($missing['event_date']));
                      ?>
                      <td><i class="fa fa-calendar"></i> <?=$missingDate; ?></td>

                  </tr>
                <?php } ?>
                    </tbody>
                  </table>
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
