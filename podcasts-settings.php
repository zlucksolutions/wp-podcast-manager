<?php 
$current_tab = ( $_GET['tab'] ?? null );
$tabs = [
        'import'  => [
            'title'     => __( "Import Feed", 'wp-podcasts-manager' )
        ],
        'scheduled-list'  => [
            'title'     => __( "Scheduled Imports", 'wp-podcasts-manager' )
        ],
        // 'upgration'  => [
        //     'title'     => __( "Upgrade", 'wp-podcasts-manager' )
        // ],
    ];

    if( !isset( $tabs[ $current_tab ] ) )
    $current_tab = array_key_first( $tabs );
?>
<div class="wrap wp-podcasts-manager">
    <h1><?php _e('Podcasts Settings', 'wp-podcasts-manager'); ?></h1>
    <nav class="nav-tab-wrapper">
        <?php foreach( $tabs as $tab_alias => $tab_information ) : ?>
        <a href="edit.php?post_type=zl_podcast&page=podcasts&tab=<?php echo esc_attr($tab_alias); ?>" class="nav-tab<?php echo $tab_alias === $current_tab ? ' nav-tab-active' : '' ?>">
            <?php echo esc_html( $tab_information[ 'title' ] ); ?>
        </a>
        <?php endforeach; ?>
    </nav>

    <?php
    $current_tab = ($_GET['tab']);
    switch ($current_tab) {
        case "import":
            zl_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time);
            break;
        case "scheduled-list":
            zl_importer_scheduled_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time);
            break;
        case "upgration":
            zl_upgration_podcast();
            break;
        default:
            zl_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time);
    }
    // ?>
</div>


<?php
function zl_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time){
    zl_common_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time, $cron = false, $runnow = true);
}

function zl_importer_scheduled_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time){
    zl_common_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time, $cron = true, $runnow = false);
}

function zl_upgration_podcast(){
    ?>
    <div id="wpbody" role="main">
        <div id="wpbody-content">
            <div class="wrap nosubsub">
                <hr class="wp-header-end">
                <div id="ajax-response"></div>
                <div id="col-container" class="wp-clearfix">
                    <div id="col-left">
                        <div class="col-wrap">
                            <div class="form-wrap">
                                <div class="zl-podcast-setting zl-setting-2">
                                    <div class="upgrade-zl-podcast">
                                        <h3>Upgrade to Pro and Get Additional Features:</h3>
                                        <h4>
                                            <li>Import podcast from all podcast platform</li>
                                            <li>Shortcode for display the podcasts list anywhere in website pages.</li>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php
}

function zl_common_importer_podcast($errormsg, $zl_pdm_archive_page_slug, $zl_pdm_embed_position, $url, $type, $zl_anchor_default_author, $cron_start_time, $cron_time, $cron = false, $runnow = false){
    ?>
    <div id="wpbody" role="main">
        <div id="wpbody-content">
            <div class="wrap nosubsub">
                <hr class="wp-header-end">
                <div id="ajax-response"></div>
                <div id="col-container" class="wp-clearfix">
                    <div id="col-left">
                        <div class="col-wrap">
                            <div class="form-wrap">
                                <p><?php _e($errormsg, 'wp-podcasts-manager'); ?></p>
                                <form id="add_zl_podcast_url" method="post" action="" class="validate zl-admin-form">
                                    <div class="zl-podcast-setting zl-setting-2">
                                        <div <?php if($cron === true){ echo 'style="display: none;"'; } ?>>
                                            <h2><?php _e('We\'ll retrive your podcasts from this URL. ', 'wp-podcasts-manager'); ?></h2>
                                            <!-- <div class="form-field form-required term-name-wrap">
                                                <label for="zl_anchor_fm_podcast_url"><b> <?php _e('Anchor Podcast URL', 'wp-podcasts-manager'); ?></b></label>
                                                <input name="zl_anchor_fm_podcast_url" id="zl_anchor_fm_podcast_url" type="text" value="<?php echo esc_url($url) ?>" aria-required="true" required="required" />
                                                <p>The Anchor.FM Podcast URL, from where we can collect your podcasts. Guide to get the <small><a href="<?php echo esc_url('https://help.anchor.fm/hc/en-us/articles/360027712351-Locating-your-Anchor-RSS-feed'); ?>" target="_blank"><?php _e('(RSS feed for Anchor FM URL)'); ?></a></small>.</p>
                                            </div> -->
                                            <div class="form-field form-required term-name-wrap">
                                                <label for="zl_anchor_fm_podcast_url"><b> <?php _e('Podcast URL', 'wp-podcasts-manager'); ?></b></label>
                                                <p>Enter your podcast URL to collect episodes<br>
                                                <input name="zl_anchor_fm_podcast_url" id="zl_anchor_fm_podcast_url" type="text" value="<?php echo esc_url($url) ?>" aria-required="true" required="required" />
                                                Example RSS Feed URL - <a href="https://audience.castos.com/feed" target="_blank">https://audience.castos.com/feed</a><br>
                                                <small>(More examples <a href="<?php echo esc_url('https://anchor.fm/s/10dabf00/podcast/rss'); ?>" target="_blank"><?php _e('Anchor FM'); ?></a>,
                                                        <a href="<?php echo esc_url('https://feeds.soundcloud.com/users/soundcloud:users:492135420/sounds.rss'); ?>" target="_blank"><?php _e('Podbean'); ?></a>,
                                                        <a href="<?php echo esc_url('https://audience.castos.com/feed'); ?>" target="_blank"><?php _e('Apple'); ?></a>,
                                                        <a href="<?php echo esc_url('https://audience.castos.com/feed'); ?>" target="_blank"><?php _e('Google'); ?></a>,
                                                        <a href="<?php echo esc_url('https://feeds.acast.com/public/shows/5d28ef74d3cc3f013778b13b'); ?>" target="_blank"><?php _e('Acast'); ?></a>,
                                                        <a href="<?php echo esc_url('http://rss.art19.com/the-daily'); ?>" target="_blank"><?php _e('Simplecast'); ?></a>,
                                                        <a href="<?php echo esc_url('https://feeds.buzzsprout.com/1875696.rss'); ?>" target="_blank"><?php _e('Buzzsprout'); ?></a>,
                                                        <a href="<?php echo esc_url('https://feeds.simplecast.com/k6dY_SbZ'); ?>" target="_blank"><?php _e('Spotify'); ?></a>
                                                    )</small>
                                                </p>
                                            </div>                                    
                                            <div class="form-field form-required term-name-wrap" style="display: none;">
                                                <label for="zl_get_post_type"><b><?php _e('Post Type', 'wp-podcasts-manager'); ?></b></label>
                                                <?php 
                                                echo '<select name="zl_post_type_get">';
                                                ?>
                                                <option value="zl_podcast" <?php if($type == 'zl_podcast'){ echo "selected"; } ?>>Podcast</option>
                                                <?php
                                                echo '</select>';
                                                ?>
                                                <span class="zl-ajax-loader"></span>
                                            </div>
                                            <div class="form-field form-required term-name-wrap post_type_category">
                                            </div>
                                            <div class="form-field form-required term-name-wrap">
                                                <label for="zl_anchor_default_author"><b><?php _e('Assign Imported Podcasts to', 'wp-podcasts-manager'); ?></b></label>
                                                <?php wp_dropdown_users(array('name' => 'zl_anchor_default_author', 'selected' => $zl_anchor_default_author)); ?>
                                            </div>
                                        </div>
                                        <div <?php if($runnow === true){ echo 'style="display: none;"'; } ?>>                                        
                                            <h2><?php _e('Podcast Cron - Auto script to collect podcasts from the given URL.', 'wp-podcasts-manager'); ?></h2>
                                            <div class="form-field form-required term-name-wrap">
                                                <label for="zl_podcast_cron_start_time"><b>Podcast Cron Start time</b><small><i> (for when to execute the event.)</i></small></label>
                                                <input name="zl_podcast_cron_start_time" id="zl_pdm_cron_start_time" type="time" value="<?php echo $cron_start_time ?>" aria-required="true" required="required" />
                                                <p><?php _e('Podcast cron will start from this time and will continue running at defined intervals as below.', 'wp-podcasts-manager'); ?></p>
                                            </div>
                                            <div class="form-field form-required term-name-wrap">
                                                <label for="zl_podcast_cron_time"><b>Run Cron to fetch Podcasts at every X hours - </b><small><i> (Eg. - for every 1 hour 30 minutes - enter 1.5)</i></small></label>
                                                <input name="zl_podcast_cron_time" id="zl_pdm_cron_time" type="number" min="0" step="any" value="<?php echo $cron_time ?>" aria-required="true" required="required" />
                                                <p><?php _e('The Podcast Cron will run at every X hours - (eg. every 2 hours).', 'wp-podcasts-manager'); ?></p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="zl-button">
                                            <?php
                                            wp_nonce_field('zl-podcasts-settings-save', 'zl-podcasts-settings');
                                            if($cron === true){
                                                submit_button();
                                            }else{
                                                submit_button('Save & Run Now', 'primary runnow', 'runnow');
                                            }
                                            ?>
                                            <div></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="zl-podcast-setting" <?php if($cron === true){ echo 'style="display: none;"'; } ?>>
                                        <h2><?php _e('General Settings.', 'wp-podcasts-manager'); ?></h2>
                                        <div class="form-field form-required term-name-wrap">
                                            <label for="zl_pdm_archive_page_slug"><b><?php _e('Podcasts Archive Page Slug', 'wp-podcasts-manager'); ?></b>
                                                <div class="hint">
                                                    <i class="hint-icon">i</i>
                                                    <div class="hint-description"><?php _e('Leave empty if you are not sure what it is for.', 'wp-podcasts-manager'); ?></div>
                                                </div>
                                            </label>
                                            <input name="zl_pdm_archive_page_slug" id="zl_pdm_archive_page_slug" type="text" value="<?php echo $zl_pdm_archive_page_slug; ?>" aria-required="true" />
                                        </div>
                                        <div class="form-field form-required term-name-wrap">
                                            <label for="zl_pdm_embed_position"><b><?php _e('Podcasts Embed Position', 'wp-podcasts-manager'); ?></b>
                                                <div class="hint">
                                                    <i class="hint-icon">i</i>
                                                    <div class="hint-description"><?php _e("Where you want to see the podcast."); ?></div>
                                                </div>
                                            </label>
                                            <div class="zl-radio">
                                                <span class="before_ct">
                                                    <input type="radio" id="before_ct" class="zl-embed-position" name="zl_pdm_embed_position" value="before_ct" <?php echo (($zl_pdm_embed_position == 'before_ct') || empty($zl_pdm_embed_position)) ? 'checked' : ''; ?>><label for="before_ct">Before the content</label>
                                                </span>
                                                <span class="after_ct">
                                                    <input type="radio" id="after_ct" class="zl-embed-position" name="zl_pdm_embed_position" value="after_ct" <?php echo ($zl_pdm_embed_position == 'after_ct') ? 'checked' : ''; ?>><label for="after_ct">After the content</label>
                                                </span>
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="form-field form-required term-name-wrap">
                                            <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
                                            <label for="zl_podcast_shortcode"><b>Podcast Shortcode</b></label>                                            
                                            <div class="clipboard">
                                                <input onclick="copy()" class="copy-input" value="<?php _e("[zl_podcast cat='name1, name2' limit=10]", 'wp-podcasts-manager'); ?>" id="copyClipboard" readonly>
                                                <button class="copy-btn" type="button" id="copyButton" onclick="copy()"><i class="far fa-copy"></i></button>
                                            </div>
                                            <div id="copied-success" class="copied">
                                                <span>Copied!</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php
}