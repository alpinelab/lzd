<?php
$porftolio_single_template = get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true);
global $woocommerce;
$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

			<div class="container">
				<div class="portfolio_navigation">
					<div class="portfolio_prev"><?php previous_post_link('%link', 'Précédent'); ?></div>
					<?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != ""){ ?>
						<div class="portfolio_list"><a href="<?php echo get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true)); ?>"><?php echo _e('Portfolio','qode'); ?></a></div>
					<?php } ?>
					<div class="portfolio_next"><?php next_post_link('%link', 'Suivant'); ?></div>
				</div>
			</div>

			<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
				<div class="container">
					<div class="title">
						<h1><span>
							<?php
							if ($portfolios[0])
								echo $portfolios[0]['optionValue'];
							?>
						</span></h1>
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
						<div class="editor_content"><? the_content() ?></div>
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
							<div class="portfolio_detail portfolio_single_follow"> <?
								// $portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
								if ($portfolios) {
									usort($portfolios, "comparePortfolioOptions");
									foreach ($portfolios as $portfolio) {
										if ($portfolio['optionlabelordernumber'] == 2) { ?>
											<div class="chapeau"><?= do_shortcode(stripslashes($portfolio['optionValue'])) ?></div> <?
										} else if ($portfolio['optionlabelordernumber'] > 2) {
											if($portfolio['optionLabel'] != "" && $portfolio['optionValue'] != "") { ?>
												<div class="info">
													<h6 class="label"><?= stripslashes($portfolio['optionLabel']); ?></h6>
													<span><?= do_shortcode(stripslashes($portfolio['optionValue'])) ?></span>
												</div> <?
											}
										}
									}
								} ?>
							</div>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
	<?php endif; ?>

	</div>
<?php get_footer(); ?>