=== Manual Dog ===
Contributors: espicurio
Contributors: espicurio
Tags: manual, guide, documentation, admin, internal
Requires at least: 5.2
Tested up to: 6.8
Stable tag: 1.0.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to create and manage manuals that are only visible to authorized users within the admin area.

== Description ==

ManualDog is a simple and intuitive manual management plugin designed for use within the WordPress admin area. It allows you to create, organize, and display manuals exclusively for logged-in users, making it perfect for client handoffs, internal company guides, or user documentation.

**Main Features**

*   **Admin-Only Access:** All manuals are restricted to the WordPress admin area and are not visible on the front-end.
*   **Gutenberg Ready:** Create rich and engaging manuals using the power of the block editor.
*   **Modern Viewer UI:** A clean, two-column interface with a navigation sidebar provides an immersive reading experience, separate from the standard WordPress UI.
*   **Hierarchical Organization:** Structure your manuals with parent-child relationships for easy navigation.
*   **Lightweight & Secure:** Built with best practices to be fast, reliable, and secure.

== Installation ==

1.  Upload the `manualdog` folder to the `/wp-content/plugins/` directory via FTP, or upload the ZIP file through the WordPress admin panel (`Plugins` > `Add New`).
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  A "Manuals" menu will be added to your admin sidebar. Start creating!

== Frequently Asked Questions ==

= Are the media files (images, PDFs) protected? =

In this free version, no. Media files uploaded to a manual are still publicly accessible if someone knows their direct URL. This is a standard WordPress behavior. The plugin shows a reminder about this on the edit screen. Full media protection is a feature planned for a future premium version.

= Can I customize the appearance? =

The settings page allows you to rename the admin menus. For deeper visual customizations, you would need to use custom CSS.

== Screenshots ==

1.  The modern, two-column manual viewer interface.
2.  The main index page listing all manuals.
3.  The easy-to-use settings page for renaming menus.
4.  The media file security alert on the manual edit screen.

== Changelog ==

= 1.0.1 =
*   Security Fix: Added nonce verification to the manual viewer page to prevent unauthorized access, as requested by the WordPress.org review team.
*   Security Fix: Enhanced sanitization for saved settings data using `map_deep`, as requested by the WordPress.org review team.
*   Updated "Tested up to" version for compatibility.

= 1.0.0 =
*   Initial release.

== Upgrade Notice ==

= 1.0.1 =
Security and compatibility update. Recommended for all users.

= 1.0.0 =
This is the first version of the plugin. Enjoy!