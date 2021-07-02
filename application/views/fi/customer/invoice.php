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
</div>