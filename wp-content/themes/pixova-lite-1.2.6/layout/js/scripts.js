(function($) {


    'use strict';

    /* ==========================================================================
     Return viewport size (width / height)
     @see https://github.com/tysonmatanich/viewportSize
     ========================================================================== */

    window.viewportSize = {};
    window.viewportSize.getWidth = function() {
        return getSize("Width");
    };

    var getSize = function(Name) {
        var size;
        var name = Name.toLowerCase();
        var document = window.document;
        var documentElement = document.documentElement;
        if (window["inner" + Name] === undefined) {
            // IE6 & IE7 don't have window.innerWidth or innerHeight
            size = documentElement["client" + Name];
        } else if (window["inner" + Name] != documentElement["client" + Name]) {
            // WebKit doesn't include scrollbars while calculating viewport size so we have to get fancy
            // Insert markup to test if a media query will match document.doumentElement["client" + Name]
            var bodyElement = document.createElement("body");
            bodyElement.id = "vpw-test-b";
            bodyElement.style.cssText = "overflow:scroll";
            var divElement = document.createElement("div");
            divElement.id = "vpw-test-d";
            divElement.style.cssText = "position:absolute;top:-1000px";
            // Getting specific on the CSS selector so it won't get overridden easily
            divElement.innerHTML = "<style>@media(" + name + ":" + documentElement["client" + Name] + "px){body#vpw-test-b div#vpw-test-d{" + name + ":7px!important}}</style>";
            bodyElement.appendChild(divElement);
            documentElement.insertBefore(bodyElement, document.head);
            if (divElement["offset" + Name] == 7) {
                // Media query matches document.documentElement["client" + Name]
                size = documentElement["client" + Name];
            } else {
                // Media query didn't match, use window["inner" + Name]
                size = window["inner" + Name];
            }
            // Cleanup
            documentElement.removeChild(bodyElement);
        } else {
            // Default to use window["inner" + Name]
            size = window["inner" + Name];
        }
        return size;
    };

    /* ==========================================================================
     Smooth Parallax Effect
     @see https://github.com/tysonmatanich/viewportSize
     ========================================================================== */

    var lastScrollY = 0,
        ticking = false,
        bgElm = document.getElementsByClassName('parallax-bg-image'),
        i = 0,
        speedDivider = 2;

    // Update scroll value and request tick
    var ParallaxDoScroll = function() {
        lastScrollY = window.pageYOffset;
        ParallaxRequestTick();
    };

    var ParallaxRequestTick = function() {
        if (!ticking) {
            window.requestAnimationFrame(ParallaxUpdatePosition);
            ticking = true;
        }
    };

    var ParallaxUpdatePosition = function() {

        var translateValue = lastScrollY / speedDivider;

        // We don't want parallax to happen if scrollpos is below 0
        if (translateValue < 0)
            translateValue = 0;


        for (i = 0; i < bgElm.length; i++) {
            //bgElm[i].style.backgroundColor = "red";
            ParallaxTranslateY3d(bgElm[i], translateValue)
        }

        // Stop ticking
        ticking = false;

    };

    // Translates an element on the Y axis using translate3d
    // to ensure that the rendering is done by the GPU
    var ParallaxTranslateY3d = function(elm, value) {
        var translate = 'translate3d(0px,' + value + 'px, 0px)';
        elm.style['-webkit-transform'] = translate;
        elm.style['-moz-transform'] = translate;
        elm.style['-ms-transform'] = translate;
        elm.style['-o-transform'] = translate;
        elm.style.transform = translate;
    };


    /* ==========================================================================
     ieViewportFix - fixes viewport problem in IE 10 SnapMode and IE Mobile 10
     ========================================================================== */

    function ieViewportFix() {

        var msViewportStyle = document.createElement("style");

        msViewportStyle.appendChild(
            document.createTextNode(
                "@-ms-viewport { width: device-width; }"
            )
        );
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {

            msViewportStyle.appendChild(
                document.createTextNode(
                    "@-ms-viewport { width: auto !important; }"
                )
            );
        }

        document.getElementsByTagName("head")[0].
            appendChild(msViewportStyle);
    }

    /*============================================================================================
     Function for adding / removing the CSS classes required for making the navbar shrink on scroll
     ================================================================================================== */

    function initNavbar() {

        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 1,
            header = document.querySelector("header");
        //expandNav = document.querySelector("#header-wrap .header");
        if (distanceY > shrinkOn) {
            classie.add(header, "smaller");
        } else {
            if (classie.has(header, "smaller")) {
                classie.remove(header, "smaller");
            }
        }

    }


    /* ==========================================================================
     Show menu links on hover
     ========================================================================== */

    function showMenuOnHover() {


        //only expand menu on hover on screens bigger than 640px
        if (viewportSize.getWidth() > 670) {
            $('#nav-expander').on('mouseenter', function() {
                $('.main-navigation').addClass('visible');
            });
            $('#header-wrap').on('mouseleave', function() {
                $('.main-navigation').removeClass('visible');
            });
        } else if (viewportSize.getWidth() <= 670) {
            //only expand menu on click on screens smaller than 640px
            $('#nav-expander').on('click', function(e) {
                $('.offset-canvas-mobile').addClass('open-canvas');
                e.preventDefault();
            });
            $('.mobile-nav-close-btn').on('click', function() {
                $('.offset-canvas-mobile').removeClass('open-canvas');
            });
            $('.mobile-nav-holder a').on('click', function() {
                $('.offset-canvas-mobile').removeClass('open-canvas');
            });
        }
    }

    /* ==========================================================================
     Smooth scrolling
     ========================================================================== */

    function smoothScrollAnchors() {

        $('a[href*=#]:not([href=#])').on('click', function() {


            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }


        });
    }

    /* ==========================================================================
     Mobile Detection
     ========================================================================== */

    function isMobile(){
        return (
            (navigator.userAgent.match(/Android/i)) ||
            (navigator.userAgent.match(/webOS/i)) ||
            (navigator.userAgent.match(/iPhone/i)) ||
            (navigator.userAgent.match(/iPod/i)) ||
            (navigator.userAgent.match(/iPad/i)) ||
            (navigator.userAgent.match(/BlackBerry/))
        );
    }


    /* ==========================================================================
     isTouchDevice - return true if it is a touch device
     ========================================================================== */

    function isTouchDevice() {
        return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
    }


    /* ==========================================================================
     Remove behaviour of anchors linking to #
     ========================================================================== */

    function removeAnchors(){
        $('a[href=#]').on('click', function(e){
            e.preventDefault();
        });
    }


    /* ==========================================================================
     Page Animations
     ========================================================================== */

    function animateElements() {
        if ($('.btn-cta-intro').length ){
            $('.btn-cta-intro').each(function(){
                $(this).addClass('wow bounceInUp');
            });
        }

        if ($('#about .container').length ){
            $('#about .container').each(function(){
                $(this).addClass('wow bounceInUp');
            });
        }

        if ($('#works .container').length ){
            $('#works .container').each(function(){
                $(this).addClass('wow slideInLeft');
            });
        }

        if ($('#testimonials .container').length ){
            $('#testimonials .container').each(function(){
                $(this).addClass('wow slideInRight');
            });
        }

        if ($('#news .container').length ){
            $('#news .container').each(function(){
                $(this).addClass('wow slideInRight');
            });
        }

        if ($('#team .container').length ){
            $('#team .container').each(function(){
                $(this).addClass('wow bounceInUp');
            });
        }

        if ($('#contact .container').length ){
            $('#contact .container').each(function(){
                $(this).addClass('wow slideInRight');
            });
        }

        if( $(".section-heading").length && $(".section-heading > span").length ) {
            $(".section-heading").each(function(){
                $(this).addClass('wow fadeIn');
            });
        }

    }


    /* ==========================================================================
     Back to top function
     ========================================================================== */

    function MTBackToTop() {

        // browser window scroll (in pixels) after which the "back to top" link is shown
        var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
            offset_opacity = 300,
        //duration of the top scrolling animation (in ms)
            scroll_top_duration = 700,
        //grab the "back to top" link
            $back_to_top = $('.mt-top');

        //hide or show the "back to top" link
        $(window).scroll(function(){
            ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('mt-is-visible') : $back_to_top.removeClass('mt-is-visible mt-fade-out');
            if( $(this).scrollTop() > offset_opacity ) {
                $back_to_top.addClass('mt-fade-out');
            }
        });

        //smooth scroll to top
        $back_to_top.on('click', function(event){
            event.preventDefault();
            $('body,html').animate({
                    scrollTop: 0 ,
                }, scroll_top_duration
            );
        });

    }


    /* ==========================================================================
     Align team members to center
     ========================================================================== */
    function teamsettings() {

        $('.mt-team').parent().addClass('align-center');
        $('.mt-team').on('mouseenter', function(){
            $(this).find('.mt-team-description').addClass('mt-is-visible')
        }).on('mouseleave', function(){
            $(this).find('.mt-team-description').removeClass('mt-is-visible');
        });

    }


    /* ==========================================================================
     When document is ready, do
     ========================================================================== */
    jQuery(document).ready(function($) {

        animateElements();
        ieViewportFix();
        showMenuOnHover();
        smoothScrollAnchors();
        removeAnchors();
        MTBackToTop();
        teamsettings();
    });

    jQuery(window).scroll(function($) {

        initNavbar();
        if(!isMobile()) {
            ParallaxDoScroll();
        }

    });


})(window.jQuery);
// non jQuery functions go below