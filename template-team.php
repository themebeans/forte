<?php
/**
 * Template Name: Team Members
 * The template for displaying the team template.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header();

$hero        = get_post_meta( $post->ID, '_bean_hero', true );
$hero_header = false;

if ( 'on' === $hero ) {
	get_template_part( 'content-page-hero' );
	$hero_header = true;
} else { ?>
	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
		<?php $hero_header = true; ?>
		<div class="entry-content-media fadein">
			<?php the_post_thumbnail( 'post-full' ); ?>
		</div><!-- END .entry-content-media -->
	<?php } ?>
<?php } ?>

<div class="row bean-team fadein
	<?php
	if ( true === $hero_header ) {
		echo 'hero'; }
	?>
	">
</div>

<?php
get_footer();
