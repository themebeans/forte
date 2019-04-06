<?php
/**
 * The output for the mobile sidebar.
 * This content is pulled on every page via the footer.php file.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

?>
<div class="mobile-sidebar mobile-sidebar-right">

	<form id="mobile-search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="clearfix default_searchform">
			<input type="text" name="s" class="s" placeholder="Search..." />
			<input type="submit" value="" class="button">
		</div>
		<?php do_action( 'bean_search_form' ); ?>
	</form>

	<?php if ( has_nav_menu( 'mobile-menu' ) ) : ?>
		<nav id="mobile-nav">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'mobile-menu',
				)
			);
			?>
		</nav>
	<?php endif; ?>

</div>
