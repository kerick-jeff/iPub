@extends('layouts.extendable')

@section('css')
<style type = "text/css" media="screen">
    .spacious-bottom {
        margin-bottom: 15%;
    }

    @media(max-width: 768px) {
        .spacious-bottom {
            margin-bottom: 25%;
        }
    }
</style>
@endsection

@section('toggle')
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>
@endsection

@section('extendable_content')
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
  @if (Auth::check())
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('/profile-picture') }}" class="img-circle" alt="User profile picture">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" style = "text-align: center">WELCOME</li>
        <li>
          <a href="{{ url('/account') }}">
            <i class="fa fa-user"></i> <span>Account</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#mailbox">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ url('/mailbox/compose') }}"><i class="fa fa-edit"></i> Compose
                <span class="pull-right-container">
                  <small class="label label-primary pull-right">new</small>
                </span>
              </a>
            </li>
            <li><a href="{{ url('/mailbox/inbox') }}"><i class="fa fa-inbox"></i> Inbox
                    <span class="pull-right-container">
                      <small class="label label-info pull-right"><b id = "noInbox">{{ session('noInbox') }}</b></small>
                    </span>
                </a>
            </li>
            <li><a href="{{ url('/mailbox/sent') }}"><i class="fa fa-send"></i> Sent
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green"><b id = "noSent">{{ session('noSent') }}</b></small>
                    </span>
                </a>
            </li>
            <li><a href="{{ url('/mailbox/drafts') }}"><i class="fa fa-file-text-o"></i> Drafts
                    <span class="pull-right-container">
                      <small class="label label-warning pull-right"><b id = "noDrafts">{{ session('noDrafts') }}</b></small>
                    </span>
                </a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('/notifications') }}">
            <i class="fa fa-bell"></i> <span>Notifications</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">20</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('/upload') }}">
            <i class="fa fa-upload"></i> <span>Upload</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right"><b id = "numUploads">{{ session('numUploads') }}</b></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/upload/photo') }}"><i class="fa fa-photo"></i> Photo
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green"><b id = "numPhotos">{{ session('numPhotos') }}</b></small>
                    </span>
                </a>
            </li>
            <li><a href="{{ url('/upload/video') }}"><i class="fa fa-video-camera"></i> Video
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green"><b id = "numVideos">{{ session('numVideos') }}</b></small>
                    </span>
                </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ url('/statistics') }}">
            <i class="fa fa-pie-chart"></i> <span>Statistics</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/settings') }}">
            <i class="fa fa-cogs"></i> <span>Settings</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/logout') }}">
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

      @yield('breadcrumb')

    </section>

    <!-- Main content -->
    <section class="content">

       @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style = "position: fixed; bottom: 0px; left: 0px; right: 0px">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="/">iPub.com</a></strong> . All rights reserved.
  </footer>

  @endif

@endsection
