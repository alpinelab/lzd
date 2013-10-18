<?php

class BSKFileManagerSettingsSupport {

	var $_categories_db_tbl_name = '';
	var $_files_db_tbl_name = '';
	var $_files_upload_path = '';
	var $_files_upload_folder = '';

	var $_open_target_option_name = '';
	var $_show_category_title_when_listing_files = '';
   
	public function __construct( $args ) {
		global $wpdb;
		
		$this->_categories_db_tbl_name = $args['categories_db_tbl_name'];
		$this->_files_db_tbl_name = $args['pdfs_db_tbl_name'];
		$this->_files_upload_path = $args['pdf_upload_path'];
	    $this->_files_upload_folder = $args['pdf_upload_folder'];
		$this->_open_target_option_name = $args['open_target_option_name'];
		$this->_show_category_title_when_listing_files = $args['show_category_title'];
		
		$this->_files_upload_path = $this->_files_upload_path.$this->_files_upload_folder;
		
		add_action( 'bsk_files_manager_settings_save', array($this, 'bsk_files_manager_settings_save_fun') );
	}
	
	function show_settings(){
		$open_target = get_option($this->_open_target_option_name, '');
		$show_title = get_option($this->_show_category_title_when_listing_files, false);
		?>
        <div class="bsk_files_manager_settings">
        	<h4>Open File</h4>
            <div>
                <ul class="bsk-details-form">
                    <li>
                        <label>Target:</label>
                        <select name="bsk_files_manager_settings_target" id="bsk_files_manager_settings_target_id">
                        	<option value="_self" <?php if ($open_target == '_self') echo 'selected="selected"'; ?>>Load in the same frame as it was clicked</option>
                            <option value="_blank" <?php if ($open_target == '_blank') echo 'selected="selected"'; ?>>Load in a new window</option>
                            <option value="_parent" <?php if ($open_target == '_parent') echo 'selected="selected"'; ?>>Load in the parent frameset</option>
                            <option value="_top" <?php if ($open_target == '_top') echo 'selected="selected"'; ?>>Load in the full body of the window</option>
                        </select>
                    </li>
                </ul>
            </div>
            <h4>Files List</h4>
            <div>
                <ul class="bsk-details-form">
                    <li>
                        <label>Show category title ?</label>
                        <input type="checkbox" name="bsk_files_manager_settings_show_cat_title" id="bsk_files_manager_settings_show_cat_title_id" <?php if($show_title) echo ' checked="checked"'; ?>/>
                    </li>
                </ul>
            </div>
            <input type="hidden" name="bsk_files_manager_action" value="settings_save" />
            <?php echo wp_nonce_field( plugin_basename( __FILE__ ), 'bsk_files_manager_settings_save_oper_nonce', true, false ); ?>
		</div><!-- end of <div class="bsk_files_manager_settings"> -->
		<?php
	}
	
	function show_support(){
		?>
		<div class="bsk_files_manager_support">
        	<h4>Plugin Support Centre</h4>
            <ul>
                <li><a href="http://www.bannersky.com/html/bsk-files-manager.html" target="_blank">Visit the Support Centre</a> if you have a question on using this plugin</li>
            </ul>
        </div>
    	<?php
	}
	
	function bsk_files_manager_settings_save_fun( $data ){
		global $wpdb;
		//check nonce field
		if ( !wp_verify_nonce( $data['bsk_files_manager_settings_save_oper_nonce'], plugin_basename( __FILE__ ) ) ){
			return;
		}
		
		update_option($this->_open_target_option_name, $data['bsk_files_manager_settings_target']);
		if(isset($_POST['bsk_files_manager_settings_show_cat_title'])){
			update_option($this->_show_category_title_when_listing_files, true);
		}else{
			update_option($this->_show_category_title_when_listing_files, false);
		}
	}
}