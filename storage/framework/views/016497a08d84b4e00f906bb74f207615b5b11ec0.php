
<?php if( count($pubs) === 0 ): ?>
	<div class="alert alert-success alert-dismissible" role="alert" style="width:98%; margin-left:10px">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p style="text-align:centre; margin-left: 15px"><b>You have no photos. Upload a photo to get going.<b></p>
    </div>
<?php else: ?>

	<?php foreach( $pubs as $pub): ?>
		<img src="<?php echo e(url('/photo/'.$pub->pubFiles()->first()->filename)); ?>" alt="The image here">
	<?php endforeach; ?>

	<?php echo e($pubs->links()); ?>


<?php endif; ?>