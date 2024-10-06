<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()): ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'callback' => 'custom_comment_callback',

                )
            );
            ?>
        </ol>

        <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && get_comments_number()):
            ?>
            <p class="no-comments"><?php _e('Comments are closed.', 'textdomain'); ?></p>
            <?php
        endif;
        ?>

    <?php endif; // Check for have_comments() ?>

</div><!-- #comments -->