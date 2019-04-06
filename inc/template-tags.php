<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

if ( ! function_exists( 'forte_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function forte_site_logo() {

		$opacity = ( is_singular( 'post' ) ) ? 'data-0="opacity:.25;" data-50="opacity:.0;"' : null;

		echo '<div class="logo" ' . esc_attr( $opacity ) . '>';

		do_action( 'forte_before_site_logo' );

		if ( has_custom_logo() ) {
			echo '<div class="site-logo" itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';
		} else {
			printf( '<h1 class="site-title logo_text" itemscope itemtype="http://schema.org/Organization"><a href="%1$s" rel="home" itemprop="url">%2$s</a></h1>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
		}

		do_action( 'forte_after_site_logo' );

		echo '</div>';
	}

endif;

if ( ! function_exists( 'forte_site_logo_tagline' ) ) :
	/**
	 * Output the header tagline below the logo.
	 */
	function forte_site_logo_tagline() {

		if ( ! is_404() ) {
			global $post;
			$postid = $post->ID;
		}

		$page_title    = get_theme_mod( 'header_tagline' );
		$post_subtitle = get_post_meta( $post->ID, '_bean_post_subtitle', true );

		if ( is_archive() ) {
			echo '<h5>' . esc_html( bean_page_title() ) . '</h5>';
		} elseif ( is_search() ) {
			echo '<h5>' . esc_html( bean_page_title() ) . '</h5>';
		} elseif ( is_page_template( 'template-rcp.php' ) ) {
			if ( ! is_user_logged_in() ) {
				echo '<p>' . esc_html( $post_subtitle ) . '</p>';
			}
		} elseif ( is_page_template( 'template-rcp-lostpass.php' ) ) {
			if ( ! is_user_logged_in() ) {
				echo '<p>' . esc_html( $post_subtitle ) . '</p>';
			}
		} else {
			if ( $page_title ) { ?>
				<h5><?php echo esc_html( $page_title ); ?></h5>
			<?php
			}
		}
	}

endif;
add_action( 'forte_after_site_logo', 'forte_site_logo_tagline' );

if ( ! function_exists( 'bean_page_title' ) ) {
	/**
	 * Page title generator.
	 */
	function bean_page_title() {

		$page_title = '';

		if ( is_singular() ) {
			if ( is_page() ) {
				$page_title = get_the_title();
			} elseif ( is_single() ) {
				$page_title = get_the_title();
			}
		} else {
			if ( is_archive() ) {
				if ( is_category() ) {
					$page_title = sprintf( __( 'Posts in: %s', 'forte' ), single_cat_title( '', false ) );
				} elseif ( is_tag() ) {
					$page_title = sprintf( __( 'Posts tagged: %s', 'forte' ), single_tag_title( '', false ) );
				} elseif ( is_date() ) {
					if ( is_month() ) {
						$page_title = sprintf( __( 'Archive for: %s', 'forte' ), get_the_time( 'F, Y' ) );
					} elseif ( is_year() ) {
						$page_title = sprintf( __( 'Archive for: %s', 'forte' ), get_the_time( 'Y' ) );
					} elseif ( is_day() ) {
						$page_title = sprintf( __( 'Archive for: %s', 'forte' ), get_the_time( get_option( 'date_format' ) ) );
					} else {
						$page_title = __( 'Archives', 'forte' );
					}
				} elseif ( is_author() ) {
					if ( get_query_var( 'author_name' ) ) {
						$curauth = get_user_by( 'login', get_query_var( 'author_name' ) );
					} else {
						$curauth = get_userdata( get_query_var( 'author' ) );
					}
					$author_name = $curauth->display_name;
					$title       = sprintf( __( 'Posts by %s', 'forte' ), $author_name );
					$page_title  = $title;
				} else {
					$page_title = single_term_title( '', false );
				}
			} elseif ( is_search() ) {
				$page_title = sprintf( __( 'Results for &#8220;%s&#8221;', 'forte' ), get_search_query() );
			} elseif ( is_home() ) {
				$page_title = get_theme_mod( 'header_tagline' );
			}
		} //END else
		return $page_title;

	}
}

if ( ! function_exists( 'bean_index_pagination' ) ) {
	/**
	 * Pagination.
	 */
	function bean_index_pagination( $pages = '' ) {
		global $paged;

		if ( get_query_var( 'paged' ) ) {
			 $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			 $paged = get_query_var( 'page' );
		} else {
			 $paged = 1;
		}

		$output    = '';
		$prev      = $paged - 1;
		$next      = $paged + 1;
		$range     = 7;
		$showitems = ( $range * 2 ) + 1;

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		$method = 'get_pagenum_link';
		if ( is_single() ) {
			$method = 'bean_post_pagination_link';
		}

		$archive_nav = 'bean_post_pagination_link';

		if ( 1 != $pages ) {
			$output .= "<div class='index-pagination'>";

			$output .= ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) ? "<a href='" . $method( 1 ) . "'></a>" : '';

			$output .= ( $paged < $pages ) ? "<a href='" . $method( $next ) . "' class='next'>Next</a>" : "<a href='" . $method( $next ) . "' class='next hidden'>Next</a>";

			for ( $i = 1; $i <= $pages; $i++ ) {
				if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
					$output .= ( $paged == $i ) ? "<a href='" . $method( $i ) . "' class='current'>" . $i . '</a>' : "<a href='" . $method( $i ) . "' class='inactive' >" . $i . '</a>';
				}
			}

			$output .= ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) ? "<a href='" . $method( $pages ) . "'></a>" : '';

			$output .= ( $paged > 1 ) ? "<a href='" . $method( $prev ) . "' class='prev'>Previous</a>" : "<a href='" . $method( $prev ) . "' class='prev hidden'>Previous</a>";

			$output .= "</div>\n";
		}

		return $output;
	}

	function bean_post_pagination_link( $link ) {
		$url = preg_replace( '!">$!', '', _wp_link_page( $link ) );
		$url = preg_replace( '!^<a href="!', '', $url );
		return $url;
	}
}

if ( ! function_exists( 'bean_get_related_posts' ) ) {
	/**
	 * Get related posts.
	 */
	function bean_get_related_posts( $post_id, $taxonomy, $args = array() ) {
		$terms = wp_get_object_terms( $post_id, $taxonomy );

		if ( count( $terms ) ) {
			$post      = get_post( $post_id );
			$our_terms = array();
			foreach ( $terms as $term ) {
				$our_terms[] = $term->slug;
			}

			$args  = wp_parse_args(
				$args, array(
					'post_type'    => $post->post_type,
					'post__not_in' => array( $post_id ),
					'tax_query'    => array(
						array(
							'taxonomy' => $taxonomy,
							'terms'    => $our_terms,
							'field'    => 'slug',
							'operator' => 'IN',
						),
					),
					'orderby'      => 'rand',
				)
			);
			$query = new WP_Query( $args );
			return $query;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'bean_audio' ) ) :
	/**
	 * Output the custom audio player.
	 */
	function bean_audio( $postid ) {
		$mp3 = get_post_meta( $postid, '_bean_audio_mp3', true );
		?>

		<div id="jp_container_<?php echo esc_attr( $postid ); ?>" class="jp-audio fullwidth" data-file="<?php echo esc_html( $mp3 ); ?>">
			<div id="jquery_jplayer_<?php echo esc_attr( $postid ); ?>" class="jp-jplayer">
			</div>
			<div class="jp-interface" style="display: none;">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span><?php _e( 'Play', 'forte' ); ?></span></a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span><?php _e( 'Pause', 'forte' ); ?></span></a></li>
				</ul>
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
endif;
