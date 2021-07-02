<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(0);

defined('BASEPATH') or exit('No direct script access allowed');

class AjaxController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('DashboardModel');
        $this->load->model('Attachment_Model');
        $this->load->model('TaskModel');
        $this->load->model('HomeModel');
        $this->load->library('pdf');
    }

    public function event()
    {
        $company_admin = $this->session->fi_session['id'];
        $cus_id = $this->session->userdata('id');
        $invoice_number = $this->session->userdata('invoice_number');

        $data['invoice_number'] = $invoice_number;

        $cond1 = array('id' => $company_admin);
        $tbl1 = 'users';
        $data['users'] = $this->HomeModel->get_all_by_cond($tbl1, $cond1);

        $cond2 = array('cus_id' => $cus_id);
        $tbl2 = 'register_customer';
        $data['register_customer'] = $this->HomeModel->get_all_by_cond($tbl2, $cond2);

        $cond3 = array('cus_id' => $cus_id);
        $tbl3 = 'user_contact_info';
        $data['user_contact_info'] = $this->HomeModel->get_all_by_cond($tbl3, $cond3);

        $cond4 = array('cus_id' => $cus_id);
        $tbl4 = 'customer_additional_contacts';
        $data['cacontacts'] = $this->HomeModel->get_all_by_cond($tbl4, $cond4);

        $cond5 = array('invoice_id' => $invoice_number);
        $tbl5 = 'invoices_create';
        $invoices_create = $data['invoices_create'] = $this->HomeModel->get_all_by_cond($tbl5, $cond5);

        $invoice_type = $invoices_create[0]['invoice_type'];
        $data['invoice_balance_due'] = $invoices_create[0]['invoice_balance_due'];
        $data['invoice_amount'] = $invoices_create[0]['invoice_amount'];
        $data['invoice_tax'] = $invoices_create[0]['invoice_tax'];

        $cond6 = array('event_id' => $invoice_type, 'crews_hide !=' => 1);
        $tbl6 = 'event_crews';
        $data['event_crews'] = $this->HomeModel->get_all_by_cond($tbl6, $cond6);

        $cond7 = array('inv_id' => $invoice_number);
        $tbl7 = "customer_assigned_packages";
        $data['capackages'] = $this->HomeModel->get_all_by_cond($tbl7, $cond7);

        $cond8 = array('event_id' => $invoice_type);
        $tbl8 = "event_location";
        $data['location'] = $this->HomeModel->get_all_by_cond($tbl8, $cond8);

        $cond9 = array('event_id' => $invoice_type);
        $tbl9 = "events_register";
        $data['events_register'] = $this->HomeModel->get_all_by_cond($tbl9, $cond9);

        $cond9 = array('event_id' => $invoice_type);
        $tbl9 = "event_jobs";
        $data['event_jobs'] = $this->HomeModel->get_all_by_cond($tbl9, $cond9);



        $data['title'] = "Event Details";

        $this->load->view('fi/customer/event', $data);
    }



    public function invoice()
    {
        $company_admin = $this->session->fi_session['id'];
        $cus_id = $this->session->userdata('id');
        $invoice_number = $this->session->userdata('invoice_number');

        $data['invoice_number'] = $invoice_number;

        $cond1 = array('id' => $company_admin);
        $tbl1 = 'users';
        $data['users'] = $this->HomeModel->get_all_by_cond($tbl1, $cond1);

        $cond2 = array('cus_id' => $cus_id);
        $tbl2 = 'register_customer';
        $data['register_customer'] = $this->HomeModel->get_all_by_cond($tbl2, $cond2);

        $cond3 = array('cus_id' => $cus_id);
        $tbl3 = 'user_contact_info';
        $data['user_contact_info'] = $this->HomeModel->get_all_by_cond($tbl3, $cond3);

        $cond4 = array('cus_id' => $cus_id);
        $tbl4 = 'customer_additional_contacts';
        $data['cacontacts'] = $this->HomeModel->get_all_by_cond($tbl4, $cond4);

        $cond5 = array('invoice_id' => $invoice_number);
        $tbl5 = 'invoices_create';
        $invoices_create = $data['invoices_create'] = $this->HomeModel->get_all_by_cond($tbl5, $cond5);

        $invoice_type = $invoices_create[0]['invoice_type'];
        $data['invoice_balance_due'] = $invoices_create[0]['invoice_balance_due'];
        $data['invoice_amount'] = $invoices_create[0]['invoice_amount'];
        $data['invoice_tax'] = $invoices_create[0]['invoice_tax'];

        $cond6 = array('event_id' => $invoice_type, 'crews_hide !=' => 1);
        $tbl6 = 'event_crews';
        $data['event_crews'] = $this->HomeModel->get_all_by_cond($tbl6, $cond6);

        $cond7 = array('inv_id' => $invoice_number);
        $tbl7 = "customer_assigned_packages";
        $data['capackages'] = $this->HomeModel->get_all_by_cond($tbl7, $cond7);

        $cond8 = array('inv_id' => $invoice_number, 'invoice' => 1);
        $tbl8 = "customer_invoice_notes";
        $data['notes'] = $this->HomeModel->get_all_by_cond($tbl8, $cond8);

        $cond9 = array('cust_id' => $this->session->userdata('id'));
        $tbl9 = "customer_payment_history";
        $data['payment'] = $this->HomeModel->get_all_by_cond($tbl9, $cond9);

        $data['title'] = "Invoice";

        $cond10 = array('invoice_id' => $invoice_number);
        $tbl10 = "tbl_invoice_terms";
        $data['invoice_terms'] = $this->HomeModel->get_all_by_cond($tbl10, $cond10);

        $this->load->view('fi/customer/invoice', $data);
    }

    public function contract()
    {
        $company_admin = $this->session->fi_session['id'];
        $cus_id = $this->session->userdata('id');
        $invoice_number = $this->session->userdata('invoice_number');

        $data['invoice_number'] = $invoice_number;

        $cond1 = array('id' => $company_admin);
        $tbl1 = 'users';
        $data['users'] = $this->HomeModel->get_all_by_cond($tbl1, $cond1);

        $cond2 = array('cus_id' => $cus_id);
        $tbl2 = 'register_customer';
        $data['register_customer'] = $this->HomeModel->get_all_by_cond($tbl2, $cond2);

        $cond3 = array('cus_id' => $cus_id);
        $tbl3 = 'user_contact_info';
        $data['user_contact_info'] = $this->HomeModel->get_all_by_cond($tbl3, $cond3);

        $cond4 = array('cus_id' => $cus_id);
        $tbl4 = 'customer_additional_contacts';
        $data['cacontacts'] = $this->HomeModel->get_all_by_cond($tbl4, $cond4);

        $cond5 = array('invoice_id' => $invoice_number);
        $tbl5 = 'invoices_create';
        $invoices_create = $data['invoices_create'] = $this->HomeModel->get_all_by_cond($tbl5, $cond5);

        $invoice_type = $invoices_create[0]['invoice_type'];
        $data['invoice_balance_due'] = $invoices_create[0]['invoice_balance_due'];
        $data['invoice_amount'] = $invoices_create[0]['invoice_amount'];
        $data['invoice_tax'] = $invoices_create[0]['invoice_tax'];

        $cond6 = array('event_id' => $invoice_type, 'crews_hide !=' => 1);
        $tbl6 = 'event_crews';
        $data['event_crews'] = $this->HomeModel->get_all_by_cond($tbl6, $cond6);

        $cond7 = array('inv_id' => $invoice_number);
        $tbl7 = "customer_assigned_packages";
        $data['capackages'] = $this->HomeModel->get_all_by_cond($tbl7, $cond7);

        $cond8 = array('inv_id' => $invoice_number, 'contract' => 1);
        $tbl8 = "customer_invoice_notes";
        $data['notes'] = $this->HomeModel->get_all_by_cond($tbl8, $cond8);

        $cond9 = array('cust_id' => $this->session->userdata('id'));
        $tbl9 = "customer_payment_history";
        $data['payment'] = $this->HomeModel->get_all_by_cond($tbl9, $cond9);

        $data['title'] = "Contract";

        $cond10 = array('invoice_id' => $invoice_number);
        $tbl10 = "tbl_invoice_terms";
        $data['invoice_terms'] = $this->HomeModel->get_all_by_cond($tbl10, $cond10);

        $this->load->view('fi/customer/contract', $data);
    }




    public function myinvoice()
    {
        //$this->pdf->load_view('invoice');
        //$this->pdf->render();
        //$this->pdf->stream("welcome.pdf");
        //$this->load->library('pdf');
        // $invid = $this->uri->segment(3);

        $this->load->view('fi/customer/invoice');
        $html = $this->output->get_output();

        // Load HTML content
        $this->pdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A4');
        // $customPaper = array(0,0,800,1500);
        // $this->pdf->set_paper($customPaper);

        // Render the HTML as PDF
        $this->pdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream($invid . "estimate.pdf", array("Attachment" => 0));

        //$this->load->view('fi/customer/invoice');
    }




    public function removeitem()
    {
        $id = $this->input->post('id');

        $tbl = 'customers_package_items';
        $cond = array('id' => $id);

        $this->HomeModel->delete_data($tbl, $cond);
        echo 1;
    }

    public function customer_invoice_pickupinfo()
    {
        $invoice_number = $this->input->post('invoice_number');
?>
        <!--  Tab: pickup  -->
        <div role="tabpanel" class="tab-pane active" id="pickup">
            <div class="box box-default ">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box box-default firstblock_bg">
                                <div class="box-header with-border">
                                    <input type="hidden" name="invoice_terms" value="invoice_terms" class="form-control">
                                    <p class="uhead2">Pickup Info </p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover no-margin fixed_table">
                                        <thead>
                                            <tr>
                                                <th width="3%">#</th>
                                                <th class="w90">Item</th>
                                                <th width="31%">Description</th>
                                                <th width="5%">Quantity</th>
                                                <th>Picked up by</th>
                                                <th class="w90">Pickup Date</th>
                                                <th>Notes</th>
                                            </tr>
                                            <?php
                                            $invoice_number = $this->input->post('invoice_number');
                                            $pckupitemsql = $this->db->query("SELECT * FROM customers_pickup_items WHERE inv_id='" . $invoice_number . "' ORDER BY id ASC");
                                            $srno = 1;
                                            foreach ($pckupitemsql->result() as $pckupitemsql_dtls) { ?>
                                                <tr class="tr_clone">
                                                    <td><?= $srno ?>
                                                        <input type="hidden" name="hdnpreqpid" id="hdnpreqpid" class="form-control hdnpreqpid" value="<?= $pckupitemsql_dtls->pid ?>">
                                                        <input type="hidden" name="hdnpreqid" id="hdnpreqid" class="form-control hdnpreqid" value="<?= $pckupitemsql_dtls->id ?>">
                                                        <input type="hidden" name="invoiceid" id="invoiceid" class="form-control invoiceid" value="<?= $invoice_number ?>">
                                                    </td>
                                                    <td>
                                                        <select class="form-control 7" name="item_name<?= $itmId ?>" disabled>
                                                            <option value="">Select</option>
                                                            <?php
                                                            $admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");
                                                            foreach ($admitmsql->result() as $admitmsql_dtls) {
                                                                if ($admitmsql_dtls->item_id == $pckupitemsql_dtls->item_name) {
                                                                    $selectitmtyp = "selected";
                                                                } else {
                                                                    $selectitmtyp = "";
                                                                }
                                                            ?>
                                                                <option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>
                                                            <?php
                                                            } ?>
                                                            </script>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="pickup_desc" class="form-control" value="<?= $pckupitemsql_dtls->item_desc ?>" disabled>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" id="total_qty" name="total_qty" value="<?= $pckupitemsql_dtls->up_item_qty ?>">
                                                        <input type="hidden" id="total_prv_qty" name="total_prv_qty" value="<?= $pckupitemsql_dtls->item_quantity ?>">
                                                        <input type="number" min="1" name="pickup_quantity" id="pickup_quantity" class="form-control pickup_quantity" value="<?= $pckupitemsql_dtls->item_quantity ?>">
                                                    </td>
                                                    <td>

                                                        <input value="<?= $pckupitemsql_dtls->pickup_by ?>" list="browsers" name="pickupby" id="browser" class="form-control pickupby" onchange="fnupdatepickpedinfo(this.value,'<?= $pckupitemsql_dtls->id ?>','pickup_by','<?= $pckupitemsql_dtls->inv_id ?>','<?= $pckupitemsql_dtls->pid ?>')">
                                                        <datalist id="browsers">


                                                            <?php
                                                            $invsql     = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $pckupitemsql_dtls->inv_id . "'");
                                                            $invsqlrow  = $invsql->row();
                                                            $qryeventid = $invsqlrow->invoice_type;

                                                            $invevntjobsql = $this->db->query("SELECT * FROM event_jobs_dtls WHERE event_id='" . $qryeventid . "'");
                                                            foreach ($invevntjobsql->result() as $invevntjobsql_dtls) {
                                                            ?>
                                                                <option value="<?= $invevntjobsql_dtls->jobs_fname ?>">
                                                                <?php
                                                            } ?>
                                                        </datalist>
                                                        <!--<select name="pickupby" class="form-control pickupby" onchange="fnupdatepickpedinfo(this.value,'<?= $pckupitemsql_dtls->id ?>','pickup_by','<?= $pckupitemsql_dtls->inv_id ?>','<?= $pckupitemsql_dtls->pid ?>')">
                                                    <option>Choose</option>
                                                    <?php
                                                    $invsql     = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $pckupitemsql_dtls->inv_id . "'");
                                                    $invsqlrow  = $invsql->row();
                                                    $qryeventid = $invsqlrow->invoice_type;

                                                    $invevntjobsql = $this->db->query("SELECT * FROM event_jobs_dtls WHERE event_id='" . $qryeventid . "'");
                                                    foreach ($invevntjobsql->result() as $invevntjobsql_dtls) {
                                                        if ($pckupitemsql_dtls->pickup_by == $invevntjobsql_dtls->id) {
                                                            $pckbysel = "selected";
                                                        } else {
                                                            $pckbysel = "";
                                                        }
                                                    ?>
                                                        <option <?= $pckbysel ?>  value="<?= $invevntjobsql_dtls->id ?>"><?= $invevntjobsql_dtls->jobs_fname ?></option>
                                                    <?php } ?>
                                                </select> -->
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $adt1 = date("m/d/Y", strtotime($pckupitemsql_dtls->pickup_date));
                                                        ?>
                                                        <input type="text" name="pickupdate" id="pickupdate" class="form-control pickupdate w80" value="<?php echo ($adt1 != "01/01/1970") ? $adt1 : ""; ?>" placeholder="mm/dd/yyyy" onblur="fnupdatepickpedinfo(this.value,'<?= $pckupitemsql_dtls->id ?>','pickup_date','<?= $pckupitemsql_dtls->inv_id ?>','<?= $pckupitemsql_dtls->pid ?>')">
                                                        <input type="hidden" name="pickupinvid" id="pickupinvid" class="form-control pickupinvid" value="<?= $pckupitemsql_dtls->inv_id ?>">
                                                        <input type="hidden" name="pickupdid" id="pickupdid" class="form-control pickupdid" value="<?= $pckupitemsql_dtls->id ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="pickupnote" class="form-control pickupnote" value="<?= $pckupitemsql_dtls->notes ?>" onchange="fnupdatepickpedinfo(this.value,'<?= $pckupitemsql_dtls->id ?>','notes','<?= $pckupitemsql_dtls->inv_id ?>','<?= $pckupitemsql_dtls->pid ?>')">
                                                    </td>
                                                </tr>
                                            <?php $srno++;
                                            } ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box box-default secondblock_bg">
                                <div class="box-header with-border">
                                    <input type="hidden" name="invoice_terms" value="invoice_terms" class="form-control">
                                    <p class="uhead2">Pickup Required</p>
                                </div>
                                <input type="hidden" name="invoice_pickup_required" value="invoice_pickup_required" class="form-control">
                                <div class="table-responsive">
                                    <table class="table table-hover no-margin">
                                        <thead>
                                            <tr>
                                                <th width="4%">#</th>
                                                <th width="40%">Item</th>
                                                <th>Quantity</th>
                                                <th>Pickup</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                            <?php

                                            //" SELECT `i`.`pickupreq`, `i`.`assigned_pckid`, `i`.`id`, `i`.`item_name`, `i`.`item_quantity`, `i`.`item_price`, `i`.`item_desc`, `p`.`package_price` FROM `customers_package_items` AS `i`, customer_assigned_packages AS p WHERE i.package_id=p.package_id AND p.inv_id='".$_POST['invoiceid']."' AND i.inv_id='".$_POST['invoiceid']."' ORDER BY id ASC"

                                            $query = "SELECT
                                    `pickupreq`,
                                    `assigned_pckid`,
                                    `id`,
                                    `item_name`,
                                    `item_quantity`,
                                    `item_price`,
                                    `item_desc`
                                FROM
                                    `customers_package_items`
                                WHERE
                                    inv_id = '" . $invoice_number . "' and pickup != '1'";
                                            $itemsql = $this->db->query($query);
                                            // print_r($this->db->last_query());
                                            $srno = 1;
                                            foreach ($itemsql->result() as $pckitmsql_dtls) {
                                                $itmId = $pckitmsql_dtls->id;
                                                if ($getitemrow->id == $itmId) {
                                                    $lstinvoiceid = "fa-plus";
                                                    $lstinvoicecls = "btn-success";
                                                    $fninvoce = "fncrpitem('" . $pckitmsql_dtls->id . "')";
                                                } else {
                                                    $lstinvoiceid = "fa-minus";
                                                    $lstinvoicecls = "btn-danger";
                                                    $fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "')";
                                                }

                                                $pickupchk = $pckitmsql_dtls->pickupreq;
                                                //echo "pickupchk--".$pickupchk;

                                                /* if($pickupchk==1)
                             {
                                $attrchkpck="checked";
                             }else{
                                 $attrchkpck="";
                             }*/

                                                // echo "attrchkpck--".$attrchkpck;
                                            ?>
                                        <tbody id="loadpickpeditems">
                                            <tr class="tr_clone">
                                                <td><?= $srno ?></td>
                                                <td>
                                                    <select class="form-control 8" name="item_name<?= $itmId ?>" disabled>
                                                        <option value="">Select</option>
                                                        <?php
                                                        $invoice_number = $this->input->post('invoice_number');

                                                        $admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

                                                        foreach ($admitmsql->result() as $admitmsql_dtls) {
                                                            if ($admitmsql_dtls->item_id == $pckitmsql_dtls->item_name) {

                                                                $selectitmtyp = "selected";
                                                            } else {

                                                                $selectitmtyp = "";
                                                            }

                                                        ?>
                                                            <option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>

                                                        <?php } ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="item_quantity<?= $itmId ?>" min="1" class="form-control" value="<?= $pckitmsql_dtls->item_quantity ?>" disabled>
                                                    <input type="hidden" name="hdnpreqid" id="hdnpreqid" class="form-control hdnpreqid" value="<?= $pckitmsql_dtls->id ?>">
                                                    <input type="hidden" name="invoiceid" id="invoiceid" class="form-control invoiceid" value="<?= $invoice_number ?>">
                                                </td>

                                                <td>
                                                    <!-- <input <?= $attrchkpck ?> type="checkbox" name="chkpickupreq" id="chkpickupreq" class="chkpickupreq"> -->

                                                    <a class="btn btn-info btn-xs chkpickupreq" name="chkpickupreq" id="chkpickupreq">Pickup</a>

                                                </td>

                                                <!--   <td>

                          <button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

                        </td> -->

                                            </tr>
                                        </tbody>

                                    <?php $srno++;
                                            } ?>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php
            }

            public function customer_invoice_notes()
            {
                $invoice_number = $this->input->post('invoice_number');

                ?>
        <!--  Tab: notes  -->
        <div role="tabpanel" class="tab-pane active" id="notes">
            <div class="box box-default firstblock_bg">
                <div class="box-header with-border">
                    <input type="hidden" name="invoice_note" value="invoice_note" class="form-control">
                    <p class="uhead2">NOTES</p>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin fixed_table">
                            <thead>
                                <tr>
                                    <!--  <th>#</th> -->
                                    <th class="w90">Date</th>
                                    <th width="5%">Time</th>
                                    <!--  <th>Type</th> -->
                                    <th width="50%">Note</th>
                                    <th class="w50">Invoice</th>
                                    <th class="w60">Contract</th>
                                    <th class="w80">Event Detail</th>
                                    <th class="w100">User</th>
                                    <th class="w50">Action</th>
                                </tr>
                            <tbody id="dispinvnotes">

                                <?php
                                $invoice_number = $this->input->post('invoice_number');
                                if (is_numeric($invoice_number) == 1) {

                                    $notesql = $this->db->query("SELECT * FROM customer_invoice_notes WHERE inv_id='" . $invoice_number . "' ORDER BY id ASC");
                                    $notenrows = $notesql->num_rows();
                                    //  echo "notenrows--".$notenrows;
                                    if ($notenrows > 0) {
                                        foreach ($notesql->result() as $notesql_dtls) {

                                            if ($notesql_dtls->invoice == "1") {
                                                $chkbxinv = "checked";
                                                $setvalchkbxinv = "0";
                                            } else {
                                                $chkbxinv = "";
                                                $setvalchkbxinv = "1";
                                            }

                                            if ($notesql_dtls->contract == "1") {
                                                $chkbxcntrct = "checked";
                                                $setvalchkbxcntrct = "0";
                                            } else {
                                                $chkbxcntrct = "";
                                                $setvalchkbxcntrct = "1";
                                            }


                                            if ($notesql_dtls->relese == "1") {
                                                $chkbxrlse = "checked";
                                                $setvalchkbxrlse = "0";
                                            } else {
                                                $chkbxrlse = "";
                                                $setvalchkbxrlse = "1";
                                            }
                                ?>

                                            <tr class="tr_clone">
                                                <input type="hidden" class="txthdninvId" name="txthdninvId" id="txthdninvId" value="<?= $notesql_dtls->inv_id ?>">
                                                <input type="hidden" class="txthdnoteId" name="txthdnoteId" id="txthdnoteId" value="<?= $notesql_dtls->id ?>">

                                                <td>
                                                    <?php echo $dt = date("m/d/Y", strtotime($notesql_dtls->date)); ?>
                                                    <!--<input type="text" name="note_date" id="notedate"  class="form-control notedate w80" value="<?php echo ($dt != "01/01/1970") ? $dt : ""; ?>" placeholder="mm/dd/yyyy" onblur="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','date','<?= $notesql_dtls->id ?>')">-->
                                                </td>

                                                <td><?= $notesql_dtls->time ?>
                                                    <!--
                        <input placeholder="HH:MM" 
                        type="text" 
                        name="note_time" 
                        class="form-control notetime cust_inv_note_tim<?= $notesql_dtls->id ?>" 
                        value="<?= $notesql_dtls->time ?>" onchange="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','time','<?= $notesql_dtls->id ?>')" tabindex="-1"> -->
                                                </td>

                                                <!-- <td>
                      <input 
                      placeholder="HH:MM" 
                      type="text" 
                      name="time[]" 
                      id="strt_time" 
                      class="form-control strt_time updwn my_Time_Location<?= $locations_info['location_id'] ?>" 
                      value="<?= $locations_info['location_time'] ?>" 
                      onblur="my_Time_Location(<?= $locations_info['location_id'] ?>)"> -->


                                                <!-- </td> -->

                                                <!--  <td><input type="text" name="note_type" class="form-control" value="<?= $notesql_dtls->type ?>" onchange="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','type','<?= $notesql_dtls->id ?>')"></td> -->

                                                <td>
                                                    <input type="text" name="note_notes" class="form-control" value="<?= $notesql_dtls->note ?>" onblur="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','note','<?= $notesql_dtls->id ?>')">
                                                </td>


                                                <td>
                                                    <input <?= $chkbxinv ?> type="checkbox" name="note_invchk" value="<?= $setvalchkbxinv ?>" onchange="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','invoice','<?= $notesql_dtls->id ?>')">
                                                </td>

                                                <td>
                                                    <input <?= $chkbxcntrct ?> type="checkbox" name="note_contrct" value="<?= $setvalchkbxcntrct ?>" onchange="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','contract','<?= $notesql_dtls->id ?>')">
                                                </td>

                                                <td>
                                                    <input <?= $chkbxrlse ?> type="checkbox" name="note_relse" value="<?= $setvalchkbxrlse ?>" onchange="fnupdatenote(this.value,'<?= $notesql_dtls->inv_id ?>','relese','<?= $notesql_dtls->id ?>')">
                                                </td>

                                                <td>
                                                    <?php
                                                    $admloguser = $this->db->query("SELECT * FROM users WHERE id='" . $notesql_dtls->user . "'");
                                                    $admloguserrow = $admloguser->row();

                                                    ?>
                                                    <input type="text" name="note_user" class="form-control" value="<?= $admloguserrow->name ?>" disabled>
                                                </td>

                                                <td>
                                                    <a class="btn btn-xs btn-danger" onclick="fndelinvnote('<?= $notesql_dtls->id ?>','<?= $notesql_dtls->inv_id ?>')"><i class="fa fa-minus"></i></a>
                                                </td>

                                            </tr>

                                    <? }
                                    }  ?>

                                    <script type="text/javascript">
                                        //onblur="cust_inv_note_tim(<?= $notesql_dtls->id ?>)"
                                        /*dynamic Start Time*/
                                        function cust_inv_note_tim(my) {
                                            var my_Time = $('.cust_inv_note_tim' + my).val();
                                            var my_Time_count = my_Time.toString().length;
                                            var arr = ["00", "00"];
                                            if (my_Time_count == 4) {
                                                if (my_Time > 0 && my_Time < 1300) {
                                                    arr = my_Time.match(/.{1,2}/g);
                                                    var res = arr[0] + ":" + arr[1] + " PM";
                                                    $('.cust_inv_note_tim' + my).val(res);
                                                } else {
                                                    var num = my_Time - 1200;
                                                    my_Time = num.toString();
                                                    var my_Time_count = my_Time.toString().length;
                                                    if (my_Time_count == 3) {
                                                        my_Time = '0'.concat(my_Time);
                                                    }
                                                    if (my_Time > 0 && my_Time < 1300) {
                                                        arr = my_Time.match(/.{1,2}/g);
                                                        var res = arr[0] + ":" + arr[1] + " PM";
                                                        $('.cust_inv_note_tim' + my).val(res);
                                                    } else {
                                                        alert("Time is not correct")
                                                    }
                                                }
                                            } else if (my_Time_count > 4) {

                                                // alert("Value should be 4 digit");
                                            } else if (my_Time_count > 0) {
                                                // alert("Value should be 4 digit");
                                            }
                                        }
                                    </script>

                                    <tr class="tr_clone">

                                        <!--  <td>1</td> -->
                                        <?php $invoice_number = $this->input->post('invoice_number'); ?>

                                        <input type="hidden" class="txthdninvId" name="txthdninvId" id="txthdninvId" value="<?= $invoice_number ?>">

                                        <td><input type="text" name="note_date" id="notedate" class="form-control notedate w80 dddd" placeholder="mm/dd/yyyy" onblur="fninsertnote(this.value,'<?= $invoice_number ?>','date')"></td>

                                        <td>
                                            <input onblur="cust_inv_note_tim_sta()" placeholder="HH:MM" type="text" name="note_time" class="form-control updwn cust_inv_note_tim_sta" onchange="fninsertnote(this.value,'<?= $invoice_number ?>','time')">

                                            <script type="text/javascript">
                                                /*dynamic Start Time*/
                                                function cust_inv_note_tim_sta() {
                                                    var my_Time = $('.cust_inv_note_tim_sta').val();
                                                    var my_Time_count = my_Time.toString().length;
                                                    var arr = ["00", "00"];
                                                    if (my_Time_count == 4) {
                                                        if (my_Time > 0 && my_Time < 1300) {
                                                            arr = my_Time.match(/.{1,2}/g);
                                                            var res = arr[0] + ":" + arr[1] + " PM";
                                                            $('.cust_inv_note_tim_sta').val(res);
                                                        } else {
                                                            var num = my_Time - 1200;
                                                            my_Time = num.toString();
                                                            var my_Time_count = my_Time.toString().length;
                                                            if (my_Time_count == 3) {
                                                                my_Time = '0'.concat(my_Time);
                                                            }
                                                            if (my_Time > 0 && my_Time < 1300) {
                                                                arr = my_Time.match(/.{1,2}/g);
                                                                var res = arr[0] + ":" + arr[1] + " PM";
                                                                $('.cust_inv_note_tim_sta').val(res);
                                                            } else {
                                                                alert("Time is not correct")
                                                            }
                                                        }
                                                    } else if (my_Time_count > 4) {

                                                        // alert("Value should be 4 digit");
                                                    } else if (my_Time_count > 0) {
                                                        // alert("Value should be 4 digit");
                                                    }
                                                }
                                            </script>
                                        </td>

                                        <!--      <td><input type="text" name="note_type" class="form-control updwn" onchange="fninsertnote(this.value,'<?= $_POST['invoiceid'] ?>','type')"></td> -->
                                        <?php $invoice_number = $this->input->post('invoice_number'); ?>

                                        <td>
                                            <input type="text" name="note_notes" class="form-control updwn" onchange="fninsertnote(this.value,'<?= $invoice_number ?>','note')">
                                        </td>

                                        <td><input type="checkbox" name="note_invchk" value="1" onchange="fninsertnote(this.value,'<?= $invoice_number ?>','invoice')"></td>

                                        <td><input type="checkbox" name="note_contrct" value="1" onchange="fninsertnote(this.value,'<?= $invoice_number ?>','contract')"></td>

                                        <td><input type="checkbox" name="note_relse" value="1" onchange="fninsertnote(this.value,'<?= $invoice_number ?>','relese')"></td>

                                        <td><input type="text" name="note_user" class="form-control updwn" disabled></td>

                                        <td>
                                            <!-- <button class="btn btn-xs btn-success tr_clone_add inv"><i class="fa fa-plus"></i></button> -->
                                        </td>
                                    </tr>

                                <?php } else {

                                ?>
                                    <tr>
                                        <td colspan="8">Select invoice</td>
                                    </tr>
                                <?php
                                } ?>

                            </tbody>

                            </thead>

                        </table>

                    </div>



                </div>



            </div>

        </div> <?php

            }

            public function customer_invoice_associatedorder()
            {
                $invoice_number = $this->input->post('invoice_number');
                ?>
        <div role="tabpanel" class="tab-pane active" id="associated">
            <div class="box box-default firstblock_bg">
                <div class="box-header with-border">
                    <input type="hidden" name="invoice_associated_order" value="invoice_associated_order" class="form-control">
                    <p class="uhead2">ASSOCIATED ORDER </p>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin fixed_table">
                            <thead>
                                <tr>
                                    <th class="w110">Invoice</th>
                                    <th class="w210">Name</th>
                                    <th class="w80">Date Entered</th>
                                    <th class="w80">Due Date</th>
                                    <th class="w210"><span class="inblock w90">Cont. type</span></th>
                                    <th class="w70">Discount</th>
                                    <th class="w70">Sub Total</th>
                                    <th class="w70">Tax </th>
                                    <th class="w70">Amount </th>
                                    <th class="w70">Paid </th>
                                    <th class="w70"><span class="inblock w90">Bal. Due </span></th>
                                    <th class="w70" width="10%">Tax Rate </th>
                                    <th class="w100">County </th>
                                    <th class="w100">User </th>
                                </tr>
                                <?php
                                $query          = $this->db->query("SELECT * FROM events_register WHERE cus_id='$cusid'");
                                $qry_row        = $query->row();
                                $eventnm        = $qry_row->event_name;
                                $invoicesql     = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $invoice_number . "' ");
                                $invoice_nrows  = $invoicesql->num_rows();
                                $chkinvsql      = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $invoice_number . "' ");
                                $isinvoicerow   = $chkinvsql->row();
                                if ($invoice_nrows > 0) {
                                    foreach ($invoicesql->result() as $invoicesql_dtls) {

                                        $invoiceId      = $invoicesql_dtls->invoice_id;
                                        $invoicedt      = $invoicesql_dtls->invoice_date;
                                        $invoiceduedt   = $invoicesql_dtls->invoice_due_date;
                                        $invoicetype    = $invoicesql_dtls->invoice_type;
                                        $contracttype   = $invoicesql_dtls->invoice_contract_type;
                                        $invdescnt      = $invoicesql_dtls->invoice_discount;
                                        $invsubtot      = $invoicesql_dtls->invoice_sub_total;
                                        $invtax         = $invoicesql_dtls->invoice_tax;
                                        $invamount      = $invoicesql_dtls->invoice_amount;
                                        $invpaid        = $invoicesql_dtls->invoice_paid;
                                        $invbaldue      = $invoicesql_dtls->invoice_balance_due;
                                        $invtaxrate     = $invoicesql_dtls->invoice_tax_rate;
                                        $invcntry       = $invoicesql_dtls->invoice_county;
                                        $invuser        = $invoicesql_dtls->invoice_user;
                                        $invcustId      = $invoicesql_dtls->cust_id;

                                        if ($invoicedt != "") {
                                            $invdate = $invoicedt;
                                        } else {
                                            $invdate = date('Y-m-d');
                                        }


                                        if ($invoiceduedt != "") {

                                            $invduedate = $invoiceduedt;
                                        } else {

                                            $invduedate = "";
                                        }

                                        if ($invdescnt != "") {
                                            $setinvdescnt = $invdescnt;
                                        } else {

                                            $setinvdescnt = "";
                                        }

                                        if ($invsubtot != "") {
                                            $setinvsubtot = $invsubtot;
                                        } else {

                                            $setinvsubtot = "";
                                        }

                                        if ($invsubtot != "") {
                                            $setinvsubtot = $invsubtot;
                                        } else {

                                            $setinvsubtot = "";
                                        }


                                        if ($invtax != "") {
                                            $setinvtax = $invtax;
                                        } else {

                                            $setinvtax = ""; //8.8%
                                        }

                                        if ($invamount != "") {
                                            $setinvamount = $invamount;
                                        } else {

                                            $setinvamount = "";
                                        }


                                        if ($invpaid != "") {
                                            $setinvpaid = $invpaid;
                                        } else {

                                            $setinvpaid = "";
                                        }


                                        if ($invbaldue != "") {
                                            $setinvbaldue = $invbaldue;
                                        } else {

                                            $setinvbaldue = "";
                                        }

                                        if ($invtaxrate != "") {
                                            $setinvtaxrate = $invtaxrate;
                                        } else {

                                            $setinvtaxrate = "";
                                        }


                                        if ($invcntry != "") {
                                            $setinvcntry = $invcntry;
                                        } else {

                                            $setinvcntry = "";
                                        }


                                        if ($invuser != "") {
                                            $setinvuser = $invuser;
                                        } else {

                                            $setinvuser = "";
                                        }



                                        if ($isinvoicerow->invoice_id == $invoiceId) {
                                            $lstinvoiceid = "fa-plus";
                                            $lstinvoicecls = "btn-success";
                                            $fninvoce = "fncrinvoice('" . $invoiceId . "')";
                                            $lstrcd = "lstrecd";
                                        } else {

                                            $lstinvoiceid = "fa-minus";
                                            $lstinvoicecls = "btn-danger";
                                            $fninvoce = "fndelinvoice('" . $invoiceId . "')";
                                            $lstrcd = "";
                                        }



                                ?>

                                        <tr class="tr_clone">
                                            <td id="<?= $lstrcd ?>"><?= $invoicesql_dtls->invoice_id ?></td>
                                            <td>
                                                <input type="text" name="inname<?= $invoiceId ?>" id="inname<?= $invoiceId ?>" class="form-control" value="<?= $eventnm ?>">
                                            </td>
                                            <td>
                                                <?php $dt = date("m/d/Y", strtotime($invdate)); ?>
                                                <input type="text" name="invoice_date<?= $invoiceId ?>" id="invoice_date<?= $invoiceId ?>" class="form-control invdt_ar w80" placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>" onblur="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_date')">
                                            </td>
                                            <td>
                                                <?php $dt = date("m/d/Y", strtotime($invduedate)); ?>
                                                <input type="text" name="invoice_due_date<?= $invoiceId ?>" id="invoice_due_date<?= $invoiceId ?>" class="form-control invdt_ar1 w80" placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>" onblur="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_due_date')">
                                            </td>
                                            <td>
                                                <select class="form-control" name="invoice_contract_type<?= $invoiceId ?>" id="invoice_contract_type<?= $invoiceId ?>" style="min-width: 90px; width: 100%; " onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_contract_type')">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $evntypsql = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=35 ORDER BY sub_id ASC");
                                                    foreach ($evntypsql->result() as $evntypsql_dtls) {
                                                        if ($evntypsql_dtls->sub_id == $contracttype) {
                                                            $selectedevtyp = "selected";
                                                        } else {

                                                            $selectedevtyp = "";
                                                        }
                                                    ?>
                                                        <option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->sub_id ?>"><?= $evntypsql_dtls->sub_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_discount<?= $invoiceId ?>" id="invoice_discount<?= $invoiceId ?>" class="form-control updwn" style="width: 80px;" value="<?= $setinvdescnt ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_discount')">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_sub_total<?= $invoiceId ?>" id="invoice_sub_total<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvsubtot) ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_sub_total')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_tax<?= $invoiceId ?>" id="invoice_tax<?= $invoiceId ?>" class="form-control updwn" style="width: 60px;" value="<?= $setinvtax ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_tax')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_amount<?= $invoiceId ?>" id="invoice_amount<?= $invoiceId ?>" class="form-control" style=" " value="<?= sprintf('%0.2f', $setinvamount) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_paid<?= $invoiceId ?>" id="invoice_paid<?= $invoiceId ?>" class="form-control" style=" " value="<?= sprintf('%0.2f', $setinvpaid) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_balance_due<?= $invoiceId ?>" id="invoice_balance_due<?= $invoiceId ?>" class="form-control" style=" " value="<?= sprintf('%0.2f', $setinvbaldue) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>

                                            <td><input type="text" name="invoice_tax_rate<?= $invoiceId ?>" id="8 invoice_tax_rate<?= $invoiceId ?>" class="form-control updwn 2" value="<?= $setinvtaxrate ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_tax_rate')"></td>

                                            <td><input type="text" name="invoice_country<?= $invoiceId ?>" id="invoice_country<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvcntry ?>%" style=" " onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_county')"></td>
                                            <td><input type="text" name="invoice_user<?= $invoiceId ?>" id="invoice_user<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvuser ?>" style="width: 60px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_user')"></td>
                                        </tr>
                                <?php }
                                } ?>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div> <?php
            }

            public function customer_invoice_history()
            {
                $invoice_number = $this->input->post('invoice_number');
                $cus_id = $this->input->post('cus_id');

                ?>
        <!--  Tab: History  -->
        <div role="tabpanel" class="tab-pane active" id="history">
            <div class="box box-default firstblock_bg">
                <div class="box-header with-border">
                    <input type="hidden" name="invoice_associated_order" value="invoice_associated_order" class="form-control">
                    <p class="uhead2">History </p>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Check No</th>
                                    <th>Description</th>
                                    <th>Event</th>
                                    <th>Amount</th>
                                    <th>Paid</th>
                                    <th>Balance </th>
                                    <!--   <th>Action</th> -->
                                </tr>
                                <?php

                                $query = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $cus_id . "'");
                                $qry_row = $query->row();
                                $eventnm = $qry_row->event_name;

                                //error_reporting(0);

                                // $invoicesql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invoiceid']."' ");
                                //
                                // $invoice_nrows=$invoicesql->num_rows();
                                //
                                // $chkinvsql=$this->db->query("SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invoiceid']."' ");
                                // $isinvoicerow=$chkinvsql->row();

                                $historysql = $this->db->query("SELECT ip.invoice_id,ip.invoice_date,ip.invoice_amount,ip.invoice_paid,ip.invoice_balance_due,ip.applied_amt,ip.payment_type,ip.payment_no,ic.invoice_type,cph.pdesc ,cp.date FROM `invoices_payment_create` ip JOIN invoices_create ic ON ip.invoice_id=ic.invoice_id JOIN customer_payment_history cph on cph.id=ip.payment_id JOIN customer_payment_history cp on cp.id=ip.payment_id WHERE ip.invoice_id='" . $invoice_number . "' AND ip.status=1");

                                $historyinvoicerow = $historysql->result_array();
                                // echo "<pre>";print_r($historyinvoicerow);die;

                                if (count($historyinvoicerow) > 0) {
                                    $invoice_type = $historyinvoicerow[0]['invoice_type'];

                                    $evntnamesql = $this->db->query("SELECT er.event_type,rc.cus_lname,rc.cus_company_name FROM events_register er join register_customer rc on er.cus_id=rc.cus_id WHERE event_id='" . $invoice_type . "'");
                                    $historyevntnamesql = $evntnamesql->result_array();
                                    // print_r();die;

                                    $eventname = $historyevntnamesql[0]['event_type'] . "-" . $historyevntnamesql[0]['cus_lname'] . "-" . $historyevntnamesql[0]['cus_company_name'];

                                    // print_r($eventname);

                                    $i = 0;
                                    foreach ($historyinvoicerow as $invoicesql_dtls) {

                                        $invoiceId = $invoicesql_dtls['invoice_id'];
                                        $invoicedate = $invoicesql_dtls['date'];
                                        $invoiceamt = $invoicesql_dtls['invoice_amount'];
                                        $invoiceamtpaid = $invoicesql_dtls['invoice_paid'];
                                        $invoiceamtbalance = $invoicesql_dtls['invoice_balance_due'];
                                        $payment_no = $invoicesql_dtls['payment_no'];
                                        $payment_type = $invoicesql_dtls['payment_type'];
                                        $invoice_type = $invoicesql_dtls['invoice_type'];
                                        $applied_amt = $invoicesql_dtls['applied_amt'];
                                        $pdesc = $invoicesql_dtls['pdesc'];
                                ?>
                                        <tr class="tr_clone">
                                            <td><?= $invoiceId ?></td>
                                            <td>
                                                <input type="date" name="inname<?= $invoiceId ?>" id="inname<?= $invoiceId ?>" class="form-control" value="<?= $invoicedate ?>" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="invoice_date<?= $invoiceId ?>" id="invoice_date<?= $invoiceId ?>" class="form-control w95" value="<?= $payment_type ?>" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="invoice_due_date<?= $invoiceId ?>" id="invoice_due_date<?= $invoiceId ?>" class="form-control w95" value="<?= $payment_no ?>" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="invoice_due_date<?= $invoiceId ?>" id="invoice_due_date<?= $invoiceId ?>" class="form-control w95" value="<?= $pdesc ?>" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="invoice_appliedamt<?= $invoiceId ?>" id="invoice_appliedamt<?= $invoiceId ?>" class="form-control w95" value="<?= $eventname ?>" disabled>
                                            </td>

                                            <td>

                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_amount" class="form-control invoicamount 3" style="width: 80px;" value="<?= sprintf('%0.2f', $invoiceamt) ?>" disabled>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_amount" class="form-control invoicamount 4" style="width: 80px;" value="<?= sprintf('%0.2f', $applied_amt) ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- <input type="text" name="invoice_paidamt<?= $invoiceId ?>" id="invoice_paidamt<?= $invoiceId ?>" class="form-control w95" value="<?= $invoiceamtpaid ?>" disabled> -->
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                        <input type="text" name="invoice_amount" class="form-control invoicamount 1" style="width: 80px;" value="<?= sprintf('%0.2f', $invoiceamtbalance) ?>" disabled>
                                                    </div>
                                                </div>
                                                <!-- <input type="text" name="invoice_paidamt<?= $invoiceId ?>" id="invoice_paidamt<?= $invoiceId ?>" class="form-control w95" value="<?= $invoiceamtbalance ?>" disabled> -->
                                            </td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } ?>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div> <?php
            }

            public function customer_invoice_termstasks()
            {
                $invoice_number = $this->input->post('invoice_number');

                /* start Tearms & Tasks */
                $tasksql = $this->db->query("SELECT * FROM invoice_task WHERE invoice_id ='" . $invoice_number . "'");
                $tasksqlnrows = $tasksql->num_rows();
                if ($tasksqlnrows > 0) {
                    $gettaskrow     = $tasksql->row();
                    $taskstartdt    = $gettaskrow->task_date_started;
                    $tasksduedt     = $gettaskrow->task_due_date;
                    $taskscompletchk = $gettaskrow->task_completed;
                    $taskscompletby = $gettaskrow->task_completed_by;
                    $taskscompletdt = $gettaskrow->task_completed_date;
                    $tasksnote      = $gettaskrow->task_note;
                    $tasksenterdby  = $gettaskrow->task_entered_by;
                } else {
                    $taskstartdt    = "";
                    $tasksduedt     = "";
                    $taskscompletchk = "";
                    $taskscompletdt = "";
                    $taskscompletby = "";
                    $tasksnote      = "";
                    $tasksenterdby  = "";
                }
                ?>
        <div role="tabpanel" class="tab-pane active" id="terms">
            <div class="box box-default firstblock_bg">
                <div class="box-header with-border">
                    <input type="hidden" name="invoice_terms" value="invoice_terms" class="form-control">
                    <p class="uhead2">Terms</p>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-hover no-margin">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Total Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dispterms">
                                        <?php
                                        $event_detail       = $this->db->query("SELECT event_date FROM events_register WHERE inv_id='" . $invoice_number . "'")->row_array();
                                        $terminvsql         = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $invoice_number . "'");
                                        $terminvsql_row     = $terminvsql->row();
                                        $trminvsubtot       = $terminvsql_row->invoice_amount;
                                        $terminvstotal_sql  = $this->db->query("SELECT SUM(amount) AS amount FROM tbl_invoice_terms WHERE invoice_id='" . $invoice_number . "' AND name!='Date' AND name!='Event Date'");
                                        $terminvstotalsql_row = $terminvstotal_sql->row();
                                        $trminvtotamount    = $terminvstotalsql_row->amount;

                                        if ($trminvsubtot > $trminvtotamount) {
                                            $trmsum = $trminvsubtot - $trminvtotamount;
                                        } else {
                                            $trmsum = "0";
                                        }

                                        $invotermsql    = $this->db->query("SELECT * FROM tbl_invoice_terms WHERE invoice_id='" . $invoice_number . "' ORDER BY id ASC");
                                        $chkinvtrmsql   = $this->db->query("SELECT * FROM tbl_invoice_terms WHERE invoice_id='" . $invoice_number . "' ORDER BY id DESC LIMIT 1");
                                        $isinvtermsrow  = $chkinvtrmsql->row();

                                        foreach ($invotermsql->result() as $invotermsql_dtls) {
                                            $invtrmsId = $invotermsql_dtls->id;
                                            if ($isinvtermsrow->id == $invtrmsId) {
                                                $lstinvtrmid = "fa-plus";
                                                $lstinvtrmcls = "btn-success";
                                                $fninvterms = "fncrterms('" . $invtrmsId . "','" . $invoice_number . "')";
                                            } else {
                                                $lstinvtrmid = "fa-minus";
                                                $lstinvtrmcls = "btn-danger";
                                                $fninvterms = "fndelterms('" . $invtrmsId . "','" . $invoice_number . "')";
                                            }

                                            if ($invotermsql_dtls->totsts == 1) {
                                                if ($isinvtermsrow->id == $invtrmsId) {
                                                    $setamount = $trmsum;
                                                    $disp = "display:block; width";
                                                    $rdonly = "disabled";
                                                } else {
                                                    $setamount = $trmsum;
                                                    $disp = "display:none;";
                                                    $rdonly = "disabled";
                                                }
                                            } else {
                                                $setamount = $invotermsql_dtls->amount;
                                                $disp = "display:block;";
                                                $rdonly = "";
                                            }
                                        ?>
                                            <tr class="tr_clone">
                                                <td>
                                                    <input class="crntrmsid" type="hidden" name="crntrmsid" id="crntrmsid" value="<?= $invtrmsId ?>">
                                                    <input class="trmsubtot" type="hidden" name="trmsubtot" id="trmsubtot" value="<?= $trminvsubtot ?>">
                                                    <input class="trminvid" type="hidden" name="trminvid" id="trminvid" value="<?= $invoice_number ?>">
                                                    <input class="trmtypeid" type="hidden" name="trmtypeid" id="trmtypeid" value="<?= $terminvsql_row->invoice_contract_type ?>">
                                                    <select class="form-control txttermstype 4" id="txttermstype" name="txttermstype">
                                                        <option> </option>
                                                        <?php
                                                        $admtermssql = $this->db->query("SELECT * FROM adm_terms WHERE subcat_id='" . $invotermsql_dtls->subcat_id . "' ORDER BY id ASC");
                                                        foreach ($admtermssql->result() as $admtermssql_dtls) {
                                                            if ($admtermssql_dtls->name == $invotermsql_dtls->name) {
                                                                $selectitmtyp = "selected";
                                                            } else {
                                                                $selectitmtyp = "";
                                                            }
                                                        ?>
                                                            <option <?= $selectitmtyp ?> value="<?= $admtermssql_dtls->subcat_id ?>"><?= $admtermssql_dtls->name ?></option>
                                                        <?php
                                                        } ?>
                                                    </select>
                                                </td>
                                                <?php
                                                if ($invotermsql_dtls->name == "Event Date") { ?>
                                                    <td><?= date("m/d/Y", strtotime($invotermsql_dtls->dt)) ?></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>" disabled>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="margin-left: 17px;"><span class="glyphicon glyphicon-usd"></span></span>
                                                            <input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= sprintf('%0.2f', $trmsum) ?>" disabled>
                                                        </div>
                                                    </td>
                                                    <td style="min-width: 40px; width: 40px; text-align: center;">
                                                        <button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>
                                                    </td>
                                                <?php
                                                } else if ($invotermsql_dtls->name == "Date") {   ?>
                                                    <td><?= date("m/d/Y", strtotime($invotermsql_dtls->dt)) ?></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $setamount ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <?php
                                                            if ($event_detail['event_date'] != "" && $event_detail['event_date'] != "1970-01-01") {
                                                                if ($setamount != "") {
                                                                    $aks = date('m/d/Y', strtotime($event_detail['event_date'] . ' ' . $setamount . ' days'));
                                                                } else {
                                                                    $aks = date("m/d/Y", strtotime($event_detail['event_date']));
                                                                }
                                                            } else {
                                                                $aks = "";
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $aks; ?>" disabled>
                                                        </div>
                                                    </td>
                                                    <td style="min-width: 40px; width: 40px;">
                                                        <button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>
                                                    </td>
                                                <?php
                                                } else if ($invotermsql_dtls->name == "Installment Date Amount") {
                                                    $dt = "";
                                                    if ($invotermsql_dtls->dt != "0000-00-00" && $invotermsql_dtls->dt != "1970-01-01") {
                                                        $dt = date("m/d/Y", strtotime($invotermsql_dtls->dt));
                                                    }

                                                ?>
                                                    <td><input type="text" class="form-control aksdt d<?php echo $invotermsql_dtls->id; ?>" placeholder="mm/dd/yyyy" value="<?php echo $dt; ?>" onblur="update_field('tbl_invoice_terms','dt',this.value,'id',<?php echo $invotermsql_dtls->id; ?>,'date')" /></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="margin-left: 17px;"><span class="glyphicon glyphicon-usd"></span></span>
                                                            <input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= sprintf('%0.2f', $invotermsql_dtls->amount) ?>">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="margin-left: 17px;"><span class="glyphicon glyphicon-usd"></span></span>
                                                            <input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= sprintf('%0.2f', $setamount) ?>" disabled>
                                                        </div>
                                                    </td>

                                                    <td style="min-width: 40px; width: 40px;">

                                                        <button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

                                                    </td>
                                                <?php
                                                } else { ?>
                                                    <td></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="margin-left: 17px;"><span class="glyphicon glyphicon-usd"></span></span>
                                                            <input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= sprintf('%0.2f', $invotermsql_dtls->amount) ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="margin-left: 17px;"><span class="glyphicon glyphicon-usd"></span></span>
                                                            <input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= sprintf('%0.2f', $setamount) ?>" disabled>
                                                        </div>
                                                    </td>
                                                    <td style="min-width: 40px; width: 40px;">
                                                        <button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-default firstblock_bg">
                <div class="box-header with-border">
                    <input type="hidden" name="invoice_terms" value="invoice_terms" class="form-control">
                    <p class="uhead2">Tasks</p>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover no-margin fixed_table">
                        <thead>
                            <tr>
                                <th>Date Started</th>
                                <th>Task</th>
                                <th>Sub Task</th>
                                <th>User</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Completed By</th>
                                <th>Completed Date</th>
                                <th>Note</th>
                                <th>Entered By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="mytasks"></tbody>
                        <tbody>
                            <?php
                            if (is_numeric($invoice_number) == 1) {

                            ?>

                                <tr class="tr_clone">
                                    <td>
                                        <input placeholder="mm/dd/yyyy" type="text" name="task_strtdate" id="task_strtdate" class="form-control lsttaskstrtdate text-center" value="<?= date('m/d/Y') ?>">
                                        <input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?= $invoice_number ?>">
                                    </td>

                                    <td>
                                        <select class="form-control lsttaskname" name="lsttaskname" id="lsttaskname">
                                            <option>Choose</option>
                                            <?php
                                            $invtasktype = $this->db->query("SELECT * FROM adm_task_type ORDER BY id ASC");
                                            foreach ($invtasktype->result() as $invtasktype_dtls) {
                                            ?>
                                                <option value="<?= $invtasktype_dtls->id ?>"><?= $invtasktype_dtls->name ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control lstsubtask" name="lstsubtask" id="lstsubtask">
                                            <option value=""> </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control task_user" name="task_user" id="task_user" style="width: 130px;">
                                            <option value="">Choose</option>
                                            <?php
                                            $cond = array('user' => $this->session->fi_session['id']);
                                            $tbl = "users";
                                            $users = $this->HomeModel->get_all_by_cond($tbl, $cond);

                                            foreach ($users as $row) {
                                                if ($row['id'] == $taskusr) {
                                                    $selusr = "selected";
                                                } else {
                                                    $selusr = "";
                                                }
                                            ?>
                                                <option <?= $selusr ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                            <?php
                                            } ?>
                                            <?php

                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input placeholder="mm/dd/yyyy" type="text" name="task_due_date" id="task_due_date" class="form-control taskduedatlast w95" value="">
                                    </td>
                                    <td>
                                        <select class="form-control taskcompleted" name="task_completed" id="task_completed">
                                            <option>Choose</option>
                                            <?php
                                            $invtasktype = $this->db->query("SELECT * FROM adm_task_status ORDER BY id ASC");
                                            foreach ($invtasktype->result() as $invtasktype_dtls) {
                                            ?>
                                                <option value="<?= $invtasktype_dtls->id ?>"><?= $invtasktype_dtls->name ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="" readonly>
                                    </td>
                                    <td>
                                        <input placeholder="mm/dd/yyyy" type="text" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate text-center" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value="">
                                    </td>
                                    <td>
                                        <?php
                                        $admloguser = $this->db->query("SELECT * FROM users");
                                        $loogedusername;
                                        foreach ($admloguser->result() as $admloguser_dtls) {
                                            if ($this->session->userdata['fi_session']['id'] == $admloguser_dtls->id) {
                                                $loogedusername = $admloguser_dtls->name;
                                            }
                                        }
                                        ?>
                                        <input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn text-center" value="<?= $loogedusername ?>" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                            <?php
                            } ?>
                            <tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
            }

            public function custmer_invoice_item()
            {
                $invoice_number = $this->input->post('invoice_number');
                $cond = array('invoice_id' => $invoice_number);
                $tbl = "invoices_create";
                $result_row = $this->HomeModel->get_all_by_cond($tbl, $cond);

                $getpckId = $result_row[0]['assigned_pckage'];

                if ($getpckId != "") {
                    $selpackage = $getpckId;
                } else {
                    $selpackage = "";
                }

                $sql = "SELECT `i`.`item_taxble`, `i`.`inv_id`, `i`.`assigned_pckid`, `i`.`id`, `i`.`item_name`, `i`.`item_quantity`, `i`.`item_price`, `i`.`item_desc`, `i`.`item_descount`, `p`.`package_price` FROM `customers_package_items` AS `i`, `customer_assigned_packages` AS `p` WHERE `i`.`package_id`=`p`.`package_id` 
            AND `p`.`inv_id`='" . $invoice_number . "' AND `i`.`inv_id`='" . $invoice_number . "' ORDER BY `id` ASC";
                $itemsql = $this->db->query($sql);

                $sql2 = "SELECT * FROM customers_package_items WHERE package_id='" . $selpackage . "' AND inv_id='" . $invoice_number . "' ORDER BY id DESC ";
                $lastitemsql = $this->db->query($sql2);

                $itemsqlnrows = $itemsql->num_rows();
                $getitemrow = $lastitemsql->row();
                $getitmrow = $itemsql->row();
                $itempckprice = $getitmrow->package_price;
    ?>

        <div role="tabpanel" class="tab-pane active 1" id="items">
            <div class="box box-default">
                <div class="box-header ">
                    <input type="hidden" name="invoice_item" value="invoice_item" class="form-control">
                    <p class="uhead2">Items</p>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="box box-info secondblock_bg">
                                <div class="table-responsive" id="loaditms">
                                    <form method="POST" action="<?= base_url('fi_home/CustomerInvoice') ?>" style="margin-bottom: auto;">
                                        <table class="table table-hover no-margin fixed_table w1000" style="width:99.90%; min-width:1000px;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%;"> <span style="display: inline-block;">Qty</span></th>
                                                    <th style="width: 7%;"> <span style=" display: inline-block;">Package *</span></th>
                                                    <th style="width: 8%;"> <span style=" display: inline-block;">Item</span></th>
                                                    <th style="width: 23%;"><span style=" display: inline-block;">Description</span></th>
                                                    <th style="width: 5%;"> <span style="display: inline-block;" class="hide_in_invoice">Disc.</span></th>
                                                    <th style="width: 8%;"> <span style="display: inline-block;" class="hide_in_invoice">Disc. Amt</span></th>
                                                    <th style="width: 5%;"> <span style="display: inline-block;">Total</span></th>
                                                    <th style="width: 5%;"> <span style="display: inline-block;" class="hide_in_invoice">Discd Amt</span></th>
                                                    <th style="width: 5%;"> <span style="display: inline-block;" class="hide_in_invoice"> Sub Total </span></th>
                                                    <th style="width: 4%;"> <span style="display: inline-block;" class="hide_in_invoice">Taxable</span></th>
                                                    <th style="width: 4%;"> <span style="display: inline-block;" class="hide_in_invoice">Action</span></th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $cond2 = array('inv_id' => $invoice_number);
                                            $tbl2 = "customer_assigned_packages";
                                            $common_pckg_result = $this->HomeModel->get_all_by_cond($tbl2, $cond2);

                                            /*  $commonpckgsql = $this->db->query("SELECT * FROM customer_assigned_packages WHERE inv_id='".$invoice_number."' ORDER BY id ASC"); */
                                            $srno = 1;
                                            $no_focus = "focus3";

                                            foreach ($common_pckg_result as $pckitmsql_dtls) {
                                                $commonpckgsql_desc = $this->db->query("SELECT package_desc FROM admin_package WHERE package_id='" . $pckitmsql_dtls['package_id'] . "'")->row_array();

                                                $itmId = $pckitmsql_dtls['id'];

                                                if ($getitemrow->id == $itmId) {
                                                    $lstinvoiceid = "fa-plus";
                                                    $lstinvoicecls = "btn-success";
                                                    $fninvoce = "fncrpitem('" . $pckitmsql_dtls['id'] . "')";
                                                } else {
                                                    $lstinvoiceid = "fa-minus";
                                                    $lstinvoicecls = "btn-danger";
                                                    $fninvoce = "fndelpitem('" . $pckitmsql_dtls['id'] . "')";
                                                } ?>

                                                <tbody id="pckitems" class="pckitems">
                                                    <tr class="tr_clone auto-index package_line" style="background: #e2e2e2;">
                                                        <td style="width:4%;">
                                                            <span style="display: inline-block;">
                                                                <input style="width: 100%; text-align: center;" type="text" onblur="savedata(<?= $pckitmsql_dtls['id'] ?>);" name="quantity<?= $itmId ?>" value="<?= $pckitmsql_dtls['quantity'] ?>" ?>
                                                            </span>
                                                        </td>

                                                        <td class="" style="width:7%;">
                                                            <span class="inline_block" style=""><input class="form-control w110" type="text" value=""></span>

                                                        </td>

                                                        <td style="width:8%;"><span class=" dblock"><?= $pckitmsql_dtls['package_name'] ?></span> </td>

                                                        <td style="width:23%;"> <span class=" dblock"><?= $commonpckgsql_desc['package_desc']  ?></span></td>


                                                        <td style="width:4.95%;" class="">
                                                            <div class="form-group " style="width: 100%; display: block;">
                                                                <div class="input-group" style="width: 100%; ">
                                                                    <span class="input-group-addon " style="width: 100%; ">
                                                                        <!-- onblur="savedata(<?= $pckitmsql_dtls['id'] ?>);" -->

                                                                        <select name="pck_discount<?= $pckitmsql_dtls['id'] ?>" id="pck_discount<?= $pckitmsql_dtls['id'] ?>" class="form-control" style="width: 100%; min-width: 55px; margin-top: -4px;">
                                                                            <option value="">Choose </option>
                                                                            <option <?php if ($pckitmsql_dtls['pck_discnt_typ'] == '1') {
                                                                                        echo "selected";
                                                                                    } ?> value="1">$</option>
                                                                            <option <?php if ($pckitmsql_dtls['pck_discnt_typ'] == '2') {
                                                                                        echo "selected";
                                                                                    } ?> value="2">%</option>
                                                                        </select>
                                                                    </span>
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

                                                                    <?php
                                                                    if ($pckitmsql_dtls['pck_discnt_amt'] == 0) {
                                                                        $pckitmsql_dtls['pck_discnt_amt'] = "0.00";
                                                                    }
                                                                    ?>
                                                                    <input type="text" name="pck_discnt_amt<?= $pckitmsql_dtls['id'] ?>" class="form-control" style="text-align: right;" onchange="savedata(<?= $pckitmsql_dtls['id'] ?>);" value="<?= $pckitmsql_dtls['pck_discnt_amt'] ?>">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td style="width:5%;">
                                                            <!-- package_price -->
                                                            <div class="form-group " style="text-align: -webkit-right;">
                                                                <div class="input-group"><span>$<?= sprintf('%0.2f', $pckitmsql_dtls['total_price']) ?></span>
                                                                    <!-- <span class="input-group-addon">
                                                            			<span class="glyphicon glyphicon-usd" style="margin-top:2px; margin-right:-14px"></span></span> -->
                                                                    <input type="hidden" disabled name="" id="" class="form-control" style="width: 90px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls['total_price']) ?>">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td style="width:5%;" class="">
                                                            <div class="form-group " style="text-align: -webkit-right;">
                                                                <div class="input-group"><span>$<?= sprintf('%0.2f', $pckitmsql_dtls['pck_discounted_amt']) ?></span>
                                                                    <!--  <span class="input-group-addon">
                                                                      <span class="glyphicon glyphicon-usd" style="margin-top:2px; margin-right:-14px"></span> 
                                                                    </span> -->
                                                                    <input type="hidden" name="" id="" class="form-control" style="width: 90px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls['pck_discounted_amt']) ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td style="width:5%;" class="hide_in_invoice">
                                                            <div class="form-group " style="text-align: -webkit-right;">
                                                                <div class="input-group"><span>$<?= sprintf('%0.2f', $pckitmsql_dtls['sub_total']) ?></span>
                                                                    <!--   <span class="input-group-addon">
                                                                      <span class="glyphicon glyphicon-usd" style="margin-top:2px; margin-right:-14px"></span>
                                                                    </span> -->
                                                                    <input type="hidden" name="pck_sub_amt<?= $pckitmsql_dtls['id'] ?>" id="pck_sub_amt<?= $pckitmsql_dtls['id'] ?>" class="form-control" style="width: 90px;" value="<?= sprintf('%0.2f', ($pckitmsql_dtls['sub_total'])) ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="width:4%;"><span class=" dblock"></span></td>
                                                        <td style="width:4%;">
                                                            <span style=" display: inline-block;">

                                                                <button type="submit" style="display:none" value="<?= $pckitmsql_dtls['id'] ?>" name="button_6" class="btn btn-xs btn-success button_6<?= $pckitmsql_dtls['id'] ?>">
                                                                    <i class="fa fa-save"></i></button>

                                                                <input type="hidden" name="" id="" value="<?= sprintf('%0.2f', $pckitmsql_dtls['package_price']) ?>">
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <!--  pacjage level end    ------------------------------------------------------------------------ -->
                                                    <tr>
                                                        <td colspan="11">
                                                            <div class="ibox-content" style="padding: 0;">
                                                                <!-- style="display: none;"  -->
                                                                <table class="table table-hover no-margin fixed_table w1000">
                                                                    <?php
                                                                    $commonpckitemsgsql = $this->db->query("SELECT * FROM customers_package_items WHERE inv_id='" . $invoice_number . "' AND package_id='" . $pckitmsql_dtls['package_id'] . "' AND assigned_pckid='" . $pckitmsql_dtls['id'] . "' ORDER BY id ASC");
                                                                    $rno = 1;
                                                                    foreach ($commonpckitemsgsql->result() as $pckitmsql_dtls1) {

                                                                        $itmId = $pckitmsql_dtls1->id;
                                                                        if ($getitemrow->id == $itmId) {

                                                                            $lstinvoiceid = "fa-plus";
                                                                            $lstinvoicecls = "btn-success";
                                                                            $fninvoce = "fncrpitem('" . $pckitmsql_dtls1->id . "')";
                                                                        } else {

                                                                            $lstinvoiceid = "fa-minus";
                                                                            $lstinvoicecls = "btn-danger";
                                                                            $fninvoce = "fndelpitem('" . $pckitmsql_dtls1->id . "')";
                                                                        }

                                                                        $pckgsql = $this->db->query("SELECT * FROM customer_assigned_packages WHERE id='" . $pckitmsql_dtls1->assigned_pckid . "' ORDER BY id ASC");
                                                                        $pckgsql_row = $pckgsql->row();
                                                                    ?>

                                                                        <!-- Start Pckages loop -->
                                                                        <tbody id="pcksubitems" class="">
                                                                            <tr class="tr_clone auto-index pck_items delete_item<?= $itmId ?>">
                                                                                <td style="width:4.01%;">
                                                                                    <input style="background: #e2e2e2; text-align: center;" type="text" name="" id="" onblur="change_qty1(<?= $itmId ?>, this.value)" class="form-control pck_itemwoutqty" value="<?= $pckitmsql_dtls1->item_quantity ?>">
                                                                                </td>

                                                                                <td class="hide_in_invoice" style="width:7%;">
                                                                                    <span class=" dblock">*</span>
                                                                                </td>

                                                                                <td style="width:8%;">
                                                                                    <select class="form-control 1" name="item_name<?= $itmId ?>" id="i2<?= $itmId ?>" style=" " onchange="fnadmpckinfo(this.value,'<?= $itmId ?>')">
                                                                                        <!--  <?php print_r($pckitmsql_dtls1->item_name); ?> -->
                                                                                        <option value="">Choose</option>

                                                                                        <?php


                                                                                        $admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");
                                                                                        foreach ($admitmsql->result() as $admitmsql_dtls) {

                                                                                            if ($admitmsql_dtls->item_id == $pckitmsql_dtls1->item_name) {
                                                                                                $selectitmtyp = "selected";
                                                                                            } else {
                                                                                                $selectitmtyp = "";
                                                                                            }
                                                                                        ?>
                                                                                            <option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>
                                                                                        <?php } ?>
                                                                                </td>

                                                                                <td style="width:23%;">
                                                                                    <input type="text" onchange="fnupdateitemdescp(this.value,'<?= $itmId ?>')" name="item_desc<?= $itmId ?>" id="i3<?= $itmId ?>" class="form-control updwn 1" value="<?= $pckitmsql_dtls1->item_desc ?>" style=" ">
                                                                                </td>

                                                                                <td style="width:5%;">
                                                                                    <input type="hidden" class="pck_hdninvoicrcId" name="" id="" value="<?= $invoice_number ?>">
                                                                                    <input type="hidden" class="pck_hdnitemrowId" name="" id="" value="<?= $pckitmsql_dtls1->id ?>">
                                                                                    <input type="hidden" class="custid" name="" id="" value="<?= $pckitmsql_dtls1->id ?>">
                                                                                </td>

                                                                                <td style="width:8%;">
                                                                                    <div class="form-group ">
                                                                                        <div class="input-group">
                                                                                            <?php
                                                                                            if ($pckitmsql_dtls1->item_discnt_amt == 0) {
                                                                                                $pckitmsql_dtls1->item_discnt_amt = "";
                                                                                            }
                                                                                            ?>
                                                                                            <input type="text" name="" id="" class="form-control pck_item_discnt_amt" style="text-align:right; width: 90px;" value="<?= $pckitmsql_dtls1->item_discnt_amt ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td style="width:5%;">
                                                                                    <!-- <input type="text" name="" id="" class="form-control pck_witmi4" value="<?= $pckitmsql_dtls1->item_price ?>" readonly> -->
                                                                                </td>

                                                                                <td style="width:5%;" class="hide_in_invoice">
                                                                                    <!--   <input type="text" name="" id="" class="form-control pck_itemdescount" value="<?= $pckitmsql_dtls1->discounted_amt ?>" readonly> -->
                                                                                </td>

                                                                                <td style="width:5%;" class="hide_in_invoice">
                                                                                    <!--  <input type="text" name="" id="" class="form-control pck_itmtot" value="<?= $pckitmsql_dtls1->item_tot ?>" readonly> -->
                                                                                </td>

                                                                                <td style="width:4%;" class="hide_in_invoice">

                                                                                    <?php
                                                                                    if ($pckitmsql_dtls1->item_taxble != 1) {
                                                                                        $settaxval = "0";
                                                                                        $taxchksts = "";
                                                                                    } else {
                                                                                        $settaxval = "1";
                                                                                        $taxchksts = "checked";
                                                                                    }
                                                                                    ?>
                                                                                    <input checked class="1" <?= $taxchksts ?> type="checkbox" value="<?= $settaxval ?>" id="iteam_taxable<?= $itmId ?>" name="iteam_taxable<?= $itmId ?>" onchange="fnupdateitemtax(this.value,'<?= $itmId ?>','<?= $pckitmsql_dtls1->inv_id ?>')">
                                                                                </td>

                                                                                <td style="width:4%;" class="hide_in_invoice">


                                                                                    <button onclick="removeitem(<?= $itmId ?>)" type="button" name="" value="" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button>

                                                                                    <input type="hidden" class="7" name="pcktot" id="pcktot" value="<?= sprintf('%0.2f', $pckitmsql_dtls1->package_price) ?>">
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    <?php $rno++;
                                                                    } ?>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php }  ?>
                                        </table>
                                    </form>
                                    <!-------------------------------------------------------------------------- Custome item display ------------------------------------------------------------------------>

                                    <?php

                                    /*                AND cus_id='".$_POST['custnm']."'*/
                                    $isexistsitemsql = $this->db->query("SELECT * FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $invoice_number . "'  ORDER BY id ASC ");
                                    /*              AND cus_id='".$_POST['custnm']."'*/
                                    $lstitemrow = $this->db->query("SELECT * FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $invoice_number . "'  ORDER BY id DESC LIMIT 1");
                                    $getitemrow = $lstitemrow->row();

                                    if ($isexistsitemsql->num_rows() > 0) {
                                    ?>
                                        <form method="POST" action="<?= base_url('fi_home/CustomerInvoice') ?>" style="margin-bottom: auto;">
                                            <table class="table table-hover no-margin fixed_table w1000" style="width:99.85%;">
                                                <?php
                                                $srno = 1;
                                                foreach ($isexistsitemsql->result() as $pckitmsql_dtls) {

                                                    //print_r($pckitmsql_dtls);

                                                    $itmId = $pckitmsql_dtls->id;
                                                    $lstinvoiceid = "fa-minus";
                                                    $lstinvoicecls = "btn-danger";
                                                    $fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "','" . $invoice_number . "')";
                                                ?>
                                                    <thead id="lstpckitems" style="border-top: 1px solid #ccc; ">
                                                        <tr class="tr_clone auto-index">
                                                            <td style="width:4%;text-align:center; ">
                                                                <input type="text" onblur="savedataitem(<?= $pckitmsql_dtls->id ?>)" name="item_quantity<?= $itmId ?>" id="" min="1" class="form-control text-center item_quantity<?= $itmId ?>" value="<?= $pckitmsql_dtls->item_quantity ?>">
                                                            </td>

                                                            <td style="width:7%">
                                                                <span class="dblock">*</span>
                                                            </td>

                                                            <td style="width:8%">
                                                                <select class="form-control item_name<?= $itmId ?>" name="item_name<?= $itmId ?>" id="" onblur="savedataitem(<?= $pckitmsql_dtls->id ?>)">
                                                                    <option value="">Choose</option><?php
                                                                                                    $admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");
                                                                                                    foreach ($admitmsql->result() as $admitmsql_dtls) {
                                                                                                        if ($admitmsql_dtls->item_id == $pckitmsql_dtls->item_name) {
                                                                                                            $selectitmtyp = "selected";
                                                                                                        } else {
                                                                                                            $selectitmtyp = "";
                                                                                                        } ?>
                                                                        <option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>
                                                                    <?php } ?>
                                                            </td>

                                                            <td style="width:23%">
                                                                <input type="text" name="item_desc<?= $itmId ?>" id="i3<?= $itmId ?>" class="form-control 2" value="<?= $pckitmsql_dtls->item_desc ?>">
                                                            </td>

                                                            <td style="width:5%"><?php
                                                                                    if ($pckitmsql_dtls->item_discnt_typ != "") {
                                                                                        $setitemdescnt = $pckitmsql_dtls->item_discnt_typ;
                                                                                    } else {
                                                                                        $setitemdescnt = "";
                                                                                    }
                                                                                    ?>
                                                                <!-- onblur="savedataitem(<?= $pckitmsql_dtls->id ?>)" -->
                                                                <select name="item_discount<?= $itmId ?>" id="item_discount" class="form-control updwn itemdiscntyp">
                                                                    <option value=""> Choose</option>
                                                                    <option <?php if ($setitemdescnt == '1') {
                                                                                echo "selected";
                                                                            } ?> value="1">$</option>
                                                                    <option <?php if ($setitemdescnt == '2') {
                                                                                echo "selected";
                                                                            } ?> value="2">%</option>
                                                                </select>
                                                            </td>

                                                            <!--
            <td style="width:8%">
                <div style="display:flex">$
                <input onchange="savedataitem(<?= $pckitmsql_dtls->id ?>)" style="text-align: right;"
                type="text" name="item_discnt_amt<?= $itmId ?>" id="" class="form-control" value="<?= $pckitmsql_dtls->item_discnt_amt ?>">
                </div>
            </td> -->
                                                            <td style="width:8%">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-usd" style="">
                                                                            </span>
                                                                        </span>
                                                                        <input onchange="savedataitem(<?= $pckitmsql_dtls->id ?>)" type="text" name="item_discnt_amt<?= $itmId ?>" class="form-control " style="text-align: right;" value="<?= $pckitmsql_dtls->item_discnt_amt ?>">
                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td style="width:5%">
                                                                <div class="form-group" style="text-align: -webkit-right;">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-usd" style="margin-top:1px; margin-right:-16px">
                                                                            </span>
                                                                        </span>

                                                                        <input type="text" onchange="changeitemamount(<?= $itmId ?>)" name="item_amount<?= $itmId ?>" id="i4<?= $itmId ?>" class="form-control witmi4 1 total_focus_me_<?= $itmId ?>" value="<?= sprintf('%0.2f', $pckitmsql_dtls->item_price) ?>">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td style="width:5%">
                                                                <div class="form-group" style="text-align: -webkit-right;">
                                                                    <div class="input-group"><span>$<?= sprintf('%0.2f', $pckitmsql_dtls->discounted_amt) ?></span>
                                                                        <!--  <span class="input-group-addon"><span class="glyphicon glyphicon-usd" style="margin-top:2px; margin-right:-14px"></span></span> -->
                                                                        <input type="hidden" name="itm_discnt_amt" id="itm_discnt_amt" class="form-control" value="<?= sprintf('%0.2f', $pckitmsql_dtls->discounted_amt) ?>" disabled>
                                                                    </div>
                                                                </div>

                                                            </td>

                                                            <td style="width:5%">
                                                                <div class="form-group" style="text-align: -webkit-right;">
                                                                    <div class="input-group"><span>$<?= sprintf('%0.2f', ($pckitmsql_dtls->item_quantity * $pckitmsql_dtls->item_price) - $pckitmsql_dtls->discounted_amt) ?></span>
                                                                        <input type="hidden" disabled name="item_total<?= $itmId ?>" id="i5<?= $itmId ?>" class="form-control itmtot" value="<?php                                                                                                                                                                                               if ($pckitmsql_dtls->item_discnt_typ == 1) {
                                                                                                                                                                                                    echo sprintf('%0.2f', ($pckitmsql_dtls->item_quantity * $pckitmsql_dtls->item_price) - $pckitmsql_dtls->discounted_amt);
                                                                                                                                                                                                } else {                                                                                                                                                                                                     echo sprintf('%0.2f', ($pckitmsql_dtls->item_quantity * $pckitmsql_dtls->item_price) - $pckitmsql_dtls->discounted_amt); 
                                                                                                                                                                                                } ?>">                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="width:4%">
                                                                <?php
                                                                if ($pckitmsql_dtls->item_taxble != 1) {
                                                                    $settaxval = "0";
                                                                    $taxchksts = "";
                                                                } else {
                                                                    $settaxval = "1";
                                                                    $taxchksts = "checked";
                                                                }
                                                                ?>
                                                                <input <?= $taxchksts ?> type="checkbox" value="<?= $settaxval ?>" id="iteam_taxable<?= $itmId ?>" name="iteam_taxable<?= $itmId ?>" onchange="fnupdateitemtax(this.value,'<?= $itmId ?>','<?= $pckitmsql_dtls->inv_id ?>')">
                                                            </td>

                                                            <td style="width:4%">
                                                                <button style="display:none" type="submit" value="<?= $pckitmsql_dtls->id ?>" name="button_7" class="button_7<?= $pckitmsql_dtls->id ?> btn btn-xs btn-success"><i class="fa fa-save"></i></button>
                                                                <button type="submit" name="button_4" value="<?= $pckitmsql_dtls->id ?>" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                <?php $srno++;
                                                } ?>
                                            </table>
                                        </form>
                                    <?php  } ?>
                                    <!----------------------------------------------------- Custom item display end ------------------------------------------------------------>
                                    <form method="POST" action="<?= base_url('fi_home/CustomerInvoice') ?>">
                                        <table class="table table-hover no-margin fixed_table w1000" style="width:99.90%; min-width:1000px;">
                                            <thead id="pckitems" class="pckitems1">
                                                <tr class="tr_clone auto-index">

                                                    <td style="width:4%;">
                                                        <input style="" type="text" name="item_quantity" style="" id="" class="form-control" value="">
                                                    </td>

                                                    <td style="width:7%">
                                                        <span class="w120 dblock">*</span>
                                                    </td>

                                                    <td style="width: 8%">
                                                        <select onblur="additem()" class="form-control" name="itemId" id="">
                                                            <option value="">Choose</option>
                                                            <?php
                                                            $admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");
                                                            foreach ($admitmsql->result() as $admitmsql_dtls) {
                                                                /* if($admitmsql_dtls->item_id==$pckitmsql_dtls->item_name)
                                                            {
                                                                $selectitmtyp="selected";
                                                            }
                                                            else
                                                            {
                                                                $selectitmtyp="";
                                                            }*/

                                                            ?>
                                                                <!-- <?= $selectitmtyp ?> -->
                                                                <option value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td style="width: 23%">
                                                        <input style="background: #e2e2e2;" type="text" name="item_desc" id="i3" class="form-control" value="<?= $setitemdesc ?>">
                                                    </td>

                                                    <td style="width: 5%">

                                                        <select name="item_decntlist" style="background: #e2e2e2 !important;" class="form-control" disabled="">
                                                            <option value=""> Choose</option>
                                                            <option value="1">$</option>
                                                            <option value="2">%</option>
                                                        </select>

                                                    </td>

                                                    <td style="width: 8%">
                                                        <span class="dblock" style="background: #e2e2e2 !important;"></span>
                                                    </td>

                                                    <td style="width: 5%">
                                                        <div class="form-group" style="text-align: -webkit-right;">
                                                            <div class="input-group"><span>$00.00</span>
                                                                <!--   <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-usd"  style="margin-top:2px; margin-right:-15px">

                                                  </span>
                                                </span> -->
                                                                <input type="hidden" disabled="" style="background: #e2e2e2 !important;" name="item_amount" id="i4" class="form-control 2" style="" value="<?= sprintf('%0.2f', $setitemamt) ?>" onblur="fniteminfo(this.value)">
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="width: 5%">
                                                        <div class="form-group" style="text-align: -webkit-right;">
                                                            <div class="input-group"><span>$00.00</span>
                                                                <!--  <span class="input-group-addon"><span class="glyphicon glyphicon-usd"  style="margin-top:2px; margin-right:-15px"></span></span> -->
                                                                <input type="hidden" disabled="" style="background: #e2e2e2 !important;" name="item_total" id="i5" class="form-control" style="" value="<?= sprintf('%0.2f', $setitemtot) ?>">
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <!--  <td style="width: 5%">
                                            <div class="form-group">
                                              <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                                <input type="text" disabled="" style="background: #e2e2e2 !important;" name="item_total" id="i5" class="form-control"style="" value="<?= sprintf('%0.2f', $setitemtot) ?>">
                                              </div>
                                            </div>
                                          </td>
 -->
                                                    <td style="width: 5%">
                                                        <div class="form-group" style="text-align: -webkit-right;">
                                                            <div class="input-group"><span>$00.00</span>
                                                                <!--   <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-usd"  style="margin-top:2px; margin-right:-15px">
                                                    </span>
                                                </span> -->
                                                                <input type="hidden" disabled="" style="background: #e2e2e2 !important;" name="item_total" id="i5" class="form-control" style="" value="<?= sprintf('%0.2f', $setitemtot) ?>">
                                                            </div>
                                                        </div>
                                                    </td>


                                                    <td style="width:4%"> <input class="" readonly="" style="background: #e2e2e2 !important;" type="checkbox" value="1" name="iteam_taxable">
                                                    </td>

                                                    <td style="width:4%">
                                                        <span class="dblock">
                                                            <button style="display:none" type="submit" name="button_3" value="3" class="btn btn-xs btn-success button_3"><i class="fa fa-plus"></i></button>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="table-responsive">
                                <div class="box box-default thirdblock_bg ">
                                    <form method="POST" action="<?= base_url('fi_home/CustomerInvoice') ?>">
                                        <table class="table table-hover no-margin nobg">
                                            <thead>
                                                <tr>
                                                    <th>Package Name</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                $pckgrandtotal = "";
                                                $singlpckgsql = $this->db->query("SELECT * FROM customer_assigned_packages WHERE inv_id='" . $invoice_number . "' ORDER BY id ASC LIMIT 1");
                                                $singlpckgsql_row = $singlpckgsql->row();
                                                $pckgsql = $this->db->query("SELECT * FROM customer_assigned_packages WHERE inv_id='" . $invoice_number . "' ORDER BY id ASC");
                                                foreach ($pckgsql->result() as $pckgsql_dtls) {
                                                    $pckgrandtotal += $pckgsql_dtls->package_price;
                                                ?>
                                                    <tr class="auto-index tr_clone">
                                                        <td>
                                                            <select class="form-control" name="item_package_name" id="itemPackageName" onchange="fnupdatepckg(this.value,'<?= $pckgsql_dtls->id ?>')" disabled>
                                                                <option value="">Select</option>
                                                                <?php
                                                                $all_packs = $this->db->query("SELECT * from admin_package");
                                                                foreach ($all_packs->result() as $items) {
                                                                    if ($pckgsql_dtls->package_id == $items->package_id) {
                                                                        $selpckg = "selected";
                                                                    } else {
                                                                        $selpckg = "";
                                                                    }
                                                                ?>
                                                                    <option <?= $selpckg ?> value="<?= $items->package_id ?>"><?= $items->package_name ?> - <?= $items->package_desc ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd" style=""></span></span>
                                                                    <input type="text" name="item_price" id="pri" class="form-control totsum updwn changemyamount<?= $pckgsql_dtls->id ?>" style="background: #80808047; width: 80px;" value="<?= sprintf('%0.2f', $pckgsql_dtls->package_price) ?>" onchange="changemyvalue(<?= $pckgsql_dtls->id ?>)"><!--  itempckprice -->
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <button type="submit" name="button_2" value="<?= $pckgsql_dtls->id ?>" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></button>

                                                        </td>
                                                    </tr>
                                                <?php } ?>


                                                <tr class="auto-index tr_clone">
                                                    <td>

                                                        <select onblur="addpackage()" class="form-control" name="item_package_name" id="itemPackageName">
                                                            <option value="">Select</option>
                                                            <?php
                                                            $user = $this->session->fi_session['id'];
                                                            $all_packs = $this->db->query("SELECT * from admin_package where user = '" . $user . "'");
                                                            foreach ($all_packs->result() as $items) {
                                                            ?>
                                                                <option value="<?= $items->package_id ?>"><?= $items->package_name ?> - <?= $items->package_desc ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <div class="">
                                                                <span class="input-group-addon">
                                                                    <!-- <span class="glyphicon glyphicon-usd"></span> -->
                                                                </span>
                                                                <input tabindex="-1" type="text" name="item_price" id="pri" class="form-control totsum updwn" style="text-align: right;" value="" placeholder="$0.00">

                                                                <input tabindex="-1" type="hidden" name="invId" id="invId" class="form-control" style="width: 80px;" value='<?= $invoice_number ?>'>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>

                                                        <button style="display:none" type="submit" name="button_1" value="1" class="btn btn-xs btn-success button_1">
                                                            <i class="fa fa-plus"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
            }
        }
