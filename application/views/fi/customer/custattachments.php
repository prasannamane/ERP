<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Attachments</title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

    <script src="//asprise.azureedge.net/scannerjs/scanner.js" type="text/javascript"></script>
    <script src="https://asprise.azureedge.net/scannerjs/scanner.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style type="text/css">
    .loaders {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border: 16px solid #fff;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        margin: 15% auto;
        opacity: 1;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); } 
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fadeMes {
        opacity: 1;
        width: 100%;
        height: 100%;
        z-index: 10;
        top: 0;
        background: rgba(0,0,0,0.5);
        left: 0;
        position: fixed;
        text-align: center;
        display: none;
    }

    input[type=file] {
        max-width: 100px;
        display: inline-block;
    }

    input[type=date] {
        max-width: 90px;
        margin: 0;
    }

    .select2-container .select2-selection--single { height: 22px !important; }
    .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 19px !important; }
    .box-tools.pull-right.dflex {
        margin: -3px 0 0 0;
    }

    #modal_attachment span.filebtn {
        background: #4cc0c0;
        min-width: 130px;
        border-radius: 5px !important;
        height: 40px;
        width: 100px !important;
        margin: 0 !important;
        vertical-align: top;
        cursor: pointer;
    }

    #modal_attachment span.filebtn:after {
        content: "Attach File";
        top: 10px;
        font-size: 13px;
        text-transform: capitalize;
    }

    #modal_attachment span.filebtn input{ cursor: pointer; }
    #modal_attachment span.filebtn input {
        cursor: pointer;
        width: 130px !important;
    }

    .asprise-footer, .asprise-footer a:visited { font-family: Arial, Helvetica, sans-serif; color: #999; font-size: 13px; }
    .asprise-footer a {  text-decoration: none; color: #999; }
    .asprise-footer a:hover {  padding-bottom: 2px; border-bottom: solid 1px #9cd; color: #06c; }
</style>
</head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Event Management </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Customer</a></li>
                    <li class="active">Attachments</li>
                </ol>
            </section>

            <?php if(isset($success)){?>
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong></strong> <?=$success?>
            </div>
            <?php }?>

            <?php if(isset($error)){?>
            <div class="alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> <?=$error?>
            </div>
            <?php }?>

            <section class="content">
                <!-- TABLE: LATEST ORDERS -->
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->load->view('template/attachments_select_customer'); ?>
                        <!-- /.box -->
                        <div class="box box-default firstblock_bg">
                            <div class="box-header with-border">
                                <p class="uhead2"> Attachments</p>
                                <div class="box-tools pull-right dflex">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left"  data-toggle="modal" data-target="#modal_attachment">New Attachment</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_attachment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">New Attachment </h4>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <div id="server_response"></div>
                                                    <a href="<?php echo base_url('assets/');?>/plugins/scanner/index.html" class="btn btn-lg btn-info btn-flat"  >Scan </a>
                                                    <!-- <a href="#" class="btn btn-lg btn-info btn-flat" >Attach File </a> -->
                                                    <span class="filebtn" style=" display: inline-block; ">
                                                        <input class="btn btn-xs btn-primary image" type="file" name="image" id="image" style="width:90%;">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" id="myattachments">
                                        <table class="table   table-hover no-margin">
                                            <thead>
                                                <tr>
                                                    <th class="table_col1">Date</th>
                                                    <th class="table_col2">File Name</th>
                                                    <th class="table_col3">Scan</th>
                                                    <th class="table_col4">Attach</th>
                                                    <th class="table_col5">Show </th>
                                                    <th class="table_col6">Email</th>
                                                    <th class="table_col7">File Type</th>
                                                    <th class="table_col8">File Size</th>
                                                    <th class="table_col9">Record ID</th>
                                                    <th class="table_col10">Note</th>
                                                    <th class="table_col11">Action </th>
                                                </tr>
                                            </thead>
                                            <tbody id="filterattachmentdata" ></tbody>
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

        <div class="modal fade email_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email Form</h4>
      </div>
      <?php
      $cus_id=$this->session->userdata('id');
      // print_r($cus_id);
      // $result_array=$this->db->SELECT('*')->where('cus_id',$cus_id)->where(array('email !='=>""))->get('user_contact_info')->result_array();
      // echo "<pre>";print_r($result_array);

      // $result_array = $this->db->select('*')
  		// 				 ->from('register_customer')
  		// 				 ->join("user_contact_info", "register_customer.cus_id=user_contact_info.cus_id")
  		// 				 ->where('register_customer.cus_id',$cus_id)
  		// 				 ->where('user_contact_info.email !=',"")
  		// 				 ->get()
      //          ->result_array();

            // $result_array=   $query->result_array();
            // echo "<pre>";print_r($result_array);
      ?>
      <div class="modal-body">
       <div class="box-body">
         <form id="frmsendattachomail" name="frmsendattachomail" method="post" action="<?=site_url('attachment/sendattachmentemail')?>" enctype="multipart/form-data">
          <div class="row">
           <div class="col-xs-2">

           </div>

           <div class="col-xs-10">
            <div class="row">
             <div class="col-xs-3">
               
             </div>

             <div class="col-xs-3">
              
             </div>

             

           </div>
         </div>
       </div>


       <hr>

       <div class="box box-primary mt20 firstblock_bg">
        <div class="row">


         <div class="col-xs-2">
           <label>Click to Select or Enter New</label>

           <div class="checkbox">
            <label>
              <input type="checkbox" class="checkall" value="1" name="task_completed[]"> Send To All</label>
            </div>

          </div>
          <div class="col-xs-10">
           <div class="table-responsive">

            <table class="table table-hover no-margin" >

              <thead>

                <tr>

                  <th >To:</th>
                  <th >CC:</th>
                  <th >BCC:</th>

                  <th >Email Address:</th>
                  <th >Name:</th>
                  <th >Type:</th>

                </tr>
              </thead>
              <tbody id="email_data">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<div class="box box-primary mt20 secondblock_bg">
    <div class="box-body">
        <div class="row">
            <div class="col-xs-2">
                <label>Attachments</label>
            </div>
            <div class="col-xs-10">
                <div class="table-responsive">
                    <table class="table table-hover no-margin">
                        <thead>
                            <tr>
                                <th width="60%">File Name</th>
                                <th >View</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="invoice_payment[]" class="form-control" id="edit_id">
                                </td>
                                <td>
                    <input type="hidden" name="data_url" id="link_web" value="">
                    <a href="#" id="ch_link" class="btn btn-xs btn-default cnt_clone_add" target="_blank">
                      <i class="fa fa-eye"></i>
                    </a>
                  </td>
                  

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
      <textarea name="invoice_payment[]" rows="6" class="form-control" >
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
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
       <div class="col-xs-6">
         <button type="button" class="btn btn-primary" data-dismiss="modal" >Cancel </button>
       </div>
                                                     <!-- <div class="col-xs-4">
                                                           <div class="checkbox">
                                                            <label> <input type="radio" value="1" name="email_radio"> Email with SMTP</label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label> <input type="radio" value="1" name="email_radio"> Email with Outlook</label>
                                                          </div>
                                                        </div> -->

                                                        <div class="col-xs-6 text-right">
                                                         <button type="submit" class="btn btn-primary">Send Email</button>
                                                       </div>

                                                     </div>
                                                   </div>

                                                 </div>





                                               </div>
                                             </div>



                                             <!-- /.table-responsive -->
                                           </form>
              </div>
      </div>



    </div>
  </div>
</div>



      </section>

            <div class="col-md-12 text-center">

          <button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
          <a href="<?=base_url()?>fi_notes/c_notes" class="btn btn-lg btn-info btn-flat">Save & Continue</a>
          <!-- <button name="button" id="Submit" class="btn btn-lg btn-info btn-flat">Save & Continue</button> -->

        </div>
    </div>


    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>


   <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("body").on("change", "#image, .image", function(event){
                var temp_hdnattId=  $(this).parents(".tr_clone").find(".hdnattId").val();
                $("#frmattachment"+temp_hdnattId).submit();
            });
        });
   </script>
   <script type="text/javascript">

    // function fnuploadattchment(attachmentId)
    $(document).ready(function(){
        $("body").on("change", ".checkall", function(event){

        if($(this). prop("checked") == true){
          $('.toclass').prop('checked', true);
        }else {
          $('.toclass').prop('checked', false);
          }

        });
     });

   </script>

   <script type="text/javascript">
    function test(url,name,id){
      // alert(url);
      // alert(name);
      // var id=url;
      // // alert(id);
      // var name=name;
        // alert(name);
      //set href for cancel button
      $('#edit_id').val(name);
      // $('#edit_name').val(name);
      $("#ch_link").attr("href", url);
      $("#link_web").val(url);

      $.ajax({
          type: 'POST',
          url: '<?=site_url('attachment/getcustomer_data')?>',
          data: {id:id},
          dataType: 'text',
          beforeSend: function() {
              // setting a timeout
              $('.fadeMe').show();
          },
          success: function(data) {
            // alert(data);
            $('.fadeMe').hide();
            $("#email_data").empty();
            $("#email_data").append(data);
              // if(data=="success")
              // {
              //
              //     $('.fadeMe').hide();
              //     // //$("#myattachments").load(location.href + " #myattachments");
              //     //   window.location.href="<?=site_url('attachment')?>";
              //
              // }
          },


      });

    }


    </script>

   <script type="text/javascript">
  //ERP tr added
  	var cnt = 2

    $("body").on('click', '.tr_clone_add', function(rrr) {
       rrr.preventDefault();

    var $tr    = $(this).closest('.tr_clone');

    var $clone = $tr.clone();

    $clone.find(':text').val('');
	 $clone.find('td:first-child').text(cnt);

   // $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()

  //  $clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');


   //$tr.after($clone);

	$tr.parent("tbody").append($clone);

	$(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

	cnt++;

});





$(document).on('click', '.tr_clone_remove', function(){

     // Your Code

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

      var customrId= attachmentId;
      // alert("customrId--"+customrId);
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '<?=site_url('attachment/fncrevntattachment')?>',
            data: {customrId:customrId},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
            },
            success: function(data) {
              console.log(data);
                if(data!="")
                {
                    $('.fadeMe').hide();
                    //$("#myattachments").load(location.href + " #myattachments");
                      window.location.href="<?=site_url('attachment')?>";



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
                  url: '<?=site_url('attachment/fndeleteattachment')?>',
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
                          window.location.href="<?=site_url('attachment')?>";
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

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 -->



<script type="text/javascript">
  //attchsubmit

  /*$(document).ready(function () {//alert("1");

    //$("#attchsubmit").click(function (event) {alert("1");
    $("body").on('click','#attchsubmit',function (event) {//alert("2");

        //stop submit the form, we will post it manually.
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?//=site_url('attachment/fnupdateattchment')?>",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:true,
            async:true,
            success: function (data) { alert("data--"+data);

            },
            error: function (e) {



            }
        });

    });

});*/

</script>

<script>
// $(document).ready(function(){
//     $('#cus_attachment').on('input', function()
//     {
//         var value = $(this).val();
//         var cust_id=$('#cust_attachment [value="' + value + '"]').data('value');

//         localStorage.setItem("customer_name", value);
//         fnsearchattchments(cust_id);
//     });

//     var cu_name= localStorage.getItem("customer_name");
//     $('#cus_attachment').val(cu_name);
// });


function MM_jumpMenu(targ,selObj,restore)
{
    localStorage.setItem("customer_name", selObj.options[selObj.selectedIndex].text);
    fnsearchattchments(selObj.options[selObj.selectedIndex].value);
}
</script>


 <script type="text/javascript">
    function fnsearchattchments(custid)
    {
        $.ajax({
            type: 'POST',
            url: '<?=site_url('attachment/fnsearchcustattchment')?>',
            data: {custid:custid},
            dataType: 'html',
            beforeSend: function() {
                $('.fadeMe').show();
                var pckId=custid;
                localStorage.setItem("pckId", pckId);
            },
            success: function(data) {
                if(data!="")
                {
                    $('#filterattachmentdata').html(data);
                    $('.fadeMe').hide();
                    $('#cus_names option[value="'+custid+'"]').attr("selected", "selected");
                    upperinvinfo(custid);
                }
                else
                {
                    $('#filterattachmentdata').html('<tr><td colspan="11">No Attachments Found..!</td></tr>');
                    $('.fadeMe').hide();
                    $('#cus_names option[value="'+custid+'"]').attr("selected", "selected");
                }
            },
            error: function(xhr) { 
                $('.fadeMe').hide();
            },
            complete: function() {
                $('.fadeMe').hide();
            }
        });
    }
   </script>


   <script type="text/javascript">
    function fnsearchattchmentsbyphone(phone)
     {

        var custid=$('#cus_names').val();
        //alert("custid--"+custid+" phone--"+phone);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('attachment/fnsearchattchmentsbyph')?>',
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

                $('#filterattachmentdata').html('<tr><td colspan="11">No Attachments Found..!</td></tr>');
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
$("body").on("keydown", ".endate", function(event){
    var key = event.keyCode;
    var temp_edate =  $(this).parents(".tr_clone").find(".endate");

    if(key=="107" || key=="187")
    {
        //alert("date+");
        //var today = new Date();
        var dtpls;
        if(temp_edate.val()=="")
        {
            dtpls= new Date();
        }else{
            dtpls= new Date(temp_edate.val());
        }
        var today = dtpls;
        var dd = String(today.getDate()+1).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        // today = yyyy + '-' + mm + '-' + dd;
        today = mm + '/' + dd + '/' + yyyy;
        temp_edate.val(today);
        event.preventDefault();
    }
    else if(key=="109" || key=="189")
    {

        var dtpls;
        if(temp_edate.val()=="")
        {
            dtpls= new Date();
        }else{
            dtpls= new Date(temp_edate.val());
        }

        var today = dtpls;
        var dd = String(today.getDate()-1).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        // today = yyyy + '-' + mm + '-' + dd;
        today = mm + '/' + dd + '/' + yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="68")
    {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;
        temp_edate.val(today);
        event.preventDefault();

    }
    else if(key=="8" || key=="46")
    {

    }
    else
    {
       var str = temp_edate.val();


       if(str.length >= 6 &&  !(str.includes("/")))
       {
           var mm = str.substring(0,2);
           var dd = str.substring(2).substring(0,2);
           var yy = str.substring(2).substring(2).substring(0,2);
           yy = "20"+yy;

           var month = 12;
           var day   = 31;

           if(mm=="02")
           {
               if(yy % 4 === 0 )
               {
                   day = 29;
               }
               else
               {
                   day = 28;
               }
           }

           if(mm <= month && dd <= day)
           {

               var today = mm + '/' + dd + '/' + yy ;
               var today1 = mm + '/' + dd + '/' + yy ;

               temp_edate.val(today);

           }
           else
           {
               alert("Wrong date.");
               temp_edate.val("");
               event.preventDefault();
           }
       }
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
     var pckId= localStorage.getItem("pckId");
      //alert("localStorage pckId--"+pckId);
      if(pckId!=null)
      {
          fnsearchattchments(pckId);
      }else{
           var custnm = $('#cus_names').val();
           // alert("custnm--"+custnm);
           fnsearchattchments(custnm);
      }
 });
</script>


<script type="text/javascript">
$(document).ready(function(){
$("body").on("change", "#notes, .notes", function(event){
   var temp_notes =  $(this).parents(".tr_clone").find(".notes").val();
   var temp_hdnattchid =  $(this).parents(".tr_clone").find(".hdnattchid").val();

    //alert("temp_notes--"+temp_notes+" temp_hdnattchid--"+temp_hdnattchid);

            $.ajax({
            type: 'POST',
            url: '<?=site_url('attachment/updatenotes')?>',
            data: {temp_notes:temp_notes,temp_hdnattchid:temp_hdnattchid},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();
                //alert("custid--"+custid+" phone--"+phone);

            },
            success: function(data) {

              if(data=="success")
              {

                 $('.fadeMe').hide();

              }else{

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

});
});
</script>


<script type="text/javascript">

function upperinvinfo(name)
  {
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

</script>



 <script type="text/javascript">
$(document).ready(function(){
$('body').on('keydown', 'input[type="text"]',function(e){

    //e.preventDefault();
    var tdix = $(this).closest('td').index();
  // alert(tdix);
    var tdi=Number(tdix)+1;
    if (e.which === 40) {
      $(this).parents("tr").next("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
    }else if(e.which === 38)
    {
      //$(this).parents("tr").prev("tr").find('.num').focus();
       $(this).parents("tr").prev("tr").find("td:nth-child("+ tdi +")").find('.updwn').focus();
    }
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('body').on('blur','.attachfile_name',function(){
  var file_name= $(this).val();
// alert(file_name);
  var attach_id= $(this).parents('tr').find('.attach_id span').html();

  var pckId= localStorage.getItem("pckId");
  // alert(attach_id);

  $.ajax({
  type: "POST",
  url: "<?=site_url('attachment/updateattachname')?>",
  data: {file_name:file_name,attach_id:attach_id},
  dataType: 'text',
  beforeSend: function() {
        // setting a timeout
        $('.fadeMe').show();
      // alert("name--"+name+" lstpaytype--"+lstpaytype+" lsttxtpdate--"+lsttxtpdate);
    },
  success: function(data)
  {
     if(data=="success")
     {
        //$('#allpayments-history').load(location.href + ' #allpayments-history>*','');
         fnsearchattchments(pckId);
        $('.fadeMe').hide();
     }else  if(data=="error"){
        $('.fadeMe').hide();
     }

  }

});

});
});
</script>

<a style="display: none" href="<?php echo site_url('fi_home/');?>" class="btn btn-sm btn-info btn-flat" id='back'>Back</a>
<script src="<?php echo base_url('assets/');?>js/prasanna.js"></script>

  <script type="text/javascript">
    
    $( document ).ready(function() {

      $.ajax({
        url: "<?=site_url('Email_reader')?>", 
          success: function(result){
          console.log("Email Updated from server");
      }});
    });
  </script>


    <script type="text/javascript">
                   $(document).ready(function(){

                    $.ajax({
                type: "POST",
                url: "<?=base_url('Fi_home/getSearchCustContactInfo'); ?>",//getSearchInvoiceInfo
                data: {name:<?=$cus_id?>},
                dataType: 'html',
                
                success: function(data)
                {
                    $('.loaduppertabcntdtls').html(data);
                }
            });
            });
                </script>