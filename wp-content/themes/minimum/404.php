<?php global $qode_options; ?>	

<?php get_header(); ?>
			<div class="container">
				<div class="title">
					<h1><span><?php if($qode_options['404_title'] != ""): echo $qode_options['404_title']; else: ?> 404 <?php endif;?></span> / <?php if($qode_options['404_subtitle'] != ""): echo $qode_options['404_subtitle']; else: ?> Something went wrong <?php endif; ?> </h1>
				</div>
			</div>
			<div class="container">
				<div class="page_not_found">
					<h2><?php if($qode_options['404_text'] != ""): echo $qode_options['404_text']; else: ?> Page not found <?php endif;?></h2>
					<hr/>
					<p><a href="<?php echo home_url(); ?>/"><?php if($qode_options['404_backlabel'] != ""): echo $qode_options['404_backlabel']; else: ?> Back to homepage <?php endif;?></a></p>
				</div>
			</div>
<?php get_footer(); ?>	