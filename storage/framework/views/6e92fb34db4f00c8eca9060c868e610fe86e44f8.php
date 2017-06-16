<?php $__env->startSection('title', '| Confirm Account'); ?>

<?php $__env->startSection('subject'); ?>
  Confirm your Rater account on iPub
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
  Thank you for creating a Rater account on iPub
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
  <tr>
    <td class="innerpadding borderbottom">
      Please, click on the button below to verify your email and confirm your account. <br/>
      <table>
        <tr>
          <td style="padding: 20px 0 0 0;">
            <table class="buttonwrapper" bgcolor="#3c8dbc" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="button" height="45">
                  <a href="<?php echo e(url('/rating-mode/confirm/'.$email)); ?>">Confirm</a> <!-- needs email parameter -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.emails.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>