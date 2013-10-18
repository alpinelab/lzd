<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class BSKFileManagerFiles extends WP_List_Table {
   
	var $_categories_db_tbl_name = '';
	var $_files_db_tbl_name = '';
	var $_files_upload_path = '';
	var $_files_upload_folder = '';

	var $_plugin_pages_name = array();
	
    function __construct( $args = array() ) {
        
        //Set parent defaults
        parent::__construct( array( 
            'singular' => 'bsk-files-manager-files',  //singular name of the listed records
            'plural'   => 'bsk-files-manager-files', //plural name of the listed records
            'ajax'     => false                          //does this table support ajax?
        ) );
       
	   $this->_categories_db_tbl_name = $args['categories_db_tbl_name'];
	   $this->_files_db_tbl_name = $args['files_tbl_name'];
	   $this->_files_upload_path = $args['file_upload_path'];
	   $this->_files_upload_folder = $args['file_upload_folder'];
	   $this->_plugin_pages_name = $args['pages_name_A'];
	   
	   $this->_files_upload_path = $this->_files_upload_path.$this->_files_upload_folder;
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) {
			case 'id':
				echo $item['id'];
				break;
			case 'title':
				echo $item['title'];
				break;
            case 'file_name':
                echo $item['file_name'];
                break;
			case 'extension':
                echo $item['extension'];
                break;
			case 'shortcode':
				echo $item['shortcode'];
				break;
			case 'last_date':
               	echo $item['last_date'];
                break;
        }
    }
   
    function column_cb( $item ) {
        return sprintf( 
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            esc_attr( $this->_args['singular'] ),
            esc_attr( $item['id'] )
        );
    }

    function get_columns() {
    	
		$columns = array(
							'cb'        		=> '<input type="checkbox"/>',
							'id'				=> 'ID',
							'title'     		=> 'Title',
							'file_name'     	=> 'File Name',
							'extension'			=> 'Extension',
							'shortcode'     	=> 'Shortcode',
							'last_date' 		=> 'Last Date'
						);
        
        return $columns;
    }
	
	function get_sortable_columns() {
		$c = array(
					'title' => 'title',
					'last_date'    => 'last_date',
					'extension'    => 'extension'
					);
		
		return $c;
	}
   
    function get_views() {
		global $wpdb;
		
		$sql = 'SELECT * FROM '.$this->_categories_db_tbl_name;
		$categoreies = $wpdb->get_results($sql);
		
		$select_str_header = '<select name="bsk_files_manager_categories" id="bsk_files_manager_categories_id">';
		$select_str_footer = '</select>';
		
		if (!$categoreies || count($categoreies) < 1){
			$select_str_body = '<option value="0">Please add category first</option>';
		}else{
			$current_category_id = $_REQUEST['cat'];
			if ($current_category_id < 1){
				$current_category_id = $_REQUEST['bsk_files_manager_file_edit_categories'];
			}
			$select_str_body = '<option value="0">Please select category</option>';
			foreach($categoreies as $category){
				if ($current_category_id == $category->id){
					$select_str_body .= '<option value="'.$category->id.'" selected>'.$category->cat_title.'</option>';
				}else{
					$select_str_body .= '<option value="'.$category->id.'">'.$category->cat_title.'</option>';
				}
			}
		}
		
		$views = array('filter' => $select_str_header.$select_str_body.$select_str_footer);
		
        return $views;
    }
   
    function get_bulk_actions() {
    
        $actions = array( 
            'delete'=> 'Delete'
        );
        
        return $actions;
    }

    function do_bulk_action() {
		global $wpdb;
		
		$lists_id = isset( $_POST['bsk-files-manager-files'] ) ? $_POST['bsk-files-manager-files'] : false;
		if ( !$lists_id || !is_array( $lists_id ) || count( $lists_id ) < 1 ){
			return;
		}
		$ids = implode(',', $lists_id);
		$ids = trim($ids,',');
		
		//delete all files
		$sql = 'SELECT * FROM `'.$this->_files_db_tbl_name.'` WHERE id IN('.$ids.')';
		$pdfs_records = $wpdb->get_results( $sql );
		if ($pdfs_records && count($pdfs_records) > 0){
			foreach($pdfs_records as $pdf_record ){
				if( $pdf_record->file_name && file_exists($this->_files_upload_path.$pdf_record->file_name) ){
					unlink($this->_files_upload_path.$pdf_record->file_name);
				}
			}
		}
		
		$sql = 'DELETE FROM `'.$this->_files_db_tbl_name.'` WHERE id IN('.$ids.')';
		$wpdb->query( $sql );
    }

    function get_data() {
		global $wpdb;
		
        // check to see if we are searching
        if( isset( $_POST['s'] ) ) {
            $search = trim( $_POST['s'] );
        }
		$current_category_id = $_REQUEST['cat'];
		if ($current_category_id < 1){
			$current_category_id = $_POST['bsk_files_manager_file_edit_categories'];
		}
		if ( isset( $_REQUEST['orderby'] ) ){
			$orderby = $_REQUEST['orderby'];
		}
		if ( isset( $_REQUEST['order'] ) ){
			$order = $_REQUEST['order'];
		}
		
		$sql = 'SELECT * FROM '.
		       $this->_files_db_tbl_name.' AS l';

		$search_fields = ' l.title LIKE "%'.$search.'%"';
						 
		$whereCase = $search ? $search_fields : '';
		$orderCase = ' ORDER BY l.last_date DESC';
		if ( $orderby ){
			$orderCase = ' ORDER BY l.'.$orderby.' '.$order;
		}
		$whereCase = $whereCase ? ' WHERE l.cat_id = '.$current_category_id.' AND '.$whereCase : ' WHERE l.cat_id = '.$current_category_id;

		$all_files = $wpdb->get_results($sql.$whereCase.$orderCase);
		
		if (!$all_files || count($all_files) < 1){
			return NULL;
		}
		
		
		$base = admin_url( 'admin.php?page='.$this->_plugin_pages_name['files'] );
		$edit_url = add_query_arg('view', 'edit', $base);
		$lists_data = array();
		foreach($all_files as $pdf_record){
			$edit_url = add_query_arg('id', $pdf_record->id, $edit_url);
			$file_str = '';
			if( $pdf_record->file_name && file_exists($this->_files_upload_path.$pdf_record->file_name) ){
				$file_url = get_option('home').'/'.$this->_files_upload_folder.$pdf_record->file_name;
				$file_str =  '<a href="'.$file_url.'" target="_blank">'.$pdf_record->file_name.'</a>';
			}
			$shortcode_str = $file_str ? '[bsk-files-manager-file id='.$pdf_record->id.']' : '';
			$lists_data[] = array( 
								'id' 				=> $pdf_record->id,
								'title'     		=> '<a href="'.$edit_url.'">'.$pdf_record->title.'</a>',
								'file_name'     	=> $file_str,
								'extension'     	=> $pdf_record->extension,
								'shortcode'			=> $shortcode_str,
								'last_date' 		=> $pdf_record->last_date,
								 );
		}
		
		return $lists_data;
    }

    function prepare_items() {
       
        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 20;
        $data = array();
		
        add_thickbox();

        $columns = $this->get_columns();
        $hidden = array(); // no hidden columns
       
        $this->_column_headers = array( $columns, $hidden );
       
        $this->do_bulk_action();
       
        $data = $this->get_data();
   
        $current_page = $this->get_pagenum();
    
        $total_items = count( $data );
       
	    if ($total_items > 0){
        	$data = array_slice( $data,( ( $current_page-1 )*$per_page ),$per_page );
		}
       
        $this->items = $data;

        $this->set_pagination_args( array( 
            'total_items' => $total_items,                  // We have to calculate the total number of items
            'per_page'    => $per_page,                     // We have to determine how many items to show on a page
            'total_pages' => ceil( $total_items/$per_page ) // We have to calculate the total number of pages
        ) );
        
    }
	
	function get_column_info() {

		 $columns = array( 
							'cb'        		=> '<input type="checkbox"/>',
							'id'				=> 'ID',
							'title'     		=> 'Title',
							'file_name'     	=> 'File Name',
							'extension'     	=> 'extension',
							'shortcode'     	=> 'Shortcode',
							'last_date' 		=> 'Last Date'
						);
		
		$hidden = array();

		$_sortable = apply_filters( "manage_{$screen->id}_sortable_columns", $this->get_sortable_columns() );

		$sortable = array();
		foreach ( $_sortable as $id => $data ) {
			if ( empty( $data ) )
				continue;

			$data = (array) $data;
			if ( !isset( $data[1] ) )
				$data[1] = false;

			$sortable[$id] = $data;
		}

		$_column_headers = array( $columns, $hidden, $sortable );


		return $_column_headers;
	}   
}