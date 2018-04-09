<?php $__env->startSection('title', '| 404 - Page Not Found'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="row">
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
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