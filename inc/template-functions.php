<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function forte_body_classes( $classes ) {
	global $post;

	if ( ! is_404() ) {

		if ( is_singular() ) {
			if ( 'on' === get_post_meta( $post->ID, '_bean_hero', true ) ) {
				$classes[] = 'hero-header';
			} else {
				$classes[] = 'no-hero';
			}
		}
	}

	if ( function_exists( 'register_block_type' ) ) {
		$classes[] = 'has-gutenberg';
	}

	return $classes;
}
add_filter( 'body_class', 'forte_body_classes' );
