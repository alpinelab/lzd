<?php

/*
Plugin Name: BSK Files Manager
Description: Help you manager your files. Files can be filter by category and extension. Support shortcode to show special files document or list all under special category. Widget display will be supported soon.
Version: 1.0.0
Author: bannersky
Author URI: http://www.bannersky.com/

------------------------------------------------------------------------

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, 
or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

*/


class BSKFileManager {

	var $_bsk_files_manager_upload_folder = 'wp-content/uploads/bsk-files-manager/';
	var $_bsk_files_manager_upload_path = ABSPATH;
	var $_bsk_files_manager_admin_notice_message = array();

	var $_bsk_files_manager_cats_tbl_name = 'bsk_files_manager_cats';
	var $_bsk_files_manager_pdfs_tbl_name = 'bsk_files_manager_files';
	
	var $_bsk_files_manager_pages = array('category' => 'bsk-files-manager', 'files' => 'bsk-files-manager-files', 'setting' => 'bsk-files-manager-settings-support', 'support' => 'bsk-files-manager-settings-support');
	
	//objects
	var $_bsk_files_manager_OBJ_dashboard = NULL;
	
	public function __construct() {
		global $wpdb;
		
		$this->_bsk_files_manager_cats_tbl_name = $wpdb->prefix.$this->_bsk_files_manager_cats_tbl_name;
		$this->_bsk_files_manager_pdfs_tbl_name = $wpdb->prefix.$this->_bsk_files_manager_pdfs_tbl_name;


		$this->_bsk_files_manager_upload_path = str_replace("\\", "/", $this->_bsk_files_manager_upload_path);
		//create folder to upload 
		$_bsk_files_manager_upload_folder = $this->_bsk_files_manager_upload_path.$this->_bsk_files_manager_upload_folder;
		if ( !is_dir($_bsk_files_manager_upload_folder) ) {
			if ( !wp_mkdir_p( $_bsk_files_manager_upload_folder ) ) {
				$this->_bsk_files_manager_admin_notice_message['upload_folder_missing']  = array( 'message' => 'Directory <strong>' . $_bsk_files_manager_upload_folder . '</strong> can not be created. Please create it first yourself.',
				                                                                                'type' => 'ERROR');
			}
		}
		
		if ( !is_writeable( $_bsk_files_manager_upload_folder ) ) {
			$msg  = 'Directory <strong>' . $this->_bsk_files_manager_upload_folder . '</strong> is not writeable ! ';
			$msg .= 'Check <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> for how to set the permission.';

			$this->_bsk_files_manager_admin_notice_message['upload_folder_not_writeable']  = array( 'message' => $msg,
			                                                                                      'type' => 'ERROR');
		}

		if(is_admin()) {
			add_action('admin_notices', array($this, 'bsk_files_manager_admin_notice') );
			add_action('admin_enqueue_scripts', array(&$this, 'bsk_files_manager_admin_enqueue_scripts_css') );
		}
		
		//create or update table
		$this->bsk_files_manager_create_table();
		
		//include others class
		require_once( 'inc/bsk-files-manager-dashboard.php' );
		
		$arg = array();
		$arg['upload_folder'] = $this->_bsk_files_manager_upload_folder;
		$arg['upload_path'] = $this->_bsk_files_manager_upload_path;
		$arg['cat_tbl_name'] = $this->_bsk_files_manager_cats_tbl_name;
		$arg['files_tbl_name'] = $this->_bsk_files_manager_pdfs_tbl_name;
		$arg['pages_name_A'] = $this->_bsk_files_manager_pages;
		
		$this->_bsk_files_manager_OBJ_dashboard = new BSKFileManagerDashboard( $arg );
		
		//hooks
		register_activation_hook(__FILE__, array($this, 'bsk_files_manager_activate') );
		register_deactivation_hook( __FILE__, array($this, 'bsk_files_manager_deactivate') );
		
		
		add_action('init', array($this, 'bsk_files_manager_post_action'));
	}
	
	function bsk_files_manager_activate(){
		// Clear the permalinks
		flush_rewrite_rules();
	}
	
	function bsk_files_manager_deactivate(){
		// Clear the permalinks
		flush_rewrite_rules();
	}
	
	function bsk_files_manager_admin_enqueue_scripts_css(){
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'bsk-files-manager-admin', plugins_url('css/bsk_files_manager_admin.css', __FILE__) );
		wp_enqueue_script( 'bsk-files-manager-admin', plugins_url('js/bsk_files_manager_admin.js', __FILE__), array('jquery') );
	}
	
	function bsk_files_manager_admin_notice(){
		$warning_message = array();
		$error_message = array();
		
		//admin message
		if (count($this->_bsk_files_manager_admin_notice_message) > 0){
			foreach($this->_bsk_files_manager_admin_notice_message as $msg){
				if($msg['type'] == 'ERROR'){
					$error_message[] = $msg['message'];
				}
				if($msg['type'] == 'WARNING'){
					$warning_message[] = $msg['message'];
				}
			}
		}
		
		//show error message
		if(count($warning_message) > 0){
			echo '<div class="update-nag">';
			foreach($this->warning_message as $msg_to_show){
				echo '<p>'.$msg_to_show.'</p>';
			}
			echo '</div>';
		}
		
		//show error message
		if(count($error_message) > 0){
			echo '<div class="error">';
			foreach($this->error_message as $msg_to_show){
				echo '<p>'.$msg_to_show.'</p>';
			}
			echo '</div>';
		}
	}

	function bsk_files_manager_create_table(){
		global $wpdb;
		
		require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
		
		
		if (!empty ($wpdb->charset)){
			$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}
		if (!empty ($wpdb->collate)){
			$charset_collate .= " COLLATE {$wpdb->collate}";
		}
		
		$table_name = $this->_bsk_files_manager_cats_tbl_name;
		$sql = "CREATE TABLE " . $table_name . " (
				      `id` int(11) NOT NULL AUTO_INCREMENT,
					  `cat_title` varchar(512) NOT NULL,
					  `last_date` datetime DEFAULT NULL,
					  PRIMARY KEY (`id`)
				) $charset_collate;";
		dbDelta($sql);
		
		$table_name = $this->_bsk_files_manager_pdfs_tbl_name;
		$sql = "CREATE TABLE " . $table_name . " (
				     `id` int(11) NOT NULL AUTO_INCREMENT,
					  `cat_id` int(11) NOT NULL,
					  `title` varchar(512) DEFAULT NULL,
					  `file_name` varchar(512) NOT NULL,
					  `extension` varchar(8) NOT NULL,
					  `last_date` datetime DEFAULT NULL,
					  PRIMARY KEY (`id`)
				) $charset_collate;";
		dbDelta($sql);
	}
	
	function bsk_files_manager_post_action(){
		if( isset( $_POST['bsk_files_manager_action'] ) && strlen($_POST['bsk_files_manager_action']) >0 ) {
			do_action( 'bsk_files_manager_' . $_POST['bsk_files_manager_action'], $_POST );
		}
	}
}

$BSK_PDF_manager = new BSKFileManager();
