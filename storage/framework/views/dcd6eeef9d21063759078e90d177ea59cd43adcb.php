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
                <?php if(session('editFormMessage')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo e(session('editFormMessage')); ?>

                </div>
            <?php endif; ?>


    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default" id="panel2">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Click me to upload a new photo
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingTwo">
                
              <div class="panel-body">
                  <div class="timeline-item " style="background:none;margin-top:-20px">
                      <div class="col-md-12" style="margin-left:-5px; margin-right:-35px;">&nbsp
                          <form action="<?php echo e(url('/photo/store')); ?>" method="POST" style="width:101%;" enctype="multipart/form-data">
                             <?php echo e(csrf_field()); ?>

                             <?php echo e(method_field('PUT')); ?>

                             <div class="fileUpload btn  btn-file btn-primary" style="width:100%; margin-left:2px">
                                 <span> CLICK HERE TO CHOOSE</span>
                                 <input type="file" class="upload"  id="uploadBtn" name="photo" style="border-radius:3px" required>
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
                             &nbsp;
                         </form>
                     </div>
                 </div>
              </div>
            </div>
        </div>

        <div class="row">
            <?php if(session('successDelete')): ?>
                <div class="alert alert-success alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo e(session('successDelete')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('failDelete')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="width:97.2%; margin-left:15px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo e(session('failDelete')); ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                 See all photos
                </a>
              </h4>
            </div>
            <div>
                 <?php if( count($pubs) === 0 ): ?>
                    <div class="alert alert-success alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p style="text-align:centre; margin-left: 15px"><b>You have no photos. Upload a photo to get going.<b></p>
                    </div>
                 <?php elseif( count($pubs) > 0): ?>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne"><!-- /.collapsible start -->
                <div class="panel-body" style="margin-left:60px"> <!-- panel-body start -->
                <div class="timeline-item">  <!-- timeline-item start -->
                <div class="col-md-12" style="margin-left: -35px">
                    <?php foreach( $pubs as $pub ): ?>
                        <div class="col-md-6" style="height: 600px">
                            <div class="box box-widget">
                                  <div class="box-header with-border">
                                    <div class="user-block" style="margin-left:-40px">
                                      <span class="username"> <?php echo e($pub->title); ?></span>
                                      <span class="description">Shared publicly - <?php echo e(substr("$pub->created_at", 0, -9)); ?></span> 
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
                                  <div class="box-body" id="box" style="height:500px">
                                   <div style="padding-left: 5%; height:400px"> 
                                    <img class="img-responsive pad" src="<?php echo e(url('/photo/' . $pub->pubFiles()->first()->filename )); ?>" alt="Photo"  style=" max-height: 400px" />
                                   </div>
                                   <div style=" height:100px">
                                    <p class="description" style="margin-left:10px"><?php echo e($pub->description); ?> </p>
                                    <button id="editButton" type="button" class="btn btn-primary btn-xs" style="margin-left:10px" data-toggle="modal" data-target="#alertEdit" data-id="<?php echo e($pub->id); ?>" data-title="<?php echo e($pub->title); ?>" data-description="<?php echo e($pub->description); ?>" data-category="<?php echo e($pub->category); ?>" data-subCategory="<?php echo e($pub->sub_category); ?>"><i class="fa fa-pencil-square-o">&nbsp;Edit</i></button>
                                    <button id="deleteButton" type="button" class="btn btn-danger btn-xs" style="margin-left:10px" data-toggle="modal" data-target="#alertDelete" data-id ="<?php echo e($pub->id); ?>"><i class="fa fa-trash-o">&nbsp;Delete</i></button>
                                    <span class="pull-right text-muted"><?php echo e($pub->views); ?> views - <?php echo e($pub->ratings); ?> ratings</span>
                                    </div>
                                  </div>
                            </div>
                        </div> 
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php echo e($pubs->links()); ?>

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
            <!-- <form id="deleteForm" action="<?php echo e(url('photo/'.$pub->id.'/destroy')); ?>" method="POST"> -->
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('DELETE')); ?>

                 <div class="form-group"><input type="hidden" name="id" id = "id"></div>
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-danger"><a href="<?php echo e(url('upload/photo')); ?>" style="color:#fff; ">No</a></button>
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
                             <?php echo e(csrf_field()); ?>

                             <?php echo e(method_field('PATCH')); ?>

                             <div class="form-group"><input type="hidden" name="id" id = "id"></div>
                             <div class="form-group has-feedback  <?php echo e($errors->has('title') ? ' has-error' : ''); ?>" >
                                 <label for="title">Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Title" style="border-radius:3px"   id="title" required>
                                 <?php if($errors->has('title')): ?>
                                     <span class="help-block">
                                         <strong><?php echo e($errors->first('title')); ?></strong>
                                     </span>
                                 <?php endif; ?>
                             </div>
                             <div class="form-group has-feedback  <?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                                 <label for="description">Brief description</label>
                                 <textarea type="text" class="form-control" name="description" rows="3" value="Brief description" placeholder="Brief description" style="border-radius:3px" id="description" required></textarea>
                                 <?php if($errors->has('description')): ?>
                                     <span class="help-block">
                                         <strong><?php echo e($errors->first('description')); ?></strong>
                                     </span>
                                 <?php endif; ?>
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
                             <?php if(Auth::check()): ?>
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                             <?php endif; ?>
                             &nbsp;
                             <div class="form-group has-feedback" style="float:right">
                                <button id="update" type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><a href="<?php echo e(url('upload/photo')); ?>" style="color:#fff; ">Cancel</a></button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">

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

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>