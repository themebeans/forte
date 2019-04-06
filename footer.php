<?php
/**
 * The template for displaying the footer
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

?>

	<?php if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) { ?>

			</div><!-- END #page -->

			<footer id="footer" class="footer
			<?php
			if ( true === get_theme_mod( 'infinitescroll' ) ) {
				echo ' infinite'; }
?>
	<?php
	if ( comments_open() && is_page() && post_type_supports( get_post_type(), 'comments' ) ) {
				echo 'open-comments'; }
?>
">

				<?php if ( is_active_sidebar( 'footer-col-1' ) || is_active_sidebar( 'footer-col-2' ) || is_active_sidebar( 'footer-col-3' ) ) { ?>

					<div class="footer-widgets">

						<div class="footer-col footer-col-1">
							<?php dynamic_sidebar( 'footer-col-1' ); ?>
						</div><!-- END .footer-col-1 -->

						<div class="footer-col footer-col-2">
							<?php dynamic_sidebar( 'footer-col-2' ); ?>
						</div><!-- END .footer-col-2 -->

						<div class="footer-col footer-col-3">
							<?php dynamic_sidebar( 'footer-col-3' ); ?>
						</div><!-- END .footer-col-2 -->

					</div><!-- END .widgets -->

				<?php } ?>

				<div class="footer-colophon">

					<p class="copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a></p>

					<p class="credit">
					<?php
					if ( get_theme_mod( 'footer_copyright' ) ) {
						echo get_theme_mod( 'footer_copyright' );
					} else {
						echo '<a href="http://themebeans.com/theme/forte">Forte</a> Theme by <a href="http://themebeans.com">ThemeBeans</a>';
					}
					?>
					</p>

				</div><!-- END .footer-colophon -->

			</footer><!-- END #footer-->

		</div><!-- END #theme-wrapper -->

		<?php
		if ( get_theme_mod( 'hidden_sidebar' ) == true ) {
			get_template_part( 'content', 'hidden-sidebar' );
		}
		?>

	</div><!-- END #skrollr-body -->

<?php } ?>

<?php wp_footer(); ?>

</body>

</html>
