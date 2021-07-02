                <?php $this->load->view('fi/vendor/select_vendor'); ?>
            </div>
            <form action="<?=site_url('Vendor/updateVendor')?>" method="POST" name="pform" id="pform" onsubmit="return validateForm()">
                <div id="addform"> 
                    
                    <!-- Static Display -->
                    <div class="col-md-6" bis_skin_checked="1">
                        <div class="box box-primary firstblock_bg" bis_skin_checked="1">
                            <div class="box-body" bis_skin_checked="1">
                                <div class="row" bis_skin_checked="1">
                                    <div class="col-md-12" bis_skin_checked="1">
                                        <div class="box-header with-border mb5" bis_skin_checked="1">
                                            <p class="uhead2">Name</p>
                                        </div>
                                        <input type="hidden" name="cus_id" value="5">
                                        <div class="form-horizontal" bis_skin_checked="1">
                                            <div class="form-group nospacerow" bis_skin_checked="1">
                                                <div class="col-sm-2" bis_skin_checked="1">
                                                    <select class="form-control fcap" name="title" id="title" autofocus="">
                                                        <option value="">Prefix</option>
                                                        <option selected="" value="Dr">Dr.</option>
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                        <option value="Ms">Ms.</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_fname" id="cus_fname" style="text-transform: uppercase;" type="text" placeholder="First Name">
                                                </div>
                                                <div class="col-sm-5" bis_skin_checked="1">
                                                    <input class="form-control fcap group" name="cus_lname" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">
                                                </div>
                                            </div>                                 
                                    
                                            <div class="form-group nospacerow" bis_skin_checked="1">
                                                <div class="col-sm-12" bis_skin_checked="1">
                                                    <input class="form-control fcap group" name="cus_com" id="cus_com" type="text" placeholder="Company">
                                                </div>
                                            </div>
                                    
                                            <div class="form-group nospacerow" bis_skin_checked="1">
                                                <div class="col-sm-12" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_address1" id="cus_address1" type="text" placeholder="Address1">
                                                </div>
                                            </div>

                                            <div class="form-group nospacerow" bis_skin_checked="1">
                                                <div class="col-sm-12" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_address2" type="text" placeholder="Address2">
                                                </div>
                                            </div>

                                            <div class="form-group nospacerow" bis_skin_checked="1">
                                                <div class="col-sm-7" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_city" id="city" type="text" placeholder="City" readonly="" tabindex="-1">
                                                </div>
                                                <div class="col-sm-3" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_state" id="state" type="text" placeholder="State" readonly="" tabindex="-1">
                                                </div>
                                                <div class="col-sm-2" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_zip" id="cus_zip" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">
                                                </div>
                                            </div>
                                   
                                            <div class="form-group nospacerow" bis_skin_checked="1">
                                                <div class="col-sm-6" bis_skin_checked="1">
                                                    <select class="form-control fcap" name="tax_status" tabindex="-1">
                                                        <option value="">Tax Status</option>
                                                        <option value="1">Exempt</option>
                                                        <option value="2">Out of state</option>
                                                        <option value="3">Resale</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6" bis_skin_checked="1">
                                                    <input class="form-control fcap" name="cus_tax_id" value="" type="text" placeholder="Tax ID" tabindex="-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="box box-default firstblock_bg " bis_skin_checked="1">
                            <div class="box-header with-border" bis_skin_checked="1">
                                <div class="col-md-5" bis_skin_checked="1">
                                    <p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
                                </div>
                                <div class="col-md-5" bis_skin_checked="1">
                                    <div class="checkbox uhead2" bis_skin_checked="1">
                                                                <label>
                                        <input type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()">Same as billing address
                                    </label>
                                </div>
                            </div>
                            <div class="box-tools pull-right" bis_skin_checked="1">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>  </button>
                            </div>
                        </div>
                
                        <div class="box-body" id="billaddress" bis_skin_checked="1">
                            <div class="form-horizontal" bis_skin_checked="1">
                                <div class="form-group nospacerow" bis_skin_checked="1">
                                    <div class="col-sm-4" bis_skin_checked="1">
                                        <input class="form-control fcap" name="shipcusname" id="shipcusname" type="text" placeholder="Name" value="">
                                    </div>
                                    <div class="col-sm-4" bis_skin_checked="1">
                                        <input class="form-control fcap" name="cus_ship_address1" value="" type="text" placeholder="Address1">
                                    </div>
                                    <div class="col-sm-4" bis_skin_checked="1">
                                        <input class="form-control fcap" name="cus_ship_address2" value="" type="text" placeholder="Address2">
                                    </div>
                                </div>
                                <div class="form-group nospacerow" bis_skin_checked="1">
                                    <div class="col-sm-4" bis_skin_checked="1">
                                        <input class="form-control fcap text-center" name="cus_ship_city" value="" id="ship_city" type="text" placeholder="City" readonly="" tabindex="-1">
                                    </div>
                                    <div class="col-sm-4" bis_skin_checked="1">
                                        <input class="form-control fcap text-center" name="cus_ship_state" value="" id="ship_state" type="text" placeholder="State" readonly="" tabindex="-1">
                                    </div>
                                    <div class="col-sm-4" bis_skin_checked="1">
                                        <input class="form-control fcap text-center" name="cus_ship_zip" value="" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" bis_skin_checked="1">
                    <div class="box box-primary firstblock_bg " bis_skin_checked="1">
                        <div class="box-body" bis_skin_checked="1">
                            <div class="row space3" bis_skin_checked="1">
                                <div class="col-md-12" bis_skin_checked="1">
                                    <div class="box-header with-border mb5" bis_skin_checked="1">
                                        <p class="uhead2 2">Contact Info</p>
                                    </div>                      
                                    <div class="form-horizontal" bis_skin_checked="1">
                                            <div class="cnt_clone" bis_skin_checked="1">
                                            <div class="form-group" bis_skin_checked="1">
                                                <div class="col-sm-3" bis_skin_checked="1">
                                                    <select name="cus_contact_type[]" class="form-control fcap mailevent" id="cus_contact_type">
                                                        <option>Choose</option>
                                                        <option value="Home">Home</option>
                                                        <option value="Office">Office</option>
                                                        <option selected="" value="Mobile">Mobile</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3" bis_skin_checked="1">
                                                    <input class="form-control fcap contact_no" id="contact_no" value="" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">
                                                </div>

                                                <div class="col-sm-3" bis_skin_checked="1">
                                                    <input type="text" class="form-control fcap cusnote" value="" name="cus_note[]" placeholder="Note">
                                                </div>

                                                <div class="col-sm-3" bis_skin_checked="1">
                                                    <label class="switch">
                                                        <input class="fnchkphoneno" type="checkbox" name="radio_click[]" checked="" value="on">
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
            <div class="box box-primary firstblock_bg " bis_skin_checked="1">
                <div class="box-body" bis_skin_checked="1">
                    <div class="row space3" bis_skin_checked="1">
                        <div class="col-md-12" bis_skin_checked="1">
                            <div class="box-header with-border mb5" bis_skin_checked="1">
                                <p class="uhead2">Email Info</p>
                            </div>
                            <!-- <p class="uhead2">Email Info</p> -->
                            <div class="form-horizontal" bis_skin_checked="1">
                                                                    <div class="cnt_clone" bis_skin_checked="1">
                                        <div class="form-group" bis_skin_checked="1">
                                            <div class="col-sm-3" bis_skin_checked="1">
                                                <select name="cuscnt_type_email[]" class="form-control fcap mailevent">
                                                <option>   </option>
                                                                                              </select>
                                         </div>
                                             <div class="col-sm-3" bis_skin_checked="1">
                                                 <input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="" onchange="ValidateEmail(this)">
                                             </div>
                                             <div class="col-sm-3" bis_skin_checked="1">
                                                 <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>
                                             </div>
                                             <div class="col-sm-3" bis_skin_checked="1">
                                                 <label class="switch">
                                                    <input class="fnchkemailId" type="checkbox" name="email_radio_click[]" checked="" value="on">
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
            <div class="box box-primary firstblock_bg " bis_skin_checked="1">
                <div class="box-body" bis_skin_checked="1">
                    <div class="row space3" bis_skin_checked="1">
                        <div class="col-md-12" bis_skin_checked="1">
                            <div class="box-header with-border mb5" bis_skin_checked="1">
                                <p class="uhead2">AP Category</p>
                            </div>
                            <div class="box-body" bis_skin_checked="1">
                                <div class="form-horizontal" bis_skin_checked="1">
                                    <div class="cnt_clone" bis_skin_checked="1">
                                        <div class="form-group" bis_skin_checked="1">
                                            <div class="col-sm-6" bis_skin_checked="1">
                                                <select class="form-control valid" name="apcateupdate[]">
                                                    <option value="">Choose</option>
                                                    <option value="Automobile">Automobile</option>
                                                    <option value="Banking">Banking</option>
                                                    <option value="Charity">Charity</option>
                                                                                                        <option value="Commission">Commission</option>
                                                                                                        <option value="Communications">Communications</option>
                                                                                                        <option value="Event Personnel">Event Personnel</option>
                                                                                                        <option value="Recreation &amp; Travel">Recreation &amp; Travel</option>
                                                                                                        <option value="General Expenses">General Expenses</option>
                                                                                                        <option value="Supplies">Supplies</option>
                                                                                                        <option value="Taxes">Taxes</option>
                                                                                                        <option value="1099 Sub Contractor">1099 Sub Contractor</option>
                                                                                                     
                                                </select>
                                            </div>
                                            <div class="col-sm-5" bis_skin_checked="1">
                                                <select class="form-control valid" name="apsubcateupdate[]">
                                                    <option value="">Choose</option>
                                                                                                        <option value="A\V Technician">A\V Technician</option>
                                                                                                        <option value="Lady Photographer">Lady Photographer</option>
                                                                                                        <option value="Photographer">Photographer</option>
                                                                                                        <option value="Videographer">Videographer</option>
                                                                                                        <option value="Assistant">Assistant</option>
                                                                                                    </select>
                                            </div>

                                            <div class="col-sm-1" style="" bis_skin_checked="1">
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
            <div class="box box-primary firstblock_bg " bis_skin_checked="1">
                <div class="box-body" bis_skin_checked="1">
                    <div class="row space3" bis_skin_checked="1">
                        <div class="col-md-12" bis_skin_checked="1">
                            <div class="box-header with-border mb5" bis_skin_checked="1">
                                <p class="uhead2">Type</p>
                            </div>
                            <div class="box-body" bis_skin_checked="1">
                                <div class="form-horizontal" bis_skin_checked="1">
                                    <div class="cnt_clone" bis_skin_checked="1">
                                        <div class="form-group" bis_skin_checked="1">
                                            <div class="col-sm-6" bis_skin_checked="1">
                                                <select class="form-control valid" name="aptype[]">
                                                <option value="">Type Choose</option>
                                                <option value="A\V Technician">A\V Technician</option>
                                                <option value="Lady Photographer">Lady Photographer</option>
                                                <option value="Photographer">Photographer</option>
                                                <option value="Videographer">Videographer</option>
                                                <option value="Assistant">Assistant</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-5" bis_skin_checked="1">
                                                <select class="form-control valid" name="rating[]">
                                                    <option value="">Rating Choose</option>
                                                    <option value="*">*</option>
                                                    <option value="**">**</option>
                                                    <option value="***">***</option>
                                                    <option value="****">****</option>
                                                    <option value="*****">*****</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1" style="" bis_skin_checked="1">
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
</form>
</section>
</div>
    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>
        <div class="modal fade email_modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Email Form</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="box-body">
                            <form id="frmsendgeninfomail" name="frmsendgeninfomail" method="post" action="<?=site_url('fi_home/sendgeninfoemail')?>" enctype="multipart/form-data">
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

                                              <!--  <button type="button" class="btn btn-default btn-xs">Check Spelling</button> -->

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


<div id="divchkresponce"></div>





  <!-- </div> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $("body").on('click', ".cnt_clone_add", function() 
        {
            var nxtrowchk = $(this).closest('.cnt_clone').next('.cnt_clone').html();
            var thiss = $(this);
            if(nxtrowchk == undefined)
            {
                var $tr    = $(this).closest('.cnt_clone');
                var $clone = $tr.clone();

                $clone.find(':text').val('');
                $clone.find(':radio').prop( "checked", false );
                $clone.find(':checkbox').prop( "checked", false );
                $tr.after($clone);
                $(thiss).removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
            }
            else
            {
                var $tr    = $(this).closest('.cnt_clone').next('.cnt_clone');
                var $clone = $tr.clone();

                $clone.find(':text').val('');
                $clone.find(':radio').prop( "checked", false );
                $clone.find(':checkbox').prop( "checked", false );
                
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

$(document).ready(function(){

  $('body').on("click", ".fnchkphoneno", function(){


    //var chksts= $(this).attr("checked");

    var chktyp= $(this).attr('type');

    if(chktyp=="text")
     {//alert("else if text");
       alert("Do you want to make it as a default");

       $('.fnchkphoneno').removeAttr('checked');
       $('.fnchkphoneno').val('off');
       $('.fnchkphoneno').attr('type','text');
       $(this).parents('.cnt_clone').find('.fnchkphoneno').attr("checked", "checked");
       $(this).parents('.cnt_clone').find('.fnchkphoneno').val('on');
       $(this).parents('.cnt_clone').find('.fnchkphoneno').attr('type','checkbox');
     }else if(chktyp=="checkbox")
     {
         if($(this).is(":checked")){

            alert("Do you want to make it as a default");

               $('.fnchkphoneno').removeAttr('checked');
               $('.fnchkphoneno').val('off');
               $('.fnchkphoneno').attr('type','text');
               $(this).parents('.cnt_clone').find('.fnchkphoneno').attr("checked", "checked");
               $(this).parents('.cnt_clone').find('.fnchkphoneno').val('on');
               $(this).parents('.cnt_clone').find('.fnchkphoneno').attr('type','checkbox');


        }

     }



  });

});

</script>


<script type="text/javascript">

$(document).ready(function(){

  $('body').on("click", ".fnchkemailId", function(){


    var chktyp= $(this).attr('type');

    if(chktyp=="text")
     {//alert("else if text");
         alert("Do you want to make it as a default");

       $('.fnchkemailId').removeAttr('checked');
       $('.fnchkemailId').val('off');
       $('.fnchkemailId').attr('type','text');
       $(this).parents('.cnt_clone').find('.fnchkemailId').attr("checked", "checked");
       $(this).parents('.cnt_clone').find('.fnchkemailId').val('on');
       $(this).parents('.cnt_clone').find('.fnchkemailId').attr('type','checkbox');
     }else if(chktyp=="checkbox")
     {
         if($(this).is(":checked")){

             alert("Do you want to make it as a default");

               $('.fnchkemailId').removeAttr('checked');
               $('.fnchkemailId').val('off');
               $('.fnchkemailId').attr('type','text');
               $(this).parents('.cnt_clone').find('.fnchkemailId').attr("checked", "checked");
               $(this).parents('.cnt_clone').find('.fnchkemailId').val('on');
               $(this).parents('.cnt_clone').find('.fnchkemailId').attr('type','checkbox');


        }

     }





  });

});

</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<script type="text/javascript">

    //$('#cus_zip').on('change',function(){alert("dsfdg");
   function loadcityzip(zip)
    {
      //var zip = $("#cus_zip").val();
      //alert("zip--"+zip);
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

    }
</script>


<script type="text/javascript">
   // $('#zip_codes').on('change',function(){
  function loadstatecity(zip)
    {
    //  var zip = $("#zip_codes").val();
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

                        $('.fadeMe').hide();
                     }else{

                          $("#ship_city").val('');
                          $("#ship_state").val('');
                          $('.fadeMe').hide();
                          alert("Zip code is invalid..!");
                       }

                   }else{

                        $("#ship_city").val('');
                        $("#ship_state").val('');
                     }

              }
          });

      }

    }
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


   <!--  accept numbers  only -->
<script type="text/javascript">

 //$('#cus_zip,#zip_codes').keydown(function(event) {
  function fnOnlyNUmbers()
  {
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
    }
</script>
<!--  End accept numbers  only -->




<script type="text/javascript">
 function fnresetfrm()
  {
     var r = confirm("Are you sure want to Clear all Data..??");

     if(r == true)
       {//alert("T");
           $('#pform')[0].reset();
           //document.getElementById("pform").reset();
       }
  }

</script>



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
            // $('#billaddress').slideUp();
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
        function loadlist()
        {
            var name = $('#searc').val();
            sessionStorage.setItem("vendorId", name);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/getVenderInfo'); ?>",
                data: {name : name},
                dataType: 'html',
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                    var pckId=name;
                    localStorage.setItem("pckId", pckId);
                },
                success: function(data)
                {
                    if(data!="")
                    {
                        $('#addform').html(data);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('Fi_home/getSearchVendsContactInfo'); ?>",
                            data: {name : name},
                            dataType: 'html',
                            beforeSend: function() 
                            {

                            },
                            success: function(data)
                            {
                                if(data!="")
                                {
                                    $('.loaduppertabcntdtls').html(data);
                                }
                                else
                                {
                                    $('.loaduppertabcntdtls').html(data);
                                }
                            }
                        });
                        $('.fadeMe').hide();
                    }
                    else
                    {
                        $('.fadeMe').hide();
                        $('#addform').html(data);
                    }
                }
            });
            deletevendor(name);
        }
    </script>


<script type="text/javascript">


    $(document).ready(function()
    {  
        var pckId= <?=$vendorId?>;
        if(pckId=="null" || pckId=="")
        {
            var name = $('#cust_nm').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/getVenderInfo'); ?>",
                data: {name : name},
                dataType: 'html',
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                },
                success: function(data)
                {
                    if(data!="")
                    {
                        $('#addform').html(data);
                        $('.fadeMe').hide();
                        $('#title').focus();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('Fi_home/getVendContactInfo'); ?>",
                            data: {name : name},
                            dataType: 'html',
                            beforeSend: function() 
                            {
                                
                            },
                            success: function(data)
                            {
                                if(data!="")
                                {
                                    $('.loaduppertabcntdtls').html(data);
                                }   
                                else
                                {
                                    $('.loaduppertabcntdtls').html(data);
                                }
                            }
                        });
                    }
                    else
                    {
                        $('.fadeMe').hide();
                        $('#addform').html(data);
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getCustContactInfo'); ?>",
                data: {name : name},
                dataType: 'html',
                success: function(data)
                {
                    if(data!="")
                    {
                        $('#uppertab').html(data);
                    }
                    else
                    {
                        $('#uppertab').html(data);
                    }
                }
            });
        }
        else
        {
             //alert(222);
           var name= pckId;
           // alert("else_id"+name);
              $.ajax({
              type: "POST",
              url: "<?php echo base_url('Vendor/getVenderInfo'); ?>",
              data: {name : name},
              dataType: 'html',
               beforeSend: function() {
                    // setting a timeout
                    $('.fadeMe').show();

                },
              success: function(data)
              {
                // alert(data);
                if(data!="")
                {

                 $('#addform').html(data);
                 $('.fadeMe').hide();
                //localStorage.clear();

                $('#title').focus();


               }else{

                 $('.fadeMe').hide();
                 $('#addform').html(data);
                 //localStorage.clear();


               }

              }

            });

                $.ajax({
                type: "POST",
                url: "<?php echo base_url('Fi_home/getVendContactInfo'); ?>",
                data: {name : name},
                dataType: 'html',
                success: function(data)
                {
                  // alert(data);
                  if(data!="")
                  {
                    $('#uppertab').html(data);
                    //localStorage.clear();

                 }else{
                    $('#uppertab').html(data);
                   // localStorage.clear();

                 }

                }

              });


              $.ajax({
              type: "POST",
              url: "<?php echo base_url('Fi_home/getSearchCustContactInfo'); ?>",
              data: {name : name},
              dataType: 'html',
              beforeSend: function() {
                //alert("name===="+name);
              },
              success: function(data)
              {//alert(data);
                if(data!="")
                {
                   $('.loaduppertabcntdtls').html(data);
                }else{
                   $('.loaduppertabcntdtls').html(data);
                }
              }
          });

      }

        
    });
</script>

<script type="text/javascript">

  function loadcustlistbyphone(txtphonenum)
    {
        // alert("txtphonenum--"+txtphonenum);
         $.ajax({
         type: "POST",
         url: "<?php echo base_url('Fi_home/fnloadvendlistbyphone'); ?>",
         data: {txtphonenum : txtphonenum},
         dataType: 'html',
          beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
         success: function(data)
          {
            //alert(data);
             if(data!="")
              {
                $('#addform').html();

                $('.fadeMe').hide();
              }

          },
         complete: function(data) {

            $('.fadeMe').hide();
            //$('#pform')[0].reset();

          }

        });
    }
</script>

<script type="text/javascript">
  function fndeletecust()
  {
     var cus_id= $('#cust_nm').val();
     //alert("cus_id--"+cus_id);

       //event.preventDefault();
       var r = confirm("Do you want delete this customer..?");
       if(r == true)
         {
                  $.ajax({
                  type: 'POST',
                  url: '<?//=site_url('fi_home/delgencustomer')?>',
                  data: {cus_id:cus_id},
                  dataType: 'html',
                // cache: false,
                //  async: false,
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                    // alert("before cus_id--"+cus_id);
                    // $("#pform")[0].reset();
                  },
                  success: function(data) {//alert("data--"+data);

                    $('#divchkresponce').html(data);

                    var responce= $('#responce').val();

                    if(responce=="success")
                      {
                         $('.fadeMe').hide();
                          window.location.href='<?=site_url('fi_home/generalinfo')?>';
                          var hdntxtcusId=$('#hdntxtcusId').val();
                          //alert("hdntxtcusId--"+hdntxtcusId);
                          var pckId= hdntxtcusId //"227"; //document.getElementById("cust_nm").selectedIndex = "1"; //$('#cust_nm').val();
                          // alert("Before Set pckId--"+pckId);
                           localStorage.setItem("pckId", pckId);


                      }else if(responce=="error"){

                          $('.fadeMe').hide();

                      }

                  },
                  error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();

                   //var pckId= localStorage.getItem("pckId");
                  //alert("After Set CHK localStorage pckId--"+pckId);

                  }

              });
        }

  }
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
     var cust_nm= $('#cust_nm option:selected').text();
     $('#txtlcustname').val(cust_nm);

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

<script type="text/javascript">
  //ERP tr added
  $(document).ready(function()
  {
    //alert("ready");
    var cnt = 2

    $("body").on('click','.tr_clone_add', function(rrr) { rrr.preventDefault();
      //alert(111);
    var tr    = $(this).closest('.tr_clone');

    var clone = tr.clone();

    clone.find(':text').val('');
 /*   clone.find('input[type=date]').val('');
    clone.find('input[type=time]').val('');
*/
   //clone.find('td:first-child').text(cnt);

    clone.find('.tr_clone_add').siblings('.tr_save_btn').remove();

   //clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

   $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

   //tr.before(clone);
   tr.after(clone);

  //tr.parent("thead").append(clone);

  cnt++;

});
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
 function fndeleteaddicnt(decntlId)
  {
     //alert(decntlId);
     var r = confirm("Do you want delete this additonal contact..?");
       if(r == true)
         {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('fi_home/fndeleteaddicntinfo')?>',
                  data: {decntlId:decntlId},
                  dataType: 'text',
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before decntlId--"+decntlId);
                  },
                  success: function(data) {

                    if(data=="success")
                      {
                         //$("#divfilteraddicnt").load(location.href+" #divfilteraddicnt>*","");
                         //$("#divfilteraddicnt").load(location.href+" #divfilteraddicnt");
                          window.location.href='<?=site_url('fi_home/generalinfo')?>';
                         $('.fadeMe').hide();
                      }else if(data=="error"){

                          $('.fadeMe').hide();
                      }

                  },
                  error: function(xhr) { // if error occured
                    // $('.fadeMe').hide();
                  },
                  complete: function() {
                   // $('.fadeMe').hide();
                  }

              });
        }
  }
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
  function fnloadadditionalcnt(slectval)
  {
      var custnm=$('#cust_nm').val();
      //alert("slectval---"+slectval+" custnm---"+custnm);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnloadadditionalcnt_info')?>',
            data: {custnm:custnm,slectval:slectval},
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
               //alert("slectval---"+slectval+" custnm---"+custnm);
            },
            success: function(data) {

              //alert("data--"+data);

              if(data!="")
                {
                   $("#divfilteraddicnt").html(data);
                   $(".additionalcnt").css('display','block');

                   $('.fadeMe').hide();
                }else{

                    $('.fadeMe').hide();
                }

            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
             // $('.fadeMe').hide();
            }

        });
  }
</script>

<script type="text/javascript">
function validateForm()
{
     var pckId= localStorage.getItem("pckId");
     //alert("CHK localStorage pckId--"+pckId);
      if(pckId==null || pckId=="")
      {//alert("NULL");
             var pckId=$('#cus_names').val();
             localStorage.setItem("pckId", pckId);

      }else{//alert("NOT NULL");

        var pckId= localStorage.getItem("pckId");
        //alert("SET localStorage pckId--"+pckId);
      }
   return true;
}
</script>


<script type="text/javascript">
$(document).ready(function()
  {
$('body').on('change','.cusnote',function()
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
  {

     $(this).closest('.cnt_clone').find('.contact_no').focus();

 });
});
</script>
<script type="text/javascript">
function fnshowcnt()
  { 
      
     $('.additionalcnt').css('display','block');
     $('.additionalcnt-row').css('display','table-row');
  }


    $(document).ready(function()
    {
        $('body').on('keydown', 'input[type="text"]',function(e)
        {
            var tdix = $(this).closest('td').index();
            var tdi=Number(tdix)+1;
            if (e.which === 40) 
            {
                $(this).parents("tr").next("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
            }
            else if(e.which === 38)
            {
                $(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
            }
        });
    });

    $('document').ready(function() 
    {   
        $('body').on('keydown','#cus_fname,#cus_lname',function(e) 
        {   
            if (e.shiftKey || e.ctrlKey || e.altKey) 
            {
                e.preventDefault();
            } 
            else 
            {
                var key = e.keyCode;
                if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) 
                {
                    e.preventDefault();
                }
            }
        });
    });

    function ValidateEmail(inputText)
    {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(inputText.value.match(mailformat))
        {
            return true;
        }
        else
        {
            alert("You have entered an invalid email address!");
            inputText.focus();
            return false;
        }
    }

    $(document).ready(function()
    {
        $('body').on('change','.txtemail',function()
        {   
            var nxtrowchk = $(this).closest('.cnt_clone').next('.cnt_clone').html();
            if(nxtrowchk == undefined)
            {
                var $tr    = $(this).closest('.cnt_clone');
                var $clone = $tr.clone();

                $clone.find(':text').val('');
                $clone.find(':radio').prop( "checked", false );
                $clone.find(':checkbox').prop( "checked", false );
                
                $(this).parents('.cnt_clone').find('.btn-success.cnt_clone_add').removeClass('btn-success cnt_clone_add').addClass('btn-danger cnt_clone_remove').html('<i class="fa fa-minus"></i>');
                $tr.after($clone);
            }
        });
    });

    function apCat(id)
    {
        var apCat = $(".apCat"+id).val();
        $.ajax({
            type: "POST",
            url: "<?=base_url('Vendor/getSubCat')?>",
            data: {id : apCat},
            dataType: 'html',
            beforeSend: function() {
                
            },
            success: function(data){

                $(".subApCat"+id).html(data);
            }
        });
    }
</script>