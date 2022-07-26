<?php

function wpep_delete_user_card()
{
    
    if ( is_user_logged_in() && !empty(sanitize_text_field( $_POST['card_id'] )) ) {
        $current_user = wp_get_current_user();
        $card_id = sanitize_text_field( $_POST['card_id'] );
        $card_on_files = get_user_meta( $current_user->ID, 'wpep_square_customer_cof', true );
        
        if ( !empty($card_on_files) ) {
            $updated_cards = array();
            foreach ( $card_on_files as $card ) {
                if ( $card['card_id'] !== $card_id ) {
                    array_push( $updated_cards, $card );
                }
            }
        }
        
        if ( update_user_meta( $current_user->ID, 'wpep_square_customer_cof', $updated_cards ) ) {
            wp_die( 'success' );
        }
    }
    
    wp_die( 'failed' );
}

function get_wpep_subscription_details()
{
    
    if ( isset( $_POST['subscription_id'] ) && !empty(sanitize_text_field( $_POST['subscription_id'] )) ) {
        $obj = get_post( sanitize_text_field( $_POST['subscription_id'] ) );
        $subscription_id = sanitize_text_field( $_POST['subscription_id'] );
        $status = get_post_meta( $subscription_id, 'wpep_subscription_status', true );
        $next_payment = get_post_meta( $subscription_id, 'wpep_subscription_next_payment', true );
        $status = get_post_meta( $subscription_id, 'wpep_subscription_status', true );
        $start_date = get_post_meta( $subscription_id, 'wpep_subscription_start_date', true );
        $card_brand = get_post_meta( $subscription_id, 'wpep_card_brand', true );
        $last_4 = get_post_meta( $subscription_id, 'wpep_last_4', true );
        $form_id = get_post_meta( $subscription_id, 'wpep_form_id', true );
        if ( $status == 'Active' ) {
            $status_button = "<input type='button' value='cancel' data-action='cancel' data-subscription='{$subscription_id}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-danger' />\n\t\t\t<input type='button' value='Pause' data-action='Paused' data-subscription='{$subscription_id}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-warning' />";
        }
        if ( $status == 'Completed' || $status == 'Cancelled' ) {
            $status_button = "<input type='button' value='Renew Now' data-action='renew' data-subscription='{$subscription_id}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-success' />";
        }
        if ( $status == 'Paused' ) {
            $status_button = "<input type='button' value='cancel' data-action='cancel' data-subscription='{$subscription_id}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-danger' />\n\t\t\t<input type='button' value='Start' data-action='Active' data-subscription='{$subscription_id}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-full wpep-btn-square wpep-btn-success' />";
        }
        ?>
		<table>
			<tbody>
				<tr>
					<th><?php 
        echo  __( 'Status', 'wp_easy_pay' ) ;
        ?></th>
					<td class="wpep_sub_status_<?php 
        echo  $subscription_id ;
        ?>"><span class="<?php 
        echo  $status ;
        ?>"><?php 
        echo  $status ;
        ?></span></td>
				</tr>
				<tr>
					<th><?php 
        echo  __( 'Start Date', 'wp_easy_pay' ) ;
        ?></th>
					<td><?php 
        echo  date( 'M d, Y', $start_date ) ;
        ?></td>
				</tr>
				<tr>
					<th><?php 
        echo  __( 'Form', 'wp_easy_pay' ) ;
        ?></th>
					<td><?php 
        echo  get_the_title( $form_id ) ;
        ?></td>
				</tr>
				<tr>
					<th><?php 
        echo  __( 'Next Payment Date', 'wp_easy_pay' ) ;
        ?></th>
					<td><?php 
        echo  date( 'M d, Y', $next_payment ) ;
        ?></td>
				</tr>
				<tr>
					<th><?php 
        echo  __( 'Payment Details', 'wp_easy_pay' ) ;
        ?></th>
					<td><?php 
        echo  $card_brand . ' ' . $last_4 ;
        ?></td>
				</tr>
				<tr>
					<th><?php 
        echo  __( 'Actions', 'wp_easy_pay' ) ;
        ?></th>
					<td>
						<div class="wpep-btn-wrap"><?php 
        echo  $status_button ;
        ?></div>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<!-- <th class="manage-column">&nbsp;</th> -->
					<th class="manage-column">ID</th>
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
            
            if ( $subscription_post_id == $subscription_id ) {
                print_r( $report );
                echo  '<tr>' ;
                echo  "<td>#" . $report->ID . '</td>' ;
                echo  '<td>' . $report->post_date . '</td>' ;
                
                if ( $report->wpep_transaction_status == 'COMPLETED' ) {
                    echo  '<td><span class="Completed">' . $report->wpep_transaction_status . '</span></td>' ;
                } else {
                    echo  '<td><span class="Failed">' . $report->wpep_transaction_status . '</span></td>' ;
                }
                
                echo  '<td>' . $report->wpep_square_charge_amount . '</td>' ;
                echo  '</tr>' ;
            }
        
        }
        ?>
			</tbody>
		</table>
		<?php 
        wp_die();
    }

}

function show_user_defined_subscription_on_frontend()
{
    if ( !is_admin() ) {
        
        if ( !is_user_logged_in() ) {
            $html = '';
            //$html .= '<h3>' . __( 'Subscriptions', 'wp_easy_pay' ) . '</h3>';
            $html .= '<p>' . __( 'Please logged in to see subscription details.', 'wp_easy_pay' ) . '</p>';
            $html .= '<a href="' . esc_url( wp_login_url( get_permalink() ) ) . '" alt="' . esc_attr__( 'Login', 'wp_easy_pay' ) . '">' . __( 'Login.', 'wp_easy_pay' ) . '</a>';
            return $html;
        } else {
            $current_user = wp_get_current_user();
            $customer_id = get_user_meta( $current_user->ID, 'wpep_square_customer_id', true );
            $card_on_files = get_user_meta( $current_user->ID, 'wpep_square_customer_cof', true );
            $customer_email = $current_user->user_email;
            
            if ( isset( $customer_id ) ) {
                $sub_args = array(
                    'post_type'   => 'wpep_subscriptions',
                    'numberposts' => -1,
                    'meta_query'  => array( array(
                    'key'   => 'wpep_square_customer_id',
                    'value' => $customer_id,
                ) ),
                );
                $subscriptions = get_posts( $sub_args );
                $rep_args = array(
                    'post_type'   => 'wpep_reports',
                    'numberposts' => -1,
                    'meta_query'  => array( array(
                    'key'   => 'wpep_email',
                    'value' => $customer_email,
                ) ),
                );
                $reports = get_posts( $rep_args );
                return render_subscription_frontend_html( $subscriptions, $reports, $card_on_files );
            } else {
                $html = '';
                //$html .= '<h3>' . __( 'Subscriptions', 'wp_easy_pay' ) . '</h3>';
                $html .= '<p>' . __( 'You don\'t have any subscriptions', 'wp_easy_pay' ) . '</p>';
                return $html;
            }
        
        }
    
    }
}

function render_subscription_frontend_html( $subscriptions = null, $reports = null, $card_on_files = null )
{
    ob_start();
    require_once WPEP_ROOT_PATH . 'views/frontend/user_subscriptions.php';
    return ob_get_clean();
}

function wpep_add_subscription_metabox()
{
    add_meta_box(
        'wpep_subscription_details',
        'Subscription Details',
        'wpep_render_subscription_details_render',
        'wpep_subscriptions'
    );
    add_meta_box(
        'wpep_subscription_transactions',
        'Related Transactions',
        'wpep_render_subscription_transactions_render',
        'wpep_subscriptions'
    );
    add_meta_box(
        'wpep_subscription_actions',
        'Subscription Actions',
        'wpep_render_subscription_actions_render',
        'wpep_subscriptions',
        'side',
        'default'
    );
}

add_action( 'add_meta_boxes', 'wpep_add_subscription_metabox' );
function wpep_render_subscription_details_render( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/subscription_details_page/wpep_subscription_details_metabox.php';
}

function wpep_render_subscription_transactions_render( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/subscription_details_page/wpep_subscription_transactions_metabox.php';
}

function wpep_render_subscription_actions_render( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/subscription_details_page/wpep_render_subscription_actions_metabox.php';
}

function wpep_modify_column_names_subscriptions( $columns )
{
    unset( $columns['date'] );
    unset( $columns['title'] );
    $columns['post_id'] = __( 'ID' );
    $columns['paid_by'] = __( 'Paid By' );
    $columns['interval'] = __( 'Subscription Interval' );
    $columns['remaining_cycles'] = __( 'Remaining Cycles' );
    $columns['total_cycles'] = __( 'Total Cycles' );
    $columns['next_payment'] = __( 'Next Payment' );
    $columns['subscription_status'] = __( 'Subscription Status' );
    $columns['form_type'] = __( 'Type' );
    $columns['subscription_actions'] = __( 'Actions' );
    $columns['date'] = __( 'Date' );
    return $columns;
}

function wpep_add_columns_data_subscriptions( $column, $postId )
{
    $interval = get_post_meta( $postId, 'wpep_subscription_interval', true );
    $cycle = get_post_meta( $postId, 'wpep_subscription_cycle', true );
    $length = get_post_meta( $postId, 'wpep_subscription_length', true );
    $first_name = get_post_meta( $postId, 'wpep_first_name', true );
    $last_name = get_post_meta( $postId, 'wpep_last_name', true );
    $email = get_post_meta( $postId, 'wpep_email', true );
    $remaining_cycles = get_post_meta( $postId, 'wpep_subscription_remaining_cycles', true );
    $next_payment = get_post_meta( $postId, 'wpep_subscription_next_payment', true );
    $status = get_post_meta( $postId, 'wpep_subscription_status', true );
    if ( $length == 'never_expire' ) {
        $length = 'Never Expire';
    }
    if ( $remaining_cycles <= 0 ) {
        $remaining_cycles = '-';
    }
    if ( $status == 'Active' ) {
        $status_button = "<input type='button' value='Pause' data-action='Paused' data-subscription='{$postId}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-btn-square wpep-btn-warning' />";
    }
    if ( $status == 'Paused' ) {
        $status_button = "<input type='button' value='Start' data-action='Active' data-subscription='{$postId}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-btn-square wpep-btn-success' />";
    }
    if ( $status == 'Completed' || $status == 'Cancelled' ) {
        $status_button = "<input type='button' value='Renew' data-action='renew' data-subscription='{$postId}' class='wpep_subscription_action wpep-btn wpep-btn-primary wpep-btn-square wpep-btn-success' />";
    }
    switch ( $column ) {
        case 'post_id':
            echo  "<a href='" . get_edit_post_link( $postId ) . "' class='wpep-blue' title='Details'>" . '#' . "{$postId}</a>" ;
            break;
        case 'paid_by':
            echo  $first_name . ' ' . $last_name ;
            break;
        case 'interval':
            echo  $interval . ' ' . $cycle ;
            break;
        case 'remaining_cycles':
            echo  $remaining_cycles ;
            break;
        case 'total_cycles':
            echo  $length ;
            break;
        case 'next_payment':
            echo  ( $next_payment == '-' ? '-' : date( 'Y-m-d h:i:s', $next_payment ) ) ;
            break;
        case 'subscription_status':
            echo  $status ;
            break;
        case 'form_type':
            $form_type = get_post_meta( $postId, 'wpep_form_type', true );
            echo  "<span class='{$form_type}'>" . str_replace( '_', ' ', $form_type ) . '</span>' ;
            break;
        case 'subscription_actions':
            echo  $status_button ;
            break;
    }
}
