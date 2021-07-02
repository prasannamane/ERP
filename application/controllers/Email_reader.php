<?php

    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Email_reader extends CI_Controller 
    {
        public $conn;
        private $inbox;
        private $msg_cnt;
        private $server = 'ourmainevent.com';
        private $user  = 'prasanna@ourmainevent.com';
        private $pass   = 'Prasanna@12';
        private $port   = 143; // adjust according to server settings

        function __construct() 
        {
            parent::__construct();
            $this->load->model('AdminModel');
        }

        public function index()
        {
            /*$squery     = "SELECT * FROM users WHERE mail_active =1 ";
            $result    = $this->db->query($squery)->result_array();
            $data = $result[0];
            $this->$user = $data['email'];
            $this->$pass = $data['mail_pass'];
            */

            $this->connect();
            $this->inbox();
        }  

        public function connect() 
        {
            $this->conn = imap_open('{'.$this->server.'/notls}', $this->user, $this->pass);
        }
        
        public function move($msg_index, $folder='INBOX.Processed') 
        {
            imap_mail_move($this->conn, $msg_index, $folder);
            imap_expunge($this->conn);
            $this->inbox();
        }

        public function get($msg_index=NULL) 
        {
            if (count($this->inbox) <= 0) {
                return array();
            }
            elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) 
            {
                return $this->inbox[$msg_index];
            }

            return $this->inbox[0];
        }

        public function inbox() 
        {
            $this->msg_cnt = imap_num_msg($this->conn);
            $in = array();
            for($i = 1; $i <= $this->msg_cnt; $i++) 
            {
                $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($this->conn, $i),
                'body'      => imap_body($this->conn, $i),
                'structure' => imap_fetchstructure($this->conn, $i)
            );

            $old_date_timestamp = strtotime(imap_headerinfo($this->conn, $i)->date);
            $date = date('Y-m-d', $old_date_timestamp);
            $time = date('H:i:s', $old_date_timestamp);
            $toaddress = imap_headerinfo($this->conn, $i)->toaddress;
            $subject = trim(preg_replace('/\s+/', ' ', strip_tags(imap_headerinfo($this->conn, $i)->subject)));
            $body = trim(preg_replace('/\s+/', ' ', strip_tags(imap_body($this->conn, $i))));

            $j = 0;
            foreach(imap_headerinfo($this->conn, $i) as $row){
                
                if( ($j++) == 8)
                {
                    $mailbox        = $row[0]->mailbox;
                    $host           = $row[0]->host;
                    $sender_mail    = $mailbox."@".$host;
                    $finalstrstr = strstr( $body, 'UTF-8');
                    $finalstrstr = strstr( $finalstrstr, 'UTF-8');

                    $arrayName = array(
                        "id" => $i,
                        "sender_mail" => $sender_mail,
                        "date" => $date,
                        "time" =>  $time,
                        "subject" => $subject, 
                        "body" => $finalstrstr,
                        "sender_mail" => $sender_mail,
                        "receiver_email" =>  $toaddress,
                        "type" => 1
                    );
                    $result = $this->AdminModel->check_corr($i);
                    $d = $result['0'];
                    if($d['id'] == ''){
                      $this->AdminModel->insert_corr($arrayName);
                    }




               
                }
            }

            // echo $sender_mail;
              //  echo '<hr>';
//echo "<hr>";
//print_r(imap_headerinfo($this->conn, $i)[0]->mailbox);
    //echo $sender_mail;       

     /*      
            $arrayName = array(
                "id" => $i,
                
                "time" =>  $time,
                "subject" => $subject, 
                "body" => $body,
                "sender_mail" => $sender_mail,
                "receiver_email" =>  $toaddress,
                "type" => 1
            );
            
            
            $result = $this->AdminModel->check_corr($i);

            $d = $result['0'];
            //         print_r($d['id']);
            
            if($d['id'] == ''){

                $this->AdminModel->insert_corr($arrayName);

                

            }else{

                $arrayName = array(
                "date" => $date,
                "time" =>  $time,
                "subject" => $subject, 
                "body" => $body,
                "sender_mail" => $mailbox."@".$host,
                "receiver_email" =>  $toaddress,
                "type" => 1
                );
               $this->AdminModel->update_corr($arrayName, $i);

            }
            

       */ 


        }

        $this->inbox = $in;

        print_r($in);


  /*      $i = 0;

        foreach ($in as $row) {
            $j = 0;
            foreach ($row as $row1) {


               
                echo $i."-".$j;
                echo "<br><hr><br>";
                print_r($row1);
                print_r($row1->date);
                print_r($row1->subject);
                mailbox
                personal
            }
            
        }*/
    }
}