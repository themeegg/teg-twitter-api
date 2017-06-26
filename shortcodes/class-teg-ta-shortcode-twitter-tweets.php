<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Twitter Shortcodes
 *
 * Used to show twitter trends, tweets etc.
 *
 * @author        ThemeEgg
 * @category    Shortcodes
 * @package    TEG_TA_Twitter_API/Shortcodes/Twitter
 * @version     1.0.0
 */
class TEG_TA_Shortcode_Twitter_Tweets implements TEG_TA_Shortcode_Interface
{


    /**
     * Output the cart shortcode.
     *
     * @param array $atts
     */
    public static function output($atts = array())
    {

        $defaultAttr = array(
            'count' => 5,
            'title' => 'Twitter Tweets',
        );

        $attributes = wp_parse_args($atts, $defaultAttr);

        teg_ta_get_template('cart/cart-empty.php');

    }
}
