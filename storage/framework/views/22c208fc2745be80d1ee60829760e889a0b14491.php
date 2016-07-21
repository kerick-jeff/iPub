<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="callout callout-warning">
        <h4><i class="fa fa-exclamation-triangle"> </i> Note</h4>
        <p>Your pictures should be of medium size.  Click 'SEE ALL PHOTOS' to see older photos</p>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Click me to upload a new photo
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                  <div class="timeline-item " style="background:none; ">
                      <div class="fileUpload btn  btn-file btn-primary" style="width:98%;">
                          <span> CLICK HERE TO CHOOSE</span>
                          <input type="file" class="upload"  id="uploadBtn" name="photo" style="border-radius:3px">
                      </div>
                      <span style="margin-left:9px;">
                          <input id="uploadFile" placeholder="Choose File" disabled="disabled" style="width:98%;margin-left:2px; border-radius:3px"/>
                      </span>
                      <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp
                          <form action="<?php echo e(url('/photo/store')); ?>" method="POST" style="width:101%;">
                             <?php echo e(csrf_field()); ?>

                             <div class="form-group has-feedback" >
                                 <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" value="Title" placeholder="Title" style="border-radius:3px" >
                             </div>
                             <div class="form-group has-feedback">
                                 <label for="description">Brief description</label>
                                    <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px"></textarea>
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
                                 <label for="subcategory">Sub-category</label>
                                 <select class="form-control" name="subcategory" style="border-radius:3px">
                                   <option value="electronics">Electronics</option>
                                   <option value="fashion">Fashion</option>
                                   <option value="sports">Sports</option>
                                   <option value="health">Health</option>
                                   <option value="ngo">NGO</option>
                                 </select>
                             </div>
                             <?php if(Auth::check()): ?>
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                             <?php endif; ?>
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
                  See all photos
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"><!-- /.collapsible start -->
                <div class="panel-body" style="margin-left:60px"> <!-- panel-body start -->
                        <div class="timeline-item">  <!-- timeline-item start -->
                            <!---- CREATE ROWS FOR PHOTOS> EACH ROW HAS TW PHOTOS --->
                            <div class="row" style="margin-left:-7.5%"><!-- row start -->
                              <div class="col-md-6"><!-- COL _1 start -->
                                <div class="box box-widget">
                                  <div class="box-header with-border">
                                    <div class="user-block" style="margin-left:-40px">
                                      <span class="username">The title </span>
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
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                    <img class="img-responsive pad" src="<?php echo e(asset('ipub/dist/img/photo2.png')); ?>" alt="Photo">

                                    <p style="margin-left:10px">I took this photo this morning. What do you guys think?</p>
                                    <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="<?php echo e(asset('/photo/edit')); ?>" style="color:#fff">Edit</a></button>
                                    <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="<?php echo e(asset('/photo/delete')); ?>" style="color:#fff">Delete</a></button>
                                    <span class="pull-right text-muted">127 views - 80 ratings</span>
                                  </div>
                                </div>
                            </div> <!-- COL _1 end-->
                            <div class="col-md-6"><!-- COL _1 start -->
                              <div class="box box-widget">
                                <div class="box-header with-border">
                                  <div class="user-block" style="margin-left:-40px">
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
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <img class="img-responsive pad" src="<?php echo e(asset('ipub/dist/img/photo1.png')); ?>" alt="Photo">

                                  <p style="margin-left:10px">I took this photo this morning. What do you guys think?</p>
                                  <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="<?php echo e(asset('/photo/edit')); ?>" style="color:#fff">Edit</a></button>
                                  <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="<?php echo e(asset('/photo/delete')); ?>" style="color:#fff">Delete</a></button>
                                  <span class="pull-right text-muted">127 views - 80 ratings</span>
                                </div>
                              </div>
                          </div> <!-- COL _1 end-->
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>