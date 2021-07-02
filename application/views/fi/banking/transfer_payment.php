<!DOCTYPE html>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ERP System | Transfer Payments</title>

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
        <li class="active">Transfer Payment</li>
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
                      Transfer Payment
                    </h3>
                  </div>

                </div>
              </div>


              <!-- <p class="uhead2">Balances as of</p>
              <div class="row space3">
                        <div class="col-md-4">
                          <div class="form-group">
                            <input type="date" class="form-control" id="cus_names" onfocusout="getDeposite(this.value);" >

                          </div>
                        </div>
                      </div> -->




      </div>



            <!-- <div class="box box-info"> -->
            <div class="">
              <div class="box-body">


         <!--  <form action="" method="POST" id="createvent" name="createvent"> -->
         <!-- <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo"> -->
                <div class="row">
                  <div class="col-md-12">
                <div class="row">
                  <!-- <div class="col-md-6">

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



                  </div> -->



                  <div class="col-md-12">

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

                            <th>date </th>
                            <th>From Account</th>
                            <th>To Account</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>User</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                       <!--  <tbody> -->
                <!--  Start event for loop  -->
                <thead>




                      <tr class="tr_clone ">
                        <form class="" >


                            <td> <input type="date" class="form-control dt" id="date" name="tdate"  > </td>

                              <td>
                                <div class="form-group">
                                  <select class="form-control " name="fromaccount" id="fromaccount" >
                                      <option value="0"> Select Account type </option>
                                      <?php foreach ($category as $key => $value): ?>
                                          <option  value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
                                      <?php endforeach; ?>

                                  </select>
                                </div>
                             </td>

                             <td>
                                <div class="form-group">
                                  <select class="form-control " name="toaccount" id="toaccount" >
                                      <option value="0"> Select Account type </option>
                                      <?php foreach ($category as $key => $value): ?>
                                          <option  value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
                                      <?php endforeach; ?>

                                  </select>
                                </div>
                             </td>

                             <td> <input type="amount" class="form-control" id="amount" name="amount"  > </td>
                             <td> <input type="note" class="form-control" id="note" name="note"  > </td>
                             <td> <input type="user" class="form-control" id="user" name="user"  > </td>
                             <td> <button class="btn btn-xs btn-success tr_clone_save" id="add" type="button" onclick="new_row_save();" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button></td>



                       </tr>

                       </form>



                   </thead>



                      </table>



                    </div>
                    </div>
                    <!-- /.table-responsive -->


                  </div>

                  <div class="col-md-12">

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

                            <th>date </th>
                            <th>From Account</th>
                            <th>To Account</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>User</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                       <!--  <tbody> -->
                <!--  Start event for loop  -->

                        <tbody id="table_data">

                        </tbody>
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

<script>


  function new_row_save() {

    var tdate          = $("input[name=tdate]").val();
    
    var e = document.getElementById("fromaccount");
var fromaccount = e.options[e.selectedIndex].value;

var c = document.getElementById("toaccount");
var toaccount = c.options[c.selectedIndex].value;
    var amount      = $("input[name=amount]").val();
    var note        = $("input[name=note]").val();
    var user       = $("input[name=user]").val();

    $.ajax({
      type:"POST",
      url:"<?=base_url('Fi_banking/transferPayment')?>",
      data:{tdate: tdate, fromaccount:fromaccount, toaccount:toaccount, amount:amount, note:note, user:user},
      dataType: 'text',
      success: function(result){
        console.log(result);
        // $(".transfer").html(result);
      }

    })
  }

</script>

<!-- <script>
$(document).ready(function(){
$("body").on("keydown", "#date, .dt", function(event){
 var key = event.keyCode;
 var temp_edate =  $(this).parents(".tr_clone").find(".dt");

    if(key=="107" || key=="187")
      {
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

          //$('#edate').val(today);
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
     {

        today = '<?=date("m/d/Y"); ?>';
        temp_edate.val(today);
       event.preventDefault();
     }else if(key=="8" || key=="46")
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
</script> -->
