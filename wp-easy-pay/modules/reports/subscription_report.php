<?php

function wpep_add_subscription_report( $report_data ) {

	$cycle_interval = $report_data['subscription_cycle_interval'];
	$cycle          = $report_data['subscription_cycle'];
	$status         = 'Active';

	$subscription_report = array (

		'post_title'  => $report_data['transaction_id'],
		'post_type'   => 'wpep_subscriptions',
		'post_status' => 'publish',
	);

	$report_id = wp_insert_post( $subscription_report );

	if ( $report_data['subscription_cycle_length'] > 0 && $report_data['subscription_cycle_length'] !== 'never_expire' ) {

		$remaining_cycles = $report_data['subscription_cycle_length'] - 1;
	}

	$today_date = new DateTime();
	$today_date->setTimestamp( current_time( 'timestamp' ) );
	update_post_meta( $report_id, 'wpep_subscription_start_date', $today_date->getTimestamp() );
	$today_date->modify( "+$cycle_interval $cycle" );
	$next_payment_date = $today_date->getTimestamp();
	$form_type         = get_post_meta( $report_data['current_form_id'], 'wpep_square_payment_type', true );

	if ( $report_data['subscription_cycle_length'] == 0 && $report_data['subscription_cycle_length'] !== 'never_expire' ) {

		$status            = 'Completed';
		$next_payment_date = '-';
	}

	parse_str( $report_data['form_values'], $form_values );

	update_post_meta( $report_id, 'wpep_subscription_interval', $cycle_interval );
	update_post_meta( $report_id, 'wpep_subscription_cycle', $cycle );
	update_post_meta( $report_id, 'wpep_subscription_length', $report_data['subscription_cycle_length'] );
	update_post_meta( $report_id, 'wpep_subscription_remaining_cycles', $remaining_cycles );
	update_post_meta( $report_id, 'wpep_first_name', $report_data['first_name'] );
	update_post_meta( $report_id, 'wpep_last_name', $report_data['last_name'] );
	update_post_meta( $report_id, 'wpep_email', $report_data['email'] );
	update_post_meta( $report_id, 'wpep_subscription_next_payment', $next_payment_date );
	update_post_meta( $report_id, 'wpep_subscription_status', $status );
	update_post_meta( $report_id, 'wpep_current_form_id', $report_data['current_form_id'] );
	update_post_meta( $report_id, 'wpep_form_id', $report_data['current_form_id'] );
	update_post_meta( $report_id, 'wpep_square_customer_id', $report_data['square_customer_id'] );
	update_post_meta( $report_id, 'wpep_square_card_on_file', $report_data['square_card_on_file'] );
	update_post_meta( $report_id, 'wpep_square_charge_amount', $report_data['amount'] );
	update_post_meta( $report_id, 'wpep_square_signup_amount', $report_data['signup_amount'] );
	update_post_meta( $report_id, 'wpep_square_discount', $report_data['discount'] );
	update_post_meta( $report_id, 'wpep_charge_currency', $report_data['currency'] );

	
	if ( isset($report_data['taxes']) ) {
		update_post_meta( $report_id, 'wpep_square_taxes', $report_data['taxes'] );
	}
	update_post_meta( $report_id, 'wpep_form_values', $form_values );
	update_post_meta( $report_id, 'wpep_form_type', $form_type );
	update_post_meta( $report_id, 'wpep_card_brand', $report_data['card_brand'] );
	update_post_meta( $report_id, 'wpep_last_4', $report_data['last_4'] );
	update_post_meta( $report_id, 'wpep_exp_month', $report_data['exp_month'] );
	update_post_meta( $report_id, 'wpep_exp_year', $report_data['exp_year'] );

	return $report_id;

}
