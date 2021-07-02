<!DOCTYPE html>

<!-- <html>

<head> -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Administration Info</title>

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

.active-task {
    background: #f7c3d6 !important;
}
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <!-- <div class="wrapper"> -->

    <!-- <?php ?> -->

    <!-- Left side column. contains the logo and sidebar -->

    <!-- <?php  ?> -->

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <section class="content-header">

        <h1>Event Management </h1>

        <ol class="breadcrumb">

          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="#">Administration</a></li>

          <li class="active">Task Status</li>

        </ol>

      </section>
 

      <section class="content">

        <!-- TABLE: LATEST ORDERS -->

        <div class="row">

          <div class="col-md-12">

            <div class="box box-info">

              <div class="box-header with-border">

                <div class="row">

                  <div class="col-sm-5 col-md-4">

                    <h3 class="uhead1"> Add User </h3>

                  </div>

                  <div class="col-sm-7 col-md-8">

                    <div class="pull-right">

                      <ul class="list-inline topul">

                        <li><a href="#" class="uhead2"> Main Menu </a></li>

                        <li><a href="#" class="uhead2"> Options </a></li>

                        <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

                      </ul>

                      <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->

                    </div>

                  </div>

                </div>

              </div>

              <!-- /.box-header -->

           </div>

            <!-- /.box -->

          </div>

        </div>


<!-- ************************************************* new tasks ************************************** -->

    <!-- <form method="POST" id="iform" name="iform" novalidate="novalidate"> -->
          <div class="row">
            <div class="col-md-6">
             <div class="box box-info firstblock_bg">
                <div class="box-header with-border">
                  <div class="row">
                    <div class="col-sm-5 col-md-4">
                      <h3 class="uhead2">
                        Add User
                      </h3>
                    </div>

                  </div>
            </div><div class="box-body">
                <div class="table-responsive" id="taskallrows">
                    <table class="table table-hover no-margin fixed_table ">
                      <thead>
                         <tr>
                          <th class="w40">#</th>
                          <th class="">Name</th>
                          <th class="w210">Email</th>                         
                          <th class="w60">Action</th>
                        </tr>
                      </thead>
                      <thead class="tskrow">
                           <tr class="tr_clone">
                            <td>1 </td>
                            <td>
                              <input type="text" class="form-control uname text-center" name="uname" id="uname" value="Oholei Menachem">
                            </td>
                            <td>
                                <input type="text" class="form-control text-center" name="uemail" id="uemail" value="oholei_menachem@gmail.com">
                            </td>
                            
                            <td>
                              <a class="btn btn-xs btn-danger tr_clone_remove"><i class="fa fa-minus"></i></a>
                            </td>
                          </tr>

                          <tr class="tr_clone">
                            <td>2 </td>
                            <td>
                              <input type="text" class="form-control uname text-center" name="uname" id="uname" value="Oholei Menachem">
                            </td>
                            <td>
                                <input type="text" class="form-control text-center" name="uemail" id="uemail" value="oholei_menachem@gmail.com">
                            </td>
                            
                            <td>
                              <a class="btn btn-xs btn-danger tr_clone_remove"><i class="fa fa-minus"></i></a>
                            </td>
                          </tr>

                          <tr class="tr_clone">
                            <td>3 </td>
                            <td>
                              <input type="text" class="form-control uname text-center" name="uname" id="uname" value="Oholei Menachem">
                            </td>
                            <td>
                                <input type="text" class="form-control text-center" name="uemail" id="uemail" value="oholei_menachem@gmail.com">
                            </td>
                            
                            <td>
                              <a class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></a>
                            </td>
                          </tr>
                                      
                                       
                      </thead>
                    </table>
                  </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
            </div>
            </div>

          </div>
       <!-- </form> -->
     </section>
        <!-- /.content -->
      </div>
          

    <!-- /.content-wrapper -->

    <!-- Main Footer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 
<script type="text/javascript">
  //ERP tr added
$(document).ready(function(){
//var cnt = 2
$("body").on('click','.tr_clone_add', function(rrr) {
  rrr.preventDefault();
// alert("111");
var tr    = $(this).closest('.tr_clone');
var clone = tr.clone();

    clone.find(':text').val('');
    clone.find('input[type=date]').val('');
    clone.find('input[type=time]').val('');

    //clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()
    //clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
    //tr.before(clone);

  $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
    tr.after(clone);

  //cnt++;
});
});



$(document).on('click', '.tr_clone_remove', function(){
    var tr    = $(this).closest('.tr_clone');
  //$(this).closest('table').addClass("currenttable");
  //var alltr = $(this).parents("table.currenttable").find('tr');
  //var len = alltr.length - 1;

    //var clone = tr.remove();
    tr.remove();
  //if(cnt>0)
  // {
  // cnt--;

  // }
});
</script>