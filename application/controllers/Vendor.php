<?php 

    //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
    error_reporting(0); 

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Vendor extends CI_Controller 
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('AdminModel');
            $this->load->model('DashboardModel');
            $this->load->model('Attachment_Model');
            $this->load->model('TaskModel');
            $this->load->model('Vendor_attachment_Model');
            $this->load->model('HomeModel');
            $this->load->model('VendorModel');            

            if(!isset($this->session->fi_session))
            {
                redirect('/','refresh');
            }
        }

        public function calculatePurchaseRow()
        {
            $purchaseId = $this->input->post('purchaseId');
            $this->db->select('SUM(total) AS sumtotal', FALSE);
            $this->db->where('purchaseId', $purchaseId);
            $purchaseRes = $this->db->get('purchaseItem')->result_array();

            $tbl = "purchase";
            $cond = array("id" => $purchaseId);
            $array_data = array("subtotal" =>  $purchaseRes[0]['sumtotal']);
            $this->HomeModel->update_data($tbl, $cond, $array_data);

            echo $purchaseId;
        }

        public function getSubCat()
        {
            $id = $this->input->post('id');

            $tbl = "sub_categories";
            $cond = array('subCategoriesId' => $id,'cat_id'=> '54');
            $apSubCategories = $this->HomeModel->get_all_by_cond($tbl, $cond);

            //print_r($this->db->last_query());

            echo '<option value="">Choose</option>';
            foreach($apSubCategories as $row )
            {
                echo '<option value="'.$row['sub_id'].'">'.$row['sub_name'].'</option>';                                           
            }
        }

        public function getVenderInfo()
        {
            $cName = $this->input->post('name');
            $this->session->set_userdata('vendorId',$cName);
            $this->VendorModel->allGeneralVendInfo($cName);
        }

        public function SerachSelect($vendorId = 0)
        {
            $this->session->set_userdata('vendorId',$vendorId);
            redirect('Vendor/genral_info','refresh');
        }

        public function events()
        {   
            $data['alert']          = $this->session->flashdata('alert');
            $data['error']          = $this->session->flashdata('error');
            $data['success']        = $this->session->flashdata('success');
            $data['search']         = $this->AdminModel->vendor_search_data();
            $data['single_cust']    = $this->AdminModel->vendor_search_data()[0];
            $data['event_name']     = $this->db->where('cat_id',3)->get('sub_categories')->result_array();
            $data['last_row']       = $this->db->order_by('cus_id',"desc")->limit(1)->get('register_vendor')->result_array()[0];
            $get_loc = $this->db->query("SELECT * from add_location_event");
            $data['all_locs']       = $get_loc->result_array();
            $data['all_crews']      = $this->db->where('cat_id',4)->get('sub_categories')->result_array();

            $data['crews_data']     = $this->AdminModel->get_vend_crews_data_id($data['last_row']['cus_id']);
            $vendorId = $this->session->userdata('vendorId');
            $data['vendorId']   = $this->session->userdata('vendorId');            
            $data['page_title']     = "EVENT";

            //For Search Vendor - Start
            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End
    
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/events');
            $this->load->view('fi/footer');
        }


        public function saveprice()
        {
            $data['itemname'] = $this->input->post('itemname');
            $data['vendor_id'] = $this->session->userdata('vendorId');
            $data['user'] = $this->session->fi_session['id'];

            $tbl = "admin_item";
            $cond = array('item_name' => $data['itemname']);
            $admin_item = $this->HomeModel->get_all_by_cond($tbl, $cond);

            if(count($admin_item) > 0)
            {
                $data['description'] = $admin_item[0]['item_desc'];
                $data['amount'] = $admin_item[0]['item_price'];
                $data['taxble'] = $admin_item[0]['iteam_texable'];
                $data['mynote'] = 'this is item data';
            }    
            
            $tbl = "pricelist";
            if($this->HomeModel->insertdata($tbl, $data)) { return TRUE; } else { return FALSE; }
        }    
            
        public function PurchageUpdateItem()
        {
            $id =  $this->input->post('id');
            $event =  $this->input->post('additem');
            $qty = $this->input->post('qty');
            $description = $this->input->post('description');
            $amount = $this->input->post('amt');
            $taxble = $this->input->post('taxble');

            if($taxble == 'on')
            {
                $taxble = 1;
            }
            elseif($taxble == 'off')
            {
                $taxble = 0;
            }

            $cond = array('id' => $event);
            $tbl = "pricelist";
            $pricelist = $this->HomeModel->get_all_by_cond($tbl, $cond);
            
            $description = $pricelist[0]['description'];
            $total = $amount * $qty;
            
            $cond = array('id' => $id);
            $data = array('total' => $total, 'amount' => $amount, 'qty' => $qty, 'event' => $event, 'description' => $description, 'taxable' => $taxable, 'user'=> $this->session->fi_session['id']);
            $tbl = "purchaseItem";
            $this->HomeModel->update_data($tbl, $cond, $data);  
            return $pricelist[0]['purchaseId'];

        }

        public function deletePurchageItem()
        {
            $id =  $this->input->post('id');
            $data['id'] = $id;
            $tbl = "purchaseItem";
            $this->HomeModel->delete_data($tbl, $data);
            echo $id;
        }

        public function purchase()
        {
            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');
            
            $data['page_title'] = "PURCHASE";
          
            //For Search Vendor - Start
            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            
            $vendorId = $this->session->userdata('vendorId');
            $data['vendorId'] = $vendorId;
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/purchases');
            $this->load->view('fi/footer');
        }

        public function purchaseItems()
        {
            $purchaseId =  $this->input->post('purchaseId');
            $vendorId = $this->session->userdata('vendorId');
            
            $cond = array('vendor_id' => $vendorId);
            $tbl = "pricelist";
            $pricelist = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            
            ?>
            
            <?php

            $cond = array('purchaseId' => $purchaseId);
            $tbl = "purchaseItem";
            $purchaseItem = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            foreach($purchaseItem as $item)
            {
                if($item['taxable'] == '1') { $taxble = "checked"; } else { $taxble = ""; } ?>
                <tr class="remove<?=$item['id']?>"> 
                    <td>
                        <input type="hidden" class="purchaseId" value="<?=$purchaseId?>">
                        <input type="text" class="form-control qty<?=$item['id']?>" value="<?=$item['qty']?>" onchange="updateItem(<?=$item['id']?>)">
                    </td>
                    <td>
                        <select class="form-control additem<?=$item['id']?>" onblur="updateItem(<?=$item['id']?>)">
                        <option>Choose</option>
                        <?php foreach($pricelist as $list) { if($item['event'] == $list['id']) { $selected = "selected"; } else { $selected = ""; } ?>
                        <option <?=$selected?> value="<?=$list['id']?>"><?=$list['itemname']?></option> <?php } ?>                       
                        </select>
                    </td>
                    <td><input type="text" class="description<?=$item['id']?>" value="<?=$item['description']?>" onblur="updateItem(<?=$item['id']?>)"></td>
                   
                    <td>
                        <div class="form-group">
                            <div class="input-group" style="float: right;" >
                                <span class="input-group-addon" style="position: absolute; right: 45px; left: inherit; margin: 0px; top: 3.1px;">
                                    <span class="glyphicon glyphicon-usd">
                                    </span>
                                </span>
                                <input type="text" class="form-control amt<?=$item['id']?>" value="<?=$item['amount']?>" onblur="updateItem(<?=$item['id']?>)">
                            </div>
                        </div>
                    </td>
                    
                    <td>$<?=$item['total']?></td>
                    <td><input type="checkbox" class="taxble<?=$item['id']?>" <?=$taxble?> onchange="updateItem(<?=$item['id']?>)"></td>
                    <td>
                       <a onclick="deletePurchageItem(<?=$item['id']?>)" class="btn btn-xs btn-danger"><i class="fa fa-minus"></i></a>
                    </td>
                </tr>
            <?php
            } ?>
            <tr>
                <td>
                    <input type="text" class="form-control qty" value="1">
                </td>
                <td>
                    <select class="form-control additem" onblur="additem(<?=$purchaseId?>)">
                    <option>Choose</option>
                    <?php 
                    foreach($pricelist as $list)
                    { 
                        ?>
                        <option value="<?=$list['id']?>"><?=$list['itemname']?></option>
                        <?php
                    }
                    ?>                       
                    </select>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td><div class="checkbox"><label><input type="checkbox"></label></div>
                    
                </td>
                <td>
                    <!--<button class="btn btn-xs btn-success">
                        <i class="fa fa-plus"></i>
                    </button> -->
                </td>
            </tr>
            <?php
        }

        public function purchaseAddItems()
        {
            $event =  $this->input->post('event');
            $purchaseId =  $this->input->post('purchaseId');
            $qty = $this->input->post('qty');

            $vendorId = $this->session->userdata('vendorId');
            $cond = array('id' => $event);
            $tbl = "pricelist";
            $pricelist = $this->HomeModel->get_all_by_cond($tbl, $cond);
            
            $itemname = $pricelist[0]['itemname'];
            $description = $pricelist[0]['description'];
            $total = $pricelist[0]['amount'] * $qty;
            $amount = $pricelist[0]['amount'];
            $taxable = $pricelist[0]['taxble'];

            $data = array('total' => $total, 'purchaseId'=>$purchaseId, 'amount' => $amount, 'vendor_id' => $vendorId, 'qty' => $qty, 'event' => $event, 'description' => $description, 'taxable' => $taxable, 'user'=> $this->session->fi_session['id']);
            $tbl = "purchaseItem";
            $this->HomeModel->insertdata($tbl, $data);   
        }

        public function loadpurchaselist()
        {             
            $tbl = "purchase";
            $vendorId = $this->session->userdata('vendorId');
            $cond['vendor_id'] = $vendorId;
            $cond['user'] = $this->session->fi_session['id'];
            $purchase = $this->HomeModel->get_all_by_cond($tbl, $cond);
            

            $cond = array('crews_vendor' => $vendorId);
            $this->db->select('er.*');
            $this->db->from('event_crews as ec');
            $this->db->join('events_register as er','er.event_id = ec.event_id','left');
            $this->db->where($cond);
            $query = $this->db->get();
            $event_data = $query->result_array(); 
            
            foreach($purchase as $row)
            {
                $tbl = "users";
                $condUser['id'] = $row['user'];
                $users = $this->HomeModel->get_all_by_cond($tbl, $condUser);
                
                $pdate = date_create($row['pdate']);
                $pdate = date_format($pdate,"m/d/Y");
                $duedate = date_create($row['duedate']);
                $duedate = date_format($duedate,"m/d/Y");
                ?>
                <tr class="mypurchase" onclick="purchaseRow(<?=$row['id']?>)"> 
                    
                <td class="yellow yellow<?=$row['id']?>"><?=$row['id']?></td>
                <td class="yellow yellow<?=$row['id']?>"><?=$pdate?></td>
                <td class="yellow yellow<?=$row['id']?>">
                    <input type="text" class=" yellow yellow<?=$row['id']?> form-control mydate mydate<?=$row['id']?>" value="<?=$duedate?>"  onblur="ListUpdate(<?=$row['id']?>)" >
                </td>
                <td class="yellow yellow<?=$row['id']?>"><?=$row['InvoiceId']?></td>
                <td class="yellow yellow<?=$row['id']?>">
                    <select class=" yellow yellow<?=$row['id']?> form-control event<?=$row['id']?>" onblur="ListUpdate(<?=$row['id']?>)" > 
                        <option> Choose </option>
                        <?php
                        foreach($event_data as $event)
                        { 
                            $cus_id = $event['cus_id'];
                          
                            if($row['event'] == $event['event_id'])
                            {
                                $selected = "selected";
                            }
                            else
                            {
                                $selected = "";
                            }
                            ?>
                            <option <?=$selected?> value="<?=$event['event_id']?>"><?=$event['event_name']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td class="yellow yellow<?=$row['id']?>">
                    <a href=<?=base_url('fi_home/search_new_cus/'.$cus_id)?> class="btn btn-xs btn-success"><i class="fa fa-arrow-right"></i></a>
                </td>
                <td class="yellow yellow<?=$row['id']?>">
                    <select name="discType" class="yellow yellow<?=$row['id']?> form-control discType<?=$row['id']?>"  onblur="ListUpdate(<?=$row['id']?>)" >
                        <option>Choose</option>
                        <?php 
                        $selected1 = "";
                        $selected2 = "";
                        if($row['discType'] == 1)
                        {
                            $selected1 = "selected";
                        }
                        elseif($row['discType'] == 2)
                        {
                            $selected2 = "selected";
                        }
                        ?>
                        <option <?=$selected1?> value="1">$</option>
                        <option <?=$selected2?> value="2">%</option>
                    </select>
                </td>
                <td class="yellow yellow<?=$row['id']?>">
                    <div class="form-group">
                        <div class="input-group" style="float: right;">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-usd">
                                </span>
                            </span>
                            <input type="text" class="yellow yellow<?=$row['id']?> form-control discAmt<?=$row['id']?>" value="<?=$row['discAmt']?>" onchange="ListUpdate(<?=$row['id']?>)">
                        </div>
                    </div>
                </td>
                <td  class="yellow yellow<?=$row['id']?>" style="text-align: right;">$<?=$row['subtotal']?> </td>
                <td  class="yellow yellow<?=$row['id']?>" style="text-align: right;">$<?=$row['tax']?></td>
                <td  class="yellow yellow<?=$row['id']?>" style="text-align: right;">$<?=$row['amount']?></td>
                <td  class="yellow yellow<?=$row['id']?>" style="text-align: right;">$<?=$row['paid']?></td>
                <td  class="yellow yellow<?=$row['id']?>" style="text-align: right;">$<?=$row['duebal']?></td>
                <!-- <td  class="yellow yellow<?=$row['id']?>"><button class="label label-success myInput<?=$row['id']?>" onclick="myInput(<?=$row['id']?>)">Paid</button></td>
                --> <td  class="yellow yellow<?=$row['id']?>">
                    <span style="margin-right: 5px;">
                        <input onblur="ListUpdate(<?=$row['id']?>)" class="yellow yellow<?=$row['id']?> taxrate<?=$row['id']?>" style="margin-right: -3px; text-align:right; width:70px;" type="text" value="<?=$row['taxrate']?>">%
                    </span>
                </td>
                <td class="yellow yellow<?=$row['id']?>"><?=$users[0]['username']?></td>
                </tr>
                <?php
            }
        }

        

        public function PaidListUpdate()
        {
            $tbl = "purchase";
            $cond['id'] =  $this->input->post('id');
            $result = $this->HomeModel->get_all_by_cond($tbl, $cond);
            $duebal   = $result[0]['duebal'];
            $amount = $result[0]['amount'];

            $paid =  $this->input->post('paid');
            
            $data['duebal'] = $amount - $paid;
            $data['paid'] = $paid;

            $cond = array('id' => $this->input->post('id'));
            $tbl = "purchase";
            $this->HomeModel->update_data($tbl, $cond, $data);
            
            return TRUE;
        }

        public function PurchaseListUpdate()
        {
            $tbl = "purchase";
            $cond['id'] =  $this->input->post('id');
            $result = $this->HomeModel->get_all_by_cond($tbl, $cond);

            $duedate = $this->input->post('mydate');
            $duedate = date_create($duedate);
            $data['duedate'] = date_format($duedate,"Y-m-d");
            $data['event']      = $this->input->post('event');

            $data['taxrate']    = $this->input->post('taxrate');
            $subtotal   = $result[0]['subtotal'];
            
            $data['discType']   = $this->input->post('discType');
            if($data['discType'] == 1)
            {
                $discAmount = $this->input->post('discAmt');
            }
            elseif($data['discType'] == 2)
            {
                $discAmount =  ($subtotal / 100) * $this->input->post('discAmt');
            }
            else
            {
                $discAmount = 0;
            }
            $data['discAmt'] = $this->input->post('discAmt');
            $data['tax'] = (($subtotal - $discAmount) / 100) * $data['taxrate']; 
            $data['amount']     =  $subtotal - $discAmount +  $data['tax'];
            
            $data['duebal'] = $data['amount'] - $result[0]['paid'];
            $cond = array('id' => $this->input->post('id'));
            $tbl = "purchase";
            $this->HomeModel->update_data($tbl, $cond, $data);  

        }


        public function addvendor()
        {
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
            $data['cus_tax_id']         = $this->input->post('cus_tax_id');
            $data['user']               = $this->session->fi_session['id'];
            
            $vendorId = $this->AdminModel->addvendor_dtls($data);
            $this->session->set_userdata('vendorId',$vendorId);
            if ($vendorId > 0) 
            {

                for($i=0; $i < count($this->input->post('rating')); $i++) 
                {
                    $rating = $this->input->post('rating')[$i];
                    $aptype = $this->input->post('aptype')[$i];                           
                    $cond = array('rating' => $rating, 'aptype' => $aptype, 'vendor_id' => $vendorId, 'user'=> $this->session->fi_session['id']);
                    $tbl = "vendor_rating";
                    $this->HomeModel->insertdata($tbl, $cond);                            
                }
              
                for($i=0; $i < count($this->input->post('apcate')); $i++) 
                {
                    $apcat = $this->input->post('apcate')[$i];
                    $apsubcat = $this->input->post('apsubcate')[$i];                           
                    $cond = array('apcat' => $apcat, 'apsubcat' => $apsubcat, 'vendor_id' => $vendorId, 'user'=> $this->session->fi_session['id']);
                   
                    $tbl = "vendor_apcat";
                    $this->HomeModel->insertdata($tbl, $cond);    
                }       

                $address['ship_user_id']        = $vendorId;
                $address['ship_address1']       = $this->input->post('cus_ship_address1');
                $address['ship_address2']       = $this->input->post('cus_ship_address2');
                $address['ship_city']           = $this->input->post('cus_ship_city');
                $address['ship_state']          = $this->input->post('cus_ship_state');
                $address['ship_zip']            = $this->input->post('cus_ship_zip');
                $address['billing_addr_status'] = $this->input->post('billaddr');
                
                $this->AdminModel->vendaddshipaddress_dtls($address);
    
                for ($i=0; $i < count($this->input->post('cus_contact_type')) ; $i++) 
                {
                    $contact['cus_id']  =   $vendorId;
                    $contact['conatct_type']    =   $this->input->post('cus_contact_type')[$i];
                    //$contact['conatct_type']  =   "Home";
                    $contact['contact_no']  =   $this->input->post('cus_contact_no')[$i];
                    $contact['user_contact_note']   =   $this->input->post('cus_note')[$i];
                    
                    if(isset($this->input->post('radio_click[]')[$i]) && $this->input->post('radio_click[]')[$i] != "")
                    {
                        $b = "on";
                    }
                    else
                    {
                        $b = "off";
                    }
                    
                    if(isset($b) && $b == 'on')
                    {
                        $contact['default_contact'] = 1;
                    }
                    else
                    {
                        $contact['default_contact'] = 0;
                    }
    
                    $result = $this->AdminModel->addvendcontactdata_dtls($contact);
                }
    
                for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) 
                {
                    $contact1['cus_id']    =   $vendorId;
                    //$contact1['conatct_type']    =   "Email";
                    $contact1['conatct_type']  =   $this->input->post('cuscnt_type_email')[$j];
                    $contact1['email'] =   $this->input->post('txtemail')[$j];
                    
                    if(isset($this->input->post('email_radio_click[]')[$j]) && $this->input->post('email_radio_click[]')[$j] != "")
                    {
                        $b = "on";
                    }
                    else
                    {
                        $b = "off";
                    }
                    
                    if(isset($b) && $b == 'on')
                    {
                        $contact1['default_contact'] = 1;
                    }
                    else
                    {
                        $contact1['default_contact'] = 0;
                    }
                    $result = $this->AdminModel->addvendcontactdata_dtls($contact1);
                }
                
                $chkvendattchexitssql = $this->db->query("SELECT * FROM vend_attachment WHERE cust_id='".$vendorId."'");
                $isnvendattchrows = $chkvendattchexitssql->num_rows();
                if($isnvendattchrows == 0)
                {
                    $postvendattchvarr = array(
                            "cust_id" => $vendorId,
                        );
                    $this->db->insert('vend_attachment',$postvendattchvarr);
                }
                $this->session->set_flashdata('success', 'Vendor Created SuccessFully ..!');
                redirect('Vendor/events');
            }
            else
            {
                $this->session->set_flashdata('error', 'Something Went Wrong..!');
                redirect('Vendor/genral_info');
            }
        }

        public function updateVendor()
        {
            $vendorId = $this->session->userdata('vendorId');

            
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
                $up_id                      = $vendorId; // $this->input->post('cus_id');

                $cond = array('cus_id' => $vendorId);
                $tbl = "register_vendor";
                $this->HomeModel->update_data($tbl, $cond, $data);
                
                if ($vendorId > 0) 
                {
                    $address['ship_user_id']        = $up_id;
                    $address['ship_address1']       = $this->input->post('cus_ship_address1');
                    $address['ship_address2']       = $this->input->post('cus_ship_address2');
                    $address['ship_city']           = $this->input->post('cus_ship_city');
                    $address['ship_state']          = $this->input->post('cus_ship_state');
                    $address['ship_zip']            = $this->input->post('cus_ship_zip');
                    $address['billing_addr_status'] = $this->input->post('billaddr');
                    $address['ship_cusname']        = $this->input->post('shipcusname');
                    $this->AdminModel->up_addvendshipaddress($address,$up_id);
                    $this->AdminModel->del_addvendcontactdata($up_id);
                   
                    $cond = array('vendor_id' => $vendorId);
                    $tbl = "vendor_rating";
                    $this->HomeModel->delete_data($tbl, $cond);

                    $tbl = "vendor_apcat";
                    $this->HomeModel->delete_data($tbl, $cond);                  

                    for($i=0; $i < count($this->input->post('rating')); $i++) 
                    {
                        $rating = $this->input->post('rating')[$i];
                        $aptype = $this->input->post('aptype')[$i];                           
                        $cond = array('rating' => $rating, 'aptype' => $aptype, 'vendor_id' => $vendorId, 'user'=> $this->session->fi_session['id']);
                        $tbl = "vendor_rating";
                        $this->HomeModel->insertdata($tbl, $cond);                            
                    }
                  
                    for($i=0; $i < count($this->input->post('apcateupdate')); $i++) 
                    {
                        $apcat = $this->input->post('apcateupdate')[$i];
                        $apsubcat = $this->input->post('apsubcateupdate')[$i];                           
                        $cond = array('apcat' => $apcat, 'apsubcat' => $apsubcat, 'vendor_id' => $vendorId, 'user'=> $this->session->fi_session['id']);
                        $tbl = "vendor_apcat";
                        $this->HomeModel->insertdata($tbl, $cond);    
                    }                  
                    
                    for ($i=0; $i < count($this->input->post('cus_contact_type')); $i++) 
                    {
                        if($this->input->post('cus_contact_type')[$i]!="")
                        {
                            $contact['cus_id']              =   $up_id;
                            $contact['conatct_type']        =   $this->input->post('cus_contact_type')[$i];
                            $contact['contact_no']          =   $this->input->post('cus_contact_no')[$i];
                            $contact['user_contact_note']   =   $this->input->post('cus_note')[$i];
                            
                            if($this->input->post('radio_click[]')[$i] == "on")
                            {
                                $b = "on";
                            }
                            else if($this->input->post('radio_click[]')[$i] == "off")
                            {
                                $b = "off";    
                            }
                            
                            if($b=='on')
                            {
                                $contact['default_contact'] = 1;
                            }
                            else
                            {
                                $contact['default_contact'] = 0;
                            }
                            
                            $result = $this->AdminModel->addvendcontactdata_dtls($contact);
                        }
                    }                 
                    
                    for ($j=0; $j < count($this->input->post('cuscnt_type_email')) ; $j++) 
                    {
                        if($this->input->post('cuscnt_type_email')[$j]!="")
                        {
                            $contact1['cus_id']    =   $up_id;
                            $contact1['conatct_type']   =   $this->input->post('cuscnt_type_email')[$j];
                            $contact1['email']  =   $this->input->post('txtemail')[$j];
                            if($contact1['conatct_type'] != 'Choose')
                            {
                                if($this->input->post('email_radio_click[]')[$j] == "on")
                                {
                                    $contact1['default_contact'] = 1;
                                }
                                else
                                {
                                    $contact1['default_contact'] = 0;
                                }
                    
                                $result = $this->AdminModel->addvendcontactdata_dtls($contact1);
                            }
                        }
                    }
                    $this->session->set_userdata('id',$up_id);
                }
            
            if(isset($_POST['Save']))
            { 
                $this->session->set_flashdata('success', 'Vendor updated successfully ..!');
                redirect('Vendor/genral_info');
            }
            else if(isset($_POST['Submit']))
            {             
                $this->session->set_flashdata('success', 'Vendor updated successfully ..!');
                redirect('Vendor/events');   
            }
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong..!');
                redirect('Vendor/genral_info');
            }    
        }

        public function setsession()
        {
            $vendorId = $this->input->post('vendorId');
            $this->session->set_userdata('vendorID',$vendorId);
        }

        public function fnsearchcustattchment()
        {
            $vendorId = $this->input->post('cus_id');
            $this->session->set_userdata('vendorId',$vendorId);
            $this->Vendor_attachment_Model->fnsearchcustattchment_dtls();
        }

        public function addevent()
        {
            $vendorId = $this->session->userdata('vendorId');
            $data['cus_id'] = $vendorId;
            $tbl = "vendor_events_register";
            $this->HomeModel->delete_data($tbl, $data);

            $data['cus_id'] = $vendorId;
            for ($i = 0; $i < count($this->input->post('event_type')) ; $i++) 
            {
                $data['event_type'] = $this->input->post('event_type')[$i];
                $data['event_name'] = $this->input->post('ename')[$i];
                $data['event_date'] = $this->input->post('edate')[$i];
                $data['event_time'] = $this->input->post('etime')[$i];

                $this->HomeModel->insertdata($tbl, $data);

            }

            /*
            if($this->input->post('cuss_id')!="" && $this->input->post('edate')[0]!="")
            {
                $result_cus = $this->AdminModel->check_vend_event_id($this->input->post('cuss_id'),$this->input->post('edate')[0]);
                if ($result_cus == 0) 
                {
                    for ($i=0; $i < count($this->input->post('event_type')) ; $i++) 
                    {
                        if($this->input->post('event_type')[$i]!="Select" || $this->input->post('edate')[$i]!="")
                        {
                            $data['cus_id']                         = $this->input->post('cuss_id');
                            $data['event_type']                 = $this->input->post('event_type')[$i];
                            $data['event_name']                 = $this->input->post('ename')[$i];
                            $data['event_date']                 = $this->input->post('edate')[$i];
                            $data['event_time']                 = $this->input->post('etime')[$i];
                            
                            $result = $this->AdminModel->insertvendorevent($data);
                        }
                    }
                    
                    if ($result > 0) 
                    {
                        for ($i=0; $i < count($this->input->post('add_location')) ; $i++) 
                        {
                            if($this->input->post('add_location')[$i]!="Select" || $this->input->post('ddate')[$i]!="")
                            {
                                
                                $location['event_id']   = $this->input->post('cuss_id');    //$result;
                                $location['location_type']  =   $this->input->post('add_location')[$i];
                                $location['location_date']  =   $this->input->post('ddate')[$i];
                                $location['location_time']  =   $this->input->post('time')[$i];
                                $location['location_address']=  $this->input->post('address')[$i];
                                $location['location_city']= $this->input->post('city')[$i];
                                $location['location_state']=    $this->input->post('state')[$i];
                                $location['location_zip']=  $this->input->post('zip')[$i];
                                $location['location_phone']=    $this->input->post('phone')[$i];
                                //$location['location_landmark']=   $this->input->post('landmark')[$i];
                                $location['location_note']= $this->input->post('note')[$i];
                                $result1=$this->AdminModel->insertvendorlocation($location);
                            }
                        }    
                    }
                    $this->session->set_flashdata('success',"Event Created Successfully..!!");
                   
                }
                else if($result_cus>0)
                {
                    $this->db->where("cus_id",$this->input->post('cuss_id'));
                    if($this->db->delete('vendor_events_register'))
                    {
                        for ($i=0; $i < count($this->input->post('event_type')) ; $i++) 
                        {
                            if($this->input->post('event_type')[$i]!="Select" || $this->input->post('edate')[$i]!="")
                            {
                                $data['cus_id']                         = $this->input->post('cuss_id');
                                $data['event_type']                 = $this->input->post('event_type')[$i];
                                $data['event_name']                 = $this->input->post('ename')[$i];
                                $data['event_date']                 = $this->input->post('edate')[$i];
                                $data['event_time']                 = $this->input->post('etime')[$i];
                                $result = $this->AdminModel->insertvendorevent($data);
                            }
                        }
                    }
                    $this->db->where("event_id",$this->input->post('cuss_id'));
                    if($this->db->delete('vendor_event_location'))
                    {
                        for ($i=0; $i < count($this->input->post('add_location')) ; $i++) 
                        {
                            if($this->input->post('add_location')[$i]!="Select" || $this->input->post('ddate')[$i]!="")
                            {
                                $location['event_id']   = $this->input->post('cuss_id');    //$result;
                                $location['location_type']  =   $this->input->post('add_location')[$i];
                                $location['location_date']  =   $this->input->post('ddate')[$i];
                                $location['location_time']  =   $this->input->post('time')[$i];
                                $location['location_address']=  $this->input->post('address')[$i];
                                $location['location_city']= $this->input->post('city')[$i];
                                $location['location_state']=    $this->input->post('state')[$i];
                                $location['location_zip']=  $this->input->post('zip')[$i];
                                $location['location_phone']=    $this->input->post('phone')[$i];
                                //$location['location_landmark']=   $this->input->post('landmark')[$i];
                                $location['location_note']= $this->input->post('note')[$i];
                                $result1 = $this->AdminModel->insertvendorlocation($location);
                            }
                        }
                    }   
                    $this->session->set_flashdata('success',"Event Updated Successfully..!! ");
                
                }
                else 
                {
                    $this->session->set_flashdata('error',"Please select another date as event already exist for same date..!!");
                   
                }
            }
            else 
            {
                $this->session->set_flashdata('error',"Please enter the date..!!");
               
            } */

            $this->session->set_flashdata('success',"Event Created/ Updation Successfully..!!");
            redirect('Vendor/events');
        }

        public function searchVendor()
        {
            $cus_id = $this->input->get('id');
            
            if ($cus_id !="")
            {
                $this->session->set_userdata('id',$cus_id);
                redirect('fi_home/search_new_cus');
            }
        }

        public function searchVendorData()
        {            
            $cus_fname  = $this->input->post('fname');
            $cus_lname  = $this->input->post('lname');
            $cus_cname  = $this->input->post('cname');
            $cus_zname  = $this->input->post('zname');
            $cus_mname  = $this->input->post('mname');
            $adr11      = $this->input->post('adr1');
            $adr22      = $this->input->post('adr2');
            $city       = $this->input->post('cities');
            $state      = $this->input->post('states');
            $areas      = $this->input->post('areas');
            $apcate     = $this->input->post('apcate');
            $apsubcate  = $this->input->post('apsubcate');

            if ($cus_fname  != "")  { $fname = $cus_fname;  } else { $fname = ""; }          
            if ($cus_lname  != "")  { $lname = $cus_lname;  } else { $lname = ""; }
            if ($cus_cname  != "")  { $cname = $cus_cname;  } else { $cname = ""; }
            if ($cus_zname  != "")  { $zname = $cus_zname;  } else { $zname = ""; }
            if ($cus_mname  != "")  { $mname = $cus_mname;  } else { $mname = ""; }
            if ($adr11      != "")  { $adr1  = $adr11;      } else { $adr1 = ""; }
            if ($adr22      !="")   { $adr2  = $adr22;      } else { $adr2 = ""; }
            if ($city       !="")   { $cities = $city;      } else { $cities = ""; }
            if ($state      !="")   { $states = $state;     } else { $states = ""; }
            if ($areas      !="")   { $area  = $areas;      } else { $area = ""; }
            if ($apcate     !="")   { $apcat = $apcate;     } else { $apcat = ""; } 
            if ($apsubcate  !="")   { $apsubcat = $apsubcate; } else { $apsubcat = ""; }
            $this->VendorModel->searchVender($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area,$apcate,$apsubcate);
        }

        public function search_allvendor()
        {
            $this->AdminModel->search_allvendor_dtls();
        }
     
        public function fnvendersrchbyph()
        {
            $txtphoneno = $this->input->post('txtphoneno');
            if ($txtphoneno !="") 
            {
                $phone =$txtphoneno;
            }
            else 
            {
                $phone="";
            }   
            $this->AdminModel->fnvendersrchbyph_dtls($phone);
        }

        public function search_vendor()
        {
            $cus_fname              = $this->input->post('fname');
            if ($cus_fname !="") {
                $fname =$cus_fname;
            }
            else {
                $fname="";
            }
            $cus_lname              = $this->input->post('v_type');
            if ($cus_lname !="") {
                $lname =$cus_lname;
            }
            else {
                $lname="";
            }
            $cus_cname              = $this->input->post('v_cat');
            if ($cus_cname !="") {
                $cname =$cus_cname;
            }
            else {
                $cname="";
            }
            $cus_zname              = $this->input->post('v_sub_cat');
            if ($cus_zname !="") {
                $zname =$cus_zname;
            }
            else {
                $zname="";
            }
    
            $data['customer'] = $this->AdminModel->search_vendor($fname,$lname,$cname,$zname);
    
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/search',$data);
            $this->load->view('fi/footer');
        }

        public function getVenderSearchInfo()
        {
            $cName = $this->input->post('name');
            $this->VendorModel->getVenderSearchInfo_dtls($cName);
        }

        /**
         * @author Prasanna Mane
         * Created Date: Date Nov 13, 2020
         * Update Date: Date Nov 13, 2020   
         */
        
        public function Delete($vendorId = 0)
        {
            $cond = array("cus_id" => $vendorId);
            $tbl = "register_vendor";
            $this->HomeModel->delete_data($tbl, $cond);
            redirect('Vendor/find','refresh');
        }

        public function getSearchVendContactInfo()
        {
            $cName = $this->input->post('name');
            $this->session->set_userdata('vendorId',$cName);
            $this->VendorModel->allSearchVendInfo($cName);
        }

        public function getSearchVendbalance()
        {
            $cName = $this->input->post('name');
            $this->session->set_userdata('vendorId',$cName);
            $this->VendorModel->getSearchVendbalanceDtl($cName);
        }

        public function GeneralInfo() 
        {
            $data['alert']      = $this->session->flashdata('alert');
            $data['error']      = $this->session->flashdata('error');
            $data['success']    = $this->session->flashdata('success');
            $data['contact']    = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
            $data['ap_cat']     = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
            $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();
            
            $data['page_title'] = "GENERAL INFO";

            $tbl = "sub_categories";
            $cond = array('cat_id'=> '54');
            $data['res'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

            $tbl = "sub_categories";
            $cond = array('cat_id'=> '4');
            $data['resCrews'] = $this->HomeModel->get_all_by_cond($tbl, $cond);

            $cond = array('cat_id' => 47);
            $tbl = "sub_categories";
            $data['contactEmail'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 


            //For Search Vendor - Start
            $vendorId = $this->session->userdata('vendorId');
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/generalinfo');
            $this->load->view('fi/footer');
        }

        public function search() 
        {
            $data['alert']      = $this->session->flashdata('alert');
            $data['error']      = $this->session->flashdata('error');
            $data['success']    = $this->session->flashdata('success');
            $data['contact']    = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
            
            $data['single_cust']= $this->AdminModel->vendor_search_data()[0];
            $data['ap_cat']     = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
            $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();
            $data['page_title'] = "SEARCH VENDOR";
            $data['vendorId']   = $this->session->userdata('vendorId');
            
            //For Search Vendor - Start

            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            
            $vendorId = $this->session->userdata('vendorId');
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End

            $this->load->view('fi/header');  
            $this->load->view('fi/sidebar');
            //$this->load->view('fi/vendor/search',$data);
            $this->load->view('fi/footer');
        }

        
        public function find()
        {
            $data['alert']      = $this->session->flashdata('alert');
            $data['error']      = $this->session->flashdata('error');
            $data['success']    = $this->session->flashdata('success');
            $data['contact']    = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
            
            $data['single_cust']= $this->AdminModel->vendor_search_data()[0];
            $data['ap_cat']     = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
            $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();
            
            $data['page_title'] = "SEARCH VENDOR";
            $data['vendorId']   = $this->session->userdata('vendorId');

            if($data['vendorId'] == "")
            {
                $data['vendorId'] = 0;
            }
            
            //For Search Vendor - Start

            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            $vendorId = $this->session->userdata('vendorId');
            if($vendorId > 0)
            {
                $cond = array('cus_id' => $vendorId);
                $tbl = "vender_contact_info";
                $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
                $data['contact_no'] = $vender_contact_info[0]['contact_no'];
            }
            
            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End

            $this->load->view('fi/header');  
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/search');
            $this->load->view('fi/footer');

        }


      
        public function genral_info()
        {
            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');
            $data['contact']      = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
           

            $data['single_cust'] = $this->AdminModel->vendor_search_data()[0];
            $data['ap_cat']  = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
            $data['ap_subcat']  = $this->db->where('cat_id',4)->get('sub_categories')->result_array();
            
         
            $data['page_title'] = "GENERAL INFO ";
            $data['vendorId']   = $this->session->userdata('vendorId');

            //For Search Vendor - Start

            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            $vendorId = $this->session->userdata('vendorId');
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End
    
            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/general_info');
            $this->load->view('fi/footer');
        }

        public function GetLocation()
        {
            $EventId = $this->input->post('EventId');

            $cond = array('event_id' => $EventId);
            $tbl = "event_location";
            $event_location = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            if(count($event_location) > 0)
            {
                foreach($event_location as $location)
                { ?> 
                    <tr class="tr_clone">
                        <td><?=$location['location_type']?></td>
                        <td><?=$location['location_date']?></td>
                        <td><?=$location['location_time']?></td>
                        <td><?=$location['location_address']?></td>
                        <td><?=$location['location_city']?></td>
                        <td><?=$location['location_state']?>></td>
                        <td><?=$location['location_zip']?></td>
                        <td><?=$location['location_phone']?></td>
                        <td><?=$location['location_landmark']?></td>
                        <td><?=$location['location_note']?></td>
                    </tr>
                    <?php 
                } 
            }
        }

        public function GetEvent()
        {
            $vendorId = $this->input->post('vendorId');
            $this->session->set_userdata('vendorId',$vendorId);
           
            $cond = array('crews_vendor' => $vendorId);
            $this->db->select('er.*');
            $this->db->from('event_crews as ec');
            $this->db->join('events_register as er','er.event_id = ec.event_id','left');
            $this->db->where($cond);
            $query = $this->db->get();
            $event_data = $query->result_array();          

            if(count($event_data) > 0)
            {  
                foreach($event_data as $events_info)
                {
                    if($events_info['event_lost']=="1") 
                    {
                        $dispsts = "display:none"; 
                    }
                    else
                    {
                        $dispsts = ""; 
                    }
                    ?>
                    <tr class="tr_clone bg bg<?=$events_info['event_id']?>" style="<?=$dispsts?>" onclick="getlocation(<?=$events_info['event_id']?>)">
                        <td><?=$events_info['event_type']?></td>
                        <td><?=$events_info['event_name']?></td>
                        <td><?=date('m/d/Y',strtotime($events_info['event_date']))?></td>
                        <td><?=$events_info['event_time']?></td>
                    </tr>
                    <?php 
                } 
            }
        }

        
        public function vendorEvent()
        {
            $vendorId = $this->input->post('name');
            $this->session->set_userdata('vendorId',$vendorId);
            
            $cond = array('cus_id' => $vendorId);
            $tbl = "vendor_events_register"; 
            $event_data = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            $cond = array('cat_id' => 3);
            $tbl = "sub_categories"; 
            $event_name = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            if(count($event_data) > 0)
            {  
                foreach($event_data as $events_info)
                {
                    if($events_info['event_lost']=="1") 
                    {
                        $dispsts = "display:none"; 
                    }
                    else
                    {
                        $dispsts = ""; 
                    }
                    ?>
                    <tr class="tr_clone" style="<?=$dispsts?>">
                        <!--   <td>1</td> -->
                        <td width="100px">
                            <select class="form-control" name="event_type[]" style="width: 100px;">
                                <option>Choose</option>
                                <?php
                                $i = 1;
                                foreach ($event_name as $name) 
                                { 
                                    if($events_info['event_type'] == $name['sub_name'])
                                    {
                                        $evntyesel = "selected";
                                    }
                                    else
                                    {
                                        $evntyesel = "";
                                    }
                                    ?>
                                    <option <?=$evntyesel?> value="<?php echo $name['sub_name'];?>"><?php echo $name['sub_name']; ?></option>
                                    <?php  
                                } ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="cuss_id" id="cuss_id" value="<?php echo $last_row['cus_id']; ?>" >
                            <input type="text" name="ename[]" value="<?=$events_info['event_name']?>" class="form-control" style="text-transform:capitalize;">
                        </td>
                        <td>
                            <input type="date" name="edate[]" id="edate" class="form-control edate" onchange="myDate()" value="<?=$events_info['event_date']?>">
                        </td>
                        <td>
                            <input type="time" name="etime[]" id="etime" class="form-control" onchange="myDate()" value="<?=$events_info['event_time']?>">
                        </td>
                        <td>
                            <a onclick="fndelevent('<?=$events_info['event_id']?>','<?=$events_info['cus_id']?>')" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a>
                        </td>
                    </tr>
                    <?php 
                } 
            }
        }

        public function pricelist()
        {
            $vendorId = $this->session->userdata('vendorId');
            $data['vendorId'] = $vendorId;
            if($data['vendorId'] == '')
            {
                $data['vendorId'] = 0;
            }

            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');
            
            $data['page_title'] = "PRICE LIST";     

            //For Search Vendor - Start
            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/pricelist');
            $this->load->view('fi/footer');
        }

        public function loadpricelist()
        {
            $tbl = "admin_item";
            $admin_item = $this->HomeModel->get_all($tbl); 

            $vendorId = $this->input->post('vendorId');
            ?>
            <tr class="myrow"> 
                <td>
                    <input style="width:100%" type="text" list="itemName" name="itemName" class="itemname" onblur="saveprice()"> 
                    <datalist id="itemName">
                    <?php foreach($admin_item as $item) { ?> <option value="<?=$item['item_name']?>"> <?php } ?>
                    </datalist>
                </td>
                <td>
                    <input style="width:100%" type="text" name="description" class="description">
                </td>
                <td>
                    <div class="input-group" bis_skin_checked="1" style="float: right;">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-usd" style="margin-top:2px; margin-right:-16px">
                            </span>
                        </span>
                        <input type="text" name="amount" class="form-control amount" style="width: 100%;" value="0.00" >
                    </div>
                </td>
                <td>
                    <input type="checkbox" class="taxble">
                </td>
                <td>
                    <input style="width:100%" type="text" name="note" class="mynote">
                </td>
                <td>
                    <input style="width:100%" class="mydate" type="text" placeholder="mm/dd/yyyy" readonly>
                </td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $tbl = "pricelist";
            $cond['vendor_id'] = $this->session->userdata('vendorId');
            $cond['user'] = $this->session->fi_session['id'];
            $pricelist = $this->HomeModel->get_all_by_cond($tbl, $cond);

            $i = 1;
            foreach($pricelist as $row)
            {
                $tbl = "users";
                $condUser['id'] = $row['user'];
                $users = $this->HomeModel->get_all_by_cond($tbl, $condUser);

                if($row['taxble'] == '1')
                {
                    $taxble = "checked";
                }
                else
                {
                    $taxble = "";
                }

                $date = date_create($row['mydate']);
                $mydate = date_format($date,"m/d/Y");
                ?>
                <tr class="myrow remove<?=$row['id']?>"> 
                    
                    <td>
                        <input onchange="updateprice(<?=$row['id']?>)" style="width:100%" type="text" list="itemNameupdate" name="itemName" class="itemname<?=$row['id']?>" value="<?=$row['itemname']?>"> 
                        <datalist id="itemNameupdate">
                        <?php
                        foreach($admin_item as $item)
                        { ?>
                            <option value="<?=$item['item_name']?>">
                            <?php
                        }
                        ?>
                        </datalist>
                    </td>
                    <td>
                        <input style="width:100%" type="text" name="description" class="description<?=$row['id']?>"  value="<?=$row['description']?>" onchange="updateprice(<?=$row['id']?>)">
                    </td>
                    <td>
                        <div class="input-group" bis_skin_checked="1" style="float: right;">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-usd" style="margin-top:2px; margin-right:-16px">
                                </span>
                            </span>
                            <input type="text" name="amount" class="form-control amount<?=$row['id']?>" style="width: 100%;" value="<?=$row['amount']?>" onchange="updateprice(<?=$row['id']?>)">
                        </div>
                    </td>
                    <td>
                        <input type="checkbox" class="taxble<?=$row['id']?>" <?=$taxble?>>
                    </td>
                    <td>
                        <input style="width:100%" type="text" name="note" class="mynote<?=$row['id']?>" value="<?=$row['mynote']?>" onchange="updateprice(<?=$row['id']?>)">
                    </td>
                    <td>
                        <input style="width:100%" class="mydate<?=$row['id']?>" type="text" placeholder="mm/dd/yyyy"  value="<?=$mydate?>" readonly>
                    </td>
                    <td><?=$users[0]['username']?></td>
                    <td>    
                        <button onclick="deleteprice(<?=$row['id']?>)" class="btn btn-xs btn-danger ">
                        <i class="fa fa-minus"></i></button>
                    </td>
                </tr>
                <?php
            }
        }

        public function deleteprice()
        {
            $Id = $this->input->post('Id');
            $cond['id'] = $Id; 
            $tbl = "pricelist";
            if($this->HomeModel->delete_data($tbl, $cond))
            {
                echo "Success";
            } 
            else
            {
                echo "Fail";
            }
        }


        public function updateprice()
        {
            $date = date_create($this->input->post('mydate'));
            //$data['mydate'] = date_format($date,"Y-m-d H:i:s");
            $data['mynote'] = $this->input->post('mynote');
            $data['itemname'] = $this->input->post('itemname');
            $data['description'] = $this->input->post('description');
            $data['amount'] = $this->input->post('amount');
            $data['taxble'] = $this->input->post('taxble');
            $data['vendor_id'] = $this->session->userdata('vendorId');
            $data['user'] = $this->session->fi_session['id'];

            $cond['id'] = $this->input->post('id');

            $tbl = "pricelist";
            if($this->HomeModel->update_data($tbl, $cond, $data))
            {
                echo "Success";
            } 
            else
            {
                echo "Fail";
            }
        }



        public function enclosure()
        {
            $data['alert'] = $this->session->flashdata('alert');
            $data['error'] = $this->session->flashdata('error');
            $data['success'] = $this->session->flashdata('success');

            $data['search'] = $this->Vendor_attachment_Model->search_data();
            $data['single_cust'] = $this->Vendor_attachment_Model->search_data()[0];
            
            $data['page_title'] = "ATTACHMENT";
         

            //For Search Vendor - Start

            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            $vendorId = $this->session->userdata('vendorId');
            $data['vendorId'] = $vendorId;
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End

            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/attachments');
            $this->load->view('fi/footer');
        }

        public function payments()
        {
            $data['alert']    = $this->session->flashdata('alert');
            $data['error']    = $this->session->flashdata('error');
            $data['success']  = $this->session->flashdata('success');
            
            $data['page_title'] = "PAYMENTS";
      

            //For Search Vendor - Start

            $user = $this->session->fi_session['id'];
            $cond = array('user' => $user);
            $tbl = "register_vendor";
            $data['venders'] = $this->HomeModel->get_all_by_cond($tbl, $cond); 

            $vendorId = $this->session->userdata('vendorId');
            $data['vendorId'] = $vendorId;
            $cond = array('cus_id' => $vendorId);
            $tbl = "vender_contact_info";
            $vender_contact_info = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['contact_no'] = $vender_contact_info[0]['contact_no'];

            $tbl = "register_vendor";
            $register_vendor = $this->HomeModel->get_all_by_cond($tbl, $cond); 
            $data['balence'] = $register_vendor[0]['balence'];
            //For Search Vendor - End


            $this->load->view('fi/header');
            $this->load->view('fi/sidebar');
            $this->load->view('fi/vendor/header', $data);
            $this->load->view('fi/vendor/payments');
            $this->load->view('fi/footer');
        }

        

    }
