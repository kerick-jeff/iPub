<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="shortcut icon" href="ipub.ico">
        <title>iPub <?php echo $__env->yieldContent('title'); ?> </title>
    </head>
    <body>
        <?php $__env->startSection('header'); ?>
            show header
        <?php echo $__env->yieldSection(); ?>

        <?php $__env->startSection('sidebar'); ?>
            show sidebar
        <?php echo $__env->yieldSection(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php $__env->startSection('footer'); ?>
            show footer
        <?php echo $__env->yieldSection(); ?>
    </body>
</html>
