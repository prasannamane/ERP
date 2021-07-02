<!DOCTYPE html>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Balance</title>

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

  .firstblock_bg  .form-control {
      background: #fff;
  }



  </style>


</head>


 <div class="content-wrapper deposit_page" >
      <section class="content-header">
      <h1>Event Management </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Customer</a></li>
        <li class="active">Deposit</li>
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
                      View Balances
                    </h3>
                  </div>

                </div>
              </div>


              <p class="uhead2">Balances as of</p>
              <div class="row space3">
                        <div class="col-md-4">
                          <div class="form-group">
                            <input type="date" class="form-control" id="cus_names" onfocusout="getDeposite(this.value);" >

                          </div>
                        </div>
                      </div>




      </div>



            <!-- <div class="box box-info"> -->
            <div class="">





              <div class="box-body">


         <!--  <form action="" method="POST" id="createvent" name="createvent"> -->
         <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo">
                <div class="row">
                  <div class="col-md-12">




                    <!-- /.table-responsive -->



                <div class="row">
                  <div class="col-md-6">

                    <div class="box box-info firstblock_bg ">

                      <div class="box-header with-border mb5">
                        <p class="uhead2">Balances</p>
                        <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                        </div>
                      </div>


                    <div class="table-responsive" id="myevents">
                      <table class="table   table-hover no-margin">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>Current Balance</th>
                            <th>Difference</th>

                          </tr>
                        </thead>
                <thead class="my_res">

                      <tr >

                            <td> <span style="height: 24px; display: inline-block;"> </span> </td>
                            <td> <span></span> </td>
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



                  <div class="col-md-6">

                    <div class="box box-info secondblock_bg ">

                      <div class="box-header with-border mb5">
                        <p class="uhead2">Transfer</p>
                        <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                        </div>
                      </div>


                    <div class="table-responsive" id="myevents">
                      <table class="table   table-hover no-margin">
                        <thead>
                          <tr>
                            <th>Transfer#</th>
                            <th>date </th>
                            <th>From Account</th>
                            <th>To Account</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>User</th>
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








                  </div>



                </div>



<!-- group-outer -->


    <!--    <div class="row" id="btndispsave" style="display: block;">
          <div class="col-sm-12">
              <div class="btns text-center">
                  <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
                  <button name="Submit" id="Submit" class="btn btn-lg btn-info btn-flat">Save &amp; Continue</button>
                    <a onclick="fncleareventfrm()" class="btn btn-lg btn-default btn-flat">Cancel</a>
              </div>
            </div>
        </div> -->

    </form>

 </div>

</div></div></div></section>



    </div>


  <!-- <script src="<?php //echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script> -->



  <!-- AdminLTE App -->

<!-- <script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
function getDeposite(date) {


  $.ajax({
              type: "POST",
              url: "<?=base_url('Fi_banking/getDepositeByDate')?>",
              data: {date:date},
              dataType: 'text',

              success: function(result) {
                 //deposite_ajax();
                 //console.log(result);
                 $(".my_res").html(result);
              }
    });
  }

/*<!--Selected Line Make yellow-->*/
$(document).ready(function() {

  $('body').on('click','.trshowcust',function() {

    $('.trshowcust').removeClass('active-cust');
    $(this).addClass('active-cust');
    //$(this).closest('tr').addClass('active-cust');
    });
  });

</script>
