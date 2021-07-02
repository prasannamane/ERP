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

                      Task Status

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
                        Tasks Status
                      </h3>
                    </div>
                    
                  </div>
            </div><div class="box-body">
      <div class="table-responsive" id="taskallrows">
          <table class="table table-hover no-margin customtable tasktable" >
            <thead>
               <tr>
                <th>#</th>
                <th>Name</th> 
                <th>Color Code</th>
               <!--  <th>Color</th> -->
                <th>Action</th>
              </tr>
            </thead>
            <thead class="tskrow">
           <?php
              $i=1;
             foreach ($tasktypelist as $tasktypelist_dtls) 
              {
                
              ?>
              <tr class="tr_clone taskrow"><!-- ondblclick="showtaskdetails('<?//=$tasktypelist_dtls['id']?>')" --> 
                <td><?=$i?>
                  <input type="hidden" class="hdntaskid" name="hdntaskid" id="hdntaskid" value="<?=$tasktypelist_dtls['id']?>">
                </td>
                <td>
                  <input type="text" class="form-control taskname updwn" name="taskname" id="taskname" value="<?=$tasktypelist_dtls['name']?>">
                </td>
                <td>
                    <input type="text" class="form-control taskcolor updwn" name="taskcolor" id="taskcolor" value="<?=$tasktypelist_dtls['color']?>">
                </td>
                <!-- <td style="background-color: <?//=$tasktypelist_dtls['color']?>" class="clrtd"></td> -->
                <td>
                  <a class="btn btn-xs btn-danger" onclick="fndeltasks('<?=$tasktypelist_dtls['id']?>')"><i class="fa fa-minus"></i></a>
                </td>
              </tr>
              <?php $i++; } ?>
               <tr class="tr_clone"> 
                <td><?=$i?></td>
                <td>
                  <input type="text" class="form-control lsttaskname" name="lsttaskname" id="lsttaskname">
                </td>
                <td>
                  <input type="text" class="form-control lsttaskcolor" name="lsttaskcolor" id="lsttaskcolor">
                </td>
                <td></td>
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
    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>

    <!-- /.content-wrapper -->

    <!-- Main Footer -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    

<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('change','.taskname',function(){
            var taskname= $(this).val();
            var hdntaskid= $(this).parents('.tr_clone').find('.hdntaskid').val();   
            if(taskname!="")
            {
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('Administration/updtatskstatusinfo')?>', 
                    data: {taskname:taskname,hdntaskid:hdntaskid},
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
          
}); 
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.taskcolor',function(){

    var taskcolor= $(this).val();
    var hdntaskid= $(this).parents('.tr_clone').find('.hdntaskid').val();  
    var actclr= $(this).parents('tr');  
    var taskclr= $(this).parents('.tr_clone').find('.taskcolor');  
    //alert("taskcolor--"+taskcolor+" hdntaskid--"+hdntaskid);  

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtatskstatuscolorinfo')?>', 
            data: {taskcolor:taskcolor,hdntaskid:hdntaskid},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
               //alert("before invoiceid--"+invoiceid);
            },
            success: function(data) {//alert(data);


               if(data=="isexists")
                {
                  alert("This Color code already in used..!");
                  taskclr.focus();
                  $('.fadeMe').hide();
                }else if(data=="success")
                {
                   
                   $('.fadeMe').hide();
                   
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
}); 
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.lsttaskname',function(){

         var taskname= $(this).val();
         var taskcolor= $(this).parents('.tr_clone').find('.lsttaskcolor').val();
         var taskclor= $(this).parents('.tr_clone').find('.lsttaskcolor');

         if(taskname!="")
         {
                $.ajax({
                type: 'POST',
                url: '<?=site_url('Administration/inserttskstatusinfo')?>', 
                data: {taskname:taskname,taskcolor:taskcolor},
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                   //alert("before invoiceid--"+invoiceid);
                },
                success: function(data) {//alert(data);

                    if(data=="isexists")
                    {
                        alert("This Color code already in used..!");
                        taskclor.focus();
                        $('.fadeMe').hide();
                    }else if(data=="success")
                    {
                       $('#taskallrows').load(location.href + ' #taskallrows');
                       $('.fadeMe').hide();
                       //window.location.href='<?//=site_url('fi_home/administration_task')?>';

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
  
           
}); 
});
</script>


<script type="text/javascript">
  function fndeltasks(delId)
   {
      var r = confirm("Do you want delete this task status..?");
       if(r == true)
         {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/deltaskstatusinfo')?>', 
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
                         $('#taskallrows').load(location.href + ' #taskallrows');
                         $('.fadeMe').hide();
                        // window.location.href='<?//=site_url('fi_home/administration_task')?>';

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





<script type="text/javascript">
$(document).ready(function(){
$('body').on('keydown', '.tskrow input[type="text"]',function(e){

    //e.preventDefault();
    var tdix = $(this).closest('td').index();
    //alert(tdix);

    var tdi=Number(tdix)+1;
    if (e.which === 40) {
      var hvupdwn=$(this).parents("tr").next("tr").find("td:nth-child("+ tdi +")").find('input').hasClass('updwn');
      //alert("hvupdwn--"+hvupdwn);
      if(hvupdwn==true)
       {
           $(this).parents("tr").next("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
          /* $('.taskrow').removeClass('active-task');
           $(this).parents("tr").next("tr").addClass('active-task'); 
           var hdntaskid= $(this).parents("tr").next("tr").find('.hdntaskid').val();
           //alert("hdntaskid==="+hdntaskid);
           loadtaskdetails(hdntaskid);*/
       }
   

    }else if(e.which === 38)
    {
       var hvupdwn=$(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('input').hasClass('updwn');
      //alert("hvupdwn--"+hvupdwn);
      if(hvupdwn==true)
       {
          $(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
        /*  $('.taskrow').removeClass('active-task');
          $(this).parents("tr").prev("tr").addClass('active-task'); 
          var hdntaskid= $(this).parents("tr").prev("tr").find('.hdntaskid').val();
          //alert("hdntaskid==="+hdntaskid);
           loadtaskdetails(hdntaskid);*/
      }
    }
});
});
</script>