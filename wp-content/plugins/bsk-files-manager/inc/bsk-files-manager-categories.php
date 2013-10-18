<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class BSKFileManagerCategories extends WP_List_Table {
   
	var $_categories_db_tbl_name = '';
	var $_files_db_tbl_name = '';
	var $_files_upload_path = '';
	var $_files_upload_folder = '';
	var $_bsk_files_manager_managment_obj = NULL;
	var $_bsk_categories_page_name = '';
	
	var $_plugin_pages_name = array();
   
    function __construct( $args = array() ) {
        
        //Set parent defaults
        parent::__construct( array( 
            'singular' => 'bsk-files-manager-categories',  //singular name of the listed records
            'plural'   => 'bsk-files-manager-categories', //plural name of the listed records
            'ajax'     => false                          //does this table support ajax?
        ) );
       
	   $this->_categories_db_tbl_name = $args['categories_db_tbl_name'];
	   $this->_files_db_tbl_name = $args['files_tbl_name'];
	   $this->_files_upload_path = $args['file_upload_path'];
	   $this->_files_upload_folder = $args['file_upload_folder'];
	   $this->_bsk_files_manager_managment_obj = $args['management_obj'];
	   $this->_plugin_pages_name = $args['pages_name_A'];
	   
	   $this->_bsk_categories_page_name = $this->_plugin_pages_name['category'];
	   
	   $this->_files_upload_path = $this->_files_upload_path.$this->_files_upload_folder;
	   
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) {
			case 'id':
				echo $item['id'];
				break;
			case 'cat_title':
				echo $item['cat_title'];
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
            'cat_title'     	=> 'Title',
			'shortcode'     	=> 'Shortcode',
            'last_date' 		=> 'Date'
        );
        
        return $columns;
    }
   
	function get_sortable_columns() {
		$c = array(
					'cat_title' => 'cat_title',
					'last_date'    => 'last_date'
					);
		
		return $c;
	}
	
    function get_views() {
		//$views = array('filter' => '<select name="a"><option value="1">1</option></select>');
		
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
		
		$categories_id = isset( $_POST['bsk-files-manager-categories'] ) ? $_POST['bsk-files-manager-categories'] : false;
		if ( !$categories_id || !is_array( $categories_id ) || count( $categories_id ) < 1 ){
			return;
		}
		$action = -1;
		if ( isset($_POST['action']) && $_POST['action'] != -1 ){
			$action = $_POST['action'];
		}
		if ( isset($_POST['action2']) && $_POST['action2'] != -1 ){
			$action = $_POST['action2'];
		}
		if ( $action == -1 ){
			return;
		}else if ( $action == 'delete' ){
			$ids = implode(',', $categories_id);
			$ids = trim($ids);
			$sql = 'DELETE FROM `'.$this->_categories_db_tbl_name.'` WHERE id IN('.$ids.')';
			$wpdb->query( $sql );
	
			//when one category deleted all lists under it will be removed also
			$sql = 'SELECT * FROM `'.$this->_files_db_tbl_name.'` WHERE cat_id IN('.$ids.')';
			$pdfs = $wpdb->get_results( $sql );
			if ($pdfs && count($pdfs) > 0){
				foreach($pdfs as $files){
					if ( $files->file_name && file_exists($this->_files_upload_path.$files->file_name) ){
						unlink($this->_files_upload_path.$files->file_name);
					}
				}
			}
			
			$sql = 'DELETE FROM `'.$this->_files_db_tbl_name.'` WHERE cat_id IN('.$ids.')';
			$wpdb->query( $sql );
		}
    }

    function get_data() {
		global $wpdb;
		
        // check to see if we are searching
        if( isset( $_POST['s'] ) ) {
            $search = trim( $_POST['s'] );
        }
		if ( isset( $_REQUEST['orderby'] ) ){
			$orderby = $_REQUEST['orderby'];
		}
		if ( isset( $_REQUEST['order'] ) ){
			$order = $_REQUEST['order'];
		}
		
		$sql = 'SELECT * FROM '.
		       $this->_categories_db_tbl_name.' AS c';

		$whereCase = $search ? ' c.cat_title LIKE "%'.$search.'%"' : '';
		$orderCase = ' ORDER BY c.last_date DESC';
		if ( $orderby ){
			$orderCase = ' ORDER BY c.'.$orderby.' '.$order;
		}
		$whereCase = $whereCase ? ' WHERE '.$whereCase : '';
		
		$catgories = $wpdb->get_results($sql.$whereCase.$orderCase);
		
		if (!$catgories || count($catgories) < 1){
			return NULL;
		}
		$base = admin_url( 'admin.php?page=bsk-files-manager' );
		
		$categories_data = array();
		foreach ( $catgories as $category ) {
			$category_edit_page = add_query_arg( array('view' => 'edit', 
													   'categoryid' => $category->id),
												 $base );
			$categories_data[] = array( 
				'id' 				=> $category->id,
				'cat_title'     	=> '<a href="'.$category_edit_page.'">'.$category->cat_title.'</a>',
				'last_date'			=> $category->last_date,
				'shortcode'			=> '[bsk-files-manager-list-category id='.$category->id.']'
			);
		}
		
		return $categories_data;
    }

    function prepare_items() {
       
        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 20;
        $data = array();
		
        add_thickbox();

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
							'cat_title'     	=> 'Title',
							'shortcode'     	=> 'Shortcode',
							'last_date' 		=> 'Date'
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