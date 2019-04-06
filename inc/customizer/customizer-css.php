<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function forte_customizer_css() {

	$background_color   = get_theme_mod( 'background_color', '#ffffff' );
	$theme_accent_color = get_theme_mod( 'theme_accent_color', '#F54452' );
	$page_text_align    = get_post_meta( get_the_ID(), '_bean_page_text_align', true );
	$css_filter_style   = get_theme_mod( 'post_css_filter' );

	$logo_maxwidth       = get_theme_mod( 'custom_logo_max_width', 100 );
	$logo_mobilemaxwidth = get_theme_mod( 'custom_logo_mobile_max_width', 50 );

	$css =
	'

	@media screen and (max-width: 768px) {
	    body .custom-logo-link img.custom-logo {
	        width: ' . esc_attr( $logo_mobilemaxwidth ) . 'px;
	    }
	}

	@media screen and (min-width: 769px) {
	    body .custom-logo-link img.custom-logo {
	        width: ' . esc_attr( $logo_maxwidth ) . 'px;
	    }
	}

	body #theme-wrapper { background-color: #' . $background_color . '; }

	.has-accent-color { color: ' . esc_attr( $theme_accent_color ) . '; }

	.has-accent-background-color { background-color: ' . esc_attr( $theme_accent_color ) . '; }

	a { color:' . $theme_accent_color . '; }
	.cats,
	.team-member h6 a:hover,
	#wp-calendar tbody a,
	.index-pagination a:hover,
	.widget_bean_tweets a.button:hover,
	p a:hover,
	h1 a:hover,
	.author-tag,
	.a-link:hover,
	.widget a:hover,
	.widget li a:hover,
	#filter li a.active,
	#filter li a.hover,
	.entry-meta a:hover,
	.pagination a:hover,
	header ul li a:hover,
	footer ul li a:hover,
	.single-price .price,
	.entry-title a:hover,
	.comment-meta a:hover,
	h2.entry-title a:hover,
	li.current-menu-item a,
	.comment-author a:hover,
	.products li h2 a:hover,
	.entry-link a.link:hover,
	.team-content h3 a:hover,
	.site-description a:hover,
	.grid-item .entry-meta a:hover,
	#cancel-comment-reply-link:hover,
	.shipping-calculator-button:hover,
	.single-product ul.tabs li a:hover,
	.grid-item.post .entry-meta a:hover,
	.single-product ul.tabs li.active a,
	.single-portfolio .sidebar-right a.url,
	.grid-item.portfolio .entry-meta a:hover,
	.portfolio.grid-item span.subtext a:hover,
	.sidebar .widget_bean_tweets .button:hover,
	.entry-content .portfolio-social li a:hover,
	header ul > .sfHover > a.sf-with-ul,
	.product-content h2 a:hover,
	#cancel-comment:hover,
	.hidden-sidebar.dark .widget_bean_tweets .button:hover,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title { color:' . $theme_accent_color . '!important; }

	.onsale,
	.new-tag,
	.bean-btn,
	.bean-shot,
	.btn:hover,
	.button:hover,
	div.jp-play-bar,
	.flickr_badge_image,
	div.jp-volume-bar-value,
	.btn[type="submit"]:hover,
	input[type="reset"]:hover,
	input[type="button"]:hover,
	input[type="submit"]:hover,
	.rcp-access-btns .btn.rcp-subscribe,
	.button[type="submit"]:hover,
	#load-more:hover .overlay h5,
	.sidebar-btn .menu-icon:hover,
	.widget .buttons .checkout.button,
	.side-menu .sidebar-btn .menu-icon,
	.dark_style .sidebar-btn .menu-icon,
	.comment-form-rating p.stars a.active,
	.dark_style .masonry-item .overlay-arrow,
	table.cart td.actions .checkout-button.button,
	.subscribe .mc4wp-form input[type="submit"]:hover,
	.page-template-template-landing-php #load-more:hover,
	.entry-content .mejs-controls .mejs-time-rail span.mejs-time-current { background-color:' . $theme_accent_color . '; }

	.entry-content .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background:' . $theme_accent_color . '; }

	.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }

	.bean-quote,
	.instagram_badge_image,
	.bean500px_badge_image,
	.products li a.added_to_cart,
	.single_add_to_cart_button.button,
	.btn:hover,
	.button:hover,
	.btn[type="submit"]:hover,
	input[type="reset"]:hover,
	input[type="button"]:hover,
	input[type="submit"]:hover,
	.button[type="submit"]:hover,
	.dark_style.side-menu .sidebar-btn .menu-icon:hover { background-color:' . $theme_accent_color . '!important; }

	.entry-content {text-align:' . $page_text_align . '!important;}

	.bean-pricing-table .pricing-column li span {color:' . $theme_accent_color . '!important;}#powerTip,.bean-pricing-table .pricing-highlighted{background-color:' . $theme_accent_color . '!important;}#powerTip:after {border-color:' . $theme_accent_color . ' transparent!important; }
	';

	if ( $css_filter_style ) {
		switch ( $css_filter_style ) {
			case 'none':
				break;
			case 'grayscale':
				$css .= 'article .background-video, article .post-cover { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
				break;
			case 'sepia':
				$css .= 'article .background-video, article .post-cover { -webkit-filter: sepia(50%); }';
				break;
			case 'saturation':
				$css .= 'article .background-video, article .post-cover { -webkit-filter: saturate(150%); }';
				break;
		}
	}

	wp_add_inline_style( 'forte-style', wp_strip_all_tags( $css ) );
}
add_action( 'wp_enqueue_scripts', 'forte_customizer_css' );
