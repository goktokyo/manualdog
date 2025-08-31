<?php
/**
 * Registers the custom post type for ManualDog.
 *
 * @package ManualDog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the 'manualdog_manual' custom post type.
 */
function manualdog_register_post_type() {
	$labels = array(
		'name'                  => _x( 'Manuals', 'Post Type General Name', 'manualdog' ),
		'singular_name'         => _x( 'Manual', 'Post Type Singular Name', 'manualdog' ),
		'menu_name'             => __( 'Manuals', 'manualdog' ),
		'name_admin_bar'        => __( 'Manual', 'manualdog' ),
		'archives'              => __( 'Manual Archives', 'manualdog' ),
		'attributes'            => __( 'Manual Attributes', 'manualdog' ),
		'parent_item_colon'     => __( 'Parent Manual:', 'manualdog' ),
		'all_items'             => __( 'All Manuals', 'manualdog' ),
		'add_new_item'          => __( 'Add New Manual', 'manualdog' ),
		'add_new'               => __( 'Add New', 'manualdog' ),
		'new_item'              => __( 'New Manual', 'manualdog' ),
		'edit_item'             => __( 'Edit Manual', 'manualdog' ),
		'update_item'           => __( 'Update Manual', 'manualdog' ),
		'view_item'             => __( 'View Manual', 'manualdog' ),
		'view_items'            => __( 'View Manuals', 'manualdog' ),
		'search_items'          => __( 'Search Manuals', 'manualdog' ),
		'not_found'             => __( 'No manuals found.', 'manualdog' ),
		'not_found_in_trash'    => __( 'No manuals found in Trash.', 'manualdog' ),
		'featured_image'        => __( 'Featured Image', 'manualdog' ),
		'set_featured_image'    => __( 'Set featured image', 'manualdog' ),
		'remove_featured_image' => __( 'Remove featured image', 'manualdog' ),
		'use_featured_image'    => __( 'Use as featured image', 'manualdog' ),
		'insert_into_item'      => __( 'Insert into manual', 'manualdog' ),
		'uploaded_to_this_item' => __( 'Uploaded to this manual', 'manualdog' ),
		'items_list'            => __( 'Manuals list', 'manualdog' ),
		'items_list_navigation' => __( 'Manuals list navigation', 'manualdog' ),
		'filter_items_list'     => __( 'Filter manuals list', 'manualdog' ),
	);

	$args = array(
		'label'               => __( 'Manual', 'manualdog' ),
		'description'         => __( 'Manuals displayed in the admin area.', 'manualdog' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'revisions', 'thumbnail', 'page-attributes' ),
		'hierarchical'        => true,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-book-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'rewrite'             => false,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
	);
	register_post_type( 'manualdog_manual', $args );
}
add_action( 'init', 'manualdog_register_post_type', 0 );