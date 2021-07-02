<div class="container-fluid">
<div class="row">
  <!-- <div class="col-sm-12">
        <a href="#" class="profilebtn">save profile </a>
    </div> -->
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

</div>
<div class="ibox-title">
  <h5>User Profile
    </h5>
    <!-- <a href="<?= site_url('fi_home/registration')?>" class="btn btn-primary btn-sm pull-right ">Add Driver</a> -->
</div>

<div class="panel">
<div class="panel-body">

<div class="row">

  <!-- <?php echo form_open_multipart('fi_home/do_upload');?>
  <div class="col-sm-2 padding-20">

      <img  src="<?php echo base_url('assets/'.$user_data['profile_img']);?>" class="img-responsive">

      <div class="text-center">

        <input name="showChangeAvatarButton" type="file" class="margin-top-5 btn btn-xs">
        <button id="showChangeAvatarButton"  class="margin-top-5 btn btn-xs btn-info">change avatar</button>
      </div>
  </div>
</form> -->


      <?php echo form_open_multipart('fi_home/profileupdate', array("id"=> "form_admin_profile","name"=>"form_admin_profile"));?>
    <div class="col-sm-8">
<!-- <?php print_r($user_data) ?> -->
        <!-- Name -->
        <div class="form-group">
            <label class="control-label">Full Name</label>
            <div class="row">
                <div class="col-xs-6">
                    <input name="firstName" type="text" class="form-control" placeholder="" data-validate-required="true" data-validate-required-msg="First Name is required" value="<?php echo $user_data[0]['name']; ?>">
                </div>
                <input name="id" type="hidden" value="<?php echo $user_data[0]['id']; ?>">
            </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <div class="col-xs-6">
            <label class="control-label">Email Address</label>
            <input name="email" type="email" class="form-control" data-validate-email="true" data-validate-email-msg="Email address is invalid" value="<?php echo $user_data[0]['email']; ?>">
        </div>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label class="control-label">Mobile Phone</label>
                    <input name="mobilePhone" type="text" min="10" class="form-control" value="<?php echo $user_data[0]['mobile_no']; ?>">
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-xs-6">

                <!-- Password -->
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input name="password" id="password" type="password" class="form-control" data-validate-min-length="8"
                    data-validate-min-length-msg="Password must be at least 8 characters"
                    data-validate-matches="confirmPassword"
                    data-validate-matches-msg="Passwords do not match" value="<?php echo base64_decode($user_data[0]['password']);?>">
                </div>

            </div>
            <div class="col-xs-6">

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="control-label">Confirm Password</label>
                    <input name="cpass" type="password" class="form-control" data-validate-min-length="8" data-validate-min-length-msg="Password must be at least 8 characters"
                    data-validate-matches="password" data-validate-matches-msg="Passwords do not match" value="<?php echo base64_decode($user_data[0]['password']);?>">
                </div>

            </div>

            <div class="form-group">

          <label class="control-label">Change Profile Image:</label>
          <input name="image" type="file" class="margin-top-5 btn btn-xs">
              <!-- <button id="showChangeAvatarButton"  class="margin-top-5 btn btn-xs btn-info">change avatar</button> -->
            </div>
        </div>
        <div class="row">
            <input type="submit" class="btn btn-primary btn-sm" value="save profile" id="btnsbt" name="login">
        </div>
    </div>
</form>
</div>

</div>
</div>



</div>
