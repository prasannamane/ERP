<!DOCTYPE html>

<!-- <html>

  <head> -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ERP System | Administration</title>

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

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- Google Font -->

    <link rel="stylesheet"

      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <!-- <div class="wrapper"> -->

      <!-- <?php  ?> -->

      <!-- Left side column. contains the logo and sidebar -->

      <!-- <?php  ?> -->

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Administration</a></li>

        <li class="active">Packages</li>

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

          <!-- TABLE: LATEST ORDERS -->
          <form action="<?=site_url('fi_home/admin_packages/')?>" method="POST" id="iform" name="iform">
            <div class="row">
              <div class="col-md-12">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <div class="row">
                      <div class="col-sm-5 col-md-4">
                        <h3 class="uhead2">Packages</h3>
                      </div>

                      <div class="col-sm-7 col-md-8">
                        <div class="pull-right">
                          <ul class="list-inline topul">
                            <li><a href="#" class="uhead2"> Main Menu </a></li>
                            <li><a href="#" class="uhead2"> Options </a></li>
                            <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                          </ul>
                          <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-hover no-margin">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Payment#</th>
                            <th>Receipt</th>
                            <th>Type</th>
                            <th>CheckNum</th>
                            <th>SDesc</th>
                            <th>Amount</th>
                            <th>Credit</th>
                            <th>UserName</th>
                            <th>Notes</th>
                            <th>Deposit</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php //foreach ($variable as $key) {
                            // code...
                           ?>
                          <tr onclick="goToPage(<?php echo "1" ;?>,<?php echo "2" ;?>);">
                            <td>fas</td>
                            <td>fsa</td>
                            <td>bvcx</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        <?php //} ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>

              <!-- /.col -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="btns text-center">
                    <button type="submit" class="btn btn-lg btn-info btn-flat">Save</button>
                    <button type="reset" class="btn btn-lg btn-default btn-flat">Cancel</button>
                  </div>
                </div>
              </div>
              <!-- /.col -->

            </div>
          </form>
        </section>
        <!-- /.content -->
      </div>

      <!-- /.content-wrapper -->

      <!-- Main Footer -->

      <!-- <?php  ?>

    </div> -->

    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->

      <script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->

  <!--<script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->

  <script src="<?php echo base_url('assets/');?>js/jquery.validate.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
   <script type="text/javascript">
   function goToPage(val,est)
   {

     if (val) {

         window.location = <?php echo site_url('Fi_home/custinvoices');?>;

     }
   }



   </script>

  <!-- AdminLTE App -->

 <!-- <script src="dist/js/adminlte.min.js"></script>-->

 <!-- </body>

</html>-->
