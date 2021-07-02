<!DOCTYPE html>
<!-- <html>  <head> -->    
    <meta charset="utf-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <title>ERP System | Administration</title>    
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
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->    <!--[if lt IE 9]>    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>    <![endif]-->    <!-- Google Font -->
	<link rel="stylesheet"      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">  
</head>  
<body class="hold-transition skin-blue sidebar-mini">
		<!-- <div class="wrapper"> -->      <!-- <?php  ?> -->      <!-- Left side column. contains the logo and sidebar -->      <!-- <?php  ?> -->
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
             <section class="content-header">
                <h1>Event Management </h1>
                <ol class="breadcrumb">
                   <li><a href="index.php">
                      <i class="fa fa-dashboard"></i> Home</a></li>
                      <li><a href="#">Administration</a></li>
                      <li class="active">User Rights</li>
                  </ol>
              </section>

             

              <section class="content">
              <?php if(isset($success)){ ?>
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
                  <!-- TABLE: LATEST ORDERS -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="box box-default ">
                           <div class="box-header with-border">
                              <div class="row">
                                 <div class="col-sm-5 col-md-4">
                                    <h3 class="uhead1">
                                       User Rights
                                   </h3>
                               </div>
                               <div class="col-sm-7 col-md-8">
                                <div class="pull-right">
                                   <ul class="list-inline topul">
                                      <!-- <li> <a href="#" class="uhead2"> Main Menu </a> </li> -->
                                      <li>
                                         <a href="#" class="uhead2"> Options
                                         </a>
                                     </li>
                                     <li>
                                         <button class="btn btn-default" >
                                             <i class="fa fa-print">
                                             </i>
                                         </button>
                                     </li>
                                     <li>
                                      <a href="<?=site_url('Administration/administration_user_create')?>" class="btn btn-md btn-info btn-flat">New Users</a>
                                  </li>
                              </ul>                        <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="box box-info firstblock_bg">
             <div class="box-body">
                <div class="table-responsive">
                   <table class="table   table-hover no-margin">                      <thead>
                      <tr class="uppercse_block">
                         <th>#</th>
                         <th>Username</th>
                         <th>Password</th>
                         <th>Mail User</th>
                         <th>Admin</th>
                         <th>Status</th>
                         <th>Send Mail Active</th>
                         <th>Delete</th>
                     </tr>
                 </thead>
                 <tbody>
                  <?php $i=1;
                    foreach ($user as $user) // echo "<pre>";  print_r($driver);die;
                    { ?>
                        <tr>
                            <td><?=$i++; ?></td>
                            <td><?= $user['username']; ?></td>
        					<td>*****</td>
        					<td><?= $user['email']; ?></td>
        					<td><?php 
                                if($user['main_user']==1)
                                {
                                    echo "Admin";
                                } ?></td>
                            <td>
                                <?php 
                                if($user['main_user']!=1)
                                { ?>
                                    <select name="u<?php echo $user['id']; ?>" onchange="update_status(<?php echo $user['id']; ?>)">
                                                      <option value="0" <?= ($user['status']==0)? "selected" : "" ; ?> >Activated</option>
                                                      <option value="1" <?= ($user['status']==1)? "selected" : "" ; ?> >Deactivated</option>
                                                  </select>
                                                  <?php
                                } ?>
                            </td>
                            <td>
                                <input type="radio" name="mail_active" value="<?=$user['mail_active']?>" <?php if($user['mail_active'] == 1){ echo 'checked'; } ?>>
                            </td>
                            <td>
                                <a href="<?=base_url('Administration/administration_user_rights/'.$user['id'])?>" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i>
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

          </div>  


			<!-- <div class="col-md-12">
				 <div class="box box-default secondblock_bg">
					 <div class="box-body">
						 <div class="table-responsive">
							 <table class="table table-hover no-margin">                      
    							    <thead>
    								 <tr>
    									 <th>#</th>
    									 <th>Username</th>
    									 <th>Description</th>
    									 <th>Value</th>
    								 </tr>
    							 </thead>
    							 <tbody>
    								 <tr>
    									 <td>1</td>
    									 <td></td>
    									 <td></td>
    									 <td></td>
    								 </tr>
    							 </tbody>
    						 </table>
					    </div>
				
				    </div>
			    </div>
          </div> -->


          <!-- /.col -->
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<!-- <?php ?> -->
<!-- </div> -->
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- Bootstrap 3.3.7 -->
<!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->

<script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script>
<!-- </body></html> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    function update_status(id)
    {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('Administration/activate_deactivate_account')?>',
            data: {id:id},
            success: function(data) {

                //alert(data);
            }

        });
        
    }
</script>