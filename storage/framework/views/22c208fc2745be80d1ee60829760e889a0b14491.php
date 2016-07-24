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

    @media(max-width: 767px) {
        #collapseOne {
            padding-right: 35px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<ol class="breadcrumb" style="margin-top:-15px">
    <li><a href="/"><i class="fa fa-dashboard">iPub</i></a></li>
    <li>Upload</li>
    <li>Photo</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content" style="margin-top:-35px">
    <div class="callout callout-info">
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
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('typeError')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <?php echo e(session('typeError')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('widthError')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <?php echo e(session('widthError')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('sizeError')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <?php echo e(session('sizeError')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('fileError')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <?php echo e(session('fileError')); ?>

                    </div>
                <?php endif; ?>
              <div class="panel-body">
                  <div class="timeline-item " style="background:none;margin-top:-20px">
                      <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp
                          <form action="<?php echo e(url('/photo/store')); ?>" method="POST" style="width:101%;" enctype="multipart/form-data">
                             <?php echo e(csrf_field()); ?>

                             <div class="fileUpload btn  btn-file btn-primary" style="width:100%; margin-left:2px">
                                 <span> CLICK HERE TO CHOOSE</span>
                                 <input type="file" class="upload"  id="uploadBtn" name="photo" style="border-radius:3px">
                             </div>
                             <span style="margin-left:2px;">
                                 <input id="uploadFile" placeholder="Choose File" name="photo" disabled="disabled" style="width:100%; border-radius:3px"/>
                             </span>
                             <div class="form-group has-feedback  <?php echo e($errors->has('title') ? ' has-error' : ''); ?>" >
                                 <label for="title">Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Title" style="border-radius:3px" >
                                 <?php if($errors->has('title')): ?>
                                     <span class="help-block">
                                         <strong><?php echo e($errors->first('title')); ?></strong>
                                     </span>
                                 <?php endif; ?>
                             </div>
                             <div class="form-group has-feedback  <?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                                 <label for="description">Brief description</label>
                                 <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px"></textarea>
                                 <?php if($errors->has('description')): ?>
                                     <span class="help-block">
                                         <strong><?php echo e($errors->first('description')); ?></strong>
                                     </span>
                                 <?php endif; ?>
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
        <div class="panel panel-default" id="panel2">
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
                            <!---- CREATE ROWS FOR PHOTOS> EACH ROW HAS TWO PHOTOS --->
                            <?php for($i = 0; $i < 3; $i++): ?>
                            <div class="row" style="margin-left:-7.5%"><!-- row start -->
                                <?php for($j = 0; $j < 2; $j++): ?>
                              <div class="col-md-6"><!-- COL _1 start -->
                                <div class="box box-widget">
                                  <div class="box-header with-border">
                                    <div class="user-block" style="margin-left:-40px">
                                      <span class="username"><?php echo e($photos[$i+$j]->title); ?></span>
                                      <span class="description">Shared publicly - <?php echo e($photos[$i+$j]->created_at); ?></span>
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
                                    <img class="img-responsive pad" src="<?php echo e(storage_path()); ?>/app/public/<?php echo e($user_id); ?>-<?php echo e($user_name); ?>/photo/<?php echo e($photos[$i+$j]->filename); ?>" alt="Photo">
                                    <?php echo e(storage_path()); ?>/app/public/<?php echo e($user_id); ?>-<?php echo e($user_name); ?>/photo/<?php echo e($photos[$i+$j]->filename); ?>

                                    <p style="margin-left:10px"><?php echo e($photos[$i+$j]->description); ?></p>
                                    <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="<?php echo e(url('/photo/edit/'.$photos[$i+$j]->id)); ?>" style="color:#fff">Edit</a></button>
                                    <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="<?php echo e(url('/photo/delete'.$photos[$i+$j]->id)); ?>" style="color:#fff">Delete</a></button>
                                    <span class="pull-right text-muted"><?php echo e($photos[$i+$j]->views); ?> views - <?php echo e($photos[$i+$j]->ratings); ?> ratings</span>
                                  </div>
                                </div>
                              </div> <!-- COL _1 end-->
                              <?php endfor; ?>
                            </div> <!-- row end -->
                            <?php endfor; ?>
                            <?php echo e($photos->links()); ?>

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