<section class="bg-black text-white pt-12 px-6 xl:px-0">

    <footer class="container max-w-7xl mx-auto flex flex-col px-3 sm:px-0">
        <!-- <div class="flex justify-between my-12">
            <div class="flex flex-col sm:w-3/5 lg:w-1/2">
                <h2 class="text-3xl lg:text-5xl italic font-light">Zapisz sie do listy mailingowej i badz na biezaco z
                    trendami!</h2>
                <input
                    class="appearance-none bg-transparent font-sans border-white border-0 border-b-2 w-full py-2 px-3 text-white mb-3 focus:outline-none focus:shadow-none"
                    id="password" type="email" placeholder="Zapisz się do listy mailingowej">

            </div>
            <div class="hidden sm:flex lg:w-1/2 justify-end pr-12lg:pr-24">
                <img src="<?php bloginfo('template_url'); ?>/images/le_monogram.svg" alt="lestylelist"
                    class="sm:w-32 md:w-48 lg:w-64 h-auto pb-1">
            </div>
        </div> -->
        <div class="flex-col md:flex-row flex md:items-end justify-between">
            <div class="flex justify-center mb-6 md:mb-0 md:justify-normal">
                <a href="<?php echo site_url('/') ?>">

                    <img src="<?php bloginfo('template_url'); ?>/images/le_logo_white.svg" alt="lestylelist"
                        class="w-24 h-auto pb-1">
                </a>
            </div>
            <div class="flex grow justify-between md:pl-24">
                <p class="font-light text-md">Polityka Prywatności</p>
                <a href="https://www.instagram.com/angelika_warlikowska/" target="_blank" class="font-light text-md">
                    <span>
                        O mnie
                    </span>
                </a>
                <a href="https://www.instagram.com/angelika_warlikowska/" target="_blank" class="font-light text-md">
                    <i class="fab fa-instagram"></i>
                    <span class="hidden md:inline-block">Instagram</span>
                </a>
                <a href="https://www.facebook.com/angelika.warlikowska" target="_blank" class="font-light text-md">
                    <i class="fab fa-tiktok"></i>
                    <span class="hidden md:inline-block">TikTok</span>
                </a>
                <a href="https://www.facebook.com/angelika.warlikowska" target="_blank" class="font-light text-md">
                    <i class="fab fa-youtube"></i>
                    <span class="hidden md:inline-block">YouTube</span>
                </a>
            </div>

        </div>
    </footer>

    <div class="flex justify-center">
        <p class="text-sm  font-light mt-12 py-12">Copyright © <?php the_time('Y') ?> <?php bloginfo() ?>. All
            rights reserved.</p>
    </div>
    </footer>
</section>


<?php wp_footer(); ?>

</body>

</html>