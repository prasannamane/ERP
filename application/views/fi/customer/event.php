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
    .edborder { padding: 1px;  border: 0px solid #ececec; }
    .edborder2 { padding: 0px; border: 0px solid #ececec; }
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

    //print_r($events_register);
    foreach($events_register as $event) 
    { 
        $event_date = date("m/d/Y", strtotime($event['event_date']));
        $event_time = $event['event_time'];
           
    }

                //SELECT `event_id`, `cus_id`, `user`, `inv_id`, `event_type`, `event_name`, `event_date`,
//`event_time`, `event_end_date`, `event_end_time`, `event_booked`, `event_lost`, `event_guest`,
//`event_hebrew_date`, `event_day`, `event_referred_by`, `event_note`, `event_created_date` FROM
//`events_register` WHERE 1


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
            <h2 style="    margin-top: 10px;
    margin-bottom: -8px;
}"><?=$title?></h2>
        </div>
        
        <div class="w25" style="margin: 40px 0px 0px 0px;"> 
            <table style="color: #5a5a5a; font-size: 14px; ">
            <tr><th style="border-bottom: 0px solid #ddd;">Event Date</th>        <td style="border-bottom: 0px solid #ddd;"><?=$event_date?></td></tr>
            <tr><th style="border-bottom: 0px solid #ddd;">Event Time</th>        <td style="border-bottom: 0px solid #ddd;"><?=$event_time?></td></tr>
                <!--<tr><th style="border-bottom: 0px solid #ddd;">Invoice</th>     <td style="border-bottom: 0px solid #ddd;"><?=$invoice_id?></td></tr>
                <tr><th style="border-bottom: 0px solid #ddd;">Date</th>        <td style="border-bottom: 0px solid #ddd;"><?=$invoice_date?></td></tr>
                <tr><th style="border-bottom: 0px solid #ddd;">Due Date</th>    <td style="border-bottom: 0px solid #ddd;"><?=$invoice_due_date?></td></tr>
                <tr><th style="border-bottom: 0px solid #ddd;">Balance</th>     <td style="border-bottom: 0px solid #ddd;">$<?=$invoice_balance_due?></td></tr>
            -->
            </table>
        </div>
    </div>

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
                <?php
                $wid = "width: 36%";
                if($crews_commited == 1)
                    {
                        
                        $wid = $wid/2;
                    }
                    ?>
                    <th class="edborder" style="<?=$wid?>; ">Type</th>
                    <?php if($crews_commited == 1)
                    {
                        ?><th class="edborder" style="<?=$wid?>; text-align:center">Vendor</th><?php
                    }
                    ?>
                    <th class="edborder" style="width: 20%; text-align:center">Start Time</th>
                    <th class="edborder" style="width: 16%; text-align:center">End Time</th>
                    <th class="edborder" style="width: 14%; text-align:right">Hourly Overtime </th>
                    <th class="edborder" style="width: 22%; text-align:center"> Location</th>           
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
                        <td class="edborder" style="padding: 0px 20px 0px 5px; text-align:right">$<?=$crews['crews_over_time']?></td>
                        <td class="edborder" style="padding: 1px; text-align:center"><?=$crews['crews_location']?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <h4 style="text-align:center; margin-bottom: -8px; ">Locations</h4>
            <hr>
            <table style="font-size:11px; color: #5a5a5a;">
                <tr>
                    <th class="edborder" style="text-align:">Name</th>
                    <th class="edborder" style="text-align:center">Address</th>
                    <th class="edborder" style="text-align:center">Phone</th>
                    <th class="edborder" style="text-align:center">Time</th>
                </tr>
                <?php foreach($location as $loca)
                { ?>
                <tr>
                    <td class="edborder" style="padding: 1px; text-align:"><?=$loca['location_type']?></td>
                    <td class="edborder" style="padding: 1px; text-align:center"><?=$loca['location_address']?></td>
                    <td class="edborder" style="padding: 1px; text-align:center"><?=$loca['location_phone']?></td>
                    <td class="edborder" style="padding: 1px; text-align:center"><?=$loca['location_time']?></td>
                </tr>
                <?php
                }
                ?>
            </table>

            <h4 style="text-align:center; margin-bottom: -8px; ">Job Info</h4>
            <hr>
            <table style="font-size:11px; color: #5a5a5a; line-height: 16px;">
                <?php foreach($event_jobs as $job)
                { ?>
                <tr style=""><td class="edborder2" colspace="8"><span> &nbsp;</span></td></tr>
                    <tr style="border-bottom: 1px solid #c1c1c1; line-height:13px">
                        <th class="edborder2" style="width:12%; text-align:"><?=$job['jb_name']?></th>
                        <th class="edborder2" style="width:11%; text-align:center"></th>
                        <th class="edborder2" style="width:11%; text-align:center"><?=$job['jb_type']?></th>
                        <th class="edborder2" style="width:11%; text-align:center"></th>
                        <th class="edborder2" style="width:11%; text-align:center"></th>
                        <th class="edborder2" style="width:11%; text-align:center"></th>
                        <th class="edborder2" style="width:22%; text-align:center"></th>
                        <th class="edborder2" style="width:11%; text-align:center"></th>
                    </tr>
                    <tr style="border-bottom: 1px solid #c1c1c1; line-height: 13px; font-size: 9px; color: #a09e9e;">
                        <td class="edborder2" style="text-align:cent\er">Type</td>
                        <td class="edborder2" style="text-align:center">Name</td>
                        <td class="edborder2" style="text-align:center">Spouse</td>
                        <td class="edborder2" style="text-align:center">Children</td>
                        <td class="edborder2" style="text-align:center">Crew Meber</td>
                        <td class="edborder2" style="text-align:center">Time</td>
                        <td class="edborder2" style="text-align:center">Note</td>
                        <td class="edborder2" style="text-align:center">Phone</td>
                       
                    </tr>
                    <?php

                    $cond11 = array('job_id' => $job['jb_id']);
                    $tbl11 = "event_jobs_dtls";
                    $event_jobs_dtls = $this->HomeModel->get_all_by_cond($tbl11, $cond11);
                    foreach($event_jobs_dtls as $job_dtl)
                    { ?>
                    
                    <tr style="line-height: 13px;">
                        <td class="edborder2" style="padding: 0px; text-align:"><?=$job_dtl['jobs_type']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_fname']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_spouse']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_children']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_crew_number']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_start_time']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_note']?></td>
                        <td class="edborder2" style="padding: 0px; text-align:center"><?=$job_dtl['jobs_phone']?></td>
                    </tr>
                    <?php
                    }
                }
                ?>
        </table>   
    </div>
</div>

   
</div>