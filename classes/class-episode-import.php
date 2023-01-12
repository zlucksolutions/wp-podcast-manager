<?php
class RSS_Import_Handler
{
    private $rss_feed;
    private $post_author;
    private $post_type;
    private $taxonomy;
    private $series;
    private $feed_object;
    private $podcast_count = 0;
    private $podcast_added = 0;
    private $podcasts_imported = array();

    public function __construct($ssp_external_rss)
    {
        $this->rss_feed     = $ssp_external_rss['import_rss_feed'];
        $this->post_type    = $ssp_external_rss['import_post_type'];
        $this->series       = $ssp_external_rss['import_series'];
        $this->post_author  = $ssp_external_rss['import_author'];
        $this->taxonomy     = $ssp_external_rss['import_taxonomy'];
    }

    public function load_rss_feed()
    {
        $this->feed_object = simplexml_load_string(file_get_contents($this->rss_feed));
    }

    public function update_ssp_rss_import()
    {
        $progress = round(($this->podcast_added / $this->podcast_count) * 100);
        update_option('ssp_rss_import', $progress);
    }

    public function import_rss_feed()
    {
        $this->load_rss_feed();
        // if ( $this->is_rss_feed_locked() ) {
        // 	update_option( 'ssp_external_rss', '' );
        // 	$msg = 'Your podcast cannot be imported at this time because the RSS feed is locked by the existing podcast hosting provider. ';
        // 	$msg .= 'Please unlock your RSS feed with your current host before attempting to import again. ';
        // 	$msg = __( $msg, 'wp-podcasts-manager' );
        // 	return array(
        // 		'status'  => 'error',
        // 		'message' => $msg,
        // 	);
        // }
        if ($this->feed_object->channel->item == '') {
            return array(
                'status'   => 'error',
                'message'  => '' . $this->rss_feed . ' is not a valid URL!!',
            );
        }
        $this->podcast_count = count($this->feed_object->channel->item);
        for ($i = 0; $i < $this->podcast_count; $i++) {
            $item = $this->feed_object->channel->item[$i];
            $this->create_episode($item);
        }
        $this->finish_import();
        return array(
            'status'   => 'success',
            'message'  => 'Podcast settings updated successfully!!',
            'count'    => $this->podcast_added,
            'episodes' => $this->podcasts_imported,
        );
    }
    protected function finish_import()
    {
        update_option('ssp_external_rss', '');
        update_option('ssp_rss_import', '100');
    }
    protected function create_episode($item)
    {
        $post_data = $this->get_post_data($item);

        // Add the post
        $post_id = wp_insert_post($post_data);
        /**
         * If an error occurring adding a post, continue the loop
         */
        if (is_wp_error($post_id)) {
            return;
        }
        $this->save_enclosure($post_id, $this->get_enclosure_url($item));
        // Set the series, if it is available
        if (!empty($this->series)) {
            wp_set_post_terms($post_id, $this->series, $this->taxonomy);
        }
        // Update the added count and imported title array
        $this->podcast_added++;
        $this->podcasts_imported[] = $post_data['post_title'];
        $this->update_ssp_rss_import();
    }

    public function get_item_post_content($item, $itunes)
    {
        $content = $item->children('content', true);
        if (!empty($content->encoded)) {
            return trim((string) $content->encoded);
        }
        if (!empty($item->description)) {
            return trim((string) $item->description);
        }
        if (!empty($itunes->summary)) {
            return trim((string) $itunes->summary);
        }
        return '';
    }

    public function get_post_data($item)
    {
        $itunes                    = $item->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
        $post_data                 = array();
        $post_data['post_content'] = $this->get_item_post_content($item, $itunes);
        $post_data['post_excerpt'] = trim((string) $itunes->subtitle);
        $post_data['post_title']   = trim((string) $item->title);
        $post_data['post_status']  = 'publish';
        $post_data['post_author']  = $this->post_author;
        $post_data['post_date']    = date('Y-m-d H:i:s', strtotime((string) $item->pubDate));
        $post_data['post_type']    = $this->post_type;
        $post_data['meta_input']   = array(
            'zl_pd_guid' => trim((string) $item->guid),
        );
        $args = array(
            'post_type' => $this->post_type,
            'meta_query' => array(
                array(
                    'key' => 'zl_pd_guid',
                    'value' => trim((string) $item->guid),
                    'compare' => '=',
                )
            )
        );

        $already_added = new WP_Query($args);
        if ($already_added->have_posts()) {
            $already_added->the_post();
            $post_id = get_the_ID();
            $post_data['ID'] = $post_id;
        }

        return $post_data;
    }

    protected function save_enclosure($post_id, $url)
    {
        // strips out any possible weirdness in the file url
        $url = preg_replace('/(?s:.*)(https?:\/\/(?:[\w\-\.]+[^#?\s]+)(?:\.mp3))(?s:.*)/', '$1', $url);
        // Set the audio_file
        add_post_meta($post_id, 'audio_file', $url);
    }

    protected function is_rss_feed_locked()
    {
        return 'yes' === (string) $this->feed_object->channel->children('podcast', true)->locked;
    }

    protected function get_enclosure_url($item)
    {
        return (string) @$item->enclosure['url'];
    }
}
