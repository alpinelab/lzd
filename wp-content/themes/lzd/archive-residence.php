<?php
$porftolio_single_template = get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true);
global $woocommerce;
$portfolios = get_post_meta(get_the_ID(), "qode_portfolios", true);
?>

<?php get_header(); ?>
<div class="container">
	<?php echo do_shortcode("[portfolio_list columns='2' number='10' category='' selected_projects='' filter='no' potfolio_type='residence']"); ?>
</div>
<?php get_footer(); ?>	