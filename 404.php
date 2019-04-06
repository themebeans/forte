<?php
/**
 * The template for displaying the 404 error page
 * This page is set automatically, not through the use of a template
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header(); ?>

<div class="entry-content">

	<div class="error-logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>" rel="home">
		<?php if ( get_theme_mod( '404-img-upload' ) ) { ?>
			<img src="<?php echo esc_url( get_theme_mod( '404-img-upload' ) ); ?>"/>
		<?php } else { ?>
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/404.png' ) ); ?>">
		<?php } ?>
		</a>
	</div>

	<p>
		<?php esc_html_e( 'We couldn’t find the page you were looking for.', 'forte' ); ?></br>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Click here to go to the homepage', 'forte' ); ?></a>
	</p>

</div>

<?php
get_footer();
