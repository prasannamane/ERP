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
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

<style>
.cke_chrome {
    display: none;
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

          <li class="active">Crew Availability</li>

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

                      Add New Crew Availability

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

                  $letter_sql=$this->db->query("SELECT * FROM adm_crewavailability_info WHERE id='".$this->uri->segment(4)."'");
                  $lettersql_nrows=$letter_sql->num_rows();
                  if($lettersql_nrows>0)
                  {
                    $lettersql_rows=$letter_sql->row();

                      $ltytpeval=$lettersql_rows->name;
                      $ldescval=$lettersql_rows->desc;
                      $lcewId=$lettersql_rows->id;
                      $disp="display:block";

                  }else{
                      $ltytpeval="";
                      $ldescval="";
                      $lcewId="";
                      $disp="display:none";

                  }


                ?>

                <form id="frmaddlettersdetails" name="frmaddlettersdetails" action="<?=site_url('Administration/addcrewavailabilitiesinfo')?>" method="post" style="<?=$disp?>" >

                  <div class="form-group">
                    <div class="row">
                       <div class="col-sm-4">
                         <input class="form-control fcap" placeholder="Name" type="text" name="txtlettertyp" id="txtlettertyp" value="<?=$ltytpeval?>" required >

                       </div>

                        <div class="col-sm-4">
                        <select class="form-control">
                           <option> </option>
                           <option>Phone</option>
                           <option>Address</option>
                           <option>Company</option>
                           <option>First Name</option>
                           <option>Last Name</option>
                           <option>Location</option>
                           <option>Event Type</option>
                           <option>Event Date</option>
                           <option>Hebrew Date</option>
                           <option>Event Name</option>
                           <option>Referred By</option>
                           <option>No Of Crew</option>
                           <option>Account Number</option>
                        </select>
                       </div>
                      </div>
                  </div>


                   <div class="clearfix"></div><br>

                  <div class="form-group">
                      <div class="col-sm-8">
                          <textarea class="fcap" placeholder="Description" id="textletterdetails" name="textletterdetails" rows="5" cols="80" required><?=$ldescval?></textarea>
                      </div>

                      <div class="col-sm-4">
                        <div class="panel panel-danger">
                                       <div class="panel-heading">
                                            Note
                                       </div>
                                       <div class="panel-body">
                                           <p>Enter Username</p>
                                           <p>Enter Phone</p>
                                           <p>Enter Address</p>
                                           <p>Enter Company</p>
                                           <p>Enter Fname</p>
                                           <p>Enter Lname</p>
                                           <p>Enter Event type</p>
                                           <p>Enter Event date</p>
                                           <p>Enter Hebrew date</p>
                                           <p>Enter Event Name</p>
                                           <p>Enter Referred by</p>
                                           <p>Enter Crew No</p>
                                           <p>Enter Account No</p>
                                       </div>

                                   </div>
                      </div>
                 </div>
                 <div class="clearfix"></div><br>
                  <input class="form-control" type="hidden" name="txthdncrewId" id="txthdncrewId" value="<?=$lcewId?>" >
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
              <div class="box box-default firstblock_bg">
                <div class="box-header with-border">
                  <p class="uhead2">View Crew Availability</p>
                </div>
                <div class="box-header with-border">

                  	<a href="<?php echo site_url("Administration/add_newcrewavailabilities")?>"><i class="fa fa-pencil"></i>
                      Add New Crew Availability
                    </a>
                </div>

                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin">
                      <thead>
                        <tr>
                          <!-- <th style="width:24%;">Name</th> -->
                          <th style="width:24%;">Template Name</th>
                           <th>View</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // echo "<pre>";print_r($template_data);
                        $i=0;
                           foreach ($template_data as $lettersql_dtls)
                           {

                        ?>
                        <tr>
                          <!-- <td>
                            <input type="text" class="form-control" value="<?=$lettersql_dtls['name']?>">
                          </td> -->
                          <td>
                            <?php if (!empty($lettersql_dtls['template_name'])) { ?>
                            <input type="text" class="form-control" value="<?=$lettersql_dtls['template_name']?>">
                          <?php  }else { ?>
                            <input type="text" class="form-control" value="">
                          <?php } ?>

                          </td>
                          <td>

                            <a class="toggle_textarea btn btn-primary"> View Template  </a>
                           <textarea name="t_sm<?=$i ?>" id="text_data"  class="form-control t_sm" ><?= htmlspecialchars($lettersql_dtls['desc'])?> </textarea>
                          </td>
                          <td>
                            <a href="<?=site_url('Administration/edit_crewavailability/').$lettersql_dtls['id']?>" class="btn btn-xs btn-warning "><i class="fa fa-pencil"></i></a>
                           <!--  <a onclick="fndelletter('<?=$lettersql_dtls['id']?>')" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i></a> -->
                          </td>
                       </tr>
                     <?php
                     $i++;
                   } ?>

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
<script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    	$(".toggle_textarea").click(function(){
    		$(this).parent("td").find(".cke_chrome").slideToggle();
    	});
    });
    </script>
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
      var r = confirm("Do you want delete this letter..?");
       if(r == true)
         {
             $.ajax({
                  type: 'POST',
                  url: '<?=site_url('Administration/fndelletterinfo')?>',
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
                          window.location.href="<?=site_url('Administration/administration_letters');?>";

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






<!-- CK Editor -->


<script>
  CKEDITOR.replace('textletterdetails');
  CKEDITOR.replaceAll('t_sm');
</script>







<!-- <script src="<?php //echo base_url('assets/');?>bower_components/ckeditor/ckeditor.js"></script>
<script>
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('textletterdetails');
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
</script>
 -->
