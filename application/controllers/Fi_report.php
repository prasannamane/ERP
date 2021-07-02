<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Fi_report extends CI_Controller 
    {

        public function __construct(){
            parent::__construct();
            $this->load->model('AdminModel');
            $this->load->model('DashboardModel');
        }

        public function expense_detail_report_by_account_report() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/expense-detail-report-by-account-report');
            $this->load->view('fi/footer');
        }

        public function referredby_report() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/referredby-report');
            $this->load->view('fi/footer');
        }

        public function expense_report_by_vendor_report() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/expense-report-by-vendor-report');
            $this->load->view('fi/footer');
        }

        public function profitrepbyevent_report() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/profitrepbyevent-report');
            $this->load->view('fi/footer');
        }

        public function expense_detail_report() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/expense-detail-report');
            $this->load->view('fi/footer');
        }

        public function selected_crews_report() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/selected-crews-report');
            $this->load->view('fi/footer');
        }

        public function sales_tax_details() 
        {
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/sales-tax-details');
            $this->load->view('fi/footer');
        }

        public function no_crews() 
        {        
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/no_crews');
            $this->load->view('fi/footer');
        }

        public function upcoming_events_report() 
        {   
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/upcoming-events-report');
            $this->load->view('fi/footer');
        }


        public function save_data_invoce(){

            print_r($_POST);
            $package_id = $this->input->post('id');

           
            $all_packs = $this->db->query(" SELECT `id`, `package_id`, `item_name`, `item_quantity`, `item_price`, `item_desc`, `item_created_at` FROM `admin_package_item` WHERE package_id = '".$package_id."'");

            foreach($all_packs->result() as $items){

            ?>
            <tr class="<?=$package_id?>">
             <td><?=$items->item_desc?></td>
              <td><input type="number" value="<?=$items->item_quantity?>" class="count-me qty<?=$items->id?>" onchange="quty_change('<?=$items->id?>')" ></td>
              <td><input type="number" value="<?=$items->item_price?>" class="imdisable price<?=$items->id?>" readonly></td>
               
                <td><input type="number" value="<?=$items->item_price?>" class=" count-here total<?=$items->id?>" readonly></td>
           
            </tr>
            <?php


          } 

        }







        public function invoice_pdf() {

            if(!isset($this->session->fi_session)){
                redirect('/','refresh');
            }


 
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/invoice');
            $this->load->view('fi/footer');
            }

        public function contract_pdf() {

            if(!isset($this->session->fi_session)){
                redirect('/','refresh');
            }
 
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/report/contract_pdf');
            $this->load->view('fi/footer');
            }

 



    }