<?php

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
                                                    $onblurupdate = "onblur='saveinvoice(".$row['invoice_id'].")'";
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
                                                    $onblurupdate ="onblur='updatemydata(".$row['invoice_id'].")'";
                                                }?>

                                                

<tr class="tr_clone" style="<?=$background?>">
                                                <td class="1" <?=$selectrow?>><?=$row['invoice_id']?></td>
                                                <td>
                                                    <input class="startdate invoice_date<?=$row['invoice_id']?>" <?=$onblurupdate?>   style="width: 70px; <?=$background?>" type="text" value="<?=date("m/d/Y",strtotime($row['invoice_date']))?>" name="<?=$invoice_date?>"></td>
                                                <td class="3">
                                                    <input class="enddate invoice_due_date<?=$row['invoice_id']?>" <?=$onblurupdate?> type="text" onblur="saveinvoice('<?=$row['invoice_id']?>')"  style="width: 70px; <?=$background?>" value="<?=date("m/d/Y",strtotime($row['invoice_due_date']))?>" name="<?=$invoice_due_date?>">
                                                </td>
                                                <td>
                                                    <select class="event_id<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$event_id?>" style="width: 100%; <?=$background?>"> <?php
                                                        if(!$row['invoice_type'] || $row['invoice_type'] == 0)
                                                        {   ?>
                                                            <option></option> <?php
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
                                                <td>
                                                    <select class="invoice_contract_type<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$invoice_contract_type?>" style="width: 100%; <?=$background?>" >
                                                    <?php
                                                    if(!$row['invoice_contract_type']  || $row['invoice_contract_type'] == 0 )
                                                    { ?>
                                                        <option></option>
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
                                                </td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['invoice_amount']?><span></td>
                                                <td>
                                                    <select class="invoice_discount<?=$row['invoice_id']?>" name="<?=$invoice_discount?>" style="width: 100%; <?=$background?> ">
                                                        <option value="" > </option> 
                                                        <option  <?php if($row['invoice_discount'] == '1'){ echo "selected"; } ?> value="1">$</option>
                                                        <option <?php if($row['invoice_discount'] == '2'){ echo "selected"; } ?> value="2">%</option>
                                                    </select >
                                                </td>
                                                
                                                <td style="text-align: right;" >
                                                    <span style="margin-right: 5px;">
                                                    <input class="discounted_amt<?=$row['invoice_id']?>" <?=$onblurupdate?> style="width: 70px; <?=$background?> " type="text" name="<?=$discounted_amt?>" value="<?=$row['discounted_amt']?>">
                                                    </span>
                                                </td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['after_discount_amount']?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['item_sub_total']?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['invoice_tax']?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=number_format((float)$row['invoice_paid'], 2, '.', '')?></span></td>
                                                <td style="text-align: right;" ><span style="margin-right: 5px;">$<?=$row['invoice_balance_due']?></span></td>
                                                <td>
                                                    <select class="saveinvoicetax<?=$row['invoice_id']?>" <?=$onblurupdate?> name="<?=$invoice_county?>" style="width: 100%; <?=$background?>" >
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
                                                    <input class="invoice_tax_rate<?=$row['invoice_id']?>" <?=$onblurupdate?> style="text-align:right; width:70px; <?=$background?>" type="text" name="<?=$invoice_tax_rate?>" value="<?=$row['invoice_tax_rate']?>">
                                                    </span> 
                                                </td>
                                                <td><?=$row['admin']?></td>
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
                                                </tr>