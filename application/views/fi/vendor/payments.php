                        <?php $this->load->view('fi/vendor/select_vendor'); ?>
              
              <div class="box box-default firstblock_bg">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover no-margin">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Payments</th>
                              <th>Date</th>
                              <th>Reciept</th>
                              <th>Account</th>
                              <th>Type</th>
                              <th>Check Num</th>
                              <th>Desc</th>
                              <th>Amount</th>
                              <th>Credit</th>
                              <th>Date Cleared</th>
                              <th>Username</th>
                              <th>Modes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                             <td>1</td>
                              <td>2301</td>
                              <td></td>
                              <td>
                                <select class="form-control">
                                  <option>Select</option>
                                </select>
                              </td>
                              <td>
                                <select class="form-control">
                                  <option>Select</option>
                                </select>
                              </td>
                              <td>906</td>
                              <td></td>
                              <td></td>
                              <td>$800</td>
                              <td></td>
                              <td></td>
                              <td>Levi</td>
                              <td></td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th colspan="13">
                                <div class="pull-right">
                            <span class="text-info">Total Selected </span>
                            <input type="text" name="">
                          </div>
                          </th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
            </div><div class="col-md-6">
              <div class="box box-default secondblock_bg">
                <div class="box-body">
                      <div class="table-responsive">
                        <table class="table table-hover no-margin">
                          <thead>
                            <tr>
                              <th>Purchase</th>
                              <th>Event</th>
                              <th>Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                             <td>1</td>
                             <td></td>
                              <td>2301</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
            </div>
           <div class="col-md-6">
              <div class="box box-default secondblock_bg">
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hover no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Category</th>
                          <th>Sub Category</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
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
        function loadlist()
        {
            var name = $('#searc').val();
            sessionStorage.setItem("vendorId", name);
            deletevendor(name);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Vendor/setsession'); ?>",
                data: {vendorId : vendorId},
                dataType: 'html',
                success: function(data)
                {
                }
            });
        }
    </script>