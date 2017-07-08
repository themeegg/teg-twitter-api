<?php
/**
 * The template for displaying Twitter trends
 *
 * This template can be overridden by copying it to yourtheme/teg-twitter-api/content-widget-twitter-trends.php
 *
 * HOWEVER, on occasion TEG Twitter API will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.themeegg.com/document/template-structure/
 * @author  ThemeEgg
 * @package TEGTwitterApi/Templates
 * @version 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?>
<div class="teg-ta-feeds-widget">
    <div class="teg-ta-template <?php echo $instance['teg_ta_twitter_feed_widget_layout'] ?>">

        <?php do_action('teg_ta_twitter_feed_widget_layout_before', 10, 0) ?>
        <ul>
            <?php

            foreach ($twitter_feeds_array as $feed_index => $feed) {

                ?>

                <li>
                    <div class="teg-ta-user-logo"></div>
                    <div class="teg-ta-single-feeds">
                        <h5><a href="#user-link"><span class="teg-ta-account-name">Theme Egg</span><span class="teg-ta-user-name">@<?php echo esc_attr($twitter_username) ?></span></a></h5>
                        <p><?php echo esc_attr($feed['text']); ?></p>
                        <div class="teg-ta-feeds-actions">
                            <span class="teg-ta-feed-like">Like</span>
                            <span class="teg-ta-feed-share">Share</span>
                            <span class="teg-ta-feed-post-time">1h</span>
                        </div>
                    </div>

                </li>

                <?php

            }
            ?>
        </ul>
        <?php do_action('teg_ta_twitter_feed_widget_layout_after', 10, 0) ?>

    </div>
</div>