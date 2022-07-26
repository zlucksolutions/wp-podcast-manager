<div class="wpep_subscription_details_page wpep_container">

	<div class="wpep_row">

		<div class="wpep_col-12">

			<table class="wp-list-table widefat fixed striped wpep_table_muf">
				<thead>
					<tr>
						<!-- <th class="manage-column">&nbsp;</th> -->
						<th class="manage-column">Transaction ID</th>
						<th class="manage-column">Date</th>
						<th class="manage-column">Status</th>
						<th class="manage-column">Total</th>
					</tr>
				</thead>

				<tbody>

				<?php

					$args = array(

						'post_type'       => 'wpep_reports',
						'post_status'     => 'publish',
						'posts_per_pages' => -1,

					);

					$reports = new wp_Query( $args );

					foreach ( $reports->posts as $report ) {

						$subscription_post_id = get_post_meta( $report->ID, 'wpep_subscription_post_id', true );

						if ( $subscription_post_id == get_the_ID() ) {

							echo '<tr>';
							echo "<td><a href='" . get_edit_post_link( $report->ID ) . "'>#" . $report->ID . '</a></td>';
							echo '<td>' . $report->post_date . '</td>';

							if ( $report->wpep_transaction_status == 'COMPLETED' ) {

								echo '<td><span class="wpep_success_text">' . $report->wpep_transaction_status . '</span></td>';

							} else {

								echo '<td><span class="wpep_failed_text">' . $report->wpep_transaction_status . '</span></td>';
							}

							echo '<td>' . $report->wpep_square_charge_amount . '</td>';
							echo '</tr>';

						}
					}

					?>

				</tbody>
			</table>

		</div>

	</div>

</div>
