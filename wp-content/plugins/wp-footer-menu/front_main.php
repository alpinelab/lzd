<?php

add_action( 'wp_footer', 'wp_footer_menu_init' );

function wp_footer_menu_init () {

	$menu_items = get_option ( 'footer_menu_links' );

	echo '<div id="wp_footer_menu">';
	foreach ($menu_items as $item) {
		$link = explode(',', $item);
		echo '<div class="wp_footer_item"><a href="' . $link[1] . '" class="wp_footer_link">' . $link[0] . '</a></div>';
	}
	echo '</div>';
}

?>