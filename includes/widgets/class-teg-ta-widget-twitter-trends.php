<?php

if (!defined('ABSPATH')) {
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
class TEG_TA_Widget_Twitter_Trends extends TEG_TA_Widget
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'teg_twitter_api_widget_twitter_trends';
        $this->widget_description = __("Display the user's TRENDS in the sidebar.", 'woocommerce');
        $this->widget_id = 'woocommerce_widget_cart';
        $this->widget_name = __('WooCommerce cart', 'woocommerce');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => __('Twitter Trends', 'woocommerce'),
                'label' => __('Title', 'woocommerce'),
            ),
            'hide_if_empty' => array(
                'type' => 'checkbox',
                'std' => 0,
                'label' => __('Hide if cart is empty', 'woocommerce'),
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
    public function widget($args, $instance)
    {
        if (apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) {
            return;
        }

        $hide_if_empty = empty($instance['hide_if_empty']) ? 0 : 1;

        $this->widget_start($args, $instance);

        if ($hide_if_empty) {
            echo '<div class="hide_cart_widget_if_empty">';
        }

        // Insert cart widget placeholder - code in woocommerce.js will update this on page load
        echo '<div class="widget_shopping_cart_content"></div>';

        if ($hide_if_empty) {
            echo '</div>';
        }

        $this->widget_end($args);
    }
}
