<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<?php  if(isset($success)) { ?>
			        <div class="alert alert-success" role="alert">
			            <a class="close" data-dismiss="alert" href="#"><i class="fa fa-check fa-fw"></i></a>
			            <?=$success?>
			        </div>
			<?php } ?>
            
			<?php if(isset($error)) { ?>
			        <div class="alert alert-danger" role="alert">
			            <a class="close" data-dismiss="alert" href="#"><i class="fa fa-times fa-fw"></i></a>
			            <?=$error?>
			        </div>
			<?php } ?>

			<?php if(isset($alert)) {
			        echo $alert;
			} ?>
			<div class="ibox-title">
				<h5>View All Promocode
					</h5>
					<a href="<?= site_url('fi_home/newpromocode')?>" class="btn btn-outline btn-primary pull-right ">Add Promocode</a>
			</div>

			<div class="se-pre-con"></div>
			<div class="ibox-content">
				<div class="row">
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
								<th>Id </th>
								<th>Code Name</th>
								<th>Code Type</th>
								<th>Discount</th>
								<th>Expiration</th>
								<th>Status</th>
								<th>Operation</th>
								<th>Delete</th>
							</tr>
						</thead>
						 <tbody>
							<?php $i=1;
              foreach ($promocode as $promo)
              // print_r($promo);
              {?>
								<tr>
									<td><?=$i++; ?></td>
									<td><?= ucfirst($promo['promo_name']) ?></td>
                  <?php
                  if ($promo['promo_type']==1)
                  {  ?>
                  <td>Amount</td>
                <?php  }
                else {  ?>
                  <td>Percent</td>
              <?php  }
                   ?>
									<td><?= $promo['promo_discount'];?></td>
									<td><?= $promo['promo_exp'];?></td>
                  <?php
                  if ($promo['promo_status']==1)
                  {  ?>
                  <td>Active</td>
                <?php  }
                else {  ?>
                  <td>Deactive</td>
              <?php  }
                   ?>
									<td>
								<a href="<?=site_url('fi_home/edit_promo/'.$promo['promo_id'])?>" class ="btn btn-outline btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
								<?php
								if ($promo['promo_status']==1) {  ?>
									<a href="<?=site_url('fi_home/deactive_promo/'.$promo['promo_id'])?>" onclick="return confirm('Are you sure want to Deactivate Promocode..??')" class ="btn btn-outline btn-info btn-xs"><i class="fa fa-remove"></i> Deactive</a>
									</td>
							<?php	}

								else
								{  ?>
									<a href="<?=site_url('fi_home/active_promo/'.$promo['promo_id'])?>" class ="btn btn-outline btn-warning btn-xs"><i class="fa fa-check"></i> Active</a>
									</td>
							<?php	}
								 ?>


                <td>
                  <a href="<?=site_url('fi_home/delete_promo/'.$promo['promo_id'])?>" onclick="return confirm('Are you sure want to Delete Promocode..??')" class ="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
              </td>
								</tr>
						        <?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
