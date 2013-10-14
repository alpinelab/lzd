<?php 
/*
Template Name: Contact Page
*/ 
?>

<?php
get_header();

global $woocommerce;
$hide_contact_form_website = "";
if (isset($qode_options['hide_contact_form_website'])) $hide_contact_form_website = $qode_options['hide_contact_form_website'];
?>
  
	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
					<?php if($qode_options['enable_contact_form'] == "yes" && $qode_options['enable_google_map'] == "yes") : ?>
						<div class="two_columns_50_50 clearfix">
							<div class="column_left">
								<div class="column_inner">
									<div class="map">
										<div class="map_inner">
											<?php echo $qode_options['google_maps_iframe']; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="column_right">
								<div class="column_inner">
									<div class="contact_form">
										<h5><?php if($qode_options['contact_heading_above'] != "") { echo $qode_options['contact_heading_above'];  } else { ?><?php _e('Contact Form', 'qode'); ?><?php } ?></h5>
										<form id="contact-form" method="post" action="">
											<div><input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="<?php _e('Your Full Name *', 'qode'); ?>" /></div>
											<div><input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" /></div>
											<?php if ($hide_contact_form_website == "yes") { ?>
											<input type="hidden" name="website" id="website" value="" />
											<?php } else { ?>
											<div><input type="text" name="website" id="website" value="" placeholder="<?php _e('Web site', 'qode'); ?>" /></div>
											<?php }?>
											<div><textarea name="message" cols="5" id="message" rows="5" placeholder="<?php _e('Message', 'qode'); ?>"></textarea></div>

											<?php
												if($qode_options['use_recaptcha'] == "yes") :
													require_once('includes/recaptchalib.php');
													if($qode_options['recaptcha_public_key']) {
														$publickey = $qode_options['recaptcha_public_key'];
													} else {
														$publickey = "6Lf0AdwSAAAAAPfaJIkGssMZ4g_iKjFuxDzoUPU1";
													}
													if($qode_options['recaptcha_private_key']) {
														$privatekey = $qode_options['recaptcha_private_key'];
													} else {
														$privatekey = "6Lf0AdwSAAAAAN9IR7M0U3QQttdDCZdYZsOy-XUS";
													}

													if($qode_options['page_transitions'] != ""){ ?>
														<script type="text/javascript">
															var RecaptchaOptions = {theme: 'clean'};
															Recaptcha.create("<?php echo $publickey; ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
														</script>
													<?php } ?>
													<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
													<p id="captchaStatus">&nbsp;</p>
											<?php endif; ?>

											<input type="submit" class="button small" value="<?php _e( 'Send Message','qode' ); ?>" />
										</form>
									</div>
								</div>
							</div>
						</div>
						<?php the_content(); ?>
					<?php elseif($qode_options['enable_contact_form'] == "no" && $qode_options['enable_google_map'] == "yes") : ?>
						<div class="map">
							<div class="map_inner">
								<?php echo $qode_options['google_maps_iframe']; ?>
							</div>
						</div>
						<?php the_content(); ?>
					<?php elseif($qode_options['enable_contact_form'] == "yes" && $qode_options['enable_google_map'] == "no") : ?>
						<div class="two_columns_50_50 clearfix">
							<div class="column_left">
								<div class="column_inner">
									<div class="contact_form">
										<h5><?php if($qode_options['contact_heading_above'] != "") { echo $qode_options['contact_heading_above'];  } else { ?><?php _e('Contact Form', 'qode'); ?><?php } ?></h5>
										<form id="contact-form" method="post" action="">
											<div><input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="<?php _e('Your Full Name *', 'qode'); ?>" /></div>
											<div><input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" /></div>
											<?php if ($hide_contact_form_website == "yes") { ?>
											<input type="hidden" name="website" id="website" value="" />
											<?php } else { ?>
											<div><input type="text" name="website" id="website" value="" placeholder="<?php _e('Web site', 'qode'); ?>" /></div>
											<?php }?>
											<div><textarea name="message" cols="5" id="message" rows="5" placeholder="<?php _e('Message', 'qode'); ?>"></textarea></div>
										
											<?php
												if($qode_options['use_recaptcha'] == "yes") :
													require_once('includes/recaptchalib.php');
													if($qode_options['recaptcha_public_key']) {
														$publickey = $qode_options['recaptcha_public_key'];
													} else {
														$publickey = "6Lf0AdwSAAAAAPfaJIkGssMZ4g_iKjFuxDzoUPU1";
													}
													if($qode_options['recaptcha_private_key']) {
														$privatekey = $qode_options['recaptcha_private_key'];
													} else {
														$privatekey = "6Lf0AdwSAAAAAN9IR7M0U3QQttdDCZdYZsOy-XUS";
													}

													if($qode_options['page_transitions'] != ""){ ?>
														<script type="text/javascript">
															var RecaptchaOptions = {theme: 'clean'};
															Recaptcha.create("<?php echo $publickey; ?>","captchaHolder",{theme: "clean",callback: Recaptcha.focus_response_field});
														</script>
													<?php } ?>
													<p id="captchaHolder"><?php echo recaptcha_get_html($publickey); ?></p>
													<p id="captchaStatus">&nbsp;</p>
											<?php endif; ?>
											<input type="submit" class="button small" value="<?php _e( 'Send Message','qode' ); ?>" />
										</form>
									</div>
								</div>
							</div>
							<div class="column_right">
								<div class="column_inner">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					<?php else: ?>
						<?php the_content(); ?>
					<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready(function($){

    $j('form#contact-form').submit(function() 
    {
        $j('form#contact-form .contact-error').remove();
        var hasError = false;
        $j('form#contact-form .requiredField').each(function() {
            if(jQuery.trim($j(this).val()) == '') 
            {
                var labelText = $j(this).prev('label').text();
                $j(this).parent().append('<strong class="contact-error"><?php _e(' Required', 'qode'); ?></strong>');
                $j(this).addClass('inputError');
                hasError = true;
            } 
            else 
            { //else 1 
                if($j(this).hasClass('email')) 
                { //if hasClass('email')
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailReg.test(jQuery.trim($j(this).val()))) 
                    {
                        var labelText = $j(this).prev('label').text();
                        $j(this).parent().append('<strong class="contact-error"><?php _e(' Invalid', 'qode'); ?></strong>');
                        $j(this).addClass('inputError');
                        hasError = true;
                    } 

                } //end of if hasClass('email')

            } // end of else 1 
        }); //end of each()
        
        if(!hasError) 
        {
          
					challengeField = $j("input#recaptcha_challenge_field").val();
					responseField = $j("input#recaptcha_response_field").val();
					name =  $j("input#fname").val();
					email =  $j("input#email").val();
					website =  $j("input#website").val();
					message =  $j("textarea#message").val();
					
					var form_post_data = "";
					
					var html = $j.ajax({
					type: "POST",
					url: "<?php echo QODE_ROOT; ?>/includes/ajax_mail.php",
					data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField + "&name=" + name + "&email=" + email + "&website=" + website + "&message=" + message,
					async: false
					}).responseText;
					
					if(html == "success")
					{
							
							var formInput = $j(this).serialize();
							
							$j("form#contact-form").before('<div class="contact-success"><strong><?php _e('THANK YOU!', 'qode'); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', 'qode'); ?></p></div>');
							
							$j.post($j(this).attr('action'),formInput);
							hasError = false;
							return false; 
					}
					else
					{
							<?php
							if ($qode_options['use_recaptcha'] == "yes")
							{
							?>
							$j("#recaptcha_response_field").parent().append('<span class="contact-error extra-padding"><?php _e('Invalid Captcha', 'qode'); ?></span>');
							Recaptcha.reload();
							
							<?php
							}
							else
							{
							?>
						 
							$j("form#contact-form").before('<div class="contact-success"><strong><?php _e("Email server problem", 'qode'); ?></strong></p></div>');
							<?php    
							}
							?>
							
							return false;
					}
        }
        return false;
    });
});

</script>   

	</div>
	<?php get_footer(); ?>			