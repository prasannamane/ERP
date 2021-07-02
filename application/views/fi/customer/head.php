<!DOCTYPE html>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ERP System | <?= $pageName ?></title>

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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


<style type="text/css">
    .loaders {
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


    .fadeMes {
        opacity: 1;
        width: 100%;
        height: 100%;
        z-index: 10;
        top: 0;
        background: rgba(0, 0, 0, 0.5);
        left: 0;
        position: fixed;
        text-align: center;
        display: none;
    }

    .error {
        color: red;
        font-family: Verdana;
        font-size: 8pt;
    }

    .error1 {
        color: red;
        font-family: Verdana;
        font-size: 8pt;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .form-control {
        margin-bottom: -1px;
        background: #fff;
    }

    .box .form-control {
        background: #fff;
    }

    select::-ms-expand {
        display: none;
    }

    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }


    .filtercust form .form-group .col-sm-1 {
        padding: 5px;
        width: 7%;
        min-width: 120px;
    }

    .filtercust form .form-group {
        width: 1010px;
        padding: 0 15px;
        margin: 0;
    }

    #frmsearchcust input,
    #frmsearchcust select {
        height: 23px;
    }

    #frmsearchcust .btn {
        height: 23px;
        min-width: 60px;
        font-size: 13px !important;
    }

    @media(min-width: 768px) and (max-width: 1400px) {
        a.fnpostemail[data-toggle="modal"] {
            cursor: pointer;
            margin-left: -6px;
        }
    }

    a.btn.btn-xs[data-target="#myModal1"] {
        width: 100%;
        height: 19px;
        border-radius: 0;
        line-height: 1.2;
        margin: 0;
        border: 1px solid #3c8dbc;
    }

    i.fa.fa-map-marker:hover {
        transform: scale(1.3);
        transition: all 0.3s;
        color: brown;
    }

    input[type="date"]::before {
        content: "";
    }

    input.referdby {
        height: 20px;
    }

    input#commited {
        margin: 3px 25px 0 25px;
    }

    input#hide {
        margin: 3px 25px 0 25px;
    }

    .table>tbody>tr>th,
    .table>thead>tr>th,
    .table thead tr th,
    .table tbody tr th {
        border: 1px solid #bbb !important;
        text-align: center;
    }

    .block {
        display: block;
    }

    input[type=checkbox] {
        margin: 2px 0 0;
    }

    .table .form-control {
        text-align: center;
        text-align-last: center;
    }

    #frmsendcrewmail .form-control {
        background: #fff;
    }

    #frmsendcrewmail .checkbox {
        width: initial;
    }

    #frmsendcrewmail .checkbox label {
        width: initial;
    }


    .modal .checkbox {
        width: initial;
    }

    .modal .checkbox label {
        width: initial;
    }
</style>
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
</head>