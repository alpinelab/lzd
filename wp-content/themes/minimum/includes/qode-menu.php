<?php

/* Custom WP_NAV_MENU function for top navigation - TYPE 1 */
if (!class_exists('qode_type1_walker_nav_menu')) {
class qode_type1_walker_nav_menu extends Walker_Nav_Menu {
	var $item_display_no = 0;
	var $level2_no = 0;
  
// add classes to ul sub-menus
  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_lvl( &$output, $depth ) {
		$out_div = ($depth == 0 ? '<div class="second"><div class="inner"><div class="inner2"><div class="inner2a"><div class="mc">' : '');
	
		// build html
		$output .= "\n" . $out_div  . "\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$out_div_close = ($depth == 0 ? '</div></div></div></div></div>' : '');
		
		// build html
		$output .=  $out_div_close ."\n";
	}

	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		global $qode_options;
		$sub_class = "no_sub";
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		if($depth==1 && $args->has_children) : 
			$sub_class = 'have_sub';
		elseif($depth==2) : 
			$sub_class = 'sub';
		endif;
		$clrfix = '';
		if (($this->level2_no%4)==0) $clrfix = '</div><div class="inner2a">';
		if (($depth == 1) && ($this->item_display_no > 0))
			$output .= '</div>'.$clrfix.'<div class="mc">';
		
		//number of sub items in one column
		if($qode_options['separation_number'] != ""):
			$separation_number = $qode_options['separation_number'];
		else:
			$separation_number = 6;
		endif;
		
		// depth dependent classes
		$qode_animation = "";
		$active = "";
		if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
		if ((($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0)) && (($qode_options['page_transitions'] == "0") || ($qode_animation == "no"))):
			
				$active = 'active';
			
		endif;
	
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	  
		// build html
		if ($depth == 0) $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . '">';
	  else  $output .= '';
	  
		$current_a = "";
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
		$current_a .= ' current ';
		endif;
		$attributes .= ' class="'. $current_a . ' '.$sub_class. '"';
		
		$hr = "";
		if($depth==1) $hr = '<hr/>';
		if($depth>1) $hr = '<br/>';
	  
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s'.$hr,
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		
		if($depth==0) $this->item_display_no = 0;
		if($depth==0) $this->level2_no = 0;
		
		//if ((($this->item_display_no%$separation_number) == 0) && ($this->item_display_no>0)) $output .= '</div><div class="mc">';
		
		if($depth>0) $this->item_display_no++;
		if($depth==1) $this->level2_no++;
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ($depth == 0) $output .= "</li>\n";
	  else  $output .= "\n";
	}
	
}
}

/* Custom WP_NAV_MENU function for top navigation - TYPE 2 */

if (!class_exists('qode_type2_walker_nav_menu')) {
class qode_type2_walker_nav_menu extends Walker_Nav_Menu {
  
// add classes to ul sub-menus
  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_lvl( &$output, $depth ) {
		
		$indent = str_repeat("\t", $depth);
		$out_div = ($depth == 0 ? '<div class="second"><div class="inner"><div class="inner2">' : '');
	
		// build html
		$output .= "\n" . $indent . $out_div  .'<ul>' . "\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$out_div_close = ($depth == 0 ? '</div></div></div>' : '');
		$output .= "$indent</ul>". $out_div_close ."\n";
	}

	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		global $qode_options;
		$sub = "";
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		if($depth==1 && $args->has_children) : 
			$sub = 'sub';
			
	
		endif;
		
		$qode_animation = "";
		$active = "";
		if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
		// depth dependent classes
		if ((($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0)) && (($qode_options['page_transitions'] == "0") || ($qode_animation == "no"))):
			
				$active = 'active';
			
		endif;
	
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	  
		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub .'">';
	  
		$current_a = "";
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
		$current_a .= ' current ';
		endif;
		$attributes .= ' class="'. $current_a . '"';
	  
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
}
}

/* Custom WP_NAV_MENU function for top navigation backup - TYPE 2 */
if (!function_exists('top_navigation_fallback')) {
function top_navigation_fallback() { ?>
	
    <ul>
	
	<?php 
		global $wp_query;
		$ancestors = $wp_query->post->ancestors;
		$args = array(
		'hierarchical' => 0,
		'parent' => 0
		); 
		$pages = get_pages($args);
		foreach($pages as $page): 
		?>
			<li <?php if(($wp_query->get_queried_object_id()==$page->ID) || (is_singular('post') && $page->ID == get_option('page_for_posts') ) || in_array($page->ID, $ancestors) ) { echo "class='active'";}?>>
				<a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
				<?php $subpages=get_pages('hierarchical=0&parent=' . $page->ID);
				if(!empty($subpages)) { ?> 
					<div class="second">
							<div class="inner">
								<div class="inner2">
									<ul>
										<?php foreach($subpages as $page) : ?>
												<li <?php if(($wp_query->get_queried_object_id()==$page->ID) || (is_singular('post') && $page->ID == get_option('page_for_posts') )) { echo "class='current'";}?>>
													<a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
														<?php $subpages=get_pages('hierarchical=0&parent=' . $page->ID);
															if(!empty($subpages)) { ?> 
					
																<ul>
																	<?php foreach($subpages as $page) : ?>
																			<li <?php if(($wp_query->get_queried_object_id()==$page->ID) || (is_singular('post') && $page->ID == get_option('page_for_posts') )) { echo "class='current'";}?>>
																				<a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
																				<?php $subpages=get_pages('hierarchical=0&parent=' . $page->ID);
																					if(!empty($subpages)) { ?> 
											
																						<ul>
																							<?php foreach($subpages as $page) : ?>
																									<li <?php if(($wp_query->get_queried_object_id()==$page->ID) || (is_singular('post') && $page->ID == get_option('page_for_posts') )) { echo "class='current'";}?>>
																										<a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
																											
																									</li>
																							
																							<?php endforeach; ?>
																						</ul>
												
																						<?php } ?>	
																			</li>
																	
																	<?php endforeach; ?>
																</ul>
						
																<?php } ?>
												</li>
													
										<?php endforeach; ?>
									</ul>
								</div>
							</div>	
					</div>
					<?php } ?>
			</li>
			
		<?php endforeach; ?>
		
	</ul>
    
	
 <?php }
}
