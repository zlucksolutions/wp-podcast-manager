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
wp_enqueue_script( 'wpep_backend_js', WPEP_ROOT_URL . 'assets/backend/js/wpep_backend_scripts.js' );

if ( isset( $_POST ) && !empty($_POST) ) {
    $payment_mode = 0;
    $wpep_square_google_pay = 0;
    $wpep_square_apple_pay = 0;
    $wpep_square_master_pass = 0;
    $wpep_square_test_google_pay_global = 0;
    $location_id_test = null;
    if ( isset( $_POST['wpep_square_test_location_id_global'] ) ) {
        $location_id_test = sanitize_text_field( $_POST['wpep_square_test_location_id_global'] );
    }
    $wpep_email_notification = sanitize_text_field( $_POST['wpep_email_notification'] );
    
    if ( isset( $_POST['wpep_square_google_pay'] ) ) {
        $wpep_square_google_pay = sanitize_text_field( $_POST['wpep_square_google_pay'] );
    } else {
        $wpep_square_google_pay = 'off';
    }
    
    
    if ( isset( $_POST['wpep_square_test_master_pass'] ) ) {
        $wpep_square_test_master_pass = sanitize_text_field( $_POST['wpep_square_test_master_pass'] );
    } else {
        $wpep_square_test_master_pass = 'off';
    }
    
    
    if ( isset( $_POST['wpep_square_test_apple_pay'] ) ) {
        $wpep_square_test_apple_pay = sanitize_text_field( $_POST['wpep_square_test_apple_pay'] );
    } else {
        $wpep_square_test_apple_pay = 'off';
    }
    
    if ( isset( $_POST['wpep_square_test_google_pay_global'] ) ) {
        $wpep_square_test_google_pay_global = sanitize_text_field( $_POST['wpep_square_test_google_pay_global'] );
    }
    if ( isset( $_POST['wpep_square_apple_pay'] ) ) {
        $wpep_square_apple_pay = sanitize_text_field( $_POST['wpep_square_apple_pay'] );
    }
    if ( isset( $_POST['wpep_square_master_pass'] ) ) {
        $wpep_square_master_pass = sanitize_text_field( $_POST['wpep_square_master_pass'] );
    }
    if ( isset( $_POST['wpep_square_payment_mode_global'] ) ) {
        $payment_mode = sanitize_text_field( $_POST['wpep_square_payment_mode_global'] );
    }
    
    if ( isset( $_POST['wpep_square_location_id'] ) ) {
        $location_id = sanitize_text_field( $_POST['wpep_square_location_id'] );
        update_option( 'wpep_square_location_id', $location_id );
    }
    
    
    if ( isset( $_POST['wpep_square_currency_test'] ) ) {
        $currency = sanitize_text_field( $_POST['wpep_square_currency_test'] );
        update_option( 'wpep_square_currency_test', $currency );
    }
    
    update_option( 'wpep_square_test_location_id_global', $location_id_test );
    update_option( 'wpep_square_test_google_pay_global', $wpep_square_test_google_pay_global );
    update_option( 'wpep_square_payment_mode_global', $payment_mode );
    update_option( 'wpep_square_google_pay', $wpep_square_google_pay );
    update_option( 'wpep_square_apple_pay', $wpep_square_apple_pay );
    update_option( 'wpep_square_master_pass', $wpep_square_master_pass );
    update_option( 'wpep_email_notification', $wpep_email_notification );

    if ( isset( $wpep_square_test_master_pass ) ) {
        update_option( 'wpep_square_test_master_pass', $wpep_square_test_master_pass );
    }
    
    if ( isset( $wpep_square_test_apple_pay ) ) {
        update_option( 'wpep_square_test_apple_pay', $wpep_square_test_apple_pay );
    }
} else {
    $current_user = wp_get_current_user();
    $wpep_email_notification = $current_user->user_email;
}

$wpep_square_payment_mode_global = get_option( 'wpep_square_payment_mode_global', true );
$wpep_square_google_pay = get_option( 'wpep_square_google_pay', true );
$wpep_square_apple_pay = get_option( 'wpep_square_apple_pay', true );
$wpep_square_master_pass = get_option( 'wpep_square_master_pass', true );
$wpep_square_test_google_pay_global = get_option( 'wpep_square_test_google_pay_global', true );
$wpep_email_notification = get_option( 'wpep_email_notification', false );
$wpep_square_test_master_pass = get_option( 'wpep_square_test_master_pass', false );
$wpep_square_test_apple_pay = get_option( 'wpep_square_test_apple_pay', false );

if ( empty($wpep_email_notification) || false == $wpep_email_notification ) {
    $current_user = wp_get_current_user();
    $wpep_email_notification = $current_user->user_email;
}

$wpep_square_connect_url = wpep_create_connect_url( 'global' );
$wpep_create_connect_sandbox_url = wpep_create_connect_sandbox_url( 'global' );
$live_token = get_option( 'wpep_live_token_upgraded' );
$wpep_sandbox = false;
$info = array(
    "access_token" => $live_token,
    "client_id"    => WPEP_SQUARE_APP_ID,
);
$revoked = 'false';
try {
    $apiClient = wpep_setup_square_with_access_token( $live_token, $wpep_sandbox );
    $locations_api = new \SquareConnect\Api\LocationsApi( $apiClient );
    $locations = $locations_api->listLocations()->getLocations();
} catch ( Exception $e ) {
    if ( 'ACCESS_TOKEN_REVOKED' === $e->getResponseBody()->errors[0]->code || 'UNAUTHORIZED' === $e->getResponseBody()->errors[0]->code ) {
        $revoked = 'true';
    }
}
?>

<form class="wpeasyPay-form" method="post" action="#">
  <div class="contentWrap wpeasyPay">
	<div class="contentHeader">
	  <h3 class="blocktitle">Square Connect</h3>
	  <div class="swtichWrap">
		<input type="checkbox" id="on-off" name="wpep_square_payment_mode_global" class="switch-input" 
		<?php 
if ( $wpep_square_payment_mode_global == 'on' || isset( $_COOKIE['wpep-payment-mode'] ) && 'live' == $_COOKIE['wpep-payment-mode'] ) {
    echo  'checked' ;
}
?>
	   />
		<label for="on-off" class="switch-label">
		  <span class="toggle--on toggle--option wpep_global_mode_switch" data-mode="live">Live Payment</span>
		  <span class="toggle--off toggle--option wpep_global_mode_switch" data-mode="test">Test Payment</span>
		</label>
	  </div>
	</div>
	<div class="contentBlock">
	  <div class="squareSettings">
		<div class="settingBlock">
		  <label>Notifications Email</label>
		  <input type="text" class="form-control" name="wpep_email_notification" value="<?php 
echo  $wpep_email_notification ;
?>" placeholder="abc@domain.com">
		</div>
	  </div>

	  <div class="testPayment paymentView" id="wpep_spmgt">
		<?php 
$wpep_square_test_token = get_option( 'wpep_square_test_token_global' );

if ( $wpep_square_test_token == false ) {
    ?>
			<div class="squareConnect">
			  <div class="squareConnectwrap">
				<h2>Connect your square (sandbox) account now!</h2>
				
				<?php 
    if ( isset( $_GET['type'] ) && 'bad_request.missing_parameter' == $_GET['type'] ) {
        ?>

					<p style="color: red;"> You have denied WP EASY PAY the permission to access your Square account. Please connect again to and click allow to complete OAuth. </p>

				<?php 
    }
    ?>

				<a href="<?php 
    echo  $wpep_create_connect_sandbox_url ;
    ?>" class="btn btn-primary btn-square">Connect Square (sandbox)</a>

				<p><small> The sandbox OAuth is for testing purpose by connecting and activating this you will be able to make test transactions and to see how your form will work for the customers.  </small></p>

			  </div>
			</div>

			<?php 
} else {
    ?>

			<div class="squareConnected">
			  <h3 class="titleSquare">Square is Connected <i class="fa fa-check-square" aria-hidden="true"></i></h3>
			  <div class="wpeasyPay__body">

			<?php 
    
    if ( false != get_option( 'wpep_square_currency_test', false ) ) {
        ?>
				<div class="form-group">
				  <label>Country Currency</label>
				  <select name="wpep_square_test_currency_new" class="form-control" disabled="disabled">
					  <option value="USD" 
					  <?php 
        if ( !empty(get_option( 'wpep_square_currency_test' )) && 'USD' == get_option( 'wpep_square_currency_test' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
						>USD</option>
					  <option value="CAD" 
					  <?php 
        if ( !empty(get_option( 'wpep_square_currency_test' )) && 'CAD' == get_option( 'wpep_square_currency_test' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
						 >CAD</option>
					  <option value="AUD" 
					  <?php 
        if ( !empty(get_option( 'wpep_square_currency_test' )) && 'AUD' == get_option( 'wpep_square_currency_test' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
						 >AUD</option>
					  <option value="JPY" 
					  <?php 
        if ( !empty(get_option( 'wpep_square_currency_test' )) && 'JPY' == get_option( 'wpep_square_currency_test' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
						 >JPY</option>
					  <option value="GBP" 
					  <?php 
        if ( !empty(get_option( 'wpep_square_currency_test' )) && 'GBP' == get_option( 'wpep_square_currency_test' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
						 >GBP</option>
					   <option value="EUR" 
					  <?php 
        if ( !empty(get_option( 'wpep_square_currency_test' )) && 'EUR' == get_option( 'wpep_square_currency_test' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
						 >EUR</option>
				  </select>
				</div>
			  <?php 
    }
    
    ?>

				<?php 
    $all_locations = get_option( 'wpep_test_location_data', false );
    ?>
				<div class="form-group">
				  <label>Location:</label>
				  <select class="form-control" name="wpep_square_test_location_id_global">
					<option>Select Location</option>
					<?php 
    if ( isset( $all_locations ) && !empty($all_locations) && $all_locations !== false ) {
        foreach ( $all_locations as $location ) {
            
            if ( is_array( $location ) ) {
                if ( isset( $location['location_id'] ) ) {
                    $location_id = $location['location_id'];
                }
                if ( isset( $location['location_name'] ) ) {
                    $location_name = $location['location_name'];
                }
            }
            
            
            if ( is_object( $location ) ) {
                if ( isset( $location->id ) ) {
                    $location_id = $location->id;
                }
                if ( isset( $location->name ) ) {
                    $location_name = $location->name;
                }
            }
            
            $saved_location_id = get_option( 'wpep_square_test_location_id_global', false );
            if ( $saved_location_id !== false ) {
                
                if ( $saved_location_id == $location_id ) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
            
            }
            echo  "<option value='" . $location_id . "' {$selected}>" . $location_name . '</option>' ;
        }
    }
    ?>
				  </select>
				</div>
			  </div>
				<?php 
    ?>

			  <div class="btnFooter d-btn">
				<button type="submit" class="btn btn-primary"> Save Settings </button>
				<a href="<?php 
    echo  get_option( 'wpep_square_test_disconnect_url', false ) ;
    ?>" class="btn btnDiconnect">Disconnect
				  Square</a>
			  </div>
			</div>
			<?php 
}

?>

	  </div>

	  <div class="livePayment paymentView" id="wpep_spmgl">
		<?php 
$wpep_square_live_token = get_option( 'wpep_live_token_upgraded' );

if ( $wpep_square_live_token == false ) {
    ?>

		<div class="squareConnect">
		  <div class="squareConnectwrap">
			<h2>Connect your square account now!</h2>

			<?php 
    if ( isset( $_GET['type'] ) && 'bad_request.missing_parameter' == $_GET['type'] ) {
        ?>

			<p style="color: red;"> You have denied WP EASY PAY the permission to access your Square account. Please connect again to and click allow to complete OAuth. </p>

			<?php 
    }
    ?>
			<a href="<?php 
    echo  $wpep_square_connect_url ;
    ?>" class="btn btn-primary btn-square">Connect Square</a>

			<a class="connectSquarePop" href="https://wpeasypay.com/documentation/#global-settings-live-mode" target="_blank">

			How to Connect Your Live Square Account.

			</a>

		  </div>
		</div>

		<?php 
} else {
    ?>

		<div class="squareConnected">
		  <h3 class="titleSquare">Square is Connected <i class="fa fa-check-square" aria-hidden="true"></i></h3>
		  <div class="wpeasyPay__body">

			<?php 
    
    if ( '' != get_option( 'wpep_square_currency_new' ) ) {
        ?>
			<div class="form-group">
			  <label>Country Currency</label>
			  <select name="wpep_square_currency_new" class="form-control" disabled="disabled">
				  <option value="USD" 
				  <?php 
        if ( !empty(get_option( 'wpep_square_currency_new' )) && 'USD' == get_option( 'wpep_square_currency_new' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
					>USD</option>
				  <option value="CAD" 
				  <?php 
        if ( !empty(get_option( 'wpep_square_currency_new' )) && 'CAD' == get_option( 'wpep_square_currency_new' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
					 >CAD</option>
				  <option value="AUD" 
				  <?php 
        if ( !empty(get_option( 'wpep_square_currency_new' )) && 'AUD' == get_option( 'wpep_square_currency_new' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
					 >AUD</option>
				  <option value="JPY" 
				  <?php 
        if ( !empty(get_option( 'wpep_square_currency_new' )) && 'JPY' == get_option( 'wpep_square_currency_new' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
					 >JPY</option>
				  <option value="GBP" 
				  <?php 
        if ( !empty(get_option( 'wpep_square_currency_new' )) && 'GBP' == get_option( 'wpep_square_currency_new' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
					 >GBP</option>

					 <option value="EUR" 
				  <?php 
        if ( !empty(get_option( 'wpep_square_currency_new' )) && 'EUR' == get_option( 'wpep_square_currency_new' ) ) {
            echo  "selected='selected'" ;
        }
        ?>
					 >EUR</option>
			  </select>
			</div>
			<?php 
    }
    
    ?>

			  <?php 
    $all_locations = get_option( 'wpep_live_location_data', false );
    ?>
			<div class="form-group">
			  <label>Location:</label>
			  <select class="form-control" name="wpep_square_location_id">
				<option>Select Location</option>

				  <?php 
    if ( isset( $all_locations ) && !empty($all_locations) && $all_locations !== false ) {
        foreach ( $all_locations as $location ) {
            
            if ( is_array( $location ) ) {
                if ( isset( $location['location_id'] ) ) {
                    $location_id = $location['location_id'];
                }
                if ( isset( $location['location_name'] ) ) {
                    $location_name = $location['location_name'];
                }
            }
            
            
            if ( is_object( $location ) ) {
                if ( isset( $location->id ) ) {
                    $location_id = $location->id;
                }
                if ( isset( $location->name ) ) {
                    $location_name = $location->name;
                }
            }
            
            $saved_location_id = get_option( 'wpep_square_location_id', false );
            if ( $saved_location_id !== false ) {
                
                if ( $saved_location_id == $location_id ) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
            
            }
            echo  "<option value='" . $location_id . "' {$selected}>" . $location_name . '</option>' ;
        }
    }
    ?>

			  </select>
			</div>
		  </div>

		  <?php 
    ?>

		<?php 
    if ( $revoked == 'true' ) {
        ?>
        <p style="color: red;"> Seems like your OAuth token is revoked by Square. Please disconnect your account and reconnect to resolve the issue or contact support.  </p>
        <?php 
    }
    ?>

		<?php 
    if ( $revoked !== 'true' ) {
        ?>
		<?php 
    }
    ?>
		<div class="btnFooter d-btn">
		  <button type="submit" class="btn btn-primary"> Save Settings </button>
		  <a href="<?php 
    echo  get_option( 'wpep_square_disconnect_url', false ) ;
    ?>" class="btn btnDiconnect">Disconnect
			Square</a>
		</div>
			
			<?php 
}

?>
	  </div>

	</div>
</form>
</div>