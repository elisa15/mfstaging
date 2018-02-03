/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        if( $(window).height() > 400 ) {
          $('.work #top, .single-work #top, .error404 #top').height( $(window).height() );
        }
        $('.content-info h3, #top h1, .home .additional-content h3, .single-work #body aside h3').wrapInner('<span></span>');
        $('.pagetoscroll').localScroll({ hash:false, easing:'easeInOutExpo', offset: -80 });
        /*var swiper = new Swiper ('.swiper-container', {
          paginationClickable: true,
          autoplay: 4000,
          spaceBetween: 2,
          parallax: true,
          speed: 1000,
          pagination: '.swiper-pagination',
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev'
        });*/
        var $grid = $('.works-list, .blog-list');
        $grid.imagesLoaded( function() {
          $grid.isotope({
            layoutMode : 'fitRows'
          });
        });


        $('.blog-list').infinitescroll({
            navSelector  : '.nav-links', 
            nextSelector : '.nav-links .nav-previous a',
            itemSelector : 'article',
            loading: {
              finishedMsg: '<em>No more posts.</em>',
              msgText: '<em>Loading older posts...</em>',
              img: 'http://localhost:3000/outsource/follow/follownew/wp-content/themes/sage-starter/dist/images/loader.gif'
            }
          }, function( newElements ) {
            $grid.isotope( 'appended', $( newElements ) ); 
          }
        );
        $('.works-filter .dropdown-menu li').on('click', function(){
          $(this).parents('.works-filter').find('label').text( $(this).text() );
          var filterValue = $(this).attr('data-filter');
          $grid.isotope({ filter: filterValue });
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
       /// document.addEventListener('DOMContentLoaded', function(){
          // if(document.getElementById("typestrings") != null){
             var strings = document.getElementById("typestrings").innerHTML;
             var res = new Array();
             res = strings.split(", ");
             Typed.new('.typed', {
               strings: res,
               typeSpeed: 80,
               starDelay: 1000,
               backDelay: 2000,
               loop: true,
             });
           //}
       //  });
        //domcontentloaded end

        //----------------------post carousel---------------------//
        var owl = jQuery('#featured-slider');
        owl.owlCarousel({
          items:1,
          center:true,
          loop:true,
          margin:10,
          dots: true,
          nav: true,
          stagePadding:250,
          autoplay:false,
          autoplayTimeout:1000,
          dotClass: 'owl-dot',
          dotsClass: 'owl-dots',
          autoplayHoverPause:true,
          navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
          responsive:{
                        0:{
                            items:1,
                            stagePadding:30,
                            nav:false,
                            loop:false
                        },
                        600:{
                            items:1,
                            stagePadding:280,
                            nav:false
                        },
                        1000:{
                            items:1,
                            nav:true,
                            stagePadding:280,
                            dots: true,
                            loop:true
                        }
                    }
        });
        //------------carousel end------------------
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // Single post, note the change.
    'single': {
      init: function() {
        // JavaScript to be fired on the single page
         //----------------------post carousel---------------------//
         var owl = jQuery('#testimonial-slider');
         owl.owlCarousel({
           items:1,
           center:true,
           loop:true,
           margin:10,
           dots: true,
           nav: true,
           stagePadding:0,
           autoplay:false,
           autoplayTimeout:1000,
           dotClass: 'owl-dot',
           dotsClass: 'owl-dots',
           autoplayHoverPause:true,
           navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
           responsive:{
                         0:{
                             items:1,
                             stagePadding:0,
                             nav:false,
                             loop:false
                         },
                         600:{
                             items:1,
                             stagePadding:0,
                             nav:false
                         },
                         1000:{
                             items:1,
                             nav:true,
                             stagePadding:0,
                             dots: true,
                             loop:true
                         }
                     }
         });
         //------------carousel end------------------
      }
    },
    // about post, note the change.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the single page
        
      }
    },
    // Services page, note the change from about-us to about_us.
    'page_id_8': {
      init: function() {
        // JavaScript to be fired on the services page
        //----------------------post carousel---------------------//
        var owl = jQuery('#testimonial-slider');
        owl.owlCarousel({
          items:1,
          center:true,
          loop:true,
          margin:10,
          dots: true,
          nav: true,
          stagePadding:0,
          autoplay:false,
          autoplayTimeout:1000,
          dotClass: 'owl-dot',
          dotsClass: 'owl-dots',
          autoplayHoverPause:true,
          navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
          responsive:{
                        0:{
                            items:1,
                            stagePadding:0,
                            nav:false,
                            loop:false
                        },
                        600:{
                            items:1,
                            stagePadding:0,
                            nav:false
                        },
                        1000:{
                            items:1,
                            nav:true,
                            stagePadding:0,
                            dots: true,
                            loop:true
                        }
                    }
        });
        //------------carousel end------------------
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };
  
  // Load Events
  $(document).ready(UTIL.loadEvents);
  $(window).resize(function() {
    if( $(window).height() > 400 ) {
      $('.work #top, .single-work #top, .error404 #top').height( $(window).height() );
    }
    if( $(window).width() > 1199 ) {
        $('.applyheight').each( function(e){
        	$(this).find('> div').css('height','inherit');
        	var height = $(this).height();
        	$(this).find('> div').height( height );
        });
    }else{
        $('.applyheight').each( function(e){
        	$(this).find('> div').css('height','inherit');
        });
    }
   });
  $(window).scroll(function() {
      if ($('.navbar').offset().top > 50) {
          $('.navbar-fixed-top').addClass('nav-scrolled');
      } else {
          $('.navbar-fixed-top').removeClass('nav-scrolled');
      }
  });

     
})(jQuery); // Fully reference jQuery after this point.

jQuery(window).load( function(){
    if( jQuery(window).width() > 1199 ) {
        jQuery('.applyheight').each( function(e){
        	var height = jQuery(this).height();
        	jQuery(this).find('> div').height( height );
        });
        jQuery('.wrapme').wrapInner('<div class="vmiddle"></div>');
    }

});



