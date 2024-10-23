<?php
get_header();

while (have_posts()) {
    the_post();

    // THIS IS STRUCTURE FOR POST WITH vertical-gallery GUTENBERG BLOCK
    if (has_block('create-block/vertical-gallery')) {
        ?>
        <div class="flex flex-col items-center">
            <article class="post-content font-serif text-xl font-light pb-5 text-center max-w-full">
                <?php the_content(); ?>
            </article>
            <?php
            $tag_list = get_the_tag_list('<ul class="tag-list flex"><li class="mx-2 font-light uppercase">', '</li><li class="mx-2 font-light uppercase">', '</li></ul>');
            if ($tag_list) {
                ?>

                <h2 class="md:text-3xl italic md:mb-6">Tags</h2>
                <?php
                echo $tag_list;
            }
            ?>
        </div>
        <div class="my-24">
            <?php get_template_part('what-to-wear'); ?>
        </div>
        <?php
    } else {
        // THIS IS STRUCTURE FOR POST WITHOUT vertical-gallery GUTENBERG BLOCK
        ?>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col items-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl leading-none italic font-light mb-4 xl:my-12">
                    <?php the_title() ?>
                </h1>
                <article class="post-content font-serif text-xl font-light pb-5 text-center max-w-full">
                    <?php the_content(); ?>
                </article>
                <?php
                $tag_list = get_the_tag_list('<ul class="tag-list flex"><li class="mx-2 font-light uppercase">', '</li><li class="mx-2 font-light uppercase">', '</li></ul>');
                if ($tag_list) {
                    ?>

                    <h2 class="md:text-3xl italic md:mb-6">Tags</h2>
                    <?php
                    echo $tag_list;
                }
                ?>
            </div>
        </div>
        <div class="my-24">
            <?php get_template_part('what-to-wear'); ?>
        </div>
        <?php
    }
}
?>

<!-- Prev post -->
<section>
    <div class="container max-w-7xl mx-auto flex flex-wrap">
        <?php
        $homepagePosts = new WP_Query(
            array(
                'posts_per_page' => 3,
            )
        );

        while ($homepagePosts->have_posts()) {
            $homepagePosts->the_post(); ?>
            <div class=" w-full sm:w-1/2 lg:w-1/3 md:px-3 my-3">
                <div>
                    <a href="<?php the_permalink(); ?>">
                        <div class="relative h-0 pb-2/3 pt-70 lg:pt-2/3">
                            <img class="absolute inset-0 w-full h-full object-cover"
                                src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>">

                        </div>
                    </a>
                    <p class="category-thumbnail font-sans text-center mt-6"><?php echo get_the_category_list(',') ?></p>
                    <p class="my-2 font-serif text-center text-3xl"><?php the_title() ?></p>
                    <p class="flex justify-center my-2 font-light text-md uppercase text-center">
                        <a href="<?php the_permalink(); ?>"
                            class="flex justify-center border border-black rounded-full py-2 px-3">CZYTAJ
                            <img src="<?php bloginfo('template_url'); ?>/images/icons/arrow_right_icon.svg" alt="arrow"></a>
                    </p>
                    </p>
                </div>
            </div>
            <!-- End of slide -->
            <?php
        }
        wp_reset_postdata()
            ?>
    </div>
</section>

<!-- End of prev post -->

<?php
get_footer();
?>