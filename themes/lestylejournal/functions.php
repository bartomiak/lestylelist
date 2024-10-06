<?php

function lestylejournal_files()
{
    wp_enqueue_script('main-lestylejournal-js', get_theme_file_uri('/build/index.js'), '1.0', true);
    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');
    wp_enqueue_style('lestylejournal_main_styles', get_theme_file_uri('/style.css'));
    wp_enqueue_style('lestylejournal_extra_styles', get_theme_file_uri('/build/index.css'));
    wp_localize_script(
        'main-lestylejournal-js',
        'rootVariables',
        array(
            'root_url' => get_site_url(),
        )
    );
}

function lestylejournal_theme_support()
{
    register_nav_menu('headerLocation', 'Header Menu');
    register_nav_menu('footerLocationOne', 'Footer Menu One');
    register_nav_menu('footerLocationTwo', 'Footer Menu Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}


function lestyle_custom_rest()
{
    // register_rest_field(
    //     'recipe',
    //     'thumbnail',
    //     array(
    //         'get_callback' => function () {
    //             return get_the_post_thumbnail_url();
    //         },
    //     )
    // );
    register_rest_field(
        'post',
        'thumbnail',
        array(
            'get_callback' => function () {
                return get_the_post_thumbnail_url();
            },
        )
    );
}

function custom_header_url()
{
    return site_url('/');
}
;

// Change login page styles file
function login_files()
{
    wp_enqueue_style('lestylejournal_main_styles', get_theme_file_uri('/style.css'));
}

add_action('cmb2_admin_init', 'lestyle_register_links_metabox');
function lestyle_register_links_metabox()
{
    $prefix = 'lestyle_';

    $cmb = new_cmb2_box(
        array(
            'id' => $prefix . 'links_metabox',
            'title' => __('Look URL', 'cmb2'),
            'object_types' => array('links'), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
        )
    );

    $cmb->add_field(
        array(
            'name' => __('URL', 'cmb2'),
            'desc' => __('Enter the URL for this look', 'cmb2'),
            'id' => $prefix . 'link_url',
            'type' => 'text_url',
            'protocols' => array('http', 'https'), // Array of allowed protocols
        )
    );

    $cmb->add_field(
        array(
            'name' => __('Is Featured', 'cmb2'),
            'desc' => __('Check if this is a featured link', 'cmb2'),
            'id' => $prefix . 'is_featured',
            'type' => 'checkbox',
        )
    );
}


add_action('cmb2_admin_init', 'lestyle_register_looks_metabox');
function lestyle_register_looks_metabox()
{
    $prefix = 'yourprefix_';

    // Create a new CMB2 box
    $cmb = new_cmb2_box(
        array(
            'id' => $prefix . 'looks_metabox',
            'title' => __('Look Details', 'cmb2'),
            'object_types' => array('looks'), // Post type
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
        )
    );

    // Add a repeatable group field
    $group_field_id = $cmb->add_field(
        array(
            'id' => $prefix . 'look_group',
            'type' => 'group',
            'description' => __('Add look details', 'cmb2'),
            'options' => array(
                'group_title' => __('Look {#}', 'cmb2'), // {#} gets replaced by row number
                'add_button' => __('Add Another Look', 'cmb2'),
                'remove_button' => __('Remove Look', 'cmb2'),
                'sortable' => true, // Allow reordering
            ),
        )
    );

    // Add fields to the repeatable group
    $cmb->add_group_field(
        $group_field_id,
        array(
            'name' => __('Title', 'cmb2'),
            'id' => 'title',
            'type' => 'text',
        )
    );

    $cmb->add_group_field(
        $group_field_id,
        array(
            'name' => __('URL', 'cmb2'),
            'id' => 'url',
            'type' => 'text_url',
        )
    );

    $cmb->add_group_field(
        $group_field_id,
        array(
            'name' => __('Image', 'cmb2'),
            'id' => 'image',
            'type' => 'file',
        )
    );
}


// Add a taxonomy for the 'links' content type
function register_links_taxonomy()
{
    $labels = array(
        'name' => _x('Link Categories', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Link Category', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Link Categories', 'textdomain'),
        'all_items' => __('All Link Categories', 'textdomain'),
        'parent_item' => __('Parent Link Category', 'textdomain'),
        'parent_item_colon' => __('Parent Link Category:', 'textdomain'),
        'edit_item' => __('Edit Link Category', 'textdomain'),
        'update_item' => __('Update Link Category', 'textdomain'),
        'add_new_item' => __('Add New Link Category', 'textdomain'),
        'new_item_name' => __('New Link Category Name', 'textdomain'),
        'menu_name' => __('Link Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'link-category'),
        'show_in_rest' => true, // Enable REST API support
    );

    register_taxonomy('link_category', array('links'), $args);
}
add_action('init', 'register_links_taxonomy', 0);


function read_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assuming average reading speed of 200 words per minute

    return $reading_time . ' MIN CZYTANIA';
}

function display_time_ago($post_id)
{
    // Get the post's publication date
    $post_date = get_the_date('Y-m-d', $post_id);

    // Convert the post date to a timestamp
    $post_timestamp = strtotime($post_date);

    // Get the current timestamp
    $current_timestamp = current_time('timestamp');

    // Calculate the difference in days
    $time_difference = floor(($current_timestamp - $post_timestamp) / DAY_IN_SECONDS);

    if ($time_difference < 7) {
        return $time_difference . ' dni temu';
    } elseif ($time_difference >= 7 && $time_difference < 14) {
        return 'tydzień temu';
    } elseif ($time_difference >= 14 && $time_difference < 21) {
        return 'dwa tygodnie temu';
    } elseif ($time_difference >= 21 && $time_difference < 28) {
        return 'trzy tygodnie temu';
    } elseif ($time_difference >= 28 && $time_difference < 120) {
        return 'miesiąc temu';
    } else {
        // If older than 4 months, return the date of post publication
        return get_the_date('F j, Y', $post_id);
    }
}

function lestyle_register_block_styles()
{
    register_block_style(
        'core/column',
        array(
            'name' => 'custom-styles',
            'label' => __('Custom Text Col Styles', 'lestyle'),
        )
    );
}

function my_custom_post_template()
{
    // Get the 'post' post type object
    $post_type_object = get_post_type_object('post');

    // Define the block template for the 'post' post type
    $post_type_object->template = array(
        array(
            'core/columns',
            array(),
            array(
                // Left column
                array(
                    'core/column',
                    array(),
                    array(
                        array('create-block/vertical-gallery'),
                    )
                ),
                // Right column
                array(
                    'core/column',
                    array('className' => 'is-style-custom-styles'),
                    array(
                        array(
                            'core/group',
                            array(),
                            array(
                                array(
                                    'core/columns',
                                    array(),
                                    array(
                                        // Column for date
                                        array(
                                            'core/column',
                                            array(),
                                            array(
                                                array(
                                                    'core/post-date',
                                                    array(
                                                        'format' => 'd.m.Y'
                                                    )
                                                ),
                                            )
                                        ),
                                        // Column for reading time
                                        array(
                                            'core/column',
                                            array(),
                                            array(
                                                array('create-block/readingtime'),
                                            )
                                        ),
                                    )
                                ),
                                // Add a new row with the core/title block
                                array(
                                    'core/columns',
                                    array(),
                                    array(
                                        array(
                                            'core/column',
                                            array(),
                                            array(
                                                array(
                                                    'core/post-title',
                                                    array(
                                                        'textAlign' => 'center'
                                                    )
                                                ), // Adding the title block
                                            )
                                        ),
                                    )
                                ),
                            )
                        ),
                    )
                ),
            )
        ),
    );
}

// custom comment form
function custom_comment_callback($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body  border-b">
            <div class="comment-header flex justify-between my-3">
                <!-- Author Name and Comment Date -->
                <div class="comment-author font-light uppercase">
                    <?php printf('<strong>%s</strong>', get_comment_author_link()); ?>
                </div>

                <div class="comment-date">
                    <?php
                    // Format the date as '23.11.2023'
                    $comment_date = get_comment_date('d.m.Y');
                    $comment_datetime = get_comment_time('c'); // ISO 8601 format for datetime attribute
                
                    printf(
                        '<time datetime="%s">%s</time>',
                        esc_attr($comment_datetime),
                        esc_html($comment_date)
                    );
                    ?>
                </div>

                <!-- Reply Button -->
                <div class="comment-reply uppercase">
                    <?php comment_reply_link(array_merge($args, array('reply_text' => __('Odpowiedz', 'lestyle-theme'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </div>
            </div>

            <div class="comment-content mb-3 font-sans">
                <?php comment_text(); ?>
            </div>
        </article><!-- .comment-body -->
    </li>
    <?php
}


// disable avatars in comments
add_filter('get_avatar', '__return_null');

add_action('init', 'my_custom_post_template');
add_action('init', 'lestyle_register_block_styles');
add_filter('login_headerurl', 'custom_header_url');
add_action('login_enqueue_scripts', 'login_files');
add_action('rest_api_init', 'lestyle_custom_rest');
add_action('after_setup_theme', 'lestylejournal_theme_support');
add_action('wp_enqueue_scripts', 'lestylejournal_files');
