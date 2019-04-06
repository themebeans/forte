<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header(); ?>

<div id="posts-container" class="posts-container">

	<?php
	// GET THE COUNT.
	$i = 1;

	// QUERY.
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			// LRG VS SML LAYOUTS.
			$thumbnail = (
			$i == 1 ||
			$i == 4 ||
			$i == 7 ||
			$i == 10 ||
			$i == 13 ||
			$i == 16 ||
			$i == 19 ||
			$i == 22 ||
			$i == 25 ||
			$i == 28 ||
			$i == 31 ||
			$i == 34 ) ? 'post-grid lrg fadein' : 'post-grid sml fadein';

					$post_subtitle    = get_post_meta( $post->ID, '_bean_post_subtitle', true );
					$post_cover_color = get_post_meta( $post->ID, '_bean_post_cover_color', true );

					// USE FEATURED IMAGE OR BACKGROUND COLOR FOR LINK AND QUOTE
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			if ( $feat_image == true ) {
				$style = 'background-image: url(' . $feat_image . ');';
			} else {
				$style = 'background-color: ' . $post_cover_color . '';
			}
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( $thumbnail ); ?>>

			<div class="post-cover post-cover-<?php the_ID(); ?>" style='<?php echo esc_html( $style ); ?>'></div>

			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'forte' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="post-cover-link" style="background-color: <?php echo esc_html( $post_cover_color ); ?>;"></a>

			<div class="post-content">

				<header class="entry-header">

					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'forte' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2><!-- END .entry-title -->

				</header><!-- END .entry-header -->

				<?php
				if ( $thumbnail == 'post-grid lrg fadein' ) {
					if ( $post_subtitle ) {
					?>
						<div class="entry-excerpt">
							<h5><?php echo esc_html( $post_subtitle ); ?></h5>
						</div><!-- END .entry-excerpt -->
					<?php
					}
				}
				?>

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
endif;
?>

</div><!-- END .posts-container -->

<?php if ( get_theme_mod( 'infinitescroll', true ) == true ) { ?>

	<div id="page-nav">
		<?php next_posts_link(); ?>
	</div><!-- END #page-nav -->

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.posts-container').infinitescroll({
				navSelector  : '#page-nav',
				nextSelector : '#page-nav a',
				itemSelector : 'article',
				loading: {
					msgText: '',
					finishedMsg: '',
					img: '<?php echo get_template_directory_uri(); ?>/assets/images/loading.gif',
			}
			});
		});
	</script>

<?php
} else {
	// IF NOT USING INFINITE SCROLLING
	echo bean_index_pagination();
}

get_footer();
