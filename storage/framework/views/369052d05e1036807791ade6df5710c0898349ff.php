<?php $__env->startSection('title', '| paginate'); ?>

<!-- provide author and page description -->

<?php $__env->startSection('breadcrumb'); ?>
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> iPub</a></li>
  <li>paginate</li>
  <li class="active">paginate</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
  <?php foreach($links as $link): ?>
    <li><?php echo e($link->link." -- ".$link->caption); ?></li>
  <?php endforeach; ?>
</div>
<?php echo $links->render(); ?>

<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>