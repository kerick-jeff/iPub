<ul>
  <?php foreach($images as $image): ?>
      <li> <img src="<?php echo e(url('image/'.$image)); ?>" alt="" /> </li>
  <?php endforeach; ?>
</ul>
