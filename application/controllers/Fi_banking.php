<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Fi_banking extends CI_Controller 
    {

    	public function __construct(){
    		parent::__construct();
        	$this->load->model('BankingModel');
    	}

        //Prasanna 11 deposit
        //Update March 11, 2021
        public function reconcile() 
        {

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/banking/reconcile');
            $this->load->view('fi/footer');
        }

        public function selectreceivables_ajax_total() 
        {
            $id_deposit     = $this->input->post('id_deposit');
            $deposite       = $this->input->post('deposite');
            $deposite_in    = $this->input->post('deposited_in');
            $receipt_to     = $this->input->post('receipt_to');
            $receipt_from   = $this->input->post('receipt_from');
            $date_from      = $this->input->post('date_from');
            $date_to        = $this->input->post('date_to');
            $amount         = $this->input->post('amount');
            $deposite_num   = $this->input->post('deposite_num');
            $check          = $this->input->post('check');
            $data           = $this->BankingModel->selectreceivables_ajax_total($id_deposit, $deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to);
            $i              = 1;
            foreach($data as $row) 
            { ?>
                <tr class="tr_clone">
                    <td>    <span> <?=$i++?>   </span> </td>
                    <td>    <span>  <?=$row["type_"]?></span> </td>
                    <td>    <span class="text-right blockk">  $<?=$row["amount_"]?></span> </td>
                    <td>    <span>  <?=$row["count_"]?></span> </td>
                    <td class="select_total">    <span>  <input type="checkbox" onClick="toggle(this)" /></span></td>
                </tr>
                <?php
            }
        }

        public function selectreceivables($id) 
        {

            

            $data['id_deposit'] = $id;
            $data['alert']      = $this->session->flashdata('alert');
            $data['error']      = $this->session->flashdata('error');
            $data['success']    = $this->session->flashdata('success');

            if($id > 0){
                $data['title'] = "VIEW PAYMENTS";

            }else{
                $data['title'] = "SELECT RECEIVABLES";
            }



            $this->session->unset_userdata('event_page', '');

            $this->load->view('fi/header', $data);
            $this->load->view('fi/sidebar');
            $this->load->view('fi/banking/select-receivables', $data);
            $this->load->view('fi/footer');
        }

        public function open_uncategorised_update() {

            $id   = $this->input->post('id');
            $category           = $this->input->post('category');
            $sub_category       = $this->input->post('sub_category');
            $un_amount          = $this->input->post('un_amount');
            $result             = $this->BankingModel->open_uncategorised_update($id, $category, $sub_category, $un_amount);
            return 1;
        }


        public function open_uncategorised() {


             $amount_total       = $this->input->post('amount_total');
            $id                 = $this->input->post('id');
            $open_uncategorised = $this->BankingModel->open_uncategorised($id);
             $total              = 0.00;

            foreach($open_uncategorised as $row) {
                $total+=$row['amount'];

             ?>

                            <tr class="">
                                <td> # </td>

                                <td>
                                  <select class="form-control fcap" name="category_<?=$row['id']?>" tabindex="-1"  onfocusout="open_uncategorised_update(<?=$row['id']?>)">
                                    <option value="<?=$row['categorised']?>"> <?=$row['categorised']?> </option>
                                    <option value="Test1">Test1 </option>
                                    <option value="Test2">Test2 </option>
                                  </select>
                                </td>

                                <td>
                                  <select class="form-control fcap" name="sub_category_<?=$row['id']?>" tabindex="-1"  onfocusout="open_uncategorised_update(<?=$row['id']?>)">
                                    <option value="<?=$row['subcategorised']?>"> <?=$row['subcategorised']?> </option>
                                    <option value="Test1">Test1 </option>
                                    <option value="Test2">Test2 </option>
                                  </select>
                                </td>

                                <td>
                                  <!-- <input type="text" placeholder="" value="<?=$row['amount']?>" id="" name="un_amount_<?=$row['id']?>" class="form-control"  onfocusout="open_uncategorised_update(<?=$row['id']?>)">  -->

                                  <div class="input-group" >
                                    <span class="input-group-addon" >
                                      <span class="glyphicon glyphicon-usd"> </span>
                                    </span>
                                    <input type="text" placeholder="" value="<?=$row['amount']?>" id="" name="un_amount_<?=$row['id']?>" class="form-control"  onfocusout="open_uncategorised_update(<?=$row['id']?>)">
                                </div>



                                   <input type="hidden" placeholder="" id="" name="id_enter_payable" class="form-control" value="<?=$id?>">
                                </td>
                              </tr> <?php }

                              ?>
                              <tr class="">
                                <td> # </td>

                                <td>
                                  <select class="form-control fcap" name="category1" tabindex="-1">
                                    <option value=""> Choose </option>
                                    <option value="Test1">Test1 </option>
                                    <option value="Test2">Test2 </option>
                                  </select>
                                </td>

                                <td>
                                  <select class="form-control fcap" name="sub_category1" tabindex="-1">
                                    <option value=""> Choose </option>
                                    <option value="Test1">Test1 </option>
                                    <option value="Test2">Test2 </option>
                                  </select>
                                </td>

                                <td>
                                  <input type="text" placeholder="" id="" name="un_amount1" class="form-control" onfocusout="open_uncategorised_insert()">
                                  <input type="hidden" placeholder="" id="" name="id_enter_payable" class="form-control" value="<?=$id?>">

                                </td>
                              </tr>
                              <tr>
                                <td> </td>

                                <td>

                                </td>

                                <td>

                                </td>

                                <?php if($amount_total == $total) { ?>
                                    <td style=" border: 2px solid green; text-align: right ">$ <?=number_format((float)$total, 2, '.', '');?></td>
                                <?php }else { ?>
                                     <td style=" border: 2px solid red; text-align: right ">$ <?=number_format((float)$total, 2, '.', '');?></td>
                                <?php } ?>


                              </tr>

                              <?php
        }

        public function open_uncategorised_insert(){

            $enter_payable_id   = $this->input->post('enter_payable_id');
            $category           = $this->input->post('category');
            $sub_category       = $this->input->post('sub_category');
            $un_amount          = $this->input->post('un_amount');
            $result             = $this->BankingModel->open_uncategorised_insert($enter_payable_id, $category, $sub_category, $un_amount);
            return 1;
        }

        public function enter_payable_update(){



            $id             = $this->input->post('id');
            $notes          = $this->input->post('notes');
            $username       = $this->input->post('username');
            $date_cleared   = $this->input->post('date_cleared');
            $credit         = $this->input->post('credit');
            $amount         = $this->input->post('amount');
            $sdesc          = $this->input->post('sdesc');
            $checknum       = $this->input->post('checknum');
            $type           = $this->input->post('type');
            $payments       = $this->input->post('payment');
            $vendor         = $this->input->post('vendor');
            $date_          = $this->input->post('date_');
            $receipt        = $this->input->post('receipt');
            $account        = $this->input->post('account');
            $result         = $this->BankingModel->enter_payable_update($id, $notes, $username, $date_cleared, $credit, $amount, $sdesc, $checknum, $type, $payments, $vendor, $date_, $receipt, $account);
            // print_r($id);
            //print_r($result);
            }


        public function enterpayables() {

            if(!isset($this->session->fi_session)){
                redirect('/','refresh');
            }

            $data['vendor_list'] = $this->BankingModel->vendor_list();

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/banking/enter-payables', $data);
            $this->load->view('fi/footer');
           }

        public function enter_payable_display(){

            $data_enter_payable_display = $this->BankingModel->enter_payable_display();
            $data_vendor_list = $this->BankingModel->vendor_list();
            $i = 1;
            //print_r($data_enter_payable_display);
            foreach($data_enter_payable_display as $row) { ?>

                <tr class="dynamic">
                        <td><?=$i++?></td>
                        <td><input type="text" placeholder="" id="" class="form-control" name="payment_<?=$row["id"]?>" value="<?=$row["payments"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onfocusin="open_uncategorised(<?=$row["id"]?>)"> </td>
                        <td>
                            <select class="form-control" id="cus_names" name="vendor_<?=$row["id"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)">
                                <option value="<?=$row['cus_id']?>"><?=$row['cus_fname']?> - <?=$row['cus_lname']?> - <?=$row['cus_company_name']?> </option>
                            <?php
                            foreach($data_vendor_list as $row1) {
                                ?><option value="<?=$row1['cus_id']?>"><?=$row1['cus_fname']?> - <?=$row1['cus_lname']?> - <?=$row1['cus_company_name']?> </option> <?php
                            }
                            ?>
                            </select>
                        </td>

                        <td> <input type="text" class="form-control fdtd dt1 dyna" name="date__<?=$row["id"]?>"  placeholder="mm/dd/yyyy" value="<?php if($row["date_"] !== "1970-01-01 00:00:00"){ echo date("m/d/Y", strtotime($row["date_"])); } ?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)"> </td>
                        <td> <input type="text" placeholder="" id="" class="form-control text-center" name="receipt_<?=$row["id"]?>" value="<?=$row["receipt"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)"></td>
                        <td> <input type="text" placeholder="" id="" class="form-control" name="account_<?=$row["id"]?>" value="<?=$row["account"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)"> </td>
                        <td>
                            <select class="form-control" id="typr" name="type_<?=$row["id"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)">
                                <option value="<?=$row['type']?>"><?=$row['type']?> </option>
                                <option data-value="Cash" value="Cash">Cash</option>
                                <option data-value="Check" value="Check">Check</option>
                                <option data-value="Electronic" value="Electronic">Electronic</option>
                                <option data-value="Mastercard" value="Mastercard">Mastercard</option>
                                <option data-value="Money Order" value="Money Order"> Money Order</option>
                                <option data-value="Visa" value="Visa">Visa</option>
                                <option data-value="Credit" value="Credit">Credit</option>
                            </select>
                        </td>
                        <td>  <input type="text" placeholder="" id="" name="checknum_<?=$row["id"]?>" class="form-control text-center" value="<?=$row["checknum"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onClick="open_uncategorised(<?=$row["id"]?>)"> </td>
                        <td>  <input type="text" placeholder="" id="" name="sdesc_<?=$row["id"]?>" class="form-control" value="<?=$row["sdesc"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onClick="open_uncategorised(<?=$row["id"]?>)"> </td>
                        <td>  <!-- <input type="text" placeholder="" id="" name="amount_<?=$row["id"]?>" class="form-control amount_total<?=$row["id"]?>" value="<?=$row["amount"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onClick="open_uncategorised(<?=$row["id"]?>)"> -->

                            <div class="input-group" >
                                <span class="input-group-addon" >
                                  <span class="glyphicon glyphicon-usd"> </span>
                                </span>
                                <input type="text" placeholder="" id="" name="amount_<?=$row["id"]?>" class="form-control amount_total<?=$row["id"]?>" value="<?=$row["amount"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onClick="open_uncategorised(<?=$row["id"]?>)">
                            </div>

                        </td>
                        <td>
                            <!-- <input type="text" placeholder="" id="" name="credit_<?=$row["id"]?>" class="form-control" value="<?=$row["credit"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onClick="open_uncategorised(<?=$row["id"]?>)">  -->

                            <div class="input-group" >
                                <span class="input-group-addon" >
                                  <span class="glyphicon glyphicon-usd"> </span>
                                </span>
                                <input type="text" placeholder="" id="" name="credit_<?=$row["id"]?>" class="form-control" value="<?=$row["credit"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)" onClick="open_uncategorised(<?=$row["id"]?>)">
                            </div>

                        </td>
                        <td>  <input type="text" class="form-control tdtd dt1 clear_dyn"
                            name="date_cleared_<?=$row["id"]?>" id="date_to"
                            tabindex="1"
                            placeholder="mm/dd/yyyy"  onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)"
                            value="<?php if($row["date_cleared"] !== "1970-01-01 00:00:00"){ echo date("m/d/Y", strtotime($row["date_cleared"])); } ?>"> </td>
                        <td>  <input type="text" class="form-control text-center" readonly="" value="<?=$row["user_id_name"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)">
                              <input type="hidden" name="username_<?=$row["id"]?>" value="<?=$row["user_id"]?>" class=" text-center"> </td>
                        <td>  <input type="text" placeholder="" id="" name="notes_<?=$row["id"]?>" class="form-control" value="<?=$row["notes"]?>" onfocusout="enter_payable_update(<?=$row["id"]?>)"  onClick="open_uncategorised(<?=$row["id"]?>)"> </td>

                    </tr>
                <?php
                }

        }


        public function amout_save(){
            $amout_save     = $this->input->post('amout_save');
            $account = $this->input->post('account_type');
            $type = $this->input->post('deptype');
            $id             = $this->input->post('id');

            $this->BankingModel->amount_update($amout_save,$account,$type, $id);
            $this->deposite_ajax();
            }



        



        public function enter_payable(){

            $notes      = $this->input->post('notes');
            $username   = $this->input->post('username');
            $date_cleared = $this->input->post('date_cleared');
            $credit     = $this->input->post('credit');
            $amount     = $this->input->post('amount');
            $sdesc      = $this->input->post('sdesc');
            $checknum   = $this->input->post('checknum');
            $type       = $this->input->post('type');
            $payments   = $this->input->post('payment');
            $vendor     = $this->input->post('vendor');
            $date_      = $this->input->post('date_');
            $receipt    = $this->input->post('receipt');
            $account    = $this->input->post('account');

            $result = $this->BankingModel->enter_payable($notes, $username, $date_cleared, $credit, $amount, $sdesc, $checknum, $type, $payments, $vendor, $date_, $receipt, $account);
            //print_r($result);
        }

        public function new_row_save(){
            //account, deposit_date, dep_type, amount, payment, cleared_date, entry_date, username

            $note           = $this->input->post('note');
            $account        = $this->input->post('account');
            $deposit_date   = $this->input->post('deposit_date');
            $dep_type       = $this->input->post('dep_type');
            $amount         = $this->input->post('amount');
            $payment        = $this->input->post('payment');
            $cleared_date   = $this->input->post('cleared_date');
            $entry_date     = $this->input->post('entry_date');
            $username     = $this->input->post('username');


            $result = $this->BankingModel->new_row_save($note, $account, $deposit_date, $dep_type, $amount, $payment, $cleared_date, $entry_date, $username);
            $this->deposite_ajax();
        }

        //Prasanna 13  Delete deposit
        public function delete_deposit_ajax() {

            $vals = $this->input->post('vals');
            $data = $this->BankingModel->delete_deposit_ajax($vals);

            return $data;
            }

        //Prasanna 12 deposit
        public function date_save(){

            $id = $this->input->post('id');
            $account = $this->input->post('account_type');
            $type = $this->input->post('deptype');
            $date_save = $this->input->post('date_save');



            if($date_save != '')
                $this->BankingModel->date_save($id, $date_save,$account,$type);

            }

        //Prasanna 11 deposit
        public function deposit() {
            if(!isset($this->session->fi_session)){
                redirect('/','refresh');
            }

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/banking/deposit');
            $this->load->view('fi/footer');
            }





        //Prasanna 10 deposit
        public function deposite_ajax() {

            //$receipt_to     = $this->input->post('receipt_to');
            //$receipt_from   = $this->input->post('receipt_from');

            $date_from      = $this->input->post('date_from');
            $date_to        = $this->input->post('date_to');

            $amount         = $this->input->post('amount');
            $deposite_num   = $this->input->post('deposite_num');
            //$check          = $this->input->post('check');

            /* if($id > 0){
                $this->BankingModel->deposit_date_clear($id);
            }*/

            $data = $this->BankingModel->deposite_ajax($date_from, $date_to, $amount, $deposite_num);
            $category = $this->BankingModel->getCategory();
            $dop_type = $this->BankingModel->getPayType();

             ?>
    <!--                 <tr class="tr_clone ">
    <td><span>#</span>  </td>
    <td><span><input type="text" class="form-control text-center dt atd" name="deposit_date" id="date_to" tabindex="1" value="" placeholder="mm/dd/yyyy"></span>  </td>
    <td><span>
            <select class="form-control" name="account" >
                <option> test </option>
                <option value="test">test</option>
            </select>
        </span>
    </td>
    <td><span>
            <select class="form-control " name="dep_type" >
                <option> test </option>
                <option value="test">test</option>
            </select>
        </span>
    </td>
    <td><span>
            <input type="text" value="0" style="width: 100%;" name="amount" class="text-right form-control">
        </span>
    </td>
    <td><span>
            <a class="btn btn-xs btn-primary" href="<?=base_url('Fi_banking/selectreceivables/0')?>" style=""> View payments</a>
        </span>
    </td>
    <td><span>
            <input type="text" value="0" style="width: 100%;" name="payment" readonly="" class="text-right form-control">
        </span>
    </td>
    <td><span>
            <input type="text" class="form-control w100 dt btd" name="cleared_date" id="date_to" tabindex="1" value="" placeholder="mm/dd/yyyy"></span></td>
    <td><span><input type="text" style="width: 100%;" value="" name="note" > </span></td>
    <td><span><input type="text" value="<?= $this->session->fi_session['name']  ?>" style="width: 100%;" readonly="" class="text-center form-control" > </span> </td>
    <input type="hidden" value="<?= $this->session->fi_session['id']  ?>" name="username">
    <td><span><input type="text" class="form-control w100 dt ctd" onfocusout="new_row_save()"  name="entry_date" id="date_to" tabindex="1" value="" placeholder="mm/dd/yyyy"></span></td>
    <td><a class="btn btn-xs btn-danger" onclick="delete_row('<?=$row["id"]?>')" style="margin-right: 16px;"><i class="fa fa-minus"></i></a></td>
                    </tr -->>
              <?php

            foreach($data as $row) {
                $color = '';
                if($row["amount"] != $row["payment"]){
                    $color='border: 2px solid red;';
                }
                ?>

                <tr class="tr_clone trshowcust">
                    <td><span><?=$row["id"]?></span>  </td>
                    <td><span><?=date("m/d/Y", strtotime($row["deposit_date"]))?></span>  </td>
                    <td><span>
                            <select class="form-control " name="account" id="account" >
                                <option value="0"> Select Account type </option>
                                <?php foreach ($category as $key => $value): ?>
                                    <option <?php if ($value['sub_id']==$row["account"]) {
                                      echo 'Selected';
                                    } ?> value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
                                <?php endforeach; ?>

                            </select>
                        </span>
                    </td>
                    <td><span>
                            <select class="form-control " name="dep_type"  id="dep_type" >
                              <option value="0"> Select Payment type </option>
                              <?php foreach ($dop_type as $key => $value): ?>
                                  <option <?php if ($value['sub_id']==$row["type"]) {
                                    echo 'Selected';
                                  } ?>  value="<?php echo $value['sub_id'] ?>"><?php echo $value['sub_name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                        </span>
                    </td>
                    <td><span>
                            <input onfocusout="amout_save(<?=$row["id"]?>)" class="amout_save_input<?=$row["id"]?> text-right form-control" type="text" value="$<?=$row["amount"]?>" name="<?=$row["id"]?>">

                        </span>
                    </td>
                    <td><span>
                            <a class="btn btn-xs btn-primary" href="<?=base_url('Fi_banking/selectreceivables/'.$row['id'])?>" style=""> View payments</a>
                        </span>
                    </td>
                    <td style="<?=$color?>" class="text-right">
                        <span class="block_element text-right" style="padding-right: 2px;">
                            <?='$'.$row["payment"]?>
                        </span>
                    </td>
                    <td><span>
                            <input onfocusout="date_save(<?=$row["id"]?>)" type="text" class="form-control w100 dt td date_save_<?=$row["id"]?>" name="date" id="date_to" tabindex="1"
                        value="<?php if($row["date_cleared"] != ''){ echo date("m/d/Y", strtotime($row["date_cleared"])); } ?>" placeholder="mm/dd/yyyy"></span></td>
                    <td><span><?=$row["note"]?></span></td>
                    <td><span><?=$row["username"]?></span> </td>
                    <td><span><?=date("m/d/Y", strtotime($row["date_entery"]))?></span></td>
                    <!-- <td><a class="btn btn-xs btn-danger" onclick="delete_row('<?=$row["id"]?>')" style="margin-right: 16px;"><i class="fa fa-minus"></i></a></td> -->
                </tr>

              <!--   <tr class="tr_clone">
                  <td>    <span>  1   </span> </td>
                  <td>    <span>  <?=$row["deposit"]?></span> </td>
                  <td>    <span>  $<?=$row["amount_"]?></span> </td>
                  <td>    <span>  <?=$row["count_"]?></span> </td>
                  <td>    <span>  <input type="checkbox" onClick="toggle(this)" /></span></td>
              </tr>  --> <?php }


            }

        //Prasanna 9 select receivables
        public function delete_payment_ajax() {

            $vals = $this->input->post('vals');
            $data = $this->BankingModel->delete_payment_ajax($vals);

            return $data;
            }





        //Prasanna 7 select receivables
        public function selectreceivables_ajax() {

            $do_deposite = $this->input->post('do_deposite');
            $id_deposit = $this->input->post('id_deposit');



            $deposite       = $this->input->post('deposite');
            $deposite_in   = $this->input->post('deposited_in');

            $receipt_to     = $this->input->post('receipt_to');
            $receipt_from   = $this->input->post('receipt_from');

            $date_from      = $this->input->post('date_from');
            $date_to        = $this->input->post('date_to');

            $amount         = $this->input->post('amount');
            $deposite_num   = $this->input->post('deposite_num');
            $check          = $this->input->post('check');

           // print_r($_POST);

            if($do_deposite > 0){
                $this->BankingModel->do_deposite($deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to, $do_deposite);
            }

            $data = $this->BankingModel->selectreceivables_ajax($deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to, $id_deposit);
            $i = 1;

            //print_r(data);

           $amount = 0;

            foreach($data as $row) {
                $amount =$amount+$row["amount"];
             ?>
            <tr class="tr_clone trshowcust <?=$row["c_id"]?>" >
                <td><?=$i++?></td>
                <td class="select_total"><input type="checkbox" class="to_deposite" value="<?=$row["c_id"]?>" name="bookedcheck[<?=$row["c_id"]?>]"  onclick="myFunction($(this), <?=$row["c_id"]?>)"></td>
                <td><?=$row["cus_acc_no"]?></td>
                <td><?=$row["cus_fname"]?></td>
                <td><?=$row["cus_lname"]?></td>
                <td><?=$row["cus_company_name"]?></td>
                <td><?=date("m/d/Y", strtotime($row["date"]))?></td>
                <td><span  class="text-right blockk">$<?=$row["amount"]?> </span></td>
                <td><?=$row["type"]?></td>
                <td><?=$row["chk_num"]?></td>
                <td><?=$row["receipt"]?></td>
                <td><?=$row["deposit"]?></td>
                <td><?=$row["username"]?></td>
                <td><?=$row["notes"]?></td>
                <td><a class="btn btn-xs btn-danger" onclick="delete_row('<?=$row["c_id"]?>')" style="margin-right: 16px;"><i class="fa fa-minus"></i></a></td>

            </tr>
            <?php
            }

            ?>
            <tr class="" >
                <td colspan="4">
                    COUNT <span class="count_val"><?=$i-1?></span>
                </td>

                <td></td>
                <td colspan="4"> SUM <span class="count_val"><?=$amount?></span> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>


            </tr>
            <?php
            }



        //Banking 5
        public function index() {

            if(!isset($this->session->fi_session)){
                redirect('/','refresh');
            }


            $data['alert']     = $this->session->flashdata('alert');
            $data['error']     = $this->session->flashdata('error');
            $data['success']   = $this->session->flashdata('success');



		  $this->load->view('fi/header');
		  $this->load->view('fi/sidebar');
		  $this->load->view('fi/dash',$data);
		  $this->load->view('fi/footer');
	       }

        //Banking 4
        public function viewbalances() {

        	if(!isset($this->session->fi_session)){
        			redirect('/','refresh');
        	}

        	$this->load->view('fi/header');
        	$this->load->view('fi/sidebar');
        	$this->load->view('fi/view-balances');
        	$this->load->view('fi/footer');
        	}

        //Banking 3
        public function clearpayables() {

    		if(!isset($this->session->fi_session)){
    			redirect('/','refresh');
    		}

    		$this->load->view('fi/header');
    		$this->load->view('fi/sidebar');
    		$this->load->view('fi/clear-payables');
    		$this->load->view('fi/footer');
    	   }




        //Banking 1
        public function transfers() {

    		if(!isset($this->session->fi_session)){
    			redirect('/','refresh');
    		}

    		$this->load->view('fi/header');
    		$this->load->view('fi/sidebar');
    		$this->load->view('fi/transfers');
    		$this->load->view('fi/footer');
    	   }


         public function getDepositeByDate()
         {
           $date=$this->input->post('date');
           $total=0;
           $data=$this->BankingModel->getDepositeByDate($date);

           foreach ($data as $key => $value) {

             $account=$value['account'];
             $amount=$value['total'];
             //$opening=$value['opening_bal'];
             $final=$value['final'];
             $bal=$amount;
             $total=0.00;
             $diff=0.00;
             //$total+=$value['amount'];
             // $total=$total+$amount;
              $diff=$final-$amount;
             ?>
             <tr>
             <td><?php echo ++$key;?></td>
             <td><?php echo $account;?></td>
             <td><?php echo '$'.number_format($amount,2);?></td>
             <td><?php echo '$'.number_format($final,2);?></td>
             <td><?php echo '$'.number_format($diff,2);?></td>
           </tr>
<?php
           }
         }

         public function transfer_payment() {
             if(!isset($this->session->fi_session)){
                 redirect('/','refresh');
             }

               $data['category']=$this->BankingModel->getCategory();

             $this->load->view('fi/header');
             $this->load->view('fi/sidebar');
             $this->load->view('fi/banking/transfer_payment',$data);
             $this->load->view('fi/footer');
             }

             public function transferPayment()
             {
               $date      = $this->input->post('tdate');
               $fromaccount = $this->input->post('fromaccount');
               $toaccount   = $this->input->post('toaccount');
               $amount   = $this->input->post('amount');
               $note   = $this->input->post('note');
               $user   = $this->input->post('user');

               $data=array(
                 'transfer_date' => $date,
                 'from_account' => $fromaccount,
                 'to_account' => $toaccount,
                 'amount' => $amount,
                 'note' => $note,
                 'user' => $user
               );

               $data = $this->BankingModel->transferPayment('transfer_payment',$data);

               return $data;



             }

             public function scanner() {
                 if(!isset($this->session->fi_session)){
                     redirect('/','refresh');
                 }

                   //$data['category']=$this->BankingModel->getCategory();


                 $this->load->view('fi/demo');
                 }



}
