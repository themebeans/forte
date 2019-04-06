<?php
/**
 * Theme Customizer functionality
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function forte_customize_register( $wp_customize ) {

	/**
	 * Customize.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/**
	 * Remove background image support.
	 */
	$wp_customize->remove_section( 'background_image' );

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-title-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-toggle-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_section(
		'forte_theme_options', array(
			'title'    => esc_html__( 'Theme Options', 'forte' ),
			'priority' => 30,
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => 100,
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', 'forte' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_mobile_max_width', array(
			'default'           => 50,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_mobile_max_width', array(
				'default'     => 50,
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Mobile Max Width', 'forte' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	/**
	 * Options.
	 */
	$wp_customize->add_setting( 'general_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'general_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'General', 'forte' ),
				'section' => 'forte_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'header_tagline', array(
			'default'   => esc_html__( 'My Blog', 'forte' ),
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'header_tagline', array(
			'label'   => esc_html__( 'Header Tagline', 'forte' ),
			'section' => 'forte_theme_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'twitter_profile', array(
			'default' => '',
		)
	);

	$wp_customize->add_control(
		'twitter_profile', array(
			'label'   => esc_html__( 'Twitter Username', 'forte' ),
			'section' => 'forte_theme_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'footer_copyright', array(
			'default' => '',
		)
	);

	$wp_customize->add_control(
		'footer_copyright', array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Footer Text', 'forte' ),
			'section' => 'forte_theme_options',
		)
	);

	$wp_customize->add_setting(
		'hidden_sidebar', array(
			'default' => true,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'hidden_sidebar', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Hidden Sidebar', 'forte' ),
				'description' => esc_html__( 'Toggle to enable a sidebar that hides behind the page content.', 'forte' ),
				'section'     => 'forte_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'infinitescroll', array(
			'default' => false,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'infinitescroll', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Infinite Scrolling', 'forte' ),
				'description' => esc_html__( 'Toggle to enable infinite scrolling on the blogroll and category views.', 'forte' ),
				'section'     => 'forte_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'show_related_posts', array(
			'default' => true,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'show_related_posts', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Related Posts', 'forte' ),
				'description' => esc_html__( 'Toggle to show categorically related posts on single posts.', 'forte' ),
				'section'     => 'forte_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'show_author', array(
			'default' => true,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'show_author', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Author Byline', 'forte' ),
				'description' => esc_html__( 'Toggle to show the author byline that appears on posts.', 'forte' ),
				'section'     => 'forte_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'post_likes', array(
			'default' => true,
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'post_likes', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Post Likes', 'forte' ),
				'description' => esc_html__( 'Toggle to show likes, which appear on the singular post hero area.', 'forte' ),
				'section'     => 'forte_theme_options',
			)
		)
	);

	/**
	 *  MailChimp for WordPress.
	 */
	if ( function_exists( 'mc4wp' ) ) {

		$wp_customize->add_setting( 'mc4qwp_title', array( 'sanitize_callback' => 'esc_html' ) );

		$wp_customize->add_control(
			new ThemeBeans_Title_Control(
				$wp_customize, 'mc4qwp_title', array(
					'type'    => 'themebeans-title',
					'label'   => esc_html__( 'MailChimp', 'forte' ),
					'section' => 'forte_theme_options',
				)
			)
		);

		$wp_customize->add_setting(
			'mc4wp_shortcode', array(
				'default' => '',
			)
		);

		$wp_customize->add_control(
			'mc4wp_shortcode', array(
				'label'       => esc_html__( 'MC4WP Shortcode', 'forte' ),
				'description' => esc_html__( 'Add a subscribe form to the single post footer using MailChimp for WordPress.', 'forte' ),
				'section'     => 'forte_theme_options',
				'type'        => 'text',
			)
		);

		$wp_customize->add_setting(
			'mailbag_title', array(
				'default' => esc_html__( 'Newsletter Subscribe', 'forte' ),
			)
		);

		$wp_customize->add_control(
			'mailbag_title', array(
				'label'   => esc_html__( 'Title', 'forte' ),
				'section' => 'forte_theme_options',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'mailbag_desc', array(
				'default' => esc_html__( 'Subscribe to our email newsletter and receive free stuff, updates & new releases - straight to your inbox.', 'forte' ),
			)
		);

		$wp_customize->add_control(
			'mailbag_desc', array(
				'type'    => 'textarea',
				'label'   => esc_html__( 'Paragraph', 'forte' ),
				'section' => 'forte_theme_options',
			)
		);
	}

	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( is_plugin_active( 'restrict-content-pro/restrict-content-pro.php' ) ) {

		$wp_customize->add_section(
			'rcp_settings', array(
				'title' => esc_html__( 'RCP', 'forte' ),
			)
		);

		$options_pages     = array();
		$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		$options_pages[''] = '';
		foreach ( $options_pages_obj as $page ) {
			$options_pages[ $page->ID ] = $page->post_title;
		}

		$wp_customize->add_setting( 'login_page_selector' );
		$wp_customize->add_control(
			'login_page_selector', array(
				'settings' => 'login_page_selector',
				'label'    => esc_html__( 'Login Page', 'forte' ),
				'section'  => 'rcp_settings',
				'type'     => 'select',
				'choices'  => $options_pages,
			)
		);

		$wp_customize->add_setting( 'register_page_selector' );
		$wp_customize->add_control(
			'register_page_selector', array(
				'settings' => 'register_page_selector',
				'label'    => esc_html__( 'Register Page', 'forte' ),
				'section'  => 'rcp_settings',
				'type'     => 'select',
				'choices'  => $options_pages,
			)
		);

		$wp_customize->add_setting( 'lostpass_page_selector' );
		$wp_customize->add_control(
			'lostpass_page_selector', array(
				'settings' => 'lostpass_page_selector',
				'label'    => esc_html__( 'Lost Page', 'forte' ),
				'section'  => 'rcp_settings',
				'type'     => 'select',
				'choices'  => $options_pages,
			)
		);
	}

	$wp_customize->add_section(
		'404_settings', array(
			'title' => esc_html__( '404', 'forte' ),
		)
	);

	$wp_customize->add_setting(
		'404-img-upload',
		array()
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, '404-img-upload', array(
				'label'    => esc_html__( '404 Custom Image', 'forte' ),
				'section'  => '404_settings',
				'settings' => '404-img-upload',
			)
		)
	);

	$wp_customize->add_setting(
		'error_text', array(
			'default' => 'Sorry, that page does not exist',
		)
	);

	$wp_customize->add_control(
		'error_text', array(
			'label'   => esc_html__( '404 Text', 'forte' ),
			'section' => '404_settings',
			'type'    => 'text',
		)
	);

	/**
	 * Colors.
	 */
	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default' => '#F54452',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'    => esc_html__( 'Accent Color', 'forte' ),
				'section'  => 'colors',
				'settings' => 'theme_accent_color',
			)
		)
	);

	$wp_customize->add_setting(
		'post_css_filter', array(
			'default' => 'none',
		)
	);

	$wp_customize->add_control(
		'post_css_filter', array(
			'type'    => 'select',
			'label'   => esc_html__( 'CSS3 Filter', 'forte' ),
			'section' => 'colors',
			'choices' => array(
				'none'       => 'None',
				'grayscale'  => 'Black & White',
				'sepia'      => 'Sepia Tone',
				'saturation' => 'High Saturation',
			),
		)
	);
}
add_action( 'customize_register', 'forte_customize_register' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function forte_customize_preview_js() {
	wp_enqueue_script( 'forte-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . FORTE_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'forte_customize_preview_js' );

/**
 * CSS to make the Customizer controls look a bit better.
 */
function forte_customize_controls_css() {
	wp_enqueue_style( 'forte-customize-preview', get_theme_file_uri( '/assets/css/customize-controls' . FORTE_ASSET_SUFFIX . '.css' ), '@@pkg.version', true );
}
add_action( 'customize_controls_print_styles', 'forte_customize_controls_css' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function forte_customize_controls_js() {
	wp_enqueue_script( 'forte-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . FORTE_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'forte_customize_controls_js' );

