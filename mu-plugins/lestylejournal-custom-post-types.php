<?php
function theme_post_types()
{
    // register in singular
    register_post_type(
        'links',
        array(
            'supports' => array('title', 'thumbnail'),
            'rewrite' => array(
                // change slug to plural
                'slug' => 'links',
                // this is to hide /looks from navigation
                // 'slug' => '/',
                'with_front' => false
            ),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Affilate shop',
                'singular_name' => 'Affilate link',
                'add_new_item' => 'Add new link',
                'add_new' => 'Add new link',
                'edit_item' => 'Edit links',
                'all_items' => 'All links',
                'featured_image' => 'Link image',
                'set_featured_image' => 'Upload link image',
                'menu_name' => 'Affilate shop',
                'remove_featured_image' => 'Remove link image',
            ),
            'menu_icon' => 'dashicons-store'
        )
    );

    register_post_type(
        'looks',
        array(
            'supports' => array('title', 'thumbnail'),
            'rewrite' => array(
                // change slug to plural
                'slug' => 'looks',
                // this is to hide /looks from navigation
                // 'slug' => '/',
                'with_front' => false
            ),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Wear',
                'singular_name' => 'Look',
                'add_new_item' => 'Add new look',
                'add_new' => 'Add new look',
                'edit_item' => 'Edit look',
                'all_items' => 'All looks',
                'featured_image' => 'Look image',
                'set_featured_image' => 'Upload look image',
                'menu_name' => 'Looks',
                'remove_featured_image' => 'Remove look image',
            ),
            'menu_icon' => 'dashicons-camera'
        )
    );
}

add_action('init', 'theme_post_types');
