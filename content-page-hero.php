<?php
//PAGE META
$post_subtitle = get_post_meta($post->ID, '_bean_post_subtitle', true);
$post_cover_color = get_post_meta($post->ID, '_bean_post_cover_color', true);
$video_background_upload = get_post_meta($post->ID, '_bean_video_background_upload', true);
$embedded_background_upload = get_post_meta($post->ID, '_bean_embedded_background_upload', true);

// USE FEATURED IMAGE OR BACKGROUND COLOR FOR LINK AND QUOTE
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
if ( $feat_image == true ) {
	$style = 'background-image: url(' . $feat_image . ');';
} else {
	$style = 'background-color: '.$post_cover_color.'';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row post-grid head fadein'); ?>>

	<?php if( $video_background_upload ) { ?>
	
		<video class="background-video" autoplay="" loop="" muted="">
			<source src="<?php echo esc_html( $video_background_upload ); ?>" type="video/mp4">
		</video>
	
	<?php } elseif ($embedded_background_upload) { ?>
	
		<div class="background-video embedded">
			<?php echo stripslashes(htmlspecialchars_decode($embedded_background_upload)); ?>
		</div>
	
	<?php } else { } ?>

	<div class="post-cover post-cover-<?php the_ID(); ?>" style="<?php echo esc_html( $style ); ?>"></div>

	<div class="post-cover-link" data-0="opacity:.4;" data-50="opacity:.75;" style="background-color: <?php echo esc_html( $post_cover_color ); ?>;"></div>

	<div class="post-content">

		<header class="entry-header">

			<h1 class="entry-title">
				<?php the_title(); ?>				
			</h1><!-- END .entry-title -->

		</header><!-- END .entry-header -->

		<?php if ( $post_subtitle ) { ?>
			<div class="entry-excerpt">
				<h5><?php echo esc_html( $post_subtitle ); ?></h5>
			</div><!-- END .entry-excerpt -->
		<?php } ?>

	</div><!-- END .post-content -->

	<div class="down-arrow" data-0="opacity:1;" data-50="opacity:0;"></div>

</article><!-- END #post-<?php the_ID(); ?> -->