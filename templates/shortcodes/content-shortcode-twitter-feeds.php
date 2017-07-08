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
<div class="teg-ta-feeds-shortcode">
    <div class="teg-ta-template <?php echo get_option('teg_ta_twitter_feed_shortcode_layout', '') ?>">

        <?php do_action('teg_ta_twitter_feed_shortcode_layout_before', 10, 0) ?>

        <h2><?php echo esc_attr($title); ?></h2>
        <ul>
            <?php

            foreach ($twitter_feeds_array as $feed_index => $feed) {

                ?>

                <li>
                    <p>
                        <a target="_blank"
                           href="https://twitter.com/<?php echo esc_attr($twitter_username) ?>/status/<?php echo esc_attr($feed['id_str']) ?>"><?php echo esc_attr($feed['text']); ?></a>
                    </p>

                </li>

                <?php

            }
            ?>
        </ul>

        <?php do_action('teg_ta_twitter_feed_shortcode_layout_after', 10, 0) ?>

    </div>
</div>

