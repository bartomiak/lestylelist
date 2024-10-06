<?php get_header(); ?>
<section class="min-h-screen mx-auto px-0 py-0">
    <div class="swiper-container overflow-hidden">
        <div class="swiper-wrapper">
            <?php
            $homepagePosts = new WP_Query(
                array(
                    'posts_per_page' => 3,
                )
            );

            while ($homepagePosts->have_posts()) {
                $homepagePosts->the_post(); ?>
                <!-- Slide -->
                <div class="swiper-slide">
                    <div class="w-full flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-8 md:mb-0 max-h-screen">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>"
                                class="h-screen max-h-[60vh] md:max-h-[100vh] object-cover min-w-full"
                                alt="<?php the_title() ?>">
                        </div>
                        <div class="flex md:w-1/2 text-center md:text-center items-center justify-center px-3 md:px-24">
                            <div class="max-w-2xl">
                                <h3 class="text-xs font-sans font-light uppercase mb-4 md:mb-10">
                                    <?php echo get_the_category_list('-') ?>
                                </h3>
                                <h1
                                    class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl leading-none italic font-light mb-4">
                                    <?php the_title() ?>
                                </h1>
                                <p class="font-light mb-6 text-wrap "><?php
                                if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo wp_trim_words(get_the_content(), 30);
                                }
                                ?></p>
                                <div class="flex justify-center">
                                    <p class="uppercase font-light mb-8"><?php echo read_time(); ?><span
                                            class="mx-1">·</span></p>

                                    <p class="uppercase font-light mb-8"><?php echo display_time_ago(get_the_ID()); ?></p>
                                </div>
                                <a href="<?php the_permalink(); ?>"
                                    class="mb-4 font-light inline-block px-6 py-2 border border-black text-black text-sm md:text-base leading-tight uppercase rounded-full hover:bg-black hover:text-white transition duration-150 ease-in-out">Czytaj
                                    więcej</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of slide -->
                <?php
            }
            wp_reset_postdata()
                ?>
        </div>
    </div>
</section>

<?php get_template_part('what-to-wear'); ?>

<section>
    <style>
        @media screen and (min-width: 768px) {}


        @media screen and (min-width: 768px) {
            .custom-grid {
                display: grid;
                grid-template-columns: minmax(100px, 2fr) 1fr 2fr 2fr 4fr;
                grid-template-rows: 6fr 1fr 4fr 3fr 1fr 8fr;
                grid-gap: 20px;
            }

            /* it looks better if you comment it out */
            .image-container-0,
            .image-container-2 {
                display: grid;
                grid-template-columns: 5fr 2fr;
            }

            /* .image-0 {
            grid-column: 1 / span 1;
        } */

            .box-0 {
                grid-column: 1 / span 2;
            }

            .box-1 {
                grid-column: 5 / span 1;
                grid-row: 1 / span 6;
            }

            .box-2 {
                grid-column: 2 / span 2;
                grid-row: 3 / span 2;
            }

            .box-3 {
                grid-column: 3 / span 2;
                grid-row: 5 / span 2;
            }

            .box-4 {
                grid-column: 5 / span 1;
                grid-row: 5 / span 2;
            }
        }
    </style>

    <div class="container max-w-8xl mx-auto flex justify-center xl:mt-12">
        <div class="flex justify-center mt-12">
            <div class=" p-6">
                <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl italic text-center lg:my-12">LE STYLE JOURNAL
                </h1>
                <div class="custom-grid pt-12">
                    <?php
                    $homepagePosts = new WP_Query(
                        array(
                            'posts_per_page' => 5,
                            'post_type' => 'post',
                        )
                    );

                    $post_index = 0;
                    ?>
                    <?php while ($homepagePosts->have_posts()):
                        $homepagePosts->the_post();
                        ; ?>
                        <div class="mb-6 md:mb-0  box-<?php echo $post_index; ?>">
                            <div class="image-container-<?php echo $post_index; ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"
                                        class="w-full object-cover aspect-[4/5] image-<?php echo $post_index; ?>">
                                <?php endif; ?>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <h2 class="text-lg font-light uppercase font-sans my-5"><?php the_title(); ?></h2>
                                <p class="font-light"><?php echo wp_trim_words(get_the_excerpt(), 40, '...'); ?></p>
                                <p class="font-light mt-2 uppercase"><?php echo display_time_ago(get_the_ID()); ?>
                                    <span class="mx-1">·</span>
                                    <?php echo read_time(); ?>
                                </p>
                            </a>
                        </div>
                        <?php $post_index++; ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TODO: move it -->
<style>
    @media screen and (min-width: 768px) {
        .swiper-look-container .swiper-slide:nth-child(odd) img {
            padding-top: 60px;
        }
    }

    .swiper-slide:nth-child(even) a {}
</style>

<section class="mt-12 pt-12 bg-beige">
    <h2 class="text-center text-3xl md:text-4xl lg:text-5xl xl:text-6xl italic xl:mb-24 xl:pb-12 xl:mt-24">SHOP my FEED
    </h2>
    <div class="swiper-look-container overflow-hidden mt-12">
        <div class="swiper-wrapper flex items-end">
            <?php
            $homepagePosts = new WP_Query(
                array(
                    'posts_per_page' => 10,
                    'post_type' => 'looks',
                )
            );
            while ($homepagePosts->have_posts()) {
                $homepagePosts->the_post(); ?>
                <div class="swiper-slide h-auto ">
                    <a href="<?php the_permalink(); ?>" target="_blank" class="flex ">

                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>"
                            class="object-cover w-full aspect-[4/5]">

                    </a>
                </div>
                <?php
            }
            wp_reset_postdata()
                ?>
        </div>
</section>

<?php get_footer(); ?>