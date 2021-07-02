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

  <body class="hold-transition skin-blue sidebar-mini administration_package">



      <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Administration</a></li>

        <li class="active">Terms</li>

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

        <div class="row">
            <div class="col-md-12">
              <div class="pull-right" style="margin-bottom: 10px;">
                <a href="<?=site_url('Administration/view_sub_cat')?>" class="btn btn-md btn-info btn-flat">New Contract Type</a>
               
                </div>
            </div>
        </div>

          <!-- TABLE: LATEST ORDERS -->
          <!-- action="<?//=site_url('fi_home/admin_packages/')?>"  -->
          <form  method="POST" id="iform" name="iform">
          <div class="row">

            <div class="col-md-6">

              <div class="box box-info">

                <div class="box-header with-border">

                  <div class="row">

                    <div class="col-sm-5 col-md-4">

                      <h3 class="uhead2">

                        Contract Type

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
                </div><div class="box-body">
                </div>
              </div>

              <div class="box box-default firstblock_bg">
                <div class="table-responsive">

                    <table class="table   table-hover no-margin">

                      <thead>

                        <tr class="uppercse_block">

                          <th>#</th>

                          <th>Name</th>

                         <!--  <th style="width:20%">Price</th>

                          <th>Taxable</th> -->
                          <th>Action</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td>1</td>

                          <td>

                           
                           <select class="form-control" name="item_package_name" id="itemPackageName" onchange="fngetsinglepckinfo(this.value)">
                           
                              <?php
                                $user = $this->session->fi_session['id'];
                                $all_packs = $this->db->query("SELECT * from sub_categories WHERE cat_id = 35 AND user = '".$user."'  ORDER BY sub_id ASC ");
                                $terms_id = $this->session->userdata('terms_id');
                                foreach($all_packs->result() as $items)
                                {
                                    if ($terms_id==$items->sub_id) {
                                        $select='selected';
                                    }
                                    else 
                                    {
                                        $select='';
                                    }
                                    ?>
                                    <option <?=$select  ?> value="<?=$items->sub_id?>"><?=$items->sub_name?></option>
                                    <?php 
                                } ?>

                              </select>

                          </td>
                          <td><a class="btn btn-danger btn-sm" id="deletepackage">Delete</a></td> 

                        </tr>

                      </tbody>

                    </table>

                  </div>
              </div>

            </div>

                <!-- /.col -->

                <div class="col-md-6">

              <div class="box box-default secondblock_bg">

                  <div class="box-header with-border">

                    <p class="uhead2">Terms</p>



                    <div class="box-tools pull-right">

                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                      </button>

                    </div>

                    <!-- /.box-tools -->

                  </div>

                  <!-- /.box-header -->

                <div class="box-body">


                  <div class="table-responsive">

                    <table class="table table-hover no-margin">

                      <thead>

                        <tr >

                          <th>#</th>

                          <th>Name</th>
                         <!--  <th>Qty</th>
                          <th>Price</th> -->
                           <th>Amount</th>
                          <th>Action</th>

                        </tr>

                      </thead>

                      <tbody class="newcalc" id="pckitems">


                      </tbody>

                    </table>

                  </div>

                  <!-- /.table-responsive -->

                </div>

                <!-- /.box-body -->

              </div>

            </div>


          </div>
        </form>


        </section>

        <!-- /.content -->

      </div>

      <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>


<script type="text/javascript">

 function fnadmpckinfo(admpckId,txtinpid)
  {
    //alert("admpckId--"+admpckId+" txtinpid--"+txtinpid);

     $.ajax({
        type: "POST",
        url: "<?=site_url('fi_home/fngetadmpckjson')?>",
        data:'admpckId='+admpckId,
        dataType: "json",
        success: function(data)
          {
            var myobj=data.admpackageitem;
            //alert("desc--"+myobj.item_desc);
            $("#item_price"+txtinpid).val(myobj.item_price);
            $("#itmdesc"+txtinpid).val(myobj.item_desc);
          }
      });
  }

</script>





<script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('assets/');?>js/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

 <script type="text/javascript">
$(document).ready(function(){
$('body').on('click','.tr_clone_add',function(){

          var $tr    = $(this).closest('.tr_clone');
          var $clone = $tr.clone();

          $clone.find(':text').val('');
          $clone.find(':radio').prop( "checked", false );
          $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()
          $clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
         //$tr.after($clone);
         $tr.before($clone);

});
});


$(document).on('click', '.tr_clone_remove', function(){
    var $tr    = $(this).closest('.tr_clone');
    var $clone = $tr.remove();
});
</script>



  <script>

  $(document).ready(function(){

    var item_price;
  $(".newcalc").on("click",".iname", function(){
    // alert(123);
   var i_name = $(this).val();

   $.ajax({
       type: "POST",
       url: "<?php echo base_url('Fi_home/single_price_info'); ?>",
       data: {i_name : i_name},
       success: function(data)
       {
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

    $(".quants").on("keyup change", function(){
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
                     item_name:{required: true},
                     item_quant:{required: true},
                     i_price:{required: true}

                     // acquiredBy:{required: true}
         },
         highlight: function (element) {
             $(element).closest('.frm_testimonials').removeClass('success').addClass('error');
         },

         messages: {
                     // title:{required: "Please Select Title"},
                     item_name:{required: "Please enter Item Name"},
                     item_quant:{required: "Please enter Quantity"},
                     item_price:{required: "Please enter price"}
                     // cus_zip:{required: "Please Enter Zip Code"}


                     // acquiredBy:{required:"Please select Acquired By."}

         },

     });
  });

  </script>

<script type="text/javascript">
   function fngetsinglepckinfo(pckId)
   {
        // alert("done " +pckId);
        localStorage.setItem("pck_tearmId", pckId);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('Administration/fncntrcttrms')?>',
            data: {pckId:pckId},
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("beforeSend pckId--"+pckId);

            },
            success: function(data) {

              //alert("data--"+data);
             if(data!="")
                {


                  $('#itemPackageName').val(pckId).attr("selected");

                  $('#pckitems').html(data);
                  $('.fadeMe').hide();
                   //localStorage.removeItem(pckId);
                   localStorage.clear()

                }else{

                   $('#pckitems').html("No Items Found ");
                   $('.fadeMe').hide();

                  // localStorage.removeItem(pckId);
                    localStorage.clear()
                }
            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
              //$('.fadeMe').hide();
                 //var pckId= localStorage.getItem("pckId");
                   localStorage.removeItem(setpckid);
                    localStorage.clear()
            }

        });

     }

   </script>

   <!-- End Get packages Items Info -->

   <!--  Create Items -->
  <script type="text/javascript">
     function fncrpitem(itmId)
     {

      // var pckId= localStorage.getItem("pck_tearmId");
      var pckId= itmId;
      
      // var pckId= $('#itemPackageName').val();
      event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crnewpterms')?>',
            data: {pckId:pckId},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

              //alert("data---"+data);

                if(data=="success")
                {
                  localStorage.setItem("pck_tearmId", pckId);
                   window.location.href=location.href;
                   $('.fadeMe').hide();

                }else if(data=="error"){

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
     function fndelpitem(itmId)
     {

        var pckId=$('#itemPackageName').val();
        event.preventDefault();

       var r = confirm("Do you want delete this terms..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delnewpterms')?>',
                  data: {itmId:itmId,pckId:pckId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();

                  },
                  success: function(data) {
                      //alert("data---"+data);
                      if(data=="success")
                      {

                           window.location.href=location.href;
                            $('.fadeMe').hide();

                      }else if(data=="error"){

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
  function fnadmitemsinfo(admpckId,txtinpid)
  {
    //alert("admpckId--"+admpckId+" txtinpid--"+txtinpid);

    var pckId=$('#itemPackageName').val();
    localStorage.setItem("pckId", pckId);

     $.ajax({
        type: "POST",
        url: "<?=site_url('fi_home/fngetadmpckjson')?>",
        data:'admpckId='+admpckId,
        dataType: "json",
        success: function(data)
          {//alert("data--"+data);
            var myobj=data.admpackageitem;
            $("#i4"+txtinpid).val(myobj.item_price);
            $("#i3"+txtinpid).val(myobj.item_desc);

            //alert(admpckId+"--"+myobj.item_price+"--"+myobj.item_desc+"--"+txtinpid+"--"+pckId);

            fnupdateitemsdtls(admpckId,myobj.item_price,myobj.item_desc,txtinpid,pckId);

          }
      });
  }
</script>
<!--  End Update items data  -->

<!--  Update admpckId,item_price,item_desc,txtinpid,pckId -->
  <script type="text/javascript">
   function fnupdateitemsdtls(admpckId,item_price,item_desc,txtinpid,pckId)
     {

          event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/upditemsinfo')?>',
            data: {admpckId:admpckId,item_price:item_price,item_desc:item_desc,txtinpid:txtinpid,pckId:pckId},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {
                //alert("data---"+data);
                if(data=="success")
                {

                    window.location.href=location.href;
                    $('.fadeMe').hide();

                }else if(data=="error"){

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
  function fnupdateitemamountp(itemamt,txtinpid)
  {
    //alert("itemamt--"+itemamt+" txtinpid--"+txtinpid);


        var pckId= $('#itemPackageName').val();
        localStorage.setItem("pckId", pckId);

         event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/upditemsamnt')?>',
            data: {itemamt:itemamt,txtinpid:txtinpid,pckId:pckId},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

               if(data=="success")
                {

                   window.location.href=location.href;
                   $('.fadeMe').hide();
                }else if(data=="error"){

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
  function fnupdateitemdescp(itemdesc,txtinpid)
  {
    //alert("itemdesc--"+itemdesc+" txtinpid--"+txtinpid);
          var pckId=$('#itemPackageName').val();
          localStorage.setItem("pckId", pckId);


         event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/upditemsdescrp')?>',
            data: {itemdesc:itemdesc,txtinpid:txtinpid},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

               if(data=="success")
                {

                   window.location.href=location.href;

                   $('.fadeMe').hide();
                }else if(data=="error"){

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
  function fnupdatepackagetot(ptot)
  {


        var pckId= $('#itemPackageName').val();

       // alert("ptot--"+ptot+" pckId--"+pckId);


         event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtpackagetot')?>',
            data: {ptot:ptot,pckId:pckId},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

               if(data=="success")
                {

                   window.location.href=location.href;
                   $('.fadeMe').hide();
                }else if(data=="error"){

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
  $(document).ready(function()
  {
      var pckId= localStorage.getItem("pck_tearmId");
      // alert("pckId======"+pckId);
      if(pckId!=null)
      {
        //alert("T");
        fngetsinglepckinfo(pckId);

      }else{
         // alert("F");
          var custnm = $('#itemPackageName').val();
          // alert("custnm--"+custnm);
          fngetsinglepckinfo(custnm);
      }

  });
</script>

<script type="text/javascript">
  $(document).ready(function()
  {
      $("body").on("click", "#deletepackage", function(event){

         var pckId = $('#itemPackageName').val();
         //alert("pckId--"+pckId);
          event.preventDefault();
         var r = confirm("Do you want delete this Contract Type..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delselconracttype')?>',
                  data: {pckId:pckId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();

                  },
                  success: function(data) {
                      //alert("data---"+data);
                      if(data=="success")
                      {

                           window.location.href=location.href;
                            $('.fadeMe').hide();

                            var pckId= localStorage.getItem("pckId");
                             localStorage.removeItem(pckId);
                             localStorage.clear()

                      }else if(data=="error"){

                          $('.fadeMe').hide();
                          //alert("Something went wrong..!");
                      }



                  },
                  error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();
                    var pckId= localStorage.getItem("pckId");
                     localStorage.removeItem(pckId);
                     localStorage.clear()
                  }

              });
          }


      });
  });


</script>


<script type="text/javascript">

function fnsearchcustomer()
  {

    var itemname=$('#itemname').val();
    var itemprice=$('#itemprice').val();
    var pckId= $('#itemPackageName').val();

   if(itemname!="Select" || itemprice!="")
   {


    //alert("itemname--"+itemname+" itemprice--"+itemprice+" pckId--"+pckId);

     $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/search_pckageitems')?>",
            data: {itemname:itemname,itemprice:itemprice,pckId:pckId},
            dataType:"html",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
             // alert(data);
                if(data!="")
                {
                  // console.log(data);

                 //$('#tab_data tbody').html(data);
                 $('#pckitems').html(data);
                 $('.fadeMe').hide();


               }else{
                   //$('#tab_data tbody').html(data);
                   $('#pckitems').html(data);
                    $('.fadeMe').hide();
               }
            }
        });

     }else{

         //alert("Please enter atleast one field to search record..!");

        // alert("ELSE pckId--"+pckId);


          $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/search_allpckageitems')?>",
            data: {pckId:pckId},
            dataType:"html",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
              //alert(data);
              if(data!="")
               {

                   $('#pckitems').html(data);
                   $('.fadeMe').hide();


                }else{

                   $('#pckitems').html(data);
                   $('.fadeMe').hide();
               }
            }
         });



     }

  }
</script>

<script type="text/javascript">
function fnupdatetrmsinfo(inptxtval,trmId,fieldnm)
  {
     //alert("inptxtval--"+inptxtval+" trmId--"+trmId+" fieldnm--"+fieldnm);
            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnupdtrmsinfo')?>',
            data: {inptxtval:inptxtval,trmId:trmId,fieldnm:fieldnm},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

               if(data=="success")
                {
                   //window.location.href=location.href;
                   //$('#pckitems').load(location.href + ' #pckitems>*','');
                   $('.fadeMe').hide();

                }else if(data=="error"){

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
function fninseartrmsinfo(inptxtval,trmId,fieldnm)
  {
     // alert("inptxtval--"+inptxtval+" trmId--"+trmId+" fieldnm--"+fieldnm);
            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fninseartrmsinfo')?>',
            data: {inptxtval:inptxtval,trmId:trmId,fieldnm:fieldnm},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

               if(data=="success")
                {
                   window.location.href=location.href;
                   //$('#pckitems').load(location.href + ' #pckitems>*','');
                   $('.fadeMe').hide();

                }else if(data=="error"){

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
