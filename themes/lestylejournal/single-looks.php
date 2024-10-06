<div class="lg:hidden">

    <?php
    get_header();
    ?>
</div>

<div class="lg:max-h-screen lg:min-h-screen relative">
    <div class="container looks-container mx-auto">
        <?php
        // Check if the current post exists
        if (have_posts()):
            // Loop through the posts
            while (have_posts()):
                the_post();
                ?>
                <div class="look-item container flex-col lg:flex-row flex items-center">
                    <div class="w-full lg:w-1/2 lg:pb-12">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="look-image">
                                <?php
                                // Get the post thumbnail URL
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 'full' can be replaced with other sizes like 'thumbnail', 'medium', etc.
                                ?>
                                <div class="look-image md:p-12 max-h-[90vh]">
                                    <img class="object-cover w-full" src="<?php echo esc_url($thumbnail_url); ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="look-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 lg:pb-32 lg:max-h-screen lg:overflow-scroll lg:border-l">
                        <div class="mb-12 pt-12">
                            <h3 class="my-4 uppercase text-center">outfit</h3>
                            <h3 class="text-5xl serif text-center"><?php the_title(); ?></h3>
                            <p class="text-center font-light mb-6">Post zawiera linki afiljacyjne</p>
                        </div>
                        <hr>
                        <h3 class="text-center mb-6 uppercase my-12">Shop the pieces</h3>
                        <?php
                        // Get the repeatable group field
                        $looks = get_post_meta(get_the_ID(), 'yourprefix_look_group', true);
                        if (!empty($looks)):
                            // Initialize a counter variable
                            $look_number = 1;
                            foreach ($looks as $look):
                                $title = isset($look['title']) ? esc_html($look['title']) : '';
                                $url = isset($look['url']) ? esc_url($look['url']) : '';
                                $image_id = isset($look['image_id']) ? $look['image_id'] : '';

                                // Get the image URL
                                $image_url = !empty($image_id) ? wp_get_attachment_url($image_id) : '';
                                $row_reverse_class = ($look_number % 2 == 0) ? ' flex-row-reverse' : '';

                                ?>
                                <a href="<?php echo $url; ?>" target="_blank">
                                    <div class="look-detail <?php echo $row_reverse_class; ?> flex mb-4 items-center">
                                        <div class="w-1/2 flex justify-center">
                                            <?php if ($image_url): ?>
                                                <img class="max-h-80" src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex flex-col items-center justify-center px-6 w-1/2">
                                            <h3 class="mb-5">N° <?php echo $look_number; ?></h3>
                                            <h3><?php echo $title; ?></h3>
                                            <?php if ($url): ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                // Increment the counter variable
                                $look_number++;
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
        else:
            ?>
            <p><?php _e('No looks found', 'lestyle'); ?></p>
            <?php
        endif;
        ?>

    </div>
    <div class="py-6 flex justify-center lg:absolute bottom-0 bg-beige w-full"><?php
    // Link to a specific page relative to the home URL
    $page_slug = 'looks'; // Replace with your page slug
    $page_url = home_url('/' . $page_slug);
    ?>
        <div class="flex-1 flex justify-end">
            <?php
            $prev_post = get_previous_post();
            if (!empty($prev_post)): ?>
                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                    <h3 class="flex"><img src="<?php bloginfo('template_url'); ?>/images/icons/arrow_left_icon.svg"
                            alt="arrow">Poprzedna</h3>
                </a>
            <?php endif; ?>
        </div>

        <div class="mx-12 lg:mx-24 flex-2">
            <a href="<?php echo esc_url($page_url); ?>">
                <h2 class="uppercase hidden lg:block">powrót do wszystkich stylizacji</h2>
                <h2 class="uppercase block lg:hidden">powrót </h2>
            </a>
        </div>

        <div class="flex-1 flex justify-start">
            <?php
            $next_post = get_next_post();
            if (!empty($next_post)): ?>
                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                    <h3 class="flex">Następna
                        <img src="<?php bloginfo('template_url'); ?>/images/icons/arrow_right_icon.svg" alt="arrow">
                    </h3>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="lg:hidden">
    <?php get_footer(); ?>
</div>