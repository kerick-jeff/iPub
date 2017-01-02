@extends('layouts.pubs.master')

@section('title', "| Pubs")

<!-- provide author and page desc -->

@section('css')
  <style media="screen">
    .pull-right-container {
      position: absolute;
      right: 10px;
      top: 40%;
      margin-top: -7px;
    }

    @media(max-width: 390px){
      #navigation {
        margin-top: 25%;
      }
    }

    @media(max-width: 992px){
      #navigation {
        display: none;
      }
    }
  </style>
@endsection

@section('content')

<div class="row">
  <div class="col-md-3">
    <!-- Categories -->
    <div class="box box-primary" id = "categories">
      <div class="box-header with-border">
        <h3 class="box-title"><a>Categories</a></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->

      <div class="box-body">
        <div class="box box-solid">
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li class="active">
                <a href="#">
                  <i class="fa fa-circle-o text-red"></i> <span>category 1</span>
                </a>
              </li>
              <li class="dropdown" id = "cat_dropdown">
                <a class="dropdown-toggle" id = "cat_dropdown" data-toggle="dropdown" href="#">
                  <i class = "fa fa-circle-o text-green"></i> <span>Dropdown</span>
                  <span class="pull-right-container" >
                    <i class = "fa fa-angle-down"></i>
                  </span>
                </a>
                <ul class="dropdown-menu" style = "min-width: 100%">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-circle-o text-blue"></i> <span>category 3</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-circle-o text-blue"></i> <span>category 4</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-circle-o text-blue"></i> <span>category 5</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-circle-o text-blue"></i> <span>category 6</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- /.box-body -->
        </div>

      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->
  </div>

  <div class="col-md-6">
    <!-- Pubs -->
    <div class="box box-primary" id = "pubs">
      <div class="box-header with-border">
        <button type="button" class="btn btn-success btn-block">Enter Follow Mode</button>
      </div>
      <!-- /.box-header -->

      <div class="box-body">
        <div class="form-group">
          <label class="sr-only" for="searchTerm">Enter search term</label>
          <div class="input-group" style = "outline: thin dotted; -webkit-box-shadow: 0 0 8px rgba(82,168,236,.6); box-shadow: 0 0 8px rgba(82,168,236,.6);">
            <input type="text" class="form-control" id="searchTerm" placeholder="Enter search term">
            <div class="input-group-addon">
              <a href="#"><i class = "fa fa-search"></i></a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="row" style = "margin-bottom: 20px">
      <div class="col-md-12">
          <!-- Box Comment -->
            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="user-block">
                  <img class="img-circle" src="land1.jpg" alt="User Image">
                  <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                  <span class="description">Shared publicly - 7:30 PM Today</span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <img class="img-responsive pad" src="land2.jpg" alt="Photo">

                <p>I took this photo this morning. What do you guys think?</p>
                <button type="button" class="btn btn-info btn-xs" data-toggle = "popover"><i class="fa fa-share"></i> Share</button> &nbsp;
                <button type="button" class="btn btn-warning btn-xs" title = "Rate ..."><i class="fa fa-star"></i> Rate</button> &nbsp;
                <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#more" title = "View more about ..." ><i class="fa fa-plus"> More</i></button>
                <span class="pull-right text-muted">127 likes - 3 comments</span>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- Box Comment -->
            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="user-block">
                  <img class="img-circle" src="land1.jpg" alt="User Image">
                  <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                  <span class="description">Shared publicly - 7:30 PM Today</span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <img class="img-responsive pad" src="land3.jpg" alt="Photo">

                <p>I took this photo this morning. What do you guys think?</p>
                <button type="button" class="btn btn-info btn-xs"><i class="fa fa-share"></i> Share</button>
                <button type="button" class="btn btn-success btn-xs"><i class="fa fa-star"></i> Rate</button>
                <button type="button" class = "btn btn-primary btn-xs"><i class="fa fa-plus"> More</i></button>
                <span class="pull-right text-muted">127 likes - 3 comments</span>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- more modal -->
            <div class="modal fade" id="more" tabindex="-1" role="dialog" aria-labelledby="More" aria-hidden="true" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                    <div class="user-block">
                      <img class="img-circle" src="land1.jpg" alt="User Image">
                      <span class="username"><a>Jonathan Burke Jr.</a></span>
                      <span class="description">
                        <i class = "fa fa-star starry"></i>
                        <i class = "fa fa-star starry"></i>
                        <i class = "fa fa-star-half-full starry"></i>
                        <i class = "fa fa-star-o starry"></i>
                        <i class = "fa fa-star-o starry"></i>
                      </span>
                    </div>
                    <!-- /.user-block -->
                  </div>
                  <div class="modal-body">
                    <div class="nav-tabs-custom spacious-bottom">
                      <ul class="nav nav-tabs">
                        <li class = "active">
                          <a href = "#location" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-map"></i> Location</strong>
                          </a>
                        </li>
                        <li>
                          <a href = "#description" data-toggle = "tab" style = "color: #3c8dbc;">
                            <i class = "fa fa-file-text"></i> Description
                          </a>
                        </li>
                        <li>
                          <a href = "#links-contacts" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-link"></i> Links/Contacts</strong>
                          </a>
                        </li>
                        <li>
                          <a href = "#products-services" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-list-alt"></i> Products/Service</strong>
                          </a>
                        </li>
                        <li>
                          <a href = "#tour-video" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-video-camera"></i> Tour Video</strong>
                          </a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <!-- Location tab -->
                        <div class="active tab-pane" id = "location">
                          location body
                        </div>

                        <!-- Description tab -->
                        <div class="tab-pane" id = "description">
                          description body
                        </div>

                        <!-- Links/Contacts tab -->
                        <div class="tab-pane" id = "links-contacts">
                          links and contacts body
                        </div>

                        <!-- Products/Services tab -->
                        <div class="tab-pane" id = "products-services">
                          products and services body
                        </div>

                        <!-- Tour Video tab -->
                        <div class="tab-pane" id = "tour-video">
                          tour video body
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>

  </div>

  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><a><i class = "fa fa-calendar"></i> Events</a></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="item active">
              <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">

              <div class="carousel-caption">
                First Slide
              </div>
            </div>
            <div class="item">
              <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

              <div class="carousel-caption">
                Second Slide
              </div>
            </div>
            <div class="item">
              <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

              <div class="carousel-caption">
                Third Slide
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- Priority Zone -->
    <div class="box box-primary" id = "priority-zone">
      <div class="box-header with-border">
        <h3 class="box-title"><a>Priority Zone</a></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->

      <div class="box-body">
        <ul class = "product-list product-list-in-box" style = "list-style-type: none; margin-left: -40px">
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="{{ asset('land1.jpg') }}" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="{{ asset('land2.jpg') }}" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="{{ asset('land1.jpg') }}" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="{{ asset('land3.jpg') }}" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
        </ul>
      </div>
      <!-- /.box-body -->

      <div class="box-footer text-center">
        <a href="#">View All</a>
      </div>
      <br /> <br />
    </div>
    <!-- /.box -->
  </div>
</div>

@endsection

@section('javascript')
  <script type="text/javascript">
      $("button[data-toggle=popover]").popover({
          html: true,
          trigger: 'focus',
          placement: 'top',
          content: function(){
              return "<span id='popover'><a href='#' class='btn btn-xs btn-primary'> <i class='fa fa-facebook'></i> </a> <a href='#' class='btn btn-xs btn-info'> <i class='fa fa-twitter' ></i> </a> <a href='#' class='btn btn-xs btn-success'> <i class='fa fa-whatsapp' ></i> </a></span>";
          }
      });
      $("a[data-toggle=dropdown]").hover(function(){
          var id = $(this).attr("id");
          $("li.dropdown#" + id).addClass("open");
      });
      $("li.dropdown").mouseleave(function(){
          $(this).removeClass("open");
      });
  </script>
@endsection
