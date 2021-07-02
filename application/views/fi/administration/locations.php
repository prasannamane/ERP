<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ERP System | Administration</title>


<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">


<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">


<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">

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
                <li class="active">Locations</li>
            </ol>
        </section>
        <?php $this->load->view('template/alert'); ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <h3 class="uhead1"> <?= $page_title ?></h3>
                                </div>
                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">

                                            <li><a href="#" class="uhead2"> Options </a></li>
                                            <li><button class="btn btn-default"> <i class="fa fa-print"></i></button> </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-info firstblock_bg">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover no-margin">
                                    <thead>
                                        <tr class="uppercse_block">
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th style="width: 23%;">Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Phone No 1 </th>
                                            <th>Phone No 2</th>
                                            <th><i class="fa fa-map-marker" aria-hidden="true"></i></th>
                                            <th>Web Address</th>
                                            <th>Color Code</th>
                                            <th>Note</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <form action="<?= site_url('Administration/inseartlocation') ?>" method="POST" name="lform" id="lform">
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><input type="text" class="form-control" name="l_name" id="id" style="text-transform: capitalize;" required></td>
                                                <td><input type="text" class="form-control" name="l_address" id="id" style="text-transform: capitalize;" required></td>
                                                <td><input style="text-align: center; background-color: #c1c1c1 !important;" type="text" class="form-control" name="l_city" id="l_city" readonly tabindex="-1"></td>
                                                <td><input style="text-align: center; background-color: #c1c1c1 !important;" type="text" class="form-control" name="l_state" id="l_state" readonly tabindex="-1"></td>
                                                <td><input style="text-align: center;" type="number" class="form-control" name="l_zip" id="l_zip" required></td>
                                                <td><input type="text" class="form-control contact_no" name="l_ph_no1" id="ad_l_ph_no1"></td>
                                                <td><input type="text" class="form-control contact_no" name="l_ph_no2" id="ad_l_ph_no2"></td>
                                                <td><input type="text" class="form-control" name="l_direction" id="id"></td>
                                                <td><input type="text" class="form-control" name="l_web_address" id="id"></td>
                                                <td><input type="text" class="form-control" name="l_notes" id="id"></td>
                                                <td><input type="text" class="form-control" name="l_color" id="l_color"></td>
                                                <td>
                                                    <button class="btn btn-xs btn-success tr_clone_save" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="box box-info firstblock_bg">
                        <div class="box-header">
                            <h3 class="uhead2">
                                View Locations
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover no-margin">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th style="width: 23%;">Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Phone No 1</th>
                                            <th>Phone No 2</th>
                                            <th><i class="fa fa-map-marker" aria-hidden="true"></i> </th>
                                            <th>Web Address</th>
                                            <th>Note</th>
                                            <th>Color</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($location as $key) { ?>
                                            <form action="<?= site_url('Administration/editlocatonform') ?>" method="POST" name="elform" id="elform">
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><input type="hidden" value="<?php echo $key['location_id']; ?>" name="latest_loaction_id">
                                                        <input type="text" class="form-control" value="<?php echo $key['location_name']; ?>" name="l_name" id="id">
                                                    </td>
                                                    <td><input type="text" class="form-control" value="<?php echo $key['location_address'] ?>" name="l_address" id="id"></td>
                                                    <td><input style="text-align: center;" type="text" class="form-control" value="<?php echo $key['location_city']; ?>" name="l_city" id="l_city" readonly tabindex="-1"></td>
                                                    <td><input style="text-align: center;" type="text" class="form-control" value="<?php echo $key['location_state']; ?>" name="l_state" id="l_state" readonly tabindex="-1"></td>
                                                    <td><input style="text-align: center;" type="number" class="form-control" value="<?php echo $key['location_zip']; ?>" name="l_zip" id="l_zip"></td>
                                                    <td><input type="text" class="form-control contact_no" value="<?php echo $key['location_phone_one']; ?>" name="l_ph_no1" id="l_ph_no1"></td>
                                                    <td><input type="text" class="form-control contact_no" value="<?php echo $key['location_phone_two']; ?>" name="l_ph_no2" id="l_ph_no2"></td>
                                                    <!--      <td><input type="number" class="form-control" value="<?php// echo $key['location_phone_one'];?>" name="l_ph_no1" id="id"></td> -->
                                                    <td><input type="text" class="form-control" value="<?php echo $key['location_direction']; ?>" name="l_direction" id="id"></td>
                                                    <td><input type="text" class="form-control" value="<?php echo $key['location_web_addres']; ?>" name="l_web_address" id="id"></td>
                                                    <td><input type="text" class="form-control" value="<?php echo $key['location_note']; ?>" name="l_notes" id="id"></td>
                                                    <td><input type="text" class="form-control" value="<?php echo $key['location_color']; ?>" name="l_color" id="id"></td>
                                                    <td>
                                                        <button class="btn btn-xs btn-success tr_clone_save" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                        <a href="<?= site_url('Administration/delete_location/' . $key['location_id']) ?>" onclick="return confirm('Are you sure want to Delete..??')" class="btn btn-xs btn-warning tr_clone_edit"><i class="fa fa-trash"></i></a>
                                                    </td>
                                            </form>
                                            </tr>
                                        <?php  } ?>
                                    </tbody>
                                    </form>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>

                <!--<div class="col-md-7">
              <div class="box box-default">
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Zip Code</th>
                          <th>City</th>
                          <th>State</th>
                          <th>County</th>
                         <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr_clone">
                          <td>1</td>
                          <td><input type="number" class="form-control" name="mane" id="id"></td>
                           <td><select class="form-control" name="name" id="id">
                         				<option value="">Select City</option>
                          				<option value="">Select City</option>
                          				<option value="">Select City</option>
                                   </select>
                          </td>
                          <td><select class="form-control" name="name" id="id">
                          				<option value="">Select State</option>
                          				<option value="">Select State</option>
                          				<option value="">Select State</option>
                                   </select>
                          </td>
                          <td><select class="form-control" name="name" id="id">
                          				<option value="">Select County</option>
                          				<option value="">Select County</option>
                          				<option value="">Select County</option>
                                   </select>
                          </td>
                          <td> <button class="btn btn-xs btn-primary tr_clone_add" title="Add row"><i class="fa fa-plus"></i></button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
        	<div class="col-sm-12">
            			<div class="btns text-center">
                        	<button class="btn btn-lg btn-info btn-flat">Save</button>
                            <button class="btn btn-lg btn-default btn-flat">Cancel</button>
                        </div>
            </div>
        </div>



            </div>-->


                <!--<div class="col-md-5">

              <div class="box box-default">

                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table table-hover no-margin">

                      <thead>

                        <tr>

                          <th>#</th>

                          <th>Username</th>

                          <th>Description</th>

                          <th>Value</th>

                          <th>Action</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr class="tr_clone">

                          <td>1</td>

                          <td> <input type="text" class="form-control" name="mane" id="id"/>  </td>

                          <td> <input type="text" class="form-control" name="mane" id="id"/>  </td>

                          <td><input type="number" class="form-control" name="mane" id="id"/> </td>
						 <td> <button class="btn btn-xs btn-primary tr_clone_add" title="Add row"><i class="fa fa-plus"></i></button></td>
                        </tr>

                      </tbody>

                    </table>

                  </div>


                </div>



              </div>


              <div class="row">
        	<div class="col-sm-12">
            			<div class="btns text-center">
                        	<button class="btn btn-lg btn-info btn-flat">Save</button>
                            <button class="btn btn-lg btn-default btn-flat">Cancel</button>
                        </div>
            </div>
        </div>

            </div>-->


            </div>
        </section>
    </div>
    <script src="<?php echo base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>

    <script type="text/javascript">
        //ERP tr added
        var cnt = 2

        $(document).on('click', '.tr_clone_add', function(rrr) {

            rrr.preventDefault();

            var curt = $(this).parents("table");

            //if(! curt.hasClass('currenttable')) {
            //	 cnt = 2;
            //	 $("table").removeClass("currenttable");
            //	 $(this).parents("table").addClass("currenttable");
            //	}else{ //alert("already have ")
            //	}

            var $tr = $(this).closest('.tr_clone');

            var $clone = $tr.clone();

            $clone.find(':text').val('');
            $clone.find('td:first-child').text(cnt);

            $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()

            //$clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
            $(this).removeClass('btn-primary tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

            //$tr.after($clone);

            $tr.parent("tbody").append($clone);

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
    <script type="text/javascript">
        $('#l_zip').on('change', function() {
            var zip = $("#l_zip").val();
            if (zip != "") {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Fi_home/find_city/') ?>",
                    data: {
                        zip: zip
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data != "") {
                            var appendata = data.custaddrinfo;
                            if (appendata != "") {
                                $.each(appendata, function(appendata, item) {
                                    $("#l_city").val(item.City);
                                    $("#l_state").val(item.State);

                                });


                            } else {

                                $("#l_city").val('');
                                $("#l_state").val('');

                                //alert("Zip code is invalid..!");
                            }

                        } else {

                            $("#l_city").val('');
                            $("#l_state").val('');
                        }



                    }
                });
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
        $(document).ready(function($) {

            $('body ').on("keypress", ".contact_no", function() {
                $(this).mask('(000) 000-0000');
            });

            $(".str").keypress(function(event) {
                var inputValue = event.which;
                if (!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0)) {
                    event.preventDefault();
                }
            });
            $(".num").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))

                {
                    return false;
                }
            });
        });
    </script>