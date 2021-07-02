                    <?php $this->load->view('fi/vendor/select_vendor'); ?>
            <div class="box box-default firstblock_bg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table fixed_table table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th class="w20">Purchase</th>
                                        <th class="w30">Date</th>
                                        <th class="w30">Due date</th>
                                        <th class="w30">Invoice No. </th>
                                        <th class="w60">Event</th>
                                        <th class="w10">Go</th>
                                        <th class="w20">Disc Type</th>
                                        <th class="w30">Disc Amount</th>
                                        <th class="w30">Sub Total</th>
                                        <th class="w30">Tax</th>
                                        <th class="w30">Amount</th>
                                        <th class="w30">Paid</th>
                                        <th class="w30">Bal Due</th>
                                        <!-- <th class="w20">Pay</th> -->
                                        <th class="w30">Tax Rate</th>
                                        <th class="w30">User</th>
                                    </tr>
                                </thead>
                                <tbody class="purchaselist">  </tbody>                           
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-default secondblock_bg">
                <div class="box-header with-border">
                    <p class="uhead2">Items</p>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>                
                
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin fixed_table ">
                            <thead>
                                <tr>
                                    <th class="w70">Quantity</th>
                                    <th class="w250">Item</th>
                                    <th class=" ">Description</th>
                                    <th class="w100">Amount</th>
                                    <th class="w100">Total</th>
                                    <th class="w100">Taxable</th>
                                    <th class="w100">Action</th>
                                </tr>
                            </thead>
                            <tbody class="purchaseItems">  </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="box box-default collapsed-box thirdblock_bg">
                <div class="box-header with-border">
                    <p class="uhead2">Payments</p>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Reciept</th>
                                    <th>Type</th>
                                    <th>CheckNum</th>
                                    <th>Desc</th>
                                    <th>Amount</th>
                                    <th>Credit</th>
                                    <th>Username</th>
                                    <th>Modes</th>
                                    <th>Deposit</th>
                                </tr>
                            </thead>
                        <tbody>
                        <tr>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="box box-default collapsed-box fourthblock_bg">
                <div class="box-header with-border">
                  <p class="uhead2">Tracking</p>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin">
                      <thead>
                        <tr>
                          <th>Payment</th>
                          <th>Date</th>
                          <th>Reciept</th>
                          <th>Type</th>
                          <th>CheckNum</th>
                          <th>Desc</th>

                          <th>Amount</th>
                          <th>Credit</th>
                          <th>Username</th>
                          <th>Modes</th>
                          <th>Deposit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


    <script>

        function updateItem(id)
        {
            var qty = $(".qty"+id).val();
            var additem = $(".additem"+id).val();
            var description = $(".description"+id).val();
            var amt = $(".amt"+id).val();
            var taxble = $(".taxble"+id).val();
            var purchaseId = $(".purchaseId").val();
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/PurchageUpdateItem'); ?>",
                data: {id:id, qty:qty, additem:additem, description:description, amt:amt, taxble:taxble},
                dataType: 'html',
                success: function(data)
                {
                    //purchaseRow(data);
                    //$('.remove'+id).remove();
                    //purchaseRow(purchaseId);
                }
            }); 
            purchaseRow(purchaseId);

        }

        function deletePurchageItem(id)
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/deletePurchageItem'); ?>",
                data: {id:id},
                dataType: 'html',
                success: function(data)
                {
                    $('.remove'+id).remove();
                    //purchaseRow(purchaseId);
                    var purchaseId = sessionStorage.getItem("purchaseId");
                    purchaseRow(purchaseId);
                }
            }); 
        }

        function additem(purchaseId)
        {            
            var event = $(".additem").val();
            var qty = $(".qty").val();   

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/purchaseAddItems'); ?>",
                data: {event:event, qty:qty, purchaseId:purchaseId},
                dataType: 'html',
                success: function(data)
                {
                    purchaseRow(purchaseId);
                }
            });

        }

        var purchaseId = sessionStorage.getItem("purchaseId");
        if(purchaseId > 0)
        {
            purchaseRow(purchaseId);
        }

        function purchaseRow(id)
        {
            console.log(id);
            sessionStorage.setItem("purchaseId", id);
            $('.yellow').css("background-color","#ffffff");
            $('.yellow'+id).css("background-color","#f1eea0");

            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/purchaseItems')?>",
                data: {purchaseId:id},
                dataType: 'html',
                success: function(data)
                {
                    $('.purchaseItems').html(data);
                    calculatePurchaseRow(id);
                }
            });
        }
        
        function calculatePurchaseRow(id)
        {
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/calculatePurchaseRow')?>",
                data: {purchaseId:id},
                dataType: 'html',
                success: function(data)
                {
                    loadpurchaselist();
                    
                }
            });

        }

        function myInput(id)
        {
            var boxinput = '<input type="text" class="form-control mypaid'+id+'" placeholder="$0.00" onblur="PaidListUpdate('+id+')">';
            $('.myInput'+id).replaceWith(boxinput);  
        }            
        
        function PaidListUpdate(id)
        {
            var mypaid = $('.mypaid'+id).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/PaidListUpdate'); ?>",
                data: {paid : mypaid, id:id},
                dataType: 'html',
                success: function(data)
                {
                    loadpurchaselist();
                }
            });
        }

        function loadlist()
        {
            var vendorId = $('#searc').val();
            sessionStorage.setItem("vendorId", vendorId);
            deletevendor(vendorId);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/setsession'); ?>",
                data: {vendorId : vendorId},
                dataType: 'html',
                success: function(data)
                {
                    loadpurchaselist();
                }
            });
        }

        loadpurchaselist();

        function loadpurchaselist()
        {
            var vendorId = "<?=$vendorId?>";
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/loadpurchaselist')?>",
                data: {vendorId : vendorId},
                dataType: 'html',
                success: function(data)
                {
                    $('.purchaselist').html(data);

                    var purchaseId = sessionStorage.getItem("purchaseId");
                    $('.yellow').css("background-color","#ffffff");
                    $('.yellow'+purchaseId).css("background-color","#f1eea0");
                }
            });
        }

        function ListUpdate(id)
        {
            var mydate = $(".mydate"+id).val();
            var event = $(".event"+id).val();
            var discType = $(".discType"+id).val();
            var discAmt = $(".discAmt"+id).val();
            var taxrate = $(".taxrate"+id).val();
            
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/PurchaseListUpdate')?>",
                data: 
                {
                    taxrate : taxrate, 
                    mydate : mydate, 
                    event : event, 
                    discType : discType, 
                    id : id,
                    discAmt : discAmt
                },
                dataType: 'html',
                success: function(data)
                {
                    loadpurchaselist();
                    //$('.purchaselist').html(data);
                }
            });
        }
      

        $(document).ready(function()
        {
            $("body").on("keydown", ".mydate", function(event)
            {
                var key = event.keyCode;
                var temp_edate =  $(this).parents(".mypurchase").find(".mydate");

                if(key=="107" || key=="187")
                {
                    var dtpls;
                    if(temp_edate.val()=="")
                    {
                        dtpls = new Date();
                    }
                    else
                    {
                        dtpls = new Date(temp_edate.val());
                    }

                    dtpls.setDate( dtpls.getDate() + 1 );
                    var mm = dtpls.getMonth() + 1;
                    if(mm <10)
                    {
                        mm = "0"+mm;
                    }

                    var dd =  dtpls.getDate();
                    if(dd <10)
                    {
                        dd = "0"+dd;
                    }

                    var yyyy =  dtpls.getFullYear();
                    var today = mm + '/' + dd + '/' +  yyyy;
                    var today1 = yyyy + '/' + mm + '/' +  dd;

        
                    temp_edate.val(today);
                    event.preventDefault();
                }
                else if(key=="109" || key=="189")
                {
                    var dtmns;
                    if(temp_edate.val()=="")
                    {
                        dtmns = new Date();
                    }
                    else
                    {
                        dtmns = new Date(temp_edate.val());
                    }

                    dtmns.setDate( dtmns.getDate() - 1 );
                    var mm = dtmns.getMonth() + 1;
                    if(mm < 10)
                    {
                        mm = "0"+mm;
                    }

                    var dd =  dtmns.getDate();
                    if(dd < 10)
                    {
                        dd = "0"+dd;
                    }

                    var yyyy =  dtmns.getFullYear();
                    var today = mm + '/' + dd + '/' +  yyyy;
                    var today1 = yyyy + '/' + mm + '/' +  dd;

            
                    temp_edate.val(today);

                    event.preventDefault();
                }
                else if(key=="68")
                {

                    today = '<?php echo date("m/d/Y"); ?>';
                    temp_edate.val(today);
                    today1= '<?php echo date("Y/m/d"); ?>';
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