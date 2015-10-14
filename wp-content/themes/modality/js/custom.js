var script=jQuery.noConflict();
script(document).ready(function($) {
	function onAfter(curr, next, opts, fwd) {
		 var $ht = $(this).height();

		  //set the container's height to that of the current slide
		 $(this).parent().animate({height: $ht});
	}
						
    $(".imgLiquidFill").imgLiquid();

});
				