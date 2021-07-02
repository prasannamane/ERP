
            <?php $this->load->view('fi/vendor/select_vendor'); ?>
        </div>
        
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default firstblock_bg">
                            <div class="table-responsive" id="myevents">
                                <div class="box-header with-border">
                                    <p class="uhead2">Events</p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="box-body"> 
                                    <table class="table fixed_table  table-hover no-margin">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%;"> Event Type</th>
                                                <th style="width: 25%;">Name</th>
                                                <th style="width: 25%;">Date</th>
                                                <th style="width: 25%;">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody class="GetEvent"> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Locations -->
                    <div class="col-md-12">
                        <div class="box box-default secondblock_bg">
                            <div class="box-header with-border">
                                <p class="uhead2">Locations</p>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive" id="mylocation">
                                    <table class="table table-hover no-margin">
                                        <thead>
                                            <tr>
                                                <th style="width:9%">Location</th>
                                                <th style="width:9%">Date</th>
                                                <th style="width:14%">Time</th>
                                                <th style="width:10%">Address</th>
                                                <th style="width:9%">City</th>
                                                <th style="width:9%">State</th>
                                                <th style="width:9%">Zip</th>
                                                <th style="width:9%">Phone </th>
                                                <th style="width:9%"><i class="fa fa-map-marker" aria-hidden="true"></i></th>
                                                <th style="width:14%">Notes</th>
                                            </tr>
                                        </thead>
                                        <thead class="GetLocation"></thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <div  class="fadeMe" > 
        <div id="loader" class="loader"></div> 
    </div>
    
    <button style="display: none;" type="button" id="btnmodal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Event Note</h4>
                </div>
      
                <div class="modal-body">
                    <textarea class="form-control" id="setmodalnotes" cols="" rows="10"></textarea>
                    <input type="hidden" name="hdnnoteval" id="hdnnoteval" class="hdnnoteval">
                </div>
      
                <div class="modal-footer">
                    <button type="button" onclick="fnclosemodal()" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
        $(document).ready(function()
        {
            var vendorId = <?=$vendorId?>;
            sessionStorage.setItem("vendorId", vendorId);
            deletevendor(vendorId);
            $.ajax({
                type: 'POST',
                url: '<?=site_url('Vendor/GetEvent')?>', 
                data: {vendorId:vendorId},
                dataType: 'text',
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                    $(".GetEvent").empty();
                },
                success: function(data) 
                {
                    $('.fadeMe').hide();
                    $(".GetEvent").append(data);
                },
                error: function(xhr) 
                {   

                },
                complete: function() 
                {
                }
            });
        });
    </script>

    <script type="text/javascript">

        function loadlist()
        {
            var vendorId = $('#searc').val();
            sessionStorage.setItem("vendorId", vendorId);
            deletevendor(vendorId);
           
            $.ajax({
                type: 'POST',
                url: '<?=site_url('Vendor/GetEvent')?>', 
                data: {vendorId:vendorId},
                dataType: 'text',
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                    $(".GetEvent").empty();
                },
                success: function(data) 
                {
                    $('.fadeMe').hide();
                    $(".GetEvent").append(data);
                },
                error: function(xhr) 
                {   

                },
                complete: function() 
                {
                }
            });
        }

        function getlocation(id)
        {
            $(".bg").css("background-color", "white");
            $(".bg"+id).css("background-color", "#f1eea0");
            var EventId = id;

            $.ajax({
                type: 'POST',
                url: '<?=site_url('Vendor/GetLocation')?>', 
                data: {EventId:EventId},
                dataType: 'text',
                beforeSend: function() 
                {
                    $('.fadeMe').show();
                    $(".GetLocation").empty();
                },
                success: function(data) 
                {
                    $('.fadeMe').hide();
                    $(".GetLocation").append(data);
                },
                error: function(xhr) 
                {   

                },
                complete: function() 
                {
                }
            });

        }
    </script>