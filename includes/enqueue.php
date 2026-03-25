<?php
/**
 * Enqueue scripts and styles for the admin area.
 *
 * @package ManualDog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueues scripts and styles based on the current admin screen.
 *
 * @param string $hook The current admin page hook.
 */
function manualdog_enqueue_admin_assets( $hook ) {
	// === For Manual Edit Screen (Add New / Edit) ===
	if ( ( 'post.php' === $hook || 'post-new.php' === $hook ) && 'manualdog_manual' === get_post_type() ) {
		// Enqueue JS for the media library alert.
		wp_enqueue_script(
			'manualdog-alert-script',
			plugins_url( '../assets/js/manualdog-alert.js', __FILE__ ),
			array( 'jquery', 'wp-i18n' ), // wp-i18n is needed for translation
			MANUALDOG_VERSION,
			true
		);
		// Pass the translated text to the script.
		wp_localize_script(
			'manualdog-alert-script',
			'manualdog_l10n',
			array(
				'media_alert' => __( 'Heads up! Media files (like images and videos) used in this manual can be accessed by anyone with the direct URL. Please handle with care.', 'manualdog' ),
			)
		);
	}

	// === For Custom Plugin Pages (Index & Viewer) ===
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

	if ( 'manualdog_manual_index' === $page || 'manualdog_manual_viewer' === $page ) {
		wp_enqueue_style( 'manualdog-admin-style', plugins_url( '../assets/css/manualdog-admin.css', __FILE__ ), array(), MANUALDOG_VERSION );
	}
	if ( 'manualdog_manual_viewer' === $page ) {
		wp_enqueue_script( 'manualdog-viewer-script', plugins_url( '../assets/js/manualdog-viewer.js', __FILE__ ), array( 'jquery' ), MANUALDOG_VERSION, true );
	}
	if ( 'manualdog_sort' === $page ) {
		wp_enqueue_style( 'manualdog-admin-style', plugins_url( '../assets/css/manualdog-admin.css', __FILE__ ), array(), MANUALDOG_VERSION );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script(
			'nestable2',
			plugins_url( '../assets/js/nestable2.min.js', __FILE__ ),
			array( 'jquery' ),
			'1.6.0',
			true
		);
		wp_enqueue_script(
			'manualdog-sort-script',
			plugins_url( '../assets/js/manualdog-sort.js', __FILE__ ),
			array( 'nestable2' ),
			MANUALDOG_VERSION,
			true
		);
		wp_localize_script(
			'manualdog-sort-script',
			'manualdog_sort_data',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'manualdog_sort_nonce' ),
				'i18n'     => array(
					'save'   => __( 'Save Order', 'manualdog' ),
					'saving' => __( 'Saving...', 'manualdog' ),
					'saved'  => __( 'Saved!', 'manualdog' ),
					'error'  => __( 'An error occurred. Please try again.', 'manualdog' ),
				),
			)
		);
	}
	if ( 'manualdog_all_manuals' === $page ) {
		wp_enqueue_style( 'manualdog-admin-style', plugins_url( '../assets/css/manualdog-admin.css', __FILE__ ), array(), MANUALDOG_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'manualdog_enqueue_admin_assets' );