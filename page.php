<?php
/**
 *  The template for displaying all pages
 *
 *  This is the template that displays all pages by default.
 *  Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header();

$hero = get_post_meta( $post->ID, '_bean_hero', true );

if ( 'on' === $hero ) {
	get_template_part( 'content-page-hero' );
} else { ?>
	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
		<div class="entry-content-media fadein">
			<?php the_post_thumbnail( 'post-full' ); ?>
		</div>
	<?php } ?>
<?php } ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

		<div class="row fadein">

			<div <?php post_class( 'entry-content' ); ?>>

			<?php if ( 'off' === $hero ) { ?>

				<h1 class="entry-title"><?php echo esc_html( bean_page_title() ); ?></h1>

				<?php $post_subtitle = get_post_meta( $post->ID, '_bean_post_subtitle', true ); ?>

				<?php if ( $post_subtitle ) { ?>
					<div class="entry-excerpt">
						<h5><?php echo esc_html( $post_subtitle ); ?></h5>
					</div>
				<?php } ?>

			<?php } ?>

			<?php the_content(); ?>

			</div>

		</div>

		<?php comments_template( '', true ); ?>

	<?php
	endwhile;
endif;

get_footer();
