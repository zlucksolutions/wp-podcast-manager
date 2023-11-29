<?php

/**
 * Plugin Name: WP Podcasts Manager
 * Plugin URI: https://www.zluck.com/
 * Description: This is the Podcast plugin, that will collect podcasts from Anchor.FM, Spotify, Apple, Podbeans and other services platforms. It also allows to create new podcasts.
 * Version: 1.2
 * Author: Zluck
 * Author URI: https://zluck.com/
 **/

define("FILE_PATH", plugin_dir_url(__FILE__));
define( "PODCAST_IMPORTER_ALIAS", 'wp_podcasts_manager' );
define( "PODCAST_IMPORTER_PREFIX", 'wp-podcasts-manager' );

include_once('classes/class-episode-import.php');
require_once('podcasts-cron.php');

function zl_pdm_enque_style()
{
    wp_enqueue_style('zl_pdm_style', FILE_PATH . 'assets/css/zl_pdm_style.css', '1.0');
    wp_enqueue_script('zl_pdm_script', FILE_PATH . 'assets/js/zl_pdm_script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'zl_pdm_enque_style');
function zl_pdm_admin_enque_style()
{
    wp_enqueue_style('zl_pdm_style', FILE_PATH . 'assets/css/zl_pdm_admin_style.css', '1.0');
    wp_enqueue_script('zl_pdm_custom_script', FILE_PATH . 'assets/js/zl_pdm_custom_script.js', array('jquery'), '1.0', true);
    wp_localize_script('zl_pdm_custom_script', 'wpAjax', array('ajaxUrl' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'zl_pdm_admin_enque_style');
/* Register Custom Post Type For Podcasts*/
add_action('init', 'zl_pdm_register_post_type_podcast');
function zl_pdm_register_post_type_podcast()
{
    $plg_name = 'Podcast';
    $zl_pdm_archive_page_slug = get_option('zl_pdm_archive_page_slug');
    if ($zl_pdm_archive_page_slug)
        $archive_page_slug = $zl_pdm_archive_page_slug;
    else
        $archive_page_slug  = 'podcasts';
        $single_item_slug   = 'podcast';
    $supports = array(
        'title', // post title
        'link' => 'Podcast Link',
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
    );
    $labels = array(
        'name' => _x('WP ' . $plg_name . 's', 'plural'),
        'singular_name' => _x($plg_name, 'singular'),
        'menu_name' => _x('WP ' . $plg_name . 's', 'admin menu'),
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
        'menu_icon' => 'dashicons-rss',
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
    $url                        = get_option('zl_anchor_fm_podcast_url');
    $post_type                  = get_option('zl_post_type_get');
    $category                   = get_option('zl_category_get');
    $taxonomies                 = get_option('zl_taxonomy_get');
    $zl_anchor_default_author   = get_option('zl_anchor_default_author');
    $zl_pdm_archive_page_slug   = get_option('zl_pdm_archive_page_slug');
    $zl_pdm_embed_position      = get_option('zl_pdm_embed_position');
    $cron_time                  = get_option('zl_podcast_cron_time');
    $cron_start_time            = get_option('zl_podcast_cron_start_time');
    if (!empty($_POST) && isset($_POST['zl_anchor_fm_podcast_url']) && $_POST['zl_anchor_fm_podcast_url'] != '') {
        $url                        = esc_url_raw($_POST['zl_anchor_fm_podcast_url']);
        $post_type                  = sanitize_text_field($_POST['zl_post_type_get']);
        $category                   = sanitize_text_field($_POST['zl_category_get']);
        $taxonomies                 = sanitize_text_field($_POST['zl_taxonomie']);
        $zl_anchor_default_author   = sanitize_text_field($_POST['zl_anchor_default_author']);
        $zl_pdm_archive_page_slug   = sanitize_text_field($_POST['zl_pdm_archive_page_slug']);
        $zl_pdm_embed_position      = sanitize_text_field($_POST['zl_pdm_embed_position']);
        $cron_time_u                = sanitize_text_field($_POST['zl_podcast_cron_time']);
        $cron_time_u = round(($cron_time_u * 2), 0) / 2;
        if ($cron_start_time != $_POST['zl_podcast_cron_start_time'] || $cron_time_u != $cron_time) {
            zl_pdm_cronstarter_deactivate();
        }
        $cron_start_time = sanitize_text_field($_POST['zl_podcast_cron_start_time']);
        $cron_time = $cron_time_u;
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            update_option('zl_anchor_fm_podcast_url', $url);
            update_option('zl_post_type_get', $post_type);
            update_option('zl_category_get', $category);
            update_option('zl_anchor_default_author', $zl_anchor_default_author);
            update_option('zl_pdm_archive_page_slug', $zl_pdm_archive_page_slug);
            update_option('zl_pdm_embed_position', $zl_pdm_embed_position);
            update_option('zl_podcast_cron_time', $cron_time);
            update_option('zl_podcast_cron_start_time', $cron_start_time);
            update_option('zl_taxonomy_get', $taxonomies);
            $errormsg = "Podcast settings updated successfully!!";
            if (isset($_POST['runnow'])) {
                $arry = array(
                    "import_rss_feed" => $url,
                    "import_post_type" => $post_type,
                    "import_series" => $category,
                    "import_author" => $zl_anchor_default_author,
                    "import_taxonomy" => $taxonomies,
                );
                $rss_importer     = new RSS_Import_Handler($arry);
                $response = $rss_importer->import_rss_feed();
                if ($response['status'] == 'error') {
                    $errormsg = $response['message'];
                } else {
                    $errormsg = 'Message:- ' . $response['message'] . '<br>';
                    $errormsg .= 'Episodes:- ' . $response['count'];
                    //$errormsg .= 'Episodes:- '.$response['episodes'];
                }
                //$errormsg = "Podcast settings execute successfully!!";
            }
        } else {
            $errormsg = "$url is not a valid URL - (Include http:// or https:// in your URL)";
        }
    }

    include_once('podcasts-settings.php');
    // $current_tab = ($_GET['tab']);
    // switch ($current_tab) {
    //     case "import":
    //         zl_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time);
    //         break;
    //     case "scheduled-list":
    //         zl_importer_scheduled_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time);
    //         break;
    //     default:
    //         zl_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time);
    // }
}
//Update post meta 
add_action('transition_post_status', 'zl_pdm_check_on_post_status_change', 10, 3);
function zl_pdm_check_on_post_status_change($new_status, $old_status, $post)
{
    if ($post->post_type == 'zl_podcast' && $old_status != 'new' && isset($_POST['zl_pd_link'])) {
        //update_post_meta($post->ID, 'zl_pd_link', sanitize_meta('zl_pd_link', $_POST['zl_pd_link'], 'post'));
        update_post_meta($post->ID, 'zl_pd_service', sanitize_meta('zl_pd_service', $_POST['zl_pd_service'], 'post'));
        update_post_meta($post->ID, 'zl_pd_hide', sanitize_text_field($_POST['zl_pd_hide']));
        // strips out any possible weirdness in the file url
        $url = preg_replace('/(?s:.*)(https?:\/\/(?:[\w\-\.]+[^#?\s]+)(?:\.mp3))(?s:.*)/', '$1', sanitize_text_field($_POST['zl_pd_link']));
        // Set the audio_file
        update_post_meta($post->ID, 'audio_file', $url);
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
        $post_meta      = get_post_meta($post->ID);
        $pd_link        = isset($post_meta['audio_file'][0]) ? $post_meta['audio_file'][0] : '';
        $pd_service     = isset($post_meta['zl_pd_service'][0]) ? $post_meta['zl_pd_service'][0] : '';
        $pd_hide   = !empty(get_post_meta($post->ID, 'zl_pd_hide', true)) ? get_post_meta($post->ID, 'zl_pd_hide', true) : '';
        $pd_services    = array('other' => 'Other', 'anchor-fm' => 'Anchor FM');
?>
        <div class="form-wrap">
            <br><br />
            <div class="postbox">
                <h2 class="hndle"><span><?php _e('Podcast Player Link', 'zl_podcast'); ?></span></h2>
                <div class="inside">
                    <div class="form-field form-required term-name-wrap">
                        <input name="zl_pd_link" id="zl_anchor_fm_podcast_url" type="url" value="<?php echo $pd_link; ?>" aria-required="true" required="required" />
                        <p class="zl-exam"><?php _e('For eg. <a href="' . esc_url('https://chtbl.com/track/28D482/episodes.castos.com/audience/4310/315d6718-d307-41fe-bac0-79e3e346d51e/Dirt-Cheap-Reair.mp3') . '" target="_blank">xyz.com/dfsd</a> it will be embedded using iframe'); ?></p>
                    </div>
                </div>
                <h2 class="hndle"><span><?php _e('Podcast', 'zl_podcast'); ?></span></h2>
                <div class="inside">
                    <div class="form-field form-required term-name-wrap">
                        <input type="radio" name="zl_pd_hide" value="show" <?php if ($pd_hide === "show" || empty($pd_hide)) { echo "checked"; } ?>> <?php _e(' Show ', 'zl_podcast'); ?> </input> 
                        <input type="radio" name="zl_pd_hide" value="hide" <?php if ($pd_hide === "hide") { echo "checked"; } ?>> <?php _e(' Hide', 'zl_podcast'); ?></input>
                        <p class="zl-exam"></p>
                    </div>
                </div> 
            </div>
            <?php /* <div class="postbox">
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
            </div> */ ?>
            <!-- <div class="postbox">
                <h2 class="hndle"><span><?php //_e('Podcast', 'zl_podcast'); ?></span></h2>
                <div class="inside">
                    <div class="form-field form-required term-name-wrap">
                        <input type="radio" name="zl_pd_hide" value="show" <?php //if ($pd_hide === "show") { echo "checked"; } ?>> <?php //_e(' Show ', 'zl_podcast'); ?> </input> 
                        <input type="radio" name="zl_pd_hide" value="hide" <?php //if ($pd_hide === "hide") { echo "checked"; } ?>> <?php //_e(' Hide', 'zl_podcast'); ?></input>
                        <p class="zl-exam"></p>
                    </div>
                </div>
            </div> -->
        </div>
    <?php
    }
}

// unschedule event upon plugin deactivation
register_deactivation_hook(__FILE__, 'zl_pdm_cronstarter_deactivate');
function get_local_file_path($file)
{
    // Identify file by root path and not URL (required for getID3 class)
    $site_root = trailingslashit(ABSPATH);
    // Remove common dirs from the ends of site_url and site_root, so that file can be outside of the WordPress installation
    $root_chunks = explode('/', $site_root);
    $url_chunks  = explode('/', bloginfo('url'));
    end($root_chunks);
    end($url_chunks);
    while (!is_null(key($root_chunks)) && !is_null(key($url_chunks)) && (current($root_chunks) == current($url_chunks))) {
        array_pop($root_chunks);
        array_pop($url_chunks);
        end($root_chunks);
        end($url_chunks);
    }
    $site_root = implode('/', $root_chunks);
    $site_url  = implode('/', $url_chunks);
    $file = str_replace($site_url, $site_root, $file);
    return $file;
}

//add iframe player to podcast detail page
add_filter('the_content', 'zl_add_iframe_embed_to_podcast_detail');
function zl_add_iframe_embed_to_podcast_detail($content)
{
    if (is_single() && get_post_meta(get_the_ID(), "audio_file", true) != '') {
        $zl_pdm_embed_position = get_option('zl_pdm_embed_position');
        $custom_content = '<div class="castos-player dark-mode" data-episode="' . get_the_ID() . '">
            <div class="player">
                <div class="player__main">
                    <div class="player__artwork player__artwork-'. get_the_ID() .'">
                        <img src="' . FILE_PATH . 'assets/css/images/no-album-art.png">
                    </div>
                    <div class="player__body">
                        <div class="currently-playing">
                            <div class="show player__podcast-title">
                                ' . get_bloginfo('name') . '
                            </div>
                            <div class="episode-title player__episode-title">' . get_the_title() . '</div>
                        </div>
                        <div class="play-progress">
                            <div class="play-pause-controls">
                                <button title="Play" class="play-btn">
                                    <span class="screen-reader-text">Play Episode</span>
                                </button>
                                <button title="Pause" class="pause-btn hide">
                                    <span class="screen-reader-text">Pause Episode</span>
                                </button>
                                <img src="' . FILE_PATH . 'assets/css/images/player/images/icon-loader.svg" class="ssp-loader hide"/>
                            </div>
                            <div>
                                <audio preload="metadata" id="myAudio" class="clip clip-' . get_the_ID() . '">
                                    <source src="' . get_post_meta(get_the_ID(), "audio_file", true) . '">
                                </audio>
                                <div class="ssp-progress" role="progressbar" title="Seek">
                                    <span class="progress__filled"></span>
                                </div>
                                <div class="ssp-playback playback">
                                    <div class="playback__controls">
                                        <button class="player-btn__volume" title="Mute/Unmute">
                                            <span class="screen-reader-text">Mute/Unmute Episode</span>
                                        </button>
                                        <button data-skip="-10" class="player-btn__rwd" title="Rewind 10 seconds">
                                        <span class="screen-reader-text">Rewind 10 Seconds</span>
                                        </button>
                                        <button data-speed="1" class="player-btn__speed" title="Playback Speed">1x</button>
                                        <button data-skip="30" class="player-btn__fwd" title="Fast Forward 30 seconds">
                                            <span class="screen-reader-text">Fast Forward 30 seconds</span>
                                        </button>
                                    </div>
                                    <div class="playback__timers">
                                        <time class="ssp-timer">00:00</time>
                                        <span>/</span>
                                        <!-- We need actual duration here from the server -->
                                        <time class="ssp-duration" id="demo"></time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        if ($zl_pdm_embed_position == 'after_ct') {
            $content = $content . $custom_content;
        } else {
            $content = $custom_content . $content;
        }
    }
    return $content;
}

//add shortcode [podcast category="value"]
function zl_podcast_shortcode($atts)
{
    ob_start();
    $attr = shortcode_atts(array(
        'cat' => '',
        'limit' => 10,
    ), $atts);
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'zl_podcast',
        'posts_per_page' => $attr['limit'],
        'post_status' => 'publish',
        'order' => 'ASC',
        'paged' => $paged,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'     => 'zl_pd_hide',
                'value'   => 'hide',
                'compare' => '!='
            ),
            array(
                'key'     => 'zl_pd_hide',
                'compare' => 'NOT EXISTS',
            ),
        )
    );
    if (isset($attr['cat']) && !empty($attr['cat'])) {
        $cat_array = explode(",", $attr['cat']);
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'pd-cat',
                'field' => 'name',
                'terms' => $cat_array
            ),
        );
    }
    $tax_post_qry = new WP_Query($args);
    if ($tax_post_qry->have_posts()) {
        echo "<div class='podcast_content'>";
        while ($tax_post_qry->have_posts()) {
            $tax_post_qry->the_post();
            echo zl_get_content(250);
        }
        echo "<div class='podcast_pagination'>" . zl_pagination($tax_post_qry) . "</div>";
        echo "</div>";
    } else {
        echo "<h3>No posts</h3>";
    }
    return ob_get_clean();
}
add_shortcode('zl_podcast', 'zl_podcast_shortcode');

//add pagination
function zl_pagination($post_qry, $args = array())
{
    $output = '';
    if ($post_qry->max_num_pages <= 1) {
        return;
    }
    $pagination_args = array(
        'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'total'        => $post_qry->max_num_pages,
        'current'      => max(1, get_query_var('paged')),
        'format'       => '?paged=%#%',
        'show_all'     => false,
        'type'         => 'plain',
        'end_size'     => 2,
        'mid_size'     => 1,
        'prev_next'    => true,
        'prev_text'    => sprintf(
            '<i></i> %1$s',
            apply_filters(
                'zl_pagination_page_numbers_previous_text',
                __('<', 'podcasts')
            )
        ),
        'next_text'    => sprintf(
            '%1$s <i></i>',
            apply_filters(
                'zl_pagination_page_numbers_next_text',
                __('>', 'podcasts')
            )
        ),
        'add_args'     => false,
        'add_fragment' => '',
        // Custom arguments not part of WP core:
        'show_page_position' => false, // Optionally allows the "Page X of XX" HTML to be displayed.
    );
    $pagination_args = apply_filters('my_pagination_args', array_merge($pagination_args, $args), $pagination_args);
    $output .= paginate_links($pagination_args);
    // Optionally, show Page X of XX.
    if (true == $pagination_args['show_page_position'] && $post_qry->max_num_pages > 0) {
        $output .= '<span class="page-of-pages">' . sprintf(__('Page %1s of %2s', 'text-domain'), $pagination_args['current'], $post_qry->max_num_pages) . '</span>';
    }
    return $output;
}

function zl_get_content($count)
{
    $permalink = get_permalink(get_the_ID());
    $excerpt = get_the_content();
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = $excerpt . ' [...] ';
    $html = '<div class="podcast_attr">';
    $html .= '<h3><a href=' . $permalink . '>' . get_the_title() . '</a></h3>';
    $html .= '<div class="posdcast_dec">' . $excerpt . '</div>';
    $html .= '</div>';
    return $html;
}

//Post Category Get
add_action('wp_ajax_zl_pdm_category_get', 'zl_pdm_category_get');
add_action('wp_ajax_nopriv_zl_pdm_category_get', 'zl_pdm_category_get');
function zl_pdm_category_get()
{
    $post_type      = 'zl_podcast';
    $taxonomies     = get_object_taxonomies($post_type, 'objects');
    $category       = get_option('zl_category_get');
    echo '<label for="zl_get_post_type_category"><b>Category</b></label>';
    echo '<select name="zl_category_get"><option value="">Select</option>';
    //
    $terms = get_terms(array(
        'taxonomy' => array_key_first($taxonomies),
        'hide_empty' => false,
    ));
    foreach ($terms as $term) {
    ?>
        <option value="<?php echo $term->term_id; ?>" <?php if ($term->term_id == $category) {
                                                            echo "selected";
                                                        } ?>><?php echo $term->name; ?></option>
<?php
    }
    echo '</select><input type="hidden" name="zl_taxonomie" value=' . array_key_first($taxonomies) . '>';
    die();
}
