<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h3>Customer Edit
						<a href="<?=site_url('fi_home/listuser')?>" class="btn btn-outline btn-primary pull-right">View Customers</a>
					</h3>
					<div class="ibox-tools">
					</div>
				</div>
				
				<img src="">
				<div class="se-pre-con"></div>
				<div class="ibox-content form-horizontal ">
					  <!-- <form action="<?=site_url('fi_home/editcouponpost/'.$edit[0]['cus_id'])?>" method="POST" id="eform" enctype="multipart/form-data"> -->
              <?php echo form_open_multipart('fi_home/editcus/'.$edit[0]['cus_id'], array("id"=> "eform","name"=>"cus_uregister"));?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Customer Name</label>
						<div class="col-sm-6">
							<input type="text" id="coupen_code" name="e_name" class="form-control" value="<?=$edit[0]['cus_name'] ?>" required="true">
						</div>
					</div>

					<div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
              <input type="text" placeholder="Enter Email id" class="form-control" name="e_email" id="email" value="<?=$edit[0]['cus_email']?>">
            </div>
          </div>
					<div class="hr-line-dashed"></div>
					<div class="form-group"><label class="col-sm-2 control-label">Mobile no</label>
						<div class="col-sm-6">
							<input type="text" placeholder="Enter Mobile No" class="form-control" required="true" name="e_mobile" value="<?=$edit[0]['cus_mobile_no']?>">
						</div>
					</div>
					<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-2 control-label">Address</label>
							<div class="col-sm-6">
								<textarea class="form-control" required="true" name="e_address" placeholder="Enter Address"><?=$edit[0]['cus_address']?></textarea>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
							<div class="form-group"><label class="col-sm-2 control-label">City</label>
								<div class="col-sm-6">
								<input type="text" placeholder="Enter City" class="form-control" required="true" name="e_city" value="<?=$edit[0]['cus_city'] ?>">
						</div>
					</div>
          <div class="hr-line-dashed"></div>
					<div class="form-group">
          <label class="col-sm-2 control-label">Change User Profile Image:</label>
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
