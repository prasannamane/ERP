<?php  
 
    class VendorModel extends CI_Model  
 	{
        public function allGeneralVendInfo($cName)
        {
            $id = $cName;
            if ($id!="") 
            {
                $cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");
                $get_data = $cust1->result_array()[0];
                $contact = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
                $contactEmail = $this->db->where('cat_id',47)->get('sub_categories')->result_array();
                
                $user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' ORDER BY contact_id ASC");
                $get_all_contacts = $user_contact->result_array();
                
                $user_ship = $this->db->query("SELECT * from `vender_ship_address` WHERE `ship_user_id` = '$id'");
                $shipping = $user_ship->result_array()[0];
            } ?>
            <div class="col-md-6">
                <div class="box box-primary firstblock_bg">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header with-border mb5">
                                    <p class="uhead2">Name</p>
                                </div>
                                <input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
                                <div class="form-horizontal">
                                    <div class="form-group nospacerow">
                                        <div class="col-sm-2">
                                            <select class="form-control fcap" name="title" id="title" autofocus>
                                                <option value="">Prefix</option>
                                                <option <?php if($get_data['cus_title']=="Dr"){ echo "selected";}?> value="Dr">Dr.</option>
                                                <option <?php if($get_data['cus_title']=="Mr"){ echo "selected";}?> value="Mr">Mr.</option>
                                                <option <?php if($get_data['cus_title']=="Mrs"){ echo "selected";}?> value="Mrs">Mrs.</option>
                                                <option <?php if($get_data['cus_title']=="Ms"){ echo "selected";}?> value="Ms">Ms.</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">
                                        </div>
                                    </div>                                 
                                    <div class="form-group nospacerow">
                                        <div class="col-sm-12">
                                            <input class="form-control fcap group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">
                                        </div>
                                    </div>
                                    <div class="form-group nospacerow">
                                        <div class="col-sm-12">
                                            <input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">
                                        </div>
                                    </div>

                                    <div class="form-group nospacerow">
                                        <div class="col-sm-12">
                                            <input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2" >
                                        </div>
                                    </div>
                                    <div class="form-group nospacerow">
                                        <div class="col-sm-7">
                                            <input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly tabindex="-1">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly tabindex="-1">
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)"  type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">
                                        </div>
                                    </div>

                                    <div class="form-group nospacerow">
                                        <div class="col-sm-6">
                                            <select class="form-control fcap" name="tax_status" tabindex="-1">
                                                <option value="">Tax Status</option>
                                                <option <?if($get_data['cus_tax_status']=="1"){echo "selected";}?> value="1">Exempt</option>
                                                <option <?if($get_data['cus_tax_status']=="2"){echo "selected";}?> value="2">Out of state</option>
                                                <option <?if($get_data['cus_tax_status']=="3"){echo "selected";}?> value="3">Resale</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID" tabindex="-1">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-default firstblock_bg ">
                    <div class="box-header with-border">
                        <div class="col-md-5">
                            <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox uhead2">
                            <?php
                            if($shipping['billing_addr_status']=="1")
                            {
                                $chkstatus = "checked";
                            }
                            else
                            {
                                $chkstatus = "";
                            }
                            ?>
                            <label>
                                <input <?=$chkstatus?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()" >Same as billing address
                            </label>
                        </div>
                    </div>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                    </div>
                </div>

                <div class="box-body"  id="billaddress" >
                    <div class="form-horizontal">
                        <div class="form-group nospacerow">
                            <div class="col-sm-4">
                                <input class="form-control fcap" name="shipcusname" id="shipcusname" type="text" placeholder="Name" value="<?=$shipping['ship_cusname']?>">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2" >
                            </div>
                        </div>
                        <div class="form-group nospacerow">
                            <div class="col-sm-4">
                                <input class="form-control fcap text-center" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly tabindex="-1">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control fcap text-center" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly tabindex="-1">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control fcap text-center" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
     
            <div class="col-md-6">
                <div class="box box-primary firstblock_bg ">
                    <div class="box-body">
                        <div class="row space3">
                            <div class="col-md-12">
                                <div class="box-header with-border mb5">
                                    <p class="uhead2 2">Contact Info</p>
                                </div>                      
                                <div class="form-horizontal">
                                    <?php
                                    $user_contact1 = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' AND conatct_type IN('Home','Office','Mobile') ORDER BY contact_id ASC");
                                    $usrcntnrows = $user_contact1->num_rows();                   
                                    if($usrcntnrows == 0)
                                    {   ?>
                                        <div class="cnt_clone">
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <select name="cus_contact_type[]" class="form-control fcap mailevent"  id="cus_contact_type">
                                                        <option> Choose  </option>
                                                    <?php
                                                    foreach ($contact as $cont)
                                                    {
                                                        if($cont['sub_name']=="Home" || $cont['sub_name']=="Office" || $cont['sub_name']=="Mobile")
                                                        {
                                                            if($allContacts['conatct_type']==$cont['sub_name'])
                                                            {
                                                                $selectedcls = "selected";
                                                            }
                                                            else
                                                            {
                                                                $selectedcls="";
                                                            }
                                                            ?>
                                                            <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
                                                            <?php  
                                                        }    
                                                    } ?>
                                                    </select>
                                                </div>
                                        
                                                <div class="col-sm-3">
                                                    <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details" autocomplete="off">
                                                </div>

                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control fcap cusnote" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">
                                                </div>

                                                <div class="col-sm-3">
                                                    <label class="switch">
                                                        <input class="fnchkphoneno" type="checkbox"  name="radio_click[]"  checked value="on">
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div><?php
                                    }
                                    else
                                    {
                                        foreach($get_all_contacts as $allContacts) 
                                        {
                                            if($allContacts['conatct_type']=="Home" || $allContacts['conatct_type']=="Office" || $allContacts['conatct_type']=="Mobile")
                                            {    
                                                if($allContacts['default_contact'] == 0)
                                                {
                                                    ?>
                                                    <div class="cnt_clone">
                                                        <div class="form-group">
                                                            <div class="col-sm-3">
                                                                <select name="cus_contact_type[]" class="form-control fcap mailevent"  id="cus_contact_type">
                                                                    <option> Choose  </option>
                                                                    <?php
                                                                    foreach ($contact as $cont)
                                                                    {
                                                                        if($cont['sub_name']=="Home" || $cont['sub_name']=="Office" || $cont['sub_name']=="Mobile")
                                                                        {
                                                                            //echo $allContacts['conatct_type'];
                                                                            if($allContacts['conatct_type']==$cont['sub_name'])
                                                                            {
                                                                                $selectedcls="selected";
                                                                            }
                                                                            else
                                                                            {
                                                                                $selectedcls="";
                                                                            }
                                                                            ?>
                                                                                <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
                                                                            <?php  
                                                                        } 
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="col-sm-3">
                                                                <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details" autocomplete="off">
                                                            </div>
                                                    
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control cusnote fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label class="switch">
                                                                    <input class="fnchkphoneno" type="text"  name="radio_click[]" value="off">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                                <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                } 
                                            } 
                                        } 
                                    }
                                    foreach($get_all_contacts as $allContacts) 
                                    {
                                        if($allContacts['conatct_type']=="Home" || $allContacts['conatct_type']=="Office" || $allContacts['conatct_type']=="Mobile")
                                        {
                                            if($allContacts['default_contact'] == 1)
                                            {
                                                ?>
                                                <div class="cnt_clone">
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <select name="cus_contact_type[]" class="form-control fcap mailevent"  id="cus_contact_type">
                                                                <option>Choose</option>
                                                                <?php
                                                                foreach ($contact as $cont)
                                                                {
                                                                    if($cont['sub_name']=="Home" || $cont['sub_name']=="Office" || $cont['sub_name']=="Mobile")
                                                                    {
                                                                        
                                                                        if($allContacts['conatct_type']==$cont['sub_name'])
                                                                        {
                                                                            $selectedcls = "selected";
                                                                        }
                                                                        else
                                                                        {
                                                                            $selectedcls = "";
                                                                        }
                                                                        ?>
                                                                        <option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
                                                                        <?php  
                                                                    } 
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="col-sm-3">
                                                            <input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text"  placeholder="Contact details" autocomplete="off">
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control fcap cusnote" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <label class="switch">
                                                                <input class="fnchkphoneno" type="checkbox"  name="radio_click[]"  checked value="on">
                                                                <span class="slider round"></span>
                                                            </label>
                                                            <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                            } 
                                        } 
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary firstblock_bg ">
                    <div class="box-body">
                        <div class="row space3">
                            <div class="col-md-12">
                                <div class="box-header with-border mb5">
                                    <p class="uhead2 2">Email Info</p>
                                </div>
                                <div class="form-horizontal">
                                    <?php
                                    $user_contact2 = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' AND conatct_type IN('Email', 'Website') ORDER BY contact_id ASC");
                                    $usremlcntnrows = $user_contact2->num_rows();
                                    if($usremlcntnrows == 0)
                                    {   ?>
                                        <div class="cnt_clone">
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                        <select name="cuscnt_type_email[]" class="form-control fcap mailevent 9" >
                                                        <option>Choose</option>
                                                        <?php
                                                        foreach ($contactEmail as $cont) 
                                                        {   ?>
                                                            <option value="<?=$cont['sub_name']?>"><?=$cont['sub_name']?></option>
                                                            <?php   
                                                        }   ?>
                                                    </select>
                                                </div>
                                             <div class="col-sm-3">
                                                 <input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" value="<?php echo $allContacts['email']; ?>" onchange="ValidateEmail(this)">
                                             </div>
                                             <div class="col-sm-3">
                                                 <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>
                                             </div>
                                             <div class="col-sm-3">
                                                 <label class="switch">
                                                    <input class="fnchkemailId" type="checkbox"  name="email_radio_click[]"  checked value="on">
                                                     <span class="slider round"></span>
                                                 </label>
                                                 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                             </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        foreach($get_all_contacts as $allContacts) 
                                        {
                                            if($allContacts['conatct_type']=="Email" || $allContacts['conatct_type'] == "Website")
                                            {
                                               if($allContacts['default_contact'] == 0)
                                               {
                                                    ?>
                                                    <div class="cnt_clone">
                                                        <div class="form-group">
                                                            <div class="col-sm-3">
                                                                <select name="cuscnt_type_email[]" class="form-control fcap mailevent 10" >
                                                                <option value="<?=$allContacts['conatct_type']?>"><?=$allContacts['conatct_type']?></option>
                                                                    <?php
                                                                    foreach ($contactEmail as $cont) 
                                                                    {   ?>
                                                                        <option value="<?=$cont['sub_name']?>"><?=$cont['sub_name']?></option>
                                                                        <?php   
                                                                    }   ?>
                                                                </select>
                                                            </div>
                                             
                                                            <div class="col-sm-3">
                                                                <input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" value="<?php echo $allContacts['email']; ?>">
                                                            </div>
                                             
                                                            <div class="col-sm-3">
                                                                <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1">
                                                                <i class="fa fa-envelope"></i></a>
                                                            </div>
                                             
                                                            <div class="col-sm-3">
                                                                <label class="switch">
                                                                    <input class="fnchkemailId" type="radio"  name="email_radio_click[]" value="off">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                                <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                } 
                                            } 
                                        } 
                                    }
                                    foreach($get_all_contacts as $allContacts) 
                                    {
                                        if($allContacts['conatct_type']=="Email" || $allContacts['conatct_type'] == "Website")
                                        {
                                            if($allContacts['default_contact'] == 1)
                                            {
                                                ?>
                                                <div class="cnt_clone">
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                            <select name="cuscnt_type_email[]" class="form-control fcap mailevent 1" >
                                                            <option value="<?=$allContacts['conatct_type']?>"><?=$allContacts['conatct_type']?></option>
                                                            <?php
                                                                foreach ($contactEmail as $cont) 
                                                                {   ?>
                                                                    <option value="<?=$cont['sub_name']?>"><?=$cont['sub_name']?></option>
                                                                    <?php   
                                                                }   ?>
                                                            </select>
                                                        </div>
                                             
                                                        <div class="col-sm-3">
                                                            <input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" value="<?php echo $allContacts['email']; ?>" onchange="ValidateEmail(this)">
                                                        </div>
                                             
                                                        <div class="col-sm-3">
                                                            <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>
                                                        </div>
                                             
                                                        <div class="col-sm-3">
                                                            <label class="switch">
                                                                <input class="fnchkemailId" type="radio"  name="email_radio_click[]"  checked value="on">
                                                                <span class="slider round"></span>
                                                            </label>
                                                            <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                            } 
                                        } 
                                    } ?>
                                    <div class="cnt_clone">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <select name="cuscnt_type_email[]" class="form-control fcap mailevent 9" >
                                                        <option>Choose</option>
                                                        <?php
                                                        foreach ($contactEmail as $cont) 
                                                        {   ?>
                                                            <option value="<?=$cont['sub_name']?>"><?=$cont['sub_name']?></option>
                                                            <?php   
                                                        }   ?>
                                                    </select>
                                            </div>
                                            <div class="col-sm-3">
                                                 <input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" value="" onchange="ValidateEmail(this)">
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1">
                                                <i class="fa fa-envelope"></i></a>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                 <label class="switch">
                                                    <input class="fnchkemailId" type="radio"  name="email_radio_click[]" >
                                                     <span class="slider round"></span>
                                                 </label>
                                                 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="box box-primary firstblock_bg ">
                <div class="box-body">
                    <div class="row space3">
                        <div class="col-md-12">
                            <div class="box-header with-border mb5">
                                <p class="uhead2">AP Category</p>
                            </div>
                            <div class="box-body">
                                <div class="form-horizontal">
                                    


                                    <?php 
                                        $tbl = "vendor_apcat";
                                        $cond = array('vendor_id' => $get_data['cus_id'], 'apcat !=' => ''); 
										$vendor_rating = $this->HomeModel->get_all_by_cond($tbl, $cond); 
                                        
                                        if(count($vendor_rating) > 0){
                                        foreach($vendor_rating as $rowvr)
                                        {
                                            ?>
											<div class="cnt_clone">
												<div class="form-group">
													<div class="col-sm-6">
														<select  onchange="apCat(<?=$rowvr['id']?>)" class="form-control valid apCat<?=$rowvr['id']?>"  name="apcateupdate[]">
													
															<?php 
															$tbl = "sub_categories";
															$cond = array('cat_id'=> '5');
															$res = $this->HomeModel->get_all_by_cond($tbl, $cond);
                                                            foreach($res as $row )
                                                            {
                                                                if($row['sub_id'] == $rowvr['apcat']) {  $select ="selected"; } else{ $select =""; }
															?>
															<option <?=$select?> value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
															<?php    
															}
															?>                                                 
														</select>
													</div>
													<div class="col-sm-5">
														<select class="form-control valid subApCat<?=$rowvr['id']?>" name="apsubcateupdate[]">
														
															<?php 
															$tbl = "sub_categories";
															$cond = array('cat_id'=> '54');
															$res = $this->HomeModel->get_all_by_cond($tbl, $cond);
                                                            foreach($res as $row )
                                                            { 
                                                                if($row['sub_id'] == $rowvr['apsubcat']) {  $select ="selected"; } else{ $select =""; }
															?>
															<option <?=$select?> value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
															<?php    
															}
															?>
														</select>
													</div>
                                                    <!--
													<d class="col-sm-1" style="">
														<a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>
													</div>
                                                    -->
												</div>
											</div>
											<?php 
                                        } 
                                    }else{ ?>

                                        <div class="cnt_clone">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <select onchange="apCat('')" class="form-control valid apCat" name="apcateupdate[]">
                                                    <option value="">Choose</option>
                                                    <?php 
                                                    $tbl = "sub_categories";
                                                    $cond = array('cat_id'=> '5');
                                                    $res = $this->HomeModel->get_all_by_cond($tbl, $cond);
                                                  
                                                    foreach($res as $row ){
                                                    ?>
                                                    <option value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
                                                    <?php    
                                                    }
                                                    ?>                                                 
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control valid subApCat" name="apsubcateupdate[]">
                                                    <option value="">Choose</option>
                                                    <?php 
                                                    $tbl = "sub_categories";
                                                    $cond = array('cat_id'=> '54');
                                                    $res = $this->HomeModel->get_all_by_cond($tbl, $cond);
                                                    foreach($res as $row ){
                                                    ?>
                                                    <option value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
                                                    <?php    
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!--
                                            <div class="col-sm-1" style="">
                                                <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                            </div>
                                            -->
                                        </div>
                                    </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary firstblock_bg ">
                <div class="box-body">
                    <div class="row space3">
                        <div class="col-md-12">
                            <div class="box-header with-border mb5">
                                <p class="uhead2">Type</p>
                            </div>
                            <div class="box-body">
                                <div class="form-horizontal">
                                    

                                        <?php 
                                        $tbl = "vendor_rating";
                                        $cond = array('vendor_id' => $get_data['cus_id'], 'aptype !=' => '' ); 
                                        $vendor_rating = $this->HomeModel->get_all_by_cond($tbl, $cond); 
                                        foreach($vendor_rating as $rowvr)
                                        {
                                            ?>
											<div class="cnt_clone">
												<div class="form-group">
													<div class="col-sm-6">
														<select class="form-control valid" name="aptype[]">
														
															<?php 
															$tbl = "sub_categories";
															$cond = array('cat_id'=> '4');
															$res = $this->HomeModel->get_all_by_cond($tbl, $cond);
															foreach($res as $row )
															{
                                                                if($rowvr['aptype'] == $row['sub_id']){ $select = "selected"; } else { $select = ""; }
																?>
																<option value="<?=$row['sub_id']?>" <?=$select?>><?=$row['sub_name']?></option>
																<?php    
															}
															?>
														</select>
													</div>
													<div class="col-sm-5">
														<select class="form-control valid" name="rating[]">
														<option value="<?=$rowvr['rating']?>"><?=$rowvr['rating']?></option>
															<option value="*">*</option>
															<option value="**">**</option>
															<option value="***">***</option>
															<option value="****">****</option>
															<option value="*****">*****</option>
														</select>
													</div>
                                                	<div class="col-sm-1" style="">
                                                		<a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>
                                            		</div>
                                            	</div>
											</div>
                                            <?php 
                                        } ?>

                                    <div class="cnt_clone">
                                        <div class="form-group">
                                            
                                            <div class="col-sm-6">
                                                <select class="form-control valid" name="aptype[]">
                                                <option value="">Type Choose</option>
                                                    <?php 
                                                    $tbl = "sub_categories";
                                                    $cond = array('cat_id'=> '4');
                                                    $res = $this->HomeModel->get_all_by_cond($tbl, $cond);
                                                    foreach($res as $row ){
                                                    ?>
                                                    <option value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
                                                    <?php    
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-5">
                                                <select class="form-control valid" name="rating[]">
                                                    <option value="">Rating Choose</option>
                                                    <option value="*">*</option>
                                                    <option value="**">**</option>
                                                    <option value="***">***</option>
                                                    <option value="****">****</option>
                                                    <option value="*****">*****</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1" style="">
                                                <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <div class="col-md-12 text-center">
                <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
                <button name="Submit" id="Submit" class="btn btn-lg btn-info btn-flat">Save & Continue</button>
            </div>
            <?php
        }

        public function getVenderSearchInfo_dtls($cName)
        {
            $id = $cName;
            $cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");
    
            $get_data = $cust1->result_array()[0];
    
            $this->db->select('*');
            $this->db->from('vender_contact_info');
            $this->db->where('cus_id', $id);
            $query = $this->db->get()->result_array()[0];  
    
            $phonarr = array();
            $notesarr = array();
            $cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '$id'");
            foreach ($cntinfosql->result() as $cntinfosql)
            {
                 $phonarr[].=$cntinfosql->contact_no;
                 $notesarr[].=$cntinfosql->user_contact_note;
            }
    
            $setnotes = implode(",",$notesarr);
            if(count($setnotes) == 1)
            {
                $htmlnotes=$setnotes;
            }
            else
            {
                $htmlnotes = explode(",",$setnotes);
            }
    
            $setphones = implode(",",$phonarr);
            if(count($setphones) == 1) 
            {
                $htmlphone = $setphones;
            }
            else
            {
                $htmlphone = explode(",",$setphones);
            }
            ?>
            <tr onclick="SerachSelect(<?=$get_data['cus_id']?>)">
                <!--<td>1</td>-->
                <td><?=$get_data['cus_title']?></td>
                <td style="text-transform:capitalize;"><?=$get_data['cus_fname']?></td>
                <td style="text-transform:capitalize;"><?=$get_data['cus_lname']?></td>
                <td><?=$get_data['cus_company_name']?></td>
                <td><?=$get_data['cus_address1']?></td>
                <td><?=$get_data['cus_address2']?></td>
                <td><?=$get_data['cus_city']?></td>
                <td><?=$get_data['cus_state']?></td>
                <td><?=$get_data['cus_zip']?></td>
                <td><?=$get_data['cus_area']?></td>
                <td><?=trim($htmlphone,",")?></td>
                <td><?=trim($htmlnotes,",")?></td>
            </tr>
            <?php
        }

        public function searchVender($fname,$lname,$cname,$zname,$mname,$adr1,$adr2,$cities,$states,$area,$apcate,$apsubcate)
        {
            /*
            $con1 = "";
            $cond2 = "";
            if ($fname      != "") { $con1 = 'o.cus_fname LIKE "%'.$fname.'%"'; }
            if ($lname      != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_lname         LIKE "%'.$lname.'%"';   } else { $con1 = 'o.cus_lname       LIKE "%'.$lname.'%"'; } }
            
            if ($cname      != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_company_name  LIKE "%'.$cname.'%"';   } else { $con1 = 'o.cus_company_name LIKE "%'.$cname.'%"'; } }
            if ($zname      != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_zip           LIKE "%'.$zname.'%"';   } else { $con1 = 'o.cus_zip         LIKE "%'.$zname.'%"'; } }
            
            if ($mname      != "") { if($con1!="") { $con1 = $con1 ." AND ".'c.contact_no        LIKE "%'.$mname.'%"';   } else { $con1 = 'c.contact_no      LIKE "%'.$mname.'%"'; } } 
            
            if ($adr1       != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_address1      LIKE "%'.$adr1.'%"';    } else { $con1 = 'o.cus_address1    LIKE "%'.$adr1.'%"'; } }
            if ($adr2       != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_address2      LIKE "%'.$adr2.'%"';    } else { $con1 = 'o.cus_address2    LIKE "%'.$adr2.'%"'; } } 
            if ($cities     != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_city          LIKE "%'.$cities.'%"';  } else { $con1 = 'o.cus_city        LIKE "%'.$cities.'%"'; } }
            if ($states     != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_state         LIKE "%'.$states.'%"';  } else { $con1 = 'o.cus_state       LIKE "%'.$states.'%"'; } }             
            if ($area       != "") { if($con1!="") { $con1 = $con1 ." AND ".'o.cus_area          LIKE "%'.$area.'%"';    } else { $con1 = 'o.cus_area        LIKE "%'.$area.'%"'; } }
            
            if ($apcate     != "") { if($con1!="") { $con1 = $con1 ." AND ".'a.apcat             LIKE "%'.$apcate.'%"'; $cond2 = "AND `a`.`vendor_id` = `o`.`cus_id`"; } else{ $con1='a.apcat LIKE "%'.$apcate.'%"'; $cond2 = " AND `a`.`vendor_id` = `o`.`cus_id`"; } } 
            if ($apsubcate  != "") { if($con1!="") { $con1 = $con1 ." AND ".'a.apsubcat          LIKE "%'.$apsubcate.'%"'; $cond2 = "AND `a`.`vendor_id` = `o`.`cus_id`"; } else{ $con1='a.apsubcat LIKE "%'.$apsubcate.'%"'; $cond2 = "AND `a`.`vendor_id` = `o`.`cus_id`"; } }
    
    
            $sql = "SELECT * from vender_contact_info AS c,register_vendor AS o, vendor_apcat AS a WHERE (".$con1.") AND c.cus_id = o.cus_id  ".$cond2." GROUP BY o.cus_id";
            $cust1 = $this->db->query($sql);
            */


            $this->db->select('rv.*, ci.*, va.*,rv.cus_id as myid');
            $this->db->from('register_vendor as rv');    
            $this->db->join('vender_contact_info as ci', 'ci.cus_id = rv.cus_id','left');
            $this->db->join('vendor_apcat as va', 'va.vendor_id = rv.cus_id','left');
        
            if($fname != "")    { $this->db->like('rv.cus_fname',$fname); }
            if($lname != "")    { $this->db->like('rv.cus_lname',$lname); }
            if($cname != "")    { $this->db->like('rv.cus_company_name',$cname); }
            if($zname != "")    { $this->db->like('rv.cus_zip',$zname); }
            if($adr1 != "")     { $this->db->like('rv.cus_address1',$adr1); }
            if($adr2 != "")     { $this->db->like('rv.cus_address2',$adr2); }
            if($cities != "")   { $this->db->like('rv.cus_city',$cities); }
            if($states != "")   { $this->db->like('rv.cus_state',$states); }
            if($area != "")     { $this->db->like('rv.cus_area',$area); }
            if($mname != "")     { $this->db->like('ci.contact_no',$mname); }
            if($apcate != "")     { $this->db->where('va.apcat',$apcate); }
            if($apsubcate != "")  { $this->db->where('va.apsubcat',$apsubcate); } 

        
            $this->db->group_by("rv.cus_id"); 
            $query = $this->db->get();
            $searchResult = $query->result(); 
            $searchCount = $query->num_rows(); 

            ?>
            <!-- <tr>
                <td colspan="12">
                    <?php print_r($this->db->last_query()); ?> 
                </td>
            </tr> --> 
            <?php
            if($searchCount > 0)
            {
                $srno = 1;
                foreach ($searchResult as $cust1_dtls)
                {
                    $phonarr = array();
                    $notesarr = array();
                    $cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '".$cust1_dtls->cus_id."'");
                    foreach ($cntinfosql->result() as $cntinfosql)
                    {
                        $phonarr[].=$cntinfosql->contact_no;
                        $notesarr[].=$cntinfosql->user_contact_note;
                    }
    
                    $setnotes = implode(",",$notesarr);
    
                    if(count($setnotes) == 1)
                    {
                        $htmlnotes = $setnotes;
                    }
                    else
                    {
                        $htmlnotes = explode(",",$setnotes);
                    }
            
                    $setphones=implode(",",$phonarr);
            
                    if(count($setphones) == 1)
                    {
                        $htmlphone=$setphones;
                    }
                    else
                    {
                        $htmlphone=explode(",",$setphones);
                    }
                ?>
                <tr onclick="SerachSelect(<?=$cust1_dtls->myid?>)">
                    <!--<td><?=$srno++?></td>-->
                    <td><?=$cust1_dtls->cus_title?></td>
                    <td style="text-transform:capitalize;"><?=$cust1_dtls->cus_fname?></td>
                    <td style="text-transform:capitalize;"><?=$cust1_dtls->cus_lname?></td>
                    <td><?=$cust1_dtls->cus_company_name?></td>
                    <td><?=$cust1_dtls->cus_address1?></td>
                    <td><?=$cust1_dtls->cus_address2?></td>
                    <td><?=$cust1_dtls->cus_city?></td>
                    <td><?=$cust1_dtls->cus_state?></td>
                    <td><?=$cust1_dtls->cus_zip?></td>
                    <td><?=$cust1_dtls->cus_area?></td>
                    <td><?=trim($htmlphone,",")?></td>
                    <td><?=trim($htmlnotes,",")?></td>
                </tr>
                <?php  
                 
                }
            }
            else
            {
                echo "No Vendors Found..!";
            }
        }

        public function allSearchVendInfo($cName)
        {
            $id = $cName;
            $this->db->select('*');
            $this->db->from('vender_contact_info');
            $this->db->where('cus_id', $id);
            $this->db->where('default_contact', 1);
            $query = $this->db->get()->result_array()[0];
            ?>
            <input style="" class="form-control" type="text" placeholder="0000000" value="<?=$query['contact_no']?>" >
            <!--    <input class="form-control fcap contact_no" onchange="fncustomersearchbyphone(this.value)" type="text" id="topphone" name="topphone" value="<?php echo $query['contact_no'] ?>" placeholder="(111) 111-1111" > -->
            <?php
        }

        public function getSearchVendbalanceDtl($cName)
        {
            $id = $cName;
            $this->db->select('*');
            $this->db->from('vender_contact_info');
            $this->db->where('cus_id', $id);
            $this->db->where('default_contact', 1);
            $query = $this->db->get()->result_array()[0];          
            echo $query['balence'];
        }
    }