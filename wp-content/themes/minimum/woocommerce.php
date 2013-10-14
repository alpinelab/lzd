<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php 
global $wp_query;
global $woocommerce;
//$id = $wp_query->get_queried_object_id();
get_option('woocommerce_shop_page_id'); 
$id = get_option('woocommerce_shop_page_id');
$shop= get_page($id);

$sidebar = get_post_meta($id, "qode_show-sidebar", true);  
?>
	<?php get_header(); ?>

		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
			<div class="container">
				<div class="title">
					<h1><span>
					<?php
						if(is_shop() || is_product_category()){
							echo $shop->post_title;
						}else{
							the_title();  
						}					
					?>
					</span> <?php if(get_post_meta($id, "qode_page-subtitle", true)) { ?>/ <?php echo get_post_meta($id, "qode_page-subtitle", true) ?><?php } ?></h1>
 
 					<div class="woocommerce_cart_items">
 						<?php if($woocommerce->cart->cart_contents_count > 0 ){ ?>
							<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
								<img src="<?php bloginfo('template_url'); ?>/img/woocommerce_cart_image.png" /><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> , <?php echo $woocommerce->cart->get_cart_total(); ?>
							</a>
						<?php }else{ ?>
							<a class="cart-contents" href="" ></a>
						<?php } ?>	
 					</div>
				</div>
			</div>
		<?php } ?>
		
		<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){
			echo do_shortcode($revslider);
		}
		?>
		<div class="container">
		
		<?php if(!is_singular('product')) { ?>
			<?php if(($sidebar == "default")||($sidebar == "")) : ?>
				<?php woocommerce_content(); ?>	
			<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
				
				<?php if($sidebar == "1") : ?>	
					<?php global $woocommerce_loop;
						  $woocommerce_loop['columns'] = 2;
				    ?>
					<div class="two_columns_66_33 clearfix">
						<div class="column_left">
				<?php elseif($sidebar == "2") : ?>	
					<?php global $woocommerce_loop;
					  	  $woocommerce_loop['columns'] = 3;
			    	?>	
					<div class="two_columns_75_25 clearfix">
						<div class="column_left">
				<?php endif; ?>
						<div class="column_inner">
							<?php woocommerce_content(); ?>	
						</div>
								
						</div>
						<div class="column_right"><?php get_sidebar();?></div>
					</div>
				<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
					<?php if($sidebar == "3") : ?>	
						<?php global $woocommerce_loop;
						  	  $woocommerce_loop['columns'] = 2;
				    	?>
						<div class="two_columns_33_66 clearfix">
							<div class="column_left"><?php get_sidebar();?></div>
							<div class="column_right">
					<?php elseif($sidebar == "4") : ?>
						<?php global $woocommerce_loop;
						  	  $woocommerce_loop['columns'] = 3;
				    	?>	
						<div class="two_columns_25_75 clearfix">
							<div class="column_left"><?php get_sidebar();?></div>
							<div class="column_right">
					<?php endif; ?>
							
						<div class="column_inner">
						<?php woocommerce_content(); ?>	
						</div>			
							</div>
							
						</div>
				<?php endif; ?>
			<?php } else {
				woocommerce_content(); 
			}?>
	</div>
	<?php get_footer(); ?>			