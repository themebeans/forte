<?php
/**
 * The content loop file for the team members grid.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

$role  = get_post_meta( $post->ID, '_bean_team_role', true );
$quote = get_post_meta( $post->ID, '_bean_team_quote', true );
$url   = get_post_meta( $post->ID, '_bean_team_url', true );

// Add a class if there's a quote.
$class = ( $quote ) ? ' quoted' : null;
?>

<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

	<li id="team-<?php the_ID(); ?>" class="team-member <?php esc_attr( $class ); ?>">

		<div class="team <?php esc_attr( $class ); ?>">

			<?php the_post_thumbnail( 'grid-feat' ); ?>

			<?php if ( $quote ) { ?>
				<div class="overlay">
					<blockquote><?php echo esc_html( $quote ); ?></blockquote>
				</div>
			<?php } ?>

		</div>

		<div class="team-content">

			<?php if ( $url ) { ?>
				<h6><a href="<?php echo esc_url( $url ); ?>"><?php the_title(); ?></a></h6>
			<?php } else { ?>
				<h6><?php the_title(); ?></h6>
			<?php } ?>

			<span class="team-role">
				<?php
				if ( $role ) {
					echo esc_html( $role );
				}
				?>
			</span>

			<?php the_content(); ?>

			<?php edit_post_link( __( '[Edit]', 'forte' ), '', '' ); ?>

		</div>

	</li>

<?php
}
