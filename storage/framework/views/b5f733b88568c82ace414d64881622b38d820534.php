<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2 style = "color: rgba(51,122,183, 1); font-size: 24px">iPub</h2>

        <div>
            Thank you for creating an account with iPub<br/>
            Please follow the link below to verify your email address or click on the
            <a href="<?php echo e(url('register/verify/'.$email.'/'.$confirmation_code)); ?>"><?php echo e(url('register/verify/'.$email.'/'.$confirmation_code)); ?></a>
        </div>

    </body>
</html>
