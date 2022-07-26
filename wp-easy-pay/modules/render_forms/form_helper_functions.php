<?php

function wpep_print_checkbox_group( $checkbox_group ) {

	$ifRequired = " <span class='fieldReq'>*</span>";
	echo "<label data-label-show='" . $checkbox_group->hideLabel . "'>"; 
	echo __( $checkbox_group->label, 'wp_easy_pay' );
	echo "" . ( ( isset( $checkbox_group->required ) ) ? $ifRequired : '' ) . "</label>";
	echo "<div class='wpep-checkboxWrapper'>";
	foreach ( $checkbox_group->values as $value ) {
		echo "<div class='wizard-form-checkbox " . ( ( isset( $checkbox_group->required ) ) ? 'wpep-required' : '' ) . "'><div class='form-group wpep-m-0'><input type='checkbox' name='" . $checkbox_group->name . "' data-label='" . $value->label . "' data-main-label='" . $checkbox_group->label . "'  id='radio_id_" . $value->value . "' value='" . $value->value . "' required='" . ( ( isset( $checkbox_group->required ) ) ? 'true' : 'false' ) . "'><label for='radio_id_" . $value->value . "'>$value->label</label></div></div>";
	}
	if ( isset( $checkbox_group->description ) && $checkbox_group->description != '' ) {
		echo "<span class='wpep-help-text'>" . $checkbox_group->description . '</span>';
	}
	echo '</div>';

}

function wpep_print_radio_group( $radio_group ) {

	$ifRequired = " <span class='fieldReq'>*</span>";
	echo "<label data-label-show='" . $radio_group->hideLabel . "'>";
	echo __( $radio_group->label, 'wp_easy_pay' );
	echo "" . ( ( isset( $radio_group->required ) ) ? $ifRequired : '' ) . "</label>";
	echo "<div class='wpep-radioWrapper'>";
	foreach ( $radio_group->values as $value ) {
		echo "<div class='wizard-form-radio " . ( ( isset( $radio_group->required ) ) ? 'wpep-required' : '' ) . "'><div class='form-group wpep-m-0'><input type='radio' name='" . $radio_group->name . "' id='radio_id_" . $value->value . "' data-label='" . $value->label . "' data-main-label='" . $radio_group->label . "' value='" . $value->value . "' required='" . ( ( isset( $radio_group->required ) ) ? 'true' : 'false' ) . "'><label for='radio_id_" . $value->value . "'>$value->label</label></div></div>";
	}
	if ( isset( $radio_group->description ) && $radio_group->description != '' ) {
		echo "<span class='wpep-help-text'>" . $radio_group->description . '</span>';
	}
	echo '</div>';

}

function wpep_print_select_dropdown( $select_dropdown ) {
	$ifRequired = " <span class='fieldReq'>*</span>";
	echo "<label data-label-show='" . $select_dropdown->hideLabel . "'>";
	echo __( $select_dropdown->label, 'wp_easy_pay' );
	echo "" . ( ( isset( $select_dropdown->required ) ) ? $ifRequired : '' ) . "</label>";

	echo "<div class='form-group " . ( ( isset( $select_dropdown->required ) ) ? 'wpep-required' : '' ) . "'><select data-label='" . $select_dropdown->label . "' class='" . $select_dropdown->className . "' name='" . $select_dropdown->name . "' " . ( isset( $select_dropdown->multiple ) ? 'multiple style="height:auto;"' : '' ) . "  required='" . ( ( isset( $select_dropdown->required ) ) ? 'true' : 'false' ) . "'>";

	foreach ( $select_dropdown->values as $value ) {
		echo "<option value='" . $value->value . "'>" . $value->label . '</option>';
	}

	echo '</select>';
	if ( isset( $select_dropdown->description ) && $select_dropdown->description != '' ) {
		echo "<span class='wpep-help-text'>" . $select_dropdown->description . '</span>';
	}
	echo '</div>';

}

function wpep_print_textarea( $textarea ) {

	$label       = isset( $textarea->label ) ? $textarea->label : '';
	$placeholder = isset( $textarea->placeholder ) ? $textarea->placeholder : 'Text Area';
	$classname   = isset( $textarea->className ) ? $textarea->className : '';
	$value       = isset( $textarea->value ) ? $textarea->value : '';
	$name        = isset( $textarea->name ) ? $textarea->name : '';
	$required 	 = isset( $textarea->required ) ? 'true' : 'false';
	$ifRequired = " <span class='fieldReq'>*</span>";
	if ( 'true' == $required ) {
		echo '<div class="form-group text-field wpep-required">
		<label class="wizard-form-text-label"> ' . ( ( isset( $label ) ) ? $label : '' ) . $ifRequired . '</label><textarea rows="6" data-label="' . $label . '" name="' . $name . '" placeholder="' . $placeholder . '" class="' . $classname . ' form-control" rows="4" cols="100" required="' . $required . '">' . $value . '</textarea></div>';
	} else {
		echo '<div class="form-group text-field"><label class="wizard-form-text-label"> ' . ( ( isset( $label ) ) ? $label : '' ) . ' </label><textarea rows="6" data-label="' . $label . '" name="' . $name . '" placeholder="' . $placeholder . '" class="' . $classname . ' form-control" rows="4" cols="100" required="' . $required . '">' . $value . '</textarea></div>';
	}

}

function wpep_print_credit_card_fields( $current_form_id ) {

	ob_start();
	?>

	<div id="form-container">
		<div class="form-group form-control-wrap cred-card-wrap">
			<div class="CardIcon">
				<div class="CardIcon-inner">
					<div class="CardIcon-front">
						<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/card-front.jpg'; ?>" alt="Avatar"
							 width="20">
					</div>
					<div class="CardIcon-back">
						<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/card-back.jpg'; ?>" alt="Avatar"
							 width="20">
					</div>
				</div>
			</div>
			<span class="form-control-1 input-card" id="sq-card-number-<?php echo $current_form_id; ?>"></span>

			<div class="cred">
				<span class="form-control-1 input-date" id="sq-expiration-date-<?php echo $current_form_id; ?>"></span>
				<span class="form-control-1 input-ccv abc" id="sq-cvv-<?php echo $current_form_id; ?>"></span>
			</div>
		</div>
		<div class="form-group form-control-wrap pcode">
			<div class="form-control-1 input-postal" id="sq-postal-code-<?php echo $current_form_id; ?>"></div>
		</div>

	</div>

	<?php
	ob_end_flush();
}

function wpep_print_file_upload( $file_upload ) {
	$ifRequired = " <span class='fieldReq'>*</span>";
	echo "<label class='labelupload'> $file_upload->label " . ( ( isset( $file_upload->required ) ) ? $ifRequired : '' ) . "</label>";
	echo "<div class='form-group file-upload-wrapper' data-text='Select your file!'><input accept='.gif, .jpg, .png, .doc, .pdf' type='$file_upload->type' name='$file_upload->name' id='wpep_file_upload_field' class='file-upload-field $file_upload->className'></div>";
}

function wpep_print_credit_card_fields_free() {
	ob_start();

	if ( ! isset( $wpep_current_form_id ) ) {
		$wpep_current_form_id = 1; // free form
	}
	?>

	<div id="form-container">

		<div class="form-group form-control-wrap cred-card-wrap">
			<div class="CardIcon">
				<div class="CardIcon-inner">
					<div class="CardIcon-front">
						<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/card-front.jpg'; ?>" alt="Avatar"
							 width="20">
					</div>
					<div class="CardIcon-back">
						<img src="<?php echo WPEP_ROOT_URL . 'assets/frontend/img/card-back.jpg'; ?>" alt="Avatar"
							 width="20">
					</div>
				</div>
			</div>

			<div class="form-control-1 input-card" id="sq-card-number"></div>

			<div class="cred">
				<div class="form-control-1 input-date" id="sq-expiration-date"></div>
				<div class="form-control-1 input-ccv abc" id="sq-cvv"></div>
			</div>

		</div>
		<div class="form-group form-control-wrap pcode">
			<div class="form-control-1 input-postal" id="sq-postal-code"></div>
		</div>


		<div class="selection" id="showPayment">
			<div class="otherpInput">

				<input class="form-control text-center customPayment" id="wpep_user_defined_amount" name="wpep_user_defined_amount" value="" type="number" step="1" min="1" max="999" />


			</div>
		</div>


		<div class="btnGroup ifSingle">
			<button id="sq-creditcard"  class="wpep-free-form-submit-btn float-right wpep-disabled zeeeeee"><?php echo get_option( 'wpep_free_btn_text' ); ?>
				<span>
					<b id="dosign" style="display: none;">$</b><small id="amount_display_<?php echo $wpep_current_form_id; ?>" class="display"></small>
					<input type="hidden" name="wpep-selected-amount" value="">
				</span>
	</button>            
		</div>
	</div>

	<?php
	ob_end_flush();
}
