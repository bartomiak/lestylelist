<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <!-- Mobile menu -->
    <div class="hidden flex-col mobile-nav fixed h-full w-full z-50 bg-beige p-3 ">
        <div class="flex justify-between  mb-3 mt-3">
            <a href="<?php echo site_url('/') ?>"><img
                    src="<?php bloginfo('template_url'); ?>/images/le_header_logo.svg" alt="lestylelist"
                    class="w-auto h-6 mb-3"></a>
            <svg class="mobile-nav__close-btn  cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M0.686279 0.536316L23.3137 23.1637" stroke="#1C1B19" stroke-width="1.3" />
                <path d="M23.3137 0.536316L0.686274 23.1637" stroke="#1C1B19" stroke-width="1.3" />
            </svg>
        </div>
        <nav>
            <?php wp_nav_menu(
                array(
                    'theme_location' => 'headerLocation',
                    'menu_class' => 'top-menu-mobile',
                    'depth' => 1,
                )
            ) ?>
        </nav>
        <ul class="flex text-black border-t pt-3 justify-center">
            <li class="mr-3">
                <a href="#" class="text-2xl" target="_blank"><i class="fab fa-youtube"></i></a>
            </li>
            <li class="ml-2">
                <a href="#" class="text-2xl" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
    <!-- end of mobile -->
    <header class="container-fluid mx-auto flex flex-col bg-white">
        <div class="flex w-full justify-between py-5 items-center px-3 md:px-6">
            <nav class="hidden md:flex flex-1">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'headerLocation',
                        'menu_class' => 'top-menu flex',
                        'depth' => 1,
                    )
                ) ?>
            </nav>
            <a href="<?php echo site_url('/') ?>" class="flex-1 flex md:justify-center"><img
                    src="<?php bloginfo('template_url'); ?>/images/le_header_logo.svg" alt="lestylelist"
                    class="w-auto h-6 md:h-8"></a>
            <div class="flex items-center flex-1 justify-end">
                <!-- <i class="mobile-nav__open-btn text-xl cursor-pointer fas fa-bars md:hidden"></i> -->
                <img src="<?php bloginfo('template_url'); ?>/images/icons/hamburger_icon.svg" alt="search"
                    class="mobile-nav__open-btn cursor-pointer w-auto h-3 md:hidden">
                <div id="search"></div>
            </div>
        </div>
    </header>