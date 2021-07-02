<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class BankingModel extends CI_Model {

	function __construct(){
		parent::__construct();
        //initialise the autoload things for this class
	   }

    public function open_uncategorised_update($id, $category, $sub_category, $un_amount){
        $array_update = array(

            'categorised'       => $category,
            'subcategorised'    => $sub_category,
            'amount'            => $un_amount
            );

        $this->db->where('id', $id);
        $this->db->update('enter_payable_uncategorised', $array_update);
        }

    public function open_uncategorised($id){
        $query = $this->db
            ->select('`id`, `categorised`, `subcategorised`, `amount`, `enter_payable_id`')
            ->from('`enter_payable_uncategorised`')
            ->where('enter_payable_id', $id)
            ->order_by("id", "ASC")
            ->get();
           //print_r($this->db->last_query());
            return $query->result_array();
        }

    public function open_uncategorised_insert($enter_payable_id, $category, $sub_category, $un_amount) {

        $array_insert = array(
            'enter_payable_id'  => $enter_payable_id,
            'categorised'       => $category,
            'subcategorised'    => $sub_category,
            'amount'            => $un_amount
            );

        $result = $this->db->insert('enter_payable_uncategorised', $array_insert);
        //print_r($this->db->last_query());
        return $result;
        }

    public function enter_payable_update($id, $notes, $username, $date_cleared, $credit, $amount, $sdesc, $checknum, $type, $payments, $vendor, $date_, $receipt, $account){

            $array_update = array(
                'payments'  => $payments,
                'vendor_id' => $vendor,
                'date_'     => date("Y-m-d", strtotime($date_)),
                'receipt'   => $receipt,
                'account'   => $account,
                'type'      => $type,
                'checknum'  => $checknum,
                'sdesc'     => $sdesc,
                'amount'    => $amount,
                'credit'    => $credit,
                'date_cleared' => date("Y-m-d", strtotime($date_cleared)),
                'user_id'   => $username,
                'notes'     => $notes );

            $this->db->where('id', $id);
            $this->db->update('enter_payable', $array_update);

            print_r($this->db->last_query());

            }

    public function vendor_list(){

        $query = $this->db->select('rv.*')
            ->from('`register_vendor` `rv`')
            /*->join('`users` `u`', '`u`.`id` = `d`.`user`', 'left')
            ->where($arr)*/
            ->order_by("rv.cus_id", "ASC")
            ->get();
            //print_r($this->db->last_query());
            return $query->result_array();

    }

    public function enter_payable_display(){

        $query = $this->db
            ->select('ep.*, rv.*, u.name as user_id_name')
            ->from('`enter_payable` `ep`')
            ->join('`register_vendor` `rv`', '`rv`.`cus_id` = `ep`.`id`', 'left')
            ->join('`users` `u`', '`u`.`id` = `ep`.`user_id`', 'left')
            ->order_by("ep.id", "DESC")
            ->get();
            //print_r($this->db->last_query());
            return $query->result_array();
        }

       public function enter_payable($notes, $username, $date_cleared, $credit, $amount, $sdesc, $checknum, $type, $payments, $vendor, $date_, $receipt, $account){

            $array_insert = array('payments' => $payments,
                    'vendor_id' => $vendor,
                    'date_'     => date("Y-m-d", strtotime($date_)),
                    'receipt'   => $receipt,
                    'account'   => $account,
                    'type'      => $type,
                    'checknum'  => $checknum,
                    'sdesc'     => $sdesc,
                    'amount'    => $amount,
                    'credit'    => $credit,
                    'date_cleared' => date("Y-m-d", strtotime($date_cleared)),
                    'user_id'   => $username,
                    'notes'     => $notes );

            $result = $this->db->insert('enter_payable', $array_insert);
            //print_r($this->db->last_query());
            return $result;

       }

    //Prasanna 10 deposite to save new row
    public function new_row_save($note, $account, $deposit_date, $dep_type, $amount, $payment, $cleared_date, $entry_date, $username){

        $user = $this->session->userdata('id');

        $array_insert = array(
            'account'           => $account,
            'deposit_date'      => date("Y-m-d", strtotime($deposit_date)),
            'type'              => $dep_type,
            'amount'            => $amount,
            'payment'           => $payment,
            'date_cleared'      => date("Y-m-d", strtotime($cleared_date)),
            'note'              => $note,
            'user'              => $username,
            'date_entery'       => date("Y-m-d", strtotime($entry_date)));

        $this->db->insert('deposit', $array_insert);
        }

    //Prasanna 9 deposit to amount update
    public function amount_update($amout_save,$account,$type,$id){

        $data = array(
                'amount' => $amout_save,
                'account' => $account,
                'type' => $type
            );

        $this->db->where('id', $id);
        $this->db->update('deposit', $data);
        //print_r($this->db->last_query());
        }


   //Prasanna 10 deposit Delete
    public function delete_deposit_ajax($id){

        $data = array(
                'status' => 0
            );

        $this->db->where('user_id', $id);
        $this->db->delete('deposite');
        return 1;

        }


    //Prasanna 8 deposit
    public function date_save($id, $date_save,$account,$type){

        $data = array(
                'account' => $account,
                'type' => $type,
                'date_cleared' => date("Y-m-d", strtotime($date_save))
            );

        $this->db->update('deposit', $data, "id = $id");
        }

    //Prasanna 7 deposit
    public function deposit_date_clear($id){

        $data = array(
                'date_cleared' => date("Y-m-d h:i:sa"),
                'date_entery' => date("Y-m-d h:i:sa")
            );

        $this->db->update('deposit', $data, "id = $id");
        }


    //Prasanna 6 Deposite
    public function deposite_ajax($date_from, $date_to, $amount, $deposite_num) {

        if($date_from !='' && $date_to != ''){
            $date_from  = date("Y-m-d", strtotime($date_from));
            $date_to    = date("Y-m-d", strtotime($date_to));
        }

        //SELECT `id`, `deposit_date`, `account`, `type`, `amount`, `payment`, `date_cleared`, `note`, `user`, `date_entery` FROM `deposit` WHERE 1

        $arr = array('`d`.`id`'=>$deposite_num, '`d`.`amount`'=>$amount, '`d`.`deposit_date` >='=>$date_from, '`d`.`deposit_date` <='=>$date_to);



        foreach ($arr as $key=>$val) {
            if ($val == '')
                unset($arr[$key]);
        }

        $query = $this
            ->db
            ->select('`d`.`id`, `d`.`deposit_date`,
            `d`.`account`, `d`.`type`,
            `d`.`amount`, `d`.`payment`,
            `d`.`date_cleared`, `d`.`note`,
            `d`.`user`, `d`.`date_entery`,
            `u`.`username`')
            ->from('`deposit` `d`')
            ->join('`users` `u`', '`u`.`id` = `d`.`user`', 'left')
            ->where($arr)
            ->order_by("`d`.`id` DESC")
            ->get();
           // print_r($this->db->last_query());
            return $query->result_array();
        }

    //Prasanna 5 select receivables
    public function max_id() {

        $maxid = 0;
        $row = $this->db->query('SELECT MAX(cus_id) AS `max_id` FROM `register_customer`')->row();
        if ($row) {
            $maxid = $row->max_id;
        }

        $cust_inv1 = $this->db->query("SELECT `invoice_name`, `invoice_date`, `invoice_due_date`, `invoice_type`, `invoice_contract_type`, `invoice_discount`, `invoice_sub_total`, `invoice_tax`, `invoice_amount`, `invoice_paid`, `invoice_balance_due`, `invoice_tax_rate` FROM invoices_create WHERE `cust_id` = '$maxid'");
        return $cust_inv1;
        }

    //Prasanna 4 select receivables
    public function delete_payment_ajax($id){

        $data = array(
                'status' => 0
            );

        $data =  $this->db->update('customer_payment_history', $data, "id = $id");
        return 1;

        }


    public function selectreceivables_ajax($deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to, $id_deposit) {

        if($date_from !='' && $date_to != ''){
            $date_from  = date("Y-m-d", strtotime($date_from));
            $date_to    = date("Y-m-d", strtotime($date_to));
        }


        $arr = array( 'c.do_deposite !=' => 1, 'c.status' => 1, '`c`.`receipt'=> $receipt_from, '`c`.`receipt` <='=>$receipt_to, '`c`.`chk_num`'=>$check, '`c`.`deposit`'=>$deposite_num, '`c`.`amount`'=>$amount, '`c`.`date` >='=>$date_from, '`c`.`date` <='=>$date_to);

        foreach ($arr as $key=>$val) {
            if ($val == '')
                unset($arr[$key]);
        }



            if($deposite != "") {
                if($deposite_in == 1) {
                    $arr = [ 'c.status'=> 1, 'c.type'=>$deposite ];
                }else{
                    $arr = [ 'c.do_deposite !=' => 1, 'c.status' => 1, 'c.type' =>$deposite ];
                }
            }else {
                if($deposite_in == 1) {
                    $arr = [ 'c.status'=> 1 ];
                }

            }

        $arr['user'] = $this->session->userdata['fi_session']['id'];


            $query = $this
            ->db
            ->select(' `r`.`cus_id`,
                `r`.`cus_title`,
                `r`.`cus_fname`,
                `r`.`cus_lname`,
                `r`.`cus_company_name`,
                `r`.`cus_address1`,
                `r`.`cus_address2`,
                `r`.`cus_city`,
                `r`.`cus_state`,
                `r`.`cus_zip`,
                `r`.`cus_area`,
                `r`.`cus_tax_status`,
                `r`.`cus_tax_id`,
                `r`.`cus_status`,
                `r`.`cus_register_date`,
                `r`.`cus_acc_no`,
                `c`.`id` c_id,
                `c`.`cust_id`,
                `c`.`date`,
                `c`.`receipt`,
                `c`.`type`,
                `c`.`chk_num`,
                `c`.`pdesc`,
                `c`.`amount`,
                `c`.`credit`,
                `u`.`username`,
                `c`.`notes`,
                `c`.`deposit`,
                `c`.`status`')
            ->from('`register_customer` `r`')
            ->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`', 'LEFT')
            ->join('`users` `u`', '`u`.`id` = `c`.`usrename`', 'LEFT')
            ->where($arr)
            ->order_by("r.cus_id DESC")
            ->get();



            if($id_deposit > 0) {
                $query = $this
                ->db
                ->select(' `r`.`cus_id`, `r`.`cus_title`,
                    `r`.`cus_fname`, `r`.`cus_lname`,
                    `r`.`cus_company_name`, `r`.`cus_address1`,
                    `r`.`cus_address2`, `r`.`cus_city`,
                    `r`.`cus_state`, `r`.`cus_zip`,
                    `r`.`cus_area`,
                    `r`.`cus_tax_status`,
                    `r`.`cus_tax_id`,
                    `r`.`cus_status`,
                    `r`.`cus_register_date`,
                    `r`.`cus_acc_no`,
                    `c`.`id` c_id,
                    `c`.`cust_id`,
                    `c`.`date`,
                    `c`.`receipt`,
                    `c`.`type`,
                    `c`.`chk_num`,
                    `c`.`pdesc`,
                    `c`.`amount`,
                    `c`.`credit`,
                    `u`.`username`,
                    `c`.`notes`,
                    `c`.`deposit`,
                    `c`.`status`')
                ->from('`register_customer` `r`')
                ->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`', 'LEFT')
                ->join('`users` `u`', '`u`.`id` = `c`.`usrename`', 'LEFT')
                ->join('`deposit_view_payment` `d`', '`d`.`customer_payment_history_id` = `c`.`id`', 'LEFT')
                ->where_in('`d`.`deposite_id`', $id_deposit)
                ->order_by("r.cus_id DESC")
                ->get();

            }

            //print_r($this->db->last_query());


            return $query->result_array();
        }


    //Prasanna 2 select receivables
    public function selectreceivables_ajax_total($id_deposit, $deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to) {

        if($date_from !='' && $date_to != ''){
            $date_from  = date("Y-m-d", strtotime($date_from));
            $date_to    = date("Y-m-d", strtotime($date_to));
        }

        $arr = array( 'c.do_deposite !=' => 1, 'c.status' => 1, '`c`.`receipt'=> $receipt_from, '`c`.`receipt` <='=>$receipt_to, '`c`.`chk_num`'=>$check, '`c`.`deposit`'=>$deposite_num, '`c`.`amount`'=>$amount, '`c`.`date` >='=>$date_from, '`c`.`date` <='=>$date_to);
        foreach ($arr as $key=>$val) {
            if ($val == '')
                unset($arr[$key]);
        }



            if($deposite != "") {
                if($deposite_in == 1) {
                    $arr = [ 'c.status'=> 1, 'c.type'=>$deposite ];
                }else{
                    $arr = [ 'c.do_deposite' => 1, 'c.status' => 1, 'c.type' =>$deposite ];
                }
            }else {
                if($deposite_in == 1) {
                    $arr = [ 'c.status'=> 1 ];
                }
            }



            $query = $this
            ->db
            ->select(' count(`r`.`cus_id`) count_, `c`.`type` type_, sum(`c`.`amount`) amount_ ')
            ->from('`register_customer` `r`')
            ->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`')
            ->join('`users` `u`', '`u`.`id` = `c`.`usrename`')
            ->where($arr)
            ->group_by('type_')
            ->order_by("r.cus_id DESC")
            ->get();


        if($id_deposit > 0) {
            $query = $this
            ->db
            ->select(' count(`r`.`cus_id`) count_, `c`.`type` type_, sum(`c`.`amount`) amount_ ')
            ->from('`register_customer` `r`')
            ->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`')
            ->join('`users` `u`', '`u`.`id` = `c`.`usrename`')
            ->join('`deposit_view_payment` `d`', '`d`.`customer_payment_history_id` = `c`.`id`')
            ->where_in('`d`.`deposite_id`', $id_deposit)
            ->group_by('type_')
            ->order_by("r.cus_id DESC")
            ->get();

        }

        //print_r($this->db->last_query());
        //print_r($query) ;
            return $query->result_array();
        }

    //Prasanna 1 select receivables
    public function do_deposite($deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to, $do_deposite) {


        $arr = array(
            'do_deposite' => 1,
            'date_do_deposite' => date("Y-m-d h:i:sa")
        );

        foreach($do_deposite as $row)  {
            $this->db->where('id', $row);
            $this->db->update('customer_payment_history', $arr);
        }

            $query = $this
            ->db
            ->select(' count(`r`.`cus_id`) count_,

                `c`.`type` type_,

                sum(`c`.`amount`) amount_, u.id, `c`.`notes`,
                ')
            ->from('`register_customer` `r`')
            ->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`')
            ->join('`users` `u`', '`u`.`id` = `c`.`usrename`')
            ->where_in('c.id', $do_deposite)
            ->order_by("r.cus_id DESC")
            ->get();


            $data = $query->result_array();



            foreach ($data as $value) {



                $data = array(
                'deposit_date'  =>  date("Y-m-d h:i:sa"),
                'date_entery'   =>  date("Y-m-d h:i:sa"),
                'amount'        =>  $value['amount_'],
                'payment'       =>  $value['amount_'],
                'note'          =>  $value['notes'],
                'user'          =>  $this->session->fi_session['id']
                );
            }


            $this->db->insert('deposit',$data);
            $insert_id = $this->db->insert_id();



            $data_update_deposit = array(
                    'deposit'   =>  $insert_id
                );

            $this->db->where_in('id', $do_deposite);
            $this->db->update('customer_payment_history', $data_update_deposit);





            foreach($do_deposite as $row)  {

                $data = array(
                    'deposite_id'          =>  $insert_id,
                    'customer_payment_history_id'          =>   $row
                );
                $this->db->insert('deposit_view_payment',$data);
            }

        }

        public function getCategory(){

            $query = $this->db
                ->select('sub_categories.*')
                ->from('`sub_categories`')
                ->join('`categories`', 'categories.id=sub_categories.cat_id')
                ->where('categories.cat_name','Deposit Accounts')
                ->get();
                //print_r($this->db->last_query());
                return $query->result_array();
            }

            public function getPayType(){

                $query = $this->db
                    ->select('sub_categories.*')
                    ->from('`sub_categories`')
                    ->join('`categories`', 'categories.id=sub_categories.cat_id')
                    ->where('categories.cat_name','Deposit types')
                    ->get();
                    print_r($this->db->last_query());
                    return $query->result_array();
                }

                public function getDepositeByDate($date)
                {
                  $query = $this->db
                      ->select('sub_categories.sub_name AS account,SUM(amount) AS total, (SELECT SUM(amount) FROM deposit WHERE deposit.account=sub_categories.sub_id AND deposit.date_cleared <= CURDATE()  ) AS final')
                      ->from('`deposit`')
                      ->join('sub_categories', 'sub_categories.sub_id=deposit.account')
                      ->where('deposit.date_cleared <=',$date)
											->group_by('deposit.account')
                      ->get();
                      //print_r($this->db->last_query());
                      //$data = $query->result_array();
                      return $query->result_array();;
                }

								public function transferPayment($table,$data)
								{
									$result = $this->db->insert($table, $data);
									//print_r($this->db->last_query());
									return $result;
								}
}
