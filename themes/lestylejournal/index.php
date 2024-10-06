<?php get_header(); ?>


<section class="pt-6 pb-12 mt-12 flex flex-col items-center">
  <h1 class="text-6xl mb-6 font-serif leading-tight">Blog</h1>

  <div class="container max-w-7xl mx-auto flex flex-wrap">

    <?php
    while (have_posts()) {
      the_post(); ?>
      <div class="md:w-1/4 md:px-3 my-3 pb-3">
        <a href="<?php the_permalink(); ?>">
          <div class=" w-full md:pr-6 bg-no-repeat bg-top-left bg-cover mb-6 flex flex-col justify-end" style="height: 420px; background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
          </div>
          <p class="category"><?php echo get_the_category_list(',') ?></p>
          <p class="my-2 font-serif text-lg"><?php the_title() ?></p>
          <p class="font-light font-serif text-md">
            <?php
            if (has_excerpt()) {
              echo get_the_excerpt();
            } else {
              echo wp_trim_words(get_the_content(), 15);
            }
            ?>
          </p>
          <p class="category mt-3"><?php the_time('F') ?></p>
        </a>
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