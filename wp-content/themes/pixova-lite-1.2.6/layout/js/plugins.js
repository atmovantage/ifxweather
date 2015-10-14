(function($) {


    'use strict';

    /* ==========================================================================
                     When document is ready, do
   ========================================================================== */
    $(document).ready(function() {


        // Animate Pie Charts
        if(typeof $.fn.easyPieChart !== 'undefined') {
            if( $('.mt-chart').length ) {
                $('.mt-chart').each(function(){
                   
                        var $t = $(this),
                            n = $t.parent().width(),
                            l = "round";
                        
                        if ($t.attr("data-lineCap") !== undefined) {
                            l = $t.attr("data-lineCap");
                        } 

                        // Set dimensions for Pie Charts
                        $(this).css({ "width" : n, "height": n, "line-height" : n + "px", "font-size": n/3  });
                        

                    $t.easyPieChart({
                        lineCap: l,
                        lineWidth: $t.attr("data-lineWidth"),
                        size: n,
                        barColor: $t.attr("data-barColor"),
                        trackColor: $t.attr("data-trackColor"),
                        scaleColor: "transparent",
                    });
                });
            }
        }


        // Owl Carousel - used to create carousels throughout the site
        // http://owlgraphic.com/owlcarousel/
        if(typeof $.fn.owlCarousel != 'undefined' ) {

         
            var owl = $("#mt-twitter-carousel");

           

            // Footer Twitter Widget
            if(owl.length !== 0 ) {
                owl.owlCarousel({
                    items: 1,
                    singleItem: true,
                    pagination: true,
                    mouseDrag  : false,
                });
            }    

                /* ==============================================================================================================
                    Since we're using different owl carousel configurations for different breakpoints, 
                    we've decided against using CSS to re-style the nav icons and better leave it for Owl Carousel 
                    to handle the responsiveness part
                 ============================================================================================================== */
                 
                if(viewportSize.getWidth() > 768) {

                	$('.big-testimonial').each(function(){
                		var owl3 = $(this);

                	// testimonials box (featured testimonials)
                    owl3.owlCarousel({
                        items: 1,           // This variable allows you to set the maximum amount of items displayed at a time with the widest browser width
                        navigation:true,    // Display "next" and "prev" buttons.
                        pagination: false,  // no pagination
                        navigationText: [   // custom navigation text (instead of bullets). navigationText : false to disable arrows / bullets
                          "<i class='fa fa-angle-left'></i>",
                          "<i class='fa fa-angle-right'></i>"
                          ],
                        singleItem: true,
                      });


                	});

                    
                } else {

                	$('.big-testimonial').each(function(){
                		var owl3 = $(this);

                // testimonials box (featured testimonials)
                    owl3.owlCarousel({
                        items: 1,           // This variable allows you to set the maximum amount of items displayed at a time with the widest browser width
                        navigation: false,    // Display "next" and "prev" buttons.
                        pagination: true,  // no pagination
                        singleItem: true,
                      });
                   });
                }
            

                /*
                *  Custom Owl Carousel Navigation Events
                *  
                *   Trigger Owl Carousel specific events when clicking on next / prev buttons
                *
                *   @see  http://owlgraphic.com/owlcarousel/#customizing (Custom Events)
                */
                $(".next").on('click', function(){
                    owl.trigger('owl.next');
                })
                $(".prev").on('click', function(){
                    owl.trigger('owl.prev');
                })    

        }

        // simplePlaceholder - polyfill for mimicking the HTML5 placeholder attribute using jQuery
        // https://github.com/marcgg/Simple-Placeholder/blob/master/README.md
        if(typeof $.fn.simplePlaceholder != 'undefined'){

            $('input[placeholder], textarea[placeholder]').simplePlaceholder();

        }

       new WOW().init();

        /* ==========================================================================
           When the window is scrolled, do
           ========================================================================== */

        $(window).scroll(function() {



        });
    });

})(window.jQuery);

//non jQuery plugins below