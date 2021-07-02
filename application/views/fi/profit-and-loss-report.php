<!DOCTYPE html>

<!-- <html>
 
<head> -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Profit and Loss Report</title>
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

.blockk{ display: block; padding: 0 1px 0 0 ;}
.table>tbody>tr>td{ padding: 0.6px 2px; }
.table>tbody>tr>th {
    background: #dbeaea;
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

          <li class="active">Profit and Loss Report</li>

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
                    <h3 class="uhead1">Profit and Loss Report</h3>
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
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="box box-default firstblock_bg">
              <div class="box-header with-border mb5"> <p class="uhead2">Expense </p> </div>
               <div class="row">
                  <div class="col-md-12">
                    <p>Total Income 
                      <span class="pull-right">$37,522.47</span>
                      <div class="clearfix"></div>
                    </p>
                    <div class="table-responsive">
                      <table class="table fixed_table table-hover no-margin mw500">
                        <tbody>
                          <tr> <td class="">No Category</td><td class="w90"> </td></tr>
                          <tr><td class=""> </td><td class=""><span class="text-right blockk">$9,691.76</span></td></tr>
                          <tr><th class="">Total No Category</th> <th class=""><span class="text-right blockk">$9,691.76</span></th></tr>                          
                          <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>


                        <tbody>
                          <tr> <td class="">1099 Sub Contractor</td><td class=""> </td></tr> 
                          <tr><td class=""> Assistant</td><td class=""><span class="text-right blockk">$970.00</span></td></tr>
                          <tr><th class="">Total 1099 Sub Contractor</th> <th class=""><span class="text-right blockk">$970.00</span></th></tr>                          
                          <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>

                         <tbody>
                          <tr> <td class="">Automobile Expenses</td><td class=""> </td></tr>  
                          <tr><td class=""> Car Lease </td><td class=""><span class="text-right blockk">$2,320.72</span></td></tr>
                          <tr><td class=""> Insurance </td><td class=""><span class="text-right blockk">$1,317.94</span></td></tr>
                          <tr><th class="">Total Automobile Expenses</th> <th class=""><span class="text-right blockk">$3,638.66</span></th></tr>                          
                          <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>

                        <tbody>
                          <tr> <td class="">Automobile Expenses</td><td class=""> </td></tr>  
                          <tr><td class=""> Car Lease </td><td class=""><span class="text-right blockk">$2,320.72</span></td></tr>
                          <tr><td class=""> Insurance </td><td class=""><span class="text-right blockk">$1,317.94</span></td></tr>
                          <tr><th class="">Total Automobile Expenses</th> <th class=""><span class="text-right blockk">$3,638.66</span></th></tr>                          
                          <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>


                        <tbody>
                          <tr> <td class="">Communications</td><td class=""> </td></tr>  
                          <tr> <td class="">Cellular Service </td><td class=""> <span class="text-right blockk">$105.91</span></td></tr>  
                          <tr> <th class="">Total Communications</th><th class=""> <span class="text-right blockk">$105.91</span> </th></tr>  
                           <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>

                        <tbody>
                          <tr> <td class="">Event Personel</td><td class=""> </td></tr>  
                          <tr> <td class="">Ass </td><td class=""> <span class="text-right blockk">$575.00</span></td></tr>  
                          <tr> <td class="">Assistant  </td><td class=""><span class="text-right blockk">$1,220.00</span></td></tr>  
                          <tr> <td class="">Photographer  </td><td class=""> <span class="text-right blockk">$2,000.00</span></td></tr>  
                          <tr> <td class="">Videographer  </td><td class=""> <span class="text-right blockk">$2,730.00</span></td></tr>  
                          <tr> <th class="">Total Event Personel </th><th class=""> <span class="text-right blockk">$6,525.00</span> </th></tr>  
                           <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>

 
                        <tbody>
                          <tr> <td class="">General Expenses</td><td class=""> </td></tr>  
                          <tr> <td class="">General Expenses </td><td class=""> <span class="text-right blockk">$0.00</span></td></tr>  
                          <tr> <td class="">Computer Programing </td><td class=""> <span class="text-right blockk">$4,400.00</span></td></tr>  
                          <tr> <td class="">Graphic Designer  </td><td class=""> <span class="text-right blockk">$95.00</span></td></tr>  
                          <tr> <td class="">Photolab </td><td class=""><span class="text-right blockk">$311.36</span></td></tr>  
                          <tr> <td class="">Video Editing</td><td class=""> <span class="text-right blockk">$1,225.00</span></td></tr>  
                          <tr> <th class="">Total General Expenses  </th><th class=""> <span class="text-right blockk">$6,031.36</span> </th></tr>  
                          <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody> 



                        <tbody>
                          <tr> <td class="">Supplies</td><td class=""> </td></tr>  
                          <tr> <td class="">Photographic Equipment  </td><td class=""> <span class="text-right blockk">$1,890.00</span></td></tr>  
                          <tr> <th class="">Total Supplies</th><th class=""> <span class="text-right blockk">$1,890.00 </span></th></tr>  
                           <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                        </tbody>

                        
                        <tbody> 
                           <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
                          <tr> <th class="">Total Expense</th><th class=""> <span class="text-right blockk">$28,852.69 </span></th></tr>  
                          <tr> <th class="">Net Income </th><th class=""> <span class="text-right blockk">$8,669.78</span></th></tr>  
                           <tr><td class="">&nbsp;</td> <td class="">&nbsp;</td></tr>                          
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

