<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    table 
    {
        border-collapse: collapse;
        width: 100%;
    }
    
    th, td 
    {
        padding: 4px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }   

    .allbody 
    {
        font-family: 'Segoe UI',Arial,sans-serif;     
        margin: 5% 20% 5% 20%;
    }

    .w25 { width:25%; }
    .w30 { width:30%; }
    .w33 { width:33%; }
    .w50 { width:50%; }
    .w66 { width: 66%; }
    .w70 { width: 70%; }
    .w75 { width:75%; }
    .flex { display: flex; }
    .myimage { max-width: 120px; }
    tr:hover { background-color:#f5f5f5; }

    h4 
    {
        margin-block-start: 5px;
        margin-block-end: 5px;
        color: #5a5a5a;
    }

    .notes
    { 
        border: 1px solid #c5c4c4; 
        margin-top: 6px; 
        box-shadow: 1px 1px #d0d0d0; 
        padding: 0px 0px 0px 5px; 
        border-radius: 1px; 
    }

    @media print
    {    
        .allbody
        {
            margin: 1% 1% 1% 1%;
        }
    }

    .condetail
    {
        font-size: 10px;
        text-align: justify;
        word-spacing: 0px;
        line-height: 10px;
    }

    .admininfo { margin: 12px -1px 0px 0px; }
    .edborder { padding: 1px; border: 0px solid #ececec; }
</style>
    <?php
    foreach($users as $user) 
    { 
        $company = $user['company'];
        $mobile_no = $user['mobile_no'];
        $fax = $user['fax']; 
        $email = $user['email'];
        $web = $user['web'];
        $address = $user['address'];                
        $logo = $user['logo'];
    } 

    foreach($register_customer as $customer) 
    { 
        $cus_company_name = $customer['cus_company_name'];
        $cus_lname = $customer['cus_lname'];
        $cus_fname = $customer['cus_fname'];      
    }

    foreach($invoices_create as $invoices) 
    { 
        $invoice_id = $invoices['invoice_id'];
        $invoice_date = $invoices['invoice_date'];
        $invoice_due_date = $invoices['invoice_due_date'];
        $invoice_balance_due = $invoices['invoice_balance_due'];      
    }
    ?>

<div class="allbody">
    <div class="flex">
        <div class="w25" style="color: #5a5a5a; margin: 25px 0px 0px 1px; font-size: 14px; ">
            <h4>Bill To</h4>
            <?=$cus_company_name?><br>
            <?=$cus_lname?> <?=$cus_fname?><br>
            <?php
            foreach($user_contact_info as $ucinfo) 
            { 
                if($ucinfo['contact_no'] != '')
                {
                    echo 'Phone '.$ucinfo['contact_no'].'<br>';
                }
                if($ucinfo['email'] != '')
                {
                    echo 'Email '.$ucinfo['email'].'<br>';
                }                  
            }

            foreach($cacontacts as $ca) 
            { 
                if($ca['address'] != '')
                {
                    echo $ca['address'].'<br>';
                }
                if($ca['home'] != '')
                {
                    echo 'Home Phone: '.$ca['home'].'<br>';
                }
                if($ca['cel'] != '')
                {
                    echo 'Cell Phone: '.$ca['cel'].'<br>';
                }
                if($ca['work'] != '')
                {
                    echo 'Work Phone: '.$ca['work'].'<br>';
                }
                if($ca['email'] != '')
                {
                    echo 'Email: '.$ca['email'].'<br>';
                }      
            }
            ?>
        </div>
    
        <div class="w50" style="text-align: center;">
            <img class="myimage" src="<?=base_url('assets/invoice/'.$logo)?>">
            <div style="color: #5a5a5a; font-size: 14px;">
                <p class="admininfo">
                    <?=$address?><br>
                    <i class="fa fa-phone" style="font-size:12px"></i>  <?=$mobile_no?>&nbsp;&nbsp; <i class="fa fa-fax" style="font-size:12px"></i> <?=$fax?><br>
                    <i class="fa fa-envelope" style="font-size:12px"></i>  <?=$email?><br>
                    <?=$web?>
                </p>
            </div>
            <h2 style="margin-bottom: 0px;"><?=$title?></h2>
        </div>
        
        <div class="w25" style="margin: 40px 0px 0px 0px;"> 
            <table style="color: #5a5a5a; font-size: 14px; ">
                <tr><th style="border-bottom: 0px solid #ddd;">Invoice</th>     <td style="border-bottom: 0px solid #ddd; text-align: right; width: 80px;"><?=$invoice_id?></td></tr>
                <tr><th style="border-bottom: 0px solid #ddd;">Date</th>        <td style="border-bottom: 0px solid #ddd; text-align: right;"><?=$invoice_date?></td></tr>
                <tr><th style="border-bottom: 0px solid #ddd;">Due Date</th>    <td style="border-bottom: 0px solid #ddd; text-align: right;"><?=$invoice_due_date?></td></tr>
                <tr><th style="border-bottom: 0px solid #ddd;">Balance</th>     <td style="border-bottom: 0px solid #ddd; text-align: right;">$<?=$invoice_balance_due?></td></tr>
            </table>
        </div>
    </div>
    <h4 style="text-align:center; margin-bottom: -8px; ">Event Details</h4>
    <hr>      
    <?php
    $crews_commited = 0;
    foreach($event_crews as $crews )
    {
        if($crews['crews_commited'] == 1)
        {
            $crews_commited = 1;
        }
    }
    ?>
        <table style="font-size:11px; color: #5a5a5a;">
                <tr>
                    <th class="edborder" style="width: 25%; ">Type</th>
                    <?php if($crews_commited == 1)
                    {
                        ?><th class="edborder" style="width: 15%; text-align:center">Vendor</th><?php
                    }
                    ?>
                    <th class="edborder" style="width: 18%; text-align:center">Start Time</th>
                    <th class="edborder" style="width: 17%; text-align:center">End Time</th>
                    <th class="edborder" style="width: 20%; text-align:center">Hourly Overtime </th>
                    <th class="edborder" style="width: 20%; text-align:center"> Location</th>           
                </tr>
                <?php 
                foreach($event_crews as $crews)
                {
                    ?>
                    <tr>
                        <td class="edborder" style="padding: 1px; "><?=$crews['crews_type']?></td>
                        <?php if($crews_commited == 1)
                        {
                            ?><td class="edborder" style="padding: 1px; text-align:center"><?=$crews['crews_vendor']?></td><?php
                        } ?>
                        <td class="edborder" style="padding: 1px; text-align:center"><?=date("m/d/Y", strtotime($crews['crews_start_date']))?> <?=$crews['crews_start_time']?></td>
                        <td class="edborder" style="padding: 1px; text-align:center"><?=date("m/d/Y", strtotime($crews['crews_end_date']))?> <?=$crews['crews_end_time']?></td>
                        <td class="edborder" style="padding: 1px; text-align:center">$<?=$crews['crews_over_time']?></td>
                        <td class="edborder" style="padding: 1px; text-align:center"><?=$crews['crews_location']?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

    <h4 style="margin-block-start: 15px; margin-left: 10px; margin-block-end: -26px;">Services to Include</h4>
    <div style="border: 1px solid #a9a9a9; margin-top: 30px; box-shadow: 2px 2px #d0d0d0; padding: 10px 15px 10px 15px; border-radius: 3px;">
        <div style="margin: 0px 0px 0px 0px;">
            <table style="color: #5a5a5a; font-size: 12px; ">
                <tr>
                    <th style="width: 45%;">Item</th>
                    <th style="width: 15%;text-align:center">Quantity</th>
                    <th style="width: 15%;text-align:right">Price</th>
                    <th style="width: 25%; text-align: right;">Total</th>
                </tr>

               

                <?php
                /* <!-- SELECT `id`, `cus_id`, `inv_id`, `package_id`, `package_name`, `package_price`, 
                 `package_taxable`, `pck_discnt_typ`, `pck_discnt_amt`, `pck_discounted_amt`,
                 `package_create_date`, `sub_total`, `quantity`, `total_price` 
                 FROM `customer_assigned_packages`WHERE 1 */
                foreach($capackages as $package)
                { ?>
                    <tr>
                        <td>
                            <b><?=$package['package_name']?></b><br>
                            <?php 
                                $cond7 = array('assigned_pckid' => $package['id']);
                                $tbl7 = "customers_package_items";
                                $customers_package_items = $this->HomeModel->get_all_by_cond($tbl7, $cond7);
                                foreach($customers_package_items as $item)
                                {
                                    echo $item['item_desc']."<br>";
                                }
                            ?>
                        </td>
                        <td style="text-align:center"><?=$package['quantity']?></td>
                        <td style="text-align:right">$<?=$package['package_price']?></td>
                        <td style="text-align: right;"><b>$<?=$package['total_price']?></b></td>
                    </tr>
                <?php 
                }
                ?>
               
                    <?php 
                    $cond8 = array('assigned_pckid' => '', 'inv_id' => $invoice_number);
                    $tbl8 = "customers_package_items";
                    $customers_package_items = $this->HomeModel->get_all_by_cond($tbl7, $cond7);
                    foreach($customers_package_items as $singleitem)
                    { ?> <tr>
                        <td style=""><?=$singleitem['item_desc']?></td>
                        <td style="text-align:center"><?=$singleitem['item_quantity']?></td>
                        <td style="text-align:right">$<?=$singleitem['item_price']?></td>
                        <td style="text-align: right;"><b>$<?=$singleitem['item_tot']?></b></td>
                        </tr>
                    <?php
                    }
                    ?>    
                
                <tr>
                    <td colspan="2">
                        <div class="notes" style="">
                            <h5 style="margin-block-start: 7px; margin-block-end: -9px;">Payment History</h5>
                            <table style="margin: 10px 0px 0px 0px;font-size: 9px;">
                                <tr>
                                    <th>Date</th>
                                    <th>Descriptin</th>
                                    <th>Amount</th>
                                </tr>
                                <?php foreach($payment as $pay) {  ?>
                                <tr>    
                                    <td><?=$pay['date']?></td>
                                    <td><?=$pay['type']?></td>
                                    <td>$<?=$pay['amount']?></td>
                                <tr>
                                <?php } ?>
                            </table>
                        </div>
                    </td>
                    <td>
                    </td>

                    <td style="text-align: right;padding: 0px;">    
                        <table style="margin: 0px 0px 0px -2px; color: #5a5a5a; font-size: 12px; " >
                            <tr>
                                <td style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;" >Sub Total:</td>
                                <th style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;">$<?=$invoice_amount?></th>
                            </tr>
                            <tr>
                                <td style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;">Tax:</td>
                                <th style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;">$<?=$invoice_tax?></th>
                            </tr>
                            <tr>
                                <td style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;" >Total:</td>
                                <td style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;">$<?=$invoice_balance_due?></td>
                            </tr>
                            <tr>
                                <th style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;">Balence Due:</th>
                                <th style="padding: 0px; border-bottom: 0px solid #ddd; text-align: right;">$<?=$invoice_balance_due?></th>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
            </div>
        <div> 
    </div>   
</div>

    <?php 
    if(!empty($notes)){    
    ?>
    <div class="notes">
        <h4 style="margin-block-start: 7px; margin-block-end: -9px;">Notes</h4>
        <?php foreach($notes as $note) {  ?>
        <p style="style-family:'Segoe UI'; font-size: 12px;"><?=$note['note']?></p>
        <?php } ?>
        </div>
    <?php } ?>

    <div class="">
   <!-- <div class="notes" style="width:50%">
        <h4 style="margin-block-start: 7px; margin-block-end: -9px;">Payment History</h4>
        <table style="margin: 10px 0px 0px 0px;font-size: 9px;">
            <tr>
                <th>Date</th>
                <th>Descriptin</th>
                <th>Amount</th>
            </tr>
            <?php foreach($payment as $pay) {  ?>
            <tr>    
                <td><?=$pay['date']?></td>
                <td><?=$pay['type']?></td>
                <td>$<?=$pay['amount']?></td>
            <tr>
            <?php } ?>
        </table>
    </div> -->
    <div class="notes" style="">
        <h4 style="margin-block-start: 7px; margin-block-end: -9px;">Payment Terms</h4>
        <table style="margin: 10px 0px 0px 0px; font-size: 9px;">
        <tr><?php 
            foreach($invoice_terms as $terms)
            {   ?>
                <th><?=$terms['name']?></th>
            <?php     
            }
            ?>
            </tr><tr>
            <?php

            foreach($invoice_terms as $terms)
            { // SELECT `id`, `invoice_id`, `subcat_id`, `name`, `amount`, `dt`, `totsts`, `entry_log` 
                if($terms['amount'] == 'Remaining Balance')
                {
                    if($invoice_balance_due > 1000)
                    { 
                        $terms['amount'] = $invoice_balance_due - 1000;
                    } 
                } 

                ?>
                
                 
                    <td><?=$terms['amount']?></td>
               
            <?php     
            }
             ?>
 <tr>
            
        </table>
    </div>
    </div>

    <p class="condetail">Contract will only be deemed valid when returned with the required deposit, within 5 days of the date below. In the event of a postponement or cancellation of this contract, the
    deposits will be retained as liquidated damages. The Studio reserves the right to assign any sub-contractor to cover the affair. Photography By Levi Corp. will be providing all photo &
    video services exclusively. Violating this contract will be subject to a penalty of up to $1000. The photographer may insist to remove anyone with photo/video equipment, from the
    areas he is operating. The studio assumes no responsibility for any shots ruined by any outside interference from these people. Album selection must be returned within 90 days of
    picking up the proofs or CD. Order placed later are subject to a surcharge and to prevailing prices at the time the order is placed. The studio offers shipping for a fee, Otherwise, all
    order are to be picked up from the Studio. The studio takes utmost care with respect to the exposure, developing and delivery of photographs or videos. However, in the event we
    don't comply with the terms of this agreement, due to any act beyond our control, our responsibility will be limited to 35% of the fees charged for that specific service. The Studio is
    not responsible for orders left after 90 days from the completion of orders. The undersigned agrees that in the event that certain photographs are missing, that the liability of the
    Studio will be a pro rated amount of consideration paid to this contract. All originals, photo or video remain the sole property of the studio. The studio does not release any original
    photographs or video footage. Video corrections - for errors only, must be submitted within 30 days of receipt of video. The studio reserves the right to use reproductions for display,
    publication and/ or other purposes. Copyright: It is illegal to reproduce/copy photographs or video footage elsewhere without the studio's permission. Partial payments do not entitle
    the customer to part of the order, even if payments were supposed to be split between parties. This is the only agreement between the studio and the client and cannot be changed
    verbally or otherwise unless agreed to in writing by all parties. Copy of this contract will be valid for all legal purposes.
    </p>
    <p style="font-size: 14px; text-align: center;">Customer Signature:__________________________</p>
   
</div>