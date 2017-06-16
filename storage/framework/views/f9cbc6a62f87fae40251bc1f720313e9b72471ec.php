<?php $__env->startSection('title', '| Mail'); ?>

<?php $__env->startSection('subject'); ?>
  Mail from an iPub account user
<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
  The subject goes here
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
  <tr>
    <td class="innerpadding borderbottom">
      <table width="115" align="left" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="115" style="padding: 0 20px 20px 0;">
            <img src="<?php echo e(url('/profile-picture')); ?>" width="115" height="115" border="0" alt="<?php echo e(Auth::user()->name); ?>" />
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
        <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
      <![endif]-->
      <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="bodycopy">
                  The body goes here The body goes here The body goes here The body goes hereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes HereThe body goes hereThe body goes HereThe body goes here
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
      </table>
      <![endif]-->
    </td>
  </tr>
  <!--<tr>
    <td class="innerpadding borderbottom">
      <img src="ipub/dist/img/ipub.png" width="100%" border="0" alt="" />
    </td>
  </tr>-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.emails.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>