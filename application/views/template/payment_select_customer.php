            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info customer_sec titlen_search ">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-4"> <h3 class="uhead1"><?=$select_customer_name?></h3></div>
                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">
                                        <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                                        <!-- <li><a href="#" class="uhead2"> Options </a></li> -->
                                        <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button><?=$email_not?></li>
                                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                                        </ul>
                                        <!-- <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                                        <!--  <a href="#" class="btn btn-md btn-info btn-flat">New Payment</a> -->
                                        <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row space3">
                                <div class="col-md-3 lstpaytype_cus_col">
                                <div class="form-group"><?php //print_r($usr); ?>
                                <select class="form-control cust_payment" id="cus_notes" name="cus_notes" onchange="cust_payment()" autofocus> 
                                    <option value="">Choose</option>

                                    <?php
                                    foreach ($usr as $usrs) 
                                    {
                                        if($usrs['cus_id'] == $cus_id)
                                        { 
                                            $select = 'selected';
                                        }
                                        else
                                        {
                                            $select = '';
                                        }


                                        ?>   
                                            <option <?=$select?> style="font-size:13px;" data-value="<?=$usrs['cus_id']?>" value="<?php print_r($usrs['cus_lname'].", ".$usrs['cus_fname']." - ". $usrs['cus_company_name']." - ".$usrs['cus_acc_no']); ?>">
                                                <?=$usrs['cus_lname'].", ".$usrs['cus_fname']." - ". $usrs['cus_address1']?></option> <?php
                                    } 

                                    ?>
                                    
                                </select>
                                </div>
                                </div>

                                <div class="loaduppertabcntdtls">
                                    <div class="col-md-2 contact_no">
                                        <div class="form-group" id="contact_info">
                                            <input class="form-control fcap contact_no"  type="text" id="topphone" name="topphone" value=" ">
                                        </div>
                                    </div>

                                    <div class="col-md-2 cus_acc_no">
                                        <div class="form-group" id="lastinvId">
                                            <input class="form-control" type="text" placeholder="" value=" ">
                                        </div>
                                    </div>

                                    <div class="col-md-2 balance_count">
                                        <div class="form-group" id="lastinvduebal">
                                            <input class="form-control" type="text" placeholder="" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>