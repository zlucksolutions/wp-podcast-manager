<?php

if ( isset( $_POST['recaptcha_site_key'] ) || isset( $_POST['recaptcha_secret_key'] ) || isset( $_POST['mailchimp_api_key'] ) || isset( $_POST['mailchimp_server'] ) ) {



	if ( isset( $_POST['recaptcha_site_key'] ) ) {
		update_option( 'wpep_recaptcha_site_key', $_POST['recaptcha_site_key'] );
	}


	if ( isset( $_POST['recaptcha_secret_key'] ) ) {
		update_option( 'wpep_recaptcha_secret_key', $_POST['recaptcha_secret_key'] );
	}


	if ( isset( $_POST['enable_recaptcha'] ) ) {
		update_option( 'wpep_enable_recaptcha', $_POST['enable_recaptcha'] );
	}

	if ( isset( $_POST['recaptcha_site_key'] ) && isset( $_POST['recaptcha_secret_key'] ) && ! isset( $_POST['enable_recaptcha'] ) ) {
		update_option( 'wpep_enable_recaptcha', '' );
	}	

	if ( isset( $_POST['mailchimp_api_key'] ) && isset( $_POST['mailchimp_server'] ) && ! isset( $_POST['wpep_enable_mailchimp'] ) ) {
		update_option( 'wpep_enable_mailchimp', '' );
	}	


	if ( isset( $_POST['enable_mailchimp'] ) ) {
		update_option( 'wpep_enable_mailchimp', $_POST['enable_mailchimp'] );
	}

	if ( isset( $_POST['mailchimp_api_key'] ) ) {
		update_option( 'wpep_mailchimp_api_key', $_POST['mailchimp_api_key'] );
	}


	if ( isset( $_POST['mailchimp_server'] ) ) {
		update_option( 'wpep_mailchimp_server', $_POST['mailchimp_server'] );
	}

	
}


$enabled = get_option( 'wpep_enable_recaptcha', false );
$enabled_mailchimp = get_option( 'wpep_enable_mailchimp', false );
?>
<div class="integrations">

<h1 class="wp-heading-inline">Integrations</h1>

<div class="integrations_tab">
  <button class="tablinks active" onclick="open_integration_form(event, 'ReCaptcha')">ReCaptcha</button>
  <button class="tablinks" onclick="open_integration_form(event, 'MailChimp')">MailChimp</button>
</div>


<div id="ReCaptcha" class="integration_tab_content">
	<form class="wpeasyPay-form" method="post" action="#">
		<div class="contentWrap wpeasyPay">
			<div class="contentBlock">
				<div class="form-group">
					<label for="">Site Key
						<div class="help-tip">
							<span> for more info visit documentation: <a target="_blank" href="https://developers.google.com/recaptcha/docs/v3">click here</a></span>
						</div>
					</label>

				<input class="form-control" type="text" name="recaptcha_site_key" value="<?php echo get_option( 'wpep_recaptcha_site_key' ); ?>" placeholder="Site Key"/>
				</div>
				<div class="form-group">
					<label for="">Site Secret 
						<div class="help-tip">
							<span> for more info visit documentation: <a target="_blank" href="https://developers.google.com/recaptcha/docs/v3">click here</a></span>
						</div>
					</label>
				<input class="form-control" type="text" name="recaptcha_secret_key" value="<?php echo get_option( 'wpep_recaptcha_secret_key' ); ?>" placeholder="Site Secret"/>
				</div>


				<div class="form-group">
					<input type="checkbox" name="enable_recaptcha" value="on" 
					<?php
					if ( ! empty( $enabled ) && false !== $enabled && 'on' == $enabled ) {
						echo 'checked'; }
					?>
					/>
					<label for="">Enable reCaptcha</label>
				</div>
				<div class="btnWrap">
				<button type="submit" class="btn btn-primary"> Save Keys </button>
				</div>
			</div>
		</div>
	</form>
</div>

<div id="MailChimp" class="integration_tab_content" style="display: none;">
	<form class="wpeasyPay-form" method="post" action="#">
		<div class="contentWrap wpeasyPay">
			<div class="contentBlock">
				<div class="form-group">
					<label for="">API Key
						<div class="help-tip">
							<span> for more info visit documentation: <a target="_blank" href="https://developers.google.com/recaptcha/docs/v3">click here</a></span>
						</div>
					</label>

				<input class="form-control" type="text" name="mailchimp_api_key" value="<?php echo get_option( 'wpep_mailchimp_api_key' ); ?>" placeholder="API Key"/>
				</div>
				<div class="form-group">
					<label for="">Server
						<div class="help-tip">
							<span> for more info visit documentation: <a target="_blank" href="https://developers.google.com/recaptcha/docs/v3">click here</a></span>
						</div>
					</label>
				<input class="form-control" type="text" name="mailchimp_server" value="<?php echo get_option( 'wpep_mailchimp_server' ); ?>" placeholder="Server"/>
				</div>


				<div class="form-group">
					<input type="checkbox" name="enable_mailchimp" value="on" 
					<?php
					if ( ! empty( $enabled_mailchimp ) && false !== $enabled_mailchimp && 'on' == $enabled_mailchimp ) {
						echo 'checked'; }
					?>
					/>
					<label for="">Enable MailChimp</label>
				</div>
				<div class="btnWrap">
				<button type="submit" class="btn btn-primary"> Save Keys </button>
				</div>
			</div>
		</div>
	</form>
</div>

</div>
