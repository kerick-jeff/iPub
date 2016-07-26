<?php $__env->startSection('title', '| Account'); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('breadcrumb'); ?>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
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
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo e(url('/profilePicture')); ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?php echo e(Auth::user()->name); ?></h3>
        <p class="text-muted text-center"><?php echo e(Auth::user()->type); ?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Rating</b>
            <a class="pull-right">
              <i class = "fa fa-star" style = "color: #FFC733"></i>
              <i class = "fa fa-star" style = "color: #FFC733"></i>
              <i class = "fa fa-star-half-full" style = "color: #FFC733"></i>
              <i class = "fa fa-star-o" style = "color: #FFC733"></i>
              <i class = "fa fa-star-o" style = "color: #FFC733"></i>
            </a>
          </li>
          <li class="list-group-item">
            <b>Followers</b> <a class="pull-right">1247</a>
          </li>
          <li class="list-group-item">
            <b>Invited</b> <a class="pull-right">543</a>
          </li>
        </ul>

        <!-- invite modal -->
        <button type = "button" class="btn btn-primary btn-block" title = "Invite someone to follow you on iPub" data-toggle = "modal" data-target = "#invite"><b>Invite</b></button>
        <div class="modal fade" id="invite" tabindex="-1" role="dialog" aria-labelledby="Invite" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="/invite" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Invite someone to follow you on iPub</h4>
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
        <strong><i class="icon fa fa-file-text"></i> Description </strong>
        <p class="text-muted">
          B.S. in Computer Science from the University of Tennessee at Knoxville
        </p>
        <a href = "/setings#description" type="button" class = "btn btn-primary btn-xs"><i class = "fa fa-edit"></i>Edit</a>
        <hr>

        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
        <p class="text-muted">
          Malibu, California
        </p>
        <a href = "/settings#location" type="button" class = "btn btn-primary btn-xs"><i class = "fa fa-circle"></i>Set</a>
        <hr>

        <strong><i class="icon fa fa-envelope"></i> Email </strong>
        <p class="text-muted">
            <?php echo e(Auth::user()->email); ?>

        </p>
        <hr>

        <?php if(!empty(Auth::user()->phone_number)): ?>
          <strong><i class="icon fa fa-phone"></i> Phone </strong>
          <p class="text-muted">
            ( <?php echo e(Auth::user()->country_code); ?> ) <?php echo e(chunk_split(Auth::user()->phone_number, 3)); ?>

          </p>
          <hr>
        <?php endif; ?>

        <strong><i class="icon fa fa-clock-o"></i> Joined on </strong>
        <p class="text-muted">
            <?php echo e(Auth::user()->created_at); ?>

        </p>
        <hr>

        <strong><i class="fa fa-list-alt"></i> Products/Services </strong>
        <p>
          <span class="label label-danger">UI Design</span>
        </p>
        <p>
          <span class="label label-success">Coding</span>
        </p>
        <p>
          <span class="label label-info">Javascript</span>
        </p>
        <p>
          <span class="label label-warning">PHP</span>
        </p>
        <p>
          <span class="label label-primary">Node.js</span>
        </p>

        <hr>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
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
                Your account is 60% complete
              </p>
              <div class="progress">
                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                  <span class="sr-only">60% Complete</span>
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
                <button type="button" class="btn btn-primary pull-right" title = "Subscripe for an iPub service" data-toggle = "modal" data-target = "#subscribe"><i class="fa fa-plus"></i> Add Subscription </button>

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
                        <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#editlink" data-lid = "<?php echo e($link->id); ?>" data-link = "<?php echo e($link->link); ?>" data-caption = "<?php echo e($link->caption); ?>"><i class="fa fa-edit"></i></button>
                        <button type="button" class = "btn btn-danger btn-xs" data-toggle = "modal" data-target = "#deletelink" data-lid = "<?php echo e($link->id); ?>"><i class="fa fa-trash-o"></i></button>
                      </div>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p> It is essential that you provide links/contacts in order to be reachable by visitors to iPub. Please add a link/contact by clicking the button below. </p>
                <?php endif; ?>
              </ul>

              <!-- edit link/contact modal -->
              <div class="modal fade" id="editlink" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="editlinkLabel">Edit Link/Contact</h4>
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
                      <form id="editform" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PATCH')); ?>

                        <input type="hidden" name="lid" id = "lid" >
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- edit link/contact modal -->

              <!-- delete link/contact modal -->
                <div class="modal fade" id="deletelink" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                        <h4 class="modal-title" id="deletelinkLabel">Delete Link/Contact</h4>
                      </div>
                      <div class="modal-body">
                          <p> Are you sure you want to delete this? </p>
                      </div>
                      <div class="modal-footer">
                        <form id="deleteform" method="POST">
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
                <button type="button" class="btn btn-primary pull-right" title = "Add a link or contact information, for iPub visitors to see" data-toggle = "modal" data-target = "#addlink"><i class="fa fa-plus"></i> Add Link/Contact</button>

                <form action = "/link/add" method = "POST">
                  <?php echo e(csrf_field()); ?>

                  <div class="modal fade" id="addlink" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Add Link/Contact</h4>
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
            <!-- followers list -->
            <div class="col-md-6">
              <div class="box box-info" id = "followers">
                <div class="box-header with-border">
                  <h3 class="box-title">Followers</h3>
                  <div class="box-tools pull-right">
                    <span class="label label-info">8 New Followers</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>

                <!-- /.box-header -->
                <?php if(count($followers) > 0): ?>
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                      <?php foreach($followers as $follower): ?>
                        <li>
                          <img src="<?php echo e(asset('ipub/dist/img/user1-128x128.jpg')); ?>" alt="Follower Image">
                          <?php echo e(empty($follower->name) ? "empty is the ga" : $follower->name); ?>

                          <span class="users-list-name" ><?php echo e($follower->email); ?></span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All</a>
                </div>
                <!-- /.box-footer -->
                <?php else: ?>
                <div class="box-body no-padding">
                    <p style = "margin-left: 30%">You have no followers!</p>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <button type = "button" class="btn btn-primary btn-block" title = "Invite someone to follow you on iPub" data-toggle = "modal" data-target = "#invite"><b>Invite</b></button>
                </div>
                <!-- /.box-footer -->
                <?php endif; ?>
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->

            <!-- recently added products -->
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
                      <img src="<?php echo e(asset('ipub/dist/img/default-50x50.gif')); ?>" alt="Product Image">
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

      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    //when edit link/contact modal is about to be shown
    $("#editlink").on('show.bs.modal', function(e){
        var lid = $(e.relatedTarget).data('lid');
        var link = $(e.relatedTarget).data('link');
        var caption = $(e.relatedTarget).data('caption');
        $("#editlink #lid").val(lid);
        $("#editlink #link").val(link);
        $("#editlink #caption").val(caption);
        $("#editform").submit(function(){
            var newlink = $("#editlink #link").val();
            var newcaption = $("#editlink #caption").val();
            $("#editform").attr("action", "/link/edit/" + lid + "/" + newlink + "/" + newcaption);
        });
    });

    //when delete link/contact modal is about to be shown
    $("#deletelink").on('show.bs.modal', function(e){
        var lid = $(e.relatedTarget).data('lid');
        $("#deletelink #lid").val(lid);
        $("#deleteform").attr("action", "/link/delete/" + lid);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>