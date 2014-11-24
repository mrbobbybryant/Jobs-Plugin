<?php 

function cmb2_sample_metaboxes( array $meta_boxes ) {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_hrm_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['jobs_metabox'] = array(
		'id'            => 'job_metabox',
		'title'         => __( 'job Metabox', 'hrmjobs' ),
		'object_types'  => array( 'job', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name' => __( 'Date Listed', 'hrmjobs' ),
				'id'   => $prefix . 'date_listed',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Application Deadline', 'hrmjobs' ),
				'id'   => $prefix . 'date_deadline',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Job Title', 'hrmjobs' ),
				'id'   => $prefix . 'job_title',
				'type' => 'text_medium',
			),
			array(
				'name'    => __( 'Principal Duties', 'hrmjobs' ),
				'desc'    => __( 'List primary job details.', 'hrmjobs' ),
				'id'      => $prefix . 'prinicple_duties',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 8, ),
			),
			array(
				'name' => __( 'Minimum Requirements', 'hrmjobs' ),
				'desc' => __( 'Select "Add Row" to input additional requirements.', 'hrmjobs' ),
				'id'   => $prefix . 'minimum_requirements',
				'type' => 'text_medium',
				'repeatable' => true,
			),
			array(
				'name' => __( 'Preferred Requirements', 'hrmjobs' ),
				'desc' => __( 'Select "Add Row" to input additional requirements.', 'hrmjobs' ),
				'id'   => $prefix . 'preferred_requirements',
				'type' => 'text_medium',
				'repeatable' => true,
			),
			array(
				'name'    => __( 'Relocation Assistance', 'hrmjobs' ),
				'desc'    => __( 'Please make a selection', 'hrmjobs' ),
				'id'      => $prefix . 'relocation_assistance',
				'type'    => 'select',
				'options' => array(
					'standard' => __( 'No', 'hrmjobs' ),
					'custom'   => __( 'Yes', 'hrmjobs' ),
				),
			),
			array(
				'name' => __( 'Job ID', 'hrmjobs' ),
				'desc' => __( 'Internal HR Reference Number', 'hrmjobs' ),
				'id'   => $prefix . 'job_id',
				'type' => 'text_medium',
			),

		),
	);
	
	return $meta_boxes;		
}			

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );