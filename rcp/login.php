<?php global $rcp_login_form_args; ?>

<?php if ( ! is_user_logged_in() ) : ?>

	<?php rcp_show_error_messages( 'login' ); ?>

	<form id="rcp_login_form"  class="rcp_form" method="POST" action="<?php echo esc_url( rcp_get_current_url() ); ?>">

		<fieldset class="rcp_login_data">
			<p>
				<label for="rcp_user_Login"><?php _e( 'Username', 'forte' ); ?></label>
				<input name="rcp_user_login" id="rcp_user_login" class="required" type="text"/>
			</p>
			<p>
				<label for="rcp_user_pass"><?php _e( 'Password', 'forte' ); ?></label>
				<input name="rcp_user_pass" id="rcp_user_pass" class="required" type="password"/>
			</p>

			<input type="checkbox" name="rcp_user_remember" id="rcp_user_remember" value="1" checked/>

			<p>
				<input type="hidden" name="rcp_action" value="login"/>
				<input type="hidden" name="rcp_redirect" value="<?php echo esc_url( $rcp_login_form_args['redirect'] ); ?>"/>
				<input type="hidden" name="rcp_login_nonce" value="<?php echo wp_create_nonce( 'rcp-login-nonce' ); ?>"/>
				<input id="rcp_login_submit" type="submit" class="btn" value="Login"/>
			</p>

			<p class="rcp_text">
				<?php if ( get_theme_mod( 'register_page_selector' ) ) { ?>
					<a href="<?php echo get_page_link( get_theme_mod( 'register_page_selector' ) ); ?>"><?php _e( 'Don&#39t have an account? Subscribe now &rarr;', 'forte' ); ?></a><br/>
				<?php } ?>

				<?php if ( get_theme_mod( 'lostpass_page_selector' ) ) { ?>
					<a href="<?php echo get_page_link( get_theme_mod( 'lostpass_page_selector' ) ); ?>"><?php _e( 'Lost your password?', 'forte' ); ?></a><br/>
				<?php } ?>
			</p>

		</fieldset>

	</form>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('input#rcp_user_login').attr('placeholder', '<?php _e( 'Username', 'forte' ); ?>');
			$('input#rcp_user_pass').attr('placeholder', '<?php _e( 'Password', 'forte' ); ?>');
		});
	</script>

<?php else : ?>

	<div class="rcp_text logged-in">
		   <p><a href="javascript:javascript:history.go(-1)"><?php _e( 'Oh yea, I&#39;m already logged in. Take me back &rarr;', 'forte' ); ?></a></p>
	</div>

<?php endif; ?>
