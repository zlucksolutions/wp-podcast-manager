<?php

/**
 * WP EASY PAY
 * PHP version 7
 * Plugin Name: WP Easy Pay (Free)
 * Plugin URI: https://wpeasypay.com/demo/
 * Description: Easily collect payments for Simple Payment or donations online
 * without coding it yourself or hiring a developer. Skip setting up a complex shopping cart system.
 * Author: WP Easy Pay
 * Author URI: https://wpeasypay.com/
 * Version: 4.0.2
 * Text Domain: wp_easy_pay
 * License: GPLv2 or later
 *
 * @category Wordpress_Plugin
 * @package  WP_Easy_Pay
 * @author   Author <contact@apiexperts.io>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://wpeasypay.com/
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WPEP_ROOT_URL', plugin_dir_url( __FILE__ ) );
define( 'WPEP_ROOT_PATH', plugin_dir_path( __FILE__ ) );


if ( !function_exists( 'wepp_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wepp_fs()
    {
        $switch_to_new = get_option( 'wpep_stn' );
        if ( true == $switch_to_new ) {
            $settings_url = 'edit.php?post_type=wp_easy_pay&page=wpep-settings';
        }else{
            $settings_url = 'admin.php?page=wpep-settings';
        }

        global  $wepp_fs;
        
        if ( !isset( $wepp_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wepp_fs = fs_dynamic_init( array(
                'id'              => '1920',
                'slug'            => 'wp-easy-pay',
                'type'            => 'plugin',
                'public_key'      => 'pk_4c854593bf607fd795264061bbf57',
                'is_premium'      => false,
                'is_premium_only' => false,
                'has_addons'      => false,
                'has_paid_plans'  => false,
                'has_affiliation' => 'selected',
                'menu'            => array(
                'slug'       =>   'edit.php?post_type=wp_easy_pay',
                'first-path' =>   $settings_url,
                'contact'    => false,
                'support'    => false,
                'pricing'    => false,
            ),
                'is_live'         => true,
            ) );
        }
        
        return $wepp_fs;
    }
    
    // Init Freemius.
    wepp_fs();
    // Signal that SDK was initiated.
    do_action( 'wepp_fs_loaded' );
}

$switch_to_new = get_option( 'wpep_stn' );
// $switch_to_new = false;
if( true == $switch_to_new ) {

    if ( !function_exists( 'add_viewport_meta_tag' ) ) {
        function add_viewport_meta_tag()
        {
            echo  '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />' ;
        }

    }
    add_action( 'wp_head', 'add_viewport_meta_tag', '1' );
    register_activation_hook( __FILE__, 'wpep_plugin_activation' );
    function wpep_plugin_activation()
    {
        wpep_create_example_form();
    }

    function wpep_create_example_form()
    {
        $post_id = post_exists( 'Example Form' );
        
        if ( $post_id == 0 ) {
            $my_post = array(
                'post_title'   => 'Example Form',
                'post_content' => 'This is to demnstrate how a form is created. Do not forget to connect your Square account in Square connect menu.',
                'post_status'  => 'publish',
                'post_type'    => 'wp_easy_pay',
            );
            // Insert the post into the database.
            $post_ID = wp_insert_post( $my_post );
            update_post_meta( $post_ID, 'wpep_individual_form_global', 'on' );
            update_post_meta( $post_ID, 'wpep_square_payment_box_1', '100' );
            update_post_meta( $post_ID, 'wpep_square_payment_box_2', '200' );
            update_post_meta( $post_ID, 'wpep_square_payment_box_3', '300' );
            update_post_meta( $post_ID, 'wpep_square_payment_box_4', '400' );
            update_post_meta( $post_ID, 'wpep_square_payment_type', 'simple' );
            update_post_meta( $post_ID, 'wpep_square_form_builder_fields', '[ { "type": "text", "required": true, "label": "First Name", "className": "form-control", "name": "wpep-first-name-field", "subtype": "text", "hideLabel": "yes" }, { "type": "text", "required": true, "label": "Last Name", "className": "form-control", "name": "wpep-last-name-field", "subtype": "text", "hideLabel": "yes" }, { "type": "text", "subtype": "email", "required": true, "label": "Email", "className": "form-control", "name": "wpep-email-field", "hideLabel": "yes" } ]' );
            update_post_meta( $post_ID, 'wpep_payment_success_msg', 'The example payment form has been submitted successfully' );
        }

    }

    require_once WPEP_ROOT_PATH . 'wpep_setup.php';
    require_once WPEP_ROOT_PATH . 'modules/vendor/autoload.php';
    require_once WPEP_ROOT_PATH . 'modules/payments/square_authorization.php';
    require_once WPEP_ROOT_PATH . 'modules/payments/square_payments.php';
    require_once WPEP_ROOT_PATH . 'modules/render_forms/form_render_shortcode.php';
    require_once WPEP_ROOT_PATH . 'modules/admin_notices/ssl_notice.php';
    require_once WPEP_ROOT_PATH . 'modules/admin_notices/square_oauth_notice.php';

    add_action(
        'plugins_loaded',
        'wpep_set_refresh_token_cron',
        10,
        2
    );
    add_action(
        'wpep_weekly_refresh_tokens',
        'wpep_weekly_refresh_tokens',
        10,
        2
    );

    if ( isset( $_REQUEST['post'] ) ) {
        $post_type = get_post_type( $_REQUEST['post'] );
    }

    if ( isset( $_REQUEST['post_type'] ) ) {
        $post_type = $_REQUEST['post_type'];
    }

    if ( isset( $post_type ) ) {
        
        if ( $post_type == 'wp_easy_pay' ) {
            add_action( 'edit_form_after_editor', 'wpep_render_add_form_ui' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_scripts_easy_pay_type_only' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_stylesheets' );
        }
        
        
        if ( $post_type == 'wpep_reports' ) {
            add_action( 'admin_enqueue_scripts', 'wpep_include_stylesheets' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_reports_scripts' );
        }
        
        
        if ( $post_type == 'wpep_subscriptions' ) {
            add_action( 'admin_enqueue_scripts', 'wpep_include_stylesheets' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_scripts_subscription_type_only' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_reports_scripts' );
        }
        
        
        if ( $post_type == 'wpep_coupons' ) {
            add_action( 'edit_form_after_editor', 'wpep_render_add_coupon_ui' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_scripts_easy_pay_type_only' );
            add_action( 'admin_enqueue_scripts', 'wpep_include_stylesheets' );
        }

    }

    function wpep_render_add_coupon_ui()
    {
        require_once WPEP_ROOT_PATH . '/views/backend/coupon_meta_view.php';
    }

    function wpep_set_refresh_token_cron()
    {
        if ( ! wp_next_scheduled( 'wpep_weekly_refresh_tokens' ) ) {
            wp_schedule_event( time(), 'weekly', 'wpep_weekly_refresh_tokens' );
        }
    }

    function wpep_include_reports_scripts()
    {
        wp_enqueue_script(
            'wpep_reports_scripts',
            WPEP_ROOT_URL . 'assets/backend/js/reports_scripts.js',
            array(),
            '3.0.0',
            true
        );
    }

    function wpep_include_stylesheets()
    {
        wp_enqueue_style(
            'wpep_backend_style',
            WPEP_ROOT_URL . 'assets/backend/css/wpep_backend_styles.css',
            array(),
            '1.0.0'
        );
    }

    function wpep_include_scripts_easy_pay_type_only()
    {
        wp_enqueue_script(
            'wpep_form-builder',
            WPEP_ROOT_URL . 'assets/backend/js/form-builder.min.js',
            array(),
            '3.0.0',
            true
        );
        wp_enqueue_script(
            'ckeditor',
            'https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js',
            array(),
            '1.0.0',
            true
        );
        wp_enqueue_script(
            'wpep_backend_scripts_multiinput',
            WPEP_ROOT_URL . 'assets/backend/js/wpep_backend_scripts_multiinput.js',
            array(),
            '3.0.0',
            true
        );
        $post_type = get_post_type( get_the_ID() );
        
        if ( 'wpep_coupons' === $post_type ) {
            wp_enqueue_style(
                'wpep_multiselect_style',
                WPEP_ROOT_URL . 'assets/backend/css/wpep_multiselect.css',
                array(),
                '3.0.0'
            );
            wp_enqueue_style(
                'wpep_jquery-ui_style',
                '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
                array(),
                '3.0.0'
            );
            wp_enqueue_script( 'jquery-ui-datepicker' );
            wp_enqueue_script(
                'wpep_multiselect_script',
                WPEP_ROOT_URL . 'assets/backend/js/wpep_multiselect.min.js',
                array(),
                '3.0.0',
                true
            );
            wp_enqueue_script(
                'wpep_backend_coupon_script',
                WPEP_ROOT_URL . 'assets/backend/js/wpep_backend_coupon_script.js',
                array(),
                '3.0.0',
                true
            );
        }
        
        wp_enqueue_script(
            'wpep_backend_script',
            WPEP_ROOT_URL . 'assets/backend/js/wpep_backend_scripts.js',
            array(),
            '3.0.0',
            true
        );
        if ( 'wp_easy_pay' === $post_type || 'wpep_coupons' === $post_type ) {
            wp_localize_script( 'wpep_backend_script', 'wpep_hide_elements', array(
                'ajax_url'          => admin_url( 'admin-ajax.php' ),
                'hide_publish_meta' => 'true',
                'wpep_site_url'     => WPEP_ROOT_URL,
            ) );
        }
        wp_enqueue_script(
            'wpep_jscolor_script',
            WPEP_ROOT_URL . 'assets/backend/js/jscolor.js',
            array(),
            '1.0',
            true
        );
    }

    function wpep_include_scripts_subscription_type_only()
    {
        wp_enqueue_script(
            'wpep_backend_subscription_script',
            WPEP_ROOT_URL . 'assets/backend/js/wpep_subscription_actions.js',
            array(),
            '3.0.0',
            true
        );
    }

    function wpep_render_add_form_ui()
    {
        require_once 'views/backend/form_builder_settings/add_payment_form_custom_fields.php';
    }

    define( "WPEP_SQUARE_PLUGIN_NAME", 'WP_EASY_PAY' );
    define( "WPEP_SQUARE_APP_NAME", 'WP_EASY_PAY_SQUARE_APP' );
    define( "WPEP_MIDDLE_SERVER_URL", 'https://connect.apiexperts.io' );
    define( "WPEP_SQUARE_APP_ID", 'sq0idp-k0r5c0MNIBIkTd5pXmV-tg' );
    define( 'WPEP_SQUARE_TEST_APP_ID', 'sandbox-sq0idb-H_7j0M8Q7PoDNmMq_YCHKQ' );
    add_action( 'init', 'wpep_register_gutenberg_blocks' );
    
    function wpep_register_gutenberg_blocks()
    {
        $args = array(
            'numberposts' => 10,
            'post_type'   => 'wp_easy_pay',
        );
        $latest_books = get_posts( $args );
        $wpep_payment_forms = [];
        $count = 0;
        foreach ( $latest_books as $value ) {
            $wpep_payment_forms[$count]['ID'] = $value->ID;
            $wpep_payment_forms[$count]['title'] = $value->post_title;
            $count++;
        }
        wp_register_script( 'wpep_shortcode_block', WPEP_ROOT_URL . 'assets/backend/js/gutenberg_shortcode_block/build/index.js', array( 'wp-blocks' ) );
        wp_enqueue_script( 'wpep_shortcode_block' );
        $wpep_forms = array(
            'forms' => $wpep_payment_forms,
        );
        wp_localize_script( 'wpep_shortcode_block', 'wpep_forms', $wpep_forms );
    }

    register_block_type( 'wpep/shortcode', array(
        'editor_script'   => 'wpep_shortcode_block',
        'render_callback' => 'custom_gutenberg_render_html',
    ) );
    function custom_gutenberg_render_html( $attributes, $content )
    {
        $shortcode = '[wpep-form id="' . $attributes['type'] . '"]';
        return $shortcode;
    }

} else {

    require_once WPEP_ROOT_PATH . 'wpep_old/wp-easy-pay.php';
}
