<?php

    class Payment_Model extends CI_Model 
    {
        function __construct() 
        {
		        parent::__construct();
            //initialise the autoload things for this class
        }

        public function fnGetcreditamtInfo_dtls()
        {
            $credamtjson;
            $creditamountsql=$this->db->query("SELECT * FROM customer_credit_amount WHERE cust_id='".$_POST['custId']."'");
    
            if($creditamountsql->num_rows()>0)
            {
            foreach($creditamountsql->result() as $creditamountsql_dtls)
            {
                $credamtjson['creditamtjson']=$creditamountsql_dtls;
            }
            echo json_encode($credamtjson);
            }
            else
            {
                $credamtjson['creditamtjson']="";
                echo json_encode($credamtjson);
            }
        }

        public function get_sum_dtls($coloumn, $cond, $tbl)
        {
            $sum_val = $this->db->select('SUM('.$coloumn.') as '.$coloumn)
                                ->where($cond)
                                ->get($tbl)
                                ->result_array()[0];
            echo $sum_val["$coloumn"];
        }

        public function fnappliedinvoiceSec_dtls()
        {
            //$pinvoiceId = $_POST['invId'];
            $invpayment_id = $_POST['invpayment_id'];
            //$invsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id = '".$pinvoiceId."'");
            //$getinvrow = $invsql->row();
            //$clinvcust_id = $getinvrow->cust_id;
            
            $query1 = "SELECT * FROM invoices_payment_create WHERE payment_id='".$invpayment_id."' AND status=1 ORDER BY id ASC";
            $upinvsql = $this->db->query($query1);
            foreach($upinvsql->result() as $invsql_dtls)
            {

              ?><tr class="tr_clone">

                      <td><?=$invsql_dtls->invoice_id?>
                        <input type="hidden" class="invsec_allid" value="<?=$invsql_dtls->id?>">
                        <input type="hidden" id="invpayment_id" class="invpayment_id" value="<?=$_POST['hpaymentId']?>">

                      </td>

                      <td><a onclick="fnremovependinv_sec('<?=$invsql_dtls->id?>','<?=$invsql_dtls->applied_amt?>','<?=$invsql_dtls->invoice_id?>','<?=$invpayment_id?>')" class="btn btn-xs btn-danger apply_remove_btn 1"> Remove</a></td>

                      <td><?=sprintf('%0.2f',$invsql_dtls->applied_amt)?> </td>

                      <td>
                      <select class="form-control" disabled>
                             <option value="0">Select</option>
                                <?php
                                  //$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");
                                 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE cus_id='".$invsql_dtls->cust_id."'  GROUP BY event_type ORDER BY event_id ASC ");
                                 $cust_det = $this->db->query("SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = ".$invsql_dtls->cust_id."")->result_array()[0];
                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {
                                       if($evntypsql_dtls->event_id==$invsql_dtls->invoice_type)
                                       {
                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }
                                ?>
                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->event_type?>"><?=$cust_det['cus_fname']." - ".date("m-d-Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?></option>

                              <?php }?>
                          </select>

                      </td>
                      <td>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$invsql_dtls->invoice_due_date?>">
                      </td>
                      <td>
                        <div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                        <span class="glyphicon glyphicon-usd"></span>
                        </span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_amount)?>">
                        </div></div>
                      </td>
                       <td><div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                       <span class="glyphicon glyphicon-usd"></span>
                       </span><input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>"></div></div></td>
                      <td><div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                      <span class="glyphicon glyphicon-usd"></span>
                      </span>
                      <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>">
                    </div></div>
                  </td>
                <!--   <td>
                    <input type="hidden" name="appmnet" id="appmnet_Sec" class="form-control" value="<?=$totinvpaid?>">
                    <input type="hidden" name="baldue" id="baldue_Sec" class="form-control" value="<?=$totclinvbaldue?>">
                    <input type="hidden" name="balramins" id="balramins_Sec" class="form-control" value="<?=$custremnamt?>">
                </td> -->
                    </tr>
              <?php

          }
        }

        



        public function fnremoveinvoiceSec_dtls()
        {
            $pinvId = $_POST['invId'];
            $main_invId = $_POST['main_invId'];
            $invpayment_id = $_POST['invpayment_id'];
            $invsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$main_invId."'");
            $getinvrow = $invsql->row();
            
            $pay_historysql = $this->db->query("SELECT * FROM customer_payment_history WHERE id='".$invpayment_id."'");
            $gethistoryrow = $pay_historysql->row();

            $creadit_amt = $gethistoryrow->credit + $_POST['appliedamt'];
            $amount_amt = $gethistoryrow->amount - $_POST['appliedamt'];
            
            $updthistorypayarr = array(
                "credit2" => $amount_amt,
                "amount2" =>$creadit_amt
            );
            
            $this->db->where('id',$invpayment_id);
            if($this->db->update('customer_payment_history',$updthistorypayarr))
            {
                $clinvcust_id = $getinvrow->cust_id;
                $totinvpaid = $getinvrow->invoice_paid - $_POST['appliedamt'];
                $totclinvbaldue = $getinvrow->invoice_balance_due + $_POST['appliedamt'];

                $updtinvpayarr = array(
                    "invoice_status" => "0",
                    "invoice_paid" => $totinvpaid,
                    "invoice_balance_due" => $totclinvbaldue
                );
            
                $this->db->where('invoice_id',$main_invId);
                if($this->db->update('invoices_create',$updtinvpayarr))
                {
                    $this->db->where('id',$pinvId);
                    $this->db->delete('invoices_payment_create');

                    $upcreditsql = $this->db->query("SELECT * FROM customer_credit_amount WHERE cust_id='".$clinvcust_id."'");
                    $crdtrow = $upcreditsql->row();
                    $crdtnrows = $upcreditsql->num_rows();
                    
                    if($crdtnrows > 0)
                    {
                        $updtcustcreditamount = array(
                            "credit_amount" =>"",
                            "updated_date" => date('Y-m-d H:i:s')
                        );
                 
                        $this->db->where('cust_id',$clinvcust_id);
                        $this->db->update('customer_credit_amount',$updtcustcreditamount);
                    }
                    echo "success";
                }
            }
        }

        public function getpaidinvoicesSec_dtls($payment_id) 
        {
            //$_POST['hpaymentId']
            $query = "SELECT * FROM invoices_payment_create WHERE payment_id='".$payment_id."' AND status=1 ORDER BY id ASC";
            $upinvsql = $this->db->query($query);
            foreach($upinvsql->result() as $invsql_dtls)
            {   ?>
                <tr class="tr_clone">
                    
                    <td class="app_inv_idSec">
                        <span><?=$invsql_dtls->invoice_id?></span>
                        <input type="hidden" class="invsec_allid" value="<?=$invsql_dtls->id?>">
                    </td>
                    
                    <td>
                        <a onclick="fnremovependinv_sec('<?=$invsql_dtls->id?>','<?=$invsql_dtls->applied_amt?>','<?=$invsql_dtls->invoice_id?>','<?= $_POST['hpaymentId'] ?>')" class="btn btn-xs btn-danger apply_remove_btn 2"> Remove</a>
                    </td>

                    <!-- <td><?=$invsql_dtls->applied_amt?> </td> -->
                        <!-- <td class="app_inv_amtSec">
                        <div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                        <span class="glyphicon glyphicon-usd"></span></span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->applied_amt)?>" disabled>
                        </div></div>
                    </td> -->
                    
                    <td class="app_inv_amtSec">
                        <?=sprintf('%0.2f',$invsql_dtls->applied_amt)?> 
                    </td>
                    
                    <td>
                        <?php 
                        //$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC"); GROUP BY event_type
                        $sql = "SELECT * FROM events_register WHERE cus_id='".$invsql_dtls->cust_id."' AND inv_id='".$invsql_dtls->invoice_id."' ORDER BY event_id ASC ";
                        $evntypsql = $this->db->query($sql);
                        //print_r($this->db->last_query());
                        $cust_det = $this->db->query("SELECT cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = ".$invsql_dtls->cust_id."")->result_array()[0];
                        foreach ($evntypsql->result() as $evntypsql_dtls)
                        {
                            ?>
                            <input type="text" name="" class="form-control" value="<?=$evntypsql_dtls->event_name." - ".date("m/d/Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?>" disabled>
                        <?php } ?>
                    </td> 

                    <td>
                        <?php
                        if ($invsql_dtls->invoice_due_date != "") 
                        {
                            $con_date = date("m/d/Y",strtotime($invsql_dtls->invoice_due_date));
                        }
                        else 
                        {
                            $con_date = "";
                        } ?>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$con_date?>">
                    </td>

                    <td>
                        <div class="form-group" style="text-align: -webkit-right; margin-right: 3px">
                            <div class="input-group">
                                <span>$<?=sprintf('%0.2f',($invsql_dtls->invoice_amount + $invsql_dtls->invoice_tax))?></span>
                                <!--<span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                     <span class="glyphicon glyphicon-usd"></span> </span> -->
                                <input type="hidden" name="invoice_payment" class="form-control t-right " value="<?=sprintf('%0.2f',($invsql_dtls->invoice_amount+$invsql_dtls->invoice_tax))?>" disabled>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="form-group"  style="text-align: -webkit-right; margin-right: 3px">
                            <div class="input-group">
                                <span>$<?=sprintf('%0.2f',($invsql_dtls->invoice_paid))?></span>
                                <!--<span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                    <span class="glyphicon glyphicon-usd" style="margin: 1px 0px 0px 8px">
                                    </span>
                                </span> -->
                                <input type="hidden" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>" disabled>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                        <div class="form-group" style="text-align: -webkit-right; margin-right: 3px;">
                            <div class="input-group">
                                <span>$<?=sprintf('%0.2f',($invsql_dtls->invoice_balance_due))?></span>
                                <!--  <span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                    <span class="glyphicon glyphicon-usd" style="margin: 1px 0px 0px 8px">
                                    </span>
                                </span> -->
                                <input type="hidden" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>" disabled>
                                <input type="hidden" name="appmnet" id="appmnet_Sec" class="form-control" value="<?=$totinvpaid?>">
                                <input type="hidden" name="baldue" id="baldue_Sec" class="form-control" value="<?=$totclinvbaldue?>">
                                <input type="hidden" name="balramins" id="balramins_Sec" class="form-control" value="<?=$custremnamt?>">
                            </div>
                        </div>
                    </td>

                    <!-- <td style="width: 0; ">
                        <input type="hidden" name="appmnet" id="appmnet_Sec" class="form-control" value="<?=$totinvpaid?>">
                        <input type="hidden" name="baldue" id="baldue_Sec" class="form-control" value="<?=$totclinvbaldue?>">
                        <input type="hidden" name="balramins" id="balramins_Sec" class="form-control" value="<?=$custremnamt?>">
                    </td> -->
                </tr> <?php
            }
        }

        public function fnappyinvoiceSec_dtls()
        {
            $pinvoiceId = $_POST['invId'];
            $mainInvId = $_POST['hpaymentId'];

            $invsql_invoice = $this->db->query("SELECT * FROM customer_payment_history WHERE id='".$mainInvId."'");
            $invoice_amt_data = $invsql_invoice->row();

            $inv_amt = $invoice_amt_data->amount2 - $_POST['custpayamt'];
            $inv_credit = $invoice_amt_data->credit2 + $_POST['custpayamt'];

            $updtemain_invoice = array(
                "amount2" => $inv_amt,
                "credit2" => $inv_credit,
                "credit" => $inv_amt
                //"amount" => $inv_credit
            );
    
            $this->db->where('id',$mainInvId);
            $res = $this->db->update('customer_payment_history',$updtemain_invoice);

            $invsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$pinvoiceId."'");
            $getinvrow = $invsql->row();

            $invoice_tax = $getinvrow->invoice_tax;
            $clinvcust_id = $getinvrow->cust_id;
            $clinvoice_paid = $getinvrow->invoice_paid;
            $clinvamt = $getinvrow->invoice_amount;
            $clinvdueamt = $getinvrow->invoice_balance_due;
            
            if($_POST['custpayamt'] > $clinvdueamt)
            {
                if($_POST['custpayamt'] > $clinvamt)
                {
                    $totinvpaid = $clinvamt;
                    $totclinvbaldue = "0";
                    $custremnamt = $_POST['custpayamt']-$clinvamt;
                    $custcramt = $_POST['custpayamt']-$clinvamt;
                }
                elseif($_POST['custpayamt'] < $clinvamt)
                {
                    $totinvpaid = $clinvoice_paid + $clinvdueamt;
                    $totclinvbaldue = $clinvdueamt - $_POST['custpayamt'];
                    $custremnamt = $_POST['custpayamt'] - $clinvdueamt;
                    $custcramt = $_POST['custpayamt'] - $clinvdueamt;
                    //$custremnamt="0";
                }
            }
            else
            {
                $totinvpaid = $clinvoice_paid + $_POST['custpayamt'];
                if($totinvpaid > $clinvamt)
                {
                    $totclinvbaldue = $clinvdueamt - $_POST['custpayamt'];
                    $custremnamt = $totinvpaid - $clinvamt;
                    $custcramt = "0";
                }
                elseif($totinvpaid < $clinvamt) 
                {
                    $totclinvbaldue = $clinvdueamt - $_POST['custpayamt'];
                    $custremnamt = $clinvamt - $totinvpaid;
                    $custcramt = "0";
                }
            }

            if($clinvdueamt - $_POST['custpayamt'] /*$totinvpaid*/ < 0)
            {
                $invoice_balance_due = 0;
            }
            else
            {
                $invoice_balance_due = $clinvdueamt - $_POST['custpayamt'] /*$totinvpaid*/;
            }

            $updtinvpaystsarr = array(
                "invoice_status" => "0",
                "invoice_paid" => $totinvpaid,
                "invoice_balance_due" => $invoice_balance_due //$totclinvbaldue 
            );

            /* echo "<tr><td>";
            print_r($updtinvpaystsarr);
            echo "<hr>";
            echo "</td></tr>";*/

            $this->db->where('invoice_id',$pinvoiceId);
            if($this->db->update('invoices_create',$updtinvpaystsarr))
            {
                $upcreditsql = $this->db->query("SELECT * FROM customer_credit_amount WHERE cust_id='".$clinvcust_id."'");
                $crdtnrows = $upcreditsql->num_rows();
                if($crdtnrows == 0)
                {
                    $updtcustcreditamount = array(
                        "cust_id" => $clinvcust_id,
                        "credit_amount" => $custcramt, //$custremnamt,
                    );
                    $this->db->insert('customer_credit_amount',$updtcustcreditamount);
                }
                else
                {
                    $updtcustcreditamount = array(
                        "credit_amount" => $custcramt, //$custremnamt,
                        "updated_date" => date('Y-m-d H:i:s')
                    );
                    $this->db->where('cust_id',$clinvcust_id);
                    $this->db->update('customer_credit_amount',$updtcustcreditamount);
                }

                //Start Insert in backup in copy table
                $sql = "SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invId']."'";
                $getinvsql = $this->db->query($sql);
                $getinvsqlrow = $getinvsql->row();

                $insrtpaymntarr = array(
                    "payment_id"        => $_POST['hpaymentId'],
                    "invoice_id"        => $_POST['invId'],
                    "cust_id"           => $_POST['cus_Id'],
                    "invoice_name"      => $getinvsqlrow->invoice_name,
                    "invoice_date"      => $getinvsqlrow->invoice_date,
                    "invoice_due_date"  => $getinvsqlrow->invoice_due_date,
                    "invoice_type"      => $getinvsqlrow->invoice_type,
                    "invoice_contract_type" => $getinvsqlrow->invoice_contract_type,
                    "invoice_discount"  => $getinvsqlrow->invoice_discount,
                    "invoice_sub_total" => $getinvsqlrow->invoice_sub_total,
                    "invoice_tax"       => $getinvsqlrow->invoice_tax,
                    "invoice_amount"    => $getinvsqlrow->invoice_amount + $getinvsqlrow->invoice_tax, //$getinvsqlrow->invoice_amount,
                    "invoice_paid"      => $getinvsqlrow->invoice_paid,
                    "invoice_balance_due" => $getinvsqlrow->invoice_balance_due,
                    "invoice_tax_rate"  => $getinvsqlrow->invoice_tax_rate,
                    "invoice_county"    => $getinvsqlrow->invoice_county,
                    "invoice_user"      => $getinvsqlrow->invoice_user,
                    "invoice_status"    => $getinvsqlrow->invoice_status,
                    "assigned_pckage"   => $getinvsqlrow->assigned_pckage,
                    "created_date"      => $getinvsqlrow->created_date,
                    "due_bal_status"    => $getinvsqlrow->due_bal_status,
                    "discounted_amt"    => $getinvsqlrow->discounted_amt,
                    "status"            => 1,
                    "applied_amt"       => $_POST['custpayamt']
                );

                /* echo "<tr><td>";
                print_r($sql);
                echo "<hr>";
                print_r($insrtpaymntarr);
                echo "</td></tr>";*/
                
                if($this->db->insert('invoices_payment_create',$insrtpaymntarr))
                {
                    $sql = "SELECT * FROM invoices_payment_create WHERE payment_id='".$_POST['hpaymentId']."' AND payment_id='".$_POST['hpaymentId']."' AND status=1 ORDER BY id ASC";
                    $upinvsql = $this->db->query($sql);
                    foreach($upinvsql->result() as $invsql_dtls)
                    {   ?>
                        <tr class="tr_clone 1">
                            <td class="app_inv_idSec">
                                <span><?=$invsql_dtls->invoice_id?></span>
                                <input type="hidden" class="invsec_allid" value="<?=$invsql_dtls->id?>">
                            </td>

                            <td>
                                <a onclick="fnremovependinv_sec('<?=$invsql_dtls->id?>','<?=$invsql_dtls->applied_amt?>','<?=$invsql_dtls->invoice_id?>','<?= $_POST['hpaymentId'] ?>')" class="btn btn-xs btn-danger apply_remove_btn 3"> Remove</a>
                            </td>

                            <td class="app_inv_amtSec"><?=sprintf('%0.2f',$invsql_dtls->applied_amt)?> 
                            </td>
                            
                            <td><?php
                                $evntypsql = $this->db->query("SELECT * FROM events_register WHERE inv_id='".$invsql_dtls->invoice_id."'  GROUP BY event_type ORDER BY event_id ASC ");
                                $cust_det = $this->db->query("SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = ".$_POST['cus_Id']."")->result_array()[0];
                                foreach ($evntypsql->result() as $evntypsql_dtls)
                                {   ?>
                                    <input type="text" name="" class="form-control" value="<?=$evntypsql_dtls->event_name." - ".date("m/d/Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?>" disabled> <?php 
                                } ?>
                            </td>
                            
                            <td> <?php
                                if ($invsql_dtls->invoice_due_date !="") 
                                {
                                    $con_date =  date("m/d/Y",strtotime($invsql_dtls->invoice_due_date));
                                }
                                else 
                                {
                                    $con_date="";
                                } ?>
                                <input type="text" name="invoice_payment" class="form-control" value="<?=$con_date?>">
                            </td>
                        
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                            <span class="glyphicon glyphicon-usd" style="margin: 1px 0px 0px 8px"></span>
                                        </span>
                                        <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_amount)?>">
                                    </div>
                                </div>
                            </td>
                        
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                       <input type="text" class="form-control t-right" value="$<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>">
                                       <!--  <span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                            <span class="glyphicon glyphicon-usd" style="margin: 1px 0px 0px 8px"></span>
                                        </span> -->
                                        <input type="hidden" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>">
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control t-right" value="$<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>">
                                       <!--  <span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                            <span class="glyphicon glyphicon-usd " style="margin: 1px 0px 0px 8px"></span>
                                        </span> -->
                                        <input type="hidden" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>">
                                        <input type="hidden" name="appmnet" id="appmnet_Sec" class="form-control" value="<?=$totinvpaid?>">
                                        <input type="hidden" name="baldue" id="baldue_Sec" class="form-control" value="<?=$totclinvbaldue?>">
                                        <input type="hidden" name="balramins" id="balramins_Sec" class="form-control" value="<?=$custremnamt?>">
                                    </div>
                                </div>
                            </td>
                        <!-- <td>
                            <input type="hidden" name="appmnet" id="appmnet_Sec" class="form-control" value="<?=$totinvpaid?>">
                            <input type="hidden" name="baldue" id="baldue_Sec" class="form-control" value="<?=$totclinvbaldue?>">
                            <input type="hidden" name="balramins" id="balramins_Sec" class="form-control" value="<?=$custremnamt?>">
                          </td> -->
                        </tr> <?php
                    }
                } //End Insert in backup in copy table-  invoices_payment_create
            }
        }



        public function getCustomerSec_dtls()
        {
            $cName = $this->input->post('name');
            $sql = "SELECT * FROM invoices_create WHERE `cust_id` = '$cName'";
            $cust_inv = $this->db->query($sql);

            $sql1 = "SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = '$cName'";
            $cust_det = $this->db->query($sql1)->result_array()[0];
            foreach($cust_inv->result() as $cus_invoices)
            {   ?>
                <tr class="tr_clone">
                    <td class="invce-id_Sec"><?=$cus_invoices->invoice_id?></td>
                    <td><a class="btn btn-xs btn-primary apply_btn_sec">Apply</a></td><!-- onclick="fnupdateinvosts('<?=$cus_invoices->invoice_id?>')" -->
                    <td>
                       

                        <input type="number" min="1" max="<?=$cus_invoices->invoice_balance_due?>" name="invapplyamt" id="invapplyamtSec<?=$cus_invoices->invoice_id?>" class="invapplyamtSec form-control">
                       </td> 
                        <!-- <td>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                                    <span class="glyphicon glyphicon-usd">
                                    </span>
                                </span>
                                <input type="text" name="invoice_paymentSec" class="form-control t-right" value="<?=sprintf('%0.2f',$cus_invoices->invoice_amount)?>">
                            </div>
                        </div>
                        </td> -->
                    <td><?php
                        //$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");
                        // cus_id='".$cus_invoices->cust_id."' AND
                        $sql3 = "SELECT * FROM events_register WHERE event_id='".$cus_invoices->invoice_type."'";
                        $evntypsql = $this->db->query($sql3);
                        $evntypsqlres = $evntypsql->result(); 

                        //print_r($evntypsqlres);

                        foreach ($evntypsqlres as $evntypsql_dtls)
                        {
                            ?>
                            <input type="text" name="" class="form-control" 
                            value="<?=$evntypsql_dtls->event_name." - ".date("m/d/Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?>" disabled>
                        <?php } ?>

                    </td>
                        <?php
                            if ($cus_invoices->invoice_due_date !="" && $cus_invoices->invoice_due_date !='01/01/1970') 
                        {
                            $con_date= date("m/d/Y",strtotime($cus_invoices->invoice_due_date));
                        }
                        else 
                        {
                            $con_date = "";
                        } ?>
                    <td>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$con_date?>" disabled>
                    </td>

                    <td>
                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-usd" style="">
                                                                </span>
                                                            </span>
                                <input type="text" name="invoice_payment" class="form-control t-right invoice_paid_amtSec" value="<?=sprintf('%0.2f',$cus_invoices->invoice_paid)?>">
                                
                            </div>
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-usd" style="">
                                                                </span>
                                                            </span>
                                <input type="text" name="invoice_payment" class="form-control t-right balance_amtSec" value="<?=sprintf('%0.2f',$cus_invoices->invoice_balance_due)?>">   
                                
                            </div>
                        </div>
                    </td>
                </tr> <?php
            }
        }



        public function fnnewpaymnt_dtls() 
        {            
            $receipt      = $this->input->post('txtreceipt');
            $cus_id       = $this->input->post('name');
            $lsttxtpdate  = $this->input->post('lsttxtpdate');
            $type_val     = $this->input->post('lstpaytype');
            $cre_amt      = $this->input->post('amt');
            $chkno        = $this->input->post('chkno');
            $descp        = $this->input->post('descp');
            $lsttxtnotes  = $this->input->post('lsttxtnotes');

            $balance_count = $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id',$cus_id)->get('invoices_create')->result_array()[0];
            $invoicepaid = $this->db->select('SUM(invoice_paid) as invoice_paid')->where('cust_id',$cus_id)->get('invoices_create')->result_array()[0];

            $invoice_paid = $this->db->select('SUM(amount) as amount')->where('cust_id',$cus_id)->get('customer_payment_history')->result_array()[0];
            $creditbal = $this->db->select('SUM(credit) as credit')->where('cust_id',$cus_id)->get('customer_payment_history')->result_array()[0];
            $credit = 0;
            

            if(($balance_count['total'] + $invoicepaid['invoice_paid']) <= $invoice_paid['amount'])
            {
                $credit = $cre_amt;
                //echo "$credit 1";
            }
            else if(($balance_count['total'] + $invoicepaid['invoice_paid']) <= ($invoice_paid['amount'] + $cre_amt))
            {
                $credit = ( $invoice_paid['amount'] + $cre_amt) - ($balance_count['total'] + $invoicepaid['invoice_paid']) ;
                //echo "$credit 2";
            }

            /*print_r($invoice_paid['amount']);
            echo "<hr>";
                        print_r($cre_amt);
            echo "<hr>";
                        print_r($balance_count['total']);
            echo "<hr>";
                        print_r($creditbal['credit']);
            echo "<hr>";*/

            if($lsttxtpdate != "") 
            {
                $pdate = date("Y-m-d", strtotime($lsttxtpdate));
            }
            else 
            {
                $pdate = date('Y-m-d');
            }
              
            $nwpayment = array(
                "cust_id"   => $cus_id,
                "date"      => $pdate,
                "type"      => $type_val,
                "amount"    => $cre_amt,
                "credit"    => $credit,
                "amount2"   => $cre_amt,
                "credit2"   => 0,
                "chk_num"   => $chkno,
                "pdesc"     => $descp,
                "receipt"   => $receipt,
                "notes"     => $lsttxtnotes,
                "usrename"  => $this->session->userdata['fi_session']['id']
            );

            //print_r($nwpayment);

            if($this->db->insert('customer_payment_history',$nwpayment)) 
            {
                echo "success";
            }
            else
            {
                echo "error";
            }
        }




        



    public function getpaidinvoicesInfo_dtls() {

      $query = "SELECT * FROM invoices_payment_create WHERE payment_id='".$_POST['hpaymentId']."' AND status = 0 ORDER BY id ASC";

      $upinvsql = $this->db->query($query);
      //print_r($query);
      //die;

      foreach($upinvsql->result() as $invsql_dtls) {

        ?>
        <tr class="tr_clone">
          <td class="app_inv_id">
            <span><?=$invsql_dtls->invoice_id?></span>

            <input type="hidden" class="inv_allid" value="<?=$invsql_dtls->id?>">
          </td>

          <td>
            <a onclick="fnremovependinv('<?=$invsql_dtls->id?>','<?=$invsql_dtls->applied_amt?>','<?=$invsql_dtls->invoice_id?>','<?= $_POST['hpaymentId'] ?>')" 
              class="btn btn-xs btn-danger apply_remove_btn"> Remove</a>
          </td>

          <!-- <td><?=$invsql_dtls->applied_amt?> </td> -->
          <td class="paymentid_amt">
                        <div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                        <span class="glyphicon glyphicon-usd"></span></span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->applied_amt)?>" disabled>
                        </div></div>
          </td>

                      <td>
                        <?php

                          //$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");
                          // $cust_det = $this->db->query("SELECT  cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = '$invsql_dtls->cust_id'")->result_array()[0];
                          // print_r($cust_det);
                         $evntypsql=$this->db->query("SELECT * FROM events_register WHERE cus_id='".$invsql_dtls->cust_id."'  GROUP BY event_type ORDER BY event_id ASC ");

                         $cust_det = $this->db->query("SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = ".$invsql_dtls->cust_id."")->result_array()[0];

                          foreach ($evntypsql->result() as $evntypsql_dtls)
                          {
                               if($evntypsql_dtls->event_id==$invsql_dtls->invoice_type)
                               {

                                  $selectedevtyp="selected";
                               }else{

                                   $selectedevtyp="";
                               }

                        ?>
                        <input type="text" name="" class="form-control" value="<?=$cust_det['cus_fname']." - ".date("m/d/Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?>" disabled>
                      <!-- <select class="form-control" disabled>
                             <option value="0">Select</option>

                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->event_type?>"><?=$cust_det['cus_fname']." - ".date("m-d-Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?></option>

                              <?php }?>
                          </select> -->

                      </td>
                      <td>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$invsql_dtls->invoice_due_date?>">
                      </td>
                      <td>
                        <div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                        <span class="glyphicon glyphicon-usd"></span></span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_amount)?>" disabled>
                        </div></div>
                      </td>
                       <td>
                         <div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                         <span class="glyphicon glyphicon-usd">
                         </span></span>
                         <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>" disabled></div>
                       </div></td>
                      <td>
                        <div class="form-group">
                          <div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;">
                            <span class="glyphicon glyphicon-usd">
                            </span>
                          </span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>" disabled>
                        </div>
                      </div>
                    </td>
                    <td>
                      <input type="hidden" name="appmnet" id="appmnet" class="form-control" value="<?=$totinvpaid?>">
                      <input type="hidden" name="baldue" id="baldue" class="form-control" value="<?=$totclinvbaldue?>"><input type="hidden" name="balramins" id="balramins" class="form-control" value="<?=$custremnamt?>"></td>
                    </tr>
              <?php
          }
        }

        public function fnloadpaymentdata_dtls() 
        {
            if ($_POST['cusid'] !="") 
            {
                $payhisql = $this->db->query("SELECT * FROM customer_payment_history WHERE cust_id='".$_POST['cusid']."' ORDER BY id ASC");
                $payhisqlData = $payhisql->result();
                $i = 0;

                foreach ($payhisqlData as $payhisql_dtls) 
                {
                    $adminsql = $this->db->query("SELECT * FROM users WHERE id='".$payhisql_dtls->usrename."'");
                    $adminsqlrow = $adminsql->row(); ?>
                    <tr class="tr_clone">
                        <td>
                            <input type="hidden" name="hdnpayId" id="hdnpayId" class="hdnpayId" value="<?=$payhisql_dtls->id?>">
                            <span class="w20 dblock"><?=$payhisql_dtls->id?></span>
                        </td>
                        <td>
                            <?php $dt = date("m/d/Y", strtotime($payhisql_dtls->date)); ?>
                            <input type="text" id="txtpdate" name="txtpdate" class="form-control txtpdate" placeholder="mm/dd/yyyy" value="<?= ($dt!="01/01/1970")? $dt : ""; ?>"/>
                        </td>
                        <td>
                            <input type="text"  class="form-control txtreceipt" value="<?=$payhisql_dtls->receipt?>"  name="txtreceipt"  id="txtreceipt"  style="width:75px;" />
                        </td>
                        <td>
                            <input type="text" list="listpaytype" class="form-control paytype" name="paytype" id="paytype" onchange="show1(this.value,<?=$payhisql_dtls->id?>)" value="<?=$payhisql_dtls->type?>">
                            <datalist id="listpaytype">
                                <option data-value="Cash"  value="Cash">Cash</option>
                                <option data-value="Check" value="Check">Check</option>
                                <option data-value="Electronic" value="Electronic">Electronic</option>
                                <option data-value="Mastercard" value="Mastercard">Mastercard</option>
                                <option data-value="Money Order" value="Money Order"> Money Order</option>
                                <option data-value="Visa" value="Visa">Visa</option>
                                <option data-value="Credit" value="Credit">Credit</option>
                            </datalist>
                        </td>
                        <td> <?php
                            if ($i == 0) 
                            {
                                $autofocus = "autofocus";
                                $i++;
                            }
                            else 
                            {
                                $autofocus = "";
                            }
                        
                            if ($payhisql_dtls->type == 'Check') 
                            { ?>
                                <input class="form-control txtchkno" type="text"  onkeyup="numOnly(this)" id="txtchkno" name="txtchkno" placeholder="" value="<?=$payhisql_dtls->chk_num?>" <?= $autofocus  ?>><? 
                            }
                            else 
                            { ?>
                                <input class="form-control" type="text"  onkeyup="" id="txtchkno" name="txtchkno" value="<?=$payhisql_dtls->chk_num?>" <?= $autofocus  ?>>
                            <? 
                            } ?>
                        </td>
                        <td>
                            <input class="form-control pdesc" name="pdesc" id="pdesc" type="text" placeholder="" value="<?=$payhisql_dtls->pdesc?>" >
                        </td>                           
                        <td>
                            <div class="form-group dflex ">
                                <div class="input-group w80">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </span>
                                    <?php
                                    if ($payhisql_dtls->type == 'Credit') 
                                    {
                                        if ($payhisql_dtls->status != 1 ) 
                                        {
                                            if ($payhisql_dtls->amount != 0) 
                                            { ?>
                                                <input class="form-control newpmt" type="number" min="1" placeholder="" value="<?=sprintf('%0.2f',$payhisql_dtls->amount)?>" disabled id="amt1"  style="padding: 0 1px;">
                                                <input class="pamt" type="hidden" value="<?=$payhisql_dtls->amount2?>">
                                                </div>
                                                <a data-toggle="modal" data-target="#myModal" class="pay_mdl_btn paybox" value="" disabled="true">
                                                    <i class="fa fa-money" aria-hidden="true"></i>
                                                </a>
                                                <?  
                                            }
                                            else 
                                            { 
                                                ?>
                                                <input class="form-control pamt 1" type="number" min="1" value="<?=sprintf('%0.2f',$payhisql_dtls->amount)?>" placeholder="0.00" id="amt1" style="padding: 0 1px;" readonly>
                                                </div>
                                                <?  
                                            }
                                        }
                                        else 
                                        { 
                                            ?>
                                            <input class="form-control pamt 2" type="number" min="1" value="<?=sprintf('%0.2f',$payhisql_dtls->amount)?>" 
                                            placeholder="" id="amt1" style="padding: 0 1px;">
                                            </div>
                                            <? 
                                        } 
                                    }
                                    else 
                                    {
                                        if ($payhisql_dtls->amount=="") 
                                        {
                                            if ($payhisql_dtls->status !=1) 
                                            {
                                                ?>
                                                <!--      <input class="form-control pamt newpmt" type="number" min="1" placeholder="0.00"  id="amt1" style="padding: 0 1px;">
                                                </div>
                                                <a data-toggle="modal" data-target="#myModal" class="pay_mdl_btn paybox" value="" disabled="true">
                                                <i class="fa fa-money" aria-hidden="true"></i>
                                                </a> -->
                                                <?  
                                            }
                                            else 
                                            {
                                                ?>
                                                <input class="form-control pamt 3 newpmt" type="number" min="1" placeholder="0.00" disabled="true" id="amt1" style="padding: 0 1px;">
                                                </div>
                                                <a data-toggle="modal" data-target="#myModal" class="pay_mdl_btn paybox" value="" disabled="true"><i class="fa fa-money" aria-hidden="true">
                                                <?php 
                                            }
                                        }
                                    else 
                                    {
                                        if ($payhisql_dtls->status ==1) 
                                        {
                                            if ($payhisql_dtls->amount !=0) 
                                            {
                                    ?>
                                    <input class="form-control " type="number" min="1" value="<?=sprintf('%0.2f',$payhisql_dtls->amount)?>" placeholder="0.00" id="amt1" style="padding: 0 1px;" readonly>
                                    <input class="pamt" type="hidden" value="<?=$payhisql_dtls->amount2?>">
                                    </div>
                                    <? 
                                }
                                else
                                { 
                                    ?>
                                    <input class="form-control pamt 5 newpmt" type="number" min="1" placeholder="0.00" disabled="true" id="amt1" style="padding: 0 1px;">
                                    </div>
                                   <!--  <a data-toggle="modal" data-target="#myModal" class="pay_mdl_btn paybox" value="" disabled="true">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                    </a> -->
                                    <? 
                                }
                            }
                            else 
                            { 
                                ?>
                                <!--<input class="form-control pamt newpmt" type="number" min="1" placeholder="0.00"  id="amt1" style="padding: 0 1px;">-->
                                <!--// AKSHAY COMMENTED ABOVE AND AADED BELOW LINE-->
                                <input class="form-control pamt 6 newpmt" type="number" min="1" placeholder="0.00" value="<?=sprintf('%0.2f',$payhisql_dtls->amount)?>"  id="amt1" style="padding: 0 1px;">
                                </div>
                                <a data-toggle="modal" data-target="#myModal" class="pay_mdl_btn paybox" value="" disabled="true">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                </a>
                                <? 
                            }   
                        }
                    }
                    ?>

                    <!-- <a data-toggle="modal" data-target="" data-id="<?=$payhisql_dtls->id ?>" class="pay_mdl_btn paybox edit_class" value="" disabled disabled="true">
                          <i class="fa fa-eye" aria-hidden="true">
                          </i>
                        </a> -->

                    <a data-toggle="modal" data-target="#payment_modal_2" data-id="<?=$payhisql_dtls->id?>" class="pay_mdl_btn  payboxSec poppayboxSec edit_class payboxSec<?=$payhisql_dtls->id?>" value="" disabled="true">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a> 
                </div>
            </td>

            <td>
                <div class="form-group">
                    <div class="input-group w80">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-usd"></span> 
                        </span><?php 
                        //if ($payhisql_dtls->credit !="" ) 
                        //{
                          //  if ($payhisql_dtls->credit !=0 ) 
                            //{ ?>
                                <input class="form-control" value="<?=sprintf('%0.2f',$payhisql_dtls->credit)?>" type="text" value="" disabled placeholder="0.00" id="creditamt" name="creditamt"> 
                                <input class="creditamt" type="hidden" value="<?=$payhisql_dtls->credit2?>">

                                <?  
                            //}
                            //else 
                            //{ ?>
                          <!--       <input class="form-control creditamt" type="text" disabled value="0.00" id="creditamt" name="creditamt"> -->
                           <? 
                            //}
                        //}
                        //else 
                        //{ ?>
                          <!--   <input class="form-control creditamt" type="text" value="" disabled value="0.00" id="creditamt" name="creditamt"> --> <? 
                        //} ?>
                    </div>
                </div>
            </td>

              <td>
                <input type="text" name="txtusdername" id="txtusdername" class="txtusdername form-control text-center" value="<?=$adminsqlrow->name?>" disabled> 
              </td>

              <td>
                <input class="form-control txtnotes" type="text" placeholder="" id="txtnotes" name="txtnotes" value="<?=$payhisql_dtls->notes?>">
              </td>

              <td></td>

              <td>
               <!--   <a class="btn btn-xs btn-danger" onclick="fndelpayment('<?=$payhisql_dtls->id?>')"><i class="fa fa-minus"></i>
               </a>
               <a data-toggle="modal" data-target="#payment_modal_2" class="pay_mdl_btn paybox" value="" disabled="true"><i class="fa fa-eye" aria-hidden="true"></i>
               </a> -->

                <?php 
                if ($payhisql_dtls->amount == "") 
                { ?>
                    <a class="btn btn-xs btn-danger " onclick="fndelpayment('<?=$payhisql_dtls->id?>')" style="margin-right: 16px;">
                        <i class="fa fa-minus"></i>
                    </a>
                    <?  
                }
                else 
                { 
                    if ($payhisql_dtls->status ==1) 
                    { ?>
                        <a class="btn btn-xs btn-danger" onclick="fndelpayment('<?=$payhisql_dtls->id?>')">
                            <i class="fa fa-minus"></i>
                        </a>
                        <?php $popup_me = $payhisql_dtls->id; ?>


                        <!-- <a data-toggle="modal" data-target="#myModal" data-id="<?=$payhisql_dtls->id ?>" class="pay_mdl_btn  payboxSec edit_class payboxSec<?=$payhisql_dtls->id?>" value="" disabled="true">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        </a> --> 

<!--                      <a data-toggle="modal" data-target="#payment_modal_2" data-id="<?=$payhisql_dtls->id ?>" class="pay_mdl_btn  payboxSec edit_class payboxSec<?=$payhisql_dtls->id?>" value="" disabled="true">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>  -->
                  <?php 
                  } 
                  else { ?>
                        <a class="btn btn-xs btn-danger" onclick="fndelpayment('<?=$payhisql_dtls->id?>')" style="margin: 4px 16px 0 0;">
                          <i class="fa fa-minus"></i>
                        </a>
                         <a data-toggle="modal" data-target="" data-id="<?=$payhisql_dtls->id ?>" class="pay_mdl_btn paybox edit_class" value="" disabled disabled="true">
                          <i class="fa fa-eye" aria-hidden="true">
                          </i>
                        </a> 
                      <?php } ?>

                  <?  } ?>

              </td>

            </tr>

            <?php }} ?>
            <input type="hidden" value="<?=$popup_me?>" class="popup_me">

            <tr class="tr_clone">

 

            <td><span class="w20 dblock"></span></td>
            <td><input type="text" id="lsttxtpdate" name="lsttxtpdate" placeholder="mm/dd/yyyy" class="form-control lsttxtpdate" value=""/></td>
            <td><?php $cph_id = $this->db->order_by('id',"desc")->limit(1)->get('customer_payment_history')->row();

            //print_r($cph_id);

             ?>
                <input type="text" class="form-control lsttxtreceipt" value="<?=$cph_id->id+1?>"  name="lsttxtreceipt"  id="lsttxtreceipt"  style="width:75px;" /></td>
            <td><input type="text" list="listpaytypes" class="form-control lstpaytype" name="lstpaytype" id="lstpaytype" onchange="show(this.value)">

                  <datalist id="listpaytypes">
                   <option data-value="Cash"  value="Cash">Cash</option>
                    <option data-value="Check" value="Check">Check</option>
                     <option data-value="Electronic" value="Electronic">Electronic</option>
                      <option data-value="Mastercard" value="Mastercard">Mastercard</option>
                       <option data-value="Money Order" value="Money Order"> Money Order</option>
                        <option data-value="Visa" value="Visa">Visa</option>
                        <option data-value="Credit" value="Credit">Credit</option>
                   </datalist>
                <!--   </select> -->
            </td>

            <td><div id="div1"> </div></td>

            <td>
                <input class="form-control lstpdesc" name="lstpdesc" id="lstpdesc" tabindex="-1" type="text" placeholder="">
            </td>

            <td>
                <div class="form-group dflex">
                    <div class="input-group w80">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-usd"></span>
                        </span>
                        <input class="form-control lstpamt" type="number" min="1" placeholder="0.00" id="amt1" style="padding: 0 1px;">
                    </div><!-- <a data-toggle="modal" data-target="#myModal" class="pay_mdl_btn lstpaybox" value=""><i class="fa fa-money" aria-hidden="true"></i></a> -->
                </div>
            </td>

            <td>
                <div class="form-group">
                  <div class="input-group w80">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-usd"></span>
                    </span>
                    <input class="form-control  lstcreditamt" type="text" value="" disabled placeholder="0.00" id="lstcreditamt" name="lstcreditamt"></div></div>
            </td>

            <td>
                <input type="text" name="lsttxtusdername" id="lsttxtusdername" class="lsttxtusdername  form-control" disabled>
            </td>

            <td>
                <input class="form-control lsttxtnotes" type="text" placeholder="" id="lsttxtnotes" name="lsttxtnotes">
            </td>
            <td></td>
            <td></td>
        </tr>
        <?php
    }



    function allSearchCustInfo($cName) {
      
      error_reporting(0);
      $id = $cName;
      
      if ($id !="") {
        
        $cntinfosql = $this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$id."' AND default_contact=1 AND conatct_type!='Email'");
        $cntinfosql_row = $cntinfosql->row();

        $this->db->select('*');
        $this->db->from('invoices_create');
        $this->db->where('cust_id', $id);
        $this->db->where('cust_id !=', 0);
        $this->db->order_by('invoice_id DESC');
        $this->db->limit(1);
        $singleinvinfo = $this->db->get()->result_array()[0];

        $custregsql=$this->db->query("SELECT * FROM register_customer WHERE cus_id='".$id."' AND cus_id!=0 AND cus_id!='0'");
        $custregsqlrow=$custregsql->row();

        $balance_count= $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id',$id)->where('cust_id !=',0)->get('invoices_create')->result_array()[0];

        $this->session->set_userdata('bal_amt',$balance_count['total']);

        $credit_count=$this->db->query("SELECT credit FROM customer_payment_history WHERE cust_id='".$id."' ORDER BY id ASC")->result_array()[0];
        
        if (is_null($credit_count['credit'])) {

            $credit_count=0;
        }
        if ($credit_count['credit'] !=0) {
            $balance_count['total']="-".$credit_count['credit'];
        }
      } ?>

      <div class="col-md-2 contact_no">
        <div class="form-group" id="contact_info">
          <input class="form-control fcap contact_no" onchange="fncustomersearchbyphone(this.value)" type="text" id="topphone" name="topphone" value="<?=$cntinfosql_row->contact_no?>" placeholder="Contact" >
        </div>
      </div>
      
      <div class="col-md-2 cus_acc_no">
        <div class="form-group" id="lastinvId">
          <input class="form-control"  type="text" placeholder="Acc no" value="<?=$custregsqlrow->cus_acc_no?>">
        </div>
      </div>

      <div class="col-md-2 balance_count">
        <div class="form-group" id="lastinvduebal">
          <input class="form-control"  type="text" placeholder="Balance" value=" <?php
                                         if ($balance_count['total'] !="") {
                                         echo "$ ".sprintf('%0.2f',$balance_count['total']);
                                         }
                                         else {
                                             echo "";
                                         }
                                         ?>">
        </div>
      </div>

    <?php }   





   function getCustomerInfo_dtls()
   {

   	  $cName = $this->input->post('name');
			$query_check="SELECT  `cust_id`,`invoice_id`,`invoice_name`, `invoice_date`, `invoice_due_date`, `invoice_type`, `invoice_contract_type`, `invoice_discount`, `invoice_sub_total`, `invoice_tax`, `invoice_amount`, `invoice_paid`, `invoice_balance_due`, `invoice_tax_rate` FROM invoices_create WHERE `cust_id` = '$cName' AND invoice_status=0 AND invoice_balance_due !=''";
			// echo $query_check;die;
      $cust_inv = $this->db->query($query_check);

			$cust_det = $this->db->query("SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = '$cName'")->result_array()[0];
  		//$get_inv_data = $cust_inv->result_array();
      foreach($cust_inv->result() as $cus_invoices)
      {

          ?><tr class="tr_clone">

                      <td class="invce-id"><?=$cus_invoices->invoice_id?></td>

                      <td><a class="btn btn-xs btn-primary apply_btn"> Apply</a></td><!-- onclick="fnupdateinvosts('<?=$cus_invoices->invoice_id?>')" -->

                      <td>
                        <input type="number" min="1" max="<?=$cus_invoices->invoice_balance_due?>" name="invapplyamt" id="invapplyamt<?=$cus_invoices->invoice_id?>" class="invapplyamt form-control">
                       </td>

                      <td>
                        <div class="form-group"><div class="input-group">
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-usd"></span></span>
													<input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$cus_invoices->invoice_amount)?>" disabled></div></div>
                      </td>


                      <td>
												<?php



												 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE inv_id='".$cus_invoices->invoice_id."' AND cus_id='".$cus_invoices->cust_id."'  ORDER BY event_id ASC ");


													foreach ($evntypsql->result() as $evntypsql_dtls)
													{

															if($evntypsql_dtls->event_id==$cus_invoices->invoice_type)
															 {

																	$selectedevtyp="selected";
															 }else{

																	 $selectedevtyp="";
															 }

															 // $cust_det['event_name']

												?>
												<?php
												if ($evntypsql_dtls->event_date !="") {
													$con_date=date("m/d/Y",strtotime($evntypsql_dtls->event_date));
												}
												else {
													$con_date="";
												}

												$eventname=$evntypsql_dtls->event_name;
												$eventname=str_replace('-',' - ',$eventname);
												 ?>
												<input type="text" class="form-control" name="" value="<?=$eventname." - ".$con_date." - ".$evntypsql_dtls->event_type?>" class="form-control" disabled>


                              <?php }?>



                      </td>
                      <td>
												<?php
												// $or_date=$evntypsql_dtls->invoice_due_date;
												// if ($or_date =="") {
												// $or_date="";
												// }
												if ($cus_invoices->invoice_due_date !="") {
													$strto=strtotime($cus_invoices->invoice_due_date);
												$con_date =date("m/d/Y",strtotime($cus_invoices->invoice_due_date));
												}
												else {
													$con_date="";
												}
												// echo $strto; echo "<br>";
												// echo $con_date;
												?>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$con_date?>" readonly>
                      </td>

                      <td>
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon" >
															<span class="glyphicon glyphicon-usd"></span>
														</span>
														<input type="text" name="invoice_payment" id="invoice_paid_amt" class="form-control t-right invoice_paid_amt" value="<?=sprintf('%0.2f',$cus_invoices->invoice_paid)?>" disabled>
													</div>
												</div>
											</td>
                      <td>
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon" >
															<span class="glyphicon glyphicon-usd"></span>
														</span>
															<input type="text" name="invoice_payment" class="form-control t-right balance_amt" value="<?=sprintf('%0.2f',$cus_invoices->invoice_balance_due)?>" disabled>
														</div>
													</div>
												</td>
                    </tr>
              <?php

      }
   }


  function fnappyinvoice_dtls()
  {

    error_reporting(0);


  	 $pinvoiceId=$_POST['invId'];
  	 $invsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$pinvoiceId."'");
  	 $getinvrow=$invsql->row();

  	 $clinvcust_id=$getinvrow->cust_id;
     $clinvoice_paid=$getinvrow->invoice_paid;
     $clinvamt=$getinvrow->invoice_amount;
     $clinvdueamt=$getinvrow->invoice_balance_due;


     if($_POST['custpayamt']>$clinvdueamt)
     {
       // echo "1st if--"."<br>";die;

          if($_POST['custpayamt']>$clinvamt)
             {
                $totinvpaid=$clinvamt;
                $totclinvbaldue="0";
                $custremnamt=$_POST['custpayamt']-$clinvamt;
                $custcramt=$_POST['custpayamt']-$clinvamt;

             }elseif($_POST['custpayamt']<$clinvamt)
             {

                $totinvpaid=$clinvoice_paid+$clinvdueamt;
                $totclinvbaldue=$clinvamt-$totinvpaid;
                $custremnamt=$_POST['custpayamt']-$clinvdueamt;
                $custcramt=$_POST['custpayamt']-$clinvdueamt;
                //$custremnamt="0";
             }
      }else{

         // echo "1st else--";die;

               $totinvpaid=$clinvoice_paid+$_POST['custpayamt'];
                if($totinvpaid>$clinvamt)
                {
                  $totclinvbaldue=$totinvpaid-$clinvamt;
                  $custremnamt=$totinvpaid-$clinvamt;
                  $custcramt="0";
                }elseif($totinvpaid<$clinvamt) {
                  $totclinvbaldue=$clinvamt-$totinvpaid;
                   $custremnamt=$clinvamt-$totinvpaid;
                   $custcramt="0";
                }

         }


  	 $updtinvpaystsarr=array(

  	 	"invoice_status" => "0",
  	 	"invoice_paid" =>$totinvpaid,
  	 	"invoice_balance_due" =>$totclinvbaldue
  	 );
  	 $this->db->where('invoice_id',$pinvoiceId);
  	 if($this->db->update('invoices_create',$updtinvpaystsarr))
  	 {

      $upcreditsql=$this->db->query("SELECT * FROM customer_credit_amount WHERE cust_id='".$clinvcust_id."'");
      $crdtnrows=$upcreditsql->num_rows();
     // echo "crdtnrows--".$crdtnrows."<br>"; die;
      if($crdtnrows==0)
        {

              $updtcustcreditamount=array(

              "cust_id" => $clinvcust_id,
              "credit_amount" => $custcramt, //$custremnamt,

             );
           $this->db->insert('customer_credit_amount',$updtcustcreditamount);
       }else{

           $updtcustcreditamount=array(
            "credit_amount" => $custcramt, //$custremnamt,
            "updated_date" => date('Y-m-d H:i:s')
           );
           $this->db->where('cust_id',$clinvcust_id);
           $this->db->update('customer_credit_amount',$updtcustcreditamount);
       }


        //Start Insert in backup in copy table

        $getinvsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invId']."'");
        $getinvsqlrow= $getinvsql->row();

				$eventstatusupdate=array(
 				"event_booked" => 1, //$custremnamt,

 			 );
 			 $this->db->where('event_id',$getinvsqlrow->invoice_type);
 			 $this->db->update('events_register',$eventstatusupdate);

        $insrtpaymntarr=array(

          "payment_id" => $_POST['hpaymentId'],
          "invoice_id" => $_POST['invId'],
          "cust_id" => $_POST['cus_Id'],
          "invoice_name" => $getinvsqlrow->invoice_name,
          "invoice_date" => $getinvsqlrow->invoice_date,
          "invoice_due_date" => $getinvsqlrow->invoice_due_date,
          "invoice_type" => $getinvsqlrow->invoice_type,
          "invoice_contract_type" => $getinvsqlrow->invoice_contract_type,
          "invoice_discount" => $getinvsqlrow->invoice_discount,
          "invoice_sub_total" => $getinvsqlrow->invoice_sub_total,
          "invoice_tax" => $getinvsqlrow->invoice_tax,
          "invoice_amount" => $getinvsqlrow->invoice_amount,
          "invoice_paid" => $getinvsqlrow->invoice_paid,
          "invoice_balance_due" => $getinvsqlrow->invoice_balance_due,
          "invoice_tax_rate" => $getinvsqlrow->invoice_tax_rate,
          "invoice_county" => $getinvsqlrow->invoice_county,
          "invoice_user" => $getinvsqlrow->invoice_user,
          "invoice_status" => $getinvsqlrow->invoice_status,
          "assigned_pckage" => $getinvsqlrow->assigned_pckage,
          "created_date" => $getinvsqlrow->created_date,
          "due_bal_status" => $getinvsqlrow->due_bal_status,
          "discounted_amt" => $getinvsqlrow->discounted_amt,
          "applied_amt" => $_POST['custpayamt']
        );
       if($this->db->insert('invoices_payment_create',$insrtpaymntarr))
       {
           //  $upinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$clinvcust_id."' AND invoice_status=2");

      //  echo "SELECT * FROM invoices_payment_create WHERE payment_id='".$_POST['hpaymentId']."' ORDER BY id ASC";
			$cust_det = $this->db->query("SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = ".$_POST['cus_Id']."")->result_array()[0];

      $upinvsql=$this->db->query("SELECT * FROM invoices_payment_create WHERE payment_id='".$_POST['hpaymentId']."' AND status=0 ORDER BY id ASC");


      foreach($upinvsql->result() as $invsql_dtls)
         {

            ?><tr class="tr_clone">

                      <td class="app_inv_id">
												<span><?=$invsql_dtls->invoice_id?></span>
												<input type="hidden" class="inv_allid" value="<?=$invsql_dtls->id?>">
											</td>

                      <td><a onclick="fnremovependinv('<?=$invsql_dtls->id?>','<?=$invsql_dtls->applied_amt?>','<?=$invsql_dtls->invoice_id?>','<?= $_POST['hpaymentId'] ?>')" class="btn btn-xs btn-danger apply_remove_btn"> Remove</a></td>

                      <td class="app_inv_amt"><?=sprintf('%0.2f',$invsql_dtls->applied_amt);?> </td>

                      <td>
												<?php

													//$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");

												 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE inv_id='".$invsql_dtls->invoice_id."'AND cus_id='".$invsql_dtls->cust_id."'  GROUP BY event_type ORDER BY event_id ASC ");


													foreach ($evntypsql->result() as $evntypsql_dtls)
													{
															 if($evntypsql_dtls->event_id==$invsql_dtls->invoice_type)
															 {

																	$selectedevtyp="selected";
															 }else{

																	 $selectedevtyp="";
															 }

												?>
												<?php

												if ($evntypsql_dtls->event_date !="") {
												$con_date=date("m/d/Y",strtotime($evntypsql_dtls->event_date));
											}
											else {
												$con_date="";
											}

											$eventname=$evntypsql_dtls->event_name;
											$eventname=str_replace('-',' - ',$eventname);
												 ?>
												<input type="text" name="" class="form-control" value="<?=$eventname." - ".$con_date." - ".$evntypsql_dtls->event_type?>" disabled>
                      <!-- <select class="form-control" disabled>
                             <option value="0">Select</option>

                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->event_type?>"><?=$cust_det['cus_fname']." - ".date("m-d-Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?></option>

                              <?php }?>
                          </select> -->

                      </td>
                      <td>
												<?php
												if ($invsql_dtls->invoice_due_date !="") {
													$con_date=date("m/d/Y",strtotime($invsql_dtls->invoice_due_date));
												}
												else {
													$con_date="";
												}
												 ?>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$con_date?>">
                      </td>
                      <td>
                        <div class="form-group"><div class="input-group"><span class="input-group-addon" >
                        <span class="glyphicon glyphicon-usd"></span></span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_amount)?>">
                        </div></div>
                      </td>
                       <td>
												 <div class="form-group">
													 <div class="input-group">
														 <span class="input-group-addon" >
                                                         <span class="glyphicon glyphicon-usd"></span>
                                                         </span><input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>"></div></div></td>
                      <td>
												<div class="form-group"><div class="input-group"><span class="input-group-addon" >
												<span class="glyphicon glyphicon-usd"></span>
											</span>
											<input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>">

											<input type="hidden" name="appmnet" id="appmnet" class="form-control" value="<?=$totinvpaid?>">
											<input type="hidden" name="baldue" id="baldue" class="form-control" value="<?=$totclinvbaldue?>">
											<input type="hidden" name="balramins" id="balramins" class="form-control" value="<?=$custremnamt?>">
										</div>
									</div>
								</td>
											<!-- <td>
												<input type="hidden" name="appmnet" id="appmnet" class="form-control" value="<?=$totinvpaid?>">
												<input type="hidden" name="baldue" id="baldue" class="form-control" value="<?=$totclinvbaldue?>"><input type="hidden" name="balramins" id="balramins" class="form-control" value="<?=$custremnamt?>">
											</td> -->
                    </tr>
              <?php

          }
       }

        //End Insert in backup in copy table-  invoices_payment_create

    }
}


 function fnremoveinvoice_dtls()
  {
  	 $pinvId=$_POST['invId'];
  	 $main_invId=$_POST['main_invId'];
  	 $invsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$main_invId."'");
  	 $getinvrow=$invsql->row();


     $clinvcust_id=$getinvrow->cust_id;

  	/* $clinvoice_paid=$getinvrow->invoice_paid;
  	 //$totinvpaid=$clinvoice_paid-$_POST['custpayamt'];

  	 $clinvamt=$getinvrow->invoice_amount;
  	// $totclinvbaldue=$clinvamt-$totinvpaid;

     $clinvdueamount=$getinvrow->invoice_balance_due;


   if($clinvoice_paid==$clinvamt)
     {
        //$totinvpaid=$clinvamt-$clinvoice_paid;
        //$totclinvbaldue="0";

        $totinvpaid="0";
        $totclinvbaldue=$clinvoice_paid+$clinvdueamount;

     }else
     {
        //$totinvpaid=$clinvoice_paid+$_POST['custpayamt'];
        //$totclinvbaldue=$clinvamt-$totinvpaid;
        $totinvpaid="0";
        $totclinvbaldue=$clinvoice_paid+$clinvdueamount;

     }*/

      $totinvpaid= $getinvrow->invoice_paid - $_POST['appliedamt'];
      $totclinvbaldue= $getinvrow->invoice_balance_due + $_POST['appliedamt'];

	  	$updtinvpayarr=array(

	  	 	"invoice_status" => "0",
	  	 	"invoice_paid" =>$totinvpaid,
	  	 	"invoice_balance_due" =>$totclinvbaldue
	  	 );
	  	 $this->db->where('invoice_id',$main_invId);
	  	 if($this->db->update('invoices_create',$updtinvpayarr))
	  	 {
	  	 	  //echo "success";
					$this->db->where('id',$pinvId);
					$this->db->delete('invoices_payment_create');



          $upcreditsql=$this->db->query("SELECT * FROM customer_credit_amount WHERE cust_id='".$clinvcust_id."'");
          $crdtrow=$upcreditsql->row();
          $crdtnrows=$upcreditsql->num_rows();
          if($crdtnrows>0)
            {


              //$custremnamt=$crdtrow->credit_amount-$totinvpaid;

               $updtcustcreditamount=array(
                  "credit_amount" =>"",
                  "updated_date" => date('Y-m-d H:i:s')
                 );
                 $this->db->where('cust_id',$clinvcust_id);
                 $this->db->update('customer_credit_amount',$updtcustcreditamount);

            }

           echo "success";

	  	 }
  }
 


 function fnappliedinvoice_dtls()
  {

  	 $pinvoiceId=$_POST['invId'];
  	 $invpayment_id=$_POST['invpayment_id'];

  	 $invsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$pinvoiceId."'");
  	 $getinvrow=$invsql->row();

  	 $clinvcust_id=$getinvrow->cust_id;

  	// comment start
  /*	 $upinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$clinvcust_id."' AND invoice_status=2");
  	 	foreach($upinvsql->result() as $invsql_dtls)
         {

            ?><tr class="tr_clone">

                      <td><?=$invsql_dtls->invoice_id?></td>

                      <td><a onclick="fnremovependinv('<?=$invsql_dtls->id?>','<?=$invsql_dtls->invoice_id?>')" class="btn btn-xs btn-danger apply_remove_btn"> Remove</a></td>

                      <td> </td>

                      <td><select class="form-control" disabled>
                           <option value="0">Select</option>
                                <?php
                                 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE cus_id='".$invsql_dtls->cust_id."'  GROUP BY event_type ORDER BY event_id ASC ");


                                  foreach ($evntypsql->result() as $evntypsql_dtls)
                                  {

                                      if($evntypsql_dtls->event_id==$invsql_dtls->invoice_type)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }

                                ?>
                                <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->event_type?>"><?=$evntypsql_dtls->event_type?></option>

                              <?php }?>
                          </select>

                      </td>
                      <td><input type="text" name="invoice_payment" class="form-control" value="<?=$invsql_dtls->invoice_due_date?>"></td>
                      <td>
												<div class="form-group">
													<div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;"><span class="glyphicon glyphicon-usd"></span></span><input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_amount)?>"></div></div></td>
                      <td>
												<div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;"><span class="glyphicon glyphicon-usd"></span></span>
													<input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_paid)?>"></div></div>
												</td>
                      <td>
												<div class="form-group"><div class="input-group"><span class="input-group-addon" style="position: absolute;right: 40px;left: inherit;margin: 0px;"><span class="glyphicon glyphicon-usd"></span></span>
													<input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>"></div></div></td>
                    </tr>
              <?php

          } */
					// comment end
					$query1="SELECT * FROM invoices_payment_create WHERE payment_id='".$invpayment_id."' AND status=0 ORDER BY id ASC";
					// echo $query1;
					$upinvsql=$this->db->query($query1);

      foreach($upinvsql->result() as $invsql_dtls)
         {

            ?><tr class="tr_clone">

                      <td><?=$invsql_dtls->invoice_id?>
                        <input type="hidden" class="inv_allid" value="<?=$invsql_dtls->id?>">
                        <input type="hidden" id="invpayment_id" class="invpayment_id" value="<?=$_POST['hpaymentId']?>">

                      </td>

                      <td><a onclick="fnremovependinv('<?=$invsql_dtls->id?>','<?=$invsql_dtls->applied_amt?>','<?=$invsql_dtls->invoice_id?>','<?=$invpayment_id?>')" class="btn btn-xs btn-danger apply_remove_btn"> Remove</a></td>

                      <td><?=$invsql_dtls->applied_amt?> </td>

                      <td>
												<?php

													//$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");

												 // $evntypsql=$this->db->query("SELECT * FROM events_register WHERE cus_id='".$invsql_dtls->cust_id."'  GROUP BY event_type ORDER BY event_id ASC ");

												 $evntypsql=$this->db->query("SELECT * FROM events_register WHERE inv_id='".$invsql_dtls->invoice_id."' AND cus_id='".$invsql_dtls->cust_id."'  ORDER BY event_id ASC ");

												 $cust_det = $this->db->query("SELECT  cus_fname,cus_lname,cus_company_name FROM register_customer WHERE `cus_id` = ".$invsql_dtls->cust_id."")->result_array()[0];

													foreach ($evntypsql->result() as $evntypsql_dtls)
													{
															 if($evntypsql_dtls->event_id==$invsql_dtls->invoice_type)
															 {

																	$selectedevtyp="selected";
															 }else{

																	 $selectedevtyp="";
															 }

															 $eventname=$evntypsql_dtls->event_name;
                      				$eventname=str_replace('-',' - ',$eventname);

												?>
												<input type="text" name="" value="<?=$eventname." - ".date("m/d/Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?>" class="form-control" disabled>
												<!-- <option <?=$selectedevtyp?> value="<?=$evntypsql_dtls->event_type?>"><?=$cust_det['cus_fname']." - ".date("m-d-Y",strtotime($evntypsql_dtls->event_date))." - ".$evntypsql_dtls->event_type?></option> -->

											<?php }?>
                      <!-- <select class="form-control" disabled>
                             <option value="0">Select</option>

                          </select> -->

                      </td>
                      <td>
												<?php
												if ($invsql_dtls->invoice_due_date !="") {
													$con_date=date("m/d/Y",strtotime($invsql_dtls->invoice_due_date));
												}
												else {
													$con_date="";
												}
												 ?>
                        <input type="text" name="invoice_payment" class="form-control" value="<?=$con_date?>">
                      </td>
                      <td>
                        <div class="form-group"><div class="input-group"><span class="input-group-addon" ><span class="glyphicon glyphicon-usd"></span></span>
                          <input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_amount)?>">
                        </div></div>
                      </td>
                       <td><div class="form-group"><div class="input-group"><span class="input-group-addon" ><span class="glyphicon glyphicon-usd"></span></span><input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.02f',$invsql_dtls->invoice_paid)?>"></div></div></td>
                      <td>
												<div class="form-group">
													<div class="input-group">
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-usd"></span>
											</span>
											<input type="text" name="invoice_payment" class="form-control t-right" value="<?=sprintf('%0.2f',$invsql_dtls->invoice_balance_due)?>">

											<input type="hidden" name="appmnet" id="appmnet" class="form-control" value="<?=$totinvpaid?>">
											<input type="hidden" name="baldue" id="baldue" class="form-control" value="<?=$totclinvbaldue?>">
											<input type="hidden" name="balramins" id="balramins" class="form-control" value="<?=$custremnamt?>">
										</div>
									</div>
								</td>
								<!-- <td>
									<input type="hidden" name="appmnet" id="appmnet" class="form-control" value="<?=$totinvpaid?>">
									<input type="hidden" name="baldue" id="baldue" class="form-control" value="<?=$totclinvbaldue?>">
									<input type="hidden" name="balramins" id="balramins" class="form-control" value="<?=$custremnamt?>">
								</td> -->
                    </tr>
              <?php

          }
  }



 function fnremoveallinvoces_dtls()
  {

  	 $pinvoiceId=$_POST['invId'];
  	 $invsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$pinvoiceId."'");
  	 $getinvrow=$invsql->row();

     $clinvcust_id=$getinvrow->cust_id;

  	 $upinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$clinvcust_id."' AND invoice_status=2");
  	 	foreach($upinvsql->result() as $invsql_dtls)
         {
		  	 //clinvcust_id=$getinvrow->cust_id;

         	 $clinvoice_id=$invsql_dtls->invoice_id;

		  	 $clinvoice_paid=$invsql_dtls->invoice_paid;
		  	 $totinvpaid=$clinvoice_paid-$_POST['custpayamt'];

		  	 $clinvamt=$invsql_dtls->invoice_amount;
		  	 $totclinvbaldue=$clinvamt-$totinvpaid;

			  	$updtinvpayarr=array(

			  	 	"invoice_status" => "0",
			  	 	"invoice_paid" =>$totinvpaid,
			  	 	"invoice_balance_due" =>$totclinvbaldue
			  	 );

			  	 $this->db->where('invoice_id',$clinvoice_id);
			  	 $this->db->where('invoice_status',"2");
			  	 $this->db->update('invoices_create',$updtinvpayarr);

		}

	   echo "success";

  }

 function fncloseallinvoces_dtls()
  {

  	 $pinvoiceId=$_POST['invId'];
  	 $invsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$pinvoiceId."'");
  	 $getinvrow=$invsql->row();

  	 $clinvcust_id=$getinvrow->cust_id;


  	 $upinvsql=$this->db->query("SELECT * FROM invoices_create WHERE cust_id='".$clinvcust_id."' AND invoice_status=2");
  	 	foreach($upinvsql->result() as $invsql_dtls)
         {

         	$clinvoice_id=$invsql_dtls->invoice_id;

         	$clinvoice_paid=$invsql_dtls->invoice_paid;
         	$clinvamt=$invsql_dtls->invoice_amount;

         	if($clinvoice_paid==$clinvamt)
         	{

         		$updtinvpayarr=array(

				  	 	"invoice_status" => "1",
				  	 );

			  	 $this->db->where('invoice_id',$clinvoice_id);
			  	 $this->db->where('invoice_status',"2");
			  	 $this->db->update('invoices_create',$updtinvpayarr);

         	}else{

         			$updtinvpayarr=array(

				  	 	"invoice_status" => "0",
				  	 );

			  	 $this->db->where('invoice_id',$clinvoice_id);
			  	 $this->db->where('invoice_status',"2");
			  	 $this->db->update('invoices_create',$updtinvpayarr);
         	}


	  	}

	   echo "success";
  }







 function fndeletepaymnt_dtls()
 {
	 $paymentid=$this->input->post('payId');
	 $upinvsql=$this->db->query("SELECT * FROM invoices_payment_create WHERE payment_id='".$paymentid."'")->result_array();
	 foreach ($upinvsql as $payment_data) {
	 	$invoicesql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$payment_data['invoice_id']."'")->result_array();

		$amount_applied=$payment_data['applied_amt'];
		// print_r($amount_applied);die;
		$paid_amount=$invoicesql[0]['invoice_paid'];
		$balance_amount=$invoicesql[0]['invoice_balance_due'];
		// print_r("app_amt :".$amount_applied." "."paid_amt :".$paid_amount." "."bal_amt  :".$balance_amount);die;

		$paid_amt=$paid_amount-$amount_applied;
		$bal_amt=$balance_amount+$amount_applied;

		// print_r("app_amt :".$amount_applied." "."paid_amt :".$paid_amt." "."bal_amt  :".$bal_amt);die;
		$query="UPDATE invoices_create SET invoice_paid='$paid_amt',invoice_balance_due='$bal_amt' WHERE invoice_id=".$payment_data['invoice_id']."";
		// print_r($query);die;
		$this->db->query($query);

		$query_delete="DELETE FROM `invoices_payment_create` WHERE payment_id=".$paymentid." AND invoice_id=".$payment_data['invoice_id']."";
		$this->db->query($query_delete);
	 }

     $this->db->where('id',$this->input->post('payId'));
     if($this->db->delete('customer_payment_history'))
     {
        echo "success";
     }else{
        echo "error";
     }
 }



 function fineshpayment()
	{

		$id=$_POST['id'];
		$finesh_id=$_POST['hpaymentId'];
		$custpayamt=$_POST['custpayamt'];
		$applied_amt=$_POST['applied_amt'];
		$creadit_amt=$_POST['creadit_amt'];
		$payment_type=$_POST['payment_type'];
		$payment_no=$_POST['paymentno'];

		$cus_id=$_POST['cusid'];

		$query_update="UPDATE customer_payment_history SET credit=0 WHERE cust_id ='".$cus_id."'";
		$this->db->query($query_update);
		// $con=;
		// echo $id;

		$updtinvpayarr=array(
			"status" => 1,
		);
		$query="UPDATE invoices_payment_create SET payment_type='$payment_type',payment_no='$payment_no',status= 1 WHERE id IN ($id)";
		// echo $query;
			// $this->db->where_in('id',$id);
			if($this->db->query($query))
			{
				$query1="UPDATE customer_payment_history SET amount= $applied_amt,credit=$creadit_amt,status=1 WHERE id IN ($finesh_id)";
				if($this->db->query($query1))
				{
					 echo "success";
				 }
				 else {
				 	echo "error";
				 }

			}else {
				echo "error";
			}
	}
 function removepayment()
	{

		$id=$_POST['id'];

		// $con=;
		// echo $id;
		$inv_id=explode(",",$id);
		// print_r($inv_id);die;

		foreach ($inv_id as $val=>$key) {


			$query="SELECT invoice_id,applied_amt FROM invoices_payment_create WHERE id=$key";
			$ruery_result=$this->db->query($query)->result_array();
			$query = reset($ruery_result);
			$applied_amt= $query['applied_amt'];
			// $str=$str.$applied_amt;
			// print_r($ruery_result);die;
			//
			$inv_details = $this->db->query("SELECT invoice_paid,invoice_balance_due FROM invoices_create WHERE invoice_id='".$query['invoice_id']."'")->result_array();
			$inv_details = $inv_details[0];
			//
			$invoice_paid=$inv_details['invoice_paid'];
			$invoice_balance_due=$inv_details['invoice_balance_due'];

			$invoice_paid=$invoice_paid-$applied_amt;
			$invoice_balance_due=$invoice_balance_due+$applied_amt;

			$query_update="UPDATE invoices_create SET invoice_paid=$invoice_paid,invoice_balance_due=$invoice_balance_due WHERE invoice_id='".$query['invoice_id']."'";
			$this->db->query($query_update);

			$query_delete="DELETE FROM invoices_payment_create WHERE id=$key";
			$this->db->query($query_delete);

		}
		echo"success";

		// $query="DELETE invoices_payment_create WHERE id IN ($id)";
		// 	if($this->db->query($query))
		// 	{
		// 			 echo "success";
		//
		// 	}else {
		// 		echo "error";
		// 	}
		// echo "success";
	}
 function removepaymentSec()
	{

		$id=$_POST['id'];

		// $con=;
		// echo $id;
		$inv_id=explode(",",$id);
		// print_r($inv_id);die;

		foreach ($inv_id as $val=>$key) {


			$query="SELECT invoice_id,payment_id,applied_amt FROM invoices_payment_create WHERE id=$key";
			$ruery_result=$this->db->query($query)->result_array();
			$query = reset($ruery_result);
			$applied_amt= $query['applied_amt'];
			// $str=$str.$applied_amt;
			// print_r($ruery_result);die;


  		$pay_historysql=$this->db->query("SELECT * FROM customer_payment_history WHERE id='".$query['payment_id']."'");
     	$gethistoryrow=$pay_historysql->row();
			// print_r($gethistoryrow);die;
			if ($gethistoryrow->credit !=0) {
      $creadit_amt=$gethistoryrow->credit+$applied_amt;
      $amount_amt=$gethistoryrow->amount-$applied_amt;
     }
     else {
      $creadit_amt=$gethistoryrow->credit+$applied_amt;
      $amount_amt=$gethistoryrow->amount-$applied_amt;
     }
		 $query_updatehistory="UPDATE customer_payment_history SET amount=$amount_amt,credit=$creadit_amt WHERE id=".$query['payment_id']."";
		 $this->db->query($query_updatehistory);

			$inv_details = $this->db->query("SELECT invoice_paid,invoice_balance_due FROM invoices_create WHERE invoice_id='".$query['invoice_id']."'")->result_array();
			$inv_details = $inv_details[0];
			//
			$invoice_paid=$inv_details['invoice_paid'];
			$invoice_balance_due=$inv_details['invoice_balance_due'];

			$invoice_paid=$invoice_paid-$applied_amt;
			$invoice_balance_due=$invoice_balance_due+$applied_amt;

			$query_update="UPDATE invoices_create SET invoice_paid=$invoice_paid,invoice_balance_due=$invoice_balance_due WHERE invoice_id='".$query['invoice_id']."'";
			$this->db->query($query_update);

			$query_delete="DELETE FROM invoices_payment_create WHERE id=$key";
			$this->db->query($query_delete);

		}
		echo"success";

	}


}
