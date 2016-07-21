@extends('layouts.master')

@section('css')
<style>
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>
@endsection

@section('content')
<section class="content">
    <div class="callout callout-warning">
        <h4><i class="fa fa-exclamation-triangle"> </i> Note</h4>
        <p>Your video should be less <b>120secs</b>.  Click 'SEE ALL VIDEOS' to see older videos</p>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Click me to upload a new video
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                  <div class="timeline-item " style="background:none; ">
                      <div class="fileUpload btn  btn-file btn-primary" style="width:98%;">
                          <span> CLICK HERE TO CHOOSE</span>
                          <input type="file" class="upload"  id="uploadBtn" name="video" style="border-radius:3px">
                      </div>
                      <span style="margin-left:9px;">
                          <input id="uploadFile" placeholder="Choose File" disabled="disabled" style="width:98%;margin-left:2px; border-radius:3px"/>
                      </span>
                      <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp
                          <form action="{{ url('/video/store') }}" method="POST" style="width:101%;">
                             {{ csrf_field() }}
                             <div class="form-group has-feedback" >
                                 <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" value="Title" placeholder="Title" style="border-radius:3px" >
                             </div>
                             <div class="form-group has-feedback">
                                 <label for="description">Brief description</label>
                                    <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px"></textarea>
                             </div>
                             @if(Auth::check())
                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                             @endif
                             <div class="row">
                                 <div class="col-xs-12">
                                     <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius:3px">UPLOAD
                                 </div>
                             </div>
                             &nbsp
                         </form>
                     </div>
                 </div>
              </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  See all videos
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"><!-- /.collapsible start -->
                <div class="panel-body" style="margin-left:60px"> <!-- panel-body start -->
                        <div class="timeline-item">  <!-- timeline-item start -->
                            <!---- CREATE ROWS FOR PHOTOS> EACH ROW HAS TW PHOTOS --->
                            <div class="row" style="margin-left:-7.5%"><!-- row start -->

                                <!-- DO A FOREACH HERE TO SHOW ALL THE VIDEOS -->

                                <!-- timeline item 1 -->
                                <div class="timeline-item col-sm-6">
                                    <div class="box box-widget">
                                        <div class="box-header with-border">
                                          <div class="user-block" style="margin-left:-50px">
                                            <span class="username">The title</span>
                                            <span class="description">Shared publicly - 7:30 PM Today</span>
                                          </div>
                                          <!-- /.user-block -->
                                          <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                          </div>
                                          <!-- /.box-tools -->
                                        </div>

                                      <div class="timeline-body box-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/rq10gi-biL8" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                      </div>
                                      <div class="box-body" style="margin-left:-8px">
                                        <p style="margin-left:10px"> What do you guys think? I am the description</p>
                                        <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="{{ url('/video/edit') }}" style="color:#fff">Edit</a></button>
                                        <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="{{ url('/video/delete') }}" style="color:#fff">Delete</a></button>
                                        <span class="pull-right text-muted">122,027 views - 84 ratings</span>
                                      </div>
                                  </div>
                                </div>
                                <!-- END timeline item 1 -->

                                <!-- timeline item  2-->
                                  <div class="timeline-item col-sm-6">
                                      <div class="box box-widget">
                                          <div class="box-header with-border">
                                            <div class="user-block" style="margin-left:-50px">
                                              <span class="username">The title</span>
                                              <span class="description">Shared publicly - 7:30 PM Today</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="box-tools">
                                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                              </button>
                                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                            <!-- /.box-tools -->
                                          </div>

                                        <div class="timeline-body box-body">
                                          <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen></iframe>
                                          </div>
                                        </div>
                                        <div class="box-body" style="margin-left:-8px">
                                          <p style="margin-left:10px"> What do you guys think? I am the description</p>
                                          <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="{{ url('/video/edit') }}" style="color:#fff">Edit</a></button>
                                          <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="{{ url('/video/delete') }}" style="color:#fff">Delete</a></button>
                                          <span class="pull-right text-muted">122,027 views - 84 ratings</span>
                                        </div>
                                    </div>
                                  </div>
                                <!-- END timeline item 2 -->

                            </div> <!-- row end -->
                        </div><!-- timeline-item end -->
                    </div><!-- panel-body start -->
                </div><!-- /.collapsible end -->
        </div>
    </div>
    <script>
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    </script>
</section>
@endsection
