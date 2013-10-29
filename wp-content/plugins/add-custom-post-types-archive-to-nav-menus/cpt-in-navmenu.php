<?php
/*
Plugin Name: Add Custom Post Types Archive to Nav Menus
Plugin URI: http://www.andromeda-media.de/
Description: Extends the WP Nav Menu with your Custom Post Type archive pages. The Plugin provides a new meta box in the WP Nav Menus options page. There you can choose your own Custom Post Types to add their archive to your navigation. For Example: if you have a post type called 'videos' to present your videos on your site, with the help of this plugin you can set it as fully functional navigation point in your WP Nav Menu.
Author: andromeda_media
Version: 1.1
Author URI: http://www.andromeda-media.de/
License: GPL v3
Text Domain: andromedamedia
Domain Path: /languages

Add Custom Post Types Archive to Nav Menus
Copyright (C) 2012, andromeda media - info@andromeda-media.de

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if( !function_exists('add_action') ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1. 403 Forbidden');
	exit();
}

if( !class_exists('CustomPostTypeArchiveInNavMenu') ) {
	class CustomPostTypeArchiveInNavMenu {
		
		function CustomPostTypeArchiveInNavMenu() {
			load_plugin_textdomain( 'andromedamedia', false, basename( dirname( __FILE__ ) ) . '/languages' );
			add_action( 'admin_head-nav-menus.php', array( &$this, 'cpt_navmenu_metabox' ) );
			add_filter( 'wp_get_nav_menu_items', array( &$this,'cpt_archive_menu_filter'), 10, 3 );
		}
		
		function cpt_navmenu_metabox() {
	    	add_meta_box( 'add-cpt', __('Custom Post Type Archives', 'andromedamedia'), array( &$this, 'cpt_navmenu_metabox_content' ), 'nav-menus', 'side', 'default' );
	  	}
		
		function cpt_navmenu_metabox_content() {
	    	$post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );
			
			if( $post_types ) :
				foreach ( $post_types as &$post_type ) {
			        $post_type->classes = array();
			        $post_type->type = $post_type->name;
			        $post_type->object_id = $post_type->name;
			        $post_type->title = $post_type->labels->name . ' ' . __( 'Archive', 'andromedamedia' );
			        $post_type->object = 'cpt-archive';
			    }
				$walker = new Walker_Nav_Menu_Checklist( array() );
		
				echo '<div id="cpt-archive" class="posttypediv">';
				echo '<div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">';
				echo '<ul id="ctp-archive-checklist" class="categorychecklist form-no-clear">';
				echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $post_types), 0, (object) array( 'walker' => $walker) );
				echo '</ul>';
				echo '</div><!-- /.tabs-panel -->';
				echo '</div>';
				echo '<p class="button-controls">';
				echo '<span class="add-to-menu">';
				echo '<img class="waiting" src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" alt="" />';
				echo '<input type="submit"' . disabled( $nav_menu_selected_id, 0 ) . ' class="button-secondary submit-add-to-menu" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />';
				echo '</span>';
				echo '</p>';
				
			endif;
		}
		
		function cpt_archive_menu_filter( $items, $menu, $args ) {
	    	foreach( $items as &$item ) {
	      		if( $item->object != 'cpt-archive' ) continue;
	      		$item->url = get_post_type_archive_link( $item->type );
	      
	      		if( get_query_var( 'post_type' ) == $item->type ) {
	       			$item->classes[] = 'current-menu-item';
	        		$item->current = true;
	      		}
	    	}
	    	
	    	return $items;
		}
	}

	/* Instantiate the plugin */
	$CustomPostTypeArchiveInNavMenu = new CustomPostTypeArchiveInNavMenu();
}

?>