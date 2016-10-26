<?php $__env->startSection('title', '| Mailbox'); ?>

<!-- provide author and page description -->

<?php $__env->startSection('breadcrumb'); ?>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>Mailbox</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>