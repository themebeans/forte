<?php
/**
 * Metaboxes.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Define the metabox and field configurations.
 */
function forte_metaboxes() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_bean_';

	// Set the context, based on whether or not Gutenberg is enabled.
	$context = ( function_exists( 'register_block_type' ) ) ? 'side' : 'normal';

	// Check for post formats.
	$formats = apply_filters( 'tabor_post_formats', array( 'audio', 'link,', 'quote', 'video' ) );

	/**
	 * Page Settings.
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => 'page-settings',
			'title'        => esc_html__( 'Page Settings', 'forte' ),
			'object_types' => array( 'page' ),
			'context'      => $context,
			'priority'     => 'high',
		)
	);

	$cmb->add_field(
		array(
			'name'    => esc_html__( 'Fullscreen Hero', 'forte' ),
			'id'      => $prefix . 'hero',
			'type'    => 'checkbox',
			'default' => true,
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Subtitle', 'forte' ),
			'id'   => $prefix . 'post_subtitle',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name'    => esc_html__( 'Hero Background', 'forte' ),
			'id'      => $prefix . 'post_cover_color',
			'type'    => 'colorpicker',
			'default' => '#000000',
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Hero Video URL', 'forte' ),
			'id'   => $prefix . 'video_background_upload',
			'type' => 'file',
			'text' => array(
				'add_upload_file_text' => esc_html__( 'Upload Video', 'forte' ),
			),
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Hero Video Embed', 'forte' ),
			'id'   => $prefix . 'embedded_background_upload',
			'type' => 'textarea_small',
		)
	);

	/**
	 * Post Settings.
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => 'post_settings',
			'title'        => esc_html__( 'Post Settings', 'forte' ),
			'object_types' => array( 'post' ),
			'context'      => $context,
			'priority'     => 'high',
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Subtitle', 'forte' ),
			'id'   => $prefix . 'post_subtitle',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name'    => esc_html__( 'Hero Background', 'forte' ),
			'id'      => $prefix . 'post_cover_color',
			'type'    => 'colorpicker',
			'default' => '#000000',
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Hero Video URL', 'forte' ),
			'id'   => $prefix . 'video_background_upload',
			'type' => 'file',
			'text' => array(
				'add_upload_file_text' => esc_html__( 'Upload Video', 'forte' ),
			),
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Hero Video Embed', 'forte' ),
			'id'   => $prefix . 'embedded_background_upload',
			'type' => 'textarea_small',
		)
	);

	/**
	 * Audio.
	 * Check if audio post format is supported.
	 */
	if ( in_array( 'audio', $formats, true ) ) {
		$cmb = new_cmb2_box(
			array(
				'id'           => 'post_format_audio',
				'title'        => esc_html__( 'Audio Post Format', 'forte' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Audio File URL', 'forte' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'text' => array(
					'add_upload_file_text' => esc_html__( 'Upload Audio', 'forte' ),
				),
			)
		);
	}

	/**
	 * Quote.
	 * Check if quote post format is supported.
	 */
	if ( in_array( 'quote', $formats, true ) ) {
		$cmb = new_cmb2_box(
			array(
				'id'           => 'post_format_quote',
				'title'        => esc_html__( 'Quote Post Format', 'forte' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Quote', 'forte' ),
				'id'   => $prefix . 'quote',
				'type' => 'textarea_small',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Cite', 'forte' ),
				'id'   => $prefix . 'quote_source',
				'type' => 'text',
			)
		);
	}

	/**
	 * Video.
	 * Check if video post format is supported.
	 */
	if ( in_array( 'video', $formats, true ) ) {
		$cmb = new_cmb2_box(
			array(
				'id'           => 'post_format_video',
				'title'        => esc_html__( 'Video Post Format', 'forte' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Embed', 'forte' ),
				'desc' => __( 'Enter a Youtube or Vimeo URL. Supports services listed <a target="_blank" href="http://codex.wordpress.org/Embeds">here</a>.', 'forte' ),
				'id'   => $prefix . 'video_embed',
				'type' => 'oembed',
			)
		);
	}

	/**
	 * Link.
	 * Check if video post format is supported.
	 */
	if ( in_array( 'link', $formats, true ) ) {
		$cmb = new_cmb2_box(
			array(
				'id'           => 'post_format_link',
				'title'        => esc_html__( 'Link Post Format', 'forte' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Link Title', 'forte' ),
				'desc' => __( 'Add a title for the link.', 'forte' ),
				'id'   => $prefix . 'link_title',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Link', 'forte' ),
				'desc' => __( 'Add a link to direct your single link post to.', 'forte' ),
				'id'   => $prefix . 'link_url',
				'type' => 'text_url',
			)
		);
	}
}
add_action( 'cmb2_admin_init', 'forte_metaboxes' );

/**
 * Enqueue JavaScript for post meta.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function forte_metaboxes_script( $hook ) {

	// Only enqueue this script on edit screens.
	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'forte-metaboxes', get_parent_theme_file_uri( '/assets/css/metaboxes.css' ), false, '@@pkg.version', 'all' );

	// Return early if Gutenberg is deployed.
	if ( function_exists( 'register_block_type' ) ) {
		return;
	}

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'forte-metaboxes', get_theme_file_uri( '/assets/js/admin/metaboxes.js' ), array( 'jquery', 'wp-color-picker' ), '@@pkg.version', true );
}
add_action( 'admin_enqueue_scripts', 'forte_metaboxes_script' );
