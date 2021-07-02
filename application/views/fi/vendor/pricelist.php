<style>
.glyphicon.glyphicon-usd{
    top:-3px;
    margin:0px 0px 0px 0px;
}
</style>
                        <?php $this->load->view('fi/vendor/select_vendor'); ?>                  
                <div class="box box-default firstblock_bg">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table fixed_table  table-hover no-margin">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">Item Name</th>
                                            <th style="width: 17%;">Description</th>
                                            <th style="width: 8%;">Amount</th>
                                            <th style="width: 5%;">Taxable</th>
                                            <th style="width: 40%;">Note</th>
                                            <th style="width: 8%;">Date Entered</th>
                                            <th style="width: 6%;"> User</th>
                                            <th style="width: 6%;"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="pricelist">  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <script>
        function deleteprice(Id)
        {
            var vendorId = sessionStorage.getItem("vendorId");
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/deleteprice')?>",
                data: {Id : Id},
                dataType: 'html',
                success: function(data)
                {
                    $('.remove'+Id).remove();
                    //changepricelist(vendorId);
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
                url: "<?=base_url('Vendor/setsession')?>",
                data: {vendorId : vendorId},
                dataType: 'html',
                success: function(data)
                {
                    changepricelist(vendorId);
                }
            });   
        }
        loadpricelist();
        function loadpricelist()
        {
            var vendorId = <?=$vendorId?>;
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/loadpricelist')?>",
                data: {vendorId : vendorId},
                dataType: 'html',
                success: function(data)
                {
                    $('.pricelist').html(data);
                }
            });
        }
        function changepricelist(vendorId)
        {   
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/loadpricelist')?>",
                data: {vendorId : vendorId},
                dataType: 'html',
                success: function(data)
                {
                    $('.pricelist').html(data);
                }
            });
        }
        function updateprice(id)
        {
            var itemname = $(".itemname"+id).val();
            var description = $(".description"+id).val();
            var amount = $(".amount"+id).val();
            var taxble = 0;
            var mynote = $(".mynote"+id).val();
            //var mydate = $(".mydate"+id).val();
            var vendorId = sessionStorage.getItem("vendorId");
            if ($('.taxble:checkbox:checked').length > 0)
            {
                var taxble = 1;
            }
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/updateprice')?>",
                data: {mynote:mynote, itemname:itemname, description:description, amount:amount, taxble:taxble, id:id},
                dataType: 'html',
                success: function(data)
                {
                    //changepricelist(vendorId);
                }
            });
        }

        function saveprice()
        {           
            var itemname = $(".itemname").val();
            var vendorId = sessionStorage.getItem("vendorId");
            $.ajax({
                type: "POST",
                url: "<?=base_url('Vendor/saveprice')?>",
                data: {itemname : itemname},
                dataType: 'html',
                success: function(data)
                {
                    changepricelist(vendorId);
                }
            });   
        }
</script>