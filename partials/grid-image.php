<?php 

$image = get_sub_field('image');
$image_size = get_sub_field('image_size');

if( !empty($image) ): 

	if($image_size == 'full'): ?>

	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

	<?php else: ?>

	<img src="<?php echo $image['sizes'][$image_size]; ?>" alt="<?php echo $image['alt']; ?>" />

<?php endif; 
endif; ?>