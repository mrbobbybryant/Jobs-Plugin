<?php

/**
 * Create Sorting Admin Page
 */
function hrm_jobs_add_menu_page() {
	add_submenu_page(
		'edit.php?post_type=job',
		'Reorder Jobs',
		'Reorder Jobs',
		'edit_pages',
		'reorder_jobs',
		'hrm_jobs_callback'
	);
}


/**
 * Settings page callback.
 */
function hrm_jobs_callback() {
	
	/* Populate settings page with the current job listings */
	$render_jobs = hrm_get_jobs_posts();
	?>
		<div id="jobs-admin-sort" class="wrap">
		<div id="icon-job-admin" class="icon32"><br /></div>
		<h2><?php _e('Sort Job Positions', 'hrm_jobs'); ?> <img src="<?php echo esc_url( admin_url() . '/images/loading.gif' ); ?>" id="loading-animation" /></h2>
			<?php if ( $render_jobs->have_posts() ) : ?>
			<p><?php _e('<strong>Note:</strong> this only affects the Jobs listed using the shortcode functions', 'hrm_jobs'); ?></p>
			<ul id="custom-type-list">
				<?php while ( $render_jobs->have_posts() ) : $render_jobs->the_post(); ?>
					<li id="<?php the_id(); ?>"><?php the_title(); ?></li>
				<?php endwhile; ?>
			</ul>
			<?php else: ?>
			<p><?php _e( 'You have no Jobs to sort.', 'hrm_jobs' ); ?></p>
			<?php endif; ?>
		</div>

	<?php
}

add_action( 'admin_menu', 'hrm_jobs_add_menu_page');

function hrm_jobs_save_order() {

	//@todo add a nonce here to verify user intent
	//capability check to ensure use caps
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have permission to access this page.' ) );
	}

	$order   = explode( ',', $_POST['order'] );
	$counter = 0;

	foreach ( $order as $item_id ) {
		$post = array(
			'ID'         => (int) $item_id,
			'menu_order' => $counter,
		);

		wp_update_post( $post );
		$counter ++;
	}

	die( 1 );

}

add_action( 'wp_ajax_save_sort', 'hrm_jobs_save_order' );