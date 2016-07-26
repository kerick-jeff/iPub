<?php $__env->startSection('title', '| Settings'); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('js/countrytel/build/css/intlTelInput.css')); ?>" media="screen" title="no title" charset="utf-8">
<style media="screen">
  #profile {
    width: 100%;
    height: 200px;
    cursor: pointer;
  }

  @media (max-width: 767px) {
    #profile {
      width: 100%;
      height: 250px;
      cursor: pointer;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>Settings</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
  <div class="col-md-12">
    <!-- settings/pin -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class = "fa fa-cogs">&nbsp;Settings/Configurations</h3>
        <!-- /.user-block -->
        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
            <div class="col-md-3">
              <!-- change profile picture form -->
              <form action="/settings/profile-picture" method="POST" enctype = "multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <strong><i class = "fa fa-camera"></i>&nbsp; Profile Picture </strong>
                <div class="form-group has-feedback">
                   <img id = "profile" class="img-responsive img-thumbnail" src="<?php echo e(url('/profilePicture')); ?>" onclick = "fiopen()" alt="User profile picture" title = "Click to change profile picture">
                   <input type="file" id = "file" name="profile_picture" style = "width: 100%">
                   <?php if($errors->has('profile_picture')): ?>
                       <span class="help-block" style = "color: #DD4B39 !important;;">
                           <strong><?php echo e($errors->first('profile_picture')); ?></strong>
                       </span>
                   <?php endif; ?>
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" class = "btn btn-primary btn-block" title = "Click to change your profile picture">Change profile picture</button>
                </div>
              </form>
              <hr />

              <!-- set phone contact -->
              <form action = "/settings/phone-number" method = "POST">
                <?php echo e(csrf_field()); ?>

                <strong><i class = "fa fa-phone"></i>&nbsp; Phone Contact </strong>
                <div class="form-group has-feedback">
                  <input type="tel" id = "phone" class="form-control" name="phone_number" placeholder = "<?php echo e(Auth::user()->phone_number); ?>">
                  <?php if($errors->has('phone_number')): ?>
                      <span class="help-block" style = "color: #DD4B39 !important;;">
                          <strong><?php echo e($errors->first('phone_number')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" class = "btn btn-primary btn-block" title = "Set your phone number">Set phone number</button>
                </div>
              </form>
              <hr />

              <!-- security form -->
              <form action = "settings/security" method = "POST">
                <strong><i class = "fa fa-lock"></i>&nbsp; Security </strong>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password" placeholder="Enter old password">
                  <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password" placeholder="Enter new password">
                  <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type new password">
                  <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <button type="button" class = "btn btn-primary btn-block" title = "Change your password">Change your password</button>
                </div>
              </form>
              <hr />
            </div>

            <div class="col-md-9">
              <!-- location form -->
              <form action="/settings/location" method="POST">
                <div class="form-group has-feedback">
                  <strong><i class = "fa fa-map-marker"></i> Location </strong>
                  <p> Hint: You can set your location by either choosing the longitude and latitude of your location or by finding your location on the map and clicking on set. </p>
                  <textarea class="form-control" rows="8" placeholder="Map"></textarea>
                </div>
                <div class="form-group has-feedback" style = "display: inline-block; width: 49%;">
                  <strong>Longitude</strong>
                  <input type="number" class = "form-control" name="longitude" value = "180" min = "1" max = "360">
                </div>
                <div class = "form-group has-feedback" style = "display: inline-block; width: 50%;">
                  <strong>Latitude</strong>
                  <input type="number" class = "form-control" name="latitude" value="180" min = "1" max = "360">
                </div>
                <div class="form-group has-feedback">
                  <input type="submit" name="location" class = "btn btn-primary" value="Set">
                </div>
              </form>
              <hr />

              <!-- description form -->
              <form action="/settings/description" method="POST">
                <div class="form-group has-feedback">
                  <strong><i class = "fa fa-file-text"></i> Description </strong>
                  <textarea class="form-control" rows="8" placeholder="Hint: Provide accurate description about what you (organisation, company, individual, NGO or business) do, how you operate, products you sell or give out and the services you offer."></textarea>
                </div>
                <div class="form-group has-feedback">
                  <input type="submit" class = "btn btn-primary" name="save" value="Save">
                </div>
              </form>
              <hr />
            </div>
          </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/countrytel/build/js/intlTelInput.js"></script>
<script type="text/javascript">
    $("#phone").intlTelInput({
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        initialCountry: "auto",
        numberType: "MOBILE",
        nationalMode: true,
        autoPlaceholder: true,
        separateDialCode: true,
        utilsScript: "js/countrytel/build/js/utils.js"
    });

    $("form").submit(function(){
        var p = phone_number.val(phone_number.intlTelInput("getNumber"));
        alert();
    });

    function fiopen(){
       document.getElementById('file').click();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>