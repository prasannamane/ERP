<!DOCTYPE html>

<!-- <html>
 
<head> -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Bank Statement View</title>
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .titlen_search input[name*="top"] {
    padding: 1px;
}

.blockk{ display: block; }
.table>tbody>tr>td{ padding: 0.6px 2px; }
span.text-right.blockk {
    padding: 0 1px 0;
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

          <li class="active">Bank Statement View</li>

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
                    <h3 class="uhead1"> Bank Statement View </h3>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <div class="pull-right">
                      <ul class="list-inline topul">
                        <li><a href="#" class="uhead2"> Main Menu </a></li>
                        <li><a href="#" class="uhead2"> Options </a></li>
                        <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>
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

                 
                </div>

               
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <div class="box box-default firstblock_bg">
              <div class="box-header with-border mb5"> <p class="uhead2">Chase </p> </div>
               <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table fixed_table table-hover no-margin mw800">
                        <thead>
                          <tr>
                            <th class="w30">#</th> 
                            <th class="w60">Chk #</th> 
                            <th class="w90">Date</th> 
                            <th class="">Description</th> 
                            <th class="w90"> Amount</th> 
                            <th class="w90"> Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                         <tr><td> 1</td> <td></td> <td>3/31/2019</td> <td> American Honda </td> <td><span class="text-right blockk">($477.58)</span></td> <td><span class="text-right blockk">($477.58)</span></td></tr>
<tr><td>2</td> <td> </td> <td>3/31/2019</td> <td> Chase Automotive </td> <td><span class="text-right blockk">($443.99)</span></td> <td><span class="text-right blockk">($921.57)</span></td></tr>
<tr><td>3</td> <td> </td> <td>3/31/2019</td> <td> Cg Pro Prints </td> <td><span class="text-right blockk">($164.18)</span></td> <td><span class="text-right blockk">($1,085.75)</span></td></tr>
<tr><td>4</td> <td> </td> <td>3/31/2019</td> <td> Allstate Insurance </td> <td><span class="text-right blockk">($437.37)</span></td> <td><span class="text-right blockk">($1,523.12)</span></td></tr>
<tr><td>5</td> <td> </td> <td>3/31/2019</td> <td> Revzin, Vyacheslav Steve Revzin </td> <td><span class="text-right blockk">($420.00)</span></td> <td><span class="text-right blockk">($1,943.12)</span></td></tr>
<tr><td>6</td> <td> </td> <td>3/31/2019</td> <td> American Express </td> <td><span class="text-right blockk">($54.01)</span></td> <td><span class="text-right blockk">($1,997.13)</span></td></tr>
<tr><td>7</td> <td> </td> <td>3/31/2019</td> <td> Beli Heller </td> <td><span class="text-right blockk">($550.00)</span></td> <td><span class="text-right blockk">($2,547.13)</span> </td></tr>                      
                        </tbody>


                        <tbody>
                          <tr> <th class="w90" colspan="5"><span class="text-right blockk"><span class="text-right blockk">Previous Balance:</span></th> <th><span class="text-right blockk">$0.00</span></th></tr>
<tr> <th class="w90" colspan="5"><span class="text-right blockk"><span class="text-right blockk">Total Deposited:</span></th> <th> <span class="text-right blockk">$0.00</span></th> </tr>
<tr> <th class="w90" colspan="5"><span class="text-right blockk"><span class="text-right blockk">Total Withdrawn:</span></th> <th> <span class="text-right blockk">$0.00</span></th> </tr>
<tr> <th class="w90" colspan="5"><span class="text-right blockk"><span class="text-right blockk">Balance:</span></th> <th> <span class="text-right blockk">($2,547.13)</span></th> </tr>
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

