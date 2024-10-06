<?php
/**
 * Dynamic render for the Reading Time block.
 */

// Ensure we're inside a post context.
if (!is_singular()) {
	return '';
}

// Get the post content.
$post_content = get_post()->post_content;

// Strip tags to only count readable text.
$word_count = str_word_count(wp_strip_all_tags($post_content));

// Average reading speed: 200 words per minute.
$reading_time = ceil($word_count / 200);

// Fallback to '1 minute' if the reading time is less than 1.
if ($reading_time < 1) {
	$reading_time = 1;
}

// Render the block with the calculated reading time.
$reading_time_text = sprintf(__('%d MIN CZYTANIA', 'readingtime'), $reading_time);

?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php echo esc_html($reading_time_text); ?>
</p>