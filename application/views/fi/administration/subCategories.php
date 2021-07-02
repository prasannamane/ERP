<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ERP System | Administration</title>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">

<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/skin-blue.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/styles.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/styles_new.css">


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Administration</a></li>
                <li class="active">
                    <?php
                    foreach ($cat as $catkey) {
                        echo $catkey['cat_name'];
                    } ?>
                </li>
            </ol>
        </section>
        <?php if (isset($success)) { ?>
            <div class="alert alert-success alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong></strong> <?= $success ?> </div>
        <?php } ?> <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissable fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error!</strong> <?= $error ?> </div>
        <?php } ?>

        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <h3 class="uhead1">
                                     
                                        <?php foreach ($cat as $catkey) {
                                            echo "Add " . $catkey['cat_name'];
                                        } ?>
                                    </h3>
                                </div>
                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">
                                            <li><a href="#" class="uhead2"> Main Menu </a></li>
                                            <li><a href="#" class="uhead2"> Options </a></li>
                                            <li><button class="btn btn-default"> <i class="fa fa-print"></i></button> </li>
                                        </ul>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <?php if ($id == 54) { ?>
                                                <th>AP Category</th>
                                            <?php } ?>

                                            <th>Sub Category Name</th>
                                            <?php if ($id == 10) { ?>
                                                <th>Opening balance</th>
                                            <?php } ?>
                                            <th>Description</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    <form action="<?= site_url('Administration/add_sub_cates/') ?>" method="POST" name="lform" id="lform">
                                        <tbody>
                                            <tr>
                                                <td>1</td>

                                                <?php if ($id == 54) { ?>
                                                    <td>
                                                        <select style="width: 100%;" name="subCategoriesId">
                                                            <option>Choose</option>
                                                            <?php foreach ($MainCategories as $row) { ?>
                                                                <option value="<?= $row['sub_id'] ?>"><?= $row['sub_name'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>

                                                    <?php } ?>

                                                    <td>
                                                        <input type="hidden" class="form-control" name="cat_id" value="<?php echo $id ?>">
                                                        <input type="text" class="form-control" name="sub_name" id="id" style="text-transform: capitalize;" required>
                                                    </td>

                                                    <?php if ($id == 10) { ?>
                                                        <td><input type="text" class="form-control" name="open_bal" id="open_bal" style="text-transform: capitalize;" required></td>
                                                    <?php } ?>

                                                    <td>
                                                        <input type="text" class="form-control" name="sub_desc" id="sub_desc" style="text-transform: capitalize;" required>
                                                    </td>
                                                    <td> <button class="btn btn-xs btn-success tr_clone_save" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button> </td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="uhead1">
                                <!-- View Sub Category -->
                                <?php foreach ($cat as $catkey) {
                                    echo "View " . $catkey['cat_name'];
                                } ?>
                            </h3>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <?php if ($id == 54) { ?>
                                                <th>AP Category</th>
                                            <?php } ?>
                                            <th>Sub Category Name</th>
                                            <?php if ($id == 10) { ?>
                                                <th>Opening balance</th>
                                            <?php } ?>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($sub_cats as $key) { ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <?php if ($id == 54) { ?>
                                                    <td>
                                                        <select style="width: 100%;" name="subCategoriesId">
                                                            <option>Choose</option>
                                                            <?php foreach ($MainCategories as $row) {
                                                                if ($row['sub_id'] == $key['subCategoriesId']) {
                                                                    $select = "selected";
                                                                } else {
                                                                    $select = "";
                                                                }
                                                            ?>
                                                                <option <?= $select ?> value="<?= $row['sub_id'] ?>"><?= $row['sub_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <td><?= $key['sub_name'] ?></td>
                                                    <?php if ($id == 10) { ?>
                                                        <td><?php print_r($key['opening_bal']); ?></td>
                                                    <?php } ?>
                                                    <td><?= $key['sub_description'] ?></td>
                                                    <td>
                                                        <?php if ($key['sub_id'] != "172" && $key['sub_id'] != "193") { ?>
                                                            <a href="<?= site_url('fi_home/delete_sub_cate/' . $key['sub_id']) ?>" onclick="return confirm('Are you sure want to Delete..??')" class="btn btn-xs btn-warning tr_clone_edit"><i class="fa fa-trash"></i></a>
                                                        <?php  } ?>
                                                    </td>


                                            </tr>
                                        <?php  } ?>
                                    </tbody>
                                    </form>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.box-info -->
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="<?php echo base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script> <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $('#l_zip').on('change', function() {
            var zip = $("#l_zip").val();
        });
    </script>