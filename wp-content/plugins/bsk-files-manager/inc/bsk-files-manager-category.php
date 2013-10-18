<?php

class BSKFileManagerCategory {

	var $_categories_db_tbl_name = '';
	var $_files_db_tbl_name = '';
	var $_files_upload_path = '';
	var $_files_upload_folder = '';
	var $_bsk_categories_page_name = '';
	
	var $_plugin_pages_name = array();
	var $_open_target_option_name = '';
	var $_show_category_title_when_listing_files = '';
   
	public function __construct( $args ) {
		global $wpdb;
		
		$this->_categories_db_tbl_name = $args['categories_db_tbl_name'];
	    $this->_files_db_tbl_name = $args['files_tbl_name'];
		$this->_files_upload_path = $args['file_upload_path'];
	    $this->_files_upload_folder = $args['file_upload_folder'];
		$this->_plugin_pages_name = $args['pages_name_A'];
		$this->_open_target_option_name = $args['open_target_option_name'];
		$this->_show_category_title_when_listing_files = $args['show_category_title'];
		
		$this->_bsk_categories_page_name = $this->_plugin_pages_name['category'];
		
		add_action('bsk_files_manager_category_save', array($this, 'bsk_files_manager_category_save_fun'));
		
		add_shortcode('bsk-files-manager-list-category', array($this, 'bsk_files_manager_list_files_by_cat') );
	}
	
	function bsk_files_manager_category_edit( $category_id = -1 ){
		global $wpdb;
		
		$cat_title = '';
		if ($category_id > 0){
			$sql = 'SELECT * FROM '.$this->_categories_db_tbl_name.' WHERE id = '.$category_id;
			$category_obj_array = $wpdb->get_results( $sql );
			if (count($category_obj_array) > 0){
				$cat_title = $category_obj_array[0]->cat_title;
			}
		}
		
		$str = '<div class="bsk_files_manager_category_edit">';
		$str .='<h4>Category Title</h4>';
		$str .='<p><input type="text" name="cat_title" id="cat_title_id" value="'.$cat_title.'" maxlength="512" /></p>';
		$str .='<p>
					<input type="hidden" name="bsk_files_manager_action" value="category_save" />
					<input type="hidden" name="bsk_files_manager_category_id" value="'.$category_id.'" />'.
					wp_nonce_field( plugin_basename( __FILE__ ), 'bsk_files_manager_category_save_oper_nonce', true, false ).'
				</p>
				</div>';
		
		echo $str;
	}
	
	function bsk_files_manager_category_save_fun( $data ){
		global $wpdb;
		//check nonce field
		if ( !wp_verify_nonce( $data['bsk_files_manager_category_save_oper_nonce'], plugin_basename( __FILE__ ) ) ){
			return;
		}
		
		if ( !isset($data['bsk_files_manager_category_id']) ){
			return;
		}
		$id = $data['bsk_files_manager_category_id'];
		$title = trim($data['cat_title']);
		$last_date = date( 'Y-m-d H:i:s', current_time('timestamp') );
		
		if (get_magic_quotes_gpc() || empty($quotes_sybase) || $quotes_sybase === 'off'){
			$title = stripcslashes($title); 
		}
		
		if ( $id > 0 ){
			$wpdb->update( $this->_categories_db_tbl_name, array( 'cat_title' => $title, 'last_date' => $last_date), array( 'id' => $id ) );
		}else if($id == -1){
			//insert
			$wpdb->insert( $this->_categories_db_tbl_name, array( 'cat_title' => $title, 'last_date' => $last_date) );
		}
		
		$redirect_to = admin_url( 'admin.php?page='.$this->_bsk_categories_page_name );
		wp_redirect( $redirect_to );
		exit;
	}
	
	function bsk_files_manager_list_files_by_cat($atts, $content){
		global $wpdb;
		
		shortcode_atts( array('id' => 0,
							  'extension' => ''), 
						$atts );
		$cat_id = $atts['id'];
		$extension_sql = trim($atts['extension']) ? ' AND extension LIKE "'.strtolower(trim($atts['extension'])).'" ' : ' ';
	
		$sql = "SELECT * FROM `".$this->_categories_db_tbl_name."` WHERE id = $cat_id ORDER BY `cat_title` ASC";
		$categories = $wpdb->get_results($sql, ARRAY_A);
		if (count($categories) < 1) {
			return "";
		}
		
		$home_url = get_option('home');
		$show_cat_title = get_option($this->_show_category_title_when_listing_files, false);
		foreach( $categories as $category){
			$forStr .=	'<div class="bsk-files-category">'."\n";
			if($show_cat_title){
				$forStr .=	'<h2>'.$category['cat_title'].'</h2>'."\n";
			}
			//get files items in the category
			$sql = "SELECT * FROM `".$this->_files_db_tbl_name."` WHERE `cat_id` = ".$category['id']." $extension_sql order by `title` ASC";
			$pdf_items = $wpdb->get_results($sql, ARRAY_A);
			if (count($pdf_items) < 1){
				continue;
			}
			$forStr .= '<ul>'."\n";
			$open_target_str = get_option($this->_open_target_option_name, '');
			if ($open_target_str){
				$open_target_str = 'target="'.$open_target_str.'"';
			}
			foreach($pdf_items as $pdf_item){
				if ( $pdf_item['file_name'] && file_exists($this->_files_upload_path.$this->_files_upload_folder.$pdf_item['file_name']) ){
					$file_url = $home_url.'/'.$this->_files_upload_folder.$pdf_item['file_name'];
					$forStr .= '<li><a href="'.$file_url.'" '.$open_target_str.'>'.$pdf_item['title'].'</a></li>'."\n";
				}
			}
			$forStr .= '</ul>'."\n";

			$forStr .=  '</div>'."\n";
		}
	
		
		return $forStr;
	}

}