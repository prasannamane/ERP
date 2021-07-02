<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h3>Customer Registraion
						<a href="<?=site_url('fi_home/listuser')?>" class="btn btn-outline btn-primary pull-right">View Customer</a>
					</h3>
					<div class="ibox-tools">
					</div>
				</div>
				
				<img src="">
				<div class="se-pre-con"></div>
				<div class="ibox-content form-horizontal ">
					<!-- <?php echo form_open_multipart('fi_home/addcustomer');?> -->
					<!-- <form action="<?=site_url('fi_home/addcustomer')?>" method="POST" id="cform"> -->
            <?php echo form_open_multipart('fi_home/addcustomer', array("id"=> "cform","name"=>"cus_register"));?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Customer Name</label>
						<div class="col-sm-6">
							<input type="text" id="coupen_code" name="c_name" class="form-control" placeholder="Enter Full Name">
						</div>
					</div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
              <input type="text" placeholder="Enter Email id " class="form-control" name="c_email" id="email">
            </div>
          </div>
					<div class="hr-line-dashed"></div>
					<div class="form-group"><label class="col-sm-2 control-label">Mobile no</label>
						<div class="col-sm-6">
							<input type="text" placeholder="Enter Mobile No" class="form-control" required="true" name="c_mobile">
						</div>
					</div>
					<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-2 control-label">Address</label>
							<div class="col-sm-6">
								<textarea class="form-control" required="true" name="c_address" placeholder="Enter Address"></textarea>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-2 control-label">City</label>
								<div class="col-sm-6">
								<input type="text" placeholder="Enter City" class="form-control" required="true" name="c_city">
						</div>
					</div>
          	<div class="hr-line-dashed"></div>
					       <div class="form-group">
                   <label class="col-sm-2 control-label">Select Profile Image:</label>
                   <input name="image" type="file" class="margin-top-5 btn btn-xs">
              </div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button class="btn btn-outline btn-primary pull-left" type="submit" name="submit">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="pull-right">
		</div>
		<div>
			<!-- <strong>Copyright</strong> -->

		</div>
	</div>
</div>
</div>
