<?php
/**
 * Plugin Name: Job Postings
 * Plugin URI: http://hatrackmedia.com
 * Description: A plugin for creating and displaying job opportunities.
 * Author: Bobby Bryant
 * Author URI: http://hatrackmedia.com
 * Version: 0.0.1
 * License: GPLv2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue PLugin Styles and scripts
 */

function hrm_jobs_enqueue_scripts() {

$screen = get_current_screen();

if ( is_object($screen) && 'job' == $screen->post_type ) {

	wp_enqueue_style( 'jobs-admin', plugins_url( '/css/jobs-admin.css', __FILE__ ) );
	wp_enqueue_script( 'quicktags-js', plugins_url( '/js/quicktags.js', __FILE__), array( 'quicktags' ), '', true );
	wp_enqueue_script( 'jquery-ui-datepicker' );
  	wp_enqueue_script( 'field-js', plugins_url('js/fields.js', __FILE__), array( 'jquery-core', 'jquery-ui-core', 'jquery-ui-datepicker' ), '', true );
	wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
  	
  	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'reorder-js', plugins_url( '/js/reorder.js', __FILE__), array( 'jquery' ), '', true );
  }
}
add_action( 'admin_enqueue_scripts', 'hrm_jobs_enqueue_scripts' );

/**
 * Require project specific files
 */
require_once ( plugin_dir_path(__FILE__) . 'jobs-cpt.php');
require_once ( plugin_dir_path(__FILE__) . 'jobs-fields.php' );
require_once ( plugin_dir_path(__FILE__) . 'jobs-settings.php' );
require_once ( plugin_dir_path(__FILE__) . 'jobs-shortcode.php' );


/**
* Set Jobs WP_Query
**/

function hrm_get_jobs_posts() {
	$args = array(
		'post_type' => 'job',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_per_page' => 100, /* add a reasonable max # rows */
		'no_found_rows' => true, /* don't generate a count as part of query */
	);

	$jobs = new WP_Query( $args );

	return $jobs;
}


