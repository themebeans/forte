<?php
/**
 * The template for displaying the default searchform whenever it is called in the theme.
 *
 * @package     Forte
 * @link        https://themebeans.com/themes/forte
 */

?>

<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
	<input type="text" name="s" id="s" value="<?php esc_html_e( 'Click to search...', 'forte' ); ?>" onfocus="if(this.value=='<?php esc_attr_e( 'Click to search...', 'forte' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_attr_e( 'Click to search...', 'forte' ); ?>';" />
</form>
