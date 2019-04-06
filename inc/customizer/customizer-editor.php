<?php
/**
 * Add customizer colors to the block editor.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Add customizer colors to the block editor.
 */
function forte_editor_customizer_generated_values() {

	// Retrieve colors from the Customizer.
	$background_color = get_theme_mod( 'background_color', '#ffffff' );

	// Build styles.
	$css = '';

	$css .= '.block-editor__container { background-color: #' . esc_attr( $background_color ) . '; }';

	return wp_strip_all_tags( apply_filters( 'forte_editor_customizer_generated_values', $css ) );
}

/**
 * Enqueue Customizer settings into the block editor.
 */
function forte_editor_customizer_styles() {

	// Register Customizer styles within the editor to use for inline additions.
	wp_register_style( 'forte-editor-customizer-styles', false, '@@pkg.version', 'all' );

	// Enqueue the Customizer style.
	wp_enqueue_style( 'forte-editor-customizer-styles' );

	// Add custom colors to the editor.
	wp_add_inline_style( 'forte-editor-customizer-styles', forte_editor_customizer_generated_values() );
}
add_action( 'enqueue_block_editor_assets', 'forte_editor_customizer_styles' );
