<?php

/**
 * Plugin Name: WP Podcasts Manager
 * Plugin URI: https://www.zluck.com/
 * Description: This is the Podcast plugin, that will collect podcasts from Anchor.FM services. It also allows to create new podcasts.
 * Version: 1.0
 * Author: Zluck
 * Author URI: https://zluck.com/
 **/

function zl_pdm_enque_style()
{
    wp_enqueue_style('zl_pdm_style', plugin_dir_url(__FILE__) . 'assets/css/zl_pdm_style.css', '1.0');
    wp_enqueue_script('zl_pdm_script', plugin_dir_url(__FILE__) . 'assets/js/zl_pdm_script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'zl_pdm_enque_style');

function zl_pdm_admin_enque_style()
{
    wp_enqueue_style('zl_pdm_style', plugin_dir_url(__FILE__) . 'assets/css/zl_pdm_admin_style.css', '1.0');
}
add_action('admin_enqueue_scripts', 'zl_pdm_admin_enque_style');

/* Register Custom Post Type For Podcasts*/
add_action('init', 'zl_pdm_register_post_type_podcast');
function zl_pdm_register_post_type_podcast()
{
    $plg_name = 'Podcast';
    $zl_pdm_archive_page_slug = get_option('zl_pdm_archive_page_slug');
    $zl_pdm_embed_position = get_option('zl_pdm_embed_position');
    if ($zl_pdm_archive_page_slug)
        $archive_page_slug = $zl_pdm_archive_page_slug;
    else
        $archive_page_slug = 'podcasts';
    $single_item_slug = 'zl-podcast';
    $supports = array(
        'title', // post title
        'link' => 'Podcast Link',
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
    );
    $labels = array(
        'name' => _x($plg_name . 's', 'plural'),
        'singular_name' => _x($plg_name, 'singular'),
        'menu_name' => _x($plg_name . 's', 'admin menu'),
        'name_admin_bar' => _x($plg_name, 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New ' . $plg_name),
        'new_item' => __('New ' . $plg_name),
        'edit_item' => __('Edit ' . $plg_name),
        'view_item' => __('View ' . $plg_name),
        'all_items' => __('All ' . $plg_name . 's'),
        'archives' =>  __($plg_name . 's'),
        'search_items' => __('Search ' . $plg_name),
        'not_found' => __('No ' . $plg_name . ' found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $single_item_slug),
        'has_archive' => $archive_page_slug,
        'hierarchical' => true,
    );
    register_post_type('zl_podcast', $args);

    $taxonomys = 'Category';
    $taxonomyp = 'Categories';
    $taxlabels = array(
        'name' => _x($taxonomyp, 'plural'),
        'singular_name' => _x($taxonomys, 'singular'),
        'menu_name' => _x($taxonomyp, 'admin menu'),
        'name_admin_bar' => _x($taxonomys, 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New ' . $taxonomys),
        'new_item' => __('New ' . $taxonomys),
        'edit_item' => __('Edit ' . $taxonomys),
        'view_item' => __('View ' . $taxonomys),
        'all_items' => __('All ' . $taxonomyp),
        'search_items' => __('Search ' . $taxonomys),
        'not_found' => __('No ' . $taxonomys . ' found.'),
    );

    register_taxonomy('pd-cat', array('zl_podcast'), array(
        'hierarchical' => true,
        'labels' => $taxlabels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'pd-cat'),
    ));
}

/* Add setting menu for Podcasts Post Type */
add_action('admin_menu', 'zl_pdm_podcast_settings_page');
function zl_pdm_podcast_settings_page()
{
    add_submenu_page(
        'edit.php?post_type=zl_podcast',
        'Settings',
        'Settings',
        'manage_options',
        'podcasts',
        'zl_pdm_podcast_settings_page_callback'
    );
}


/**
 * Display submenu page.
 */
function zl_pdm_podcast_settings_page_callback()
{
    $errormsg = '';
    $url = get_option('zl_anchor_fm_podcast_url');
    $zl_anchor_default_author = get_option('zl_anchor_default_author');
    $zl_pdm_archive_page_slug = get_option('zl_pdm_archive_page_slug');
    $zl_pdm_embed_position = get_option('zl_pdm_embed_position');
    $cron_time = get_option('zl_podcast_cron_time');
    $cron_start_time = get_option('zl_podcast_cron_start_time');

    if (!empty($_POST) && isset($_POST['zl_anchor_fm_podcast_url']) && $_POST['zl_anchor_fm_podcast_url'] != '') {
        $url = esc_url_raw($_POST['zl_anchor_fm_podcast_url']);
        $zl_anchor_default_author = sanitize_text_field($_POST['zl_anchor_default_author']);
        $zl_pdm_archive_page_slug = sanitize_text_field($_POST['zl_pdm_archive_page_slug']);
        $zl_pdm_embed_position = sanitize_text_field($_POST['zl_pdm_embed_position']);
        $cron_time_u = sanitize_text_field($_POST['zl_podcast_cron_time']);

        $cron_time_u = round(($cron_time_u * 2), 0) / 2;
        if ($cron_start_time != $_POST['zl_podcast_cron_start_time'] || $cron_time_u != $cron_time) {
            zl_pdm_cronstarter_deactivate();
        }
        $cron_start_time = sanitize_text_field($_POST['zl_podcast_cron_start_time']);
        $cron_time = $cron_time_u;
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            update_option('zl_anchor_fm_podcast_url', $url);
            update_option('zl_anchor_default_author', $zl_anchor_default_author);
            update_option('zl_pdm_archive_page_slug', $zl_pdm_archive_page_slug);
            update_option('zl_pdm_embed_position', $zl_pdm_embed_position);
            update_option('zl_podcast_cron_time', $cron_time);                       
            update_option('zl_podcast_cron_start_time', $cron_start_time);
            $errormsg = "Podcast settings updated successfully!!";
            if (isset($_POST['runnow'])) {
                do_action('zl_pdm_cronjobs');
                $errormsg = "Podcast settings execute successfully!!";
            }
        } else {
            $errormsg = "$url is not a valid URL - (Include http:// or https:// in your URL)";
        }
    }

    include_once('podcasts-settings.php');
}

//Update post meta 
add_action('transition_post_status', 'zl_pdm_check_on_post_status_change', 10, 3);
function zl_pdm_check_on_post_status_change($new_status, $old_status, $post)
{
    if ($post->post_type == 'zl_podcast' && $old_status != 'new' && isset($_POST['zl_pd_link']) && isset($_POST['zl_pd_service'])) {
        update_post_meta($post->ID, 'zl_pd_link', sanitize_meta('zl_pd_link', $_POST['zl_pd_link'], 'post'));
        update_post_meta($post->ID, 'zl_pd_service', sanitize_meta('zl_pd_service', $_POST['zl_pd_service'], 'post'));
        if ($old_status == 'draft' && !metadata_exists('post', $post->ID, 'zl_imported')) {
            add_post_meta($post->ID, 'zl_imported', '0');
            // update_metadata('post', $post->ID, 'zl_imported','0');
        }
    }
}

/* Add custom post meta tag */
add_action('edit_form_after_title', 'zl_pdm_add_meta_fields');
function zl_pdm_add_meta_fields()
{
    global $post;
    if ($post->post_type == 'zl_podcast') {
        $post_meta = get_post_meta($post->ID);
        $pd_link = isset($post_meta['zl_pd_link'][0]) ? $post_meta['zl_pd_link'][0] : '';
        $pd_service = isset($post_meta['zl_pd_service'][0]) ? $post_meta['zl_pd_service'][0] : '';
        $pd_services = array('other' => 'Other', 'anchor-fm' => 'Anchor FM');
?>
        <div class="form-wrap">
            <br><br />
            <div class="postbox">
                <h2 class="hndle"><span><?php _e('Podcast Link', 'zl_podcast'); ?></span></h2>
                <div class="inside">
                    <div class="form-field form-required term-name-wrap">
                        <input name="zl_pd_link" id="zl_anchor_fm_podcast_url" type="text" value="<?php echo $pd_link; ?>" aria-required="true" required="required" />
                        <p class="zl-exam"><?php _e('For eg. <a href="' . esc_url('https://anchor.fm/askavie/episodes/Hyperlinks-in-Anchor-evici') . '" target="_blank">xyz.com/dfsd</a> it will be embedded using iframe'); ?></p>
                    </div>
                </div>
            </div>
            <div class="postbox">
                <h2 class="hndle"><span><?php _e('Podcast Service', 'zl_podcast'); ?></span></h2>
                <div class="inside">
                    <div class="form-field form-required term-name-wrap">
                        <select name="zl_pd_service" id="zl_podcase_service" required="required">
                            <?php
                            foreach ($pd_services as $pd_service_id => $pd_service_name) {
                            ?>
                                <option value="<?php echo $pd_service_id; ?>" <?php echo ($pd_service_id == $pd_service) ? 'selected' : ''; ?>><?php echo $pd_service_name; ?></option>
                            <?php } ?>
                        </select>
                        <p class="zl-exam"></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

require_once('podcasts-cron.php');

// unschedule event upon plugin deactivation
register_deactivation_hook(__FILE__, 'cronstarter_deactivate');


//add iframe player to podcast detail page
add_filter('the_content', 'zl_add_iframe_embed_to_podcast_detail');
function zl_add_iframe_embed_to_podcast_detail($content)
{
    if (is_single() && 'zl_podcast' == get_post_type()) {
        $zl_pdm_embed_position = get_option('zl_pdm_embed_position');
        $pd_link = get_post_meta(get_the_ID(), 'zl_pd_link', true);
        $pd_guid = get_post_meta(get_the_ID(), 'zl_pd_guid', true);
        $pd_service = get_post_meta(get_the_ID(), 'zl_pd_service', true);
        $pd_embed_src = urldecode($pd_link);
        if ($pd_embed_src) {
            if ($pd_service == 'anchor-fm')
                $pd_embed_src .= '/embed';
            $custom_content = '<iframe frameborder="0" scrolling="no" src="' . esc_url($pd_embed_src) . '" data-id="' . esc_url(urldecode($pd_guid)) . '"></iframe><br>';
            if ($zl_pdm_embed_position == 'after_ct') {
                $content = $content . $custom_content;
            } else {
                $content = $custom_content . $content;
            }
        }
    }
    return $content;
}
