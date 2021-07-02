<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $page_name ?> | ERP System</title>
    <link rel="icon" href="<?= base_url('assets/fevicon.png') ?>" type="image/gif" sizes="16x16">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script>
        window.onload = function() {
            localStorage.removeItem("pckId");
        };
    </script>
</head>

<body class="hold-transition login-page">
    <?php $this->load->view('template/alert'); ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Event Management</b></a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Sign up your company with OurMainEvent.com </p>
            <form class="m-t" role="form" method="post" action="<?= site_url('authentication/register') ?>">
                <div class="form-group has-feedback">
                    <input type="email" name="email" id="email" autocomplete="off" class="form-control" placeholder="Email" value="">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="user_fname" id="" autocomplete="off" class="form-control" placeholder="Name" value="">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="user_name" id="" autocomplete="off" class="form-control" placeholder="UserName" value="">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="user_password" id="password" autocomplete="off" class="form-control" placeholder="Password" value="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                    </div>
                </div>
            </form>
            <!-- <a href="#">I forgot my password</a><br> -->
            <a href="<?= base_url() ?>" class="text-center">Sign In</a>
        </div>
    </div>
    <script src="<?php echo base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            localStorage.clear();
            $('body').on('change', '#email', function() {
                $('#password').val("");
            });
        });
    </script>
</body>
</html>