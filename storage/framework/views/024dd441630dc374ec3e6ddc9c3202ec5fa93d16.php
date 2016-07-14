<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>iPub <?php echo $__env->yieldContent('title'); ?></title>
        <?php echo $__env->yieldContent('description'); ?>
        <?php echo $__env->yieldContent('author'); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "shortcut icon" href = "ipub.ico">

        <link rel="stylesheet" href="<?php echo e(asset('boot/css/bootstrap.min.css')); ?>" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php $__env->startSection('header'); ?>
            <nav class="navbar navbar-default no-margin">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header fixed-brand">
                    <ul class="nav navbar-nav">
                        <li class="active" ><button style = "border-style: none;" class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button></li>
                    </ul>

                    <a class="navbar-brand" href="#" style = "color: rgba(51,122,183,1); font-size: 48px">iPub</a>
                </div> <!-- bs-example-navbar-collapse-1 -->
            </nav>
        <?php echo $__env->yieldSection(); ?>

        <div class="container-fluid">
          <?php $__env->startSection('sidebar'); ?>
              <div id="wrapper">
              <!-- Sidebar -->
                  <div id="sidebar-wrapper">
                      <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                        <li class = "active">
                            <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-inbox"></i></span>Inbox <span class = "badge">4</span> </a>
                        </li>

                          <li>
                              <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-globe"></i></span>Notifications <span class = "badge">4</span> </a>
                          </li>

                          <li>
                              <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-user"></i></span>Profile</a>
                          </li>

                          <li>
                              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-upload"></i></span>Upload File</a>
                              <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                                  <li><a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-picture "></i></span>Photo <span class = "badge">124</span> </a></li>
                                  <li><a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-film"></i></span>Video <span class = "badge">4</span> </a></li>
                              </ul>
                          </li>

                          <li>
                              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-cog"></i></span>Settings</a>
                          </li>

                          <li>
                              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-stats"></i></span>Statistics</a>
                          </li>

                          <li>
                              <a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-log-out"></i></span>Logout</a>
                          </li>
                      </ul>
                  </div><!-- /#sidebar-wrapper -->
                  <!-- Page Content -->
                  <div id="page-content-wrapper">
                      <div class="container-fluid xyz">
                          <div class="row">
                              <div class="col-lg-12">
                                  <h1>Simple Sidebar With Bootstrap 3 by <a href="http://seegatesite.com/create-simple-cool-sidebar-menu-with-bootstrap-3/" >Seegatesite.com</a></h1>
                                  <p>This sidebar is adopted from start bootstrap simple sidebar startboostrap.com, which I modified slightly to be more cool. For tutorials and how to create it , you can read from my site here <a href="http://seegatesite.com/create-simple-cool-sidebar-menu-with-bootstrap-3/">create cool simple sidebar menu with boostrap 3</a></p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- /#page-content-wrapper -->
              </div>
          <?php echo $__env->yieldSection(); ?>

          <?php echo $__env->yieldContent('content'); ?>
        </div>

        <?php $__env->startSection('footer'); ?>

            <!-- display footer -->
        <?php echo $__env->yieldSection(); ?>

        <script type="text/javascript" src = "<?php echo e(asset('js/jquery.min.js')); ?>"> </script>
        <script type="text/javascript" src = "<?php echo e(asset('boot/js/bootstrap.min.js')); ?>"> </script>
        <script type="text/javascript" src = "<?php echo e(asset('js/sidebar.js')); ?>"> </script>
    </body>
</html>
