<?php
/**
 * Handles AJAX requests for saving manual sort order.
 *
 * @package ManualDog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Saves the manual sort order and hierarchy via AJAX.
 */
function manualdog_ajax_save_sort_order() {
	check_ajax_referer( 'manualdog_sort_nonce', 'nonce' );

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => __( 'Permission denied.', 'manualdog' ) ), 403 );
		return;
	}

	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Decoded and sanitized individually with absint() below.
	$items_json = isset( $_POST['items'] ) ? wp_unslash( $_POST['items'] ) : '';
	$items      = json_decode( $items_json, true );

	if ( ! is_array( $items ) ) {
		wp_send_json_error( array( 'message' => __( 'Invalid data.', 'manualdog' ) ), 400 );
		return;
	}

	foreach ( $items as $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}

		$id        = isset( $item['id'] ) ? absint( $item['id'] ) : 0;
		$parent_id = isset( $item['parent_id'] ) ? absint( $item['parent_id'] ) : 0;
		$order     = isset( $item['order'] ) ? absint( $item['order'] ) : 0;

		if ( ! $id ) {
			continue;
		}

		$post = get_post( $id );
		if ( ! $post || 'manualdog_manual' !== $post->post_type ) {
			continue;
		}

		wp_update_post(
			array(
				'ID'          => $id,
				'menu_order'  => $order,
				'post_parent' => $parent_id,
			)
		);
	}

	wp_send_json_success( array( 'message' => __( 'Order saved.', 'manualdog' ) ) );
}
add_action( 'wp_ajax_manualdog_save_sort_order', 'manualdog_ajax_save_sort_order' );
