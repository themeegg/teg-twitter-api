<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Twitter Trends Widget.
 *
 * Displays twitter trends widget.
 *
 * @author   ThemeEgg
 * @category Widgets
 * @package  TEGTwitterAPI/Widgets
 * @version  1.0
 * @extends  TEG_TA_Widget
 */
class TEG_TA_Widget_Twitter_Timeline extends TEG_TA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'teg_twitter_api_widget_twitter_timeline';
		$this->widget_description = __( "Display an official Twitter Embedded Timeline widget.", 'teg-twitter-api' );
		$this->widget_id          = 'teg_twitter_api_widget_twitter_timeline';
		$this->widget_name        = __( 'Twitter Timeline', 'teg-twitter-api' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Twitter Timeline', 'teg-twitter-api' ),
				'label' => __( 'Title', 'teg-twitter-api' ),
			),
			'handle' => array(
				'type'  => 'text',
				'std'   => 'theme_egg',
				'label' => __( 'Twitter username(without @)', 'teg-twitter-api' ),

			),
		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		if ( apply_filters( 'teg_twitter_api_widget_twitter_timeline_is_hidden', false ) ) {
			return;
		}

		$this->widget_start( $args, $instance );

		$handle = $instance['handle'];
		if ( empty( $handle ) ) {
			$handle = get_option( 'teg_twitter_api_twitter_username', 'theme_egg' );
		}
		$data = array(

			'handle' => $instance['handle'],

		);

		teg_ta_get_template( 'widgets/content-widget-twitter-timeline.php', $data );


		$this->widget_end( $args );
	}
}
