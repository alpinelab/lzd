<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options;
global $wp_query;
$disable_qode_seo = "";
$seo_title = "";
if (isset($qode_options['disable_qode_seo'])) $disable_qode_seo = $qode_options['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options['responsiveness'])) $responsiveness = $qode_options['responsiveness'];
	if($responsiveness != "no"):
	?>
	<meta name=viewport content="width=device-width,initial-scale=1">
	<?php 
	endif;
	?>
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	<?php if ($disable_qode_seo != "yes") { ?>
	<?php if($seo_description) { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php } else if($qode_options['meta_description']){ ?>
	
	<?php } ?>
	<?php if($seo_keywords) { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php } else if($qode_options['meta_keywords']){ ?>
	<meta name="keywords" content="<?php echo $qode_options['meta_keywords'] ?>">
	<?php } ?>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options['favicon_image']; ?>">
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/css/woocommerce.css"; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/css/woocommerce-responsive.css"; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/css/style_dynamic.php"; ?>" />

	<?php
	$responsiveness = "yes";
	if (isset($qode_options['responsiveness'])) $responsiveness = $qode_options['responsiveness'];
	if($responsiveness != "no"):
	?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/css/responsive.min.css"; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/css/style_dynamic_responsive.php"; ?>" />
	<?php
	endif;
	?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . "/css/custom_css.php"; ?>" />
</head>

<body <?php body_class(); ?>>
	
	<!-- Google Analytics start -->
	<?php if (isset($qode_options['google_analytics_code'])){
				if($qode_options['google_analytics_code'] != "") { 
	?>
		<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $qode_options['google_analytics_code']; ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	<?php }
		}
	?>
	<!-- Google Analytics end -->


	<?php if (is_ssl()) {
        $logo_url = str_replace("http://", "https://", $qode_options['logo_image']);
    } else {
        $logo_url = $qode_options['logo_image'];
    }

    ?>
    <div class="container">
        <header>
	            <div class="right">
	                <?php dynamic_sidebar( 'header_right' ); ?>
	            </div>
	        <div class="logo"><a href="<?php echo home_url(); ?>/"><img src="<?php echo $logo_url; ?>" alt="Logo"/></a></div>

<?php
$menu_type = $qode_options['top_menu'];
if (!empty($_SESSION['qode_menu']))
	$menu_type = $_SESSION['qode_menu'];
?>
			<nav class="main_menu <?php if($menu_type == "move_down") : echo "move_down"; else: echo "drop_down"; endif; ?>">
			<?php

				if($menu_type == "move_down"):
					wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
															'container'  => '', 
															'container_class' => '', 
                              'menu_class' => '', 
                              'menu_id' => '',
															'fallback_cb' => 'top_navigation_fallback',
															'walker' => new qode_type1_walker_nav_menu()
           ));
				else :
					wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
															'container'  => '', 
															'container_class' => '', 
                              'menu_class' => '', 
                              'menu_id' => '',
															'fallback_cb' => 'top_navigation_fallback',
															'walker' => new qode_type2_walker_nav_menu()
           ));
				endif;
			?>
			
			<span id="magic"></span>
			<span id="magic2"></span>
			</nav>
			<nav class="selectnav">
				
			</nav>
		</header>
</div>
		<div class="content">
		<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$animation = get_post_meta($id, "qode_show-animation", true);
if (!empty($_SESSION['qode_animation']) && $animation == "")
	$animation = $_SESSION['qode_animation'];
?>
			<?php if($qode_options['page_transitions'] == "1" || $qode_options['page_transitions'] == "2" || $qode_options['page_transitions'] == "3" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
					<div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">
				<div class="container"><div class="move_menu_separator"></div></div>
			