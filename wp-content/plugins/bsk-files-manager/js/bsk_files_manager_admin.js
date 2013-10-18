jQuery(document).ready( function($) {
	
	$("#bsk_files_manager_categories_id").change( function() {
		var cat_id = $(this).val();
		var new_action = $("#bsk-files-manager-files-form-id").attr('action') + '&cat=' + cat_id;
		
		$("#bsk-files-manager-files-form-id").attr('action', new_action);
		
		$("#bsk-files-manager-files-form-id").submit();
	});
	
	$("#doaction").click( function() {
		var cat_id = $("#bsk_files_manager_categories_id").val();
		var new_action = $("#bsk-files-manager-files-form-id").attr('action') + '&cat=' + cat_id;
		
		$("#bsk-files-manager-files-form-id").attr('action', new_action);
		
		return true;
	});
	
	$("#bsk_files_manager_category_save").click( function() {
		var cat_title = $("#cat_title_id").val();
		if ($.trim(cat_title) == ''){
			alert('Category title can not be NULL.');
			
			$("#cat_title_id").focus();
			return false;
		}
		
		$("#bsk-files-manager-category-edit-form-id").submit();
	});
	
	$("#bsk_files_manager_file_save_form").click( function() {
		//check category
		var category = $("#bsk_files_manager_file_edit_categories_id").val();
		if (category < 1){
			alert('Please select category.');
			$("#bsk_files_manager_file_edit_categories_id").focus();
			return fasle;
		}
		
		//check title
		var file_title = $("#bsk_files_manager_file_titile_id").val();
		if ($.trim(file_title) == ''){
			alert('files title can not be NULL.');
			$("#bsk_files_manager_file_titile_id").focus();
			return false;
		}
		
		//check file
		if ($("#bsk_files_manager_file_file_old_id").length > 0){
			var is_delete = $("#bsk_files_manager_file_file_rmv_id").attr('checked');
			if (is_delete){
				var file_name = $("#bsk_files_file_id").val();
				file_name = $.trim(file_name);
				if (file_name == ""){
					alert('Please select a new files to upload because you checked delete old one.');
					$("#bsk_files_file_id").focus();
					return false;
				}
			}
			
		}else{
			var file_name = $("#bsk_files_file_id").val();
			file_name = $.trim(file_name);
			if (file_name == ""){
				alert('Please select a file to upload.');
				$("#bsk_files_file_id").focus();
				return false;
			}
		}
		
		$("#bsk-files-manager-files-form-id").submit();
	});
	
	
});
