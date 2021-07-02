<!DOCTYPE html>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Invoices</title>

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

  <link rel="stylesheet"

  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>
	.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}


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

table .form-group {
    margin-bottom: 0;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 1px;
}

</style>

</head>

<body class="hold-transition skin-blue sidebar-mini">



    <!-- Content Wrapper. Contains page content -->
    <!-- <?//=site_url('fi_home/invoice_add')?> -->
    <form action="" method="POST" id="cform">
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

        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">

              <div class="box-header with-border">

                <div class="row">

                  <div class="col-sm-5 col-md-4">

                    <h3 class="uhead1">

                      Invoices

                    </h3>

                  </div>

                  <div class="col-sm-7 col-md-8">

                    <div class="pull-right">

                      <ul class="list-inline topul">

                        <li><a href="#" class="uhead2"> Main Menu </a></li>

                        <li><a href="#" class="uhead2"> Options </a></li>

                        <li><a class="btn btn-md btn-default btn-flat" data-toggle="modal" data-target="#modal-note" style="color: #fff;"><i class="fa fa-pencil-square-o"></i> Note</a></li>

                        <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

                      </ul>

                      <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a>

                      <a href="#" class="btn btn-md btn-info btn-flat">New Invoice</a>
                      <!-- <a href="<?php echo site_url('Fi_home/view_invoices') ?>" class="btn btn-md btn-info btn-flat">View Invoice</a> -->

                    </div>

                  </div>

                </div>

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <select class="form-control">
                        <?php foreach($custom as $customs) { ?>

                        <option value="<?php echo $customs['cus_id'] ?>"><?php print_r($customs['cus_lname']." - ". $customs['cus_company_name']); ?></option>
                      <?php } ?>
                      </select>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <select class="form-control">
                        
                        <option value="val">569 - 388 - 2534</option>

                      </select>

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

                 <!-- <div class="col-sm-1">
                         <button class="btn btn-xs btn-primary btn-flat">Save</button>
                       </div> -->

                </div>

                <div class="row">

                  <div class="col-md-12">

                    <div class="table-responsive" id="myinvoice">
                      <input type="hidden" name="new_invoice" value="new_invoice" class="form-control">
                      <table class="table   table-hover no-margin">

                        <thead>

                          <tr>

                            <th>#</th>

                            <th>Invoice No</th>

                            <th>Date</th>

                            <th>Due date</th>

                            <th>Event</th>

                          <!--   <th>Go</th> -->

                            <th>Contract Type</th>

                            <th>Discount</th>

                            <th>Sub Total</th>

                            <th>Tax</th>

                            <th>Amount</th>

                            <th>Paid</th>

                            <th>Balance Due</th>

                            <th>Status</th>

                            <th>Tax Rate</th>

                            <th>County</th>

                            <th>User</th>
                            <th></th>
                            <th>Action</th>

                          </tr>

                        </thead>

                        <thead>

                <?php

                $invoicesql=$this->db->query("SELECT * FROM invoices_create ORDER BY invoice_id ASC");

                $invoice_nrows=$invoicesql->num_rows();

                $chkinvsql=$this->db->query("SELECT * FROM invoices_create ORDER BY invoice_id DESC LIMIT 1");
                $isinvoicerow=$chkinvsql->row();



                if($invoice_nrows>0)
                {


                   //$i=1;
                 foreach ($invoicesql->result() as $invoicesql_dtls)
                  {

                     $invoiceId=$invoicesql_dtls->invoice_id;
                     $invoicedt=$invoicesql_dtls->invoice_date;
                     $invoiceduedt=$invoicesql_dtls->invoice_due_date;
                     $invoicetype=$invoicesql_dtls->invoice_type;
                     $contracttype=$invoicesql_dtls->invoice_contract_type;
                     $invdescnt=$invoicesql_dtls->invoice_discount;
                     $invsubtot=$invoicesql_dtls->invoice_sub_total;
                     $invtax=$invoicesql_dtls->invoice_tax;
                     $invamount=$invoicesql_dtls->invoice_amount;
                     $invpaid=$invoicesql_dtls->invoice_paid;
                     $invbaldue=$invoicesql_dtls->invoice_balance_due;
                     $invtaxrate=$invoicesql_dtls->invoice_tax_rate;
                     $invcntry=$invoicesql_dtls->invoice_county;
                     $invuser=$invoicesql_dtls->invoice_user;


                     if($invoicedt!="")
                     {

                        $invdate=$invoicedt;

                     }else{

                        $invdate=date('Y-m-d');
                     }


                     if($invoiceduedt!="")
                     {

                        $invduedate=$invoiceduedt;

                     }else{

                        $invduedate="";
                     }

                     if($invdescnt!="")
                     {
                        $setinvdescnt=$invdescnt;

                     }else{

                        $setinvdescnt="";
                     }

                    if($invsubtot!="")
                     {
                        $setinvsubtot=$invsubtot;

                     }else{

                        $setinvsubtot="";
                     }

                     if($invsubtot!="")
                     {
                        $setinvsubtot=$invsubtot;

                     }else{

                        $setinvsubtot="";
                     }


                     if($invtax!="")
                     {
                        $setinvtax=$invtax;

                     }else{

                        $setinvtax=""; //8.8%
                     }

                    if($invamount!="")
                     {
                        $setinvamount=$invamount;

                     }else{

                        $setinvamount="";
                     }


                     if($invpaid!="")
                     {
                        $setinvpaid=$invpaid;

                     }else{

                        $setinvpaid="";
                     }


                   if($invbaldue!="")
                     {
                        $setinvbaldue=$invbaldue;

                     }else{

                        $setinvbaldue="";
                     }

                    if($invtaxrate!="")
                     {
                        $setinvtaxrate=$invtaxrate;

                     }else{

                        $setinvtaxrate="";
                     }


                    if($invcntry!="")
                     {
                        $setinvcntry=$invcntry;

                     }else{

                        $setinvcntry="";
                     }


                    if($invuser!="")
                     {
                        $setinvuser=$invuser;

                     }else{

                        $setinvuser="";
                     }



                    if($isinvoicerow->invoice_id==$invoiceId)
                      {
                        $lstinvoiceid="fa-plus";
                        $lstinvoicecls="btn-success";
                        $fninvoce="fncrinvoice('".$invoiceId."')";

                      }else{

                        $lstinvoiceid="fa-minus";
                        $lstinvoicecls="btn-danger";
                        $fninvoce="fndelinvoice('".$invoiceId."')";

                      }



                  ?>

                        <tr class="tr_clone">

                          <!--   <td><?=$i?></td> -->
							   <td><a onclick="fngetinvoicedetails('<?=$invoiceId?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a></td>
                            <td><?=$invoicesql_dtls->invoice_id?></td>

                            <td><input type="date" name="invoice_date<?=$invoiceId?>" id="invoice_date<?=$invoiceId?>" class="form-control" value="<?=$invdate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_date')" >

                            </td>

                          <td><input type="date" name="invoice_due_date<?=$invoiceId?>" id="invoice_due_date<?=$invoiceId?>" class="form-control" value="<?=$invduedate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_due_date')"></td>

                            <td>

                             <select class="form-control" name="invoice_event_type<?=$invoiceId?>" id="invoice_event_type<?=$invoiceId?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_type')">
                                <option value="0">Select</option>
                                <?php

                                  $evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");

                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                       if($evntypsql_dtls->name==$invoicetype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }

                                ?>
                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->name?>"><?=$evntypsql_dtls->name?></option>

                              <?php }?>

                              </select>

                            </td>

                            <!-- <td><a href="#" class="btn btn-xs btn-success">
                              <i class="fa fa-arrow-right"></i></a>
                            </td> -->

                            <td>

                              <select class="form-control" name="invoice_contract_type<?=$invoiceId?>" id="invoice_contract_type<?=$invoiceId?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_contract_type')">
                                <option value="">Select</option>

                             <?php

                                  $evntypsql=$this->db->query("SELECT * FROM invoice_contract_type ORDER BY id ASC");

                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                       if($evntypsql_dtls->name==$contracttype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }

                                ?>
                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->name?>"><?=$evntypsql_dtls->name?></option>

                              <?php }?>


                              </select>

                            </td>

                            <td>
                              <div class="form-group">
                                  <div class="input-group">
                                      <span class="input-group-addon"><!-- <span class="glyphicon glyphicon-usd"></span> --></span>
                                  <input type="text" name="invoice_discount<?=$invoiceId?>" id="invoice_discount<?=$invoiceId?>" class="form-control" style="width: 40px;" value="<?=$setinvdescnt?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_discount')" >
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_sub_total<?=$invoiceId?>" id="invoice_sub_total<?=$invoiceId?>" class="form-control" style="width: 80px;" value="<?=$setinvsubtot?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_sub_total')" >
                                  </div>
                              </div>
                          </td>

                            <td>
                              <input type="text" name="invoice_tax<?=$invoiceId?>" id="invoice_tax<?=$invoiceId?>" class="form-control" style="width: 60px;" value="<?=$setinvtax?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_tax')" >
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_amount" class="form-control"style="width: 80px;" value="<?=$setinvamount?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_paid" class="form-control"style="width: 80px;" value="<?=$setinvpaid?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_balance_due" class="form-control"style="width: 80px;" value="<?=$setinvbaldue?>" disabled>
                                  </div>
                              </div>
                            </td>

                            <td><span class="label label-success">Pay</span></td>

                            <td><input type="text" name="invoice_tax_rate<?=$invoiceId?>" id="invoice_tax_rate<?=$invoiceId?>" class="form-control" value="<?=$setinvtaxrate?>" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_tax_rate')" ></td>

                            <td><input type="text" name="invoice_country<?=$invoiceId?>" id="invoice_country<?=$invoiceId?>" class="form-control" value="<?=$setinvcntry?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_county')" ></td>

                            <td><input type="text" name="invoice_user<?=$invoiceId?>" id="invoice_user<?=$invoiceId?>" class="form-control" value="<?=$setinvuser?>" style="width: 60px;" onchange="fnupdateinvoiceinfo(this.value,'<?=$invoiceId?>','invoice_user')"></td>

                            <!-- <td><button class="btn btn-xs btn-success"><i class="fa fa-floppy-o"></i> Save</button></td> -->
                            <!-- <td></td> -->
                            <td><a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true" ></i></a></td>

                            <td>

                          <button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?> tr_clone_add"><i class="fa <?=$lstinvoiceid?>"></i></button>

                          <!-- <button class="btn btn-xs btn-success tr_save_btn"><i class="fa fa-floppy-o"></i> Save</button> -->

                        </td>
                    </tr>

                    <?php  }

                }else{

                     echo "<tr><td colspan='17'>NO Invoice Found..!</td></tr>";
                }

                ?>

                        </tbody>

                      </table>

                    </div>

                    <!-- /.table-responsive -->

                  </div>

                </div>

              </div>

              <!-- /.box-body -->

            </div>






        <div class="mytabber">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <!--<li role="presentation" class="active"><a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">Invoices</a></li>-->
    <li role="presentation" class="active"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a></li>
    <li role="presentation"><a href="#terms" aria-controls="terms" role="tab" data-toggle="tab">Terms/Tasks (Optional)</a></li>
    <li role="presentation"><a href="#pickup" aria-controls="pickup" role="tab" data-toggle="tab">Pickup Info</a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes  </a></li>
    <li role="presentation"><a href="#associated" aria-controls="associated" role="tab" data-toggle="tab">Associated Order  </a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" id="divloadinvtabs">



  </div>
  <!--  End all tab section -->



</div>








       </section>

       <!-- /.content -->

     </div>

     </form>




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

                          <!-- <button class="btn btn-xs btn-success tr_save_btn"><i class="fa fa-floppy-o"></i> Save</button> -->

                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                <!-- /.table-responsive -->

              </div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->


    </div>
  </div>
</div>

<div  class="fadeMe" > <div id="loader" class="loader"></div> </div>



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



<!--     <script type="text/javascript">
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

  </script> -->

  <script>

  $(document).ready(function(){


  /*$("#itemPackageName").on("change", function(){

   var pid = $(this).val();
   // alert(pid);
   $.ajax({
       type: "POST",
       url: "<?php //echo base_url('fi_home/single_package_info'); ?>",
       data: {pid : pid},
       success: function(data)
       {
         var items = data;
          //console.log(items);
         var temp1 = new Array();
         temp1 = items.split("##");
         // alert(temp1[1]);

           document.getElementById("pri").value = temp1[2];

          var temp2 = new Array();
          temp2 = items.split("**");

          document.getElementById("i1").value = temp2[3];
          document.getElementById("i2").value = temp2[2];
        //   document.getElementById("i3").value = temp2[3];
          document.getElementById("i4").value = temp2[4];
          //  var temp3 = new Array();
          //  temp3 = items.split("$$");
          //
          //
          //
              //console.log(temp2);


          }


     });

  });*/

    // $("#quant").on("keyup change", function(){
    //   var q = $(this).val();
    //   // alert(q);
    //   var product = Number(item_price) * Number(q);
    //   var prod = product.toFixed(2);
    //   // alert(prod);
    //   document.getElementById('i_price').value = prod;
    //
    // });
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

<script>
var path = window.location;
var pathElements = path.toString().split("/");
if(pathElements[pathElements.length-1] == "")
{
	var lastFolder = pathElements[pathElements.length - 2];
}
else
{
	var lastFolder = pathElements[pathElements.length - 1];
//alert(lastFolder);
}

 var a = $(".sidebar").find('a[href *="'+lastFolder+'"]').parents(".treeview-menu").css({"display":"block"});

 var b =  $(".sidebar").find('a[href *="'+lastFolder+'"]').parents(".treeview").addClass("menu-open");


</script>


<!--  Create Invoice -->
  <script type="text/javascript">
     function fncrinvoice(invoiceid)
     {
        //alert("invoiceid--"+invoiceid);
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crnewinvoice')?>',
            data: {invoiceid:invoiceid},
            dataType: 'text',
            //cache: false,
           // async: false,
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
        //return false;
     }
  </script>

<!-- End Create Invoice -->


<!--  Delete Invoice -->
   <script type="text/javascript">
     function fndelinvoice(invoiceid)
     {
        //alert("invoiceid--"+invoiceid);
       event.preventDefault();

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

<!-- End Delete Invoice -->


<!--  Update Invoice -->
   <script type="text/javascript">
     function fnupdateinvoiceinfo(inptxtval,invoiceid,fieldnm)
     {

       event.preventDefault();

       //alert("invoiceid--"+invoiceid+" inptxtval--"+inptxtval+" fieldnm--"+fieldnm);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/updtinvoice')?>',
            data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
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

                    //fngetinvoicedetails(invoiceid);

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

<!-- End Update Invoice -->

<!--  Get Invoice Info -->
   <script type="text/javascript">
     function fngetinvoicedetails(invoiceid)
     {

       event.preventDefault();

       //alert("invoiceid--"+invoiceid);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fngetinvoiceinfo')?>',
            data: {invoiceid:invoiceid},
            dataType: 'html',
          // cache: false,
          //  async: false,
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

                //alert("data---"+data);

                  $('#divloadinvtabs').html(data);

                  $('.fadeMe').hide();

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


<!--  Get Invoice Info -->
   <script type="text/javascript">
     function fngetsinglepckinfo(pckId)
     {

       event.preventDefault();
      // alert("pckId--"+pckId);
        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fngetsignlepckinfo')?>',
            data: {pckId:pckId},
            dataType: 'json',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

               alert("data---"+JSON.stringify(data));
               var myobj=data.pckitemlist;
               alert("myobj--"+JSON.stringify(myobj));
               if(myobj!="")
                {

                	$('#pri').val(myobj.package_price);

                	$.each(myobj,function(){
                      $("#i1").val(myobj.item_quantity);
		              $("#i2").val(myobj.item_name);
		              $("#i3").val("");
		              $("#i4").val(myobj.item_price);
		              $("#i5").val(myobj.item_quantity*myobj.item_price);

		              $('.fadeMe').hide();
		            });

                }else{

                	  $('.fadeMe').hide();

                      $('#pri').val("");
                	  $("#i1").val("");
		              $("#i2").val("");
		              $("#i3").val("");
		              $("#i4").val("");
		              $("#i5").val("");
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

   <!-- End Get Invoice Info -->
