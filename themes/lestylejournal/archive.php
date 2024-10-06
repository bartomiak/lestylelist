<?php get_header(); ?>

<section class="pt-6 pb-12 mt-12 flex flex-col items-center">
  <h1 class="text-4xl font-serif mb-6"><?php the_archive_title(); ?></h1>

  <div class="container max-w-7xl mx-auto flex flex-wrap">
    <?php
    while (have_posts()) {
      the_post(); ?>
      <div class=" w-full sm:w-1/2 lg:w-1/3 md:px-3 my-3">
        <div>
          <a href="<?php the_permalink(); ?>" target="_blank">
            <div class="relative h-0 pb-2/3 pt-70 lg:pt-2/3">
              <img class="absolute inset-0 w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>"
                alt="<?php the_title() ?>">

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
      <?php
    }
    ?>
  </div>
</section>
<div class="flex justify-center my-5 font-serif font-light">
  <?php echo paginate_links() ?>
</div>

<?php get_footer() ?>