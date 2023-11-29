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
	$rss_tags = array('title', 'link', 'guid', 'comments', 'description', 'pubDate', 'category');
	$rss_item_tag = 'item';
	$rss_url            = $rss_url;
	$default_author     = get_option('zl_anchor_default_author');
	$post_type          = get_option('zl_post_type_get');
	$category           = get_option('zl_category_get');
	$taxonomy           = get_option('zl_taxonomy_get');
	$arry = array(
		"import_rss_feed" => $rss_url,
		"import_post_type" => $post_type,
		"import_series" => $category,
		"import_author" => $default_author,
		"import_taxonomy" => $taxonomy,
	);
	$rss_importer 	= new RSS_Import_Handler($arry);
	$rss_importer->import_rss_feed();
}
