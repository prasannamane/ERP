<!DOCTYPE html><!-- <html>  <head> -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ERP System | Administration</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css"> <!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css"> <!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css"> <!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/skin-blue.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/styles.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/styles_new.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>    <![endif]-->
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Administration</a></li>
                <li class="active">Admin</li>
            </ol>
        </section>
        <section class="content">
            <!-- TABLE: LATEST ORDERS -->
            <div class="row">

                <?php if (isset($success)) { ?>
                    <div class="alert alert-success alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> <?= $success ?>
                    </div> <?php } ?>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong>
                        <?= $error ?>
                    </div> <?php } ?>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <h3 class="uhead1"> Admin </h3>
                                </div>

                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">

                                        <ul class="list-inline topul">
                                            <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                                            <li><a href="#" class="uhead2"> Options </a></li>
                                            <li><button class="btn btn-default">
                                                    <i class="fa fa-print"></i></button>
                                            </li>
                                        </ul>
                                        <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a>  -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">


                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-info secondblock_bg">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <h3 class="uhead1"> Dropdown Category </h3>
                                </div>
                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive ">
                                <table class="table tleft table-hover no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Edit</th>
                                            <?php
                                            if($this->session->fi_session['id'] == 1){
                                            ?>
                                            <th>Delete</th>
                                            <?php } ?> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($cat as $key) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?php echo $key['cat_name']; ?></a></td>
                                                <th><a href="<?= site_url('Administration/add_sub_cat/' . $key['id']) ?>"><i class="fa fa-edit"></i></a></th>
                                                <?php
                                            if($this->session->fi_session['id'] == 1){
                                            ?>
                                                <th> <a href="<?= site_url('Administration/delete_cat/' . $key['id']) ?>" class="btn btn-xs btn-danger"> <i class="fa fa-minus "></i> </a> </th>
                                                <?php  } ?>
                                            </tr> <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <h3 class="uhead1"> Add Category </h3>
                                </div>
                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover no-margin">
                                    <form action="<?= base_url('Administration/add_drop_categories/') ?>" method="POST">
                                        <div class="row mlr0">
                                            <div class="col-sm-8">
                                                <input name="add_drop_cat" class="form-control" style="text-transform: capitalize;" required />
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-md btn-info btn-flat">Add Category</button>
                                            </div>
                                        </div>
                                    </form>
                                </table>

                            </div>

                        </div>

                    </div>
                    <div class="box box-default firstblock_bg">
                        <div class="table-responsive">
                            <table class="table   table-hover no-margin">
                                <thead>
                                    <tr class="uppercse_block">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>Years</th>
                                        <th>Month</th>
                                        <th>Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select class="form-control">
                                                <option>Select</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
                    $("#category_id").on("change", function() {
                                var cid = $(this).val();
                                alert(cid);
    </script>
    <script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>