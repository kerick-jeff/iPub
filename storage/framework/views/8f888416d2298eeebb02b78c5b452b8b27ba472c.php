<?php $__env->startSection('title', '| Compose'); ?>

<!-- provide author and page description -->

<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('js/loading/waitMe.css')); ?>" media="screen" title="no title">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> iPub</a></li>
  <li>Mailbox</li>
  <li class="active">Compose</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('saved')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> Saved <br />
         <?php echo e(session('saved')); ?>

    </div>
<?php endif; ?>

<?php if(session('sent')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> Sent <br />
         <?php echo e(session('sent')); ?>

    </div>
<?php endif; ?>

<?php if(session('notSent')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> Not Sent <br />
         <?php echo e(session('notSent')); ?>

    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-3">
      <a href="<?php echo e(url('/mailbox/inbox')); ?>" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Folders</h3>
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li>
                <a href="<?php echo e(url('/mailbox/inbox')); ?>">
                  <i class="fa fa-inbox"></i> Inbox
                  <span class="label label-info pull-right"><b id = "numInbox"><?php echo e(session('noInbox')); ?></b></span>
                </a>
              </li>
              <li>
                <a href="<?php echo e(url('/mailbox/sent')); ?>">
                  <i class="fa fa-send"></i> Sent
                  <span class="label pull-right bg-green"><b id = "numSent"><?php echo e(session('noSent')); ?></b></span>
                </a>
              </li>
              <li>
                <a href="<?php echo e(url('/mailbox/drafts')); ?>">
                  <i class="fa fa-file-text"></i> Drafts
                  <span class="label label-warning pull-right"><b id = "numDrafts"><?php echo e(session('noDrafts')); ?></b></span>
                </a>
              </li>
            </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
    <form action="/mailbox/compose" enctype="multipart/form-data" method="POST">
      <?php echo e(csrf_field()); ?>


      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Compose New Message</h3>
          </div>
          <!-- /.box-header -->

          <input type="hidden" name="user_id" value = "<?php echo e(Auth::user()->id); ?>">
          <input type="hidden" name="sender" value = "<?php echo e(Auth::user()->email); ?>">
          <input type="hidden" name="is_sent" value="0">
          <input type="hidden" name="is_draft" value="0">

          <div class="box-body">
            <div class="form-group">
              <input type = "email" name = "recipient" class="form-control" placeholder="To:">
              <?php if($errors->has('recipient')): ?>
                  <span class="help-block" style = "color: #DD4B39 !important;">
                      <strong><?php echo e($errors->first('recipient')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <input type = "text" name = "subject" class="form-control" placeholder="Subject:">
              <?php if($errors->has('subject')): ?>
                  <span class="help-block" style = "color: #DD4B39 !important;">
                      <strong><?php echo e($errors->first('subject')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <textarea name = "body" id="compose-textarea" class="form-control" style="height: 100px"> </textarea>
              <?php if($errors->has('body')): ?>
                  <span class="help-block" style = "color: #DD4B39 !important;">
                      <strong><?php echo e($errors->first('body')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <i class="fa fa-paperclip"></i> Attachment
              <input class="btn btn-info btn-file" type="file" name="attachment" style = "max-width: 500px">
              <p class="help-block">Max. 32MB</p>
              <?php if($errors->has('attachment')): ?>
                  <span class="help-block" style = "color: #DD4B39 !important;">
                      <strong><?php echo e($errors->first('attachment')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right">
              <button type="submit" name = "save" id = "save" class="btn btn-warning"><i class="fa fa-save"></i> Save as draft</button>
              <button type="submit" name = "send" id = "send" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
            </div>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Discard</button>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
  </form>
</div>
<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src = "<?php echo e(asset('js/loading/waitMe.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // check number of inbox, sent and drafts mailItems after every 10s
        setInterval(function(){
          $.ajax({
              type: 'POST',
              url: '/mailbox/check',
              data: '_token=<?php echo e(csrf_token()); ?>',
              success: function(data){
                  $("#numInbox").html(data.numInbox);
                  $("#numSent").html(data.numSent);
                  $("#numDrafts").html(data.numDrafts);
              }
          });
        }, 10<?php echo e(session('')); ?>000);

        $("#save").click(function(){
            $("#body").waitMe({
                effect: 'roundBounce',
                text: 'Saving as draft',
                bg: 'rgba(255,255,255,0.7)',
                color: '#3c8dbc',
                sizeW: '',
                sizeH: '',
                source: '',
                onClose: function(){}
            });
        });

        $("#send").click(function(){
            $("#body").waitMe({
                effect: 'roundBounce',
                text: 'Sending...',
                bg: 'rgba(255,255,255,0.7)',
                color: '#3c8dbc',
                sizeW: '',
                sizeH: '',
                source: '',
                onClose: function(){}
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>