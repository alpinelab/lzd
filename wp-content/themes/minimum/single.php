<?php $sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);  ?>
<?php
global $woocommerce;
$blog_hide_comments = "";
if (isset($qode_options['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options['blog_hide_comments'];
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
					<div class="container">
						<div class="title">
							<h1><span><?php the_title(); ?></span> <?php if(get_post_meta(get_the_ID(), "qode_page-subtitle", true)) { ?>/ <?php echo get_post_meta(get_the_ID(), "qode_page-subtitle", true) ?><?php } ?></h1>
						
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
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
					<div class="posts_holder2 post_single">	
						<article>								
							<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>	
								<div class="image">
									<?php echo slider_blog(get_the_ID());?>	
								</div>
							<?php } else {
								if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
									if ( has_post_thumbnail()) { ?>
										<div class="image">		
										<?php the_post_thumbnail('full'); ?>
										</div>
								<?php }
								}
								?>
							
							<?php	} ?>
							
							<h2><?php the_title(); ?></h2>
							<div class="date"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></div>
							<div class="text">
								<div class="text_inner">
									<?php the_content(''); ?>
									<?php wp_link_pages(); ?>
								</div>
							</div>
							<div class="info">
								<span class="left"><?php the_time('d M Y'); ?></span>
								<?php if($blog_hide_comments != "yes"){ ?>
								<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
								<?php } ?>
							</div>
						</article>
					</div>
					<?php if( has_tag()) { ?>
					<div class="tags">
						<p><?php the_tags(); ?></p>
					</div>
					<?php } ?>
					
					<?php
						if($blog_hide_comments != "yes"){
							comments_template('', true); 
						}else{
							echo "<br/><br/>";
						}
					?> 
					
				<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
					<?php if($sidebar == "1") : ?>	
						<div class="two_columns_66_33 clearfix">
						<div class="column_left">
					<?php elseif($sidebar == "2") : ?>	
						<div class="two_columns_75_25 clearfix">
							<div class="column_left">
					<?php endif; ?>
				
							<div class="column_inner">
								<div class="posts_holder2 post_single">
								
									<article>									
										
										
											
										<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>	
											<div class="image">
												<?php echo slider_blog(get_the_ID());?>	
											</div>
										<?php } else {
											if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
											 if ( has_post_thumbnail()) { ?>
												<div class="image">		
												<?php the_post_thumbnail('full'); ?>
												</div>
											<?php }
											}
											?>
										
										<?php } ?>
										
										<h2><?php the_title(); ?></h2>
										<div class="date"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></div>
										<div class="text">
											<div class="text_inner">
												<?php the_content(''); ?>
												<?php wp_link_pages(); ?>
											</div>
										</div>
										<div class="info">
											<span class="left"><?php the_time('d M Y'); ?></span>
											<?php if($blog_hide_comments != "yes"){ ?>
											<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
											<?php } ?>
										</div>
									</article>
									</div>
									<?php if( has_tag()) { ?>
									<div class="tags">
										<p><?php the_tags(); ?></p>
									</div>
									<?php } ?>
									<?php 
									if($blog_hide_comments != "yes"){
										comments_template('', true); 
									}else{
										echo "<br/><br/>";
									}
									?> 
								</div>
							</div>	
							<div class="column_right"> 
								<?php get_sidebar(); ?>
							</div>
						</div>
					<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
						<?php if($sidebar == "3") : ?>	
							<div class="two_columns_33_66 clearfix">
							<div class="column_left"> 
								<?php get_sidebar(); ?>
							</div>
							<div class="column_right">
						<?php elseif($sidebar == "4") : ?>	
							<div class="two_columns_25_75 clearfix">
								<div class="column_left"> 
									<?php get_sidebar(); ?>
								</div>
								<div class="column_right">
						<?php endif; ?>
						
								<div class="column_inner">
									<div class="posts_holder2 post_single">
									
										<article>									
											
											
												
											<?php if(get_post_meta(get_the_ID(), "qode_use-slider-instead-of-image", true) == "yes") { ?>	
												<div class="image">
													<?php echo slider_blog(get_the_ID());?>	
												</div>
											<?php } else {
												if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
												 if ( has_post_thumbnail()) { ?>
													<div class="image">		
													<?php	the_post_thumbnail('full'); ?>
													</div>
												<?php }
												}
												?>
											
											<?php	} ?>
											
											<h2><?php the_title(); ?></h2>
											<div class="date"><?php _e('Posted by','qode'); ?> <?php the_author(); ?> <?php _e('in','qode'); ?> <?php the_category(', '); ?></div>
											<div class="text">
												<div class="text_inner">
													<?php the_content(''); ?>
													<?php wp_link_pages(); ?>
												</div>
											</div>
											<div class="info">
												<span class="left"><?php the_time('d M Y'); ?></span>
												<?php if($blog_hide_comments != "yes"){ ?>
												<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number( __('no comments','qode'), '1 '.__('comment','qode'), '% '.__('comments','qode') ); ?></a></span>
												<?php } ?>
											</div>
										</article>
										</div>
										<?php if( has_tag()) { ?>
										<div class="tags">
											<p><?php the_tags(); ?></p>
										</div>
										<?php } ?>
										<?php 
										if($blog_hide_comments != "yes"){
											comments_template('', true); 
										}else{
											echo "<br/><br/>";
										}
										?> 
									</div>
								</div>	
								
							</div>
					<?php endif; ?>
								
<?php endwhile; ?>
<?php endif; ?>	

	</div>
<?php get_footer(); ?>	