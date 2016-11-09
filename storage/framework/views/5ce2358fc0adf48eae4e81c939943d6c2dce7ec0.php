<ul>
  <?php foreach($photos as $photo): ?>
      <li> <img src="<?php echo e(url('photo/'.$photo)); ?>" alt="" width = '370px' height = '370px' /> </li>
  <?php endforeach; ?>
</ul>
