

<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Event Management </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Vendor</a></li>
                <li class="active"><?=$page_title?></li>
            </ol>
        </section>
        <?php $this->load->view('template/alert'); ?>     
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info vendor_sec titlen_search">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-sm-5 col-md-4">
                                    <h3 class="uhead1"> <?=$page_title?> </h3>
                                </div>
                                <div class="col-sm-7 col-md-8">
                                    <div class="pull-right">
                                        <ul class="list-inline topul">
                                            <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                                            <li><a href="#" class="uhead2"> Options </a></li>
                                            <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>
                                        </ul>
                                        <a href="<?=base_url('Vendor/GeneralInfo')?>" class="btn btn-md btn-info btn-flat">New Vendor</a>
                                        <a id="deletevendor" href="<?=base_url('Vendor/Delete/'.$vendorId)?>" class="btn btn-md btn-danger btn-danger">Delete Vendor</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <div class="row space3">
                                <div class="col-md-3">                                    
                                    <div class="form-group">
                                        <select class="form-control" id="searc" onchange="loadlist()">
                                        <option value="0" >Choose</option>
                                        <?php 
                                        
                                        $vendorId = $this->session->userdata('vendorId');
                                        foreach ($venders as $cust) 
                                        {  
                                            
                                            $select = "";
                                            if($vendorId == $cust['cus_id'])
                                            {
                                                $select = "selected";
                                            }
                                            ?>
                                            <option value="<?=$cust['cus_id']?>" <?=$select?>><?=$cust['cus_lname']?> <?=$cust['cus_fname']?>, <?=$cust['cus_company_name']?></option>
                                            <?php 
                                        } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"  id="contact_info" >
                                        <input style="" class="form-control" type="text" placeholder="(000)000-0000" value="<?=$contact_no?>" >
                                    </div>
                                </div>
                                
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <input style="text-align: right;" id="cus_acc_no" class="form-control" placeholder="0000000" type="text" value="<?=str_pad($vendorId, 7, '0', STR_PAD_LEFT)?>">
                                    </div>
                                </div>                              
                 
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <?php 
                                        if($balence != "")
                                        {
                                            $balence = '0.00';
                                        }
                                        ?>
                                        <input style="text-align: right;" id="balance" class="form-control" type="text" placeholder="$0.00" value="$<?=$balence?>">
                                    </div>
                                </div>
                                
                                <div class="col-sm-1">
                                    <!--<button class="btn btn-xs btn-primary btn-flat">Save</button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    function deletevendor(id)
                    {
                        document.getElementById("deletevendor").href="<?=site_url('Vendor/Delete/')?>"+id; 

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('Vendor/getSearchVendContactInfo'); ?>",
                            data: {name : id},
                            dataType: 'html',
                            success: function(data)
                            {
                                if(data!="")
                                {
                                    $('#contact_info').html(data);
                                }
                                else
                                {
                                    $('#contact_info').html(data);
                                }
                            }
                        });
                        
                        $('#cus_acc_no').val("0000000"+id); 

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('Vendor/getSearchVendbalance'); ?>",
                            data: {name : id},
                            dataType: 'html',
                            success: function(data)
                            {
                                if(data!="")
                                {
                                    $('#balance').val(data);
                                }
                                else
                                {
                                    $('#balance').val(data);
                                }
                            }
                        });
                    }
                    </script>