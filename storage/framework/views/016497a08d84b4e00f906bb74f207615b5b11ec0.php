 <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"><!-- /.collapsible start -->
                <div class="panel-body" style="margin-left:60px"> <!-- panel-body start -->
                        <div class="timeline-item">  <!-- timeline-item start -->
                            <!-- CREATE ROWS FOR PHOTOS> EACH ROW HAS TWO PHOTOS -->
                            <?php for($i = 0; $i < 2; $i++): ?>
                                <?php if( $i % 2 == 0 ): ?>
                            <div class="row" style="margin-left:-7.5%"><!-- row start -->
                              <div class="col-md-6"><!-- COL _1 start -->
                                <div class="box box-widget">
                                  <div class="box-header with-border">
                                    <div class="user-block" style="margin-left:-40px">
                                      <span class="username"> <?php echo e($pubs[$i]->title); ?></span>
                                      <span class="description">Shared publicly - date here</span> 
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
                                    <img class="img-responsive pad" src=" <?php echo e(url('/photo/' . $pub_files[$i]->filename)); ?>" alt="Photo"> 
                                    <p style="margin-left:10px"><?php echo e($pubs[$i]->description); ?> </p>
                                    <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="<?php echo e(url('photo/'.$pubs[$i]->id.'/edit')); ?>" style="color:#fff">Edit</a></button>
                                    <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="<?php echo e(url('photo/'.$pubs[$i]->id.'/destroy')); ?>" style="color:#fff">Delete</a></button>
                                    <span class="pull-right text-muted"><?php echo e($pubs[$i]->views); ?> views - <?php echo e($pubs[$i]->ratings); ?> ratings</span>
                                  </div>
                                </div>
                                <?php if(session('successDelete')): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo e(session('successDelete')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('failDelete')): ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo e(session('failDelete')); ?>

                                    </div>
                                <?php endif; ?>
                              </div> <!-- COL _1 end-->
                              </div> <!-- row end -->
                              <?php else: ?>
                                <div class="col-md-6"><!-- COL _1 start -->
                                <div class="box box-widget">
                                  <div class="box-header with-border">
                                    <div class="user-block" style="margin-left:-40px">
                                      <span class="username"> <?php echo e($pubs[$i]->title); ?></span>
                                      <span class="description">Shared publicly - date here</span> 
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
                                    <img class="img-responsive pad" src=" <?php echo e(url('/photo/' . $pub_files[$i]->filename)); ?>" alt="Photo"> 
                                    <p style="margin-left:10px"><?php echo e($pubs[$i]->description); ?> </p>
                                    <button type="button" class="btn btn-primary btn-xs" style="margin-left:10px"><i class="fa fa-pencil-square-o"></i><a href="<?php echo e(url('photo/'.$pubs[$i]->id.'/edit')); ?>" style="color:#fff">Edit</a></button>
                                    <button type="button" class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-trash-o"></i><a href="<?php echo e(url('photo/'.$pubs[$i]->id.'/destroy')); ?>" style="color:#fff">Delete</a></button>
                                    <span class="pull-right text-muted"><?php echo e($pubs[$i]->views); ?> views - <?php echo e($pubs[$i]->ratings); ?> ratings</span>
                                  </div>
                                </div>
                                <?php if(session('successDelete')): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo e(session('successDelete')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('failDelete')): ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert" style="width:98%; margin-left:10px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo e(session('failDelete')); ?>

                                    </div>
                                <?php endif; ?>
                              </div> <!-- COL _1 end-->
                              <?php endif; ?>
                            <?php endfor; ?>
                        </div><!-- timeline-item end -->
                    </div><!-- panel-body start -->
                </div><!-- /.collapsible end -->
                
                <?php echo e($pubs->links()); ?>