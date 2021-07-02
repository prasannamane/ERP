<div class="box box-info customer_sec titlen_search">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-5 col-md-4">
                <h3 class="uhead1"><?=$select_customer_name?></h3>
            </div>
          
            <div class="col-sm-7 col-md-8">
                <div class="pull-right">
                    <ul class="list-inline topul">
                    <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                    <!-- <li><a href="#" class="uhead2"> Options </a></li> -->
                    <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button><?=$email_not?></li>
                    <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                    <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form action="<?=site_url('fi_home/search_cus')?>" method="POST" id="csearch">
        <div class="row space3">
            <div class="col-md-3 lstpaytype_cus_col">
                <div class="form-group">
                    <select class="form-control cus_event" id="cus_notes" name="cus_notes"  onchange="cus_event()" autofocus>
                 
                    <option value="">Choose</option> <?php
                                    foreach ($search as $cust) 
                                    {  
                                        if($cust['cus_id'] == $cus_id) 
                                        {   
                                            $selected = "selected";
                                        }
                                        else
                                        {
                                            $selected = "";
                                        }
                                    ?>
                            <option <?=$selected?> style="font-size:13px;" value="<?=$cust['cus_id']?>"><?=$cust['cus_lname'].", ".$cust['cus_fname']." - ". $cust['cus_address1']?></option>
                            <?php
                        } ?>

                   <!--  <?php
                    foreach ($search as $search_data) {  
                    if($search_data['cus_id'] == $cus_id) {
                    ?>   
                    <option style="font-size:13px;" value="<?=$search_data['cus_id']?>">
                      <?php print_r($search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?></option>
                      <?php
                    }
                  } ?>
                  
                  <?php
                  $i=1;
                  foreach ($search as $search_data) {
                    if($search_data['cus_id'] != $cus_id) {

                    ?>
                    <option style="font-size:13px;" value="<?=$search_data['cus_id']?>">
                      <?php print_r($search_data['cus_lname'].", ".$search_data['cus_fname']." - ". $search_data['cus_company_name']." - ".$search_data['cus_acc_no']); ?></option>
                      <?php
                      $i++;
                    }
                    }
                     ?> -->
                  </select>
                </div>


              </div>

              <?php
              $cus_id=$this->session->userdata('id');
                       // echo $cus_id;
              $cntinfosql=$this->db->query("SELECT * FROM user_contact_info WHERE cus_id='".$cus_id."' AND default_contact=1 AND conatct_type!='Email'");
              $cntinfosql_row=$cntinfosql->row();
                        // echo "phone".$cntinfosql_row;

              ?>

             
             <div class="loaduppertabcntdtls">

                 <div class="col-md-2" class="contact_no">
               <div class="form-group" id="contact_info">
                 <input class="form-control fcap contact_no" type="text" id="topphone" name="topphone" value="<?=$cntinfosql_row->contact_no?>" readonly disabled>
               </div>

             </div>
              <div class="col-md-2 cus_acc_no">

               <div class="form-group" id="lastinvId">
                <input class="form-control" type="text" placeholder="" value="" readonly disabled>
              </div>
            </div>

            <div class="col-md-2 balance_count">
             <div class="form-group" id="lastinvduebal">
               <input class="form-control" type="text" placeholder="" value="" readonly disabled>

             </div>

           </div>

         </div>
       </div>
     </form>
   </div>