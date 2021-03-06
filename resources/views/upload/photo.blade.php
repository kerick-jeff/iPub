@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('js/loading/waitMe.css') }}" media="screen" title="no title">
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
        #collapseOne { padding-right: 35px; }
        #collapseTwo { padding-right: 35px; }
    }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb" style="margin-top:-15px">
    <li><a href="/"><i class="fa fa-dashboard">iPub</i></a></li>
    <li>Upload</li>
    <li>Photo</li>
</ol>
@endsection

@section('content')
<section class="content" style="margin-top:-35px">

    <div class="alert alert-warning alert-dismissible" id="message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4><i class="fa fa-exclamation-triangle"> </i> Note</h4>
        <p><b>Your pictures should be of medium size.  Click 'SEE ALL PHOTOS' to see older photos</b></p>
    </div>


    @if(session('success'))
        <div class="alert alert-success alert-dismissible" id="sessionMessages" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('typeError'))
        <div class="alert alert-danger alert-dismissible" id="sessionMessages" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('typeError') }}
        </div>
    @endif
    @if(session('widthError'))
        <div class="alert alert-danger alert-dismissible" id="sessionMessages" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('widthError') }}
        </div>
    @endif
    @if(session('sizeError'))
        <div class="alert alert-danger alert-dismissible" id="sessionMessages" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('sizeError') }}
        </div>
    @endif
    @if(session('fileError'))
        <div class="alert alert-danger alert-dismissible" id="sessionMessages" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('fileError') }}
        </div>
    @endif
    @if(session('editFormMessage'))
        <div class="alert alert-danger alert-dismissible" id="sessionMessages" role="alert" style="width:100%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('editFormMessage') }}
        </div>
    @endif


    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default" id="panel2">
            <div class="panel-heading" role="tab" id="headingTwo" style="padding: 0px">
              <h4 class="panel-title">
                <button class="collapsed btn-block btn-primary" style="height: 50px; border-style: none" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Click me to upload a new photo
              </button>
              </h4>
            </div>
            <!-- It is the 'in' in the class attribute that makes this panel to be hidden by default -->
            <div id="collapseTwo" class="panel-collapse collapse {{ session('aria') ? session('aria') : '' }}" role="tabpanel" aria-labelledby="headingTwo">

              <div class="panel-body">
                  <div class="timeline-item " style="background:none;margin-top:-20px">
                      <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp
                          <form action="{{ url('/photo/store') }}" method="POST" style="width:101%;" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             {{ method_field('PUT') }}
                             <div class="fileUpload btn  btn-file btn-primary" style="width:100%; margin-left:2px">
                                 <span><i class="icon fa fa-file"></i>&nbsp;CLICK HERE TO CHOOSE</span>
                                 <input type="file" class="upload"  id="uploadBtn" name="photo" style="border-radius:3px" required>
                             </div>
                             <span style="margin-left:2px;">
                                 <input id="uploadFile" placeholder="Choose File" name="photo" disabled="disabled" style="width:100%; border-radius:3px"/>
                             </span>
                             <div class="form-group has-feedback  {{ $errors->has('title') ? ' has-error' : '' }}" >
                                 <label for="title">Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Title" style="border-radius:3px" >
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
                            <i class="icon fa fa-mouse-pointer"></i>&nbsp;       <option value="electronics">Electronics</option>
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
                                     <button type="submit" id="upload" class="btn btn-primary btn-block btn-flat" style="border-radius:3px"><i class="icon fa fa-upload"></i>&nbsp;UPLOAD
                                 </div>
                             </div>
                             &nbsp;
                         </form>
                     </div>
                 </div>
              </div>
            </div>
        </div>

        <div class="row" id="sessionMessages">
            <!-- Delete photo messages-->
            @if(session('successDelete'))
                <div class="alert alert-success alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('successDelete') }}
                </div>
            @endif
            @if(session('failDelete'))
                <div class="alert alert-danger alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('failDelete') }}
                </div>
            @endif

            <!-- Edit photo messages -->
            @if(session('successEdit'))
                <div class="alert alert-success alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class = "icon fa fa-check"></i> Edited <br />
                    {{ session('successEdit') }}
                </div>
            @endif
            @if(session('failEdit'))
                <div class="alert alert-danger alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class = "icon fa fa-icon-warning-sign"></i>&nbsp;
                    {{ session('failEdit') }}
                </div>
            @endif
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne" style="padding: 0px; margin-bottom:18px;">
              <h4 class="panel-title">
                <button  class="btn-block btn-primary" data-toggle="collapse" style="height: 50px; border-style: none" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                 See all photos
                </button>
              </h4>
            </div>
            <div>
                @if( count($pubs) === 0 )
                   <div class="alert alert-info alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <p style="text-align:centre; margin-left: 15px"><b><i class = "icon fa fa-info"></i>You have no photo. Upload a photo to get going.<b></p>
                   </div>
                @elseif( count($pubs) > 0)
            </div>
            <div id="collapseOne" class="panel-collapse collapse {{ session('aria') ? '' : 'in'}}" role="tabpanel" aria-labelledby="headingOne"><!-- /.collapsible start -->
                <div class="panel-body" style="margin-left:60px"> <!-- panel-body start -->
                <div class="timeline-item">  <!-- timeline-item start -->
                <div class="col-md-12" style="margin-left: -35px">
                    @foreach( $pubs as $pub )
                        <div class="col-md-6" style="height: 650px;margin-top: -20px;">
                            <div class="box box-widget">
                                  <div class="box-header with-border">
                                    <div class="user-block" style="margin-left:-40px">
                                      <span class="username"> {{ $pub->title }}</span>
                                      <span class="description">Shared publicly - {{ substr("$pub->created_at", 0, -9) }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="box-tools">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                    <!-- /.box-tools -->
                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body" style="min-height:500px">
                                   <div style="padding-left: 5%; min-height:400px;">
                                    <img class="img-responsive pad" src="{{ url('photo/' . $pub->pubFiles()->first()->filename )}}" alt="Photo"  style="
                                        max-height: 400px;
                                        object-fit: fill; position: absolute;
                                        margin: auto;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        bottom: 0;" />
                                   </div>
                                   <div style=" height:100px">
                                   <div class="eg" style=" background-color: #F0F0F0; border-radius: 3px;overflow: hidden; white-space: pre-wrap;text-overflow: ellipsis; margin-bottom: 10px; margin-top:10%;white-space: pre-wrap;      /* CSS3 */
   white-space: -moz-pre-wrap; /* Firefox */
   white-space: -pre-wrap;     /* Opera <7 */
   white-space: -o-pre-wrap;   /* Opera 7 */
   word-wrap: break-word;"> <span class="description" style="margin-left:10px;padding:10px auto;">{{$pub->description}} </span> </div>
                                    <button id="editButton" type="button" class="btn btn-primary btn-xs" style="margin-left:10px" data-toggle="modal" data-target="#alertEdit" data-id="{{ $pub->id }}" data-title="{{ $pub->title }}" data-description="{{ $pub->description }}" data-category="{{ $pub->category }}" data-subCategory="{{ $pub->sub_category }}"><i class="fa fa-pencil-square-o">&nbsp;Edit</i></button>
                                    <button id="deleteButton" type="button" class="btn btn-danger btn-xs" style="margin-left:10px" data-toggle="modal" data-target="#alertDelete" data-id ="{{ $pub->id }}"><i class="fa fa-trash-o">&nbsp;Delete</i></button>
                                    <span class="pull-right text-muted">{{ $pub->views }} views - {{ $pub->ratings }} ratings</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
                {{ $pubs->links() }}
                </div><!-- timeline-item end -->
                </div><!-- panel-body start -->
            </div><!-- /.collapsible end -->
        </div>
    </div>

<!-- Delete photo modal. pops up onclick of delete button -->
 <div class="modal fade" id="alertDelete" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                <h3 class="modal-title"><i class="fa fa-warning"></i>&nbsp;&nbsp;Alert</h3>
            </div>
            <div class="modal-body">
                <p> Do you really want to delete this pub?</p>
            </div>
            <div class="modal-footer">
            <form id="deleteForm" action="" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                 <div class="form-group"><input type="hidden" name="id" id = "id"></div>
                <button type="submit button" id="deleteYes" class="btn btn-primary">Yes</button>
                <button type="button" id="deleteNo" class="btn btn-danger"><a href="{{ url('upload/photo') }}" style="color:#fff; ">No</a></button>
            </form>

            </div>
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- example-modal -->
<!-- Delete modal end -->

<!-- Edit modal for photos-->
<div class="modal fade" id="alertEdit" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                <h3 class="modal-title"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Edit post</h3>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST" style="width:101%;">
                             {{ csrf_field() }}
                             {{ method_field('PATCH') }}
                             <div class="form-group"><input type="hidden" name="id" id = "id"></div>
                             <div class="form-group has-feedback  {{ $errors->has('title') ? ' has-error' : '' }}" >
                                 <label for="title">Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Title" style="border-radius:3px"   id="title" required>
                                 @if ($errors->has('title'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('title') }}</strong>
                                     </span>
                                 @endif
                             </div>
                             <div class="form-group has-feedback  {{ $errors->has('description') ? ' has-error' : '' }}">
                                 <label for="description">Brief description</label>
                                 <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px" id="description" required></textarea>
                                 @if ($errors->has('description'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('description') }}</strong>
                                     </span>
                                 @endif
                             </div>
                             <div class="form-group has-feedback">
                                 <label for="category">Category</label>
                                 <select class="form-control" name="category" style="border-radius:3px" id="category" required>
                                   <option value="electronics">Electronics</option>
                                   <option value="fashion">Fashion</option>
                                   <option value="sports">Sports</option>
                                   <option value="health">Health</option>
                                   <option value="ngo">NGO</option>
                                 </select>
                             </div>
                             <div class="form-group has-feedback">
                                 <label for="sub_category">Sub-category</label>
                                 <select class="form-control" name="sub_category" style="border-radius:3px" id="subCategory" required>
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
                             &nbsp;
                             <div class="form-group has-feedback" style="float:right">
                                <button id="update" type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><a href="{{ url('upload/photo') }}" style="color:#fff; ">Cancel</a></button>
                             </div>

                         </form>
            </div>
            <div class="modal-footer"></div>
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!--
<!-- Edit modal end -->


    <script>
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    </script>


</section>
@endsection

@section('javascript')

    <script type="text/javascript" src = "{{ asset('js/loading/waitMe.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $("#upload").click(function(){
                $("#body").waitMe({
                    effect: 'roundBounce',
                    text: 'Uploading...',
                    bg: 'rgba(255,255,255,0.7)',
                    color: '#3c8dbc',
                    sizeW: '',
                    sizeH: '',
                    source: '',
                    onClose: function(){}
                });
            });

            $("#deleteYes").click(function(){
                $("#body").waitMe({
                    effect: 'roundBounce',
                    text: 'Deleting...',
                    bg: 'rgba(255,255,255,0.7)',
                    color: '#3c8dbc',
                    sizeW: '',
                    sizeH: '',
                    source: '',
                    onClose: function(){}
                });
            });

            $("#deleteNo").click(function(){
                $("#body").waitMe({
                    effect: 'roundBounce',
                    text: 'Deleting...',
                    bg: 'rgba(255,255,255,0.7)',
                    color: '#3c8dbc',
                    sizeW: '',
                    sizeH: '',
                    source: '',
                    onClose: function(){}
                });
            });

            $("#update").click(function(){
                $("#body").waitMe({
                    effect: 'roundBounce',
                    text: 'Updating...',
                    bg: 'rgba(255,255,255,0.7)',
                    color: '#3c8dbc',
                    sizeW: '',
                    sizeH: '',
                    source: '',
                    onClose: function(){}
                });
            });

        $('#alertEdit').on('show.bs.modal', function(e){
            $('#alertEdit #title').val($(e.relatedTarget).data('title'));
            $('#alertEdit #description').val($(e.relatedTarget).data('description'));
            $('#alertEdit #category').select(category).val($(e.relatedTarget).data('category'));
            $('#alertEdit #subCategory').select(subCategory).val($(e.relatedTarget).data('subCategory'));
            $('#editForm').submit(function(){
                var id = $('#alertEdit #id').val($(e.relatedTarget).data('id'));
                var newTitle = $('#alertEdit #title').val();
                var newDescription = $('#alertEdit #description').val();
                var newCategory = $('#alertEdit #category').val();
                var newSubCategory = $('#alertEdit #subCategory').val();
                $("#editForm").attr("action", "/photo/edit/" + id + "/" + newTitle + "/" + newDescription + "/" + newCategory + "/" + newSubCategory);
            });
        });

        $('#alertDelete').on('show.bs.modal', function(e){
            $('#alertDelete #id').val($(e.relatedTarget).data('id'));
           // var id = $('#alertDelete #id').val($(e.relatedTarget).data('id'));
            var id = $(e.relatedTarget).data('id');
            $('#deleteForm').attr("action", "/photo/" + id + "/destroy" );
        });

        // This function is to hide the "Note" and session alerts after 30seconds
        setTimeout(function(){
            $("#message").hide();
            $("#sessionMessages").hide();
        }, 30000);

    });

    </script>
@endsection
