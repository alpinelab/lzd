<?php
include_once('shortcodes.php');
include_once('custom_class.php');
include_once('type/spectacle.php');
include_once('type/residence.php');

/**
 * Remove parent theme stuff
 */

function remove_portfolio_post_type() {
  remove_action('init', 'create_post_type');
}
add_action('after_setup_theme', 'remove_portfolio_post_type');

function remove_portfolio_taxonomy() {
  remove_action('init', 'create_portfolio_taxonomies');
}
add_action('after_setup_theme', 'remove_portfolio_taxonomy');

function remove_meta_fields_for_spectacle() {
  remove_post_type_support('spectacle', 'editor');
  remove_meta_box('my-custom-sliders'  , 'spectacle' , 'normal', 'high');
  remove_meta_box('my-custom-portfolio', 'spectacle' , 'normal', 'high');
  remove_meta_box('my-custom-parallax' , 'spectacle' , 'normal', 'high');
}
add_action('admin_init' , 'remove_meta_fields_for_spectacle');

function remove_meta_fields_for_residence() {
  remove_post_type_support('residence', 'editor');
  remove_meta_box('my-custom-sliders',   'residence', 'normal', 'high');
  remove_meta_box('my-custom-portfolio', 'residence', 'normal', 'high');
  remove_meta_box('my-custom-parallax',  'residence', 'normal', 'high');
}
add_action( 'admin_init' , 'remove_meta_fields_for_residence');


/**
 * Add child theme stuff
 */

function add_meta_fields_for_spectacle() {
  add_meta_box( 'my-custom-portfolio', 'Qode Portfolio', array(new myCustomFields(), 'displayCustomPortfolio'), 'spectacle', 'normal', 'high');
}
add_action( 'admin_init' , 'add_meta_fields_for_spectacle');

function add_meta_fields_for_residence() {
  add_meta_box( 'my-custom-portfolio', 'Qode Portfolio', array(new myCustomFields(), 'displayCustomPortfolio'), 'residence', 'normal', 'high');
}
add_action( 'admin_init' , 'add_meta_fields_for_residence');

function wp_schools_enqueue_scripts() {
  wp_register_style('childstyle', get_stylesheet_directory_uri() . '/style.css');
  wp_enqueue_style('childstyle');
}
add_action('wp_enqueue_scripts', 'wp_schools_enqueue_scripts');
