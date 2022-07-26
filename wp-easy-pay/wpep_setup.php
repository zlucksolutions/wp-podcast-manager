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
add_action( 'init', 'wpep_create_payment_forms_post_type' );
add_filter( 'manage_wp_easy_pay_posts_columns', 'wpep_modify_column_names_payment_forms' );
add_action(
    'manage_wp_easy_pay_posts_custom_column',
    'wpep_add_columns_data_add_form',
    10,
    2
);
add_action( 'init', 'wpep_create_reports_post_type' );
add_filter( 'manage_wpep_reports_posts_columns', 'wpep_modify_column_names_reports' );
add_action(
    'manage_wpep_reports_posts_custom_column',
    'wpep_add_columns_data_reports',
    9,
    2
);
add_filter( 'manage_wpep_coupons_posts_columns', 'wpep_modify_column_names_coupons' );
add_action(
    'manage_wpep_coupons_posts_custom_column',
    'wpep_add_columns_data_coupons',
    9,
    2
);
add_action( 'wp_ajax_wpep_generate_coupons', 'wpep_generate_coupons' );
add_action( 'wp_ajax_nopriv_wpep_generate_coupons', 'wpep_generate_coupons' );
add_action(
    'save_post_wpep_coupons',
    'wpep_save_coupons',
    10,
    3
);
add_action( 'wp_ajax_wpep_reset_donation_goal', 'wpep_reset_donation_goal' );
add_action( 'admin_menu', 'wpep_add_submenu' );
add_action( 'post_edit_form_tag', 'wpep_post_edit_form_tag' );
function wpep_post_edit_form_tag()
{
    echo  ' enctype="multipart/form-data"' ;
}

require WPEP_ROOT_PATH . 'setup/wpep_subscription.php';
function wpep_reset_donation_goal()
{
    
    if ( isset( $_POST['form_id'] ) && !empty($_POST['form_id']) ) {
        update_post_meta( $_POST['form_id'], 'wpep_donation_goal_achieved', 0 );
        wp_die( 'success' );
    }

}

function wpep_create_payment_forms_post_type()
{
    $labels = array(
        'name'                  => _x( 'WP EASY PAY', 'Post Type General Name', 'wp_easy_pay' ),
        'singular_name'         => _x( 'WP EASY PAY', 'Post Type Singular Name', 'wp_easy_pay' ),
        'menu_name'             => __( 'WP EASY PAY', 'wp_easy_pay' ),
        'name_admin_bar'        => __( 'Post Type', 'wp_easy_pay' ),
        'archives'              => __( 'Item Archives', 'wp_easy_pay' ),
        'attributes'            => __( 'Item Attributes', 'wp_easy_pay' ),
        'parent_item_colon'     => __( 'Parent Item:', 'wp_easy_pay' ),
        'all_items'             => __( 'All Forms', 'wp_easy_pay' ),
        'add_new_item'          => __( 'Create Payment Form', 'wp_easy_pay' ),
        'add_new'               => __( 'Create Payment Form', 'wp_easy_pay' ),
        'new_item'              => __( 'New Item', 'wp_easy_pay' ),
        'edit_item'             => __( 'Edit Item', 'wp_easy_pay' ),
        'update_item'           => __( 'Update Item', 'wp_easy_pay' ),
        'view_item'             => __( 'View Item', 'wp_easy_pay' ),
        'view_items'            => __( 'View Items', 'wp_easy_pay' ),
        'search_items'          => __( 'Search Item', 'wp_easy_pay' ),
        'not_found'             => __( 'Not found', 'wp_easy_pay' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'wp_easy_pay' ),
        'featured_image'        => __( 'Featured Image (show on popup only)', 'wp_easy_pay' ),
        'set_featured_image'    => __( 'Set featured image', 'wp_easy_pay' ),
        'remove_featured_image' => __( 'Remove featured image', 'wp_easy_pay' ),
        'use_featured_image'    => __( 'Use as featured image', 'wp_easy_pay' ),
        'insert_into_item'      => __( 'Insert into item', 'wp_easy_pay' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp_easy_pay' ),
        'items_list'            => __( 'Items list', 'wp_easy_pay' ),
        'items_list_navigation' => __( 'Items list navigation', 'wp_easy_pay' ),
        'filter_items_list'     => __( 'Filter items list', 'wp_easy_pay' ),
    );
    $args = array(
        'label'               => __( 'WP EASY PAY', 'wp_easy_pay' ),
        'description'         => __( 'Post Type Description', 'wp_easy_pay' ),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'supports'            => array( 'thumbnail' ),
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => WPEP_ROOT_URL . 'assets/backend/img/square-logo.png',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'wp_easy_pay', $args );
}

function wpep_create_reports_post_type()
{
    $labels = array(
        'name'                  => _x( 'Reports', 'Post Type General Name', 'wp_easy_pay' ),
        'singular_name'         => _x( 'Reports', 'Post Type Singular Name', 'wp_easy_pay' ),
        'menu_name'             => __( 'Reports', 'wp_easy_pay' ),
        'name_admin_bar'        => __( 'Post Type', 'wp_easy_pay' ),
        'archives'              => __( 'Item Archives', 'wp_easy_pay' ),
        'attributes'            => __( 'Item Attributes', 'wp_easy_pay' ),
        'parent_item_colon'     => __( 'Parent Item:', 'wp_easy_pay' ),
        'all_items'             => __( 'Reports', 'wp_easy_pay' ),
        'add_new_item'          => __( 'Build Report', 'wp_easy_pay' ),
        'add_new'               => __( 'Build Report', 'wp_easy_pay' ),
        'new_item'              => __( 'New Item', 'wp_easy_pay' ),
        'edit_item'             => __( 'Edit Item', 'wp_easy_pay' ),
        'update_item'           => __( 'Update Item', 'wp_easy_pay' ),
        'view_item'             => __( 'View Item', 'wp_easy_pay' ),
        'view_items'            => __( 'View Items', 'wp_easy_pay' ),
        'search_items'          => __( 'Search Item', 'wp_easy_pay' ),
        'not_found'             => __( 'Not found', 'wp_easy_pay' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'wp_easy_pay' ),
        'featured_image'        => __( 'Featured Image', 'wp_easy_pay' ),
        'set_featured_image'    => __( 'Set featured image', 'wp_easy_pay' ),
        'remove_featured_image' => __( 'Remove featured image', 'wp_easy_pay' ),
        'use_featured_image'    => __( 'Use as featured image', 'wp_easy_pay' ),
        'insert_into_item'      => __( 'Insert into item', 'wp_easy_pay' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp_easy_pay' ),
        'items_list'            => __( 'Items list', 'wp_easy_pay' ),
        'items_list_navigation' => __( 'Items list navigation', 'wp_easy_pay' ),
        'filter_items_list'     => __( 'Filter items list', 'wp_easy_pay' ),
    );
    $args = array(
        'label'               => __( 'Reports', 'wp_easy_pay' ),
        'description'         => __( 'Post Type Description', 'wp_easy_pay' ),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'supports'            => false,
        'show_ui'             => true,
        'show_in_menu'        => 'edit.php?post_type=wp_easy_pay',
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'wpep_reports', $args );
}

if ( !function_exists( 'wpep_generate_coupons' ) ) {
    function wpep_generate_coupons( $options = array() )
    {
        // to accept options as function arguments like on README
        
        if ( !is_array( $options ) && func_num_args() > 0 ) {
            $keys = [
                'length',
                'prefix',
                'suffix',
                'letters',
                'numbers',
                'symbols',
                'mixed_case',
                'mask'
            ];
            $opt = [];
            foreach ( func_get_args() as $key => $value ) {
                $opt[$keys[$key]] = $value;
            }
            $options = $opt;
        }
        
        $length = 6;
        $prefix = '';
        $suffix = '';
        $useLetters = ( isset( $options['letters'] ) ? filter_var( $options['letters'], FILTER_VALIDATE_BOOLEAN ) : true );
        $useNumbers = ( isset( $options['numbers'] ) ? filter_var( $options['numbers'], FILTER_VALIDATE_BOOLEAN ) : true );
        $useSymbols = ( isset( $options['symbols'] ) ? filter_var( $options['symbols'], FILTER_VALIDATE_BOOLEAN ) : false );
        $useMixedCase = ( isset( $options['mixed_case'] ) ? filter_var( $options['mixed_case'], FILTER_VALIDATE_BOOLEAN ) : false );
        $mask = ( isset( $options['mask'] ) ? filter_var( $options['mask'], FILTER_SANITIZE_STRING ) : false );
        $uppercase = [
            'Q',
            'W',
            'E',
            'R',
            'T',
            'Y',
            'U',
            'I',
            'O',
            'P',
            'A',
            'S',
            'D',
            'F',
            'G',
            'H',
            'J',
            'K',
            'L',
            'Z',
            'X',
            'C',
            'V',
            'B',
            'N',
            'M'
        ];
        $lowercase = [
            'q',
            'w',
            'e',
            'r',
            't',
            'y',
            'u',
            'i',
            'o',
            'p',
            'a',
            's',
            'd',
            'f',
            'g',
            'h',
            'j',
            'k',
            'l',
            'z',
            'x',
            'c',
            'v',
            'b',
            'n',
            'm'
        ];
        $numbers = [
            0,
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9
        ];
        $symbols = [
            '`',
            '~',
            '!',
            '@',
            '#',
            '$',
            '%',
            '^',
            '&',
            '*',
            '(',
            ')',
            '-',
            '_',
            '=',
            '+',
            '\\',
            '|',
            '/',
            '[',
            ']',
            '{',
            '}',
            '"',
            "'",
            ';',
            ':',
            '<',
            '>',
            ',',
            '.',
            '?'
        ];
        $characters = [];
        $coupon = '';
        if ( $useLetters ) {
            
            if ( $useMixedCase ) {
                $characters = array_merge( $characters, $lowercase, $uppercase );
            } else {
                $characters = array_merge( $characters, $uppercase );
            }
        
        }
        if ( $useNumbers ) {
            $characters = array_merge( $characters, $numbers );
        }
        if ( $useSymbols ) {
            $characters = array_merge( $characters, $symbols );
        }
        
        if ( $mask ) {
            for ( $i = 0 ;  $i < strlen( $mask ) ;  $i++ ) {
                
                if ( $mask[$i] === 'X' ) {
                    $coupon .= $characters[mt_rand( 0, count( $characters ) - 1 )];
                } else {
                    $coupon .= $mask[$i];
                }
            
            }
        } else {
            for ( $i = 0 ;  $i < $length ;  $i++ ) {
                $coupon .= $characters[mt_rand( 0, count( $characters ) - 1 )];
            }
        }
        
        echo  $prefix . $coupon . $suffix ;
    }

}
function wpep_save_coupons( $post_ID, $post, $update )
{
    
    if ( !empty($_POST) ) {
        update_post_meta( $post_ID, 'wpep_coupons_code', sanitize_text_field( ( isset( $_POST['wpep_coupons_code'] ) ? $_POST['wpep_coupons_code'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_coupons_desc', sanitize_text_field( ( isset( $_POST['wpep_coupons_desc'] ) ? $_POST['wpep_coupons_desc'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_coupons_discount_type', sanitize_text_field( ( isset( $_POST['wpep_coupons_discount_type'] ) ? $_POST['wpep_coupons_discount_type'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_coupons_amount', sanitize_text_field( ( isset( $_POST['wpep_coupons_amount'] ) ? $_POST['wpep_coupons_amount'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_coupons_expiry', sanitize_text_field( ( isset( $_POST['wpep_coupons_expiry'] ) ? $_POST['wpep_coupons_expiry'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_coupons_form_include', ( isset( $_POST['wpep_coupons_form_include'] ) ? $_POST['wpep_coupons_form_include'] : '' ) );
        update_post_meta( $post_ID, 'wpep_coupons_form_exclude', ( isset( $_POST['wpep_coupons_form_exclude'] ) ? $_POST['wpep_coupons_form_exclude'] : '' ) );
    }

}

function wpep_modify_column_names_coupons( $columns )
{
    unset( $columns['date'] );
    unset( $columns['title'] );
    $columns['coupon_code'] = __( 'Code' );
    $columns['coupon_amount'] = __( 'Amount' );
    $columns['coupon_type'] = __( 'Type' );
    $columns['coupon_expire'] = __( 'Expires At' );
    $columns['actions'] = __( 'Actions' );
    return $columns;
}

function wpep_add_columns_data_coupons( $column, $postId )
{
    $coupon_code = get_post_meta( $postId, 'wpep_coupons_code', true );
    $coupon_amount = get_post_meta( $postId, 'wpep_coupons_amount', true );
    $coupon_type = get_post_meta( $postId, 'wpep_coupons_discount_type', true );
    $coupon_expire = get_post_meta( $postId, 'wpep_coupons_expiry', false );
    switch ( $column ) {
        case 'coupon_code':
            echo  "<a href='" . get_edit_post_link( $postId ) . "' class='wpep-blue' title='Details'>{$coupon_code} </a>" ;
            break;
        case 'coupon_amount':
            echo  "<span>{$coupon_amount}</span>" ;
            break;
        case 'coupon_type':
            echo  "<span>{$coupon_type}</span>" ;
            break;
        case 'coupon_expire':
            echo  "<span>{$coupon_expire[0]}</span>" ;
            break;
        case 'actions':
            echo  '<a href="' . get_delete_post_link( $postId ) . '" class="deleteIcon" title="Delete report"> Delete </a>' ;
            break;
    }
}

/* Coupon Code End */
function wpep_add_reports_metabox()
{
    add_meta_box(
        'wporg_box_id',
        'Build Reports',
        'wpep_render_reports_meta_html',
        'wpep_reports'
    );
}

add_action( 'admin_init', 'wpep_add_reports_metabox' );
function wpep_render_reports_meta_html( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/reports_view_page.php';
}

function wpep_modify_column_names_reports( $columns )
{
    unset( $columns['date'] );
    unset( $columns['title'] );
    $columns['post_id'] = __( 'ID' );
    $columns['paid_by'] = __( 'Paid By' );
    $columns['type'] = __( 'Type' );
    $columns['date'] = __( 'Date' );
    $columns['actions'] = __( 'Actions' );
    return $columns;
}

function add_scripts_for_download_transaction_excel()
{
    
    if ( get_post_type( get_the_ID() ) == 'wpep_reports' ) {
        //if is true
        wp_register_script( 'wpep_backend_download_transaction_excel', WPEP_ROOT_URL . 'assets/backend/js/wpep_backend_download_transaction_excel.js', '3.0.0' );
        wp_localize_script( 'wpep_backend_download_transaction_excel', 'wpep_reports', array(
            'ajaxUrl'              => admin_url( 'admin-ajax.php' ),
            'action'               => 'wpep_download_transaction_in_excel',
            'nonce'                => wp_create_nonce( 'custom_nonce' ),
            'post_type'            => 'wpep_reports',
            'reports_download_url' => WPEP_ROOT_URL . "/tmp/reports.csv",
        ) );
        wp_enqueue_script( 'wpep_backend_download_transaction_excel' );
        require_once WPEP_ROOT_PATH . 'views/backend/reports_download_popup.php';
    }

}

add_action( 'admin_enqueue_scripts', 'add_scripts_for_download_transaction_excel' );
function wpep_download_transaction_in_excel()
{
    if ( !isset( $_POST['nonce'] ) && !wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'nonce' ) ) {
        die( 'access denied! Nonce not verify.' );
    }
    $labels = ( isset( $_POST['fields'] ) && !empty($_POST['fields']) ? $_POST['fields'] : '' );
    $list = array();
    $path = WPEP_ROOT_PATH . "/tmp/";
    
    if ( !is_dir( $path ) ) {
        mkdir( $path, 0777, true );
        chmod( $path, 0777 );
    } else {
        chmod( $path, 0777 );
    }
    
    
    if ( !empty($labels) ) {
        $tmp = array();
        foreach ( $labels as $label ) {
            $tmp[] = $label['value'];
        }
        array_push( $list, $tmp );
    } else {
        $list = array( array(
            "First Name",
            "last Name",
            "user Email",
            "Payment Type",
            "Transaction ID",
            "Refund ID",
            "Payment Amount",
            "Payment Status",
            "FORM ID"
        ) );
    }
    
    $posts = get_posts( array(
        'post_type'   => 'wpep_reports',
        'orderby'     => 'date',
        'order'       => 'DESC',
        'numberposts' => -1,
    ) );
    foreach ( $posts as $key => $post ) {
        $current_post_id = $post->ID;
        $firstname = get_post_meta( $current_post_id, 'wpep_first_name', true );
        $lastname = get_post_meta( $current_post_id, 'wpep_last_name', true );
        $email = get_post_meta( $current_post_id, 'wpep_email', true );
        $charge_amount = get_post_meta( $current_post_id, 'wpep_square_charge_amount', true );
        $transaction_status = get_post_meta( $current_post_id, 'wpep_transaction_status', true );
        $transaction_id = get_the_title( $current_post_id );
        $transaction_type = get_post_meta( $current_post_id, 'wpep_transaction_type', true );
        $form_id = get_post_meta( $current_post_id, 'wpep_form_id', true );
        $form_values = get_post_meta( $current_post_id, 'wpep_form_values', true );
        $wpep_transaction_error = get_post_meta( $current_post_id, 'wpep_transaction_error', true );
        $wpep_refund_id = get_post_meta( $current_post_id, 'wpep_square_refund_id', true );
        $data = array();
        foreach ( $tmp as $name ) {
            if ( 'First_Name' == $name ) {
                $data[] = $firstname;
            }
            if ( 'Last_Name' == $name ) {
                $data[] = $lastname;
            }
            if ( 'Email_Address' == $name ) {
                $data[] = $email;
            }
            if ( 'Transaction_type' == $name ) {
                $data[] = $transaction_type;
            }
            if ( 'Transaction_ID' == $name ) {
                $data[] = $transaction_id;
            }
            if ( 'Refund_ID' == $name ) {
                $data[] = $wpep_refund_id;
            }
            if ( 'Charge_Amount' == $name ) {
                $data[] = $charge_amount;
            }
            if ( 'Transaction_Status' == $name ) {
                $data[] = $transaction_status;
            }
            if ( 'Form_ID' == $name ) {
                $data[] = $form_id;
            }
        }
        array_push( $list, $data );
    }
    $new_csv = fopen( $path . '/reports.csv', 'w' );
    foreach ( $list as $row ) {
        fputcsv( $new_csv, $row );
    }
    $check = fclose( $new_csv );
    echo  json_encode( array(
        'status' => $check,
    ) ) ;
    wp_die();
}

add_action( 'wp_ajax_nopriv_wpep_download_transaction_in_excel', 'wpep_download_transaction_in_excel' );
add_action( 'wp_ajax_wpep_download_transaction_in_excel', 'wpep_download_transaction_in_excel' );
function wpep_add_columns_data_reports( $column, $postId )
{
    $first_name = get_post_meta( $postId, 'wpep_first_name', true );
    $last_name = get_post_meta( $postId, 'wpep_last_name', true );
    $email = get_post_meta( $postId, 'wpep_email', true );
    $charge_amount = get_post_meta( $postId, 'wpep_square_charge_amount', true );
    $refund_id = get_post_meta( $postId, 'wpep_square_refund_id', false );
    $transaction_type = get_post_meta( $postId, 'wpep_transaction_type', true );
    $transaction_id = get_the_title( $postId );
    switch ( $column ) {
        case 'post_id':
            echo  "<a href='" . get_edit_post_link( $postId ) . "' class='wpep-blue' title='Details'>" . '#' . "{$postId}</a>" ;
            break;
        case 'type':
            echo  "<span class='{$transaction_type}'>" . str_replace( '_', ' ', $transaction_type ) . "</span>" ;
            break;
        case 'paid_by':
            echo  $first_name . ' ' . $last_name ;
            break;
        case 'actions':
            echo  '<a href="' . get_delete_post_link( $postId ) . '" class="deleteIcon" title="Delete report"> Delete </a>' ;
            break;
    }
}

function wpep_modify_column_names_payment_forms( $columns )
{
    unset( $columns['title'] );
    unset( $columns['date'] );
    $columns['title'] = __( 'Form Title' );
    $columns['shortcode'] = __( 'Shortcode' );
    $columns['type'] = __( 'Type' );
    $columns['date'] = __( 'Date' );
    $columns['actions'] = __( 'Actions' );
    return $columns;
}

function wpep_add_columns_data_add_form( $column, $postId )
{
    switch ( $column ) {
        case 'shortcode':
            echo  '<span class="wpep_tags">[wpep-form id="' . $postId . '"]</span>' ;
            break;
        case 'type':
            $form_type = get_post_meta( $postId, 'wpep_square_payment_type', true );
            echo  "<span class='{$form_type}'>" . str_replace( '_', ' ', $form_type ) . "</span>" ;
            break;
        case 'actions':
            echo  '<a href="' . get_edit_post_link( $postId ) . '" class="editIcon" title="Edit form"> Edit </a> <a href="' . get_delete_post_link( $postId ) . '" class="deleteIcon" title="Delete form"> Delete </a>' ;
            break;
    }
}

function wpep_render_global_settings_page()
{
    require_once 'views/backend/global_settings_page.php';
}

if ( !function_exists( 'wpep_add_submenu' ) ) {
    function wpep_add_submenu()
    {
        add_submenu_page(
            'edit.php?post_type=wp_easy_pay',
            'Square Connect',
            'Square Connect',
            'manage_options',
            'wpep-settings',
            'wpep_render_global_settings_page'
        );
    }

}
function wpep_render_road_map_page()
{
    require_once 'views/backend/roadmap_page.php';
}

function wpep_save_add_form_fields( $post_ID, $post, $update )
{
    
    if ( isset( $_POST['wpep_tabular_product_hidden_image'] ) ) {
        $wpep_tabular_product_hidden_image = $_POST['wpep_tabular_product_hidden_image'];
        
        if ( isset( $_FILES['wpep_tabular_products_image'] ) ) {
            $upload_overrides = array(
                'test_form' => false,
            );
            $products_url = array();
            foreach ( $_FILES['wpep_tabular_products_image']['tmp_name'] as $key => $tmp_name ) {
                
                if ( !empty($_FILES['wpep_tabular_products_image']['name'][$key]) ) {
                    $file = array(
                        'name'     => $_FILES['wpep_tabular_products_image']['name'][$key],
                        'type'     => $_FILES['wpep_tabular_products_image']['type'][$key],
                        'tmp_name' => $_FILES['wpep_tabular_products_image']['tmp_name'][$key],
                        'error'    => $_FILES['wpep_tabular_products_image']['error'][$key],
                        'size'     => $_FILES['wpep_tabular_products_image']['size'][$key],
                    );
                    $movefile = wp_handle_upload( $file, $upload_overrides );
                    
                    if ( $movefile && !isset( $movefile['error'] ) ) {
                        array_push( $products_url, $movefile['url'] );
                    } else {
                        echo  $movefile['error'] ;
                    }
                
                } else {
                    array_push( $products_url, $wpep_tabular_product_hidden_image[$key] );
                }
            
            }
        }
    
    }
    
    
    if ( !empty($_POST) ) {
        if ( isset( $_POST['wpep_radio_amounts'] ) ) {
            $radio_amounts = $_POST['wpep_radio_amounts'];
        }
        if ( isset( $_POST['wpep_radio_amount_labels'] ) ) {
            $radio_labels = $_POST['wpep_radio_amount_labels'];
        }
        if ( isset( $_POST['wpep_dropdown_amounts'] ) && !empty($_POST['wpep_dropdown_amounts']) ) {
            $dropdown_amounts = $_POST['wpep_dropdown_amounts'];
        }
        if ( isset( $_POST['wpep_dropdown_amount_labels'] ) && !empty($_POST['wpep_dropdown_amount_labels']) ) {
            $dropdown_labels = $_POST['wpep_dropdown_amount_labels'];
        }
        $radio_amounts_with_labels = array();
        $dropdown_amounts_with_labels = array();
        $tabular_products_with_labels = array();
        if ( isset( $radio_amounts ) ) {
            foreach ( $radio_amounts as $key => $amount_rd ) {
                $data['amount'] = $amount_rd;
                $data['label'] = $radio_labels[$key];
                array_push( $radio_amounts_with_labels, $data );
            }
        }
        if ( isset( $dropdown_amounts ) ) {
            foreach ( $dropdown_amounts as $key => $amount_dd ) {
                $data['amount'] = $amount_dd;
                $data['label'] = $dropdown_labels[$key];
                array_push( $dropdown_amounts_with_labels, $data );
            }
        }
        if ( $_POST['wpep_tabular_products_price'] ) {
            $tabular_product_price = $_POST['wpep_tabular_products_price'];
        }
        if ( $_POST['wpep_tabular_products_label'] ) {
            $tabular_product_label = $_POST['wpep_tabular_products_label'];
        }
        if ( $_POST['wpep_tabular_products_qty'] ) {
            $tabular_product_qty = $_POST['wpep_tabular_products_qty'];
        }
        if ( isset( $tabular_product_price ) ) {
            foreach ( $tabular_product_price as $key => $product_price ) {
                $data['amount'] = $product_price;
                $data['label'] = $tabular_product_label[$key];
                $data['quantity'] = $tabular_product_qty[$key];
                $data['products_url'] = ( isset( $products_url[$key] ) ? $products_url[$key] : '' );
                array_push( $tabular_products_with_labels, $data );
            }
        }
        update_post_meta( $post_ID, 'wpep_square_test_location_id', sanitize_text_field( ( isset( $_POST['wpep_square_test_location_id'] ) ? $_POST['wpep_square_test_location_id'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_type', sanitize_text_field( ( isset( $_POST['wpep_square_payment_type'] ) ? $_POST['wpep_square_payment_type'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_purpose', sanitize_text_field( ( isset( $_POST['wpep_square_payment_purpose'] ) ? $_POST['wpep_square_payment_purpose'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_success_url', sanitize_text_field( ( isset( $_POST['wpep_square_payment_success_url'] ) ? $_POST['wpep_square_payment_success_url'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_payment_success_msg', sanitize_text_field( ( isset( $_POST['wpep_payment_success_msg'] ) ? $_POST['wpep_payment_success_msg'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_success_label', sanitize_text_field( ( isset( $_POST['wpep_square_payment_success_label'] ) ? $_POST['wpep_square_payment_success_label'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_box_1', sanitize_text_field( ( isset( $_POST['wpep_square_payment_box_1'] ) ? $_POST['wpep_square_payment_box_1'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_box_2', sanitize_text_field( ( isset( $_POST['wpep_square_payment_box_2'] ) ? $_POST['wpep_square_payment_box_2'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_box_3', sanitize_text_field( ( isset( $_POST['wpep_square_payment_box_3'] ) ? $_POST['wpep_square_payment_box_3'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_box_4', sanitize_text_field( ( isset( $_POST['wpep_square_payment_box_4'] ) ? $_POST['wpep_square_payment_box_4'] : '' ) ) );
        update_post_meta( $post_ID, 'defaultPriceSelected', sanitize_text_field( ( isset( $_POST['defaultPriceSelected'] ) ? $_POST['defaultPriceSelected'] : '' ) ) );
        update_post_meta( $post_ID, 'currencySymbolType', sanitize_text_field( ( isset( $_POST['currencySymbolType'] ) ? $_POST['currencySymbolType'] : 'code' ) ) );
        update_post_meta( $post_ID, 'PriceSelected', sanitize_text_field( ( isset( $_POST['PriceSelected'] ) ? $_POST['PriceSelected'] : '1' ) ) );
        update_post_meta( $post_ID, 'wpep_square_form_builder_fields', sanitize_text_field( ( isset( $_POST['wpep_square_form_builder_fields'] ) ? $_POST['wpep_square_form_builder_fields'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_defined_amount', sanitize_text_field( ( isset( $_POST['wpep_square_user_defined_amount'] ) ? $_POST['wpep_square_user_defined_amount'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_transaction_notes_box', sanitize_text_field( ( isset( $_POST['wpep_transaction_notes_box'] ) ? $_POST['wpep_transaction_notes_box'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_to_field', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_to_field'] ) ? $_POST['wpep_square_admin_email_to_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_cc_field', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_cc_field'] ) ? $_POST['wpep_square_admin_email_cc_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_bcc_field', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_bcc_field'] ) ? $_POST['wpep_square_admin_email_bcc_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_from_field', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_from_field'] ) ? $_POST['wpep_square_admin_email_from_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_subject_field', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_subject_field'] ) ? $_POST['wpep_square_admin_email_subject_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_content_field', ( isset( $_POST['wpep_square_admin_email_content_field'] ) ? $_POST['wpep_square_admin_email_content_field'] : '' ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_exclude_blank_tags_lines', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_exclude_blank_tags_lines'] ) ? $_POST['wpep_square_admin_email_exclude_blank_tags_lines'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_admin_email_content_type_html', sanitize_text_field( ( isset( $_POST['wpep_square_admin_email_content_type_html'] ) ? $_POST['wpep_square_admin_email_content_type_html'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_save_card', sanitize_text_field( ( isset( $_POST['wpep_save_card'] ) ? $_POST['wpep_save_card'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_prods_without_images', sanitize_text_field( ( isset( $_POST['wpep_prods_without_images'] ) ? $_POST['wpep_prods_without_images'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_to_field', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_to_field'] ) ? $_POST['wpep_square_user_email_to_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_cc_field', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_cc_field'] ) ? $_POST['wpep_square_user_email_cc_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_bcc_field', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_bcc_field'] ) ? $_POST['wpep_square_user_email_bcc_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_from_field', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_from_field'] ) ? $_POST['wpep_square_user_email_from_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_subject_field', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_subject_field'] ) ? $_POST['wpep_square_user_email_subject_field'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_content_field', ( isset( $_POST['wpep_square_user_email_content_field'] ) ? $_POST['wpep_square_user_email_content_field'] : '' ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_exclude_blank_tags_lines', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_exclude_blank_tags_lines'] ) ? $_POST['wpep_square_user_email_exclude_blank_tags_lines'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_user_email_content_type_html', sanitize_text_field( ( isset( $_POST['wpep_square_user_email_content_type_html'] ) ? $_POST['wpep_square_user_email_content_type_html'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_button_title', sanitize_text_field( ( isset( $_POST['wpep_button_title'] ) ? $_POST['wpep_button_title'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_location_id', sanitize_text_field( ( isset( $_POST['wpep_square_location_id'] ) ? $_POST['wpep_square_location_id'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_amount_type', sanitize_text_field( ( isset( $_POST['wpep_square_amount_type'] ) ? $_POST['wpep_square_amount_type'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_open_in_popup', sanitize_text_field( ( isset( $_POST['wpep_open_in_popup'] ) ? $_POST['wpep_open_in_popup'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_payment_mode', sanitize_text_field( ( isset( $_POST['wpep_payment_mode'] ) ? $_POST['wpep_payment_mode'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_google_pay', sanitize_text_field( ( isset( $_POST['wpep_square_google_pay'] ) ? $_POST['wpep_square_google_pay'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_master_pay', sanitize_text_field( ( isset( $_POST['wpep_square_master_pay'] ) ? $_POST['wpep_square_master_pay'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_apple_pay', sanitize_text_field( ( isset( $_POST['wpep_square_apple_pay'] ) ? $_POST['wpep_square_apple_pay'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_google_pay_live', sanitize_text_field( ( isset( $_POST['wpep_square_google_pay_live'] ) ? $_POST['wpep_square_google_pay_live'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_master_pay_live', sanitize_text_field( ( isset( $_POST['wpep_square_master_pay_live'] ) ? $_POST['wpep_square_master_pay_live'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_apple_pay_live', sanitize_text_field( ( isset( $_POST['wpep_square_apple_pay_live'] ) ? $_POST['wpep_square_apple_pay_live'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_individual_form_global', 'on' );
        update_post_meta( $post_ID, 'wpep_subscription_cycle_interval', sanitize_text_field( ( isset( $_POST['wpep_subscription_cycle_interval'] ) ? $_POST['wpep_subscription_cycle_interval'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_subscription_cycle', sanitize_text_field( ( isset( $_POST['wpep_subscription_cycle'] ) ? $_POST['wpep_subscription_cycle'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_subscription_length', sanitize_text_field( ( isset( $_POST['wpep_subscription_length'] ) ? $_POST['wpep_subscription_length'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_organization_name', sanitize_text_field( ( isset( $_POST['wpep_organization_name'] ) ? $_POST['wpep_organization_name'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_donation_goal_switch', sanitize_text_field( ( isset( $_POST['wpep_donation_goal_switch'] ) ? $_POST['wpep_donation_goal_switch'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_donation_goal_amount', sanitize_text_field( ( isset( $_POST['wpep_donation_goal_amount'] ) ? $_POST['wpep_donation_goal_amount'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_donation_goal_message_switch', sanitize_text_field( ( isset( $_POST['wpep_donation_goal_message_switch'] ) ? $_POST['wpep_donation_goal_message_switch'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_donation_goal_message', sanitize_text_field( ( isset( $_POST['wpep_donation_goal_message'] ) ? $_POST['wpep_donation_goal_message'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_donation_goal_form_close', sanitize_text_field( ( isset( $_POST['wpep_donation_goal_form_close'] ) ? $_POST['wpep_donation_goal_form_close'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_mailchimp_audience', sanitize_text_field( ( isset( $_POST['wpep_mailchimp_audience'] ) ? $_POST['wpep_mailchimp_audience'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_dropdown_amounts', ( isset( $dropdown_amounts_with_labels ) ? $dropdown_amounts_with_labels : '' ) );
        update_post_meta( $post_ID, 'wpep_radio_amounts', ( isset( $radio_amounts_with_labels ) ? $radio_amounts_with_labels : '' ) );
        update_post_meta( $post_ID, 'wpep_products_with_labels', ( isset( $tabular_products_with_labels ) ? $tabular_products_with_labels : '' ) );
        update_post_meta( $post_ID, 'wpep_square_payment_min', sanitize_text_field( ( isset( $_POST['wpep_square_payment_min'] ) ? $_POST['wpep_square_payment_min'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_square_payment_max', sanitize_text_field( ( isset( $_POST['wpep_square_payment_max'] ) ? $_POST['wpep_square_payment_max'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_show_wizard', sanitize_text_field( ( isset( $_POST['wpep_show_wizard'] ) ? $_POST['wpep_show_wizard'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_show_shadow', sanitize_text_field( ( isset( $_POST['wpep_show_shadow'] ) ? $_POST['wpep_show_shadow'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_btn_theme', sanitize_text_field( ( isset( $_POST['wpep_btn_theme'] ) ? $_POST['wpep_btn_theme'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_form_theme_color', sanitize_text_field( ( isset( $_POST['wpep_form_theme_color'] ) ? $_POST['wpep_form_theme_color'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_payment_btn_label', sanitize_text_field( ( isset( $_POST['wpep_payment_btn_label'] ) ? $_POST['wpep_payment_btn_label'] : '' ) ) );
        /* adding redirection values */
        update_post_meta( $post_ID, 'wantRedirection', sanitize_text_field( ( isset( $_POST['wantRedirection'] ) ? $_POST['wantRedirection'] : 'No' ) ) );
        update_post_meta( $post_ID, 'redirectionDelay', sanitize_text_field( ( isset( $_POST['redirectionDelay'] ) ? $_POST['redirectionDelay'] : '' ) ) );
        /*term & condition Check */
        update_post_meta( $post_ID, 'enableTermsCondition', sanitize_text_field( ( isset( $_POST['enableTermsCondition'] ) ? $_POST['enableTermsCondition'] : '' ) ) );
        update_post_meta( $post_ID, 'termsLabel', sanitize_text_field( ( isset( $_POST['termsLabel'] ) ? $_POST['termsLabel'] : '' ) ) );
        update_post_meta( $post_ID, 'termsLink', sanitize_text_field( ( isset( $_POST['termsLink'] ) ? $_POST['termsLink'] : '' ) ) );
        update_post_meta( $post_ID, 'postalPh', sanitize_text_field( ( isset( $_POST['postalPh'] ) ? $_POST['postalPh'] : '' ) ) );
        update_post_meta( $post_ID, 'enableQuantity', sanitize_text_field( ( isset( $_POST['enableQuantity'] ) ? $_POST['enableQuantity'] : '' ) ) );
        update_post_meta( $post_ID, 'enableCoupon', sanitize_text_field( ( isset( $_POST['enableCoupon'] ) ? $_POST['enableCoupon'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_subscription_trial_days', sanitize_text_field( ( isset( $_POST['wpep_subscription_trial_days'] ) ? $_POST['wpep_subscription_trial_days'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_subscription_trial', sanitize_text_field( ( isset( $_POST['wpep_subscription_trial'] ) ? $_POST['wpep_subscription_trial'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_signup_fees_label', sanitize_text_field( ( isset( $_POST['wpep_signup_fees_label'] ) ? $_POST['wpep_signup_fees_label'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_signup_fees_amount', sanitize_text_field( ( isset( $_POST['wpep_signup_fees_amount'] ) ? $_POST['wpep_signup_fees_amount'] : '' ) ) );
        update_post_meta( $post_ID, 'wpep_enable_signup_fees', sanitize_text_field( ( isset( $_POST['wpep_enable_signup_fees'] ) ? $_POST['wpep_enable_signup_fees'] : '' ) ) );
        //saving addtional charges
        
        if ( isset( $_POST['wpep_service_fees_name'] ) && !empty($_POST['wpep_service_fees_name']) ) {
            $fees_data = array();
            foreach ( $_POST['wpep_service_fees_name'] as $key => $name ) {
                $fees_data['check'][$key] = ( isset( $_POST['wpep_service_fees_check'][$key] ) ? $_POST['wpep_service_fees_check'][$key] : 'no' );
                $fees_data['name'][$key] = ( isset( $_POST['wpep_service_fees_name'][$key] ) ? $_POST['wpep_service_fees_name'][$key] : '' );
                $fees_data['type'][$key] = ( isset( $_POST['wpep_service_charge_type'][$key] ) ? $_POST['wpep_service_charge_type'][$key] : '' );
                $fees_data['value'][$key] = ( isset( $_POST['wpep_fees_value'][$key] ) ? $_POST['wpep_fees_value'][$key] : '' );
            }
            update_post_meta( $post_ID, 'fees_data', $fees_data );
        }
        
        global  $wpdb ;
        
        if ( get_post_type( $post_ID ) == 'wp_easy_pay' ) {
            $title = sanitize_text_field( $_POST['post_title'] );
            $post_name = urlencode( $_POST['post_title'] );
            $post_content = sanitize_text_field( $_POST['post_content'] );
            $where = array(
                'ID' => $post_ID,
            );
            $wpdb->update( $wpdb->posts, array(
                'post_title' => $title,
            ), $where );
            $wpdb->update( $wpdb->posts, array(
                'post_content' => $post_content,
            ), $where );
        }
    
    }

}

add_action(
    'save_post_wp_easy_pay',
    'wpep_save_add_form_fields',
    10,
    3
);
function wpep_create_connect_url( $origin )
{
    $URI_REQUESTED = $_SERVER['REQUEST_URI'];
    /* Fetch GET parameters from URI */
    $parts = parse_url( $URI_REQUESTED );
    parse_str( $parts['query'], $url_identifiers );
    /* Fetch Admin URL */
    $slash_exploded = explode( '/', $URI_REQUESTED );
    $question_mark_exploded = explode( '?', $slash_exploded[2] );
    $url_identifiers['wpep_admin_url'] = $question_mark_exploded[0];
    $url_identifiers['wpep_post_type'] = 'wp_easy_pay';
    $url_identifiers['wpep_prepare_connection_call'] = true;
    if ( $origin == 'individual_form' ) {
        if ( isset( $_GET['post'] ) && !empty($_GET['post']) ) {
            $url_identifiers['wpep_page_post'] = $_GET['post'];
        }
    }
    if ( $origin == 'global' ) {
        $url_identifiers['wpep_page_post'] = 'global';
    }
    $connection_url = add_query_arg( $url_identifiers, admin_url( 'edit.php' ) );
    return $connection_url;
}

function wpep_create_connect_sandbox_url( $origin )
{
    $URI_REQUESTED = $_SERVER['REQUEST_URI'];
    /* Fetch GET parameters from URI */
    $parts = parse_url( $URI_REQUESTED );
    parse_str( $parts['query'], $url_identifiers );
    /* Fetch Admin URL */
    $slash_exploded = explode( '/', $URI_REQUESTED );
    $question_mark_exploded = explode( '?', $slash_exploded[2] );
    $url_identifiers['wpep_admin_url'] = $question_mark_exploded[0];
    $url_identifiers['wpep_post_type'] = 'wp_easy_pay';
    $url_identifiers['wpep_prepare_connection_call'] = true;
    if ( $origin == 'individual_form' ) {
        
        if ( isset( $_GET['post'] ) && !empty($_GET['post']) ) {
            $url_identifiers['wpep_page_post'] = $_GET['post'];
            $url_identifiers['wpep_sandbox'] = "yes";
        }
    
    }
    
    if ( $origin == 'global' ) {
        $url_identifiers['wpep_page_post'] = 'global';
        $url_identifiers['wpep_sandbox'] = "yes";
    }
    
    $connection_url = add_query_arg( $url_identifiers, admin_url( 'edit.php' ) );
    return $connection_url;
}

/*Mufaddal Added shortcode metabox in build form page*/
function wpep_add_form_shortcode_metabox()
{
    add_meta_box(
        'wpep_form_shortcode_metabox',
        'Shortcode',
        'wpep_render_form_shortcode_meta_html',
        'wp_easy_pay',
        'side',
        'high'
    );
    add_meta_box(
        'wpep_form_style_box',
        'Form Style',
        'wpep_render_form_style_meta_html',
        'wp_easy_pay',
        'side'
    );
}

add_action( 'admin_init', 'wpep_add_form_shortcode_metabox' );
function wpep_render_form_shortcode_meta_html( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/form_builder_settings/form_shortocde_metabox.php';
}

function add_publish_meta_options( $post_obj )
{
    global  $post ;
    $post_type = 'wp_easy_pay';
    // If you want a specific post type
    $value = get_post_meta( $post_obj->ID, 'check_meta', true );
    // If saving value to post_meta
    if ( $post_type == $post->post_type ) {
        echo  1 ;
    }
}

add_action( 'post_submitbox_misc_actions', 'add_publish_meta_options' );
function wpep_render_form_style_meta_html( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/form_builder_settings/wpep_render_form_style_meta_html.php';
}

/*Mufaddal Added shortcode metabox in build form page*/
function wpep_add_form_currency_show_type_metabox()
{
    add_meta_box(
        'wpep_form_currency_show_type_metabox',
        'Change Currency Symbol',
        'wpep_render_form_change_currency_show_type_html',
        'wp_easy_pay',
        'side',
        'high'
    );
}

add_action( 'admin_init', 'wpep_add_form_currency_show_type_metabox' );
function wpep_render_form_change_currency_show_type_html( $post )
{
    require_once WPEP_ROOT_PATH . 'views/backend/form_builder_settings/form_currency_show_type_metabox.php';
}
