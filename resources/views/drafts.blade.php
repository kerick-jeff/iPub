@extends('layouts.master')

@section('title', '| Drafts')

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
    <li class="active">Drafts</li>
</ol>
@endsection

@section('content')

<!-- alert user that mail has been successfully deleted -->
@if(session('deleted'))
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> <br />
         {{ session('deleted') }}
    </div>
@endif

<!-- alert user that mail has not been deleted -->
@if(session('notDeleted'))
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i>  <br />
         {{ session('notDeleted') }}
    </div>
@endif

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
            <li>
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
            <li class="active">
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
          <h3 class="box-title">Drafts</h3>

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
              <button type="button" class="btn btn-danger btn-sm" data-toggle = "modal" data-target = "#deletemail" title = "Delete"><i class="fa fa-trash"></i></button>
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                @foreach($drafts as $draft)
                  <tr>
                    <td><input type="checkbox" id = "{{ $draft->id }}"></td>
                    <td class="mailbox-name"><a href="{{ url('/mailbox/readmail/Drafts/'.$draft->id) }}">{{ $draft->recipient }}</a></td>
                    <td class="mailbox-subject"><b>iPub</b> - {{ $draft->subject }}   </td>
                    @if($draft->attachment != "")
                      <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                    @else
                      <td></td>
                    @endif
                    <td class="mailbox-date">{{ $draft->created_at }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->

          <!-- delete mail modal -->
            <div class="modal fade" id="deletemail" tabindex="-1" role="dialog" aria-labelledby="Mail" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                    <h4 class="modal-title" id="deletemailLabel">Delete Mail</h4>
                  </div>
                  <div class="modal-body">
                      <p> Are you sure you want to delete this mail(s)? </p>
                  </div>
                  <div class="modal-footer">
                    <form id="deleteform" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" id = "delete" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <!-- delete mail modal -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
            <div class="pull-right">
              {{ $drafts->render() }}
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

    $("#delete").click(function(){
      var ids = [];

      $("input:checkbox:checked").each(function () {
          if($(this).attr("id") != null)
            ids.push($(this).attr("id"));
      });

      $("#deleteform").attr("action", "/mailbox/deletemails/Drafts/" + JSON.stringify(ids));
    });
});
</script>

@endsection
