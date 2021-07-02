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
					<a data-toggle="modal" class="btn btn-warning pull-right m-t-n btn-sm" href="#modal-form">Add Sub-Category Data</a>
			</div>

			<div class="se-pre-con"></div>
			<div class="ibox" >
				<h3>All Category</h3>
				<div class="table-responsive col-md-4">
					<table class="table table-striped" style="background:white;">
						<thead>
							<tr>
								<th>Id </th>
								<th>Cat Name</th>
							</tr>
						</thead>
						 <tbody>
							<?php $i=1;foreach ($category as $cat){?>
								<tr>
									<td><?=$i++; ?></td>
									<td><?= ucfirst($cat['name'])?></td>
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
<div id="modal-form" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12"><h1 class="m-t-none m-b">Add User</h1>
						<form role="form" action="" method="POST">
							<div class="form-group"><label>Full Name</label> <input type="text" placeholder="Enter Full Name" class="form-control" required="" name="full_name"></div>
							<div class="form-group"><label>Email</label> <input type="email" id="email_id" placeholder="Enter Email" class="form-control" required="" name="email"></div>
							<div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control" required="" name="pwd"></div>
							<div class="form-group"><label>Mobile No</label> <input type="text" placeholder="Enter Mobile No" class="form-control" required="" name="mobile_no"></div>
							<div class="form-group"><label>Location</label> <input type="text" placeholder="Enter Location" class="form-control" required="" name="location"></div>
							<div>
								<button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
							</div>
						</form>
					</div>
					<!-- <div class="col-sm-6"><h4>Not a member?</h4>
						<p>You can create an account:</p>
						<p class="text-center">
							<a href=""><i class="fa fa-sign-in big-icon"></i></a>
						</p>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
