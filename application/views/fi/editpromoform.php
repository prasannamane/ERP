<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h3>Promocode Edit
						<a href="<?=site_url('fi_home/listpromocode')?>" class="btn btn-outline btn-primary pull-right">View Promocode</a>
					</h3>
					<div class="ibox-tools">
					</div>
				</div>
        
				<img src="">
				<div class="se-pre-con"></div>
				<div class="ibox-content form-horizontal ">
					  <!-- <form action="<?=site_url('fi_home/editcouponpost/'.$edit[0]['cus_id'])?>" method="POST" id="eform" enctype="multipart/form-data"> -->
            <form action="<?=site_url('fi_home/editpro/'.$edit[0]['promo_id'])?>" method="POST" id="pform">
            <div class="form-group">
              <label class="col-sm-2 control-label">Code Name</label>
              <div class="col-sm-6">
                <input type="text" id="coupen_code" name="p_name" value="<?=$edit[0]['promo_name']?>" class="form-control">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Code Type</label>
              <div class="col-sm-6">
                <select name="p_type">
                  <option value="">Select...</option>
                  <option value="1" <?php if($edit[0]['promo_type']==1) echo 'selected="selected"';?> >Amount</option>
                  <option value="2" <?php if($edit[0]['promo_type']==2) echo 'selected="selected"';?> >Percent</option>
                </select>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-sm-2 control-label">Discount</label>
              <div class="col-sm-6">
                <input type="number" min="0" class="form-control" value="<?=$edit[0]['promo_discount']?>" required="true" name="p_discount">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
              <div class="form-group"  id="data_1">
                <label class="col-sm-2 control-label">Expiration Date</label>
                <div class="input-group date">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span><input type="text" name="p_date" value="<?=$edit[0]['promo_exp']?>" class="form-control" value="">
              </div>
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
