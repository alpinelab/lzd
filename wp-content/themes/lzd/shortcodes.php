<?php

if (!function_exists('register_button')) {
function register_button( $buttons ) {
   array_push( $buttons, "|", "qode_shortcodes" );
   return $buttons;
}
}

if (!function_exists('add_plugin')) {
function add_plugin( $plugin_array ) {
   $plugin_array['qode_shortcodes'] = get_template_directory_uri() . '/includes/qode_shortcodes.js';
   return $plugin_array;
}
}

if (!function_exists('qode_shortcodes_button')) {
function qode_shortcodes_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}
}

add_action('init', 'qode_shortcodes_button');


if (!function_exists('no_wpautop')) {
function no_wpautop($content) 
{ 
        $content = do_shortcode( shortcode_unautop($content) ); 
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        return $content;
}
}
if (!function_exists('num_shortcodes')) {
function num_shortcodes($content) 
{ 
        $columns = substr_count( $content, '[pricing_cell' );
		return $columns;
}
}


/* Three columns wrap shortcode */

if (!function_exists('three_columns')) {
function three_columns($atts, $content = null) {
    return '<div class="three_columns clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('three_columns', 'three_columns');

/* Four columns wrap shortcode */

if (!function_exists('four_columns')) {
function four_columns($atts, $content = null) {
    return '<div class="four_columns clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('four_columns', 'four_columns');

/* Two columns wrap shortcode */

if (!function_exists('two_columns')) {
function two_columns($atts, $content = null) {
    return '<div class="two_columns_50_50 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns', 'two_columns');

/* Two columns 66_33 wrap shortcode */

if (!function_exists('two_columns_66_33')) {
function two_columns_66_33($atts, $content = null) {
    return '<div class="two_columns_66_33 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_66_33', 'two_columns_66_33');

/* Two columns 33_66 wrap shortcode */

if (!function_exists('two_columns_33_66')) {
function two_columns_33_66($atts, $content = null) {
    return '<div class="two_columns_33_66 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_33_66', 'two_columns_33_66');

/* Two columns 75_25 wrap shortcode */

if (!function_exists('two_columns_75_25')) {
function two_columns_75_25($atts, $content = null) {
    return '<div class="two_columns_75_25 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_75_25', 'two_columns_75_25');

/* Two columns 25_75 wrap shortcode */

if (!function_exists('two_columns_25_75')) {
function two_columns_25_75($atts, $content = null) {
    return '<div class="two_columns_25_75 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_25_75', 'two_columns_25_75');

/* Column one shortcode */

if (!function_exists('column1')) {
function column1($atts, $content = null) {
	return '<div class="column1"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column1', 'column1');

/* Column two shortcode */

if (!function_exists('column2')) {
function column2($atts, $content = null) {
	return '<div class="column2"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column2', 'column2');

/* Column three shortcode */

if (!function_exists('column3')) {
function column3($atts, $content = null) {
   return '<div class="column3"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column3', 'column3');

/* Column four shortcode */

if (!function_exists('column4')) {
function column4($atts, $content = null) {
   return '<div class="column4"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column4', 'column4');

/* Dropcaps shortcode */

if (!function_exists('dropcaps')) {
function dropcaps($atts, $content = null) {
	extract(shortcode_atts(array("style" => ""), $atts));
	return "<span class='dropcap $style'>" . no_wpautop($content)  . "</span>";
}
}
add_shortcode('dropcaps', 'dropcaps');

/* Blockquote shortcode */

if (!function_exists('blockquote')) {
function blockquote($atts, $content = null) {
	$html = ""; 
  extract(shortcode_atts(array("width" => ""), $atts));
	$html .= "<blockquote"; 
	if($width > 0){
		$html .= " style=width:$width%;";
	}
	$html .= ">" . no_wpautop($content) . "</blockquote>";
  return $html;
}
}
add_shortcode('blockquote', 'blockquote');

/* Message shortcode */

if (!function_exists('message')) {
function message($atts, $content = null) {
	global $qode_options;
  $html = ""; 
	extract(shortcode_atts(array("border"=>$qode_options['message_border'] ,"background_color"=>"", "size"=>$qode_options['message_size']), $atts));
	$html .= "<div class='message $size";
	if($border == 'yes'){
		$html .= ' border';
	}
	$html .= "' style='";
	if($background_color != ""){
		$html .= 'background-color: '.$background_color.'; ';
	}
	
	$html .= "'><a href='#' class='close'>&nbsp;</a>" .no_wpautop($content) . "</div>";
	
	return $html;
}
}
add_shortcode('message', 'message');

/* Accordion shortcode */

if (!function_exists('accordion')) {
function accordion($atts, $content = null) {
	extract(shortcode_atts(array("type" => "accordion"), $atts));
	return "<div class='$type'>" . no_wpautop($content) . "</div>";
}
}
add_shortcode('accordion', 'accordion');

/* Accordion item shortcode */

if (!function_exists('accordion_item')) {
function accordion_item($atts, $content = null) {

	extract(shortcode_atts(array("caption" => ""), $atts));
	return "<h5>".$caption."</h5><div><div class='inner'>" . no_wpautop($content) ."</div></div>";
}
}
add_shortcode('accordion_item', 'accordion_item');

/* Unordered List shortcode */

if (!function_exists('unordered_list')) {
function unordered_list($atts, $content = null) {
    extract(shortcode_atts(array("style" => ""), $atts));
    $html =  "<div class='list $style'>" . $content . "</div>";  
    return $html;
}
}
add_shortcode('unordered_list', 'unordered_list');

/* Ordered List shortcode */

if (!function_exists('ordered_list')) {
function ordered_list($atts, $content = null) {
    $html =  "<div class=ordered>" . $content . "</div>";  
    return $html;
}
}
add_shortcode('ordered_list', 'ordered_list');

/* Buttons shortcode */

if (!function_exists('button')) {
function button($atts, $content = null) {
	global $qode_options;
	$html = "";
	extract(shortcode_atts(array("size" => "", "color"=> "", "background_color"=>"", "font_size"=>"", "line_height"=>"", "font_style"=>"", "font_weight"=>"", "text"=> "Button", "link"=> "http://qodeinteractive.com/", "target"=> "_self"), $atts));
    $html .=  '<a href="'.$link.'" target="'.$target.'" class="button '.$size.'" style="';
		if($color != ""){
			$html .= 'color: '.$color.'; ';
		}
		if($background_color != ""){
			$html .= 'background-color: '.$background_color.'; ';
		}
		if($font_size != ""){
			$html .= 'font-size: '.$font_size.'px; ';
		}
		if($line_height != ""){
			$html .= 'line-height: '.$line_height.'px; ';
		}
		if($font_style != ""){
			$html .= 'font-style: '.$font_style.'; ';
		}
		if($font_weight != ""){
			$html .= 'font-weight: '.$font_weight.'; ';
		}
		$html .= '">' . $text . '</a>';  
    return $html;
}
}
add_shortcode('button', 'button');

/* Tabs shortcode */

if (!function_exists('tabs')) {
function tabs( $atts, $content = null ) {
  $html = ""; 
	extract(shortcode_atts(array(
    ), $atts));
	$html .= '<div class="tabs '.(isset($atts['type'])?$atts['type']:'').'">';
	$html .= '<ul class="tabs-nav">';
	$key = array_search((isset($atts['type'])?$atts['type']:''),$atts);
		if($key!==false){
			unset($atts[$key]);
	}
	foreach ($atts as $key => $tab) {
		$html .= '<li><a href="#' . $key . '">' . $tab . '</a></li>';
	}
	$html .= '</ul>';
	$html .= '<div class="tabs-container">';
	$html .= no_wpautop($content) .'</div></div>';
	return $html;
}
}
add_shortcode('tabs', 'tabs');

/* Tab shortcode */

if (!function_exists('tab')) {
function tab( $atts, $content = null ) {
  $html = ""; 
	extract(shortcode_atts(array(
    ), $atts));
	$html .= '<div id="tab' . $atts['id'] . '" class="tab-content">' . no_wpautop($content) .'</div>';
	return $html;
}
}
add_shortcode('tab', 'tab');

/* Progress bars shortcode */

if (!function_exists('progress_bars')) {
function progress_bars($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<div class='progress_bars'>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('progress_bars', 'progress_bars');

/* Progress bar shortcode */

if (!function_exists('progress_bar')) {
function progress_bar($atts, $content = null) {
	extract(shortcode_atts(array("title" => "Web Design", "percent"=> "100"), $atts));
    $html =  "<div class='progress_bar'><span class='progress_title'>$title</span><span class='progress_number'></span>	<div class='progress_content_outer'><div data-percentage='$percent' class='progress_content'></div></div></div>";  
    return $html;
}
}
add_shortcode('progress_bar', 'progress_bar');

/* Discontinuous Progress bars shortcode */

if (!function_exists('progress_bars_discontinuous')) {
function progress_bars_discontinuous($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<div class='progress_bars2'>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('progress_bars_discontinuous', 'progress_bars_discontinuous');

/* Discontinuous Progress bar shortcode */

if (!function_exists('progress_bar_discontinuous')) {
function progress_bar_discontinuous($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("title" => "Web Design", "number"=> "0"), $atts));
    $html .=  "<div class='progress_bar'>";
	$html .= "<span class='progress_title'>$title</span>";
	$html .= "<div data-number='$number' class='progress_content clearfix'>";
	$html .= "<div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div>
			<div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div>";
	$html .= "</div></div>";  
 			
	return $html;
}
}
add_shortcode('progress_bar_discontinuous', 'progress_bar_discontinuous');

/* Vertical Progress bars shortcode */

if (!function_exists('progress_bars_vertical')) {
function progress_bars_vertical($atts, $content = null) {
    $html =  "<div class='progres_bars3 clearfix'>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('progress_bars_vertical', 'progress_bars_vertical');

/* Vertical Progress bar shortcode */

if (!function_exists('progress_bar_vertical')) {
function progress_bar_vertical($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("title" => "Web Design", "number"=> "3"), $atts));
    $html .=  "<div class='progress_bar'><div class='progress_bar_inner'>";
	
	$html .= "<div data-number='$number' class='bar_holder'>";
	$html .= "<div class='bar'>
				<div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div>
				<div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div>
				<div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div><div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div>
				<div class='bar'><div class='bar_noactive'>&nbsp;</div><div class='bar_active'>&nbsp;</div></div>";
	$html .= "	</div><div class='progress_number'>".$number."0%</div><div class='progress_title'>$title</div>";
	$html .= "</div></div>";  
    							
									
	return $html;
}
}
add_shortcode('progress_bar_vertical', 'progress_bar_vertical');

/* Pricing table shortcode */

if (!function_exists('pricing_table')) {
function pricing_table($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("border" => ""), $atts));
    $html .=  "<div class='price_tables";
		if($border == "yes"){
			$html .= ' border ';
		}
		$html .= " clearfix'>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('pricing_table', 'pricing_table');

/* Pricing table column shortcode */

if (!function_exists('pricing_column')) {
function pricing_column($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("title" => '',"price" => "0", "period" => "month", "link" => "", "signup_text" => "Sign Up", "active"=>""), $atts));
	$html .=  "<div class='price_table";
	if($active == "yes"){
		$html .= " active";
	}
	$html .="'><div class='price_table_inner'><ul><li><h4>$title</h4></li>" . no_wpautop($content) . "<li><div class='price'><span class='price'>".$price."</span><span class='per'>$period</span></div></li><li><div class='signup'><a href='$link'>$signup_text</a></div></li></ul></div></div>";
	
    return $html;
}
}
add_shortcode('pricing_column', 'pricing_column');


/* Pricing table cell shortcode */

if (!function_exists('pricing_cell')) {
function pricing_cell($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<li class='cell'>" . no_wpautop($content) . "</li>"; 
	return $html;
}
}
add_shortcode('pricing_cell', 'pricing_cell');

/* Testimonial shortcode */

if (!function_exists('testimonials')) {
function testimonials($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("name"=>"", "image_link"=>""), $atts));
    $html .=  "<div class='testimonial";
	if($image_link == ""): $html .= " no_image";  endif;
	$html .= "'><div class='testimonial_inner'>";
	if($image_link !==""): $html .= "<div class='image'><img src='$image_link' /></div>"; endif;
	$html .= "<div class='text'>".no_wpautop($content)."<p>- $name</p></div></div></div>";  
    return $html;
}
}
add_shortcode('testimonials', 'testimonials');

/* Table shortcode */

if (!function_exists('table')) {
function table($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("border"=>"yes"), $atts));
    $html .=  "<table class='standard-table";
		if($border == "yes"){
			$html .= ' border';
		}
		$html .= "'><tbody>" . no_wpautop($content) . "</tbody></table>";  
    return $html;
}
}
add_shortcode('table', 'table');

/* Table row shortcode */

if (!function_exists('table_row')) {
function table_row($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<tr>" . no_wpautop($content) . "</tr>";  
    return $html;
}
}
add_shortcode('table_row', 'table_row');

/* Table head cell shortcode */

if (!function_exists('table_cell_head')) {
function table_cell_head($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<th><h4>" . no_wpautop($content) . "</h4></th>";  
    return $html;
}
}
add_shortcode('table_cell_head', 'table_cell_head');

/* Table body cell shortcode */

if (!function_exists('table_cell_body')) {
function table_cell_body($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<td>" . no_wpautop($content) . "</td>";  
    return $html;
}
}
add_shortcode('table_cell_body', 'table_cell_body');

/* Highlights shortcode */

if (!function_exists('highlight')) {
function highlight($atts, $content = null) {
	$html =  "<span class='highlight'>" . $content . "</span>";  
    return $html;
}
}
add_shortcode('highlight', 'highlight');

/* Action shortcode */

if (!function_exists('action')) {
function action($atts, $content = null) {
	extract(shortcode_atts(array("title" => "New stylish minimalist Wordpress theme avaliable for only $45!"), $atts));
	$html =  "<div class='action'><h2>$title</h2>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('action', 'action');

/* Portfolio shortcode */

if (!function_exists('portfolio_list')) {
function portfolio_list($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array("columns" => "3", "number"=>"-1", "filter"=>'no', "category"=>"", "selected_projects"=>""), $atts));
	
	if($filter == "yes"){
		$html .= "<div class='filter'>
						<span>". __('Filter','qode') ." &nbsp;&nbsp;&nbsp;></span>
						<ul>
						<li><a data-filter='*' href='#'>". __('All','qode') ."</a></li>";
				if ($category == "") {
					$args = array(
						'parent'  => 0
					);
					$portfolio_categories = get_terms( 'portfolio_category',$args);
				} else {
					$top_category = get_term_by('slug',$category,'portfolio_category');
					$term_id = '';
					if (isset($top_category->term_id)) $term_id = $top_category->term_id;
					$args = array(
						'parent'  => $term_id
					);
					$portfolio_categories = get_terms( 'portfolio_category',$args);
				}
				foreach($portfolio_categories as $portfolio_category) {
					$html .=	"<li><a data-filter='.$portfolio_category->slug' href='#'>$portfolio_category->name</a>";
					$args = array(
						'child_of' => $portfolio_category->term_id
					);
					$portfolio_categories2 = get_terms( 'portfolio_category',$args);
					
					if(count($portfolio_categories2) > 0){
						$html .= '<ul>';
						foreach($portfolio_categories2 as $portfolio_category2) {
							$html .=	"<li><a data-filter='.$portfolio_category2->slug' href='#'>$portfolio_category2->name</a></li>";
						}
						$html .= '</ul>';
					}
					
					$html .= '</li>';
				}
		$html .= "</ul></div>";
	}
	$html .= "<div class='portfolio_outer'><div class='portfolio_holder portfolio_holder_v$columns'>";
	
	if ($category == "") {
		$args = array(
			'post_type'=> 'portfolio_page',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => $number
		);
	} else {
		$args = array(
			'post_type'=> 'portfolio_page',
			'portfolio_category' => $category,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => $number
		);
	}
	$project_ids = null;
	if ($selected_projects != "") {
		$project_ids = explode(",",$selected_projects);
		$args['post__in'] = $project_ids;
	}
	query_posts( $args );
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
	$html .= "<article class='element ";
	foreach($terms as $term) {
		$html .= "$term->slug ";
	}
	$html .="'>";
	$html .= "<div class='article_inner'>";
	$html .= "<div class='image'>".get_the_post_thumbnail()."</div>";
	$html .= "<h5><a href='". get_permalink() ."' class='more'>" . get_the_title() . "</a></h5><hr/>";
	$html .= '<p>'.strip_tags( get_the_excerpt() ).'</p><a class="view button tiny" href="'. get_permalink() .'">'. __('View','qode') .'</a>';
	$html .= "<a href='". get_permalink() ."' class='fake_link'>&nbsp;</a>";
	$html .= "</div><div class='separator'></div></article>";
						
	endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.','qode'); ?></p>
	<?php endif; 	
	wp_reset_query();	
	
	$html .= "</div></div>";
    return $html;
}
}
add_shortcode('portfolio_list', 'portfolio_list');

/* Sliders shortcode */

if (!function_exists('slider')) {
function slider($atts, $content = null) {
	extract(shortcode_atts(array("type"=>"big1","id" => "", "title"=>"", "min_height"=>""), $atts));
	$woocommerce_page_id = get_option('woocommerce_shop_page_id'); 
	$page_id = get_the_ID();
	
	$is_shop=false;
	if(function_exists("is_shop"))
		$is_shop = is_shop();

	if($is_shop){
		$sliders = get_post_meta($woocommerce_page_id, "qode_sliders", true);
	} else {
		$sliders = get_post_meta($page_id, "qode_sliders", true);
	}
		
	$html = "";
	if($type == "big1" || $type == "big2"){
		foreach($sliders as $slider) 
		{
		
			if($slider['unique'] == $id) 
			{
				$html .= '<div class="flexslider"';
				if($min_height != ""){
					$html .= ' style="min-height:' . $min_height . 'px;"';
				}
				$html .= '><ul class="slides">';
				$i=0;
				if (count($slider)>1) {
					unset($slider['unique']);
					usort($slider, "compareSlides");
				}
				while (isset($slider[$i]))
				{
						
				
					$slide = $slider[$i];
					
					$href = $slide['link'];
					//$baseurl = site_url();
					$baseurl = home_url();
					$baseurl = str_replace('http://', '', $baseurl);
					//$baseurl = str_replace('www', '', $baseurl);
					$host = parse_url($href, PHP_URL_HOST);
					if($host != $baseurl) {
						$target = 'target="_blank"';
					}
					else {
						$target = 'target="_self"';
					}
					
					$html .= '<li class="slide ' . (isset($slide['imgsize'])?$slide['imgsize']:'') . '">';
					$html .= '<div class="image"><img src="' . $slide['img'] . '" alt="' . $slide['title'] . '" /></div>';
					
					if($type == "big1"){
					
						$html .= '<div class="text ' . $slide['descposition'] . '">';
						if((isset($slide['toplabel'])?$slide['toplabel']:"") != ""){
							$html .= '<span class="toplabel">'. $slide['toplabel'] .'</span>';
						}
						if($slide['title'] != ""){
							$html .= '<h2';						
							if($slide['titlecolor'] != ""){
							$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= '>'.$slide['title'].'</h2>';
							$html .= '<hr';
							if($slide['titlecolor'] != ""){
							$html .= ' style="background-color:'. $slide['titlecolor'] .'"';
							}
							$html .= '></hr>';
						}
						$html .= '<p';
						if($slide['color'] != ""){
						$html .= ' style="color:'. $slide['color'] .'"';
						}
						$html .= '>' . $slide['description'] . '</p>';
						if($slide['link'] != ""){
						$html .=	'<a class="button tiny" ';
							if($slide['linkcolor'] != ""){
							$html .= ' style="color:'. $slide['linkcolor'] .'"';
							}
							$html .= ' href="' . $slide['link'] . '" '. $target .' >';
							if($slide['linklabel'] == ""){
								$html .= __('Read','qode');
							}else{
								$html .= $slide['linklabel'];
							}
							$html .= '</a>';
						}
						$html .= '</div>';
					
					} elseif($type == "big2"){
						
						$html .= '<div class="text type2">';
						if($slide['title'] != ""){
							$html .= '<h2';						
							if($slide['titlecolor'] != ""){
							$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= '>';
							if($slide['link'] != ""){
								$html .=	'<a';
								if($slide['titlecolor'] != ""){
									$html .= ' style="color:'. $slide['titlecolor'] .'"';
								}
								$html .= ' href="' . $slide['link'] . '" '. $target .' >';
							}
							$html .= $slide['title'].'</a></h2></div>';
						}
					}
					
					$html .= '</li>';
					$i++; 
				}
				$html .= '</ul></div>';
			}							
		}
	}
	
	if($type == "small1" || $type == "small2"){
		foreach($sliders as $slider) 
		{
		
			if($slider['unique'] == $id) 
			{
				$html .= '<div class="slider_small';
				$number = count($slider) - 1;
				if($type == "small2"){
					$html .= ' type2';
					if($number < 5){
						$html .= ' hide_arrows';
					}
				}elseif($type == "small1"){
					$html .= ' type1';
					if($number < 4){
						$html .= ' hide_arrows';
					}
				}
				
				$html .= '"';
				if($title != ""){
					if($type == "small2"){
						$html .= ' style="height: 220px;"';
					}elseif($type == "small1"){
						$html .= ' style="height: 245px;"';
					}
					
				}
				$html .= '><div class="slide_counter"><span class="slide_counter_val">'.(($type=="small1")?3:4).'</span> / <span class="slide_counter_total_val">'.(count($slider)-1).'</span></div>';
				if($title != ""){
					$html .= '<h4>' . $title . '</h4><div class="separator small"></div>';
				}
				$html .= '<div class="slider_small_holder"><div class="slider_small_holder_inner"><ul class="slider">';
				
				$i=0;
				while (isset($slider[$i]))
				{
					$slide = $slider[$i];
					
					$href = $slide['link'];
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
					$html .= '<li><div class="slide_item">';
					$html .= '<div class="image"><img src="' . $slide['img'] . '" alt="' . $slide['title'] . '" /></div>';
					$html .= '<h5>' . $slide['title'] . '</h5><hr/>';
					$html .= '<p>' . $slide['description'] . '</p>';
					if($slide['link'] != ""){
						$html .=	'<a class="button tiny" href="' . $slide['link'] . '" '. $target .' >';
						if($slide['linklabel'] == ""){
							$html .= __('Read','qode');
						}else{
							$html .= $slide['linklabel'];
						}
						$html .= '</a>';
					}
					
					if($slide['link'] != ""){
						$html .= "<a href='". $slide['link'] ."' class='fake_link'>&nbsp;</a>";
					}
					$html .= '</div></li>';
					$i++; 
				}
				$html .= '</ul></div></div></div>';
				
			}							
		}
	}
	return $html;
}
}
add_shortcode('slider', 'slider');


if (!function_exists('parallax')) {
function parallax($atts, $content = null) {
	extract(shortcode_atts(array("back_button" => "yes"), $atts));
	$html = "";
	$html .= "<section class='parallax'>" . no_wpautop($content);
	if($back_button == "yes"){
		$html .= "<div class='parallax_bottom'><a class='back_to_top' href='#'>&nbsp</a></div>";
	}
	$html .= "</section>";
	return $html;
}
}
add_shortcode('parallax', 'parallax');

if (!function_exists('parallax_section')) {
function parallax_section($atts, $content = null) {
	extract(shortcode_atts(array("id" => "", "height"=>"300"), $atts));
	$parallaxes = get_post_meta(get_the_ID(), "qode_parallaxes", true);
	$html = "";
	
	foreach($parallaxes as $parallax) 
	{	
		if($parallax['imageid'] == $id) 
			{
			$html .= '<section style="background-image:url('. $parallax['parimg'] .'); background-color:'. $parallax['parcolor'] .';" data-height="' . $height . '">';
			$html .= '<div class="parallax_content">';
			$html .= no_wpautop($content);
			$html .= '</div>';
			$html .= '</section>';
		}
								
	}
	
	return $html;
}
}
add_shortcode('parallax_section', 'parallax_section');


if (!function_exists('separator')) {
function separator($atts, $content = null) {
    extract(shortcode_atts(array("color" => "", "thickness" => "", "up" => "","down" => ""), $atts));
		$html =  '<div style="';
		if($up != ""){
		$html .= "margin-top:". $up ."px;";
		}
		if($down != ""){
		$html .= "margin-bottom:". $down ."px;"; 
		}
		if($color != ""){
		$html .= "background-color: ". $color .";";
		}
		if($thickness != ""){
		$html .= "height:". $thickness ."px;";
		}
		$html .= '" class="separator"></div>';  
		
    return $html;
}
}
add_shortcode('separator', 'separator');

if (!function_exists('separator_small')) {
function separator_small($atts, $content = null) {
    extract(shortcode_atts(array("color" => "", "thickness" => "", "up" => "","down" => ""), $atts));
		$html =  '<div style="';
		if($up != ""){
		$html .= "margin-top:". $up ."px;";
		}
		if($down != ""){
		$html .= "margin-bottom:". $down ."px;"; 
		}
		if($color != ""){
		$html .= "background-color: ". $color .";";
		}
		if($thickness != ""){
		$html .= "height:". $thickness ."px;";
		}
		$html .= '" class="separator small"></div>';  
		
    return $html;
}
}
add_shortcode('separator_small', 'separator_small');

if (!function_exists('social_icons')) {
function social_icons($atts, $content = null) {
    extract(shortcode_atts(array("style" => ""), $atts));
    $html = ""; 
    $html .=  "       <ul class='social_menu $style'>";  
    $social_icons_array = explode(",", $content);
    for ($i = 0 ; $i < count($social_icons_array) ; $i = $i + 2)
    {
    $html .=  "<li class='" . trim($social_icons_array[$i]) . "'><a href='" . trim($social_icons_array[$i + 1]) . "' target='_blank'>" . trim($social_icons_array[$i]) . "</a></li>";   
    }
     $html .=  "           </ul>";


    return $html;
}
}
add_shortcode('social_icons', 'social_icons');

/* Services shortcode */

if (!function_exists('service')) {
function service($atts, $content = null) {
    $html = ""; 
	extract(shortcode_atts(array("type"=>"top", "title" => "", "link" => "") , $atts));	
	$html .= '<div class="circle_item circle_'.$type.'">';
	if ($link == "")
		$html .= '<div class="circle"><div>'.$title.'</div></div><div class="text">';
	else
		$html .= '<div class="circle"><div><a href="'.$link.'">'.$title.'</a></div></div><div class="text">';
	$html .= no_wpautop($content);
	$html .= '</div></div>';
	
	return $html;
}
}
add_shortcode('service', 'service');


/* Video shortcode */

if (!function_exists('video')) {
function video($atts, $content = null) {
    $html = ""; 
	extract(shortcode_atts(array("type"=>"youtube", "id"=>"", "width"=>"", "height"=>"") , $atts));	
	$html .= "<div class='video_holder'>"; 
	if($type == 'youtube'){
		$html .= '<iframe title="YouTube video player" width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>';
	}elseif($type == 'vimeo'){
		$html .= '<iframe src="http://player.vimeo.com/video/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>';
	}
	$html .= "</div>"; 
	return $html;
}
}
add_shortcode('video', 'video');

if (!function_exists('blog_latest')) {
function blog_latest($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array("number"=>"3", "type"=>"type1"), $atts));
	
	$args = array(
	'post_type'=> 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => $number
	);
	query_posts( $args );
	
	if($type == 'type1'){
	
		$html .= '<div class="posts_holder3 clearfix">';
			$post_count = 0;
			if(have_posts()) :
				$html .= '<div class="clearfix">';
				while ( have_posts() ) : the_post();
					if ((($post_count%3)==0) && ($post_count > 0)) {
					$html .= '</div><div class="clearfix">';
					}
					$html .= '<article>';
					$html .= '<div class="article_inner">';
						
							$html .= '<div class="image">';
								$html .= '<a href="'. get_permalink() .'" title="'.get_the_title().'">';
										$html .= get_the_post_thumbnail(get_the_ID(),'blog-type-3-big');
								$html .= '</a>';
							$html .= '</div>';
						
						$html .= '<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
						$html .= '<div class="text">';
							$html .= '<div class="text_inner"><span>';
								$html .= __('Posted by','qode') .' '.get_the_author().' '. __('in','qode') .' ';
								$categories = get_the_category();
								$separator = ',';
								$output = '';
								if($categories){
									foreach($categories as $category) {
										$output .= '<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
									}
								$html .= trim($output, $separator);
								}
								$html .= '</span><p>'. get_the_excerpt() .'</p>';
							$html .= '</div>';
						$html .= '</div>';
						 $html .= '<div class="info">';
							 $html .= '<span class="left"><a href="'. get_comments_link() .'">';
							 
								$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
								if ( comments_open() ) {
									if ( $num_comments == 0 ) {
										$comments = __('no comments');
									} elseif ( $num_comments > 1 ) {
										$comments = $num_comments . __(' comments');
									} else {
										$comments = __('one comment');
									}
								} else {
									$comments =  __('Comments are off for this post.');
								}
							 $html .= $comments;
							 $html .= '</a></span>';
							 $html .= '<span class="right"> <a href="'. get_permalink() .'" class="more" title="'. get_the_title() .'">'. __('READ MORE', 'qode') .'</a></span>';
						 $html .= '</div>';
					$html .= '</div>';
				$html .= '</article>';
				$post_count++;
				endwhile;
				$html .= '</div>';
			else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.','qode'); ?></p>
			<?php
			endif;
			wp_reset_query();	
			$html .= '</div>';
	
	}elseif($type == 'type2'){
	
	$html .= "<div class='portfolio_outer'><div class='portfolio_holder portfolio_holder_v3'>";
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
	$html .= "<article class='element'>";
	$html .= "<div class='article_inner'>";
	$html .= "<div class='image'>".get_the_post_thumbnail()."</div>";
	$html .= "<h5><a href='". get_permalink() ."' class='more'>" . get_the_title() . "</a></h5><hr/>";
	$html .= '<p>'.strip_tags( get_the_excerpt() ).'</p><a class="view button tiny" href="'. get_permalink() .'">'. __('View','qode') .'</a>';
	$html .= "<a href='". get_permalink() ."' class='fake_link'>&nbsp;</a>";
	$html .= "</div><div class='separator'></div></article>";
						
	endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.','qode'); ?></p>
	<?php endif; 	
	wp_reset_query();	
	
	$html .= "</div></div>";
	}
  return $html;
	
}
}
add_shortcode('blog_latest', 'blog_latest');


/* Latest product shortcode */

if (!function_exists('latest_products')) {
function latest_products($atts, $content = null) {
	return "";
}
}
add_shortcode('latest_products', 'latest_products');
?>