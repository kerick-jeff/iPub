<?php $__env->startSection('title', '| Sent'); ?>

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
    <li class="active">Sent</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- alert user that mail has been successfully deleted -->
<?php if(session('deleted')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-check"></i> <br />
         <?php echo e(session('deleted')); ?>

    </div>
<?php endif; ?>

<!-- alert user that mail has not been deleted -->
<?php if(session('notDeleted')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <i class = "icon fa fa-close"></i> Failed <br />
         <?php echo e(session('notDeleted')); ?>

    </div>
<?php endif; ?>

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
            <li>
              <a href="<?php echo e(url('/mailbox/inbox')); ?>">
                <i class="fa fa-inbox"></i> Inbox
                <span class="label label-info pull-right"><b id = "numInbox"><?php echo e(session('noInbox')); ?></b></span>
              </a>
            </li>
            <li class="active">
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
          <h3 class="box-title">Sent</h3>

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
            <button type="button" class="btn btn-primary btn-sm checkbox-toggle" data-toggle = "tooltip" title = "Mark All" onclick = "activate()"><i class="fa fa-square-o"></i></button>
            <button type="button" id = "deleteBtn" class="btn btn-danger btn-sm" data-toggle = "modal"  title = "Delete" ><i class="fa fa-trash"></i></button>
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                <form>
                  <?php foreach($sent_mails as $sent_mail): ?>
                    <tr>
                      <td><input type="checkbox" class = "checkbox-item" id = "<?php echo e($sent_mail->id); ?>" onclick = "act(this)" ></td>
                      <td class="mailbox-name"><a href="<?php echo e(url('/mailbox/readmail/Sent/'.$sent_mail->id)); ?>"><?php echo e($sent_mail->recipient); ?></a></td>
                      <td class="mailbox-subject"><b>iPub</b> - <?php echo e($sent_mail->subject); ?> </td>
                      <?php if($sent_mail->attachment != ""): ?>
                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                      <?php else: ?>
                        <td></td>
                      <?php endif; ?>
                      <td class="mailbox-date"><?php echo e($sent_mail->created_at->diffForHumans()); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </form>

              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->

          <!-- delete mail modal -->
            <div class="modal fade" id="deletemail" tabindex="-1" role="dialog" aria-labelledby="Mail" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class = "text-danger">&times;</span></button>
                    <h4 class="modal-title" id="deletemailLabel">Delete Mail</h4>
                  </div>
                  <div class="modal-body">
                      <p> Are you sure you want to delete this mail(s)? </p>
                  </div>
                  <div class="modal-footer">
                    <form id="deleteform" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <button type="submit" id = "delete" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <!-- delete mail modal -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
            <div class="pull-right">
              <?php echo e($sent_mails->render()); ?>

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

    $("#delete").click(function(){
        var ids = [];

        $("input:checkbox:checked").each(function () {
            if($(this).attr("id") != null)
                ids.push($(this).attr("id"));
        });

        $("#deleteform").attr("action", "/mailbox/deletemails/Sent/" + JSON.stringify(ids));
    });

    $("#deleteBtn").click(function(){
        $("#deleteBtn").removeAttr("data-target");
        $("input:checkbox.checkbox-item").each(function(){
            if($(this).is(":checked") == true){
                $("#deleteBtn").attr("data-target", "#deletemail");
                return false;
            }
        });
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>