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


        // Calc totals
        WC()->cart->calculate_totals();

        if (WC()->cart->is_empty()) {
            wc_get_template('cart/cart-empty.php');
        } else {
            wc_get_template('cart/cart.php');
        }
    }
}
