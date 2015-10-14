/**
 * Upsell notice for theme
 */
 
( function( $ ) {
 
	// Add Upgrade Message
	if ('undefined' !== typeof prefixL10n) {
		upsell = $('<a class="prefix-upsell-link"></a>')
			.attr('href', prefixL10n.prefixURL)
			.attr('target', '_blank')
			.text(prefixL10n.prefixLabel)
			.css({
				'display' 			: 'inline-block',
				'background-color' 	: '#e25136',
				'color' 			: '#fff',
				'text-transform' 	: 'uppercase',
				'margin-top' 		: '6px',
				'padding' 			: '3px 6px',
				'font-size'			: '8px',
				'letter-spacing'	: '1px',
				'line-height'		: '1.5',
				'clear' 			: 'both',
				'border' 			: 'none',
				'border-radius' 	: '4px'
			})
		;
 
		setTimeout(function () {
			$('#accordion-section-themes h3').append(upsell);
		}, 200);
 
		// Remove accordion click event
		$('.prefix-upsell-link').on('click', function(e) {
			e.stopPropagation();
		});
	}
 
} )( jQuery );