<section class="bg-beige lg:pt-16 lg:pb-24 flex flex-col items-center px-4">
    <div class="container max-w-7xl mx-auto flex flex-col px-3 sm:px-0 border-y border-gray-200 py-12">
        <h2 class="text-center text-3xl md:text-4xl lg:text-5xl xl:text-6xl italic leading-tight font-serif mt-3 mb-16">
            WHAT to WEAR</h2>
        <div class="flex items-center">
            <div class="swiper-button-prev-links hidden md:block mr-5">
                <img class="cursor-pointer"
                    src="<?php bloginfo('template_url'); ?>/images/icons/arrow_left_circle_icon.svg" alt="arrow">
            </div>
            <div class="swiper-links-container overflow-hidden">
                <div class="swiper-wrapper">
                    <?php
                    $homepagePosts = new WP_Query(
                        array(
                            'posts_per_page' => 4,
                            'post_type' => 'links',
                            // 'meta_query' => array(
                            //     array(
                            //         'key' => 'lestyle_is_featured',
                            //         'value' => 'on', // This depends on how the value is stored
                            //         'compare' => '='
                            //     )
                            // )
                        )
                    );

                    while ($homepagePosts->have_posts()) {
                        $homepagePosts->the_post();
                        $look_url = get_post_meta(get_the_ID(), 'lestyle_link_url', true);
                        ?>
                        <div class="swiper-slide w-full sm:w-1/2 lg:w-1/3 md:px-3 my-3">

                            <div>
                                <a href="<?php echo esc_url($look_url); ?>" target="_blank">
                                    <div class="relative h-0 pb-2/3 pt-70 lg:pt-2/3">
                                        <img class="absolute inset-0 w-full h-full object-cover"
                                            src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>">
                                        <div class="absolute top-3 bg-opacity-20 left-4 bg-black rounded-full p-2">
                                            <img src="<?php bloginfo('template_url'); ?>/images/icons/link_icon.svg"
                                                alt="arrow" class="w-5">
                                        </div>
                                    </div>
                                </a>
                                <p class="flex justify-center my-2 font-sans font-light text-md uppercase text-center pt-8">
                                    <a href="<?php echo esc_url($look_url); ?>" target="_blank"
                                        class="flex justify-center  border border-black rounded-full py-2 px-3"><?php the_title() ?>
                                        <img src="<?php bloginfo('template_url'); ?>/images/icons/arrow_right_icon.svg"
                                            alt="arrow"></a>
                                </p>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata()
                        ?>
                </div>
            </div>

            <div class="swiper-button-next-links hidden md:block ml-5"><img class="cursor-pointer"
                    src="<?php bloginfo('template_url'); ?>/images/icons/arrow_right_circle_icon.svg" alt="arrow"></div>
        </div>
    </div>
</section>