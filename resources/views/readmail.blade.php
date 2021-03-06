@extends('layouts.master')

@section('title', '| Read Mail')

<!-- provide author and page description -->

@section('css')
  <link rel="stylesheet" href="{{ asset('js/loading/waitMe.css') }}" media="screen" title="no title">
@endsection

@section('breadcrumb')
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> iPub </a></li>
    <li>Mailbox</li>
    <li><a href="{{ url('/mailbox/'.$category) }}">{{ $category }}</a></li>
    <li class="active">Read Mail</li>
</ol>
@endsection

@section('content')

@if($errors->has('recipient'))
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> Failed <br />
         {{ $errors->first('recipient') }}
    </div>
@endif

@if(session('sent'))
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> Success <br />
         {{ session('sent') }}
    </div>
@endif

@if(session('notSent'))
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> Failed <br />
         {{ session('notSent') }}
    </div>
@endif

@if(session('forwarded'))
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> Success <br />
         {{ session('forwarded') }}
    </div>
@endif

@if(session('notForwarded'))
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> Failed <br />
         {{ session('notForwarded') }}
    </div>
@endif


<div class="row">
  <div class="col-md-3">
          <a href="{{ url('/mailbox/compose') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                @if($category == "Inbox")
                  <li class="active">
                    <a href="{{ url('/mailbox/inbox') }}">
                      <i class="fa fa-inbox"></i> Inbox
                      <span class="label label-info pull-right"><b id = "numInbox">{{ session('noInbox') }}</b></span>
                    </a>
                  </li>
                @else
                  <li>
                    <a href="{{ url('/mailbox/inbox') }}">
                      <i class="fa fa-inbox"></i> Inbox
                      <span class="label label-info pull-right"><b id = "numInbox">{{ session('noInbox') }}</b></span>
                    </a>
                  </li>
                @endif

                @if($category == "Sent")
                  <li class = "active">
                    <a href="{{ url('/mailbox/sent') }}">
                      <i class="fa fa-send"></i> Sent
                      <span class="label pull-right bg-green"><b id = "numSent">{{ session('noSent') }}</b></span>
                    </a>
                  </li>
                @else
                  <li>
                    <a href="{{ url('/mailbox/sent') }}">
                      <i class="fa fa-send"></i> Sent
                      <span class="label pull-right bg-green"><b id = "numSent">{{ session('noSent') }}</b></span>
                    </a>
                  </li>
                @endif

                @if($category == "Drafts")
                  <li class = "active">
                    <a href="{{ url('/mailbox/drafts') }}">
                      <i class="fa fa-file-text"></i> Drafts
                      <span class="label label-warning pull-right"><b id = "numDrafts">{{ session('noDrafts') }}</b></span>
                    </a>
                  </li>
                @else
                  <li>
                    <a href="{{ url('/mailbox/drafts') }}">
                      <i class="fa fa-file-text"></i> Drafts
                      <span class="label label-warning pull-right"><b id = "numDrafts">{{ session('noDrafts') }}</b></span>
                    </a>
                  </li>
                @endif

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary" style = "margin-bottom: 20%">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                @if($hasPrevious == true)
                  <a href="/mailbox/readmail/{{ $category }}/{{ $previous }}" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                @else
                  <a class="btn btn-box-tool" disabled ><i class="fa fa-chevron-left"></i></a>
                @endif

                @if($hasNext == true)
                  <a href="/mailbox/readmail/{{ $category }}/{{ $next }}" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                @else
                  <a class="btn btn-box-tool" disabled ><i class="fa fa-chevron-right"></i></a>
                @endif
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                Subject: {{ $readmail->subject }} <span class="mailbox-read-time pull-right">{{ $readmail->created_at->diffForHumans() }}</span></h5>
              </div>
              <div class="mailbox-read-info">
                @if($category == "Inbox")
                  <h5>From: {{ $readmail->sender }}
                @else
                  <h5>To: {{ $readmail->recipient }}
                @endif
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message">
                Body:
                <p>
                  {!! $readmail->body !!}
                </p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            @if($readmail->attachment != "")
              <div class="box-footer">
                Attachment:
                <ul class="mailbox-attachments clearfix">
                  <li>
                    <div class="mailbox-attachment-info">
                      <a href="{{ url('/download/'.$readmail->attachment) }}" class="mailbox-attachment-name" style = "word-wrap: break-word"><i class="fa fa-file"></i> {{ $readmail->attachment }}</a>
                          <span class="mailbox-attachment-size">
                            {{ FileMetric::represent($attachmentSize) }}
                            <a href="{{ url('/download/'.$readmail->attachment) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                          </span>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.box-footer -->
            @endif
            <div class="box-footer">
              <div class="pull-right">
                @if($category == "Drafts")
                  <form action="/mailbox/send/sendSaved/{{ $category }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{ $readmail->id }}">
                    <input type="hidden" name="sender" value="{{ $readmail->sender }}">
                    <input type="hidden" name="recipient" value="{{ $readmail->recipient }}">
                    <input type="hidden" name="subject" value="{{ $readmail->subject }}">
                    <input type="hidden" name="body" value="{{ $readmail->body }}">
                    <input type="hidden" name="attachment" value="{{ $readmail->attachment }}">

                    <button type="submit" name="send" id = "send" class = "btn btn-primary"><i class = "fa fa-send"></i> Send</button>
                  </form>
                @elseif($category == "Sent")
                  <button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#forwardmail"><i class="fa fa-mail-forward"></i> Forward</button>
                @else
                  <button type="button" class="btn btn-primary"><i class="fa fa-reply"></i> Reply</button>
                @endif
              </div>

              <button type="button" class="btn btn-danger" data-toggle = "modal" data-target = "#deletemail"><i class="fa fa-trash-o"></i> Delete</button>

            </div>
            <!-- /.box-footer -->

            <!-- delete mail modal -->
              <div class="modal fade" id="deletemail" tabindex="-1" role="dialog" aria-labelledby="Mail" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="deleteMailLabel">Delete Mail</h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this mail? </p>
                    </div>
                    <div class="modal-footer">
                      <form id="deleteform" action = "/mailbox/delete/{{ $category }}/{{ $readmail->id }}" method="POST">
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

            <!-- forward mail modal -->
              <div class="modal fade" id="forwardmail" tabindex="-1" role="dialog" aria-labelledby="Mail" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="deleteMailLabel">Forward Mail</h4>
                    </div>
                    <form id="forwardform" action = "/mailbox/forward/{{ $category }}" method="POST">
                      {{ csrf_field() }}

                      <input type="hidden" name="id" value="{{ $readmail->id }}">
                      <input type="hidden" name="sender" value="{{ $readmail->sender }}">
                      <input type="hidden" name="recipient" value="{{ $readmail->recipient }}">
                      <input type="hidden" name="subject" value="{{ $readmail->subject }}">
                      <input type="hidden" name="body" value="{{ $readmail->body }}">
                      <input type="hidden" name="attachment" value="{{ $readmail->attachment }}">

                      <div class="modal-body">
                        <div class="form-group">
                          <input type = "email" name = "recipient" class="form-control" placeholder="To:">
                          @if ($errors->has('recipient'))
                              <span class="help-block" style = "color: #DD4B39 !important;">
                                  <strong>{{ $errors->first('recipient') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <input type = "text" name = "subject" class="form-control" value = "{{ $readmail->subject }}" readonly />
                        </div>
                        <div class="form-group">
                          <textarea name = "body" id="compose-textarea" class="form-control" style="height: 100px" readonly > {{ $readmail->body }} </textarea>
                        </div>
                        @if($readmail->attachment != "")
                          <ul class="mailbox-attachments clearfix">
                            <li>
                              <div class="mailbox-attachment-info">
                                <a href="{{ url('/download/'.$readmail->attachment) }}" class="mailbox-attachment-name" style = "word-wrap: break-word"><i class="fa fa-file"></i> {{ $readmail->attachment }}</a>
                                    <span class="mailbox-attachment-size">
                                      {{ FileMetric::represent($attachmentSize) }}
                                      <a href="{{ url('/download/'.$readmail->attachment) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                              </div>
                            </li>
                          </ul>
                        @endif
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name = "forward" id = "forward" class="btn btn-primary"><i class = "fa fa-send"></i> Send</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- forward mail modal -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection

@section('javascript')
<script type="text/javascript" src = "{{ asset('js/loading/waitMe.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // check number of inbox, sent and drafts mailItems after every 10s
        setInterval(function(){
          $.ajax({
              type: 'POST',
              url: '/mailbox/check',
              data: '_token={{ csrf_token() }}',
              success: function(data){
                  $("#numInbox").html(data.numInbox);
                  $("#numSent").html(data.numSent);
                  $("#numDrafts").html(data.numDrafts);
              }
          });
        }, 10000);

        $("#send, #forward").click(function(){
            $("#body").waitMe({
                effect: 'roundBounce',
                text: 'Sending ...',
                bg: 'rgba(255,255,255,0.7)',
                color: '#3c8dbc',
                sizeW: '',
                sizeH: '',
                source: '',
                onClose: function(){}
            });
        });

        $("#delete").click(function(){
            $("#body").waitMe({
                effect: 'roundBounce',
                text: 'Deleting mail',
                bg: 'rgba(255,255,255,0.7)',
                color: '#3c8dbc',
                sizeW: '',
                sizeH: '',
                source: '',
                onClose: function(){}
            });
        });
    });
</script>
@endsection
