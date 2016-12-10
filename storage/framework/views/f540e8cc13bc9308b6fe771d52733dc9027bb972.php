<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iPub | <?php echo $__env->yieldContent('title'); ?></title>
  <?php echo $__env->yieldContent('description'); ?>
  <?php echo $__env->yieldContent('author'); ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <!--      <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">        -->
  <link rel="stylesheet" href="<?php echo e(asset('ipub/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!--      <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">        -->
  <link rel="stylesheet" href="<?php echo e(asset('ipub/dist/css/AdminLTE.min.css')); ?>">
  <!-- iCheck -->
  <!--      <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">        -->
  <link rel="stylesheet" href="<?php echo e(asset('ipub/plugins/iCheck/square/blue.css')); ?>">

  <?php echo $__env->yieldContent('css'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" id = "body">
<div class="login-box" style="margin-top:15px">
  <div class="login-logo">
    <a href="/"><b>iP</b>ub</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <?php echo $__env->yieldContent('content'); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<!--      <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>        -->
<script src="<?php echo e(asset('ipub/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<!--      <script src="../../bootstrap/js/bootstrap.min.js"></script>        -->
<script src="<?php echo e(asset('ipub/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- iCheck -->
<!--      <script src="../../plugins/iCheck/icheck.min.js"></script>        -->
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

<?php echo $__env->yieldContent('javascript'); ?>

</body>
</html>
