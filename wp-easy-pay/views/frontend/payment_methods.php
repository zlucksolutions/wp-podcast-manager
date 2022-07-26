<?php
	$wpep_square_google_pay_individual = get_post_meta( $wpep_current_form_id, 'wpep_square_google_pay', true );

	$wpep_square_customer_cof          = get_user_meta( get_current_user_id(), 'wpep_square_customer_cof', true );
	$wpep_save_card                    = get_post_meta( $wpep_current_form_id, 'wpep_save_card', true );
	$enableQuantity                    = get_post_meta( $wpep_current_form_id, 'enableCoupon', true );

	$wpep_individual_form_global       = get_post_meta( $wpep_current_form_id, 'wpep_individual_form_global', true );

	if ( $wpep_individual_form_global == 'on' ) {

		$liveMode = get_option( 'wpep_square_payment_mode_global', true );
	
		if ( $liveMode == 'on' ) {

			$gpay            = get_option( 'wpep_square_google_pay', true );
			$applepay	     = get_option( 'wpep_square_apple_pay', true );
			$masterpass		 = get_option( 'wpep_square_master_pass', true );

		} else {

			$gpay            = get_option( 'wpep_square_test_google_pay_global', true );
			$applepay	     = get_option( 'wpep_square_test_apple_pay', true );
			$masterpass		 = get_option( 'wpep_square_test_master_pass', true );

		}

	} else {

		$liveMode = get_post_meta( $wpep_current_form_id, 'wpep_payment_mode', true );

		if ( $liveMode == 'on' ) {

			$gpay 			= get_post_meta( $wpep_current_form_id, 'wpep_square_google_pay_live', true );
			$masterpass 	= get_post_meta( $wpep_current_form_id, 'wpep_square_master_pay_live', true );
			$applepay 		= get_post_meta( $wpep_current_form_id, 'wpep_square_apple_pay_live', true );

		} else {

			$gpay 			= get_post_meta( $wpep_current_form_id, 'wpep_square_google_pay', true );
			$masterpass 	= get_post_meta( $wpep_current_form_id, 'wpep_square_master_pay', true );
			$applepay 		= get_post_meta( $wpep_current_form_id, 'wpep_square_apple_pay', true );
		}

	}

?>

	<?php 
		if ( 'on' == $enableQuantity ) {
			//continue on Monday 8 feb 2021
			require WPEP_ROOT_PATH . 'views/frontend/coupons.php';
		}
	?>
	<div class="paymentsBlocks">
		<ul class="wpep_tabs">
			<li class="tab-link current" data-tab="creditCard">

				<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/creditcard.svg'; ?>" alt="Avatar" width="45"
					 class="doneorder" alt="Credit Card">
				<!-- <h4 class="">Credit Card</h4> -->
				<span>Payment Card</span>
			</li>
			<?php
			if ( $gpay == 'on' ) {
				?>
				<li class="tab-link" data-tab="googlePay">
					<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/googlepay.svg'; ?>" alt="Avatar" width="45"
						 class="doneorder" alt="Google Pay">
					<span>Google Pay</span>
				</li>
				<?php
			}
			?>

			<?php
			if ( $applepay == 'on' ) {
				?>
				<li class="tab-link" data-tab="applePay">
					<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/apple_pay.svg'; ?>" alt="Avatar" width="45"
						 class="doneorder" alt="Google Pay">
					<span>Apple Pay</span>
				</li>
				<?php
			}
			?>

			<?php
			if ( $masterpass == 'on' ) {
				?>
				<li class="tab-link" data-tab="masterPass">
					<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/masterpass.svg'; ?>" alt="Avatar" width="45"
						 class="doneorder" alt="Google Pay">
					<span>Master Pass</span>
				</li>
				<?php
			}
			?>
		</ul>

		<div id="creditCard" class="tab-content current">
			<div class="clearfix">
				<h3 style="display:none">Credit Card</h3>

				<div class="cardsBlock01">

					<div class="cardsBlock02">
						<div class="wizard-form-radio">
							<label for="newCard"><input type="radio" name="savecards" id="newCard" checked="checked"
														value="2"/>Add New Card</label>
						</div>

						<?php
						if ( isset( $wpep_square_customer_cof ) && ! empty( $wpep_square_customer_cof ) ) {
							?>
							<div class="wizard-form-radio">
								<label for="existingCard"><input type="radio" name="savecards" id="existingCard"
																 value="3"/>Use
									Existing Card</label>

							</div>
							<?php
						}
						?>
					</div>

					<div id="cardContan2" class="desc">
						<?php
						wpep_print_credit_card_fields( $wpep_current_form_id );

						if ( $wpep_save_card == 'on' ) {
							?>

							<div class="wizard-form-checkbox saveCarLater">
								<input name="savecardforlater" id="saveCardLater" type="checkbox" required="true">
								<label for="saveCardLater">Save card for later use</label>
							</div>

							<?php
						}
						?>
					</div>

					<div id="cardContan3" class="desc" style="display: none;">
						<div class="wpep_saved_cards">
							<?php require WPEP_ROOT_PATH . 'views/frontend/saved_cards.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="googlePay" class="tab-content ">
			<button id="sq-google-pay" class="button-google-pay"></button>
		</div>
		<div id="applePay" class="tab-content ">
			<div id="sq-apple-pay-label" class="wallet-not-enabled"></div>
		</div>
		<div id="masterPass" class="tab-content ">
			<button id="sq-src" class="button-src"></button>

		</div>
	</div>

<?php if ( $enableTermsCondition == 'on' && $termsLabel != '' && $termsLabel != 'no' && $termsLink != '' && $termsLink != 'no' ) { ?>
	<div class="termsCondition wpep-required form-group">
		<div class="wizard-form-checkbox">
			<input name="terms-condition-checkbox" id="termsCondition-<?php echo $wpep_current_form_id; ?>" type="checkbox"
				   required="true">
			<label for="termsCondition-<?php echo $wpep_current_form_id; ?>">I accept the</label> <a
				href="<?php echo $termsLink; ?>"><?php echo $termsLabel; ?></a>
		</div>
	</div>
<?php } else { ?>
	<div class="termsCondition wpep-required form-group" style="display:none">
		<div class="wizard-form-checkbox">
			<input name="terms-condition-checkbox" id="termsCondition-<?php echo $wpep_current_form_id; ?>" type="checkbox"
				   required="true" checked>
			<label for="termsCondition-<?php echo $wpep_current_form_id; ?>">I accept the</label> <a
				href="<?php echo $termsLink; ?>"><?php echo $termsLabel; ?></a>
		</div>
	</div>
<?php } ?>
