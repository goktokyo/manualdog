<?php
/**
 * Plugin Name:       Manual Dog
 * Plugin URI:        https://espicurio.com/manualdog
 * Description:       A plugin to create and manage manuals that are only visible to authorized users within the WordPress admin area.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Tested up to:      6.8
 * Author:            Goji Kawai @ Espicurio Inc
 * Author URI:        https://espicurio.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       manualdog
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'MANUALDOG_VERSION' ) ) {
	define( 'MANUALDOG_VERSION', '1.0.1' );
}

// load_plugin_textdomain() is not needed for plugins hosted on WordPress.org.

/**
 * Include necessary files.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/post-types.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/admin-pages.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/dashboard.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/enqueue.php';
