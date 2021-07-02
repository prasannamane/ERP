<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fi_home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('DashboardModel');
        $this->load->model('Attachment_Model');
        $this->load->model('TaskModel');
        $this->load->model('HomeModel');
        $this->load->model('CustomersModel');
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 1. Search
     */

    public function search()
    {
        $cus_id = $this->session->userdata('id');

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }

        $this->session->set_userdata('id', $cus_id);
        $this->session->unset_userdata('event_page', '');

        $data['cus_id']      = $cus_id;
        $data['select_customer_name'] = 'Search Customer';
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['custs']    = $this->AdminModel->search_data();

        $data['page_title'] = "Search Results";
        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = "search_customer_opt";
        $data['act_custrows'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/search', $data);
        $this->load->view('fi/footer');
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 1. Search 1.1
     */

    public function getSearchCustContactInfo()
    {
        $cName = $this->input->post('name');
        if (!$cName > 0) {
            $cName = $this->session->userdata('id');
        }
        $this->session->set_userdata('id', $cName);
        $this->AdminModel->allSearchCustInfo($cName);
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 2. General Info
     */
    public function generalinfo()
    {
        $this->session->unset_userdata('event_page', '');
        $cus_id = $this->session->userdata('id');

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }

        $this->session->set_userdata('id', $cus_id);
        $data['select_customer_name'] = 'GENERAL INFO';
        $data['cus_id']         = $cus_id;
        $data['alert']          = $this->session->flashdata('alert');
        $data['error']          = $this->session->flashdata('error');
        $data['success']        = $this->session->flashdata('success');
        $data['contact']        = $this->db->where('cat_id', 1)->get('sub_categories')->result_array();
        $data['custs']          = $this->AdminModel->search_data();
        $data['single_cust']    = $this->AdminModel->search_data()[0];
        $data['cus_id']         = $cus_id;
        $data['pageName']       = "General Info";

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/generalinfo', $data);
        $this->load->view('fi/footer');
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 2. General Info 2.1
     */
    public function update_coustomer()
    {
        if ($this->input->post('cus_id')) {
            $data['cus_title']          = $this->input->post('title');
            $data['cus_fname']          = $this->input->post('cus_fname');
            $data['cus_lname']          = $this->input->post('cus_lname');
            $data['cus_company_name']   = $this->input->post('cus_com');
            $data['cus_address1']       = $this->input->post('cus_address1');
            $data['cus_address2']       = $this->input->post('cus_address2');
            $data['cus_city']           = $this->input->post('cus_city');
            $data['cus_state']          = $this->input->post('cus_state');
            $data['cus_zip']            = $this->input->post('cus_zip');
            $data['cus_area']           = $this->input->post('cus_area');
            $data['cus_tax_status']     = $this->input->post('tax_status');
            $data['cus_tax_id']         = $this->input->post('cus_tax_id');
            $data['custom1']            = $this->input->post('custom1');
            $data['custom2']            = $this->input->post('custom2');
            $up_id                      = $this->input->post('cus_id');
            $cus_id                     = $this->AdminModel->up_addcoustomer($data, $up_id);

            $this->AdminModel->Event_Name_Update($this->input->post('cus_lname') . "-" . $this->input->post('cus_com'), $up_id);

            if ($cus_id) {
                $address['ship_user_id']        = $up_id;
                $address['ship_address1']       = $this->input->post('cus_ship_address1');
                $address['ship_address2']       = $this->input->post('cus_ship_address2');
                $address['ship_city']           = $this->input->post('cus_ship_city');
                $address['ship_state']          = $this->input->post('cus_ship_state');
                $address['ship_zip']            = $this->input->post('cus_ship_zip');
                $address['billing_addr_status'] = $this->input->post('billaddr');
                $address['ship_cusname']        = $this->input->post('shipcusname');

                $this->AdminModel->up_addshipaddress($address, $up_id);
                $this->AdminModel->del_addcontactdata($up_id);

                for ($i = 0; $i < count($this->input->post('cus_contact_type')); $i++) {
                    if ($this->input->post('cus_contact_type')[$i] != "") {
                        $contact['cus_id']              =   $up_id;
                        $contact['conatct_type']        =   $this->input->post('cus_contact_type')[$i];
                        $contact['contact_no']          =   $this->input->post('cus_contact_no')[$i];
                        $contact['user_contact_note']   =   $this->input->post('cus_note')[$i];

                        if ($this->input->post('radio_click[]')[$i] == "on") {
                            $b = "on";
                        } else if ($this->input->post('radio_click[]')[$i] == "off") {
                            $b = "off";
                        }

                        if ($b == 'on') {
                            $contact['default_contact'] = 1;
                        } else {
                            $contact['default_contact'] = 0;
                        }
                        $result = $this->AdminModel->addcontactdata($contact);
                    }
                }

                for ($j = 0; $j < count($this->input->post('cuscnt_type_email')); $j++) {
                    if ($this->input->post('cuscnt_type_email')[$j] != "") {
                        $contact1['cus_id']         =   $up_id;
                        $contact1['conatct_type']   =   $this->input->post('cuscnt_type_email')[$j];
                        $contact1['email']          =   $this->input->post('txtemail')[$j];


                        if ($this->input->post('email_radio_click[]')[$j] == "on") {
                            $b = "on";
                        } else if ($this->input->post('email_radio_click[]')[$j] == "off") {
                            $b = "off";
                        }
                        if ($b == 'on') {
                            $contact1['default_contact'] = 1;
                        } else {
                            $contact1['default_contact'] = 0;
                        }
                        if ($contact1['email'] != '') {
                            $result = $this->AdminModel->addcontactdata($contact1);
                        }
                    }
                }

                $this->db->where('cus_id', $up_id);
                $this->db->where('con_type', $this->input->post('adcntype'));
                $this->AdminModel->del_additionalcontactdata($up_id);
                for ($k = 0; $k < count($this->input->post('name')); $k++) {
                    if ($this->input->post('name')[$k] != "") {

                        $contact2['cus_id']     =   $up_id;
                        $contact2['con_type']   =   $this->input->post('adcntype');
                        $contact2['name']       =   $this->input->post('name')[$k];
                        $contact2['type']       =   $this->input->post('job_type')[$k];
                        $contact2['address']    =   $this->input->post('address')[$k];
                        $contact2['city']       =   $this->input->post('city')[$k];
                        $contact2['state']      =   $this->input->post('state')[$k];
                        $contact2['zip']        =   $this->input->post('zip')[$k];
                        $contact2['home']       =   $this->input->post('home')[$k];
                        $contact2['cel']        =   $this->input->post('cel')[$k];
                        $contact2['work']       =   $this->input->post('work')[$k];
                        $contact2['email']      =   $this->input->post('emailaddr')[$k];
                        $contact2['event_name'] =   $this->input->post('cuscnt_type_event_name')[$k];

                        $result = $this->AdminModel->additionalcontactdata($contact2);
                    }
                }
                $this->session->set_userdata('id', $up_id);
                $this->session->set_flashdata('success', 'Customer updated successfully ..!');
                redirect('fi_home/generalinfo');
            }
        } else {
            $this->addcoustomer();

            $data['cus_title']              = $this->input->post('title');
            $data['cus_fname']              = $this->input->post('cus_fname');
            $data['cus_lname']              = $this->input->post('cus_lname');
            $data['cus_company_name']     = $this->input->post('cus_com');
            $data['cus_address1']           = $this->input->post('cus_address1');
            $data['cus_address2']               = $this->input->post('cus_address2');
            $data['cus_city']                       = $this->input->post('cus_city');
            $data['cus_state']                      = $this->input->post('cus_state');
            $data['cus_zip']                        = $this->input->post('cus_zip');
            $data['cus_area']                         = $this->input->post('cus_area');
            $data['cus_tax_status']         = $this->input->post('tax_status');
            $data['cus_tax_id']                 = $this->input->post('cus_tax_id');
            $up_id = $this->input->post('cus_id');
            $this->session->set_userdata('id', $up_id);
            $cus_id = $this->AdminModel->up_addcoustomer($data, $up_id);

            $this->AdminModel->Event_Name_Update($this->input->post('cus_lname') . "-" . $this->input->post('cus_com'), $up_id);

            if ($cus_id) {
                $address['ship_user_id']        = $up_id;
                $address['ship_address1']       = $this->input->post('cus_ship_address1');
                $address['ship_address2']               = $this->input->post('cus_ship_address2');
                $address['ship_city']                       = $this->input->post('cus_ship_city');
                $address['ship_state']                      = $this->input->post('cus_ship_state');
                $address['ship_zip']                    = $this->input->post('cus_ship_zip');
                $address['billing_addr_status']         = $this->input->post('billaddr');
                $address['ship_cusname']        = $this->input->post('shipcusname');

                $this->AdminModel->up_addshipaddress($address, $up_id);
                $this->AdminModel->del_addcontactdata($up_id);

                for ($i = 0; $i < count($this->input->post('cus_contact_type')); $i++) {

                    if ($this->input->post('cus_contact_type')[$i] != "") {

                        $contact['cus_id']  =   $up_id;
                        $contact['conatct_type']    =   $this->input->post('cus_contact_type')[$i];

                        $contact['contact_no']  =   $this->input->post('cus_contact_no')[$i];
                        $contact['user_contact_note']   =   $this->input->post('cus_note')[$i];
                        if ($this->input->post('radio_click[]')[$i] == "on") {
                            $b = "on";
                        } else if ($this->input->post('radio_click[]')[$i] == "off") {
                            $b = "off";
                        }
                        if ($b == 'on') {
                            $contact['default_contact'] = 1;
                        } else {
                            $contact['default_contact'] = 0;
                        }

                        $result = $this->AdminModel->addcontactdata($contact);
                    }
                }

                for ($j = 0; $j < count($this->input->post('cuscnt_type_email')); $j++) {

                    if ($this->input->post('cuscnt_type_email')[$j] != "") {
                        $contact1['cus_id'] =   $up_id;
                        $contact1['conatct_type']  =   $this->input->post('cuscnt_type_email')[$j];
                        $contact1['email'] =   $this->input->post('txtemail')[$j];
                        if ($this->input->post('email_radio_click[]')[$j] == "on") {
                            $b = "on";
                        } else if ($this->input->post('email_radio_click[]')[$j] == "off") {
                            $b = "off";
                        }
                        if ($b == 'on') {
                            $contact1['default_contact'] = 1;
                        } else {
                            $contact1['default_contact'] = 0;
                        }

                        $result = $this->AdminModel->addcontactdata($contact1);
                    }
                }

                $this->db->where('cus_id', $up_id);
                $this->db->where('con_type', $this->input->post('adcntype'));
                $this->AdminModel->del_additionalcontactdata($up_id);
                for ($k = 0; $k < count($this->input->post('name')); $k++) {

                    if ($this->input->post('name')[$k] != "") {

                        $contact2['cus_id']    =   $up_id;
                        $contact2['con_type']  =   $this->input->post('adcntype');
                        $contact2['name']  =   $this->input->post('name')[$k];
                        $contact2['address']   =   $this->input->post('address')[$k];
                        $contact2['city']  =   $this->input->post('city')[$k];
                        $contact2['state'] =   $this->input->post('state')[$k];
                        $contact2['zip']   =   $this->input->post('zip')[$k];
                        $contact2['home']  =   $this->input->post('home')[$k];
                        $contact2['cel']   =   $this->input->post('cel')[$k];
                        $contact2['work']  =   $this->input->post('work')[$k];
                        $contact2['email'] =   $this->input->post('emailaddr')[$k];

                        $result = $this->AdminModel->additionalcontactdata($contact2);
                    }
                }

                $this->session->set_userdata('id', $up_id);
                $this->session->set_flashdata('success', 'Customer updated successfully ..!');
                redirect('fi_home/search_new_cus');
            }
        }
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 2. General Info 2.2
     */
    public function sendgeninfoemail()
    {
        $to = $_POST['nwcustemail'];
        $sub = $_POST['letteremailsub'];
        $msg = $_POST['letteremaildesc'];
        $fileData = array();
        $files = $_FILES;

        if (!empty($_FILES['crewavl']['name'])) {

            $filesCount = count($_FILES['crewavl']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['crewavl']['name'] = $files['crewavl']['name'][$i];
                $_FILES['crewavl']['type'] = $files['crewavl']['type'][$i];
                $_FILES['crewavl']['tmp_name'] = $files['crewavl']['tmp_name'][$i];
                $_FILES['crewavl']['error'] = $files['crewavl']['error'][$i];
                $_FILES['crewavl']['size'] = $files['crewavl']['size'][$i];
                $config['upload_path']   = 'uploads/crew_mails';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
                $config['overwrite']     = FALSE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('crewavl')) {
                    $fileData[] = $this->upload->data();
                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('info@tech599.com', 'ERP SYSTEM- General information');
                    $this->email->to($to);
                    $this->email->subject($sub);
                    $this->email->message($msg);
                    $pathToUploadedFile = $fileData[$i]['full_path'];
                    $this->email->attach($pathToUploadedFile);
                } else {

                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('info@tech599.com', 'ERP SYSTEM- General information');
                    $this->email->to($to);
                    $this->email->subject($sub);
                    $this->email->message($msg);
                }
            }
            $this->email->send();
            $this->session->set_flashdata('success', "Mail Send Successfully..!!");
            redirect('fi_home/generalinfo');
        }
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 2. General Info 2.3
     */

    public function getCustInfo()
    {
        $cName = $this->input->post('name');
        if ($cName == 'undefined' || $cName == '') {
            $cName = $this->session->userdata('id');
        }

        $this->session->set_userdata('id', $cName);
        $this->AdminModel->allGeneralInfo($cName);
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 2. General Info 2.4
     */

    public function getCustContactInfo1()
    {
        $cName = $this->input->post('name');
        $this->AdminModel->allCustInfo($cName);
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 28, 2021
     * @package Custumer 2. General Info 2.5
     */
    public function fnloadadditionalcnt_info()
    {
        $this->AdminModel->fnloadadditionalcntinfo_dtls();
    }

    public function search_new_cus($cus_id = 0)
    {
        $user = $this->session->fi_session['id'];
        if ($cus_id == '') {
            $cus_id = $this->session->userdata('id');
        }
        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }
        $this->session->set_userdata('id', $cus_id);

        $data['cus_id']      = $cus_id;
        $data['single_cust'] = $this->AdminModel->search_data()[0];
        $data['event_data']  = $this->AdminModel->get_event_data_id($cus_id);

        $results = $this->AdminModel->get_event_data_id_count($cus_id);
        if ($results > 0) {
            $data['user_contact_info']    = $this->AdminModel->user_contact_info($cus_id);
            $data['user_name']            = $this->AdminModel->user_name($cus_id);
            $this->session->set_userdata('event_page', 1);
        }

        $data['search']       = $this->AdminModel->search_data();


        $cond = array('cat_id' => 3, 'user' => $user);
        $tbl = "sub_categories";
        $data['event_name'] = $this->HomeModel->get_all_by_cond($tbl, $cond);


        $get_loc              = $this->db->query("SELECT * from add_location_event");
        $data['all_locs']     = $get_loc->result_array();
        if ($cus_id == 0) {
            $data['last_row']     = $this->db->where('cus_id', $cus_id)->get('register_customer')->result_array()[0];
        }

        $data['all_crews']    = $this->db->where('cat_id', 4)->get('sub_categories')->result_array();
        $data['location_data'] = $this->AdminModel->get_locationt_data_id($cus_id);
        $data['crews_data']   = $this->AdminModel->get_crews_data_id($cus_id);

        $data['select_customer_name'] = 'Events';
        $data['alert']                = $this->session->flashdata('alert');
        $data['error']                = $this->session->flashdata('error');
        $data['success']              = $this->session->flashdata('success');


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/eventCreate', $data);
        $this->load->view('fi/footer');
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 7, 2021
     * @package Common
     */
    public function addlettersinfo()
    {
        $img_nm = "";
        $user = $this->session->fi_session['id'];
        if (isset($_FILES['lettrimg']['name']) != "") {
            $config['upload_path']   = 'uploads/letters_attachments';
            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('lettrimg')) {
                $data = array('upload_data' => $this->upload->data());
                $img_nm = $this->upload->data('file_name');
            }
        }

        $letterarr = array(
            "name" => $this->input->post('txtlettertyp'),
            "desc" => $this->input->post('textletterdetails'),
            "attachment" => $img_nm
        );

        $getexist_array = array(
            'user' => $user,
            'name' => $this->input->post('txtlettertyp')
        );
        $getexist_sql = $this->db->where($getexist_array)->get('adm_letters_type');
        $rowCount = $getexist_sql->num_rows();
        if ($rowCount == 1) {
            $this->db->where('name', $this->input->post('txtlettertyp'));
            if ($this->db->update('adm_letters_type', $letterarr)) {
                $this->session->set_flashdata('success', "Letter Updated Successfully..!!");
            }
        } else {
            $letterarr['user'] = $user;
            if ($this->db->insert('adm_letters_type', $letterarr)) {
                $this->session->set_flashdata('success', "Letter Inserted Successfully..!!");
            }
        }
        redirect('fi_home/administration_letters');
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 7, 2021
     * @package Common
     */
    public function add_newletters()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/add_newletters', $data);
        $this->load->view('fi/footer');
    }

    /**
     * @author Prasanna Mane prasannamane@gmail.com
     * Create -
     * Updated March 7, 2021
     * @package Common | Custumer | 
     */

    public function find_city()
    {
        $zip = $this->input->post('zip');
        if ($zip) {
            $this->AdminModel->find_city_json($zip);
        }
    }

    public function c_notes()
    {
        $result = $this->AdminModel->update_email_notification();
        if ($cus_id == '') {
            $cus_id = $this->session->userdata('id');
        }

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }

        $event_data['cus_id']      = $cus_id;

        $this->session->unset_userdata('event_page', '');
        $cus_id                     = $this->session->userdata('id');
        $event_data['single_cust']  = $this->AdminModel->search_data()[0];
        $event_data['search']       = $this->AdminModel->search_data();
        $event_data['last_row']     = $this->db->where('cus_id', $cus_id)->get('register_customer')->result_array()[0];
        $invoice_id                 = $this->db->SELECT('invoice_id')->where('cust_id', $cus_id)->get('invoices_create')->result_array();
        $inv_id                     = "";

        foreach ($invoice_id as $key) {
            if ($inv_id == "") {
                $inv_id = $key['invoice_id'];
            } else {
                $inv_id = $inv_id . "," . $key['invoice_id'];
            }
        }

        $cond = array('cus_id' => $cus_id);
        $tbl = 'customer_invoice_notes';
        $event_data['invoice_note'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        //$tblA = "customer_invoice_notes";
        //$tblB = "events_register";
        //$tblC = "events_register";

        //$idA = "inv_id";
        //$idB = "inv_id";

        //$idBB = "invoice_type";
        //$idC = "event_id";

        //$cond = array('cus_id' => $cus_id);
        //$event_data['invoice_note'] = $this->HomeModel->get_all_TwoTbl_by_cond($tblA, $tblB, $cond, $idA, $idB);

        $event_data['appointmtnt'] = $this->db->select('c.*, u.username')
            ->where('cus_id', $cus_id)
            ->join('users u', 'u.id=c.users_id', 'left')
            ->order_by('c.note_datetime', 'ASC')
            ->get('customer_appointment c')->result_array();

        if ($cus_id == '') {
            $event_data['corr_email']   = $this->db->select('c.*, uc.email')
                ->join('user_contact_info uc', 'uc.email=c.sender_mail', 'left')
                ->get('correspondence c')
                ->result_array();
        } else {
            $event_data['corr_email']   = $this->db->select('c.*, uc.email')
                ->join('user_contact_info uc', 'uc.email=c.sender_mail', 'left')
                ->where('uc.cus_id', $cus_id)
                ->get('correspondence c')
                ->result_array();
        }

        $corr_email = $event_data['corr_email'];
        $sender_mail = $corr_email[0];
        $event_data['sender_mail'] = $sender_mail['sender_mail'];

        $event_data['alert']     = $this->session->flashdata('alert');
        $event_data['error']     = $this->session->flashdata('error');
        $event_data['success']   = $this->session->flashdata('success');

        // Fetch dropdown values for TODo Description & Appointment Description
        $event_data['todo_descp_list']  = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='24'")->result_array();
        $event_data['appnt_descp_list'] = $this->db->query("SELECT sub_name FROM sub_categories WHERE cat_id='38'")->result_array();
        $event_data['for_user']         = $this->db->query("SELECT `id`, `username` FROM `users` WHERE admin_role_id=2")->result_array();

        $event_data['event_data']  = $this->AdminModel->get_event_data_id($cus_id);

        $event_data['select_customer_name'] = 'Notes';

        //print_r($event_data);
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/notes', $event_data);
        $this->load->view('fi/footer');
    }

    public function insertinvnotes()
    {
        $cus_id = $this->session->userdata('id');
        $result = $this->AdminModel->insertinvnotes_dtls($cus_id);
    }

    public function updateinvnotes()
    {
        $result = $this->AdminModel->updateinvnotes_dtls();
    }

    public function fnupdtejobdtlsinfo()
    {
        $this->AdminModel->fnupdtejobdtlsinfo_dtls();
    }

    public function deletejobsub()
    {
        $job_id = $this->input->post('job_id');
        $cond = array('job_id' => $job_id);
        $tbl = "event_jobs_dtls";
        $result = $this->HomeModel->delete_data($tbl, $cond);
    }

    public function fnloadeventinfo()
    {
        $this->CustomersModel->fnloadeventinfo_dtls();
    }

    public function fnloadevntjobinfo()
    {
        $this->AdminModel->fnloadevntjobinfo_dtls();
    }

    public function updtpickupinfo()
    {
        $result = $this->AdminModel->updtpickupinfo_dtls();
    }

    public function updatetask()
    {
        $data['task_date_started']  = date("Y-m-d", strtotime($this->input->post('task_date_started')));
        $data['task_type']          = $this->input->post('task_type');
        $data['sub_task_type']      = $this->input->post('sub_task_type');
        $data['task_completed_date'] = date("Y-m-d", strtotime($this->input->post('taskcompleteddate')));
        $data['task_note']          = $this->input->post('tasknoteu');
        $data['task_entered_by']    = $this->input->post('taskenterbyu');
        $data['task_user']          = $this->input->post('task_user');
        $data['task_due_date']      = $this->input->post('task_due_date');
        $data['task_completed']     = $this->input->post('task_completed');
        $data['invoice_id']         = $this->session->userdata('invoice_number');
        $data['user']               = $this->session->fi_session['id'];
        $cond['task_id']            = $this->input->post('taskIdu');
        $tbl                        = "invoice_task";
        $result                     = $this->HomeModel->update_data($tbl, $cond, $data);
    }

    public function listTask()
    {
        $invoiceNumber  = $this->session->userdata('invoice_number');
        $tasksql        = $this->db->query("SELECT * FROM invoice_task WHERE invoice_id='" . $invoiceNumber . "' ORDER BY task_id ASC");
        $chktsksql      = $this->db->query("SELECT * FROM invoice_task  WHERE invoice_id='" . $invoiceNumber . "' ORDER BY task_id DESC LIMIT 1");
        $istaskrow      = $chktsksql->row();
        if ($tasksql->num_rows() > 0) {
            foreach ($tasksql->result() as $tasksql_dtls) {
                $chktskclr      = $this->db->query("SELECT * FROM adm_task_type WHERE id='" . $tasksql_dtls->task_type . "'");
                $chktskclrrow   = $chktskclr->row();
                if ($tasksql_dtls->task_type == $chktskclrrow->id) {
                    $assigntskcolor = $chktskclrrow->color;
                } else {
                    $assigntskcolor = "";
                }

                $chktskstatusclr    = $this->db->query("SELECT * FROM adm_task_status WHERE id='" . $tasksql_dtls->task_completed . "'");
                $chktskstatusclrrow = $chktskstatusclr->row();
                if ($tasksql_dtls->task_completed == $chktskstatusclrrow->id) {
                    $assigntskstscolor = $chktskstatusclrrow->color;
                } else {
                    $assigntskstscolor = "";
                }

                $taskId = $tasksql_dtls->task_id;
                $taskinvId = $tasksql_dtls->invoice_id;
                $taskstrtdt = $tasksql_dtls->task_date_started;
                $tasksktyp = $tasksql_dtls->task_type;
                $tasksubtyp = $tasksql_dtls->sub_task_type;
                $taskusr = $tasksql_dtls->task_user;
                $taskduedate = $tasksql_dtls->task_due_date;
                $taskcompleted = $tasksql_dtls->task_completed;
                $taskcompletedby = $tasksql_dtls->task_completed_by;
                $taskcompleteddate = $tasksql_dtls->task_completed_date;
                $tasknote = $tasksql_dtls->task_note;
                $taskenteredby = $tasksql_dtls->task_entered_by;

                $todaysdate = date("m-d-Y");
                $mydate = date('m-d-Y', strtotime($taskduedate));
                if ($todaysdate > $mydate && $mydate != "01-01-1970") {
                    $rwcolor = "background-color: #f17b7b;";
                } else {
                    $rwcolor = "background-color: #e6e677;";
                } ?>
                <tr class="tr_clone">
                    <td style="background-color: <?= $assigntskcolor ?>">
                        <?php $dt = date("m/d/Y", strtotime($taskstrtdt)); ?>
                        <input placeholder="mm/dd/yyyy" type="text" name="task_strtdate" id="task_strtdate" class="form-control lsttaskstrtdateu taskstrtdate w95" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>">
                        <input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?= $invoice_number ?>">
                        <input type="hidden" name="hdntskid" class="taskIdu" value="<?= $taskId ?>">
                    </td>
                    <td style="background-color: <?= $assigntskcolor ?>">
                        <select class="form-control lsttasknameu" name="task_name" id="task_name" style="width: 130px;">
                            <option value=""> </option>
                            <?php
                            $invtasktype = $this->db->query("SELECT * FROM adm_task_type");
                            foreach ($invtasktype->result() as $invtasktype_dtls) {
                                if ($tasksktyp == $invtasktype_dtls->id) {
                                    $seltsktyp = "selected";
                                } else {
                                    $seltsktyp = "";
                                }

                            ?>
                                <option <?= $seltsktyp ?> value="<?= $invtasktype_dtls->id ?>"><?= $invtasktype_dtls->name ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>

                    <td style="background-color: <?= $assigntskcolor ?>">
                        <select class="form-control lstsubtasku" name="subtaskname" id="subtaskname" style="width: 130px;">
                            <option value=""> </option>
                            <?php
                            $invtasktype = $this->db->query("SELECT * FROM adm_subtask_type WHERE task_id='" . $tasksktyp . "'");
                            foreach ($invtasktype->result() as $invtasktype_dtls) {
                                if ($tasksubtyp == $invtasktype_dtls->id) {
                                    $seltsktyp = "selected";
                                } else {
                                    $seltsktyp = "";
                                }
                            ?>
                                <option <?= $seltsktyp ?> value="<?= $invtasktype_dtls->id ?>"><?= $invtasktype_dtls->name ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>

                    <td style="background-color: <?= $assigntskcolor ?>">
                        <select class="form-control text-center task_useru" name="task_user" id="task_user">
                            <option value=""> </option>
                            <?php
                            $admloguser = $this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC");
                            foreach ($admloguser->result() as $admloguser_dtls) {
                                if ($admloguser_dtls->cus_id == $taskusr) {
                                    $selusr = "selected";
                                } else {
                                    $selusr = "";
                                }
                            ?>
                                <option <?= $selusr ?> value="<?= $admloguser_dtls->cus_id ?>"><?= $admloguser_dtls->cus_lname ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>

                    <td style="background-color: <?= $assigntskcolor ?>">
                        <?php $dt = date("m/d/Y", strtotime($taskduedate)); ?>
                        <input type="text" name="task_due_date" id="task_due_date" class="form-control taskduedatlast w80" placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_due_date')">
                    </td>

                    <td style="background-color: <?= $assigntskstscolor ?>">
                        <select class="form-control taskcompletedu" name="task_completed" id="task_completed" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed')">
                            <option value=""> </option>
                            <?php
                            $invtasktype = $this->db->query("SELECT * FROM adm_task_status ORDER BY id ASC");
                            foreach ($invtasktype->result() as $invtasktype_dtls) {
                                if ($taskcompleted == $invtasktype_dtls->id) {
                                    $setselct = "selected";
                                } else {
                                    $setselct = "";
                                }

                            ?>
                                <option <?= $setselct ?> value="<?= $invtasktype_dtls->id ?>"><?= $invtasktype_dtls->name ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>

                    <td style="background-color: <?= $assigntskstscolor ?>">
                        <?php
                        $admloguser     = $this->db->query("SELECT * FROM users WHERE id='" . $taskcompletedby . "'");
                        $admloguserrow  = $admloguser->row();
                        $loogedusername = $admloguserrow->name;
                        ?>
                        <input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedbyu updwn" value="<?= $loogedusername ?>" readonly>
                    </td>

                    <td style="background-color: <?= $assigntskstscolor ?>">
                        <?php $dt = date("m/d/Y", strtotime($taskcompleteddate)); ?>
                        <input type="text" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddateu text-center" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed_date')">
                    </td>

                    <td style="background-color: <?= $assigntskstscolor ?>">
                        <input type="text" name="task_note" id="task_note" class="form-control tasknoteu updwn" value="<?= $tasknote ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_note')">
                    </td>

                    <td style="background-color: <?= $assigntskstscolor ?>">
                        <?php
                        $admloguser1 = $this->db->query("SELECT * FROM users WHERE id='" . $taskenteredby . "'");
                        $admloguserrow1 = $admloguser1->row();
                        $logedusername = $admloguserrow1->name;

                        ?>
                        <input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterbyu updwn text-center" value="<?= $logedusername ?>" readonly>
                    </td>

                    <td style="min-width: 40px; width: 40px;">
                        <a onclick="fndeltasks('<?= $taskId ?>','<?= $taskinvId ?>')" class="btn btn-xs btn-danger "><i class="fa fa-minus"></i></a>
                    </td>
                </tr>
<?php
            }
        }
    }

    public function savetask()
    {
        $data['task_date_started']  = date("Y-m-d", strtotime($this->input->post('task_date_started')));
        $data['task_type']          = $this->input->post('task_type');
        $data['sub_task_type']      = $this->input->post('sub_task_type');
        $data['task_user']          = $this->input->post('task_user');
        $data['task_due_date']      = $this->input->post('task_due_date');
        $data['task_completed']     = $this->input->post('task_completed');
        $data['invoice_id']         = $this->session->userdata('invoice_number');
        $data['user']               = $this->session->fi_session['id'];

        $tbl = "invoice_task";
        $this->HomeModel->insertdata($tbl, $data);
    }

    public function updtinvtermsinfo()
    {
        $this->AdminModel->updtinvtermsinfo_dtls();
    }

    public function view_sub_cat()
    {

        $data['alert'] = $this->session->flashdata('alert');
        $data['error'] = $this->session->flashdata('error');
        $data['success'] = $this->session->flashdata('success');
        $id = $this->session->userdata('cat_id');
        $data['id'] = $id;
        $data['sub_cats']     = $this->db->where('cat_id', $id)->get('sub_categories')->result_array();
        redirect('si_home/view_sub_cat');
        /*
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/administration/subCategories',$data);
            $this->load->view('fi/footer');
            */
    }

    public function getvendorlist()
    {
        $result = $this->AdminModel->getvendorlist_dtls();
    }





    public function update_packages($id = 0)
    {
        if ($id > 0) {
            $item['package_name']       =   $this->input->post('package_name');
            $item['package_price']      =   $this->input->post('package_price');
            $item['package_taxable']    =   $this->input->post('package_taxable');
            $item['package_desc']       =   $this->input->post('package_desc');

            if ($item['package_taxable'] == "" | $item['package_taxable'] == "0") {
                $item['package_taxable'] = 0;
            } else {
                $item['package_taxable'] = 1;
            }

            $cond = array('package_id' => $id);
            $tbl = "admin_package";
            $result = $this->HomeModel->update_data($tbl, $cond, $item);

            $cond = array('package_id' => $id);
            $tbl = "admin_package_item";
            $result = $this->HomeModel->delete_data($tbl, $cond);

            for ($i = 0; $i < count($this->input->post('title')); $i++) {
                $item1['package_id']    = $id;
                $item1['item_name']     =   $this->input->post('title')[$i];
                $item1['item_quantity'] =   $this->input->post('quant')[$i];
                $item1['item_price']    =   $this->input->post('i_price')[$i];
                $item1['item_desc']     =   $this->input->post('itmdesc')[$i];
                if ($item1['item_name'] != "") {
                    $result1 = $this->AdminModel->insertPackagesub($item1);
                }
            }

            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');

            if ($result1) {
                $this->session->set_flashdata('success', "Package & Item added successfully..!!");
                redirect('Administration/administration_package');
            } else {
                $this->session->set_flashdata('error', "Package & Item not created..!!");
                redirect('Administration/new_administration_package');
            }
        } else if ($chkpackgeres == "IsExists") {
            $this->session->set_flashdata('error', "This Package Name Already Exists..!!");
            redirect('fi_home/new_administration_package');
        }
    }

    public function getSearchVendsContactInfo()
    {
        $cName = $this->input->post('name');
        $this->session->set_userdata('id', $cName);
        $this->AdminModel->allSearchVendsInfo($cName);
    }

    public function getVendContactInfo()
    {
        $cName = $this->input->post('name');
        $this->AdminModel->getVendContactInfo_dtls($cName);
    }

    public function updtevent()
    {
        $result = $this->AdminModel->updtevent_dtls();
    }

    public function fncrnewevent()
    {
        $result = $this->AdminModel->fncrnewevent_dtls();
    }

    public function newinrtevent()
    {
        $result = $this->AdminModel->newinrtevent_dtls();
    }



    public function search_cust()
    {
        $cus_fname  = $this->input->post('fname');
        $cus_lname  = $this->input->post('lname');
        $cus_cname  = $this->input->post('cname');
        $cus_zname  = $this->input->post('zname');
        $cus_mname  = $this->input->post('mname');
        $adr11      = $this->input->post('adr1');
        $adr22      = $this->input->post('adr2');
        $bal_as_of  = $this->input->post('bal_as_of');
        $city       = $this->input->post('cities');
        $state      = $this->input->post('states');
        $areas      = $this->input->post('areas');
        $accno      = $this->input->post('accno');
        $acctype    = $this->input->post('acctype');
        $vendorname = $this->input->post('vendorname');
        $evfdate    = $this->input->post('evfdate');
        $evtdate    = $this->input->post('evtdate');
        $evtype     = $this->input->post('evtype');
        $evtlocn    = $this->input->post('evtlocn');
        $evtinv_no  = $this->input->post('evtinv_no');
        $evtreff_by = $this->input->post('evtreff_by');

        if ($cus_fname  != "") {
            $fname     = $cus_fname;
        } else {
            $fname = "";
        }
        if ($cus_lname  != "") {
            $lname     = $cus_lname;
        } else {
            $lname = "";
        }
        if ($cus_cname  != "") {
            $cname     = $cus_cname;
        } else {
            $cname = "";
        }
        if ($cus_zname  != "") {
            $zname     = $cus_zname;
        } else {
            $zname = "";
        }
        if ($cus_mname  != "") {
            $mname     = $cus_mname;
        } else {
            $mname = "";
        }
        if ($adr11      != "") {
            $adr1      = $adr11;
        } else {
            $adr1 = "";
        }
        if ($adr22      != "") {
            $adr2      = $adr22;
        } else {
            $adr2 = "";
        }
        if ($city       != "") {
            $cities    = $city;
        } else {
            $cities = "";
        }
        if ($state      != "") {
            $states    = $state;
        } else {
            $states = "";
        }
        if ($areas      != "") {
            $area      = $areas;
        } else {
            $area = "";
        }
        if ($accno      != "") {
            $accno     = $accno;
        } else {
            $accno = "";
        }
        if ($acctype    != "") {
            $acctype   = $acctype;
        } else {
            $acctype = "";
        }
        if ($vendorname != "") {
            $vendorname = $vendorname;
        } else {
            $vendorname = "";
        }
        if ($evfdate    != "") {
            $evfdate   = date("Y-m-d", strtotime($evfdate));
        } else {
            $evfdate = "";
        }
        if ($evtdate    != "") {
            $evtdate   = date("Y-m-d", strtotime($evtdate));
        } else {
            $evtdate = "";
        }
        if ($evtype     != "") {
            $evtype    = $evtype;
        } else {
            $evtype = "";
        }
        if ($evtlocn    != "") {
            $evtlocn   = $evtlocn;
        } else {
            $evtlocn = "";
        }
        if ($evtinv_no  != "") {
            $evtinv_no = $evtinv_no;
        } else {
            $evtinv_no = "";
        }
        if ($evtreff_by != "") {
            $evtreff_by = $evtreff_by;
        } else {
            $evtreff_by = "";
        }
        if ($bal_as_of  != "") {
            $bal_as_of = $bal_as_of;
        } else {
            $bal_as_of = "";
        }
        $this->AdminModel->search_customer($fname, $lname, $cname, $zname, $mname, $adr1, $adr2, $cities, $states, $area, $accno, $acctype, $vendorname, $evfdate, $evtdate, $evtype, $evtlocn, $evtinv_no, $evtreff_by, $bal_as_of);
    }

    public function search_cust_serch()
    {
        $cus_fname = $this->input->post('fname');
        $cus_lname = $this->input->post('lname');
        $cus_cname  = $this->input->post('cname');

        if ($cus_fname != "") {
            $fname = $cus_fname;
        } else {
            $fname = "";
        }
        if ($cus_lname != "") {
            $lname = $cus_lname;
        } else {
            $lname = "";
        }
        if ($cus_cname != "") {
            $cname = $cus_cname;
        } else {
            $cname = "";
        }

        $cus_zname = $this->input->post('zname');
        if ($cus_zname != "") {
            $zname = $cus_zname;
        } else {
            $zname = "";
        }

        $cus_mname  = $this->input->post('mname');
        if ($cus_mname != "") {
            $mname = $cus_mname;
        } else {
            $mname = "";
        }

        $adr11 = $this->input->post('adr1');
        if ($adr11 != "") {
            $adr1 = $adr11;
        } else {
            $adr1 = "";
        }

        $adr22 = $this->input->post('adr2');
        if ($adr22 != "") {
            $adr2 = $adr22;
        } else {
            $adr2 = "";
        }

        $city = $this->input->post('cities');
        if ($city != "") {
            $cities = $city;
        } else {
            $cities = "";
        }

        $state = $this->input->post('states');
        if ($state != "") {
            $states = $state;
        } else {
            $states = "";
        }

        $areas = $this->input->post('areas');
        if ($areas != "") {
            $area = $areas;
        } else {
            $area = "";
        }

        $accno = $this->input->post('accno');
        if ($accno != "") {
            $accno = $accno;
        } else {
            $accno = "";
        }

        $acctype = $this->input->post('acctype');
        if ($acctype != "") {
            $acctype = $acctype;
        } else {
            $acctype = "";
        }

        $vendorname = $this->input->post('vendorname');
        if ($vendorname != "") {
            $vendorname = $vendorname;
        } else {
            $vendorname = "";
        }

        $evfdate = $this->input->post('evfdate');
        if ($evfdate != "") {
            $evfdate = date("Y-m-d", strtotime($evfdate));
        } else {
            $evfdate = "";
        }

        $evtdate = $this->input->post('evtdate');
        if ($evtdate != "") {
            $evtdate = date("Y-m-d", strtotime($evtdate));
        } else {
            $evtdate = "";
        }

        $evtype = $this->input->post('evtype');
        if ($evtype != "") {
            $evtype = $evtype;
        } else {
            $evtype = "";
        }

        $evtlocn = $this->input->post('evtlocn');
        if ($evtlocn != "") {
            $evtlocn = $evtlocn;
        } else {
            $evtlocn = "";
        }

        $evtinv_no = $this->input->post('evtinv_no');
        if ($evtinv_no != "") {
            $evtinv_no = $evtinv_no;
        } else {
            $evtinv_no = "";
        }

        $evtreff_by = $this->input->post('evtreff_by');
        if ($evtreff_by != "") {
            $evtreff_by = $evtreff_by;
        } else {
            $evtreff_by = "";
        }

        $bal_as_of = $this->input->post('bal_as_of');
        if ($bal_as_of != "") {
            $bal_as_of = $bal_as_of;
        } else {
            $bal_as_of = "";
        }

        $this->AdminModel->search_customer($fname, $lname, $cname, $zname, $mname, $adr1, $adr2, $cities, $states, $area, $accno, $acctype, $vendorname, $evfdate, $evtdate, $evtype, $evtlocn, $evtinv_no, $evtreff_by, $bal_as_of);
    }



    public function getSearchInfo()
    {
        $cName = $this->input->post('name');
        $this->session->set_userdata('id', $cName);
        $this->AdminModel->allSearchInfo($cName);
    }

    public function fnupdatesearchinfo()
    {
        $this->AdminModel->fnupdatesearchinfo_dtls();
    }







    public function Save_Notis()
    {
        $result = $this->AdminModel->Save_Notis();
    }



    public function attachment()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        } else {
            $id = $this->session->fi_session['id'];
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $tbl9 = "register_customer";
        $cond = array('user' => $id);
        $data['search'] = $this->HomeModel->get_all_by_cond($tbl9, $cond); //get_all($tbl9);

        $data['single_cust']    = $this->Attachment_Model->search_data()[0];

        if ($cus_id == '') {
            $cus_id = $this->session->userdata('id');
        }

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }

        $cus_id = $this->session->set_userdata('id', $cus_id);
        $data['cus_id']      = $cus_id;
        $data['select_customer_name'] = 'Attachments';

        $this->session->unset_userdata('event_page', '');
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/custattachments', $data);
        $this->load->view('fi/footer');
    }



    public function getSearchInvoiceInfo()
    {

        //$seleventype = $this->input->post('seleventype');
        //$this->AdminModel->getSearchInvoiceInfo_dtls();
    }





    public function c_payment()
    {
        $cus_id = $this->session->userdata('id');
        if ($cus_id == '') {
            $cus_id = $this->session->userdata('id');
        }

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }

        $data['cus_id']     = $cus_id;
        $data['alert']      = $this->session->flashdata('alert');
        $data['error']      = $this->session->flashdata('error');
        $data['success']    = $this->session->flashdata('success');
        $data['usr']        = $this->AdminModel->search_data();
        $data['single_cust'] = $this->AdminModel->search_data()[0];
        $data['email_not']  = $this->AdminModel->email_notification();

        $maxid = 0;
        $row = $this->db->query('SELECT MAX(cus_id) AS `max_id` FROM `register_customer`')->row();
        if ($row) {
            $maxid = $row->max_id;
        }
        $cust_inv1 = $this->db->query("SELECT `invoice_name`, `invoice_date`, `invoice_due_date`, `invoice_type`, `invoice_contract_type`, `invoice_discount`, `invoice_sub_total`, `invoice_tax`, `invoice_amount`, `invoice_paid`, `invoice_balance_due`, `invoice_tax_rate` FROM invoices_create WHERE `cust_id` = '$maxid'");

        $data['usrInvoices'] = $cust_inv1->result_array();
        $data['select_customer_name'] = 'Payments';

        $this->session->unset_userdata('event_page', '');
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/payment', $data);
        $this->load->view('fi/footer');
    }

    public function CustomerInvoice($pck_del = 0)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        } else {
            $id = $this->session->fi_session['id'];
        }

        $cus_id = $this->session->userdata('id');
        if ($cus_id == "") {
            $this->session->set_userdata('id', 0);
        }
        $cus_id = $this->session->userdata('id');

        if ($this->input->post('cus_id')) {
            $cus_id = $this->input->post('cus_id');
            $this->session->set_userdata('id', $cus_id);
            $cond = array('cust_id' =>  $cus_id, 'invoice_balance_due >= ' => 'invoice_paid');
            $tbl = "invoices_create";
            $result_row = $this->HomeModel->get_all_by_cond_desc($tbl, $cond, 'invoice_id');
            $this->session->set_userdata('invoice_number', $result_row[0]['invoice_id']);
        }

        if ($this->input->post('invoice_number')) {
            $invoice_number = $this->input->post('invoice_number');
            $this->session->set_userdata('invoice_number', $invoice_number);
        } else if ($this->session->userdata('invoice_number')) {

            $invoice_number = $this->session->userdata('invoice_number');
            $cond = array('cust_id' =>  $cus_id, 'invoice_id' => $invoice_number);
            $tbl = "invoices_create";
            $result_row = $this->HomeModel->get_all_by_cond_desc($tbl, $cond, 'invoice_id');

            if ($result_row[0]['invoice_id'] > 0) {
            } else {
                $cond = array('cust_id' =>  $cus_id, 'invoice_balance_due >= ' => 'invoice_paid');
                $tbl = "invoices_create";
                $result_row = $this->HomeModel->get_all_by_cond_desc($tbl, $cond, 'invoice_id');
                $this->session->set_userdata('invoice_number', $result_row[0]['invoice_id']);
            }
        } else {
        }

        if ($invoice_number == "") {
            $cond = array('cust_id' =>  $cus_id);
            $tbl = "invoices_create";
            $result_row = $this->HomeModel->get_all_by_cond($tbl, $cond);
            $this->session->set_userdata('invoice_number', $result_row[0]['invoice_id']);
        }
        $invoice_number = $this->session->userdata('invoice_number');

        if ($this->input->post('create_invoice')) {
            $myevents_register = $this->input->post('myevents_register');
            $myinvoice_contract_type = $this->input->post('myinvoice_contract_type');
            $cus_id = $this->session->userdata('id');
            $invoice_number = $this->session->userdata('invoice_number');
            $crete_new_invoice = $this->crete_new_invoice($invoice_number, $cus_id, $myevents_register, $myinvoice_contract_type);
            //print_r($crete_new_invoice);
            $this->session->set_userdata('invoice_number', $crete_new_invoice);
        }

        $invoice_number = $this->session->userdata('invoice_number');
        if ($this->input->post('button_8')) {
            $this->delete_invoice($this->input->post('button_8'));
        }

        if ($this->input->post('button_5')) {
            $invoice_tax_rate = $this->input->post('invoice_tax_rate');
            $invoice_county = $this->input->post('invoice_county');
            $event_id = $this->input->post('event_id');
            $invoice_number = $this->input->post('button_5');
            $invoice_date = $this->input->post('invoice_date');
            $invoice_due_date = $this->input->post('invoice_due_date');
            $invoice_contract_type = $this->input->post('invoice_contract_type');
            $invoice_discount = $this->input->post('invoice_discount');
            $discounted_amt = $this->input->post('discounted_amt');
            $this->invoice_discount($invoice_tax_rate, $invoice_county, $invoice_number, $invoice_discount, $discounted_amt, $invoice_date, $invoice_due_date, $invoice_contract_type, $event_id);
        }

        if ($this->input->post('button_7')) {
            $button_7 = $this->input->post('button_7');
            $item_quantity = $this->input->post('item_quantity' . $button_7);
            $item_name = $this->input->post('item_name' . $button_7);
            $item_discount = $this->input->post('item_discount' . $button_7);
            $item_discnt_amt = $this->input->post('item_discnt_amt' . $button_7);
            $this->item_discount($this->session->userdata('invoice_number'), $button_7, $item_quantity,  $item_discount, $item_name, $item_discnt_amt);
        }

        if ($this->input->post('button_6')) {
            $button_6 = $this->input->post('button_6');
            $pck_discount = $this->input->post('pck_discount' . $button_6);
            $quantity = $this->input->post('quantity' . $button_6);
            $pck_discnt_amt = $this->input->post('pck_discnt_amt' . $button_6);
            $this->package_discount($this->session->userdata('invoice_number'), $button_6, $pck_discount, $pck_discnt_amt, $quantity);
        }

        if ($this->input->post('button_3')) {
            $itemId = $this->input->post('itemId');
            $item_quantity = $this->input->post('item_quantity');
            $res = $this->add_item_invoice($cus_id, $invoice_number, $itemId, $item_quantity);
        }

        if ($this->input->post('button_4')) {
            $itemId = $this->input->post('button_4');
            $res = $this->delete_item_invoice($cus_id, $invoice_number, $itemId);
        }

        if ($this->input->post('button_1') == 1) {
            $item_package_name = $this->input->post('item_package_name');
            if ($item_package_name == '') {
            } else {
                if ($invoice_number > 0) {
                    $res = $this->add_package_invoice($item_package_name, $invoice_number, $cus_id);
                } else {
                    $data['alert']    = $this->session->flashdata('alert');
                }
            }
        }

        if ($this->input->post('button_2') > 0) {
            $item_package_name = $this->input->post('button_2');
            $res = $this->delete_package_invoice($item_package_name, $invoice_number, $cus_id);
        }

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
            $data['name'] = "Choose";
            $data['mobile'] = '-';
            $data['account'] = '-';
            $data['balance'] = '$0';
        }

        if ($cus_id > 0) {
            $cond = array('cus_id' =>  $cus_id);
            $tbl = "register_customer";
            $result_row = $this->HomeModel->get_all_by_cond($tbl, $cond);

            $cond2 = array('cus_id' =>  $cus_id);
            $tbl2 = "user_contact_info";
            $result_row2 = $this->HomeModel->get_all_by_cond($tbl2, $cond2);

            $tbl3 = 'invoices_create';
            $cond3 = array('cust_id' =>  $cus_id);
            $result_row3 = $this->HomeModel->cus_invoice_balance_due($tbl3, $cond3);

            $cond4 = array('cust_id' =>  $cus_id, 'invoice_balance_due !=' => 0);
            $cond42 = array('cust_id' =>  $cus_id, 'invoice_balance_due' => 0);
            $tbl4 = "invoices_create";
            $orderid = "invoice_date";
            $invoices_create = $this->HomeModel->get_all_by_cond_desc($tbl4, $cond4, $orderid);
            $invoices_create2 = $this->HomeModel->get_all_by_cond_desc($tbl4, $cond42, $orderid);

            $cond5 = array('cus_id' =>  $cus_id);
            $tbl5 = 'events_register';
            $events_register = $this->HomeModel->get_all_by_cond($tbl5, $cond5);
            /*----------------------------------------------------------------------------------------------------------------------------------------*/

            $cond6 = array('cus_id' =>  $cus_id);
            $tbl6 = 'register_customer';
            $register_customer = $this->HomeModel->get_all_by_cond($tbl6, $cond6);

            $cond7 = array('cat_id' =>  35);
            $tbl7 = 'sub_categories';
            $sub_categories = $this->HomeModel->get_all_by_cond($tbl7, $cond7);

            $tbl8 = 'county';
            $county = $this->HomeModel->get_all($tbl8);

            $data['name'] = $result_row[0]['cus_lname'] . ", " . $result_row[0]['cus_fname'] . " - " . $result_row[0]['cus_address1'];
            $data['mobile'] = $result_row2[0]['contact_no'];
            $data['account'] = $result_row[0]['cus_acc_no'];
            $data['balance'] = $result_row3[0]['total'];

            $data['invoices_create'] = $invoices_create;
            $data['invoices_create2'] = $invoices_create2;
            $data['events_register'] = $events_register;
            $data['register_customer'] = $register_customer;
            $data['sub_categories'] = $sub_categories;
            $data['county'] = $county;
        }

        $tbl9 = "register_customer";
        $cond = array('user' => $id);
        $data['all_customer'] = $this->HomeModel->get_all_by_cond($tbl9, $cond); //get_all($tbl9);
        $data['invoice_number'] = $this->session->userdata('invoice_number');
        $data['cus_id'] = $this->session->userdata('id');
        $data['select_customer_name'] = 'Invoices';

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/header_2');
        $this->load->view('fi/customer/CustomerInvoice', $data);
        $this->load->view('fi/footer');
    }







    /*New Customer Add method*/
    public function addcoustomer()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        if (isset($_POST['Save'])) {

            $custregsql = $this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC LIMIT 1");
            $custregsqlrow = $custregsql->row();

            $str = $custregsqlrow->cus_id; //+1;
            $strlength = 7;
            $str_pad = 0;
            $asgnnwacno = str_pad(intval($str) + 1, $strlength, $str_pad, STR_PAD_LEFT);

            $data['cus_title']          = $this->input->post('title');
            $data['cus_fname']          = $this->input->post('cus_fname');
            $data['cus_lname']          = $this->input->post('cus_lname');
            $data['cus_company_name']   = $this->input->post('cus_com');
            $data['cus_address1']       = $this->input->post('cus_address1');
            $data['cus_address2']       = $this->input->post('cus_address2');
            $data['cus_city']           = $this->input->post('cus_city');
            $data['cus_state']          = $this->input->post('cus_state');
            $data['cus_zip']            = $this->input->post('cus_zip');
            $data['cus_area']           = $this->input->post('cus_area');
            $data['cus_tax_status']     = $this->input->post('tax_status');
            $data['cus_tax_id']         = $this->input->post('cus_tax_id');
            $data['user']               = $this->session->fi_session['id'];
            $data['cus_acc_no']         = $asgnnwacno;


            $cus_id = $this->AdminModel->addcoustomer($data);

            if ($cus_id > 0) {
                $address['ship_user_id']        = $cus_id;
                $address['ship_address1']       = $this->input->post('cus_ship_address1');
                $address['ship_address2']       = $this->input->post('cus_ship_address2');
                $address['ship_city']           = $this->input->post('cus_ship_city');
                $address['ship_state']          = $this->input->post('cus_ship_state');
                $address['ship_zip']            = $this->input->post('cus_ship_zip');
                $address['billing_addr_status'] = $this->input->post('billaddr');
                $address['ship_cusname']        = $this->input->post('shipcusname');

                // $address['ship_area']                    = $this->input->post('cus_ship_area');

                $this->AdminModel->addshipaddress($address);


                //for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
                for ($i = 0; $i < count($this->input->post('cus_contact_type')); $i++) {

                    if ($this->input->post('cus_contact_type')[$i] != "") {

                        $contact['cus_id']              = $cus_id;
                        $contact['conatct_type']        = $this->input->post('cus_contact_type')[$i];
                        //$contact['conatct_type']      = "Home";
                        $contact['contact_no']          = $this->input->post('cus_contact_no')[$i];
                        $contact['user_contact_note']   = $this->input->post('cus_note')[$i];

                        if (isset($this->input->post('radio_click[]')[$i]) && $this->input->post('radio_click[]')[$i] != "") {
                            $b = "on";
                        } else {
                            $b = "off";
                        }

                        if (isset($b) && $b == 'on') {
                            $contact['default_contact'] = 1;
                        } else {
                            $contact['default_contact'] = 0;
                        }

                        $result = $this->AdminModel->addcontactdata($contact);
                    }
                }

                //for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
                for ($j = 0; $j < count($this->input->post('cuscnt_type_email')); $j++) {

                    if ($this->input->post('cuscnt_type_email')[$j] != "") {

                        $contact1['cus_id']         =   $cus_id;
                        //$contact1['conatct_type'] =   "Email";
                        $contact1['conatct_type']   =   $this->input->post('cuscnt_type_email')[$j];
                        $contact1['email']          =   $this->input->post('txtemail')[$j];

                        if (isset($this->input->post('email_radio_click[]')[$j]) && $this->input->post('email_radio_click[]')[$j] != "") {
                            $b = "on";
                        } else {
                            $b = "off";
                        }
                        if (isset($b) && $b == 'on') {
                            $contact1['default_contact'] = 1;
                        } else {
                            $contact1['default_contact'] = 0;
                        }
                        $result = $this->AdminModel->addcontactdata($contact1);
                    }
                }

                //for ($k=0; $k < count($this->input->post('adcntype')) ; $k++) {
                for ($k = 0; $k < count($this->input->post('name')); $k++) {

                    if ($this->input->post('name')[$k] != "") {

                        $contact2['cus_id']    =   $cus_id;
                        //$contact2['con_type']    =   $this->input->post('adcntype');
                        $contact2['type']  =   $this->input->post('job_type')[$k];
                        $contact2['name']  =   $this->input->post('name')[$k];
                        $contact2['address']   =   $this->input->post('address')[$k];
                        $contact2['city']  =   $this->input->post('city')[$k];
                        $contact2['state'] =   $this->input->post('state')[$k];
                        $contact2['zip']   =   $this->input->post('zip')[$k];
                        $contact2['home']  =   $this->input->post('home')[$k];
                        $contact2['cel']   =   $this->input->post('cel')[$k];
                        $contact2['work']  =   $this->input->post('work')[$k];
                        $contact2['email'] =   $this->input->post('emailaddr')[$k];

                        $result = $this->AdminModel->additionalcontactdata($contact2);
                    }
                }

                $chkinvexitssql = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $cus_id . "'");
                $isninrows = $chkinvexitssql->num_rows();

                if ($isninrows == 0) {
                    $company_tax_rate_query = $this->db->query("SELECT  company_tax_rate FROM company_info WHERE 1");
                    $company_tax_rate_res = $company_tax_rate_query->result();

                    $postinvarr = array(
                        //"invoice_id" => $chkinvsql_dtls->invoice_id+1,
                        "cust_id"           => $cus_id,
                        "invoice_name"      => "new_invoice",
                        "invoice_date"      => date('Y-m-d'),
                        "invoice_status"    => 0,
                        "invoice_tax_rate"  => $company_tax_rate_res[0]->company_tax_rate
                    );

                    /*if($this->db->insert('invoices_create',$postinvarr))
                        {
                            $lstinvId=$this->db->insert_id();
                            $postinvnoarr=array(
                                "inv_id" => $lstinvId,
                            );
                            $this->db->insert('invoice_terms',$postinvnoarr);
                        }*/
                }

                $chkattchexitssql = $this->db->query("SELECT * FROM cus_attachment WHERE cust_id='" . $cus_id . "'");
                $isnattchrows = $chkattchexitssql->num_rows();

                if ($isnattchrows == 0) {
                    $postattchvarr = array(
                        "cust_id" => $cus_id,
                    );
                    $this->db->insert('cus_attachment', $postattchvarr);
                }
                $this->session->set_userdata('nwcus_id', $cus_id);
                $this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
                redirect('fi_home/generalinfo');
            }
        } else if (isset($_POST['Submit'])) {

            $custregsqlq    = $this->db->query("SELECT * FROM register_customer ORDER BY cus_id DESC LIMIT 1");
            $custregsqlrows = $custregsqlq->row();
            $str        = $custregsqlrows->cus_acc_no;
            $strlength  = 7;
            $str_pad    = 0;
            $asgnnwacno = str_pad(intval($str) + 1, $strlength, $str_pad, STR_PAD_LEFT);

            $data['cus_title']          = $this->input->post('title');
            $data['cus_fname']          = $this->input->post('cus_fname');
            $data['cus_lname']          = $this->input->post('cus_lname');
            $data['cus_company_name']   = $this->input->post('cus_com');
            $data['cus_address1']       = $this->input->post('cus_address1');
            $data['cus_address2']       = $this->input->post('cus_address2');
            $data['cus_city']           = $this->input->post('cus_city');
            $data['cus_state']          = $this->input->post('cus_state');
            $data['cus_zip']            = $this->input->post('cus_zip');
            $data['cus_area']           = $this->input->post('cus_area');
            $data['cus_tax_status']     = $this->input->post('tax_status');
            $data['cus_tax_id']         = $this->input->post('cus_tax_id');
            $data['user']               = $this->session->fi_session['id'];
            $data['cus_acc_no']         = $asgnnwacno;

            $cus_id = $this->AdminModel->addcoustomer($data);
            if ($cus_id > 0) {
                $address['ship_user_id']        = $cus_id;
                $address['ship_address1']       = $this->input->post('cus_ship_address1');
                $address['ship_address2']       = $this->input->post('cus_ship_address2');
                $address['ship_city']           = $this->input->post('cus_ship_city');
                $address['ship_state']          = $this->input->post('cus_ship_state');
                $address['ship_zip']            = $this->input->post('cus_ship_zip');
                $address['billing_addr_status'] = $this->input->post('billaddr');
                $address['ship_cusname']        = $this->input->post('shipcusname');
                // $address['ship_area']                    = $this->input->post('cus_ship_area');
                $this->AdminModel->addshipaddress($address);

                //for ($i=0; $i < count($this->input->post('cus_contact_no')) ; $i++) {
                for ($i = 0; $i < count($this->input->post('cus_contact_type')); $i++) {
                    if ($this->input->post('cus_contact_type')[$i] != "") {
                        $contact['cus_id']              =   $cus_id;
                        $contact['conatct_type']        =   $this->input->post('cus_contact_type')[$i];
                        //$contact['conatct_type']      =   "Home";
                        $contact['contact_no']          =   $this->input->post('cus_contact_no')[$i];
                        $contact['user_contact_note']   =   $this->input->post('cus_note')[$i];

                        if (isset($this->input->post('radio_click[]')[$i]) && $this->input->post('radio_click[]')[$i] != "") {
                            $b = "on";
                        } else {
                            $b = "off";
                        }

                        if (isset($b) && $b == 'on') {
                            $contact['default_contact'] = 1;
                        } else {
                            $contact['default_contact'] = 0;
                        }
                        $result = $this->AdminModel->addcontactdata($contact);
                    }
                }

                //for ($j=0; $j < count($this->input->post('txtemail')) ; $j++) {
                for ($j = 0; $j < count($this->input->post('cuscnt_type_email')); $j++) {
                    if ($this->input->post('cuscnt_type_email')[$j] != "") {
                        $contact1['cus_id']    =   $cus_id;
                        //$contact1['conatct_type']    =   "Email";
                        $contact1['conatct_type']  =   $this->input->post('cuscnt_type_email')[$j];
                        $contact1['email'] =   $this->input->post('txtemail')[$j];
                        if (isset($this->input->post('email_radio_click[]')[$j]) && $this->input->post('email_radio_click[]')[$j] != "") {
                            $b = "on";
                        } else {
                            $b = "off";
                        }

                        if (isset($b) && $b == 'on') {
                            $contact1['default_contact'] = 1;
                        } else {
                            $contact1['default_contact'] = 0;
                        }
                        $result = $this->AdminModel->addcontactdata($contact1);
                    }
                }


                //for ($k=0; $k < count($this->input->post('adcntype')) ; $k++) {
                for ($k = 0; $k < count($this->input->post('name')); $k++) {

                    if ($this->input->post('name')[$k] != "") {

                        $contact2['cus_id']    =   $cus_id;
                        //$contact2['con_type']    =   $this->input->post('adcntype');
                        $contact2['name']  =   $this->input->post('name')[$k];
                        $contact2['address']   =   $this->input->post('address')[$k];
                        $contact2['city']  =   $this->input->post('city')[$k];
                        $contact2['state'] =   $this->input->post('state')[$k];
                        $contact2['zip']   =   $this->input->post('zip')[$k];
                        $contact2['home']  =   $this->input->post('home')[$k];
                        $contact2['cel']   =   $this->input->post('cel')[$k];
                        $contact2['work']  =   $this->input->post('work')[$k];
                        $contact2['email'] =   $this->input->post('emailaddr')[$k];

                        $result = $this->AdminModel->additionalcontactdata($contact2);
                    }
                }


                $chkinvexitssql = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $cus_id . "'");
                $isninrows = $chkinvexitssql->num_rows();

                if ($isninrows == 0) {
                    $postinvarr = array(
                        //"invoice_id" => $chkinvsql_dtls->invoice_id+1,
                        "cust_id" => $cus_id,
                        "invoice_name" => "new_invoice",
                        "invoice_date" => date('Y-m-d'),
                        "invoice_status" => 0
                    );
                    /*if($this->db->insert('invoices_create',$postinvarr))
                      {
                           $lstinvId=$this->db->insert_id();
                           $postinvnoarr=array(
                            "inv_id" => $lstinvId,
                           );
                            $this->db->insert('invoice_terms',$postinvnoarr);
                      }*/
                }



                $chkattchexitssql = $this->db->query("SELECT * FROM cus_attachment WHERE cust_id='" . $cus_id . "'");
                $isnattchrows = $chkattchexitssql->num_rows();

                if ($isnattchrows == 0) {
                    $postattchvarr = array(
                        "cust_id" => $cus_id,
                    );
                    $this->db->insert('cus_attachment', $postattchvarr);
                }


                $this->session->set_userdata('nwcus_id', $cus_id);
                $this->session->set_userdata('id', $cus_id);

                $this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
                redirect('fi_home/custevents');
            }
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong..!');
            redirect('fi_home/generalinfo');
        }
    }

    public function newGeneralInfo()
    {
        if ($cus_id == '') {
            $cus_id = $this->session->userdata('id');
        }
        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }
        $this->session->set_userdata('id', $cus_id);
        $data['cus_id']      = $cus_id;
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['contact']  = $this->db->where('cat_id', 1)->get('sub_categories')->result_array();
        //$data['event_name'] = $this->db->where('cat_id',3)->get('sub_categories')->result_array();
        //$data['event_name'] = $this->db->order_by('cus_id',"desc")->get('events_register')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/new_custgeneralinfo', $data);
        $this->load->view('fi/footer');
    }

    public function addeventinfo()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        if (isset($_POST['Save'])) {
            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('event_location')) {
                for ($i = 0; $i < count($this->input->post('add_location')); $i++) {
                    if ($this->input->post('add_location')[$i] != "" || $this->input->post('ddate')[$i] != "") {
                        if ($this->input->post('add_location')[$i] != 'Choose') {
                            $location['event_id']   = $this->input->post('hdneventId'); //$result;
                            $location['location_type']  =   $this->input->post('add_location')[$i];
                            $location['location_date']  =   date("Y-m-d", strtotime($this->input->post('ddate')[$i]));
                            $location['location_time']  =   $this->input->post('time')[$i];
                            $location['location_address'] =  $this->input->post('address')[$i];
                            $location['location_city'] = $this->input->post('city')[$i];
                            $location['location_state'] =    $this->input->post('state')[$i];
                            $location['location_zip'] =  $this->input->post('zip')[$i];
                            $location['location_phone'] =    $this->input->post('phone')[$i];
                            $location['location_phone2'] =   $this->input->post('phone2')[$i];
                            //$location['location_landmark']=   $this->input->post('landmark')[$i];
                            $location['location_note'] = $this->input->post('note')[$i];

                            $result1 = $this->AdminModel->insertlocation($location);
                        }
                    }
                }
            }

            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('event_crews')) {
            }

            for ($i = 0; $i < count($this->input->post('confirmed_on')); $i++) {
                if ($this->input->post('crewstype')[$i] != "") {
                    $crew['event_id']           = $this->input->post('hdneventId'); //$result;
                    $crew['crews_confirmed_on'] = date("Y-m-d", strtotime($this->input->post('confirmed_on')[$i]));
                    $crew['crews_type']         = explode("-", $this->input->post('crewstype')[$i]);
                    $crew['crews_type']         = $crew['crews_type'][0];
                    $crew['crews_vendor']       = $this->input->post('vendortype')[$i];
                    $crew1['crews_commited']    = $this->input->post('commited')[$i];
                    if ($crew1['crews_commited'] == 'on') {
                        $crew['crews_commited'] = 1;
                    } else {
                        $crew['crews_commited'] = 0;
                    }
                    $crew2['crews_hide'] =   $this->input->post('hide')[$i];
                    if ($crew2['crews_hide'] == 'on') {
                        $crew['crews_hide'] = 1;
                    } else {
                        $crew['crews_hide'] = 0;
                    }
                    $crew['crews_start_date'] =  date("Y-m-d", strtotime($this->input->post('start_date')[$i]));
                    $crew['crews_start_time'] =  $this->input->post('start_time')[$i];
                    $crew['crews_ending'] =  $this->input->post('ending')[$i];
                    $crew['crews_over_time'] =   $this->input->post('over_time')[$i];
                    $crew['crews_location'] =    $this->input->post('location')[$i];
                    $crew['crews_end_date'] =    date("Y-m-d", strtotime($this->input->post('end_date')[$i]));
                    $crew['crews_end_time'] =    $this->input->post('end_time')[$i];
                    $crew['crews_total_hours'] = $this->input->post('total_hours')[$i];
                    $crew['crews_total_charge'] =    $this->input->post('total_charge')[$i];
                    $result2 = $this->AdminModel->insertcrew($crew);
                }
            }

            $sqlupevntname = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $this->input->post('hdneventId') . "' ORDER BY jb_id DESC LIMIT 2");
            $upevnamenrow = $sqlupevntname->num_rows();
            if ($upevnamenrow > 0) {
                $cntname = "";
                foreach ($sqlupevntname->result() as $sqlupevntname_dtls) {
                    $cntname .= $sqlupevntname_dtls->jb_name . "-";
                }

                $upcntname = rtrim($cntname);
                $upevntnamearr = array(
                    "event_name" => $upcntname
                );
                $this->db->where('event_id', $this->input->post('hdneventId'));
                $this->db->update('events_register', $upevntnamearr);
            }

            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('crew_availability')) {
                $crw = array();
                for ($i = 0; $i < count($this->input->post('atype')); $i++) {
                    if ($this->input->post('atype')[$i] != "" && $this->input->post('atype')[$i] != "Choose") {
                        $data_a['event_id'] = $this->input->post('hdneventId'); //$result;
                        $data_a['type'] =   $this->input->post('atype')[$i];
                        $data_a['vendor']   =   $this->input->post('cavailvend')[$i];
                        $data_a['start_date']   =   date("Y-m-d", strtotime($this->input->post('castart_date')[$i]));
                        $data_a['start_time'] =  $this->input->post('caastart_time')[$i];
                        $data_a['status'] =  $this->input->post('caastatus')[$i];
                        $data_a['note'] =    $this->input->post('canote')[$i];
                        //$data_a['email_availability']=    $this->input->post('email_availability')[$i];
                        //$data_a['add_to_crews']=   $this->input->post('add_to_crews')[$i];
                        $data_a1['add_to_crews'] =   $this->input->post('add_to_crews')[$i];

                        if ($data_a1['add_to_crews'] == 'on') {
                            $data_a['add_to_crews'] = 1;
                        } else {
                            $data_a['add_to_crews'] = 0;
                        }

                        $result4 = $this->AdminModel->insertcrew_availability($data_a);
                    }
                }

                //crew_availability
                $crwavailsql = $this->db->query("SELECT * FROM crew_availability WHERE add_to_crews=1 AND event_id='" . $this->input->post('hdneventId') . "'");

                foreach ($crwavailsql->result() as $crwavailsql_dtls) {
                    if ($crwavailsql_dtls->type != "") {
                        $crwinsertarr = array();

                        $crwinsertarr = array(
                            "event_id" => $crwavailsql_dtls->event_id,
                            "crews_type" => $crwavailsql_dtls->type,
                            "crews_vendor" => $crwavailsql_dtls->vendor,
                            "crews_start_date" => $crwavailsql_dtls->start_date,
                            "crews_start_time" => $crwavailsql_dtls->start_time,
                            "user" => $this->session->fi_session['id']
                        );
                        $this->db->insert('event_crews', $crwinsertarr);
                    }
                }
                $deleted = $this->db->where('add_to_crews', 1)
                    ->where('event_id', $this->input->post('hdneventId'))
                    ->delete('crew_availability');
            }

            $this->session->set_flashdata('success', "Event Updated Successfully..!! ");
            redirect('fi_home/search_new_cus');
        } else if (isset($_POST['Submit'])) {
            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('event_location')) {
                for ($i = 0; $i < count($this->input->post('add_location')); $i++) {
                    if ($this->input->post('add_location')[$i] != "" || $this->input->post('ddate')[$i] != "") {
                        if ($this->input->post('add_location')[$i] != 'Choose') {

                            $location['event_id']   = $this->input->post('hdneventId'); //$result;
                            $location['location_type']  =   $this->input->post('add_location')[$i];
                            $location['location_date']  =   date("Y-m-d", strtotime($this->input->post('ddate')[$i]));
                            $location['location_time']  =   $this->input->post('time')[$i];
                            $location['location_address'] =  $this->input->post('address')[$i];
                            $location['location_city'] = $this->input->post('city')[$i];
                            $location['location_state'] =    $this->input->post('state')[$i];
                            $location['location_zip'] =  $this->input->post('zip')[$i];
                            $location['location_phone'] =    $this->input->post('phone')[$i];
                            $location['location_phone2'] =   $this->input->post('phone2')[$i];
                            //$location['location_landmark']=   $this->input->post('landmark')[$i];
                            $location['location_note'] = $this->input->post('note')[$i];

                            $result1 = $this->AdminModel->insertlocation($location);
                        }
                    }
                }
            }

            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('event_crews')) {
                for ($i = 0; $i < count($this->input->post('confirmed_on')); $i++) {
                    if ($this->input->post('crewstype')[$i] != "") {


                        $crew['event_id']   = $this->input->post('hdneventId'); //$result;
                        $crew['crews_confirmed_on'] =   date("Y-m-d", strtotime($this->input->post('confirmed_on')[$i]));
                        $crew['crews_type'] =   $this->input->post('crewstype')[$i];
                        $crew['crews_vendor']   =   $this->input->post('vendortype')[$i];
                        $crew1['crews_commited']    =   $this->input->post('commited')[$i];
                        if ($crew1['crews_commited'] == 'on') {
                            $crew['crews_commited'] = 1;
                        } else {
                            $crew['crews_commited'] = 0;
                        }
                        $crew2['crews_hide'] =   $this->input->post('hide')[$i];
                        if ($crew2['crews_hide'] == 'on') {
                            $crew['crews_hide'] = 1;
                        } else {
                            $crew['crews_hide'] = 0;
                        }
                        $crew['crews_start_date'] =  date("Y-m-d", strtotime($this->input->post('start_date')[$i]));
                        $crew['crews_start_time'] =  $this->input->post('start_time')[$i];
                        $crew['crews_ending'] =  $this->input->post('ending')[$i];
                        $crew['crews_over_time'] =   $this->input->post('over_time')[$i];
                        $crew['crews_location'] =    $this->input->post('location')[$i];
                        $crew['crews_end_date'] =    date("Y-m-d", strtotime($this->input->post('end_date')[$i]));
                        $crew['crews_end_time'] =    $this->input->post('end_time')[$i];
                        $crew['crews_total_hours'] = $this->input->post('total_hours')[$i];
                        $crew['crews_total_charge'] =    $this->input->post('total_charge')[$i];

                        $result2 = $this->AdminModel->insertcrew($crew);
                    }
                }
            }

            $sqlupevntname = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $this->input->post('hdneventId') . "' ORDER BY jb_id DESC LIMIT 2");
            $upevnamenrow = $sqlupevntname->num_rows();
            if ($upevnamenrow > 0) {
                $cntname = "";
                foreach ($sqlupevntname->result() as $sqlupevntname_dtls) {
                    $cntname .= $sqlupevntname_dtls->jb_name . "-";
                }

                $upcntname = rtrim($cntname);
                $upevntnamearr = array(
                    "event_name" => $upcntname
                );
                $this->db->where('event_id', $this->input->post('hdneventId'));
                $this->db->update('events_register', $upevntnamearr);
            }

            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('crew_availability')) {
                $crw = array();
                for ($i = 0; $i < count($this->input->post('atype')); $i++) {

                    if ($this->input->post('atype')[$i] != "") {

                        $data_a['event_id'] = $this->input->post('hdneventId'); //$result;
                        $data_a['type'] =   $this->input->post('atype')[$i];
                        $data_a['vendor']   =   $this->input->post('cavailvend')[$i];
                        $data_a['start_date']   =   date("Y-m-d", strtotime($this->input->post('castart_date')[$i]));
                        $data_a['start_time'] =  $this->input->post('caastart_time')[$i];
                        $data_a['status'] =  $this->input->post('caastatus')[$i];
                        $data_a['note'] =    $this->input->post('canote')[$i];
                        //$data_a['email_availability']=    $this->input->post('email_availability')[$i];
                        //$data_a['add_to_crews']=   $this->input->post('add_to_crews')[$i];
                        $data_a1['add_to_crews'] =   $this->input->post('add_to_crews')[$i];
                        if ($data_a1['add_to_crews'] == 'on') {
                            $data_a['add_to_crews'] = 1;
                        } else {
                            $data_a['add_to_crews'] = 0;
                        }

                        $result4 = $this->AdminModel->insertcrew_availability($data_a);
                    }
                }

                //crew_availability
                $crwavailsql = $this->db->query("SELECT * FROM crew_availability WHERE add_to_crews=1 AND event_id='" . $this->input->post('hdneventId') . "'");

                foreach ($crwavailsql->result() as $crwavailsql_dtls) {
                    if ($crwavailsql_dtls->type != "") {
                        $crwinsertarr = array();

                        $crwinsertarr = array(
                            "event_id" => $crwavailsql_dtls->event_id,
                            "crews_type" => $crwavailsql_dtls->type,
                            "crews_vendor" => $crwavailsql_dtls->vendor,
                            "crews_start_date" => $crwavailsql_dtls->start_date,
                            "crews_start_time" => $crwavailsql_dtls->start_time,
                            "user" => $this->session->fi_session['id']
                        );
                        $this->db->insert('event_crews', $crwinsertarr);
                    }
                }
                $deleted = $this->db->where('add_to_crews', 1)
                    ->where('event_id', $this->input->post('hdneventId'))
                    ->delete('crew_availability');
            }
            $this->session->set_flashdata('success', "Event Updated Successfully..!! ");
            redirect('fi_home/CustomerInvoice');
        } else {

            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('event_location')) {

                for ($i = 0; $i < count($this->input->post('add_location')); $i++) {


                    if ($this->input->post('add_location')[$i] != "" || $this->input->post('ddate')[$i] != "") {

                        if ($this->input->post('add_location')[$i] != 'Choose') {

                            $location['event_id']  = $this->input->post('hdneventId'); //$result;
                            $location['location_type'] =   $this->input->post('add_location')[$i];
                            $location['location_date'] =   date("Y-m-d", strtotime($this->input->post('ddate')[$i]));
                            $location['location_time'] =   $this->input->post('time')[$i];
                            $location['location_address'] = $this->input->post('address')[$i];
                            $location['location_city'] =    $this->input->post('city')[$i];
                            $location['location_state'] =   $this->input->post('state')[$i];
                            $location['location_zip'] = $this->input->post('zip')[$i];
                            $location['location_phone'] =   $this->input->post('phone')[$i];
                            $location['location_phone2'] =  $this->input->post('phone2')[$i];
                            //$location['location_landmark']=  $this->input->post('landmark')[$i];
                            $location['location_note'] =    $this->input->post('note')[$i];

                            $result1 = $this->AdminModel->insertlocation($location);
                        }
                    }
                }
            }


            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('event_crews')) {
                for ($i = 0; $i < count($this->input->post('confirmed_on')); $i++) {
                    if ($this->input->post('crewstype')[$i] != "") {
                        $crew['event_id']  = $this->input->post('hdneventId');
                        $crew['crews_confirmed_on']    =   date("Y-m-d", strtotime($this->input->post('confirmed_on')[$i]));
                        $crew['crews_type']    =   $this->input->post('crewstype')[$i];
                        $crew['crews_vendor']  =   $this->input->post('vendortype')[$i];
                        $crew1['crews_commited']   =   $this->input->post('commited')[$i];
                        if ($crew1['crews_commited'] == 'on') {
                            $crew['crews_commited'] = 1;
                        } else {
                            $crew['crews_commited'] = 0;
                        }
                        $crew2['crews_hide'] =  $this->input->post('hide')[$i];
                        if ($crew2['crews_hide'] == 'on') {
                            $crew['crews_hide'] = 1;
                        } else {
                            $crew['crews_hide'] = 0;
                        }
                        $crew['crews_start_date'] = date("Y-m-d", strtotime($this->input->post('start_date')[$i]));
                        $crew['crews_start_time'] = $this->input->post('start_time')[$i];
                        $crew['crews_ending'] = $this->input->post('ending')[$i];
                        $crew['crews_over_time'] =  $this->input->post('over_time')[$i];
                        $crew['crews_location'] =   $this->input->post('location')[$i];
                        $crew['crews_end_date'] =   date("Y-m-d", strtotime($this->input->post('end_date')[$i]));
                        $crew['crews_end_time'] =   $this->input->post('end_time')[$i];
                        $crew['crews_total_hours'] =    $this->input->post('total_hours')[$i];
                        $crew['crews_total_charge'] =   $this->input->post('total_charge')[$i];

                        $result2 = $this->AdminModel->insertcrew($crew);
                    }
                }
            }

            $sqlupevntname = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $this->input->post('hdneventId') . "' ORDER BY jb_id DESC LIMIT 2");
            $upevnamenrow = $sqlupevntname->num_rows();
            if ($upevnamenrow > 0) {
                $cntname = "";
                foreach ($sqlupevntname->result() as $sqlupevntname_dtls) {
                    $cntname .= $sqlupevntname_dtls->jb_name . "-";
                }

                $upcntname = rtrim($cntname);
                $upevntnamearr = array(
                    "event_name" => $upcntname
                );
                $this->db->where('event_id', $this->input->post('hdneventId'));
                $this->db->update('events_register', $upevntnamearr);
            }

            $this->db->where("event_id", $this->input->post('hdneventId'));
            if ($this->db->delete('crew_availability')) {
                $crw = array();
                for ($i = 0; $i < count($this->input->post('atype')); $i++) {
                    if ($this->input->post('atype')[$i] != "") {

                        $data_a['event_id']    = $this->input->post('hdneventId'); //$result;
                        $data_a['type']    =   $this->input->post('atype')[$i];
                        $data_a['vendor']  =   $this->input->post('cavailvend')[$i];
                        $data_a['start_date']  =   date("Y-m-d", strtotime($this->input->post('castart_date')[$i]));
                        $data_a['start_time'] = $this->input->post('caastart_time')[$i];
                        $data_a['status'] = $this->input->post('caastatus')[$i];
                        $data_a['note'] =   $this->input->post('canote')[$i];
                        //$data_a['email_availability']=   $this->input->post('email_availability')[$i];
                        //$data_a['add_to_crews']=  $this->input->post('add_to_crews')[$i];
                        $data_a1['add_to_crews'] =  $this->input->post('add_to_crews')[$i];
                        if ($data_a1['add_to_crews'] == 'on') {
                            $data_a['add_to_crews'] = 1;
                        } else {
                            $data_a['add_to_crews'] = 0;
                        }
                        // echo "<pre>";print_r($data_a);die;
                        $result4 = $this->AdminModel->insertcrew_availability($data_a);
                        // print_r($result4);die;
                    }
                } //for end

                //crew_availability
                $crwavailsql = $this->db->query("SELECT * FROM crew_availability WHERE add_to_crews=1 AND event_id='" . $this->input->post('hdneventId') . "'");
                foreach ($crwavailsql->result() as $crwavailsql_dtls) {
                    if ($crwavailsql_dtls->type != "") {
                        $crwinsertarr = array();

                        $crwinsertarr = array(
                            "event_id" => $crwavailsql_dtls->event_id,
                            "crews_type" => $crwavailsql_dtls->type,
                            "crews_vendor" => $crwavailsql_dtls->vendor,
                            "crews_start_date" => $crwavailsql_dtls->start_date,
                            "crews_start_time" => $crwavailsql_dtls->start_time,
                            "user" => $this->session->fi_session['id']
                        );
                        $this->db->insert('event_crews', $crwinsertarr);
                    }
                }
                $deleted = $this->db->where('add_to_crews', 1)
                    ->where('event_id', $this->input->post('hdneventId'))
                    ->delete('crew_availability');
            }
        }
    }

    public function delete_invoice($invoiceid)
    {

        $tbl = 'invoices_create';
        $cond = array('invoice_id' => $invoiceid);
        $res = $this->HomeModel->delete_data($tbl, $cond);

        $tbl = 'customers_package_items';
        $cond = array('inv_id' => $invoiceid);
        $res1 = $this->HomeModel->delete_data($tbl, $cond);

        $tbl = 'customer_assigned_packages';
        $cond = array('inv_id' => $invoiceid);
        $res1 = $this->HomeModel->delete_data($tbl, $cond);

        return true;
    }

    public function calculate_invoice_level($invoice_number = 0, $cus_id = 0)
    {
        $cond = array('inv_id' =>  $invoice_number, 'package_id' => NULL);
        $tbl = "customers_package_items";
        $customers_package_items = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $total_price_all = 0;
        $item_discnt_amt_finale_all = 0;
        $sub_total_all = 0;

        foreach ($customers_package_items as $row) {
            $item_quantity = $row['item_quantity'];
            $item_price = $row['item_price'];
            $total_price = $item_quantity * $item_price;
            $item_discnt_typ = $row['item_discnt_typ'];

            if ($item_discnt_typ == 1) {
                $item_discnt_amt_finale = $row['item_discnt_amt'];
            } else {
                $item_discnt_amt_finale = ($total_price / 100) * $row['item_discnt_amt'];
            }

            //print_r($item_discnt_typ);
            //echo "<hr>";
            //print_r($item_discnt_amt_finale);
            //echo "<hr>";

            $sub_total = $total_price - $item_discnt_amt_finale;

            $total_price_all = $total_price_all + $total_price;
            $item_discnt_amt_finale_all = $item_discnt_amt_finale_all + $item_discnt_amt_finale;
            $sub_total_all = $sub_total_all + $sub_total;
        }

        //print_r($total_price_all);
        //echo "<hr>";
        //print_r($item_discnt_amt_finale_all);
        //echo "<hr>";
        //print_r($sub_total_all);
        //echo "<hr>";

        $cond2 = array('inv_id' =>  $invoice_number);
        $tbl2 = "customer_assigned_packages";
        $customer_assigned_packages = $this->HomeModel->get_all_by_cond($tbl2, $cond2);

        $total_price_all2 = 0;
        $item_discnt_amt_finale_all2 = 0;
        $sub_total_all2 = 0;

        foreach ($customer_assigned_packages as $row) {

            $total_price1 = $row['package_price'];
            $item_discnt_typ = $row['pck_discnt_typ'];
            $quantity = $row['quantity'];

            $total_price = $total_price1 * $quantity;

            if ($item_discnt_typ == 1) {
                $item_discnt_amt_finale = $row['pck_discnt_amt'];
            } else {
                $item_discnt_amt_finale = ($total_price / 100) * $row['pck_discnt_amt'];
            }

            $sub_total = $total_price - $item_discnt_amt_finale;

            $total_price_all2 = $total_price_all2 + $total_price;
            $item_discnt_amt_finale_all2 = $item_discnt_amt_finale_all2 + $item_discnt_amt_finale;
            $sub_total_all2 = $sub_total_all2 + $sub_total;
        }

        /*  print_r( $sub_total_all);
            echo "<hr>";
            print_r($sub_total_all2);
            echo "<hr>";*/

        $cond3 = array('invoice_id' =>  $invoice_number);
        $tbl3 = "invoices_create";
        $invoices_create = $this->HomeModel->get_all_by_cond($tbl3, $cond3);

        $total_price_all3 = 0;
        $item_discnt_amt_finale_all3 = 0;
        $sub_total_all3 = 0;

        foreach ($invoices_create as $row) {
            $total_price = $total_price1 = $sub_total_all + $sub_total_all2;
            $item_discnt_typ = $row['invoice_discount'];
            $invoice_tax_rate = $row['invoice_tax_rate'];

            //$invoice_tax = ($total_price1/100) * $invoice_tax_rate;
            //$total_price = $total_price1 + $invoice_tax;

            if ($item_discnt_typ == 1) {
                $item_discnt_amt_finale = $row['discounted_amt'];
            } else {
                $item_discnt_amt_finale = ($total_price / 100) * $row['discounted_amt'];
            }

            $sub_total = $total_price - $item_discnt_amt_finale;
            $total_price_all3 = $total_price_all3 + $total_price;
            $item_discnt_amt_finale_all3 = $item_discnt_amt_finale_all3 + $item_discnt_amt_finale;
            $sub_total_all3 = $sub_total_all3 + $sub_total;
            $invoice_balance_due = $sub_total_all3;
        }

        //$invoice_tax = ($invoice_balance_due/100) * $invoice_tax_rate;
        //$invoice_balance_due = $invoice_balance_due + $invoice_tax;

        $invoice_tax_rate;


        //+$item_discnt_amt_finale_all2 + $item_discnt_amt_finale_all
        $item_sub_total = $total_price_all3 - ($item_discnt_amt_finale_all3);

        $invoice_tax = ($invoice_balance_due / 100) * $invoice_tax_rate;

        $upitemtotal = array(
            "item_sub_total" => $item_sub_total,
            "invoice_amount"      => $total_price_all3,
            "invoice_tax" => $invoice_tax,
            "invoice_balance_due" => $invoice_balance_due + $invoice_tax,
            "after_discount_amount" => $item_discnt_amt_finale_all3 + $item_discnt_amt_finale_all2 + $item_discnt_amt_finale_all
        );

        /*    print_r($upitemtotal);
            echo "<hr>";*/
        $this->db->where('invoice_id', $invoice_number);

        if ($this->db->update('invoices_create', $upitemtotal)) {
            return true;
        }
    }

    public function invoice_discount($invoice_tax_rate, $invoice_county, $invoice_number, $invoice_discount, $discounted_amt, $invoice_date, $invoice_due_date, $invoice_contract_type, $event_id)
    {
        $update_data = array(
            "inv_id" => $invoice_number
        );
        $this->db->where('event_id', $event_id);
        $res = $this->db->update('events_register', $update_data);

        if ($invoice_county != '' && $invoice_county != 'Choose') {
            $cond = array('id' =>  $invoice_county);
            $tbl = "county";
            $county = $this->HomeModel->get_all_by_cond($tbl, $cond);
            $invoice_tax_rate = $county[0]['tax'];
        }

        $updtdiscntamtarr = array(
            "invoice_county" => $invoice_county,
            "invoice_discount" => $invoice_discount,
            "discounted_amt" => $discounted_amt,
            "invoice_date" => $invoice_date,
            "invoice_due_date" => $invoice_due_date,
            "invoice_contract_type" => $invoice_contract_type,
            "invoice_type" => $event_id,
            "invoice_tax_rate" => $invoice_tax_rate
        );

        //$event_id
        //SELECT `id`, `subcat_id`, `name`, `amount`, `totsts`, `entry_log` FROM `adm_terms` WHERE 1
        //SELECT `sub_id`, `cat_id`, `sub_name`, `sub_description`, `opening_bal` FROM `sub_categories` WHERE 1


        $cond7 = array('subcat_id' =>  $invoice_contract_type);
        $tbl7 = 'adm_terms';
        $adm_terms = $this->HomeModel->get_all_by_cond($tbl7, $cond7);
        //print_r($this->db->last_query());

        //SELECT `id`, `invoice_id`, `subcat_id`, `name`, `amount`, `dt`, `totsts`, `entry_log` FROM `tbl_invoice_terms` WHERE 1

        //print_r($adm_terms);

        foreach ($adm_terms as $terms) {
            $data8 = array(
                'invoice_id' => $invoice_number,
                'subcat_id' =>  $terms['subcat_id'],
                'name' =>  $terms['name'],
                'amount' =>  $terms['amount'],
                'totsts' =>  $terms['totsts'],
                'entry_log' =>  $terms['entry_log']
            );

            $tbl8 = "tbl_invoice_terms";
            if (empty($this->HomeModel->get_all_by_cond($tbl8, $data8))) {
                $re = $this->HomeModel->insertdata($tbl8, $data8);
            }
        }

        //die;
        $this->db->where('invoice_id', $invoice_number);
        if ($this->db->update('invoices_create', $updtdiscntamtarr)) {
            $this->calculate_invoice_level($invoice_number, '1');
            return true;
        } else {
            return false;
        }
    }

    public function package_discount($invoice_number, $invoice_number_pck, $invoice_discount, $discounted_amt, $quantity)
    {
        $cond = array('id' =>  $invoice_number_pck);
        $tbl = "customer_assigned_packages";
        $customer_assigned_packages = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $package_price = $customer_assigned_packages[0]['package_price'];
        /*  $quantity = $customer_assigned_packages[0]['quantity'];  */

        if ($invoice_discount == 1) {
            $invoice_discount_amount = $discounted_amt;
        } else {
            $invoice_discount_amount = (($package_price * $quantity) / 100) * $discounted_amt;
        }

        $updtdiscntamtarr = array(
            "quantity" => $quantity,
            "pck_discnt_typ" => $invoice_discount,
            "pck_discnt_amt" => $discounted_amt,
            "pck_discounted_amt" => $invoice_discount_amount,
            "sub_total" => ($package_price * $quantity) - $invoice_discount_amount,
            "total_price" => $package_price * $quantity
        );



        $this->db->where('id', $invoice_number_pck);
        if ($this->db->update('customer_assigned_packages', $updtdiscntamtarr)) {

            $this->calculate_invoice_level($invoice_number, '1');
            return true;
        } else {
            return false;
        }
    }

    public function delete_item_invoice($cus_id, $invoice_number, $itemId)
    {
        $this->db->where('id', $itemId);
        if ($this->db->delete('customers_package_items'))  //admin_package_item
        {
            $this->calculate_invoice_level($invoice_number, $cus_id);
            return true;
        } else {
            return false;
        }
    }

    public function add_item_invoice($cus_id, $invoice_number, $itemId, $itmQty)
    {
        $cond = array('item_id' =>  $itemId);
        $tbl = "admin_item";
        $admin_item = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $addsingleitemarr = array(
            "cus_id"        => $cus_id,
            "inv_id"        => $invoice_number,
            "item_name"     => $itemId,
            "item_quantity" => $itmQty,
            "item_price"    => $admin_item[0]['item_price'] * $itmQty,
            "item_desc"     => $admin_item[0]['item_desc'],
            "item_tot"      => $admin_item[0]['item_price']
        );

        if ($this->db->insert('customers_package_items', $addsingleitemarr)) {
            $this->calculate_invoice_level($invoice_number, $cus_id);
            return true;
        } else {
            return false;
        }
    }

    public function delete_package_invoice($itmId, $invoiceId, $custId)
    {
        $this->db->where('id', $itmId);
        if ($this->db->delete('customer_assigned_packages')) {
            $this->db->where('assigned_pckid', $itmId);
            $this->db->delete('customers_package_items');

            $invoiceId = $invoiceId;
            $custId = $custId;

            $this->calculate_invoice_level($invoiceId, $custId);
            return true;
        } else {
            return false;
        }
    }

    public function add_package_invoice($item_package_name, $invoice_number, $cus_id)
    {
        $getpostpckg = $this->db->query("SELECT * FROM admin_package WHERE package_id = '" . $item_package_name . "'");
        $getadmpckrow = $getpostpckg->row();

        $pckarr = array(
            "total_price"     => $getadmpckrow->package_price * 1,
            "cus_id"          => $cus_id,
            "inv_id"          => $invoice_number,
            "package_id"      => $item_package_name,
            "package_name"    => $getadmpckrow->package_name,
            "package_price"   => $getadmpckrow->package_price,
            "package_taxable" => $getadmpckrow->package_taxable,
            "sub_total"       => $getadmpckrow->package_price
        );

        if ($this->db->insert('customer_assigned_packages', $pckarr)) {
            //print_r($this->db->last_query());
            $linsertId = $this->db->insert_id();
            $getpostpckgitms = $this->db->query("SELECT * FROM admin_package_item WHERE package_id = '" . $item_package_name . "'");

            foreach ($getpostpckgitms->result() as $getpostpckgitms_dtls) {
                $itemsarr = array(
                    "cus_id"          => $cus_id,
                    "inv_id"          => $invoice_number,
                    "package_id"      => $item_package_name,
                    "item_name"       => $getpostpckgitms_dtls->item_name,
                    "item_quantity"   => $getpostpckgitms_dtls->item_quantity,
                    "item_price"      => $getpostpckgitms_dtls->item_price,
                    "item_desc"       => $getpostpckgitms_dtls->item_desc,
                    "assigned_pckid"  => $linsertId,
                    "item_tot"        => $getpostpckgitms_dtls->item_price
                );
                $this->db->insert('customers_package_items', $itemsarr);
            }
        }
        $this->calculate_invoice_level($invoice_number, $cus_id);
        return true;
    }

    public function item_discount($invoice_number, $itemId, $item_quantity, $item_discnt_typ, $item_name, $item_descount)
    {
        /*-----------------------------Update item start---------------------------------------------*/

        $cond = array('item_id' =>  $item_name);
        $tbl = "admin_item";
        $admin_item = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $array_data1 = array(
            "item_name"       => $item_name,
            "item_price"      => $admin_item[0]['item_price'],
            "item_desc"       => $admin_item[0]['item_desc']
        );

        $tbl1 = 'customers_package_items';
        $cond1 = array('id' => $itemId);
        $results = $this->HomeModel->update_data($tbl1, $cond1, $array_data1);

        /*-----------------------------Update item end---------------------------------------------*/

        $cond = array('id' =>  $itemId);
        $tbl = "customers_package_items";
        $customers_package_items = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $total = $customers_package_items[0]['item_price'] * $item_quantity;

        if ($item_discnt_typ == 1) {
            $discounted_amt = $item_descount;
        } else {
            $discounted_amt = ($total / 100) * $item_descount;
        }

        $item_tot = $total - $discounted_amt;

        $array_data = array(
            'item_tot' => $item_tot,
            'discounted_amt' => $discounted_amt,
            'item_discnt_typ' => $item_discnt_typ,
            'item_discnt_amt' => $item_descount,
            'item_quantity' => $item_quantity,
            'item_total_without_disc' => $total

        );

        $this->db->where('id', $itemId);
        $res = $this->db->update('customers_package_items', $array_data);

        $this->calculate_invoice_level($invoice_number, '1');
        return true;
    }

    public function crete_new_invoice($invoice_number, $cus_id, $invoice_type,  $invoice_contract_type)
    {
        $id = $this->session->fi_session['id'];
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $invoice_county = 0;
        $tbl = "register_customer";
        $cond = array('cus_id' => $cus_id);
        $register_customer = $this->HomeModel->get_all_by_cond($tbl, $cond);
        $cus_zip = $register_customer[0]['cus_zip'];

        if ($cus_zip != '') {
            $tbl = "mycounty";
            $cond = array('name' => $cus_zip);
            $county = $this->HomeModel->get_all_by_cond($tbl, $cond);
            $company_tax_rate = $county[0]['tax'] * 100;
            $invoice_county = '0'; //$county[0]['id'];

        } else {
            $company_info = $this->db->query("SELECT `company_tax_rate` FROM `company_info` WHERE 1");
            foreach ($company_info->result() as $row) {
                $company_tax_rate = $row->company_tax_rate;
            }
        }

        $postinvarr = array(
            "cust_id" => $cus_id,
            //"invoice_name" => $chkinvsql_dtls->invoice_name,
            "invoice_date" => date('Y-m-d'),
            "invoice_due_date" => date('Y-m-d'),
            "invoice_status" => 0,
            "invoice_tax_rate" => $company_tax_rate,
            "invoice_contract_type" => 0, //$invoice_contract_type,
            "invoice_type" => 0,  //$invoice_type
            "user" => $id
        );

        $chkinvsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $invoice_number . "'");
        foreach ($chkinvsql->result() as $chkinvsql_dtls) {
            $postinvarr = array(
                "invoice_county" => $invoice_county,
                "cust_id" => $cus_id,
                "invoice_name" => $chkinvsql_dtls->invoice_name,
                "invoice_date" => date('Y-m-d'),
                "invoice_due_date" => date('Y-m-d'),
                "invoice_status" => 0,
                "invoice_tax_rate" => $company_tax_rate,
                "invoice_contract_type" => '0', //$invoice_contract_type,
                "invoice_type" => '0', //$invoice_type
                "user" => $id
            );
        }



        if ($this->db->insert('invoices_create', $postinvarr)) {
            $linvid = $this->db->insert_id();
            $postinvnoarr = array(
                "inv_id" => $linvid,
            );
            $this->db->insert('invoice_terms', $postinvnoarr);
            return $linvid;
        }
    }

    public function changeitemvalue()
    {
        $item_quantity = $this->input->post('item_quantity');
        $item_name = $this->input->post('item_name');
        $id = $this->input->post('id');
        $amount = $this->input->post('amount');
        $cond = array('id' =>  $id);
        $tbl = "customers_package_items";
        $result_row = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->update_item_invoice($result_row[0]['cus_id'], $result_row[0]['inv_id'], $id, $item_quantity, $amount, $item_name);
        //$this->update_package_invoice($id, $amount, $result_row[0]['package_id'], $result_row[0]['inv_id'], $result_row[0]['cus_id']);
        $this->CustomerInvoice();
    }

    public function update_item_invoice($cus_id, $invoice_number, $itemId, $itmQty, $amount, $item_name)
    {

        $cond = array('item_id' =>  $item_name);
        $tbl = "admin_item";
        $admin_item = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $addsingleitemarr = array(
            "cus_id"        => $cus_id,
            "inv_id"        => $invoice_number,
            "item_name"     => $item_name,
            "item_quantity" => $itmQty,
            "item_price"    => $amount * $itmQty,
            "item_desc"     => $admin_item[0]['item_desc'],
            "item_tot"      => $amount //$admin_item[0]['item_price']
        );

        $this->db->where('id', $itemId);
        $res = $this->db->update('customers_package_items', $addsingleitemarr);

        if ($res) {
            $this->calculate_invoice_level($invoice_number, $cus_id);
            return true;
        } else {
            return false;
        }
    }

    public function changemyvalue()
    {
        $id = $this->input->post('id');
        $amount = $this->input->post('amount');
        $cond = array('id' =>  $id);
        $tbl = "customer_assigned_packages";
        $result_row = $this->HomeModel->get_all_by_cond($tbl, $cond);
        $this->update_package_invoice($id, $amount, $result_row[0]['package_id'], $result_row[0]['inv_id'], $result_row[0]['cus_id']);
        $this->CustomerInvoice();
    }

    public function update_package_invoice($id, $amount, $item_package_name, $invoice_number, $cus_id)
    {
        $getpostpckg = $this->db->query("SELECT * FROM admin_package WHERE package_id = '" . $item_package_name . "'");
        $getadmpckrow = $getpostpckg->row();

        $pckarr = array(
            "total_price"     => $amount * 1,
            "cus_id"          => $cus_id,
            "inv_id"          => $invoice_number,
            "package_id"      => $item_package_name,
            "package_name"    => $getadmpckrow->package_name,
            "package_price"   => $amount,
            "package_taxable" => $getadmpckrow->package_taxable,
            "sub_total"       => $amount
        );

        //print_r($getadmpckrow->package_price);
        //echo "<hr>";

        //quantity

        //INSERT INTO `customer_assigned_packages` (`cus_id`, `inv_id`, `package_id`, `package_name`, `package_price`, `package_taxable`, `sub_total`) VALUES ('22', '7', '5', 'Birthday', '2044', '0', '2044')

        $this->db->where('id', $id);
        $res = $this->db->update('customer_assigned_packages', $pckarr);

        //print_r($pckarr);

        if ($res) {
            //print_r($this->db->last_query());
            $linsertId = $this->db->insert_id();
            $getpostpckgitms = $this->db->query("SELECT * FROM admin_package_item WHERE package_id = '" . $item_package_name . "'");

            foreach ($getpostpckgitms->result() as $getpostpckgitms_dtls) {
                $itemsarr = array(
                    "cus_id"          => $cus_id,
                    "inv_id"          => $invoice_number,
                    "package_id"      => $item_package_name,
                    "item_name"       => $getpostpckgitms_dtls->item_name,
                    "item_quantity"   => $getpostpckgitms_dtls->item_quantity,
                    "item_price"      => $getpostpckgitms_dtls->item_price,
                    "item_desc"       => $getpostpckgitms_dtls->item_desc,
                    "assigned_pckid"  => $linsertId,
                    "item_tot"        => $getpostpckgitms_dtls->item_price
                );
                //$this->db->insert('customers_package_items',$itemsarr);
            }
        }
        $this->calculate_invoice_level($invoice_number, $cus_id);
        return true;
    }



    public function custinvoices()
    {

        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        //if($cus_id == ''){
        $cus_id = $this->session->userdata('id');
        //}
        //print_r($cus_id);

        if (empty($cus_id) || $cus_id == "" || $cus_id == 'null') {
            $cus_id = 0;
        }
        $this->session->set_userdata('id', $cus_id);
        $data['cus_id']      = $cus_id;

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['count']    = $this->db->select('count(*) as count')->get('invoices_create')->result_array();
        // print_r($data);die;
        $data12 = $this->db->query("SELECT * from customer_assigned_packages"); //admin_package

        $data['all_packs'] = $data12->result_array();

        $data['single_cust']    = $this->AdminModel->search_data()[0];
        // $cus_id=$this->session->userdata('id');
        $this->session->unset_userdata('event_page', '');
        // print_r($cus_id);die;
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/customer/custinvoices', $data);
        $this->load->view('fi/footer');
    }

    public function CREWS_check_date_with_db()
    {

        $this->AdminModel->CREWS_check_date_with_db_dtls();
    }

    public function check_date_with_db()
    {
        $this->AdminModel->check_date_with_db_dtls();
    }

    public function fnitemqtydescountinfo()
    {

        $this->AdminModel->fnitemqtydescountinfo_dtls();
    }

    public function change_qty1()
    {

        $result = $this->AdminModel->change_qty1();
    }

    public function fngetsignlepckinfo()
    {

        $result = $this->AdminModel->fngetsignlepckinfo_dtls();
    }

    public function delassignpackge()
    {

        $result = $this->AdminModel->delassignpackge_dtls();
    }

    public function fnitemdescountinfo()
    {

        $this->AdminModel->fnitemdescountinfo_dtls();
    }


    public function fnitemdescountinfo_pck()
    {

        $this->AdminModel->fnitemdescountinfo_dtls_pck();
    }

    public function fnpckgdescountinfo()
    {

        $this->AdminModel->fnpckgdescountinfo_dtls();
    }

    public function fninvdescountinfo()
    {

        $this->AdminModel->fninvdescountinfo_dtls();
    }

    public function fninvdescountinfo2()
    {

        $this->AdminModel->fninvdescountinfo_dtls2();
    }

    public function fnadditemsinfo()
    {

        $this->AdminModel->fnadditemsinfo_dtls();
    }

    public function noti_mail()
    {

        $to         = $_POST['nwcustemail'];
        $sub        = $_POST['letteremailsub'];
        $msg        = $_POST['letteremaildesc'];
        $fileData   = array();
        $files      = $_FILES;

        if (!empty($_FILES['crewavl']['name'])) {

            $filesCount = count($_FILES['crewavl']['name']);
            //echo "filesCount--".$filesCount;die;

            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['crewavl']['name'] = $files['crewavl']['name'][$i];
                $_FILES['crewavl']['type'] = $files['crewavl']['type'][$i];
                $_FILES['crewavl']['tmp_name'] = $files['crewavl']['tmp_name'][$i];
                $_FILES['crewavl']['error'] = $files['crewavl']['error'][$i];
                $_FILES['crewavl']['size'] = $files['crewavl']['size'][$i];
                $config['upload_path']   = 'uploads/crew_mails';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
                $config['overwrite']     = FALSE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('crewavl')) {
                    $fileData[] = $this->upload->data();
                    //$uploadImgData[$i]['crewavl'] = $fileData['file_name'];

                    $this->load->library('email');
                    $this->email->set_mailtype("html"); //mike222taylor@gmail.com
                    $this->email->from('info@tech599.com', 'ERP SYSTEM- General information');
                    $this->email->to($to);
                    $this->email->subject($sub);
                    $this->email->message($msg);
                    $pathToUploadedFile = $fileData[$i]['full_path'];
                    $this->email->attach($pathToUploadedFile);
                } else {

                    $this->load->library('email');
                    $this->email->set_mailtype("html"); //mike222taylor@gmail.com
                    $this->email->from('info@tech599.com', 'ERP SYSTEM- General information');
                    $this->email->to($to);
                    $this->email->subject($sub);
                    $this->email->message($msg);
                }
            }

            $this->email->send();

            $this->session->set_flashdata('success', "Mail Send Successfully..!!");
            redirect('fi_home/c_notes');
        }
    }








    public function upditemamt()
    {

        $result = $this->AdminModel->upditemamt_dtls();
    }



    public function time_update()
    {
        $timenotes = $this->input->post('timenotes');
        $noteid = $this->input->post('noteid');

        $this->AdminModel->time_update_dtls($timenotes, $noteid);
    }

    public function fngetsearhinvoice()
    {

        $cus_id = $this->input->post('custid');
        $this->session->set_userdata('id', $cus_id);
        $result = $this->AdminModel->fngetsearhinvoice_dtls();
    }



    public function search_allcust()
    {

        $this->AdminModel->search_allcust_dtls();
    }

    public function fngetinvoiceinfo()
    {
        $cusid = $_POST['custnm'];

        $result = $this->AdminModel->fngetinvoiceinfo_dtls($cusid);
    }

    public function fnupdatejobinfo()
    {
        $this->AdminModel->fnupdatejobinfo_dtls();
    }









    public function prasanna()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        echo "hi";

        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $this->load->view('fi/prasanna');
    }

    public function addevent()
    {

        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        // echo "<pre>";print_r($this->input->post());
        if ($this->input->post('cuss_id') != "" && $this->input->post('edate')[0] != "") {

            $result_cus = $this->AdminModel->check_event_id($this->input->post('cuss_id'), $this->input->post('edate')[0]);
            //echo "<pre>";print_r($result_cus); die;
            if ($result_cus == 0) {

                //echo "<pre>";print_r($this->input->post());

                for ($i = 0; $i < count($this->input->post('event_type')); $i++) {


                    $data['cus_id']                         = $this->input->post('cuss_id');
                    $data['event_type']                 = $this->input->post('event_type')[$i];
                    $data['event_name']                 = $this->input->post('ename')[$i];
                    $data['event_date']                 = $this->input->post('edate')[$i];
                    $data['event_time']                 = $this->input->post('etime')[$i];
                    $data['event_end_date']         = $this->input->post('endate')[$i];
                    $data['event_end_time']         = $this->input->post('entime')[$i];
                    $data1['event_booked']          = $this->input->post('bookedcheck')[$i];
                    if ($data1['event_booked'] == 'on') {
                        $data['event_booked'] = 1;
                    } else {
                        $data['event_booked'] = 0;
                    }
                    $data1['event_lost']                = $this->input->post('lostcheck')[$i];
                    if ($data1['event_lost'] == 'on') {
                        $data['event_lost'] = 1;
                    } else {
                        $data['event_lost'] = 0;
                    }
                    $data['event_guest']                = $this->input->post('eguest')[$i];
                    $data['event_hebrew_date']      = $this->input->post('ehdate')[$i];
                    $data['event_day']                  = $this->input->post('eday')[$i];
                    $data['event_referred_by']      = $this->input->post('referdby')[$i]; // erby
                    $data['event_note']                 = $this->input->post('enote')[$i];

                    $result = $this->AdminModel->insertevent($data);
                }




                $this->session->set_flashdata('success', "Event Created Successfully..!!");
                //redirect('fi_home/custinvoices'); //Old
                redirect('fi_home/CustomerInvoice'); //New


            } else if ($result_cus > 0) {



                for ($i = 0; $i < count($this->input->post('event_type')); $i++) {

                    if ($this->input->post('event_type')[$i] != "Select" || $this->input->post('edate')[$i] != "") {

                        $data['cus_id']         = $this->input->post('cuss_id');
                        $data['event_type']     = $this->input->post('event_type')[$i];
                        $data['event_name']     = $this->input->post('ename')[$i];
                        $data['event_date']     = $this->input->post('edate')[$i];
                        $data['event_time']     = $this->input->post('etime')[$i];
                        $data['event_end_date'] = $this->input->post('endate')[$i];
                        $data['event_end_time'] = $this->input->post('entime')[$i];
                        $data1['event_booked']  = $this->input->post('bookedcheck')[$i];

                        if ($data1['event_booked'] == 'on') {
                            $data['event_booked'] = 1;
                        } else {
                            $data['event_booked'] = 0;
                        }
                        $data1['event_lost']                = $this->input->post('lostcheck')[$i];
                        if ($data1['event_lost'] == 'on') {
                            $data['event_lost'] = 1;
                        } else {
                            $data['event_lost'] = 0;
                        }
                        $data['event_guest']                = $this->input->post('eguest')[$i];
                        $data['event_hebrew_date']      = $this->input->post('ehdate')[$i];
                        $data['event_day']                  = $this->input->post('eday')[$i];
                        $data['event_referred_by']      = $this->input->post('referdby')[$i]; // erby
                        $data['event_note']                 = $this->input->post('enote')[$i];

                        $result = $this->AdminModel->insertevent($data);
                    }
                }



                $this->session->set_flashdata('success', "Event Updated Successfully..!! ");
                //redirect('fi_home/custinvoices'); //Old
                redirect('fi_home/CustomerInvoice'); //New


            } else {
                $this->session->set_flashdata('error', "Please select another date as event already exist for same date..!!");
                redirect('fi_home/custevents');
            }
        } else {
            $this->session->set_flashdata('error', "Please enter the date..!!");
            redirect('fi_home/custevents');
        }
    }

    public function all_upcoming_event($id)
    {

        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        /*$result=$this->AdminModel->update_dash($data['id']);*/
        $data['event']  = $this->DashboardModel->all_upcomming_event($id);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/upcoming_event', $data);
        $this->load->view('fi/footer');
    }

    public function index()
    {
      
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
      
        $data['alert']     = $this->session->flashdata('alert');
        $data['error']     = $this->session->flashdata('error');
        $data['success']   = $this->session->flashdata('success');

        $id = $this->session->fi_session['id'];
        $user_role = $this->session->fi_session['admin_role_id'];

        $data['event'] = $this->db->select('r.cus_id, r.event_id, r.event_type, r.event_name, r.event_date, r.event_note, e.event_id as e_event_id')
            ->join('event_location e', 'e.event_id=r.event_id', 'left')
            ->where('event_date >= CURDATE()')
            ->where('e.user', $id)
            ->where('r.user', $id)
            ->order_by("r.event_date", "r.cus_id", "ASC")
            ->limit(5, 1)
            ->get('events_register r')->result_array();

        if ($user_role == '1') {
            $where_con_task = 'ic.user=' . $id . ' AND ic.cust_id !="" ORDER by i.task_id DESC LIMIT 5';
            $data['task']  = $this->db
                ->select('ic.invoice_id, ic.cust_id, i.task_user, i.task_id, i.task_date_started, a.name as type_name, ad.name as sub_name, i.task_note')
                ->join("adm_task_type a", "i.task_type=a.id", 'left')
                ->join("adm_subtask_type ad", "i.sub_task_type=ad.id", 'left')
                ->join("invoices_create ic", "i.invoice_id=ic.invoice_id", 'left')
                ->where($where_con_task)
                ->get('invoice_task i')
                ->result_array();

            $where_con_rem = 'users_id = ' . $id . ' AND note_datetime >= CURDATE() AND iteam_check = "1" ORDER by note_datetime ASC LIMIT 5';
            $data['rem']  = $this->db->select('*')
                ->where($where_con_rem)
                ->get('customer_appointment')
                ->result_array();
        } elseif ($user_role == '2') {
            $where_con_task = 'i.user = ' . $id . ' AND ic.cust_id !="" ORDER by i.task_id DESC LIMIT 5';
            $data['task']  = $this->db
                ->select('ic.invoice_id,ic.cust_id,i.task_user,i.task_id,i.task_date_started,a.name as type_name,ad.name as sub_name,i.task_note')
                ->join("adm_task_type a", "i.task_type=a.id", 'left')
                ->join("adm_subtask_type ad", "i.sub_task_type=ad.id", 'left')
                ->join("invoices_create ic", "i.invoice_id=ic.invoice_id", 'left')

                ->where($where_con_task)
                ->get('invoice_task i')
                ->result_array();

            $where_con_rem = 'users_id = ' . $id . ' AND note_datetime >= CURDATE() AND iteam_check = "1" ORDER by note_datetime ASC LIMIT 5';
            $data['rem']  = $this->db->select('*')
                ->where($where_con_rem)
                ->get('customer_appointment')
                ->result_array();
        }

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/Dashboard/dash', $data);
        $this->load->view('fi/footer');
    }

    public function all_upcoming_task($id)
    {

        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $data['task']  = $this->DashboardModel->all_upcoming_task($id);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/upcoming_task', $data);
        $this->load->view('fi/footer');
    }





    public function deposit()
    {
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/deposit');
        $this->load->view('fi/footer');
    }


    public function adduser()
    {
        // Fetch all users from table
        $users =
            $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/add_user');
        $this->load->view('fi/footer');
    }




    public function missing_event()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $where_con_missing = 'event_id NOT IN (SELECT event_id FROM `event_location`) AND  event_date >= CURDATE() AND event_date <= DATE_ADD(CURDATE(), INTERVAL 2 WEEK) ORDER by event_id DESC';
        $data['missing']  = $this->db->select('event_id,event_type,event_name,event_date')->where($where_con_missing)->get('events_register')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/missing_event', $data);
        $this->load->view('fi/footer');
    }

    public function dismiss_dash($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $this->session->set_userdata('dismiss_dash', $id);
        redirect('fi_home/dismiss_dash_function');
    }

    public function dismiss_dash_function()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $data['id'] = $this->session->userdata('dismiss_dash');
        $result = $this->AdminModel->update_dash($data['id']);
        // print_r($data);die;
        if ($result > 0) {
            $this->session->set_flashdata('success', "Dismiss Successfully..!!");
            redirect('fi_home/');
        } else {
            $this->session->set_flashdata('error', "Dismiss Error..!!");
            redirect('fi_home/');
        }
    }


    public function dismissall_dash()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $result = $this->AdminModel->dismissall_dash();

        if ($result > 0) {
            $this->session->set_flashdata('success', "DismissAll Successfully..!!");
            redirect('fi_home/');
        } else {
            $this->session->set_flashdata('error', "Dismiss Error..!!");
            redirect('fi_home/');
        }
    }

    public function snooze_dash($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $result = $this->AdminModel->snooze_dash($id);
        // print_r($data);die; sdgsdsdgaasas
        if ($result > 0) {
            $this->session->set_flashdata('success', "DismissAll Successfully..!!");
            redirect('fi_home/');
        } else {
            $this->session->set_flashdata('error', "Dismiss Error..!!");
            redirect('fi_home/');
        }
    }













    public function custevents()
    {

        $data['alert']              = $this->session->flashdata('alert');
        $data['error']              = $this->session->flashdata('error');
        $data['success']            = $this->session->flashdata('success');
        $data['search']               = $this->AdminModel->search_data();

        $data['single_cust']    = $this->AdminModel->search_data()[0];


        $data['event_name']       = $this->db->where('cat_id', 3)->get('sub_categories')->result_array();
        $data['last_row'] = $this->db->order_by('cus_id', "desc")->limit(1)->get('register_customer')->result_array()[0];
        $get_loc = $this->db->query("SELECT * from add_location_event");

        $data['all_locs'] = $get_loc->result_array();

        $data['all_crews'] = $this->db->where('cat_id', 4)->get('sub_categories')->result_array();




        $data['event_data'] = $this->AdminModel->get_event_data_id($data['last_row']['cus_id']);

        $data['location_data'] = $this->AdminModel->get_locationt_data_id($data['last_row']['cus_id']);

        $data['crews_data'] = $this->AdminModel->get_crews_data_id($data['last_row']['cus_id']);

        $this->session->unset_userdata('event_page', '');
        // print_r($data['all_locs']);die;
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/cust_events', $data);
        $this->load->view('fi/footer');
    }

    public function single_location_info()
    {
        $loc_name = $this->input->post('l_name');
        $cus_names = $this->input->post('cus_names');
        $locationjson;
        if ($loc_name == "Home") {

            $get_cust_cntctfields = $this->db->query("SELECT contact_no from user_contact_info WHERE cus_id = '$cus_names' AND default_contact='1'");
            $get_data_cust = $get_cust_cntctfields->result()[0];
            //$get_row_cust=$get_cust_cntctfields->row();
            //$get_data_cust="contact_no:".$get_row_cust->contact_no;
            //echo $get_data_cust;

            $get_cust_allfields = $this->db->query("SELECT * from register_customer WHERE cus_id = '$cus_names'");
            //$get_data_cust = $get_cust_allfields->result_array()[0];
            //print_r(implode("##",$get_data_cust));

            foreach ($get_cust_allfields->result() as $get_cust_allfields_dtls) {
                $locationjson['locationlist'][] = $get_cust_allfields_dtls;
                //$locationjson['locationlist'][]=$get_data_cust;

            }


            echo json_encode($locationjson);
        } else {
            $get_loc_allfields = $this->db->query("SELECT * from add_location_event WHERE location_name = '$loc_name'");
            //$get_data_loc = $get_loc_allfields->result_array()[0];
            //print_r(implode("##",$get_data_loc));

            foreach ($get_loc_allfields->result() as $get_loc_allfields_dtls) {
                $locationjson['locationlist'][] = $get_loc_allfields_dtls;
            }

            echo json_encode($locationjson);
        }
    }
    public function get_data_user()
    {
        $loc_name = $this->input->post('l_name');
        echo $loc_name;
    }

    public function single_package_info()
    {
        $pac_n = $this->input->post('pid');
        $pac_fetch = $this->db->query("SELECT * from admin_package WHERE package_id = '$pac_n'");
        $get_pac = $pac_fetch->result_array()[0];
        echo (implode("##", $get_pac)), "<br>";

        $item_get = $this->db->query("SELECT * from admin_package_item WHERE package_id = '$pac_n'");
        $rows = $item_get->result_array();
        for ($i = 0; $i < count($rows); $i++) {

            print_r(implode("**", $rows[$i]));
        }
    }

    public function search_cus()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $cus_id = $this->input->get('id');

        if ($cus_id != "") {
            $this->session->set_userdata('id', $cus_id);
            redirect('fi_home/search_new_cus');
        }
    }

    public function calender_search_cus($event_id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $cus_id = $this->input->get('event_id');
        $cus_id  = $this->db->SELECT('cus_id')->where('event_id', $event_id)->get('events_register')->result_array()[0];
        if ($cus_id != "") {
            $this->session->set_userdata('id', $cus_id['cus_id']);
            redirect('fi_home/search_new_cus');
        }
    }

    public function crnewinvoice()
    {
        $result = $this->AdminModel->crnewinvoice_dtls();
    }

    public function delinvoice()
    {
        $result = $this->AdminModel->delinvoice_dtls();
    }
    public function delinvoiceseleted()
    {
        $result = $this->AdminModel->delinvoice_seleted_dtls();
    }

    public function updtinvoice()
    {
        $result = $this->AdminModel->updtinvoice_dtls();
    }

    public function add_reminder()
    {
        $result = $this->AdminModel->add_reminder();
    }









    public function crpitem()
    {
        $result = $this->AdminModel->crpitem_dtls();
    }

    public function delpitem()
    {
        $result = $this->AdminModel->delpitem_dtls();
    }

    public function updtitems()
    {
        $result = $this->AdminModel->updtitems_dtls();
    }

    public function updinvamt()
    {
        $result = $this->AdminModel->updinvamt_dtls();
    }

    public function updpckinfo()
    {
        $result = $this->AdminModel->updpckinfo_dtls();
    }

    public function upditemdesc()
    {
        $result = $this->AdminModel->upditemdesc_dtls();
    }

    public function upditemdescount()
    {
        $result = $this->AdminModel->upditemdescount_dtls();
    }



    public function addinvoice()
    {


        $data['invoice_name']       = $this->input->post('new_invoice');
        $data['invoice_date']       = $this->input->post('invoice_date');
        $data['invoice_due_date']   = $this->input->post('invoice_due_date');
        $data['invoice_type']       = $this->input->post('invoice_event_type');
        $data['invoice_contract_type'] = $this->input->post('invoice_contract_type');
        $data['invoice_discount']   = $this->input->post('invoice_discount');
        $data['invoice_sub_total']  = $this->input->post('invoice_sub_total');
        $data['invoice_tax']        = $this->input->post('invoice_tax');
        $data['invoice_amount']     = $this->input->post('invoice_amount');
        $data['invoice_paid']       = $this->input->post('invoice_paid');
        $data['invoice_balance_due'] = $this->input->post('invoice_balance_due');
        $data['invoice_tax_rate']   = $this->input->post('invoice_tax_rate');
        $data['invoice_county']     = $this->input->post('invoice_country');
        $data['invoice_user']       = $this->input->post('invoice_user');

        $result = $this->AdminModel->insertnewinvoice($data);
        if ($result > 0) {
            // print_r($result);die;

            for ($i = 0; $i < count($this->input->post('item_quantity')); $i++) {
                $item['invoice_id'] =   $result;
                $item['item_quantity']  =   $this->input->post('item_quantity')[$i];
                $item['item_item']  =   $this->input->post('item_name')[$i];
                $item['item_desc']  =   $this->input->post('item_desc')[$i];
                $item['item_amount'] =   $this->input->post('item_amount')[$i];
                $item['item_total'] =    $this->input->post('item_total')[$i];
                $item['item_taxable'] =  $this->input->post('iteam_taxable')[$i];
                $item['item_include_in_package'] =   $this->input->post('item_include_in_pacakge')[$i];
                $item['item_package_name'] = $this->input->post('item_package_name')[$i];
                $item['item_package_price'] =    $this->input->post('item_price')[$i];

                $item_insert = $this->AdminModel->insertinvoiceitem($item);
            }

            for ($i = 0; $i < count($this->input->post('task_date')); $i++) {
                $task['invoice_id'] =   $result;
                $task['task_date_started']  =   $this->input->post('task_date')[$i];
                $task['task_type']  =   $this->input->post('task_type')[$i];
                $task['task_user']  =   $this->input->post('task_user')[$i];
                $task['task_due_date'] = $this->input->post('task_due_date')[$i];
                $task['task_completed'] =    $this->input->post('task_completed')[$i];
                $task['task_completed_by'] = $this->input->post('task_completed_by')[$i];
                $task['task_completed_date'] =   $this->input->post('task_completed_date')[$i];
                $task['task_note'] = $this->input->post('task_note')[$i];
                $task['task_entered_by'] =   $this->input->post('task_enter_by')[$i];

                $task_inseart = $this->AdminModel->insertinvoicetask($task);
            }

            for ($i = 0; $i < count($this->input->post('invoice_payment')); $i++) {
                $pay['invoice_id']  =   $result;
                $pay['payment_name']    =   $this->input->post('invoice_payment')[$i];
                $pay['payment_date']    =   $this->input->post('payment_date')[$i];
                $pay['payment_reciept'] =   $this->input->post('payment_reciept')[$i];
                $pay['payment_type'] =   $this->input->post('payment_type')[$i];
                $pay['payment_checknum'] =   $this->input->post('checknum')[$i];
                $pay['payment_desc'] =   $this->input->post('payment_desc')[$i];
                $pay['payment_amount'] = $this->input->post('payment_amount')[$i];
                $pay['payment_credit'] = $this->input->post('payment_credit')[$i];
                $pay['payment_username'] =   $this->input->post('payment_username')[$i];
                $pay['payment_modes'] =  $this->input->post('payment_modes')[$i];
                $pay['payment_deposite'] =   $this->input->post('payment_deposite')[$i];

                $payment_inseart = $this->AdminModel->insertinvoicepayment($pay);
            }

            for ($i = 0; $i < count($this->input->post('pickup_item')); $i++) {
                $pickup['invoice_id']   =   $result;
                $pickup['pickup_info_item'] =   $this->input->post('pickup_item')[$i];
                $pickup['pickup_info_desc'] =   $this->input->post('pickup_desc')[$i];
                $pickup['pickup_info_quantity'] =   $this->input->post('pickup_quantity')[$i];
                $pickup['pickup_info_pickup_by'] =   $this->input->post('pickup_pickup_by')[$i];
                $pickup['pickup_info_pickup_date'] = $this->input->post('pickup_date')[$i];
                $pickup['pickup_info_notes'] =   $this->input->post('pickup_note')[$i];
                $pickup_inseart = $this->AdminModel->insertpickup_info($pickup);
            }

            for ($i = 0; $i < count($this->input->post('pickupreq_item')); $i++) {
                $pickup_req['invoice_id']   =   $result;
                $pickup_req['pickup_required_item'] =   $this->input->post('pickupreq_item')[$i];
                $pickup_req['pickup_required_quantity'] =   $this->input->post('pickupreq_quantity')[$i];
                $pickup_req['pickup_required_pickup']   =   $this->input->post('pickupreq_pickup')[$i];

                $pickup_req_inseart = $this->AdminModel->insertpickup_req($pickup_req);
            }

            for ($i = 0; $i < count($this->input->post('note_date')); $i++) {
                $note['invoice_id'] =   $result;
                $note['note_date']  =   $this->input->post('note_date')[$i];
                $note['note_time']  =   $this->input->post('note_time')[$i];
                $note['note_type']  =   $this->input->post('note_type')[$i];
                $note['note_desc']  =   $this->input->post('note_note')[$i];
                $note['note_user']  =   $this->input->post('note_user')[$i];

                $note_inseart = $this->AdminModel->insertinvoice_note($note);
            }

            for ($i = 0; $i < count($this->input->post('associated_invoice')); $i++) {
                $associated['invoice_id']   =   $result;
                $associated['associated_invoice']   =   $this->input->post('associated_invoice')[$i];
                $associated['associated_name']  =   $this->input->post('associated_name')[$i];
                $associated['associated_date_enter']    =   $this->input->post('associated_date_enter')[$i];
                $associated['associated_due_date']  =   $this->input->post('associated_due_date')[$i];
                $associated['associated_contract_type'] =   $this->input->post('associated_contract_type')[$i];
                $associated['associated_discount']  =   $this->input->post('associated_discount')[$i];
                $associated['associated_sub_total'] =   $this->input->post('associated_sub_total')[$i];
                $associated['associated_tax']   =   $this->input->post('associated_tax')[$i];
                $associated['associated_amount']    =   $this->input->post('associated_amount')[$i];
                $associated['associated_paid']  =   $this->input->post('associated_paid')[$i];
                $associated['associated_balance_due']   =   $this->input->post('associated_balance_due')[$i];
                $associated['associated_tax_rate']  =   $this->input->post('associated_tax_rate')[$i];
                $associated['associated_country']   =   $this->input->post('associated_county')[$i];
                $associated['associated_user']  =   $this->input->post('associated_user')[$i];

                $note_inseart = $this->AdminModel->insertinvoice_associated($associated);
            }
            $this->session->set_flashdata('success', "Invoice Saved Successfully..!!");
            //redirect('fi_home/custinvoices'); //Old
            redirect('fi_home/CustomerInvoice'); //New
        } else {
            $this->session->set_flashdata('error', "Invoice Not Saved ..!!");
            //redirect('fi_home/custinvoices'); //Old
            redirect('fi_home/CustomerInvoice'); //New
        }
        // print_r($result);die;
    }
    public function invoice_add()
    {

        $data['invoice_name'] = $this->input->post('new_invoice');
        $data['invoice_date'] = $this->input->post('invoice_date');
        $data['invoice_due_date'] = $this->input->post('invoice_due_date');
        $data['invoice_type'] = $this->input->post('invoice_event_type');
        $data['invoice_contract_type'] = $this->input->post('invoice_contract_type');
        $data['invoice_discount'] = $this->input->post('invoice_discount');
        $data['invoice_sub_total'] = $this->input->post('invoice_sub_total');
        $data['invoice_tax'] = $this->input->post('invoice_tax');
        $data['invoice_amount'] = $this->input->post('invoice_amount');
        $data['invoice_paid'] = $this->input->post('invoice_paid');
        $data['invoice_balance_due'] = $this->input->post('invoice_balance_due');
        $data['invoice_tax_rate'] = $this->input->post('invoice_tax_rate');
        $data['invoice_county'] = $this->input->post('invoice_country');
        $data['invoice_user'] = $this->input->post('invoice_user');

        $result = $this->AdminModel->insertnewinvoice($data);
        if ($result > 0) {
            // print_r($result);die;

            for ($i = 0; $i < count($this->input->post('item_quantity')); $i++) {
                $item['invoice_id'] =   $result;
                $item['item_quantity']  =   $this->input->post('item_quantity')[$i];
                $item['item_item']  =   $this->input->post('item_name')[$i];
                $item['item_desc']  =   $this->input->post('item_desc')[$i];
                $item['item_amount'] =   $this->input->post('item_amount')[$i];
                $item['item_total'] =    $this->input->post('item_total')[$i];
                $item['item_taxable'] =  $this->input->post('iteam_taxable')[$i];
                $item['item_include_in_package'] =   $this->input->post('item_include_in_pacakge')[$i];
                $item['item_package_name'] = $this->input->post('item_package_name')[$i];
                $item['item_package_price'] =    $this->input->post('item_price')[$i];
                if ($item['item_taxable'] == NULL || $item['item_taxable'] == "") {
                    $item['item_taxable'] = 0;
                }
                $item_insert = $this->AdminModel->insertinvoiceitem($item);
            }

            for ($i = 0; $i < count($this->input->post('task_date')); $i++) {
                $task['invoice_id'] =   $result;
                $task['task_date_started']  =   $this->input->post('task_date')[$i];
                $task['task_type']  =   $this->input->post('task_type')[$i];
                $task['task_user']  =   $this->input->post('task_user')[$i];
                $task['task_due_date'] = $this->input->post('task_due_date')[$i];
                $task['task_completed'] =    $this->input->post('task_completed')[$i];
                $task['task_completed_by'] = $this->input->post('task_completed_by')[$i];
                $task['task_completed_date'] =   $this->input->post('task_completed_date')[$i];
                $task['task_note'] = $this->input->post('task_note')[$i];
                $task['task_entered_by'] =   $this->input->post('task_enter_by')[$i];
                if ($task['task_completed'] == NULL || $task['task_completed'] == "") {
                    $task['task_completed'] = 0;
                }
                $task_inseart = $this->AdminModel->insertinvoicetask($task);
            }

            for ($i = 0; $i < count($this->input->post('invoice_payment')); $i++) {
                $pay['invoice_id']  =   $result;
                $pay['payment_name']    =   $this->input->post('invoice_payment')[$i];
                $pay['payment_date']    =   $this->input->post('payment_date')[$i];
                $pay['payment_reciept'] =   $this->input->post('payment_reciept')[$i];
                $pay['payment_type'] =   $this->input->post('payment_type')[$i];
                // $pay['payment_checknum']=    $this->input->post('checknum')[$i];
                // $pay['payment_desc']=    $this->input->post('payment_desc')[$i];
                $pay['payment_amount'] = $this->input->post('payment_amount')[$i];
                // $pay['payment_credit']=  $this->input->post('payment_credit')[$i];
                // $pay['payment_username']=    $this->input->post('payment_username')[$i];
                // $pay['payment_modes']=   $this->input->post('payment_modes')[$i];
                // $pay['payment_deposite']=    $this->input->post('payment_deposite')[$i];

                $payment_inseart = $this->AdminModel->insertinvoicepayment($pay);
            }

            for ($i = 0; $i < count($this->input->post('pickup_item')); $i++) {
                $pickup['invoice_id']   =   $result;
                $pickup['pickup_info_item'] =   $this->input->post('pickup_item')[$i];
                $pickup['pickup_info_desc'] =   $this->input->post('pickup_desc')[$i];
                $pickup['pickup_info_quantity'] =   $this->input->post('pickup_quantity')[$i];
                $pickup['pickup_info_pickup_by'] =   $this->input->post('pickup_pickup_by')[$i];
                $pickup['pickup_info_pickup_date'] = $this->input->post('pickup_date')[$i];
                $pickup['pickup_info_notes'] =   $this->input->post('pickup_note')[$i];
                $pickup_inseart = $this->AdminModel->insertpickup_info($pickup);
            }

            for ($i = 0; $i < count($this->input->post('pickupreq_item')); $i++) {
                $pickup_req['invoice_id']   =   $result;
                $pickup_req['pickup_required_item'] =   $this->input->post('pickupreq_item')[$i];
                $pickup_req['pickup_required_quantity'] =   $this->input->post('pickupreq_quantity')[$i];
                $pickup_req['pickup_required_pickup']   =   $this->input->post('pickupreq_pickup')[$i];

                $pickup_req_inseart = $this->AdminModel->insertpickup_req($pickup_req);
            }

            for ($i = 0; $i < count($this->input->post('note_date')); $i++) {
                $note['invoice_id'] =   $result;
                $note['note_date']  =   $this->input->post('note_date')[$i];
                $note['note_time']  =   $this->input->post('note_time')[$i];
                $note['note_type']  =   $this->input->post('note_type')[$i];
                $note['note_desc']  =   $this->input->post('note_note')[$i];
                $note['note_user']  =   $this->input->post('note_user')[$i];

                $note_inseart = $this->AdminModel->insertinvoice_note($note);
            }

            for ($i = 0; $i < count($this->input->post('associated_invoice')); $i++) {
                $associated['invoice_id']   =   $result;
                $associated['associated_invoice']   =   $this->input->post('associated_invoice')[$i];
                $associated['associated_name']  =   $this->input->post('associated_name')[$i];
                $associated['associated_date_enter']    =   $this->input->post('associated_date_enter')[$i];
                $associated['associated_due_date']  =   $this->input->post('associated_due_date')[$i];
                $associated['associated_contract_type'] =   $this->input->post('associated_contract_type')[$i];
                $associated['associated_discount']  =   $this->input->post('associated_discount')[$i];
                $associated['associated_sub_total'] =   $this->input->post('associated_sub_total')[$i];
                $associated['associated_tax']   =   $this->input->post('associated_tax')[$i];
                $associated['associated_amount']    =   $this->input->post('associated_amount')[$i];
                $associated['associated_paid']  =   $this->input->post('associated_paid')[$i];
                $associated['associated_balance_due']   =   $this->input->post('associated_balance_due')[$i];
                $associated['associated_tax_rate']  =   $this->input->post('associated_tax_rate')[$i];
                $associated['associated_country']   =   $this->input->post('associated_county')[$i];
                $associated['associated_user']  =   $this->input->post('associated_user')[$i];

                $note_inseart = $this->AdminModel->insertinvoice_associated($associated);
            }
            $this->session->set_flashdata('success', "Invoice Saved Successfully..!!");
            //redirect('fi_home/custinvoices'); //Old
            redirect('fi_home/CustomerInvoice'); //New
        } else {
            $this->session->set_flashdata('error', "Invoice Not Saved ..!!");
            //redirect('fi_home/custinvoices'); //Old
            redirect('fi_home/CustomerInvoice'); //New
        }
        // print_r($result);die;
    }
    public function custpayments()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/custpayments', $data);
        $this->load->view('fi/footer');
    }
    public function custattachments()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/custattachments', $data);
        $this->load->view('fi/footer');
    }










    public function get_apppintment_id($appointmtnt_id)
    {

        $this->session->set_userdata('appointment_id', $appointmtnt_id);
        redirect('fi_home/to_do_list');
    }
    public function to_do_list()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();
        $data['custs'] = $this->AdminModel->search_data();
        $appointmtnt_id = $this->session->userdata('appointment_id');
        // echo $appointmtnt_id;die;
        if ($appointmtnt_id != "") {
            $data['appointment_data']  = $this->db->where('id', $appointmtnt_id)->get('customer_appointment')->result_array();
        } else {
            $data['appointment_data']  = "";
        }

        // echo "<pre>";print_r($data['appointment_data']);die;
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/to_do_appointment_list', $data);
        $this->load->view('fi/footer');
    }
    public function task_alert()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/cust_alerts', $data);
        $this->load->view('fi/footer');
    }
    public function administration()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['cat']      = $this->db->get('categories')->result_array();
        $data['cate'] = $this->db->get('categories_list')->result_array();
        // echo "<pre>";print_r($data['cat']);die;
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/administration', $data);
        $this->load->view('fi/footer');
    }



    public function crews_availability_report()
    {


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/crews-availability-report');
        $this->load->view('fi/footer');
    }



    public function bank_and_book_difference_report()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/bank-and-book-difference-report');
        $this->load->view('fi/footer');
    }

    public function checkbook_report()
    {


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/checkbook-report');
        $this->load->view('fi/footer');
    }

    public function bank_statement_view_report()
    {


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/bank-statement-view-report');
        $this->load->view('fi/footer');
    }

    public function bank_statement_viewby_account_report()
    {


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/bank-statement-view-by-account-report');
        $this->load->view('fi/footer');
    }

    public function profit_and_loss_report()
    {


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/profit-and-loss-report');
        $this->load->view('fi/footer');
    }

    public function delete_appointment($id)
    {

        $delete = $this->db->where('id', $id)->delete('customer_appointment');
        if ($delete > 0) {
            $this->session->set_flashdata('success', "Appointment Deleted Successfully..!!");
            redirect('fi_notes/view_todo');
        } else {
            $this->session->set_flashdata('error', "Appointment Not Deleted ..!!");
            redirect('fi_notes/view_todo');
        }
    }
    public function delete_sub_cate($id)
    {
        $delete = $this->db->where('sub_id', $id)->delete('sub_categories');
        if ($delete > 0) {
            $this->session->set_flashdata('success', "Sub Categories Deleted Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Sub Categories Not Deleted ..!!");
        }
        redirect('fi_home/view_sub_cat');
    }

    public function add_sub_cat($id)
    {
        $this->session->set_userdata('cat_id', $id);
        redirect('fi_home/view_sub_cat');
    }


    public function add_sub_cates()
    {

        // echo "<pre>";print_r($this->input->post());die;
        $item['cat_id'] =   $this->input->post('cat_id');
        $item['sub_name']   =   $this->input->post('sub_name');

        $result = $this->AdminModel->insertsubcatvalue($item);
        if ($result) {
            $this->session->set_flashdata('success', "Sub Categorie Added Successfully..!!");
            redirect('fi_home/view_sub_cat');
        } else {
            $this->session->set_flashdata('error', "Sub Categorie Not Created ..!!");
            redirect('fi_home/view_sub_cat');
        }
    }

    public function add_drop_categories()
    {

        // echo "<pre>";print_r($this->input->post());die;
        $item1  =   $this->input->post('add_drop_cat');
        $item['cat_name'] = ucfirst($item1);


        $result = $this->AdminModel->insertDropCategories($item);
        if ($result) {
            $this->session->set_flashdata('success', "Category Added Successfully..!!");
            redirect('fi_home/administration');
        } else {
            $this->session->set_flashdata('error', "Category Not Created ..!!");
            redirect('fi_home/administration');
        }
    }






    public function edit_letters($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $this->session->set_userdata('letters_id', $id);

        redirect('fi_home/edit_lettertemplate');
    }

    public function edit_lettertemplate()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $letters_id = $this->session->userdata('letters_id');
        $result['letter_data'] = $this->db->where('id', $letters_id)->get('adm_letters_type')->row_array();
        // echo "<pre>";print_r($result);die;


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/edit_lettertemplate', $result);
        $this->load->view('fi/footer');
    }

    public function editletter_template()
    {
        // echo "<pre>";print_r($_FILES);die;
        if ($_FILES['lettrimg']['name'] == "") {
            // echo "string";die;

            $crewsavlarr = array(
                "name" => $this->input->post('txtlettertyp'),
                "desc" => $this->input->post('textletterdetails'),
                // "attachment" => $img_nm
            );
        } else {
            // echo "string2";die;
            $img_nm;
            if (isset($_FILES['lettrimg']['name']) != "") {
                $config['upload_path']   = 'uploads/letters_attachments';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $img_nm = "";
                if ($this->upload->do_upload('lettrimg')) {
                    $data = array('upload_data' => $this->upload->data());
                    $img_nm = $this->upload->data('file_name');
                }
            } else {
                $img_nm = "";
            }

            $crewsavlarr = array(
                "name" => $this->input->post('txtlettertyp'),
                "desc" => $this->input->post('textletterdetails'),
                "attachment" => $img_nm
            );
        }

        $id = $this->input->post('letter_id');

        if ($this->db->where('id', $id)->update('adm_letters_type', $crewsavlarr)) {
            $this->session->set_flashdata('success', "Letter Updated Successfully..!!");
            redirect('fi_home/administration_letters');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong..!!");
            redirect('fi_home/administration_letters');
        }
    }




    public function view_invoices()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();
        $data['invoices'] = $this->db->get('invoices_create')->result_array();
        // print_r($data['invoices']);die;


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/custinvoices_view', $data);
        $this->load->view('fi/footer');
    }
    public function allcat()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['category'] = $this->db->get('category')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/listdriver', $data);
        $this->load->view('fi/footer', $data);
    }

    public function search_cust_mainsearch()
    {

        $cus_fname   = $this->input->post('q');
        if ($cus_fname != "") {
            $fname = $cus_fname;
        } else {
            $fname = "";
        }

        $cus_lname  = $this->input->post('q');
        if ($cus_lname != "") {
            $lname = $cus_lname;
        } else {
            $lname = "";
        }
        $cus_cname  = $this->input->post('q');
        if ($cus_cname != "") {
            $cname = $cus_cname;
        } else {
            $cname = "";
        }
        $cus_zname  = $this->input->post('q');
        if ($cus_zname != "") {
            $zname = $cus_zname;
        } else {
            $zname = "";
        }
        $cus_mname  = $this->input->post('q');
        if ($cus_mname != "") {
            $mname = $cus_mname;
        } else {
            $mname = "";
        }
        $adr11 = $this->input->post('q');
        if ($adr11 != "") {
            $adr1 = $adr11;
        } else {
            $adr1 = "";
        }
        // $adr22 = $this->input->post('adr1');
        // if ($adr22 !="") {
        //  $adr2 = $adr22;
        // }
        // else {
        //  $adr2 = "";
        // }

        $adr2 = "";

        $city = $this->input->post('q');
        if ($city != "") {
            $cities = $city;
        } else {
            $cities = "";
        }
        $state = $this->input->post('q');
        if ($state != "") {
            $states = $state;
        } else {
            $states = "";
        }
        $areas = $this->input->post('q');
        if ($areas != "") {
            $area = $areas;
        } else {
            $area = "";
        }

        $txtphoneno = $this->input->post('q');
        if ($txtphoneno != "") {
            $phone = $txtphoneno;
        } else {
            $phone = "";
        }


        $this->AdminModel->search_cust_mainsearch_dtls($fname, $lname, $cname, $zname, $mname, $adr1, $adr2, $cities, $states, $area, $phone);
    }



    public function fncustsrchbyph()
    {
        /*if(!isset($this->session->fi_session)){
            redirect('/','refresh');
        }*/

        $txtphoneno = $this->input->post('txtphoneno');
        if ($txtphoneno != "") {
            $phone = $txtphoneno;
        } else {
            $phone = "";
        }

        $this->AdminModel->fncustsrchbyph_dtls($phone);
    }







    public function registration()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/driverregister');
        $this->load->view('fi/footer');
    }



    public function cus_registration()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/cusregister');
        $this->load->view('fi/footer');
    }
    public function addcustomer()
    {


        if (isset($_FILES['image']['name']) != "") {


            $config['upload_path']   = './uploads/';

            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

            $this->load->library('upload', $config);

            $img_nm = "";

            if ($this->upload->do_upload('image')) {
                $data = array('upload_data' => $this->upload->data());
                $img_nm = "uploads/" . $this->upload->data('file_name');
            }

            $data['cus_profile_pic']  = $img_nm;

            if ($data['cus_profile_pic'] != "") {
                $data1['cus_name']         = $this->input->post('c_name');
                $data1['cus_mobile_no']    = $this->input->post('c_mobile');
                $data1['cus_email']        = $this->input->post('c_email');
                $data1['cus_address']      = $this->input->post('c_address');
                $data1['cus_city']         = $this->input->post('c_city');
                $data1['cus_profile_pic']  = $data['cus_profile_pic'];
                $data1['cus_reg_date']     = date("Y-m-d H:i:s");
                if ($this->AdminModel->insertcustomer($data1)) {
                    $this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
                    redirect('fi_home/listuser');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong..!');
                    redirect('fi_home/userlist');
                }
            } else {
                $data1['cus_name']         = $this->input->post('c_name');
                $data1['cus_mobile_no']    = $this->input->post('c_mobile');
                $data1['cus_email']        = $this->input->post('c_email');
                $data1['cus_address']      = $this->input->post('c_address');
                $data1['cus_city']         = $this->input->post('c_city');
                $data1['cus_reg_date']     = date("Y-m-d H:i:s");
                if ($this->AdminModel->insertcustomer($data1)) {
                    $this->session->set_flashdata('success', 'Customer Created SuccessFully ..!');
                    redirect('fi_home/listuser');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong..!');
                    redirect('fi_home/userlist');
                }
            }
        }
    }

    public function viewrides()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/viewrides');
        $this->load->view('fi/footer');
    }
    public function adminprofile()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user_data']                    =  $this->session->userdata('fi_session');
        $data['user_data']                   =  $this->db->get('users')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/adminprofile', $data);
        $this->load->view('fi/footer');
    }

    public function viewleads()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/viewleads');
        $this->load->view('fi/footer');
    }
    public function viewrjobs()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/viewjobs');
        $this->load->view('fi/footer');
    }


    public function profileupdate()
    {


        if (isset($_FILES['image']['name']) != "") {
            // echo "image selected";die;

            $config['upload_path']   = './uploads/';

            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

            $this->load->library('upload', $config);

            $img_nm = "";

            if ($this->upload->do_upload('image')) {
                $data = array('upload_data' => $this->upload->data());
                $img_nm = "uploads/" . $this->upload->data('file_name');
            }

            $data['profile_img']  = $img_nm;

            if ($data['profile_img'] != "") {
                $data['id']             = $this->input->post('id');
                $data['name']         = $this->input->post('firstName');
                $data['mobile_no']    = $this->input->post('mobilePhone');
                $data['email']        = $this->input->post('email');
                $data['password']     = base64_encode($this->input->post('password'));
                // echo "string";die;
                if ($this->AdminModel->updateprofile($data)) {
                    $this->session->set_flashdata('success', 'User Info Updated SuccessFully ..!');
                    redirect('fi_home/adminprofile');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong..!');
                    redirect('fi_home/adminprofile');
                }
            } else {
                $data['id']             = $this->input->post('id');
                $data['name']         = $this->input->post('firstName');
                $data['mobile_no']    = $this->input->post('mobilePhone');
                $data['email']        = $this->input->post('email');
                $data['password']     = base64_encode($this->input->post('password'));
                // echo "string1";die;
                if ($this->AdminModel->updateprofiledata($data)) {
                    $this->session->set_flashdata('success', 'User Info Updated SuccessFully ..!');
                    redirect('fi_home/adminprofile');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong..!');
                    redirect('fi_home/adminprofile');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong..!');
            redirect('fi_home/adminprofile');
        }
    }

    function listpromocode()
    {


        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['promocode'] = $this->db->where('promo_delete', 1)->get('promocodes')->result_array();
        $this->load->view('fi/header');
        $this->load->view('fi/viewpromocode', $data);
        $this->load->view('fi/footer', $data);
    }

    public function newpromocode()
    {

        $this->load->view('fi/header');
        $this->load->view('fi/addpromocode');
        $this->load->view('fi/footer');
    }
    public function addpromo()
    {

        // print_r($this->input->post());die;
        $data['promo_name']             = $this->input->post('p_name');
        $data['promo_type']             = $this->input->post('p_type');
        $data['promo_discount']       = $this->input->post('p_discount');
        $data['promo_exp']                  = $this->input->post('p_date');
        $data['promo_created_date']   = date("Y-m-d H:i:s");
        // print_r($data);die;
        if ($this->AdminModel->insertpromocode($data)) {
            $this->session->set_flashdata('success', 'Promocode Created SuccessFully ..!');
            redirect('fi_home/listpromocode');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong..!');
            redirect('fi_home/listpromocode');
        }
    }

    public function edit_promo($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $this->session->set_userdata('promo', $this->AdminModel->getpromo($id));
        redirect('fi_home/editpromoview');
    }

    public function editpromoview()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $coupondata['alert'] = $this->session->flashdata('alert');
        $coupondata['error'] = $this->session->flashdata('error');
        $coupondata['success'] = $this->session->flashdata('success');
        $coupondata['edit'] = $this->session->userdata('promo');
        // print_r($coupondata);die;
        $this->load->view('fi/header');
        $this->load->view('fi/editpromoform', $coupondata);
        $this->load->view('fi/footer');
    }

    public function editpro($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        // print_r($this->input->post());die;

        $editcus['promo_name']          = $this->input->post('p_name');
        $editcus['promo_type']              = $this->input->post('p_type');
        $editcus['promo_discount']    = $this->input->post('p_discount');
        $editcus['promo_exp']               = $this->input->post('p_date');

        if ($this->db->where('promo_id', $id)->update('promocodes', $editcus)) {
            $this->session->set_flashdata('success', 'Promocode Update SuccessFully...!');
            redirect('fi_home/listpromocode');
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong...!');
            redirect('fi_home/listpromocode');
        }
    }

    public function deactive_promo($promo_id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $deactive['promo_status'] = '2'; //2 means  Deactive from Database
        if ($this->db->where('promo_id', $promo_id)->update('promocodes', $deactive)) {
            $this->session->set_flashdata('success', 'Promocode Deactivate SuccessFully..!');
            redirect('fi_home/listpromocode');
        } else {
            $this->session->set_flashdata('error', 'Error..!');
            redirect('fi_home/listpromocode');
        }
    }
    public function active_promo($promo_id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $deactive['promo_status'] = '1'; //1 means  Active from Database
        if ($this->db->where('promo_id', $promo_id)->update('promocodes', $deactive)) {
            $this->session->set_flashdata('success', 'Promocode Deactivate SuccessFully..!');
            redirect('fi_home/listpromocode');
        } else {
            $this->session->set_flashdata('error', 'Error..!');
            redirect('fi_home/listpromocode');
        }
    }

    public function delete_promo($promo_id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $delete['promo_delete'] = '2'; //2 means  Delete for forever but remain in Database
        if ($this->db->where('promo_id', $promo_id)->update('promocodes', $delete)) {
            $this->session->set_flashdata('success', 'Promocode Deleted SuccessFully..!');
            redirect('fi_home/listpromocode');
        } else {
            $this->session->set_flashdata('error', 'Error..!');
            redirect('fi_home/listpromocode');
        }
    }


    public function getUserData()
    {
        $id = $this->input->post('id');
        $data = $this->AdminModel->getData($id);

        if ($data) {
            echo $data['cus_name'];
            // echo $id;
        } else {
            echo "0";
        }
    }

    public function edit($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $this->session->set_userdata('single', $this->AdminModel->getedit($id));
        redirect('fi_home/editview');
    }

    public function editview()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $coupondata['alert'] = $this->session->flashdata('alert');
        $coupondata['error'] = $this->session->flashdata('error');
        $coupondata['success'] = $this->session->flashdata('success');
        $coupondata['edit'] = $this->session->userdata('single');
        // print_r($coupondata);die;
        $this->load->view('fi/header');
        $this->load->view('fi/editform', $coupondata);
        $this->load->view('fi/footer');
    }

    public function editcus($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        // print_r($this->input->post());die;
        if (isset($_FILES['image']['name']) != "") {
            // echo "image selected";die;

            $config['upload_path']   = './uploads/';

            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

            $this->load->library('upload', $config);

            $img_nm = "";

            if ($this->upload->do_upload('image')) {
                $data = array('upload_data' => $this->upload->data());
                $img_nm = "uploads/" . $this->upload->data('file_name');
            }

            $data['cus_profile_pic']  = $img_nm;

            if ($data['cus_profile_pic'] != "") {
                $editcus['cus_name']        = $this->input->post('e_name');
                $editcus['cus_mobile_no']   = $this->input->post('e_mobile');
                $editcus['cus_email']           = $this->input->post('e_email');
                $editcus['cus_address']     = $this->input->post('e_address');
                $editcus['cus_city']          = $this->input->post('e_city');
                $editcus['cus_profile_pic'] = $data['cus_profile_pic'];

                if ($this->db->where('cus_id', $id)->update('customer', $editcus)) {
                    $this->session->set_flashdata('success', 'User Info Update SuccessFully...!');
                    redirect('fi_home/listuser');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong...!');
                    redirect('fi_home/listuser');
                }
            } else {
                $editcus['cus_name']        = $this->input->post('e_name');
                $editcus['cus_mobile_no']   = $this->input->post('e_mobile');
                $editcus['cus_email']           = $this->input->post('e_email');
                $editcus['cus_address']     = $this->input->post('e_address');
                $editcus['cus_city']          = $this->input->post('e_city');

                if ($this->db->where('cus_id', $id)->update('customer', $editcus)) {
                    $this->session->set_flashdata('success', 'User Info Update SuccessFully...!');
                    redirect('fi_home/listuser');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong...!');
                    redirect('fi_home/listuser');
                }
            }
        }
    }

    public function edit_driver($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $this->session->set_userdata('driver', $this->AdminModel->geteditdriver($id));
        redirect('fi_home/editdriverview');
    }

    public function editdriverview()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $coupondata['alert'] = $this->session->flashdata('alert');
        $coupondata['error'] = $this->session->flashdata('error');
        $coupondata['success'] = $this->session->flashdata('success');
        $coupondata['edit'] = $this->session->userdata('driver');
        // print_r($coupondata);die;
        $this->load->view('fi/header');
        $this->load->view('fi/editdriverform', $coupondata);
        $this->load->view('fi/footer');
    }

    public function editdriver($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        // print_r($this->input->post());die;
        if (isset($_FILES['image']['name']) != "") {
            // echo "image selected";die;

            $config['upload_path']   = './uploads/';

            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG';

            $this->load->library('upload', $config);

            $img_nm = "";

            if ($this->upload->do_upload('image')) {
                $data = array('upload_data' => $this->upload->data());
                $img_nm = "uploads/" . $this->upload->data('file_name');
            }

            $editdriver['driver_profile_pic']  = $img_nm;


            if ($editdriver['driver_profile_pic'] != "") {

                // $this->load->model('AdminModel');
                $editdriver['driver_name']              = $this->input->post('d_name');
                $editdriver['driver_phone']             = $this->input->post('d_mobile');
                $editdriver['driver_email']             = $this->input->post('d_email');
                $editdriver['driver_address']           = $this->input->post('d_address');
                $editdriver['driver_city']              = $this->input->post('d_city');
                // print_r($editdriver);die;
                if ($this->db->where('driver_id', $id)->update('driver_registration', $editdriver)) {
                    $this->session->set_flashdata('success', 'Driver Info Update SuccessFully...!');
                    redirect('fi_home/listdriver');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong...!');
                    redirect('fi_home/listdriver');
                }
            } else {
                $editdriver1['driver_name']             = $this->input->post('d_name');
                $editdriver1['driver_phone']            = $this->input->post('d_mobile');
                $editdriver1['driver_email']            = $this->input->post('d_email');
                $editdriver1['driver_address']              = $this->input->post('d_address');
                $editdriver1['driver_city']             = $this->input->post('d_city');
                if ($this->db->where('driver_id', $id)->update('driver_registration', $editdriver1)) {
                    $this->session->set_flashdata('success', 'Driver Info Update SuccessFully...!');
                    redirect('fi_home/listdriver');
                } else {
                    $this->session->set_flashdata('error', 'Something Went Wrong...!');
                    redirect('fi_home/listdriver');
                }
            }
        }
    }

    public function deletedriver($driver_id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $driverdelete['driver_active'] = '0'; //0 means  Delete for forever but remain in Database
        if ($this->db->where('driver_id', $driver_id)->update('driver_registration', $driverdelete)) {
            $this->session->set_flashdata('error', 'Driver Deleted SuccessFully..!');
            redirect('fi_home/listdriver');
        } else {
            $this->session->set_flashdata('error', 'Error..!');
            redirect('fi_home/listdriver');
        }
    }

    public function deletecustomer($id)
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $customerdelete['cus_is_active'] = '0'; //0 means  Delete for forever but remain in Database
        if ($this->db->where('cus_id', $id)->update('customer', $customerdelete)) {
            $this->session->set_flashdata('error', 'Customer Deleted SuccessFully..!');
            redirect('fi_home/listuser');
        } else {
            $this->session->set_flashdata('error', 'Error..!');
            redirect('fi_home/listuser');
        }
    }

    public function applyPayments()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        $coupondata['alert'] = $this->session->flashdata('alert');
        $coupondata['error'] = $this->session->flashdata('error');
        $coupondata['success'] = $this->session->flashdata('success');
        // print_r($coupondata);die;
        $this->load->view('fi/header');
        $this->load->view('fi/apply_payments', $coupondata);
        $this->load->view('fi/footer');
    }

    public function logout()
    {

        $session_array = array(
            'email'             => '',
            'name'            => '',
            'id'                => '',
            'mobile_no'     => '',
            'profile_img' => '',
            'type'          => ''
        );

        $this->session->set_flashdata('success', "Logout Successfully..!!");
        // $data['success']   = $this->session->flashdata('success');

        $this->session->unset_userdata('fi_session', $session_array);
        // print_r($session_array);die;
        redirect('/');
    }

    public function hebrew()
    {
        $dt = $this->input->post('status');
        $d1 = date('d', strtotime($dt));
        $d2 = date('m', strtotime($dt));
        $d3 = date('Y', strtotime($dt));

        //$d4 = date('D', strtotime($dt));
        $d4 = date('l', strtotime($dt));

        // echo $d1,$d2,$d3;die;
        // $jd = gregoriantojd($d1,$d2,$d3);
        // echo jdtojewish($jd, true);
        // echo jdtojewish(gregoriantojd($d1,$d2,$d3)); //.','.$d4
        //  $str = jdtojewish(gregoriantojd( $d2, $d1, $d3), true, CAL_JEWISH_ADD_GERESHAYIM); // for today
        // $str1 = iconv ('WINDOWS-1255', 'UTF-8', $str); // convert to utf-8
        //
        // echo $str1;
        $gregorianMonth = $d2;
        $gregorianDay = $d1;
        $gregorianYear = $d3;

        $jdDate = gregoriantojd($gregorianMonth, $gregorianDay, $gregorianYear);

        $hebrewMonthName = jdmonthname($jdDate, 4);

        $hebrewDate = jdtojewish($jdDate);

        list($hebrewMonth, $hebrewDay, $hebrewYear) = explode('/', $hebrewDate);

        echo ("$hebrewDay $hebrewMonthName $hebrewYear") . ',' . $d4;
    }


    public function fnloadcustlistbyphone()
    {
        $txtphonenum = $this->input->post('txtphonenum');
        $this->AdminModel->fnloadcustlistbyphone_dtls($txtphonenum);
    }

    public function fndeleventinfo()
    {
        $result = $this->AdminModel->fndeleventinfo_dtls();
    }

    public function fndellocationinfo()
    {
        $result = $this->AdminModel->fndellocationinfo_dtls();
    }

    public function fndelcrewsinfo()
    {
        $result = $this->AdminModel->fndelcrewsinfo_dtls();
    }

    public function fngetphonewisrhinv()
    {
        $result = $this->AdminModel->fngetphonewisrhinv_dtls();
    }


    public function search_evcustomer()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $cus_mobile = $this->input->get('mobile');
        $cus_id = $this->input->get('id');

        if ($cus_mobile != "" && $cus_id != "") {
            $this->session->set_userdata('mobile', $cus_mobile);
            $this->session->set_userdata('id', $cus_id);
            redirect('fi_home/search_new_customer');
        } else {
        }
    }

    public function search_new_customer()
    {

        $cus_id = $this->session->userdata('id');
        $cus_mobile = $this->session->userdata('mobile');
        $results = $this->AdminModel->chk_contactinfo_id_count($cus_id, $cus_mobile);
        if ($results > 0) {

            $event_data['single_cust']      = $this->AdminModel->search_data()[0];



            $event_data['event_data'] = $this->AdminModel->get_event_data_id($cus_id);

            //location table
            //$event_data['location_data']=$this->AdminModel->get_locationt_data_id($event_data['event_data']['event_id']);

            $event_data['location_data'] = $this->AdminModel->get_locationt_data_id($cus_id);


            // echo "<pre>"; print_r($event_data['location_data']);echo "<br>";
            //crews table
            //$event_data['crews_data']=$this->AdminModel->get_crews_data_id($event_data['event_data']['event_id']);

            $event_data['crews_data'] = $this->AdminModel->get_crews_data_id($cus_id);

            // echo "<pre>"; print_r($event_data['crews_data']);echo "<br>";

            // job info table
            //$event_data['job_info_data']=$this->AdminModel->get_job_info_data_id($event_data['event_data']['event_id']);
            // echo "<pre>"; print_r($event_data['job_info_data']);echo "<br>";

            // crews avability table
            //$event_data['crews_avability_data']=$this->AdminModel->get_crews_avability_data_id($event_data['event_data']['event_id']);
            // echo "<pre>"; print_r($event_data['crews_avability_data']);echo "<br>";

            //ASSOCIATED ORDER table
            //$event_data['associated_data']=$this->AdminModel->get_associated_data_id($event_data['event_data']['event_id']);

            // echo "<pre>"; print_r($event_data['associated_data_data']);echo "<br>";

            // AFFILIATED VENDOR table
            //$event_data['affiliated_vendor_data']=$this->AdminModel->get_affiliated_vendor_data_id($event_data['event_data']['event_id']);

            // echo "<pre>"; print_r($event_data['affiliated_vendor_data']);echo "<br>";

            $event_data['search']              =  $this->AdminModel->search_data();
            $event_data['event_name']    = $this->db->where('cat_id', 3)->get('sub_categories')->result_array();

            $get_loc = $this->db->query("SELECT * from add_location_event");

            $event_data['all_locs'] = $get_loc->result_array();
            $event_data['last_row'] = $this->db->where('cus_id', $cus_id)->get('register_customer')->result_array()[0];

            $event_data['all_crews'] = $this->db->where('cat_id', 4)->get('sub_categories')->result_array();

            $event_data['alert']    = $this->session->flashdata('alert');
            $event_data['error']    = $this->session->flashdata('error');
            $event_data['success']  = $this->session->flashdata('success');

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/cus_event_update', $event_data);
            $this->load->view('fi/footer');
        } else {

            $event_data['single_cust']      = array("contact_no" => $cus_mobile); //$this->AdminModel->search_data()[0];

            $event_data['search']        =  $this->AdminModel->search_data();
            $event_data['event_name']    = $this->db->where('cat_id', 3)->get('sub_categories')->result_array();

            $get_loc = $this->db->query("SELECT * from add_location_event");

            $event_data['all_locs'] = $get_loc->result_array();
            $event_data['last_row'] = $this->db->where('cus_id', $cus_id)->get('register_customer')->result_array()[0];

            $event_data['all_crews'] = $this->db->where('cat_id', 4)->get('sub_categories')->result_array();


            $event_data['event_data'] = $this->AdminModel->serch_get_event_data_id();

            $event_data['location_data'] = $this->AdminModel->serch_get_locationt_data_id();

            $event_data['crews_data'] = $this->AdminModel->serch_get_crews_data_id();




            $event_data['alert']    = $this->session->flashdata('alert');
            $event_data['error']    = $this->session->flashdata('error');
            $event_data['success']  = $this->session->flashdata('success');

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/cus_event_update', $event_data);
            $this->load->view('fi/footer');
        }
    }

    public function fnloadvendlistbyphone()
    {
        $txtphonenum = $this->input->post('txtphonenum');
        $this->AdminModel->fnloadvendlistbyphone_dtls($txtphonenum);
    }


















    public function find_vendor()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $cus_id = $this->input->get('id');

        if ($cus_id != "") {
            $this->session->set_userdata('id', $cus_id);
            redirect('fi_home/search_new_vendor');
        } else {
        }
    }

    public function search_new_vendor()
    {
        $cus_id = $this->session->userdata('id');
        $event_data['single_cust'] = $this->AdminModel->vendor_search_data()[0];
        $results = $this->AdminModel->get_vend_event_data_id($cus_id);

        $event_data['search'] = $this->AdminModel->vendor_search_data();
        $event_data['event_name'] = $this->db->where('cat_id', 3)->get('sub_categories')->result_array();
        $get_loc = $this->db->query("SELECT * from add_location_event");
        $event_data['all_locs'] = $get_loc->result_array();
        $event_data['last_row'] = $this->db->where('cus_id', $cus_id)->get('register_vendor')->result_array()[0];
        $event_data['all_crews'] = $this->db->where('cat_id', 4)->get('sub_categories')->result_array();
        $event_data['event_data'] = $this->AdminModel->get_vend_event_data_id($cus_id);
        $event_data['location_data'] = $this->AdminModel->get_vend_locationt_data_id($cus_id);
        $event_data['crews_data'] = $this->AdminModel->get_vend_crews_data_id($cus_id);

        $event_data['alert'] = $this->session->flashdata('alert');
        $event_data['error'] = $this->session->flashdata('error');
        $event_data['success'] = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/vendor/event_update', $event_data);
        $this->load->view('fi/footer');
    }


    public function fndelvendoreventinfo()
    {
        $result = $this->AdminModel->fndelvendoreventinfo_dtls();
    }

    public function fndelvendorlocationinfo()
    {
        $result = $this->AdminModel->fndelvendorlocationinfo_dtls();
    }

    public function fndelvendorcrewsinfo()
    {
        $result = $this->AdminModel->fndelvendorcrewsinfo_dtls();
    }

    public function fniteminfojson()
    {
        $result = $this->AdminModel->fniteminfojson_dtls();
    }

    public function search_items()
    {

        $adm_itemname   = $this->input->post('itemname');
        if ($adm_itemname != "") {
            $itemname = $adm_itemname;
        } else {
            $itemname = "";
        }
        $adm_itemdesc   = $this->input->post('itemdesc');
        if ($adm_itemdesc != "") {
            $itemdesc = $adm_itemdesc;
        } else {
            $itemdesc = "";
        }
        $adm_itemprice  = $this->input->post('itemprice');
        if ($adm_itemprice != "") {
            $itemprice = $adm_itemprice;
        } else {
            $itemprice = "";
        }

        $this->AdminModel->search_items_dtls($itemname, $itemdesc, $itemprice);
    }

    public function search_allitems()
    {
        $this->AdminModel->search_allitems_dtls();
    }

    public function delgencustomer()
    {
        $this->AdminModel->delgencustomer_dtls();
    }



    public function fndeleteaddicntinfo()
    {
        $this->AdminModel->fndeleteaddicntinfo_dtls();
    }





    public function fndelevntjobinfo()
    {
        $result = $this->AdminModel->fndelevntjobinfo_dtls();
    }





    public function addjobeventinfo()
    {
        $this->db->where("event_id", $this->input->post('hdneventId'));
        if ($this->db->delete('event_location')) {

            for ($i = 0; $i < count($this->input->post('add_location')); $i++) {


                if ($this->input->post('add_location')[$i] != "" || $this->input->post('ddate')[$i] != "") {

                    if ($this->input->post('add_location')[$i] != 'Choose') {

                        $location['event_id']   = $this->input->post('hdneventId'); //$result;
                        $location['location_type']  =   $this->input->post('add_location')[$i];
                        $location['location_date']  =   $this->input->post('ddate')[$i];
                        $location['location_time']  =   $this->input->post('time')[$i];
                        $location['location_address'] =  $this->input->post('address')[$i];
                        $location['location_city'] = $this->input->post('city')[$i];
                        $location['location_state'] =    $this->input->post('state')[$i];
                        $location['location_zip'] =  $this->input->post('zip')[$i];
                        $location['location_phone'] =    $this->input->post('phone')[$i];
                        $location['location_phone2'] =   $this->input->post('phone2')[$i];
                        //$location['location_landmark']=   $this->input->post('landmark')[$i];
                        $location['location_note'] = $this->input->post('note')[$i];

                        $result1 = $this->AdminModel->insertlocation($location);
                    }
                }
            }
        }

        //$this->db->where("event_id",$this->input->post('cuss_id'));
        $this->db->where("event_id", $this->input->post('hdneventId'));
        if ($this->db->delete('event_crews')) {

            for ($i = 0; $i < count($this->input->post('confirmed_on')); $i++) {
                if ($this->input->post('crewstype')[$i] != "") {


                    $crew['event_id']   = $this->input->post('hdneventId'); //$result;
                    $crew['crews_confirmed_on'] =   $this->input->post('confirmed_on')[$i];
                    $crew['crews_type'] =   $this->input->post('crewstype')[$i];
                    $crew['crews_vendor']   =   $this->input->post('vendortype')[$i];
                    $crew1['crews_commited']    =   $this->input->post('commited')[$i];
                    if ($crew1['crews_commited'] == 'on') {
                        $crew['crews_commited'] = 1;
                    } else {
                        $crew['crews_commited'] = 0;
                    }
                    $crew2['crews_hide'] =   $this->input->post('hide')[$i];
                    if ($crew2['crews_hide'] == 'on') {
                        $crew['crews_hide'] = 1;
                    } else {
                        $crew['crews_hide'] = 0;
                    }
                    $crew['crews_start_date'] =  $this->input->post('start_date')[$i];
                    $crew['crews_start_time'] =  $this->input->post('start_time')[$i];
                    $crew['crews_ending'] =  $this->input->post('ending')[$i];
                    $crew['crews_over_time'] =   $this->input->post('over_time')[$i];
                    $crew['crews_location'] =    $this->input->post('location')[$i];
                    $crew['crews_end_date'] =    $this->input->post('end_date')[$i];
                    $crew['crews_end_time'] =    $this->input->post('end_time')[$i];
                    $crew['crews_total_hours'] = $this->input->post('total_hours')[$i];
                    $crew['crews_total_charge'] =    $this->input->post('total_charge')[$i];

                    $result2 = $this->AdminModel->insertcrew($crew);
                }
            }
        }


        //   $this->db->where("job_id",$this->input->post('hdnjobId'));
        //   $this->db->where("event_id",$this->input->post('hdneventId'));
        //   if($this->db->delete('event_jobs_dtls'))
        //   {
        //   for ($i=0; $i < count($this->input->post('job_type')) ; $i++)
        //    {
        //      if($this->input->post('job_type')[$i]!="" )
        //                   {
        //                      $job_dtls['job_id'] =   $this->input->post('hdnjobId');
        //      $job_dtls['event_id']   =   $this->input->post('hdneventId'); //$result;
        //      $job_dtls['jobs_type']  =   $this->input->post('job_type')[$i];
        //      $job_dtls['jobs_fname'] =   $this->input->post('jfname')[$i];
        //      $job_dtls['jobs_spouse']    =   $this->input->post('spouse')[$i];
        //      $job_dtls['jobs_children']= $this->input->post('children')[$i];
        //      $job_dtls['jobs_crew_number']=  $this->input->post('jbcrmemventype')[$i];
        //      $job_dtls['jobs_start_time']=   $this->input->post('jbstart_time')[$i];
        //      $job_dtls['jobs_note']= $this->input->post('jbnote')[$i];
        //      $job_dtls['jobs_phone']=    $this->input->post('jbphone')[$i];

        //     $result3=$this->AdminModel->insertjobsdtls($job_dtls);
        //       }
        //    }
        // }



        $this->db->where("event_id", $this->input->post('hdneventId'));
        if ($this->db->delete('crew_availability')) {
            for ($i = 0; $i < count($this->input->post('atype')); $i++) {
                if ($this->input->post('atype')[$i] != "") {
                    $data_a['event_id'] = $this->input->post('hdneventId'); //$result;
                    $data_a['type'] =   $this->input->post('atype')[$i];
                    $data_a['vendor']   =   $this->input->post('cavailvend')[$i];
                    $data_a['start_date']   =   $this->input->post('castart_date')[$i];
                    $data_a['start_time'] =  $this->input->post('caastart_time')[$i];
                    $data_a['status'] =  $this->input->post('caastatus')[$i];
                    $data_a['note'] =    $this->input->post('canote')[$i];
                    //$data_a['email_availability']=    $this->input->post('email_availability')[$i];
                    //$data_a['add_to_crews']=  $this->input->post('add_to_crews')[$i];

                    $result4 = $this->AdminModel->insertcrew_availability($data_a);
                }
            }
        }



        // $this->db->where("event_id",$this->input->post('hdneventId'));
        // if($this->db->delete('crew_availability'))
        //   {
        //  for ($i=0; $i < count($this->input->post('atype')) ; $i++)
        //   {
        //  $data_a['event_id'] = $this->input->post('hdneventId'); //$result;
        //  $data_a['type'] =   $this->input->post('atype')[$i];
        //  $data_a['vendor']   =   $this->input->post('cavailvend')[$i];
        //  $data_a['start_date']   =   $this->input->post('castart_date')[$i];
        //  $data_a['start_time']=  $this->input->post('caastart_time')[$i];
        //  $data_a['status']=  $this->input->post('caastatus')[$i];
        //  $data_a['note']=    $this->input->post('canote')[$i];
        //  //$data_a['email_availability']=    $this->input->post('email_availability')[$i];
        //  //$data_a['add_to_crews']=  $this->input->post('add_to_crews')[$i];

        //  $result4=$this->AdminModel->insertcrew_availability($data_a);
        //      }
        //   }


        $this->session->set_flashdata('success', "Event Updated Successfully..!! ");
        //redirect('fi_home/custinvoices'); //Old
        redirect('fi_home/CustomerInvoice'); //New

    }

    public function fndelevntjobs_info()
    {
        $result = $this->AdminModel->fndelevntjobs_info_dtls();
    }


    public function getimpjobinfo()
    {
        $this->AdminModel->getimpjobinfo_dtls();
    }

    public function fncreatejob_info()
    {
        $this->AdminModel->fncreatejobinfo_dtls();
    }

    public function fnupdatejob_info()
    {
        $this->AdminModel->fnupdtjobinfo_dtls();
    }



    public function fncreatenwcrews_info()
    {
        $this->AdminModel->fncreatenwcrewsinfo_dtls();
    }

    public function fncreatenewcrewss_info()
    {
        $this->AdminModel->fncreatenewcrewssinfo_dtls();
    }

    public function getletterinfo()
    {
        $this->AdminModel->getletterinfo_dtls();
    }

    public function sendeventletteremail()
    {
        $this->AdminModel->sendeventletteremail_dtls();
    }



    public function edit_crewtemplate()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $crew_temp_id = $this->session->userdata('template_id');
        $result['crew_data'] = $this->db->where('id', $crew_temp_id)->get('adm_crewavailability_info')->row_array();
        // echo "<pre>";print_r($result);die;
        $result['temp_cat']       = $this->db->select('template_name')->get('adm_crewavailability_info')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/edit_crewtemplate', $result);
        $this->load->view('fi/footer');
    }





    public function editcrew_template()
    {
        $crewsavlarr = array(
            "name" => $this->input->post('txtlettertyp'),
            "template_name" => $this->input->post('template_name'),
            "desc" => $this->input->post('textletterdetails')
        );
        $id = $this->input->post('temp_id');
        $this->db->where('id', $id);
        if ($this->db->update('adm_crewavailability_info', $crewsavlarr)) {
            $this->session->set_flashdata('success', "Crew Updated Successfully..!!");
            redirect('fi_home/administration_crewavailability');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong..!!");
            redirect('fi_home/administration_crewavailability');
        }
    }



    public function sendletteremail()
    {

        //echo "<pre>"; print_r($_FILES)."<br>";

        //echo "<pre>"; print_r($_POST);die;



        $to = $_POST['lnwcustemail'];
        $sub = $_POST['leteremailsub'];
        $message = $_POST['leteremaildesc'];
        $attachmnt = site_url('/uploads/letters_attachments/') . $_POST['flname'];
        $attachmentname = $_POST['flname'];

        $fileData = array();
        $files = $_FILES;



        /* $file1 = fopen($attachmnt,"rb");
        $data1 = fread($file1,filesize($attachmnt));
        fclose($file1);*/
        $data1 = chunk_split(base64_encode($attachmnt));

        /*if(!empty($_FILES['limg']['name']))
     {
          //$filesCount = count($_FILES['limg']['name']);

            //echo "filesCount--".$filesCount;die;

            for($i = 0; $i < $filesCount; $i++){
                $_FILES['limg']['name'] = $files['limg']['name'][$i];
                $_FILES['limg']['type'] = $files['limg']['type'][$i];
                $_FILES['limg']['tmp_name'] = $files['limg']['tmp_name'][$i];
                $_FILES['limg']['error'] = $files['limg']['error'][$i];
                $_FILES['limg']['size'] = $files['limg']['size'][$i];
                $config['upload_path']   = 'uploads/crew_mails';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
                $config['overwrite']     = FALSE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('limg')){
                 $fileData[] = $this->upload->data();
                 //$uploadImgData[$i]['limg'] = $fileData['file_name'];


                $this->load->library('email');//mike222taylor@gmail.com
               //$config['charset'] = 'iso-8859-1';
                //$config['wordwrap'] = TRUE;
                //$config['mailtype'] = 'html';
                //$this->email->initialize($config);


                 //$this->email->set_mailtype("html");
                 //$this->email->from('info@tech599.com', 'ERP SYSTEM- Event Letter');
                 $this->email->from('info@tech599.com', 'ERP SYSTEM- Event Letter');
                 $this->email->to($to);
                 $this->email->subject($sub);
                 $this->email->message($msg);
                    $pathToUploadedFile = $fileData[$i]['full_path'];
                    $this->email->attach($pathToUploadedFile);
                }
            }

            $this->email->attach($attachmnt);
            $this->email->send();
*/

        //$this->email->set_mailtype("html");
        //$this->email->set_header('Content-Type', 'text/html');
        /*if($this->email->send())
            {
                echo "success"; die;
            }else{
                echo "fail"."<br>";
                //echo show_error($this->email->print_debugger());

                echo $this->email->print_debugger(array('headers')); die;
            }
*/
        //$headers = "MIME-Version: 1.0" . "\r\n";
        //$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // headers for attachment
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        $headers = "From: info@tech599.com";
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // multipart boundary
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
        $message .= "--{$mime_boundary}\n";


        // preparing attachments
        if (isset($_FILES['limg'])) {
            if (count($_FILES['limg']['name']) > 0) {
                //echo count($_FILES['limg']['name']); die;
                for ($x = 0; $x < count($_FILES['limg']['name']); $x++) {
                    $file = fopen($_FILES['limg']['tmp_name'][$x], "rb");
                    $data = fread($file, filesize($_FILES['limg']['tmp_name'][$x]));
                    fclose($file);
                    $data = chunk_split(base64_encode($data));
                    $name = $_FILES['limg']['name'][$x];

                    $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" . "Content-Disposition: attachment;\n" . " filename=\"$name\"\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    $message .= "--{$mime_boundary}\n";
                }

                $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$attachmnt\"\n" . "Content-Disposition: attachment;\n" . " filename=\"$attachmentname\"\n" . "Content-Transfer-Encoding: base64\n\n" . $data1 . "\n\n";
                $message .= "--{$mime_boundary}\n";
            }
        }
        if (mail($to, $sub, $message, $headers)) {
            //echo "success"; die;
            $this->session->set_flashdata('success', "Mail Send Successfully..!!");
            redirect('fi_home/search_new_cus');
        } else {
            //echo "fail"; die;
            $this->session->set_flashdata('error', "Please Try After Again..!");
            redirect('fi_home/search_new_cus');
        }


        // $this->session->set_flashdata('success',"Mail Send Successfully..!!");
        // redirect('fi_home/search_new_cus');
        //}

    }

    public function getcrewavailabilityinfo()
    {
        $this->AdminModel->getcrewavailabilityinfo_dtls();
    }





    public function sendnewgeninfoemail()
    {

        $to = $_POST['nwcustemail'];
        $sub = $_POST['letteremailsub'];
        $msg = $_POST['letteremaildesc'];

        $fileData = array();
        $files = $_FILES;

        if (!empty($_FILES['crewavl']['name'])) {
            $filesCount = count($_FILES['crewavl']['name']);

            //echo "filesCount--".$filesCount;die;

            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['crewavl']['name'] = $files['crewavl']['name'][$i];
                $_FILES['crewavl']['type'] = $files['crewavl']['type'][$i];
                $_FILES['crewavl']['tmp_name'] = $files['crewavl']['tmp_name'][$i];
                $_FILES['crewavl']['error'] = $files['crewavl']['error'][$i];
                $_FILES['crewavl']['size'] = $files['crewavl']['size'][$i];
                $config['upload_path']   = 'uploads/crew_mails';
                $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jepg|JEPG|pdf|PDF';
                $config['overwrite']     = FALSE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('crewavl')) {
                    $fileData[] = $this->upload->data();
                    //$uploadImgData[$i]['crewavl'] = $fileData['file_name'];

                    $this->load->library('email');
                    $this->email->from('info@gmail.com', 'ERP SYSTEM- General information');
                    $this->email->to($to);
                    $this->email->subject($sub);
                    $this->email->message($msg);
                    $pathToUploadedFile = $fileData[$i]['full_path'];
                    $this->email->attach($pathToUploadedFile);
                }
            }

            $this->email->send();

            $this->session->set_flashdata('success', "Mail Send Successfully..!!");
            redirect('fi_home/newGeneralInfo');
        }
    }

    public function delinvnote()
    {
        $result = $this->AdminModel->delinvnote_dtls();
    }

    public function fnpickupreq_info()
    {
        $this->AdminModel->fnpickupreqinfo_dtls();
    }
    public function fnpickupreq_info_update()
    {
        $this->AdminModel->fnpickupreq_info_update_dtls();
    }

    public function fnupreqtqy_info()
    {
        $this->AdminModel->fnupreqtqyinfo_dtls();
    }

    public function fndelpickupreq_info()
    {
        $this->AdminModel->fndelpickupreqinfo_dtls();
    }

    public function updinvpckgamt()
    {
        $result = $this->AdminModel->updinvpckgamt_dtls();
    }

    public function updtinvevnttype()
    {
        $result = $this->AdminModel->updtinvevnttype_dtls();
    }

    public function getSearchInvInfo()
    {
        $this->AdminModel->getSearchInvInfo_dtls();
    }

    public function addtermsinfo()
    {
        $letterarr = array(
            "name" => $this->input->post('txttermstyp'),
            "amount" => $this->input->post('textamount'),
        );

        $getexist_sql = $this->db->where('name', $this->input->post('txttermstyp'))->get('adm_terms_type');
        $rowCount = $getexist_sql->num_rows();
        if ($rowCount == 1) {
            $this->db->where('name', $this->input->post('txttermstyp'));
            if ($this->db->update('adm_terms_type', $letterarr)) {
                $this->session->set_flashdata('success', "Terms Updated Successfully..!!");
                redirect('fi_home/administration_terms');
            }
        } else {

            if ($this->db->insert('adm_terms_type', $letterarr)) {
                $this->session->set_flashdata('success', "Terms Inserted Successfully..!!");
                redirect('fi_home/administration_terms');
            }
        }
    }

    public function fndeltremsinfo()
    {
        $result = $this->AdminModel->fndeltremsinfo_dtls();
    }

    public function gettermsinfo()
    {
        $result = $this->AdminModel->gettermsinfo_dtls();
    }

    public function crnewinvterms()
    {
        $this->AdminModel->crnewinvterms_dtls();
    }

    public function delterms()
    {
        $result = $this->AdminModel->delterms_dtls();
    }

    public function updtermamt()
    {
        $result = $this->AdminModel->updtermamt_dtls();
    }

    public function crnwtask()
    {
        $this->AdminModel->crnwtask_dtls();
    }

    public function fndeltaskinfo()
    {
        $result = $this->AdminModel->fndeltaskinfo_dtls();
    }

    public function updtask()
    {
        $result = $this->AdminModel->updtask_dtls();
    }

    public function get_reminder_data()
    {
        $current_date = date("Y-m-d H:i:s");
        $sql_uery = "SELECT r.*,c.app_desc,rc.cus_lname FROM `reminder_entry` r join customer_appointment c on r.reminder_id=c.id join register_customer rc on c.cus_id=rc.cus_id WHERE r.reminder_datetime <='$current_date' AND r.reminder_status=0";
        $data     = $this->db->query($sql_uery)->result_array();
        if (!empty($data)) {
            echo count($data);
        } else {
            echo "0";
        }
    }

    public function crinvnwtask()
    {
        $this->AdminModel->crinvnwtask_dtls();
    }

    public function fndelinvtaskinfo()
    {
        $this->AdminModel->fndelinvtaskinfo_dtls();
    }

    public function updinvtask()
    {
        $this->AdminModel->updinvtask_dtls();
    }

    public function updinvtaskinfo()
    {
        $this->AdminModel->updinvtaskinfo_dtls();
    }



    public function fncrtevntjobinfo()
    {
        $this->AdminModel->fncrtevntjobinfo_dtls();
    }

    public function fncrtnewjobdtinfo()
    {
        $this->AdminModel->fncrtnewjobdtinfo_dtls();
    }



    public function fncheckispackage()
    {
        $this->AdminModel->fncheckispackage_dtls();
    }

    public function fnupdatepckginfo()
    {
        $result = $this->AdminModel->fnupdatepckginfo_dtls();
    }


    public function fninsertjobinfo()
    {
        $this->AdminModel->fninsertjobinfo_dtls();
    }

    public function fninsertjobinfonote()
    {
        $this->AdminModel->fninsertjobinfonote_dtls();
    }

    public function fninsertjobtypdtls()
    {
        $this->AdminModel->fninsertjobtypdtls_dtls();
    }

    public function new_administration_terms()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        // $data['user']      = $this->db->get('user_register')->result_array();

        $item_info = $this->db->query("SELECT * from admin_item");

        $data['all_items'] = $item_info->result_array();
        // echo "<pre>"; print_r($data['all_items']);die;
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/new_administration_terms', $data);
        $this->load->view('fi/footer');
    }


    public function delselconracttype()
    {
        $result = $this->AdminModel->delselconracttype_dtls();
    }


    public function admin_addnewterms()
    {


        $pckname = $this->input->post('item_package_name');
        $chkpackgeres = $this->AdminModel->isChkExistContract($pckname);

        if ($chkpackgeres == "Not Exists") {

            for ($i = 0; $i < count($this->input->post('i_name')); $i++) {
                $item1['subcat_id'] = $this->input->post('item_package_name');
                $item1['name']  =   $this->input->post('i_name')[$i];
                $item1['amount']    =   $this->input->post('itmdesc')[$i];
                $result1 = $this->AdminModel->insertterms($item1);
            }

            // print_r($item1); die;
            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');

            if ($result1) {
                $this->session->set_flashdata('success', "Contract Type & Terms added successfully..!!");
                redirect('fi_home/administration_terms');
            } else {
                $this->session->set_flashdata('error', "Contract Type & Terms not created..!!");
                redirect('fi_home/new_administration_terms');
            }
        } else if ($chkpackgeres == "IsExists") {

            $this->session->set_flashdata('error', "This Contract Type Already Exists..!!");
            redirect('fi_home/new_administration_terms');
        }
    }



    public function crnewpterms()
    {
        $result = $this->AdminModel->crnewpterms_dtls();
    }

    public function delnewpterms()
    {
        $result = $this->AdminModel->delnewpterms_dtls();
    }

    public function fnupdtrmsinfo()
    {
        $this->AdminModel->fnupdtrmsinfo_dtls();
    }
    public function fninseartrmsinfo()
    {
        $this->AdminModel->fninseartrmsinfo_dtls();
    }

    public function fnupdateinvtermsinfo()
    {
        $this->AdminModel->fnupdateinvtermsinfo_dtls();
    }


    public function geteventinfojson()
    {
        $this->AdminModel->geteventinfojson_dtls();
    }

    public function viewpostdate()
    {

        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/datetest', $data);
        $this->load->view('fi/footer');
    }

    public function chkpostdata()
    {
        $this->AdminModel->chkpostdata_dtls();
    }



    public function updtatsksinfo()
    {
        $this->AdminModel->updtatsksinfo_dtls();
    }

    public function deltasksinfo()
    {
        $result = $this->AdminModel->deltasksinfo_dtls();
    }


    public function updtatskscolorinfo()
    {
        $this->AdminModel->updtatskscolorinfo_dtls();
    }
    public function fndelsubtasksinfo()
    {
        $result = $this->AdminModel->fndelsubtasksinfo_dtls();
    }

    public function insertsubtsksinfo()
    {
        $this->AdminModel->insertsubtsksinfo_dtls();
    }
    public function fnupdtesubtasksinfo()
    {
        $this->AdminModel->fnupdtesubtasksinfo_dtls();
    }
    public function loadsubtaskslist()
    {
        $this->AdminModel->loadsubtaskslist_dtls();
    }
    public function insrtinvtaskinfo()
    {
        $this->AdminModel->insrtinvtaskinfo_dtls();
    }

    public function updtinvtaskinfo()
    {
        $this->AdminModel->updtinvtaskinfo_dtls();
    }

    public function updtinvstrtdtaskinfo()
    {
        $this->AdminModel->updtinvstrtdtaskinfo_dtls();
    }

    public function updtodostatusinfo()
    {
        $this->AdminModel->updtodostatusinfo_dtls();
    }

    public function deltaskstatusinfo()
    {
        $result = $this->AdminModel->deltaskstatusinfo_dtls();
    }
    public function deltodostatusinfo()
    {
        $result = $this->AdminModel->deltodostatusinfo_dtls();
    }

    public function updtatskstatuscolorinfo()
    {
        $this->AdminModel->updtatskstatuscolorinfo_dtls();
    }
    public function updtodostatuscolorinfo()
    {
        $this->AdminModel->updtodostatuscolorinfo_dtls();
    }

    public function update_eventdate()
    {
        $this->AdminModel->update_event_date();
    }

    public function update_field()
    {
        $this->AdminModel->update_field();
    }

    public function fncreatenewlocation()
    {
        $this->AdminModel->fncreatenewlocation_dtls();
    }

    public function fncreatelocation()
    {
        $this->AdminModel->fncreatelocation_dtls();
    }

    public function fninsertcrews()
    {
        $this->AdminModel->fninsertcrews_dtls();
    }

    public function fnupdateitemqtyinfo()
    {
        $this->AdminModel->fnupdateitemqtyinfo_dtls();
    }

    public function fnupdateitemtaxinfo()
    {
        $this->AdminModel->fnupdateitemtaxinfo_dtls();
    }




    public function fninvdescounttypinfo()
    {
        $this->AdminModel->fninvdescounttypinfo_dtls();
    }



    public function fnupdateitemsinfo()
    {
        $this->AdminModel->fnupdateitemsinfo_dtls();
    }

    public function fnupdateinvcounteyinfo()
    {
        $this->AdminModel->fnupdateinvcounteyinfo_dtls();
    }

    public function get_account_details()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $cus_id = $this->input->post('cus_id');
        $user_info = $this->db->query("SELECT * from register_customer where cus_id=$cus_id")->result_array()[0];



        echo $user_info['cus_lname'] . ", " . $user_info['cus_fname'] . " - " . $user_info['cus_company_name'] . " - " . $user_info['cus_acc_no'];
        // echo "<pre>"; print_r($data['all_items']);die;

    }
    public function get_account_details_event()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }

        $cus_id = $this->input->post('cus_id');
        $user_info = $this->db->query("SELECT * from register_customer where cus_id=$cus_id")->result_array()[0];



        echo $user_info['cus_lname'] . " - " . $user_info['cus_company_name'];
        // echo "<pre>"; print_r($data['all_items']);die;

    }


    public function event_all_data_save()
    {
        if (!isset($this->session->fi_session)) {
            redirect('/', 'refresh');
        }
        // print_r($this->input->post());die;
        $this->db->where("event_id", $this->input->post('hdneventId'));
        if ($this->db->delete('event_location')) {

            for ($i = 0; $i < count($this->input->post('add_location')); $i++) {


                if ($this->input->post('add_location')[$i] != "" || $this->input->post('ddate')[$i] != "") {

                    if ($this->input->post('add_location')[$i] != 'Choose') {

                        $location['event_id'] = $this->input->post('hdneventId'); //$result;
                        $location['location_type']  = $this->input->post('add_location')[$i];
                        $location['location_date']  = date("Y-m-d", strtotime($this->input->post('ddate')[$i]));
                        $location['location_time']  = $this->input->post('time')[$i];
                        $location['location_address'] =  $this->input->post('address')[$i];
                        $location['location_city'] = $this->input->post('city')[$i];
                        $location['location_state'] =  $this->input->post('state')[$i];
                        $location['location_zip'] =  $this->input->post('zip')[$i];
                        $location['location_phone'] =  $this->input->post('phone')[$i];
                        $location['location_phone2'] = $this->input->post('phone2')[$i];
                        //$location['location_landmark']= $this->input->post('landmark')[$i];
                        $location['location_note'] = $this->input->post('note')[$i];

                        $result1 = $this->AdminModel->insertlocation($location);
                    }
                }
            }
        }

        //$this->db->where("event_id",$this->input->post('cuss_id'));
        $this->db->where("event_id", $this->input->post('hdneventId'));
        if ($this->db->delete('event_crews')) {

            for ($i = 0; $i < count($this->input->post('confirmed_on')); $i++) {
                if ($this->input->post('crewstype')[$i] != "") {


                    $crew['event_id'] = $this->input->post('hdneventId'); //$result;
                    $crew['crews_confirmed_on'] = date("Y-m-d", strtotime($this->input->post('confirmed_on')[$i]));
                    $crew['crews_type'] = $this->input->post('crewstype')[$i];
                    $crew['crews_vendor'] = $this->input->post('vendortype')[$i];
                    $crew1['crews_commited']  = $this->input->post('commited')[$i];
                    if ($crew1['crews_commited'] == 'on') {
                        $crew['crews_commited'] = 1;
                    } else {
                        $crew['crews_commited'] = 0;
                    }
                    $crew2['crews_hide'] = $this->input->post('hide')[$i];
                    if ($crew2['crews_hide'] == 'on') {
                        $crew['crews_hide'] = 1;
                    } else {
                        $crew['crews_hide'] = 0;
                    }
                    $crew['crews_start_date'] =  date("Y-m-d", strtotime($this->input->post('start_date')[$i]));
                    $crew['crews_start_time'] =  $this->input->post('start_time')[$i];
                    $crew['crews_ending'] =  $this->input->post('ending')[$i];
                    $crew['crews_over_time'] = $this->input->post('over_time')[$i];
                    $crew['crews_location'] =  $this->input->post('location')[$i];
                    $crew['crews_end_date'] =  date("Y-m-d", strtotime($this->input->post('end_date')[$i]));
                    $crew['crews_end_time'] =  $this->input->post('end_time')[$i];
                    $crew['crews_total_hours'] = $this->input->post('total_hours')[$i];
                    $crew['crews_total_charge'] =  $this->input->post('total_charge')[$i];

                    $result2 = $this->AdminModel->insertcrew($crew);
                }
            }
        }


        /*$this->db->where("event_id",$this->input->post('hdneventId'));
             if($this->db->delete('event_jobs'))
             {
                for ($i=0; $i < count($this->input->post('jptype')) ; $i++)
                 {
                     if($this->input->post('jptype')[$i]!="" )
                                        {
                    $job_data['event_id'] = $this->input->post('hdneventId'); //$result;
                    $job_data['jb_type']  = $this->input->post('jptype')[$i];
                    $job_data['jb_name']  = $this->input->post('jbname')[$i];
                    $job_data['jb_notes'] = $this->input->post('jnote')[$i];
                    $job_data['jb_import']  = $this->input->post('jimpevntype')[$i];

                     $result3=$this->AdminModel->insertjobs($job_data);
                        }
                 }
            }*/

        $sqlupevntname = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $this->input->post('hdneventId') . "' ORDER BY jb_id DESC LIMIT 2");
        $upevnamenrow = $sqlupevntname->num_rows();
        if ($upevnamenrow > 0) {
            $cntname = "";
            foreach ($sqlupevntname->result() as $sqlupevntname_dtls) {
                $cntname .= $sqlupevntname_dtls->jb_name . "-";
            }

            $upcntname = rtrim($cntname);
            $upevntnamearr = array(
                "event_name" => $upcntname
            );
            $this->db->where('event_id', $this->input->post('hdneventId'));
            $this->db->update('events_register', $upevntnamearr);
        }
        $this->db->where("event_id", $this->input->post('hdneventId'));
        if ($this->db->delete('crew_availability')) {
            $crw = array();
            for ($i = 0; $i < count($this->input->post('atype')); $i++) {

                if ($this->input->post('atype')[$i] != "") {

                    $data_a['event_id'] = $this->input->post('hdneventId'); //$result;
                    $data_a['type'] = $this->input->post('atype')[$i];
                    $data_a['vendor'] = $this->input->post('cavailvend')[$i];
                    $data_a['start_date'] = date("Y-m-d", strtotime($this->input->post('castart_date')[$i]));
                    $data_a['start_time'] =  $this->input->post('caastart_time')[$i];
                    $data_a['status'] =  $this->input->post('caastatus')[$i];
                    $data_a['note'] =  $this->input->post('canote')[$i];
                    //$data_a['email_availability']=  $this->input->post('email_availability')[$i];
                    //$data_a['add_to_crews']= $this->input->post('add_to_crews')[$i];
                    $data_a1['add_to_crews'] = $this->input->post('add_to_crews')[$i];
                    if ($data_a1['add_to_crews'] == 'on') {
                        $data_a['add_to_crews'] = 1;
                    } else {
                        $data_a['add_to_crews'] = 0;
                    }

                    $result4 = $this->AdminModel->insertcrew_availability($data_a);
                }
            } //for end

            //crew_availability
            $crwavailsql = $this->db->query("SELECT * FROM crew_availability WHERE add_to_crews=1 AND event_id='" . $this->input->post('hdneventId') . "'");

            foreach ($crwavailsql->result() as $crwavailsql_dtls) {
                if ($crwavailsql_dtls->type != "") {
                    $crwinsertarr = array();

                    $crwinsertarr = array(
                        "event_id" => $crwavailsql_dtls->event_id,
                        "crews_type" => $crwavailsql_dtls->type,
                        "crews_vendor" => $crwavailsql_dtls->vendor,
                        "crews_start_date" => $crwavailsql_dtls->start_date,
                        "crews_start_time" => $crwavailsql_dtls->start_time,
                        "user" => $this->session->fi_session['id']
                    );
                    $this->db->insert('event_crews', $crwinsertarr);
                }
            } //die;
            //print_r($crw);die;
            $deleted = $this->db->where('add_to_crews', 1)
                ->where('event_id', $this->input->post('hdneventId'))
                ->delete('crew_availability');
        }
    }



    public function print_inv()
    {
        //$this->load->library('pdf');

        // $invid = $this->uri->segment(3);

        $this->load->view('fi/invoice_print');


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
    }


    //Delete after August 07,2021
    //Prasanna MAne
    //Updated March 07, 2021

    public function update_administration_package($id = 0)
    {

        //SELECT `id`, `package_id`, `item_name`, `item_quantity`, `item_price`, `item_desc`, `item_created_at`, `user` FROM `admin_package_item` WHERE 1
        //SELECT `package_id`, `package_name`, `package_desc`, `package_price`, `package_taxable`, `package_create_date`, `user` FROM `admin_package` WHERE 1
        $cond = array('package_id' => $id);
        $tbl = "admin_package";
        $data['package'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $cond = array('package_id' => $id);
        $tbl = "admin_package_item";
        $data['package_item'] = $this->HomeModel->get_all_by_cond($tbl, $cond);
        $data['item_count'] = count($data['package_item']) - 1;

        $tbl = "admin_item";
        $data['all_items'] = $this->HomeModel->get_all($tbl);

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');
        $data['id']  = $id;


        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/update_packages', $data);
        $this->load->view('fi/footer');
    }

    public function administration_package()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'admin_item';
        $data['all_items'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'admin_package';
        $data['admin_package'] = $this->HomeModel->get_all_by_cond($tbl, $cond);



        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/packages', $data);
        $this->load->view('fi/footer');
    }

    public function admin_item()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'admin_item';
        $data['item'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/items', $data);
        $this->load->view('fi/footer');
    }

    public function administration_info()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'company_info';
        $info = $this->HomeModel->get_all_by_cond($tbl, $cond);
        $data['info'] = $info[0];

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/administration_info', $data);
        $this->load->view('fi/footer');
    }

    public function administration_locations()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'add_location_event';
        $data['location'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $data['page_title'] = "Locations";

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/locations', $data);
        $this->load->view('fi/footer');
    }

    public function administration_tax()
    {
        $data[] = "";

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_tax', $data);
        $this->load->view('fi/footer');
    }

    public function admin_search()
    {
        $data['page_title'] = "Search Options";

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $data['item']     = $this->db->order_by('item_name')->get('admin_item')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/search', $data);
        $this->load->view('fi/footer');
    }

    public function admin_todotatus()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'adm_todo_status';
        $data['tasktypelist'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/todo_status', $data);
        $this->load->view('fi/footer');
    }

    public function admin_taskstatus()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'adm_task_status';
        $data['tasktypelist'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/tasks_status', $data);
        $this->load->view('fi/footer');
    }

    public function administration_task()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'adm_task_type';
        $data['tasktypelist'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_tasks', $data);
        $this->load->view('fi/footer');
    }

    public function administration_terms()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_contractterms', $data);
        $this->load->view('fi/footer');
    }

    public function administration_crewavailability()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'adm_crewavailability_info';
        $data['template_data'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_crewavailability', $data);
        $this->load->view('fi/footer');
    }

    public function administration_notes()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_notes', $data);
        $this->load->view('fi/footer');
    }



    public function editinfo()
    {
        $user   =   $this->session->fi_session['id'];
        $tbl    =   'company_info';
        $img_nm =   '';

        $config['upload_path']   = 'uploads/company_info';
        $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG|jpeg|JPEG|';

        $this->upload->initialize($config);

        if (isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])) {
            $img_nm = "";

            if ($this->upload->do_upload('logo')) {
                $data = array('upload_data' => $this->upload->data());
                $img_nm = "uploads/company_info/" . $this->upload->data('file_name');
            }
        }

        $item['company_name']           =   $this->input->post('c_name');
        $item['company_address']        =   $this->input->post('c_address');
        $item['company_city']           =   $this->input->post('c_city');
        $item['company_zip']            =   $this->input->post('c_zip');
        $item['company_state']          =   $this->input->post('c_state');
        $item['company_tax_rate']       =   $this->input->post('c_tax');
        $item['company_support_key']    =   $this->input->post('c_key');

        if ($img_nm != "") {
            $item['company_logo']   =   $img_nm;
        }
        $this->db->where('user', $user);
        $this->db->update($tbl, $item);
        $res = $this->db->affected_rows();

        if ($res > 0) {
            $this->session->set_flashdata('success', "Company Address Updated Successfully..!!");
        } else {
            $item['user'] = $user;
            $this->HomeModel->insertdata($tbl, $item);

            $this->session->set_flashdata('success', "Company Address Created Successfully. ..!!");
        }

        redirect('Administration/administration_info');
    }

    public function admin_packages()
    {
        $pckname = $this->input->post('package_name');
        $chkpackgeres = $this->AdminModel->isChkExistPackage($pckname);

        if ($chkpackgeres == "Not Exists") {
            $item['user']               =   $this->session->fi_session['id'];
            $item['package_name']       =   $this->input->post('package_name');
            $item['package_price']      =   $this->input->post('package_price');
            $item['package_taxable']    =   $this->input->post('package_taxable');
            $item['package_desc']       =   $this->input->post('package_desc');

            if ($item['package_taxable'] == "") {
                $item['package_taxable'] = 0;
            } else {
                $item['package_taxable'] = 1;
            }

            $result = $this->AdminModel->insertPackage($item);

            for ($i = 0; $i < count($this->input->post('title')); $i++) {
                $item1['user']          =   $this->session->fi_session['id'];
                $item1['package_id']    =   $result;
                $item1['item_name']     =   $this->input->post('title')[$i];
                $item1['item_quantity'] =   $this->input->post('quant')[$i];
                $item1['item_price']    =   $this->input->post('i_price')[$i];
                $item1['item_desc']     =   $this->input->post('itmdesc')[$i];
                if ($item1['item_name'] != "") {
                    $result1 = $this->AdminModel->insertPackagesub($item1);
                }
            }

            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');

            if ($result1) {
                $this->session->set_flashdata('success', "Package & Item added successfully..!!");
            } else {
                $this->session->set_flashdata('error', "Package & Item not created..!!");
            }
        } else if ($chkpackgeres == "IsExists") {
            $this->session->set_flashdata('error', "This Package Name Already Exists..!!");
        }
        redirect('Administration/administration_package');
    }

    public function additemadmin()
    {
        $item['user']               =   $this->session->fi_session['id'];
        $item['item_name']          =   $this->input->post('item_nane');
        $item['item_desc']          =   $this->input->post('item_desc');
        $item['item_price']         =   $this->input->post('item_price');
        $item1['iteam_texable']     =   $this->input->post('taxcheck');
        $item1['item_pickup_req']   =   $this->input->post('pickcheck');

        if ($item1['iteam_texable'] == 'on') {
            $item['iteam_texable'] = 1;
        }

        if ($item1['item_pickup_req'] == 'on') {
            $item['item_pickup_req'] = 1;
        }

        $result = $this->AdminModel->insertadditemadmin($item);
        if ($result) {
            $this->session->set_flashdata('success', "Item Added Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Item Not Created ..!!");
        }
        redirect('Administration/admin_item');
    }

    public function new_administration_package()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $cond = array('user' => $this->session->fi_session['id']);
        $tbl = 'admin_item';
        $data['all_items'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/new_packages', $data);
        $this->load->view('fi/footer');
    }

    public function edititemadmin()
    {

        $item_id                =   $this->input->post('item_id');
        $item['item_name']      =   $this->input->post('edit_item_names');
        $item['item_desc']      =   $this->input->post('edit_item_desc');
        $item['item_price']     =   $this->input->post('edit_item_price');
        $item1['iteam_texable'] =   $this->input->post('edit_taxcheck');

        if (isset($item1['iteam_texable'])) {
            $item['iteam_texable'] = 1;
        } else {
            $item['iteam_texable'] = 0;
        }

        $item1['item_pickup_req']   =   $this->input->post('edit_item_pickupcheck');
        if (isset($item1['item_pickup_req'])) {
            $item['item_pickup_req'] = 1;
        } else {
            $item['item_pickup_req'] = 0;
        }

        if ($this->db->where('item_id', $item_id)->update('admin_item', $item)) {
            $this->session->set_flashdata('success', "Item Edit Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Item Not Edit ..!!");
        }
        redirect('Administration/admin_item');
    }

    public function delete_item($id)
    {
        $delete = $this->db->where('item_id', $id)->delete('admin_item');
        if ($delete > 0) {
            $this->session->set_flashdata('success', "Item Deleted Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Item Not Deleted ..!!");
        }
        redirect('Administration/admin_item');
    }

    public function administration_user_create()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/new_user_create', $data);
        $this->load->view('fi/footer');
    }

    public function addnewuser()
    {
        $cnt = $this->AdminModel->check_email_exist($this->input->post('user_email'));
        if ($cnt == 0) {
            $arr = array(
                "title"     => $this->input->post('title'),
                "name"      => $this->input->post('user_fname'),
                "email"     => $this->input->post('user_email'),
                "username"  => $this->input->post('user_name'),
                "password"  => base64_encode($this->input->post('user_password')),
                "status"    => 0,
                "type"      => 1,
                "verified"  => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "last_name" => '',
                "admin_role_id" => '2',
                "user" => $this->session->fi_session['id']
            );

            $rid = $this->AdminModel->user_register($arr);

            if ($rid > 0) {
                $userid     = base64_encode($rid);
                $url        = base_url() . "change_password?rid=" . $userid;
                $message    = "";

                $this->email->set_mailtype("html");
                $this->email->from('admin@tech599.com', 'ERP App');
                $this->email->to($this->input->post('user_email'));
                $this->email->subject('Thank You for Registration - ERP App');
                $this->email->message($message);
                $this->email->send();

                $this->session->set_flashdata('success', "New User Register Succfully..!!");
                redirect('Administration/administration_user_create');
            } else {
                $this->session->set_flashdata('error', "Something Went wrong..!!");
                redirect('Administration/administration_user_create');
            }
        } else {
            $this->session->set_flashdata('error', "Email Already Registered..!!");
            redirect('Administration/administration_user_create');
        }
    }

    public function administration_user_rights($id = 0)
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        if ($id > 0) {
            $cond = array('id ' => $id);
            $array_data = array('status' => '1');
            $tbl = 'users';
            $this->HomeModel->update_data($tbl, $cond, $array_data);
            $data['success']  = 'User deleted successfully ..!';
        }

        $cond = array('status' => '0', 'admin_role_id != ' => 1, 'user' => $this->session->fi_session['id']);
        $tbl = 'users';
        $data['user'] = $this->HomeModel->get_all_by_cond($tbl, $cond);
        $data['page_title'] = "User Rights";

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/administration_user_rights', $data);
        $this->load->view('fi/footer');
    }

    public function activate_deactivate_account()
    {
        $id = $this->input->post('id');

        $details = $this->db->query("SELECT status FROM users WHERE id = '" . $id . "'")->row_array();
        if ($details['status'] == 0) {
            $new_status = 1;
        } else {
            $new_status = 0;
        }
        echo $this->AdminModel->update_tbl("users", array("status" => $new_status), array("id" => $id));
    }

    public function inseartlocation()
    {
        $chkstabrv = $this->db->query("SELECT * FROM tbl_zipcode_list WHERE ZIP_code='" . $_POST['l_zip'] . "'");
        $chkstabrvrow = $chkstabrv->row();

        $item['location_name']          =   ucwords($this->input->post('l_name'));
        $item['location_address']       =   ucwords($this->input->post('l_address'));
        $item['location_city']          =   ucwords($this->input->post('l_city'));
        $item['location_state']         =   ucwords($this->input->post('l_state'));
        $item['location_zip']           =   $this->input->post('l_zip');
        $item['location_phone_one']     =   $this->input->post('l_ph_no1');
        $item['location_phone_two']     =   $this->input->post('l_ph_no2');
        $item['location_direction']     =   ucwords($this->input->post('l_direction'));
        $item['location_web_addres']    =   ucwords($this->input->post('l_web_address'));
        $item['location_note']          =   ucwords($this->input->post('l_notes'));
        $item['location_color']         =   ucwords($this->input->post('l_color'));
        $item['state_abreviation']      =   $chkstabrvrow->Abbreviation;

        $result = $this->AdminModel->insertaddlocation($item);
        if ($result) {
            $this->session->set_flashdata('success', "Location Added Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Location Not Created ..!!");
        }
        redirect('Administration/administration_locations');
    }

    public function editlocatonform()
    {
        $chkstabrv = $this->db->query("SELECT * FROM tbl_zipcode_list WHERE ZIP_code='" . $_POST['l_zip'] . "'");
        $chkstabrvrow = $chkstabrv->row();

        $location_id                =   $this->input->post('latest_loaction_id');
        $item['location_name']      =   $this->input->post('l_name');
        $item['location_address']   =   $this->input->post('l_address');
        $item['location_city']      =   $this->input->post('l_city');
        $item['location_state']     =   $this->input->post('l_state');
        $item['location_zip']       =   $this->input->post('l_zip');
        $item['location_phone_one'] =   $this->input->post('l_ph_no1');
        $item['location_phone_two'] =   $this->input->post('l_ph_no2');
        $item['location_direction'] =   $this->input->post('l_direction');
        $item['location_web_addres'] =  $this->input->post('l_web_address');
        $item['location_note']      =   $this->input->post('l_notes');
        $item['location_color']     =   $this->input->post('l_color');
        $item['state_abreviation']  =   $chkstabrvrow->Abbreviation;

        if ($this->db->where('location_id', $location_id)->update('add_location_event', $item)) {
            $this->session->set_flashdata('success', "Location Updated Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Location Not Updated ..!!");
        }
        redirect('Administration/administration_locations');
    }

    public function delete_location($id)
    {
        $delete = $this->db->where('location_id', $id)->delete('add_location_event');
        if ($delete > 0) {
            $this->session->set_flashdata('success', "Location Deleted Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Location Not Deleted ..!!");
        }
        redirect('Administration/administration_locations');
    }

    public function add_newcrewavailabilities()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/add-crew-availability', $data);
        $this->load->view('fi/footer');
    }

    public function administration_letters()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/letters', $data);
        $this->load->view('fi/footer');
    }

    public function addcrewavailabilitiesinfo()
    {
        $crewsavlarr = array(
            "name" => $this->input->post('txtlettertyp'),
            "desc" => $this->input->post('textletterdetails')
        );

        $this->db->where('id', $this->input->post('txthdncrewId'));
        if ($this->db->update('adm_crewavailability_info', $crewsavlarr)) {
            $this->session->set_flashdata('success', "Crew Updated Successfully..!!");
            redirect('administration/administration_crewavailability');
        }
    }

    public function edit_crewavailability($id)
    {
        $this->session->set_userdata('template_id', $id);
        redirect('administration/edit_crewtemplate');
    }

    public function fndelletterinfo()
    {
        $result = $this->AdminModel->fndelletterinfo_dtls();
    }

    public function addcrew_template()
    {
        $crewAdd = array(
            "name" => $this->input->post('txtlettertyp'),
            "template_name" => $this->input->post('template_name'),
            "desc" => $this->input->post('textletterdetails')
        );

        if ($this->AdminModel->insertcrew_template($crewAdd)) {
            $this->session->set_flashdata('success', "Crew Template Added Successfully..!!");
        } else {
            $this->session->set_flashdata('Error', "Something Went Wrong..");
        }
        redirect('administration/administration_crewavailability');
    }

    public function fncntrcttrms()
    {
        $this->session->set_userdata('terms_id', $_POST['pckId']);
        $result = $this->AdminModel->fncntrcttrms_dtls();
    }

    public function inserttodostatusinfo()
    {
        $this->AdminModel->inserttodostatusinfo_dtls();
    }

    public function updtatskstatusinfo()
    {
        $this->AdminModel->updtatskstatusinfo_dtls();
    }

    public function inserttskstatusinfo()
    {
        $this->AdminModel->inserttskstatusinfo_dtls();
    }

    public function loadsubtaskinfo()
    {
        $this->AdminModel->loadsubtaskinfo_dtls();
    }

    public function inserttsksinfo()
    {
        $this->AdminModel->inserttsksinfo_dtls();
    }

    public function fngetadmpckjson()
    {
        $result = $this->AdminModel->fngetadmpckjson_dtls();
    }

    public function single_price_info()
    {
        $item_info = $this->input->post('i_name');

        $get_item_allfields = $this->db->query("SELECT * from admin_item WHERE item_id = '$item_info'");
        $get_data_item = $get_item_allfields->result_array()[0];
        print_r(implode("##", $get_data_item));
    }

    public function fnpckitems()
    {
        $result = $this->AdminModel->fnpckitems_dtls();
    }

    public function crnewpitem()
    {
        $result = $this->AdminModel->crnewpitem_dtls();
    }

    public function delnewpitem()
    {
        $result = $this->AdminModel->delnewpitem_dtls();
    }

    public function upditemsinfo()
    {
        $result = $this->AdminModel->upditemsinfo_dtls();
    }

    public function upditemsamnt()
    {
        $result = $this->AdminModel->upditemsamnt_dtls();
    }

    public function upditemsdescrp()
    {
        $result = $this->AdminModel->upditemsdescrp_dtls();
    }

    public function updtpackagetot()
    {
        $result = $this->AdminModel->updtpackagetot_dtls();
    }

    public function updtpackagedesc()
    {
        $result = $this->AdminModel->updtpackagedesc_dtls();
    }

    public function delselpackage()
    {
        $result = $this->AdminModel->delselpackage_dtls();
    }

    public function search_allpckageitems()
    {
        $this->AdminModel->search_allpckageitems_dtls();
    }

    public function search_pckageitems()
    {
        $adm_itemname   = $this->input->post('itemname');
        if ($adm_itemname != "") {
            $itemname = $adm_itemname;
        } else {
            $itemname = "";
        }
        $adm_itemprice  = $this->input->post('itemprice');
        if ($adm_itemprice != "") {
            $itemprice = $adm_itemprice;
        } else {
            $itemprice = "";
        }

        $result = $this->AdminModel->search_pckageitems_dtls($itemname, $itemprice);
    }
}
