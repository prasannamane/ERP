<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administration extends CI_Controller
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
        $this->load->model('Si_Model');
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

    public function search_allpckageitems()
    {
        $this->AdminModel->search_allpckageitems_dtls();
    }

    public function delselpackage()
    {
        $result = $this->AdminModel->delselpackage_dtls();
    }

    public function updtpackagedesc()
    {
        $result = $this->AdminModel->updtpackagedesc_dtls();
    }

    public function updtpackagetot()
    {
        $result = $this->AdminModel->updtpackagetot_dtls();
    }

    public function upditemsdescrp()
    {
        $result = $this->AdminModel->upditemsdescrp_dtls();
    }

    public function upditemsamnt()
    {
        $result = $this->AdminModel->upditemsamnt_dtls();
    }

    public function upditemsinfo()
    {
        $result = $this->AdminModel->upditemsinfo_dtls();
    }

    public function delnewpitem()
    {
        $result = $this->AdminModel->delnewpitem_dtls();
    }

    public function crnewpitem()
    {
        $result = $this->AdminModel->crnewpitem_dtls();
    }

    public function fnpckitems()
    {
        $result = $this->AdminModel->fnpckitems_dtls();
    }

    public function single_price_info()
    {
        $item_info = $this->input->post('i_name');
        $get_item_allfields = $this->db->query("SELECT * from admin_item WHERE item_id = '$item_info'");
        $get_data_item = $get_item_allfields->result_array()[0];
        print_r(implode("##", $get_data_item));
    }

    public function fngetadmpckjson()
    {
        $result = $this->AdminModel->fngetadmpckjson_dtls();
    }

    public function update_administration_package($id = 0)
    {
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

    public function inserttsksinfo()
    {
        $this->AdminModel->inserttsksinfo_dtls();
    }

    public function loadsubtaskinfo()
    {
        $this->AdminModel->loadsubtaskinfo_dtls();
    }

    public function inserttskstatusinfo()
    {
        $this->AdminModel->inserttskstatusinfo_dtls();
    }

    public function updtatskstatusinfo()
    {
        $this->AdminModel->updtatskstatusinfo_dtls();
    }

    public function inserttodostatusinfo()
    {
        $this->AdminModel->inserttodostatusinfo_dtls();
    }

    public function add_tax()
    {
        $ttax = $this->input->post('ttax');
        $tcounty = $this->input->post('tcounty');
        $tcity = $this->input->post('tcity');
        $tstate = $this->input->post('tstate');
        $tzip = $this->input->post('tzip');
        $tsdate = $this->input->post('tsdate');
        $tedate = $this->input->post('tedate');
        $ttaxcode = $this->input->post('ttaxcode');

        $tbl_nm = "tbl_tax_rate";
        $arr = array(
            "user"      => $this->session->fi_session['id'],
            "ttax"      => $ttax,
            "tcounty"   => $tcounty,
            "tcity"     => $tcity,
            "tstate"    => $tstate,
            "tzip"      => $tzip,
            "tsdate"    => $tsdate,
            "tedate"    => $tedate,
            "ttaxcode"  => $ttaxcode
        );

        $res = $this->TaxModel->insert_with_id($tbl_nm, $arr);
        if ($res) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function load_data()
    {
        $tbl_nm = "tbl_tax_rate";
        $select = "*";
        $arr    = array("user" => $this->session->fi_session['id']);
        $order = "tid ASC";

        $res = $this->TaxModel->select_data($tbl_nm, $select, $arr, $order);

        $str = "";
        if (!empty($res)) {

            foreach ($res as $r) {
                $dt = "";
                if ($r['tsdate'] != "0000-00-00") {
                    $dt = date("m/d/Y", strtotime($r['tsdate']));
                }

                $dt1 = "";
                if ($r['tedate'] != "0000-00-00") {
                    $dt1 = date("m/d/Y", strtotime($r['tedate']));
                }

                $str = $str . '<tr class="tr_clone">                          
                        <td><input type="text" name="tax" class="form-control ttax" value="' . $r['ttax'] . '" onblur="update_field(\'tbl_tax_rate\',\'ttax\',this.value,\'tid\',\'' . $r['tid'] . '\',\'\', \'' . $r['ttax'] . '\')" ></td>                    
                        <td><input type="text" name="county" class="form-control tcounty" value="' . $r['tcounty'] . '" onblur="update_field(\'tbl_tax_rate\',\'tcounty\',this.value,\'tid\',\'' . $r['tid'] . '\',\'\', \'' . $r['tcounty'] . '\')" ></td>                                            
                        <td><input type="text" name="city" class="form-control tcity"  value="' . $r['tcity'] . '" onblur="update_field(\'tbl_tax_rate\',\'tcity\',this.value,\'tid\',\'' . $r['tid'] . '\',\'\', \'' . $r['tcity'] . '\')" ></td>                          
                        <td><input type="text" name="state" class="form-control tstate"  value="' . $r['tstate'] . '" onblur="update_field(\'tbl_tax_rate\',\'tstate\',this.value,\'tid\',\'' . $r['tid'] . '\',\'\', \'' . $r['tstate'] . '\')" ></td>                          
                        <td><input type="text" name="zip" class="form-control num tzip" maxlength="5"  value="' . $r['tzip'] . '" onblur="update_field(\'tbl_tax_rate\',\'tzip\',this.value,\'tid\',\'' . $r['tid'] . '\',\'\', \'' . $r['tzip'] . '\')" ></td>                          
                        <td><input type="text" name="tax_sdate" placeholder="mm/dd/yyyy" class="form-control common_dt tsdate" value="' . $dt . '" onblur="update_field(\'tbl_tax_rate\',\'tsdate\',this.value,\'tid\',\'' . $r['tid'] . '\',\'date\', \'' . $dt . '\')" ></td>                          
                        <td><input type="text" name="tax_edate" placeholder="mm/dd/yyyy" class="form-control common_dt tedate" value="' . $dt1 . '" onblur="update_field(\'tbl_tax_rate\',\'tedate\',this.value,\'tid\',\'' . $r['tid'] . '\',\'date\', \'' . $dt1 . '\')" ></td>                          
                        <td><input type="text" name="tax_code" class="form-control ttaxcode" value="' . $r['ttaxcode'] . '" onblur="update_field(\'tbl_tax_rate\',\'ttaxcode\',this.value,\'tid\',\'' . $r['tid'] . '\',\'\', \'' . $r['ttaxcode'] . '\')" ></td>
                        <td><button id="' . $r['tid'] . '" tabindex="-1" class="btn btn-xs btn-danger tr_clone_remove"><i class="fa fa-minus"></i></button></td>            
                    </tr>  ';
            }
        }


        // Defailt + row
        $str = $str . '<tr class="tr_clone">                          
                            <td><input type="text" name="tax" class="form-control ttax" ></td>                    
                            <td><input type="text" name="county" class="form-control tcounty" ></td>                                            
                            <td><input type="text" name="city" class="form-control tcity" ></td>                          
                            <td><input type="text" name="state" class="form-control tstate" ></td>                          
                            <td><input type="text" name="zip" class="form-control num tzip" maxlength="5" ></td>                          
                            <td><input type="text" name="tax_sdate" placeholder="mm/dd/yyyy" class="form-control common_dt tsdate" ></td>                          
                            <td><input type="text" name="tax_edate" placeholder="mm/dd/yyyy" class="form-control common_dt tedate" ></td>                          
                            <td><input type="text" name="tax_code" class="form-control ttaxcode" ></td>
                            <td><button tabindex="-1" class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button></td>            
                        </tr>  ';
        echo $str;
    }

    public function fncntrcttrms()
    {
        $this->session->set_userdata('terms_id', $_POST['pckId']);
        $result = $this->AdminModel->fncntrcttrms_dtls();
    }

    public function addcrew_template()
    {
        $crewAdd = array(
            "user"  => $this->session->fi_session['id'],
            "name"  => $this->input->post('txtlettertyp'),
            "template_name" => $this->input->post('template_name'),
            "desc"  => $this->input->post('textletterdetails')
        );

        if ($this->AdminModel->insertcrew_template($crewAdd)) {
            $this->session->set_flashdata('success', "Crew Template Added Successfully..!!");
        } else {
            $this->session->set_flashdata('Error', "Something Went Wrong..");
        }
        redirect('administration/administration_crewavailability');
    }

    public function fndelletterinfo()
    {
        $result = $this->AdminModel->fndelletterinfo_dtls();
    }

    public function edit_crewavailability($id)
    {
        $this->session->set_userdata('template_id', $id);
        redirect('administration/edit_crewtemplate');
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

    public function inseartlocation()
    {
        $chkstabrv = $this->db->query("SELECT * FROM tbl_zipcode_list WHERE ZIP_code='" . $_POST['l_zip'] . "'");
        $chkstabrvrow = $chkstabrv->row();

        $item['user']                   =   $this->session->fi_session['id'];
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
            } else {
                $this->session->set_flashdata('error', "Something Went wrong..!!");
            }
        } else {
            $this->session->set_flashdata('error', "Email Already Registered..!!");
        }
        redirect('Administration/administration_user_create');
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

    public function administration_notes()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/notes', $data);
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
        $this->load->view('fi/administration/crew-availability', $data);
        $this->load->view('fi/footer');
    }

    public function administration_terms()
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/contract-terms', $data);
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
        $this->load->view('fi/administration/tasks', $data);
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
        $this->load->view('fi/administration/tasks_status', $data);
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
        $this->load->view('fi/administration/todo_status', $data);
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

    public function administration_tax()
    {
        $data[] = "";

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/tax', $data);
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

    public function new_company($id = 0)
    {
        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $tbl = 'users';

        if ($id > 0) {
            $cond = array('id ' => $id);
            $array_data = array('status' => 1);
            $this->HomeModel->update_data($tbl, $cond, $array_data);

            if (!$this->db->affected_rows()) {
                $cond = array('id ' => $id);
                $array_data = array('status' => 0);
                $this->HomeModel->update_data($tbl, $cond, $array_data);
            }

            $data['success']  = 'User status updated successfully ..!';
        }

        $cond = array('admin_role_id ' => 1, 'user' => $this->session->fi_session['id']);

        $data['user'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $data['page_title'] = "New Company";
        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/new_company', $data);
        $this->load->view('fi/footer');
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
        $this->load->view('fi/administration/user_rights', $data);
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

    public function add_sub_cates()
    {
        $item['user']             = $this->session->fi_session['id'];
        $item['cat_id']             = $this->input->post('cat_id');
        $item['sub_name']         = $this->input->post('sub_name');
        $item['opening_bal']     = $this->input->post('open_bal');
        $item['sub_description'] = $this->input->post('sub_desc');
        $item['subCategoriesId'] = $this->input->post('subCategoriesId');

        $result = $this->AdminModel->insertsubcatvalue($item);
        if ($result) {
            $this->session->set_flashdata('success', "Sub Categorie Added Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Sub Categorie Not Created ..!!");
        }
        redirect('Administration/view_sub_cat');
    }

    public function delete_cat($id)
    {
        $this->db->delete('categories', array('id' => $id));
        $this->session->set_flashdata('success', 'Delete Categories');

        $data['alert']        = $this->session->flashdata('alert');
        $data['error']        = $this->session->flashdata('error');
        $data['success']      = $this->session->flashdata('success');
        $data['cat']           = $this->db->get('categories')->result_array();
        $data['cate']         = $this->db->get('categories_list')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/admin', $data);
        $this->load->view('fi/footer');
    }

    public function administration_contracttypes()
    {

        $data['alert']    = $this->session->flashdata('alert');
        $data['error']    = $this->session->flashdata('error');
        $data['success']  = $this->session->flashdata('success');

        $item_info = $this->db->query("SELECT * from admin_contract_type");
        $data['all_items'] = $item_info->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration_contractypes', $data);
        $this->load->view('fi/footer');
    }

    public function view_sub_cat()
    {
        $data['alert'] = $this->session->flashdata('alert');
        $data['error'] = $this->session->flashdata('error');
        $data['success'] = $this->session->flashdata('success');

        $user = $this->session->fi_session['id'];
        $id = $this->session->userdata('cat_id');
        $data['id'] = $id;

        $cond = array('cat_id' => '5');
        $tbl = "sub_categories";
        $data['MainCategories'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $cond = array('id' => $id);
        $tbl = "categories";
        $data['cat'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        $cond = array(
            'cat_id' => $id,
            'user' => $user
        );
        $tbl = "sub_categories";
        $data['sub_cats'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

        //$data['cat'] = $this->db->where('id',$id)->get('categories')->result_array();

        //$data['sub_cats'] 	  = $this->db->where('cat_id',$id)->get('sub_categories')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/subCategories', $data);
        $this->load->view('fi/footer');
    }

    public function add_sub_cat($id)
    {
        if ($id == "7") {
            $this->session->set_userdata('cat_id', $id);
            redirect('Administration/administration_contracttypes');
        } else if ($id == "30") {
            $this->session->set_userdata('cat_id', $id);
            redirect('Administration/administration_contracttypes');
        } else {
            $this->session->set_userdata('cat_id', $id);
            redirect('Administration/view_sub_cat');
        }
    }




    /** 
     *@author Prasanna Mane
     *Date Nov 11, 2020
     *Update March 07, 2021
     */
    public function index()
    {
        $data['alert']        = $this->session->flashdata('alert');
        $data['error']        = $this->session->flashdata('error');
        $data['success']      = $this->session->flashdata('success');

        $data['cat']           = $this->db->get('categories')->result_array();
        $data['cate']         = $this->db->get('categories_list')->result_array();

        $this->load->view('fi/header');
        $this->load->view('fi/sidebar');
        $this->load->view('fi/administration/admin', $data);
        $this->load->view('fi/footer');
    }

    /** 
     *@author Prasanna Mane
     *Update March 07, 2021
     */
    public function add_drop_categories()
    {

        $item1    =    $this->input->post('add_drop_cat');
        $item['cat_name'] = ucfirst($item1);

        $result = $this->AdminModel->insertDropCategories($item);
        if ($result) {
            $this->session->set_flashdata('success', "Category Added Successfully..!!");
        } else {
            $this->session->set_flashdata('error', "Category Not Created ..!!");
        }
        redirect('Administration');
    }
}
