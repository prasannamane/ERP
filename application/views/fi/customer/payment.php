<?php $this->load->view('template/head.php'); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Payments | Customer | ERP System</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/skin-blue.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/styles.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/styles_new.css">
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

    .fadeMes {
        opacity: 1;
        width: 100%;
        height: 100%;
        z-index: 1000000;
        top: 0;
        background: rgba(0, 0, 0, 0.5);
        left: 0;
        position: fixed;
        text-align: center;
        display: none;
    }

    .dflex .input-group {
        padding-right: 3px;
        border-right: 1px solid #ccc;
        margin-right: 3px;
    }

    .btn-xs.btn-danger {
        margin: 0 1px 1px 0;
        height: 14px;
    }

    .modal a.btn.btn-xs.btn-danger {
        height: inherit;
    }

    .box {
        box-shadow: 0 0 10px #6af3f3;
        border: none;
        padding: 10px;
        border-radius: 5px;
        margin: 0 0 20px;
    }
</style>
<style>
    .glyphicon.glyphicon-usd {

        top: 0px !important;
        margin: 0px 0px 0px 5px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Customer</a></li>
                <li class="active">Payments</li>
            </ol>
        </section>

        <section class="content">
            <?php $this->load->view('template/payment_select_customer'); ?>
            <div class="box box-info firstblock_bg">
                <div class="box-header with-border">
                    <p class="uhead2">Payments</p>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive mt10" style="max-height: 400px;overflow-y: auto;">
                            <table class="table table-hover no-margin fixed_table">
                                <thead>
                                    <tr>
                                        <!--  <th>Sr.No</th> -->
                                        <th class="w70">Payments</th>
                                        <th class="w80">Date</th>
                                        <th class="w90">Reciept</th>
                                        <th class="w80">Type</th>
                                        <th class="w100">Check</th>
                                        <th class="w210">Description</th>
                                        <th class="w110">Amount</th>
                                        <th class="w90">Credit</th>
                                        <th class="w120">User</th>
                                        <th class="">Notes</th>
                                        <th class="w70">Deposit</th>
                                        <th class="w70">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="allpayments-historyallpayments-history" class="allpayments-history"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade payment_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" id="close_model" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Apply Payment 1</h4>
                        </div>

                        <div class="modal-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="table-responsive">
                                            <table class="table table-hover no-margin">
                                                <thead>
                                                    <tr>
                                                        <td>Total Amount</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-usd">
                                                                        </span>
                                                                    </span>
                                                                    <input type="text" name="custpayamt" class="form-control" value="" id="custpayamt" disabled value="" placeholder="0.00">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Applied Amount</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group"><span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-usd"></span>
                                                                    </span><input type="text" name="custappamt" id="custappamt" class="form-control" value="" disabled placeholder="0.00"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Remaining Amount</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-usd"> </span>
                                                                    </span>
                                                                    <input type="text" name="custrmnamt" id="custrmnamt" class="form-control" value="" disabled placeholder="0.00">
                                                                    <input type="hidden" name="hpaymentId" id="hpaymentId" class="hpaymentId" class="form-control">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="table-responsive">
                                            <table class="table table-hover no-margin">
                                                <thead>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>
                                                            <input type="text" name="txtcustname" id="txtcustname" class="form-control" value="" placeholder="Name" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td><input type="text" name="txtcustaddress" id="txtcustaddress" class="form-control" value="" placeholder="Address" disabled></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Type</td>
                                                        <td><input type="text" name="txtcustdesc" id="txtcustdesc" class="form-control" value="" placeholder="Description" disabled></td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="mybtns">
                                            <a id="invclose" class="btn btn-xs btn-primary disabled">Finished</a>
                                            <a id="invrmall" class="btn btn-xs btn-danger ">Remove All</a>disabled
                                            <a id="invautoapply" class="btn btn-xs btn-primary">Auto Apply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-primary mt20">
                                    <p class="uhead2 pt10">Payment Applied To 1</p>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover no-margin applied fixed_table" id="invoiceTable">
                                                <input type="hidden" name="type_payment" value="">
                                                <input type="hidden" name="type_payment_no" value="">
                                                <thead>
                                                    <tr>
                                                        <th class="w60">Invoice</th>
                                                        <th class="w60">Remove</th>
                                                        <th class="w70">Applied</th>
                                                        <th class=""><span style="min-width: 250px">Event</span></th>
                                                        <th class="w80">Due Date</th>
                                                        <th class="w70">Amount</th>
                                                        <th class="w60">Paid</th>
                                                        <th class="w75">Balance Due</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="applypaymentinv">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="box box-primary mt20">
                                    <p class="uhead2 pt10">Apply Payment To</p>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover no-margin apply fixed_table">
                                                <thead>
                                                    <tr class="tr_clone">
                                                        <th class="w60">Invoice</th>
                                                        <th class="w60">Click</th>
                                                        <th class="w70">Apply</th>
                                                        <th class="w70">Amount</th>
                                                        <th>Event</th>
                                                        <th class="w80">Due Date</th>
                                                        <!--  <th>Amount</th> -->
                                                        <th class="w60">Paid</th>
                                                        <th class="w75">Balance Due</th>
                                                    </tr>

                                                </thead>
                                                <tbody id="inv_table">
                                                    <?php if ($usrInvoices != "") {
                                                        foreach ($usrInvoices as $key) { ?>
                                                            <tr class="tr_clone">
                                                                <td><?= $invoice_id ?>
                                                                    <input type="hidden" type="hidden" class="my_in2" value="<?= $invoice_id ?>">
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-xs btn-primary apply_btn disabled"> Applyy</a>
                                                                </td>
                                                                <td>

                                                                </td>

                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-usd"></span>
                                                                            </span>
                                                                            <input type="text" name="invoice_payment[]" class="form-control" value="<?= sprintf('%0.2f', $key['invoice_amount']) ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <select class="form-control">
                                                                        <option value="val">Will Smith Wedding 1/24/18 6:30 PM</option>
                                                                    </select>

                                                                </td>
                                                                <td><input type="text" name="invoice_payment[]" class="form-control" value="<?= $key['invoice_due_date'] ?>" readonly></td>

                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-usd"></span>
                                                                            </span>
                                                                            <input type="text" name="invoice_payment[]" class="form-control" value="<?= sprintf('%.02f', $key['invoice_paid']) ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-usd">
                                                                                </span>
                                                                            </span>
                                                                            <input type="text" name="invoice_payment[]" class="form-control" value="<?= sprintf($key['invoice_balance_due']) ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php  }
                                                    } else { ?>
                                                        <tr>
                                                            <td> No invoices found. </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="col-md-12 text-center">
            <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
            <a href="<?= base_url() ?>attachment" class="btn btn-lg btn-info btn-flat">Save & Continue</a>
          
        </div>
    </div>
   
    <div class="modal fade payment_modal" id="payment_modal_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close1" style="float:right;" id="close_model2" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <h4 class="modal-title" id="myModalLabel">Apply Payment</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table table-hover no-margin" style="border: 1px solid #bbbbbb;">
                                        <thead>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td>
                                                    <div class="form-group" style="text-align: -webkit-right;">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="$0.00" id="custpayamtSec1" disabled style="text-align: -webkit-right;">
                                                        
                                                            <input type="hidden" name="custpayamt" value="" id="custpayamtSec" disabled placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Applied Amount</td>
                                                <td>
                                                    <div class="form-group" style="text-align: -webkit-right;">
                                                        <div class="input-group">
                                                            <input type="text" id="custappamtSec1" class="form-control" value="$0.00" disabled style="text-align: -webkit-right;">
                                                         

                                                            <input type="hidden" name="custappamt" id="custappamtSec" class="form-control" value="" disabled placeholder="0.00">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Remaining Amount</td>
                                                <td>
                                                    <div class="form-group" style="text-align: -webkit-right;">
                                                        <div class="input-group">
                                                     
                                                            <input type="text" id="custrmnamtSec1" class="form-control" value="$0.00" disabled style="text-align: -webkit-right;">
                                                            <input type="hidden" name="custrmnamt" id="custrmnamtSec" class="form-control" value="" disabled placeholder="0.00">
                                                            <input type="hidden" name="hpaymentId" id="hpaymentId" class="hpaymentId" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table table-hover no-margin" style="border: 1px solid #bbbbbb;">
                                        <thead>
                                            <tr>
                                                <td>Name</td>
                                                <td>
                                                    <input type="text" name="txtcustname" id="txtcustnameSec" class="form-control" value="" placeholder="Name" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td><input type="text" name="txtcustaddress" id="txtcustaddressSec" class="form-control" value="" placeholder="Address" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td><input type="text" name="txtcustdesc" id="txtcustdescSec" class="form-control" value="" placeholder="Description" disabled></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="mybtns" style="margin: 5px 0px 10px 0px;">
                                    <a id="invcloseSec" class="btn btn-xs btn-primary ">Finished</a>
                                    <a id="invrmallSec" class="btn btn-xs btn-danger">Remove All</a>
                                    <!-- <a id="invautoapplySec" class="btn btn-xs btn-primary">Auto Apply</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary mt20">
                            <p class="uhead2 pt10">Payment Applied To</p>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover no-margin applied" id="invoiceTable">
                                        <input type="hidden" name="type_payment" value="">
                                        <input type="hidden" name="type_payment_no" value="">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>Remove</th>
                                                <th class="w70">Applied</th>
                                                <th class="w230">Event</th>
                                                <th class="w100">Due Date</th>
                                                <th class="w100">Amount</th>
                                                <th class="w100">Paid</th>
                                                <th class="w100">Balance Due</th>
                                            </tr>
                                        </thead>
                                        <tbody id="applypaymentinvSec"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary mt20">
                            <p class="uhead2 pt10">Apply Payment To</p>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover no-margin apply">
                                        <thead>
                                            <tr class="tr_clone">
                                                <th style="width: 10%;">Invoice</th>
                                                <th>Click</th>
                                                <th style="width: 8%;">Apply</th>
                                                <!-- <th style="width: 12%;">Amount</th> -->
                                                <th style="width: 30%;">Event</th>
                                                <th>Due Date</th>
                                                <!--  <th>Amount</th> -->
                                                <th>Paid</th>
                                                <th>Balance Due</th>
                                            </tr>
                                        </thead>

                                        <tbody id="inv_tableSec"><?php
                                                                    if ($usrInvoices != "") {
                                                                        foreach ($usrInvoices as $key) { ?>
                                                    <tr class="tr_clone">
                                                        <td><?= $invoice_id ?>
                                                            <input type="hidden" type="hidden" class="my_in" value="<?= $invoice_id ?>">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-xs btn-primary apply_btn disabled "> Apply</a>
                                                        </td>
                                                        <td>
                                                        </td>

                                                        <!-- <td>
                                              <div class="form-group">
                                                <div class="input-group">
                                                  <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-usd">
                                                    </span>
                                                  </span>
                                                  <input type="text" name="invoice_payment[]" class="form-control" value="<?= sprintf('%0.2f', $key['invoice_amount']) ?>" readonly>
                                                </div>
                                              </div>
                                            </td> -->

                                                        <td>
                                                            <select class="form-control">
                                                                <option value="val">Will Smith Wedding 1/24/18 6:30 PM</option>
                                                            </select>

                                                        </td>
                                                        <td><input type="text" name="invoice_payment[]" class="form-control" value="<?= $key['invoice_due_date'] ?>" readonly></td>

                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-usd">
                                                                        </span>
                                                                    </span>
                                                                    <input type="text" name="invoice_payment[]" class="form-control" value="<?= sprintf('%.02f', $key['invoice_paid']) ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-usd">
                                                                        </span>
                                                                    </span>
                                                                    <input type="text" name="invoice_payment[]" class="form-control" value="<?= sprintf($key['invoice_balance_due']) ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php  }
                                                                    } else { ?>
                                                <tr>
                                                    <td> No invoices found. </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <div class="fadeMe">
        <div id="loader" class="loader"></div>
    </div>
    <script src="<?php echo base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        function fndelpayment(payId) {
            event.preventDefault();
            var r = confirm("Do you want delete this payment..?");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/fndeletepaymnt') ?>",
                    data: {
                        payId: payId
                    },
                    dataType: 'text',

                    beforeSend: function() {
                        $('.fadeMe').show();
                    },

                    success: function(data) {
                        if (data == "success") {
                            //window.location.reload();
                            fnloadpaymentview();
                            $('.fadeMe').hide();
                        } else if (data == "error") {
                            $('.fadeMe').hide();
                        }
                    }
                });
            }
            name = localStorage.getItem("pckId");
            //alert(name);
            //alert(2);
            upperinvinfo(name);
        }

        $(document).ready(function() {
            $('body').on('blur', '.lstpamt', function() {
                var name = localStorage.getItem("pckId");
                var lstpaytype = $(this).parents('.tr_clone').find('.lstpaytype').val();
                var lsttxtpdate = $(this).parents('.tr_clone').find('.lsttxtpdate').val();
                var chkno = "";
                var amt = parseFloat($(this).parents('.tr_clone').find('.lstpamt').val());
                var descp = $(this).parents('.tr_clone').find('.lstpdesc').val();
                var txtreceipt = $(this).parents('.tr_clone').find('.lsttxtreceipt').val();
                var lsttxtnotes = $(this).parents('.tr_clone').find('.lsttxtnotes').val();

                if (lstpaytype == "Check") {
                    chkno = $(this).parents('.tr_clone').find('.txtchkno').val();
                }

                if (name == null || name == "" || name == 'N' || name == 'null') {
                    alert("Please select customer..!");
                    window.location.href = "<?= site_url('PaymentsCont/c_payment') ?>"
                } else {
                    if (lstpaytype == "Credit") {
                        alert(name + " : " + lstpaytype + " : " + lsttxtpdate + " : " + amt + " : " + descp);

                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('PaymentsCont/fnnewpaymnt') ?>",
                            data: {
                                name: name,
                                lstpaytype: lstpaytype,
                                lsttxtpdate: lsttxtpdate,
                                chkno: chkno,
                                amt: amt,
                                descp: descp,
                                txtreceipt: txtreceipt,
                                lsttxtnotes: lsttxtnotes
                            },
                            dataType: 'text',

                            beforeSend: function() {
                                /*setting a timeout*/
                                $('.fadeMe').show();
                            },

                            success: function(data) {
                                if (data == "success") {
                                    fnloadpaymentview();
                                    $('.fadeMe').hide();
                                } else if (data == "error") {
                                    $('.fadeMe').hide();
                                }
                            }
                        });
                    } else {
                        if (amt > 0) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url('PaymentsCont/fnnewpaymnt') ?>",
                                data: {
                                    name: name,
                                    lstpaytype: lstpaytype,
                                    lsttxtpdate: lsttxtpdate,
                                    chkno: chkno,
                                    amt: amt,
                                    descp: descp,
                                    txtreceipt: txtreceipt,
                                    lsttxtnotes: lsttxtnotes
                                },
                                dataType: 'text',
                                beforeSend: function() {
                                    // setting a timeout
                                    $('.fadeMe').show();
                                },
                                success: function(data) {
                                    if (data == "success") {
                                        fnloadpaymentview();
                                        $('.fadeMe').hide();
                                    } else if (data == "error") {
                                        $('.fadeMe').hide();
                                    }
                                }
                            });
                        } else {
                            alert("Amount should be greater than zero");
                        }
                    }
                }

                upperinvinfo(name);
            });
        });

        $(document).ready(function() {
            upperinvinfo(<?= $cus_id ?>);
        });

        $(document).ready(function() {
            fnloadpaymentview();
        });

        /*Initial Load a table or or after some changes like*/
        function fnloadpaymentview() {
            var cusid = localStorage.getItem('pckId');
            if (cusid != "") {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/fnloadpaymentdata') ?>",
                    data: {
                        cusid: cusid
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data != "") {
                            $('.allpayments-history').html(data);
                            var cur_type = $('.allpayments-history tr:nth-last-child(2)').find("#paytype").val();
                            if (cur_type == "Check") {
                                $('.allpayments-history tr:nth-last-child(2)').find("#txtchkno").focus();
                            } else if (cur_type == "") {
                                $('.allpayments-history tr:nth-last-child(2)').find("#txtreceipt").focus();
                            } else {
                                $('.allpayments-history tr:nth-last-child(2)').find("#amt1").focus();
                            }

                            $('.fadeMe').hide();
                        } else {
                            $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        }

                        var popup_me = $('.popup_me').val();

                        if (popup_me != undefined) {
                            //$(".payboxSec"+popup_me).trigger("click");           
                        }
                    }
                });
            }
        }

        function cust_payment() {
            var value = $('.cust_payment').val();
            var cust_id = $('.cust_payment [value="' + value + '"]').data('value');
            localStorage.setItem("customer_name", value);
            fngetcreditamt(cust_id);
            var cu_name = localStorage.getItem("customer_name");
            $('.cust_payment').val(cu_name);
        }

        function fngetcreditamt(custId) {
            if (custId != "") {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('PaymentsCont/fnGetcreditamtInfo') ?>',
                    data: {
                        custId: custId
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('.fadeMe').show();
                        var pckId = custId;
                        localStorage.setItem("pckId", pckId);
                        var pckId = localStorage.getItem("pckId");
                    },
                    success: function(data) {
                        if (data != "") {
                            var appendata = data.creditamtjson;
                            //var credamnt = appendata.credit_amount;
                            // var setcrdtamt= credamnt.toFixed(2);
                            $('#creditamt').val(appendata.credit_amount);
                            $('.fadeMe').hide();
                            $('#names1 option[value="' + custId + '"]').attr("selected", "selected");

                            upperinvinfo(custId);
                        } else {
                            $('.fadeMe').hide();
                            $('#creditamt').val("");
                            $('#names1 option[value="' + custId + '"]').attr("selected", "selected");
                        }
                    },
                    error: function(xhr) { // if error occured
                        // $('.fadeMe').hide();
                    },
                    complete: function() {
                        // $('.fadeMe').hide();
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/fnloadpaymentdata') ?>",
                    data: {
                        cusid: custId
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data != "") {
                            $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        } else {
                            $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        }
                    }
                });
            }
        }

        function upperinvinfo(name) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                beforeSend: function() {

                },
                success: function(data) {

                    if (data != "") {
                        $('.loaduppertabcntdtls').html(data);
                    } else {
                        $('.loaduppertabcntdtls').html(data);
                    }
                }
            });
        }

        $(document).ready(function() {
            $('body').on('click', '.paybox', function() {
                var name = localStorage.getItem("pckId");
                // var name = $('#names1 option:selected').val();
                var custmname = $('#names1 option:selected').text();
                var lstpaytype = $(this).parents('.tr_clone').find('.paytype').val();
                var lsttxtpdate = $(this).parents('.tr_clone').find('.txtpdate').val();
                var creditamt = $(this).parents('.tr_clone').find('.creditamt').val();
                var pamt = $(this).parents('.tr_clone').find('.pamt').val();
                var hdnpayId = $(this).parents('.tr_clone').find('.hdnpayId').val();
                var type_payment = $('#type_payment').val();
                // var type_payment_no = $('#type_payment_no').val();
                // custappamt  custrmnamt  txtcustdesc
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('PaymentsCont/getCustomerInfo'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'html',

                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                        $('#txtcustname').val('');
                        $('#custpayamt').val('');
                        $('#custrmnamt').val('');
                        // $('#txtcustdesc').val('');
                        $('#hpaymentId').val('');
                    },
                    success: function(data) {
                        if (data != "") {
                            $('#inv_table').html(data);
                            $('.fadeMe').hide(); //Number(creditamt) +
                            var totcustpay = Number(pamt);
                            $('#custpayamt').val(totcustpay.toFixed(2));
                            $('#custrmnamt').val(totcustpay.toFixed(2));
                            $('#txtcustname').val($.trim(custmname));
                            $('#txtcustdesc').val($.trim(lstpaytype));
                            $('#hpaymentId').val(hdnpayId);
                            fninovicepayhistory(hdnpayId);
                        } else {
                            //$('#inv_table').html("No Invoices Available..!");
                            //Number(creditamt)+
                            var totcustpay = Number(pamt);
                            //alert("totcustpay--"+totcustpay);
                            $('#custpayamt').val(totcustpay.toFixed(2));
                            $('#custrmnamt').val(totcustpay.toFixed(2));
                            $('.fadeMe').hide();
                            $('#txtcustname').val($.trim(custmname));
                            $('#txtcustdesc').val($.trim(lstpaytype));
                            $('#hpaymentId').val(hdnpayId);
                            //var invId= $('.invce-id').val();
                            fninovicepayhistory(hdnpayId);
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('PaymentsCont/getCustomeraddress'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout

                    },
                    success: function(data) {
                        // alert(data);
                        if (data != "0") {
                            $('#txtcustaddress').val($.trim(data));
                            //$('#txtcustname').val($.trim(custmname));
                        } else {
                            $('#txtcustaddress').val('');
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('PaymentsCont/getCustomerlname'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout

                    },
                    success: function(data) {
                        // alert(data);
                        if (data != "0") {
                            $('#txtcustname').val($.trim(data));
                            //$('#txtcustname').val($.trim(custmname));
                        } else {
                            $('#txtcustaddress').val('');
                        }
                    },
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '.payboxSec', function() {
                var name = localStorage.getItem("pckId");
                var custmname = $('#names1 option:selected').text();
                var lstpaytype = $(this).parents('.tr_clone').find('.paytype').val();
                var lsttxtpdate = $(this).parents('.tr_clone').find('.txtpdate').val();
                var creditamt = $(this).parents('.tr_clone').find('.creditamt').val();
                var pamt = $(this).parents('.tr_clone').find('.pamt').val();
                var hdnpayId = $(this).parents('.tr_clone').find('.hdnpayId').val();
                var type_payment = $('#type_payment').val();

                if (name == '') {
                    name = '<?= $cus_id ?>';
                } else if (name == 'undefined') {
                    name = '<?= $cus_id ?>';
                }

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('PaymentsCont/getCustomerInfoSec'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('.fadeMe').show();
                        console.log("s1");
                        $('#txtcustnameSec').val('');
                        $('#custpayamtSec').val('');
                        $('#custpayamtSec1').val("$0.00");
                        $('#custrmnamtSec').val('');
                        $('#custrmnamtSec1').val("$0.00");
                        $('#hpaymentId').val('');
                    },
                    success: function(data) {
                        if (data != "") {
                            $('#inv_tableSec').html(data);
                            $('.fadeMe').hide();
                            var totcustpay = Number(pamt) + Number(creditamt);
                            $('#custpayamtSec').val(totcustpay.toFixed(2));
                            $('#custpayamtSec1').val("$" + totcustpay.toFixed(2));
                            $('#custrmnamtSec').val(Number(pamt).toFixed(2));
                            console.log("s2");
                            $('#custrmnamtSec1').val("$" + Number(pamt).toFixed(2));

                            $('#custappamtSec').val(Number(creditamt).toFixed(2));
                            $('#custappamtSec1').val("$" + Number(creditamt).toFixed(2));
                            $('#txtcustdescSec').val($.trim(lstpaytype));
                            $('#hpaymentId').val(hdnpayId);
                            fninovicepayhistorySec(hdnpayId);
                        } else {
                            var totcustpay = Number(pamt) + Number(creditamt);
                            $('#custpayamtSec').val(totcustpay.toFixed(2));
                            $('#custpayamtSec1').val("$" + totcustpay.toFixed(2));
                            $('#custrmnamtSec').val(pamt.toFixed(2));
                            console.log("s3");
                            $('#custrmnamtSec1').val("$" + pamt.toFixed(2));
                            $('#custappamtSec').val(creditamt.toFixed(2));
                            $('#custappamtSec1').val("$" + creditamt.toFixed(2));
                            $('.fadeMe').hide();
                            txtcustnameSec
                            $('#txtcustdescSec').val($.trim(lstpaytype));
                            $('#hpaymentId').val(hdnpayId);
                            fninovicepayhistorySec(hdnpayId);
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('PaymentsCont/getCustomeraddress'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                    },
                    success: function(data) {
                        // alert(data);
                        if (data != "0") {
                            $('#txtcustaddressSec').val($.trim(data));
                            //$('#txtcustname').val($.trim(custmname));
                        } else {
                            $('#txtcustaddressSec').val('');
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('PaymentsCont/getCustomerlname'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                    },
                    success: function(data) {
                        if (data != "0") {
                            $('#txtcustnameSec').val($.trim(data));
                            //$('#txtcustname').val($.trim(custmname));
                        } else {
                            $('#txtcustnameSec').val('');
                        }
                    },
                });
            });
        });
    </script>

    <script type="text/javascript">
        function fninovicepayhistory(hpaymentId) {


            $.ajax({
                type: "POST",
                url: "<?php echo base_url('PaymentsCont/getpaidinvoicesInfo'); ?>",
                data: {
                    hpaymentId: hpaymentId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                },
                success: function(data) {



                    $('#applypaymentinv').html('');
                    if (data != "") {
                        $('#applypaymentinv').html(data);

                        // $('#invclose').attr('onclick', 'fncloseinvoces("'+invId+'")');
                        // $('#invrmall').attr('onclick', 'fnremoveallinv("'+invId+'")');
                        $('.fadeMe').hide();

                    } else {
                        //$('#applypaymentinv').html("No Invoices Available..!");
                        $('.fadeMe').hide();


                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        function fninovicepayhistorySec(hpaymentId) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('PaymentsCont/getpaidinvoicesInfoSec'); ?>",
                data: {
                    hpaymentId: hpaymentId
                },
                dataType: 'html',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    $('#applypaymentinvSec').html('');
                    if (data != "") {
                        $('#applypaymentinvSec').html(data);
                        $('.fadeMe').hide();
                    } else {
                        $('.fadeMe').hide();
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        // function fnupdateinvosts(invId)
        $(document).ready(function() {
            $('body').on('click', '.apply_btn', function() {
                var paid = $("#custappamt").val();
                if (paid == "") {
                    paid = 0;
                }

                var paid_amount = $('#custpayamt').val();
                var rem_amt = $('#custrmnamt').val();

                var paid_amount = $('#custpayamt').val();

                var balance_amt = $(this).parents('.tr_clone').find('.balance_amt').val();
                var paid_last_val = $(this).parents('.tr_clone').find('.invoice_paid_amt').val();
                // alert("balance_amt :"+balance_amt); custrmnamt
                var fld = $(this).parents('.tr_clone').find('.balance_amt');
                var flo = $(this).parents('.tr_clone').find('.invoice_paid_amt');

                var custpayamt = $('#custpayamt').val(); //custpay.toFixed(0);

                var hpaymentId = $('#hpaymentId').val();
                var invId = $(this).parents('.tr_clone').find('.invce-id').html();
                var cus_Id = localStorage.getItem("pckId");
                // var cus_Id= $('#names1 option:selected').val();

                var invapplyamt = $('#invapplyamt' + invId).val();

                var custpayamt = parseFloat(invapplyamt);
                // alert("pay_amt :"+custpayamt);
                var last_amt = parseFloat(paid_last_val);
                event.preventDefault();

                // alert(parseFloat(balance_amt));
                if (parseFloat(balance_amt) != 0) {


                    if (rem_amt != 0) {
                        // if (custpayamt ) {
                        //
                        // }

                        var cusnan = isNaN(custpayamt);
                        if (isNaN(custpayamt)) {
                            // alert("tt");
                            custpayamt = rem_amt;
                        }
                        // alert("pay_amt :"+custpayamt);
                        // alert("bal_amt :"+balance_amt);
                        // if (parseFloat(balance_amt) >= custpayamt) {

                        if (invapplyamt == "") {
                            if (parseFloat(rem_amt) > parseFloat(balance_amt)) {
                                custpayamt = parseFloat(balance_amt);
                                // alert("amt_greater :"+custpayamt);
                            } else {
                                custpayamt = parseFloat(rem_amt);
                                // alert("amt_less :"+custpayamt);
                            }
                        }

                        $.ajax({
                            type: 'POST',
                            url: '<?= site_url('PaymentsCont/fnappyinvoice') ?>',
                            data: {
                                invId: invId,
                                custpayamt: custpayamt,
                                hpaymentId: hpaymentId,
                                cus_Id: cus_Id
                            },
                            dataType: 'html',
                            beforeSend: function() {
                                // setting a timeout
                                $('.fadeMe').show();
                                // alert("invId--"+invId+" custpayamt--"+custpayamt+" hpaymentId--"+hpaymentId+"cus_Id--"+cus_Id);
                            },
                            success: function(data) {

                                // alert("data--"+data);

                                if (data != "") {
                                    $('.fadeMe').hide();

                                    $('#invapplyamt' + invId).val('');
                                    // $('.apply_btn').addClass("disabled");
                                    $('#invclose').removeClass("disabled");
                                    $('#invrmall').removeClass("disabled");
                                    // $('#invautoapply').addClass("disabled");
                                    $('#applypaymentinv').html(data);
                                    fld.val(parseFloat(parseFloat(balance_amt) - parseFloat(custpayamt)).toFixed(2));
                                    flo.val(parseFloat(parseFloat(last_amt) + parseFloat(custpayamt)).toFixed(2));

                                    var baldueamt = $('#baldue').val();
                                    var appmnet = $('#appmnet').val();
                                    var balramins = $('#balramins').val();

                                    //alert("balramins--"+balramins);

                                    if (balramins == 0) {
                                        // alert("0"); balance_amt
                                        // custrmnamt
                                        //$('#custappamt').val(appmnet);
                                        $('#custappamt').val(parseFloat(parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                        $('#custrmnamt').val(parseFloat(parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                    } else if (balramins > 0) {


                                        if (parseInt(custpayamt) > parseInt(balramins)) { //alert("custpayamt > balramins");
                                            // alert("1");
                                            //$('#custappamt').val(custpayamt-balramins);
                                            $('#custappamt').val(parseFloat(parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                            $('#custrmnamt').val(parseFloat(parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                        } else { //alert("custpayamt < balramins");
                                            // alert("0");
                                            //$('#custappamt').val(appmnet);
                                            $('#custappamt').val(parseFloat(parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                            $('#custrmnamt').val(parseFloat(parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                        }

                                    } else {
                                        // alert("2");
                                        // $('#custappamt').val(custpayamt);
                                        $('#custappamt').val(parseFloat(parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                        $('#custrmnamt').val(parseFloat(parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                    }

                                    //getpaymentinfo();

                                    $('#invclose').attr('onclick', 'fncloseinvoces("' + invId + '")');
                                    $('#invrmall').attr('onclick', 'fnremoveallinv("' + invId + '")');

                                } else {
                                    // alert("3");
                                    $('#applypaymentinv').html("<tr><td colspan='8'> No Applied Invoices Available..!</td></tr>");
                                    $('.fadeMe').hide();
                                    $('#custappamt').val("");
                                    $('#invclose').removeAttr('onclick');
                                    $('#invrmall').removeAttr('onclick');

                                }


                            },
                            error: function(xhr) { // if error occured
                                // $('.fadeMe').hide();
                            },
                            complete: function() {
                                // $('.fadeMe').hide();
                            }

                        });
                        // }else{
                        //   alert('Enter amount is greater than Balance amount.');
                        // }
                    } else {
                        alert('You dont have Remaining amount');
                    }
                } else {
                    alert('Balance Amount is zero.');
                }

            });
        });
    </script>

    <script type="text/javascript">
        // function fnupdateinvosts(invId)
        $(document).ready(function() {
            $('body').on('click', '.apply_btn_sec', function() {
                $('.apply_btn_sec').addClass("disabled");

                var paid = $("#custappamtSec").val();
                if (paid == "") {
                    paid = 0;
                }

                var paid_amount = $('#custpayamtSec').val();
                var rem_amt = $('#custrmnamtSec').val();
                var balance_amt = $(this).parents('.tr_clone').find('.balance_amtSec').val();
                var paid_last_val = $(this).parents('.tr_clone').find('.invoice_paid_amtSec').val();
                var fld = $(this).parents('.tr_clone').find('.balance_amtSec');
                var flo = $(this).parents('.tr_clone').find('.invoice_paid_amtSec');
                var custpayamt = $('#custpayamtSec').val(); //custpay.toFixed(0);
                var hpaymentId = $('#hpaymentId').val();
                var invId = $(this).parents('.tr_clone').find('.invce-id_Sec').html();
                var cus_Id = localStorage.getItem("pckId");
                // var cus_Id= $('#names1 option:selected').val();
                var invapplyamt = $('#invapplyamtSec' + invId).val();
                var custpayamt = parseFloat(invapplyamt);
                var last_amt = parseFloat(paid_last_val);
                event.preventDefault();

                if (parseFloat(invapplyamt) > parseFloat(balance_amt)) {
                    alert('amount is should not greater than balance amount.');
                } else {
                    if (rem_amt != 0) {
                        if (invapplyamt == "") {
                            if (parseFloat(rem_amt) > parseFloat(balance_amt)) {
                                custpayamt = parseFloat(balance_amt);
                            } else {
                                custpayamt = parseFloat(rem_amt);
                            }
                        }
                        $.ajax({
                            type: 'POST',
                            url: '<?= site_url('PaymentsCont/fnappyinvoiceSec') ?>',
                            data: {
                                invId: invId,
                                custpayamt: custpayamt,
                                hpaymentId: hpaymentId,
                                cus_Id: cus_Id
                            },
                            dataType: 'html',
                            beforeSend: function() {
                                // setting a timeout
                                $('.fadeMe').show();
                            },
                            success: function(data) {
                                $('.apply_btn_sec').removeClass("disabled");

                                if (data != "") {
                                    $('.fadeMe').hide();
                                    $('#invapplyamtSec' + invId).val('');
                                    $('#invcloseSec').removeClass("disabled");
                                    $('#invrmallSec').removeClass("disabled");
                                    $('#applypaymentinvSec').html(data);

                                    fld.val(parseFloat(parseFloat(balance_amt) - parseFloat(custpayamt)).toFixed(2));
                                    flo.val(parseFloat(parseFloat(last_amt) + parseFloat(custpayamt)).toFixed(2));

                                    $('.balance_amtSec' + invId).val("$" + parseFloat(parseFloat(balance_amt) - parseFloat(custpayamt)).toFixed(2));
                                    $('.invoice_paid_amtSec' + invId).val("$" + parseFloat(parseFloat(last_amt) + parseFloat(custpayamt)).toFixed(2));

                                    var baldueamt = $('#baldue_Sec').val();
                                    var appmnet = $('#appmnet_Sec').val();
                                    var balramins = $('#balramins').val();

                                    if (balramins == 0) {
                                        $('#custappamtSec').val(parseFloat(paid) + parseFloat(custpayamt));
                                        $('#custappamtSec1').val("$" + parseFloat(paid) + parseFloat(custpayamt));
                                        $('#custrmnamtSec').val(parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt)));
                                        console.log("s4");
                                        $('#custrmnamtSec1').val("$" + parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt)));
                                    } else if (balramins > 0) {
                                        if (parseInt(custpayamt) > parseInt(balramins)) {
                                            $('#custappamtSec').val((parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                            $('#custappamtSec1').val("$" + (parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                            $('#custrmnamtSec').val((parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                            console.log("s5");
                                            $('#custrmnamtSec1').val("$" + (parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                        } else {
                                            $('#custappamtSec').val((parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                            $('#custappamtSec1').val("$" + (parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                            $('#custrmnamtSec').val((parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                            console.log("s6");
                                            $('#custrmnamtSec1').val("$" + (parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                        }
                                    } else {
                                        $('#custappamtSec').val((parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                        $('#custappamtSec1').val("$" + (parseFloat(paid) + parseFloat(custpayamt)).toFixed(2));
                                        $('#custrmnamtSec').val((parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                        console.log("s7");
                                        $('#custrmnamtSec1').val("$" + (parseFloat(paid_amount) - (parseFloat(paid) + parseFloat(custpayamt))).toFixed(2));
                                    }


                                    //getpaymentinfo();
                                    $('#invclose').attr('onclick', 'fncloseinvoces("' + invId + '")');
                                    $('#invrmall').attr('onclick', 'fnremoveallinv("' + invId + '")');
                                } else {
                                    // alert("3");
                                    $('#applypaymentinvSec').html("<tr><td colspan='8'>No Applied Invoices Available..!</td></tr>");
                                    $('.fadeMe').hide();
                                    $('#custappamt').val("");
                                    $('#invclose').removeAttr('onclick');
                                    $('#invrmall').removeAttr('onclick');

                                }
                            },
                            error: function(xhr) { // if error occured
                                // $('.fadeMe').hide();
                            },
                            complete: function() {
                                // $('.fadeMe').hide();
                            }
                        });
                        // }else{
                        //   alert('Enter amount is greater than remaning amount.');
                        // }
                    } else {
                        alert('You dont have Remaining amount');
                    }
                }

            });
        });
    </script>


    <script type="text/javascript">
        function fnremovependinv(invId, appliedamt, main_invId, invpayment_id) {

            var custpayamt = $('#custpayamt').val();
            var cur_amt = "";
            var bal_amt = "";

            $(".modal table.apply tr").each(function() {
                var tempID = $(this).find(".invce-id").html();
                if (tempID == main_invId) {
                    cur_amt = $(this).find(".invoice_paid_amt").val();
                    $(this).find(".invoice_paid_amt").val(parseFloat(parseFloat(cur_amt) - parseFloat(appliedamt)).toFixed(2));
                    bal_amt = $(this).find(".balance_amt").val();
                    $(this).find(".balance_amt").val(parseFloat(parseFloat(bal_amt) + parseFloat(appliedamt)).toFixed(2));
                }
            });

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('PaymentsCont/fnremoveinvoice') ?>',
                data: {
                    invId: invId,
                    custpayamt: custpayamt,
                    appliedamt: appliedamt,
                    main_invId: main_invId
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                    //alert("invId--"+invId);
                },
                success: function(data) {

                    // alert("data--"+data);

                    if (data == "success") {
                        $('.fadeMe').hide();
                        // getpaymentinfo();
                        getappliedinvinfo(main_invId, invpayment_id);

                        //alert("Removed Invoice Successfully..!");
                        // alert(appliedamt);
                        $('#custappamt').val((parseFloat($('#custappamt').val()) - parseFloat(appliedamt)).toFixed(2));
                        $('#custrmnamt').val((parseFloat($('#custrmnamt').val()) + parseFloat(appliedamt)).toFixed(2));
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
    </script>

    <script type="text/javascript">
        function fnremovependinv_sec(invId, appliedamt, main_invId, invpayment_id) {
            var myremain = parseFloat($('#custrmnamtSec').val()).toFixed(2);
            var custpayamt = $('#custpayamtSec').val();
            var cur_amt = "";
            var bal_amt = "";
            $(".modal table.apply tr").each(function() {
                var tempID = $(this).find(".invce-id_Sec").html();
                if (tempID == main_invId) {
                    //console.log(invId);
                    cur_amt = $(this).find(".invoice_paid_amtSec").val();
                    $(this).find(".invoice_paid_amtSec").val(parseFloat(parseFloat(cur_amt) - parseFloat(appliedamt)).toFixed(2));
                    $(this).find(".invoice_paid_amtSec1").val(parseFloat(parseFloat(cur_amt) - parseFloat(appliedamt)).toFixed(2));
                    bal_amt = $(this).find(".balance_amtSec").val();
                    $(this).find(".balance_amtSec").val(parseFloat(parseFloat(bal_amt) + parseFloat(appliedamt)).toFixed(2));
                    $(this).find(".balance_amtSec1").val(parseFloat(parseFloat(bal_amt) + parseFloat(appliedamt)).toFixed(2));
                }
            });
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('PaymentsCont/fnremoveinvoiceSec') ?>',
                data: {
                    invId: invId,
                    custpayamt: custpayamt,
                    appliedamt: appliedamt,
                    main_invId: main_invId,
                    invpayment_id: invpayment_id
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data == "success") {
                        $('.fadeMe').hide();
                        // getpaymentinfo();
                        //alert("Removed Invoice Successfully..!");                                 

                        $('#custappamtSec').val((parseFloat($('#custappamtSec').val()) - parseFloat(appliedamt)).toFixed(2));

                        if ((parseFloat($('#custappamtSec').val()) - parseFloat(appliedamt)).toFixed(2) < 0) {
                            var datamy = 0;
                        } else {
                            var datamy = (parseFloat($('#custappamtSec').val()) - parseFloat(appliedamt)).toFixed(2);
                        }
                        $('#custappamtSec1').val("$" + datamy);
                        $('#custrmnamtSec').val((parseFloat($('#custrmnamtSec').val()) + parseFloat(appliedamt)).toFixed(2));
                        appliedamt = parseFloat(appliedamt).toFixed(2);

                        var tot = parseFloat(appliedamt) + parseFloat(myremain);
                        console.log("s8");
                        $('#custrmnamtSec1').val("$" + tot.toFixed(2));
                        getappliedinvinfoSec(main_invId, invpayment_id);
                        fninovicepayhistorySec(invpayment_id);
                    }
                },
            });
        }
    </script>


    <script type="text/javascript">
        function getappliedinvinfo(invId, invpayment_id) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('PaymentsCont/fnappliedinvoice') ?>',
                data: {
                    invId: invId,
                    invpayment_id: invpayment_id
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {



                    if (data != "") {
                        $('.fadeMe').hide();
                        $('#applypaymentinv').html(data);
                        //getpaymentinfo();

                        $('#invclose').attr('onclick', 'fncloseinvoces("' + invId + '")');
                        $('#invrmall').attr('onclick', 'fnremoveallinv("' + invId + '")');


                    } else {
                        $('#applypaymentinv').html("<tr><td colspan='8'>No Applied Invoices Available..!</td></tr>");
                        $('.fadeMe').hide();
                        // $('#custappamt').val("");
                        // $('#custrmnamt').val("");
                        $('#invclose').removeAttr('onclick');
                        $('#invrmall').removeAttr('onclick');
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
    </script>
    <script type="text/javascript">
        function getappliedinvinfoSec(invId, invpayment_id) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?= site_url('PaymentsCont/fnappliedinvoiceSec') ?>',
                data: {
                    invId: invId,
                    invpayment_id: invpayment_id
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data != "") {
                        $('.fadeMe').hide();
                        $('#applypaymentinvSec').html(data);
                        //getpaymentinfo();
                        $('#invclose').attr('onclick', 'fncloseinvoces("' + invId + '")');
                        $('#invrmall').attr('onclick', 'fnremoveallinv("' + invId + '")');
                    } else {
                        $('#applypaymentinv').html("<tr><td colspan='8'>No Applied Invoices Available..!</td></tr>");
                        $('.fadeMe').hide();
                        // $('#custappamt').val("");
                        // $('#custrmnamt').val("");
                        $('#invclose').removeAttr('onclick');
                        $('#invrmall').removeAttr('onclick');
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
    </script>

    <script type="text/javascript">
        function fnremoveallinv(invId) {
            // alert(invId);
            var custpayamt = $('#custpayamt').val();

            $(".modal table.applied #applypaymentinv tr").each(function() {
                var tempID_app = $(this).find(".app_inv_id span").html();
                var app_amt = $(this).find(".app_inv_amt").html();

                $(".modal table.apply tr").each(function() {
                    var tempID = $(this).find(".invce-id").html();
                    if (tempID == tempID_app) {
                        cur_amt = $(this).find(".invoice_paid_amt").val();
                        $(this).find(".invoice_paid_amt").val(parseFloat(parseFloat(cur_amt) - parseFloat(app_amt)).toFixed(2));
                        bal_amt = $(this).find(".balance_amt").val();
                        $(this).find(".balance_amt").val(parseFloat(parseFloat(bal_amt) + parseFloat(app_amt)).toFixed(2));
                    }
                });
            });

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('PaymentsCont/fnremoveallinvoces') ?>',
                data: {
                    invId: invId,
                    custpayamt: custpayamt
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                    // alert("invId--"+invId);
                },
                success: function(data) {

                    //alert("data--"+data);

                    if (data == "success") {
                        $('.fadeMe').hide();
                        // getpaymentinfo();
                        getappliedinvinfo(invId);

                        alert("Removed Invoices Successfully..!");

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
    </script>


    <script type="text/javascript">
        function fncloseinvoces(invId) {

            // $('#myModal').hide();
            // $('.modal-backdrop.in ').hide();
        }

        $(document).ready(function() {
            $('#names1').on('input', function() {
                var value = $(this).val();
                var cust_id = $('#cuspayment [value="' + value + '"]').data('value');
                localStorage.setItem("customer_name", value);
                fngetcreditamt(cust_id);
            });
            var cu_name = localStorage.getItem("customer_name");
            $('#names1').val(cu_name);
        });

        $(document).ready(function() {
            var pckId = localStorage.getItem("pckId");
            if (pckId == null || pckId == "undefined") {
                var custId = $('#names1').val();
                if (custId == undefined) {
                    custId = '<?= $cus_id ?>';
                }
                console.log("fngetcreditamt, 3, " + custId);
                fngetcreditamt(custId);
            } else {
                console.log("fngetcreditamt, 4, <?= $cus_id ?>");
                fngetcreditamt(<?= $cus_id ?>);
            }
        });

        $(document).ready(function() {
            $("#amt1").on("change", function() {
                var name = Number($(this).val()) + Number($('#creditamt').val());
                document.getElementById('custpayamt').value = name.toFixed(2);
            });
        });

        $(document).ready(function(e) {

            $('#myModal').on('show.bs.modal', function(e) {
                var button = e.relatedTarget;
                if ($(button).hasClass('no_modal')) {
                    e.stopPropagation();
                    e.preventDefault();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            update_amounts();
            $('.qty').keyup(function() {
                update_amounts();
            });
        });


        function update_amounts() {
            var sum = 0.0;
            $('#myTable > tbody  > tr').each(function() {
                var qty = $(this).find('.val').val();
                var price = $(this).find('.price').val();
                var amount = (qty * price)
                sum += amount;
                $(this).find('.amount').text('' + amount);
            });
            //just update the total to sum
            $('.total').text(sum);
        }
    </script>

    <script>
        function show1(name, id) {
            var payment_type = name;

            localStorage.setItem("payment_type", payment_type);

            if (name == 'Check') {
                // alert("hi");
                document.getElementById('div1' + id).innerHTML = '<input class="form-control txtchkno" type="text"  onkeyup="numOnly(this)" id="txtchkno" name="txtchkno" placeholder="">';
            } else document.getElementById('div1').innerHTML = '';
        }

        function show(name) {
            var payment_type = name;


            if (name == 'Check') {
                document.getElementById('div1').innerHTML = '<input class="form-control txtchkno" type="text"  onkeyup="numOnly(this)" id="txtchkno" name="txtchkno" placeholder="">';
            } else document.getElementById('div1').innerHTML = '';
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            // alert("Hiii");
            // $('#contact_no').mask('(000) 000-0000');
            //   $('body .contact_no').mask('(000) 000-0000');
            $('body ').on("keypress", ".contact_no", function() {
                $(this).mask('(000) 000-0000');
            });


            $(".str").keypress(function(event) {
                var inputValue = event.which;
                // allow letters and whitespaces only.
                if (!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });

            $(".num").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        });
    </script>

    <script>
        function numOnly(selector) {
            selector.value = selector.value.replace(/[^0-9]/g, '');
        }
    </script>

    <script>
        $(document).ready(function() {
            var payno = "";
            $("body").on("blur", ".txtchkno", function(event) {
                // alert("hii");
                var payno = $(this).val();
                // alert(payno);
                localStorage.setItem("paymentno", payno);

                var hdnpayId = $(this).parents('.tr_clone').find('.hdnpayId').val();
                // alert(hdnpayId);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/updatepaymentdata') ?>",
                    data: {
                        hdnpayId: hdnpayId,
                        payno: payno
                    },
                    dataType: 'html',
                    beforeSend: function() {

                        $('.fadeMe').show();
                        // alert("cusid===="+cusid);
                    },
                    success: function(data) {
                        //alert(data);
                        if (data = "1") {
                            // $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        } else {
                            // $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        }
                    }

                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var payno = "";
            $("body").on("blur", ".pdesc", function(event) {
                // alert("hii");
                var payno = $(this).val();
                // alert(payno);
                // localStorage.setItem("paymentno", payno);

                var hdnpayId = $(this).parents('.tr_clone').find('.hdnpayId').val();
                // alert(hdnpayId);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/updatepaymentdataentry') ?>",
                    data: {
                        hdnpayId: hdnpayId,
                        payno: payno
                    },
                    dataType: 'html',
                    beforeSend: function() {

                        $('.fadeMe').show();
                        // alert("cusid===="+cusid);
                    },
                    success: function(data) {
                        //alert(data);
                        if (data = "1") {
                            // $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        } else {
                            // $('.allpayments-history').html(data);
                            $('.fadeMe').hide();
                        }
                    }

                });

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("body").on("keydown", "#lsttxtpdate, .lsttxtpdate", function(event) {
                var key = event.keyCode;
                var temp_edate = $(this).parents(".tr_clone").find(".lsttxtpdate");

                if (key == "107" || key == "187") {
                    var dtpls;
                    if (temp_edate.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_edate.val());
                    }

                    dtpls.setDate(dtpls.getDate() + 1);
                    var mm = dtpls.getMonth() + 1;
                    if (mm < 10) {
                        mm = "0" + mm;
                    }

                    var dd = dtpls.getDate();
                    if (dd < 10) {
                        dd = "0" + dd;
                    }


                    var yyyy = dtpls.getFullYear();
                    //var today = yyyy + '-' + mm + '-' +  dd;
                    var today = mm + '/' + dd + '/' + yyyy;

                    //$('#edate').val(today);
                    temp_edate.val(today);
                    event.preventDefault();

                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    var dtmns;
                    if (temp_edate.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_edate.val());
                    }

                    dtmns.setDate(dtmns.getDate() - 1);
                    var mm = dtmns.getMonth() + 1;
                    if (mm < 10) {
                        mm = "0" + mm;
                    }

                    var dd = dtmns.getDate();
                    if (dd < 10) {
                        dd = "0" + dd;
                    }

                    var yyyy = dtmns.getFullYear();
                    var today = mm + '/' + dd + '/' + yyyy;

                    temp_edate.val(today);
                    event.preventDefault();

                } else if (key == "68") {

                    today = '<?= date("m/d/Y"); ?>';
                    temp_edate.val(today);
                    event.preventDefault();
                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_edate.val();


                    if (str.length >= 6 && !(str.includes("/"))) {
                        var mm = str.substring(0, 2);
                        var dd = str.substring(2).substring(0, 2);
                        var yy = str.substring(2).substring(2).substring(0, 2);
                        yy = "20" + yy;

                        var month = 12;
                        var day = 31;

                        if (mm == "02") {
                            if (yy % 4 === 0) {
                                day = 29;
                            } else {
                                day = 28;
                            }
                        }

                        if (mm <= month && dd <= day) {

                            var today = mm + '/' + dd + '/' + yy;
                            var today1 = mm + '/' + dd + '/' + yy;

                            temp_edate.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_edate.val("");
                            event.preventDefault();
                        }
                    }
                }

            });

        });
    </script>


    <script>
        $(document).ready(function() {
            $("body").on("keydown", " .txtpdate", function(event) {
                var key = event.keyCode;
                var temp_edate = $(this).parents(".tr_clone").find(".txtpdate");

                if (key == "107" || key == "187") {
                    var dtpls;
                    if (temp_edate.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_edate.val());
                    }

                    dtpls.setDate(dtpls.getDate() + 1);
                    var mm = dtpls.getMonth() + 1;
                    if (mm < 10) {
                        mm = "0" + mm;
                    }

                    var dd = dtpls.getDate();
                    if (dd < 10) {
                        dd = "0" + dd;
                    }


                    var yyyy = dtpls.getFullYear();
                    //var today = yyyy + '-' + mm + '-' +  dd;
                    var today = mm + '/' + dd + '/' + yyyy;

                    //$('#edate').val(today);
                    temp_edate.val(today);
                    event.preventDefault();

                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    var dtmns;
                    if (temp_edate.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_edate.val());
                    }

                    dtmns.setDate(dtmns.getDate() - 1);
                    var mm = dtmns.getMonth() + 1;
                    if (mm < 10) {
                        mm = "0" + mm;
                    }

                    var dd = dtmns.getDate();
                    if (dd < 10) {
                        dd = "0" + dd;
                    }

                    var yyyy = dtmns.getFullYear();
                    var today = mm + '/' + dd + '/' + yyyy;

                    temp_edate.val(today);
                    event.preventDefault();

                } else if (key == "68") {

                    today = '<?= date("m/d/Y"); ?>';
                    temp_edate.val(today);
                    event.preventDefault();
                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_edate.val();


                    if (str.length >= 6 && !(str.includes("/"))) {
                        var mm = str.substring(0, 2);
                        var dd = str.substring(2).substring(0, 2);
                        var yy = str.substring(2).substring(2).substring(0, 2);
                        yy = "20" + yy;

                        var month = 12;
                        var day = 31;

                        if (mm == "02") {
                            if (yy % 4 === 0) {
                                day = 29;
                            } else {
                                day = 28;
                            }
                        }

                        if (mm <= month && dd <= day) {

                            var today = mm + '/' + dd + '/' + yy;
                            var today1 = mm + '/' + dd + '/' + yy;

                            temp_edate.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_edate.val("");
                            event.preventDefault();
                        }
                    }
                }

            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            fnloadpaymentview();
        });



        $(document).ready(function() {
            $('body').on('click', '#invclose', function() {
                var cus_id = localStorage.getItem("pckId");
                var inv_dtls = "";
                var hpaymentId = $('#hpaymentId').val();
                var custpayamt = parseFloat($('#custpayamt').val());
                var applied_amt = parseFloat($('#custappamt').val());
                var creadit_amt = parseFloat($('#custrmnamt').val());
                var payment_type = localStorage.getItem("payment_type");
                var paymentno = localStorage.getItem("paymentno");

                // alert(payment_type);
                $(".inv_allid").each(function() {
                    if (inv_dtls == "") {
                        inv_dtls = $(this).val();
                    } else {
                        inv_dtls = "" + inv_dtls + "" + "," + "'" + $(this).val() + "'";
                    }
                });

                var total_inv_amt = <?= $this->session->bal_amt ?>;

                if ((total_inv_amt < custpayamt && applied_amt == total_inv_amt) || (total_inv_amt > custpayamt && applied_amt == custpayamt)) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('PaymentsCont/fineshpayment') ?>",
                        data: {
                            id: inv_dtls,
                            hpaymentId: hpaymentId,
                            custpayamt: custpayamt,
                            applied_amt: applied_amt,
                            creadit_amt: creadit_amt,
                            payment_type: payment_type,
                            paymentno: paymentno
                        },
                        dataType: 'text',
                        beforeSend: function() {
                            $('.fadeMe').show();
                            // alert("payId--"+payId);
                        },
                        success: function(data) {
                           
                            if (data == "success") {
                                alert("Payment Finished Successfully");
                                $('#myModal').hide();
                                window.location = window.location.href;
                              
                                fnloadpaymentview();
                                $('.fadeMe').hide();
                            } else if (data == "error") {
                                $('.fadeMe').hide();
                            }
                        }

                    });
                } else {

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('PaymentsCont/checkduebal') ?>",
                        data: {
                            client_id: cus_id
                        },
                        dataType: 'text',
                        success: function(data) {
                            if (data > 0) {
                                alert("Please utilize your full amount");
                            } else {
                                window.location.replace("<?base_url('fi_home/c_payment')?>");
                            }
                        }
                    });

                 
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#invcloseSec', function() {
                var cus_id = localStorage.getItem("pckId");
                var creadit_amt = parseFloat($('#custrmnamtSec').val());
                if (creadit_amt == 0) {
                    $('#payment_modal_2').hide();
                    window.location = window.location.href;
                    //$('#allpayments-history').load(location.href + ' #allpayments-history>*','');
                    fnloadpaymentview();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('PaymentsCont/checkduebal') ?>",
                        data: {
                            client_id: cus_id
                        },
                        dataType: 'text',
                        success: function(data) {
                            if (data > 0) {
                                alert("Please utilize your full amount");
                            } else {
                                window.location.replace("<?base_url('fi_home/c_payment')?>");
                            }
                        }
                    });
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#close_model2', function() {
                // alert("close");
                var r = confirm("Are you sure you want close.?");
                if (r == true) {
                    var creadit_amt = parseFloat($('#custrmnamtSec').val());
                    if (creadit_amt != 0) {
                        $('#payment_modal_2').hide();
                        window.location = window.location.href;
                        fnloadpaymentview();
                        //alert("Please utilize your full amount");
                        //event.preventDefault();
                    } else {
                        // alert("close");
                        $('#payment_modal_2').hide();
                        window.location = window.location.href;
                        //$('#allpayments-history').load(location.href + ' #allpayments-history>*','');
                        fnloadpaymentview();
                    }
                } else {
                    ee.preventDefault();
                    ee.stopPropagation();
                    $('#payment_modal_2').show();
                    $('#payment_modal_2').addClass('in');
                }

            });
        });

        $(document).ready(function() {
            $('body').on('click', '#invrmall', function() {
                var inv_dtls = "";
                $(".inv_allid").each(function() {
                    if (inv_dtls == "") {
                        inv_dtls = $(this).val();
                    } else {
                        inv_dtls = inv_dtls + "," + $(this).val();
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/removepayment') ?>",
                    data: {
                        id: inv_dtls
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data == "success") {
                            fnloadpaymentview();
                            $('#applypaymentinv').empty();
                            $('#invrmall').addClass("disabled");
                            $('#invclose').addClass("disabled");
                            var custpayamt = parseFloat($('#custpayamt').val());
                            $('#custappamt').val("0.00");
                            $('#custrmnamt').val(custpayamt.toFixed(2));
                            $('.fadeMe').hide();
                        } else if (data == "error") {
                            $('.fadeMe').hide();
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('body').on('click', '#invrmallSec', function() {
                $(".modal table.applied #applypaymentinvSec tr").each(function() {
                    var tempID_app = $(this).find(".app_inv_idSec span").html();
                    var app_amt = $(this).find(".app_inv_amtSec").html();

                    $(".modal table.apply tr").each(function() {
                        var tempID = $(this).find(".invce-id_Sec").html();
                        if (tempID == tempID_app) {
                            var invoice_paid_amtSec = $(this).find(".invoice_paid_amtSec");

                            cur_amt = invoice_paid_amtSec.val();
                            invoice_paid_amtSec.val(parseFloat(parseFloat(cur_amt) - parseFloat(app_amt)).toFixed(2));
                            //$(this).find(".invoice_paid_amtSecDisp").val(parseFloat(parseFloat(cur_amt)-parseFloat(app_amt)).toFixed(2));

                            var balance_amtSec = $(this).find(".balance_amtSec");

                            bal_amt = balance_amtSec.val();
                            balance_amtSec.val(parseFloat(parseFloat(bal_amt) + parseFloat(app_amt)).toFixed(2));
                            //$(this).find(".balance_amtSecDisp").val(parseFloat(parseFloat(bal_amt)+parseFloat(app_amt)).toFixed(2));  
                        }
                    });
                });

                var inv_dtls = "";
                $(".invsec_allid").each(function() {
                    if (inv_dtls == "") {
                        inv_dtls = $(this).val();
                    } else {
                        inv_dtls = inv_dtls + "," + $(this).val();
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/removepaymentSec') ?>",
                    data: {
                        id: inv_dtls
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        console.log(2);
                        if (data == "success") {
                            console.log(3);
                            fnloadpaymentview();
                            $('#applypaymentinvSec').empty();

                            $('#invrmallSec').addClass("disabled");
                            $('#invcloseSec').addClass("disabled");

                            var custpayamt = parseFloat($('#custpayamtSec').val()).toFixed(2);
                            console.log(custpayamt);
                            console.log($('#custpayamtSec').val());

                            $('#custappamtSec').val("");
                            $('#custappamtSec1').val("$0.00");
                            $('#custrmnamtSec').val(custpayamt);
                            console.log("s9");
                            $('#custrmnamtSec1').val("$" + custpayamt);
                            $('.fadeMe').hide();
                        } else if (data == "error") {
                            $('.fadeMe').hide();
                        }
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#close_model', function(ee) {
                var inv_dtls = "";
                $(".inv_allid").each(function() {
                    if (inv_dtls == "") {
                        inv_dtls = $(this).val();
                    } else {
                        inv_dtls = inv_dtls + "," + $(this).val();
                    }
                });

                // alert(inv_dtls);
                var r = confirm("Are you sure you want close.?");
                if (r == true) {
                    $('.modal-backdrop').remove();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('PaymentsCont/removepayment') ?>",
                        data: {
                            id: inv_dtls
                        },
                        dataType: 'text',
                        beforeSend: function() {
                            $('.fadeMe').show();
                            // alert("payId--"+payId);
                        },
                        success: function(data) {
                            // alert(data);
                            if (data == "success") {
                                //$('#allpayments-history').load(location.href + ' #allpayments-history>*','');
                                fnloadpaymentview();
                                $('#applypaymentinv').empty();
                                console.log(1);
                                $('#invrmall').addClass("disabled");
                                $('#invclose').addClass("disabled");

                                var custpayamt = parseFloat($('#custpayamt').val());
                                $('#custappamt').val("");
                                $('#custrmnamt').val(custpayamt);
                                $('.fadeMe').hide();

                            } else if (data == "error") {
                                $('.fadeMe').hide();
                            }
                        }

                    });
                } else {
                    ee.preventDefault();
                    ee.stopPropagation();

                    $('#myModal').show();
                    $('#myModal').addClass('in');
                   
                }



                
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#invautoapply', function() {

                var custpayamt = parseFloat($('#custpayamt').val());

                var cus_id = localStorage.getItem("pckId");
               

                var hpaymentId = $('#hpaymentId').val();

                var payment_type = localStorage.getItem("payment_type");
                var paymentno = localStorage.getItem("paymentno");

              
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/autopayment') ?>",
                    data: {
                        cus_id: cus_id,
                        custpayamt: custpayamt,
                        hpaymentId: hpaymentId,
                        payment_type: payment_type,
                        paymentno: paymentno
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        $('.fadeMe').show();
                        
                    },
                    success: function(data) {
                       
                        if (data == "success") {
                            alert("Auto payment applied successfully");
                            $('#myModal').hide();
                            window.location = window.location.href;
                            $('.fadeMe').hide();
                        } else if (data == "error") {
                            $('.fadeMe').hide();
                        }
                    }
                });
         
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            var payno = "";
            $("body").on("blur", ".txtnotes", function(event) {
               
                var note = $(this).val();

                var hdnpayId = $(this).parents('.tr_clone').find('.hdnpayId').val();


                $.ajax({
                    type: "POST",
                    url: "<?= base_url('PaymentsCont/updatepaymentdatanote') ?>",
                    data: {
                        hdnpayId: hdnpayId,
                        note: note
                    },
                    dataType: 'html',
                    beforeSend: function() {

                        $('.fadeMe').show();

                    },
                    success: function(data) {

                        if (data = "1") {
                       
                            $('.fadeMe').hide();
                        } else {
                            
                            $('.fadeMe').hide();
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(".btn-box-tool").click(function() {
            $(this).parents(".box").find(".box-header").next("div").slideToggle(500);
        });
    </script>

    <a style="display: none" href="<?php echo site_url('fi_home/'); ?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
    <script src="<?php echo base_url('assets/'); ?>js/prasanna.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: "<?= site_url('Email_reader') ?>",
                success: function(result) {}
            });
        });
    </script>


    <script type="text/javascript">
        var popup_me = $('.popup_me').val();
    </script>