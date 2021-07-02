<?php

class CustomersModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fnloadeventinfo_dtls($cus_id = 0)
    {
        $eventId = $this->input->post('eventId');
        $this->session->set_userdata('eventId', $eventId);

        $get_loc  = $this->db->query("SELECT * from add_location_event");
        $all_locs = $get_loc->result_array();
        $all_crews = $this->db->where('cat_id', 4)->get('sub_categories')->result_array(); ?>

        <div class="col-md-12 evntlocation" style="margin-top: 10px;">
            <input type="hidden" class="txthdnevntsype" name="txthdnevntsype" id="txthdnevntsype" value="<?= $_POST['evntype'] ?>">
            <input type="hidden" class="txtshdnevntId" name="txtshdnevntId" id="txtshdnevntId" value="<?= $_POST['eventId'] ?>">
            <div class="box box-default locationtb">
                <div class="box-header with-border">
                    <p class="uhead2">Locations</p>
                    <div tabindex="-1" class="box-tools pull-right">
                        <button tabindex="-1" type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive" id="mylocation">
                        <table class="table table-hover no-margin fixed_table">
                            <thead>
                                <tr>
                                    <th width="15%">Location</th>
                                    <th class="w95">Date</th>
                                    <th class="w95">Time</th>
                                    <th width="20%">Address</th>
                                    <th width="7%">City</th>
                                    <th width="4%">State</th>
                                    <th class="w60">Zip</th>
                                    <th class="w110">Phone 1 </th>
                                    <th class="w110">Phone 2 </th>
                                    <th class="w50">Map</th>
                                    <th>Notes</th>
                                    <th class="w100">Action</th>
                                </tr>
                                <?php
                                $location_data = $this->AdminModel->get_locationt_data_id($_POST['eventId']);
                                if (count($location_data) > 0) {
                                    $i = 1;
                                    foreach ($location_data as $locations_info) { ?>
                                        <tr class="tr_clone">
                                            <td>
                                                <select id="loc_name1" class="form-control updwn my_last_location_<?= $i++ ?>" name="add_location[]" autofocus="">
                                                    <option>Choose</option>
                                                    <?php
                                                    foreach ($all_locs as $locations) {
                                                        if ($locations['location_name'] == $locations_info['location_type']) {
                                                            $loctype = "selected";
                                                        } else {
                                                            $loctype = "";
                                                        } ?>
                                                        <option <?= $loctype ?> value="<?php echo $locations['location_name'] ?>">
                                                            <?php echo $locations['location_name'] ?></option> <?php
                                                                                                            } ?>
                                                </select>
                                            </td>

                                            <td>
                                                <?php
                                                $dt = date("m/d/Y", strtotime($locations_info['location_date']));
                                                ?>
                                                <input onblur="locationupdate(<?= $locations_info['location_id'] ?>);" type="text" name="ddate[]" id="strt_date" placeholder="mm/dd/yyyy" class="strt_date<?= $locations_info['location_id'] ?> 
                                                    form-control strt_date updwn w80" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>">
                                            </td>

                                            <td>
                                                <input placeholder="HH:MM" type="text" name="time[]" id="strt_time" class="strt_time<?= $locations_info['location_id'] ?> form-control strt_time updwn my_Time_Location<?= $locations_info['location_id'] ?>" value="<?= $locations_info['location_time'] ?>" onblur=" my_Time_Location(<?= $locations_info['location_id'] ?>)">

                                                <script type="text/javascript">
                                                    function my_Time_Location(my) {
                                                        var my_Time = $('.my_Time_Location' + my).val();
                                                        var my_Time_count = my_Time.toString().length;
                                                        var arr = ["00", "00"];
                                                        if (my_Time_count == 4) {
                                                            if (my_Time > 0 && my_Time < 1300) {
                                                                arr = my_Time.match(/.{1,2}/g);
                                                                var res = arr[0] + ":" + arr[1] + " PM";
                                                                $('.my_Time_Location' + my).val(res);
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
                                                                    $('.my_Time_Location' + my).val(res);
                                                                } else {
                                                                    alert("Time is not correct")
                                                                }
                                                            }
                                                        }
                                                    }
                                                </script>
                                            </td>

                                            <td><input type="text" name="address[]" id="loc_add" class="form-control loc_add updwn fcap" value="<?= $locations_info['location_address']  ?>"></td>
                                            <td><input tabindex="-1" type="text" name="city[]" id="loc_city" class="form-control loc_city updwn text-center" value="<?= $locations_info['location_city']  ?>"></td>
                                            <td><input tabindex="-1" type="text" name="state[]" id="loc_state" class="form-control loc_state updwn text-center" value="<?= $locations_info['location_state']  ?>"></td>
                                            <td><input tabindex="-1" type="text" name="zip[]" id="loc_zip" class="form-control loc_zip updwn text-center" value="<?= $locations_info['location_zip']  ?>" maxlength="5" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
                                            <td><input tabindex="-1" type="text" name="phone[]" id="loc_phone1" class="form-control loc_phone1 contact_no updwn" value="<?= $locations_info['location_phone']  ?>"></td>
                                            <td><input tabindex="-1" type="text" name="phone2[]" id="loc_phone2" class="form-control loc_phone2 contact_no updwn" value="<?= $locations_info['location_phone']  ?>"></td>
                                            <td>

                                                <a tabindex="-1" class="loadmap" id="loadmap" href="https://maps.google.com/?q=<?= $locations_info['location_address'] ?>" style="cursor: pointer;" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                            </td>
                                            <td>
                                                <input type="text" name="note[]" class="form-control updwn" value="<?= $locations_info['location_note'] ?>" onclick="tabremov()">
                                            </td>
                                            <td>
                                                <a tabindex="-1" onclick="fndellocation('<?= $locations_info['location_id'] ?>','<?= $locations_info['event_id'] ?>')" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a>

                                            </td>
                                            <script type="text/javascript">
                                                function tabremov() {
                                                    var b = $(".no_new_tab");
                                                    b.setAttribute("class", "democlass");
                                                }
                                            </script>
                                        </tr> <?php
                                            }
                                        } ?>

                                <tr class="tr_clone">
                                    <td>
                                        <select <?php if (count($location_data) > 0) {
                                                    echo "tabindex='-1'";
                                                } ?> id="loc_name" class="form-control loc_name updwn no_new_tab" name="add_location[]">
                                            <option>Choose</option>
                                            <?php foreach ($all_locs as $locations) { ?>
                                                <option value="<?php echo $locations['location_name'] ?>"><?php echo $locations['location_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input <?php if (count($location_data) > 0) {
                                                    echo "tabindex='-1'";
                                                } ?> type="text" name="ddate[]" id="strt_date" placeholder="mm/dd/yyyy" class="form-control strt_date updwn w80">
                                    </td>
                                    <td>
                                        <input <?php if (count($location_data) > 0) {

                                                    echo "tabindex='-1'";
                                                } ?> placeholder="HH:MM" type="text" name="time[]" id="strt_time" class="form-control my_Time_CREWSB123" onblur="my_Time_CREWSB(123)">

                                        <script type="text/javascript">
                                            function my_Time_CREWSB(my) {
                                                var my_Time = $('.my_Time_CREWSB' + my).val();
                                                var my_Time_count = my_Time.toString().length;
                                                var arr = ["00", "00"];
                                                if (my_Time_count == 4) {
                                                    if (my_Time > 0 && my_Time < 1300) {
                                                        arr = my_Time.match(/.{1,2}/g);
                                                        var res = arr[0] + ":" + arr[1] + " PM";
                                                        $('.my_Time_CREWSB' + my).val(res);
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
                                                            $('.my_Time_CREWSB' + my).val(res);
                                                        } else {
                                                            alert("Time is not correct")
                                                        }
                                                    }
                                                } else if (my_Time_count > 4) {


                                                } else if (my_Time_count > 0) {
                                                    alert("Value should be 4 digit");
                                                }
                                            }
                                        </script>
                                    </td>
                                    <td><input tabindex="-1" type="text" name="address[]" id="loc_add " class="form-control loc_add updwn"></td>
                                    <td><input tabindex="-1" type="text" name="city[]" id="loc_city" class="form-control loc_city updwn text-center"></td>
                                    <td><input tabindex="-1" type="text" name="state[]" id="loc_state" class="form-control loc_state updwn text-center"></td>
                                    <td><input tabindex="-1" type="text" name="zip[]" id="loc_zip" class="form-control loc_zip updwn text-center" maxlength="5" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
                                    <td><input tabindex="-1" type="text" name="phone[]" id="loc_phone1" class="form-control loc_phone1 contact_no updwn"></td>
                                    <td><input tabindex="-1" type="text" name="phone2[]" id="loc_phone2" class="form-control loc_phone2 contact_no updwn"></td>
                                    <td>
                                        <a tabindex="-1" id="loadmap" class="loadmap" style="cursor: pointer; display: none;" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>

                                    </td>

                                    <td><input <?php if (count($location_data) > 0) {

                                                    echo "tabindex='-1'";
                                                } ?> type="text" name="note[]" class="form-control updwn"></td>

                                    <td>
                                        <button tabindex="-1" class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 evntcrews">
            <div class="box box-default crewstb">
                <div class="box-header with-border">
                    <p class="uhead2">Crews</p>
                    <div class="box-tools pull-right">
                        <button tabindex="-1" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <?php
                $crews_data1 = $this->AdminModel->get_crews_data_id($_POST['eventId']);
                if (count($crews_data1) > 0) {
                    $dispcrwrow = "table-cell";
                } else {
                    $dispcrwrow = "";
                }
                ?>
                <div class="box-body">
                    <div class="table-responsive" id="mycrews">
                        <table class="table table-hover no-margin fixed_table">
                            <thead>
                                <tr>
                                    <th class="w190">Type</th>
                                    <th>Vendor</th>
                                    <th class="w70">Committed</th>
                                    <th class="w70">Hide</th>
                                    <th class="w90">Start Date</th>
                                    <th class="w90">Start Time</th>
                                    <th class="w180">Ending</th>
                                    <th class="w70">O T</th>
                                    <th class="mw120">Location</th>
                                    <th class="w70">Confirmed</th>
                                    <th><span class="th_content" style="width: 100%; text-align: center;">Date</span></th>
                                    <th><span class="th_content" style="width: 100%; text-align: center;">Contact Type</span></th>
                                    <th class="w90">End Date</th>
                                    <th class="w90">End Time</th>
                                    <th class="w60"><span style="display:inline-block; width: 60px ">Tot Hrs</span></th>
                                    <th class="w90">Total Charge</th>
                                    <th class="50">Action</th>
                                </tr>
                                <?php
                                $crews_data = $this->AdminModel->get_crews_data_id($_POST['eventId']);
                                if (count($crews_data) > 0) {
                                    foreach ($crews_data as $crews_info) {
                                        if ($crews_info['crews_confirmed_on'] != "") {
                                            $confrmon = $crews_info['crews_confirmed_on'];
                                        } else {
                                            $confrmon = "";
                                        } ?>
                                        <tr class="tr_clone">
                                            <td>
                                                <select class="form-control " name="crewstype[]" id="crewstype">
                                                    <?php
                                                    foreach ($all_crews as $crews) {
                                                        if ($crews['sub_id'] == $crews_info['crews_type']) {
                                                            $crwtype = "selected";
                                                        } else {
                                                            $crwtype = "";
                                                        }
                                                    ?>
                                                        <option <?= $crwtype ?> value="<?= $crews['sub_id'] ?>-<?= $crews_info['crews_id'] ?>"><?= $crews['sub_name'] ?></option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php
                                                $this->db->select('rv.cus_id, rv.cus_fname, rv.cus_lname');
                                                $this->db->from('vendor_rating as vr');
                                                $this->db->join('register_vendor as rv', 'rv.cus_id = vr.vendor_id');
                                                $this->db->where(array('vr.aptype' => $crews_info["crews_type"]));
                                                $this->db->order_by("vr.rating", "desc");
                                                $this->db->group_by("rv.cus_id");
                                                $query = $this->db->get();
                                                $vendorsql = $query->result_array();
                                                ?>
                                                <select class="form-control vendortype vendortype<?= $crews_info['crews_id'] ?>" name="vendortype[]" style="" onchange="vendoradd('<?= $crews_info['crews_id'] ?>')">
                                                    <option>Choose</option>
                                                    <?php
                                                    foreach ($vendorsql as $vendorsql_dtls) {

                                                        if ($vendorsql_dtls['cus_id'] == $crews_info['crews_vendor']) {
                                                            $crwsubtype = "selected";
                                                        } else {
                                                            $crwsubtype = "";
                                                        }
                                                    ?>
                                                        <option <?= $crwsubtype ?> value="<?= $vendorsql_dtls['cus_id'] ?>"> <?= $vendorsql_dtls['cus_fname'] ?> <?= $vendorsql_dtls['cus_lname'] ?></option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </td>

                                            <td>
                                                <?php
                                                if ($crews_info['crews_commited'] == 1) { ?>
                                                    <input class="crews_commited<?= $crews_info['crews_id'] ?>" tabindex="-1" checked type="checkbox" name="commited[]" id="commited" onchange="vendoradd('<?= $crews_info['crews_id'] ?>')">
                                                <?php
                                                } else { ?>
                                                    <input class="crews_commited<?= $crews_info['crews_id'] ?>" tabindex="-1" type="checkbox" name="commited[]" id="commited" onchange="vendoradd('<?= $crews_info['crews_id'] ?>')">
                                                <?php
                                                } ?>
                                            </td>

                                            <td>
                                                <?php
                                                if ($crews_info['crews_hide'] == 1) {   ?>
                                                    <input onchange="vendoradd('<?= $crews_info['crews_id'] ?>')" class="crews_hide<?= $crews_info['crews_id'] ?>" tabindex="-1" checked type="checkbox" name="hide[]" id="hide">
                                                <?php
                                                } else {   ?>
                                                    <input onchange="vendoradd('<?= $crews_info['crews_id'] ?>')" class="crews_hide<?= $crews_info['crews_id'] ?>" tabindex="-1" type="checkbox" name="hide[]" id="hide"> <?php
                                                                                                                                                                                                                        } ?>
                                            </td>

                                            <td>
                                                <?php $dt = date("m/d/Y", strtotime($crews_info['crews_start_date'])); ?>
                                                <input type="text" onblur="vendoradd('<?= $crews_info['crews_id'] ?>')" name="start_date[]" class="form-control st_date w80 start_date<?= $crews_info['crews_id'] ?> " placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : "";  ?>">
                                            </td>

                                            <td>
                                                <input placeholder="HH:MM" type="text" name="start_time[]" id="" class="start_time<?= $crews_info['crews_id'] ?> form-control st_time my_Time_CREWS<?= $crews_info['crews_id'] ?>" value="<?= $crews_info['crews_start_time'] ?>" onblur="my_Time_CREWS(<?= $crews_info['crews_id'] ?>)">



                                                <script type="text/javascript">
                                                    function my_Time_CREWS(my) {
                                                        var my_Time = $('.my_Time_CREWS' + my).val();
                                                        var my_Time_count = my_Time.toString().length;
                                                        var arr = ["00", "00"];
                                                        if (my_Time_count == 4) {
                                                            if (my_Time > 0 && my_Time < 1300) {
                                                                arr = my_Time.match(/.{1,2}/g);
                                                                var res = arr[0] + ":" + arr[1] + " PM";
                                                                $('.my_Time_CREWS' + my).val(res);
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
                                                                    $('.my_Time_CREWS' + my).val(res);
                                                                } else {
                                                                    alert("Time is not correct")
                                                                }
                                                            }
                                                        } else if (my_Time_count > 4) {


                                                        } else if (my_Time_count > 0) {
                                                            alert("Value should be 4 digit");
                                                        }
                                                    }
                                                </script>
                                            </td>

                                            <td>
                                                <select class="form-control" name="ending[]" id="ending">
                                                    <option> Choose </option>
                                                    <option <? if ($crews_info['crews_ending'] == "Check  with customer") {
                                                                echo "selected";
                                                            }  ?> value="Check  with customer">Check with customer</option>
                                                    <option <? if ($crews_info['crews_ending'] == "After First Dance") {
                                                                echo "selected";
                                                            }  ?> value="After First Dance"> After First Dance</option>
                                                    <option <? if ($crews_info['crews_ending'] == "End of Job") {
                                                                echo "selected";
                                                            }  ?> value="End of Job"> End of Job</option>
                                                </select>

                                            </td>


                                            <td>
                                                <?php

                                                if ($crews_info['crews_over_time'] != "") {
                                                    $setovertime = $crews_info['crews_over_time'];
                                                } else {
                                                    $setovertime = "0.00";
                                                }

                                                ?>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd" style="font-size: 12px;"></span></span>
                                                        <input class="ot<?= $crews_info['crews_id'] ?>" onchange="vendoradd('<?= $crews_info['crews_id'] ?>')" type="text" name="over_time[]" class="form-control updwn" style="width: 60px;" value="<?= $setovertime ?>">
                                                    </div>
                                                </div>

                                            </td>

                                            <td>



                                                <select onchange="vendoradd('<?= $crews_info['crews_id'] ?>')" class="form-control crew_loc location<?= $crews_info['crews_id'] ?>" name="location[]" id="crew_loc" readonly>
                                                    <option value="<?= $crews_info['crews_location'] ?>"><?= $crews_info['crews_location'] ?></option>

                                                    <?php
                                                    $this->db->select('location_type');
                                                    $this->db->from('event_location');
                                                    $this->db->where('event_id', $_POST['eventId']);
                                                    $location_name = $this->db->get()->result_array();



                                                    foreach ($location_name as $crlocations) {

                                                        if ($crlocations['location_type'] == $crews_info['crews_location']) {
                                                            $crloctype = "selected";
                                                        } else {
                                                            $crloctype = "";
                                                        }
                                                    ?>
                                                        <option <?= $crloctype ?> value="<?php echo $crlocations['location_type'] ?>">
                                                            <?php echo $crlocations['location_type'] ?>
                                                        </option>
                                                        <?php
                                                        ?>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>

                                                <input tabindex="-1" type="checkbox" name="confrchk[]" id=" " class=" " value="">
                                            </td>

                                            <td>
                                                <div class="tdconfirmdon">

                                                    <?php $dt = date("m/d/Y", strtotime($confrmon)); ?>
                                                    <?php
                                                    if ($dt == "01/01/1970") { ?>
                                                        <input tabindex="-1" type="text" name="confirmed_on[]" class="form-control confirmedon w80 CREWS_check_date_with_db" placeholder="mm/dd/yyyy" style=" ">
                                                    <?php } else { ?>
                                                        <input tabindex="-1" type="text" name="confirmed_on[]" class="form-control confirmedon w80 CREWS_check_date_with_db" placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?> ">
                                                    <?php }
                                                    ?>

                                                </div>

                                            </td>
                                            <td>
                                                <div class="tdconfirmdon">
                                                    <select tabindex="-1" class="form-control" name="crewscntcttype[]" id="crewscntcttype" form="" style="width: 80px;">
                                                        <option>Email</option>
                                                        <option>Sms</option>
                                                        <option>Whatsapp</option>
                                                        <option>Phone</option>
                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <?php $dt = date("m/d/Y", strtotime($crews_info['crews_end_date'])); ?>
                                                <input tabindex="-1" type="text" onblur="vendoradd('<?= $crews_info['crews_id'] ?>')" name="end_date[]" id="en_date" class="form-control en_date w80 end_date<?= $crews_info['crews_id'] ?>" placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : "";  ?>">
                                            </td>

                                            <td>
                                                <input placeholder="HH:MM" tabindex="-1" type="text" name="end_time[]" id="en_time" class="form-control en_time my_Time_CREWSE<?= $crews_info['crews_id'] ?> end_time<?= $crews_info['crews_id'] ?>" value="<?= $crews_info['crews_end_time']  ?>" onblur="my_Time_CREWSE(<?= $crews_info['crews_id'] ?>)">


                                                <script type="text/javascript">
                                                    function my_Time_CREWSE(my) {
                                                        var my_Time = $('.my_Time_CREWSE' + my).val();
                                                        var my_Time_count = my_Time.toString().length;
                                                        var arr = ["00", "00"];
                                                        if (my_Time_count == 4) {
                                                            if (my_Time > 0 && my_Time < 1300) {
                                                                arr = my_Time.match(/.{1,2}/g);
                                                                var res = arr[0] + ":" + arr[1] + " PM";
                                                                $('.my_Time_CREWSE' + my).val(res);
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
                                                                    $('.my_Time_CREWSE' + my).val(res);
                                                                } else {
                                                                    alert("Time is not correct")
                                                                }
                                                            }
                                                        } else if (my_Time_count > 4) {


                                                        } else if (my_Time_count > 0) {
                                                            alert("Value should be 4 digit");
                                                        }
                                                    }
                                                </script>

                                            </td>

                                            <td>
                                                <input type="text" tabindex="-1" name="total_hours[]" id="total_hours" class="form-control total_hours updwn" value="<?= $crews_info['crews_total_hours']  ?>">
                                            </td>

                                            <td>
                                                <?php
                                                if ($crews_info['crews_total_charge'] != "") {
                                                    $setcrewstotchrge = $crews_info['crews_total_charge'];
                                                } else {
                                                    $setcrewstotchrge = "0.00";
                                                }

                                                ?>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd" style="font-size: 12px;"></span></span>
                                                    <input tabindex="-1" type="text" name="total_charge[]" class="form-control updwn" value="<?= $setcrewstotchrge ?>">
                                                </div>


                                            </td>

                                            <td>

                                                <a tabindex="-1" onclick="fndelcrews('<?= $crews_info['crews_id'] ?>','<?= $crews_info['event_id'] ?>')" class="btn btn-xs btn-danger "><i class="fa fa-minus "></i></a>

                                            </td>

                                        </tr>




                                <?php



                                    }
                                } ?>

                                <script type="text/javascript">
                                    $(".CREWS_check_date_with_db").blur(function() {
                                        var date_ = $(this).val();
                                        var cus_id = "<?= $cus_id ?>";
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url('Fi_home/CREWS_check_date_with_db'); ?>",
                                            data: {
                                                date_: date_,
                                                cus_id: cus_id
                                            },
                                            success: function(result) {
                                                if (!result) {
                                                    alert("CREWS date exist");
                                                }
                                            }
                                        });
                                    });
                                </script>

                                <tr class="tr_clone">
                                    <td>
                                        <select <?php if (count($crews_data) > 0) {
                                                    echo "tabindex='-1'";
                                                } ?> class="form-control lstcrewstype my_last_location2" name="lstcrewstype[]" id="lstcrewstype">
                                            <option>Choose</option>
                                            <?php
                                            foreach ($all_crews as $crews) {
                                            ?>
                                                <option data-value="<?= $crews['sub_id'] ?>" value="<?= $crews['sub_id'] ?>"><?= $crews['sub_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select <?php if (count($crews_data) > 0) {
                                                    echo "tabindex='-1'";
                                                } ?> class="form-control vendortype no_new_tab2" name="vendortype[]" id="vendortype">
                                            <option> Choose </option>
                                    </td>
                                    <td><input tabindex="-1" type="checkbox" name="commited[]" id="commited"></td>
                                    <td><input tabindex="-1" type="checkbox" name="hide[]" id="hide"></td>
                                    <td>
                                        <input <?php if (count($crews_data) > 0) {
                                                    echo "tabindex='-1'";
                                                } ?> type="text" name="start_date[]" placeholder="mm/dd/yyyy" id="st_date" class="form-control st_date w80 no_new_tab2">
                                    </td>

                                    <td><input <?php if (count($crews_data) > 0) {

                                                    echo "tabindex='-1'";
                                                } ?> placeholder="HH:MM" type="text" name="start_time[]" id="st_time" class="form-control st_time my_Time_CREWSS123456789 no_new_tab2" onblur="my_Time_CREWSS('123456789')">



                                        <script type="text/javascript">
                                            function my_Time_CREWSS(my) {
                                                var my_Time = $('.my_Time_CREWSS' + my).val();
                                                var my_Time_count = my_Time.toString().length;
                                                var arr = ["00", "00"];
                                                if (my_Time_count == 4) {
                                                    if (my_Time > 0 && my_Time < 1300) {
                                                        arr = my_Time.match(/.{1,2}/g);
                                                        var res = arr[0] + ":" + arr[1] + " PM";
                                                        $('.my_Time_CREWSS' + my).val(res);
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
                                                            $('.my_Time_CREWSS' + my).val(res);
                                                        } else {
                                                            alert("Time is not correct")
                                                        }
                                                    }
                                                } else if (my_Time_count > 4) {


                                                } else if (my_Time_count > 0) {
                                                    alert("Value should be 4 digit");
                                                }
                                            }
                                        </script>
                                    </td>

                                    <td style="min-width: 160px">


                                        <select <?php if (count($crews_data) > 0) {

                                                    echo "tabindex='-1'";
                                                } ?> class="form-control no_new_tab2" name="ending[]" id="ending">
                                            <option> Choose </option>
                                            <option value="Check  with customer">Check with customer</option>
                                            <option value="After First Dance"> After First Dance</option>
                                            <option value="End of Job"> End of Job</option>
                                        </select>
                                    </td>


                                    <td>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-usd" style="font-size: 12px;"></span></span>
                                                <input type="text" name="over_time[]" class="form-control updwn no_new_tab2" style="width: 60px;" value="0.00" <?php if (count($crews_data) > 0) {

                                                                                                                                                                    echo "tabindex='-1'";
                                                                                                                                                                } ?>>
                                            </div>
                                        </div>

                                    </td>

                                    <td>




                                        <select <?php if (count($crews_data) > 0) {

                                                    echo "tabindex='-1'";
                                                } ?> class="form-control my_last_location3" name="location[]" id="crew_loc" disabled>
                                            <option> </option>
                                            <?php foreach ($all_locs as $crlocations) {

                                            ?>
                                                <option value="<?php echo $crlocations['location_name'] ?>"><?php echo $crlocations['location_name'] ?></option>
                                            <?php } ?>
                                        </select>

                                        <script>
                                            $(document).ready(function() {
                                                $("select.my_last_location2").change(function() {
                                                    var selectedCountry = $("select.my_last_location_<?= count($location_data) ?>").children("option:selected").val();


                                                    optionText = selectedCountry;
                                                    optionValue = selectedCountry;

                                                    $('.my_last_location3').append(`<option selected value="${optionValue}"> ${optionText} </option>`);




                                                });
                                            });
                                        </script>


                                    </td>

                                    <td>
                                        <input tabindex="-1" type="checkbox" name="confrchk[]" id=" " class=" " value="">

                                        <?php


                                        ?>
                                    </td>

                                    <td>
                                        <div class="tdconfirmdon">
                                            <input tabindex='-1' type="text" name="confirmed_on[]" placeholder="mm/dd/yyyy" class="form-control confirmedon crwcnttype w80 CREWS_check_date_with_db" value="" style="">


                                        </div>

                                    </td>

                                    <td>
                                        <div class="tdconfirmdon">
                                            <select tabindex='-1' class="form-control crwcnttype" name="crewscntcttype[]" id="crewscntcttype" form="" style="width: 80px; ">

                                                <option>Choose</option>
                                                <option>Email</option>
                                                <option>Sms</option>
                                                <option>Whatsapp</option>
                                                <option>Phone</option>

                                            </select>
                                        </div>

                                    </td>

                                    <td>

                                        <input tabindex="-1" type="text" name="end_date[]" id="en_date" placeholder="mm/dd/yyyy" class="form-control en_date w80">
                                    </td>

                                    <td><input placeholder="HH:MM" tabindex="-1" type="text" name="end_time[]" id="en_time" class="form-control en_time my_Time_CREWSA123" onblur="my_Time_CREWSA(123)">




                                        <script type="text/javascript">
                                            function my_Time_CREWSA(my) {
                                                var my_Time = $('.my_Time_CREWSA' + my).val();
                                                var my_Time_count = my_Time.toString().length;
                                                var arr = ["00", "00"];
                                                if (my_Time_count == 4) {
                                                    if (my_Time > 0 && my_Time < 1300) {
                                                        arr = my_Time.match(/.{1,2}/g);
                                                        var res = arr[0] + ":" + arr[1] + " PM";
                                                        $('.my_Time_CREWSA' + my).val(res);
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
                                                            $('.my_Time_CREWSA' + my).val(res);
                                                        } else {
                                                            alert("Time is not correct")
                                                        }
                                                    }
                                                } else if (my_Time_count > 4) {


                                                } else if (my_Time_count > 0) {
                                                    alert("Value should be 4 digit");
                                                }
                                            }
                                        </script>
                                    </td>

                                    <td>

                                        <input tabindex="-1" type="text" name="total_hours[]" id="" class="form-control total_hours updwn">
                                    </td>

                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-usd" style="font-size: 12px;"></span></span>
                                            <input tabindex="-1" type="text" name="total_charge[]" class="form-control updwn" value="0.00">
                                        </div>
                                    </td>
                                    <td>
                                        <button tabindex="-1" class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            </select>
        </div>
        <div class="col-md-12">
            <div class="box box-default jobinfotb">
                <div class="box-header with-border">
                    <p class="uhead2">JOB INFO</p>
                    <div class="box-tools pull-right">
                        <button tabindex="-1" type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <input type="hidden" name="hdneventId" id="hdneventId" value="<?= $_POST['eventId'] ?>">
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="table-responsive ">
                                <table class="table table-hover no-margin ">
                                    <thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type </th>
                                            <th>Notes</th>
                                            <th>Import</th>
                                            <th>Action</th>
                                        </tr>
                                    </tbody>
                                    <tbody id="myjobs">
                                        <?php
                                        $jobinfo_data = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $_POST['eventId'] . "' ORDER BY jb_id ASC");
                                        $jobinfoResult = $jobinfo_data->result();
                                        if ($jobinfo_data->num_rows() > 0) {
                                            foreach ($jobinfoResult as $jobs_info) { ?>
                                                <tr class="tr_clone trshowcustt jbdlclik" style="cursor: pointer;">
                                                    <td>
                                                        <input tabindex="-1" type="text" name="jbname[]" id="jid1" class="form-control fcap jid1 updwn text-left" value="<?= $jobs_info->jb_name ?>" onchange="fnupdatejobinfodtls(this.value,'jb_name','<?= $jobs_info->jb_id ?>')">
                                                        <input type="hidden" name="hidevntid" id="hidevntid" class="hidevntid" value="<?= $_POST['eventId'] ?>">
                                                        <input type="hidden" name="hidenjbId" id="hidenjbId" class="hidenjbId" value="<?= $jobs_info->jb_id ?>">
                                                    </td>
                                                    <td>
                                                        <select tabindex="-1" class="form-control jid2" name="jptype[]" id="jid2">
                                                            <option> Choose </option>
                                                            <?php
                                                            $getjbsubcatlist = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=33");
                                                            foreach ($getjbsubcatlist->result() as $getjbsubcatlist_dtls) {
                                                                if ($jobs_info->jb_type == $getjbsubcatlist_dtls->sub_name) {
                                                                    $selsbcat = "selected";
                                                                } else {
                                                                    $selsbcat = "";
                                                                }
                                                            ?>
                                                                <option <?= $selsbcat ?> value="<?= $getjbsubcatlist_dtls->sub_name ?>"><?= $getjbsubcatlist_dtls->sub_name ?></option>
                                                            <?php
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input tabindex="-1" type="text" name="jnote[]" id="jid3" class="form-control jid3 fcap updwn" value="<?= $jobs_info->jb_notes ?>" onchange="fnupdatejobinfodtls(this.value,'jb_notes','<?= $jobs_info->jb_id ?>')">
                                                    </td>

                                                    <td>
                                                        <select tabindex="-1" class="form-control jid4" name="jimpevntype" id="jid4">
                                                            <option>Choose</option>
                                                            <?php
                                                            $user = $this->session->fi_session['id'];
                                                            $evnttyplist_sql = $this->db->query("SELECT * FROM event_jobs WHERE event_id NOT IN('" . $_POST['eventId'] . "')");
                                                            $evnttyplistResult = $evnttyplist_sql->result();
                                                            foreach ($evnttyplistResult as $evnttyplistsql_dtls) {
                                                                $evtyplst_sql = $this->db->query("SELECT * FROM events_register WHERE event_id='" . $evnttyplistsql_dtls->event_id . "' and `user` = '" . $user . "' ");
                                                                $evtyplstsqlrow = $evtyplst_sql->row();
                                                            ?>
                                                                <option data-value="<?= $evnttyplistsql_dtls->jb_id ?>" value="<?= $evtyplstsqlrow->event_name . "-" . $evnttyplistsql_dtls->jb_name ?>"><?= $evtyplstsqlrow->event_name . "-" . $evnttyplistsql_dtls->jb_name ?></option>
                                                            <?
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>

                                                    <td style="width: 50px;">
                                                        <a tabindex="-1" onclick="fndelevntjob('<?= $jobs_info->jb_id ?>','<?= $jobs_info->event_id ?>')" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a>
                                                    </td>
                                                </tr> <?php
                                                    }
                                                } ?>
                                        <tr class="tr_clone trshowcustt">
                                            <td>
                                                <input tabindex="-1" type="text" name="jbname" id="lstjid1" class="form-control fcap lstjid1 updwn">
                                                <input type="hidden" name="hidevntid" id="hidevntid" class="hidevntid" value="<?= $_POST['eventId'] ?>">
                                                <input type="hidden" name="hidenjbId" id="hidenjbId" class="hidenjbId" value="">
                                            </td>
                                            <td>
                                                <select tabindex="-1" class="form-control lstjid2 " name="jptype" id="lstjid2">
                                                    <option> Choose</option>
                                                    <?php
                                                    $getjbsubcatlist = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=33");
                                                    foreach ($getjbsubcatlist->result() as $getjbsubcatlist_dtls) {
                                                    ?>
                                                        <option value="<?= $getjbsubcatlist_dtls->sub_name ?>"><?= $getjbsubcatlist_dtls->sub_name ?></option>
                                                    <?php
                                                    } ?>
                                                </select>
                                            </td>
                                            <td><input tabindex="-1" type="text" name="jnote" id="lstjid3" class="form-control lstjid3 fcap updwn"></td>
                                            <td>
                                                <select tabindex="-1" class="form-control lstjid2 " name="jptype" id="lstjid2">
                                                    <option> Choose</option>
                                                    <?php
                                                    $getjbsubcatlist = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=33");
                                                    foreach ($getjbsubcatlist->result() as $getjbsubcatlist_dtls) {
                                                    ?>
                                                        <option value="<?= $getjbsubcatlist_dtls->sub_name ?>"><?= $getjbsubcatlist_dtls->sub_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button tabindex="-1" class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="outer-jobdtls">
                        <div class="table-responsive">
                            <table class="table table-hover no-margin">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="display: none;">#</th>
                                        <th width="14%">Type</th>
                                        <th>First Name </th>
                                        <th>Spouse</th>
                                        <th width="6%">Children</th>
                                        <th><span class="inblock w90">Crew Member</span></th>
                                        <th>Start Time</th>
                                        <th width="25%">Note</th>
                                        <th>Phone </th>
                                        <th>Action</th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="tr_clone">
                                        <td style="display: none;">
                                            <input tabindex="-1" type="text" name="hdnjobId" class="form-control hdnjobId" value="10">
                                            <input tabindex="-1" type="text" name="hdnevntId" class="form-control hdnevntId" value="6">
                                        </td>
                                        <td>
                                            <select tabindex="-1" class="form-control lstjobtypedtls" name="job_type" id="job_type">
                                                <option> Choose </option>
                                                <option value="Parents">Parents</option>
                                                <option value="Special">Special</option>
                                                <option value="Kallah">Kallah</option>
                                                <option value="Chosson">Chosson</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Sibling">Sibling</option>
                                                <option value="Married Sibling">Married Sibling</option>
                                                <option value="Grandparents M">Grandparents M</option>
                                                <option value="Grandparents P">Grandparents P</option>
                                                <option value="Grandfather">Grandfather</option>
                                                <option value="Grandmother">Grandmother</option>
                                                <option value="Great Grandparents">Great Grandparents</option>
                                                <option value="Great Grandfather">Great Grandfather</option>
                                                <option value="Great Grandmother">Great Grandmother</option>
                                                <option value="Uncle / Aunt">Uncle / Aunt</option>
                                                <option value="Cousins">Cousins</option>
                                                <option value="Chosson">Chosson</option>
                                            </select>
                                        </td>
                                        <td><input tabindex="-1" type="text" name="jfname[]" class="form-control fcap"></td>
                                        <td><input tabindex="-1" type="text" name="spouse[]" class="form-control fcap"></td>
                                        <td><input tabindex="-1" type="text" name="children[]" class="form-control fcap"></td>
                                        <td>
                                            <select tabindex="-1" class="form-control" name="jbcrmemventype[]">
                                                <option> Choose </option>
                                            </select>
                                        </td>
                                        <td><input placeholder="HH:MM" tabindex="-1" type="text" name="jbstart_time[]" id="jbstart_time" class="form-control jbstart_time my_Time_CREWSF123" value="" onblur="my_Time_CREWSF('123')">


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
                                            </script>
                                        </td>
                                        <td><input tabindex="-1" type="text" name="jbnote[]" class="form-control fcap"></td>
                                        <td><input tabindex="-1" type="text" name="jbphone[]" class="form-control contact_no"></td>
                                        <td>


                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-default crewavailtb">
                <div class="box-header with-border">
                    <p class="uhead2">CREW AVAILABILITY</p>
                    <div class="box-tools pull-right">
                        <button tabindex="-1" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin fixed_table">
                            <thead>
                            <tbody>
                                <tr>
                                    <th class="w250">Type</th>
                                    <th class="">Vendor</th>
                                    <th class="w140"><span style="width: 120px;">Template Type</span></th>
                                    <th class="w90">Start Date</th>
                                    <th class="w90">Start Time</th>
                                    <th class="w140">Status</th>
                                    <th>Note</th>
                                    <th class="w110">Email Availability</th>
                                    <th class="w100">Add to Crews </th>
                                    <th class="w50">Action</th>
                                </tr>
                            </tbody>

                            <?php
                            $crewavail_data = $this->db->query("SELECT * FROM crew_availability WHERE event_id='" . $_POST['eventId'] . "'");
                            if ($crewavail_data->num_rows() > 0) {
                                foreach ($crewavail_data->result() as $crewavail_data_info) {
                            ?>
                                    <tbody id="mycrewavail">
                                        <tr class="tr_clone">
                                            <td>
                                                <select tabindex="-1" class="form-control atype " name="atype[]" id="atype" style="width:250px;">
                                                    <option>Choose </option>
                                                    <?php foreach ($all_crews as $crews) {
                                                        if ($crews['sub_name'] == $crewavail_data_info->type) {
                                                            $acrewsel = "selected";
                                                        } else {
                                                            $acrewsel = "";
                                                        }
                                                    ?>
                                                        <option <?= $acrewsel ?> value="<?php echo $crews['sub_name'] ?>"><?php echo $crews['sub_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td>
                                                <select tabindex="-1" class="form-control cavailvend" name="cavailvend[]" id="cavailvend" style="">
                                                    <option>Choose</option>
                                                    <option selected <?= $crewavail_data_info->vendor ?>> <?= $crewavail_data_info->vendor ?></option>
                                                </select>
                                            </td>
                                            <td style="width: 80px;">
                                                <select tabindex="-1" class="form-control crwstemptyp" name="crwstemptyp[]" id="crwstemptyp">
                                                    <option> Choose </option>
                                                    <?php
                                                    $crwtmp_sql = $this->db->query('SELECT * FROM adm_crewavailability_info ORDER BY id');
                                                    foreach ($crwtmp_sql->result() as $crwtmpsql_dtls) {
                                                        if ($crwtmpsql_dtls->id == $crewavail_data_info->template_type) {
                                                            $crwtmpsel = "selected";
                                                        } else {
                                                            $crwtmpsel = "";
                                                        }

                                                    ?>
                                                        <option <?= $crwtmpsel ?> value="<?= $crwtmpsql_dtls->id ?>"><?= $crwtmpsql_dtls->template_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>


                                            <td style="width: 95px;">
                                                <?php $dt =  date("m/d/Y", strtotime($crewavail_data_info->start_date)); ?>
                                                <input tabindex="-1" type="text" name="castart_date[]" id="castart_date" class="form-control castart_date w80" plaveholder="mm/dd/yyyy" value="<?php echo ($dt != "01/01/1970") ? $dt : ""; ?>">
                                            </td>

                                            <td>
                                                <input tabindex="-1" type="time" name="caastart_time[]" id="caastart_time" class="form-control" value="<?= $crewavail_data_info->start_time ?>">




                                                <script type="text/javascript">
                                                    function my_Time_CREWSD(my) {
                                                        var my_Time = $('.my_Time_CREWSC' + my).val();
                                                        var my_Time_count = my_Time.toString().length;
                                                        var arr = ["00", "00"];
                                                        if (my_Time_count == 4) {
                                                            if (my_Time > 0 && my_Time < 1300) {
                                                                arr = my_Time.match(/.{1,2}/g);
                                                                var res = arr[0] + ":" + arr[1] + " PM";
                                                                $('.my_Time_CREWSC' + my).val(res);
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
                                                                    $('.my_Time_CREWSC' + my).val(res);
                                                                } else {
                                                                    alert("Time is not correct")
                                                                }
                                                            }
                                                        } else if (my_Time_count > 4) {


                                                        } else if (my_Time_count > 0) {
                                                            alert("Value should be 4 digit");
                                                        }
                                                    }
                                                </script>

                                            </td>

                                            <td>
                                                <select tabindex="-1" class="form-control caastatus" name="caastatus[]" id="caastatus">
                                                    <option> Choose </option>
                                                    <option <? if ($crewavail_data_info->status == "Available") {
                                                                echo "selected";
                                                            } ?> value="Available">Available</option>
                                                    <option <? if ($crewavail_data_info->status == "Not Available") {
                                                                echo "selected";
                                                            } ?> value="Not Available">Not Available</option>
                                                    <option <? if ($crewavail_data_info->status == "Pending") {
                                                                echo "selected";
                                                            } ?> value="Pending">Pending</option>
                                                </select>
                                            </td>

                                            <td><input tabindex="-1" type="text" name="canote[]" id="canote" value="<?= $crewavail_data_info->note ?>" class="form-control fcap updwn"></td>

                                            <td>
                                                <a tabindex="-1" href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal2">Email</a>
                                            </td>

                                            <td>

                                                <?php
                                                if ($crewavail_data_info->add_to_crews == "1") {
                                                    $crchk = "checked";
                                                } else {
                                                    $crchk = "";
                                                }
                                                ?>
                                                <input <?= $crchk ?> tabindex="-1" type="checkbox" class="add_to_crews" name="add_to_crews[]" id="add_to_crews">
                                            </td>

                                            <td>
                                                <a tabindex="-1" onclick="fndelevntjob('<?= $jobs_info->jb_id ?>','<?= $jobs_info->event_id ?>')" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a>
                                            </td>

                                            <td style="display: none;">
                                                <input tabindex="-1" type="text" name="hdncreventId" id="hdncreventId" value="<?= $_POST['eventId'] ?>">
                                                <input tabindex="-1" type="text" class="hdncravlId" name="hdncravlId" id="hdncravlId" value="<?= $crewavail_data_info->id ?>">
                                            </td>

                                        </tr>
                                    </tbody>

                            <?php }
                            } ?>

                            <tr class="tr_clone">
                                <td>
                                    <select tabindex="-1" class="form-control atype" name="atype[]" id="atype" style="width:150px;">
                                        <option> Choose </option>
                                        <?php foreach ($all_crews as $crews) { ?>
                                            <option value="<?php echo $crews['sub_name'] ?>"><?php echo $crews['sub_name'] ?></option>
                                        <?php } ?>
                                    </select>


                                </td>

                                <td>
                                    <select tabindex="-1" class="form-control cavailvend " name="cavailvend[]" id="cavailvend" style="width:150px;">
                                        <option> Choose </option>

                                    </select>
                                </td>

                                <td style="width: 80px;">

                                    <select tabindex="-1" class="form-control crwstemptyp" name="crwstemptyp[]" id="crwstemptyp">
                                        <option> Choose </option>
                                        <?php
                                        $crwtmp_sql = $this->db->query('SELECT * FROM adm_crewavailability_info ORDER BY id');
                                        foreach ($crwtmp_sql->result() as $crwtmpsql_dtls) {
                                        ?>
                                            <option value="<?= $crwtmpsql_dtls->id ?>"><?= $crwtmpsql_dtls->template_name ?></option>
                                        <?php } ?>
                                    </select>

                                </td>


                                <td><input tabindex="-1" type="text" name="castart_date[]" id="castart_date" placeholder="mm/dd/yyyy" class="form-control castart_date w80"></td>

                                <td><input placeholder="HH:MM" tabindex="-1" type="text" name="caastart_time[]" id="caastart_time" class="form-control my_Time_CREWSC123" onblur="my_Time_CREWSC(123)">


                                    <script type="text/javascript">
                                        function my_Time_CREWSC(my) {
                                            var my_Time = $('.my_Time_CREWSC' + my).val();
                                            var my_Time_count = my_Time.toString().length;
                                            var arr = ["00", "00"];
                                            if (my_Time_count == 4) {
                                                if (my_Time > 0 && my_Time < 1300) {
                                                    arr = my_Time.match(/.{1,2}/g);
                                                    var res = arr[0] + ":" + arr[1] + " PM";
                                                    $('.my_Time_CREWSC' + my).val(res);
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
                                                        $('.my_Time_CREWSC' + my).val(res);
                                                    } else {
                                                        alert("Time is not correct")
                                                    }
                                                }
                                            } else if (my_Time_count > 4) {


                                            } else if (my_Time_count > 0) {
                                                alert("Value should be 4 digit");
                                            }
                                        }
                                    </script>

                                </td>

                                <td>
                                    <select tabindex="-1" class="form-control caastatus" name="caastatus[]" id="caastatus">
                                        <option> Choose </option>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </td>

                                <td><input tabindex="-1" type="text" name="canote[]" id="canote" class="form-control fcap updwn"></td>

                                <td>
                                    <a tabindex="-1" class="btn btn-xs btn-success fnpostcrewemailinfo" data-toggle="modal" data-target="#myModal2">Email</a>
                                </td>

                                <td>
                                    <input tabindex="-1" type="checkbox" class="add_to_crews" name="add_to_crews[]" id="add_to_crews">
                                </td>

                                <td>

                                    <button tabindex="-1" class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                                </td>

                                <td style="display: none;">
                                    <input tabindex="-1" type="text" name="hdncreventId" id="hdncreventId" value="<?= $_POST['eventId'] ?>">
                                </td>

                            </tr>



                            </thead>

                        </table>

                    </div>



                </div>



            </div>


        </div>



        <div class="col-md-12">

            <div class="box box-default lettertb">


                <div class="box-header with-border">

                    <p class="uhead2">LETTERS</p>

                    <div class="box-tools pull-right">

                        <button tabindex="-1" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                        </button>

                    </div>



                </div>


                <div class="box-body">

                    <div class="table-responsive">

                        <table class="table   table-hover no-margin fixed_table">

                            <thead>

                                <tr>



                                    <th>Letter</th>

                                    <th class="w80">Email</th>

                                    <th class="w80">Fax</th>

                                    <th class="w80">Print</th>

                                    <th class="w80">View</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>



                                    <td style="width: 200px;">

                                        <select tabindex="-1" class="form-control lettertypes" name="lettertypes" id="lettertypes">
                                            <option> Choose </option>
                                            <?php
                                            $letters_sql = $this->db->query('SELECT * FROM adm_letters_type ORDER BY id');
                                            foreach ($letters_sql->result() as $letterssql_dtls) {
                                            ?>
                                                <option value="<?= $letterssql_dtls->id ?>"><?= $letterssql_dtls->name ?></option>
                                            <?php } ?>
                                        </select>

                                    </td>

                                    <td>


                                        <a tabindex="-1" class="btn btn-xs btn-success fnpostemailinfo" data-toggle="modal" data-target="#myModal2">Email</a>
                                    </td>

                                    <td><a tabindex="-1" href="#" class="btn btn-xs btn-primary">Fax</a></td>

                                    <td><a tabindex="-1" href="#" class="btn btn-xs btn-warning">Print</a></td>

                                    <td>
                                        <a tabindex="-1" href="#" class="btn btn-xs btn-info fnviewinfo" data-toggle="modal" data-target="#viewModal">View</a>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>



                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-default associordertb firstblock_bg">

                <div class="box-header with-border">
                    <p class="uhead2">ASSOCIATED ORDER </p>
                    <div class="box-tools pull-right">
                        <button tabindex="-1" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin fixed_table">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Events notes</th>
                                    <th style="width: 6%;">Date Entered</th>
                                    <th style="width: 6%;">Due Date</th>
                                    <th style="width: 6%;">Cont. type</th>
                                    <th style="width: 6%;">Discount</th>
                                    <th style="width: 6%;">Sub Total</th>
                                    <th style="width: 6%;">Tax </th>
                                    <th style="width: 6%;">Amount </th>
                                    <th style="width: 5%;">Paid </th>
                                    <th style="width: 5%;">Bal. Due</th>
                                    <th style="width: 5%;">Tax Rate </th>
                                    <th style="width: 5%;">County </th>
                                    <th style="width: 5%;">User </th>

                                </tr>
                                <?php
                                $query      = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $_POST['cusid'] . "'");
                                $qry_row    = $query->row();
                                $eventnm    = $qry_row->event_name;
                                $eventdate_    = date("m/d/Y", strtotime($qry_row->event_date));
                                $eventty_    = $qry_row->event_type;

                                $invoicesql = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $_POST['cusid'] . "' ORDER BY invoice_id DESC LIMIT 1");
                                $invoice_nrows = $invoicesql->num_rows();
                                $invoiceData = $invoicesql->result();



                                $chkinvsql = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $_POST['cusid'] . "' ORDER BY invoice_id DESC LIMIT 1");
                                $isinvoicerow = $chkinvsql->row();
                                if ($invoice_nrows > 0) {
                                    foreach ($invoiceData as $invoicesql_dtls) {
                                        $invoiceId      = $invoicesql_dtls->invoice_id;
                                        $invoicedt      = $invoicesql_dtls->invoice_date;
                                        $invoiceduedt   = $invoicesql_dtls->invoice_due_date;
                                        $invoicetype    = $invoicesql_dtls->invoice_type;
                                        $contracttype   = $invoicesql_dtls->invoice_contract_type;
                                        $invdescnt      = $invoicesql_dtls->invoice_discount;
                                        $invsubtot      = $invoicesql_dtls->invoice_sub_total;
                                        $invtax         = $invoicesql_dtls->invoice_tax;
                                        $invamount      = $invoicesql_dtls->invoice_amount;
                                        $invpaid        = $invoicesql_dtls->invoice_paid;
                                        $invbaldue      = $invoicesql_dtls->invoice_balance_due;
                                        $invtaxrate     = $invoicesql_dtls->invoice_tax_rate;
                                        $invcntry       = $invoicesql_dtls->invoice_county;
                                        $user           = $invoicesql_dtls->user;
                                        $invcustId      = $invoicesql_dtls->cust_id;


                                        $cond = array('id' => $user);
                                        $tbl = "users";
                                        $users = $this->HomeModel->get_all_by_cond($tbl, $cond);
                                        $setinvuser =  $users[0]['username'];



                                        if ($invoicedt != "") {
                                            $invdate = date("m/d/Y", strtotime($invoicedt));
                                        } else {
                                            $invdate = date('m/d/Y');
                                        }
                                        if ($invoiceduedt != "") {
                                            $invduedate = date("m/d/Y", strtotime($invoiceduedt));
                                        } else {
                                            $invduedate = "";
                                        }
                                        if ($invdescnt != "") {
                                            $setinvdescnt = $invdescnt;
                                        } else {
                                            $setinvdescnt = "";
                                        }
                                        if ($invsubtot != "") {
                                            $setinvsubtot = $invsubtot;
                                        } else {
                                            $setinvsubtot = "";
                                        }
                                        if ($invsubtot != "") {
                                            $setinvsubtot = $invsubtot;
                                        } else {
                                            $setinvsubtot = "";
                                        }
                                        if ($invtax != "") {
                                            $setinvtax = $invtax;
                                        } else {
                                            $setinvtax = "";
                                        }
                                        if ($invamount != "") {
                                            $setinvamount = $invamount;
                                        } else {
                                            $setinvamount = "";
                                        }
                                        if ($invpaid != "") {
                                            $setinvpaid = $invpaid;
                                        } else {
                                            $setinvpaid = "";
                                        }
                                        if ($invbaldue != "") {
                                            $setinvbaldue = $invbaldue;
                                        } else {
                                            $setinvbaldue = "";
                                        }
                                        if ($invtaxrate != "") {
                                            $setinvtaxrate = $invtaxrate;
                                        } else {
                                            $setinvtaxrate = "";
                                        }
                                        if ($invcntry != "") {
                                            $setinvcntry = $invcntry;
                                        } else {
                                            $setinvcntry = "";
                                        }

                                        if ($isinvoicerow->invoice_id == $invoiceId) {
                                            $lstinvoiceid = "fa-plus";
                                            $lstinvoicecls = "btn-success";
                                            $fninvoce = "fncrinvoice('" . $invoiceId . "')";
                                            $lstrcd = "lstrecd";
                                        } else {

                                            $lstinvoiceid = "fa-minus";
                                            $lstinvoicecls = "btn-danger";
                                            $fninvoce = "fndelinvoice('" . $invoiceId . "')";
                                            $lstrcd = "";
                                        }
                                ?>
                                        <tr class="tr_clone">

                                            <td tabindex="-1" id="<?= $lstrcd ?>"><?= $eventnm ?>-<?= $eventdate_ ?>-<?= $eventty_ ?>

                                            </td>

                                            <td><input tabindex="-1" type="text" name="invoice_date<?= $invoiceId ?>" id="invoice_date<?= $invoiceId ?>" placeholder="mm/dd/yyyy" class="form-control dt w80" value="<?= $invdate ?>">
                                            </td>
                                            <td><input tabindex="-1" type="text" name="invoice_due_date<?= $invoiceId ?>" id="invoice_due_date<?= $invoiceId ?>" placeholder="mm/dd/yyyy" class="form-control dt1 w80" value="<?= $invduedate ?>"></td>
                                            <td>
                                                <select tabindex="-1" class="form-control" name="invoice_contract_type<?= $invoiceId ?>" id="invoice_contract_type<?= $invoiceId ?>" style="min-width: 90px; width: 100%;">
                                                    <option value="">Choose</option>
                                                    <?php

                                                    $evntypsql = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=35 ORDER BY sub_id ASC");
                                                    foreach ($evntypsql->result() as $evntypsql_dtls) {
                                                        if ($evntypsql_dtls->sub_id == $contracttype) {
                                                            $selectedevtyp = "selected";
                                                        } else {
                                                            $selectedevtyp = "";
                                                        }
                                                    ?>
                                                        <option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->sub_id ?>"><?= $evntypsql_dtls->sub_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"></span>
                                                        <input tabindex="-1" type="text" name="invoice_discount<?= $invoiceId ?>" id="invoice_discount<?= $invoiceId ?>" class="form-control updwn" style="width: 40px;" value="<?= $setinvdescnt ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input tabindex="-1" type="text" name="invoice_sub_total<?= $invoiceId ?>" id="invoice_sub_total<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvsubtot) ?>">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input tabindex="-1" type="text" name="invoice_tax<?= $invoiceId ?>" id="invoice_tax<?= $invoiceId ?>" class="form-control updwn" style="width: 60px;" value="<?= $setinvtax ?>">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input tabindex="-1" type="text" name="invoice_amount<?= $invoiceId ?>" id="invoice_amount<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvamount) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input tabindex="-1" type="text" name="invoice_paid<?= $invoiceId ?>" id="invoice_paid<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvpaid) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input tabindex="-1" type="text" name="invoice_balance_due<?= $invoiceId ?>" id="invoice_balance_due<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvbaldue) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><input tabindex="-1" type="text" name="invoice_tax_rate<?= $invoiceId ?>" id="invoice_tax_rate<?= $invoiceId ?>" class="18 form-control updwn" value="<?= $setinvtaxrate ?>%"></td>
                                            <td><input tabindex="-1" type="text" name="invoice_country<?= $invoiceId ?>" id="invoice_country<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvcntry ?>" style="width: 80px;"></td>
                                            <td><input tabindex="-1" type="text" name="invoice_user<?= $invoiceId ?>" id="invoice_user<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvuser ?>" style="width: 60px;"></td>
                                        </tr>
                                <?php }
                                } ?>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="display: none;">
            <div class="box box-default">
                <div class="box-header with-border">
                    <p class="uhead2">Affiliated Vendor</p>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Vendor</th>
                                    <th>Action</th>
                                </tr>
                                <tr class="tr_clone">
                                    <td><input type="text" name="type[]" class="form-control"></td>
                                    <td><input type="text" name="vendor[]" class="form-control"></td>
                                    <td>
                                        <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="hdneventId" id="hdneventId" value="<?= $_POST['eventId'] ?>">
        <script type="text/javascript">
           // $(document).ready(function() {
           //     $(".select_dropdown").select2();
           // });
        </script> <?
                }
            }
