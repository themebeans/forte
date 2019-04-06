<?php
/**
 * The template for displaying the a MailChimp for WordPress shortcode on single posts.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

if ( post_password_required() ) {
	return;
}

if ( ! function_exists( 'mc4wp' ) ) {
	return;
}

$shortcode = get_theme_mod( 'mc4wp_shortcode' );

if ( $shortcode ) { ?>

	<div class="subscribe">

		<h4><?php echo esc_html( get_theme_mod( 'mailbag_title' ) ); ?></h4>

		<p><?php echo esc_html( get_theme_mod( 'mailbag_desc' ) ); ?></p>

		<?php echo do_shortcode( $shortcode ); ?>

	</div>

<?php } ?>
