<?php $__env->startSection('title', '| 404 - Page Not Found'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
      <p> Error </p>
      <p> 404 - Page Not Found </p>
    </div>
    <div class="col-md-4">

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.errors.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>