<!DOCTYPE html>

<!-- <html>

<head> -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Alerts</title>

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

        <li><a href="#">Customer</a></li>

        <li class="active">Alerts</li>

      </ol>

    </section>

      <section class="content">

        <!-- TABLE: LATEST ORDERS -->

        <div class="row">

          <div class="col-md-12">

            <div class="box box-info titlen_search task_sec">

              <div class="box-header with-border">

                <div class="row">

                  <div class="col-sm-5 col-md-4">

                    <h3 class="uhead1">

                      Alerts

                    </h3>

                  </div>

                  <div class="col-sm-7 col-md-8">

                    <div class="pull-right">

                      <ul class="list-inline topul">

                       <!--  <li><a href="#" class="uhead2"> Main Menu </a></li>

                        <li><a href="#" class="uhead2"> Options </a></li> -->

                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>

                      </ul>

                      <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a>

                    </div>

                  </div>

                </div>

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <select class="form-control">

                        <option value="val">Martinez, Timothy - 35 Temple Place</option>

                      </select>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <select class="form-control">

                        <option value="val">569 - 388 - 2534</option>

                      </select>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <input class="form-control" type="text" placeholder="433">

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <input class="form-control" type="text" placeholder="$16.33">

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <input class="form-control" type="text" placeholder="1">

                    </div>

                  </div>

                </div>

                



















              </div>

              <!-- /.box-body -->

            </div>

            <!-- /.box -->


            <div class="box box-default">
                <div class="row">

                  <div class="col-md-2">

                    <p class="text-right"><strong>Select :</strong>

                    </p>

                  </div>

                  <div class="col-md-3">

                      <select class="form-control">

                      <option>Select</option>

                    </select>

                  </div>

                  <div class="clearfix"></div>

                  <div class="col-md-12">

                <div class="table-responsive">

                  <table class="table   table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Date Entered</th>

                        <th>Alert Date</th>

                        <th>In Process</th>

                        <th>Completed</th>

                        <th>Notes</th>

                        <th>User</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <td>1</td>

                        <td>

                          <select class="form-control">

                            <option>Select</option>

                          </select>

                        </td>

                        <td></td>

                        <td></td>

                        <td><div class="checkbox"><label><input type="checkbox"></label></div></td>

                        <td><div class="checkbox"><label><input type="checkbox"></label></div></td>

                        <td></td>

                        <td></td>

                      </tr>

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

  <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script>

<!-- </body>

</html> -->

