<?php
/**
 * Handles the dashboard widget for ManualDog.
 *
 * @package ManualDog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the dashboard widget.
 */
function manualdog_add_dashboard_widget() {
	if ( current_user_can( 'edit_posts' ) ) {
		wp_add_dashboard_widget(
			'manualdog_dashboard_widget',
			esc_html__( 'Recent Manual Updates', 'manualdog' ),
			'manualdog_render_dashboard_widget'
		);
	}
}
add_action( 'wp_dashboard_setup', 'manualdog_add_dashboard_widget' );

/**
 * Renders the dashboard widget content.
 */
function manualdog_render_dashboard_widget() {
	$query = new WP_Query(
		array(
			'post_type'      => 'manualdog_manual',
			'posts_per_page' => 5,
			'post_status'    => 'publish',
			'orderby'        => 'modified',
			'order'          => 'DESC',
		)
	);

	echo '<ul>';
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<li>';
			echo '<a href="' . esc_url( get_edit_post_link() ) . '">' . esc_html( get_the_title() ) . '</a>';
			echo ' - <span class="post-date">' . esc_html( get_the_modified_date() ) . '</span>';
			echo '</li>';
		}
	} else {
		echo '<li>' . esc_html__( 'No update history yet.', 'manualdog' ) . '</li>';
	}
	echo '</ul>';
	wp_reset_postdata();

	echo '<p><a href="' . esc_url( admin_url( 'edit.php?post_type=manualdog_manual' ) ) . '">' . esc_html__( 'View all manuals', 'manualdog' ) . ' →</a></p>';
}