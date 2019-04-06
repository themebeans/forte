<?php
/**
 * Template Name: RCP Template
 * The template for displaying the Restrict Content Pro page templates.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header( 'min' ); ?>

<?php if ( ! is_user_logged_in() ) { ?>

	<div class="row min-wrap rcp-form fadein">

		<div class="content">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
endwhile; // THE LOOP
?>
		</div><!-- END .content -->

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#rcp_user_login_wrap input[type="text"]').attr('placeholder', '<?php _e( 'Username', 'forte' ); ?>');
				$('#rcp_user_email_wrap input[type="text"]').attr('placeholder', '<?php _e( 'Email Address', 'forte' ); ?>');
				$('#rcp_password_wrap input[type="password"]').attr('placeholder', '<?php _e( 'Password', 'forte' ); ?>');
				$('#rcp_password_again_wrap input[type="password"]').attr('placeholder', '<?php _e( 'Confirm Password', 'forte' ); ?>');
			});
		</script>

	</div><!-- END .row.min-wrap -->

<?php } else { // END !is_user_logged_in ?>

	<div class="row min-wrap">
		<p class="rcp_text logged-in">
			 <a href="javascript:javascript:history.go(-1)"><?php _e( 'You are already logged in. Go back &rarr;', 'forte' ); ?></a>
		</p>
	</div><!-- END .row.min-wrap -->

<?php } ?>

<?php
get_footer( 'min' );
