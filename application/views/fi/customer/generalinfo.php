<?php $this->load->view('fi/customer/head'); ?>
<div class="content-wrapper pg_gerneralinfo">
    <section class="content-header">
        <h1>Event Management </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('fi_home/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Customer</a></li>
            <li class="active">General Info</li>
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
            <?php $this->load->view('template/select_customer'); ?>


            <form action="<?= site_url('fi_home/update_coustomer') ?>" method="POST" name="pform" id="pform" onsubmit="return validateForm()">
                <div id="addform"> </div>
            </form>

    </section>
</div>

<div class="fadeMe">
    <div id="loader" class="loader"></div>
</div>

<div class="modal fade email_modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Email Form</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form id="frmsendgeninfomail" name="frmsendgeninfomail" method="post" action="<?= site_url('fi_home/sendgeninfoemail') ?>" enctype="multipart/form-data">
                        <div class="box box-info firstblock_bg ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Email Address:</th>
                                                    <th>Name:</th>
                                                    <th>Type:</th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="nwcustemail" id="nwcustemail" class="form-control" value="" required> </td>
                                                    <td><input type="text" name="txtlcustname" id="txtlcustname" class="form-control" value=""> </td>
                                                    <td> <input type="text" name="txtcusttype" id="txtcusttype" class="form-control" value="Customer"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="box box-primary mt20 secondblock_bg">

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label>Attachments</label>

                                        <input type="file" name="crewavl[]" id="crewavl" multiple="multiple">
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label>Subject</label>
                                    </div>
                                    <div class="col-xs-10">
                                        <input type="text" name="letteremailsub" id="letteremailsub" class="form-control" value="">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label>Body</label>

                                    </div>
                                    <div class="col-xs-10">
                                        <textarea name="letteremaildesc" id="letteremaildesc" rows="6" class="form-control" spellcheck="true"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                    </div>
                                    <div class="col-xs-10 mt20">
                                        <div class="row ">
                                            <div class="col-xs-5">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancel </button>
                                            </div>
                                            <div class="col-xs-3">
                                                <button class="btn btn-primary sendemail">Send Email</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="divchkresponce"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cusgenral_info_two').on('input', function() {});

        $('body').on("click", ".fnchkphoneno", function() {
            var chktyp = $(this).attr('type');
            if (chktyp == "text") {
                alert("Do you want to make it as a default");
                $('.fnchkphoneno').removeAttr('checked');
                $('.fnchkphoneno').val('off');
                $('.fnchkphoneno').attr('type', 'text');
                $(this).parents('.cnt_clone').find('.fnchkphoneno').attr("checked", "checked");
                $(this).parents('.cnt_clone').find('.fnchkphoneno').val('on');
                $(this).parents('.cnt_clone').find('.fnchkphoneno').attr('type', 'checkbox');
            } else if (chktyp == "checkbox") {
                if ($(this).is(":checked")) {
                    alert("Do you want to make it as a default");
                    $('.fnchkphoneno').removeAttr('checked');
                    $('.fnchkphoneno').val('off');
                    $('.fnchkphoneno').attr('type', 'text');
                    $(this).parents('.cnt_clone').find('.fnchkphoneno').attr("checked", "checked");
                    $(this).parents('.cnt_clone').find('.fnchkphoneno').val('on');
                    $(this).parents('.cnt_clone').find('.fnchkphoneno').attr('type', 'checkbox');
                }
            }
        });

        $('body').on("click", ".fnchkemailId", function() {
            var chktyp = $(this).attr('type');
            if (chktyp == "text") {
                alert("Do you want to make it as a default");
                $('.fnchkemailId').removeAttr('checked');
                $('.fnchkemailId').val('off');
                $('.fnchkemailId').attr('type', 'text');
                $(this).parents('.cnt_clone').find('.fnchkemailId').attr("checked", "checked");
                $(this).parents('.cnt_clone').find('.fnchkemailId').val('on');
                $(this).parents('.cnt_clone').find('.fnchkemailId').attr('type', 'checkbox');
            } else if (chktyp == "checkbox") {

                if ($(this).is(":checked")) {

                    alert("Do you want to make it as a default");
                    $('.fnchkemailId').removeAttr('checked');
                    $('.fnchkemailId').val('off');
                    $('.fnchkemailId').attr('type', 'text');
                    $(this).parents('.cnt_clone').find('.fnchkemailId').attr("checked", "checked");
                    $(this).parents('.cnt_clone').find('.fnchkemailId').val('on');
                    $(this).parents('.cnt_clone').find('.fnchkemailId').attr('type', 'checkbox');
                }
            }
        });

    });

    $("body").on('click', ".cnt_clone_add", function() {

        var nxtrowchk = $(this).closest('.cnt_clone').next('.cnt_clone').html();

        if (nxtrowchk == undefined) {
            var $tr = $(this).closest('.cnt_clone');
            var $clone = $tr.clone();

            $clone.find(':text').val('');
            $clone.find(':radio').prop("checked", false);
            $clone.find(':checkbox').prop("checked", false);
            $(this).removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
            $tr.after($clone);
        } else {

            var $tr = $(this).closest('.cnt_clone').next('.cnt_clone');
            var $clone = $tr.clone();

            $clone.find(':text').val('');
            $clone.find(':radio').prop("checked", false);
            $clone.find(':checkbox').prop("checked", false);


            $(this).removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
            $tr.after($clone);
        }
    });


    $(document).on('click', '.cnt_clone_remove', function() {

        var $tr = $(this).closest('.cnt_clone');
        var $clone = $tr.remove();
    });


    $(document).ready(function() {
        var idd = localStorage.getItem("pckId");

        if (idd == "undefined") {

        } else {
            var ls = $("#cuslist_info").find("option[data-value='" + idd + "']").attr("value");
            localStorage.setItem("customer_name", ls);
            $(".cusgenral_info_two").val(ls);
        }
    });

    function loadcityzip(zip) {

        if (zip) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('fi_home/find_city/') ?>",
                data: {
                    zip: zip
                },
                dataType: "json",
                beforeSend: function() {

                    $('.fadeMe').show();

                },
                success: function(data) {
                    //alert("data--"+data);
                    if (data != "") {
                        var appendata = data.custaddrinfo;
                        //alert("appendata--"+appendata);

                        if (appendata != "") {

                            $.each(appendata, function(appendata, item) { //alert("City--"+item.City);

                                $("#city").val(item.City);
                                $("#state").val(item.State);

                                //$('#contact_no').focus();
                                $('#cus_contact_type').focus();

                            });

                            $('.fadeMe').hide();
                        } else {

                            $("#city").val('');
                            $("#state").val('');
                            $('.fadeMe').hide();
                            alert("Zip code is invalid..!");
                            $('#cus_zip').focus();
                        }

                    } else {

                        $("#city").val('');
                        $("#state").val('');
                    }

                }
            });

        } else {
            $("#city").val('');
            $("#state").val('');
        }

    }

    function loadstatecity(zip) {

        if (zip) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('fi_home/find_city/') ?>",
                data: {
                    zip: zip
                },
                dataType: "json",
                beforeSend: function() {

                    $('.fadeMe').show();

                },
                success: function(data) {
                    //alert("data--"+data);
                    if (data != "") {
                        var appendata = data.custaddrinfo;
                        //alert("appendata--"+appendata);
                        if (appendata != "") {

                            $.each(appendata, function(appendata, item) { //alert("City--"+item.City);

                                $("#ship_city").val(item.City);
                                $("#ship_state").val(item.State);

                            });

                            $('.fadeMe').hide();
                        } else {

                            $("#ship_city").val('');
                            $("#ship_state").val('');
                            $('.fadeMe').hide();
                            alert("Zip code is invalid..!");
                        }

                    } else {

                        $("#ship_city").val('');
                        $("#ship_state").val('');
                    }

                }
            });

        }

    }

    $('body').on('change', '#zip, .zip', function() {


        var temp_zip = $(this).parents(".tr_clone").find(".zip");
        var temp_adcity = $(this).parents(".tr_clone").find(".adcity");
        var temp_adstate = $(this).parents(".tr_clone").find(".adstate");
        var zip = temp_zip.val();
        //alert("zip---"+zip);
        if (zip) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('fi_home/find_city/') ?>",
                data: {
                    zip: zip
                },
                dataType: "json",
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {
                    //alert("data--"+data);
                    if (data != "") {
                        var appendata = data.custaddrinfo;
                        // alert("appendata--"+appendata);

                        if (appendata != "") {

                            $.each(appendata, function(appendata, item) { //alert("City--"+item.City);

                                $(temp_adcity).val(item.City);
                                $(temp_adstate).val(item.State);


                            });

                            $('.fadeMe').hide();
                        } else {

                            $(temp_adcity).val('');
                            $(temp_adstate).val('');
                            $('.fadeMe').hide();
                            alert("Zip code is invalid..!");
                            $(temp_zip).focus();
                        }

                    } else {

                        $(temp_adcity).val('');
                        $(temp_adstate).val('');
                    }

                }
            });

        }

    });


    //$('#cus_zip,#zip_codes').keydown(function(event) {
    function fnOnlyNUmbers() {
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {

        } else {

            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();

            }
        }
    }

    function fnresetfrm() {
        var r = confirm("Are you sure want to Clear all Data..??");

        if (r == true) { //alert("T");
            $('#pform')[0].reset();
            //document.getElementById("pform").reset();
        }
    }



    function fnchkbilladdr() {

        if ($('#billaddr').prop("checked") == true) {
            $('#billaddress').slideDown();
            var getzip = $('#cus_zip').val();
            var getcity = $('#city').val();
            var getstate = $('#state').val();
            var getaddr1 = $('#cus_address1').val();
            var getaddr2 = $('#cus_address2').val();
            var cus_fname = $('#cus_fname').val();
            var cu_lname = $('#cus_lname').val();
            $('#zip_codes').val(getzip);
            $('#ship_city').val(getcity);
            $('#ship_state').val(getstate);
            $('#cus_ship_address1').val(getaddr1);
            $('#cus_ship_address2').val(getaddr2);
            $('#billaddr').val("1");
            $('#shipcusname').val(cus_fname + " " + cu_lname);

        } else if ($('#billaddr').prop("checked") == false) {
            // $('#billaddress').slideUp();
            $('#zip_codes').val("");
            $('#ship_city').val("");
            $('#ship_state').val("");
            $('#cus_ship_address1').val("");
            $('#cus_ship_address2').val("");
            $('#billaddr').val("0");
            $('#shipcusname').val("");

        }

    }



    $(document).ready(function($) {
        $('body ').on("keypress", ".contact_no", function() {
            $(this).mask('(000) 000-0000 0000 0000 0000');
        });

        $(".str").keypress(function(event) {

            var inputValue = event.which;
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





    $(document).ready(function($) {



        $("#pform").validate({

            rules: {

                cus_lname: {

                    require_from_group: [1, ".group"]

                },

                cus_com: {

                    require_from_group: [1, ".group"]

                }



            },

            highlight: function(element) {

                $(element).closest('.frm_testimonials').removeClass('success').addClass('error');

            },



            messages: {



                cus_lname: {
                    required: "Please Enter Last Name"
                },

                cus_com: {
                    required: "Please Enter Company name"
                }
            },
        });
    });



    function loadcustlist(id) {
        if (id == 'undefined') {
            var name = id;
        } else {
            var name = <?= $cus_id ?>;
            //alert(name);
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Fi_home/getCustInfo'); ?>",
            data: {
                name: name
            },
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //localStorage.clear();
                var pckId = name;
                //alert("pckId--"+pckId);
                localStorage.setItem("pckId", pckId);
            },
            success: function(data) {
                if (data != "") {
                    // console.log(data);
                    $('#addform').html(data);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
                        data: {
                            name: name
                        },
                        dataType: 'html',
                        beforeSend: function() {
                            //alert("name===="+name);
                        },
                        success: function(data) { //alert(data);
                            if (data != "") {
                                $('.loaduppertabcntdtls').html(data);
                            } else {
                                $('.loaduppertabcntdtls').html(data);
                            }
                        }
                    });
                    $('.fadeMe').hide();
                } else {
                    $('.fadeMe').hide();
                    $('#addform').html(data);
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Fi_home/getCustContactInfo'); ?>",
            data: {
                name: name
            },
            dataType: 'html',
            success: function(data) {
                if (data != "") {
                    //console.log(data);
                    $('#uppertab').html(data);
                    var cu_name = localStorage.getItem("customer_name");
                    // alert("name4 "+ cu_name);
                    $('#cust_nm').val(cu_name);
                } else {
                    $('#uppertab').html(data);
                }
            }
        });
    }

    $(document).ready(function() {
        var pckId = localStorage.getItem("pckId");
        if (pckId == '') {
            pckId = "<?php echo $cus_id; ?>";
        }

        //alert(2);
        //alert(pckId);
        // alert("1st alert..!"+pckId);
        if (pckId == "null" || pckId == "") {
            // alert("else Default");
            var name = $('#cust_nm').val();
            // alert("Default name--"+name)

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getCustInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {
                    if (data != "") {

                        $('#addform').html(data);
                        $('.fadeMe').hide();
                        // localStorage.clear();
                        $('#title').focus();


                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('Fi_home/getSearchCustContactInfo2'); ?>",
                            data: {
                                name: name
                            },
                            dataType: 'html',
                            beforeSend: function() {
                                //alert("name===="+name);
                            },
                            success: function(data) { //alert(data);
                                if (data != "") {
                                    $('.loaduppertabcntdtls').html(data);
                                } else {
                                    $('.loaduppertabcntdtls').html(data);
                                }
                            }
                        });


                    } else {

                        $('.fadeMe').hide();
                        $('#addform').html(data);
                        //localStorage.clear();

                    }

                }

            });

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getCustContactInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                success: function(data) {
                    // alert(data);
                    if (data != "") {
                        $('#uppertab').html(data);
                        //localStorage.clear();
                        var cu_name = localStorage.getItem("customer_name");
                        // alert("name1 "+ cu_name);
                        $('#cust_nm').val(cu_name);

                    } else {
                        $('#uppertab').html(data);
                        //localStorage.clear();

                    }

                }

            });
        } else {

            var name = pckId;
            // if (name !=0) {


            // alert("else_id"+name);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getCustInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {
                    // alert(data);
                    if (data != "") {

                        $('#addform').html(data);
                        $('.fadeMe').hide();
                        //localStorage.clear();

                        $('#title').focus();


                    } else {

                        $('.fadeMe').hide();
                        $('#addform').html(data);
                        //localStorage.clear();

                    }

                }

            });

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getCustContactInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                success: function(data) {
                    // alert(data);
                    if (data != "") {
                        $('#uppertab').html(data);
                        var cu_name = localStorage.getItem("customer_name");
                        // alert("name2 "+ cu_name);
                        $('#cust_nm').val(cu_name);
                        //localStorage.clear();

                    } else {
                        $('#uppertab').html(data);
                        // localStorage.clear();

                    }

                }

            });

            // alert("fdvd localStorage pckId--"+pckId);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
                data: {
                    name: name
                },
                dataType: 'html',
                beforeSend: function() {
                    //alert("name===="+name);
                },
                success: function(data) { //alert(data);
                    if (data != "") {
                        $('.loaduppertabcntdtls').html(data);
                    } else {
                        $('.loaduppertabcntdtls').html(data);
                    }
                }
            });

            // }
        }


    });

    function loadcustlistbyphone(txtphonenum) {

        // alert("txtphonenum--"+txtphonenum);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Fi_home/fnloadcustlistbyphone'); ?>",
            data: {
                txtphonenum: txtphonenum
            },
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {
                //alert(data);
                if (data != "") {
                    $('#addform').html();

                    $('.fadeMe').hide();
                }

            },
            complete: function(data) {

                $('.fadeMe').hide();
                //$('#pform')[0].reset();

            }

        });
    }


    function changecom_name(com_name, cus_id) {
        $.ajax({
            type: 'POST',
            url: '',
            data: {
                cus_id: cus_id
            },
            dataType: 'text',

            beforeSend: function() {
                $('.fadeMe').show();
            },
            success: function(data) {
                // alert("data--"+data);

                if (data != "") {
                    localStorage.setItem("customer_name", data);

                    window.location.href = "<?php echo site_url('fi_home/search_cus') ?>?id=" + cus_id;
                } else {

                }
            },
            error: function(xhr) {
                // $('.fadeMe').hide();
            },
            complete: function() {
                // $('.fadeMe').hide();
            }

        });
    }

    function fndeletecust() {

        var cus_id = $('#cust_nm').val();

        if (!cus_id > 0) {

            cus_id = $('.delete_user').val();

        }
        var r = confirm("Do you want delete this customer..?");
        if (r == true) {

            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/delgencustomer') ?>',
                data: {
                    cus_id: cus_id
                },
                dataType: 'html',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {

                    $('#divchkresponce').html(data);
                    var responce = $('#responce').val();
                    if (responce == "success") {

                        $('.fadeMe').hide();
                        window.location.href = '<?= site_url('fi_home/generalinfo') ?>';
                        var hdntxtcusId = $('#hdntxtcusId').val();
                        //alert("hdntxtcusId--"+hdntxtcusId);
                        var pckId = hdntxtcusId //"227"; //document.getElementById("cust_nm").selectedIndex = "1"; //$('#cust_nm').val();
                        // alert("Before Set pckId--"+pckId);
                        localStorage.setItem("pckId", pckId);


                    } else if (responce == "error") {

                        $('.fadeMe').hide();

                    }

                },
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                },
                complete: function() {
                    // $('.fadeMe').hide();

                    //var pckId= localStorage.getItem("pckId");
                    //alert("After Set CHK localStorage pckId--"+pckId);

                }

            });
        }

    }

    $(document).ready(function($) { //alert("ready");
        $('body').on('keyup', '.cusgenral_info_two', function(event) {
            // alert("fcap");
            var value = $(this).val();
            // alert(value);
            //
            var cust_id = $('#cuslist_info [value="' + value + '"]').data('value');
            // alert(cust_id);
            localStorage.setItem("customer_name", value);
            loadcustlist(cust_id);


        });
        var cu_name = localStorage.getItem("customer_name");
        // alert("name "+ cu_name);
        $('#cust_nm').val(cu_name);
    });

    $(document).ready(function($) {
        $('body').on('click', '.fnpostemail', function(event) {
            $('#nwcustemail').val("");
            var txtemail = $(this).parents(".cnt_clone").find(".txtemail").val();
            var cust_nm = $('.delete_user option:selected').text();
            $('#txtlcustname').val(cust_nm);

            if (txtemail == undefined) {
                var txtemail = $(this).parents(".tr_clone").find(".email9").val();

                console.log(txtemail);

                $('#nwcustemail').val(txtemail);
                if (txtemail == undefined) {
                    $('#nwcustemail').val("");
                }
            } else {
                $('#nwcustemail').val(txtemail);
            }
        });
    });

    $(document).ready(function() {
        //alert("ready");
        var cnt = 2

        $("body").on('click', '.tr_clone_add', function(rrr) {
            rrr.preventDefault();
            //alert(111);
            var tr = $(this).closest('.tr_clone');

            var clone = tr.clone();

            clone.find(':text').val('');
            /*   clone.find('input[type=date]').val('');
               clone.find('input[type=time]').val('');
               */
            //clone.find('td:first-child').text(cnt);

            clone.find('.tr_clone_add').siblings('.tr_save_btn').remove();

            //clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

            $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

            //tr.before(clone);
            tr.after(clone);

            //tr.parent("thead").append(clone);

            cnt++;

        });
    });



    $(document).on('click', '.tr_clone_remove', function() {
        var tr = $(this).closest('.tr_clone');

        $(this).closest('table').addClass("currenttable");
        var alltr = $(this).parents("table.currenttable").find('tr');
        var len = alltr.length - 1;
        var clone = tr.remove();
        if (cnt > 0) {
            cnt--;


        }

    });


    function fndeleteaddicnt(decntlId) {
        //alert(decntlId);
        var r = confirm("Do you want delete this additonal contact..?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/fndeleteaddicntinfo') ?>',
                data: {
                    decntlId: decntlId
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                    //alert("before decntlId--"+decntlId);
                },
                success: function(data) {

                    if (data == "success") {
                        //$("#divfilteraddicnt").load(location.href+" #divfilteraddicnt>*","");
                        //$("#divfilteraddicnt").load(location.href+" #divfilteraddicnt");
                        window.location.href = '<?= site_url('fi_home/generalinfo') ?>';
                        $('.fadeMe').hide();
                    } else if (data == "error") {

                        $('.fadeMe').hide();
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

    $(document).ready(function($) { //alert("ready");
        $('body').on('keyup', '.fcap', function(event) { //alert("fcap");
            var textBox = event.target;
            var start = textBox.selectionStart;
            var end = textBox.selectionEnd;
            textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
            textBox.setSelectionRange(start, end);
        });
    });

    function fnloadadditionalcnt(slectval) {
        var custnm = $('#cust_nm').val();
        // alert("slectval---"+slectval+" custnm---"+custnm);

        $.ajax({
            type: 'POST',
            url: '<?= site_url('fi_home/fnloadadditionalcnt_info') ?>',
            data: {
                custnm: custnm,
                slectval: slectval
            },
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("slectval---"+slectval+" custnm---"+custnm);
            },
            success: function(data) {

                //alert("data--"+data);

                if (data != "") {
                    $("#divfilteraddicnt").html(data);
                    $(".additionalcnt").css('display', 'block');

                    $('.fadeMe').hide();
                } else {

                    $('.fadeMe').hide();
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

    function validateForm() {
        var pckId = localStorage.getItem("pckId");
        //alert("CHK localStorage pckId--"+pckId);
        if (pckId == null || pckId == "") { //alert("NULL");
            var pckId = $('#cus_names').val();
            localStorage.setItem("pckId", pckId);

        } else { //alert("NOT NULL");

            var pckId = localStorage.getItem("pckId");
            //alert("SET localStorage pckId--"+pckId);
        }
        return true;
    }

    $(document).ready(function() {
        $('body').on('change, focusout', '.cusnote', function() {
            var nxtrowchk = $(this).closest('.cnt_clone').next('.cnt_clone').html();
            if (nxtrowchk == undefined) {
                var $tr = $(this).closest('.cnt_clone');
                var $clone = $tr.clone();
                $clone.find(':text').val('');
                $clone.find(':radio').prop("checked", false);
                $clone.find(':checkbox').prop("checked", false);

                //clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()
                //$clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
                $(this).parents('.cnt_clone').find('.btn-success.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
                $tr.after($clone);
            }
        });
    });

    $(document).ready(function() {
        $('body').on('change', '.mailevent', function() { //alert("1");

            $(this).closest('.cnt_clone').find('.contact_no').focus();

        });
    });
</script>

<script type="text/javascript">
    function fnshowcnt() { //alert("1");
        //$('.additionalcnt').show();
        $('.additionalcnt').css('display', 'block');
        $('.additionalcnt-row').css('display', 'table-row');
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('keydown', 'input[type="text"]', function(e) {
            var tdix = $(this).closest('td').index();
            var tdi = Number(tdix) + 1;
            if (e.which === 40) {
                $(this).parents("tr").next("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();
            } else if (e.which === 38) {
                $(this).parents("tr").prev("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();
            }
        });
    });
</script>

<script type="text/javascript">
    $('document').ready(function() { //alert("1");
        //$('#cus_fname,#cus_lname').keydown(function(e) {
        $('body').on('keydown', '#cus_fname,#cus_lname', function(e) { //alert("2");
            if (e.shiftKey || e.ctrlKey || e.altKey) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                    e.preventDefault();
                }
            }
        });
    });
</script>

<script type="text/javascript">
    function ValidateEmail(inputText) {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (inputText.value.match(mailformat)) {
            //document.form1.text1.focus();
            return true;
        } else {
            alert("You have entered an invalid email address!");
            inputText.focus();
            // inputText.value = "";
            return false;
        }
    }


    $(document).ready(function() {

        $('body').on('change', '.txtemail', function() {

            var nxtrowchk = $(this).closest('.cnt_clone').next('.cnt_clone').html();

            if (nxtrowchk == undefined) {

                var $tr = $(this).closest('.cnt_clone');
                var $clone = $tr.clone();

                $clone.find(':text').val('');
                $clone.find(':radio').prop("checked", false);
                $clone.find(':checkbox').prop("checked", false);
                //$clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()
                //$clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
                $(this).parents('.cnt_clone').find('.btn-success.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
                $tr.after($clone);
            }
        });
    });

    $(document).ready(function() {
        cust_search();
    });

    function cust_search() {
        //1 getCustInfo

        var cust_search = $(".cust_search option:selected").val();

        if (cust_search == '') {
            cust_search = 0;
        }
        /*
        Prasanna 
        if(!cust_search > 0) 
        {
            cust_search = "<?php echo $cus_id; ?>";
        }*/

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

        console.log(cust_search);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
            data: {
                name: cust_search
            },
            dataType: 'html',
            success: function(data) {
                if (data != "") {
                    console.log(data);
                    // $('#contact_info').html(data);
                    $('.loaduppertabcntdtls').html(data);
                } else {
                    //$('#contact_info').html("");
                    $('.loaduppertabcntdtls').html("");
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Fi_home/getCustInfo'); ?>",
            data: {
                name: cust_search
            },
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //localStorage.clear();
                var pckId = name;
                //alert("pckId--"+pckId);
                localStorage.setItem("pckId", pckId);
            },
            success: function(data) {
                if (data != "") {
                    // console.log(data);
                    $('#addform').html(data);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
                        data: {
                            name: cust_search
                        },
                        dataType: 'html',
                        beforeSend: function() {
                            //alert("name===="+name);
                        },
                        success: function(data) {
                            //alert(data);
                            if (data != "") {
                                $('.loaduppertabcntdtls').html(data);
                            } else {
                                $('.loaduppertabcntdtls').html(data);
                            }
                        }
                    });
                    $('.fadeMe').hide();
                } else {
                    $('.fadeMe').hide();
                    $('#addform').html(data);
                }
            }
        });
    }

    $(document).ready(function() {
        $("body").on("click", ".btn-box-tool", function() {
            // alert(111);
            $(this).closest(".box").toggleClass("collapsed-box");
            $(this).find(".fa").toggleClass("fa-minus fa-plus");

        });
    });
</script>
<script>
    CKEDITOR.replace('letteremaildesc');
    CKEDITOR.replace('leteremaildesc');
</script>

<a style="display: none" href="<?php echo site_url('fi_home/'); ?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
<script src="<?php echo base_url('assets/'); ?>js/prasanna.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<!-- <?php
        foreach ($custs as $cust) {
            if ($cust['cus_id'] == $cus_id) {
        ?>   
      <script type="text/javascript">
        alert(1);
        cust_search();
      
      </script>
    <?php
            }
        } ?> -->

<?php
/*
    echo $cus_id;
    $this->session->set_userdata('id',$cus_id); */
?>

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