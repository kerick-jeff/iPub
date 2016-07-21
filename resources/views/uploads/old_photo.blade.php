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
  <!-- Main content -->
<section class="content">
    <div class="callout callout-warning">
        <h4>Note</h4>
        <p>Your pictures should be of a medium size.  Click 'SEE ALL PUBS' to see older photos</p>
    </div>

    <div class="row">
    <div id="accordion" role="tablist" aria-multiselectable="true">
        <div class="col-md-12">
            <ul class="timeline">
                <li>
                    <i class="fa fa-photo bg-aqua"></i>
                    <div class="timeline-item" style="border-radius:2px; margin-right:60px">
                        <div class="col-xs-12">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <button type="submit" class="btn btn-info btn-lg btn-block btn-flat" style="border-radius:3px">
                                    UPLOAD
                                </button>
                            </a>
                        </div>
                    </div>
                </li>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" style="margin-left:130px; margin-right:85px">
                <li>
                    <div class="timeline-item " style="background:none; margin-right:50px">
                        <div class="fileUpload btn  btn-file btn-primary" style="width:96.5%;">
                            <span> CLICK HERE TO CHOOSE</span>
                            <input type="file" class="upload"  id="uploadBtn" name="photo" style="border-radius:3px">
                        </div>
                        <span style="margin-left:9px;">
                            <input id="uploadFile" placeholder="Choose File" disabled="disabled" style="width:96.5%;margin-left:2px; border-radius:3px"/>
                        </span>
                        <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp
                            <form action="#" method="POST">
                                {{ csrf_field() }}
                              <div class="form-group has-feedback">
                                  <label for="title">Title</label>
                                <input type="email" class="form-control" name="titl" value="Title" placeholder="Title" style="border-radius:3px">
                              </div>
                              <div class="form-group has-feedback">
                                   <label for="description">Brief description</label>
                                <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px"></textarea>
                              </div>
                              <div class="row">
                                <!-- /.col -->
                                <div class="col-xs-12">
                                  <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius:3px">UPLOAD
                                <!-- /.col -->
                               </div>
                            </div>
                               &nbsp
                            </form>
                        </div>
                    </div>
                </li>
                    </div>
                    <li><i class="fa fa-camera bg-purple"></i></li>
                <li>
                    <div class="timeline-item" style="border-radius:2px; margin-right:60px">
                      <div class="col-xs-12">
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              <button type="submit" class="btn btn-info btn-lg btn-block btn-flat" style="border-radius:3px">
                                  SEE ALL PUBS
                              </button>
                          </a>
                      </div>
                  </div>
                </li>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div style="margin-right: 85px; margin-left:85px">
                            <!-- timeline time label -->
                            <li class="time-label">
                                  <span class="bg-green">
                                    3 Jan. 2014
                                  </span>
                            </li>
                            <!-- /.timeline-label -->
                            <li>
                              <div class="timeline-item">
                                <span class="time pull-right"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                  <img src="{{ asset('images/land1.jpg') }}" class="img-rounded" alt="..." class="margin" height="120px">
                                  <img src="{{ asset('images/land1.jpg') }}" class="img-rounded" alt="..." class="margin" height="120px">
                                  <img src="{{ asset('images/land1.jpg') }}" class="img-rounded" alt="..." class="margin" height="120px">
                                  <img src="{{ asset('images/land1.jpg') }}" class="img-rounded" alt="..." class="margin" height="120px">
                                </div>
                              </div>
                            </li>
                        </div>
                </div>
            </ul>
        </div>
        <!-- /.col -->
    </div>
    </div>
    <!-- /.row -->
    <script>
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    </script>
</section>

@endsection
