(function() {
   tinymce.create('tinymce.plugins.qode_shortcodes', {
      init : function(ed, url) {		 
		 
         ed.addButton('qode_shortcodes', {
            title : 'Qode Shortcodes',
            image : url+'/qode_shortcodes.ico',
            onclick : function() {
						
						
									
						
						jQuery("#qode_shortcode_form_wrapper").remove();
					
						
						var shortcodes_visible = jQuery("#qode_shortcodes_menu_holder").length;
						
						if (shortcodes_visible){
							jQuery("#qode_shortcodes_menu_holder").remove();
						}
						else{
							
							var id = jQuery(this).attr("id");
							jQuery("#"+id+"_toolbargroup").append("<div id='qode_shortcodes_menu_holder'></div>");							

              jQuery('#qode_shortcodes_menu_holder').load(url + '/qode_shortcodes_popup.html#qode_shortodes_popup', function(){
								

								var y = parseInt(jQuery("#content_qode_shortcodes").offset().top) - 25;	
								var x = parseInt(jQuery("#content_qode_shortcodes").offset().left) - parseInt(jQuery("#adminmenuwrap").width()) + 10;
								y = 0;
								jQuery("#qode_shortcodes_menu_holder").css({top: y, left: x});
								
							
						
								
								jQuery("#SC_1-2x1-2").click(function(){
									var shortcode = "[two_columns]<br/>[column1]<p>content content content</p> [/column1]<br/>[column2] <p>content content content</p>[/column2]<br/>[/two_columns] "
									ed.execCommand('mceInsertContent', false, shortcode); 
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-3x1-3x1-3").click(function(){
									var shortcode = "[three_columns]<br/>[column1] <p>content content content</p> [/column1]<br/>[column2] <p>content content content</p>[/column2]<br/>[column3] <p>content content content</p>[/column3]<br/>[/three_columns]"
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-3x2-3").click(function(){
									var shortcode = "[two_columns_33_66]<br/> [column1] <p>content content content</p>[/column1]<br/>[column2]<p>content content content</p>[/column2]<br/>[/two_columns_33_66] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_2-3x1-3").click(function(){
									var shortcode = "[two_columns_66_33]<br/>[column1]<p>content content content</p>[/column1]<br/>[column2]<p>content content content</p>[/column2]<br/>[/two_columns_66_33] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-4x3-4").click(function(){
									var shortcode = "[two_columns_25_75]<br/>[column1]<p>content content content</p>[/column1]<br/>[column2]<p>content content content</p><br/>[/column2]<br/>[/two_columns_25_75] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_3-4x1-4").click(function(){
									var shortcode = "[two_columns_75_25]<br/>[column1]<p>content content content</p>[/column1]<br/>[column2]<p>content content content</p>[/column2]<br/>[/two_columns_75_25] "
									ed.execCommand('mceInsertContent', false, shortcode);  
									jQuery("#qode_shortcodes_menu_holder").remove();                           
								})
								
								jQuery("#SC_1-4x1-4x1-4x1-4").click(function(){
									var shortcode = "[four_columns]<br/>[column1]<p>content content content</p>[/column1]<br/>[column2]<p>content content content</p>[/column2]<br/>[column3]<p>content content content</p>[/column3]<br/>[column4]<p>content content content</p> [/column4]<br/>[/four_columns] "
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_ordered-list").click(function(){
									var shortcode = "[ordered_list]<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>[/ordered_list] "
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_tabs").click(function(){
									var shortcode = "[tabs tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\"]<br /><br />[tab id=1]Tab content 1[/tab]<br />[tab id=2]Tab content 2[/tab]<br />[tab id=3]Tab content 3[/tab]<br /><br />[/tabs]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_accordion").click(function(){
									var shortcode = "[accordion]<br /><br />[accordion_item caption=\"Accordion 1\"] <p>content content content</p> [/accordion_item]<br />[accordion_item caption=\"Accordion 2\"] <p>content content content</p> [/accordion_item]<br />[accordion_item caption=\"Accordion 3\"] <p>content content content</p> [/accordion_item]<br/><br/>[/accordion]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_horizontal_progress").click(function(){
									var shortcode = "[progress_bars]<br /><br />[progress_bar title=\"Progress 1\" percent=\"50\"]<br />[progress_bar title=\"Progress 2\" percent=\"50\"]<br />[progress_bar title=\"Progress 3\" percent=\"50\"]<br/><br/>[/progress_bars]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_horizontal_progress_discontinius").click(function(){
									var shortcode = "[progress_bars_discontinuous]<br /><br />[progress_bar_discontinuous title=\"Progress 1\" number=\"3\"]<br />[progress_bar_discontinuous title=\"Progress 2\" number=\"3\"]<br />[progress_bar_discontinuous title=\"Progress 3\" number=\"3\"]<br/><br/>[/progress_bars_discontinuous]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_vertical_progress").click(function(){
									var shortcode = "[progress_bars_vertical]<br /><br />[progress_bar_vertical title=\"Progress 1\" number=\"5\"]<br />[progress_bar_vertical title=\"Progress 2\" number=\"5\"]<br />[progress_bar_vertical title=\"Progress 3\" number=\"5\"]<br/><br/>[/progress_bars_vertical]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_testimonial").click(function(){
									var shortcode = "[testimonials name='Dummy Name' image_link='link to your picture']<p> content content content </p>[/testimonials]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_highlights").click(function(){
									var shortcode = "[highlight] content content content[/highlight]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_action").click(function(){
									var shortcode = "[action title='Dummy Title'] content content content [/action]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								jQuery("#SC_products_latest").click(function(){
									var shortcode = "[latest_products]";
									ed.execCommand('mceInsertContent', false, shortcode);   
									jQuery("#qode_shortcodes_menu_holder").remove();                          
								})
								
								
								
								////////////////////////////////
								// pop-up shortcodes          //
								////////////////////////////////
								var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
								W = W - 80;
								H = H - 120;
								
								jQuery("#SC_dropcaps").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_dropcaps.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Dropcap shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var letter = jQuery('#TB_window #letter').val();
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[dropcaps style='" + style + "']" + letter + "[/dropcaps]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});
									jQuery("#qode_shortcodes_menu_holder").remove();                                      
								})
								
								jQuery("#SC_blockquotes").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_blockquotes.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Blockquote shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var text = jQuery('#TB_window #text').val();
										   var width = jQuery('#TB_window #blockquote_width').val();
										   var shortcode = "[blockquote width='" + width + "']<br/><br/>" + text + "<br/><br/>[/blockquote]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_blog_latest").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_blog_latest.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Blog Latest', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type').val();
										   var number = jQuery('#TB_window #number').val();
										   var shortcode = "[blog_latest type='" + type + "' number='" + number + "' /]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_message").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_message.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Message shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var background_color = jQuery('#TB_window #background_color').val();
										   var border = jQuery('#TB_window #border option:selected').val();
											 var size = jQuery('#TB_window #size option:selected').val();
										   var shortcode = "[message border='"+border+"' background_color='"+background_color+"' size='"+size+"'] content content content [/message]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_unordered_list").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_unordered_list.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Unordered shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[unordered_list style='" + style + "']<ul><li>Lorem ipsum</li><li>Lorem ipsum</li><li>Lorem ipsum</li></ul>[/unordered_list]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);
										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_button").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_button.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Button shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var size = jQuery('#TB_window #size option:selected').val();
										   var text = jQuery('#TB_window #text').val();
										   var link = jQuery('#TB_window #link').val();
										   var target = jQuery('#TB_window #target option:selected').val();
										   var color = jQuery('#TB_window #color').val();
										   var background_color = jQuery('#TB_window #background_color').val();
										   var font_style = jQuery('#TB_window #font_style option:selected').val();
										   var font_size = jQuery('#TB_window #font_size').val();
										   var line_height = jQuery('#TB_window #line_height').val();
										   var font_weight = jQuery('#TB_window #font_weight option:selected').val();
										   var shortcode = "[button size='" + size + "' color='"+ color + "' background_color='"+ background_color +"' font_size='"+ font_size +"' line_height='"+ line_height +"' font_style='"+ font_style +"' font_weight='"+ font_weight +"' text='"+ text +"' link='"+ link +"' target='"+ target +"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);	
										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})																																							
								
								jQuery("#SC_pricing_table").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_table.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Pricing table shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var border = jQuery('#TB_window #border option:selected').val();
										   var shortcode = "[pricing_table border='"+border+"']<br/><br/>[pricing_column title='Price dummy title' price='100' period='per month' link='insert your link here' signup_text='Sign up' active='no']<br/><br/>[pricing_cell] content content content [/pricing_cell]<br/>[pricing_cell] content content content [/pricing_cell]<br/>[pricing_cell] content content content [/pricing_cell]<br/><br/>[/pricing_column]<br/><br/>[/pricing_table]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_table").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_table.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Table shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var border = jQuery('#TB_window #border option:selected').val();
										   var shortcode = "[table border='"+border+"']<br/><br/>[table_row][table_cell_head] dummy title [/table_cell_head][table_cell_head] dummy title [/table_cell_head][table_cell_head] dummy title [/table_cell_head][/table_row]<br/><br/>[table_row][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][/table_row]<br/>[table_row][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][table_cell_body] content content [/table_cell_body][/table_row]<br/><br/>[/table]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_portfolio_list").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_portfolio_list.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Portfolio list shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var filter = jQuery('#TB_window #filter option:selected').val();
											 var columns = jQuery('#TB_window #columns option:selected').val();
											 var number = jQuery('#TB_window #number').val();
											 var category = jQuery('#TB_window #category').val();
											 var selected_projects = jQuery('#TB_window #selected_projects').val();
										   var shortcode = "[portfolio_list columns='"+columns+"' number='"+number+"' category='"+category+"' selected_projects='"+selected_projects+"' filter='"+filter+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_slider").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_slider.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Slider shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
											 var title = jQuery('#TB_window #title').val();
										   var shortcode = "[slider type='"+type+"' title='"+title+"' id='insert uniqe value of slider here']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_separator").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_separator.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Separator shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var color = jQuery('#TB_window #color').val();
											 var thickness = jQuery('#TB_window #thickness').val();
											 var top = jQuery('#TB_window #top').val();
											 var bottom = jQuery('#TB_window #bottom').val();
										   var shortcode = "[separator color='"+color+"' thickness='"+thickness+"'  up='"+top+"' down='"+bottom+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_separator_small").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_separator_small.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Separator shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var color = jQuery('#TB_window #color').val();
											 var thickness = jQuery('#TB_window #thickness').val();
											 var top = jQuery('#TB_window #top').val();
											 var bottom = jQuery('#TB_window #bottom').val();
										   var shortcode = "[separator_small color='"+color+"' thickness='"+thickness+"'  up='"+top+"' down='"+bottom+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_social_icons").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_social.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Social shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var style = jQuery('#TB_window #style option:selected').val();
										   var shortcode = "[social_icons style='"+style+"'] youtube,http://www.youtube.com, vimeo,http://www.vimeo.com, facebook,http://www.facebook.com [/social_icons]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_service").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_service.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Service shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
											 var title = jQuery('#TB_window #title').val();
											 var link = jQuery('#TB_window #link').val();
										   var shortcode = "[service type='"+type+"' title='"+title+"' link='"+link+"'] <p>content content content</p> [/service]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_video").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_video.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Video shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var type = jQuery('#TB_window #type option:selected').val();
											 var id = jQuery('#TB_window #id').val();
											 var height = jQuery('#TB_window #height').val();
										   var shortcode = "[video type='"+type+"' id='"+id+"' height='"+height+"']";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								jQuery("#SC_parallax").click(function(){
									jQuery("#qode_shortcode_form_wrapper").remove();
									jQuery.get(url + "/qode_shortcodes_parallax.php", function(data){
									   var form = jQuery(data);
									   form.appendTo('body').hide();
									   tb_show( 'Parallax shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=qode_shortcode_form_wrapper' );
									   jQuery('#TB_window #qode_insert_shortcode_button').click(function(){
										   var back_button = jQuery('#TB_window #back_button option:selected').val();
											 var shortcode = "[parallax back_button='"+back_button+"']<br/><br/>[parallax_section id='insert image id' height=''] <p>content content content</p> [/parallax_section]<br/><br/>[/parallax]";
										   jQuery("#qode_shortcode_form_wrapper").remove()
										   ed.execCommand('mceInsertContent', false, shortcode);		   										   										   tb_remove();
										   return false;
									   });							
									});  
									jQuery("#qode_shortcodes_menu_holder").remove();                                    
								})
								
								
							})
								
						}
            
			
			

			
			
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Recent Posts",
            author : 'Konstantinos Kouratoras',
            authorurl : 'http://www.kouratoras.gr',
            infourl : 'http://wp.smashingmagazine.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('qode_shortcodes', tinymce.plugins.qode_shortcodes);
   

})();