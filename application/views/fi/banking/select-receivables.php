<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ERP System | Select Receivables</title>
        
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
    
            /*.secondblock_bg .btn {
                padding: 3px 15px;
                line-height: 1.2;
            }*/
    
            .secondblock_bg .form-control {
                background: #fff;
            }
            
            .intro{
                background: #f1eea0 !important;
            }
    
            /*.secondblock_bg .checkbox, .secondblock_bg .checkbox label {
                width: 100%;
                text-align: left;
            }
            */

            .count_val{ font-size: 14px; line-height: 1; }
    
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
                                <h3 class="uhead1"><?=$title?></h3>
                            </div>
                        </div>
                    </div>

                    <?php if($id_deposit == 0 ){ ?>

                    <form action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/search_cus" method="POST" id="csearch">
                        <ul class="searchwrap">
                            <li>
                                <span>Receipt #</span>
                                <div class=" dflex w200"> 
                                    <input type="number" class="form-control w100" name="receipt_from"    id="receipt_from"   tabindex="1" placeholder="Receipt from" > 
                                    <input type="number" class="form-control w100" name="receipt_to"      id="receipt_to"     tabindex="1" placeholder="Receipt to">
                                </div>
                        	</li>
        
	                        <li>
	                                <span>Check#</span>
	                                <input type="number" class="form-control w100" name="check" id="check" tabindex="1" placeholder="Check #">
	                    	</li>
        
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
                <?php } ?>
                </div>
            
            <div class="">
                <div class="box-body">
                    
                    <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-info firstblock_bg ">
                                    <div class="box-header with-border mb5">
                                        <p class="uhead2">Deposit</p>
                                        <div class="box-tools pull-right"> 
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                                        </div>
                                    </div>

                                    <div class="depwrap">

		                        <div class="row">

                                    <?php if($id_deposit == 0 ){ ?> 

		                          <div class="col-sm-3">
		                              <select class="form-control" name="deposite" >
		                                <option value="">Select Item</option>
		                                <option value="Empty" >Empty</option>
		                                <option value="Amex" >Amex </option>
		                                <option value="Cash" >Cash</option>
		                                <option value="Check" >Check</option>
		                                <option value="Credit" >Credit</option>
		                                <option value="Credit Card" >Credit Card</option>
		                                <option value="Electronic" >Electronic</option>
		                                <option value="Groupon" >Groupon</option>
		                                <option value="Master Card" >Master Card</option>
		                                <option value="Merchants" >Merchants</option>
		                                <option value="Money Order" >Money Order  </option>
		                              </select>
		                          </div>

		                          <div class="col-sm-3">
		                            <div class="checkbox">
		                                <label><input type="checkbox" class="include_deposited" name="bookedcheck"  onclick="include_deposited($(this))">Include Deposited</label>
		                              </div>
		                          </div>
		                          <?php } ?>
		                        

		                          <div class="col-sm-6">
		                               <div class="table-responsive">
		                                <table class="table table-hover no-margin">
		                                  <thead>
		                                    <tr>
		                                      <th>#</th>                            
		                                      <th>Type</th>
		                                      <th>Amount</th>
		                                      <th>Count</th>
		                                      <?php if($id_deposit == 0 ){ ?> <th>Select</th> <?php } ?> 
		                                       
		                                    </tr>
		                                  </thead> 
		                                <thead class="total_data">  
		                                <tr class="tr_clone ">  
		                                      <!-- <td> <span> &nbsp;</span> </td>
		                                      <td> <span>Quickpay</span> </td>
		                                      <td> <span>$3936576</span> </td>
		                                      <td> <span>58</span> </td>
		                                      <td><input type="checkbox" onClick="toggle(this)" /><span> <a href="#">Select</a></span> </td>   -->
		                                 </tr>  
		                             </thead> 
		                                </table> 
		                              </div>
		                          </div>
		                        </div>

                      
                      </div>
                                </div>
                                
                                <div class="box box-info secondblock_bg ">
                      <div class="box-header with-border mb5">
                        <p class="uhead2">Select Receivables</p>
                        <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                        </div>
                      </div>


                    <div class="table-responsive" id="myevents">
                        <table class="table   table-hover no-margin fixed_table mw1700">
                            <thead>
                                <tr>
                                    <th class="w30">#   </th>
                                    <?php if($id_deposit == 0 ){ ?> <th class="w40"><span class="inblock">Select</span></th><?php } ?> 
                                    <th class="w80">Cust a/c # </th>
                                    <th class="w140">    First Name  </th>
                                    <th class="w140">    Last Name   </th>
                                    <th class="w140">Company</th>
                                    <th class="w90">Date</th>
                                    <th class="w90">    Amount  </th>
                                    <th class="w100">Type </th>
                                    <th class="w130">    CheckNum </th>
                                    <th class="w130">    ReceiptNum </th>
                                    <th class="w60">Deposit# </th>
                                    <th class="w200">Username </th>
                                    <th>    Notes   </th> 
                                    <th class="w40">Action</th> 
                                </tr>
                            </thead><thead class="receivable"> <tr class="tr_clone"> </tr> </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php if($id_deposit == 0 ){ ?> 
        <div class="row" id="btndispsave" style="display: block;">
          <div class="col-sm-12">
              <div class="btns text-center">
                  <button type="reset" style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Clear Selection</button>
                  <button id="submit2" type="button"  class="btn btn-lg btn-info btn-flat">Create Deposit</button>
                    
              </div>
            </div>
        </div>

    <?php } ?> 

                    </form>
                
                </div>
            </div>
        </div>
    </div>

</section>

         


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </div>
    
   
    <!--1. Display all data -->
    <script type="text/javascript">

    

        $(document).ready(function() {

            // Display All RECEIVABLES Data using this ajax
            $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                    data: {id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        //alert(result);
                        $(".receivable").html(result);
                    }
                });

            // Display All RECEIVABLES Data total using this ajax 
            $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                    data: {id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        $(".total_data").html(result);
                        if(<?=$id_deposit?> > 0 ) {
                            $(".select_total").hide();
                        }
                        
                    }
                    
                });

        
            //selectreceivables_ajax();
        
            function selectreceivables_ajax() {
                
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                    data: {id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        $(".receivable").html(result);
                    }
                    
                });
                
               /* $.ajax({
                        type: "POST",
                        url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                        data: {payId:payId},
                        dataType: 'text',
                        
                        success: function(result){
                            $(".total_data").html(result);
                        }
                        
                    });*/
            }
        });
    
  
/*
    <!--Selected Line Make yellow-->*/
  
    
    
        $(document).ready(function() {
            
            $('body').on('click','.trshowcust',function() {
                
                $('.trshowcust').removeClass('active-cust');
                $(this).addClass('active-cust');
                //$(this).closest('tr').addClass('active-cust');
            });
        });
    
  
/*    
    <!--Background color of selected checkbox-->
*/   
    
    
    function myFunction(t, c_vals) {
        
        
        if (t.is(':checked')) {
            
            $("."+c_vals).addClass("intro");
        }else{
            $("."+c_vals).removeClass("intro");
        }
    }

    
    /*<!--Delete payment value-->*/

    
    
    function delete_row(vals) {
        
        //alert(vals);
        var vals = vals;
        
        if(confirm("Are you sure! want to delete.")) {
            $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_banking/delete_payment_ajax')?>",
                data: {vals:vals},
                dataType: 'text',
                
                success: function(result){
                    selectreceivables_ajax();
                    alert("Deleted Payment statement");
                    
                }
                
            });
        }
    }
 
    

    
/*    <!--In included this work-->*/


    
    function include_deposited(t) {
        
        
        if (t.is(':checked')) {
            
            
            $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                data: {deposite:$("select[name=deposite]").val(), deposited_in:1},
                dataType: 'text',
            
                success: function(result){
                  
                    $(".receivable").html(result);
                }
            });
            
            $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                    data: {deposite:$("select[name=deposite]").val(), deposited_in:1, id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        $(".total_data").html(result);
                        if(<?=$id_deposit?> > 0 ) {
                            $(".select_total").hide();
                        }
                    }
                    
                });
                
                
        }else{
            $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                data: {deposite:$("select[name=deposite]").val(), deposited_in:2, id_deposit:<?=$id_deposit?>},
                dataType: 'text',
            
                success: function(result){
                    //alert(result);
                    $(".receivable").html(result);
                }
            });
            
            $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                    data: {deposite:$("select[name=deposite]").val(), deposited_in:2, id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        $(".total_data").html(result);
                        if(<?=$id_deposit?> > 0 ) {
                            $(".select_total").hide();
                        }
                    }
                    
                });
        }
    }
    
  
    
    /*<!--Search for top bar-->*/
    
    
    
    function topSearch(){
        
        var check           = $('#check').val();
        var receipt_to      = $('#receipt_to').val();
        var receipt_from    = $('#receipt_from').val();
        var amount          = $('#amount').val();
        var deposite_num    = $('#deposite').val();
        var date_to         = $('#date_to').val();
        var date_from       = $('#date_from').val();
        
        $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                data: {check:check, receipt_to:receipt_to, receipt_from:receipt_from, amount:amount, deposite_num:deposite_num, date_to:date_to, date_from:date_from, id_deposit:<?=$id_deposit?>  },
                dataType: 'text',
            
                success: function(result){
                    //alert(result);
                    $(".receivable").html(result);
                }
            });
            
             $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                    data: {check:check, receipt_to:receipt_to, receipt_from:receipt_from, amount:amount, deposite_num:deposite_num, date_to:date_to, date_from:date_from, id_deposit:<?=$id_deposit?>  },
                    dataType: 'text',
                    
                    success: function(result){
                        $(".total_data").html(result);
                        if(<?=$id_deposit?> > 0 ) {
                            $(".select_total").hide();
                        }
                    }
                    
                });
    }
    

    
    /* <!--Display All RECEIVABLES Data using this ajax on seledct dropdown  -->*/
    $(document).ready(function() {
        var payId = '';
        $('select[name="deposite"]').on('change', function() {
            var deposite = $(this).val();
            var che = $('.include_deposited:checkbox:checked').length > 0;
            if(che) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                    data: {deposite:deposite, deposited_in:1, id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                        
                    success: function(result){
                        $(".receivable").html(result);
                    }
                });
                
                 $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                    data: {deposite:deposite, deposited_in:1, id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        $(".total_data").html(result);
                        if(<?=$id_deposit?> > 0 ) {
                            $(".select_total").hide();
                        }
                    }
                    
                });
                
            }else {
                
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
                    data: {deposite:deposite, deposited_in:2},
                    dataType: 'text',
                
                    success: function(result){
                        //alert(result);
                        $(".receivable").html(result);
                    }
                });
                
                 $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_banking/selectreceivables_ajax_total')?>",
                    data: {deposite:deposite, deposited_in:2, id_deposit:<?=$id_deposit?>},
                    dataType: 'text',
                    
                    success: function(result){
                        $(".total_data").html(result);
                        if(<?=$id_deposit?> > 0 ) {
                            $(".select_total").hide();
                        }
                    }
                    
                });
            } 
        });
          
            

    });
    
    
    /*
    <!--Select Checked Data and sent to Deposite-->*/
   
    

    $("#submit2").click(function() {
        
        var arr = [""];
        var i = 0 ;

        $('.to_deposite').each(function() {
            if($(this).is(':checked')) {
                arr[i] = $(this).val();
                i++;
            }
        }); 

        $.ajax({
            type: "POST",
            url: "<?=base_url('Fi_banking/selectreceivables_ajax')?>",
            data: {do_deposite:arr},
            dataType: 'text',
            success: function(result){
                $(".receivable").html(result);
            }
        });
    });
    
    

   /* <!-- Select all -->*/
  
	function toggle(source) {
	   
	  checkboxes = document.getElementsByClassName('to_deposite');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
	}


	/*Date function*/

	$(document).ready(function() {

   		$("body").on("keydown", ".dt", function(event) {
        	
        	var key = event.keyCode;
        	var cls_nm =  $(this).attr("class");
        
        if(cls_nm.indexOf("fdt") !== -1) {

            var temp_edate =  $(this).parents(".searchwrap").find(".fdt");
        }
        else {

            var temp_edate =  $(this).parents(".searchwrap").find(".tdt");
        }

        
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

<?php if($id_deposit > 0 ){ ?> 
 <script type="text/javascript">
  $(".select_total").hide();
  </script>
<?php } ?> 

<a style="display: none" href="<?php echo site_url('fi_banking/deposit');?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
<script src="<?php echo base_url('assets/');?>js/prasanna.js"></script>

