  
 <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

<style type="text/css">
  .border_box{ border: 1px solid #ccc; padding: 10px; background: #fff;  }
  .box table{ margin: 0 0 3px 0 !important; }
  .pl10{ padding-left: 10px; }
  .pr5{ padding-right: 5px; }
  .mt90{ margin-top: 90px !important; }
  .mt150{ margin-top: 150px !important; }
 .mt140{ margin-top: 140px !important; }

  .mybtn a {
   width: 120px !important;
   display: inline-block;
   margin: 5px 2px;
   min-width: initial;
   padding: 5px;
}
</style>


 
  <div class="content-wrapper reconcile_page" >
   
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
                               <h3 class="uhead1">Reconcile</h3>
                           </div>
                       </div>
                   </div> 

                   <form action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/search_cus" method="POST" id="csearch" class="pull-left">
                   <ul class="searchwrap">
                      <li> 
                        <div class=" dflex w500"> 
                          <input type="number" class="form-control w130 text-right" name="previous_balance" id="receipt_from" tabindex="1" placeholder="Previous Bank Balance"> 
                          <input type="number" class="form-control w130 text-right" name="previous_balance" id="receipt_from" tabindex="1" placeholder="Current Bank Balance"> 
                          <input type="number" class="form-control w130 text-right" name="previous_balance" id="receipt_from" tabindex="1" placeholder="Difference"> 
                         
                        </div>
                      </li> 				                
                      

                            <!-- <li>
                                   <span>Action</span>
                                   <button type="button" class="btn btn-xs btn-default" onclick="topSearch()"><i class="fa fa-search"></i></button>
                             </li> 
                               
                               <li>
                                   <span>Action</span>
                                   <button type="reset" class="btn btn-xs btn-default"><i class="fa fa-times"></i></button>
                             </li>  -->
                           </ul>
             </form>

             <div class="pull-right w90 rec_accbtn mt10">
               <select class="form-control " name="abd">

                 <option value="">Account</option>
                 <option value="">Account 1</option>
                 <option value="">Account 2</option>
                 
               </select>
             </div>

             <div class="clearfix"></div>


               </div>
           
           <div class="">
               <div class="box-body">
                   
                   <form id="createvent" name="createvent" method="POST" action="http://tech599.com/tech599.com/johnsum/erp_new/fi_home/addeventinfo">
                        
                        <div class="row">
                 <div class="col-md-6">

                   <div class="box box-info firstblock_bg ">

                     <div class="box-header with-border mb5">
                       <p class="uhead2">Payments</p>
                       <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>  </button>
                       </div>
                     </div>


                   <div class="table-responsive" id="reconcile_table">
                     <table class="table table-hover fixed_table">
                       <thead>
                         <tr>
                           <th class="w40">Clr</th>                            
                           <th class="w80">Date</th>
                           <th class="w100">Payment Type</th>
                           <th class=""><span class=" ">Account</span></th>
                           <th class="w80">Amount</th>
                            
                         </tr>
                       </thead> 
                   <thead> 
             <!--
                     <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""  checked> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""  checked> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 

                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly=""> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr> 


-->
                  </thead>

                  <thead> <!--
                    <tr> 
                      <td colspan="4 text-left"> <span class="pull-left pl10"> 2 Checks, debits </span> </td>                            
                           <td> <span> $1000.00</span> </td> 
                         </tr> -->

                  </thead>



                     </table>



                   </div>
                   </div> 
                   <!-- /.table-responsive --> 


                 </div>



                 <div class="col-md-6">

                   <div class="box box-info secondblock_bg ">

                     <div class="box-header with-border mb5">
                       <p class="uhead2">Deposits</p>
                       <div class="box-tools pull-right"> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                       </div>
                     </div>


                   <div class="table-responsive" id="reconcile_table">
                     <table class="table   table-hover ">
                       <thead>
                         <tr>
                           <th class="w40">Clr</th>                            
                           <th class="w80">Date</th>
                           <th class="w100">Payments</th>
                           <th class="w100">Payment Type</th>
                           <th class="">Payee</th>
                           <th class="w80">Amount</th>
                            
                         </tr>
                       </thead>  
                    <!-- Do not delete
                    <thead>
                         <tr class="tr_clone "> 
                           <td> <span> <input type="checkbox" name="" readonly="" checked> </span> </td>
                           <td> <span> 1/7/2020</span> </td>
                           <td> <span> </span> </td>
                           <td> <span> </span> </td>
                           <td> <span class="text-left blockk"> Shimon</span> </td>
                           <td> <span> $600.00</span> </td> 
                         </tr>   
                      </thead> 

                        <thead>
                        <tr> 
                        <td colspan="5" class="text-left"> <span class="pull-left pl10"> 1 Deposit, Credits </span> </td>                            
                             <td> <span> $1000.00</span> </td> 
                           </tr> 

                    </thead> -->


                     </table>



                   </div>


                   <div class=" table-responsive w300 mt140 pull-right ">
                     <table class="table table-hover fixed_table">
                       <tr>
                         <th class="w190">Bank Balance :</th>
<!--                    			<th class="t-right"><span class="pr5">$33,900.00 </span></th> -->
                       </tr>

                       <tr>
                         <th class="w190">Cleared Balance :</th><!-- 
                         <th class="t-right"><span class="pr5">$3,900.00 </span></th> -->
                       </tr>

                       <tr>
                         <th class="w190">Statement Ending Balance :</th><!-- 
                         <th class="t-right"><span class="pr5">$22,000.00 </span></th> -->
                       </tr>

                       <tr>
                         <th class="w190">Difference :</th><!-- 
                         <th class="t-right"><span class="pr5">$ -18,100.00 </span></th> -->
                       </tr>
                     </table>
                   </div>

                   <div class="clearfix"></div>

                 




                   </div>
                   <!-- /.table-responsive --> 


                 </div>



               </div>




                       <div class="row" id="btndispsave" style="display: block;">
         <div class="col-sm-12">
             <div class="btns text-center">

                 <div class="mybtn text-center mt10">
                 <a href="#" class="btn btn-sm btn-info btn-flat" id="back">Mark All</a>
                 <a href="#" class="btn btn-sm btn-info btn-flat" id="back">Cancel</a>
                 <a href="#" class="btn btn-sm btn-info btn-flat" id="back">Finish Later</a>
                 <a href="#" class="btn btn-sm btn-info btn-flat" id="back">Finished</a>
               </div>
               <!--   <button type="reset" style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Clear Selection</button>
                 <button id="submit2" type="button"  class="btn btn-lg btn-info btn-flat">Create Reconcile</button> -->
                   
             </div>
           </div>
       </div>

                   </form>
               
               </div>
           </div>
       </div>
   </div>

</section>

        


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </div>