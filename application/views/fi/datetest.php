<!DOCTYPE html>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Attachments</title>

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

    <style type="text/css">
   .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border: 16px solid #fff;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    margin: 15% auto;
    opacity: 1;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.fadeMe {
    opacity: 1;
    width: 100%;
    height: 100%;
    z-index: 10;
    top: 0;
    background: rgba(0,0,0,0.5);
    left: 0;
    position: fixed;
    text-align: center;
    display: none;
}

input[type=file] {
    max-width: 100px;
    display: inline-block;
}

 </style>



</head>

<body class="hold-transition skin-blue sidebar-mini">



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Customer</a></li>

        <li class="active">Date Test</li>

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

        <div class="row">

          <div class="col-md-12">

            <div class="box box-info">

              <div class="box-header with-border">

                <div class="row">

                  <div class="col-sm-5 col-md-4">

                    <h3 class="uhead1">

                      Date Test

                    </h3>

                  </div>

                  <div class="col-sm-7 col-md-8">

                    <div class="pull-right">

                      <ul class="list-inline topul">

                        <li><a href="#" class="uhead2"> Main Menu </a></li>

                        <li><a href="#" class="uhead2"> Options </a></li>

                         <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>

                      </ul>

                      <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>

                    </div>

                  </div>

                </div>

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="row space3">

                 

              <div > 

                <?php 
                  $viewtestdatesql=$this->db->query("SELECT * FROM tbl_testdate ORDER BY id DESC LIMIT 1");
                  $viewtestdatesqlrow=$viewtestdatesql->row();
                  if($viewtestdatesqlrow->date!="")
                  {
                      $setdate= $viewtestdatesqlrow->date;
                  }else{
                      $setdate="";
                  }
                ?>

                <form action="<?=base_url('fi_home/chkpostdata')?>" method="post">

                  <input type="date" name="txtdate" id="txtdate" class="txtdate" value="<?=$setdate?>">
                  <button type="submit" name="Submit" id="Submit" value="Submit">Submit</button>
                  
                </form>
             

              </div>  

                </div>

              </div>


            </div>

            <!-- /.box -->

          </div>

        </div>


  


      </section>

      <!-- /.content -->

    </div>


    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>


   <script src="http://tech599.com/tech599.com/johnsum/admin/assets/bower_components/jquery/dist/jquery.min.js"></script>




  



 




