<?php
if (!function_exists('create_post_type')) {
	function create_post_type() {
		register_post_type( 'spectacle',
			array(
				'labels' => array(
					'name' => __( 'Spectacle','qode' ),
					'singular_name' => __( 'spectacle','qode' ),
					'add_item' => __('Nouveau spectacle','qode'),
	                'add_new_item' => __('Ajouter un spectacle','qode'),
	                'edit_item' => __('Modifier un spectacle','qode')
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'spectacle'),
				'menu_position' => 2,
				'show_ui' => true,
				'supports' => array('thumbnail', 'title')
			)
		);
		  flush_rewrite_rules();
	}
}
add_action('init', 'create_post_type');

if (!function_exists('create_portfolio_taxonomies_spectacle')) 
{
	function create_portfolio_taxonomies() 
	{
	   $labels = array(
	    'name' => __( 'Catégorie de spéctacles', 'taxonomy general name' ),
	    'singular_name' => __( 'Catégorie de spéctacle', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Portfolio Categories','qode' ),
	    'all_items' => __( 'All Portfolio Categories','qode' ),
	    'parent_item' => __( 'Parent Portfolio Category','qode' ),
	    'parent_item_colon' => __( 'Parent Portfolio Category:','qode' ),
	    'edit_item' => __( 'Edit Portfolio Category','qode' ), 
	    'update_item' => __( 'Update Portfolio Category','qode' ),
	    'add_new_item' => __( 'Add New Portfolio Category','qode' ),
	    'new_item_name' => __( 'New Portfolio Category Name','qode' ),
	    'menu_name' => __( 'Catégorie de spectacles','qode' ),
	  );     

	  register_taxonomy('portfolio_category',array('spectacle'), array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'spectacle-category' ),
	  ));

	}
}
add_action( 'init', 'create_portfolio_taxonomies_spectacle', 0 );
?>