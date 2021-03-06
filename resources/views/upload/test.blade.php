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
    @@media (max-width: 767px) {
        #collapseOne {
            padding-right: 35px;
        }
    }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb" style="margin-top:-15px">
    <li><a href="/"><i class="fa fa-dashboard">iPub</i></a></li>
    <li>Upload</li>
    <li>Video</li>
</ol>
@endsection

@section('content')
<section class="content" style="margin-top:-35px">
    <div class="callout callout-info">
        <h4><i class="fa fa-exclamation-triangle"> </i> Note</h4>
        <p>Your video should be less <b>120secs</b>.  Click 'SEE ALL VIDEOS' to see older videos</p>
    </div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">         
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Click me to upload a new video
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('typeError'))
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         {{ session('typeError') }}
                    </div>
                @endif
                @if(session('lengthError'))
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         {{ session('lengthError') }}
                    </div>
                @endif
                @if(session('fileError'))
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         {{ session('fileError') }}
                    </div>
                @endif
              <div class="panel-body">
                  <div class="timeline-item " style="background:none;margin-top:-20px">
                      <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp;
                          <form action="{{ url('/video/store') }}" method="POST" style="width:101%;" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             <div class="fileUpload btn  btn-file btn-primary" style="width:100%; margin-left:2px">
                                 <span> CLICK HERE TO CHOOSE</span>
                                 <input type="file" class="upload"  id="uploadBtn" name="video" style="border-radius:3px" required>
                             </div>
                             <span style="margin-left:2px;">
                                 <input id="uploadFile" placeholder="Choose File" name="video" disabled="disabled" style="width:100%;border-radius:3px"; border-radius:3px"/>
                             </span>
                             <div class="form-group has-feedback {{ $errors->has('title') ? ' has-error' : '' }}" >
                                 <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" value="Title" placeholder="Title" style="border-radius:3px" >
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                             </div>
                             <div class="form-group has-feedback  {{ $errors->has('description') ? ' has-error' : '' }}">
                                 <label for="description">Brief description</label>
                                    <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                             </div>
                             <div class="form-group has-feedback">
                                 <label for="category">Category</label>
                                 <select class="form-control" name="category" style="border-radius:3px">
                                   <option value="electronics">Electronics</option>
                                   <option value="fashion">Fashion</option>
                                   <option value="sports">Sports</option>
                                   <option value="health">Health</option>
                                   <option value="ngo">NGO</option>
                                 </select>
                             </div>
                             <div class="form-group has-feedback">
                                 <label for="sub_category">Sub-category</label>
                                 <select class="form-control" name="sub_category" style="border-radius:3px">
                                   <option value="electronics">Electronics</option>
                                   <option value="fashion">Fashion</option>
                                   <option value="sports">Sports</option>
                                   <option value="health">Health</option>
                                   <option value="ngo">NGO</option>
                                 </select>
                             </div>
                             @if(Auth::check())
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                             @endif
                             <div class="row">
                                 <div class="col-xs-12">
                                     <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius:3px">UPLOAD
                                 </div>
                             </div>
                             &nbsp;
                         </form>
                     </div>
                 </div>
              </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                 See all videos
                </a>
              </h4>
            </div>

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne"><!-- /.collapsible start -->
                <div class="panel-body" style="margin-left:60px"> <!-- panel-body start -->
                        <div class="timeline-item">  <!-- timeline-item start -->
                            <!-- CREATE ROWS FOR VIDEOS> EACH ROW HAS TW VIDEOS -->
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