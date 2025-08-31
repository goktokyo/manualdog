<?php
/**
 * Handles the admin menu pages for ManualDog.
 *
 * @package ManualDog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gets the default menu names.
 *
 * @return array Default menu names.
 */
function manualdog_get_default_menu_names() {
	return array(
		'main_menu'     => __( 'Manuals', 'manualdog' ),
		'view_page'     => __( 'View Manuals', 'manualdog' ),
		'list_page'     => __( 'All Manuals', 'manualdog' ),
		'add_new_page'  => __( 'Add New', 'manualdog' ),
		'settings_page' => __( 'Settings', 'manualdog' ),
	);
}

/**
 * Gets the final menu names, merging saved options with defaults.
 *
 * @return array Final menu names.
 */
function manualdog_get_menu_names() {
	$default_names = manualdog_get_default_menu_names();
	$saved_names   = get_option( 'manualdog_menu_names', array() );
	return array_merge( $default_names, (array) $saved_names );
}

/**
 * Adds the admin menu and sub-menu pages.
 */
function manualdog_add_admin_menu() {
	$menu_names = manualdog_get_menu_names();
	add_menu_page(
		$menu_names['main_menu'],
		$menu_names['main_menu'],
		'edit_posts',
		'manualdog_manual_index',
		'manualdog_render_manual_index_page',
		'dashicons-book-alt',
		20
	);
	add_submenu_page(
		'manualdog_manual_index',
		$menu_names['view_page'],
		$menu_names['view_page'],
		'edit_posts',
		'manualdog_manual_index'
	);
	add_submenu_page(
		'manualdog_manual_index',
		$menu_names['list_page'],
		$menu_names['list_page'],
		'edit_posts',
		'edit.php?post_type=manualdog_manual'
	);
	add_submenu_page(
		'manualdog_manual_index',
		$menu_names['add_new_page'],
		$menu_names['add_new_page'],
		'edit_posts',
		'post-new.php?post_type=manualdog_manual'
	);
	add_submenu_page(
		'manualdog_manual_index',
		$menu_names['settings_page'],
		$menu_names['settings_page'],
		'manage_options',
		'manualdog_settings',
		'manualdog_render_settings_page'
	);
	add_submenu_page(
		null,
		__( 'Manual Viewer', 'manualdog' ),
		__( 'Manual Viewer', 'manualdog' ),
		'edit_posts',
		'manualdog_manual_viewer',
		'manualdog_render_manual_viewer_page'
	);
}
add_action( 'admin_menu', 'manualdog_add_admin_menu' );

/**
 * Renders the settings page.
 */
function manualdog_render_settings_page() {
	if ( isset( $_POST['submit'] ) && isset( $_POST['manualdog_menu_names_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['manualdog_menu_names_nonce'] ), 'manualdog_save_menu_names' ) ) {
		$posted_names  = isset( $_POST['manualdog_menu_names'] ) ? map_deep( wp_unslash( $_POST['manualdog_menu_names'] ), 'sanitize_text_field' ) : array();
		$updated_names = array();
		$default_names = manualdog_get_default_menu_names();
		foreach ( array_keys( $default_names ) as $key ) {
			if ( isset( $posted_names[ $key ] ) ) {
				$updated_names[ $key ] = $posted_names[ $key ];
			}
		}
		update_option( 'manualdog_menu_names', $updated_names );
		?>
		<div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'Settings saved.', 'manualdog' ); ?></p></div>
		<?php
	}
	$menu_names = manualdog_get_menu_names();
	?>
	<div class="wrap">
		<div style="text-align: center; margin: 20px 0;">
			<img src="<?php echo esc_url( plugins_url( '../assets/img/manualdog-logo.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'ManualDog Logo', 'manualdog' ); ?>" style="max-width: 150px; height: auto;">
		</div>
		<h1><?php echo esc_html( $menu_names['settings_page'] ); ?></h1>
		<form method="post" action="">
			<?php wp_nonce_field( 'manualdog_save_menu_names', 'manualdog_menu_names_nonce' ); ?>
			<h2><?php esc_html_e( 'Menu Labels', 'manualdog' ); ?></h2>
			<table class="form-table">
			<?php
			$labels_map = array(
				'main_menu'     => __( 'Parent Menu', 'manualdog' ),
				'view_page'     => __( 'View Manuals Page', 'manualdog' ),
				'list_page'     => __( 'All Manuals Page', 'manualdog' ),
				'add_new_page'  => __( 'Add New Page', 'manualdog' ),
				'settings_page' => __( 'Settings Page', 'manualdog' ),
			);
			foreach ( $menu_names as $key => $value ) :
				if ( ! isset( $labels_map[ $key ] ) ) {
					continue;
				}
				?>
				<tr>
					<th><label for="manualdog_menu_names_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $labels_map[ $key ] ); ?></label></th>
					<td>
						<input type="text" name="manualdog_menu_names[<?php echo esc_attr( $key ); ?>]" id="manualdog_menu_names_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="regular-text">
						<p class="description">
							<?php
							/* translators: %s: Example of a menu label. */
							printf( esc_html__( 'e.g., "%s"', 'manualdog' ), esc_html( manualdog_get_default_menu_names()[ $key ] ) );
							?>
						</p>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
			<?php submit_button( __( 'Save Changes', 'manualdog' ) ); ?>
		</form>

		<div style="margin-top: 40px; border-top: 1px solid #ddd;"></div>

		<div id="manualdog-important-notices" style="margin-top: 30px;">
			<h2 style="font-size: 1.5em;"><?php esc_html_e( 'Important Notes', 'manualdog' ); ?></h2>

			<div style="margin-top: 20px; padding: 20px; background-color: #fff8e5; border-left: 4px solid #ffb900;">
				<h3 style="margin-top: 0;"><span class="dashicons dashicons-warning" style="color: #ffb900; margin-right: 5px;"></span><?php esc_html_e( 'About Media File Accessibility', 'manualdog' ); ?></h3>
				<p>
					<?php esc_html_e( 'Heads up! Media files (like images and videos) used in this manual can be accessed by anyone with the direct URL.', 'manualdog' ); ?>
					<?php esc_html_e( 'This free version does not restrict file access. Please handle sensitive media with care.', 'manualdog' ); ?>
				</p>
				<p>
					<em><?php esc_html_e( 'Full media protection is a feature planned for a future premium version.', 'manualdog' ); ?></em>
				</p>
			</div>

			<div style="margin-top: 20px; padding: 20px; background-color: #f6f7f7; border-left: 4px solid #72aee6;">
				<h3 style="margin-top: 0;"><?php esc_html_e( 'About Manual Sorting', 'manualdog' ); ?></h3>
                <p>
                    <?php
                                $sorting_text = sprintf(
                                    /* translators: %s: The code tag for menu_order. */
                                    __( 'This plugin supports sorting using the standard WordPress "Order" feature (%s).', 'manualdog' ),
                                    '<code>menu_order</code>'
                                );
                                echo esc_html( $sorting_text );
                                ?>
                    <br>
                    <?php esc_html_e( 'You can set the order by entering a number in the "Page Attributes" panel on each manual\'s edit screen.', 'manualdog' ); ?>
                </p>
				<p>
					<?php
					/* translators: %s: A link to the Post Types Order plugin. */
					printf( esc_html__( 'For intuitive drag-and-drop sorting, consider installing the %s plugin.', 'manualdog' ), '<a href="https://wordpress.org/plugins/post-types-order/" target="_blank" rel="noopener noreferrer">Post Types Order</a>' );
					?>
				</p>
			</div>
		</div>

	</div>
	<?php
}

/**
 * Renders the manual index page.
 */
function manualdog_render_manual_index_page() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'manualdog' ) );
	}
	$menu_names = manualdog_get_menu_names();
	?>
	<div class="wrap manualdog-index-page">
		<div class="manualdog-page-wrapper">
			<div class="manualdog-page-header">
				<h1><?php echo esc_html( $menu_names['view_page'] ); ?></h1>
				<p><?php esc_html_e( 'This is a list of all registered manuals. Click a title to view its content.', 'manualdog' ); ?></p>
			</div>
			<?php
			$all_manuals = get_posts(
				array(
					'post_type'      => 'manualdog_manual',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order title',
					'order'          => 'ASC',
					'post_status'    => 'publish',
				)
			);
			if ( empty( $all_manuals ) ) {
				echo '<p style="text-align: center;">' . esc_html__( 'No manuals have been created yet.', 'manualdog' ) . '</p>';
			} else {
				$manual_tree = manualdog_build_manual_tree( $all_manuals );
				manualdog_display_manual_list_recursive( $manual_tree, 0 );
			}
			?>
		</div>
	</div>
	<?php
}


/**
 * Renders the individual manual viewer page.
 */
function manualdog_render_manual_viewer_page() {
	$manual_id = isset( $_GET['manual_id'] ) ? (int) $_GET['manual_id'] : 0;
	if ( ! $manual_id ) {
		wp_die( esc_html__( 'Invalid manual ID.', 'manualdog' ) );
	}

	check_admin_referer( 'view_manual_' . $manual_id );

	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'manualdog' ) );
	}

	$manual = get_post( $manual_id );

	if ( ! $manual || 'manualdog_manual' !== $manual->post_type || 'publish' !== $manual->post_status ) {
		wp_die( esc_html__( 'The specified manual was not found or is invalid.', 'manualdog' ) );
	}

	$all_manuals_for_sidebar = get_posts(
		array(
			'post_type'      => 'manualdog_manual',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'post_status'    => 'publish',
		)
	);

	$manual_tree = manualdog_build_manual_tree( $all_manuals_for_sidebar );
	?>
	<div class="wrap manualdog-viewer-fullscreen">
		<div class="manualdog-viewer-sidebar">
			<div class="manualdog-sidebar-header">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=manualdog_manual_index' ) ); ?>">
					<img src="<?php echo esc_url( plugins_url( '../assets/img/manualdog-logo.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'ManualDog Logo', 'manualdog' ); ?>">
					<span><?php echo esc_html( manualdog_get_menu_names()['main_menu'] ); ?></span>
				</a>
			</div>
			<nav class="manualdog-sidebar-nav">
				<?php manualdog_display_sidebar_nav( $manual_tree, $manual_id, 0 ); ?>
			</nav>
		</div>
		<div class="manualdog-viewer-main">
			<div class="manualdog-main-header">
				<button type="button" class="manualdog-sidebar-toggle" aria-label="<?php esc_attr_e( 'Toggle sidebar', 'manualdog' ); ?>">
					<span class="dashicons dashicons-menu"></span>
				</button>
				<h1 class="manualdog-main-title"><?php echo esc_html( $manual->post_title ); ?></h1>
				<?php if ( current_user_can( 'manage_options' ) ) : ?>
					<a href="<?php echo esc_url( get_edit_post_link( $manual->ID ) ); ?>" class="page-title-action"><?php esc_html_e( 'Edit Manual', 'manualdog' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="manualdog-main-content">
				<?php echo wp_kses_post( apply_filters( 'the_content', $manual->post_content ) ); ?>
			</div>
			<div class="manualdog-main-footer">
				<?php manualdog_render_pager( $manual_id, $manual_tree ); ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Builds a hierarchical tree of manuals from a flat array.
 *
 * @param array $manuals Array of post objects.
 * @return array Hierarchical tree of post objects.
 */
function manualdog_build_manual_tree( array $manuals ) {
	$manual_tree   = array();
	$manuals_by_id = array();
	foreach ( $manuals as $manual ) {
		$manuals_by_id[ $manual->ID ]           = $manual;
		$manuals_by_id[ $manual->ID ]->children = array();
	}

	foreach ( $manuals_by_id as $id => &$manual_item ) {
		if ( $manual_item->post_parent && isset( $manuals_by_id[ $manual_item->post_parent ] ) ) {
			$manuals_by_id[ $manual_item->post_parent ]->children[] = &$manual_item;
		} else {
			$manual_tree[] = &$manual_item;
		}
	}
	unset( $manual_item );

	manualdog_sort_tree_children( $manual_tree );
	return $manual_tree;
}

/**
 * Recursively sorts tree children by menu_order and then title.
 *
 * @param array $nodes Array of nodes to sort.
 */
function manualdog_sort_tree_children( array &$nodes ) {
	usort(
		$nodes,
		function( $a, $b ) {
			if ( $a->menu_order === $b->menu_order ) {
				return strcmp( $a->post_title, $b->post_title );
			}
			return ( $a->menu_order < $b->menu_order ) ? -1 : 1;
		}
	);
	foreach ( $nodes as $node ) {
		if ( ! empty( $node->children ) ) {
			manualdog_sort_tree_children( $node->children );
		}
	}
}

/**
 * Displays the hierarchical list of manuals on the index page.
 *
 * @param array $manuals Array of post objects.
 * @param int   $level   Current depth level.
 */
function manualdog_display_manual_list_recursive( array $manuals, $level = 0 ) {
	echo '<ul class="manualdog-manual-list" style="list-style-type: none; padding-left: ' . esc_attr( $level * 25 ) . 'px;">';
	foreach ( $manuals as $manual ) {
		$nonce_url = wp_nonce_url( admin_url( 'admin.php?page=manualdog_manual_viewer&manual_id=' . $manual->ID ), 'view_manual_' . $manual->ID );
		echo '<li><a href="' . esc_url( $nonce_url ) . '">' . esc_html( $manual->post_title ) . '</a>';
		if ( ! empty( $manual->children ) ) {
			manualdog_display_manual_list_recursive( $manual->children, $level + 1 );
		}
		echo '</li>';
	}
	echo '</ul>';
}

/**
 * Displays the sidebar navigation in the viewer.
 *
 * @param array $manuals    Array of post objects.
 * @param int   $current_id The ID of the currently viewed manual.
 * @param int   $level      Current depth level.
 */
function manualdog_display_sidebar_nav( array $manuals, $current_id, $level = 0 ) {
	echo '<ul class="manualdog-sidebar-nav-list level-' . esc_attr( $level ) . '">';
	foreach ( $manuals as $nav_item ) {
		$is_current = ( $nav_item->ID === $current_id );
		$class      = $is_current ? 'current-manual' : '';
		$nonce_url  = wp_nonce_url( admin_url( 'admin.php?page=manualdog_manual_viewer&manual_id=' . $nav_item->ID ), 'view_manual_' . $nav_item->ID );
		echo '<li class="' . esc_attr( $class ) . '"><a href="' . esc_url( $nonce_url ) . '">' . esc_html( $nav_item->post_title ) . '</a>';
		if ( ! empty( $nav_item->children ) ) {
			manualdog_display_sidebar_nav( $nav_item->children, $current_id, $level + 1 );
		}
		echo '</li>';
	}
	echo '</ul>';
}

/**
 * Renders the pager in the viewer footer.
 *
 * @param int   $manual_id   The ID of the currently viewed manual.
 * @param array $manual_tree The hierarchical tree of all manuals.
 */
function manualdog_render_pager( $manual_id, array $manual_tree ) {
	$flat_ordered_list = array();
	manualdog_flatten_tree_for_pager( $manual_tree, $flat_ordered_list );

	$current_index = -1;
	foreach ( $flat_ordered_list as $index => $item ) {
		if ( $item->ID === $manual_id ) {
			$current_index = $index;
			break;
		}
	}

	$prev_post = ( $current_index > 0 ) ? $flat_ordered_list[ $current_index - 1 ] : null;
	$next_post = ( -1 !== $current_index && $current_index < count( $flat_ordered_list ) - 1 ) ? $flat_ordered_list[ $current_index + 1 ] : null;

	?>
	<div class="pager-prev">
		<?php if ( $prev_post ) : ?>
			<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=manualdog_manual_viewer&manual_id=' . $prev_post->ID ), 'view_manual_' . $prev_post->ID ) ); ?>">
				<strong><?php esc_html_e( 'Previous', 'manualdog' ); ?></strong>
				<span><?php echo esc_html( $prev_post->post_title ); ?></span>
			</a>
		<?php endif; ?>
	</div>
	<div class="pager-next">
		<?php if ( $next_post ) : ?>
			<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=manualdog_manual_viewer&manual_id=' . $next_post->ID ), 'view_manual_' . $next_post->ID ) ); ?>">
				<strong><?php esc_html_e( 'Next', 'manualdog' ); ?></strong>
				<span><?php echo esc_html( $next_post->post_title ); ?></span>
			</a>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Flattens the hierarchical tree into a simple array for pager logic.
 *
 * @param array $nodes  Array of nodes to flatten.
 * @param array $result The resulting flat array (passed by reference).
 */
function manualdog_flatten_tree_for_pager( array $nodes, array &$result ) {
	foreach ( $nodes as $node ) {
		$result[] = $node;
		if ( ! empty( $node->children ) ) {
			manualdog_flatten_tree_for_pager( $node->children, $result );
		}
	}
}