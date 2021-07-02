

<!DOCTYPE html>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Enter Payables | Customer | ERP System</title>

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
        <li><a href="#">Customer</a></li>
        <li class="active">Deposit</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info banking_sec titlen_search">
            <div class="box-header with-border">
              <div class="row">
                <div class="col-sm-5 col-md-4">
                  <h3 class="uhead1"> Enter Payables </h3>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="defdate">
              <div class="form-group nospacerow">
                <div class="col-sm-6">
                  <label> Default Date</label>
                </div>

                <div class="col-sm-6">
                  <input type="text" class="form-control  ffdt" name="date_" id="date_to" tabindex="1" placeholder="mm/dd/yyyy" value="<?php echo date('m-d-Y');?>" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="">
      <div class="box-body">


         <!--  <form action="" method="POST" id="createvent" name="createvent"> -->
         <!-- <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo"> -->
                <div class="row">
                  <div class="col-md-12">

                    <div class="box box-info firstblock_bg ">

                      <div class="box-header with-border mb5">
                        <p class="uhead2">Enter Payables</p>
                        <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                        </div>
                      </div>


                    <div class="table-responsive" id="myevents">
                      <table class="table fixed_table mw1800  table-hover no-margin">

                        <thead>
                          <tr>
                            <th class="w30">#</th>
                            <th class="w60">Payment </th>
                            <th class="w150">Select Vendor </th>
                            <th class="w90">Date</th>
                            <th class="w90">Receipt#</th>
                            <th class="w150">Account</th>
                            <th class="w150">Type</th>
                            <th class="w90">CheckNum</th>
                            <th class="w180">SDesc </th>
                            <th class="w100">Amount </th>
                            <th class="w100">Credit </th>
                            <th class="w100">Date Cleared </th>
                            <th class="w100">Username</th>
                            <th class="">Notes</th>
                          </tr>
                        </thead>

                        <thead class="enter_payable "> </thead>

                        <thead>
                          <tr class="tr_clone">
                            <td>#</td>
                            <td><input type="text" placeholder="" id="" class="form-control" name="payment1"> </td>
                            <td>
                              <select class="form-control" id="cus_names" name="vendor1">
                                <option value="">Choose</option>
                                <?php
                                foreach($vendor_list as $row) { ?>
                                <option value="<?=$row['cus_id']?>"><?=$row['cus_fname']?> - <?=$row['cus_lname']?> - <?=$row['cus_company_name']?> </option>
                                <?php } ?>
                              </select>
                            </td>
                            <td> <input type="text" class="form-control dt1 td fdt cpy_def static" name="date_1" id="date_to" tabindex="1" placeholder="mm/dd/yyyy"> </td>
                            <td> <input type="text" placeholder="" id="" class="form-control text-center" name="receipt1"></td>
                            <td> <input type="text" placeholder="" id="" class="form-control" name="account1"> </td>
                            <td>
                              <select class="form-control" id="typr" name="type1">
                                <option value="">Choose</option>
                                <option data-value="Cash" value="Cash">Cash</option>
                                <option data-value="Check" value="Check">Check</option>
                                <option data-value="Electronic" value="Electronic">Electronic</option>
                                <option data-value="Mastercard" value="Mastercard">Mastercard</option>
                                <option data-value="Money Order" value="Money Order"> Money Order</option>
                                <option data-value="Visa" value="Visa">Visa</option>
                                <option data-value="Credit" value="Credit">Credit</option>
                              </select>
                            </td>
                            <td>  <input type="text" placeholder="" id="" name="checknum1" class="form-control text-center"> </td>
                            <td>  <input type="text" placeholder="" id="" name="sdesc1" class="form-control"> </td>
                            <td>  <input type="text" placeholder="" id="" name="amount1" class="form-control"> </td>
                            <td>  <input type="text" placeholder="" id="" name="credit1" class="form-control"> </td>
                            <td>  <input type="text" class="form-control dt1 td tdt cdt cpy_def custom_date cleardate" name="date_cleared1" id="date_to" tabindex="1" placeholder="mm/dd/yyyy"> </td>
                            <td>  <input type="text" class="form-control text-center"  value="<?= $this->session->fi_session['name']  ?>" readonly="">
                                  <input type="hidden" name="username1" value="<?=$this->session->fi_session['id']?>"> </td>
                            <td>  <input type="text" placeholder="" id="" name="notes1" class="form-control" onfocusout="enter_payable()"> </td>
                          </tr>

                    </thead>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="mytabber">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class=""><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab" aria-expanded="false">Charges  </a></li>
    <li role="presentation" class="active"><a href="#associated" aria-controls="associated" role="tab" data-toggle="tab" aria-expanded="true">Details </a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" id="divloadinvtabs">



 <!--  Tab: notes  -->
    <div role="tabpanel" class="tab-pane" id="notes">
        <div class="box box-default secondblock_bg ">

              <div class="box-header with-border">
                <p class="uhead2">Charges</p>
              </div>


              <div class="box-body">


              </div>
              <!-- endssss -->

            </div>
    </div>
 <!--  Tab: associated  -->
    <div role="tabpanel" class="tab-pane active" id="associated">
        <div class="box box-default secondblock_bg ">

                <div class="box-header with-border">

                  <p class="uhead2">Details </p>
                </div>

                <div class="box-body">
                  <!-- <form action="http://tech599.com/tech599.com/johnsum/erp_new/fi_notes/addcorrespondence" method="POST" id="dform"> -->


                   <div class="table-responsive">
                    <table class="table table-hover no-margin">
                    <thead>
                      <tr>
                          <th>Purchase#</th>
                          <th>Event</th>
                          <th>Amount</th>
                      </tr>
                   </thead>
                   <tbody id="dispinvnotes">

                      <tr class="tr_clone">

                        <td> <span style="height: 24px; display: inline-block;"></span>

                        </td>
                        <td>

                        </td>
                         <td>

                        </td>


                      </tr>

                     </tbody>
                  </table>
                </div>


                <div class="clearfix"></div>
              <!-- </form> -->

               </div>
             </div>
    </div>

      </div>
  <!--  End all tab section -->



</div>

</div>

                  <div class="col-sm-6">
                    <div class="liketabber">
                      <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-default btn-flat">Uncategorized</button>
                      <div class="box box-default thirdblock_bg">
                        <div class="box-header with-border">
                          <p class="uhead2">Details </p>
                        </div>

                        <div class="table-responsive mt10">
                          <table class="table table-hover no-margin">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                             <thead class="open_uncategorised"> </thead>

                            <tbody id="dispinvnotes">
                              <!-- <tr class="">
                                <td> # </td>

                                <td>
                                  <select class="form-control fcap" name="category1" tabindex="-1">
                                    <option value=""> Choose </option>
                                    <option value="Test1">Test1 </option>
                                    <option value="Test2">Test2 </option>
                                  </select>
                                </td>

                                <td>
                                  <select class="form-control fcap" name="sub_category1" tabindex="-1">
                                    <option value=""> Choose </option>
                                    <option value="Test1">Test1 </option>
                                    <option value="Test2">Test2 </option>
                                  </select>
                                </td>

                                <td>
                                  <input type="text" placeholder="" id="" name="un_amount1" class="form-control" onfocusout="open_uncategorised_insert()">
                                  <input type="hidden" placeholder="" id="" name="id_enter_payable" class="form-control" value="">

                                </td>
                              </tr> -->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</div>

<script type="text/javascript">

  $(document).ready(function() {
    enter_payable_display();
  });

  function enter_payable_display() {

  $.ajax({
            type: "POST",
            url: "<?=base_url('Fi_banking/enter_payable_display')?>",
            data: {},
            dataType: 'text',
            success: function(result){
                $(".enter_payable").html(result);
          }
        });
    }

    /*Save Data*/
    function enter_payable(){

      var payment      = $("input[name=payment1]").val();
      var vendor       = $("select[name=vendor1]").val();
      var date_        = $("input[name=date_1]").val();
      var receipt      = $("input[name=receipt1]").val();
      var account      = $("input[name=account1]").val();
      var type         = $("select[name=type1]").val();
      var checknum     = $("input[name=checknum1]").val();
      var sdesc        = $("input[name=sdesc1]").val();
      var amount       = $("input[name=amount1]").val();
      var credit       = $("input[name=credit1]").val();
      var date_cleared = $("input[name=date_cleared1]").val();
      var username     = $("input[name=username1]").val();
      var notes        = $("input[name=notes1]").val();



//console.log(username);

      $.ajax({
        type: "POST",
        url: "<?=base_url('Fi_banking/enter_payable')?>",
        data:{notes:notes, username:username, date_cleared:date_cleared, credit:credit, amount:amount, sdesc:sdesc, checknum:checknum, type:type, payment:payment, vendor:vendor, date_:date_, receipt:receipt, account:account},
        dataType: 'text',
        success: function(result) {

          $("input[name=payment1]").val("");
          $("select[name=vendor1]").val("");
          $("input[name=date_1]").val("");
          $("input[name=receipt1]").val("");
          $("input[name=account1]").val("");
          $("select[name=type1]").val("");
          $("input[name=checknum1]").val("");
          $("input[name=sdesc1]").val("");
          $("input[name=amount1]").val("");
          $("input[name=credit1]").val("");
          $("input[name=date_cleared1]").val("");
          $("input[name=username1]").val("");
          $("input[name=notes1]").val("");
          enter_payable_display();
        }


      })
    }


/*Save Data*/
    function enter_payable_update(id){

      console.log(id);

      var payment      = $("input[name=payment_"+id+"]").val();
      var vendor       = $("select[name=vendor_"+id+"]").val();
      var date_        = $("input[name=date__"+id+"]").val();
      var receipt      = $("input[name=receipt_"+id+"]").val();
      var account      = $("input[name=account_"+id+"]").val();
      var type         = $("select[name=type_"+id+"]").val();
      var checknum     = $("input[name=checknum_"+id+"]").val();
      var sdesc        = $("input[name=sdesc_"+id+"]").val();
      var amount       = $("input[name=amount_"+id+"]").val();
      var credit       = $("input[name=credit_"+id+"]").val();
      var date_cleared = $("input[name=date_cleared_"+id+"]").val();
      var username     = $("input[name=username_"+id+"]").val();
      var notes        = $("input[name=notes_"+id+"]").val();




      $.ajax({
        type: "POST",
        url: "<?=base_url('Fi_banking/enter_payable_update')?>",
        data:{id:id, notes:notes, username:username, date_cleared:date_cleared, credit:credit, amount:amount, sdesc:sdesc, checknum:checknum, type:type, payment:payment, vendor:vendor, date_:date_, receipt:receipt, account:account},
        dataType: 'text',
        success: function(result) {


         // enter_payable_display();
        }


      })
    }






    /*Date Function */
    //custom_date

    $("body").on("keydown", ".ffdt", function(event) {

      var key         = event.keyCode;
      var cls_nm      =  $(this).attr("class");
      var temp_edate  =  $(".ffdt");

      /* if(cls_nm.indexOf("fdt") !== -1) {

            var temp_edate =  $(this).parents(".tr_clone").find(".fdt");
        }
        else if(cls_nm.indexOf("cdt") !== -1){

            var temp_edate =  $(this).parents(".tr_clone").find(".cdt");
        } */

      if(key=="107" || key=="187") {

        var dtpls;
        if(temp_edate.val() == "") {
          dtpls= new Date();
        }
        else {
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
           console.log("str is", str);

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
                   $(".cpy_def").val(today);

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

    $(document).ready(function() {

      $("body").on("keydown", ".dt1", function(event) {

          var key = event.keyCode;
          var cls_nm =  $(this).attr("class");
          console.log(cls_nm);

        if(cls_nm.includes('static')) {
          console.log(1);
          var temp_edate =  $(this).parents(".tr_clone").find(".static");

        }
        else if(cls_nm.includes('cleardate')) {
          console.log(2);
          var temp_edate =  $(this).parents(".tr_clone").find(".cleardate");

        }else if(cls_nm.includes('dyna')) {
          console.log(3);
          var temp_edate =  $(this).parents(".dynamic").find(".dyna");


        }else if(cls_nm.includes('clear_dyn')) {
          console.log(4);
          var temp_edate =  $(this).parents(".dynamic").find(".clear_dyn");


        }


        if(key=="107" || key=="187") {

          var dtpls;

          if(temp_edate.val()=="") {

            dtpls= new Date();
          }
          else {

            dtpls= new Date(temp_edate.val());

          }

          dtpls.setDate( dtpls.getDate() + 1 );
          var mm = dtpls.getMonth() + 1;

          if(mm <10) {

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

                 /* $.ajax({
                  type: "POST",
                  url: "<?=base_url('Fi_banking/deposite_ajax')?>",
                  data: {},
                  dataType: 'text',
                  success: function(result){
                      $(".deposite").html(result);
                    }
                  });*/


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

   /*Selected Line Make yellow*/



        $(document).ready(function() {

            $('body').on('click','.dynamic',function() {

                $('.dynamic').removeClass('active-cust');
                $(this).addClass('active-cust');
                //console.log(".active-cust")
                //$(this).closest('tr').addClass('active-cust');
            });
        });




        function open_uncategorised(id) {

          var amount_total = $(".amount_total"+id).val();
console.log(amount_total);
          $.ajax({
            type: "POST",
            url: "<?=base_url('Fi_banking/open_uncategorised')?>",
            data:{id:id, amount_total:amount_total},
            dataType: 'text',

            success: function(result) {

              $("input[name=id_enter_payable]").val(id);
              $(".open_uncategorised").html(result);
              //enter_payable_display();
            }
          })
        }

        function open_uncategorised_insert() {



          var enter_payable_id    = $("input[name=id_enter_payable]").val();
          var category            = $("select[name=category1]").val();
          var sub_category        = $("select[name=sub_category1]").val();
          var un_amount           = $("input[name=un_amount1]").val();

          $.ajax({
            type: "POST",
            url: "<?=base_url('Fi_banking/open_uncategorised_insert')?>",
            data:{un_amount:un_amount, sub_category:sub_category, category:category, enter_payable_id:enter_payable_id},
            dataType: 'text',

            success: function(result) {

              $("select[name=category1]").val("");
              $("select[name=sub_category1]").val("");
              $("input[name=un_amount1]").val("");

              open_uncategorised(enter_payable_id);
            }
          })
        }

         function open_uncategorised_update(id) {

          //var enter_payable_id    = $("input[name=id_enter_payable]").val();
          var category            = $("select[name=category_"+id+"]").val();
          var sub_category        = $("select[name=sub_category_"+id+"]").val();
          var un_amount           = $("input[name=un_amount_"+id+"]").val();

          $.ajax({
            type: "POST",
            url: "<?=base_url('Fi_banking/open_uncategorised_update')?>",
            data:{un_amount:un_amount, sub_category:sub_category, category:category, id:id},
            dataType: 'text',

            success: function(result) {

           /*   $("select[name=category1]").val("");
              $("select[name=sub_category1]").val("");
              $("input[name=un_amount1]").val("");

              open_uncategorised(enter_payable_id);*/
            }
          })
        }
</script>
