<?php

$wpep_radio_amounts = get_post_meta( get_the_ID(), 'wpep_radio_amounts', true );
$wpep_dropdown_amounts = get_post_meta( get_the_ID(), 'wpep_dropdown_amounts', true );
$PriceSelected = ( !empty(get_post_meta( get_the_ID(), 'PriceSelected', true )) ? get_post_meta( get_the_ID(), 'PriceSelected', true ) : '1' );
$save_card_future = get_post_meta( get_the_ID(), 'wpep_save_card', true );
$wpep_prods_without_images = get_post_meta( get_the_ID(), 'wpep_prods_without_images', true );
$wpep_mailchimp_integration = get_post_meta( get_the_ID(), 'wpep_mailchimp_integration', true );
$wpep_products_with_labels = get_post_meta( get_the_ID(), 'wpep_products_with_labels', true );
$wpep_subscription_trial = get_post_meta( get_the_ID(), 'wpep_subscription_trial', true );
wp_localize_script( 'wpep_backend_script', 'wpep_form_setting_amounts', array(
    'wpep_radio_amounts'    => $wpep_radio_amounts,
    'wpep_dropdown_amounts' => $wpep_dropdown_amounts,
    'PriceSelected'         => $PriceSelected,
    'wpep_tabular_products' => $wpep_products_with_labels,
) );
global  $post ;
$wpep_title = $post->post_title;
$wpep_form_theme_color = ( !empty(get_post_meta( get_the_ID(), 'wpep_form_theme_color', true )) ? get_post_meta( get_the_ID(), 'wpep_form_theme_color', true ) : '#5d97ff' );
$wpep_content = $post->post_content;
$wpep_payment_success_url = get_post_meta( get_the_ID(), 'wpep_square_payment_success_url', true );
$wpep_payment_success_label = get_post_meta( get_the_ID(), 'wpep_square_payment_success_label', true );
$wpep_payment_success_msg = get_post_meta( get_the_ID(), 'wpep_payment_success_msg', true );
$wpep_square_payment_box_1 = get_post_meta( get_the_ID(), 'wpep_square_payment_box_1', true );
$wpep_square_payment_box_2 = get_post_meta( get_the_ID(), 'wpep_square_payment_box_2', true );
$wpep_square_payment_box_3 = get_post_meta( get_the_ID(), 'wpep_square_payment_box_3', true );
$wpep_square_payment_box_4 = get_post_meta( get_the_ID(), 'wpep_square_payment_box_4', true );
$defaultPriceSelected = ( !empty(get_post_meta( get_the_ID(), 'defaultPriceSelected', true )) ? get_post_meta( get_the_ID(), 'defaultPriceSelected', true ) : '' );
$wpep_square_payment_type = get_post_meta( get_the_ID(), 'wpep_square_payment_type', true );
$wpep_square_user_defined_amount = get_post_meta( get_the_ID(), 'wpep_square_user_defined_amount', true );
$wpep_square_amount_type = ( !empty(get_post_meta( get_the_ID(), 'wpep_square_amount_type', true )) ? get_post_meta( get_the_ID(), 'wpep_square_amount_type', true ) : 'payment_custom' );
$wpep_button_title = get_post_meta( get_the_ID(), 'wpep_button_title', true );
$wpep_open_in_popup = get_post_meta( get_the_ID(), 'wpep_open_in_popup', true );
$wpep_subscription_cycle_interval = get_post_meta( get_the_ID(), 'wpep_subscription_cycle_interval', true );
$wpep_subscription_cycle = get_post_meta( get_the_ID(), 'wpep_subscription_cycle', true );
$wpep_subscription_length = get_post_meta( get_the_ID(), 'wpep_subscription_length', true );
$wpep_organization_name = get_post_meta( get_the_ID(), 'wpep_organization_name', true );
$wpep_square_payment_min = get_post_meta( get_the_ID(), 'wpep_square_payment_min', true );
$wpep_square_payment_max = get_post_meta( get_the_ID(), 'wpep_square_payment_max', true );
$wpep_show_wizard = get_post_meta( get_the_ID(), 'wpep_show_wizard', true );
$wpep_show_shadow = get_post_meta( get_the_ID(), 'wpep_show_shadow', true );
$wpep_btn_theme = get_post_meta( get_the_ID(), 'wpep_btn_theme', true );
$currencySymbolType = ( !empty(get_post_meta( get_the_ID(), 'currencySymbolType', true )) ? get_post_meta( get_the_ID(), 'currencySymbolType', true ) : 'code' );
$wantRedirection = ( !empty(get_post_meta( get_the_ID(), 'wantRedirection', true )) ? get_post_meta( get_the_ID(), 'wantRedirection', true ) : 'No' );
$redirectionDelay = ( !empty(get_post_meta( get_the_ID(), 'redirectionDelay', true )) ? get_post_meta( get_the_ID(), 'redirectionDelay', true ) : '' );
$enableTermsCondition = get_post_meta( get_the_ID(), 'enableTermsCondition', true );
$enableQuantity = get_post_meta( get_the_ID(), 'enableQuantity', true );
$enableCoupon = get_post_meta( get_the_ID(), 'enableCoupon', true );
$termsLabel = ( !empty(get_post_meta( get_the_ID(), 'termsLabel', true )) ? get_post_meta( get_the_ID(), 'termsLabel', true ) : '' );
$termsLink = ( !empty(get_post_meta( get_the_ID(), 'termsLink', true )) ? get_post_meta( get_the_ID(), 'termsLink', true ) : '' );
$postalPh = ( !empty(get_post_meta( get_the_ID(), 'postalPh', true )) ? get_post_meta( get_the_ID(), 'postalPh', true ) : 'Postal' );
$wpep_subscription_trial_days = get_post_meta( get_the_ID(), 'wpep_subscription_trial_days', true );
$wpep_donation_goal_switch = get_post_meta( get_the_ID(), 'wpep_donation_goal_switch', true );
$wpep_donation_goal_amount = get_post_meta( get_the_ID(), 'wpep_donation_goal_amount', true );
$wpep_donation_goal_message_switch = get_post_meta( get_the_ID(), 'wpep_donation_goal_message_switch', true );
$wpep_donation_goal_message = get_post_meta( get_the_ID(), 'wpep_donation_goal_message', true );
$wpep_donation_goal_form_close = get_post_meta( get_the_ID(), 'wpep_donation_goal_form_close', true );
$wpep_enable_mailchimp = get_option( 'wpep_enable_mailchimp', true );
$mailchimp_audience = get_post_meta( get_the_ID(), 'wpep_mailchimp_audience', true );

if ( $wpep_enable_mailchimp == 'on' ) {
    $apiKey = get_option( 'wpep_mailchimp_api_key', false );
    $server = get_option( 'wpep_mailchimp_server', false );
    try {
        $client = new MailchimpMarketing\ApiClient();
        $client->setConfig( [
            'apiKey' => $apiKey,
            'server' => $server,
        ] );
        $audience = $client->lists->getAllLists();
    } catch ( GuzzleHttp\Exception\ConnectException $e ) {
        // echo $e;
    }
}

?>

<main>
	<div class="formTypeWrapContainer">
		<label for="formType1">
			<input type="checkbox" name="wpep_open_in_popup" id="formType1" 
			<?php 
if ( $wpep_open_in_popup == 'on' ) {
    echo  'checked' ;
}
?>
			 />
			Open form in popup
		</label>
			<?php 
?>

	</div>

	<div id="formPopup" style="display: none">
		<div class="globalSettingsa">
			<div class="globalSettingswrap">
				<h2>Global settings is active</h2>

				<?php 
$global_setting_url = admin_url( 'edit.php?post_type=wp_easy_pay&page=wpep-settings', 'https' );
?>
				<a href="<?php 
echo  $global_setting_url ;
?>" class="btn btn-primary btnglobal">Go to Square Connect
					Settings</a>
			</div>
		</div>
	</div>
	<div id="formPage">
		<div class="testPayment">
			<h3 class="">Payment Form Details</h3>

			<div class="wpeasyPay__body">

				<div class="form-group">
					<label>Form Title:</label>
					<input type="text" class="form-control" placeholder="please enter title" name="post_title"
						   value="<?php 
echo  $wpep_title ;
?>"/>
				</div>

				<div class="form-group">
					<label>Form Description:</label>
					<textarea type="text" class="form-control form-control-textarea"
							  placeholder="Please Enter description"
							  name="post_content"> <?php 
echo  $wpep_content ;
?> </textarea>
				</div>

				<div class="form-group" id="popupWrapper">
					<label>Popup Button Title:</label>
					<input type="text" class="form-control" name="wpep_button_title"
						   placeholder="please enter button title" name="button_title"
						   value="<?php 
echo  $wpep_button_title ;
?>"/>
				</div>


				<div class="form-group">
					<label>Select Payment Type:</label>
					<select class="form-control" name="wpep_square_payment_type" id="paymentTypeSel">
						<option value="simple" 
						<?php 
if ( $wpep_square_payment_type == 'simple' ) {
    echo  'selected' ;
}
?>
						> Simple Payment
						</option>

						<option value="donation" 
						<?php 
if ( $wpep_square_payment_type == 'donation' ) {
    echo  'selected' ;
}
?>
						> Donation Payment
						</option>

						<?php 
?>

					</select>
				</div>


				<div id="subscription" class="drop-payment-select-show-hide">
					<label>Subscription Cycle:</label>

					<div class="subWrap">
						<div class="subsblock">
							<select name="wpep_subscription_cycle_interval" class="form-group form-control">
								<option value="1" 
								<?php 
if ( $wpep_subscription_cycle_interval == '1' ) {
    echo  'selected' ;
}
?>
								>every 1
								</option>
								<option value="2" 
								<?php 
if ( $wpep_subscription_cycle_interval == '2' ) {
    echo  'selected' ;
}
?>
								>every 2nd
								</option>
								<option value="3" 
								<?php 
if ( $wpep_subscription_cycle_interval == '3' ) {
    echo  'selected' ;
}
?>
								>every 3rd
								</option>
								<option value="4" 
								<?php 
if ( $wpep_subscription_cycle_interval == '4' ) {
    echo  'selected' ;
}
?>
								>every 4th
								</option>
								<option value="5" 
								<?php 
if ( $wpep_subscription_cycle_interval == '5' ) {
    echo  'selected' ;
}
?>
								>every 5th
								</option>
								<option value="6" 
								<?php 
if ( $wpep_subscription_cycle_interval == '6' ) {
    echo  'selected' ;
}
?>
								>every 6th
								</option>
							</select>
						</div>
						<div class="subsblock">
							<select name="wpep_subscription_cycle" class="form-group form-control">
								<option value="day" 
								<?php 
if ( $wpep_subscription_cycle == 'day' ) {
    echo  'selected' ;
}
?>
								>day
								</option>
								<option value="week" 
								<?php 
if ( $wpep_subscription_cycle == 'week' ) {
    echo  'selected' ;
}
?>
								>week
								</option>
								<option value="month" 
								<?php 
if ( $wpep_subscription_cycle == 'month' ) {
    echo  'selected' ;
}
?>
								>month
								</option>
								<option value="year" 
								<?php 
if ( $wpep_subscription_cycle == 'year' ) {
    echo  'selected' ;
}
?>
								>year
								</option>
							</select>
						</div>

						<div class="subsblock">
							<select name="wpep_subscription_length" class="form-group form-control">
								<option value="never_expire"
									<?php 
echo  ( $wpep_subscription_length == 'never_expire' ? 'selected' : '' ) ;
?>>Never
									expire
								</option>
								<option value="1" <?php 
echo  ( $wpep_subscription_length == 1 ? 'selected' : '' ) ;
?>>
									every
									1 cycle
								</option>
								<option value="2" <?php 
echo  ( $wpep_subscription_length == 2 ? 'selected' : '' ) ;
?>>
									every
									2 cycles
								</option>
								<option value="3" <?php 
echo  ( $wpep_subscription_length == 3 ? 'selected' : '' ) ;
?>>
									every
									3 cycles
								</option>
								<option value="4" <?php 
echo  ( $wpep_subscription_length == 4 ? 'selected' : '' ) ;
?>>
									every
									4 cycles
								</option>
								<option value="5" <?php 
echo  ( $wpep_subscription_length == 5 ? 'selected' : '' ) ;
?>>
									every
									5 cycles
								</option>
								<option value="6" <?php 
echo  ( $wpep_subscription_length == 6 ? 'selected' : '' ) ;
?>>
									every
									6 cycles
								</option>
								<option value="7" <?php 
echo  ( $wpep_subscription_length == 7 ? 'selected' : '' ) ;
?>>
									every
									7 cycles
								</option>
								<option value="8" <?php 
echo  ( $wpep_subscription_length == 8 ? 'selected' : '' ) ;
?>>
									every
									8 cycles
								</option>
								<option value="9" <?php 
echo  ( $wpep_subscription_length == 9 ? 'selected' : '' ) ;
?>>
									every
									9 cycles
								</option>
								<option value="10" <?php 
echo  ( $wpep_subscription_length == 10 ? 'selected' : '' ) ;
?>>
									every 10 cycles
								</option>
								<option value="11" <?php 
echo  ( $wpep_subscription_length == 11 ? 'selected' : '' ) ;
?>>
									every 11 cycles
								</option>
								<option value="12" <?php 
echo  ( $wpep_subscription_length == 12 ? 'selected' : '' ) ;
?>>
									every 12 cycles
								</option>
								<option value="13" <?php 
echo  ( $wpep_subscription_length == 13 ? 'selected' : '' ) ;
?>>
									every 13 cycles
								</option>
								<option value="14" <?php 
echo  ( $wpep_subscription_length == 14 ? 'selected' : '' ) ;
?>>
									every 14 cycles
								</option>
								<option value="15" <?php 
echo  ( $wpep_subscription_length == 15 ? 'selected' : '' ) ;
?>>
									every 15 cycles
								</option>
								<option value="16" <?php 
echo  ( $wpep_subscription_length == 16 ? 'selected' : '' ) ;
?>>
									every 16 cycles
								</option>
								<option value="17" <?php 
echo  ( $wpep_subscription_length == 17 ? 'selected' : '' ) ;
?>>
									every 17 cycles
								</option>
								<option value="18" <?php 
echo  ( $wpep_subscription_length == 18 ? 'selected' : '' ) ;
?>>
									every 18 cycles
								</option>
								<option value="19" <?php 
echo  ( $wpep_subscription_length == 19 ? 'selected' : '' ) ;
?>>
									every 19 cycles
								</option>
								<option value="20" <?php 
echo  ( $wpep_subscription_length == 20 ? 'selected' : '' ) ;
?>>
									every 20 cycles
								</option>
								<option value="21" <?php 
echo  ( $wpep_subscription_length == 21 ? 'selected' : '' ) ;
?>>
									every 21 cycles
								</option>
								<option value="22" <?php 
echo  ( $wpep_subscription_length == 22 ? 'selected' : '' ) ;
?>>
									every 22 cycles
								</option>
								<option value="23" <?php 
echo  ( $wpep_subscription_length == 23 ? 'selected' : '' ) ;
?>>
									every 23 cycles
								</option>
								<option value="24" <?php 
echo  ( $wpep_subscription_length == 24 ? 'selected' : '' ) ;
?>>
									every 24 cycles
								</option>
							</select>
						</div>
					</div>
					
					<!-- <div class="subscription_trial">
						<div class="form-group">
							<input type="checkbox" name="wpep_subscription_trial" value="checked" <?php 
echo  $wpep_subscription_trial ;
?> >
							<label> Enable Subscription Trial </label>
						</div>
						<div class="form-group">
							<label>Subscription Trial Days:</label>
							<input type="text" class="form-control" placeholder="Subscription Trial Days" name="wpep_subscription_trial_days" value="<?php 
echo  $wpep_subscription_trial_days ;
?>" />
						</div>
					</div> -->
					
				</div>


				<!-- <div class="form-group">
					<label>Form theme color:</label>

					<div class="formsetting">
						<div class="formsblock1">
							<input class="form-control jscolor" value="<?php 
//echo $wpep_form_theme_color;
?>"
								name="wpep_form_theme_color" />
						</div>
						<div class="formsblock2">


							<label><input type="checkbox" name="wpep_show_shadow" id="formType2" 
							<?php 
if ( $wpep_show_shadow == 'on' ) {
    echo  'checked' ;
}
?>
				 /> Show form shadow</label>
						</div>

						<div class="formsblock2">


							<label><input type="checkbox" name="wpep_btn_theme" id="formType2" 
							<?php 
if ( $wpep_btn_theme == 'on' ) {
    echo  'checked' ;
}
?>
				 /> Use theme default popup button style</label>
						</div>

					</div>




				</div> -->
				<?php 
?>
					

				<?php 
?>

				<div class="form-group">
					<label>Amount Type:</label>
					<select class="form-control" name="wpep_square_amount_type" id="paymentDrop">
						<?php 
?>

						<option value="payment_custom" 
						<?php 
if ( $wpep_square_amount_type == 'payment_custom' ) {
    echo  'selected' ;
}
?>
						> Payment custom layout
						</option>

					</select>

				</div>

				<?php 
$wpep_payment_mode = get_option( 'wpep_square_payment_mode_global' );
if ( $wpep_payment_mode == 'on' ) {
    /* if live is on */
    $square_currency = get_option( 'wpep_square_currency_new', true );
}
if ( $wpep_payment_mode !== 'on' ) {
    /* if test is on */
    $square_currency = get_option( 'wpep_square_currency_test', true );
}
?>
				<div id="payment_radio"
					 class="form-group drop-down-show-hide wpep_currency_<?php 
echo  $square_currency . ' ' . $currencySymbolType ;
?>">
					<textarea class="form-control" id="amountInList" name="amountInList"></textarea>
				</div>

				<div id="payment_drop"
					 class="form-group drop-down-show-hide wpep_currency_<?php 
echo  $square_currency . ' ' . $currencySymbolType ;
?>">
					<textarea class="form-control" id="amountInDrop" name="amountInDrop"></textarea>
				</div>
				<div id="payment_custom"
					 class="form-group drop-down-show-hide wpep_currency_<?php 
echo  $square_currency . ' ' . $currencySymbolType ;
?>">
					<div class="paymentSelect paymentSelectB">
						<input type="radio" class="defaultPriceSelected" name="defaultPriceSelected" value="dollar1"
							<?php 
if ( $defaultPriceSelected == 'dollar1' || $defaultPriceSelected == '' ) {
    echo  'checked' ;
}
?>
							>
						<div class="selection not-empty">
							<input class="form-group" id="doller1" type="text" placeholder="Enter amount"
								   name="wpep_square_payment_box_1" value="<?php 
echo  $wpep_square_payment_box_1 ;
?>"/>
						</div>

						<input type="radio" class="defaultPriceSelected" name="defaultPriceSelected" value="dollar2"
							<?php 
if ( $defaultPriceSelected == 'dollar2' ) {
    echo  'checked' ;
}
?>
							>
						<div class="selection not-empty">
							<input class="form-group" id="doller2" type="text" placeholder="Enter amount"
								   value="<?php 
echo  $wpep_square_payment_box_2 ;
?>" name="wpep_square_payment_box_2"/>
						</div>

						<input type="radio" class="defaultPriceSelected" name="defaultPriceSelected" value="dollar3"
							<?php 
if ( $defaultPriceSelected == 'dollar3' ) {
    echo  'checked' ;
}
?>
							>
						<div class="selection empty">
							<input class="form-group" id="doller3" type="text" placeholder="Enter amount"
								   value="<?php 
echo  $wpep_square_payment_box_3 ;
?>" name="wpep_square_payment_box_3"/>
						</div>

						<input type="radio" class="defaultPriceSelected" name="defaultPriceSelected" value="dollar4"
							<?php 
if ( $defaultPriceSelected == 'dollar4' ) {
    echo  'checked' ;
}
?>
							>
						<div class="selection secLast empty">
							<input class="form-group" id="doller4" type="text" placeholder="Enter amount"
								   value="<?php 
echo  $wpep_square_payment_box_4 ;
?>" name="wpep_square_payment_box_4"/>
						</div>

						<div class="selectionBlock saveCardFeature">
							<label for="checkbox1"><input type="checkbox" id="checkbox1"
														  name="wpep_square_user_defined_amount" 
														  <?php 
if ( $wpep_square_user_defined_amount == 'on' ) {
    echo  'checked' ;
}
?>
								> Enable other
								amount field on payment form</label>
							
						</div>

						<div id="paymentLimit" style="display: none;">
							<div class="selection empty">
								<input class="form-group" id="paymin" type="text" placeholder="Min amount"
									   name="wpep_square_payment_min" value="<?php 
echo  $wpep_square_payment_min ;
?>"/>

							</div>
							<div class="selection empty">
								<input class="form-group" id="paymax" type="text" placeholder="Max amount"
									   name="wpep_square_payment_max" value="<?php 
echo  $wpep_square_payment_max ;
?>"/>
							</div>
						</div>
					</div>

				</div>
			

				<?php 
?>


				<?php 

if ( isset( $wpep_products_with_labels ) && !empty($wpep_products_with_labels) ) {
    echo  '<div id="payment_tabular" class="form-group drop-down-show-hide">' ;
    $count = 0;
    foreach ( $wpep_products_with_labels as $key => $product ) {
        echo  '<div class="multiInput">' ;
        echo  '<div class="inputWrapperCus">' ;
        echo  '<div class="cusblock1">' ;
        // echo '<input type="radio" name="wpep_default_field">';
        
        if ( isset( $product['products_url'] ) && !empty($product['products_url']) ) {
            $product_url = $product['products_url'];
        } else {
            $product_url = WPEP_ROOT_URL . 'assets/backend/img/placeholder-image.png';
        }
        
        echo  '<div class="timgfield"><input type="file" name="wpep_tabular_products_image[]" data-proid="' . $count . '" onchange="readURL(this);"><img src="' . $product_url . '" id="image_div_' . $count . '" width="66px"></div>' ;
        echo  '<input type="text" name="wpep_tabular_products_price[]" value="' . $product['amount'] . '"  placeholder="Product Price" class="form-control tamountfield">' ;
        echo  '<input type="text" name="wpep_tabular_products_label[]" value="' . $product['label'] . '" placeholder="Label" class="form-control tlabbelfield">' ;
        echo  '<input type="text" name="wpep_tabular_products_qty[]" value="' . $product['quantity'] . '" placeholder="Quantity" class="form-control tqtufield">' ;
        echo  '<input type="hidden" name="wpep_tabular_product_hidden_image[]" value="' . $product['products_url'] . '">' ;
        echo  '</div>' ;
        echo  '<input type="button" class="btnplus" onclick="wpep_add_repeator_field_product(' . $count . ');" value="">' ;
        
        if ( 0 == $count ) {
            echo  '<input type="button" class="btnminus" value="">' ;
        } else {
            echo  '<input type="button" class="btnminus" onclick="wpep_delete_repeator_field_product(this);" value="">' ;
        }
        
        echo  '</div>' ;
        echo  '</div>' ;
        $count++;
    }
    echo  '</div>' ;
} else {
    echo  '<div id="payment_tabular" class="form-group drop-down-show-hide">' ;
    echo  '<div class="multiInput">' ;
    echo  '<div class="inputWrapperCus">' ;
    echo  '<div class="cusblock1">' ;
    // echo '<input type="radio" name="wpep_default_field">';
    $product_url = WPEP_ROOT_URL . 'assets/backend/img/placeholder-image.png';
    echo  '<div class="timgfield"><input type="file" name="wpep_tabular_products_image[]" data-proid="0" onchange="readURL(this);"><img id="image_div_0" src ="' . $product_url . '" width="66px"  /></div>' ;
    echo  '<input type="text" name="wpep_tabular_products_price[]" placeholder="Product Price" class="form-control tamountfield">' ;
    echo  '<input type="text" name="wpep_tabular_products_label[]" placeholder="Label" class="form-control tlabbelfield">' ;
    echo  '<input type="text" name="wpep_tabular_products_qty[]" placeholder="Quantity" class="form-control tqtufield">' ;
    echo  '</div>' ;
    echo  '<input type="button" class="btnplus" onclick="wpep_add_repeator_field_product(0);" value="">' ;
    echo  '<input type="button" class="btnminus" value="">' ;
    echo  '</div>' ;
    echo  '</div>' ;
    echo  '</div>' ;
}

?>


				<?php 
?>

					<?php 
?>

				<div class="formwrapper">
					<div class="formFlex formFlexAllow form-group">
						<label>Redirection on success:</label>
						<select name="wantRedirection" id="allowRedirection" class="form-control">
							<option>Please Select</option>
							<option value="Yes"
								<?php 
if ( $wantRedirection == 'Yes' ) {
    echo  'selected="selected"' ;
}
?>
								>Yes
							</option>
							<option
								value="No" 
								<?php 
if ( $wantRedirection == 'No' ) {
    echo  'selected="selected"' ;
}
?>
								>
								No
							</option>
						</select>

					</div>

					<div class="formFlex formFlexTime form-group">
						<label>Redirection in seconds:</label>
						<input id="redirectionCheck" class="redirectionCheckInput form-control" type="number"
							   name="redirectionDelay" placeholder="Example: 5" value="<?php 
echo  $redirectionDelay ;
?>">
					</div>


					<div class="formFlex form-group">
						<label>Payment Success Button Label:</label>
						<input type="text" class="form-control" placeholder="Enter Label"
							   name="wpep_square_payment_success_label"
							   value="<?php 
echo  $wpep_payment_success_label ;
?>"/>
					</div>
					<div class="formFlex form-group">
						<label>Payment Success Button URL:</label>
						<input type="text" class="form-control" placeholder="Redirect url"
							   name="wpep_square_payment_success_url" value="<?php 
echo  $wpep_payment_success_url ;
?>"/>
					</div>
				</div>

				<div class="form-group">
					<label>Payment Success Message:</label>
					<textarea type="text" class="form-control form-control-textarea"
							  placeholder="Please Enter success message"
							  name="wpep_payment_success_msg"> <?php 
echo  $wpep_payment_success_msg ;
?> </textarea>
				</div>

				<div class="form-group">
					<label>Postal Placeholder</label>
					<input type="text" class="form-control" placeholder="Postal" name="postalPh"
						   value="<?php 
echo  $postalPh ;
?>">
				</div>

				<?php 
?>

				<div class="clearfix" id="enableTCWrap" style="display: none;">
					<div class="form-group wpep-form-group-half-left">
						<label>Link Label:</label>
						<input type="text" class="form-control" placeholder="Please Enter Label" name="termsLabel"
							   value="<?php 
echo  $termsLabel ;
?>">
					</div>
					<div class="form-group wpep-form-group-half-right">
						<label>Link to page:</label>
						<input type="text" class="form-control" placeholder="Please Enter url for user redirect"
							   name="termsLink" value="<?php 
echo  $termsLink ;
?>">
					</div>
				</div>
			</div>
		</div>

	</div>

</main>
