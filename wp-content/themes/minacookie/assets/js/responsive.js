jQuery(document).ready(function() {
	"use strict";

	var resizeTimer = null;
	let checkAddedButton = false;

	window.resizeHandler = function(){
		var body = jQuery('body'),
			header = jQuery('.l-header'),
			firstSection = jQuery('.l-section').first(),
			headerTop = 0,
			scrollOffsetTolerance = 0,
			H = jQuery(window).height()-0,// Browser window height
			W = jQuery(window).width()- 0,// Browser window width
			h = window.headerHeight = header.height()-0,// header height, calculated depending on window width
			hh = firstSection.height()- 0,
			f = jQuery('.l-footer').height()- 0,// footer height, affects .l-main bottom margin
			fullScreenHome = false;

		if (body.hasClass('hometype_fullscreen')) {
			fullScreenHome = true;
		}

		if (body.hasClass('no_pagesections') && firstSection.find('.us_supersized').length) {
			fullScreenHome = true;
			body.addClass('hometype_fullscreen');
			body.removeClass('no_pagesections');
		}

		jQuery('.l-main').css('margin-bottom', f+'px');

		if (body.hasClass('headerpos_top'))
		{
			if (fullScreenHome) {
				firstSection.css({'height': (H-h)+'px'});
			}
			if (body.hasClass('headertype_sticky')) {
				firstSection.css({'margin-top': h+'px'});
			}
		}
		if (body.hasClass('headerpos_bottom'))
		{
			if (fullScreenHome) {
				firstSection.css({'height': (H-h)+'px', 'margin-bottom': h+'px'});
				headerTop = H-h;
			} else {
				firstSection.css({'margin-bottom': h+'px'});
				headerTop = hh;
			}
		}
		if (body.hasClass('headerpos_outside'))
		{
			if (fullScreenHome) {
				firstSection.css({'height': H+'px', 'margin-bottom': h+'px'});
				headerTop = H;
			} else {
				firstSection.css({'margin-bottom': h+'px'});
				headerTop = hh;
			}
		}

		header.css('top', headerTop+'px');


		if (body.hasClass('headertype_sticky')) {
			scrollOffsetTolerance = h-1;
		}

		var linkScroll = function(event, link) {
			event.preventDefault();
			event.stopPropagation();
//			jQuery.smoothScroll({
//				offset: -scrollOffsetTolerance,
//				scrollTarget: link.hash
//			});

			jQuery("html, body").animate({
				scrollTop: jQuery(link.hash).offset().top-scrollOffsetTolerance+"px"
			}, {
				duration: 800/*,
				easing: "easeInOutQuint"*/
			});
		};

		jQuery('a[class="w-logo-link"][href="#"]').off('click').click(function(event) {
			event.preventDefault();
			event.stopPropagation();
			jQuery("html, body").animate({
				scrollTop: 0
			}, {
				duration: 800/*,
				easing: "easeInOutQuint"*/
			});
		});

		jQuery('a[class="w-toplink"]').off('click').click(function(event) {
			event.preventDefault();
			event.stopPropagation();
			jQuery("html, body").animate({
				scrollTop: 0
			}, {
				duration: 800/*,
				easing: "easeInOutQuint"*/
			});
		});

		if (jQuery('body').hasClass('home'))
			jQuery('a[href^="#"][href!="#"]')./*off('click').die('click').live*/on('click',function(event) {
				event.preventDefault();
				linkScroll(event, this);
			});

		jQuery('.l-header .w-nav').each(function () {
			var nav = jQuery(this),
				navControl = nav.find('.w-nav-control'),
				navList = nav.find('.w-nav-list.level_1'),
				navSubLists = navList.find('.w-nav-item.with_sublevel .w-nav-list'),
				navSubLists_1 =  navList.find('.w-nav-list-h .children .sub-menu'),
				button = jQuery('<span>',{'class':'w-nav-hint', text : '' }),
				navAnchors = nav.find('.w-nav-anchor'),
				navRunning = false,
				mobileNavWidth = 1023;

			if (window.mobileNavWidth !== undefined) {
				mobileNavWidth = window.mobileNavWidth-0;
			}

			if (W <= mobileNavWidth) {
				var listOpen = false,
					navSubControls = navList.find('.w-nav-item.with_sublevel .w-nav-hint');


				//tho_dang
				if(!checkAddedButton) {
					navList.find('.w-nav-list-h .children').prepend(button);
					checkAddedButton = true;
				}
				var	navSubControls_1 = navList.find('.children .w-nav-hint');
				//end

				if (! nav.hasClass('touch_enabled')) {
					nav.addClass('touch_enabled');
					navList.css({display: 'none'});
					navSubLists.css({display: 'none'});
					navSubLists_1.css({display: 'none'});
				}

				navControl.off('click').click(function() {
					if (! navRunning) {
						navRunning = true;
						if (listOpen) {
							navList.slideUp(250, function(){
								navRunning = false;
							});
							listOpen = false;
						} else {
							navList.slideDown(250, function(){
								navRunning = false;
							});
							listOpen = true;
						}
					}
				});

				navSubControls.off('click').click(function() {
					if (! navRunning) {
						navRunning = true;
						var subList = jQuery(this).closest('.w-nav-item-h').find('.w-nav-list').first(),
							subListOpen = subList.data('subListOpen'),
							currentNavItem = jQuery(this).closest('.w-nav-item');

						if (subListOpen) {
							subList.slideUp(250, function(){
								navRunning = false;
								currentNavItem.removeClass('open');
							});
							subListOpen = false;
						} else {
							subList.slideDown(250, function(){
								navRunning = false;
								currentNavItem.addClass('open');
							});
							subListOpen = true;
						}

						subList.data('subListOpen', subListOpen);
					}

					return false;
				});

				//tho
				navSubControls_1.off('click').click(function() {
					if (! navRunning) {
						navRunning = true;
						var subList = jQuery(this).closest('.children').find('.sub-menu').first(),
							subListOpen = subList.data('subListOpen'),
							currentNavItem = jQuery(this).closest('.children');

						if (subListOpen) {
							subList.slideUp(250, function(){
								navRunning = false;
								currentNavItem.removeClass('open');
							});
							subListOpen = false;
						} else {
							subList.slideDown(250, function(){
								navRunning = false;
								currentNavItem.addClass('open');
							});
							subListOpen = true;
						}

						subList.data('subListOpen', subListOpen);
					}

					return false;
				});

				navAnchors.click(function() {
					if (W <= mobileNavWidth) {
						navRunning = true;
						navList.slideUp(250, function(){
							navRunning = false;
						});
						listOpen = false;
					}
				});

			} else {
				nav.removeClass('touch_enabled');
				nav.find('.w-nav-item').removeClass('open');
				navList.css({height: '', display: ''});
				navSubLists.css({height: '', display: ''});
				navSubLists_1.css({height: '', display: ''});
				navControl.off('click');

			}

		});

		var scrollTimer = false,
			scrollHandler = function(){
				var scrollPosition	= parseInt(jQuery(window).scrollTop(), 10);

				if (scrollPosition >= H) {
					jQuery('.w-toplink').addClass('active');
				} else {
					jQuery('.w-toplink').removeClass('active');
				}

				if (body.hasClass('headertype_sticky') && (body.hasClass('headerpos_bottom') || body.hasClass('headerpos_outside'))) {
					if (scrollPosition > headerTop) {
						header.css({ position: 'fixed', top: 0});

					} else {
						header.css({ position: '', top: headerTop});
					}

				}

//				jQuery('.w-nav-item.active').removeClass('active');

				//Move trough each menu and check its position with scroll position then add current class
				jQuery('.w-nav-item a[href^="#"]').each(function() {
					var thisHref = jQuery(this).attr('href');

					if (jQuery(thisHref).length) {
						var thisTruePosition = parseInt(jQuery(thisHref).offset().top, 10),
							thisPosition = thisTruePosition - h;

						if(scrollPosition >= thisPosition) {
							//jQuery('.w-nav-item.active').removeClass('active');
							//jQuery('.w-nav-item a[href="'+ thisHref +'"]').parent().parent().addClass('active');

							jQuery('.w-cart').each(function(){
								if (jQuery(this).hasClass('status_empty')) {
									jQuery(this).css('display', '');
								}
							});
							jQuery(thisHref).find('.w-cart').css('display', 'block');
						}
					}
				});


				//If we're at the bottom of the page, move pointer to the lal-section-hst section
				// var bottomPage	= parseInt(jQuery(document).height(), 10) - parseInt(jQuery(window).height(), 10);

				// if(scrollPosition === bottomPage || scrollPosition >= bottomPage) {
				// 	var thisHref = jQuery('.w-nav-item a[href^=#]:last').attr('href');
				// 	if (jQuery(thisHref).length) {
				// 		jQuery('.w-nav-item.active').removeClass('active');
				// 		jQuery('.w-nav-item a[href^=#]:last').parent().parent().addClass('active');
				// 	}
				// }
			};

		window.clearTimeout(scrollTimer);
		scrollHandler();

		jQuery(window).scroll(function(){
			window.clearTimeout(scrollTimer);
			scrollTimer = window.setTimeout(function(){
				scrollHandler();
			}, 10);
		});

	};

	window.resizeHandler();

	jQuery(window).resize(function(){
		window.clearTimeout(resizeTimer);
		resizeTimer = window.setTimeout(function(){
			window.resizeHandler();
		}, 50);

	});


});
