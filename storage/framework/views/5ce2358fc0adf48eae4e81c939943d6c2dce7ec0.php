<ul>
  <?php foreach($photos as $photo): ?>
      <li> <img src="<?php echo e(url('photo/'.$photo)); ?>" alt="" /> </li>
  <?php endforeach; ?>
</ul>
