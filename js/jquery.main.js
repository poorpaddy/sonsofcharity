// page init
jQuery(function(){
	initAccordion();
	initSmoothScroll();
});

// init smooth scrolling
function initSmoothScroll() {
	var isWindowsPhone = /(Windows Phone OS) ([0-9.]*).*/.exec(navigator.userAgent) || /MSIE 10.*Touch/.test(navigator.userAgent);
	var scrollDuration = 500;
	var scrollElement = jQuery('html, body');
	
	jQuery('.skip-to-content, .back-to-top').each(function() {
		var link = jQuery(this);
		var href = link.attr('href');
		if(href.indexOf('#') != 0) return;
		var target = jQuery(href);

		if(target.length > 0) {
			link.click(function(e) {
				e.preventDefault();
				var topOffset = target.offset().top;
				link.parent().addClass('active');
				link.parent().siblings().removeClass('active');

				if (isWindowsPhone) window.scrollTo(window.scrollLeft, topOffset);
				else {
					scrollElement.stop().animate({
						scrollTop: topOffset
					}, scrollDuration);
				};
			});

		}
	});
}

// accordion menu init
function initAccordion() {
	jQuery('ul.accordion').slideAccordion({
		opener: 'a.opener',
		slider: 'div.slide',
		animSpeed: 300
	});
}

/*
 * jQuery Accordion plugin
 */
;(function($){
	$.fn.slideAccordion = function(opt){
		// default options
		var options = $.extend({
			addClassBeforeAnimation: false,
			allowClickWhenExpanded: false,
			activeClass:'active',
			opener:'.opener',
			slider:'.slide',
			animSpeed: 300,
			collapsible:true,
			event:'click'
		},opt);

		return this.each(function(){
			// options
			var accordion = $(this);
			var items = accordion.find(':has('+options.slider+')');

			items.each(function(){
				var item = $(this);
				var opener = item.find(options.opener);
				var slider = item.find(options.slider);
				opener.bind(options.event, function(e){
					if(!slider.is(':animated')) {
						if(item.hasClass(options.activeClass)) {
							if(options.allowClickWhenExpanded) {
								return;
							} else if(options.collapsible) {
								slider.slideUp(options.animSpeed, function(){
									hideSlide(slider);
									item.removeClass(options.activeClass);
								});
							}
						} else {
							// show active
							var levelItems = item.siblings('.'+options.activeClass);
							var sliderElements = levelItems.find(options.slider);
							item.addClass(options.activeClass);
							showSlide(slider).hide().slideDown(options.animSpeed);
						
							// collapse others
							sliderElements.slideUp(options.animSpeed, function(){
								levelItems.removeClass(options.activeClass);
								hideSlide(sliderElements);
							});
						}
					}
					e.preventDefault();
				});
				if(item.hasClass(options.activeClass)) showSlide(slider); else hideSlide(slider);
			});
		});
	};

	// accordion slide visibility
	var showSlide = function(slide) {
		return slide.css({position:'', top: '', left: '', width: '' });
	};
	var hideSlide = function(slide) {
		return slide.show().css({position:'absolute', top: -9999, left: -9999, width: slide.width() });
	};
}(jQuery));