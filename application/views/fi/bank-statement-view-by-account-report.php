<!DOCTYPE html>

<!-- <html>
 
<head> -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Bank Statement View By Account</title>
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

          <li class="active">Bank Statement View By Account</li>

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
                    <h3 class="uhead1"> Bank Statement View By Account </h3>
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
                          
                          <tr><td>1</td> <td></td>  <td>12/31/2018</td> <td> Previous Balance <td><span class="text-right blockk">$4,660.23</span> <td><span class="text-right blockk">$4,660.23</span></td></tr>
<tr><td>2 </td><td></td> <td>1/4/2019</td> <td> Deposit #:1131</td> <td><span class="text-right blockk">$179.69</span> <td><span class="text-right blockk">$4,839.92</span></td></tr>
<tr><td>3 </td><td></td> <td>1/4/2019</td> <td> Deposit #:1132</td> <td><span class="text-right blockk">$833.81</span> <td><span class="text-right blockk">$5,673.73</span></td></tr>
<tr><td>4 </td><td></td> <td>1/20/2019</td> <td> Deposit #:1140</td> <td><span class="text-right blockk">$1,597.00</span> <td><span class="text-right blockk">$7,270.73</span></td></tr>
<tr><td>5 </td><td></td> <td>1/30/2019</td> <td> Deposit #:1145</td> <td><span class="text-right blockk">$729.00</span> <td><span class="text-right blockk">$7,999.73</span></td></tr>
<tr><td>6 </td><td></td> <td>1/30/2019</td> <td> Deposit #:1133</td> <td><span class="text-right blockk">$950.00</span> <td><span class="text-right blockk">$8,949.73</span></td></tr>
<tr><td>7 </td><td></td> <td>1/30/2019</td> <td> Deposit #:1142</td> <td><span class="text-right blockk">$972.50</span> <td><span class="text-right blockk">$9,922.23</span></td></tr>
<tr><td>8 </td><td></td> <td>1/30/2019</td> <td> Deposit #:1141</td> <td><span class="text-right blockk">$1,000.00</span> <td><span class="text-right blockk">$10,922.23</span></td></tr>
<tr><td>9 </td><td></td> <td>1/30/2019</td> <td> Deposit #:1144</td> <td><span class="text-right blockk">$1,000.00</span> <td><span class="text-right blockk">$11,922.23</span></td></tr>
<tr><td>10</td><td></td> <td> 1/30/2019</td> <td> Deposit #:1138</td> <td><span class="text-right blockk">$2,329.38</span> <td><span class="text-right blockk">$14,251.61</span></td></tr>
<tr><td>11</td><td></td> <td> 1/30/2019</td> <td> Deposit #:1143</td> <td><span class="text-right blockk">$2,500.00</span> <td><span class="text-right blockk">$16,751.61</span></td></tr>
<tr><td>12</td><td></td> <td> 1/30/2019</td> <td> Deposit #:1137</td> <td><span class="text-right blockk">$2,550.00</span> <td><span class="text-right blockk">$19,301.61</span></td> </tr>
                           


                             
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

