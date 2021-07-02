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
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini administration_package">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Administration</a></li>
                <li class="active">Packages</li>
            </ol>
        </section>

        <?php if (isset($success)) { ?>
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong></strong> <?= $success ?>
            </div>
        <?php } ?>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> <?= $error ?>
            </div>
        <?php } ?>

        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right" style="margin-bottom: 10px;">
                        <a href="<?= site_url('Administration/new_administration_package') ?>" class="btn btn-md btn-info btn-flat">New Package</a>
                    </div>
                </div>
            </div>

            <form method="POST" id="iform" name="iform">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-sm-5 col-md-4">
                                        <h3 class="uhead2">
                                            Packages
                                        </h3>
                                    </div>
                                    <div class="col-sm-7 col-md-8">
                                        <div class="pull-right">
                                            <ul class="list-inline topul">
                                                <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                                                <li><a href="#" class="uhead2"> Options </a></li>
                                                <li><button class="btn btn-default"> <i class="fa fa-print"></i></button> </li>
                                            </ul>
                                            <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-default firstblock_bg">
                            <div class="table-responsive ">
                                <table class="table   table-hover no-margin">
                                    <thead>
                                        <tr class="uppercse_block">
                                            <th style=" width: 4%;">#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Taxable</th>
                                            <th style=" width: 40%;">Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($admin_package as $items) { ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group"><?= $i++ ?> </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="<?= $items['package_name'] ?>" onclick="fngetsinglepckinfo(<?= $items['package_id'] ?>)" disable readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="$<?= $items['package_price'] ?>" disable onclick="fngetsinglepckinfo(<?= $items['package_id'] ?>)" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="<?php if ($items['package_taxable']) {                                                                                    echo "Yes";
                                                                                                            } else { echo "No"; } ?>" disable onclick="fngetsinglepckinfo(<?= $items['package_id'] ?>)" readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">

                                                            <input type="text" class="form-control" value="<?= $items['package_desc'] ?>" disable onclick="fngetsinglepckinfo(<?= $items['package_id'] ?>)" readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a class="btn btn-xs btn-danger" onclick="delete_data(<?= $items['package_id'] ?>);"><i class="fa fa-minus"></i></a>
                                                    <a class="btn btn-xs btn-primary" href="<?= base_url('/Administration/update_administration_package/' . $items['package_id']) ?>"><i class="fa fa-pencil"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <p class="uhead2">Items</p>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-horizontal custsearch">

                                    <form method="post" name="frmsearchcust" id="frmsearchcust">

                                        <div class="row">

                                            <div class="col-sm-2">




                                                <select class="form-control" id="itemname" name="itemname" style="width: 80px;">
                                                    <option>Select</option>
                                                    <?php
                                                    $admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");
                                                    foreach ($admitmsql->result() as $admitmsql_dtls) {
                                                    ?>
                                                        <option value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>

                                                    <?php } ?>
                                                </select>

                                            </div>


                                            <div class="col-sm-2">

                                                <input class="form-control contact_no" type="text" id="itemprice" name="itemprice" placeholder="Price">

                                            </div>


                                            <div class="col-sm-2">

                                                <input class="btn btn-xs btn-primary btn-flat" type="button" name="submit" id="submit" value="Search" onclick="fnsearchcustomer()">


                                            </div>

                                        </div>

                                    </form>

                                </div>

                                <div class="table-responsive mt10">

                                    <table class="table table-hover no-margin">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody class="newcalc" id="pckitems">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <div class="fadeMe">
        <div id="loader" class="loader"></div>
    </div>
    <script type="text/javascript">
        function fnadmpckinfo(admpckId, txtinpid) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('Administration/fngetadmpckjson') ?>",
                data: 'admpckId=' + admpckId,
                dataType: "json",
                success: function(data) {
                    var myobj = data.admpackageitem;
                    $("#item_price" + txtinpid).val(myobj.item_price);
                    $("#itmdesc" + txtinpid).val(myobj.item_desc);
                    fngetitemtot();
                }
            });
        }

        function fngetitemtot() {
            var res = 0;
            $(".iprice").each(function() {
                res += Number(this.value);
            });

            //alert(res);

            $('#pcktotprice').val(res);
        }
    </script>


    <script>
        $(document).on("keyup", ".quants", function() {
            //alert("111");
            var res = 0;
            $(".iprice").each(function() {
                res += Number(this.value);
            });

            //alert(res);

            $('#pcktotprice').val(res);
        });
    </script>




    <script src="<?php echo base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>



    <script src="<?php echo base_url('assets/'); ?>js/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


    <script type="text/javascript">
        var cnt = 2
        $(document).on('click', '.tr_clone_add', function(rrr) {
            rrr.preventDefault();
            var aaa = $("#title1").html();

            $(this).parents("tbody").append('<tr class="tr_clone"> <td>' + cnt + '</td><td><select class="form-control fcap" name="title[]" id="title' + cnt + '" onchange="fnadmpckinfo(this.value,' + cnt + ')">' + aaa + '</td><td><input type="number" class="form-control quants" min="1" id="item_quant' + cnt + '" value="1" name="quant[]" style="width: 50px;"></td> <td> <div class="form-group"> <div class="input-group">  <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span> <input type="number" min="0" class="form-control iprice" name="i_price[]" id="item_price' + cnt + '"></div></div></td> <td><div class="form-group"><div class="input-group"><input type="text" class="form-control" style="width:150px;" name="itmdesc[]" id="itmdesc' + cnt + '" required></div></div></td> <td> <button class="btn btn-xs btn-primary tr_clone_add" title="Add row"><i class="fa fa-plus"></i></button></td> </tr>');
            $(this).removeClass('btn-primary tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

            cnt++;
        });





        $(document).on('click', '.tr_clone_remove', function() {

            var $tr = $(this).closest('.tr_clone');

            $(this).closest('table').addClass("currenttable");
            var alltr = $(this).parents("table.currenttable").find('tr');
            var len = alltr.length - 1;


            var $clone = $tr.remove();
            if (cnt > 0) {
                cnt--;
            }
        });
    </script>




    <script>
        $(document).ready(function() {

            var item_price;
            $(".newcalc").on("click", ".iname", function() {
                // alert(123);
                var i_name = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Administration/single_price_info'); ?>",
                    data: {
                        i_name: i_name
                    },
                    success: function(data) {
                        var items = data;
                        // console.log(items);
                        var temp1 = new Array();
                        temp1 = items.split("##");
                        // alert(temp1[1]);

                        document.getElementById("i_price").value = temp1[3];
                        //document.getElementById("loc_phone1").innerHTML = temp1[3];
                        item_price = temp1[3];

                        // alert(item_price);


                    }
                });

            });

            $(".quants").on("keyup change", function() {
                var q = $(this).val();
                //alert(q);
                var product = Number(item_price) * Number(q);
                var prod = product.toFixed(2);
                // alert(prod);
                document.getElementById('i_price').value = prod;

            });
        });
    </script>
    <script>
        $(document).ready(function($) {

            $("#iform").validate({
                rules: {

                    // title:{required: true},
                    // cus_fname:{required: true},
                    item_name: {
                        required: true
                    },
                    item_quant: {
                        required: true
                    },
                    i_price: {
                        required: true
                    }

                    // acquiredBy:{required: true}
                },
                highlight: function(element) {
                    $(element).closest('.frm_testimonials').removeClass('success').addClass('error');
                },

                messages: {
                    // title:{required: "Please Select Title"},
                    item_name: {
                        required: "Please enter Item Name"
                    },
                    item_quant: {
                        required: "Please enter Quantity"
                    },
                    item_price: {
                        required: "Please enter price"
                    }
                    // cus_zip:{required: "Please Enter Zip Code"}


                    // acquiredBy:{required:"Please select Acquired By."}

                },

            });
        });
    </script>


    <!--  Get packages Items Info -->
    <script type="text/javascript">
        function fngetsinglepckinfo(pckId) {
            localStorage.setItem("pckId", pckId);
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/fnpckitems') ?>',
                data: {
                    pckId: pckId
                },
                dataType: 'html',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data != "") {
                        $('.fadeMe').hide();
                        $('#itemPackageName').val(pckId).attr("selected");
                        $('#pckitems').html(data);
                        var ptot = $('#pcktot').val();
                        $('#pcktotprice').val(ptot);
                        var pdesc = $('#pckdesc').val();
                        $('#pcktotdesc').val(pdesc);
                        localStorage.removeItem(pckId);
                        localStorage.clear()
                    } else {
                        $('#pcktotprice').val("");
                        $('#pckitems').html("No Items Found ");
                        $('.fadeMe').hide();

                        localStorage.removeItem(pckId);
                        localStorage.clear()
                    }
                },
                error: function(xhr) {
                    $('.fadeMe').hide();
                },
                complete: function() {
                    $('.fadeMe').hide();
                    //var pckId= localStorage.getItem("pckId");
                    // localStorage.removeItem(setpckid);
                    //localStorage.clear()
                }

            });

        }
    </script>

    <!-- End Get packages Items Info -->

    <!--  Create Items -->
    <script type="text/javascript">
        function fncrpitem(itmId) {

            var pckId = $('#itemPackageName').val();
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/crnewpitem') ?>',
                data: {
                    pckId: pckId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                },
                success: function(data) {

                    //alert("data---"+data);

                    if (data == "success") {

                        window.location.href = location.href;
                        $('.fadeMe').hide();

                    } else if (data == "error") {

                        $('.fadeMe').hide();
                        //alert("Something went wrong..!");
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

    <!-- End Create Items -->

    <!--  Delete Items -->
    <script type="text/javascript">
        function fndelpitem(itmId) {

            var pckId = $('#itemPackageName').val();
            event.preventDefault();

            var r = confirm("Do you want delete this item..?");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Administration/delnewpitem') ?>',
                    data: {
                        itmId: itmId,
                        pckId: pckId
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();

                    },
                    success: function(data) {
                        //alert("data---"+data);
                        if (data == "success") {

                            window.location.href = location.href;
                            $('.fadeMe').hide();

                        } else if (data == "error") {

                            $('.fadeMe').hide();
                            //alert("Something went wrong..!");
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

    <!-- End Delete Items -->


    <!--  Update items data  -->
    <script type="text/javascript">
        function fnadmitemsinfo(admpckId, txtinpid) {
            //alert("admpckId--"+admpckId+" txtinpid--"+txtinpid);

            var pckId = $('#itemPackageName').val();
            localStorage.setItem("pckId", pckId);

            $.ajax({
                type: "POST",
                url: "<?= site_url('Administration/fngetadmpckjson') ?>",
                data: 'admpckId=' + admpckId,
                dataType: "json",
                success: function(data) { //alert("data--"+data);
                    var myobj = data.admpackageitem;
                    $("#i4" + txtinpid).val(myobj.item_price);
                    $("#i3" + txtinpid).val(myobj.item_desc);

                    //alert(admpckId+"--"+myobj.item_price+"--"+myobj.item_desc+"--"+txtinpid+"--"+pckId);

                    fnupdateitemsdtls(admpckId, myobj.item_price, myobj.item_desc, txtinpid, pckId);

                }
            });
        }
    </script>
    <!--  End Update items data  -->

    <!--  Update admpckId,item_price,item_desc,txtinpid,pckId -->
    <script type="text/javascript">
        function fnupdateitemsdtls(admpckId, item_price, item_desc, txtinpid, pckId) {

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/upditemsinfo') ?>',
                data: {
                    admpckId: admpckId,
                    item_price: item_price,
                    item_desc: item_desc,
                    txtinpid: txtinpid,
                    pckId: pckId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {
                    //alert("data---"+data);
                    if (data == "success") {

                        window.location.href = location.href;
                        $('.fadeMe').hide();

                    } else if (data == "error") {

                        $('.fadeMe').hide();
                        //alert("Something went wrong..!");
                    }

                },
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                },
                complete: function() {

                }

            });
        }
    </script>

    <!-- End Update admpckId,item_price,item_desc,txtinpid,pckId -->


    <script type="text/javascript">
        function fnupdateitemamountp(itemamt, txtinpid) {
            //alert("itemamt--"+itemamt+" txtinpid--"+txtinpid);


            var pckId = $('#itemPackageName').val();
            localStorage.setItem("pckId", pckId);

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/upditemsamnt') ?>',
                data: {
                    itemamt: itemamt,
                    txtinpid: txtinpid,
                    pckId: pckId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {

                    if (data == "success") {

                        window.location.href = location.href;
                        $('.fadeMe').hide();
                    } else if (data == "error") {

                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                },
                complete: function() {}
            });

        }
    </script>


    <script type="text/javascript">
        function fnupdateitemdescp(itemdesc, txtinpid) {
            //alert("itemdesc--"+itemdesc+" txtinpid--"+txtinpid);
            var pckId = $('#itemPackageName').val();
            localStorage.setItem("pckId", pckId);


            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/upditemsdescrp') ?>',
                data: {
                    itemdesc: itemdesc,
                    txtinpid: txtinpid
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {

                    if (data == "success") {

                        window.location.href = location.href;

                        $('.fadeMe').hide();
                    } else if (data == "error") {

                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                },
                complete: function() {

                }
            });

        }
    </script>

    <script type="text/javascript">
        function fnupdatepackagetot(ptot) {


            var pckId = $('#itemPackageName').val();

            // alert("ptot--"+ptot+" pckId--"+pckId);


            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/updtpackagetot') ?>',
                data: {
                    ptot: ptot,
                    pckId: pckId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {

                    if (data == "success") {

                        window.location.href = location.href;
                        $('.fadeMe').hide();
                    } else if (data == "error") {

                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                },
                complete: function() {}
            });

        }
    </script>
    <script type="text/javascript">
        function fnupdatepackagedesc(ptot) {


            var pckId = $('#itemPackageName').val();

            // alert("ptot--"+ptot+" pckId--"+pckId);

            localStorage.setItem("pckId", pckId);
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/updtpackagedesc') ?>',
                data: {
                    ptot: ptot,
                    pckId: pckId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    // $('.fadeMe').show();

                },
                success: function(data) {

                    if (data == "success") {

                        window.location.href = location.href;
                        // $('.fadeMe').hide();
                    } else if (data == "error") {

                        // $('.fadeMe').hide();
                    }
                },
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                },
                complete: function() {}
            });

        }
    </script>



    <script type="text/javascript">
        $(document).ready(function() {
            var pckId = localStorage.getItem("pckId");
            //alert("pckId======"+pckId);
            if (pckId != null) {
                //alert("T");
                fngetsinglepckinfo(pckId);

            } else {
                // alert("F");
                var custnm = $('#itemPackageName').val();
                //alert("custnm--"+custnm);
                fngetsinglepckinfo(custnm);
            }

        });
    </script>

    <script type="text/javascript">
        function delete_data(pckId) {
            //alert(pckId);
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Administration/delselpackage') ?>',
                data: {
                    pckId: pckId
                },
                dataType: 'text',
                success: function(data) {
                    window.location.href = location.href;
                }
            });

        }
    </script>


    <script type="text/javascript">
        function fnsearchcustomer() {

            var itemname = $('#itemname').val();
            var itemprice = $('#itemprice').val();
            var pckId = $('#itemPackageName').val();

            if (itemname != "Select" || itemprice != "") {

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Administration/search_pckageitems') ?>",
                    data: {
                        itemname: itemname,
                        itemprice: itemprice,
                        pckId: pckId
                    },
                    dataType: "html",
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();

                    },
                    success: function(data) {
                        // alert(data);
                        if (data != "") {
                            // console.log(data);

                            //$('#tab_data tbody').html(data);
                            $('#pckitems').html(data);
                            $('.fadeMe').hide();


                        } else {
                            //$('#tab_data tbody').html(data);
                            $('#pckitems').html(data);
                            $('.fadeMe').hide();
                        }
                    }
                });

            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Administration/search_allpckageitems') ?>",
                    data: {
                        pckId: pckId
                    },
                    dataType: "html",
                    beforeSend: function() {
                        $('.fadeMe').show();

                    },
                    success: function(data) {
                        if (data != "") {

                            $('#pckitems').html(data);
                            $('.fadeMe').hide();
                        } else {
                            $('#pckitems').html(data);
                            $('.fadeMe').hide();
                        }
                    }
                });
            }
        }
    </script>