<?php $__env->startSection('title', '| Inbox'); ?>

<!-- provide author and page description -->

<?php $__env->startSection('css'); ?>
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo e(asset('ipub/plugins/iCheck/flat/blue.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> iPub </a></li>
    <li>Mailbox</li>
    <li class="active">Inbox</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-3">
      <a href="<?php echo e(url('mailbox/compose')); ?>" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
            <li class="active">
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
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Inbox</h3>

          <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-primary btn-sm checkbox-toggle" data-toggle = "tooltip" title = "Mark All"><i class="fa fa-square-o"></i></button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle = "tooltip" title = "Delete"><i class="fa fa-trash"></i></button>
            <div class="pull-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="<?php echo e(url('/mailbox/readmail/Inbox/1')); ?>">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">4 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="<?php echo e(url('/mailbox/readmail/Inbox/2')); ?>">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"></td>
                <td class="mailbox-date">12 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="<?php echo e(url('/mailbox/readmail/Inbox/3')); ?>">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">12 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="<?php echo e(url('/mailbox/readmail/Inbox/4')); ?>">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">14 days ago</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="mailbox-name"><a href="<?php echo e(url('/mailbox/readmail/Inbox/5')); ?>">Alexander Pierce</a></td>
                <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                </td>
                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                <td class="mailbox-date">15 days ago</td>
              </tr>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-primary btn-sm checkbox-toggle" data-toggle = "tooltip" title = "Mark All"><i class="fa fa-square-o"></i></button>
            <button type="button" class="btn btn-danger btn-sm" data-toggle = "tooltip" title = "Delete"><i class="fa fa-trash"></i></button>
            <div class="pull-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
        </div>
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<!-- iCheck -->
<script src="<?php echo e(asset('ipub/plugins/iCheck/icheck.min.js')); ?>"></script>
<!-- Page Script -->
<script>
$(document).ready(function() {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

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
    }, 10000);
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>