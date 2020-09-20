<?php
/*
Plugin Name: Rest Starter
Description: A start for registering custom meta fields to be used with rest api.
Version:     1.0.1
Author:      khejit
Text Domain: reststarter
Domain Path: /languages
*/

/**
 * Register Task post type.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/posttypes.php';
register_activation_hook( __FILE__, 'reststarter_rewrite_flush' );
 

/**
 * Register Task Logger role.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/roles.php';
register_activation_hook( __FILE__, 'reststarter_register_role' );
register_deactivation_hook( __FILE__, 'reststarter_remove_role' );


/**
 * Add capabilities.
 */
register_activation_hook( __FILE__, 'reststarter_add_capabilities' );
register_deactivation_hook( __FILE__, 'reststarter_remove_capabilities' );


/**
 * Register task_status field.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/status.php';

/**
 * Register CMB2 metaboxes and fields.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/CMB2-functions.php';

/**
 * Grant access to tasks only to authenticated users
 * with either administrator or task logger roles.
 */
add_action( 'pre_get_posts', 'reststarter_grant_access' );

function reststarter_grant_access( $query ) {
    // Make sure the query contains a post_type query_var,
    // otherwise it's definitely not a request for Task(s):
    if ( isset($query->query_vars['post_type']) ) {
        // Check if the request is for the Task post type…
        if ( $query->query_vars['post_type'] == 'task' ) {
            // … and that this is a REST request:
            if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
                // … and the current user is a task logger"
                if ( current_user_can( 'task_logger' ) ) {
                    // … the user can see only their own private tasks:
                    $query->set( 'post_status', 'private' );
                    $query->set( 'author', get_current_user_id() );
                }
            }
        }
    }
}