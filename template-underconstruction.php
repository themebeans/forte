<?php
/**
 * Template Name: Under Construction
 * The template for displaying the under construction page template.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header();
?>

<div class="construction-banner"></div>

<div class="entry-content">

	<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>

</div>

<div class="construction-banner btm"></div>

<?php
get_footer();
