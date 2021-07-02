<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Administration Info</title>
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
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">

        <h1>Event Management </h1>

        <ol class="breadcrumb">

          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="#">Administration</a></li>

          <li class="active">Company Info</li>

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

            <div class="box box-default firstblock_bg">
               <div class="box-header with-border">

                <div class="row">

                  <div class="col-sm-5 col-md-4">

                    <h3 class="uhead1">

                      Company Info

                    </h3>

                  </div>

                  <div class="col-sm-7 col-md-8">

                    <div class="pull-right">

                      <ul class="list-inline topul">

                        <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->

                        <li><a href="#" class="uhead2"> Options </a></li>

                        <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

                      </ul>

                      <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->

                    </div>

                  </div>

                </div>

              </div>
            </div>


            <div class="box box-info">

             

              <!-- /.box-header -->

              <div class="box-body">

                <div class="col-md-12">

                  <form action="<?=site_url('fi_home/editinfo')?>" enctype="multipart/form-data" method="POST" name="pform" id="pform">

                  <div class="form-horizontal">

                    <div class="form-group">

                      <div class="form-group">

                        <div class="col-sm-6">

                          <input class="form-control" type="text" name="c_name" value="<?php print_r($info['company_name']) ?>" placeholder="Name">

                        </div>

                        <div class="col-sm-6">

                          <input class="form-control" type="text" name="c_address" value="<?php print_r($info['company_address']) ?>" placeholder="Address">

                        </div>

                      </div>

                      <div class="form-group">

                        <div class="col-sm-6">

                          <input class="form-control" type="text" id="comp_city" name="c_city" value="<?php print_r($info['company_city']) ?>" placeholder="City" readonly>

                        </div>

                        <div class="col-sm-6">

                          <input class="form-control" type="text" id="company_zip" name="c_zip" value="<?php print_r($info['company_zip']) ?>" placeholder="Zip" onchange="loadcityzip(this.value)">

                        </div>

                      </div>

                        <div class="form-group">

                        <div class="col-sm-6">

                          <input class="form-control" type="text" id="company_state" name="c_state" value="<?php print_r($info['company_state']) ?>" placeholder="State" readonly>

                        </div>



                        <div class="col-sm-6">

                          <input class="form-control" type="text" name="c_tax" value="<?php print_r($info['company_tax_rate']) ?>" placeholder="Tax Rate">

                        </div>

                      </div>

                        <div class="form-group">

                        <div class="col-sm-6">

                          <input class="form-control" type="text" name="c_key" value="<?php print_r($info['company_support_key']) ?>" placeholder="Support Key">

                        </div>
                        
                        <div class="col-sm-6">

                          <input class="btn btn-xs btn-primary image" type="file" name="logo" accept="image/x-png,image/gif,image/jpeg,image/jpg"  placeholder="Logo">

                        </div>

                      </div>
                      
                      <?php 
                        if($info['company_logo']!="")
                        {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <img src="<?php echo base_url().$info['company_logo']; ?>" style="max-width: 160px;"/>
                                </div>
                            </div>
                            <?php
                        }
                      ?>
                       

                    </div>

                  </div>

                </div>

              </div>

              <!-- /.box-body -->

            </div>
          </div>
        </div>
        <div class="col-md-12 text-center">
          <button class="btn btn-lg btn-info btn-flat">Save</button>
        </div>

      </section>

      </form>

      <!-- /.content -->

    </div>


<div  class="fadeMe" > <div id="loader" class="loader"></div> </div>

    <!-- /.content-wrapper -->

    <!-- Main Footer -->

    <!-- <?php  ?> -->

  <!-- </div> -->

  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->

  <!-- <script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script> -->

  <!-- Bootstrap 3.3.7 -->

  <!-- <script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->

  <!-- AdminLTE App -->

  <!-- <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script> -->



  <script type="text/javascript">

    //$('#cus_zip').on('change',function(){alert("dsfdg");
   function loadcityzip(zip)
    {
      //var zip = $("#cus_zip").val();
      //alert("zip--"+zip);
      if(zip)
      {
          $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/find_city/')?>",
            data: {zip : zip},
            dataType:"json",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
                //alert("data--"+data);
                 if(data!="")
                  {
                     var appendata = data.custaddrinfo;
                     //alert("appendata--"+appendata);

                    if(appendata!="")
                     {

                         $.each(appendata,function(appendata,item)
                         {//alert("City--"+item.City);

                           $("#comp_city").val(item.City);
                           $("#company_state").val(item.State);

                         });

                        $('.fadeMe').hide();
                     }else{

                        $("#comp_city").val('');
                        $("#company_state").val('');
                        $('.fadeMe').hide();
                        alert("Zip code is invalid..!");
                        $('#company_zip').focus();
                     }

                  }else{

                        $("#comp_city").val('');
                        $("#company_state").val('');
                     }
     
              }
          });

      }

    }
</script>



  <!-- <script type="text/javascript">



        $('#company_zip').on('change',function(){

        var zip = $("#company_zip").val();

      // alert(zip);

      if(zip!="")

      {

          // alert(zip);

          // $("#city").empty();



          $.ajax({

        type: "POST",

        url: "<?//=site_url('fi_home/find_city/')?>",

        data: {zip : zip},

        success: function(data)

        {

          // alert(data);

          console.log(data);

          var str = data;

          var temp = new Array();

          // this will return an array with strings "1", "2", etc.

          temp = str.split(",");

          // console.log(temp[0]);

            $("#comp_city").val(temp[0]);

            // $("#state").val(temp[1]);

            // $("#ship_city").val(temp[0]);

            // $("#ship_state").val(temp[1]);

            // $("#zip_codes").val(zip);

        }

          });

      }

      else

      {

        // alert("empty");

          // $("#city").val('');

          // $("#state").val('');

          // $("#ship_city").val('');

          // $("#ship_state").val('');

          // $("#zip_codes").val('');

      }

     });

    </script>
 -->

