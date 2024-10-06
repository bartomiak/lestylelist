<?php
/**
 * Dynamic render for the Vertical Scroll Gallery block.
 */

// Retrieve block attributes.
$attributes = isset($attributes) ? $attributes : array();
$images = isset($attributes['images']) ? $attributes['images'] : array();

?>
<div <?php echo get_block_wrapper_attributes(); ?>class="vertical-scroll-gallery"
	style="height: 100vh; overflow-y: auto;">
	<?php foreach ($images as $image): ?>
		<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="gallery-image"
			style="width: 100%; margin-bottom: 10px;" />
	<?php endforeach; ?>
</div>