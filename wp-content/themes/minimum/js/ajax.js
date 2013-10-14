
var firstLoad = true;

function perPageBindings () {
	
	content = $j('.content_inner');
	
	/* INIT SLIDERS */
	initBigSlider();
	
	initSmallSlider();
	
	initAccordion();
	
	initTabs();
	
	stylePriceingTables();
	
	initProgressBars();
	
	initMessages();
	
	centerCircle();
	
	initParallax(parallax_speed);
	
	initPortfolioList();
	initPortfolioFilter();
	
	stylishSelectContent();
	
	fitVideo();
	
	filterMenu();
	
	ajaxSubmitCommentForm();
	
	placeholderReplace();
}

function ajaxSetActiveState(me){
	if(me.closest('.main_menu').length > 0){
		$j('a').parent().removeClass('active');
	}
	
	if(me.closest('.second').length == 0){
		me.parent().addClass('active');
	}else{
		me.closest('.second').parent().addClass('active');
	}
	
	$j('a').removeClass('current');
	me.addClass('current');
	
}

 function setPageMeta(content) {
	// set up title, meta description and meta keywords
	var newTitle = content.find('.meta .seo_title').text();
	var newDescription = content.find('.meta .seo_description').text();
	var newKeywords = content.find('.meta .seo_keywords').text();
	$j('head meta[name=description]').attr('content', newDescription);
	$j('head meta[name=keywords]').attr('content', newKeywords);
	document.title = newTitle;
	
	var newBodyClasses = content.find('.meta .body_classes').text();
	var myArray = newBodyClasses.split(',');
	$j("body").removeClass();
  for(var i=0;i<myArray.length;i++){
  	if (myArray[i] != "page_not_loaded")
			$j("body").addClass(myArray[i]);
  }
}

 function setToolBarEditLink(content) {
	if($j("#wp-admin-bar-edit").length > 0){
		// set up edit link when wp toolbar is enabled
		var page_id = content.find('#qode_page_id').text();
		var old_link = $j('#wp-admin-bar-edit a').attr("href");
		var new_link = old_link.replace(/(post=).*?(&)/,'$1' + page_id + '$2');
		$j('#wp-admin-bar-edit a').attr("href", new_link);
	}
}

/* function for managing effect transition */
function balanceNavArrows () {
	var navLinks = $j('.main_menu a');
	var seenCurrent = false;
	navLinks.each(function (idx, link) {
		var me = $j(link);
		if (me.hasClass('current')) {
			seenCurrent = true;
			return;
		}
		if (seenCurrent) {
			me.removeClass('up');
			me.addClass('down');
		} else {
			me.removeClass('down');
			me.addClass('up');
		}
	});
}

function callCallback(callbacks, name, self, args) {
		if (callbacks[name]) callbacks[name].apply(self, args);
	}

//sliding out current page
function slideOutOldPage(content, direction, animationTime, callbacks) { 
	
	//check if menu is opend and calculate opened/unopened height
	if($j('.content').css('padding-top') == undefined){
		var padding = 104;
	}else{
		var padding = parseInt($j('.content').css('padding-top'));
	}
	
	if($j('.content_inner').hasClass('updown')){
		var animation = 'ajax_updown';
	}else if($j('.content_inner').hasClass('fade')){
		var animation = 'ajax_fade';
	}else if($j('.content_inner').hasClass('updown_fade')){
		var animation = 'ajax_updown_fade';
	}else if($j('body').hasClass('ajax_updown')){
		var animation = 'ajax_updown';
	}else if($j('body').hasClass('ajax_fade')){
		var animation = 'ajax_fade';
	}else if($j('body').hasClass('ajax_updown_fade')){
		var animation = 'ajax_updown_fade';
	}
	
	var contentHeight = content.height()+padding;	
	var targetHeight = Math.max(contentHeight, $j(window).height());
	viewport.css('min-height',targetHeight);
	content.css({position: 'relative', height: contentHeight});
	
	if(animation == "ajax_updown"){
		var targetTop;
		if ('down' == direction) {
			targetTop = 0 - contentHeight;
		} else {
			targetTop = targetHeight;
		}

		content.stop().animate({top: targetTop}, animationTime, function () {
			$j(this).hide().remove();
			
			callCallback(callbacks,"oncomplete", null, []);
		});
	}else if(animation == "ajax_fade" || animation == "ajax_updown_fade"){
		content.stop().fadeOut(animationTime,function(){
			$j(this).hide().remove();
			callCallback(callbacks,"oncomplete", null, []);
		});
	}
}

//sliding in current page
function slideInNewPage(text, direction, animationTime) {
		
	viewport.html('');
		
	var newHTML = $j(text);
	
	if(newHTML.find('.content_inner').hasClass('updown')){
		var animation = 'ajax_updown';
	}else if(newHTML.find('.content_inner').hasClass('fade')){
		var animation = 'ajax_fade';
	}else if(newHTML.find('.content_inner').hasClass('updown_fade')){
		var animation = 'ajax_updown_fade';
	}else if(newHTML.find('.content_inner').hasClass('no_animation')){
		var animation = 'ajax_no_animation';
	}else if($j('body').hasClass('ajax_updown')){
		var animation = 'ajax_updown';
	}else if($j('body').hasClass('ajax_fade')){
		var animation = 'ajax_fade';
	}else if($j('body').hasClass('ajax_updown_fade')){
		var animation = 'ajax_updown_fade';
	}
	
	var newContent = newHTML.find('.content_inner').hide().css({position: 'relative', visibility: 'hidden'}).show();
	viewport.append(newContent);
	
	
	newHTML.filter('script').each(function(){
            $j.globalEval(this.text || this.textContent || this.innerHTML || '');
        });
	
	newContent.waitForImages(function() {
		//after load of all pictures show sliders/portfolios
		$j('.flexslider, .slider_small, .portfolio_outer').css('visibility','visible');
		
		perPageBindings();
		
		var newHeight = newContent.height() + 27; //27 is bottom margin of content_inner			
		if($j(window).height() > newHeight){
			viewport.css('min-height',newHeight);
		}else{
			viewport.css('min-height',$j(window).height());
		}
		
		if(animation == "ajax_updown" || animation == "ajax_updown_fade"){
			if ('down' == direction) {
			newContent.css({top: viewport.height()});
			} else {
				newContent.css({top: - newHeight});
			}
			
			
			newContent.css({visibility: 'visible'}).stop().animate({top: 0}, PAGE_TRANSITION_SPEED, function(){
				initParallax(2);
				initPortfolioSingleInfo();
			});
			
		}else if(animation == "ajax_fade"){
			
			newContent.css({visibility: 'visible', display:'none'}).stop().fadeIn(PAGE_TRANSITION_SPEED,function(){
				initPortfolioSingleInfo();
			});
		}else if(animation == "ajax_no_animation"){
			
			newContent.css({visibility: 'visible', display:'none'}).stop().fadeIn(0,function(){
				initPortfolioSingleInfo();
			});
		}
		
		
		$j('html, body').animate({
			scrollTop: 0
	 }, 500);
	});
	
	setPageMeta(newHTML);
	setToolBarEditLink(newHTML);
} 

function onLinkClicked(me) {
	
	//var me = $j(this);

	
	
	//check if menu is regular menu href or select menu value
	if(me.attr('href') == undefined){
		var url = me.attr('value').split(root)[1];
	}else{
		var url = me.attr('href').split(root)[1];
	}
	
	//do nothing if active link is clicked
	if(!me.hasClass('current')){
		me.mouseleave();
		return loadResource(url);
	}
}

//load new page, url:href of clicked link,
function loadResource(url) {
	var me = $j("nav a[href='"+root+url+"']");
	
	var animationTime = $j('body').hasClass('page_not_loaded') ? 0 : PAGE_TRANSITION_SPEED;
	var direction = me.hasClass('up') ? 'up' : 'down';
	
	var exitFinished = false;
	
	$j.ajax({
		url: root+url,
		dataType: 'html',
		async : true,
		success: function (text, status, request) {
			function insertNewPage () {
				//don't slide in until the old page has gone
				if (!exitFinished) {
					return window.setTimeout(insertNewPage, 100);
					
				}
				//slide in new page
				ajaxSetActiveState(me);
				slideInNewPage(text, direction, animationTime);
				balanceNavArrows();
			}
			insertNewPage();
			firstLoad = false;
			//document.location.href = root + '#/' + url;
			if (window.history.pushState) {
				var pageurl = root + url;
				if(pageurl!=window.location){
					window.history.pushState({path:pageurl},'',pageurl);	
				}
			} else {
				document.location.href = root + '#/' + url;
			}
		},
		error: function () {
			
		},
		 statusCode: {
			404: function() {
				alert('Page not found!');
			}
		}
	});
	
	//slide out old page; timeout is a fix beacause of transition delay
	slideOutOldPage(content, direction, animationTime, { 
		oncomplete: function () {
			
			exitFinished = true; 
		}
	});
	
	if($j('body').hasClass('page_not_loaded')){$j('body').removeClass('page_not_loaded');}

	

}

if (window.history.pushState) {
/* the below code is to override back button to get the ajax content without reload*/
$j(window).bind('popstate', function() {
	var url = location.href;
	url = url.split(root)[1];
	if (!firstLoad) {
		loadResource(url);
	}
});
}

//show active page
function showActivePage(){
	var page_id = '';
	if ((document.location.href.indexOf("?s=") >= 0) || (document.location.href.indexOf("?animation=") >= 0) || (document.location.href.indexOf("?menu=") >= 0) || (document.location.href.indexOf("?footer=") >= 0)) {
		$j("body").removeClass("page_not_loaded");
		ajaxSetActiveState($j("nav a[href='"+root+"']"));
		return;
	}
	
	if (document.location.href == root) {
		if (window.history.pushState) {
		} else {
			loadResource("");
		}
	}
	
	if (typeof document.location.href.split("#/")[1] === "undefined") {
		ajaxSetActiveState($j("a.current"));
		$j('body').removeClass('page_not_loaded');
	} else {
		page_id = document.location.href.split("#/")[1];
		if (window.history.pushState) {
		} else {
			loadResource(page_id);
		}
	}
	
	
}

var content;
var viewport;
var PAGE_TRANSITION_SPEED;
var disableHashChange = true;

$j(document).ready(function() {
	
	PAGE_TRANSITION_SPEED = 1000;
	viewport = $j('.content');
	content = $j('.content_inner');
	
	showActivePage();
	if($j('body').hasClass('woocommerce') || $j('body').hasClass('woocommerce-page')){	
		return false;
	}else{
		$j(document).on('click','a',function(e){
			if($j(this).hasClass('bx-prev')) return false;
			if($j(this).hasClass('bx-next')) return false;
			if($j(this).closest('.no_animation').length == 0){
				if(document.location.href.indexOf("?s=") >= 0)
					return true;
				if($j(this).attr('href').indexOf("wp-admin") >= 0)
					return true;
				if($j(this).attr('href').indexOf("wp-content") >= 0)
					return true;
				
				if(jQuery.inArray($j(this).attr('href'), no_ajax_pages) != -1){
					document.location.href = $j(this).attr('href');
					return false;
				}	
					
				if(($j(this).attr('href') != "http://#") && ($j(this).attr('href') != "#")){			
					
						disableHashChange = true;
						
						var url = $j(this).attr('href');
						var start = url.indexOf(root);
						
						if(start == 0){
							e.preventDefault();
							e.stopImmediatePropagation();
							e.stopPropagation();
							onLinkClicked($j(this));
						}
					
				}else{
					return false;
				}
			}
		});
	}

	
	on_change = false;
	if(!on_change){
		$j('.selectnav select').change(function(){
			onLinkClicked($j(this));
		});
	}
	
	
	$j(window).bind('hashchange', function() {
		if(!disableHashChange){
			var hash = location.hash;
			var toRemove = '#/';
			var url = hash.replace(toRemove,'');
			loadResource(url);
		}
		disableHashChange = false;
		
	});
	
	
});