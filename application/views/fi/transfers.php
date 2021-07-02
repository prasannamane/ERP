<!DOCTYPE html>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Transfers</title>

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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

 
  <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   

  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

<style type="text/css">
    
   .nospacerow div[class *= "col-"] {
      padding: 0 5px;
  }

  .form-group.nospacerow {
    margin: 0 -5px 10px -5px !important;
}

.nospacerow .form-control {
      background: #fff;
  }

textarea.form-control {
    height: 201px;
    font-size: 12px;
}

.secondblock_bg .btn {
    padding: 3px 15px;
    line-height: 1.2;
}

.secondblock_bg .form-control {
      background: #fff;
  }

.secondblock_bg .checkbox, .secondblock_bg .checkbox label {
    width: 100%;
    text-align: left;
    margin-left: 0;
    padding-left: 0;
}



.defdate {
    padding: 10px 10px 10px 10px;
    border: 1px solid #ccc;
    clear: both;
}

.form-group.nospacerow:after {
    display: table;
    clear: both;
    content: "";
}

.defdate .form-group.nospacerow {
    margin-bottom: 0 !important;
}

  </style>


</head>
 

 <div class="content-wrapper deposit_page" >
      <section class="content-header">
      <h1>Event Management </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Banking</a></li>
        <li class="active">Transfers</li>
      </ol>
    </section>      


      <section class="content">
        <!-- TABLE: LATEST ORDERS -->
        <div class="row">
          <div class="col-md-12">
             <div class="box box-info banking_sec titlen_search">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-sm-5 col-md-4">
                    <h3 class="uhead1">
                      Transfers
                    </h3>
                  </div>
                  
                </div>
              </div>

               <form action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/search_cus" method="POST" id="csearch">

                <ul class="searchwrap">
                  <li><span>Receipt #</span>
                      <div class=" dflex w160"> <input class="form-control" name="receipt_no1" tabindex="1" placeholder="Receipt #"> <input class="form-control" name="receipt_no2" tabindex="1" placeholder="Receipt #"></div>
                  </li>

                  <li><span>Check#</span>
                    <input class="form-control w100" name="receipt_no1" tabindex="1" placeholder="Check #">
                  </li>

                  <li><span>From</span>
                    <select class="form-control fcap w90" name="from" tabindex="-1">
                                 <option value="">From </option>
                                 <option value="">Test </option>
                                 <option value="">Test </option> 
                               </select>
                  </li>

                  <li><span>To </span>
                    <select class="form-control fcap w90" name="from" tabindex="-1">
                                 <option value="">To </option>
                                 <option value="">Test </option>
                                 <option value="">Test </option> 
                               </select>
                  </li>

                  <li><span>Amount </span>
                    <input class="form-control w60" name="amt" tabindex="1" placeholder="Amount"> 
                  </li>

                  <li><span>Deposit# </span>
                    <input class="form-control w60" name="deposit_no1" tabindex="1" placeholder="Deposit#"> 
                  </li> 

                  <li><span>Action</span>
                    <button class="btn btn-xs btn-default"><i class="fa fa-search"></i></button>
                  </li> 

                </ul>

        </form>

      </div>








            <!-- <div class="box box-info"> -->
            <div class="">




             
 <div class="box-body">


         <!--  <form action="" method="POST" id="createvent" name="createvent"> -->
         <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo">
                <div class="row">
                  <div class="col-md-12">

                    <div class="box box-info firstblock_bg ">

                      <div class="box-header with-border mb5">
                        <p class="uhead2">Transfers</p>
                        <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                        </div>
                      </div>


                    <div class="table-responsive" id="myevents">
                      <table class="table   table-hover no-margin fixed_table">
                        <thead>
                          <tr>
                            <th class="w90">Transfer#</th>                            
                            <th class="w90">date </th> 
                            <th class="w180">From Account</th>
                            <th class="w180">To Account</th>
                            <th class="w100">Amount</th>
                            <th>Note</th>
                            <th class="w150">User</th> 
                          </tr>
                        </thead>
                       <!--  <tbody> -->
                <!--  Start event for loop  -->
                <thead>
                
                           

              
                      <tr class="tr_clone "> 
                            <td> <span> </span> </td>
                            <td> <span> </span> </td>
                              
                              <td> 
                                <div class="form-group">
                                  <select class="form-control" id="cus_names"> 
                                    <option value=""> </option>
                                    <option value="">test</option>
                                    <option value="">test</option>
                                  </select>
                                </div>
                             </td>

                             <td> 
                                <div class="form-group">
                                  <select class="form-control" id="cus_names"> 
                                    <option value=""> </option>
                                    <option value="">test</option>
                                    <option value="">test</option>
                                  </select>
                                </div>
                             </td>


                             <td> <span></span> </td>
                             <td> <span></span> </td>
                             <td> <span></span> </td>

                              
                             
                       </tr> 

                       



                   </thead>



                      </table>



                    </div>
                    </div>



                    <!-- /.table-responsive -->
 




                  </div>



                </div>



<!-- group-outer -->
  

       <div class="row" id="btndispsave" style="display: block;">
          <div class="col-sm-12">
              <div class="btns text-center">
                  <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
                  <button name="Submit" id="Submit" class="btn btn-lg btn-info btn-flat">Save &amp; Continue</button>
                    <a onclick="fncleareventfrm()" class="btn btn-lg btn-default btn-flat">Cancel</a>
              </div>
            </div>
        </div>

    </form>

 </div>

</div></div></div></section>

         

 


  <!-- <script src="<?php //echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script> -->



  <!-- AdminLTE App -->

<!-- <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</div>