<div class="col-md-12">
    <div class="box box-info customer_sec titlen_search ">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <h3 class="uhead1"><?=$select_customer_name?></h3>
                </div>
                
                <div class="col-sm-7 col-md-8">
                    <div class="pull-right">
                        <ul class="list-inline topul">
                        <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                        <!-- <li><a href="#" class="uhead2"> Options </a></li> -->
                        <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button><?=$email_not?></li>
                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                        </ul>
                        <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                    </div>
                </div>
            </div>
        </div>

             <!-- /.box-header -->

<div class="box-body">
    <div class="row space3">
        <form name="topusrdetails" id="topusrdetails">
            <div class="col-md-3 lstpaytype_cus_col">                   
                <div class="form-group">
                    <select class="form-control cust_search" id="cus_notes" name="cus_notes" onchange="cust_search()">
                        <option value="">Choose</option> <?php
                        
                        foreach ($custs as $cust) 
                        {  
                            if($cust['cus_id'] == $cus_id) 
                            {   
                                $selected = "selected";
                            }
                            else
                            {
                                $selected = "";
                            }
                            ?>
                            <option <?=$selected?> style="font-size:13px;" value="<?=$cust['cus_id']?>"><?=$cust['cus_lname'].", ".$cust['cus_fname']." - ". $cust['cus_address1']?></option>
                            <?php
                        } ?>
                  </select>
                </div>
              </div>


              <div class="loaduppertabcntdtls">
               <div class="col-md-2">
                 <div class="form-group" >
                   <input class="form-control fcap contact_no" onchange="fncustomersearchbyphone(this.value)" type="text" id="topphone" name="topphone" value="" placeholder="Contact">
                 </div>
               </div>
               <div class="col-md-2 cus_acc_no">
                 <div class="form-group" >
                  <input class="form-control" type="text" placeholder="Acc Num" value="">
                </div>
              </div>

              <div class="col-md-2 balance_count">
               <div class="form-group" >
                 <input class="form-control" type="text" placeholder="Balance" value="">
               </div>
             </div>
           </div>
           <div class="col-sm-1"> </div>
         </form>
               </div>
             </div>
           </div>
         </div>