<?php
/**
 * WooCommerce Formatting
 *
 * Functions for formatting data.
 *
 * @author        WooThemes
 * @category    Core
 * @package    WooCommerce/Functions
 * @version     2.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Sanitize a string destined to be a tooltip.
 *
 * @since 1.0.0 Tooltips are encoded with htmlspecialchars to prevent XSS. Should not be used in conjunction with esc_attr()
 * @param string $var
 * @return string
 */
function teg_ta_sanitize_tooltip($var)
{
    return htmlspecialchars(wp_kses(html_entity_decode($var), array(
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'small' => array(),
        'span' => array(),
        'ul' => array(),
        'li' => array(),
        'ol' => array(),
        'p' => array(),
    )));
}
/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * @param string|array $var
 * @return string|array
 */
function teg_ta_clean( $var ) {
    if ( is_array( $var ) ) {
        return array_map( 'teg_ta_clean', $var );
    } else {
        return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
    }
}