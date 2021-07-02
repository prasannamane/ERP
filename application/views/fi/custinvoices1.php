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
</style>

</head>

<body class="hold-transition skin-blue sidebar-mini">



    <!-- Content Wrapper. Contains page content -->
    <form action="<?=site_url('fi_home/invoice_add')?>" method="POST" id="cform">
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

                        <option value="val">Martinez, Timothy - 35 Temple Place</option>

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

                    <div class="table-responsive">
                      <input type="hidden" name="new_invoice" value="new_invoice" class="form-control">
                      <table class="table   table-hover no-margin">

                        <thead>

                          <tr>

                            <th>#</th>

                            <th>Invoices</th>

                            <th>Date</th>

                            <th>Due date</th>

                            <th>Event</th>

                            <th>Go</th>

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
                            <th></th>
                            <!-- <th>Action</th> -->

                          </tr>

                        </thead>

                        <tbody>

                          <tr>

                            <td>1</td>

                            <td><?php
                            // print_r($expression)
                            $total=$count[0]['count']+1;
                            print_r($total); ?></td>

                            <td><input type="date" name="invoice_date" id="invoice_date" class="form-control"></td>

                            <td><input type="date" name="invoice_due_date" class="form-control"></td>

                            <td>

                              <select class="form-control" name="invoice_event_type">

                                <option value="">Select</option>
                                <option value="test">Test</option>

                              </select>

                            </td>

                            <td><a href="#" class="btn btn-xs btn-success">
                              <i class="fa fa-arrow-right"></i></a>
                            </td>

                            <td>

                              <select class="form-control" name="invoice_contract_type">

                                <option value="">Select</option>
                                <option value="test">Test</option>

                              </select>

                            </td>

                            <td>
                              <div class="form-group">
                                  <div class="input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                  <input type="text" name="invoice_discount" class="form-control"style="width: 80px;">
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_sub_total" class="form-control"style="width: 80px;">
                                  </div>
                              </div>
                          </td>

                            <td>
                              <input type="text" name="invoice_tax" value="8.8%" class="form-control">
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_amount" class="form-control"style="width: 80px;">
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_paid" class="form-control"style="width: 80px;">
                                  </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="text" name="invoice_balance_due" class="form-control"style="width: 80px;">
                                  </div>
                              </div>
                            </td>

                            <td><span class="label label-success">Paid</span></td>

                            <td><input type="text" name="invoice_tax_rate" class="form-control"></td>

                            <td><input type="text" name="invoice_country" class="form-control"></td>

                            <td><input type="text" name="invoice_user" class="form-control"></td>
                            <!-- <td><button class="btn btn-xs btn-success"><i class="fa fa-floppy-o"></i> Save</button></td> -->
                            <!-- <td></td> -->
                            <td><a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true" ></i></a></td>
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

          <div class="col-md-12">

            <div class="box box-default">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
                <p class="uhead2">Items</p>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                  </button>

                </div>

                <!-- /.box-tools -->

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="row">
                	<div class="col-sm-3 ">

                <div class="table-responsive">

                  <table class="table table-hover no-margin nobg">

                    <thead>

                      <tr>
                        <th>Package Name</th>
                        <th>Price</th>
                      </tr>

                      <tr class="auto-index">

                        <td>
                        		<select class="form-control" name="item_package_name[]" id="itemPackageName">
                              <option value="">Select</option>
                              <?php foreach($all_packs as $items){ ?>
                                 <option value="<?php echo $items['package_id']; ?>"><?php echo $items['package_name']; ?></option>
                             <?php } ?>
                                <!-- <option value="">Select</option>
                                <option value="">Select</option>
                                <option value="">Select</option> -->
                              </select>

                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_price[]" id="pri" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                	 </div>
                 </div>


 

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Quantity</th>

                        <th>Item</th>

                        <th>Description</th>

                        <th>Amount</th>

                        <th>Total</th>

                        <th>Taxable</th>

                       <!-- <th>Included in Package</th>-->



                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone auto-index">

                        <td class="increment">1</td>

                        <td><input type="text" name="item_quantity[]" id="i1" class="form-control"></td>

                        <td><input type="text" name="item_name[]" id="i2" class="form-control"></td>

                        <td><input type="text" name="item_desc[]" id="i3" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_amount[]" id="i4" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="item_total[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td> <input type="checkbox" value="1" name="iteam_taxable[]"></td>

                       <!-- <td><input type="text" name="item_include_in_pacakge[]" class="form-control"></td>-->


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

              <!-- /.box-body -->

            </div>

            <!-- /.box -->

          </div>

          <!-- /.col -->

          <!-- Terms/Tasks -->

          <div class="col-md-12">

            <div class="box box-default collapsed-box">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_terms" value="invoice_terms" class="form-control">
                <p class="uhead2">Terms/Tasks <span class="text-danger">(Optional)</span></p>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>

                  </button>

                </div>

                <!-- /.box-tools -->

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>Time</th>

                        <th>Amount</th>

                        <th>Amount</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <td>

                          <select class="form-control">

                            <option>Select</option>

                          </select>

                        </td>

                        <td>

                          <select class="form-control">

                            <option>Select</option>

                          </select>

                        </td>

                        <td>$1000</td>

                      </tr>

                    </tbody>

                    <tfoot>

                      <tr>

                        <td colspan="3">

                          <button class="btn btn-xs btn-default pull-right">Remove Terms</button></td>

                        </tr>

                      </tfoot>

                    </table>

                  </div>

                  <!-- /.table-responsive -->

                  <hr>

                  <div class="table-responsive">

                    <table class="table table-hover no-margin">

                      <thead>

                        <tr>

                          <th>Date Started</th>

                          <th>Task</th>

                          <th>User</th>

                          <th>Due Date</th>

                          <th>Completed</th>

                          <th>Completed By</th>

                          <th>Completed Date</th>

                          <th>Note</th>

                          <th>Entered By</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td><input type="date" name="task_date[]" class="form-control"></td>

                          <td>

                           <!-- <select class="form-control" name="task_type[]">

                              <option>Select</option>
                              <option value="test">Test</option>

                            </select>-->
                            
                            <div class="dropdown dropdown_task ">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> Task 
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href="#">Task 1 </a></li>
                                  <li><a tabindex="-1" href="#">Task 2</a></li>
                                  <li class="dropdown-submenu">
                                    <a class="test" tabindex="-1" href="#">Task 3 <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <li><a tabindex="-1" href="#">Task 3-1 </a></li>
                                      <li><a tabindex="-1" href="#">Task 3-2 </a></li>
                                      <li class="dropdown-submenu">
                                        <a class="test" href="#">Task 3-3 <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                          <li><a href="#">Task 3-3-1</a></li>
                                          <li><a href="#">Task 3-3-2</a></li>
                                        </ul>
                                      </li>
                                    </ul>
                                  </li>
                                </ul>
                              </div>
  
  

                          </td>

                          <td>

                            <select class="form-control" name="task_user[]">

                              <option value="">Select</option>
                              <option value="Test">Test</option>

                            </select>

                          </td>

                          <td><input type="date" name="task_due_date[]" class="form-control"></td>

                          <td><div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"></label>
                          </div></td>

                          <td><input type="text" name="task_completed_by[]" class="form-control"></td>

                          <td><input type="date" name="task_completed_date[]" class="form-control"></td>

                          <td><input type="text" name="task_note[]" class="form-control"></td>

                          <td><input type="text" name="task_enter_by[]" class="form-control"></td>

                          <td></td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <!-- /.table-responsive -->

                </div>

                <!-- /.box-body -->

              </div>

              <!-- /.box -->

            </div>

            <!-- /.col -->



          <!-- Payments -->

          <!--<div class="col-md-12">

            <div class="box box-default collapsed-box">
              <input type="hidden" name="invoice_payment" value="invoice_payment" class="form-control">
              <div class="box-header with-border">

                <p class="uhead2">Payments</p>

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
                                <input type="text" name="payment_amount[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>



                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                          

                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

               

              </div>

               

            </div>

          

          </div>-->

          <!-- /.col -->



          <!-- Pickup Info -->

          <div class="col-md-12">

            <div class="box box-default collapsed-box">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_pickup_info" value="invoice_pickup_info" class="form-control">
                <p class="uhead2">Pickup Info</p>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>

                  </button>

                </div>

                <!-- /.box-tools -->

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Item</th>

                          <th>Description</th>

                          <th>Quantity</th>

                          <th>Picked up by</th>

                          <th>Pickup Date</th>

                          <th>Notes</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td>1</td>

                        <td><input type="text" name="pickup_item[]" class="form-control"></td>

                        <td><input type="text" name="pickup_desc[]" class="form-control"></td>

                        <td><input type="text" name="pickup_quantity[]" class="form-control"></td>

                        <td><input type="text" name="pickup_pickup_by[]" class="form-control"></td>

                        <td><input type="date" name="pickup_date[]" class="form-control"></td>

                        <td><input type="text" name="pickup_note[]" class="form-control"></td>

                        <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                          <!-- <button class="btn btn-xs btn-success tr_save_btn"><i class="fa fa-floppy-o"></i> Save</button> -->

                        </td>

                      </tr>

                    </thead>

                  </table>

                </div>

                <!-- /.table-responsive -->
                <input type="hidden" name="invoice_pickup_required" value="invoice_pickup_required" class="form-control">
                <p><strong>Pickup Required</strong></p>



                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Item</th>

                          <th>Quantity</th>

                          <th>Pickup</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td>1</td>

                        <td>

                          <select class="form-control" name="pickupreq_item[]">

                            <option value="">Select</option>
                            <option value="test">Test</option>

                          </select>

                        </td>

                        <td><input type="text" name="pickupreq_quantity[]" class="form-control"></td>

                        <td><input type="text" name="pickupreq_pickup[]" class="form-control"></td>

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

              <!-- /.box-body -->

            </div>

            <!-- /.box -->

          </div>

          <!-- /.col -->

          <!-- Pickup Required -->



          <!-- NOTES -->

          <div class="col-md-12">

            <div class="box box-default collapsed-box">

              <div class="box-header with-border">
                <input type="hidden" name="invoice_note" value="invoice_note" class="form-control">
                <p class="uhead2">NOTES</p>

                <div class="box-tools pull-right">

                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>

                  </button>

                </div>

                <!-- /.box-tools -->

              </div>

              <!-- /.box-header -->

              <div class="box-body">

                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                          <th>Date</th>

                          <th>Time</th>

                          <th>Type</th>

                          <th>Note</th>

                          <th>User</th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td>1</td>

                        <td><input type="date" name="note_date[]" class="form-control"></td>

                        <td><input type="time" name="note_time[]" class="form-control"></td>

                        <td><input type="text" name="note_type[]" class="form-control"></td>

                        <td><input type="text" name="note_note[]" class="form-control"></td>

                        <td><input type="text" name="note_user[]" class="form-control"></td>

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

              <!-- /.box-body -->

            </div>

            <!-- /.box -->

          </div>

          <!-- /.col -->

          <!-- ASSOCIATED ORDER -->

            <div class="col-md-12">

              <div class="box box-default collapsed-box">

                <div class="box-header with-border">
                  <input type="hidden" name="invoice_associated_order" value="invoice_associated_order" class="form-control">
                  <p class="uhead2">ASSOCIATED ORDER </p>

                  <div class="box-tools pull-right">

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>

                    </button>

                  </div>

                  <!-- /.box-tools -->

                </div>

                <!-- /.box-header -->

                <div class="box-body">


                <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th>#</th>

                        <th>Invoice</th>

                        <th>Name</th>

                        <th>Date Entered</th>

                        <th>Due Date</th>

                        <th>Contract type</th>

                        <th>Discount</th>

                        <th>Sub Total</th>

                        <th>Tax </th>

                        <th>Amount </th>

                        <th>Paid </th>

                        <th>Balance Due </th>

                        <th>Tax Rate </th>

                        <th>County </th>

                        <th>User </th>

                        <th>Action</th>

                      </tr>

                      <tr class="tr_clone">

                        <td class="increment">1</td>

                        <td><input type="text" name="associated_invoice[]" class="form-control"></td>

                        <td><input type="text" name="associated_name[]" class="form-control"></td>

                        <td><input type="date" name="associated_date_enter[]" class="form-control"></td>

                        <td><input type="date" name="associated_due_date[]" class="form-control"></td>

                        <td><input type="text" name="associated_contract_type[]" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_discount[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_sub_total[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td><input type="text" name="associated_tax[]" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_amount[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td><input type="text" name="associated_paid[]" class="form-control"></td>

                        <td>
                          <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                <input type="text" name="associated_balance_due[]" class="form-control"style="width: 80px;">
                              </div>
                          </div>
                        </td>

                        <td><input type="text" name="associated_tax_rate[]" class="form-control"></td>

                        <td><input type="text" name="associated_county[]" class="form-control"></td>

                        <td><input type="text" name="associated_user[]" class="form-control"></td>

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

               <!-- /.box-body -->

             </div>

             <!-- /.box -->

           </div>

           <!-- /.col -->

         </div>
          

         <div class="row">
        	<div class="col-sm-12">
            			<div class="btns text-center">
                        	<button class="btn btn-lg btn-info btn-flat">Save</button>
                            <a href="<?=site_url('fi_home/custinvoices/')?>" onclick="return confirm('Are you sure want to Clear all Data..??')" class ="btn btn-lg btn-default btn-flat">Cancel</a>
                        </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">Invoices</a></li>
    <li role="presentation"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a></li>
    <li role="presentation"><a href="#terms" aria-controls="terms" role="tab" data-toggle="tab">Terms/Tasks (Optional)</a></li>
    <li role="presentation"><a href="#pickup" aria-controls="pickup" role="tab" data-toggle="tab">Pickup Info</a></li>
    <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes  </a></li>
    <li role="presentation"><a href="#associated" aria-controls="associated" role="tab" data-toggle="tab">Associated Order  </a></li> 
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="invoices">invoices	...</div>
    <div role="tabpanel" class="tab-pane" id="items">items...</div>
    <div role="tabpanel" class="tab-pane" id="terms">terms...</div>
    <div role="tabpanel" class="tab-pane" id="pickup">pickup...</div>
    <div role="tabpanel" class="tab-pane" id="notes">notes...</div>
    <div role="tabpanel" class="tab-pane" id="associated">associated...</div> 
  </div>

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

  $(document).ready(function(){


  $("#itemPackageName").on("change", function(){

   var pid = $(this).val();
   // alert(pid);
   $.ajax({
       type: "POST",
       url: "<?php echo base_url('Fi_home/single_package_info'); ?>",
       data: {pid : pid},
       success: function(data)
       {
         var items = data;
          console.log(items);
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

  });

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