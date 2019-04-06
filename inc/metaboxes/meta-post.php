<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Post metaboxes.
 */
function bean_metabox_post() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'bean-meta-box-gallery',
		'title'    => __( 'Image/Gallery Post Format Settings', 'forte' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Gallery Images:',
				'desc' => 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.',
				'id'   => $prefix . 'post_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'forte' ),
			),
			array(
				'name' => __( 'Randomize Gallery:', 'forte' ),
				'id'   => $prefix . 'post_randomize',
				'type' => 'checkbox',
				'desc' => __( 'Randomize the gallery on page load.', 'forte' ),
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'bean_metabox_post' );
