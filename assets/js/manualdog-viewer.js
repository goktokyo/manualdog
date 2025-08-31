(function($) {
    'use strict';

    // This function runs when the DOM is ready.
    $(function() {
        // --- Logic for Viewer Page Sidebar Toggle ---
        var $sidebarToggle = $('.manualdog-sidebar-toggle');
        var $fullscreenWrapper = $('.manualdog-viewer-fullscreen');
        
        if ($sidebarToggle.length && $fullscreenWrapper.length) {
            var $mainContent = $('.manualdog-viewer-main');

            // When the hamburger icon is clicked
            $sidebarToggle.on('click', function(e) {
                e.stopPropagation(); // Prevents the main content click event from firing
                $fullscreenWrapper.toggleClass('sidebar-is-open');
            });

            // When the main content area is clicked (to close the sidebar)
            $mainContent.on('click', function() {
                if ($fullscreenWrapper.hasClass('sidebar-is-open')) {
                    $fullscreenWrapper.removeClass('sidebar-is-open');
                }
            });
        }
    });

})(jQuery);