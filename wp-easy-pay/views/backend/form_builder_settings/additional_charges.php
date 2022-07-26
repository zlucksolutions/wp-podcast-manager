<?php
$fees_data = get_post_meta( get_the_ID(), 'fees_data' );
$signup_check = get_post_meta( get_the_ID(), 'wpep_enable_signup_fees', true );
$signup_amount = get_post_meta( get_the_ID(), 'wpep_signup_fees_amount', true );
$signup_label = get_post_meta( get_the_ID(), 'wpep_signup_fees_label', true );
?>
<main>
	<div id="formPage">
		<div class="testPayment">
			<h3 class=""> Additional Charges </h3>

			<div class="wpeasyPay__body">

			<div id="wpep_additional_charges" class="form-group">
			
					<?php


					if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {

						foreach ( $fees_data[0]['name'] as $key => $fees ) {

							$fees_check  = isset( $fees_data[0]['check'][$key] ) ? $fees_data[0]['check'][$key] : 'no';
							$fees_name   = isset( $fees_data[0]['name'][$key] ) ? $fees_data[0]['name'][$key] : '';
							$charge_type = isset( $fees_data[0]['type'][$key] ) ? $fees_data[0]['type'][$key] : '';
							$fees_value  = isset( $fees_data[0]['value'][$key] ) ? $fees_data[0]['value'][$key] : '';

							?>
						<div class="multiInput">
						<div class="inputWrapperCus">
						<div class="cusblock1">

						<?php 

							if ( 'yes' === $fees_check ) {
								$checked = 'checked';
							} else {
								$checked = '';
							}

						?>
						<label class="fees_label">
							<input type="checkbox" class="wpep-fee-checker" value="yes" <?php echo $checked; ?>  >
							<input type="hidden" class="hdnFeeChk"  name="wpep_service_fees_check[]" value="<?php echo esc_attr($fees_check); ?>"  >
						</label>
						
						<input type="text" name="wpep_service_fees_name[]" value="<?php echo $fees_name; ?>" placeholder="Service Name" class="form-control tamountfield">

						<select name="wpep_service_charge_type[]">
							<option value="percentage" 
							<?php
							if ( 'percentage' == $charge_type ) {
								echo 'selected'; }
							?>
							> Percentage </option>
							<option value="static_price" 
							<?php
							if ( 'static_price' == $charge_type ) {
								echo 'selected'; }
							?>
							> Static Price </option>
						</select>
					
						<input type="text" name="wpep_fees_value[]" value="<?php echo $fees_value; ?>" placeholder="Value" class="form-control tqtufield">
						</div>
						<input type="button" class="btnplus add_new_additional_fees_field" value="">
						<?php if ( 0 != $key ) { ?>
							<input type="button" class="btnminus remove_additional_fees_field" value="">
						<?php } ?>
		
						</div>
						</div>
					<?php
						}
					} else {
						?>

						<div class="multiInput">
						<div class="inputWrapperCus">
						<div class="cusblock1">

						<label class="fees_label">
							<input type="checkbox" class="wpep-fee-checker" value="yes" >
							<input type="hidden" class="hdnFeeChk"  name="wpep_service_fees_check[]" value="no"  >
						</label>

						<input type="text" name="wpep_service_fees_name[]" value="" placeholder="Service Name" class="form-control tamountfield">

						<select name="wpep_service_charge_type[]">
							<option value="percentage" > Percentage </option>
							<option value="static_price"> Static Price </option>
						</select>
					
						<input type="text" name="wpep_fees_value[]" value="" placeholder="Value" class="form-control tqtufield">
						</div>
						<input type="button" class="btnplus add_new_additional_fees_field" value="">
						<!-- <input type="button" class="btnminus remove_additional_fees_field" value=""> -->
		

						</div>
						</div>

						<?php
					}

					?>
			</div>

			<div class="wpeasyPay__body">

				<div id="wpep_signup_charges" style="display: none;" class="form-group">
					<h3 style="margin-bottom: 30px;"> Signup Fees </h3>
					<div class="multiInput">
						<div class="inputWrapperCus">
						<div class="cusblock1">
						<?php 

							if ( 'yes' === $signup_check ) {
								$checked = 'checked';
							} else {
								$checked = '';
							}

						?>
						<label class="signup_fees_label">
							<input type="checkbox" value="yes" name="wpep_enable_signup_fees" <?php echo $checked; ?>>
						</label>

						<input type="text" name="wpep_signup_fees_label" value="<?php echo $signup_label; ?>" placeholder="Label" class="form-control tamountfield">
						<input type="text" name="wpep_signup_fees_amount" value="<?php echo $signup_amount; ?>" placeholder="Amount" class="form-control tamountfield">
						</div>
						</div>
					</div>
				</div>
				</div>
			</div>
	</div>
</main>
