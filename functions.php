 <?php
/* Function file */

    if (!function_exists('gallery_setup')):
        function gallery_setup() {
            // WP handle title tags
            add_theme_support('title_tag');
        }
    endif;

add_action('after_setup_theme', 'gallery_setup');


// register menu

function register_gallery_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu')
        )
    );
}

add_action('init', 'register_gallery_menus');

// Add style sheets

function gallery_scripts() {
    // enqueue main stylesheet and fonts
    wp_enqueue_style('gallery_styles', get_stylesheet_uri());
    wp_enqueue_style('gallery_google_fonts_Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700');
    wp_enqueue_style('gallery_google_fonts_Lato', 'https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'gallery_scripts');

// Register widget areas

function gallery_widget_init() {
    register_sidebar(array(
        'name' => __('Main sidebar', 'gallery'),
        'id' => 'main_sidebar',
        'description' => __('widgets added here will appear in all pages using two-column template', 'gallery'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after-title'=> '</h2>'
    ));
}

add_action('widgets_init', 'gallery_widget_init');

// Custom gallery post type

function create_post_type() {
    register_post_type('gallery_items', 
        array(
            'labels' => array(
                'name' => __('Galleries'),
                'singular_name' => __('Gallery')
            ),
            'public' => true,
            'has_archive' => true,
            'support' => 'title'
        )
    );
}

add_action('init', 'create_post_type');

// define prefix

    $prefix = 'ge_';

    $meta_box = array(
        'id' => 'gallery-meta-box',
        'title' => 'Add new gallery listing',
        'page' => 'gallery_items',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'Gallery Name',
                'descr' => 'Enter the name of the gallery you wish to list',
                'id' => $prefix. 'gallery_name',
                'type' => 'text',
                'std' => 'Acrylics for Begginers'
            ),
            array(
                'name' => 'Instructor',
                'descr' => 'Person teaching the gallery class',
                'id' => $prefix. 'instructor',
                'type' => 'text',
                'std' => 'Leslie Yepp'
            ),
            array(
                'name' => 'Headshot thumbnail url',
                'descr' => 'Paste URL of the headshot. You can find this in the media library',
                'id' => $prefix. 'headshot',
                'type' => 'text',
                'std' => 'http://url_of_image'
            ),
            array(
                'name' => 'Skill level',
                'descr' => 'Beginner, Intermediate, or Advanced',
                'id' => $prefix. 'skill',
                'type' => 'text',
                'std' => 'Beginner'
            ),
            array(
                'name' => 'Length',
                'descr' => 'How long will this gallery class last?',
                'id' => $prefix. 'length',
                'type' => 'text',
                'std' => '6 months'
            ),
            array(
                'name' => 'Gallery description',
                'descr' => 'Please write a paragraph describing the gallery class',
                'id' => $prefix. 'description',
                'type' => 'textarea',
                'std' => 'Enter description'
            ),
            array(
                'name' => 'Box Theme',
                'descr' => 'Colors that set theme for gallery box.',
                'id' => $prefix. 'theme',
                'class' => $prefix. 'theme',
                'type' => 'theme_colors',
                'options' => array(
                    array('color' => 'Pink'),
                    array('color' => 'Purple'),
                    array('color' => 'Teal'),
                    array('color' => 'Green'),
                )
            )
        ) // field arrays
    );

add_action('admin_menu', 'gallery_add_box');

function gallery_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'gallery_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

