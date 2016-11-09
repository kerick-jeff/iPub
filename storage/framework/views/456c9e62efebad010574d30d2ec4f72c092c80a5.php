<?php $__env->startSection('extendable_content'); ?>
<div class="container-fluid" style="margin-left: -70px; margin-right: -15px">
    <div class="row">
        <?php if(session('follow')): ?>
          <!-- follow status modal -->
          <div class="modal fade" id = "followModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo e(session('followHeader')); ?></h4>
                  </div>
                  <div class="modal-body">
                    <p> <?php echo e(session('follow')); ?> </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
          </div>
        <?php endif; ?>
    </div>
    <img src="<?php echo e(asset('images/land2.jpg')); ?>" alt="landing_page" style="max-width: 100%;" />
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(window).load(function(){
            $('#followModal').modal('show');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.extendable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>