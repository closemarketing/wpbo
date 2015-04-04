<?php
/**
 * @package WordPress.
 * @subpackage WPBoot Child Theme.
 * About: Add your awesome functions here.
*/

// Load Parent Style Parent Theme - Fastest Way
add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );
function my_child_theme_scripts() {
wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
}