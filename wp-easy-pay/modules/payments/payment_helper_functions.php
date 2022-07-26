<?php
require_once WPEP_ROOT_PATH . 'modules/payments/square_configuration.php';

function wpep_create_wordpress_user( $first_name, $last_name, $email ) {

	$username = strtolower( $email );
	$password = wpep_generate_random_password();
	$user_id  = wp_create_user( $username, $password, $email );

	require_once WPEP_ROOT_PATH . 'modules/email_notifications/new_user_email.php';
	wpep_new_user_email_notification( $username, $password, $email );

	return $user_id;

}

function wpep_generate_random_password() {
	$alphabet    = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
	$pass        = array();
	$alphaLength = strlen( $alphabet ) - 1;
	for ( $i = 0; $i < 8; $i++ ) {
		$n      = rand( 0, $alphaLength );
		$pass[] = $alphabet[ $n ];
	}
	return implode( $pass );
}

function wpep_retrieve_square_customer_to_verify( $apiClient, $square_customer_id ) {

	$apiInstance = new SquareConnect\Api\CustomersApi( $apiClient );
	try {
		$result = $apiInstance->retrieveCustomer( $square_customer_id );
		return $result->getCustomer()->getId();
	} catch ( Exception $e ) {
		return false;
		// wp_die(json_encode($e->getResponseBody()->errors[0]));
	}

}

function wpep_create_square_customer_card( $apiClient, $square_customer_id, $nonce, $first_name, $last_name, $verificationToken ) {

	$apiInstance      = new SquareConnect\Api\CustomersApi( $apiClient );
	$card_holder_name = $first_name . ' ' . $last_name;

	$body = new \SquareConnect\Model\CreateCustomerCardRequest();
	$body->setCardNonce( $nonce );
	$body->setCardholderName( $card_holder_name );
	$body->setVerificationToken( $verificationToken );

	try {

		$result = $apiInstance->createCustomerCard( $square_customer_id, $body );
		return $result->getCard()->getId();

	} catch ( Exception $e ) {
		wp_die( json_encode( $e->getResponseBody()->errors[0] ) );
	}

}

function wpep_create_square_customer( $apiClient ) {

	$apiInstance = new SquareConnect\Api\CustomersApi( $apiClient );
	$body        = new \SquareConnect\Model\CreateCustomerRequest();
	$unique_key  = uniqid() . 'wpexperts';

	$body->setIdempotencyKey( $unique_key );
	$body->setGivenName( $_POST['first_name'] );
	$body->setFamilyName( $_POST['last_name'] );
	$body->setEmailAddress( $_POST['email'] );
	$body->setReferenceId( $unique_key );

	try {

		$result = $apiInstance->createCustomer( $body );
		return $result->getCustomer()->getId();

	} catch ( Exception $e ) {
		wp_die( json_encode( $e->getResponseBody()->errors[0] ) );
	}

}


function wpep_weekly_refresh_tokens() {

	$oauth_connect_url    = WPEP_MIDDLE_SERVER_URL;
	$refresh_access_token = get_option( 'wpep_refresh_token' );

	$args_renew = array(

		'body'    => array(

			'request_type'  => 'renew_token',
			'refresh_token' => $refresh_access_token,
			'oauth_version' => 2,
			'app_name'      => WPEP_SQUARE_APP_NAME,

		),
		'timeout' => 45,
	);

	$oauth_response      = wp_remote_post( $oauth_connect_url, $args_renew );
	$oauth_response_body = json_decode( $oauth_response['body'] );

	update_option( 'wpep_live_token_upgraded', sanitize_text_field( $oauth_response_body->access_token ) );
	update_option( 'wpep_refresh_token', $oauth_response_body->refresh_token );
	update_option( 'wpep_token_expires_at', $oauth_response_body->expires_at );

}


function wpep_square_refresh_token( $expires_at, $refresh_access_token, $type, $current_form_id ) {

	$expiry_status = wpep_check_give_square_expiry( $expires_at );

	if ( $expiry_status == 'expired' ) {

		 $oauth_connect_url = WPEP_MIDDLE_SERVER_URL;

		 $args_renew = array(

			 'body'    => array(

				 'request_type'  => 'renew_token',
				 'refresh_token' => $refresh_access_token,
				 'oauth_version' => 2,
				 'app_name'      => WPEP_SQUARE_APP_NAME,
			 ),
			 'timeout' => 45,
		 );

		 $oauth_response      = wp_remote_post( $oauth_connect_url, $args_renew );
		 $oauth_response_body = json_decode( $oauth_response['body'] );

		 if ( $type == 'global' ) {

			 update_option( 'wpep_live_token_upgraded', sanitize_text_field( $oauth_response_body->access_token ) );
			 update_option( 'wpep_refresh_token', $oauth_response_body->refresh_token );
			 update_option( 'wpep_token_expires_at', $oauth_response_body->expires_at );

			 echo $type;

		 }

		 if ( $type == 'specific' ) {

			 update_post_meta( $current_form_id, 'wpep_live_token_upgraded', sanitize_text_field( $oauth_response_body->access_token ) );
			 update_post_meta( $current_form_id, 'wpep_refresh_token', $oauth_response_body->refresh_token );
			 update_post_meta( $current_form_id, 'wpep_token_expires_at', $oauth_response_body->expires_at );

		 }
	}

}


function wpep_check_give_square_expiry( $expires_at ) {

	$date_time    = explode( 'T', $expires_at );
	$date_time[1] = str_replace( 'Z', '', $date_time[1] );
	$expires_at   = strtotime( $date_time[0] . ' ' . $date_time[1] );
	$today        = strtotime( 'now' );

	if ( $today >= $expires_at ) {

		return 'expired';

	} else {

		return 'active';

	}

}

function wpep_retrieve_square_customer( $apiClient, $square_customer_id ) {

	try {

		$apiInstance = new SquareConnect\Api\CustomersApi( $apiClient );
		$result      = $apiInstance->retrieveCustomer( $square_customer_id );
		return $result->getCustomer()->getId();

	} catch ( Exception $e ) {

		return false;
	}

}


function wpep_retrieve_square_customer_result( $apiClient, $square_customer_id ) {

	try {

		$apiInstance = new SquareConnect\Api\CustomersApi( $apiClient );
		$result      = $apiInstance->retrieveCustomer( $square_customer_id );
		return $result;

	} catch ( Exception $e ) {

		return false;
	}

}

function wpep_retrieve_customer_cards( $apiClient, $square_customer_id ) {
	try {

		$apiInstance = new SquareConnect\Api\CustomersApi( $apiClient );
		$result      = $apiInstance->retrieveCustomer( $square_customer_id );
		return $result->getCustomer()->getCards();

	} catch ( Exception $e ) {
		return false;
	}

}

function wpep_update_cards_on_file( $apiClient, $square_customer_id, $wp_user_id ) {

	$square_cards_on_file = wpep_retrieve_customer_cards( $apiClient, $square_customer_id );

	$card_on_files_to_store_locally = array();
	foreach ( $square_cards_on_file as $card ) {

		$card_container                     = array();
		$card_container['card_customer_id'] = $square_customer_id;
		$card_container['card_id']          = $card->getId();
		$card_container['card_holder_name'] = $card->getCardholderName();
		$card_container['card_brand']       = $card->getCardBrand();
		$card_container['card_last_4']      = $card->getLast4();
		$card_container['card_exp_month']   = $card->getExpMonth();
		$card_container['card_exp_year']    = $card->getExpYear();

		array_push( $card_on_files_to_store_locally, $card_container );

	}

	update_user_meta( $wp_user_id, 'wpep_square_customer_cof', $card_on_files_to_store_locally );

}


function wpep_delete_cof() {

	$square_customer_id = $_POST['customer_id'];
	$card_on_file       = str_replace( 'doc:', 'ccof:', $_POST['card_on_file'] );
	$current_form_id    = $_POST['current_form_id'];
	$apiClient          = wpep_setup_square_configuration_by_form_id( $current_form_id );
	$apiInstance        = new SquareConnect\Api\CustomersApi( $apiClient );

	try {

		$result = $apiInstance->deleteCustomerCard( $square_customer_id, $card_on_file );
		wpep_update_cards_on_file( $apiClient, $square_customer_id, get_current_user_id() );
		echo 'success';
		wp_die();

	} catch ( Exception $e ) {
		wpep_update_cards_on_file( $apiClient, $square_customer_id, get_current_user_id() );
		wp_die( json_encode( $e->getResponseBody()->errors[0] ) );
	}

}

add_action( 'wp_ajax_wpep_delete_cof', 'wpep_delete_cof' );
add_action( 'wp_ajax_nopriv_wpep_delete_cof', 'wpep_delete_cof' );


function wpep_apply_coupon () {

	if ( isset( $_POST['cp_submit'] ) && 'Apply' === sanitize_text_field($_POST['cp_submit']) ) {
		
		if ( isset( $_POST['coupon_code'] ) && isset( $_POST['total_amount'] ) && ! empty($_POST['coupon_code']) && ! empty($_POST['total_amount']) ) {

			$today = gmdate('Y-m-d');
			$total_amount = sanitize_text_field( $_POST['total_amount'] );
			$code = sanitize_text_field( $_POST['coupon_code'] );
			$form_id = sanitize_text_field( $_POST['current_form_id'] );
			$flag = false;
			$result = array(
				'status' => '',
				'message_success' => '',
				'message_failed' => '',
			);

			//check if coupon already applied on the cart
			if ( isset( $_POST['discounted'] ) && 'yes' == $_POST['discounted'] ) {
				$result['status'] = 'failed';
				$result['message_failed'] = 'Coupon already applied!';
				print_r(json_encode($result));
				wp_die();
			}

			//get post id by post meta key & value
			$args = array(
				'post_type'		=> 'wpep_coupons',
				'post_status'   => array('publish'),
				'meta_query'	=>	array(
					array(
						'value'	=>	$code
					)
				)
			);

			$coupon = new WP_Query( $args );

			if ( isset($coupon->posts[0]) ) {
				
				$post_ID = $coupon->posts[0]->ID;

				$wpep_coupons_discount_type = get_post_meta( $post_ID, 'wpep_coupons_discount_type', true );
				$wpep_coupons_amount = get_post_meta( $post_ID, 'wpep_coupons_amount', true );
				$wpep_coupons_expiry = get_post_meta( $post_ID, 'wpep_coupons_expiry', true );
				$wpep_coupons_form_include = get_post_meta( $post_ID, 'wpep_coupons_form_include', true );
				$wpep_coupons_form_exclude = get_post_meta( $post_ID, 'wpep_coupons_form_exclude', true );

				if ( !empty($wpep_coupons_discount_type) && !empty($wpep_coupons_amount) && !empty($wpep_coupons_expiry) ) {
					
					$wpep_coupons_expiry = date('Y-m-d', strtotime($wpep_coupons_expiry));

					if ( ! empty( $wpep_coupons_form_exclude ) ) {

						if ( in_array($form_id, $wpep_coupons_form_exclude) ) {
							$flag = false;
						} else {
							$flag = true;
						}

					} else {

						$flag = true;

					}
					
					if ( ! empty( $wpep_coupons_form_include ) ) {
						
						if ( in_array($form_id, $wpep_coupons_form_include) ) {
							$flag = true;
						} else {
							$flag = false;
						}

					} else {

						$flag = true;

					}
					
					if ( true === $flag ) {

						if ( $today > $wpep_coupons_expiry ) {

							$result['status'] = 'failed';
							$result['message_failed'] = 'Sorry, Your coupon has been expired!';

						} else {

							$total_amount = explode(' ', $total_amount);
							$subtotal = floatval($total_amount[0]);
							$currency = $total_amount[1];

							if ( 'percentage' == $wpep_coupons_discount_type ) {
																
								$discount = ($wpep_coupons_amount/100) * $subtotal;
								$total = $subtotal - $discount;								

							}
	
							if ( 'fixed' == $wpep_coupons_discount_type ) {

								$discount = $wpep_coupons_amount;
								$total = $subtotal - $discount;

							}

							if ( $total < 0 ) {
								$total = 0;
							}

							$result['status'] = 'success';
							$result['message_success'] = 'Congratulation! Coupon applied successfully.';
							$result['currency'] = $_POST['currency'];
							$result['discount'] = $discount;
							$result['total'] = $total;	

						}

					} else {
						$result['status'] = 'failed';
						$result['message_failed'] = 'Sorry, coupon does\'nt exist for this form!';
					}
					
				}

			} else {
				$result['status'] = 'failed';
				$result['message_failed'] = 'Sorry, coupon does\'nt exist!';
			}

			print_r(json_encode($result));
			wp_die();

		}

	}

}
add_action( 'wp_ajax_wpep_apply_coupon', 'wpep_apply_coupon' );
add_action( 'wp_ajax_nopriv_wpep_apply_coupon', 'wpep_apply_coupon' );

function wpep_calculate_fee_data () {

	if ( isset($_POST['current_form_id']) && isset($_POST['total_amount']) && !empty($_POST['current_form_id']) && !empty($_POST['total_amount']) ) {
		
		$sub_total_amount = floatval( $_POST['total_amount'] );
		$total_amount = $sub_total_amount;
		$discount = floatval( $_POST['discount'] );
		$fees_data = get_post_meta( $_POST['current_form_id'], 'fees_data' );
		$wpep_enable_signup_fees = get_post_meta( $_POST['current_form_id'], 'wpep_enable_signup_fees', true );
		$currency = isset( $_POST['currency'] ) ? $_POST['currency'] : '$';
		if ( !empty($fees_data[0]['check']) ) {
			?>
			<ul>				
			<?php 	
			if ( $discount > 0 ) {
				?>
				<li class="wpep-fee-subtotal">
					<span class="fee_name"><?php echo esc_html__('Subtotal', 'wp_easy_pay'); ?></span>					
					<span class="fee_value"><?php echo esc_attr(number_format($sub_total_amount, 2) + number_format($discount, 2)) . ' ' . esc_attr($currency); ?></span>					
				</li>
				<li class="wpep-fee-discount">
					<span class="fee_name"><?php echo esc_html__('Discount', 'wp_easy_pay'); ?></span>
					<span class="fee_value"><?php echo '-' . esc_attr(number_format($discount, 2)) . ' ' . esc_attr($currency); ?></span>
				</li>
				<?php
			} else {
				?>
				<li class="wpep-fee-subtotal">
					<span class="fee_name"><?php echo esc_html__('Subtotal', 'wp_easy_pay'); ?></span>					
					<span class="fee_value"><?php echo esc_attr(number_format($sub_total_amount, 2)) . ' ' . esc_attr($currency); ?></span>					
				</li>
				<?php
			}			
			if ($wpep_enable_signup_fees == 'yes') :
							$wpep_signup_fees_value = get_post_meta( $_POST['current_form_id'], 'wpep_signup_fees_amount', true ); ?>
						<li class="wpep-fee-onetime">
							<span class="fee_name"><?php echo esc_html__('Signup Fee', 'wp_easy_pay'); ?></span>
							<span class="fee_value"><?php echo esc_attr(number_format($wpep_signup_fees_value, 2)) . ' ' . esc_attr($currency); ?></span>
							<input type='hidden' value='<?php echo esc_attr( number_format($wpep_signup_fees_value, 2) ); ?>' name='wpep-signup-amount'>
						</li>
						<?php 
							$total_amount = $total_amount + $wpep_signup_fees_value;
			endif;
			foreach ( $fees_data[0]['check'] as $key => $fees ) :
				if ( 'yes' === $fees ) :
					
					if ( 'percentage' == $fees_data[0]['type'][$key] ) {
						$tax = $sub_total_amount * ( $fees_data[0]['value'][$key]/100 );						
					} else {
						$tax = $fees_data[0]['value'][$key];
					}

					$total_amount = $total_amount + $tax;
					?>
					<li>
						<span class="fee_name"><?php echo esc_html($fees_data[0]['name'][$key]); ?></span>
						<span class="fee_value"><?php echo esc_attr(number_format($tax, 2)) . ' ' . esc_attr($currency); ?></span>
					</li>
					<?php
				endif;
			endforeach;
			?>

				<li class="wpep-fee-total">
					<span class="fee_name"><?php echo esc_html__('Total', 'wp_easy_pay'); ?></span>
					<span class="fee_value"><?php echo esc_attr(number_format($total_amount, 2)) . ' ' . esc_attr($currency); ?></span>
				</li>
			</ul>
			<?php
		}

		wp_die();
	}
}
add_action( 'wp_ajax_wpep_calculate_fee_data', 'wpep_calculate_fee_data' );
add_action( 'wp_ajax_nopriv_wpep_calculate_fee_data', 'wpep_calculate_fee_data' );

