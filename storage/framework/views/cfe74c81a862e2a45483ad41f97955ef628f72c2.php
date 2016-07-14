<?php $__env->startSection('title'); ?>

<?php $__env->startSection('description'); ?>
    <meta name="description" content = "describe iPub">
    <meta name="author" content = "name of author">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>