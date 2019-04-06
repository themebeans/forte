<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Team metaboxes.
 */
function bean_metabox_team() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => __( 'Team Member Settings', 'forte' ),
		'description' => '',
		'page'        => 'team',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Role:', 'forte' ),
				'desc' => __( 'Display this team member&#39;s position.', 'forte' ),
				'id'   => $prefix . 'team_role',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Quote:', 'forte' ),
				'desc' => __( 'Display a small quote on image hover.', 'forte' ),
				'id'   => $prefix . 'team_quote',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'External URL:', 'forte' ),
				'desc' => __( 'Insert a URL to link this team member to.', 'forte' ),
				'id'   => $prefix . 'team_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'bean_metabox_team' );
