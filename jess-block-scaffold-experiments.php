<?php
/**
 * Plugin Name:       Jess - Block scaffold experiments
 * Description:       Some block scaffold experiments.
 * Version:           0.1.0
 * Requires at least: 6.2
 * Requires PHP:      7.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jess-block-scaffold-experiments
 *
 * @package           create-block
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_copyright_date_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_copyright_date_block_init' );

/**
 * Create test REST endpoints for demonstration purposes.
 */
add_action('rest_api_init', function() {

	register_rest_route('jess-block-scaffold-experiments/v1', '/open/(?P<id>\d+)', array(
		'methods' => 'GET',
		'callback' => 'jess_dyn_rest',
		'permission_callback' => '__return_true', // Public
		'args' => array(
		  'id' => array(
			'validate_callback' => function($param, $request, $key) {
			  return is_numeric( $param );
			}
		  ),
		),
	  ) );

});

/**
 * Callback function for the test REST endpoint.
 */
function jess_dyn_rest($request) {
	$id = $request->get_param('id');

	if ($id) {
		// Fetch data based on the ID (replace with your actual data fetching logic)
		$data = array(
			'id' => $id,
			'title' => 'Example Title',
			'content' => 'Example Content',
		);

		// Create the response object
		$response = new WP_REST_Response( $data );

		// Set the status code (200 for success)
		$response->set_status( 200 );

	} else {
		// Create the response object
		$response = new WP_REST_Response( array( 'message' => 'No ID provided' ) );

		// Set the status code (400 for bad request)
		$response->set_status( 400 );
	}

	return rest_ensure_response($response);
}
