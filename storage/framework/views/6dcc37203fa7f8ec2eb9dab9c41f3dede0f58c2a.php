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
        <link rel="stylesheet" href="<?php echo e(asset('css/hover.css')); ?>" media="screen" title="no title" charset="utf-8">

        <style media="screen">
            #login:hover, #register:hover, #pubs:hover, #about:hover {
                background: rgba(51,122,183,.2);
            }
            #colored {
                color: rgba(51,122,183, 1);
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
              <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class = "sr-only">Toggle navigation</span>
                        <span class = "glyphicon glyphicon-menu-hamburger"></span>
                    </button>
                    <div class="navbar-brand">
                        <a id="menu-toggle" href="#" class="glyphicon glyphicon-align-justify btn-menu toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                        <a href="#" style = "text-decoration: none;" id = "colored">iPub</a>
                    </div>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li><a href="<?php echo e(url('/pubs')); ?>" id = "colored" >Pubs</a></li>
                    <li><a href="<?php echo e(url('/about')); ?>" id = "colored" >About Us</a></li>
                  </ul>
                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Authentication Links -->
                      <?php if(Auth::guest()): ?>
                          <li><a href="<?php echo e(url('/login')); ?>" id = "colored">Login</a></li>
                          <li><a href="<?php echo e(url('/register')); ?>" id = "colored">Register</a></li>
                      <?php else: ?>
                          <li>
                              <a href = "<?php echo e(url('/inbox')); ?>" id = "colored" data-toggle = "tooltip" data-placement = "bottom" title = "You have unread messages"><span class = "glyphicon glyphicon-inbox"></span></a>
                          </li>

                          <li>
                              <a href = "<?php echo e(url('/notifications')); ?>" id = "colored" data-toggle = "tooltip" data-placement = "bottom" title = "You have unread notifications"><span class = "glyphicon glyphicon-globe"></span></a>
                          </li>

                          <li class="dropdown">
                              <a href="#" id = "colored" class="dropdown-toggle" data-placement = "bottom" title = "Upload pub" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <span class = "glyphicon glyphicon-upload"></span> <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="<?php echo e(url('/upload/photo')); ?>" id = "colored"><i class = "glyphicon glyphicon-picture"></i>&nbsp;Photo</a></li>
                                  <li><a href="<?php echo e(url('/upload/video')); ?>" id = "colored"><i class = "glyphicon glyphicon-film"></i>&nbsp;Video</a></li>
                              </ul>
                          </li>

                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" id = "colored" data-placement = "bottom" title = "View Profile" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="<?php echo e(url('/account')); ?>" id = "colored"><i class = "glyphicon glyphicon-user"></i>&nbsp;Your account</a></li>
                                  <li><a href="<?php echo e(url('/statistics')); ?>" id = "colored"><i class = "glyphicon glyphicon-stats"></i>&nbsp;Statistics</a></li>
                                  <li role = "presentation" class = "divider"></li>
                                  <li><a href="<?php echo e(url('/settings')); ?>" id = "colored"><i class = "glyphicon glyphicon-cog"></i>&nbsp;Settings</a></li>
                                  <li><a href="<?php echo e(url('/logout')); ?>" id = "colored"><i class = "glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
                              </ul>
                          </li>
                      <?php endif; ?>
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
          </nav>
          <!-- Sidebar -->
          <div id="sidebar-wrapper">
              <nav id="spy">
                  <ul class="sidebar-nav nav" style = "color: rgba(51,122,183,1);">
                      <li>
                          <a href="<?php echo e(url('/account')); ?>"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-user"></i></span>Account</a>
                      </li>
                      <li>
                          <a href="<?php echo e(url('/inbox')); ?>"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-inbox"></i></span>Inbox</a>
                      </li>
                      <li>
                          <a href="<?php echo e(url('/notifications')); ?>"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-globe"></i></span>Notifications</a>
                      </li>
                      <li>
                          <a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-upload"></i></span>Upload File</a>
                          <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                              <li><a href="<?php echo e(url('/upload/photo')); ?>"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-picture"></i></span>Photo</a></li>
                              <li><a href="<?php echo e(url('/upload/video')); ?>"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-film"></i></span>Video</a></li>
                          </ul>
                      </li>
                      <li>
                          <a href="<?php echo e(url('/settings')); ?>"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-cog"></i></span>Settings</a>
                      </li>
                      <li>
                          <a href="<?php echo e(url('/statistics')); ?>"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-stats"></i></span>Statistics</a>
                      </li>
                      <li>
                          <a href="<?php echo e(url('/logout')); ?>"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-log-out"></i></span>Logout</a>
                      </li>
                  </ul>
              </nav>
          </div>
          <!-- Page content -->
          <div class="container-fluid" style = "margin-top: 50px;">

              <?php echo $__env->yieldContent('content'); ?>

          </div>
        </div>

        <?php $__env->startSection('footer'); ?>

            <!-- display footer -->
        <?php echo $__env->yieldSection(); ?>

        <script type="text/javascript" src = "<?php echo e(asset('js/jquery.min.js')); ?>"> </script>
        <script type="text/javascript" src = "<?php echo e(asset('boot/js/bootstrap.min.js')); ?>"> </script>
        <script type="text/javascript" src = "<?php echo e(asset('js/sidebar.js')); ?>"> </script>
    </body>
</html>
