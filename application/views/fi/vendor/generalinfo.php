<div class="content-wrapper">
    <section class="content-header">
        <h1>General Info</h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('fi_home/')?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Customer</a></li>
            <li class="active">General Info</li>
        </ol>
    </section>
    <?php $this->load->view('template/alert'); ?>   
    
    <section class="content">
        <div class="row">
            <form action="<?=site_url('Vendor/addvendor')?>" method="POST" name="pform" id="pform">
                
                <div class="col-md-6">
                    <div class="box box-primary firstblock_bg">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="uhead2">Name</p>
                                    <div class="form-horizontal">
                                        <div class="form-group nospacerow">
                                            <div class="col-sm-2">
                                                <select class="form-control fcap" name="title" id="title" autofocus>
                                                    <option value="">Prefix</option>
                                                    <option value="Dr">Dr.</option>
                                                    <option value="Mr">Mr.</option>
                                                    <option value="Mrs">Mrs.</option>
                                                    <option value="Ms">Ms.</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-5">
                                                <input class="form-control fcap" name="cus_fname" id="cus_fname" style="text-transform: uppercase;" type="text" placeholder="First Name">
                                            </div>
                      
                                            <div class="col-sm-5">
                                                <input class="form-control fcap group" name="cus_lname" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">
                                            </div>
                                        </div>
                    
                                        <div class="form-group nospacerow">
                                            <div class="col-sm-12">
                                                <input class="form-control fcap group" name="cus_com" id="cus_com" type="text" placeholder="Company">
                                            </div>
                                        </div>
                    
                                        <div class="form-group nospacerow">
                                            <div class="col-sm-12">
                                                <input class="form-control fcap" name="cus_address1" id="cus_address1" type="text" placeholder="Address1">
                                            </div>
                                        </div>
                    
                                        <div class="form-group nospacerow">
                                            <div class="col-sm-12">
                                                <input class="form-control fcap" name="cus_address2" id="cus_address2" type="text" placeholder="Address2" >
                                            </div>
                                        </div>
                    
                                        <div class="form-group nospacerow">
                                            <div class="col-sm-7">
                                                <input class="form-control fcap" name="cus_city" id="city" type="text" placeholder="City" readonly tabindex="-1">
                                            </div>
                                    
                                            <div class="col-sm-3">
                                                <input class="form-control fcap" name="cus_state" id="state" type="text" placeholder="State" readonly tabindex="-1">
                                            </div>

                                            <div class="col-sm-2">
                                                <input class="form-control fcap" name="cus_zip" id="cus_zip" type="text" placeholder="Zip">
                                            </div>
                                        </div>
                    
                                        <div class="form-group nospacerow">
                                            <div class="col-sm-6">
                                                <select class="form-control fcap" name="tax_status" tabindex="-1">
                                                <option value="">Tax Status</option>
                                                <option value="1">Exempt</option>
                                                <option value="2">Out of state</option>
                                                <option value="3">Resale</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="form-control fcap" name="cus_tax_id" type="text" placeholder="Tax ID" tabindex="-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary firstblock_bg">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-default collapsed-box firstblock_bg">
                                        <div class="box-header with-border">
                                            <div class="col-md-5">
                                                <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                                            </div>
                                    
                                            <div class="col-md-5">
                                                <div class="checkbox uhead2">
                                                <label><input type="checkbox" name="billaddr" id="billaddr" value="" onclick="fnchkbilladdr()" >Same as billing address</label>
                                            </div>
                                        </div>
                    
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                  
                                    <div class="box-body" style="display:none;" id="billaddress">
                                        <div class="form-horizontal">
                                            <div class="form-group nospacerow">
                                                <div class="col-sm-4">
                                                    <input class="form-control fcap" name="shipcusname" id="shipcusname" type="text" placeholder="Name">
                                                </div>
                                            
                                                <div class="col-sm-4">
                                                    <input class="form-control fcap" name="cus_ship_address1" id="cus_ship_address1" type="text" placeholder="Address1">
                                                </div>
                                            
                                                <div class="col-sm-4">
                                                    <input class="form-control fcap" name="cus_ship_address2" id="cus_ship_address2" type="text" placeholder="Address2">
                                                </div>
                                            </div>
                      
                                            <div class="form-group nospacerow">
                                                <div class="col-sm-4">
                                                    <input class="form-control fcap" name="cus_ship_city" id="ship_city" type="text" placeholder="City" readonly tabindex="-1">
                                                </div>
                                            
                                                <div class="col-sm-4">
                                                    <input class="form-control fcap" name="cus_ship_state" id="ship_state" type="text" placeholder="State" readonly tabindex="-1">
                                                </div>
                                            
                                                <div class="col-sm-4">
                                                    <input class="form-control fcap" name="cus_ship_zip" id="zip_codes" type="text" placeholder="Zip">
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
                
                <div class="col-md-6">
                    <div class="box box-primary firstblock_bg">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="uhead2">Contact Info</p>
                                    <div class="form-horizontal">
                                        <div class="cnt_clone">
                                            <div class="form-group nospacerow">
                                                <div class="col-sm-3">
                                                    <select name="cus_contact_type[]" class="form-control fcap mailevent"   id="cus_contact_type">
                                                        <option>Choose</option>
                                                        <?php
                                                            foreach ($contact as $cont) 
                                                            {
                                                                if($cont['sub_name']=="Home" || $cont['sub_name']=="Office" || $cont['sub_name']=="Mobile")
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
                                                                    <?php  
                                                                } 
                                                            } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-sm-3">
                                                    <input class="form-control fcap contact_no" id="contact_no" name="cus_contact_no[]" type="text"  placeholder="Contact details" autocomplete="off">
                                                </div>
                        
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control cusnote" onchange="applySentenceCase()" name="cus_note[]" id="cus_note" placeholder="Note">
                                                </div>
                    
                                                <div class="col-sm-3">
                                                    <label class="switch">
                                                        <input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"  checked >
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
                    
                    <div class="box box-primary firstblock_bg">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="uhead2">Email Info</p>
                                    <div class="form-horizontal">
                                        <div class="cnt_clone">
                                            <div class="form-group nospacerow">
                                                <div class="col-sm-5">
                                                    <select name="cuscnt_type_email[]" class="form-control fcap mailevent">
                                                        <option>Choose</option>
                                                        <?php
                                                        foreach ($contactEmail as $cont) 
                                                        {
                                                            ?>
                                                            <option value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
                                                            <?php  
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-5">
                                                    <input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text"  placeholder="Email" onchange="ValidateEmail(this)">
                                                </div>

                                                <!--<div class="col-sm-1">
                                                    <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1">Email</a>
                                                </div> -->

                                                <div class="col-sm-2">
                                                    <label class="switch"> 
                                                        <input class="fnchkemailId" type="radio" id="email_radio_click" name="email_radio_click[]" checked> 
                                                        <span class="slider round">
                                                        </span> 
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

                    <div class="box box-primary firstblock_bg">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border mb5">
                                        <p class="uhead2">Type</p>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-horizontal">
                                            <div class="cnt_clone">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <select class="form-control valid" name="apcate[]">
                                                        <option value="">Type Choose</option>
                                                        <?php 
                                                        foreach($ap_cat as $row )
                                                        { ?>
                                                            <option value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
                                                            <?php    
                                                        } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-control valid" name="apsubcate[]">
                                                        <option value="">Sub Type Choose</option>
                                                        <?php 
                                                        foreach($res as $row )
                                                        { ?>
                                                            <option value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
                                                            <?php    
                                                        } ?>
                                                        </select>    
                                                    </div>
                                                    <div class="col-sm-1">
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

                    <div class="box box-primary firstblock_bg">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header with-border mb5">
                                        <p class="uhead2">Type</p>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-horizontal">
                                            <div class="cnt_clone">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <select class="form-control valid" name="aptype[]">
                                                        <option value="">Type Choose</option>
                                                        <?php 
                                                        foreach($resCrews as $row )
                                                        { ?>
                                                            <option value="<?=$row['sub_id']?>"><?=$row['sub_name']?></option>
                                                            <?php    
                                                        } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-5">

                                                    <select class="form-control valid" name="rating[]">
														<option value="">Choose</option>
															<option value="*">*</option>
															<option value="**">**</option>
															<option value="***">***</option>
															<option value="****">****</option>
															<option value="*****">*****</option>
														</select>
                                                            
                                                    </div>

                                                    <div class="col-sm-1">
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
            </div>
        
            <div class="col-md-12 text-center">
                <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
                <button name="Submit" id="Submit" class="btn btn-lg btn-info btn-flat">Save & Continue</button>
                <input type="button" class="btn btn-lg btn-default btn-flat" onclick="fnresetfrm()" value="Cancel">
                <a href="<?=site_url('fi_home/vendor_genral_info/')?>" class ="btn btn-lg btn-default btn-flat">Back</a>
            </div>
        </form>
    </section>
</div>
<div  class="fadeMe" > <div id="loader" class="loader"></div> </div>

<!-- Trigger the modal with a button -->
<button style="display: none;" type="button" id="btnmodal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">General Info Notes</h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="setmodalnotes" cols="" rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="fnclosemodal()" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <!-- /.content-wrapper -->



  <!-- Main Footer -->

  <!-- Modal1 -->

   <div class="modal fade email_modal w80" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">


  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email Form</h4>
      </div>
      <div class="modal-body">


       <div class="box-body">

        <form id="frmsendgeninfomail" name="frmsendgeninfomail" method="post" action="<?=site_url('fi_home/sendnewgeninfoemail')?>" enctype="multipart/form-data">


            <div class="row">
                  <div class="col-xs-2">

                    </div>
                    <div class="col-xs-10">
                    <div class="row">
                  <div class="col-xs-3">
                    <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                          </div>
                   </div>

                     <div class="col-xs-3">
                    <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To BCC</label>
                          </div>
                   </div>

                     <div class="col-xs-3">
                    <label>Max Recipients </label>
                   </div>

                     <div class="col-xs-3">
                     <input type="number" value="50" name="max_rec[]" class="form-control">
                   </div>

                </div>
                    </div>
                </div>


                <hr>


                <div class="row">


                     <div class="col-xs-10">
                     <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>



                        <th >Email Address:</th>
                        <th >Name:</th>
                        <th >Type:</th>

                      </tr>


                      <tr>


                        <td ><input type="text" name="nwcustemail" id="nwcustemail" class="form-control"  value="" required> </td>
                        <td ><input type="text" name="txtlcustname" id="txtlcustname" class="form-control" value=""> </td>
                        <td > <input type="text" name="txtcusttype" id="txtcusttype" class="form-control" value="Customer"></td>

                      </tr>




                    </thead>

                  </table>

                </div>
                   </div>

                </div>

                 <div class="box box-primary mt20">
              <!--<p class="uhead2 pt10">Payment Applied To</p>-->
                        <div class="box-body">

                             <div class="row">
                                         <div class="col-xs-2">
                                             <label>Attachments</label>

                                              <!--  <button type="button" class="btn btn-default btn-xs">Add Attachment</button> -->

                                              <input type="file" name="crewavl[]" id="crewavl" multiple="multiple">

                                         </div>


                                    </div>
                                              <!-- /.box -->

                                      <hr>
                                      <div class="row">
                                         <div class="col-xs-2">
                                             <label>Subject</label>

                                         </div>
                                         <div class="col-xs-10">
                                              <input type="text" name="letteremailsub" id="letteremailsub" class="form-control" value="">
                                         </div>

                                    </div>
                                      <hr>
                                    <div class="row">
                                         <div class="col-xs-2">
                                             <label>Body</label>

                                             <!--   <button type="button" class="btn btn-default btn-xs">Check Spelling</button> -->

                                         </div>
                                         <div class="col-xs-10">
<textarea name="letteremaildesc" id="letteremaildesc" rows="6" class="form-control" spellcheck="true"></textarea>


                                         </div>

                                    </div>


                                    <div class="row">
                                         <div class="col-xs-2">

                                         </div>
                                         <div class="col-xs-10 mt20" >
                                                 <div class="row ">
                                                     <div class="col-xs-5">
                                                         <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancel </button>
                                                     </div>

                           <div class="col-xs-3">
                                 <button class="btn btn-primary sendemail">Send Email</button>
                           </div>

                                                </div>
                                         </div>

                                    </div>





                        </div>
                      </div>

                </form>

              </div>

      </div>

    </div>
  </div>


</div>


  <!-- </div> -->



  <script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript">
$("body").on('click', ".cnt_clone_add", function() {


    var nxtrowchk=$(this).closest('.cnt_clone').next('.cnt_clone').html();
     //alert("nxtrowchk--"+nxtrowchk);
     if(nxtrowchk==undefined)
     {
        var $tr    = $(this).closest('.cnt_clone');
        var $clone = $tr.clone();

        $clone.find(':text').val('');
        $clone.find(':radio').prop( "checked", false );
        //$clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()
        //$clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
        $(this).removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
        $tr.after($clone);


        //$tr.before($clone);
    }else{

        var $tr    = $(this).closest('.cnt_clone').next('.cnt_clone');
        var $clone = $tr.clone();

        $clone.find(':text').val('');
        $clone.find(':radio').prop( "checked", false );
        //$clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()
        //$clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
         $(this).removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
        $tr.after($clone);
    }
});

$(document).on('click', '.cnt_clone_remove', function(){
    var $tr    = $(this).closest('.cnt_clone');
    var $clone = $tr.remove();
});
</script>



  <script type="text/javascript">
    $('#cus_zip').on('change',function(){
      var zip = $("#cus_zip").val();
      if(zip)
      {
          $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/find_city/')?>",
            data: {zip : zip},
            dataType:"json",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
                //alert("data--"+data);
                 if(data!="")
                  {
                     var appendata = data.custaddrinfo;
                     //alert("appendata--"+appendata);

                    if(appendata!="")
                     {

                         $.each(appendata,function(appendata,item)
                         {//alert("City--"+item.City);

                           $("#city").val(item.City);
                           $("#state").val(item.State);

                           //$('#contact_no').focus();
                           $('#cus_contact_type').focus();


                         });

                        $('.fadeMe').hide();
                     }else{

                        $("#city").val('');
                        $("#state").val('');
                        $('.fadeMe').hide();
                        alert("Zip code is invalid..!");
                         $('#cus_zip').focus();
                     }

                  }else{

                        $("#city").val('');
                        $("#state").val('');
                     }

              }
          });

      }else{
        $("#city").val('');
        $("#state").val('');
      }

    });
</script>


  <script type="text/javascript">
   // $('#zip').on('change',function(){
  $('body').on('change','#zip, .zip',function(){

      //var zip = $("#zip").val();
      var temp_zip =  $(this).parents(".tr_clone").find(".zip");
      var temp_adcity =  $(this).parents(".tr_clone").find(".adcity");
      var temp_adstate =  $(this).parents(".tr_clone").find(".adstate");
      var zip= temp_zip.val();
      //alert("zip---"+zip);
      if(zip)
      {
          $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/find_city/')?>",
            data: {zip : zip},
            dataType:"json",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
               //alert("data--"+data);
                 if(data!="")
                  {
                     var appendata = data.custaddrinfo;
                   // alert("appendata--"+appendata);

                    if(appendata!="")
                     {

                         $.each(appendata,function(appendata,item)
                         {//alert("City--"+item.City);

                           $(temp_adcity).val(item.City);
                           $(temp_adstate).val(item.State);


                         });

                        $('.fadeMe').hide();
                     }else{

                        $(temp_adcity).val('');
                        $(temp_adstate).val('');
                        $('.fadeMe').hide();
                        alert("Zip code is invalid..!");
                         $(temp_zip).focus();
                     }

                  }else{

                        $(temp_adcity).val('');
                        $(temp_adstate).val('');
                     }

              }
          });

      }

    });
</script>


<script type="text/javascript">
  function applySentenceCase() {

    var str = $('#cus_note').val();

    if(str.length>35)
    {
         var newStr = str.split('.').map(function(el) {
          el = el.trim();
          return el.substr(0, 1).toUpperCase() + el.substr(1);
         }).join('. ');

        //alert(newStr.trim());
         $('#cus_note').val(newStr.trim());

         $('#btnmodal').trigger('click');

         $('#setmodalnotes').html(newStr.trim());

    }else{

      var newStr = str.split('.').map(function(el) {
          el = el.trim();
          return el.substr(0, 1).toUpperCase() + el.substr(1);
         }).join('. ');

        //alert(newStr.trim());
         $('#cus_note').val(newStr.trim());

    }


}
</script>

<script type="text/javascript">

 function fnclosemodal()
  {
      var settonotes= $('#setmodalnotes').val();
      //alert("settonotes--"+settonotes);

      var newStrdata = settonotes.split('.').map(function(el) {
          el = el.trim();
          return el.substr(0, 1).toUpperCase() + el.substr(1);
         }).join('. ');

      //alert(newStrdata.trim());
      $('#cus_note').val(newStrdata.trim());
  }

</script>


 <script type="text/javascript">
    $('#zip_codes').on('change',function(){
      var zip = $("#zip_codes").val();
      var cus_ship_address1=  $("#cus_ship_address1").val();
      var cus_ship_address2= $("#cus_ship_address2").val();

      if(zip)
      {
          $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/find_city/')?>",
            data: {zip : zip},
            dataType:"json",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
                //alert("data--"+data);
                 if(data!="")
                  {
                     var appendata = data.custaddrinfo;
                     //alert("appendata--"+appendata);


                     if(appendata!="")
                     {

                        $.each(appendata,function(appendata,item)
                         {//alert("City--"+item.City);

                           $("#ship_city").val(item.City);
                           $("#ship_state").val(item.State);

                         });

                          if(cus_ship_address1!="" || cus_ship_address2!="")
                               {
                                   $("#cus_ship_address1").val(cus_ship_address1);
                                   $("#cus_ship_address2").val(cus_ship_address2);
                               }else{
                                   $("#cus_ship_address1").val('');
                                   $("#cus_ship_address2").val('');
                               }


                        $('.fadeMe').hide();
                     }else{

                          $("#ship_city").val('');
                          $("#ship_state").val('');

                           if(cus_ship_address1!="" || cus_ship_address2!="")
                               {
                                   $("#cus_ship_address1").val(cus_ship_address1);
                                   $("#cus_ship_address2").val(cus_ship_address2);
                               }else{
                                   $("#cus_ship_address1").val('');
                                   $("#cus_ship_address2").val('');
                               }

                          $('.fadeMe').hide();
                          alert("Zip code is invalid..!");
                       }

                   }else{

                        $("#ship_city").val('');
                        $("#ship_state").val('');
                        $("#cus_ship_address1").val('');
                        $("#cus_ship_address2").val('');
                     }

              }
          });

      }

    });
</script>


<script type="text/javascript">
 function fnresetfrm()
  {
     var r = confirm("Are you sure want to Clear all Data..??");
     if(r == true)
       {
           $('#pform')[0].reset();
       }
  }

</script>


   <!--  accept numbers  only -->
<script type="text/javascript">

  $('#cus_zip,#zip_codes,#zip').keydown(function(event) {
                     if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 )
                     {

                     }
                    else
                    {

                       if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ))
                       {
                       event.preventDefault();

                       }
                   }
                });
</script>
<!--  End accept numbers  only -->



<script type="text/javascript">

function fnchkbilladdr()
{

	if($('#billaddr').prop("checked") == true){
             $('#billaddress').slideDown();
             var getzip= $('#cus_zip').val();
             var getcity= $('#city').val();
             var getstate= $('#state').val();
             var getaddr1= $('#cus_address1').val();
             var getaddr2= $('#cus_address2').val();
             var cus_fname= $('#cus_fname').val();

             $('#zip_codes').val(getzip);
             $('#ship_city').val(getcity);
             $('#ship_state').val(getstate);
             $('#cus_ship_address1').val(getaddr1);
             $('#cus_ship_address2').val(getaddr2);
             $('#billaddr').val("1");
             $('#shipcusname').val(cus_fname);


        }
        else if($('#billaddr').prop("checked") == false){
             $('#billaddress').slideUp();
             $('#zip_codes').val("");
             $('#ship_city').val("");
             $('#ship_state').val("");
             $('#cus_ship_address1').val("");
             $('#cus_ship_address2').val("");
             $('#billaddr').val("0");
             $('#shipcusname').val("");

        }

}

</script>

<!-- <script type="text/javascript">

function fnchkdefphone()
{
     var chksts= $('input[name=radio_click]:checked') ? true : false;
     //alert("chksts--"+chksts);
	  if(chksts == true){

            alert("You have successfully changed default number..!");
        }

}

</script> -->

<script type="text/javascript">

$(document).ready(function(){

	$('body').on("click", ".fnchkphoneno", function(){


		//var chksts= $(this).attr("checked");
     if($(this).is(":checked")){

            alert("Do you want to make it as a default");
        }

	});

});

</script>


<script type="text/javascript">

$(document).ready(function(){

  $('body').on("click", ".fnchkemailId", function(){


    //var chksts= $(this).attr("checked");
     if($(this).is(":checked")){

            alert("Do you want to make it as a default");
        }

  });

});

</script>


<script type="text/javascript">
  //jQuery.noConflict();
$(document).ready(function($) {//alert("ready");
  $('body').on('keyup','.fcap', function(event) { //alert("fcap");
    var textBox = event.target;
    var start = textBox.selectionStart;
    var end = textBox.selectionEnd;
    textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
    textBox.setSelectionRange(start, end);
  });
});
</script>

<script type="text/javascript">
 $(document).ready(function($) {
  $('body').on('click','.fnpostemail', function(event) {

     $('#nwcustemail').val("");
     var txtemail =  $(this).parents(".cnt_clone").find(".txtemail").val();

     //alert("txtemail--"+txtemail);
      if(txtemail==undefined)
      {
        $('#nwcustemail').val("");
      }else{

        $('#nwcustemail').val(txtemail);
      }


  });
});
</script>




<!-- <script type="text/javascript">

	 $(document).ready(function()
           {
           	  //alert("appendata");
           	  	$("body").on("change", ".mailevent", function(){
           	  		var txt = $(this).val();
           	  		 //alert(txt);
					 if(txt == "Email")
					 {

                  $(this).attr('name', "cuscnt_type_email[]");

           	  		 $(this).parents('.form-group').find('.col-sm-3:nth-child(2)').html('<input class="form-control" id="txtemail" name="txtemail[]" type="text"  placeholder="Email">');

           	  		 $(this).parents('.form-group').find('.col-sm-3:nth-child(3)').html('<a href="" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal1">Email</a>');

           	  		 //$(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('');

                  // if($(this).parents(".form-horizontal .cnt_clone:last-child")){
                    if($(this).parents(".cnt_clone").is(':last-child')){

                      $(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('<label class="switch"> <input class="fnchkemailId" checked type="radio" id="email_radio_click" name="email_radio_click[]" > <span class="slider round"></span> </label><a class="btn btn-xs btn-success cnt_clone_add  btnrmove"><i class="fa fa-plus"></i></a>');

                   }else{   $(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('<label class="switch"> <input class="fnchkemailId" type="radio" id="email_radio_click" name="email_radio_click[]"> <span class="slider round"></span> </label><a class="btn btn-xs btn-danger cnt_clone_remove  btnrmove"><i class="fa fa-minus"></i></a>'); }


					 }else

					 {

                 $(this).attr('name', "cus_contact_type[]");


           	  		 $(this).parents('.form-group').find('.col-sm-3:nth-child(2)').html('<input class="form-control fcap contact_no" id="contact_no" name="cus_contact_no[]" type="text" placeholder="Contact details">');

           	  		 $(this).parents('.form-group').find('.col-sm-3:nth-child(3)').html('<input type="text" class="form-control" onchange="applySentenceCase()" name="cus_note[]" id="cus_note" placeholder="Note">');

           	  		// $(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('');

           	  		  $(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('<label class="switch"> <input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"><span class="slider round"></span> </label> <a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>');

                     if($(this).parents(".cnt_clone").is(':last-child')){

                      $(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('<label class="switch"> <input checked class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"><span class="slider round"></span> </label> <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>');

                   }else{  $(this).parents('.form-group').find('.col-sm-3:nth-child(4)').html('<label class="switch"> <input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]"> <span class="slider round"></span> </label> <a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>'); }
					 }

           	  	});


           });

</script> -->




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script type="text/javascript">

          $(document).ready(function($)

          {

            // alert("Hiii");

              // $('#contact_no').mask('(000) 000-0000');

            //   $('body .contact_no').mask('(000) 000-0000');

			$('body ').on("keypress", ".contact_no", function(){ $(this).mask('(000) 000-0000'); } );





            $(".str").keypress(function(event)

            {

              var inputValue = event.which;

              // allow letters and whitespaces only.

              if(!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0))

              {

                  event.preventDefault();

              }

            });



            $(".num").keypress(function (e)

            {

              if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))

              {

                  return false;

              }

            });

        });

    </script>



    <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->

    <script src="<?php echo base_url('assets/');?>js/jquery.validate.js"></script>

   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



<script>



$(document).ready(function ($) {


   $("#pform").validate({

           rules: {

                    cus_lname: {

                    require_from_group: [1, ".group"]

                    },

                    cus_com: {

                    require_from_group: [1, ".group"]

                    }

                   // title:{required: true},

                   // cus_fname:{required: true},

                   // cus_lname:{required: true},

                   // cus_com:{required: true}

                   // cus_zip:{required: true}



                   // acquiredBy:{required: true}

       },

       highlight: function (element) {

           $(element).closest('.frm_testimonials').removeClass('success').addClass('error');

       },



       messages: {

                   // title:{required: "Please Select Title"},

                   // cus_fname:{required: "Please Enter First Name"},

                   cus_lname:{required: "Please Enter Last Name"},

                   cus_com:{required: "Please Enter Company name"}

                   // cus_zip:{required: "Please Enter Zip Code"}





                   // acquiredBy:{required:"Please select Acquired By."}



       },



   });

});



</script>



<script type="text/javascript">
  //ERP tr added
    var cnt = 2

    $(".tr_clone_add").on('click', function(rrr) { rrr.preventDefault();
      //alert(111);
    var tr    = $(this).closest('.tr_clone');

    var clone = tr.clone();

    clone.find(':text').val('');
 /*   clone.find('input[type=date]').val('');
    clone.find('input[type=time]').val('');
*/
   //clone.find('td:first-child').text(cnt);

    clone.find('.tr_clone_add').siblings('.tr_save_btn').remove();

   clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

   //tr.before(clone);
   tr.after(clone);

  //tr.parent("thead").append(clone);

  cnt++;

});



$(document).on('click', '.tr_clone_remove', function(){
   var tr    = $(this).closest('.tr_clone');

  $(this).closest('table').addClass("currenttable");
  var alltr = $(this).parents("table.currenttable").find('tr');
  var len = alltr.length - 1;
  var clone = tr.remove();
  if(cnt>0)
  {
  cnt--;


  }

});

</script>


<script type="text/javascript">
$(document).ready(function()
  {
$('body').on('change','.cusnote',function()
  {///alert("1");
     var nxtrowchk=$(this).closest('.cnt_clone').next('.cnt_clone').html();
     //alert("nxtrowchk======="+nxtrowchk);
     if(nxtrowchk==undefined)
     {//alert("ifff");
          var $tr    = $(this).closest('.cnt_clone');
          var $clone = $tr.clone();

          $clone.find(':text').val('');
          $clone.find(':radio').prop( "checked", false );
          $clone.find(':checkbox').prop( "checked", false );
          //clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()
          //$clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
          $(this).parents('.cnt_clone').find('.btn-success.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
         $tr.after($clone);
     }
 });
});
</script>

<script type="text/javascript">
$(document).ready(function()
  {
$('body').on('change','.mailevent',function()
  {//alert("1");

     $(this).closest('.cnt_clone').find('.contact_no').focus();

 });
});
</script>

<script type="text/javascript">
function fnshowcnt()
  {//alert("1");
      $('.additionalcnt').show();
     //$('.additionalcnt').css('display','block');
  }

</script>

<script type="text/javascript">
$(document).ready(function()
  {
$('body').on('change','.txtemail',function()
  {///alert("1");
     var nxtrowchk=$(this).closest('.cnt_clone').next('.cnt_clone').html();
     //alert("nxtrowchk--"+nxtrowchk);
     if(nxtrowchk==undefined)
     {
          var $tr    = $(this).closest('.cnt_clone');
          var $clone = $tr.clone();

          $clone.find(':text').val('');
          $clone.find(':radio').prop( "checked", false );
          $clone.find(':checkbox').prop( "checked", false );
          //$clone.find('.cnt_clone_add').siblings('.tr_save_btn').remove()
          //$clone.find('.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
         $(this).parents('.cnt_clone').find('.btn-success.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
         $tr.after($clone);
     }
 });
});
</script>

<script type="text/javascript">
$(document).ready(function()
  {
    $('#title').focus();
  });
</script>

<script type="text/javascript">
$(function() {
    $('#cus_fname,#cus_lname').keydown(function(e) {
      if (e.shiftKey || e.ctrlKey || e.altKey) {
        e.preventDefault();
      } else {
        var key = e.keyCode;
        if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
          e.preventDefault();
        }
      }
    });
});
</script>

<script type="text/javascript">
function ValidateEmail(inputText)
{
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if(inputText.value.match(mailformat))
  {
   //document.form1.text1.focus();
    return true;
  }
  else
  {
    alert("You have entered an invalid email address!");
    inputText.focus();
    return false;
  }
}

</script>


<script type="text/javascript">
$(document).ready(function(){
$("body").on('click','#Save',function(){//alert("call..!");

        var pckId= localStorage.getItem("pckId");
        //alert("Exists localStorage pckId--"+pckId);
        if(pckId!=null || pckId!="")
        {//alert("TT");
           localStorage.clear();
          // alert("1");
        }

});
});
</script>
<script type="text/javascript">
    $(document).on('keydown', function(event) 
    {
        if (event.key == "Escape") 
        {
            window.location.href = "<?=base_url("/fi_home")?>";
        }
    });
</script>