<?php $__env->startSection('title', "| Pubs"); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-check"></i> Success <br />
    <?php echo session('success'); ?>

  </div>
<?php endif; ?>

<?php if(session('raterRegSuccess')): ?>
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-check"></i> Success <br />
    <?php echo session('raterRegSuccess'); ?>

  </div>
<?php endif; ?>

<?php if(session('raterRegError')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-close"></i> Error <br />
    <?php echo e(session('raterRegError')); ?>

  </div>
<?php endif; ?>

<?php if(session('raterNotFound')): ?>
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-exclamation-circle"></i> Not Found <br />
    <?php echo session('raterNotFound'); ?>

  </div>
<?php endif; ?>

<?php if(session('raterConfirmed')): ?>
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-check"></i> Success <br />
    <?php echo session('raterConfirmed'); ?>

  </div>
<?php endif; ?>


<?php if(session('raterNotConfirmed')): ?>
  <div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class = "icon fa fa-exclamation-circle"></i> Unconfirmed Account <br />
    <?php echo session('raterNotConfirmed'); ?>

  </div>
<?php endif; ?>

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
              <?php if(count($categories) > 0): ?>
                <?php foreach($categories as $category): ?>
                  <?php if(isset($activeLi) && $activeLi == $category): ?>
                    <li class = "active">
                      <a href="/pubs/category/<?php echo e(str_replace('/', '-', $category)); ?>"><?php echo e($category); ?></a>
                    </li>
                  <?php else: ?>
                    <li>
                      <a href="/pubs/category/<?php echo e(str_replace('/', '-', $category)); ?>"><?php echo e($category); ?></a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
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
        <?php if(session('rater')): ?>
          <a href = "/rating-mode/exit/<?php echo e(session('rater')); ?>" class="btn btn-danger btn-block" >Exit Rating Mode</a>
        <?php else: ?>
          <button type="button" class="btn btn-warning btn-block" data-toggle = "modal" data-target = "#enter-rating-mode">Enter Rating Mode</button>
        <?php endif; ?>
        <!-- Rating mode modal -->
          <div class="modal fade" id="enter-rating-mode" tabindex="-1" role="dialog" aria-labelledby="EnterRatingMode" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                  <h4 class="modal-title" id="enter-rating-mode-label">Enter Rating Mode</h4>
                </div>
                <form id="enter-rating-mode-form" action = "/rating-mode/enter" method="POST">
                  <?php echo e(csrf_field()); ?>

                  <div class="modal-body">
                    <div class="form-group has-feedback">
                      <input type="email" class="form-control" name = "email" id = "email" placeholder="Enter your email">
                      <?php if($errors->has('email')): ?>
                        <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                      <?php endif; ?>
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
        <?php if(count($pubEntities) > 0): ?>
          <?php foreach($pubEntities as $pubEntity): ?>
              <!-- Box Comment -->
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <img class="img-circle" src="<?php echo e(url('/profile-picture/'.$pubEntity[2]->id.'/'.$pubEntity[2]->name.'/'.$pubEntity[2]->profile_picture)); ?>" alt="User Image">
                    <span class="username"><a href="#"><?php echo e($pubEntity[2]->name); ?></a></span>
                    <span class="description">Shared publicly - <?php echo e($pubEntity[0]->created_at->diffForHumans()); ?></span>
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
                    <b>Title :</b> <?php echo e($pubEntity[0]->title); ?>

                  </div>
                  <div class="mailbox-read-info">
                    <b>Description :</b> <?php echo e($pubEntity[0]->description); ?>

                  </div>
                  <div class="mailbox-read-info">
                    <?php if(strstr($pubEntity[1]->type, 'image')): ?>
                      <img class="img-responsive pad" src="<?php echo e(url('/pubs/display/photo/'.$pubEntity[2]->id.'/'.$pubEntity[2]->name.'/'.$pubEntity[1]->filename)); ?>" alt="Photo">
                    <?php elseif(strstr($pubEntity[1]->type, 'video')): ?>
                      <video style="object-fit: fill; max-width: 100%; min-height: 320px; max-height: 100%" controls>
                        <source src="<?php echo e(url('/pubs/display/video/'.$pubEntity[2]->id.'/'.$pubEntity[2]->name.'/'.$pubEntity[1]->filename )); ?>" >
                        Your browser does not support the video tag.
                      </video>
                    <?php endif; ?>
                  </div>
                  <div class="mailbox-read-info">
                    <button type="button" class="btn btn-info btn-xs" data-toggle = "popover"><i class="fa fa-share-alt"></i> Share</button> &nbsp;
                    <?php if(session('rater')): ?>
                      <?php if($pubEntity[3]): ?>
                        <span id = 'btn-rate-<?php echo e($pubEntity[0]->id); ?>'>
                          <button type="button" class="rate btn btn-warning btn-xs" title = "Rate this pub" data-pub-id = '<?php echo e($pubEntity[0]->id); ?>'><i class="fa fa-star"></i> Rate</button> &nbsp;
                        </span>
                      <?php else: ?>
                        <span id = 'btn-unrate-<?php echo e($pubEntity[0]->id); ?>'>
                          <button type="button" class="unrate btn btn-warning btn-xs" title = "Unrate this pub" data-pub-id = '<?php echo e($pubEntity[0]->id); ?>'><i class="fa fa-star-o"></i> Unrate</button> &nbsp;
                        </span>
                      <?php endif; ?>
                    <?php else: ?>
                      <button type="button" class="btn btn-xs" title = "Enter Rating Mode inorder to rate this pub" disabled><i class="fa fa-star starry"></i> Rate</button> &nbsp;
                    <?php endif; ?>
                    <button type="button" class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#more" data-userid = "<?php echo e($pubEntity[2]->id); ?>" title = "View more about <?php echo e($pubEntity[2]->name); ?>" ><i class="fa fa-plus"> More</i></button>
                    <span class="pull-right text-muted">
                      <b id = 'ratings-<?php echo e($pubEntity[0]->id); ?>'><?php echo e($pubEntity[0]->ratings == 0 || $pubEntity[0]->ratings == 1 ? $pubEntity[0]->ratings." Rating | " : $pubEntity[0]->ratings." Ratings | "); ?></b>
                      <b>6 Shares</b>
                     </span>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-info alert-dismissible" role="alert"style="font-size: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class = "icon fa fa-exclamation-circle" ></i> 0 pubs found <br />
            No pubs available yet!!!
          </div>
        <?php endif; ?>

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
            <img src="<?php echo e(asset('land1.jpg')); ?>" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="<?php echo e(asset('land2.jpg')); ?>" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="<?php echo e(asset('land1.jpg')); ?>" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
            <br /> <br />
          </li>
          <li class = "item">
            <p>
              <a>brand description details</a>
            </p>
            <img src="<?php echo e(asset('land3.jpg')); ?>" alt="pub" style = "max-width: 100%; height: auto; vertical-align: center; border: 0" />
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMEmwSkmHfq-9OA9Sq4-ecVmHSrfYFSts" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(asset('js/map/map.js')); ?>" ></script>
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
              data : "_token=<?php echo e(csrf_token()); ?>",
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

      $("button[data-toggle=popover]").popover({
          html: true,
          trigger: 'focus',
          placement: 'top',
          content: function(){
              return "<span id='popover'><a href='#' class='btn btn-xs btn-primary'> <i class='fa fa-facebook'></i> </a> <a href='#' class='btn btn-xs btn-info'> <i class='fa fa-twitter' ></i> </a></span>";
          }
      });

      $(".rate").click(function(e) {
          alert();
          var pubId = $(e.target).data('pub-id');
          $.ajax({
              type : 'GET',
              url : '/pubs/rate/' + pubId + "/json",
              data : "_token=<?php echo e(csrf_token()); ?>",
              dataType : "json",
              success : function(ratings) {
                  $("#btn-rate-" + pubId).html("<button type='button' class='unrate btn btn-warning btn-xs' title = 'Unrate this pub' data-pub-id = '" + pubId + "'><i class='fa fa-star-o'></i> Unrate</button> &nbsp;");
                  $("#ratings-" + pubId).html(ratings == 0 || ratings == 1 ? ratings + " Rating | " : ratings + " Ratings | ");
              },
              error : function(error) {
                  console.log("error: ", error.status);
              }
          });
      });

      $(".unrate").click(function(e) {
          alert();
          var pubId = $(e.target).data('pub-id');
          $.ajax({
              type : 'GET',
              url : '/pubs/unrate/' + pubId + "/json",
              data : "_token=<?php echo e(csrf_token()); ?>",
              dataType : "json",
              success : function(ratings) {
                  $("#btn-unrate-" + pubId).html("<button type='button' class='rate btn btn-warning btn-xs' title = 'Rate this pub' data-pub-id = '" + pubId + "'><i class='fa fa-star'></i> Rate</button> &nbsp;");
                  $("#ratings-" + pubId).html(ratings == 0 || ratings == 1 ? ratings + " Rating | " : ratings + " Ratings | ");
              },
              error : function(error) {
                  console.log("error: ", error.status);
              }
          });
      });

      // when more modal is about to be shown
      $("#more").on('show.bs.modal', function(e){
          var userid = $(e.relatedTarget).data('userid');
          $.ajax({
              type : 'GET',
              url : '/user/' + userid + "/json",
              data : "_token=<?php echo e(csrf_token()); ?>",
              dataType : "json",
              success : function(user) {
                  var imgSrc = "<?php echo url('/profile-picture/" + user.id + "/" + user.name + "/" + user.profile_picture + "'); ?>";
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
                          data : "_token=<?php echo e(csrf_token()); ?>",
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
                          data : "_token=<?php echo e(csrf_token()); ?>",
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
            data : "_token=<?php echo e(csrf_token()); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pubs.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>