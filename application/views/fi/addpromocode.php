<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">

		<div class="col-lg-12">

			<div class="ibox float-e-margins">

				<div class="ibox-title">

					<h3>Create New Promocode

						<a href="<?=site_url('fi_home/listpromocode')?>" class="btn btn-outline btn-primary pull-right">View Promocode</a>

					</h3>

					<div class="ibox-tools">

					</div>

				</div>

				<img src="">

				<div class="se-pre-con"></div>

				<div class="ibox-content form-horizontal ">

					<!-- <?php echo form_open_multipart('fi_home/addcustomer');?> -->

					<form action="<?=site_url('fi_home/addpromo')?>" method="POST" id="pform">
					<div class="row">
                    	<div class="col-sm-8">
					<div class="form-group">

						<label class="col-sm-4 control-label">Code Name</label>

						<div class="col-sm-6">

							<input type="text" id="coupen_code" name="p_name" class="form-control">

						</div>

					</div>

          <div class="hr-line-dashed"></div>

          <div class="form-group">

            <label class="col-sm-4 control-label">Code Type</label>

            <div class="col-sm-6">

              <select name="p_type" class="form-control">

                <option value="">Select...</option>

                <option value="1">Amount</option>

                <option value="2">Percent</option>

              </select>

            </div>

          </div>

					<div class="hr-line-dashed"></div>

					<div class="form-group"><label class="col-sm-4 control-label">Discount</label>

						<div class="col-sm-6">

							<input type="number" min="0" class="form-control" required="true" name="p_discount">

						</div>

					</div>

					<div class="hr-line-dashed"></div>

						<div class="form-group"  id="data_1">

              <label class="col-sm-4 control-label">Expiration Date</label>
			<div class="col-sm-6">
              <div class="input-group date">

            <span class="input-group-addon">

              <i class="fa fa-calendar"></i>

            </span><input type="text" name="p_date" class="form-control" value="">

            </div>
				</div>
						</div>





							<div class="hr-line-dashed"></div>

							<div class="form-group">

								<div class="col-sm-4 col-sm-offset-2">

									<button class="btn btn-outline btn-primary pull-left" type="submit" name="submit">Submit</button>

								</div>

							</div>
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

