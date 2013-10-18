<?php
class BSKFileManagerDashboard {

	var $_bsk_files_manager_OBJ = NULL;
	var $_bsk_files_manager_OBJ_categories = NULL;
	var $_bsk_files_manager_OBJ_category = NULL;
	var $_bsk_files_manager_OBJ_files = NULL;
	var $_bsk_files_manager_OBJ_file = NULL;
	var $_bsk_files_manager_OBJ_settings_support = NULL;
	
	var $_bsk_categories_page_name = '';
	var $_bsk_files_page_name = '';
	var $_bsk_settings_support_page = '';
	
	var $_bsk_open_target_option_name = '_bsk_files_manager_open_target';
	var $_bsk_category_list_has_title = '_bsk_files_manager_category_list_has_title';
	
	var $_obj_init_args = array();

	public function __construct( $arg ) {
		global $wpdb;
		
		$this->_bsk_categories_page_name = $arg['pages_name_A']['category'];
		$this->_bsk_files_page_name = $arg['pages_name_A']['files'];
		$this->_bsk_settings_support_page = $arg['pages_name_A']['setting'];				
		
		$this->_obj_init_args['categories_db_tbl_name'] = $arg['cat_tbl_name'];
		$this->_obj_init_args['files_tbl_name'] = $arg['files_tbl_name'];
		$this->_obj_init_args['file_upload_path'] = $arg['upload_path'];
		$this->_obj_init_args['file_upload_folder'] = $arg['upload_folder'];
		$this->_obj_init_args['pages_name_A'] = $arg['pages_name_A'];
		$this->_obj_init_args['open_target_option_name'] = $this->_bsk_open_target_option_name;
		$this->_obj_init_args['show_category_title'] = $this->_bsk_category_list_has_title;
		
		require_once( 'bsk-files-manager-categories.php' );
		require_once( 'bsk-files-manager-category.php' );
		require_once( 'bsk-files-manager-file.php' );	
		require_once( 'bsk-files-manager-files.php' );
		require_once( 'bsk-files-manager-settings-support.php' );
		
		$this->_bsk_files_manager_OBJ_category = new BSKFileManagerCategory( $this->_obj_init_args );		
		$this->_bsk_files_manager_OBJ_file = new BSKFileManagerFile( $this->_obj_init_args );	
		$this->_bsk_files_manager_OBJ_settings_support = new BSKFileManagerSettingsSupport( $this->_obj_init_args );	
		
		add_action("admin_menu", array( $this, 'bsk_files_manager_dashboard_menu' ) );	
	}
	
	function bsk_files_manager_dashboard_menu() {
	
		if ( !$this->bsk_files_manager_current_user_can() ){
			return;
		}
		
		$authorized_level = 'level_10';
		
		add_menu_page('BSK Files Manager', 'BSK Files Manager', $authorized_level, 'bsk-files-manager');
		add_submenu_page( $this->_bsk_categories_page_name,
						  'Categories', 
						  'Categories',
						  $authorized_level, 
						  $this->_bsk_categories_page_name, 
						  array($this, 'bsk_files_manager_categories') );

		add_submenu_page( $this->_bsk_categories_page_name, 
						  'Files', 
						  'Files', 
						  $authorized_level, 
						  $this->_bsk_files_page_name, 
						  array($this, 'bsk_files_manager_files') );						  
		
		add_submenu_page( $this->_bsk_categories_page_name, 
						  'Settings & Support', 
						  'Settings & Support', 
						  $authorized_level, 
						  $this->_bsk_settings_support_page, 
						  array($this, 'bsk_files_manager_settings_support') );					  
	}
	
	function bsk_files_manager_categories(){
		global $current_user;
		
		if (!$this->bsk_files_manager_current_user_can()){
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		$this->_bsk_files_manager_OBJ_categories = new BSKFileManagerCategories( $this->_obj_init_args );

		$categories_curr_view = 'list';
		if(isset($_GET['view']) && $_GET['view']){
			$categories_curr_view = trim($_GET['view']);
		}
		if(isset($_POST['view']) && $_POST['view']){
			$categories_curr_view = trim($_POST['view']);
		}
		
		if ($categories_curr_view == 'list'){
			//Fetch, prepare, sort, and filter our data...
			$this->_bsk_files_manager_OBJ_categories->prepare_items();
			
			$category_add_new_page = admin_url( 'admin.php?page='.$this->_bsk_categories_page_name );
			$category_add_new_page = add_query_arg( 'view', 'addnew', $category_add_new_page );
	
			echo '<div class="wrap">
					<div id="icon-edit" class="icon32"><br/></div>
					<h2>BSK Files Manager -- Categories<a href="'.$category_add_new_page.'" class="add-new-h2">Add New</a></h2>
					<form id="bsk-files-manager-categories-form-id" method="post">
						<input type="hidden" name="page" value="bsk-files-manager" />';
						$this->_bsk_files_manager_OBJ_categories->search_box( 'search', 'bsk-files-manager' );
						$this->_bsk_files_manager_OBJ_categories->views();
						$this->_bsk_files_manager_OBJ_categories->display();
			echo '  </form>
					<p>* You may use [bsk-files-manager-list-category id=xx extension="zip"] to show all files under category id is xx and with an extension of zip .</p>
				  </div>';
		}else if ( $categories_curr_view == 'addnew' || $categories_curr_view == 'edit'){
			$category_id = -1;
			if(isset($_GET['categoryid']) && $_GET['categoryid']){
				$category_id = trim($_GET['categoryid']);
			}	
			echo '<div class="wrap">
					<div id="icon-edit" class="icon32"><br/></div>
					<h2>BSK Files Manager -- Category</h2>
					<form id="bsk-files-manager-category-edit-form-id" method="post">
					<input type="hidden" name="page" value="bsk-files-manager" />
					<input type="hidden" name="view" value="list" />';
					$this->_bsk_files_manager_OBJ_category->bsk_files_manager_category_edit( $category_id );
			echo   '<p style="margin-top:20px;"><input type="button" id="bsk_files_manager_category_save" class="button-primary" value="Save" /></p>'."\n";
			echo '</div>';
		}
	}
	
	function bsk_files_manager_files(){
		global $current_user;
		
		if (!$this->bsk_files_manager_current_user_can()){
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		
		$this->_bsk_files_manager_OBJ_files = new BSKFileManagerFiles( $this->_obj_init_args );
		
		$lists_curr_view = 'list';
		if(isset($_GET['view']) && $_GET['view']){
			$lists_curr_view = trim($_GET['view']);
		}
		if(isset($_POST['view']) && $_POST['view']){
			$lists_curr_view = trim($_POST['view']);
		}
		
		if ($lists_curr_view == 'list'){
			//Fetch, prepare, sort, and filter our data...
			$this->_bsk_files_manager_OBJ_files->prepare_items();
			$add_new_page = admin_url( 'admin.php?page='.$this->_bsk_files_page_name );
			$add_new_page = add_query_arg( 'view', 'addnew', $add_new_page );
	
			echo '<div class="wrap">
					<div id="icon-edit" class="icon32"><br/></div>
					<h2>BSK Files Manager -- Files <a href="'.$add_new_page.'" class="add-new-h2">Add New</a></h2>
					<form id="bsk-files-manager-files-form-id" method="post" action="'.admin_url( 'admin.php?page='.$this->_bsk_files_page_name ).'">
						<input type="hidden" name="page" value="'.$this->_bsk_files_page_name.'" />
						<input type="hidden" name="view" value="list" />';
						$this->_bsk_files_manager_OBJ_files->search_box( 'search', 'bsk-files-manager-pdfs' );
						$this->_bsk_files_manager_OBJ_files->views();
						$this->_bsk_files_manager_OBJ_files->display();
			echo '  </form>
			        <p>* You may use [bsk-files-manager-list-category id=xx extension="zip"] to show all files under category id is xx and with an extension of zip .</p>
				  </div>';
		}else if ( $lists_curr_view == 'addnew' || $lists_curr_view == 'edit'){
			$id = -1;
			if(isset($_GET['id']) && $_GET['id']){
				$id = trim($_GET['id']);
			}	
			echo '<div class="wrap">
					<div id="icon-edit" class="icon32"><br/></div>
					<h2>BSK Files Manager -- File</h2>
					<form id="bsk-files-manager-files-form-id" method="post" enctype="multipart/form-data" action="'.admin_url( 'admin.php?page='.$this->_bsk_files_page_name ).'">
					<input type="hidden" name="page" value="'.$this->_bsk_files_page_name.'" />
					<input type="hidden" name="view" value="list" />';
					$this->_bsk_files_manager_OBJ_file->file_edit( $id );
			echo '  <p style="margin-top:20px;"><input type="button" id="bsk_files_manager_file_save_form" class="button-primary" value="Save" /></p>'."\n";
			echo '	</form>
				  </div>';
		}
	}
	
	function bsk_files_manager_settings_support(){
		global $current_user;
		
		if (!$this->bsk_files_manager_current_user_can()){
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		
			
		echo '<div class="wrap">
				<div id="icon-edit" class="icon32"><br/></div>
				<h2>BSK Files Manager -- Settings & Support</h2>
				<form id="bsk-files-manager-settings-form-id" method="post" enctype="multipart/form-data">
				<input type="hidden" name="page" value="bsk-files-manager-settings-support" />';
				$this->_bsk_files_manager_OBJ_settings_support->show_settings();
		echo '  <p style="margin-top:20px;"><input type="submit" id="bsk_files_manager_settings_save_form" class="button-primary" value="Save" /></p>'."\n";
		echo '	</form>
			  </div>';
		
		
		echo '<div class="wrap">';
			  $this->_bsk_files_manager_OBJ_settings_support->show_support();
		echo '</div>';
	}
	
	function bsk_files_manager_current_user_can(){
		global $current_user;
		
		if ( current_user_can('level_10') ){
			return true;
		}else{
			/*
			//get role;
			$user_roles = $current_user->roles;
			$user_role = array_shift($user_roles);
			
			if ($user_role == 'spcial role'){
				return true;
			}
			*/
		}
		return false;
	}
	
}
