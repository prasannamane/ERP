<div class="row common_search">
    <div class="col-md-3">

                   <div class="form-group">

                      <select class="form-control" id="searc" onchange="loadlist()" autofocus>
                       <?php foreach ($custs as $cust) {  ?>
                         <option value="<?php echo $cust['cus_id'] ?>"><?php print_r($cust['cus_lname']." - ". $cust['cus_company_name']); ?></option>
                       <?php } ?>


                     </select> 


                 <!--       <input class="form-control" type="text" list="searc" id="searc22" onchange="loadlist()" >

                         <datalist id="searc">

                            <?php
                              $custs_cnter=count($custs);
                            foreach ($custs as $cust) {
                            ?>
                         <option selected value="<?=$cust['cus_id']?>"><?=$cust['cus_lname']." - ". $cust['cus_company_name']?></option>
                             <?php } ?>

                         </datalist>    -->
                               

                   </div>

                 </div>

                 <div class="col-md-2">

                   <div class="form-group" id="contact_info">

                     <!-- <select class="form-control">

                       <option value="val">569 - 388 - 2534</option>

                     </select> -->
                     <input class="form-control fcap" name="search_text" id="search_text" type="text" value="<?php echo $single_cust['contact_no'] ?>">

                   </div>

                 </div>

                 <div class="col-md-2">

                   <div class="form-group">

                     <input class="form-control" type="text" placeholder="433">

                   </div>

                 </div>

                 <div class="col-md-2">

                   <div class="form-group">

                     <input class="form-control" type="text" placeholder="$16.33">

                   </div>

                 </div>

                 <div class="col-md-2">

                   <div class="form-group">

                     <input class="form-control" type="text" placeholder="1">

                   </div>

                 </div>

                 <div class="col-sm-1">
                         <!--<button class="btn btn-xs btn-primary btn-flat">Save</button>-->
                       </div>

               </div>