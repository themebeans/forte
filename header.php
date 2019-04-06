<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<?php if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) { ?>

		<div id="skrollr-body">

			<div id="theme-wrapper">

				<?php if ( has_nav_menu( 'mobile-menu' ) ) : ?>

					<nav id="mobile-nav">

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'mobile-menu',
								'depth'          => 1,
							)
						);
						?>

					</nav>

				<?php endif; ?>

				<div id="page" class="hfeed site">

					<div class="nav-overlay"></div>

					<header id="header" class="header">

						<?php forte_site_logo(); ?>

						<?php if ( true === get_theme_mod( 'hidden_sidebar' ) ) { ?>
							<a class="sidebar-btn" href="javascript:void(0);"><span></span></a>
						<?php } ?>

					</header>

	<?php
}
