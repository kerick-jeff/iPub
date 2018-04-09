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
@if(session('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-check"></i> Success <br />
    {!! session('success') !!}
  </div>
@endif

@if(session('raterRegSuccess'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-check"></i> Success <br />
    {!! session('raterRegSuccess') !!}
  </div>
@endif

@if(session('raterRegError'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-close"></i> Error <br />
    {{ session('raterRegError') }}
  </div>
@endif

@if(session('raterNotFound'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-exclamation-circle"></i> Not Found <br />
    {!! session('raterNotFound') !!}
  </div>
@endif

@if(session('raterConfirmed'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-check"></i> Success <br />
    {!! session('raterConfirmed') !!}
  </div>
@endif


@if(session('raterNotConfirmed'))
  <div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-exclamation-circle"></i> Unconfirmed Account <br />
    {!! session('raterNotConfirmed') !!}
  </div>
@endif

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
            <ul id = "categories-list" class="nav nav-pills nav-stacked">
              @if(count($categories) > 0)
                @foreach($categories as $category)
                  @if(isset($activeLi) && $activeLi == $category)
                    <li class = "active">
                      <a href="/pubs/category/{{ str_replace('/', '-', $category) }}">{{ $category }}</a>
                    </li>
                  @else
                    <li>
                      <a href="/pubs/category/{{ str_replace('/', '-', $category) }}">{{ $category }}</a>
                    </li>
                  @endif
                @endforeach
              @endif
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
        @if (session('rater'))
          <a href = "/rating-mode/exit/{{ session('rater') }}" class="btn btn-danger btn-block" >Exit Rating Mode</a>
        @else
          <button type="button" class="btn btn-warning btn-block" data-toggle = "modal" data-target = "#enter-rating-mode">Enter Rating Mode</button>
        @endif
        <!-- Rating mode modal -->
          <div class="modal fade" id="enter-rating-mode" tabindex="-1" role="dialog" aria-labelledby="EnterRatingMode" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                  <h4 class="modal-title" id="enter-rating-mode-label">Enter Rating Mode</h4>
                </div>
                <form id="enter-rating-mode-form" action = "/rating-mode/enter" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="form-group has-feedback">
                      <input type="email" class="form-control" name = "email" id = "email" placeholder="Enter your email">
                      @if ($errors->has('email'))
                        <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Enter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <!-- Rating mode modal -->
      </div>
      <!-- /.box-header -->

      <div class="box-body table-responsive">
        <div class="form-group">
          <label class="sr-only" for="searchTerm">Enter search term</label>
          <div class="input-group" style = "outline: thin dotted; -webkit-box-shadow: 0 0 8px rgba(82,168,236,.6); box-shadow: 0 0 8px rgba(82,168,236,.6);">
            <input type="text" class="form-control" id="search" placeholder="Enter search term">
            <div class="input-group-btn">
              <a id = "btn-search" class="btn btn-default bg-aqua-active color-palette"><i class = "fa fa-search"></i></a>
            </div>
          </div>
          <div style = "margin-top: 2%; cursor: pointer;">
            <ul class="products-list product-list-in-box" id = "search-results"></ul >
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="row" style = "margin-bottom: 20px">
      <div class="col-md-12">
        @if(count($pubEntities) > 0)
          @foreach($pubEntities as $pubEntity)
              <!-- Box Comment -->
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <img class="img-circle" src="{{ url('/profile-picture/'.$pubEntity[2]->id.'/'.$pubEntity[2]->name.'/'.$pubEntity[2]->profile_picture) }}" alt="User Image">
                    <span class="username"><a data-toggle = "modal" data-target = "#more" data-userid = "{{ $pubEntity[2]->id }}" title = "View more about {{ $pubEntity[2]->name }}" style="cursor: pointer">{{ $pubEntity[2]->name }}</a></span>
                    <span class="description">
                      <i class = "fa fa-star starry"></i>
                      <i class = "fa fa-star starry"></i>
                      <i class = "fa fa-star-half-full starry"></i>
                      <i class = "fa fa-star-o starry"></i>
                      <i class = "fa fa-star-o starry"></i>
                    </span>
                    <span class="description">Posted publicly - {{ $pubEntity[0]->created_at->diffForHumans() }}</span>
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
                  <div class="mailbox-read-info">
                    <b>Title :</b> {{ $pubEntity[0]->title }}
                  </div>
                  <div class="mailbox-read-info">
                    <b>Description :</b> {{ $pubEntity[0]->description }}
                  </div>
                  <div class="mailbox-read-info">
                    @if (strstr($pubEntity[1]->type, 'image'))
                      <img class="img-responsive pad" src="{{ url('/pubs/display/photo/'.$pubEntity[2]->id.'/'.$pubEntity[2]->name.'/'.$pubEntity[1]->filename) }}" alt="Photo">
                    @elseif(strstr($pubEntity[1]->type, 'video'))
                      <video style="object-fit: fill; max-width: 100%; min-height: 320px; max-height: 100%" controls>
                        <source src="{{ url('/pubs/display/video/'.$pubEntity[2]->id.'/'.$pubEntity[2]->name.'/'.$pubEntity[1]->filename )}}" >
                        Your browser does not support the video tag.
                      </video>
                    @endif
                  </div>
                  <div class="mailbox-read-info">
                    <!--<button type="button" class="btn btn-success btn-xs" data-toggle = "popover"><i class="fa fa-share-alt"></i> Share</button> &nbsp;-->
                    @if(session('rater'))
                      @if($pubEntity[3])
                        <button type="button" id = "btn-rate-{{ $pubEntity[0]->id }}" class="rate btn btn-warning btn-xs" data-toggle = "popover" data-pub-id = '{{ $pubEntity[0]->id }}' ><i class="fa fa-star"></i> Rate</button> &nbsp;
                      @else
                        <button type="button" id = "btn-rate-{{ $pubEntity[0]->id }}" class="rate btn btn-warning btn-xs" data-toggle = "popover" data-pub-id = '{{ $pubEntity[0]->id }}' disabled><i class="fa fa-star"></i> Rate</button> &nbsp;
                      @endif

                      @if($pubEntity[4])
                        <span id = 'btn-like-{{ $pubEntity[0]->id }}'>
                          <button type="button" class="like btn btn-info btn-xs" title = "Like this pub" data-pub-id = '{{ $pubEntity[0]->id }}'><i class="fa fa-thumbs-up"></i> Like</button> &nbsp;
                        </span>
                      @else
                        <span id = 'btn-unlike-{{ $pubEntity[0]->id }}'>
                          <button type="button" class="unlike btn btn-info btn-xs" title = "Unlike this pub" data-pub-id = '{{ $pubEntity[0]->id }}'><i class="fa fa-thumbs-o-down"></i> Unlike</button> &nbsp;
                        </span>
                      @endif
                    @else
                      <button type="button" class="btn btn-xs" title = "Enter Rating Mode inorder to rate {{ $pubEntity[2]->name }}"><i class="fa fa-star-o" disabled ></i> Rate</button> &nbsp;
                      <button type="button" class="btn btn-xs" title = "Enter Rating Mode inorder to like this pub" disabled><i class="fa fa-thumbs-o-up"></i> Like</button> &nbsp;
                    @endif
                    <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#more" data-userid = "{{ $pubEntity[2]->id }}" title = "View more about {{ $pubEntity[2]->name }}" ><i class="fa fa-plus"> More</i></button>
                    <span class="pull-right text-muted">
                      <b id = 'likes-{{ $pubEntity[0]->id }}'>{{ $pubEntity[0]->likes == 1 ? $pubEntity[0]->likes." Like" : $pubEntity[0]->likes." Likes" }}</b>
                     </span>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          @endforeach
        @else
          <div class="alert alert-info alert-dismissible" role="alert"style="font-size: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class = "icon fa fa-exclamation-circle" ></i> 0 pubs found <br />
            No pubs available yet!!!
          </div>
        @endif

            <!-- more modal -->
            <div class="modal fade" id="more" tabindex="-1" role="dialog" aria-labelledby="More" aria-hidden="true" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                    <div class="user-block">
                      <img class="img-circle" id = "more-userimg" src="" alt="User Image">
                      <span class="username"><a id = "more-username"></a></span>
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
                          <a href = "#location" id = "more-tab-location" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-map"></i> Location</strong>
                          </a>
                        </li>
                        <li>
                          <a href = "#description" id = "more-tab-description" data-toggle = "tab" style = "color: #3c8dbc;">
                            <i class = "fa fa-file-text"></i> Description
                          </a>
                        </li>
                        <li>
                          <a href = "#links-contacts" id = "more-tab-links-contacts" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-link"></i> Links/Contacts</strong>
                          </a>
                        </li>
                        <li>
                          <a href = "#products-services" id = "more-tab-products-services" data-toggle = "tab" style = "color: #3c8dbc;">
                            <strong><i class = "fa fa-list-alt"></i> Products/Service</strong>
                          </a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <!-- Location tab -->
                        <div class="active tab-pane" id = "location">
                          <div  id ="map-canvas"> </div>
                        </div>

                        <!-- Description tab -->
                        <div class="tab-pane" id = "description">
                          <div id="more-description"> </div>
                        </div>

                        <!-- Links/Contacts tab -->
                        <div class="tab-pane" id = "links-contacts">
                          <ul class = "todo-list" id = "more-links-contacts"> </ul>
                        </div>

                        <!-- Products/Services tab -->
                        <div class="tab-pane" id = "products-services">
                          <div id = "more-products-services"> </div>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMEmwSkmHfq-9OA9Sq4-ecVmHSrfYFSts" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/map/map.js') }}" ></script>
  <script type="text/javascript">
      $("#search").keyup(function(){
          if(this.value.length == 0) {
              $("#search-results").html("");
              return;
          }

          getSearchResults(this.value);
      });

      $("#btn-search").click(function(){
          var searchTerm = $("#search").val();

          if(searchTerm.length == 0) {
              $("#search-results").html("");
              return;
          }

          getSearchResults(searchTerm);
      });

      function getSearchResults(searchTerm) {
          $.ajax({
              type : 'GET',
              url : '/pubs/search/' + searchTerm + "/json",
              data : "_token={{ csrf_token() }}",
              dataType : "json",
              success : function(results) {
                  var resultWrapper = "";
                  for(var i = 0; i < results.length; i++) {
                      if (results[i]['type'] == "user") {
                          var imgSrc = "/profile-picture/" + results[i]['content'].id + "/" + results[i]['content'].name + "/" + results[i]['content'].profile_picture;
                          resultWrapper += "<li class = 'item'>";
                          resultWrapper += "<div class='user-block'>";
                          resultWrapper += "<img class='img-circle img-sm' src='" + imgSrc + "' alt='User Image'>";
                          resultWrapper += "<span class='username' style = 'overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><a href = '/pubs/" + results[i]['content'].name + "/" + results[i]['content'].id + "'>" + results[i]['content'].name + "</a></span>";
                          resultWrapper += "<span class='description'>" + results[i]['content'].type + "</span>";
                          resultWrapper += "</div>";
                          resultWrapper += "</li>";
                      } else if (results[i]['type'] == 'category') {
                          resultWrapper += "<li class = 'item'>";
                          resultWrapper += "<div class='user-block'>";
                          resultWrapper += "<span class='username' style = 'overflow: hidden; white-space: nowrap; text-overflow: ellipsis'><a href = '/pubs/category/" + results[i]['content'].category.replace('/', '-') + "'>" + results[i]['content'].category + "</a></span>";
                          resultWrapper += "</div>";
                          resultWrapper += "</li>";
                      } else if (results[i]['type'] == 'title') {
                          resultWrapper += "<li class = 'item'>";
                          resultWrapper += "<ul class='products-list product-list-in-box' style = 'margin: 0'>";
                          resultWrapper += "<li class='item'>";
                          resultWrapper += "<div class='product-img' style = 'margin-right: 2%'>";
                          if (results[i]['associate'][1].type.indexOf("image") >= 0) {
                              resultWrapper += "<img style='max-width: 95%; max-height: 95%' src='/pubs/display/photo/" + results[i]['content'].user_id + "/" + results[i]['associate'][0] + "/" + results[i]['associate'][1].filename + "' alt='Product Image'>";
                          } else if (results[i]['associate'][1].type.indexOf("video") >= 0) {
                              resultWrapper += "<video style='object-fit: fill; width: 120px; height: 90px' controls>";
                              resultWrapper += "<source src='/pubs/display/video/" + results[i]['content'].user_id + "/" + results[i]['associate'][0] + "/" + results[i]['associate'][1].filename + "'>";
                              resultWrapper += "Your browser does not support the video tag.";
                              resultWrapper += "</video>";
                          }
                          resultWrapper += "</div>";
                          resultWrapper += "<div class='product-info' style = 'overflow: hidden; white-space: nowrap; text-overflow: ellipsis'>";
                          resultWrapper += "<span class='product-title'><a href = '/pubs/" + results[i]['content'].id + "'>" + results[i]['content'].title + "</a></span>";
                          resultWrapper += "<span class='product-description'>";
                          resultWrapper += results[i]['content'].description;
                          resultWrapper += "</span>";
                          resultWrapper += "</div>";
                          resultWrapper += "</li>";
                          resultWrapper += "</ul>"
                          resultWrapper += "</li>";
                      }
                  }

                  $("#search-results").html(resultWrapper);
              },
              error : function(error) {
                  alert(false);
                  console.log("error: ", error.status);
              }
          });
      }

      $(".rate").hover(function(e) {
          var pubId = $(e.target).data('pub-id');
          console.log(pubId);
          $(".rate[data-toggle=popover]").popover({
              html: true,
              trigger: 'focus',
              placement: 'top',
              content: function(){
                  return "<i id = 'rate1' class='starry fa fa-star-o' onmouseover = 'rate1MouseOver()' onmouseleave = 'rate1MouseLeave()' onclick = 'rate(" + pubId + ", 1)' style = 'cursor: pointer'></i> <i id = 'rate2' class='starry fa fa-star-o' onmouseover = 'rate2MouseOver()' onmouseleave = 'rate2MouseLeave()' onclick = 'rate(" + pubId + ", 2)' style = 'cursor: pointer'></i> <i id = 'rate3' class='starry fa fa-star-o' onmouseover = 'rate3MouseOver()' onmouseleave = 'rate3MouseLeave()' onclick = 'rate(" + pubId + ", 3)' style = 'cursor: pointer'></i> <i id = 'rate4' class='starry fa fa-star-o' onmouseover = 'rate4MouseOver()' onmouseleave = 'rate4MouseLeave()' onclick = 'rate(" + pubId + ", 4)' style = 'cursor: pointer'></i> <i id = 'rate5' class='starry fa fa-star-o' onmouseover = 'rate5MouseOver()' onmouseleave = 'rate5MouseLeave()' onclick = 'rate(" + pubId + ", 5)' style = 'cursor: pointer'></i>";
              }
          });
      });
    /*.on("mouseenter", function() {
          var _this = this;
          $(this).popover("show");
          $(".popover").on("mouseleave", function() {
              $(_this).popover("hide");
          });
      }).on("mouseleave", function() {
          var _this = this;
          setTimeout(function() {
              if(!$(".popover:hover").length) {
                  $(_this).popover("hide");
              }
          });
      });*/

      function rate(pubId, stars) {
          // stars = Math.ceil(Math.random() * 5);
          alert(pubId + " : " + stars);
          /*$.ajax({
              type : 'GET',
              url : '/pubs/rate/' + pubId + "/" + stars + "/json",
              data : "_token={{ csrf_token() }}",
              dataType : "json",
              success : function(rate) {
                  //alert(rate + " : " + stars);
                  $("#btn-rate-" + pubId).attr('disabled', 'disabled');
              },
              error : function(error) {
                  alert(error.status);
                  console.log("error: ", error.status);
              }
          });*/
      }

      function rate1MouseOver() {
          $("#rate1").removeClass("fa-star-o").addClass("fa-star");
      }

      function rate1MouseLeave() {
          $("#rate1").removeClass("fa-star").addClass("fa-star-o");
      }

      function rate2MouseOver() {
          $("#rate1, #rate2").removeClass("fa-star-o").addClass("fa-star");
      }

      function rate2MouseLeave() {
          $("#rate1, #rate2").removeClass("fa-star").addClass("fa-star-o");
      }

      function rate3MouseOver() {
          $("#rate1, #rate2, #rate3").removeClass("fa-star-o").addClass("fa-star");
      }

      function rate3MouseLeave() {
          $("#rate1, #rate2, #rate3").removeClass("fa-star").addClass("fa-star-o");
      }

      function rate4MouseOver() {
          $("#rate1, #rate2, #rate3, #rate4").removeClass("fa-star-o").addClass("fa-star");
      }

      function rate4MouseLeave() {
          $("#rate1, #rate2, #rate3, #rate4").removeClass("fa-star").addClass("fa-star-o");
      }

      function rate5MouseOver() {
          $("#rate1, #rate2, #rate3, #rate4, #rate5").removeClass("fa-star-o").addClass("fa-star");
      }

      function rate5MouseLeave() {
          $("#rate1, #rate2, #rate3, #rate4, #rate5").removeClass("fa-star").addClass("fa-star-o");
      }

      $(".like").click(function(e) {
          var pubId = $(e.target).data('pub-id');
          $.ajax({
              type : 'GET',
              url : '/pubs/like/' + pubId + "/json",
              data : "_token={{ csrf_token() }}",
              dataType : "json",
              success : function(likes) {
                  $("#btn-like-" + pubId).html("<button type='button' class='unlike btn btn-info btn-xs' title = 'Unlike this pub' data-pub-id = '" + pubId + "'><i class='fa fa-thumbs-o-down'></i> Unlike</button> &nbsp;");
                  $("#likes-" + pubId).html(likes == 1 ? likes + " Like | " : likes + " Likes | ");
              },
              error : function(error) {
                  alert(error.status);
                  console.log("error: ", error.status);
              }
          });
      });

      $(".unlike").click(function(e) {
          var pubId = $(e.target).data('pub-id');
          $.ajax({
              type : 'GET',
              url : '/pubs/unlike/' + pubId + "/json",
              data : "_token={{ csrf_token() }}",
              dataType : "json",
              success : function(likes) {
                  $("#btn-unlike-" + pubId).html("<button type='button' class='like btn btn-info btn-xs' title = 'Like this pub' data-pub-id = '" + pubId + "'><i class='fa fa-thumbs-up'></i> Like</button> &nbsp;");
                  $("#likes-" + pubId).html(likes == 1 ? likes + " Like | " : likes + " Likes | ");
              },
              error : function(error) {
                  alert(error.status);
                  console.log("error: ", error.status);
              }
          });
      });

      /*$(".rate").click(function(e) {
          var pubId = $(e.target).data('pub-id');
          //var stars = $(e.target).data('stars');
          var stars = Math.ceil(Math.random() * 5);
          $.ajax({
              type : 'GET',
              url : '/pubs/rate/' + pubId + "/" + stars + "/json",
              data : "_token={{ csrf_token() }}",
              dataType : "json",
              success : function(rate) {
                  alert(rate + " : " + stars);
                  //$("#btn-rate-" + pubId).attr('disabled', 'disabled');
              },
              error : function(error) {
                  alert(error.status);
                  console.log("error: ", error.status);
              }
          });
      });*/

      // when more modal is about to be shown
      $("#more").on('show.bs.modal', function(e){
          var userid = $(e.relatedTarget).data('userid');
          $.ajax({
              type : 'GET',
              url : '/user/' + userid + "/json",
              data : "_token={{ csrf_token() }}",
              dataType : "json",
              success : function(user) {
                  var imgSrc = "{!! url('/profile-picture/" + user.id + "/" + user.name + "/" + user.profile_picture + "') !!}";
                  $("#more #more-userimg").attr("src", imgSrc);
                  $("#more #more-username").html(user.name);

                  // display user's locations in modal
                  showLocation(user);

                  // display user's location in modal when location tab is clicked
                  $("#more #more-tab-location").click(function(){
                      showLocation(user);
                  });

                  // display user's description in modal when description tab is clicked
                  $("#more #more-tab-description").click(function(){
                      if(user.description != "") {
                          var result = "<textarea class='text-muted' id = 'more-description' rows = '8' style = 'font-size: 20px; border: none; width: 100%; padding: 2%' disabled >";
                          result += user.description;
                          result += "</textarea>";
                          $("#more #more-description").html(result);
                      } else {
                          var result = "<div class='alert alert-info alert-dismissible' role='alert' style='font-size: 20px'>";
                          result += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                          result += "No description provided!";
                          result += "</div>";
                          $("#more #more-description").html(result);
                      }
                  });

                  // display user's links/contacts in modal when links/contacts tab is clicked
                  $("#more #more-tab-links-contacts").click(function(){
                      $.ajax({
                          type : 'GET',
                          url : '/user/links/' + user.id + "/json",
                          data : "_token={{ csrf_token() }}",
                          dataType : "json",
                          success : function(links) {
                              if(links.length > 0) {
                                  var linksWrapper = "";
                                  for(var i = 0; i < links.length; i++) {
                                      linksWrapper += "<li style = 'font-size: 20px'>";
                                      linksWrapper += "<span class='text'> " + links[i].link + " </span>";
                                      linksWrapper += "<small class='label label-info'> " + links[i].caption + " </small>";
                                      linksWrapper += "</li>";
                                  }
                                  $("#more #more-links-contacts").html(linksWrapper);
                              } else {
                                  var result = "<div class='alert alert-info alert-dismissible' role='alert' style='font-size: 20px'>";
                                  result += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                                  result += "No links/contacts information found!";
                                  result += "</div>";
                                  $("#more #more-links-contacts").html(result);
                              }
                          },
                          error : function(error) {
                              console.log("error: ", error.status);
                          }
                      });
                  });

                  // display user's products/services in modal when products/services tab is clicked
                  $("#more #more-tab-products-services").click(function(){
                      $.ajax({
                          type : 'GET',
                          url : '/user/products-services/' + user.id + "/json",
                          data : "_token={{ csrf_token() }}",
                          dataType : "json",
                          success : function(products) {
                              if(products.length > 0) {
                                  var labels = ['primary', 'success', 'info', 'warning', 'danger'];
                                  var productsWrapper = "";
                                  for(var i = 0; i < products.length; i++) {
                                      productsWrapper += "<p class='text-muted' style = 'font-size: 20px'>";
                                      productsWrapper += "<span class='label label-" + labels[Math.floor(Math.random() * 5)] + "' style = 'white-space: pre-wrap; display: inline-flex'>" + products[i].name + "</span>";
                                      productsWrapper += "</p>";
                                  }
                                  $("#more #more-products-services").html(productsWrapper);
                              } else {
                                  var result = "<div class='alert alert-info alert-dismissible' role='alert' style='font-size: 20px'>";
                                  result += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                                  result += "No products/services information found!";
                                  result += "</div>";
                                  $("#more #more-products-services").html(result);
                              }
                          },
                          error : function(error) {
                              console.log("error: ", error.status);
                          }
                      });
                  });
              },
              error : function(error) {
                  console.log("error: " + error.status);
              }
          });
      });

      function showLocation(user) {
        $.ajax({
            type : 'GET',
            url : '/user/geolocation/' + user.id + "/json",
            data : "_token={{ csrf_token() }}",
            dataType : "json",
            success : function(locations) {
                if(navigator.geolocation){
                    if(locations.length > 0) {
                        $("#more #map-canvas").css({'width' : '100%', 'height' : '320px'});
                        displayMap(locations);
                    } else {
                        var result = "<div class='alert alert-info alert-dismissible' role='alert' style='font-size: 20px'>";
                        result += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                        result += "No location(s) available for display!";
                        result += "</div>";
                        $("#more #map-canvas").html(result);
                    }
                } else {
                    var result = "<div class='alert alert-info alert-dismissible' role='alert' style='font-size: 20px'>";
                    result += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                    result += "Sorry, geolocation services are not supported by your browser";
                    result += "</div>";
                    $("#more #map-canvas").html(result);
                }
            },
            error : function(error) {
                console.log("error: ", error.status);
            }
        });
      }

      $("#categories-list li").click(function(){
          $("*").removeClass("active");
          $(this).addClass("active");
      });
  </script>
@endsection
