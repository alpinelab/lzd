<?php
include_once('google-fonts.php');

if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
global $qode_options;
$qode_options  = get_option('qode_options');

class Qode_Theme_Options {

	//constructor of class, PHP4 compatible construction for backward compatibility
	function qode_Theme_Options() {
		add_action('admin_menu', array(&$this, 'qode_admin_menu'));
		add_action('admin_init', array(&$this, 'register_qode_theme_settings'));
	}


	function init_qode_theme_options() {
		global $qode_options;
		if(isset($qode_options['reset_to_defaults'])){ 
			if( $qode_options['reset_to_defaults'] == 'yes' ) delete_option( "qode_options");
		}
		if (! get_option("qode_options")) {
			add_option( "qode_options",
				array( // intitialize the 'qode_options' array with the following key => value pairs:
					"reset_to_defaults" => '',
					"number_of_chars" => 45,
					"first_color" => '',
					"second_color" => '',
					"third_color" => '',
					"background_color" => '',
					"highlight_color" => '',
					"selection_color" => '',
					"favicon_image" => QODE_ROOT."/img/favicon.ico",
					"patern_background_image" => '',
					"backstreach_background_image" => '',
					"google_fonts" => '-1',
					"page_transitions" => '3',
					"responsiveness" => 'yes',
					"parallax_speed" => '1',
					"parallax_minheight" => '300',
					"internal_no_ajax_links" => '',
					"custom_css" => '',
					"custom_js" => '',
					"meta_keywords" => '',
					"meta_description" => '',
					"disable_qode_seo" => 'no',
					"show_toolbar" => 'no',
					"h1_color" => '',
					"h1_google_fonts" => '-1',
					"h1_fontsize" => '',
					"h1_lineheight" => '',
					"h1_fontstyle" => '',
					"h1_fontweight" => '',
					"h2_color" => '',
					"h2_google_fonts" => '-1',
					"h2_fontsize" => '',
					"h2_lineheight" => '',
					"h2_fontstyle" => '',
					"h2_fontweight" => '',
					"h3_color" => '',
					"h3_google_fonts" => '-1',
					"h3_fontsize" => '',
					"h3_lineheight" => '',
					"h3_fontstyle" => '',
					"h3_fontweight" => '',
					"h4_color" => '',
					"h4_google_fonts" => '-1',
					"h4_fontsize" => '',
					"h4_lineheight" => '',
					"h4_fontstyle" => '',
					"h4_fontweight" => '',
					"h5_color" => '',
					"h5_google_fonts" => '-1',
					"h5_fontsize" => '',
					"h5_lineheight" => '',
					"h5_fontstyle" => '',
					"h5_fontweight" => '',
					"h6_color" => '',
					"h6_google_fonts" => '-1',
					"h6_fontsize" => '',
					"h6_lineheight" => '',
					"h6_fontstyle" => '',
					"h6_fontweight" => '',
					"text_color" => '',
					"text_google_fonts" => '-1',
					"text_fontsize" => '',
					"text_lineheight" => '',
					"text_fontstyle" => '',
					"text_fontweight" => '',
					"text_margin" => '',
					"link_color" => '',
					"link_hovercolor" => '',
					"link_fontstyle" => '',
					"link_fontweight" => '',
					"link_fontdecoration" => '',
					"page_title_position" => '',
					"page_title_color" => '',
					"page_title_google_fonts" => '-1',
					"page_title_fontsize" => '',
					"page_title_lineheight" => '',
					"page_title_fontstyle" => '',
					"page_title_fontweight" => '',
					"main_menu_position" => '',
					"magic_panes_height" => '',
					"magic_pane_hover_color" => '',
					"magic_pane_active_color" => '',
					"menu_color" => '',
					"menu_hovercolor" => '',
					"menu_google_fonts" => '-1',
					"menu_fontsize" => '',
					"menu_lineheight" => '',
					"menu_fontstyle" => '',
					"menu_fontweight" => '',
					"logo_image" => QODE_ROOT."/img/minimum-logo.png",
					"center_logo_image" => 'no',
					"logo_top" => '',
					"logo_left" => '',
					"header_height" => '',
					"top_menu" => 'drop_down',
					"dropdown_color" => '',
					"dropdown_hovercolor" => '',
					"dropdown_google_fonts" => '-1',
					"dropdown_fontsize" => '',
					"dropdown_lineheight" => '',
					"dropdown_fontstyle" => '',
					"dropdown_fontweight" => '',
					"dropdown_color_thirdlvl" => '',
					"dropdown_hovercolor_thirdlvl" => '',
					"dropdown_google_fonts_thirdlvl" => '-1',
					"dropdown_fontsize_thirdlvl" => '',
					"dropdown_lineheight_thirdlvl" => '',
					"dropdown_fontstyle_thirdlvl" => '',
					"dropdown_fontweight_thirdlvl" => '',
					"separation_number" => '',
					"header_separator_thickness" => '',
					"footer_separator_thickness" => '',
					"footer_logo_image" => QODE_ROOT."/img/minimum-logo.png",
					"center_footer_logo_image" => 'no',
					"hide_footer_logo_image" => 'no',
					"footer_widget_area" => 'no',
					"slider_transition_auto" => '',
					"slider_transition_effect" => '',
					"slider_transition_speed" => '',
					"slider_transition_timeout" => '',
					"slider_title_color" => '',
					"slider_title_google_fonts" => '-1',
					"slider_title_fontsize" => '',
					"slider_title_lineheight" => '',
					"slider_title_fontstyle" => '',
					"slider_title_fontweight" => '',
					"slider_text_color" => '',
					"slider_text_google_fonts" => '-1',
					"slider_text_fontsize" => '',
					"slider_text_lineheight" => '',
					"slider_text_fontstyle" => '',
					"slider_text_fontweight" => '',
					"slider_title_color_type2" => '',
					"slider_title_google_fonts_type2" => '',
					"slider_title_fontsize_type2" => '',
					"slider_title_lineheight_type2" => '',
					"slider_title_fontstyle_type2" => '',
					"slider_title_fontweight_type2" => '',
					"smallslider_move_slides" => '',
					"smallslider_transition_speed" => '',
					"smallslider_title_color" => '',
					"smallslider_title_google_fonts" => '-1',
					"smallslider_title_fontsize" => '',
					"smallslider_title_lineheight" => '',
					"smallslider_title_fontstyle" => '',
					"smallslider_title_fontweight" => '',
					"smallslider_text_color" => '',
					"smallslider_text_google_fonts" => '-1',
					"smallslider_text_google_fonts" => '-1',
					"smallslider_text_fontsize" => '',
					"smallslider_text_lineheight" => '',
					"smallslider_text_fontstyle" => '',
					"smallslider_text_fontweight" => '',
					"smallslider_move_slides_type2" => '',
					"smallslider_transition_speed_type2" => '',
					"smallslider_title_color_type2" => '',
					"smallslider_title_google_fonts_type2" => '',
					"smallslider_title_fontsize_type2" => '',
					"smallslider_title_lineheight_type2" => '',
					"smallslider_title_fontstyle_type2" => '',
					"smallslider_title_fontweight_type2" => '',
					"smallslider_text_color_type2" => '',
					"smallslider_text_google_fonts_type2" => '',
					"smallslider_text_fontsize_type2" => '',
					"smallslider_text_lineheight_type2" => '',
					"smallslider_text_fontstyle_type2" => '',
					"smallslider_text_fontweight_type2" => '',
					"separator_thickness" => '',
					"separator_topmargin" => '',
					"separator_bottommargin" => '',
					"separator_small_thickness" => '',
					"separator_small_topmargin" => '',
					"separator_small_bottommargin" => '',
					"button_title_color" => '',
					"button_title_hovercolor" => '',
					"button_title_google_fonts" => '-1',
					"button_title_fontsize" => '',
					"button_title_lineheight" => '',
					"button_title_fontstyle" => '',
					"button_title_fontweight" => '',
					"button_size" => '',
					"button_backgroundcolor" => '',
					"button_backgroundhovercolor" => '',
					"message_title_color" => '',
					"message_title_google_fonts" => '-1',
					"message_title_fontsize" => '',
					"message_title_lineheight" => '',
					"message_title_fontstyle" => '',
					"message_title_fontweight" => '',
					"message_border" => '',
					"message_size" => '',
					"message_backgroundcolor" => '',
					"portfolio_style" => '1',
					"portfolio_list_title_color" => '',
					"portfolio_list_title_google_fonts" => '-1',
					"portfolio_list_title_fontsize" => '',
					"portfolio_list_title_lineheight" => '',
					"portfolio_list_title_fontstyle" => '',
					"portfolio_list_title_fontweight" => '',
					"portfolio_list_text_color" => '',
					"portfolio_list_text_google_fonts" => '-1',
					"portfolio_list_text_fontsize" => '',
					"portfolio_list_text_lineheight" => '',
					"portfolio_list_text_fontstyle" => '',
					"portfolio_list_text_fontweight" => '',
					"pagination" => '2',
					"blog_style" => '1',
					"category_blog_sidebar" => 'default',
					"blog_hide_comments" => 'no',
					"number_of_chars" => '45',
					"receive_mail" => '',
					"enable_contact_form" => 'no',
					"hide_contact_form_website" => 'no',
					"email_from" => '',
					"email_subject" => '',
					"use_recaptcha" => 'no',
					"recaptcha_public_key" => '',
					"recaptcha_private_key" => '',
					"contact_heading_above" => '',
					"enable_google_map" => 'no',
					"google_maps_iframe" => '',
					"404_title" => '',
					"404_subtitle" => '',
					"404_text" => '',
					"404_backlabel" => ''
				)
			);
		} 
	}

	function register_qode_theme_settings() {
	    register_setting( 'qode_options_page', 'qode_options', array(&$this, 'validate_options') );
	    // register_setting( 'qode_options_page', array(&$this, 'another_of_my_options') );
	}
	//extend the admin menu
	function qode_admin_menu() {
		$this->init_qode_theme_options();
		//Add the Qode options page to the Themes' menu
		$this->pagehook = add_menu_page('Qode Theme', esc_html__('Qode', 'qode'), 'manage_options', 'qode_options_page', array(&$this, 'qode_generate_options_page'));
		add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
	}

	function on_load_page() {
		
		// load javascripts to allow drag/drop, expand/collapse and hide/show of boxes
		add_meta_box('qode-general-options-metabox', esc_html__('Options', 'qode'), array(&$this, 'general_options_contentbox'), $this->pagehook, 'normal', 'core');
	
	}

	function qode_generate_options_page() {

		// global screen column value to be able to have a sidebar in WordPress 2.8+
		global $screen_layout_columns, $qode_options;

		/* Messages to display saved and reset */
		if ( isset($_REQUEST['settings-updated']) || isset($_REQUEST['updated'] )) {
                    echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings saved.', 'qode').'</strong></p></div>';
               
                }
                
		//if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings reset.', 'qode').'</strong></p></div>'; ?>
		<div id="qode-metaboxes-general" class="wrap">
		    <div style="float:left; padding:10px 10px 10px 0;"></div>
		    <h2 style="padding-top:25px;"><?php printf( __('version %1$s', 'qode'), '2.2.1' ); ?></h2>

		    <form method="post" action="options.php">
<?php			settings_fields( 'qode_options_page' ); // Checks that the user can update options and also redirect the user back to the correct admin page (this form).
			$options = get_option('qode_options');
			// Allows the 'closed' state of metaboxes to be remembered
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
			// Allows the order of metaboxes to be remembered
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>

			<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
				<div id="post-body" class="has-sidebar">
					<div id="post-body-content" class="has-sidebar-content">
<?php					    do_meta_boxes($this->pagehook, 'normal', $options); ?>
<?php					    do_meta_boxes($this->pagehook, 'additional', $options); ?>
					    <fieldset style="margin:2px 0 0;"><legend class="screen-reader-text"><span><?php esc_attr_e('Reset to defaults', 'qode') ?></span></legend>
						<label for="reset_to_defaults">
						    <input name="qode_options[reset_to_defaults]" type="checkbox" id="reset_to_defaults" value="yes" />
						    <?php esc_attr_e('Reset to defaults', 'qode') ?>
						</label>
					    </fieldset>
					    <p class="submit">
						<input type="hidden" id="qode_submit" value="1" name="qode_submit" />
						<input class="button-primary" type="submit" name="submit" value="<?php esc_attr_e('Save Changes', 'qode') ?>" />
					    </p>
					</div>
				</div>
				<br class="clear"/>
			</div>
		    </form>
<?php		    /* The reset button */; ?>
<!--		    <form method="post">
			<p class="submit">
			    <input name="reset" type="submit" value="Reset" />
			    <input type="hidden" name="action" value="reset" />
			</p>
		    </form> -->
		</div>
		<script type="text/javascript">
		    //<![CDATA[
		    jQuery(document).ready( function($) {
			    // close postboxes that should be closed
			    $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			    // postboxes setup
			    postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
		    });
		    //]]>
		</script>
<?php	}

	/**
	 * Validate user input
	 *
	 * @param array $input, an array of user input
	 * @return array Return an input array of sanitized input
	 */
	function validate_options( $input ) {
	global $qode_options;
		$input['number_of_chars'] = is_numeric( $input['number_of_chars'] ) ? absint($input['number_of_chars']) : $qode_options['number_of_chars'];
		return $input;
	}
      


	/**************************************************************************************/
	/**** Below you will find the callback method for each of the registered metaboxes ****/
	/**************************************************************************************/

	function general_options_contentbox( $options ) {
		global $fontArrays;
	?>
		
		<div class="sections">
			<h3>Global options</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('First main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['first_color']){ echo 'background-color:'.esc_attr($options['first_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options[first_color]" type="text" value="<?php if ($options['first_color']) { echo esc_attr($options['first_color'], 'qode'); } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose first main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Second main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['second_color']){ echo 'background-color:'.esc_attr($options['second_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options[second_color]" type="text" value="<?php if ($options['second_color']) { echo esc_attr($options['second_color'], 'qode'); } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose second main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Third main color', 'qode'); ?></td>
							<td>
								<div class="colorSelector"><div style="<?php if ($options['third_color']){ echo 'background-color:'.esc_attr($options['third_color'], 'qode').';'; } ?>"></div></div>
								<input name="qode_options[third_color]" type="text" value="<?php if ($options['third_color']) { echo esc_attr($options['third_color'], 'qode'); } ?>" size="30" maxlength="500" />
								<?php esc_html_e('Choose third main color', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Background color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['background_color']){ echo 'background-color:'.esc_attr($options['background_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[background_color]" type="text" value="<?php if ($options['background_color']) { echo esc_attr($options['background_color'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose background color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Highlight color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['highlight_color']){ echo 'background-color:'.esc_attr($options['highlight_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[highlight_color]" type="text"  value="<?php if ($options['highlight_color']) { echo esc_attr($options['highlight_color'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose highlight color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Selection color', 'qode'); ?></td>
								<td>
									<div class="colorSelector"><div style="<?php if ($options['selection_color']){ echo 'background-color:'.esc_attr($options['selection_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[selection_color]" type="text"  value="<?php if ($options['selection_color']) { echo esc_attr($options['selection_color'], 'qode'); } ?>" size="30" maxlength="500" />
									<?php esc_html_e('Choose selection color', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Pattern background image', 'qode'); ?></td>
							<td>	
								<div class="inline" style="width: 600px;">
								<input type="text" id="pattern_background_image" name="qode_options[pattern_background_image]" class="pattern_background_image" value="<?php if (isset($options['pattern_background_image'])) { echo esc_attr($options['pattern_background_image'], 'qode'); } ?>" size="70">
								<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Favicon image', 'qode'); ?></td>
							<td>	
								<div class="inline" style="width: 600px;">
								<input type="text" id="favicon_image" name="qode_options[favicon_image]" class="favicon_image" value="<?php if ($options['favicon_image']) { echo esc_attr($options['favicon_image'], 'qode'); } else { echo QODE_ROOT."/img/favicon.ico"; } ?>" size="70">
								<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Google fonts', 'qode'); ?></td>
								<td>
							<select name="qode_options[google_fonts]">
							<option value="-1">Default</option>
							<?php foreach($fontArrays as $fontArray) { ?> 
								<option <?php if ($options['google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
							<?php } ?>
								
							</select>
							<?php esc_html_e('Choose Font', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Page transition', 'qode'); ?></td>
								<td>
							<select name="qode_options[page_transitions]">
								<option <?php if ($options['page_transitions'] == 0) { echo "selected='selected'"; } ?> value="0">No animation</option>
								<option <?php if ($options['page_transitions'] == 1) { echo "selected='selected'"; } ?> value="1">Up/Down</option>
								<option <?php if ($options['page_transitions'] == 2) { echo "selected='selected'"; } ?> value="2">Fade</option>
								<option <?php if ($options['page_transitions'] == 3) { echo "selected='selected'"; } ?> value="3">Up/Down (In) / Fade (Out)</option>
							</select>
							<?php esc_html_e('In order for animation to work properly, you must choose "Post name" in permalinks settings', 'qode'); ?>
								</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Responsiveness', 'qode'); ?></td>
							<td>
								<select name="qode_options[responsiveness]">
									<option <?php if(isset($options['responsiveness'])){ $responsiveness = $options['responsiveness']; if ($responsiveness == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
									<option <?php if(isset($options['responsiveness'])){ $responsiveness = $options['responsiveness']; if ($responsiveness == 'no') { echo "selected='selected'"; } }  ?> value="no">No</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Google Analytics Account ID', 'qode'); ?></td>
							<td>
								<input name="qode_options[google_analytics_code]" type="text" value="<?php if (isset($options['google_analytics_code'])) { echo esc_attr($options['google_analytics_code'], 'qode'); } ?>" size="63" maxlength="500" />
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('List of internal URLs loaded without AJAX (separated with comma)', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="internal_no_ajax_links" name="qode_options[internal_no_ajax_links]" cols="60" rows="5"><?php if (isset($options['internal_no_ajax_links'])) { echo esc_attr($options['internal_no_ajax_links'], 'qode'); } ?></textarea>
								</div>
								
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Custom css', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="custom_css" name="qode_options[custom_css]" cols="60" rows="5"><?php if ($options['custom_css']) { echo esc_attr($options['custom_css'], 'qode'); } ?></textarea>
								</div>
								
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Custom js', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="custom_js" name="qode_options[custom_js]" cols="60" rows="5"><?php if ($options['custom_js']) { echo esc_attr($options['custom_js'], 'qode'); } ?></textarea>
								</div><br/>
								<?php esc_html_e('jQuery selector is "$j" because of the conflict mode', 'qode'); ?>
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Meta Keywords', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="meta_keywords" name="qode_options[meta_keywords]" cols="60" rows="5"><?php if ($options['meta_keywords']) { echo esc_attr($options['meta_keywords'], 'qode'); } ?></textarea>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td valign="top"><?php esc_html_e('Meta Description', 'qode'); ?></td>
							<td>
								<div class="inline">
									<textarea id="meta_description" name="qode_options[meta_description]" cols="60" rows="5"><?php if ($options['meta_description']) { echo esc_attr($options['meta_description'], 'qode'); } ?></textarea>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Disable Qode SEO', 'qode'); ?></td>
							<td>
								<select name="qode_options[disable_qode_seo]">
									<option <?php if(isset($options['disable_qode_seo'])){ $disable_qode_seo = $options['disable_qode_seo']; if ($disable_qode_seo == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['disable_qode_seo'])){ $disable_qode_seo = $options['disable_qode_seo']; if ($disable_qode_seo == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Demo Toolbar', 'qode'); ?></td>
							<td>
								<select name="qode_options[show_toolbar]">
									<option <?php if ($options['show_toolbar'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['show_toolbar'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>General font options</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Headings</h2></td></tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H1 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h1_color']){ echo 'background-color:'.esc_attr($options['h1_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[h1_color]" type="text" value="<?php if ($options['h1_color']) { echo esc_attr($options['h1_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[h1_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h1_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[h1_fontsize]" type="text" value="<?php if ($options['h1_fontsize']) { echo esc_attr($options['h1_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[h1_lineheight]" type="text" value="<?php if ($options['h1_lineheight']) { echo esc_attr($options['h1_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[h1_fontstyle]">
											<option <?php if ($options['h1_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h1_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h1_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[h1_fontweight]">
											<option <?php if ($options['h1_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h1_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h1_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h1_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h1_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h1_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h1_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h1_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h1_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H2 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h2_color']){ echo 'background-color:'.esc_attr($options['h2_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[h2_color]" type="text" value="<?php if ($options['h2_color']) { echo esc_attr($options['h2_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[h2_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h2_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[h2_fontsize]" type="text" value="<?php if ($options['h2_fontsize']) { echo esc_attr($options['h2_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[h2_lineheight]" type="text" value="<?php if ($options['h2_lineheight']) { echo esc_attr($options['h2_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[h2_fontstyle]">
											<option <?php if ($options['h2_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h2_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h2_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[h2_fontweight]">
											<option <?php if ($options['h2_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h2_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h2_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h2_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h2_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h2_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h2_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h2_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h2_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H3 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h3_color']){ echo 'background-color:'.esc_attr($options['h3_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[h3_color]" type="text" value="<?php if ($options['h3_color']) { echo esc_attr($options['h3_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[h3_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h3_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[h3_fontsize]" type="text" value="<?php if ($options['h3_fontsize']) { echo esc_attr($options['h3_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[h3_lineheight]" type="text" value="<?php if ($options['h3_lineheight']) { echo esc_attr($options['h3_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[h3_fontstyle]">
											<option <?php if ($options['h3_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h3_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h3_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[h3_fontweight]">
											<option <?php if ($options['h3_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h3_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h3_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h3_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h3_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h3_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h3_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h3_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h3_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H4 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h4_color']){ echo 'background-color:'.esc_attr($options['h4_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[h4_color]" type="text" value="<?php if ($options['h4_color']) { echo esc_attr($options['h4_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[h4_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h4_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[h4_fontsize]" type="text" value="<?php if ($options['h4_fontsize']) { echo esc_attr($options['h4_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[h4_lineheight]" type="text" value="<?php if ($options['h4_lineheight']) { echo esc_attr($options['h4_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[h4_fontstyle]">
											<option <?php if ($options['h4_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h4_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h4_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[h4_fontweight]">
											<option <?php if ($options['h4_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h4_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h4_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h4_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h4_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h4_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h4_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h4_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h4_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H5 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h5_color']){ echo 'background-color:'.esc_attr($options['h5_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[h5_color]" type="text" value="<?php if ($options['h5_color']) { echo esc_attr($options['h5_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[h5_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h5_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[h5_fontsize]" type="text" value="<?php if ($options['h5_fontsize']) { echo esc_attr($options['h5_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[h5_lineheight]" type="text" value="<?php if ($options['h5_lineheight']) { echo esc_attr($options['h5_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[h5_fontstyle]">
											<option <?php if ($options['h5_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h5_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h5_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[h5_fontweight]">
											<option <?php if ($options['h5_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h5_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h5_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h5_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h5_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h5_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h5_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h5_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h5_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('H6 style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['h6_color']){ echo 'background-color:'.esc_attr($options['h6_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[h6_color]" type="text" value="<?php if ($options['h6_color']) { echo esc_attr($options['h6_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[h6_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['h6_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[h6_fontsize]" type="text" value="<?php if ($options['h6_fontsize']) { echo esc_attr($options['h6_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[h6_lineheight]" type="text" value="<?php if ($options['h6_lineheight']) { echo esc_attr($options['h6_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[h6_fontstyle]">
											<option <?php if ($options['h6_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h6_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['h6_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[h6_fontweight]">
											<option <?php if ($options['h6_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['h6_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['h6_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['h6_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['h6_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['h6_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['h6_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['h6_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['h6_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr><td colspan='2'><h2>Text</h2></td></tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['text_color']){ echo 'background-color:'.esc_attr($options['text_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[text_color]" type="text" value="<?php if ($options['text_color']) { echo esc_attr($options['text_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font family', 'qode'); ?>
										<select name="qode_options[text_google_fonts]">
											<option value="-1">Default</option>
											<?php foreach($fontArrays as $fontArray) { ?> 
												<option <?php if ($options['text_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[text_fontsize]" type="text" value="<?php if ($options['text_fontsize']) { echo esc_attr($options['text_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[text_lineheight]" type="text" value="<?php if ($options['text_lineheight']) { echo esc_attr($options['text_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[text_fontstyle]">
											<option <?php if ($options['text_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['text_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['text_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[text_fontweight]">
											<option <?php if ($options['text_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['text_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['text_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['text_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['text_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['text_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['text_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['text_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['text_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Top/Bottom margin (px)', 'qode'); ?>
										<input name="qode_options[text_margin]" type="text" value="<?php if (isset($options['text_margin'])) { echo esc_attr($options['text_margin'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
								</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Link style', 'qode'); ?></td>
								<td>
									<div class="inline">
										<?php esc_html_e('Color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['link_color']){ echo 'background-color:'.esc_attr($options['link_color'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[link_color]" type="text" value="<?php if ($options['link_color']) { echo esc_attr($options['link_color'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Hover color', 'qode'); ?>
										<div class="colorSelector"><div style="<?php if ($options['link_hovercolor']){ echo 'background-color:'.esc_attr($options['link_hovercolor'], 'qode').';'; } ?>"></div></div>
										<input name="qode_options[link_hovercolor]" type="text" value="<?php if ($options['link_hovercolor']) { echo esc_attr($options['link_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[link_fontstyle]">
											<option <?php if ($options['link_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['link_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['link_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[link_fontweight]">
											<option <?php if ($options['link_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['link_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['link_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['link_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['link_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['link_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['link_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['link_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['link_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font decoration', 'qode'); ?>
										<select name="qode_options[link_fontdecoration]">
											<option <?php if ($options['link_fontdecoration'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['link_fontdecoration'] == "none") { echo "selected='selected'"; } ?> value="none">none</option>
											<option <?php if ($options['link_fontdecoration'] == "bold") { echo "selected='selected'"; } ?> value="underline">underline</option>
											
										</select>
									</div>
								</td>
						</tr>
						<tr><td colspan='2'><h2>Page title</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Page title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Position', 'qode'); ?>
									<select name="qode_options[page_title_position]">
										<option <?php if ($options['page_title_position'] == 0) { echo "selected='selected'"; } ?> value="0"></option>
										<option <?php if ($options['page_title_position'] == 1) { echo "selected='selected'"; } ?> value="1">Left</option>
										<option <?php if ($options['page_title_position'] == 2) { echo "selected='selected'"; } ?> value="2">Center</option>
										<option <?php if ($options['page_title_position'] == 3) { echo "selected='selected'"; } ?> value="3">Right</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['page_title_color']){ echo 'background-color:'.esc_attr($options['page_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[page_title_color]" type="text" value="<?php if ($options['page_title_color']) { echo esc_attr($options['page_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[page_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['page_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[page_title_fontsize]" type="text" value="<?php if ($options['page_title_fontsize']) { echo esc_attr($options['page_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[page_title_lineheight]" type="text" value="<?php if ($options['page_title_lineheight']) { echo esc_attr($options['page_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[page_title_fontstyle]">
										<option <?php if ($options['page_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['page_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['page_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[page_title_fontweight]">
										<option <?php if ($options['page_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['page_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['page_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['page_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['page_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['page_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['page_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['page_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['page_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Header and Footer</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Header</h2></td></tr>
						<tr>
							<td valign="top" width="150"><?php esc_html_e('Logo', 'qode'); ?></td>
							<td>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Logo image', 'qode'); ?>
									<input type="text" id="logo_image" name="qode_options[logo_image]" class="logo_image" value="<?php if ($options['logo_image']) { echo esc_attr($options['logo_image'], 'qode'); } else { echo QODE_ROOT."/img/minimum-logo.png"; } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Top (px)', 'qode'); ?>
									<input name="qode_options[logo_top]" type="text" value="<?php if ($options['logo_top']) { echo esc_attr($options['logo_top'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Left (px)', 'qode'); ?>
									<input name="qode_options[logo_left]" type="text" value="<?php if ($options['logo_left']) { echo esc_attr($options['logo_left'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Center logo', 'qode'); ?></td>
							<td>
								<select name="qode_options[center_logo_image]">
									<option <?php if(isset($options['center_logo_image'])){ $center_logo_image = $options['center_logo_image']; if ($center_logo_image == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['center_logo_image'])){ $center_logo_image = $options['center_logo_image']; if ($center_logo_image == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
								<td scope="row" width="150"><?php esc_html_e('Header height (px)', 'qode'); ?></td>
								<td>
							<input name="qode_options[header_height]" type="text" id="header_height" value="<?php if ($options['header_height']) { echo esc_attr($options['header_height'], 'qode'); } ?>" size="30" maxlength="500" />
							<?php esc_html_e('Set header height', 'qode'); ?>
								</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Main menu', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Hide menu', 'qode'); ?>
									<select name="qode_options[main_menu_hide]">
										<option <?php if(isset($options['main_menu_hide'])){ $main_menu_hide = $options['main_menu_hide']; if ($main_menu_hide == 'no') { echo "selected='selected'"; } } ?> value="no">no</option>
										<option <?php if(isset($options['main_menu_hide'])){ $main_menu_hide = $options['main_menu_hide']; if ($main_menu_hide == 'yes') { echo "selected='selected'"; } } ?> value="yes">yes</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Position', 'qode'); ?>
									<select name="qode_options[main_menu_position]">
										<option <?php if ($options['main_menu_position'] == 0) { echo "selected='selected'"; } ?> value="0"></option>
										<option <?php if ($options['main_menu_position'] == 1) { echo "selected='selected'"; } ?> value="1">Left</option>
										<option <?php if ($options['main_menu_position'] == 2) { echo "selected='selected'"; } ?> value="2">Center</option>
										<option <?php if ($options['main_menu_position'] == 3) { echo "selected='selected'"; } ?> value="3">Right</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Magic panes height (px)', 'qode'); ?>
									<input name="qode_options[magic_panes_height]" type="text" value="<?php if (isset($options['magic_panes_height'])) { echo esc_attr($options['magic_panes_height'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Magic pane hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['magic_pane_hover_color'])){ echo 'background-color:'.esc_attr($options['magic_pane_hover_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[magic_pane_hover_color]" type="text" value="<?php if (isset($options['magic_pane_hover_color'])) { echo esc_attr($options['magic_pane_hover_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Magic pane active color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['magic_pane_active_color'])){ echo 'background-color:'.esc_attr($options['magic_pane_active_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[magic_pane_active_color]" type="text" value="<?php if (isset($options['magic_pane_active_color'])) { echo esc_attr($options['magic_pane_active_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="top">
								<td scope="row" width="150"><?php esc_html_e('Dropdown main menu', 'qode'); ?></td>
								<td>
									<div class="inline">
										<select name="qode_options[top_menu]">
											<option <?php if ($options['top_menu'] == "move_down") { echo "selected='selected'"; } ?> value="move_down">Dropdown 1</option>
											<option <?php if ($options['top_menu'] == "drop_down") { echo "selected='selected'"; } ?> value="drop_down">Dropdown 2</option>
										</select>
										<?php esc_html_e('Choose drop down menu', 'qode'); ?>
									</div>
									<div class="inline">
										<input name="qode_options[separation_number]" type="text" value="<?php if ($options['separation_number']) { echo esc_attr($options['separation_number'], 'qode'); } ?>" size="10" maxlength="10" />
										<?php esc_html_e('Dropdown separation number (only for "Dropdown 1" type, default is 6)', 'qode'); ?>
									</div>
								</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('1st level menu style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['menu_color']){ echo 'background-color:'.esc_attr($options['menu_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[menu_color]" type="text" value="<?php if ($options['menu_color']) { echo esc_attr($options['menu_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['menu_hovercolor'])){ echo 'background-color:'.esc_attr($options['menu_hovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[menu_hovercolor]" type="text" value="<?php if (isset($options['menu_hovercolor'])) { echo esc_attr($options['menu_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[menu_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['menu_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[menu_fontsize]" type="text" value="<?php if ($options['menu_fontsize']) { echo esc_attr($options['menu_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[menu_lineheight]" type="text" value="<?php if ($options['menu_lineheight']) { echo esc_attr($options['menu_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[menu_fontstyle]">
										<option <?php if ($options['menu_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['menu_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['menu_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[menu_fontweight]">
										<option <?php if ($options['menu_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['menu_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['menu_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['menu_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['menu_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['menu_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['menu_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['menu_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['menu_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('2nd level menu style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_color'])){ echo 'background-color:'.esc_attr($options['dropdown_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[dropdown_color]" type="text" value="<?php if (isset($options['dropdown_color'])) { echo esc_attr($options['dropdown_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_hovercolor'])){ echo 'background-color:'.esc_attr($options['dropdown_hovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[dropdown_hovercolor]" type="text" value="<?php if (isset($options['dropdown_hovercolor'])) { echo esc_attr($options['dropdown_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[dropdown_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['dropdown_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[dropdown_fontsize]" type="text" value="<?php if ($options['dropdown_fontsize']) { echo esc_attr($options['dropdown_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[dropdown_lineheight]" type="text" value="<?php if ($options['dropdown_lineheight']) { echo esc_attr($options['dropdown_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[dropdown_fontstyle]">
											<option <?php if ($options['dropdown_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['dropdown_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
											<option <?php if ($options['dropdown_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
											
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[dropdown_fontweight]">
											<option <?php if ($options['dropdown_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
											<option <?php if ($options['dropdown_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['dropdown_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['dropdown_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['dropdown_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['dropdown_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['dropdown_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['dropdown_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['dropdown_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										</select>
									</div>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('3rd level menu style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_color_thirdlvl'])){ echo 'background-color:'.esc_attr($options['dropdown_color_thirdlvl'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[dropdown_color_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_color_thirdlvl'])) { echo esc_attr($options['dropdown_color_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['dropdown_hovercolor_thirdlvl'])){ echo 'background-color:'.esc_attr($options['dropdown_hovercolor_thirdlvl'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[dropdown_hovercolor_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_hovercolor_thirdlvl'])) { echo esc_attr($options['dropdown_hovercolor_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[dropdown_google_fonts_thirdlvl]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if(isset($options['dropdown_google_fonts_thirdlvl'])){ $dropdown_google_fonts_thirdlvl = $options['dropdown_google_fonts_thirdlvl']; if ($dropdown_google_fonts_thirdlvl == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font size (px)', 'qode'); ?>
										<input name="qode_options[dropdown_fontsize_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_fontsize_thirdlvl'])) { echo esc_attr($options['dropdown_fontsize_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Line height (px)', 'qode'); ?>
										<input name="qode_options[dropdown_lineheight_thirdlvl]" type="text" value="<?php if (isset($options['dropdown_lineheight_thirdlvl'])) { echo esc_attr($options['dropdown_lineheight_thirdlvl'], 'qode'); } ?>" size="10" maxlength="10" />
									</div>
									<div class="inline">
										<?php esc_html_e('Font style', 'qode'); ?>
										<select name="qode_options[dropdown_fontstyle_thirdlvl]">
											<option <?php if(isset($options['dropdown_fontstyle_thirdlvl'])){ $dropdown_fontstyle_thirdlvl = $options['dropdown_fontstyle_thirdlvl']; if ($dropdown_fontstyle_thirdlvl == '') { echo "selected='selected'"; } } ?> value=""></option>
											<option <?php if(isset($options['dropdown_fontstyle_thirdlvl'])){ $dropdown_fontstyle_thirdlvl = $options['dropdown_fontstyle_thirdlvl']; if ($dropdown_fontstyle_thirdlvl == 'normal') { echo "selected='selected'"; } } ?> value="normal">normal</option>
											<option <?php if(isset($options['dropdown_fontstyle_thirdlvl'])){ $dropdown_fontstyle_thirdlvl = $options['dropdown_fontstyle_thirdlvl']; if ($dropdown_fontstyle_thirdlvl == 'italic') { echo "selected='selected'"; } } ?> value="italic">italic</option>	
										</select>
									</div>
									<div class="inline">
										<?php esc_html_e('Font weight', 'qode'); ?>
										<select name="qode_options[dropdown_fontweight_thirdlvl]">
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '') { echo "selected='selected'"; } } ?> value=""></option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '200') { echo "selected='selected'"; } } ?> value="200">200</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '300') { echo "selected='selected'"; } } ?> value="300">300</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '400') { echo "selected='selected'"; } } ?> value="400">400</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '500') { echo "selected='selected'"; } } ?> value="500">500</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '600') { echo "selected='selected'"; } } ?> value="600">600</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '700') { echo "selected='selected'"; } } ?> value="700">700</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '800') { echo "selected='selected'"; } } ?> value="800">800</option>
											<option <?php if(isset($options['dropdown_fontweight_thirdlvl'])){ $dropdown_fontweight_thirdlvl = $options['dropdown_fontweight_thirdlvl']; if ($dropdown_fontweight_thirdlvl == '900') { echo "selected='selected'"; } } ?> value="900">900</option>
										</select>
									</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Separator style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['header_separator_color'])){ echo 'background-color:'.esc_attr($options['header_separator_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[header_separator_color]" type="text" value="<?php if (isset($options['header_separator_color'])) { echo esc_attr($options['header_separator_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Thickness (px)', 'qode'); ?>
									<input name="qode_options[header_separator_thickness]" type="text" value="<?php if ($options['header_separator_thickness']) { echo esc_attr($options['header_separator_thickness'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Footer</h2></td></tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Separator style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['footer_separator_color'])){ echo 'background-color:'.esc_attr($options['footer_separator_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[footer_separator_color]" type="text" value="<?php if (isset($options['footer_separator_color'])) { echo esc_attr($options['footer_separator_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Thickness (px)', 'qode'); ?>
									<input name="qode_options[footer_separator_thickness]" type="text" value="<?php if ($options['footer_separator_thickness']) { echo esc_attr($options['footer_separator_thickness'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Footer logo', 'qode'); ?></td>
							<td>
								<div class="inline" style="width: 600px;">
									<?php esc_html_e('Logo image', 'qode'); ?>
									<input type="text" id="footer_logo_image" name="qode_options[footer_logo_image]" class="logo_image" value="<?php if ($options['footer_logo_image']) { echo esc_attr($options['footer_logo_image'], 'qode'); }  else { echo QODE_ROOT."/img/minimum-logo.png"; } ?>" size="70">
									<input class="upload_button" type="button" value="Upload file">
								</div>
							</td>
						</tr>
					<?php /*
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Center footer logo', 'qode'); ?></td>
							<td>
								<select name="qode_options[center_footer_logo_image]">
									<option <?php if(isset($options['center_footer_logo_image'])){ $center_footer_logo_image = $options['center_footer_logo_image']; if ($center_footer_logo_image == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['center_footer_logo_image'])){ $center_footer_logo_image = $options['center_footer_logo_image']; if ($center_footer_logo_image == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr> */ ?>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Hide footer logo', 'qode'); ?></td>
							<td>
								<select name="qode_options[hide_footer_logo_image]">
									<option <?php if(isset($options['hide_footer_logo_image'])){ $hide_footer_logo_image = $options['hide_footer_logo_image']; if ($hide_footer_logo_image == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['hide_footer_logo_image'])){ $hide_footer_logo_image = $options['hide_footer_logo_image']; if ($hide_footer_logo_image == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="middle" width="150"><?php esc_html_e('Show footer widget area', 'qode'); ?></td>
							<td>
								<div class="inline">
									<select name="qode_options[footer_widget_area]">
										<option <?php if ($options['footer_widget_area'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
										<option <?php if ($options['footer_widget_area'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
										
									</select>
								</div>
							</td>
						</tr>	
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Sliders</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Big slider general options</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Slider options', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Auto transition', 'qode'); ?>
									<select name="qode_options[slider_transition_auto]">
										<option <?php if ($options['slider_transition_auto'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_transition_auto'] == "false") { echo "selected='selected'"; } ?> value="false">no</option>
										<option <?php if ($options['slider_transition_auto'] == "true") { echo "selected='selected'"; } ?> value="true">yes</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Transition effect', 'qode'); ?>
									<select name="qode_options[slider_transition_effect]">
										<option <?php if ($options['slider_transition_effect'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_transition_effect'] == "slide") { echo "selected='selected'"; } ?> value="slide">slide</option>
										<option <?php if ($options['slider_transition_effect'] == "fade") { echo "selected='selected'"; } ?> value="fade">fade</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Transition speed (milliseconds)', 'qode'); ?>
									<input name="qode_options[slider_transition_speed]" type="text" value="<?php if ($options['slider_transition_speed']) { echo esc_attr($options['slider_transition_speed'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Transition timeout (milliseconds)', 'qode'); ?>
									<input name="qode_options[slider_transition_timeout]" type="text" value="<?php if ($options['slider_transition_timeout']) { echo esc_attr($options['slider_transition_timeout'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
						</tr>
						<tr><td colspan='2'><h2>Big slider type 1</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['slider_title_color']){ echo 'background-color:'.esc_attr($options['slider_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[slider_title_color]" type="text" value="<?php if ($options['slider_title_color']) { echo esc_attr($options['slider_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[slider_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['slider_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[slider_title_fontsize]" type="text" value="<?php if ($options['slider_title_fontsize']) { echo esc_attr($options['slider_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[slider_title_lineheight]" type="text" value="<?php if ($options['slider_title_lineheight']) { echo esc_attr($options['slider_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[slider_title_fontstyle]">
										<option <?php if ($options['slider_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['slider_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[slider_title_fontweight]">
										<option <?php if ($options['slider_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
											<option <?php if ($options['slider_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
											<option <?php if ($options['slider_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
											<option <?php if ($options['slider_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
											<option <?php if ($options['slider_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
											<option <?php if ($options['slider_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
											<option <?php if ($options['slider_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
											<option <?php if ($options['slider_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['slider_text_color']){ echo 'background-color:'.esc_attr($options['slider_text_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[slider_text_color]" type="text" value="<?php if ($options['slider_text_color']) { echo esc_attr($options['slider_text_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[slider_text_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['slider_text_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[slider_text_fontsize]" type="text" value="<?php if ($options['slider_text_fontsize']) { echo esc_attr($options['slider_text_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[slider_text_lineheight]" type="text" value="<?php if ($options['slider_text_lineheight']) { echo esc_attr($options['slider_text_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[slider_text_fontstyle]">
										<option <?php if ($options['slider_text_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_text_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['slider_text_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[slider_text_fontweight]">
										<option <?php if ($options['slider_text_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_text_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['slider_text_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['slider_text_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['slider_text_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['slider_text_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['slider_text_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['slider_text_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['slider_text_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Big slider type 2</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['slider_title_color_type2']){ echo 'background-color:'.esc_attr($options['slider_title_color_type2'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[slider_title_color_type2]" type="text" value="<?php if ($options['slider_title_color_type2']) { echo esc_attr($options['slider_title_color_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[slider_title_google_fonts_type2]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['slider_title_google_fonts_type2'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[slider_title_fontsize_type2]" type="text" value="<?php if ($options['slider_title_fontsize_type2']) { echo esc_attr($options['slider_title_fontsize_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[slider_title_lineheight_type2]" type="text" value="<?php if ($options['slider_title_lineheight_type2']) { echo esc_attr($options['slider_title_lineheight_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[slider_title_fontstyle_type2]">
										<option <?php if ($options['slider_title_fontstyle_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_title_fontstyle_type2'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['slider_title_fontstyle_type2'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[slider_title_fontweight_type2]">
										<option <?php if ($options['slider_title_fontweight_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['slider_title_fontweight_type2'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						
						<tr><td colspan='2'><h2>Small slider type 1</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Slider options', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Move slides', 'qode'); ?>
									<select name="qode_options[smallslider_move_slides]">
										<option <?php if ($options['smallslider_move_slides'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_move_slides'] == "1") { echo "selected='selected'"; } ?> value="1">1</option>
										<option <?php if ($options['smallslider_move_slides'] == "3") { echo "selected='selected'"; } ?> value="3">3</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Transition speed (milliseconds)', 'qode'); ?>
									<input name="qode_options[smallslider_transition_speed]" type="text" value="<?php if ($options['smallslider_transition_speed']) { echo esc_attr($options['smallslider_transition_speed'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['smallslider_title_color']){ echo 'background-color:'.esc_attr($options['smallslider_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[smallslider_title_color]" type="text" value="<?php if ($options['smallslider_title_color']) { echo esc_attr($options['smallslider_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[smallslider_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['smallslider_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[smallslider_title_fontsize]" type="text" value="<?php if ($options['smallslider_title_fontsize']) { echo esc_attr($options['smallslider_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[smallslider_title_lineheight]" type="text" value="<?php if ($options['smallslider_title_lineheight']) { echo esc_attr($options['smallslider_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[smallslider_title_fontstyle]">
										<option <?php if ($options['smallslider_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['smallslider_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[smallslider_title_fontweight]">
										<option <?php if ($options['smallslider_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['smallslider_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['smallslider_text_color']){ echo 'background-color:'.esc_attr($options['smallslider_text_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[smallslider_text_color]" type="text" value="<?php if ($options['smallslider_text_color']) { echo esc_attr($options['smallslider_text_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[smallslider_text_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['smallslider_text_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[smallslider_text_fontsize]" type="text" value="<?php if ($options['smallslider_text_fontsize']) { echo esc_attr($options['smallslider_text_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[smallslider_text_lineheight]" type="text" value="<?php if ($options['smallslider_text_lineheight']) { echo esc_attr($options['smallslider_text_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[smallslider_text_fontstyle]">
										<option <?php if ($options['smallslider_text_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_text_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['smallslider_text_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[smallslider_text_fontweight]">
										<option <?php if ($options['smallslider_text_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_text_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['smallslider_text_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						
						<tr><td colspan='2'><h2>Small slider type 2</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Slider options', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Move slides', 'qode'); ?>
									<select name="qode_options[smallslider_move_slides_type2]">
										<option <?php if ($options['smallslider_move_slides_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_move_slides_type2'] == "1") { echo "selected='selected'"; } ?> value="1">1</option>
										<option <?php if ($options['smallslider_move_slides_type2'] == "4") { echo "selected='selected'"; } ?> value="4">4</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Transition speed (milliseconds)', 'qode'); ?>
									<input name="qode_options[smallslider_transition_speed_type2]" type="text" value="<?php if ($options['smallslider_transition_speed_type2']) { echo esc_attr($options['smallslider_transition_speed_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['smallslider_title_color_type2']){ echo 'background-color:'.esc_attr($options['smallslider_title_color_type2'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[smallslider_title_color_type2]" type="text" value="<?php if ($options['smallslider_title_color_type2']) { echo esc_attr($options['smallslider_title_color_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[smallslider_title_google_fonts_type2]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['smallslider_title_google_fonts_type2'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[smallslider_title_fontsize_type2]" type="text" value="<?php if ($options['smallslider_title_fontsize_type2']) { echo esc_attr($options['smallslider_title_fontsize_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[smallslider_title_lineheight_type2]" type="text" value="<?php if ($options['smallslider_title_lineheight_type2']) { echo esc_attr($options['smallslider_title_lineheight_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[smallslider_title_fontstyle_type2]">
										<option <?php if ($options['smallslider_title_fontstyle_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_title_fontstyle_type2'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['smallslider_title_fontstyle_type2'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[smallslider_title_fontweight_type2]">
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['smallslider_title_fontweight_type2'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['smallslider_text_color_type2']){ echo 'background-color:'.esc_attr($options['smallslider_text_color_type2'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[smallslider_text_color_type2]" type="text" value="<?php if ($options['smallslider_text_color_type2']) { echo esc_attr($options['smallslider_text_color_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[smallslider_text_google_fonts_type2]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['smallslider_text_google_fonts_type2'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[smallslider_text_fontsize_type2]" type="text" value="<?php if ($options['smallslider_text_fontsize_type2']) { echo esc_attr($options['smallslider_text_fontsize_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[smallslider_text_lineheight_type2]" type="text" value="<?php if ($options['smallslider_text_lineheight_type2']) { echo esc_attr($options['smallslider_text_lineheight_type2'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[smallslider_text_fontstyle_type2]">
										<option <?php if ($options['smallslider_text_fontstyle_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_text_fontstyle_type2'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['smallslider_text_fontstyle_type2'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[smallslider_text_fontweight_type2]">
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['smallslider_text_fontweight_type2'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Elements</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Separator</h2></td></tr>
						<tr valign="middle">
							<td valign="middle"><?php esc_html_e('Big separator', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['separator_color'])){ echo 'background-color:'.esc_attr($options['separator_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[separator_color]" type="text" value="<?php if (isset($options['separator_color'])) { echo esc_attr($options['separator_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Thickness (px)', 'qode'); ?>
									<input name="qode_options[separator_thickness]" type="text" value="<?php if ($options['separator_thickness']) { echo esc_attr($options['separator_thickness'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Top margin (px)', 'qode'); ?>
									<input name="qode_options[separator_topmargin]" type="text" value="<?php if ($options['separator_topmargin']) { echo esc_attr($options['separator_topmargin'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Bottom margin (px)', 'qode'); ?>
									<input name="qode_options[separator_bottommargin]" type="text" value="<?php if ($options['separator_bottommargin']) { echo esc_attr($options['separator_bottommargin'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td valign="middle"><?php esc_html_e('Small separator', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if (isset($options['separator_small_color'])){ echo 'background-color:'.esc_attr($options['separator_small_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[separator_small_color]" type="text" value="<?php if (isset($options['separator_small_color'])) { echo esc_attr($options['separator_small_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Thickness (px)', 'qode'); ?>
									<input name="qode_options[separator_small_thickness]" type="text" value="<?php if ($options['separator_small_thickness']) { echo esc_attr($options['separator_small_thickness'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Top margin (px)', 'qode'); ?>
									<input name="qode_options[separator_small_topmargin]" type="text" value="<?php if ($options['separator_small_topmargin']) { echo esc_attr($options['separator_small_topmargin'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Bottom margin (px)', 'qode'); ?>
									<input name="qode_options[separator_small_bottommargin]" type="text" value="<?php if ($options['separator_small_bottommargin']) { echo esc_attr($options['separator_small_bottommargin'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Buttons</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Button style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_title_color']){ echo 'background-color:'.esc_attr($options['button_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[button_title_color]" type="text" value="<?php if ($options['button_title_color']) { echo esc_attr($options['button_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_title_hovercolor']){ echo 'background-color:'.esc_attr($options['button_title_hovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[button_title_hovercolor]" type="text" value="<?php if ($options['button_title_hovercolor']) { echo esc_attr($options['button_title_hovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[button_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['button_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[button_title_fontsize]" type="text" value="<?php if ($options['button_title_fontsize']) { echo esc_attr($options['button_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[button_title_lineheight]" type="text" value="<?php if ($options['button_title_lineheight']) { echo esc_attr($options['button_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[button_title_fontstyle]">
										<option <?php if ($options['button_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['button_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['button_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[button_title_fontweight]">
										<option <?php if ($options['button_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['button_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['button_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['button_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['button_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['button_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['button_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['button_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['button_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Size', 'qode'); ?>
									<select name="qode_options[button_size]">
										<option <?php if ($options['button_size'] == 0) { echo "selected='selected'"; } ?> value="0"></option>
										<option <?php if ($options['button_size'] == 'small') { echo "selected='selected'"; } ?> value="small">Small</option>
										<option <?php if ($options['button_size'] == 'medium') { echo "selected='selected'"; } ?> value="medium">Medium</option>
										<option <?php if ($options['button_size'] == 'large') { echo "selected='selected'"; } ?> value="large">Large</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_backgroundcolor']){ echo 'background-color:'.esc_attr($options['button_backgroundcolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[button_backgroundcolor]" type="text" value="<?php if ($options['button_backgroundcolor']) { echo esc_attr($options['button_backgroundcolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Background hover color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['button_backgroundhovercolor']){ echo 'background-color:'.esc_attr($options['button_backgroundhovercolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[button_backgroundhovercolor]" type="text" value="<?php if ($options['button_backgroundhovercolor']) { echo esc_attr($options['button_backgroundhovercolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Message box</h2></td></tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Message box style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['message_title_color']){ echo 'background-color:'.esc_attr($options['message_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[message_title_color]" type="text" value="<?php if ($options['message_title_color']) { echo esc_attr($options['message_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[message_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['message_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[message_title_fontsize]" type="text" value="<?php if ($options['message_title_fontsize']) { echo esc_attr($options['message_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[message_title_lineheight]" type="text" value="<?php if ($options['message_title_lineheight']) { echo esc_attr($options['message_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[message_title_fontstyle]">
										<option <?php if ($options['message_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['message_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['message_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[message_title_fontweight]">
										<option <?php if ($options['message_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['message_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['message_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['message_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['message_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['message_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['message_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['message_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['message_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
								<br/><br/>
								<div class="inline">
									<?php esc_html_e('Border', 'qode'); ?>
									<select name="qode_options[message_border]">
										<option <?php if ($options['message_border'] == 0) { echo "selected='selected'"; } ?> value="0"></option>
										<option <?php if ($options['message_border'] == 'yes') { echo "selected='selected'"; } ?> value="yes">yes</option>
										<option <?php if ($options['message_border'] == 'no') { echo "selected='selected'"; } ?> value="no">no</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Size', 'qode'); ?>
									<select name="qode_options[message_size]">
										<option <?php if ($options['message_size'] == 0) { echo "selected='selected'"; } ?> value="0"></option>
										<option <?php if ($options['message_size'] == 'small') { echo "selected='selected'"; } ?> value="small">Small</option>
										<option <?php if ($options['message_size'] == 'large') { echo "selected='selected'"; } ?> value="large">Large</option>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Background color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['message_backgroundcolor']){ echo 'background-color:'.esc_attr($options['message_backgroundcolor'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[message_backgroundcolor]" type="text" class="colorpicker-input" value="<?php if ($options['message_backgroundcolor']) { echo esc_attr($options['message_backgroundcolor'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Parallax</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Parallax speed', 'qode'); ?></td>
							<td>
								<div class="inline">
									<input name="qode_options[parallax_speed]" type="text" value="<?php if ($options['parallax_speed']) { echo esc_attr($options['parallax_speed'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Parallax min height (px)', 'qode'); ?></td>
							<td>
								<div class="inline">
									<input name="qode_options[parallax_minheight]" type="text" value="<?php if ($options['parallax_minheight']) { echo esc_attr($options['parallax_minheight'], 'qode'); } ?>" size="10" maxlength="10" />
									<?php esc_html_e('Set min-height for last two stages', 'qode'); ?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<h3>Portfolio</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr><td colspan='2'><h2>Portfolio single</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Portfolio style', 'qode'); ?></td>
							<td>
								<select name="qode_options[portfolio_style]">
									<option <?php if ($options['portfolio_style'] == 1) { echo "selected='selected'"; } ?> value="1">Portfolio style 1</option>
									<option <?php if ($options['portfolio_style'] == 2) { echo "selected='selected'"; } ?> value="2">Portfolio style 2</option>
									<option <?php if ($options['portfolio_style'] == 3) { echo "selected='selected'"; } ?> value="3">Portfolio style 3</option>
									<option <?php if ($options['portfolio_style'] == 4) { echo "selected='selected'"; } ?> value="4">Portfolio style 4</option>
									<option <?php if ($options['portfolio_style'] == 5) { echo "selected='selected'"; } ?> value="5">Portfolio style 5</option>
								</select>
							</td>
						</tr>
						<tr><td colspan='2'><h2>Portfolio list</h2></td></tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Title style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['portfolio_list_title_color']){ echo 'background-color:'.esc_attr($options['portfolio_list_title_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[portfolio_list_title_color]" type="text" value="<?php if ($options['portfolio_list_title_color']) { echo esc_attr($options['portfolio_list_title_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[portfolio_list_title_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['portfolio_list_title_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[portfolio_list_title_fontsize]" type="text" value="<?php if ($options['portfolio_list_title_fontsize']) { echo esc_attr($options['portfolio_list_title_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[portfolio_list_title_lineheight]" type="text" value="<?php if ($options['portfolio_list_title_lineheight']) { echo esc_attr($options['portfolio_list_title_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[portfolio_list_title_fontstyle]">
										<option <?php if ($options['portfolio_list_title_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['portfolio_list_title_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['portfolio_list_title_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[portfolio_list_title_fontweight]">
										<option <?php if ($options['portfolio_list_title_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['portfolio_list_title_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Text style', 'qode'); ?></td>
							<td>
								<div class="inline">
									<?php esc_html_e('Color', 'qode'); ?>
									<div class="colorSelector"><div style="<?php if ($options['portfolio_list_text_color']){ echo 'background-color:'.esc_attr($options['portfolio_list_text_color'], 'qode').';'; } ?>"></div></div>
									<input name="qode_options[portfolio_list_text_color]" type="text" value="<?php if ($options['portfolio_list_text_color']) { echo esc_attr($options['portfolio_list_text_color'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font family', 'qode'); ?>
									<select name="qode_options[portfolio_list_text_google_fonts]">
										<option value="-1">Default</option>
										<?php foreach($fontArrays as $fontArray) { ?> 
											<option <?php if ($options['portfolio_list_text_google_fonts'] == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo str_replace(' ', '+', $fontArray["family"]); ?>"><?php echo  $fontArray["family"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font size (px)', 'qode'); ?>
									<input name="qode_options[portfolio_list_text_fontsize]" type="text" value="<?php if ($options['portfolio_list_text_fontsize']) { echo esc_attr($options['portfolio_list_text_fontsize'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Line height (px)', 'qode'); ?>
									<input name="qode_options[portfolio_list_text_lineheight]" type="text" value="<?php if ($options['portfolio_list_text_lineheight']) { echo esc_attr($options['portfolio_list_text_lineheight'], 'qode'); } ?>" size="10" maxlength="10" />
								</div>
								<div class="inline">
									<?php esc_html_e('Font style', 'qode'); ?>
									<select name="qode_options[portfolio_list_text_fontstyle]">
										<option <?php if ($options['portfolio_list_text_fontstyle'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['portfolio_list_text_fontstyle'] == "normal") { echo "selected='selected'"; } ?> value="normal">normal</option>
										<option <?php if ($options['portfolio_list_text_fontstyle'] == "italic") { echo "selected='selected'"; } ?> value="italic">italic</option>
										
									</select>
								</div>
								<div class="inline">
									<?php esc_html_e('Font weight', 'qode'); ?>
									<select name="qode_options[portfolio_list_text_fontweight]">
										<option <?php if ($options['portfolio_list_text_fontweight'] == "") { echo "selected='selected'"; } ?> value=""></option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "200") { echo "selected='selected'"; } ?> value="200">200</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "300") { echo "selected='selected'"; } ?> value="300">300</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "400") { echo "selected='selected'"; } ?> value="400">400</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "500") { echo "selected='selected'"; } ?> value="500">500</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "600") { echo "selected='selected'"; } ?> value="600">600</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "700") { echo "selected='selected'"; } ?> value="700">700</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "800") { echo "selected='selected'"; } ?> value="800">800</option>
										<option <?php if ($options['portfolio_list_text_fontweight'] == "900") { echo "selected='selected'"; } ?> value="900">900</option>
										
									</select>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Blog</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Pagination', 'qode'); ?></td>
							<td>
								<select name="qode_options[pagination]">
									<option <?php if ($options['pagination'] == 0) { echo "selected='selected'"; } ?> value="0">No Pagination</option>
									<option <?php if ($options['pagination'] == 1) { echo "selected='selected'"; } ?> value="1">Pagination 1</option>
									<option <?php if ($options['pagination'] == 2) { echo "selected='selected'"; } ?> value="2">Pagination 2</option>
								</select>
								<?php esc_html_e('Choose Paagination', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Blog list style', 'qode'); ?></td>
							<td>
								<select name="qode_options[blog_style]">
									<option <?php if ($options['blog_style'] == 1) { echo "selected='selected'"; } ?> value="1">Blog style 1</option>
									<option <?php if ($options['blog_style'] == 2) { echo "selected='selected'"; } ?> value="2">Blog style 2</option>
									<option <?php if ($options['blog_style'] == 3) { echo "selected='selected'"; } ?> value="3">Blog style 3</option>
									<option <?php if ($options['blog_style'] == 4) { echo "selected='selected'"; } ?> value="4">Blog style 4</option>
									<option <?php if ($options['blog_style'] == 5) { echo "selected='selected'"; } ?> value="5">Blog style 5</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Category blog sidebar', 'qode'); ?></td>
							<td>
								<select name="qode_options[category_blog_sidebar]">
									<option <?php if ($options['category_blog_sidebar'] == "default") { echo "selected='selected'"; } ?> value="default">No Sidebar</option>
									<option <?php if ($options['category_blog_sidebar'] == 1) { echo "selected='selected'"; } ?> value="1">Sidebar 1/3 right</option>
									<option <?php if ($options['category_blog_sidebar'] == 2) { echo "selected='selected'"; } ?> value="2">Sidebar 1/4 right</option>
									<option <?php if ($options['category_blog_sidebar'] == 3) { echo "selected='selected'"; } ?> value="3">Sidebar 1/3 left</option>
									<option <?php if ($options['category_blog_sidebar'] == 4) { echo "selected='selected'"; } ?> value="4">Sidebar 1/4 left</option>
									
								</select>
								<?php esc_html_e('Choose category sidebar', 'qode'); ?>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Hide comments', 'qode'); ?></td>
							<td>
								<select name="qode_options[blog_hide_comments]">
									<option <?php if(isset($options['blog_hide_comments'])){ $blog_hide_comments = $options['blog_hide_comments']; if ($blog_hide_comments == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['blog_hide_comments'])){ $blog_hide_comments = $options['blog_hide_comments']; if ($blog_hide_comments == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="middle">
							<td scope="row" width="150"><?php esc_html_e('Number of characters', 'qode'); ?></td>
							<td>
								<input name="qode_options[number_of_chars]" type="text" class="colorpicker-input" value="<?php if ($options['number_of_chars']) { echo esc_attr($options['number_of_chars'], 'qode'); } ?>" size="10" maxlength="10" />
								<?php esc_html_e('Number of characters in blog listing', 'qode'); ?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>Contact page</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Mail send to', 'qode'); ?></td>
							<td>
								<input name="qode_options[receive_mail]" type="text" value="<?php if ($options['receive_mail']) { echo esc_attr($options['receive_mail'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Enable Contact Form', 'qode'); ?></td>
							<td>
								<select name="qode_options[enable_contact_form]">
									<option <?php if ($options['enable_contact_form'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['enable_contact_form'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Hide Website Field', 'qode'); ?></td>
							<td>
								<select name="qode_options[hide_contact_form_website]">
									<option <?php if(isset($options['hide_contact_form_website'])){ $hide_contact_form_website = $options['hide_contact_form_website']; if ($hide_contact_form_website == 'no') { echo "selected='selected'"; } } ?> value="no">No</option>
									<option <?php if(isset($options['hide_contact_form_website'])){ $hide_contact_form_website = $options['hide_contact_form_website']; if ($hide_contact_form_website == 'yes') { echo "selected='selected'"; } } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Email From', 'qode'); ?></td>
							<td>
								<input name="qode_options[email_from]" type="text" value="<?php if ($options['email_from']) { echo esc_attr($options['email_from'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Email Subject', 'qode'); ?></td>
							<td>
								<input name="qode_options[email_subject]" type="text" value="<?php if ($options['email_subject']) { echo esc_attr($options['email_subject'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Use reCaptcha', 'qode'); ?></td>
							<td>
								<select name="qode_options[use_recaptcha]">
									<option <?php if ($options['use_recaptcha'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['use_recaptcha'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('ReCaptcha public key', 'qode'); ?></td>
							<td>
								<input name="qode_options[recaptcha_public_key]" type="text" value="<?php if ($options['recaptcha_public_key']) { echo esc_attr($options['recaptcha_public_key'], 'qode'); } ?>"  />
							
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('ReCaptcha private key', 'qode'); ?></td>
							<td>
								<input name="qode_options[recaptcha_private_key]" type="text" value="<?php if ($options['recaptcha_private_key']) { echo esc_attr($options['recaptcha_private_key'], 'qode'); } ?>"  />
							</td>
						</tr>			
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Heading above contact form', 'qode'); ?></td>
							<td>
								<input name="qode_options[contact_heading_above]" type="text" value="<?php if ($options['contact_heading_above']) { echo esc_attr($options['contact_heading_above'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Enable Google Map', 'qode'); ?></td>
							<td>
								<select name="qode_options[enable_google_map]">
									<option <?php if ($options['enable_google_map'] == "no") { echo "selected='selected'"; } ?> value="no">No</option>
									<option <?php if ($options['enable_google_map'] == "yes") { echo "selected='selected'"; } ?> value="yes">Yes</option>
								</select>
							</td>
						</tr>
						<?php if($options['enable_google_map'] == "yes") : ?>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Google map iframe', 'qode'); ?></td>
							<td>
								<textarea id="google_maps_iframe" name="qode_options[google_maps_iframe]" cols="60" rows="5"><?php if (isset($options['google_maps_iframe'])) { echo esc_attr($options['google_maps_iframe'], 'qode'); } ?></textarea>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
			<h3>404 page</h3>
			<div>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Title', 'qode'); ?></td>
							<td>
								<input name="qode_options[404_title]" type="text" value="<?php if ($options['404_title']) { echo esc_attr($options['404_title'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Subtitle', 'qode'); ?></td>
							<td>
								<input name="qode_options[404_subtitle]" type="text" value="<?php if ($options['404_subtitle']) { echo esc_attr($options['404_subtitle'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Text', 'qode'); ?></td>
							<td>
								<input name="qode_options[404_text]" type="text" value="<?php if ($options['404_text']) { echo esc_attr($options['404_text'], 'qode'); } ?>"  />
							</td>
						</tr>
						<tr valign="top">
							<td scope="row" width="150"><?php esc_html_e('Back to home label', 'qode'); ?></td>
							<td>
								<input name="qode_options[404_backlabel]" type="text" value="<?php if ($options['404_backlabel']) { echo esc_attr($options['404_backlabel'], 'qode'); } ?>"  />
							</td>
						</tr>
					</tbody>
				</table>
				<?php		display_save_changes_button(); ?>
			</div>
		</div>
<?php	}


} // end of qode_Theme_Options Class



function display_save_changes_button() {
	    echo ('
		    <table class="form-table">
			<tbody>
			    <tr valign="middle">
				<th scope="row" width="150">&nbsp;</th>
				<td>
				    <div class="submit" style="padding:10px 0 0 80px; float:right; clear:both;">
					<input type="hidden" id="qode_submit" value="1" name="qode_submit"/>
					<input class="button-primary" type="submit" name="submit" value="'.esc_attr__('Save Changes', 'qode').'" />
				    </div>
				</td>
			    </tr>
			</tbody>
		    </table>');
}




$my_Qode_Theme_Options = new Qode_Theme_Options();


