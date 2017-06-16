<?php $__env->startSection('title', '| Confirm Account'); ?>

<?php $__env->startSection('subject'); ?>
  Confirm your account on iPub
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
  Thank you for joining iPub
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
                  <a href="<?php echo e(url('/register/verify/'.$email.'/'.$confirmation_code)); ?>">Confirm</a> <!-- needs email and confirmation_code parameter -->
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