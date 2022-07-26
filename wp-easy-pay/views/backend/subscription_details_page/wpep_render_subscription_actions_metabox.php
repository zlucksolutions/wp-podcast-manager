<?php
	$subscription_id = get_the_ID();
	$status          = get_post_meta( $subscription_id, 'wpep_subscription_status', true );
	$next_payment    = get_post_meta( $subscription_id, 'wpep_subscription_next_payment', true );
	$status          = get_post_meta( $subscription_id, 'wpep_subscription_status', true );
	$start_date      = get_post_meta( $subscription_id, 'wpep_subscription_start_date', true );
?>

<div class="wpep_subscription_details_page wpep_container">

	<div class="wpep_row m-0">

		<div class="wpep_col-12">
		<div class="sep30px">&nbsp;</div>
			<h3 class="wpep_title">Schedule</h3 class="wpep_title">
			<div class="sep30px">&nbsp;</div>
		</div>

		<div class="wpep_col-12 ifnospace">
			<span class="wpep_label"><strong>Current Status:</strong> <strong><?php echo $status; ?></strong></span>
			<span class="wpep_label"><strong>Start Date:</strong> <?php echo date( 'M d, Y', $start_date ); ?> </span>
			<span class="wpep_label"><strong>Next Payment:</strong> <?php echo date( 'M d, Y', $next_payment ); ?></span>
			<div class="sep30px">&nbsp;</div>
		</div>

		<div class="wpep_col-12">
			<div class="wpep-btn-wrap">

				<?php

				if ( $status == 'Active' ) {

					$status_button = "<input type='button' value='Cancel' data-action='cancel' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-danger' />
					<input type='button' value='Pause' data-action='Paused' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-warning' />";
				}

				if ( $status == 'Completed' || $status == 'Cancelled' ) {
					$status_button   = "<input type='button' value='Renew Now' data-action='renew' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-success' />";
				}

				if ( $status == 'Paused' ) {

					$status_button = "<input type='button' value='Cancel' data-action='cancel' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-danger' />
					<input type='button' value='Start' data-action='Active' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-success' />";
				}


				/*** new ****/


				/*if ( $status == 'Active' ) {

					$status_button = "<input type='button' value='Pause' data-action='Paused' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-warning' />";
				}

				if ( $status == 'Paused' ) {

					$status_button = "<input type='button' value='Start' data-action='Active' data-subscription='$subscription_id' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-success' />";


				}

				if ( $status == 'Completed' || $status == 'Cancelled' ) {

					$status_button = "<input type='button' value='Completed' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-success' />";

				}*/


					echo $status_button;
				?>

			
			</div> 
		</div>

	</div>

</div> 
