<?php $__env->startSection('title', '| 500 - Internal Server Error'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="row">
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-red"> 500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Internal Server Error.</h3>

          <p>
            There was an Internal Server Error.
            Meanwhile, you may return to <a href="/">Welcome page</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.errors.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>