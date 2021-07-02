<style>
table .form-control:focus, table select:focus, table input:focus {
    border-color: red !important;
    height: 21px;
}

.glyphicon.glyphicon-usd {

    top: 0px !important;
    margin: 0px 0px 0px 5px;
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Customer</a></li>
                <li class="active">Invoices</li>
            </ol>
        </section>
      
        <?php if(isset($success)) { ?>
            <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong></strong> <?=$success?>
            </div>
        <?php }?>

        <?php if(isset($error)) { ?>
            <div class="alert alert-danger alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> <?=$error?>
            </div>
        <?php }?>

            <section class="content">
            <?php $this->load->view('template/incoice_select_customer'); ?>

                <div class="box box-default firstblock_bg ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-header with-border">
                                <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
                                <div style="dislay:flex">
                                    <p class="uhead2">Invoices</p>                               
                                    <p style="float: right" class="download_pdf flex">
                                        <i class="fa fa-print"></i>
                                        <select name="" id="">
                                            <option value="">PDF</option>
                                            <option value="contract">Contract</option>
                                            <option value="invoice">Invoice</option>
                                            <option value="event">Event Details</option>
                                        </select>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive" id="myinvoice">
                                <form method="POST" action="<?=base_url('fi_home/CustomerInvoice')?>">
                                    <table class="table   table-hover no-margin">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 30px;">#</th>
                                                <th style="min-width: 30px;">Date</th>
                                                <th style="min-width: 30px;">Due date</th>
                                                <th style="min-width: 100px;">Event</th>
                                                <th style="min-width: 100px;">Contract Type</th>
                                                <th style="min-width: 70px;">Itm Sub Total</th>
                                                <th style="min-width: 30px;">Disc Type</th>
                                                <th style="min-width: 70px;">Inv Disc Amt</th>                
                                                <th style="min-width: 70px;">Total Disc Amt</th>                
                                                <th style="min-width: 70px;">Tax Amt</th>
                                                <th style="min-width: 70px;">Inv Sub Total</th>
                                                <th style="min-width: 70px;">Paid</th>
                                                <th style="min-width: 70px;">Bal Due</th>
                                                <th style="min-width: 70px;">County</th>
                                                <th style="min-width: 70px;">Tax Rate</th>
                                                <th style="min-width: 50px;">User</th>
                                                <th style="min-width: 30px;">Action</th>
                                            </tr>
                                        </thead>

                                        <thead id="mycust" ><?php 
                                            foreach($invoices_create as $row) 
                                            { 
                                                if($invoice_number == $row['invoice_id'])
                                                {
                                                    $background = "background: #f1eea0 !important;";
                                                    $invoice_discount = "invoice_discount";
                                                    $discounted_amt = "discounted_amt";
                                                    $invoice_contract_type = "invoice_contract_type";
                                                    $invoice_date = "invoice_date";
                                                    $invoice_due_date = "invoice_due_date";
                                                    $event_id = "event_id";
                                                    $invoice_county = "invoice_county";
                                                    $invoice_tax_rate = "invoice_tax_rate";
                                                    $selectrow ="";
                                                    $onblurupdate = "onchange='saveinvoice(".$row['invoice_id'].")'";
                                                }
                                                else
                                                {
                                                    $background = "";
                                                    $invoice_discount = "";
                                                    $discounted_amt = "";
                                                    $invoice_contract_type = "";
                                                    $invoice_date = "";
                                                    $invoice_due_date = "";
                                                    $event_id = "";
                                                    $invoice_county = "";
                                                    $invoice_tax_rate = "";
                                                    $selectrow ="onclick='rowselect(".$row['invoice_id'].")'";
                                                    $onblurupdate ="onchange='updatemydata(".$row['invoice_id'].")'";
                                                }
                                                
                                                ?>
                                            <tr class="tr_clone" style="<?=$background?>">
                                                <td class="1" <?=$selectrow?>><?=$row['invoice_id']?></td>
                                                <td style="width: 73px;">
                                                    <input class="form-control startdate invoice_date<?=$row['invoice_id']?>" <?=$onblurupdate?>   style="<?=$background?>" type="text" value="<?=date("m/d/Y",strtotime($row['invoice_date']))?>" name="<?=$invoice_date?>"></td>
                                                <td class="3" style="width: 73px;">
                                                    <input class="form-control enddate invoice_due_date<?=$row['invoice_id']?>" <?=$onblurupdate?> type="text" 
                                                    onblur="saveinvoice('<?=$row['invoice_id']?>')"  style="<?=$background?>" value="<?=date("m/d/Y",strtotime($row['invoice_due_date']))?>" name="<?=$invoice_due_date?>">
                                                </td>
                                                <td>
                                                    <select class="form-control event_id<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$event_id?>" style="width: 100%; <?=$background?>"> <?php
                                                        if(!$row['invoice_type'] || $row['invoice_type'] == 0)
                                                        {   ?>
                                                            <option>Choose</option> <?php
                                                        }
                                                        foreach($events_register as $row1) 
                                                        { 
                                                            if($row1['event_id'] == $row['invoice_type']) 
                                                            { 
                                                                ?><option value="<?=$row1['event_id']?>"><?=$row1['event_name']?> - <?=date("m/d/Y",strtotime($row1['event_date']))?> - <?=$row1['event_type']?>  </option> <?php
                                                            }
                                                        }
                                                        foreach($events_register as $row1) 
                                                        {   ?>
                                                                <option value="<?=$row1['event_id']?>">
                                                                <?=$row1['event_name']?> - <?=date("m/d/Y",strtotime($row1['event_date']))?> -
                                                                <?=$row1['event_type']?>  </option>
                                                <?php   } ?>                                                
                                                  </select>
                                                </td>
                                                <td><div align="center">
                                                    <select class="form-control invoice_contract_type<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$invoice_contract_type?>" style="width: 100%; <?=$background?>" >
                                                    <?php
                                                    if(!$row['invoice_contract_type']  || $row['invoice_contract_type'] == 0 )
                                                    { ?>
                                                        <option>Choose</option>
                                                        <?php
                                                    }
                                                         
                                                    foreach ($sub_categories as $row3) 
                                                    {
                                                        if($row3['sub_id'] == $row['invoice_contract_type'])
                                                        { 
                                                            $selected = "selected";
                                                    
                                                        }
                                                        else 
                                                        { 
                                                            $selected = ""; 
                                                        }
                                                        ?>
                                                        <option <?=$selected?> value="<?=$row3['sub_id']?>"><?=$row3['sub_name']?></option>
                                                        <?php
                                                    } ?>
                                                     
                                                    </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['invoice_amount']?><span></td>
                                                <td>
                                                    <select class="form-control invoice_discount<?=$row['invoice_id']?>" name="<?=$invoice_discount?>" style="width: 100%; <?=$background?> ">
                                                        <option >Choose</option> 
                                                        <option  <?php if($row['invoice_discount'] == '1'){ echo "selected"; } ?> value="1">$</option>
                                                        <option <?php if($row['invoice_discount'] == '2'){ echo "selected"; } ?> value="2">%</option>
                                                    </select >
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-usd" style="">
                                                                </span>
                                                            </span>
                                                            <input type="text" name="<?=$discounted_amt?>" class="form-control discounted_amt<?=$row['invoice_id']?>" <?=$onblurupdate?> style="background: #80808047; width: 80px;  <?=$background?>" value="<?=number_format($row['discounted_amt'],2)?>" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=$row['after_discount_amount']?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=$row['invoice_tax']?></span></td>
                                                <td style="text-align: right;" >
                                                    <?php $itm = $row['item_sub_total']+$row['invoice_tax'] ?>
                                                <span style="margin-right: 5px;"> $<?=number_format((float)$itm , 2, '.', '')?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=number_format((float)$row['invoice_paid'], 2, '.', '')?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=$row['invoice_balance_due']?></span></td>
                                                <td>
                                                    <select class="form-control saveinvoicetax<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$invoice_county?>" style="width: 100%; <?=$background?>" >
                                                        <option >Choose</option> <?php
                                                        foreach ($county as $row4) 
                                                        {
                                                            if($row4['id'] == $row['invoice_county'])
                                                            { 
                                                                $selected = 'selected';
                                                            }
                                                            else 
                                                            { 
                                                                $selected = ''; 
                                                            } ?>
                                                            <option <?=$selected?> value="<?=$row4['id']?>"><?=$row4['country']?></option> <?php 
                                                        } ?> 
                                                    </select>
                                                </td>
                                                <td>
                                                    <span style="margin-right: 5px;">
                                                        <input class="invoice_tax_rate<?=$row['invoice_id']?>" <?=$onblurupdate?> style="margin-right: -3px; text-align:right; width:70px; <?=$background?>" type="text" name="<?=$invoice_tax_rate?>" value="<?=$row['invoice_tax_rate']?>">%
                                                    </span> 
                                                </td>
                                                <td>
                                                    <?php
                                                    //To get username from user id
                                                    $cond = array('id' => $row['user']);
                                                    $tbl = "users";
                                                    $users = $this->HomeModel->get_all_by_cond($tbl, $cond); 
                                                    echo $users[0]['username'];                                                
                                                    ?>
                                                <td>
                                                    <div style="display: inline-flex;">
                                                        <!--     <input type="hidden" name="" value=""> -->
                                                        <button style="display: none;" type="submit" value="<?=$row['invoice_id']?>" name="invoice_number" class="btn btn-xs btn-success rowselect<?=$row['invoice_id']?>">
                                                            <i class="fa fa-play-circle"></i></button>

                                                        <button type="submit" value="<?=$row['invoice_id']?>" name="button_8" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button> 
                                                        
                                                        <!-- <button class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button> -->
                                                        <button style="display: none;" type="submit" value="<?=$row['invoice_id']?>" name="button_5" class="btn btn-xs btn-success button_5<?=$row['invoice_id']?>"><i class="fa fa-save"></i></button>
                                                    </div>
                                                </td>
                                                </tr> <?php 
                                            } 

                                            foreach($invoices_create2 as $row) 
                                            { 
                                                if($invoice_number == $row['invoice_id'])
                                                {
                                                    $background = "background: #f1eea0 !important;";
                                                    $invoice_discount = "invoice_discount";
                                                    $discounted_amt = "discounted_amt";
                                                    $invoice_contract_type = "invoice_contract_type";
                                                    $invoice_date = "invoice_date";
                                                    $invoice_due_date = "invoice_due_date";
                                                    $event_id = "event_id";
                                                    $invoice_county = "invoice_county";
                                                    $invoice_tax_rate = "invoice_tax_rate";
                                                    $selectrow ="";
                                                    $onblurupdate = "onchange='saveinvoice(".$row['invoice_id'].")'";
                                                }
                                                else
                                                {
                                                    $background = "";
                                                    $invoice_discount = "";
                                                    $discounted_amt = "";
                                                    $invoice_contract_type = "";
                                                    $invoice_date = "";
                                                    $invoice_due_date = "";
                                                    $event_id = "";
                                                    $invoice_county = "";
                                                    $invoice_tax_rate = "";
                                                    $selectrow ="onclick='rowselect(".$row['invoice_id'].")'";
                                                    $onblurupdate ="onchange='updatemydata(".$row['invoice_id'].")'";
                                                }
                                                
                                                ?>
                                            <tr class="tr_clone" style="<?=$background?>">
                                                <td class="1" <?=$selectrow?>><?=$row['invoice_id']?></td>
                                                <td style="width: 73px;">
                                                    <input class="form-control startdate invoice_date<?=$row['invoice_id']?>" <?=$onblurupdate?>   style="<?=$background?>" type="text" value="<?=date("m/d/Y",strtotime($row['invoice_date']))?>" name="<?=$invoice_date?>"></td>
                                                <td class="3" style="width: 73px;">
                                                    <input class="form-control enddate invoice_due_date<?=$row['invoice_id']?>" <?=$onblurupdate?> type="text" 
                                                    onblur="saveinvoice('<?=$row['invoice_id']?>')"  style="<?=$background?>" value="<?=date("m/d/Y",strtotime($row['invoice_due_date']))?>" name="<?=$invoice_due_date?>">
                                                </td>
                                                <td>
                                                    <select class="form-control event_id<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$event_id?>" style="width: 100%; <?=$background?>"> <?php
                                                        if(!$row['invoice_type'] || $row['invoice_type'] == 0)
                                                        {   ?>
                                                            <option>Choose</option> <?php
                                                        }
                                                        foreach($events_register as $row1) 
                                                        { 
                                                            if($row1['event_id'] == $row['invoice_type']) 
                                                            { 
                                                                ?><option value="<?=$row1['event_id']?>"><?=$row1['event_name']?> - <?=date("m/d/Y",strtotime($row1['event_date']))?> - <?=$row1['event_type']?>  </option> <?php
                                                            }
                                                        }
                                                        foreach($events_register as $row1) 
                                                        {   ?>
                                                                <option value="<?=$row1['event_id']?>">
                                                                <?=$row1['event_name']?> - <?=date("m/d/Y",strtotime($row1['event_date']))?> -
                                                                <?=$row1['event_type']?>  </option>
                                                <?php   } ?>                                                
                                                  </select>
                                                </td>
                                                <td><div align="center">
                                                    <select class="form-control invoice_contract_type<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$invoice_contract_type?>" style="width: 100%; <?=$background?>" >
                                                    <?php
                                                    if(!$row['invoice_contract_type']  || $row['invoice_contract_type'] == 0 )
                                                    { ?>
                                                        <option>Choose</option>
                                                        <?php
                                                    }
                                                         
                                                    foreach ($sub_categories as $row3) 
                                                    {
                                                        if($row3['sub_id'] == $row['invoice_contract_type'])
                                                        { 
                                                            $selected = "selected";
                                                    
                                                        }
                                                        else 
                                                        { 
                                                            $selected = ""; 
                                                        }
                                                        ?>
                                                        <option <?=$selected?> value="<?=$row3['sub_id']?>"><?=$row3['sub_name']?></option>
                                                        <?php
                                                    } ?>
                                                     
                                                    </select>
                                                    </div>
                                                </td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['invoice_amount']?><span></td>
                                                <td>
                                                    <select class="form-control invoice_discount<?=$row['invoice_id']?>" name="<?=$invoice_discount?>" style="width: 100%; <?=$background?> ">
                                                        <option>Choose</option> 
                                                        <option <?php if($row['invoice_discount'] == '1'){ echo "selected"; } ?> value="1">$</option>
                                                        <option <?php if($row['invoice_discount'] == '2'){ echo "selected"; } ?> value="2">%</option>
                                                    </select >
                                                </td>
                                                
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-usd" style="">
                                                                </span>
                                                            </span>
                                                            <input type="text" name="<?=$discounted_amt?>" class="form-control discounted_amt<?=$row['invoice_id']?>" <?=$onblurupdate?> style="background: #80808047; width: 80px;  <?=$background?>" value="<?=number_format($row['discounted_amt'],2)?>" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=$row['after_discount_amount']?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=$row['invoice_tax']?></span></td>
                                                <td style="text-align: right;" >
                                                    <?php $itm = $row['item_sub_total']+$row['invoice_tax'] ?>
                                                <span style="margin-right: 5px;"> $<?=number_format((float)$itm , 2, '.', '')?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=number_format((float)$row['invoice_paid'], 2, '.', '')?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;"> $<?=$row['invoice_balance_due']?></span></td>
                                                <td>
                                                    <select class="form-control saveinvoicetax<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$invoice_county?>" style="width: 100%; <?=$background?>" >
                                                        <option >Choose</option> <?php
                                                        foreach ($county as $row4) 
                                                        {
                                                            if($row4['id'] == $row['invoice_county'])
                                                            { 
                                                                $selected = 'selected';
                                                            }
                                                            else 
                                                            { 
                                                                $selected = ''; 
                                                            } ?>
                                                            <option <?=$selected?> value="<?=$row4['id']?>"><?=$row4['country']?></option> <?php 
                                                        } ?> 
                                                    </select>
                                                </td>
                                                <td>
                                                    <span style="margin-right: 5px;">
                                                        <input class="invoice_tax_rate<?=$row['invoice_id']?>" <?=$onblurupdate?> style="margin-right: -3px; text-align:right; width:70px; <?=$background?>" type="text" name="<?=$invoice_tax_rate?>" value="<?=$row['invoice_tax_rate']?>">%
                                                    </span> 
                                                </td>
                                                <td>
                                                    <?php
                                                    //To get username from user id
                                                    $cond = array('id' => $row['user']);
                                                    $tbl = "users";
                                                    $users = $this->HomeModel->get_all_by_cond($tbl, $cond); 
                                                    echo $users[0]['username'];                                                
                                                    ?>
                                                </td>
                                                <td>
                                                    <div style="display: inline-flex;">
                                                        <!--     <input type="hidden" name="" value=""> -->
                                                        <button style="display: none;" type="submit" value="<?=$row['invoice_id']?>" name="invoice_number" class="btn btn-xs btn-success rowselect<?=$row['invoice_id']?>">
                                                            <i class="fa fa-play-circle"></i></button>

                                                        <button type="submit" value="<?=$row['invoice_id']?>" name="button_8" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button> 
                                                        
                                                        <!-- <button class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button> -->
                                                        <button style="display: none;" type="submit" value="<?=$row['invoice_id']?>" name="button_5" class="btn btn-xs btn-success button_5<?=$row['invoice_id']?>"><i class="fa fa-save"></i></button>
                                                    </div>
                                                </td>
                                                </tr> <?php } ?>
                                        </thead>
                                            
                                            <!-- Customer add invoice -->
                                            <thead>
                                            <tr>
                                                <td class="1" style="background: #e2e2e2;">#</td>
                                                <td  style="background: #e2e2e2;"><!-- <input style="" type="text" value="<?=date("m/d/Y")?>" name=""> --></td>
                                                <td class="3"  style="background: #e2e2e2;"><!-- <input type="text" style="" value="<?=date("m/d/Y")?>" name=""> --></td>
                                                <td  style="background: #e2e2e2; ">
                                                    <select class="1" style="width: 100%; background: #e2e2e2;  color: #e2e2e2; " name="myevents_register">
                                                    <?php foreach($events_register as $row1) { ?>
                                                        <option value="<?=$row1['event_id']?>"> 
                                                    <?=$row1['event_name']?> - <?=date("m/d/Y",strtotime($row1['event_date']))?> -
                                                    <?=$row1['invoice_type']?>  </option>
                                                    <?php } ?>
                                                    </select> 
                                                </td>
                                                <td style="background: #e2e2e2;" > 
                                                    <select name="myinvoice_contract_type" style="color: #e2e2e2; width: 100%; background: #e2e2e2;" >
                                                    <?php
                                                    foreach ($sub_categories as $row3) {
                                                    ?>
                                                    <option value="<?=$row3['sub_id']?>"><?=$row3['sub_name']?></option>
                                                    <?php
                                                     }
                                                    ?>
                                                    </select>
                                                </td>
                                                <td style="background: #e2e2e2;"><!-- 
                                                    <select name="" style="width: 100%;">
                                                        <option value="" > </option> 
                                                    </select >
 -->                                                </td>
                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;"></td>

                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;"></td>
                                                <td style="background: #e2e2e2;">
<!--                                                     <select style="width: 100%;" disabled="">

                                                   <?php
                                                    foreach ($tbl_counties_list as $row4) {
                                                        ?>
                                                            <option value="<?=$row4['id']?>"><?=$row4['County']?></option>
                                                          <?php
                                                        }
                                                        ?>
                                                    
                                                  </select> -->
                                                </td>
                                               
                                                <td style="background: #e2e2e2;"></td>
                                                <td>
                                                    <div style="display: inline-flex;">
                                                       <button type="submit" value="1" name="create_invoice" class="btn btn-xs btn-success">
                                                            <i class="fa fa-plus"></i>
                                                        </button>       
                                                    </div>
                                                </td>
                                            </tr>            
                                        </thead>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mytabber">
                    <ul  class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a onclick="customer_invoice_item();" href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a>
                        </li>

                        <li role="presentation">
                            <a onclick="customer_invoice_termstasks();" href="#terms" aria-controls="terms" role="tab" data-toggle="tab">Terms/Tasks </a>
                        </li>

                        <li role="presentation">
                            <a onclick="customer_invoice_pickupinfo();" href="#pickup" aria-controls="pickup" role="tab" data-toggle="tab">Pickup Info</a>
                        </li>

                        <li role="presentation">
                            <a onclick="customer_invoice_notes();" href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes  </a>
                        </li>

                        <li role="presentation">
                            <a onclick="customer_invoice_associatedorder();" href="#associated" aria-controls="associated" role="tab" data-toggle="tab">Associated Order  </a>
                        </li>

                        <li role="presentation">
                            <a onclick="customer_invoice_history();" href="#history" aria-controls="history" role="tab" data-toggle="tab">History  </a>
                        </li>
                    </ul>

                <!-- Tab panes -->
                <div class="tab-content customer_invoice" id="" ></div> 
                <!--  End all tab section -->
            </div>

        </section>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

        function updatemydata(id)
        {
            

            var invoice_date = $('.invoice_date'+id).val();
            var invoice_due_date = $('.invoice_due_date'+id).val();
            var event_id = $('.event_id'+id).children("option:selected").val();
            var invoice_contract_type = $('.invoice_contract_type'+id).children("option:selected").val();
            var invoice_discount = $('.invoice_discount'+id).children("option:selected").val();
            var discounted_amt = $('.discounted_amt'+id).val();
            var invoice_county = $('.saveinvoicetax'+id).children("option:selected").val(); 
            var invoice_tax_rate = $('.invoice_tax_rate'+id).val();

            $.ajax({
                type: 'POST',
                url: '<?=site_url('Fi_home/CustomerInvoice')?>',
                data: { invoice_tax_rate : invoice_tax_rate, invoice_county : invoice_county, discounted_amt : discounted_amt, invoice_date : invoice_date, invoice_due_date :invoice_due_date, invoice_contract_type : invoice_contract_type, invoice_discount : invoice_discount, button_5 : id, event_id : event_id},
                dataType: 'text',
                success: function(data) 
                {
                     $.ajax({
                    type: 'POST',
                    url: '<?=site_url('Fi_home/CustomerInvoice')?>',
                    data: { invoice_number : id},
                    dataType: 'text',
                    success: function(data) 
                    {
                        window.location.href = "<?=base_url('Fi_home/CustomerInvoice')?>";
                       //$(".customer_invoice").html(data);
                    }
                });
                    //window.location.href = "<?=base_url('Fi_home/CustomerInvoice')?>";
                   //$(".customer_invoice").html(data);
                }
            });

        }

        function mycustclick(id)
        {

        }

        //onclick="rowselect(<?=$row['invoice_id']?>)"
        function rowselect(id)
        {
           //$('.rowselect'+id).triggerHandler('click');
            // event.preventDefault(); 
            $('.rowselect'+id).click();

        }  

        function saveinvoice(id)
        {
            $('.button_5'+id).click();
            
        }

        function saveinvoicetax(id)
        {
            $('.saveinvoicetax'+id).remove();  
            $('.button_5'+id).click();
           
        }

        function selectclient()
        {
            $('.SubmitClient').click();
        }

        function loadinvtopinfo(cusid)
        {
            $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_home/getSearchCustContactInfo'); ?>",//getSearchInvoiceInfo
                data: {name:cusid},
                dataType: 'html',
                
                success: function(data)
                {
                    $('.loaduppertabcntdtls').html(data);
                }
            });
        }

        

        /*$( ".selectclient" ).blur(function(){
            var keyEvent = $.Event("keydown");
            keyEvent.keyCode = $.ui.keyCode.ENTER;
            $(this).trigger(keyEvent);
        }).autocomplete({
            autoFocus: true,
            source: states,
         // ...
        });*/

/*-------------------------- 5. history Start  ---------------------------------------------------------------------------------*/
        function customer_invoice_history()
        {
            var invoice_number = '<?=$invoice_number?>';
            var cus_id = '<?=$cus_id?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/customer_invoice_history')?>',
                data: {invoice_number:invoice_number, cus_id:cus_id},
                dataType: 'text',
                success: function(data) {
                   $(".customer_invoice").html(data);
                }
            });
        }
/*-------------------------- 5. history Start  ---------------------------------------------------------------------------------*/

/*-------------------------- 4. associated order Start  ---------------------------------------------------------------------------------*/

        function fnupdateinvoiceinfo(inptxtval,invoiceid,fieldnm)
        {
            if(fieldnm=='invoice_date' || fieldnm=='invoice_due_date')
            {
                var arr = inptxtval.split("/");
                inptxtval = arr[2]+"-"+arr[0]+"-"+arr[1];
            }
            var invoiceid = '<?=$invoice_number?>';

            if(fieldnm=='invoice_contract_type')
            {
                $.ajax({
                      type: 'POST',
                      url: '<?=site_url('fi_home/updtinvoice')?>',
                      data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
                      dataType: 'text',
                      beforeSend: function() {
                          // setting a timeout
                          $('.fadeMe').show();


                      },
                      success: function(data) {

                          if(data=="success")
                          {
                              $('.fadeMe').hide();

                              //fngetinvoicedetails(invoiceid);

                              fnupdateinvterms(inptxtval,invoiceid);


                          }else if(data=="error"){

                              $('.fadeMe').hide();
                              //alert("Something went wrong..!");
                          }



                      },
                      error: function(xhr) { // if error occured
                        // $('.fadeMe').hide();
                      },
                      complete: function() {
                       // $('.fadeMe').hide();


                      }

                     });
            }else{

              // alert("else");
                      $.ajax({
                      type: 'POST',
                      url: '<?=site_url('fi_home/updtinvoice')?>',
                      data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm},
                      dataType: 'text',
                      beforeSend: function() {
                          // setting a timeout
                          $('.fadeMe').show();

                      },
                      success: function(data) {

                        //var custid= localStorage.getItem("pckId");
                        var custid = '<?=$cus_id?>';
                          // alert(custid);
                        // var custid= $('#custnm option:selected').val();

                          if(data=="success")
                          {
                              $('.fadeMe').hide();

                              fngetinvoicedetails(invoiceid,'items',custid);
                              customer_invoice_associatedorder();
                          }else if(data=="error"){

                              $('.fadeMe').hide();
                              //alert("Something went wrong..!");
                          }



                      },
                      error: function(xhr) { // if error occured
                        // $('.fadeMe').hide();
                      },
                      complete: function() {
                       // $('.fadeMe').hide();


                      }

                  });
            }

        }

        function customer_invoice_associatedorder()
        {
            var invoice_number = '<?=$invoice_number?>';
            var cus_id = '<?=$cus_id?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/customer_invoice_associatedorder')?>',
                data: { invoice_number:invoice_number, cus_id:cus_id },
                dataType: 'text',
                success: function(data) {
                   $(".customer_invoice").html(data);
                }
            });

        }

/*-------------------------- 4. associated order END  ---------------------------------------------------------------------------------*/
/*-------------------------- 3. pickup Notes Start  ---------------------------------------------------------------------------------*/
        
        function fndelinvnote(delId,invoiceid)
        {
            event.preventDefault();
            var r = confirm("Do you want delete this note..?");
            if(r == true)
            {
                var invoiceid = '<?=$invoice_number?>';
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('fi_home/delinvnote')?>',
                    data: {delId:delId,invoiceid:invoiceid},
                    dataType: 'text',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        var custid = '<?=$cus_id?>';
                        if(data=="success")
                        {
                            fngetinvoicedetails(invoiceid,'notes',custid);
                            customer_invoice_notes();
                            $('.fadeMe').hide();
                        }else if(data=="error"){

                            $('.fadeMe').hide();
                        }
                    },
                    error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();

                  }

              });
            }
        }

        function fnupdatenote(inptxtval, invoiceid, fieldnm, noteid)
        {
            var my = noteid
            var my_Time = $('.cust_inv_note_tim'+my).val();
            var my_Time_count = my_Time.toString().length;
            var arr = ["00", "00"];
            if(my_Time_count == 4) {
                if(my_Time > 0 && my_Time < 1300) {
                    arr = my_Time.match(/.{1,2}/g);
                    var res = arr[0]+":"+arr[1]+" PM";
                    var timenotes = res;
                    $('.cust_inv_note_tim'+my).val(res);
                }
                else 
                {
                    var num = my_Time - 1200;
                    my_Time = num.toString();
                    var my_Time_count = my_Time.toString().length;
                    if(my_Time_count == 3)
                    {
                        my_Time = '0'.concat(my_Time); 
                    }
                    if(my_Time > 0 && my_Time < 1300)
                    {
                        arr = my_Time.match(/.{1,2}/g);
                        var res = arr[0]+":"+arr[1]+" PM";
                        $('.cust_inv_note_tim'+my).val(res);
                        var timenotes = res;
                        var timenotes = formatAMPM(new Date);
                    }
                    else 
                    {
                        alert("Time is not correct");
                        var timenotes = formatAMPM(new Date);
                    }
                }
            }
            else if(my_Time_count > 4)
            {
                var timenotes = formatAMPM(new Date);
            }
            else if(my_Time_count > 0)
            {
                alert("Value should be 4 digit");
                var timenotes = formatAMPM(new Date);
            }

            function formatAMPM(date) 
            {
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;
                return strTime; 
            }
            
            var todays = new Date();
            var currenthours=  todays.getHours();
            var currentminutes=  todays.getMinutes();
            var invoiceid = '<?=$invoice_number?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updateinvnotes')?>',
                data: {invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm,noteid:noteid,timenotes:timenotes},
                dataType: 'text',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    var custid = '<?=$cus_id?>';
                    if(data=="success")
                    {
                        fngetinvoicedetails(invoiceid,'notes',custid);
                        customer_invoice_notes();
                        $('.fadeMe').hide();
                    }
                    else
                    {
                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) {
                    $('.fadeMe').hide();
                },
                complete: function() {
                    $('.fadeMe').hide();
                }
            });
        }

        function fninsertnote(inptxtval, invoiceid, fieldnm) 
        {
            var todays          = new Date();
            var currenthours    =  todays.getHours();
            var currentminutes  =  todays.getMinutes();
            //var timenotes     = currenthours+":"+currentminutes;
            var timenotes       = $(".cust_inv_note_tim_sta").val();

            function formatAMPM(date) 
            {
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;
                return strTime; 
            }

            if(timenotes == '')
            {
                var timenotes = formatAMPM(new Date);
            }

            event.preventDefault();
            if(fieldnm == 'date') 
            {
                var arr   = inptxtval.split("/");
                today     = arr[2] + '-' + arr[0] + '-' + arr[1];
                inptxtval = today;
                var invoiceid = '<?=$invoice_number?>';

                $.ajax({
                    type : 'POST',
                    url : '<?=site_url('fi_home/insertinvnotes')?>', 
                    data : {invoiceid:invoiceid, inptxtval:inptxtval, fieldnm:fieldnm, timenotes:timenotes},
                    dataType : 'html',
                    beforeSend : function() 
                    {
                        $('.fadeMe').show();
                    },
                    success: function(data) 
                    {
                        var custid = '<?=$cus_id?>';
                        //var custid= localStorage.getItem("pckId");
                        if(data=="success")
                        {
                            fngetinvoicedetails(invoiceid,'notes',custid);
                            customer_invoice_notes();
                            $('.fadeMe').hide();
                        }
                        else
                        {
                            $('.fadeMe').hide();
                        }
                    },
                    error: function(xhr) { },
                    complete: function() { }
                });
            }
            else 
            {
                var invoiceid = '<?=$invoice_number?>';

                $.ajax({
                    type : 'POST',
                    url : '<?=site_url('fi_home/insertinvnotes')?>',
                    data : { invoiceid:invoiceid,inptxtval:inptxtval,fieldnm:fieldnm,timenotes:timenotes},
                    dataType : 'html',
                    beforeSend: function() 
                    {
                        $('.fadeMe').show();
                    },
                    success: function(data) 
                    {
                        var custid = '<?=$cus_id?>';
                        //var custid= localStorage.getItem("pckId");
                        if(data=="success")
                        {
                            fngetinvoicedetails(invoiceid,'notes',custid);
                            customer_invoice_notes();
                            $('.fadeMe').hide();
                        }
                        else
                        {
                            $('.fadeMe').hide();
                        }
                    },
                    error: function(xhr) { },
                    complete: function() { }
                });
            }
        }

        function customer_invoice_notes()
        {
            var invoice_number = '<?=$invoice_number?>';
            var cus_id = '<?=$cus_id?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/customer_invoice_notes')?>',
                data: { invoice_number:invoice_number, cus_id:cus_id},
                dataType: 'text',
                success: function(data) {
                   $(".customer_invoice").html(data);
                }
            });

        }

/*-------------------------- 3. pickup Notes END ---------------------------------------------------------------------------------*/
/*-------------------------- 3. pickup info START  ---------------------------------------------------------------------------------*/
    
        $(document).ready(function() 
        {
            $("body").on("click", "#chkpickupreq, .chkpickupreq", function(event) 
            {
                var hdnpreqid =  $(this).parents(".tr_clone").find(".hdnpreqid").val();

                var invoiceid = '<?=$invoice_number?>';
                //var invoiceid =  $(this).parents(".tr_clone").find(".invoiceid").val();

                $.ajax({
                    type      : 'POST',
                    url       : '<?=site_url('fi_home/fnpickupreq_info')?>',
                    data      : {hdnpreqid:hdnpreqid},
                    dataType  : 'text',
                    beforeSend: function() {
                      $('.fadeMe').show();
                    },
                    success: function(data) 
                    {
                        var custid = '<?=$cus_id?>';
                        if(data == "success") {
                            fngetinvoicedetails(invoiceid,'pickup',custid);
                            customer_invoice_pickupinfo();
                            $('.fadeMe').hide();
                        }
                        else if(data=="error") 
                        {
                            $('.fadeMe').hide();
                        }
                    },
                    error: function(xhr) { },
                    complete: function() { }
                });
            });
        });

        function fnupdatepickpedinfo(inptxtval,pid,fieldnm,invoiceid,pckrcid)
        {
            event.preventDefault();
            if(fieldnm=="pickup_date")
            {
                var arr = inptxtval.split("/");
                inptxtval = arr[2]+"-"+arr[0]+"-"+arr[1];
            }

            $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updtpickupinfo')?>',
                data: {pid:pid,inptxtval:inptxtval,fieldnm:fieldnm,pckrcid:pckrcid},
                dataType: 'text',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    //var custid= localStorage.getItem("pckId");
                    var custid = '<?=$cus_id?>';
                    var invoiceid = '<?=$invoice_number?>';
                    if(data=="success")
                    {
                        $('.fadeMe').hide();
                        fngetinvoicedetails(invoiceid,'pickup',custid);
                        customer_invoice_pickupinfo();
                    }
                    else if(data=="error")
                    {
                        $('.fadeMe').hide();
                    }
                },
                error: function(xhr) { },
                complete: function() { }
            });
        }

        $(document).ready(function()
        {
            $("body").on("change", "#pickup_quantity, .pickup_quantity", function(event)
            {
                var qty=$(this).val();
                var total_qty=$(this).parent("td").find("#total_qty").val();
                var total_prv_qty=$(this).parent("td").find("#total_prv_qty").val();
                var hdnpreqid=  $(this).parents(".tr_clone").find(".hdnpreqid").val();
                var invoiceid=  $(this).parents(".tr_clone").find(".invoiceid").val();
                var invoiceid = '<?=$invoice_number?>';
                if (total_qty >= qty) 
                {
                    $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/fnpickupreq_info_update')?>',
                        data: {hdnpreqid:hdnpreqid,qty:qty},
                        dataType: 'text',
                        beforeSend: function() 
                        {
                            $('.fadeMe').show();
                        },
                        success: function(data) 
                        {
                            //var custid= localStorage.getItem("pckId");
                            var custid = '<?=$cus_id?>';
                            if(data=="success")
                            {
                                fngetinvoicedetails(invoiceid,'pickup',custid);
                                customer_invoice_pickupinfo();

                                $('.fadeMe').hide();
                            }
                            else if(data=="error")
                            {
                                $('.fadeMe').hide();
                            }
                        },
                        error: function(xhr) { },
                        complete: function() { }
                    });
                }
                else 
                {
                    alert("Please enter valied package item quantity...!");
                    $(this).val(total_prv_qty);
                }
            });
        });

        function customer_invoice_pickupinfo()
        {
            var invoice_number = '<?=$invoice_number?>';
            var cus_id = '<?=$cus_id?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/customer_invoice_pickupinfo')?>',
                data: {invoice_number:invoice_number, cus_id:cus_id},
                dataType: 'text',
                success: function(data) {
                   $(".customer_invoice").html(data);
                }
            });

        }

        /* 3. pickup info END  ---------------------------------------------------------------------------------*/
        /* 2. terms tasks START  ---------------------------------------------------------------------------------*/

        function fnupdatetaksinfo(inptxtval,taksId,fieldnm)
        {
            var invoiceid = '<?=$invoice_number?>';

            if(fieldnm=="task_date_started" || fieldnm=="task_due_date" || fieldnm=="task_completed_date")
            {
                var arr = inptxtval.split("/");
                newdate = arr[2]+"-"+arr[0]+"-"+arr[1];
                
                $.ajax({
                        type: 'POST',
                        url: '<?=site_url('fi_home/updinvtask')?>',
                        data: {taksId:taksId,inptxtval:newdate,fieldnm:fieldnm},
                        dataType: 'text',
                        beforeSend: function() {
                            // setting a timeout
                            $('.fadeMe').show();
                            //alert("invoiceid--"+invoiceid);

                        },
                        success: function(data) {

                            var custid = '<?=$cus_id?>';
                            if(data=="success")
                            {
                                fngetinvoicedetails(invoiceid,'terms',custid);
                                Console.log("fngetinvoicedetails 23");

                                $('.fadeMe').hide();
                            }else if(data=="error"){

                                $('.fadeMe').hide();
                                //alert("Something went wrong..!");
                            }
                        },
                        error: function(xhr) { // if error occured
                          // $('.fadeMe').hide();
                        },
                        complete: function() {
                         // $('.fadeMe').hide();
                        }
                    });



            }else{

                $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/updinvtask')?>',
                data: {taksId:taksId,inptxtval:inptxtval,fieldnm:fieldnm},
                dataType: 'text',
                beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
                success: function(data) {

                    var custid = '<?=$cus_id?>';
                    if(data=="success")
                    {
                        fngetinvoicedetails(invoiceid,'terms',custid);
                        Console.log("fngetinvoicedetails 24");
                        $('.fadeMe').hide();
                    }else if(data=="error"){

                        $('.fadeMe').hide();
                        //alert("Something went wrong..!");
                    }
                },
                error: function(xhr) { // if error occured
                  // $('.fadeMe').hide();
                },
                complete: function() {
                 // $('.fadeMe').hide();
                }
            });
            }
        }

        function fndeltasks(delId,invoiceid)
        {
            var r = confirm("Do you want delete this task..?");
            var invoiceid = '<?=$invoice_number?>';
            if(r == true)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('fi_home/fndelinvtaskinfo')?>',
                    data: {delId:delId,invoiceid:invoiceid},
                    dataType: 'text',
                    beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before invoiceid--"+invoiceid);
                    },
                    success: function(data) {//alert(data);

                        var custid = '<?=$cus_id?>';
                        // var custid= $('#custnm option:selected').val();
                      if(data=="success")
                      {
                         fngetinvoicedetails(invoiceid,'terms',custid);
                         customer_invoice_termstasks();
                         

                         $('.fadeMe').hide();
                      }else if(data=="error"){

                          $('.fadeMe').hide();
                      }

                  },
                  error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();

                  }

              });
         }

        }

        $(document).ready(function()
        {
            $("body").on("keydown", ".lsttaskstrtdate", function(event)
            {
                var key = event.keyCode;
                var temp_edate =  $(this).parents(".tr_clone").find(".lsttaskstrtdate");
                if(key=="107" || key=="187")
                {
                    var dtpls;
                    if(temp_edate.val()=="")
                    {
                        dtpls= new Date();
                    }
                    else
                    {
                        dtpls = new Date(temp_edate.val());
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
         //var today = yyyy + '-' + mm + '-' +  dd;
         var today = mm + '/' + dd + '/' +  yyyy;
         temp_edate.val(today);
         event.preventDefault();

            }else if(key=="68")
            {       //alert("date D");
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

        $(document).ready(function()
        {
            $('body').on('change','.txttotamount',function()
            {
                var temp_txttotamount=$(this).parents('.tr_clone').find('.txttotamount').val();
                var temp_crntrmsid=$(this).parents('.tr_clone').find('.crntrmsid').val();
                var invoiceid=$(this).parents('.tr_clone').find('.trminvid').val();
                var invoiceid = '<?=$invoice_number?>';
                //alert("temp_txttotamount--"+temp_txttotamount+" temp_crntrmsid--"+temp_crntrmsid+" invoiceid--"+invoiceid);

                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('fi_home/updtermamt')?>',
                    data: {temp_crntrmsid:temp_crntrmsid,temp_txttotamount:temp_txttotamount,invoiceid:invoiceid},
                    dataType: 'text',
                    beforeSend: function() {
                        // setting a timeout
                        $('.fadeMe').show();
                        //alert("before invoiceid--"+invoiceid);
                    },
                    success: function(data) {
                        // $("#dispterms").html(data);
                        //var custid= localStorage.getItem("pckId");
                        var custid = '<?=$cus_id?>';
                        // var custid= $('#custnm option:selected').val();
                        if(data="success")
                        {
                            fngetinvoicedetails(invoiceid,'terms',custid);
                            customer_invoice_termstasks();
                            $('.fadeMe').hide();
                        }
                        else
                        {
                            $('.fadeMe').hide();
                        }
                    },
                    error: function(xhr) {
                        // $('.fadeMe').hide();
                    },
                    complete: function() {
                        // $('.fadeMe').hide();
                    }
                });
            });
        });

        function update_field(tbl_nm,set_col_nm,set_col_val,whr_col_nm,whr_col_val,field_type) //  for date field_type="date"
        {
            //alert(tbl_nm+":"+set_col_nm+":"+set_col_val+":"+whr_col_nm+":"+whr_col_val+":"+field_type);
            $.ajax({
                type: 'POST',
                url: '<?=site_url('fi_home/update_field')?>',
                data: {tbl_nm:tbl_nm,set_col_nm:set_col_nm,set_col_val:set_col_val,whr_col_nm:whr_col_nm,whr_col_val:whr_col_val,field_type:field_type},
                dataType: 'text',
                beforeSend: function() {
                    $('.fadeMe').show();
                },
                success: function(data) {
                    
                },
                error: function(xhr) {
                },
                complete: function() {
                }
            });
        }

        function updateinvtermsinfo(trmtype,trmamt,trmid,invoiceid,totsts)
        {
            $.ajax({
                type: "POST",
                url: "<?=base_url('fi_home/updtinvtermsinfo'); ?>",
                data: {trmtype:trmtype,trmamt:trmamt,trmid:trmid,invoiceid:invoiceid,totsts:totsts},
                dataType: 'html',
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                },
                success: function(data)
                {
                    $("#dispterms").html(data);
                    $('.fadeMe').hide();
                }
            });
        }

        $(document).ready(function()
        {
            $('body').on('change','.txttermstype',function()
            {
                var temp_txttermstype= $(this).parents('.tr_clone').find('.txttermstype').val();
                var temp_txttermstypId= $(this).parents('.tr_clone').find('.txttermstype option:selected').text();
                var temp_txtamount= $(this).parents('.tr_clone').find('.txttotamount');// txtamount
                var temp_trmsubtot= $(this).parents('.tr_clone').find('.trmsubtot').val();
                var temp_crntrmsid= $(this).parents('.tr_clone').find('.crntrmsid').val();
                var temp_trminvid= $(this).parents('.tr_clone').find('.trminvid').val();
                var temp_trmtypeid= $(this).parents('.tr_clone').find('.trmtypeid').val();

                var termtot=0;
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('fi_home/gettermsinfo'); ?>",
                    data: {temp_txttermstype:temp_txttermstype,temp_txttermstypId:temp_txttermstypId},
                    dataType: 'json',
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data)
                    {
                        var myobj=data.admtermsdata;
                        temp_txtamount.val(myobj.amount);
                        updateinvtermsinfo(temp_txttermstypId,myobj.amount,temp_crntrmsid,temp_trminvid,myobj.totsts);
                        $('.fadeMe').hide();
                    }
                });
            });
        });

        function fndelterms(invtrmsId,invoiceid)
        {
            event.preventDefault();
            var invoiceid = '<?=$invoice_number?>';
            
            var r = confirm("Do you want delete this terms..?");
            if(r == true)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('fi_home/delterms')?>',
                    data: {invtrmsId:invtrmsId,invoiceid:invoiceid},
                    dataType: 'text', //text
                    beforeSend: function() {
                        $('.fadeMe').show();
                    },
                    success: function(data) {
                        var custid = '<?=$cus_id?>';
                        if(data=="success")
                        {
                            fngetinvoicedetails(invoiceid,'terms',custid);
                            customer_invoice_termstasks();
                            $('.fadeMe').hide();
                        }
                        else
                        {
                            $('.fadeMe').hide();
                        }
                    },
                    error: function(xhr) { },
                    complete: function() { }
                });
            }
        }

        function loadinvtopinfo(invoiceid, custid)
        {
            $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_home/getSearchInvInfo'); ?>",
                data: {invoiceid:invoiceid,custid:custid},
                dataType: 'html',
                beforeSend: function() { },
                success: function(data) {
                    if(data!="")
                    {
                        $('.loaduppertabcntdtls').html(data);
                        $('#dispinvnotes tr:nth-last-child(2)').find("input[name='note_invchk']").focus();
                    }
                    else
                    {
                        $('.loaduppertabcntdtls').html(data);
                    }
                    
                }
            });
        }

        function fngetinvoicedetails(invoiceid, tbparam, custid) 
        {
            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fngetinvoiceinfo')?>',
            data: {invoiceid:invoiceid, custnm:custid},
            dataType: 'html',
            
            beforeSend: function() {
                $('.fadeMe').show();
            },

            success: function(data) 
            {
                $('#divloadinvtabs').html(data);
                loadinvtopinfo(invoiceid,custid);


                if(tbparam != undefined) { }
        
                $('#divloadinvtabs .tab-pane').removeClass('active');
                var trr1 = $(".mytabber .nav li.active a").attr("href");
                $('#divloadinvtabs').find(trr1).addClass('active');
                $('.fadeMe').hide();
            },
            error: function(xhr) { },
            complete: function() { }
            });
        }

        function fncrterms(invtrmsId, invoiceid)
        {
          var trmtypeid = $('#trmtypeid').val();
          event.preventDefault();
          var invoiceid = '<?=$invoice_number?>';

          $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/crnewinvterms')?>',
            data: {invoiceid:invoiceid,trmtypeid:trmtypeid},
            dataType: 'text',
            beforeSend: function() 
            {
              $('.fadeMe').show();
            },
            success: function(data) 
            {
              var custid = '<?=$cus_id?>';
              if(data=="success")
              {
                fngetinvoicedetails(invoiceid,'terms',custid);
                customer_invoice_termstasks();
                $('.fadeMe').hide();
              }
              else
              {
                $('.fadeMe').hide();
              }
            },
            error: function(xhr) { },
            complete: function() {}
          });
        }

        function customer_invoice_termstasks()
        {
            var invoice_number = '<?=$invoice_number?>';
            var cus_id = '<?=$cus_id?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/customer_invoice_termstasks')?>',
                data: {invoice_number:invoice_number, cus_id:cus_id},
                dataType: 'text',
                success: function(data) {
                   $(".customer_invoice").html(data);
                   listTask();
                }
            });

        }

        /* 2. terms tasks END  ---------------------------------------------------------------------------------*/

        function savedata(id)
        {
            $('.button_6'+id).click();
        }

        function savedataitem(id)
        {
            $('.button_7'+id).click();
        }

        function additem()
        {
            $('.button_3').click();
        }

        function addpackage()
        {
            $('.button_1').click();
        }

        function changemyvalue(id)
        {
            var amount = $('.changemyamount'+id).val();
            
            $.ajax({
                type: 'POST',
                url: '<?=site_url('Fi_home/changemyvalue')?>',
                data: {id:id, amount:amount},
                dataType: 'text',
                success: function(data) {
                window.location.href = "<?=base_url('fi_home/CustomerInvoice')?>";
                }
            });

        }

        function changeitemamount(id)
        {
            
            var item_name = $('.item_name'+id).children("option:selected").val();
            var amount = $('.total_focus_me_'+id).val();
            var item_quantity = $('.item_quantity'+id).val();
            $.ajax({
                type: 'POST',
                url: '<?=site_url('Fi_home/changeitemvalue')?>',
                data: {id:id, amount:amount, item_quantity:item_quantity, item_name:item_name},
                dataType: 'text',
                success: function(data) {
                window.location.href = "<?=base_url('fi_home/CustomerInvoice')?>";
                }
            });

        }

        

        

        

        function removeitem(id)
        {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/removeitem')?>',
                data: { id:id },
                dataType: 'text',
                success: function(data) {
                  $('.delete_item'+id).hide();
                }
            });
        }

        function customer_invoice_item() 
        {

            var invoice_number = '<?=$invoice_number?>';
            var cus_id = '<?=$cus_id?>';

            $.ajax({
                type: 'POST',
                url: '<?=site_url('AjaxController/custmer_invoice_item')?>',
                data: { invoice_number:invoice_number, cus_id:cus_id },
                dataType: 'text',
                success: function(data) {
                   $(".customer_invoice").html(data);
                }
            });
        }

        $(function() {
            customer_invoice_item();
        });       
    </script>

<script>
    $(document).ready(function()
    {
        $("body").on("keydown", ".taskduedatlast, .taskstrtdate", function(event){
        var key = event.keyCode;
        var temp_edate =  $(this).parents(".tr_clone").find(".taskduedatlast");
        if(key=="107" || key=="187")
        {
            var dtpls;
            if(temp_edate.val()=="")
            {
                dtpls= new Date();
            }
            else
            {
                dtpls= new Date(temp_edate.val());
            }
            var today = dtpls;
            dtpls.setDate(dtpls.getDate() + 1);
            var dd = String(dtpls.getDate()).padStart(2, '0');
            var mm = String(dtpls.getMonth() + 1).padStart(2, '0');
            var yyyy = dtpls.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;

            temp_edate.val(today);
            $(this).val(today);
            event.preventDefault();

        }
        else if(key=="109" || key=="189")
        {
            var dtmns;
            if(temp_edate.val()=="")
            {
                dtmns= new Date();
            }
            else
            {
                dtmns= new Date(temp_edate.val());
            }
            var today = dtmns;
            dtmns.setDate(dtmns.getDate() - 1);

            var dd = String(dtmns.getDate()).padStart(2, '0');
            var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = dtmns.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;

            temp_edate.val(today);
            $(this).val(today);
            event.preventDefault();

        }
        else if(key=="68")
        {

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + '/' + dd + '/' + yyyy;
            temp_edate.val(today);
            $(this).val(today);
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
                      $(this).val(today);

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

        $("body").on("keydown", ".startdate, .enddate, .taskcompleteddateu", function(event){
        var key = event.keyCode;
        var temp_edate =  $(this).parents(".tr_clone").find(".enddate");


        if(key=="107" || key=="187")
        {
            var dtpls;
            if(temp_edate.val()=="")
            {
                dtpls= new Date();
            }
            else
            {
                dtpls= new Date(temp_edate.val());
            }
            
            var today = dtpls;
            dtpls.setDate(dtpls.getDate() + 1);

            var dd = String(dtpls.getDate()).padStart(2, '0');
            var mm = String(dtpls.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = dtpls.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;

            temp_edate.val(today);
            $(this).val(today);
            event.preventDefault();

        }
        else if(key=="109" || key=="189")
        {
            var dtmns;
            if(temp_edate.val()=="")
            {
                dtmns= new Date();
            }
            else
            {
                dtmns= new Date(temp_edate.val());
            }
            var today = dtmns;
            dtmns.setDate(dtmns.getDate() - 1);

            var dd = String(dtmns.getDate()).padStart(2, '0');
            var mm = String(dtmns.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = dtmns.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;

            temp_edate.val(today);
            $(this).val(today);
            event.preventDefault();

        }
        else if(key=="68")
        {

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + '/' + dd + '/' + yyyy;
            temp_edate.val(today);
            $(this).val(today);
            //$('.enddate').val(today);
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
                      $(this).val(today);

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
    <script type="text/javascript">
                    $(function() {

                    $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_home/getSearchCustContactInfo'); ?>",//getSearchInvoiceInfo
                data: {name:<?=$cus_id?>},
                dataType: 'html',
                
                success: function(data)
                {
                    $('.loaduppertabcntdtls').html(data);
                }
            });
            });
    </script>
    <script>
        $(".download_pdf").change(function() 
        {
            var download_pdf = $(".download_pdf option:selected").val();
            window.open("<?=base_url("AjaxController/")?>"+download_pdf);
            //window.location.href = "<?=base_url("AjaxController/")?>"+download_pdf;
        });

        $(document).ready(function(){
            $('body').on('change','.taskcompleted',function(){
            
                var task_date_started   = $(this).parents('.tr_clone').find('.lsttaskstrtdate').val();
                var task_type           = $(this).parents('.tr_clone').find('.lsttaskname').val();
                var sub_task_type       = $(this).parents('.tr_clone').find('.lstsubtask').val();
                var task_user           = $(this).parents('.tr_clone').find('.task_user').val();
                var task_completed      = $(this).parents('.tr_clone').find('.taskcompleted').val();
                var task_due_date       = $(this).parents('.tr_clone').find('.taskduedatlast').val();
                
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_home/savetask'); ?>",
                    data: { task_date_started   : task_date_started,
                            task_type           : task_type, 
                            sub_task_type       : sub_task_type, 
                            task_user           : task_user,
                            task_due_date       : task_due_date, 
                            task_completed      : task_completed },
                    dataType: 'html',
                    success: function(data)
                    {
                        listTask();
                        //$('.loaduppertabcntdtls').html(data);
                    }
                });
            });
        });

        $(document).ready(function(){
            $('body').on('change','.lsttaskstrtdateu',function(){
            
                var task_date_started   = $(this).parents('.tr_clone').find('.lsttaskstrtdateu').val();
                var task_type           = $(this).parents('.tr_clone').find('.lsttasknameu').val();
                var sub_task_type       = $(this).parents('.tr_clone').find('.lstsubtasku').val();
                var task_user           = $(this).parents('.tr_clone').find('.task_useru').val();
                var task_completed      = $(this).parents('.tr_clone').find('.taskcompletedu').val();
                var task_due_date       = $(this).parents('.tr_clone').find('.taskduedatlastu').val();
                var taskId              = $(this).parents('.tr_clone').find('.taskIdu').val();               
                var taskcompletedbyu    = $(this).parents('.tr_clone').find('.taskcompletedbyu').val();
                var taskcompleteddate   = $(this).parents('.tr_clone').find('.taskcompleteddateu').val();
                var tasknoteu           = $(this).parents('.tr_clone').find('.tasknoteu').val();
                var taskenterbyu        = $(this).parents('.tr_clone').find('.taskenterbyu').val();                               

                $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_home/updatetask'); ?>",
                    data: { task_date_started   : task_date_started,
                            task_type           : task_type, 
                            sub_task_type       : sub_task_type, 
                            task_user           : task_user,
                            task_due_date       : task_due_date, 
                            task_completed      : task_completed,
                            taskIdu             : taskId,
                            taskcompleteddate   : taskcompleteddate,
                            tasknoteu           : tasknoteu,
                            taskenterbyu        : taskenterbyu
                             },
                    dataType: 'html',
                    success: function(data)
                    {
                        //listTask();
                        //$('.loaduppertabcntdtls').html(data);
                    }
                });
            });
        });

        
        function listTask()
        {
            $.ajax({
                    type: "POST",
                    url: "<?=base_url('Fi_home/listTask')?>",
                    data: { my:'my' },
                    dataType: 'html',
                    beforeSend: function() {
                    $('.fadeMe').show();
                    },
                    success: function(data)
                    {
                        $('.mytasks').html(data);
                    }
                });
        }
    </script>
</body>