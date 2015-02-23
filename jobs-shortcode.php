<?php 
/**
 * Create Jobs Shortcode
 */

function hrm_jobs_list_shortcode ( $atts, $content = null ) {

	$shortcode_jobs = hrm_get_jobs_posts();
		if ( $shortcode_jobs->have_posts() ) : ?>

			<table id="job-list">
				<tr>
					<th>Job Title</th>
					<th>Location</th>
					<th></th>
				</tr>
				<?php while ( $shortcode_jobs->have_posts() ) : $shortcode_jobs->the_post(); ?>

					<?php $jobUrl = get_permalink(); ?>

				<tr>
					<td id="<?php the_id(); ?>"><?php the_title(); ?></td>
					<td><?php the_terms( $post->ID, 'location') ?></td>
					<td><a href="<?php echo esc_url( $jobUrl ) ?>">Learn More</a></td>
				</tr>

				<?php endwhile; ?>
			</table>

			<?php else: ?>
			<p><?php _e( 'You have no Jobs to display.', 'hrm_jobs' ); ?></p>
			<?php endif; ?>
		</div>

	<?php

}

add_shortcode ( 'hrm_job_list', 'hrm_jobs_list_shortcode');
