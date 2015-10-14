 (function($) {


  'use strict';


/* ==========================================================================
        Page Preloader
========================================================================== */

    function PagePreloader() {


    new QueryLoader2(document.querySelector("body"), {
        barColor: "#1b1b1b",
        backgroundColor: "#EFEFEF",
        percentage: true,
        barHeight: 3,
        minimumTime: 1500,
        fadeOutTime: 400,
        onComplete: function() {
          $("#container, #footer").css({"visibility": "visible"});
        },
    });
  }



 jQuery(window).load(function($){
      PagePreloader();
  });

 })(window.jQuery);