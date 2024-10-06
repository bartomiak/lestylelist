<?php get_header(); ?>

<section class="pt-6 pb-12 mt-12 flex flex-col items-center">
  <!-- <h1 class="text-4xl font-serif mb-6"><?php the_archive_title(); ?></h1> -->
  <h2 class="uppercase text-5xl mb-12">Stylizacje</h2>
  <div class="container max-w-7xl mx-auto flex flex-wrap ">
    <?php
    while (have_posts()) {
      the_post(); ?>
      <div class="md:w-1/3 md:px-3 my-3">
        <a href="<?php the_permalink(); ?>">
          <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"
            class="w-full object-cover aspect-[4/5] image-<?php echo $post_index; ?>">

          <p class="category-thumbnail"><?php echo get_the_category_list(',') ?></p>

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