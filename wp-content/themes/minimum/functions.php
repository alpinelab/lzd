<?php

load_theme_textdomain( 'qode', get_template_directory().'/languages' );

add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

/* Start session */
if (!function_exists('myStartSession')) {
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
		
		if (!empty($_GET['animation']))
			$_SESSION['qode_animation'] = $_GET['animation'];
		
		if (!empty($_GET['menu']))
			$_SESSION['qode_menu'] = $_GET['menu'];
			
		if (!empty($_GET['footer']))
			$_SESSION['qode_footer'] = $_GET['footer'];
}}

/* End session */

if (!function_exists('myEndSession')) {
function myEndSession() {
    session_destroy ();
}
}


add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');

define('QODE_ROOT', get_template_directory_uri());
define('QODE_VAR_PREFIX', 'qode_'); 
include_once('widgets/relate_posts_widget.php');
include_once('includes/shortcodes.php');
include_once('includes/qode-options.php');
include_once('includes/custom-fields.php');
include_once('includes/qode-menu.php');

/* Add css */

if (!function_exists('qode_styles')) {
function qode_styles() {
	global $qode_options;
	global $wp_styles;
	wp_enqueue_style("default_style", QODE_ROOT."/style.css");
	wp_enqueue_style("stylesheet", QODE_ROOT."/css/stylesheet.min.css");
	
	if($qode_options['show_toolbar'] == "yes"):
		wp_enqueue_style("toolbar", QODE_ROOT."/css/toolbar.min.css");
		wp_enqueue_style("toolbar_colorpicker", QODE_ROOT."/css/admin/colorpicker.css");
	endif;
	$fonts_array  = array(
						$qode_options['google_fonts'].':200,300,400',
						$qode_options['h1_google_fonts'].':200,300,400',
						$qode_options['h2_google_fonts'].':200,300,400',
						$qode_options['h3_google_fonts'].':200,300,400',
						$qode_options['h4_google_fonts'].':200,300,400',
						$qode_options['h5_google_fonts'].':200,300,400',
						$qode_options['h6_google_fonts'].':200,300,400',
						$qode_options['h6_google_fonts'].':200,300,400',
						$qode_options['text_google_fonts'].':200,300,400',
						$qode_options['page_title_google_fonts'].':200,300,400',
						$qode_options['menu_google_fonts'].':200,300,400',
						$qode_options['dropdown_google_fonts'].':200,300,400',
						$qode_options['slider_title_google_fonts'].':200,300,400',
						$qode_options['slider_text_google_fonts'].':200,300,400',
						$qode_options['button_title_google_fonts'].':200,300,400',
						$qode_options['message_title_google_fonts'].':200,300,400',
						$qode_options['smallslider_title_google_fonts'].':200,300,400',
						$qode_options['smallslider_text_google_fonts'].':200,300,400',
						$qode_options['slider_title_google_fonts_type2'].':200,300,400',
						$qode_options['portfolio_list_title_google_fonts'].':200,300,400',
						$qode_options['portfolio_list_text_google_fonts'].':200,300,400',
						$qode_options['smallslider_title_google_fonts_type2'].':200,300,400',
						$qode_options['smallslider_text_google_fonts_type2'].':200,300,400'
						);
						
	if (isset($qode_options['dropdown_google_fonts_thirdlvl'])) array_push($fonts_array, $qode_options['dropdown_google_fonts_thirdlvl']);
	
	$fonts_array=array_diff($fonts_array, array("-1:200,300,400"));
	$google_fonts_string = implode( '|', $fonts_array);
	if(count($fonts_array) > 0) :
		printf("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,600,700,300italic,400italic,600italic,700italic|PT+Sans:400,400italic,700,700italic|%s&subset=latin,latin-ext' type='text/css' />\r\n", str_replace(' ', '+', $google_fonts_string));
	else :
		printf("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,600,700,300italic,400italic,600italic,700italic|PT+Sans:400,400italic,700,700italic&subset=latin,latin-ext' type='text/css' />\r\n");
	endif;
	wp_enqueue_style(
	   'ie7-style',
	   QODE_ROOT . '/css/ie7.min.css'
	);

	$wp_styles->add_data( 'ie7-style', 'conditional', 'IE 7' );
	wp_enqueue_style(
	   'ie8-style',
	   QODE_ROOT . '/css/ie8.min.css'
	);

	$wp_styles->add_data( 'ie8-style', 'conditional', 'IE 8' );
	wp_enqueue_style(
	   'ie9-style',
	   QODE_ROOT . '/css/ie9.min.css'
	);

	$wp_styles->add_data( 'ie9-style', 'conditional', 'IE 9' );
}
}

/* Add js */

if (!function_exists('qode_scripts')) {
function qode_scripts() {
	global $qode_options;
	global $is_IE;
	wp_enqueue_script("jquery");
	wp_enqueue_script("plugins", QODE_ROOT."/js/plugins.js",array(),false,true);
	if ( $is_IE ) {
		wp_enqueue_script("html5", QODE_ROOT."/js/html5.js",array(),false,false);
	}
	wp_enqueue_script("default_dynamic", QODE_ROOT."/js/default_dynamic.php",array(),false,true);
	wp_enqueue_script("default", QODE_ROOT."/js/default.min.js",array(),false,true);
	wp_enqueue_script("custom_js", QODE_ROOT."/js/custom_js.php",array(),false,true);
	if ( is_singular() ) wp_enqueue_script( "comment-reply");
	
	$has_ajax = false;
	$qode_animation = "";
	if (isset($_SESSION['qode_animation']))
		$qode_animation = $_SESSION['qode_animation'];
	if (($qode_options['page_transitions'] != "0") && (empty($qode_animation) || ($qode_animation != "no")))
		$has_ajax = true;
	elseif (!empty($qode_animation) && ($qode_animation != "no"))
		$has_ajax = true;
		
	if ($has_ajax) :
		wp_enqueue_script("ajax", QODE_ROOT."/js/ajax.min.js",array(),false,true);
	endif;
	
	if($qode_options['use_recaptcha'] == "yes") :
	wp_enqueue_script("recaptcha_ajax", "http://www.google.com/recaptcha/api/js/recaptcha_ajax.js",array(),false,true);
	endif;
	
	if($qode_options['show_toolbar'] == "yes"):
		wp_enqueue_script("toolbar", QODE_ROOT."/js/toolbar.min.js",array(),false,true);
		wp_enqueue_script("toolbar_colorpicker", QODE_ROOT."/js/admin/colorpicker.js",array(),false,true);
	endif;
	
	
}
}

add_action('wp_enqueue_scripts', 'qode_styles'); 
add_action('wp_enqueue_scripts', 'qode_scripts');

/* Add admin js and css */

if (!function_exists('my_admin_jquery')) {
function my_admin_jquery() {
		wp_enqueue_script('jquery'); 
		wp_enqueue_style('style', QODE_ROOT.'/css/admin/admin-style.css', false, '1.0', 'screen');
		wp_enqueue_style('colorstyle', QODE_ROOT.'/css/admin/colorpicker.css', false, '1.0', 'screen');
		wp_register_script('colorpickerss', QODE_ROOT.'/js/admin/colorpicker.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('colorpickerss'); 
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_register_script('default', QODE_ROOT.'/js/admin/default.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('default'); 
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	
}
}
add_action('admin_print_scripts', 'my_admin_jquery');


if (!isset( $content_width )) $content_width = 940;

/* Remove Generator from head */

remove_action('wp_head', 'wp_generator'); 

/* Register Menus */

if (!function_exists('register_menus')) {
function register_menus() {
    register_nav_menus(
        array('top-navigation' => __( 'Top Navigation', 'qode')
		)
		
    );
}
}
add_action( 'init', 'register_menus' ); 

/* Add post thumbnails */

if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
add_image_size( 'blog-type-1-small', 220, 220, true );
add_image_size( 'blog-type-1-medium', 250, 250, true );
add_image_size( 'blog-type-1-big', 338, 338, true );
add_image_size( 'blog-type-3-small', 196, 111, true );
add_image_size( 'blog-type-3-medium', 218, 124, true );
add_image_size( 'blog-type-3-big', 300, 170, true );
add_image_size( 'blog-type-4-small', 304, 172, true );
add_image_size( 'blog-type-4-medium', 338, 191, true );
add_image_size( 'blog-type-5-big', 460, 260, true );

}

/* Add feedlinks */

add_theme_support( 'automatic-feed-links' );

/* Qode comments */

if (!function_exists('qode_comment')) {
function qode_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>

<li>                        
	<div class="comment">
	  <div class="image"> <?php echo get_avatar($comment, 60); ?> </div>
	  <div class="text">
		<div class="info"> <span class="left"><?php echo get_comment_author_link(); ?></span> <span class="right"> <?php echo get_comment_date(). " at " . get_comment_time() . " / "; 
										comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> </span> </div>
		<div class="text_holder"  id="comment-<?php echo comment_ID(); ?>">
		  <?php comment_text() ?>
		</div>
	  </div>
	</div>

                             
                
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.', qode); ?></em></p>
<?php endif; ?>                

<?php 
}
}
/* Register Sidebar */

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Sidebar',
				'id' => 'sidebar',
        'description' => 'Default sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'SidebarPage',
				'id' => 'sidebar_page',
        'description' => 'Sidebar for Page',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
	register_sidebar(array(
        'name' => 'WoocommerceSidebar',
				'id' => 'woocommerce_sidebar',
        'description' => 'Sidebar for woocommerce',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));	
	 register_sidebar(array(
        'name' => 'Footer slider',
				'id' => 'footer_slider',
        'description' => 'Footer slider',
        'before_widget' => '<li><div id="%1$s" class="widget %2$s slide_item">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4>',
        'after_title' => '</h4><div class="separator small"></div>'
    ));
		register_sidebar(array(
        'name' => 'Footer left',
				'id' => 'footer_left',
        'description' => 'Footer left',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'Footer right',
				'id' => 'footer_right',
        'description' => 'Footer right',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'Header right',
				'id' => 'header_right',
        'description' => 'Header right',
        'before_widget' => '<div id="%1$s" class="widget %2$s header_right_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
	 
   
}

/* Add class on body for ajax */

if (!function_exists('ajax_classes')) {
function ajax_classes($classes) {
	global $qode_options;
	$qode_animation="";
	if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
	if(($qode_options['page_transitions'] === "0") && ($qode_animation == "no")) :
		$classes[] = '';
	elseif($qode_options['page_transitions'] === "1" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_updown';
		$classes[] = 'page_not_loaded';
	elseif($qode_options['page_transitions'] === "2" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options['page_transitions'] === "3" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_updown_fade';
		$classes[] = 'page_not_loaded';
	elseif(!empty($qode_animation) && $qode_animation != "no") :
		$classes[] = 'page_not_loaded';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','ajax_classes');

/* Excerpt more */

if (!function_exists('qode_excerpt_more')) {
function qode_excerpt_more( $more ) {
    return '...';
}
}
add_filter('excerpt_more', 'qode_excerpt_more');

/* Excerpt lenght */

if (!function_exists('qode_excerpt_length')) {
function qode_excerpt_length( $length ) {
	global $qode_options;
	if($qode_options['number_of_chars']){
		 return $qode_options['number_of_chars'];
	} else {
		return 45;
	}
}
}
add_filter( 'excerpt_length', 'qode_excerpt_length', 999 );

/* Create Portfolio post type */

if (!function_exists('create_post_type')) {
function create_post_type() {
	register_post_type( 'portfolio_page',
		array(
			'labels' => array(
				'name' => __( 'Portfolio','qode' ),
				'singular_name' => __( 'Portfolio Item','qode' ),
				'add_item' => __('New Portfolio Item','qode'),
                'add_new_item' => __('Add New Portfolio Item','qode'),
                'edit_item' => __('Edit Portfolio Item','qode')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio_page'),
			'menu_position' => 4,
			'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'post-formats', 'page-attributes')
		)
	);
	  flush_rewrite_rules();
}
}
add_action( 'init', 'create_post_type' );

/* Create Portfolio Categories */

add_action( 'init', 'create_portfolio_taxonomies', 0 );
if (!function_exists('create_portfolio_taxonomies')) {
function create_portfolio_taxonomies() 
{
   $labels = array(
    'name' => __( 'Portfolio Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Portfolio Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Portfolio Categories','qode' ),
    'all_items' => __( 'All Portfolio Categories','qode' ),
    'parent_item' => __( 'Parent Portfolio Category','qode' ),
    'parent_item_colon' => __( 'Parent Portfolio Category:','qode' ),
    'edit_item' => __( 'Edit Portfolio Category','qode' ), 
    'update_item' => __( 'Update Portfolio Category','qode' ),
    'add_new_item' => __( 'Add New Portfolio Category','qode' ),
    'new_item_name' => __( 'New Portfolio Category Name','qode' ),
    'menu_name' => __( 'Portfolio Categories','qode' ),
  );     

  register_taxonomy('portfolio_category',array('portfolio_page'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio-category' ),
  ));

}
}

/* Pagination */

if (!function_exists('pagination')) {
function pagination($pages = '', $range = 4, $paged = 1)
{  
	global $qode_options;
     $showitems = $range+1;  
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
		if($qode_options['pagination'] == "2") :
			$pagination_style="2";
		else :
			$pagination_style="";
		endif;
         echo "<div class='pagination$pagination_style'><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
		echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'></a></li>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
             }
         }
		
         echo "<li class='next'><a href=\"";
		 if($pages > $paged) {
		 echo get_pagenum_link($paged + 1);
		 }
		 else {
			 echo get_pagenum_link($paged);
		 }
		 echo "\"></a></li>";  
		 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</ul></div>\n";
     }
}
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

/* Empty paragraph fix in shortcode */

if (!function_exists('shortcode_empty_paragraph_fix')) {
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}
}

/* Use slider instead of image for post */

if (!function_exists('slider_blog')) {
function slider_blog($post_id) {
	$sliders = get_post_meta($post_id, "qode_sliders", true);		
	$slider = $sliders[1];
	if($slider) {
		$html .= '<div class="flexslider"><ul class="slides">';
		$i=0;
		while ($slider[$i])
		{
			$slide = $slider[$i];
			
			$href = $slide[link];
			$baseurl = home_url();
			$baseurl = str_replace('http://', '', $baseurl);
			$baseurl = str_replace('www', '', $baseurl);
			$host = parse_url($href, PHP_URL_HOST);
			if($host != $baseurl) {
				$target = 'target="_blank"';
			}
			else {
				$target = 'target="_self"';
			}
			
			$html .= '<li class="slide ' . $slide[imgsize] . '">';
			$html .= '<div class="image"><img src="' . $slide[img] . '" alt="' . $slide[title] . '" /></div>';
			
			$html .= '</li>';
			$i++; 
		}
		$html .= '</ul></div>';
	}
	return $html;
}
}

if (!function_exists('compareSlides')) {
function compareSlides($a, $b)
{
	if (isset($a['ordernumber']) && isset($b['ordernumber'])) {
    if ($a['ordernumber'] == $b['ordernumber']) {
        return 0;
    }
    return ($a['ordernumber'] < $b['ordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioImages')) {
function comparePortfolioImages($a, $b)
{
	if (isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
    if ($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
        return 0;
    }
    return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioOptions')) {
function comparePortfolioOptions($a, $b)
{
	if (isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
    if ($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
        return 0;
    }
    return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
  }
  return 0;
}
}


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if (!function_exists('my_theme_register_required_plugins')) {
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Revolution Slider Plugin', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		// array(
			// 'name' 		=> 'BuddyPress',
			// 'slug' 		=> 'buddypress',
			// 'required' 	=> false,
		// ),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'minimum';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	woocommerce_related_products(4,4); // Display 3 products in rows of 3
}

// Display 12 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

if ( ! function_exists( 'woocommerce_content' ) ) {

	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) : the_post();

				woocommerce_get_template_part( 'content', 'single-product' );

			endwhile;

		} else {

			?>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php do_action('woocommerce_before_shop_loop'); ?>

				<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php woocommerce_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action('woocommerce_after_shop_loop'); ?>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif;

		}
	}
}

    // Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
		if($woocommerce->cart->cart_contents_count > 0 ){
			ob_start();
			?>
			<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
				<img src="<?php bloginfo('template_url'); ?>/img/woocommerce_cart_image.png" />
				<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
			</a>
			<?php
			$fragments['a.cart-contents'] = ob_get_clean();
			return $fragments;
		}
	}
}

?>