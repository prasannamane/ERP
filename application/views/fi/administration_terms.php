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

          <li class="active">Terms</li>

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

                      Add New Terms

                    </h3>

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

              <!-- /.box-header -->

              <div class="box-body">

                <?php
                  //echo "segment--".$this->uri->segment(4);

                  $letter_sql=$this->db->query("SELECT * FROM adm_terms_type WHERE id='".$this->uri->segment(4)."'");
                  $lettersql_nrows=$letter_sql->num_rows();
                  if($lettersql_nrows>0)
                  {
                    $lettersql_rows=$letter_sql->row();

                      $ltytpeval=$lettersql_rows->name;
                      $ldescval=$lettersql_rows->amount;

                  }else{
                      $ltytpeval="";
                      $ldescval="";

                  }
                    

                ?>

                <form id="frmaddlettersdetails" name="frmaddlettersdetails" action="<?=site_url('fi_home/addtermsinfo')?>" method="post" >

                  <div class="form-group">
                       <div class="col-sm-4">
                         <input class="form-control fcap" placeholder="Name" type="text" name="txttermstyp" id="txttermstyp" value="<?=$ltytpeval?>" required >
                       </div>

                  </div>
                   <div class="clearfix"></div><br>

                  <div class="form-group">
                      <div class="col-sm-4">
                          <input class="form-control fcap" placeholder="Amount" type="text" name="textamount" id="textamount" value="<?=$ldescval?>">

                      </div>
                 </div>
                 <div class="clearfix"></div><br>

                  <div class="row">
                      <div class="col-sm-12">
                          <div class="btns text-center">
                              <button class="btn btn-lg btn-info btn-flat">Save</button>
                                <a onclick="fnclearletterfrm()" class="btn btn-lg btn-default btn-flat">Cancel</a>
                          </div>
                      </div>
                  </div>

              </form>

              </div>

              <!-- /.box-body -->

            </div>

            <!-- /.box -->

          </div>

          <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <p class="uhead1">View Terms</p>
                </div>
              
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin">
                      <thead>
                        <tr>
                          <th style="width:24%;">Name</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $letter_sql=$this->db->query("SELECT * FROM adm_terms_type ORDER BY id");
                           foreach ($letter_sql->result() as $lettersql_dtls) 
                           {

                              if($lettersql_dtls->totsts==1)
                              {
                                $disp="display:none;";
                              }else{
                                 $disp="display:inline-block;";
                              }

                        ?>
                        <tr>
                          <td>
                            <input type="text" class="form-control" value="<?=$lettersql_dtls->name?>"> 
                          </td>
                          <td> 
                            <input type="text" class="form-control" value="<?=$lettersql_dtls->amount?>">
                          </td>
                          <td> 
                            <a href="<?=site_url('fi_home/administration_terms/edit/').$lettersql_dtls->id?>" class="btn btn-xs btn-warning "><i class="fa fa-pencil"></i></a> 
                            <a style="<?=$disp?>" onclick="fndelletter('<?=$lettersql_dtls->id?>')" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i></a>
                          </td>
                       </tr>
                     <?php } ?>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>



        </div>

      </section>

      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

    <!-- Main Footer -->


 <script type="text/javascript">
    function fnclearletterfrm()
     {
        var res=confirm("Are you sure want to Clear all Data..??");
         if(res==true)
          {
             $('#frmaddlettersdetails')[0].reset();       
          }
        
     }
 </script>


 <script type="text/javascript">
   function fndelletter(delId)
   {
      var r = confirm("Do you want delete this terms..?");
       if(r == true)
         {
             $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndeltremsinfo')?>', 
                  data: {delId:delId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {//alert(data);

                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          window.location.href="<?=site_url('fi_home/administration_terms');?>";

                      }else if(data=="error"){

                          $('.fadeMe').hide();
                      }

                  },
                  error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();

                  }

              });
         }

   }
 </script>


 
  <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script>

<!-- CK Editor -->

<script src="<?php echo base_url('assets/');?>bower_components/ckeditor/ckeditor.js"></script>



<script>

  $(function () {

    // Replace the <textarea id="editor1"> with a CKEditor

    // instance, using default configuration.

    CKEDITOR.replace('editor1')

    //bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5()

  })

</script>

<!-- </body>

</html> -->

