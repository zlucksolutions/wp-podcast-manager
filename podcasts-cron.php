<?php

// and make sure it's called whenever WordPress loads
add_action('wp', 'zl_pdm_cronstarter_activation');
function zl_pdm_cronstarter_activation()
{
    // create a scheduled event (if it does not exist already)
    $cron_start_time = get_option('zl_podcast_cron_start_time');
    if ($cron_start_time == '') {

        zl_pdm_cronstarter_deactivate();
        return false;
    }
    $schedule_at = strtotime($cron_start_time);
    if (!wp_next_scheduled('zl_pdm_cronjobs')) {
        wp_schedule_event($schedule_at, 'zl_podcast_cron', 'zl_pdm_cronjobs');
    }
}

// unschedule event upon plugin deactivation
function zl_pdm_cronstarter_deactivate()
{
    // find out when the last event was scheduled
    $timestamp = wp_next_scheduled('zl_pdm_cronjobs');
    // unschedule previous event if any
    wp_unschedule_event($timestamp, 'zl_pdm_cronjobs');
}

// add cron interval
add_filter('cron_schedules', 'zl_pdm_cron_add_minute');
function zl_pdm_cron_add_minute($schedules)
{
    $cron_time = get_option('zl_podcast_cron_time');
    $cron_time = ($cron_time > 0) ? $cron_time : 0;
    if ($cron_time <= 0) {
        zl_pdm_cronstarter_deactivate();
        return false;
    }
    $cron_time = (($cron_time * 60) * 60);
    // Adds once every minute to the existing schedules.
    $schedules['zl_podcast_cron'] = array(
        'interval' => $cron_time,
        'display' => __('Zluck Podcast Cron')
    );
    return $schedules;
}

// hook that function onto our scheduled event:
add_action('zl_pdm_cronjobs', 'zl_pdm_function_to_get_podcats_using_cron');
function zl_pdm_function_to_get_podcats_using_cron()
{
    // here's the function we'd like to call with our cron job
    /* List podcasts from RSS feed and save it to Database */
    $rss_url = get_option('zl_anchor_fm_podcast_url');
    $default_author = get_option('zl_anchor_default_author');
    if ($rss_url != '') {

        $xml = fetch_feed($rss_url);


        global $wpdb;
        foreach ($xml->get_items() as $key => $list) {
            $pd_link = $list->get_permalink();

            $guid = $list->get_item_tags('', 'guid');
            $pd_guid = trim($guid[0]['data']);

            if ($pd_link == '') continue;
            //$content = '<iframe frameborder="0" scrolling="no" src="'.$pd_link.'/embed" data-id="'.$pd_guid.'"></iframe><br><br>'.$list->description;
            $postarray = array(
                'post_type' => 'zl_podcast',
                'post_title' => trim($list->get_title()),
                'post_content' => trim($list->get_description()),
                'post_status' => 'publish',
                'post_author' => $default_author,
                'meta_input' => array(
                    'zl_pd_link' => urlencode($pd_link),
                    'zl_pd_guid' => urlencode($pd_guid),
                    'zl_pd_service' => 'anchor-fm',
                    'zl_imported' => '1'
                    // and so on ;)
                )
            );
            $pubDate = date('Y-m-d H:i:s', strtotime($list->get_date()));
            if ($pubDate != '') {
                $postarray['post_date'] = $pubDate;
                $postarray['post_date_gmt'] = $pubDate;
            }

            $args = array(
                'post_type' => 'zl_podcast',
                'meta_query' => array(
                    array(
                        'key' => 'zl_pd_guid',
                        'value' => urlencode($pd_guid),
                        'compare' => '=',
                    )
                )
            );
            $already_added = new WP_Query($args);

            if ($already_added->have_posts()) {
                $already_added->the_post();
                $post_id = get_the_ID();
                $postarray['ID'] = $post_id;
            }
            wp_insert_post($postarray);
        }
    }
}
