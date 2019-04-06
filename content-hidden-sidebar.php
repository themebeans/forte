<?php
/**
 * The sidebar containing the hidden sidebar widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

?>
<div class="hidden-sidebar">

	<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>

		<div class="widget">

			<h5 class="widget-title"><?php esc_html_e( 'Menu', 'forte' ); ?></h5>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
				)
			);
			?>

		</div>

	<?php endif; ?>

	<?php dynamic_sidebar( 'hidden-panel' ); ?>

</div>
