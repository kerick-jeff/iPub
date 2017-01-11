<?php $__env->startSection('extendable_content'); ?>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
  <?php if(Auth::check()): ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style = "margin-bottom: 20px">

      <?php echo $__env->yieldContent('breadcrumb'); ?>

    </section>

    <!-- Main content -->
    <section class="content">

       <?php echo $__env->yieldContent('content'); ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style = "position: fixed; bottom: 0px; left: 0px; right: 0px">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> <a href="/">iPub.com</a>.</strong> All rights reserved.
  </footer>

  <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.extendable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>