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
        $featured_images_html = ''; 
        $post_ids = jess_get_post_ids_with_featured_image( $id );

		// print_r( $post_ids );
		$random_image_id = array_rand( $post_ids );
		$random_image = $post_ids[$random_image_id];
		//echo "$random_image is the random image";


		$featured_images_html = jess_get_featured_image_html( $random_image );

        $data = array(
            'categoryID' => $id,
            'image' => $featured_images_html, // Return array of image HTML
        );

        $response = new WP_REST_Response( $data );
        $response->set_status( 200 );

    } else {
        $response = new WP_REST_Response( array( 'message' => 'No ID provided' ) );
        $response->set_status( 400 );
    }

    return rest_ensure_response($response);
}



/**
 * Get an array of post IDs from a specific category that have featured images.
 *
 * @param int $category_id The ID of the category.
 *
 * @return array An array of post IDs, or an empty array if no posts are found.
 */
 function jess_get_post_ids_with_featured_image( $category_id ) {
    $post_ids = [];

    // Query posts in the specified category
    $args = array(
        'cat' => $category_id,
        'posts_per_page' => -1, // Retrieve all posts
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id', // Check for posts with a featured image
                'compare' => 'EXISTS',
            ),
        ),
    );

    $query = new WP_Query( $args );

    // Loop through the posts and get the post IDs
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_ids[] = get_the_ID();
        }
    }

    wp_reset_postdata(); // Reset the post data

    return $post_ids;
}

/**
 * Get the HTML for a featured image with figure and ARIA tags.
 *
 * @param int $post_id The ID of the post.
 * @param string $size The desired image size (e.g., 'thumbnail', 'medium', 'large', 'full').
 * @param string|array $attr Optional. Attributes for the <img> tag.
 *
 * @return string The HTML output for the featured image, or an empty string if no featured image is found.
 */
function jess_get_featured_image_html( $post_id, $size = 'medium', $attr = '' ) {
    if ( has_post_thumbnail( $post_id ) ) {
        $thumbnail_id = get_post_thumbnail_id( $post_id );
        $image_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
        $image_url = wp_get_attachment_image_url( $thumbnail_id, $size ); // Get image URL
        $post_url = get_permalink( $post_id ); // Get post URL

        // Wrap image and title in links
        $image_html = '<a href="' . esc_url( $post_url ) . '">' . 
                       wp_get_attachment_image( $thumbnail_id, $size, false, array(
                           'alt' => $image_alt ? esc_attr( $image_alt ) : get_the_title( $post_id ),
                           $attr,
                       ) ) . 
                       '</a>';

        return '<figure aria-label="' . esc_attr( get_the_title( $post_id ) . ' Featured Image' ) . '">' . 
               $image_html . 
               '<figcaption><a href="' . esc_url( $post_url ) . '">' . esc_html( get_the_title( $post_id ) ) . '</a></figcaption>' . 
               '</figure>';
    }

    return ''; // Return an empty string if no featured image is found
}



/**
 * Output an array of featured image URLs from a specific category in the footer.
 * 
 * Current site portfolio category: 29453
 */
function jess_output_featured_images_in_footer() {
    $category_id = 29453; // Replace with the desired category ID
    $limit = -1; // Set to -1 to retrieve all images

    $featured_images = jess_get_post_ids_with_featured_image( $category_id, $limit );

	$one_random = array_rand( $featured_images );

	echo jess_get_featured_image_html( $featured_images[$one_random] );


}
//add_action( 'wp_footer', 'jess_output_featured_images_in_footer' );
//add_action( 'admin_footer', 'jess_output_featured_images_in_footer' );


function jess_block_callback( $attributes ) {

    $category_id = $attributes['categoryId'];
    $limit = -1; // Set to -1 to retrieve all images

    $featured_images = jess_get_post_ids_with_featured_image( $category_id, $limit );

	$one_random = array_rand( $featured_images );

	echo jess_get_featured_image_html( $featured_images[$one_random] );

}