<!DOCTYPE html>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Invoices</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
	.dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }

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

    table .form-group {
        margin-bottom: 0;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        /*padding: 1px;*/
    }

    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-clear-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    @media(max-width:1300px) {

        input[type="date"]{ max-width:90px;}
    }


    div#terms {
        max-height: 300px;
        overflow-y: auto;
    }

    input[type=checkbox], input[type=radio] {
        margin: 0 0 -1px;
    }

    .box * #loaditms {
        background: #fff;
    }

    #pickup select[name *="item_name"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }

    .inline_block{
      display: inline-block;
    }
    


    @media print {
        .titlen_search {
            display: none;
        }
      
        .box.box-default.firstblock_bg {
            display: none;
        }
    
        .mytabber ul.nav.nav-tabs {
            display: none;
        }
    
        .box.box-default.thirdblock_bg {
            display: none;
        }
    
        #loaditms { 
            display: block; 
        
        }
      
        .col-md-12.text-center.hide_in_invoice {
            display: none;
        }

        .hide_in_invoice{
            display: none;
        }
        
        .box-header {
            display: none;
        }

        .inline_block{
          display: block;
        }
    }

    tr.highlight {
    background-color: #f1eea04d;
}


  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <form action="" method="POST" id="cform" name="cust_invoice_form">
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Event Management </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Customer</a></li>
          <li class="active">Invoices</li>
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
        <div class="box box-info customer_sec titlen_search">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-sm-5 col-md-4">
                <h3 class="uhead1"> Invoices </h3>
              </div>
              
              <div class="col-sm-7 col-md-8">
                <div class="pull-right">
                  <ul class="list-inline topul">
                    <!-- <li><a href="#" class="uhead2"> Options </a></li> -->
                    <!-- <li><a class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal-note" style="color: #fff;"><i class="fa fa-pencil-square-o"></i> Note</a></li> -->
                    <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button><?=$email_not?></li>
                    <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                    <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <div class="box-body">
            <div class="row space3">
              <div class="col-md-3 lstpaytype_cus_col">
                <?php  
                $customersql=$this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC"); ?>
                <div class="form-group">
                  <select class="form-control cust_invoice" id="cus_notes" name="cus_notes"  onchange="cust_invoice()" autofocus="autofocus">

                    <?php
                      foreach ($customersql->result() as $customersql_data) { 
                        if($customersql_data->cus_id == $cus_id) {
                          ?>
                            <option 
                            style="font-size:13px;" 
                            data-value="<?php echo $customersql_data->cus_id?>" 
                            value="<?php print_r($customersql_data->cus_lname.", ".$customersql_data->cus_fname." - ". $customersql_data->cus_company_name." - ".$customersql_data->cus_acc_no); ?>">
                            <?php print_r($customersql_data->cus_lname.", ".$customersql_data->cus_fname." - ". $customersql_data->cus_company_name." - ".$customersql_data->cus_acc_no); ?>
                            <?php

                        }
                      }
              
                   ?>




                    <option value="">Choose</option>
                                       <?php
                        $i=1;
                        foreach ($customersql->result() as $customersql_data)
                        { ?>
                      <option style="font-size:13px;" data-value="<?php echo $customersql_data->cus_id?>" value="<?php print_r($customersql_data->cus_lname.", ".$customersql_data->cus_fname." - ". $customersql_data->cus_company_name." - ".$customersql_data->cus_acc_no); ?>">
                      <?php print_r($customersql_data->cus_lname.", ".$customersql_data->cus_fname." - ". $customersql_data->cus_company_name." - ".$customersql_data->cus_acc_no); ?>
                       </option>
                           <?php
                           $i++;
                         } ?>
                  </select>
                </div>
              </div>

              <?php 
              $cus_id = $this->session->userdata('id');
              if($cus_id !="") {
                $cntinfosql = $this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$cus_id."' AND default_contact=1 AND conatct_type!='Email'");
                $cntinfosql_row=$cntinfosql->row();
              }
              ?>

                  <div class="col-md-2">
                   <div class="form-group" id="contact_info">
                     <input class="form-control fcap contact_no" type="text" id="topphone" name="topphone" value="<?=$cntinfosql_row->contact_no?>">
                   </div>

                 </div>


      <div class="loaduppertabcntdtls">
        <div class="col-md-2 cus_acc_no">
          <div class="form-group" id="lastinvId">
            <input class="form-control" type="text" placeholder=" " value=" ">
          </div>
        </div>

        <div class="col-md-2 balance_count">
          <div class="form-group" id="lastinvduebal">
            <input class="form-control" type="text" placeholder=" " value=" ">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="box box-default firstblock_bg ">
  <div class="row">
    <div class="col-md-12">
      <div class="box-header with-border">
        <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
        <p class="uhead2">Invoices</p>
      </div>

      <div class="table-responsive" id="myinvoice">
        <input type="hidden" name="new_invoice" value="new_invoice" class="form-control">
          <table class="table   table-hover no-margin">
            <thead>

                          <tr>

                            <th></th>
                            <th><span class="w60 inblock">#</span></th>
                            <th>Date</th>
                            <th>Due date</th>
                            <th width="20%">Event</th>
                          <!--   <th>Go</th> -->
                            <th width="20%">Contract Type</th>
                            <th>Disc.</th>
                            <th><span class="w60 inblock">Inv. Disc. </span></th>
                            <th>Amount</th>



                           <!--  <th>Sub Total</th> -->

                            <th>Tax</th>
                             <th>Tax Rate</th>

                            <!--  <th>Sub Total</th> -->

                             <th><span class="w70 inblock">Discd Amt</span></th>

                           <!--  <th>Status</th> -->


                             <th>Paid</th>
                             <th><span class="w70 inblock">Bal Due</span></th>
                            <th>County</th>
                            <th>User</th>
                           <!--  <th>User</th> -->
                             <th></th> 
                            <th>Action</th>

                          </tr>

                        </thead>

                        <thead id="filterinvoicedata">


                        </thead>

                      </table>

                    </div>

                    <!-- /.table-responsive -->

                  </div>

                </div>
            </div>



        <div class="mytabber">

  <!-- Nav tabs -->
  <ul  class="nav nav-tabs" role="tablist">
    <!--<li role="presentation" class="active"><a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">Invoices</a></li>-->
    <li role="presentation" class="active">
      <a tabindex="-1" onclick="check_cus_seleted();" href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a>
    </li>
    <li role="presentation">
      <a tabindex="-1" onclick="check_cus_seleted();" href="#terms" aria-controls="terms" role="tab" data-toggle="tab">Terms/Tasks </a>
    </li>
    <li role="presentation">
      <a tabindex="-1" onclick="check_cus_seleted();" href="#pickup" aria-controls="pickup" role="tab" data-toggle="tab">Pickup Info</a>
    </li>
    <li role="presentation">
      <a tabindex="-1" onclick="check_cus_seleted();" href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes  </a>
    </li>
    <li role="presentation">
      <a tabindex="-1" onclick="check_cus_seleted();" href="#associated" aria-controls="associated" role="tab" data-toggle="tab">Associated Order  </a>
    </li>
    <li role="presentation">
      <a tabindex="-1" onclick="check_cus_seleted();" href="#history" aria-controls="history" role="tab" data-toggle="tab">History  </a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" id="divloadinvtabs">



  </div>
  <!--  End all tab section -->



</div>








       </section>

       <div class="col-md-12 text-center hide_in_invoice">

          <button style="margin: 0 5px;" onclick="print();" class="btn btn-lg btn-info btn-flat">Invoice</button>
          <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
          <a href="<?=base_url()?>PaymentsCont/c_payment" class="btn btn-lg btn-info btn-flat finish">Save & Continue</a>
          <!-- <button name="button" id="Submit" class="btn btn-lg btn-info btn-flat">Save & Continue</button> -->

        </div>

       <!-- /.content -->

     </div>

     </form>

<div class="clearfix mt30"></div> 


<!-- Modal -->
<div class="modal fade payment_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Payment </h4>
      </div>
      <div class="modal-body">
       <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Payment</th>

                          <th>Date</th>

                          <th>Reciept</th>

                          <th>Payment Type</th>

                          <th>Amount</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone auto-index">

                        <td>1</td>

                        <td><input type="text" name="invoice_payment[]" class="form-control"></td>

                        <td><input type="date" name="payment_date[]" class="form-control"></td>

                        <td><input type="text" name="payment_reciept[]" class="form-control"></td>

                        <td><input type="text" name="payment_type[]" class="form-control"></td>



                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="payment_amount[]" class="form-control" style="width: 80px;">
                              </div>
                          </div>
                        </td>



                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                         <button class="btn btn-xs btn-success tr_save_btn"><i class="fa fa-floppy-o"></i> Save</button> 

                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                <!-- /.table-responsive -->

              </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>


    </div>
  </div>
</div>

<div  class="fadeMe" > <div id="loader" class="loader"></div> </div>

<div id="hdndivinvoicedtls"></div>
<div id="divhdnrepo"></div>
<div id="divhdntaskrepo"></div>
<div id="divtextresp"></div> 







     <!-- /.content-wrapper -->

     <!-- Main Footer -->



   <!-- ./wrapper -->

   <!-- REQUIRED JS SCRIPTS -->

   <!-- jQuery 3 -->

  <script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->

  <!--<script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->

  <!-- AdminLTE App -->

  <!-- <script src="dist/js/adminlte.min.js"></script> -->

  <script type="text/javascript">
  function focus0(id){
   
    //id = id-1;
    $(".focus1"+id).focus();
    //document.getElementsByClassName("focus1"+id).focus();
  };

 function focus1(){
 
     $(".focus2").focus();
  };

  function focus3(){
    
    var take_my_data = $('.take_my_data').val();
    //console.log(take_my_data);
    if(take_my_data == ''){
      $(".finish").focus();
    }
    else {
      $(".next_tab4").focus();
    }
  }  

   function focus4(){
    
    var take_my_data = $('.take_my_data4').val();
   
    if(take_my_data == ''){
      $(".finish").focus();
    }
    else {
      $(".next_tab4").focus();
    }
  }  
  </script>

    <script type="text/javascript">
$(document).ready(function()
{
  	//var cnt = 2

 $("body").on('click','.tr_clone_add.inv', function(rrr) {

      rrr.preventDefault();

    var $tr    = $(this).closest('.tr_clone');

    var $clone = $tr.clone();

    $clone.find(':text').val('');
    $clone.find('td:first-child').val('');

    $clone.find('.tr_clone_add.inv ').siblings('.tr_save_btn').remove()

    $clone.find('.tr_clone_add.inv').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove inv').html('<i class="fa fa-minus"></i>');

    

    $tr.after($clone);
    //$tr.before($clone);

	  //$tr.parent("thead").append($clone);

	//cnt++;

});





$(document).on('click', '.tr_clone_remove.inv', function(){

     // Your Code

    var $tr    = $(this).closest('.tr_clone');

	$(this).closest('table').addClass("currenttable");
	var alltr = $(this).parents("table.currenttable").find('tr');
	var len = alltr.length - 1;

	//$(alltr).each(function(){ $(this).find("td:first-child").text(i)});


	

    var $clone = $tr.remove();
	if(cnt>0)
	{
	cnt--;


	}

});

});

  </script>



<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>




<!--  Create Invoice -->
  <script type="text/javascript">
     function fncrinvoice(invoiceid)
     {

     	var customrId= localStorage.getItem("pckId");
     
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crnewinvoice')?>',
            data: {invoiceid:invoiceid,customrId:customrId},
            dataType: 'html', //text
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

            

                $('#hdndivinvoicedtls').html(data);

                var responce= $('#responce').val();
                var hdninvoiceId= $('#hdninvoiceId').val();

              

                if(responce=="success")
                {
                    $('.fadeMe').hide();
                   
                     localStorage.setItem("sess_invid", '');
                     $("#filterinvoicedata tr:last-child").addClass('active-cust');
                     fnsearhinvoice(customrId);
                 

                     $('.mytabber ul > li').removeClass('active');
                     $('.mytabber ul > li:first-child').addClass('active');

                }else if(responce=="error"){

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

<!-- End Create Invoice -->


<!--  Delete Invoice -->
   <script type="text/javascript">
     function fndelinvoice(invoiceid)
     {
        //alert("invoiceid--"+invoiceid);
       event.preventDefault();

       var r = confirm("Do you want delete this invoice..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delinvoice')?>',
                  data: {invoiceid:invoiceid},
                  dataType: 'text',
                // cache: false,
                //  async: false,
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                      //alert("data---"+data);


                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          //alert("Invoice Created Successfully..!");
                          //window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                          $("#myinvoice").load(location.href + " #myinvoice");

                            //fnsearhinvoice(customrId);
                            window.location.href='<?=site_url('fi_home/custinvoices')?>';

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

<!-- End Delete Invoice -->


<!--  Update Invoice -->
<script type="text/javascript">
function fnupdateinvoiceinfo(inptxtval,invoiceid,fieldnm)
  {
   //alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);
      //       event.preventDefault();

            if(fieldnm=='invoice_date' || fieldnm=='invoice_due_date')
            {
                // var arr = inptxtval.split("-");
                // var first2 = arr[0].slice(0,2);
                // var last2 = arr[0].slice(-2);
                // if(first2 == '00')
                // {
                //     today = '20'+last2 + '-' + arr[1] + '-' + arr[2];

                //     inptxtval = today;
                //     $("#"+fieldnm+""+invoiceid).val(inptxtval);

                // }


                var arr = inptxtval.split("/");
                inptxtval = arr[2]+"-"+arr[0]+"-"+arr[1];
                //alert("Aks:"+inptxtval);
            }

            // alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

            if(fieldnm=='invoice_contract_type')
            {
              // alert("if");
                      $.ajax({
                      type: 'POST',
                      url: '<?=site_url('fi_home/updtinvoice')?>',
                      data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
                      dataType: 'text',
                      beforeSend: function() {
                          // setting a timeout
                          $('.fadeMe').show();


                      },
                      success: function(data) {

                          if(data=="success")
                          {
                              $('.fadeMe').hide();

                              //fngetinvoicedetails(invoiceid);

                              fnupdateinvterms(inptxtval,invoiceid);


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
            }else{

              // alert("else");
                      $.ajax({
                      type: 'POST',
                      url: '<?=site_url('fi_home/updtinvoice')?>',
                      data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
                      dataType: 'text',
                      beforeSend: function() {
                          // setting a timeout
                          $('.fadeMe').show();

                      },
                      success: function(data) {

                        var custid= localStorage.getItem("pckId");
                          // alert(custid);
                        // var custid= $('#custnm option:selected').val();

                          if(data=="success")
                          {
                              $('.fadeMe').hide();

                              fngetinvoicedetails(invoiceid,'items',custid);
                              //Console.log("fngetinvoicedetails 1");

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

<!-- End Update Invoice -->

<!--  Get Invoice Info -->
<script type="text/javascript">

  function fngetinvoicedetails(invoiceid, tbparam, custid) {

    //console.log("invoiceid_"+invoiceid);
    //console.log("custid_"+custid);

    $.ajax({
      type: 'POST',
      url: '<?=site_url('fi_home/fngetinvoiceinfo')?>',
      data: {invoiceid:invoiceid, custnm:custid},
      dataType: 'html',
      
      beforeSend: function() {
        $('.fadeMe').show();
      },

      success: function(data) {

        $('#divloadinvtabs').html(data);
        loadinvtopinfo(invoiceid,custid);

        if(tbparam != undefined) {
        }
        
        $('#divloadinvtabs .tab-pane').removeClass('active');
        var trr1 = $(".mytabber .nav li.active a").attr("href");
                  // alert(trr1);
                   $('#divloadinvtabs').find(trr1).addClass('active');
                  // $('#'+trr1).addClass('active');

                  $('.fadeMe').hide();

                  //$('.focus3').focus();

            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
              //$('.fadeMe').hide();

            }

        });
  }
</script>
<!-- End Get Invoice Info -->



<!--  End Create new Package  -->



<!--  Get Invoice Items Info -->
<script type="text/javascript">

  /*Select package and add in invoice*/

    function fngetsinglepckinfo(pckId) {
    
        $(".focus3").focus();

        if(pckId != "") {

            var custid = localStorage.getItem("pckId");
            // var custid=$('#custnm').val();
            // var invId=$('#invId').val();
            var invId = $('#filterinvoicedata tr.active-cust').find('.hdninvrowId').val();

            if(invId == undefined) {

                var invId = $('.hdninvrowId2').val();
                $(".hdninvrowIdtr2").addClass("active-cust");
                //var element = document.getElementsByClassName("hdninvrowIdtr2");
                //element.addClass("active-cust");
            }

            var sess_invid = localStorage.setItem("sess_invid", invId);

            $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/fngetsignlepckinfo')?>',
                data: {pckId:pckId,custid:custid,invId:invId},
                dataType: 'text',
                beforeSend: function() {

                    // setting a timeout
                    $('.fadeMe').show();
                },
        
                success: function(data) {

                    // alert("else data--"+data);
          
                    if(data != "") {

                        fnsearhinvoice(custid);
                        $(".focus3").focus();
                    }
                },
        
                error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                    $(".focus3").focus();
                },
                
                complete: function() {
                    //$('.fadeMe').hide();
                    $(".focus3").focus();

                }
            });     
        }  
    }
</script>

<script type="text/javascript">
function fnupdatepckg(pckId,assignpckId)
 {

        var custid=localStorage.getItem("pckId");
        
        var invId=$('#invId').val();

      
              $.ajax({
              type: 'POST',
              url: '<?=site_url('fi_home/fnupdatepckginfo')?>',
              data: {pckId:pckId,custid:custid,invId:invId,assignpckId:assignpckId},
              dataType: 'html',
              beforeSend: function() {
                  
                  $('.fadeMe').show();

              },
              success: function(data) {


                 if(data!="")
                  {



                    $('#pckitems').html(data);
                    $('.fadeMe').hide();
                    var ptot=$('#pcktot').val();
                    var lstrcd=$('#invId').val();
                    $('#pri').val(ptot);
                    var pgrandtot=$('#pckgrndtot').val();

                    $('#invoice_amount'+lstrcd).val(ptot);
                    // alert("1success");
                    fnupdateamount(pgrandtot,lstrcd,pckId);

                  }else{
                    // alert("1error");

                     $('#pcktot').val("");
                     $('.fadeMe').hide();
                     var pgrandtot ="";
                     fnupdateamount(pgrandtot,lstrcd,pckId);
                  }
              },
              error: function(xhr) {
                alert("2error");
             
              },
              complete: function() {
              

              }

          });

   }
</script>

<!-- End Update package type -->
<script>
  
  function cust_invoice() {
    
    var value = $( ".cust_invoice option:selected" ).val(); 
    var cust_id = $('.cust_invoice [value="' + value + '"]').data('value');

    localStorage.setItem("pckId", cust_id);
    localStorage.setItem("customer_name", value);
    
    fnsearhinvoice(cust_id);

        var cu_name= localStorage.getItem("customer_name");
        $('.cust_invoice').val(cu_name);
    

  }
  $(document).ready(function(){



  	$('#custnm').on('input', function() {
  	    var value = $(this).val();
        // alert(value);

        var cust_id=$('#cuslist_invoice [value="' + value + '"]').data('value');
        // alert(cust_id);
        localStorage.setItem("customer_name", value);
        fnsearhinvoice(cust_id);


  	});

    var cu_name= localStorage.getItem("customer_name");
    // alert("name "+ cu_name)
    $('#custnm').val(cu_name);
  });
  </script>


  <!--  Get Invoice Info -->
   <script type="text/javascript">
     function fnsearhinvoice(custid)
     {

       // event.preventDefault();
       // alert("custid-1--: "+custid);


       if (custid !="" && custid !='N' && custid !='undefined') {

         // alert("if");
            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fngetsearhinvoice')?>',
            data: {custid:custid},
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("Before custid--"+custid);

               // localStorage.clear();
                var pckId=custid;
                // alert("pckId--"+pckId);
                localStorage.setItem("pckId", pckId);

            },
            success: function(data) {//alert(data);
                
              if(data!="")
              {
                // $('#filterinvoicedata').html('');
                 $('#filterinvoicedata').html(data);

                 //$("#myinvoice").load(location.href + " #myinvoice");

                 $('.fadeMe').hide();

                  var invice_id= localStorage.getItem("sess_invid");
                  // alert("id"+invice_id);

                  if (invice_id =="undefined" || invice_id =="") {
                    // alert("hi");
                    fngetinvoicedetails(lstrcd, 'items', custid);
                   

                    // $('#custnm option[value="'+custid+'"]').attr("selected", "selected");
                     loadinvtopinfo(lstrcd,custid);
                    $("#filterinvoicedata tr:last-child").addClass('active-cust');
                }
                else {
                  // alert("else");
                  var lstrcd=$(".table tr:nth-last-child(1) td").next().html();

                  // var lstrcd=$(".table tr:nth-last-child(1) td").next().html();
                  // alert("load--"+lstrcd);
                  var temp_match = "";
                  var selected = "";

                  $("#filterinvoicedata tr").each(function(){
                    temp_match = $(this).find(".hdninvrowId").val();

                    if(temp_match == Number(invice_id))
                    {
                      lstrcd=invice_id;
                      fngetinvoicedetails(lstrcd,'items',custid);
                      

                      var temp_chnage=temp_match;
                      $(this).addClass('active-cust');
                      selected = "1";
                    }
                    else
                    {
                      fngetinvoicedetails(lstrcd,'items',custid);
                      

                      // $('#custnm option[value="'+custid+'"]').attr("selected", "selected");
                       loadinvtopinfo(lstrcd,custid);
                    }
                  });

                  if(selected!="1"){
                    fngetinvoicedetails(lstrcd,'items',custid);
                    //Console.log("fngetinvoicedetails 5");

                    $("#filterinvoicedata tr:last-child").addClass('active-cust');
                  }

                  fngetinvoicedetails(lstrcd,'items',custid);
                  //console.log("fngetinvoicedetails 11");

                  // $('#custnm option[value="'+custid+'"]').attr("selected", "selected");
                   loadinvtopinfo(lstrcd,custid);


                }







                   //$('.glyphicon-usd').parent('.input-group-addon').addClass("xyz");

              }else{

                $('#filterinvoicedata').html('<tr><td colspan="18">No Invoice Found..!</td></tr>');
                $('.fadeMe').hide();
                // $('#pckitems').html('');
                 $('#items').css('display','none');
                  $('#custnm option[value="'+custid+'"]').attr("selected", "selected");
               }
            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
              //$('.fadeMe').hide();

            }

        });
      }
      else {
        $('#filterinvoicedata').html('');
      }
     }

   </script>

   <!-- End Get Invoice Info -->



  <!--  Get Invoice Info By Phone-->
   <script type="text/javascript">
     function fnphwisesearhinvoice(phone)
     {

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fngetphonewisrhinv')?>',
            data: {phone:phone},
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("Before phone--"+phone);

            },
            success: function(data) {

              if(data!="")
              {

                 $('#filterinvoicedata').html(data);
                 $('.fadeMe').hide();


                  var lstrcd=$(".table tr:nth-last-child(1) td").next().html();
                  //alert("load--"+lstrcd);
                  fngetinvoicedetails(lstrcd);
                  //Console.log("fngetinvoicedetails 6");


              }else{

                $('#filterinvoicedata').html('<tr><td colspan="18">No Invoice Found..!</td></tr>');
                $('.fadeMe').hide();
                // $('#pckitems').html('');
                 $('#items').css('display','none');
               }
            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
              //$('.fadeMe').hide();

            }

        });
     }

   </script>

   <!-- End Get Invoice Info By Phone-->


  <!--  <script type="text/javascript">

      $(window).on('load',function()
        {
           var lstrcd=$(".table tr:nth-last-child(1) td").next().html();
           //alert("load--"+lstrcd);
           fngetinvoicedetails(lstrcd);
        });

   </script> -->


 <!--   <script type="text/javascript">
     function uniKeyCode(event,invoiceid) {
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

          $('#invoice_date'+invoiceid).val(today);

          fnupdateinvoiceinfo(today,invoiceid,'invoice_date');

      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          $('#invoice_date'+invoiceid).val(today);

          fnupdateinvoiceinfo(today,invoiceid,'invoice_date');


      }

    }

   </script> -->


   <!-- <script type="text/javascript">
     function dueuniKeyCode(event,invoiceid) {
      var key = event.keyCode;
      //alert("key--"+key+" invoiceid--"+invoiceid);

      if(key=="107" || key=="187")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;

         // alert("plus today--"+today);

          $('#invoice_due_date'+invoiceid).val(today);

          fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;

          //alert("minus today--"+today);

          $('#invoice_due_date'+invoiceid).val(today);

          fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');


      }else if(key=="68")
       {

          var today = new Date();
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;

          //alert("press d--"+today);

          $('#invoice_due_date'+invoiceid).val(today);

          fnupdateinvoiceinfo(today,invoiceid,'invoice_due_date');
       }

    }

   </script> -->

<!--  Create Items -->
<script type="text/javascript">
function fncrpitem(itmId)
{

      var pckId= $('#itemPackageName option:selected').val();
      var invId=$('#invId').val();
      var custnm=localStorage.getItem("pckId");
      // var custnm=$('#custnm option:selected').val();

      //alert("custnm--"+custnm+" invId--"+invId+" pckId--"+pckId);

        event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crpitem')?>',
            data: {pckId:pckId,invId:invId,custnm:custnm},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

              //alert("data---"+data);

                if(data=="success")
                {

                  // window.location.href=location.href;
                   fnsearhinvoice(custnm);

                   //console.log("fnsearhinvoice 1");
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
 function fndelpitem(itmId,invId)
 {

        //var pckId= $('#itemPackageName').val();
        //alert("itmId--"+itmId+" pckId--"+pckId);
        var custId= localStorage.getItem("pckId");
        // var custId= $('#custnm option:selected').val();


        event.preventDefault();
        var r = confirm("Do you want delete this item..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delpitem')?>',
                  data: {itmId:itmId,custId:custId,invId:invId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                      //alert("itmId--"+itmId+" custId--"+custId+" invId--"+invId);
                  },
                  success: function(data) {
                     //alert("data---"+data);

                      if(data=="success")
                      {

                           window.location.href='<?=site_url('fi_home/custinvoices')?>';
                           fnsearhinvoice(custId);
                          // console.log("fnsearhinvoice 2");
                            $('.fadeMe').hide();
                      }else if(data=="error"){

                          $('.fadeMe').hide();
                          //alert("Something went wrong..!");
                      }
                  },
                  error: function(xhr) { // if error occured

                  },
                  complete: function() {
                 }

              });
          }

}
</script>
<!-- End Delete Items -->


<!--  Update Items -->
   <script type="text/javascript">
     function fnupdateitmsinfo(inptxtval,itemsid,fieldnm)
     {

        var pckId= $('#itemPackageName').val();

       event.preventDefault();

       //alert("itemsid--"+itemsid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtitems')?>',
            data: {itemsid:itemsid,inptxtval:inptxtval,fieldnm:fieldnm},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

                //alert("data---"+data);


                if(data=="success")
                {
                    $('.fadeMe').hide();

                     fngetsinglepckinfo
                     (pckId);

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

<!-- End Update Items -->


<!--  Update amount,due amt,paid  -->
  <script type="text/javascript">
   function fnupdateamount(pcktot,invId,pckId)
     {
       // alert(pcktot+","+invId+","+pckId);
       // console.log(pcktot+","+invId+","+pckId);
       var cid= pckId;
       // var cid= localStorage.getItem("pckId");

       // event.preventDefault();

       if(invId==undefined)
       {//alert("t");
          var invId=$('#invId').val();
       }


        $.ajax({
            type: 'POST',
            url: '<?//=site_url('fi_home/updinvamt')?>',
            data: {pcktot:pcktot,invId:invId,pckId:pckId},
            dataType: 'text',
            beforeSend: function() {

                $('.fadeMe').show();

            },
            success: function(data) {

                if(data=="success")
                {
                    $('.fadeMe').hide();


                     fngetinvoicedetails(invId);
                     //Console.log("fngetinvoicedetails 7");

                     fnsearhinvoice(cid);
                     //console.log("fnsearhinvoice 3");

                  var lstrcd=$(".table tr:nth-last-child(1) td").next().html();


                }else if(data=="error"){

                    $('.fadeMe').hide();

                }



            },
            error: function(xhr) {

            },
            complete: function() {



            }

        });
     }

   </script>

<!-- End Update amount -->


<!--  Set items data  -->
<script type="text/javascript">
  function fnadmpckinfo(admpckId,txtinpid,invId)
  {
    //alert("admpckId--"+admpckId+" txtinpid--"+txtinpid);

    var pckId=$('#itemPackageName').val();

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

            fnupdatepckdtls(admpckId,myobj.item_price,myobj.item_desc,txtinpid,pckId,invId);

          }
      });
  }
</script>

<!--  End Set items data  -->


<!--  Update amount,due amt,paid  -->
  <script type="text/javascript">
   function fnupdatepckdtls(admpckId, item_price, item_desc, txtinpid, pckId, invId)
     {

      var custnm=localStorage.getItem("pckId");
      var qty  = $('.take_my_data').val();
      // var custnm=$('#custnm option:selected').val();

       event.preventDefault();

       //alert("pcktot--"+pcktot+" invId--"+invId);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updpckinfo')?>',
            data: {admpckId:admpckId,item_price:item_price,item_desc:item_desc,txtinpid:txtinpid,pckId:pckId, qty:qty},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

                //alert("data---"+data);

                //var custid= $('#custnm option:selected').val();
                if(data=="success")
                {



                    //$("#loaditms").load(location.href + " #loaditms");

                    window.location.href='<?=site_url('fi_home/custinvoices')?>';
                    fnsearhinvoice(custnm);
                    //console.log("fnsearhinvoice 4");

                    // fngetinvoicedetails(invId,'items',custnm);


                     $('.fadeMe').hide();

                   //fngetsinglepckinfo(pckId);

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

             // fnsearhinvoice(custnm);

            }

        });
     }

   </script>

<!-- End Update amount -->


<script type="text/javascript">
  function fnupdateitemdescp(itemdesc,txtinpid)
  {
    //alert("itemdesc--"+itemdesc+" txtinpid--"+txtinpid);


         event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/upditemdesc')?>',
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

  function fnupdateitemamountp(itemamt,txtinpid) {


    //alert("itemamt--"+itemamt+" txtinpid--"+txtinpid);


         event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/upditemamt')?>',
            data: {itemamt:itemamt,txtinpid:txtinpid},
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
  function fnupdateitemdescount(itemdescnt,txtinpid)
  {
    //alert("itemdescnt--"+itemdescnt+" txtinpid--"+txtinpid);
         event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/upditemdescount')?>',
            data: {itemdescnt:itemdescnt,txtinpid:txtinpid},
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




<!--  Set items data if package not selected -->
<script type="text/javascript">
  function fniteminfo(itemId) {
    $('.focus3').focus();

    console.log("fniteminfojson 1");

    var invId         = $('#invId').val();
    var take_my_data  = $('.take_my_data').val();
    var itemId        = $('.item_quantity_select').val();

  console.log(itemId);
    if(itemId == undefined){
       var itemId  = $('.item_quantity_select2').val();
    }

    console.log(itemId);
    var custnm        = localStorage.getItem("pckId");
    // var custnm= $('#custnm option:selected').val();

    //alert("itemId--"+itemId+" invId--"+invId+" custnm--"+custnm);

     $.ajax({
        type: "POST",
        url: "<?=site_url('fi_home/fniteminfojson')?>",
        data:'itemId='+itemId,
        dataType: "json",
        success: function(data)
          {
            var myobj=data.itemlist;
            $("#i4").val(myobj.item_price);
            $("#i3").val(myobj.item_desc);

            var data = fnadditems(custnm, invId, itemId, myobj.item_price, myobj.item_desc, take_my_data);
            console.log(data);
            $('.focus3').focus();

            //fnupdatepckdtls(admpckId,myobj.item_price,myobj.item_desc,txtinpid,pckId);

          }
      });
  }
</script>

<!--  End Set items data if package not selected -->

<script type="text/javascript">
function fnadditems(custId, invId, itemId, itemprice, itemdesc, take_my_data)
{
      //alert(custId+"--"+invId+"--"+itemId+"--"+itemprice+"--"+itemdesc);

      // var take_my_data  = $('.take_my_data').val();
     // var take_my_data  = $('.total_focus_me').val();

      console.log("fniteminfojson 2");

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnadditemsinfo')?>',
            data: {custId:custId,invId:invId,itemId:itemId,itemprice:itemprice,itemdesc:itemdesc, take_my_data:take_my_data},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

             // alert("data--"+data);

              if(data=="success")
                {
                  localStorage.setItem("sess_invid", invId);
                   fnsearhinvoice(custId);
                    //$('.fadeMe').hide();

                  $('.focus3').focus();


                }else if(data=="error"){
                   //$('.fadeMe').hide();
                }

            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
             // $('.fadeMe').hide();
            $('.focus3').focus();
            }

        });

         //   $('.total_focus_me_1191').focus();

}
</script>



<!--  Set items data if package not selected -->
<script type="text/javascript">
  function fnupdateiteminfo(itemId, invId, rowid)
  {

    //var invId= $('#invId').val();
    var custnm= localStorage.getItem("pckId");
    // var custnm= $('#custnm option:selected').val();

    //alert("itemId--"+itemId+" invId--"+invId+" custnm--"+custnm+" rowid--"+rowid);

     $.ajax({
        type: "POST",
        url: "<?=site_url('fi_home/fniteminfojson')?>",
        data:'itemId='+itemId,
        dataType: "json",
        success: function(data)
          {
            var myobj=data.itemlist;
           // $("#i4").val(myobj.item_price);
           // $("#i3").val(myobj.item_desc);

            fnupdatesitems(custnm,invId,itemId,myobj.item_price,myobj.item_desc,rowid);

            //fnupdatepckdtls(admpckId,myobj.item_price,myobj.item_desc,txtinpid,pckId);

          }
      });
  }
</script>

<!--  End Set items data if package not selected -->

<script type="text/javascript">
function fnupdatesitems(custId,invId,itemId,itemprice,itemdesc,rowid)
{
      //alert(custId+"--"+invId+"--"+itemId+"--"+itemprice+"--"+itemdesc+" rowid--"+rowid);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnupdateitemsinfo')?>',
            data: {custId:custId,invId:invId,itemId:itemId,itemprice:itemprice,itemdesc:itemdesc,rowid:rowid},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {//alert("data--"+data);

                if(data=="success")
                {
                   //fngetinvoicedetails(invoiceid);
                   fnsearhinvoice(custId);
                    $('.fadeMe').hide();
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
$(document).ready(function()
  {

      var pckId= localStorage.getItem("pckId");
      // alert("localStorage pckId--"+pckId);
      if(pckId=='null' || pckId=="" || pckId=='N')
      {
        // alert("if");
          var pckId = 'N';
          // var pckId = $('#custnm option:selected').val();
          localStorage.setItem("pckId", pckId);
           // alert("pckId55--"+pckId);
           fnsearhinvoice(pckId);
      }else{
           // alert("pckId44--"+pckId);

          fnsearhinvoice(pckId);
      }


 });
</script>


<!--  Delete Assigned Package -->
<script type="text/javascript">

  function fndelassignpackge(itmId,pckprice,invoiceId) {

    var pckId = $('#itemPackageName').val();
    //alert("itmId--"+itmId+" pckId--"+pckId);
    var cid = localStorage.getItem("pckId");

    event.preventDefault();

    var r = confirm("Do you want delete this package..?");
    
    if(r == true) {


      $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/delassignpackge')?>',
        data: {itmId:itmId, pckprice: pckprice, invoiceId: invoiceId, custId:cid},
        dataType: 'text',
        beforeSend: function() {
                      
          // setting a timeout
          $('.fadeMe').show();
        },
        success: function(data) { 

          //alert("data---"+data);

          if(data == "success") {

            //fngetsinglepckinfo(pckId);
            fngetinvoicedetails(invoiceId);
            //console.log("fngetinvoicedetails 8");
            fnsearhinvoice(cid);
            //window.location.href=location.href;
            $('.fadeMe').hide();

          }
          else if(data == "error") {

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

<!-- End Delete Assigned Package -->


<!--  insert Invoice Notes -->
<script type="text/javascript">

var dtt = '';

$(document).ready(function(){
  $("body").on("input[name='note_notes']", "keydown",function(){
    dtt = $(this).parent("td").prev("td").val();
    //alert(dtt);
  });
});


  function fninsertnote(inptxtval, invoiceid, fieldnm) {

    var todays          = new Date();
    var currenthours    =  todays.getHours();
    var currentminutes  =  todays.getMinutes();
    //var timenotes     = currenthours+":"+currentminutes;
    var timenotes       = $(".cust_inv_note_tim_sta").val();


    function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime; 
}

if(timenotes == ''){
  var timenotes = formatAMPM(new Date);
}


    // alert(timenotes);
    console.log(timenotes);

    event.preventDefault();
    //alert("I invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);
    
    if(fieldnm == 'date') {
      
      // var arr = inptxtval.split("-");
      // var first2 = arr[0].slice(0,2);
      // var last2 = arr[0].slice(-2);
      // if(first2 == '00')
      // {
      //     today = '20'+last2 + '-' + arr[1] + '-' + arr[2];

      //     inptxtval = today;

      // }

      var arr   = inptxtval.split("/");
      today     = arr[2] + '-' + arr[0] + '-' + arr[1];
      //alert(today);
      inptxtval = today;

      $.ajax({
        type : 'POST',
        url : '<?=site_url('fi_home/insertinvnotes')?>', 
        data : {invoiceid:invoiceid, inptxtval:inptxtval, fieldnm:fieldnm, timenotes:timenotes},
        dataType : 'html',
        // cache : false,
        //  async : false,
        beforeSend : function() {
                // setting a timeout
                $('.fadeMe').show();
               //alert("before invoiceid--"+invoiceid);
            },
            success: function(data) {

                // alert("data---"+data);

                 // $("#dispinvnotes").html(data);
                  //$('.fadeMe').hide();

                  var custid= localStorage.getItem("pckId");
                  // var custid= $('#custnm option:selected').val();

                     if(data=="success")
                     {
                       fngetinvoicedetails(invoiceid,'notes',custid);
                       //Console.log("fngetinvoicedetails 9");

                       $('.fadeMe').hide();
                     }else{
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
    else {
      
      // $(".dddd").val('2019-09-26')
      //   var fieldnm = $(".dddd").val();
      $.ajax({
        type : 'POST',
        url : '<?=site_url('fi_home/insertinvnotes')?>',
        data : { invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm,timenotes:timenotes},
        dataType : 'html',
        // cache: false,
        //  async: false,
        beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
               //alert("before invoiceid--"+invoiceid);
            },
            success: function(data) {

                //alert("data---"+data);

                  //$("#dispinvnotes").html(data);
                  //$('.fadeMe').hide();
                   var custid= localStorage.getItem("pckId");
                   // var custid= $('#custnm option:selected').val();

                    if(data=="success")
                     {
                       fngetinvoicedetails(invoiceid,'notes',custid);
                       //console.log("fngetinvoicedetails 10");


                       $('.fadeMe').hide();
                     }else{
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
<!-- End insert Invoice Notes -->


<!--  update Invoice Notes -->
<script type="text/javascript">
function fnupdatenote(inptxtval,invoiceid,fieldnm,noteid)
{
var my = noteid
  var my_Time = $('.cust_inv_note_tim'+my).val();
                            var my_Time_count = my_Time.toString().length;
                            var arr = ["00", "00"];
                            if(my_Time_count == 4) {
                              if(my_Time > 0 && my_Time < 1300) {
                                arr = my_Time.match(/.{1,2}/g);
                                var res = arr[0]+":"+arr[1]+" PM";
                               var timenotes = res;
                               $('.cust_inv_note_tim'+my).val(res);

                              /* $.ajax({
                              type: 'POST',
                              url: '<?=site_url('fi_home/time_update')?>',
                              data: {timenotes:timenotes, noteid:noteid},
                              dataType: 'text',
                              success: function(data) {
                              }
                            });

                               console.log(timenotes);*/

                            }
                            else {
                              var num = my_Time - 1200;
                              my_Time = num.toString();
                              var my_Time_count = my_Time.toString().length;
                              if(my_Time_count == 3){
                                my_Time = '0'.concat(my_Time); 
                              }
                              if(my_Time > 0 && my_Time < 1300){
                                arr = my_Time.match(/.{1,2}/g);
                                var res = arr[0]+":"+arr[1]+" PM";
                               // var timenotes = 
                                $('.cust_inv_note_tim'+my).val(res);

                             /*   $.ajax({
                              type: 'POST',
                              url: '<?=site_url('fi_home/time_update')?>',
                              data: {timenotes:timenotes, noteid:noteid},
                              dataType: 'text',
                              success: function(data) {
                              }
                            });

                                console.log(timenotes);*/

                                 var timenotes = res;
                                 var timenotes = formatAMPM(new Date);

                              }
                              else {
                                alert("Time is not correct");
                                var timenotes = formatAMPM(new Date);
                              }
                            }
                          }
                         else if(my_Time_count > 4){

                             // alert("Value should be 4 digit");
                             var timenotes = formatAMPM(new Date);
                            }
                            else if(my_Time_count > 0){
                              alert("Value should be 4 digit");
                              var timenotes = formatAMPM(new Date);
                            }





function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime; 
}







  // var custpayamt= parseFloat($('#custpayamt').val());
             //event.preventDefault();

             var todays = new Date();
             var currenthours=  todays.getHours();
             var currentminutes=  todays.getMinutes();

             //var timenotes= currenthours+":"+currentminutes;
             //var timenotes       = $(".cust_inv_note_tim"+noteid).val();
             console.log(1);
             console.log(timenotes);

                $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updateinvnotes')?>',
                data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm,noteid:noteid,timenotes:timenotes},
                dataType: 'text',
              // cache: false,
              //  async: false,
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                   //alert("before invoiceid--"+invoiceid+"inptxtval--"+inptxtval);
                },
                success: function(data) {

                    //alert("data---"+data);

                   // $("#dispinvnotes").html(data);

                  var custid= localStorage.getItem("pckId");
                  // var custid= $('#custnm option:selected').val();

                   if(data=="success")
                   {
                     //fngetinvoicedetails(invoiceid,'notes',custid);
                     $('.fadeMe').hide();
                   }else{
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

<!-- End update Invoice Notes -->


<script>
$(document).ready(function(){
    $("body").on("keydown", "#notedate, .notedate", function(event){
        //alert('123');

        var key = event.keyCode;
        //alert("key--"+key);

        var invoiceid= $(this).parents(".tr_clone").find(".txthdninvId").val();
        var noteid= $(this).parents(".tr_clone").find(".txthdnoteId").val();
        var temp_edate= $(this).parents(".tr_clone").find(".notedate");
        var temp_etime= $(this).parents(".tr_clone").find(".notetime");


        if(key=="107" || key=="187")
        {
            //alert("date+");

            var dtpls;
            if(temp_edate.val()=="")
            {
                dtpls= new Date();
            }else{
                dtpls= new Date(temp_edate.val());
            }

            dtpls.setDate( dtpls.getDate() + 1 );
            var mm = dtpls.getMonth() + 1;
            if(mm <10)
            {
                mm = "0"+mm;
            }

            var dd =  dtpls.getDate();
            if(dd <10)
            {
                dd = "0"+dd;
            }


            var yyyy =  dtpls.getFullYear();
            var today = mm + '/' + dd + '/' +  yyyy;

            // alert("plus today--"+today);
            temp_edate.val(today);
            event.preventDefault();

        }
        else if(key=="109" || key=="189")
        {
            //alert("date-");

            var dtmns;
            if(temp_edate.val()=="")
            {
                dtmns= new Date();
            }else{
                dtmns= new Date(temp_edate.val());
            }

            dtmns.setDate( dtmns.getDate() - 1 );
            var mm = dtmns.getMonth() + 1;
            if(mm <10)
            {
                mm = "0"+mm;
            }

            var dd =  dtmns.getDate();
            if(dd <10)
            {
                dd = "0"+dd;
            }

            var yyyy =  dtmns.getFullYear();
            var today = mm + '/' + dd + '/' +  yyyy;

            temp_edate.val(today);

            event.preventDefault();
        }
        else if(key=="68")
        {
            today = '<?php echo date("m/d/Y"); ?>';
            // alert("today--"+today);
            // var today = today;
            var todays = new Date();
            var currenthours=  todays.getHours();
            var currentminutes=  todays.getMinutes();


            temp_edate.val(today);
            temp_etime.val(currenthours+":"+currentminutes);

            event.preventDefault();
        }
        else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
    $("body").on("keydown", ".invdt_ar", function(event)
    {

        var key = event.keyCode;
        var temp_edate =  $(this).parents(".tr_clone").find(".invdt_ar");

        if(key=="107" || key=="187")
        {
            //alert("date+");
            var dtpls;
            if(temp_edate.val()=="")
            {
                dtpls= new Date();
            }
            else
            {
                dtpls= new Date(temp_edate.val());
            }

            dtpls.setDate( dtpls.getDate() + 1 );
            var mm = dtpls.getMonth() + 1;
            if(mm <10)
            {
                mm = "0"+mm;
            }

            var dd =  dtpls.getDate();
            if(dd <10)
            {
                 dd = "0"+dd;
            }


            var yyyy =  dtpls.getFullYear();
            var today = mm + '/' + dd + '/' +  yyyy;
            var today1 = yyyy + '/' + mm + '/' +  dd;


            temp_edate.val(today);


            event.preventDefault();
        }
        else if(key=="109" || key=="189")
        {
            //alert("date-");
            var dtmns;
            if(temp_edate.val()=="")
            {
                dtmns= new Date();
            }else{
                dtmns= new Date(temp_edate.val());
            }

            dtmns.setDate( dtmns.getDate() - 1 );
            var mm = dtmns.getMonth() + 1;
            if(mm <10)
            {
                mm = "0"+mm;
            }

            var dd =  dtmns.getDate();
            if(dd <10)
            {
                dd = "0"+dd;
            }

            var yyyy =  dtmns.getFullYear();
            var today = mm + '/' + dd + '/' +  yyyy;
            var today1 = yyyy + '/' + mm + '/' +  dd;

            //alert("minus today--"+today);
            //$('#edate').val(today);
            temp_edate.val(today);

            event.preventDefault();

        }
        else if(key=="68")
        {
            today = '<?php echo date("m/d/Y"); ?>';
            temp_edate.val(today);
            event.preventDefault();
        }
        else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
    $("body").on("keydown", ".invdt_ar1", function(event)
    {

        var key = event.keyCode;
        var temp_edate =  $(this).parents(".tr_clone").find(".invdt_ar1");

        if(key=="107" || key=="187")
        {
            //alert("date+");
            var dtpls;
            if(temp_edate.val()=="")
            {
                dtpls= new Date();
            }
            else
            {
                dtpls= new Date(temp_edate.val());
            }

            dtpls.setDate( dtpls.getDate() + 1 );
            var mm = dtpls.getMonth() + 1;
            if(mm <10)
            {
                mm = "0"+mm;
            }

            var dd =  dtpls.getDate();
            if(dd <10)
            {
                 dd = "0"+dd;
            }


            var yyyy =  dtpls.getFullYear();
            var today = mm + '/' + dd + '/' +  yyyy;
            var today1 = yyyy + '/' + mm + '/' +  dd;


            temp_edate.val(today);


            event.preventDefault();
        }
        else if(key=="109" || key=="189")
        {
            //alert("date-");
            var dtmns;
            if(temp_edate.val()=="")
            {
                dtmns= new Date();
            }else{
                dtmns= new Date(temp_edate.val());
            }

            dtmns.setDate( dtmns.getDate() - 1 );
            var mm = dtmns.getMonth() + 1;
            if(mm <10)
            {
                mm = "0"+mm;
            }

            var dd =  dtmns.getDate();
            if(dd <10)
            {
                dd = "0"+dd;
            }

            var yyyy =  dtmns.getFullYear();
            var today = mm + '/' + dd + '/' +  yyyy;
            var today1 = yyyy + '/' + mm + '/' +  dd;

            //alert("minus today--"+today);
            //$('#edate').val(today);
            temp_edate.val(today);

            event.preventDefault();

        }
        else if(key=="68")
        {
            today = '<?php echo date("m/d/Y"); ?>';
            temp_edate.val(today);
            event.preventDefault();
        }
        else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
  function fndelinvnote(delId,invoiceid)
  {
      //alert("delId--"+delId);

       event.preventDefault();

       var r = confirm("Do you want delete this note..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delinvnote')?>',
                  data: {delId:delId,invoiceid:invoiceid},
                  dataType: 'text',
                // cache: false,
                //  async: false,
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                      //alert("data---"+data);

                      //$("#dispinvnotes").html(data);
                     // $('.fadeMe').hide();

                   var custid= localStorage.getItem("pckId");
                   // var custid= $('#custnm option:selected').val();
                    if(data=="success")
                      {

                          fngetinvoicedetails(invoiceid,'notes',custid);
                          Console.log("fngetinvoicedetails 11");

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

<script type="text/javascript">

  $(document).ready(function() {

    $("body").on("click", "#chkpickupreq, .chkpickupreq", function(event) {

      var hdnpreqid=  $(this).parents(".tr_clone").find(".hdnpreqid").val();
      var invoiceid=  $(this).parents(".tr_clone").find(".invoiceid").val();

      $.ajax({
        type      : 'POST',
        url       : '<?=site_url('fi_home/fnpickupreq_info')?>',
        data      : {hdnpreqid:hdnpreqid},
        dataType  : 'text',
        beforeSend: function() {
          $('.fadeMe').show();
        },
        success: function(data) {

          var custid = localStorage.getItem("pckId");
          if(data == "success") {

            fngetinvoicedetails(invoiceid,'pickup',custid);
            Console.log("fngetinvoicedetails 12");

            $('.fadeMe').hide();
          }
          else if(data=="error") {

            $('.fadeMe').hide();
          }
        },
        error: function(xhr) { 
        },
        complete: function() {
        }
      });
    });
  });
</script>

<script type="text/javascript">
 $(document).ready(function(){
 $("body").on("change", "#pickup_quantity, .pickup_quantity", function(event){

    var qty=$(this).val();
    var total_qty=$(this).parent("td").find("#total_qty").val();
    var total_prv_qty=$(this).parent("td").find("#total_prv_qty").val();
    // alert("total_qty :"+total_qty);
    //var temp_chkpickupreq =  $(this).parents(".tr_clone").find(".chkpickupreq");
    var hdnpreqid=  $(this).parents(".tr_clone").find(".hdnpreqid").val();
    var invoiceid=  $(this).parents(".tr_clone").find(".invoiceid").val();
    // var qty=  $(this).parents(".pickup_quantity").find(".invoiceid").val();

    // alert("qty "+qty);
    // alert("hdnpreqid "+hdnpreqid);
    if (total_qty >= qty) {


               $.ajax({
               type: 'POST',
               url: '<?=site_url('fi_home/fnpickupreq_info_update')?>',
               data: {hdnpreqid:hdnpreqid,qty:qty},
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                //alert("hdnpreqid--"+hdnpreqid+" invoiceid--"+invoiceid);

                },
                success: function(data) {
                  // alert("data--"+data);
                  // console.log(data);
                  //$('#divtextresp').html(data);

                   var custid= localStorage.getItem("pckId");
                   // var custid= $('#custnm option:selected').val();
                   // console.log(data);
                    // if(data!="")
                    // if(data!="")
                    if(data=="success")
                    {

                      //$('#pickup').load(location.href + ' #pickup>*','');
                      //$('#pickup').load(location.href + ' #pickup');

                      fngetinvoicedetails(invoiceid,'pickup',custid);
                      Console.log("fngetinvoicedetails 13");

                     /* $('#divloadinvtabs .tab-pane').removeClass('active');
                      $('#pickup').addClass('active');*/
                      $('.fadeMe').hide();


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
          else {
            alert("Please enter valied package item quantity...!");

            $(this).val(total_prv_qty);
          }

    });

});
</script>


<script type="text/javascript">
 $(document).ready(function(){
 $("body").on("change", "#pickup_quantity, .pickup_quantity", function(event){

    //var cus_names=$('#cus_names').val();
    var pckqty =  $(this).val(); //$(this).parents(".tr_clone").find(".pickup_quantity").val();
    var hdnpreqid=  $(this).parents(".tr_clone").find(".hdnpreqid").val();
    var invoiceid=  $(this).parents(".tr_clone").find(".invoiceid").val();
    var hdnpreqpid=  $(this).parents(".tr_clone").find(".hdnpreqpid").val();



               $.ajax({
               type: 'POST',
               url: '<?=site_url('fi_home/fnupreqtqy_info')?>',
               data: {hdnpreqid:hdnpreqid,pckqty:pckqty,hdnpreqpid:hdnpreqpid},
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                 //alert("hdnpreqid--"+hdnpreqid+" pckqty--"+pckqty+" invoiceid--"+invoiceid);
                },
                success: function(data) {//alert("data--"+data);
                  //$('#divtextresp').html(data);
                   var custid= localStorage.getItem("pckId");
                   // var custid= $('#custnm option:selected').val();
                    if(data=="success")
                    {
                      fngetinvoicedetails(invoiceid,'pickup',custid);
                      Console.log("fngetinvoicedetails 14");

                      $('.fadeMe').hide();
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

    });

});
</script>



<script type="text/javascript">

  function fnupdatepickpedinfo(inptxtval,pid,fieldnm,invoiceid,pckrcid)
  {
       event.preventDefault();


       //alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

       if(fieldnm=="pickup_date")
       {
           var arr = inptxtval.split("/");
           inptxtval = arr[2]+"-"+arr[0]+"-"+arr[1];
       }

       //alert(inptxtval);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtpickupinfo')?>',
            data: {pid:pid,inptxtval:inptxtval,fieldnm:fieldnm,pckrcid:pckrcid},
            dataType: 'text',
          // cache: false,
          //  async: false,
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

                //alert("data---"+data);
              var custid= localStorage.getItem("pckId");
              // var custid= $('#custnm option:selected').val();
                if(data=="success")
                {
                    $('.fadeMe').hide();

                    fngetinvoicedetails(invoiceid,'pickup',custid);
                    Console.log("fngetinvoicedetails 15");

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

<script>
/* ------------------------ commented by akshay

$(document).ready(function(){
$("body").on("keydown", "#pickupdate, .pickupdate", function(event){
  //alert('123');

   var key = event.keyCode;
  // alert("key--"+key);

    var invoiceid= $(this).parents(".tr_clone").find(".pickupinvid").val();
    var pid= $(this).parents(".tr_clone").find(".pickupdid").val();



    if(key=="107" || key=="187")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);
          //alert("noteid--"+noteid);
                 if(pid=="" || pid==undefined)
                 {
                    //fninsertnote(today,invoiceid,'date');
                    fnupdatepickpedinfo(today,pid,'pickup_date',invoiceid);
                 }else{
                    fnupdatepickpedinfo(today,pid,'pickup_date',invoiceid);
                 }



      }else if(key=="109" || key=="189"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;

          //fnupdatenote(today,invoiceid,'date',noteid);

           //alert("noteid--"+noteid);
                 if(pid=="" || pid==undefined)
                 {
                    fnupdatepickpedinfo(today,pid,'pickup_date',invoiceid);
                 }else{
                    fnupdatepickpedinfo(today,pid,'pickup_date',invoiceid);
                 }

      }else if(key=="68")
             {

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;

                //fnupdatenote(today,invoiceid,'date',noteid);

                 //alert("noteid--"+noteid+" invoiceid--"+invoiceid);
                 if(pid=="" || pid==undefined)
                 {
                    fnupdatepickpedinfo(today,pid,'pickup_date',invoiceid);
                 }else{
                    fnupdatepickpedinfo(today,pid,'pickup_date',invoiceid);
                 }

             }

    });

});

*/
</script>


<!--  Update package amount  -->
<script type="text/javascript">
function fnupdatepckgeamount(pcktot,invId,pckId,tbid,pckdestyp,pckdesamt)
{

      event.preventDefault();
    /*  var gt = 0;
        $(".totsum").each(function(){
          gt += Number($(this).val());
        });*/

       var custId= localStorage.getItem("pckId");
       // var custId= $('#custnm option:selected').val();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updinvpckgamt')?>',
            data: {pcktot:pcktot,invId:invId,pckId:pckId,tbid:tbid,custId:custId,pckdestyp:pckdestyp,pckdesamt:pckdesamt},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

                if(data=="success")
                {
                    $('.fadeMe').hide();

                     fnsearhinvoice(custId);
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

<!-- End Update package amount -->

<!--  Update Invoice Event Type-->
   <script type="text/javascript">
     function fnupdateinvoicetypeinfo(inptxtval,invoiceid,fieldnm)
     {

       event.preventDefault();

       //alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtinvevnttype')?>',
            data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

               var custid= localStorage.getItem("pckId");
               // var custid= $('#custnm option:selected').val();

                if(data=="success")
                {
                    $('.fadeMe').hide();

                    fngetinvoicedetails(invoiceid,'items',custid);
                    Console.log("fngetinvoicedetails 16");

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

<!-- End Update Invoice Event Type -->


<script type="text/javascript">
function loadinvtopinfo(invoiceid,custid)
 {
   // alert("invoiceid--"+invoiceid+" custid--"+custid);
        $.ajax({
        type: "POST",
        url: "<?=base_url('Fi_home/getSearchInvInfo'); ?>",
        data: {invoiceid:invoiceid,custid:custid},
        dataType: 'html',
        beforeSend: function() {
          
        },
        success: function(data)
        {
          if(data!="")
          {

           $('.loaduppertabcntdtls').html(data);
           $('#dispinvnotes tr:nth-last-child(2)').find("input[name='note_invchk']").focus();


           

         }else{

           $('.loaduppertabcntdtls').html(data);
         }
       }
    });
}
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.txttermstype',function(){

    var temp_txttermstype= $(this).parents('.tr_clone').find('.txttermstype').val();
    var temp_txttermstypId= $(this).parents('.tr_clone').find('.txttermstype option:selected').text();
    var temp_txtamount= $(this).parents('.tr_clone').find('.txttotamount');// txtamount
    var temp_trmsubtot= $(this).parents('.tr_clone').find('.trmsubtot').val();
    var temp_crntrmsid= $(this).parents('.tr_clone').find('.crntrmsid').val();
    var temp_trminvid= $(this).parents('.tr_clone').find('.trminvid').val();
    var temp_trmtypeid= $(this).parents('.tr_clone').find('.trmtypeid').val();

    //var temp_txttotamount= $(this).parents('.tr_clone').find('txttotamount');
    //alert("temp_trmsubtot--"+temp_trmsubtot);
        var termtot=0;
        $.ajax({
        type: "POST",
        url: "<?=base_url('fi_home/gettermsinfo'); ?>",
        data: {temp_txttermstype:temp_txttermstype,temp_txttermstypId:temp_txttermstypId},
        dataType: 'json',
        beforeSend: function() {
          //alert("temp_txttermstype--"+temp_txttermstype+" temp_txttermstypId--"+temp_txttermstypId);

          $('.fadeMe').show();
        },
        success: function(data)
        {
         

            var myobj=data.admtermsdata;
            temp_txtamount.val(myobj.amount);

            updateinvtermsinfo(temp_txttermstypId,myobj.amount,temp_crntrmsid,temp_trminvid,myobj.totsts);


            $('.fadeMe').hide();


           /* $('.txtamount').each(function(){
                var echamt=$(this).val();
                $(this).parents('td').next("td").find('.txttotamount').val(echamt);
               

              if(echamt!= 'Remaining Balance')
              // if(typeof echamt === 'number')
               //if(echamt.search(/[^0-9]/g) != -1)
                {
                  termtot+=Number(echamt);
                }
            });*/
     
     


          /*  if(temp_trmsubtot>termtot)
            {
               $('#dispterms tbody > tr:nth-child(1) > td:nth-child(2)').find('.txttotamount').val(temp_trmsubtot-termtot);
            }else{
                 $('#dispterms tbody > tr:nth-child(1) > td:nth-child(2)').find('.txttotamount').val("0");
            }*/



        }
     });

});
});
</script>

<script type="text/javascript">
function updateinvtermsinfo(trmtype,trmamt,trmid,invoiceid,totsts)
  {
        $.ajax({
        type: "POST",
        url: "<?=base_url('fi_home/updtinvtermsinfo'); ?>",
        data: {trmtype:trmtype,trmamt:trmamt,trmid:trmid,invoiceid:invoiceid,totsts:totsts},
        dataType: 'html',
        beforeSend: function() {
          $('.fadeMe').show();
          //alert("trmtype--"+trmtype+" trmamt--"+trmamt+" trmid--"+trmid+" invoiceid--"+invoiceid+" totsts--"+totsts);
        },
        success: function(data)
        {//alert("data---"+data);
             $("#dispterms").html(data);
             $('.fadeMe').hide();

        }
     });

  }
</script>


<!--  Create Terms -->
<script type="text/javascript">
function fncrterms(invtrmsId, invoiceid)
 {

      //var customrId= $('#custnm').val();
       // alert("invoiceid--"+invoiceid+" invtrmsId--"+invtrmsId);
        var trmtypeid = $('#trmtypeid').val();
        //alert("trmtypeid--"+trmtypeid);
        event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crnewinvterms')?>',
            data: {invoiceid:invoiceid,trmtypeid:trmtypeid},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

              //$("#dispterms").html(data);
               var custid = localStorage.getItem("pckId");
               // var custid= $('#custnm option:selected').val();
              if(data=="success")
              {
                fngetinvoicedetails(invoiceid,'terms',custid);
                Console.log("fngetinvoicedetails 17");

                $('.fadeMe').hide();
              }else{
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

<!--  Delete Terms -->
<script type="text/javascript">
 function fndelterms(invtrmsId,invoiceid)
   {
       event.preventDefault();
       //event.stopPropagation();
       var r = confirm("Do you want delete this terms..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/delterms')?>',
                  data: {invtrmsId:invtrmsId,invoiceid:invoiceid},
                  dataType: 'text', //text
                   beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {

                    //$("#dispterms").html(data);
                     var custid= localStorage.getItem("pckId");
                     // var custid= $('#custnm option:selected').val();
                    if(data=="success")
                    {
                        fngetinvoicedetails(invoiceid,'terms',custid);
                        Console.log("fngetinvoicedetails 18");

                        $('.fadeMe').hide();
                    }else{
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
<!-- End Delete Terms -->

<script type="text/javascript">
$(document).ready(function(){
$('body').on('keydown', '#filterinvoicedata input[type="text"]',function(e){

    //e.preventDefault();

    var custid= localStorage.getItem("pckId");
    // var custid= $('#custnm option:selected').val();

    var tdix = $(this).closest('td').index();
   //alert(tdix);
    var tdi=Number(tdix)+1;
    if (e.which === 40) {
      $(this).parents("tr").next("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
      $(this).parents("thead").next("thead").find("td:nth-child("+ tdi +")").find('.updwn').focus();

      var hdninvrowId= $(this).parents("tr").next("tr").find('#hdninvrowId').val(); //hdninvrowId
      //alert("hdninvrowId--"+hdninvrowId);

      fngetinvoicedetails(hdninvrowId,'items',custid);
      Console.log("fngetinvoicedetails 19");

      $('.tr_clone').removeClass('active-cust');
      $(this).parents("tr").next("tr").addClass('active-cust');

    }else if(e.which === 38)
    {
      //$(this).parents("tr").prev("tr").find('.num').focus();
       $(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
       $(this).parents("thead").prev("thead").find("td:nth-child("+ tdi +")").find('.updwn').focus();

       var hdninvrowId= $(this).parents("tr").prev("tr").find('#hdninvrowId').val(); //hdninvrowId
        //alert("hdninvrowId=="+hdninvrowId);
      fngetinvoicedetails(hdninvrowId,'items',custid);
      Console.log("fngetinvoicedetails 20");

       $('.tr_clone').removeClass('active-cust');
       $(this).parents("tr").prev("tr").addClass('active-cust');
    }
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('keydown', 'input[type="text"]',function(e){

    //e.preventDefault();
    var cus_names= $('#cus_names').val();
    var tdix = $(this).closest('td').index();

   //alert(tdix);
    var tdi=Number(tdix)+1;
    if (e.which === 40) {
      $(this).parents("tr").next("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();

    }else if(e.which === 38)
    {
      //$(this).parents("tr").prev("tr").find('.num').focus();
       $(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();

    }
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.txttotamount',function(){

  var temp_txttotamount=$(this).parents('.tr_clone').find('.txttotamount').val();
  var temp_crntrmsid=$(this).parents('.tr_clone').find('.crntrmsid').val();
  var invoiceid=$(this).parents('.tr_clone').find('.trminvid').val();
  //alert("temp_txttotamount--"+temp_txttotamount+" temp_crntrmsid--"+temp_crntrmsid+" invoiceid--"+invoiceid);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtermamt')?>',
            data: {temp_crntrmsid:temp_crntrmsid,temp_txttotamount:temp_txttotamount,invoiceid:invoiceid},
            dataType: 'text',
             beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
               //alert("before invoiceid--"+invoiceid);
            },
            success: function(data) {

             // $("#dispterms").html(data);
              var custid= localStorage.getItem("pckId");
              // var custid= $('#custnm option:selected').val();
              if(data="success")
              {
                fngetinvoicedetails(invoiceid,'terms',custid);
                Console.log("fngetinvoicedetails 21");

                $('.fadeMe').hide();
              }else{
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

});
});
</script>

 <script type="text/javascript">
   function fndeltasks(delId,invoiceid)
   {
      var r = confirm("Do you want delete this task..?");
       if(r == true)
         {
             $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndelinvtaskinfo')?>',
                  data: {delId:delId,invoiceid:invoiceid},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                  },
                  success: function(data) {//alert(data);

                     // $('#mytasks').html(data);
                     // $('.fadeMe').hide();

                   var custid= localStorage.getItem("pckId");
                   // var custid= $('#custnm option:selected').val();
                      if(data=="success")
                      {
                         fngetinvoicedetails(invoiceid,'terms',custid);
                         Console.log("fngetinvoicedetails 22");

                         $('.fadeMe').hide();
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


 <!--  Create Tasks -->
<script type="text/javascript">
 function fncrtasks(invoiceid)
   {

        //var customrId= $('#custnm').val();
        //alert("invoiceid--"+invoiceid+" customrId--"+customrId);
      //  event.preventDefault();

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crinvnwtask')?>',
            data: {invoiceid:invoiceid},
            dataType: 'html', //text
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("invoiceid--"+invoiceid);
            },
            success: function(data) {

               // $('#hdndivinvoicedtls').html(data);
               //var responce= $('#responce').val();
                 $('#mytasks').html(data);
                 $('.fadeMe').hide();

             /*  if(data=="success")
                {
                    $('.fadeMe').hide();

                }else if(data=="error"){
                    $('.fadeMe').hide();
                   //alert("Something went wrong..!");
                }*/
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

<!--  Update Task -->
<script type="text/javascript">
 function fnupdatetaksinfo(inptxtval,taksId,fieldnm)
  {
       //event.preventDefault();
       //alert("taksId--"+taksId+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

       /* var taskdate= $(this).parents('.tr_clone').find('.taskstrtdate').val();
        var taskname= $(this).parents('.tr_clone').find('.task_name option:selected').val();
        var subtaskId= $(this).parents('.tr_clone').find('.subtaskname option:selected').val();
        var taskduedate= $(this).parents('.tr_clone').find('#task_due_date').val();
        var invoiceid= $(this).parents('.tr_clone').find('.hdntskinvd').val();
        var hdntskid= $(this).parents('.tr_clone').find('.hdntskid').val();
        var user= $(this).parents('.tr_clone').find('#task_user option:selected').val();
        var tasksts = $(this).parents('.tr_clone').find('.taskcompleted option:selected').val();
        var taskcompletdby = $(this).parents('.tr_clone').find('.taskcompletedby').val();
        var taskcompletdt = $(this).parents('.tr_clone').find('.taskcompleteddate').val();
        var taskenterby = $(this).parents('.tr_clone').find('.taskenterby').val();

          data: {taksId:taksId,inptxtval:newdate,fieldnm:fieldnm,taskdate:taskdate,taskname:taskname,subtaskId:subtaskId,invoiceid:invoiceid,hdntskid:hdntskid,user:user,tasksts:tasksts,taskcompletdby:taskcompletdby,taskcompletdt:taskcompletdt,taskenterby:taskenterby,taskduedate:taskduedate},
*/

        var invoiceid = $('#filterinvoicedata .active-cust').find('.hdninvrowId').val();

        if(fieldnm=="task_date_started" || fieldnm=="task_due_date" || fieldnm=="task_completed_date")
        {

            //var arr = inptxtval.split("-");
            // var first2 = arr[0].slice(0,2);
            // var last2 = arr[0].slice(-2);
            // if(first2 == '00')
            // {
            //     today = '20'+last2 + '-' + arr[1] + '-' + arr[2];
            //     inptxtval = today;
            // }
            // newdate = inptxtval;
            var arr = inptxtval.split("/");
            newdate = arr[2]+"-"+arr[0]+"-"+arr[1];
            //alert(newdate);

            // Commented by akshay ----------------------------------------------


            //   var d= new Date(inptxtval);
            //   var fyer= d.getFullYear();
            //   var fmnth= String(d.getMonth() + 1).padStart(2, '0').slice(-2);
            //   var fdate= String(d.getDate()).padStart(2, '0').slice(-2);
            //   var trimmed = "20"+fyer+"-"+fmnth+"-"+fdate;

            //     var newdate= trimmed;  //'02/07/2019';
            //     var status =newdate;
            //     var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
            //     var chkvdate= dtRegex.test(status);
            //   if(chkvdate==true)
            //   {

            // -------------------------------------------------------------------




                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/updinvtask')?>',
                        data: {taksId:taksId,inptxtval:newdate,fieldnm:fieldnm},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("invoiceid--"+invoiceid);

                        },
                        success: function(data) {

                            //$('#mytasks').html(data);
                           // $('.fadeMe').hide();
                         var custid= localStorage.getItem("pckId");
                         // var custid= $('#custnm option:selected').val();
                           if(data=="success")
                            {
                                fngetinvoicedetails(invoiceid,'terms',custid);
                                Console.log("fngetinvoicedetails 23");

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

            // Commented by akshay ----------------------------------------------


            //   }
            //   else
            //   {
            //       alert("@222");
            //   }

            // -------------------------------------------------------------

        }else{

                $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updinvtask')?>',
                data: {taksId:taksId,inptxtval:inptxtval,fieldnm:fieldnm},
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {

                     //$('#mytasks').html(data);
                    // $('.fadeMe').hide();
                     var custid= localStorage.getItem("pckId");
                     // var custid= $('#custnm option:selected').val();
                    if(data=="success")
                    {
                        fngetinvoicedetails(invoiceid,'terms',custid);
                        Console.log("fngetinvoicedetails 24");
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
<!-- End Update Task -->

<script type="text/javascript">
function fnupdtadmintask(taksId,invoiceid)
 {
                $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updinvtaskinfo')?>',
                data: {taksId:taksId,invoiceid:invoiceid},
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                    //alert("taksId--"+taksId+" invoiceid--"+invoiceid);
                 },
                success: function(data) {
                     $('#mytasks').html(data);
                     $('.fadeMe').hide();
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
$(document).ready(function(){
$('body').on('change','.tasksname',function(){

     var taksId= $(this).parents('.tr_clone').find('.tasksname').val();
     var taskstrtdate= $(this).parents('.tr_clone').find('.taskstrtdate').val();
     var invoiceid= $(this).parents('.tr_clone').find('.hdntskinvd').val();
// alert("main :"+taksId);

                $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updinvtaskinfo')?>',
                data: {taksId:taksId,invoiceid:invoiceid,taskstrtdate:taskstrtdate},
                dataType: 'html',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();
                  //alert("taksId--"+taksId+" taskstrtdate--"+taskstrtdate+" invoiceid--"+invoiceid);
                 },
                success: function(data) {
                     $('#mytasks').html(data);
                     $('.fadeMe').hide();
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
function fnupdateinvterms(cntrctype,invoiceid)
{
          $.ajax({
          type: 'POST',
          url: '<?=site_url('fi_home/fnupdateinvtermsinfo')?>',
          data: {cntrctype:cntrctype,invoiceid:invoiceid},
          dataType: 'html',
          beforeSend: function() {
              // setting a timeout
              $('.fadeMe').show();
             //alert("cntrctype--"+cntrctype+" invoiceid--"+invoiceid);
           },
          success: function(data) {
               $('#dispterms').html(data);
               $('.fadeMe').hide();
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
$(document).ready(function(){
$('body').on('change','.lsttaskname',function(){

  var taskId= $(this).val();
  var lstsubtask= $(this).parents('.tr_clone').find('.lstsubtask');

        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/loadsubtaskslist')?>',
        data: {taskId:taskId},
        dataType: 'json',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("taskId--"+taskId);
         },
        success: function(data) {
          //alert("data--"+data);
          var appendata=data.subtasklist;
          lstsubtask.html('');
          lstsubtask.html('<option> </option>');
          $.each(appendata,function(appendata,item)
          {
            lstsubtask.append('<option value="'+item.id+'">'+item.name+'</option>');
          });

          $('.fadeMe').hide();
        },
        error: function(xhr) {
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
$(document).ready(function(){
$('body').on('change','.lstsubtask',function(){

  var subtaskId= $(this).find('option:selected').val();
  var taskId= $(this).parents('.tr_clone').find('.lsttaskname option:selected').val();
  var taskdate= $(this).parents('.tr_clone').find('.lsttaskstrtdate').val();
  var invoiceid= $(this).parents('.tr_clone').find('.hdntskinvd').val();

        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/insrtinvtaskinfo')?>',
        data: {subtaskId:subtaskId,taskId:taskId,taskdate:taskdate,invoiceid:invoiceid},
        dataType: 'text',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("subtaskId--"+subtaskId+" taskId--"+taskId+" taskdate--"+taskdate+" invoiceid--"+invoiceid);
         },
        success: function(data) {
          //alert("data--"+data);
           var custid= localStorage.getItem("pckId");
           // var custid= $('#custnm option:selected').val();
          if(data=="success")
          {
             //$('#mytasks').html(data);
            // $('#mytasks').load(location.href + ' #mytasks');
             fngetinvoicedetails(invoiceid,'terms',custid);
             Console.log("fngetinvoicedetails 25");
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
});
});
</script>


<!-- //subtask name change -->
<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.subtaskname',function(){

  var subtaskId= $(this).find('option:selected').val();
  var taskId= $(this).parents('.tr_clone').find('.task_name option:selected').val();
  var taskdate= $(this).parents('.tr_clone').find('.taskstrtdate').val();
  var invoiceid= $(this).parents('.tr_clone').find('.hdntskinvd').val();
  var hdntskid= $(this).parents('.tr_clone').find('.hdntskid').val();
  var user= $(this).parents('.tr_clone').find('#task_user option:selected').val();
  var tasksts = $(this).parents('.tr_clone').find('.taskcompleted option:selected').val();
  var taskcompletdby = $(this).parents('.tr_clone').find('.taskcompletedby').val();
  var taskcompletdt = $(this).parents('.tr_clone').find('.taskcompleteddate').val();

    // alert(subtaskId);
        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/updtinvtaskinfo')?>',
        data: {subtaskId:subtaskId,taskId:taskId,taskdate:taskdate,invoiceid:invoiceid,hdntskid:hdntskid,user:user,tasksts:tasksts,taskcompletdby:taskcompletdby,taskcompletdt:taskcompletdt},
        dataType: 'text',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("subtaskId--"+subtaskId+" taskId--"+taskId+" taskdate--"+taskdate+" invoiceid--"+invoiceid+" hdntskid--"+hdntskid);
         },
        success: function(data) {
          //alert("data--"+data);
           var custid= localStorage.getItem("pckId");
           // var custid= $('#custnm option:selected').val();
          if(data=="success")
          {
             //$('#mytasks').html(data);
            // $('#mytasks').load(location.href + ' #mytasks');
            fngetinvoicedetails(invoiceid,'terms',custid);
            Console.log("fngetinvoicedetails 27");

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
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('blur','.taskstrtdate',function(){

  var subtaskId= $(this).parents('.tr_clone').find('.subtaskname option:selected').val();
  var taskId=    $(this).parents('.tr_clone').find('.task_name option:selected').val();
  var taskdate=  $(this).val(); //$(this).parents('.tr_clone').find('.taskstrtdate').val();
  var invoiceid= $(this).parents('.tr_clone').find('.hdntskinvd').val();
  var hdntskid= $(this).parents('.tr_clone').find('.hdntskid').val();
  var user= $(this).parents('.tr_clone').find('#task_user option:selected').val();
  var tasksts = $(this).parents('.tr_clone').find('.taskcompleted option:selected').val();
  var taskcompletdby = $(this).parents('.tr_clone').find('.taskcompletedby').val();
  var taskcompletdt = $(this).parents('.tr_clone').find('.taskcompleteddate').val();

// alert(taskId);

        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/updtinvstrtdtaskinfo')?>',
        data: {subtaskId:subtaskId,taskId:taskId,taskdate:taskdate,invoiceid:invoiceid,hdntskid:hdntskid,user:user,tasksts:tasksts,taskcompletdby:taskcompletdby,taskcompletdt:taskcompletdt},
        dataType: 'text',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("subtaskId--"+subtaskId+" taskId--"+taskId+" taskdate--"+taskdate+" invoiceid--"+invoiceid+" hdntskid--"+hdntskid);
         },
        success: function(data) {
          //alert("data--"+data);
           var custid= localStorage.getItem("pckId");
           // var custid= $('#custnm option:selected').val();
          if(data=="success")
          {
            // $('#mytasks').html(data);
            // $('#mytasks').load(location.href + ' #mytasks');
            fngetinvoicedetails(invoiceid,'terms',custid);
            Console.log("fngetinvoicedetails 27");

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
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.task_name',function(){

  var taskId= $(this).val();
  var subtaskname= $(this).parents('.tr_clone').find('.subtaskname');
// alert("main "+taskId);
        $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/loadsubtaskslist')?>',
        data: {taskId:taskId},
        dataType: 'json',
        beforeSend: function() {
            // setting a timeout
            $('.fadeMe').show();
            //alert("taskId--"+taskId);
         },
        success: function(data) {
          //alert("data--"+data);
          var appendata=data.subtasklist;
          subtaskname.html('');
          subtaskname.html('<option> </option>');
          $.each(appendata,function(appendata,item)
          {
            subtaskname.append('<option value="'+item.id+'">'+item.name+'</option>');
          });

          $('.fadeMe').hide();
        },
        error: function(xhr) {
          // $('.fadeMe').hide();
        },
        complete: function() {
         // $('.fadeMe').hide();
        }
        });
});
});
</script>


<script>
$(document).ready(function(){
$("body").on("keydown", ".lsttaskstrtdate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".lsttaskstrtdate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         //var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
         //var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {   //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
/* ---------------- Commented by AKshay

$(document).ready(function(){
$("body").on("blur", ".lsttaskstrtdate", function(event){

   var key = event.keyCode;
   alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".lsttaskstrtdate");
   var str = temp_edate.val();


         var d= new Date(str);
         var fyer= d.getFullYear();
         var fmnth= String(d.getMonth() + 1).padStart(2, '0').slice(-2);
         var fdate= String(d.getDate()).padStart(2, '0').slice(-2);
         var trimmed;
         if(str.substring(0, 2)=="00")
         {
           trimmed = "20"+fyer+"-"+fmnth+"-"+fdate;
         }else{
            trimmed = fyer+"-"+fmnth+"-"+fdate;
         }

         var newdate= trimmed;  //'02/07/2019';
         //var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
        var dtRegex = new RegExp(/\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/);
         //return dtRegex.test(newdate);
         var chkvdate= dtRegex.test(newdate);
         //alert("chkvdate--"+chkvdate);
         if(chkvdate==true)
         {
           temp_edate.val(newdate);
         }else{
            temp_edate.val("");
            event.preventDefault();
         }


});
});

*/
</script>


<script>
$(document).ready(function(){
$("body").on("keydown", ".taskstrtdate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".taskstrtdate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
        // var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
        //  var today = yyyy + '-' + mm + '-' +  dd;
        var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {   //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
$("body").on("keydown", ".taskduedatlast", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".taskduedatlast");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {   //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
$("body").on("keydown", ".taskcompleteddate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".taskcompleteddate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         //var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {   //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
$("body").on("keydown", ".taskduedate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".taskduedate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {   //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
$("body").on("keydown", ".taskcompleteddate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".taskcompleteddate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
          var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {   //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
        {

        }
        else
        {
            var str = temp_edate.val();


            if(str.length >= 6 &&  !(str.includes("/")))
            {
                var mm = str.substring(0,2);
                var dd = str.substring(2).substring(0,2);
                var yy = str.substring(2).substring(2).substring(0,2);
                yy = "20"+yy;

                var month = 12;
                var day   = 31;

                if(mm=="02")
                {
                    if(yy % 4 === 0 )
                    {
                        day = 29;
                    }
                    else
                    {
                        day = 28;
                    }
                }

                if(mm <= month && dd <= day)
                {

                    var today = mm + '/' + dd + '/' + yy ;
                    var today1 = mm + '/' + dd + '/' + yy ;

                    temp_edate.val(today);

                }
                else
                {
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
$(document).ready(function(){
$("body").on("keydown", ".invcedt", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".invcedt");

    if(key=="107" || key=="187")
    {
        //alert("date+");
        var dtpls;
        if(temp_edate.val()=="")
        {
        dtpls= new Date();
        }else{
        dtpls= new Date(temp_edate.val());
        }

        dtpls.setDate( dtpls.getDate() + 1 );
        var mm = dtpls.getMonth() + 1;
        if(mm <10)
        {
         mm = "0"+mm;
        }

        var dd =  dtpls.getDate();
        if(dd <10)
        {
         dd = "0"+dd;
        }


        var yyyy =  dtpls.getFullYear();
        //var today = yyyy + '-' + mm + '-' +  dd;
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="109" || key=="189")
    {
        //alert("date-");
        var dtmns;
        if(temp_edate.val()=="")
        {
        dtmns= new Date();
        }else{
        dtmns= new Date(temp_edate.val());
        }

        dtmns.setDate( dtmns.getDate() - 1 );
        var mm = dtmns.getMonth() + 1;
        if(mm <10)
        {
         mm = "0"+mm;
        }

        var dd =  dtmns.getDate();
        if(dd <10)
        {
         dd = "0"+dd;
        }

        var yyyy =  dtmns.getFullYear();
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="68")
    {   //alert("date D");
       today = '<?php echo date("m/d/Y"); ?>';
       temp_edate.val(today);
       event.preventDefault();
    }
    else if(key=="8" || key=="46")
    {

    }
    else
    {
        var str = temp_edate.val();


        if(str.length >= 6 &&  !(str.includes("/")))
        {
            var mm = str.substring(0,2);
            var dd = str.substring(2).substring(0,2);
            var yy = str.substring(2).substring(2).substring(0,2);
            yy = "20"+yy;

            var month = 12;
            var day   = 31;

            if(mm=="02")
            {
                if(yy % 4 === 0 )
                {
                    day = 29;
                }
                else
                {
                    day = 28;
                }
            }

            if(mm <= month && dd <= day)
            {

                var today = mm + '/' + dd + '/' + yy ;
                var today1 = mm + '/' + dd + '/' + yy ;

                temp_edate.val(today);

            }
            else
            {
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
$(document).ready(function(){
$("body").on("keydown", ".invdudate", function(event){

   var key = event.keyCode;
   //alert("key--"+key);
   var temp_edate =  $(this).parents(".tr_clone").find(".invdudate");

   if(key=="107" || key=="187")
      {
        //alert("date+");
          var dtpls;
          if(temp_edate.val()=="")
          {
            dtpls= new Date();
          }else{
            dtpls= new Date(temp_edate.val());
          }

         dtpls.setDate( dtpls.getDate() + 1 );
         var mm = dtpls.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtpls.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }


         var yyyy =  dtpls.getFullYear();
         //var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="109" || key=="189"){
        //alert("date-");
          var dtmns;
          if(temp_edate.val()=="")
          {
            dtmns= new Date();
          }else{
            dtmns= new Date(temp_edate.val());
          }

         dtmns.setDate( dtmns.getDate() - 1 );
         var mm = dtmns.getMonth() + 1;
         if(mm <10)
         {
             mm = "0"+mm;
         }

         var dd =  dtmns.getDate();
         if(dd <10)
         {
             dd = "0"+dd;
         }

         var yyyy =  dtmns.getFullYear();
         //var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

      }else if(key=="68")
       {
         //alert("date D");
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
    {

    }
    else
    {
        var str = temp_edate.val();


        if(str.length >= 6 &&  !(str.includes("/")))
        {
            var mm = str.substring(0,2);
            var dd = str.substring(2).substring(0,2);
            var yy = str.substring(2).substring(2).substring(0,2);
            yy = "20"+yy;

            var month = 12;
            var day   = 31;

            if(mm=="02")
            {
                if(yy % 4 === 0 )
                {
                    day = 29;
                }
                else
                {
                    day = 28;
                }
            }

            if(mm <= month && dd <= day)
            {

                var today = mm + '/' + dd + '/' + yy ;
                var today1 = mm + '/' + dd + '/' + yy ;

                temp_edate.val(today);

            }
            else
            {
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
$(document).ready(function(){
$("body").on("keydown", ".pickupdate", function(event){

    var key = event.keyCode;
    //alert("key--"+key);
    var temp_edate =  $(this).parents(".tr_clone").find(".pickupdate");

    if(key=="107" || key=="187")
    {
        //alert("date+");
        var dtpls;
        if(temp_edate.val()=="")
        {
            dtpls= new Date();
        }else{
            dtpls= new Date(temp_edate.val());
        }

        dtpls.setDate( dtpls.getDate() + 1 );
        var mm = dtpls.getMonth() + 1;
        if(mm <10)
        {
            mm = "0"+mm;
        }

        var dd =  dtpls.getDate();
        if(dd <10)
        {
            dd = "0"+dd;
        }


        var yyyy =  dtpls.getFullYear();
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="109" || key=="189")
    {
        //alert("date-");
        var dtmns;
        if(temp_edate.val()=="")
        {
            dtmns= new Date();
        }else{
            dtmns= new Date(temp_edate.val());
        }

        dtmns.setDate( dtmns.getDate() - 1 );
        var mm = dtmns.getMonth() + 1;
        if(mm <10)
        {
            mm = "0"+mm;
        }

        var dd =  dtmns.getDate();
        if(dd <10)
        {
            dd = "0"+dd;
        }

        var yyyy =  dtmns.getFullYear();
        var today = mm + '/' + dd + '/' +  yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="68")
    {   //alert("date D");
        today = '<?php echo date("m/d/Y"); ?>';
        temp_edate.val(today);
        event.preventDefault();
    }
    else if(key=="8" || key=="46")
    {

    }
    else
    {
        var str = temp_edate.val();


        if(str.length >= 6 &&  !(str.includes("/")))
        {
            var mm = str.substring(0,2);
            var dd = str.substring(2).substring(0,2);
            var yy = str.substring(2).substring(2).substring(0,2);
            yy = "20"+yy;

            var month = 12;
            var day   = 31;

            if(mm=="02")
            {
                if(yy % 4 === 0 )
                {
                    day = 29;
                }
                else
                {
                    day = 28;
                }
            }

            if(mm <= month && dd <= day)
            {

                var today = mm + '/' + dd + '/' + yy ;
                var today1 = mm + '/' + dd + '/' + yy ;

                temp_edate.val(today);

            }
            else
            {
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
function fnupdateitemqty(itmqty,itemId,invId)
 {
    //alert("itmqty--"+itmqty+" itemId--"+itemId);

          $.ajax({
          type: 'POST',
          url: '<?=site_url('fi_home/fnupdateitemqtyinfo')?>',
          data: {itmqty:itmqty,itemId:itemId},
          dataType: 'text',
          beforeSend: function() {
              // setting a timeout
              $('.fadeMe').show();
              //alert("invId--"+invId);
          },
          success: function(data) {


               var custid= localStorage.getItem("pckId");
               var custid= localStorage.getItem("pckId");
               // var custid= $('#custnm option:selected').val();
              if(data=="success")
              {

                 fngetinvoicedetails(invId,'items',custid);
                 Console.log("fngetinvoicedetails 28");

                  $('.fadeMe').hide();

                  //$('#loaditms').load(location.href + ' #loaditms');

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

<script type="text/javascript">
function fnupdateitemtax(itmtax,itemId,invId)
 {
    //alert("itmtax--"+itmtax+" itemId--"+itemId);

          $.ajax({
          type: 'POST',
          url: '<?=site_url('fi_home/fnupdateitemtaxinfo')?>',
          data: {itmtax:itmtax,itemId:itemId},
          dataType: 'text',
          beforeSend: function() {
              // setting a timeout
              $('.fadeMe').show();
              //alert("invId--"+invId);
          },
          success: function(data) {


               var custid= localStorage.getItem("pckId");
               // var custid= $('#custnm option:selected').val();
              if(data=="success")
              {

                 fngetinvoicedetails(invId,'items',custid);
                 Console.log("fngetinvoicedetails 29");

                  $('.fadeMe').hide();

                  //$('#loaditms').load(location.href + ' #loaditms');

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

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.invdescount',function(){

  var custid= localStorage.getItem("pckId");
  // alert(custid);
  // var custid= $('#custnm option:selected').val();
  var invoiceid = $(this).parents('.tr_clone').find('.hdninvrowId').val();
  var discntyp= $(this).parents('.tr_clone').find('.discntyp').val();
  var inputxtval= $(this).val();
  var invoicamount= parseInt($(this).parents('.tr_clone').find('.invoicamount').val());
  var invdescount=  $(this).parents('.tr_clone').find('.invdescount');
  var discntyplist= $(this).parents('.tr_clone').find('.discntyp');

  // alert("inputxtval--"+inputxtval+" invoiceid--"+invoiceid+" discntyp--"+discntyp+" invoicamount--"+invoicamount);

    if(discntyp!="")
    {
        if(inputxtval > invoicamount)
        {
          alert("Please enter valid discount amount");
           invdescount.focus();
        }else{

            if(discntyp=="1")
            {
              //alert("calculate Discount using $");

                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fninvdescountinfo')?>',
                        data: {inputxtval:inputxtval,invoiceid:invoiceid,discntyp:discntyp,invoicamount:invoicamount},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               fnsearhinvoice(custid);

                                $('.fadeMe').hide();
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

            }else if(discntyp=="2"){

              if(inputxtval > 100)
              {
                alert("Please enter valid percentage amount");
                invdescount.focus();
              }else{
                //alert("calculate Discount using %");

                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fninvdescountinfo')?>',
                        data: {inputxtval:inputxtval,invoiceid:invoiceid,discntyp:discntyp,invoicamount:invoicamount},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               fnsearhinvoice(custid);
                                $('.fadeMe').hide();
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
        }

    }else{

        alert("Please select discount type");
        discntyplist.focus();
    }

});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.discntyp',function(){

  var custid= localStorage.getItem("pckId");
  // var custid= $('#custnm option:selected').val();
  var invoiceid = $(this).parents('.tr_clone').find('.hdninvrowId').val();
  var discntyp= $(this).parents('.tr_clone').find('.discntyp').val();
  var inputxtval_sec=  $(this).parents('.tr_clone').find('.invdescount').val(); //$(this).val();
  var invoicamount= parseInt($(this).parents('.tr_clone').find('.invoicamount').val());
  var invoice_balance_due= parseFloat($(this).parents('.tr_clone').find('.invoice_balance_due').val());
  var invdescount=  $(this).parents('.tr_clone').find('.invdescount');
  var discntyplist= $(this).parents('.tr_clone').find('.discntyp');

  //var invdescountval=  $(this).parents('.tr_clone').find('.invdescount').val();
  // alert("inputxtval--"+inputxtval+" invoiceid--"+invoiceid+" discntyp--"+discntyp+" invoicamount--"+invoicamount+" inputxtval_sec:"+inputxtval_sec);
  var inputxtval=0;
    if(discntyp!="")
    {
     /* if(inputxtval>0)
      {*/
        if(inputxtval_sec > invoicamount)
        {
          alert("Please enter valid discount amount");
           invdescount.focus();
        }else{

            if(discntyp=="1")
            {

              //alert("calculate Discount using $");

                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fninvdescounttypinfo')?>',
                        data: {inputxtval:inputxtval,invoiceid:invoiceid,discntyp:discntyp,invoicamount:invoicamount,inputxtval_sec:inputxtval_sec,invoice_balance_due:invoice_balance_due},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               fnsearhinvoice(custid);

                                $('.fadeMe').hide();
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

            }else if(discntyp=="2"){



              if(inputxtval_sec > 100)
              {
                alert("Please enter valid percentage amount");
                invdescount.focus();
              }else{
                //alert("calculate Discount using %");

                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fninvdescounttypinfo')?>',
                        data: {inputxtval:inputxtval,invoiceid:invoiceid,discntyp:discntyp,invoicamount:invoicamount,inputxtval_sec:inputxtval_sec,invoice_balance_due:invoice_balance_due},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               fnsearhinvoice(custid);
                                $('.fadeMe').hide();
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
        }
      /*}else{
         alert("Please enter discount amount");
      }*/

    }else{

        alert("Please select discount type");
        discntyplist.focus();
    }

});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('change','.invcountey',function(){

  var cvalue= $(this).val();
  var countyval= $('#countylist [value="' + cvalue + '"]').data('value');
  var hdninvId= $(this).parents('.tr_clone').find('.hdninvrowId').val();
  var custid= localStorage.getItem("pckId");
  // var custid= $('#custnm option:selected').val();

  //alert("countyval--"+countyval+" hdninvId--"+hdninvId+" cvalue--"+cvalue);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnupdateinvcounteyinfo')?>',
            data: {countyval:countyval,hdninvId:hdninvId,cvalue:cvalue},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

                if(data=="success")
                {
                   //fngetinvoicedetails(invoiceid);
                   fnsearhinvoice(custid);
                    $('.fadeMe').hide();
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

});
});
</script>


<script type="text/javascript">

  $(document).ready(function() {

    $('body').on('click','.invrowtb',function(ee){ 

      ee.stopPropagation();
      
      $('#filterinvoicedata tr').removeClass('active-cust');
      $(this).addClass('active-cust');

      var trr = $(".mytabber .nav li.active a").attr("href");

      $('#divloadinvtabs .tab-pane').removeClass('active');
      $('#divloadinvtabs').find(trr).addClass('active');
      
    });
  }); 
</script>


<script type="text/javascript">

  $(document).ready(function() {

    $('body').on('change','.itemdescount',function() {

      var custid        = localStorage.getItem("pckId");
      // var custid= $('#custnm option:selected').val();
      var invoiceid     = $(this).parents('.tr_clone').find('.hdninvoicrcId').val();
      var itemid        = $(this).parents('.tr_clone').find('.hdnitemrowId').val();
      var itemdiscntyp  = $(this).parents('.tr_clone').find('.itemdiscntyp').val();    //Type
      var inputxtval    = $(this).val();
      var witmi4        = parseInt($(this).parents('.tr_clone').find('.witmi4').val());      //Total Amount
      var itemdescount  = $(this).parents('.tr_clone').find('.itemdescount');             //Disc amount
      var discntyplist  = $(this).parents('.tr_clone').find('.itemdiscntyp');
      var itemwoutqty   = $(this).parents('.tr_clone').find('.itemwoutqty').val();
      var itmtot        = parseInt($(this).parents('.tr_clone').find('.itmtot').val());
      var change_type   = 0;
      var itemdescount1 = itemdescount.val()

      if(itemdiscntyp != "") {

        if(inputxtval > witmi4) {

          alert("Please enter valid item discount amount");
          itemdescount.focus();
        }
        else {

          if(itemdiscntyp == "1") {

            $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnitemdescountinfo')?>',
                        data: { itemdescount1 : itemdescount1, 
                        inputxtval:inputxtval,itemid:itemid,itemdiscntyp:itemdiscntyp,witmi4:witmi4,invoiceid:invoiceid,custid:custid,itemwoutqty:itemwoutqty,itmtot:itmtot,change_type:change_type},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                              // fngetinvoicedetails(invoiceid,'items',custid);
                                //fnsearhinvoice(custid);
                               // location.reload(true);
                                 //window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                                 //location.href= location.href;

                                  fnsearhinvoice(custid);
                                  fnupdateiteminfo(itemid, invoiceid, itemid)

                                $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                        // fnsearhinvoice(custid);

                        }

                    });

            }else if(itemdiscntyp=="2"){

              if(inputxtval > 100)
              {
                alert("Please enter valid item percentage amount");
                itemdescount.focus();
              }else{
                //alert("calculate item Discount using %");

                       $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnitemdescountinfo')?>',
                        data: {inputxtval:inputxtval,itemid:itemid,itemdiscntyp:itemdiscntyp,witmi4:witmi4,invoiceid:invoiceid,custid:custid,itemwoutqty:itemwoutqty,itmtot:itmtot,change_type:change_type},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               //fnsearhinvoice(custid);
                                 //window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                                 //location.href= location.href;
                                // fngetinvoicedetails(invoiceid,'items',custid);
                                //location.reload(true);

                                 fnsearhinvoice(custid);
                                 fnupdateiteminfo(itemid, invoiceid, itemid)

                                $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                         //fnsearhinvoice(custid);
                        }

                    });
              }


            }
        }

    }else{

        alert("Please select item discount type");
        discntyplist.focus();
    }

});
});
</script>


<script type="text/javascript">

    $(document).ready(function() {

        $('body').on('change','.itemdiscntyp',function() {

            console.log("item level itemdiscntyp change");

            var custid= localStorage.getItem("pckId");
  // var custid= $('#custnm option:selected').val();
  var invoiceid = $(this).parents('.tr_clone').find('.hdninvoicrcId').val();
  var itemid = $(this).parents('.tr_clone').find('.hdnitemrowId').val();
  var itemdiscntyp= $(this).parents('.tr_clone').find('.itemdiscntyp').val();
  var inputxtval= $(this).parents('.tr_clone').find('.itemdescount').val(); //$(this).val();
  var witmi4= parseInt($(this).parents('.tr_clone').find('.witmi4').val());
  var itemdescount=  $(this).parents('.tr_clone').find('.itemdescount');
  var discntyplist= $(this).parents('.tr_clone').find('.itemdiscntyp');
  var itemwoutqty= $(this).parents('.tr_clone').find('.itemwoutqty').val();
  var itmtot= parseInt($(this).parents('.tr_clone').find('.itmtot').val());

  var change_type =1;

 // alert("inputxtval--"+inputxtval+" itemid--"+itemid+" itemdiscntyp--"+itemdiscntyp+" witmi4--"+witmi4+" invoiceid--"+invoiceid+" custid--"+custid+" itemwoutqty--"+itemwoutqty+" itmtot--"+itmtot);

    if(itemdiscntyp!="")
    {
        if(inputxtval > witmi4)
        {
          alert("Please enter valid item discount amount");
           itemdescount.focus();
        }else{

            if(itemdiscntyp=="1")
            {
              //alert("calculate item Discount using $");

                       $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnitemdescountinfo')?>',
                        data: {inputxtval:inputxtval,itemid:itemid,itemdiscntyp:itemdiscntyp,witmi4:witmi4,invoiceid:invoiceid,custid:custid,itemwoutqty:itemwoutqty,itmtot:itmtot,change_type:change_type},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               //fnsearhinvoice(custid);
                               //window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                              //location.href= location.href;
                              //fngetinvoicedetails(invoiceid,'items',custid);
                              //location.reload(true);

                               fnsearhinvoice(custid);

                                $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                         //fnsearhinvoice(custid);
                        }

                    });

            }else if(itemdiscntyp=="2"){

              console.log(6258);

              if(inputxtval > 100)
              {
                alert("Please enter valid item percentage amount");
                itemdescount.focus();
              }else{
                //alert("calculate item Discount using %");

                       $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnitemdescountinfo')?>',
                        data: {inputxtval:inputxtval,itemid:itemid,itemdiscntyp:itemdiscntyp,witmi4:witmi4,invoiceid:invoiceid,custid:custid,itemwoutqty:itemwoutqty,itmtot:itmtot,change_type:change_type},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {

                              fnsearhinvoice(custid);
                               //location.href= location.href;
                             // window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                             //fngetinvoicedetails(invoiceid,'items',custid);
                            // location.reload(true);

                                $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                         //fnsearhinvoice(custid);
                        }

                    });
              }


            }
        }

    }else{

        alert("Please select item discount type");
        discntyplist.focus();
    }

});
});
</script>


<script type="text/javascript">

  $(document).ready(function() {

    $('body').on('change','.itemwoutqty',function() {

      var itemwoutqty   = $(this).val();
      var custid        = localStorage.getItem("pckId");
      var invoiceid     = $(this).parents('.tr_clone').find('.hdninvoicrcId').val();
      
      if(invoiceid == ""){
        invoiceid = $('.tr_clone.active-cust').find('.hdninvrowId').val();
      }
      
 
      
      
      
      
      // var custid= $('#custnm option:selected').val();
      
      var itemid        = $(this).parents('.tr_clone').find('.hdnitemrowId').val();
      var itemdiscntyp  = $(this).parents('.tr_clone').find('.itemdiscntyp').val();
      var itemdescount  = $(this).parents('.tr_clone').find('.itemdescount').val(); //$(this).val();
      var witmi4        = parseInt($(this).parents('.tr_clone').find('.witmi4').val());
      var itmtot        = parseInt($(this).parents('.tr_clone').find('.itmtot').val());

    //alert("itemwoutqty--"+itemwoutqty+" custid--"+custid+" invoiceid--"+invoiceid+" itemid--"+itemid+" itemdiscntyp--"+itemdiscntyp+" itemdescount--"+itemdescount+" witmi4--"+witmi4+" itmtot--"+itmtot);

              $.ajax({
              type: 'POST',
              url: '<?=site_url('fi_home/fnitemqtydescountinfo')?>',
              data: { itemwoutqty : itemwoutqty, itemid : itemid, itemdiscntyp : itemdiscntyp, witmi4 : witmi4, invoiceid : invoiceid,custid : custid, itemdescount : itemdescount, itmtot : itmtot },
              dataType: 'text',
              beforeSend: function() { 
                  // setting a timeout
                  $('.fadeMe').show();
              },
              success: function(data) {//alert("data--"+data);

                  if(data == "success") {

                    fnsearhinvoice(custid);
                    $('.fadeMe').hide();
                  }else if(data=="error"){
                     $('.fadeMe').hide();
                  }

              },
              error: function(xhr) {
              },
              complete: function() {
              }
        });

});
});
</script>

<script type="text/javascript"> 

    /*After change discount type of package level*/

    function fnupdatepckgdescount(pckgdiscntyp, invoiceid, custid, pckgprice, pckgdesamt, pckid, pck_discounted_amt) {

        var change_type = 1;
        var pckprice    = parseInt(pckgprice);
        var pckdesamt;
     
        if(pckgdesamt != "") {

            pckdesamt = pckgdesamt;
        }
        else {

            pckdesamt = $('#pck_descnt'+pckid).val();
        }

        pckdesamt = 0;

        var rem = parseFloat(pckgdesamt) - parseFloat(pck_discounted_amt);

        if(pckgdiscntyp != "") {

            if(pckdesamt > pckprice) {

                alert("Please enter valid package discount amount");
               
                $('#pck_descnt'+pckid).focus();
            }
            else {

              if(pckgdiscntyp == "1") {

                $.ajax({
                  
                  type: 'POST',
                  url: '<?=site_url('fi_home/fnpckgdescountinfo')?>',
                  data: {custid:custid,invoiceid:invoiceid,pckid:pckid,pckgdiscntyp:pckgdiscntyp,pckdesamt:pckdesamt,pckprice:pckprice,change_type:change_type,rem:rem},
                  dataType: 'text',
                  beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();

                        },
                        success: function(data) {
                          //console.log("$$$"+data);
                            if(data!="")
                            {

                              fnsearhinvoice(custid);
                              $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) {
                        },
                        complete: function() {
                        }
                    });

                  }else if(pckgdiscntyp=="2"){
                    // alert("hii=%");

                  if(pckdesamt > 100)
                  {
                    alert("Please enter valid package percentage amount");
                    //itemdescount.focus();
                    $('#pck_descnt'+pckid).focus();
                  }else{
                    // alert("hii=%%");
                    // alert("custid--"+custid+" invoiceid--"+invoiceid+" pckid--"+pckid+" pckgdiscntyp--"+pckgdiscntyp+" pckdesamt--"+pckdesamt+" pckprice--"+pckprice+"==change_type"+change_type+"-- pck_discounted_amt"+pck_discounted_amt);
                    pckdesamt=0;
                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnpckgdescountinfo')?>',
                        data: {custid:custid,invoiceid:invoiceid,pckid:pckid,pckgdiscntyp:pckgdiscntyp,pckdesamt:pckdesamt,pckprice:pckprice,change_type:change_type,rem:rem},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("custid--"+custid+" invoiceid--"+invoiceid+" pckid--"+pckid+" pckgdiscntyp--"+pckgdiscntyp+" pckdesamt--"+pckdesamt+" pckprice--"+pckprice); pck_descnt421
                        },
                        success: function(data) {
                            //console.log("%%"+data);
                            if(data!="")
                            {

                              fnsearhinvoice(custid);
                              $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) {
                        },
                        complete: function() {
                        }
                     });
                  }
               }

             }
         }else{

            alert("Please select package discount type");
            //discntyplist.focus();
            $('#pck_discount'+pckid).focus();
        }

 }
</script>

<script type="text/javascript">

  function fnupdatepckgdescnt(pckdesamt, invoiceid, custid, pckgprice, pckgdiscntyp, pckid) {

    var invoiceid     = $('.tr_clone.active-cust').find('.hdninvrowId').val();
    var invoicamount  = $('.tr_clone.active-cust').find('.invoicamount').val();
    var pckprice = parseInt(pckgprice);

    if(pckgdiscntyp != "") {

      if(pckdesamt > pckprice) {

        alert("Please enter valid package discount amount");
        $('#pck_descnt'+pckid).focus();
      }
      else {

        if(pckgdiscntyp == "1") {

          $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnpckgdescountinfo')?>',
                        data: {custid:custid, invoiceid:invoiceid, pckid:pckid, pckgdiscntyp:pckgdiscntyp, pckdesamt:pckdesamt, pckprice:pckprice},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();

                        },
                        success: function(data) {
                          //console.log("if "+data);
                            if(data!="")
                            {

                              fnsearhinvoice(custid);
                              $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) {
                        },
                        complete: function() {
                        }
                    });

                }else if(pckgdiscntyp=="2"){

                  if(pckdesamt > 100)
                  {
                    alert("Please enter valid package percentage amount");
                    //itemdescount.focus();
                    $('#pck_descnt'+pckid).focus();
                  }else{

                        $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnpckgdescountinfo')?>',
                        data: {custid:custid,invoiceid:invoiceid,pckid:pckid,pckgdiscntyp:pckgdiscntyp,pckdesamt:pckdesamt,pckprice:pckprice},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("custid--"+custid+" invoiceid--"+invoiceid+" pckid--"+pckid+" pckgdiscntyp--"+pckgdiscntyp+" pckdesamt--"+pckdesamt+" pckprice--"+pckprice);
                        },
                        success: function(data) {
                          //console.log("else "+data);
                            if(data!="")
                            {

                              fnsearhinvoice(custid);
                              $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) {
                        },
                        complete: function() {
                        }
                     });
                  }
               }

             }
         }else{

            alert("Please select package discount type");
            //discntyplist.focus();
            $('#pck_discount'+pckid).focus();
        }

 }
</script>


<script>
$(document).ready(function(){
 var hash = document.location.hash;
   if (hash) {
       // console.log(hash);
       $(".nav-tabs a").parent("li").removeClass('active');
       $(".nav-tabs a[href='"+hash+"']").parent("li").addClass('active');
       setTimeout(function(){
         // alert("time");
          $(".mytabber .tab-content .tab-pane").removeClass('active');
          $(".mytabber .tab-content "+hash).addClass('active');
       }, 1500);

   }

   // Change hash for page-reload
   // $('.nav-tabs a').on('shown.bs.tab', function (e) {
   //     window.location.hash = e.target.hash;
   // });

   });

 </script>

  <script type="text/javascript">
  function check_cus_seleted() {

    //alert("itmtax--"+itmtax+" itemId--"+itemId);
    var custid= localStorage.getItem("pckId");
    
    // alert("id "+custid);
    if (custid =="" || custid == 'null' || custid =='N' || custid =='undefined' ) {
       alert("please select customer..!");
       localStorage.removeItem("pckId");
       window.location.href = location.href;

     }else {
       // alert("else");
     }

 }
 </script>
 
<script>
function update_field(tbl_nm,set_col_nm,set_col_val,whr_col_nm,whr_col_val,field_type) //  for date field_type="date"
{
    //alert(tbl_nm+":"+set_col_nm+":"+set_col_val+":"+whr_col_nm+":"+whr_col_val+":"+field_type);
    $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/update_field')?>',
        data: {tbl_nm:tbl_nm,set_col_nm:set_col_nm,set_col_val:set_col_val,whr_col_nm:whr_col_nm,whr_col_val:whr_col_val,field_type:field_type},
        dataType: 'text',
        beforeSend: function() {
            $('.fadeMe').show();
        },
        success: function(data) {
            
        },
        error: function(xhr) {
        },
        complete: function() {
        }
    
    });
}
</script>

<script>
$(document).ready(function() {

   	$("body").on("keydown", ".aksdt", function(event) 
   	{
        	
    	var key = event.keyCode;
    	var cls_nm =  $(this).attr("class");
    
        var rem_nm = cls_nm.replace('form-control aksdt ','');
     
        var temp_edate =  $(this).parents(".tr_clone").find("."+rem_nm);
        
        if(key=="107" || key=="187") {

           //alert("date+");
           var dtpls;
           if(temp_edate.val()=="")
           {
               dtpls= new Date();
           }
           else
           {
               dtpls= new Date(temp_edate.val());
           }

           dtpls.setDate( dtpls.getDate() + 1 );
           var mm = dtpls.getMonth() + 1;
           if(mm <10)
           {
               mm = "0"+mm;
           }

           var dd =  dtpls.getDate();
           if(dd <10)
           {
                dd = "0"+dd;
           }


           var yyyy =  dtpls.getFullYear();
           var today = mm + '/' + dd + '/' +  yyyy;
           var today1 = yyyy + '/' + mm + '/' +  dd;


           temp_edate.val(today);


           event.preventDefault();
       }
       else if(key=="109" || key=="189")
       {
           //alert("date-");
           var dtmns;
           if(temp_edate.val()=="")
           {
               dtmns= new Date();
           }else{
               dtmns= new Date(temp_edate.val());
           }

           dtmns.setDate( dtmns.getDate() - 1 );
           var mm = dtmns.getMonth() + 1;
           if(mm <10)
           {
               mm = "0"+mm;
           }

           var dd =  dtmns.getDate();
           if(dd <10)
           {
               dd = "0"+dd;
           }

           var yyyy =  dtmns.getFullYear();
           var today = mm + '/' + dd + '/' +  yyyy;
           var today1 = yyyy + '/' + mm + '/' +  dd;

           //alert("minus today--"+today);
           //$('#edate').val(today);
           temp_edate.val(today);

           event.preventDefault();

       }
       else if(key=="68")
       {
           today = '<?php echo date("m/d/Y"); ?>';
           temp_edate.val(today);
           event.preventDefault();
       }
       else if(key=="8" || key=="46")
       {

       }
       else
       {
           var str = temp_edate.val();


           if(str.length >= 6 &&  !(str.includes("/")))
           {
               var mm = str.substring(0,2);
               var dd = str.substring(2).substring(0,2);
               var yy = str.substring(2).substring(2).substring(0,2);
               yy = "20"+yy;

               var month = 12;
               var day   = 31;

               if(mm=="02")
               {
                   if(yy % 4 === 0 )
                   {
                       day = 29;
                   }
                   else
                   {
                       day = 28;
                   }
               }

               if(mm <= month && dd <= day)
               {

                   var today = mm + '/' + dd + '/' + yy ;
                   var today1 = mm + '/' + dd + '/' + yy ;

                   temp_edate.val(today);

               }
               else
               {
                   alert("Wrong date.");
                   temp_edate.val("");
                   event.preventDefault();
               }
           }
       } 

   });

});
</script>

<a style="display: none" href="<?php echo site_url('fi_home/');?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
<script src="<?php echo base_url('assets/');?>js/prasanna.js"></script>
<?php
  foreach ($customersql->result() as $customersql_data) { 
    if($customersql_data->cus_id == $cus_id) {
    ?>   
      <script type="text/javascript">
      
        cust_invoice();
      </script>
    <?php
    }
  } ?>


  <script type="text/javascript">
    
    function change_qty(id, qty){

      var change_qty_ = qty.val();

      $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/change_qty')?>',
        data: {id:id, change_qty_:change_qty_},
        dataType: 'text',
        success: function(data) {
        },
      });

    }

  </script>

    <script type="text/javascript">
    
    function change_qty1(id, qty){

      //var change_qty_ = qty.val();
      //alert(qty);

      $.ajax({
        type: 'POST',
        url: '<?=site_url('fi_home/change_qty1')?>',
        data: {id:id, change_qty_:qty},
        dataType: 'text',
        success: function(data) {
        },
      });

    }

  </script> 

  <script type="text/javascript">
    
    $( document ).ready(function() {

      $.ajax({
        url: "<?=site_url('Email_reader')?>", 
          success: function(result){
          console.log("Email Updated from server");
      }});
    });
  </script>


<script type="text/javascript">

    $(document).ready(function() {

        $('body').on('change','.pck_item_disc_typ, .pck_item_discnt_amt, .pck_itemwoutqty',function() {

            console.log("Package item level itemdiscntyp change");

           // pck_itemdescount

            var invoiceid = $(this).parents('.tr_clone').find('.pck_hdninvoicrcId').val();
            console.log(invoiceid);

            var itemid = $(this).parents('.tr_clone').find('.pck_hdnitemrowId').val();
            console.log(itemid);

            var itemdiscntyp = $(this).parents('.tr_clone').find('.pck_itemdiscntyp').val();
            console.log(itemdiscntyp);

            var inputxtval = $(this).parents('.tr_clone').find('.pck_item_discnt_amt').val();
            console.log(inputxtval);

            var witmi4 = parseInt($(this).parents('.tr_clone').find('.pck_witmi4').val());
            console.log(witmi4);

            var itemdescount = $(this).parents('.tr_clone').find('.pck_item_discnt_amt').val();
            console.log(itemdescount);


            var discntyplist = itemdiscntyp; //$(this).parents('.tr_clone').find('.pck_itemdiscntyp').val();
            console.log(discntyplist);

            var itemwoutqty = $(this).parents('.tr_clone').find('.pck_itemwoutqty').val();
            console.log(itemwoutqty);

            var itmtot = parseInt($(this).parents('.tr_clone').find('.pck_itmtot').val());
            console.log(itmtot);

            var custid = localStorage.getItem("pckId");
            console.log(custid);

            var change_type = 1;

            if(itemdiscntyp != "") {

              if(inputxtval > witmi4) {

                alert("Please enter valid item discount amount");
                itemdescount.focus();
              }
              else {

                if(itemdiscntyp == "1") {

                  //alert("calculate item Discount using $");

                       $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnitemdescountinfo_pck')?>',
                        data: {inputxtval:inputxtval,itemid:itemid,itemdiscntyp:itemdiscntyp,witmi4:witmi4,invoiceid:invoiceid,custid:custid,itemwoutqty:itemwoutqty,itmtot:itmtot,change_type:change_type, itemdescount1:itemdescount},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {
                               //fngetinvoicedetails(invoiceid);
                               //fnsearhinvoice(custid);
                               //window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                              //location.href= location.href;
                              //fngetinvoicedetails(invoiceid,'items',custid);
                              //location.reload(true);

                               fnsearhinvoice(custid);

                                $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                         //fnsearhinvoice(custid);
                        }

                    });

            }else if(itemdiscntyp=="2"){

              console.log(6258);

              if(inputxtval > 100)
              {
                alert("Please enter valid item percentage amount");
                itemdescount.focus();
              }else{
                //alert("calculate item Discount using %");

                       $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnitemdescountinfo_pck')?>',
                        data: {inputxtval:inputxtval,itemid:itemid,itemdiscntyp:itemdiscntyp,witmi4:witmi4,invoiceid:invoiceid,custid:custid,itemwoutqty:itemwoutqty,itmtot:itmtot,change_type:change_type, itemdescount1:inputxtval},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                        },
                        success: function(data) {

                            if(data=="success")
                            {

                              fnsearhinvoice(custid);
                               //location.href= location.href;
                             // window.location.href="<?//=site_url('fi_home/custinvoices')?>";
                             //fngetinvoicedetails(invoiceid,'items',custid);
                            // location.reload(true);

                                $('.fadeMe').hide();
                            }else if(data=="error"){
                               $('.fadeMe').hide();
                            }

                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                         //fnsearhinvoice(custid);
                        }

                    });
              }


            }
        }

    }else{

        alert("Please select item discount type");
        discntyplist.focus();
    }

});
});
</script>

