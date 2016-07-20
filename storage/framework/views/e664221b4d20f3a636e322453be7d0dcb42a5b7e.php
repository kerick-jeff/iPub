<?php $__env->startSection('title', 'Registration'); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('js/countrylist/build/css/countrySelect.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/countrylist/build/css/demo.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p class="login-box-msg">Register</p>

    <form method="POST" action="<?php echo e(url('/register')); ?>">
        <?php echo e(csrf_field()); ?>

      <div class="form-group has-feedback  <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="Name of Individual, Organisation, Business or Company">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php if($errors->has('name')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('name')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback  <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php if($errors->has('email')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback  <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
        <input type="password" class="form-control" name="password" placeholder="Atleast 8 characters." placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php if($errors->has('password')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback <?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <?php if($errors->has('password_confirmation')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback">
          <select class="form-control" name="category">
            <option value="individual">Individual</option>
            <option value="organisation">Organisation</option>
            <option value="business">Business</option>
            <option value="company">Company</option>
            <option value="ngo">NGO</option>
          </select>
      </div>
      <div class="form-group has-feedback">
          <input type="text" id = "country" name="country" class="form-control " placeholder="country">
          <input type="hidden" name="country_code">

          <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
          <script src="<?php echo e(asset('js/countrylist/build/js/countrySelect.js')); ?>"></script>
          <script type="text/javascript">
              $("#country").countrySelect({
                preferredCountries: ['us', 'gb', 'cm'],
              });
          </script>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
              <input type="checkbox" name = "terms"> I agree to the <a href="#">terms and conditions</a>
              <?php if($errors->has('terms')): ?>
                  <span class="help-block" style = "color: #DD4B39 !important;;">
                      <strong><?php echo e($errors->first('terms')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="<?php echo e(url('/login')); ?>" class="text-center">I already have a membership</a>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>