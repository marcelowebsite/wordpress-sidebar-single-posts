<?php
/**
 * Plugin Name: Single Post Content Plus
 * Description: Adds a sidebar/widget to single posts.
 * Version: 1.0.0
 * Author: Marcelo Pereira
 * Text Domain: spcp
 * License: GPL-2.0+
 */

//If this file is called directly, die
if( !defined('ABSPATH')) {
    die;
}

//Load custom stylesheet styles

add_action( 'wp_enqueue_scripts', 'spcp_load_stylesheet' );
/**
 * Load plugin styles
 */
function spcp_load_stylesheet()
{
    if (apply_filters('spcp_load_styles', true)) {
        wp_enqueue_style('spcp_custom_styles', plugin_dir_url(__FILE__) . 'spcp_styles.css');
    }
}
// Uncomment the following line to keep spcp
// add_filter('spcp_load_styles', '__return_false');
add_action('widgets_init', 'registerSidebar');

/**
 * Registers a sidebar called Post Content Plus
 */
function registerSidebar() {
    register_sidebar( array(
        'name'          => __('Post Content Plus', 'spcp'),
        'id'            => 'spcp-sidebar',
        'description'   => __('Widgets in this area display on single posts', 'spcp'),
        'before_widget' => '<div class="widget spcp-sidebar">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle spcp-title">',
        'after-title'   => '</h2>',
    ));
}

add_filter('the_content', 'addSidebar');
function addSidebar($content){
    dynamic_sidebar('spcp-sidebar');
    return $content;
}