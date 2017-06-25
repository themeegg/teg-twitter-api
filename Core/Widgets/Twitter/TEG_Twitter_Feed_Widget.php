<?php
namespace Core\Widgets\Twitter;
use TEG_Design\Core\TEG_Widget_Interface;
class TEG_Twitter_Feed_Widget extends \WP_Widget implements TEG_Widget_Interface{

    function __construct(){


        if( ! defined('ABSPATH') ){
            exit;
        }

        $widget_option = array(
            'class_name'=>'widget_twitter-feeds',
            'description'=>'Please add widget to get Twitter Feeds.',
            'customize_selective_refresh'=>false,
        );

        $control_options=array(
            'width'=>200,
            'height'=>350
        );

        parent::__construct( 'twitter-feeds', __( 'Twitter Feeds' ), $widget_option, $control_options );

    }

    public function widget($args, $instance){

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( ! empty( $title ) ) {

            echo $args['before_title'] . $title . $args['after_title'];

        }

        ?>

        <div class="tweetswidget">

            <?php

            $twitterObj = new \Api\Twitter\TwitterTweets();

            $tweetsJson = $twitterObj->getTweets($instance['show_tweets']);

            foreach($tweetsJson as $singleTweet){

            ?>

                <p><?php echo $singleTweet['text']; ?></p>

            <?php

            }

            ?>

        </div>

        <?php

        echo $args['after_widget'];

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['twitter_username'] = sanitize_text_field( $new_instance['twitter_username'] );
        $instance['show_tweets'] = sanitize_text_field( $new_instance['show_tweets'] );
        $instance['offset_tweets'] = sanitize_text_field( $new_instance['offset_tweets'] );
        $instance['pagination'] = sanitize_text_field( $new_instance['pagination'] );
        $instance['is_slide_show'] = sanitize_text_field( $new_instance['is_slide_show'] );

        return $instance;

    }

    public function form( $instance ) {

        $defaultInstance = array(
            'title' => '',
            'twitter_username' => '',
            'show_tweets'=>5,
            'offset_tweets'=>0,
            'pagination'=>false,
            'is_slide_show'=>false,
        );

        $instance = wp_parse_args( (array) $instance, $defaultInstance );

        $title = sanitize_text_field( $instance['title'] );

        //$twitter_username = sanitize_text_field( $instance['twitter_username'] );

        $show_tweets = sanitize_text_field( $instance['show_tweets'] );

        //$offset_tweets = sanitize_text_field( $instance['offset_tweets'] );

        //$pagination = sanitize_text_field( $instance['pagination'] );

        //$is_slide_show = sanitize_text_field( $instance['is_slide_show'] );

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <?php /* ?>

        <p>
            <label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter Username:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>" />
        </p>

        <?php */ ?>

        <p>
            <label for="<?php echo $this->get_field_id('show_tweets'); ?>"><?php _e('Show Tweets:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('show_tweets'); ?>" name="<?php echo $this->get_field_name('show_tweets'); ?>" type="number" value="<?php echo esc_attr($show_tweets); ?>" />
        </p>

        <?php /* ?>

        <p>
            <label for="<?php echo $this->get_field_id('offset_tweets'); ?>"><?php _e('Offset Tweets:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('offset_tweets'); ?>" name="<?php echo $this->get_field_name('offset_tweets'); ?>" type="number" value="<?php echo esc_attr($offset_tweets); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagination'); ?>"><?php _e('Pagination:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagination'); ?>" name="<?php echo $this->get_field_name('pagination'); ?>" type="text" value="<?php echo esc_attr($pagination); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('is_slide_show'); ?>"><?php _e('Is Slide Show:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('is_slide_show'); ?>" name="<?php echo $this->get_field_name('is_slide_show'); ?>" type="text" value="<?php echo esc_attr($is_slide_show); ?>" />
        </p>

        <?php */ ?>

        <?php
    }

    function __destruct(){

    }

}