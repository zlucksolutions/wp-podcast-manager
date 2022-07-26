<?php

/**
 * WP EASY PAY
 *
 * PHP version 7
 *
 * @category Wordpress_Plugin
 * @package  WP_Easy_Pay
 * @author   Author <contact@apiexperts.io>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://wpeasypay.com/
 */

$wpep_test_app_id = get_post_meta( get_the_ID(), 'wpep_square_test_app_id', true );
$wpep_test_token  = get_post_meta( get_the_ID(), 'wpep_square_test_token', true );

$wpep_test_location_id   = get_post_meta( get_the_ID(), 'wpep_square_test_location_id', true );
$wpep_test_location_data = get_post_meta( get_the_ID(), 'wpep_test_location_data', true );

$wpep_live_token_upgraded = get_post_meta( get_the_ID(), 'wpep_live_token_upgraded', true );
$wpep_refresh_token       = get_post_meta( get_the_ID(), 'wpep_refresh_token', true );
$wpep_token_expires_at    = get_post_meta( get_the_ID(), 'wpep_token_expires_at', true );
$wpep_square_btn_auth     = get_post_meta( get_the_ID(), 'wpep_square_btn_auth', true );
$wpep_live_location_data  = get_post_meta( get_the_ID(), 'wpep_live_location_data', true );

$wpep_payment_mode           = get_post_meta( get_the_ID(), 'wpep_payment_mode', true );

$wpep_square_google_pay      = get_post_meta( get_the_ID(), 'wpep_square_google_pay', true );
$wpep_square_master_pay      = get_post_meta( get_the_ID(), 'wpep_square_master_pay', true );
$wpep_square_apple_pay       = get_post_meta( get_the_ID(), 'wpep_square_apple_pay', true );

$wpep_square_google_pay_live     = get_post_meta( get_the_ID(), 'wpep_square_google_pay_live', true );
$wpep_square_master_pay_live     = get_post_meta( get_the_ID(), 'wpep_square_master_pay_live', true );
$wpep_square_apple_pay_live      = get_post_meta( get_the_ID(), 'wpep_square_apple_pay_live', true );


$wpep_individual_form_global = get_post_meta( get_the_ID(), 'wpep_individual_form_global', true );
$wpep_square_location_id     = get_post_meta( get_the_ID(), 'wpep_square_location_id', true );
$wpep_disconnect_url         = get_post_meta( get_the_ID(), 'wpep_square_disconnect_url', true );
$wpep_square_connect_url     = wpep_create_connect_url( 'individual_form' );

// get test currency
$wpep_post_square_currency_test = get_post_meta( get_the_ID(), 'wpep_post_square_currency_test', true );

// get test currency
$wpep_post_square_currency_new = get_post_meta( get_the_ID(), 'wpep_post_square_currency_new', true );

$wpep_create_connect_sandbox_url = wpep_create_connect_sandbox_url( 'individual_form' );
?>
<form class="wpeasyPay-form">
	<main>
		<div class="globalSettings">
			<label for="chkGlobal">
				<input type="checkbox" name="wpep_individual_form_global" id="chkGlobal" 
				<?php

				if ( $wpep_individual_form_global == 'on' ) {

					echo 'checked';
				}

				?>
				>
				Use Global Settings
			</label>
		</div>
		<div id="globalSettings" style="display: none">
			<div class="globalSettingsa">
				<div class="globalSettingswrap">
					<h2>Global settings is active</h2>
					<?php $global_setting_url = admin_url( 'edit.php?post_type=wp_easy_pay&page=wpep-settings', 'https' ); ?>
					<a href="<?php echo $global_setting_url; ?>" class="btn btn-primary btnglobal">Go to Square Connect
						Settings</a>
				</div>
			</div>
		</div>
		<div id="normalSettings">
			<div class="swtichWrap">
				<input type="checkbox" id="on-off-single" name="wpep_payment_mode" class="switch-input"
					<?php
					if ( $wpep_payment_mode == 'on' ) {
						echo 'checked';
					}
					?>
				>
				<label for="on-off-single" class="switch-label">
					<span class="toggle--on toggle--option">Live Payment</span>
					<span class="toggle--off toggle--option">Test Payment</span>
				</label>
			</div>

			<div class="paymentView" id="wpep_spmst">
				<?php


				if ( $wpep_test_token == false ) {

					?>

					<div class="squareConnect">
						<div class="squareConnectwrap">
							<h2>Connect your square (Sandbox) account now!</h2>
							<?php 
							if ( isset( $_GET['type'] ) && 'bad_request.missing_parameter' == $_GET['type'] ) {
							?>

							<p style="color: red;"> You have denied WP EASY PAY the permission to access your Square account. Please connect again to and click allow to complete OAuth. </p>

							<?php
							}
							?>


							<a href="<?php echo $wpep_create_connect_sandbox_url; ?>" class="btn btn-primary btn-square">Connect
								Square (Sandbox)</a>
							<p><small> The sandbox OAuth is for testing purpose by connecting and activating this you will be able to make test transactions and to see how your form will work for the customers.  </small></p>

						</div>
					</div>

					<?php

				} else {
					?>

					<div class="squareConnected">
						<h3 class="titleSquare">Square is Connected <i class="fa fa-check-square" aria-hidden="true"></i></h3>
						<div class="wpeasyPay__body">

							<?php
							if ( '' != $wpep_post_square_currency_test ) {
								?>
								<div class="form-group">
									<label>Country Currency</label>
									<select class="form-control" disabled="disabled">
										<option
											value="USD" 
											<?php
											if ( ! empty( $wpep_post_square_currency_test ) && 'USD' == $wpep_post_square_currency_test ) :
												echo "selected='selected'";
endif;
											?>
											>
											USD
										</option>
										<option
											value="CAD" 
											<?php
											if ( ! empty( $wpep_post_square_currency_test ) && 'CAD' == $wpep_post_square_currency_test ) :
												echo "selected='selected'";
endif;
											?>
											 >
											CAD
										</option>
										<option
											value="AUD" 
											<?php
											if ( ! empty( $wpep_post_square_currency_test ) && 'AUD' == $wpep_post_square_currency_test ) :
												echo "selected='selected'";
endif;
											?>
											 >
											AUD
										</option>
										<option
											value="JPY" 
											<?php
											if ( ! empty( $wpep_post_square_currency_test ) && 'JPY' == $wpep_post_square_currency_test ) :
												echo "selected='selected'";
endif;
											?>
											 >
											JPY
										</option>
										<option
											value="GBP" 
											<?php
											if ( ! empty( $wpep_post_square_currency_test ) && 'GBP' == $wpep_post_square_currency_test ) :
												echo "selected='selected'";
											endif;
											?>
											 >
											GBP
										</option>
									</select>
								</div>
							<?php } ?>

							<?php $all_locations = $wpep_test_location_data; ?>
							<div class="form-group">
								<label>Location:</label>
								<select class="form-control" name="wpep_square_test_location_id">
									<option>Select Location</option>

									<?php
									foreach ( $all_locations as $location ) {
										$saved_location_id = $wpep_test_location_id;
										if ( $saved_location_id !== false ) {
											if ( $saved_location_id == $location['location_id'] ) {
												$selected = 'selected';
											} else {
												$selected = '';
											}
										}
										echo "<option value='" . $location['location_id'] . "' $selected>" . $location['location_name'] . '</option>';
									}
									?>

								</select>
							</div>
						</div>

						<div class="paymentint">
							<label class="title">Other Payment Options</label>
							<div class="wizard-form-checkbox">
								<input name="wpep_square_google_pay" id="googlePay"
									   type="checkbox" 
									   <?php
										if ( $wpep_square_google_pay == 'on' ) {
											echo 'checked';
										}
										?>
								<label for="googlePay">Google Pay</label>
							</div>
							<div class="wizard-form-checkbox ">
								<input name="wpep_square_master_pay" id="masterPay" type="checkbox"
									<?php
										if ( $wpep_square_master_pay == 'on' ) {
											echo 'checked';
										}
									?>
								>
								<label for="masterPay">Masterpass</label>
							</div>
							<div class="wizard-form-checkbox">
								<input name="wpep_square_apple_pay" id="applePay" type="checkbox"
									<?php
										if ( $wpep_square_apple_pay == 'on' ) {
											echo 'checked';
										}
									?>
								>
								<label for="applePay">Apple Pay</label>
							</div>
						</div>

		
						<div class="btnFooter d-btn">

							<a href="<?php echo $wpep_disconnect_url; ?>"
							   class="btn btnDiconnect">Disconnect
								Square</a>

						</div>

					</div>

					<?php
				}
				?>


</div>

<!-- test block end -->

<div class="livePayment paymentView" id="wpep_spmsl">
	<?php


	if ( $wpep_live_token_upgraded == false ) {

		?>

		<div class="squareConnect">
			<div class="squareConnectwrap">
				<h2>Connect your square account now!</h2>
				<?php 
				if ( isset( $_GET['type'] ) && 'bad_request.missing_parameter' == $_GET['type'] ) {
				?>

				<p style="color: red;"> You have denied WP EASY PAY the permission to access your Square account. Please connect again to and click allow to complete OAuth. </p>

				<?php
				}
				?>
				<a href="<?php echo $wpep_square_connect_url; ?>" class="btn btn-primary btn-square">Connect
					Square</a>
				<a class="connectSquarePop" href="https://wpeasypay.com/documentation/#global-settings-live-mode"
				   target="_blank">

					How to Connect Your Live Square Account.

				</a>

			</div>
		</div>

		<?php

	} else {
		?>

		<div class="squareConnected">
			<h3 class="titleSquare">Square is Connected <i class="fa fa-check-square" aria-hidden="true"></i></h3>
			<div class="wpeasyPay__body">

				<?php
				if ( '' != $wpep_post_square_currency_new ) {
					?>
					<div class="form-group">
						<label>Country Currency</label>
						<select name="wpep_post_square_currency_new" class="form-control" disabled="disabled">
							<option
								value="USD" 
								<?php
								if ( ! empty( $wpep_post_square_currency_new ) && 'USD' == $wpep_post_square_currency_new ) :
									echo "selected='selected'";
endif;
								?>
								>
								USD
							</option>
							<option
								value="CAD" 
								<?php
								if ( ! empty( $wpep_post_square_currency_new ) && 'CAD' == $wpep_post_square_currency_new ) :
									echo "selected='selected'";
endif;
								?>
								 >
								CAD
							</option>
							<option
								value="AUD" 
								<?php
								if ( ! empty( $wpep_post_square_currency_new ) && 'AUD' == $wpep_post_square_currency_new ) :
									echo "selected='selected'";
endif;
								?>
								 >
								AUD
							</option>
							<option
								value="JPY" 
								<?php
								if ( ! empty( $wpep_post_square_currency_new ) && 'JPY' == $wpep_post_square_currency_new ) :
									echo "selected='selected'";
endif;
								?>
								 >
								JPY
							</option>
							<option
								value="GBP" 
								<?php
								if ( ! empty( $wpep_post_square_currency_new ) && 'GBP' == $wpep_post_square_currency_new ) :
									echo "selected='selected'";
endif;
								?>
								 >
								GBP
							</option>
						</select>
					</div>
				<?php } ?>

				<?php $all_locations = $wpep_live_location_data; ?>
				<div class="form-group">
					<label>Location:</label>
					<select class="form-control" name="wpep_square_location_id">
						<option>Select Location</option>

						<?php
						foreach ( $all_locations as $location ) {
							$saved_location_id = $wpep_square_location_id;
							if ( $saved_location_id !== false ) {

								if ( $saved_location_id == $location['location_id'] ) {

									$selected = 'selected';

								} else {

									$selected = '';
								}
							}
							echo "<option value='" . $location['location_id'] . "' $selected>" . $location['location_name'] . '</option>';
						}
						?>

					</select>
				</div>
			</div>

			<div class="paymentint">
				<label class="title">Other Payment Options</label>
				<div class="wizard-form-checkbox">
					<input name="wpep_square_google_pay_live" id="googlePay"
						   type="checkbox" 
						   <?php
							if ( $wpep_square_google_pay_live == 'on' ) {
								echo 'checked';
							}
							?>
					<label for="googlePay">Google Pay</label>
				</div>
				<div class="wizard-form-checkbox ">
					<input name="wpep_square_master_pay_live" id="masterPay" type="checkbox" 
					<?php
							if ( $wpep_square_master_pay_live == 'on' ) {
								echo 'checked';
							}
							?>>
					<label for="masterPay">Masterpass</label>
				</div>
				<div class="wizard-form-checkbox">
					<input name="wpep_square_apple_pay_live" id="applePay" type="checkbox" <?php
							if ( $wpep_square_apple_pay_live == 'on' ) {
								echo 'checked';
							}
							?>>
					<label for="applePay">Apple Pay</label>
				</div>
			</div>

			<div class="btnFooter d-btn">
				<a href="<?php echo $wpep_disconnect_url; ?>"
				   class="btn btnDiconnect">Disconnect
					Square</a>
			</div>

		</div>

		<?php
	}
	?>
</div>
<!-- live block end -->
</div>

</form>
</main>
