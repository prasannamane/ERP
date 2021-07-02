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
				<h5>View All Rides
					</h5>
					<!-- <a href="<?= site_url('fi_home/registration')?>" class="btn btn-primary btn-sm pull-right ">Add Driver</a> -->
						<!-- <a href="<?= site_url('fi_home/viewadvbooking')?>" class="btn btn-warning btn-sm pull-right m-r-sm">View Advanced Booking</a> -->
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
								<th>Driver Name</th>
								<th>Set Location</th>
								<th>Drop Location</th>
								<th>Date / Time</th>
								<!-- <th>City</th>
								<th>Registration Date</th>
								<th>Status</th>
								<th>Operation</th> -->
							</tr>
						</thead>
						 <!-- <tbody>
							<?php $i=1;
              foreach ($all_driver as $driver)

              {?>
								<tr>
									<td><?=$i++; ?></td>
									<td><?= ucfirst($driver['driver_name']) ?></td>
									<td><?= $driver['driver_email']; ?></td>
									<td><?= $driver['driver_phone']; ?></td>
									<td><?= $driver['driver_address']; ?></td>
									<td><?= $driver['driver_city']; ?></td>
									<td><?= $driver['driver_reg_date']; ?></td>
									<td><?php if($driver['driver_active']==1){echo "Active";}else{echo "Deleted Driver";}?></td>
									<td>
								<a href="<?=site_url('fi_home/edit_driver/'.$driver['driver_id'])?>" class ="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>
								<a href="<?=site_url('fi_home/deletedriver/'.$driver['driver_id'])?>" onclick="return confirm('Are you sure want to Delete Customer..??')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
								</td>
								</tr>
						        <?php }?>
							</tbody> -->
              <tbody>
                <tr>
									<td>1</td>
									<td>Mike Tayler</td>
									<td></td>
									<td></td>
									<td></td>

								<!-- <a href="<?=site_url('fi_home/edit_driver/'.$driver['driver_id'])?>" class ="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a> -->
								<!-- <a href="<?=site_url('fi_home/deletedriver/'.$driver['driver_id'])?>" onclick="return confirm('Are you sure want to Delete Customer..??')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a> -->

								</tr>

              </tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
