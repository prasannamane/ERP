<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | General Info</title>
    
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

        .firstblock_bg 
        {   
            background: #f185f9 !important;
        }
    </style>
</head>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Vendor</a></li>
        <li class="active">Events</li>
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
      <section class="content">
        <!-- TABLE: LATEST ORDERS -->
        <form action="<?=site_url('fi_home/find_vendor')?>" method="POST" id="csearch">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-sm-5 col-md-4">
                    <h3 class="uhead1">
                      Events
                    </h3>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <div class="pull-right">
                      <ul class="list-inline topul">
                        <li><a href="#" class="uhead2"> Main Menu </a></li>
                        <li><a href="#" class="uhead2"> Options </a></li>
                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <select class="form-control" id="cus_names">
                        <!-- <option>Select </option> -->
                          <?php
                           $cus_id=$this->session->userdata('id');
                           //echo "cus_id--".$cus_id;
                         foreach ($search as $search_data) {
                          // echo "<pre>";  print_r($search_data);
                            if($cus_id==$search_data['cus_id'])
                            {
                              $select="selected";
                            }else{
                               $select="";
                            }
                            ?>
                            <option <?=$select?> value="<?php echo $search_data['cus_id'] ?>"><?php print_r($search_data['cus_lname']." - ". $search_data['cus_company_name']); ?></option>
                        <?php  }
                           ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                   <div class="form-group" id="contact_info">
                      <!-- <select class="form-control">
                        <option value="val">569 - 388 - 2534</option>
                      </select> -->
                      <input class="form-control fcap contact_no" id="sercgcustph" name="sercgcustph" type="text" value="<?php echo $single_cust['contact_no'] ?>" placeholder="(111) 111-1111">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="433">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="$16.33">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="1">
                    </div>
                  </div>
              <!-- </div> -->
           <!--  </div> -->
      <!--     </div>
        </div> -->
              </form>
                <form action="<?=site_url('fi_home/addvendorevent')?>" method="POST" id="createvent" name="createvent">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive" id="myevents">
                     <table class="table   table-hover no-margin">
                       <thead>
                          <tr>
                            <th>Event Type</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                       <!--  <tbody> -->
                <!--  Start event for loop  -->
                <?php
               if(count($event_data)>0)
                 {
                    //echo "cnter--".count($event_data);
                   foreach($event_data as $events_info)
                    {
                       //echo "type--".$events_info['event_type'];
                      //echo "event_lost--".$events_info['event_lost'];
                            if($events_info['event_lost']=="1") 
                               {
                                 $dispsts="display:none"; 
                               }else{
                                 $dispsts=""; 
                               }
                        ?>
                            <tr class="tr_clone" style="<?=$dispsts?>">
                          <!--   <td>1</td> -->
                            <td width="100px">
                              <select class="form-control" name="event_type[]" style="width: 100px;">
                                <option>Select</option>
                                <?php
                                $i=1;
                                foreach ($event_name as $name) { 
                                  if($events_info['event_type']==$name['sub_name'])
                                    {
                                      $evntyesel="selected";
                                    }else{
                                       $evntyesel="";
                                    }
                                  ?>
                                <option <?=$evntyesel?> value="<?php echo $name['sub_name'];?>"><?php echo $name['sub_name']; ?></option>
                                <?php  } ?>
                              </select>
                            </td>
                            <td>
                              <input type="hidden" name="cuss_id" id="cuss_id" value="<?php echo $last_row['cus_id']; ?>" >
                              <input type="text" name="ename[]" value="<?php echo $last_row['cus_lname']; ?>" class="form-control" style="text-transform:capitalize;"></td>
                            <td><input type="date" name="edate[]" id="edate" class="form-control edate" onchange="myDate()" value="<?=$events_info['event_date']?>"></td>
                            <td><input type="time" name="etime[]" id="etime" class="form-control" onchange="myDate()" value="<?=$events_info['event_time']?>"></td>                     
                            <td>
                              <a onclick="fndelevent('<?=$events_info['event_id']?>','<?=$events_info['cus_id']?>')" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a>
                             <!--  <button class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></button> -->
                            </td>
                       </tr>
              <?php } } ?>
                      <tr class="tr_clone">
                           <!--  <td>1</td> -->
                            <td width="100px">
                              <select class="form-control" name="event_type[]" style="width: 100px;">
                                <option>Select</option>
                                <?php
                                $i=1;
                                foreach ($event_name as $name) { ?>
                                <option value="<?php echo $name['sub_name'];?>"><?php echo $name['sub_name']; ?></option>
                                <?php  } ?>
                              </select>

                            </td>

                            <td>
                              <input type="hidden" name="cuss_id" id="cuss_id" value="<?php echo $last_row['cus_id']; ?>" >
                              <input type="text" name="ename[]" value="<?php echo $last_row['cus_lname']; ?>" class="form-control" style="text-transform:capitalize;"></td>


                            <td><input type="date" name="edate[]" id="edate" class="form-control edate" onchange="myDate()"></td>


                            <td><input type="time" name="etime[]" id="etime" class="form-control" onchange="myDate()"></td>

                           
                            <td><button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button></td>

                       </tr>

                <!--  End event for loop  -->



                     <!--    </tbody> -->



                      </table>



                    </div>



                    <!-- /.table-responsive -->



                  </div>



             <!--   </div>

            </div>

           </div>

          </div> -->
          



          <!-- Locations -->



          <div class="col-md-12">



            <div class="box box-default">



              <div class="box-header with-border">



                <p class="uhead2">Locations</p>



                <div class="box-tools pull-right">



                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>



                  </button>



                </div>



                <!-- /.box-tools -->



              </div>



              <!-- /.box-header -->



              <div class="box-body">



                <div class="table-responsive" id="mylocation">


                  <table class="table table-hover no-margin">



                    <thead>



                      <tr>



                        <!-- <th>#</th> -->



                        <th>Location</th>



                        <th>Date</th>



                        <th>Time</th>



                        <th>Address</th>



                        <th>City</th>



                        <th>State</th>



                        <th>Zip</th>



                        <th>Phone </th>



                        <th><i class="fa fa-map-marker" aria-hidden="true"></i></th>



                        <th>Notes</th>



                        <th>Action</th>



                      </tr>



                   <!--  Start Location for loop  -->  
            <?php

                if(count($location_data)>0)
                   {
                     //echo "cnter--".count($event_data);
                    foreach($location_data as $locations_info)
                     {
 
                        ?> 


                      <tr class="tr_clone">

                       <!--  <td>1</td> -->

                        <td>


                          <select id="loc_name" class="form-control loc_name" name="add_location[]">


                            <option>Select</option>
                            <?php foreach($all_locs as $locations){ 

                                if($locations['location_name']==$locations_info['location_type'])
                                {
                                    $loctype="selected";
                                }else{
                                    $loctype="";
                                }

                              ?>
                            <option <?=$loctype?> value="<?php echo $locations['location_name'] ?>"><?php echo $locations['location_name'] ?></option>
                            <?php } ?>
                          </select>

                        </td>

                        <td><input type="date" name="ddate[]" id="strt_date" class="form-control strt_date" value="<?= $locations_info['location_date']?>"></td>

                        <td><input type="time" name="time[]" id="strt_time" class="form-control" value="<?= $locations_info['location_time']  ?>"></td>

                        <td><input type="text" name="address[]" id="loc_add" class="form-control loc_add" value="<?= $locations_info['location_address']  ?>"></td>

                        <td><input type="text" name="city[]" id="loc_city" class="form-control loc_city" value="<?= $locations_info['location_city']  ?>"></td>

                        <td><input type="text" name="state[]" id="loc_state" class="form-control loc_state" value="<?= $locations_info['location_state']  ?>" ></td>

                        <td><input type="text" name="zip[]" id="loc_zip" class="form-control loc_zip" value="<?= $locations_info['location_zip']  ?>"></td>

                        <td><input type="text" name="phone[]" id="loc_phone1" class="form-control loc_phone1 contact_no" value="<?= $locations_info['location_phone']  ?>"></td>

                        <td><input type="text" name="landmark[]" class="form-control" value="<?= $locations_info['location_landmark']  ?>"></td>

                        <td><input type="text" name="note[]" class="form-control" value="<?= $locations_info['location_note']  ?>"></td>

                        <td>
                             <a onclick="fndellocation('<?=$locations_info['location_id']?>','<?=$locations_info['event_id']?>')" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a>
                          <!-- <button class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button> -->

                        </td>

                      </tr>



             <?php } } ?>

                      <tr class="tr_clone">

                       <!--  <td>1</td> -->

                        <td>


                          <select id="loc_name" class="form-control loc_name" name="add_location[]">


                            <option>Select</option>
                            <?php foreach($all_locs as $locations){ ?>
                            <option value="<?php echo $locations['location_name'] ?>"><?php echo $locations['location_name'] ?></option>
                            <?php } ?>
                          </select>

                        </td>

                        <td><input type="date" name="ddate[]" id="strt_date" class="form-control strt_date"></td>

                        <td><input type="time" name="time[]" id="strt_time" class="form-control"></td>

                        <td><input type="text" name="address[]" id="loc_add" class="form-control loc_add"></td>

                        <td><input type="text" name="city[]" id="loc_city" class="form-control loc_city"></td>

                        <td><input type="text" name="state[]" id="loc_state" class="form-control loc_state"></td>

                        <td><input type="text" name="zip[]" id="loc_zip" class="form-control loc_zip"></td>

                        <td><input type="text" name="phone[]" id="loc_phone1" class="form-control loc_phone1 contact_no"></td>

                        <td><input type="text" name="landmark[]" class="form-control"></td>

                        <td><input type="text" name="note[]" class="form-control"></td>

                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                          <!--<button class="btn btn-xs btn-success tr_save_btn"><i class="fa fa-floppy-o"></i> Save</button>-->

                        </td>

                      </tr>

                    <!--  End Location for loop  -->  



                    </thead>



                  </table>

               


                </div>



                <!-- /.table-responsive -->



              </div>



              <!-- /.box-body -->



            </div>



            <!-- /.box -->



          </div>



       



         <div class="row">
          <div class="col-sm-12">
                  <div class="btns text-center">
                          <button class="btn btn-lg btn-info btn-flat">Save</button>
                            <a  onclick="fncleareventfrm()" class ="btn btn-lg btn-default btn-flat">Cancel</a>
                        </div>
            </div>
        </div>

          </div>
        </form>

      </section>

         <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>


          <!-- Trigger the modal with a button -->
<button style="display: none;" type="button" id="btnmodal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">

    <!-- Modal content-->
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



      <!-- /.content -->



    </div>

    



    <!-- /.content-wrapper -->



    <!-- Main Footer -->











  <!-- ./wrapper -->



  <!-- REQUIRED JS SCRIPTS -->



  <!-- jQuery 3 -->



  <script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>



  <!-- Bootstrap 3.3.7 -->



  <!--<script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->



  <!-- AdminLTE App -->



  <script src="dist/js/adminlte.min.js"></script>



   <script type="text/javascript">

  //ERP tr added

  	var cnt = 2



    $(".tr_clone_add").on('click', function(rrr) { rrr.preventDefault();



    var $tr    = $(this).closest('.tr_clone');



    var $clone = $tr.clone();



    $clone.find(':text').val('');

	 $clone.find('td:first-child').text(cnt);



    $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()



    $clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');



   //$tr.after($clone);



	$tr.parent("thead").append($clone);



	cnt++;



});











$(document).on('click', '.tr_clone_remove', function(){



     // Your Code



    var $tr    = $(this).closest('.tr_clone');



	$(this).closest('table').addClass("currenttable");

	var alltr = $(this).parents("table.currenttable").find('tr');

	var len = alltr.length - 1;



	//$(alltr).each(function(){ $(this).find("td:first-child").text(i)});





	//alert(len);



    var $clone = $tr.remove();

	if(cnt>0)

	{

	cnt--;





	}



});







  </script>




  <script>
    function myDate() {
      var a = document.getElementById("edate").value;

      var b = document.getElementById("etime").value;
      // alert(b);
      var c = document.getElementById("endate").value;

      //alert("c-----"+c);
       //alert("c--"+c);
      var d = document.getElementById("entime").value;

       
     //alert("sttime--"+b);

     //alert("end time--"+d);     

      $('#strt_time').val(b);
      $('#st_time').val(b);
      $('#str_time').val(b);

      $('#en_time').val(d);




      //document.getElementById("st_date").innerHTML = a;
      document.getElementById("st_date").value = a;
      //document.getElementById("str_date").innerHTML = a;
      document.getElementById("str_date").value = a;
     // document.getElementById("strt_date").innerHTML = a;
      document.getElementById("strt_date").value = a;
     // document.getElementById("start_date").innerHTML = a;
      document.getElementById("start_date").value = a;


      //document.getElementById("strt_time").innerHTML = b;
      //document.getElementById("strt_time").value = b;
      //document.getElementById("st_time").innerHTML = b;
      //document.getElementById("st_time").value = b;
     // document.getElementById("str_time").innerHTML = b;
      //document.getElementById("str_time").value = b;


      //document.getElementById("en_date").innerHTML = c;
      //document.getElementById("en_date").value = c;

       //document.getElementById("en_dates").innerHTML = c;
      //document.getElementById("en_dates").value = c;

      //document.getElementById("en_time").innerHTML = d;
      //document.getElementById("en_time").value = d;

   


    }
</script>


<script>
$(document).ready(function(){
//$("#edate").on("change", function(){
$("body").on("change", "#edate, .edate", function(){

 // alert('123');
 var status= $(this).val();
 // var store_id_n= $(this).attr("id");
 //alert(status);

 var temp_heb_date =  $(this).parents(".tr_clone").find(".heb_date");
 var temp_eday =  $(this).parents(".tr_clone").find(".eday");

$.ajax({
    type: "POST",
    url: "<?php echo base_url('Fi_home/hebrew'); ?>",
    data: {status : status},
    success: function(data)
    {
        var str = data;
        var temp = new Array();
        // $("#state").append(data);
        // console.log(data);
        // alert(data);
          temp = str.split(",");


          /*  alert(temp[0]);
            alert(temp[1]);*/

          temp_heb_date.val(temp[0]);
          temp_eday.val(temp[1]);

        /*  document.getElementById("heb_date").value = temp[0];
          document.getElementById("eday").value = temp[1];
          document.getElementById("heb_date").innerHTML = temp[0];
          document.getElementById("eday").innerHTML = temp[1];*/
    }
  });
});
});
</script>
<script>
$(document).ready(function(){
$("body").on("change", "#loc_name, .loc_name", function(){
 // alert('123');
 var l_name= $(this).val();
 // var store_id_n= $(this).attr("id");
 // alert(status);

 var temp_loc_add =  $(this).parents(".tr_clone").find(".loc_add");
 var temp_loc_city =  $(this).parents(".tr_clone").find(".loc_city");
 var temp_loc_state =  $(this).parents(".tr_clone").find(".loc_state");
 var temp_loc_zip =  $(this).parents(".tr_clone").find(".loc_zip");
 var temp_loc_phone1 =  $(this).parents(".tr_clone").find(".loc_phone1");


      $.ajax({
          type: "POST",
          url: "<?php echo base_url('Fi_home/single_location_info'); ?>",
          data: {l_name : l_name},
          async:false,
          success: function(data)
          {
              var locs = data;
              // console.log(locs);
              var temp1 = new Array();
              temp1 = locs.split("##");
              // alert(temp1[1]);


                   temp_loc_add.val(temp1[2]);
                   temp_loc_city.val(temp1[3]);
                   temp_loc_state.val(temp1[4]);
                   temp_loc_zip.val(temp1[5]);
                   temp_loc_phone1.val(temp1[6]);


                   fngetmaplatlong(temp1[2]);

          }
        });

});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
$("#cus_names").on("change", function(){
 // alert('123');
 var l_name= $(this).val();
 // var store_id_n= $(this).attr("id");
  //alert(l_name);
 if (l_name !="") {
   window.location.href = "<?php echo site_url('fi_home/find_vendor')?>?id="+l_name;

   return true;
 }
 else {
  return false;
 }

});
});
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script type="text/javascript">

      $(document).ready(function($)

      {

        // alert("Hiii");

          // $('#contact_no').mask('(000) 000-0000');

        //   $('body .contact_no').mask('(000) 000-0000');

  $('body ').on("keypress", ".contact_no", function(){ $(this).mask('(000) 000-0000'); } );





        $(".str").keypress(function(event)

        {

          var inputValue = event.which;

          // allow letters and whitespaces only.

          if(!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0))

          {

              event.preventDefault();

          }

        });



        $(".num").keypress(function (e)

        {

          if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))

          {

              return false;

          }

        });

    });

</script>


<script type="text/javascript">
    
  function gethebrewDate(status,heb_date,teday)
    {
       //alert(status);

          $.ajax({
          type: "POST",
          url: "<?php echo base_url('Fi_home/hebrew'); ?>",
          data: {status : status},
          success: function(data)
          {
              var str = data;
              var temp = new Array();
              // $("#state").append(data);
              // console.log(data);
              // alert(data);
                temp = str.split(",");
                //document.getElementById("heb_date").value = temp[0];
                //document.getElementById("eday").value = temp[1];
                 heb_date.val(temp[0]);
                 teday.val(temp[1]); 

               
          }
        });

    }
</script>

<script>
$(document).ready(function(){
$("body").on("keydown", "#edate, .edate", function(event){
  //alert('123');
  
   var key = event.keyCode;
   //alert("key--"+key);


 var temp_edate =  $(this).parents(".tr_clone").find(".edate");

 var temp_heb_date =  $(this).parents(".tr_clone").find(".heb_date");
 var temp_eday =  $(this).parents(".tr_clone").find(".eday");
 
    if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          //$('#edate').val(today);
           temp_edate.val(today);

          $('#strt_date').val(today);
          $('#st_date').val(today);
          $('#str_date').val(today);
          $('#assostart_date').val(today);

          gethebrewDate(today,temp_heb_date,temp_eday);


      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          //$('#edate').val(today);
          temp_edate.val(today);
          $('#strt_date').val(today);
          $('#st_date').val(today);
          $('#str_date').val(today);
          $('#assostart_date').val(today);

          gethebrewDate(today,temp_heb_date,temp_eday);

      }else if(key=="68")
             {

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

               //$('#edate').val(today);
                temp_edate.val(today);
                $('#strt_date').val(today);
                $('#st_date').val(today);
                $('#str_date').val(today);
                $('#assostart_date').val(today);
               
                gethebrewDate(today,temp_heb_date,temp_eday);
             }

    });

});
</script>




   

<script type="text/javascript">

 $(document).ready(function(){
 $("body").on("keydown", "#strt_date, .strt_date", function(event){
      var key = event.keyCode;
      //alert("key--"+key+" invoiceid--"+invoiceid);

   var temp_strt_date =  $(this).parents(".tr_clone").find(".strt_date");

      if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          temp_strt_date.val(today);

         
      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;

          temp_strt_date.val(today);

      }else if(key=="68")
       {

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          temp_strt_date.val(today);
       }

    });

});
</script>

   

<script>
$(document).ready(function(){
$("body").on("keydown", "#endate, .endate", function(event){
  //alert('123');
  
   var key = event.keyCode;
   //alert("key--"+key);


 var temp_endate =  $(this).parents(".tr_clone").find(".endate");

  var temp_edate =  $(this).parents(".tr_clone").find(".edate");

  if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

         /* temp_endate.val(today);
          $('#en_date').val(today);*/

          var UserDate = today;
          var ToDate =  temp_edate.val(); //new Date();

         // alert("UserDate--"+UserDate+" ToDate--"+ToDate);
       
        if(new Date(UserDate).getTime() < new Date(ToDate).getTime())
          {
              //alert('End date is greater than the current date.'); 
               //$('#en_date').val("");

          }else if(new Date(UserDate).getTime() === new Date(ToDate).getTime()){

              temp_endate.val(today);
              $('#en_date').val(today);

          }else{

              temp_endate.val(today);
              $('#en_date').val(today);
          }

        
      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);

          var UserDate = today;
          var ToDate =  temp_edate.val(); //new Date();

         // alert("UserDate--"+UserDate+" ToDate--"+ToDate);
       
        if(new Date(UserDate).getTime() < new Date(ToDate).getTime())
          {
              //alert('End date is greater than the current date.'); 
               //$('#en_date').val("");

          }else if(new Date(UserDate).getTime() === new Date(ToDate).getTime()){

              temp_endate.val(today);
              $('#en_date').val(today);

          }else{

              temp_endate.val(today);
              $('#en_date').val(today);
          }



      }else if(key=="68")
       {

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          /*temp_endate.val(today);
          $('#en_date').val(today);*/

          var UserDate = today;
          var ToDate =  temp_edate.val(); //new Date();

         // alert("UserDate--"+UserDate+" ToDate--"+ToDate);
       
        if(new Date(UserDate).getTime() < new Date(ToDate).getTime())
          {
              //alert('End date is greater than the current date.'); 
               //$('#en_date').val("");

          }else if(new Date(UserDate).getTime() === new Date(ToDate).getTime()){

              temp_endate.val(today);
              $('#en_date').val(today);

          }else{

              temp_endate.val(today);
              $('#en_date').val(today);
          }
        
       }else{
   
             var UserDate1 = $('#endate').val();
             var ToDate1 = new Date();
       
            if(new Date(UserDate1).getTime() < ToDate1.getTime())
              {
                  //alert('End date is greater than the current date.'); 
                  $('#en_date').val("");

              }else{

                  $('#en_date').val(UserDate1);
              }

       }

    });

});
</script>


<script type="text/javascript">
 
$(document).ready(function(){
$("body").on("keydown", "#st_date, .st_date", function(event){
   
      var key = event.keyCode;
      //alert("key--"+key+" invoiceid--"+invoiceid);

      var temp_st_date =  $(this).parents(".tr_clone").find(".st_date");

      if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          temp_st_date.val(today);


      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          temp_st_date.val(today);

      
      }else if(key=="68")
       {

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          temp_st_date.val(today);

         
       }

    });
});
 </script>

 <script type="text/javascript">
 
$(document).ready(function(){
$("body").on("keydown", "#en_date, .en_date", function(event){    
      var key = event.keyCode;
      //alert("key--"+key+" invoiceid--"+invoiceid);

    var temp_en_date =  $(this).parents(".tr_clone").find(".en_date");

    var temp_st_date=  $(this).parents(".tr_clone").find(".st_date");

      if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          temp_en_date.val(today);


          var UserDate = today;
          var ToDate =  temp_st_date.val(); //new Date();

         // alert("UserDate--"+UserDate+" ToDate--"+ToDate);
       
        if(new Date(UserDate).getTime() < new Date(ToDate).getTime())
          {
              //alert('End date is greater than the current date.'); 
               //$('#en_date').val("");

          }else if(new Date(UserDate).getTime() === new Date(ToDate).getTime()){

              temp_endate.val(today);
             

          }else{

              temp_endate.val(today);
             
          }

      

      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          temp_en_date.val(today);


          var UserDate = today;
          var ToDate =  temp_st_date.val(); //new Date();

         // alert("UserDate--"+UserDate+" ToDate--"+ToDate);
       
        if(new Date(UserDate).getTime() < new Date(ToDate).getTime())
          {
              //alert('End date is greater than the current date.'); 
               //$('#en_date').val("");

          }else if(new Date(UserDate).getTime() === new Date(ToDate).getTime()){

              temp_endate.val(today);
             

          }else{

              temp_endate.val(today);
             
          }

      
      }else if(key=="68")
       {

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          temp_en_date.val(today);


          var UserDate = today;
          var ToDate =  temp_st_date.val(); //new Date();

         // alert("UserDate--"+UserDate+" ToDate--"+ToDate);
       
        if(new Date(UserDate).getTime() < new Date(ToDate).getTime())
          {
             // alert('End date is greater than the current date.'); 
               //$('#en_date').val("");

          }else if(new Date(UserDate).getTime() === new Date(ToDate).getTime()){

              temp_endate.val(today);
             

          }else{

              temp_endate.val(today);
             
          }

     
       }

    });

});

</script>

   


   <script type="text/javascript">
     function strdtuniKeyCode(event) {
      var key = event.keyCode;
      //alert("key--"+key+" invoiceid--"+invoiceid);

      if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          $('#str_date').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');

      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          $('#str_date').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');


      }else if(key=="68")
       {

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          $('#str_date').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');
       }

    }

   </script>


      <script type="text/javascript">
     function assstrdtuniKeyCode(event) {
      var key = event.keyCode;
      //alert("key--"+key+" invoiceid--"+invoiceid);

      if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          $('#assostart_date').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');

      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          $('#assostart_date').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');


      }else if(key=="68")
       {

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

      if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          $('#assoen_dates').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');

      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          $('#assoen_dates').val(today);

          //fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');


      }else if(key=="68")
       {

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
    function fncleareventfrm()
     {
        var res=confirm("Are you sure want to Clear all Data..??");
         if(res==true)
          {
             $('#createvent')[0].reset();       
          }
        
     }
   </script>


<script type="text/javascript">
$(document).ready(function(){
$("body").on("change", "#st_time, .st_time", function(event){    
      
    var temp_st_time =  $(this).parents(".tr_clone").find(".st_time");
    var temp_en_time =  $(this).parents(".tr_clone").find(".en_time");
    var temp_total_hours =  $(this).parents(".tr_clone").find(".total_hours");

           //get values
            var valuestart = temp_st_time.val();
            var valuestop = temp_en_time.val();


            if(valuestart!="" && valuestop!="")
             {
                 //create date format          
                 var timeStart = new Date("01/01/2007 " + valuestart).getHours();
                 var timeEnd = new Date("01/01/2007 " + valuestop).getHours();

                if(timeEnd===timeStart)
                 { //alert("1");
                    var hourDiff = timeEnd - timeStart;    
                    temp_total_hours.val(hourDiff);

                 }else if(timeEnd<timeStart){
                    //alert("2");
                    /*var hourDiff = timeEnd - timeStart; 
                    temp_total_hours.val(hourDiff); */

                    temp_total_hours.val("");
                   
                 }else{
                   //  alert("3");
                    var hourDiff = timeEnd - timeStart;    
                    temp_total_hours.val(hourDiff);

                 } 

             }
   
});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
$("body").on("change", "#en_time, .en_time", function(event){    
      
    var temp_st_time =  $(this).parents(".tr_clone").find(".st_time");
    var temp_en_time =  $(this).parents(".tr_clone").find(".en_time");
    var temp_total_hours =  $(this).parents(".tr_clone").find(".total_hours");

           //get values
            var valuestart1 = temp_st_time.val();
            var valuestop1 = temp_en_time.val();


            if(valuestart1!="" && valuestop1!="")
             {
                 //create date format          
                 var timeStart = new Date("01/01/2007 " + valuestart1).getHours();
                 var timeEnd = new Date("01/01/2007 " + valuestop1).getHours();

                if(timeEnd===timeStart)
                 { //alert("1");
                    var hourDiff = timeEnd - timeStart;    
                    temp_total_hours.val(hourDiff);

                 }else if(timeEnd<timeStart){
                    //alert("2");
                    /*var hourDiff = timeEnd - timeStart; 
                    temp_total_hours.val(hourDiff); */

                     temp_total_hours.val("");
                   
                 }else{
                   //  alert("3");
                    var hourDiff = timeEnd - timeStart;    
                    temp_total_hours.val(hourDiff);

                 } 

             }
});
});
</script>



<script type="text/javascript">
  function fndelevent(eventId,cusId)
  {
    //alert("eventId--"+eventId+" cusId--"+cusId);

      event.preventDefault();

       var r = confirm("Do you want delete this event..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndelvendoreventinfo')?>', 
                  data: {eventId:eventId,cusId:cusId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          $("#myevents").load(location.href + " #myevents");

                      }else if(data=="error"){

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
  function fndellocation(locId,eventId)
  {
    //alert("locId--"+locId+" eventId--"+eventId);

      event.preventDefault();

       var r = confirm("Do you want delete this location..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndelvendorlocationinfo')?>', 
                  data: {locId:locId,eventId:eventId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          $("#mylocation").load(location.href + " #mylocation");

                      }else if(data=="error"){

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
  function fndelcrews(crewId,eventId)
  {
    //alert("crewId--"+crewId+" eventId--"+eventId);

      event.preventDefault();

       var r = confirm("Do you want delete this crews..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndelvendorcrewsinfo')?>', 
                  data: {crewId:crewId,eventId:eventId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          $("#mycrews").load(location.href + " #mycrews");

                      }else if(data=="error"){

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
    function fncleareventfrm()
     {
        var res=confirm("Are you sure want to Clear all Data..??");
         if(res==true)
          {
             $('#createvent')[0].reset();       
          }
        
     }
   </script>

   <script type="text/javascript">

$(document).ready(function(){
$("body").on("change", "#enote, .enote", function(event){
    
          
    var temp_lostcheck =  $(this).parents(".tr_clone").find(".enote");
 
    var str = temp_lostcheck.val();  //$('#cus_note').val(); 

    //alert(str);

    if(str.length>35)
    { 
        var newStr = str.split('.').map(function(el) {
          el = el.trim();
          return el.substr(0, 1).toUpperCase() + el.substr(1);
         }).join('. ');

        // alert(newStr.trim());
         //$('#cus_note').val(newStr.trim());

         temp_lostcheck.val(newStr.trim());

         $('#btnmodal').trigger('click');
       
         $('#setmodalnotes').html(newStr.trim());

         //$('#hdnnoteval').val(temp_lostcheck);

    }else{

      var newStr = str.split('.').map(function(el) {
          el = el.trim();
          return el.substr(0, 1).toUpperCase() + el.substr(1);
         }).join('. ');

        //alert(newStr.trim());
        // $('#cus_note').val(newStr.trim());
        temp_lostcheck.val(newStr.trim());
         
    }
  
  
});
});
</script>

<script type="text/javascript">
  
 function fnclosemodal()
  {

      var settonotes= $('#setmodalnotes').val();
      //alert("settonotes--"+settonotes);

      //var temp_lostcheck = $('#hdnnoteval').val();   //$(this).parents(".tr_clone").find(".enote");

     // alert("temp_lostcheck--"+temp_lostcheck);

      var newStrdata = settonotes.split('.').map(function(el) {
          el = el.trim();
          return el.substr(0, 1).toUpperCase() + el.substr(1);
         }).join('. ');
     
      //alert(newStrdata.trim());  
      $('#enote').val(newStrdata.trim());
      //temp_lostcheck.val(newStrdata.trim());

     // $('#hdnnoteval').val(newStrdata.trim()); 

  }
</script>

<script type="text/javascript">
$(document).ready(function(){
$("#sercgcustph").on("change", function(){
  var txtsrchphone= $(this).val();
  var id= $('#cus_names').val();

  //alert("txtsrchphone--"+txtsrchphone+" id--"+id);

 if (txtsrchphone !="") {
   window.location.href = "<?php echo site_url('fi_home/search_evcustomer')?>?mobile="+txtsrchphone+"&id="+id;

   return true;
 }
 else {
  return false;
 }

});
});
</script>

<script type="text/javascript">
    $(document).on('keydown', function(event) 
    {
        if (event.key == "Escape") 
        {
            window.location.href = "<?=base_url("/fi_home")?>";
        }
    });
</script>
