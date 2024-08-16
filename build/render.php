<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Get the current year.
$current_year = date( "Y" );

// Determine which content to display.
if ( isset( $attributes['categoryId'] ) ) {

    $limit = -1; // Set to -1 to retrieve all images

    $featured_images = jess_get_post_ids_with_featured_image( $attributes['categoryId'], $limit );

	$one_random = array_rand( $featured_images );

	echo jess_get_featured_image_html( $featured_images[$one_random] );

} else {
	echo 'No category ID provided.';
}

