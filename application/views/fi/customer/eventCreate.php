    <?php $this->load->view('fi/customer/head'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Customer</a></li>
                <li class="active">Events</li>
            </ol>
        </section>

        <?php $this->load->view('template/alert'); ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php $this->load->view('template/event_select_customer'); ?>
                    <div class="">
                        <div class="box-body">
                            <form id="createvent" name="createvent_new" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-info firstblock_bg ">
                                            <div class="box-header with-border mb5">
                                                <p class="uhead2">Events</p>
                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="table-responsive" id="myevents">
                                                <table class="table table-hover no-margin fixed_table w1500">
                                                    <thead>
                                                        <tr>
                                                            <th class="w120">Event Type</th>
                                                            <th class="w170">Event Name</th>
                                                            <th class="w80">Date</th>
                                                            <th class="w80">Time</th>
                                                            <th class="w140">Hebrew Date</th>
                                                            <th class="w120">Day</th>
                                                            <th class="w50">Booked</th>
                                                            <th class="w50">Lost</th>
                                                            <th class="w120">Guest</th>
                                                            <th class="w80">End date</th>
                                                            <th class="w80">End Time</th>
                                                            <th class="w130">Referred By</th>
                                                            <th><span class="dblock w250"> Notes </span></th>
                                                            <th class="w50">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <thead>
                                                        <?php
                                                        $eventCount = count($event_data);
                                                        $activeCust = "active-cust";
                                                        if ($eventCount > 0) {
                                                            foreach ($event_data as $events_info) {
                                                                $seteventname   = "";
                                                                $sql            = "SELECT * FROM event_jobs WHERE event_id='" . $events_info['event_id'] . "' ORDER BY event_id ASC  LIMIT 2";
                                                                $chkisjobs      = $this->db->query($sql);
                                                                $chknjobsrows   = $chkisjobs->num_rows();
                                                                if ($chknjobsrows > 1) {
                                                                    foreach ($chkisjobs->result() as $chkisjobs_dtls) {
                                                                        $seteventname .= $chkisjobs_dtls->jb_name . " - ";
                                                                    }
                                                                } else {
                                                                    if ($events_info['event_name'] != "") {
                                                                        $seteventname = $events_info['event_name'];
                                                                    } else {
                                                                        $seteventname = $last_row['cus_lname'];
                                                                    }
                                                                }

                                                                if ($events_info['event_end_date'] != "") {
                                                                    $setenddate = date('m/d/Y', strtotime($events_info['event_end_date']));
                                                                } else {
                                                                    $setenddate = "";
                                                                }

                                                        ?>
                                                                <tr class="tr_clone trshowcust <?= $activeCust ?>" onclick="fnvieweventinfo('<?= $events_info['event_id'] ?>','<?= $events_info['cus_id'] ?>','<?= $events_info['event_date'] ?>','<?= $events_info['event_time'] ?>','<?= $events_info['event_end_date'] ?>','<?= $events_info['event_end_time'] ?>','<?= $events_info['event_type'] ?>')">
                                                                    <td width="100px">
                                                                        <select autofocus class="form-control eventtype updwn" id="" name="event_type[]" onblur="fnupdateventinfo(this.value,'<?= $events_info['event_id'] ?>','event_type')">
                                                                            <option>Choose</option>
                                                                            <?php
                                                                            $activeCust = "";
                                                                            $i = 1;
                                                                            foreach ($event_name as $name) {
                                                                                if ($events_info['event_type'] == $name['sub_name']) {
                                                                                    $evntyesel = "selected";
                                                                                } else {
                                                                                    $evntyesel = "";
                                                                                }
                                                                            ?>
                                                                                <option <?= $evntyesel ?> value="<?php echo $name['sub_name']; ?>"><?php echo $name['sub_name']; ?></option>
                                                                            <?php
                                                                            } ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" id="ename" name="ename[]" value="<?= rtrim($seteventname, " - "); ?>" class="form-control updwn ename" style="text-transform:capitalize;" onchange="fnupdateventinfo(this.value,'<?= $events_info['event_id'] ?>','event_name')">
                                                                    </td>
                                                                    <td><?php
                                                                        if ($events_info['event_date'] != "") {
                                                                            $setstrtdate = date('m/d/Y', strtotime($events_info['event_date']));
                                                                        } else {
                                                                            $setstrtdate = "";
                                                                        } ?>
                                                                        <input type="text" name="edate[]" id="edate" class="form-control  edate updwn events_date check_date_with_db" value="<?= $setstrtdate ?>" placeholder="mm/dd/yyyy">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="etime[]" id="etime" class="dynamic form-control etime my_Time_one_D<?= $events_info['event_id'] ?>" onblur="my_Time_one_D(<?= $events_info['event_id'] ?>)" value="<?= $events_info['event_time'] ?>" placeholder="HH:MM">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="ehdate[]" id="heb_date" class="form-control heb_date" value="<?= $events_info['event_hebrew_date'] ?>" readonly tabindex="-1">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="eday[]" id="eday" class="form-control eday text-center" value="<?= $events_info['event_day'] ?>" readonly tabindex="-1">
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <?php
                                                                            if ($events_info['event_booked'] == 1) { ?>
                                                                                <label><input checked type="checkbox" name="bookedcheck" onchange="fnupdateventinfo('0','<?= $events_info['event_id'] ?>','event_booked')" tabindex="-1"></label>
                                                                            <?php  } else { ?>
                                                                                <label><input type="checkbox" name="bookedcheck" onchange="fnupdateventinfo('1','<?= $events_info['event_id'] ?>','event_booked')" tabindex="-1"></label>
                                                                            <?php  }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <?php
                                                                            if ($events_info['event_lost'] == 1) { ?>
                                                                                <label><input checked type="checkbox" name="lostcheck" onchange="fnupdateventinfo('0','<?= $events_info['event_id'] ?>','event_lost')" tabindex="-1"></label>
                                                                            <?php
                                                                            } else { ?>
                                                                                <label><input type="checkbox" name="lostcheck" onchange="fnupdateventinfo('1','<?= $events_info['event_id'] ?>','event_lost')" tabindex="-1"></label>
                                                                            <?php
                                                                            } ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="eguest[]" class="form-control updwn  event_guest" value="<?= $events_info['event_guest'] ?>" tabindex="-1">
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" name="cuss_id" id="cuss_id" value="<?php echo $last_row['cus_id']; ?>">
                                                                        <input type="hidden" class="hidevntid" name="hidevntid" id="hidevntid" value="<?= $events_info['event_id'] ?>">
                                                                        <input type="text" name="endate[]" id="endate" autocomplete="off" class="form-control  endate updwn" value="<?= $setenddate ?>" tabindex="-1" placeholder="mm/dd/yyyy">
                                                                    </td>
                                                                    <td>
                                                                        <span class="text-center block">
                                                                            <input type="text" name="entime[]" id="entime" class="dynamic2 form-control my_Time_D<?= $events_info['event_id'] ?>" onblur="my_Time_D(<?= $events_info['event_id'] ?>)" value="<?= $events_info['event_end_time'] ?>" tabindex="-1" placeholder="HH:MM">
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control" id="" name="referdby[]" onchange="fnupdateventinfo(this.value,'<?= $events_info['event_id'] ?>','event_referred_by')">
                                                                            <option>Choose</option>
                                                                            <?php
                                                                            $custlist = $this->db->query("SELECT * FROM register_customer ORDER BY cus_id ASC")->result();
                                                                            $vendorlist = $this->db->query("SELECT * FROM register_vendor ORDER BY cus_id ASC")->result();
                                                                            $mearge_data = array_merge($custlist, $vendorlist);
                                                                            foreach ($mearge_data as $custlist_dtls) {
                                                                            ?>
                                                                                <option><?= $custlist_dtls->cus_fname . " " . $custlist_dtls->cus_lname ?></option>
                                                                            <?php  } ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="enote[]" id="enote" class="form-control enote updwn" value="<?= $events_info['event_note'] ?>">
                                                                    </td>
                                                                    <td tabindex="-1">
                                                                        <a onclick="fndelevent('<?= $events_info['event_id'] ?>','<?= $events_info['cus_id'] ?>')" class="btn btn-xs btn-danger" tabindex="-1">
                                                                            <i class="fa fa-minus "></i>
                                                                        </a>
                                                                        <a class="showcust" tabindex="-1" style="cursor: pointer; display: none;" onclick="fnvieweventinfo('<?= $events_info['event_id'] ?>','<?= $events_info['cus_id'] ?>','<?= $events_info['event_date'] ?>','<?= $events_info['event_time'] ?>','<?= $events_info['event_end_date'] ?>','<?= $events_info['event_end_time'] ?>','<?= $events_info['event_type'] ?>')">
                                                                            <i class="fa fa-eye "></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        } ?>
                                                        <tr class="tr_clone trshowcust">
                                                            <td width="100px" tabindex="-1">
                                                                <select tabindex="-1" class="form-control eventypeinfo updwn " name="event_type[]" id="">
                                                                    <option>Choose</option>
                                                                    <?php
                                                                    $i = 1;
                                                                    foreach ($event_name as $name) { ?>
                                                                        <option value="<?php echo $name['sub_name']; ?>"><?php echo $name['sub_name']; ?></option>
                                                                    <?php  } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input tabindex="-1" type="hidden" name="cuss_id" id="cuss_id" value="<?php echo $last_row['cus_id']; ?>">
                                                                <input tabindex="-1" type="text" name="ename[]" value="" class="form-control evntname updwn" style="text-transform:capitalize;">
                                                            </td>
                                                            <td>
                                                                <input tabindex="-1" type="text" name="edate[]" id="lstedate" class="form-control  lstedate updwn" onblur="myDate()" placeholder="mm/dd/yyyy">
                                                            </td>
                                                            <td>
                                                                <input tabindex="-1" type="text" name="etime[]" id="lstetime" class="form-control lstetime my_Time_one" onblur="my_Time_one();" placeholder="HH:MM">
                                                            </td>
                                                            <td>
                                                                <input tabindex="-1" type="text" name="ehdate[]" id="heb_date" class="form-control heb_date updwn">
                                                            </td>
                                                            <td>
                                                                <input tabindex="-1" type="text" name="eday[]" id="eday" class="form-control  eday updwn text-center">
                                                            </td>
                                                            <td>
                                                                <div tabindex="-1" class="checkbox">
                                                                    <label>
                                                                        <input tabindex="-1" type="checkbox" name="bookedcheck"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div tabindex="-1" class="checkbox">
                                                                    <label>
                                                                        <input tabindex="-1" type="checkbox" name="lostcheck"></label>
                                                                </div>
                                                            </td>

                                                            <td><input tabindex="-1" type="text" name="eguest[]" class="form-control updwn"></td>

                                                            <td>
                                                                <input tabindex="-1" type="text" name="endate[]" id="lstendate" class="form-control  lstendate updwn" onblur="myDate()" placeholder="mm/dd/yyyy">
                                                            </td>

                                                            <td>
                                                                <span class="block text-center">
                                                                    <input tabindex="-1" type="text" name="entime[]" id="lstentime" class="form-control lstentime my_Time" onblur="my_Time();" placeholder="HH:MM">
                                                            </td>

                                                            <td>
                                                                <select tabindex="-1" class="form-control" id="referdby" name="referdby[]">
                                                                    <option>Choose</option>
                                                                    <?php
                                                                    $custlist = $this->db->query("SELECT * FROM register_customer ORDER BY cus_id ASC");
                                                                    foreach ($custlist->result() as $custlist_dtls) {
                                                                    ?><option><?= $custlist_dtls->cus_fname . " " . $custlist_dtls->cus_lname ?></option>
                                                                    <?php } ?>
                                                                </select>


                                                            </td>
                                                            <td><input tabindex="-1" type="text" name="enote[]" id="enoteprasanna" class="form-control enoteprasanna updwn"></td>
                                                            <td>
                                                                <div>
                                                                    <button tabindex="-1" onclick="fncrevent()" class="btn btn-xs btn-success tr_clone_add">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="group-outer">
                                    </div>
                                </div>

                                <div class="row" id="btndispsave" style="display: none;">
                                    <div class="col-sm-12">
                                        <div class="btns text-center">
                                            <button tabindex="-1" style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
                                            <button name="Submit" id="Submit" class="btn btn-lg btn-info btn-flat">Save & Continue</button>
                                            <a onclick="fncleareventfrm()" class="btn btn-lg btn-default btn-flat">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
        </section>
        <div class="fadeMe">
            <div id="loader" class="loader"></div>
        </div>
        <div id="hdndiveventsdtls"></div>
        <div id="hdnjobdata" style="display: none;"></div>
        <div id="hdnewevntdata"></div>
        <button style="display: none;" type="button" id="btnmodal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>


        <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">


                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Event Note</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" id="setmodalnotes" cols="" rows="10"></textarea>
                        <input type="hidden" name="hdnnoteval" id="hdnnoteval" class="hdnnoteval">

                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="fnclosemodal()" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on('click', '.tr_clone_add', function(rrr) {
                rrr.preventDefault();

                var tr = $(this).closest('.tr_clone');
                var clone = tr.clone();

                clone.find(':text').val('');
                clone.find('input[type=date]').val('');
                clone.find('input[type=time]').val('');

                $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
                tr.after(clone);
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

        function my_Time() {
            var my_Time = $('.my_Time').val();
            var my_Time_count = my_Time.toString().length;
            var arr = ["00", "00"];

            if (my_Time_count == 4) {
                if (my_Time > 0 && my_Time < 1300) {
                    arr = my_Time.match(/.{1,2}/g);
                    var res = arr[0] + ":" + arr[1] + " PM";
                    $('.my_Time').val(res);
                } else {
                    var num = my_Time - 1200;
                    my_Time = num.toString();
                    var my_Time_count = my_Time.toString().length;
                    if (my_Time_count == 3) {
                        my_Time = '0'.concat(my_Time);
                    }

                    if (my_Time > 0 && my_Time < 1300) {
                        arr = my_Time.match(/.{1,2}/g);
                        var res = arr[0] + ":" + arr[1] + " PM";
                        $('.my_Time').val(res);
                    } else {
                        alert("Time is not correct")
                    }
                }
            } else if (my_Time_count > 4) {

            } else if (my_Time_count > 0) {
                alert("Value should be 4 digit");
            }
        }

        function my_Time_one() {

            var my_Time = $('.my_Time_one').val();
            var my_Time_count = my_Time.toString().length;

            console.log(my_Time);
            console.log(my_Time_count);

            var arr = ["00", "00"];

            var arr1 = ["00", "00"];
            if (my_Time_count == 4) {

                if (my_Time > 0 && my_Time < 1300) {

                    arr = my_Time.match(/.{1,2}/g);
                    console.log(arr[0]);
                    console.log(arr[1]);

                    var res = arr[0] + ":" + arr[1] + " PM";
                    $('.my_Time_one').val(res);

                } else {
                    var num = my_Time - 1200;
                    my_Time = num.toString();

                    var my_Time_count = my_Time.toString().length;

                    if (my_Time_count == 3) {
                        my_Time = '0'.concat(my_Time);
                    }




                    if (my_Time > 0 && my_Time < 1300) {

                        arr1 = my_Time.match(/.{1,2}/g);
                        console.log(arr1[0]);
                        console.log(arr1[1]);

                        var res1 = arr1[0] + ":" + arr1[1] + " PM";
                        $('.my_Time_one').val(res1);


                    } else {
                        alert("Time is not correct");
                    }


                }

            } else if (my_Time_count > 4) {

            } else if (my_Time_count > 0) {
                alert("Value should be 4 digit");
            }
        }


        function my_Time_D(my) {

            var my_Time = $('.my_Time_D' + my).val();
            var my_Time_count = my_Time.toString().length;

            console.log(my_Time);
            console.log(my_Time_count);

            var arr = ["00", "00"];
            if (my_Time_count == 4) {

                if (my_Time > 0 && my_Time < 1300) {

                    arr = my_Time.match(/.{1,2}/g);
                    console.log(arr[0]);
                    console.log(arr[1]);

                    var res = arr[0] + ":" + arr[1] + " PM";
                    $('.my_Time_D' + my).val(res);

                } else {

                    var num = my_Time - 1200;
                    my_Time = num.toString();

                    var my_Time_count = my_Time.toString().length;

                    if (my_Time_count == 3) {
                        my_Time = '0'.concat(my_Time);
                    }

                    if (my_Time > 0 && my_Time < 1300) {

                        arr = my_Time.match(/.{1,2}/g);
                        console.log(arr[0]);
                        console.log(arr[1]);

                        var res = arr[0] + ":" + arr[1] + " PM";
                        $('.my_Time_D' + my).val(res);

                    } else {
                        alert("Time is not correct")
                    }
                }
            } else if (my_Time_count > 4) {

            } else if (my_Time_count > 0) {
                alert("Value should be 4 digit");
            }
        }

        function my_Time_one_D(my) {



            var my_Time = $('.my_Time_one_D' + my).val();


            var my_Time_count = my_Time.toString().length;

            console.log(my_Time);
            console.log(my_Time_count);

            var arr = ["00", "00"];
            if (my_Time_count == 4) {



                if (my_Time > 0 && my_Time < 1300) {


                    arr = my_Time.match(/.{1,2}/g);
                    console.log(arr[0]);
                    console.log(arr[1]);

                    var res = arr[0] + ":" + arr[1] + " PM";
                    $('.my_Time_one_D' + my).val(res);

                } else {
                    var num = my_Time - 1200;
                    my_Time = num.toString();

                    var my_Time_count = my_Time.toString().length;

                    if (my_Time_count == 3) {
                        my_Time = '0'.concat(my_Time);
                    }

                    if (my_Time > 0 && my_Time < 1300) {


                        arr = my_Time.match(/.{1,2}/g);
                        console.log(arr[0]);
                        console.log(arr[1]);

                        var res = arr[0] + ":" + arr[1] + " PM";
                        $('.my_Time_one_D' + my).val(res);

                    } else {
                        alert("Time is not correct")
                    }


                }

            } else if (my_Time_count > 4) {


            } else if (my_Time_count > 0) {
                alert("Value should be 4 digit");
            }
        }


        function myDate() {

            var a = document.getElementById("edate").value;

            var b = document.getElementById("etime").value;

            var c = document.getElementById("endate").value;


            var d = document.getElementById("entime").value;

            $('#strt_time').val(b);
            $('#st_time').val(b);
            $('#str_time').val(b);

            $('#en_time').val(d);

        }

        $(document).ready(function() {


            $("body").on("blur", "#edate, .edate", function(event) {
                event.preventDefault();

                var status = $(this).val();



                var temp_heb_date = $(this).parents(".tr_clone").find(".heb_date");
                var temp_eday = $(this).parents(".tr_clone").find(".eday");
                var temp_error = $(this).parents(".tr_clone").find(".error");
                var temp_eddate = $(this).parents(".tr_clone").find(".edate");
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();



                ValidateDate(status, temp_error, temp_heb_date, temp_eday, temp_eddate, temp_hidevntid);

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("body").on("change", "#loc_name, .loc_name", function() {

                var l_name = $(this).val();
                var cus_names = localStorage.getItem("pckId");
                var temp_loc_add = $(this).parents(".tr_clone").find(".loc_add");
                var temp_loc_city = $(this).parents(".tr_clone").find(".loc_city");
                var temp_loc_state = $(this).parents(".tr_clone").find(".loc_state");
                var temp_loc_zip = $(this).parents(".tr_clone").find(".loc_zip");
                var temp_loc_phone1 = $(this).parents(".tr_clone").find(".loc_phone1");
                var temp_loc_phone2 = $(this).parents(".tr_clone").find(".loc_phone2");
                var temp_loc_loadmap = $(this).parents(".tr_clone").find(".loadmap");
                var tmplocnstdt = $(this).parents(".tr_clone").find(".strt_date");
                console.log(1);
                var evsdate = $('#myevents .active-cust').find(".edate").val();
                var seteventstartdate = "";
                if (evsdate != "") {
                    var splittedDate = splitDate(evsdate);
                    var seteventstartdate = splittedDate[0] + "/" + splittedDate[1] + "/" + splittedDate[2];
                    tmplocnstdt.val(seteventstartdate);
                }
                console.log(2);
                var evstimee = $('#myevents .active-cust').find(".etime").val();
                var tmplocnsttime = $(this).parents(".tr_clone").find("#strt_time");
                tmplocnsttime.val(evstimee);
                var txtshdnevntId = $('.evntlocation').find('.txtshdnevntId').val();
                localStorage.setItem("location_focus", 1);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/single_location_info'); ?>",
                    data: {
                        l_name: l_name,
                        cus_names: cus_names
                    },
                    dataType: "json",
                    success: function(data) {
                        var locs = data.locationlist;
                        if (l_name == "Home") {
                            $.each(locs, function(locs, item) {
                                temp_loc_add.val(item.cus_address1);
                                temp_loc_city.val(item.cus_city);
                                temp_loc_state.val(item.cus_state);
                                temp_loc_zip.val(item.cus_zip);
                                temp_loc_phone1.val('');
                                temp_loc_phone2.val('');
                                temp_loc_loadmap.css('display', 'block');
                                temp_loc_loadmap.attr('href', 'https://maps.google.com/?q=' + item.cus_address1);

                                fncreatelocation(l_name, txtshdnevntId, seteventstartdate, evstimee, item.cus_address1, item.cus_city, item.cus_state, item.cus_zip, cus_names);
                            });

                        } else {

                            $.each(locs, function(locs, item) {

                                temp_loc_add.val(item.location_address);
                                temp_loc_city.val(item.location_city);

                                temp_loc_state.val(item.state_abreviation);
                                temp_loc_zip.val(item.location_zip);
                                temp_loc_phone1.val(item.location_phone_one);
                                temp_loc_phone2.val(item.location_phone_two);

                                temp_loc_loadmap.css('display', 'block');
                                temp_loc_loadmap.attr('href', 'https://maps.google.com/?q=' + item.location_address);

                                fncreatelocation1(l_name, txtshdnevntId, seteventstartdate, evstimee, item.location_address, item.location_city, item.state_abreviation, item.location_zip, item.location_phone_one, item.location_phone_two, cus_names);

                            });

                        }

                        $("#mylocation table tr:nth-last-child(2)").find("#strt_date").focus();

                        $("#crew_loc option[value='" + l_name + "']").attr('selected', 'selected');


                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $("body").on("change", "#loc_name1", function() {


                var l_name = $(this).val();
                var cus_names = localStorage.getItem("pckId");



                var temp_loc_add = $(this).parents(".tr_clone").find(".loc_add");
                var temp_loc_city = $(this).parents(".tr_clone").find(".loc_city");
                var temp_loc_state = $(this).parents(".tr_clone").find(".loc_state");
                var temp_loc_zip = $(this).parents(".tr_clone").find(".loc_zip");
                var temp_loc_phone1 = $(this).parents(".tr_clone").find(".loc_phone1");
                var temp_loc_phone2 = $(this).parents(".tr_clone").find(".loc_phone2");
                var temp_loc_loadmap = $(this).parents(".tr_clone").find(".loadmap");

                var tmplocnstdt = $(this).parents(".tr_clone").find(".strt_date");
                console.log(3);
                var evsdate = $('#myevents .active-cust').find(".edate").val();
                if (evsdate != "") {
                    var splittedDate = splitDate(evsdate);
                    var seteventstartdate = splittedDate[0] + "/" + splittedDate[1] + "/" + splittedDate[2];

                    tmplocnstdt.val(seteventstartdate);
                }

                console.log(4);
                var evstimee = $('#myevents .active-cust').find(".etime").val();
                var tmplocnsttime = $(this).parents(".tr_clone").find("#strt_time");
                tmplocnsttime.val(evstimee);

                var txtshdnevntId = $('.evntlocation').find('.txtshdnevntId').val();




                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/single_location_info'); ?>",
                    data: {
                        l_name: l_name,
                        cus_names: cus_names
                    },

                    dataType: "json",
                    success: function(data) {
                        var locs = data.locationlist;


                        if (l_name == "Home") {

                            $.each(locs, function(locs, item) {

                                temp_loc_add.val(item.cus_address1);
                                temp_loc_city.val(item.cus_city);
                                temp_loc_state.val(item.cus_state);
                                temp_loc_zip.val(item.cus_zip);
                                temp_loc_phone1.val('');
                                temp_loc_phone2.val('');
                                temp_loc_loadmap.css('display', 'block');
                                temp_loc_loadmap.attr('href', 'https://maps.google.com/?q=' + item.cus_address1);


                            });

                        } else {


                            $.each(locs, function(locs, item) {

                                temp_loc_add.val(item.location_address);
                                temp_loc_city.val(item.location_city);

                                temp_loc_state.val(item.state_abreviation);
                                temp_loc_zip.val(item.location_zip);
                                temp_loc_phone1.val(item.location_phone_one);
                                temp_loc_phone2.val(item.location_phone_two);

                                temp_loc_loadmap.css('display', 'block');
                                temp_loc_loadmap.attr('href', 'https://maps.google.com/?q=' + item.location_address);


                                $(tmplocnstdt).focus();

                            });
                        }
                    }
                });

            });
        });
    </script>

    <script type="text/javascript">
        function fncreatelocation1(l_name, txtshdnevntId, seteventstartdate, evstimee, location_address, location_city, location_state, location_zip, location_phone_one, location_phone_two, cus_names) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/fncreatenewlocation'); ?>",
                data: {
                    l_name: l_name,
                    txtshdnevntId: txtshdnevntId,
                    seteventstartdate: seteventstartdate,
                    evstimee: evstimee,
                    location_address: location_address,
                    location_city: location_city,
                    location_state: location_state,
                    location_zip: location_zip,
                    location_phone_one: location_phone_one,
                    location_phone_two: location_phone_two
                },
                dataType: "text",
                beforeSend: function() {
                    $('.fadeMe').show();

                },
                success: function(data) {


                    if (data == "success") {

                        fnvieweventinfo(txtshdnevntId, cus_names);

                        $('.fadeMe').hide();

                    } else {
                        $('.fadeMe').hide();
                    }

                },
                complete: function() {


                }
            });
        }
    </script>


    <script type="text/javascript">
        function fncreatelocation(l_name, txtshdnevntId, seteventstartdate, evstimee, location_address, location_city, location_state, location_zip, cus_names) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/fncreatenewlocation'); ?>",
                data: {
                    l_name: l_name,
                    txtshdnevntId: txtshdnevntId,
                    seteventstartdate: seteventstartdate,
                    evstimee: evstimee,
                    location_address: location_address,
                    location_city: location_city,
                    location_state: location_state,
                    location_zip: location_zip
                },
                dataType: "text",
                beforeSend: function() {
                    $('.fadeMe').show();

                },
                success: function(data) {

                    if (data == "success") {

                        fnvieweventinfo(txtshdnevntId, cus_names);

                        $('.fadeMe').hide();

                    } else {
                        $('.fadeMe').hide();
                    }

                },
                complete: function() {

                }
            });
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#cus_names").on("change", function() {

                var l_name_v = $(this).val();

                var l_name = $('#cuslist_info_event [value="' + l_name_v + '"]').data('value');

                localStorage.setItem("customer_name", l_name_v);

                if (l_name != "") {

                    var pckId = l_name;
                    if (pckId === undefined) {
                        l_name = 0;
                        pckId = "";
                    }

                    localStorage.setItem("pckId", pckId);

                    window.location.href = "<?php echo site_url('fi_home/search_cus') ?>?id=" + l_name;

                    return true;
                } else {
                    return false;
                }

            });
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script type="text/javascript">
        $(document).ready(function($) {
            var cu_name = localStorage.getItem("customer_name");
            $('#cus_names').val(cu_name);
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
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        });

        function gethebrewDate(status, heb_date, teday, temp_hidevntid) {


            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                data: {
                    status: status
                },
                success: function(data) {
                    var str = data;
                    var temp = new Array();

                    temp = str.split(",");

                    heb_date.val(temp[0]);
                    teday.val(temp[1]);

                    fnupdateventinfo(status, temp_hidevntid, 'event_date');
                    fnupdateventinfo(temp[0], temp_hidevntid, 'event_hebrew_date');
                    fnupdateventinfo(temp[1], temp_hidevntid, 'event_day');
                }
            });

        }
    </script>

    <script>
        $(document).ready(function() {
            $("body").on("keydown", "#edate, .edate", function(event) {


                var key = event.keyCode;



                var temp_edate = $(this).parents(".tr_clone").find(".edate");

                var temp_heb_date = $(this).parents(".tr_clone").find(".heb_date");
                var temp_eday = $(this).parents(".tr_clone").find(".eday");
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();

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
                    var today = mm + '/' + dd + '/' + yyyy;
                    var today1 = yyyy + '/' + mm + '/' + dd;


                    temp_edate.val(today);

                    $('#strt_date').val(today);
                    $('#st_date').val(today);
                    $('#str_date').val(today);
                    $('#assostart_date').val(today);

                    gethebrewDate(today, temp_heb_date, temp_eday, temp_hidevntid);
                    event.preventDefault();




                } else if (key == "109" || key == "189") {

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

                    $('#strt_date').val(today);
                    $('#st_date').val(today);
                    $('#str_date').val(today);
                    $('#assostart_date').val(today);



                    gethebrewDate(today, temp_heb_date, temp_eday, temp_hidevntid);
                    event.preventDefault();

                } else if (key == "68") {

                    today = '<?php echo date("m/d/Y"); ?>';
                    temp_edate.val(today);
                    today1 = '<?php echo date("Y/m/d"); ?>';
                    $('#strt_date').val(today);
                    $('#st_date').val(today);
                    $('#str_date').val(today);
                    $('#assostart_date').val(today);



                    gethebrewDate(today, temp_heb_date, temp_eday, temp_hidevntid);
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

                            $('#strt_date').val(today);
                            $('#st_date').val(today);
                            $('#str_date').val(today);
                            $('#assostart_date').val(today);


                            gethebrewDate(today, temp_heb_date, temp_eday, temp_hidevntid);
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
            $("body").on("keydown change", "#strt_date, .strt_date", function(event) {
                var key = event.keyCode;


                var temp_strt_date = $(this).parents(".tr_clone").find(".strt_date");
                var temptime = '';

                if (key == "107" || key == "187") {


                    var dtpls;
                    if (temp_strt_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_strt_date.val());
                    }
                    var today = dtpls;

                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    temp_strt_date.val(today);
                    event.preventDefault();


                } else if (key == "109" || key == "189") {

                    var dtmns;
                    if (temp_strt_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_strt_date.val());
                    }

                    var today = dtmns;

                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    temp_strt_date.val(today);
                    event.preventDefault();

                } else if (key == "68") {

                    var today = new Date();
                    var currenthours = today.getHours();
                    var currentminutes = today.getMinutes();

                    var lencount = currentminutes.toString().length;

                    if (lencount == 1 || lencount == 0) {
                        currentminutes = "0" + currentminutes;
                    }

                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '/' + dd + '/' + yyyy;

                    var currenttime = currenthours + ':' + currentminutes;

                    temp_strt_date.val(today);

                    temptime = currenttime;

                    $(this).parent("td").next("td").find("input").val(currenttime);
                    event.preventDefault();

                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_strt_date.val();


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

                            temp_strt_date.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_strt_date.val("");
                            event.preventDefault();
                        }
                    }
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $("body").on("keydown", "#endate, .endate", function(event) {


                var key = event.keyCode;

                var temp_endate = $(this).parents(".tr_clone").find(".endate");
                var temp_edate = $(this).parents(".tr_clone").find(".edate");
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();


                if (key == "107" || key == "187") {

                    var dtpls;
                    if (temp_endate.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_endate.val());
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

                    var UserDate = today;
                    var ToDate = temp_edate.val(); //new Date();



                    if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {

                        event.preventDefault();

                    } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {

                        temp_endate.val(today);
                        $('#en_date').val(today);

                        fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                        event.preventDefault();

                    } else {

                        temp_endate.val(today);
                        $('#en_date').val(today);
                        fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                        event.preventDefault();
                    }


                } else if (key == "109" || key == "189") {


                    var dtmns;
                    if (temp_endate.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_endate.val());
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



                    var UserDate = today;
                    var ToDate = temp_edate.val(); //new Date();



                    if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {

                        event.preventDefault();

                    } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {

                        temp_endate.val(today);
                        $('#en_date').val(today);
                        fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                        event.preventDefault();

                    } else {

                        temp_endate.val(today);
                        $('#en_date').val(today);
                        fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                        event.preventDefault();
                    }



                } else if (key == "68") {

                    today = '<?php echo date("m/d/Y"); ?>';

                    var UserDate = today;
                    var ToDate = temp_edate.val();



                    if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {

                        event.preventDefault();

                    } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {

                        temp_endate.val(today);
                        $('#en_date').val(today);
                        fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                        event.preventDefault();

                    } else {

                        temp_endate.val(today);
                        $('#en_date').val(today);
                        fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                        event.preventDefault();
                    }

                } else if (key == "8" || key == "46") {

                } else {

                    var UserDate1 = temp_endate.val(); //$('#endate').val();
                    var ToDate1 = new Date();

                    if (new Date(UserDate1).getTime() < ToDate1.getTime()) {

                        $('#en_date').val("");

                    } else {


                        var str = temp_endate.val();


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

                                temp_endate.val(today);

                                fnupdateventinfo(today, temp_hidevntid, 'event_end_date');
                                event.preventDefault();
                            } else {
                                alert("Wrong date.");
                                temp_endate.val("");
                                event.preventDefault();
                            }
                        }
                    }

                }

            });

        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("keydown", "#st_date, .st_date", function(event) {

                var key = event.keyCode;
                //alert("key--"+key);

                var temp_st_date = $(this).parents(".tr_clone").find(".st_date");
                var temp_st_time = $(this).parents(".tr_clone").find(".st_time");
                var temp_en_time = $(this).parents(".tr_clone").find(".en_time");
                var temp_en_date = $(this).parents(".tr_clone").find(".en_date").val();
                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");

                if (key == "107" || key == "187") {

                    var dtpls;
                    if (temp_st_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_st_date.val());
                    }
                    var today = dtpls;

                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    today = yyyy + '-' + mm + '-' + dd;


                    temp_st_date.val(today);

                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date + " " + valuestop;



                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);

                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }

                    }
                    today = mm + '/' + dd + '/' + yyyy;
                    temp_st_date.val(today);
                    event.preventDefault();

                } else if (key == "109" || key == "189") {

                    var dtmns;
                    if (temp_st_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_st_date.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    today = yyyy + '-' + mm + '-' + dd;

                    temp_st_date.val(today);

                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date + " " + valuestop;



                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);

                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }

                    }

                    today = mm + '/' + dd + '/' + yyyy;
                    temp_st_date.val(today);
                    event.preventDefault();
                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;
                    //alert("today--"+today);

                    temp_st_date.val(today);

                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date + " " + valuestop;


                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                        // alert("hrs--"+hrs);
                        //temp_total_hours.val(hrs);
                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }

                    }

                    today = mm + '/' + dd + '/' + yyyy;
                    temp_st_date.val(today);
                    event.preventDefault();

                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_st_date.val();



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

                            today = yy + '-' + mm + '-' + dd;

                            temp_st_date.val(today);

                            var valuestart = temp_st_time.val();
                            var valuestop = temp_en_time.val();

                            if (valuestart != "" && valuestop != "") {
                                const startDate = temp_st_date.val() + " " + valuestart;
                                const endDate = temp_en_date + " " + valuestop;

                                //alert("startDate--"+startDate+" endDate--"+endDate);

                                var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                                var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                                // alert("hrs--"+hrs);
                                //temp_total_hours.val(hrs);
                                if (hrs == 'NAN') {
                                    temp_total_hours.val(0);
                                } else {
                                    temp_total_hours.val(hrs);
                                }

                            }

                            today = mm + '/' + dd + '/' + yy;
                            temp_st_date.val(today);
                            event.preventDefault();

                        } else {
                            alert("Wrong date.");
                            temp_st_date.val("");
                            event.preventDefault();
                        }
                    }
                }

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("keydown", "#en_date, .en_date", function(event) {
                var key = event.keyCode;
                //alert("key--"+key+" invoiceid--"+invoiceid);

                var temp_en_date = $(this).parents(".tr_clone").find(".en_date");
                var temp_st_date = $(this).parents(".tr_clone").find(".st_date");
                var temp_st_time = $(this).parents(".tr_clone").find(".st_time");
                var temp_en_time = $(this).parents(".tr_clone").find(".en_time");
                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");

                if (key == "107" || key == "187") {
                    //alert("date+");
                    //var today = new Date();
                    var dtpls;
                    if (temp_en_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_en_date.val());
                    }
                    var today = dtpls;

                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    today = yyyy + '-' + mm + '-' + dd;
                    //alert("plus today--"+today);

                    temp_en_date.val(today);

                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date.val() + " " + valuestop;

                        //alert("startDate--"+startDate+" endDate--"+endDate);

                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                        // alert("hrs--"+hrs);
                        //temp_total_hours.val(hrs);
                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }

                    }


                    var UserDate = today;
                    var ToDate = temp_st_date.val(); //new Date();

                    // alert("UserDate--"+UserDate+" ToDate--"+ToDate);

                    today = mm + '/' + dd + '/' + yyyy;
                    temp_en_date.val(today);
                    event.preventDefault();


                    if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {
                        //alert('End date is greater than the current date.');
                        //$('#en_date').val("");

                    } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {

                        temp_endate.val(today);


                    } else {

                        temp_endate.val(today);

                    }






                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    //var today = new Date();
                    var dtmns;
                    if (temp_en_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_en_date.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    today = yyyy + '-' + mm + '-' + dd;
                    //alert("minus today--"+today);
                    temp_en_date.val(today);


                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date.val() + " " + valuestop;

                        //alert("startDate--"+startDate+" endDate--"+endDate);

                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                        // alert("hrs--"+hrs);
                        //temp_total_hours.val(hrs);
                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }

                    }


                    var UserDate = today;
                    var ToDate = temp_st_date.val(); //new Date();

                    // alert("UserDate--"+UserDate+" ToDate--"+ToDate);


                    today = mm + '/' + dd + '/' + yyyy;
                    temp_en_date.val(today);
                    event.preventDefault();



                    if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {
                        //alert('End date is greater than the current date.');
                        //$('#en_date').val("");

                    } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {

                        temp_endate.val(today);


                    } else {

                        temp_endate.val(today);

                    }




                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;
                    //alert("plus today--"+today);

                    temp_en_date.val(today);


                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date.val() + " " + valuestop;

                        //alert("startDate--"+startDate+" endDate--"+endDate);

                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                        // alert("hrs--"+hrs);
                        //temp_total_hours.val(hrs);
                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }

                    }


                    var UserDate = today;
                    var ToDate = temp_st_date.val(); //new Date();

                    // alert("UserDate--"+UserDate+" ToDate--"+ToDate);


                    today = mm + '/' + dd + '/' + yyyy;
                    temp_en_date.val(today);
                    event.preventDefault();


                    if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {
                        // alert('End date is greater than the current date.');
                        //$('#en_date').val("");

                    } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {

                        temp_endate.val(today);


                    } else {

                        temp_endate.val(today);

                    }


                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_en_date.val();


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

                            today = yy + '-' + mm + '-' + dd;
                            //alert("plus today--"+today);

                            temp_en_date.val(today);


                            var valuestart = temp_st_time.val();
                            var valuestop = temp_en_time.val();

                            if (valuestart != "" && valuestop != "") {
                                const startDate = temp_st_date.val() + " " + valuestart;
                                const endDate = temp_en_date.val() + " " + valuestop;

                                //alert("startDate--"+startDate+" endDate--"+endDate);

                                var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                                var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                                // alert("hrs--"+hrs);
                                //temp_total_hours.val(hrs);
                                if (hrs == 'NAN') {
                                    temp_total_hours.val(0);
                                } else {
                                    temp_total_hours.val(hrs);
                                }

                            }

                            today = mm + '/' + dd + '/' + yy;
                            temp_en_date.val(today);
                            event.preventDefault();

                            var UserDate = today;
                            var ToDate = temp_st_date.val(); //new Date();

                            if (new Date(UserDate).getTime() < new Date(ToDate).getTime()) {
                                // alert('End date is greater than the current date.');
                                //$('#en_date').val("");

                            } else if (new Date(UserDate).getTime() === new Date(ToDate).getTime()) {
                                temp_endate.val(today);
                            } else {
                                temp_endate.val(today);
                            }




                        } else {
                            alert("Wrong date.");
                            temp_en_date.val("");
                            event.preventDefault();
                        }
                    }
                }

            });

        });
    </script>




    <script type="text/javascript">
        function strdtuniKeyCode(event) {
            var key = event.keyCode;
            //alert("key--"+key);

            if (key == "107" || key == "187") {
                //alert("date+");
                var today = new Date();
                var dd = String(today.getDate() + 1).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

                $('#str_date').val(today);
                $('#castart_date').val(today);


            } else if (key == "109" || key == "189") {
                //alert("date-");
                var today = new Date();
                var dd = String(today.getDate() - 1).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("minus today--"+today);
                $('#str_date').val(today);
                $('#castart_date').val(today);


            } else if (key == "68") {

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

                $('#str_date').val(today);
                $('#castart_date').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');
            }

        }
    </script>


    <script type="text/javascript">
        function assstrdtuniKeyCode(event) {
            var key = event.keyCode;
            //alert("key--"+key+" invoiceid--"+invoiceid);

            if (key == "107" || key == "187") {
                //alert("date+");
                var today = new Date();
                var dd = String(today.getDate() + 1).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

                $('#assostart_date').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');

            } else if (key == "109" || key == "189") {
                //alert("date-");
                var today = new Date();
                var dd = String(today.getDate() - 1).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("minus today--"+today);
                $('#assostart_date').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');


            } else if (key == "68") {

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

                $('#assostart_date').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');
            }

        }
    </script>



    <script type="text/javascript">
        function assenddtuniKeyCode(event) {
            var key = event.keyCode;
            //alert("key--"+key+" invoiceid--"+invoiceid);

            if (key == "107" || key == "187") {
                //alert("date+");
                var today = new Date();
                var dd = String(today.getDate() + 1).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

                $('#assoen_dates').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');

            } else if (key == "109" || key == "189") {
                //alert("date-");
                var today = new Date();
                var dd = String(today.getDate() - 1).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("minus today--"+today);
                $('#assoen_dates').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');


            } else if (key == "68") {

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

                $('#assoen_dates').val(today);

                //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');
            }

        }
    </script>

    <script type="text/javascript">
        function fncleareventfrm() {
            var res = true; //confirm("Are you sure want to Clear all Data..??");
            if (res == true) {
                $('#createvent')[0].reset();
            }

        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#st_time, .st_time", function(event) {

                var temp_st_time = $(this).parents(".tr_clone").find(".st_time");
                var temp_en_time = $(this).parents(".tr_clone").find(".en_time");
                var temp_st_date = $(this).parents(".tr_clone").find(".st_date").val();
                var temp_en_date = $(this).parents(".tr_clone").find(".en_date").val();
                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");

                //get values
                var valuestart = temp_st_time.val();
                var valuestop = temp_en_time.val();


                if (valuestart != "" && valuestop != "") {

                    const startDate = temp_st_date + " " + valuestart;
                    const endDate = temp_en_date + " " + valuestop;

                    var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                    var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                    // alert("hrs--"+hrs);
                    //temp_total_hours.val(hrs);
                    if (hrs == 'NAN') {
                        temp_total_hours.val(0);
                    } else {
                        temp_total_hours.val(hrs);
                    }

                }

            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#en_time, .en_time", function(event) {

                var temp_st_time = $(this).parents(".tr_clone").find(".st_time");
                var temp_en_time = $(this).parents(".tr_clone").find(".en_time");
                var temp_st_date = $(this).parents(".tr_clone").find(".st_date").val();
                var temp_en_date = $(this).parents(".tr_clone").find(".en_date").val();
                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");

                //get values
                var valuestart1 = temp_st_time.val();
                var valuestop1 = temp_en_time.val();

                // alert("temp_st_date--"+temp_st_date+" temp_en_date--"+temp_en_date);


                if (valuestart1 != "" && valuestop1 != "") {
                    //create date format



                    const startDate = temp_st_date + " " + valuestart1;
                    const endDate = temp_en_date + " " + valuestop1;

                    //alert("startDate--"+startDate+" endDate--"+endDate);

                    var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                    var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                    //alert("hrs--"+hrs);
                    if (hrs == 'NAN') {
                        temp_total_hours.val(0);
                    } else {
                        temp_total_hours.val(hrs);
                    }

                }
            });
        });
    </script>



    <script type="text/javascript">
        function fndelevent(eventId, cusId) {
            // alert("eventId--"+eventId+" cusId--"+cusId);

            event.preventDefault();

            var r = true; //confirm("Do you want delete this event..?");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/fndeleventinfo') ?>',
                    data: {
                        eventId: eventId,
                        cusId: cusId
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                        //alert("before invoiceid--"+invoiceid);
                    },
                    success: function(data) {

                        if (data == "success") {
                            $('.fadeMe').hide();
                            $("#myevents").load(location.href + " #myevents");

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
    </script>

    <script type="text/javascript">
        function fndellocation(locId, eventId) {
            //alert("locId--"+locId+" eventId--"+eventId);

            var cus_names = $('#cus_names').val();
            // alert(cus_names);
            event.preventDefault();

            var r = true; //confirm("Do you want delete this location..?");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/fndellocationinfo') ?>',
                    data: {
                        locId: locId,
                        eventId: eventId
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                        //alert("before invoiceid--"+invoiceid);
                    },
                    success: function(data) {

                        if (data == "success") {
                            $('.fadeMe').hide();
                            // $("#mylocation").load(location.href + " #mylocation");

                            fnvieweventinfo(eventId, cus_names);

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
    </script>

    <script type="text/javascript">
        function fndelcrews(crewId, eventId) {
            var cus_names = $('#cus_names').val();
            event.preventDefault();
            var r = true; //confirm("Do you want delete this crews..?");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/fndelcrewsinfo') ?>',
                    data: {
                        crewId: crewId,
                        eventId: eventId
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {

                        if (data == "success") {
                            $('.fadeMe').hide();
                            fnvieweventinfo(eventId, cus_names);

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
    </script>

    <script type="text/javascript">
        function fncleareventfrm() {
            var res = true; //confirm("Are you sure want to Clear all Data..??");
            if (res == true) {
                $('#createvent')[0].reset();
            }

        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change blur", "#enote, .events_date, .enote, .event_guest", function(event) {

                var event_guest = $(this).parents('.tr_clone').find('.event_guest').val(); //$('.event_guest').val();
                var cusid = $(this).parents('.tr_clone').find('#cuss_id').val();
                var eventid = $(this).parents('.tr_clone').find('#hidevntid').val();
                var temp_lostcheck = $(this).parents(".tr_clone").find(".enote");
                var dynamic2 = $(this).parents(".tr_clone").find(".dynamic2").val();
                var dynamic = $(this).parents(".tr_clone").find(".dynamic").val();
                var events_date = $(this).parents(".tr_clone").find(".events_date").val();
                var str = temp_lostcheck.val();

                if (str.length > 35) {
                    var newStr = str.split('.').map(function(el) {
                        el = el.trim();
                        return el.substr(0, 1).toUpperCase() + el.substr(1);
                    }).join('. ');

                    temp_lostcheck.val(newStr.trim());
                    $('#btnmodal').trigger('click');
                    $('#setmodalnotes').html(newStr.trim());
                } else {
                    var newStr = str.split('.').map(function(el) {
                        el = el.trim();
                        return el.substr(0, 1).toUpperCase() + el.substr(1);
                    }).join('. ');

                    var setnotes = newStr.trim();
                    temp_lostcheck.val(setnotes);

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('fi_home/updtevent') ?>',
                        data: {
                            event_guest: event_guest,
                            inptxtval: setnotes,
                            eventid: eventid,
                            fieldnm: "event_note",
                            dynamic: dynamic,
                            dynamic2: dynamic2,
                            events_date: events_date
                        },
                        dataType: 'text',
                        success: function(data) {}
                    });
                }
            });
        });

        function fnclosemodal() {
            var settonotes = $('#setmodalnotes').val();
            console.log(5);
            var eventid = $('#myevents .active-cust').find('#hidevntid').val();
            var newStrdata = settonotes.split('.').map(function(el) {
                el = el.trim();
                return el.substr(0, 1).toUpperCase() + el.substr(1);
            }).join('. ');
            var nwsetnotes = newStrdata.trim();
            $('#enote').val(nwsetnotes);
            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/updtevent') ?>',
                data: {
                    inptxtval: nwsetnotes,
                    eventid: eventid,
                    fieldnm: "event_note"
                },
                dataType: 'text',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data == "success") {
                        $('.fadeMe').hide();
                        window.location.href = "<?= site_url('fi_home/search_new_cus') ?>"
                    } else if (data == "error") {
                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) {},
                complete: function() {}
            });
        }

        $(document).ready(function() {
            $("#sercgcustph").on("change", function() {
                var txtsrchphone = $(this).val();
                var id = $('#cus_names').val();

                //alert("txtsrchphone--"+txtsrchphone+" id--"+id);

                if (txtsrchphone != "") {
                    window.location.href = "<?php echo site_url('fi_home/search_evcustomer') ?>?mobile=" + txtsrchphone + "&id=" + id;

                    return true;
                } else {
                    return false;
                }

            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#lstcrewstype, .lstcrewstype", function(event) {
                var temp_crewstype = $(this).parents(".tr_clone").find(".lstcrewstype");
                var temp_vendtyp = $(this).parents(".tr_clone").find(".vendortype");
                var confrchk = $(this).parents(".tr_clone").find(".confrchk").val();
                var crwtype = temp_crewstype.val();
                var txtshdneventId = $('.evntlocation').find('.txtshdnevntId').val();
                var cus_names = $('#cus_names').val();
                var tmplocnstdt = $(this).parents(".tr_clone").find(".st_date");
                var evsdate = $('#myevents .active-cust').find(".edate").val();
                var splittedDate = splitDate(evsdate);
                var seteventstartdate = splittedDate[2] + "-" + splittedDate[0] + "-" + splittedDate[1];
                tmplocnstdt.val(seteventstartdate);

                var tmplocnenddt = $(this).parents(".tr_clone").find(".en_date");
                var evenddate = $('#myevents .active-cust').find(".endate").val();
                var splittedendDate = splitDate(evenddate);
                var seteventenddate = splittedendDate[2] + "-" + splittedendDate[0] + "-" + splittedendDate[1];
                tmplocnenddt.val(seteventenddate);

                var evstimee = $('#myevents .active-cust').find(".etime").val();
                var tmplocnsttime = $(this).parents(".tr_clone").find(".st_time");
                tmplocnsttime.val(evstimee);

                var evsendtimee = $('#myevents .active-cust').find("#entime").val();
                var tmplocnendtime = $(this).parents(".tr_clone").find(".en_time");
                tmplocnendtime.val(evsendtimee);

                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");
                var temp_st_date = tmplocnstdt.val();
                var temp_en_date = tmplocnenddt.val();
                var valuestart = tmplocnsttime.val();
                var valuestop = tmplocnendtime.val();

                var crews_location = $('.my_last_location3').val();

                if (valuestart != "" && valuestop != "") {
                    const startDate = temp_st_date + " " + valuestart;
                    const endDate = temp_en_date + " " + valuestop;

                    var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                    var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);

                    if (hrs == 'NAN') {
                        temp_total_hours.val(0);
                    } else {
                        temp_total_hours.val(hrs);
                    }
                }

                var tothrs = $(this).parents(".tr_clone").find(".total_hours").val();

                localStorage.setItem("crew_focus", 1);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fninsertcrews'); ?>",
                    data: {
                        txtshdneventId: txtshdneventId,
                        temp_st_date: temp_st_date,
                        temp_en_date: temp_en_date,
                        valuestart: valuestart,
                        valuestop: valuestop,
                        tothrs: tothrs,
                        crwtype: crwtype,
                        crews_location: crews_location
                    },
                    dataType: "text",
                    success: function(data) {
                        fnvieweventinfo(txtshdneventId, cus_names);
                    },
                    complete: function() {}
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#crewstype", function(event) {
                $(this).parents("tr").find(".vendortype").focus();
                var apsubcatID = $(this).val();
                var apsubcat = apsubcatID.split("-")[0];
                var crewsID = apsubcatID.split("-")[1];
                var temp_crewstype = $(this).parents(".tr_clone").find("#crewstype");
                var temp_vendtyp = $(this).parents(".tr_clone").find(".vendortype");
                var crwtype = $('#crewstypelist [value="' + apsubcat + '"]').data('value'); //temp_crewstype.val();

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/getvendorlist') ?>',
                    data: {
                        apsubcat: apsubcat,
                        crewsID: crewsID
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        $(".vendortype" + crewsID).empty();
                        $(".vendortype" + crewsID).html(data);

                    },
                    error: function(xhr) {},
                    complete: function() {
                        $(this).addClass("nxttt");
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function splitDate(date) {
            var result = date.split('/');
            return result;

        }

        function splitDate1(date) {
            var result = date.split('-');
            return result;

        }
    </script>

    <script type="text/javascript">
        function fnvieweventinfo(eventId, cusid, evsdate, evstime, evenddate, evendtime, evntype) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('fi_home/fnloadeventinfo'); ?>",
                data: {
                    eventId: eventId,
                    cusid: cusid,
                    evntype: evntype
                },
                dataType: 'html',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data != "") {
                        $('.group-outer').html(data); //group-outer
                        $('#createvent').attr('action', '<?= site_url('fi_home/addeventinfo') ?>');
                        $('.fadeMe').hide();
                        $('#btndispsave').css('display', 'block');

                        var location_focus = localStorage.getItem("location_focus");
                        if (location_focus == 1) {
                            $("#mylocation table tr:nth-last-child(2)").find("#strt_date").focus();
                        }
                        localStorage.removeItem("location_focus");
                        var crew_focus = localStorage.getItem("crew_focus");
                        if (crew_focus == 1) {
                            $("#mycrews table tr:nth-last-child(2)").find(".vendortype").focus();
                        }
                        localStorage.removeItem("crew_focus");

                        var splittedDate = splitDate(evsdate);
                        var seteventstartdate = splittedDate[2] + "-" + splittedDate[0] + "-" + splittedDate[1];
                        var splittedendDate = splitDate(evenddate);
                        var seteventenddate = splittedendDate[2] + "-" + splittedendDate[0] + "-" + splittedendDate[1];
                        var hidenjbId = $('#myjobs tr:first-child').find('.hidenjbId').val();
                        $('#myjobs tr:first-child').addClass('active-job2');
                        fnviewjobinfo(hidenjbId, eventId, seteventstartdate);
                        loadinvtopinfo(eventId, cusid);
                    }
                },
                complete: function(data) {
                    $('.fadeMe').hide();
                }
            });
        }

        //$(document).ready(function()
        //{
        $('body').on('click', '.showcust', function() {
            console.log(10);
            $('.showcust').parents('.tr_clone').removeClass('active-cust');
            $(this).parents('.tr_clone').addClass('active-cust ');
        });

        $('body').on('click', '.trshowcust', function() {
            console.log(11);
            $('.trshowcust').removeClass('active-cust');
            $(this).addClass('active-cust');
        });
        //});

        function fndelevntjob(jbId, eventId) {
            var cus_names = $('#cus_names').val();
            event.preventDefault();

            var r = true; //  confirm("Do you want delete this job..?");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/fndelevntjobinfo') ?>',
                    data: {
                        jbId: jbId,
                        eventId: eventId
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();

                    },
                    success: function(data) {

                        if (data == "success") {
                            $('.fadeMe').hide();
                            $("#myjobs").load(location.href + " #myjobs");

                            fnvieweventinfo(eventId, cus_names);



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
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '.jbdlclik', function() {
                console.log("2 call Start");
                var cusid = $('#cus_names').val();
                var eventId = $(this).find('.hidevntid').val();
                var jbId = $(this).find('.hidenjbId').val();

                if (cusid == '' || cusid == undefined) {
                    cusid = '<?= $cus_id ?>';
                }

                $('.jbdlclik').removeClass('active-job2');
                $(this).addClass('active-job2');

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('fi_home/fnloadevntjobinfo'); ?>",
                    data: {
                        eventId: eventId,
                        cusid: cusid,
                        jbId: jbId
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data != "") {
                            $('.outer-jobdtls').html(data);
                            $('.fadeMe').show();
                        }
                    },
                    complete: function(data) {
                        $('.fadeMe').show();
                    }
                });
            });
        });


        function fnviewjobinfo(jbId, eventId, seteventstartdate) {
            var cusid = $('#cus_names').val();
            if (cusid == '' || cusid == undefined) {
                cusid = '<?= $cus_id ?>';
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('fi_home/fnloadevntjobinfo'); ?>",
                data: {
                    eventId: eventId,
                    cusid: cusid,
                    jbId: jbId,
                    seteventstartdate: ''
                },
                dataType: 'html',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data != "") {
                        $('.outer-jobdtls').html(data);
                        $('.fadeMe').show();
                    }
                },
                complete: function(data) {
                    $('.fadeMe').show();
                }
            });
        }

        $(document).ready(function() {
            $('body').on('click', '.showjobdetails', function() {
                $('.showjobdetails').parents('.tr_clone').removeClass('active-job2');
                $(this).parents('.tr_clone').addClass('active-job2');
            });
        });

        function fndelevntjobsinfo(jbId, eventId, jbdid) {
            var cus_names = $('#cus_names').val();
            event.preventDefault();
            var r = true; //confirm("Do you want delete this job details..?");
            if (r == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/fndelevntjobs_info') ?>',
                    data: {
                        jbId: jbId,
                        eventId: eventId,
                        jbdid: jbdid
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();

                    },
                    success: function(data) {

                        if (data == "success") {
                            $('.fadeMe').hide();

                            //fnvieweventinfo(eventId,cus_names);
                            //fnviewjobinfo(jbId,eventId);

                            $("#myjobdetils").load(location.href + " #myjobdetils>*", "");



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
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#lstjid2, .lstjid2", function(e) {

                var lstjid2 = $(this).val();
                var cus_names = localStorage.getItem("pckId");

                var temp_jid1 = $(this).parents(".tr_clone").find(".lstjid1");

                var hidevntid = temp_jid1.next().val();
                console.log(14);
                var evnt_name = $('#myevents .active-cust').find('.ename').val();
                var edate = $('#myevents .active-cust').find('.edate').val();



                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fninsertjobinfo'); ?>",
                    data: {
                        evnt_name: evnt_name,
                        lstjid2: lstjid2,
                        hidevntid: hidevntid
                    },
                    dataType: "text",
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {

                        if (data == "success") {


                            fnvieweventinfo(hidevntid, cus_names, edate);
                            $('.fadeMe').hide();
                        } else {
                            $('.fadeMe').hide();
                        }

                    },
                    complete: function() {

                    }
                });


            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#lstjid1, .lstjid1", function() {

                var lstjid2 = "";
                var cus_names = $(this).val();
                var temp_jid1 = $(this).parents(".tr_clone").find(".lstjid1");
                var hidevntid = temp_jid1.next().val();

                var evnt_name = cus_names;
                var custnm = localStorage.getItem("pckId");

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fninsertjobinfo'); ?>",
                    data: {
                        evnt_name: evnt_name,
                        lstjid2: lstjid2,
                        hidevntid: hidevntid
                    },
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data == "success") {


                            $("#myjobs").load(location.href + " #myjobs");
                            fnvieweventinfo(hidevntid, custnm);

                            $('.fadeMe').hide();


                        } else {
                            $('.fadeMe').hide();
                        }

                    },
                    complete: function() {

                    }
                });


            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#lstjid3, .lstjid3", function() {
                // alert('123');
                var lstjid2 = "";
                var cus_names = $(this).val(); //$('#cus_names option:selected').text();
                var temp_jid1 = $(this).parents(".tr_clone").find(".lstjid1");
                var hidevntid = temp_jid1.next().val();

                var custnm = localStorage.getItem("pckId");
                // var custnm= $('#cus_names option:selected').val();

                //alert("cus_names--"+cus_names+" lstjid2--"+lstjid2+" hidevntid--"+hidevntid);
                var evnt_name = cus_names;

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fninsertjobinfonote'); ?>",
                    data: {
                        evnt_name: evnt_name,
                        lstjid2: lstjid2,
                        hidevntid: hidevntid
                    },
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data == "success") {

                            //$("#myjobdetils").load(location.href + " #myjobdetils>*","");
                            $("#myjobs").load(location.href + " #myjobs");

                            fnvieweventinfo(hidevntid, custnm);

                            $('.fadeMe').hide();


                        } else {
                            $('.fadeMe').hide();
                        }

                    },
                    complete: function() {
                        //$('.fadeMe').hide();
                    }
                });


            });
        });
    </script>

    <script type="text/javascript">
        //jQuery.noConflict();
        $(document).ready(function($) { //alert("ready");
            $('body').on('keyup', '.fcap', function(event) { //alert("fcap");
                var textBox = event.target;
                var start = textBox.selectionStart;
                var end = textBox.selectionEnd;
                textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
                textBox.setSelectionRange(start, end);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $("body").on("change", "#jid4, .jid4", function() {
                var value = $(this).val();
                //alert("value--"+value);
                var imprt_name = $('#ejoblst [value="' + value + '"]').data('value');
                var hdneventId = $('#hdneventId').val();
                var rowjbId = $(this).parents('.tr_clone').find('.hidenjbId').val();

                //  alert("rowjbId--"+rowjbId)

                //alert("imprt_name--"+imprt_name);
                //var cus_names= $('#cus_names').val();

                var temp_loc_jid1 = $(this).parents(".tr_clone").find(".jid1");
                var temp_loc_jid2 = $(this).parents(".tr_clone").find(".jid2");
                var temp_loc_jid3 = $(this).parents(".tr_clone").find(".jid3");



                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('fi_home/getimpjobinfo'); ?>",
                    data: {
                        imprt_name: imprt_name,
                        hdneventId: hdneventId
                    },
                    dataType: "json",
                    beforeSend: function() {
                        //alert("Before imprt_name--"+imprt_name);
                    },
                    success: function(data) { //alert(data);
                        var locs = data.jobinfolist;
                        //alert("locs--"+locs);

                        $.each(locs, function(locs, item) {
                            temp_loc_jid1.val(item.jb_name);
                            temp_loc_jid2.val(item.jb_type);
                            //$('#'+temp_loc_jid2+' option[value='+item.jb_type+']').prop('selected', true);
                            //$('select[name="'+temp_loc_jid2+'"] option:selected').val();
                            temp_loc_jid3.val(item.jb_notes);
                            fnupdatejob(item.jb_name, item.jb_type, item.jb_notes, item.jb_import, hdneventId, rowjbId);

                        });

                        //$('#crew_loc option[value='+l_name+']').prop('selected', true);
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#atype, .atype", function(event) {

                var temp_atype = $(this).parents(".tr_clone").find(".atype");
                var temp_availvend = $(this).parents(".tr_clone").find(".cavailvend");
                var crwtype = temp_atype.val();
                //  alert("crwtype--"+crwtype);

                var tmplocnstdt = $(this).parents(".tr_clone").find(".castart_date");
                var evsdate = $('#myevents .active-cust').find(".edate").val();
                var splittedDate = splitDate(evsdate);
                var seteventstartdate = splittedDate[2] + "-" + splittedDate[0] + "-" + splittedDate[1];
                tmplocnstdt.val(seteventstartdate);

                var evstimee = $('#myevents .active-cust').find(".etime").val();
                var tmplocnsttime = $(this).parents(".tr_clone").find("#caastart_time");
                tmplocnsttime.val(evstimee);

                // console.log("vendor_type "+crwtype);
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('fi_home/getvendorlist') ?>',
                    data: {
                        crwtype: crwtype
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                        //alert("before crwtype--"+crwtype);
                    },
                    success: function(data) {
                        // console.log("query "+data);
                        //alert("data--"+data);

                        var appendata = data.vendorlist;
                        // alert("appendata--"+appendata);
                        temp_availvend.html("");

                        if (appendata != "") {
                            var option = $("<option />");
                            option.html("Select");
                            option.val("");
                            temp_availvend.append(option);
                            //temp_availvend.append(option);
                            $.each(appendata, function(i, item) {
                                // console.log("vendor "+item.cus_fname+"-"+item.cus_lname);
                                // alert(item.cus_fname+"-"+item.cus_lname);

                                var option = $("<option />");

                                if (item.cus_fname != "") {
                                    option.html(item.cus_fname + "-" + item.cus_lname);
                                    option.val(item.cus_fname + "-" + item.cus_lname);
                                } else {
                                    option.html(item.cus_lname);
                                    option.val(item.cus_lname);
                                }


                                temp_availvend.append(option);
                            });

                            $('.fadeMe').hide();

                        } else {

                            var option = $("<option />");
                            option.html("No Vendor for type.");
                            temp_availvend.append(option);
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

            });
        });
    </script>


    <script type="text/javascript">
        function fncreatejob(jb_name, jb_type, jb_notes, jb_import, hdneventId, jb_id) {
            //alert(jb_name+"-"+jb_type+"-"+jb_notes+"-"+jb_import+"-"+hdneventId);

            var cus_names = $('#cus_names').val();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/fncreatejob_info') ?>',
                data: {
                    jb_name: jb_name,
                    jb_type: jb_type,
                    jb_notes: jb_notes,
                    jb_import: jb_import,
                    hdneventId: hdneventId,
                    jb_id: jb_id
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                    //alert("hdneventId--"+hdneventId+"jb_id--"+jb_id);
                },
                success: function(data) { //alert("data--"+data);

                    if (data == "success") {
                        $('.fadeMe').hide();
                        $("#myjobs").load(location.href + " #myjobs");

                        fnvieweventinfo(hdneventId, cus_names);

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
    </script>

    <script type="text/javascript">
        function fnupdatejob(jb_name, jb_type, jb_notes, jb_import, hdneventId, jb_id) {
            //alert(jb_name+"-"+jb_type+"-"+jb_notes+"-"+jb_import+"-"+hdneventId+"-"+jb_id);

            var cus_names = $('#cus_names').val();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/fnupdatejob_info') ?>',
                data: {
                    jb_name: jb_name,
                    jb_type: jb_type,
                    jb_notes: jb_notes,
                    jb_import: jb_import,
                    hdneventId: hdneventId,
                    jb_id: jb_id
                },
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                    //alert("hdneventId--"+hdneventId+"jb_id--"+jb_id);
                },
                success: function(data) { //alert("data--"+data);

                    if (data == "success") {
                        $('.fadeMe').hide();
                        $("#myjobs").load(location.href + " #myjobs");

                        fnvieweventinfo(hdneventId, cus_names);

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
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("keydown", "#castart_date, .castart_date", function(event) {
                var key = event.keyCode;
                //alert("key--"+key+" invoiceid--"+invoiceid);
                var temp_castart_date = $(this).parents(".tr_clone").find(".castart_date");

                if (key == "107" || key == "187") {
                    var dtpls;
                    if (temp_castart_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_castart_date.val());
                    }
                    var today = dtpls;
                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    temp_castart_date.val(today);
                    event.preventDefault();

                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    //var today = new Date();
                    var dtmns;
                    if (temp_castart_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_castart_date.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    temp_castart_date.val(today);
                    event.preventDefault();
                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("plus today--"+today);

                    temp_castart_date.val(today);
                    event.preventDefault();
                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_castart_date.val();


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

                            temp_castart_date.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_castart_date.val("");
                            event.preventDefault();
                        }
                    }
                }

            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("keydown", ".jbstart_time", function(event) {
                var key = event.keyCode;
                //alert("key--"+key+" invoiceid--"+invoiceid);

                var jbdId = $(this).parents(".tr_clone").find(".hdntbljobId").val();
                var temp_castart_date = $(this).parents(".tr_clone").find(".jbstart_time");

                if (key == "107" || key == "187") {
                    //alert("date+");
                    //var today = new Date();
                    var dtpls;
                    if (temp_castart_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_castart_date.val());
                    }
                    var today = dtpls;
                    var dd = String(today.getDate() + 1).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;
                    //alert("plus today--"+today);

                    temp_castart_date.val(today);

                    fnupdtejobdtls(today, 'jobs_start_time', jbdId);


                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    //var today = new Date();
                    var dtmns;
                    if (temp_castart_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_castart_date.val());
                    }
                    var today = dtmns;
                    var dd = String(today.getDate() - 1).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;

                    temp_castart_date.val(today);

                    fnupdtejobdtls(today, 'jobs_start_time', jbdId);

                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;
                    //alert("plus today--"+today);

                    temp_castart_date.val(today);

                    fnupdtejobdtls(today, 'jobs_start_time', jbdId);
                }

            });

        });
    </script>




    <script type="text/javascript">
        function ValidateDate(dtValue, temp_error, temp_heb_date, temp_eday, temp_eddate, temp_hidevntid) {
            //alert("2nd--"+dtValue);
            //console.log("2nd--"+dtValue);
            var d = new Date(dtValue);
            var fyer = d.getFullYear();
            //var fmnth= ("0"+ new Date(dtValue).getMonth()).slice(-2);
            //var fdate= ("0"+ new Date(dtValue).getDate()).slice(-2);
            var fmnth = String(d.getMonth() + 1).padStart(2, '0').slice(-2);
            var fdate = String(d.getDate()).padStart(2, '0').slice(-2);

            //alert("fyer--"+fmnth+"/"+fdate+"/"+fyer);
            //var trimmed = dtValue.replace(/\b0+/g, "");

            //var trimmed = fmnth+"/"+fdate+"/"+"20"+fyer;
            var trimmed = "20" + fyer + "-" + fmnth + "-" + fdate;
            //alert("trimmed---"+trimmed);
            var newdate = trimmed; //'02/07/2019';
            var status = newdate;
            //alert("newdate--"+newdate);

            //var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
            var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
            //return dtRegex.test(newdate);
            var chkvdate = dtRegex.test(status);
            //alert("chkvdate--"+chkvdate);
            if (chkvdate == true) { //alert("3rd--"+newdate);
                //console.log("3rd--"+newdate);

                temp_error.css('display', 'none');

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                    data: {
                        status: status
                    },
                    beforeSend: function() {


                    },
                    success: function(data) {
                        var str = data;
                        var temp = new Array();
                        // $("#state").append(data);
                        // console.log(data);
                        // alert(data);
                        temp = str.split(",");


                        // alert(temp[0]);
                        //alert(temp[1]);

                        temp_heb_date.val(temp[0]);
                        temp_eday.val(temp[1]);
                        temp_eddate.val(newdate);



                        //alert(newdate+"--"+temp_hidevntid+"--"+'event_date');


                        fnupdateventinfo(newdate, temp_hidevntid, 'event_date');
                        fnupdateventinfo(temp[0], temp_hidevntid, 'event_hebrew_date');
                        fnupdateventinfo(temp[1], temp_hidevntid, 'event_day');


                    },
                    complete: function() {
                        // $('.fadeMe').hide();
                        // temp_eddate.val(newdate);


                    }
                });

            } else { //alert("Invalid Date");
                //temp_error.css('display','block');
                // event.preventDefault();
            }

        }
    </script>

    <script type="text/javascript">
        function ChangeFormateDate(oldDate) {
            return oldDate.toString().split("/").reverse().join("/");
        }
    </script>


    <script>
        $(document).ready(function() {
            $("body").on("blur", "#endate, .endate", function(event) {

                var status = $(this).val();

                var temp_error = $(this).parents(".tr_clone").find(".error1");
                var temp_endate = $(this).parents(".tr_clone").find(".endate");
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();

                ValidateEndDate(status, temp_error, temp_endate, temp_hidevntid);


            });
        });
    </script>


    <script type="text/javascript">
        function ValidateEndDate(dtValue, temp_error, temp_endate, temp_hidevntid) {


            var d = new Date(dtValue);
            var fyer = d.getFullYear();
            var fmnth = String(d.getMonth() + 1).padStart(2, '0').slice(-2);
            var fdate = String(d.getDate()).padStart(2, '0').slice(-2);



            //alert("fyer--"+fmnth+"/"+fdate+"/"+fyer);
            //var trimmed = dtValue.replace(/\b0+/g, "");

            //var trimmed = fmnth+"/"+fdate+"/"+"20"+fyer;
            var trimmed = "20" + fyer + "-" + fmnth + "-" + fdate;
            //alert("trimmed---"+trimmed);
            var newdate = trimmed; //'02/07/2019';
            //alert("newdate--"+newdate);

            //var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
            var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
            //return dtRegex.test(newdate);
            var chkvdate = dtRegex.test(newdate);
            //alert("chkvdate--"+chkvdate);
            if (chkvdate == true) { //alert("newdate--"+newdate);

                temp_error.css('display', 'none');
                temp_endate.val(newdate);

                fnupdateventinfo(newdate, temp_hidevntid, 'event_end_date');

            } else { //alert("Invalid Date");
                //temp_error.css('display','block');
                //event.preventDefault();
            }

        }
    </script>



    <!--  Create New Event -->
    <script type="text/javascript">
        function fncrevent() {

            var customrId = $('#cus_names').val();
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/fncrnewevent') ?>',
                data: {
                    customrId: customrId
                },
                dataType: 'html', //text
                cache: false,
                async: false,
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                },
                success: function(data) {

                    $('#hdndiveventsdtls').html(data);

                    var responce = $('#responce').val();
                    //alert("responce--"+responce);
                    if (responce == "success") {
                        //window.location.href='<?//=site_url('fi_home/custinvoices')?>';

                        window.location.href = '<?= site_url('fi_home/search_new_cus') ?>';

                    } else if (responce == "error") {

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

        function fnupdateventinfo(inptxtval, eventid, fieldnm) {
            var dynamic = $(".my_Time_one_D" + eventid).val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/updtevent') ?>',
                data: {
                    eventid: eventid,
                    inptxtval: inptxtval,
                    fieldnm: fieldnm,
                    dynamic: dynamic
                },
                dataType: 'text',
                cache: false,
                async: false,
                success: function(data) {

                }
            });
        }
    </script>

    <!-- End Update Event -->


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("blur", "#etime, .etime", function(event) {
                //alert("Call"+$(this).val());
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();

                var getcrtime = $(this).val();
                var timeString = $(this).val(); //"18:00:00";
                var H = +timeString.substr(0, 2);
                var h = (H % 12) || 12;
                var ampm = H < 12 ? "AM" : "PM";
                timeString = h + timeString.substr(2, 3) + " " + ampm;


                var newtime = timeString; //"12:45PM";
                var re = /^\d{1,2}:\d{2} ([AP]M)?$/;
                var chkvtime = re.test(newtime);
                // alert("chkvtime--"+chkvtime);
                if (chkvtime == true) {
                    // alert("Valid"+temp_hidevntid);
                    fnupdateventinfo(getcrtime, temp_hidevntid, 'event_time');
                } else {
                    //alert("Invalid");
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#entime, .entime", function(event) {
                //alert("Call"+$(this).val());
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();

                var getendtime = $(this).val();
                var timeString = $(this).val(); //"18:00:00";
                var H = +timeString.substr(0, 2);
                var h = (H % 12) || 12;
                var ampm = H < 12 ? "AM" : "PM";
                timeString = h + timeString.substr(2, 3) + " " + ampm;


                var newtime = timeString; //"12:45PM";
                var re = /^\d{1,2}:\d{2} ([AP]M)?$/;
                var chkvtime = re.test(newtime);
                //alert("chkvtime--"+chkvtime);
                if (chkvtime == true) {
                    //alert("Valid"+newtime);
                    fnupdateventinfo(getendtime, temp_hidevntid, 'event_end_time');
                } else {
                    //alert("Invalid");
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function($) {
            $('body').on('click', '.fnpostemailinfo', function(event) {

                //$('#nwcustemail').val("");
                var ltype = $('#lettertypes').val();
                //alert("ltype--"+ltype);
                var cus_names = $('#cus_names option:selected').text();


                var voldattchment = '<?= site_url('/uploads/letters_attachments/') ?>';

                //alert("txtemail--"+txtemail);
                if (ltype == "") {
                    //$('#nwcustemail').val("");
                } else {

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('fi_home/getletterinfo') ?>',
                        data: {
                            ltype: ltype
                        },
                        dataType: 'json',
                        cache: false,
                        async: false,
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("before eventid--"+eventid);
                        },
                        success: function(data) {

                            if (data != "") {


                                var appendata = data.lettersinfo;
                                //alert("appendata--"+appendata);
                                $.each(appendata, function(appendata, item) {
                                    //alert(item.name+"--"+item.desc);
                                    $('#leteremailsub').val(item.name);
                                    //$('#leteremaildesc').val(item.desc);
                                    //$('#leteremaildesc').val(getPlainText(item.desc));
                                    $('#leteremaildesc').val(item.desc);
                                    $('#flname').val(item.attachment);
                                    //alert(item.attachment);
                                    if (item.attachment == null || item.attachment == "") {
                                        $('#flattchment').removeAttr('href');
                                    } else {

                                        $('#flattchment').attr('href', voldattchment + item.attachment);
                                    }


                                });
                                //alert("cus_names--"+cus_names);
                                $('#ltxtlcustname').val(cus_names);

                                $('.fadeMe').hide();

                                fnsetletterscustomhtml();

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

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('change', '.eventypeinfo', function() {
                var customrId = localStorage.getItem("pckId");
                if (customrId == 'null' || customrId == '' || customrId == 0) {
                    customrId = $("select[name = cus_notes]").val();
                }

                if (customrId == 'null' || customrId == '' || customrId == 0) {
                    alert("Please Select customer..!");
                    window.location.href = '<?= site_url('fi_home/search_new_cus') ?>';
                } else {
                    var fieldnm = "event_type";
                    var inptxtval = $(this).parents('.tr_clone').find('.eventypeinfo').val();
                    var evntname = $(this).parents('.tr_clone').find('.evntname').val();
                    event.preventDefault();
                    customrId = $("select[name = cus_notes]").val();

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('fi_home/newinrtevent') ?>',
                        data: {
                            inptxtval: inptxtval,
                            fieldnm: fieldnm,
                            customrId: customrId,
                            evntname: evntname
                        },
                        dataType: 'html',
                        cache: false,
                        async: false,
                        beforeSend: function() {
                            $('.fadeMe').show();
                        },
                        success: function(data) {
                            $('#hdnewevntdata').html(data);
                            var responce = $('#responce').val();
                            var nwhdnevntId = $('#nwhdnevntId').val();

                            if (responce == "success") {
                                window.location.href = '<?= site_url('fi_home/search_new_cus') ?>';
                                $('.fadeMe').hide();
                            } else if (responce == "error") {
                                $('.fadeMe').hide();
                            }
                        },
                        error: function(xhr) {},
                        complete: function() {}
                    });
                }
            });
        });

        $(document).ready(function($) {
            $('body').on('click', '.fnviewinfo', function(event) {

                //$('#nwcustemail').val("");
                var ltype = $('#lettertypes').val();
                //alert("ltype--"+ltype);
                var cus_names = $('#cus_names option:selected').text();

                //alert("txtemail--"+txtemail);
                if (ltype == "") {
                    //$('#nwcustemail').val("");
                } else {

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('fi_home/getletterinfo') ?>',
                        data: {
                            ltype: ltype
                        },
                        dataType: 'json',
                        cache: false,
                        async: false,
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("before eventid--"+eventid);
                        },
                        success: function(data) {

                            if (data != "") {


                                var appendata = data.lettersinfo;
                                //alert("appendata--"+appendata);
                                $.each(appendata, function(appendata, item) {
                                    //alert(item.name+"--"+item.desc);
                                    //$('#letteremailsub').val(item.name);
                                    $('#lemaildesc').html(item.desc);

                                });
                                //alert("cus_names--"+cus_names);
                                //$('#txtlcustname').val(cus_names);

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

            });
        });
    </script>


    <!-- Modal -->
    <div id="viewModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View</h4>
                </div>
                <div class="modal-body">
                    <p id="lemaildesc"></p>
                </div>
                <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
            </div>

        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function($) {
            $('body').on('click', '.sendmail', function(event) {

                var nwcustemail = $('#lnwcustemail').val();

                if (nwcustemail != "") {
                    var letteremailsub = $('#leteremailsub').val();
                    var letteremaildesc = $('#leteremaildesc').val();
                    var flname = $('#flname').val();

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('fi_home/sendeventletteremail') ?>',
                        data: {
                            nwcustemail: nwcustemail,
                            letteremailsub: letteremailsub,
                            letteremaildesc: letteremaildesc,
                            flname: flname
                        },
                        dataType: 'text',
                        // cache: false,
                        // async: false,
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("letteremaildesc--"+letteremaildesc);
                        },
                        success: function(data) {

                            if (data == "success") {
                                $('.fadeMe').hide();
                                window.location.href = '<?= site_url('fi_home/search_new_cus') ?>';

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
                } else {
                    alert("Please Enter Email..!");
                    $('#lnwcustemail').focus();
                }



            });
        });
    </script>






    <!-- myModal2 -->

    <div class="modal fade email_modal " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Email Form</h4>
                </div>
                <div class="modal-body">


                    <div class="box-body">

                        <form id="frmsendcrewmail" name="frmsendcrewmail" method="post" action="<?= site_url('fi_home/sendcrewavlemail') ?>" enctype="multipart/form-data">

                            <div class="box box-info secondblock_bg ">
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

                                                    <?php //
                                                    $user_ = $user_name[0];

                                                    $userName = $user_['cus_fname'] . " " . $user_['cus_lname'];
                                                    foreach ($user_contact_info as $row) {


                                                    ?>
                                                        <tr>


                                                            <td><input type="text" name="nwcustemail" id="nwcustemail" class="form-control" value="<?= $row['email'] ?>" required readonly> </td>
                                                            <td><input type="text" name="txtlcustname" id="txtlcustname" class="form-control" value="<?= $userName ?>" readonly> </td>
                                                            <td><input type="text" name="txtcusttype" id="txtcusttype" class="form-control" value="Customer" readonly></td>

                                                        </tr>
                                                    <?php

                                                    }



                                                    ?>







                                                </thead>

                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>


                            <div class="box box-info firstblock_bg ">
                                <div class="row">
                                    <div class="col-xs-2">

                                    </div>
                                    <div class="col-xs-10">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <label>Max Recipients </label>
                                            </div>

                                            <div class="col-xs-3">
                                                <input type="number" value="50" name="max_rec[]" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>




                            <div class="box box-primary mt20 thirdblock_bg ">
                                <!--<p class="uhead2 pt10">Payment Applied To</p>-->
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label>Attachments</label>

                                            <!--  <button type="button" class="btn btn-default btn-xs">Add Attachment</button> -->

                                            <input type="file" name="crewavl[]" id="crewavl" multiple="multiple">

                                        </div>


                                    </div>
                                    <!-- /.box -->

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

                                            <!--   <button type="button" class="btn btn-default btn-xs">Check Spelling</button> -->

                                        </div>
                                        <div class="col-xs-10">
                                            <!--   <div id="letteremaildesc" contenteditable="true" class="form-control" spellcheck="true"></div> -->
                                            <textarea name="letteremaildesc" id="letteremaildesc" rows="6" class="form-control" spellcheck="true"></textarea>


                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-xs-2">

                                        </div>
                                        <div class="col-xs-10 mt20">
                                            <div class="row ">
                                                <div class="col-xs-6">

                                                </div>

                                                <div class="col-xs-6">
                                                    <button class="btn btn-primary sendemail pull-right">Send Email</button>
                                                    <button type="button" class="btn btn-primary pull-right mr10" data-dismiss="modal" aria-label="Close">Cancel </button>
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



    <!-- myModal1 -->


    <div class="modal fade email_modal " id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Email Form</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">

                        <form id="frmsendemailetter" name="frmsendemailetter" method="post" action="<?= site_url('fi_home/sendletteremail') ?>" enctype="multipart/form-data">


                            <div class="box box-info firstblock_bg ">
                                <div class="row">

                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <label>Max Recipients </label>
                                            </div>

                                            <div class="col-xs-3">
                                                <input type="number" value="50" name="max_rec[]" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>


                            <div class="box box-info secondblock_bg ">
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

                                                        <td><input type="text" name="lnwcustemail" id="lnwcustemail" class="form-control" value="" required> </td>
                                                        <td><input type="text" name="ltxtlcustname" id="ltxtlcustname" class="form-control" value=""> </td>
                                                        <td> <input type="text" name="ltxtcusttype" id="ltxtcusttype" class="form-control" value="Customer"></td>

                                                    </tr>


                                                </thead>

                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="box box-info thirdblock_bg ">
                                <div class="box box-primary mt20">
                                    <!--<p class="uhead2 pt10">Payment Applied To</p>-->
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Attachments</label>
                                                <input type="file" name="limg[]" id="limg" multiple="multiple">

                                            </div>
                                            <div class="col-xs-10">
                                                <div class="table-responsive">

                                                    <table class="table table-hover no-margin">

                                                        <thead>

                                                            <tr>

                                                                <th width="60%">File Name</th>
                                                                <th>View</th>
                                                                <th>Remove</th>

                                                            </tr>


                                                            <tr class="tr_clone">

                                                                <td>
                                                                    <input type="text" name="flname" id="flname" class="form-control" placeholder="file name ">
                                                                </td>
                                                                <td>
                                                                    <a id="flattchment" style="cursor: pointer;" class="btn btn-xs btn-default cnt_clone_add" target="_blank"><i class="fa fa-eye"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-xs btn-danger tr_clone_remove"><i class="fa fa-minus"></i></a>
                                                                </td>

                                                            </tr>

                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box -->

                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Subject</label>

                                            </div>
                                            <div class="col-xs-10">
                                                <input type="text" name="leteremailsub" id="leteremailsub" class="form-control" value="">
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Body</label>

                                                <!--  <button type="button" class="btn btn-default btn-xs">Check Spelling</button> -->

                                            </div>
                                            <div class="col-xs-10">
                                                <textarea name="leteremaildesc" id="leteremaildesc" rows="6" class="form-control" spellcheck="true"></textarea>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-xs-2">

                                            </div>
                                            <div class="col-xs-10 mt20">
                                                <div class="row ">
                                                    <div class="col-xs-5">

                                                    </div>

                                                    <div class="col-xs-6">
                                                        <button class="btn btn-primary sendemail pull-right">Send Email</button>
                                                        <button type="button" class="btn btn-primary mr10 pull-right" data-dismiss="modal" aria-label="Close">Cancel </button>
                                                    </div>

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

    <script type="text/javascript">
        $(document).ready(function($) {
            $('body').on('click', '.fnpostcrewemailinfo', function(event) {

                var cus_names = $('#cus_names option:selected').text();
                var castart_date = $('#castart_date').val();
                var st_time = $('#st_time').val();
                var endate = $('#endate').val();
                var entime = $('#entime').val();
                var evtype = $('#txthdnevntsype').val(); //$('#event_type option:selected').val();
                var templ_typ = $(this).parents('.tr_clone').find('.crwstemptyp option:selected').val();
                //alert("templ_typ--"+templ_typ);

                if (templ_typ == "") {
                    //$('#nwcustemail').val("");
                    $('#letteremailsub').val("");
                    $('#letteremaildesc').val("");

                } else {

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('fi_home/getcrewavailabilityinfo') ?>',
                        data: {
                            templ_typ: templ_typ
                        },
                        dataType: 'json',
                        cache: false,
                        async: false,
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("before templ_typ--"+templ_typ);
                        },
                        success: function(data) {

                            if (data != "") {
                                var appendata = data.crewsavlinfo;
                                //alert("appendata--"+appendata);
                                $.each(appendata, function(appendata, item) {
                                    //alert(item.name+"--"+item.desc);
                                    $('#letteremailsub').val(item.name);
                                    //$('#letteremaildesc').val(getPlainText(item.desc)+"\n Date: "+castart_date+" "+st_time+"\n Type: "+evtype+"\n Expected Ending: "+endate);

                                    //$('#letteremaildesc').val(getPlainText(item.desc));
                                    $('#letteremaildesc').val(item.desc);

                                    //CKEDITOR.instances.editor1.setData(item.desc);


                                });
                                //alert("cus_names--"+cus_names);
                                $('#txtlcustname').val(cus_names);

                                $('.fadeMe').hide();

                                fnsetcustomhtml();

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


            });
        });
    </script>



    <script type="text/javascript">
        function loadinvtopinfo(eventId, cusid) {
            //alert("eventId--"+eventId);






            $.ajax({
                type: "POST",
                url: "<?= base_url('Fi_home/getSearchCustContactInfo'); ?>", //getSearchInvoiceInfo
                data: {
                    eventId: eventId,
                    cusid: cusid,
                    name: cusid
                },
                dataType: 'html',
                beforeSend: function() {
                    //alert("eventId===="+eventId);
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
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("click", "#confrchk, .confrchk", function(event) {

                //var cus_names=$('#cus_names').val();
                var temp_confrchk = $(this).parents(".tr_clone").find(".confrchk");

                if (temp_confrchk.prop("checked") == true) {
                    // alert("Checkbox is checked.");

                    //$('#myModalconchk').modal('show');
                    $('.th_content').css('display', 'block');

                    $('.confirmdon').css('display', 'table-cell');
                    //$(this).parents('.tr_clone').find('.tdconfirmdon').css('display','table-cell');
                    $(this).parents('.tr_clone').find('.tdconfirmdon').css('display', 'block');

                    $(this).parents('.tr_clone').find('.tdconfirmdon input').css('display', 'block');

                    $(this).parents('.tr_clone').find('.tdconfirmdon select').css('display', 'block');
                    //$(this).parents('.tr_clone').find('.crwcnttype').css('display','block');
                    $(this).parents('.tr_clone').find('.crwcnttype').css('display', 'block');
                    $(this).parents('.tr_clone').find('.crwcnttype select').css('display', 'block');


                } else if (temp_confrchk.prop("checked") == false) {
                    //alert("Checkbox is unchecked.");
                    $(this).parents('.tr_clone').find('.tdconfirmdon').css('display', 'none');
                    $(this).parents('.tr_clone').find('.crwcnttype').css('display', 'none');

                    $('.th_content').css('display', 'none');
                }
            });

        });
    </script>

    <!-- <script type="text/javascript">
$(window).on('load',function(){
     $('#mycrews').parents('.tr_clone ').find('.tdconfirmdon').css('display','none');
    // $('#mycrews').parents('.tr_clone').find('.crwcnttype').css('display','none');
});
</script> -->

    <!-- Modal -->
    <div id="myModalconchk" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crew Confirmation</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="confirmed_on[]" placeholder="mm/dd/yyyy" class="form-control confirmedon w95" value="" form="">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="crewscntcttype[]" id="crewscntcttype" form="">
                            <option>Email</option>
                            <option>Sms</option>
                            <option>Whatsapp</option>
                            <option>Phone</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        function locationupdate(id) {
            var start_date = $(".strt_date" + id).val();
            var start_time = $(".strt_time" + id).val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home_ajax/location'); ?>",
                data: {
                    start_time: start_time,
                    start_date: start_date,
                    id: id
                },
                beforeSend: function() {},
                success: function(data) {

                },
                complete: function() {

                }
            });
        }

        function vendoradd(id) {
            var vendortype = $(".vendortype" + id).val();
            var start_date = $(".start_date" + id).val();
            var start_time = $(".start_time" + id).val();
            var end_date = $(".end_date" + id).val();
            var location = $(".location" + id).val();
            var end_time = $(".end_time" + id).val();
            var ot = $(".ot" + id).val();
            var crews_commited = 0;
            var crews_hide = 0;
            if ($('.crews_commited' + id).is(":checked")) {
                crews_commited = 1;
            }
            if ($('.crews_hide' + id).is(":checked")) {
                crews_hide = 1;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home_ajax/vendoradd'); ?>",
                data: {
                    location: location,
                    end_time: end_time,
                    id: id,
                    ot: ot,
                    vendortype: vendortype,
                    crews_commited: crews_commited,
                    crews_hide: crews_hide,
                    start_date: start_date,
                    start_time: start_time,
                    end_date: end_date
                },
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data != '') {
                        if (confirm(data) == true) {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url('Fi_home_ajax/vendorUpdate'); ?>",
                                data: {
                                    location: location,
                                    end_time: end_time,
                                    id: id,
                                    ot: ot,
                                    vendortype: vendortype,
                                    crews_commited: crews_commited,
                                    crews_hide: crews_hide,
                                    start_date: start_date,
                                    start_time: start_time,
                                    end_date: end_date
                                },
                                beforeSend: function() {
                                    $('.fadeMe').show();
                                },
                                success: function(data) {
                                    $('.fadeMe').hide();
                                },
                                complete: function() {
                                    $('.fadeMe').hide();
                                }
                            });

                        } else {
                            return false;
                        }
                    } else {

                    }

                    $('.fadeMe').hide();
                },
                complete: function() {
                    $('.fadeMe').hide();
                }
            });
        }

        $(document).ready(function() {
            $('#myevents table tr:first-child').find('.eventtype').focus();
            $('#myevents table tr:first-child').find('.eventypeinfo').focus();
        });

        $(document).ready(function() {
            $('#myevents table tr:nth-last-child(2)').find('.showcust').trigger('click');
            var focus_name = $('#myevents table tr:nth-last-child(2)').find('.focus');
            focus_name.attr('autofocus', 'true').focus();
        });

        $(document).ready(function() {
            $('body').on('keydown', '#myevents input[type="text"]', function(e) {
                var cus_names = $('#cus_names').val();
                var tdix = $(this).closest('td').index();
                var tdi = Number(tdix) + 1;

                if (e.which === 40) {
                    $(this).parents("tr").next("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();
                    var eventId = $(this).parents("tr").next("tr").find('#hidevntid').val(); //hidevntid
                    var evntdt = $(this).parents("tr").next("tr").find('#edate').val();
                    var evnttype = $(this).parents("tr").next("tr").find('.eventtype option:selected').val();
                    fnvieweventinfo(eventId, cus_names, evntdt, '', '', '', evnttype);

                    $('.trshowcust').removeClass('active-cust');
                    $(this).parents("tr").next("tr").addClass('active-cust');

                } else if (e.which === 38) {
                    $(this).parents("tr").prev("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();
                    var eventId = $(this).parents("tr").prev("tr").find('#hidevntid').val(); //hidevntid
                    var evntdt = $(this).parents("tr").prev("tr").find('#edate').val();
                    var evnttype = $(this).parents("tr").prev("tr").find('.eventtype option:selected').val();
                    fnvieweventinfo(eventId, cus_names, evntdt, '', '', '', evnttype);
                    $('.trshowcust').removeClass('active-cust');
                    $(this).parents("tr").prev("tr").addClass('active-cust');
                }
            });
        });

        $(document).ready(function() {
            $('body').on('keydown', '#myjobs input[type="text"]', function(e) {
                var cus_names = $('#cus_names').val();
                var tdix = $(this).closest('td').index();
                var tdi = Number(tdix) + 1;

                if (e.which === 40) {
                    $(this).parents("tr").next("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();
                    var eventId = $(this).parents("tr").next("tr").find('#hidevntid').val(); //hidevntid
                    var hidenjbId = $(this).parents("tr").next("tr").find('.hidenjbId').val(); //hidenjbId
                    fnviewjobinfo(hidenjbId, eventId);
                    $('.trshowcustt').removeClass('active-job2');
                    $(this).parents("tr").next("tr").addClass('active-job2');

                } else if (e.which === 38) {
                    //$(this).parents("tr").prev("tr").find('.num').focus();
                    $(this).parents("tr").prev("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();
                    // $(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('.form-group .input-group .updwn').focus();
                    var eventId = $(this).parents("tr").prev("tr").find('#hidevntid').val(); //hidevntid
                    var hidenjbId = $(this).parents("tr").prev("tr").find('.hidenjbId').val(); //hidenjbId

                    //alert("eventId--"+eventId+" hidenjbId--"+hidenjbId);

                    fnviewjobinfo(hidenjbId, eventId);

                    $('.trshowcustt').removeClass('active-job2');
                    $(this).parents("tr").prev("tr").addClass('active-job2');
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('keydown', 'input[type="text"]', function(e) {

                //e.preventDefault();
                var cus_names = $('#cus_names').val();
                var tdix = $(this).closest('td').index();

                //alert(tdix);
                var tdi = Number(tdix) + 1;
                if (e.which === 40) {
                    $(this).parents("tr").next("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();

                } else if (e.which === 38) {
                    //$(this).parents("tr").prev("tr").find('.num').focus();
                    $(this).parents("tr").prev("tr").find("td:nth-child(" + tdi + ")").find('.updwn').focus();

                }
            });
        });
    </script>



    <script>
        $(".sidebar").find('a[href *="custevents"]').parents(".treeview-menu").css({
            "display": "block"
        });

        $(".sidebar").find('a[href *="custevents"]').parents(".treeview").addClass("menu-open");

        $(".sidebar").find('a[href *="custevents"]').addClass('sub-active');
    </script>






    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#en_date, .en_date", function(event) {

                var temp_en_date = $(this).parents(".tr_clone").find(".en_date");
                var temp_st_date = $(this).parents(".tr_clone").find(".st_date");
                var temp_st_time = $(this).parents(".tr_clone").find(".st_time");
                var temp_en_time = $(this).parents(".tr_clone").find(".en_time");
                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");


                var d = new Date(temp_en_date.val());
                var fyer = d.getFullYear();

                var fmnth = String(d.getMonth() + 1).padStart(2, '0').slice(-2);
                var fdate = String(d.getDate()).padStart(2, '0').slice(-2);

                var trimmed = "20" + fyer + "-" + fmnth + "-" + fdate;
                var newdate = trimmed; //'02/07/2019';
                //alert("newdate--"+newdate);
                var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
                var chkvdate = dtRegex.test(newdate);
                if (chkvdate == true) {
                    alert("newdate--" + newdate);

                    temp_en_date.val(newdate);

                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date.val() + " " + valuestop;

                        //alert("startDate--"+startDate+" endDate--"+endDate);

                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                        // alert("hrs--"+hrs);
                        //temp_total_hours.val(hrs);
                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }
                    }
                } else {
                    // alert("Invalid Date");
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#st_date, .st_date", function(event) {
                //alert("aa");
                var temp_en_date = $(this).parents(".tr_clone").find(".en_date");
                var temp_st_date = $(this).parents(".tr_clone").find(".st_date");
                var temp_st_time = $(this).parents(".tr_clone").find(".st_time");
                var temp_en_time = $(this).parents(".tr_clone").find(".en_time");
                var temp_total_hours = $(this).parents(".tr_clone").find(".total_hours");


                var d = new Date(temp_st_date.val());
                var fyer = d.getFullYear();

                var fmnth = String(d.getMonth() + 1).padStart(2, '0').slice(-2);
                var fdate = String(d.getDate()).padStart(2, '0').slice(-2);

                var trimmed = "20" + fyer + "-" + fmnth + "-" + fdate;
                var newdate = trimmed; //'02/07/2019';
                // alert("newdate--"+newdate);
                var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
                var chkvdate = dtRegex.test(newdate);
                if (chkvdate == true) { //alert("newdate--"+newdate);

                    temp_st_date.val(newdate);

                    var valuestart = temp_st_time.val();
                    var valuestop = temp_en_time.val();

                    if (valuestart != "" && valuestop != "") {
                        const startDate = temp_st_date.val() + " " + valuestart;
                        const endDate = temp_en_date.val() + " " + valuestop;

                        //alert("startDate--"+startDate+" endDate--"+endDate);

                        var diff = Math.abs(new Date(endDate) - new Date(startDate)); // 60000
                        var hrs = Math.floor((diff / 3600000)); //Math.floor((diff/1000)/60);
                        // alert("hrs--"+hrs);
                        //temp_total_hours.val(hrs);
                        if (hrs == 'NAN') {
                            temp_total_hours.val(0);
                        } else {
                            temp_total_hours.val(hrs);
                        }
                    }
                } else {
                    // alert("Invalid Date");
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".invcDate").change(function() {
                var temp_castart_date = $(this).parents(".tr_clone").find(".invcDate");

                var str1 = temp_castart_date.val();
                var arr1 = str1.split("-");
                var last2 = arr1[0].slice(-2);
                if (parseInt(last2) > 10) {
                    today = '20' + last2 + '-' + arr1[1] + '-' + arr1[2];
                    temp_castart_date.val(today);
                }
            });
        });


        $(document).ready(function() {
            $("body").on("keydown", ".confirmedon", function(event) {

                var key = event.keyCode;


                var temp_confirmedon_date = $(this).parents(".tr_clone").find(".confirmedon");

                if (key == "107" || key == "187") {

                    var dtpls;
                    if (temp_confirmedon_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_confirmedon_date.val());
                    }
                    var today = dtpls;
                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;


                    temp_confirmedon_date.val(today);
                    event.preventDefault();



                } else if (key == "109" || key == "189") {

                    var dtmns;
                    if (temp_confirmedon_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_confirmedon_date.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;


                    temp_confirmedon_date.val(today);
                    event.preventDefault();


                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '/' + dd + '/' + yyyy;


                    temp_confirmedon_date.val(today);
                    event.preventDefault();

                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_confirmedon_date.val();


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

                            temp_confirmedon_date.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_confirmedon_date.val("");
                            event.preventDefault();
                        }
                    }
                }

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("keydown", ".dt", function(event) {

                var key = event.keyCode;
                //alert("key--"+key);

                var temp_confirmedon_date = $(this).parents(".tr_clone").find(".dt");

                if (key == "107" || key == "187") {
                    //alert("date+");
                    //var today = new Date();
                    var dtpls;
                    if (temp_confirmedon_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_confirmedon_date.val());
                    }
                    var today = dtpls;
                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("plus today--"+today);

                    temp_confirmedon_date.val(today);
                    event.preventDefault();



                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    //var today = new Date();
                    var dtmns;
                    if (temp_confirmedon_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_confirmedon_date.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("minus today--"+today);
                    temp_confirmedon_date.val(today);
                    event.preventDefault();


                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("today--"+today);

                    temp_confirmedon_date.val(today);
                    event.preventDefault();

                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_confirmedon_date.val();


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

                            temp_confirmedon_date.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_confirmedon_date.val("");
                            event.preventDefault();
                        }
                    }
                }

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("keydown", ".dt1", function(event) {

                var key = event.keyCode;
                //alert("key--"+key);

                var temp_confirmedon_date = $(this).parents(".tr_clone").find(".dt1");

                if (key == "107" || key == "187") {
                    //alert("date+");
                    //var today = new Date();
                    var dtpls;
                    if (temp_confirmedon_date.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_confirmedon_date.val());
                    }
                    var today = dtpls;
                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("plus today--"+today);

                    temp_confirmedon_date.val(today);
                    event.preventDefault();



                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    //var today = new Date();
                    var dtmns;
                    if (temp_confirmedon_date.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_confirmedon_date.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("minus today--"+today);
                    temp_confirmedon_date.val(today);
                    event.preventDefault();


                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("today--"+today);

                    temp_confirmedon_date.val(today);
                    event.preventDefault();

                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_confirmedon_date.val();


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

                            temp_confirmedon_date.val(today);

                        } else {
                            alert("Wrong date.");
                            temp_confirmedon_date.val("");
                            event.preventDefault();
                        }
                    }
                }

            });
        });
    </script>



    <script>
        $(document).ready(function() {
            //$("#edate").on("change", function(){
            $("body").on("change", "#lstedate, .lstedate", function(event) {
                event.preventDefault();
                //alert('123');
                var status = $(this).val();

                var temp_heb_date = $(this).parents(".tr_clone").find(".heb_date");
                var temp_eday = $(this).parents(".tr_clone").find(".eday");
                var temp_error = $(this).parents(".tr_clone").find(".error");
                var temp_lstedate = $(this).parents(".tr_clone").find(".lstedate");
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();


                ValidateDate1(status, temp_error, temp_heb_date, temp_eday, temp_lstedate, temp_hidevntid);

            });
        });
    </script>

    <script type="text/javascript">
        function ValidateDate1(dtValue, temp_error, temp_heb_date, temp_eday, temp_lstedate, temp_hidevntid) {
            //alert(dtValue);
            var d = new Date(dtValue);
            var fyer = d.getFullYear();
            //var fmnth= ("0"+ new Date(dtValue).getMonth()).slice(-2);
            //var fdate= ("0"+ new Date(dtValue).getDate()).slice(-2);
            var fmnth = String(d.getMonth() + 1).padStart(2, '0').slice(-2);
            var fdate = String(d.getDate()).padStart(2, '0').slice(-2);

            //alert("fyer--"+fmnth+"/"+fdate+"/"+fyer);
            //var trimmed = dtValue.replace(/\b0+/g, "");

            //var trimmed = fmnth+"/"+fdate+"/"+"20"+fyer;
            var trimmed = "20" + fyer + "-" + fmnth + "-" + fdate;
            //alert("trimmed---"+trimmed);
            var newdate = trimmed; //'02/07/2019';
            var status = newdate;
            //alert("newdate--"+newdate);

            //var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
            var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
            //return dtRegex.test(newdate);
            var chkvdate = dtRegex.test(status);
            //alert("chkvdate--"+chkvdate);
            if (chkvdate == true) { //alert("newdate--"+newdate);

                temp_error.css('display', 'none');

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                    data: {
                        status: status
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        var str = data;
                        var temp = new Array();
                        temp = str.split(",");



                        temp_heb_date.val(temp[0]);
                        temp_eday.val(temp[1]);
                        temp_lstedate.val(newdate);

                        //alert(newdate+"--"+temp[0]+"--"+temp[1]);

                    },
                    complete: function() {

                    }
                });

            } else { //alert("Invalid Date");
                //temp_error.css('display','block');
                // event.preventDefault();
            }

        }
    </script>


    <script>
        $(document).ready(function() {
            $("body").on("keydown", "#lstedate, .lstedate", function(event) {
                //alert('123');

                var key = event.keyCode;
                //alert("key--"+key);


                var temp_edate = $(this).parents(".tr_clone").find(".lstedate");

                var temp_heb_date = $(this).parents(".tr_clone").find(".heb_date");
                var temp_eday = $(this).parents(".tr_clone").find(".eday");
                var temp_hidevntid = $(this).parents(".tr_clone").find(".hidevntid").val();

                if (key == "107" || key == "187") {
                    event.preventDefault();
                    //alert("date+");
                    //var today = new Date(temp_edate.val());
                    var dtpls;
                    if (temp_edate.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_edate.val());
                    }
                    var today = dtpls;
                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("plus today--"+today);

                    //$('#edate').val(today);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                        data: {
                            status: today
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            var str = data;
                            var temp = new Array();
                            temp = str.split(",");



                            temp_heb_date.val(temp[0]);
                            temp_eday.val(temp[1]);
                            temp_edate.val(today);

                            //alert(today+"--"+temp[0]+"--"+temp[1]);

                        },
                        complete: function() {

                        }
                    });

                    $('#strt_date').val(today);
                    $('#st_date').val(today);
                    $('#str_date').val(today);
                    $('#assostart_date').val(today);

                    //gethebrewDate(today,temp_heb_date,temp_eday,temp_hidevntid);




                } else if (key == "109" || key == "189") {
                    event.preventDefault();
                    //alert("date-");
                    var dtmns;
                    if (temp_edate.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_edate.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;
                    //alert("minus today--"+today);
                    //$('#edate').val(today);

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                        data: {
                            status: today
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            var str = data;
                            var temp = new Array();
                            temp = str.split(",");

                            temp_heb_date.val(temp[0]);
                            temp_eday.val(temp[1]);
                            temp_edate.val(today);

                            //alert(today+"--"+temp[0]+"--"+temp[1]);

                        },
                        complete: function() {

                        }
                    });


                    $('#strt_date').val(today);
                    $('#st_date').val(today);
                    $('#str_date').val(today);
                    $('#assostart_date').val(today);


                    //gethebrewDate(today,temp_heb_date,temp_eday,temp_hidevntid);

                } else if (key == "68") {
                    event.preventDefault();
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    //today = yyyy + '-' + mm + '-' + dd;
                    today = mm + '/' + dd + '/' + yyyy;
                    // alert("plus today--"+today);

                    //$('#edate').val(today);

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                        data: {
                            status: today
                        },
                        beforeSend: function() {},
                        success: function(data) {
                            var str = data;
                            var temp = new Array();
                            temp = str.split(",");



                            temp_heb_date.val(temp[0]);
                            temp_eday.val(temp[1]);
                            temp_edate.val(today);

                            //alert(newdate+"--"+temp[0]+"--"+temp[1]);

                        },
                        complete: function() {

                        }
                    });


                    $('#strt_date').val(today);
                    $('#st_date').val(today);
                    $('#str_date').val(today);
                    $('#assostart_date').val(today);


                    // gethebrewDate(today,temp_heb_date,temp_eday,temp_hidevntid);
                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_edate.val();
                    //alert(str);

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

                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url('Fi_home/hebrew'); ?>",
                                data: {
                                    status: today
                                },
                                beforeSend: function() {},
                                success: function(data) {
                                    var str = data;
                                    var temp = new Array();
                                    temp = str.split(",");



                                    temp_heb_date.val(temp[0]);
                                    temp_eday.val(temp[1]);
                                    temp_edate.val(today);



                                },
                                complete: function() {

                                }
                            });


                            $('#strt_date').val(today);
                            $('#st_date').val(today);
                            $('#str_date').val(today);
                            $('#assostart_date').val(today);


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
            $("body").on("keydown", "#lstendate, .lstendate", function(event) {
                var key = event.keyCode;

                var temp_edate = $(this).parents(".tr_clone").find(".lstendate");

                if (key == "107" || key == "187") {
                    //alert("date+");
                    //var today = new Date(temp_edate.val());
                    var dtpls;
                    if (temp_edate.val() == "") {
                        dtpls = new Date();
                    } else {
                        dtpls = new Date(temp_edate.val());
                    }
                    var today = dtpls;
                    dtpls.setDate(dtpls.getDate() + 1);

                    var dd = String(dtpls.getDate()).padStart(2, '0');
                    var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtpls.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    //alert("plus today--"+today);
                    temp_edate.val(today);
                    $('#en_date').val(today);
                    event.preventDefault();

                } else if (key == "109" || key == "189") {
                    //alert("date-");
                    var dtmns;
                    if (temp_edate.val() == "") {
                        dtmns = new Date();
                    } else {
                        dtmns = new Date(temp_edate.val());
                    }
                    var today = dtmns;
                    dtmns.setDate(dtmns.getDate() - 1);

                    var dd = String(dtmns.getDate()).padStart(2, '0');
                    var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = dtmns.getFullYear();
                    today = mm + '/' + dd + '/' + yyyy;

                    //today = yyyy + '-' + mm + '-' + dd;
                    //alert("minus today--"+today);
                    temp_edate.val(today);
                    $('#en_date').val(today);
                    event.preventDefault();

                } else if (key == "68") {

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '/' + dd + '/' + yyyy;
                    //today = yyyy + '-' + mm + '-' + dd;
                    //alert("plus today--"+today);
                    temp_edate.val(today);
                    $('#en_date').val(today);
                    event.preventDefault();


                } else if (key == "8" || key == "46") {

                } else {
                    var str = temp_edate.val();
                    //alert(str);

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
                            $('#en_date').val(today);

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
        function fnupdatejobinfodtls(txtinptval, fieldnm, jobId, x) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/fnupdatejobinfo'); ?>",
                data: {
                    txtinptval: txtinptval,
                    fieldnm: fieldnm,
                    jobId: jobId
                },
                beforeSend: function() {
                    $('.fadeMe').show();
                    //alert("evnt_name--"+evnt_name);
                },
                success: function(data) {
                    if (data == "success") {
                        $('.fadeMe').hide();
                        //$('#jid1').val(evnt_name);
                        //temp_jid1.val(evnt_name);

                    } else {
                        $('.fadeMe').hide();
                    }

                },
                complete: function() {
                    //$('.fadeMe').hide();
                }
            });
        }
    </script>

    <script type="text/javascript">
        function fncrtevntjob(eventId, ) {
            var cus_names = $('#cus_names').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/fncrtevntjobinfo'); ?>",
                data: {
                    eventId: eventId
                },
                beforeSend: function() {
                    $('.fadeMe').show();
                    //alert("eventId--"+eventId);
                },
                success: function(data) {
                    if (data == "success") {
                        $('.fadeMe').hide();
                        $("#myjobs").load(location.href + " #myjobs");
                        fnvieweventinfo(eventId, cus_names);
                    } else {
                        $('.fadeMe').hide();
                    }

                },
                complete: function() {
                    //$('.fadeMe').hide();
                }
            });
        }
    </script>

    <script type="text/javascript">
        function fncrtnewjobdtls(eventId, jobId) {
            var cus_names = $('#cus_names').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/fncrtnewjobdtinfo'); ?>",
                data: {
                    eventId: eventId,
                    jobId: jobId
                },
                beforeSend: function() {
                    $('.fadeMe').show();
                    //alert("eventId--"+eventId+" jobId--"+jobId);
                },
                success: function(data) {
                    if (data == "success") {
                        $('.fadeMe').hide();
                        // $(".outer-jobdtls").load(location.href + " .outer-jobdtls");
                        //fnvieweventinfo(eventId,cus_names);
                        fnviewjobinfo(jobId, eventId);

                        //$("#myjobdetils").load(location.href + " #myjobdetils","");
                    } else {
                        $('.fadeMe').show();
                    }

                },
                complete: function() {
                    $('.fadeMe').show();
                }
            });
        }
    </script>

    <script type="text/javascript">
        function fnupdtejobdtls(txtinptval, fieldnm, jbdId) {
            //alert("txtinptval--"+txtinptval+" fieldnm--"+fieldnm+" jbdId--"+jbdId);
            var start_time = $('.my_Time_CREWSF' + jbdId).val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/fnupdtejobdtlsinfo'); ?>",
                data: {
                    start_time: start_time,
                    txtinptval: txtinptval,
                    fieldnm: fieldnm,
                    jbdId: jbdId
                },
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    if (data == "success") {
                        $('.fadeMe').hide();
                    } else {
                        $('.fadeMe').hide();
                    }
                },
                complete: function() {
                    $('.fadeMe').hide();
                }
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", ".lstjobtypedtls", function() {
                var cus_names = $('#cus_names').val();
                var jbdttyp = $(this).val();
                var temp_hdnjobId = $(this).parents('.tr_clone').find('.hdnjobId');
                var hidevntid = temp_hdnjobId.next().val();
                var hdnjobId = temp_hdnjobId.val();
                var actevntdate = $('#myevents .active-cust').find('.edate ').val();
                var splittedDate = splitDate(actevntdate);
                var seteventstartdate = splittedDate[2] + "-" + splittedDate[0] + "-" + splittedDate[1];
                var jbstarttime = seteventstartdate;

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fninsertjobtypdtls'); ?>",
                    data: {
                        jbdttyp: jbdttyp,
                        hdnjobId: hdnjobId,
                        hidevntid: hidevntid,
                        jbstarttime: jbstarttime
                    },
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        if (data == "success") {
                            fnviewjobinfo(hdnjobId, hidevntid, seteventstartdate);

                            $('.fadeMe').hide();


                        } else {
                            $('.fadeMe').hide();
                        }

                    },
                    complete: function() {
                        //$('.fadeMe').hide();
                    }
                });


            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("body").on("change", ".lstjid4", function() {
                var value = $(this).val();
                //alert("value--"+value);
                var imprt_name = $('#joblst [value="' + value + '"]').data('value');
                //alert("imprt_name----"+imprt_name);
                //var hdneventId= $('#hdneventId').val();
                var hdneventId = $(this).parents('.tr_clone').find('.hidevntid').val();



                var temp_loc_jid1 = $(this).parents(".tr_clone").find(".jid1");
                var temp_loc_jid2 = $(this).parents(".tr_clone").find(".jid2");
                var temp_loc_jid3 = $(this).parents(".tr_clone").find(".jid3");



                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('fi_home/getimpjobinfo'); ?>",
                    data: {
                        imprt_name: imprt_name
                    },
                    dataType: "json",
                    beforeSend: function() {
                        //alert("Before imprt_name--"+imprt_name);
                    },
                    success: function(data) { //alert("data--"+data);
                        var locs = data.jobinfolist;
                        //alert("locs--"+locs);

                        $.each(locs, function(locs, item) {
                            temp_loc_jid1.val(item.jb_name);
                            temp_loc_jid2.val(item.jb_type);


                            temp_loc_jid3.val(item.jb_notes);


                            fncreatejob(item.jb_name, item.jb_type, item.jb_notes, item.jb_import, hdneventId, item.jb_id);

                        });

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function getPlainText(strSrc) {
            var resultStr = "";

            // Ignore the <p> tag if it is in very start of the text
            if (strSrc.indexOf('<p>') == 0)
                resultStr = strSrc.substring(3);

            // Replace <p> with two newlines
            resultStr = resultStr.replace(/<p>/gi, "\r\n\r\n");
            // Replace <br /> with one newline
            resultStr = resultStr.replace(/<br \/>/gi, "\r\n");
            resultStr = resultStr.replace(/<br>/gi, "\r\n");
            resultStr = resultStr.replace(/&nbsp;/gi, " ");
            resultStr = resultStr.replace(/<\/?p[^>]*>/g, "");

            return resultStr;
        }
    </script>




    <script type="text/javascript">
        function fnsetcustomhtml() {
            var str = $('#letteremaildesc').val();
            var userId = localStorage.getItem("pckId");
            // var userId = $('#cus_names option:selected').val();

            var hidevntid = $('#myevents .active-cust').find('.hidevntid').val();
            var lastinvId = $('#lastinvId input').val();
            var loadmap = $('#mylocation .loadmap:first-of-type').attr('href');
            //alert("loadmap--"+loadmap);
            // alert("userId--"+userId);

            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/geteventinfojson') ?>',
                data: {
                    userId: userId,
                    hidevntid: hidevntid
                },
                dataType: 'json',
                //async: false,
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) { //alert("data--"+data);

                    if (data != "") {
                        //var res;
                        var appendata = data.eventinfo;
                        var phoneno = $('#topphone').val();
                        var setlocation = [];
                        $('#letteremaildesc').val('');
                        $.each(appendata, function(appendata, item) {

                            setlocation.push(item.location_type);
     
                            setlocation.join();

                            //alert(item.cus_fname+" "+item.cus_lname);
                            var custfullname = item.cus_fname + " " + item.cus_lname;
                            // alert("custfullname--"+custfullname);
                            var custfulladdress = item.cus_address1 + "\n City: " + item.cus_city + ", State: " + item.cus_state + ", Zip: " + item.cus_zip;

                            str = str.replace(" Username", custfullname);
                            str = str.replace(" Phone", phoneno);
                            str = str.replace(" Address", custfulladdress);
                            str = str.replace(" Company", item.cus_company_name);
                            str = str.replace(" Fname", item.cus_fname);
                            str = str.replace(" Lname", item.cus_lname);
                            //str = str.replace(" Location",loadmap.replace(/\s/g, ''));
                            //str = str.replace(" Location",setlocation);
                            str = str.replace(" Event type", item.event_type);
                            str = str.replace(" Event date", item.event_date);
                            str = str.replace(" Hebrew date", item.event_hebrew_date);
                            str = str.replace(" Event Name", item.event_name);
                            str = str.replace(" Referred by", item.event_referred_by);
                            str = str.replace(" Crew No", '');
                            str = str.replace(" Account No", lastinvId);

                        });
                        str = str.replace(" Location", setlocation);
                        //str = str.replace("Image ",str);
                        CKEDITOR.instances['letteremaildesc'].setData(str);

                        // $('#letteremaildesc').val(str);


                        $('.fadeMe').hide();

                    } else {
                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) {
                },
                complete: function() {
                }

            });

        }

        function fnsetletterscustomhtml() {
            var str = $('#leteremaildesc').val();
            var userId = localStorage.getItem("pckId");
            var hidevntid = $('#myevents .active-cust').find('.hidevntid').val();
            var lastinvId = $('#lastinvId input').val();
            var loadmap = $('#mylocation .loadmap:first-of-type').attr('href');

            $.ajax({
                type: 'POST',
                url: '<?= site_url('fi_home/geteventinfojson') ?>',
                data: {
                    userId: userId,
                    hidevntid: hidevntid
                },
                dataType: 'json',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) { //alert("data--"+data);

                    if (data != "") {

                        var appendata = data.eventinfo;

                        var phoneno = $('#topphone').val();
                        var setlocation = [];
                        $('#leteremaildesc').val('');
                        $.each(appendata, function(appendata, item) {

                            setlocation.push(item.location_type);
                            setlocation.join();
                            var custfullname = item.cus_fname + " " + item.cus_lname;
                            
                            var custfulladdress = item.cus_address1 + "\n City: " + item.cus_city + ", State: " + item.cus_state + ", Zip: " + item.cus_zip;

                            str = str.replace(" Username", custfullname);
                            str = str.replace(" Phone", phoneno);
                            str = str.replace(" Address", custfulladdress);
                            str = str.replace(" Company", item.cus_company_name);
                            str = str.replace(" Fname", item.cus_fname);
                            str = str.replace(" Lname", item.cus_lname);
                            str = str.replace(" Event type", item.event_type);
                            str = str.replace(" Event date", item.event_date);
                            str = str.replace(" Hebrew date", item.event_hebrew_date);
                            str = str.replace(" Event Name", item.event_name);
                            str = str.replace(" Referred by", item.event_referred_by);
                            str = str.replace(" Crew No", '');
                            str = str.replace(" Account No", lastinvId);


                        });
                        str = str.replace(" Location", setlocation);

                        CKEDITOR.instances['leteremaildesc'].setData(str);


                        $('.fadeMe').hide();

                    } else {
                        $('.fadeMe').hide();
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
    </script>



    <script type="text/javascript">
        $(document).ready(function() {

            $("body").on("change", "#jid2, .jid2", function(e) {

                var txtinptval = $(this).val();
                var jobId = $(this).parents(".tr_clone").find(".hidenjbId").val();
                var evnt_name = $('#myevents .active-cust').find('.ename').val();
                var fieldnm = "jb_type";
                var temp_jid1 = $(this).parents(".tr_clone").find(".jid1");

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Fi_home/fnupdatejobinfo'); ?>",
                    data: {
                        txtinptval: txtinptval,
                        fieldnm: fieldnm,
                        jobId: jobId,
                        evnt_name: evnt_name
                    },
                    dataType: "html",
                    beforeSend: function() {
                        $('.fadeMe').show();

                    },
                    success: function(data) { // alert("data--"+data);

                        $('#hdnjobdata').html(data);

                        var responce = $('#success').val();
                        var hdndbjobname = $('#hdndbjobname').val();

                        if (responce == "success") {
                            //temp_jid1.val(evnt_name);
                            temp_jid1.val(hdndbjobname);
                            $('.fadeMe').hide();


                        } else {
                            $('.fadeMe').hide();
                        }

                    },
                    complete: function() {
                        //$('.fadeMe').hide();
                    }
                });
            });
        });

        function cus_event() {
            var l_name = $('.cus_event').val();
            window.location.href = "<?php echo site_url('fi_home/search_cus') ?>?id=" + l_name;
        }
    </script>

    <script>
        CKEDITOR.replace('letteremaildesc');
        CKEDITOR.replace('leteremaildesc');
    </script>
    <a style="display: none" href="<?php echo site_url('fi_home/'); ?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
    <script src="<?php echo base_url('assets/'); ?>js/prasanna.js"></script>

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


    <script type="text/javascript">
        $(".check_date_with_db").blur(function() {
            var date_ = $(this).val();
            var cus_id = "<?= $cus_id ?>";

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/check_date_with_db'); ?>",
                data: {
                    date_: date_,
                    cus_id: cus_id
                },
                success: function(result) {
                    if (!result) {
                        confirm("Existing event for this vendor already exist! Continue? ");
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function($) {
            $('body').on('keyup', '.fcap', function(event) {
                var textBox = event.target;
                var start = textBox.selectionStart;
                var end = textBox.selectionEnd;
                textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
                textBox.setSelectionRange(start, end);
            });
        });
    </script>
    <script type="text/javascript">
        function my_Time_CREWSF(my) {
            var my_Time = $('.my_Time_CREWSF' + my).val();
            var my_Time_count = my_Time.toString().length;
            var arr = ["00", "00"];
            if (my_Time_count == 4) {
                if (my_Time > 0 && my_Time < 1300) {
                    arr = my_Time.match(/.{1,2}/g);
                    var res = arr[0] + ":" + arr[1] + " PM";
                    $('.my_Time_CREWSF' + my).val(res);
                } else {
                    var num = my_Time - 1200;
                    my_Time = num.toString();
                    var my_Time_count = my_Time.toString().length;
                    if (my_Time_count == 3) {
                        my_Time = '0'.concat(my_Time);
                    }
                    if (my_Time > 0 && my_Time < 1300) {
                        arr = my_Time.match(/.{1,2}/g);
                        var res = arr[0] + ":" + arr[1] + " PM";
                        $('.my_Time_CREWSF' + my).val(res);
                    } else {
                        alert("Time is not correct")
                    }
                }
            } else if (my_Time_count > 4) {

            } else if (my_Time_count > 0) {
                alert("Value should be 4 digit");
            }
        }

        function deletejobsub(job_id) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/deletejobsub'); ?>",
                data: {
                    job_id: job_id
                },
                success: function(result) {
                    $('.myTableRow' + job_id).remove();
                }
            });

        }
    </script>