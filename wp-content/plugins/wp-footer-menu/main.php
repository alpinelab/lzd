<?php
/*
Plugin Name: WP Footer Menu
Plugin URI: http://www.graemeboy.com/wp-footer-menu/
Description: Creates a customizable footer menu on your Wordpress site.
Version: 2.0
Author: Graeme Boy
Author URI: http://www.graemeboy.com
*/
// Tell Wordpress to run the 'admin_actions' function when the menu is loaded.
add_action( 'admin_menu', 'wp_footer_menu_admin_actions' );
add_action( 'wp_footer', 'wp_footer_menu_init' );
add_shortcode('print_wp_footer', 'wp_footer_print_menu');
add_action('wp_enqueue_scripts', 'wp_footer_enqueue');

function wp_footer_enqueue() {
	$script_url = WP_PLUGIN_URL . '/wp_footer_menu/waypoints.min.js';
	$script_file = WP_PLUGIN_DIR . '/wp_footer_menu/waypoints.min.js';
	$values = get_option('wp_footer_values');
	if (!empty($values['auto-sticky'])) {
		if ($values['auto-sticky'] == 'yes') {
			if ( file_exists($script_file) ) {
				wp_register_script( 'wp_footer_sticky', $script_url );
				wp_enqueue_script( 'wp_footer_sticky' );
			}
		}
	}
}

function wp_footer_menu_init() {
	$values = get_option('wp_footer_values');
	if (trim($values['auto-footer']) == 'yes') {
		print wp_footer_print_menu();
	}
}

function wp_footer_menu_admin_actions() {
	// Tell Wordpress to install a new page on the menu. 
	// 'mangage_options' refers to the permission that the user has to have in order to access these settings.
	add_options_page( 'WP Footer Menu', 'WP Footer Menu', 'manage_options', 'wp_footer-settings', 'wp_footer_menu_settings', '' );
}

function wp_footer_menu_table ($footer_links) {
	$menu_table = '';
	
	if (!empty($footer_links)) {
		$base_uri = wp_footer_menu_base_uri();
		$delete_nonce = wp_create_nonce( 'footer_delete' );
		
		// Set up table
		$menu_table .= '<h3>Your Menu Items</h3>';
		$menu_table .= '<table class="widefat">';
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
			$menu_table .= '<td style="padding: 5px 0px;">
			<a href="' . $base_uri . '&delete=' . $key . '&nonce=' . $delete_nonce . '" class="button-secondary">Delete</a> </td>';
			$menu_table .= '</tr>';
		}
		$menu_table .= '</tbody>';
		$menu_table .= '</table>';
	}
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
	?>
	
	<h3>Add a new menu item</h3>
	<form method="post" action="<?php echo $base_uri; ?>">
		<table class="widefat">
			<thead>
				<th>Link Title</th>
				<th>Link Address</th>
				<th>Link Order</th>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" name="link_title" placeholder="Title" style="width:200px;" /></td>
					<td><input type="text" name="link_address" placeholder="http://www.example.com" style="width:300px;" /></td>
					<td><input type="text" name="link_order" value="0" style="width:80px;" /></td>
				</tr>
			</tbody>
		</table>
		<?php wp_nonce_field( 'footer_menu', 'add' ); ?>
		<p><input type="submit" class="button-primary" value="Add Item" /></p>
	</form>
	
	<?php
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
	
	if ( isset( $_POST[ 'font-size' ] ) && check_admin_referer( 'footer_menu', 'save' ) ) {
		if (empty($_POST['auto-footer'])) {
			$_POST['auto-footer'] = 'no';
		}
		if (empty($_POST['auto-sticky'])) {
			$_POST['auto-sticky'] = 'no';
		}
		update_option('wp_footer_values', $_POST);
		echo '<div class="wp_footer_info" style="margin:0 auto;margin-top:5px;text-align:center;">Customizations Saved</div>';
	}
	
	return 1;

}

function wp_footer_print_menu() {
	$menu = wp_footer_get_menu();
	$values = get_option('wp_footer_values');
	foreach ($values as $attr=>$val) {
		$menu = str_replace('%' . $attr . '%', stripslashes($val), $menu);
	}
	echo $menu;
	if ($values['auto-sticky'] == 'yes') {
		?>
		<style type="text/css">
			.wp_footer_sticky {
				position:fixed;
				bottom: 0;
	                        width: 940px;
				z-index: 10000;
			}
		</style>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#wp_footer_menu').addClass('wp_footer_sticky');
			});
		</script>
		<?php
	}
}

function wp_footer_shortcode() {
	wp_footer_print_menu();
}

function wp_footer_menu_settings () {
	
	// Create the options panel we want to display on this page.
	
	$continue = wp_footer_menu_process();
	
	if ($continue) {
	
		$defaults = array (
			'padding-top' => '10px',
			'padding-bottom' => '5px',
			'padding-left' => '15px',
			'color' => '#1E598E',
			'background-color' => '#E3EDF4',
			'border' => '1px solid #C9DBEC',
			'border-radius' => '5px',
			'text-shadow' => '1px 1px white',
			'text-decoration' => 'none',
			'font-size' => '13px',
			'font-family' => 'Helvetica Neue, Arial, sans-serif',
			'margin-right' => '8px',
			'auto-sticky' => 'yes',
			'auto-footer' => 'yes',
		);
		$values = get_option('wp_footer_values');
		foreach ($defaults as $attr=>$val) {
			if (empty($values[$attr])) {
				$values[$attr] = $val;
			}
		}
		foreach ($values as $attr=>$val) {
			$values[$attr] = stripslashes($val);
		}
		
		$footer_links = get_option( 'footer_menu_links' );
		
		echo '<h2>WP Footer Menu</h2>';
		?>
		<p class="widefat wp_footer_info" style="padding: 5px 10px;width: 570px;">
			Insert the menu on your site using the shortcode: [print_wp_footer]<br/>
			To use it in a .php file, remember to use: &lt;?php do_shortcode('[print_wp_footer]'); ?&gt;</p>
		
		<?php
		$menu_table = wp_footer_menu_table ( $footer_links );
		echo $menu_table;
		wp_footer_menu_add ();

		echo '<h3>Customize Your Footer Menu</h3>';
		echo '<h4 style="margin-bottom:0;">Customization Options</h4>';
		?>
		<form method="post">
		<table id="footer_customization">
			<tr>
				<td>
					<h4>Item Style</h4>
					<table>
						<tr>
							<td class="wp_footer_attr">Font Size</td>
							<td><input type="text" name="font-size" value="<?php echo $values['font-size']; ?>"/></td> 
						</tr>
						<tr>
							<td class="wp_footer_attr">Text Color</td>
							<td><input type="text" name="color" value="<?php echo $values['color']; ?>"/></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Text-Decoration</td> 
							<td>
							<select name="text-decoration">
								<option <?php if ($values['text-decoration'] == 'underline') { echo 'selected="selected"'; } ?> value="underline">Underline</option>
								<option <?php if ($values['text-decoration'] == 'none') { echo 'selected="selected"'; } ?> value="none">None</option>
							</select>
							</td>
						</tr>
						<tr>
							<td class="wp_footer_attr">List Alignment</td>
							<td>
								<select name="float">
									<option <?php if ($values['float'] == 'left') { echo 'selected="selected"'; } ?> value="left">Horizontal</option>
									<option <?php if ($values['float'] == 'none') { echo 'selected="selected"'; } ?> value="none">Vertical</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Spacing Between Items</td>
							<td><input type="text" name="margin-right" value="<?php echo $values['margin-right']; ?>"/></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Font-Family</td>
							<td><input type="text" name="font-family" value="<?php echo $values['font-family']; ?>"/></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Text Shadow</td>
							<td><input type="text" name="text-shadow" value="<?php echo $values['text-shadow']; ?>"/></td>
						</tr>
					</table>
				</td>
				<td>
					<h4>Menu Style</h4>
					<table>
						<tr>
							<td class="wp_footer_attr">Background-Color</td>
							<td><input type="text" name="background-color" value="<?php echo $values['background-color']; ?>" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Left Padding</td>
							<td><input type="text" name="padding-left" value="<?php echo $values['padding-left']; ?>" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Top Padding</td>
							<td><input type="text" name="padding-top" value="<?php echo $values['padding-top']; ?>" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Bottom Padding</td>
							<td><input type="text" name="padding-bottom" value="<?php echo $values['padding-bottom']; ?>" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Border Radius</td>
							<td><input type="text" name="border-radius" value="<?php echo $values['border-radius']; ?>" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Border</td>
							<td><input type="text" name="border" value="<?php echo $values['border']; ?>" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Sticky Bottom</td>
							<td><input type="checkbox" name="auto-sticky"  <?php if ($values['auto-sticky'] == 'yes') { echo 'checked="checked"'; } ?> value="yes" /></td>
						</tr>
						<tr>
							<td class="wp_footer_attr">Automatically Add to Site</td>
							<td><input type="checkbox" name="auto-footer"  <?php if ($values['auto-footer'] == 'yes') { echo 'checked="checked"'; } ?> value="yes" /></td>
						</tr>
						<tr>
							<td></td>
							<td>
							<?php wp_nonce_field( 'footer_menu', 'save' ); ?>
							<input type="submit" class="button-primary" value="Save Customizations" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form>
		<style type="text/css">
			#footer_customization td {
				vertical-align: top;
				padding: 0 10px 0 0;
			}
			.wp_footer_info {
				background-color: #fefefe;
				border-radius: 2px;
				-webkit-border-radius: 2px;
				-moz-border-radius: 2px;
				border: 1px solid #dddeee;
				box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
				height: auto;
				margin: 5px 0;
				padding: 7px 10px;
				font-size:13px;
				text-align: left;
				width: 420px;
			}
			.wp_footer_attr {
				font-weight: bold;
				padding-top: 2px;
				vertical-align: middle !important;
			}
		</style>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				footer_updateMenu();
				$('input[type="text"]').keyup(function () {
					footer_updateMenu();
				});	
				$('select').change(function () {
					footer_updateMenu();
				});
				
				function footer_updateMenu() {
					var newMenu = $('#footer_old_menu').html(); // overwriting
					$('input[type="text"], select').each(function () {
						var newVal = $(this).val();
						var attr = $(this).attr('name');
						attr = '%' + attr + '%';
						newMenu = newMenu.replace(new RegExp(attr, 'g'), newVal);
						$('#footer_preview').html(newMenu);
					});
				}
			});
			
		</script>
		<?php
		echo '<h4>Preview of Menu</h4>';
		echo '<div>';
		echo '<div id="footer_old_menu" style="display:none;">';
		echo wp_footer_get_menu();
		echo '</div>';
		echo '<div id="footer_preview">';
		echo wp_footer_get_menu();
		echo '</div>';
		echo '</div>';
		
	}

}

function wp_footer_get_menu () {
	$menu_items = get_option ( 'footer_menu_links' );
	$menu = '';
	$menu .= '<div id="wp_footer_menu" style="border:%border%!important;-webkit-border-radius:%border-radius%!important;-moz-border-radius:%border-radius%!important;border-radius:%border-radius%!important;background-color:%background-color%!important;padding-left:%padding-left%!important;padding-bottom:%padding-bottom%!important;padding-top:%padding-top%!important;">';
	$menu .= '<ul style="padding:0;margin:0;">';
	if (!empty($menu_items)) {
		foreach ($menu_items as $item) {
			$link = explode(',', $item);
			$menu .= '<li style="list-style:none!important;margin-right:%margin-right%!important;float:%float%!important;" class="wp_footer_item">
			<a href="' . $link[1] . '" style="font-family:%font-family%!important;text-shadow:%text-shadow%!important;font-size:%font-size%!important;color:%color%!important;text-decoration:%text-decoration%!important;" >' . 
				$link[0] . '</a></li>';
		}
	}
	$menu .= '</ul>';
	$menu .= '<div style="clear:both;"></div>';
	$menu .= '</div>';
	
	return $menu;
}

?>