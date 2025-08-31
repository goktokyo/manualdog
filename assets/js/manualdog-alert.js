(function( $, wp ) {
	'use strict';

	// Wait for the document to be ready
	$( function() {
		// Ensure wp.media exists
		if ( typeof wp === 'undefined' || typeof wp.media === 'undefined' ) {
			return;
		}

		// Keep track of the original media frame open function
		const originalMediaFrameOpen = wp.media.view.MediaFrame.Post.prototype.open;

		// Override the open function
		wp.media.view.MediaFrame.Post.prototype.open = function() {
			// Check if the alert has been shown in this session
			if ( sessionStorage.getItem('manualdog_media_alert_shown') !== 'true' ) {
				
				// Show the classic, reliable alert box with our translated message
				if ( typeof manualdog_l10n !== 'undefined' && manualdog_l10n.media_alert ) {
					alert( manualdog_l10n.media_alert );
				}

				// Mark as shown for this session to prevent repeated alerts
				sessionStorage.setItem('manualdog_media_alert_shown', 'true');
			}

			// Call the original open function to ensure the media library opens correctly
			return originalMediaFrameOpen.apply( this, arguments );
		};
	});

})( jQuery, window.wp );