<?php $__env->startSection('title', '| Account'); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('css'); ?>
<style type = "text/css" media="screen">
  .markerLabel {
    color: black;
    font-weight: bold;
    text-shadow: 0px 0px 5px rgba(255, 0, 0, 1);
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<h1>
  Account
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> iPub </a></li>
    <li>Account</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- display any errors stored in the $errors array-->
<?php if($errors->has('link')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo e($errors->first('link')); ?>

    </div>
<?php endif; ?>

<!-- alert user of successfully sending an invitation -->
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> <br />
         <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('failure')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> <br />
         <?php echo e(session('failure')); ?>

    </div>
<?php endif; ?>

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary spacious-bottom">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo e(url('/profile-picture')); ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?php echo e(Auth::user()->name); ?></h3>
        <p class="text-muted text-center"><?php echo e(Auth::user()->type); ?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Rating</b>
            <a class="pull-right">
              <i class = "fa fa-star starry"></i>
              <i class = "fa fa-star starry"></i>
              <i class = "fa fa-star-half-full starry"></i>
              <i class = "fa fa-star-o starry"></i>
              <i class = "fa fa-star-o starry"></i>
            </a>
          </li>
          <li class="list-group-item">
            <b>Raters</b> <a class="pull-right"><?php echo e($noRaters); ?></a>
          </li>
          <li class="list-group-item">
            <b>Invited</b> <a class="pull-right"><?php echo e(Auth::user()->invited); ?></a>
          </li>
        </ul>

        <button type = "button" class="btn btn-primary btn-block" title = "Invite someone to rate your pubs on iPub" data-toggle = "modal" data-target = "#invite"><b>Invite</b></button>
        <!-- invite modal -->
        <div class="modal fade" id="invite" tabindex="-1" role="dialog" aria-labelledby="Invite" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="/invite" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Invite someone to rate your pubs on iPub</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Invite</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Basic Information</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php if(!empty(Auth::user()->description)): ?>
          <a><strong><i class="icon fa fa-file-text"></i> Description </strong></a>
          <textarea class="text-muted" rows = "8" style = "border: none; width: 100%; margin-bottom: 5%" disabled >
            <?php echo e(Auth::user()->description); ?>

          </textarea>
          <hr>
        <?php endif; ?>

        <a><strong><i class="icon fa fa-envelope"></i> Email </strong></a>
        <p class="text-muted">
            <?php echo e(Auth::user()->email); ?>

        </p>
        <hr>

        <?php if(!empty(Auth::user()->phone_number)): ?>
          <a><strong><i class="icon fa fa-phone"></i> Phone </strong></a>
          <p class="text-muted">
            ( +<?php echo e(Auth::user()->dial_code); ?> ) <?php echo e(chunk_split(Auth::user()->phone_number, 3)); ?>

          </p>
          <hr>
        <?php endif; ?>

        <a><strong><i class="icon fa fa-clock-o"></i> Joined </strong></a>
        <p class="text-muted">
            <?php echo e(Auth::user()->created_at->diffForHumans()); ?>

        </p>
        <hr>

        <?php if(count($products) > 0): ?>
          <a><strong><i class="fa fa-list-alt"></i> Products/Services </strong></a>
          <?php foreach($products as $product): ?>
            <p class="text-muted" id = "product-<?php echo e($product->id); ?>" style = "font-size: 20px">
              <span class="label label-<?php echo e($labels[rand(0, 4)]); ?>" style = "white-space: pre-wrap; display: inline-flex"><?php echo e($product->name); ?> <a class = "delete-product pull-right fa fa-close" style = "color: #ccc; cursor: pointer" title = "Delete this product/service. You cannot undo this action" style = "cursor: pointer" data-id = "<?php echo e($product->id); ?>"></a></span>
            </p>
          <?php endforeach; ?>
          <hr>
        <?php endif; ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom spacious-bottom">
      <ul class="nav nav-tabs">
        <li class = "active"><a href = "#general" data-toggle = "tab">General</a></li>
        <li><a href = "#timeline" data-toggle = "tab">Timeline</a></li>
        <li><a href = "#others" data-toggle = "tab">Others</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="general">
          <!-- status -->
          <div class="box box-info">
            <div class="box-header">
              <h3 class = "fa fa-spinner">&nbsp; Status</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <p>
                Your account is <?php echo e($status); ?>% complete. <?php echo e((100 - $status)); ?>% more to go!!!
              </p>
              <div class="progress">
                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($status); ?>%">
                  <span class="sr-only"><?php echo e($status); ?>% Complete</span>
                </div>
              </div>
            </div>
          </div>
          <!-- end status box-->

          <!-- subscriptions box -->
          <div class="box box-info">
            <div class="box-header">
              <h3 class = "fa fa-credit-card">&nbsp; Subscriptions</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="todo-list">
                    <li>
                      <span class="text">Video pub subscription</span>
                      <small class="label label-info"> <i class = "fa fa-clock-o">2016-07-13 to 2016-08-13</i> </small>
                      <div class="tools">
                        <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#extendsubs" title = "Extend subscription"><i class="fa fa-arrow-circle-o-right"></i></button>
                        <button type="button" class = "btn btn-danger btn-xs" data-toggle = "modal" data-target = "#cancelsubs" title = "Cancel subscription"><i class="fa fa-close"></i></button>
                      </div>
                    </li>
                    <li>
                      <span class="text">Continuous pub subscription</span>
                      <small class="label label-info"> <i class = "fa fa-clock-o">2016-07-13 to 2016-08-13</i> </small>
                      <div class="tools">
                        <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#extendsubs" title = "Extend subscription"><i class="fa fa-arrow-circle-o-right"></i></button>
                        <button type="button" class = "btn btn-danger btn-xs" data-toggle = "modal" data-target = "#cancelsubs" title = "Cancel subscription"><i class="fa fa-close"></i></button>
                      </div>
                    </li>
              </ul>
            </div>
            <div class="box-footer clearfix no-border">
                <!-- subscription modal -->
                <button type="button" class="btn btn-primary btn-block" title = "Subscripe for an iPub service" data-toggle = "modal" data-target = "#subscribe">Add Subscription </button>

                <form action = "/subscribe" method = "POST">
                  <?php echo e(csrf_field()); ?>

                  <div class="modal fade" id="subscribe" tabindex="-1" role="dialog" aria-labelledby="Subscription" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Subscribe for an iPub service</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group has-feedback">
                              <label>Select service</label>
                              <select name = "service" class="form-control select2" style="width: 100%;">
                                <option selected="video_pub_subscription" value = "video_pub_subscription">Video Pub Subscription</option>
                                <option value = "continuous_pub_subscription">Continuous Pub Subscription</option>
                                <option value = "priority_zone_subscription">Priority Zone Subscription</option>
                              </select>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Period (Duration of service)</label>
                              <select name = "service" class="form-control select2" style="width: 100%;">
                                <option selected="1" value = "1">1 month</option>
                                <option value = "2">2 months</option>
                                <option value = "3">3 months</option>
                                <option value = "6">6 months</option>
                                <option value = "12">1 year</option>
                              </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type = "submit" class="btn btn-primary">Subscribe</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <!-- add link/contact modal -->
            </div>
          </div>
          <!-- end subscriptions box -->

          <!-- contact List -->
          <div class="box box-info">
            <div class="box-header">
              <h3 class="fa fa-link">&nbsp; Link/Contact List</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                <?php if(!empty($links)): ?>
                  <?php foreach($links as $link): ?>
                    <li>
                      <span class="text"><?php echo e($link->link); ?></span>
                      <small class="label label-info"> <?php echo e($link->caption); ?> </small>
                      <div class="tools">
                        <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#edit-link" data-lid = "<?php echo e($link->id); ?>" data-link = "<?php echo e($link->link); ?>" data-caption = "<?php echo e($link->caption); ?>"><i class="fa fa-edit"></i></button>
                        <button type="button" class = "btn btn-danger btn-xs" data-toggle = "modal" data-target = "#delete-link" data-lid = "<?php echo e($link->id); ?>" data-caption = "<?php echo e($link->caption); ?>" ><i class="fa fa-trash-o"></i></button>
                      </div>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p> It is essential that you provide links/contacts in order to be reachable by visitors to iPub. Please add a link/contact by clicking the button below. </p>
                <?php endif; ?>
              </ul>

              <!-- edit link/contact modal -->
              <div class="modal fade" id="edit-link" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="edit-link-label">Edit Link/Contact</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback">
                          <input type="text" class="form-control" name="link" id = "link" placeholder="Your website link, email, phone contact, fax, zip code, etc">
                          <span class="fa fa-link form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <label>Select type</label>
                          <select name = "caption" class="form-control select2" id = "caption" style="width: 100%;">
                            <option selected="website" value = "website">Website</option>
                            <option value = "email">Email</option>
                            <option value = "phone">Phone</option>
                            <option value = "fax">Fax</option>
                            <option value = "address">Address</option>
                            <option value = "zip code">Zip Code</option>
                          </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <form id="edit-link-form" method = "post">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PATCH')); ?>


                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- edit link/contact modal -->

              <!-- delete link/contact modal -->
                <div class="modal fade" id="delete-link" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                        <h4 class="modal-title" id="delete-link-label">Delete Link/Contact</h4>
                      </div>
                      <div class="modal-body">
                          <p> Are you sure you want to delete this link/contact? </p>
                      </div>
                      <div class="modal-footer">
                        <form id="delete-link-form" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>


                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- delete link/contact modal -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
                <!-- add link/contact modal -->
                <button type="button" class="btn btn-primary btn-block" title = "Add a link or contact information, for iPub visitors to see" data-toggle = "modal" data-target = "#add-link">Add Link/Contact</button>

                <form action = "/link/add" method = "POST">
                  <?php echo e(csrf_field()); ?>

                  <div class="modal fade" id="add-link" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                          <h4 class="modal-title" id="add-link-label">Add Link/Contact</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group has-feedback">
                              <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                              <input type="text" class="form-control" name="link" placeholder="Your website link, email, phone contact, fax, zip code, etc">
                              <span class="fa fa-link form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Select type</label>
                              <select name = "caption" class="form-control select2" style="width: 100%;">
                                <option selected="website" value = "website">Website</option>
                                <option value = "email">Email</option>
                                <option value = "phone">Phone</option>
                                <option value = "fax">Fax</option>
                                <option value = "address">Address</option>
                                <option value = "zip code">Zip Code</option>
                              </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type = "submit" class="btn btn-primary">Add</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <!-- add link/contact modal -->
            </div>
          </div>
          <!-- /.box -->

          <!-- row -->
          <div class="row">
            <!-- raters list -->
            <div class="col-md-6">
              <div class="box box-info" id = "raters">
                <div class="box-header with-border">
                  <h3 class="box-title">Raters</h3>
                  <div class="box-tools pull-right">
                    <span class="label label-info"><?php echo e($noRaters == 1 ? "1 Rater" : $noRaters." Raters"); ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>

                <!-- /.box-header -->
                <?php if($noRaters > 0): ?>
                  <div class="box-body">
                    <ul class="products-list product-list-in-box">
                      <?php foreach($ratings as $rating): ?>
                        <li class="item">
                          <div class="product-img">
                            <img src="<?php echo e(asset('ipub/dist/img/boxed-bg.jpg')); ?>" alt="Rater background">
                          </div>
                          <div class="product-info">
                            <a class="product-title"><?php echo e($rating['rater']->email); ?></a>
                            <span class="product-description">
                              Rated : <?php echo e($rating['noRatings']); ?> [of your pubs]
                            </span>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <!-- /.box-body -->
                  <?php if($noRaters > count($ratings)): ?>
                    <div class="box-footer text-center">
                      <a href="#view-all-raters" data-toggle = "modal" class="uppercase">View All</a>
                      <!-- View all raters modal -->
                      <div class="modal fade" id="view-all-raters" tabindex="-1" role="dialog" aria-labelledby="ViewAllRaters" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                              <h4 class="modal-title" id="edit-link-label">Your rater(s)</h4>
                            </div>
                            <div class="modal-body">
                              <ul class="products-list product-list-in-box" id = "raters">

                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- edit view all raters modal -->
                    </div>
                    <!-- /.box-footer -->
                  <?php endif; ?>
                <?php else: ?>
                  <div class="box-body no-padding">
                    <div class="alert alert-info alert-dismissible" role="alert"style="font-size: 20px; margin: 10px">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      You have no raters yet!!!
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <button type = "button" class="btn btn-primary btn-block" title = "Invite someone to rate your pubs on iPub" data-toggle = "modal" data-target = "#invite"><b>Invite</b></button>
                  </div>
                  <!-- /.box-footer -->
                <?php endif; ?>
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->

            <!-- recently added Pubs -->
          <div class = "col-md-6">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Recently Added Pubs</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <ul class="products-list product-list-in-box">
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo e(asset('ipub/dist/img/avatar.png')); ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Samsung TV
                        <span class="label label-warning pull-right">$1800</span></a>
                          <span class="product-description">
                            Samsung 32" 1080p 60Hz LED Smart HDTV.
                          </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo e(asset('ipub/dist/img/default-50x50.gif')); ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Bicycle
                        <span class="label label-info pull-right">$700</span></a>
                          <span class="product-description">
                            26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                          </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo e(asset('ipub/dist/img/default-50x50.gif')); ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                          <span class="product-description">
                            Xbox One Console Bundle with Halo Master Chief Collection.
                          </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo e(asset('ipub/dist/img/default-50x50.gif')); ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">PlayStation 4
                        <span class="label label-success pull-right">$399</span></a>
                          <span class="product-description">
                            PlayStation 4 500GB Console (PS4)
                          </span>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          </div>

          <!-- recently added pubs -->
          <!-- end row -->
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="timeline">
          <!-- The timeline -->
          <ul class="timeline timeline-inverse">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    10 Feb. 2014
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                </h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                <div class="timeline-body">
                  Take me to your leader!
                  Switzerland is small and neutral!
                  We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                <div class="timeline-body">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <div class="tab-pane" id = "others">
          <!-- Others -->
          <?php if(!empty($geoLocations)): ?>
            <!-- Location -->
            <div class="box box-info">
              <div class="box-header">
                <h3 class = "fa fa-map-marker">&nbsp; Location</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div  id ="map-canvas" style = "width 100%; height: 320px"> </div>
                <hr />
                <ul class = "todo-list">
                  <?php foreach($locations as $location): ?>
                    <li id = "location-<?php echo e($location['id']); ?>">
                      <span class="text">Latitude: <?php echo e($location['lat']); ?>, Longitude: <?php echo e($location['lon']); ?></span>
                      <div class="tools">
                        <button type="button" class = "btn btn-info btn-xs" onclick = "showGeolocation(<?php echo e($location['lat']); ?>, <?php echo e($location['lon']); ?>)" ><i class="fa fa-map-marker"></i></button>
                        <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#edit-geolocation" data-geoid = "<?php echo e($location['id']); ?>" ><i class="fa fa-edit"></i></button>
                        <button type="button" class = "btn btn-danger btn-xs" data-toggle = "modal" data-target = "#delete-geolocation" data-geoid = "<?php echo e($location['id']); ?>" ><i class="fa fa-trash-o"></i></button>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <!-- end Location box-->

            <!-- show geolocation modal -->
            <div class="modal fade" id="show-geolocation1" tabindex="-1" role="dialog" aria-labelledby="GeoLocation" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                    <h4 class="modal-title" id="show-geolocation-label">View Location On Map</h4>
                  </div>
                  <div class="modal-body">
                    <div  id ="map-canvas" style = "width 100%; height: 320px"> </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end show geolocation modal -->

            <!-- edit geolocation modal -->
            <div class="modal fade" id="edit-geolocation" tabindex="-1" role="dialog" aria-labelledby="GeoLocation" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                    <h4 class="modal-title" id="edit-geolocation-label">Edit Location</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group has-feedback">
                      <strong><i class = "fa fa-map-marker"></i> Location </strong>
                      <p> Hint: For accurate results, use Chrome browser. </p>
                      <div  id ="map-canvas" class = "map-canvas" style = "width 100%; height: 320px"> </div>
                    </div>

                    <div class = "form-group has-feedback" style = "display: inline-block; width: 50%;">
                      <input type="number" step = "0.00000001" class = "form-control" name="geo_latitude" id = "geo_latitude" value="<?php echo e(empty(Auth::user()->geo_latitude) ? '' : Auth::user()->geo_latitude); ?>" min = "-90" max = "90">
                      <?php if($errors->has('geo_latitude')): ?>
                          <span class="help-block" style = "color: #DD4B39 !important;">
                              <strong><?php echo e($errors->first('geo_latitude')); ?></strong>
                          </span>
                      <?php endif; ?>
                    </div>
                    <div class="form-group has-feedback" style = "display: inline-block; width: 49%;">
                      <input type="number" step = "0.00000001" class = "form-control" name="geo_longitude" id = "geo_longitude" value = "<?php echo e(empty(Auth::user()->geo_longitude) ? '' : Auth::user()->geo_longitude); ?>" min = "-180" max = "180">
                      <?php if($errors->has('geo_longitude')): ?>
                          <span class="help-block" style = "color: #DD4B39 !important;">
                              <strong><?php echo e($errors->first('geo_longitude')); ?></strong>
                          </span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id = "btn-edit-geolocation" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end edit geolocation modal -->

            <!-- delete geolocation modal -->
              <div class="modal fade" id="delete-geolocation" tabindex="-1" role="dialog" aria-labelledby="GeoLocation" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="delete-geolocation-label">Delete Location</h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this location? </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id = "btn-delete-geolocation" data-dismiss="modal">Yes</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                  </div>
                </div>
              </div>
            <!-- end delete geolocation modal -->
          <?php endif; ?>
        </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMEmwSkmHfq-9OA9Sq4-ecVmHSrfYFSts" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(asset('js/map/map.js')); ?>" ></script>
<script type="text/javascript">
    // when edit link/contact modal is about to be shown
    $("#edit-link").on('show.bs.modal', function(e){
        var lid = $(e.relatedTarget).data('lid');
        var link = $(e.relatedTarget).data('link');
        var caption = $(e.relatedTarget).data('caption');
        $("#edit-link #lid").val(lid);
        $("#edit-link #link").val(link);
        $("#edit-link #caption").val(caption);

        $("#edit-link-form").submit(function(){
            var newlink = $("#edit-link #link").val();
            var newcaption = $("#edit-link #caption").val();
            $("#edit-link-form").attr("action", "/link/edit/" + lid + "/" + newlink + "/" + newcaption);
        });
    });

    // when delete link/contact modal is about to be shown
    $("#delete-link").on('show.bs.modal', function(e){
        var lid = $(e.relatedTarget).data('lid');
        var caption = $(e.relatedTarget).data('caption');
        $("#delete-link-form").attr("action", "/link/delete/" + lid);
    });



    // when edit geolocation modal is about to be shown
    $("#edit-geolocation").on('show.bs.modal', function(e){
        var geoid = $(e.relatedTarget).data('geoid');

        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                $("#edit-geolocation #geo_latitude").val(position.coords.latitude);
                $("#edit-geolocation #geo_longitude").val(position.coords.longitude);
                initMap(position.coords.latitude, position.coords.longitude, true);
            }, function(error){
                alert(error.code + " - " + error.message);
            });
        } else {
            $("#edit-geolocation #map-canvas").val("Sorry, geolocation services are not supported by your browser");
        }

        $("#edit-geolocation #btn-edit-geolocation").click(function(){
            var geoLatitude = $("#edit-geolocation #geo_latitude").val();
            var geoLongitude = $("#edit-geolocation #geo_longitude").val();
            $.ajax({
                type : 'PUT',
                url : '/geolocation/edit/' + geoid + "/" + geoLatitude + "/" + geoLongitude,
                data : "_token=<?php echo e(csrf_token()); ?>",
                dataType : "json",
                success : function(data) {
                    var locationItem = "<li id = 'location-" + data.id + "'>";
                    locationItem += "<span class='text'>Latitude: " + data.geo_latitude + ", Longitude: " + data.geo_longitude + "</span>";
                    locationItem += "<div class='tools'>";
                    locationItem += "<button type='button' class = 'btn btn-info btn-xs' ><i class='fa fa-map-marker'></i></button>";
                    locationItem += "<button type='button' class = 'btn btn-primary btn-xs' data-toggle = 'modal' data-target = '#edit-geolocation' data-geoid = '" + data.id + "' ><i class='fa fa-edit'></i></button>";
                    locationItem += "<button type='button' class = 'btn btn-danger btn-xs' data-toggle = 'modal' data-target = '#delete-geolocation' data-geoid = '" + data.id + "' ><i class='fa fa-trash-o'></i></button>";
                    locationItem += "</div>";
                    locationItem += "</li>";

                    $("#location-" + data.id).replaceWith(locationItem);
                },
                error : function(error) {
                    console.log("error: " + error.status);
                }
            });
        });
    });

    // when delete geolocation modal is about to be shown
    $("#delete-geolocation").on('show.bs.modal', function(e){
        var geoid = $(e.relatedTarget).data('geoid');

        $("#delete-geolocation #btn-delete-geolocation").click(function() {
            $.ajax({
                type : "DELETE",
                url : "/geolocation/delete/" + geoid,
                data : "_token=<?php echo e(csrf_token()); ?>",
                success : function(data) {
                    $("#location-" + geoid).remove();
                },
                error : function(error) {
                    console.log("error: " + error.status);
                }
            });
        });
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
        if(target == "#others"){
            if(navigator.geolocation){
                var locations = <?php echo json_encode($locations); ?>;
                if(locations.length > 0) {
                    displayMap(locations);
                } else {
                    $("#others #map-canvas").html("There are no locations to display");
                }
            } else {
                $("#others #map-canvas").html("Sorry, geolocation services are not supported by your browser");
            }
        }
    });

    function showGeolocation(lat, lon) {
        if(navigator.geolocation){
            var locations = <?php echo json_encode($locations); ?>;
            displayMap(locations, new Array(lat, lon));
        } else {
            $("#others #map-canvas").val("Sorry, geolocation services are not supported by your browser");
        }
    }

    $('.delete-product').on('click', function (e) {
        var id = $(e.target).data('id');
        $.ajax({
            type : "DELETE",
            url : "/product/delete/" + id,
            data : "_token=<?php echo e(csrf_token()); ?>",
            success : function(data) {
                $("#product-" + id).remove();
            },
            error : function(error) {
                console.log("error: " + error.status);
            }
        });
    });

    // when view all raters modal is about to be shown
    $("#view-all-raters").on('show.bs.modal', function(e){
        $.ajax({
            type : "GET",
            url : "/account/raters",
            data : "_token=<?php echo e(csrf_token()); ?>",
            success : function(ratings) {
                var result = "";

                for(var i = 0; i < ratings.length; i++) {
                    result += "<li class='item'>";
                    result += "<div class='product-img'>";
                    result += "<img src='<?php echo e(asset('ipub/dist/img/boxed-bg.jpg')); ?>' alt='Rater background'>";
                    result += "</div>";
                    result += "<div class='product-info' style = 'text-align: left'>";
                    result += "<a class='product-title'>" + ratings[i]['rater'].email + "</a>";
                    result += "<span class='product-description'>";
                    result += "Rated : " + ratings[i]['noRatings'] + " [of your pubs]";
                    result += "</span>";
                    result += "</div>";
                    result += "</li>";
                }

                $("#view-all-raters #raters").html(result);
            },
            error : function(error) {
                console.log("error: " + error.status);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>