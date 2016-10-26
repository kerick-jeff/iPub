<?php $__env->startSection('toggle'); ?>
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extendable_content'); ?>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

<?php if(Auth::check()): ?>

      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(asset('ipub/dist/img/avatar.png')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::user()->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo e(url('/inbox')); ?>">
            <i class="fa fa-inbox"></i> <span>Inbox</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">10</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(url('/notifications')); ?>">
            <i class="fa fa-bell"></i> <span>Notifications</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">20</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo e(url('/upload')); ?>">
            <i class="fa fa-upload"></i> <span>Upload</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">28</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('/upload/photo')); ?>"><i class="fa fa-photo"></i> Photo
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li><a href="<?php echo e(url('/upload/video')); ?>"><i class="fa fa-video-camera"></i> Video
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="<?php echo e(url('/account')); ?>">
            <i class="fa fa-user"></i> <span>Account</span>
          </a>
        </li>
        <li>
          <a href="<?php echo e(url('/statistics')); ?>">
            <i class="fa fa-pie-chart"></i> <span>Statistics</span>
          </a>
        </li>
        <li>
          <a href="<?php echo e(url('/settings')); ?>">
            <i class="fa fa-cogs"></i> <span>Settings</span>
          </a>
        </li>
        <li>
          <a href="<?php echo e(url('/logout')); ?>">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

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

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> <a href="/">iPub.com</a>.</strong> All rights reserved.
  </footer>

  <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.extendable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>