/* Initialize
*/
var kt_isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (kt_isMobile.Android() || kt_isMobile.BlackBerry() || kt_isMobile.iOS() || kt_isMobile.Opera() || kt_isMobile.Windows());
    }
};
jQuery(document).ready(function ($) {

	// Bootstrap Init
		$("[rel=tooltip]").tooltip();
		$('[data-toggle=tooltip]').tooltip();
		$("[data-toggle=popover]").popover();
		$('#authorTab a').click(function (e) {e.preventDefault(); $(this).tab('show'); });
		$('.sc_tabs a').click(function (e) {e.preventDefault(); $(this).tab('show'); });
		
		$(".videofit").fitVids();
		$(".embed-youtube").fitVids();

		$('.collapse-next').click(function (e) {
			//e.preventDefault();
		    var $target = $(this).siblings('.sf-dropdown-menu');
		     if($target.hasClass('in') ) {
		    	$target.collapse('toggle');
		    	$(this).removeClass('toggle-active');
		    } else {
		    	$target.collapse('toggle');
		    	$(this).addClass('toggle-active');
		    }
		});
		$('.kt_typed_element').each(function() {
				var first = $(this).data('first-sentence'),
					second = $(this).data('second-sentence'),
					third = $(this).data('third-sentence'),
					fourth = $(this).data('fourth-sentence'),
					loopeffect = $(this).data('loop'),
					speed = $(this).data('speed'),
					linecount = $(this).data('sentence-count');
					if(linecount == '1'){
						var options = {
					      strings: [first],
					      typeSpeed: speed,
					      startDelay: 500,
					      loop: loopeffect,
					  }
			    	}else if(linecount == '3'){
						var options = {
					      strings: [first, second, third],
					      typeSpeed: speed,
					      startDelay: 500,
					      loop: loopeffect,
					  }
			    	} else if(linecount == '4'){
			    		var options = {
					      strings: [first, second, third, fourth],
					      typeSpeed: speed,
					      startDelay: 500,
					      loop: loopeffect,
					  }
			    	} else {
			    		var options = {
					      strings: [first, second],
					      typeSpeed: speed,
					      startDelay: 500,
					      loop: loopeffect,
					  }
			    	}
				$(this).appear(function() {
					$(this).typed(options);
				},{accX: 0, accY: -25});
      	});

	// Lightbox
		/**
		 * Checks href targets to see if a given anchor is linking to an image.
		 *
		 * @since  0.1.0
		 * @return mixed
		 */
		function kt_check_images( index, element ) {
			return /(png|jpg|jpeg|gif|tiff|bmp)$/.test(
				$( element ).attr( 'href' ).toLowerCase().split( '?' )[0].split( '#' )[0]
			);
		}

		function kt_find_images() {
			$( 'a[href]' ).filter( kt_check_images ).attr( 'data-rel', 'lightbox' );
		}
		kt_find_images();

		$.extend(true, $.magnificPopup.defaults, {
			tClose: '',
			tLoading: light_load, // Text that is displayed during loading. Can contain %curr% and %total% keys
			gallery: {
				tPrev: '', // Alt text on left arrow
				tNext: '', // Alt text on right arrow
				tCounter: light_of // Markup for "1 of 7" counter
			},
			image: {
				tError: light_error, // Error message when image could not be loaded
				titleSrc: function(item) {
					return item.el.find('img').attr('alt');
					}
				}
		});
		$("a[rel^='lightbox']").magnificPopup({type:'image'});
		$("a[data-rel^='lightbox']").magnificPopup({type:'image'});
		$('.kad-light-gallery').each(function(){
			$(this).find('a[rel^="lightbox"]').magnificPopup({
				type: 'image',
				gallery: {
					enabled:true
					},
					image: {
						titleSrc: 'title'
					}
				});
		});
		$('.kad-light-gallery').each(function(){
			$(this).find("a[data-rel^='lightbox']").magnificPopup({
				type: 'image',
				gallery: {
					enabled:true
					},
					image: {
						titleSrc: 'title'
					}
				});
		});
		$('.kad-light-wp-gallery').each(function(){
			$(this).find('a[rel^="lightbox"]').magnificPopup({
				type: 'image',
				gallery: {
					enabled:true
					},
					image: {
						titleSrc: function(item) {
						return item.el.find('img').attr('alt');
						}
					}
				});
		});
		$('.kad-light-wp-gallery').each(function(){
			$(this).find("a[data-rel^='lightbox']").magnificPopup({
				type: 'image',
				gallery: {
					enabled:true
					},
					image: {
						titleSrc: function(item) {
						return item.el.find('img').attr('alt');
						}
					}
				});
		});
		$('.kad-light-mosaic-gallery').each(function(){
			$(this).find('a[data-rel^="lightbox"]').magnificPopup({
				type: 'image',
				gallery: {
					enabled:true
					},
					image: {
						titleSrc: function(item) {
						return item.el.siblings('img').attr('alt');
						}
					}
				});
		});
		$("a.pvideolight[rel^='lightbox']").magnificPopup({type:'iframe'});
			// Custom Select
		$('#archive-orderby').customSelect();
		if( $(window).width() > 790 && !kt_isMobile.any() ) {
			$('.kad-select').select2({minimumResultsForSearch: -1 });
			$('.woocommerce-ordering select').select2({minimumResultsForSearch: -1 });
		} else {
			$('.kad-select').customSelect();
			$('.woocommerce-ordering select').customSelect();
		}
		var select2select = $('body').attr('data-jsselect');
		if( $(window).width() > 790 && !kt_isMobile.any() && (select2select == 1 )) {
			$('select').select2({minimumResultsForSearch: -1 });
			$('select.country_select').select2();
			$('select.state_select').select2();
		}

	//smooth Scroll
		function niceScrollInit(){
			var $smoothautohide = $('body').attr('data-smooth-scrolling-hide');
			if( $smoothautohide == 1 ) {
						$("html").niceScroll({
							scrollspeed: 60,
							mousescrollstep: 40,
							cursorwidth: 12,
							cursorborder: 0,
							cursorcolor: '#313131',
							cursorborderradius: 6,
							autohidemode: true,
							horizrailenabled: false
						});
				} else {
						$("html").niceScroll({
							scrollspeed: 60,
							mousescrollstep: 40,
							cursorwidth: 12,
							cursorborder: 0,
							cursorcolor: '#313131',
							cursorborderradius: 6,
							autohidemode: false,
							horizrailenabled: false
						});
				}
			$('html').addClass('no-overflow-y');
		}
	if ($('.tab-pane .kad_product_wrapper').length) {
		var $container = $('.kad_product_wrapper');
		$('.sc_tabs').on('shown.bs.tab', function  (e) {
			$container.isotopeb({masonry: {columnWidth: '.kad_product'}, transitionDuration: '0.8s'});
		});
	}
	if ($('.panel-body .kad_product_wrapper').length) {
		var $container = $('.kad_product_wrapper');
		$('.panel-group').on('shown.bs.collapse', function  (e) {
		$container.isotopeb({masonry: {columnWidth: '.kad_product'}, transitionDuration: '0.8s'});
		});
		$('.panel-group').on('hidden.bs.collapse', function  (e) {
			$container.isotopeb({masonry: {columnWidth: '.kad_product'}, transitionDuration: '0.8s'});
		});
	}

	var $smoothActive = $('body').attr('data-smooth-scrolling');
	if( $smoothActive == 1 && !kt_isMobile.any() && Modernizr.csstransforms3d && $(window).width() > 690 && $('body').outerHeight(true) > $(window).height()) { 
	 niceScrollInit();
	 $("a[rel^='lightbox']").on('mfpAfterClose', function(e) {
		$('html').css('overflow', 'hidden');
		});
	} else {
		$('body').attr('data-smooth-scrolling','0');
		if ( document.querySelector('body').offsetHeight > window.innerHeight ) {
		  document.documentElement.style.overflowY = 'scroll';
		}
	}

	// anchor scroll
	function kad_anchor_scroll() {
		var stickyheader = $('body').attr('data-sticky'),
		shrinkheader = $('#kad-banner').data('header-shrink'),
		headerbase = $('#kad-banner').data('header-base-height'),
		topbarheight = $('#topbar').height();
		if (shrinkheader == 1 && stickyheader == 1) {
			var shrinkoffset = headerbase*0.5;
			var headeroffset = shrinkoffset+topbarheight;
			$('.kad_fullslider_arrow').localScroll({offset: - headeroffset});
		} else if(stickyheader == 1) {
			var headeroffset = headerbase+topbarheight;
			$('.kad_fullslider_arrow').localScroll({offset: - headeroffset});
		} else {
			$('.kad_fullslider_arrow').localScroll();
		}
	}
	if($('.kad_fullslider_arrow').length > 0) {
		kad_anchor_scroll();
	}

		// Sticky Header
			var header = $('.stickyheader #kad-banner');
	function kad_sticky_header() {
		var stickyheader = $('body').attr('data-sticky'),
		topOffest = $('body').hasClass('admin-bar') ? 32 : 0;
		shrinkheader = $('#kad-banner').attr('data-header-shrink'),
		pagetitleheader = $('#kad-banner').attr('data-pageheaderbg'),
		mobilestickyheader = $('#kad-banner').attr('data-mobile-sticky'),
		win = $(window),
		header = $('.stickyheader #kad-banner'),
		headershrink = $('.stickyheader #kad-banner #kad-shrinkheader'),
		logo = $('.stickyheader #kad-banner #logo a, .stickyheader #kad-banner #logo a #thelogo'),
		logobox = $('.stickyheader #kad-banner #logo a .kad-lg'),
		menu = $('.stickyheader #kad-banner .kad-primary-nav ul.sf-menu > li > a'),
		mobilemenu = $('.kad-header-style-basic #kad-shrinkheader #mobile-nav-trigger .nav-trigger-case .kad-navbtn'),
		content = $('.stickyheader .wrap'),
		mobilebox = $('.stickyheader .mobile-stickyheader .mobile_menu_collapse'),
		headerouter = $('.stickyheader .sticky-wrapper'),
		header_height = $(header).height(),
		shrinkheader_height = $('#kad-banner').attr('data-header-base-height'),
		topbar_height = $('.stickyheader #kad-banner #topbar').height();

		set_height = function() {
				var scrollt = win.scrollTop(),
                newH = 0;
                if(scrollt < 0) {
                	scrollt = 0;
                }
                if(scrollt < shrinkheader_height/1) {
                    newH = shrinkheader_height - scrollt/2;
                    header.removeClass('header-scrolled');
                }else{
                    newH = shrinkheader_height/2;
                    header.addClass('header-scrolled');
                }
                menu.css({'height': newH + 'px', 'lineHeight': newH + 'px'});
                mobilemenu.css({'height': newH + 'px', 'lineHeight': newH + 'px'});
                headershrink.css({'height': newH + 'px', 'lineHeight': newH + 'px'});
                header.css({'height': newH + topbar_height + 'px'});
                logo.css({'height': newH + 'px', 'lineHeight': newH + 'px'});
                logobox.css({'maxHeight': newH + 'px'});
                header.sticky('update');
            };
		if (shrinkheader == 1 && stickyheader == 1 && $(window).width() > 992 ){
			header.sticky({topSpacing:topOffest});
			win.scroll(set_height);
			set_height();
		} else if (stickyheader == 1 && $(window).width() > 992 ) {
			header.sticky({topSpacing:topOffest});
			header.sticky('update');
		} else if (shrinkheader == 1 && stickyheader == 1 && mobilestickyheader == 1 && $(window).width() < 992 ) {
			header.sticky({topSpacing:topOffest});
			var win_height = $(window).height();
			var mobileh_height = +shrinkheader_height + (+topbar_height);
			win.scroll(set_height);
			set_height();
			mobilebox.css({'maxHeight': win_height - mobileh_height + 'px'});
		} else if (stickyheader == 1 && mobilestickyheader == 1 && $(window).width() < 992 ) {
			header.sticky({topSpacing:topOffest});
			var win_height = $(window).height();
			var mobileh_height = +shrinkheader_height + (+topbar_height);
			mobilebox.css({'maxHeight': win_height - mobileh_height + 'px'});
			header.sticky('update');
		}

	}
	header.imagesLoadedn( function() {
	kad_sticky_header();
	});
	//Superfish Menu
		$('ul.sf-menu').superfish({
			delay:       200,                            // one second delay on mouseout
			animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
			speed:       'fast'                          // faster animation speed
		});
	// Fullwidth Pagebuilder 
	function kad_fullwidth_panel() {
		$('.kt-panel-row-stretch').each(function(){
			var margins = $(window).width() - $(this).parent('.panel-grid').width();
			$(this).css({'padding-left': margins/2 + 'px'});
			$(this).css({'padding-right': margins/2 + 'px'});
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'visibility': 'visible'});
		});
		$('.panel-row-style-wide-grey').each(function(){
			var margins = $(window).width() - $(this).parent('.panel-grid').width();
			$(this).css({'padding-left': margins/2 + 'px'});
			$(this).css({'padding-right': margins/2 + 'px'});
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'visibility': 'visible'});
		});
		$('.panel-row-style-wide-feature').each(function(){
			var margins = $(window).width() - $(this).parent('.panel-grid').width();
			$(this).css({'padding-left': margins/2 + 'px'});
			$(this).css({'padding-right': margins/2 + 'px'});
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'visibility': 'visible'});
		});
		$('.panel-row-style-wide-parallax').each(function(){
			var margins = $(window).width() - $(this).parents('#content').width();
			$(this).css({'padding-left': margins/2 + 'px'});
			$(this).css({'padding-right': margins/2 + 'px'});
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'visibility': 'visible'});
		});
		$('.panel-row-style-wide-content').each(function(){
			var margins = $(window).width() - $(this).parents('#content').width();
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'width': + $(window).width() + 'px'});
			$(this).css({'visibility': 'visible'});
		});
		$('.kt-panel-row-full-stretch').each(function(){
			var margins = $(window).width() - $(this).parent('.panel-grid').width();
			$(this).css({'margin-left': '-' + margins/2 + 'px'});
			$(this).css({'margin-right': '-' + margins/2 + 'px'});
			$(this).css({'width': + $(window).width() + 'px'});
			$(this).css({'visibility': 'visible'});
		});
	}
	kad_fullwidth_panel();
	$(window).on("debouncedresize", function( event ) {kad_fullwidth_panel();});

	// animate in
    var $animate = $('body').attr('data-animate');
    	if( $animate == 1 && $(window).width() > 790 && !kt_isMobile.any()) {
            //fadein
            $('.kad-animation').each(function() {
            $(this).appear(function() {
            $(this).delay($(this).attr('data-delay')).animate({'opacity' : 1, 'top' : 0},800,'swing');},{accX: 0, accY: -25},'easeInCubic');
            });
		       function kt_header_parallax() {
			 	var coords = $(window).scrollTop()*-0.004;
				 $('#pageheader .page-header').css({ opacity:coords+1 });
				}
				$('#pageheader .page-header').css({ opacity: 1});
				$(window).scroll(kt_header_parallax);
	    } else {
    	$('.kad-animation').each(function() {
    		$(this).animate({'opacity' : 1, 'top' : 0});
    	});
    }
     //init Flexslider
     $('.kt-flexslider').each(function(){
	 	var flex_speed = $(this).data('flex-speed'),
		flex_animation = $(this).data('flex-animation'),
		flex_initdelay = $(this).data('flex-initdelay'),
		flex_animation_speed = $(this).data('flex-anim-speed'),
		flex_auto = $(this).data('flex-auto');
		if(flex_initdelay == null) {flex_initdelay = 0;}
	 	$('.kt-flexslider').flexslider({
	 		animation: flex_animation,
			animationSpeed: flex_animation_speed,
			slideshow: flex_auto,
			initDelay: flex_initdelay,
			slideshowSpeed: flex_speed,
			start: function ( slider ) {
				jQuery( '.flexslider' ).removeClass( 'loading' );
			}
		});
    });

     //init isotope
        //init isotope

    $('.init-isotope').each(function(){
    	var isocontainer = $(this),
    	iso_selector = $(this).data('iso-selector'),
    	iso_style = $(this).data('iso-style'),
    	iso_filter = $(this).data('iso-filter');
    	if(iso_style == null) {iso_style = 'masonry';}
    	if(iso_filter == null) {iso_filter = 'false';}
		isocontainer.imagesLoadedn( function(){
			isocontainer.isotopeb({masonry: {columnWidth: iso_selector}, layoutMode:iso_style, itemSelector: iso_selector, transitionDuration: '0.8s'});
			if(isocontainer.attr('data-fade-in') == 1) {
				var isochild = isocontainer.find('.kt_item_fade_in');
				isochild.css('opacity',0);
					isochild.each(function(i){
									$(this).delay(i*150).animate({'opacity':1},350);
					});
			}
			if(iso_filter == true) {
			var thisparent = isocontainer.parents('.main');
			var thisfilters = thisparent.find('#filters');
				if(thisfilters.length) {
				thisfilters.on( 'click', 'a', function( event ) {
						var filtr = $(this).attr('data-filter');
						isocontainer.isotopeb({ filter: filtr });
						  return false; 
					});
					var $optionSets = $('#options .option-set'),
	          		$optionLinks = $optionSets.find('a');	
					$optionLinks.click(function(){ 
						var $this = $(this); if ( $this.hasClass('selected') ) {return false;}
						var $optionSet = $this.parents('.option-set'); $optionSet.find('.selected').removeClass('selected'); $this.addClass('selected');
					});
				}
			}
		});
				
	});
	$('.init-isotope-varwidth').each(function(){
    	var isocontainer = $(this);
		isocontainer.imagesLoadedn( function(){
			if(isocontainer.attr('data-fade-in') == 1) {
				var isochild = isocontainer.find('.kt_item_fade_in');
				isochild.css('opacity',0);
					isochild.each(function(i){
									$(this).delay(i*150).animate({'opacity':1},350);
					});
			}
		});
				
	});
	$('.init-mosaic-isotope').each(function(){
    	var isocontainer = $(this),
    	iso_selector = $(this).data('iso-selector'),
    	iso_style = $(this).data('iso-style'),
    	iso_filter = $(this).data('iso-filter');
		isocontainer.imagesLoadedn( function(){
			isocontainer.isotopeb({layoutMode:iso_style, itemSelector: iso_selector, transitionDuration: '0s'});
			if(isocontainer.attr('data-fade-in') == 1) {
				var isochild = isocontainer.find('.kt_item_fade_in');
				isochild.css('opacity',0);
					isochild.each(function(i){
									$(this).delay(i*150).animate({'opacity':1},350);
					});
			}
			if(iso_filter == true) {
				var thisparent = isocontainer.parents('.main');
				var thisfilters = thisparent.find('#filters');
				if(thisfilters.length) {
				thisfilters.on( 'click', 'a', function( event ) {
						var filtr = $(this).attr('data-filter');
						isocontainer.isotopeb({ filter: filtr });
						  return false; 
					});
					var $optionSets = $('#options .option-set'),
	          		$optionLinks = $optionSets.find('a');	
					$optionLinks.click(function(){ 
						var $this = $(this); if ( $this.hasClass('selected') ) {return false;}
						var $optionSet = $this.parents('.option-set'); $optionSet.find('.selected').removeClass('selected'); $this.addClass('selected');
					});
				}
			}
		});
				
	});
if ($('.woocommerce-tabs .panel .init-isotope').length) {
		var $container = $('.init-isotope'),
		iso_selector = $('.init-isotope').data('iso-selector');
		function woo_refreash_iso(){
			$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		}
	$('.woocommerce-tabs ul.tabs li a' ).click( function() {
		setTimeout(woo_refreash_iso, 50);
	});
}
if ($('.panel-body .init-isotope').length) {
		var $container = $('.init-isotope'),
		iso_selector = $('.init-isotope').data('iso-selector');
		$('.panel-group').on('shown.bs.collapse', function  (e) {
		$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		});
	}
	if ($('.tab-pane .init-isotope').length) {
		var $container = $('.init-isotope'),
		iso_selector = $('.init-isotope').data('iso-selector');
		$('.sc_tabs').on('shown.bs.tab', function  (e) {
			$container.isotopeb({masonry: {columnWidth: iso_selector}, transitionDuration: '0s'});
		});
	}
	 //init carousel
     jQuery('.initcaroufedsel').each(function(){
     	  var container = jQuery(this);
          var wcontainerclass = container.data('carousel-container'), 
          cspeed = container.data('carousel-speed'),
          cscroll = container.data('carousel-scroll'), 
          ctransition = container.data('carousel-transition'),
          cauto = container.data('carousel-auto'),
          carouselid = container.data('carousel-id'),
          ss = container.data('carousel-ss'), 
          xs = container.data('carousel-xs'),
          sm = container.data('carousel-sm'),
          md = container.data('carousel-md'), 
          xl = container.data('carousel-xl'), 
          sxl = container.data('carousel-sxl');
          var wcontainer = jQuery(wcontainerclass);

          function getUnitWidth() {
          	var width;
          if(jQuery(window).width() <= 540) {
          width = wcontainer.width() / ss;
          } else if(jQuery(window).width() <= 768) {
          width = wcontainer.width() / xs;
          } else if(jQuery(window).width() <= 990) {
          width = wcontainer.width() / sm;
          } else if(jQuery(window).width() >= 1800) {
          width = wcontainer.width() / sxl;
          }else if(jQuery(window).width() >= 1360) {
          width = wcontainer.width() / xl;
          } else {
          width = wcontainer.width() / md;
          }
          return width;
          }

          function setWidths() {
          var unitWidth = getUnitWidth() -1;
          container.children().css({ width: unitWidth });
          }
          setWidths();
          function initCarousel() {
          container.carouFredSel({
            scroll: {items:cscroll, easing: "swing", duration: ctransition, pauseOnHover : true}, 
            auto: {play: cauto, timeoutDuration: cspeed},
              prev: '#prevport-'+carouselid, next: '#nextport-'+carouselid, pagination: false, swipe: true, items: {visible: null}
            });
	      }
	      container.imagesLoadedn( function(){
          	initCarousel();
          	wcontainer.animate({'opacity' : 1});
      		});
          	jQuery(window).on("debouncedresize", function( event ) {
          		container.trigger("destroy");
          		setWidths();
          		initCarousel();
          	});
    });
		//init carouselslider
	    jQuery('.initcarouselslider').each(function(){
	     	  var container = jQuery(this);
	          var wcontainerclass = container.data('carousel-container'), 
	          cspeed = container.data('carousel-speed'), 
	          ctransition = container.data('carousel-transition'),
	          cauto = container.data('carousel-auto'),
	          carouselid = container.data('carousel-id'),
	          carheight = container.data('carousel-height'),
	          align = 'center';
	          var wcontainer = jQuery(wcontainerclass);

	          function setWidths() {
	            var unitWidth = container.width();
	            container.children().css({ width: unitWidth });
	              if(jQuery(window).width() <= 768) {
	                  carheight = null;
	                  container.children().css({ height: 'auto' });
	              }
	          }
	          setWidths();
	          function initCarouselslider() {
	            container.carouFredSel({
	              width: '100%',
	              height: carheight,
	              align: align,
	              auto: {play: cauto, timeoutDuration: cspeed},
	              scroll: {items : 1,easing: 'quadratic'},
	              items: {visible: 1,width: 'variable'},
	              prev: '#prevport-'+carouselid,
	              next: '#nextport-'+carouselid,
	              swipe: {onMouse: false,onTouch: true},
	            });
		      }
		      container.imagesLoadedn( function(){
	          	initCarouselslider();
	            wcontainer.animate({'opacity' : 1});
	            wcontainer.css({ height: 'auto' });
	            wcontainer.parent().removeClass('loading');
	      	});
	          	jQuery(window).on("debouncedresize", function( event ) {
	          		container.trigger("destroy");
	          		setWidths();
	          		initCarouselslider();
	          	});
	    });
    //init image carousel
    jQuery('.initimagecarousel').each(function(){
     	  var container = jQuery(this);
          var wcontainerclass = container.data('carousel-container'), 
          cspeed = container.data('carousel-speed'), 
          ctransition = container.data('carousel-transition'),
          cauto = container.data('carousel-auto'),
          carouselid = container.data('carousel-id'),
          carheight = container.data('carousel-height'),
          align = false;
          var wcontainer = jQuery(wcontainerclass);

          function setWidths() {
          	if(jQuery(window).width() <= 767) {
            	align = 'center';
                carheight = null;
                var unitWidth = jQuery(window).width() -10;
                container.children().css({ width: unitWidth });
                container.children().css({ height: 'auto' });
            }
          }
          setWidths();
        function initImageCarousel() {
            container.carouFredSel({
				width: '100%',
				height: carheight,
				align: align,
				auto: {play: true, timeoutDuration: 7000},
				scroll: {items : 1,easing: 'quadratic'},
				items: {visible: 1, width: 'variable'},
                prev: '#prevport-'+carouselid, 
                next: '#nextport-'+carouselid,
                swipe: {onMouse: true,onTouch: true},
                onCreate: function() {
					jQuery('.gallery-carousel').css('positon','static');
				}
            });
	      }
	    container.imagesLoadedn( function(){
          	initImageCarousel();
            wcontainer.animate({'opacity' : 1});
            wcontainer.css({ height: 'auto' });
            wcontainer.parent('.loading').removeClass('loading');
      	});
          	jQuery(window).on("debouncedresize", function( event ) {
          		container.trigger("destroy");
          		setWidths();
          		initImageCarousel();
          	});
    });

});

if( kt_isMobile.any() ) {
jQuery(document).ready(function ($) {
		jQuery('.caroufedselclass').tswipe({
			              excludedElements:"button, input, select, textarea, .noSwipe",
						   tswipeLeft: function() {
							jQuery('.caroufedselclass').trigger('next', 1);
						  },
						  tswipeRight: function() {
							jQuery('.caroufedselclass').trigger('prev', 1);
						  },
						  tap: function(event, target) {
							window.open(jQuery(target).closest('.grid_item').find('a').attr('href'), '_self');
						  }
		});
		jQuery('.caroufedselgallery').tswipe({
			              excludedElements:"button, input, select, textarea, .noSwipe",
						   tswipeLeft: function() {
							jQuery('.caroufedselgallery').trigger('next', 1);
						  },
						  tswipeRight: function() {
							jQuery('.caroufedselgallery').trigger('prev', 1);
						  },
						  tap: function(event, target) {
						  	var tid = $(target).data("grid-id");
							$(target).closest('a.lightboxhover').magnificPopup('open', tid);
						  }
		});
	});
}
jQuery( window ).load(function () {
	   jQuery.stellar({
    	horizontalScrolling: false,
		verticalOffset: 40
    });
	jQuery('body').animate({'opacity' : 1});
});


