<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sosimple_setup_background_images() {
	// Add support for post thumbnails and register custom image sizes.
	add_theme_support( 'post-thumbnails' );
	
}
add_action( 'after_setup_theme', 'sosimple_setup_background_images' );


/**
 * Localize Background Images
 */
function sosimple_localize_background_images() {
	$background_images = array();

	// Loop through 
	while ( have_posts() ) : the_post();
		if ( $thumbnail_id = get_post_thumbnail_id() ) {
			// Show large image sizes on single pages
			$size = ( is_home() || is_archive() ) ? 'post-thumbnail' : 'large';

			// Get post thumbnail source.
			$attachment_image_src = wp_get_attachment_image_src( $thumbnail_id, $size );
			
			// Add post ID and image to an array of images
			$background_images[get_the_ID()] = esc_url( $attachment_image_src[0] );
		}
	endwhile;

	wp_enqueue_script( 'sosimple-background-images', get_template_directory_uri() . '/add-ons/background-images/js/background-images.js', array( 'jquery' ), sosimple_version_id(), true );

	// Localize background images for use in JS
	wp_localize_script( 'sosimple-background-images', 'sosimpleL10n', array( 
		'background_images' => $background_images,
	) );
}
add_action( 'wp_enqueue_scripts', 'sosimple_localize_background_images' );
