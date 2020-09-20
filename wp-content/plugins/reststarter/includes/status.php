<?php
/**
 * Register a new task_status field and set it automatically
 * based on the status of the reststarter_outcome field.
 *
 * Called from reststarter.php.
 * 
 * @package  reststarter
 * @link     https://developer.wordpress.org/reference/functions/register_rest_field/
 */


/**
 * Auto-update the task_status field every time the task 
 * is updated using the REST API.
 *
 * @package       reststarter
 * @param object  $post   	 The post object.
 * @param bool    $request   The current request (not used).
 */
add_action( 'rest_after_insert_task', 'reststarter_change_status', 10, 2 );

function reststarter_change_status( $post, $request ) {

	// Get the contents of the reststarter_outcome field.
	$outcome = get_post_meta( $post->ID, 'reststarter_outcome', true );

	// Update task_status based on whether $outcome has content:
	if ( 0 === strlen($outcome) ) {
		update_post_meta( $post->ID, 'task_status', 'In progress' );
	} else {
		update_post_meta( $post->ID, 'task_status', 'Completed' );
	}

}

/**
 * Register new REST field for task_status.
 */
add_action( 'rest_api_init', 'reststarter_register_task_status' );
 
function reststarter_register_task_status() {
 
    register_rest_field( 
        'task', 
        'task_status', 
        array(
           'get_callback'    => 'reststarter_get_task_status',
           'schema'          => null,
        )
    );
}

/**
 * Return the current value of task_status meta field.
 */
function reststarter_get_task_status( $object, $field_name, $request ) {
    return get_post_meta( $object['id'], $field_name, true );
}
