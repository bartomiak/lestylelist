<?php

/*
 Plugin Name: Vertical Scroll Image Gallery
 Description: Vertical scroll image gallery
 Author:      https://github.com/bartomiak
 Version:     1.0.0
 Author URI:  https://github.com/bartomiak
*/

if (!defined('ABSPATH'))
    exit;

class VerticalScrollImageGallery
{

    function __construct()
    {
        add_action('init', array($this, 'lestyleAssets'));

    }

    function lestyleAssets()
    {
        wp_register_script('verticalGalleryBlockType', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-editor'), true);
        register_block_type(
            'lestyle/vertical-scroll-image-gallery',
            array(
                'editor_script' => 'verticalGalleryBlockType',
                'render_callback' => array($this, 'renderHTML'),
            )
        );
    }

    function renderHTML($attributes)
    {
        if (!is_admin()) {
            wp_enqueue_script('vertical-scroll-gallery-frontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'));
            wp_enqueue_style('vertical-scroll-gallery-frontend', plugin_dir_url(__FILE__) . 'build/output.css');
            // wp_enqueue_style('vertical-scroll-gallery-frontend', plugin_dir_url(__FILE__) . 'build/frontend.css');
        }

        $images = isset($attributes['images']) ? $attributes['images'] : [];
        ob_start();
        ?>
        <div class="vertical-scroll-gallery " style="height: 100vh; overflow-y: auto;">
            <?php foreach ($images as $image): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                    class="gallery-image object-cover" style="width: 100%; margin-bottom: 10px;" />
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

$verticalScrollImageGallery = new VerticalScrollImageGallery();