<div class="box box-info customer_sec titlen_search">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-sm-5 col-md-4">
                                <h3 class="uhead1"><?=$select_customer_name?> </h3>
                            </div>

                            <div class="col-sm-7 col-md-8">
                                <div class="pull-right">
                                    <ul class="list-inline topul">
                                        <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button><?=$email_not?></li>
                                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                                        <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="row space3">
                            <form action="<?=base_url('fi_home/CustomerInvoice')?>" method="POST" >
                            <div class="col-md-3 lstpaytype_cus_col">
                                <div class="form-group">
                                    <select class="form-control selectclient" id="" name="cus_id" onchange="selectclient()">
                                        <option value=""><?=$name?></option>    
                                        <?php foreach($all_customer as $row) { ?>

                                        <option value="<?=$row['cus_id']?>"><?=$row['cus_lname']?>, <?=$row['cus_fname']?> - <?=$row['cus_address1']?></option>

                                    <?php  } ?>                                
                                    </select>
                                </div>
                            </div>

                             <div class="loaduppertabcntdtls">
                            <div class="col-md-1">
                                <div class="form-group" id="">
                                    <input style="background: #e2e2e2;" class="form-control" type="text" id="" name="" value="<?=$mobile?>">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group" id="">
                                    <input style="background: #e2e2e2;" class="form-control" type="text" placeholder=" " value="<?=sprintf('%07u', $cus_id)?>">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group" id="">
                                    <input style="background: #e2e2e2; text-align: right;" class="form-control" type="text" placeholder=" " value="$<?=$balance?>">
                                </div>
                            </div>
                        </div>

                            <div class="col-md-1" style="display: none;">
                                <div class="form-group" id="">
                                    <input class="btn SubmitClient" type="submit" value="Submit" name="Submit">
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>


              