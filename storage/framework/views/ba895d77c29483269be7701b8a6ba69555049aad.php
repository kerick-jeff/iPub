<?php $__env->startSection('content'); ?>
    <p class="login-box-msg">Reset Password</p>

    <form method="POST" action="<?php echo e(url('/password/reset')); ?>">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="token" value="<?php echo e($token); ?>">
      <div class="form-group has-feedback  <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <input type="email" class="form-control" name="email" value="<?php echo e(isset($email) ? $email : old('email')); ?>" placeholder="Email">
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
      <div class="form-group has-feedback  <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Retype assword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php if($errors->has('password_confirmation')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback ">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
      </div>
  </form>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>