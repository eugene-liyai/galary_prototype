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