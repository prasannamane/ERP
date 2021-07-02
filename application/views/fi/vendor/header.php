<!DOCTYPE html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | <?=$page_title?></title>
 
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
 
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
 
    <!-- Theme style -->
    <script src="<?=base_url('assets/')?>bower_components/jquery/dist/jquery.min.js"></script> 
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

    <!-- Google Font -->
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

    span.label.label-success 
        {
            display: inline-block;
            margin: 3px 0 0 0;
        }

    .form-control {
    background: #fff;
    }

    .firstblock_bg,  .secondblock_bg, .thirdblock_bg, .fourthblock_bg  
    {
        background: #f185f9 !important;
    }


.box .form-group.nospacerow {
    margin: 0 -5px 10px -5px !important;
}

.box .nospacerow div[class *= "col-"] {
    padding: 0 5px;
}

.box .form-control {
    background: #fff;
}

    </style>
</head>