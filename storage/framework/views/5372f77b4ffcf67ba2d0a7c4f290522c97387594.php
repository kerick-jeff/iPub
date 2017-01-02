<?php $__env->startSection('title', 'Login'); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('js/loading/waitMe.css')); ?>" media="screen" title="no title">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p class="login-box-msg">Login</p>

    <?php if(session('info')): ?>
        <div class="alert alert-info alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <i class = "icon fa fa-info"></i> <br />
             <?php echo e(session('info')); ?>

             <a href="/resend/<?php echo e(session('email')); ?>/<?php echo e(session('name')); ?>">Resend link</a>
        </div>
    <?php endif; ?>
    <?php if(session('warning')): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class = "icon fa fa-warning"></i> <br />
            <?php echo e(session('warning')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <i class = "icon fa fa-check"></i> <br />
             <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(url('/login')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

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
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php if($errors->has('password')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id = "login" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Login using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Login using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="<?php echo e(url('/password/reset')); ?>">I forgot my password</a><br>
    <a href="<?php echo e(url('/register')); ?>" class="text-center">Register a new membership</a>

 <?php $__env->stopSection(); ?>

 <?php $__env->startSection('javascript'); ?>
 <script type="text/javascript" src = "<?php echo e(asset('js/loading/waitMe.js')); ?>"></script>
 <script type="text/javascript">
 $("#login").click(function(){
     $("#body").waitMe({
         effect: 'roundBounce',
         text: 'Signing you in',
         bg: 'rgba(255,255,255,0.7)',
         color: '#3c8dbc',
         sizeW: '',
         sizeH: '',
         source: '',
         onClose: function(){}
     });
 });
 </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>