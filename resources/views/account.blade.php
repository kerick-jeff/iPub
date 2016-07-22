@extends('layouts.master')

@section('title', '| Account')

<!-- provide author and page desc -->

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>Account</li>
</ol>
@endsection

@section('content')

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('ipub/dist/img/user4-128x128.jpg') }}" alt="User profile picture">

        <h3 class="profile-username text-center">Nina Mcintire</h3>

        <p class="text-muted text-center">Software Engineer</p>

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
                <button type="button" class="btn btn-primary">Invite</button>
              </div>
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
            frukerickjeff@gmail.com
        </p>
        <hr>

        @if(!empty(Auth::user()))
          <strong><i class="icon fa fa-phone"></i> Phone </strong>
          <p class="text-muted">
            ( {{ Auth::user()->country_code}} ) {{ chunk_split(Auth::user()->phone_number, 3) }}
          </p>
          <hr>
        @endif

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
              <h3 class = "fa fa-spinner">Status</h3>
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

          <!-- contact List -->
          <div class="box box-info">
            <div class="box-header">
              <h3 class="fa fa-link">Link/Contact List</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                @if(!empty($links))
                  @foreach($links as $link)
                    <li>
                      <span class="text">{{ $link->link }}</span>
                      <small class="label label-info"> {{ $link->caption }} </small>
                      <div class="tools">
                        <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#editlink"><i class="fa fa-edit"></i></button>
                        <button type="button" class = "btn btn-danger btn-xs" data-toggle = "modal" data-target = "#deletelink"><i class="fa fa-trash-o"></i></button>
                      </div>
                    </li>
                  @endforeach
                @else
                  <p> It is essential that you provide links/contacts in order to be reachable by visitors to iPub. Please add a link/contact by clicking the button below. </p>
                @endif
              </ul>

              <!-- edit link/contact modal -->
              <div class="modal fade" id="editlink" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Edit Link/Contact</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback">
                          <input type="email" class="form-control" name="email" placeholder="Your website link, email, phone contact, P.O Box, etc">
                          <span class="fa fa-link form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <label>Select type</label>
                          <select class="form-control select2" style="width: 100%;">
                            <option selected="website" value = "website">Website</option>
                            <option value = "email">Email</option>
                            <option value = "phone">Phone</option>
                            <option value = "address">Address</option>
                            <option value = "pobox">P.O Box</option>
                          </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Add</button>
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
                        <h4 class="modal-title" id="myModalLabel">Delete Link/Contact</h4>
                      </div>
                      <div class="modal-body">
                          <p> Are you sure you want to delete this? </p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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
                  {{ csrf_field() }}
                  <div class="modal fade" id="addlink" tabindex="-1" role="dialog" aria-labelledby="Link/Contact" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Add Link/Contact</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group has-feedback">
                              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                              <input type="text" class="form-control" name="link" placeholder="Your website link, email, phone contact, P.O Box, etc">
                              <span class="fa fa-link form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Select type</label>
                              <select name = "caption" class="form-control select2" style="width: 100%;">
                                <option selected="website" value = "website">Website</option>
                                <option value = "email">Email</option>
                                <option value = "phone">Phone</option>
                                <option value = "address">Address</option>
                                <option value = "pobox">P.O Box</option>
                              </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type = "submit" class="btn btn-primary">Add</button>
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
            <div class="col-md-6" id = "invited">
              <!-- follwers list -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Invited</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-info">8 Recently Invited</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="{{ asset('ipub/dist/img/user1-128x128.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user8-128x128.jpg') }}" alt="Inivited Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user7-128x128.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user6-128x128.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user2-160x160.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user5-128x128.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user4-128x128.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user3-128x128.jpg') }}" alt="Invited Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <!-- followers list -->
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
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="{{ asset('ipub/dist/img/user1-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user8-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user7-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user6-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user2-160x160.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user5-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user4-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="{{ asset('ipub/dist/img/user3-128x128.jpg') }}" alt="Follower Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
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
@endsection
