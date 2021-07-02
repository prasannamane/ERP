<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h3>Driver Registraion
						<a href="<?=site_url('fi_home/listdriver')?>" class="btn btn-outline btn-primary pull-right">View Driver</a>
					</h3>
					<div class="ibox-tools">
					</div>
				</div>
				
				<img src="">
				<div class="se-pre-con"></div>
				<div class="ibox-content form-horizontal ">
					<!-- <?php echo form_open_multipart('fi_home/adddriver');?> -->
					    <?php echo form_open_multipart('fi_home/adddriver', array("id"=> "dform","name"=>"driver_register"));?>
					<!-- <form action="<?=site_url('fi_home/adddriver')?>" method="POST" id="dform"> -->
					<div class="form-group"><label class="col-sm-2 control-label">Driver Name</label>
						<div class="col-sm-6">
							<input type="text" id="coupen_code" name="d_name" class="form-control" placeholder="Enter Full Name" required="true" >
						</div>
					</div>
          <div class="hr-line-dashed"></div>
          <div class="form-group"><label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
              <input type="text" placeholder="Enter Email id " class="form-control" name="d_email" id="email">
            </div>
          </div>
					<div class="hr-line-dashed"></div>
					<div class="form-group"><label class="col-sm-2 control-label">Mobile no</label>
						<div class="col-sm-6">
							<input type="text" placeholder="Enter Mobile No" class="form-control" required="true" name="d_mobile">
						</div>
					</div>
					<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-2 control-label">Address</label>
							<div class="col-sm-6">
								<textarea class="form-control" required="true" name="d_address" placeholder="Enter Address" required="true"></textarea>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">City</label>
								<div class="col-sm-6">
								<input type="text" placeholder="Enter City" class="form-control" required="true" name="d_city" required="true">
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
