<?php $__env->startSection('title', '| Read Mail'); ?>

<!-- provide author and page description -->

<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('js/loading/waitMe.css')); ?>" media="screen" title="no title">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>Mailbox</li>
    <li><a href="/mailbox/<?php echo e($category); ?>"><?php echo e($category); ?></a></li>
    <li class="active">Read Mail</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('sent')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> Success <br />
         <?php echo e(session('sent')); ?>

    </div>
<?php endif; ?>

<?php if(session('forwarded')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> Success <br />
         <?php echo e(session('forwarded')); ?>

    </div>
<?php endif; ?>

<?php if(session('notForwarded')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> Failed <br />
         <?php echo e(session('notForwarded')); ?>

    </div>
<?php endif; ?>

<div class="row">
  <div class="col-md-3">
          <a href="<?php echo e(url('/mailbox/compose')); ?>" class="btn btn-primary btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <?php if($category == "Inbox"): ?>
                  <li class="active">
                    <a href="<?php echo e(url('/mailbox/inbox')); ?>">
                      <i class="fa fa-inbox"></i> Inbox
                      <span class="label label-info pull-right">16</span>
                    </a>
                  </li>
                <?php else: ?>
                  <li>
                    <a href="<?php echo e(url('/mailbox/inbox')); ?>">
                      <i class="fa fa-inbox"></i> Inbox
                      <span class="label label-info pull-right">16</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if($category == "Sent"): ?>
                  <li class = "active">
                    <a href="<?php echo e(url('/mailbox/sent')); ?>">
                      <i class="fa fa-send"></i> Sent
                      <span class="label pull-right bg-green">4</span>
                    </a>
                  </li>
                <?php else: ?>
                  <li>
                    <a href="<?php echo e(url('/mailbox/sent')); ?>">
                      <i class="fa fa-send"></i> Sent
                      <span class="label pull-right bg-green">4</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if($category == "Drafts"): ?>
                  <li class = "active">
                    <a href="<?php echo e(url('/mailbox/drafts')); ?>">
                      <i class="fa fa-file-text"></i> Drafts
                      <span class="label label-warning pull-right">5</span>
                    </a>
                  </li>
                <?php else: ?>
                  <li>
                    <a href="<?php echo e(url('/mailbox/drafts')); ?>">
                      <i class="fa fa-file-text"></i> Drafts
                      <span class="label label-warning pull-right">5</span>
                    </a>
                  </li>
                <?php endif; ?>

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="/mailbox/readmail/Drafts/" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="/mailbox/readmail/Drafts/" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                Subject: <?php echo e($readmail->subject); ?> <span class="mailbox-read-time pull-right"><?php echo e($readmail->created_at); ?></span></h5>
              </div>
              <div class="mailbox-read-info">
                <?php if($category == "Inbox"): ?>
                  <h5>From: <?php echo e($readmail->sender); ?>

                <?php else: ?>
                  <h5>To: <?php echo e($readmail->recipient); ?>

                <?php endif; ?>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message">
                Body:
                <p>
                  <?php echo e($readmail->body); ?>

                </p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <?php if($readmail->attachment != ""): ?>
              <div class="box-footer">
                Attachment:
                <ul class="mailbox-attachments clearfix">
                  <li>
                    <div class="mailbox-attachment-info">
                      <a href="#" class="mailbox-attachment-name"><i class="fa fa-file"></i> <?php echo e($readmail->attachment); ?></a>
                          <span class="mailbox-attachment-size">
                            1.9 MB
                            <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                          </span>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.box-footer -->
            <?php endif; ?>
            <div class="box-footer">
              <div class="pull-right">
                <?php if($category == "Drafts"): ?>
                  <form action="/mailbox/send/sendSaved/<?php echo e($category); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>


                    <input type="hidden" name="id" value="<?php echo e($readmail->id); ?>">
                    <input type="hidden" name="sender" value="<?php echo e($readmail->sender); ?>">
                    <input type="hidden" name="recipient" value="<?php echo e($readmail->recipient); ?>">
                    <input type="hidden" name="subject" value="<?php echo e($readmail->subject); ?>">
                    <input type="hidden" name="body" value="<?php echo e($readmail->body); ?>">
                    <input type="hidden" name="attachment" value="<?php echo e($readmail->attachment); ?>">

                    <button type="submit" name="send" class = "btn btn-primary"><i class = "fa fa-send"></i> Send</button>
                  </form>
                <?php elseif($category == "Sent"): ?>
                  <button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#forwardmail"><i class="fa fa-mail-forward"></i> Forward</button>
                <?php else: ?>
                  <button type="button" class="btn btn-primary"><i class="fa fa-reply"></i> Reply</button>
                <?php endif; ?>
              </div>

              <button type="button" class="btn btn-danger" data-toggle = "modal" data-target = "#deletemail"><i class="fa fa-trash-o"></i> Delete</button>

            </div>
            <!-- /.box-footer -->

            <!-- delete mail modal -->
              <div class="modal fade" id="deletemail" tabindex="-1" role="dialog" aria-labelledby="Mail" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="deleteMailLabel">Delete Mail</h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this mail? </p>
                    </div>
                    <div class="modal-footer">
                      <form id="deleteform" action = "/mailbox/delete/<?php echo e($category); ?>/<?php echo e($readmail->id); ?>" method="POST">
                          <?php echo e(csrf_field()); ?>

                          <?php echo e(method_field('DELETE')); ?>

                          <button type="submit" class="btn btn-primary">Yes</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <!-- delete mail modal -->

            <!-- forward mail modal -->
              <div class="modal fade" id="forwardmail" tabindex="-1" role="dialog" aria-labelledby="Mail" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                      <h4 class="modal-title" id="deleteMailLabel">Forward Mail</h4>
                    </div>
                    <form id="forwardform" action = "/mailbox/forward/<?php echo e($category); ?>/<?php echo e($readmail->id); ?>" method="POST">
                      <?php echo e(csrf_field()); ?>


                      <input type="hidden" name="id" value="<?php echo e($readmail->id); ?>">
                      <input type="hidden" name="sender" value="<?php echo e($readmail->sender); ?>">
                      <input type="hidden" name="recipient" value="<?php echo e($readmail->recipient); ?>">
                      <input type="hidden" name="subject" value="<?php echo e($readmail->subject); ?>">
                      <input type="hidden" name="body" value="<?php echo e($readmail->body); ?>">
                      <input type="hidden" name="attachment" value="<?php echo e($readmail->attachment); ?>">

                      <div class="modal-body">
                        <div class="form-group">
                          <input type = "email" name = "recipient" class="form-control" placeholder="To:">
                          <?php if($errors->has('recipient')): ?>
                              <span class="help-block" style = "color: #DD4B39 !important;">
                                  <strong><?php echo e($errors->first('recipient')); ?></strong>
                              </span>
                          <?php endif; ?>
                        </div>
                        <div class="form-group">
                          <input type = "text" name = "subject" class="form-control" value = "<?php echo e($readmail->subject); ?>" readonly />
                        </div>
                        <div class="form-group">
                          <textarea name = "body" id="compose-textarea" class="form-control" style="height: 100px" readonly > <?php echo e($readmail->body); ?> </textarea>
                        </div>
                        <?php if($readmail->attachment != ""): ?>
                          <ul class="mailbox-attachments clearfix">
                            <li>
                              <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name"><i class="fa fa-file"></i> <?php echo e($readmail->attachment); ?></a>
                                    <span class="mailbox-attachment-size">
                                      1.9 MB
                                      <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                    </span>
                              </div>
                            </li>
                          </ul>
                        <?php endif; ?>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class = "fa fa-send"></i> Send</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- forward mail modal -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src = "<?php echo e(asset('js/loading/waitMe.js')); ?>"></script>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>