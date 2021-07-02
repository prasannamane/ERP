                    
                <?php $this->load->view('fi/vendor/select_vendor'); ?>
            </div>
               
            <div class="col-md-12">
               <div class="box box-default firstblock_bg">
                    <div class="box-header with-border">
                        <p class="uhead2">SEARCH VENDOR </p>
                    </div>
                    
                    <div class="box-body filtercust">
                        <div class="form-horizontal">
                            <form method="post" name="frmsearchcust" id="frmsearchcust">
                                <div class="form-group">
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" style="text-transform:capitalize;">
                                    </div>
                                    
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" style="text-transform:capitalize;">
                                    </div>
                       
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="cname" name="cname" placeholder="Company">
                                    </div>
                                    
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="adr1" name="adr1" placeholder="Address 1">
                                    </div>
                                    
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="adr2" name="adr2" placeholder="Address 2">
                                    </div>
                                    
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="cities" name="cities" placeholder="City">
                                    </div>
                       
                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="states" name="states" placeholder="State">
                                    </div>

                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="zname" name="zname" placeholder="Zip Code">
                                    </div>

                                    <div class="col-sm-1">
                                        <input class="form-control" type="text" id="areas" name="areas" placeholder="Area">
                                    </div>

                                    <div class="col-sm-1">
                                        <input class="form-control contact_no" type="text" id="mname" name="mname" placeholder="Phone No.">
                                    </div>

                                    <div class="col-sm-1">
                                        <select onchange="apCat()" class="form-control apCat" name="apcate" id="apcate">
                                            <option value="">Choose AP Category</option>
                                            <?php
                                            foreach ($ap_cat as $apcat_info) 
                                            { ?>
                                                <option value="<?=$apcat_info['sub_id']; ?>"><?=$apcat_info['sub_name']; ?></option>
                                                <?php  
                                            } ?>
                                        </select>
                                    </div>
                            
                                    <div class="col-sm-1">
                                        <select class="form-control subApCat" name="apsubcate" id="apsubcate">
                                            <option value="">Choose AP Subcategory</option>
                                            <!-- <?php
                                            foreach ($ap_subcat as $apsubcat_info) 
                                            { ?>
                                                <option value="<?=$apsubcat_info['sub_id']; ?>"><?=$apsubcat_info['sub_name']; ?></option>
                                                <?php  
                                            } ?> -->
                                        </select>
                                    </div>

                                    <div class="col-sm-1">
                                        <input class="btn btn-xs btn-primary btn-flat" type="button" name="submit" id="submit" value="Search" onclick="fnsearchcustomer()">
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table fixed_table table-hover no-margin" id="tab_data">
                                    <thead>
                                        <tr>
                                            <!--<th class="w30">ID</th>-->
                                            <th class="w30">TITLE</th>
                                            <th class="w80">FIRST NAME</th>
                                            <th class="w80">LAST NAME</th>
                                            <th class="w100">COMPANY</th>
                                            <th class="w150">ADDRESS 1</th>
                                            <th class="w150">ADDRESS 2</th>
                                            <th class="w80">CITY</th>
                                            <th class="w80">STATE</th>
                                            <th class="w50">ZIP </th>
                                            <th class="w150">AREA</th>
                                            <th class="w150">CONTACT NUMBER</th>
                                            <th class="w150">NOTE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="divfiltercust"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="result"></div>
        </section>
    </div>

    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>  
    <!--<script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script> -->
    <script type="text/javascript">
    $(document).ready(function()
    {
        var maxFieldPhone = 3; //Input fields increment limitation
        var addPhone = $('.add_phone'); //Add button selector
        var phoneWrapper = $('.phone_wrapper'); //Input field wrapper
        var phoneHTML = '<div class="form-group"> <div class="col-sm-10"> <input class="form-control" type="text" placeholder="Phone"  name="field_phone[]"> </div> <div class="col-md-2"><button class="btn btn-xs btn-danger btn-flat remove_phone"><i class="fa fa-minus"></i></button></div> </div>'; //New input field html
        var xPhone = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addPhone).click(function()
        {
            //Check maximum number of input fields
            if(xPhone < maxFieldPhone){
            xPhone++; //Increment field counter
            $(phoneWrapper).append(phoneHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
   $(phoneWrapper).on('click', '.remove_phone', function(e){
     e.preventDefault();
       $(this).parent().parent('div').remove(); //Remove field html
       xPhone--; //Decrement field counter
     });
//add address
   var maxFieldAddress = 3; //Input fields increment limitation
   var addAddress = $('.add_address'); //Add button selector
   var addressWrapper = $('.address_wrapper'); //Input field wrapper
   var addressHTML = '<div class="form-group"> <div class="col-sm-10"> <input class="form-control" type="email" placeholder="Email"  name="field_address[]"> </div> <div class="col-md-2"><button class="btn btn-xs btn-danger btn-flat remove_address"><i class="fa fa-minus"></i></button></div> </div>'; //New input field html
   var xAddr = 1; //Initial field counter is 1
   //Once add button is clicked
   $(addAddress).click(function(){
       //Check maximum number of input fields
       if(xAddr < maxFieldAddress){
           xAddr++; //Increment field counter
           $(addressWrapper).append(addressHTML); //Add field html
         }
       });
   //Once remove button is clicked
   $(addressWrapper).on('click', '.remove_address', function(e){
     e.preventDefault();
       $(this).parent().parent('div').remove(); //Remove field html

       xAddr--; //Decrement field counter

     });

 });

</script>
    
    <script>
        function loadlist()
        {
            var name = $('#searc').val();
            sessionStorage.setItem("vendorId", name);
            deletevendor(name);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/getVenderSearchInfo'); ?>",
                data: {name : name},
                dataType: 'html',
                success: function(data)
                {
                    if(data!="")
                    {
                        $('#divfiltercust').html(data);
                    }
                    else
                    {
                        $('#divfiltercust').html(data);
                    }
                }
            });
        }
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Vendor/getVenderSearchInfo'); ?>",
            data: {name : <?=$vendorId?>},
            dataType: 'html',
            success: function(data)
            {
                if(data!="")
                {
                    $('#divfiltercust').html(data);
                }
                else
                {
                    $('#divfiltercust').html(data);
                }
            }
        });
    });

    function fnsearchcustomer()
    {
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var cname = $('#cname').val();
        var adr1 = $('#adr1').val();
        var adr2 = $('#adr2').val();
        var cities = $('#cities').val();
        var states = $('#states').val();
        var zname = $('#zname').val();
        var areas = $('#areas').val();
        var mname = $('#mname').val();
        var apcate = $('#apcate').val();
        var apsubcate = $('#apsubcate').val();

        if(fname!="" || lname!="" || cname!="" || adr1!="" || adr2!="" || cities!="" || states!="" || zname!="" || areas!="" || mname!="" || apcate!="" || apsubcate!="")
        {
            var searchcust = $('#frmsearchcust').serialize();
            $.ajax({
                type: "POST",
                url: "<?=site_url('Vendor/searchVendorData')?>",
                data: searchcust,
                dataType:"html",
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                },
                success: function(data)
                {
                    if(data!="")
                    {
                        $('#divfiltercust').html(data);
                        $('.fadeMe').hide();
                    }
                    else
                    {
                        $('#divfiltercust').html(data);
                        $('.fadeMe').hide();
                    }
                }   
            });
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "<?=site_url('Vendor/search_allvendor')?>",
                dataType:"html",
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                },
                success: function(data)
                {
                    if(data!="")
                    {
                        $('#divfiltercust').html(data);
                        $('.fadeMe').hide();
                    }
                    else
                    {
                        $('#divfiltercust').html(data);
                        $('.fadeMe').hide();
                    }
                }
            });
        }
    }
    

  function gettopphoneno(name)
  {//alert("name--"+name);

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('Vendor/getSearchVendContactInfo'); ?>",
        data: {name : name},
        dataType: 'html',
        success: function(data)
        {

          if(data!="")
          {
            //console.log(data);

           $('#contact_info').html(data);

         }else{
             $('#contact_info').html("");
         }
       }
    });
  }
  
</script>


<script type="text/javascript">
  
  function fncustomersearchbyphone(txtphoneno)
  {
     if(txtphoneno!="")
     {        
            $.ajax({
            type: "POST",
            url: "<?php echo base_url('Vendor/fnvendersrchbyph'); ?>",
            data: {txtphoneno : txtphoneno},
            dataType: 'html',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
                if(data!="")
                {
                  // console.log(data);
                 //$('#tab_data tbody').html(data);
                 $('#divfiltercust').html(data);
                 $('.fadeMe').hide();
               }else{
                   //$('#tab_data tbody').html(data);
                   $('#divfiltercust').html(data);
                    $('.fadeMe').hide();
               }
            }
         });
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



        function SerachSelect(id)
        {
            console.log(id);
            window.location.href = "<?=base_url('Vendor/SerachSelect/')?>"+id;
        }

        function apCat()
        {
            var apCat = $(".apCat").val();
           
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/getSubCat')?>",
                data: {id : apCat},
                dataType: 'html',
                beforeSend: function() {
                    
                },
                success: function(data){

                    $(".subApCat").html(data);
                }
            });
        }
    </script>