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



</head>



<body class="hold-transition skin-blue sidebar-mini ">







    <!-- Content Wrapper. Contains page content -->

    <form>

    <div class="content-wrapper custinvoices_view">



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



        <div class="row">



          <div class="col-md-12">



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



                         <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>



                      </ul>



                      <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a>



                      <a href="#" class="btn btn-md btn-info btn-flat">New Invoice</a>

                      <!-- <a href="custinvoices_view.php" class="btn btn-md btn-info btn-flat">View Invoice</a> -->



                    </div>



                  </div>



                </div>



              </div>



              <!-- /.box-header -->



              <div class="box-body">




                <div class="row">



                  <div class="col-md-12">



                    <div class="table-responsive">

                      <input type="hidden" name="new_invoice" value="new_invoice" class="form-control">

                      <table class="table   table-hover no-margin mytable table-striped">
                        <thead>
                          <tr >
                            <th>#</th>
                            <th>Invoices</th>
                            <th>Date</th>
                            <th>Due date</th>
                            <th>Event</th>
                            <th>Contract Type</th>
                            <th>Discount</th>
                            <th>Sub Total</th>
                            <th>Tax</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Balance Due</th>
                            <th>Pay</th>
                            <th>Tax Rate</th>
                            <th>County</th>
                            <th>User</th>
                             <th>Action</th>
                          </tr>



                        </thead>
                        <tbody>
                          <?php foreach ($invoices as $invoice) { ?>
                            <tr class="invoceview" >
                              <td><?php echo $invoice['invoice_id']; ?></td>
                              <td><?php echo $invoice['invoice_name']; ?></td>
                              <td><?php echo $invoice['invoice_date']; ?></td>
                              <td><?php echo $invoice['invoice_due_date']; ?></td>
                              <td><?php echo $invoice['invoice_type'];?></td>
                              <td><?php echo $invoice['invoice_contract_type'];?> </td>
                              <td><?php echo $invoice['invoice_discount']; ?> </td>
                              <td><?php echo $invoice['invoice_sub_total']; ?></td>
                              <td><?php echo $invoice['invoice_tax']; ?>  </td>
                              <td><?php echo $invoice['invoice_amount']; ?></td>
                              <td><?php echo $invoice['invoice_paid']; ?> </td>
                              <td><?php echo $invoice['invoice_balance_due']; ?></td>
                              <td><span class="label label-success">Paid</span></td>
                              <td><?php echo $invoice['invoice_tax_rate']; ?></td>
                              <td><?php echo $invoice['invoice_county']; ?></td>
                              <td><?php echo $invoice['invoice_user']; ?></td>
                              <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>

                            </tr>
                          <?php } ?>
                          <tr class="invoceview" >
                            <td>1</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $1200 </td>
                            <td>   $00   </td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name</td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>

                          </tr>


                          <tr class="invoceview" >
                            <td>2</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>

                            <tr class="invoceview" >
                            <td>3</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>

                            <tr class="invoceview" >
                            <td>4</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>

                           <tr class="invoceview" >
                            <td>5</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>

                          <tr class="invoceview" >
                            <td>6</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>


                           <tr class="invoceview" >
                            <td>7</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $1200 </td>
                            <td>   $00   </td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name</td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>


                          <tr class="invoceview" >
                            <td>8</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>


                           <tr class="invoceview" >
                            <td>9</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $1200 </td>
                            <td>   $00   </td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name</td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>


                          <tr class="invoceview" >
                            <td>10</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>

                          <tr class="invoceview" >
                            <td>11</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $1200 </td>
                            <td>   $00   </td>
                            <td><span class="label label-success">Paid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name</td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>


                          <tr class="invoceview" >
                            <td>12</td>
                            <td>Invoice </td>
                            <td>03/18/2019</td>
                            <td>09/18/2019</td>
                            <td> Event 1</td>
                            <td>Contract type 1 </td>
                            <td> $100 </td>
                            <td>  $ 1000 </td>
                            <td>  8.8%  </td>
                            <td> $1200 </td>
                            <td> $600 </td>
                            <td>   $600   </td>
                            <td><span class="label label-warning">Unpaid</span></td>
                            <td>6%</td>
                            <td>County Name</td>
                            <td>User Name </td>
                            <td><button class="btn btn-xs btn-primary "><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis"><i class="fa fa-minus"></i></button> </td>
                          </tr>

                        </tbody>



                      </table>



                    </div>



                    <!-- /.table-responsive -->



                  </div>



                </div>



              </div>



              <!-- /.box-body -->



            </div>



            <!-- /.box -->



          </div>



          <!-- Items -->











          <!-- /.col -->







          <!-- Pickup Info -->







          <!-- /.col -->



          <!-- Pickup Required -->







          <!-- NOTES -->







          <!-- /.col -->



          <!-- ASSOCIATED ORDER -->

           <!-- /.col -->



         </div>


       </section>



       <!-- /.content -->



     </div>



     </form>

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


<script>
	$(document).on("click", ".invoceview", function(){
			if($(this).hasClass("added")){
				$(this).removeClass("added");
				$(this).siblings(".item_tr").slideUp(500).remove();
			}else{
				$(this).addClass("added");
				$(this).siblings(".item_tr").slideUp(500).remove();
			  $('<tr class="item_tr"><td >1.</td> <td> 3</td> <td> Item Name</td> <td> Item Description</td><td> $ 1200 </td><td> $ 1200 </td><td> Yes </td><td> Package Name </td><td> $ 1200 </td><td><button class="btn btn-xs btn-primary " ><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis" ><i class="fa fa-minus"></i></button> </td></tr><tr class="item_tr"><td >2.</td> <td> 6</td> <td> Item Name</td> <td> Item Description</td><td> $ 1200 </td><td> $ 1200 </td><td> Yes </td><td> Package Name </td><td> $ 1200 </td><td><button class="btn btn-xs btn-primary " ><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis" ><i class="fa fa-minus"></i></button> </td></tr><tr class="item_tr"><td >3.</td> <td> 9</td> <td> Item Name</td> <td> Item Description</td><td> $ 1200 </td><td> $ 1200 </td><td> Yes </td><td> Package Name </td><td> $ 1200 </td><td><button class="btn btn-xs btn-primary " ><i class="fa fa-pencil"></i></button>  <button class="btn btn-xs btn-danger removethis" ><i class="fa fa-minus"></i></button> </td></tr>').insertAfter(this).slideDown(500);
			}

		});

		$(document).on("click", ".removethis", function(){
			  $(this).closest("tr").remove();
		});
</script>




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
