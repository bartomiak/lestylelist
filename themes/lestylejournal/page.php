<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

<div class="flex flex-col items-center">
    <div class="bg-no-repeat bg-top bg-cover w-full mb-6 mt-12 flex flex-col justify-end">
        <h1 class="text-center mb-6 text-6xl font-serif leading-tight"><?php the_title();?></h1>
    </div>
    <article class="post-content font-serif py-5 px-3 text-center max-w-full md:w-2/3 lg:w-1/2">
        <?php the_content();?>
    </article>
</div>
<?php
    }
    
    get_footer();
?>