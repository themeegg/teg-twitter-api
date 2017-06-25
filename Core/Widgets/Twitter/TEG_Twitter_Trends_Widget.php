<?php
namespace Core\Widgets\Twitter;
use TEG_Design\Core\TEG_Widget_Interface;
class TEG_Twitter_Trends_Widget extends \WP_Widget implements TEG_Widget_Interface{

    function __construct(){


        if( ! defined('ABSPATH') ){
            exit;
        }

        $widget_option = array(
            'class_name'=>'widget_twitter-trends',
            'description'=>'Please add widget to get Twitter Trends.',
            'customize_selective_refresh'=>false,
        );

        $control_options=array(
            'width'=>200,
            'height'=>350
        );

        parent::__construct( 'twitter-trends', __( 'Twitter Trends' ), $widget_option, $control_options );

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
            $show_trends = $instance['show_trends'];
            $trends_location = $instance['trends_location'];
            $twitterObj = new \Api\Twitter\TwitterTrends();
            if(is_numeric($trends_location)){
                $twitterObj->setGetField($trends_location);
            }
            $twitterTrends = $twitterObj->getTrends();
            ?>
        <ul>
            <?php

            foreach($twitterTrends as $key=>$singleTrends){

                if($key>=$show_trends){
                    break;
                }

                ?>

                <li>
                    <a target="_blank" href="<?php echo $singleTrends->url; ?>">
                        <b><?php echo $singleTrends->name; ?></b>
                    </a>
                    <?php if($singleTrends->tweet_volume): ?>
                        <span>(<?php echo $singleTrends->tweet_volume; ?>)</span>
                    <?php endif; ?>
                </li>

                <?php

            }
            ?>
        </ul>
        </div>
        <?php

        echo $args['after_widget'];

    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['show_trends'] = sanitize_text_field( $new_instance['show_trends'] );
        $instance['trends_location'] = sanitize_text_field( $new_instance['trends_location'] );
        return $instance;
    }

    public function form( $instance ) {

        $defaultInstance = array(
            'title' => '',
            'show_trends'=>5,
            'trends_location'=>1,
        );

        $instance = wp_parse_args( (array) $instance, $defaultInstance );

        $title = sanitize_text_field( $instance['title'] );

        $show_trends = sanitize_text_field( $instance['show_trends'] );

        $trends_location = sanitize_text_field( $instance['trends_location'] );

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('show_trends'); ?>"><?php _e('Show Trends:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('show_trends'); ?>" name="<?php echo $this->get_field_name('show_trends'); ?>" type="number" value="<?php echo esc_attr($show_trends); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('trends_location'); ?>"><?php _e('Trends WOEID:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('trends_location'); ?>" name="<?php echo $this->get_field_name('trends_location'); ?>" type="text" value="<?php echo esc_attr($trends_location); ?>" />
        </p>

        <?php
    }

    function __destruct(){

    }

}