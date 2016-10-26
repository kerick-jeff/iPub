@extends('layouts.master')

@section('title', '| Inbox')

<!-- provide author and page description -->

@section('css')
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('ipub/plugins/iCheck/flat/blue.css') }}">
@endsection

@section('breadcrumb')
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>Mailbox</li>
    <li class="active">Inbox</li>
</ol>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
      <a href="{{ url('mailbox/compose') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Folders</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active">
              <a href="{{ url('/mailbox/inbox') }}">
                <i class="fa fa-inbox"></i> Inbox
                <span class="label label-info pull-right">16</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/mailbox/sent') }}">
                <i class="fa fa-send"></i> Sent
                <span class="label pull-right bg-green">4</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/mailbox/drafts') }}">
                <i class="fa fa-file-text"></i> Drafts
                <span class="label label-warning pull-right">5</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Inbox</h3>

          <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-primary btn-sm checkbox-toggle" data-toggle = "tooltip" title = "Mark All"><i class="fa fa-square-o"></i></button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle = "tooltip" title = "Delete"><i class="fa fa-trash"></i></button>
            <div class="pull-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="{{ url('/mailbox/readmail/Inbox/1') }}">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">4 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="{{ url('/mailbox/readmail/Inbox/2') }}">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"></td>
                <td class="mailbox-date">12 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="{{ url('/mailbox/readmail/Inbox/3') }}">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">12 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="{{ url('/mailbox/readmail/Inbox/4') }}">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">14 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="{{ url('/mailbox/readmail/Inbox/5') }}">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">15 days ago</td>
              </tr>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-primary btn-sm checkbox-toggle" data-toggle = "tooltip" title = "Mark All"><i class="fa fa-square-o"></i></button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle = "tooltip" title = "Delete"><i class="fa fa-trash"></i></button>
            <div class="pull-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
        </div>
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

@endsection

@section('javascript')

<!-- iCheck -->
<script src="{{ asset('ipub/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Page Script -->
<script>
$(document).ready(function() {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
});
</script>

@endsection
