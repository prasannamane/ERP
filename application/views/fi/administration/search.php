<!DOCTYPE html>
<!-- <html>
  <head> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Administration</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

</style>



  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <!-- <div class="wrapper">

      <?php  ?> -->

      <!-- Left side column. contains the logo and sidebar -->

      <!-- <?php  ?> -->

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Administration</a></li>

        <li class="active">Items</li>

      </ol>

    </section>
    <?php if(isset($success)){?>
    <div class="alert alert-success alert-dismissable fade in">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong></strong> <?=$success?>
    </div>
    <?php }?>
    <?php if(isset($error)){?>
    <div class="alert alert-danger alert-dismissable fade in">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Error!</strong> <?=$error?>
    </div>
    <?php }?>

        <section class="content search_options">
            <!-- TABLE: LATEST ORDERS -->
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-5">
                                    <h3 class="uhead1"><?=$page_title?></h3>
                                </div>
                    
                                <div class="col-sm-7 col-md-7">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">
                                            <li><a href="#" class="uhead2"> Main Menu </a></li>
                                            <li><a href="#" class="uhead2"> Options </a></li>
                                            <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                                        </ul>
                                        <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-info firstblock_bg">
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="#" method="POST" name="eeform" id="eeform">
                                    <table class="table table-hover no-margin fixed_table">
                                        <thead>
                                            <tr>
                                                <th class="w40">#</th>
                                                <th class="w300">Field Name</th>
                                                <th class=" ">Custom 1</th>
                                                <th class=" ">Custom 2</th>
                                                <th class="w50">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="divfiltercust">
                                        <?php

                                        //search_customer_opt
                                        $user = $this->session->fi_session['id'];
                                        $act_custsql = $this->db->query("SELECT * FROM search_customer_opt where user = '".$user."'");
                                        $act_custrow = $act_custsql->row();

                                        $getfname = $act_custrow->cus_fname;
                                        $getlname = $act_custrow->cus_lname;
                                        $getcname = $act_custrow->cus_company_name;
                                        $getaddr1 = $act_custrow->cus_address1;
                                        $getaddr2 = $act_custrow->cus_address2;
                                        $getcity = $act_custrow->cus_city;
                                        $getstate = $act_custrow->cus_state;
                                        $getzip = $act_custrow->cus_zip;
                                        $getarea = $act_custrow->cus_area;
                                        $getphno = $act_custrow->phone_no;

                                        $getacc_no = $act_custrow->acc_no;
                                        $getacc_type = $act_custrow->acc_type;
                                        $getvendor_name = $act_custrow->vendor_name;
                                        $getevent_from_date = $act_custrow->event_from_date;
                                        $getevent_to_date = $act_custrow->event_to_date;
                                        $getevent_type = $act_custrow->event_type;
                                        $getevent_location = $act_custrow->event_location;
                                        $getbalance_as_of = $act_custrow->balance_as_of;
                                        $getinvoice_no = $act_custrow->invoice_no;
                                        $getreferred_by = $act_custrow->referred_by;

                                    
                                    if($getacc_no == 1)
                                    {
                                        $fngetacc_nochksts="checked";
                                    }else{
                                        $fngetacc_nochksts="";
                                    }
                                    if($getacc_type==1)
                                    {
                                        $fngetacc_typechksts="checked";
                                    }else{
                                        $fngetacc_typechksts="";
                                    }
                                    if($getvendor_name==1)
                                    {
                                        $fngetvendor_namechksts="checked";
                                    }else{
                                        $fngetvendor_namechksts="";
                                    }
                                    if($getevent_from_date==1)
                                    {
                                        $fngetevent_from_datechksts="checked";
                                    }else{
                                        $fngetevent_from_datechksts="";
                                    }
                                    if($getevent_to_date==1)
                                    {
                                        $fngetevent_to_datechksts="checked";
                                    }else{
                                        $fngetevent_to_datechksts="";
                                    }
                                    if($getevent_type==1)
                                    {
                                        $fngetevent_typechksts="checked";
                                    }else{
                                        $fngetevent_typechksts="";
                                    }
                                    if($getevent_location==1)
                                    {
                                        $fngetevent_locationchksts="checked";
                                    }else{
                                        $fngetevent_locationchksts="";
                                    }
                                    if($getinvoice_no==1)
                                    {
                                        $fngetinvoice_nochksts="checked";
                                    }else{
                                        $fngetinvoice_nochksts="";
                                    }
                                    if($getreferred_by==1)
                                    {
                                        $fngetreferred_bychksts="checked";
                                    }else{
                                        $fngetreferred_bychksts="";
                                    }
                                    if($getbalance_as_of==1)
                                    {
                                        $fngetbalance_as_ofchksts="checked";
                                    }else{
                                        $fngetbalance_as_ofchksts="";
                                    }



                                        if($getfname==1)
                                        {
                                            $fnmamechksts="checked";
                                        }else{
                                            $fnmamechksts="";
                                        }

                                        if($getlname==1)
                                        {
                                            $lnmamechksts="checked";
                                        }else{
                                            $lnmamechksts="";
                                        }


                                        if($getcname==1)
                                        {
                                            $cnmamechksts="checked";
                                        }else{
                                            $cnmamechksts="";
                                        }


                                        if($getaddr1==1)
                                        {
                                            $addr1chksts="checked";
                                        }else{
                                            $addr1chksts="";
                                        }

                                        if($getaddr2==1)
                                        {
                                            $addr2chksts="checked";
                                        }else{
                                            $addr2chksts="";
                                        }

                                        if($getcity==1)
                                        {
                                            $citychksts="checked";
                                        }else{
                                            $citychksts="";
                                        }

                                        if($getstate==1)
                                        {
                                            $statechksts="checked";
                                        }else{
                                            $statechksts="";
                                        }

                                        if($getzip==1)
                                        {
                                            $zipchksts="checked";
                                        }else{
                                            $zipchksts="";
                                        }

                                        if($getarea==1)
                                        {
                                            $areachksts="checked";
                                        }else{
                                            $areachksts="";
                                        }

                                        if($getphno==1)
                                        {
                                            $phnochksts="checked";
                                        }else{
                                            $phnochksts="";
                                        }

                                ?>
                        <tr>
                            <td>1</td>
                            <td> <label>Name</label> </td>

                             <td></td>
                              <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fnmamechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="fname_radio_click[]" onchange="fnupdatesearch('cus_fname','<?=$getfname?>')" >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>

                        <!-- <tr>
                            <td>2</td>
                            <td> <label>Last Name</label> </td>

                            <td>
                              <label class="switch">
                                  <input <?=$lnmamechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="lname_radio_click[]" onchange="fnupdatesearch('cus_lname','<?=$getlname?>')" >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr> -->

                        <!-- <tr>
                            <td>3</td>
                            <td> <label>Company </label> </td>

                            <td>
                              <label class="switch">
                                  <input <?=$cnmamechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="cname_radio_click[]" onchange="fnupdatesearch('cus_company_name','<?=$getcname?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr> -->

                        <tr>
                            <td>2</td>
                            <td> <label>Address </label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$addr1chksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="addr1radio_click[]" onchange="fnupdatesearch('cus_address1','<?=$getaddr1?>')" >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
<!--
                        <tr>
                            <td>5</td>
                            <td> <label>Address 2</label> </td>

                            <td>
                              <label class="switch">
                                  <input <?=$addr2chksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="addr2radio_click[]" onchange="fnupdatesearch('cus_address2','<?=$getaddr2?>')" >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td> <label>City</label> </td>

                            <td>
                              <label class="switch">
                                  <input <?=$citychksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="city_radio_click[]" onchange="fnupdatesearch('cus_city','<?=$getcity?>')" >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td> <label>State </label> </td>

                            <td>
                              <label class="switch">
                                  <input <?=$statechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="state_radio_click[]" onchange="fnupdatesearch('cus_state','<?=$getstate?>')" >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr> -->

                        <!-- <tr>
                            <td>8</td>
                            <td> <label>Zip Code</label> </td>

                            <td>
                              <label class="switch">
                                  <input <?=$zipchksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="zip_radio_click[]"  onchange="fnupdatesearch('cus_zip','<?=$getzip?>')">
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr> -->

                        <tr>
                            <td>3</td>
                            <td> <label>Area</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$areachksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="area_radio_click[]" onchange="fnupdatesearch('cus_area','<?=$getarea?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td> <label>Phone.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$phnochksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('phone_no','<?=$getphno?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td> <label>Account No.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetacc_nochksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('acc_no','<?=$getacc_no?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td> <label>Account Type.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetacc_typechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('acc_type','<?=$getacc_type?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td> <label>Vendor Name.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetvendor_namechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('vendor_name','<?=$getvendor_name?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td> <label>From Date.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetevent_from_datechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('event_from_date','<?=$getevent_from_date?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td> <label>To Date.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetevent_to_datechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('event_to_date','<?=$getevent_to_date?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td> <label>Event Type.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetevent_typechksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('event_type','<?=$getevent_type?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td> <label>Event Location.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetevent_locationchksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('event_location','<?=$getevent_location?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td> <label>Balance as of.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetbalance_as_ofchksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('balance_as_of','<?=$getbalance_as_of?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td> <label>Invoice No.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetinvoice_nochksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('invoice_no','<?=$getinvoice_no?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td> <label>Referred By.</label> </td>
                            <td></td>
                            <td></td>
                            <td>
                              <label class="switch">
                                  <input <?=$fngetreferred_bychksts?> class="fnchkphoneno" type="checkbox" id="radio_click" name="phone_radio_click[]" onchange="fnupdatesearch('referred_by','<?=$getreferred_by?>')"  >
                                 <span class="slider round"></span>
                               </label>
                             </td>
                        </tr>



                      </tbody>

                    </table>

                  </form>
                  </div>




                </div>



              </div>

            </div>

                <!-- /.box-header -->

          </div>

        </section>

        <!-- /.content -->

      </div>

      <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>

<script type="text/javascript">
    function fnupdatesearch(columname,columnvalue)
    {
        console.log(columname);
        console.log(columnvalue);
        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnupdatesearchinfo')?>',
            data: {columname:columname,columnvalue:columnvalue},
            dataType: 'text',
            beforeSend: function() 
            {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) 
            {
                if(data=="success")
                {
                    $("#divfiltercust").load(location.href+" #divfiltercust>*","");
                    $('.fadeMe').hide();
                }
                else if(data=="error")
                {
                    $('.fadeMe').hide();
                }
            },
            error: function(xhr) 
            { 
            },
            complete: function() 
            {
            }
        });
    }
</script>
