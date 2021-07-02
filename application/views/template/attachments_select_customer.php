<div class="box box-info customer_sec titlen_search">
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
                    <!--  <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row space3">
            <div class="col-md-3 lstpaytype_cus_col">
                <div class="form-group">
                    <select class="form-control" id="cus_names" name="cus_attachment" onload="MM_jumpMenu('self',this,0)"  onchange="MM_jumpMenu('self',this,0)" autofocus="">
                        <option value="">Choose</option>
                    <!--     <?php
                        foreach ($search as $search_data) 
                        {
                            if($search['cus_id'] == $cus_id) 
                            {   ?>   
                                <option value="<?=$search_data['cus_id']?>" selected><?=$search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_address1']?> </option>
                                <?php
                            }
                        } ?> -->

                  
                            
                            <?php
                                $cus_id=$this->session->userdata('id');
                                foreach ($search as $search_data)
                                {
                                    if($cus_id==$search_data['cus_id'])
                                    {

                                      $select="selected";

                                    }else{

                                       $select="";

                                    }
                                    ?>
                                    <option <?=$select?> value="<?php echo $search_data['cus_id'] ?>" ><?=$search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_address1']?> </option>
                                    <!--<option <?=$select?> value="<?php echo $search_data['cus_id'] ?>"><?php print_r($search_data['cus_lname']." - ". $search_data['cus_company_name']); ?></option>-->

                                    <?php
                                }
                            ?>
                        </select>

                    </div>

                  </div>

              <div class="loaduppertabcntdtls">
                <div class="col-md-2 contact_no">

                   <div class="form-group" id="contact_info">

                     <input class="form-control fcap contact_no" type="text" id="topphone" name="topphone" value=" ">

                   </div>

                 </div>

                 <div class="col-md-2 cus_acc_no">

                   <div class="form-group" id="lastinvId">

                    <input class="form-control" type="text" placeholder="" value=" ">

                    <!--  <input class="form-control"  type="text" placeholder="433" value=""> -->

                   </div>

                 </div>

                 <div class="col-md-2 balance_count">

                   <div class="form-group" id="lastinvduebal">

                     <input class="form-control" type="text" placeholder="" value=" ">
                     <!-- <input class="form-control"  type="text" placeholder="$16.33" value="$ 993.00"> -->

                   </div>

                 </div>

            </div>
                <!--   <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="1">
                    </div>
                  </div> -->
                 <!-- <div class="col-sm-1">
                         <button class="btn btn-xs btn-primary btn-flat">Save</button>
                       </div> -->
                </div>
              </div>
            </div>