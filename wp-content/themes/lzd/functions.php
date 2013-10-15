<?php
include_once('custom_class.php');

Function wp_schools_enqueue_scripts() 
{
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11 );

if (!function_exists('create_post_type')) {
	function create_post_type() {
		register_post_type( 'portfolio_page',
			array(
				'labels' => array(
					'name' => __( 'portfolio_pages','qode' ),
					'singular_name' => __( 'portfolio_page','qode' ),
					'add_item' => __('Nouveau portfolio_page','qode'),
	                'add_new_item' => __('Ajouter un portfolio_page','qode'),
	                'edit_item' => __('Modifier un portfolio_page','qode')
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'portfolio_page'),
				'menu_position' => 2,
				'show_ui' => true,
			)
		);
		  flush_rewrite_rules();
	}
}
add_action( 'init', 'create_post_type' );



function remove_meta_portfolio() {
	remove_post_type_support('portfolio_page', 'editor');
	remove_meta_box( 'my-custom-sliders' , 'portfolio_page' , 'normal', 'high' );
	remove_meta_box( 'my-custom-portfolio' , 'portfolio_page' , 'normal', 'high' );
	remove_meta_box( 'my-custom-parallax' , 'portfolio_page' , 'normal', 'high' );
}

add_action( 'admin_init' , 'remove_meta_portfolio');


function add_meta_portfolio() 
{
	add_meta_box( 'my-custom-portfolio', 'Qode Portfolio', array(new UneClassJustePourQueCaMarche(), 'displayCustomPortfolio'), 'portfolio_page', 'normal', 'high' );
}

add_action( 'admin_init' , 'add_meta_portfolio');