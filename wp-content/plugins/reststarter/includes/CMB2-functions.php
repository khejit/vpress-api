<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  reststarter
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://cmb2.io
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Call the CMB2 plugin from within the reststarter plugin.
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}


/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function reststarter_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}

/**
 * Manually render a task status field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
 function reststarter_status_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$label       = $field->args( 'name' );
    $status      = get_post_meta( get_the_ID(), 'task_status', true );
	?>
	<div class="cmb-row custom-field-row <?php echo esc_attr( $classes ); ?>">
		<div class="cmb-th">
            <label><?php echo esc_attr( $label ); ?></label>
        </div>
        <div class="cmb-td">
            <p><?php echo esc_attr( $status ); ?></p>
        </div>
	</div>
	<?php
}

add_action( 'cmb2_init', 'reststarter_register_rest_api_box' );
/**
 * Hook in and add a box to be available in the CMB2 REST API. Can only happen on the 'cmb2_init' hook.
 * More info: https://github.com/CMB2/CMB2/wiki/REST-API
 */
function reststarter_register_rest_api_box() {

	$cmb_rest = new_cmb2_box( array(
		'id'            => 'reststarter_rest_metabox',
		'title'         => esc_html__( 'Task Book Data', 'reststarter' ),
		'object_types'  => array( 'task' ), // Post type
		'show_in_rest'  => WP_REST_Server::ALLMETHODS, // WP_REST_Server::READABLE|WP_REST_Server::EDITABLE, // Determines which HTTP methods the box is visible in.
		// Optional callback to limit box visibility.
		// See: https://github.com/CMB2/CMB2/wiki/REST-API#permissions
		'get_box_permissions_check_cb' => 'reststarter_limit_rest_view_to_logged_in_users',
	) );

	$cmb_rest->add_field( array(
		'name'          => esc_html__( 'Prediction', 'reststarter' ),
		'desc'          => esc_html__( 'What do you think will happen?', 'reststarter' ),
		'id'            => 'reststarter_prediction',
        'type'          => 'wysiwyg',
        'options'       => array(
			'textarea_rows' => 5,
		),
	) );

	$cmb_rest->add_field( array(
        'name'          => esc_html__( 'Pre-task level', 'reststarter' ),
        'desc'          => esc_html__( 'What do you think will happen?', 'reststarter' ),
		'id'            => 'reststarter_pre_level',
		'type'          => 'radio',
		'options'       => array(
			'5' => esc_html__( 'Very relaxed', 'reststarter' ),
			'4' => esc_html__( 'Somewhat relaxed', 'reststarter' ),
			'3' => esc_html__( 'Neutral', 'reststarter' ),
			'2' => esc_html__( 'Somewhat stressed', 'reststarter' ),
			'1' => esc_html__( 'Very stressed', 'reststarter' ),
		),
		'before'  => '<p>' . esc_html__( 'What is your stress level when thinking about the upcoming task?', 'reststarter' ) . '</p>',
	) );

	$cmb_rest->add_field( array(
        'name'          => esc_html__( 'Outcome', 'reststarter' ),
        'desc'          => esc_html__( 'What actually happened?', 'reststarter' ),
		'id'            => 'reststarter_outcome',
		'type'          => 'wysiwyg',
		'options'       => array(
			'textarea_rows' => 5,
		),
	) );

	$cmb_rest->add_field( array(
		'name'          => esc_html__( 'Post-task level', 'reststarter' ),
		'id'            => 'reststarter_post_level',
		'type'          => 'radio',
		'options'       => array(
			'5' => esc_html__( 'Very relaxed', 'reststarter' ),
			'4' => esc_html__( 'Somewhat relaxed', 'reststarter' ),
			'3' => esc_html__( 'Neutral', 'reststarter' ),
			'2' => esc_html__( 'Somewhat stressful', 'reststarter' ),
			'1' => esc_html__( 'Very stressful', 'reststarter' ),
		),
		'before'  => '<p>' . esc_html__( 'What was the actual experience of working with the task like?', 'reststarter' ) . '</p>',
    ) );

    $cmb_rest->add_field( array(
		'name' => esc_html__( 'Task Status', 'reststarter' ),
		'id'   => 'reststarter_task_status',
		'render_row_cb' => 'reststarter_status_cb',
	) );

}