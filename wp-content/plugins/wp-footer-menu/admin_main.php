<?php
// Tell Wordpress to run the 'admin_actions' function when the menu is loaded.
add_action( 'admin_menu', 'wp_footer_menu_admin_actions' );

function wp_footer_menu_admin_actions() {
	// Tell Wordpress to install a new page on the menu. 
	// 'mangage_options' refers to the permission that the user has to have in order to access these settings.
	add_options_page( 'WP Footer Menu', 'WP Footer Menu', 'manage_options', 'wp_footer-settings', 'wp_footer_menu_settings', '' );
}

function wp_footer_menu_table ($footer_links) {

	$base_uri = wp_footer_menu_base_uri();
	$delete_nonce = wp_create_nonce( 'footer_delete' );
	
	// Set up table
	$menu_table = '<table class="widefat">';
	$menu_table .= '<thead>';
	// Table Header
	$menu_table .= '<th>Link Title</th>';
	$menu_table .= '<th>Link Address</th>';
	$menu_table .= '<th>Menu Order</th>';
	$menu_table .= '<th>Delete</th>';
	$menu_table .= '</thead>';
	// Table Body
	$menu_table .= '<tbody>';
	foreach ($footer_links as $key => $link) {
		$link_data = explode( ',', $link );
		$menu_table .= '<tr>';
		// The link's title
		$menu_table .= '<td>' . $link_data[0] . '</td>';
		// The link's address
		$menu_table .= '<td>' . $link_data[1] . '</td>';
		// The link's menu order
		$menu_table .= '<td>' . $link_data[2] . '</td>';
		$menu_table .= '<td><a href="' . $base_uri . '&delete=' . $key . '&nonce=' . $delete_nonce . '" class="button-secondary">Delete</a> </td>';
		$menu_table .= '</tr>';
	}
	$menu_table .= '</tbody>';
	$menu_table .= '</table>';

	return $menu_table;
}

function wp_footer_menu_base_uri () {

	// Get the exact URI of this plugin to post data to.
	$base_uri = explode( '&', $_SERVER[ 'REQUEST_URI' ] );
	$base_uri = $base_uri [0];
	return $base_uri;
}

function wp_footer_menu_add () {
	
	$base_uri = wp_footer_menu_base_uri();
	
	// Create the form to send data about a new link.
	$add_form = '<div style="padding: 5px 15px;">';
	$add_form .= '<h3>Add a new menu item</h3>';
	$add_form .= '<form method="post" action="' . $base_uri . '">';
	$add_form .= '<table>' .
		'<tr>' .
			'<td>Link Title: </td><td>' .
			'<input type="text" name="link_title" placeholder="Title" style="width:200px;" />' .
		'</tr>';
		
	$add_form .= '<tr>' .
			'<td>Link Address: </td><td>' .
			'<input type="text" name="link_address" placeholder="http://www.example.com" style="width:300px;" />' .
		'</tr>';
	$add_form .= '<tr>' .
			'<td>Link Order: </td><td>' .
			'<input type="text" name="link_order" value="0" style="width:80px;" />' .
		'</tr>';
	$add_form .= '</table>';
	$add_form .= wp_nonce_field( 'footer_menu', 'add' );
	$add_form .= '<p><input type="submit" class="button-primary" />';
	$add_form .= '</form>';
	$add_form .= '</div>';
	return $add_form;

}

function wp_footer_menu_confirm_delete ($delete) {
	
	$base_uri = wp_footer_menu_base_uri();
	
	// Find out about this menu item.
	$menu_items = get_option ( 'footer_menu_links' );
	$item_to_delete = explode( ',', $menu_items[$delete] );
	$item_title = $item_to_delete[0];
	$item_address = $item_to_delete[1];

	// Create form for user to confirm option.
	echo '<h3>Confirm Delete</h3>';
	echo '<p>Are you sure you want to delete this menu item?</p>';
	echo '<p>Title: ' . $item_title . '</p>' ;
	echo '<p>Address: ' . $item_address . '</p>';
	echo '<form method="post" action="' . $base_uri . '">';
	echo '<input type="hidden" name="delete_key" value="' . $delete . '" />';
	echo wp_nonce_field( 'confirm_delete', 'delete' );
	echo '<input type="submit" class="button-primary" value="Delete item" />';
	echo '</form>';

}

function wp_footer_menu_process() {
	
	if ( isset( $_GET[ 'delete' ] ) ) {
		$nonce = $_GET ['nonce'];
		if ( wp_verify_nonce( $nonce, 'footer_delete' ) ) {
			wp_footer_menu_confirm_delete ( $_GET[ 'delete' ] );
		}
		return 0;
	} else if ( isset( $_POST[ 'delete_key' ] ) && check_admin_referer ( 'confirm_delete', 'delete' ) ) {
		
		$menu_items = get_option ( 'footer_menu_links' );
		$key = $_POST['delete_key'];
		unset ( $menu_items[$key] );
		update_option ( 'footer_menu_links', $menu_items );
	
	}

	if ( isset( $_POST[ 'link_title' ] ) && check_admin_referer( 'footer_menu', 'add' ) ) {
	
		$link_title = $_POST ['link_title'];
		$link_address = $_POST ['link_address'];
		$link_order = $_POST ['link_order'];
		$new_link = $link_title . ',' . $link_address . ',' . $link_order;
		
		$footer_links = get_option( 'footer_menu_links' );
		if ($footer_links == '') {
			$footer_links = array();
		}
		$new_links = array_push( $footer_links, $new_link );
		update_option ( 'footer_menu_links', $footer_links );
	}
	
	return 1;

}

function wp_footer_menu_settings () {
	
	// Create the options panel we want to display on this page.
	
	$continue = wp_footer_menu_process();
	
	if ($continue) {
	
		$footer_links = get_option( 'footer_menu_links' );
		
		echo '<h2>WP Footer Menu</h2>';
		$add_link_form = wp_footer_menu_add ();
		$menu_table = wp_footer_menu_table ( $footer_links );
		
		echo $add_link_form;
		echo $menu_table;
	}

}

?>