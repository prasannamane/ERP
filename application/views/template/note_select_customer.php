<div class="box box-info customer_sec titlen_search ">
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-5 col-md-4">
                <h3 class="uhead1"> <?=$select_customer_name?> </h3>
            </div>
            
            <div class="col-sm-7 col-md-8">
                <div class="pull-right">
                    <ul class="list-inline topul">
                        <li><button class="btn btn-default" > <i class="fa fa-envelope-o"></i></button>0</li>
                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                        <a href="<?=site_url('fi_home/newGeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Customer</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="box-body">
        <form action="<?=site_url('fi_home/search_cus')?>" method="POST" id="csearch">
                <div class="row space3">
                  <div class="col-md-3 lstpaytype_cus_col">
                    <div class="form-group">
                      <select class="form-control" id="cus_notes" name="cus_notes"  onchange="MM_jumpMenu('self',this,0)" autofocus="">
                        <option value="">Choose</option>
                          <?php
                         // $cus_id = $this->session->userdata('id');
                          foreach ($search as $search_data) {

                            if($cus_id == $search_data['cus_id']) {

                              $select = "selected";
                            }
                            else {

                              $select = "";
                            } ?>

                            <option <?=$select?> 
                            value="<?php echo $search_data['cus_id'] ?>" ><?=$search_data['cus_lname'].", ".$search_data['cus_fname']." - ". 
                                $search_data['cus_address1']?> </option>
                            
                            <?php
                            } ?>
                      </select>
                    </div>
                  </div>


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
</div>