<!DOCTYPE html>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ERP System | Payments</title>

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

  <body class="hold-transition skin-blue sidebar-mini">

    

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Customer</a></li>

        <li class="active">Payments</li>

      </ol>

    </section>

        <section class="content">

          <!-- TABLE: LATEST ORDERS -->

          <div class="row">

            <div class="col-md-12">

              <div class="box box-info">

                <div class="box-header with-border">

                  <div class="row">

                    <div class="col-sm-5 col-md-4">

                      <h3 class="uhead1">

                        Payments

                      </h3>

                    </div>

                    <div class="col-sm-7 col-md-8">

                      <div class="pull-right">

                        <ul class="list-inline topul">

                          <li><a href="#" class="uhead2"> Main Menu </a></li>

                          <li><a href="#" class="uhead2"> Options </a></li>

                           <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>

                        </ul>

                        <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a>

                        <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Payment</a> -->

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

                        <table class="table table-hover no-margin">

                          <thead>

                            <tr>

                              <th>#</th>

                              <th>Payments</th>

                              <th>Date</th>

                              <th>Reciept</th>

                              <th>Type</th>

                              <th>Check Num</th>

                              <th>Desc</th>

                              <th>Amount</th>

                              <th>Credit</th>

                              <th>Username</th>

                              <th>Modes</th>

                              <th>Deposit</th>

                            </tr>

                          </thead>

                          <tbody>

                            <tr>

                             <td>1</td>

                              <td>2301</td>

                              <td></td>

                              <td>

                                <select class="form-control">

                                  <option>Select</option>

                                </select>

                              </td>

                              <td> <input class="form-control" type="text" placeholder=""></td>

                              <td> <input class="form-control" type="number" placeholder="1000906"></td>

                              <td><input class="form-control" type="text" placeholder="906"></td>

                              <td><input class="form-control w80" type="number" placeholder="$800"> <a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true"></i></a></td>

                              <td> </td>

                              <td>Levi</td>

                              <td></td>

                              <td>288</td>

                            </tr>

                          </tbody>

                          <tfoot>

                            <tr>

                              <th colspan="12">

                                <div class="pull-right">

                            <span class="text-info">Total Selected </span>

                            <input type="text" name="">

                          </div>

                          </th>

                          </tr>

                          </tfoot>

                        </table>

                      </div>

                      <!-- /.table-responsive -->

                    </div>

                    <!-- .col -->

                    <div class="col-md-12">

                      <div class="table-responsive">

                        <table class="table table-hover no-margin">

                          <thead>

                            <tr>

                              <th>Invoice</th>

                              <th>Amount</th>

                            </tr>

                          </thead>

                          <tbody>

                            <tr>

                             <td>1</td>

                              <td>2301</td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                      <!-- /.table-responsive -->

                    </div>

                    <!-- .col -->

                  </div>

                </div>

                <!-- /.box-body -->

              </div>

              <!-- /.box -->

            </div>

          </div>
          
          
        
<!-- Modal -->
  
<div class="modal fade payment_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Apply  Changes</h4>
      </div>
      <div class="modal-body">
       <div class="box-body">
				
                <div class="row">
                	<div class="col-sm-6">
                		<div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <td>Total Amount</td>

                          <td><input type="text" name="invoice_payment[]" class="form-control" value="$16.33"></td>  

                      </tr>
                      
                      
                       <tr>

                        <td>Total Amount</td>

                          <td><input type="text" name="invoice_payment[]" class="form-control" value="$0.00"></td>  

                      </tr>
                      
                       <tr>

                        <td>Total Amount</td>

                          <td><input type="text" name="invoice_payment[]" class="form-control" value="$16.33"></td>  

                      </tr>
                       

                    </thead>

                  </table>

                </div>
               		 </div>
                     
                     <div class="col-sm-6">
                		<div class="table-responsive">

                			  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <td>Name</td>

                          <td><input type="text" name="invoice_payment[]" class="form-control" value="Will Smith" placeholder="Will Smith"></td>  

                      </tr>
                      
                      
                       <tr>

                        <td>Address</td>

                          <td><input type="text" name="invoice_payment[]" class="form-control" value="35 Temple, Place" placeholder="35 Temple, Place"></td>  

                      </tr>
                      
                       <tr>

                        <td>Description</td>

                          <td><input type="text" name="invoice_payment[]" class="form-control" value="Check ID" placeholder="Check ID"></td>  

                      </tr>
                       

                    </thead>

                  </table> 

               			 </div>
                		<div class="mybtns">
                        	<a href="#" class="btn btn-xs btn-primary ">Finished</a>
                        	<a href="#" class="btn btn-xs btn-danger ">Remove All</a>
                        	<a href="#" class="btn btn-xs btn-primary ">Auto Apply</a>
                        </div>
                	
               		 </div>
                </div>
                
                
                    	<div class="box box-primary mt20">
							<p class="uhead2 pt10">Payment Applied To</p>
                        <div class="box-body">
            				
                            <div class="table-responsive">
                           	<table class="table table-hover no-margin">

                                <thead>
            
                                  <tr>
            
                                    <th>Invoice#</th>
            
                                      <th>Remove</th>
            
                                      <th>Applied</th>
            
                                      <th>Event</th>
            
                                      <th>Due Date</th>
            
                                      <th>Amount</th>
            
                                    <th>Paid</th>
                                    
                                     <th>Balance Due</th>
            
                                  </tr>
            						
                                    <tr>
            
                                    <td>2301</td>
            
                                    <td><a href="#" class="btn btn-xs btn-danger "> Remove</a></td>
            
                                      <td> </td>
            
                                      <td><select class="form-control">

                                              <option value="val">Will Smith Wedding 1/24/18 6:30 PM</option>
                    
                                            </select></td>
            
                                      <td><input type="text" name="invoice_payment[]" class="form-control" value="5/12/2011"></td>
            
                                      <td><input type="text" name="invoice_payment[]" class="form-control" value="$16.33"></td>
            
                                    <td><input type="text" name="invoice_payment[]" class="form-control" value="$0.00"></td>
                                    
                                     <td><input type="text" name="invoice_payment[]" class="form-control" value="$16.33"></td>
            
                                  </tr>
                                  
                                  
                                  
            
                                </thead>
            
                              </table>
            				</div>
                          <!-- /.box -->
            
                        </div>
                      </div>
                      
                      
                      
                      
                      
                      
                      
                      <div class="box box-primary mt20">
							<p class="uhead2 pt10">Apply Payment  To</p>
                        <div class="box-body">
            				
                            <div class="table-responsive">
                           	<table class="table table-hover no-margin">

                                <thead>
            
                                  <tr>
            
                                    <th>Invoice#</th>
            
                                      <th>Click</th>
            
                                      <th>Apply</th>
            
                                      <th>Event</th>
            
                                      <th>Due Date</th>
            
                                      <th>Amount</th>
            
                                    <th>Paid</th>
                                    
                                     <th>Balance Due</th>
            
                                  </tr>
            
                                  
                                  <tr>
            
                                    <td>2301</td>
            
                                      <td><a href="#" class="btn btn-xs btn-primary "> Apply</a></td>
            
                                      <td> </td>
            
                                      <td><select class="form-control">

                                              <option value="val">Will Smith Wedding 1/24/18 6:30 PM</option>
                    
                                            </select></td>
            
                                      <td><input type="text" name="invoice_payment[]" class="form-control" value="5/12/2011"></td>
            
                                      <td><input type="text" name="invoice_payment[]" class="form-control" value="$16.33"></td>
            
                                    <td><input type="text" name="invoice_payment[]" class="form-control" value="$0.00"></td>
                                    
                                     <td><input type="text" name="invoice_payment[]" class="form-control" value="$16.33"></td>
            
                                  </tr>
                                  
            
                                </thead>
            
                              </table>
            				</div>
                          <!-- /.box -->
            
                        </div>
                      </div>
                      
                      
                   
                

                <!-- /.table-responsive -->

              </div>
      </div>
      
      
      
    </div>
  </div>
</div>


 
          
          
          
          
          
          
          
          
          

        </section>

        <!-- /.content -->

      </div>

      <!-- /.content-wrapper -->

      <!-- Main Footer -->



    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->



<script>
	function displayPyramid(n) {
  for (var i = 1; i <= n; i++) {
    var str = '';
   // for (var j = 1; j < n-i; j++) {
//      str = str + ' ';
//    }
    for (var k = 1; k <= i; k++) {
      str = str + '*';
    }
    //console.log(str);
  }
}

displayPyramid(3);


</script>