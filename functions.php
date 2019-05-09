<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

if ( ! defined( 'FORTE_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'FORTE_DEBUG', true );
endif;

if ( ! defined( 'FORTE_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'FORTE_DEBUG' ) || true === FORTE_DEBUG ) {
		define( 'FORTE_ASSET_SUFFIX', null );
	} else {
		define( 'FORTE_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function forte_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tabor, use a find and replace
	 * to change 'forte' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'forte', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Tabor's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 140, 140 );
	add_image_size( 'sml-thumbnail', 50, 50, true );
	add_image_size( 'post-full', 9999, 9999, false );

	// Set the content width in pixels, based on the theme's design and stylesheet.
	$GLOBALS['content_width'] = apply_filters( 'tabor_content_width', 920 );

	/*
	 * This theme uses wp_nav_menu() in the following locations.
	 */
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Navigation', 'forte' ),
			'mobile-menu'  => esc_html__( 'Mobile Navigation', 'forte' ),
		)
	);

	/*
	 * Switch default core taborup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', apply_filters(
			'forte_post_formats', array(
				'audio',
				'link,',
				'quote',
				'video',
			)
		)
	);

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width' => true,
		)
	);

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support responsive embedded content
	 * See: https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#responsive-embedded-content
	 */
	add_theme_support( 'responsive-embeds' );

	/**
	 * Custom colors for use in the editor.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	 */
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Black', 'forte' ),
				'slug'  => 'black',
				'color' => '#212121',
			),
			array(
				'name'  => esc_html__( 'Gray', 'forte' ),
				'slug'  => 'gray',
				'color' => '#555555',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'forte' ),
				'slug'  => 'light-gray',
				'color' => '#9b9b9b',
			),
			array(
				'name'  => esc_html__( 'White', 'forte' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Titan White', 'forte' ),
				'slug'  => 'titan-white',
				'color' => '#E0D8E2',
			),
			array(
				'name'  => esc_html__( 'Tropical Blue', 'forte' ),
				'slug'  => 'tropical-blue',
				'color' => '#C5DCF3',
			),
			array(
				'name'  => esc_html__( 'Peppermint', 'forte' ),
				'slug'  => 'peppermint',
				'color' => '#d0eac4',
			),
			array(
				'name'  => esc_html__( 'Iceberg', 'forte' ),
				'slug'  => 'iceberg',
				'color' => '#D6EFEE',
			),
			array(
				'name'  => esc_html__( 'Bridesmaid', 'forte' ),
				'slug'  => 'bridesmaid',
				'color' => '#FBE7DD',
			),
			array(
				'name'  => esc_html__( 'Pipi', 'forte' ),
				'slug'  => 'pipi',
				'color' => '#fbf3d6',
			),
			array(
				'name'  => esc_html__( 'Accent', 'forte' ),
				'slug'  => 'accent',
				'color' => esc_html( get_theme_mod( 'accent_color', '#F54452' ) ),
			),
		)
	);

	/**
	 * Custom font sizes for use in the editor.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-font-sizes
	 */
	add_theme_support(
		'editor-font-sizes', array(
			array(
				'name'      => esc_html__( 'Small', 'forte' ),
				'shortName' => esc_html__( 'S', 'forte' ),
				'size'      => 17,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Medium', 'forte' ),
				'shortName' => esc_html__( 'M', 'forte' ),
				'size'      => 21,
				'slug'      => 'medium',
			),
			array(
				'name'      => esc_html__( 'Large', 'forte' ),
				'shortName' => esc_html__( 'L', 'forte' ),
				'size'      => 24,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'forte' ),
				'shortName' => esc_html__( 'XL', 'forte' ),
				'size'      => 32,
				'slug'      => 'huge',
			),
		)
	);

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide alignment, if the sidebar is not in use.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'assets/css/style-editor' . FORTE_ASSET_SUFFIX . '.css' );

	// Enqueue fonts in the editor.
	add_editor_style( forte_fonts_url() );
}
add_action( 'after_setup_theme', 'forte_setup' );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function forte_widgets_init() {

	if ( true === get_theme_mod( 'hidden_sidebar' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'forte' ),
				'id'            => 'hidden-panel',
				'description'   => esc_html__( 'Widget area for the hidden sidebar.', 'forte' ),
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
			)
		);
	}

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Col 1', 'forte' ),
			'id'            => 'footer-col-1',
			'description'   => esc_html__( 'Widget area for the first footer area.', 'forte' ),
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Col 2', 'forte' ),
			'id'            => 'footer-col-2',
			'description'   => esc_html__( 'Widget area for the second footer area.', 'forte' ),
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Col 3', 'forte' ),
			'id'            => 'footer-col-3',
			'description'   => esc_html__( 'Widget area for the third footer area.', 'forte' ),
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'forte_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function forte_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'forte-fonts', forte_fonts_url(), false, '@@pkg.version', 'all' );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'forte-style', get_parent_theme_file_uri( '/style' . FORTE_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
		wp_enqueue_style( 'forte-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'forte-style', get_theme_file_uri( '/style' . FORTE_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( FORTE_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'forte-libraries', get_theme_file_uri( '/assets/js/vendors/custom-libraries.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom script.
		wp_enqueue_script( 'forte-likes', get_theme_file_uri( '/assets/js/custom/likes.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'forte-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'forte-global'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'forte-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'forte-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'forte-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue masonry.
	if ( is_page_template( 'template-team.php' ) ) {
		wp_enqueue_script( 'masonry' );
	}

	// Localization.
	wp_localize_script( $translation_handle, 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_template_directory_uri() ) );
	wp_localize_script(
		$translation_handle, 'forte_localization', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'url'     => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'forte-likes-nonce' ),
			'like'    => esc_attr( 'Like', 'forte' ),
			'unlike'  => esc_attr( 'Unlike', 'forte' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'forte_scripts' );

if ( ! function_exists( 'forte_fonts_url' ) ) :
	/**
	 * Register custom fonts.
	 */
	function forte_fonts_url() {
		$fonts_url = '';

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Cabin, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$cabin = esc_html_x( 'on', 'Cabin font: on or off', 'forte' );

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Merriweather, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$merriweather = esc_html_x( 'on', 'Merriweather font: on or off', 'forte' );

		if ( 'off' !== $cabin || 'off' !== $merriweather ) {
			$font_families = array();

			if ( 'off' !== $cabin ) {
				$font_families[] = 'Cabin:400,500,700';
			}

			if ( 'off' !== $merriweather ) {
				$font_families[] = 'Merriweather:400,300';
			}

			$query_args = array(
				'family' => rawurlencode( implode( '|', $font_families ) ),
				'subset' => rawurlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array|array   $urls           URLs to print for resource hints.
 * @param  string|string $relation_type  The relation type the URLs are printed.
 * @return array|array   $urls           URLs to print for resource hints.
 */
function forte_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'forte-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'forte_resource_hints', 10, 2 );

/**
 * Remove single CPT for /team/
 */
function forte_no_single_cpt_redirect() {
	$queried_post_type = get_query_var( 'post_type' );
	if ( is_single() && 'team' === $queried_post_type ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'forte_no_single_cpt_redirect' );

/**
 * Filter the protected title.
 */
function forte_filter_protected_title( $title ) {
	return '%s';
}
add_filter( 'protected_title_format', 'forte_filter_protected_title' );

/**
 * Custom password protected form.
 */
function forte_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	<p>' . __( 'To view this protected post enter the password below:', 'forte' ) . '</p>
	<label for="' . $label . '">' . __( 'Password:' ) . ' </label><input name="post_password" id="' . $label . '" type="password" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" />
	</form>
	';
	return $o;
}
add_filter( 'the_password_form', 'forte_password_form' );

/**
 * Custom comments.
 */
if ( ! function_exists( 'forte_comment' ) ) {
	function forte_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">

				<?php echo get_avatar( $comment, $size = '60' ); ?>

				<header class="comment-header">
					<div class="comment-author vcard">
						<?php printf( __( '<cite class="fn">%s</cite> ', 'forte' ), get_comment_author_link() ); ?>
					</div><!-- END .comment-author.vcard -->
					<div class="comment-meta commentmetadata subtext">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'forte' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit', 'forte' ), ' / ', '' ); ?>  /
											<?php
											comment_reply_link(
												array_merge(
													$args, array(
														'depth' => $depth,
														'max_depth' => $args['max_depth'],
													)
												)
											);
?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<span class="moderation">&nbsp;&middot;&nbsp;&nbsp;<?php _e( 'Awaiting Moderation', 'forte' ); ?></span>
						<?php endif; ?>
					</div><!-- END .comment-meta.commentmetadata.subtext -->
				</header>

				<div class="comment-body">
					<?php comment_text(); ?>
				</div><!-- END .comment-body -->

			</div><!-- END #comment-<?php comment_ID(); ?> -->
		</li>
		<?php
	}
}

/**
 * Custom pings.
 */
function forte_ping( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>

	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

	<?php
}

/**
 * Comments WP 4.4 Fix
 */
function forte_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'forte_move_comment_field_to_bottom' );

/**
 * Comments form filters.
 */
function forte_custom_form_filters( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id ) {
		$post_id = $id;
	} else {
		$id = $post_id;
	}

	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$fields = array(

		'author' => '
		<p class="comment-form-author">
			<label for="author">' . __( 'Name', 'forte' ) . ( ' <span class="required">*</span>' ) . '</label>
			<input id="author" name="author" type="text" tabindex="2" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
		</p>',

		'email'  => '
		<p class="comment-form-email">
			<label for="email">' . __( 'Email', 'forte' ) . ( ' <span class="required">*</span>' ) . '</label>
			<input id="email" name="email" type="text" tabindex="3" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required/>
		</p>',

		'url'    => '
		<p class="comment-form-url">
			<label for="url">' . __( 'Website', 'forte' ) . '</label>
			<input id="url" name="url" type="text" tabindex="4" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
		</p>',
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" tabindex="1" cols="45" rows="8" placeholder="Leave a comment here..." required></textarea></p><a href="#" id="cancel-comment">Cancel</a>',
		'',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'forte' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'forte' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'title_reply'          => '',
		'title_reply_to'       => __( 'Leave a Reply to %s', 'forte' ),
		'cancel_reply_link'    => __( 'Cancel', 'forte' ),
		'label_submit'         => __( 'Submit Comment', 'forte' ),
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'forte_custom_form_filters' );

if ( ! function_exists( 'forte_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function forte_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'forte_pingback_header' );
endif;

/**
 * SVG icon functionality for this theme.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/customizer-editor.php' );

/**
 * Metaboxes.
 */
require get_theme_file_path( '/inc/metaboxes.php' );

/**
 * Likes.
 */
require get_theme_file_path( '/inc/likes.php' );

/**
 * Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}
