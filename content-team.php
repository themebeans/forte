<?php
/**
 * The content for the displaying on both the team template & the team shortcode.
 * The shortcode ouput is [team]
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

?>

<ul id="team-members" class="team-members">

	<?php
	// LOAD TEAM MEMBER QUERY
	$args = array(
		'post_type'      => 'team',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'posts_per_page' => '-1',
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			get_template_part( 'loop-team' );
	endwhile;
endif;

	wp_reset_postdata();
	?>

</ul><!-- END .team-members -->

<script type="text/javascript">
	jQuery(document).ready(function($) {
		//MASONRY
		var container = document.querySelector('#team-members');
		 var msnry;
		 imagesLoaded( container, function() {
			msnry = new Masonry( container, {
				itemSelector: '.team-member',
				layoutMode: 'fitRows'
			});
		 });
	});
</script>
