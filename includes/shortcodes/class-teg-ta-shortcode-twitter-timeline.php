<?php

if ( ! defined( 'ABSPATH' ) ) {
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
class TEG_TA_Shortcode_Twitter_Timeline implements TEG_TA_Shortcode_Interface {


	/**
	 * Output the cart shortcode.
	 *
	 * @param array $atts
	 */
	public static function output( $atts = array() ) {

		$defaultAttr = array(

			'title'    => __( 'Twitter Timeline', 'teg-twitter-api' ),
			'username' => get_option( 'teg_twitter_api_twitter_username' ),
		);

		$attributes = wp_parse_args( $atts, $defaultAttr );

		$data = array(


			'handle' => $attributes['username'],

			'title' => $attributes['title']
		);

		teg_ta_get_template( 'shortcodes/content-shortcode-twitter-timeline.php', $data );


	}
}
