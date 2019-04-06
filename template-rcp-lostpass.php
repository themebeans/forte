<?php
/**
 * Template Name: RCP Lost Password
 * The template for displaying the lost password page template.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

get_header( 'min' ); ?>

<?php
global $user_ID, $user_identity;
get_currentuserinfo();
?>

<?php if ( ! is_user_logged_in() ) { ?>

	<div class="row min-wrap rcp-form fadein">

		<form method="post" action="<?php echo site_url( 'wp-login.php?action=lostpassword', 'login_post' ); ?>" class="wp-user-form" id="bean-help">
			<div class="username">
				<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
			</div><!-- END .username -->
			<div class="reset-pass-fields">
				<?php do_action( 'login_form', 'resetpass' ); ?>
				<input type="submit" name="user-submit" value="<?php _e( 'Reset My Password' ); ?>" class="btn user-submit" tabindex="1002" />
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
				<input type="hidden" name="user-cookie" value="1" />
			</div><!-- END .reset-pass-fields -->
		</form>

		<p class="rcp_text">
			<a href="javascript:javascript:history.go(-1)"><?php _e( 'Nevermind, I remember now', 'forte' ); ?></a>
		</p>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.username input[type="text"]').attr('placeholder', '<?php _e( 'Email Address', 'forte' ); ?>');
			});
		</script>

	</div><!-- END .row.min-wrap.rcp-form -->

<?php } else { // END !is_user_logged_in ?>

	<div class="row min-wrap">
		<p class="rcp_text logged-in">
			 <a href="javascript:javascript:history.go(-1)"><?php _e( 'You are already logged in. Go back &rarr;', 'forte' ); ?></a>
		</p>
	</div><!-- END .row.min-wrap -->

<?php } ?>

<?php
get_footer( 'min' );
