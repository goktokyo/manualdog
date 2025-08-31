<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Delete saved options on uninstallation
delete_option('manualdog_menu_names');
// If you have other options or custom tables, delete them here as well.