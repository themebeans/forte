<?php
/**
 * Likes.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Portfolio_Professional_Likes Class
 */
class Portfolio_Professional_Likes {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'forte_likes', array( $this, 'theme_output' ) );
		add_action( 'wp_ajax_nopriv_post_like', array( $this, 'post_like' ) );
		add_action( 'wp_ajax_post_like', array( $this, 'post_like' ) );

		$this->meta_count            = '_likes';
		$this->meta_liked_posts      = 'forte_liked_posts';
		$this->meta_user_liked       = 'forte_liked';
		$this->meta_user_liked_count = 'forte_liked_count';
	}

	/**
	 * Returns whether or not the portfolio post is featured.
	 */
	public function post_like() {

		$nonce = $_POST['nonce'];

		if ( ! wp_verify_nonce( $nonce, 'forte-likes-nonce' ) ) {
			die();
		}

		if ( isset( $_POST['post_like'] ) ) {

			if ( isset( $_POST['post_id'] ) ) {
				$post_id = $_POST['post_id'];
			} else {
				die();
			}

			$post_like_count = get_post_meta( $post_id, $this->meta_count, true );

			if ( function_exists( 'wp_cache_post_change' ) ) {
				$GLOBALS['super_cache_enabled'] = 1;
				wp_cache_post_change( $post_id );
			}

			if ( is_user_logged_in() ) {
				$user_id     = get_current_user_id();
				$meta_posts  = get_user_option( $this->meta_liked_posts, $user_id );
				$meta_users  = get_post_meta( $post_id, $this->meta_user_liked );
				$liked_posts = null;
				$liked_users = null;

				if ( count( $meta_posts ) !== 0 ) {
					$liked_posts = $meta_posts;
				}

				if ( ! is_array( $liked_posts ) ) {
					$liked_posts = array();
				}

				if ( count( $meta_users ) !== 0 ) {
					$liked_users = $meta_users[0];
				}

				if ( ! is_array( $liked_users ) ) {
					$liked_users = array();
				}

				$liked_posts[ 'post-' . $post_id ] = $post_id;
				$liked_users[ 'user-' . $user_id ] = $user_id;
				$user_likes                        = count( $liked_posts );

				if ( ! $this->already_liked( $post_id ) ) {
					update_post_meta( $post_id, $this->meta_user_liked, $liked_users );
					update_post_meta( $post_id, $this->meta_count, ++$post_like_count );
					update_user_option( $user_id, $this->meta_liked_posts, $liked_posts );
					update_user_option( $user_id, $this->meta_user_liked_count, $user_likes );
					echo esc_attr( $post_like_count );

				} else {
					$pid_key = array_search( $post_id, $liked_posts, true );
					$uid_key = array_search( $user_id, $liked_users, true );
					unset( $liked_posts[ $pid_key ] );
					unset( $liked_users[ $uid_key ] );
					$user_likes = count( $liked_posts );
					update_post_meta( $post_id, $this->meta_user_liked, $liked_users );
					update_post_meta( $post_id, $this->meta_count, --$post_like_count );
					update_user_option( $user_id, $this->meta_liked_posts, $liked_posts );
					update_user_option( $user_id, $this->meta_user_liked_count, $user_likes );
					echo 'already' . esc_attr( $post_like_count );
				}
			} else {
				$ip        = '';
				$liked_ips = null;

				if ( ! is_array( $liked_ips ) ) {
					$liked_ips = array();
				}

				if ( ! in_array( $ip, $liked_ips, true ) ) {
					$liked_ips[ 'ip-' . $ip ] = $ip;
				}

				if ( ! $this->already_liked( $post_id ) ) {
					update_post_meta( $post_id, $this->meta_count, ++$post_like_count );
					echo esc_attr( $post_like_count );

				} else {
					$ip_key = array_search( $ip, $liked_ips, true );
					unset( $liked_ips[ $ip_key ] );
					update_post_meta( $post_id, $this->meta_count, --$post_like_count );
					echo 'already' . esc_attr( $post_like_count );
				}
			}
		}

		exit;
	}

	/**
	 * Check if a user has already liked the post.
	 *
	 * @param int $post_id Post ID.
	 */
	public function already_liked( $post_id ) {
		if ( is_user_logged_in() ) {

			$user_id     = get_current_user_id();
			$meta_users  = get_post_meta( $post_id, $this->meta_user_liked );
			$liked_users = '';

			if ( count( $meta_users ) !== 0 ) {
				$liked_users = $meta_users[0];
			}
			if ( ! is_array( $liked_users ) ) {
				$liked_users = array();
			}

			if ( in_array( $user_id, $liked_users, true ) ) {
				return true;
			}

			return false;

		} else {
			$ip        = '';
			$liked_ips = '';

			if ( ! is_array( $liked_ips ) ) {
				$liked_ips = array();
			}

			if ( in_array( $ip, $liked_ips, true ) ) {
				return true;
			}

			return false;
		}
	}

	/**
	 * Toggle Featured status of a product from admin.
	 *
	 * @param int $post_id Post ID.
	 */
	public function count( $post_id ) {

		$like_count = get_post_meta( $post_id, $this->meta_count, true );
		$count      = ( empty( $like_count ) || '0' === $like_count ) ? '0' : esc_attr( $like_count );

		return $count;
	}

	/**
	 * Frontend contents.
	 *
	 * @param int $post_id Post ID.
	 */
	public function likes_button( $post_id ) {

		$svg          = forte_get_svg( array( 'icon' => 'heart' ) );
		$allowed_html = forte_svg_allowed_html();
		$class        = '';

		if ( $this->already_liked( $post_id ) ) {
			$title = esc_attr( esc_html__( 'Unlike', 'forte' ) );
			$class = 'liked';
		} else {
			$title = esc_attr( esc_html__( 'Like', 'forte' ) );
		}

		echo '<div class="forte__likes forte__likes--' . esc_attr( $class ) . '">';
			echo '<a href="#" class="forte__likes-heart" data-post_id="' . esc_attr( $post_id ) . '" title="' . esc_attr( $title ) . '">' . wp_kses( $svg, $allowed_html ) . '</a>';
			echo '<span class="forte__likes-count">' . esc_html( $this->count( $post_id ) ) . '</span>';
		echo '</div>';
	}

	/**
	 * Output the likes to the theme via a do_action hook.
	 */
	public function theme_output() {
		return $this->likes_button( get_the_ID() );
	}
}

return new Portfolio_Professional_Likes();
