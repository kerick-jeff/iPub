<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iPub | Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
 <!--        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">       -->
 <link rel="stylesheet" href="<?php echo e(asset('ipub/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!--        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">     -->
  <link rel="stylesheet" href="<?php echo e(asset('ipub/dist/css/AdminLTE.min.css')); ?>">
  <!-- iCheck -->
  <!--        <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">     -->
  <link rel="stylesheet" href="<?php echo e(asset('ipub/plugins/iCheck/square/blue.css')); ?>">

  <!-- css for country list -->
  <link rel="stylesheet" href="js/countrylist/build/css/countrySelect.min.css">
	<link rel="stylesheet" href="js/countrylist/build/css/demo.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box" style="margin-top: -0.5px;">
  <div class="register-logo">
    <a href="../../index2.html"><b>iP</b>ub</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

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
        <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
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
          <input type="text" id = "country" name="country" class="form-control">
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
            <label>
              <input type="checkbox"> I agree to the <a href="/terms">terms and conditions</a>
            </label>
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
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<!--        <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>     -->
<script src="<?php echo e(asset('ipub/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<!--        <script src="../../bootstrap/js/bootstrap.min.js"></script>     -->
<script src="<?php echo e(asset('ipub/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- iCheck -->
<!--        <script src="../../plugins/iCheck/icheck.min.js"></script>      -->
<script src="<?php echo e(asset('ipub/plugins/iCheck/icheck.min.js')); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
