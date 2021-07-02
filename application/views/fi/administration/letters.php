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
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <p class="uhead1">View Letters</p>
                    </div>
                    <div class="box-header with-border">
                       	<a href="<?php echo site_url("fi_home/add_newletters")?>"><i class="fa fa-pencil"></i> Add New Letters
                        </a>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th style="width:24%;">Template Name</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $user = $this->session->fi_session['id'];
                                $letter_sql = $this->db->query("SELECT * FROM adm_letters_type where user='".$user."' ORDER BY id");
                                foreach ($letter_sql->result() as $lettersql_dtls)
                                {

                                ?>

                        <tr>

                          <td>
                            <?php if (!empty($lettersql_dtls->name)) { ?>
                            <input type="text" class="form-control" value="<?=$lettersql_dtls->name?>"readonly>
                          <?php  }else { ?>
                            <input type="text" class="form-control" value=""readonly>
                          <?php } ?>

                          </td>
                          <td>

                            <a class="toggle_textarea btn btn-primary"> View Template  </a>
                           <textarea name="t_sm<?=$i++?>" id="text_data"  class="form-control t_sm" disabled><?= htmlspecialchars($lettersql_dtls->desc)?> </textarea>
                          </td>
                          <td>
                            <a href="<?=site_url('fi_home/edit_letters/').$lettersql_dtls->id?>" class="btn btn-xs btn-warning "><i class="fa fa-pencil"></i></a>
                            <a onclick="fndelletter('<?=$lettersql_dtls->id?>')" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i></a>
                          </td>
                       </tr>
                     <?php
                     
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
    	$("body").on('click','.toggle_textarea',function(){
       if($(this).parent("td").find(".cke_chrome").css('display') == 'block' ){
          	$(".cke_chrome").slideUp();
            $(".cke_chrome").css({'display':'none'});
      }else{

          $(".cke_chrome").slideUp();
      		$(this).parent("td").find(".cke_chrome").slideDown();
      		$(this).parent("td").find(".cke_chrome").css({'display':'block'});
      }
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
                  url: '<?=site_url('fi_home/fndelletterinfo')?>',
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
                          window.location.href="<?=site_url('fi_home/administration_letters');?>";

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



  <!-- <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script> -->


<!-- CK Editor -->


<script>
  CKEDITOR.replaceAll('textletterdetails');
  CKEDITOR.replaceAll('t_sm');
  // CKEDITOR.readOnly = true;
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
