<!DOCTYPE html>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Invoices</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
	.dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }

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

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fadeMes {
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

    table .form-group {
        margin-bottom: 0;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        /*padding: 1px;*/
    }

    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-clear-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    @media(max-width:1300px) {

        input[type="date"]{ max-width:90px;}
    }


    div#terms {
        max-height: 300px;
        overflow-y: auto;
    }

    input[type=checkbox], input[type=radio] {
        margin: 0 0 -1px;
    }

    .box * #loaditms {
        background: #fff;
    }

    #pickup select[name *="item_name"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }

    .inline_block{
      display: inline-block;
    }
    


    @media print {
        .titlen_search {
            display: none;
        }
      
        .box.box-default.firstblock_bg {
            display: none;
        }
    
        .mytabber ul.nav.nav-tabs {
            display: none;
        }
    
        .box.box-default.thirdblock_bg {
            display: none;
        }
    
        #loaditms { 
            display: block; 
        
        }
      
        .col-md-12.text-center.hide_in_invoice {
            display: none;
        }

        .hide_in_invoice{
            display: none;
        }
        
        .box-header {
            display: none;
        }

        .inline_block{
          display: block;
        }
    }

    tr.highlight {
    background-color: #f1eea04d;
}


  </style>
</head>