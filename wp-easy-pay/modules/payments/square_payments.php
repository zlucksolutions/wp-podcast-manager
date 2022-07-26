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

require_once WPEP_ROOT_PATH . 'modules/payments/square_configuration.php';
require_once WPEP_ROOT_PATH . 'modules/payments/payment_helper_functions.php';
require_once WPEP_ROOT_PATH . 'modules/error_logging.php';


add_action( 'wp_ajax_wpep_payment_request', 'wpep_payment_request' );
add_action( 'wp_ajax_nopriv_wpep_payment_request', 'wpep_payment_request' );

add_action( 'wp_ajax_wpep_file_upload', 'wpep_file_upload' );
add_action( 'wp_ajax_nopriv_wpep_file_upload', 'wpep_file_upload' );

add_action( 'wp_ajax_wpep_recaptcha_verification', 'wpep_recaptcha_verification' );
add_action( 'wp_ajax_nopriv_wpep_recaptcha_verification', 'wpep_recaptcha_verification' );

add_action( 'wp_ajax_wpep_payment_refund', 'wpep_payment_refund' );


function wpep_file_upload() {
	
	$transaction_report_id = $_POST['transaction_report_id'];
	$uploadedfile          = $_FILES['file'];
	$upload_overrides      = array(
		'test_form' => false,
	);
	$movefile              = wp_handle_upload( $uploadedfile, $upload_overrides );

	if ( $movefile && ! isset( $movefile['error'] ) ) {
		$return_response = array(
			'uploaded_file_url' => $movefile['url'],
		);
		$form_values     = get_post_meta( $transaction_report_id, 'wpep_form_values' );
		array_push(
			$form_values[0],
			array(
				'label' => 'Uploaded File URL',
				'value' => $movefile['url'],
			)
		);
		update_post_meta( $transaction_report_id, 'wpep_form_values', $form_values[0] );

		wp_die( 'upload success' );
	} else {
		echo $movefile['error'];
		wp_die();
	}

}

function wpep_payment_request() {

	$payment_type = $_POST['payment_type'];
	$save_card    = $_POST['save_card'];

	if ( $payment_type == 'single' ) {

		if ( $save_card == 'true' ) {

			wpep_subscription_square_payment();

		} else {

			wpep_single_square_payment();
		}
	}

	if ( $payment_type == 'donation_recurring' ) {

		wpep_subscription_square_payment();

	}

	if ( $payment_type == 'subscription' ) {

		wpep_subscription_square_payment();

	}

}

function wpep_recaptcha_verification( $recaptcha_response ) {

		$recaptcha_response = $_POST['recaptcha_response'];

		$url    = 'https://www.google.com/recaptcha/api/siteverify';
		$fields = array(
			'secret'   => get_option( 'wpep_recaptcha_secret_key' ),
			'response' => $recaptcha_response,
		);
		foreach ( $fields as $key => $value ) {
			$fields_string .= $key . '=' . $value . '&'; }
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, count( $fields ) );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields_string );
		echo curl_exec( $ch );
		curl_close( $ch );

		wp_die();

}


function wpep_single_square_payment( $square_customer_id = false, $square_customer_card_on_file = false, $current_form_id = false, $amount = false ) {

	$subscription           = false;
	$scheduled_subscription = false;
	$form_values            = $_POST['form_values'];
	$verificationToken      = $_POST['buyer_verification'];
	$payment_type           = $_POST['payment_type'];

	/* If $square_customer_id and $square_customer_card_on_file is true and rest is false it means it's first subscription charge */
	if ( $square_customer_id !== false && $square_customer_card_on_file !== false && $current_form_id == false && $amount == false ) {
		$subscription = true;
	}

	 /* If $square_customer_id, $square_customer_card_on_file, $current_form_id and $amount are true it means it's scheduled subscription charge */
	if ( $square_customer_id !== false && $square_customer_card_on_file !== false && $current_form_id !== false && $amount !== false ) {
		$scheduled_subscription = true;
	}

	if ( $current_form_id == false ) {

		$current_form_id = $_POST['current_form_id'];

	}
	$refresh_token_details = wpep_refresh_token_details( $current_form_id );

	if ( count( $refresh_token_details ) !== 0 ) {

		$expires_at    = $refresh_token_details['expires_at'];
		$refresh_token = $refresh_token_details['refresh_token'];
		$type          = $refresh_token_details['type'];

		$response = wpep_square_refresh_token( $expires_at, $refresh_token, $type, $current_form_id );

	}

	$apiClient   = wpep_setup_square_configuration_by_form_id( $current_form_id );
	$location_id = wpep_get_location_by_form_id( $current_form_id );

	$payments_api = new \SquareConnect\Api\PaymentsApi( $apiClient );
	$body         = new \SquareConnect\Model\CreatePaymentRequest();

	if ( ! empty( $_POST ) && $amount == false && isset( $_POST['nonce'] ) ) {

		$nonce  = $_POST['nonce'];
		$amount = floatval( str_replace( ',', '', $_POST['amount'] ) );

		$signup_amount = floatval( str_replace( ',', '', $_POST['signup_amount'] ) );
		$body->setSourceId( $nonce );

	}


	if ( ! empty( $_POST ) && isset( $_POST['card_on_file'] ) ) {

		$amount                       = $_POST['amount'];
		$signup_amount 				  = $_POST['signup_amount'];
		$square_customer_id           = $_POST['square_customer_id'];
		$square_customer_card_on_file = $_POST['card_on_file'];
		$square_customer_card_on_file = str_replace( 'doc:', 'ccof:', $square_customer_card_on_file );
		$body->setCustomerId( $square_customer_id );
		$body->setSourceId( $square_customer_card_on_file );
	}

	if ( $subscription || $scheduled_subscription ) {

		$body->setCustomerId( $square_customer_id );
		$square_customer_card_on_file = str_replace( 'doc:', 'ccof:', $square_customer_card_on_file );
		$body->setSourceId( $square_customer_card_on_file );

	}

	$square_currency = wpep_get_currency( $current_form_id );
	$amountMoney     = new \SquareConnect\Model\Money();
	if ( 'JPY' !== $square_currency ) {
		$amount = $amount * 100;
		//$signup_amount = $signup_amount * 100;
	}
	//$amount        = (string) $amount;
	$amount        = (int) $amount;
	$signup_amount = (float) $signup_amount;
	$report_amount = $amount;
	$report_signup_amount = $signup_amount;
	$amountMoney->setAmount( $amount );
	$amountMoney->setCurrency( $square_currency );
	$body->setAmountMoney( $amountMoney );
	$body->setLocationId( $location_id );

	$save_card = $_POST['save_card'];

	if ( $payment_type == 'single' && 'true' !== $save_card ) {
		$body->setVerificationToken( $verificationToken );
	}

	$note               = get_post_meta( $current_form_id, 'wpep_transaction_notes_box', true );
	$fees_data          = get_post_meta( $current_form_id, 'fees_data' );
	$form_values_object = (object) $form_values;


	foreach ( $form_values_object as $form_value ) {

		if ( isset( $form_value['label'] ) && isset( $form_value['value'] ) ) {

				$label = $form_value['label'];
				$value = $form_value['value'];
			

			if ( $label !== null ) {

				if ( $label == 'Email' ) {
					$label = 'user_email';
					$to    = $value;
				}
				$tag  = '[' . str_replace( ' ', '_', strtolower( $label ) ) . ']';
				$note = str_replace( $tag, $value, $note );

				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					foreach ( $fees_data[0]['name'] as $key => $fees ) {
						$fees_name  = isset( $fees_data[0]['name'][ $key ] ) ? $fees_data[0]['name'][ $key ] : '';
						$fees_value = isset( $fees_data[0]['value'][ $key ] ) ? $fees_data[0]['value'][ $key ] : '';
						$fees_type = isset( $fees_data[0]['type'][ $key ] ) ? $fees_data[0]['type'][ $key ] : '';
						if ( 'percentage' == $fees_type ) {
							$fees_type = '%';
						} else {
							$fees_type = 'fixed';
						}

						$note       = str_replace( '[' . $fees_name . ']', $fees_value . ' ' . $fees_type, $note );
					}
				}
			}

		}
	}

	if ( $scheduled_subscription ) {
		$body->setNote( 'Scheduled Payment' );
	} else {
		$body->setNote( $note );
	}

	$body->setIdempotencyKey( uniqid() );

	$subscription_cycle_interval = get_post_meta( $current_form_id, 'wpep_subscription_cycle_interval', true );
	$subscription_cycle          = get_post_meta( $current_form_id, 'wpep_subscription_cycle', true );
	$subscription_cycle_length   = get_post_meta( $current_form_id, 'wpep_subscription_length', true );

	$NUM_OF_ATTEMPTS = 5;
	$attempts        = 0;

	do {

		try {

			$creds        = wpep_get_creds( $current_form_id );
			$access_token = $creds['access_token'];

			$ch = curl_init();

			curl_setopt( $ch, CURLOPT_URL, $creds['url'] . '/v2/orders' );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_POST, 1 );

			$data = array(
				'idempotency_key' => uniqid(),
				'order'           =>
				array(
					'location_id' => $location_id,
					'line_items'  =>
					array(
						0 =>
						array(
							'name'             => 'WPEP Order ' . uniqid(),
							'quantity'         => '1',
							'base_price_money' =>
							array(
								'amount'   => $amount,
								'currency' => $square_currency,
							),
						),
					),
				),
			);

			curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $data ) );

			$headers   = array();
			$headers[] = 'Square-Version: 2021-02-26';
			$headers[] = 'Authorization: Bearer ' . $access_token;
			$headers[] = 'Content-Type: application/json';
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

			$result = curl_exec( $ch );

			$order_id = json_decode( $result )->order->id;

			if ( curl_errno( $ch ) ) {
				echo 'Error:' . curl_error( $ch );
			}
			curl_close( $ch );

			$body->setOrderId( $order_id );

			$result             = $payments_api->createPayment( $body );
			$transaction_id     = $result->getPayment()->getId();
			$transaction_status = $result->getPayment()->getStatus();
			$transaction_data   = array(
				'transaction_id'     => $transaction_id,
				'transaction_status' => $transaction_status,
			);

			if ( $scheduled_subscription ) {
				return $transaction_data;
			}


			/* Adding Subscription Report */
			if ( 'subscription' == $payment_type || 'donation_recurring' == $payment_type ) {

				foreach ( $form_values as $value ) {

					if ( $value['label'] == 'total_amount' ) {

						$report_amount = $value['value'];
					}
				}

				if ( empty( $card_data ) && isset( $square_customer_id ) && isset( $square_customer_card_on_file ) ) {

					$result = wpep_retrieve_square_customer_result( $apiClient, $square_customer_id );
					$cards  = $result->getCustomer()->getCards();

					foreach ( $cards as $card ) {

						if ( $square_customer_card_on_file == $card->getId() ) {

							$card_data['card_brand'] = $card->getCardBrand();
							$card_data['last_4']     = $card->getLast4();
							$card_data['exp_month']  = $card->getExpMonth();
							$card_data['exp_year']   = $card->getExpYear();

						}
					}
				} else {

					$card_data = $_POST['card_data'];
				}

				$subscription_report_data = array(

					'first_name'                  => $_POST['first_name'],
					'last_name'                   => $_POST['last_name'],
					'email'                       => $_POST['email'],
					'transaction_id'              => $transaction_id,
					'subscription_cycle_interval' => $subscription_cycle_interval,
					'subscription_cycle'          => $subscription_cycle,
					'subscription_cycle_length'   => $subscription_cycle_length,
					'square_customer_id'          => $square_customer_id,
					'square_card_on_file'         => $square_customer_card_on_file,
					'current_form_id'             => $current_form_id,
					'amount'                      => $report_amount,
					'signup_amount'               => $report_signup_amount,
					'discount'                    => isset( $_POST['discount'] ) ? $_POST['discount'] : 0,
					'card_brand'                  => $card_data['card_brand'],
					'last_4'                      => $card_data['last_4'],
					'exp_month'                   => $card_data['exp_month'],
					'exp_year'                    => $card_data['exp_year'],
					'form_values'                 => $form_values,
					'currency'		  			  => $square_currency
				);

				// adding additional tax values to subscription reports
				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					$subscription_report_data['taxes'] = $fees_data[0];
				}

				require_once WPEP_ROOT_PATH . 'modules/reports/subscription_report.php';
				$subscription_report_id = wpep_add_subscription_report( $subscription_report_data );

				$personal_information = array(
					'first_name'      => $_POST['first_name'],
					'last_name'       => $_POST['last_name'],
					'email'           => $_POST['email'],
					'amount'          => $report_amount,
					'signup_amount'   => $report_signup_amount,
					'discount'        => isset( $_POST['discount'] ) ? $_POST['discount'] : 0,
					'current_form_id' => $current_form_id,
					'form_values'     => $form_values,
					'currency'		  => $square_currency
				);

				// adding additional tax values to subscription reports
				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					$personal_information['taxes'] = $fees_data[0];
				}

				require_once WPEP_ROOT_PATH . 'modules/reports/cron_transaction_report.php';
				wpep_add_cron_subscription_transaction( $transaction_data, $subscription_report_id, $personal_information );

				require_once WPEP_ROOT_PATH . 'modules/payments/subscriptions_cron_job.php';
				wpep_schedule_subscription_payments();

				require_once WPEP_ROOT_PATH . 'modules/email_notifications/admin_email.php';
				wpep_send_admin_email( $current_form_id, $form_values, $transaction_id );

				require_once WPEP_ROOT_PATH . 'modules/email_notifications/user_email.php';
				wpep_send_user_email( $current_form_id, $form_values, $transaction_id );

			}

			$enable_mailchimp = get_option( 'wpep_enable_mailchimp', true );
			$apiKey = get_option( 'wpep_mailchimp_api_key', false );
			$server = get_option( 'wpep_mailchimp_server', false );
			$list_id = get_post_meta( $current_form_id, 'wpep_mailchimp_audience', true );


			if ( isset( $enable_mailchimp ) && $enable_mailchimp == 'on' && isset ( $list_id ) && $list_id !== 'please_select' ){

				try {

					$client = new MailchimpMarketing\ApiClient();
					$client->setConfig([
						'apiKey' => $apiKey,
						'server' => $server,
					]);

					$response = $client->lists->addListMember($list_id, [
						"email_address" => $_POST['email'],
						"status" => "subscribed",
						"merge_fields" => [
						"FNAME" => $_POST['first_name'],
						"LNAME" => $_POST['last_name']
						]
					]);

				} catch (MailchimpMarketing\ApiException $e) {
					// echo $e->getMessage();
				} catch (GuzzleHttp\Exception\ClientException $clientEx) {
					//  echo $clientEx->getMessage();
				} catch (GuzzleHttp\Exception\ConnectException $connectionEx) {
					//  echo $connectionEx->getMessage();
				}

			}

			/* Adding Single Transaction Report */
			if ( 'single' == $payment_type || 'donation' == $payment_type ) {

				foreach ( $form_values as $value ) {

					if ( isset( $value['label'] ) ) {

						if ( $value['label'] == 'total_amount' ) {
							$report_amount = $value['value'];
						}
					}
				}				

				$type_of_payment = get_post_meta( $current_form_id, 'wpep_square_payment_type', true );
				if( 'donation' == $type_of_payment ) {
					$wpep_donation_goal_switch = get_post_meta( $current_form_id, 'wpep_donation_goal_switch', true );
					$wpep_donation_goal_amount = get_post_meta( $current_form_id, 'wpep_donation_goal_amount', true );
					if ( 'checked' == $wpep_donation_goal_switch && ! empty( trim($wpep_donation_goal_amount) ) ) {	
						$achieved_amount = floatval( ! empty ( get_post_meta( $current_form_id, 'wpep_donation_goal_achieved', true ) ) ? get_post_meta( $current_form_id, 'wpep_donation_goal_achieved', true ) : 0 );
						$paid_amount = str_replace(',', '', $report_amount );
						$achieving_amount = floatval( $paid_amount ) + $achieved_amount;	
						update_post_meta( $current_form_id, 'wpep_donation_goal_achieved', $achieving_amount );
					}
				}

				$personal_information = array(
					
					'first_name'      => $_POST['first_name'],
					'last_name'       => $_POST['last_name'],
					'email'           => $_POST['email'],
					'amount'          => $report_amount,
					'signup_amount'   => $report_signup_amount,
					'discount'        => isset( $_POST['discount'] ) ? $_POST['discount'] : 0,
					'current_form_id' => $current_form_id,
					'form_values'     => $form_values,
					'currency'		  => $square_currency
				);

				// adding additional tax values to subscription reports
				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					$personal_information['taxes'] = $fees_data[0];
				}

				require_once WPEP_ROOT_PATH . 'modules/reports/transaction_report.php';
				$wpep_transaction_id = wpep_single_transaction_report( $transaction_data, $current_form_id, $personal_information );

				require_once WPEP_ROOT_PATH . 'modules/email_notifications/admin_email.php';
				wpep_send_admin_email( $current_form_id, $form_values, $transaction_id );

				require_once WPEP_ROOT_PATH . 'modules/email_notifications/user_email.php';
				wpep_send_user_email( $current_form_id, $form_values, $transaction_id );

			}


			$response = array(
				'status'                => 'success',
				'transaction_report_id' => $wpep_transaction_id,
			);
			

			wp_die( json_encode( $response ) );

		} catch ( \SquareConnect\ApiException $e ) {

			wpep_write_log( json_encode( $e->getResponseBody()->errors[0] ) );

			if ( 'too_many_requests' == $e->getResponseBody()->errors[0]->code ) {
				$attempts++;
				sleep(5);
				continue;
			}

			if ( $subscription && ! $save_card ) {

				foreach ( $form_values as $value ) {

					if ( $value['label'] == 'total_amount' ) {

						$report_amount = $value['value'];
					}
				}

				$personal_information = array(

					'first_name'      => $_POST['first_name'],
					'last_name'       => $_POST['last_name'],
					'email'           => $_POST['email'],
					'amount'          => $report_amount,
					'signup_amount'   => $report_signup_amount,
					'discount'        => isset( $_POST['discount'] ) ? $_POST['discount'] : 0,
					'current_form_id' => $current_form_id,
					'form_values'     => $form_values,
					'currency'		  => $square_currency

				);

				// adding additional tax values to subscription reports
				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					$personal_information['taxes'] = $fees_data[0];
				}

				$subscription_report_data = array(

					'first_name'                  => $_POST['first_name'],
					'last_name'                   => $_POST['last_name'],
					'email'                       => $_POST['email'],
					'transaction_id'              => $transaction_id,
					'subscription_cycle_interval' => $subscription_cycle_interval,
					'subscription_cycle'          => $subscription_cycle,
					'subscription_cycle_length'   => $subscription_cycle_length,
					'square_customer_id'          => $square_customer_id,
					'square_card_on_file'         => $square_customer_card_on_file,
					'current_form_id'             => $current_form_id,
					'amount'                      => $report_amount,
					'signup_amount'               => $report_signup_amount,
					'discount'                    => isset( $_POST['discount'] ) ? $_POST['discount'] : 0,
					'form_values'                 => $form_values,
					'currency'		  => $square_currency
				);

				// adding additional tax values to subscription reports
				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					$subscription_report_data['taxes'] = $fees_data[0];
				}

				require_once WPEP_ROOT_PATH . 'modules/reports/subscription_report.php';
				$subscription_report_id = wpep_add_subscription_report( $subscription_report_data );
				require_once WPEP_ROOT_PATH . 'modules/reports/cron_transaction_report.php';
				wpep_add_cron_subscription_failed_transaction( $subscription_report_id, $personal_information, $e->getResponseBody()->errors[0] );

			}

			if ( ! $subscription || ! $subscription && $save_card ) {

				$personal_information = array(

					'first_name'      => $_POST['first_name'],
					'last_name'       => $_POST['last_name'],
					'email'           => $_POST['email'],
					'amount'          => $_POST['amount'],
					'signup_amount'   => $_POST['signup_amount'],
					'discount'        => isset( $_POST['discount'] ) ? $_POST['discount'] : 0,
					'current_form_id' => $current_form_id,
					'form_values'     => $form_values,
					'currency'		  => $square_currency

				);

				// adding additional tax values to subscription reports
				if ( isset( $fees_data[0] ) && count( $fees_data[0] ) > 0 ) {
					$personal_information['taxes'] = $fees_data[0];
				}

				require_once WPEP_ROOT_PATH . 'modules/reports/transaction_report.php';
				wpep_failed_single_transaction_report( $current_form_id, $personal_information, $e->getResponseBody()->errors[0] );

			}

			$error = array(
				'status' => 'failed',
				'code'   => $e->getResponseBody()->errors[0]->code,
				'detail' => $e->getResponseBody()->errors[0]->detail,
			);

			wp_die( json_encode( $error ) );

		}

		break;

	} while ( $attempts < $NUM_OF_ATTEMPTS );

}


function wpep_subscription_square_payment() {

	$current_form_id = $_POST['current_form_id'];
	$apiClient       = wpep_setup_square_configuration_by_form_id( $current_form_id );

	$first_name = $_POST['first_name'];
	$last_name  = $_POST['last_name'];
	$email      = $_POST['email'];
	$nonce      = $_POST['nonce'];

	$wp_user_id           = email_exists( $email );
	$square_customer_id   = null;
	$square_customer_card = null;
	$verificationToken    = $_POST['buyer_verification'];

	/* Saved Card Charge */
	if ( isset( $_POST['card_on_file'] ) && ! isset( $_POST['nonce'] ) ) {

		$square_customer_card_on_file = $_POST['card_on_file'];
		$square_customer_id           = $_POST['square_customer_id'];
		wpep_single_square_payment( $square_customer_id, $square_customer_card_on_file );

	}

	/* New Card Charge */
	if ( isset( $_POST['nonce'] ) && ! isset( $_POST['card_on_file'] ) ) {

		if ( $wp_user_id ) {

			$stored_square_customer_id    = get_user_meta( $wp_user_id, 'wpep_square_customer_id', true );
			$square_customer_card_on_file = get_user_meta( $wp_user_id, 'wpep_square_customer_cof', true );

			if ( isset( $stored_square_customer_id ) && $stored_square_customer_id != '' ) {

				$square_customer_id = $stored_square_customer_id;

			}

			if ( ! isset( $stored_square_customer_id ) || $stored_square_customer_id == '' ) {

				$square_customer_id = wpep_create_square_customer( $apiClient );
				update_user_meta( $wp_user_id, 'wpep_square_customer_id', $square_customer_id );

			}
		}

		if ( ! $wp_user_id ) {
			$square_customer_id = wpep_create_square_customer( $apiClient );
			$wp_user_id         = wpep_create_wordpress_user( $first_name, $last_name, $email );
			update_user_meta( $wp_user_id, 'wpep_square_customer_id', $square_customer_id );
		}

		if ( $square_customer_id !== null ) {

			$retrieved_customer_id = wpep_retrieve_square_customer_to_verify( $apiClient, $square_customer_id );

			if ( $retrieved_customer_id == false ) {
				$square_customer_id = wpep_create_square_customer( $apiClient );
				update_user_meta( $wp_user_id, 'wpep_square_customer_id', $square_customer_id );
			}

			$square_customer_card_on_file = wpep_create_square_customer_card( $apiClient, $square_customer_id, $nonce, $first_name, $last_name, $verificationToken );


			$save_card = $_POST['save_card'];

			if ( $save_card == 'true' ) {
				wpep_update_cards_on_file( $apiClient, $square_customer_id, $wp_user_id );
			}

			 wpep_single_square_payment( $square_customer_id, $square_customer_card_on_file );

		}
	}

}

function wpep_subscription_status_update() {


	$subscription_id     = $_POST['subscription_id'];
	$subscription_action = $_POST['subscription_action'];

	if ( 'renew' == $subscription_action ) {
		$length = get_post_meta( $subscription_id, 'wpep_subscription_length', true );
		if ( $length ) {			
			update_post_meta( $subscription_id, 'wpep_subscription_status', 'Active' );
			update_post_meta( $subscription_id, 'wpep_subscription_remaining_cycles', $length );
			update_post_meta( $subscription_id, 'wpep_subscription_next_payment', current_time( 'timestamp' ) );
			require_once WPEP_ROOT_PATH . 'modules/payments/subscriptions_cron_job.php';
			wpep_process_subscription_payments();
			wp_die( 'success_renew' );
		}
	}

	if ( 'cancel' == $subscription_action ) {
		$length = get_post_meta( $subscription_id, 'wpep_subscription_length', true );
		if ( $length ) {
			update_post_meta( $subscription_id, 'wpep_subscription_status', 'Cancelled' );
			wp_die( 'success_cancel' );
		}
	}

	if ( 'Paused' == $subscription_action || 'Active' == $subscription_action ) {
		update_post_meta( $subscription_id, 'wpep_subscription_status', $subscription_action );	
	}
	

	wp_die( 'success' );

}

function wpep_payment_refund() {

	$transaction_id = $_POST['transaction_id'];
	$post_id        = $_POST['post_id'];
	$amount         = (float) $_POST['amount'];

	$current_form_id = get_post_meta( $post_id, 'wpep_form_id', true );
	$creds           = wpep_get_creds( $current_form_id );
	$currency        = sanitize_text_field( get_post_meta( $post_id, 'wpep_square_charge_amount', true ) );

	if ( strpos( $currency, '$' ) !== false ) {

		$currency = 'USD';

	} elseif ( strpos( $currency, 'C$' ) !== false ) {

		$currency = 'CAD';

	} elseif ( strpos( $currency, 'A$' ) !== false ) {

		$currency = 'AUD';

	} elseif ( strpos( $currency, '¥' ) !== false ) {

		$currency = 'JPY';

	} elseif ( strpos( $currency, '£' ) !== false ) {

		$currency = 'GBP';

	} else {

		$currency = substr( $currency, -3 );
	}

	if ( 'JPY' !== $currency ){

		$amount         = $amount * 100;

	} 

	$access_token = $creds['access_token'];
	$refund_url   = $creds['url'] . '/v2/refunds';

	$data = array(

		'idempotency_key' => uniqid(),
		'payment_id'      => $transaction_id,
		'amount_money'    => array(
			'amount'   => (int) $amount,
			'currency' => $currency,
		),

	);

	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_URL, $refund_url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $data ) );

	$headers   = array();
	$headers[] = 'Square-Version: 2020-06-25';
	$headers[] = 'Authorization: Bearer ' . $access_token;
	$headers[] = 'Content-Type: application/json';
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

	$result           = curl_exec( $ch );
	$refunded_request = json_decode( $result );

	if ( isset( $refunded_request->errors ) ) {

		$response = array(

			'status' => 'failed',
			'detail' => $refunded_request->errors[0]->detail,

		);

		wp_die( json_encode( $response ) );
	}

	foreach ( $refunded_request as $value ) {
		if ( isset( $value->id ) ) {
			if ( 'APPROVED' === $value->status || 'PENDING' === $value->status ) {
				update_post_meta( $post_id, 'wpep_square_refund_id', $value->id );
				update_post_meta( $post_id, 'wpep_square_refund_status', $value->status );

				$wpep_refunded_amount = get_post_meta( $post_id, 'wpep_refunded_amount', true );
				
				if ( false !== $wpep_refunded_amount && '' !== $wpep_refunded_amount ) {

					$wpep_refunded_amount = $wpep_refunded_amount + $amount;				
					update_post_meta( $post_id, 'wpep_refunded_amount', (int) $wpep_refunded_amount );
				
				} else {

					update_post_meta( $post_id, 'wpep_refunded_amount', (int) $amount );
				}
				
				
				$response = array(
					'status' => 'success',
				);
				wp_die( json_encode( $response ) );
			}
		}
	}

	if ( curl_errno( $ch ) ) {
		echo 'Error:' . curl_error( $ch );
	}
	curl_close( $ch );
	wp_die();
}


function wpep_get_creds( $wpep_current_form_id ) {

	$form_payment_global = get_post_meta( $wpep_current_form_id, 'wpep_individual_form_global', true );

	if ( $form_payment_global == 'on' ) {

		$global_payment_mode = get_option( 'wpep_square_payment_mode_global', true );

		if ( $global_payment_mode == 'on' ) {

			/* If Global Form Live Mode */
			$accessToken = get_option( 'wpep_live_token_upgraded', true );

			$creds['access_token'] = $accessToken;
			$creds['url']          = 'https://connect.squareup.com';

		}

		if ( $global_payment_mode !== 'on' ) {

			/* If Global Form Test Mode */
			$accessToken = get_option( 'wpep_square_test_token_global', true );

			$creds['access_token'] = $accessToken;
			$creds['url']          = 'https://connect.squareupsandbox.com';

		}
	}

	if ( $form_payment_global !== 'on' ) {

		$individual_payment_mode = get_post_meta( $wpep_current_form_id, 'wpep_payment_mode', true );

		if ( $individual_payment_mode == 'on' ) {

			/* If Individual Form Live Mode */
			$accessToken = get_post_meta( $wpep_current_form_id, 'wpep_live_token_upgraded', true );

			$creds['access_token'] = $accessToken;
			$creds['url']          = 'https://connect.squareup.com';

		}

		if ( $individual_payment_mode !== 'on' ) {

			/* If Individual Form Test Mode */
			$accessToken = get_post_meta( $current_form_id, 'wpep_square_test_token', true );

			$creds['access_token'] = $accessToken;
			$creds['url']          = 'https://connect.squareupsandbox.com';

		}
	}

	return $creds;
}
