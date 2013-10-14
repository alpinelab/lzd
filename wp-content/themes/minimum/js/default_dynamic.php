<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header('Content-type: text/javascript');

?>
var $j = jQuery.noConflict();

function moveDownMenu(){
	$j('.no-touch .move_down > ul > li').each(function(){
		
		var height = $j(this).find('.second').height();
		var header_height = $j('header').height();
		
		var movedown_config = {    
			interval: 100,
			over: function(){
				$j(this).find('.second').height(0);
				$j(this).find('.second').css('visibility','visible');
				$j(this).find('.second').stop().animate({height:height},800);
				if(height > 0){
					$j('.content').stop().animate({'padding-top':height+header_height + <?php if($qode_options['header_separator_thickness'] != ""){ echo $qode_options['header_separator_thickness'];} else{ echo "0"; }  ?> + 1},800);
					$j('.content_inner').css('margin-top','1px');
					$j('.move_menu_separator').css('border-width','<?php if($qode_options['header_separator_thickness'] != ""){ echo $qode_options['header_separator_thickness'];} else{ echo "1"; }  ?>px');
				}
			},   
			timeout: 100,
			out: function(){
				$j(this).find('.second').stop().animate({height:0},800,function(){
					$j(this).css('visibility','hidden');
					$j(this).height(0);
				});
				$j('.content').stop().animate({'padding-top':header_height},800,function(){ 
						$j('.content_inner').css('margin-top','0px');
						$j('.move_menu_separator').css('border-width','0px');
				});
			}
		};
		
		$j(this).hoverIntent(movedown_config);
		
	});
}

function initBigSlider(){
	$j('.flexslider').flexslider({
		animationLoop: true,
		controlNav: false,
		useCSS: false,
		pauseOnAction: true,
    pauseOnHover: true,
		slideshow: <?php if($qode_options['slider_transition_auto'] != ""){ echo $qode_options['slider_transition_auto'];} else{ echo "true"; }  ?>,
		animation: <?php if($qode_options['slider_transition_effect'] != ""){ echo '"'.$qode_options['slider_transition_effect'].'"';} else{ echo '"slide"'; }  ?>,
		animationSpeed: <?php if($qode_options['slider_transition_speed'] != ""){ echo $qode_options['slider_transition_speed'];} else{ echo "600"; }  ?>,
		slideshowSpeed: <?php if($qode_options['slider_transition_timeout'] != ""){ echo $qode_options['slider_transition_timeout'];} else{ echo "8000"; }  ?>,
		start: function(){
			setTimeout(function(){$j(".flexslider").fitVids();},100);
			
		}
	});
	
	$j('.flex-direction-nav a').click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		e.stopPropagation();
	});

}

function initSmallSlider(){
	
	$j('.slider_small.type1').each(function(){
		if($j(this).find('.bx-wrapper').length == 0){
			$j(this).find('ul.slider').bxSlider({
				pager: false,
				minSlides: 1,
				maxSlides: 3,
				slideWidth: 243,
				slideMargin: 20,
				infiniteLoop: true,
				useCSS: false,
				<?php if($qode_options['smallslider_move_slides'] == 1){ ?>
				moveSlides: 1,
				<?php } ?>
				speed: <?php if($qode_options['smallslider_transition_speed'] != ""){ echo $qode_options['smallslider_transition_speed'];} else{ echo "500"; }  ?>,
				onSlideNext: function ($slideElement, oldIndex, newIndex){
					var total = $slideElement.closest('.slider_small').find('.slide_counter_total_val').html();
					var new_index = newIndex*3+3;
					if (new_index > total) new_index = total;
					$slideElement.closest('.slider_small').find('.slide_counter_val').html(new_index);
				},
				onSlidePrev: function ($slideElement, oldIndex, newIndex){
					var total = $slideElement.closest('.slider_small').find('.slide_counter_total_val').html();
					var new_index = newIndex*3+3;
					if (new_index > total) new_index = total;
					$slideElement.closest('.slider_small').find('.slide_counter_val').html(new_index);
				}
			});
		}
	});
	
	$j('.slider_small.type2').each(function(){
		$holder2 = $j(this);
		if($j(this).find('.bx-wrapper').length == 0){
			var slider2 = $j(this).find('ul.slider').bxSlider({
				pager: false,
				minSlides: 1,
				maxSlides: 4,
				slideWidth: 177,
				slideMargin: 20,
				useCSS: false,
				<?php if($qode_options['smallslider_move_slides'] == 1){ ?>
				moveSlides: 1,
				<?php } ?>
				speed: <?php if($qode_options['smallslider_transition_speed_type2'] != ""){ echo $qode_options['smallslider_transition_speed_type2'];} else{ echo "500"; }  ?>,
				onSlideNext: function ($slideElement, oldIndex, newIndex){
					var total = $slideElement.closest('.slider_small').find('.slide_counter_total_val').html();
					var new_index = newIndex*4+4;
					if (new_index > total) new_index = total;
					$slideElement.closest('.slider_small').find('.slide_counter_val').html(new_index);
				},
				onSlidePrev: function ($slideElement, oldIndex, newIndex){
					var total = $slideElement.closest('.slider_small').find('.slide_counter_total_val').html();
					var new_index = newIndex*4+4;
					if (new_index > total) new_index = total;
					$slideElement.closest('.slider_small').find('.slide_counter_val').html(new_index);
				}
			});
		}
	});

	var config = {    
		interval: 100,
		over: function(){
			$height = $height = $j(this).find("img").height();
			$j(this).find(".image").stop().animate({
				height: 0,
				margin:0,
				easing: 'easeInOutQuart'
			}, 400, function() {  
				$j(this).parent().find("p,a,hr").fadeIn(200);
			});
		},   
		timeout: 0,
		out: function(){
			$j(this).find("p,a,hr").hide(100);
			$j(this).find(".image").stop().animate({
				height: $height,
				margin: "0px 0px 8px 0px",
				easing: 'easeInOutQuart'
			}, 400, function() {
	
			});
		}
	};


	
	$j(".content .slider_small .slide_item").each(function(){
		$j(this).hoverIntent(config);
	});
	
}

function ajaxSubmitCommentForm(){
	var options = { 
		success: function(){
			$j("#commentform textarea").val("");
			$j("#commentform .success p").text("<?php _e('Comment has been sent!','qode'); ?>");
		}
	}; 
	
	$j('#commentform').submit(function() {
		$j(this).find('input[type="submit"]').next('.success').remove();
		$j(this).find('input[type="submit"]').after('<div class="success"><p></p></div>')
		$j(this).ajaxSubmit(options); 
		return false; 
	}); 
}
