
	<div class="column_inner">
		<aside>
			<?php
			
			$is_woocommerce=false;
			if(function_exists("is_woocommerce"))
				$is_woocommerce = is_woocommerce();
				
			if (is_singular("post")) { 
			
				$sidebar = "Sidebar";
				
			} elseif ($is_woocommerce || is_page_template('woocommerce-custom-page.php')){

				$sidebar = "WoocommerceSidebar";

			} else { 
					
				$sidebar = "SidebarPage";
				
			} ?>
				
			<?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : 
			endif;  ?>
		</aside>
	</div>
