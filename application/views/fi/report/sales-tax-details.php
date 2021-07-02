<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Sales Tax Details</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style type="text/css">
        .titlen_search input[name*="top"] {
        padding: 1px;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">

  <!-- <div class="wrapper">

    <?php include('includes/header.php'); ?> -->

    <!-- Left side column. contains the logo and sidebar -->

    <!-- <?php include('includes/sidebar.php'); ?> -->

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <section class="content-header">

        <h1>Event Management </h1>

        <ol class="breadcrumb">

          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="#">Reports</a></li>

          <li class="active">Sales Tax Details</li>

        </ol>

      </section>

      <section class="content">

        <!-- TABLE: LATEST ORDERS -->

        <div class="row">
          <div class="col-md-12">
            <div class="box box-info report_sec titlen_search">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-sm-5 col-md-4">
                    <h3 class="uhead1">
                      Sales Tax Details
                    </h3>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <div class="pull-right">
                      <ul class="list-inline topul">
                        <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                        <li><a href="#" class="uhead2"> Options </a></li>
                        <li><button class="btn btn-default"  onclick="print();" > <i class="fa fa-print"></i></button> </li>
                      </ul>
                      <!-- <a href="#" class="btn btn-md btn-info btn-flat">No Crews</a> -->
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="row space3">

                  <div class="col-md-3 lstpaytype_cus_col">

                    <div class="form-group">

                      <select class="form-control">

                        <option value=""></option>
                        <option value="val">Martinez, Timothy - 35 Temple Place</option>

                      </select>

                    </div>

                  </div>

                  <div class="col-md-2 w90">

                    <div class="form-group">
                      <input class="form-control contact_no" type="date" id="frm_date" name="topfrmo" value="" placeholder="From date"> 
                    </div>

                  </div>

                  <div class="col-md-2 w90">

                    <div class="form-group">
                      <input class="form-control" type="date" name="topto" placeholder="To date">
                    </div>

                  </div>

                  <!-- <div class="col-md-2 balance_count">

                    <div class="form-group">

                      <input class="form-control text-right" type="text" placeholder=" ">

                    </div>

                  </div> -->

                  <!-- <div class="col-md-1 col-sm-2">

                    <div class="form-group">

                      <input class="form-control" type="text" placeholder="1">

                    </div>

                  </div>
 -->
 <div class="box-tools pull-right dflex"> 
                      <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left" >Email</a>  
                    </div>
                </div>

               
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <div class="box box-default firstblock_bg">
               <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table fixed_table table-hover no-margin mw800">
                        <thead>
                          <tr>
                            <th class="w30">#</th> 
                            <th class="w70"> Account</th> 
                            <th class=""> Name</th> 
                            <th class="w80"> Date</th> 
                            <th class="w80"> Sales</th> 
                            <th class="w80"> Taxable</th> 
                            <th class="w80"> Non Taxable</th> 
                            <th class="w80"> Sales Tax</th> 
                            <th class="w80"> Sales Tax</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                                                     
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                </div>
            </div>

          </div>

        </div>

      </section>

      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

    <!-- Main Footer -->

    <!-- <?php include('includes/footer.php'); ?>

  </div> -->

  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->

  <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->

  <!-- Bootstrap 3.3.7 -->

  <!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->

  <!-- AdminLTE App -->

  <!-- <script src="<?php //echo base_url('assets/');?>dist/js/adminlte.min.js"></script> -->

</body>

</html>

