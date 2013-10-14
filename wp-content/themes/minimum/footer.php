<?php global $qode_options; ?>
<?php
$qode_animation="";
if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
$qode_menu="";
if (isset($_SESSION['qode_menu'])) $qode_menu = $_SESSION['qode_menu'];
$qode_footer="";
if (isset($_SESSION['qode_footer'])) $qode_footer = $_SESSION['qode_footer'];
$hide_footer_logo_image = "";
if (isset($qode_options['hide_footer_logo_image'])) 
	$hide_footer_logo_image = $qode_options['hide_footer_logo_image'];
?>
				
			
		</div>
	</div>
	<footer>
				<div class="footer_content">
				<?php 
					$the_sidebars = wp_get_sidebars_widgets();
					$the_footer_slider_number = count($the_sidebars['footer_slider']);
					$display_footer_widget = false;
					if ((!empty($qode_footer) && $qode_footer == "with_slider")) $display_footer_widget = true;
					elseif ($qode_options['footer_widget_area'] == "yes") $display_footer_widget = true;
					if($display_footer_widget): ?> 
						<div class="slider_small type1 <?php if($the_footer_slider_number < 4) { echo 'hide_arrows';} ?>" >
							<div class="slider_small_holder">
								<div class="slider_small_holder_inner">
									<ul class="slider" <?php //if($the_footer_slider_number > 3) { echo ' class="on"';} ?>>
										<?php dynamic_sidebar( 'footer_slider' ); ?>
									</ul>
								</div>
							</div>
							
						</div>
					<?php endif; ?>
					<div class="footer_bottom">
						<div class="left">
							<?php if($hide_footer_logo_image != "yes"): ?>
								<a href="<?php echo home_url(); ?>/"><img alt="Logo" src="<?php echo $qode_options['footer_logo_image']; ?>" /></a><br/>
							<?php endif; ?>
							<?php dynamic_sidebar( 'footer_left' ); ?>
						</div>
						<div class="right">
							<?php dynamic_sidebar( 'footer_right' ); ?>
						</div>
					</div>
				</div>
	</footer>
<?php
if($qode_options['show_toolbar'] == "yes"){
?>

<div id="panel" style="margin-left: -238px;">
        
    <div id="panel-admin">
        <h4>Basic theme options</h4>
        <select id="tootlbar_ajax">
					<option value="">Choose page transition</option>
          <option <?php if ($qode_animation == "no") { echo "selected='selected'"; } ?> value="no">No ajax, regular loading</option>
          <option <?php if ($qode_animation == "updown") { echo "selected='selected'"; } ?> value="updown">Page up/down</option>
					<option <?php if ($qode_animation == "fade") { echo "selected='selected'"; } ?> value="fade">Page fade in/fade out</option>
					<option <?php if ($qode_animation == "updown_fade") { echo "selected='selected'"; } ?> value="updown_fade">Page up/down (in) / fade (out)</option>
        </select>
        <select id="tootlbar_menu">
					<option value="">Choose menu dropdown type</option>
          <option  <?php if ($qode_menu == "move_down") { echo "selected='selected'"; } ?> value="move_down">Menu type - move down</option>
          <option  <?php if ($qode_menu == "drop_down") { echo "selected='selected'"; } ?> value="drop_down">Menu type - drop down</option>
        </select>
				<select id="tootlbar_pattern">
					<option value="">Choose pattern type</option>
          <option value="pattern1">Transparent 1</option>
          <option value="pattern2">Transparent 2</option>
					<option value="pattern3">Abstract and Shattered</option>
					<option value="pattern4">Art Wall</option>
					<option value="pattern5">Gradient Squares</option>
          <option value="pattern6">Retina Wood</option>
					<option value="pattern7">Retina Wood Grey</option>
        </select>
        <select id="tootlbar_footer">
					<option value="">Choose footer type</option>
          <option <?php if ($qode_footer == "without_slider") { echo "selected='selected'"; } ?> value="without_slider">Basic footer</option>
					<option <?php if ($qode_footer == "with_slider") { echo "selected='selected'"; } ?> value="with_slider">Footer with widget slider</option>
          
        </select>
				<p>Colors</p>
				<div class="width50">
					<div class="background_colorSelector colorSelector"><div style=""></div></div>
					<div class="backgroundColorSelector colorPanel"></div>
					<label>Background</label>
				</div>
				<div class="width50">
					<div class="first_ColorSelector colorSelector"><div style=""></div></div>
					<div class="firstColorSelector colorPanel"></div>
					<label>First</label>
				</div>
				<div class="width50">
					<div class="second_colorSelector colorSelector"><div style=""></div></div>
					<div class="secondColorSelector colorPanel"></div>
					<label>Second</label>
				</div>
				<div class="width50">
					<div class="third_colorSelector colorSelector"><div style=""></div></div>
					<div class="thirdColorSelector colorPanel"></div>
					<label>Third</label>
				</div>
				<span class="small">* Change size, color and style on ANY section, element and font with an easy-to-use backend!</span>
    </div>
    
    <a class="open" href="#"></a>

</div><!--PANEL-->
<?php
}
?>

	<script>
		var no_ajax_pages = [];
		var root = '<?php echo home_url(); ?>/';
		<?php if($qode_options['parallax_speed'] != ''){ ?>
		var parallax_speed = <?php echo $qode_options['parallax_speed']; ?>;
		<?php }else{ ?>
		var parallax_speed = 1;
		<?php } ?>
	</script>
	<script>
	<?php 
		$pages = get_pages(); 
		foreach ($pages as $page) {
			if(get_post_meta($page->ID, "qode_show-animation", true) == "no_animation") :
	?>
				no_ajax_pages.push('<?php echo get_permalink($page->ID) ?>');
	<?php
			endif;
		}
		if (isset($qode_options['internal_no_ajax_links'])) {
			foreach (explode(',', $qode_options['internal_no_ajax_links']) as $no_ajax_link) {
	?>
				no_ajax_pages.push('<?php echo trim($no_ajax_link); ?>');
	<?php
			}
		}
	?>
	</script>
	<?php wp_footer(); ?>
</body>
</html>