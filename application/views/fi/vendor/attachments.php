
                    <?php $this->load->view('fi/vendor/select_vendor'); ?>

            
                    <div class="box box-default firstblock_bg">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" id="myattachments">
                                    <table class="table fixed_table table-hover no-margin">
                                        <thead>
                                            <tr>
                                                <th class="w95">Date</th>
                                                <th >Note</th>
                                                <th class="w80">Scan</th>
                                                <th class="w90">Attach</th>
                                                <th class="w80">Show</th>
                                                <th >File Name</th>
                                                <th class="w95">File Size</th>
                                                <th class="w95">File Type</th>
                                                <th class="w80">Email</th>
                                                <th class="w95">Record ID</th>
                                                <th class="w95">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody id="filterattachmentdata">
                                        <?php
                                            $singleattchsql = $this->db->query("SELECT * FROM vend_attachment ORDER BY id DESC LIMIT 1");
                                            $attchsqlrow = $singleattchsql->row();
                                            
                                            $attchsql = $this->db->query("SELECT * FROM vend_attachment ORDER BY id ASC");
                                            $attchsql_nrows = $attchsql->num_rows();

                                            if($attchsql_nrows > 0)
                                            {
                                                foreach ($attchsql->result() as $attchsql_dtls) 
                                                {
                                                    $attamentId = $attchsql_dtls->id;
                                                    
                                                    if($attchsqlrow->id == $attamentId)
                                                    {
                                                        $lstinvoiceid = "fa-plus";
                                                        $lstinvoicecls = "btn-success";
                                                        $fninvoce = "fncrattachment('".$attamentId."')";
                                                    }
                                                    else
                                                    {
                                                        $lstinvoiceid = "fa-minus";
                                                        $lstinvoicecls = "btn-danger";
                                                        $fninvoce = "fndelattachment('".$attamentId."')";
                                                    }

                                                    if($attchsql_dtls->attach_file_size != "")
                                                    {
                                                        $filesize = $attchsql_dtls->attach_file_size;
                                                    }
                                                    else
                                                    {
                                                        $filesize = "";
                                                    }

                                                    if($attchsql_dtls->attach_file_type!="")
                                                    {
                                                        $filetype = $attchsql_dtls->attach_file_type;
                                                    }
                                                    else
                                                    {
                                                        $filetype = "";
                                                    }
                                                    
                                                    if($attchsql_dtls->attach_file_name!="")
                                                    {
                                                        $filename = "<?=base_url()?>uploads/vendor_attachments/".$attchsql_dtls->attach_file_name;
                                                        $target = "target='_blank'";
                                                        $fname = $attchsql_dtls->attach_file_name;
                                                    }
                                                    else
                                                    {
                                                        $filename = "#";
                                                        $target = "";
                                                        $fname = "";
                                                    }

                                                    if($attchsql_dtls->date != "")
                                                    {
                                                        $date = $attchsql_dtls->date;
                                                    }
                                                    else
                                                    {
                                                        $date = date('Y-m-d');   
                                                    }

                                                    if($attchsql_dtls->note != "")
                                                    {
                                                        $note = $attchsql_dtls->note;
                                                    }
                                                    else
                                                    {
                                                        $note = "";
                                                    }
                      ?>
                      <form name="frmattachment<?=$attamentId?>" id="frmattachment<?=$attamentId?>" action="<?=site_url('vendor_attachment/fnupdateattchment')?>" method="POST" enctype="multipart/form-data">
                      <tr class="tr_clone">
                       <!--  <td>1</td> -->
                        <td class="w95">
                         <input type="date" name="date" id="endate" value="<?=$date?>" class="form-control endate"></td>
                        <td>
                          <input type="text" name="notes" id="notes"  value="<?=$note?>" class="form-control" placeholder="" >
                        </td>
                        <td class="w80"><a  class="btn btn-xs btn-primary">Scan</a></td>
                        <td class="w90"><input class="btn btn-xs btn-primary" type="file" name="image" id="image" onchange="fnuploadattchment('<?=$attamentId?>')"  >
                          <label for="image" style="font-weight: 400;"><?=$fname?></label>
                        </td>
                        <td class="w80"><a href="<?=$filename?>" <?=$target?> class="btn btn-xs btn-primary">Show</a></td>
                        <td><?=$filesize?></td>
                        <td class="w95"><?=$filetype?></td>
                        <td class="w95"><a class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#myModal">Email</a></td>
                        <td class="w80"><?=$attamentId?></td>
                        <td class="w95">
                          <input type="hidden" name="hdnattchId" id="hdnattchId" value="<?=$attamentId?>">
                         <button onclick="<?=$fninvoce?>" class="btn btn-xs <?=$lstinvoicecls?>"><i class="fa <?=$lstinvoiceid?>"></i></button><!-- tr_clone_add -->
                        </td>
                      </tr>
                    </form>
                    <?php } }else{
                          echo "<tr><td colspan='17'>No Attachments Found..!</td></tr>";
                    }?>
                    </tbody>
                  </table>
                </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
         <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
  Launch demo modal
</button>    -->
<!-- Modal -->
        <div class="modal fade email_modal w80" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email Form</h4>
      </div>
      <div class="modal-body">
       <div class="box-body">
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


                     <div class="col-xs-2">
                     <label>Click to Select or Enter New</label>

                         <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1" name="task_completed[]"> Send To All</label>
                          </div>

                   </div>
                     <div class="col-xs-10">
                     <div class="table-responsive">

                  <table class="table table-hover no-margin">

                    <thead>

                      <tr>

                        <th >To:</th>
                        <th >CC:</th>
                        <th >BCC:</th>

                        <th >Email Address:</th>
                        <th >Name:</th>
                        <th >Type:</th>

                      </tr>


                      <tr>

                        <td ><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td ><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td ><input type="checkbox" value="1" name="task_completed[]"></td>

                        <td ><input type="text" name="invoice_payment[]" class="form-control"  value="levi@phototype.com"> </td>
                        <td ><input type="text" name="invoice_payment[]" class="form-control" value="Liberow, levi"> </td>
                        <td > <input type="text" name="invoice_payment[]" class="form-control" value="Vendor"></td>

                      </tr>


                        <tr>

                        <td ><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td ><input type="checkbox" value="1" name="task_completed[]"></td>
                        <td ><input type="checkbox" value="1" name="task_completed[]"></td>

                        <td ><input type="text" name="invoice_payment[]" class="form-control"  value=" "> </td>
                        <td ><input type="text" name="invoice_payment[]" class="form-control" value=" "> </td>
                        <td > <input type="text" name="invoice_payment[]" class="form-control" value=" "></td>

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

                                               <button type="button" class="btn btn-default btn-xs">Add Attachment</button>

                                         </div>
                                         <div class="col-xs-10">
                                             <div class="table-responsive">

                                      <table class="table table-hover no-margin">

                                        <thead>

                                          <tr>

                                            <th width="60%">File Name</th>
                                            <th >View</th>
                                            <th >Remove</th>

                                          </tr>

                                          <tr>

                                            <td><input type="text" name="invoice_payment[]" class="form-control" value="file name  "></td>
                                            <td><a class="btn btn-xs btn-default cnt_clone_add"><i class="fa fa-eye"></i></a></td>
                                            <td><a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a></td>

                                          </tr>

                                        </thead>

                                      </table>

                                    </div>
                                         </div>

                                    </div>
                                              <!-- /.box -->

                                      <hr>
                                      <div class="row">
                                         <div class="col-xs-2">
                                             <label>Subject</label>

                                         </div>
                                         <div class="col-xs-10">
                                              <input type="text" name="invoice_payment[]" class="form-control" value=" ">
                                         </div>

                                    </div>
                                      <hr>
                                    <div class="row">
                                         <div class="col-xs-2">
                                             <label>Body</label>

                                               <button type="button" class="btn btn-default btn-xs">Check Spelling</button>

                                         </div>
                                         <div class="col-xs-10">
<textarea name="invoice_payment[]" rows="6" class="form-control" >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley

Date:1/24/2018  6:30:00 PM
Type:Wedding
Expected Ending: 1/24/2018
Location:location
City:Brooklyn
</textarea>
                                         </div>

                                    </div>


                                    <div class="row">
                                         <div class="col-xs-2">

                                         </div>
                                         <div class="col-xs-10 mt20" >
                                                 <div class="row ">
                                                     <div class="col-xs-5">
                                                         <button type="button" class="btn btn-primary">Cancel </button>
                                                     </div>
                                                     <div class="col-xs-4">
                                                           <div class="checkbox">
                                                            <label> <input type="radio" value="1" name="email_radio"> Email with SMTP</label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label> <input type="radio" value="1" name="email_radio"> Email with Outlook</label>
                                                          </div>
                                                     </div>

                                                      <div class="col-xs-3">
                                                           <button type="button" class="btn btn-primary">Send Email</button>
                                                     </div>

                                                </div>
                                         </div>

                                    </div>





                        </div>
                      </div>



                <!-- /.table-responsive -->

              </div>
      </div>



    </div>
  </div>
</div>
</section>
</div>
<div  class="fadeMe" > <div id="loader" class="loader"></div> </div>
   <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
   <script type="text/javascript">
        var cnt = 2
        $("body").on('click', '.tr_clone_add', function(rrr) { rrr.preventDefault();
        var $tr = $(this).closest('.tr_clone');
        var $clone = $tr.clone();
        $clone.find(':text').val('');
        $clone.find('td:first-child').text(cnt);
        $tr.parent("tbody").append($clone);
        $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
        cnt++;
        });
        
        $(document).on('click', '.tr_clone_remove', function(){
            var $tr    = $(this).closest('.tr_clone');

  //$(this).closest('table').addClass("currenttable");
  //var alltr = $(this).parents("table.currenttable").find('tr');
  //var len = alltr.length - 1;

  //$(alltr).each(function(){ $(this).find("td:first-child").text(i)});


  //alert(len);

    var $clone = $tr.remove();
  if(cnt>0)
  {
  cnt--;


  }

});

  </script>


  <!--  Create Attachment -->
  <script type="text/javascript">
     function fncrattachment(attachmentId)
     {

      var customrId= $('#cus_names').val();
      //alert("customrId--"+customrId);
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '<?=site_url('vendor_attachment/fncrevntattachment')?>',
            data: {customrId:customrId},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {

                if(data=="success")
                {
                    $('.fadeMe').hide();
                    //$("#myattachments").load(location.href + " #myattachments");
                      window.location.href="<?=site_url('vendor_attachment')?>";



                }else if(data=="error"){

                    $('.fadeMe').hide();
                    //alert("Something went wrong..!");
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

<!-- End Create Attachment -->


<!--  Delete Attachment -->
   <script type="text/javascript">
     function fndelattachment(attachmentId)
     {
        //alert("attachmentId--"+attachmentId);
       event.preventDefault();

       var r = confirm("Do you want delete this attachment..?");
           if(r == true)
             {
                  $.ajax({
                  type: 'POST',
                  url: '<?=site_url('vendor_attachment/fndeleteattachment')?>',
                  data: {attachmentId:attachmentId},
                  dataType: 'text',
                // cache: false,
                //  async: false,
                  beforeSend: function() {
                      // setting a timeout
                      $('.fadeMe').show();
                     //alert("before attachmentId--"+attachmentId);
                  },
                  success: function(data) {

                      //alert("data---"+data);


                      if(data=="success")
                      {
                          $('.fadeMe').hide();
                          //alert("Invoice Created Successfully..!");
                          window.location.href="<?=site_url('vendor_attachment')?>";
                         // $("#myattachments").load(location.href + " #myattachments");



                      }else if(data=="error"){

                          $('.fadeMe').hide();
                          //alert("Something went wrong..!");
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

<!-- End Delete Attachment -->



<script type="text/javascript">
  
 // function fnuploadattchment(attachmentId)
 $(document).ready(function(){ 
 $("body").on("change", "#image, .image", function(event){

    //event.preventDefault();
     var temp_hdnattId=  $(this).parents(".tr_clone").find(".hdnattId").val();  
     //alert("temp_hdnattId--"+temp_hdnattId);

     //document.getElementById("frmattachment"+temp_hdnattId).submit();

    $("#frmattachment"+temp_hdnattId).submit();

    //$("form[name='frmattachment"+temp_hdnattId+"']").submit();


       }); 
  });

</script>





   <script type="text/javascript">
    function fnsearchattchmentsbyphone(phone)
     {

        var custid=$('#cus_names').val();
        //alert("custid--"+custid+" phone--"+phone);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('vendor_attachment/fnsearchattchmentsbyph')?>',
            data: {custid:custid,phone:phone},
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("custid--"+custid+" phone--"+phone);

            },
            success: function(data) {

              if(data!="")
              {

                 $('#filterattachmentdata').html(data);
                 $('.fadeMe').hide();

              }else{

                $('#filterattachmentdata').html('<tr><td colspan="17">No Attachments Found..!</td></tr>');
                $('.fadeMe').hide();
               }
            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
              //$('.fadeMe').hide();

            }

        });
     }

   </script>


   <script>
$(document).ready(function(){
$("body").on("keydown", "#endate, .endate", function(event){
  //alert('123');
  
   var key = event.keyCode;
   //alert("key--"+key);


 var temp_edate =  $(this).parents(".tr_clone").find(".endate");

 
    if(key=="107")
      {
        //alert("date+");
          var today = new Date();
          var dd = String(today.getDate()+1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("plus today--"+today);

          //$('#edate').val(today);
           temp_edate.val(today);

        
      }else if(key=="109"){
        //alert("date-");
          var today = new Date();
          var dd = String(today.getDate()-1).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();

          today = yyyy + '-' + mm + '-' + dd;
          //alert("minus today--"+today);
          //$('#edate').val(today);
          temp_edate.val(today);
        
      }else if(key=="68")
             {

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                //alert("plus today--"+today);

               //$('#edate').val(today);
                temp_edate.val(today);
                          
             }

    });

});
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

<script type="text/javascript">
    $(document).ready(function()
    {
        loadlist(<?=$venders?>);
    });
</script>

<script type="text/javascript">
    function loadlist()
    {
        var name = $('#searc').val();
        sessionStorage.setItem("vendorId", name);
        deletevendor(name);
        $.ajax({
            type: 'POST',
            url: '<?=site_url('Vendor/fnsearchcustattchment')?>',
            data: { custid : name },
            dataType: 'html',
            beforeSend: function() 
            {
                $('.fadeMe').show();
            },
            success: function(data) 
            {
                if(data!="")
                {
                    $('#filterattachmentdata').html(data);
                    $('.fadeMe').hide();
                }
                else
                {
                    $('#filterattachmentdata').html('<tr><td colspan="17">No Attachments Found..!</td></tr>');
                    $('.fadeMe').hide();
                }
            },
            error: function(xhr) 
            { 
                $('.fadeMe').hide();
            },
            complete: function() 
            {
                $('.fadeMe').hide();
            }
        });
    }
</script>