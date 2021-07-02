<!DOCTYPE html>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP System | Deposit</title>

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

    #myevents th:nth-last-child(3) {
    width: initial;
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
                <h3 class="uhead1">Deposits</h3>
              </div>
            </div>
          </div>

          <form action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/search_cus" method="POST" id="csearch">
            <ul class="searchwrap">
             <!--  <li>
               <span>Receipt #</span>
                 <div class=" dflex w200">
                   <input type="number" class="form-control w100" name="receipt_from"    id="receipt_from"   tabindex="1" placeholder="Receipt from" >
                   <input type="number" class="form-control w100" name="receipt_to"      id="receipt_to"     tabindex="1" placeholder="Receipt to">
                 </div>
               </li> -->

                <!-- <li>
                  <span>Check#</span>
                  <input type="number" class="form-control w100" name="check" id="check" tabindex="1" placeholder="Check #">
                </li> -->

                <li>
                  <span>Date From</span>
                  <input type="text" class="form-control w100 fdt dt" name="" id="date_from" tabindex="1" placeholder="Date from #">
                </li>

                <li>
                  <span>Date To </span>
                  <input type="text" class="form-control w100 tdt dt" name="date" id="date_to" tabindex="1" placeholder="Date to #">
                </li>

                <li>
                  <span>Amount </span>
                  <input type="number" class="form-control w100" name="amt" id="amount" tabindex="1" placeholder="Amount">
                </li>

                <li>
                  <span>Deposit# </span>
                              <input type="number" class="form-control w100" name="deposit_no1" id="deposite" tabindex="1" placeholder="Deposit#">
                        </li>

                            <li>
                                <span>Action</span>
                                <button type="button" class="btn btn-xs btn-default" onclick="topSearch()"><i class="fa fa-search"></i></button>
                          </li>

                            <li>
                                <span>Action</span>
                                <button type="reset" class="btn btn-xs btn-default" ><i class="fa fa-times"></i></button>
                          </li>
                        </ul>
                    </form>
        </div>

        <div class="">
          <div class="box-body">

            <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo">
                <div class="row">
                  <div class="col-md-12">

                    <div class="box box-info firstblock_bg ">

                      <div class="box-header with-border mb5">
                        <p class="uhead2">Deposits</p>
                        <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                        </div>
                      </div>


                    <div class="table-responsive" id="myevents">
                      <table class="table table-hover no-margin searchwrap fixed_table">
                        <thead>
                          <tr>
                            <th class="w50">Dep # </th>
                            <th class="w90"> Deposit Date </th>
                            <th class="w90">Account</th>
                            <th class="w90">Deposit Type</th>
                            <th class="w80">Amount</th>
                            <th  class="w95">View Payments</th>
                            <th class="w90">Payments</th>
                            <th class="w90"> Date Cleared </th>
                            <th>Note</th>
                            <th class="w60">User</th>
                            <th class="w85">Entry Date</th>
                            <!-- <th class="w50">Action</th>  -->
                          </tr>
                        </thead>
                       <!--  <tbody> -->
                <!--  Start event for loop  -->

                      <thead class="deposite"></thead>



                      </table>



                    </div>
                    </div>



                    <!-- /.table-responsive -->






                  </div>



                </div>







            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script type="text/javascript">

   /*<!--Selected Line Make yellow-->*/



        $(document).ready(function() {

            $('body').on('click','.trshowcust',function() {

                $('.trshowcust').removeClass('active-cust');
                $(this).addClass('active-cust');
                //$(this).closest('tr').addClass('active-cust');
            });
        });

  //On load display all data list

  deposite_ajax();

  function deposite_ajax(){
    var payId = 1;
    $.ajax({
      type: "POST",
      url: "<?=base_url('Fi_banking/deposite_ajax')?>",
      data: {payId:payId},
      dataType: 'text',

      success: function(result){
        $(".deposite").html(result);
      }
    });
  }


  /*amount update/ Save*/
  function amout_save(id) {

    var amout_save = $(".amout_save_input"+id).val();

    var e = document.getElementById("account");
    var account = e.options[e.selectedIndex].value;

    if(account==0)
    {
      alert('please Select Bank Account');
       return;
    }

    var c = document.getElementById("dep_type");
    var dep_type = c.options[c.selectedIndex].value;

    if(dep_type==0)
    {
      alert('please Select Deposite Type');
       return;
    }
    //alert(1);
    $.ajax({
      type: "POST",
      url: "<?=base_url('Fi_banking/amout_save')?>",
      data: {id:id, amout_save:amout_save,account_type:account,deptype:dep_type},
      dataType: 'text',
      success: function(result) {
        $(".deposite").html(result);
        }
      });
  }

/*Create new Row for deposite table*/
  function new_row_save() {

    var note          = $("input[name=note]").val();
    var account       = $("input[name=account]").val();
    var deposit_date  = $("input[name=deposit_date]").val();
    var dep_type      = $("input[name=dep_type]").val();
    var amount        = $("input[name=amount]").val();
    var payment       = $("input[name=payment]").val();
    var cleared_date  = $("input[name=cleared_date]").val();
    var entry_date    = $("input[name=entry_date]").val();
    var username      = $("input[name=username]").val();



    $.ajax({
      type:"POST",
      url:"<?=base_url('Fi_banking/new_row_save')?>",
      data:{note: note, account:account, deposit_date:deposit_date, dep_type:dep_type, amount:amount, payment:payment, cleared_date:cleared_date, entry_date:entry_date, username:username},
      dataType: 'text',
      success: function(result){
        $(".deposite").html(result);
      }

    })
  }



  /*Save date data in database*/
  function date_save(id) {

    //alert($(".date_save").val());
    var e = document.getElementById("account");
    var account = e.options[e.selectedIndex].value;

    if(account==0)
    {
      alert('please Select Bank Account');
       return;
    }

    var c = document.getElementById("dep_type");
    var dep_type = c.options[c.selectedIndex].value;

    if(dep_type==0)
    {
      alert('please Select Deposite Type');
       return;
    }

    $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_banking/date_save')?>",
                data: {id:id, date_save:$(".date_save_"+id).val(),account_type:account,deptype:dep_type},
                dataType: 'text',

                success: function(result) {
                   //deposite_ajax();
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



   /* <!--Delete payment value-->*/


    function delete_row(vals) {

      if(confirm("Are you sure! want to delete.")) {
            $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_banking/delete_deposit_ajax')?>",
                data: {vals:vals},
                dataType: 'text',

                success: function(result){
                    selectreceivables_ajax();
                    alert("Deleted Payment statement");

                }

            });
        }
    }


    /*<!--Search for top bar-->*/
    function topSearch(id) {

      var amount          = $('#amount').val();
      var deposite_num    = $('#deposite').val();
      var date_to         = $('#date_to').val();
      var date_from       = $('#date_from').val();

      $.ajax({
              type: "POST",
              url: "<?=base_url('Fi_banking/deposite_ajax')?>",
              data: {amount:amount, deposite_num:deposite_num, date_to:date_to, date_from:date_from  },
              dataType: 'text',
              success: function(result){
                $(".deposite").html(result);
              }
        });
      }


</script>
<script>
$(document).ready(function(){
$("body").on("keydown", "#date_to, .dt", function(event){
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
</script>
