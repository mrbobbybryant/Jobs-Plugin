<?php 

function wpdt_meta_boxes() {
  add_meta_box ( 'wpdt_meta', __( 'Job Meta Box', 'wpdt' ), 'wpdt_meta_callback', 'job' );
}
add_action( 'add_meta_boxes', 'wpdt_meta_boxes' );

function wpdt_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'wpdt_nonce' );
    $wpdt_stored_meta = get_post_meta( $post->ID );
    ?>
    <div>
        <div class="meta-row">
            <div class="meta-th">
              <label for="datelisted" class="wpdt-row-title"><?php _e( 'Date Listed', 'wpdt-textdomain' )?></label>
            </div>
            <div class="meta-td">
              <input type="text" size="10" class="wpdt-row-content datepicker" name="datelisted" id="datelisted" value="<?php if ( isset ( $wpdt_stored_meta['datelisted'] ) ) echo $wpdt_stored_meta['datelisted'][0]; ?>" />
            </div>
        </div>
        <div class="meta-row">
            <div class="meta-th">
              <label for="meta-text" class="wpdt-row-title"><?php _e( 'Application Deadline', 'wpdt-textdomain' )?></label>
            </div>
            <div class="meta-td">
              <input type="text" size="10" class="wpdt-row-content datepicker" name="application_deadline" id="datepicker" value="<?php if ( isset ( $wpdt_stored_meta['datepicker'] ) ) echo $wpdt_stored_meta['datepicker'][0]; ?>" />
            </div>
        </div>
        <div class="meta-row">
            <div class="meta-th">
              <label for="job-title" class="wpdt-row-title"><?php _e( 'Job Title', 'wpdt-textdomain' )?></label>
            </div>
            <div class="meta-td">
              <input type="text" class="wpdt-row-content" name="job-title" id="job-title" value="<?php if ( isset ( $wpdt_stored_meta['job-title'] ) ) echo $wpdt_stored_meta['job-title'][0]; ?>" />
            </div>
        </div>
        <div class="meta-row">
          <div class="meta-th">
            <span>Principle Duties</span>
          </div>
          <div  class="meta-editor">
            <?php

              $content = '';
              $editor_id = 'principleduties';
              $settings = array( 
                'textarea_rows' => 5,
              );

              wp_editor( $content, $editor_id, $settings );

            ?>
          </div>
        </div>
        <div class="meta-row">
          <div class="meta-th">
            <label for="wpdt-requirements" class="wpdt-row-title"><?php _e( 'Minimum Requirements', 'wpdt-textdomain' )?></label>
          </div>
          <div class="meta-td">
            <textarea name="wpdt-requirements" class ="wpdt-textarea" id="wpdt-requirements"><?php if ( isset ( $prfx_stored_meta['wpdt-requirements'] ) ) echo $prfx_stored_meta['wpdt-requirements'][0]; ?></textarea>
          </div>
        </div>
        <div class="meta-row">
          <div class="meta-th">
            <label for="wpdt-preferred" class="wpdt-row-title"><?php _e( 'Preferred Requirements', 'wpdt-textdomain' )?></label>
          </div>
          <div class="meta-td">
            <textarea name="wpdt-preferred" class ="wpdt-textarea" id="wpdt-preferred"><?php if ( isset ( $prfx_stored_meta['wpdt-preferred'] ) ) echo $prfx_stored_meta['wpdt-preferred'][0]; ?></textarea>
          </div>
        </div>
      </div>
      <div class="meta-row">
        <div class="meta-th">
          <label for="meta-select" class="prfx-row-title"><?php _e( 'Relocation Assistance', 'prfx-textdomain' )?></label>
        </div>
        <div class="meta-td">
          <select name="meta-select" id="meta-select">
              <option value="select-yes" <?php if ( isset ( $prfx_stored_meta['meta-select'] ) ) selected( $prfx_stored_meta['meta-select'][0], 'select-yes' ); ?>><?php _e( 'Yes', 'prfx-textdomain' )?></option>';
              <option value="select-no" <?php if ( isset ( $prfx_stored_meta['meta-select'] ) ) selected( $prfx_stored_meta['meta-select'][0], 'select-no' ); ?>><?php _e( 'No', 'prfx-textdomain' )?></option>';
          </select>
        </div>
      </div>
      <div class="meta-row">
            <div class="meta-th">
              <label for="job-id" class="wpdt-row-title"><?php _e( 'Job ID', 'wpdt-textdomain' )?></label>
            </div>
            <div class="meta-td">
              <input type="text" class="wpdt-row-content" name="job-id" id="job-id" value="<?php if ( isset ( $wpdt_stored_meta['job-id'] ) ) echo $wpdt_stored_meta['job-id'][0]; ?>" />
            </div>
        </div>
      <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Add Row', 'prfx-textdomain' )?>" />
    <?php

}

// Field Save Function
function wpdt_meta_save( $post_id ) {
  //Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset ( $_POST[ 'wpdt_nonce' ] ) && wp_verify_nonce( $_POST[ 'wpdt_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

  if ( $is_autosave || $is_revision || $is_valid_nonce ) {
    return;
  }

  if ( isset( $_POST[ 'datelisted' ] ) ) {
    update_post_meta( $post_id, 'datelisted', santize_text_field( $_POST[ 'datelisted' ] ) );
  }
  if ( isset( $_POST[ 'job-title' ] ) ) {
    update_post_meta( $post_id, 'job-title', santize_text_field( $_POST[ 'job-title' ] ) );
  }

}

add_action( 'save_post', 'wpdt_meta_save' );

