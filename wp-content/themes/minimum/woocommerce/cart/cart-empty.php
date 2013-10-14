<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="woo_cart_empty_holder">
<p class="woo_cart_empty"><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>
<div class="woo_separator"></div>
<p class="woo_cart_emtpty_button"><a class="button" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e( '&larr; Return To Shop', 'woocommerce' ) ?></a></p>
</div>