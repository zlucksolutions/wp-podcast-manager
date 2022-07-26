<div id="wpbody" role="main">
    <div id="wpbody-content">
        <div class="wrap nosubsub">
            <h1 class="wp-heading-inline"><?php _e('Podcasts Settings', 'zl_podcast'); ?></h1>
            <hr class="wp-header-end">
            <div id="ajax-response"></div>
            <div id="col-container" class="wp-clearfix">
                <div id="col-left">
                    <div class="col-wrap">
                        <div class="form-wrap">
                            <p><?php _e($errormsg, 'zl_podcast'); ?></p>
                            <form id="add_zl_podcast_url" method="post" action="" class="validate zl-admin-form">
                                <div class="zl-podcast-setting">
                                    <h2><?php _e('General Settings.', 'zl_podcast'); ?></h2>
                                    <div class="form-field form-required term-name-wrap">
                                        <label for="zl_pdm_archive_page_slug"><b><?php _e('Podcasts Archive Page Slug', 'zl_podcast'); ?></b></label>
                                        <input name="zl_pdm_archive_page_slug" id="zl_pdm_archive_page_slug" type="text" value="<?php echo $zl_pdm_archive_page_slug ?>" aria-required="true" />
                                        <p><?php _e('Leave empty if you are not sure what it is for.', 'zl_podcast'); ?></p>
                                    </div>
                                    <div class="form-field form-required term-name-wrap">
                                        <label for="zl_pdm_embed_position"><b><?php _e('Podcasts Embed Position', 'zl_podcast'); ?></b></label>
                                        <div class="zl-radio">
                                            <span class="before_ct">
                                                <input type="radio" id="before_ct" class="zl-embed-position" name="zl_pdm_embed_position" value="before_ct" <?php echo (($zl_pdm_embed_position == 'before_ct') || empty($zl_pdm_embed_position)) ? 'checked' : ''; ?>><label for="before_ct">Before the content</label>
                                            </span>
                                            <span class="after_ct">
                                                <input type="radio" id="after_ct" class="zl-embed-position" name="zl_pdm_embed_position" value="after_ct" <?php echo ($zl_pdm_embed_position == 'after_ct') ? 'checked' : ''; ?>><label for="after_ct">After the content</label>
                                            </span>
                                            <div></div>
                                        </div>
                                        <p><?php _e("Select option for where to show podcast position. By default it's show before the content.") ?></p>
                                    </div>
                                </div>
                                <br>

                                <div class="zl-podcast-setting zl-setting-2">

                                    <h2><?php _e('We\'ll retrive your podcasts from this URL. ', 'zl_podcast'); ?></h2>
                                    <div class="form-field form-required term-name-wrap">
                                        <label for="zl_anchor_fm_podcast_url"><b> <?php _e('Podcast URL', 'zl_podcast'); ?></b></label>
                                        <input name="zl_anchor_fm_podcast_url" id="zl_anchor_fm_podcast_url" type="text" value="<?php echo esc_url($url) ?>" aria-required="true" required="required" />
                                        <p>The Anchor.FM Podcast URL, from where we can collect your podcasts. Guide to get the <small><a href="<?php echo esc_url('https://help.anchor.fm/hc/en-us/articles/360027712351-Locating-your-Anchor-RSS-feed'); ?>" target="_blank"><?php _e('(RSS feed for Anchor FM URL)'); ?></a></small>.</p>
                                    </div>
                                    <div class="form-field form-required term-name-wrap">
                                        <label for="zl_anchor_default_author"><b><?php _e('Assign Imported Podcasts to', 'zl_podcast'); ?></b></label>
                                        <?php wp_dropdown_users(array('name' => 'zl_anchor_default_author', 'selected' => $zl_anchor_default_author)); ?>
                                    </div>
                                    <h2><?php _e('Podcast Cron - Auto script to collect podcasts from the given URL.', 'zl_podcast'); ?></h2>
                                    <div class="form-field form-required term-name-wrap">
                                        <label for="zl_podcast_cron_start_time"><b>Podcast Cron Start time</b><small><i> (for when to execute the event.)</i></small></label>
                                        <input name="zl_podcast_cron_start_time" id="zl_pdm_cron_start_time" type="time" value="<?php echo $cron_start_time ?>" aria-required="true" required="required" />
                                        <p><?php _e('Podcast cron will start from this time and will continue running at defined intervals as below.', 'zl_podcast'); ?></p>
                                    </div>
                                    <div class="form-field form-required term-name-wrap">
                                        <label for="zl_podcast_cron_time"><b>Run Cron to fetch Podcasts at every X hours - </b><small><i> (Eg. - for every 1 hour 30 minutes - enter 1.5)</i></small></label>
                                        <input name="zl_podcast_cron_time" id="zl_pdm_cron_time" type="number" min="0" step="any" value="<?php echo $cron_time ?>" aria-required="true" required="required" />
                                        <p><?php _e('The Podcast Cron will run at every X hours - (eg. every 2 hours).', 'zl_podcast'); ?></p>
                                    </div>
                                    <br>
                                    <div class="zl-button">
                                        <?php
                                        wp_nonce_field('zl-podcasts-settings-save', 'zl-podcasts-settings');
                                        submit_button();
                                        submit_button('Save & Run Now', 'primary runnow', 'runnow');
                                        ?>
                                        <div></div>
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