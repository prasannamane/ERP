<!DOCTYPE html>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Search Customer | ERP System </title>

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

    .fadeMe {
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

    .form-control {
        background: #fff;
    }

    .filtercust form .form-group .col-sm-1 {
        padding: 5px;
        width: 7%;
        min-width: 133px;
    }

    .filtercust form .form-group {
        width: 1110px;
        padding: 0 15px;
        margin: 0;
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

    #frmsearchcust input,
    #frmsearchcust select {
        height: 23px;
    }

    #frmsearchcust .btn {
        height: 23px;
        min-width: 60px;
        font-size: 13px !important;
    }

    .table-responsive {
        overflow-y: inherit;
        overflow-x: hidden;
    }
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper pg_cust_search">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Customer</a></li>
                <li class="active">Search</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <?php $this->load->view('template/search_select_customer'); ?>

                <div class="col-md-12">
                    <div class="box box-default firstblock_bg">
                        <div class="box-header with-border">
                            <p class="uhead2"><?= $page_title ?></p>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="box-body filtercust">
                            <div class="form-horizontal">
                                <form method="post" name="frmsearchcust" id="frmsearchcust">
                                    <?php

                                    foreach ($act_custrows as $act_custrow) {
                                        $getfname     = $act_custrow['cus_fname'];
                                        $getlname     = $act_custrow['cus_lname'];
                                        $getcname     = $act_custrow['cus_company_name'];
                                        $getaddr1     = $act_custrow['cus_address1'];
                                        $getaddr2     = $act_custrow['cus_address2'];
                                        $getcity      = $act_custrow['cus_city'];
                                        $getstate     = $act_custrow['cus_state'];
                                        $getzip       = $act_custrow['cus_zip'];
                                        $getarea      = $act_custrow['cus_area'];
                                        $getphno      = $act_custrow['phone_no'];
                                        $getacc_no        = $act_custrow['acc_no'];
                                        $getacc_type      = $act_custrow['acc_type'];
                                        $getvendor_name   = $act_custrow['vendor_name'];
                                        $getevent_from_date = $act_custrow['event_from_date'];
                                        $getevent_to_date = $act_custrow['event_to_date'];
                                        $getevent_type    = $act_custrow['event_type'];
                                        $getevent_location = $act_custrow['event_location'];
                                        $getinvoice_no    = $act_custrow['invoice_no'];
                                        $getreferred_by   = $act_custrow['referred_by'];
                                        $getbalance_as_of = $act_custrow['balance_as_of'];
                                        $note = $act_custrow['note'];
                                        $total_due = $act_custrow['total_due'];
                                    }

                                    if ($getacc_no == 1) {
                                        $getacc_nochksts = "display: table-cell;";
                                    } else {
                                        $getacc_nochksts = "display:none;";
                                    }
                                    if ($getacc_type == 1) {
                                        $getacc_typechksts = "display: table-cell;";
                                    } else {
                                        $getacc_typechksts = "display:none;";
                                    }
                                    if ($getvendor_name == 1) {
                                        $getvendor_namechksts = "display: table-cell;";
                                    } else {
                                        $getvendor_namechksts = "display:none;";
                                    }
                                    if ($getevent_from_date == 1) {
                                        $getevent_from_datechksts = "display: table-cell;";
                                    } else {
                                        $getevent_from_datechksts = "display:none;";
                                    }
                                    if ($getevent_to_date == 1) {
                                        $getevent_to_datechksts = "display: table-cell;";
                                    } else {
                                        $getevent_to_datechksts = "display:none;";
                                    }
                                    if ($getevent_type == 1) {
                                        $getevent_typechksts = "display: table-cell;";
                                    } else {
                                        $getevent_typechksts = "display:none;";
                                    }
                                    if ($getevent_location == 1) {
                                        $getevent_locationchksts = "display: table-cell;";
                                    } else {
                                        $getevent_locationchksts = "display:none;";
                                    }
                                    if ($getinvoice_no == 1) {
                                        $getinvoice_nochksts = "display: table-cell;";
                                    } else {
                                        $getinvoice_nochksts = "display:none;";
                                    }
                                    if ($getreferred_by == 1) {
                                        $getreferred_bychksts = "display: table-cell;";
                                    } else {
                                        $getreferred_bychksts = "display:none;";
                                    }
                                    if ($getbalance_as_of == 1) {
                                        $getbalance_as_ofchksts = "display: table-cell;";
                                    } else {
                                        $getbalance_as_ofchksts = "display:none;";
                                    }
                                    if ($getfname == 1) {
                                        $fnmamechksts = "display: table-cell;";
                                    } else {
                                        $fnmamechksts = "display:none;";
                                    }
                                    if ($getcname == 1) {
                                        $cnmamechksts = "display: table-cell;";
                                    } else {
                                        $cnmamechksts = "display:none;";
                                    }
                                    if ($getaddr1 == 1) {
                                        $addr1chksts = "display: table-cell;";
                                    } else {
                                        $addr1chksts = "display:none;";
                                    }
                                    if ($getaddr2 == 1) {
                                        $addr2chksts = "display: table-cell;";
                                    } else {
                                        $addr2chksts = "display:none;";
                                    }
                                    if ($getcity == 1) {
                                        $citychksts = "display: table-cell;";
                                    } else {
                                        $citychksts = "display:none;";
                                    }
                                    if ($getstate == 1) {
                                        $statechksts = "display: table-cell;";
                                    } else {
                                        $statechksts = "display:none;";
                                    }
                                    if ($getzip == 1) {
                                        $zipchksts = "display: table-cell;";
                                    } else {
                                        $zipchksts = "display:none;";
                                    }
                                    if ($getarea == 1) {
                                        $areachksts = "display: table-cell;";
                                    } else {
                                        $areachksts = "display:none;";
                                    }
                                    if ($getphno == 1) {
                                        $phnochksts = "display: table-cell;";
                                    } else {
                                        $phnochksts = "display:none;";
                                    }
                                    if ($note == 1) {
                                        $note = "display: table-cell;";
                                    } else {
                                        $note = "display:none;";
                                    }
                                    if ($total_due == 1) {
                                        $total_due = "display: table-cell;";
                                    } else {
                                        $total_due = "display:none;";
                                    }

                                    ?>
                                    <div class="form-group">
                                        <div class="col-sm-1" style="<?= $fnmamechksts ?>">
                                            <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" style="text-transform:capitalize;">
                                        </div>

                                        <div class="col-sm-1" style="<?= $fnmamechksts ?>">
                                            <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" style="text-transform:capitalize;">
                                        </div>

                                        <div class="col-sm-1" style="<?= $cnmamechksts ?>">
                                            <input class="form-control" type="text" id="cname" name="cname" placeholder="Company">
                                        </div>

                                        <div class="col-sm-1" style="<?= $addr1chksts ?>">
                                            <input class="form-control" type="text" id="adr1" name="adr1" placeholder="Address">
                                        </div>

                                        <div class="col-sm-1" style="<?= $addr2chksts ?>">
                                            <input class="form-control" type="text" id="adr2" name="adr2" placeholder="Address 2">
                                        </div>

                                        <div class="col-sm-1" style="<?= $citychksts ?>">
                                            <input class="form-control" type="text" id="cities" name="cities" placeholder="City">
                                        </div>
                                        <div class="col-sm-1" style="<?= $statechksts ?>">
                                            <input class="form-control" type="text" id="states" name="states" placeholder="State">
                                        </div>

                                        <div class="col-sm-1" style="<?= $zipchksts ?>">
                                            <input style="<?= $zipchksts ?>" class="form-control" type="text" id="zname" name="zname" placeholder="Zip Code">
                                        </div>

                                        <div class="col-sm-1" style="<?= $areachksts ?>">
                                            <input class="form-control" type="text" id="areas" name="areas" placeholder="Area">
                                        </div>

                                        <div class="col-sm-1" style="<?= $phnochksts ?>">
                                            <input class="form-control contact_no" type="text" id="mname" name="mname" placeholder="Phone">
                                        </div>

                                        <div class="col-sm-1" style="<?= $getacc_nochksts ?>">
                                            <input class="form-control" type="number" id="accno" name="accno" placeholder="Account No">
                                        </div>

                                        <div class="col-sm-1" style="<?= $getacc_typechksts ?>">

                                            <select id="acctype" class="form-control  updwn" name="acctype" placeholder="Event Location">

                                                <option value="" selected hidden>Account Type</option>
                                                <option value=""></option>
                                                <option value="1">Booked</option>
                                                <option value="2">Lost</option>
                                                <option value="0">Potential</option>

                                            </select>
                                        </div>

                                        <div class="col-sm-1" style="<?= $getvendor_namechksts ?>">
                                            <input class="form-control" type="text" id="vendorname" name="vendorname" placeholder="Vendor Name">
                                        </div>

                                        <div class="col-sm-1 w140">
                                            <input class="btn btn-xs btn-primary btn-flat" type="button" name="submit" id="submit" value="Search" onclick="fnsearchcustomer()">
                                            <input class="btn btn-xs btn-warning btn-flat" type="button" name="submit" id="submit" value="Reset" onclick="fnresetcustomer()">

                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="col-sm-1" style="<?= $getevent_from_datechksts ?> w110">
                                            <input class="form-control evfdate" type="text" id="evfdate" name="evfdate" placeholder="From date">
                                        </div>

                                        <div class="col-sm-1" style="<?= $getevent_to_datechksts ?>">
                                            <input class="form-control evtdate" type="text" id="evtdate" name="evtdate" placeholder="To date">
                                        </div>

                                        <div class="col-sm-1" style="<?= $getevent_typechksts ?>">
                                            <?php
                                            $event_name       = $this->db->where('cat_id', 3)->get('sub_categories')->result_array();
                                            ?>

                                            <select id="evtype" class="form-control  updwn" name="evtype">
                                                <option value="" selected hidden>Event Type</option>
                                                <option value=""></option>
                                                <?php
                                                $i = 1;
                                                foreach ($event_name as $name) {

                                                    if ($events_info['event_type'] == $name['sub_name']) {
                                                        $evntyesel = "selected";
                                                    } else {

                                                        $evntyesel = "";
                                                    }
                                                ?>
                                                    <option <?= $evntyesel ?> value="<?php echo $name['sub_name']; ?>"><?php echo $name['sub_name']; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-1" style="<?= $getevent_locationchksts ?> w120">
                                            <?php
                                            $get_loc = $this->db->query("SELECT * from add_location_event");
                                            $all_locs = $get_loc->result_array();
                                            ?>

                                            <select id="evtlocn" class="form-control  updwn" name="evtlocn" placeholder="Event Location">

                                                <option value="" selected hidden>Event Location</option>
                                                <option value=""></option>
                                                <?php foreach ($all_locs as $locations) {
                                                    if ($locations['location_name'] == $locations_info['location_type']) {
                                                        $loctype = "selected";
                                                    } else {
                                                        $loctype = "";
                                                    }

                                                ?>
                                                    <option <?= $loctype ?> value="<?php echo $locations['location_name'] ?>"><?php echo $locations['location_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-1" style="<?= $getinvoice_nochksts ?>">
                                            <input class="form-control" type="text" id="evtinv_no" name="evtinv_no" placeholder="Invoice no">
                                        </div>

                                        <div class="col-sm-1" style="<?= $getbalance_as_ofchksts ?>">
                                            <input class="form-control" type="text" id="bal_as_of" name="bal_as_of" placeholder="Balance As Of">
                                        </div>



                                        <div class="col-sm-1" style="<?= $getreferred_bychksts ?>">
                                            <input class="form-control" type="text" id="evtreff_by" name="evtreff_by" placeholder="Referred By">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">

                                    <table class="table  table-hover no-margin" id="tab_data">
                                        <thead>
                                            <tr>
                                                <th class="w30">#</th>
                                                <th class="w30">ID</th>
                                                <th class="w60">TITLE</th>
                                                <th class="w110" style="display:table-cell">LAST NAME</th>
                                                <th class="w110" style="display:table-cell">FIRST NAME</th>
                                                <th class="w180" style="display:table-cell">ADDRESS 1</th>
                                                <th class="w180" style="display:table-cell">ADDRESS 2</th>
                                                <th class="w210" style="display:table-cell">CUSTOMER AREA</th>
                                                <th class="w150" style="display:table-cell">CONTACT </th>
                                                <th class="w150" style="display:table-cell">ACCOUNT NO </th>
                                                <th class="w210" style="display:table-cell">COMPANY NAME</th>

                                                <th class="w150" style="display:table-cell"> CITY</th>
                                                <th class="w150" style="display:table-cell"> STATE</th>
                                                <th class="w50" style="display:table-cell">ZIP </th>
                                                <th style="<?= $note ?>">NOTE</th>
                                                <th style="<?= $total_due ?>">Total Due</th>

                                            </tr>
                                        </thead>
                                        <tbody id="divfiltercust"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="result"></div>
        </section>
    </div>
    <div class="fadeMe">
        <div id="loader" class="loader"></div>
    </div>
    <script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            //add phone
            var maxFieldPhone = 3; //Input fields increment limitation
            var addPhone = $('.add_phone'); //Add button selector
            var phoneWrapper = $('.phone_wrapper'); //Input field wrapper
            var phoneHTML = '<div class="form-group"> <div class="col-sm-10"> <input class="form-control" type="text" placeholder="Phone"  name="field_phone[]"> </div> <div class="col-md-2"><button class="btn btn-xs btn-danger btn-flat remove_phone"><i class="fa fa-minus"></i></button></div> </div>'; //New input field html
            var xPhone = 1; //Initial field counter is 1
            //Once add button is clicked
            $(addPhone).click(function() {
                //Check maximum number of input fields
                if (xPhone < maxFieldPhone) {
                    xPhone++; //Increment field counter
                    $(phoneWrapper).append(phoneHTML); //Add field html
                }
            });
            //Once remove button is clicked
            $(phoneWrapper).on('click', '.remove_phone', function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove(); //Remove field html
                xPhone--; //Decrement field counter
            });
            //add address
            var maxFieldAddress = 3; //Input fields increment limitation
            var addAddress = $('.add_address'); //Add button selector
            var addressWrapper = $('.address_wrapper'); //Input field wrapper
            var addressHTML = '<div class="form-group"> <div class="col-sm-10"> <input class="form-control" type="email" placeholder="Email"  name="field_address[]"> </div> <div class="col-md-2"><button class="btn btn-xs btn-danger btn-flat remove_address"><i class="fa fa-minus"></i></button></div> </div>'; //New input field html
            var xAddr = 1; //Initial field counter is 1
            //Once add button is clicked
            $(addAddress).click(function() {
                //Check maximum number of input fields
                if (xAddr < maxFieldAddress) {
                    xAddr++; //Increment field counter
                    $(addressWrapper).append(addressHTML); //Add field html
                }
            });
            //Once remove button is clicked
            $(addressWrapper).on('click', '.remove_address', function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove(); //Remove field html
                xAddr--; //Decrement field counter
            });
        });
    </script>
    <script>
        function loadlist(name) {


            $.ajax({
                type: "POST",
                url: "<?= base_url('Fi_home/getSearchCustContactInfo') ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    localStorage.clear();
                    var pckId = name;
                    //alert("pckId--"+pckId);

                    localStorage.setItem("pckId", pckId);

                },
                success: function(data) {
                    // alert(data);
                    if (data != "") {
                        //console.log(data);

                        //$('#contact_info').html(data);
                        $('.loaduppertabcntdtls').html(data);
                    } else {
                        //$('#contact_info').html(data);

                        $('.loaduppertabcntdtls').html(data);
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getSearchInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                success: function(data) {
                    if (data != "") {
                        $('#divfiltercust').html(data);
                        $('.fadeMe').hide();
                    } else {
                        $('#divfiltercust').html(data);
                    }
                }
            });
        }
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        // on load we call the function
        $(document).ready(function() {
            //var name = $('#searc').val();

            var pckId = localStorage.getItem("pckId");
            //alert("localStorage pckId--"+pckId);
            if (pckId == null || pckId == "") {} else {


                var name = pckId;
                //  alert("localStorage name--"+name);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'html',
                    success: function(data) {
                        if (data != "") {
                            $('.loaduppertabcntdtls').html(data);

                        } else {
                            $('.loaduppertabcntdtls').html(data);
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/getSearchInfo'); ?>",
                    data: {
                        name: name
                    },
                    dataType: 'html',
                    success: function(data) {
                        if (data != "") {
                            $('#divfiltercust').html(data);
                            $('#searc option[value="' + name + '"]').attr("selected", "selected");
                        } else {
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                        }
                    }
                });

            }

        });
    </script>

    <script type="text/javascript">
        function fnsearchcustomer_mainserach() {
            var q = $('#q').val();
            if (q != "") {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('fi_home/search_cust_mainsearch') ?>",
                    data: {
                        q: q
                    },
                    dataType: "html",
                    beforeSend: function() {},
                    success: function(data) {
                        // alert(data);
                        if (data != "") {
                            //$('.fadeMe').hide();
                            $('#divfiltercust').html(data);
                            $('#searc option:selected').removeAttr('selected');
                            $('#topphone').val('');
                            $('#lastinvId input').val('');
                            $('#lastinvduebal input').val('');
                        } else {
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                            $('#searc option:selected').removeAttr('selected');
                            $('#topphone').val('');
                            $('#lastinvId input').val('');
                            $('#lastinvduebal input').val('');
                        }
                    }
                });
            }
        }

        function fnsearchcustomer() {
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var cname = $('#cname').val();
            var adr1 = $('#adr1').val();
            var adr2 = $('#adr2').val();
            var cities = $('#cities').val();
            var states = $('#states').val();
            var zname = $('#zname').val();
            var areas = $('#areas').val();
            var mname = $('#mname').val();
            var accno = $('#accno').val();
            var acctype = $('#acctype').val();
            var vendorname = $('#vendorname').val();
            var evfdate = $('#evfdate').val();
            var evtdate = $('#evtdate').val();
            var evtype = $('#evtype').val();
            var evtlocn = $('#evtlocn').val();
            var evtinv_no = $('#evtinv_no').val();
            var evtreff_by = $('#evtreff_by').val();
            var bal_as_of = $('#bal_as_of').val();

            console.log(fname + "-" + lname + "-" + cname + "-" + adr1 + "-" + adr2 + "-" + cities + "-" + states + "-" + zname + "-" + areas + "-" + mname + "-" + accno + "-" + acctype + "-" + vendorname + "-" + evfdate + "-" + evtdate + "-" + evtype + "-" + evtlocn + "-" + evtinv_no + "-" + evtreff_by + "-" + bal_as_of);

            if (fname != "" || lname != "" || cname != "" || adr1 != "" || adr2 != "" || cities != "" || states != "" || zname != "" || areas != "" || mname != "" || accno != "" || acctype != "" || vendorname != "" || evfdate != "" || evtdate != "" || evtype != "" || evtlocn != "" || evtinv_no != "" || evtreff_by != "" || bal_as_of != "") {
                console.log(1);
                var searchcust = $('#frmsearchcust').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('fi_home/search_cust') ?>",
                    data: searchcust,
                    dataType: "html",
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data != "") {
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                        } else {
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                        }
                    }
                });
            } else {
                alert("Please enter atleast one field to search record..!");
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('fi_home/search_allcust') ?>",
                    dataType: "html",
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data != "") {
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                        } else {
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                        }
                    }
                });
            }
        }

        function fnresetcustomer() {

            alert("hi");
            var fname = $('#fname').val('');
            var lname = $('#lname').val('');
            var cname = $('#cname').val('');
            var adr1 = $('#adr1').val('');
            var adr2 = $('#adr2').val('');
            var cities = $('#cities').val('');
            var states = $('#states').val('');
            var zname = $('#zname').val('');
            var areas = $('#areas').val('');
            var mname = $('#mname').val('');
            var accno = $('#accno').val('');
            var acctype = $('#acctype').val('');
            var vendorname = $('#vendorname').val('');
            var evfdate = $('#evfdate').val('');
            var evtdate = $('#evtdate').val('');
            var evtype = $('#evtype').val('');
            var evtlocn = $('#evtlocn').val('');
            var evtinv_no = $('#evtinv_no').val('');
            var evtreff_by = $('#evtreff_by').val('');
            var bal_as_of = $('#bal_as_of').val('');
            // alert("acctype "+acctype);
            window.location.href = "<?= site_url('fi_home/search') ?>";

        }


        function gettopphoneno(name) { //alert("name--"+name);

            $.ajax({
                type: "POST",
                url: "<?= base_url('Fi_home/getSearchCustContactInfo') ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                success: function(data) {

                    if (data != "") {
                        //console.log(data);

                        // $('#contact_info').html(data);
                        $('.loaduppertabcntdtls').html(data);

                    } else {
                        //$('#contact_info').html("");
                        $('.loaduppertabcntdtls').html("");
                    }
                }
            });
        }
    </script>


    <script type="text/javascript">
        function fncustomersearchbyphone(txtphoneno) {

            if (txtphoneno != "") {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fncustsrchbyph'); ?>",
                    data: {
                        txtphoneno: txtphoneno
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();

                    },
                    success: function(data) {
                        if (data != "") {
                            // console.log(data);

                            //$('#tab_data tbody').html(data);
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();


                        } else {
                            //$('#tab_data tbody').html(data);
                            $('#divfiltercust').html(data);
                            $('.fadeMe').hide();
                        }
                    }

                });


            }

        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('keydown', '#lname,#fname,#cname,#adr1,#cities,#zname,#mname', function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == 13) {
                    //alert('You pressed a "enter" key in somewhere');
                    fnsearchcustomer();
                    //$('#search-btn').trigger('click');
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script type="text/javascript">
        $(document).ready(function($) {

            $('body ').on("keypress", ".contact_no", function() {
                $(this).mask('(000) 000-0000');
            });
            $(".str").keypress(function(event)

                {

                    var inputValue = event.which;
                    if (!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0))

                    {

                        event.preventDefault();

                    }

                });



            $(".num").keypress(function(e)

                {

                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))

                    {

                        return false;

                    }

                });


        });
    </script>

    <script type="text/javascript">
        function fnviewcustomer(pckId) {
            //alert("pckId--"+pckId);
            localStorage.setItem("pckId", pckId);
            window.location.href = "<?= site_url('fi_home/generalinfo') ?>";

        }
    </script>
    <script>
        $(document).ready(function() {
            $('#lstpaytype_cus').on('input', function() {
                var value = $(this).val();
                // alert("value:"+value);
                var cust_id = $('#cuslist [value="' + value + '"]').data('value');
                if (value != "") {
                    loadlist(cust_id);
                    localStorage.setItem("customer_name", value);
                } else {
                    // alert("elsevalue:"+value);
                    value = "";
                    cust_id = 0;
                    loadlist(cust_id);
                    localStorage.setItem("customer_name", value);
                }

            });

            var cu_name = localStorage.getItem("customer_name");
            // alert("name "+ cu_name)
            $('#lstpaytype_cus').val(cu_name);
        });
    </script>

    <script>
        $(document).ready(function() {
            $("body").on("keydown", "#evfdate", function(event) {

                var key = event.keyCode;
                var temp_edate = $("#evfdate");

                if (key == "107" || key == "187") {
                    //alert("date+");
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
                    var today = mm + '/' + dd + '/' + yyyy;
                    var today1 = yyyy + '/' + mm + '/' + dd;


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
                    var today1 = yyyy + '/' + mm + '/' + dd;
                    temp_edate.val(today);
                    event.preventDefault();
                } else if (key == "68") {

                    today = '<?php echo date("m/d/Y"); ?>';
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
            $("body").on("keydown", "#evtdate", function(event) {

                var key = event.keyCode;
                var temp_edate = $("#evtdate");

                if (key == "107" || key == "187") {
                    //alert("date+");
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
                    var today = mm + '/' + dd + '/' + yyyy;
                    var today1 = yyyy + '/' + mm + '/' + dd;


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
                    var today1 = yyyy + '/' + mm + '/' + dd;
                    temp_edate.val(today);

                    event.preventDefault();

                } else if (key == "68") {
                    today = '<?php echo date("m/d/Y"); ?>';
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

        function cust_search() {
            var cust_search = $(".cust_search option:selected").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getSearchInfo'); ?>",
                data: {
                    name: cust_search
                },
                dataType: 'html',
                success: function(data) {
                    $('#divfiltercust').html(data);
                }
            });

            $.ajax({
                type: "POST",
                url: "<?= base_url('Fi_home/getSearchCustContactInfo') ?>",
                data: {
                    name: cust_search
                },
                dataType: 'html',
                success: function(data) {
                    if (data != "") {
                        $('.loaduppertabcntdtls').html(data);
                    } else {
                        $('.loaduppertabcntdtls').html("");
                    }
                }
            });
        }
    </script>
    <a style="display: none" href="<?php echo site_url('fi_home/'); ?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
    <script src="<?php echo base_url('assets/'); ?>js/prasanna.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.select2-hidden-accessible').trigger("click");

            $('[name="cus_notes"]').focus();
        });
        $(document).bind('keydown', function(e) {
            if (e.ctrlKey && (e.which == 83)) {
                e.preventDefault();
                $("#cus_notes").trigger('click');
                window.console("Yes");
                return false;
            }
        });
    </script>

    <?php
    foreach ($custs as $cust) {
        if ($cust['cus_id'] == $cus_id) { ?>
            <script type="text/javascript">
                cust_search();
            </script>
    <?php
        }
    } ?>


    <script type="text/javascript">
        $(document).ready(function() {

            $.ajax({
                url: "<?= site_url('Email_reader') ?>",
                success: function(result) {
                    console.log("Email Updated from server");
                }
            });
        });
    </script>