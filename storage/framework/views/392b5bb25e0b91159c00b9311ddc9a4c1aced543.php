<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>sendmail</title>
  </head>
  <body>
      <form action="/send" method="post">
          <?php echo e(csrf_field()); ?>

          
          <input type="text" name="title" placeholder="enter title">
          <input type="text" name="content" placeholder="enter message">
          <input type="submit" name="send" value="send">
      </form>
  </body>
</html>
