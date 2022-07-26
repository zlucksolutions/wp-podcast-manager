<?php


function wpep_square_oauth_admin_notice() {
	$wpep_live_token_upgraded = get_option( 'wpep_live_token_upgraded', false );
	if ( ! $wpep_live_token_upgraded ) {
		?>

	<div class="notice notice-success is-dismissible">
		<p><?php _e( 'Seems like you have not connected your Square account yet. <a href="edit.php?page=wpep-settings&amp;post_type=wp_easy_pay&amp;wpep_admin_url=edit.php&amp;wpep_post_type=wp_easy_pay&amp;wpep_prepare_connection_call=1&amp;wpep_page_post=global" class="btn btn-primary btn-square"> Connect Square </a>', 'wp-easy-pay' ); ?></p>
	</div>

		<?php
	}

}

add_action( 'admin_notices', 'wpep_square_oauth_admin_notice' );
