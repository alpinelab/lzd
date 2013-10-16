<?php
include_once('shortcodes.php');
include_once('custom_class.php');
include_once('type/spectacle.php');
include_once('type/residence.php');
Function wp_schools_enqueue_scripts() 
{
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11 );

function remove_meta_portfolio() {
	remove_post_type_support('spectacle', 'editor');
	remove_post_type_support('residence', 'editor');
	remove_meta_box( 'my-custom-sliders' , 'spectacle' , 'normal', 'high' );
	remove_meta_box( 'my-custom-portfolio' , 'spectacle' , 'normal', 'high' );
	remove_meta_box( 'my-custom-parallax' , 'spectacle' , 'normal', 'high' );
	remove_meta_box( 'my-custom-sliders' , 'residence' , 'normal', 'high' );
	remove_meta_box( 'my-custom-portfolio' , 'residence' , 'normal', 'high' );
	remove_meta_box( 'my-custom-parallax' , 'residence' , 'normal', 'high' );
}

add_action( 'admin_init' , 'remove_meta_portfolio');


function add_meta_portfolio() 
{
	add_meta_box( 'my-custom-portfolio', 'Qode Portfolio', array(new myCustomFields(), 'displayCustomPortfolio'), 'residence', 'normal', 'high' );
	add_meta_box( 'my-custom-portfolio', 'Qode Portfolio', array(new myCustomFields(), 'displayCustomPortfolio'), 'spectacle', 'normal', 'high' );
}

add_action( 'admin_init' , 'add_meta_portfolio');

