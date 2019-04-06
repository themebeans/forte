<?php
/**
 * The file for displaying the related posts loop below the post single.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

$related_items_count = 2;
$related             = bean_get_related_posts( $post->ID, 'category', array( 'posts_per_page' => $related_items_count ) );
$i                   = 1;

if ( $related->post_count != 0 ) { ?>

	<div class="posts-container related
	<?php
	if ( ! comments_open() && '0' == get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		echo 'zero-comments'; }
?>
">

		<?php
		while ( $related->have_posts() ) :
			$related->the_post();
?>

			<?php
			// USE FEATURED IMAGE OR BACKGROUND COLOR FOR LINK AND QUOTE
			$post_cover_color = get_post_meta( $post->ID, '_bean_post_cover_color', true );
			$feat_image       = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			if ( $feat_image == true ) {
				$style = 'background-image: url(' . $feat_image . ');';
			} else {
				$style = 'background-color: ' . $post_cover_color . '';
			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-grid sml' ); ?>>

				<div class="post-cover post-cover-<?php the_ID(); ?>" style='<?php echo esc_html( $style ); ?>'></div>

				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'forte' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="post-cover-link" style="background-color: <?php echo esc_html( $post_cover_color ); ?>;"></a>

				<div class="post-content">

					<header class="entry-header">

						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'forte' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2><!-- END .entry-title -->

					</header><!-- END .entry-header -->

				</div><!-- END .post-content -->

				<?php if ( get_theme_mod( 'show_author', true ) == true ) { ?>

					<div class="entry-author byline">

						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '75', '' ); ?></a>

						<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
													<?php
													_e( 'on ', 'forte' );
													the_time( get_option( 'date_format' ) );
?>
</span>

					</div><!-- END .byline -->

				<?php } ?>

			</article>

		<?php
		$i++;
endwhile;
		wp_reset_postdata();
?>

	</div><!-- END .related -->

<?php } ?>
