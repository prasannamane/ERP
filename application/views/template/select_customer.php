    <div class="col-md-12">
        <div class="box box-info titlen_search customer_sec">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-sm-5 col-md-4"><h3 class="uhead1"><?=$select_customer_name?></h3></div>
                    <div class="col-sm-7 col-md-8">
                        <div class="pull-right">
                            <ul class="list-inline topul">
                                <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button><?=$email_not?></li>
                                <li><button class="btn btn-default" onclick="print();"> <i class="fa fa-print"></i></button> </li>
                            </ul>
                            <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                            <a onclick="fndeletecust()" class="btn btn-md btn-danger">Delete Customer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="uppertab">
                <div class="box-body">
                    <div class="row space3">
                        <div class="col-md-3 lstpaytype_cus_col">
                            <div class="form-group">
                                <select class="form-control cust_search cus_notes delete_user" id="cus_notes" name="cus_notes" onchange="cust_search()" autofocus="autofocus">
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
                                <script type="text/javascript">
                                    $(".delete_user").find("option").eq(0).remove();
                                </script>
                            </div>  
                        </div>
                        <div class="loaduppertabcntdtls"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>