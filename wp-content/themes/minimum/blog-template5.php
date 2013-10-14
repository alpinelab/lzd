<?php 
/*
Template Name: Blog Template 5
*/ 
?>
<?php get_header(); ?>
<?php 
global $wp_query;
global $woocommerce;
$id = $wp_query->get_queried_object_id();
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = get_post_meta($id, "qode_show-posts-per-page", true);
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
$sidebar = get_post_meta($id, "qode_show-sidebar", true); 
?>
			
	<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
	<div class="container">
		<div class="title">	
			<h1><span><?php echo get_the_title($id); ?></span> <?php if(get_post_meta($id, "qode_page-subtitle", true)) { ?>/ <?php echo get_post_meta($id, "qode_page-subtitle", true) ?><?php } ?></h1>
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
			<div class="posts_holder2 post_single post_list5">
				<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
					<article <?php post_class(); ?>>
						
						<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>
						<div class="image">
						
						<?php echo slider_blog(get_the_ID());?>	
						</div>
						<?php } else {?>
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							
									<?php	the_post_thumbnail('full'); ?>
							</a>
						</div>
						<?php } } ?>
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="date"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></div>

						<div class="text">
							<div class="text_inner">
								
								<?php the_content(); ?>
							
							</div>
						</div>
						<?php /*
						<div class="share_social_icons">
							<ul>
								<li><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/tweet.png" alt="" /> Tweet</a></li>
								<li><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/facebook_share.png" alt="" /> Like</a></li>
							</ul>
						</div> */ ?>

						<div class="info">
								
						<span class="left"><?php the_time('d M Y'); ?></span>
						<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a> / <a href="<?php the_permalink(); ?>" class="more" title="<?php the_title_attribute(); ?>"><?php _e('READ MORE', 'qode'); ?></a></span>
						</div>
					</article>
				<?php endwhile; ?>
				<?php if($qode_options['pagination'] != "0") : ?>
				<?php pagination($wp_query->max_num_pages, $wp_query->max_num_pages, $paged); ?>
				<?php endif; ?>
			<?php else: //If no posts are present ?>
				<div class="entry">                        
						<p><?php _e('No posts were found.', 'qode'); ?></p>    
				</div>
			<?php endif; ?>
		</div>
	
				
			</div>
<?php get_footer(); ?>