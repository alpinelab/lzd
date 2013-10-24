<?php
$porftolio_single_template = get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true);
global $woocommerce;
$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
				<div class="container">
					<div class="title">
						<h1 style="font-size:25px"><span>
							<?php
							if ($portfolios[0])
								echo $portfolios[0]['optionValue'];
							?>
						</span></h1>

							<?php
							if ($portfolios[1])
								echo $portfolios[1]['optionValue'];
							?>
						<div class="woocommerce_cart_items">
	 						<?php if($woocommerce->cart->cart_contents_count > 0 ){ ?>
								<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
									<img src="<?php bloginfo('template_url'); ?>/img/woocommerce_cart_image.png" /><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> , <?php echo $woocommerce->cart->get_cart_total(); ?>
								</a>
							<?php }else{ ?>
								<a class="cart-contents" href="" ></a>
							<?php } ?>
	 					</div>
	 					<div class="info" style="padding-bottom:20px;"><span>
						<?php } ?>
						<?php
						$revslider = get_post_meta($id, "qode_revolution-slider", true);
						if (!empty($revslider)){
						echo do_shortcode($revslider);
						}
						?>
					</span></div>
					</div>

				</div>

			<div class="container">
							<div class="portfolio_images">
						<?php
						$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio_images", true);
						if ($portfolio_images){
							usort($portfolio_images, "comparePortfolioImages");
							foreach($portfolio_images as $portfolio_image){
							?>

								<?php if($portfolio_image['portfolioimg'] != ""){ ?>
									<img src="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" alt="" />
								<?php }else{ ?>

									<?php
									$portfoliovideotype = "";
									if (isset($portfolio_image['portfoliovideotype'])) $portfoliovideotype = $portfolio_image['portfoliovideotype'];
									switch ($portfoliovideotype){
										case "youtube": ?>

												<iframe width="100%" src="http://www.youtube.com/embed/<?php echo $portfolio_image['portfoliovideoid'];  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>

										<?php	break;
										case "vimeo": ?>

												<iframe src="http://player.vimeo.com/video/<?php echo $portfolio_image['portfoliovideoid'];  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>


									<?php break;
									} ?>

								<?php } ?>

							<?php
							}
						}
						?>
						</div>
						<div class="two_columns_33_66 clearfix portfolio_container">
					<div class="column_center" style="text-align:justify">
						<div class="column_inner">
							<div class="portfolio_detail portfolio_single_follow">
								<?php
								$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
								if ($portfolios){
									usort($portfolios, "comparePortfolioOptions");
									foreach($portfolios as $portfolio){
									?>
										<div class="info">
										<?php if($portfolio['optionLabel'] != ""): ?>
										<h6 class="label"><?php echo stripslashes($portfolio['optionLabel']); ?>:</h6>
										<?php endif; ?>
										<span>
											<?php
											if($portfolio['optionlabelordernumber'] > 2)
												echo do_shortcode(stripslashes($portfolio['optionValue']));
											?>
										</span>
										</div>
									<?php
									}
								}
								?>
							</div>
						</div>
					</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', __('Previous','qode')); ?></div>
							<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"><?php echo _e('Portfolio','qode'); ?></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link', __('Next','qode')); ?></div>
						</div>
		<?php endwhile; ?>
	<?php endif; ?>

	</div>
<?php get_footer(); ?>