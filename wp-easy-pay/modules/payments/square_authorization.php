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

// require_once WPEP_ROOT_PATH . 'modules/payments/square_configuration.php';

add_action('admin_init', 'wpep_authorize_with_square');
add_action('admin_init', 'wpep_square_callback_success');
add_action('admin_init', 'wpep_square_disconnect');

function wpep_authorize_with_square()
{ 
    
    if (!empty($_GET['wpep_prepare_connection_call'])) {

      
 
        $urlIdentifiers = $_REQUEST;
        $urlIdentifiers['oauth_version'] = 2;
        $urlIdentifiers['wp_nonce'] = esc_attr(wp_create_nonce(rand(10,100)));
        unset($urlIdentifiers['wpep_prepare_connection_call']);
        $redirectUrl = add_query_arg($urlIdentifiers, admin_url($urlIdentifiers['wpep_admin_url']));

        $redirectUrl = wp_nonce_url($redirectUrl, 'connect_wpep_square', 'wpep_square_token_nonce');
        $usf_state = substr( str_shuffle( 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' ), 1, 10 );
        $middleServerData = array (

            'redirect' => urlencode($redirectUrl),
            'scope' => urlencode('MERCHANT_PROFILE_READ PAYMENTS_READ PAYMENTS_WRITE CUSTOMERS_READ CUSTOMERS_WRITE ORDERS_WRITE'),
            'plug' =>  WPEP_SQUARE_PLUGIN_NAME,
            'app_name' => WPEP_SQUARE_APP_NAME,
            'oauth_version' => 2,
            'request_type' => 'authorization',
            'usf_state' => $usf_state,

        );


        update_option('wpep_usf_state', $usf_state);

	    if (isset($urlIdentifiers['wpep_sandbox'])) {

		    $middleServerData['sandbox_enabled'] = 'yes';

	    }

        $middleServerUrl = add_query_arg($middleServerData, WPEP_MIDDLE_SERVER_URL);

        $queryArg = array (

            'app_name'    => WPEP_SQUARE_APP_NAME,
            'wpep_disconnect_square' => 1,
            'wpep_disconnect_global' => 'true'

        );

        if(isset($_REQUEST['wpep_page_post']) && !empty($_REQUEST['wpep_page_post']) && $_REQUEST['wpep_page_post'] == 'global') {

            $queryArg['wpep_disconnect_global'] = 'true';
            $queryArg['wpep_disconnect_sandbox_global'] = $urlIdentifiers['wpep_sandbox'];

            $queryArg = array_merge($urlIdentifiers, $queryArg);
            $disconnectUrl = admin_url($urlIdentifiers['wpep_admin_url']);
            $disconnectUrl = add_query_arg($queryArg, $disconnectUrl);

	        if (isset($urlIdentifiers['wpep_sandbox'])) {

		        update_option('wpep_square_test_disconnect_url', $disconnectUrl);

	        } else {

		        update_option('wpep_square_disconnect_url', $disconnectUrl);
	        }

        }

        if(isset($_REQUEST['wpep_page_post']) && !empty($_REQUEST['wpep_page_post']) && $_REQUEST['wpep_page_post'] !== 'global') {

            $queryArg['wpep_disconnect_global'] = 'false';
            $queryArg['wpep_form_id'] = $_REQUEST['wpep_page_post'];

            $queryArg = array_merge($urlIdentifiers, $queryArg);
            $disconnectUrl = admin_url($urlIdentifiers['wpep_admin_url']);
            $disconnectUrl = add_query_arg($queryArg, $disconnectUrl);
            
            update_post_meta($queryArg['wpep_form_id'], 'wpep_square_disconnect_url', $disconnectUrl);

        }

        wp_redirect($middleServerUrl);

    }

}

function wpep_square_callback_success()
{

    if (!empty($_REQUEST['access_token']) and !empty($_REQUEST['token_type']) and !empty($_REQUEST['wpep_square_token_nonce']) and $_REQUEST['token_type'] == 'bearer') {

        if (function_exists('wp_verify_nonce') && ! wp_verify_nonce($_REQUEST['wpep_square_token_nonce'], 'connect_wpep_square') ) {
            wp_die("Looks like the URL is malformed!");
        }

        $usf_state = get_option('wpep_usf_state');

        if ( $usf_state !== $_REQUEST['usf_state'] ) {
            wp_die( 'The request is not coming back from the same origin it was sent to. Try Later' );
        }

        $initialPage = 0;
	    $wpep_sandbox = $_REQUEST['wpep_sandbox'];

        $apiClient = wpep_setup_square_with_access_token($_REQUEST['access_token'], $wpep_sandbox);
        $locations_api = new \SquareConnect\Api\LocationsApi($apiClient);
        $locations = $locations_api->listLocations()->getLocations();
        $all_locations = array ();

        foreach ($locations as $key => $location) {

            $one_location = array (

                'location_id'   =>  $location->getId(),
                'location_name' => $location->getName(),
                'currency'      => $location->getCurrency()
                
            );

            array_push($all_locations, $one_location);
           
        }

        //getting currency from square account dynamically
        update_option('wpep_square_currency_new', $all_locations[0]['currency']);

	    $current_post_id = $_REQUEST['wpep_page_post'];
        if(isset($_REQUEST['wpep_page_post']) && !empty($_REQUEST['wpep_page_post']) && $_REQUEST['wpep_page_post'] !== 'global') {

	        if ('yes' == $wpep_sandbox) {

		        update_post_meta( $current_post_id, "wpep_test_token_details_upgraded", $_REQUEST );
		        update_post_meta( $current_post_id, "wpep_test_location_data", $all_locations );
		        update_post_meta( $current_post_id, 'wpep_square_test_app_id', WPEP_SQUARE_TEST_APP_ID );
		        update_post_meta( $current_post_id, 'wpep_square_test_token', sanitize_text_field( $_REQUEST['access_token'] ) );
		        update_post_meta( $current_post_id, "wpep_test_refresh_token", $_REQUEST['refresh_token'] );
		        update_post_meta( $current_post_id, "wpep_test_token_expires_at", $_REQUEST['expires_at'] );
		        update_post_meta( $current_post_id, 'wpep_post_square_currency_test', $all_locations[0]['currency'] );

	        } else {

		        update_post_meta( $current_post_id, "wpep_live_token_details_upgraded", $_REQUEST );
		        update_post_meta( $current_post_id, "wpep_live_location_data", $all_locations );
		        update_post_meta( $current_post_id, "wpep_live_token_upgraded", sanitize_text_field( $_REQUEST['access_token'] ) );
		        update_post_meta( $current_post_id, "wpep_square_btn_auth", 'true' );
		        update_post_meta( $current_post_id, "wpep_refresh_token", $_REQUEST['refresh_token'] );
		        update_post_meta( $current_post_id, "wpep_token_expires_at", $_REQUEST['expires_at'] );
		        update_post_meta( $current_post_id, "wpep_live_square_app_id", WPEP_SQUARE_APP_ID );
		        update_post_meta( $current_post_id, 'wpep_post_square_currency_new', $all_locations[0]['currency'] );
            }

            $queryArgs = array ( 
                'post' => $_REQUEST['post'],
                'action' => $_REQUEST['action']
            );
            
            $initialPage = add_query_arg($queryArgs, admin_url('post.php'));
        }

        if(isset($_REQUEST['wpep_page_post']) && !empty($_REQUEST['wpep_page_post']) && $_REQUEST['wpep_page_post'] == 'global'){


	        if ('yes' == $wpep_sandbox) {

		        update_option('wpep_test_location_data', $all_locations);
		        update_option('wpep_square_test_token_global', $_REQUEST['access_token']);
		        update_option('wpep_square_test_btn_auth', 'true');
		        update_option('wpep_refresh_test_token', $_REQUEST['refresh_token']);
		        update_option('wpep_token_test_expires_at', $_REQUEST['expires_at']);
		        update_option('wpep_square_test_app_id_global', WPEP_SQUARE_TEST_APP_ID);
		        update_option('wpep_square_currency_test', $all_locations[0]['currency']);

	        } else {

		        update_option('wpep_live_location_data', $all_locations);
		        update_option('wpep_live_token_upgraded', sanitize_text_field($_REQUEST['access_token']));
		        update_option('wpep_square_btn_auth', 'true');
		        update_option('wpep_refresh_token', $_REQUEST['refresh_token']);
		        update_option('wpep_token_expires_at', $_REQUEST['expires_at']);
		        update_option('wpep_live_square_app_id', WPEP_SQUARE_APP_ID);

	        }

            $queryArgs = array ( 

                'page' => $_REQUEST['page'],
                'post_type' => $_REQUEST['wpep_post_type']

            );

            $initialPage = add_query_arg($queryArgs, admin_url('edit.php'));

        }

        wp_redirect($initialPage);

    }

}

function wpep_square_disconnect()
{

    if (!empty($_REQUEST['wpep_disconnect_square'])) {

        if(isset($_REQUEST['wpep_disconnect_global'])) {

            if ($_REQUEST['wpep_disconnect_global'] == 'true') {

	            if (isset($_REQUEST['wpep_sandbox']) && 'yes' == $_REQUEST['wpep_sandbox']) {

                    $access_token = get_option('wpep_square_test_token_global', false);
                    wpep_revoke_access_token($access_token, 'yes');

		            delete_option('wpep_test_location_data');
		            delete_option('wpep_square_test_token_global');
		            delete_option('wpep_square_test_btn_auth');
		            delete_option('wpep_refresh_test_token');
		            delete_option('wpep_token_test_expires_at');

	            } else {

                    $access_token = get_option('wpep_live_token_upgraded', false);
                    wpep_revoke_access_token($access_token, 'live');
                    
		            delete_option('wpep_live_token_details_upgraded');
		            delete_option('wpep_live_token_upgraded');
		            delete_option('wpep_square_btn_auth');
		            delete_option('wpep_refresh_token');
		            delete_option('wpep_token_expires_at');
		            delete_option('wpep_live_location_data');
		            delete_option('wpep_square_currency_new');
	            }
                
                $queryArgs = array (

                    'page' => $_REQUEST['page'],
                    'post_type' => $_REQUEST['wpep_post_type'],
                    
                );
        
                $initialPage = add_query_arg($queryArgs, admin_url('edit.php'));
                
            }
 
            if ($_REQUEST['wpep_disconnect_global'] == 'false') {

	            $form_id = $_REQUEST['wpep_form_id'];

	            if ('yes' == $_REQUEST['wpep_sandbox']) {

                    $access_token = get_post_meta( $form_id, 'wpep_square_test_token' );
                    wpep_revoke_access_token($access_token, 'yes');

		            delete_post_meta( $form_id, "wpep_test_token_details_upgraded" );
		            delete_post_meta( $form_id, "wpep_test_location_data" );
		            delete_post_meta( $form_id, 'wpep_square_test_app_id' );
		            delete_post_meta( $form_id, 'wpep_square_test_token' );
		            delete_post_meta( $form_id, 'wpep_post_square_currency_test' );
		            delete_post_meta( $form_id, 'wpep_test_refresh_token' );
		            delete_post_meta( $form_id, 'wpep_test_token_expires_at' );

	            } else {

                    $access_token = get_post_meta( $form_id, 'wpep_live_token_upgraded' );
                    wpep_revoke_access_token($access_token, 'live');

		            delete_post_meta( $form_id, "wpep_live_token_details_upgraded");
		            delete_post_meta( $form_id, "wpep_live_location_data");
		            delete_post_meta( $form_id, "wpep_live_token_upgraded");
		            delete_post_meta( $form_id, "wpep_square_btn_auth");
		            delete_post_meta( $form_id, "wpep_refresh_token");
		            delete_post_meta( $form_id, "wpep_token_expires_at");
		            delete_post_meta( $form_id, "wpep_live_square_app_id");
                    
	            }

                $queryArgs = array ( 

                    'post' => $_REQUEST['post'],
                    'action' => $_REQUEST['action']

                );
                
                $initialPage = add_query_arg($queryArgs, admin_url('post.php'));
            }
            
        }

        wp_redirect($initialPage);

    }

}


function wpep_revoke_access_token($access_token, $sandbox) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://connect.apiexperts.io/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "oauth_version=2&request_type=revoke_token&app_name=".WPEP_SQUARE_APP_NAME."&sandbox_enabled=".$sandbox."&access_token=".$access_token);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);

}