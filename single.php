<?php
/**
 * The template for displaying all single posts.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header();

$format = get_post_format();

if ( false === $format ) {
	$format = 'standard';
}

$post_subtitle              = get_post_meta( $post->ID, '_bean_post_subtitle', true );
$post_cover_color           = get_post_meta( $post->ID, '_bean_post_cover_color', true );
$link                       = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title                 = get_post_meta( $post->ID, '_bean_link_title', true );
$quote                      = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source               = get_post_meta( $post->ID, '_bean_quote_source', true );
$oembed                     = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_background_upload    = get_post_meta( $post->ID, '_bean_video_background_upload', true );
$embedded_background_upload = get_post_meta( $post->ID, '_bean_embedded_background_upload', true );
$social_feat_image          = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$twitter_profile            = get_theme_mod( 'twitter_profile' );
$terms                      = get_the_terms( $post->ID, 'category' );
$feat_image                 = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$style                      = ( $feat_image ) ? 'background-image: url(' . $feat_image . ');' : 'background-color: ' . $post_cover_color;

if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'row post-grid head fadein' ); ?>>

			<?php if ( $video_background_upload ) { ?>

				<video class="background-video" autoplay="" loop="" muted="">
					<source src="<?php echo esc_html( $video_background_upload ); ?>" type="video/mp4">
				</video>

			<?php } elseif ( $embedded_background_upload ) { ?>

				<div class="background-video embedded">
					<?php echo stripslashes( htmlspecialchars_decode( $embedded_background_upload ) ); ?>
				</div>

			<?php
} else {
}
			?>

		<div class="post-cover post-cover-<?php the_ID(); ?>" style="<?php echo esc_html( $style ); ?>"></div>

		<div class="post-cover-link" data-0="opacity:.4;" data-50="opacity:.75;" style="background-color: <?php echo esc_html( $post_cover_color ); ?>;"></div>

		<div class="post-content">

			<header class="entry-header">

				<?php if ( 'quote' === $format ) { ?>

					<blockquote><?php echo stripslashes( esc_html( $quote ) ); ?></blockquote>

				<?php } elseif ( 'link' === $format ) { ?>

					<a target="blank" href="<?php echo esc_url( $link ); ?>">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</a>

				<?php } else { ?>

					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1><!-- END .entry-title -->

				<?php } ?>

			</header><!-- END .entry-header -->

			<?php if ( 'quote' === $format ) { ?>

				<div class="entry-excerpt">
					<h5><?php echo stripslashes( esc_html( $quote_source ) ); ?></h5>
				</div><!-- END .entry-excerpt -->

			<?php } elseif ( 'link' === $format ) { ?>

				<div class="entry-excerpt">
					<a target="blank" href="<?php echo esc_url( $link ); ?>">
						<h5>
							<?php
							if ( $link_title ) {
								echo stripslashes( esc_html( $link_title ) );
							} else {
								echo stripslashes( esc_html( $link ) );
							};
							?>
						</h5>
					</a>
				</div><!-- END .entry-excerpt -->

			<?php
} else {
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
											echo the_time( 'M j, Y' );
?>
</span>

			</div><!-- END .byline -->

		<?php } ?>

			<div class="down-arrow" data-0="opacity:1;" data-50="opacity:0;"></div>

			<ul class="entry-meta" data-0="opacity:0;" data-50="opacity:1;">

				<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
					<li><?php the_terms( $post->ID, 'category', '', ', ', '' ); ?></li>
				<?php endif; ?>

				<?php if ( has_tag() ) { ?>
						<li><?php echo the_tags( '', ',', '' ); ?></li>
				<?php } ?>

				<?php if ( true === get_theme_mod( 'post_likes', true ) ) { ?>
					<li><?php do_action( 'forte_likes' ); ?></li>
				<?php } ?>

			</ul>

		</article>

		<div class="row fadein">

			<div <?php post_class( 'entry-content' ); ?>>

				<?php
				if ( has_post_format( 'video' ) && $oembed ) {

					$output = sprintf( '<div class="entry-video video-frame">%1$s</div>', wp_oembed_get( esc_url( $oembed ) ) );

					$allowed_html = array(
						'div'    => array(
							'class' => array(),
						),
						'iframe' => array(
							'class'       => array(),
							'style'       => array(),
							'height'      => array(),
							'width'       => array(),
							'src'         => array(),
							'frameborder' => array(),
						),
					);

					echo wp_kses( $output, $allowed_html );
				}
				?>

				<?php
				if ( 'audio' === $format ) {
					bean_audio( $post->ID ); }
?>

				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . __( 'Pages:', 'forte' ) . '</span>',
						'after'  => '</div>',
					)
				);
?>

				<?php get_template_part( 'content', 'mc4wp' ); ?>

			</div><!-- END .entry-content -->

		</div><!-- END .row -->

		<div class="entry-navigation">
			<div class="social mobile-show">
				<a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php get_the_permalink(); ?>
																			<?php
																			if ( $twitter_profile != '' ) {
																				echo 'via @' . $twitter_profile . ''; }
?>
" target="_blank" class="twitter"></a>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="facebook even"></a>
				<a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo esc_attr( $social_feat_image ); ?>&url=<?php the_permalink(); ?>&is_video=false&description=<?php the_title(); ?>" class="pinterest"></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php echo esc_url( home_url( '/' ) ); ?>" class="linkedin" target="blank"></a>
			</div>
			<div class="previous"><?php previous_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>
			<div class="social">
				<a href="http://twitter.com/share?text=<?php the_title(); ?> <?php
				if ( $twitter_profile != '' ) {
					echo esc_attr( 'via @' . $twitter_profile . '' ); }
?>
" target="_blank" class="twitter"></a>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="facebook even"></a>
				<a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo esc_attr( $social_feat_image ); ?>&url=<?php the_permalink(); ?>&is_video=false&description=<?php the_title(); ?>" class="pinterest"></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php echo esc_url( home_url( '/' ) ); ?>" class="linkedin" target="blank"></a>
			</div>
			<div class="next"><?php next_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>
		</div><!-- END .entry-navigation -->

		<?php
		comments_template( '', true );

		// RELATED POSTS
		if ( get_theme_mod( 'show_related_posts', true ) == true ) {
			$terms = get_the_terms( $post->ID, 'category' );
			if ( $terms && ! is_wp_error( $terms ) ) :
				get_template_part( 'content', 'post-related' );
			endif;
		}

endwhile;
endif;

get_footer();
