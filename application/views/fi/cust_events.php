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
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

  <!-- Google Font -->

  <link rel="stylesheet"

  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


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

  </style>



</head>



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Customer</a></li>

        <li class="active">Events</li>

      </ol>

    </section>
    <?php if(isset($success)){?>
    <div class="alert alert-success alert-dismissable fade in">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong></strong> <?=$success?>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript">

          var pckId= localStorage.getItem("pckId");
          //alert("Exists localStorage pckId--"+pckId);
          if(pckId!=null || pckId!="")
          {//alert("TT");
             localStorage.clear();
            // alert("1");
             var cus_names= '<?=$this->session->userdata('nwcus_id');?>'; //$('#cus_names').val();
             //alert("nwcus_id---"+cus_names);
            /* var pckId=cus_names;
             alert("pckId---"+pckId);*/
             localStorage.setItem("pckId",cus_names);
             //alert("Reset localStorage pckId--"+pckId);

             <?php $this->session->unset_userdata('nwcus_id');?>

          }
  </script>

    <?php }?>
    <?php if(isset($error)){?>
    <div class="alert alert-danger alert-dismissable fade in">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Error!</strong> <?=$error?>
    </div>
    <?php }?>

      <section class="content">

        <!-- TABLE: LATEST ORDERS -->
        <form action="<?=site_url('fi_home/search_cus')?>" method="POST" id="csearch">
        <div class="row">

          <div class="col-md-12">

            <div class="box box-info customer_sec titlen_search">

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

                        <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->

                        <li><a href="#" class="uhead2"> Options </a></li>

                        <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

                      </ul>

                    <!--   <a href="<?//=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>

                      <a href="#" class="btn btn-md btn-info btn-flat">New Events</a> -->

                    </div>

                  </div>

                </div>

              </div>


              <div class="box-body">

                <div class="row space3">

                  <div class="col-md-4">

                    <div class="form-group">
                      <select class="form-control cus_event" id="cus_notes" name="cus_notes"  onchange="cus_event()" >
                        <?php
                          foreach ($search as $search_data) {  
                            if($search_data['cus_id'] == $this->session->userdata('id')) {
                            ?>   
                            <option style="font-size:13px;" value="<?=$search_data['cus_id']?>">
                            <?php print_r($search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?></option>
                            <?php
                            }
                          } ?>
                          <option value="">Choose</option>
                          <?php
                          $i=1;
                          foreach ($search as $search_data) {  ?>
                            <option style="font-size:13px;" value="<?=$search_data['cus_id']?>">
                            <?php print_r($search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?></option>
                            <?php
                            $i++;
                          } ?>
                      </select>
                    </div>

                  <!--   <div class="form-group">
                    <input type="text" list="cuslist_info_event" class="form-control cust_event" name="cust_event" autocomplete="off" id="cus_names">
                  
                    <datalist id="cuslist_info_event">
                      <?php
                      $i=1;
                      foreach ($search as $search_data) {  ?>
                  
                     <option style="font-size:13px;" data-value="<?php echo $search_data['cus_id'] ?>" value="<?php print_r($search_data['cus_lname']." - ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?>">
                     </option>
                         <?php
                         $i++;
                       } ?>
                     </datalist>
                  
                  </div> -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group" id="contact_info">

                      <!-- <select class="form-control">

                        <option value="val">569 - 388 - 2534</option>

                      </select> -->
                      <input class="form-control fcap contact_no" id="sercgcustph" name="sercgcustph" type="text" value="<?php echo $single_cust['contact_no'] ?>" placeholder="">

                    </div>

                  </div>

                   <div class="loaduppertabcntdtls">
                        <div class="col-md-2 cus_acc_no">

                               <div class="form-group" id="lastinvId">

                                <input class="form-control" type="text" placeholder="" value=" ">

                               <!--   <input class="form-control"  type="text" placeholder="433" value=""> -->

                               </div>

                             </div>

                             <div class="col-md-2 balance_count">

                               <div class="form-group" id="lastinvduebal">

                                 <input class="form-control" type="text" placeholder="" value="">
                                 <!-- <input class="form-control"  type="text" placeholder="$16.33" value="$ 1700.00"> -->

                               </div>

                             </div>

              </div>

              </form>




      </section>

    </div>

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



   <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <script type="text/javascript">
  //ERP tr added

    $(document).ready(function(){

    var cnt = 2

    //$(".tr_clone_add").on('click', function(rrr) { rrr.preventDefault();
      $("body").on('click','.tr_clone_add', function(rrr) { rrr.preventDefault();
      //alert(111);
    var tr    = $(this).closest('.tr_clone');

    var clone = tr.clone();

    clone.find(':text').val('');
    clone.find('input[type=date]').val('');
    clone.find('input[type=time]').val('');

   //clone.find('td:first-child').text(cnt);

    clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()

   clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

   tr.before(clone);

   //tr.parent("thead").append(clone);

  cnt++;

});
});




$(document).on('click', '.tr_clone_remove', function(){

     // Your Code

    var tr    = $(this).closest('.tr_clone');

  $(this).closest('table').addClass("currenttable");
  var alltr = $(this).parents("table.currenttable").find('tr');
  var len = alltr.length - 1;

  //$(alltr).each(function(){ $(this).find("td:first-child").text(i)});


  //alert(len);

    var clone = tr.remove();
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

      var c = document.getElementById("endate").value;

      //alert("c-----"+c);
       //alert("c--"+c);
      var d = document.getElementById("entime").value;




      $('#strt_time').val(b);
      $('#st_time').val(b);
      $('#str_time').val(b);

      $('#en_time').val(d);


             if(b!="" && d!="")
             {
              //alert("b--"+b+" d--"+d);
                 //create date format
                 var timeStart = new Date("01/01/2007 " + b).getHours();
                 var timeEnd = new Date("01/01/2007 " + d).getHours();

                if(timeEnd===timeStart)
                 { //alert("1");
                    var hourDiff = timeEnd - timeStart;
                    $('#total_hours').val(hourDiff);

                 }else if(timeEnd<timeStart){
                   // alert("2");
                    /*var hourDiff = timeEnd - timeStart;
                    temp_total_hours.val(hourDiff); */

                   $('#total_hours').val("");

                 }else{
                     //alert("3");
                    var hourDiff = timeEnd - timeStart;
                    $('#total_hours').val(hourDiff);

                 }

             }

   /*
      document.getElementById("st_date").value = a;

      document.getElementById("str_date").value = a;

      document.getElementById("strt_date").value = a;

      document.getElementById("start_date").value = a;*/


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
 // alert(l_name);

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


                   //fngetmaplatlong(temp1[2]);

                 //  alert("l_name--"+l_name);
                   $('#crew_loc option[value='+l_name+']').prop('selected', true);

          }
        });

});
});
</script>

<!-- <script type="text/javascript">

 function fngetmaplatlong(address);
  {



  }

</script>
 -->

<script type="text/javascript">
$(document).ready(function(){
$("#cus_names").on("change", function(){
  // alert('123');
 var l_name_v= $(this).val();
 // var store_id_n= $(this).attr("id");
  // alert(l_name);
  var l_name=$('#cuslist_info_event [value="' + l_name_v + '"]').data('value');
  // alert(l_name);
  localStorage.setItem("customer_name", l_name_v);

 if (l_name !="") {

      var pckId=l_name;
      // alert("pckId--"+pckId);
      localStorage.setItem("pckId", pckId);

   window.location.href = "<?php echo site_url('fi_home/search_cus')?>?id="+l_name;

   return true;
 }
 else {
  return false;
 }



});
});
</script>



<script type="text/javascript">
$(document).ready(function(){
$("#sercgcustph").on("change", function(){
  var txtsrchphone= $(this).val();
  var id= $('#cus_names').val();

  // alert("txtsrchphone--"+txtsrchphone+" id--"+id);

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

  <script>
  function loadcustlist()
  {
    var name = $('#cus_names').val();
    // alert(name);

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
        data: {name : name},
        dataType: 'html',
        success: function(data)
        {
          if(data!="")
          {
            //console.log(data);

           $('#contact_info').html(data);

         }else{
             $('#contact_info').html(data);
         }
       }
    });
    }
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



    //alert("temp_total_hours--"+temp_total_hours);

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
    // alert("eventId--"+eventId+" cusId--"+cusId);

      event.preventDefault();

       var r = confirm("Do you want delete this event..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndeleventinfo')?>',
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
                  url: '<?=site_url('fi_home/fndellocationinfo')?>',
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
                  url: '<?=site_url('fi_home/fndelcrewsinfo')?>',
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
$("body").on("change", "#crewstype, .crewstype", function(event){

    var temp_crewstype =  $(this).parents(".tr_clone").find(".crewstype");
    var temp_vendtyp =    $(this).parents(".tr_clone").find(".vendortype");
    var crwtype= temp_crewstype.val();

       //alert("crwtype--"+crwtype);

              $.ajax({
              type: 'POST',
              url: '<?=site_url('fi_home/getvendorlist')?>',
              data: {crwtype:crwtype},
              dataType: 'json',
              beforeSend: function() {
                  // setting a timeout
                  $('.fadeMe').show();
                 //alert("before crwtype--"+crwtype);
              },
              success: function(data) {
                 //alert("data--"+data);
                var appendata=data.vendorlist;
                //alert("appendata--"+appendata);
                temp_vendtyp.html("");

                if(appendata!="")
                {
                     $.each(appendata,function(i,item)
                      {
                          //alert(item.cus_fname+"-"+item.cus_lname);

                          var option = $("<option />");
                          option.html(item.cus_fname+"-"+item.cus_lname);
                          option.val(item.cus_fname+"-"+item.cus_lname);

                          temp_vendtyp.append(option);
                      });

                    $('.fadeMe').hide();

                }else{

                    var option = $("<option />");
                    option.html("Select");
                    temp_vendtyp.append(option);
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
 function fnvieweventinfo(eventId,cusid)
  {

       $.ajax({
         type: "POST",
         url: "<?php echo base_url('fi_home/fnloadeventinfo'); ?>",
         data: {eventId:eventId},
         dataType: 'html',
          beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
               //alert("eventId--"+eventId+" cusid--"+cusid);
            },
         success: function(data)
          {
            //alert(data);
             if(data!="")
              {
                $('.group-outer').html(data); //group-outer
                $('#createvent').attr('action', '<?=site_url('fi_home/addeventinfo')?>');
                $('.fadeMe').hide();
              }

          },
         complete: function(data) {

            $('.fadeMe').hide();

          }

        });

  }
</script>

<script type="text/javascript">
$(document).ready(function()
//$(window).load(function()
  {//alert("cx");
       $('.fadeMe').show();
      var pckId= localStorage.getItem("pckId");
     // alert("localStorage pckId--"+pckId);
      if(pckId==null || pckId=="" || pckId=='N' || pckId=='null')
      {//alert("NULL");
             var cus_names=$('#cus_names').val();
             // alert("cus_names--"+cus_names);
             if (cus_names !="") {

               window.location.href = "<?php echo site_url('fi_home/search_cus')?>?id="+cus_names;
             }else {
             }
      }else{//alert("NOT NULL");
      // alert('else '+pckId);
        window.location.href = "<?php echo site_url('fi_home/search_cus')?>?id="+pckId;
      }
 });


function cus_event(){

 var l_name = $('.cus_event').val();

  window.location.href = "<?php echo site_url('fi_home/search_cus')?>?id="+l_name;

}
</script>